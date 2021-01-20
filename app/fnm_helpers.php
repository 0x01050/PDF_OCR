<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('randomID')) {
  function randomID($length = 9) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}

if (! function_exists('fillWithBlank')) {
    function fillWithBlank($length, $origin = '') {
        while(strlen($origin) < $length) {
            $origin .= ' ';
        }
        return substr($origin, 0, $length);
    }
}

if (! function_exists('writeToFNM')) {
    function writeToFNM($fields) {
        $fnm_file = time() . random_string();
        $fnm_file = $fnm_file . '.fnm';
        $ret_arr = array();

        $envID = writeEHToFNM($ret_arr);
        $transactionID = writeTHToFNM($ret_arr);
        writeTPIToFNM($ret_arr);
        write000ToFNM($ret_arr);
        write00AToFNM($ret_arr);
        write01AToFNM($ret_arr, $fields);

        writeTTToFNM($ret_arr, $transactionID);
        writeETToFNM($ret_arr, $envID);

        Storage::put($fnm_file, implode(PHP_EOL, $ret_arr));
        return $fnm_file;
    }
}

if (! function_exists('writeEHToFNM')) {
    function writeEHToFNM(&$ret_arr) {
        $envID = randomID();
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'EH');                         // EH-010
        $ret_str .= fillWithBlank(6);                               // EH-020
        $ret_str .= fillWithBlank(25);                              // EH-030
        $ret_str .= fillWithBlank(11, date('Ymd'));                 // EH-040
        $ret_str .= fillWithBlank(9, $envID);                       // EH-050
        array_push($ret_arr, $ret_str);
        return $envID;
    }
}
if (! function_exists('writeTHToFNM')) {
    function writeTHToFNM(&$ret_arr) {
        $transactionID = randomID();
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'TH');                         // TH-010
        $ret_str .= fillWithBlank(11, 'T100099-002');               // TH-020
        $ret_str .= fillWithBlank(9, $transactionID);               // TH-030
        array_push($ret_arr, $ret_str);
        return $transactionID;
    }
}
if (! function_exists('writeTPIToFNM')) {
    function writeTPIToFNM(&$ret_arr) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'TPI');                        // TPI-010
        $ret_str .= fillWithBlank(5, '1.00');                       // TPI-020
        $ret_str .= fillWithBlank(2);                               // TPI-030
        $ret_str .= fillWithBlank(30);                              // TPI-040
        $ret_str .= fillWithBlank(1, 'N');                          // TPI-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write000ToFNM')) {
    function write000ToFNM(&$ret_arr) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '000');                        // 000-010
        $ret_str .= fillWithBlank(3, '1');                          // 000-020
        $ret_str .= fillWithBlank(5, '3.20');                       // 000-030
        $ret_str .= fillWithBlank(1, 'W');                          // 000-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write00AToFNM')) {
    function write00AToFNM(&$ret_arr) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '00A');                        // 00A-010
        $ret_str .= fillWithBlank(1, 'N');                          // 00A-010 ???
        $ret_str .= fillWithBlank(1, 'N');                          // 00A-010 ???
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write01AToFNM')) {
    function write01AToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '01A');                        // 01A-010
        $var_020 = '';
        if(isset($fields['property_loan_mortgage_applied_for'])) {
            switch($fields['property_loan_mortgage_applied_for']) {
                case 'conventional':                $var_020 = '01'; break;
                case 'va':                          $var_020 = '02'; break;
                case 'fha':                         $var_020 = '03'; break;
                case 'usda-rural-housing-service':  $var_020 = '04'; break;
                case 'other':                       $var_020 = '07'; break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_020);                     // 01A-020
        $var_030 = '';
        if($var_020 == '07' && isset($fields['property_loan_other_mortgage_applied_for_explanation'])) {
            $var_030 = $fields['property_loan_other_mortgage_applied_for_explanation'];
        }
        $ret_str .= fillWithBlank(80, $var_030);                    // 01A-030
        $ret_str .= fillWithBlank(30);                              // 01A-040
        $ret_str .= fillWithBlank(15);                              // 01A-050
        $var_060 = '';
        if(isset($fields['property_loan_loan_amount'])) {
            $var_060 = $fields['property_loan_loan_amount'];
        }
        $ret_str .= fillWithBlank(15, $var_060);                    // 01A-060
        $ret_str .= fillWithBlank(7);                               // 01A-070
        $var_080 = '';
        if(isset($fields['property_loan_number_of_months'])) {
            $var_080 = $fields['property_loan_number_of_months'];
        }
        $ret_str .= fillWithBlank(3, $var_080);                     // 01A-080
        $var_090 = '';
        if(isset($fields['property_loan_amortization_type'])) {
            switch($fields['property_loan_amortization_type']) {
                case 'fixed-rate':                  $var_090 = '05'; break;
                case 'gpm':                         $var_090 = '06'; break;
                case 'arm':                         $var_090 = '01'; break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_090);                     // 01A-090
        $ret_str .= fillWithBlank(80);                              // 01A-100
        $var_110 = '';
        if($var_090 == '01' && isset($fields['property_loan_arm_type'])) {
            $var_110 = $fields['property_loan_arm_type'];
        }
        $ret_str .= fillWithBlank(80, $var_110);                    // 01A-110
        array_push($ret_arr, $ret_str);
    }
}
// if (! function_exists('')) {
//     function (&$ret_arr, $fields) {
//         $ret_str = '';
//         $ret_str .= fillWithBlank(3, '   ');                        // -010
//         $ret_str .= fillWithBlank();// -010
//         array_push($ret_arr, $ret_str);
//     }
// }

if (! function_exists('writeTTToFNM')) {
    function writeTTToFNM(&$ret_arr, $transactionID) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'TT');                         // TT-010
        $ret_str .= fillWithBlank(9, $transactionID);               // TT-020
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeETToFNM')) {
    function writeETToFNM(&$ret_arr, $envID) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'ET');                         // ET-010
        $ret_str .= fillWithBlank(9, $envID);                       // ET-020
        array_push($ret_arr, $ret_str);
    }
}
?>

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
if (! function_exists('extractOnlyDigits')) {
    function extractOnlyDigits($input) {
        return preg_replace('/[^0-9]/', '', $input);
    }
}
if (! function_exists('calcAge')) {
    function calcAge($birthday) {
        $dob = new DateTime($birthday);
        $tdate = new DateTime();
        $diff = $tdate->diff($dob);
        return $diff->y;
    }
}
if (! function_exists('calcYearAndMonth')) {
    function calcYearAndMonth($startDate, &$year, &$month) {
        $sd = new DateTime($startDate);
        $tdate = new DateTime();
        $diff = $tdate->diff($sd);
        $year = $diff->y;
        $month = $diff->m;
    }
}
if (! function_exists('formatDate')) {
    function formatDate($input = null) {
        if($input == null)
            $date = time();
        else
            $date = strtotime($input);
        return date('Ymd', $date);
    }
}
if (! function_exists('formatNumber')) {
    function formatNumber($input, $up, $down) {
        $number = number_format($input, $down, '.', '');
        return $number;
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

        write000ToFNM($ret_arr, '1', '3.20', 'W');
        write00AToFNM($ret_arr);
        write01AToFNM($ret_arr, $fields);
        write02AToFNM($ret_arr, $fields);
        if(false) {
            writePAIToFNM($ret_arr, $fields);
        }
        write02BToFNM($ret_arr, $fields);
        write02CToFNM($ret_arr, $fields);
        write02DToFNM($ret_arr, $fields);
        if(isset($fields['property_purpose_purpose_of_loan']) && $fields['property_purpose_purpose_of_loan'] == 'purchase') {
            write02EToFNM($ret_arr, $fields);
        }
        write03AToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write03AToFNM($ret_arr, $fields, 'co');
        }
        write03BToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write03BToFNM($ret_arr, $fields, 'co');
        }
        write03CToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write03CToFNM($ret_arr, $fields, 'co');
        }
        write04AToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write04AToFNM($ret_arr, $fields, 'co');
        }
        write04BToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write04BToFNM($ret_arr, $fields, 'co');
        }
        write05HToFNM($ret_arr, $fields);
        write05IToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write05IToFNM($ret_arr, $fields, 'co');
        }
        if(false) {
            write06AToFNM($ret_arr, $fields);
            write06BToFNM($ret_arr, $fields);
        }
        write06CToFNM($ret_arr, $fields);
        write06DToFNM($ret_arr, $fields);
        if(false) {
            write06FToFNM($ret_arr, $fields);
        }
        write06GToFNM($ret_arr, $fields);
        if(false) {
            write06HToFNM($ret_arr, $fields);
            write06LToFNM($ret_arr, $fields);
            write06SToFNM($ret_arr, $fields);
        }
        write07AToFNM($ret_arr, $fields);
        if(false) {
            write07BToFNM($ret_arr, $fields);
        }
        write08AToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write08AToFNM($ret_arr, $fields, 'co');
        }
        if(false) {
            write08BToFNM($ret_arr, $fields);
            write09AToFNM($ret_arr, $fields);
        }
        write10AToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            write10AToFNM($ret_arr, $fields, 'co');
        }
        write10RToFNM($ret_arr, $fields);
        write10BToFNM($ret_arr, $fields);

        write000ToFNM($ret_arr, '70');
        write99BToFNM($ret_arr, $fields);
        writeADSToFNM($ret_arr, $fields);
        if(false) {
            writeSCAToFNM($ret_arr, $fields);
        }

        write000ToFNM($ret_arr, '11');
        writeLNCToFNM($ret_arr, $fields);
        writePIDToFNM($ret_arr, $fields);
        writePCHToFNM($ret_arr, $fields);
        if(false) {
            writeARMToFNM($ret_arr, $fields);
            writePAJToFNM($ret_arr, $fields);
            writeRAJToFNM($ret_arr, $fields);
            writeBUAToFNM($ret_arr, $fields);
        }

        if(false) {
            write000ToFNM($ret_arr, '20');
            writeIDAToFNM($ret_arr, $fields);
            writeLEAToFNM($ret_arr, $fields);
            writeGOAToFNM($ret_arr, $fields);
            writeGOBToFNM($ret_arr, $fields);
            writeGOCToFNM($ret_arr, $fields);
            writeGODToFNM($ret_arr, $fields);
            writeGOEToFNM($ret_arr, $fields);
        }

        if(false) {
            write000ToFNM($ret_arr, '30');
            writeLMDToFNM($ret_arr, $fields);
        }

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
        $ret_str .= fillWithBlank(11, formatDate());                // EH-040
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
    function write000ToFNM(&$ret_arr, $type, $version = '3.20', $indicator = null) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '000');                        // 000-010
        $ret_str .= fillWithBlank(3, $type);                        // 000-020
        $ret_str .= fillWithBlank(5, $version);                     // 000-030
        if($indicator != null) {
            $ret_str .= fillWithBlank(1, $indicator);               // 000-040
        }
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write00AToFNM')) {
    function write00AToFNM(&$ret_arr) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '00A');                        // 00A-010
        $ret_str .= fillWithBlank(1, 'N');                          // 00A-010
        $ret_str .= fillWithBlank(1, 'N');                          // 00A-010
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
            $var_060 = formatNumber($fields['property_loan_loan_amount'], 12, 2);
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
if (! function_exists('write02AToFNM')) {
    function write02AToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '02A');                        // 02A-010
        $ret_str .= fillWithBlank(50);                              // 02A-020
        $ret_str .= fillWithBlank(35);                              // 02A-030
        $ret_str .= fillWithBlank(2);                               // 02A-040
        $ret_str .= fillWithBlank(5);                               // 02A-050
        $ret_str .= fillWithBlank(4);                               // 02A-060
        $ret_str .= fillWithBlank(3, '1');                          // 02A-070
        $ret_str .= fillWithBlank(2);                               // 02A-090
        $ret_str .= fillWithBlank(80);                              // 02A-090
        $ret_str .= fillWithBlank(4);                               // 02A-100
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writePAIToFNM')) {
    function writePAIToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'PAI');                        // PAI-010
        $ret_str .= fillWithBlank(11);                              // PAI-020
        $ret_str .= fillWithBlank(40);                              // PAI-030
        $ret_str .= fillWithBlank(11);                              // PAI-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write02BToFNM')) {
    function write02BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '02B');                        // 02B-010
        $ret_str .= fillWithBlank(2);                               // 02B-020
        $var_030 = '';
        if(isset($fields['property_purpose_purpose_of_loan'])) {
            switch($fields['property_purpose_purpose_of_loan']) {
                case 'construction':                $var_030 = '04'; break;
                case 'refinance':                   $var_030 = '05'; break;
                case 'construction-permanent':      $var_030 = '13'; break;
                case 'other':                       $var_030 = '15'; break;
                case 'purchase':                    $var_030 = '16'; break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_030);                     // 02B-030
        $var_040 = '';
        if($var_030 == '15' && isset($fields['property_purpose_other_explanation'])) {
            $var_040 = $fields['property_purpose_other_explanation'];
        }
        $ret_str .= fillWithBlank(80, $var_040);                    // 02B-040
        $var_050 = '';
        if(isset($fields['property_purpose_property_will_be'])) {
            switch($fields['property_purpose_property_will_be']) {
                case 'primary-residence':           $var_050 = '1'; break;
                case 'secondary-residence':         $var_050 = '2'; break;
                case 'investment':                  $var_050 = 'D'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_050);                     // 02B-050
        $var_060 = '';
        if(isset($fields['property_purpose_manner_in_which_title_will_be_held'])) {
            $var_060 = $fields['property_purpose_manner_in_which_title_will_be_held'];
        }
        $ret_str .= fillWithBlank(60, $var_060);                    // 02B-060
        $ret_str .= fillWithBlank(1, '1');                          // 02B-070
        $ret_str .= fillWithBlank(8);                               // 02B-080
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write02CToFNM')) {
    function write02CToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '02C');                        // 02C-010
        $ret_str .= fillWithBlank(60);                              // 02C-020
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write02DToFNM')) {
    function write02DToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '02D');                        // 02D-010
        $ret_str .= fillWithBlank(4);                               // 02D-020
        $ret_str .= fillWithBlank(15);                              // 02D-030
        $var_040 = '';
        if(isset($fields['property_purpose_purpose_of_loan']) &&
            ($fields['property_purpose_purpose_of_loan'] == 'refinance' || $fields['property_purpose_purpose_of_loan'] == 'construction' || $fields['property_purpose_purpose_of_loan'] == 'construction-permanent')) {
            if(isset($fields['property_purpose_amount_existing_liens'])) {
                $var_040 = formatNumber($fields['property_purpose_amount_existing_liens'], 12, 2);
            }
        }
        $ret_str .= fillWithBlank(15, $var_040);                    // 02D-040
        $ret_str .= fillWithBlank(15);                              // 02D-050
        $ret_str .= fillWithBlank(15);                              // 02D-060
        $var_070 = '';
        if(isset($fields['property_purpose_purpose_of_loan']) && $fields['property_purpose_purpose_of_loan'] == 'refinance') {
            if(isset($fields['property_purpose_purpose_of_refinance'])) {
                switch($fields['property_purpose_purpose_of_refinance']) {
                    case 'no_cash_out':                 $var_070 = 'F1'; break;
                    case 'cash_out_other':              $var_070 = '01'; break;
                    case 'cash_out_home_improvement':   $var_070 = '04'; break;
                    case 'cash_out_debt_consolidation': $var_070 = '11'; break;
                    case 'limited_cash_out':            $var_070 = '13'; break;
                }
            }
        }
        $ret_str .= fillWithBlank(2, $var_070);                     // 02D-070
        $ret_str .= fillWithBlank(80);                              // 02D-080
        $ret_str .= fillWithBlank(1);                               // 02D-090
        $ret_str .= fillWithBlank(15);                              // 02D-100
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write02EToFNM')) {
    function write02EToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '02E');                        // 02E-010
        $var_020 = '';
        if(isset($fields['property_purpose_financing_source'])) {
            switch($fields['property_purpose_financing_source']) {
                case 'checking_saving':             $var_020 = 'F1'; break;
                case 'deposit_on_sales_contract':   $var_020 = 'F2'; break;
                case 'equity_on_sold_property':     $var_020 = 'F3'; break;
                case 'equity_from_ending_sale':     $var_020 = '03'; break;
                case 'equity_from_subject_property':$var_020 = 'F4'; break;
                case 'gift_funds':                  $var_020 = '04'; break;
                case 'stocks_and_bonds':            $var_020 = 'F5'; break;
                case 'lot_equity':                  $var_020 = '10'; break;
                case 'bridge_loan':                 $var_020 = '09'; break;
                case 'unsecured_borrowed_funds':    $var_020 = '01'; break;
                case 'trust_funds':                 $var_020 = 'F6'; break;
                case 'retirement_funds':            $var_020 = 'F7'; break;
                case 'rent_with_option_to_purchase':$var_020 = '11'; break;
                case 'life_insurance_cash_value':   $var_020 = 'F8'; break;
                case 'sale_of_chattel':             $var_020 = '14'; break;
                case 'trade_equity':                $var_020 = '07'; break;
                case 'sweat_equity':                $var_020 = '06'; break;
                case 'cash_on_hand':                $var_020 = '02'; break;
                case 'other_type_of_down_payment':  $var_020 = '13'; break;
                case 'secured_borrowed_funds':      $var_020 = '28'; break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_020);                     // 02E-020
        $var_030 = '';
        if($var_020 == '04' && isset($fields['property_purpose_financing_source_amount'])) {
            $var_030 = $fields['property_purpose_financing_source_amount'];
        }
        $ret_str .= fillWithBlank(15, $var_030);                    // 02E-030
        $ret_str .= fillWithBlank(80);                              // 02E-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write03AToFNM')) {
    function write03AToFNM(&$ret_arr, $fields, $prefix = '') {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '03A');                        // 03A-010
        $var_020 = 'BW';
        if($prefix == 'co') {
            $var_020 = 'QZ';
        }
        $ret_str .= fillWithBlank(2, $var_020);                     // 03A-020
        $var_030 = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $var_030 = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        $ret_str .= fillWithBlank(9, $var_030);                     // 03A-030
        $var_040 = '';
        if(isset($fields[$prefix . 'borrower_info_first_name'])) {
            $var_040 = $fields[$prefix . 'borrower_info_first_name'];
        }
        $ret_str .= fillWithBlank(35, $var_040);                    // 03A-040
        $var_050 = '';
        if(isset($fields[$prefix . 'borrower_info_middle_name'])) {
            $var_050 = $fields[$prefix . 'borrower_info_middle_name'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 03A-050
        $var_060 = '';
        if(isset($fields[$prefix . 'borrower_info_last_name'])) {
            $var_060 = $fields[$prefix . 'borrower_info_last_name'];
        }
        $ret_str .= fillWithBlank(35, $var_060);                    // 03A-060
        $ret_str .= fillWithBlank(4);                               // 03A-070
        $var_080 = '';
        if(isset($fields[$prefix . 'borrower_info_home_phone'])) {
            $var_080 = extractOnlyDigits($fields[$prefix . 'borrower_info_home_phone']);
        }
        $ret_str .= fillWithBlank(10, $var_080);                    // 03A-080
        $var_090 = '';
        if(isset($fields[$prefix . 'borrower_info_date_of_birth'])) {
            $var_090 = calcAge($fields[$prefix . 'borrower_info_date_of_birth']);
        }
        $ret_str .= fillWithBlank(3, $var_090);                     // 03A-090
        $var_100 = '';
        if(isset($fields[$prefix . 'borrower_info_years_in_school'])) {
            $var_100 = $fields[$prefix . 'borrower_info_years_in_school'];
        }
        $ret_str .= fillWithBlank(2, $var_100);                     // 03A-100
        $var_110 = '';
        if(isset($fields[$prefix . 'borrower_info_marital_status'])) {
            switch($fields[$prefix . 'borrower_info_marital_status']) {
                case 'married':                     $var_110 = 'M'; break;
                case 'unmarried':                   $var_110 = 'U'; break;
                case 'separated':                   $var_110 = 'S'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_110);                     // 03A-110
        $var_120 = '';
        if(isset($fields[$prefix . 'borrower_info_number_of_dependents'])) {
            $var_120 = $fields[$prefix . 'borrower_info_number_of_dependents'];
        }
        $ret_str .= fillWithBlank(2, $var_120);                     // 03A-120
        $var_130 = 'N';
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            $var_130 = 'Y';
        }
        $ret_str .= fillWithBlank(1, $var_130);                     // 03A-130
        $var_140 = '';
        if($var_130 == 'Y') {
            if($prefix == '' && isset($fields['coborrower_info_social_security_number'])) {
                $var_140 = $fields['coborrower_info_social_security_number'];
            }
            if($prefix == 'co' && isset($fields['borrower_info_social_security_number'])) {
                $var_140 = $fields['borrower_info_social_security_number'];
            }
        }
        $ret_str .= fillWithBlank(9, $var_140);                     // 03A-140
        $var_150 = '';
        if(isset($fields[$prefix . 'borrower_info_date_of_birth'])) {
            $var_150 = formatDate($fields[$prefix . 'borrower_info_date_of_birth']);
        }
        $ret_str .= fillWithBlank(8, $var_150);                     // 03A-150
        $var_160 = '';
        if(isset($fields[$prefix . 'borrower_info_email'])) {
            $var_160 = $fields[$prefix . 'borrower_info_email'];
        }
        $ret_str .= fillWithBlank(80, $var_160);                    // 03A-160
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write03BToFNM')) {
    function write03BToFNM(&$ret_arr, $fields, $prefix = '') {
        if(isset($fields[$prefix . 'borrower_info_dependent_ages'])) {
            $ssn = '';
            if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
                $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
            }
            $dependents = explode(",", $fields[$prefix . 'borrower_info_dependent_ages']);
            foreach($dependents as $dep) {
                $dep = trim($dep);
                write03BSubToFNM($ret_arr, $ssn, $dep);
            }
        }
    }
}
if (! function_exists('write03BSubToFNM')) {
    function write03BSubToFNM(&$ret_arr, $ssn, $dep) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '03B');                        // 03B-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 03B-020
        $ret_str .= fillWithBlank(3, $dep);                         // 03B-030
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write03CToFNM')) {
    function write03CToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        write03CSubToFNM($ret_arr, $ssn, $fields, $prefix);
        if(isset($fields[$prefix . 'borrower_address_address_is_mailing_address']) && $fields[$prefix . 'borrower_address_address_is_mailing_address'] == 'false') {
            write03CSubToFNM($ret_arr, $ssn, $fields, $prefix, 'present_mailing');
        }
        if(isset($fields[$prefix . 'borrower_address_address_lived_less_than_2_years']) && $fields[$prefix . 'borrower_address_address_lived_less_than_2_years'] == 'true') {
            write03CSubToFNM($ret_arr, $ssn, $fields, $prefix, 'former');
        }
    }
}
if (! function_exists('write03CSubToFNM')) {
    function write03CSubToFNM(&$ret_arr, $ssn, $fields, $prefix, $midfix = 'present') {
        $tmpfix = $midfix;
        if($tmpfix == 'present_mailing') {
            $tmpfix = 'present';
        }

        $ret_str = '';
        $ret_str .= fillWithBlank(3, '03C');                        // 03C-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 03C-020
        $var_030 = '';
        switch($midfix) {
            case 'present':             $var_030 = 'ZG'; break;
            case 'present_mailing':     $var_030 = 'BH'; break;
            case 'former':              $var_030 = 'F4'; break;
        }
        $ret_str .= fillWithBlank(2, $var_030);                     // 03C-030
        $var_040 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $midfix . '_address_1'])) {
            $var_040 = $fields[$prefix . 'borrower_address_' . $midfix . '_address_1'];
        }
        if(isset($fields[$prefix . 'borrower_address_' . $midfix . '_address_2'])) {
            $var_040 .= ', ' . $fields[$prefix . 'borrower_address_' . $midfix . '_address_2'];
        }
        $var_040 = trim($var_040, ', ');
        $ret_str .= fillWithBlank(50, $var_040);                    // 03C-040
        $var_050 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $midfix . '_address_city'])) {
            $var_050 = $fields[$prefix . 'borrower_address_' . $midfix . '_address_city'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 03C-050
        $var_060 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $midfix . '_address_state'])) {
            $var_060 = $fields[$prefix . 'borrower_address_' . $midfix . '_address_state'];
        }
        $ret_str .= fillWithBlank(2, $var_060);                     // 03C-060
        $var_070 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $midfix . '_address_zip_code'])) {
            $var_070 = $fields[$prefix . 'borrower_address_' . $midfix . '_address_zip_code'];
        }
        $ret_str .= fillWithBlank(5, $var_070);                     // 03C-070
        $ret_str .= fillWithBlank(4);                               // 03C-080
        $var_090 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $tmpfix . '_address_own_rent'])) {
            switch($fields[$prefix . 'borrower_address_' . $tmpfix . '_address_own_rent']) {
                case 'rent':                $var_090 = 'R'; break;
                case 'own':                 $var_090 = 'O'; break;
                case 'living_rent_free':    $var_090 = 'X'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_090);                     // 03C-090
        $var_100 = '';
        if(isset($fields[$prefix . 'borrower_address_' . $tmpfix . '_address_own_rent_number_of_years'])) {
            $var_100 = $fields[$prefix . 'borrower_address_' . $tmpfix . '_address_own_rent_number_of_years'];
        }
        $ret_str .= fillWithBlank(2, $var_100);                     // 03C-100
        $ret_str .= fillWithBlank(2);                               // 03C-110
        $ret_str .= fillWithBlank(50);                              // 03C-120
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write04AToFNM')) {
    function write04AToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        if(isset($fields[$prefix . 'borrower_employment'])) {
            foreach($fields[$prefix . 'borrower_employment'] as $employment) {
                if(isset($employment['currently_employed']) && $employment['currently_employed'] == 'true') {
                    write04ASubToFNM($ret_arr, $ssn, $employment);
                }
            }

        }
    }
}
if (! function_exists('write04ASubToFNM')) {
    function write04ASubToFNM(&$ret_arr, $ssn, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '04A');                        // 04A-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 04A-020
        $var_030 = '';
        if(isset($fields['name'])) {
            $var_030 = $fields['name'];
        }
        $ret_str .= fillWithBlank(35, $var_030);                    // 04A-030
        $var_040 = '';
        if(isset($fields['address_1'])) {
            $var_040 = $fields['address_1'];
        }
        if(isset($fields['address_2'])) {
            $var_040 .= ', ' . $fields['address_2'];
        }
        $var_040 = trim($var_040, ', ');
        $ret_str .= fillWithBlank(35, $var_040);                    // 04A-040
        $var_050 = '';
        if(isset($fields['city'])) {
            $var_050 = $fields['city'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 04A-050
        $var_060 = '';
        if(isset($fields['state'])) {
            $var_060 = $fields['state'];
        }
        $ret_str .= fillWithBlank(2, $var_060);                     // 04A-060
        $var_070 = '';
        if(isset($fields['zip_code'])) {
            $var_070 = $fields['zip_code'];
        }
        $ret_str .= fillWithBlank(5, $var_070);                     // 04A-070
        $ret_str .= fillWithBlank(4);                               // 04A-080
        $var_090 = '';
        if(isset($fields['self_employed'])) {
            switch($fields['self_employed']) {
                case 'yes':             $var_090 = 'Y'; break;
                case 'no':              $var_090 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_090);                     // 04A-090
        $var_100 = ''; $var_110 = '';
        if(isset($fields['start_date'])) {
            calcYearAndMonth($fields['start_date'], $var_100, $var_110);
        }
        $ret_str .= fillWithBlank(2, $var_100);                     // 04A-100
        $ret_str .= fillWithBlank(2, $var_110);                     // 04A-110
        $var_120 = '';
        if(isset($fields['years_in_profession'])) {
            $var_120 = $fields['years_in_profession'];
        }
        $ret_str .= fillWithBlank(2, $var_120);                     // 04A-120
        $var_060 = '';
        if(isset($fields['position_title_type_of_business'])) {
            $var_130 = $fields['position_title_type_of_business'];
        }
        $ret_str .= fillWithBlank(25, $var_130);                    // 04A-130
        $var_140 = '';
        if(isset($fields['phone_number'])) {
            $var_140 = extractOnlyDigits($fields['phone_number']);
        }
        $ret_str .= fillWithBlank(10, $var_140);                    // 04A-140
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write04BToFNM')) {
    function write04BToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        if(isset($fields[$prefix . 'borrower_employment'])) {
            foreach($fields[$prefix . 'borrower_employment'] as $employment) {
                if(!isset($employment['currently_employed']) || $employment['currently_employed'] != 'true') {
                    write04BSubToFNM($ret_arr, $ssn, $employment);
                }
            }

        }
    }
}
if (! function_exists('write04BSubToFNM')) {
    function write04BSubToFNM(&$ret_arr, $ssn, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '04B');                        // 04B-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 04B-020
        $var_030 = '';
        if(isset($fields['name'])) {
            $var_030 = $fields['name'];
        }
        $ret_str .= fillWithBlank(35, $var_030);                    // 04B-030
        $var_040 = '';
        if(isset($fields['address_1'])) {
            $var_040 = $fields['address_1'];
        }
        if(isset($fields['address_2'])) {
            $var_040 .= ', ' . $fields['address_2'];
        }
        $var_040 = trim($var_040, ', ');
        $ret_str .= fillWithBlank(35, $var_040);                    // 04B-040
        $var_050 = '';
        if(isset($fields['city'])) {
            $var_050 = $fields['city'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 04B-050
        $var_060 = '';
        if(isset($fields['state'])) {
            $var_060 = $fields['state'];
        }
        $ret_str .= fillWithBlank(2, $var_060);                     // 04B-060
        $var_070 = '';
        if(isset($fields['zip_code'])) {
            $var_070 = $fields['zip_code'];
        }
        $ret_str .= fillWithBlank(5, $var_070);                     // 04B-070
        $ret_str .= fillWithBlank(4);                               // 04B-080
        $var_090 = '';
        if(isset($fields['self_employed'])) {
            switch($fields['self_employed']) {
                case 'yes':             $var_090 = 'Y'; break;
                case 'no':              $var_090 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_090);                     // 04B-090
        $var_100 = 'N';
        if(isset($fields['currently_employed']) && $fields['currently_employed'] == 'true') {
            $var_100 = 'Y';
        }
        $ret_str .= fillWithBlank(1, $var_100);                     // 04B-100
        $var_110 = '';
        if(isset($fields['start_date'])) {
            $var_110 = formatDate($fields['start_date']);
        }
        $ret_str .= fillWithBlank(8, $var_110);                     // 04A-110
        $var_120 = '';
        if($var_100 == 'N' && isset($fields['end_date'])) {
            $var_120 = formatDate($fields['end_date']);
        }
        $ret_str .= fillWithBlank(8, $var_120);                     // 04A-120
        $ret_str .= fillWithBlank(15);                              // 04A-130
        $var_140 = '';
        if(isset($fields['position_title_type_of_business'])) {
            $var_140 = $fields['position_title_type_of_business'];
        }
        $ret_str .= fillWithBlank(25, $var_140);                    // 04A-140
        $var_150 = '';
        if(isset($fields['phone_number'])) {
            $var_150 = extractOnlyDigits($fields['phone_number']);
        }
        $ret_str .= fillWithBlank(10, $var_150);                    // 04A-150
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write05HToFNM')) {
    function write05HToFNM(&$ret_arr, $fields) {
        $ssn = '';
        if(isset($fields['borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields['borrower_info_social_security_number']);
        }
        $ids = ['25', '26', '22', '01', '14', '02', '06', '23'];
        $keys = ['rent', 'first_mortgage', 'other_financing', 'hazard_insurance', 'real_estate_taxes',
                'mortgage_insurance', 'hoa_dues', 'other'];
        for($i = 0; $i < 8; $i ++) {
            write05HSubToFNM($ret_arr, $fields, $ssn, '1', $ids[$i], $keys[$i]);
        }
        for($i = 1; $i < 8; $i ++) {
            write05HSubToFNM($ret_arr, $fields, $ssn, '2', $ids[$i], $keys[$i]);
        }
    }
}
if (! function_exists('write05HSubToFNM')) {
    function write05HSubToFNM(&$ret_arr, $fields, $ssn, $indicator, $id, $key) {
        $midfix = '';
        if($indicator == '2') {
            $midfix = 'proposed_';
        }
        if(!isset($fields['financial_combined_' . $midfix . $key])) {
            return;
        }
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '05H');                        // 05H-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 05H-020
        $ret_str .= fillWithBlank(1, $indicator);                   // 05H-030
        $ret_str .= fillWithBlank(2, $id);                          // 05H-040
        $var_050 = formatNumber($fields['financial_combined_' . $midfix . $key], 12, 2);
        $ret_str .= fillWithBlank(15, $var_050);                    // 05H-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write05IToFNM')) {
    function write05IToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        $ids = ['20', '09', '08', '10', '17', '33', '45'];
        $keys = ['base_income', 'overtime', 'bonuses', 'commissions', 'dividends_interest',
                'net_rental_income', 'other'];
        for($i = 0; $i < 7; $i ++) {
            write05ISubToFNM($ret_arr, $fields, $ssn, $ids[$i], $prefix, $keys[$i]);
        }
    }
}
if (! function_exists('write05ISubToFNM')) {
    function write05ISubToFNM(&$ret_arr, $fields, $ssn, $id, $prefix, $suffix) {
        if(!isset($fields[$prefix . 'borrower_income_' . $suffix])) {
            return;
        }
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '05I');                        // 05I-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 05I-020
        $ret_str .= fillWithBlank(2, $id);                          // 05I-020
        $var_040 = formatNumber($fields[$prefix . 'borrower_income_' . $suffix], 12, 2);
        $ret_str .= fillWithBlank(15, $var_040);                    // 05I-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06AToFNM')) {
    function write06AToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06A');                        // 06A-010
        $ret_str .= fillWithBlank(9);                               // 06A-020
        $ret_str .= fillWithBlank(35);                              // 06A-030
        $ret_str .= fillWithBlank(15);                              // 06A-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06BToFNM')) {
    function write06BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '   ');                        // 06A-010
        $ret_str .= fillWithBlank(9);                               // 06A-020
        $ret_str .= fillWithBlank(30);                              // 06A-030
        $ret_str .= fillWithBlank(15);                              // 06A-040
        $ret_str .= fillWithBlank(15);                              // 06A-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06CToFNM')) {
    function write06CToFNM(&$ret_arr, $fields) {
        $ssn = '';
        if(isset($fields['borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields['borrower_info_social_security_number']);
        }
        $has_co_borrower = false;
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            $has_co_borrower = true;
        }
        $cossn = '';
        if($has_co_borrower && isset($fields['coborrower_info_social_security_number'])) {
            $cossn = extractOnlyDigits($fields['coborrower_info_social_security_number']);
        }
        if(isset($fields['financial_liquid'])) {
            foreach($fields['financial_liquid'] as $asset) {
                write06CSubToFNM($ret_arr, $has_co_borrower, $ssn, $cossn, $asset);
            }
        }
        if(isset($fields['financial_other'])) {
            foreach($fields['financial_other'] as $asset) {
                $asset['type'] = 'other-non-liquid';
                write06CSubToFNM($ret_arr, $has_co_borrower, $ssn, $cossn, $asset);
            }
        }
    }
}
if (! function_exists('write06CSubToFNM')) {
    function write06CSubToFNM(&$ret_arr, $has_co_borrower, $ssn, $cossn, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06C');                        // 06C-010
        $var_020 = $ssn;
        if($has_co_borrower && isset($fields['borrower_id']) && $fields['borrower_id'] == 'co-borrower') {
            $var_020 = $cossn;
        }
        $ret_str .= fillWithBlank(9, $var_020);                     // 06C-020
        $var_030 = '';
        if(isset($fields['type'])) {
            switch($fields['type']) {
                case 'savings-account':             $var_030 = 'SG'; break;
                case 'checking-account':            $var_030 = '03'; break;
                case 'stocks':                      $var_030 = '05'; break;
                case 'bonds':                       $var_030 = '06'; break;
                case 'certificate-deposit':         $var_030 = '01'; break;
                case 'money-market-fund':           $var_030 = 'F3'; break;
                case 'mutual-fund':                 $var_030 = 'F4'; break;
                case 'trust-fund':                  $var_030 = '11'; break;
                case 'other':                       $var_030 = 'OL'; break;
                case 'other-non-liquid':            $var_030 = 'M1'; break;
            }
        }
        $ret_str .= fillWithBlank(3, $var_030);                     // 06C-030
        $var_040 = '';
        if($var_030 != 'OL' && $var_030 != 'M1' && isset($fields['name'])) {
            $var_040 = $fields['name'];
        }
        $ret_str .= fillWithBlank(35, $var_040);                    // 06C-040
        $ret_str .= fillWithBlank(35);                              // 06C-050
        $ret_str .= fillWithBlank(35);                              // 06C-060
        $ret_str .= fillWithBlank(2);                               // 06C-070
        $ret_str .= fillWithBlank(5);                               // 06C-080
        $ret_str .= fillWithBlank(4);                               // 06C-090
        $var_100 = '';
        if($var_030 != 'OL' && $var_030 != 'M1' && isset($fields['account_number'])) {
            $var_100 = $fields['account_number'];
        }
        $ret_str .= fillWithBlank(30, $var_100);                    // 06C-100
        $var_110 = '';
        if($var_030 != 'M1' && isset($fields['account_balance'])) {
            $var_110 = formatNumber($fields['account_balance'], 12, 2);
        }
        if($var_030 == 'M1' && isset($fields['value'])) {
            $var_110 = formatNumber($fields['value'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_110);                    // 06C-110
        $ret_str .= fillWithBlank(7);                               // 06C-120
        $ret_str .= fillWithBlank(80);                              // 06C-130
        $ret_str .= fillWithBlank(1);                               // 06C-140
        $ret_str .= fillWithBlank(2);                               // 06C-150
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06DToFNM')) {
    function write06DToFNM(&$ret_arr, $fields) {
        $ssn = '';
        if(isset($fields['borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields['borrower_info_social_security_number']);
        }
        $has_co_borrower = false;
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            $has_co_borrower = true;
        }
        $cossn = '';
        if($has_co_borrower && isset($fields['coborrower_info_social_security_number'])) {
            $cossn = extractOnlyDigits($fields['coborrower_info_social_security_number']);
        }
        if(isset($fields['financial_autos'])) {
            foreach($fields['financial_autos'] as $auto) {
                write06DSubToFNM($ret_arr, $has_co_borrower, $ssn, $cossn, $auto);
            }
        }
    }
}
if (! function_exists('write06DSubToFNM')) {
    function write06DSubToFNM(&$ret_arr, $has_co_borrower, $ssn, $cossn, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06D');                        // 06D-010
        $var_020 = $ssn;
        if($has_co_borrower && isset($fields['borrower_id']) && $fields['borrower_id'] == 'co-borrower') {
            $var_020 = $cossn;
        }
        $ret_str .= fillWithBlank(9, $var_020);                     // 06D-020
        $var_030 = '';
        if(isset($fields['make'])) {
            $var_030 = $fields['make'];
        }
        if(isset($fields['model'])) {
            $var_030 .= ' ' . $fields['model'];
        }
        $var_030 = trim($var_030);
        $ret_str .= fillWithBlank(30, $var_030);                    // 06D-030
        $var_040 = '';
        if(isset($fields['year'])) {
            $var_040 = $fields['year'];
        }
        $ret_str .= fillWithBlank(4, $var_040);                     // 06D-040
        $var_050 = '';
        if(isset($fields['value'])) {
            $var_050 = formatNumber($fields['value'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_050);                    // 06D-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06FToFNM')) {
    function write06FToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06F');                        // 06F-010
        $ret_str .= fillWithBlank(9);                               // 06F-020
        $ret_str .= fillWithBlank(3);                               // 06F-030
        $ret_str .= fillWithBlank(15);                              // 06F-040
        $ret_str .= fillWithBlank(3);                               // 06F-050
        $ret_str .= fillWithBlank(60);                              // 06F-060
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06GToFNM')) {
    function write06GToFNM(&$ret_arr, $fields) {
        $ssn = '';
        if(isset($fields['borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields['borrower_info_social_security_number']);
        }
        $has_co_borrower = false;
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            $has_co_borrower = true;
        }
        $cossn = '';
        if($has_co_borrower && isset($fields['coborrower_info_social_security_number'])) {
            $cossn = extractOnlyDigits($fields['coborrower_info_social_security_number']);
        }
        if(isset($fields['financial_estate'])) {
            foreach($fields['financial_estate'] as $estate) {
                write06GSubToFNM($ret_arr, $has_co_borrower, $ssn, $cossn, $estate);
            }
        }
    }
}
if (! function_exists('write06GSubToFNM')) {
    function write06GSubToFNM(&$ret_arr, $has_co_borrower, $ssn, $cossn, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06G');                        // 06G-010
        $var_020 = $ssn;
        if($has_co_borrower && isset($fields['borrower_id']) && $fields['borrower_id'] == 'co-borrower') {
            $var_020 = $cossn;
        }
        $ret_str .= fillWithBlank(9, $var_020);                     // 06G-020
        $var_030 = '';
        if(isset($fields['address_1'])) {
            $var_030 = $fields['address_1'];
        }
        if(isset($fields['address_2'])) {
            $var_030 .= ', ' . $fields['address_2'];
        }
        $var_030 = trim($var_030, ', ');
        $ret_str .= fillWithBlank(35, $var_030);                    // 06G-030
        $var_040 = '';
        if(isset($fields['city'])) {
            $var_040 = $fields['city'];
        }
        $ret_str .= fillWithBlank(35, $var_040);                    // 06G-040
        $var_050 = '';
        if(isset($fields['state'])) {
            $var_050 = $fields['state'];
        }
        $ret_str .= fillWithBlank(2, $var_050);                     // 06G-050
        $var_060 = '';
        if(isset($fields['zip_code'])) {
            $var_060 = $fields['zip_code'];
        }
        $ret_str .= fillWithBlank(5, $var_060);                     // 06G-060
        $ret_str .= fillWithBlank(4);                               // 06G-070
        $var_080 = '';
        if(isset($fields['status'])) {
            switch($fields['status']) {
                case 'sold':                        $var_080 = 'S'; break;
                case 'pending-sale':                $var_080 = 'P'; break;
                case 'rental':                      $var_080 = 'R'; break;
                case 'retained':                    $var_080 = 'H'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_080);                     // 06G-080
        $var_090 = '';
        if(isset($fields['type_of_property'])) {
            switch($fields['type_of_property']) {
                case 'single-family-residence':     $var_090 = '14'; break;
                case 'two-to-fourplex':             $var_090 = '15'; break;
                case 'commercial-non-residential':  $var_090 = '02'; break;
                case 'commercial-residential':      $var_090 = '03'; break;
                case 'condominium':                 $var_090 = '04'; break;
                case 'co-op':                       $var_090 = '13'; break;
                case 'farm':                        $var_090 = '05'; break;
                case 'land':                        $var_090 = '07'; break;
                case 'mixed-use-property':          $var_090 = 'F1'; break;
                case 'mobile-home':                 $var_090 = '08'; break;
                case 'multi-family-property':       $var_090 = '18'; break;
                case 'townhouse':                   $var_090 = '16'; break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_090);                     // 06G-090
        $var_100 = '';
        if(isset($fields['present_market_value'])) {
            $var_100 = formatNumber($fields['present_market_value'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_100);                    // 06G-100
        $var_110 = '';
        if(isset($fields['amount_of_mortgages_and_liens'])) {
            $var_110 = formatNumber($fields['amount_of_mortgages_and_liens'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_110);                    // 06G-110
        $var_120 = '';
        if(isset($fields['gross_rental_income'])) {
            $var_120 = formatNumber($fields['gross_rental_income'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_120);                    // 06G-120
        $var_130 = '';
        if(isset($fields['mortgage_payments'])) {
            $var_130 = formatNumber($fields['mortgage_payments'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_130);                    // 06G-130
        $var_140 = '';
        if(isset($fields['insurance_maintenance_taxes_misc'])) {
            $var_140 = formatNumber($fields['insurance_maintenance_taxes_misc'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_140);                    // 06G-140
        $var_150 = '';
        if(isset($fields['net_rental_income'])) {
            $var_150 = formatNumber($fields['net_rental_income'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_150);                    // 06G-150
        $ret_str .= fillWithBlank(1);                               // 06G-160
        $ret_str .= fillWithBlank(1);                               // 06G-170
        $ret_str .= fillWithBlank(2);                               // 06G-180
        $ret_str .= fillWithBlank(15);                              // 06G-190
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06HToFNM')) {
    function write06HToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06H');                        // 06H-010
        $ret_str .= fillWithBlank(9);                               // 06H-020
        $ret_str .= fillWithBlank(35);                              // 06H-030
        $ret_str .= fillWithBlank(35);                              // 06H-040
        $ret_str .= fillWithBlank(35);                              // 06H-050
        $ret_str .= fillWithBlank(35);                              // 06H-060
        $ret_str .= fillWithBlank(30);                              // 06H-070
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06LToFNM')) {
    function write06LToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06L');                        // 06L-010
        $ret_str .= fillWithBlank(9);                               // 06L-020
        $ret_str .= fillWithBlank(2);                               // 06L-030
        $ret_str .= fillWithBlank(35);                              // 06L-040
        $ret_str .= fillWithBlank(35);                              // 06L-050
        $ret_str .= fillWithBlank(35);                              // 06L-060
        $ret_str .= fillWithBlank(2);                               // 06L-070
        $ret_str .= fillWithBlank(5);                               // 06L-080
        $ret_str .= fillWithBlank(4);                               // 06L-090
        $ret_str .= fillWithBlank(30);                              // 06L-100
        $ret_str .= fillWithBlank(15);                              // 06L-110
        $ret_str .= fillWithBlank(3);                               // 06L-120
        $ret_str .= fillWithBlank(15);                              // 06L-130
        $ret_str .= fillWithBlank(1);                               // 06L-140
        $ret_str .= fillWithBlank(2);                               // 06L-150
        $ret_str .= fillWithBlank(1);                               // 06L-160
        $ret_str .= fillWithBlank(1);                               // 06L-170
        $ret_str .= fillWithBlank(1);                               // 06L-180
        $ret_str .= fillWithBlank(1);                               // 06L-190
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write06SToFNM')) {
    function write06SToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '06S');                        // 06S-010
        $ret_str .= fillWithBlank(9);                               // 06S-020
        $ret_str .= fillWithBlank(3);                               // 06S-030
        $ret_str .= fillWithBlank(15);                              // 06S-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write07AToFNM')) {
    function write07AToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '07A');                        // 07A-010
        $var_020 = '';
        if(isset($fields['property_purpose_purchase_price'])) {
            $var_020 = formatNumber($fields['property_purpose_purchase_price'], 12, 2);
        }
        $ret_str .= fillWithBlank(15, $var_020);                    // 07A-020
        $ret_str .= fillWithBlank(15);                              // 07A-030
        $ret_str .= fillWithBlank(15);                              // 07A-040
        $ret_str .= fillWithBlank(15);                              // 07A-050
        $ret_str .= fillWithBlank(15);                              // 07A-060
        $ret_str .= fillWithBlank(15);                              // 07A-070
        $ret_str .= fillWithBlank(15);                              // 07A-080
        $ret_str .= fillWithBlank(15);                              // 07A-090
        $ret_str .= fillWithBlank(15);                              // 07A-100
        $ret_str .= fillWithBlank(15);                              // 07A-110
        $ret_str .= fillWithBlank(15);                              // 07A-120
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write07BToFNM')) {
    function write07BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '07B');                        // 07B-010
        $ret_str .= fillWithBlank(2);                               // 07B-020
        $ret_str .= fillWithBlank(15);                              // 07B-020
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write08AToFNM')) {
    function write08AToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        write08ASubToFNM($ret_arr, $fields, $ssn, $prefix);
    }
}
if (! function_exists('write08ASubToFNM')) {
    function write08ASubToFNM(&$ret_arr, $fields, $ssn, $midfix) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '08A');                        // 08A-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 08A-020
        $var_030 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_outstanding_judgement'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_outstanding_judgement']) {
                case 'yes':                 $var_030 = 'Y'; break;
                case 'no':                  $var_030 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_030);                     // 08A-030
        $var_040 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_bankrupt_last_seven_years'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_bankrupt_last_seven_years']) {
                case 'yes':                 $var_040 = 'Y'; break;
                case 'no':                  $var_040 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_040);                     // 08A-040
        $var_050 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_property_foreclosure_last_seven_years'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_property_foreclosure_last_seven_years']) {
                case 'yes':                 $var_050 = 'Y'; break;
                case 'no':                  $var_050 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_050);                     // 08A-050
        $var_060 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_party_to_a_lawsuit'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_party_to_a_lawsuit']) {
                case 'yes':                 $var_060 = 'Y'; break;
                case 'no':                  $var_060 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_060);                     // 08A-060
        $var_070 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_obligated_on_loan'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_obligated_on_loan']) {
                case 'yes':                 $var_070 = 'Y'; break;
                case 'no':                  $var_070 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_070);                     // 08A-070
        $var_080 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_delinquent_default_loan'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_delinquent_default_loan']) {
                case 'yes':                 $var_080 = 'Y'; break;
                case 'no':                  $var_080 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_080);                     // 08A-080
        $var_090 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_alimony_child_support_separate_maintenance'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_alimony_child_support_separate_maintenance']) {
                case 'yes':                 $var_090 = 'Y'; break;
                case 'no':                  $var_090 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_090);                     // 08A-090
        $var_100 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_down_payment_borrowed'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_down_payment_borrowed']) {
                case 'yes':                 $var_100 = 'Y'; break;
                case 'no':                  $var_100 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_100);                     // 08A-100
        $var_110 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_co_maker_endorser_on_a_note'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_co_maker_endorser_on_a_note']) {
                case 'yes':                 $var_110 = 'Y'; break;
                case 'no':                  $var_110 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_110);                     // 08A-110
        $var_120 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_us_citizen'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_us_citizen']) {
                case 'yes':                 $var_120 = '01'; break;
                case 'no':
                    if(isset($fields['disclosures_' . $midfix . 'borrower_permanent_resident_alien'])) {
                        switch($fields['disclosures_' . $midfix . 'borrower_permanent_resident_alien']) {
                            case 'yes':     $var_120 = '03'; break;
                            case 'no':      $var_120 = '05'; break;
                        }
                    }
                    break;
            }
        }
        $ret_str .= fillWithBlank(2, $var_120);                     // 08A-120
        $var_130 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_primary_residence'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_primary_residence']) {
                case 'yes':                 $var_130 = 'Y'; break;
                case 'no':                  $var_130 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_130);                     // 08A-130
        $var_140 = '';
        if(isset($fields['disclosures_' . $midfix . 'borrower_ownership_interest'])) {
            switch($fields['disclosures_' . $midfix . 'borrower_ownership_interest']) {
                case 'yes':                 $var_140 = 'Y'; break;
                case 'no':                  $var_140 = 'N'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_140);                     // 08A-140
        $var_150 = '';
        if($var_140 == 'Y' && isset($fields['property_purpose_property_will_be'])) {
            switch($fields['property_purpose_property_will_be']) {
                case 'primary-residence':   $var_150 = '1'; break;
                case 'secondary-residence': $var_150 = '2'; break;
                case 'investment':          $var_150 = 'D'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_150);                     // 08A-150
        $ret_str .= fillWithBlank(2);                               // 08A-160
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write08BToFNM')) {
    function write08BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '08B');                        // 08B-010
        $ret_str .= fillWithBlank(9);                               // 08B-020
        $ret_str .= fillWithBlank(2);                               // 08B-030
        $ret_str .= fillWithBlank(255);                             // 08B-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write09AToFNM')) {
    function write09AToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '09A');                        // 09A-010
        $ret_str .= fillWithBlank(9);                               // 09A-020
        $ret_str .= fillWithBlank(8);                               // 09A-030
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write10AToFNM')) {
    function write10AToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        write10ASubToFNM($ret_arr, $fields, $ssn, $prefix);
    }
}
if (! function_exists('write10ASubToFNM')) {
    function write10ASubToFNM(&$ret_arr, $fields, $ssn, $midfix) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '10A');                        // 10A-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 10A-020
        $ret_str .= fillWithBlank(1, 'N');                          // 10A-030
        $var_040 = '';
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_hispanic_or_latino']) && $fields['disclosures_demographic_' . $midfix . 'borrower_hispanic_or_latino'] == 'true') {
            $var_040 = '1';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_not_hispanic_or_latino']) && $fields['disclosures_demographic_' . $midfix . 'borrower_not_hispanic_or_latino'] == 'true') {
            $var_040 = '2';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_ethnicity_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_ethnicity_information'] == 'true') {
            $var_040 = '3';
        }
        $ret_str .= fillWithBlank(1, $var_040);                     // 10A-040
        $ret_str .= fillWithBlank(30);                              // 10A-050
        $var_060 = '';
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_m']) && $fields['disclosures_demographic_' . $midfix . 'borrower_m'] == 'true') {
            $var_060 = 'M';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_f']) && $fields['disclosures_demographic_' . $midfix . 'borrower_f'] == 'true') {
            $var_060 = 'F';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_sex_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_sex_information'] == 'true') {
            $var_060 = 'I';
        }
        $ret_str .= fillWithBlank(1, $var_060);                     // 10A-060
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write10BToFNM')) {
    function write10BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '10B');                        // 10B-010
        $ret_str .= fillWithBlank(1, 'I');                          // 10B-020
        $ret_str .= fillWithBlank(60);                              // 10B-030
        $ret_str .= fillWithBlank(8);                               // 10B-040
        $ret_str .= fillWithBlank(10);                              // 10B-050
        $ret_str .= fillWithBlank(35);                              // 10B-060
        $ret_str .= fillWithBlank(35);                              // 10B-070
        $ret_str .= fillWithBlank(35);                              // 10B-080
        $ret_str .= fillWithBlank(35);                              // 10B-090
        $ret_str .= fillWithBlank(2);                               // 10B-100
        $ret_str .= fillWithBlank(5);                               // 10B-110
        $ret_str .= fillWithBlank(4);                               // 10B-120
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write10RToFNM')) {
    function write10RToFNM(&$ret_arr, $fields, $prefix = '') {
        $ssn = '';
        if(isset($fields[$prefix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$prefix . 'borrower_info_social_security_number']);
        }
        write10RSubToFNM($ret_arr, $fields, $ssn, $prefix);
    }
}
if (! function_exists('write10RSubToFNM')) {
    function write10RSubToFNM(&$ret_arr, $fields, $ssn, $midfix) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '10R');                        // 10R-010
        $ret_str .= fillWithBlank(9, $ssn);                         // 10R-020
        $var_030 = '';
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_race_text_hdma1']) && $fields['disclosures_demographic_' . $midfix . 'borrower_race_text_hdma1'] == 'true') {
            $var_030 = '1';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_asian']) && $fields['disclosures_demographic_' . $midfix . 'borrower_asian'] == 'true') {
            $var_030 = '2';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_black_or_african_american']) && $fields['disclosures_demographic_' . $midfix . 'borrower_black_or_african_american'] == 'true') {
            $var_030 = '3';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_native_hawaiian_or_other_pacific_islander']) && $fields['disclosures_demographic_' . $midfix . 'borrower_native_hawaiian_or_other_pacific_islander'] == 'true') {
            $var_030 = '4';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_white']) && $fields['disclosures_demographic_' . $midfix . 'borrower_white'] == 'true') {
            $var_030 = '5';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_race_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_race_information'] == 'true') {
            $var_030 = '6';
        }
        $ret_str .= fillWithBlank(2, $var_030);                     // 10R-030
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write99BToFNM')) {
    function write99BToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '99B');                        // 99B-010
        $ret_str .= fillWithBlank(1, 'N');                          // 99B-020
        $ret_str .= fillWithBlank(2);                               // 99B-030
        $var_040 = formatNumber('0', 12, 2);
        $ret_str .= fillWithBlank(15, $var_040);                    // 99B-040
        $ret_str .= fillWithBlank(7);                               // 99B-050
        $ret_str .= fillWithBlank(2);                               // 99B-060
        $ret_str .= fillWithBlank(3);                               // 99B-070
        $ret_str .= fillWithBlank(60);                              // 99B-080
        $ret_str .= fillWithBlank(35);                              // 99B-090
        $ret_str .= fillWithBlank(15);                              // 99B-100
        $ret_str .= fillWithBlank(2);                               // 99B-110
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeADSToFNM')) {
    function writeADSToFNM(&$ret_arr, $fields) {
        $ssn = '';
        if(isset($fields['borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields['borrower_info_social_security_number']);
        }
        $has_co_borrower = false;
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            $has_co_borrower = true;
        }
        $cossn = '';
        if($has_co_borrower && isset($fields['coborrower_info_social_security_number'])) {
            $cossn = extractOnlyDigits($fields['coborrower_info_social_security_number']);
        }

        writeADSEthnicityToFNM($ret_arr, $fields, $ssn);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeADSEthnicityToFNM($ret_arr, $fields, $cossn, 'co');
        }
        writeADSRaceToFNM($ret_arr, $fields, $ssn);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeADSRaceToFNM($ret_arr, $fields, $cossn, 'co');
        }
        writeADSGenderToFNM($ret_arr, $fields, $ssn);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeADSGenderToFNM($ret_arr, $fields, $cossn, 'co');
        }
    }
}
if (! function_exists('writeADSEthnicityToFNM')) {
    function writeADSEthnicityToFNM(&$ret_arr, $fields, $ssn, $midfix = '') {
        writeADSSubToFNM($ret_arr, 'ApplicationTakenMethodType', [
            $ssn, 'Internet'
        ]);
        $ethnicityRefusal = 'Y';
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_hispanic_or_latino']) && $fields['disclosures_demographic_' . $midfix . 'borrower_hispanic_or_latino'] == 'true') {
            $ethnicityRefusal = 'N';
            writeADSSubToFNM($ret_arr, 'HMDAEthnicityType', [
                $ssn, 'HispanicOrLatino'
            ]);
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_not_hispanic_or_latino']) && $fields['disclosures_demographic_' . $midfix . 'borrower_not_hispanic_or_latino'] == 'true') {
            $ethnicityRefusal = 'N';
            writeADSSubToFNM($ret_arr, 'HMDAEthnicityType', [
                $ssn, 'NotHispanicOrLatino'
            ]);
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_ethnicity_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_ethnicity_information'] == 'true') {
            $ethnicityRefusal = 'Y';
        } else if($ethnicityRefusal == 'Y') {
            writeADSSubToFNM($ret_arr, 'HMDAEthnicityType', [
                $ssn, 'InformationNotProvidedByApplicantInMIT'
            ]);
        }
        writeADSSubToFNM($ret_arr, 'HMDAEthnicityRefusalIndicator', [
            $ssn, $ethnicityRefusal
        ]);

        $keys = ['borrower_mexican', 'borrower_puerto_rican', 'borrower_cuban', 'borrower_other'];
        $names = ['Mexican', 'PuertoRican', 'Cuban', 'Other'];
        for($i = 0; $i < 4; $i ++) {
            if(isset($fields['disclosures_demographic_' . $midfix . $keys[$i]]) && $fields['disclosures_demographic_' . $midfix . $keys[$i]] == 'true') {
                writeADSSubToFNM($ret_arr, 'HMDAEthnicityOriginType', [
                    $ssn, $names[$i]
                ]);
            }
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_ethnicity_text_hdma1'])) {
            writeADSSubToFNM($ret_arr, 'HMDAEthnicityOriginTypeOtherDesc', [
                $ssn, $fields['disclosures_demographic_' . $midfix . 'borrower_ethnicity_text_hdma1']
            ]);
        }
    }
}
if (! function_exists('writeADSRaceToFNM')) {
    function writeADSRaceToFNM(&$ret_arr, $fields, $ssn, $midfix = '') {
        $humanGroups = array();
        $lastHumanID = 0;

        $raceRefusal = 'Y';
        $raceKeys = ['borrower_american_indian_or_alaska_native', 'borrower_asian', 'borrower_black_or_african_american',
                    'borrower_native_hawaiian_or_other_pacific_islander', 'borrower_white'];
        $raceNames = ['AmericanIndianOrAlaskaNative', 'Asian', 'BlackOrAfricanAmerican',
                    'NativeHawaiianOrOtherPacificIslander', 'White'];
        $raceHumans = ['american', 'asian', 'black', 'pacifician', 'white'];
        for($i = 0; $i < 5; $i ++) {
            if(isset($fields['disclosures_demographic_' . $midfix . $raceKeys[$i]]) && $fields['disclosures_demographic_' . $midfix . $raceKeys[$i]] == 'true') {
                if(!isset($humanGroups[$raceHumans[$i]])) {
                    $humanGroups[$raceHumans[$i]] = ++ $lastHumanID;
                }
                writeADSSubToFNM($ret_arr, 'HMDARaceType', [
                    $ssn, $humanGroups[$raceHumans[$i]], $raceNames[$i]
                ]);
                $raceRefusal = 'N';
            }
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_race_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_race_information'] == 'true') {
            $raceRefusal = 'Y';
        } else if($raceRefusal == 'Y') {
            writeADSSubToFNM($ret_arr, 'HMDARaceType', [
                $ssn, 'InformationNotProvidedByApplicantInMIT'
            ]);
        }
        writeADSSubToFNM($ret_arr, 'HMDARaceRefusalIndicator', [
            $ssn, $raceRefusal
        ]);

        $raceOtherKeys = ['borrower_asian_indian', 'borrower_chinese', 'borrower_filipino', 'borrower_japanese',
                        'borrower_korean', 'borrower_vietnamese', 'borrower_other_asian', 'borrower_native_hawaiian',
                        'borrower_guamanian_or_chamorro', 'borrower_samoan', 'borrower_other_pacific_islander'];
        $raceOtherNames = ['AsianIndian', 'Chinese', 'Filipino', 'Japanese', 'Korean', 'Vietnamese','OtherAsian',
                        'NativeHawaiian', 'GuamanianOrChamorro', 'Samoan', 'OtherPacificIslander'];
        $raceOtherHumans = ['asian', 'asian', 'asian', 'asian', 'asian', 'asian', 'asian',
                            'pacifician', 'pacifician', 'pacifician', 'pacifician'];
        for($i = 0; $i < 11; $i ++) {
            if(isset($fields['disclosures_demographic_' . $midfix . $raceOtherKeys[$i]]) && $fields['disclosures_demographic_' . $midfix . $raceOtherKeys[$i]] == 'true') {
                if(!isset($humanGroups[$raceOtherHumans[$i]])) {
                    $humanGroups[$raceOtherHumans[$i]] = ++ $lastHumanID;
                }
                writeADSSubToFNM($ret_arr, 'HMDARaceDesignationType', [
                    $ssn, $humanGroups[$raceOtherHumans[$i]], $raceOtherNames[$i]
                ]);
            }
        }

        $otherKeys = ['borrower_race_text_hdma1', 'borrower_race_text_asian_hdma1', 'borrower_race_text_islander_hdma1'];
        $otherHumans = ['american', 'asian', 'pacifician'];
        $otherFields = ['HMDARaceTypeAdditionalDescription', 'HMDARaceDesignationOtherAsnDesc', 'HMDARaceDesignationOtherPIDesc'];
        for($i = 0; $i < 3; $i ++) {
            if(isset($fields['disclosures_demographic_' . $midfix . $otherKeys[$i]])) {
                if(!isset($humanGroups[$otherHumans[$i]])) {
                    $humanGroups[$otherHumans[$i]] = ++ $lastHumanID;
                }
                writeADSSubToFNM($ret_arr, $otherFields[$i], [
                    $ssn, $humanGroups[$otherHumans[$i]], $fields['disclosures_demographic_' . $midfix . $otherKeys[$i]]
                ]);
            }
        }
    }
}
if (! function_exists('writeADSGenderToFNM')) {
    function writeADSGenderToFNM(&$ret_arr, $fields, $ssn, $midfix = '') {
        $genderRefusal = 'Y';
        $m_check = 'N'; $f_check = 'N'; $n_check = 'N';
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_m']) && $fields['disclosures_demographic_' . $midfix . 'borrower_m'] == 'true') {
            $m_check = 'Y';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_f']) && $fields['disclosures_demographic_' . $midfix . 'borrower_f'] == 'true') {
            $f_check = 'Y';
        }
        if(isset($fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_sex_information']) && $fields['disclosures_demographic_' . $midfix . 'borrower_i_do_not_wish_to_provide_sex_information'] == 'true') {
            $n_check = 'Y';
        }

        if($m_check == 'Y' && $f_check == 'N' && $n_check == 'N') {
            writeADSSubToFNM($ret_arr, 'HMDAGenderType', [
                $ssn, 'Male'
            ]);
            $genderRefusal = 'N';
        }
        else if($f_check == 'Y' && $m_check == 'N' && $n_check == 'N') {
            writeADSSubToFNM($ret_arr, 'HMDAGenderType', [
                $ssn, 'Feale'
            ]);
            $genderRefusal = 'N';
        } else if($m_check != 'N' && $f_check != 'N' && $n_check != 'Y') {
            writeADSSubToFNM($ret_arr, 'HMDAGenderType', [
                $ssn, 'InformationNotProvidedUnknown'
            ]);
        }
        writeADSSubToFNM($ret_arr, 'HMDAGenderRefusalIndicator', [
            $ssn, $genderRefusal
        ]);
    }
}
if (! function_exists('writeADSSubToFNM')) {
    function writeADSSubToFNM(&$ret_arr, $key, $values) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'ADS');                        // ADS-010
        $ret_str .= fillWithBlank(35, $key);                        // ADS-020
        $var_030 = implode(':', $values);
        $ret_str .= fillWithBlank(50, $var_030);                    // ADS-030
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeSCAToFNM')) {
    function writeSCAToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'SCA');                        // SCA-010
        $ret_str .= fillWithBlank(3);                               // SCA-020
        $ret_str .= fillWithBlank(3);                               // SCA-030
        $ret_str .= fillWithBlank(8);                               // SCA-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeLNCToFNM')) {
    function writeLNCToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'LNC');                        // LNC-010
        $ret_str .= fillWithBlank(1);                               // LNC-020
        $ret_str .= fillWithBlank(1);                               // LNC-030
        $ret_str .= fillWithBlank(2);                               // LNC-040
        $ret_str .= fillWithBlank(2);                               // LNC-050
        $ret_str .= fillWithBlank(2);                               // LNC-060
        $ret_str .= fillWithBlank(2);                               // LNC-070
        $ret_str .= fillWithBlank(2);                               // LNC-080
        $ret_str .= fillWithBlank(2);                               // LNC-090
        $ret_str .= fillWithBlank(7);                               // LNC-100
        $ret_str .= fillWithBlank(1);                               // LNC-110
        $ret_str .= fillWithBlank(1);                               // LNC-120
        $ret_str .= fillWithBlank(1);                               // LNC-130
        $ret_str .= fillWithBlank(1);                               // LNC-140
        $ret_str .= fillWithBlank(7);                               // LNC-150
        $ret_str .= fillWithBlank(7);                               // LNC-160
        $ret_str .= fillWithBlank(15);                              // LNC-170
        $ret_str .= fillWithBlank(1);                               // LNC-180
        $ret_str .= fillWithBlank(8);                               // LNC-190
        $ret_str .= fillWithBlank(8);                               // LNC-200
        $ret_str .= fillWithBlank(7);                               // LNC-210
        $ret_str .= fillWithBlank(3);                               // LNC-220
        $ret_str .= fillWithBlank(5);                               // LNC-230
        $ret_str .= fillWithBlank(1);                               // LNC-240
        $ret_str .= fillWithBlank(1);                               // LNC-250
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writePIDToFNM')) {
    function writePIDToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'PID');                        // PID-010
        $ret_str .= fillWithBlank(30);                              // PID-020
        $ret_str .= fillWithBlank(15);                              // PID-030
        $ret_str .= fillWithBlank(5);                               // PID-040
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writePCHToFNM')) {
    function writePCHToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'PCH');                        // PCH-010
        $ret_str .= fillWithBlank(3);                               // PCH-020
        $ret_str .= fillWithBlank(1);                               // PCH-030
        $ret_str .= fillWithBlank(2);                               // PCH-040
        $ret_str .= fillWithBlank(1);                               // PCH-050
        $ret_str .= fillWithBlank(1);                               // PCH-060
        $ret_str .= fillWithBlank(2);                               // PCH-070
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeARMToFNM')) {
    function writeARMToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'ARM');                        // ARM-010
        $ret_str .= fillWithBlank(7);                               // ARM-020
        $ret_str .= fillWithBlank(2);                               // ARM-030
        $ret_str .= fillWithBlank(7);                               // ARM-040
        $ret_str .= fillWithBlank(7);                               // ARM-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writePAJToFNM')) {
    function writePAJToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'PAJ');                        // PAJ-010
        $ret_str .= fillWithBlank(4);                               // PAJ-020
        $ret_str .= fillWithBlank(3);                               // PAJ-030
        $ret_str .= fillWithBlank(3);                               // PAJ-040
        $ret_str .= fillWithBlank(1);                               // PAJ-050
        $ret_str .= fillWithBlank(7);                               // PAJ-060
        $ret_str .= fillWithBlank(15);                              // PAJ-070
        $ret_str .= fillWithBlank(7);                               // PAJ-080
        $ret_str .= fillWithBlank(15);                              // PAJ-090
        $ret_str .= fillWithBlank(3);                               // PAJ-100
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeRAJToFNM')) {
    function writeRAJToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'RAJ');                        // RAJ-010
        $ret_str .= fillWithBlank(4);                               // RAJ-020
        $ret_str .= fillWithBlank(3);                               // RAJ-030
        $ret_str .= fillWithBlank(3);                               // RAJ-040
        $ret_str .= fillWithBlank(1);                               // RAJ-050
        $ret_str .= fillWithBlank(7);                               // RAJ-060
        $ret_str .= fillWithBlank(7);                               // RAJ-070
        $ret_str .= fillWithBlank(3);                               // RAJ-080
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeBUAToFNM')) {
    function writeBUAToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'BUA');                        // BUA-010
        $ret_str .= fillWithBlank(3);                               // BUA-020
        $ret_str .= fillWithBlank(3);                               // BUA-030
        $ret_str .= fillWithBlank(7);                               // BUA-040
        $ret_str .= fillWithBlank(1);                               // BUA-050
        $ret_str .= fillWithBlank(1);                               // BUA-060
        $ret_str .= fillWithBlank(1);                               // BUA-070
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeIDAToFNM')) {
    function writeIDAToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'IDA');                        // IDA-010
        $ret_str .= fillWithBlank(23);                              // IDA-020
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeLEAToFNM')) {
    function writeLEAToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'LEA');                        // LEA-010
        $ret_str .= fillWithBlank(20);                              // LEA-020
        $ret_str .= fillWithBlank(20);                              // LEA-030
        $ret_str .= fillWithBlank(10);                              // LEA-040
        $ret_str .= fillWithBlank(13);                              // LEA-050
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeGOAToFNM')) {
    function writeGOAToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'GOA');                        // GOA-010
        $ret_str .= fillWithBlank(1);                               // GOA-020
        $ret_str .= fillWithBlank(15);                              // GOA-030
        $ret_str .= fillWithBlank(15);                              // GOA-040
        $ret_str .= fillWithBlank(15);                              // GOA-050
        $ret_str .= fillWithBlank(7);                               // GOA-060
        $ret_str .= fillWithBlank(15);                              // GOA-070
        $ret_str .= fillWithBlank(7);                               // GOA-080
        $ret_str .= fillWithBlank(15);                              // GOA-090
        $ret_str .= fillWithBlank(7);                               // GOA-100
        $ret_str .= fillWithBlank(1);                               // GOA-110
        $ret_str .= fillWithBlank(35);                              // GOA-120
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeGOBToFNM')) {
    function writeGOBToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'GOB');                        // GOB-010
        $ret_str .= fillWithBlank(13);                              // GOB-020
        $ret_str .= fillWithBlank(15);                              // GOB-030
        $ret_str .= fillWithBlank(7);                               // GOB-040
        $ret_str .= fillWithBlank(15);                              // GOB-050
        $ret_str .= fillWithBlank(7);                               // GOB-060
        $ret_str .= fillWithBlank(3);                               // GOB-070
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeGOCToFNM')) {
    function writeGOCToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'GOC');                        // GOC-010
        $ret_str .= fillWithBlank(1);                               // GOC-020
        $ret_str .= fillWithBlank(15);                              // GOC-030
        $ret_str .= fillWithBlank(7);                               // GOC-040
        $ret_str .= fillWithBlank(7);                               // GOC-050
        $ret_str .= fillWithBlank(7);                               // GOC-060
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeGODToFNM')) {
    function writeGODToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'GOD');                        // GOD-010
        $ret_str .= fillWithBlank(9);                               // GOD-020
        $ret_str .= fillWithBlank(15);                              // GOD-030
        $ret_str .= fillWithBlank(15);                              // GOD-040
        $ret_str .= fillWithBlank(15);                              // GOD-050
        $ret_str .= fillWithBlank(15);                              // GOD-060
        $ret_str .= fillWithBlank(15);                              // GOD-070
        $ret_str .= fillWithBlank(15);                              // GOD-080
        $ret_str .= fillWithBlank(15);                              // GOD-090
        $ret_str .= fillWithBlank(15);                              // GOD-100
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeGOEToFNM')) {
    function writeGOEToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'GOE');                        // GOE-010
        $ret_str .= fillWithBlank(9);                               // GOE-020
        $ret_str .= fillWithBlank(10);                              // GOE-030
        $ret_str .= fillWithBlank(3);                               // GOE-040
        $ret_str .= fillWithBlank(3);                               // GOE-050
        $ret_str .= fillWithBlank(3);                               // GOE-060
        $ret_str .= fillWithBlank(1);                               // GOE-070
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('writeLMDToFNM')) {
    function writeLMDToFNM(&$ret_arr, $fields) {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, 'LMD');                        // LMD-010
        $ret_str .= fillWithBlank(40);                              // LMD-020
        $ret_str .= fillWithBlank(2);                               // LMD-030
        $ret_str .= fillWithBlank(38);                              // LMD-035
        $ret_str .= fillWithBlank(1);                               // LMD-040
        $ret_str .= fillWithBlank(1);                               // LMD-050
        $ret_str .= fillWithBlank(15);                              // LMD-060
        $ret_str .= fillWithBlank(15);                              // LMD-070
        $ret_str .= fillWithBlank(15);                              // LMD-080
        array_push($ret_arr, $ret_str);
    }
}
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

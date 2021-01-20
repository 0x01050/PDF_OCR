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
        $dob = strtotime($birthday);
        $tdate = time();
        return floor(($tdate - $dob) / (60 * 60 * 24 * 365));
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
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'true') {
            write03AToFNM($ret_arr, $fields, 'co');
        }
        write03BToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'true') {
            write03BToFNM($ret_arr, $fields, 'co');
        }
        write03CToFNM($ret_arr, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'true') {
            write03CToFNM($ret_arr, $fields, 'co');
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
                $var_040 = $fields['property_purpose_amount_existing_liens'];
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
    function write03AToFNM(&$ret_arr, $fields, $suffix = '') {
        $ret_str = '';
        $ret_str .= fillWithBlank(3, '03A');                        // 03A-010
        $var_020 = 'BW';
        if($suffix == 'co') {
            $var_020 = 'QZ';
        }
        $ret_str .= fillWithBlank(2, $var_020);                     // 03A-020
        $var_030 = '';
        if(isset($fields[$suffix . 'borrower_info_social_security_number'])) {
            $var_030 = extractOnlyDigits($fields[$suffix . 'borrower_info_social_security_number']);
        }
        $ret_str .= fillWithBlank(9, $var_030);                     // 03A-030
        $var_040 = '';
        if(isset($fields[$suffix . 'borrower_info_first_name'])) {
            $var_040 = $fields[$suffix . 'borrower_info_first_name'];
        }
        $ret_str .= fillWithBlank(35, $var_040);                    // 03A-040
        $var_050 = '';
        if(isset($fields[$suffix . 'borrower_info_middle_name'])) {
            $var_050 = $fields[$suffix . 'borrower_info_middle_name'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 03A-050
        $var_060 = '';
        if(isset($fields[$suffix . 'borrower_info_last_name'])) {
            $var_060 = $fields[$suffix . 'borrower_info_last_name'];
        }
        $ret_str .= fillWithBlank(35, $var_060);                    // 03A-060
        $ret_str .= fillWithBlank(4);                               // 03A-070
        $var_080 = '';
        if(isset($fields[$suffix . 'borrower_info_home_phone'])) {
            $var_080 = extractOnlyDigits($fields[$suffix . 'borrower_info_home_phone']);
        }
        $ret_str .= fillWithBlank(10, $var_080);                    // 03A-080
        $var_090 = '';
        if(isset($fields[$suffix . 'borrower_info_date_of_birth'])) {
            $var_090 = calcAge($fields[$suffix . 'borrower_info_date_of_birth']);
        }
        $ret_str .= fillWithBlank(3, $var_090);                     // 03A-090
        $var_100 = '';
        if(isset($fields[$suffix . 'borrower_info_years_in_school'])) {
            $var_100 = $fields[$suffix . 'borrower_info_years_in_school'];
        }
        $ret_str .= fillWithBlank(2, $var_100);                     // 03A-100
        $var_110 = '';
        if(isset($fields[$suffix . 'borrower_info_marital_status'])) {
            switch($fields[$suffix . 'borrower_info_marital_status']) {
                case 'married':                     $var_110 = 'M'; break;
                case 'unmarried':                   $var_110 = 'U'; break;
                case 'separated':                   $var_110 = 'S'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_110);                     // 03A-110
        $var_120 = '';
        if(isset($fields[$suffix . 'borrower_info_number_of_dependents'])) {
            $var_120 = $fields[$suffix . 'borrower_info_number_of_dependents'];
        }
        $ret_str .= fillWithBlank(2, $var_120);                     // 03A-120
        $var_130 = 'N';
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'true') {
            $var_130 = 'Y';
        }
        $ret_str .= fillWithBlank(1, $var_130);                     // 03A-130
        $var_140 = '';
        if($var_130 == 'Y') {
            if($suffix == '' && isset($fields['coborrower_info_social_security_number'])) {
                $var_140 = $fields['coborrower_info_social_security_number'];
            }
            if($suffix == 'co' && isset($fields['borrower_info_social_security_number'])) {
                $var_140 = $fields['borrower_info_social_security_number'];
            }
        }
        $ret_str .= fillWithBlank(9, $var_140);                     // 03A-140
        $var_150 = '';
        if(isset($fields[$suffix . 'borrower_info_date_of_birth'])) {
            $var_150 = formatDate($fields[$suffix . 'borrower_info_date_of_birth']);
        }
        $ret_str .= fillWithBlank(8, $var_150);                     // 03A-150
        $var_160 = '';
        if(isset($fields[$suffix . 'borrower_info_email'])) {
            $var_160 = $fields[$suffix . 'borrower_info_email'];
        }
        $ret_str .= fillWithBlank(80, $var_160);                    // 03A-160
        array_push($ret_arr, $ret_str);
    }
}
if (! function_exists('write03BToFNM')) {
    function write03BToFNM(&$ret_arr, $fields, $suffix = '') {
        if(isset($fields[$suffix . 'borrower_info_dependent_ages'])) {
            $ssn = '';
            if(isset($fields[$suffix . 'borrower_info_social_security_number'])) {
                $ssn = extractOnlyDigits($fields[$suffix . 'borrower_info_social_security_number']);
            }
            $dependents = explode(",", $fields[$suffix . 'borrower_info_dependent_ages']);
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
    function write03CToFNM(&$ret_arr, $fields, $suffix = '') {
        $ssn = '';
        if(isset($fields[$suffix . 'borrower_info_social_security_number'])) {
            $ssn = extractOnlyDigits($fields[$suffix . 'borrower_info_social_security_number']);
        }
        write03CSubToFNM($ret_arr, $ssn, $fields, $suffix);
        if(isset($fields[$suffix . 'borrower_address_address_is_mailing_address']) && $fields[$suffix . 'borrower_address_address_is_mailing_address'] == 'false') {
            write03CSubToFNM($ret_arr, $ssn, $fields, $suffix, 'present_mailing');
        }
        if(isset($fields[$suffix . 'borrower_address_address_lived_less_than_2_years']) && $fields[$suffix . 'borrower_address_address_lived_less_than_2_years'] == 'true') {
            write03CSubToFNM($ret_arr, $ssn, $fields, $suffix, 'former');
        }
    }
}
if (! function_exists('write03CSubToFNM')) {
    function write03CSubToFNM(&$ret_arr, $ssn, $fields, $suffix, $midfix = 'present') {
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
        if(isset($fields[$suffix . 'borrower_address_' . $midfix . '_address_1'])) {
            $var_040 = $fields[$suffix . 'borrower_address_' . $midfix . '_address_1'];
        }
        if(isset($fields[$suffix . 'borrower_address_' . $midfix . '_address_2'])) {
            $var_040 .= ', ' . $fields[$suffix . 'borrower_address_' . $midfix . '_address_2'];
        }
        $var_040 = trim($var_040, ', ');
        $ret_str .= fillWithBlank(50, $var_040);                    // 03C-040
        $var_050 = '';
        if(isset($fields[$suffix . 'borrower_address_' . $midfix . '_address_city'])) {
            $var_050 = $fields[$suffix . 'borrower_address_' . $midfix . '_address_city'];
        }
        $ret_str .= fillWithBlank(35, $var_050);                    // 03C-050
        $var_060 = '';
        if(isset($fields[$suffix . 'borrower_address_' . $midfix . '_address_state'])) {
            $var_060 = $fields[$suffix . 'borrower_address_' . $midfix . '_address_state'];
        }
        $ret_str .= fillWithBlank(2, $var_060);                     // 03C-060
        $var_070 = '';
        if(isset($fields[$suffix . 'borrower_address_' . $midfix . '_address_zip_code'])) {
            $var_070 = $fields[$suffix . 'borrower_address_' . $midfix . '_address_zip_code'];
        }
        $ret_str .= fillWithBlank(5, $var_070);                     // 03C-070
        $ret_str .= fillWithBlank(4);                               // 03C-080
        $var_090 = '';
        if(isset($fields[$suffix . 'borrower_address_' . $tmpfix . '_address_own_rent'])) {
            switch($fields[$suffix . 'borrower_address_' . $tmpfix . '_address_own_rent']) {
                case 'rent':                $var_090 = 'R'; break;
                case 'own':                 $var_090 = 'O'; break;
                case 'living_rent_free':    $var_090 = 'X'; break;
            }
        }
        $ret_str .= fillWithBlank(1, $var_090);                     // 03C-090
        $var_100 = '';
        if(isset($fields[$suffix . 'borrower_address_' . $tmpfix . '_address_own_rent_number_of_years'])) {
            $var_100 = $fields[$suffix . 'borrower_address_' . $tmpfix . '_address_own_rent_number_of_years'];
        }
        $ret_str .= fillWithBlank(2, $var_100);                     // 03C-100
        $ret_str .= fillWithBlank(2);                               // 03C-110
        $ret_str .= fillWithBlank(50);                              // 03C-120
        array_push($ret_arr, $ret_str);
    }
}
// if (! function_exists('')) {
//     function (&$ret_arr, $fields) {
//         $ret_str = '';
//         $ret_str .= fillWithBlank(3, '   ');                        // -010
//         $ret_str .= fillWithBlank(, $var_020);// -020
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

<?php

if (! function_exists('random_string')) {
  function random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
if (! function_exists('parseResult')) {
    function parseResult($blocks, &$results, &$words, &$officer, &$officer_found, &$forms, &$rotates) {
        foreach($blocks as $item)
        {
            if(!isset($item['Id']))
                $item['Id'] == '';
            if(!isset($item['BlockType']))
                $item['BlockType'] == '';
            if(!isset($item['Page']))
                $item['Page'] = 0;

            if($item['BlockType'] == 'PAGE') {
                if(isset($item['Geometry']) && isset($item['Geometry']['Polygon']) && !empty($item['Geometry']['Polygon'])) {
                    $start_point = $item['Geometry']['Polygon'][0];
                    if(isset($start_point['X']) && isset($start_point['Y'])) {
                        if($start_point['X'] < 0.1 && $start_point['Y'] < 0.1)
                            $rotates[$item['Page']] = 0;
                        if($start_point['X'] > 0.9 && $start_point['Y'] < 0.1)
                            $rotates[$item['Page']] = 270;
                        if($start_point['X'] > 0.9 && $start_point['Y'] > 0.9)
                            $rotates[$item['Page']] = 180;
                        if($start_point['X'] < 0.1 && $start_point['Y'] > 0.9)
                            $rotates[$item['Page']] = 90;
                    }
                }
            }

            if($item['BlockType'] == 'LINE' && isset($item['Text'])) {
                $text = $item['Text'];
                $original = $text;
                $text = preg_replace('/\s+/', '', $text);
                $text = strtolower($text);

                if(strpos($text, 'fanniemaeform1009') === 0) { // Form 1009
                    addTo($item['Page'], $results['Form 1009']);
                } else if($original == 'FannieMae') { // Form 1009
                    addTo($item['Page'], $results['Form 1009']);
                } else if(strpos($text, 'fm1009addend') === 0) { // Remove from Form 1009
                    removeFrom($item['Page'], $results['Form 1009']);
                } else if($text == 'borrowercertification' || $text == 'barrowercertification') { // Borrower Certification
                    addTo($item['Page'], $results['Borrower Authorization']);
                } else if(strpos($text, 'borrowersauthorization') === 0) { // Borrower Authorization
                    addTo($item['Page'], $results['Borrower Authorization']);
                } else if($original == 'Borrower\'s Certification and Authorization') { // Borrower's Certification and Authorization
                    addTo($item['Page'], $results['Borrower Authorization']);
                } else if(strpos($text, 'hud-92902') !== false) { // Counseling Certificate
                    addTo($item['Page'], $results['Counseling Certificate']);
                } else if($original == 'HECM Counseling') { // Counseling Certificate
                    addTo($item['Page'], $results['Counseling Certificate']);
                } else if(strpos($text, 'certificatenumber') !== false) { // Counseling Certificate
                    addTo($item['Page'], $results['Counseling Certificate']);
                } else if(strpos($text, 'hud-92901') !== false) { // Anti-Churning Form
                    addTo($item['Page'], $results['Anti-Churning Form']);
                } else if(strpos($text, 'goodfaithestimate') === 0) { // GFE
                    addTo($item['Page'], $results['GFE']);
                } else if(strpos($text, 'hud-92900a') !== false || strpos($text, 'hud-92900-a') !== false) { // HUD 92900A
                    addTo($item['Page'], $results['HUD 92900A']);
                } else if($original == 'HUD/VA Addendum to Uniform Residential Loan Application') { // HUD 92900A
                    addTo($item['Page'], $results['HUD 92900A']);
                } else if($original == 'Part III - Notices to Borrowers') { // HUD 92900A
                    addTo($item['Page'], $results['HUD 92900A']);
                } else if(strpos($text, 'reversemortgagestate') === 0) { // Monthly Reverse Mortgage Statement
                    addTo($item['Page'], $results['Monthly Reverse Mortgage Statement']);
                } else if(strpos($text, 'reversemortgagestate') === 0) { // Monthly Reverse Mortgage Statement
                    addTo($item['Page'], $results['Monthly Reverse Mortgage Statement']);
                } else if($original == 'THIS IS NOT A BILL') { // Monthly Reverse Mortgage Statement
                    addTo($item['Page'], $results['Monthly Reverse Mortgage Statement']);
                } else if($original == 'DRIVER LICENSE' || $text == 'DRIVER\'S LICENSE') { // Driver's License
                    addTo($item['Page'], $results['Driver\'s License']);
                } else if(strpos($text, 'beneficiary\'ssocialsecuritynumber') !== false) { // Social Security 1099
                    addTo($item['Page'], $results['Social Security Income']);
                } else if(strpos($text, 'socialsecuritybenefit') !== false) { // Social Security Award Letter
                    addTo($item['Page'], $results['Social Security Income']);
                }
            }

            if($item['BlockType'] == 'WORD') {
                $words[$item['Id']] = $item['Text'];
            }

            if($item['BlockType'] == 'KEY_VALUE_SET' && isset($item['EntityTypes'])) {

                if(in_array('KEY', $item['EntityTypes'])) {
                    $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                    if($index !== false) {
                        $key = getFullWord($words, $item['Relationships'][$index]['Ids']);

                        $key = preg_replace('/\s+/', '', $key);
                        $key = strtolower($key);

                        $index = array_search('VALUE', array_column($item['Relationships'], 'Type'));
                        if($index !== false && !empty($item['Relationships'][$index]['Ids'])) {
                            $forms[$key . $item['Id']] = $item['Relationships'][$index]['Ids'][0];
                        }
                    }
                }
                if(in_array('VALUE', $item['EntityTypes'])) {
                    $index = array_search($item['Id'], $forms);
                    if(!isset($item['Relationships']) && isset($item['Geometry']) && isset($item['Geometry']['BoundingBox'])) {
                        $forms[$index] = array(
                            'Page' => $item['Page'],
                            'Rect' => $item['Geometry']['BoundingBox']
                        );
                    } else {
                        unset($forms[$index]);
                    }
                }

                if(!$officer_found && in_array($item['Page'], $results['Form 1009']) && isset($item['Relationships'])) {
                    if(in_array('KEY', $item['EntityTypes'])) {
                        $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                        if($index !== false) {
                            $key = getFullWord($words, $item['Relationships'][$index]['Ids']);

                            $key = preg_replace('/\s+/', '', $key);
                            $key = strtolower($key);
                            if(strpos($key, 'loanoriginator\'sname') !== false) {
                                $index = array_search('VALUE', array_column($item['Relationships'], 'Type'));
                                if($index !== false && !empty($item['Relationships'][$index]['Ids'])) {
                                    $officer = $item['Relationships'][$index]['Ids'][0];
                                }
                            }
                        }
                    }
                    if(in_array('VALUE', $item['EntityTypes']) && $officer == $item['Id']) {
                        $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                        if($index !== false) {
                            $officer = getFullWord($words, $item['Relationships'][$index]['Ids']);
                            $officer_found = true;
                        }
                    }
                }
            }
        }
    }
}
if (! function_exists('addTo')) {
    function addTo($page, &$results) {
        if(!in_array($page, $results, true)){
            array_push($results, $page);
        }
    }
}
if (! function_exists('removeFrom')) {
    function removeFrom($page, &$results) {
        $index = array_search($page, $results);
        if($index !== false) {
            unset($results[$index]);
        }
    }
}
if (! function_exists('getFullWord')) {
    function getFullWord($words, $childs) {
        $complete = '';
        foreach($childs as $child) {
            if(isset($words[$child])) {
                $complete .= $words[$child] . ' ';
            }
        }
        return trim($complete);
    }
}
if (! function_exists('mmToIn')) {
    function mmToIn ($val) {
        return $val * 0.0393701;
    }
}
if (! function_exists('mmToPt')) {
    function mmToPt ($val) {
        return mmToIn($val) * 72;
    }
}

if (! function_exists('swap')) {
    function swap(&$left, &$right) {
        $temp = $left;
        $left = $right;
        $right = $temp;
    }
}
if (! function_exists('parseForm')) {
    function parseForm($blocks, &$words, &$forms) {
        foreach($blocks as $item)
        {
            if(!isset($item['Id']))
                $item['Id'] == '';
            if(!isset($item['BlockType']))
                $item['BlockType'] == '';
            if(!isset($item['Page']))
                $item['Page'] = 0;

            if($item['BlockType'] == 'WORD')
                $words[$item['Id']] = $item['Text'];

            if($item['BlockType'] == 'KEY_VALUE_SET' && isset($item['EntityTypes'])) {

                if(in_array('KEY', $item['EntityTypes'])) {
                    $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                    if($index !== false) {
                        $key = getFullWord($words, $item['Relationships'][$index]['Ids']);

                        $key = preg_replace('/\s+/', '', $key);
                        $key = strtolower($key);

                        $index = array_search('VALUE', array_column($item['Relationships'], 'Type'));
                        if($index !== false && !empty($item['Relationships'][$index]['Ids']))
                            $forms[$key . $item['Id']] = $item['Relationships'][$index]['Ids'][0];
                    }
                }
                if(in_array('VALUE', $item['EntityTypes'])) {
                    $index = array_search($item['Id'], $forms);
                    if(isset($item['Geometry']) && isset($item['Geometry']['BoundingBox']))
                        $forms[$index] = array(
                            'Page' => $item['Page'],
                            'Rect' => $item['Geometry']['BoundingBox']
                        );
                    else
                        unset($forms[$index]);
                }
            }
        }
    }
}


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
if (! function_exists('formatShortDate')) {
    function formatShortDate($input = null) {
        if($input == null)
            $date = time();
        else
            $date = strtotime($input);
        return date('m/d/y', $date);
    }
}
if (! function_exists('formatNumber')) {
    function formatNumber($input, $up, $down) {
        $number = number_format($input, $down, '.', '');
        return $number;
    }
}
if (! function_exists('parseFloat')) {
    function parseFloat($input) {
        $number  = floatval($input);
        return $number;
    }
}
?>

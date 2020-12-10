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
    function parseResult($blocks, &$results, &$words, &$officer, &$forms) {
        foreach($blocks as $item)
        {
            if(!isset($item['Id']))
                $item['Id'] == '';
            if(!isset($item['BlockType']))
                $item['BlockType'] == '';
            if(!isset($item['Page']))
                $item['Page'] = 0;

            if($item['BlockType'] == 'LINE' && isset($item['Text'])) {
                $text = $item['Text'];
                $text = preg_replace('/\s+/', '', $text);
                $text = strtolower($text);

                if(isset($item['Geometry']) && isset($item['Geometry']['BoundingBox']) && isset($item['Geometry']['BoundingBox']['Top'])) {
                    $top = $item['Geometry']['BoundingBox']['Top'];

                    if($top > 0.85) {
                        if(strpos($text, 'fanniemaeform1009') !== false) { // Form 1009
                            addTo($item['Page'], $results['Form 1009']);
                        } else if(strpos($text, 'borrowercertification') !== false || strpos($text, 'barrowercertification') !== false) { // Borrower Authorization
                            addTo($item['Page'], $results['Borrower Authorization']);
                        } else if(strpos($text, 'hud-92002') !== false) { // Counseling Certificate
                            addTo($item['Page'], $results['Counseling Certificate']);
                        } else if(strpos($text, 'hud-92901') !== false) { // Anti-Churning Form
                            addTo($item['Page'], $results['Anti-Churning Form']);
                        } else if(strpos($text, 'goodfaithestimate') !== false) { // GFE
                            addTo($item['Page'], $results['GFE']);
                        } else if(strpos($text, 'hud-92900a') !== false || strpos($text, 'hud-92900-a') !== false) { // HUD 92900A
                            addTo($item['Page'], $results['HUD 92900A']);
                        }
                    }
                    if($top < 0.15) {
                        if(strpos($text, 'fanniemae') !== false) { // Form 1009
                            addTo($item['Page'], $results['Form 1009']);
                        } else if($text == 'monthlyreversemortgagestatement') { // Monthly Reverse Mortgage Statement
                            addTo($item['Page'], $results['Monthly Reverse Mortgage Statement']);
                        }
                    }
                    {
                        if($text == 'driverlicense' || $text == 'driver\'slicense') { // Driver's License
                            addTo($item['Page'], $results['Driver\'s License']);
                        } else if(strpos($text, 'beneficiary\'ssocialsecuritynumber') !== false) { // Social Security 1099
                            addTo($item['Page'], $results['Social Security Income']);
                        } else if(strpos($text, 'socialsecuritybenefit') !== false) { // Social Security Award Letter
                            addTo($item['Page'], $results['Social Security Income']);
                        }
                    }
                } else {
                    continue;
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

                if(in_array($item['Page'], $results['Form 1009']) && isset($item['Relationships'])) {
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

if (! function_exists('getFullWord')) {
    function getFullWord($words, $childs) {
        $complete = '';
        foreach($childs as $child) {
            $complete .= $words[$child] . ' ';
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

?>

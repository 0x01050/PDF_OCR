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
    function parseResult($blocks, &$results, &$words, &$officer) {
        foreach($blocks as $item)
        {
            if(!isset($item['Id']))
                $item['Id'] == '';
            if(!isset($item['BlockType']))
                $item['BlockType'] == '';
            if(!isset($item['Page']))
                $item['Page'] = 0;

            if(isset($item['Text'])) {
                $text = $item['Text'];
                $text = preg_replace('/\s+/', '', $text);
                $text = strtolower($text);

                if(isset($item['Geometry']) && isset($item['Geometry']['BoundingBox']) && isset($item['Geometry']['BoundingBox']['Top'])) {
                    $top = $item['Geometry']['BoundingBox']['Top'];

                    if($top > 0.85) {
                        if(strpos($text, 'fanniemae') !== false) { // Form 1009
                            addTo($item['Page'], $results['Form 1009']);
                        } else if(strpos($text, 'borrowercertification') !== false || strpos($text, 'barrowercertification') !== false) { // Borrower Authorization
                            addTo($item['Page'], $results['Borrower Authorization']);
                        } else if(strpos($text, 'hud-92002') !== false) { // Counseling Certificate
                            addTo($item['Page'], $results['Counseling Certificate']);
                        } else if(strpos($text, 'hud-92901') !== false) { // Anti-Churning Form
                            addTo($item['Page'], $results['Anti-Churning Form']);
                        } else if(strpos($text, 'goodfaithestimate') !== false) { // GFE
                            addTo($item['Page'], $results['GFE']);
                        } else if(strpos($text, 'hud-92900a') !== false || strpos($text, 'hud-92900-a') !== false) { // HUD 90900A
                            addTo($item['Page'], $results['HUD 90900A']);
                        }
                    }
                    if($top < 0.15) {
                        if(strpos($text, 'fanniemae') !== false) { // Form 1009
                            addTo($item['Page'], $results['Form 1009']);
                        } else if(strpos($text, 'reversemortgage') !== false) { // Monthly Reverse Mortgage Statement
                            addTo($item['Page'], $results['Monthly Reverse Mortgage Statement']);
                        }
                    }
                    {
                        if(strpos($text, 'driverlicense') !== false || strpos($text, 'driver\'slicense') !== false) { // Driver's License
                            addTo($item['Page'], $results['Driver\'s License']);
                        } else if(strpos($text, 'beneficiary\'ssocialsecuritynumber') !== false) { // Social Security 1099
                            addTo($item['Page'], $results['Social Security 1099']);
                        } else if(strpos($text, 'socialsecuritybenefit') !== false) { // Social Security Award Letter
                            addTo($item['Page'], $results['Social Security Award Letter']);
                        }
                    }
                } else {
                    continue;
                }
            }

            if(in_array($item['Page'], $results['Form 1009'])) {

                if($item['BlockType'] == 'WORD') {
                    $words[$item['Id']] = $item['Text'];
                }

                if($item['BlockType'] == 'KEY_VALUE_SET') {
                    if(isset($item['EntityTypes']) && isset($item['Relationships'])) {
                        if(in_array('KEY', $item['EntityTypes'])) {
                            $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                            if($index !== false) {
                                $key = getFullWord($words, $item['Relationships'][$index]['Ids']);
                                error_log('New Key : ' . $key);

                                $key = preg_replace('/\s+/', '', $key);
                                $key = strtolower($key);
                                if(strpos($key, 'loanoriginator\'sname') !== false) {
                                    $index = array_search('VALUE', array_column($item['Relationships'], 'Type'));
                                    if($index !== false && !empty($item['Relationships'][$index]['Ids'])) {
                                        $officer = $item['Relationships'][$index]['Ids'][0];
                                        error_log('Officer Key : ' . $officer);
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

?>

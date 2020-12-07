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
    function parseResult($blocks, &$pages, &$results) {
        foreach($blocks as $item)
        {
            if($item['BlockType'] == 'PAGE')
                $pages[$item['Id']] = $item['Page'];
            if(isset($item['Relationships'])) {
                $index = array_search('CHILD', array_column($item['Relationships'], 'Type'));
                if($index !== false) {
                    foreach($item['Relationships'][$index]['Ids'] as $child_id) {
                        $pages[$child_id] = $pages[$item['Id']];
                    }
                }
            }
            if(isset($item['Text'])) {
                $text = $item['Text'];
                $text = preg_replace('/\s+/', '', $text);
                $text = strtolower($text);

                if(strpos($text, 'fanniemae') !== false) { // Form 1009
                    addTo($pages[$item['Id']], $results['Form 1009']);
                } else if(strpos($text, 'borrowercertification') !== false) { // Borrower Authorization
                    addTo($pages[$item['Id']], $results['Borrower Authorization']);
                } else if(strpos($text, 'hud-92002') !== false) { // Counseling Certificate
                    addTo($pages[$item['Id']], $results['Counseling Certificate']);
                } else if(strpos($text, 'hud-92901') !== false) { // Anti-Churning Form
                    addTo($pages[$item['Id']], $results['Anti-Churning Form']);
                } else if(strpos($text, 'goodfaithestimate') !== false) { // GFE
                    addTo($pages[$item['Id']], $results['GFE']);
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

?>

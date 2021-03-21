<?php

$GLOBALS['icons'] = parse_ini_file(SRC.'icon.ini', true);


function maj($string) {

  $string = str_replace(['é', 'è', 'à'], ['e', 'e', 'a'], $string);
  $string = strtoupper($string);
  return $string;
}


function showIcon($text) {
    if(!array_key_exists($text, $GLOBALS['icons'])) return $text;  
    $icon = $GLOBALS['icons'][$text];
    $html = "<i class='".$icon."'></i>";
    return $html;
}

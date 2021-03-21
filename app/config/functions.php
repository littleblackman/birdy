<?php

// add helper used in view
function use_helper($element)
{
  $elements = explode(',', $element);
  foreach($elements as $filename) {
    $filename = trim($filename);
    if(file_exists(HELPER.$filename.'.php')) {
      require_once(HELPER.$filename.'.php');
    }
  }
}

function dd($var) {
    echo '<pre>'; print_r($var); exit;
}
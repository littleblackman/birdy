<?php

$GLOBALS['translation_terms'] = parse_ini_file(SRC.'translation.ini', true);


function trans($term, $plural = 0, $plural_value = "s")
{
  $datas = $GLOBALS['translation_terms'];
  if(!array_key_exists($term, $datas)) return $term;

  $term = $datas[$term];

  if($plural) {
    $lastLetter = substr($term, -1, 1);
    if($lastLetter != $plural_value) $term = $term.$plural_value;
  }

  return $term;
}



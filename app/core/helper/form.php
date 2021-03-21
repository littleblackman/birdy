<?php

function checked($first, $second) {
    if($first != $second) return null;
    return "checked";
}

function selected($first, $second) {
    if($first != $second) return null;
    return "selected";
}
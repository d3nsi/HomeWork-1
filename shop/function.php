<?php
function isInt($val) {
  if (strlen($val) == strlen(intval($val)))
    return true;
  else
    return false;
}

function errorPage($val) {
  if ($val)
    return true;
  else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    include "404.html";
    exit();
  }
}

function isRed($input, $isGet) {
  if ($input or $isGet) {
    $style = '';
    return $style;
  } else {
    $style = 'border-bottom: 1px solid red';
    return $style;
  }
}

function haveValue($input, $isPost) {
  if ($input or $isPost) {
    $value = $input;
    return $value;
  } else {
    $value = '';
    return $value;
  }
}
<?php

function show_data($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}


function load_error($errorName)
{
  require_once 'app/views/errors/' . $errorName . '.php';
  exit();
}

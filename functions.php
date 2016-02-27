<?php
function array_extract($array, array $cols)
{
    $vals = array();
    foreach ($cols as $col)
        $vals[$col] = $array[$col];
    return $vals;
}

function array_deep_convert($array, $embbeded = false)
{
  if (is_object($array))
    return array_deep_convert($array->toArray($embbeded), true);
  if (!is_array($array))
    return $array;

  $newarray = array();
  foreach ($array as $k => $v)
  {
    $newarray[$k] = array_deep_convert($v, $embbeded);
  }
  return $newarray;
}

function read_angular_post()
{
  return json_decode(file_get_contents('php://input'), true);
}

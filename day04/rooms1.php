<?php

$input = file_get_contents("day04.input");
$input = explode("\n", $input);
$data = array_map( function($n) { 
    $n = str_replace("-", "", $n);
    preg_match_all("/(.*?)(\d+)\[(.+)\]/", $n, $arr);
    return $arr;
}, $input);

$sum = 0;
foreach($data as $code) { 
    $codeString = $code[1][0];
    $roomValue = $code[2][0];
    $checksum = $code[3][0];

    $values = array_count_values(str_split($codeString));
    array_multisort($values, SORT_DESC, array_keys($values), SORT_ASC);
    $implodedStr = implode("", array_keys($values));
    $pattern = "/[^" . preg_quote($checksum) . "]+/";
    $implodedStr = preg_replace($pattern, "", $implodedStr);

    if($implodedStr === $checksum) {
        $sum += $roomValue;
    }
}

print($sum);
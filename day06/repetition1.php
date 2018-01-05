<?php
$input = file_get_contents("day06.input");
$input = explode("\n", $input);
$positionArray = array_fill(0, strlen($input[0]), "");

$answer = "";
foreach ($input as $str) { 
    for ($i = 0; $i < strlen($str); $i++) {
        $positionArray[$i] .= $str[$i];
    }
}

for ($i = 0; $i < count($positionArray); $i++) { 
    $values = array_count_values(str_split($positionArray[$i]));
    arsort($values);
    $answer .= array_keys($values)[0];
}

print($answer);
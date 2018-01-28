<?php
ini_set('memory_limit', '4096M'); // array_map uses a lot of memory :/
$input = "10010000000110000";
$length = 35651584; // use length 272 for part 1

while(strlen($input) < $length) {
    $reverse = strrev($input);
    
    $bin = array_map(function($a) { 
        return $a === "1" ? "0" : "1";
    }, str_split($reverse));

    $bin = implode("", $bin);
    
    $input = $input . "0" . $bin;
}

$input = substr($input, 0, $length);

function checksum($string) 
{
    $sum = "";
    for($i = 1; $i < strlen($string); $i += 2) { 
        $sum .= ($string[$i - 1] === $string[$i]) ? "1" : "0";
    }

    return strlen($sum) % 2 === 0 ? checksum($sum) : $sum;
}

print(checksum($input));
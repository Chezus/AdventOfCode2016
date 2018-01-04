<?php

$input = file_get_contents("day04.input");
$input = explode("\n", $input);
$data = array_map(function ($n) {
    preg_match_all("/(.*?)(\d+)\[(.+)\]/", $n, $arr);
    return $arr;
}, $input);

$realRooms = [];
foreach ($data as $code) {
    $codeString = $code[1][0];
    $roomValue = $code[2][0];

    for ($i = 0; $i < strlen($codeString); $i++) {
        if ($codeString[$i] === "-") {
            $codeString[$i] = " ";
            continue;
        }

        $val1 = (ord($codeString[$i]) - 97 + $roomValue) % 26;
        $codeString[$i] = chr($val1 + 97);
    }

    print_r($codeString . " " . $roomValue . "<br>");
}
<?php
// ini_set("max_execution_time", 12);

$input = explode("\n", file_get_contents("day10.input"));
$input = $input;
$pattern1 = "/value (\d+) goes to bot (\d+)/";
$pattern2 = "/bot (\d+) gives low to (bot|output) (\d+) and high to (bot|output) (\d+)/";
$bot = [];
$output = [];

function addValueToArr(&$array, $num, $value) {
    if (!isset($array[$num])) {
        $array[$num] = [$value];
    } else {
        array_push($array[$num], $value);
    }
}

foreach($input as $key => $str) { 
    preg_match_all($pattern1, $str, $matches);
    
    if(!isset($matches[1][0]))
        continue;

    $value = $matches[1][0];
    $botNum = $matches[2][0];

    addValueToArr($bot, strval($botNum), $value);

    unset($input[$key]);
}

$found = false;
while(!$found) {
    foreach ($input as $key => $str) {
        preg_match_all($pattern2, $str, $matches);
        if (!isset($bot[$matches[1][0]])) {
            continue;
        } else if (count($bot[$matches[1][0]]) !== 2) {
            continue;
        }

        $curr = $bot[$matches[1][0]];

        if (intval($curr[0]) < intval($curr[1])) {
            addValueToArr($GLOBALS[$matches[2][0]], $matches[3][0], $curr[0]);
            addValueToArr($GLOBALS[$matches[4][0]], $matches[5][0], $curr[1]);
        } else {
            addValueToArr($GLOBALS[$matches[2][0]], $matches[3][0], $curr[1]);
            addValueToArr($GLOBALS[$matches[4][0]], $matches[5][0], $curr[0]);
        }

        if (($curr[0] === "61" && $curr[1] === "17") || ($curr[0] === "17" && $curr[1] === "61")) {
            print("Part 1: " . $matches[1][0] . "<br>");
        }

        if(!empty($output[0]) && !empty($output[1]) && !empty($output[2])) {
            print("Part 2: " . $output[0][0] * $output[1][0] * $output[2][0]);
            $found = true;
            break;
        }

        $bot[$matches[1][0]] = [];
        unset($input[$key]);
    }
}


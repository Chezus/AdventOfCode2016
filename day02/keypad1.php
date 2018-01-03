<?php

$input = file_get_contents("day02.input");
$input = explode("\n", $input);

$x = 1;
$y = 1;

$keypad = ["123", "456", "789"];
$answer = "";
foreach ($input as $str) { 
    for ($i = 0; $i < strlen($str); $i++) { 
        switch($str[$i]) { 
            case "U":
                $y--;
                break;
            case "D":
                $y++;
                break;
            case "L":
                $x--;
                break;
            case "R":
                $x++;
                break;
        }

        $x = max(0, min(2, $x));
        $y = max(0, min(2, $y));
    }

    $answer .= $keypad[$y][$x];
}

print($answer);
<?php

$input = file_get_contents("day02.input");
$input = explode("\n", $input);

$x = 0;
$y = 2;

$keypad = ["  1  ", " 234 ", "56789", " ABC ", "  D  "];
$answer = "";
foreach ($input as $str) {
    for ($i = 0; $i < strlen($str); $i++) {
        $prevX = $x;
        $prevY = $y;
        switch ($str[$i]) {
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

        $x = max(0, min(4, $x));
        $y = max(0, min(4, $y));

        if ($keypad[$y][$x] === " ") { 
            $x = $prevX;
            $y = $prevY;
        }
    }

    $answer .= $keypad[$y][$x];
}

print($answer);
<?php
$input = file_get_contents("day07.input");
$input = explode("\n", $input);
$count = 0;

foreach ($input as $key => $str) {
    $inBracket = false;
    $toFind = [];
    $found = false;
    for ($i = 0; $i + 2 < strlen($str); $i++) {
        if ($str[$i] === "[") {
            $inBracket = true;
        } else if ($str[$i] === "]") {
            $inBracket = false;
        }

        $substr = substr($str, $i, 3);
        if ($substr[0] === $substr[2] && $substr[0] !== $substr[1]) {
            array_push($toFind, $substr[1] . $substr[0] . $substr[1], !$inBracket);
            for($j = 0; $j + 2 < count($toFind); $j += 2) { 
                if($substr === $toFind[$j] && $inBracket === $toFind[$j + 1]) {
                    $count++;
                    $found = true;
                    break;
                }
            }
        }

        if($found) {
            break;
        }
    }
}

print($count);
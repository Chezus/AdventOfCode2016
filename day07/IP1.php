<?php
$input = file_get_contents("day07.input");
$input = explode("\n", $input);
$count = 0;

foreach($input as $str) {
    $inBracket = false;
    $found = false;
    for ($i = 0; $i + 3 < strlen($str); $i++) {
        if ($str[$i] === "[") {
            $inBracket = true;
        } else if($str[$i] === "]") {
            $inBracket = false;
        }

        $substr = substr($str, $i, 4);

        if($substr[0] === $substr[3] && $substr[1] === $substr[2] && $substr[0] !== $substr[1]) { 
            if(!$inBracket) {
                $found = true;
            } else {
                $found = false;
                break;
            }
        }
    }

    if($found)
        $count++;
}

print($count);
<?php
$input = "zpqevtbw";
$index = 0;
$keysFound = 0;
$lastKeyFound = -1;

while ($keysFound < 64) {
    $needle;
    $found = false;

    while (true) {
        $hash = md5($input . $index);

        for($i = 2; $i < 32; $i++) {
            if ($hash[$i - 2] === $hash[$i - 1] && $hash[$i - 1]  === $hash[$i]) {
                $needle = str_repeat($hash[$i], 5);
                $found = true;
                break;
            }
        }

        if($found) { 
            break;
        }

        $index++;
    }

    for($i = $index + 1; $i <= $index + 1000; $i++) {
        $hash = md5($input . $i);
        if(strpos($hash, $needle)) {

            $lastKeyFound = $index;
            $keysFound++;
            break;
        }
    }

    $index++;
}

print($lastKeyFound);
<?php
ini_set("max_execution_time", 0);

$input = "zpqevtbw";
$index = 0;
$keysFound = 0;
$lastKeyFound = -1;
$hashes = [];

while ($keysFound < 64) {
    $needle;
    $found = false;

    while (true) {
        $hash = md5($input . $index);

        for ($i = 0; $i < 2016; $i++) { 
            $hash = md5($hash);
        }

        for ($i = 2; $i < 32; $i++) {
            if ($hash[$i - 2] === $hash[$i - 1] && $hash[$i - 1] === $hash[$i]) {
                $needle = str_repeat($hash[$i], 5);
                $found = true;
                break;
            }
        }

        if ($found) {
            break;
        }

        $index++;
    }

    for ($i = $index + 1; $i <= $index + 1001; $i++) {
        $hash;

        if(isset($hashes[$i])) {
            $hash = $hashes[$i];
        } else {
            $hash = md5($input . $i);
            for ($j = 0; $j < 2016; $j++) {
                $hash = md5($hash);
            }

            $hashes[$i] = $hash;
        }

        if (strpos($hash, $needle)) {
            $lastKeyFound = $index;
            $keysFound++;
            break;
        }
    }

    $index++;
}

print($lastKeyFound);
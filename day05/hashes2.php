<?php
ini_set("max_execution_time", 0);

$input = "abbhdwsy";

$password = "        ";
$j = -1;

for ($i = 0; $i < 8; $i++) {
    while (true) {
        $j++;
        $hash = md5($input . $j);
        if (substr($hash, 0, 5) === "00000" && $hash[5] < "8" && $password[intval($hash[5])] === " ") {
            print("FOUND: " . $hash . " WITH " . $input . $j . "<br>");
            $password[intval($hash[5])] = $hash[6];
            break;
        }
    }
}

print($password);
<?php
$input = "abbhdwsy";

$password = "";
$j = -1;

for($i = 0; $i < 8; $i++) { 
    while(true) {
        $j++;
        $hash = md5($input . $j);
        if(substr($hash, 0, 5) === "00000") { 
            $password .= $hash[5];
            break;
        }
    }
}

print($password);
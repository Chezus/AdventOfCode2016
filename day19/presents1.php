<?php
ini_set("memory_limit", "4096M");

$input = 3014603;
$elves = array_fill(0, $input, 1);

function getNext($val) 
{
    global $input;
    global $elves;

    for($i = ($val + 1) % $input; $i !== $val; $i = ++$i % $input) { 
        if($elves[$i] !== 0) {
            return $i;
        }
    }

    return $val;
}

$index = 0;
while(true) { 
    $next = getNext($index);

    if($next === $index) { 
        break;
    }

    $elves[$next] = 0;
    $index = getNext($next);
}

print($index + 1);
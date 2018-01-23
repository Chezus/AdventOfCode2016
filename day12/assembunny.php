<?php
ini_set("max_execution_time", 0);
$input = explode("\n", file_get_contents("day12.input"));
// remove "c" or set it to 0 for part 1
$registers = ["c" => 1];
$position = 0;

function toNum($val)
{
    global $registers;
    if(is_numeric($val)) {
        return intval($val);
    }
    
    return $registers[$val] ?? $registers[$val] = 0;
}

function cpy($x, $y) 
{
    global $registers;
    $registers[$y] = toNum($x);
}

function inc($x)
{
    global $registers;
    $registers[$x]++;
}

function dec($x)
{
    global $registers;
    $registers[$x]--;
}

function jnz($x, $y)
{
    global $position;
    if(toNum($x) === 0) {
        return;
    }

    $position += toNum($y) - 1;
}

for(;$position < count($input); $position++) {
    $func = substr($input[$position], 0, 3);
    $args = explode(" ", substr($input[$position], 4));
    call_user_func_array($func, $args);
}

print($registers["a"]);
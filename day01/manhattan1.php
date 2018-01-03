<?php

$input = file_get_contents("day01.input");
$arr = explode(", ", $input);

$arr = array_map(function ($val) {
    return array($val[0], substr($val, 1));
}, $arr);

function mod($a, $b)
{
    return (($a % $b) + $b) % $b;
}

const NORTH = 0;
const EAST = 1;
const SOUTH = 2;
const WEST = 3;

$direction = NORTH;
$x = 0;
$y = 0;

foreach ($arr as $value) {
    if ($value[0] === "L")
        $direction--;
    else
        $direction++;

    $direction = mod($direction, 4);

    if ($direction === NORTH) {
        $y -= $value[1];
    } else if ($direction === EAST) {
        $x += $value[1];
    } else if ($direction === SOUTH) {
        $y += $value[1];
    } else if ($direction === WEST) {
        $x -= $value[1];
    }
}

print(abs($x) + abs($y));
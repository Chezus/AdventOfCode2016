<?php

$input = explode("\n", file_get_contents("day20.input"));
$ranges = [];

foreach ($input as $str) {
    $nums = explode("-", $str);
    array_push($ranges, $nums);
}

function sortRanges($a, $b)
{
    return $a[0] <=> $b[0];
}

usort($ranges, "sortRanges");
$lowestAllowed = 0;
$allowed = 0;
$maximum = 0;

for ($i = 0; $i < count($ranges); $i++) {
    $gap = max(0, $ranges[$i][0] - $maximum - 1);
    
    if ($lowestAllowed === 0 && $gap > 0) { 
        $lowestAllowed = $maximum + 1;
    }

    $allowed += $gap;
    $maximum = max($maximum, $ranges[$i][1]);
}

$allowed += max(0, 4294967295 - $maximum);

print("Part 1: " . $lowestAllowed . "\n");
print("Part 2: " . $allowed);
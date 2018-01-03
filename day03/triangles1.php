<?php

$input = file_get_contents("day03.input");
$input = explode("\n", $input);
$triangles = array_map(function($n) {
    preg_match_all("/\d+/", $n, $arr);
    return $arr;
}, $input);

$counter = 0;
foreach($triangles as $triangle) {
    $triangle = $triangle[0];
    if ($triangle[0] + $triangle[1] > $triangle[2] && $triangle[0] + $triangle[2] > $triangle[1] &&
        $triangle[1] + $triangle[2] > $triangle[0]) {
        $counter++;
    }
}

print($counter);

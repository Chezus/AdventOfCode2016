<?php

$input = file_get_contents("day03.input");
$input = explode("\n", $input);
$triangles = array_map(function ($n) {
    preg_match_all("/\d+/", $n, $arr);
    return $arr;
}, $input);

$counter = 0;
for ($i = 0; $i+3 <= count($triangles); $i+=3) {
    for ($j = 0; $j < 3; $j++) {
        $side1 = $triangles[$i][0][$j];
        $side2 = $triangles[$i + 1][0][$j];
        $side3 = $triangles[$i + 2][0][$j];

        if ($side1 + $side2 > $side3 && $side1 + $side3 > $side2 &&
            $side2 + $side3 > $side1) {
            $counter++;
        }
    }
}

print($counter);
<?php

$input = "^.^^^..^^...^.^..^^^^^.....^...^^^..^^^^.^^.^^^^^^^^.^^.^^^^...^^...^^^^.^.^..^^..^..^.^^.^.^.......";
$numRows = 400000; // set to 40 for part 1
$rows = [$input];


for($i = 1; $i < $numRows; $i++) {
    $row = "";

    for ($j = 0; $j < strlen($input); $j++) {
        $left = "."; 
        $mid = $rows[$i - 1][$j];
        $right = ".";

        if ($j !== 0) {
            $left = $rows[$i - 1][$j - 1];
        }
        if ($j !== strlen($input) - 1) {
            $right = $rows[$i - 1][$j + 1];
        }

        if (($left === "^" && $mid === "^" && $right === ".") ||
            ($left === "." && $mid === "^" && $right === "^") ||
            ($left === "^" && $mid === "." && $right === ".") ||
            ($left === "." && $mid === "." && $right === "^")) {
            $row[$j] = "^";
        } else { 
            $row[$j] = ".";
        }
    }

    array_push($rows, $row);
}

$string = implode("", $rows);
print(substr_count($string, "."));

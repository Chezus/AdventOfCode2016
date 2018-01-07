<?php
$input = explode("\n", file_get_contents("day08.input"));
$fieldWidth = 50;
$fieldHeight = 6;
$field = array_fill(0, $fieldWidth * $fieldHeight, "_");

function rect($x, $y) 
{
    global $field, $fieldWidth, $fieldHeight;
    for($i = 0; $i < $x; $i++) {
        for($j = 0; $j < $y; $j++) { 
            $field[$j * $fieldWidth + $i] = "#";
        }
    }
}

function rotateColumn($x, $a) 
{
    global $field, $fieldWidth, $fieldHeight;
    $copy = $field;
    for ($y = 0; $y < $fieldHeight; $y++) {
        $field[(($y + $a) % $fieldHeight) * $fieldWidth + $x] = $copy[$y * $fieldWidth + $x];
    }
}

function rotateRow($y, $a) 
{
    global $field, $fieldWidth, $fieldHeight;
    $copy = $field;
    for ($x = 0; $x < $fieldWidth; $x++) {
        $field[$y * $fieldWidth + (($x + $a) % $fieldWidth)] = $copy[$y * $fieldWidth + $x];
    }
}

function printField()
{
    global $field, $fieldWidth, $fieldHeight;
    $str = implode("", $field);
    for ($i = 0; $i < $fieldHeight; $i++) {
        print(substr($str, $i * $fieldWidth, $fieldWidth) . "<br>");
    }
    print("<br>");
}

function printLetter($num)
{
    global $field, $fieldWidth, $fieldHeight;
    for ($y = 0; $y < 6; $y++) {
        for ($x = 0; $x < 5; $x++) {
            print($field[$y * $fieldWidth + (5 * $num) + $x]);
        }
        print("<br>");
    }

    print("<br>");
}

foreach($input as $key => $str) {
    preg_match_all("/\d+/", $str, $args);
    $args = $args[0];
    if($str[1] === "e") { // rect 
        rect($args[0], $args[1]);
    } else if($str[7] === "c") { // rotate column
        rotateColumn($args[0], $args[1]);
    } else { // rotate row
        rotateRow($args[0], $args[1]);
    }
}

$values = array_count_values($field);
print($values["#"] . "<br><br>");

printField();

for($i = 0; $i < 10; $i++) { 
    printLetter($i);
}
<?php
$input = file_get_contents("test.input");
$output = "";

function decompress($inp) 
{
    if(strlen($inp) === 0) {
        return 0;
    } else if(strpos($inp, "(") === false) {
        return strlen($inp);
    }

    print($inp . "<br>");
    $index = strpos($inp, "(");
    $markerLength = strpos($inp, ")") - $index + 1;
    $marker = explode("x", substr($inp, $index + 1, $markerLength - 2));

    $substr = substr($inp, $index + $markerLength, intval($marker[0]));
    $recursiveLength = decompress($substr);

    return $index + ($recursiveLength * intval($marker[1])) + decompress(substr($inp, $index + $markerLength + $marker[0]));
}

print(decompress($input));
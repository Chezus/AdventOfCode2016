<?php
$input = "pxxbnzuo";
$allowed = ["b", "c", "d", "e", "f"];
$shortest = 1000;

function findVault($xLoc, $yLoc, $path) 
{
    global $allowed;
    global $shortest;
    
    if(strlen($path) > $shortest) {
        return -1;
    }

    if($xLoc === 3 && $yLoc === 3) {
        $shortest = min(strlen($path), $shortest);
        return $path;
    }

    $hash = md5($path);
    $possiblePaths = [];

    if(in_array($hash[0], $allowed) && $yLoc !== 0)
        array_push($possiblePaths, $xLoc, $yLoc - 1, $path . "U");
    if (in_array($hash[1], $allowed) && $yLoc !== 3)
        array_push($possiblePaths, $xLoc, $yLoc + 1, $path . "D");
    if (in_array($hash[2], $allowed) && $xLoc !== 0)
        array_push($possiblePaths, $xLoc - 1, $yLoc, $path . "L");
    if (in_array($hash[3], $allowed) && $xLoc !== 3)
        array_push($possiblePaths, $xLoc + 1, $yLoc, $path . "R");

    if(empty($possiblePaths)) {
        return -1;
    }
    
    $paths = [];
    for($i = 0; $i < count($possiblePaths); $i += 3) {
        $val = findVault($possiblePaths[$i], $possiblePaths[$i + 1], $possiblePaths[$i + 2]);

        if($val !== -1) {
            array_push($paths, $val);
        }
    }

    if(empty($paths)) {
        return -1;
    }

    $lengths = array_map("strlen", $paths);
    return $paths[array_search(min($lengths), $lengths)];
}

$answer = findVault(0, 0, $input);
$answer = str_replace($input, "", $answer);
print($answer);

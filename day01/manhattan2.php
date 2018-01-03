<?php

class Vector2 
{
    public $x;
    public $y;

    function __construct($x, $y) 
    {
        $this->x = $x;
        $this->y = $y;
    }

    function add($vec2) 
    {
        $this->x += $vec2->x;
        $this->y += $vec2->y;
    }

    function length()
    {
        return abs($this->x) + abs($this->y);
    }

    function equals($vec2)
    {
        return ($this->x === $vec2->x && $this->y === $vec2->y);
    }

    function _clone() 
    { 
        return new Vector2($this->x, $this->y);
    }
}

$input = file_get_contents("day01.input");
$arr = explode(", ", $input);
$arr = array_map(function($val) { 
    return array($val[0], substr($val, 1));
}, $arr);

function mod($a, $b) { 
    return (($a % $b) + $b) % $b;
}

const NORTH = 0;
const EAST  = 1;
const SOUTH = 2;
const WEST  = 3;

$directions = [new Vector2(0, -1), new Vector2(1, 0), new Vector2(0, 1), new Vector2(-1, 0)];

$direction = NORTH;
$locations = [new Vector2(0, 0)];
$found = false;

foreach($arr as $value) { 
    if ($value[0] === "L") {
        $direction--;
    } else {
        $direction++;
    }

    $direction = mod($direction, 4);

    do {
        $currLoc = $locations[count($locations) - 1]->_clone();
        $currLoc->add($directions[$direction]);
        for($i = 0; $i < count($locations); $i++) {
            if($currLoc->equals($locations[$i])) {
                $found = true;
                print($currLoc->length());
                break;
            }
        }
        
        array_push($locations, $currLoc);
    } while (--$value[1] > 0 && !$found);

    if ($found)
        break;
}

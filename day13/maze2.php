<?php 

$input = 1350;
$map = [];

$maxX = 50;
$maxY = 50;

// create map
for ($y = 0; $y < $maxY; $y++) {
    for ($x = 0; $x < $maxX; $x++) {
        $sum = ($x * $x) + (3 * $x) + (2 * $x * $y) + $y + ($y * $y) + $input;
        $val = substr_count(decbin($sum), "1") % 2 === 0 ? "." : "#";
        $map[$y * $maxX + $x] = $val;
    }
}

class Node
{
    public $x;
    public $y;
    public $value;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->value = 0;
    }

    public function getNeighbours()
    {
        return [
            new Node($this->x - 1, $this->y),
            new Node($this->x + 1, $this->y),
            new Node($this->x, $this->y - 1),
            new Node($this->x, $this->y + 1)
        ];
    }

    public function equals($node)
    {
        return $this->x === $node->x && $this->y === $node->y;
    }

    public function inArray($arr)
    {
        foreach ($arr as $node) {
            if ($this->equals($node))
                return true;
        }

        return false;
    }
}

// solve map
function findPath($startX, $startY)
{
    global $maxX;
    global $maxY;
    global $map;
    $x = $startX;
    $y = $startY;

    $openList = new SplQueue();
    $openList->enqueue(new Node($startX, $startY));
    $closedList = [];

    while (!$openList->isEmpty()) {
        $node = $openList->dequeue();
        $newVal = $node->value + 1;
        array_push($closedList, $node);

        $neighbours = $node->getNeighbours();
        for ($i = 0; $i < count($neighbours); $i++) {
            $node = $neighbours[$i];

            if ($node->x >= 0 && $node->x < $maxX
                && $node->y >= 0 && $node->y < $maxY
                && $map[$node->y * $maxX + $node->x] === "."
                && !$node->inArray($openList)
                && !$node->inArray($closedList) && $newVal < 51) {
                $node->value = $newVal;
                $openList->enqueue($neighbours[$i]);
            }
        }
    }

    return count($closedList);
}

print_r(findPath(1, 1));
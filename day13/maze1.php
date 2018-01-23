<?php 

$input = 1350;
$map = [];

$maxX = 150;
$maxY = 150;

class FooPQ extends SplPriorityQueue
{
    public function compare($priority1, $priority2)
    {
        if ($priority1 === $priority2) return 0;
            return $priority1 > $priority2 ? -1 : 1;
    } 
}

class PriorityQueue implements Countable, IteratorAggregate
{
    protected $innerQueue;

    public function __construct()
    {
        $this->innerQueue = new FooPQ;
    }

    public function count()
    {
        return count($this->innerQueue);
    }

    public function insert($data, $priority)
    {
        $this->innerQueue->insert($data, $priority);
    }

    public function extract()
    {
        return $this->innerQueue->extract();
    }

    public function getIterator()
    {
        return clone $this->innerQueue;
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
        foreach($arr as $node) {
            if($this->equals($node))
                return true;
        }

        return false;
    }
}
// create map
for($y = 0; $y < $maxY; $y++) {
    for($x = 0; $x < $maxX; $x++) {
        $sum = ($x * $x) + (3 * $x) + (2 * $x * $y) + $y + ($y * $y) + $input;
        $val = substr_count(decbin($sum), "1") % 2 === 0 ? "." : "#";
        $map[$y * $maxX + $x] = $val;
    }
}

// solve map
function findPath($startX, $startY, $endX, $endY) {
    global $maxX;
    global $maxY;
    global $map;
    $x = $startX;
    $y = $startY;

    $openList = new PriorityQueue();
    $openList->insert(new Node($startX, $startY), 0);
    $closedList = [];
    $endNode = new Node($endX, $endY);

    while(!$endNode->inArray($closedList)) {
        $node = $openList->extract();
        $newVal = $node->value + 1;
        array_push($closedList, $node);
        
        $neighbours = $node->getNeighbours();
        for($i = 0; $i < count($neighbours); $i++) {
            $node = $neighbours[$i];

            if($node->x > 0 && $node->x < $maxX 
                && $node->y > 0 && $node->y < $maxY
                && $map[$node->y * $maxX + $node->x] === "." 
                && !$node->inArray($openList) 
                && !$node->inArray($closedList)) {
                $node->value = $newVal;
                $openList->insert($neighbours[$i], $newVal);
            }
        }
    }

    return array_pop($closedList);
}

print(findPath(1, 1, 31, 39)->value);
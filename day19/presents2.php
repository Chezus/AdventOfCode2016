<?php
ini_set("memory_limit", "4096M");
ini_set('zend.enable_gc', 0); // had to disable garbage collection because it got stuck in an infinite loop... at least the code is fast.

class LinkedList
{
    public $first;
    public $last;
    public $current;
    public $count = 0;

    function __construct($first)
    {
        $this->first = new Node($first);
        $this->current = $this->first;
        $this->count++;
    }

    public function add($value)
    {
        $node = new Node($value);

        $this->current->next = $node;
        $node->prev = $this->current;
        $node->next = $this->first;
        $this->current = $node;
        $this->last = $node;
        $this->first->prev = $node;
        $this->count++;
    }

    public function removeCurrent()
    {
        $this->current->prev->next = $this->current->next;
        $this->current->next->prev = $this->current->prev;
        $this->current = $this->current->next;
        $this->count--;
    }

    public function getNext()
    {
        $this->current = $this->current->next;
        return $this->current->value;
    }

    public function getPrev()
    {
        $this->current = $this->current->prev;
        return $this->current->value;
    }
}

class Node
{
    public $next;
    public $prev;
    public $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    function __toString()
    {
        return strval($this->value);
    }
}

$input = 3014603;
$elves = new LinkedList(1);

for ($i = 0; $i < $input; $i++) {
    $elves->add($i + 1);
}

$index = 0;
$count = $input;
$across = ($index + $count / 2) % $count;
while ($elves->getNext() !== $across);

while (true) {
    if ($count % 2 === 0) {
        $elves->removeCurrent();
    } else {
        $elves->getNext();
        $elves->removeCurrent();
    }
    $count--;

    if ($count === 1) {
        break;
    }
}

print($elves->current);

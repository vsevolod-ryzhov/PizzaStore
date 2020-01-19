<?php

namespace App\Components\Cart;

class Cart
{
    private $items = [];
    private $storage;
    private $calculator;

    public function __construct(StorageInterface $storage, CalculatorInterface $calculator)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function add($id, $count, $price)
    {
        $current = isset($this->items[$id]) ? $this->items[$id]->getCount() : 0;
        $this->items[$id] = new CartItem($id, $current + $count, $price);
        $this->saveItems();
    }

    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }
        $this->saveItems();
    }

    public function clear()
    {
        $this->items = [];
        $this->saveItems();
    }

    public function getCost()
    {
        return $this->calculator->getCost($this->items);
    }

    public function loadItems()
    {
        $this->items = $this->storage->load();
    }

    private function saveItems()
    {
        $this->storage->save($this->items);
    }
}

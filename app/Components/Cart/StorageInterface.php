<?php


namespace App\Components\Cart;


interface StorageInterface
{
    /**
     * @return CartItem[]
     */
    public function load();

    /**
     * @param CartItem[] $items
     */
    public function save($items);
}

<?php

namespace App\Components\Cart;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return float
     */
    public function  getCost($items);
}

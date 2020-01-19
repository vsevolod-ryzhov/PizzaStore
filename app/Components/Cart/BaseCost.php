<?php

namespace App\Components\Cart;

class BaseCost implements CalculatorInterface
{
    public function getCost($items)
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}

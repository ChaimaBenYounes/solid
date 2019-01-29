<?php

class ChocolateTopping extends Topping
{

    public function getDescription()
    {
        return $this->IMeal->getDescription()." Supplément chocolat";
    }

    public function getPrice()
    {
        return $this->IMeal->getPrice() + 0.70;
    }
}
<?php

class WhippedCreamTopping extends Topping
{
    public function getDescription()
    {
        return $this->IMeal->getDescription()." , Supplément chantilly";
    }

    public function getPrice()
    {
        return $this->IMeal->getPrice() + 0.50;
    }
}
<?php

class FudgeTopping extends Topping
{
    public function getDescription()
    {
        return $this->IMeal->getDescription()." , Supplément caramel";
    }

    public function getPrice()
    {
        return  $this->IMeal->getPrice() + 0.40 ;
    }
}
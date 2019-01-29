<?php
/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 21/12/18
 * Time: 10:14
 */

Abstract class Sweet implements IMeal
{
    protected $description;

    protected $price;


    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

}
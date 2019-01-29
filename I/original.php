<?php

interface IItem
{
    public function setPrice($price);
}


interface IItemBook extends IItem
{
    public function setPreviewPages($pdf);
}

interface IItemTshirt extends IItem
{
    public function applyDiscount($discount);
    public function applyPromotionalCode($code);
    public function setColor($color);
}


class Book implements IItemBook
{
    private $pdf;

    private $price;


    public function setPreviewPages($pdf)
    {
        $this->pdf = $pdf;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}


class TShirt implements IItemTshirt
{
    private $code;

    private $color;

    private $discount;

    private $price;


    public function applyDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function applyPromotionalCode($code)
    {
        $this->code = $code;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}


// (...) EXEMPLE DE CODE CLIENT

$items = [ new Book(), new TShirt() ];

foreach($items as $item)
{
    echo '<h1>Nouveau produit : '.get_class($item).'</h1>';

    try
    {
        if($item instanceof Book)
        {
            $item->setPreviewPages('/files/preview.pdf');
            $item->setPrice(18.25);
            var_dump($item);
        }

        if($item instanceof TShirt)
        {
            $item->applyDiscount(1.6);
            $item->applyPromotionalCode('XMAS2017');
            $item->setColor('red');
            $item->setPrice(18.25);
            var_dump($item);
        }

    }
    catch(Exception $exception)
    {
        echo '<h2>ERREUR : '.$exception->getMessage().'</h2>';
    }
}
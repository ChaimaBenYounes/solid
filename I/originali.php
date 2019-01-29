<?php

interface IItem
{
    public function applyDiscount($discount);
    public function applyPromotionalCode($code);
    public function setColor($color);
    public function setPreviewPages($pdf);
    public function setPrice($price);
}



class Book implements IItem
{
    private $pdf;

    private $price;


    // Implémentation de la méthode inutile mais obligatoire à cause de l'interface !
    public function applyDiscount($discount)
    {
        throw new Exception('Les livres ne doivent pas recevoir de réduction !');
    }

    // Implémentation de la méthode inutile mais obligatoire à cause de l'interface !
    public function applyPromotionalCode($code)
    {
        throw new Exception('Les livres ne peuvent pas avoir de code promotionel !');
    }

    // Implémentation de la méthode inutile mais obligatoire à cause de l'interface !
    public function setColor($color)
    {
        throw new Exception("Les livres n'ont pas de couleur !");
    }

    public function setPreviewPages($pdf)
    {
        $this->pdf = $pdf;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}


class TShirt implements IItem
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

    // Implémentation de la méthode inutile mais obligatoire à cause de l'interface !
    public function setPreviewPages($pdf)
    {
        throw new Exception("Les t-shirts n'ont pas de PDF de prévisualisation !");
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
        $item->applyDiscount(1.6);
        $item->applyPromotionalCode('XMAS2017');
        $item->setColor('red');
        $item->setPreviewPages('/files/preview.pdf');
        $item->setPrice(18.25);
    }
    catch(Exception $exception)
    {
        echo '<h2>ERREUR : '.$exception->getMessage().'</h2>';
    }
}
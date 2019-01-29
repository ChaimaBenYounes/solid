<?php

Interface IBird
{
    public function makeSound();

}

Interface IFlyingBird extends IBird
{
    public function fly();
}

abstract class FlyingBird implements IFlyingBird
{
    public function fly()
    {
        echo '<h2>I believe I can fly !</h2>';
    }

}

class Duck extends FlyingBird
{
    public function makeSound()
    {
        echo '<h2>Coin Coin naturel !</h2>';
    }
}

class Ostrich implements IBird
{

    public function makeSound()
    {
        echo '<h2>Bruh !</h2>';
    }
}

class BathDuck implements IBird
{
    private $hasBattery;


    public function __construct($battery = null)
    {
        $this->giveBattery($battery);
    }

    public function giveBattery($battery)
    {
        if($battery !== null)
        {
            $this->hasBattery = true;
        }
    }

    public function makeSound()
    {
        // Il faut une batterie électrique pour émettre un son.
        if($this->hasBattery == true)
        {
            echo '<h2>Coin Coin PAS naturel !</h2>';
        }
    }
}

class Auk implements IBird
{
    public function makeSound()
    {
        echo '<h2>Auk Sound !</h2>';
    }
}



// (...) EXEMPLE DE CODE CLIENT

$birds = [ new Duck(), new Ostrich(), new BathDuck(true), new Auk(),new BathDuck() ];

foreach($birds as $bird)
{
    echo '<h1>Nouvel oiseau : '.get_class($bird).'</h1>';

    try
    {
        $bird->makeSound();

        // S'agit-il d'un oiseau ?
        if($bird instanceof FlyingBird)
        {
            // Oui, donc il doit émettre un son et aussi voler (ou pas ?)
            $bird->fly();
        }

    }
    catch(Exception $exception)
    {
        echo '<h2>ERREUR : '.$exception->getMessage().'</h2>';
    }
}
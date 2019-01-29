<?php
/*
 * http://www.lafabriquedecode.com/blog/2014/03/php-le-design-pattern-observateur/
 */
interface IObserver{
    public function update(ISujet $Isujet);
}

interface ISujet{

    public function attacher(IObserver $observateur);
    public function detacher(IObserver $observateur);
    public function notifier();
}


class WeatherStation implements ISujet
{
    //private $currentWeatherDisplay;
    //private $dangerousWeatherAlert;
    //private $tomorrowWeatherDisplay;

    private $observateurs;

    public function __construct()
    {
        // Création de chaque dispositif lié à la station météo.
        /*
        $this->currentWeatherDisplay  = new CurrentWeatherDisplay();
        $this->dangerousWeatherAlert  = new DangerousWeatherAlert();
        $this->tomorrowWeatherDisplay = new TomorrowWeatherDisplay();
        */
    }


    public function getRain()
    {
        // (...) Code renvoyant le niveau de précipitation.
        return 11.2;
    }

    public function getTemperature()
    {
        // (...) Code renvoyant la température.
        return 8.5;
    }

    public function getWind()
    {
        // (...) Code renvoyant la vitesse du vent.
        return 42;
    }

    /*public function run()
    {
        // Récupération des données des capteurs de la station météo.
        $rain        = $this->getRain();
        $temperature = $this->getTemperature();
        $wind        = $this->getWind();

        // Informe chaque dispositif lié à la station météo des nouvelles données.
        $this->currentWeatherDisplay->refresh($rain, $temperature, $wind);
        $this->dangerousWeatherAlert->refresh($rain, $temperature, $wind);
        $this->tomorrowWeatherDisplay->refresh($rain, $temperature, $wind);
    }*/

    public function attacher(IObserver $observat)
    {
        $this->observateurs[] =$observat;
    }

    public function detacher(IObserver $observat)
    {
        $key = array_search($observat, $this->observateurs);

        if( $key !== false){
            unset($this->observateurs[$key]); // détruit la variable
        }
    }

    public function notifier()
    {
        foreach ($this->observateurs as $ob){
            $ob->update($this);
        }
    }
}
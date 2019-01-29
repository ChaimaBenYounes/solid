<?php

class CurrentWeatherDisplay implements  IObserver
{
    public function refresh($rain, $temperature, $wind)
    {
        // Code affichant le niveau de précipitation, la température et la vitesse du vent.
        echo '<h3>CurrentWeatherDisplay</h3><em>Météo en temps réel</em>';
    }

    public function update(ISujet $ISujet)
    {
        $this->refresh($ISujet->getRain(), $ISujet->getTemperature(), $ISujet->getWind());
    }
}
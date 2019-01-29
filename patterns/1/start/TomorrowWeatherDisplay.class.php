<?php

class TomorrowWeatherDisplay implements IObserver
{
    public function refresh($rain, $temperature, $wind)
    {
        /*
         * Code affichant les prévisions de demain basées sur le niveau actuel de précipitations,
         * la température et la vitesse du vent
         */
        echo '<h3>TomorrowWeatherDisplay</h3><em>Prévisions météo pour demain</em>';
    }

    public function update(ISujet $ISujet)
    {
        $this->refresh($ISujet->getRain(), $ISujet->getTemperature(), $ISujet->getWind());
    }
}
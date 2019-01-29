<?php

class DangerousWeatherAlert implements IObserver
{
    public function refresh($rain, $temperature, $wind)
    {
        // Code alertant l'utilisateur si les conditions météorologiques sont dangereuses.
        echo '<h3>DangerousWeatherAlert</h3><em>Bulletin vigilance météo</em>';
    }

    public function update(ISujet $ISujet)
    {
        $this->refresh($ISujet->getRain(), $ISujet->getTemperature(), $ISujet->getWind());
    }
}
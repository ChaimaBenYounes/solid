<?php

class DangerousWeatherAlert implements IWeatherObserver
{
    public function refresh($rain, $temperature, $wind)
    {
        // Code alertant l'utilisateur si les conditions météorologiques sont dangereuses.
        echo '<h3>DangerousWeatherAlert</h3><em>Bulletin vigilance météo</em>';
    }
}
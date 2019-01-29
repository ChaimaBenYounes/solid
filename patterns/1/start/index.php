<meta charset="utf8">
<?php

include 'WeatherStation.class.php';
include 'CurrentWeatherDisplay.class.php';
include 'DangerousWeatherAlert.class.php';
include 'TomorrowWeatherDisplay.class.php';




// Création de la station météo (le sujet).
$weatherStation = new WeatherStation();
$weatherStation->attacher(new CurrentWeatherDisplay());

$weatherStation->attacher(new DangerousWeatherAlert());

$weatherStation->attacher(new TomorrowWeatherDisplay());
// Exécution de la station météo.
$weatherStation->notifier();

$weatherStation->detacher(new TomorrowWeatherDisplay());

$weatherStation->notifier();
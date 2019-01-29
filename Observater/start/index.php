<meta charset="utf8">
<?php

include 'IWeatherObserver.php';

include 'CurrentWeatherDisplay.php';
include 'DangerousWeatherAlert.php';
include 'TomorrowWeatherDisplay.php';

include 'WeatherStationSubject.php';



// Création de la station météo (le sujet).
$weatherStation = new WeatherStationSubject();

/*
 * Création des dispositifs météo (les observateurs) et enregistrement de chacun d'eux auprès du
 * sujet. C'est ici que la dépendance entre le sujet et les observateurs est créé.
 */
$weatherStation->registerWeatherObserver(new CurrentWeatherDisplay());
$weatherStation->registerWeatherObserver(new DangerousWeatherAlert());
$weatherStation->registerWeatherObserver(new TomorrowWeatherDisplay());


// Exécution de la station météo.
$weatherStation->run();
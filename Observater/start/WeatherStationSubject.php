<?php

class WeatherStationSubject
{
    /**
     * @var IWeatherObserver[] $weatherObservers
     */
    private $weatherObservers;


    public function __construct()
    {
        // Au départ il n'y a aucun dispositif lié à la station météo.
        $this->weatherObservers = [];
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

    public function registerWeatherObserver(IWeatherObserver $weatherObserver)
    {
        /*
         * Création d'un lien entre la station météo et le dispositif spécifié.
         *
         * On dit aussi que le dispositif, qui est un observateur, va s'abonner à la station météo,
         * qui est le sujet. Il y a donc bien une relation de un à plusieurs (one-to-many).
         */

        // Est-ce que le dispositif météo a déjà été lié à la station météo ?
        if(in_array($weatherObserver, $this->weatherObservers) == false)
        {
            // Non pas encore, ajout du dispositif météo à la liste des observateurs.
            array_push($this->weatherObservers, $weatherObserver);
        }
    }

    public function run()
    {
        // Récupération des données des capteurs de la station météo.
        $rain        = $this->getRain();
        $temperature = $this->getTemperature();
        $wind        = $this->getWind();

        // Informe chaque dispositif lié à la station météo des nouvelles données.
        foreach($this->weatherObservers as $weatherObserver)
        {
            $weatherObserver->refresh($rain, $temperature, $wind);
        }
    }

    public function unregisterWeatherObserver(IWeatherObserver $weatherObserver)
    {
        // Recherche dans la liste des observateur du dispositif météo spécifié.
        $index = array_search($weatherObserver, $this->weatherObservers);

        // Est-ce que le dispositif météo spécifié a été trouvé ?
        if($index !== false)
        {
            // Oui, suppression du dispositif météo de la liste des observateurs.
            array_splice($this->weatherObservers, $index, 1);
        }
    }
}
<?php

interface IWeatherObserver
{
    public function refresh($rain, $temperature, $wind);
}
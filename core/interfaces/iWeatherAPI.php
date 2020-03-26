<?php

namespace App\Core\Interfaces;

interface iWeatherAPI
{

    public function getWeatherByCoordinates($lon,$lat);

}
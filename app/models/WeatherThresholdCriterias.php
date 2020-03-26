<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WeatherThresholdCriterias extends aModel
{
    static protected $table_name='weather_threshold_criterias';
    static protected $column_names=[
        'value',
        'sign',
    ];
}
<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WeatherCriterias extends aModel
{
    static protected $table_name='weather_criterias';
    static protected $column_names=[
        'weather_data_type_id',
        'value',
        'weather_threshold_criteria_id',
    ];
}
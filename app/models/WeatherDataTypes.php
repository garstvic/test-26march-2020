<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WeatherDataTypes extends aModel
{
    static protected $table_name='weather_data_types';
    static protected $column_names=[
        'value',
    ];
}
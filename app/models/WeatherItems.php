<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WeatherItems extends aModel
{
    static protected $table_name='weather_items';
    static protected $column_names=[
        'city_id',
        'temperature_item_id',
        'pressure_item_id',
        'humanity_item_id',
        'wind_item_id'
    ];
}
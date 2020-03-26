<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WeatherItemsConformingConditions extends aModel
{
    static protected $table_name='weather_items_conforming_conditions';
    static protected $column_names=[
        'weather_item_id',
        'weather_condition_id'
    ];

}
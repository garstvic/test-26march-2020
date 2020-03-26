<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class TemperatureItems extends aModel
{
    static protected $table_name='temperature_items';
    static protected $column_names=[
        'now',
        'min',
        'max',
        'temperature_unit_id',
    ];
}
<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class TemperatureUnits extends aModel
{
    static protected $table_name='temperature_units';
    static protected $column_names=[
        'sign',
        'name',
    ];
}
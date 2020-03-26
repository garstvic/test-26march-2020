<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class PressureItems extends aModel
{
    static protected $table_name='pressure_items';
    static protected $column_names=[
        'value',
        'unit',
    ];
}
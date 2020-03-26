<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WindDirectionItems extends aModel
{
    static protected $table_name='wind_direction_items';
    static protected $column_names=[
        'value',
        'unit',
        'description',
    ];
}
<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class HumidityItems extends aModel
{
    static protected $table_name='humidity_items';
    static protected $column_names=[
        'value',
        'unit',
    ];
}
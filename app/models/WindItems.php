<?php

namespace App\Models;

use App\Core\Abstracts\aModel;

class WindItems extends aModel
{
    static protected $table_name='wind_items';
    static protected $column_names=[
        'value',
        'unit',
        'wind_description_id',
    ];
}
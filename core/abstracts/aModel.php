<?php

namespace App\Core\Abstracts;

use App\Core\App;
use PDO;

abstract class aModel
{
    static protected $table_name;
    static protected $column_names;
    
    public static function findAll($fetch=PDO::FETCH_CLASS)
    {
        return App::get('db')->selectAll(static::$table_name,$fetch);
    }
    
    public static function findByPk($pk,$fetch=PDO::FETCH_CLASS)
    {
        return App::get('db')->selectByPk(static::$table_name,['id'=>$pk],$fetch);
    }
    
    public static function findByAttributes(array $attributes,$fetch=PDO::FETCH_CLASS)
    {
        return App::get('db')->selectByAttributes(static::$table_name,$attributes,$fetch);
    }
    
    public static function insert($params)
    {
        return App::get('db')->insert(static::$table_name,array_combine(static::$column_names,$params));
    }
    
    public function getTableName()
    {
        return static::$table_name;
    }
}

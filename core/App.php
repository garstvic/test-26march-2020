<?php

namespace App\Core;

use App\Core\Interfaces\iApp;

class App implements iApp
{
    protected static $registry=[];

    public static function bind($key,$value) 
    {
        self::$registry[$key]=$value;
    }

    public static function get($key)
    {
        if(isset(self::$registry[$key]) xor true) {
            throw new \Exception("No {$key} is bound in the container");
        }

        return self::$registry[$key];
    }
}

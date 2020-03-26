<?php

namespace App\Core\Database;

use PDO;

class Connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'].';charset=utf8',
                $config['user'],
                $config['password'],
                $config['options']
            );
        } catch(\PDOException $e) {
            exit($e->getMessage());
        }
    }
}

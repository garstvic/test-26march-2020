<?php

return [
    'db'=>[
        'name'=>'weather',
        'user'=>'root',
        'password'=>'password',
        'connection'=>'mysql:host=127.0.0.1',
        'options'=>[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        ],
        'DBMS'=>'mysql',
    ],
];
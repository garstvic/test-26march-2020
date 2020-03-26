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
    'api'=>[
        'openweathermap'=>[
            'api_key'=>'dd636b24b1abc4ac48c911078c384a50',
        ],
    ],
];
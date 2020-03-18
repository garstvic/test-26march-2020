<?php

return [
    'db'=>[
        'name'=>'mytodo',
        'user'=>'root',
        'password'=>'password',
        'connection'=>'mysql:host=127.0.0.1',
        'options'=>[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        ],
    ],
];
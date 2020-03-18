<?php

use App\Core\App;

App::bind('config',require 'config.php');

App::bind('db',new QueryBuilder(
    Connection::make(App::get('config')['db'])
));

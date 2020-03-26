<?php

use App\Core\App;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;
use Aura\SqlQuery\QueryFactory;

App::bind('config',require 'config.php');

App::bind('db',new QueryBuilder(
    Connection::make(App::get('config')['db']),new QueryFactory(App::get('config')['db']['DBMS'])
));

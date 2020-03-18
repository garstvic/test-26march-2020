<?php

namespace App\Core;

use App\Core\Interfaces\iController;

class Controller implements iController
{
    public function view($name,$params=[])
    {
        extract($params);

        require "app/views/{$name}.view.php";
    }
    
    public function redirect($uri)
    {
        header("Location: /{$uri}");
    }
}
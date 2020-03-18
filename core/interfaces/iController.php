<?php

namespace App\Core\Interfaces;

interface iController
{
    public function view($name,$params);
    public function redirect($uri);
}
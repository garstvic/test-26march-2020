<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Capitals;

class CapitalsController extends Controller
{
    public function index()
    {
        return $this->view('capitals',[
            'capitals'=>Capitals::findAll(),
        ]);
    }
}

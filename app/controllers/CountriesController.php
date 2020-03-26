<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Countries;

class CountriesController extends Controller
{
    public function index()
    {
        return $this->view('countries',[
            'countries'=>Countries::findAll(),
        ]);
    }
}

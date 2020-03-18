<?php

namespace App\Controllers;

use App\Core\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return $this->view('index');
    }
    
    public function contact()
    {
        return $this->view('contact');
    }
    
    public function about()
    {
        $company="Laravel";

        return $this->view('about',['company'=>$company]);
    }
}
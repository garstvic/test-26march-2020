<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\App;

class UsersController extends Controller
{
    public function index()
    {
        $users=App::get('db')->selectAll('users');

        return $this->view('users',[
            'users'=>$users,
        ]);
    }
    
    public function store()
    {
        App::get('db')->insert('users',[
            'name'=>$_POST['name'],
        ]);
        
        $this->redirect('users');        
    }
}

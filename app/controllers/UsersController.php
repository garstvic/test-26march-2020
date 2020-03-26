<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\App;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $users=Users::findAll();

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

<?php

namespace App\Controllers;

use App\Libraries\View;
use App\Models\UserModel;

class AdminController
{

    public function index()
    {
        View::render('admin/main.view', [
            'users'     => UserModel::load()->all(),
        ]);
        
    }
}
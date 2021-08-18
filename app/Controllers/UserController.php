<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\UserModel;
use App\Libraries\View;
use App\Models\RoleModel;

class UserController
{
    //  Show user record
     
    public function index()
    {
        $userId = Helper::getIdFromUrl('user');

        Helper::checkUrlIdAgainstLoginId($userId);
        
        View::render('users/index.view', [
            'user'   => UserModel::load()->get($userId),
        ]);
   }

    // Show a form to create a new user
    
    public function create()
    {
        View::render('users/create.view', [
            'method'    => 'POST',
            'action'    => '/user/store',
            'roles'     => RoleModel::load()->all(),
        ]);
    }

    // Store a user record in the database
     
    public function store()
    {
        // Save post data in $user var
        $user = $_POST;
        
        // Create a password, set created_by ID and set the date of creation
        $user['password'] = password_hash('Gorilla1!', PASSWORD_DEFAULT);
        $user['created_by'] = Helper::getUserIdFromSession();
        $user['created'] = date('Y-m-d H:i:s');

        // Save the record to the database
        UserModel::load()->store($user);
    }

    // Show a form to edit a user record
     
    public function edit()
    {
        $userId = Helper::getIdFromUrl('user');

        Helper::checkUrlIdAgainstLoginId($userId);

        View::render('users/edit.view', [
            'method'    => 'POST',
            'action'    => '/user/' . $userId . '/update',
            'user'      => UserModel::load()->get($userId),
            'roles'     => RoleModel::load()->all(),
        ]);
    }

    // Update a user record in the database
     
    public function update()
    {
        $userId = Helper::getIdFromUrl('user');

        // Save post data in $user
        $user = $_POST;
        
        // Save record to database
        UserModel::load()->update($user, $userId);

        View::redirect('user/' . $userId);
    }

    //  Archive a user record into the database (soft delete)
    
    public function destroy()
    {
        $userId = Helper::getIdFromUrl('user');
        
        if ((Helper::checkUrlIdAgainstLoginId($userId)) !== 'super-admin') {
            Usermodel::load()->destroy($userId);
        } else { 
            View::render('errors/403.view', [
                'message' => 'You cannot delete yourself!',
            ]);
        }
    }

}


<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\View;
use App\Models\EducationModel;
use App\Models\UserModel;

class EducationController
{
    // Show a list of educations for the selected user
    public function index()
    {
        $userId = Helper::getUserIdFromSession();       
        
        View::render('educations/index.view', [
            'educations' => EducationModel::load()->userEducations($userId),
        ]);
    }

    // Show education record
    public function show()
    {
        $educationId = Helper::getIdFromUrl('education');
        Helper::checkUserIdAgainstLoginId(EducationModel::class, $educationId);
       
        View::render('educations/show.view', [
            'education'     => EducationModel::load()->get($educationId),
        ]);
    }

    // Show a form to add educations
    public function create()
    {
        View::render('educations/create.view', [
            'method'    => 'POST',
            'action'    => '/education/store',
            'users'     => UserModel::load()->all(),
        ]);
    }

    // Store an education record in the database
    public function store()
    {
        // Sets end year to NULL if not set
        if((int)$_POST['end_year'] === 0) {
	        $_POST['end_year'] = NULL;
        }
        
        // Saves post data in education var
        $education = $_POST;
        
        // Links with a user ID, set created by ID and set created date
        if (!isset($education['user_id'])) {
            $education['user_id'] = Helper::getUserIdFromSession();
        }
        $education['created_by'] = Helper::getUserIdFromSession();
        $education['created'] = date('Y-m-d H:i:s');
        
        // Save the record to the database
        EducationModel::load()->store($education);
        View::redirect('education');
    }

    // Show a form to edit an education record
    public function edit()
    {
        $educationId = Helper::getIdFromUrl('education');
        Helper::checkUserIdAgainstLoginId(EducationModel::class, $educationId);

        View::render('educations/edit.view', [
            'method'    => 'POST',
            'action'    => '/education/' . $educationId . '/update',
            'education' => EducationModel::load()->get($educationId),
            'users'     => UserModel::load()->all(),
        ]);
    }

    // Update an education record
    public function update()
    {
        $educationId = Helper::getIdFromUrl('education');

        // Sets end year to NULL if not set
        if((int)$_POST['end_year'] === 0) {
	        $_POST['end_year'] = NULL;
        }
        
        // Saves post data in education var
        $education = $_POST;

        // Save record to database
        EducationModel::load()->update($education, $educationId);

        View::redirect('education/' . $educationId);
    }

    // Archive an education record into the database (soft delete)
    public function destroy()
    {
        $educationId = Helper::getIdFromUrl('education');
        Helper::checkUserIdAgainstLoginId(EducationModel::class, $educationId);
        
        EducationModel::load()->destroy($educationId);
        View::redirect('education');
    }
}
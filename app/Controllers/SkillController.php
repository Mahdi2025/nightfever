<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\View;
use App\Models\SkillModel;
use App\Models\UserModel;

class SkillController
{
    // Show a list of skills for the selected user
    public function index()
    {
        $userId = Helper::getUserIdFromSession();

        View::render('skills/index.view', [
            'skills'    => SkillModel::load()->userSkills($userId),
        ]);
    }

    // Show skill record
    public function show()
    {
        $skillId = Helper::getIdFromUrl('skill');
        Helper::checkUserIdAgainstLoginId(SkillModel::class, $skillId);

        View::render('skills/show.view', [
            'skill'     => SkillModel::load()->get($skillId),
        ]);
    }

    // Show a form to add skills
    public function create()
    {
        View::render('skills/create.view', [
            'method'    => 'POST',
            'action'    => '/skill/store',
            'users'     => UserModel::load()->all(),
        ]);
    }

    // Store a skill record in the database
    public function store ()
    {
        // Sets info to NULL if not set
        if($_POST['info'] === "") {
	        $_POST['info'] = NULL;
        }

        // Saves post data in skill var
        $skill = $_POST;
        
        // Links with a user ID, set created by ID and set created date
        if (!isset($skill['user_id'])) {
            $skill['user_id'] = Helper::getUserIdFromSession();
        }
        $skill['created_by'] = Helper::getUserIdFromSession();
        $skill['created'] = date('Y-m-d H:i:s');
        
        // Save the record to the database
        SkillModel::load()->store($skill);
        View::redirect('skill');
    }

    // Show a form to edit an skill record
    public function edit()
    {
        $skillId = Helper::getIdFromUrl('skill');
        Helper::checkUserIdAgainstLoginId(SkillModel::class, $skillId);

        View::render('skills/edit.view', [
            'method'    => 'POST',
            'action'    => '/skill/' . $skillId . '/update',
            'skill'     => SkillModel::load()->get($skillId),
            'users'     => UserModel::load()->all(),
        ]);
    }

    // Update a skill record
    public function update()
    {
        $skillId = Helper::getIdFromUrl('skill');

        // Sets info to NULL if not set
        if($_POST['info'] === "") {
	        $_POST['info'] = NULL;
        }

        // Saves post data in skill var
        $skill = $_POST;
        
        // Saves record to database
        SkillModel::load()->update($skill, $skillId);

        View::redirect('skill');
    }

    // Archive a skill record into the database (soft delete)
    public function destroy()
    {
        $skillId = Helper::getIdFromUrl('skill');
        Helper::checkUserIdAgainstLoginId(SkillModel::class, $skillId);

        SkillModel::load()->destroy($skillId);
        View::redirect('skill');
    }
}
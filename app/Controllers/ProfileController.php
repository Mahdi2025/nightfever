<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\View;
use App\Models\EducationModel;
use App\Models\HobbyModel;
use App\Models\JobModel;
use App\Models\SkillModel;
use App\Models\UserModel;

class ProfileController
{
    public function index()
    {
        $userId = Helper::getIdFromUrl('profile');
        Helper::checkUrlIdAgainstLoginId($userId);

        View::render('profile/index.view', [
            'user'          => UserModel::load()->get($userId),
            'educations'    => EducationModel::load()->userEducations($userId),
            'jobs'          => JobModel::load()->userJobs($userId),
            'skills'        => SkillModel::load()->userSkills($userId),
            'hobbies'       => HobbyModel::load()->userHobbies($userId),
        ]);
    }
}
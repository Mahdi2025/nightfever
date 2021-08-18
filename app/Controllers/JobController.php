<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\View;
use App\Models\JobModel;
use App\Models\UserModel;

class JobController
{
    // Shows a list of jobs for the selected user

    public function index()
    {
        $userId = Helper::getUserIdFromSession();

        View::render('jobs/index.view', [
            'jobs'      => JobModel::load()->userJobs($userId),
        ]);
    }

    // Shows job record

    public function show()
    {
        $jobId = Helper::getIdFromUrl('job');
        Helper::checkUserIdAgainstLoginId(JobModel::class, $jobId);

        View::render('jobs/show.view', [
            'job'      => JobModel::load()->get($jobId), 
        ]);
    }

    // Show a form to add jobs

    public function create()
    {
        View::render('jobs/create.view', [
            'method'    => 'POST',
            'action'    => '/job/store',
            'users'     => UserModel::load()->all(),
        ]); 
    }

    // Store a job record in the database

    public function store()
    {
        // Sets end year to NULL if not set
        if((int)$_POST['end_year'] === 0) {
	        $_POST['end_year'] = NULL;
        }
        
        // Saves post data in job var
        $job = $_POST;
        
        // Links with a user ID, set created by ID and set created date
        if (!isset($job['user_id'])) {
            $job['user_id'] = Helper::getUserIdFromSession();
        }
        $job['created_by'] = Helper::getUserIdFromSession();
        $job['created'] = date('Y-m-d H:i:s');
        
        // Save record to database
        JobModel::load()->store($job);
        View::redirect('job');
    }

    // Show a form to edit a job record

    public function edit()
    {
        $jobId = Helper::getIdFromUrl('job');
        Helper::checkUserIdAgainstLoginId(JobModel::class, $jobId);

        View::render('jobs/edit.view', [
            'method'    => 'POST',
            'action'    => '/job/' . $jobId . '/update',
            'job'       => JobModel::load()->get(($jobId)),
            'users'     => UserModel::load()->all(),
        ]);
    }

    // Update a job record

    public function update()
    {
        $jobId = Helper::getIdFromUrl('job');

        // Sets end year to NULL if not set
        if((int)$_POST['end_year'] === 0) {
	        $_POST['end_year'] = NULL;
        }

        // Saves post data in job var
        $job = $_POST;
        
        // Save record to database
        JobModel::load()->update($job, $jobId);

        View::redirect('job/' . $jobId);
    }

    // Archive a job record into the database (soft delete)

    public function destroy()
    {
        $jobId = Helper::getIdFromUrl('job');
        Helper::checkUserIdAgainstLoginId(JobModel::class, $jobId);

        JobModel::load()->destroy($jobId);
        View::redirect('job');
    }

}
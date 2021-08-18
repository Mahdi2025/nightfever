<?php

namespace App\Models;

use App\Libraries\MySql;
use App\Models\Model;
use PDO;

class JobModel extends Model
{
    // Name of the table
    protected $model = "jobs";

    // Max number of records when fetching all records from table
    protected $limit;

    // Non writable fields
    protected $protectedFields = [
        'id',
        'updated',
        'deleted',
        'updated_by',
        'deleted_by',
    ];

   // Load class 'statically'
    public static function load()
    {
        return new static;
    }

    public function __construct()
    {
        parent::__construct(
            $this->model, 
            $this->limit, 
            $this->protectedFields
        );   
    }

    public function userJobs (int $userId)
    {
        if (empty($userId)) {
            return false;
        }

        $model = $this->model;
        $sql = "SELECT * FROM " . $model . " WHERE user_id=" . $userId . " AND deleted IS NULL ORDER BY start_year DESC";

        return MySql::query($sql)->fetchAll(PDO::FETCH_CLASS);
    }
}
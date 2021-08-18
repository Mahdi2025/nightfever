<?php

namespace App\Models;

class RoleModel extends Model
{

    // Name of the table
    protected $model = "roles";

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

    public function roleName($role_id)
    {
        return $this->get($role_id, ['name']);
    }

}
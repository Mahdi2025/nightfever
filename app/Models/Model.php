<?php

namespace App\Models;

use App\Libraries\MySql;
use App\Libraries\View;
use PDO;

class Model
{
    // Name of the model (table)
    private $model;

    // Max. records when fetching all records
    private $limit;

    private $protectedFields;

    /**
     * Constructor
     * Set $model and $limit from child Model
     */
    public function __construct($model, $limit = null, $protectedFields = null)
    {
        $this->model = $model;
        $this->limit = $limit;
        $this->protectedFields = $protectedFields;
    }
    
    /**
     * Fetching all records from table
     * @return array of objects
     */
    public function all(array $selectedFields = null)
    {
        $fields = "*";
        
        if (!empty($selectedFields) && count($selectedFields) > 0) {
            $fields = $this->composeQuery($selectedFields);
        }

        $sql = "SELECT " . $fields . " FROM " . $this->model . " WHERE deleted IS NULL" . (!empty($this->limit) ? " LIMIT " . $this->limit : "");

        return MySql::query($sql)->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Fetching one record based on the id
     * @return object
     */
    public function get(int $id, array $selectedFields = null)
    {
        if ($id === 0) return null;

        $fields = "*";

        if (is_array($selectedFields) && count($selectedFields) > 0) {
            $fields = $this->composeQuery($selectedFields);
        }

        $sql = "SELECT " . $fields .  " FROM " . $this->model . " WHERE id=" . $id . " AND deleted IS NULL";
        $res = MySql::query($sql)->fetchAll(PDO::FETCH_CLASS);

        if (count($res) === 0) {
            die(View::render('errors/404.view'));
        }

        return count($res) > 0 ? $res[0] : null;
    }

    public function findById($id)
    {
        $data = $this->get($id);
        
        return !is_null($data) ? $data : false;
    }

    /**
     * Saves a record to the model
     * @param $data array
     * @return the ID of the new record
     */
    public function store(array $data)
    {
        return MySql::insert($this->removeIllegalFields($data), $this->model);
    }

    /**
     * Updates a record to the model
     * @param $data array
     */
    public function update(array $data, int $id)
    {
        if ($id === 0) return;

        MySql::update($this->removeIllegalFields($data), $this->model, $id);
    }

    /**
     * Archives a record to the model
     * @param $data array
     */
    public function destroy(int $id)
    {
        Mysql::delete($id, $this->model);
    }

    private function removeIllegalFields(array $data)
    {
        foreach (@$data as $key => $val) {
            if (in_array($key, $this->protectedFields)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
    
    private function composeQuery(array $fields)
    {
        $getFields = '';

        foreach ($fields as $field)
        {
            $getFields .= $field . ',';
        }

        return rtrim($getFields, ',');
    }

}
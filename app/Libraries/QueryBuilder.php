<?php

/**
 * Build queries in an easy way
 * 
 * Example: 
    ->select(['id', 'name'])
    ->where('id', '>', 1)
    ->whereAnd('name', 'LIKE %gorilla')
    ->whereIsNull('deleted')
    ->orderBy('name')
 */

namespace App\Libraries;

class QueryBuilder
{
    public $queryBuilder = '';

    
    /**
     * Select fields
     * @param $fields (array) optional: fields to be selected
     */
    public function select(Array $fields = [])
    {
        // When $fields is empty then select all (*) fields
        if (count($fields) === 0) {
            $fields = ['*'];
        }

        $selectFields = '';

        foreach($fields as $field)
        {
            $selectFields .= $this->composeField($field) . ", ";
        }

        $this->queryBuilder .=  "SELECT " . rtrim($selectFields, ',' . chr(32));

        return $this;
    }

    
    /**
     * Set the table name to select from
     * @param $table (string) the table name
     */
    public function from($table)
    {
        $this->queryBuilder .= " FROM `{$table}`";

        return $this;
    }

    
    /**
     * Creates a where clause for MySQL
     * @param $field (string) the field name
     * @param $operator (string) the operator such as: =, >, <, <>, LIKE etc. etc.
     * @param $value (string) the value
     */
    public function where($field, $operator, $value)
    {
        $field = $this->composeField($field);
        
        $this->queryBuilder .= " WHERE {$field}{$operator}{$value}";

        return $this;
    }

    
    /**
     * Creates a AND operation on the query
     * @param $field (string) the field name
     * @param $operator (string) the operator such as: =, >, <, <>, LIKE etc. etc.
     * @param $value (string) the value
     */
    public function whereAnd($field, $operator, $value)
    {
        $field = $this->composeField($field);

        $this->queryBuilder .= " AND ({$field}{$operator}{$value})";

        return $this;
    }

    
    /**
     * Creates a IS NULL string
     * @param $field (string) the field name
     * @param $and (bool) toggles an AND operator
     */
    public function whereIsNull($field, $and = false)
    {
        $field = $this->composeField($field);

        $this->queryBuilder .= ($and ? ' AND (' : '') . "`{$field}` IS NULL " . ($and ? ')' : '');

        return $this;
    }

    
    /**
     * Creates a join string
     * @param $joinTable (string) the table to join
     * @param $foreignKey (string) the foreign key
     * @param $table (string) the related table
     * @param $primaryKey (string, default = id) the primary key to compare the foreign key with
     * @param $joinType (string, default = LEFT)
     */
    public function join($joinTable, $foreignKey, $table, $primaryKey = 'id', $joinType = 'LEFT')
    {
        $this->queryBuilder .= $joinType . " JOIN `{$joinTable}` ON `{$joinTable}`.`{$foreignKey}`=`{$table}`.`{$primaryKey}`";

        return $this;
    }

    
    /**
     * Creates an ORDER BY string
     * @param $fields (array) a list of fields to order the data
     */
    public function orderBy(array $fields)
    {
        $composeFields = '';

        foreach($fields as $field)
        {
            $composeFields .= $this->composeField($field);
        }

        $this->queryBuilder .= " ORDER BY " . rtrim($composeFields, ',');

        return $this;
    }


    /**
     * Creates an GROUP BY string
     * @param $fields (array) a list of fields to order the data
     */
    public function groupBy(array $fields)
    {
        $composeFields = '';

        foreach($fields as $field)
        {
            $composeFields .= $this->composeField($field);
        }

        $this->queryBuilder .= " GROUP BY " . rtrim($composeFields, ',');

        return $this;
    }

    /**
     * Creates a LIMIT string
     * @param $limit (string) can be set to anything you like, according the MySQL syntax
     */
    public function limit($limit)
    {
        $this->queryBuilder .= " LIMIT {$limit}";

        return $this;
    }

    /**
     * 'Completing' the query
     */
    public function get()
    {
        return $this->queryBuilder;
    }

    /**
     * Add quotes (`) around fields (except when field has value *)
     * @param $field (string) the name of the field
     */
    private function composeField($field)
    {
        $expl = explode('.', $field);

        $str = (count($expl) === 1 ? "`$field`" : "`$expl[0]`.`$expl[1]`");

        // Remove single quotes (`) when $field equals *
        //  to prevent getting a field name like `*` because this will cause an error in MySQL
        return $field == '*' ? str_replace('`', '', $str) : $str;
    }
}
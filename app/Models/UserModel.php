<?php

namespace App\Models;

use App\Libraries\MySql;
use App\Libraries\QueryBuilder;
use PDO;

class UserModel extends Model
{
    // Name of the table
    protected $model = "users";

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

    /**
     * Check if user exists by email
     * @param $email (string) the email address
     * @param $id (int) optional: the users ID 
     */
    public static function exists($email, int $id = null)
    {
        $query = "SELECT id FROM `users` WHERE `email`='" . $email . "'" . ($id !== null ? " AND id<>" . $id : "");
        
        $result = MySql::query($query)->fetch();

        return $result !== false;
    }

    /**
     * Returns users role
     * @param $user_id (int) the ID of the user
     */
    public function role($user_id = null, $returnRoleName = false)
    {
        $user_id = (int)$user_id;

        if ($user_id === 0) {
            $user_id = $this->getCurrentUser();
        }

        if ($user_id === 0) return false;

        $userRole = (int)$this->get($user_id, ['role'])->role;

        if (!$returnRoleName) {
            return $userRole;
        } else {
            $role = new RoleModel;
            
            return $role->get($userRole)->name;
        }
    }

    /**
     * Returns users permission(s)
     * @param $user_id (int) the ID of the user
     */
    public function permissions($user_id = null)
    {
        $role = $this->role($user_id);

        $qb = new QueryBuilder;

        $qb->select(['permissions.name'])
            ->from('permissions')
            ->join('role_has_permission', 'permission_id', 'permissions')
            ->where('role_has_permission.role_id', '=', $role)
            ->groupBy(['permissions.name'])
            ->orderBy(['permissions.name']);
            
        return MySql::query($qb->get())->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Try to get a user ID from session
     */
    private function getCurrentUser()
    {
        return isset($_SESSION) && 
            isset($_SESSION['user']) && 
            isset($_SESSION['user']['uid']) ? $_SESSION['user']['uid'] : null;
    }
}
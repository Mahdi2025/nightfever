<?php

/** --------------------------------------------------------------------------------------------------------
 * This Middleware class protects your routes with permissions.
 * It requires three tables and a user table (see Database/Migrations)
 * 
 * $route->get('admin', 'App\Controller\{ControllerName.php}, ['{CRUDaction}'] => Permissions::class)
 *  CRUDaction: show, create, read, update and delete.
 * Before a route is executed and a possible view is rendered, it first passes this
 *  Middelware and checks if the requested CRUD action is allowed.
 *  If not, it returns a 403 page
 * ---------------------------------------------------------------------------------------------------------
*/

namespace App\Middleware;

use App\Helpers\Helper;
use App\Models\UserModel;
use App\Libraries\View;

class Permissions
{

    // Data from Router
    protected $route;

    // Permissions are checked for a user
    protected $user = false;

    // Which CRUD action to check
    protected $crudAction;

    protected $redirectWhenNotLoggedIn = 'login';

    // Add name of role that has all permissions
    protected $superUser = 'super-admin';

    public function __construct($route, $crudString)
    {
        $this->route = $route;
        $this->crudAction = $crudString;
        $this->setUser();

        if (!$this->checkPermission()) {
            die(View::render('errors/403.view', [
                'message' => $route . " | " . $crudString
            ]));
        }
    }

    public function getSuperAdmin() 
    {
        return $this->superUser;
    }

    /**
     * Check if the requested permission is allowed
     */
    private function checkPermission()
    {
        // When no user is logged in, return false
        if (!$this->user) {
            return View::redirect($this->redirectWhenNotLoggedIn);
        }

        // Get permissions from user
        $user = new UserModel;
        $userPermissions = $user->permissions();
        
        if ($user->role($this->user->id, true) === $this->superUser) {
            return true;
        }
    
        // Check for routes with slashes and get rid of them
        $firstSlashPositions = strpos($this->route, '/');
        if ($firstSlashPositions !== false) {
            $this->route = substr($this->route, 0, $firstSlashPositions);
        }

        // Check if requested CRUD action is allowed
        return in_array($this->crudAction . '_' . $this->route, $userPermissions);
    }

    /**
     * Get user from session
    */
    private function setUser()
    {
        $userId = Helper::getUserIdFromSession();

        if ($userId !== false) {
            $user = new UserModel;
            $this->user = $user->findById($userId);
        }
    }

}
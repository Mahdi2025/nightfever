<?php

/**
 * This Middelware checks if a user is NOT logged in.
 * If not logged in: return to login page
 * 
 * $route->get('admin', 'App\Controller\{ControllerName.php}, ['auth'] => WhenNotLoggedIn::class)
 * Before a route is executed and a possible view is rendered, it first passes this
 *  Middelware and checks if user is logged in
 */

namespace App\Middleware;

use App\Libraries\View;

class WhenNotLoggedin
{

    protected $redirectTo = 'login';

    /**
     * Check if a user is NOT logged in by checking the session
     * If user is not logged in then redirect to login page
     */

    private $isLoggedIn = false;

    public function __construct()
    {
        $this->isLoggedIn = isset($_SESSION) && isset($_SESSION['user']);
        
        $this->redirect();
    }

    /**
     * Redirect to route
     */
    private function redirect()
    {
        if (!$this->isLoggedIn) {
            View::redirect($this->redirectTo);
        }
    }
}
<?php

/**
 * This Middelware checks if a user is logged in.
 * If not: return to login page
 * 
 * $route->get('admin', 'App\Controller\{ControllerName.php}, ['auth] => WhenLoggedIn::class)
 * Before a route is executed and a possible view is rendered, it first passes this Middelware
 *  and checks if user is logged in
 */

namespace App\Middleware;

use App\Libraries\View;

class WhenLoggedIn
{

    protected $redirectTo = 'admin';

    /**
     * Check if a user is logged in by checking the session
     * If user is logged in then redirect to admin page
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
        if ($this->isLoggedIn) {
            View::redirect($this->redirectTo);
        }
    }

}
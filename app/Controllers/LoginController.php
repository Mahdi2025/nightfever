<?php

namespace App\Controllers;

use App\Libraries\View;
use App\Libraries\MySql;
use App\Middleware\WhenLoggedIn;

class LoginController
{
    protected $redirectWhenLoggedIn = '/';


    public function __construct($function = null)
    {
        if (!empty($function)) {
            if (method_exists(get_class(), $function)) {
                $this->$function();
            }
        }
    }


    /**
     * Return the login view or,
     * when there's already a login session (user), then
     * redirect to the home page
     */
    public function index()
    {
        // Middleare to check if user is allready logged in
        // and if so redirect to route which is specified in MiddleWare
        new WhenLoggedIn;

        return View::render('credentials/login.view');
    }


    /**
     * Check user credentials
     * This is a Ajax POST
     */
    public function login()
    {
        if (isset($_REQUEST['email']) && isset($_REQUEST['password']))
        {
            $sql = "SELECT * FROM `users` WHERE `email`='" . $_REQUEST['email'] . "'";
            $res = MySql::query($sql)->fetch();

            if ($res !== false) {
                if (password_verify($_REQUEST['password'], $res['password'])) {
                    $this->setUserSession($res);

                    return json_encode([
                        'success'  => true, 
                        'message'  => "Succesfull loged in.",
                        'redirect' => $this->redirectWhenLoggedIn,
                    ]);
                } else {
                    return json_encode([
                        'success' => false,
                        'message' => "Username and/or password incorrect"
                    ]);
                }
            } else {
                return json_encode([
                    'success' => false,
                    'message' => "Username and/or password incorrect."
                ]);
            }
        }
    }


    public function logout()
    {
        session_destroy();

        View::redirect("login");
    }
    

    /**
     * Write user data to SESSION
     */
    private function setUserSession($user) : void
    {
        $_SESSION['user'] = [
            'uid'        => (int)$user['id'],
            'role'       => (int)$user['role'],
            'first_name' => $user['first_name'],
            'insertion'  => $user['insertion'],
            'last_name'  => $user['last_name'],
            'full_name'  => $user['first_name'] . (!empty($user['insertion']) ? $user['insertion'] : "") . " " . $user['last_name'],
        ];
    }
}
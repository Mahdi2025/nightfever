<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\View;

class HomeController {

    public function index()
    {
        $userId = Helper::getUserIdFromSession();

        if (Helper::isLoggedInAsSuperAdmin()) {
            View::redirect('admin');
        } else if (Helper::isLoggedIn()) {
            View::redirect('profile/' . $userId);
        } else {
            View::redirect('login');
        }
    }
}
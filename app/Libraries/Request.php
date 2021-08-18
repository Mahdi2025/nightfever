<?php

namespace App\Libraries;

class Request
{
    public function request()
    {

    }

    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::checkFormTokens();
        }

        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Check if request is an ajax request
     */
    public static function ajax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * Compare form token with the one in the session
     */
    private static function checkFormTokens() : void
    {
        $expired = false;

        if (!isset($_SESSION['token']) || !isset($_POST['f_token'])) {
            $expired = true;
        } elseif ($_SESSION['token'] != $_POST['f_token']) {
            $expired = true;
        } else if (time() - (int)$_SESSION['token_time'] > $_ENV['TOKEN_EXPIRATION_SECONDS']) {
            $expired = true;
        }

        // When not an Ajax call render 'bad-tokens' view
        //  If it is an Ajax call then return JSON string
        if ($expired === true) {
            if (!self::ajax()) {
                die(View::render('errors/bad-tokens.view'));
            } else {
                die(json_encode([
                    'success' => false,
                    'message' => "Formulier verlopen, refresh en probeer opnieuw.",
                ]));
            }
        }
        
        if (isset($_POST['f_token'])) {
            unset($_POST['f_token']);
        }
    }
    
}
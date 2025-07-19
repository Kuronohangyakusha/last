<?php

namespace App\Core\Middlewares;

use App\Core\Session;

class Auth
{
    public function __invoke()
    {
        $session = Session::getInstance();
        
        if (!$session->has('result')) {
            header("Location: " . APP_URL . "/");
            exit;
        }
    }
}
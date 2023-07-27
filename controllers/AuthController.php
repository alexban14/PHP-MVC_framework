<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Class AuthController
 * @author Ban Alexandru <alexandru.ban@gsdgroup.net>
 * @package app\core
 **/
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        if ($request->isPost()) return "Handling login";
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) return "Handling register";
        return $this->render('register');
    }
}

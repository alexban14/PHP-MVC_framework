<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * Class Application
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 **/
class SiteController extends Controller
{
    public function home()
    {
        $this->setLayout('main');
        $params = [
            'name' => 'Ban Alexandru'
        ];
        return Application::$app->router->renderView('home', $params);
    }

    public function contact()
    {
        $this->setLayout('main');
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo '<pre>';
        print_r($body);
        echo '</pre>';
    }
}

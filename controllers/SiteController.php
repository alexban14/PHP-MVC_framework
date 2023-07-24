<?php

namespace app\controllers;

use app\core\Application;

/**
 * Class Application
 * @author Ban Alexandru <alexandru.ban@gsdgroup.net>
 * @package app\core
 **/
class SiteController
{
    public function contact()
    {
        return Application::$app->router->renderView('contact');
    }

    public function handleContact()
    {
        return 'Handling submited data';
    }
}

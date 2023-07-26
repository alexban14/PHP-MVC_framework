<?php


namespace app\core;

use app\core\Application;

/**
 * Class Controller
 * @author Ban Alexandru <alexandru.ban@gsdgroup.net>
 * @package app\core
 **/
class Controller
{
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}

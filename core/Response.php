<?php

namespace app\core;


/**
 * Class Response
 * @author Ban Alexandru <alexandru.ban@gsdgroup.net>
 * @package app\core
 **/
class Response
{
    public function setStatusCode(int $code)
    {
       http_response_code($code);
    }
}

<?php

namespace app\core;


/**
 * Class Response
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 **/
class Response
{
    public function setStatusCode(int $code)
    {
       http_response_code($code);
    }
}

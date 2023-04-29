<?php

namespace boctulus\SW\controllers;

use boctulus\SW\core\libs\Logger;

use function PHPSTORM_META\map;

class LogController
{
    function index(){
        dd(
            Logger::getContent()

            // [
            //     'x' => 50,
            //     'yyyy' => 22
            // ]
        );
    }
}

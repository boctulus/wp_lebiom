<?php

namespace boctulus\SW\controllers;

use boctulus\SW\core\libs\Url;
use boctulus\SW\core\libs\Taxes;
use boctulus\SW\core\libs\Request;

class TestController
{
    function index(){
        dd(
            Url::ip()
        );
    }
}

<?php

use application\core\Router;

session_start();
require_once 'const.php';

spl_autoload_register(
    function ($class) {
        $path = str_replace('\\', '/', $class.'.php');
        if (file_exists($path)) {
            require $path;
        }
    }
);

$router = new Router();
$router->run();
<?php

define('ROOT', dirname(__FILE__));
define('DEVMODE', true);

require_once ROOT . '/application/components/Autoload.php';

session_start();

$router = new Router();
$router->run();
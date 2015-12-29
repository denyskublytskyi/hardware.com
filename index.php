<?php

define('ROOT', dirname(__FILE__));
define('DEVMODE', true);

ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once ROOT . '/application/components/Autoload.php';

session_start();

$router = new Router();
$router->run();
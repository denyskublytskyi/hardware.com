<?php

function __autoload($class)
{
    $paths = array(
        '/application/components/',
        '/application/models/'
    );

    foreach($paths as $path)
    {
        $classFile = ROOT . $path . $class . '.php';
        if (file_exists($classFile))
            include_once $classFile;
    }
}
<?php
    require_once('../includes/config.php');

    spl_autoload_register(function ($class){
        $namespaces = include(__app__.'/core/namespaces.php');
        if (! empty($namespaces[$class])) require_once $namespaces[$class];
        
    });
<?php
    if (! defined('db_name')) {
        define( 'db_name', 'phprest');
    }
    
    if (! defined('db_pass')) {
        define( 'db_pass', 'password');
    }
    
    if (! defined('db_user')) {
        define( 'db_user', 'root');
    }

    if (! defined('app_name')) {
        define('app_name', 'PHP REST API TUTORIAL');
    }

    if (! defined('site_path')) {
        define( 'site_path', $_SERVER['DOCUMENT_ROOT']);
    }

    if (! defined('__app__')) {
        define( '__app__', site_path.DIRECTORY_SEPARATOR);
    }
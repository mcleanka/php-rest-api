<?php
    if (! defined('SITE_PATH')) {
        define( 'SITE_PATH', $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
    }

    if (! defined('__app__')) {
        define( '__app__', SITE_PATH);
    }

    define('APP_NAME', 'PHP REST API TUTORIAL');
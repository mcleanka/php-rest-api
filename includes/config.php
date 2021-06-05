<?php
    if (! defined('_FOLDER_PATH_')) {
        define( '_FOLDER_PATH_', $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
    }

    if (! defined('__app__')) {
        define( '__app__', _FOLDER_PATH_);
    }

    define('APP_NAME', 'PHP REST API TUTORIAL');
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('INC_PATH') ? null : define('INC_PATH', __app__ . 'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', __app__ . 'core');
<?php

use NeutronStars\Service\PHPMailer\PHPMailer;
use NeutronStars\View\ViewEngine;

define('BASE_PATH', '');

/*
 * ViewEngine::DEFAULT OR ViewEngine::BLADE
 */
define('VIEW_ENGINE', ViewEngine::DEFAULT);

/* Layouts Folder */
define('LAYOUTS', '../src/layouts');

/* Views Folder */
define('VIEWS', '../src/views');

/* CACHE */
define('BLADE_CACHE', '../cache');

/* DATABASE */
define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);

define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8mb4');
define('DB_FETCH_MODE', PDO::FETCH_OBJ);
define('DB_ERROR_MODE', PDO::ERRMODE_WARNING);

/* Email Settings */
define('MAIL_HOST', '');
define('MAIL_USER', '');
define('MAIL_PASSWORD', '');
define('MAIL_PORT', '');
define('MAIL_CHARSET', PHPMailer::CHARSET_UTF8);
define('MAIL_RECIPIENT_EMAIL', '');
define('MAIL_RECIPIENT_NAME', '');

<?php

define('PROTOCOL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
define('URL', PROTOCOL.'://'.$_SERVER['SERVER_NAME'].'/');

define('MAIN_CONTROLLER', 'home');
define('MAIN_VIEW', 'index');

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'icf');
define('DB_TYPE', 'mysql');
define('DB_CHARSET', 'utf-8');

// Metadata
define('SITE_NAME', 'ICF');
define('SITE_DESCRIPTION', '');
define('APP_VERSION', '');
define('APP_LAST_UPDATE', '');

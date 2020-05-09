<?php

// require core
require_once 'application/core/config.php';
require_once 'application/core/app.php';
require_once 'application/core/controller.php';
require_once 'application/core/model.php';

require_once 'application/models/session_model.php';

$handler = new session_model();
session_set_save_handler($handler, true);
session_start();

$app = new App;

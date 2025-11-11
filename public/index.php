<?php
// filepath: /newcompany/newcompany/public/index.php

// Load the configuration file
require_once '../config/config.php';

// Load the core library
require_once '../app/libraries/Core.php';

// Load the controller library
require_once '../app/libraries/Controller.php';

// Load helper functions
require_once '../app/helpers/session_helper.php';
require_once '../app/helpers/url_helper.php';

// Initialize the core class
$init = new Core();
?>
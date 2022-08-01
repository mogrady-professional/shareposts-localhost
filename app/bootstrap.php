<?php
  // Load Config
  require_once 'config/config.php';
  // Load Helpers
  require_once 'helpers/session_helper.php';
  require_once 'helpers/url_helper.php';

# Require Libaries -> No longer needed as brought in below using spl_autoload_register
// require_once '../app/libraries/Core.php';
// require_once '../app/libraries/Controller.php';
// require_once '../app/libraries/Database.php';


// Create Autoloader to load Required Libraries automatically
// Autoload Core Libraries
spl_autoload_register(function($className) {
    // Filename needs to be the same as the class name
    require_once 'libraries/' . $className . '.php';
});
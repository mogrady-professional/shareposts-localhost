<?php
  /* 
   *  CORE CONTROLLER CLASS
   *  Loads Models & Views
   */
  class Controller {
      // Load Model
        public function model($model)
        {
            // Require model file
            require_once '../app/models/' . $model . '.php';
            // Instantiate model
            return new $model();
        }

        // Load View
        public function view($view, $data = [])
        {
            // Check for view file
            if (file_exists('../app/views/' . $view . '.php')) {
                // if it exists, require it
                require_once '../app/views/' . $view . '.php';
            } else {
                // View does not exist
                die('View does not exist');
            }
        }
  }
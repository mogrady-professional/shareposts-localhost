<?php
  /* 
   *  APP CORE CLASS
   *  Creates URL & Loads Core Controller
   *  URL Format - /controller/method/param1/param2
   */

class Core {
    // Set Properties
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];
    // Changes as URL Changes 
    // Want to put in array

    // Constructor for getUrl()
    public function __construct()
    {
        $this->getUrl(); // Get URL
        // var_dump($this->getUrl()); // Print Array

        $url = $this->getUrl(); 

        // Look in controllers for first value

        // Check if file exists -> (remember everything gets routed through index.php) (ucwords - uppercase first letter)
        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists set as controller
            $this->currentController = ucwords($url[0]);
            // posts/edit/1/22
            // Array ([0] => posts[1] => edit[2] => 1[3] => 22)

            // If posts.php exists in the controllers folder, set as controller
            // Unset 0 Index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of URL
        if (isset($url[1])) { // arrays are 0 indexed
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) { // 2nd part of URL
                $this->currentMethod = $url[1]; // Set as method

                // Unset 1 index
                unset($url[1]);
            }
        }
        // echo $this->currentMethod;
      // Get params - Any values left over in url are params
        $this->params = $url ? array_values($url) : [];

        // (call_user_func_array) Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }


    // Construct URL From $_GET['url']
    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
        }
    }
}
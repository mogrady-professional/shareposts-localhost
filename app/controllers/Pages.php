<?php

class Pages  extends Controller {
    public function __construct()
    {
        // echo 'Pages Constructor';
    }

    public function index()
    {
        
        $data = [
            'title' => 'SharePosts', 
            'description' => 'Simple social network built on the MIMVC PHP framework'
        ];

        $this->view('pages/index', $data);

    }


    public function about(){
        //Set Data
        $data = [
          'version' => '1.0.0'
        ];
  
        // Load about view
        $this->view('pages/about', $data);
      }
}
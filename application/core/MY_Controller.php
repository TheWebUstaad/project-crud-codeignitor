<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    protected $data = array();
    
    public function __construct() {
        parent::__construct();
        $this->data['page_title'] = 'My Website';
        $this->data['content'] = '';
    }
    
    protected function render($view_path, $layout = 'main') {
        // Load the view content
        $this->data['content'] = $this->load->view($view_path, $this->data, TRUE);
        
        // Load the layout
        $this->load->view('layouts/' . $layout, $this->data);
    }
}
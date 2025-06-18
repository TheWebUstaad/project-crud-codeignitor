<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    protected $data = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url', 'form']);
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        // Set common view data
        $this->data['user'] = (object)[
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email'),
            'first_name' => $this->session->userdata('first_name'),
            'last_name' => $this->session->userdata('last_name'),
            'profile_image' => $this->session->userdata('profile_image'),
            'role' => $this->session->userdata('role')
        ];

        // Mark flash data as temp to ensure it's only shown once
        $this->session->mark_as_temp([
            'success', 'error', 'warning', 'info'
        ], 1);
    }
    
    protected function render($view_path, $layout = 'main') {
        // Load the view content
        $this->data['content'] = $this->load->view($view_path, $this->data, TRUE);
        
        // Load the layout
        $this->load->view('layouts/' . $layout, $this->data);
    }

    // Helper method to set flash messages
    protected function set_flash_message($message, $type = 'success') {
        $this->session->set_flashdata($type, $message);
    }
}
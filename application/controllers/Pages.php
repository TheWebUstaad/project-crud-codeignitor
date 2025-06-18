<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session']); // Add session library for flash messages
    }
    
    public function index() {
        $this->data['page_title'] = 'Home';
        $this->render('pages/home');
    }
    
    public function about() {
        $this->data['page_title'] = 'About Us';
        $this->render('pages/about');
    }
    
    public function contact() {
        $this->data['page_title'] = 'Contact Us';
        $this->render('pages/contact');
    }

    public function submit_contact() {
        // Add your contact form processing logic here
        
        // Example of setting a flash message
        $this->session->set_flashdata('success', 'Thank you for your message. We will get back to you soon!');
        
        // Redirect back to contact page
        redirect('contact');
    }
}
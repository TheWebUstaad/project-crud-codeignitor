<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default controller - will show the home page
$route['default_controller'] = 'pages';

// Static pages
$route['home'] = 'pages/index';
$route['about'] = 'pages/about';
$route['contact'] = 'pages/contact';

// Form processing
$route['contact/submit'] = 'pages/submit_contact';

// Keep these default CodeIgniter routes
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
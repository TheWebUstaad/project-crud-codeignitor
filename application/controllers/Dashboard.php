<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation']);
        $this->load->helper(['url', 'form']);
    }
    
    public function index() {
        $this->data['page_title'] = 'Dashboard';
        $this->data['active_menu'] = 'dashboard';
        
        // Get user's courses or other relevant data
        // Add more data as needed for the dashboard
        
        $this->render('dashboard/index');
    }
    
    public function profile() {
        $this->data['page_title'] = 'My Profile';
        $this->data['active_menu'] = 'profile';
        
        $this->render('dashboard/profile');
    }

    public function update_profile() {
        // Set validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            // Convert validation errors to a single string
            $errors = validation_errors('<span>', '</span>');
            $errors = strip_tags($errors); // Remove HTML tags
            $this->session->set_flashdata('error', $errors);
            redirect('dashboard/profile');
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name')
            );

            $updated_user = $this->User_model->update_profile($this->session->userdata('user_id'), $data);

            if ($updated_user) {
                // Update session data
                $this->session->set_userdata([
                    'first_name' => $updated_user->first_name,
                    'last_name' => $updated_user->last_name
                ]);

                $this->session->set_flashdata('success', 'Profile updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update profile. Please try again.');
            }
            
            redirect('dashboard/profile');
        }
    }

    public function update_profile_image() {
        $config['upload_path'] = './uploads/profile_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('profile_image')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect('dashboard/profile');
        } else {
            $upload_data = $this->upload->data();
            
            $old_image = $this->User_model->get_profile_image($this->session->userdata('user_id'));
            if ($old_image && file_exists('./uploads/profile_images/' . $old_image)) {
                unlink('./uploads/profile_images/' . $old_image);
            }
            
            $this->User_model->update_profile_image(
                $this->session->userdata('user_id'),
                $upload_data['file_name']
            );
            
            $this->session->set_userdata('profile_image', $upload_data['file_name']);
            
            $this->session->set_flashdata('success', 'Profile picture updated successfully!');
            redirect('dashboard/profile');
        }
    }

    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('dashboard/profile');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            
            // Get current user
            $user = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
            
            // Verify current password
            if (!password_verify($current_password, $user->password)) {
                $this->session->set_flashdata('error', 'Current password is incorrect');
                redirect('dashboard/profile');
            }
            
            // Update password
            $updated = $this->User_model->update_password(
                $this->session->userdata('user_id'),
                password_hash($new_password, PASSWORD_DEFAULT)
            );
            
            if ($updated) {
                $this->session->set_flashdata('success', 'Password changed successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to change password. Please try again.');
            }
            
            redirect('dashboard/profile');
        }
    }
} 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_email($email) {
        $this->db->select('id, username, email, password, first_name, last_name, profile_image, is_active');
        $query = $this->db->get_where('users', array('email' => $email, 'is_active' => 1));
        return $query->row();
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('users', array('id' => $id, 'is_active' => 1));
        return $query->row();
    }

    public function update_last_login($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('users', array('last_login' => date('Y-m-d H:i:s')));
    }

    public function assign_role($user_id, $role_id) {
        return $this->db->insert('user_roles', array(
            'user_id' => $user_id,
            'role_id' => $role_id
        ));
    }

    public function get_user_role($user_id) {
        $this->db->select('roles.name as role_name');
        $this->db->from('user_roles');
        $this->db->join('roles', 'roles.id = user_roles.role_id');
        $this->db->where('user_roles.user_id', $user_id);
        $query = $this->db->get();
        return $query->row()->role_name;
    }

    public function update_profile_image($user_id, $image_path) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['profile_image' => $image_path]);
    }

    public function get_profile_image($user_id) {
        $this->db->select('profile_image');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        $result = $query->row();
        return $result ? $result->profile_image : null;
    }

    public function update_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        $result = $this->db->update('users', $data);
        
        if ($result) {
            // Get updated user data
            $this->db->select('id, username, email, first_name, last_name, profile_image');
            $this->db->where('id', $user_id);
            return $this->db->get('users')->row();
        }
        
        return false;
    }

    public function update_password($user_id, $hashed_password) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['password' => $hashed_password]);
    }
}
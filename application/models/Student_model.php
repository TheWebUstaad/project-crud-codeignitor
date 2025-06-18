<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_teacher_students($teacher_id) {
        $this->db->select('DISTINCT users.*');
        $this->db->from('users');
        $this->db->join('course_enrollments', 'users.id = course_enrollments.student_id');
        $this->db->join('courses', 'courses.id = course_enrollments.course_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        return $this->db->get()->result();
    }
    
    public function count_teacher_students($teacher_id) {
        $this->db->select('DISTINCT users.id');
        $this->db->from('users');
        $this->db->join('course_enrollments', 'users.id = course_enrollments.student_id');
        $this->db->join('courses', 'courses.id = course_enrollments.course_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        return $this->db->count_all_results();
    }
} 
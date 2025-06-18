<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function create($data) {
        return $this->db->insert('courses', $data);
    }
    
    public function get_teacher_courses($teacher_id) {
        $this->db->where('teacher_id', $teacher_id);
        return $this->db->get('courses')->result();
    }
    
    public function count_teacher_courses($teacher_id) {
        $this->db->where('teacher_id', $teacher_id);
        return $this->db->count_all_results('courses');
    }
    
    public function get_course($course_id) {
        return $this->db->get_where('courses', ['id' => $course_id])->row();
    }
    
    public function get_recent_enrollments($teacher_id, $limit = 5) {
        $this->db->select('course_enrollments.*, courses.title as course_title, users.first_name, users.last_name');
        $this->db->from('course_enrollments');
        $this->db->join('courses', 'courses.id = course_enrollments.course_id');
        $this->db->join('users', 'users.id = course_enrollments.student_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        $this->db->order_by('course_enrollments.enrolled_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
} 
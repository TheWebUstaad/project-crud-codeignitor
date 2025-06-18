<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function create($data) {
        return $this->db->insert('assignments', $data);
    }
    
    public function get_teacher_assignments($teacher_id) {
        $this->db->select('assignments.*, courses.title as course_title');
        $this->db->from('assignments');
        $this->db->join('courses', 'courses.id = assignments.course_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        return $this->db->get()->result();
    }
    
    public function count_teacher_assignments($teacher_id) {
        $this->db->from('assignments');
        $this->db->join('courses', 'courses.id = assignments.course_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        return $this->db->count_all_results();
    }
    
    public function count_pending_submissions($teacher_id) {
        $this->db->from('assignment_submissions');
        $this->db->join('assignments', 'assignments.id = assignment_submissions.assignment_id');
        $this->db->join('courses', 'courses.id = assignments.course_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        $this->db->where('assignment_submissions.status', 'pending');
        return $this->db->count_all_results();
    }
    
    public function get_recent_submissions($teacher_id, $limit = 5) {
        $this->db->select('assignment_submissions.*, assignments.title as assignment_title, 
                          courses.title as course_title, users.first_name, users.last_name');
        $this->db->from('assignment_submissions');
        $this->db->join('assignments', 'assignments.id = assignment_submissions.assignment_id');
        $this->db->join('courses', 'courses.id = assignments.course_id');
        $this->db->join('users', 'users.id = assignment_submissions.student_id');
        $this->db->where('courses.teacher_id', $teacher_id);
        $this->db->order_by('assignment_submissions.submitted_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function grade_submission($submission_id, $data) {
        $this->db->where('id', $submission_id);
        return $this->db->update('assignment_submissions', $data);
    }
} 
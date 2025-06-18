<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        // Check if user is a teacher
        if($this->session->userdata('role') !== 'teacher') {
            $this->session->set_flashdata('error', 'Access Denied. Teachers only.');
            redirect('dashboard');
        }
        $this->load->model('Course_model');
        $this->load->model('Assignment_model');
        $this->load->model('Student_model');
    }
    
    public function index() {
        $this->data['page_title'] = 'Teacher Dashboard';
        $this->data['active_menu'] = 'teacher_dashboard';
        
        // Get teacher's statistics
        $teacher_id = $this->session->userdata('user_id');
        $this->data['total_courses'] = $this->Course_model->count_teacher_courses($teacher_id);
        $this->data['total_students'] = $this->Student_model->count_teacher_students($teacher_id);
        $this->data['total_assignments'] = $this->Assignment_model->count_teacher_assignments($teacher_id);
        $this->data['pending_submissions'] = $this->Assignment_model->count_pending_submissions($teacher_id);
        
        // Get recent activities
        $this->data['recent_submissions'] = $this->Assignment_model->get_recent_submissions($teacher_id);
        $this->data['recent_enrollments'] = $this->Course_model->get_recent_enrollments($teacher_id);
        
        $this->render('teacher/dashboard');
    }

    public function courses() {
        $this->data['page_title'] = 'My Courses';
        $this->data['active_menu'] = 'teacher_courses';
        
        $teacher_id = $this->session->userdata('user_id');
        $this->data['courses'] = $this->Course_model->get_teacher_courses($teacher_id);
        
        $this->render('teacher/courses');
    }

    public function create_course() {
        $this->data['page_title'] = 'Create New Course';
        $this->data['active_menu'] = 'teacher_courses';

        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Course Title', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $data = array(
                    'teacher_id' => $this->session->userdata('user_id'),
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                    'status' => 'active'
                );

                if ($this->Course_model->create($data)) {
                    $this->session->set_flashdata('success', 'Course created successfully!');
                    redirect('teacher/courses');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create course.');
                }
            }
        }

        $this->render('teacher/create_course');
    }

    public function assignments($course_id = null) {
        $this->data['page_title'] = 'Assignments';
        $this->data['active_menu'] = 'teacher_assignments';
        
        $teacher_id = $this->session->userdata('user_id');
        
        if ($course_id) {
            $this->data['assignments'] = $this->Assignment_model->get_course_assignments($course_id);
            $this->data['course'] = $this->Course_model->get_course($course_id);
        } else {
            $this->data['assignments'] = $this->Assignment_model->get_teacher_assignments($teacher_id);
        }
        
        $this->render('teacher/assignments');
    }

    public function create_assignment($course_id) {
        $this->data['page_title'] = 'Create Assignment';
        $this->data['active_menu'] = 'teacher_assignments';
        $this->data['course'] = $this->Course_model->get_course($course_id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Assignment Title', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_rules('due_date', 'Due Date', 'required');
            $this->form_validation->set_rules('max_score', 'Maximum Score', 'required|numeric');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $data = array(
                    'course_id' => $course_id,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'due_date' => $this->input->post('due_date'),
                    'max_score' => $this->input->post('max_score')
                );

                if ($this->Assignment_model->create($data)) {
                    $this->session->set_flashdata('success', 'Assignment created successfully!');
                    redirect('teacher/assignments/' . $course_id);
                } else {
                    $this->session->set_flashdata('error', 'Failed to create assignment.');
                }
            }
        }

        $this->render('teacher/create_assignment');
    }

    public function students() {
        $this->data['page_title'] = 'My Students';
        $this->data['active_menu'] = 'teacher_students';
        
        $teacher_id = $this->session->userdata('user_id');
        $this->data['students'] = $this->Student_model->get_teacher_students($teacher_id);
        
        $this->render('teacher/students');
    }

    public function grade_assignment($submission_id) {
        $this->data['page_title'] = 'Grade Assignment';
        $this->data['active_menu'] = 'teacher_assignments';
        
        $this->data['submission'] = $this->Assignment_model->get_submission($submission_id);
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('score', 'Score', 'required|numeric');
            $this->form_validation->set_rules('feedback', 'Feedback', 'required|trim');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $data = array(
                    'score' => $this->input->post('score'),
                    'feedback' => $this->input->post('feedback'),
                    'graded_at' => date('Y-m-d H:i:s')
                );

                if ($this->Assignment_model->grade_submission($submission_id, $data)) {
                    $this->session->set_flashdata('success', 'Assignment graded successfully!');
                    redirect('teacher/assignments');
                } else {
                    $this->session->set_flashdata('error', 'Failed to grade assignment.');
                }
            }
        }

        $this->render('teacher/grade_assignment');
    }
} 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['title'] = 'Employee Crud | Codeigniter 3';
        $this->load->view('header', $data);
        $this->load->view('employee/index', $data);
        $this->load->view('employee/add', $data);
        $this->load->view('footer');
    }

    public function store(){
        $this->form_validation->set_rules('fname', 'First Name', 'required|min_length[2]');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|min_length[2]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^(0-9|\+639)\d{9}$/]',
                array('regex_match' => 'The Phone number field must be start with +639 or 09 and contain 11 digits.'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if(!$this->form_validation->run()){
            $errors = [
                'fname' => strip_tags(form_error('fname')),
                'lname' => strip_tags(form_error('lname')),
                'phone' => strip_tags(form_error('phone')),
                'email' => strip_tags(form_error('email'))
            ];

            echo json_encode(['status' => 'error', 'errors' => $errors]);
        } else {
            echo json_encode(['status' => 'success']);  
        }
    }
}

?>
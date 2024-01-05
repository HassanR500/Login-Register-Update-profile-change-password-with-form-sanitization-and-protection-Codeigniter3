<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('register');
    }

    public function registerNow()
    {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("username",'Username','trim|required');
            $this->form_validation->set_rules("email",'Email','trim|required|valid_email');
            $this->form_validation->set_rules("password",'Password','trim|required');
            $this->form_validation->set_rules("phone",'Phone Number','trim|required');

            if($this->form_validation->run() == TRUE) {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $enc = sha1($password);
                $phone = $this->input->post('phone');
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $enc,
                    'phone' => $phone,
                    'status' => '1'
                );

                $this->load->model('User_model');
                $this->User_model->insertUser($data);
                
               
                $response['status'] = 'success';
                echo json_encode($response);
            } else {
    
                $response['status'] = 'error';
            	$response['message'] = strip_tags(validation_errors());
                echo json_encode($response);
            }
        } else {
          
            redirect(base_url('register'));
        }
    }
}

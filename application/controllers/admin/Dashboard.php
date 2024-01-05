<?php defined('BASEPATH') or exit('');

class Dashboard extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('security');
    }

    function index(){
        $data['site_title'] = 'Dashboard';
        $this->load->view('dashboard',$data);
    }

    function changePassword(){
        $data['site_title'] = 'Change Password';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->form_validation->set_rules('currentPassword','Current Password','required');
            $this->form_validation->set_rules('password','New Password','required');
            $this->form_validation->set_rules('cpassword','Comfirm New Password','required|matches[password]');
            if($this->form_validation->run()==TRUE){
                $currentPassword = $this->input->post('currentPassword');
                $encryptCurrentPassword = sha1($currentPassword);
                $this->load->model('User_model');
                $check = $this->User_model->checkCurrentPassword($encryptCurrentPassword);

                if ($check == TRUE) {
                    $newPassword = $this->input->post('password');
                    $encryptPassword = sha1($newPassword);
                    $this->User_model->updatePassword($encryptPassword);
            
                    if ($this->input->is_ajax_request()) {
                        echo json_encode(array('success' => true));
                        exit();
                    } else {
                        $this->session->set_flashdata('success', 'Password changed successfully');
                        redirect(base_url('admin/dashboard/changePassword'));
                    }

                } else {

                    if ($this->input->is_ajax_request()) {
                        echo json_encode(array('success' => false, 'message' => 'Current Password is wrong'));
                        exit();
                    } else {
                        $this->session->set_flashdata('error', 'Current Password is wrong');
                        redirect(base_url('admin/dashboard/changePassword'));
                    }

                }
            }else{
                
                $this->load->view('change_password');
            }
        }else{

            $this->load->view('change_password',$data);
        }
    }

    public function updateProfile() {
        $userid = $this->session->userdata('LoginSession')['id'];
        $this->load->model('User_model');
        $userData = $this->User_model->getUserById($userid);
    
        $data['site_title'] = 'Update Profile';
    
        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
    
            if ($this->form_validation->run() == TRUE) {
                $updateData = array(
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'phone' => $this->input->post('phone', TRUE)
                );
    
                $this->User_model->updateUserProfile($userid, $updateData);
    
                if ($this->input->is_ajax_request()) {
                    echo json_encode(array('success' => true));
                    exit();
                } else {
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                    redirect(base_url('admin/dashboard/updatedProfile'));
                }
            } else {

                if ($this->input->is_ajax_request()) {
                    $error = validation_errors();
                    echo json_encode(array('success' => false, 'message' => $error));
                    exit();
                } else {
                    $data['userData'] = $userData;
                    $this->load->view('update_profile', $data);
                }
            }
        }
    
        $data['userData'] = $userData;
        $this->load->view('update_profile', $data);
    }    
 
    function updatedProfile() {
        $userid = $this->session->userdata('LoginSession')['id'];
    
        $this->load->model('User_model');
        $userData = $this->User_model->getUserById($userid);
    
        $data['site_title'] = 'Updated Profile';
        $data['userData'] = $userData;
    
        $this->load->view('update_profile', $data);
    }

}
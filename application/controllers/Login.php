<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	 public function index()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules("email", 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules("password", 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$encrypPassword = sha1($password);

				$this->load->model('User_model');
				$status = $this->User_model->checkUser($email, $encrypPassword);

				if ($status != false) {
					$data = array(
						'username' => $status->username,
						'email' => $status->email,
						'id' => $status->id,
					);

					$this->session->set_userdata('LoginSession', $data);

					$response['success'] = true;
					echo json_encode($response);
					exit();
				} else {
					$response['success'] = false;
					$response['message'] = 'Email or Password is wrong';
					echo json_encode($response);
					exit();
				}
			} else {
				$response['success'] = false;
				$response['message'] = strip_tags(validation_errors());
				echo json_encode($response);
				exit();
			}
		} else {
			$this->load->view('login');
		}
	}

	 function logout(){
		 session_unset();
		 session_destroy();
		 redirect(base_url('login/index'));
	 }
}
<?php
class User extends CI_Controller {
	
	const reg_validate_success = '<i class="icon-ok-circle"></i>';
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->model('UserMapper');
		$this->load->library('ResultBack', 'resultback');
		
		$this->form_validation->set_error_delimiters('<i class="icon-warning-sign"></i><span>', '</span>');		

	}

	public function index() {
		redirect(base_url('rtwork/manage'));
	}
	
	public function login() {
		$this->login_check();
		$login_flag = $this->input->post('login');
		$url_redirect = $this->input->post('url');
		if ($login_flag) {
			$usermapper = $this->UserMapper;
			
			$userdata = array(
					'account' => $this->input->post('account'),
					'password' => $this->input->post('password'));
			$resultback = $usermapper->auth($userdata);
			if ($resultback['code'] == 1) {
				redirect($url_redirect);
			}else {
				$data['error'] = $resultback['msg'];
			}
		}
		
		isset($data)?$this->load->view('user/login', $data):$this->load->view('user/login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
	
	public function register() {
		$this->login_check();
		$register_flag = $this->input->post('register');
		if ($register_flag) {
			$usermapper = $this->UserMapper;
			if ($this->form_validation->run('register') == FALSE) {
				$data['error'] = form_error('username').form_error('email').form_error('password');
			} else {
				
				$userdata = array(
						'username' =>  $this->input->post('username'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
						);
				
				$resultback = $usermapper->register($userdata);
				
				if ($resultback['code'] == 1) {
					$userdata_auth = array(
							'account' =>  $this->input->post('username'),
							'password' => $this->input->post('password'),
							);
					$usermapper->auth($userdata_auth);
					redirect('/');
				}else {
					$data['error'] = $resultback['msg'];
				}
			}
		}
		
		isset($data)?$this->load->view('user/register', $data):$this->load->view('user/register');
		
	}
	
	public function reg_validate($field) {
		if ($this->form_validation->run($field) == FALSE) {
			$this->resultback->setCM($this->resultback->getError(), form_error($field));
		} else {
			$this->resultback->setCM($this->resultback->getSuccess(), self::reg_validate_success);
		}
		echo json_encode($this->resultback->getCM());
	}
	
	
	public function user_check($value) {
		try {
			$this->UserMapper->user_check($value);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function login_check() {
		if ($this->session->userdata('auth') != null) {
			redirect('/');
		}
	}
	
}

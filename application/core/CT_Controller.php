<?php
class CT_Controller extends CI_Controller{
	
	private $userdata;
	
	public function __construct() {
		parent::__construct();
	
		$this->load->helper('url');
	
		if ($this->session->userdata('auth') == null) {
			redirect(base_url('user/login?url='.$_SERVER['REQUEST_URI']));
		} else {
			$this->setUserdata($this->session->userdata('auth'));
		}
	}
	
	/**
	 * @return the $userdata
	 */
	public function getUserdata() {
		return $this->userdata;
	}

	/**
	 * @param mix $userdata
	 */
	public function setUserdata($userdata) {
		$this->userdata = $userdata;
	}

	
}

?>
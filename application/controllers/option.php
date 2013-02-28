<?php
class Option extends CT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('UserMapper');
		$this->load->model('OptionMapper');
		
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add_option() {
		$data = array(
				'name' => $this->input->post('name'),
				//'shortup' => $this->input->post('shortup'),
				);
		
		$resultback = $this->OptionMapper->add($data);
		
		echo json_encode($resultback);
		
	}
	
	public function search_option() {
		$name = $this->input->get('name');
		
		$resultback = $this->OptionMapper->search($name);
		
		echo json_encode($resultback);
	}
}

?>
<?php
class Category extends CT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('CategoryMapper');
		
		$this->load->library('ResultBack', 'resultback');

	}
	
	public function add_category() {
		$data = array(
				'name' => $this->input->post('name'),
				);
		$resultback = $this->CategoryMapper->add($data);
		echo json_encode($resultback);
	}
	
	public function delete_category() {
		$data = array(
				'id' => $this->input->post('id'),
				);
		$resultback = $this->CategoryMapper->delete($data);
		echo json_encode($resultback);
	}
}

?>
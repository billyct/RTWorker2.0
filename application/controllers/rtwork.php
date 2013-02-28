<?php
class Rtwork extends CT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('ComponentMapper');
		$this->load->model('CategoryMapper');
		$this->load->model('LoftingMapper');
		$this->load->library('ResultBack', 'resultback');
	}
	
	
	public function manage() {
		$data['reforced_type'] = array('6','6.5','8', '10', '12', '14', '16', '18', '20', '22', '25' );
		$data['components'] = $this->ComponentMapper->get_all_components();
		$data['categorys'] = $this->CategoryMapper->get_all_categorys();
		$this->load->view('rtwork/manage', $data);
	}
	
	
	public function lofting($id = null) {
		$user = $this->getUserdata();
		$user_data = array(
				'user_id' => $user['id'],
				);
		$data['reforced_type'] = array('6','6.5','8', '10', '12', '14', '16', '18', '20', '22', '25' );
		$data['components'] = $this->ComponentMapper->get_all_components();
		$data['categorys'] = $this->CategoryMapper->get_all_categorys();
		$data['loftings'] = $this->LoftingMapper->get_all_loftings($user_data);
		if ($id) {
			$this->load->view('rtwork/lofting', $data);
		}else {
			$this->load->view('rtwork/lofting', $data);
		}
		
	}
	
	//表格打印
	public function work($id) {
		$typedatas = $this->LoftingMapper->get_typedatas($id);
		$data['title'] = "title";
		$data['typedatas'] = $typedatas;
		$this->load->view('rtwork/work', $data);
	}
}

?>
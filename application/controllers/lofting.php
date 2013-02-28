<?php
class Lofting extends CT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('LoftingMapper');
		
		$this->load->library('ResultBack', 'resultback');
		
	}
	
	public function add_lofting() {
		$loftingmapper = $this->LoftingMapper;
		$user = $this->getUserdata();
		$data = array(
				'name' => $this->input->post('name'),
				'user_id' => $user['id'],
				);
		$resultback = $loftingmapper->add($data);
		echo json_encode($resultback);
	}
	
	public function save_data() {
		$loftingmapper = $this->LoftingMapper;
		$resultback = "";
		$data = array(
				'lofting_id' => $this->input->post('lofting_id'),
				'component_id' => $this->input->post('component_id'),
				'data_lofting' => $this->input->post('data_lofting'),
				'data_work' => $this->input->post('data_work'),
				);

		if ($this->input->post('lofting_component_id')) {
			$resultback = $loftingmapper->update_data($data);
		} else {
			$resultback = $loftingmapper->insert_data($data);
		}
		echo json_encode($resultback);
	}
	
	public function get_lofting($id) {
		$loftingmapper = $this->LoftingMapper;
		
		echo json_encode($loftingmapper->get_lofting($id));
	}
	
	public function delete_data($id=null) {
		$loftingmapper = $this->LoftingMapper;
		$user = $this->getUserdata();
		$data = array(
				'id' => $this->input->post('id'),
		);
		$resultback = $loftingmapper->delete_data($data);
		echo json_encode($resultback);
	}
	
	public function delete_lofting($id=null) {
		$loftingmapper = $this->LoftingMapper;
		$user = $this->getUserdata();
		$data = array(
				'id' => $this->input->post('id'),
				'user_id' => $user['id'],
		);
		$resultback = $loftingmapper->delete($data);
		echo json_encode($resultback);
	}
	
	public function get_total() {
		$id = $this->input->get('lofting_id');
		$loftingmapper = $this->LoftingMapper;
		$resultbacks = $loftingmapper->get_data_total($id);
		$total = 0;
		$formula_valued_array = array();
		foreach ($resultbacks as $resultback) {
			$formula_valued = str_replace($resultback['option_names'], $resultback['values'], $resultback['formula']);
			//echo $formula_valued.'<br />';
			$formula_valued_array[] = $formula_valued;
			eval('$total += '.$formula_valued.';');
		}
		echo json_encode(array('total' => $total, 'formulas' => $formula_valued_array));
	}
	
	
}

?>
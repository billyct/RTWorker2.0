<?php
class ComponentMapper extends CI_Model{
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			//取出属性信息
			$options_id = $data['options_id'];
			unset($data['options_id']);
			//取出表格信息
			$works = $data['works'];
			unset($data['works']);
			
// 			var_dump($options_id);
// 			var_dump($works);
// 			var_dump($data);
			
// 			return false;
			
			$this->db->insert('component', $data);
			$component_id = $this->db->insert_id();
			
			$this->add_option($options_id, $component_id);
			$this->add_work($works, $component_id);
			
			$resultback->setCMD($resultback::success, '添加构件成功', array('id' => $component_id));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加构件失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function get_all_components() {
		$query = $this->db->get('view_components');
		return $query->result_array();
	}
	
	public function get_component($id) {
		
		$this->db->where('component_id', $id);
		$query = $this->db->get('view_components');
		$component = $query->row_array();
		//获取属性
		$this->load->model('OptionMapper');
		$options = $this->OptionMapper->get_options($id);
		//获取表格信息
		$this->load->model('WorkMapper');
		$works = $this->WorkMapper->get_works($id);
		
		$component['options'] = $options;
		$component['works'] = $works;
		
		return $component;
			
	}
	
	private function add_option($options_id, $component_id) {
		$options = null;
		
		foreach ($options_id as $option_id) {
			$options[] = array(
					'option_id' => $option_id,
					'component_id' => $component_id,
			);
		}
		$this->db->insert_batch('component_option', $options);
	}
	
	private function add_work($works, $component_id) {
		foreach ($works as $key => $work) {
			$works[$key]['component_id'] = $component_id;
		}
		
		$this->load->model('WorkMapper');
		$this->WorkMapper->add($works);
	}
	
	public function delete($data) {
		$resultback = $this->resultback;
		try {
			$this->db->where($data);
			$query = $this->db->get('component');
			$component = $query->row_array();
			
			$this->db->delete('component', $data);
			
			$image_id = $component['image_id'];
			$image_data = array('id' => $image_id);
			$this->load->model('ImageMapper');
			$this->ImageMapper->delete($image_data);
			
			
			$resultback->setCM($resultback::success, '删除构件成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除构件失败');
		}
		
		return $resultback->getCM();
	}
}

?>
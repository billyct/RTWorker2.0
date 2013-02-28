<?php
class OptionMapper extends CI_Model{
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$id = null;
			$this->db->where('name', $data['name']);
			$query = $this->db->get('option');
			if ($query->num_rows() <= 0 ) {
				$this->db->insert('option', $data);
				$id = $this->db->insert_id();
			} else {
				$option = $query->row_array();
				$id = (int)$option['id'];
			}
			$resultback->setCMD($resultback::success, '添加属性成功', array('id' => $id));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加属性失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function get_options($component_id) {
		$this->db->where('component_id', $component_id);
		$query = $this->db->get('view_options');
		return $query->result_array();
	}
	
	public function search($name) {
		$resultback = $this->resultback;
		try {
			$this->db->like('name', $name);
			$option_query = $this->db->get('option');
			$options = $option_query->result_array();
			
			$resultback->setCMD($resultback::success, '查询属性成功', $options);
			
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '查询属性失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function delete($data) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('option', $data);
			$resultback->setCM($resultback::success, '删除属性成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除属性失败');
		}
	
		return $resultback->getCM();
	}
}

?>
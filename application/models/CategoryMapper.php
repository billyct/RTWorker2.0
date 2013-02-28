<?php
class CategoryMapper extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$this->db->insert('category', $data);
			$category_id = $this->db->insert_id();
			$resultback->setCMD($resultback::success, '添加构件类别成功', array('id' => $category_id));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加构件类别失败');
		}
	
		return $resultback->getCMD();
	}
	
	public function get_all_categorys() {
		$this->db->select();
		$category_query = $this->db->get('category');
		$categorys = $category_query->result_array();
		
		return $categorys;
	}
	
	public function delete($data) {
		$resultback = $this->resultback;
		try {
		
			$this->db->delete('category', $data);
			
			$resultback->setCM($resultback::success, '删除构件类别成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除构件类别失败');
		}
		
		return $resultback->getCM();
	}
	
}

?>
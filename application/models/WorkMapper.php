<?php
class WorkMapper extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$this->db->insert_batch('work', $data);
			$resultback->setCM($resultback::success, '添加表格成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加表格失败');
		}
		
		return $resultback->getCM();
	}
	
	public function get_works($id) {
		$this->db->where('component_id', $id);
		$work_query = $this->db->get('work');
		return $work_query->result_array();
	}
}

?>
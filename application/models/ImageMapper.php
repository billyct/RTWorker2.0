<?php
class ImageMapper extends CI_Model{
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$this->db->insert('image', $data);
			$resultback->setCM($resultback::success, '保存图片成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '保存图片失败');
		}
		
		return $resultback->getCM();
	}
	
	public function delete($data) {
		$resultback = $this->resultback;
		try {
			
			$this->db->where($data);
			$image_query = $this->db->get('image');
			
			if ($image_query->num_rows() > 0) {
				$image = $image_query->row_array();
				
				//删除文件
				if (file_exists(PUBLICPATH.$image['path'])) {
					unlink(PUBLICPATH.$image['path']);
				}	
				if (file_exists(PUBLICPATH.$image['path_thumb'])) {
					unlink(PUBLICPATH.$image['path_thumb']);
				}
				$this->db->delete('image', $data);
			}
			
			$resultback->setCM($resultback::success, '删除图片成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除图片失败');
		}
		
		return $resultback->getCM();
	}
}

?>
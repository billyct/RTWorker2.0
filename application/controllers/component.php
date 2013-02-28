<?php
class Component extends CT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('UserMapper');
		$this->load->model('ImageMapper');
		$this->load->model('ComponentMapper');
		
		$this->load->library('ResultBack', 'resultback');

	}
	
	public function add_component() {
		$componentmapper = $this->ComponentMapper;
		$user = $this->getUserdata();
		$component_data = array(
				'name' => $this->input->post('name'),
				'image_id' => $this->input->post('image_id'),
				'formula' => $this->input->post('formula'),
				'user_id' => $user['id'],
				'category_id' => $this->input->post('category_id'),
				'options_id' => $this->input->post('options_id'),
				'works' => $this->input->post('works'),
				);
		
		
 		$resultback = $componentmapper->add($component_data);
		
 		echo json_encode($resultback);
		
	}
	
	
	public function get_component($id) {
		$componentmapper = $this->ComponentMapper;
		//$id = $this->input->get('id');
		
		$resultback = $componentmapper->get_component($id);
		echo json_encode($resultback);
	}
	
	public function delete_component() {
		$componentmapper = $this->ComponentMapper;
		$data = array(
				'id' => $this->input->post('id'),
				);
		$resultback = $componentmapper->delete($data);
		echo json_encode($resultback);
	}
	
	public function upload_image() {
		$this->load->library('FileUploader', 'fileuploader');
		$imagemapper = $this->ImageMapper;
		$uploader = $this->fileuploader;
		
		//将图片上传到目录
		$result = $uploader->upload();
		
		//将图片的记录放到数据库
		if ($result['success']) {
			$data = array(
					'path' => $result['path'],
					'path_thumb' => $result['path_thumb'],
			);
			$resultback = $this->ImageMapper->add($data);
			
			//如果图片放入数据库成功则返回图片id
			if ($resultback['code'] == 1) {
				$result['id'] = $this->db->insert_id();
			}
			
		}
		
		$result = array_merge($result,$resultback);
		// 返回数据
		echo json_encode($result);
	}
}

?>
<?php
class LoftingMapper extends CI_Model{
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$this->lofting_check($data);
			$this->db->insert('lofting', $data);
			$lofting_id = $this->db->insert_id();
			
			$resultback->setCMD($resultback::success, '添加项目成功', array('id' => $lofting_id));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, $e->getMessage());
		}
		
		return $resultback->getCMD();
	}
	
	public function get_lofting($id) {
		$this->db->where('lofting_id', $id);
		$loftings_query = $this->db->get('view_loftings');
		$loftings = $loftings_query->result_array();
		foreach ($loftings as $key => $lofting) {
			$this->db->where('lofting_component_id', $lofting['lofting_component_id']);
			$options_query = $this->db->get('view_lofting_datas');
			$loftings[$key]['options'] = $options_query->result_array();
			
			$this->db->where('lofting_component_id', $lofting['lofting_component_id']);
			$works_query = $this->db->get('view_lofting_typedatas');
			$loftings[$key]['works'] = $works_query->result_array();
		}
		
		return $loftings;
	}
	
	public function insert_data($data){
		$resultback = $this->resultback;
		
		try {
			$data_lofting_data = $data['data_lofting'];
			unset($data['data_lofting']);
			
			$data_lofting_typedata = $data['data_work'];
			unset($data['data_work']);
			
			$this->db->insert('lofting_component', $data);
			$lofting_component_id = $this->db->insert_id();
			
			foreach ($data_lofting_data as $key => $value) {
				$data_lofting_data[$key]['lofting_component_id'] = $lofting_component_id;
			}
			
			foreach ($data_lofting_typedata as $key => $value) {
				$data_lofting_typedata[$key]['lofting_component_id'] = $lofting_component_id;
			}
			
			$lofting_data_options = array();
			foreach ($data_lofting_data as $lofting_data) {
				unset($lofting_data['id']);
				$this->db->insert('lofting_data', $lofting_data);
				$lofting_data_options[] = array(
						'id' => $this->db->insert_id(),
						'option_id' => $lofting_data['option_id'],
						);
			}
			
			$lofting_typedata_options = array();
			foreach ($data_lofting_typedata as $lofting_typedata) {
				unset($lofting_typedata['id']);
				$this->db->insert('lofting_typedata', $lofting_typedata);
				$lofting_typedata_options[] = array(
						'id' => $this->db->insert_id(),
						'work_id' => $lofting_typedata['work_id'],
						);
			}
			
				
			$resultback->setCMD($resultback::success, '项目中添加构件成功', array('id' => $lofting_component_id, 'lofting_data_options' => $lofting_data_options, 'lofting_typedata_options' => $lofting_typedata_options));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '项目中添加构件失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function update_data($data) {
		$resultback = $this->resultback;
		
		try {
			$data_lofting_data = $data['data_lofting'];
			$data_lofting_typedata = $data['data_work'];
			$this->db->update_batch('lofting_data', $data_lofting_data, 'id');
			$this->db->update_batch('lofting_typedata', $data_lofting_typedata, 'id');
			$resultback->setCM($resultback::success, '项目中修改构件成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::success, '项目中修改构件失败');
		}
		return $resultback->getCM();
	}
	
	public function get_all_loftings($data) {
		$this->db->where($data);
		$lofting_query = $this->db->get('lofting');
		return $lofting_query->result_array();
		
	}
	
	private function lofting_check($data) {
		$this->db->where($data);
		$lofting_query = $this->db->get('lofting');
		if ($lofting_query->num_rows() > 0) {
			throw new Exception("添加失败，由于您所添加的项目的项目名已经存在");
		}
	}
	
	public function delete_data($data) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('lofting_component', $data);
				
			$resultback->setCM($resultback::success, '删除项目中的构件成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除项目中的构件失败');
		}
	
		return $resultback->getCM();
	}
	
	public function delete($data) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('lofting', $data);
		
			$resultback->setCM($resultback::success, '删除项目中的构件成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除项目中的构件失败');
		}
		
		return $resultback->getCM();
	}

	public function get_data_total($id) {
		$this->db->where('lofting_id', $id);
		$query = $this->db->get('lofting_component');
		$result_lofting_component = $query->result_array();
		
		$resultback = array();
		
		foreach ($result_lofting_component as $lofting_component) {
			$this->db->select('formula');
			$this->db->where('lofting_component_id', $lofting_component['id']);
			$loftings_query = $this->db->get('view_loftings');
			$lofting = $loftings_query->row_array();
			
			$this->db->select('option_name, value');
			$this->db->where('lofting_component_id', $lofting_component['id']);
			$datas_query = $this->db->get('view_lofting_datas');
			$datas = $datas_query->result_array();
			
			$option_names = array();
			$values = array();
			
			foreach ($datas as $data) {
				$option_names[] = '{'.$data['option_name'].'}';
				$values[] = $data['value'];
			}
			
			$resultback[] = array(
					'formula' => $lofting['formula'],
					'option_names' => $option_names,
					'values' => $values,
					);
		}
		
		return $resultback;
	}
	
	public function get_typedatas($id) {
		$this->db->where('lofting_id', $id);
		$typedatas_query = $this->db->get('view_lofting_typedatas');
		$typedatas = $typedatas_query->result_array();
		return $typedatas;
	}
}

?>
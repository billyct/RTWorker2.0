<?php
class UserMapper extends CI_Model{
	
	//用户类型
	const admin = 1;
	const ordinary = 0;
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function auth($data) {
		$resultback = $this->resultback;
		try {
			$this->db->where('username', $data['account']);
			$this->db->or_where('email', $data['account']);
			$user_query = $this->db->get('user');
			
			if ($user_query->num_rows() <= 0) {
				throw new Exception("用户名不存在");
			}
			
			$user = $user_query->row_array();
			
			$password = $user['password'];
			
			if (crypt($data['password'], $password) != $password){
				throw new Exception("用户名或者密码错误");	
			}
			unset($user['password']);
			$user_session['auth'] = $user;
			$this->session->set_userdata($user_session);
			$resultback->setCM($resultback::success, '登录成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, $e->getMessage());
		}
		return $resultback->getCM();
	}
	
	public function register($data) {
		$resultback = $this->resultback;
		try {

			$this->user_check($data['username'], $data['email']);
			$data['password'] = crypt($data['password']);
			$this->db->insert('user', $data);
			$resultback->setCM($resultback::success, '注册用户成功');
			
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, $e->getMessage());
		}
		
		
		return $resultback->getCM();
	}
	
// 	public function get_all_users() {
// 		$this->db->where('type != ', self::admin);
// 		$this->db->select('user.id, username, real_name, depart_name, flag');
// 		$this->db->from('user');
// 		$this->db->join('depart', 'depart.id=user.depart_id');
// 		$users = $this->db->get();
		
// 		return $users->result_array();
// 	}
	
	
	public function user_check($username, $email=null) {
		
		if ($email == null) {
			$this->db->where('username', $username);
			$this->db->or_where('email', $username);
		} else {
			$this->db->where('username', $username);
			$this->db->or_where('email', $email);
		}
		
		$user_query = $this->db->get('user');
		if ($user_query->num_rows() > 0) {
			throw new Exception("您注册的用户已经存在");
		}		
	}
	
	
	public function delete($id) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('user', array('id' => $id));
			$resultback->setCM($resultback::success, '删除用户成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除用户失败');
		}
		return $resultback->getCM();
	}
}

?>
<?php
class user_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get() {
		$this->db->from('user')->order_by("username", "asc");
		return $this->db->get()->result_array();
	}

	public function get_user($username)
	{
		return array_pop($this->db->get_where('user', array('username' => $username))->result_array());
	}
	
	public function login($data) {
		if ($this->input->post('username'))
		{
			$users = $this->db->get_where('user', array('username' => $data['username'], 'password' => $data['password']))->result_array();

			if (sizeof($users) == 1) {
				$user = array_pop($users);
					
				$this->session->set_userdata('username', $user['username']);
				$this->session->set_userdata('role', $user['role']);
				$this->session->set_userdata('auth', 'yes');
				
				return true;
			}
		}
		
		return false;
	}


	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('auth');

		redirect('/home/index/', 'refresh');
	}
	
	public function change_password($data) {
		$this->db->trans_start();
	
		$user_data = array(
				'password' => $data['password']
		);
	
		$this->db->where('username', $data['username']);
		$this->db->update('user', $user_data);
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
	
	public function add($data) {
		$this->db->trans_start();
	
		$user_data = array(
				'name' => $data['username'],
				'username' => $data['username'],
				'password' => $data['password'],
				'role' => $data['role']
		);
		$this->db->insert('user', $user_data);
		
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
	
	public function delete($id) {
		$this->db->trans_start();
	
		$this->db->where('id', $id);
		$this->db->delete('user');
	
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
}
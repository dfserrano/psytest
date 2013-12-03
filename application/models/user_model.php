<?php
class user_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
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
}
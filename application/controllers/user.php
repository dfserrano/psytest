<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$allowed_roles = array('admin');
		$this->admin_only($allowed_roles);
		
		$data['results'] = $this->user_model->get();
		$data['title'] = $this->lang->line('menu_user');
	
		$this->load->view('templates/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Profile
	 */
	public function profile()
	{
		$username = $this->session->userdata('username');
		
		if (!isset($username)) {
			redirect('/home/index/', 'refresh');
		}
	
		$data['results'] = $this->user_model->get_user($username);
		$data['title'] = $this->lang->line('label_profile');
	
		$this->load->view('templates/header', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Login
	 */
	public function login()
	{
		$username = $this->session->userdata('username');
	
		if ($username) {
			redirect('/home/index/', 'refresh');
		}
		
		$data['title'] = $this->lang->line('label_admin_access');

		if ($this->input->post('username'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('username', $this->lang->line('label_username'), 'required|xss_clean');
			$this->form_validation->set_rules('password', $this->lang->line('label_password'), 'required|xss_clean');
				
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
			
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password'))
				);
					
				if ($this->user_model->login($form_data)) {
					redirect('/home/index/', 'refresh');
				} else {
					$data['error'] = "Error en usuario o contraseña";
				}
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('user/login', $data);
		$this->load->view('templates/footer');
	}


	/**
	 * Logout
	 */
	public function logout()
	{
		$data['title'] = $this->lang->line('label_exit');

		$this->user_model->logout();

	}
	
	
	/**
	 * Change Password
	 */
	public function change_password()
	{
		$username = $this->session->userdata('username');
		
		if (!isset($username)) {
			redirect('/home/index/', 'refresh');
		}
		
		$data['title'] = $this->lang->line('label_change_password');
	
		if ($this->input->post('password'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('password', $this->lang->line('label_password'), 'required|xss_clean|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('label_password_conf'), 'required|xss_clean');
	
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
				
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
					'username' => $username,
					'password' => md5($this->input->post('password'))
				);
					
				if ($this->user_model->change_password($form_data)) {
					redirect('/home/index/', 'refresh');
				} else {
					$data['error'] = "Error";
				}
			}
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('user/change_password', $data);
		$this->load->view('templates/footer');
	}
	
	
	/**
	 * Login
	 */
	public function add()
	{
		$allowed_roles = array('admin');
		$this->admin_only($allowed_roles);
		
		$username = $this->session->userdata('username');
	
		if (!$username) {
			redirect('/home/index/', 'refresh');
		}
	
		$data['title'] = $this->lang->line('label_add_user');
	
		if ($this->input->post('username'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('username', $this->lang->line('label_username'), 'required|xss_clean');
			$this->form_validation->set_rules('password', $this->lang->line('label_password'), 'required|xss_clean');
			$this->form_validation->set_rules('role', $this->lang->line('label_role'), 'required|xss_clean');
	
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
				
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password')),
						'role' => $this->input->post('role')
				);
					
				if ($this->user_model->add($form_data)) {
					redirect('/user/index/', 'refresh');
				} else {
					$data['error'] = "Error en usuario o contraseña";
				}
			}
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('user/add', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Delete 
	 */
	public function delete($id)
	{
		$allowed_roles = array('admin');
		$this->admin_only($allowed_roles);
	
		$this->user_model->delete($id);
	
		redirect('/user/index/', 'refresh');
	}
	
	
	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');
	
		if ($username && in_array($role, $allowed_roles)) {
			return;
		}
	
		redirect('/home/index/', 'refresh');
	}
}
<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
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
}
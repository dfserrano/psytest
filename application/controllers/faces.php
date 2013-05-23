<?php
class Faces extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('faces_model');
		$this->load->database();
		$this->load->helper('url');
	}

	
	public function index()
	{
		$data['title'] = 'Caras';
		$data['pictures'] = $this->faces_model->get();
		
		if ($this->input->post('code')) 
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('code', 'Codigo', 'required|xss_clean');
			$this->form_validation->set_rules('emotion', 'Emocion', 'required|xss_clean');
			$this->form_validation->set_rules('userfile', 'Archivo de imagen', 'file_required');
			$this->form_validation->set_message('required', 'El  %s es requerido');
			$this->form_validation->set_message('file_required', 'El  %s es requerido');
			
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'code' => $this->input->post('code'),
						'emotion' => $this->input->post('emotion'),
				);
					
				$this->faces_model->add_face($form_data);
				
				redirect('/faces/index/', 'refresh');
			}
			
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('faces/index', $data);
		$this->load->view('templates/footer');
	}
}
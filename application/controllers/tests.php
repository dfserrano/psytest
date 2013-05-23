<?php
class Tests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tests_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->tests_model->get();
		$data['title'] = 'Pruebas';
		
		$this->load->view('templates/header', $data);
		$this->load->view('tests/index', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Adds a new test
	 */
	public function add()
	{
		$this->load->model('faces_model');
		
		$data['title'] = 'Nueva Prueba';
		
		if ($this->input->post('name')) 
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', 'Perturbador', 'required|xss_clean');
			$this->form_validation->set_rules('exposure', 'Exposicion', 'required|xss_clean');
			
			$this->form_validation->set_message('required', 'El  %s es requerido');
				
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'name' => $this->input->post('name'),
						'disturbance' => $this->input->post('disturbance'),
						'exposure' => $this->input->post('exposure'),
						'pic' => $this->input->post('pic'),
						'posx' => $this->input->post('posx'),
						'posy' => $this->input->post('posy'),
						'rotation' => $this->input->post('rotation'),
						'flip' => $this->input->post('flip'),
				);
					
				$this->tests_model->add_test($form_data);
			
				redirect('/tests/index/', 'refresh');
			}
		}
		
		$data['pictures'] = $this->faces_model->get();
		
		$this->load->view('templates/header', $data);
		$this->load->view('tests/add', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->tests_model->get_test($id);
		$data['slides'] = $this->tests_model->get_test_slides($id);
	
		if (empty($data['test']) || empty($data['slides']))
		{
			show_404();
		}
	
		$data['title'] = $data['test']['name'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('tests/view', $data);
		$this->load->view('templates/footer');
	}
	
	public function save()
	{
		echo "success";
	}
}
<?php
class TimedCrefTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('timedcreftest_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->timedcreftest_model->get();
		$data['title'] = 'Pruebas de CREF con tiempo';
		
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/index', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function results($id)
	{
		$data['title'] = 'Resultados';
		
		$results = $this->timedcreftest_model->get_test_results($id);
		$summary = array();
		
		foreach ($results as $result) {
			if (!isset($summary[$result['pic_code']])) {
				$summary[$result['pic_code']] = array();
				$summary[$result['pic_code']]['num_over'] = 0;
				$summary[$result['pic_code']]['num_under'] = 0;
				$summary[$result['pic_code']]['time_over'] = 0;
				$summary[$result['pic_code']]['time_under'] = 0;
			}
			
			if ($result['target_time'] < $result['actual_time']) {
				$summary[$result['pic_code']]['num_over']++;
				$summary[$result['pic_code']]['time_over'] = $result['actual_time'] - $result['target_time'];
			} else {
				$summary[$result['pic_code']]['num_under']++;
				$summary[$result['pic_code']]['time_under'] = $result['target_time'] - $result['actual_time'];
			}
		}
		
		$data['results'] = $summary;
	
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/results', $data);
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
					
				$this->timedcreftest_model->add_test($form_data);
			
				redirect('/timedcreftest/index/', 'refresh');
			}
		}
		
		$data['pictures'] = $this->faces_model->get();
		
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/add', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->timedcreftest_model->get_test($id);
		$data['slides'] = $this->timedcreftest_model->get_test_slides($id);
	
		if (empty($data['test']) || empty($data['slides']))
		{
			show_404();
		}
	
		$data['title'] = $data['test']['name'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/view', $data);
		$this->load->view('templates/footer');
	}
	
	public function save()
	{
		
		$results = json_decode($this->input->post('results'));
		
		if (sizeof($results) > 0) {
			$result_data = array(
					'test_fk' => $this->input->post('testid'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'age' => $this->input->post('age'),
					'docid' => $this->input->post('docid'),
					'results' => $results);
			
			echo (($this->timedcreftest_model->add_result($result_data))? 'success' : 'error');
				
		} else {
			echo 'error';
		}
	}
}
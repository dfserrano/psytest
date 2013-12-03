<?php
class CrefTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('creftest_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->creftest_model->get();
		$data['title'] = $this->lang->line('menu_cref');
		
		$this->load->view('templates/header', $data);
		$this->load->view('creftest/index', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function results($id)
	{
		$data['title'] = $this->lang->line('results');
		
		$results = $this->creftest_model->get_test_results($id);
		$summary = array();
		
		foreach ($results as $result) {
			if (!isset($summary[$result['pic_code']])) {
				$summary[$result['pic_code']] = array();
				$summary[$result['pic_code']]['num_right'] = 0;
				$summary[$result['pic_code']]['num_wrong'] = 0;
				$summary[$result['pic_code']]['time_right'] = 0;
				$summary[$result['pic_code']]['time_wrong'] = 0;
			}
			
			if ($result['target'] == $result['actual']) {
				$summary[$result['pic_code']]['num_right']++;
				$summary[$result['pic_code']]['time_right'] = $result['time'];
			} else {
				$summary[$result['pic_code']]['num_wrong']++;
				$summary[$result['pic_code']]['time_wrong'] = $result['time'];
			}
		}
		
		$data['results'] = $summary;
	
		$this->load->view('templates/header', $data);
		$this->load->view('creftest/results', $data);
		$this->load->view('templates/footer');
	}
	
	
	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');
		
		if ($username && in_array($role, $allowed_roles)) {
			return;
		}
		
		redirect('/creftest/index/', 'refresh');
	}
	
	public function report($id)
	{
		$allowed_roles = array('admin', 'cref_admin', 'cref_viewer');
		$this->admin_only($allowed_roles);
		
		$data['title'] = $this->lang->line('report');
	
		$results = $this->creftest_model->get_test_results($id);
		
		$data['results'] = $results;
	
		$this->load->view('templates/header', $data);
		$this->load->view('creftest/report', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Adds a new test
	 */
	public function add()
	{
		$allowed_roles = array('admin', 'cref_admin');
		$this->admin_only($allowed_roles);
		
		$this->load->model('faces_model');
		
		$data['title'] = $this->lang->line('new_test');
		
		if ($this->input->post('name')) 
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de c�digo
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', $this->lang->line('label_disturber'), 'required|xss_clean');
			$this->form_validation->set_rules('exposure', $this->lang->line('label_exposition'), 'required|xss_clean');
			
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
				
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
					
				$this->creftest_model->add_test($form_data);
			
				redirect('/creftest/index/', 'refresh');
			}
		}
		
		$data['pictures'] = $this->faces_model->get();
		
		$this->load->view('templates/header', $data);
		$this->load->view('creftest/add', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->creftest_model->get_test($id);
		$data['slides'] = $this->creftest_model->get_test_slides($id);
	
		if (empty($data['test']) || empty($data['slides']))
		{
			show_404();
		}
	
		$data['title'] = $data['test']['name'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('creftest/view', $data);
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
			
			echo (($this->creftest_model->add_result($result_data))? 'success' : 'error');
				
		} else {
			echo 'error';
		}
	}
}
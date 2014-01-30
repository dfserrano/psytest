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
		$data['title'] = $this->lang->line('menu_cref_timed');

		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/index', $data);
		$this->load->view('templates/footer');
	}


	public function results($id)
	{
		$data['title'] = $this->lang->line('results');

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


	public function report($id)
	{
		$allowed_roles = array('admin', 'timedcref_admin', 'timedcref_viewer');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('report');

		$results = $this->timedcreftest_model->get_test_results($id);

		$data['results'] = $results;
		
		// counts number of tests
		$count = 0;
		$last_id = -1;
		foreach ($results as $code=>$result) {
			if ($last_id != $result["id"]) {
				$count++;
				$last_id = $result["id"];
			}
		}
		
		$data['num_results'] = $count;

		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/report', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function report_single($id)
	{
		$allowed_roles = array('admin', 'timedcref_admin', 'timedcref_viewer');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('report');
	
		$results = $this->timedcreftest_model->get_single_test_results($id);
	
		$data['results'] = $results;
	
		$this->load->view('timedcreftest/report_single', $data);
	}
	

	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');

		if ($username && in_array($role, $allowed_roles)) {
			return;
		}

		redirect('/timedcreftest/index/', 'refresh');
	}

	/**
	 * Adds a new test
	 */
	public function add()
	{
		$allowed_roles = array('admin', 'timedcref_admin');
		$this->admin_only($allowed_roles);

		$this->load->model('faces_model');

		$data['title'] = $this->lang->line('new_test');

		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', $this->lang->line('label_disturber'), 'required|xss_clean');
				
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
	 * Shows actions to edit/remove/report test takers individually
	 */
	public function edit($id)
	{
		$allowed_roles = array('admin', 'timedcref_admin');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('edit_test');
		$data['results'] = $this->timedcreftest_model->get_test_takers($id);
	
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/edit', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Delete information of a test taker
	 */
	public function delete($id)
	{
		$allowed_roles = array('admin', 'timedcref_admin');
		$this->admin_only($allowed_roles);
	
		$result = $this->timedcreftest_model->get_test_taker($id);
		$test_fk = 0;
		if (sizeof($result) > 0) {
			$test_fk = $result[0]["test_fk"];
		}
	
		$this->timedcreftest_model->delete_taker($id);
	
		redirect('/timedcreftest/edit/' . $test_fk, 'refresh');
	}
	
	/**
	 * Edits test taker
	 */
	public function edit_taker($id)
	{
		$allowed_roles = array('admin', 'timedcref_admin');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('edit_test');
	
		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('lastname', $this->lang->line('label_lastname'), 'required|xss_clean');
			$this->form_validation->set_rules('age', $this->lang->line('label_age'), 'required|xss_clean|numeric');
			$this->form_validation->set_rules('name', $this->lang->line('label_id_doc'), 'required|xss_clean');
	
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
	
			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'id' => $this->input->post('id'),
						'firstname' => $this->input->post('name'),
						'lastname' => $this->input->post('lastname'),
						'age' => $this->input->post('age'),
						'docid' => $this->input->post('docid')
				);
	
				$this->timedcreftest_model->edit_taker($form_data);
					
				redirect('/timedcreftest/edit/' . $this->input->post('test_fk'), 'refresh');
			}
		}
	
		$result = $this->timedcreftest_model->get_test_taker($id);
	
		if (sizeof($result) > 0) {
			$data['taker'] = $result[0];
		} else {
			$data['taker'] = null;
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('timedcreftest/edit_taker', $data);
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
<?php
class StroopTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('strooptest_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->strooptest_model->get();
		$data['title'] = $this->lang->line('menu_stroop');

		$this->load->view('templates/header', $data);
		$this->load->view('strooptest/index', $data);
		$this->load->view('templates/footer');
	}


	public function results($id)
	{
		$data['title'] = $this->lang->line('results');

		$results = $this->strooptest_model->get_test_results($id);
		$summary = array();

		foreach ($results as $result) {
			if (!isset($summary[$result['num']])) {
				$summary[$result['num']] = array();
				$summary[$result['num']]['num_right'] = 0;
				$summary[$result['num']]['num_wrong'] = 0;
				$summary[$result['num']]['time_right'] = 0;
				$summary[$result['num']]['time_wrong'] = 0;
			}
				
			if ($result['target'] == $result['actual']) {
				$summary[$result['num']]['num_right']++;
				$summary[$result['num']]['time_right'] = $result['time'];
			} else {
				$summary[$result['num']]['num_wrong']++;
				$summary[$result['num']]['time_wrong'] = $result['time'];
			}
		}

		$data['results'] = $summary;

		$this->load->view('templates/header', $data);
		$this->load->view('strooptest/results', $data);
		$this->load->view('templates/footer');
	}

	public function report($id)
	{
		$allowed_roles = array('admin', 'stroop_admin', 'stroop_viewer');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('report');

		$results = $this->strooptest_model->get_test_results($id);

		$data['results'] = $results;

		$this->load->view('templates/header', $data);
		$this->load->view('strooptest/report', $data);
		$this->load->view('templates/footer');
	}

	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');

		if ($username && in_array($role, $allowed_roles)) {
			return;
		}

		redirect('/strooptest/index/', 'refresh');
	}

	/**
	 * Adds a new test
	 */
	public function add()
	{
		$allowed_roles = array('admin', 'stroop_admin');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('new_test');

		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', $this->lang->line('label_disturber'), 'required|xss_clean');
			$this->form_validation->set_rules('type', $this->lang->line('label_type'), 'required|xss_clean');
			$this->form_validation->set_rules('num_questions', $this->lang->line('label_num_questions'), 'required|xss_clean');
			$this->form_validation->set_rules('exposure', $this->lang->line('label_exposition'), 'required|xss_clean');
				
			$this->form_validation->set_message('required', $this->lang->line('error_required'));

			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'name' => $this->input->post('name'),
						'disturbance' => $this->input->post('disturbance'),
						'type' => $this->input->post('type'),
						'num_questions' => $this->input->post('num_questions'),
						'exposure' => $this->input->post('exposure'),
						'word' => $this->input->post('word'),
						'color' => $this->input->post('color'),
				);
					
				$this->strooptest_model->add_test($form_data);
					
				redirect('/strooptest/index/', 'refresh');
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('strooptest/add', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->strooptest_model->get_test($id);
		$data['slides'] = $this->strooptest_model->get_test_slides($id);

		if (empty($data['test']) || empty($data['slides']))
		{
			show_404();
		}

		$data['title'] = $data['test']['name'];

		$this->load->view('templates/header', $data);
		$this->load->view('strooptest/view', $data);
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
				
			echo (($this->strooptest_model->add_result($result_data))? 'success' : 'error');

		} else {
			echo 'error';
		}
	}
}
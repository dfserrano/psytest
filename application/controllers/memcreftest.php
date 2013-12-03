<?php
class MemCrefTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('memcreftest_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->memcreftest_model->get();
		$data['title'] = $this->lang->line('menu_cref_timed');

		$this->load->view('templates/header', $data);
		$this->load->view('memcreftest/index', $data);
		$this->load->view('templates/footer');
	}


	public function results($id)
	{
		$data['title'] = $this->lang->line('results');

		$results = $this->memcreftest_model->get_test_results($id);
		$summary = array();

		foreach ($results as $result) {
			if (!isset($summary[$result['num']])) {
				$summary[$result['num']] = array();
				$summary[$result['num']]['num_right'] = 0;
				$summary[$result['num']]['num_wrong'] = 0;
				$summary[$result['num']]['time_right'] = 0;
				$summary[$result['num']]['time_wrong'] = 0;
			}
				
			if ($result['success'] == 1) {
				$summary[$result['num']]['num_right']++;
				$summary[$result['num']]['time_right'] += $result['actual_time'];
			} else {
				$summary[$result['num']]['num_wrong']++;
				$summary[$result['num']]['time_wrong'] += $result['actual_time'];
			}
		}

		$data['results'] = $summary;

		$this->load->view('templates/header', $data);
		$this->load->view('memcreftest/results', $data);
		$this->load->view('templates/footer');
	}

	public function report($id)
	{
		$allowed_roles = array('admin', 'memcref_admin', 'memcref_viewer');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('report');

		$results = $this->memcreftest_model->get_test_results($id);

		$data['results'] = $results;

		$this->load->view('templates/header', $data);
		$this->load->view('memcreftest/report', $data);
		$this->load->view('templates/footer');
	}


	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');

		if ($username && in_array($role, $allowed_roles)) {
			return;
		}

		redirect('/memcreftest/index/', 'refresh');
	}

	/**
	 * Adds a new test
	 */
	public function add()
	{
		$allowed_roles = array('admin', 'memcref_admin');
		$this->admin_only($allowed_roles);

		$this->load->model('faces_model');

		$data['title'] = $this->lang->line('new_test');

		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', $this->lang->line('label_disturber'), 'required|xss_clean');
			$this->form_validation->set_rules('exposure', $this->lang->line('label_exposition'), 'required|xss_clean');
				
			$this->form_validation->set_message('required', $this->lang->line('error_required'));
				
			$types = $this->input->post('type');
			$pics = $this->input->post('pic');
				
			if (sizeof($types) > 0) {
				$start = 0;
				for ($start=0; $start<sizeof($types); $start++) {
					if (!empty($pics[$start])) {
						break;
					}
				}

				$end = 0;
				for ($end=sizeof($types)-1; $end>0; $end--) {
					if (!empty($pics[$end]))
						break;
				}

				if ($types[$start] != 1 || $types[$end] != 2) {
					$this->form_validation->_error_array['custom_error'] = $this->lang->line('error_order_type');
				}
			} else {
				$this->form_validation->_error_array['custom_error'] = $this->lang->line('error_missing_elements');
			}

			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'name' => $this->input->post('name'),
						'disturbance' => $this->input->post('disturbance'),
						'exposure' => $this->input->post('exposure'),
						'pic' => $this->input->post('pic'),
						'type' => $this->input->post('type'),
						'rotation' => $this->input->post('rotation'),
						'flip' => $this->input->post('flip'),
				);
					
				$this->memcreftest_model->add_test($form_data);
					
				redirect('/memcreftest/index/', 'refresh');
			}
		}

		$data['pictures'] = $this->faces_model->get();

		$this->load->view('templates/header', $data);
		$this->load->view('memcreftest/add', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->memcreftest_model->get_test($id);
		$data['slides'] = $this->memcreftest_model->get_test_slides($id);

		if (empty($data['test']) || empty($data['slides']))
		{
			show_404();
		}

		$data['title'] = $data['test']['name'];

		$this->load->view('templates/header', $data);
		$this->load->view('memcreftest/view', $data);
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
				
			echo (($this->memcreftest_model->add_result($result_data))? 'success' : 'error');

		} else {
			echo 'error';
		}
	}
}
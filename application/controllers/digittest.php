<?php
class DigitTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('digittest_model');
	}

	/**
	 * Lists the tests.  Default page for tests
	 */
	public function index()
	{
		$data['tests'] = $this->digittest_model->get();
		$data['title'] = $this->lang->line('menu_digits');

		$this->load->view('templates/header', $data);
		$this->load->view('digittest/index', $data);
		$this->load->view('templates/footer');
	}


	public function report($id)
	{
		$allowed_roles = array('admin', 'digit_admin', 'digit_viewer');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('report');

		$results = $this->digittest_model->get_test_results($id);

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
		$this->load->view('digittest/report', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function report_single($id)
	{
		$allowed_roles = array('admin', 'digit_admin', 'digit_viewer');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('report');
	
		$results = $this->digittest_model->get_single_test_results($id);
	
		$data['results'] = $results;
	
		$this->load->view('digittest/report_single', $data);
	}


	public function results($id)
	{
		$data['title'] = $this->lang->line('results');

		$results = $this->digittest_model->get_test_results($id);
		$summary = array();

		foreach ($results as $result) {
				
			$strLength = (string) strlen($result['target']);
				
			if (!isset($summary[$strLength])) {
				$summary[$strLength] = array();
				$summary[$strLength]['num_right'] = 0;
				$summary[$strLength]['num_wrong'] = 0;
				$summary[$strLength]['time_right'] = 0;
				$summary[$strLength]['time_wrong'] = 0;
			}
				
			if ($result['target'] == $result['actual']) {
				$summary[$strLength]['num_right']++;
				$summary[$strLength]['time_right'] = $result['time'];
			} else {
				$summary[$strLength]['num_wrong']++;
				$summary[$strLength]['time_wrong'] = $result['time'];
			}
		}
		
		$data['results'] = $results;

		$this->load->view('templates/header', $data);
		$this->load->view('digittest/results', $data);
		$this->load->view('templates/footer');
	}

	private function admin_only($allowed_roles = array('admin')) {
		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');

		if ($username && in_array($role, $allowed_roles)) {
			return;
		}

		redirect('/digittest/index/', 'refresh');
	}

	/**
	 * Adds a new test
	 */
	public function add()
	{
		$allowed_roles = array('admin', 'digit_admin');
		$this->admin_only($allowed_roles);

		$data['title'] = $this->lang->line('new_test');

		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de c�digo
			$this->form_validation->set_rules('name', $this->lang->line('label_name'), 'required|xss_clean');
			$this->form_validation->set_rules('disturbance', $this->lang->line('label_disturber'), 'required|xss_clean');
			$this->form_validation->set_rules('exposure', $this->lang->line('label_exposition'), 'required|xss_clean');
			$this->form_validation->set_rules('type', $this->lang->line('label_type'), 'required|xss_clean');
				
			$this->form_validation->set_message('required', $this->lang->line('error_required'));

			// if it's not valid, go back to the page showing errors
			if($this->form_validation->run() == TRUE)
			{
				$form_data = array(
						'name' => $this->input->post('name'),
						'disturbance' => $this->input->post('disturbance'),
						'exposure' => $this->input->post('exposure'),
						'type' => $this->input->post('type')
				);
					
				$this->digittest_model->add_test($form_data);
					
				redirect('/digittest/index/', 'refresh');
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('digittest/add', $data);
		$this->load->view('templates/footer');
	}
	
	
	/**
	 * Shows actions to edit/remove/report test takers individually
	 */
	public function edit($id)
	{
		$allowed_roles = array('admin', 'digit_admin');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('edit_test');
		$data['results'] = $this->digittest_model->get_test_takers($id);
	
		$this->load->view('templates/header', $data);
		$this->load->view('digittest/edit', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Delete information of a test taker
	 */
	public function delete($id)
	{
		$allowed_roles = array('admin', 'digit_admin');
		$this->admin_only($allowed_roles);
	
		$result = $this->digittest_model->get_test_taker($id);
		$test_fk = 0;
		if (sizeof($result) > 0) {
			$test_fk = $result[0]["test_fk"];
		}
	
		$this->digittest_model->delete_taker($id);
	
		redirect('/digittest/edit/' . $test_fk, 'refresh');
	}
	
	/**
	 * Edits test taker
	 */
	public function edit_taker($id)
	{
		$allowed_roles = array('admin', 'digit_admin');
		$this->admin_only($allowed_roles);
	
		$data['title'] = $this->lang->line('edit_test');
	
		if ($this->input->post('name'))
		{
			//required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de c�digo
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
	
				$this->digittest_model->edit_taker($form_data);
					
				redirect('/digittest/edit/' . $this->input->post('test_fk'), 'refresh');
			}
		}
	
		$result = $this->digittest_model->get_test_taker($id);
	
		if (sizeof($result) > 0) {
			$data['taker'] = $result[0];
		} else {
			$data['taker'] = null;
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('digittest/edit_taker', $data);
		$this->load->view('templates/footer');
	}
	

	/**
	 * Shows the specified test
	 * @param int $id test's id
	 */
	public function view($id)
	{
		$data['test'] = $this->digittest_model->get_test($id);

		if (empty($data['test']))
		{
			show_404();
		}

		$data['title'] = $data['test']['name'];

		$this->load->view('templates/header', $data);
		$this->load->view('digittest/view', $data);
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
				
			echo (($this->digittest_model->add_result($result_data))? 'success' : 'error');

		} else {
			echo 'error';
		}
	}
}
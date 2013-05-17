<?php
class Tests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tests_model');
	}

	public function index()
	{
		/*$data['tests'] = $this->tests_model->get_faces();
		$data['title'] = 'Lista de Pruebas';
		
		$this->load->view('templates/header', $data);
		$this->load->view('tests/index', $data);
		$this->load->view('templates/footer');*/
	}
	
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
		//$this->load->view('templates/footer');
	}
	
	public function save()
	{
		echo "success";
	}
}
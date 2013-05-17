<?php
class Faces extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('faces_model');
	}

	public function index()
	{
		$data['faces'] = $this->faces_model->get_faces();
		$data['title'] = 'News archive';
		
		$this->load->view('templates/header', $data);
		$this->load->view('faces/index', $data);
		$this->load->view('templates/footer');
	}
}
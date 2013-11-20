<?php

class Home extends CI_Controller {

	
	public function view($page = 'home')
	{
		if ( ! file_exists('application/views/home/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = $this->lang->line('header_menu');

		$this->load->view('templates/header', $data);
		$this->load->view('home/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	function switchLanguage($language = "") {
		$language = ($language != "") ? $language : "spanish";
		$this->session->set_userdata('site_lang', $language);
		redirect(base_url());
	}
}
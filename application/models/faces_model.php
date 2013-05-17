<?php
class Faces_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_faces($num = 5)
	{
		$this->db->from('picture')->order_by("RAND()", "asc")->limit($num);
		return $this->db->get()->result_array();
	}
}
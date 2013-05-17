<?php
class Tests_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_test($id)
	{
		if (is_numeric($id)) {
			return array_pop($this->db->get_where('test', array('id' => $id))->result_array());
		}
		
		return null;
	}
	
	public function get_test_slides($id)
	{
		if (is_numeric($id)) {
			$this->db->select('test_fk, slide.id, posx, posy, color, rotation, flip, path, code, emotion');
			$this->db->from('slide');
			$this->db->where('test_fk', $id);
			$this->db->join('picture', 'picture.id = slide.picture_fk');
			$this->db->order_by("order", "asc");
			
			return $this->db->get()->result_array();
		}
	
		return null;
	}
}
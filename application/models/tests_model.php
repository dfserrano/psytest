<?php
class Tests_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get() {
		$this->db->from('test')->order_by("date", "desc");
		return $this->db->get()->result_array();
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
			$this->db->select('test_fk, slide.id, posx, posy, color, rotation, flip, path, code, emotion, width, height');
			$this->db->from('slide');
			$this->db->where('test_fk', $id);
			$this->db->join('picture', 'picture.id = slide.picture_fk');
			$this->db->order_by("order", "asc");
			
			return $this->db->get()->result_array();
		}
	
		return null;
	}
	
	public function add_test($data) {
		$this->db->trans_start();
		
		$test_data = array(
				'name' => $data['name'],
				'disturbance' => $data['disturbance'],
				'exposure' => $data['exposure'],
				'date' => date('Y-m-d H:i:s')
				);
		$this->db->insert('test', $test_data);
		$last_insert_id = $this->db->insert_id();
		
		for ($i=0; $i<sizeof($data['pic']); $i++) {
			if (!empty($data['pic'][$i])) {
				$slide_data = array();
				$slide_data['test_fk'] = $last_insert_id;
				$slide_data['picture_fk'] = $data['pic'][$i];
				$slide_data['order'] = $i;
				$slide_data['posx'] = ((empty($data['posx'][$i]))? null : $data['posx'][$i]);
				$slide_data['posy'] = ((empty($data['posy'][$i]))? null : $data['posy'][$i]);
				$slide_data['rotation'] = ((empty($data['rotation'][$i]))? 0 : $data['rotation'][$i]);
				$slide_data['flip'] = $data['flip'][$i];
				
				$this->db->insert('slide', $slide_data);
			}
		}
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
}
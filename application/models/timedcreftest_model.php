<?php
class timedcreftest_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get() {
		$this->db->from('test_timedcref')->order_by("date", "desc");
		return $this->db->get()->result_array();
	}

	public function get_test($id)
	{
		if (is_numeric($id)) {
			return array_pop($this->db->get_where('test_timedcref', array('id' => $id))->result_array());
		}

		return null;
	}

	public function get_test_slides($id)
	{
		if (is_numeric($id)) {
			$this->db->select('test_fk, slide_timedcref.id, exposure, posx, posy, color, rotation, flip, path, code, emotion, width, height');
			$this->db->from('slide_timedcref');
			$this->db->where('test_fk', $id);
			$this->db->join('picture', 'picture.id = slide_timedcref.picture_fk');
			$this->db->order_by("order", "asc");
				
			return $this->db->get()->result_array();
		}

		return null;
	}
	
	public function get_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_timedcref.id, firstname, lastname, age, date, pic_code, target_time, actual_time');
			$this->db->from('test_result_timedcref');
			$this->db->where('test_fk', $id);
			$this->db->join('test_result_item_timedcref', 'test_result_timedcref.id = test_result_item_timedcref.test_result_fk');
		
			return $this->db->get()->result_array();
		}
		
		return null;
	}
	
	
	public function get_single_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_timedcref.id, firstname, lastname, age, docid, date, pic_code, target_time, actual_time');
			$this->db->from('test_result_timedcref');
			$this->db->where('test_result_timedcref.id', $id);
			$this->db->join('test_result_item_timedcref', 'test_result_timedcref.id = test_result_item_timedcref.test_result_fk');
			$results = $this->db->get()->result_array();
			
			return $results;
		}
	
		return null;
	}
	
	public function get_test_takers($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_timedcref.id, firstname, lastname, age, docid, date');
			$this->db->from('test_result_timedcref');
			$this->db->where('test_fk', $id);
	
			$results = $this->db->get()->result_array();
				
			return $results;
		}
	
		return null;
	}
	
	public function get_test_taker($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_timedcref.id, firstname, lastname, age, docid, test_fk');
			$this->db->from('test_result_timedcref');
			$this->db->where('id', $id);
	
			$results = $this->db->get()->result_array();
	
			return $results;
		}
	
		return null;
	}
	
	public function edit_taker($data) {
		$this->db->trans_start();
	
		$test_data = array(
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'age' => $data['age'],
				'docid' => $data['docid']
		);
	
		$this->db->where('id', $data["id"]);
		$this->db->update('test_result_timedcref', $test_data);
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
	
	public function delete_taker($id) {
		$this->db->trans_start();
	
		$this->db->where('test_result_fk', $id);
		$this->db->delete('test_result_item_timedcref');
	
		$this->db->where('id', $id);
		$this->db->delete('test_result_timedcref');
	
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}

	public function add_test($data) {
		$this->db->trans_start();

		$test_data = array(
				'name' => $data['name'],
				'disturbance' => $data['disturbance'],
				'date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('test_timedcref', $test_data);
		$last_insert_id = $this->db->insert_id();

		for ($i=0; $i<sizeof($data['pic']); $i++) {
			if (!empty($data['pic'][$i])) {
				$slide_data = array();
				$slide_data['test_fk'] = $last_insert_id;
				$slide_data['picture_fk'] = $data['pic'][$i];
				$slide_data['exposure'] = $data['exposure'][$i];
				$slide_data['order'] = $i;
				$slide_data['posx'] = ((empty($data['posx'][$i]))? null : $data['posx'][$i]);
				$slide_data['posy'] = ((empty($data['posy'][$i]))? null : $data['posy'][$i]);
				$slide_data['rotation'] = ((empty($data['rotation'][$i]))? 0 : $data['rotation'][$i]);
				$slide_data['flip'] = $data['flip'][$i];

				$this->db->insert('slide_timedcref', $slide_data);
			}
		}
		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	public function add_result($data) {
		$this->db->trans_start();

		$result_data = array(
				'test_fk' => $data['test_fk'],
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'age' => $data['age'],
				'date' => date('Y-m-d H:i:s'),
				'docid' => $data['docid']
		);
		$this->db->insert('test_result_timedcref', $result_data);
		$last_insert_id = $this->db->insert_id();
		
		for ($i=0; $i<sizeof($data['results']); $i++) {
			if (!empty($data['results'][$i]->code)) {
				$result_item_data = array(
						'test_result_fk' => $last_insert_id,
						'pic_code' => $data['results'][$i]->code,
						'actual_time' => $data['results'][$i]->actual,
						'target_time' => $data['results'][$i]->target
						);
				
				$this->db->insert('test_result_item_timedcref', $result_item_data);
			}
		}
		
		$this->db->trans_complete();

		return !($this->db->trans_status() === FALSE);
	}
}
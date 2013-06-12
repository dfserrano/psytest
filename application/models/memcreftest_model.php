<?php
class memcreftest_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get() {
		$this->db->from('test_memcref')->order_by("date", "desc");
		return $this->db->get()->result_array();
	}

	public function get_test($id)
	{
		if (is_numeric($id)) {
			return array_pop($this->db->get_where('test_memcref', array('id' => $id))->result_array());
		}

		return null;
	}

	public function get_test_slides($id)
	{
		if (is_numeric($id)) {
			$this->db->select('test_fk, slide_memcref.id, picture_fk,  type, rotation, flip, path, code, emotion, width, height');
			$this->db->from('slide_memcref');
			$this->db->where('test_fk', $id);
			$this->db->join('picture', 'picture.id = slide_memcref.picture_fk');
			$this->db->order_by("order", "asc");
			$this->db->order_by("type", "asc");
			$this->db->order_by("suborder", "asc");
				
			return $this->db->get()->result_array();
		}

		return null;
	}
	
	public function get_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('num, pic_id, actual_time, success');
			$this->db->from('test_result_memcref');
			$this->db->where('test_fk', $id);
			$this->db->join('test_result_item_memcref', 'test_result_memcref.id = test_result_item_memcref.test_result_fk');
		
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
		$this->db->insert('test_memcref', $test_data);
		$last_insert_id = $this->db->insert_id();

		$setChange = false;
		$setCount = 0;
		
		for ($i=0; $i<sizeof($data['pic']); $i++) {
			if (!empty($data['pic'][$i])) {
				
				if ($data['type'][$i] == 1 && $setChange) {
					$setCount++;
					$setChange = false;
				}
				if ($data['type'][$i] == 2) {
					$setChange = true;
				}
				
				$slide_data = array();
				$slide_data['test_fk'] = $last_insert_id;
				$slide_data['picture_fk'] = $data['pic'][$i];
				$slide_data['type'] = $data['type'][$i];
				$slide_data['order'] = $setCount;
				$slide_data['suborder'] = $i;
				$slide_data['rotation'] = ((empty($data['rotation'][$i]))? 0 : $data['rotation'][$i]);
				$slide_data['flip'] = $data['flip'][$i];

				$this->db->insert('slide_memcref', $slide_data);
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
		$this->db->insert('test_result_memcref', $result_data);
		$last_insert_id = $this->db->insert_id();
		
		for ($i=0; $i<sizeof($data['results']); $i++) {
			if (!empty($data['results'][$i]->code)) {
				$result_item_data = array(
						'test_result_fk' => $last_insert_id,
						'num' => $i+1,
						'pic_id' => $data['results'][$i]->pic_id,
						'actual_time' => $data['results'][$i]->time,
						'success' => (($data['results'][$i]->success)? 1:0)
						);
				
				$this->db->insert('test_result_item_memcref', $result_item_data);
			}
		}
		
		$this->db->trans_complete();

		return !($this->db->trans_status() === FALSE);
	}
}
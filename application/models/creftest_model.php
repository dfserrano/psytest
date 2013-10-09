<?php
class creftest_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get() {
		$this->db->from('test_cref')->order_by("date", "desc");
		return $this->db->get()->result_array();
	}

	public function get_test($id)
	{
		if (is_numeric($id)) {
			return array_pop($this->db->get_where('test_cref', array('id' => $id))->result_array());
		}

		return null;
	}

	public function get_test_slides($id)
	{
		if (is_numeric($id)) {
			$this->db->select('test_fk, slide_cref.id, posx, posy, color, rotation, flip, path, code, emotion, width, height');
			$this->db->from('slide_cref');
			$this->db->where('test_fk', $id);
			$this->db->join('picture', 'picture.id = slide_cref.picture_fk');
			$this->db->order_by("order", "asc");
				
			return $this->db->get()->result_array();
		}

		return null;
	}
	
	public function get_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('firstname, lastname, age, date, pic_code, target, actual, time');
			$this->db->from('test_result_cref');
			$this->db->where('test_fk', $id);
			$this->db->join('test_result_item_cref', 'test_result_cref.id = test_result_item_cref.test_result_fk');
		
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
		$this->db->insert('test_cref', $test_data);
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

				$this->db->insert('slide_cref', $slide_data);
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
		$this->db->insert('test_result_cref', $result_data);
		$last_insert_id = $this->db->insert_id();
		
		for ($i=0; $i<sizeof($data['results']); $i++) {
			if (!empty($data['results'][$i]->code)) {
				$result_item_data = array(
						'test_result_fk' => $last_insert_id,
						'pic_code' => $data['results'][$i]->code,
						'actual' => $data['results'][$i]->actual,
						'target' => $data['results'][$i]->target,
						'time' => $data['results'][$i]->time,
						);
				
				$this->db->insert('test_result_item_cref', $result_item_data);
			}
		}
		
		$this->db->trans_complete();

		return !($this->db->trans_status() === FALSE);
	}
}
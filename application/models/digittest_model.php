<?php
class digittest_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get() {
		$this->db->from('test_digit')->order_by("date", "desc");
		return $this->db->get()->result_array();
	}

	public function get_test($id)
	{
		if (is_numeric($id)) {
			return array_pop($this->db->get_where('test_digit', array('id' => $id))->result_array());
		}

		return null;
	}
	
	public function get_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_digit.id, firstname, lastname, age, date, target, actual, time');
			$this->db->from('test_result_digit');
			$this->db->where('test_fk', $id);
			$this->db->join('test_result_item_digit', 'test_result_digit.id = test_result_item_digit.test_result_fk');
		
			return $this->db->get()->result_array();
		}
		
		return null;
	}
	
	
	public function get_single_test_results($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_digit.id, firstname, lastname, age, docid, date, target, actual, time');
			$this->db->from('test_result_digit');
			$this->db->where('test_result_digit.id', $id);
			$this->db->join('test_result_item_digit', 'test_result_digit.id = test_result_item_digit.test_result_fk');
			$results = $this->db->get()->result_array();
			
			return $results;
		}
	
		return null;
	}
	
	public function get_test_takers($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_digit.id, firstname, lastname, age, docid, date');
			$this->db->from('test_result_digit');
			$this->db->where('test_fk', $id);
	
			$results = $this->db->get()->result_array();
				
			return $results;
		}
	
		return null;
	}
	
	public function get_test_taker($id) {
		if (is_numeric($id)) {
			$this->db->select('test_result_digit.id, firstname, lastname, age, docid, test_fk');
			$this->db->from('test_result_digit');
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
		$this->db->update('test_result_digit', $test_data);
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
	
	public function delete_taker($id) {
		$this->db->trans_start();
	
		$this->db->where('test_result_fk', $id);
		$this->db->delete('test_result_item_digit');
	
		$this->db->where('id', $id);
		$this->db->delete('test_result_digit');
	
		$this->db->trans_complete();
	
		return $this->db->trans_status();
	}
	
	public function add_test($data) {
		$this->db->trans_start();

		$test_data = array(
				'name' => $data['name'],
				'disturbance' => $data['disturbance'],
				'exposure' => $data['exposure'],
				'type' => $data['type'],
				'date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('test_digit', $test_data);
		
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
		$this->db->insert('test_result_digit', $result_data);
		$last_insert_id = $this->db->insert_id();
		
		for ($i=0; $i<sizeof($data['results']); $i++) {
			if (!empty($data['results'][$i]->actual)) {
				$result_item_data = array(
						'test_result_fk' => $last_insert_id,
						'actual' => $data['results'][$i]->actual,
						'target' => $data['results'][$i]->target,
						'time' => $data['results'][$i]->time,
						);
				
				$this->db->insert('test_result_item_digit', $result_item_data);
			}
		}
		
		$this->db->trans_complete();

		return !($this->db->trans_status() === FALSE);
	}
}
<?php
class Faces_model extends CI_Model {

	var $faces_path;
	static $MAX_THUMB_WIDTH = 47;
	static $MAX_THUMB_HEIGHT = 62;
	
	public function __construct()
	{
		$this->load->database();
		$this->faces_path = realpath(APPPATH . '../resources/img/set1');
	}

	/**
	 * Gets all faces
	 */
	public function get()
	{
		$this->db->from('picture')->order_by("emotion", "asc");
		return $this->db->get()->result_array();
	}
	
	/**
	 * Adds a face in the directory and database
	 * @param array $data Data with information of the face.  It should
	 * have 'code', 'emotion', 'path', 'width', 'height'.
	 */
	public function add_face($data) {
		$data = $this->do_upload($data);
		
		return $this->db->insert('picture', $data);
	}
	
	/**
	 * Uploads an image of the face
	 * @param array $data
	 * @return $data with some extra parameters of the uploaded file
	 */
	public function do_upload($data)
	{
		$config = array(
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => $this->faces_path,
				'max_size' => 2000
				);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();

		// resize proportionally
		$width = Faces_model::$MAX_THUMB_WIDTH;
		$height = Faces_model::$MAX_THUMB_HEIGHT;
		
		if (($image_data['image_width'] / Faces_model::$MAX_THUMB_WIDTH) > ($image_data['image_height'] / Faces_model::$MAX_THUMB_HEIGHT)) {
			$height = Faces_model::$MAX_THUMB_HEIGHT;
			$width = $image_data['image_width'] * (Faces_model::$MAX_THUMB_HEIGHT / $image_data['image_height']);
		} else {
			$width = Faces_model::$MAX_THUMB_WIDTH;
			$height = $image_data['image_height'] * (Faces_model::$MAX_THUMB_WIDTH / $image_data['image_width']);
		}
		
		$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->faces_path . '/thumbs',
				'maintain_ratio' => TRUE,
				'width' => $width,
				'height' => $height
				);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		// prepares data array with extra parameters
		$data = array(
				'code' => $data['code'],
				'emotion' => $data['emotion'],
				'path' => $image_data['file_name'],
				'width' => $image_data['image_width'],
				'height' => $image_data['image_height']
		);
		
		return $data;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form_evaluasi_training_model extends CI_Model {

	var $t = 'competency_form_evaluasi_training';
	var $tj1 = 'competency_form_evaluasi_training_detail';
	var $tj2 = 'competency_form_evaluasi_training_approver';
	// var $tj2 = 'form_competency';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// public function detail($id)
	// {
	// 	$this->db->select(
	// 		't.id as id,
	// 		t.*,
	// 		tj1.*,
	// 		tj2.*
	// 		');
	// 	$this->db->from($this->t.' as t');
	// 	$this->db->join($this->tj1.' as tj1', 'tj1.'.$this->t1.'_id = t.id');
	// 	$this->db->join($this->tj2.' as tj2', 'tj2.'.$this->t1.'_id = t.id' , 'left');
		
	// 	$this->db->where('t.id', $id);

	// 	return $this->db->get();
	// }

	public function detail($id)
	{
		$this->db->select(
			't.id as id,
			t.*
			');
		$this->db->from($this->tj1.' as t');
		// $this->db->join($this->tj1.' as tj1', 'tj1.'.$this->t1.'_id = t.id');
		// $this->db->join($this->tj2.' as tj2', 'tj2.'.$this->t1.'_id = t.id' , 'left');
		
		$this->db->where($this->t.'_id', $id);

		return $this->db->get();
	}
}

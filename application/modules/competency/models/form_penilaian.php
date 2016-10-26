<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form_penilaian_model extends CI_Model {

	var $t = 'competency_form_penilaian';
	var $tj1 = 'competency_form_penilaian_detail';
	var $tj2 = 'competency_form_penilaian_approver';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function indikator($org_id, $com_def_id = null)
	{
		$this->db->select(
			't.id as id,
			t.*,
			tj1.*,
			tj2.*
			');
		$this->db->from($this->t.' as t');
		$this->db->join($this->tj1.' as tj1', 'tj1.organization_id = t.organization_id');
		$this->db->join($this->tj2.' as tj2', 'tj2.organization_id = tj1.organization_id');
		
		$this->db->where('t.organization_id', $org_id);

		return $this->db->get();
	}
}

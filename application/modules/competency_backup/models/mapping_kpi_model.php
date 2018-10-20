<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mapping_kpi_model extends CI_Model {

	var $t = 'competency_mapping_kpi';
	var $tj1 = 'competency_mapping_kpi_detail';
	var $tj2 = 'competency_mapping_kpi_approver';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function standar($org_id)
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

	public function standar_level($org_id, $com_def_id, $level)
	{
		$this->db->select(
			't.id as id,
			t.standar,
			t1.level,
			t1.competency_def_id,
			t2.title as def
			');
		$this->db->from($this->t.' as t');
		$this->db->join($this->tj1.' as t1', 't1.id = t.competency_level_id');
		$this->db->join($this->tj2.' as t2', 't2.id = t1.competency_def_id');
		
		$this->db->where('organization_id', $org_id);
		$this->db->where('t2.id', $com_def_id);
		$this->db->where('t1.level', $level);

		return $this->db->get();
	}

	public function get_competency_monitoring_id()
	{	
		$this->db->where('competency_monitoring.is_deleted',0);
		$this->db->order_by('competency_monitoring.title','asc');
		return $this->db->get('competency_monitoring');
	}

	public function save($data)
	{
		$this->db->insert($this->tj1, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->tj1, $data, $where);
		return $this->db->affected_rows();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->tj1);
		$this->db->where('id',$id);
		$this->db->where($this->tj1.'.is_deleted',0);
		$query = $this->db->get();

		return $query->row();
	}
	
}

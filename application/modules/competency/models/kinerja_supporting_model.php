<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kinerja_supporting_model extends CI_Model {

	var $t = 'competency_kinerja_supporting';
	var $tj1 = 'competency_kinerja_supporting_detail';
	var $tj2 = 'competency_kinerja_supporting_approver';
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

	public function get_kpi_detail($comp_session_id,$organization_id,$position_id,$user_id)
	{
		$this->db->select('
			a.id as id,
			a.comp_session_id as comp_session_id,
			a.organization_id as organization_id,
			a.user_id as user_id,
			a.competency_mapping_kpi_detail_id as competency_mapping_kpi_detail_id,
			a.kpi as kpi,
			a.target_kpi as target_kpi,
			a.rata_rata as rata_rata,
			b.position_group_id as position_group_id,
			b.area_kinerja_utama as area_kinerja_utama,
			b.kpi as mapping_kpi,
			b.target_kpi as mapping_target_kpi,
			b.bobot_kpi as bobot_kpi,
			b.sumber_info as sumber_info,
			b.competency_monitoring_id as competency_monitoring_id
		');
		$this->db->from('competency_form_kpi_detail as a');
		$this->db->join('competency_mapping_kpi_detail as b','a.competency_mapping_kpi_detail_id = b.id');
		$this->db->where('a.comp_session_id',$comp_session_id);
		$this->db->where('a.organization_id',$organization_id);
		$this->db->where('a.user_id',$user_id);
		$this->db->where('a.is_deleted',0);
		$this->db->where('b.is_deleted',0);
		$this->db->where('b.position_group_id',$position_id);
		return $this->db->get();
	}

	public function get_competency_penilaian()
	{
		$this->db->select('*');
		$this->db->from('competency_penilaian');
		$this->db->where('is_deleted',0);
		return $this->db->get();
	}

	public function get_competency_dasar()
	{
		$this->db->select('*');
		$this->db->from('competency_dasar');
		$this->db->where('is_deleted',0);
		return $this->db->get();
	}

	public function get_competency_kedisiplinan()
	{
		$this->db->select('*');
		$this->db->from('competency_kedisiplinan');
		$this->db->where('is_deleted',0);
		return $this->db->get();
	}
}

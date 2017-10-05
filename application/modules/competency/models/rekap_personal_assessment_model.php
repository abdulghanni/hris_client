<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekap_personal_assessment_model extends CI_Model {

	var $t = 'competency_personal_assesment';
	var $tj1 = 'competency_personal_assesment_detail';
	var $tj2 = 'competency_personal_assesment_approver';
	var $tj3 = 'competency_def';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function standar($org_id,$comp_session_id)
	{
		$this->db->select(
			't.id as id,
			t.*
			');
		$this->db->from($this->t.' as t');
		//$this->db->join($this->tj1.' as tj1', 'tj1.organization_id = t.organization_id');
		//$this->db->join($this->tj2.' as tj2', 'tj2.organization_id = tj1.organization_id');
		
		$this->db->where('t.organization_id', $org_id);
		$this->db->where('t.comp_session_id', $comp_session_id);

		return $this->db->get();
	}

	public function rekap_detail($org_id,$comp_session_id)
	{
		$this->db->select(
			't.id as id,
			t.comp_session_id as comp_session_id,
			t.nik as nik,
			t.organization_id as organization_id,
			t.position_group_id as position_group_id,
			tj1.competency_def_id as competency_def_id,
			tj1.gap as gap,
			tj3.title as title
			');
		$this->db->from($this->t.' as t');
		$this->db->join($this->tj1.' as tj1', 'tj1.competency_personal_assesment_id = t.id');
		$this->db->join($this->tj3.' as tj3', 'tj1.competency_def_id = tj3.id');
		
		$this->db->where('t.organization_id', $org_id);
		$this->db->where('t.comp_session_id', $comp_session_id);
		$this->db->where('tj1.gap <', 0);

		return $this->db->get();
	}

	public function rekap_user_detail($org_id,$comp_session_id,$nik)
	{
		$this->db->select(
			't.id as id,
			t.comp_session_id as comp_session_id,
			t.nik as nik,
			t.organization_id as organization_id,
			t.position_group_id as position_group_id,
			tj1.competency_def_id as competency_def_id,
			tj1.gap as gap,
			tj3.title as title
			');
		$this->db->from($this->t.' as t');
		$this->db->join($this->tj1.' as tj1', 'tj1.competency_personal_assesment_id = t.id');
		$this->db->join($this->tj3.' as tj3', 'tj1.competency_def_id = tj3.id');
		
		$this->db->where('t.organization_id', $org_id);
		$this->db->where('t.comp_session_id', $comp_session_id);
		$this->db->where('t.nik', $nik);
		$this->db->where('tj1.gap <', 0);

		return $this->db->get();
	}

	public function get_kpi_detail($org_id,$comp_session_id)
	{
		$this->db->select('
			a.id as id,
			a.comp_session_id as comp_session_id,
			a.organization_id as organization_id,
			a.user_id as user_id,
			a.competency_mapping_kpi_detail_id as mapping_kpi_detail_id,
			a.kpi as kpi,
			a.target_kpi as target_kpi,
			a.jan as jan,
			a.feb as feb,
			a.mar as mar,
			a.apr as apr,
			a.may as may,
			a.jun as jun,
			a.jul as jul,
			a.aug as aug,
			a.sept as sept,
			a.oct as oct,
			a.nov as nov,
			a.dece as dece,
			a.rata_rata as rata_rata,
			a.keterangan as keterangan,
			b.first_name as first_name,
			b.last_name as last_name,
			b.nik as nik,
			c.*
			');
		$this->db->from($this->tj1.' as a');
		$this->db->join('users as b', 'a.user_id = b.id');
		$this->db->join('competency_mapping_kpi_detail as c', 'a.competency_mapping_kpi_detail_id = c.id');
		
		$this->db->where('a.organization_id', $org_id);
		$this->db->where('a.comp_session_id', $comp_session_id);

		$this->db->select('*');

		return $this->db->get();
	}

	public function get_kpi_detail_by_userid($user_id)
	{
		$this->db->select('
			a.id as id,
			a.comp_session_id as comp_session_id,
			a.organization_id as organization_id,
			a.user_id as user_id,
			a.competency_mapping_kpi_detail_id as mapping_kpi_detail_id,
			a.kpi as kpi,
			a.target_kpi as target_kpi,
			a.jan as jan,
			a.feb as feb,
			a.mar as mar,
			a.apr as apr,
			a.may as may,
			a.jun as jun,
			a.jul as jul,
			a.aug as aug,
			a.sept as sept,
			a.oct as oct,
			a.nov as nov,
			a.dece as dece,
			a.rata_rata as rata_rata,
			a.keterangan as keterangan,
			
			');
		$this->db->from($this->tj1.' as a');
		//$this->db->join('users as b', 'a.user_id = b.id');
		//$this->db->join('competency_mapping_kpi_detail as c', 'a.competency_mapping_kpi_detail_id = c.id');
		
		$this->db->where('a.user_id', $user_id);

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

	public function get_periode()
	{	
		$this->db->where('comp_session.is_deleted',0);
		$this->db->order_by('comp_session.year','asc');
		$q = $this->db->get('comp_session');
		if($q->num_rows() > 0){
			return $q->result_array();
		}else{
			return array();
		}
	}
	
}

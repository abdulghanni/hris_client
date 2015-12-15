<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class competency_def_model extends CI_Model {

	var $table = 'competency_def';
	var $table_join1 = 'competency_group';
	var $column = array('title','code','competency_group');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select(
			$this->table.'.id as id,
			'.$this->table.'.title as title,
			'.$this->table.'.code as code,
			'.$this->table_join1.'.title as competency_group
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.comp_group_id');
		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
			{
				if($item == 'title'){
					$item = $this->table.'.title';
				}elseif($item == 'code'){
					$item = $this->table.'.code';
				}elseif($item == 'competency_group'){
					$item = $this->table_join1.'.title';
				}

				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			}
				
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		$this->db->where($this->table.'.is_deleted',0);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$this->db->where($this->table.'.is_deleted',0);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		$this->db->where($this->table.'.is_deleted',0);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$this->db->where($this->table.'.is_deleted',0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
		/*$this->db->where('id', $id);
		$this->db->delete($this->table);*/
	}

	public function get_competency_group()
	{	
		$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table_join1.'.title','asc');
		return $this->db->get($this->table_join1);
	}
}

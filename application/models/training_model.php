<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class training_model extends CI_Model {

	var $table = 'training';
	var $table_join1 = 'vendor';
	var $column = array('title','date_start','date_end','vendor');
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
			'.$this->table.'.training_title as title,
			'.$this->table.'.date_start as date_start,
			'.$this->table.'.date_end as date_end,
			'.$this->table_join1.'.vendor_title as vendor
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.vendor_id');
		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
			{
				if($item == 'title'){
					$item = $this->table.'.training_title';
				}elseif($item == 'date_start'){
					$item = $this->table.'.date_start';
				}elseif($item == 'date_end'){
					$item = $this->table.'.date_end';
				}elseif($item == 'vendor'){
					$item = $this->table_join1.'.vendor_title';
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

	public function get_vendor()
	{	
		$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table_join1.'.vendor_title','asc');
		return $this->db->get($this->table_join1);
	}
}

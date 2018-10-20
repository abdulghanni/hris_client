<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class personal_assesment_model extends CI_Model {

	var $t = 'competency_personal_assesment';
	var $tj1 = 'competency_personal_assesment_detail';
	var $tj2 = 'competency_personal_assesment_approver';
	// var $tj2 = 'form_competency';
	var $table = 'competency_personal_assesment';
    var $column = array('a.id','a.nik','a.comp_session_id','a.nik','a.nik','a.nik'); //set column field database for order and search
    var $order = array('a.id' => 'desc'); // default order 
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

	private function _get_datatables_query()
    {       
        $sess_id = $data['sess_id'] = $this->session->userdata('user_id');
        $nik=get_nik($sess_id);
       
             if(is_admin_competency(50) == 1 || $this->ion_auth->is_admin())
        {
             $this->db->select(array(
                'a'.'.id as id',
                'a'.'.nik as nik',
                'a'.'.comp_session_id'
            ));

            $this->db->from($this->table.' a');
        }else{
             $this->db->select(array(
                'a'.'.id as id',
                'a'.'.nik as nik',
                'a'.'.comp_session_id'
            ));

            $this->db->from($this->table.' a');
            $this->db->join('users b','a.nik = b.nik');
            $this->db->where('b.superior_id',$nik);
        }
            
    


        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
               

                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            }
                
            $column[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
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
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }
}

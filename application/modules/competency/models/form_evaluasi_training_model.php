<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form_evaluasi_training_model extends CI_Model {

	var $t = 'competency_form_evaluasi_training';
	// var $tj1 = 'competency_form_evaluasi_training_detail';
	// var $tj2 = 'competency_form_evaluasi_training_approver';
	// var $tj2 = 'form_competency';
	var $table = 'competency_form_evaluasi_training';
    var $column = array('a.id','a.nik','a.comp_session_id','a.nik','a.nik','a.nik'); //set column field database for order and search
    var $order = array('a.id' => 'desc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function detail($id)
	{
		return true;
	}

	private function _get_datatables_query()
    {       
             $this->db->select(array(
                'a'.'.id as id',
                'a'.'.nik as nik',
                'a'.'.comp_session_id'
            ));

            $this->db->from($this->table.' a');
       

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

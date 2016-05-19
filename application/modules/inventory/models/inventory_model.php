<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    var $table = 'users';
    var $column = array('nik', 'username'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $sess_id = $this->session->userdata('user_id');
        $sess_nik = get_nik($sess_id);
        $user = get_user_satu_bu($sess_nik);
        $this->db->select('id,username,nik');
        $this->db->where_in("id", $user);
        $this->db->from($this->table);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'nik'){
                    $item = $this->table.'.nik';
                }elseif($item == 'username'){
                    $item = $this->table.'.username';
                }

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
        $sess_id = $this->session->userdata('user_id');
        $sess_nik = get_nik($sess_id);
        $user = get_user_satu_bu($sess_nik);
        $this->db->where_in("id", $user);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

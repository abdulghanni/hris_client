<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_resignment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_resignment($id = null)
    {
        $sess_id = $this->session->userdata('user_id');
        $admin = is_admin();    
        
        if(!empty(is_have_subordinate(get_nik($sess_id)))){
        $sub_id = get_subordinate($sess_id);
        }else{
            $sub_id = '';
        }

        if(!empty(is_have_subsubordinate($sess_id))){
        $subsub_id = 'OR '.get_subsubordinate($sess_id);
        }else{
            $subsub_id = '';
        }


        $this->db->select('resignment.*, alasan_resign.title as alasan_resign');
        $this->db->from('users_resignment as resignment');
        $this->db->join('users', 'users.id = resignment.user_id', 'LEFT');
        $this->db->join('alasan_resign', 'resignment.alasan_resign_id = alasan_resign.id', 'LEFT');                                                                                                                                                                                                                                                                                                                                                                               
        if($id != null){
            $this->db->where('resignment.id', $id);
        }

        if($admin !=1){
            $this->db->where("(resignment.user_id= $sess_id $sub_id $subsub_id )",null, false);
        }

        $this->db->where('resignment.is_deleted', 0);
        $this->db->order_by('resignment.id', 'desc');
        $q = $this->db->get();

        return $q;

    }

    function add($data)
    {
        $this->db->insert('users_resignment', $data);
        return true;
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_resignment', $data);

        return TRUE;
    }

    public function get_alasan($r = array())
    {
        $x = '';
        for ($i=0; $i <sizeof($r) ; $i++) { 
            if($i<1){
            $this->db->where('id', $r[$i]);
            }else{  
            $this->db->or_where('id', $r[$i]);  
            }
        }

        $q = $this->db->get('alasan_resign');
        return $q;
    }

}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_demolition_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_demolition($id = null)
    {
    	$sess_id = $this->session->userdata('user_id');
            
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

    	$this->db->select('users_demolition.*, approval_status.title as approval_status');
    	$this->db->from('users_demolition');

        $this->db->join('users', 'users_demolition.user_id = users.id', 'left');
        $this->db->join('approval_status', 'users_demolition.app_status_id = approval_status.id', 'left');

    	if($id != null){
    		$this->db->where('users_demolition.id', $id);
    	}

    	$this->db->where("(users_demolition.user_id= $sess_id $sub_id $subsub_id )",null, false);
        $this->db->order_by('users_demolition.id', 'desc');

    	$q = $this->db->get();
    	return $q; 
	}

	function form_demolition_admin($id = null)
    {
    	$sess_id =  $this->session->userdata('user_id');
    	$this->db->select('demolition.*, approval_status.title as approval_status');
    	$this->db->from('users_demolition as demolition');

        //$this->db->join('users', 'demolition.user_id = users.id', 'left');
        $this->db->join('approval_status', 'demolition.app_status_id = approval_status.id', 'left');

    	if($id != null){
    		$this->db->where('demolition.id', $id);
    	}

    	//$this->db->where('user_id', $sess_id);
        $this->db->order_by('demolition.id', 'desc');

    	$q = $this->db->get();
    	return $q; 
	}

	function add($data)
	{
		$this->db->insert('users_demolition', $data);
		return TRUE;
	}

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_demolition', $data);

        return TRUE;
    }
}
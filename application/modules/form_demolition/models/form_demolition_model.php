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
    	$sess_id =  $this->session->userdata('user_id');
    	$this->db->select('demolition.*');
    	$this->db->from('users_demolition as demolition');

        //$this->db->join('users', 'demolition.user_id = users.id', 'left');
        //$this->db->join('approval_status', 'demolition.approval_status_id = approval_status.id', 'left');

    	if($id != null){
    		$this->db->where('demolition.id', $id);
    	}

    	$this->db->where('user_id', $sess_id);
        $this->db->order_by('demolition.id', 'desc');

    	$q = $this->db->get();
    	return $q; 
	}

	function form_demolition_admin($id = null)
    {
    	$sess_id =  $this->session->userdata('user_id');
    	$this->db->select('demolition.*');
    	$this->db->from('users_demolition as demolition');

        //$this->db->join('users', 'demolition.user_id = users.id', 'left');
        //$this->db->join('approval_status', 'demolition.approval_status_id = approval_status.id', 'left');

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
}
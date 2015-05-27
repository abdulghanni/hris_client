<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_promosi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_promosi($id = null)
    {
    	$sess_id =  $this->session->userdata('user_id');
    	$this->db->select('promosi.*, users.username as username, approval_status.title as approval_status');
    	$this->db->from('users_promosi as promosi');

        $this->db->join('users', 'promosi.user_id = users.id', 'left');
        $this->db->join('approval_status', 'promosi.approval_status_id = approval_status.id', 'left');

    	if($id != null){
    		$this->db->where('promosi.id', $id);
    	}

    	$this->db->where('user_id', $sess_id);
        $this->db->order_by('promosi.id', 'desc');

    	$q = $this->db->get();
    	return $q; 
	}

    function form_promosi_admin($id = null)
    {
        $this->db->select('promosi.*, users.username as username, approval_status.title as approval_status');
        $this->db->from('users_promosi as promosi');

        $this->db->join('users', 'promosi.user_id = users.id', 'left');
        $this->db->join('approval_status', 'promosi.approval_status_id = approval_status.id', 'left');

        if($id != null){
            $this->db->where('promosi.id', $id);
        }

        
        $this->db->order_by('promosi.id', 'desc');

        $q = $this->db->get();
        return $q; 
    }

	function add($data)
	{
		$this->db->insert('users_promosi', $data);
		return TRUE;
	}

    function do_approve_hrd($id, $data)
    {
        $this->db->where('id', $id)->update('users_promosi', $data);
        return true;
    }
}
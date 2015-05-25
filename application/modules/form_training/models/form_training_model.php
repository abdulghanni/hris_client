<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_training_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_training($id = null)
    {

        $sess_id = $this->session->userdata('user_id');
            
            if(!empty(is_have_subordinate(get_nik($sess_id)))){
            $sub_id = get_subordinate($sess_id);
            }else{
                $sub_id = '';
            }

        $this->db->select('training.*, training.id as id,users.nik as nik, users.username as name,penyelenggara.title as penyelenggara, pembiayaan.title as pembiayaan,
                          status_lv1.title as approval_status_lv1,
                          status_lv2.title as approval_status_lv2');
        $this->db->from('users_training as training');
        $this->db->join('users', 'users.id = training.user_id', 'LEFT');
        $this->db->join('penyelenggara', 'training.penyelenggara_id = penyelenggara.id', 'LEFT');
        $this->db->join('pembiayaan', 'training.pembiayaan_id = pembiayaan.id', 'LEFT');
        $this->db->join('approval_status as status_lv1', 'training.approval_status_id_lv1 = status_lv1.id', 'left');
        $this->db->join('approval_status as status_lv2', 'training.approval_status_id_lv2 = status_lv2.id', 'left');
                                                                                                                                                                                                                                                                                                                                                                                        
        if($id != null){
            $this->db->where('training.id', $id);
        }

        $this->db->where('training.is_deleted', 0);
        $this->db->where("(training.user_id= $sess_id $sub_id)",null, false);
        $this->db->order_by('training.id', 'desc');
        $q = $this->db->get();

        return $q;

    }

    function form_training_admin($id = null)
    {
        $this->db->select('training.*, training.id as id,users.nik as nik, users.username as name,penyelenggara.title as penyelenggara, pembiayaan.title as pembiayaan,
                          status_lv1.title as approval_status_lv1,
                          status_lv2.title as approval_status_lv2');
        $this->db->from('users_training as training');
        $this->db->join('users', 'users.id = training.user_id', 'LEFT');
        $this->db->join('penyelenggara', 'training.penyelenggara_id = penyelenggara.id', 'LEFT');
        $this->db->join('pembiayaan', 'training.pembiayaan_id = pembiayaan.id', 'LEFT');
        $this->db->join('approval_status as status_lv1', 'training.approval_status_id_lv1 = status_lv1.id', 'left');
        $this->db->join('approval_status as status_lv2', 'training.approval_status_id_lv2 = status_lv2.id', 'left');
                                                                                                                                                                                                                                                                                                                                                                                        
        if($id != null){
            $this->db->where('training.id', $id);
        }

        $this->db->order_by('training.id', 'desc');
        $this->db->where('training.is_deleted', 0);
        $q = $this->db->get();

        return $q;

    }

    function get_app_name($id)
    {
        $this->db->select('users.username as name');
        $this->db->from('users');
        
        $this->db->where('users.id', $id);
        $q = $this->db->get()->row('name');

        return $q;
    }

    function add($data)
    {
    	$this->db->insert('users_training',$data);
    	return TRUE;
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_training', $data);

        return TRUE;
    }
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_training_group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_training_group($id = null)
    {

        $sess_id = $this->session->userdata('user_id');
        $admin = is_admin();
        $superior = get_id(get_subordinate($sess_id));

        if(!empty(is_have_subordinate(get_nik($sess_id)))){
        $sub_id = get_subordinate($sess_id);
        }else{
            $sub_id = '';
        }

        $this->db->select('training_group.*, training_group.id as id,users.nik as nik, users.username as name,training_type.title as training_type, penyelenggara.title as penyelenggara, pembiayaan.title as pembiayaan,
                          status_lv1.title as approval_status_lv1,
                          status_lv2.title as approval_status_lv2');
        $this->db->from('users_training_group as training_group');
        $this->db->join('users', 'users.id = training_group.user_pengaju_id', 'LEFT');
        $this->db->join('penyelenggara', 'training_group.penyelenggara_id = penyelenggara.id', 'LEFT');
        $this->db->join('pembiayaan', 'training_group.pembiayaan_id = pembiayaan.id', 'LEFT');
        $this->db->join('training_type', 'training_group.training_type_id = training_type.id', 'LEFT');
        $this->db->join('approval_status as status_lv1', 'training_group.approval_status_id_lv1 = status_lv1.id', 'left');
        $this->db->join('approval_status as status_lv2', 'training_group.approval_status_id_lv2 = status_lv2.id', 'left');
                                                                                                                                                                                                                                                                                                                                                                                        
        if($id != null){
            $this->db->where('training_group.id', $id);
        }
        if($admin!=1){
            $this->db->where("(training_group.user_pengaju_id= $sess_id or training_group.user_peserta_id like '%$sess_id%' $sub_id)",null, false);
            //$this->db->or_where("training_group.user_peserta_id like "."'%$sess_id%'");
        }
        $this->db->where('training_group.is_deleted', 0);
        $this->db->order_by('training_group.id', 'desc');
        $q = $this->db->get();

        return $q;

    }
    
    function add($data)
    {
    	$this->db->insert('users_training_group',$data);
    	return TRUE;
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_training_group', $data);

        return TRUE;
    }
}
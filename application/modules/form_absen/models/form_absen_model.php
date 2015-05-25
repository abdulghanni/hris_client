<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_absen_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_absen($id = null)
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

        $this->db->select('absen.*, absen.id as id, absen.date_tidak_hadir as date, users.username as name,keterangan_absen.id as keterangan_id, keterangan_absen.title as keterangan_absen');
        $this->db->from('users_keterangan_absen as absen');
        $this->db->join('users', 'users.id = absen.user_id', 'LEFT');
        $this->db->join('comp_session', 'absen.id_comp_session = comp_session.id', 'LEFT');
        $this->db->join('keterangan_absen', 'absen.keterangan_id = keterangan_absen.id', 'LEFT');

        if($id != null){
            $this->db->where('absen.id', $id);
        }
        $this->db->where("(absen.user_id= $sess_id $sub_id $subsub_id )",null, false);
		$this->db->where('absen.is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $q = $this->db->get();

        return $q;

    }
	
	function form_absen_admin($id = null)
    {
        $this->db->select('absen.*, absen.id as id, absen.date_tidak_hadir as date, users.username as name,keterangan_absen.id as keterangan_id, keterangan_absen.title as keterangan_absen');
        $this->db->from('users_keterangan_absen as absen');
        $this->db->join('users', 'users.id = absen.user_id', 'LEFT');
        $this->db->join('comp_session', 'absen.id_comp_session = comp_session.id', 'LEFT');
        $this->db->join('keterangan_absen', 'absen.keterangan_id = keterangan_absen.id', 'LEFT');
		if($id != null){
            $this->db->where('absen.id', $id);
        }
		$this->db->where('absen.is_deleted', 0);
        $this->db->order_by('id', 'desc');
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

    function get_keterangan_absen()
    {
        $this->db->select('*');
        $this->db->from('keterangan_absen');
        $q = $this->db->get();
        return $q;
    }

    function add($data)
    {
        $this->db->insert('users_keterangan_absen', $data);
        return true;
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_keterangan_absen', $data);

        return TRUE;
    }
}
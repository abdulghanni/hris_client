<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_resignment_model extends CI_Model {

    var $table = 'users_resignment';
    var $join1  = 'users';
    var $column = array('users.nik'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($f)
    {
        $is_admin = is_admin();
        $is_next_hrd = $this->is_next_hrd(sessNik());
        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 10);
            $is_approver = $this->approval->approver('resignment', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }

        $this->db->select(array(
                'users_resignment'.'.id as id',
                'users_resignment'.'.date_resign',
                'users_resignment'.'.created_by',
                'users_resignment'.'.created_on',
                'users_resignment'.'.app_status_id_lv1',
                'users_resignment'.'.app_status_id_lv2',
                'users_resignment'.'.app_status_id_lv3',
                'users_resignment'.'.app_status_id_hrd',
                'users_resignment'.'.user_app_lv1',
                'users_resignment'.'.user_app_lv2',
                'users_resignment'.'.user_app_lv3',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from($this->table);

            $this->db->join($this->join1, $this->table.'.user_id ='.$this->join1.'.id', 'left');

            $this->db->where($this->table.'.is_deleted', 0);
            if($f == 1){
                $this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                $this->db->where('is_app_hrd', 1);
            }else{

            }
            if($is_admin!=1 && $is_hrd_pusat != 1 && $is_next_hrd !=1):
                if($is_approver == $sess_nik || $is_admin_cabang == 1){
                    //$this->db->where_in($this->table.'.user_id', $user);//print_mz($user);
                    if($sess_nik == 'P1493'){
                        //$this->db->or_like('users'.'.nik','P', 'after');
                        //$this->db->or_like('users'.'.nik','J', 'after');
                        $where = "(users.nik like 'P%' OR users.nik like 'J%')";
                        $this->db->where($where);
                    }else{
                        $this->db->where_in($this->table.'.user_id', $user);//print_mz($user);    
                    }
                }elseif($is_admin!=1 ){
                     $this->db->where("(users_resignment.user_id = '$sess_id'
                                   OR users_resignment.user_app_lv1 = '$sess_nik'  OR users_resignment.user_app_lv2 = '$sess_nik'  OR users_resignment.user_app_lv3 = '$sess_nik'
                    )",null, false);
                }
            endif;


        $i = 0;

        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value'])
            {
                /*if($item == 'nik'){
                    $item = $this->join1.'.nik';
                }elseif($item == 'username'){
                    $item = $this->join1.'.username';
                }elseif($item == 'date_resign'){
                    $item = $this->table.'.date_resign';
                }elseif($item == 'created_on'){
                    $item = $this->table.'.created_on';
                }*/

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

    function get_datatables($f)
    {
        $this->_get_datatables_query($f);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($f)
    {
        $this->_get_datatables_query($f);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($f)
    {
       $is_admin = is_admin();
        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 10);
            $is_approver = $this->approval->approver('resignment', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }

         if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in($this->table.'.user_id', $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_resignment.user_id = '$sess_id'
                               OR users_resignment.user_app_lv1 = '$sess_nik'  OR users_resignment.user_app_lv2 = '$sess_nik'  OR users_resignment.user_app_lv3 = '$sess_nik'
                )",null, false);
            }
            endif;
        $this->db->where('users_resignment.is_deleted', 0);
        if($f == 1){
            $this->db->where('is_app_hrd', 0);
        }elseif($f == 2){
            $this->db->where('is_app_hrd', 1);
        }else{

        }
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

     public function create_($user_id = FALSE, $additional_data = array())
    {

        $data = array('user_id'=>$user_id);

        //filter out any data passed that doesnt have a matching column in the form resignment table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_resignment
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_resignment', $data);
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function save_component($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function detail($id){
        $this->db->select(array(
                'users_resignment'.'.id as id',
                'users_resignment'.'.*',
               'status_lv1.title as approval_status_lv1',
                'status_lv2.title as approval_status_lv2',
                'status_lv3.title as approval_status_lv3',
                'status_hrd.title as approval_status_hrd',
                'users_resignment_wawancara.alasan_resign_id',
                'users_resignment_wawancara.desc_resign',
                'users_resignment_wawancara.procedure_resign',
                'users_resignment_wawancara.kepuasan_resign',
                'users_resignment_wawancara.saran_resign',
                'users_resignment_wawancara.rework_resign',
            ));

            $this->db->from('users_resignment');

            $this->db->join($this->join1, $this->table.'.user_id ='.$this->join1.'.id', 'left');
            $this->db->join('users_resignment_wawancara', 'users_resignment.id = users_resignment_wawancara.user_resignment_id', 'left');
            $this->db->join('approval_status as status_lv1', 'users_resignment.app_status_id_lv1 = status_lv1.id', 'left');
            $this->db->join('approval_status as status_lv2', 'users_resignment.app_status_id_lv2 = status_lv2.id', 'left');
            $this->db->join('approval_status as status_lv3', 'users_resignment.app_status_id_lv3 = status_lv3.id', 'left');
            $this->db->join('approval_status as status_hrd', 'users_resignment.app_status_id_hrd = status_hrd.id', 'left');
            $this->db->where('users_resignment.is_deleted', 0);
            $this->db->where('users_resignment.id', $id);

            return $this->db->get();
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

    private function is_next_hrd($user_nik){
        $f = array('bu'=>'where/50', 'form_type_id'=>'where/10');
        $next_hrd_nik = getValue('user_nik', 'users_notif_tambahan', $f);
        if($user_nik == $next_hrd_nik)return true;
        else return false;
    }

}

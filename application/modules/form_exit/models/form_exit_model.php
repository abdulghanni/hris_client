<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_exit_model extends CI_Model {

    var $table = 'users_exit';
    var $join1  = 'users';
    var $column = array('users.nik'); //set column field database for order and search
    var $order = array('created_on' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($f)
    {
        $is_admin = is_admin();
        $is_admin_inventaris = is_admin_inventaris();

        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 8);
            $is_approver = $this->approval->approver('exit', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            // if($is_hrd_pusat != 1 && !is_admin_inventaris()){
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_rekom_satu_bu($sess_nik);
            }
        }

        $this->db->select(array(
                'users_exit'.'.id as id',
                'users_exit'.'.date_exit',
                'users_exit'.'.created_by',
                'users_exit'.'.created_on',
                'users_exit'.'.app_status_id_lv1',
                'users_exit'.'.app_status_id_lv2',
                'users_exit'.'.app_status_id_lv3',
                'users_exit'.'.is_purposed',
                // 'users_exit'.'.app_status_id_hrd',
                'users_exit'.'.user_app_lv1',
                'users_exit'.'.user_app_lv2',
                'users_exit'.'.user_app_lv3',
               'users'.'.nik as nik_karyawan',
                'users'.'.username as karyawan',
                'pengaju'.'.nik as nik_pengaju',
                'pengaju'.'.username as pengaju',
            ));

            $this->db->from($this->table);

            $this->db->join($this->join1, $this->table.'.user_id ='.$this->join1.'.id', 'left');
            $this->db->join($this->join1.' as pengaju', $this->table.'.created_by ='.'pengaju'.'.id', 'left');

            $this->db->where($this->table.'.is_deleted', 0);
            $this->db->where('is_purposed', 1);
            if($f == 1){
                //$this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                //$this->db->where('is_app_hrd', 1);
            }else{

            }
            // if($is_admin!=1 && $is_hrd_pusat != 1 & $is_admin_inventaris !=1):
            if($is_admin!=1 && $is_hrd_pusat != 1):
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
                     if($sess_nik == 'P1048'){
                        //$this->db->or_like('users'.'.nik','P', 'after');
                        //$this->db->or_like('users'.'.nik','J', 'after');
                        $where = "(users.nik like 'P%' OR users.nik like 'J%')";
                        $this->db->where($where);
                    }else{
                     $this->db->where("(users_exit.user_id = '$sess_id'
                                   OR users_exit.user_exit_rekomendasi_id = '$sess_id' OR users_exit.created_by = '$sess_id' OR users_exit.user_app_lv1 = '$sess_nik'  OR users_exit.user_app_lv2 = '$sess_nik'  OR users_exit.user_app_lv3 = '$sess_nik' OR users_exit.user_submit_keuangan = '$sess_nik' OR users_exit.user_submit_it = '$sess_nik' OR users_exit.user_submit_hrd = '$sess_nik' OR users_exit.user_submit_logistik = '$sess_nik' OR users_exit.user_submit_koperasi = '$sess_nik' OR users_exit.user_submit_perpus = '$sess_nik'
                    )",null, false);
                    }
                }
            endif;



        $i = 0;

        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value'])
            {
                /*if($item == 'nik_karyawan'){
                    $item = $this->join1.'.nik';
                }elseif($item == 'karyawan'){
                    $item = $this->join1.'.username';
                }elseif($item == 'pengaju'){
                    $item = 'pengaju'.'.username';
                }elseif($item == 'nik_pengaju'){
                    $item = 'pengaju'.'.nik';
                }elseif($item == 'date_exit'){
                    $item = $this->table.'.date_exit';
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
            $is_admin_inventaris = is_admin_inventaris();
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 8);
            $is_approver = $this->approval->approver('exit', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }

        if($is_admin!=1 && $is_hrd_pusat != 1 & $is_admin_inventaris !=1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in($this->table.'.user_id', $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_exit.user_id = '$sess_id'
                               OR users_exit.user_exit_rekomendasi_id = '$sess_id' OR users_exit.created_by = '$sess_id' OR users_exit.user_app_lv1 = '$sess_nik'  OR users_exit.user_app_lv2 = '$sess_nik'  OR users_exit.user_app_lv3 = '$sess_nik'
                )",null, false);
            }
        endif;
        $this->db->where('users_exit.is_deleted', 0);
        $this->db->where('is_purposed', 1);
        if($f == 1){
            //$this->db->where('is_app_hrd', 0);
        }elseif($f == 2){
            //$this->db->where('is_app_hrd', 1);
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

        //filter out any data passed that doesnt have a matching column in the form exit table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_exit
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_exit', $data);
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
                $this->table.'.*',
                $this->table.'.id as id',
                'exit_type.title as exit_type',
                'status_lv1.title as approval_status_lv1',
                'status_lv2.title as approval_status_lv2',
                'status_lv3.title as approval_status_lv3',
                'status_hrd.title as approval_status_hrd',
                'status_hrd.title as approval_status_it',
                'status_hrd.title as approval_status_mgr',
                'status_hrd.title as approval_status_koperasi',
                'status_hrd.title as approval_status_perpus',
                'status_asset.title as approval_status_asset',
            ));
            $this->db->from('users_exit');
            $this->db->join('users', 'users.id = users_exit.user_id', 'LEFT');
            $this->db->join('exit_type', 'users_exit.exit_type_id = exit_type.id', 'LEFT');
            $this->db->join('approval_status as status_lv1', 'users_exit.app_status_id_lv1 = status_lv1.id', 'left');
            $this->db->join('approval_status as status_lv2', 'users_exit.app_status_id_lv2 = status_lv2.id', 'left');
            $this->db->join('approval_status as status_lv3', 'users_exit.app_status_id_lv3 = status_lv3.id', 'left');
            $this->db->join('approval_status as status_hrd', 'users_exit.app_status_id_hrd = status_hrd.id', 'left');
            $this->db->join('approval_status as status_it', 'users_exit.app_status_id_it = status_it.id', 'left');
            $this->db->join('approval_status as status_mgr', 'users_exit.app_status_id_mgr = status_mgr.id', 'left');
            $this->db->join('approval_status as status_perpus', 'users_exit.app_status_id_perpus = status_perpus.id', 'left');
            $this->db->join('approval_status as status_koperasi', 'users_exit.app_status_id_koperasi = status_koperasi.id', 'left');
            $this->db->join('approval_status as status_asset', 'users_exit.app_status_id_asset = status_asset.id', 'left');
            $this->db->where('users_exit.is_deleted', 0);
            $this->db->where('is_purposed', 1);
            $this->db->where('users_exit.id', $id);

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

}

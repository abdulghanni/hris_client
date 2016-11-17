<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_training_group_model extends CI_Model {

    var $table = 'users_training_group';
    var $join1  = 'users';
    var $column = array('users_training_group.id', 'nik', 'username', 'training_name', 'tujuan_training', 'created_on'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($f)
    {
        $is_admin = is_admin();
        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 11);//print_mz($is_hrd_pusat);
            $is_approver = $this->approval->approver('training', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
        $this->db->select(array(
                'users_training_group'.'.id as id',
                'users_training_group'.'.training_name',
                'users_training_group'.'.tujuan_training',
                'users_training_group'.'.created_by',
                $this->table.'.created_on',
                'users_training_group'.'.approval_status_id_lv1',
                'users_training_group'.'.approval_status_id_lv2',
                'users_training_group'.'.approval_status_id_lv3',
                'users_training_group'.'.approval_status_id_hrd',
                'users_training_group'.'.user_app_lv1',
                'users_training_group'.'.user_app_lv2',
                'users_training_group'.'.user_app_lv3',
                'users'.'.username',
                'users'.'.nik',
            ));

            $this->db->from('users_training_group');


            $this->db->join($this->join1, 'users_training_group.user_pengaju_id = users.id', 'left');
            
            $this->db->where('users_training_group.is_deleted', 0);
            if($f == 1){
                $this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                $this->db->where('is_app_hrd', 1);
            }else{
                
            }
            if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                //$this->db->where_in("users_training_group.user_pengaju_id", $user);//print_mz($user);
                if($sess_nik == 'P1493'){
                        $this->db->or_like('users'.'.nik','P', 'after');
                        $this->db->or_like('users'.'.nik','J', 'after');
                    }else{
                        $this->db->where_in("users_training_group.user_pengaju_id", $user);//print_mz($user);    
                    }
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_training_group.user_pengaju_id = '$sess_id' 
                               OR users_training_group.user_app_lv1 = '$sess_nik'  OR users_training_group.user_app_lv2 = '$sess_nik'  OR users_training_group.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
            endif;


        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'nik'){
                    $item = $this->join1.'.nik';
                }elseif($item == 'username'){
                    $item = $this->join1.'.username';
                }elseif($item == 'training_name'){
                    $item = $this->table.'.training_name';
                }elseif($item == 'tujuan_training'){
                    $item = $this->table.'.tujuan_training';
                }elseif($item == 'created_on'){
                    $item = $this->table.'.created_on';
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
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 11);
            $is_approver = $this->approval->approver('training_group', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
            
        if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_training_group.user_pengaju_id", $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_training_group.user_pengaju_id = '$sess_id' 
                               OR users_training_group.user_app_lv1 = '$sess_nik'  OR users_training_group.user_app_lv2 = '$sess_nik'  OR users_training_group.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
            endif;
        $this->db->where('users_training_group.is_deleted', 0);
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

        $data = array('user_pengaju_id'=>$user_id);

        //filter out any data passed that doesnt have a matching column in the form training_group table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_training_group
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_training_group', $data);
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
                'users_training_group'.'.id as id',
                'users_training_group'.'.*',
               'users'.'.username',
               'users'.'.nik', 
               'penyelenggara'.'.title as penyelenggara',
               'pembiayaan'.'.title as pembiayaan',
               'training_type'.'.title as training_type',
               'training_ikatan_dinas.title as ikatan',
               'training_waktu.title as waktu',
            ));

            $this->db->from('users_training_group');

            $this->db->join('users', 'users_training_group.user_pengaju_id = users.id', 'left');
            $this->db->join('penyelenggara', 'users_training_group.penyelenggara_id = penyelenggara.id', 'LEFT');
            $this->db->join('pembiayaan', 'users_training_group.pembiayaan_id = pembiayaan.id', 'LEFT');
            $this->db->join('training_type', 'users_training_group.training_type_id = training_type.id', 'LEFT');
            $this->db->join('training_ikatan_dinas', 'users_training_group.ikatan_dinas_id = training_ikatan_dinas.id', 'LEFT');
            $this->db->join('training_waktu', 'users_training_group.waktu_id = training_waktu.id', 'LEFT');
            
            $this->db->where('users_training_group.is_deleted', 0);
            $this->db->where('users_training_group.id', $id);

            return $this->db->get();
    }
}

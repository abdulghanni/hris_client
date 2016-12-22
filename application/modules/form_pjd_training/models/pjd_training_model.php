<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//last update 1 dec 16
class Pjd_training_model extends CI_Model {

    var $table = 'users_spd_training';
    var $join1  = 'users';
    var $column = array('id', 'title', 'created_on'); //set column field database for order and search
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
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 3);//print_mz($is_hrd_pusat);
            $is_approver = $this->approval->approver('dinas', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu_nik($sess_nik);
            }
        }
        $this->db->select(array(
                $this->table.'.*'
            ));

            $this->db->from($this->table);


            // $this->db->join($this->join1, $this->table.'.task_creator = users.id', 'left');
            
            $this->db->where($this->table.'.is_deleted', 0);
            $this->db->where($this->table.'.is_show', 1);
            if($f == 1){
                // $this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                // $this->db->where('is_app_hrd', 1);
            }else{
                
            }

            if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_spd_training.task_creator", $user);
            }elseif($is_admin!=1 ){
                $this->db->where("(users_spd_training.task_receiver like '%$sess_nik%' OR users_spd_training.task_creator = '$sess_nik' OR users_spd_training.created_by = '$sess_id' 
                               OR users_spd_training.user_app_lv1 = '$sess_nik'  OR users_spd_training.user_app_lv2 = '$sess_nik'  OR users_spd_training.user_app_lv3 = '$sess_nik' 
                    )",null, false);
            }
            endif;


        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'title'){
                    $item = $this->table.'.title';
                }
                // elseif($item == 'username'){
                //     $item = $this->join1.'.username';
                // }elseif($item == 'training_name'){
                //     $item = $this->table.'.training_name';
                // }elseif($item == 'tujuan_training'){
                //     $item = $this->table.'.tujuan_training';
                // }elseif($item == 'created_on'){
                //     $item = $this->table.'.created_on';
                // }

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
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 3);
            $is_approver = $this->approval->approver('dinas', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
            
        if($is_admin!=1 && $is_hrd_pusat != 1):
        if($is_approver == $sess_nik || $is_admin_cabang == 1){
            $this->db->where_in("users_spd_training.task_creator", $user);
        }elseif($is_admin!=1 ){
            $this->db->where("(users_spd_training.task_receiver like '%$sess_nik%' OR users_spd_training.task_creator = '$sess_nik' OR users_spd_training.created_by = '$sess_id' 
                           OR users_spd_training.user_app_lv1 = '$sess_nik'  OR users_spd_training.user_app_lv2 = '$sess_nik'  OR users_spd_training.user_app_lv3 = '$sess_nik' 
                )",null, false);
        }
        endif;
        $this->db->where($this->table.'.is_deleted', 0);
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

        $data = array('task_receiver'=>$user_id);
        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
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
            'transportation'.'.title as transportation_nm'
        ));

        $this->db->from($this->table);
        $this->db->join('users', 'users_spd_training.task_receiver = users.nik', 'left');
        $this->db->join('users as creator', 'users_spd_training.task_creator = creator.nik', 'left');
        $this->db->join('transportation', 'users_spd_training.transportation_id = transportation.id');
        $this->db->join('city as city_to','users_spd_training.to_city_id = city_to.id');
        $this->db->join('city as city_from','users_spd_training.from_city_id = city_from.id');

        $this->db->where($this->table.'.is_deleted', 0);
        $this->db->where($this->table.'.id', $id);

        return $this->db->get();
    }

    function report($id = null, $user_id = null){
        $sess_nik = (!empty(get_nik($this->session->userdata('user_id'))))?get_nik($this->session->userdata('user_id')):$this->session->userdata('user_id');
            $this->db->select(array(
                'users_spd_training_report.*',
            ));

            $this->db->from('users_spd_training');
            $this->db->join('users_spd_training_report', 'users_spd_training.id = users_spd_training_report.user_spd_luar_group_id', 'left');
                $this->db->where('users_spd_training_report.created_by', $user_id);
                if($id != null && $user_id != null){
                //$this->db->where('users_spd_training_report.user_spd_luar_group_id', $id);
                $this->db->where('users_spd_training_report.created_by', $user_id);
            }
            $this->db->where('users_spd_training.is_deleted', 0);
            return $this->db->get();
    }

     public function create_report($spd_id = FALSE, $additional_data = array())
    {

        $data = array('user_spd_luar_group_id'=>$spd_id);
        if (!empty($additional_data)) $data = array_merge($additional_data, $data);
        // insert the new form_spd_luar_group
        $this->db->insert('users_spd_training_report', $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update_report($id, array $data)
    {
        $this->db->update('users_spd_training_report', $data, array('id' => $id));
        return TRUE;
    }
}

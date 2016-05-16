<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_cuti_model extends CI_Model {

    var $table = 'users_cuti';
    var $join1  = 'users';
    var $join2  = 'alasan_cuti';
    var $column = array('users_cuti.id', 'nik', 'username','date_mulai_cuti', 'alasan_cuti', 'jumlah_hari'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_approver = $this->approval->approver('cuti', $sess_nik);//print_mz($is_approver);
            $is_admin = is_admin();
            $is_admin_cabang = is_admin_cabang();
            $user = get_user_satu_bu($sess_nik);

        $this->db->select(array(
                'users_cuti'.'.id as id',
                'users_cuti'.'.date_mulai_cuti',
                'users_cuti'.'.jumlah_hari',
                'users_cuti'.'.created_by',
                'users_cuti'.'.approval_status_id_lv1',
                'users_cuti'.'.approval_status_id_lv2',
                'users_cuti'.'.approval_status_id_lv3',
                'users_cuti'.'.approval_status_id_hrd',
                'users_cuti'.'.user_app_lv1',
                'users_cuti'.'.user_app_lv2',
                'users_cuti'.'.user_app_lv3',
                'alasan_cuti'.'.title as alasan_cuti',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from('users_cuti');


            $this->db->join($this->join1, 'users_cuti.user_id = users.id', 'left');
            $this->db->join($this->join2, 'users_cuti.alasan_cuti_id = alasan_cuti.HRSLEAVETYPEID', 'left');
            
            $this->db->where('users_cuti.is_deleted', 0);

            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_cuti.user_id", $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_cuti.user_id = '$sess_id' 
                               OR users_cuti.user_app_lv1 = '$sess_nik'  OR users_cuti.user_app_lv2 = '$sess_nik'  OR users_cuti.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }


        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'nik'){
                    $item = $this->join1.'.nik';
                }elseif($item == 'username'){
                    $item = $this->join1.'.username';
                }elseif($item == 'date_mulai_cuti'){
                    $item = $this->table.'.date_mulai_cuti';
                }elseif($item == 'jumlah_hari'){
                    $item = $this->table.'.jumlah_hari';
                }elseif($item == 'alasan_cuti'){
                    $item = $this->join2.'.title';
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

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_approver = $this->approval->approver('cuti', $sess_nik);//print_mz($is_approver);
            $is_admin = is_admin();
            $is_admin_cabang = is_admin_cabang();
            $user = get_user_satu_bu($sess_nik);
        if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_cuti.user_id", $user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_cuti.user_id = '$sess_id' 
                               OR users_cuti.user_app_lv1 = '$sess_nik'  OR users_cuti.user_app_lv2 = '$sess_nik'  OR users_cuti.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
        $this->db->where('users_cuti.is_deleted', 0);
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

        //filter out any data passed that doesnt have a matching column in the form cuti table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_cuti
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_cuti', $data);
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
                'users_cuti'.'.id as id',
                'users_cuti'.'.*',
                'alasan_cuti'.'.title as alasan_cuti',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from('users_cuti');

            $this->db->join('alasan_cuti', 'users_cuti.alasan_cuti_id = alasan_cuti.HRSLEAVETYPEID', 'left');
            $this->db->join('users', 'users_cuti.user_id = users.id', 'left');
            
            $this->db->where('users_cuti.is_deleted', 0);
            $this->db->where('users_cuti.id', $id);

            return $this->db->get();
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inactive_user_model extends CI_Model {

    var $table = 'users';
    var $column = array('nik', 'username','active'); //set column field database for order and search
    var $order = array('active' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        //$sess_id = $this->session->userdata('user_id');
        //$sess_nik = get_nik($sess_id);
        $is_admin = is_admin();
        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 1);
            //$is_approver = $this->approval->approver('cuti', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
        //$user = get_user_satu_bu_nik($sess_nik);
        //$this->db->select('id,username,nik');
        //$this->db->where_in("nik", $user);
        $this->db->from($this->table);

        if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_admin_cabang == 1){
                if($sess_nik == 'P1493'){
                    //$this->db->or_like('users'.'.nik','P', 'after');
                    //$this->db->or_like('users'.'.nik','J', 'after');
                    $where = "(users.nik like 'P%' OR users.nik like 'J%')";
                    $this->db->where($where);
                }else{
                    $this->db->where_in("users.id", $user);//print_mz($user);    
                }
            }elseif($is_admin!=1 ){
                 //$this->db->where("(users_cuti.user_id = '$sess_id'
                  //             OR users_cuti.user_app_lv1 = '$sess_nik'  OR users_cuti.user_app_lv2 = '$sess_nik'  OR users_cuti.user_app_lv3 = '$sess_nik'
                //)",null, false);
            }
            endif;

            //$this->db->where("users.active",0);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'nik'){
                    $item = $this->table.'.nik';
                }elseif($item == 'username'){
                    $item = $this->table.'.username';
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
       // $user = get_user_satu_bu($sess_nik);
        //$this->db->where_in("id", $user);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getInvList($user_id, $group_id){
        return $this->db->select('users_inventory.id as id, users_inventory.user_id, users_inventory.inventory_id, users_inventory.note, inventory.title as title')
                        ->from('users_inventory')
                        ->join('inventory', 'users_inventory.inventory_id = inventory.id', 'inner')
                        ->where_in('inventory.type_inventory_id', $group_id)
                        ->where('users_inventory.user_id', $user_id)
                        ->where('users_inventory.is_deleted', 0)
                        ->get();
    }

    function getUserInvGroup(){
        return $this->db->select('groups.type_inventory_id')
                 ->from('users_groups')
                 ->join('groups', 'users_groups.group_id = groups.id', 'inner')
                 ->where('groups.type_inventory_id !=', 0)
                 ->where('users_groups.user_id', sessId())
                 ->get();
    }
}

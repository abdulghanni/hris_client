<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_medical_model extends CI_Model {

    var $table = 'users_medical';
    var $join1  = 'users';
    var $join2  = 'alasan_medical';
    var $column = array('users_medical.id', 'nik', 'username', 'created_on'); //set column field database for order and search
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
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 5);//print_mz($is_hrd_pusat);
            $is_approver = $this->approval->approver('medical', $sess_nik);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
        $this->db->select(array(
                'users_medical'.'.id as id',
                'users_medical'.'.created_by',
                $this->table.'.created_on',
                'users_medical'.'.app_status_id_lv1',
                'users_medical'.'.app_status_id_lv2',
                'users_medical'.'.app_status_id_lv3',
                'users_medical'.'.is_app_hrd',
                //'users_medical'.'.app_status_id_hrd',
                'users_medical'.'.user_app_lv1',
                'users_medical'.'.user_app_lv2',
                'users_medical'.'.user_app_lv3',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from('users_medical');


            $this->db->join($this->join1, 'users_medical.user_id = users.id', 'left');
            
            $this->db->where('users_medical.is_deleted', 0);
            if($f == 1){
                $this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                $this->db->where('is_app_hrd', 1);
            }else{
                
            }
            if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_medical.user_id", $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_medical.user_id = '$sess_id' 
                               OR users_medical.user_app_lv1 = '$sess_nik'  OR users_medical.user_app_lv2 = '$sess_nik'  OR users_medical.user_app_lv3 = '$sess_nik' 
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
            $is_hrd_pusat = is_hrd_pusat($sess_nik, 1);
            $is_approver = $this->approval->approver('medical', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_hrd_pusat != 1){
                if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }
        }
            
        if($is_admin!=1 && $is_hrd_pusat != 1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_medical.user_id", $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_medical.user_id = '$sess_id' 
                               OR users_medical.user_app_lv1 = '$sess_nik'  OR users_medical.user_app_lv2 = '$sess_nik'  OR users_medical.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
            endif;
        $this->db->where('users_medical.is_deleted', 0);
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

        //filter out any data passed that doesnt have a matching column in the form medical table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_medical
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_medical', $data);
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
                'users_medical'.'.id as id',
                'users_medical'.'.*',
                //'alasan_medical'.'.title as alasan_medical',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from('users_medical');

            //$this->db->join('alasan_medical', 'users_medical.alasan_medical_id = alasan_medical.HRSLEAVETYPEID', 'left');
            $this->db->join('users', 'users_medical.user_id = users.id', 'left');
            
            $this->db->where('users_medical.is_deleted', 0);
            $this->db->where('users_medical.id', $id);

            return $this->db->get();
    }

    public function form_medical_detail($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $this->db->select('users_medical_detail.*, medical_hubungan.title as hubungan, medical_jenis_pemeriksaan.title as jenis');
        $this->db->from('users_medical_detail');

        $this->db->join('medical_hubungan', 'users_medical_detail.hubungan_id = medical_hubungan.id');
        $this->db->join('medical_jenis_pemeriksaan', 'users_medical_detail.jenis_pemeriksaan_id = medical_jenis_pemeriksaan.id');

        for($i=0;$i<sizeof($r)-1;$i++):
        $this->db->or_where('users_medical_detail.id',$r[$i]);
        endfor;

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get();
    }

    public function form_medical_hrd($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $this->db->select('users_medical_detail.karyawan_id, users_medical_detail.pasien, medical_hubungan.title as hubungan, medical_jenis_pemeriksaan.title as jenis, users_medical_hrd.rupiah as rupiah, users_medical_hrd.is_approve');
        $this->db->from('users_medical_detail');

        $this->db->join('medical_hubungan', 'users_medical_detail.hubungan_id = medical_hubungan.id');
        $this->db->join('medical_jenis_pemeriksaan', 'users_medical_detail.jenis_pemeriksaan_id = medical_jenis_pemeriksaan.id');
        $this->db->join('users_medical_hrd', 'users_medical_detail.id = users_medical_hrd.user_medical_detail_id');

        for($i=0;$i<sizeof($r)-1;$i++):
        $this->db->or_where('users_medical_detail.id',$r[$i]);
        endfor;

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get();
    }

    public function get_total_medical_hrd($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $qq = '';
        for($i=0;$i<sizeof($r)-1;$i++):
            if($i == sizeof($r)-2){
                 $qq.= ' user_medical_detail_id = '.$r[$i];
            }else{
            $qq.= ' user_medical_detail_id = '.$r[$i].' OR ';
        }
        endfor;

        $this->db->select_sum('users_medical_hrd.rupiah');
        $this->db->from('users_medical_detail');

        $this->db->join('users_medical_hrd', 'users_medical_detail.id = users_medical_hrd.user_medical_detail_id');
        $this->db->where('is_approve', 1);

        //$this->db->or_where('users_medical_detail.id',$r[$i]);
        $this->db->where("($qq)",null, false);

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get()->row('rupiah');
    }
}

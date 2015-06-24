<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_exit extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->load->database();
        $this->load->model('form_exit/form_exit_model', 'form_exit_model');
        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_nik = $this->data['sess_id'] = get_nik($this->session->userdata('user_id'));
            $mgr = $this->data['mgr_ga_nas'] = (!empty($this->get_emp_by_pos('PST242')))?$this->get_emp_by_pos('PST242'):'D0001';//D0001
            $koperasi = $this->data['koperasi'] = $this->get_emp_by_pos('PST263');//p0035
            $perpus = $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');//P1463 
            $hrd = $this->data['hrd'] = $this->get_emp_by_pos('PST129');

            $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit();


            $this->_render_page('form_exit/index');
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->data['exit_type'] = getAll('exit_type', array('is_deleted'=>'where/0'));
            $this->_render_page('form_exit/input', $this->data);
    }

    function input_inventory($user_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }elseif (!$this->ion_auth->is_admin_bagian())
        {
            echo 'Anda Tidak Punya Hak Akses Ke Halaman Ini';
        }else{

            if($this->ion_auth->is_admin_it()){
                $group_id = 2;
                $type = 'it';
            }elseif($this->ion_auth->is_admin_hrd()){
                $group_id = 1;
                $type = 'hrd';
            }elseif($this->ion_auth->is_admin_logistik()){
                $group_id = 3;
                $type = 'logistik';
            }elseif($this->ion_auth->is_admin_perpustakaan()){
                $group_id = 4;
                $type = 'perpus';
            }elseif($this->ion_auth->is_admin_koperasi()){
                $group_id = 5;
                $type = 'koperasi';
            }else{
                $group_id = 0;
            }

            $num_rows = getAll('users_exit', array('user_id'=>'where/'.$user_id))->num_rows();
            $num_rows_exit = getAll('users_exit')->num_rows();
            if($num_rows>0){
               $exit_id = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
               $this->data['is_submit'] = getValue('is_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_submit'] = getValue('user_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_submit'] = getValue('date_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['exit_id']  = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
            }else{
                $exit_id = $this->db->select('id')->order_by('id', 'asc')->get('users_exit')->last_row();
                $this->data['exit_id']  = ($num_rows_exit>0)?$exit_id->id+1:1;
                $this->data['is_submit'] = 0;
            }

            $this->data['user_id'] = $user_id;
            $this->data['user_nik'] = get_nik($user_id);
            $this->data['type'] = $type;
            $this->data['inventory'] = GetAll('inventory', array('type_inventory_id'=>'where/'.$group_id));
            $i =$this->db->select('*')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('inventory.type_inventory_id', $group_id)->where('users_inventory.user_id', $user_id)->get();
           //print_mz($i->result());
            $this->data['users_inventory'] = $i;
            $this->_render_page('form_exit/input_inventory', $this->data);
        }
    }

    function add_inventory($exit_id, $type)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif (!$this->ion_auth->is_admin_bagian()) //remove this elseif if you want to enable this for non-admins
        {
            echo 'Anda Tidak Punya Hak Akses Ke Halaman Ini';
        }

        $num_rows = getAll('users_exit', array('id'=>'where/'.$exit_id))->num_rows();

            if($num_rows>0){
                $exit_data = array(
                'id_comp_session'=>1,
                'user_id'=>$this->input->post('emp'),
                'edited_by'=>$this->session->userdata('user_id'),
                'edited_on' => date('Y-m-d',strtotime('now')),
                );
                $this->db->where('id',$exit_id)->update('users_exit', $exit_data);
            }else{
                $exit_data = array(
                            'id_comp_session'=>1,
                            'user_id'=>$this->input->post('emp'),
                            'created_by'=>$this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d',strtotime('now')),
                            );
                $this->db->insert('users_exit', $exit_data);
            }

        $inventory_id = $this->input->post('inventory_id');
        
        $x='';
        $x2='';
        for ($i=1; $i<=sizeof($inventory_id);$i++) {
            $x .= $this->input->post('is_available_'.$i).',';
            $x2 .= $this->input->post('note_'.$i).',';
        }

        $is_available = explode(',',$x);
        $note = explode(',',$x2);
        for($i=0;$i<sizeof($inventory_id);$i++){
            $data = array(
                'user_id' => $this->input->post('emp'),
                'user_exit_id'=>$exit_id,
                'inventory_id' => $inventory_id[$i],
                'is_available'=>$is_available[$i],
                'note'=>$note[$i],
                'created_by'=>$this->session->userdata('user_id'),
                'created_on' => date('Y-m-d',strtotime('now')),
                );

            $this->db->insert('users_inventory', $data);
        }

        $data2 = array(
            'is_submit_'.$type => 1,
            'user_submit_'.$type =>$this->session->userdata('user_id'),
            'date_submit_'.$type => date('Y-m-d',strtotime('now')),
            );
        $this->db->where('id',$exit_id)->update('users_exit', $data2);
        $user_id = $this->input->post('emp');

        redirect('form_exit/input_inventory/'.$user_id,'refresh');
    }
    
    function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_exit' , 'Tanggal Akhir Kerja', 'trim|required');
            //$this->form_validation->set_rules('seragam' , 'Seragam', 'trim|required');
            //$this->form_validation->set_rules('id_card' , 'ID Card', 'trim|required');
            //$this->form_validation->set_rules('kendaraan' , 'Kendaraan', 'trim|required');
            //$this->form_validation->set_rules('stnk' , 'STNK', 'trim|required');
            //$this->form_validation->set_rules('gadget' , 'HP/Laptop/Ipad', 'trim|required');
            //$this->form_validation->set_rules('laporan' , 'Laporan Serah terima', 'trim|required');
            //$this->form_validation->set_rules('saldo' , 'Rekonsiliasi Saldo', 'trim|required');
            //$this->form_validation->set_rules('koperasi' , 'Pinjaman Koperasi', 'trim|required');
            //$this->form_validation->set_rules('buku' , 'Pinjaman Buku Perpustakaan', 'trim|required');
            //$this->form_validation->set_rules('ikatan' , 'Ikatan Dinas', 'trim|required');
            //$this->form_validation->set_rules('pesangon' , 'Uang Pesangon', 'trim|required');
            //$this->form_validation->set_rules('uang_ganti' , 'Uang Pengganti Hak', 'trim|required');
            //$this->form_validation->set_rules('uang_jasa' , 'Uang Jasa', 'trim|required');
            //$this->form_validation->set_rules('skkerja' , 'Surat Keterangan Kerja', 'trim|required');
            //$this->form_validation->set_rules('ijazah' , 'Ijazah', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors()));
            }
            else
            {
                
                $user_inventory_id = $this->input->post('inventory_id');
                $x='';
                $x2='';
                for ($i=1; $i<=sizeof($user_inventory_id);$i++) {
                    $x .= $this->input->post('is_available_'.$i).',';
                    $x2 .= $this->input->post('note_'.$i).',';
                }

                $is_available = explode(',',$x);
                $note = explode(',',$x2);

                for($i=0;$i<sizeof($user_inventory_id);$i++){
                    $data = array(
                        'is_available'=>$is_available[$i],
                        'note'=>$note[$i],
                        'edited_by'=>$this->session->userdata('user_id'),
                        'edited_on' => date('Y-m-d',strtotime('now')),
                        );
                    $this->db->where('id', $user_inventory_id[$i]);
                    $this->db->update('users_inventory', $data);
                }

                $num_rows = getAll('users_exit')->num_rows();
                $user_id= $this->input->post('emp');
                $exit_id = getValue('id','users_exit', array('user_id'=>'where/'.$user_id));
                $creator_id = $this->session->userdata('user_id');
                $data1 = array(
                    'id_comp_session' => 1,
                    'date_exit' => date('Y-m-d',strtotime($this->input->post('date_exit'))),
                    'exit_type_id' => $this->input->post('exit_type_id'),
                    'is_purposed' =>1,
                    'user_exit_rekomendasi_id'   => $exit_id,
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                    );
                $this->db->where('user_id', $user_id);
                $this->db->update('users_exit', $data1);

                $data3 = array(
                    'id' => $exit_id,
                    'user_exit_id' =>$exit_id,
                    'is_pesangon' =>$this->input->post('pesangon'),
                    'is_uang_ganti' =>$this->input->post('uang_ganti'),
                    'is_uang_jasa' =>$this->input->post('uang_jasa'),
                    'is_uang_pisah' =>$this->input->post('uang_pisah'),
                    'is_sk_kerja' =>$this->input->post('skkerja'),
                    'is_ijazah' =>$this->input->post('ijazah'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                );
                $rekomendasi_num_rows = getAll('users_exit_rekomendasi', array('id'=>'where/'.$exit_id))->num_rows();
                if($rekomendasi_num_rows>0){
                    $this->db->where('id', $exit_id)->update('users_exit_rekomendasi', $data3);
                }else{
                $this->db->insert('users_exit_rekomendasi', $data3);
                }
                $this->send_approval_request($exit_id, $user_id, $creator_id);
                echo json_encode(array('st' =>1));
            }
        }
    }

    function send_approval_request($id, $user_id, $creator_id)
    {
        $url = base_url().'form_exit/detail/'.$id;
        
        //approval to manager ga nasional
        $data1 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => (!empty($this->get_emp_by_pos('PST242'))) ? $this->get_emp_by_pos('PST242') : 'D0001',
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);

        //approval to koperasi
        $data2 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST263'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);

        //approval to perpustakaan
        $data3 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST2'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data3);

        //approval to hrd
        $data4 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST129'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data4);

        //approval to ASM/Mgr/Kacab/BDM/CoE
        $data5 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data5);
    }

  
    function detail($id)
    {  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = getValue('user_id','users_exit', array('id'=>'where/'.$id));
            $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit($id, $user_id);
            $user_id = getAll('users_exit', array('id'=>'where/'.$id, ))->row()->user_id;
            $this->get_user_info($user_id);
            $this->data['mgr_ga_nas'] = $this->get_emp_by_pos('PST242');
            $this->data['koperasi'] = $this->get_emp_by_pos('PST263');
            $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');
            $this->data['hrd'] = $this->get_emp_by_pos('PST129');
            
            $this->data['sess_id'] = $this->session->userdata('user_id');
            $i =$this->db->select('*')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('users_inventory.user_id', $user_id)->get();
           
            $this->data['users_inventory'] = $i;
            $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->_render_page('form_exit/detail', $this->data);
        }
    }

    public function get_inventory_list()
    {
        $user_id = $this->input->post('id');

        $i =$this->db->select('users_inventory.id as id, users_inventory.is_available, users_inventory.note, inventory.title as title')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('users_inventory.user_id', $user_id)->get();
           //print_mz($i->result());
        $this->data['users_inventory'] = $i;
        $this->load->view('inventory_list',$this->data);
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->session->userdata('user_id');
            $date_now = date('Y-m-d');

            if($type=='admin'){
                $data = array(
                'is_app' => 1, 
                'app_status_id' => $this->input->post('app_status'), 
                'user_app' => $user_id, 
                'date_app' => $date_now,
                'note_app' => $this->input->post('note_app')
                );
                $is_app = getValue('is_app', 'users_exit', array('id'=>'where/'.$id));
                $approval_status = $this->input->post('app_status');
            }else{
                $data = array(
                'is_app_'.$type => 1,
                'app_status_id_'.$type => $this->input->post('app_status_'.$type), 
                'user_app_'.$type => $user_id, 
                'date_app_'.$type => $date_now,
                'note_'.$type => $this->input->post('note_'.$type)
            );
                $is_app = getValue('is_app_'.$type, 'users_exit', array('id'=>'where/'.$id));
                $approval_status = $this->input->post('app_status_'.$type);
            }

           if ($this->form_exit_model->update($id,$data)) {
                if($is_app==0){
                    $this->approval_mail($id, $type, $approval_status);
                }else{
                    $this->update_approval_mail($id, $type, $approval_status);
                }
               return TRUE;
            }
        }
    }

    function approval_mail($id, $type, $approval_status)
    {
        $url = base_url().'form_exit/detail/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_exit', array('id' => 'where/'.$id))->row('user_id');
         $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data1 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk anda oleh ".get_name(get_superior($receiver_id))." $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);

        $data2 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_superior($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk ".get_name($receiver_id)." $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);
    }

    function update_approval_mail($id, $type, $approval_status)
    {
        $url = base_url().'form_exit/detail/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_exit', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data1 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => $approver." melakukan perubahan status pengajuan rekomendasi karyawan Keluar untuk anda oleh ".get_name(get_superior($receiver_id))." status pengajuan anda saat ini $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);

        $data2 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_superior($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => $approver." melakukan perubahan Status pengajuan Rekomendasi karyawan Keluar untuk ".get_name($receiver_id)." status pengajuan anda saat ini $approval_status, untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);
    }

    function detail_email($id)
    {
        $user_id = getValue('user_id','users_exit', array('id'=>'where/'.$id));
        $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit($id, $user_id);
        $user_id = getAll('users_exit', array('id'=>'where/'.$id, ))->row()->user_id;
        $this->get_user_info($user_id);
        $this->data['mgr_ga_nas'] = $this->get_emp_by_pos('PST242');
        $this->data['koperasi'] = $this->get_emp_by_pos('PST263');
        $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');
        $this->data['hrd'] = $this->get_emp_by_pos('PST129');
        
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $i =$this->db->select('*')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('users_inventory.user_id', $user_id)->get();
       
        $this->data['users_inventory'] = $i;
        $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        return $this->load->view('form_exit/exit_mail', $this->data, TRUE);
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }
    
    function get_user_info($user_id)
    {

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($user_id).'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getuser_info = file_get_contents($url);
            $user_info = json_decode($getuser_info, true);
            return $this->data['user_info'] = $user_info;
        } else {
            return $this->data['user_info'] = '';
        }
    }
    
    function get_emp_by_pos($posid)
    {
        
        $url = get_api_key().'users/employee_by_pos/POSID/'.$posid.'/format/json';
        //print_mz($url);
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getuser_info = file_get_contents($url);
            $pos_info = json_decode($getuser_info, true);
            return $pos_info['EMPLID'];
        } else {
            return false;
        }
    }
    
    

    public function get_emp_org()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $org_nm = $user_info['ORGANIZATION'];
            } else {
                $org_nm = '';
            }
        
        echo $org_nm;
    }

    public function get_emp_pos()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $pos_nm = $user_info['POSITION'];
            } else {
                $pos_nm = '';
            }

        echo $pos_nm;
    }

    public function get_emp_nik()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $nik = $user_info['EMPLID'];
            } else {
                $nik = '';
            }

        echo $nik;
    }

    public function get_emp_bu()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $bu_nm = $user_info['BU'];
            } else {
                $bu_nm = '';
            }

        echo $bu_nm;
    }

    function form_exit_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_exit')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_exit_model->render_session()->result();
            
            if(is_admin()){
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit_admin($id);
            }else{
            $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit($id);
            }


        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('exit_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_exit/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_exit.js');

                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_exit/input',
                                             'form_exit/input_inventory',
                                             'form_exit/detail',)))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_exit.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                    $this->template->add_css('approval_img.css');
                     
                }elseif(in_array($view, array('form_exit/approval')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_exit.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('approval_img.css');
                    
                }


            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }
}   
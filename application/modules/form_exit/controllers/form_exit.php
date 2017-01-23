<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_exit extends MX_Controller {

  public $data;
  var $form_name = 'exit';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');

        $this->load->database();
        $this->load->model('form_exit/form_exit_model', 'main');
        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = 'Rekomendasi Karyawan Keluar';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/exit'));
            $this->data['form_name'] = 'exit';
            $this->data['form'] = 'exit';
            $this->data['is_admin'] = is_admin(); 
            $this->_render_page('form_exit/index', $this->data);
        }
    }

    function ajax_list($f){
        $list = $this->main->get_datatables($f);//lastq();
        //print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            if($r->is_purposed == 1){
                //AKSI
               $detail = base_url()."form_$this->form_name/detail/".$r->id; 
               $print = base_url()."form_$this->form_name/form_$this->form_name"."_pdf/".$r->id; 
               $delete = (($r->app_status_id_lv1 == 0 && $r->created_by == sessId()) || is_admin()) ? '<button onclick="showModal('.$r->id.')" class="btn btn-sm btn-danger" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : '';
				
                //APPROVAL
                if(!empty($r->user_app_lv1)){
                    $status1 = ($r->app_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
                }else{
                    $status1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Langsung'></i>";
                }
                if(!empty($r->user_app_lv2)){
                    $status2 = ($r->app_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
                }else{
                    $status2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Tidak Langsung'></i>";
                }
                if(!empty($r->user_app_lv3)){
                    $status3 = ($r->app_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
                }else{
                    $status3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Lainnya'></i>";
                }
                
                //$statushrd = ($r->app_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

                $no++;
                $row = array();
                $row[] = "<a href=$detail>".$r->id.'</a>';
                $row[] = "<a href=$detail>".$r->pengaju.' - '.$r->nik_pengaju.'</a>';
                $row[] = "<a href=$detail>".$r->karyawan.' - '.$r->nik_karyawan.'</a>';
                $row[] = dateIndo($r->date_exit);
                $row[] = dateIndo($r->created_on);
                $row[] = $status1;
                $row[] = $status2;
                $row[] = $status3;
                // $row[] = $statushrd;
                $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
                          <a class='btn btn-sm btn-light-azure' target='_blank' href=$print title='Klik icon ini untuk mencetak form pengajuan'><i class='icon-print'></i></a>
                          ".$delete;
                $data[] = $row;
            }
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main->count_all($f),
                        "recordsFiltered" => $this->main->count_filtered($f),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function input($user_id = null)
    {
        $this->data['title'] = 'Input - Rekomendasi Karyawan Keluar';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
            $this->data['user_id'] = $user_id;
            $this->data['superior'] = (!empty($user_id))?get_superior($user_id):'';
            $this->data['date_exit'] = (!empty($user_id))?getValue('date_exit', 'users_exit', array('user_id'=>'where/'.$user_id)):'';
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            // $this->get_user_atasan();
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->data['exit_type'] = getAll('exit_type', array('is_deleted'=>'where/0'));
            $this->_render_page('form_exit/input', $this->data);
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
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors()));
                redirect('form_exit/input','refresh');
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

                $creator_id = $this->session->userdata('user_id');
                $num_rows = getAll('users_exit')->num_rows();
                $user_id= $this->input->post('emp');
                $exit_id = getValue('id','users_exit', array('user_id'=>'where/'.$user_id));
                if($exit_id == 0):
                    $exit = array(
                            'user_id' => $user_id,
                            'created_by' => $creator_id,
                            'created_on' => date('Y-m-d',strtotime('now')),
                            'is_deleted' => 0
                        );
                    $this->db->insert('users_exit', $exit);
                    $exit_id = $this->db->insert_id();
                endif;
                $data1 = array(
                    'id_comp_session' => 1,
                    'date_exit' => date('Y-m-d',strtotime($this->input->post('date_exit'))),
                    'exit_type_id' => $this->input->post('exit_type_id'),
                    'is_purposed' =>1,
                    'user_exit_rekomendasi_id'   => $exit_id,
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'user_app_asset'        => $this->input->post('asset_mng'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                    'is_deleted'            => 0
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

                $laporan_num_rows = getAll('users_inventory', array('user_id'=>'where/'.$user_id, 'inventory_id'=>'where/10'))->num_rows();
                if($laporan_num_rows<1){
                    $laporan = array(
                        'inventory_id' => '10',
                        'user_id' => $user_id,
                        //'user_exit_id' =>$exit_id,
                        'is_available'=>$this->input->post('is_available_laporan'),
                        'note'=>$this->input->post('note_laporan'),
                    );

                    $this->db->insert('users_inventory', $laporan);
                }
                
                $isi_email = get_name($user_id).' mengajukan rekomendasi karyawan keluar, untuk melihat detail silakan <a href='.base_url().'form_exit/detail/'.$exit_id.'>Klik Disini</a><br />';

                $this->send_approval_request($exit_id, $user_id, $creator_id);
                redirect('form_exit', 'refresh');
                //echo json_encode(array('st' =>1));
            }
        }
    }

    function send_approval_request($id, $user_id, $creator_id)
    {
        $url = base_url().'form_exit/detail/'.$id;
        $user_app_lv1 = getValue('user_app_lv1', 'users_exit', array('id'=>'where/'.$id));
        $user_app_lv2 = getValue('user_app_lv2', 'users_exit', array('id'=>'where/'.$id));
        $user_app_lv3 = getValue('user_app_lv3', 'users_exit', array('id'=>'where/'.$id));
        $user_app_asset = getValue('user_app_asset', 'users_exit', array('id'=>'where/'.$id));

        // $admin_bagian = $this->db->where('group_id',3)->or_where('group_id',4)->or_where('group_id',5)->or_where('group_id',6)->or_where('group_id',7)->or_where('group_id',8)->get('users_groups')->result_array('user_id');
        $user_bu = $this->get_user_bu_notif(get_nik($creator_id));
        $admin_bagian = $this->db->select('user_id')->from('users_groups')->join('groups', 'users_groups.group_id = groups.id')->where('groups.admin_type_id', 3)->where('bu', $user_bu)->get()->result_array('user_id');//print_mz($admin_bagian);
        for($i=0;$i<sizeof($admin_bagian);$i++):
            $receiver = get_nik($admin_bagian[$i]['user_id']);
            $data = array(
                    'sender_id' => get_nik($creator_id),
                    'receiver_id' => $receiver,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                    'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
            $isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
        endfor;
            // lastq();
        //approval to LV1
        if(!empty($user_app_lv1)){
            $data1 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $user_app_lv1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data1);
            /*kirim notif ke pak naryo sebagai manager HR*/
         /*    $data_hrd1 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => 'G0019',
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data_hrd1); */
            /*kirim notif ke bu dede sebagai admin payroll*/
         /*    $data_hrd2 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => 'P0081',
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data_hrd2); */
            $isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
        }

        //approval to LV2
        if(!empty($user_app_lv2)){
            $data2 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $user_app_lv2,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data2);
            $isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_app_lv2)))$this->send_email(getEmail($user_app_lv2), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
        }

        //approval to LV3
        if(!empty($user_app_lv3)){
            $data3 = array(
                    'sender_id' => get_nik($creator_id),
                'receiver_id' => $user_app_lv3,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data3);
            $isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_app_lv3)))$this->send_email(getEmail($user_app_lv3), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
        }

        if(!empty($user_app_asset)){
            $data4 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $user_app_asset,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
                );
            $this->db->insert('email', $data4);
            $isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_app_asset)))$this->send_email(getEmail($user_app_asset), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
        }

        //if($type == 'hrd' && $approval_status == 1){
            $this->send_notif_tambahan($id, 'Exit Clearance');
        //}

    }

        
        function get_user_bu_notif($user_id)
    {
        if(empty($user_id)){
            return '-';
        }else{
            $url = get_api_key().'users/user_bu/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                //if($user_info == '51')$user_info = '50';
                return $user_info;
            } else {
                return '';
            }
        }
    }

    function detail($id, $lv = null)
    {  
        $this->data['title'] = 'Detail - Rekomendasi Karyawan Keluar';
        if(!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $user_id = getValue('user_id','users_exit', array('id'=>'where/'.$id));
            $form_exit = $this->data['form_exit'] = $this->main->detail($id, $user_id);
            $user_id = getValue('user_id', 'users_exit', array('id'=>'where/'.$id));
            $user_nik = get_nik($user_id);
            $user_nik = $this->data['user_nik'] = get_nik($user_id);//print_mz(get_user_buid($user_nik));
            $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $user_buid = get_user_buid($user_nik);

            $get_admin_hrd = get_admin_hrd($user_buid);
            $get_admin_it = get_admin_it($user_buid);
            $get_admin_logistik = get_admin_logistik($user_buid);
            $get_admin_koperasi = get_admin_koperasi($user_buid);
            $get_admin_perpus = get_admin_perpus($user_buid);
            $get_admin_keuangan = get_admin_keuangan($user_buid);
            $get_admin_audit = get_admin_audit($user_buid);
            $get_admin_akunting = get_admin_akunting($user_buid);
            $get_admin_legal = get_admin_legal($user_buid);
            $get_admin_payroll = get_admin_payroll($user_buid);

            //$this->data['is_admin_it'] = (is_admin_it() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            //$this->data['is_admin_hrd'] = (is_admin_hrd() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            $this->data['is_admin_hrd'] = (is_admin_hrd($user_buid) && $get_admin_hrd == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_it'] = (is_admin_it($user_buid) && $get_admin_it == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_logistik'] = (is_admin_logistik($user_buid) && $get_admin_logistik == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_koperasi'] = (is_admin_koperasi($user_buid)) ? TRUE : FALSE;
            $this->data['is_admin_perpus'] = (is_admin_perpus($user_buid) && $get_admin_perpus == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_keuangan'] = (is_admin_keuangan($user_buid) && $get_admin_keuangan == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_audit'] = (is_admin_audit($user_buid) && $get_admin_audit == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_akunting'] = (is_admin_akunting($user_buid) && $get_admin_akunting == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_legal'] = (is_admin_legal($user_buid) && $get_admin_legal == $sess_id) ? TRUE : FALSE;
            $this->data['is_admin_payroll'] = (is_admin_payroll($user_buid) && $get_admin_payroll == $sess_id) ? TRUE : FALSE;


            //$this->data['is_admin_logistik'] = (is_admin_logistik() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            //$this->data['is_admin_koperasi'] = (is_admin_koperasi()) ? TRUE : FALSE;
            //$this->data['is_admin_perpus'] = (is_admin_perpus() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            //$this->data['is_admin_keuangan'] = (is_admin_keuangan() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            //$this->data['is_admin_audit'] = (is_admin_audit() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            //$this->data['is_admin_akunting'] = (is_admin_akunting() && get_user_buid($sess_nik) == get_user_buid($user_nik)) ? TRUE : FALSE;
            $i =$this->db->select('*')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('users_inventory.user_id', $user_id)->where('users_inventory.is_deleted', 0)->get();
           
            $this->data['users_inventory'] = $i;
            $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            if($lv != null){
                $this->data['row'] = $this->main->detail($id, $user_id)->row();;
                $app = $this->load->view('form_'.$this->form_name.'/'.$lv, $this->data, true);
                $note = $this->load->view('form_'.$this->form_name.'/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{
                $this->_render_page('form_exit/detail', $this->data);
            }
        }
    }

    public function get_inventory_list()
    {
        $user_id = $this->input->post('id');
        $this->data['laporan_num_rows'] = getAll('users_inventory', array('user_id'=>'where/'.$user_id, 'inventory_id'=>'where/10'))->num_rows();
        $this->data['users_inventory'] = GetJoin("users_inventory", "inventory", "users_inventory.inventory_id = inventory.id",  "left", 'users_inventory.*, inventory.title as title', array('users_inventory.user_id'=>'where/'.$user_id));
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
            $user_id = get_nik($this->session->userdata('user_id'));
            $date_now = date('Y-m-d');

				$user_app_lv1 = getValue('user_app_lv1', 'users_exit', array('id'=>'where/'.$id));
				$user_status_id_lv1 = getValue('app_status_id_lv1', 'users_exit', array('id'=>'where/'.$id));
				$user_app_lv2 = getValue('user_app_lv2', 'users_exit', array('id'=>'where/'.$id));
				$user_status_id_lv2 = getValue('app_status_id_lv2', 'users_exit', array('id'=>'where/'.$id));
				$user_app_lv3 = getValue('user_app_lv3', 'users_exit', array('id'=>'where/'.$id));
				$user_status_id_lv3 = getValue('app_status_id_lv3', 'users_exit', array('id'=>'where/'.$id));
				$user_app_asset = getValue('user_app_asset', 'users_exit', array('id'=>'where/'.$id));
				$user_status_id_asset = getValue('app_status_id_asset', 'users_exit', array('id'=>'where/'.$id));
				$creator_id = getValue('created_by', 'users_exit', array('id'=>'where/'.$id));
				$target_id = getValue('user_id', 'users_exit', array('id'=>'where/'.$id));
				//GA
				$user_status_id_mgr = getValue('app_status_id_mgr', 'users_exit', array('id'=>'where/'.$id));
				//Koperasi
				$user_status_id_koperasi = getValue('app_status_id_koperasi', 'users_exit', array('id'=>'where/'.$id));
				//Perpus
				$user_status_id_perpus = getValue('app_status_id_perpus', 'users_exit', array('id'=>'where/'.$id));
				//HRD
				$user_status_id_hrd = getValue('app_status_id_hrd', 'users_exit', array('id'=>'where/'.$id));
				//Akunting
				$user_status_id_akunting = getValue('app_status_id_akunting', 'users_exit', array('id'=>'where/'.$id));
				//Audit
				$user_status_id_audit = getValue('app_status_id_audit', 'users_exit', array('id'=>'where/'.$id));
				//IT
				$user_status_id_it = getValue('app_status_id_it', 'users_exit', array('id'=>'where/'.$id));
				//Keuangan
				$user_status_id_keuangan = getValue('app_status_id_keuangan', 'users_exit', array('id'=>'where/'.$id));
				
				//target
				$target_nik = get_nik($target_id);
				$user_buid = get_user_buid($target_nik);
						
				//GA
				$get_admin_logistik = get_admin_logistik($user_buid);
				if(!empty($get_admin_logistik))
				{
					$statusganeed =1;
					if($user_status_id_mgr==1)
					{	
						$statusgadone=1;
					}
					else
					{	
						$statusgadone=0;
					}
				}
				else
				{	
					$statusganeed=0;
					$statusgadone=0;
				}
				
				//hrd
				$get_admin_hrd = get_admin_hrd($user_buid);
				if(!empty($get_admin_hrd))
				{
					$statushrdneed =1;
					if($user_status_id_hrd==1)
					{	
						$statushrddone=1;
					}
					else
					{	
						$statushrddone=0;
					}
				}
				else
				{	
					$statushrdneed=0;
					$statushrddone=0;
				}
				//IT
				$get_admin_it = get_admin_it($user_buid);
				if(!empty($get_admin_it))
				{
					$statusitneed =1;
					if($user_status_id_it==1)
					{	
						$statusitdone=1;
					}
					else
					{	
						$statusitdone=0;
						$statusitneed=0;
					}
				}
				else
				{	
					$statusitneed=0;
					$statusitdone=0;
				}
				//Koperasi
				$get_admin_koperasi = get_admin_koperasi($user_buid);
				if(!empty($get_admin_koperasi))
				{
					$statuskoperasineed =1;
					if($user_status_id_koperasi==1)
					{	
						$statuskoperasidone=1;
					}
					else
					{	
						$statuskoperasidone=0;
						$statuskoperasineed=0;
					}
				}
				else
				{	
					$statuskoperasineed=0;
					$statuskoperasidone=0;
				}
				//Perpus
				$get_admin_perpus = get_admin_perpus($user_buid);
				if(!empty($get_admin_perpus))
				{
					$statusperpusneed =1;
					if($user_status_id_perpus==1)
					{	
						$statusperpusdone=1;
					}
					else
					{	
						$statusperpusdone=0;
						$statusperpusneed=0;
					}
				}
				else
				{	
					$statusperpusneed=0;
					$statusperpusdone=0;
				}
				//Keuangan
				$get_admin_keuangan = get_admin_keuangan($user_buid);
				if(!empty($get_admin_keuangan))
				{
					$statuskeuanganneed =1;
					if($user_status_id_keuangan==1)
					{	
						$statuskeuangandone=1;
					}
					else
					{	
						$statuskeuangandone=0;
						$statuskeuanganneed=0;
					}
				}
				else
				{	
					$statuskeuanganneed=0;
					$statuskeuangandone=0;
				}
				//audit
				$get_admin_audit = get_admin_audit($user_buid);
				if(!empty($get_admin_audit))
				{
					$statusauditneed =1;
					if($user_status_id_audit==1)
					{	
						$statusauditdone=1;
					}
					else
					{	
						$statusauditdone=0;
					}
				}
				else
				{	
					$statusauditneed=0;
					$statusauditdone=0;
				}
				//Akunting
				$get_admin_akunting = get_admin_akunting($user_buid);
				if(!empty($get_admin_akunting))
				{
					$statusakuntingneed =1;
					if($user_status_id_akunting==1)
					{	
						$statusakuntingdone=1;
					}
					else
					{	
						$statusakuntingdone=0;
					}
				}
				else
				{	
					$statusakuntingneed=0;
					$statusakuntingdone=0;
				}
		
						//Atasan pertama
						if(!empty($user_app_lv1)){
							$status1need =1;
							if($user_status_id_lv1==1)
							{	$status1done=1;}
							else
							{	$status1done=0;}
						}
						else
						{	
							$status1need =0;
							$status1done=0;
						}
						//Atasan Kedua
						if(!empty($user_app_lv2)){
							$status2need =1;
							if($user_status_id_lv2==1){
								$status2done=1;
							}
							else{
								$status2done=0;
							}
						}
						else{
							$status2need =0;
							$status2done=0;
						}
						//Atasan Ketiga
						if(!empty($user_app_lv3)){
							$status3need =1;
							if($user_status_id_lv3==1){
								$status3done=1;
							}
							else{
								$status3done=0;
							}
						}
						else{
							$status3need =0;
							$status3done=0;
						}
						//Atasan Keempat
						if(!empty($user_app_asset)){
							$status4need =1;
							if($user_status_id_asset==1){
								$status4done=1;
							}
							else{
								$status4done=0;
							}
						}
						else{
							$status4need =0;
							$status4done=0;
						}
						
						
						$statusneed=$status1need+$status2need+$status3need+$status4need+$statusganeed+$statushrdneed+$statusitneed+$statusperpusneed+$statuskoperasineed+$statusauditneed+$statuskeuanganneed;
						$statusdoneall=$status1done+$status3done+$status3done+$status4done+$statusgadone+$statushrddone+$statusitdone+$statusperpusdone+$statuskoperasidone+$statusauditdone+$statuskeuangandone;
						$statusneedall=$statusneed-1;						
						if($statusdoneall==$statusneedall){
							  
									$data1 = array(
										'sender_id' => get_nik($creator_id),
										'receiver_id' => $user_app_lv1,
										'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
										'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
										'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($target_id).', untuk melihat detail silakan <a class="klikmail" href='.base_url()."form_exit/detail/".$id.'>Klik Disini</a><br />'.$this->detail_email($id),
										'is_read' => 0,
										);
									$this->db->insert('email', $data1);
									
									//kirim notif ke pak naryo sebagai manager HR
									$data_hrd1 = array(
										'sender_id' => get_nik($creator_id),
										'receiver_id' => 'G0019',
										'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
										'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
										'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($target_id).', untuk melihat detail silakan <a class="klikmail" href='.base_url()."form_exit/detail/".$id.'>Klik Disini</a><br />'.$this->detail_email($id),
										'is_read' => 0,
										);
									$this->db->insert('email', $data_hrd1);
								
									//kirim notif ke bu dede sebagai admin payroll
									$data_hrd2 = array(
										'sender_id' => get_nik($creator_id),
										'receiver_id' => 'P0081',
										'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
										'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
										'email_body' =>get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($target_id).', untuk melihat detail silakan <a class="klikmail" href='.base_url()."form_exit/detail/".$id.'>Klik Disini</a><br />'.$this->detail_email($id),
										'is_read' => 0,
										);
									$this->db->insert('email', $data_hrd2);
									
									$isi_email = get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($target_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
									if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Rekomendasi Karyawan Keluar', $isi_email);
							
							
						}
			
						$data = array(
						'is_app_'.$type => 1, 
						'app_status_id_'.$type => $this->input->post('app_status_'.$type),
						'user_app_'.$type => $user_id, 
						'date_app_'.$type => $date_now,
						'note_'.$type => $this->input->post('note_'.$type)
						);
			
				if ($this->main->update($id,$data)) {
			     redirect('form_exit/detail/'.$id, 'refresh');
            }
        }
		
    }

    function send_notif($id, $type)
    {
        $user_id = sessNik();
        $is_app = 0;
        $approval_status = getValue('app_status_id_'.$type, 'users_exit', array('id'=>'where/'.$id));
        if($is_app==0){
            $this->approval_mail($id, $approval_status);
        }else{
            $this->update_approval_mail($id, $approval_status);
        }
    }

    function approval_mail($id, $approval_status)
    {
        $url = base_url().'form_exit/detail/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $creator_id = getAll('users_exit', array('id' => 'where/'.$id))->row('created_by');
        $user_id = getAll('users_exit', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $receiver = get_nik($user_id);
        $data1 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' =>  $receiver,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Status Pengajuan Rekomendasi Keluar dari Atasan',
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk anda oleh ".get_name($creator_id)." $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);
        $isi_email = "Status pengajuan Rekomendasi karyawan Keluar untuk anda oleh ".get_name($creator_id)." $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>";
        if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Rekomendasi Keluar dari Atasan', $isi_email);


        $data2 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($creator_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Status Pengajuan Rekomendasi Keluar dari Atasan',
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk ".get_name($user_id)." $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);
        if(!empty(getEmail($creator_id)))$this->send_email(getEmail($creator_id), 'Status Pengajuan Rekomendasi Keluar dari Atasan', $isi_email);
    }

    function update_approval_mail($id, $approval_status)
    {
        $url = base_url().'form_exit/detail/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $creator_id = getAll('users_exit', array('id' => 'where/'.$id))->row('created_by');
        $user_id = getAll('users_exit', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $receiver = get_nik($user_id);
        $data1 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' =>  $receiver,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Perubahan Status Pengajuan Rekomendasi Keluar dari Atasan',
                'email_body' => $approver." melakukan perubahan status pengajuan rekomendasi karyawan Keluar untuk anda oleh ".get_name($creator_id)." status pengajuan anda saat ini $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);
        $isi_email = $approver." melakukan perubahan status pengajuan rekomendasi karyawan Keluar untuk anda oleh ".get_name($creator_id)." status pengajuan anda saat ini $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>";
        if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Perubahan Status Pengajuan Rekomendasi Keluar dari Atasan', $isi_email);


        $data2 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($creator_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Perubahan Status Pengajuan Rekomendasi Keluar dari Atasan',
                'email_body' => $approver." melakukan perubahan status pengajuan rekomendasi karyawan Keluar untuk  ".get_name($user_id)." status pengajuan anda saat ini $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);
        if(!empty(getEmail($creator_id)))$this->send_email(getEmail($creator_id), 'Perubahan Status Pengajuan Rekomendasi Keluar dari Atasan', $isi_email);
    }

    function detail_email($id)
    {
        return true;
    }

    public function get_atasan()
    {

        $id = $this->input->post('id');
        $url = get_api_key().'users/superior/EMPLID/'.get_nik($id).'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_task_receiver = file_get_contents($url);
            $task_receiver = json_decode($get_task_receiver, true);
             foreach ($task_receiver as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        } else {
           $result['-']= '- Tidak ada user dengan departemen yang sama -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_atasan',$data);
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
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

        $user_id = getValue('user_id','users_exit', array('id'=>'where/'.$id));
        $form_exit = $this->data['form_exit'] = $this->main->detail($id, $user_id);
        $user_id = getValue('user_id', 'users_exit', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id');
        $i =$this->db->select('*')->from('users_inventory')->join('inventory', 'users_inventory.inventory_id = inventory.id', 'left')->where('users_inventory.user_id', $user_id)->get();
       
        $this->data['users_inventory'] = $i;
        $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

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

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');

                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datatables.min.css');
                    
                }
                elseif(in_array($view, array('form_exit/input')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_exit.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('approval_img.css');
                     
                }
                elseif(in_array($view, array('form_exit/detail')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_approval.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
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
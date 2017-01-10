<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_kenaikan_gaji extends MX_Controller {

    public $data;
    var $form_name = 'kenaikan_gaji';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_kenaikan_gaji/form_kenaikan_gaji_model','main');

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = ucfirst('Kenaikan Gaji');
        $this->data['form_name'] = $this->form_name;
        $this->data['form'] = $this->form_name;
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['is_admin'] = is_admin(); 
            $this->_render_page('form_kenaikan_gaji/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->main->get_datatables($f);//lastq();//print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_".$this->form_name."/detail/".$r->id; 
           $print = base_url()."form_".$this->form_name."/form_".$this->form_name."_pdf/".$r->id; 
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
            


            $statushrd = ($r->app_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->karyawan.' - '.$r->nik_karyawan.'</a>';
            $row[] = "<a href=$detail>".$r->pengaju.' - '.$r->nik_pengaju.'</a>';
            $row[] = get_position_name($r->old_pos);
            $row[] = get_position_name($r->new_pos);
            $row[] = dateIndo($r->date_rolling);
            $row[] = dateIndo($r->created_on);
            $row[] = $status1;
            $row[] = $status2;
            $row[] = $status3;
            $row[] = $statushrd;
            $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
                      <a class='btn btn-sm btn-light-azure' href=$print title='Klik icon ini untuk mencetak form pengajuan'><i class='icon-print'></i></a>
                      ".$delete;
            $data[] = $row;
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

    function input()
    {
        $this->data['title'] = 'Input - Form Kenaikan Gaji';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->get_bu();
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            // $this->get_user_atasan();

            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_kenaikan_gaji/input', $this->data);
        }
    }

    function detail($id, $lv = null)
    {
        $this->data['title'] = 'Detail - Form Mutasi';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
           $this->data['id'] = $id;
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $user_id = getValue('user_id', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
            $this->data['user_nik'] = get_nik($user_id);
            $this->data['row'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $this->data['user_id'] =$user_id = getValue('created_by', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
            $first_name = getValue('first_name', 'users', array('id'=>'where/'.$user_id));
            $this->data['user_folder'] = $user_id.$first_name.'/sdm/';
            $attachment = getValue('attachment', 'users_kenaikan_gaji', array('id' => 'where/'.$id));
            $this->data['attachment'] = explode(",",$attachment);
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->data['created_by'] = getValue('created_by', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            $this->data['komponen'] = $this->main->detail_komponen($id);
            if($lv != null){
                $app = $this->load->view('form_'.$this->form_name.'/'.$lv, $this->data, true);
                $note = $this->load->view('form_'.$this->form_name.'/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{
                $this->_render_page('form_'.$this->form_name.'/detail', $this->data);
            }
        }
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $user_id = $this->input->post('emp');
                $sess_id = $this->session->userdata('user_id');
                $additional_data = array(
                    'old_bu'       => $this->input->post('old_bu'),
                    'old_org'     => $this->input->post('old_org'),
                    'old_pos'           => $this->input->post('old_pos'),
                    'new_bu'        => $this->input->post('bu'),
                    'new_org'        => $this->input->post('org'),
                    'new_pos'           => $this->input->post('pos'),
                    'date_rolling'           => date('Y-m-d',strtotime($this->input->post('date_kenaikan_gaji'))),
                    'alasan'           => $this->input->post('alasan'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'user_app_lv4'          => $this->input->post('atasan4'),
                    'user_app_lv5'          => $this->input->post('atasan5'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $lama = $this->input->post('lama');
                $nominal_lama = $this->input->post('nominal_lama');
                $baru = $this->input->post('baru');
                $nominal_baru = $this->input->post('nominal_baru');

                if ($this->form_validation->run() == true && $this->main->create_($user_id, $additional_data))
                {
                     $rolling_id = $this->db->insert_id();
                    if(!empty($lama)){
                            for($j=0;$j<sizeof($lama);$j++):
                                $data = array(
                                'user_kenaikan_gaji_id' => $rolling_id,
                                'old_komponen' => $lama[$j],
                                'old_nominal' => $nominal_lama[$j],
                                'new_komponen' => $baru[$j],
                                'new_nominal' => $nominal_baru[$j],
                                'created_on'   => date('Y-m-d',strtotime('now')),
                                'created_by'   => $sess_id
                                );
                                $this->db->insert('users_kenaikan_gaji_komponen', $data);
                            endfor;
                    }
                     $this->upload_attachment($rolling_id);

                     $user_app_lv1 = getValue('user_app_lv1', 'users_kenaikan_gaji', array('id'=>'where/'.$rolling_id));
                     $subject_email = get_form_no($rolling_id).'Pengajuan Permohonan Kenaikan Gaji';
                     $isi_email = get_name($user_id).' mengajukan Permohonan kenaikan gaji karyawan, untuk melihat detail silakan <a href='.base_url().'form_kenaikan_gaji/detail/'.$rolling_id.'>Klik Disini</a><br />';

                     if(!empty($user_app_lv1)):

                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email , $isi_email);
                        $this->approval->request('lv1', 'kenaikan_gaji', $rolling_id, $user_id, $this->detail_email($rolling_id));
                     else:
                        if(!empty(getEmail($this->approval->approver('kenaikan_gaji'))))$this->send_email(getEmail($this->approval->approver('kenaikan_gaji')), $subject_email, $isi_email);
                        $this->approval->request('hrd', 'kenaikan_gaji', $rolling_id, $user_id, $this->detail_email($rolling_id));
                       endif;
                     redirect('form_kenaikan_gaji', 'refresh');
                    //echo json_encode(array('st' =>1, 'rolling_url' => $rolling_url));    
                }
            }
        }
    }

    function upload_attachment($id)
    {
        $form = 'users_kenaikan_gaji';
        $user_id = getValue('created_by', $form, array('id' => 'where/'.$id));
        $user = getAll('users', array('id'=>'where/'.$user_id))->row();
        $user_folder = $user->id.$user->first_name;
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads', 0777);
        }
        if(!is_dir('./uploads/'.$user_folder)){
        mkdir('./uploads/'.$user_folder, 0777);
        }
        if(!is_dir("./uploads/$user_folder/sdm/")){
        mkdir("./uploads/$user_folder/sdm/", 0777);
        }


        $path = "./uploads/$user_folder/sdm/";
        $this->load->library('upload');
        $this->upload->initialize(array(
            "upload_path"=>$path,
            "overwrite" => TRUE,
            "allowed_types"=>"*"
        ));

        if($this->upload->do_multi_upload("userfile")){
            $up = $this->upload->get_multi_upload_data();
            $attachment = '';
            for($i=0;$i<sizeof($up);$i++):
                $koma = ($i<sizeof($up)-1)?',':'';
                $attachment .= $up[$i]['file_name'].$koma;
            endfor;
            $data = array(
                    'attachment' => $attachment,
                );
            $this->db->where('id', $id)->update('users_kenaikan_gaji', $data);
            return true;
        }
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

            $data = array(
            'is_app_'.$type => 1, 
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            
            $this->main->update($id,$data);
            
            redirect('form_kenaikan_gaji/detail/'.$id, 'refresh');
        }
    }

    function send_notif($id, $type){
        $user_id = sessNik();
        $is_app = 0;
        $approval_status = getValue('app_status_id_'.$type, 'users_kenaikan_gaji', array('id'=>'where/'.$id));
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $user_rolling_id = getValue('user_id', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
        $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan kenaikan gaji dari Atasan';
        $subject_email_request = get_form_no($id).'-Pengajuan Kenaikan Gaji Karyawan';
        $isi_email = 'Status kenaikan gaji anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_kenaikan_gaji/detail/'.$id.'>Klik Disini</a><br />';
        $isi_email_request = get_name($user_rolling_id).' mengajukan Permohonan kenaikan gaji, untuk melihat detail silakan <a href='.base_url().'form_kenaikan_gaji/detail/'.$id.'>Klik Disini</a><br />';
        
        $user_rolling_id = getValue('user_id', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
        
        if($is_app==0){
            $this->approval->approve('kenaikan_gaji', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_rolling_id)))$this->send_email(getEmail($user_rolling_id), $subject_email, $isi_email);
        }else{
            $this->approval->update_approve('kenaikan_gaji', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_rolling_id)))$this->send_email(getEmail($user_rolling_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Permohonan Mutasi dari Atasan', $isi_email);
        }

        if($type !== 'hrd' && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<6) ? getValue('user_app_'.$lv_app, 'users_kenaikan_gaji', array('id'=>'where/'.$id)):0;
           if(!empty($user_app)){
                $this->approval->request($lv_app, 'kenaikan_gaji', $id, $user_rolling_id, $this->detail_email($id));
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
            }else{
                $this->approval->request('hrd', 'kenaikan_gaji', $id, $user_rolling_id, $this->detail_email($id));
                if(!empty(getEmail($this->approval->approver('kenaikan_gaji', $user_id))))$this->send_email(getEmail($this->approval->approver('kenaikan_gaji', $user_id)), $subject_email_request, $isi_email_request);
            }
        }elseif($type == 'hrd' && $approval_status == 1){
            $this->send_user_notification($id, $user_rolling_id);
        }else{
            $email_body = "Status pengajuan permohonan kenaikan gaji yang diajukan oleh ".get_name($user_rolling_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_kenaikan_gaji/detail/'.$id.'>Klik Disini</a><br />';
            $form = 'kenaikan_gaji';
            switch($type){
            case 'lv1':
                $app_status = getValue('app_status_id_lv1', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kenaikan_gaji', array('is_deleted'=>1));
                //$this->approval->not_approve('spd_dalam', $id, )
            break;

            case 'lv2':
                $app_status = getValue('app_status_id_lv2', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kenaikan_gaji', array('is_deleted'=>1));
                $receiver_id = getValue('user_app_lv1', 'users_'.$form, array('id'=>'where/'.$id));
                $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
            break;

            case 'lv3':
                $app_status = getValue('app_status_id_lv3', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kenaikan_gaji', array('is_deleted'=>1));
                for($i=1;$i<3;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'lv4':
                $app_status = getValue('app_status_id_lv4', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kenaikan_gaji', array('is_deleted'=>1));
                for($i=1;$i<4;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'lv5':
                $app_status = getValue('app_status_id_lv5', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kenaikan_gaji', array('is_deleted'=>1));
                for($i=1;$i<5;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'hrd':
                for($i=1;$i<6;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;
            }
        }

        if($type == 'hrd' && $approval_status == 1){
            $this->send_notif_tambahan($id, 'kenaikan_gaji');
        }
    }

    function send_user_notification($id, $user_id)
    {
        $url = base_url().'form_kenaikan_gaji/detail/'.$id;
        $pengaju_id = $this->session->userdata('user_id');

        //Notif to karyawan
             $data4 = array(
                    'sender_id' => get_nik($pengaju_id),
                    'receiver_id' => get_nik($user_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan kenaikan gaji Karyawan',
                    'email_body' => get_name($pengaju_id).' mengajukan kenaikan gaji untuk Anda, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data4);
    }

    function detail_email($id)
    {
        return '';
    }

    function get_bu()
    {
            $url = get_api_key().'users/bu/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getbu = file_get_contents($url);
                $bu = json_decode($getbu, true);
                foreach ($bu as $row)
            {
                $result['-']= '- Pilih BU -';
                if($row['NUM'] != null){
                $result[$row['NUM']]= ucwords(strtolower($row['DESCRIPTION']));
                }
            }
                return $this->data['bu'] = $result;
            } else {
                return $this->data['bu'] = '';
            }
    }

    public function get_org($id)
    {
        $url = get_api_key().'users/org_from_bu/BUID/'.$id.'/format/json';
        //print_r($url);
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 foreach ($user_info as $row)
        {
            $result[$row['ID']]= ucwords(strtolower($row['DESCRIPTION']));
        }
        } else {
           $result['-']= '- Belum Ada Organization -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_org',$data);
    }

    function get_pos($id)
    {
        $url = get_api_key().'users/pos_from_org/ORGID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 foreach ($user_info as $row)
        {
            $result[$row['ID']]= ucwords(strtolower($row['DESCRIPTION']));
        }
        } else {
           $result['-']= '- Belum Ada Jabatan -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_pos',$data);
    }

    function get_emp_by_pos($posid)
    {
        
        $url = get_api_key().'users/employee_by_pos/POSID/'.$posid.'/format/json';
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

    public function get_emp_orgid()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $org_nm = $user_info['ORGID'];
            } else {
                $org_nm = '';
            }
        
        echo $org_nm;
    }

    public function get_emp_posid()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $pos_nm = $user_info['POSID'];
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

    public function get_emp_buid()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $bu_id = $user_info['BUID'];
            } else {
                $bu_id = '';
            }

        echo $bu_id;
    }

    public function get_emp_sendate()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $sen_date = dateIndo($user_info['SENIORITYDATE']);
            } else {
                $sen_date = '';
            }

        echo $sen_date;
    }
    function form_kenaikan_gaji_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
           
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_kenaikan_gaji = $this->data['form_kenaikan_gaji'] = $this->main->detail($id)->result();
        $komponen = $this->data['komponen'] = $this->main->detail_komponen($id);
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
        $title = $this->data['title'] = 'Form Pengajuan Kenaikan Gaji -'.get_name($user_id);
        $creator = getValue('created_by', 'users_kenaikan_gaji', array('id'=>'where/'.$id));
        $creator = get_nik($creator);
        $this->data['form_id'] = 'GAJI';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_kenaikan_gaji', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('rolling_pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            0, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_kenaikan_gaji/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('datatables.min.css');
                    
                }
                elseif(in_array($view, array('form_kenaikan_gaji/input')))
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
                    $this->template->add_js('form_kenaikan_gaji.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                     
                }elseif(in_array($view, array('form_kenaikan_gaji/detail',)))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');
                    
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
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
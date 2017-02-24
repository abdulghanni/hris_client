<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_kontrak extends MX_Controller {

    public $data;
    var $form_name = 'kontrak';

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');

        $this->load->database();
        $this->load->model('form_kontrak/form_kontrak_model','main');

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = ucfirst($this->form_name);
        $this->data['form_name'] = $this->form_name;

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
        $this->data['form'] = $this->form_name;
        $this->data['is_admin'] = is_admin(); 
        $this->_render_page('form_'.$this->form_name.'/index', $this->data);
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
            $row[] = $r->lama_kontrak;
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

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ftitle_post = (strlen($this->input->post('title')) > 0) ? strtolower(url_title($this->input->post('title'),'_')) : "" ;

            redirect('form_kontrak/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function input()
    {
        $this->data['title'] = "Input - Form kontrak";
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_spv($nik)&&!is_admin()){
            return show_error('Anda tidak dapat mengakses halaman ini.');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->data['lama'] = getAll('lama_kontrak', array('is_deleted' => 'where/0'));
            // $this->get_user_atasan();

            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_kontrak/input', $this->data);
        }
    }

    function detail($id, $lv = null)
    {
        $this->data['title'] = "Detail - Form kontrak";
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        $bu = get_user_buid($nik);
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_user_app_lv1($nik,$id,'users_kontrak')&&!is_user_app_lv2($nik,$id,'users_kontrak')&&!is_user_app_lv3($nik,$id,'users_kontrak')&&!is_admin()&&!is_hrd_cabang($bu)&&!is_hrd_pusat($nik,13)&&!is_user_logged($nik,$id,'users_kontrak')&&!is_creator($nik,$id,'users_kontrak')){
            return show_error('Anda tidak dapat mengakses halaman ini.');
        }else{
            $this->data['id'] = $id;
            $this->data['form'] = 'form_'.$this->form_name;
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);

            $this->data['row'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $lama_id = getValue('lama_kontrak', 'users_kontrak', array('id'=>'where/'.$id));
            $this->data['lama'] = getValue('title', 'lama_kontrak', array('id'=>'where/'.$lama_id));
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->data['user_id'] =$user_id = getValue('created_by', 'users_kontrak', array('id'=>'where/'.$id));
            $first_name = getValue('first_name', 'users', array('id'=>'where/'.$user_id));
            $this->data['user_folder'] = $user_id.$first_name.'/sdm/';
            $attachment = getValue('attachment', 'users_kontrak', array('id' => 'where/'.$id));
            $this->data['attachment'] = explode(",",$attachment);

            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
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
            //$this->form_validation->set_rules('alasan', 'Alasan kontrak', 'trim|required');
            $this->form_validation->set_rules('date_kontrak', 'Tanggal kontrak', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
                //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
                redirect('form_kontrak/input', 'refresh');
            }
            else
            {
                $user_id = $this->input->post('emp');
                $additional_data = array(
                    'date_kontrak'           => date('Y-m-d',strtotime($this->input->post('date_kontrak'))),
                    'lama_kontrak'  => $this->input->post('lama_kontrak'),
                    'alasan'           => $this->input->post('alasan'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                if ($this->form_validation->run() == true && $this->main->create_($user_id, $additional_data))
                {
                     $kontrak_id = $this->db->insert_id();
                     $this->upload_attachment($kontrak_id);
                     $user_app_lv1 = getValue('user_app_lv1', 'users_kontrak', array('id'=>'where/'.$kontrak_id));
                     $subject_email = get_form_no($kontrak_id).'Pengajuan Perpanjangan kontrak';
                     $isi_email = get_name($user_id).' mengajukan Perpanjangan kontrak, untuk melihat detail silakan <a href='.base_url().'form_kontrak/detail/'.$kontrak_id.'>Klik Disini</a><br />';

                     if(!empty($user_app_lv1)){
                        $this->approval->request('lv1', 'kontrak', $kontrak_id, $user_id, $this->detail_email($kontrak_id));
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                     }else{
                        $this->approval->request('hrd', 'kontrak', $kontrak_id, $user_id, $this->detail_email($kontrak_id));
                        if(!empty(getEmail($this->approval->approver('kontrak'))))$this->send_email(getEmail($this->approval->approver('kontrak')), $subject_email, $isi_email);
                     }
                     redirect('form_kontrak', 'refresh');
                    //echo json_encode(array('st' =>1, 'kontrak_url' => $kontrak_url));
                }
            }
        }
    }

    function upload_attachment($id)
    {
        $user_id = getValue('created_by', 'users_kontrak', array('id' => 'where/'.$id));
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
            $this->db->where('id', $id)->update('users_kontrak', $data);
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
            $approval_status = $this->input->post('app_status_'.$type);

            $is_app = getValue('is_app_'.$type, 'users_kontrak', array('id'=>'where/'.$id));
            $this->main->update($id,$data);

            

            redirect('form_kontrak/detail/'.$id, 'refresh');
        }
    }

    function send_notif($id, $type){
        $user_id = sessNik();
        $is_app = 0;
        $approval_status = getValue('app_status_id_'.$type, 'users_kontrak', array('id'=>'where/'.$id));
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $user_kontrak_id = getValue('user_id', 'users_kontrak', array('id'=>'where/'.$id));
        $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Perpanjangan Kontrak dari Atasan';
        $subject_email_request = get_form_no($id).'-Pengajuan kontrak Karyawan';
        $isi_email = 'Status pengajuan kontrak anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_kontrak/detail/'.$id.'>Klik Disini</a><br />';
        $isi_email_request = get_name($user_kontrak_id).' mengajukan Perpanjangan Kontrak, untuk melihat detail silakan <a href='.base_url().'form_kontrak/detail/'.$id.'>Klik Disini</a><br />';

        $user_kontrak_id = getValue('user_id', 'users_kontrak', array('id'=>'where/'.$id));
        if($is_app==0){
            $this->approval->approve('kontrak', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_kontrak_id)))$this->send_email(getEmail($user_kontrak_id), $subject_email, $isi_email);
        }else{
            $this->approval->update_approve('kontrak', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_kontrak_id)))$this->send_email(getEmail($user_kontrak_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Perpanjangan kontrak dari Atasan', $isi_email);
        }

        if($type !== 'hrd' && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_kontrak', array('id'=>'where/'.$id)):0;
            $user_app_lv3 = getValue('user_app_lv3', 'users_kontrak', array('id'=>'where/'.$id));
            if(!empty($user_app)){
                $this->approval->request($lv_app, 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
            }elseif(empty($user_app) && !empty($user_app_lv3) && $type == 'lv1'){
                if(!empty(getEmail($user_app_lv3)))$this->send_email(getEmail($user_app_lv3), $subject_email_request, $isi_email_request);
                $this->approval->request('lv3', 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
            }elseif(empty($user_app) && empty($user_app_lv3) && $type == 'lv1'){
                $this->approval->request('hrd', 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                if(!empty(getEmail($this->approval->approver('kontrak', $user_id))))$this->send_email(getEmail($this->approval->approver('kontrak', $user_id)), $subject_email_request, $isi_email_request);
            }elseif($type == 'lv3'){
                $this->approval->request('hrd', 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                if(!empty(getEmail($this->approval->approver('kontrak', $user_id))))$this->send_email(getEmail($this->approval->approver('kontrak', $user_id)), $subject_email_request, $isi_email_request);
            }elseif(empty($user_app_lv3) && $type == 'lv2'){
                $this->approval->request('hrd', 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                if(!empty(getEmail($this->approval->approver('kontrak', $user_id))))$this->send_email(getEmail($this->approval->approver('kontrak', $user_id)), $subject_email_request, $isi_email_request);
            }
        }elseif($type == 'hrd' && $approval_status == 1){
            $this->send_user_notification($id, $user_kontrak_id);
            // $this->send_notif_tambahan($id, $user_kontrak_id);
        }else{
            $email_body = "Status pengajuan Perpanjangan kontrak yang diajukan oleh ".get_name($user_kontrak_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_kontrak/detail/'.$id.'>Klik Disini</a><br />';
            $form = 'kontrak';
            switch($type){
            case 'lv1':
                $app_status = getValue('app_status_id_lv1', 'users_kontrak', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kontrak', array('is_deleted'=>1));
                //$this->approval->not_approve('kontrak', $id, )
            break;

            case 'lv2':
                $app_status = getValue('app_status_id_lv2', 'users_kontrak', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kontrak', array('is_deleted'=>1));
                $receiver_id = getValue('user_app_lv1', 'users_'.$form, array('id'=>'where/'.$id));
                $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
            break;

            case 'lv3':
                $app_status = getValue('app_status_id_lv3', 'users_kontrak', array('id'=>'where/'.$id));
                if($app_status == 2)$this->db->where('id', $id)->update('users_kontrak', array('is_deleted'=>1));
                for($i=1;$i<3;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'lv4':
                for($i=1;$i<4;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'lv5':
                for($i=1;$i<5;$i++):
                    $receiver = getValue('user_app_lv'.$i, 'users_'.$form, array('id'=>'where/'.$id));
                    if(!empty($receiver)):
                        $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                    endif;
                endfor;
            break;

            case 'hrd':
                for($i=1;$i<4;$i++):
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
            $this->send_notif_tambahan($id, 'kontrak');
        }
    }

    function send_user_notification($id, $user_id)
    {
        $url = base_url().'form_kontrak/detail/'.$id;
        $pengaju_id = $this->session->userdata('user_id');

        //Notif to karyawan
        $data4 = array(
                'sender_id' => get_nik($pengaju_id),
                'receiver_id' => get_nik($user_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan kontrak Karyawan',
                'email_body' => get_name($pengaju_id).' mengajukan kontrak untuk Anda, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data4);
    }

    function detail_email($id)
    {
        return '';
    }

    function form_kontrak_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

         $this->data['id'] = $id;
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = get_nik($sess_id);
        $form_kontrak = $this->data['form_kontrak'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
        $lama_id = getValue('lama_kontrak', 'users_kontrak', array('id'=>'where/'.$id));
        $this->data['lama'] = getValue('title', 'lama_kontrak', array('id'=>'where/'.$lama_id));
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['user_id'] =$user_id = getValue('created_by', 'users_kontrak', array('id'=>'where/'.$id));
        $first_name = getValue('first_name', 'users', array('id'=>'where/'.$user_id));
        $this->data['user_folder'] = $user_id.$first_name.'/sdm/';
        $attachment = getValue('attachment', 'users_kontrak', array('id' => 'where/'.$id));
        $this->data['attachment'] = explode(",",$attachment);
        $this->_render_page('form_kontrak/detail', $this->data);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('kontrak_pdf', $this->data, true);
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

    function get_lama_kontrak($user_id = null){
        if($user_id==null):$user_id = $this->input->post('id');$echo = 1;else:$echo = 0;endif;

        if($user_id==0){ echo '-';}else{
            $user_id = get_nik($user_id);
            $url = get_api_key().'kontrak/list/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404")
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                if($echo == 1){
                    echo $user_info[0]['MONTHOFTERM'].' Bulan';
                }else{
                    return $user_info[0]['MONTHOFTERM'].' Bulan';
                }
            } else {
                echo '-';
                return '-';
            }
        }
    }

    function get_mulai_kontrak($user_id = null){
        if($user_id==null):$user_id = $this->input->post('id');$echo = 1;else:$echo = 0;endif;

        if($user_id==0){ echo '-';}else{
            $user_id = get_nik($user_id);
            $url = get_api_key().'kontrak/list/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404")
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                if($echo == 1){
                echo dateIndo($user_info[0]['STARTDATE']);
                }else{
                return dateIndo($user_info[0]['STARTDATE']);
                }
            } else {
                echo '-';
                return '-';
            }
        }
    }

    function get_akhir_kontrak($user_id = null){
        if($user_id==null):$user_id = $this->input->post('id');$echo = 1;else:$echo = 0;endif;

        if($user_id==0){ echo '-';}else{
            $user_id = get_nik($user_id);
            $url = get_api_key().'kontrak/list/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404")
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                if($echo == 1){
                echo dateIndo($user_info[0]['ENDDATE']);
                }else{
                return dateIndo($user_info[0]['ENDDATE']);
                }
            } else {
                echo '-';
                return '-';
            }
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_kontrak/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');

                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('datatables.min.css');

                }elseif(in_array($view, array('form_kontrak/input')))
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
                    $this->template->add_js('form_kontrak_input.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    // $this->template->add_css('approval_img.css');

                }

                elseif(in_array($view, array('form_kontrak/detail',)))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    // $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    // $this->template->add_js('jquery.validate.min.js');
                    // $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    // $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_approval.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    // $this->template->add_css('plugins/select2/select2.css');
                    // $this->template->add_css('datepicker.css');
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

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_training_group extends MX_Controller {

    public $data;
    var $form_name = 'training_group';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_training_group/form_training_group_model','main');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = ucfirst('Pelatihan');
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
            $this->_render_page('form_training_group/index', $this->data);
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
           $delete = (($r->approval_status_id_lv1 == 0 && $r->created_by == sessId()) || is_admin()) ? '<button onclick="showModal('.$r->id.')" class="btn btn-sm btn-danger" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : '';

            //APPROVAL
            if(!empty($r->user_app_lv1)){
                $status1 = ($r->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Langsung'></i>";
            }
            if(!empty($r->user_app_lv2)){
                $status2 = ($r->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Tidak Langsung'></i>";
            }
            if(!empty($r->user_app_lv3)){
                $status3 = ($r->approval_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Lainnya'></i>";
            }
            


            $statushrd = ($r->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->nik.'</a>';
            $row[] = "<a href=$detail>".$r->username.'</a>';
            $row[] = $r->training_name;
            $row[] = word_limiter($r->tujuan_training, 5);
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

    function detail($id, $lv = null)
    {
        $this->data['title'] = 'Detail Training';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $user_id= getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
            $this->data['user_nik'] = $sess_nik = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);

            $this->data['user'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();

            $this->data['training_type'] = GetAll('training_type', array('is_deleted' => 'where/0'));
            $this->data['penyelenggara'] = GetAll('penyelenggara', array('is_deleted' => 'where/0'));
            $this->data['pembiayaan'] = GetAll('pembiayaan', array('is_deleted' => 'where/0'));
            //$this->data['ikatan'] = GetAll('training_ikatan_dinas', array('is_deleted' => 'where/0'));
            $this->data['waktu'] = GetAll('training_waktu', array('is_deleted' => 'where/0'));
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            if($lv != null){
                $this->data['row'] = $this->main->detail($id)->row();
                $app = $this->load->view('form_'.$this->form_name.'/'.$lv, $this->data, true);
                $note = $this->load->view('form_'.$this->form_name.'/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{

                $this->data['ikatan'] = $this->get_tipe_ikatan_dinas();
                $this->data['vendor'] = $this->get_vendor();

                $this->_render_page('form_'.$this->form_name.'/detail', $this->data);
            }
        }
    }

    function input()
    {
        $this->data['title'] = 'Input Training';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
       // $form_training_group = $this->data['training'] = $this->main->form_training_group($sess_id);

        $this->data['all_users'] = $this->ion_auth->where('id != ', 1)->order_by('users.username', 'asc')->users();//print_mz($this->data['all_users']->result());
        $this->data['users'] =  getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'))->result_array();
        $this->get_penerima_tugas();
        $this->get_penerima_tugas_satu_bu();
        // $this->get_user_atasan();

        $this->_render_page('form_training_group/input', $this->data);
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('training_name', 'Nama Program Pelatihan', 'trim|required');
            $this->form_validation->set_rules('tujuan_training', 'Tujuan Pelatihan', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
                redirect('form_training_group/input','refresh');
            }
            else
            {
                $user_id= $this->input->post('emp');
                $sess_id = $this->session->userdata('user_id');
                $data = array(
                    'user_peserta_id' => implode(',',$this->input->post('peserta')),
                    'id_comp_session' => 1,
                    'training_name' => $this->input->post('training_name'),
                    'tujuan_training' => $this->input->post('tujuan_training'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $sess_id,
                    );

                $peserta_id = implode(',',$this->input->post('peserta'));
                $peserta_id = explode(',',$peserta_id);
               
                    if ($this->form_validation->run() == true && $this->main->create_($user_id, $data))
                    {
                         $training_id = $this->db->insert_id();
                         $user_app_lv1 = getValue('user_app_lv1', 'users_training_group', array('id'=>'where/'.$training_id));
                         $subject_email = get_form_no($training_id).'-Pengajuan Permohonan Pelatihan(Group)';
                         $isi_email = get_name($user_id).' mengajukan Permohonan pelatihan, untuk melihat detail silakan <a href='.base_url().'form_training_group/detail/'.$training_id.'>Klik Disini</a><br />';
                         if($user_id!==$sess_id):
                         $this->approval->by_admin('training_group', $training_id, $sess_id, $user_id, $this->detail_email($training_id));
                         endif;
                         if(!empty($user_app_lv1)){
                            $this->approval->request('lv1', 'training_group', $training_id, $user_id, $this->detail_email($training_id));
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                         }else{
                            $this->approval->request('hrd', 'training_group', $training_id, $user_id, $this->detail_email($training_id));
                        if(!empty(getEmail($this->approval->approver('training'))))$this->send_email(getEmail($this->approval->approver('training')), $subject_email, $isi_email);
                         }   
                        $this->send_peserta_mail($training_id, $user_id, $peserta_id);
                        redirect('form_training_group', 'refresh'); 
                    }
            }

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

            if($type == 'hrd'){
                $data = array(
            'training_type_id' => $this->input->post('training_type'),
            'penyelenggara_id' => $this->input->post('penyelenggara'),
            'pembiayaan_id' => $this->input->post('pembiayaan'),
            'ikatan_dinas_id' => $this->input->post('ikatan'),
            'waktu_id' => $this->input->post('waktu'),
            'besar_biaya' => $this->input->post('besar_biaya'),
            'tempat' => $this->input->post('tempat'),
            'narasumber' => $this->input->post('narasumber'),
            'vendor' => $this->input->post('vendor'),
            'tanggal_mulai'=> date('Y-m-d',strtotime($this->input->post('tanggal_mulai'))),
            'tanggal_akhir'=> date('Y-m-d',strtotime($this->input->post('tanggal_akhir'))),
            'lama_training_bulan' => $this->input->post('lama_training_bulan'),
            'lama_training_hari' => $this->input->post('lama_training_hari'),
            'jam_mulai'   => $this->input->post('jam_mulai'),
            'jam_akhir'   => $this->input->post('jam_akhir'),
            'is_app_hrd' => 1,
            'approval_status_id_hrd' => $this->input->post('app_status'),
            'note_app_hrd' => $this->input->post('note_hrd'), 
            'user_app_hrd' => $user_id, 
            'date_app_hrd' => $date_now);

             $this->main->update($id,$data);
            }else{
                $data = array(
                'is_app_'.$type => 1,
                'approval_status_id_'.$type => $this->input->post('app_status_'.$type),
                'date_app_'.$type => $date_now,
                'note_app_'.$type => $this->input->post('note_'.$type)
                );
            }
                
           $this->main->update($id,$data);
        }
    }

    function send_notif($id, $type){
        $user_id = sessNik();
        $approval_status = getValue('approval_status_id_'.$type, 'users_training_group', array('id'=>'where/'.$id));
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $user_training_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
        $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Pelatihan(Group) dari Atasan';
        $subject_email_request = get_form_no($id).'-Pengajuan Pelatihan(Group) Karyawan';
        $isi_email = 'Status pengajuan training anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_training_group/detail/'.$id.'>Klik Disini</a><br />';
        $isi_email_request = get_name($user_training_id).' mengajukan Permohonan training, untuk melihat detail silakan <a href='.base_url().'form_training_group/detail/'.$id.'>Klik Disini</a><br />';
        $is_app = getValue('is_app_'.$type, 'users_training_group', array('id'=>'where/'.$id));
        if($is_app==0){
            $this->approval_mail($id, $approval_status);
            if(!empty(getEmail($user_training_id)))$this->send_email(getEmail($user_training_id), $subject_email, $isi_email);
        }else{
            $this->update_approval_mail($id, $approval_status);
            if(!empty(getEmail($user_training_id)))$this->send_email(getEmail($user_training_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Permohonan Training dari Atasan', $isi_email);
        }

        if($type !== 'hrd' && $approval_status == 1)
        {
            $pengaju_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_training_group', array('id'=>'where/'.$id)):0;
            if(!empty($user_app)){
                $this->approval->request($lv_app, 'training_group', $id, $pengaju_id, $this->detail_email($id));
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
            }else{
                $this->approval->request('hrd', 'training_group', $id, $pengaju_id, $this->detail_email($id));
                if(!empty(getEmail($this->approval->approver('training'))))$this->send_email(getEmail($this->approval->approver('training')), $subject_email_request, $isi_email_request);
            }
        }else{
            $email_body = "Status pengajuan permohonan Training yang diajukan oleh ".get_name($user_training_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_training_group/detail/'.$id.'>Klik Disini</a><br />';
            switch($type){
                case 'lv1':
                    $app_status = getValue('approval_status_id_lv1', 'users_training_group', array('id'=>'where/'.$id));
                    if($app_status == 2)$this->db->where('id', $id)->update('users_training_group', array('is_deleted'=>1));
                    //$this->approval->not_approve('training_group', $id, )
                break;

                case 'lv2':
                    $app_status = getValue('approval_status_id_lv2', 'users_training_group', array('id'=>'where/'.$id));
                    if($app_status == 2)$this->db->where('id', $id)->update('users_training_group', array('is_deleted'=>1));
                    $receiver_id = getValue('user_app_lv1', 'users_training_group', array('id'=>'where/'.$id));
                    $this->approval->not_approve('training_group', $id, $receiver_id, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
                break;

                case 'lv3':
                    $app_status = getValue('approval_status_id_lv3', 'users_training_group', array('id'=>'where/'.$id));
                    if($app_status == 2)$this->db->where('id', $id)->update('users_training_group', array('is_deleted'=>1));
                    $receiver_lv2 = getValue('user_app_lv2', 'users_training_group', array('id'=>'where/'.$id));
                    $this->approval->not_approve('training_group', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);

                    $receiver_lv1 = getValue('user_app_lv1', 'users_training_group', array('id'=>'where/'.$id));
                    $this->approval->not_approve('training_group', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
                break;

                case 'hrd':
                    $receiver_lv3 = getValue('user_app_lv3', 'users_training_group', array('id'=>'where/'.$id));
                    if(!empty($receiver_lv3)):
                        $this->approval->not_approve('training_group', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
                    endif;
                    $receiver_lv2 = getValue('user_app_lv2', 'users_training_group', array('id'=>'where/'.$id));
                    if(!empty($receiver_lv2)):
                        $this->approval->not_approve('training_group', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
                    endif;
                    $receiver_lv1 = getValue('user_app_lv1', 'users_training_group', array('id'=>'where/'.$id));
                    if(!empty($receiver_lv1)):
                        $this->approval->not_approve('training_group', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
                    endif;
                break;
            }
        }

        if($type == 'hrd' && $approval_status == 1){
            $this->send_notif_tambahan($id, 'training_group');
        }
    }

    function do_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'training_type_id' => $this->input->post('training_type'),
        'penyelenggara_id' => $this->input->post('penyelenggara'),
        'pembiayaan_id' => $this->input->post('pembiayaan'),
        'ikatan_dinas_id' => $this->input->post('ikatan'),
        'waktu_id' => $this->input->post('waktu'),
        'besar_biaya' => $this->input->post('besar_biaya'),
        'tempat' => $this->input->post('tempat'),
        'narasumber' => $this->input->post('narasumber'),
        'vendor' => $this->input->post('vendor'),
        'tanggal_mulai'=> date('Y-m-d',strtotime($this->input->post('tanggal_mulai'))),
        'tanggal_akhir'=> date('Y-m-d',strtotime($this->input->post('tanggal_akhir'))),
        'lama_training_bulan' => $this->input->post('lama_training_bulan'),
        'lama_training_hari' => $this->input->post('lama_training_hari'),
        'jam_mulai'   => $this->input->post('jam_mulai'),
        'jam_akhir'   => $this->input->post('jam_akhir'),
        'is_app_hrd' => 1,
        'approval_status_id_hrd' => $this->input->post('app_status'),
        'note_app_hrd' => $this->input->post('note_hrd'), 
        'user_app_hrd' => $user_id, 
        'date_app_hrd' => $date_now);

        $is_app = getValue('is_app_hrd', 'users_training_group', array('id'=>'where/'.$id));
        $approval_status = $this->input->post('app_status');

        $this->main->update($id,$data);
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $user_training_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
        $isi_email = 'Status pengajuan training anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_training_group/detail/'.$id.'>Klik Disini</a><br />';

        if($is_app==0){
            $this->approval_mail($id, $approval_status);
        }else{
            $this->update_approval_mail($id, $approval_status);
        }

        if(!empty(getEmail($user_training_id)))$this->send_email(getEmail($user_training_id), get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Permohonan training(Group) dari Atasan', $isi_email);
        
        if($approval_status == 1){
            $this->notif_legal($id);
        }else{
            $email_body = "Status pengajuan permohonan training yang diajukan oleh ".get_name($user_training_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_training_group/detail/'.$id.'>Klik Disini</a><br />';
            $receiver_lv3 = getValue('user_app_lv3', 'users_training_group', array('id'=>'where/'.$id));
            if(!empty($receiver_lv3)):
                $this->approval->not_approve('training_group', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                //if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
            endif;
            $receiver_lv2 = getValue('user_app_lv2', 'users_training_group', array('id'=>'where/'.$id));
            if(!empty($receiver_lv2)):
                $this->approval->not_approve('training_group', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
            endif;
            $receiver_lv1 = getValue('user_app_lv1', 'users_training_group', array('id'=>'where/'.$id));
            if(!empty($receiver_lv1)):
                $this->approval->not_approve('training_group', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
            //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan Training Dari Atasan', $email_body);
            endif;
        }
    }

    function notif_legal($id)
    {
        $admin_legal = $this->db->where('group_id',9)->get('users_groups')->result_array('user_id');
        $user_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
        $user_hrd = getValue('user_app_hrd', 'users_training_group', array('id'=>'where/'.$id));
        $msg = 'Dear Admin Legal,<br/><p>'.get_name($user_hrd).' telah menyetujui permintaan pelatihan yang diajukan oleh '.get_name($user_id).' ,untuk melihat detail silakan <a class="klikemail" href="'.base_url("form_training_group/detail/$id").'">Klik Disini</a></p>';
        for($i=0;$i<sizeof($admin_legal);$i++):
        $data = array(
                'sender_id' => get_nik($user_hrd),
                'receiver_id' => get_nik($admin_legal[$i]['user_id']),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Training Karyawan oleh HRD',
                'email_body' =>$msg.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
        if(!empty(getEmail(get_nik($admin_legal[$i]['user_id']))))$this->send_email(getEmail(get_nik($admin_legal[$i]['user_id'])), get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Training Karyawan oleh HRD', $msg);
        endfor;
    }

    function send_peserta_mail($id, $sender_id, $peserta_id = array())
    {
        $url = base_url().'form_training_group/detail';
        for($i=0;$i<sizeof($peserta_id);$i++):
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => get_nik($peserta_id[$i]),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Training Karyawan',
                'email_body' => get_name($sender_id).' mengajukan permohonan pelatihan group untuk anda, untuk melihat detail silakan <a class="klikmail" href='.$url.'/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
        endfor;
    }

    function approval_mail($id, $approval_status)
    {
        $url = base_url().'form_training_group/detail/'.$id;
        $approver = get_name($this->session->userdata('user_id'));
        $pengaju_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($pengaju_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Training Karyawan dari Atasan',
                'email_body' => "Status pengajuan permohonan training anda $approval_status oleh $approver untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function update_approval_mail($id, $approval_status)
    {
        $url = base_url().'form_training_group/detail/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $pengaju_id = getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($pengaju_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Training Karyawan dari Atasan',
                'email_body' => "$approver melakukan perubahan status permintaan training group anda, Status permintaan anda kini $approval_status, untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        return '';
    }

    function get_tipe_ikatan_dinas()
    {
        $url = get_api_key().'training/tipe_ikatan_dinas/format/json';
      
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_task_receiver = file_get_contents($url);
            $ikatan = json_decode($get_task_receiver, true);

            return $ikatan;
        }else{
            return false;
        }
    }

    function get_vendor()
    {
        $url = get_api_key().'training/vendor/format/json';
      
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_task_receiver = file_get_contents($url);
            $vendor = json_decode($get_task_receiver, true);
            
            return $vendor;
        } else {
           return false;
        }
    }

function get_penerima_tugas()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/bawahan_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas'] = 'Tidak ada karyawan dengan BU yang sama';
            }
    }

    function get_penerima_tugas_satu_bu()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/emp_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas_satu_bu'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas_satu_bu'] = 'Tidak ada karyawan dengan Bussiness Unit yang sama';
            }
    }

    function form_training_group_pdf($id)
    {
        $this->data['title'] = 'Detail Training';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $user_id= getValue('user_pengaju_id', 'users_training_group', array('id'=>'where/'.$id));
            $this->data['user_nik'] = $sess_nik = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);

            $form_training_group = $this->data['form_training_group'] = $this->main->detail($id)->result();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();

            $this->data['training_type'] = GetAll('training_type', array('is_deleted' => 'where/0'));
            $this->data['penyelenggara'] = GetAll('penyelenggara', array('is_deleted' => 'where/0'));
            $this->data['pembiayaan'] = GetAll('pembiayaan', array('is_deleted' => 'where/0'));
            //$this->data['ikatan'] = GetAll('training_ikatan_dinas', array('is_deleted' => 'where/0'));
            $this->data['waktu'] = GetAll('training_waktu', array('is_deleted' => 'where/0'));
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->data['ikatan'] = $this->get_tipe_ikatan_dinas();
            $this->data['vendor'] = $this->get_vendor();

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Training-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('training_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_training_group/index')))
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
                elseif(in_array($view, array('form_training_group/input')))
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
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_training_group_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                     
                }
                elseif(in_array($view, array('form_training_group/detail')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('jquery.maskMoney.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_training_group.js');
                    $this->template->add_js('form_approval.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
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
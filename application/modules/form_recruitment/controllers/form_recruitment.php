<?php defined('BASEPATH') OR recruitment('No direct script access allowed');

class Form_recruitment extends MX_Controller {

  public $data;
  var $form_name = 'recruitment';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_recruitment/recruitment_model', 'main');
    
        $this->lang->load('auth');
        $this->load->helper('language');
        
    }

    function index($ftitle = "fn:",$sort_by = "users_recruitment.id", $sort_order = "asc", $offset = 0)
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
        $this->data['form'] = 'recruitment';
        $this->data['is_admin'] = is_admin(); 
        $this->_render_page('form_recruitment/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->main->get_datatables($f);//lastq();//print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_recruitment/detail/".$r->id; 
           $print = base_url()."form_recruitment/recruitment_pdf/".$r->id; 
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
            $row[] = get_position_name($r->position_id);
            // $row[] = word_limiter($r->job_desc, 5);
            $row[] = dateIndo($r->created_on);
            $row[] = $status1;
            $row[] = $status2;
            $row[] = $status3;
            $row[] = $statushrd;
            $row[] = "<a class='btn btn-sm btn-primary' target='_blank' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
                      <a class='btn btn-sm btn-light-azure' target='_blank' href=$print title='Klik icon ini untuk mencetak form pengajuan'><i class='icon-print'></i></a>
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
        $this->data['title'] = 'Input Permintaan SDM Baru';
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        $bu = get_user_buid($nik);
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_spv($nik)&&!is_admin()&&!is_admin_bagian()){
            return show_error('Anda tidak dapat mengakses halaman ini.');
        }else{

            $this->data['jurusan'] = getAll('recruitment_jurusan', array('is_deleted' => 'where/0'));
            $this->data['ipk'] = getAll('ipk', array('is_deleted' => 'where/0'));
            $this->data['toefl'] = getAll('toefl', array('is_deleted' => 'where/0'));
            $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
            $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
            $this->data['jenis_kelamin'] = getAll('jenis_kelamin', array('is_deleted' => 'where/0'));
            $this->data['pendidikan'] = getAll('recruitment_pendidikan', array('is_deleted' => 'where/0'));
            $this->data['komputer'] = getAll('recruitment_komputer', array('is_deleted' => 'where/0'));
            $this->data['brevet'] = getAll('recruitment_brevet', array('is_deleted' => 'where/0'));
            $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->get_bu();
            //$this->get_user_atasan();

            $this->_render_page('form_recruitment/input', $this->data);
        }
    }

    function add()
    {
       if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
            /*$this->form_validation->set_rules('bu', 'Unit Bisnis', 'trim|required');
            $this->form_validation->set_rules('parent_org', 'Departement', 'trim|required');
            $this->form_validation->set_rules('org', 'Bagian', 'trim|required');
            $this->form_validation->set_rules('pos', 'Posisi', 'trim|required');
            */
            $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
            //$this->form_validation->set_rules('urgensi', 'Kebutuhan / Urgensi', 'trim|required');
            //$this->form_validation->set_rules('jnskelamin', 'Jenis Kelamin', 'trim|required');
            //$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
            //$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required');
            //$this->form_validation->set_rules('ipk', 'IPK', 'trim|required');
            /*$this->form_validation->set_rules('toefl', 'TOEFL', 'trim');
            $this->form_validation->set_rules('komputer', 'Komputer', 'trim');
            $this->form_validation->set_rules('komunikasi', 'Koumikasi', 'trim');
            $this->form_validation->set_rules('grafika', 'Grafika', 'trim');
            $this->form_validation->set_rules('desain', 'Desain', 'trim');
            $this->form_validation->set_rules('brevet', 'Brevet', 'trim');
            $this->form_validation->set_rules('lain_lain', 'Lain-Lain', 'trim');
            $this->form_validation->set_rules('portofolio', 'Portofolio', 'trim');
            $this->form_validation->set_rules('pengalaman', 'pengalaman', 'trim');
            $this->form_validation->set_rules('lama_pengalaman', 'lama_pengalaman', 'trim');
            $this->form_validation->set_rules('job_desc', 'Job Desc', 'trim');
            */
            if($this->form_validation->run() == FALSE)
            {
                //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
                redirect('form_recruitment/input', 'refresh');
            }
            else
            {
                $user_id = $this->session->userdata('user_id');
                $data1 = array(
                    'id_comp_session' => 1,
                    'user_id'       => $user_id,
                    'bu_id'       => $this->input->post('bu'),
                    'organization_id'     => $this->input->post('org'),
                    'position_id'           => $this->input->post('pos'),
                    'jumlah'           => $this->input->post('jumlah'),
                    'status_id'           => $this->input->post('status'),
                    'urgensi_id'           => $this->input->post('urgensi'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'user_app_lv4'          => $this->input->post('atasan4'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $this->db->insert('users_recruitment', $data1);
                $recruitment_id = $this->db->insert_id();

                $data2 = array(
                    'jenis_kelamin_id' => implode(',',$this->input->post('jenis_kelamin')),
                    'pendidikan_id' => implode(',',$this->input->post('pendidikan')),
                    'jurusan' => $this->input->post('jurusan'),
                    'ipk' => $this->input->post('ipk'),
                    'toefl' => $this->input->post('toefl'),
                    'user_recruitment_id' => $recruitment_id,
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $this->db->insert('users_recruitment_kualifikasi', $data2);
                $komputer = $this->input->post('komputer');
                $komputer = (!empty($komputer)) ? implode(',',$this->input->post('komputer')) : '';
                $data3 = array(
                        'user_recruitment_id' => $recruitment_id,
                        'komputer' => $komputer,
                        'bahasa_pemrograman' => $this->input->post('pemrograman'),
                        'komunikasi' => $this->input->post('komunikasi'),
                        'grafika' => $this->input->post('grafika'),
                        'desain' => $this->input->post('desain'),
                        'brevet_id' => $this->input->post('brevet'),
                        'lain_lain' => $this->input->post('lain-lain'),
                        'portofolio' => $this->input->post('portofolio'),
                        'pengalaman' => $this->input->post('pengalaman'),
                        'lama_Pengalaman' => $this->input->post('lama_pengalaman'),
                        'job_desc' => $this->input->post('job_desc'),
                        'note_pengaju' => $this->input->post('note_pengaju'),
                        'created_on'            => date('Y-m-d',strtotime('now')),
                        'created_by'            => $this->session->userdata('user_id')
                    );
                
                    $this->db->insert('users_recruitment_kemampuan', $data3);

                     $user_app_lv1 = getValue('user_app_lv1', 'users_recruitment', array('id'=>'where/'.$recruitment_id));
                     $subject_email = get_form_no($recruitment_id).'Pengajuan Permintaan SDM';
                     $isi_email = get_name($user_id).' mengajukan Permohonan Permintaan SDM, untuk melihat detail silakan <a href='.base_url().'form_recruitment/detail/'.$recruitment_id.'>Klik Disini</a><br />';

                     if(!empty($user_app_lv1)):
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                        $this->approval->request('lv1', 'recruitment', $recruitment_id, $user_id, $this->detail_email($recruitment_id));
                     else:
                        if(!empty(getEmail($this->approval->approver('recruitment'))))$this->send_email(getEmail($this->approval->approver('recruitment')), $subject_email, $isi_email);
                        $this->approval->request('hrd', 'recruitment', $recruitment_id, $user_id, $this->detail_email($recruitment_id));
                     endif;
                     redirect('form_recruitment','refresh');
                    //echo json_encode(array('st' =>1, 'recruitment_url' => $recruitment_url));    
                
            } 
    }
    
    function detail($id, $lv=null)
    { 
        $this->data['title'] = 'Detail Permintaan SDM Baru';
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        $bu = get_user_buid($nik);
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif(!is_user_app_lv1($nik,$id,'users_recruitment')&&!is_user_app_lv2($nik,$id,'users_recruitment')&&!is_user_app_lv3($nik,$id,'users_recruitment')&&!is_user_app_lv4($nik,$id,'users_recruitment')&&!is_creator($nik,$id,'users_recruitment')&&!is_admin()&&!is_admin_bagian()&&!is_hrd_cabang($bu)&&!is_hrd_pusat($nik,9)&&!is_cc_notif($nik,$bu,9)){
            return show_error('Anda tidak dapat mengakses halaman ini.');
        }else{
            $this->data['id'] = $id;
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $this->data['row'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
            $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
            $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
            $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
            $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
            $this->data['jenis_kelamin'] = getAll('jenis_kelamin');
            $this->data['pendidikan'] = getAll('recruitment_pendidikan');
            $this->data['komputer'] = getAll('recruitment_komputer');
            $this->data['position_pengaju'] = $this->get_user_position(getValue('user_id', 'users_recruitment', array('id'=>'where/'.$id)));
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
             $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            if($lv != null){
                $app = $this->load->view('form_recruitment/'.$lv, $this->data, true);
                $note = $this->load->view('form_recruitment/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{
                $this->_render_page('form_recruitment/detail', $this->data);
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

            $data = array(
            'is_app_'.$type => 1, 
            'approval_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $this->main->update($id,$data);

            redirect('form_recruitment/approval/'.$id, 'refresh');
        }
    }

    function send_notif($id, $type)
    {
        $user_id = sessNik();
        $approval_status = getValue('approval_status_id_'.$type, 'users_recruitment', array('id'=>'where/'.$id));
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $user_recruitment_id = getValue('user_id', 'users_recruitment', array('id'=>'where/'.$id));
            $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Permohonan Permintaan SDM dari Atasan';
            $subject_email_request = get_form_no($id).'Pengajuan Permintaan SDM';
            $isi_email = 'Status pengajuan permintaan SDM anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_recruitment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_recruitment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
            $isi_email_request = get_name($user_recruitment_id).' mengajukan Permohonan permintaan SDM, untuk melihat detail silakan <a href='.base_url().'form_recruitment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_recruitment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
            $is_app = getValue('is_app_'.$type, 'users_recruitment', array('id'=>'where/'.$id));
           if($is_app==0){
                $this->approval->approve('recruitment', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_recruitment_id)))$this->send_email(getEmail($user_recruitment_id), $subject_email, $isi_email);
            }else{
                $this->approval->update_approve('recruitment', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_recruitment_id)))$this->send_email(getEmail($user_recruitment_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Permohonan Permintaan SDM dari Atasan', $isi_email);
            }
            if($type != 'hrd' && $approval_status == 1){
                $lv = substr($type, -1)+1;
                $lv_app = 'lv'.$lv;
                $user_app = ($lv<5) ? getValue('user_app_'.$lv_app, 'users_recruitment', array('id'=>'where/'.$id)):0;
                $user_app_lv3 = getValue('user_app_lv3', 'users_recruitment', array('id'=>'where/'.$id));
                if(!empty($user_app)){
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app),  $subject_email_request , $isi_email_request);
                    $this->approval->request($lv_app, 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                }else{
                    $this->approval->request('hrd', 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('recruitment', $user_id))))$this->send_email(getEmail($this->approval->approver('recruitment', $user_id)), $subject_email_request, $isi_email_request);
                }
                /*elseif(empty($user_app) && !empty($user_app_lv3) && $type == 'lv1'):
                    if(!empty(getEmail($user_app_lv3)))$this->send_email(getEmail($user_app_lv3), $subject_email_request, $isi_email_request);
                    $this->approval->request('lv3', 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                elseif(empty($user_app) && empty($user_app_lv3) && $type == 'lv1'):
                    if(!empty(getEmail($this->approval->approver('recruitment', $user_id))))$this->send_email(getEmail($this->approval->approver('recruitment', $user_id)),  $subject_email_request , $isi_email_request);
                    $this->approval->request('hrd', 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                elseif($type == 'lv3'):
                    if(!empty(getEmail($this->approval->approver('recruitment', $user_id))))$this->send_email(getEmail($this->approval->approver('recruitment', $user_id)),  $subject_email_request , $isi_email_request);
                    $this->approval->request('hrd', 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                elseif(empty($user_app_lv3) && $type == 'lv2'):
                    $this->approval->request('hrd', 'recruitment', $id, $user_recruitment_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('recruitment', $user_id))))$this->send_email(getEmail($this->approval->approver('recruitment', $user_id)), $subject_email_request, $isi_email_request);
                endif;*/
            }else{
                $email_body = "Status pengajuan permohonan recruitment yang diajukan oleh ".get_name($user_recruitment_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_recruitment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_recruitment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
                switch($type){
                    case 'lv1':
                        $app_status = getValue('approval_status_id_lv1', 'users_recruitment', array('id'=>'where/'.$id));
                        if($app_status == 2)$this->db->where('id', $id)->update('users_recruitment', array('is_deleted'=>1));
                        //$this->approval->not_approve('recruitment', $id, )
                    break;

                    case 'lv2':
                        $app_status = getValue('approval_status_id_lv2', 'users_recruitment', array('id'=>'where/'.$id));
                        if($app_status == 2)$this->db->where('id', $id)->update('users_recruitment', array('is_deleted'=>1));
                        $receiver_id = getValue('user_app_lv1', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_id, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                    break;

                    case 'lv3':
                        $app_status = getValue('approval_status_id_lv3', 'users_recruitment', array('id'=>'where/'.$id));
                        if($app_status == 2)$this->db->where('id', $id)->update('users_recruitment', array('is_deleted'=>1));
                        $receiver_lv2 = getValue('user_app_lv2', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);

                        $receiver_lv1 = getValue('user_app_lv1', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                    break;

                    case 'lv4':
                        $app_status = getValue('approval_status_id_lv4', 'users_recruitment', array('id'=>'where/'.$id));
                        if($app_status == 2)$this->db->where('id', $id)->update('users_recruitment', array('is_deleted'=>1));
                        $receiver_lv3 = getValue('user_app_lv3', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);

                        $receiver_lv2 = getValue('user_app_lv2', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);

                        $receiver_lv1 = getValue('user_app_lv1', 'users_recruitment', array('id'=>'where/'.$id));
                        $this->approval->not_approve('recruitment', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                    break;

                    case 'hrd':
                        $receiver_lv4 = getValue('user_app_lv4', 'users_recruitment', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv4)):
                            $this->approval->not_approve('recruitment', $id, $receiver_lv4, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                        endif;
                        $receiver_lv3 = getValue('user_app_lv3', 'users_recruitment', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv3)):
                            $this->approval->not_approve('recruitment', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                        endif;
                        $receiver_lv2 = getValue('user_app_lv2', 'users_recruitment', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv2)):
                            $this->approval->not_approve('recruitment', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                        endif;
                        $receiver_lv1 = getValue('user_app_lv1', 'users_recruitment', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv1)):
                            $this->approval->not_approve('recruitment', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan recruitment Dari Atasan', $email_body);
                        endif;
                    break;
                }
            }

            if($type == 'hrd' && $approval_status == 1){
                $this->send_notif_tambahan($id, 'recruitment');
            }
    }
    function send_notif_tambahan($id)
    {
        $url = base_url().'form_recruitment/detail/'.$id;
        $user_id = getValue('user_id', 'users_recruitment', array('id'=>'where/'.$id));
        $receiver = getValue('user_nik', 'users_notif_tambahan', array('form_type_id'=>'where/9'));
        $subject_email = 'Permintaan SDM Baru';
        $isi_email = 'HRD telah menyetujui pengajuan Permintaan SDM Baru oleh '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_recruitment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
        //Notif to karyawan
        if(!empty($receiver)){
            $data4 = array(
                    'sender_id' => get_nik(sessId()),
                    'receiver_id' => $receiver,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => $subject_email,
                    'email_body' => $isi_email,
                    'is_read' => 0,
                );
            $this->db->insert('email', $data4);
            if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), $subject_email, $isi_email);
        }
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
            $result['']= '- Pilih BU -';
            if($row['NUM'] != null){
            $result[$row['NUM']]= ucwords(strtolower($row['DESCRIPTION']));
            }
        }
            return $this->data['bu'] = $result;
        } else {
            return $this->data['bu'] = '';
        }
    }

    public function get_parent_org($id)
    {
        $url = get_api_key().'users/parent_org_from_bu/BUID/'.$id.'/format/json';
        //print_r($url);
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 foreach ($user_info as $row)
                {
                    $result[$row['PARENT_ID'].','.$row['ID']]= ucwords(strtolower($row['DESCRIPTION']));
                }
            } else {
               $result['']= '- Belum Ada Departement -';
            }
        $data['result']=$user_info;
        $this->load->view('dropdown_parent_org',$data);
    }

    public function get_org($id)
    {
        //$url = get_api_key().'users/org_from_parent_org/ORGID/'.$id.'/format/json';
        $url = get_api_key().'users/org_from_bu/BUID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 foreach ($user_info as $row)
        {
            $result[$row['ID']]= $row['DESCRIPTION'];
        }
        } else {
           $result['']= '- Belum Ada Bagian -';
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
           $result['']= '- Belum Ada Jabatan -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_pos',$data);
    }
    
    function get_user_position($user_id)
    {
            $url = get_api_key().'users/employement/EMPLID/'.get_nik($user_id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['POSITION'];
            } else {
                return '-';
            }
    }

    function recruitment_pdf($id)
    {
        $this->data['title'] = 'Detail Permintaan SDM Baru';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['id'] = $id;
        $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
        $this->data['recruitment'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
        $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
        $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
        $this->data['jenis_kelamin'] = getAll('jenis_kelamin');
        $this->data['pendidikan'] = getAll('recruitment_pendidikan');
        $this->data['komputer'] = getAll('recruitment_pendidikan');
        $this->data['position_pengaju'] = $this->get_user_position(getValue('user_id', 'users_recruitment', array('id'=>'where/'.$id)));
        $user_id =getValue('user_id', 'users_recruitment', array('id'=>'where/'.$id));
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $title = $this->data['title'] = 'Form Permintaan SDM Baru-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('recruitment_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->AddPage('p', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            0, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_recruitment/index')))
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
                elseif(in_array($view, array('form_recruitment/input')))
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
                    $this->template->add_js('form_recruitment.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                     
                }elseif(in_array($view, array('form_recruitment/detail')))
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

    function add_jurusan(){
        $data = array(
                'title'=> $this->input->post('nama-jurusan'),
                'created_by'=> sessId(),
                'created_on'=> date('Y-m-d',strtotime('now')),
            );
        $this->db->insert('recruitment_jurusan', $data);
        $this->data['jurusan'] = getAll('recruitment_jurusan', array('is_deleted' => 'where/0'));
        $this->load->view('form_recruitment/jurusan', $this->data);
    }
}   
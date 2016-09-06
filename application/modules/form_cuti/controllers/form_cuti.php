<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_cuti extends MX_Controller {

    public $data;
    var $form_name = 'cuti';

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->library('approval');

        $this->load->database();
        $this->load->model('form_cuti/form_cuti_model','cuti');

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index()
    {
        $this->data['title'] = ucfirst($this->form_name);
        $this->data['form_name'] = $this->form_name;
        $this->data['form'] = $this->form_name;
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
        $this->_render_page('form_cuti/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->cuti->get_datatables($f);
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
            $row[] = dateIndo($r->date_mulai_cuti);
            $row[] = $r->alasan_cuti;
            $row[] = $r->jumlah_hari;
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
                        "recordsTotal" => $this->cuti->count_all($f),
                        "recordsFiltered" => $this->cuti->count_filtered($f),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function input()
    {
         $this->data['title'] = 'Input - Cuti';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $user_id = $this->session->userdata('user_id');
            $user_nik = get_nik($user_id);

            $this->data['sisa_cuti'] = $this->get_sisa_cuti($user_nik);
            if(is_admin()){
                $u = $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
                foreach ($u->result_array() as $row)
                {
                    $result[$row['id']]= ucwords(strtolower($row['username']));
                }
                $this->data['users']=$result;
            }

            // form cuti yang akan diambil
            $this->data['alasan_cuti'] = $this->get_type_cuti();

            $this->_render_page('form_cuti/input', $this->data);
        }
    }

    public function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('start_cuti', 'Tanggal Mulai Cuti', 'trim|required');
        $this->form_validation->set_rules('end_cuti', 'Tanggal Terakhir Cuti', 'trim|required');
        $this->form_validation->set_rules('alasan_cuti', 'Alasan Cuti', 'trim|required');
        $this->form_validation->set_rules('user_pengganti', 'User Pengganti', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Cuti', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            redirect('form_cuti/input', 'refresh');
        }
        else
        {
            $user_id = $this->input->post('emp');
            $user_nik = get_nik($user_id);
            $sess_id = $this->session->userdata('user_id');
            $start_cuti = $this->input->post('start_cuti');
            $end_cuti = $this->input->post('end_cuti');
            $jumlah_hari = $this->input->post('jml_cuti');
            $plafon_cuti = $this->input->post('num_leave');
            $potong_cuti = $jumlah_hari - $plafon_cuti;
            $potong_cuti = ($potong_cuti>0) ? $potong_cuti : 0;

            $filter = array('date_mulai_cuti'=>'where/'.date('Y-m-d', strtotime($this->input->post('start_cuti'))), 'date_selesai_cuti'=>'where/'.date('Y-m-d', strtotime($this->input->post('end_cuti'))), 'user_id'=>'where/'.$user_id, 'alasan_cuti_id' => 'where/'.$this->input->post('alasan_cuti'), 'remarks' => 'where/'.$this->input->post('remarks'));
            $num_rows = getAll('users_cuti', $filter)->num_rows();
            $additional_data = array(
                'id_comp_session'       => date('Y'),
                'date_mulai_cuti'       => date('Y-m-d', strtotime($this->input->post('start_cuti'))),
                'date_selesai_cuti'     => date('Y-m-d', strtotime($this->input->post('end_cuti'))),
                'jumlah_hari'           => $jumlah_hari,
                'sisa_cuti'             => $this->input->post('sisa_cuti'),
                'potong_cuti'           => $potong_cuti,
                'alasan_cuti_id'        => $this->input->post('alasan_cuti'),
                'remarks'               => $this->input->post('remarks'),
                'user_pengganti'        => $this->input->post('user_pengganti'),
                'contact'               => $this->input->post('contact'),
                'alamat_cuti'           => $this->input->post('alamat'),
                'user_app_lv1'          => $this->input->post('atasan1'),
                'user_app_lv2'          => $this->input->post('atasan2'),
                'user_app_lv3'          => $this->input->post('atasan3'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $sess_id,
                'is_deleted'            => 0
            );

            if ($this->form_validation->run() == true)
            {
                if($num_rows < 1):
                     $this->cuti->create_($user_id,$additional_data);
                     $cuti_id = $this->db->insert_id();
                     $this->upload_attachment($cuti_id);
                     $leave_request_id = $this->get_last_leave_request_id();
                     $user_app_lv1 = getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$cuti_id));
                     $subject_email = get_form_no($cuti_id).'-Pengajuan Permohonan Cuti';
                     $isi_email = get_name($user_id).' mengajukan Permohonan Cuti, untuk melihat detail silakan <a href='.base_url().'form_cuti/detail/'.$cuti_id.'>Klik Disini</a><br />';
                     if($user_id!==$sess_id):
                        $this->approval->by_admin('cuti', $cuti_id, $sess_id, $user_id, $this->detail_email($cuti_id));
                     endif;
                     if(!empty($user_app_lv1)){
                        $this->approval->request('lv1', 'cuti', $cuti_id, $user_id, $this->detail_email($cuti_id));
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                     }else{
                        $this->approval->request('hrd', 'cuti', $cuti_id, $user_id, $this->detail_email($cuti_id));
                        if(!empty(getEmail($this->approval->approver('cuti', $user_nik))))$this->send_email(getEmail($this->approval->approver('cuti', $user_nik)), $subject_email, $isi_email);
                     }

                     if($this->input->post('insert') == 1)
                     {
                        $this->insert_sisa_cuti($user_nik, $this->input->post('alasan_cuti'));
                     }

                     $this->insert_leave_request($user_id, $additional_data, $leave_request_id);
                else:
                    $id = getValue('id', 'users_cuti', $filter);
                    $this->db->where('id', $id)->update('users_cuti', array('is_deleted'=>0));
                endif;
                redirect('form_cuti', 'refresh');
            }
        }
    }

    function upload_attachment($id){
        $sess_id = $this->session->userdata('user_id');
            $user_folder = get_nik($sess_id);
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads/', 0777);
        }
        if(!is_dir('./uploads/cuti/')){
        mkdir('./uploads/cuti/', 0777);
        }
        if(!is_dir('./uploads/cuti/'.$user_folder)){
        mkdir('./uploads/cuti/'.$user_folder, 0777);
        }

        $config =  array(
          'upload_path'     => './uploads/cuti/'.$user_folder,
          'allowed_types'   => '*',
          'overwrite'       => TRUE,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('attachment')){
            //print_r($this->upload->display_errors());
         }else{
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];
            $data = array('attachment'=>$image_name);
            $this->db->where('id', $id)->update('users_cuti', $data);
        }
        //print_r($this->db->last_query());
    }

    function detail($id, $lv = null)
    {
        $this->data['title'] = 'Detail - Cuti';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['id'] = $id;
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
        $this->data['user_id'] = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($this->data['user_id']);
        $this->data['user'] = $this->cuti->detail($id)->row();
        $this->data['_num_rows'] = $this->cuti->detail($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['approved'] = assets_url('img/approved_stamp.png');
        $this->data['rejected'] = assets_url('img/rejected_stamp.png');
        $this->data['pending'] = assets_url('img/pending_stamp.png');
        if($lv != null){
            $app = $this->load->view('form_cuti/'.$lv, $this->data, true);
            $note = $this->load->view('form_cuti/note', $this->data, true);
            echo json_encode(array('app'=>$app, 'note'=>$note));
        }else{
            $this->_render_page('form_cuti/detail', $this->data);
        }
    }

    function form_cuti_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }


        $this->data['id'] = $id;
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
        $this->data['user_id'] = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($this->data['user_id']);
        $this->data['form_cuti'] = $this->cuti->detail($id)->result();
        $this->data['_num_rows'] = $this->cuti->detail($id)->num_rows();
        $title = $this->data['title'] = 'Form Cuti-'.get_name($user_id);

        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('cuti_pdf', $this->data, true);
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_cuti/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    //$this->template->add_js('select2.min.js');

                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    // $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datatables.min.css');

                }
                elseif(in_array($view, array('form_cuti/input')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('jquery.validate.min.js');

                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_cuti_input.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');

                }elseif(in_array($view, array('form_cuti/detail')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('bootstrap-datepicker.js');
                    //$this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_cuti_approval.js');
                    $this->template->add_js('emp_dropdown.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('approval_img.css');
                    $this->template->add_css('datepicker.css');

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
            'date_mulai_cuti'       => date('Y-m-d', strtotime($this->input->post('start_cuti'))),
            'date_selesai_cuti'     => date('Y-m-d', strtotime($this->input->post('end_cuti'))),
            'jumlah_hari'           => $this->input->post('jml_hari'),
            'is_app_'.$type => 1,
            'approval_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id,
            'date_app_'.$type => $date_now,
            'note_app_'.$type => $this->input->post('note_'.$type)
            );

            $is_app = getValue('is_app_'.$type, 'users_cuti', array('id'=>'where/'.$id));
            $approval_status = $this->input->post('app_status_'.$type);
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $this->cuti->update($id,$data);
        }
    }

    function send_notif($id, $type){
        $approval_status = getValue('approval_status_id_'.$type, 'users_cuti', array('id'=>'where/'.$id));
        $user_cuti_id = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));

            $subject_email = get_form_no($id).'-['.$approval_status_mail.']Status Pengajuan Permohonan Cuti dari Atasan';
            $subject_email_request = get_form_no($id).'Pengajuan Permohonan Cuti';
            $isi_email = 'Status pengajuan cuti anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_cuti/detail/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_cuti_id).' mengajukan Permohonan Cuti, untuk melihat detail silakan <a href='.base_url().'form_cuti/detail/'.$id.'>Klik Disini</a><br />';

            if($is_app==0){
                $this->approval->approve('cuti', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_cuti_id)))$this->send_email(getEmail($user_cuti_id), $subject_email , $isi_email);
            }else{
                $this->approval->update_approve('cuti', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_cuti_id)))$this->send_email(getEmail($user_cuti_id), get_form_no($id).'-['.$approval_status_mail.']'.'Perubahan Status Pengajuan Permohonan Cuti dari Atasan', $isi_email);
            }
            if($type !== 'hrd' && $approval_status == 1){
                $lv = substr($type, -1)+1;
                $lv_app = 'lv'.$lv;
                $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_cuti', array('id'=>'where/'.$id)):0;
                $user_app_lv3 = getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id));
                if(!empty($user_app)){
                    $this->approval->request($lv_app, 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                }elseif(empty($user_app) && !empty($user_app_lv3) && $type == 'lv1'){
                    if(!empty(getEmail($user_app_lv3)))$this->send_email(getEmail($user_app_lv3), $subject_email_request, $isi_email_request);
                    $this->approval->request('lv3', 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                }elseif(empty($user_app) && empty($user_app_lv3) && $type == 'lv1'){
                    $this->approval->request('hrd', 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('cuti', $user_id))))$this->send_email(getEmail($this->approval->approver('cuti', $user_id)), $subject_email_request, $isi_email_request);
                }elseif($type == 'lv3'){
                    $this->approval->request('hrd', 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('cuti', $user_id))))$this->send_email(getEmail($this->approval->approver('cuti', $user_id)), $subject_email_request, $isi_email_request);
                }elseif(empty($user_app_lv3) && $type == 'lv2'){
                    $this->approval->request('hrd', 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('cuti', $user_id))))$this->send_email(getEmail($this->approval->approver('cuti', $user_id)), $subject_email_request, $isi_email_request);
                }
            }else{
                $email_body = "Status pengajuan permohonan cuti yang diajukan oleh ".get_name($user_cuti_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_cuti/detail/'.$id.'>Klik Disini</a><br />';
                switch($type){
                    case 'lv1':
                        //$this->approval->not_approve('cuti', $id, )
                    break;

                    case 'lv2':
                        $receiver_id = getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id));
                        $this->approval->not_approve('cuti', $id, $receiver_id, $approval_status ,$this->detail_email($id));
                        if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), $subject_email, $email_body);
                    break;

                    case 'lv3':
                        $receiver_lv2 = getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id));
                        $this->approval->not_approve('cuti', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                        if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), $subject_email, $email_body);

                        $receiver_lv1 = getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id));
                        $this->approval->not_approve('cuti', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                        if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), $subject_email, $email_body);
                    break;

                    // case 'hrd':
                    //     $receiver_lv3 = getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id));
                    //     if(!empty($receiver_lv3)):
                    //         $this->approval->not_approve('cuti', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                    //         if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), $subject_email, $email_body);
                    //     endif;
                    //     $receiver_lv2 = getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id));
                    //     if(!empty($receiver_lv2)):
                    //         $this->approval->not_approve('cuti', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                    //         if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), $subject_email, $email_body);
                    //     endif;
                    //     $receiver_lv1 = getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id));
                    //     if(!empty($receiver_lv1)):
                    //         $this->approval->not_approve('cuti', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                    //     if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), $subject_email, $email_body);
                    //     endif;
                    // break;
                }
            }

            if($type == 'hrd' && $approval_status == 1){
                //$this->send_notif_tambahan($id);
            }

            $this->cek_all_approval($id);
    }

    function send_notif_tambahan($id)
    {
        $url = base_url().'form_cuti/detail/'.$id;
        $user_id = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $receiver = getValue('user_nik', 'users_notif_tambahan', array('form_type_id'=>'where/1'));
        $subject_email = 'Pengajuan cuti Karyawan';
        $isi_email = 'HRD telah menyetujui pengajuan cuti oleh '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />';
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

    function cek_all_approval($id)
    {
        $app_lv1 = getValue('is_app_lv1', 'users_cuti', array('id'=>'where/'.$id));
        $app_lv2 = getValue('is_app_lv2', 'users_cuti', array('id'=>'where/'.$id));
        $app_lv3 = getValue('is_app_lv3', 'users_cuti', array('id'=>'where/'.$id));
        $app_hrd = getValue('is_app_hrd', 'users_cuti', array('id'=>'where/'.$id));

        if(!empty(getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id))) && empty(getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id))) && empty(getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id)))){
            $total_app = '2';
        }elseif(!empty(getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id))) && !empty(getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id))) && empty(getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id)))){
            $total_app = '3';
        }elseif(!empty(getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id))) && !empty(getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id))) && !empty(getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id)))){
            $total_app = '4';
        }else{
            $total_app = '1';
        }

        switch ($total_app) {
            case "2":
                if($app_lv1==1 && $app_hrd==1){$this->update_attendance($id);}else{return false;};
                break;
            case "3":
                if($app_lv1==1 && $app_lv2==1 && $app_hrd==1){$this->update_attendance($id);}else{return false;};
                break;
            case "4":
                if($app_lv1==1 && $app_lv2==1 && $app_lv3==1 && $app_hrd==1){$this->update_attendance($id);}else{return false;};
                break;
            case "1":
                if($app_hrd==1){$this->update_attendance($id);}else{return false;};
                break;
        }

    }

    function update_attendance($id)
    {
        $f = array('id' => 'where/'.$id);
        $user_nik = get_nik(getValue('user_id','users_cuti', $f));
        // Start date
         $date = getValue('date_mulai_cuti','users_cuti', $f);
         // End date
         $end_date = getValue('date_selesai_cuti','users_cuti', $f);
         $status_id = getValue('approval_status_id_hrd','users_cuti', $f);
         while (strtotime($date) <= strtotime($end_date)) {
         $data = array(
                        'nik'       => get_mchid($user_nik),
                        'jhk'       => 1,
                        'cuti'      => 1,
                        'tanggal'   => date("d", strtotime($date)),
                        'bulan'     => date("m", strtotime($date)),
                        'tahun'     => date("Y", strtotime($date)),
                        'create_date' => date('Y-m-d',strtotime('now')),
                        'create_user_id' => $this->session->userdata('user_id'),
                    );
         $this->db->insert('attendance', $data);

         $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
         }

        $jml_hari_cuti = getValue('jumlah_hari','users_cuti', array('id' => 'where/'.$id));
        $recid = $this->get_sisa_cuti($user_nik)['recid'];
        $potong_cuti = getValue('potong_cuti','users_cuti', array('id' => 'where/'.$id));
        if($id < 154){
            $sisa_cuti = $this->get_sisa_cuti($user_nik)['sisa_cuti'] - $jml_hari_cuti;
        }else{
            $sisa_cuti = $this->get_sisa_cuti($user_nik)['sisa_cuti'] - $potong_cuti;
        }
        $this->update_sisa_cuti($recid, $sisa_cuti);
        if($status_id == 1){
            $status_id = 3;
        }elseif($status_id == 2){
            $status_id = 1;
        }elseif($status_id == 3){
            $status_id = 2;
        }else{
            $status_id = 0;
        }
        $this->update_status_flag($user_nik, $date, $end_date, $status_id);
    }

    function update_status_flag($nik, $date, $end_date, $status_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/update_flag_cuti/nik/'.$nik.'/date/'.$date.'/end_date/'.$end_date.'/status_id/'.$status_id;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);


        if(isset($result->status) && $result->status == 'success')
        {
            //return $this->rest->debug();
            return TRUE;
        }
        else
        {
            //return $this->rest->debug();
            return FALSE;
        }
    }

    function update_sisa_cuti($recid, $sisa_cuti)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/sisa_cuti/RECID/'.$recid.'/ENTITLEMENT/'.$sisa_cuti;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);


        if(isset($result->status) && $result->status == 'success')
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function insert_leave_request($user_id, $data = array(), $leave_request_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($user_id);
        //$leaveid = substr($leave_request_id[0]['IDLEAVEREQUEST'],2)+1;
        $leaveid = $this->getLeaveNumberSequence();
        $NEXTREC = $leaveid + 1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEREQUEST = 'CT'.$leaveid;
        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
        $RECID = $leave_request_id[0]['RECID']+1;
        $char = array('"', '<', '>', '#', '%', '{', '}', '|', '^', '~','(',')', '[', ']', '`',',', ' ','&', '.', '/', "'", ';', '+');
        $remarks = str_replace($char, '-', $data['remarks']);
        $remarks = substr($remarks,0,75);
        $alamat_cuti = str_replace($char, '-', $data['alamat_cuti']);
        $alamat_cuti = substr($remarks,0,60);
        $phone = str_replace($char, '-', $data['contact']);
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/leave_request/'.
               'EMPLID/'.$user_id.
               '/HRSLEAVETYPEID/'.$data['alasan_cuti_id'].
               '/REMARKS/'.$remarks.
               '/CONTACTPHONE/'.$phone.
               '/TOTALLEAVEDAYS/'.$data['jumlah_hari'].
               '/LEAVEDATETO/'.$data['date_selesai_cuti'].
               '/LEAVEDATEFROM/'.$data['date_mulai_cuti'].
               '/REQUESTDATE/'.$data['created_on'].
               '/IDLEAVEREQUEST/'.$IDLEAVEREQUEST.
               '/STATUSFLAG/'.'0'.
               '/IDPERSONSUBSTITUTE/'.$data['user_pengganti'].
               '/TRAVELLINGLOCATION/'.$alamat_cuti.
               '/MODIFIEDDATETIME/'.date('Y-m-d', strtotime($data['created_on'])).
               '/MODIFIEDBY/'.$data['created_by'].
               '/CREATEDDATETIME/'.date('Y-m-d', strtotime($data['created_on'])).
               '/CREATEDBY/'.$data['created_by'].
               '/DATAAREAID/'.get_user_dataareaid($user_id).
               '/RECVERSION/'.$RECVERSION.
               '/RECID/'.$RECID.
               '/BRANCHID/'.get_user_branchid($user_id).
               '/DIMENSION/'.get_user_buid($user_id).
               '/DIMENSION2_/'.get_user_dimension2_($user_id).
               '/HRSLOCATIONID/'.get_user_locationid($user_id).
               '/HRSEMPLGROUPID/'.get_user_emplgroupid($user_id)
               ;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')
        {
            //$this->send_email('abdulghanni2@gmail.com', 'error insert cuti', $this->rest->debug());
            //print_mz($this->email->print_debugger());
            $this->update_leave_number_sequence($NEXTREC);
            return true;
        }
        else
        {
            //print_mz($this->email->print_debugger());
            $isi_email = $this->rest->debug();
            $this->send_email('abdulghanni2@gmail.com', $user_id.' error insert cuti', $isi_email);
            return false;
        }
    }

    function insert_sisa_cuti($user_nik, $alasan_cuti)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $leave_entitlement_id = $this->get_last_leave_entitlement_id();
        //$leaveid = substr($leave_entitlement_id[0]['IDLEAVEENTITLEMENT'],5)+1;
        $leaveid = $this->getEntitlementNumberSequence();
        $NEXTREC = $leaveid +1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEENTITLEMENT = 'LVEN_'.$leaveid;
        $RECVERSION = $leave_entitlement_id[0]['RECVERSION']+1;
        $RECID = $leave_entitlement_id[0]['RECID']+1;
        $seniority_date = get_seniority_date($user_nik);
        $y = date('Y');
        $STARTACTIVEDATE = $y.'-'.date('m-d', strtotime($seniority_date));
        $ENDACTIVEDATE = date('Y-m-d', strtotime('+1 Year', strtotime($STARTACTIVEDATE)));
        $ENDACTIVEDATE = date('Y-m-d', strtotime('-1 Day', strtotime($ENDACTIVEDATE)));
        $HRSLEAVETYPEID = $alasan_cuti;
        $sess_nik = get_nik($this->session->userdata('user_id'));
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/insert_sisa_cuti/'.
               'CURRCF/'.'0'.
               '/ENDPERIODCF/'.'0'.
               '/MAXENTITLEMENT/'.'15'.
               '/MAXCF/'.'0'.
               '/MAXADVANCE/'.'3'.
               '/ENTITLEMENT/'.'10'.
               '/STARTACTIVEDATE/'.$STARTACTIVEDATE.
               '/ENDACTIVEDATE/'.$ENDACTIVEDATE.
               '/IDLEAVEENTITLEMENT/'.$IDLEAVEENTITLEMENT.
               '/HRSLEAVETYPEID/'.$HRSLEAVETYPEID.
               '/CASHABLEFLAG/'.'0'.
               '/EMPLID/'.$user_nik.
               '/ENTADJUSMENT/'.'0'.
               '/CFADJUSMENT/'.'0'.
               '/ISCASHABLERESIGN/'.'0'.
               '/PAYROLLRESIGNFLAG/'.'0'.
               '/FIRSTCALCULATIONDATE/'.''.
               '/MATANG/'.'0'.
               '/PAYMENTLEAVEFLAG/'.'0'.
               '/PAYMENTLEAVEAMOUNT/'.'.000000000000'.
               '/SPMID/'.''.
               '/LASTGENERATEDATE/'.''.
               '/ISSPM/'.'0'.
               '/BASEDONMARITALSTATUS/'.'0'.
               '/BASEDONSALARY/'.'0'.
               '/CASHABLEREQUESTFLAG/'.'0'.
               '/PAYROLPAYMENTLEAVEFLAG/'.'0'.
               '/TGLMATANG/'.''.
               '/MODIFIEDBY/'.$sess_nik.
               '/CREATEDBY/'.$sess_nik.
               '/DATAAREAID/'.get_user_dataareaid($user_nik).
               '/RECVERSION/'.$RECVERSION.
               '/RECID/'.$RECID.
               '/HRSEMPLGROUPID/'.get_user_emplgroupid($user_nik).
               '/BRANCHID/'.get_user_branchid($user_nik).
               '/ERL_LEAVECF/'.'0';

               $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')
        {
            //print_mz($this->rest->debug());
            $this->update_entitlement_number_sequence($NEXTREC);
            return true;
        }
        else
        {
            //print_mz($this->rest->debug());
            return false;
        }

    }

    function update_leave_number_sequence($NEXTREC){
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/update_leave_number_sequence/'.
               'NEXTREC/'.$NEXTREC;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')
        {
            //print_mz($this->rest->debug());
            return true;
        }
        else
        {
            //print_mz($this->rest->debug());
            return false;
        }
    }

    function update_entitlement_number_sequence($NEXTREC){
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/update_entitlement_number_sequence/'.
               'NEXTREC/'.$NEXTREC;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')
        {
            //print_mz($this->rest->debug());
            return true;
        }
        else
        {
            //print_mz($this->rest->debug());
            return false;
        }
    }

    function get_sisa_cuti($user_nik)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = get_api_key().'users/sisa_cuti/EMPLID/'.$user_nik.'/format/json';
        $seniority_date = get_seniority_date($user_nik);
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getsisa_cuti = file_get_contents($url);
            $sisa_cuti = json_decode($getsisa_cuti, true);
            $sisa_cuti = array(
                    'sisa_cuti' => $sisa_cuti[0]['ENTITLEMENT'],
                    'recid' => $sisa_cuti[0]['RECID'],
                    'insert' => false
                );
            return $sisa_cuti;
        } elseif($response == "404" && strtotime($seniority_date) < strtotime('-1 year')) {
            $sisa_cuti = array(
                    'sisa_cuti' => 10,
                    'insert' => 1
                );

            return $sisa_cuti;
        }else{
            $sisa_cuti = array(
                    'sisa_cuti' => 0,
                    'insert' => false
                );
            return $sisa_cuti;
        }
    }

    function get_last_leave_request_id()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = get_api_key().'users/last_leave_request_id/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getleave_request_id = file_get_contents($url);
            $leave_request_id = json_decode($getleave_request_id, true);
            return $leave_request_id;
        } else {
            return '';
        }
    }

    function getLeaveNumberSequence()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $url = get_api_key().'users/last_leave_number_sequence/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getleave_request_id = file_get_contents($url);
            $leave_request_id = json_decode($getleave_request_id, true);
            return $leave_request_id;
        } else {
            return '';
        }
    }

    function getEntitlementNumberSequence()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $url = get_api_key().'users/last_entitlement_number_sequence/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getleave_request_id = file_get_contents($url);
            $leave_request_id = json_decode($getleave_request_id, true);
            return $leave_request_id;
        } else {
            return '';
        }
    }

    function get_last_leave_entitlement_id()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = get_api_key().'users/last_leave_entitlement_id/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getleave_entitlement_id = file_get_contents($url);
            $leave_entitlement_id = json_decode($getleave_entitlement_id, true);
            return $leave_entitlement_id;
        } else {
            return '';
        }
    }

    function insert_manual_leave_request()
    {
        $cuti_id = array('301');
        foreach ($cuti_id as $key => $value) {
            //echo $value;
            $data = GetAll('users_cuti', array('id'=>'where/'.$value))->row_array();//lastq();

        $leave_request_id = $this->get_last_leave_request_id();
        $user_id = get_nik($data['user_id']);
        //$leaveid = substr($leave_request_id[0]['IDLEAVEREQUEST'],2)+1;
        $leaveid = $this->getLeaveNumberSequence();
        $NEXTREC = $leaveid + 1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEREQUEST = 'CT'.$leaveid;
        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
        $RECID = $leave_request_id[0]['RECID']+1;//print_mz($RECID);
        $char = array('"', '<', '>', '#', '%', '{', '}', '|', '^', '~','(',')', '[', ']', '`',',', ' ','&', '.', '/', ';', '+');
        $remarks = str_replace($char, '-', $data['remarks']);
        $remarks = substr($remarks,0,75);
        $alamat_cuti = str_replace($char, '-', $data['alamat_cuti']);
        $alamat_cuti = substr($alamat_cuti,0,60);
        $phone = str_replace($char, '-', $data['contact']);
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/leave_request/'.
               'EMPLID/'.$user_id.
               '/HRSLEAVETYPEID/'.$data['alasan_cuti_id'].
               '/REMARKS/'.$remarks.
               '/CONTACTPHONE/'.$phone.
               '/TOTALLEAVEDAYS/'.$data['jumlah_hari'].
               '/LEAVEDATETO/'.$data['date_selesai_cuti'].
               '/LEAVEDATEFROM/'.$data['date_mulai_cuti'].
               '/REQUESTDATE/'.date('Y-m-d', strtotime($data['created_on'])).
               '/IDLEAVEREQUEST/'.$IDLEAVEREQUEST.
               '/STATUSFLAG/'.'3'.
               '/IDPERSONSUBSTITUTE/'.$data['user_pengganti'].
               '/TRAVELLINGLOCATION/'.$alamat_cuti.
               '/MODIFIEDDATETIME/'.date('Y-m-d', strtotime($data['created_on'])).
               '/MODIFIEDBY/'.'1'.
               '/CREATEDDATETIME/'.date('Y-m-d', strtotime($data['created_on'])).
               '/CREATEDBY/'.'1'.
               '/DATAAREAID/'.get_user_dataareaid($user_id).
               '/RECVERSION/'.$RECVERSION.
               '/RECID/'.$RECID.
               '/BRANCHID/'.get_user_branchid($user_id).
               '/DIMENSION/'.get_user_buid($user_id).
               '/DIMENSION2_/'.get_user_dimension2_($user_id).
               '/HRSLOCATIONID/'.get_user_locationid($user_id).
               '/HRSEMPLGROUPID/'.get_user_emplgroupid($user_id)
               ;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')
        {
            echo $value;
            echo $data['user_id'];
             echo '<pre>';
            print_r($this->rest->debug());
            //return true;
            echo '</pre>';
            $this->update_leave_number_sequence($NEXTREC);
            echo '<pre>';
            print_r($this->rest->debug());
            //return true;
            echo '</pre>';
        }
        else
        {
            echo '<pre>';
            print_r($this->rest->debug());
            //return true;
            echo '</pre>';
        }

        }
        die();
    }

    function get_type_cuti()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = get_api_key().'users/type_cuti/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $gettype_cuti = file_get_contents($url);
            $type_cuti = json_decode($gettype_cuti, true);
            return $type_cuti;
        } else {
            return '';
        }
    }

    function get_libur($tglawal,$tglakhir,$delimiter) {

        $tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;
        $liburnasional = $this->get_holiday();

    //  memecah tanggal untuk mendapatkan hari, bulan dan tahun
        $pecah_tglawal = explode($delimiter, $tglawal);
        $pecah_tglakhir = explode($delimiter, $tglakhir);

    //    mengubah Gregorian date menjadi Julian Day Count
        $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
        $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);

    //    mengubah ke unix timestamp
        $jmldetik = 24*3600;
        $a = strtotime($tglawal);
        $b = strtotime($tglakhir);
    //    menghitung jumlah libur nasional
        for($i=$a; $i<$b; $i+=$jmldetik){
            for($j=0;$j<sizeof($liburnasional);$j++) {
                if($liburnasional[$j]==date("Y-m-d",$i)){
                    $libur++;
                }
            }
        }

        echo json_encode($libur);
    }



    function get_num_leave($id){
        $n = getValue('jumlah_hari', 'cuti_jumlah_plafon', array('alasan_cuti_id'=>'where/'.$id));

        echo json_encode($n);
    }

    function to_csv(){
        $select = "SELECT users_cuti.id, nik, date_mulai_cuti, jumlah_hari, remarks FROM users_cuti join users on users_cuti.user_id = users.id where approval_status_id_hrd = 1 order by users_cuti.id desc";

        $export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

        $fields = mysql_num_fields ( $export );
        $data = '';
        $header = '';
        for ( $i = 0; $i < $fields; $i++ )
        {
            $header .= mysql_field_name( $export , $i ) . "\t";
        }

        while( $row = mysql_fetch_row( $export ) )
        {
            $line = '';
            foreach( $row as $value )
            {                                            
                if ( ( !isset( $value ) ) || ( $value == "" ) )
                {
                    $value = "\t";
                }
                else
                {
                    $value = str_replace( '"' , '""' , $value );
                    $value = '"' . $value . '"' . "\t";
                }
                $line .= $value;
            }
            $data .= trim( $line ) . "\n";
        }
        $data = str_replace( "\r" , "" , $data );

        if ( $data == "" )
        {
            $data = "\n(0) Records Found!\n";                        
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=users_cuti.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$data"; 
    }

    public function get_holiday()
    {
        $url = get_api_key().'users/holiday/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
            $get_holiday = file_get_contents($url);
            $holiday = json_decode($get_holiday, true);
            $libur = array();
            //print_mz($holiday);
            foreach ($holiday as $key => $value) {
                $libur[] = date('Y-m-d', strtotime($value['HOLIDAYDATE']));

             }

             return $libur;
            }

    }

/* End of file form_cuti.php */
/* Location: ./application/modules/form_cuti/controllers/form_cuti.php */

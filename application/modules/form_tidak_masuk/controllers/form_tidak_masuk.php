<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_tidak_masuk extends MX_Controller {

	public $data;
    var $form_name = 'tidak_masuk';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->library('approval');

        $this->load->database();
        $this->load->model('form_tidak_masuk/form_tidak_masuk_model','main');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = 'Form Tidak Masuk';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['form_name'] = $this->form_name;
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/tidak_masuk'));
            $this->data['form'] = $this->form_name;

            $this->_render_page('form_tidak_masuk/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->main->get_datatables($f);//lastq();
        //print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_$this->form_name/detail/".$r->id;
           $print = base_url()."form_$this->form_name/form_$this->form_name"."_pdf/".$r->id;
           $delete = (($r->is_app_lv1 == 0 && $r->created_by == sessId()) || is_admin()) ? '<button onclick="showModal('.$r->id.')" class="btn btn-sm btn-danger" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : '';

            //APPROVAL
            if(!empty($r->user_app_lv1)){
                $status1 = ($r->is_app_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->is_app_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->is_app_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Langsung'></i>";
            }
            if(!empty($r->user_app_lv2)){
                $status2 = ($r->is_app_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->is_app_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->is_app_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Tidak Langsung'></i>";
            }
            if(!empty($r->user_app_lv3)){
                $status3 = ($r->is_app_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->is_app_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->is_app_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Lainnya'></i>";
            }

            $statushrd = ($r->is_app_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->is_app_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->is_app_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->nik.'</a>';
            $row[] = "<a href=$detail>".$r->username.'</a>';
            $row[] = dateIndo($r->dari_tanggal);
            $row[] = $r->alasan;
            $row[] = dateIndo($r->created_on);
            $row[] = $status1;
            $row[] = $status2;
            $row[] = $status3;
            $row[] = $statushrd;
            $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
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

    function detail($id, $lv = null)
    {
        $this->data['title'] = 'Detail - Keterangan Tidak Masuk';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $this->data['user_folder'] = getValue("user_id", "users_tidak_masuk", array('id'=>'where.'.$id));
            $form_tidak_masuk = $this->data['tidak_masuk'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $this->data['user_nik'] = $user_nik = get_nik($form_tidak_masuk->user_id);
            $alasan = $form_tidak_masuk->alasan_tidak_masuk_id;
            $this->data['alasan'] = getValue('title', 'alasan_tidak_masuk', array('id'=>'where/'.$alasan));
            $this->data['alasan_cuti'] = GetAllSelect('alasan_cuti', 'HRSLEAVETYPEID, title');
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $tipe_cuti = $form_tidak_masuk->type_cuti_id;
            $this->data['tipe_cuti'] = getValue('title', 'alasan_cuti', array('HRSLEAVETYPEID'=>'where/'.$tipe_cuti));
            $this->data['sisa_cuti'] = $this->get_sisa_cuti($user_nik);

            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            if($lv != null){
                $app = $this->load->view('form_tidak_masuk/'.$lv, $this->data, true);
                $note = $this->load->view('form_tidak_masuk/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{
                $this->_render_page('form_tidak_masuk/detail', $this->data);
            }
        }
    }


     function input()
    {
        $this->data['title'] = 'Input - Keterangan Tidak Masuk';
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            //$this->data['sisa_cuti'] = $this->get_sisa_cuti($sess_nik);
			// $form_tidak_masuk = $this->data['form_tidak_masuk'] = getAll('users_tidak_masuk');
   //          $tidak_masuk_id = $form_tidak_masuk->last_row();
            //$this->data['tidak_masuk_id'] = ($form_tidak_masuk->num_rows()>0)?$tidak_masuk_id->id+1:1;

            $this->data['alasan'] = getAll('alasan_tidak_masuk', array('is_deleted'=>'where/0'));
            if(is_admin())$this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));

            $this->_render_page('form_tidak_masuk/input', $this->data);
        }
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            redirect('form_tidak_masuk/input', 'refresh');
            }
            else
            {
                $user_id = $this->input->post('emp');
                $sess_id = $this->session->userdata('user_id');
                $user_nik= get_nik($sess_id);
                $data = array(
                    'dari_tanggal' => date('Y-m-d', strtotime($this->input->post('dari_tanggal'))),
                    'sampai_tanggal' => date('Y-m-d', strtotime($this->input->post('sampai_tanggal'))),
                    'jml_hari' => $this->input->post('jml_hari'),
                    'sisa_cuti' => $this->input->post('sisa_cuti'),
                    'alasan_tidak_masuk_id' => $this->input->post('alasan'),
                    'keterangan' => $this->input->post('keterangan'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $sess_id
                    );
                /*
                if($this->input->post('potong_cuti') == 1){
                    $user_nik = get_nik($user_id);
                    $date = $this->input->post('date_tidak_hadir');
                    $recid = $this->get_sisa_tidak_masuk($user_id)[0]['RECID'];
                    $sisa_tidak_masuk = $this->get_sisa_tidak_masuk($user_id)[0]['ENTITLEMENT'] - 1;

                    $this->update_sisa_tidak_masuk($recid, $sisa_tidak_masuk);

                    $data2 = array(
                                'nik'       => get_mchid($user_nik),
                                'jhk'       => 1,
                                'cuti'      => 1,
                                'tanggal'   => date("d", strtotime($date)),
                                'bulan'     => date("m", strtotime($date)),
                                'tahun'     => date("Y", strtotime($date)),
                                'create_date' => date('Y-m-d',strtotime('now')),
                                'create_user_id' => $this->session->userdata('user_id'),
                            );
                    $this->db->insert('attendance', $data2);
                }
                */

                if ($this->form_validation->run() == true && $this->main->create_($user_id,$data))
                {
                 $tidak_masuk_id = $this->db->insert_id();
                 $this->upload_attachment($tidak_masuk_id);
                 $user_app_lv1 = getValue('user_app_lv1', 'users_tidak_masuk', array('id'=>'where/'.$tidak_masuk_id));
                 $subject_email = get_form_no($tidak_masuk_id).'-Pengajuan Keterangan Tidak Masuk';
                 $isi_email = get_name($user_id).' mengajukan keterangan tidak masuk, untuk melihat detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$tidak_masuk_id.'>Klik Disini</a><br />';

                 if($user_id!==$sess_id):
                    $this->approval->by_admin('tidak_masuk', $tidak_masuk_id, $sess_id, $user_id, $this->detail_email($tidak_masuk_id));
                 endif;
                 if(!empty($user_app_lv1)):
                     if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                     $this->approval->request('lv1', 'tidak_masuk', $tidak_masuk_id, $user_id, $this->detail_email($tidak_masuk_id));
                 else:
                     if(!empty(getEmail($this->approval->approver('tidak', $user_nik))))$this->send_email(getEmail($this->approval->approver('tidak', $user_nik)), $subject_email, $isi_email);
                     $this->approval->request('hrd', 'tidak_masuk', $tidak_masuk_id, $user_id, $this->detail_email($tidak_masuk_id));
                 endif;

                  redirect('form_tidak_masuk', 'refresh');
                 //echo json_encode(array('st' =>1));
                }
            }
        }
    }

    function upload_attachment($id){
        $sess_id = $this->session->userdata('user_id');
            $user_folder = get_nik($sess_id);
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads/', 0777);
        }
        if(!is_dir('./uploads/izin/')){
        mkdir('./uploads/izin/', 0777);
        }
        if(!is_dir('./uploads/izin/'.$user_folder)){
        mkdir('./uploads/izin/'.$user_folder, 0777);
        }

        $config =  array(
          'upload_path'     => './uploads/izin/'.$user_folder,
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
            $this->db->where('id', $id)->update('users_tidak_masuk', $data);
        }
        //print_r($this->db->last_query());
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');


        if($type !== 'hrd'){
            $data = array(
            'is_app_'.$type => 1,
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id,
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );

            $this->main->update($id,$data);
            
        }else{
            $potong_cuti = $this->input->post('potong_cuti');
            $tipe_cuti = $this->input->post('type_cuti_id');
            $data = array(
            'potong_cuti'           => $potong_cuti,
            'type_cuti_id'           => $tipe_cuti,
            'is_app_'.$type => 1,
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id,
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $this->main->update($id,$data);
        }

        return true;
    }

    function send_notif($id, $type){
        if($type != 'hrd'){
            $user_tidak_masuk_id = getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status =  $approval_status = getValue('app_status_id_'.$type, 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $this->approval->approve('tidak_masuk', $id, $approval_status, $this->detail_email($id));
            $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Keterangan Tidak Masuk dari Atasan';
            $subject_email_request = get_form_no($id).'-Pengajuan Keterangan Tidak Masuk';
            $isi_email = 'Status pengajuan keterangan tidak Masuk anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_tidak_masuk_id).' mengajukan keterangan tidak Masuk, untuk melihat detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$id.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_tidak_masuk_id)))$this->send_email(getEmail($user_tidak_masuk_id), $subject_email, $isi_email);

            $lv = substr($type, -1)+1;
            $lv_app= 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_tidak_masuk', array('id'=>'where/'.$id)) : 0;
            $user_app_lv3 = getValue('user_app_lv3', 'users_tidak_masuk', array('id'=>'where/'.$id));
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                $this->approval->request($lv_app, 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            elseif(empty($user_app) && !empty($user_app_lv3) && $type == 'lv1'):
                if(!empty(getEmail($user_app_lv3)))$this->send_email(getEmail($user_app_lv3), $subject_email_request, $isi_email_request);
                $this->approval->request('lv3', 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            elseif(empty($user_app) && empty($user_app_lv3) && $type == 'lv1'):
                if(!empty(getEmail($this->approval->approver('tidak', $user_id))))$this->send_email(getEmail($this->approval->approver('tidak', $user_id)), $subject_email_request, $isi_email_request);
                $this->approval->request('hrd', 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            elseif($type == 'lv3'):
                if(!empty(getEmail($this->approval->approver('tidak', $user_id))))$this->send_email(getEmail($this->approval->approver('tidak', $user_id)), $subject_email_request, $isi_email_request);
                $this->approval->request('hrd', 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            elseif(empty($user_app_lv3) && $type == 'lv2'):
                    $this->approval->request('hrd', 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('tidak_masuk', $user_id))))$this->send_email(getEmail($this->approval->approver('tidak_masuk', $user_id)), $subject_email_request, $isi_email_request);
            endif;
        }else{
            $is_app = getValue('is_app_'.$type, 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status =  $approval_status = getValue('app_status_id_'.$type, 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $user_tidak_masuk_id = getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));

            $subject_email = get_form_no($id).'-['.$approval_status_mail.']Status Pengajuan Izin Tidak Masuk dari HRD';
            $isi_email = 'Status pengajuan tidak_masuk anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$id.'>Klik Disini</a><br />';

            $user_nik = get_nik($user_tidak_masuk_id);
            if($potong_cuti == 1){
                if($this->input->post('insert') == 1)$this->insert_sisa_cuti($user_nik, $tipe_cuti);
                $leave_request_id = $this->get_last_leave_request_id();
                $additional_data  = array(
                        'remarks' => getValue('keterangan', 'users_tidak_masuk', array('id'=>'where/'.$id)),
                        'jumlah_hari' => getValue('jml_hari', 'users_tidak_masuk', array('id'=>'where/'.$id)),
                        'date_mulai_cuti' => date('Y-m-d',strtotime(getValue('dari_tanggal', 'users_tidak_masuk', array('id'=>'where/'.$id)))),
                        'date_selesai_cuti' => date('Y-m-d',strtotime(getValue('sampai_tanggal', 'users_tidak_masuk', array('id'=>'where/'.$id)))),
                        'alasan_cuti_id' => $tipe_cuti,
                    );

                $this->insert_leave_request($user_nik, $additional_data, $leave_request_id);
                $jml_hari_cuti = getValue('jml_hari', 'users_tidak_masuk', array('id' => 'where/'.$id));
                $recid = $this->get_sisa_cuti($user_nik)['recid'];
                $sisa_cuti = $this->get_sisa_cuti($user_nik)['sisa_cuti'] - $jml_hari_cuti;

                $this->update_sisa_cuti($recid, $sisa_cuti);
            }else{
                $this->insert_attendancedata($id);
            }
            if($is_app==0){
                $this->approval->approve('tidak_masuk', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_tidak_masuk_id)))$this->send_email(getEmail($user_tidak_masuk_id), $subject_email , $isi_email);
            }else{
                $this->approval->update_approve('tidak_masuk', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_tidak_masuk_id)))$this->send_email(getEmail($user_tidak_masuk_id), get_form_no($id).'-['.$approval_status_mail.']'.'Perubahan Status Pengajuan Permohonan tidak_masuk dari Atasan', $isi_email);
            }
        }
    }

    function detail_email($id)
    {
        return true;
    }

    function form_tidak_masuk_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id= getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
        $this->data['user_nik'] = $sess_nik = get_nik($user_id);
        $this->data['sess_id'] = $this->session->userdata('user_id');

        $form_tidak_masuk = $this->data['form_tidak_masuk'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();

        $alasan = getValue('alasan_tidak_masuk_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
        $this->data['alasan'] = getValue('title', 'alasan_tidak_masuk', array('id'=>'where/'.$alasan));

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Keterangan Tidak Masuk-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('tidak_masuk_pdf', $this->data, true);
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
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

    function insert_leave_request($user_id, $data = array(), $leave_request_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $sess_nik = get_nik($this->session->userdata('user_id'));
        // $leaveid = substr($leave_request_id[0]['IDLEAVEREQUEST'],2)+1;
				$leaveid = $this->getLeaveNumberSequence();
        $NEXTREC = $leaveid + 1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEREQUEST = 'CT'.$leaveid;
        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
        $RECID = $leave_request_id[0]['RECID']+1;
        $char = array('"', '<', '>', '#', '%', '{', '}', '|', '^', '~','(',')', '[', ']', '`',',', ' ','&', '.', '/', "'", ';');
        $remarks = str_replace($char, '-', $data['remarks']);
				$remarks = word_limiter($remarks, 75);
        $phone = (!empty(getValue('phone', 'users', array('nik'=>'where/'.$user_id))))?str_replace(' ', '-', getValue('phone', 'users', array('nik'=>'where/'.$user_id))):'-';
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
               '/REQUESTDATE/'.date('Y-m-d').
               '/IDLEAVEREQUEST/'.$IDLEAVEREQUEST.
               '/STATUSFLAG/'.'3'.
               '/IDPERSONSUBSTITUTE/'.'-'.
               '/TRAVELLINGLOCATION/'.'-'.
               '/MODIFIEDDATETIME/'.date('Y-m-d').
               '/MODIFIEDBY/'.$sess_nik.
               '/CREATEDDATETIME/'.date('Y-m-d').
               '/CREATEDBY/'.$sess_nik.
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
           //return $this->rest->debug();
					 $this->update_leave_number_sequence($NEXTREC);
            return true;
        }
        else
        {
            //return $this->rest->debug();
            return false;
            //return $this->rest->debug();
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
            $isi_email = $this->rest->debug();
            $this->send_email('abdulghanni2@gmail.com', 'error insert cuti', $isi_email);
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
        // $leaveid = substr($leave_entitlement_id[0]['IDLEAVEENTITLEMENT'],5)+1;
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

    function insert_attendancedata($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $data = GetAll('users_tidak_masuk', array('id'=>'where/'.$id))->row_array();
        $user_id = get_nik($data['user_id']);
       $attendance_id = $this->get_last_attendacedata_id();
        $RECVERSION = $attendance_id[0]['RECVERSION']+1;
        $RECID = $attendance_id[0]['RECID']+1;
        // Start date
        $date = $data['dari_tanggal'];
        // End date
        $end_date = $data['sampai_tanggal'];
        $method = 'post';
        $params =  array();
        while (strtotime($date) <= strtotime($end_date)) {
            $uri = get_api_key().'attendance/attendance_data/'.
                   'EMPLID/'.$user_id.
                   '/ATTENDANCEDATE/'.$date.
                   '/EMPLSTATUS/'.get_user_emplstatus($user_id).
                   '/HRSLOCATIONID/'.get_user_locationid($user_id).
                   '/DIMENSION/'.get_user_buid($user_id).
                   '/DIMENSION2_/'.get_user_dimension2_($user_id).
                   '/HRSSCHEDULEID/'.get_user_dimension2_($user_id).
                   '/MODIFIEDDATETIME/'.$data['created_on'].
                   '/MODIFIEDBY/'.get_nik(sessId()).
                   '/CREATEDDATETIME/'.$data['created_on'].
                   '/CREATEDBY/'.get_nik(sessId()).
                   '/DATAAREAID/'.get_user_dataareaid($user_id).
                   '/RECVERSION/'.$RECVERSION.
                   '/RECID/'.$RECID.
                   '/BRANCHID/'.get_user_branchid($user_id)
                   ;

            $this->rest->format('application/json');

            $result = $this->rest->{$method}($uri, $params);

            if(isset($result->status) && $result->status == 'success')
            {
                //echo "<pre>";
                //print_r($this->rest->debug());
                //echo "</pre>";
                return true;
           }
            else
           {
                 //echo "<pre>";
                ///print_r($this->rest->debug());
                //echo "</pre>";
                return false;
            }
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
    }

    function get_last_attendacedata_id()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = get_api_key().'attendance/last_attendance_id/format/json';
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

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_tidak_masuk/index')))
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
                elseif(in_array($view, array('form_tidak_masuk/input',)))
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
                    $this->template->add_js('form_tidak_masuk_input.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');


                }elseif(in_array($view, array('form_tidak_masuk/detail')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    // $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('form_tidak_masuk.js');
                    $this->template->add_js('emp_dropdown.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    // $this->template->add_css('plugins/select2/select2.css');
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

		function insert_manual_leave_request()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

				$tidak_masuk_id = array('802');
				foreach ($tidak_masuk_id as $key => $value) {
						//echo $value;
						$data = GetAll('users_tidak_masuk', array('id'=>'where/'.$value))->row_array();
						$user_id = get_nik($data['user_id']);
						$leave_request_id = $this->get_last_leave_request_id();
						$sess_nik = get_nik($this->session->userdata('user_id'));
						$leaveid = $this->getLeaveNumberSequence();
		        $NEXTREC = $leaveid + 1;
		        $leaveid = sprintf('%06d', $leaveid);
		        $IDLEAVEREQUEST = 'CT'.$leaveid;
		        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
		        $RECID = $leave_request_id[0]['RECID']+1;
		        $char = array('"', '<', '>', '#', '%', '{', '}', '|', '^', '~','(',')', '[', ']', '`',',', ' ','&', '.', '/', "'", ';');
		        $remarks = str_replace($char, '-', $data['keterangan']);
						$remarks = substr($remarks,0,75);
						$dataareaid = (!empty(get_user_dataareaid($user_id))) ? get_user_dataareaid($user_id) : 'erl';
		        $phone = (!empty(getValue('phone', 'users', array('nik'=>'where/'.$user_id))))?str_replace(' ', '-', getValue('phone', 'users', array('nik'=>'where/'.$user_id))):'-';
		        $method = 'post';
		        $params =  array();
		        $uri = get_api_key().'users/leave_request/'.
		               'EMPLID/'.$user_id.
		               '/HRSLEAVETYPEID/'.$data['type_cuti_id'].
		               '/REMARKS/'.$remarks.
		               '/CONTACTPHONE/'.$phone.
		               '/TOTALLEAVEDAYS/'.$data['jml_hari'].
		               '/LEAVEDATETO/'.$data['sampai_tanggal'].
		               '/LEAVEDATEFROM/'.$data['dari_tanggal'].
		               '/REQUESTDATE/'.date('Y-m-d', strtotime($data['created_on'])).
		               '/IDLEAVEREQUEST/'.$IDLEAVEREQUEST.
		               '/STATUSFLAG/'.'3'.
		               '/IDPERSONSUBSTITUTE/'.'-'.
		               '/TRAVELLINGLOCATION/'.'-'.
		               '/MODIFIEDDATETIME/'.date('Y-m-d').
		               '/MODIFIEDBY/'.$sess_nik.
		               '/CREATEDDATETIME/'.date('Y-m-d').
		               '/CREATEDBY/'.$sess_nik.
		               '/DATAAREAID/'.$dataareaid.
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
						echo '<pre>'.$data['id'];
						print_r($this->rest->debug());
						//return true;
						echo '</pre>';
							$this->update_leave_number_sequence($NEXTREC);
	            //return true;
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

    }
}

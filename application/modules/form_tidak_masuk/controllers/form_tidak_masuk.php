<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_tidak_masuk extends MX_Controller {

	public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_tidak_masuk/form_tidak_masuk_model','form_tidak_masuk_model');
        
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
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);


			//set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('users.username'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_tidak_masuk  
            $this->data['form_tidak_masuk_all'] = $this->form_tidak_masuk_model->like($ftitle_post)->where('is_deleted',0)->form_tidak_masuk()->result();
            
            $this->data['num_rows_all'] = $this->form_tidak_masuk_model->like($ftitle_post)->where('is_deleted',0)->form_tidak_masuk()->num_rows();

            $form_tidak_masuk = $this->data['form_tidak_masuk'] = $this->form_tidak_masuk_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_tidak_masuk()->result();
            $this->data['_num_rows'] = $this->form_tidak_masuk_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_tidak_masuk()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_tidak_masuk/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
             $config['total_rows'] = $this->data['num_rows_all'];
             $config['per_page'] = $limit;
             $config['uri_segment'] = 6;

            //inisialisasi config
             $this->pagination->initialize($config);

            //create pagination
            $this->data['halaman'] = $this->pagination->create_links();

            $this->data['ftitle_search'] = array(
                'name'  => 'title',
                'id'    => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );

            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/tidak_masuk'));


            $this->_render_page('form_tidak_masuk/index', $this->data);
        }
    }

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ftitle_post = (strlen($this->input->post('title')) > 0) ? strtolower(url_title($this->input->post('title'),'_')) : "" ;

            redirect('form_tidak_masuk/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function detail($id)
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
            $user_id= getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
            $user_nik = $this->data['user_nik'] = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['user_folder'] = getValue("user_id", "users_tidak_masuk", array('id'=>'where.'.$id));
            $form_tidak_masuk = $this->data['form_tidak_masuk'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->result();
            $this->data['_num_rows'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->num_rows();
            
            $alasan = getValue('alasan_tidak_masuk_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
            $this->data['alasan'] = getValue('title', 'alasan_tidak_masuk', array('id'=>'where/'.$alasan));
            $this->data['alasan_cuti'] = $this->get_type_cuti();
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $tipe_cuti = getValue('type_cuti_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
            $this->data['tipe_cuti'] = getValue('title', 'alasan_cuti', array('HRSLEAVETYPEID'=>'where/'.$tipe_cuti));
            $this->data['sisa_cuti'] = $this->get_sisa_cuti($user_nik);
            $this->_render_page('form_tidak_masuk/detail', $this->data);
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
            $this->data['sisa_cuti'] = $this->get_sisa_cuti($sess_nik);
			$form_tidak_masuk = $this->data['form_tidak_masuk'] = getAll('users_tidak_masuk');
            $tidak_masuk_id = $form_tidak_masuk->last_row();
            $this->data['tidak_masuk_id'] = ($form_tidak_masuk->num_rows()>0)?$tidak_masuk_id->id+1:1;

            $this->data['alasan'] = getAll('alasan_tidak_masuk', array('is_deleted'=>'where/0'));
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            
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
                $user_id= $this->input->post('emp');
                $sess_id = $this->session->userdata('user_id');
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

                if ($this->form_validation->run() == true && $this->form_tidak_masuk_model->create_($user_id,$data))
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
                     if(!empty(getEmail($this->approval->approver('tidak'))))$this->send_email(getEmail($this->approval->approver('tidak')), $subject_email, $isi_email);
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
            print_r($this->upload->display_errors());
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
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            );
            
            $this->form_tidak_masuk_model->update($id,$data);
            $user_tidak_masuk_id = getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status = 1;
            $this->approval->approve('tidak_masuk', $id, $approval_status, $this->detail_email($id));
            $subject_email = get_form_no($id).'-[APPROVED]Status Pengajuan Keterangan Tidak Masuk dari Atasan';
            $subject_email_request = get_form_no($id).'-Pengajuan Keterangan Tidak Masuk';
            $isi_email = 'Status pengajuan keterangan tidak Masuk anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_tidak_masuk_id).' mengajukan keterangan tidak Masuk, untuk melihat detail silakan <a href='.base_url().'form_tidak_masuk/detail/'.$id.'>Klik Disini</a><br />';
            if(!empty(getEmail($user_tidak_masuk_id)))$this->send_email(getEmail($user_tidak_masuk_id), $subject_email, $isi_email);
                
            $lv = substr($type, -1)+1;
            $lv_app= 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_tidak_masuk', array('id'=>'where/'.$id)) : 0;
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                $this->approval->request($lv_app, 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('tidak', $user_id))))$this->send_email(getEmail($this->approval->approver('tidak', $user_id)), $subject_email_request, $isi_email_request);
                $this->approval->request('hrd', 'tidak_masuk', $id, $user_tidak_masuk_id, $this->detail_email($id));
            endif;
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

            $is_app = getValue('is_app_'.$type, 'users_tidak_masuk', array('id'=>'where/'.$id));
            $approval_status = $this->input->post('app_status_'.$type);
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $this->form_tidak_masuk_model->update($id,$data);
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
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['id'] = $id;
        $user_id= getValue('user_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);

        $form_tidak_masuk = $this->data['form_tidak_masuk'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->result();
        $this->data['_num_rows'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->num_rows();
        
        $alasan = getValue('alasan_tidak_masuk_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
        $this->data['alasan'] = getValue('title', 'alasan_tidak_masuk', array('id'=>'where/'.$alasan));
        $this->data['alasan_cuti'] = $this->get_type_cuti();
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $tipe_cuti = getValue('type_cuti_id', 'users_tidak_masuk', array('id'=>'where/'.$id));
        $this->data['tipe_cuti'] = getValue('title', 'alasan_cuti', array('HRSLEAVETYPEID'=>'where/'.$tipe_cuti));

        return $this->load->view('form_tidak_masuk/tidak_masuk_mail', $this->data, TRUE);
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
        
        $form_tidak_masuk = $this->data['form_tidak_masuk'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->result();
        $this->data['_num_rows'] = $this->form_tidak_masuk_model->where('is_deleted',0)->form_tidak_masuk_detail($id)->num_rows();

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

    function insert_leave_request($user_id, $data = array(), $leave_request_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $sess_nik = get_nik($this->session->userdata('user_id'));
        $leaveid = substr($leave_request_id[0]['IDLEAVEREQUEST'],2)+1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEREQUEST = 'CT'.$leaveid;
        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
        $RECID = $leave_request_id[0]['RECID']+1;
        $remarks = str_replace(' ', '-', $data['remarks']);
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
            return true;
        }     
        else  
        {  
            return false;
            //return $this->rest->debug();
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
        $leaveid = substr($leave_entitlement_id[0]['IDLEAVEENTITLEMENT'],5)+1;
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
            return true;
        }     
        else  
        {  
            //print_mz($this->rest->debug());
            return false;
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
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_tidak_masuk/input',)))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

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
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('form_tidak_masuk.js');

                    
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
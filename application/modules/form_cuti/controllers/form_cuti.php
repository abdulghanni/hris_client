<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_cuti extends MX_Controller {

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
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_cuti/form_cuti_model','form_cuti_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {  
        $this->data['title'] = 'Form Cuti';
        $sess_id= $this->session->userdata('user_id');
        $sess_nik= get_nik($sess_id);

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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

            //list of filterize all form_cuti  
            $this->data['form_cuti_all'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->form_cuti()->result();
            
            $this->data['num_rows_all'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->form_cuti()->num_rows();

            $form_cuti = $this->data['form_cuti'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti()->result();//lastq();
            $this->data['_num_rows'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti()->num_rows();
            //lastq();

             //config pagination
             $config['base_url'] = base_url().'form_cuti/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/cuti'));
            $this->_render_page('form_cuti/index', $this->data);
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

            redirect('form_cuti/index/fn:'.$ftitle_post, 'refresh');
        }
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
            //$this->get_user_pengganti();
            $this->data['sisa_cuti'] = $this->get_sisa_cuti($user_nik);
            $u = $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            foreach ($u->result_array() as $row)
            {
                $result[$row['id']]= ucwords(strtolower($row['username']));
            }
            $this->data['users']=$result;

            // form cuti yang akan diambil
            $this->data['comp_session'] = $this->form_cuti_model->render_session()->result();
            $this->data['alasan_cuti'] = $this->get_type_cuti();

            //$this->data['_num_rows'] = $this->form_cuti_model->where('users.id',$user_id)->form_cuti_input()->num_rows();

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

            $year_now = date('Y');
            $comp_session_now_arr = $this->form_cuti_model->where('comp_session.year',$year_now)->render_session()->result();
            foreach ($comp_session_now_arr as $csn) {
                $comp_session_now = $csn->id;
            }

            $additional_data = array(
                'id_comp_session'       => $comp_session_now,
                'date_mulai_cuti'       => date('Y-m-d', strtotime($this->input->post('start_cuti'))),
                'date_selesai_cuti'     => date('Y-m-d', strtotime($this->input->post('end_cuti'))),
                'jumlah_hari'           => $this->input->post('jml_cuti'),
                'sisa_cuti'             => $this->input->post('sisa_cuti'),
                'alasan_cuti_id'        => $this->input->post('alasan_cuti'),
                'remarks'               => $this->input->post('remarks'),
                'user_pengganti'        => $this->input->post('user_pengganti'),
                'contact'               => $this->input->post('contact'),
                'alamat_cuti'           => $this->input->post('alamat'),
                'user_app_lv1'          => $this->input->post('atasan1'),
                'user_app_lv2'          => $this->input->post('atasan2'),
                'user_app_lv3'          => $this->input->post('atasan3'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $sess_id
            );

            if ($this->form_validation->run() == true && $this->form_cuti_model->create_($user_id,$additional_data))
            {
                 $cuti_id = $this->db->insert_id();
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
                    if(!empty(getEmail($this->approval->approver('cuti'))))$this->send_email(getEmail($this->approval->approver('cuti')), $subject_email, $isi_email);
                 }

                 if($this->input->post('insert') == 1)
                 {
                    $this->insert_sisa_cuti($user_nik, $this->input->post('alasan_cuti'));
                 }

                 $this->insert_leave_request($user_id, $additional_data, $leave_request_id);
                 redirect('form_cuti', 'refresh');   
            }
        }
    }

    function detail($id)
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
        $user_id = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $user_nik = get_nik($user_id);
        $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
		$this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        
        $this->_render_page('form_cuti/detail', $this->data);
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
            $this->form_cuti_model->update($id,$data);
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
                if(!empty($user_app)){
                    $this->approval->request($lv_app, 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                }else{
                    $this->approval->request('hrd', 'cuti', $id, $user_cuti_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('cuti'))))$this->send_email(getEmail($this->approval->approver('cuti')), $subject_email_request, $isi_email_request);
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

                    case 'hrd':
                        $receiver_lv3 = getValue('user_app_lv3', 'users_cuti', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv3)):
                            $this->approval->not_approve('cuti', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                            if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), $subject_email, $email_body);
                        endif;
                        $receiver_lv2 = getValue('user_app_lv2', 'users_cuti', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv2)):
                            $this->approval->not_approve('cuti', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                            if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), $subject_email, $email_body);
                        endif;
                        $receiver_lv1 = getValue('user_app_lv1', 'users_cuti', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv1)):
                            $this->approval->not_approve('cuti', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                        if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), $subject_email, $email_body);
                        endif;
                    break;
                }
            }
            
            $this->cek_all_approval($id);
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
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
        $user_id = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $user_nik = get_nik($user_id);
        $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
        $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
       
        return $this->load->view('form_cuti/cuti_email', $this->data, true);
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
        
        $user_nik = get_nik(getValue('user_id','users_cuti', array('id' => 'where/'.$id)));
        // Start date
         $date = getValue('date_mulai_cuti','users_cuti', array('id' => 'where/'.$id));
         // End date
         $end_date = getValue('date_selesai_cuti','users_cuti', array('id' => 'where/'.$id));
         
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
        $sisa_cuti = $this->get_sisa_cuti($user_nik)['sisa_cuti'] - $jml_hari_cuti;

        $this->update_sisa_cuti($recid, $sisa_cuti);
    }

    function form_cuti_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }


        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_cuti', array('id'=>'where/'.$id));
        $user_nik = get_nik($user_id);

        $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
        $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Cuti-'.get_name($user_id);

        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('cuti_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
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
        $leaveid = substr($leave_request_id[0]['IDLEAVEREQUEST'],2)+1;
        $leaveid = sprintf('%06d', $leaveid);
        $IDLEAVEREQUEST = 'CT'.$leaveid;
        $RECVERSION = $leave_request_id[0]['RECVERSION']+1;
        $RECID = $leave_request_id[0]['RECID']+1;
        $remarks = str_replace(' ', '-', $data['remarks']);
        $alamat_cuti = str_replace(' ', '-', $data['alamat_cuti']);
        $phone = str_replace(' ', '-', $data['contact']);
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
               '/STATUSFLAG/'.'3'.
               '/IDPERSONSUBSTITUTE/'.$data['user_pengganti'].
               '/TRAVELLINGLOCATION/'.$alamat_cuti.
               '/MODIFIEDDATETIME/'.$data['created_on'].
               '/MODIFIEDBY/'.$data['created_by'].
               '/CREATEDDATETIME/'.$data['created_on'].
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
            return true;
        }     
        else  
        {  
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
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_cuti/input')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

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
                    $this->template->add_js('purl.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_cuti_approval.js');

                    
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
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_demolition extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');

        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_demolition/form_demolition_model','form_demolition_model');

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
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
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('creator.username'=>$ftitle_re,'users.username'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_demolition  
            $this->data['form_demolition_all'] = $this->form_demolition_model->like($ftitle_post)->where('is_deleted',0)->form_demolition()->result();
            
            $this->data['num_rows_all'] = $this->form_demolition_model->like($ftitle_post)->where('is_deleted',0)->form_demolition()->num_rows();

            $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_demolition()->result();//lastq();
            $this->data['_num_rows'] = $this->form_demolition_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_demolition()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_demolition/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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

            $this->_render_page('form_demolition/index', $this->data);
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

            redirect('form_demolition/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->get_bu();
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->get_user_atasan();

            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_demolition/input', $this->data);
        }
    }

    function detail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
           
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $user_id = getValue('user_id', 'users_demolition', array('id'=>'where/'.$id));
            $this->data['user_nik'] = get_nik($user_id);
            $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id)->result();
            $this->data['_num_rows'] = $this->form_demolition_model->form_demolition($id)->num_rows();

            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->_render_page('form_demolition/detail', $this->data);
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
                $additional_data = array(
                    'old_bu'       => $this->input->post('old_bu'),
                    'old_org'     => $this->input->post('old_org'),
                    'old_pos'           => $this->input->post('old_pos'),
                    'new_bu'        => $this->input->post('bu'),
                    'new_org'        => $this->input->post('org'),
                    'new_pos'           => $this->input->post('pos'),
                    'date_demolition'           => date('Y-m-d',strtotime($this->input->post('date_demolition'))),
                    'alasan'           => $this->input->post('alasan'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                if ($this->form_validation->run() == true && $this->form_demolition_model->create_($user_id, $additional_data))
                {
                     $demolition_id = $this->db->insert_id();
                     $user_app_lv1 = getValue('user_app_lv1', 'users_demolition', array('id'=>'where/'.$demolition_id));
                     $isi_email = get_name($user_id).' mengajukan Permohonan demolition, untuk melihat detail silakan <a href='.base_url().'form_demolition/detail/'.$demolition_id.'>Klik Disini</a><br />';

                     if(!empty($user_app_lv1)){
                        $this->approval->request('lv1', 'demolition', $demolition_id, $user_id, $this->detail_email($demolition_id));
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Permohonan Demosi', $isi_email);
                     }else{
                        $this->approval->request('hrd', 'demolition', $demolition_id, $user_id, $this->detail_email($demolition_id));
                        if(!empty(getEmail($this->approval->approver('demosi'))))$this->send_email(getEmail($this->approval->approver('demosi')), 'Pengajuan Permohonan Demosi', $isi_email);
                     }

                     $this->send_user_notification($demolition_id, $user_id);
                     redirect('form_demolition', 'refresh');
                    //echo json_encode(array('st' =>1, 'demolition_url' => $demolition_url));    
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

            $data = array(
            'is_app_'.$type => 1, 
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $approval_status = $this->input->post('app_status_'.$type);

            $is_app = getValue('is_app_'.$type, 'users_demolition', array('id'=>'where/'.$id));
            $approval_status = $this->input->post('app_status_'.$type);

            $this->form_demolition_model->update($id,$data);

            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $user_demolition_id = getValue('user_id', 'users_demolition', array('id'=>'where/'.$id));
            $isi_email = 'Status pengajuan demolition anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_demolition/detail/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_demolition_id).' mengajukan Permohonan demolition, untuk melihat detail silakan <a href='.base_url().'form_demolition/detail/'.$id.'>Klik Disini</a><br />';
            
            if($is_app==0){
                $this->approval->approve('demolition', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_demolition_id)))$this->send_email(getEmail($user_demolition_id), 'Status Pengajuan Permohonan Demosi dari Atasan', $isi_email);
            }else{
                $this->approval->update_approve('demolition', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_demolition_id)))$this->send_email(getEmail($user_demolition_id), 'Perubahan Status Pengajuan Permohonan Demosi dari Atasan', $isi_email);
            }
            if($type !== 'hrd'){
                $lv = substr($type, -1)+1;
                $lv_app = 'lv'.$lv;
                $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_demolition', array('id'=>'where/'.$id)):0;
                if(!empty($user_app)){
                    $this->approval->request($lv_app, 'demolition', $id, $user_demolition_id, $this->detail_email($id));
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Permohonan Demosi', $isi_email_request);
                }else{
                    $this->approval->request('hrd', 'demolition', $id, $user_demolition_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('demosi'))))$this->send_email(getEmail($this->approval->approver('demosi')), 'Pengajuan Permohonan Demosi', $isi_email_request);
                }
            }
            redirect('form_demolition/detail/'.$id, 'refresh');
        }
    }


    function send_user_notification($id, $user_id)
    {
        $url = base_url().'form_demolition/detail/'.$id;
        $pengaju_id = $this->session->userdata('user_id');

        //Notif to karyawan
             $data4 = array(
                    'sender_id' => get_nik($pengaju_id),
                    'receiver_id' => get_nik($user_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan demolition Karyawan',
                    'email_body' => get_name($pengaju_id).' mengajukan demolition untuk Anda, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data4);
    }

    function detail_email($id)
    {
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_demolition', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id)->result();
        $this->data['_num_rows'] = $this->form_demolition_model->form_demolition($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        return $this->load->view('form_demolition/demolition_mail', $this->data, TRUE);
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
    
    function get_user_atasan()
    {
        $id = $this->session->userdata('user_id');
        $url = get_api_key().'users/superior/EMPLID/'.get_nik($id).'/format/json';
        $url_atasan_satu_bu = get_api_key().'users/atasan_satu_bu/EMPLID/'.get_nik($id).'/format/json';
        $headers = get_headers($url);
        $headers2 = get_headers($url_atasan_satu_bu);
        $response = substr($headers[0], 9, 3);
        $response2 = substr($headers2[0], 9, 3);
        if ($response != "404") {
            $get_atasan = file_get_contents($url);
            $atasan = json_decode($get_atasan, true);
            return $this->data['user_atasan'] = $atasan;
        }elseif($response == "404" && $response2 != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
           $atasan = json_decode($get_atasan, true);
           return $this->data['user_atasan'] = $atasan;
        }else{
            return $this->data['user_atasan'] = '- Karyawan Tidak Memiliki Atasan -';
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
    function form_demolition_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
           
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_demolition', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id)->result();
        $this->data['_num_rows'] = $this->form_demolition_model->form_demolition($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->data['id'] = $id;
            $title = $this->data['title'] = 'Form Pengajuan Demolition-'.get_name($user_id);
            $this->load->library('mpdf60/mpdf');
            $html = $this->load->view('demolition_pdf', $this->data, true); 
            $mpdf = new mPDF();
            $mpdf = new mPDF('A4');
            $mpdf->WriteHTML($html);
            $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
    }

    function send_email($email, $subject, $isi_email)
    {

        $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'mail.erlangga.co.id',
                    'smtp_port' => 587,
                    'smtp_user' => 'ax.hrd@erlangga.co.id', 
                    'smtp_pass' => 'erlangga', 
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                    );
 
       $this->load->library('email', $config);
       $this->email->set_newline("\r\n");  
       $this->email->from('ax.hrd@erlangga.co.id', 'HRIS-Erlangga');
       $this->email->to($email);
       $this->email->subject($subject);
       $this->email->message($isi_email);
     
         if($this->email->send())
         {
           return true;
           //return $this->email->print_debugger();
         }
         else
         {
          return false;
          //return $this->email->print_debugger();
         }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_demolition/index')))
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
                elseif(in_array($view, array('form_demolition/input',
                                             'form_demolition/detail',)))
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
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_demolition.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
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
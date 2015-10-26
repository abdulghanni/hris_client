<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_kontrak extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_kontrak/form_kontrak_model','form_kontrak_model');

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = "Form kontrak";
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

            //list of filterize all form_kontrak  
            $this->data['form_kontrak_all'] = $this->form_kontrak_model->like($ftitle_post)->where('is_deleted',0)->form_kontrak()->result();
            
            $this->data['num_rows_all'] = $this->form_kontrak_model->like($ftitle_post)->where('is_deleted',0)->form_kontrak()->num_rows();

            $form_kontrak = $this->data['form_kontrak'] = $this->form_kontrak_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_kontrak()->result();
            $this->data['_num_rows'] = $this->form_kontrak_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_kontrak()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_kontrak/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/kontrak'));

            $this->_render_page('form_kontrak/index', $this->data);
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

            redirect('form_kontrak/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function input()
    {
        $this->data['title'] = "Input - Form kontrak";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->data['lama'] = getAll('lama_kontrak', array('is_deleted' => 'where/0'));
            //$this->get_user_atasan();
            $this->get_user_atasan();

            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_kontrak/input', $this->data);
        }
    }

    function detail($id)
    {
        $this->data['title'] = "Detail - Form kontrak";
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
           $this->data['id'] = $id;
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $form_kontrak = $this->data['form_kontrak'] = $this->form_kontrak_model->form_kontrak($id)->result();
            $this->data['_num_rows'] = $this->form_kontrak_model->form_kontrak($id)->num_rows();
            $lama_id = getValue('lama_kontrak', 'users_kontrak', array('id'=>'where/'.$id));
            $this->data['lama'] = getValue('title', 'lama_kontrak', array('id'=>'where/'.$lama_id));
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->_render_page('form_kontrak/detail', $this->data);
        }
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            //$this->form_validation->set_rules('alasan', 'Alasan Pengangkatan', 'trim|required');
            $this->form_validation->set_rules('date_kontrak', 'Tanggal Pengangkatan', 'trim|required');
            
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

                if ($this->form_validation->run() == true && $this->form_kontrak_model->create_($user_id, $additional_data))
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
            $approval_status = $this->input->post('app_status_'.$type);

            $this->form_kontrak_model->update($id,$data);
           
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
               if(!empty($user_app)){
                    $this->approval->request($lv_app, 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                }else{
                    $this->approval->request('hrd', 'kontrak', $id, $user_kontrak_id, $this->detail_email($id));
                    if(!empty(getEmail($this->approval->approver('kontrak'))))$this->send_email(getEmail($this->approval->approver('kontrak')), $subject_email_request, $isi_email_request);
                }
            }elseif($type == 'hrd' && $approval_status == 1){
                $this->send_user_notification($id, $user_kontrak_id);
            }else{
                $email_body = "Status pengajuan Perpanjangan kontrak yang diajukan oleh ".get_name($user_kontrak_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_kontrak/detail/'.$id.'>Klik Disini</a><br />';
                $form = 'kontrak';
                switch($type){
                case 'lv1':
                    //$this->approval->not_approve('kontrak', $id, )
                break;

                case 'lv2':
                    $receiver_id = getValue('user_app_lv1', 'users_'.$form, array('id'=>'where/'.$id));
                    $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
                break;

                case 'lv3':
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

            redirect('form_kontrak/detail/'.$id, 'refresh');
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
        $this->data['id'] = $id;
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = get_nik($sess_id);
        $form_kontrak = $this->data['form_kontrak'] = $this->form_kontrak_model->form_kontrak($id)->result();
        $this->data['_num_rows'] = $this->form_kontrak_model->form_kontrak($id)->num_rows();
        $lama_id = getValue('lama_kontrak', 'users_kontrak', array('id'=>'where/'.$id));
        $this->data['lama'] = getValue('title', 'lama_kontrak', array('id'=>'where/'.$lama_id));

        return $this->load->view('form_kontrak/kontrak_mail', $this->data, TRUE);
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
            $result['0']= '- Pilih Unit Bisnis Baru -';
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
           $result['-']= '- Belum Ada Departement -';
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

    function form_kontrak_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }  
        
        $user_id = $this->data['user_id'] = getValue('user_id', 'users_kontrak', array('id'=>'where/'.$id));
        $form_kontrak = $this->data['form_kontrak'] = $this->form_kontrak_model->form_kontrak($id)->result();
        $this->data['_num_rows'] = $this->form_kontrak_model->form_kontrak($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Pengajuan kontrak-'.get_name($user_id);
        $creator = getValue('created_by', 'users_kontrak', array('id'=>'where/'.$id));
        $creator = get_nik($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
       
        $lama_id = getValue('lama_kontrak', 'users_kontrak', array('id'=>'where/'.$id));
        $this->data['lama'] = getValue('title', 'lama_kontrak', array('id'=>'where/'.$lama_id));
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('kontrak_pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            10, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($id.'-'.$title.'.pdf', 'I');
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
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_kontrak/input',
                                             'form_kontrak/detail',)))
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
                    $this->template->add_js('form_kontrak.js');
                    
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
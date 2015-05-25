<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_training extends MX_Controller {

  public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
    $this->load->model('person/person_model','person_model');
        $this->load->model('form_training/form_training_model','form_training_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        
    }

    function index()
    { 
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            if(is_admin()){
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training_admin();
            }else{
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training();
            }
            $this->_render_page('form_training/index', $this->data);
        }
    }

    function detail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            if(is_admin()){
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training_admin($id);
            }else{
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training($id);
            }
			
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_training')->row('user_id');
			if($form_training->num_rows>0){
                $this->get_app_name($id);
            }
			
            $this->get_user_info($user_id);
            $this->_render_page('form_training/detail', $this->data);
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        

        $this->data['user_name'] = $this->form_training_model->get_app_name($sess_id);
        $form_training = $this->data['training'] = $this->form_training_model->form_training($sess_id);

        $this->get_user_info($sess_id);
        $this->data['all_users'] = getAll('users');


        $this->_render_page('form_training/input', $this->data);
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
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $user_id= $this->input->post('emp');

                $data = array(
                    'user_id' => $user_id,
                    'id_comp_session' => 1,
                    'training_name' => $this->input->post('training_name'),
                    'tujuan_training' => $this->input->post('tujuan_training'),
                    'tanggal'            => date('Y-m-d',strtotime('now')),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $user_id
                    );

                $num_rows = $this->form_training_model->form_training_admin()->num_rows();

                if($num_rows>0){
                    $training_id = $this->db->select('id')->order_by('id', 'asc')->get('users_training')->last_row();
                    $training_id = $training_id->id+1;
                }else{
                    $training_id = 1;
                }

                    if ($this->form_validation->run() == true && $this->form_training_model->add($data))
                    {
                        $this->send_approval_request($training_id, $user_id);
                        echo json_encode(array('st' =>1));     
                    }
            }

        }
    }

    function approval_spv($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_training_id = $this->db->select('user_id')->from('users_training')->where('id', $id)->get()->row('user_id');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_training')->row('user_id');
            
            $this->get_user_info($user_id);
            if(is_admin()){
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training_admin($id);
            }else{
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training($id);
            }
            if($form_training->num_rows>0){
                $this->get_app_name($id);
            }

            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_training/approval/supervisor', $this->data);
        }

        
    }

    function approval_hrd($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_training_id = $this->db->select('user_id')->from('users_training')->where('id', $id)->get()->row('user_id');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_training')->row('user_id');
            
            $this->get_user_info($user_id);
            if(is_admin()){
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training_admin($id);
            }else{
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training($id);
            }
            $this->data['penyelenggara'] = GetAll('penyelenggara');
            $this->data['pembiayaan'] = GetAll('pembiayaan');
            if($form_training->num_rows>0){
                $this->get_app_name($id);
            }

            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_training/approval/hrd', $this->data);
        }

    }

    function do_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv1' => 1, 
        'user_app_lv1' => $user_id,
        'approval_status_id_lv1' => 1,  
        'date_app_lv1' => $date_now);

        $approval_status = 1;

       if ($this->form_training_model->update($id,$data)) {
           $this->approval_mail($id, $approval_status,'spv', 'Supervisor');
           return TRUE;
       }
    }

    function not_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv1' => 1, 
        'user_app_lv1' => $user_id,
        'approval_status_id_lv1' => $this->input->post('app_status'),
        'note_app_lv1' => $this->input->post('note_spv'), 
        'date_app_lv1' => $date_now);

        $approval_status = $this->input->post('app_status');

        $this->form_training_model->update($id,$data);
        $this->approval_mail($id, $approval_status,'spv', 'Supervisor');
        redirect('form_training/approval_spv/'.$id, 'refresh');
       
    }

    function do_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'penyelenggara_id' => $this->input->post('penyelenggara'),
        'pembiayaan_id' => $this->input->post('pembiayaan'),
        'besar_biaya' => $this->input->post('besar_biaya'),
        'tempat' => $this->input->post('tempat'),
        'tanggal'=> date('Y-m-d',strtotime($this->input->post('tanggal'))),
        'jam'   => $this->input->post('jam'),
        'is_app_lv2' => 1, 
        'user_app_lv2' => $user_id,
        'approval_status_id_lv2' => 1, 
        'date_app_lv2' => $date_now);

        $approval_status = 1;
        if ($this->form_training_model->update($id,$data)) {
        $this->approval_mail($id, $approval_status,'hrd', 'HRD');
           return TRUE;
       }
    }

    function not_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv2' => 1, 
        'user_app_lv2' => $user_id,
        'approval_status_id_lv2' => $this->input->post('app_status'),
        'note_app_lv2' => $this->input->post('note_hrd'), 
        'date_app_lv2' => $date_now);

        $approval_status = $this->input->post('app_status');
        $this->form_training_model->update($id,$data);
        $this->approval_mail($id, $approval_status,'hrd', 'HRD');
        redirect('form_training/approval_hrd/'.$id, 'refresh');
       
    }

    public function update_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $additional_data = array(
        'penyelenggara_id' => $this->input->post('penyelenggara_update'),
        'pembiayaan_id' => $this->input->post('pembiayaan_update'),
        'besar_biaya' => $this->input->post('besar_biaya_update'),
        'tempat' => $this->input->post('tempat_update'),
        'tanggal'=> date('Y-m-d',strtotime($this->input->post('tanggal_update'))),
        'jam'   => $this->input->post('jam_update'),
        'is_app_lv2' => 1,
        'approval_status_id_lv2' => $this->input->post('app_status_update'),
        'note_app_lv2' => $this->input->post('note_hrd_update'), 
        'user_app_lv2' => $user_id, 
        'date_app_lv2' => $date_now);

        $approval_status = $this->input->post('app_status_update');

        $this->form_training_model->update($id,$additional_data);
        $this->approval_mail($id, $approval_status,'hrd', 'HRD');

        redirect('form_training/approval_hrd/'.$id, 'refresh');
       
    }

    function send_approval_request($id, $user_id)
    {
        $url = base_url().'form_training/approval_';
        if(is_have_superior($user_id))
        {
            $data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => get_superior($user_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Training',
                    'email_body' => get_name($user_id).' mengajukan permohonan pelatihan, untuk melihat detail silakan <a href='.$url.'spv/'.$id.'>Klik Disini</a>',
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        }else{
        $current_superior = 0;
        }

        $data = array(
                'sender_id' => get_nik($user_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Training',
                'email_body' => get_name($user_id).' mengajukan permohonan training, untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id, $approval_status, $type_url, $type)
    {
        $url = base_url().'form_training/approval_'.$type_url.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_training')->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Training dari '.$type,
                'email_body' => "Status pengajuan permohonan training anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a>",
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }


    function get_app_name($id)
    {
        $form_training = $this->form_training_model->form_training_admin($id);
        foreach($form_training->result() as $training){
            $user_app_lv1 = $training->user_app_lv1;
            $user_app_lv2 = $training->user_app_lv2;
        }

        $this->data['name_app_lv1'] = $this->form_training_model->get_app_name($user_app_lv1);
        $this->data['name_app_lv2'] = $this->form_training_model->get_app_name($user_app_lv2);

        return $this->data;
    }

    function get_user_info($user_id)
    {
        $user = $this->person_model->getUsers($user_id)->row();
            $url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $this->data['user_info'] = $user_info;
            } else {
                return $this->data['user_info'] = '';
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

    public function get_emp_nik()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $pos_nm = $user_info['EMPLID'];
            } else {
                $pos_nm = '';
            }

        echo $pos_nm;
    }

     function form_training_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_training')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_training_model->render_session()->result();
            
            if(is_admin()){
                $form_training = $this->data['form_training'] = $this->form_training_model->form_training_admin($id);
            }else{
            $form_training = $this->data['form_training'] = $this->form_training_model->form_training($id);
            }


        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form training-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('training_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_training/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    //$this->template->add_js('form_training.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_training/input',
                                             'form_training/detail',
                                             'form_training/approval/hrd',
											 'form_training/approval/supervisor',
                    )))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    
                    $this->template->add_js('purl.js');
                    $this->template->add_js('jquery.maskMoney.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_training.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
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
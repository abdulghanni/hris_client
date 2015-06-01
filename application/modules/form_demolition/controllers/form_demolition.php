<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_demolition extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_demolition/form_demolition_model','form_demolition_model');

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->data['sess_id'] = get_nik($this->session->userdata('user_id')); 
            if(is_admin()){
                $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition_admin();
            }else{
                $this->data['form_demolition'] = $this->form_demolition_model->form_demolition();
            }

            $this->_render_page('form_demolition/index', $this->data);
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
            $this->get_user_info();
            $this->get_bu();


            $this->data['all_users'] = getAll('users', array('active'=>'where/1'));
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_demolition/input', $this->data);
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->form_validation->set_rules('alasan', 'Alasan Pengangkatan', 'trim|required');
            $this->form_validation->set_rules('syarat', 'Memenuhi Syarat', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $user_id = $this->input->post('emp');
                $additional_data = array(
                    'user_id'       => $user_id,
                    'id_comp_session'       => 1,
                    'memenuhi_syarat'     => $this->input->post('syarat'),
                    'alasan_demolition'           => $this->input->post('alasan'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $num_rows = $this->form_demolition_model->form_demolition_admin()->num_rows();

                if($num_rows>0){
                    $demolition_id = $this->db->select('id')->order_by('id', 'asc')->get('users_demolition')->last_row();
                    $demolition_id = $demolition_id->id;
                }else{
                    $demolition_id = 0;
                }
                
                $demolition_id = $demolition_id+1;

                if ($this->form_validation->run() == true && $this->form_demolition_model->add($additional_data))
                {
                    $demolition_url = base_url().'form_demolition';
                    $this->send_approval_request($demolition_id, $user_id);
                    echo json_encode(array('st' =>1, 'demolition_url' => $demolition_url));    
                }
            }
        }
    }

    function detail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->data['sess_id'] = $this->session->userdata('user_id');
            if(is_admin()){
                $this->data['form_demolition'] = $this->form_demolition_model->form_demolition_admin($id);
            }else{
                $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id);
            }

            $user_id = getAll('users_demolition', array('id' => 'where/'.$id))->row('user_id');
            $this->get_user_info($user_id);
            $this->_render_page('form_demolition/detail', $this->data);
        }
    }

    function approval_hrd($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->data['sess_id'] = $this->session->userdata('user_id');
            if(is_admin()){
                $this->data['form_demolition'] = $this->form_demolition_model->form_demolition_admin($id);
            }else{
                $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id);
            }

            $user_id = getAll('users_demolition', array('id' => 'where/'.$id))->row('user_id');
            $this->get_user_info($user_id);
            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_demolition/approval', $this->data);
        }
    }

    function do_approve($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $data = array(
                    'is_app' => 1,
                    'app_status_id' => $this->input->post('app_status'),
                    'user_app' => $this->session->userdata('user_id'),
                    'date_app' => date('Y-m-d',strtotime('now')),
                    'note_hrd'=> $this->input->post('note'),
                );
            $approval_status = $this->input->post('app_status');
            if($this->form_demolition_model->update($id, $data))
            {
                $this->approval_status_mail($id, $approval_status);
                redirect('form_demolition/approval_hrd/'.$id, 'refresh');
            }
        }
    }

    function send_approval_request($id, $user_id)
    {
        $sender_id= $this->session->userdata('user_id');
        $url = base_url().'form_demolition/approval_';
        
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permohonan Demolition',
                'email_body' => get_name($sender_id).' mengajukan permohonan demolition untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        $this->data['sess_id'] = $this->session->userdata('user_id');
        if(is_admin()){
            $this->data['form_demolition'] = $this->form_demolition_model->form_demolition_admin($id);
        }else{
            $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id);
        }

        $user_id = getAll('users_demolition', array('id' => 'where/'.$id))->row('user_id');
        $this->get_user_info($user_id);
        return $this->load->view('form_demolition/demolition_mail', $this->data, TRUE);
    }

    function approval_status_mail($id, $approval_status)
    {
        $url = base_url().'form_demolition/approval_hrd/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_demolition')->row('created_by');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Demolition dari HRD',
                'email_body' => "Status pengajuan permohonan demolition anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function get_user_info($user_id = null)
    {   
        if($user_id != null){
            $user_id = get_nik($user_id);
        }else{
        $user_id = get_nik($this->session->userdata('user_id'));
        }
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $this->data['user_info'] = $user_info;
            } else {
                $this->data['user_info'] = '';
            }
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

    public function get_emp_sen_date()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $date = $user_info['SENIORITYDATE'];
            } else {
                $date = '';
            }

        echo dateIndo($date);
    }

    function form_demolition_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_demolition')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_demolition_model->render_session()->result();
            
            if(is_admin()){
                $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition_admin($id);
            }else{
            $form_demolition = $this->data['form_demolition'] = $this->form_demolition_model->form_demolition($id);
            }


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

                if(in_array($view, array('form_demolition/index')))
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

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_demolition.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_demolition/input',
                                             'form_demolition/detail',)))
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

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_demolition.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_demolition/approval')))
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

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_demolition.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
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
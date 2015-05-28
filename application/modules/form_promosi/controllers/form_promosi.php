<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_promosi extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_promosi/form_promosi_model','form_promosi_model');

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

            if(is_admin()){
                $form_promosi = $this->data['form_promosi'] = $this->form_promosi_model->form_promosi_admin();
            }else{
                $this->data['form_promosi'] = $this->form_promosi_model->form_promosi();
            }

            $this->_render_page('form_promosi/index');
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
            $this->get_user_info();
            $this->get_bu();


            $this->data['all_users'] = getAll('users', array('active'=>'where/1'));
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->_render_page('form_promosi/input', $this->data);
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
                $this->data['form_promosi'] = $this->form_promosi_model->form_promosi_admin($id);
            }else{
                $this->data['form_promosi'] = $this->form_promosi_model->form_promosi($id);
            }

            $user_id = getAll('users_promosi', array('id' => 'where/'.$id))->row('user_id');
            $this->get_user_info($user_id);
            $this->_render_page('form_promosi/detail', $this->data);
        }
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->form_validation->set_rules('alasan', 'Alasan Pengangkatan', 'trim|required');
            $this->form_validation->set_rules('date_promosi', 'Tanggal Pengangkatan', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $user_id = $this->input->post('emp');
                $additional_data = array(
                    'user_id'       => $user_id,
                    'old_bu'       => $this->input->post('old_bu'),
                    'old_org'     => $this->input->post('old_org'),
                    'old_pos'           => $this->input->post('old_pos'),
                    'new_bu'        => $this->input->post('bu'),
                    'new_org'        => $this->input->post('org'),
                    'new_pos'           => $this->input->post('pos'),
                    'date_promosi'           => date('Y-m-d',strtotime($this->input->post('date_promosi'))),
                    'alasan'           => $this->input->post('alasan'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $num_rows = $this->form_promosi_model->form_promosi()->num_rows();

                if($num_rows>0){
                    $promosi_id = $this->db->select('id')->order_by('id', 'asc')->get('users_promosi')->last_row();
                    $promosi_id = $promosi_id->id;
                }else{
                    $promosi_id = 0;
                }
                
                $promosi_id = $promosi_id+1;

                if ($this->form_validation->run() == true && $this->form_promosi_model->add($additional_data))
                {
                    $promosi_url = base_url().'form_promosi';
                    $this->send_approval_request($promosi_id, $user_id);
                    echo json_encode(array('st' =>1, 'promosi_url' => $promosi_url));    
                }
            }
        }
    }

    function approval_hrd($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $user_id = $this->db->where('id', $id)->get('users_promosi')->row('user_id');
            $this->data['sess_id'] = $this->session->userdata('user_id');
            if(is_admin()){
                $this->data['form_promosi'] = $this->form_promosi_model->form_promosi_admin($id);
            }else{
                $this->data['form_promosi'] = $this->form_promosi_model->form_promosi($id);
            }
            $this->get_user_info($user_id);
            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_promosi/approval/hrd', $this->data);
        }
    }

    function do_approve_hrd($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $data = array(
                    'approval_status_id' => 1,
                    'is_approved' => 1,
                    'user_approved' => $this->session->userdata('user_id'),
                    'date_approved' => date('Y-m-d',strtotime('now')),
                );
			$approval_status = 1;
            if($this->form_promosi_model->do_approve_hrd($id, $data))
            {
				$this->approval_status_mail($id, $approval_status);
                redirect('form_promosi/approval_hrd/'.$id, 'refresh');
            }
        }
    }

    function update_approve_hrd($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $data = array(
                    'approval_status_id' => $this->input->post('app_status'),
                    'note_hrd'     => $this->input->post('note_hrd'),
                    'is_approved' => 1,
                    'user_approved' => $this->session->userdata('user_id'),
                    'date_approved' => date('Y-m-d',strtotime('now')),
                );

            $approval_status = $this->input->post('app_status');

            if($this->form_promosi_model->do_approve_hrd($id, $data))
            {
                $this->approval_status_mail($id, $approval_status);
                redirect('form_promosi/approval_hrd/'.$id, 'refresh');
            }
        }
    }

    function send_approval_request($id, $user_id)
    {
        $sender_id= $this->session->userdata('user_id');
        $url = base_url().'form_promosi/approval_';
        
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permohonan Promosi',
                'email_body' => get_name($sender_id).' mengajukan permohonan promosi untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_status_mail($id, $approval_status)
    {
        $url = base_url().'form_promosi/approval_hrd/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_promosi')->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan promosi dari HRD',
                'email_body' => "Status pengajuan permohonan promosi anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        $this->data['sess_id'] = $this->session->userdata('user_id');
        if(is_admin()){
            $this->data['form_promosi'] = $this->form_promosi_model->form_promosi_admin($id);
        }else{
            $this->data['form_promosi'] = $this->form_promosi_model->form_promosi($id);
        }

        $user_id = getAll('users_promosi', array('id' => 'where/'.$id))->row('user_id');
        $this->get_user_info($user_id);
        return $this->load->view('form_promosi/promosi_mail', $this->data, TRUE);
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

    function get_emp_by_pos($posid)
    {
        
        $url = get_api_key().'users/employee_by_pos/POSID/'.$posid.'/format/json';
        //print_mz($url);
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

    function form_promosi_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_promosi')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_promosi_model->render_session()->result();
            
            if(is_admin()){
                $form_promosi = $this->data['form_promosi'] = $this->form_promosi_model->form_promosi_admin($id);
            }else{
            $form_promosi = $this->data['form_promosi'] = $this->form_promosi_model->form_promosi($id);
            }


        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Pengajuan Promosi-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('promosi_pdf', $this->data, true); 
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

                if(in_array($view, array('form_promosi/index')))
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
                    $this->template->add_js('form_promosi.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_promosi/input',
                                             'form_promosi/detail',)))
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
                    $this->template->add_js('form_promosi.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_promosi/approval/hrd')))
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
                    $this->template->add_js('form_promosi.js');

                    
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
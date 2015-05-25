<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_resignment extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_resignment/form_resignment_model','form_resignment_model');
    
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
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment_admin();
            }else{
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment();
            }

            $this->_render_page('form_resignment/index');
        }
    }

    function input()
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['all_users'] = getAll('users', array('active'=>'where/1'));
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted'=>'where/0'));

        $this->_render_page('form_resignment/input', $this->data);
    }

    function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_resign' , 'Tanggal Akhir Kerja', 'trim|required');
            $this->form_validation->set_rules('alasan_resign_id' , 'Alasan berhenti kerja', 'trim|required');
            $this->form_validation->set_rules('desc_resign' , 'Alasan utama berhenti kerja', 'trim|required');
            $this->form_validation->set_rules('procedure_resign' , 'Prosedur perusahaan', 'trim|required');
            $this->form_validation->set_rules('kepuasan_resign' , 'Hal yang memuaskan', 'trim|required');
            $this->form_validation->set_rules('saran_resign' , 'Saran', 'trim|required');
            $this->form_validation->set_rules('rework_resign' , 'Pertimbangan Kembali', 'trim|required');

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
                    'date_resign' => date('Y-m-d',strtotime($this->input->post('date_resign'))),
                    'alasan_resign_id' => $this->input->post('alasan_resign_id'),
                    'desc_resign'            => $this->input->post('desc_resign'),
                    'procedure_resign'            => $this->input->post('procedure_resign'),
                    'kepuasan_resign'            => $this->input->post('kepuasan_resign'),
                    'saran_resign'            => $this->input->post('saran_resign'),
                    'rework_resign'            => $this->input->post('rework_resign'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id'),
                    );

                $num_rows = getAll('users_resignment')->num_rows();

                if($num_rows>0){
                    $resignment_id = getAll('users_resignment')->last_row();
                    $resignment_id = $resignment_id->id+1;
                }else{
                    $resignment_id = 1;
                }

                    if ($this->form_validation->run() == true && $this->form_resignment_model->add($data))
                    {
                        $this->send_approval_request($resignment_id, $user_id);
                        echo json_encode(array('st' =>1));     
                    }
            }
        }
    }

    function detail($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

            if(is_admin()){
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment_admin($id);
            }else{
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);
            }

            $this->get_user_info($form_resignment->row('user_id'));
            $this->_render_page('form_resignment/detail', $this->data);
        }
    }

    function approval_hrd($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

            if(is_admin()){
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment_admin($id);
            }else{
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);
            }

            $this->get_user_info($form_resignment->row('user_id'));
            $this->_render_page('form_resignment/approval/hrd', $this->data);
        }
    }

    function do_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app' => 1, 
        'user_app' => $user_id, 
        'date_app' => $date_now,
        'note_hrd' => $this->input->post('note_hrd'),
        );

       if ($this->form_resignment_model->update($id,$data)) {
           $this->approval_mail($id);
           return TRUE;
       }
    }

    function send_approval_request($id, $user_id)
    {
        $url = base_url().'form_resignment/approval_';
        
        $data = array(
                'sender_id' => get_nik($user_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permohonan Resignment',
                'email_body' => get_name($user_id).' mengajukan permohonan resign, untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id)
    {
        $url = base_url().'form_resignment/approval_hrd'.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_resignment')->row('user_id');
        $approval_status = $this->db->where('id', 1)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Resignment dari HRD',
                'email_body' => "Status pengajuan permohonan resignment anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a>",
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function get_user_info($user_id)
    {

        $url = get_api_key().'users/employement/EMPLID/'.get_nik($user_id).'/format/json';
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

    function form_resignment_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_resignment')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_resignment_model->render_session()->result();
            
            if(is_admin()){
                $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment_admin($id);
            }else{
            $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);
            }


        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('resignment_pdf', $this->data, true); 
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

                if(in_array($view, array('form_resignment/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    
                }
                elseif(in_array($view, array('form_resignment/input',
                                             'form_resignment/detail',)))
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
                    $this->template->add_js('form_resignment.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_resignment/approval/hrd')))
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
                    $this->template->add_js('form_resignment.js');

                    
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
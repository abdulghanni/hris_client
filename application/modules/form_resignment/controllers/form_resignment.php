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
            $this->data['session_id'] = $this->session->userdata('user_id');
            
            $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment();

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
            //$this->form_validation->set_rules('alasan_resign_id' , 'Alasan berhenti kerja', 'trim|required');
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
                    'alasan_resign_id' => implode(',',$this->input->post('alasan_resign_id')),
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

            $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);

            $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
            $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
            $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
            $this->get_user_info($form_resignment->row('user_id'));
            $this->_render_page('form_resignment/detail', $this->data);
        }
    }

    function approval($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['session_id'] = $this->session->userdata('user_id');
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);

            $this->get_user_info($form_resignment->row('user_id'));
            $this->_render_page('form_resignment/approval', $this->data);
        }
    }

    function do_approve($type, $id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->session->userdata('user_id');
            $date_now = date('Y-m-d');

            $data = array(
            'is_app_'.$type => 1, 
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $approval_status = $this->input->post('app_status_'.$type);
           if ($this->form_resignment_model->update($id,$data)) {
               $this->approval_mail($id, $approval_status, $type);
               redirect('form_resignment/approval/'.$id, 'refresh');
            }
        }
    }

    function update_approve($type, $id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->session->userdata('user_id');
            $date_now = date('Y-m-d');

            $data = array(
            'is_app_'.$type => 1, 
            'app_status_id_'.$type => $this->input->post('update_app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('update_note_'.$type)
            );
            $approval_status = $this->input->post('update_app_status_'.$type);
           if ($this->form_resignment_model->update($id,$data)) {
               $this->update_approval_mail($id, $approval_status, $type);
               redirect('form_resignment/approval/'.$id, 'refresh');
            }
        }
    }

    function send_approval_request($id, $sender_id)
    {
        $url = base_url().'form_resignment/approval/'.$id;
        if(is_have_superior($sender_id))
        {
            $data = array(
                    'sender_id' => get_nik($sender_id),
                    'receiver_id' => get_superior($sender_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Karyawan Keluar',
                    'email_body' => get_name($sender_id).' mengajukan untuk keluar, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );

            $this->db->insert('email', $data);
            $current_superior = get_id(get_superior($sender_id));
        }else{
        $current_superior = 0;
        }
        
        if(!empty(get_superior($current_superior)))
        {
            $data = array(
                    'sender_id' => get_nik($sender_id),
                    'receiver_id' => get_superior($current_superior),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permintaan SDM Baru',
                    'email_body' => get_name($sender_id).' mengajukan untuk keluar, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        }

       

        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permintaan SDM Baru',
                'email_body' => get_name($sender_id).' mengajukan untuk keluar, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id, $approval_status, $type)
    {
        $url = base_url().'form_resignment/approval/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_resignment', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $type = ($type == 'lv1')? 'Supervisor':(($type == 'lv2')?'Ka. Bagian':'HRD');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Karyawan Keluar '.$type,
                'email_body' => "Status Pengajuan Karyawan Keluar anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function update_approval_mail($id, $approval_status, $type)
    {
        $url = base_url().'form_resignment/approval/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_resignment', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $type = ($type == 'lv1')? 'Supervisor':(($type == 'lv2')?'Ka. Bagian':'HRD');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Karyawan Keluar dari '.$type,
                'email_body' => "$type melakukan perubahan status Pengajuan Karyawan Keluar anda, status pengajuan anda sekarang $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id);

        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
        $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
        $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
        $this->get_user_info($form_resignment->row('user_id'));
        return $this->load->view('form_resignment/resignment_mail', $this->data, TRUE);
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
            $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
            $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
            $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
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
                    $this->template->add_css('approval_img.css');
                     
                }elseif(in_array($view, array('form_resignment/approval')))
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
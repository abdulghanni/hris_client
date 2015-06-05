<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_absen extends MX_Controller {

	public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_absen/form_absen_model','form_absen_model');
        
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
            $sess_id = $this->session->userdata('user_id');

			if(is_admin()){
				$form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin();
			}else{
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen();
			}
            $this->_render_page('form_absen/index', $this->data);
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
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_keterangan_absen')->row('user_id');
            
            $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_absen_model->render_session()->result();
            
            if(is_admin()){
				$form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin($id);
			}else{
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen($id);
			}
            if($form_absen->num_rows>0){
                $this->get_app_name($id);
            }
            
            $this->_render_page('form_absen/detail', $this->data);
        }
    }


     function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id'); 
			$form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin();
            $absen_id = getAll('users_keterangan_absen')->last_row();
			if($form_absen->num_rows > 0){
				$this->data['absen_id'] = $absen_id->id+1;
			}else{
				$this->data['absen_id'] = 1;
			}
            $this->data['username'] = $this->form_absen_model->get_app_name($sess_id);
            $this->data['keterangan_absen'] = $this->form_absen_model->get_keterangan_absen();
            $this->get_user_info($sess_id);
            $this->data['all_users'] = getAll('users');
            
            $this->_render_page('form_absen/input', $this->data);
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
            $this->form_validation->set_rules('date_tidak_hadir', 'Tanggal Tidak Absen', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');

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
                    'date_tidak_hadir' => date('Y-m-d', strtotime($this->input->post('date_tidak_hadir'))),
                    'keterangan_id' => $this->input->post('keterangan'),
                    'alasan' => $this->input->post('alasan'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $user_id
                    );

                $num_rows = getAll('users_keterangan_absen')->num_rows();
                
                if($num_rows>0)
                {    
                    $last_absen_id = getAll('users_keterangan_absen')->last_row();
                    $absen_id = $last_absen_id->id + 1;
                }else{
                    $absen_id = 1;
                } 
                if ($this->form_validation->run() == true && $this->form_absen_model->add($data))
                {
                    $this->send_approval_request($absen_id, $user_id);
                     echo json_encode(array('st' =>1));     
                }
            }

        }
    }

    function approval_spv($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_absen_id = $this->db->select('user_id')->from('users_keterangan_absen')->where('id', $id)->get()->row('user_id');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif(is_authorized($sess_id, $user_absen_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_keterangan_absen')->row('user_id');
            
            $this->get_user_info($user_id);
              if(is_admin()){
				$form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin($id);
			}else{
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen($id);
			}
            if($form_absen->num_rows>0){
                $this->get_app_name($id);
            }

            $this->_render_page('form_absen/approval/supervisor');
        }
    }

    function approval_kbg($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_absen_id = $this->db->select('user_id')->from('users_keterangan_absen')->where('id', $id)->get()->row('user_id');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif(is_authorized($sess_id, $user_absen_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {
            $user_id = $this->db->select('user_id')->where('id', $id)->get('users_keterangan_absen')->row('user_id');
            
            $this->get_user_info($user_id);
            if(is_admin()){
				$form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin($id);
			}else{
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen($id);
			}
            if($form_absen->num_rows>0){
                $this->get_app_name($id);
            }

            $this->_render_page('form_absen/approval/kabagian');
        }
    }

    function do_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv1' => 1, 
        'user_app_lv1' => $user_id, 
        'date_app_lv1' => $date_now);

        $this->approval_mail($id, 1,'spv', 'Supervisor');
       if ($this->form_absen_model->update($id,$data)) {
           return TRUE;
       }

    }

    function do_approve_kbg($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv2' => 1, 
        'user_app_lv2' => $user_id, 
        'date_app_lv2' => $date_now);


        $this->approval_mail($id, 1,'kbg', 'Ka. Bagian');
       if ($this->form_absen_model->update($id,$data)) {
           return TRUE;
       }
    }

    function get_app_name($id)
    {
        $form_absen = $this->form_absen_model->form_absen_admin($id);
        foreach($form_absen->result() as $absen){
            $user_app_lv1 = $absen->user_app_lv1;
            $user_app_lv2 = $absen->user_app_lv2;
        }

        $this->data['name_app_lv1'] = $this->form_absen_model->get_app_name($user_app_lv1);
        $this->data['name_app_lv2'] = $this->form_absen_model->get_app_name($user_app_lv2);

        return $this->data;
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
                return '';
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

    function send_approval_request($id, $user_id)
    {
        $url = base_url().'form_absen/approval_';
        if(is_have_superior($user_id))
        {
            $data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $this->db->where('users.id', $user_id)->get('users')->row('superior_id'),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permohonan Tidak Absen',
                    'email_body' => get_name($user_id).' mengajukan Permohonan Tidak Absen, untuk melihat detail silakan <a href='.$url.'spv/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
            $current_superior = get_id($this->db->where('users.id', $user_id)->get('users')->row('superior_id'));
        }else{
        $current_superior = 0;
        }

        if(!empty(get_superior($current_superior)))
        {
            $data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => get_superior($current_superior),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permohonan Tidak Absen',
                    'email_body' => get_name($user_id).' mengajukan Permohonan Tidak Absen, untuk melihat detail silakan <a href='.$url.'kbg/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        }
    }

    function approval_mail($id, $approval_status, $type_url, $type)
    {
        $url = base_url().'form_absen/approval_'.$type_url.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_keterangan_absen')->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Tidak Absen dari '.$type,
                'email_body' => "Status pengajuan Permohonan Tidak Absen anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
         $user_id = $this->db->select('user_id')->where('id', $id)->get('users_keterangan_absen')->row('user_id');  
         $this->get_user_info($user_id);
        //$this->data['comp_session'] = $this->form_absen_model->render_session()->result();
        
        if(is_admin()){
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin($id);
        }else{
        $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen($id);
        }
        
        return $this->load->view('form_absen/absen_mail', $this->data, TRUE);
    }

    function form_absen_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_keterangan_absen')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->form_absen_model->render_session()->result();
            
            if(is_admin()){
                $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen_admin($id);
            }else{
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->form_absen($id);
            }


        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form absen-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('absen_pdf', $this->data, true); 
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

                if(in_array($view, array('form_absen/index')))
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
                    //$this->template->add_js('form_absen.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_absen/input',
                                             'form_absen/detail',
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

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_absen.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_absen/approval/supervisor',
                                              'form_absen/approval/kabagian',
                                              'form_absen/approval/hr')))
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
                    $this->template->add_js('form_absen.js');

                    
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
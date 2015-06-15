<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_training_group extends MX_Controller {

  public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
    $this->load->model('person/person_model','person_model');
        $this->load->model('form_training_group/form_training_group_model','form_training_group_model');
        
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
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group();

            $this->_render_page('form_training_group/index', $this->data);
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
            $this->data['training_type'] = GetAll('training_type', array('is_deleted' => 'where/0'));
            $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group($id);

            $this->data['penyelenggara'] = GetAll('penyelenggara', array('is_deleted'=>'where/0'));
            $this->data['pembiayaan'] = GetAll('pembiayaan', array('is_deleted'=>'where/0'));
            $user_id = $this->db->select('user_pengaju_id')->where('id', $id)->get('users_training_group')->row('user_pengaju_id');
			
            $this->get_user_info($user_id);
            $this->_render_page('form_training_group/detail', $this->data);
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
        $form_training_group = $this->data['training'] = $this->form_training_group_model->form_training_group($sess_id);

        $this->get_user_info($sess_id);
        $this->data['all_users'] = getAll('users', array('active'=>'where/1'));
        $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));


        $this->_render_page('form_training_group/input', $this->data);
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
                    'user_pengaju_id' => $user_id,
                    'user_peserta_id' => implode(',',$this->input->post('peserta')),
                    'id_comp_session' => 1,
                    'training_name' => $this->input->post('training_name'),
                    'tujuan_training' => $this->input->post('tujuan_training'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id'),
                    );

                $num_rows = getAll('users_training_group', array('is_deleted'=>'where/0'))->num_rows();
                $peserta_id = implode(',',$this->input->post('peserta'));
                $peserta_id = explode(',',$peserta_id);
               
                if($num_rows>0){
                    $training_id = $this->db->select('id')->order_by('id', 'asc')->get('users_training_group')->last_row();
                    $training_id = $training_id->id+1;
                }else{
                    $training_id = 1;
                }

                    if ($this->form_validation->run() == true && $this->form_training_group_model->add($data))
                    {
                        $this->send_approval_request($training_id, $user_id);
                        $this->send_peserta_mail($training_id, $user_id, $peserta_id);
                        echo json_encode(array('st' =>1));     
                    }
            }

        }
    }

    function approval_spv($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_training_id = $this->db->select('user_pengaju_id')->from('users_training_group')->where('id', $id)->get()->row('user_pengaju_id');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->db->select('user_pengaju_id')->where('id', $id)->get('users_training_group')->row('user_pengaju_id');
            
            $this->get_user_info($user_id);
            
            $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group($id);
            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_training_group/approval/supervisor', $this->data);
        }

        
    }

    function approval_hrd($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_training_id = $this->db->select('user_pengaju_id')->from('users_training_group')->where('id', $id)->get()->row('user_pengaju_id');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = $this->db->select('user_pengaju_id')->where('id', $id)->get('users_training_group')->row('user_pengaju_id');
            
            $this->get_user_info($user_id);
            
            $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group($id);
            $this->data['training_type'] = GetAll('training_type', array('is_deleted' => 'where/0'));
            $this->data['penyelenggara'] = GetAll('penyelenggara');
            $this->data['pembiayaan'] = GetAll('pembiayaan');
            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_training_group/approval/hrd', $this->data);
        }

    }

    function do_approve_spv($id)
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

        $this->form_training_group_model->update($id,$data);
        $this->approval_mail($id, $approval_status,'spv', 'Supervisor');
        redirect('form_training_group/approval_spv/'.$id, 'refresh');
       
    }

    function update_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_lv1' => 1, 
        'user_app_lv1' => $user_id,
        'approval_status_id_lv1' => $this->input->post('app_status_update'),
        'note_app_lv1' => $this->input->post('note_spv_update'), 
        'date_app_lv1' => $date_now);

        $approval_status = $this->input->post('app_status_update');

        $this->form_training_group_model->update($id,$data);
        $this->update_approval_mail($id, $approval_status,'spv', 'Supervisor');
        redirect('form_training_group/approval_spv/'.$id, 'refresh');
       
    }

    function do_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $data = array(
        'training_type_id' => $this->input->post('training_type'),
        'penyelenggara_id' => $this->input->post('penyelenggara'),
        'pembiayaan_id' => $this->input->post('pembiayaan'),
        'besar_biaya' => $this->input->post('besar_biaya'),
        'tempat' => $this->input->post('tempat'),
        'narasumber' => $this->input->post('narasumber'),
        'vendor' => $this->input->post('vendor'),
        'tanggal_mulai'=> date('Y-m-d',strtotime($this->input->post('tanggal_mulai'))),
        'tanggal_akhir'=> date('Y-m-d',strtotime($this->input->post('tanggal_akhir'))),
        'lama_training_bulan' => $this->input->post('lama_training_bulan'),
        'lama_training_hari' => $this->input->post('lama_training_hari'),
        'jam_mulai'   => $this->input->post('jam_mulai'),
        'jam_akhir'   => $this->input->post('jam_akhir'),
        'is_app_lv2' => 1, 
        'user_app_lv2' => $user_id,
        'approval_status_id_lv2' => $this->input->post('app_status'), 
        'date_app_lv2' => $date_now,
        'note_app_lv2' => $this->input->post('note_hrd')
        );

        $approval_status = 1;
        if ($this->form_training_group_model->update($id,$data)) {
        $this->approval_mail($id, $approval_status,'hrd', 'HRD');
           return TRUE;
       }
    }

    public function update_approve_hrd($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $additional_data = array(
        'training_type_id' => $this->input->post('training_type_update'),
        'penyelenggara_id' => $this->input->post('penyelenggara_update'),
        'pembiayaan_id' => $this->input->post('pembiayaan_update'),
        'besar_biaya' => $this->input->post('besar_biaya_update'),
        'tempat' => $this->input->post('tempat_update'),
        'narasumber' => $this->input->post('narasumber_update'),
        'vendor' => $this->input->post('vendor_update'),
        'tanggal_mulai'=> date('Y-m-d',strtotime($this->input->post('tanggal_mulai_update'))),
        'tanggal_akhir'=> date('Y-m-d',strtotime($this->input->post('tanggal_akhir_update'))),
        'lama_training_bulan' => $this->input->post('lama_training_bulan_update'),
        'lama_training_hari' => $this->input->post('lama_training_hari_update'),
        'jam_mulai'   => $this->input->post('jam_mulai_update'),
        'jam_akhir'   => $this->input->post('jam_akhir_update'),
        'is_app_lv2' => 1,
        'approval_status_id_lv2' => $this->input->post('app_status_update'),
        'note_app_lv2' => $this->input->post('note_hrd_update'), 
        'user_app_lv2' => $user_id, 
        'date_app_lv2' => $date_now);

        $approval_status = $this->input->post('app_status_update');

        $this->form_training_group_model->update($id,$additional_data);
        $this->update_approval_mail($id, $approval_status,'hrd', 'HRD');

        redirect('form_training_group/approval_hrd/'.$id, 'refresh');
       
    }

    function send_approval_request($id, $user_id)
    {
        $url = base_url().'form_training_group/approval_';
        if(is_have_superior($user_id))
        {
            $data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => get_superior($user_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Training',
                    'email_body' => get_name($user_id).' mengajukan permohonan pelatihan, untuk melihat detail silakan <a href='.$url.'spv/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
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
                'email_body' => get_name($user_id).' mengajukan permohonan training, untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function send_peserta_mail($id, $sender_id, $peserta_id = array())
    {
        $url = base_url().'form_training_group/detail';
        for($i=0;$i<sizeof($peserta_id);$i++):
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => get_nik($peserta_id[$i]),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Training',
                'email_body' => get_name($sender_id).' mengajukan permohonan pelatihan untuk anda, untuk melihat detail silakan <a href='.$url.'/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
        endfor;
    }

    function approval_mail($id, $approval_status, $type_url, $type)
    {
        $url = base_url().'form_training_group/approval_'.$type_url.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_training_group')->row('user_pengaju_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Training dari '.$type,
                'email_body' => "Status pengajuan permohonan training anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function update_approval_mail($id, $approval_status, $type_url, $type)
    {
        $url = base_url().'form_training_group/approval_'.$type_url.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_training_group')->row('user_pengaju_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Permohonan Training dari '.$type,
                'email_body' => "$approver melakukan perubahan Status pengajuan permohonan training anda menjadi $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        
        $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group($id);
        
        $this->data['penyelenggara'] = GetAll('penyelenggara');
        $this->data['pembiayaan'] = GetAll('pembiayaan');
        $user_id = getAll('users_training_group', array('id'=>'where/'.$id))->row('user_pengaju_id');
        $this->get_user_info($user_id);
        return $this->load->view('form_training_group/training_mail', $this->data, TRUE);
    }

    function get_subordinate($id)
    {
        $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($id)));
        $this->load->view('radio_subordinate',$this->data);
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
                $pos_nm = $user_info['EMPLID'];
            } else {
                $pos_nm = '';
            }

        echo $pos_nm;
    }

     function form_training_group_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_pengaju_id')->from('users_training_group')->where('id', $id)->get()->row('user_pengaju_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            
        $this->get_user_info($user_id);
        $form_training_group = $this->data['form_training_group'] = $this->form_training_group_model->form_training_group($id);

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Training-'.get_name($user_id);
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

                if(in_array($view, array('form_training_group/index')))
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
                    //$this->template->add_js('form_training_group.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_training_group/input',
                                             'form_training_group/detail',
                                             'form_training_group/approval/hrd',
											 'form_training_group/approval/supervisor',
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
                    $this->template->add_js('form_training_group.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
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
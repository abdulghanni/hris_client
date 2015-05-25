<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_exit extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->load->database();
        $this->load->model('form_exit/form_exit_model', 'form_exit_model');
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
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit_admin();
            }else{
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit();
            }
            
            $this->data['mgr_ga_nas'] = $this->get_emp_by_pos('PST242');
            $this->data['koperasi'] = $this->get_emp_by_pos('PST263');
            $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');
            $this->data['hrd'] = $this->get_emp_by_pos('PST129');

            $this->_render_page('form_exit/index');
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

            if(is_admin()){
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit_admin();
            }else{
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit();
            }

            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1'));
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            //print_mz($this->data['subordinate']);
            $this->_render_page('form_exit/input', $this->data);
    }
    
    function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_exit' , 'Tanggal Akhir Kerja', 'trim|required');
            $this->form_validation->set_rules('seragam' , 'Seragam', 'trim|required');
            $this->form_validation->set_rules('id_card' , 'ID Card', 'trim|required');
            $this->form_validation->set_rules('kendaraan' , 'Kendaraan', 'trim|required');
            $this->form_validation->set_rules('stnk' , 'STNK', 'trim|required');
            $this->form_validation->set_rules('gadget' , 'HP/Laptop/Ipad', 'trim|required');
            $this->form_validation->set_rules('laporan' , 'Laporan Serah terima', 'trim|required');
            $this->form_validation->set_rules('saldo' , 'Rekonsiliasi Saldo', 'trim|required');
            $this->form_validation->set_rules('koperasi' , 'Pinjaman Koperasi', 'trim|required');
            $this->form_validation->set_rules('buku' , 'Pinjaman Buku Perpustakaan', 'trim|required');
            $this->form_validation->set_rules('ikatan' , 'Ikatan Dinas', 'trim|required');
            $this->form_validation->set_rules('pesangon' , 'Uang Pesangon', 'trim|required');
            $this->form_validation->set_rules('uang_ganti' , 'Uang Pengganti Hak', 'trim|required');
            $this->form_validation->set_rules('uang_jasa' , 'Uang Jasa', 'trim|required');
            $this->form_validation->set_rules('skkerja' , 'Surat Keterangan Kerja', 'trim|required');
            $this->form_validation->set_rules('ijazah' , 'Ijazah', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors()));
            }
            else
            {
                
                $num_rows = getAll('users_exit')->num_rows();

                if($num_rows>0){
                    $exit_id = getAll('users_exit')->last_row();
                    $exit_id = $exit_id->id+1;
                }else{
                    $exit_id = 1;
                }

                
                $user_id= $this->input->post('emp');
                $creator_id = $this->session->userdata('user_id');
                $data1 = array(
                    'user_id' => $user_id,
                    'id_comp_session' => 1,
                    'date_exit' => date('Y-m-d',strtotime($this->input->post('date_exit'))),
                    'user_exit_inventaris_id' => $exit_id,
                    'user_exit_rekomendasi_id'   => $exit_id,
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                    );
                
                $data2 = array(
                    'user_exit_id' =>$exit_id,
                    'is_seragam' =>$this->input->post('seragam'),
                    'keterangan_seragam' =>$this->input->post('keterangan_seragam'),
                    'is_id_card' =>$this->input->post('id_card'),
                    'keterangan_id_card' =>$this->input->post('keterangan_id_card'),
                    'is_kendaraan' =>$this->input->post('kendaraan'),
                    'keterangan_kendaraan' =>$this->input->post('keterangan_kendaraan'),
                    'is_stnk' =>$this->input->post('stnk'),
                    'keterangan_stnk' =>$this->input->post('keterangan_stnk'),
                    'is_gadget' =>$this->input->post('gadget'),
                    'keterangan_gadget' =>$this->input->post('keterangan_gadget'),
                    'is_laporan' =>$this->input->post('laporan'),
                    'keterangan_laporan' =>$this->input->post('keterangan_laporan'),
                    'is_saldo' =>$this->input->post('saldo'),
                    'keterangan_saldo' =>$this->input->post('keterangan_saldo'),
                    'is_pinjaman_koperasi' =>$this->input->post('koperasi'),
                    'keterangan_pinjaman_koperasi' =>$this->input->post('keterangan_koperasi'),
                    'is_pinjaman_buku' =>$this->input->post('buku'),
                    'keterangan_pinjaman_buku' =>$this->input->post('keterangan_buku'),
                    'is_ikatan' =>$this->input->post('ikatan'),
                    'keterangan_ikatan' =>$this->input->post('keterangan_ikatan'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                );
                
                $data3 = array(
                    'user_exit_id' =>$exit_id,
                    'is_pesangon' =>$this->input->post('pesangon'),
                    'is_uang_ganti' =>$this->input->post('uang_ganti'),
                    'is_uang_jasa' =>$this->input->post('uang_jasa'),
                    'is_sk_kerja' =>$this->input->post('skkerja'),
                    'is_ijazah' =>$this->input->post('ijazah'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $creator_id,
                );
                
                    if ($this->form_validation->run() == true && $this->form_exit_model->add($data1, $data2, $data3))
                    {
                        $this->send_approval_request($exit_id, $user_id, $creator_id);
                        echo json_encode(array('st' =>1));     
                    }
            }
        }
    }

    function send_approval_request($id, $user_id, $creator_id)
    {
        $url = base_url().'form_exit/approval/'.$id;
        
        //approval to manager ga nasional
        $data1 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => (!empty($this->get_emp_by_pos('PST242'))) ? $this->get_emp_by_pos('PST242') : 'D0001',
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);

        //approval to koperasi
        $data2 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST263'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);

        //approval to perpustakaan
        $data3 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST2'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data3);

        //approval to hrd
        $data4 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => $this->get_emp_by_pos('PST129'),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data4);

        //approval to ASM/Mgr/Kacab/BDM/CoE
        $data5 = array(
                'sender_id' => get_nik($creator_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Rekomendasi Karyawan Keluar',
                'email_body' => get_name($creator_id).' mengajukan rekomendasi karyawan keluar untuk '.get_name($user_id).', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data5);
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
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit_admin($id);
            }else{
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit($id);
            }
            
            $user_id = getAll('users_exit', array('id'=>'where/'.$id, ))->row()->user_id;
            $this->get_user_info($user_id);
            $this->data['mgr_ga_nas'] = $this->get_emp_by_pos('PST242');
            $this->data['koperasi'] = $this->get_emp_by_pos('PST263');
            $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');
            $this->data['hrd'] = $this->get_emp_by_pos('PST129');
            
            $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['inventaris'] = getAll('users_exit_inventaris', array('user_exit_id'=>'where/'.$id, ))->row();
            $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();

            $this->_render_page('form_exit/detail', $this->data);
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

            if(is_admin()){
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit_admin($id);
            }else{
                $form_exit = $this->data['form_exit'] = $this->form_exit_model->form_exit($id);
            }
            
            $user_id = getAll('users_exit', array('id'=>'where/'.$id, ))->row()->user_id;
            $this->get_user_info($user_id);
            $this->data['mgr_ga_nas'] = $this->get_emp_by_pos('PST242');
            $this->data['koperasi'] = $this->get_emp_by_pos('PST263');
            $this->data['perpustakaan'] = $this->get_emp_by_pos('PST2');
            $this->data['hrd'] = $this->get_emp_by_pos('PST129');
            
            $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['inventaris'] = getAll('users_exit_inventaris', array('user_exit_id'=>'where/'.$id, ))->row();
            $this->data['rekomendasi'] = getAll('users_exit_rekomendasi', array('user_exit_id'=>'where/'.$id, ))->row();

            $this->_render_page('form_exit/approval', $this->data);
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
            $user_id = $this->session->userdata('user_id');
            $date_now = date('Y-m-d');

            $data = array(
            'is_app_'.$type => 1, 
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            );

           if ($this->form_exit_model->update($id,$data)) {
               $this->approval_mail($id, $type);
               return TRUE;
            }
        }
    }

    function do_approve_admin($id)
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
            'is_app' => 1, 
            'user_app' => $user_id, 
            'date_app' => $date_now,
            );

           if ($this->form_exit_model->update($id,$data)) {
               $this->approval_mail($id, 'admin');
               return TRUE;
            }
        }
    }

    function approval_mail($id, $type)
    {
        $url = base_url().'form_exit/approval/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_exit', array('id' => 'where/'.$id))->row('user_id');
        $data1 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk anda oleh ".get_name(get_superior($receiver_id))." disetujui oleh $approver untuk detail silakan <a href=$url>Klik disini</a>",
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);

        $data2 = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_superior($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Rekomendasi Keluar dari '.$type,
                'email_body' => "Status pengajuan Rekomendasi karyawan Keluar untuk ".get_name($receiver_id)." disetujui oleh $approver untuk detail silakan <a href=$url>Klik disini</a>",
                'is_read' => 0,
            );
        $this->db->insert('email', $data2);
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

                if(in_array($view, array('form_exit/index')))
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
                    $this->template->add_js('bootstrap-datepicker.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_exit.js');

                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_exit/input',
                                             'form_exit/detail',)))
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
                    $this->template->add_js('form_exit.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_exit/approval')))
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
                    $this->template->add_js('form_exit.js');

                    
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
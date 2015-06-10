<?php defined('BASEPATH') OR recruitment('No direct script access allowed');

class Form_recruitment extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('recruitment_model');
    
        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "users_recruitment.id", $sort_order = "asc", $offset = 0)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['session_id'] = $this->session->userdata('user_id');
        //$admin = cek_subordinate(is_have_subordinate($this->data['session_id']),'id', 30);print_mz(lq());
        //set sort order
        $this->data['sort_order'] = $sort_order;
        
        //set sort by
        $this->data['sort_by'] = $sort_by;
       
        //set filter by title
        $this->data['ftitle_param'] = $ftitle; 
        $exp_ftitle = explode(":",$ftitle);
        $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
        $ftitle_post = (strlen($ftitle_re) > 0) ? array('recruitment.subject'=>$ftitle_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

        $this->data['offset'] = 6;

        //list of filterize all recruitment  
        $this->data['recruitment_all'] = $this->recruitment_model->like($ftitle_post)->where('is_deleted',0)->recruitment()->result();
        
        $this->data['num_rows_all'] = $this->recruitment_model->like($ftitle_post)->where('is_deleted',0)->recruitment()->num_rows();
        
        $this->data['recruitment'] = $this->recruitment_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->recruitment()->result();

        //list of filterize limit recruitment for pagination  d();
        $this->data['_num_rows'] = $this->recruitment_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->recruitment()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'recruitment/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
        
        $this->_render_page('form_recruitment/index');
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['jurusan'] = getAll('recruitment_jurusan', array('is_deleted' => 'where/0'));
        $this->data['ipk'] = getAll('ipk', array('is_deleted' => 'where/0'));
        $this->data['toefl'] = getAll('toefl', array('is_deleted' => 'where/0'));
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $this->data['jenis_kelamin'] = getAll('jenis_kelamin', array('is_deleted' => 'where/0'));
        $this->data['pendidikan'] = getAll('recruitment_pendidikan', array('is_deleted' => 'where/0'));
        $this->data['komputer'] = getAll('recruitment_komputer', array('is_deleted' => 'where/0'));
        $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->get_bu();

        $this->_render_page('form_recruitment/input', $this->data);
    }

    function add()
    {
       if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
            /*$this->form_validation->set_rules('bu', 'Unit Bisnis', 'trim|required');
            $this->form_validation->set_rules('parent_org', 'Departement', 'trim|required');
            $this->form_validation->set_rules('org', 'Bagian', 'trim|required');
            $this->form_validation->set_rules('pos', 'Posisi', 'trim|required');
            */
            $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
            //$this->form_validation->set_rules('urgensi', 'Kebutuhan / Urgensi', 'trim|required');
            //$this->form_validation->set_rules('jnskelamin', 'Jenis Kelamin', 'trim|required');
            //$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
            //$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required');
            //$this->form_validation->set_rules('ipk', 'IPK', 'trim|required');
            /*$this->form_validation->set_rules('toefl', 'TOEFL', 'trim');
            $this->form_validation->set_rules('komputer', 'Komputer', 'trim');
            $this->form_validation->set_rules('komunikasi', 'Koumikasi', 'trim');
            $this->form_validation->set_rules('grafika', 'Grafika', 'trim');
            $this->form_validation->set_rules('desain', 'Desain', 'trim');
            $this->form_validation->set_rules('brevet', 'Brevet', 'trim');
            $this->form_validation->set_rules('lain_lain', 'Lain-Lain', 'trim');
            $this->form_validation->set_rules('portofolio', 'Portofolio', 'trim');
            $this->form_validation->set_rules('pengalaman', 'pengalaman', 'trim');
            $this->form_validation->set_rules('lama_pengalaman', 'lama_pengalaman', 'trim');
            $this->form_validation->set_rules('job_desc', 'Job Desc', 'trim');
            */
            if($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $num_rows = getAll('users_recruitment')->num_rows();

                if($num_rows>0){
                    $recruitment_id = $this->db->select('id')->order_by('id', 'asc')->get('users_recruitment')->last_row();
                    $recruitment_id = $recruitment_id->id+1;
                }else{
                    $recruitment_id = 1;
                }
                
                $user_id = $this->session->userdata('user_id');
                $data1 = array(
                    'id_comp_session' => 1,
                    'user_id'       => $user_id,
                    'bu_id'       => $this->input->post('bu'),
                    'parent_organization_id'       => $this->input->post('parent_org'),
                    'organization_id'     => $this->input->post('org'),
                    'position_id'           => $this->input->post('pos'),
                    'jumlah'           => $this->input->post('jumlah'),
                    'status_id'           => $this->input->post('status'),
                    'urgensi_id'           => $this->input->post('urgensi'),
                    'user_kualifikasi_id'           => $recruitment_id,
                    'user_kemampuan_id'           => $recruitment_id,
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );
                
                $data2 = array(
                    'jenis_kelamin_id' => implode(',',$this->input->post('jenis_kelamin')),
                    'pendidikan_id' => implode(',',$this->input->post('pendidikan')),
                    'jurusan' => $this->input->post('jurusan'),
                    'ipk' => $this->input->post('ipk'),
                    'toefl' => $this->input->post('toefl'),
                    'user_recruitment_id' => $recruitment_id,
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id')
                );

                $data3 = array(
                        'user_recruitment_id' => $recruitment_id,
                        'komputer' => implode(',',$this->input->post('komputer')),
                        'bahasa_pemrograman' => $this->input->post('pemrograman'),
                        'komunikasi' => $this->input->post('komunikasi'),
                        'grafika' => $this->input->post('grafika'),
                        'desain' => $this->input->post('desain'),
                        'brevet' => $this->input->post('brevet'),
                        'lain_lain' => $this->input->post('lain-lain'),
                        'portofolio' => $this->input->post('portofolio'),
                        'pengalaman' => $this->input->post('pengalaman'),
                        'lama_Pengalaman' => $this->input->post('lama_pengalaman'),
                        'job_desc' => $this->input->post('job_desc'),
                        'note_pengaju' => $this->input->post('note_pengaju'),
                        'created_on'            => date('Y-m-d',strtotime('now')),
                        'created_by'            => $this->session->userdata('user_id')
                    );

                if ($this->form_validation->run() == true && $this->recruitment_model->create_($data1, $data2, $data3))
                {
                    $recruitment_url = base_url().'form_recruitment';
                    $this->send_approval_request($recruitment_id, $user_id);
                    echo json_encode(array('st' =>1, 'recruitment_url' => $recruitment_url));    
                }
            } 
    }
    
    function detail($id)
    { 
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['recruitment'] = $this->recruitment_model->recruitment($id)->result();
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
        $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
        $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
        $this->data['jenis_kelamin'] = $this->recruitment_model->get_jk($jk);
        $this->data['pendidikan'] = $this->recruitment_model->get_pendidikan($pendidikan);
        $this->data['komputer'] = $this->recruitment_model->get_komputer($komputer);
        $this->data['position_pengaju'] = $this->get_user_position($this->recruitment_model->recruitment($id)->row_array()['user_id']);
        $this->_render_page('form_recruitment/detail', $this->data);
    }

    function approval($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['session_id'] = $this->session->userdata('user_id');
        $this->data['recruitment'] = $this->recruitment_model->recruitment($id)->result();
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
        $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
        $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
        $this->data['jenis_kelamin'] = $this->recruitment_model->get_jk($jk);
        $this->data['pendidikan'] = $this->recruitment_model->get_pendidikan($pendidikan);
        $this->data['komputer'] = $this->recruitment_model->get_komputer($komputer);
        $this->data['position_pengaju'] = $this->get_user_position($this->recruitment_model->recruitment($id)->row_array()['user_id']);
        $this->_render_page('form_recruitment/approval', $this->data);
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
            'approval_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $approval_status = $this->input->post('app_status_'.$type);
           if ($this->recruitment_model->update($id,$data)) {
               $this->approval_mail($id, $approval_status, $type);
               redirect('form_recruitment/approval/'.$id, 'refresh');
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
            'approval_status_id_'.$type => $this->input->post('update_app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('update_note_'.$type)
            );
            $approval_status = $this->input->post('update_app_status_'.$type);
           if ($this->recruitment_model->update($id,$data)) {
               $this->update_approval_mail($id, $approval_status, $type);
               redirect('form_recruitment/approval/'.$id, 'refresh');
            }
        }
    }

    function send_approval_request($id, $sender_id)
    {
        $url = base_url().'form_recruitment/approval/'.$id;
        if(is_have_superior($sender_id))
        {
            $data = array(
                    'sender_id' => get_nik($sender_id),
                    'receiver_id' => get_superior($sender_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permintaan SDM Baru',
                    'email_body' => get_name($sender_id).' mengajukan permintaan SDM baru, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
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
                    'email_body' => get_name($sender_id).' mengajukan permintaan SDM baru, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        }

       

        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permintaan SDM Baru',
                'email_body' => get_name($sender_id).' mengajukan permintaan SDM baru, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id, $approval_status, $type)
    {
        $url = base_url().'form_recruitment/approval/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_recruitment', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $type = ($type == 'lv1')? 'Supervisor':(($type == 'lv2')?'Ka. Bagian':'HRD');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permintaan SDM Baru dari '.$type,
                'email_body' => "Status pengajuan permintaan SDM baru anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function update_approval_mail($id, $approval_status, $type)
    {
        $url = base_url().'form_recruitment/approval/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = getAll('users_recruitment', array('id' => 'where/'.$id))->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $type = ($type == 'lv1')? 'Supervisor':(($type == 'lv2')?'Ka. Bagian':'HRD');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Permintaan SDM Baru dari '.$type,
                'email_body' => "$type melakukan perubahan status pengajuan permintaan SDM baru anda, status pengajuan anda sekarang $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        $this->data['recruitment'] = $this->recruitment_model->recruitment($id)->result();
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
        $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
        $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
        $this->data['jenis_kelamin'] = $this->recruitment_model->get_jk($jk);
        $this->data['pendidikan'] = $this->recruitment_model->get_pendidikan($pendidikan);
        $this->data['komputer'] = $this->recruitment_model->get_komputer($komputer);
        $this->data['position_pengaju'] = $this->get_user_position($this->recruitment_model->recruitment($id)->row_array()['user_id']);
        return $this->load->view('form_recruitment/recruitment_mail', $this->data, TRUE);
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
                $result['']= '- Pilih BU -';
                if($row['NUM'] != null){
                $result[$row['NUM']]= ucwords(strtolower($row['DESCRIPTION']));
                }
            }
                return $this->data['bu'] = $result;
            } else {
                return $this->data['bu'] = '';
            }
    }

    public function get_parent_org($id)
    {
        $url = get_api_key().'users/parent_org_from_bu/BUID/'.$id.'/format/json';
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
           $result['']= '- Belum Ada Departement -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_parent_org',$data);
    }

    public function get_org($id)
    {
        $url = get_api_key().'users/org_from_parent_org/ORGID/'.$id.'/format/json';
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
           $result['']= '- Belum Ada Bagian -';
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
           $result['']= '- Belum Ada Jabatan -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_pos',$data);
    }
    
    function get_user_position($user_id)
    {
            $url = get_api_key().'users/employement/EMPLID/'.get_nik($user_id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['POSITION'];
            } else {
                return '-';
            }
    }

    function recruitment_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_id = $this->db->select('user_id')->from('users_recruitment')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             //$this->get_user_info($user_id);
            
            //$this->data['comp_session'] = $this->recruitment_model->render_session()->result();
            
            if(is_admin()){
                $form_recruitment = $this->data['form_recruitment'] = $this->recruitment_model->recruitment($id);
            }else{
            $form_recruitment = $this->data['form_recruitment'] = $this->recruitment_model->recruitment($id);
            }

        $this->data['recruitment'] = $this->recruitment_model->recruitment($id)->result();
        $this->data['status'] = getAll('recruitment_status', array('is_deleted' => 'where/0'));
        $this->data['urgensi'] = getAll('recruitment_urgensi', array('is_deleted' => 'where/0'));
        $jk = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('jenis_kelamin_id'));
        $pendidikan = explode(',', getAll('users_recruitment_kualifikasi', array('id' => 'where/'.$id))->row('pendidikan_id'));
        $komputer = explode(',', getAll('users_recruitment_kemampuan', array('id' => 'where/'.$id))->row('komputer'));
        $this->data['jenis_kelamin'] = $this->recruitment_model->get_jk($jk);
        $this->data['pendidikan'] = $this->recruitment_model->get_pendidikan($pendidikan);
        $this->data['komputer'] = $this->recruitment_model->get_komputer($komputer);

        $this->data['position_pengaju'] = $this->get_user_position(getAll('users_recruitment', array('id' => 'where/'.$id))->row_array()['user_id']);
        //print_mz(getAll('users_recruitment', array('id' => 'where/'.$id))->row_array()['user_id']);
        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Permintaan SDM Baru-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('recruitment_pdf', $this->data, true); 
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

                if(in_array($view, array('form_recruitment/index')))
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
                    $this->template->add_js('form_recruitment.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_recruitment/input',
                                             'form_recruitment/detail',)))
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
                    $this->template->add_js('form_recruitment.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                    $this->template->add_css('approval_img.css');
                     
                }elseif(in_array($view, array('form_recruitment/approval')))
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
                    $this->template->add_js('form_recruitment.js');

                    
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
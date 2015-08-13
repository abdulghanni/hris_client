<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_spd_luar extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('person/person_model','person_model');
        $this->load->model('form_spd_luar/form_spd_luar_model','form_spd_luar_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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

            //list of filterize all form_spd_luar  
            $this->data['form_spd_luar_all'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->form_spd_luar()->result();
            
            $this->data['num_rows_all'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->form_spd_luar()->num_rows();

            $form_spd_luar = $this->data['form_spd_luar'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar()->result();
            $this->data['_num_rows'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_spd_luar/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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

            $this->_render_page('form_spd_luar/index', $this->data);
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

            redirect('form_spd_luar/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function submit($id)
    {

        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();
        
            
            $this->data['tc_id'] = $task_receiver_id = getValue('task_receiver', 'users_spd_luar', array('id' => 'where/'.$id));
            $this->data['biaya_pjd'] = getJoin('users_spd_luar_biaya','pjd_biaya','users_spd_luar_biaya.pjd_biaya_id = pjd_biaya.id','left', 'users_spd_luar_biaya.*, pjd_biaya.title as jenis_biaya, pjd_biaya.type_grade as type', array('user_spd_luar_id'=>'where/'.$id));

            $this->_render_page('form_spd_luar/submit', $this->data);
        }
    }

    public function do_submit($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $date_now = date('Y-m-d');

        $receiver_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_creator');
        $sender_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');
        $additional_data = array(
        'is_submit' => 1,  
        'date_submit' => $date_now);

        $this->form_spd_luar_model->update($id,$additional_data);
        
        $this->send_spd_submitted_mail($id, $receiver_id, $sender_id);

        redirect('form_spd_luar/submit/'.$id,'refresh');
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_'.$type => 1,
        'user_app_'.$type => $user_id, 
        'date_app_'.$type => $date_now,
        );
        
        $this->form_spd_luar_model->update($id,$data);
        $creator_id = getValue('task_creator', 'users_spd_luar', array('id'=>'where/'.$id));
        $isi_email = 'Status pengajuan perjalan Dinas Luar Kota anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_spd_luar/submit/'.$id.'>Klik Disini</a><br />';
        $isi_email_request = get_name(creator_id ).' mengajukan Permohonan perjalan Dinas Luar Kota, untuk melihat detail silakan <a href='.base_url().'form_spd_luar/submit/'.$id.'>Klik Disini</a><br />';  
        
        $approval_status = 1;
        $this->approval->approve('spd_luar', $id, $approval_status, $this->detail_email_submit($id));
        if(!empty(getEmail(creator_id )))$this->send_email(getEmail(creator_id ), 'Status Pengajuan Permohonan Perjalan Dinas Luar Kota dari Atasan', $isi_email);
        
        if($type !== 'hrd'){
        $lv = substr($type, -1)+1;
        $lv = 'lv'.$lv;
        $user_app = getValue('user_app_'.$lv, 'users_spd_luar', array('id'=>'where/'.$id));
        $user_spd_luar_id = getValue('task_creator', 'users_spd_luar', array('id'=>'where/'.$id));
        if(!empty($user_app)):
            if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Perjalanan Dinas Luar Kota', $isi_email_request);
            $this->approval->request($lv, 'spd_luar', $id, $user_spd_luar_id, $this->detail_email_submit($id));
        else:
            if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Luar Kota', $isi_email_request);
            $this->approval->request('hrd', 'spd_luar', $id, $user_spd_luar_id, $this->detail_email_submit($id));
        endif;
        }
    }

    public function update()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $spd_id = $this->input->post('spd_id');
        $date_spd = date('Y-m-d',strtotime($this->input->post('date_spd')));

        $additional_data = array(
            'title'   => $this->input->post('title'),
            'from_city_id' => $this->input->post('city_from'),
            'to_city_id'   => $this->input->post('city_to'),
            'transportation_id' => $this->input->post('vehicle'),
            'date_spd'          => $date_spd,
            'edited_on'         => $date_now,
            'edited_by'         => $user_id 
        );

        //print_r($additional_data);

       if ($this->form_spd_luar_model->update($spd_id,$additional_data)) {
        redirect('form_spd_luar/submit/'.$spd_id,'refresh');
       }
    }

    public function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));

            //render transportation
            $this->data['transportation_list'] = getAll('transportation')->result();
            $this->data['tl_num_rows'] = getAll('transportation')->num_rows();

            // render city
            $this->data['city_list'] = getAll('city')->result();
            $this->data['cl_num_rows'] = getAll('city')->num_rows();

            $this->data['biaya_tambahan'] = getAll('pjd_biaya', array('type_grade' => 'where/0'));
            //$this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/1'));
            $this->get_user_atasan();
            $this->get_penerima_tugas();

            $this->_render_page('form_spd_luar/input', $this->data);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('destination', 'Tujuan', 'trim|required');
        $this->form_validation->set_rules('date_spd_start', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('date_spd_end', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('city_to', 'Kota Tujuan', 'trim|required');
        $this->form_validation->set_rules('city_from', 'Kota Asal', 'trim|required');
        $this->form_validation->set_rules('vehicle', 'Kendaraan', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect('form_spd_luar/input','refresh');
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $user_id    = $this->input->post('employee');
            $additional_data = array(
                'task_creator'          => $this->input->post('emp_tc'),
                'title'                 => $this->input->post('title'),
                'destination'           => $this->input->post('destination'),
                'date_spd_start'              => date('Y-m-d', strtotime($this->input->post('date_spd_start'))),
                'date_spd_end'              => date('Y-m-d', strtotime($this->input->post('date_spd_end'))),
                'from_city_id'          => $this->input->post('city_from'),
                'to_city_id'            => $this->input->post('city_to'),
                'transportation_id'     => $this->input->post('vehicle'),
                'user_app_lv1'          => $this->input->post('atasan1'),
                'user_app_lv2'          => $this->input->post('atasan2'),
                'user_app_lv3'          => $this->input->post('atasan3'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $sess_id,
            );
            


            $task_creator = $this->input->post('emp_tc');
            $created_by = $sess_nik;

            if ($this->form_validation->run() == true && $this->form_spd_luar_model->create_($user_id,$additional_data))
            {
                $spd_id = $this->db->insert_id();
                $biaya_fix_id = $this->input->post('biaya_fix_id');
                $biaya_tambahan_id = $this->input->post('biaya_tambahan_id');
                $biaya_fix = $this->input->post('jumlah_biaya_fix');
                $biaya_tambahan = $this->input->post('jumlah_biaya_tambahan');
                for($i=0;$i<sizeof($biaya_fix_id);$i++):
                $data = array('user_spd_luar_id' => $spd_id,
                              'pjd_biaya_id' =>$biaya_fix_id[$i],
                              'jumlah_biaya' =>$biaya_fix[$i],
                              'created_by'=> $this->session->userdata('user_id'),
                              'created_on'            => date('Y-m-d',strtotime('now')),
                 );
                 $this->db->insert('users_spd_luar_biaya', $data);
                 endfor;
                 if(!empty($biaya_tambahan_id)){
                    for($i=0;$i<sizeof($biaya_tambahan_id);$i++):
                    $data2 = array('user_spd_luar_id' => $spd_id,
                                  'pjd_biaya_id' =>$biaya_tambahan_id[$i],
                                  'jumlah_biaya' =>str_replace( ',', '', $biaya_tambahan[$i]),
                                  'created_by'=> $this->session->userdata('user_id'),
                                  'created_on'            => date('Y-m-d',strtotime('now')),
                     );
                     $this->db->insert('users_spd_luar_biaya', $data2);
                     endfor;
                 }
                $user_app_lv1 = getValue('user_app_lv1', 'users_spd_luar', array('id'=>'where/'.$spd_id));
                $isi_email = get_name($task_creator).' mengajukan Perjalanan Dinas Luar Kota, untuk melihat detail silakan <a href='.base_url().'form_spd_luar/submit/'.$spd_id.'>Klik Disini</a><br />';

                if($task_creator!==$created_by):
                    $this->approval->by_admin('spd_luar', $spd_id, $created_by, $task_creator, $this->detail_email_submit($spd_id));
                endif;
                 if(!empty($user_app_lv1)):
                    if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Perjalanan Dinas Luar Kota', $isi_email);
                    $this->approval->request('lv1', 'spd_luar', $spd_id, $task_creator, $this->detail_email_submit($spd_id));
                 else:
                    if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Luar Kota', $isi_email);
                    $this->approval->request('hrd', 'spd_luar', $spd_id, $task_creator, $this->detail_email_submit($spd_id));
                 endif;
                $this->send_spd_mail($spd_id, $user_id, $task_creator);
                redirect('form_spd_luar', 'refresh'); 
                //echo json_encode(array('st' =>1));   
            }
        }
    }

    public function report($id)
    {
        $user_id = $this->session->userdata('user_id');
        $report_id = getValue('id', 'users_spd_luar_report', array('user_spd_luar_id'=>'where/'.$id));

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['photo'] = array(
            'name'  => 'photo',
            'id'    => 'photo',
            'class'    => 'input-file-control',
        );
            $this->data['message'] = $this->session->flashdata('message');

            $receiver_user_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');
            
            $date_spd = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_start'));
            $date_now = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_end'));;
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();
        
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');

            
            $report = $this->data['report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report($report_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report($report_id)->num_rows();
        
            if($n_report==0){
                $this->data['is_done'] = '';
                $this->data['tujuan'] = '';
                $this->data['hasil'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';

            
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                $this->data['tujuan'] = $key->description;
                $this->data['hasil'] = $key->result;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}


            $this->_render_page('form_spd_luar/report');
        }
    }


    public function add_report($spd_id)
    {
        $this->form_validation->set_rules('maksud', 'Maksud dan Tujuan', 'trim|required');
        $this->form_validation->set_rules('hasil', 'Hasil Kegiatan', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_spd_luar/report/'.$spd_id, 'refresh');
        }
        else
        {

            $user_folder = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_receiver');
            if(!is_dir('./'.'uploads/pdf/')){
            mkdir('./'.'uploads/pdf/', 0777);
            }
            if(!is_dir('./uploads/pdf/'.$user_folder)){
            mkdir('./uploads/pdf/'.$user_folder, 0777);
            }

                $config =  array(
                  'upload_path'     => "./uploads/pdf/".$user_folder,
                  'allowed_types'   => '*',
                  'overwrite'       => TRUE,
                );    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload())
                {
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        'description'   => $this->input->post('maksud'),
                        'result'        => $this->input->post('hasil'),
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'created_on'    => date('Y-m-d',strtotime('now')),
                        'created_by'    => $this->session->userdata('user_id')
                    );
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        'description'   => $this->input->post('maksud'),
                        'result'        => $this->input->post('hasil'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'created_on'    => date('Y-m-d',strtotime('now')),
                        'created_by'    => $this->session->userdata('user_id')
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_creator');
                $sender_id = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_receiver');
            if ($this->form_validation->run() == true && $this->form_spd_luar_model->create_report($spd_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id, $sender_id);
                redirect('form_spd_luar/report/'.$spd_id, 'refresh');  
            }          
        }

    }

     public function update_report($report_id)
    {
        $spd_id = $this->db->where('id', $report_id)->get('users_spd_luar_report')->row('user_spd_luar_id');
        $this->form_validation->set_rules('maksud', 'Maksud dan Tujuan', 'trim|required');
        $this->form_validation->set_rules('hasil', 'Hasil Kegiatan', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_spd_luar/report/'.$spd_id, 'refresh');
        }
        else
        {

            $user_folder = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_receiver');
            if(!is_dir('./'.'uploads/pdf/')){
            mkdir('./'.'uploads/pdf/', 0777);
            }
            if(!is_dir('./uploads/pdf/'.$user_folder)){
            mkdir('./uploads/pdf/'.$user_folder, 0777);
            }

                $config =  array(
                  'upload_path'     => "./uploads/pdf/".$user_folder,
                  'allowed_types'   => '*',
                  'overwrite'       => TRUE,
                );    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload())
                {
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        'description'   => $this->input->post('maksud'),
                        'result'        => $this->input->post('hasil'),
                        'attachment'    => '',
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'edited_on'    => date('Y-m-d',strtotime('now')),
                        'edited_by'    => $this->session->userdata('user_id')
                    );
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        'description'   => $this->input->post('maksud'),
                        'result'        => $this->input->post('hasil'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'edited_on'    => date('Y-m-d',strtotime('now')),
                        'edited_by'    => $this->session->userdata('user_id')
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_creator');
                $sender_id = $this->db->where('id', $spd_id)->get('users_spd_luar')->row('task_receiver');
            if ($this->form_validation->run() == true && $this->form_spd_luar_model->update_report($report_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id, $sender_id);
                redirect('form_spd_luar/report/'.$spd_id, 'refresh');  
            }          
        }

    }

    function send_spd_mail($spd_id, $receiver_id, $sender)
    {
        $url = base_url().'form_spd_luar/submit/'.$spd_id;
        //$sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pemberian Tugas Perjalanan Dinas Luar Kota',
                    'email_body' => get_name($sender).' memberikan tugas perjalan dinas luar kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_submit($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    function send_spd_submitted_mail($spd_id, $receiver_id, $sender_id)
    {
        $url = base_url().'form_spd_luar/submit/'.$spd_id;
        //$sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Persetujuan Tugas Perjalanan Dinas Luar Kota',
                    'email_body' => get_name($sender_id).' telah menyetujui tugas perjalan dinas luar kota yang anda berikan, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_submit($spd_id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
    }
    
    function send_spd_report_mail($spd_id, $receiver_id, $sender_id)
    {
        $url = base_url().'form_spd_luar/report/'.$spd_id;
        //$sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Laporan Tugas Perjalanan Dinas Luar Kota',
                    'email_body' => get_name($sender_id).' telah membuat laporan Perjalanan Dinas Luar Kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_report($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    function get_penerima_tugas()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/bawahan_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas'] = 'Tidak ada karyawan dengan departement yang sama';
            }
    }

    function pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['title'] = $title = 'SPD - Luar Kota';
        $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
        $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();

        $creator = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_creator');
        $this->data['tc_id'] = $task_receiver_id = getValue('task_receiver', 'users_spd_luar', array('id' => 'where/'.$id));
        $this->data['biaya_pjd'] = getJoin('users_spd_luar_biaya','pjd_biaya','users_spd_luar_biaya.pjd_biaya_id = pjd_biaya.id','left', 'users_spd_luar_biaya.*, pjd_biaya.title as jenis_biaya', array('user_spd_luar_id'=>'where/'.$id));

        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('spd_luar_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'-'.$creator.'pdf', 'I');
    }

    function detail_email_submit($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();
        
            
            $this->data['tc_id'] = $task_receiver_id = getValue('task_receiver', 'users_spd_luar', array('id' => 'where/'.$id));
            $this->data['biaya_pjd'] = getJoin('users_spd_luar_biaya','pjd_biaya','users_spd_luar_biaya.pjd_biaya_id = pjd_biaya.id','left', 'users_spd_luar_biaya.*, pjd_biaya.title as jenis_biaya', array('user_spd_luar_id'=>'where/'.$id));
            
            return $this->load->view('form_spd_luar/spd_luar_email', $this->data, TRUE);
        }
    }

    function detail_email_report($id)
    {
        $user_id = $this->session->userdata('user_id');
        $report_id = getValue('id', 'users_spd_luar_report', array('user_spd_luar_id'=>'where/'.$id));

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['photo'] = array(
            'name'  => 'photo',
            'id'    => 'photo',
            'class'    => 'input-file-control',
        );
            $this->data['message'] = $this->session->flashdata('message');

            $receiver_user_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');
            
            $date_spd = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_start'));
            $date_now = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_end'));;
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();
        
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');

            
            $report = $this->data['report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report($report_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report($report_id)->num_rows();
        
            if($n_report==0){
                $this->data['is_done'] = '';
                $this->data['tujuan'] = '';
                $this->data['hasil'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';

            
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                $this->data['tujuan'] = $key->description;
                $this->data['hasil'] = $key->result;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}


            return $this->load->view('form_spd_luar/spd_luar_report_email', $this->data, true);
        }
    }
    
    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_spd_luar/index')))
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
                elseif(in_array($view, array('form_spd_luar/input',
                                              'form_spd_luar/report',
                                              'form_spd_luar/submit',
                                              )))
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
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('jquery.maskMoney.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_spd_luar.js');
                    
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

/* End of file form_spd_luar.php */
/* Location: ./application/modules/form_spd_luar/controllers/form_spd_luar.php */
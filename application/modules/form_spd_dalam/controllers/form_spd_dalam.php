<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_spd_dalam extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_spd_dalam/form_spd_dalam_model','form_spd_dalam_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = "PJD - Dalam Kota";
        if (!$this->ion_auth->logged_in())
        {
            
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
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

            //list of filterize all form_spd_dalam  
            $this->data['form_spd_dalam_all'] = $this->form_spd_dalam_model->like($ftitle_post)->where('users_spd_dalam.is_deleted',0)->form_spd_dalam()->result();
            
            $this->data['num_rows_all'] = $this->form_spd_dalam_model->like($ftitle_post)->where('users_spd_dalam.is_deleted',0)->form_spd_dalam()->num_rows();

            $form_spd_dalam = $this->data['form_spd_dalam'] = $this->form_spd_dalam_model->like($ftitle_post)->where('users_spd_dalam.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_dalam()->result();
            $this->data['_num_rows'] = $this->form_spd_dalam_model->like($ftitle_post)->where('users_spd_dalam.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_dalam()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_spd_dalam/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/pjd'));
            $this->_render_page('form_spd_dalam/index', $this->data);
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

            redirect('form_spd_dalam/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function submit($id)
    { 
        $this->data['title'] = "Detail PJD - Dalam Kota";
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam()->num_rows($id);
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->_render_page('form_spd_dalam/submit', $this->data);
        }
    }

    public function do_submit($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $receiver_id = $this->db->where('id', $id)->get('users_spd_dalam')->row('task_creator');
        $additional_data = array(
        'is_submit' => 1,  
        'date_submit' => $date_now);

        if($this->form_spd_dalam_model->update($id,$additional_data)) {
        $this->send_spd_submitted_mail($id, $receiver_id);
        redirect('form_spd_dalam/submit/'.$id,'refresh');
       }
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $form = 'spd_dalam';
        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');
        $approval_status = $this->input->post('app_status_'.$type);
        $data = array(
        'is_app_'.$type => 1,
        'user_app_'.$type => $user_id, 
        'date_app_'.$type => $date_now,
        'app_status_id_'.$type => $approval_status,
        'note_'.$type => $this->input->post('note_'.$type)
        );

        $is_app = getValue('is_app_'.$type, 'users_spd_dalam', array('id'=>'where/'.$id));
        $this->form_spd_dalam_model->update($id,$data);

        if($is_app==0){
            $this->approval->approve($form, $id, $approval_status, $this->detail_email($id));
        }else{
            $this->approval->update_approve($form, $id, $approval_status, $this->detail_email($id));
        }

        if($type !== 'hrd'  && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_spd_dalam', array('id'=>'where/'.$id)) : 0;
            $user_spd_dalam_id = getValue('task_creator', 'users_spd_dalam', array('id'=>'where/'.$id));

            $isi_email = 'Status pengajuan perjalan dinas dalam kota anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_spd_dalam/submit/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_spd_dalam_id ).' mengajukan Permohonan perjalan dinas dalam kota, untuk melihat detail silakan <a href='.base_url().'form_spd_dalam/submit/'.$id.'>Klik Disini</a><br />';
            
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email_request);
                $this->approval->request($lv_app, $form, $id, $user_spd_dalam_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email_request);
                $this->approval->request('hrd', $form, $id, $user_spd_dalam_id, $this->detail_email($id));
            endif;
        }elseif($type == 'hrd' && $approval_status == 1){
            $this->approval->task_receiver($form, $id, $this->detail_email($id));
        }else{
            $task_receiver = getValue('task_receiver', 'users_spd_dalam', array('id'=>'where/'.$id));
            //$email_body = "Status pengajuan permohonan spd_dalam yang diajukan oleh ".get_name($user_spd_dalam_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_spd_dalam/detail/'.$id.'>Klik Disini</a><br />';
            switch($type){
                case 'lv1':
                    $this->approval->not_approve($form, $id, $task_receiver, $approval_status ,$this->detail_email($id));
                    //$this->approval->not_approve('spd_dalam', $id, )
                break;

                case 'lv2':
                    $receiver_id = getValue('user_app_lv1', 'users_spd_dalam', array('id'=>'where/'.$id));
                    $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                    $this->approval->not_approve($form, $id, $task_receiver, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
                break;

                case 'lv3':

                    $this->approval->not_approve($form, $id, $task_receiver, $approval_status ,$this->detail_email($id));
                    for($i=1;$i<3;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_dalam', array('id'=>'where/'.$id));
                        if(!empty($receiver)):
                            $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                        endif;
                    endfor;
                break;

                case 'hrd':
                
                            $this->approval->not_approve($form, $id, $task_receiver, $approval_status ,$this->detail_email($id));
                    for($i=1;$i<4;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_dalam', array('id'=>'where/'.$id));
                        if(!empty($receiver)):
                            $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                        endif;
                    endfor;
                break;
            }
        }
    }

    public function input()
    {
        $this->data['title'] = "Input PJD - Dalam Kota";
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = $nik = get_nik($sess_id);
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }elseif(!is_spv($nik)&&!is_admin()&&!is_admin_bagian()){
            return show_error('You must be an administrator to view this page.');
        }else{
            $this->data['all_users'] = $this->ion_auth->where('id != ', 1)->users();

            $this->_render_page('form_spd_dalam/input', $this->data);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('destination', 'Tujuan', 'trim|required');
        $this->form_validation->set_rules('title', 'Tanggal Terakhir spd_dalam', 'trim|required');
        $this->form_validation->set_rules('date_spd', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('spd_start_time', 'Waktu Berangkat', 'trim|required');
        $this->form_validation->set_rules('spd_end_time', 'Waktu Selesai', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect('form_spd_dalam/input','refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $user_id    = $this->input->post('employee');

            $start_spd_dalam = $this->input->post('start_spd_dalam');
            $end_spd_dalam = $this->input->post('end_spd_dalam');

            $additional_data = array(
                'task_creator'          => $this->input->post('emp_tc'),
                'title'                 => $this->input->post('title'),
                'destination'           => $this->input->post('destination'),
                'date_spd'              => date('Y-m-d', strtotime($this->input->post('date_spd'))),
                'start_time'            => $this->input->post('spd_start_time'),
                'end_time'              => $this->input->post('spd_end_time'),
                'user_app_lv1'          => $this->input->post('atasan1'),
                'user_app_lv2'          => $this->input->post('atasan2'),
                'user_app_lv3'          => $this->input->post('atasan3'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $sess_id,
            );

            $task_creator = $this->input->post('emp_tc');
            $created_by = $sess_nik;
            if ($this->form_validation->run() == true && $this->form_spd_dalam_model->create_($user_id,$additional_data))
            {
                $spd_id = $this->db->insert_id();
                $user_app_lv1 = getValue('user_app_lv1', 'users_spd_dalam', array('id'=>'where/'.$spd_id));
                $isi_email = get_name($task_creator).' mengajukan Perjalanan Dinas Dalam Kota, untuk melihat detail silakan <a href='.base_url().'form_spd_dalam/submit/'.$spd_id.'>Klik Disini</a><br />';

                if($task_creator!==$created_by):
                    $this->approval->by_admin('spd_dalam', $spd_id, $created_by, $task_creator, $this->detail_email($spd_id));
                endif;
                if(!empty($user_app_lv1)):
                    if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email);
                    $this->approval->request('lv1', 'spd_dalam', $spd_id, $task_creator, $this->detail_email($spd_id));
                else:
                    if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email);
                    $this->approval->request('hrd', 'spd_dalam', $spd_id, $task_creator, $this->detail_email($spd_id));
                endif;
                $this->send_spd_mail($spd_id, $user_id, $task_creator);
                redirect('form_spd_dalam', 'refresh');
            }
        }
    }

    public function report($id)
    {
        $this->data['title'] = "Report PJD - Dalam Kota";
        $user_id = $this->session->userdata('user_id');
        $sess_nik = get_nik($user_id);
        $report_id = getValue('id', 'users_spd_dalam_report', array('user_spd_dalam_id'=>'where/'.$id));

        if (!$this->ion_auth->logged_in())
        {
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

            $receiver_user_id = $this->db->where('id', $id)->get('users_spd_dalam')->row('task_receiver');
            
            $date_spd = date_create($this->db->where('id', $id)->get('users_spd_dalam')->row('date_spd'));
            $date_now = date_create(date('Y-m-d',strtotime('now')));
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->num_rows();
        
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_dalam')->row('task_receiver');

            
            $report = $this->data['report'] = $this->form_spd_dalam_model->where('users_spd_dalam_report.user_spd_dalam_id', $id)->form_spd_dalam_report($report_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_dalam_model->where('users_spd_dalam_report.user_spd_dalam_id', $id)->form_spd_dalam_report($report_id)->num_rows();
            $receiver_id = getValue('task_receiver', 'users_spd_dalam', array('id'=>'where/'.$id));
            if($n_report==0){
                $this->data['is_done'] = '';
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = '';
                $this->data['why'] = '';
                $this->data['where'] = '';
                $this->data['when'] = '';
                $this->data['who'] = '';
                $this->data['how'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = $key->what;
                $this->data['why'] = $key->why;
                $this->data['where'] = $key->where;
                $this->data['when'] = $key->when;
                $this->data['who'] = $key->who;
                $this->data['how'] = $key->how;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}

            if($sess_nik != $receiver_id):
                $this->data['disabled'] = 'disabled='.'"disabled"';
            endif;


            $this->_render_page('form_spd_dalam/report', $this->data);
        }
    }

    public function add_report($spd_id)
    {
        $this->form_validation->set_rules('what', 'What', 'trim|required');
        $this->form_validation->set_rules('who', 'Who', 'trim|required');
        $this->form_validation->set_rules('where', 'Where', 'trim|required');
        $this->form_validation->set_rules('when', 'When', 'trim|required');
        $this->form_validation->set_rules('why', 'Why', 'trim|required');
        $this->form_validation->set_rules('how', 'How', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_spd_dalam/report/'.$spd_id, 'refresh');
        }
        else
        {
            $user_folder = $this->db->where('id', $spd_id)->get('users_spd_dalam')->row('task_receiver');
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
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
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
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'created_on'    => date('Y-m-d',strtotime('now')),
                        'created_by'    => $this->session->userdata('user_id')
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_dalam')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_dalam_model->create_report($spd_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_spd_dalam/report/'.$spd_id, 'refresh');  
            }          
        }

    }

     public function update_report($report_id)
    {
        $spd_id = $this->db->where('id', $report_id)->get('users_spd_dalam_report')->row('user_spd_dalam_id');
        $this->form_validation->set_rules('what', 'What', 'trim|required');
        $this->form_validation->set_rules('who', 'Who', 'trim|required');
        $this->form_validation->set_rules('where', 'Where', 'trim|required');
        $this->form_validation->set_rules('when', 'When', 'trim|required');
        $this->form_validation->set_rules('why', 'Why', 'trim|required');
        $this->form_validation->set_rules('how', 'How', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_spd_dalam/report/'.$spd_id, 'refresh');
        }
        else
        {

            $user_folder = $this->db->where('id', $spd_id)->get('users_spd_dalam')->row('task_receiver');
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
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
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
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'edited_on'    => date('Y-m-d',strtotime('now')),
                        'edited_by'    => $this->session->userdata('user_id')
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_dalam')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_dalam_model->update_report($report_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_spd_dalam/report/'.$spd_id, 'refresh');  
            }          
        }

    }

    function send_spd_mail($spd_id, $receiver_id, $sender)
    {
        $url = base_url().'form_spd_dalam/submit/'.$spd_id;
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pemberian Tugas Perjalanan Dinas Dalam Kota',
                    'email_body' => get_name($sender).' memberikan tugas perjalan dinas dalam kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    function send_spd_submitted_mail($spd_id, $receiver_id)
    {
        $url = base_url().'form_spd_dalam/submit/'.$spd_id;
        $sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Persetujuan Tugas Perjalanan Dinas Dalam Kota',
                    'email_body' => get_name($sender).' telah menyetujui tugas perjalan dinas dalam kota yang anda berikan, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
    }
    
    function send_spd_report_mail($spd_id, $receiver_id)
    {
        $url = base_url().'form_spd_dalam/report/'.$spd_id;
        $sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Laporan Tugas Perjalanan Dinas Dalam Kota',
                    'email_body' => get_name($sender).' telah membuat laporan perjalanan dinas dalam kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_report($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $this->data['id'] = $id;
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam()->num_rows($id);
            
        return $this->load->view('form_spd_dalam/spd_dalam_mail', $this->data, TRUE);
    } 

    function detail_email_report($id)
    {
        $user_id = $this->session->userdata('user_id');
        $report_id = $this->db->where('users_spd_dalam_report.user_spd_dalam_id', $id)->get('users_spd_dalam_report')->row('id');

        if (!$this->ion_auth->logged_in())
        {
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

            $receiver_user_id = $this->db->where('id', $id)->get('users_spd_dalam')->row('task_receiver');
            
            $date_spd = date_create($this->db->where('id', $id)->get('users_spd_dalam')->row('date_spd'));
            $date_now = date_create(date('Y-m-d',strtotime('now')));
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->num_rows();
        
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_dalam')->row('task_receiver');

            
            $report = $this->data['report'] = $this->form_spd_dalam_model->where('users_spd_dalam_report.user_spd_dalam_id', $id)->form_spd_dalam_report($report_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_dalam_model->where('users_spd_dalam_report.user_spd_dalam_id', $id)->form_spd_dalam_report($report_id)->num_rows();
        
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
                $this->data['what'] = $key->what;
                $this->data['why'] = $key->why;
                $this->data['where'] = $key->where;
                $this->data['when'] = $key->when;
                $this->data['who'] = $key->who;
                $this->data['how'] = $key->how;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}

            return $this->load->view('form_spd_dalam/spd_dalam_report_mail', $this->data, TRUE);
        }
    }
    
    function pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['title'] = $title = 'SPD - Dalam Kota';
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_model->where('users_spd_dalam.id',$id)->form_spd_dalam()->num_rows($id);
            $creator = getValue('task_creator', 'users_spd_dalam', array('id'=>'where/'.$id));
            $this->data['form_id'] = 'PDJ-DK';
            $this->data['bu'] = get_user_buid($creator);
            $this->data['location'] = get_user_locationid($creator);
            $date = getValue('created_on','users_spd_dalam', array('id'=>'where/'.$id));
            $this->data['m'] = date('m', strtotime($date));
            $this->data['y'] = date('Y', strtotime($date));
            $this->load->library('mpdf60/mpdf');
            $html = $this->load->view('spd_dalam_pdf', $this->data, true); 
            $mpdf = new mPDF();
            $mpdf = new mPDF('A4');
            $mpdf->WriteHTML($html);
            $mpdf->Output($id.'-'.$title.'-'.$creator.'pdf', 'I');
        }
        
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_spd_dalam/index')))
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
                elseif(in_array($view, array('form_spd_dalam/input')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                     $this->template->add_js('purl.js');

                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_spd_dalam_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_spd_dalam/submit')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('form_spd_dalam.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('approval_img.css');
                     
                }elseif(in_array($view, array('form_spd_dalam/report')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');

                    $this->template->add_js('form_spd_dalam_report.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                     
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

/* End of file form_spd_dalam.php */
/* Location: ./application/modules/form_spd_dalam/controllers/form_spd_dalam.php */
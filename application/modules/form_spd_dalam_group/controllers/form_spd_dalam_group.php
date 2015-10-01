<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_spd_dalam_group extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_spd_dalam_group/form_spd_dalam_group_model','form_spd_dalam_group_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    { 
        $this->data['title'] = "Daftar PJD - Dalam Kota (Group)";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
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
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('users.username'=>$ftitle_re, 'users_spd_dalam_group.task_receiver'=>get_nik_from_name($ftitle_re)) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_spd_dalam_group  
            $this->data['form_spd_dalam_group_all'] = $this->form_spd_dalam_group_model->like($ftitle_post)->where('users_spd_dalam_group.is_deleted',0)->form_spd_dalam_group()->result();
            
            $this->data['num_rows_all'] = $this->form_spd_dalam_group_model->like($ftitle_post)->where('users_spd_dalam_group.is_deleted',0)->form_spd_dalam_group()->num_rows();

            $form_spd_dalam_group = $this->data['form_spd_dalam_group'] = $this->form_spd_dalam_group_model->like($ftitle_post)->where('users_spd_dalam_group.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_dalam_group()->result();
            $this->data['_num_rows'] = $this->form_spd_dalam_group_model->like($ftitle_post)->where('users_spd_dalam_group.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_dalam_group()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_spd_dalam_group/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->_render_page('form_spd_dalam_group/index', $this->data);
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

            redirect('form_spd_dalam_group/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function submit($id)
    {
        $this->data['title'] = "Detail PJD - Dalam Kota (Group)";
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group()->num_rows($id);
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $receiver = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_receiver');
            $creator = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_creator');
            $user_submit = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('user_submit');
            $this->data['receiver'] = $p = explode(",", $receiver);
            $this->data['receiver_submit'] = explode(",", $user_submit);

            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->_render_page('form_spd_dalam_group/submit', $this->data);
        }
    }

    public function do_submit($id)
    {
        $user_id = $this->session->userdata('user_id');
        $sess_nik = get_nik($user_id);
        $date_now = date('Y-m-d');

        
        $creator_id = $this->db->where('id', $id)->get('users_spd_dalam_group')->row('task_creator');
        $user_submit_id = $this->db->where('id', $id)->get('users_spd_dalam_group')->row('user_submit');
        $user_submit = (!empty($user_submit_id)) ? $user_submit_id.','.$sess_nik:$sess_nik;

        $additional_data = array(
        'is_submit' => 1,  
        'user_submit' => $user_submit,  
        'date_submit' => $date_now);

        if($this->form_spd_dalam_group_model->update($id,$additional_data)) {
        $this->send_spd_submitted_mail($id, $creator_id);
        redirect('form_spd_dalam_group/submit/'.$id,'refresh');
       }
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $form = 'spd_dalam_group';
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

        $is_app = getValue('is_app_'.$type, 'users_spd_dalam_group', array('id'=>'where/'.$id));
        $this->form_spd_dalam_group_model->update($id,$data);

        if($is_app==0){
            $this->approval->approve($form, $id, $approval_status, $this->detail_email($id));
        }else{
            $this->approval->update_approve($form, $id, $approval_status, $this->detail_email($id));
        }

        if($type !== 'hrd'  && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_spd_dalam_group', array('id'=>'where/'.$id)) : 0;
            $user_spd_dalam_group_id = getValue('task_creator', 'users_spd_dalam_group', array('id'=>'where/'.$id));

            $isi_email = 'Status pengajuan perjalan dinas dalam kota anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_spd_dalam_group/submit/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_spd_dalam_group_id ).' mengajukan Permohonan perjalan dinas dalam kota, untuk melihat detail silakan <a href='.base_url().'form_spd_dalam_group/submit/'.$id.'>Klik Disini</a><br />';
            
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email_request);
                $this->approval->request($lv_app, $form, $id, $user_spd_dalam_group_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Dalam Kota', $isi_email_request);
                $this->approval->request('hrd', $form, $id, $user_spd_dalam_group_id, $this->detail_email($id));
            endif;
        }elseif($type == 'hrd' && $approval_status == 1){
            $this->approval->task_receiver($form, $id, $this->detail_email($id));
        }else{
            $task_receiver = getValue('task_receiver', 'users_spd_dalam_group', array('id'=>'where/'.$id));
            $task_receiver_id = explode(',',$task_receiver);
            //$email_body = "Status pengajuan permohonan spd_dalam_group yang diajukan oleh ".get_name($user_spd_dalam_group_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_spd_dalam_group/detail/'.$id.'>Klik Disini</a><br />';
            switch($type){
                case 'lv1':
                    for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    //$this->approval->not_approve('spd_dalam_group', $id, )
                break;

                case 'lv2':
                    for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    $receiver_id = getValue('user_app_lv1', 'users_spd_dalam_group', array('id'=>'where/'.$id));
                    $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
                break;

                case 'lv3':
                    for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    for($i=1;$i<3;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_dalam_group', array('id'=>'where/'.$id));
                        if(!empty($receiver)):
                            $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                        endif;
                    endfor;
                break;

                case 'hrd':
                    for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    for($i=1;$i<4;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_dalam_group', array('id'=>'where/'.$id));
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
        $this->data['title'] = "Input PJD - Dalam Kota (Group)";
        $user_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_spv($nik)&&!is_admin()&&!is_admin_bagian()){
            return show_error('You must be an administrator to view this page.');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);

            $this->data['all_users'] = $this->ion_auth->where('id != ', 1)->users();
            $this->get_penerima_tugas();
            $this->get_penerima_tugas_satu_bu();
            $this->_render_page('form_spd_dalam_group/input', $this->data);
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
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            redirect('form_spd_dalam_group/input','refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $task_receiver    = implode(',',$this->input->post('peserta'));

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

            if ($this->form_validation->run() == true && $this->form_spd_dalam_group_model->create_($task_receiver,$additional_data))
            {
                $spd_id = $this->db->insert_id();
                $user_app_lv1 = getValue('user_app_lv1', 'users_spd_dalam_group', array('id'=>'where/'.$spd_id));
                $isi_email = get_name($task_creator).' mengajukan Perjalanan Dinas Dalam Kota (Group), untuk melihat detail silakan <a href='.base_url().'form_spd_dalam_group/submit/'.$spd_id.'>Klik Disini</a><br />';

                if($task_creator!==$created_by):
                    $this->approval->by_admin('spd_dalam_group', $spd_id, $created_by, $task_creator, $this->detail_email($spd_id));
                endif;
                 if(!empty($user_app_lv1)):
                    if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Perjalanan Dinas Dalam Kota (Group)', $isi_email);
                    $this->approval->request('lv1', 'spd_dalam_group', $spd_id, $task_creator, $this->detail_email($spd_id));
                 else:
                    if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), 'Pengajuan Perjalanan Dinas Dalam Kota (Group)', $isi_email);
                    $this->approval->request('hrd', 'spd_dalam_group', $spd_id, $task_creator, $this->detail_email($spd_id));
                 endif;
                $task_receiver_id = explode(',',$task_receiver);
                $this->send_spd_mail($spd_id, $task_creator, $task_receiver_id);
                redirect('form_spd_dalam_group','refresh');
                //echo json_encode(array('st' =>1));   
            }
        }
    }

    public function report($id)
    {
        $this->data['title'] = "Report SPD - Dalam Kota (Group)";
        $user_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $report_id = $this->db->where('users_spd_dalam_report_group.user_spd_dalam_group_id', $id)->get('users_spd_dalam_report_group')->row('id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->data['file'] = array(
            'name'  => 'file',
            'id'    => 'file',
            'class'    => 'input-file-control',
            );
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group()->num_rows($id);
        
            $receiver = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_receiver');
            $creator = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_creator');
            $user_submit = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('user_submit');
            $this->data['receiver'] = $p = explode(",", $receiver);
            $this->data['receiver_submit'] = explode(",", $user_submit);
            $this->_render_page('form_spd_dalam_group/report', $this->data);
        }
    }

    public function report_detail($id, $user_id)
    {
        $this->data['title'] = "Report Detail SPD - Dalam Kota (Group)";
        $report_id = getValue('id','users_spd_dalam_report_group', array('user_spd_dalam_group_id'=>'where/'.$id, 'created_by'=>'where/'.$user_id));
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['sess_id'] = $this->session->userdata('user_id');
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->num_rows();
            
            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_dalam_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['user_folder'] = get_nik($report_creator);

           
            $report = $this->data['report'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_report_group.user_spd_dalam_group_id', $id)->form_spd_dalam_report_group($report_id, $user_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_report_group.user_spd_dalam_group_id', $id)->form_spd_dalam_report_group($report_id, $user_id)->num_rows();

            $receiver_id = getValue('task_receiver', 'users_spd_dalam_group', array('id'=>'where/'.$id));
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

            $this->_render_page('form_spd_dalam_group/report_detail', $this->data);
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
            redirect('form_spd_dalam_group/report/'.$spd_id, 'refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $user_folder = get_nik($sess_id);
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
                        'created_by'    => $sess_id
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
                        'created_by'    => $sess_id
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_dalam_group')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_dalam_group_model->create_report($spd_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_spd_dalam_group/report_detail/'.$spd_id.'/'.$sess_id, 'refresh');  
            }          
        }

    }

     public function update_report($report_id, $user_id)
    {
        $spd_id = getValue('user_spd_dalam_group_id', 'users_spd_dalam_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
        $this->form_validation->set_rules('what', 'What', 'trim|required');
        $this->form_validation->set_rules('who', 'Who', 'trim|required');
        $this->form_validation->set_rules('where', 'Where', 'trim|required');
        $this->form_validation->set_rules('when', 'When', 'trim|required');
        $this->form_validation->set_rules('why', 'Why', 'trim|required');
        $this->form_validation->set_rules('how', 'How', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_spd_dalam_group/report/'.$spd_id, 'refresh');
        }
        else
        {

            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_dalam_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['user_folder'] = $user_folder = get_nik($report_creator);
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

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_dalam_group')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_dalam_group_model->update_report($report_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_spd_dalam_group/report_detail/'.$spd_id.'/'.$user_id, 'refresh');  
            }          
        }

    }

    function send_spd_mail($spd_id, $sender_id, $task_receiver_id)
    {
        $url = base_url().'form_spd_dalam_group/submit/'.$spd_id;

        for($i=0;$i<sizeof($task_receiver_id);$i++):
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $task_receiver_id[$i],
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pemberian Tugas Perjalanan Dinas Dalam Kota (group)',
                    'email_body' => get_name($sender_id).' memberikan tugas perjalan dinas Dalam Kota (group), untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        endfor;
    }

    function send_spd_submitted_mail($spd_id, $receiver_id)
    {
        $url = base_url().'form_spd_dalam_group/submit/'.$spd_id;
        $sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Persetujuan Tugas Perjalanan Dinas Dalam Kota (group)',
                    'email_body' => get_name($sender).' telah menyetujui tugas perjalan dinas Dalam Kota (group) yang anda berikan, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
    }
    
    function send_spd_report_mail($spd_id, $receiver_id)
    {
        $sess_id = $this->session->userdata('user_id');
        $url = base_url().'form_spd_dalam_group/report_detail/'.$spd_id.'/'.$sess_id;
        $sender = (!empty(get_nik($sess_id))) ? get_nik($sess_id) : $sess_id;
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Laporan Tugas Perjalanan Dinas Dalam Kota (group)',
                    'email_body' => get_name($sender).' telah membuat laporan perjalanan dinas Dalam Kota (group), untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_report($spd_id, $sess_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
           
           $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group()->num_rows($id);
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $receiver = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_receiver');
            $creator = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_creator');
            $user_submit = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('user_submit');
            $this->data['receiver'] = $p = explode(",", $receiver);
            $this->data['receiver_submit'] = explode(",", $user_submit);
            return $this->load->view('form_spd_dalam_group/spd_dalam_mail', $this->data, TRUE);
        }
    } 

    function detail_email_report($id, $user_id)
    {
        $report_id = getValue('id','users_spd_dalam_report_group', array('user_spd_dalam_group_id'=>'where/'.$id, 'created_by'=>'where/'.$user_id));
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['sess_id'] = $this->session->userdata('user_id');
            $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->num_rows();
            
            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_dalam_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['user_folder'] = get_nik($report_creator);

           
            $report = $this->data['report'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_report_group.user_spd_dalam_group_id', $id)->form_spd_dalam_report_group($report_id, $user_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_report_group.user_spd_dalam_group_id', $id)->form_spd_dalam_report_group($report_id, $user_id)->num_rows();

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

            return $this->load->view('form_spd_dalam_group/spd_dalam_report_mail', $this->data, TRUE);
        }
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
             return $this->data['penerima_tugas'] = 'Tidak ada karyawan dengan BU yang sama';
            }
    }

    function get_penerima_tugas_satu_bu()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/emp_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas_satu_bu'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas_satu_bu'] = 'Tidak ada karyawan dengan Bussiness Unit yang sama';
            }
    }

    function pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $title_spd = $this->db->where('id', $id)->get('users_spd_dalam_group')->row('title');
        $title = $this->data['title'] = 'Form-SPD-Dalam-'.$title_spd;

        $this->data['id'] = $id;   
        $data_result = $this->data['task_detail'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group($id)->result();
        $this->data['td_num_rows'] = $this->form_spd_dalam_group_model->where('users_spd_dalam_group.id',$id)->form_spd_dalam_group()->num_rows($id);
        $user_submit = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('user_submit');
        $this->data['receiver_submit'] = explode(",", $user_submit);
        $creator = getValue('task_creator', 'users_spd_dalam_group', array('id'=>'where/'.$id));
        $this->data['form_id'] = 'PJD-DKG';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_spd_dalam_group', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('spd_dalam_pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            10, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($id.'-'.$title.'-'.$task_creator.'pdf', 'I');
        
    }
    
    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_spd_dalam_group/index')))
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
                elseif(in_array($view, array('form_spd_dalam_group/input')))
                {

                    $this->template->set_layout('default');

                     $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_spd_dalam_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_spd_dalam_group/submit')))
                {

                    $this->template->set_layout('default');

                     $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('form_spd_dalam.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('approval_img.css');
                     
                }elseif(in_array($view, array('form_spd_dalam_group/report',
                                              'form_spd_dalam_group/report_detail')))
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

/* End of file form_spd_dalam_group.php */
/* Location: ./application/modules/form_spd_dalam_group/controllers/form_spd_dalam_group.php */
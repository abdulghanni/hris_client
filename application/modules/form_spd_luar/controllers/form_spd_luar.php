<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_spd_luar extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
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
            $this->data['sess_id'] = $this->session->userdata('user_id');
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('form_spd_luar.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_spd_luar  
            $this->data['form_spd_luar_all'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->form_spd_luar()->result();
            
            $this->data['num_rows_all'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->form_spd_luar()->num_rows();

            //list of filterize limit form_spd_luar for pagination
            if(is_admin())
            {  
                $this->data['form_spd_luar'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar_admin()->result();
                $this->data['_num_rows'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar_admin()->num_rows();
            }else{
                $this->data['form_spd_luar'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar()->result();
                $this->data['_num_rows'] = $this->form_spd_luar_model->like($ftitle_post)->where('users_spd_luar.is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar()->num_rows();
            }
            $this->_render_page('form_spd_luar/index', $this->data);
        }
    }

    function submit($id=0)
    {
        $user_id = $this->session->userdata('user_id');
        if ($id == 0) {
            $task_id = $this->uri->segment(3);
        }else{
            $task_id = $id;
        }
    
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if(is_admin()){
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin($id)->num_rows();
            }else{
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar($id)->num_rows();
            
            }
            //get task creator id
            foreach ($data_result as $dr) {
                $created_by_id = $dr->task_creator;
                $receiver_user_id = $dr->task_receiver;
                $transportation_id = $dr->transportation_id;
                $from_city_id = $dr->from_city_id;
                $to_city_id = $dr->to_city_id;
            }

            //get task creator name
            $query_result = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            foreach ($query_result as $qr) {
                $this->data['task_creator_nm'] = $qr->user_name;
            }

             //get Receiver Info From API
            $receiver_info = $this->get_receiver_info($receiver_user_id);

            $this->data['task_receiver_nm'] = (!empty($receiver_info['NAME'])) ? $receiver_info['NAME'] : '-';
            $this->data['task_receiver_org'] = (!empty($receiver_info['ORGANIZATION'])) ? $receiver_info['ORGANIZATION'] : '-';
            $this->data['task_receiver_pos'] = (!empty($receiver_info['POSITION'])) ? $receiver_info['POSITION'] : '-';

            //get User Info from API
            $this->get_user_info($created_by_id);

            //get transportation name
            $query_result = $this->form_spd_luar_model->where('id',$transportation_id)->get_transportation()->result();
            foreach ($query_result as $qr) {
                $this->data['transportation_nm'] = $qr->title;
            }
            //render transportation
            $this->data['transportation_list'] = $this->form_spd_luar_model->get_transportation()->result();
            $this->data['tl_num_rows'] = $this->form_spd_luar_model->get_transportation()->num_rows();


            //get city name
            $query_result = $this->form_spd_luar_model->where('id',$from_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['from_city_nm'] = $qr->title;
            }
            $query_result = $this->form_spd_luar_model->where('id',$to_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['to_city_nm'] = $qr->title;
            }

            //get task creator detail
            $this->data['task_creator'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            $this->data['tc_num_rows'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->num_rows();
            $this->data['task_receiver'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->result();
            $this->data['tr_num_rows'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->num_rows();

            //get user org_id
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }

            // render employee
            $this->data['employee_list'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->result();
            $this->data['el_num_rows'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->num_rows();


            // render city
            $this->data['city_list'] = $this->form_spd_luar_model->get_city()->result();
            $this->data['cl_num_rows'] = $this->form_spd_luar_model->get_city()->num_rows();
            $task_receiver_id = getAll('users_spd_luar', array('id' => 'where/'.$id))->row('task_receiver');
            $this->data['biaya_pjd'] = $this->get_biaya_pjd($id, $task_receiver_id);


            $this->_render_page('form_spd_luar/submit', $this->data);
        }
    }

    public function do_submit($id)
    {
        //$user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');

        $receiver_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_creator');
        $sender_id = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');
        $additional_data = array(
        'is_submit' => 1,  
        'date_submit' => $date_now);

        //print_mz('-');
        $this->form_spd_luar_model->update($id,$additional_data);
        
        $this->send_spd_submitted_mail($id, $receiver_id, $sender_id);

        redirect('form_spd_luar/submit/'.$id,'refresh');
    }

    public function update()
    {
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
        $user_id = $this->session->userdata('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $sess_id = $this->session->userdata('user_id');
            $this->data['sess_nik']  = get_nik($sess_id);
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //get task creator name
            $query_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_emp_detail()->result();
            foreach ($query_result as $qr) {
                $this->data['task_creator_nm'] = $qr->first_name." ".$qr->last_name;
            }

            //get user org_id
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }

            //get tast receiver name
            $query_result = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->get_emp_detail()->result();
            foreach ($query_result as $qr) {
                $this->data['task_receiver_nm'] = $qr->first_name." ".$qr->last_name;
            }

            //get task creator detail
            $this->data['task_creator'] = $this->form_spd_luar_model->where('users.id',$user_id)->get_emp_detail()->result();
            $this->data['tc_num_rows'] = $this->form_spd_luar_model->where('users.id',$user_id)->get_emp_detail()->num_rows();

            //get user org_id
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }

            //get_task_receiver_from_same_organization
            $this->get_task_receiver();
            $this->get_user_info($user_id);

            $this->data['all_users'] = $this->form_spd_luar_model->render_emp()->result();

             //render transportation
            $this->data['transportation_list'] = $this->form_spd_luar_model->get_transportation()->result();
            $this->data['tl_num_rows'] = $this->form_spd_luar_model->get_transportation()->num_rows();

            // render city
            $this->data['city_list'] = $this->form_spd_luar_model->get_city()->result();
            $this->data['cl_num_rows'] = $this->form_spd_luar_model->get_city()->num_rows();

            // render employee
            $this->data['employee_list'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->result();
            $this->data['el_num_rows'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->num_rows();

            $this->_render_page('form_spd_luar/input', $this->data);
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('destination', 'Tujuan', 'trim|required');
        $this->form_validation->set_rules('title', 'Tanggal Terakhir Cuti', 'trim|required');
        $this->form_validation->set_rules('date_spd_start', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('date_spd_end', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('city_to', 'Kota Tujuan', 'trim|required');
        $this->form_validation->set_rules('city_from', 'Kota Asal', 'trim|required');
        $this->form_validation->set_rules('vehicle', 'Kendaraan', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
        }
        else
        {
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
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $this->session->userdata('user_id')
            );

            $num_rows = $this->form_spd_luar_model->form_spd_luar()->num_rows();

             if($num_rows>0){
                $spd_id = $this->db->select('id')->order_by('id', 'asc')->get('users_spd_luar')->last_row();
                $spd_id = $spd_id->id+1;
            }else{
                $spd_id = 1;
            }

            $sender_id = $this->input->post('emp_tc');

            if ($this->form_validation->run() == true && $this->form_spd_luar_model->create_($user_id,$additional_data))
            {
                $this->send_spd_mail($spd_id, $user_id, $sender_id);
                echo json_encode(array('st' =>1));   
            }
        }
    }

    public function report($id)
    {
        $user_id = $this->session->userdata('user_id');

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
            $date_now = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_end'));
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $receiver_info = $this->get_receiver_info($receiver_user_id);

            $this->data['task_receiver_nm'] = (!empty($receiver_info['NAME'])) ? $receiver_info['NAME'] : '-';
            $this->data['task_receiver_org'] = (!empty($receiver_info['ORGANIZATION'])) ? $receiver_info['ORGANIZATION'] : '-';
            $this->data['task_receiver_pos'] = (!empty($receiver_info['POSITION'])) ? $receiver_info['POSITION'] : '-';

            if(is_admin()){
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar_admin($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar_admin($id)->num_rows();
            }else{
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();           
            }
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');

            $report = $this->data['report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report()->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report()->num_rows();
            
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

    function get_biaya_pjd($id, $task_receiver_id)
    {
        $spd_id = getAll('users_spd_luar', array('id' => 'where/'.$id));
        $grade = get_grade($task_receiver_id);
        $pos_group = get_pos_group($task_receiver_id);

        if($grade == 'G08' && $pos_group == 'AMD')
        {
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 450000,
                    'uang_makan' => 200000,
                    'uang_saku' => 0
                );

            return $biaya_pjd;
        }elseif($grade == 'G08' && $pos_group == 'MGR')
        {
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 325000,
                    'uang_makan' => 150000,
                    'uang_saku' => 0,
                );

            return $biaya_pjd;
        }elseif($grade == 'G08' && $pos_group == 'KACAB'){
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 400000,
                    'uang_makan' => 150000,
                    'uang_saku' => 0,
                );

            return $biaya_pjd;
        }elseif($grade == 'G07'){
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 275000,
                    'uang_makan' => 45000,
                    'uang_saku' => 45000,
                );

            return $biaya_pjd;
        }elseif($grade == 'G06' || $grade == 'G05'){
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 250000,
                    'uang_makan' => 35000,
                    'uang_saku' => 40000
                );

            return $biaya_pjd;
        }elseif($grade == 'G04' || $grade == 'G03'){
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 200000,
                    'uang_makan' => 30000,
                    'uang_saku' => 35000,
                );

            return $biaya_pjd;
        }elseif($grade == 'G02' || $grade == 'G01'){
            $biaya_pjd = array(
                    'grade' => "$grade($pos_group)",
                    'hotel' => 200000,
                    'uang_makan' => 30000,
                    'uang_saku' => 30000,
                );

            return $biaya_pjd;
        }
    } 

    public function get_emp_org()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.$id.'/format/json';
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

        $url = get_api_key().'users/employement/EMPLID/'.$id.'/format/json';
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

    function get_user_info($user_id)
    {
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
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

    function get_receiver_info($receiver_nik)
    {
            $url = get_api_key().'users/employement/EMPLID/'.$receiver_nik.'/format/json';
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

    public function get_tr($id)
    {
        $url = get_api_key().'users/org/EMPLID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $get_task_receiver = file_get_contents($url);
                $task_receiver = json_decode($get_task_receiver, true);
                 foreach ($task_receiver as $row)
                    {
                        $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                    }
            } else {
               $result['-']= '- Tidak ada user dengan departemen yang sama -';
            }
        $data['result']=$result;
        $this->load->view('dropdown_tc',$data);
    }

    function get_task_receiver()
    {
            $user_id = $this->session->userdata('user_id');
            $user = $this->person_model->getUsers($user_id)->row();
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
            $url_org = get_api_key().'users/org/EMPLID/'.$user->nik.'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_task_receiver = file_get_contents($url_org);
            $task_receiver = json_decode($get_task_receiver, true);
            return $this->data['task_receiver'] = $task_receiver;
            }else{
                $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
             return $this->data['task_receiver_2'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->result();
            }
    }

    function pdf($id)
    {
        $user_id = $this->session->userdata('user_id');
        if ($id == 0) {
            $task_id = $this->uri->segment(3);
        }else{
            $task_id = $id;
        }

        $title_spd = $this->db->where('id', $id)->get('users_spd_luar')->row('title');
        $title = $this->data['title'] = 'Form-SPD-Luar-'.$title_spd;
           if(is_admin()){
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin($id)->num_rows();
            }else{
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar($id)->num_rows();
            
            }
            //get task creator id
            foreach ($data_result as $dr) {
                $created_by_id = $dr->task_creator;
                $receiver_user_id = $dr->task_receiver;
                $transportation_id = $dr->transportation_id;
                $from_city_id = $dr->from_city_id;
                $to_city_id = $dr->to_city_id;
            }

            //get task creator name
            $query_result = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            foreach ($query_result as $qr) {
                $this->data['task_creator_nm'] = $qr->user_name;
            }

             //get Receiver Info From API
            $receiver_info = $this->get_receiver_info($receiver_user_id);

            $this->data['task_receiver_nm'] = (!empty($receiver_info['NAME'])) ? $receiver_info['NAME'] : '-';
            $this->data['task_receiver_org'] = (!empty($receiver_info['ORGANIZATION'])) ? $receiver_info['ORGANIZATION'] : '-';
            $this->data['task_receiver_pos'] = (!empty($receiver_info['POSITION'])) ? $receiver_info['POSITION'] : '-';

            //get User Info from API
            $this->get_user_info($created_by_id);

            //get transportation name
            $query_result = $this->form_spd_luar_model->where('id',$transportation_id)->get_transportation()->result();
            foreach ($query_result as $qr) {
                $this->data['transportation_nm'] = $qr->title;
            }
            //render transportation
            $this->data['transportation_list'] = $this->form_spd_luar_model->get_transportation()->result();
            $this->data['tl_num_rows'] = $this->form_spd_luar_model->get_transportation()->num_rows();


            //get city name
            $query_result = $this->form_spd_luar_model->where('id',$from_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['from_city_nm'] = $qr->title;
            }
            $query_result = $this->form_spd_luar_model->where('id',$to_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['to_city_nm'] = $qr->title;
            }

            //get task creator detail
            $this->data['task_creator'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            $this->data['tc_num_rows'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->num_rows();
            $this->data['task_receiver'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->result();
            $this->data['tr_num_rows'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->num_rows();

            //get user org_id
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }

            // render employee
            $this->data['employee_list'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->result();
            $this->data['el_num_rows'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->num_rows();


            // render city
            $this->data['city_list'] = $this->form_spd_luar_model->get_city()->result();
            $this->data['cl_num_rows'] = $this->form_spd_luar_model->get_city()->num_rows();
            $task_receiver_id = getAll('users_spd_luar', array('id' => 'where/'.$id))->row('task_receiver');
            $this->data['biaya_pjd'] = $this->get_biaya_pjd($id, $task_receiver_id);

            $this->load->library('mpdf60/mpdf');
            $html = $this->load->view('spd_luar_pdf', $this->data, true); 
            $mpdf = new mPDF();
            $mpdf = new mPDF('A4');
            $mpdf->WriteHTML($html);
            $mpdf->Output($id.'-'.$title.'-'.$task_creator.'pdf', 'I');
        
    }

    function detail_email_submit($id)
    {
        $user_id = $this->session->userdata('user_id');
        if ($id == 0) {
            $task_id = $this->uri->segment(3);
        }else{
            $task_id = $id;
        }
    
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if(is_admin()){
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin()->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar_admin()->num_rows();
            }else{
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar()->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$task_id)->form_spd_luar()->num_rows();
            
            }
            //get task creator id
            foreach ($data_result as $dr) {
                $created_by_id = $dr->task_creator;
                $receiver_user_id = $dr->task_receiver;
                $transportation_id = $dr->transportation_id;
                $from_city_id = $dr->from_city_id;
                $to_city_id = $dr->to_city_id;
            }

            //get task creator name
            $query_result = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            foreach ($query_result as $qr) {
                $this->data['task_creator_nm'] = $qr->user_name;
            }

             //get Receiver Info From API
            $receiver_info = $this->get_receiver_info($receiver_user_id);

            $this->data['task_receiver_nm'] = (!empty($receiver_info['NAME'])) ? $receiver_info['NAME'] : '-';
            $this->data['task_receiver_org'] = (!empty($receiver_info['ORGANIZATION'])) ? $receiver_info['ORGANIZATION'] : '-';
            $this->data['task_receiver_pos'] = (!empty($receiver_info['POSITION'])) ? $receiver_info['POSITION'] : '-';

            //get User Info from API
            $this->get_user_info($created_by_id);

            //get transportation name
            $query_result = $this->form_spd_luar_model->where('id',$transportation_id)->get_transportation()->result();
            foreach ($query_result as $qr) {
                $this->data['transportation_nm'] = $qr->title;
            }
            //render transportation
            $this->data['transportation_list'] = $this->form_spd_luar_model->get_transportation()->result();
            $this->data['tl_num_rows'] = $this->form_spd_luar_model->get_transportation()->num_rows();


            //get city name
            $query_result = $this->form_spd_luar_model->where('id',$from_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['from_city_nm'] = $qr->title;
            }
            $query_result = $this->form_spd_luar_model->where('id',$to_city_id)->get_city()->result();
            foreach ($query_result as $qr) {
                $this->data['to_city_nm'] = $qr->title;
            }

            //get task creator detail
            $this->data['task_creator'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->result();
            $this->data['tc_num_rows'] = $this->form_spd_luar_model->where('users.nik',$created_by_id)->get_emp_detail()->num_rows();
            $this->data['task_receiver'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->result();
            $this->data['tr_num_rows'] = $this->form_spd_luar_model->where('users.nik',$receiver_user_id)->get_emp_detail()->num_rows();

            //get user org_id
            $data_result = $this->form_spd_luar_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }

            // render employee
            $this->data['employee_list'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->result();
            $this->data['el_num_rows'] = $this->form_spd_luar_model->where('users_employement.organization_id',$org_id)->render_emp()->num_rows();


            // render city
            $this->data['city_list'] = $this->form_spd_luar_model->get_city()->result();
            $this->data['cl_num_rows'] = $this->form_spd_luar_model->get_city()->num_rows();
            $task_receiver_id = getAll('users_spd_luar', array('id' => 'where/'.$id))->row('task_receiver');
            $this->data['biaya_pjd'] = $this->get_biaya_pjd($id, $task_receiver_id);

            return $this->load->view('form_spd_luar/spd_luar_email', $this->data, TRUE);
        }
    }

    function detail_email_report($id)
    {
        $user_id = $this->session->userdata('user_id');

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
            $date_now = date_create($this->db->where('id', $id)->get('users_spd_luar')->row('date_spd_end'));
            $this->data['lama_pjd'] = date_diff($date_spd, $date_now)->days + 1;

            $receiver_info = $this->get_receiver_info($receiver_user_id);

            $this->data['task_receiver_nm'] = (!empty($receiver_info['NAME'])) ? $receiver_info['NAME'] : '-';
            $this->data['task_receiver_org'] = (!empty($receiver_info['ORGANIZATION'])) ? $receiver_info['ORGANIZATION'] : '-';
            $this->data['task_receiver_pos'] = (!empty($receiver_info['POSITION'])) ? $receiver_info['POSITION'] : '-';

            if(is_admin()){
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar_admin($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar_admin($id)->num_rows();
            }else{
                $data_result = $this->data['task_detail'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->result();
                $this->data['td_num_rows'] = $this->form_spd_luar_model->where('users_spd_luar.id',$id)->form_spd_luar($id)->num_rows();           
            }
            $this->data['user_folder'] = $user_folder = $this->db->where('id', $id)->get('users_spd_luar')->row('task_receiver');

            $report = $this->data['report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report()->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_model->where('users_spd_luar_report.user_spd_luar_id', $id)->form_spd_luar_report()->num_rows();
            //print_mz($this->db->last_query());
            if($n_report==0){
                $this->data['is_done'] = '';
                $this->data['tujuan'] = '';
                $this->data['hasil'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';

            
            }else{
                foreach ($report as $key) {
                $this->data['is_done'] = $key->is_done;;
                $this->data['id_report'] = $key->id;    
                $this->data['tujuan'] = $key->description;
                $this->data['hasil'] = $key->result;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}

            return $this->load->view('form_spd_luar/spd_luar_report_email', $this->data, TRUE);
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

                if(in_array($view, array('form_spd_luar/index')))
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
                    $this->template->add_js('form_spd_luar_input.js');
                    $this->template->add_js('bootstrap-timepicker.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_spd_luar/input',
                                              'form_spd_luar/report'
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
                    $this->template->add_js('jquery.slimscroll.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_spd_luar_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }
                elseif(in_array($view, array('form_spd_luar/submit')))
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
                    $this->template->add_js('jquery.slimscroll.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_spd_luar_submit.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
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
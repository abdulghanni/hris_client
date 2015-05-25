<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_cuti extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->helper('url');
        
        $this->load->database();
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_cuti/form_cuti_model','form_cuti_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {   
        $sess_nik= get_nik($this->session->userdata('user_id'));
        $sess_id= $this->session->userdata('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('form_cuti.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_cuti  
            $this->data['form_cuti_all'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->form_cuti()->result();
            
            $this->data['num_rows_all'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->form_cuti()->num_rows();

            //list of filterize limit form_cuti for pagination
            if (!$this->ion_auth->is_admin())
            { 
            $form_cuti = $this->data['form_cuti'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti()->result();
            $this->data['_num_rows'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti()->num_rows();
            
            }else{
                //print_mz($this->ion_auth->is_admin());
            $form_cuti = $this->data['form_cuti'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti_for_admin()->result();    
            $this->data['_num_rows'] = $this->form_cuti_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_cuti_for_admin()->num_rows();
            }

            $this->_render_page('form_cuti/index', $this->data);
        }
    }

    function input($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $user_id = $this->session->userdata('user_id');

            $this->get_user_info();
            $this->get_user_pengganti();
            $this->data['sisa_cuti'] = (!empty($this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'])) ? $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] : '-';

             $u = $this->data['all_users'] = $this->db->where('active', 1)->get('users');
            foreach ($u->result_array() as $row)
                    {
                        $result[$row['nik']]= ucwords(strtolower($row['username']));
                    }
            $this->data['users']=$result;

            // form cuti yang akan diambil
            $this->data['comp_session'] = $this->form_cuti_model->render_session()->result();
            $this->data['alasan_cuti'] = $this->form_cuti_model->render_alasan()->result();
           

            $this->data['_num_rows'] = $this->form_cuti_model->where('users.id',$user_id)->form_cuti_input()->num_rows();
            $this->data['alasan_num_rows'] = $this->form_cuti_model->render_alasan()->num_rows();

            $this->_render_page('form_cuti/input', $this->data);
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('start_cuti', 'Tanggal Mulai Cuti', 'trim|required');
        $this->form_validation->set_rules('end_cuti', 'Tanggal Terakhir Cuti', 'trim|required');
        $this->form_validation->set_rules('alasan_cuti', 'Alasan Cuti', 'trim|required');
        $this->form_validation->set_rules('user_pengganti', 'User Pengganti', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Cuti', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
        }
        else
        {
            $user_id= get_id($this->input->post('emp'));
            
            $start_cuti = $this->input->post('start_cuti');
            $end_cuti = $this->input->post('end_cuti');

            $year_now = date('Y');
            $comp_session_now_arr = $this->form_cuti_model->where('comp_session.year',$year_now)->render_session()->result();
            foreach ($comp_session_now_arr as $csn) {
                $comp_session_now = $csn->id;
            }

            $additional_data = array(
                'id_comp_session'       => $comp_session_now,
                'date_mulai_cuti'       => date('Y-m-d', strtotime($this->input->post('start_cuti'))),
                'date_selesai_cuti'     => date('Y-m-d', strtotime($this->input->post('end_cuti'))),
                'jumlah_hari'           => $this->input->post('jml_cuti'),
                'alasan_cuti_id'        => $this->input->post('alasan_cuti'),
                'user_pengganti'        => $this->input->post('user_pengganti'),
                'alamat_cuti'           => $this->input->post('alamat'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $this->session->userdata('user_id')
            );

            $num_rows = $this->db->get('users_cuti')->num_rows();

            if($num_rows>0){
                $cuti_id = $this->db->select('id')->order_by('id', 'asc')->get('users_cuti')->last_row();
                $cuti_id = $cuti_id->id+1;
            }else{
                $cuti_id = 1;
            }

            $jml_hari_cuti = $this->input->post('jml_cuti');
            $recid = $this->get_sisa_cuti($user_id)[0]['RECID'];
            $sisa_cuti = $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] - $jml_hari_cuti;

            if ($this->form_validation->run() == true && $this->form_cuti_model->create_($user_id,$additional_data))
            {
                 $cuti_url = base_url().'form_cuti';
                 $this->send_approval_request($cuti_id, $user_id);
                 $this->update_sisa_cuti($recid, $sisa_cuti);
                 echo json_encode(array('st' =>1, 'cuti_url' => $cuti_url));     
            }
        }
    }


    function get_sisa_cuti($user_id = null)
    {
        //$id = $this->session->userdata('user_id');
        if($user_id !=null)
        {
            $url = get_api_key().'users/sisa_cuti/EMPLID/'.get_nik($user_id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getsisa_cuti = file_get_contents($url);
                $sisa_cuti = json_decode($getsisa_cuti, true);
                return $sisa_cuti;
            } else {
                return '-';
            }
        }
    }

    function update_sisa_cuti($recid, $sisa_cuti)
    { 
     
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/sisa_cuti/RECID/'.$recid.'/ENTITLEMENT/'.$sisa_cuti;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);

        if(isset($result->status) && $result->status == 'success')  
        {  
            return TRUE;
            print_mz($this->rest->debug());
        }     
        else  
        {  
            return FALSE;
            print_mz($this->rest->debug());
        }
    }

    

    function get_user_info()
    {
            $user_id = $this->session->userdata('user_id');
            $url = get_api_key().'users/employement/EMPLID/'.get_nik($user_id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $this->data['user_info'] = $user_info;
            } else {
                $this->data['user_info'] = '';
            }
    }

    function get_user_pengganti()
    {
            $user_id = $this->session->userdata('user_id');
            $user = $this->person_model->getUsers($user_id)->row();
            $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
            $url_org = get_api_key().'users/org/EMPLID/'.$user->nik.'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_user_pengganti = file_get_contents($url_org);
            $user_pengganti = json_decode($get_user_pengganti, true);
            return $this->data['user_pengganti'] = $user_pengganti;
            }else{
                $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
             return $this->data['user_pengganti_2'] = $this->form_cuti_model->where('users_employement.organization_id',$org_id)->render_pengganti()->result();
            }
    }

    function approval_spv($id)
    { 
        $sess_id = $this->session->userdata('user_id');
        $user_cuti_id = $this->db->select('user_id')->from('users_cuti')->where('id', $id)->get()->row('user_id');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif(is_authorized($sess_id, $user_cuti_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
           
            $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
			
            $cuti_num_rows = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
		
           if ($cuti_num_rows > 0){
            foreach ($cuti_details as $cd) {
				
                $user_app_lv1 = $cd->user_app_lv1;
                $user_app_lv2 = $cd->user_app_lv2;
                $user_app_lv3 = $cd->user_app_lv3;
				$user_id = $cd->user_id;
				$user_pengganti = $cd->user_pengganti;
            }
			
			
			 $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();

			 $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
			
			$user = $this->person_model->getUsers($user_id)->row();
            $url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
					   
            } else {
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
            }

            //get app user name
            $nm_app_lv1 = $this->form_cuti_model->where('users.id',$user_app_lv1)->get_user()->result();
            $nm_app_lv2 = $this->form_cuti_model->where('users.id',$user_app_lv2)->get_user()->result();
            $nm_app_lv3 = $this->form_cuti_model->where('users.id',$user_app_lv3)->get_user()->result();
            foreach ($nm_app_lv1 as $nmlv1) {
                $this->data['nm_app_lv1'] = $nmlv1->username;
            }
            foreach ($nm_app_lv2 as $nmlv2) {
                $this->data['nm_app_lv2'] = $nmlv2->username;
            }
            foreach ($nm_app_lv3 as $nmlv3) {
                $this->data['nm_app_lv3'] = $nmlv3->username;
            }
			
			$url_pengganti = get_api_key().'users/employement/EMPLID/'.$user_pengganti.'/format/json';
            $headers = get_headers($url_pengganti);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_pengganti = file_get_contents($url_pengganti);
                $user_pengganti = json_decode($getuser_pengganti, true);
			}
			//$pengganti = $this->person_model->getNik($user_pengganti)->row();
			
             //render data
            $this->data['alasan_cuti'] = $this->form_cuti_model->render_alasan()->result();
            $this->data['user_pengganti'] = (!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;
			}else{
                $this->data['_num_rows'] = 0;
            }
            $this->data['sisa_cuti'] = (!empty($this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'])) ? $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] : '-';
            $this->data['approval_status'] = GetAll('approval_status');

            $this->_render_page('form_cuti/approval/supervisor', $this->data);
        }
    }

    function approval_kbg($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_cuti_id = $this->db->select('user_id')->from('users_cuti')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        elseif(is_authorized($sess_id, $user_cuti_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');


            //list of filterize limit form_cuti for pagination  
            $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
			$cuti_num_rows = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
		
           if ($cuti_num_rows > 0){
            foreach ($cuti_details as $cd) {
				
                $user_app_lv1 = $cd->user_app_lv1;
                $user_app_lv2 = $cd->user_app_lv2;
                $user_app_lv3 = $cd->user_app_lv3;
				$user_id = $cd->user_id;
				$user_pengganti = $cd->user_pengganti;
            }
			
			
			 $this->data['_num_rows'] = $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();

			 $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
			
			$user = $this->person_model->getUsers($user_id)->row();
            $url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';

                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
				$this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
				
				} else {
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
            }

            //get app user name
            $nm_app_lv1 = $this->form_cuti_model->where('users.id',$user_app_lv1)->get_user()->result();
            $nm_app_lv2 = $this->form_cuti_model->where('users.id',$user_app_lv2)->get_user()->result();
            $nm_app_lv3 = $this->form_cuti_model->where('users.id',$user_app_lv3)->get_user()->result();
            foreach ($nm_app_lv1 as $nmlv1) {
                $this->data['nm_app_lv1'] = $nmlv1->username;
            }
            foreach ($nm_app_lv2 as $nmlv2) {
                $this->data['nm_app_lv2'] = $nmlv2->username;
            }
            foreach ($nm_app_lv3 as $nmlv3) {
                $this->data['nm_app_lv3'] = $nmlv3->username;
            }
			
			$url_pengganti = get_api_key().'users/employement/EMPLID/'.$user_pengganti.'/format/json';
            $headers = get_headers($url_pengganti);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_pengganti = file_get_contents($url_pengganti);
                $user_pengganti = json_decode($getuser_pengganti, true);
			}
			//$pengganti = $this->person_model->getNik($user_pengganti)->row();
			
             //render data
            $this->data['alasan_cuti'] = $this->form_cuti_model->render_alasan()->result();
            $this->data['user_pengganti'] = (!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;(!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;
			
			}else{
                $this->data['_num_rows'] = 0;
            }
            $this->data['sisa_cuti'] = (!empty($this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'])) ? $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] : '-';
            $this->data['approval_status'] = GetAll('approval_status');
			
            $this->_render_page('form_cuti/approval/kabagian', $this->data);
        }
    }

    function approval_hrd($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_cuti_id = $this->db->select('user_id')->from('users_cuti')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif(is_authorized($sess_id, $user_cuti_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
            //print_mz($cuti_details);
			$cuti_num_rows = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
		  
           if ($cuti_num_rows > 0){
            foreach ($cuti_details as $cd) {
				
                $user_app_lv1 = $cd->user_app_lv1;
                $user_app_lv2 = $cd->user_app_lv2;
                $user_app_lv3 = $cd->user_app_lv3;
				$user_id = $cd->user_id;
				$user_pengganti = $cd->user_pengganti;
            }
			
			 $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
			 $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
			
			$user = $this->person_model->getUsers($user_id)->row();
            $url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
				$this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
				
				} else {
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
            }

            //get app user name
            $nm_app_lv1 = $this->form_cuti_model->where('users.id',$user_app_lv1)->get_user()->result();
            $nm_app_lv2 = $this->form_cuti_model->where('users.id',$user_app_lv2)->get_user()->result();
            $nm_app_lv3 = $this->form_cuti_model->where('users.id',$user_app_lv3)->get_user()->result();
            foreach ($nm_app_lv1 as $nmlv1) {
                $this->data['nm_app_lv1'] = $nmlv1->username;
            }
            foreach ($nm_app_lv2 as $nmlv2) {
                $this->data['nm_app_lv2'] = $nmlv2->username;
            }
            foreach ($nm_app_lv3 as $nmlv3) {
                $this->data['nm_app_lv3'] = $nmlv3->username;
            }
			
			$url_pengganti = get_api_key().'users/employement/EMPLID/'.$user_pengganti.'/format/json';
            $headers = get_headers($url_pengganti);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_pengganti = file_get_contents($url_pengganti);
                $user_pengganti = json_decode($getuser_pengganti, true);
			}
			//$pengganti = $this->person_model->getNik($user_pengganti)->row();
			
             //render data
            $this->data['alasan_cuti'] = $this->form_cuti_model->render_alasan()->result();
            $this->data['user_pengganti'] = (!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;
			
			}else{
                $this->data['_num_rows'] = 0;
            }
            $this->data['sisa_cuti'] = (!empty($this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'])) ? $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] : '-';
            $this->data['approval_status'] = GetAll('approval_status');
            $this->_render_page('form_cuti/approval/hr', $this->data);
        }
    }

    public function do_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
        'is_app_lv1' => 1,
        'approval_status_id_lv1' => $this->input->post('app_status'),
        'note_app_lv1' => $this->input->post('notes_spv'), 
        'user_app_lv1' => $user_id, 
        'date_app_lv1' => $date_now);

        $approval_status = $this->input->post('app_status');

       if ($this->form_cuti_model->update($id,$additional_data)) {
		   
           return TRUE;
       }

       $this->approval_mail($id, $approval_status,'spv', 'Supervisor');
	   $this->cek_all_approval($id);
    }

    public function update_approve_spv($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
        'is_app_lv1' => 1,
        'approval_status_id_lv1' => $this->input->post('app_status_update'),
        'note_app_lv1' => $this->input->post('notes_spv_update'), 
        'user_app_lv1' => $user_id, 
        'date_app_lv1' => $date_now);

        $approval_status = $this->input->post('app_status_update');
        
        $this->form_cuti_model->update($id,$additional_data);
        $this->approval_mail($id, $approval_status,'spv','Supervisor');
		$this->cek_all_approval($id);
        redirect('form_cuti/approval_spv/'.$id, 'refresh');
       
    }

    public function do_approve_kbg($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
        'is_app_lv2' => 1,
        'approval_status_id_lv2' => $this->input->post('app_status'),
        'note_app_lv2' => $this->input->post('notes_kbg'), 
        'user_app_lv2' => $user_id, 
        'date_app_lv2' => $date_now);

        $approval_status = $this->input->post('app_status');
       if ($this->form_cuti_model->update($id,$additional_data)) {
           return TRUE;
       }
        $this->approval_mail($id, $approval_status,'kbg', 'Ka. Bagian');
		$this->cek_all_approval($id);
    }

    public function update_approve_kbg($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
        'is_app_lv2' => 1,
        'approval_status_id_lv2' => $this->input->post('app_status_update'),
        'note_app_lv2' => $this->input->post('notes_kabag_update'), 
        'user_app_lv2' => $user_id, 
        'date_app_lv2' => $date_now);

        $approval_status = $this->input->post('app_status_update');

        $this->form_cuti_model->update($id,$additional_data);
        $this->approval_mail($id, $approval_status,'kbg', 'Ka. Bagian');
		$this->cek_all_approval($id);

        redirect('form_cuti/approval_kbg/'.$id, 'refresh');
       
    }

    public function do_approve_hr($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
                'is_app_lv3' => 1,
                'approval_status_id_lv3' => $this->input->post('app_status'),
                'user_app_lv3' => $user_id, 
                'date_app_lv3' => $date_now,
                'note_app_lv3' => $this->input->post('notes_hrd')
                );

        $approval_status = $this->input->post('app_status');
	
		   
       if ($this->form_cuti_model->update($id,$additional_data)) {
           
           return TRUE;
	   }
           $this->approval_mail($id, $approval_status,'hrd', 'HRD');
		   $this->cek_all_approval($id);
    }

    public function update_approve_hr($id)
    {
        $user_id = $this->session->userdata('user_id');
        $date_now = date('Y-m-d');
        $cuti_id = $this->input->post('cuti_id');

        $additional_data = array(
        'is_app_lv3' => 1,
        'approval_status_id_lv3' => $this->input->post('app_status_update'),
        'note_app_lv3' => $this->input->post('notes_hrd_update'), 
        'user_app_lv3' => $user_id, 
        'date_app_lv3' => $date_now);

        $approval_status = $this->input->post('app_status_update');

        $this->form_cuti_model->update($id,$additional_data);
        $this->approval_mail($id, $approval_status,'hrd', 'HRD');
		$this->cek_all_approval($id);

        redirect('form_cuti/approval_hrd/'.$id, 'refresh');
       
    }

    function send_approval_request($id, $sender_id)
    {

        $url = base_url().'form_cuti/approval_';
        if(is_have_superior($sender_id))
        {
            $data = array(
                    'sender_id' => get_nik($sender_id),
                    'receiver_id' => $this->form_cuti_model->get_superior_id($sender_id)->row('superior_id'),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permohonan Cuti',
                    'email_body' => get_name($sender_id).' mengajukan permohonan cuti, untuk melihat detail silakan <a href='.$url.'spv/'.$id.'>Klik Disini</a>',
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
            $current_superior = get_id($this->form_cuti_model->get_superior_id($sender_id)->row('superior_id'));
        }else{
        $current_superior = 0;
        }
        
        if(!empty(get_superior($current_superior)))
        {
            $data = array(
                    'sender_id' => get_nik($sender_id),
                    'receiver_id' => get_superior($current_superior),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan Permohonan Cuti',
                    'email_body' => get_name($sender_id).' mengajukan permohonan cuti, untuk melihat detail silakan <a href='.$url.'kbg/'.$id.'>Klik Disini</a>',
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        }

       

        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Permohonan Cuti',
                'email_body' => get_name($sender_id).' mengajukan permohonan cuti, untuk melihat detail silakan <a href='.$url.'hrd/'.$id.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id, $approval_status, $type_url, $type)
    {
        $url = base_url().'form_cuti/approval_'.$type_url.'/'.$id;
        $approver = get_name(get_nik($this->session->userdata('user_id')));
        $receiver_id = $this->db->where('id', $id)->get('users_cuti')->row('user_id');
        $approval_status = $this->db->where('id', $approval_status)->get('approval_status')->row('title');
        $data = array(
                'sender_id' => get_nik($this->session->userdata('user_id')),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan Cuti dari '.$type,
                'email_body' => "Status pengajuan permohonan cuti anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a>",
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }
	
	function cek_all_approval($id)
	{
		$approval_status_id_lv1=$this->db->where('users_cuti.id',$id)->get('users_cuti')->row('approval_status_id_lv1');
		$approval_status_id_lv2=$this->db->where('users_cuti.id',$id)->get('users_cuti')->row('approval_status_id_lv2');
		$approval_status_id_lv3=$this->db->where('users_cuti.id',$id)->get('users_cuti')->row('approval_status_id_lv3');
		$user_id = $this->db->where('users_cuti.id', $id)->get('users_cuti')->row('user_id');
		if($approval_status_id_lv1 == 1 && $approval_status_id_lv2 == 1 && $approval_status_id_lv3 == 1)
		{
			// Start date
			 $date = $this->db->where('users_cuti.id', $id)->get('users_cuti')->row('date_mulai_cuti');
			 // End date
			 $end_date = $this->db->where('users_cuti.id', $id)->get('users_cuti')->row('date_selesai_cuti');
			 
			 while (strtotime($date) <= strtotime($end_date)) {
			 $data = array(
							'nik'		=> get_mchid($user_id),
							'jhk'		=> 1,
							'cuti'		=> 1,
							'tanggal' 	=> date("d", strtotime($date)),
							'bulan' 	=> date("m", strtotime($date)),
							'tahun'		=> date("Y", strtotime($date)),
							'create_date' => date('Y-m-d',strtotime('now')),
							'create_user_id' => $this->session->userdata('user_id'),
						);
			 $this->db->insert('attendance', $data);
			 
			 $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			 }
		}
	}


    function form_cuti_pdf($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $user_cuti_id = $this->db->select('user_id')->from('users_cuti')->where('id', $id)->get()->row('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        elseif(is_authorized($sess_id, $user_cuti_id) == FALSE)
        {

            return show_error('You do not have authorization to view this page.');
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');


            //list of filterize limit form_cuti for pagination  
            $cuti_details = $this->data['form_cuti'] = $this->form_cuti_model->form_cuti_supervisor($id)->result();
            $cuti_num_rows = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();
        
           if ($cuti_num_rows > 0){
            foreach ($cuti_details as $cd) {
                
                $user_app_lv1 = $cd->user_app_lv1;
                $user_app_lv2 = $cd->user_app_lv2;
                $user_app_lv3 = $cd->user_app_lv3;
                $user_id = $cd->user_id;
                $user_name = $cd->first_name.'_'.$cd->last_name;
                $user_pengganti = $cd->user_pengganti;
            }
            
            
             $this->data['_num_rows'] = $this->data['_num_rows'] = $this->form_cuti_model->form_cuti_supervisor($id)->num_rows();

             $data_result = $this->form_cuti_model->where('users.id',$user_id)->get_org_id()->result();
            foreach ($data_result as $dr) {
                $org_id = $dr->organization_id;
            }
            
            $user = $this->person_model->getUsers($user_id)->row();
            $url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $this->data['nik'] = (!empty($user_info['EMPLID'])) ? $user_info['EMPLID'] : '-';
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';

                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
                
                } else {
                $this->data['nik'] = (!empty($user_info['EMPLID'])) ? $user_info['EMPLID'] : '-';
                $this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
                $this->data['position'] = (!empty($user_emp->position)) ? $user_emp->position : (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
                $this->data['organization'] = (!empty($user_emp->organization)) ? $user_emp->organization : (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
            }

            //get app user name
            $nm_app_lv1 = $this->form_cuti_model->where('users.id',$user_app_lv1)->get_user()->result();
            $nm_app_lv2 = $this->form_cuti_model->where('users.id',$user_app_lv2)->get_user()->result();
            $nm_app_lv3 = $this->form_cuti_model->where('users.id',$user_app_lv3)->get_user()->result();
            foreach ($nm_app_lv1 as $nmlv1) {
                $this->data['nm_app_lv1'] = $nmlv1->username;
            }
            foreach ($nm_app_lv2 as $nmlv2) {
                $this->data['nm_app_lv2'] = $nmlv2->username;
            }
            foreach ($nm_app_lv3 as $nmlv3) {
                $this->data['nm_app_lv3'] = $nmlv3->username;
            }
            
            $url_pengganti = get_api_key().'users/employement/EMPLID/'.$user_pengganti.'/format/json';
            $headers = get_headers($url_pengganti);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_pengganti = file_get_contents($url_pengganti);
                $user_pengganti = json_decode($getuser_pengganti, true);
            }
            //$pengganti = $this->person_model->getNik($user_pengganti)->row();
            
             //render data
            $this->data['alasan_cuti'] = $this->form_cuti_model->render_alasan()->result();
            $this->data['user_pengganti'] = (!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;(!empty($user_pengganti['NAME'])) ? $user_pengganti['NAME'] : '-' ;
            
            }else{
                $this->data['_num_rows'] = 0;
            }
        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Cuti-'.$user_name;
        $this->data['sisa_cuti'] = (!empty($this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'])) ? $this->get_sisa_cuti($user_id)[0]['ENTITLEMENT'] : '-';

        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('cuti_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
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

    public function get_emp_sen_date()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $sen_date= dateIndo($user_info['SENIORITYDATE']);
            } else {
                $sen_date = '';
            }

        echo $sen_date;
    }

    public function get_emp_nik()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/employement/EMPLID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $nik= $user_info['EMPLID'];
            } else {
                $nik = '';
            }

        echo $nik;
    }

    function get_emp_sisa_cuti()
    {
        $id = $this->input->post('id');

        $url = get_api_key().'users/sisa_cuti/EMPLID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $sisa_cuti = $user_info[0]['ENTITLEMENT'];
            } else {
                $sisa_cuti = '';
            }

        echo $sisa_cuti;
    }

    public function get_up($id)
    {
        $url = get_api_key().'users/org/EMPLID/'.$id.'/format/json';
        //print_r($url);
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $get_task_receiver = file_get_contents($url);
                $task_receiver = json_decode($get_task_receiver, true);
                 foreach ($task_receiver as $row)
                    {
                        $result['0']= '-- Pilih User --';
                        $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                    }
            } else {
               $result['-']= '- Tidak ada user dengan departemen yang sama -';
            }
        $data['result']=$result;
        $this->load->view('dropdown_up',$data);
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

                if(in_array($view, array('form_cuti/index')))
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
                    $this->template->add_js('form_cuti.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_cuti/input','form_cuti/page_prints')))
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
                    $this->template->add_js('form_cuti.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
                     
                }elseif(in_array($view, array('form_cuti/approval/supervisor',
                                              'form_cuti/approval/kabagian',
                                              'form_cuti/approval/hr')))
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
                    $this->template->add_js('form_cuti.js');

                    
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

/* End of file form_cuti.php */
/* Location: ./application/modules/form_cuti/controllers/form_cuti.php */
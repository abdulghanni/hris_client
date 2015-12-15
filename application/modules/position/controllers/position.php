<?php defined('BASEPATH') OR exit('No direct script access allowed');

class position extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('position/position_model','position_model');
        
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
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
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
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('position.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all position  
            $this->data['position_all'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->position()->result();
            
            $this->data['num_rows_all'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->position()->num_rows();

            //list of filterize limit position for pagination  
            $this->data['position'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->position()->result();

            $this->data['_num_rows'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->position()->num_rows();

             //config pagination
             $config['base_url'] = base_url().'position/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->get_bu();
            $f_competency_group = array(
                "is_deleted"=>"where/0"
                );
            $q_competency_group = GetAll('competency_group',$f_competency_group);
            $this->data['competency_group'] = ($q_competency_group->num_rows() > 0 ) ? $q_competency_group : array();
            $this->_render_page('position/index', $this->data);
        }
    }

    function get_table($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
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
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('position.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = $offset = $this->uri->segment(6);

            //list of filterize all position  
            $this->data['position_all'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->position()->result();

            $this->data['num_rows_all'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->position()->num_rows();

            //list of filterize limit position for pagination  
            $this->data['position'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->position()->result();

            $this->data['_num_rows'] = $this->position_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->position()->num_rows();

             //config pagination
             $config['base_url'] = base_url().'position/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
             $config['total_rows'] = $this->data['num_rows_all'];
             $config['per_page'] = $limit;
             $config['uri_segment'] = $offset = $this->uri->segment(6);

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

            $this->_render_page('position/table/index', $this->data);
        }
    }
	public function get_modal(){
			if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {      
            //list of filterize limit position for pagination  
            $this->data['position'] = $this->position_model->position()->result();
			
			$f_position_group = array("is_deleted" => 0);
            $q_position_group = GetAll('position_group', $f_position_group);
            $this->data['position_group'] = ($q_position_group->num_rows() > 0 ) ? $q_position_group : array();

            $f_parent = array("is_deleted" => 0);
            $q_parent = GetAll('position', $f_parent);
			$this->data['q_parent'] = $q_parent;
            $this->data['parent'] = ($q_parent->num_rows() > 0 ) ? $q_parent : array();
			
			$f_organization = array("is_deleted" => 0);
            $q_organization = GetAll('organization', $f_organization);
            $this->data['organization'] = ($q_organization->num_rows() > 0 ) ? $q_organization : array();

            $this->_render_page('position/modal/index', $this->data);
		}
	}

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $title = $this->input->post('title');
            $base = base_url();

            if($title=null){
                echo json_encode(array('st'=>0));
            }else{
                echo json_encode(array('st' =>1, 'title'=>$this->input->post('title'), 'base_url' => $base));
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
        }
        else
        {         
            $data = array(
                    'title'             => $this->input->post('title'),
                    'abbr'             => $this->input->post('abbr'),
					'position_group_id'      => $this->input->post('position_group_id'),
					'parent_position_id'      => $this->input->post('parent_position_id'),
					'organization_id'      => $this->input->post('organization_id'),
					'description'             => $this->input->post('description'),
					'edited_on'        => date('Y-m-d H:i:s',strtotime('now')),
					'edited_by'        => $this->session->userdata('user_id'),
                    );

            $this->position_model->update($id, $data);

            echo json_encode(array('st'=>1));
            
        }

    }

    public function delete($id)
    {
        $data = array(
                'is_deleted'    => 1,
                'deleted_on'    =>date('Y-m-d H:i:s',strtotime('now')),
                'deleted_by'    =>$this->session->userdata('user_id'),
                );

        $this->position_model->update($id, $data);

        echo json_encode(array('st'=>1));
    }

    public function add()
    {
        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
        }
        else
        {
           
            $title    = $this->input->post('title');

            $additional_data = array(
                'abbr'             => $this->input->post('abbr'),
                'position_group_id'      => $this->input->post('position_group_id'),
                'parent_position_id'      => $this->input->post('parent_position_id'),
				'organization_id'      => $this->input->post('organization_id'),
                'description'             => $this->input->post('description'),
                'created_on'        => date('Y-m-d H:i:s',strtotime('now')),
                'created_by'        => $this->session->userdata('user_id'),
            );

            if ($this->form_validation->run() == true && $this->position_model->create_($title, $additional_data))
            {
                echo json_encode(array('st'=>1));   
            }else{
                echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
        }
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

    public function get_org()
    {
        $id = $this->input->post('id');$id = substr($id, 0,2);
        //$url = get_api_key().'users/org_from_parent_org/ORGID/'.$id.'/format/json';
        $url = get_api_key().'users/org_from_bu/BUID/'.$id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                 foreach ($user_info as $row)
        {
            $result[$row['ID']]= $row['DESCRIPTION'];
        }
        } else {
           $result['']= '- Belum Ada Bagian -';
        }
        $data['result']=$result;
        $this->load->view('dropdown_org',$data);
    }

    public function get_child_org()
    {
        $id = $this->input->post('id');
        //$id = '522130000';
        //$url = get_api_key().'users/org_from_parent_org/ORGID/'.$id.'/format/json';
        $url = get_api_key().'users/org_from_parent_org/ORGID/'.$id.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                $result[0]= "-- Pilih Bagian --";
                 foreach ($user_info as $row)
                 {
                    $result[$row['ID']]= $row['DESCRIPTION'];
                 }

                 $data['result']=$result;
                 $view = $this->load->view('dropdown_org',$data, true);
                 echo json_encode(array('st'=>1, 's'=>$view));
                 //$this->load->view('dropdown_org',$data);
        }else{
            echo json_encode(array('st'=>0, 's'=>false));
        }
    }

    function get_pos($id = null)
    {
        $url = get_api_key().'users/pos_from_org/ORGID/'.$id.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
             $get_position = file_get_contents($url);
             $this->data['position'] = $position = json_decode($get_position, true);
             $this->data['id'] = $id;
             $this->load->view('table',$this->data);
             //echo json_encode(array('st'=>0, 's'=>$view));
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

                if(in_array($view, array('position/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('position.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                }
                elseif(in_array($view, array('position/edit')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jqueryblockui.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('pace.min.js');
                    $this->template->add_js('core.js');
                    
                    $this->template->add_js('select2.min.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('pace-theme-flash.css');
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

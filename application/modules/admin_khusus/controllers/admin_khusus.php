<?php defined('BASEPATH') OR exit('No direct script access allowed');

class admin_khusus extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('admin_khusus_model');
        $this->lang->load('auth');
        $this->load->helper('language');

    }

    function index($fname = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    { 
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            $id = $this->session->userdata('user_id');
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            redirect('person/detail/'.$id);
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
        $this->data['fname_param'] = $fname; 
        $exp_fname = explode(":",$fname);
        $fname_re = str_replace("_", " ", $exp_fname[1]);
        $fname_post = (strlen($fname_re) > 0) ? array('users.username'=>$fname_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 25 ;

        $this->data['offset'] = 6;

        //list of filterize all admin_khusus  
        $this->data['admin_khusus_all'] = $this->admin_khusus_model->like($fname_post)->where('is_deleted',0)->admin_khusus()->result();
        
        $this->data['num_rows_all'] = $this->admin_khusus_model->like($fname_post)->where('is_deleted',0)->admin_khusus()->num_rows();
        
        $this->data['admin_khusus'] = $this->admin_khusus_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->admin_khusus()->result();
        //print_mz($this->data['admin_khusus']);
        //list of filterize limit admin_khusus for pagination  d();
        $this->data['_num_rows'] = $this->admin_khusus_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->admin_khusus()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'admin_khusus/index/fn:'.$exp_fname[1].'/'.$sort_by.'/'.$sort_order.'/';
         $config['total_rows'] = $this->data['num_rows_all'];
         $config['per_page'] = $limit;
         $config['uri_segment'] = 6;

        //inisialisasi config
         $this->pagination->initialize($config);

        //create pagination
        $this->data['halaman'] = $this->pagination->create_links();

        $this->data['fname_search'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('title'),
        );

        $this->data['users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
        $this->data['nik'] = array(
                'name'  => 'nik',
                'id'    => 'nik',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nik'),
                'required' => 'required'
            );

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'placeholder' => lang('create_user_validation_fname_label'),
                'value' => $this->form_validation->set_value('first_name'),
                'required' => 'required'
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'placeholder' => lang('create_user_validation_lname_label'),
                'value' => $this->form_validation->set_value('last_name'),
                'required' => 'required'
            );

            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
                'required' => 'required'
            );

            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
                'required' => 'required'
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
                'required' => 'required'
            );

            $this->get_bu();

            $this->_render_page('admin_khusus/index', $this->data);
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
            $fname_post = (strlen($this->input->post('first_name')) > 0) ? strtolower(url_title($this->input->post('first_name'),'_')) : "" ;

            redirect('admin_khusus/index/fn:'.$fname_post, 'refresh');
        }
    }

    function add(){
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
            }else{
                $tables = $this->config->item('tables','ion_auth');
                $sess_id = $this->session->userdata('user_id');
                //validate form input
                $this->form_validation->set_rules('nik', $this->lang->line('register_nik_label'), 'required|xss_clean');
                $this->form_validation->set_rules('first_name', $this->lang->line('register_firstname_label'), 'required|xss_clean');
                $this->form_validation->set_rules('last_name', $this->lang->line('register_lastname_label'), 'required|xss_clean');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
                $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

                if ($this->form_validation->run() == true)
                {
                        $username = strtolower($this->input->post('first_name')) . '' . strtolower($this->input->post('last_name'));
                        $email    = strtolower($this->input->post('email'));
                        $password = $this->input->post('password');

                        $additional_data = array(
                            'first_name'            => $this->input->post('first_name'),
                            'last_name'             => $this->input->post('last_name'),
                            'nik'                   => $this->input->post('nik'),
                            
                        );

                if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
                {
                    $data = array(
                            'nik' => $this->input->post('nik'),
                            'organization_id' => $this->input->post('org'),
                            'created_by' => $sess_id,
                            'created_on' => date('Y-m-d'),
                        );
                    $this->db->insert('users_admin_khusus', $data);
                    $this->db->where('nik', $this->input->post('nik'))->update('users', array('active' => 1));
                    redirect('admin_khusus','refresh');
                }
            }
        }
    }

public function check_user()
{
    $nik=$this->input->post('nik');
    $num_rows = getValue('nik', 'users', array('nik'=>'where/'.$nik));
    if(!empty($num_rows))
    {
        echo "false";
    }
    else{
        echo "true";
    }
}

public function get_org($id)
    {
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

    function update()
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
        }else{
            $id = $this->input->post('id');
            $data = array(
                'nik' => $this->input->post('nik_update'),
                'edited_on'            => date('Y-m-d',strtotime('now')),
                'edited_by'            => $this->session->userdata('user_id'),
                );

            $this->db->where('id',$id)->update('users_admin_khusus', $data);
        }
    }

    function delete()
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
        }else{
            $id = $this->input->post('id');
            $data = array(
                'is_deleted' => 1,
                'deleted_on'            => date('Y-m-d',strtotime('now')),
                'deleted_by'            => $this->session->userdata('user_id'),
                );

            $this->db->where('id',$id)->update('users_admin_khusus', $data);
            return true;
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

    function _render_page($view, $data=null, $render=false)
    {
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('admin_khusus/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('admin_khusus.js');
                    
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
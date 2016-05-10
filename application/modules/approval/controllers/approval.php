<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('approval_model');
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

        //list of filterize all approval  
        $this->data['approval_all'] = $this->approval_model->like($fname_post)->where('is_deleted',0)->approval()->result();
        
        $this->data['num_rows_all'] = $this->approval_model->like($fname_post)->where('is_deleted',0)->approval()->num_rows();
        
        $this->data['approval'] = $this->approval_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->approval()->result();

        //list of filterize limit approval for pagination  d();
        $this->data['_num_rows'] = $this->approval_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->approval()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'approval/index/fn:'.$exp_fname[1].'/'.$sort_by.'/'.$sort_order.'/';
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
        $this->data['form_type'] = getAll('form_type', array('is_deleted'=>'where/0'));
        $this->get_bu();
            $this->_render_page('approval/index', $this->data);
        }
    }

    function get_table(){
        $this->data['bu'] = substr($this->input->post('id'),0,2);//print_mz($this->data['bu']);
        $this->data['form'] = GetAllSelect('form_type', 'id, indo', array('is_deleted'=>'where/0'))->result();
        $this->load->view('approval/table', $this->data);
    }

    function get_table_by_name(){
        $this->load->model('approval_model', 'app');
        $name = $this->input->post('name');
        $this->data['bu'] = $bu = substr($this->input->post('bu'),0,2);//print_mz($this->data['bu']);
        $this->data['form'] = $this->app->get_table($bu, $name)->result();
        $this->load->view('approval/table_name', $this->data);
    }

    function get_modal($bu, $form_id){
        $data = getValue('user_nik', 'users_approval', array('bu'=>'where/'.$bu, 'form_type_id'=>'where/'.$form_id));
        echo $data;
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

            redirect('approval/index/fn:'.$fname_post, 'refresh');
        }
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
            $bu = $this->input->post('id');
            $form = $this->input->post('form_type_id');
            $data = array(
                'user_nik' => $this->input->post('nik'),
                'form_type_id' => $form,
                'bu'=> $bu
                );
            $num = getAll('users_approval', array('form_type_id'=>'where/'.$form, 'bu'=>'where/'.$bu))->num_rows();
            if($num>0)$this->db->where('bu',$bu)->where('form_type_id', $form)->update('users_approval', $data);
            else $this->db->insert('users_approval', $data);

            echo json_encode(array('status'=>true));
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

                if(in_array($view, array('approval/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('approval.js');
                    
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
            if($row['NUM'] != null){
            $result[substr($row['NUM'], 0, 2)]= ucwords(strtolower($row['DESCRIPTION']));
            }
        }
            return $this->data['bu'] = $result;
        } else {
            return $this->data['bu'] = '';
        }
    }
}
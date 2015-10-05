<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_template extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_template_model');
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
        $fname_post = (strlen($fname_re) > 0) ? array('form_template.title'=>$fname_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 25 ;

        $this->data['offset'] = 6;

        //list of filterize all form_template  
        $this->data['form_template_all'] = $this->form_template_model->like($fname_post)->where('is_deleted',0)->form_template()->result();
        
        $this->data['num_rows_all'] = $this->form_template_model->like($fname_post)->where('is_deleted',0)->form_template()->num_rows();
        
        $this->data['form_template'] = $this->form_template_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_template()->result();

        //list of filterize limit form_template for pagination  d();
        $this->data['_num_rows'] = $this->form_template_model->like($fname_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_template()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'form_template/index/fn:'.$exp_fname[1].'/'.$sort_by.'/'.$sort_order.'/';
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

        $this->data['template'] = getAll('form_template');

            $this->_render_page('form_template/index', $this->data);
        }
    }

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $fname_post = (strlen($this->input->post('first_name')) > 0) ? strtolower(url_title($this->input->post('first_name'),'_')) : "" ;

            redirect('form_template/index/fn:'.$fname_post, 'refresh');
        }
    }

    function add(){
        if (!$this->ion_auth->logged_in())
            {
                //redirect them to the login page
                redirect('auth/login', 'refresh');
            }
        elseif (!$this->ion_auth->is_admin())
            {
                return show_error('You must be an administrator to view this page.');
        }else{
                $data = array(
                'form_template_id' => $this->input->post('form_template_id'),
                'keterangan'    => $this->input->post('keterangan'),
                'created_by' => $this->session->userdata('user_id'),
                'created_on' => date('Y-m-d',strtotime('now')),
                );

                $this->db->insert('users_form_template', $data);
                $id = $this->db->insert_id(); 
                $this->upload_attachment($id);
                redirect('form_template','refresh');
        }
    }

    function update($id)
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }else{
            //$id = $this->input->post('id');
            $data = array(
            'form_template_id' => $this->input->post('form_template_id'),
            'keterangan'    => $this->input->post('keterangan'),
            'edited_by' => $this->session->userdata('user_id'),
            'edited_on' => date('Y-m-d',strtotime('now')),
            );
            $this->db->where('id', $id);
            $this->db->update('users_form_template', $data); 
            $this->upload_attachment($id);
            redirect('form_template','refresh');
        }
    }

    function delete()
    {
         if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
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

            $this->db->where('id',$id)->update('users_form_template', $data);
            return true;
        }
    }

    function upload_attachment($id)
    {
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads', 0777);
        }
        if(!is_dir('./uploads/template')){
        mkdir('./uploads/template', 0777);
        }


        $path = "./uploads/template";
        $this->upload->initialize(array(
            "upload_path"=>$path,
            "overwrite" => TRUE,
            "allowed_types"=>"*"
        ));

       if($this->upload->do_multi_upload("file"))
        {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $data = array(
                    'file' => $file_name,
                );
            $this->db->where('id', $id)->update('users_form_template', $data);
            return true;
        }else{
            $data = array(
                    'file' => '',
                );
            $this->db->where('id', $id)->update('users_form_template', $data);
            return false;
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

                if(in_array($view, array('form_template/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');

                    $this->template->add_js('form_template.js');
                    
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
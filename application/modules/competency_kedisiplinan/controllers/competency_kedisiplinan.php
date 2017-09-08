<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class competency_kedisiplinan extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('competency_kedisiplinan_model','competency_kedisiplinan_model');
    }

    var $title = 'Kompetensi kedisiplinan';
    var $limit = 100000;
    var $controller_name = 'competency_kedisiplinan';
    var $model_name = 'competency_kedisiplinan_model';
    var $id_table = 'id';
    var $list_view = 'competency_kedisiplinan/index';

    //redirect if needed, otherwise display the user list
    function index($id=NULL)
    {

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!is_admin_kompetensi()&&!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $data['url_ajax_list'] = site_url('competency_kedisiplinan/ajax_list');
            $data['url_ajax_add'] = site_url('competency_kedisiplinan/ajax_add');
            $data['url_ajax_edit'] = site_url('competency_kedisiplinan/ajax_edit');
            $data['url_ajax_delete'] = site_url('competency_kedisiplinan/ajax_delete');
            $data['url_ajax_update'] = site_url('competency_kedisiplinan/ajax_update');

            $this->_render_page('competency_kedisiplinan/index',$data);
        }
    }

    public function ajax_list()
    {
        $list = $this->competency_kedisiplinan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $val->title;
            $row[] = $val->bobot;
            $row[] = $val->target;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_('."'".$val->id."'".')"><i class="icon-edit"></i> Edit</a>
            <a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_('."'".$val->id."'".')"><i class="icon-remove"></i> Delete</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->competency_kedisiplinan_model->count_all(),
                        "recordsFiltered" => $this->competency_kedisiplinan_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
                'bobot' => $this->input->post('bobot'),
                'target' => $this->input->post('target'),
                'created_on' => date('Y-m-d H:i:s', now()),
                'created_by' => GetUserID()
                );
        $insert = $this->competency_kedisiplinan_model->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $data = array(
                'is_deleted' => 1,
                'deleted_on' => date('Y-m-d H:i:s', now()),
                'deleted_by' => GetUserID()
            );
        $this->competency_kedisiplinan_model->update(array('id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->competency_kedisiplinan_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
                'bobot' => $this->input->post('bobot'),
                'target' => $this->input->post('target'),
                'edited_on' => date('Y-m-d H:i:s', now()),
                'edited_by' => GetUserID()
            );
        $this->competency_kedisiplinan_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Judul wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('bobot') == '')
        {
            $data['inputerror'][] = 'bobot';
            $data['error_string'][] = 'Bobot wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('target') == '')
        {
            $data['inputerror'][] = 'target';
            $data['error_string'][] = 'Target wajib diisi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
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

            if (in_array($view, array('competency_kedisiplinan/index')))
            {
                $this->template->set_layout('default');

                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_js('main.js');
                $this->template->add_js('respond.min.js');

                
                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_css('datatables.min.css');
                $this->template->add_js('datatables.min.js');
                
                $this->template->add_js('competency_kedisiplinan.js');
                    
            }

            if(in_array($view, array('auth/login')))
            {
                $this->template->set_layout('layout_login');    
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

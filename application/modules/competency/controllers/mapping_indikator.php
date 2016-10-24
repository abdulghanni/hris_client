<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class mapping_indikator extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('competency');

        $this->load->database();


        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('mapping_indikator_model','main');
    }

    var $title = 'Mapping Indikator';
    var $limit = 100000;
    var $controller = 'competency/mapping_indikator';
    var $model_name = 'mapping_indikator_model';
    var $table = 'competency_mapping_indikator';
    var $id_table = 'id';
    var $list_view = 'mapping_indikator/index';

    //redirect if needed, otherwise display the user list
    function index($id=NULL)
    {

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
            $data['title'] = $this->title;
            $data['url_ajax_list'] = site_url('mapping_indikator/ajax_list');
            $data['url_ajax_add'] = site_url('mapping_indikator/ajax_add');
            $data['url_ajax_edit'] = site_url('mapping_indikator/ajax_edit');
            $data['url_ajax_delete'] = site_url('mapping_indikator/ajax_delete');
            $data['url_ajax_update'] = site_url('mapping_indikator/ajax_update');
            $data['org'] = $this->competency->get_organization();

            $this->_render_page('mapping_indikator/index',$data);
        }
    }

    function input($org_id = null){
        permission();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['org_id'] = $org_id;
        $data['competency_group'] = GetAll('competency_group')->result();
        $level_av = getAll('competency_level')->result();
        $levelx = array();
        foreach ($level_av as $r) {
            $levelx[] = $r->level;
        }

        $data['level'] = $level = array_unique($levelx);
        $data['pg_size'] = sizeof($level);
        $data['col'] = 80/sizeof($level);
        $this->_render_page('mapping_indikator/input', $data);
    }

    function add(){
        permission();
        $this->form_validation->set_rules('competency_def_id', 'Kompetensi', 'trim|required');
        $approver_id = $this->input->post('approver_id');
        $level = array_unique($this->input->post('level'));
        $l = $this->input->post('indikator');
        $comp_def = $this->input->post('competency_def_id');

        // INSERT TO COMPETENCY_MAPPING_indikator
        $data = array(
            'organization_id' => $this->input->post('org_id'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );
        $this->db->insert($this->table, $data);

        // INSERT TO COMPETENCY_MAPPING_indikator_DETAIL
        foreach ($l as $key => $value) {
            if(in_array($key, $comp_def)){
                foreach ($value as $k => $v) {
                    $data = array(
                        'organization_id' => $this->input->post('org_id'),
                        'competency_def_id' => $key,
                        'level' => $level[$k],
                        'indikator' => $v
                        );
                    $this->db->insert($this->table.'_detail', $data);
                }
            }
        }

        // INSERT TO COMPETENCY_MAPPING_indikator_APPROVER
        for ($i=0;$i<sizeof($approver_id);$i++) {
            $data = array(
                'organization_id' => $this->input->post('org_id'),
                'user_id' => $approver_id[$i],
                'created_by'=>sessId(),
                'created_on'=>dateNow(),
            );
            $this->db->insert($this->table.'_approver', $data);//print_ag(lq());
        }
        redirect(base_url($this->controller), 'refresh');
    }
    // FOR js
    function get_mapping_from_org($org_id){
       $data['org_id'] = $org_id;
        $data['competency_group'] = GetAll('competency_group')->result();
        // $data['data'] = GetAll($this->table.'_detail', array('organization_id'=>'where/'.$org_id));
        $data['approver'] = GetAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id));
        $data['data'] = $this->main->indikator($org_id);
        $data['org_id'] = $org_id;
        $data['competency_group'] = GetAll('competency_group')->result();
        $level_av = getAll('competency_level')->result();
        $levelx = array();
        foreach ($level_av as $r) {
            $levelx[] = $r->level;
        }

        $data['level'] = $level = array_unique($levelx);
        $data['pg_size'] = sizeof($level);
        $data['col'] = 80/sizeof($level);
        $comp_def = array();
        $def = GetAllSelect($this->table.'_detail', 'competency_def_id')->result_array();
        foreach ($def as $key => $value) {
           $comp_def[] = $value['competency_def_id'];
        }
        // print_mz($comp_def);
        $data['comp_def'] = $comp_def;
        $data['ci'] = $this;
        $this->load->view('mapping_indikator/result', $data);
    }

    function add_row($id)
    {
        $data['id'] = $id;
        $data['com'] = getAll('competency_level')->result_array();
        $data['com'] = getAll('competency_level')->result_array();
        $this->load->view('competency/mapping_indikator/row', $data);
    }

    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('mapping_indikator/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/mapping_indikator.js');
                    
            }elseif(in_array($view, array('mapping_indikator/input')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/mapping_indikator_input.js');
                    
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

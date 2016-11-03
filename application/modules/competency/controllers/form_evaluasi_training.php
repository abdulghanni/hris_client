<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class form_evaluasi_training extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        //$this->load->library('competency');

        $this->load->database();

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('competency/form_evaluasi_training_model','main');
    }

    var $title = 'Form Penilaian Kompetensi Karyawan';
    var $limit = 100000;
    var $controller = 'competency/form_evaluasi_training';
    var $model_name = 'form_evaluasi_training';
    var $table = 'competency_form_evaluasi_training';
    var $id_table = 'id';
    var $list_view = 'form_evaluasi_training/index';

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
            $data['url_ajax_list'] = site_url('form_evaluasi_training/ajax_list');
            $data['url_ajax_add'] = site_url('form_evaluasi_training/ajax_add');
            $data['url_ajax_edit'] = site_url('form_evaluasi_training/ajax_edit');
            $data['url_ajax_delete'] = site_url('form_evaluasi_training/ajax_delete');
            $data['url_ajax_update'] = site_url('form_evaluasi_training/ajax_update');
            $data['ci'] = $this;
            $data['form'] = getAll($this->table);

            $this->_render_page($this->controller.'/index',$data);
        }
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['competency_penilaian'] = GetAll('competency_penilaian')->result();
        $data['users'] = GetAll('users')->result();
        $data['rekomendasi'] = GetAll('competency_rekomendasi')->result();
        $this->_render_page('form_evaluasi_training/input', $data);
    }

    function detail($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['detail'] = $this->main->detail($id);//print_mz($data['detail']);
        $data['approver'] = getAll($this->table.'_approver', array($this->table.'_id'=>'where/'.$id));
        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['approved'] = assets_url('img/approved_stamp.png');
        $data['rejected'] = assets_url('img/rejected_stamp.png');
        $data['pending'] = assets_url('img/pending_stamp.png');
        if($approver_id != null){
            $f = array($this->table.'_id' => 'where/'.$id,
                       'user_id' => 'where/'.sessId(),
             );
            $data['app_status_id'] = getValue('app_status_id', $this->table.'_approver', $f);
            $data['date_app'] = getValue('date_app', $this->table.'_approver', $f);
            $app = $this->load->view($this->controller.'/app_stat', $data, true);
            // $note = $this->load->view('form_cuti/note', $data, true);
            $note = '';
            echo json_encode(array('app'=>$app, 'note'=>$note, 'date'=>lq()));
        }else{
            $this->_render_page($this->controller.'/detail', $data);
        }
    }

    function add(){
        // print_mz($_POST);
        permissionBiasa();
        // $this->form_validation->set_rules('competency_def_id', 'Kompetensi', 'trim|required');
        $approver_id = $this->input->post('approver_id');
        $com = $this->input->post('competency_penilaian_id');
        $kemampuan = $this->input->post('kemampuan');
        $kemauan = $this->input->post('kemauan');
        $alasan = $this->input->post('alasan');

        //print_mz($kemampuan[1]);
        // INSERT TO COMPETENCY_form_evaluasi_training
        $data = array(
            'nik' => $this->input->post('nik'),
            'rekomendasi_id' => $this->input->post('rekomendasi_id'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );
        $this->db->insert($this->table, $data);
        $com_id = $this->db->insert_id();
        // INSERT TO COMPETENCY_form_evaluasi_training_DETAIL
        for($i=1;$i<=sizeof($com);$i++) {
            $data = array(
                'competency_form_evaluasi_training_id' => $com_id,
                'competency_penilaian_id' => $com[$i],
                'kemampuan' => $kemampuan[$i],
                'kemauan' => $kemauan[$i],
                'alasan' => $alasan[$i],
                );
            $this->db->insert($this->table.'_detail', $data);
        }
        // lastq();
        // INSERT TO COMPETENCY_form_evaluasi_training_APPROVER
        for ($i=0;$i<sizeof($approver_id);$i++) {
            $data = array(
                $this->table.'_id' => $com_id,
                'user_id' => $approver_id[$i]
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
        $this->load->view('form_evaluasi_training/result', $data);
    }

    function add_row($id)
    {
        $data['id'] = $id;
        $data['com'] = getAll('competency_level')->result_array();
        $data['com'] = getAll('competency_level')->result_array();
        $this->load->view('competency/form_evaluasi_training/row', $data);
    }

    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('form_evaluasi_training/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/form_evaluasi_training.js');
                    
            }elseif(in_array($view, array('form_evaluasi_training/input')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/competency.js');
                $this->template->add_js('competency/form_evaluasi_training_input.js');
                $this->template->add_js('emp_dropdown.js');
                    
            }elseif(in_array($view, array($this->controller.'/detail')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
                $this->template->add_js('emp_dropdown.js');

                $this->template->add_js('competency/competency.js');
                
                $this->template->add_css('approval_img.css');
                $this->template->add_js('competency/approve.js');
                    
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

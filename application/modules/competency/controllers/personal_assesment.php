<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class personal_assesment extends MX_Controller {

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
        $this->load->model('competency/personal_assesment_model','main');
    }

    var $title = 'Personal Competency Assesment';
    var $limit = 100000;
    var $controller = 'competency/personal_assesment';
    var $model_name = 'personal_assesment';
    var $table = 'competency_personal_assesment';
    var $id_table = 'id';
    var $list_view = 'personal_assesment/index';

    //redirect if needed, otherwise display the user list
    function index($id=NULL)
    {
        permissionBiasa();
        $data['title'] = $this->title;
        $data['url_ajax_list'] = site_url('personal_assesment/ajax_list');
        $data['url_ajax_add'] = site_url('personal_assesment/ajax_add');
        $data['url_ajax_edit'] = site_url('personal_assesment/ajax_edit');
        $data['url_ajax_delete'] = site_url('personal_assesment/ajax_delete');
        $data['url_ajax_update'] = site_url('personal_assesment/ajax_update');
        $data['ci'] = $this;
        $data['form'] = getAll($this->table);

        $this->_render_page($this->controller.'/index',$data);
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['users'] = GetAll('users')->result();
        $this->_render_page('personal_assesment/input', $data);
    }

    function approve($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['detail'] = getAll($this->table.'_detail', array($this->table.'_id'=>'where/'.$id))->result();
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
            $this->_render_page($this->controller.'/approve', $data);
        }
    }

    function add(){
        // print_mz($_POST);
        permissionBiasa();
        // $this->form_validation->set_rules('competency_def_id', 'Kompetensi', 'trim|required');
        $approver_id = $this->input->post('approver_id');
        $com = $this->input->post('competency_def_id');
        $sk = $this->input->post('sk');
        $ak = $this->input->post('ak');
        $gap = $this->input->post('gap');
        $competency_tindakan_id = $this->input->post('competency_tindakan_id');
        $pic = $this->input->post('pic');
        $hasil = $this->input->post('hasil');
        $tgl = $this->input->post('tgl');

        // INSERT TO competency_personal_assesment
        $data = array(
            'nik' => $this->input->post('nik'),
            'organization_id' => $this->input->post('organization_id'),
            'position_group_id' => $this->input->post('position_group_id'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );
        $this->db->insert($this->table, $data);
        $com_id = $this->db->insert_id();

        // INSERT TO competency_personal_assesment_DETAIL
        for($i=0;$i<sizeof($com);$i++) {
            $data = array(
                'competency_personal_assesment_id' => $com_id,
                'competency_def_id' => $com[$i],
                'sk' => $sk[$i],
                'ak' => $ak[$i],
                'gap' => $gap[$i],
                'competency_tindakan_id' => $competency_tindakan_id[$i],
                'tgl' => date('Y-m-d', strtotime($tgl[$i])),
                'pic' => $pic[$i],
                'hasil' => $hasil[$i],
                );
            $this->db->insert($this->table.'_detail', $data);
        }
        // lastq();
        // INSERT TO competency_personal_assesment_APPROVER
        for ($i=0;$i<sizeof($approver_id);$i++) {
            $data = array(
                'competency_personal_assesment_id' => $com_id,
                'user_id' => $approver_id[$i]
            );
            $this->db->insert($this->table.'_approver', $data);//print_ag(lq());
        }
        redirect(base_url($this->controller), 'refresh');
    }
    // FOR js
    function do_approve($form_id){
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sessId = sessId();
            $data = array(
                'is_app' => 1,
                'app_status_id' => $this->input->post('app_status_id'),
                'date_app'=>dateNow(),
                'note' => $this->input->post('note')
            );

            $this->db->where($this->table.'_id', $form_id)
                     ->where('user_id', $sessId)
                     ->update($this->table.'_approver', $data);
            return true;
        }
    }
    

    function get_mapping($emp_id){
        $emp_id = get_nik($emp_id);
        $data['org_id'] = $org_id = get_user_organization_id($emp_id);
        $data['pos_group_id'] = get_pos_group($emp_id);
        $data['competency_group'] = GetAll('competency_group')->result();
        $data['competency_mapping_indikator'] = $indikatorx = GetAll('competency_mapping_indikator_detail', array('organization_id'=>'where/'.$org_id));
        // print_mz($indikatorx->result());
        $indikator = array();
        foreach ($indikatorx->result() as $r) {
            $indikator[] = $r->competency_def_id;
        }

        $data['def_indikator'] = array_unique($indikator);

        $data['tindakan'] = getAll('competency_tindakan')->result();

        $this->load->view($this->controller.'/result', $data);
    }


    function add_row($id)
    {
        $data['id'] = $id;
        $data['com'] = getAll('competency_level')->result_array();
        $data['com'] = getAll('competency_level')->result_array();
        $this->load->view('competency/personal_assesment/row', $data);
    }

    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array($this->controller.'/index')))
            {
               $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');

                $this->template->add_js('competency/personal_assesment.js');
                    
            }elseif(in_array($view, array('personal_assesment/input' )))
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
                $this->template->add_js('competency/personal_assesment_input.js');
                $this->template->add_js('emp_dropdown.js');
                    
            }elseif(in_array($view, array($this->controller.'/approve')))
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
                $this->template->add_js('emp_dropdown.js');
                    
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

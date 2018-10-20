<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class monitoring_personal_assessment extends MX_Controller {

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

    var $title = 'Monitoring Personal Assessment';
    var $limit = 100000;
    var $controller = 'competency/monitoring_personal_assessment';
    var $table = 'personal_assesment';
    var $model_name = 'competency_personal_assesment';
    var $id_table = 'id';
    var $list_view = 'monitoring_personal_assessment/index';

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
            $data['title'] = "Monitoring Personal Asessment";
            $data['org'] = $this->competency->get_organization();
            $this->_render_page('monitoring_personal_assessment/index',$data);
        }
    }
    function get_organization(){
        $data['org'] = $this->competency->get_organization();
        $this->load->view('monitoring_personal_assessment/org',$data);
     }

     function get_periode(){
        $data['periode'] = $this->main->get_periode();
        $this->load->view('monitoring_personal_assessment/periode',$data);
     }
     function get_rekap($departement,$periode){
        $data['competency']=select_where_array('competency_personal_assesment',array('organization_id'=>$departement,'comp_session_id'=>$periode));
        foreach ($data['competency']->result() as $key) {
            $query=select_field_where_array('sum(sk) as total_sk, sum(ak) as total_ak, sum(gap) as total_gap','competency_personal_assesment_detail',array('competency_personal_assesment_id' => $key->id))->row();
            $key->sk=$query->total_sk;
            $key->ak=$query->total_ak;
            $key->gap=$query->total_gap;
        }
        $this->load->view('monitoring_personal_assessment/rekap',$data);
     }
    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('monitoring_personal_assessment/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/monitoring_personal_assessment.js');
                    
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

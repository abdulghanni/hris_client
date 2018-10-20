<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class monitoring_kinerja_supporting extends MX_Controller {

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
        $this->load->model('competency/form_penilaian_model','main');
    }

    var $title = 'Monitoring Penilaian Kinerja Supporting';
    var $limit = 100000;
    var $controller = 'competency/monitoring_kinerja_supporting';
    var $table = 'form_penilaian';
    var $model_name = 'competency_form_penilaian';
    var $id_table = 'id';
    var $list_view = 'monitoring_kinerja_supporting/index';

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
            $data['title'] = "Monitoring Penilaian Kinerja Supporting";
            $data['org'] = $this->competency->get_organization();
            $this->_render_page('monitoring_kinerja_supporting/index',$data);
        }
    }
    function get_organization(){
        $data['org'] = $this->competency->get_organization();
        $this->load->view('monitoring_kinerja_supporting/org',$data);
     }

     function get_periode(){
        $data['periode'] = $this->main->get_periode();
        $this->load->view('monitoring_kinerja_supporting/periode',$data);
     }
     function get_rekap($departement,$periode){
        $data['competency']=select_where_array('competency_kinerja_supporting',array('comp_session_id'=>$periode,'organization_id'=>$departement));
        //debug_code($data['competency']);
        $data['departement']=$departement;
        $this->load->view('monitoring_kinerja_supporting/rekap',$data);
     }
    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('monitoring_kinerja_supporting/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/monitoring_kinerja_supporting.js');
                    
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

<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class monitoring_evaluasi_training extends MX_Controller {

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
        $this->load->model('competency/form_evaluasi_training_model','main');
    }

    var $title = 'Monitoring Evaluasi Kefektifan Training';
    var $limit = 100000;
    var $controller = 'competency/monitoring_evaluasi_training';
    var $table = 'competency_form_evaluasi_training';
    var $model_name = 'form_evaluasi_training_model';
    var $id_table = 'id';
    var $list_view = 'monitoring_evaluasi_training/index';

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
            $data['title'] = "Monitoring Evaluasi Keefektifan Training";
            $data['org'] = $this->competency->get_organization();
            $this->_render_page('monitoring_evaluasi_training/index',$data);
        }
    }
    function get_organization(){
        $data['org'] = $this->competency->get_organization();
        $this->load->view('monitoring_evaluasi_training/org',$data);
     }

     function get_periode(){
        $data['periode'] = $this->main->get_periode();
        $this->load->view('monitoring_hvm/periode',$data);
     }
     function get_rekap($departement,$periode){
        $data['competency']=select_where_array('competency_form_evaluasi_training',array('comp_session_id'=>$periode,'organization_id'=>$departement));
        foreach ($data['competency']->result() as $key) {
            $key->output=select_where('competency_form_evaluasi_point_output','competency_form_evaluasi_training_id',$key->id)->row();
        }
        //debug_code($data['competency']);
        $this->load->view('monitoring_evaluasi_training/rekap',$data);
     }
    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('monitoring_evaluasi_training/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/monitoring_evaluasi_training.js');
                    
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

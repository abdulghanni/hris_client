<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class monitoring_hvm extends MX_Controller {

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

    var $title = 'Monitoring Penilaian Kemauan dan Kemampuan SDM';
    var $limit = 100000;
    var $controller = 'competency/monitoring_hvm';
    var $table = 'form_penilaian';
    var $model_name = 'competency_form_penilaian';
    var $id_table = 'id';
    var $list_view = 'monitoring_hvm/index';

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
            $data['title'] = "Monitoring Penilaian Kemauan dan Kemampuan SDM";
            $data['org'] = $this->competency->get_organization();
            $this->_render_page('monitoring_hvm/index',$data);
        }
    }
    function get_organization(){
        $data['org'] = $this->competency->get_organization();
        $this->load->view('monitoring_hvm/org',$data);
     }

     function get_periode(){
        $data['periode'] = $this->main->get_periode();
        $this->load->view('monitoring_hvm/periode',$data);
     }
     function get_rekap($departement,$periode){
        $data['competency']=select_where_array('competency_form_penilaian',array('comp_session_id'=>$periode));
        foreach ($data['competency']->result() as $key) {
            $rekomendasi=select_where('competency_rekomendasi','id',$key->rekomendasi_id);
            $key->rekomendasi=$rekomendasi->row();
            $kuadran=select_where('competency_kuadran','id',$key->kuadran_id);
            $key->kuadran=$kuadran->row();
            $organization=$this->competency->get_login_organization($key->nik);
            $key->organization=$organization[0]['ID'];
        }
        //debug_code($data['competency']);
        $data['departement']=$departement;
        $this->load->view('monitoring_hvm/rekap',$data);
     }
    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('monitoring_hvm/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/monitoring_hvm.js');
                    
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
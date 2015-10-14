<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_guide extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->helper('url');
        
        $this->lang->load('auth');
        $this->load->helper('language');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {
        $this->data['title'] = "Panduan Pengguna";
        $this->_render_page('user_guide/index', $this->data);
    }

    function get_register()
    {
        $this->load->view('user_guide/register');
    }

    function get_lupa()
    {
        $this->load->view('user_guide/lupa');
    }

    function get_cuti()
    {
        $this->load->view('user_guide/cuti');
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

            /*if ( ! in_array($view, array('auth/index')))
            {*/
                if(in_array($view, array('user_guide/index')))
                {
                    $this->template->set_layout('single');
                    $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');
                $this->template->add_js('user_guide.js');
                $this->template->add_js('core.js');

                    $this->template->add_js('jquery.nestable.min.js');
                    $this->template->add_css('jquery.nestable.min.css');
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



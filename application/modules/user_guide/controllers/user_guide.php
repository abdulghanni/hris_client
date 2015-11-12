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
        $this->load->view('user_guide/user/register');
    }

    function get_lupa()
    {
        $this->load->view('user_guide/user/lupa');
    }

    function get_cuti()
    {
        $this->load->view('user_guide/user/cuti');
    }

    function get_edit()
    {
        $this->load->view('user_guide/user/edit');
    }

    function get_absen()
    {
        $this->load->view('user_guide/user/absen');
    }

     function get_tidak_masuk()
    {
        $this->load->view('user_guide/user/tidak_masuk');
    }


    function get_pjd()
    {
        $this->load->view('user_guide/user/pjd');
    }

    function get_resign()
    {
        $this->load->view('user_guide/user/resign');
    }

    //Role Atasan

    function get_recruit()
    {
        $this->load->view('user_guide/atasan/recruit');
    }

    function get_promosi()
    {
        $this->load->view('user_guide/atasan/promosi');
    }

    function get_perpanjangan()
    {
        $this->load->view('user_guide/atasan/perpanjangan');
    }

    function get_pengangkatan()
    {
        $this->load->view('user_guide/atasan/pengangkatan');
    }

    function get_rekomendasi()
    {
        $this->load->view('user_guide/atasan/rekomendasi');
    }

    //ROLE ADMIN BAGIAN

    function get_medical()
    {
        $this->load->view('user_guide/admin_bagian/medical');
    }

    function get_pjd_admin()
    {
        $this->load->view('user_guide/admin_bagian/pjd');
    }

    function get_training_admin()
    {
        $this->load->view('user_guide/admin_bagian/training');
    }

    //Role Super Administrator

    function get_admin_khusus()
    {
        $this->load->view('user_guide/super_admin/admin_Khusus');
    }

    function get_depan()
    {
        $this->load->view('user_guide/super_admin/depan');
    }

    function get_approval_hrd()
    {
        $this->load->view('user_guide/super_admin/approval_hrd');
    }

    function get_atasan_Khusus()
    {
        $this->load->view('user_guide/super_admin/atasan_khusus');
    }

    function get_form_template()
    {
        $this->load->view('user_guide/super_admin/form_template');
    }

    function get_inventaris()
    {
        $this->load->view('user_guide/super_admin/inventaris');
    }

    function get_pengumuman()
    {
        $this->load->view('user_guide/super_admin/pengumuman');
    }

    function get_group()
    {
        $this->load->view('user_guide/super_admin/group');
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



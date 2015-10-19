<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->helper('url');
        
        $this->lang->load('auth');
        $this->load->helper('language');

    }

    function index()
    { 
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            $id = $this->session->userdata('user_id');
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            redirect('person/detail/'.$id);
        }
        else
        {
            $this->data['pengumuman'] = getValue('title', 'pengumuman',array('id'=>'where/1'));
            $status = getValue('is_publish', 'pengumuman',array('id'=>'where/1'));
            $this->data['status'] = ($status==1) ? 'Diumumkan' : 'Tidak Diumumkan';
            $this->_render_page('pengumuman/index', $this->data);
        }
    }

    function edit()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $data = array('title' => $this->input->post('title'),
                      'is_publish' => $this->input->post('is_publish')
                      );
        $this->db->where('id', 1)->update('pengumuman', $data);
        return TRUE;        
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

                if(in_array($view, array('pengumuman/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('pengumuman.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
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
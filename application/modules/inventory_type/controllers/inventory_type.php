<?php defined('BASEPATH') OR exit('No direct script access allowed');

class inventory_type extends MX_Controller {

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
            $this->data['inventory_type'] = getJoin('inventory', 'type_inventory','inventory.type_inventory_id = type_inventory.id', 'inner', 'inventory.*, type_inventory.title as type_inventory');
            $this->data['type_inventory'] = getAll('type_inventory')->result();
            $this->_render_page('inventory_type/index', $this->data);
        }
    }

    function add(){
        if (!$this->ion_auth->logged_in())
            {
                //redirect them to the login page
                redirect('auth/login', 'refresh');
            }
            elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
            {
                //redirect them to the home page because they must be an administrator to view this
                //return show_error('You must be an administrator to view this page.');
                return show_error('You must be an administrator to view this page.');
            }else{
                $data = array(
                'title' => $this->input->post('title'),
                'type_inventory_id' => $this->input->post('type_inventory_id'),
                'created_by' => $this->session->userdata('user_id'),
                'created_on' => date('Y-m-d',strtotime('now')),
                );

                $this->db->insert('inventory', $data);
                return true;
            }
        }

    function update($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $id = $this->input->post('id');
        $data = array('title' => $this->input->post('title'),
                      'type_inventory_id' => $this->input->post('type_inventory_id'),
                      'edited_by' => $this->session->userdata('user_id'),
                      'edited_on' => date('Y-m-d',strtotime('now')),
                      );
        $this->db->where('id', $id)->update('inventory', $data);
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

                if(in_array($view, array('inventory_type/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('inventory_type.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
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
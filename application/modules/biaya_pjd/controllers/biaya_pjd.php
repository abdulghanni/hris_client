<?php defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_pjd extends MX_Controller {

  public $data;
  var $form_name = 'biaya_pjd';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');

        $this->load->database();

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
        {
            $this->data['title'] = ucfirst($this->form_name);
            $this->data['form_name'] = $this->form_name;
            // $biaya = getAll('pjd_biaya')->result();print_mz($biaya);
            $this->_render_page('biaya_pjd/index', $this->data);
        }
    }

    function update($id)
    {
        if($id>100){
            $id=$id-100;
            $tbl='pjd_biaya_intern';
        }else{
            $tbl='pjd_biaya';
        }
        $value = str_replace(',', '', $this->input->post('value'));
        $data = array('jumlah_biaya'=>$value,
                      'edited_by' => sessId(),
                      'edited_on' =>dateNow()
            );
        $this->db->where('id', $id)
             ->update($tbl, $data);
        return true;
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('biaya_pjd/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('jquery.maskMoney.js');

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
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class notif_tambahan extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        //$this->load->model('notif_tambahan_model');
        $this->lang->load('auth');
        $this->load->helper('language');

    }

    function index($fname = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
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
            $this->data['users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $id_list = array('1','2','14');
            $this->data['form_type'] = $this->db->where_in('id', $id_list)->get('form_type');
            $this->get_bu();
            $this->_render_page('notif_tambahan/index', $this->data);
        }
    }

    function get_table(){
        $this->data['bu'] = substr($this->input->post('id'),0,2);//print_mz($this->data['bu']);
        //$this->data['form'] = GetAllSelect('form_type', 'id, indo', array('is_deleted'=>'where/0'))->result();
        $id_list = array('1','2','14');
            $this->data['form'] = $this->db->where_in('id', $id_list)->get('form_type')->result();
        $this->load->view('notif_tambahan/table', $this->data);
    }

    function get_table_by_name(){
        $this->load->model('notif_tambahan_model', 'app');
        $name = $this->input->post('name');
        $this->data['bu'] = $bu = substr($this->input->post('bu'),0,2);//print_mz($this->data['bu']);
        $this->data['form'] = $this->app->get_table($bu, $name)->result();
        $this->load->view('notif_tambahan/table_name', $this->data);
    }

    function get_modal($bu, $form_id){
        $data = getValue('user_nik', 'users_notif_tambahan', array('bu'=>'where/'.$bu, 'form_type_id'=>'where/'.$form_id));
        echo $data;
    }

    function update()
    {
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
            $bu = $this->input->post('id');
            $form = $this->input->post('form_type_id');
            $data = array(
                'user_nik' => $this->input->post('nik'),
                'form_type_id' => $form,
                'bu'=> $bu
                );
            $num = getAll('users_notif_tambahan', array('form_type_id'=>'where/'.$form, 'bu'=>'where/'.$bu))->num_rows();
            if($num>0)$this->db->where('bu',$bu)->where('form_type_id', $form)->update('users_notif_tambahan', $data);
            else $this->db->insert('users_notif_tambahan', $data);

            echo json_encode(array('status'=>true));
        }
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

                if(in_array($view, array('notif_tambahan/index')))
                {
                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('notif_tambahan.js');
                    
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

    function get_bu()
    {
        $url = get_api_key().'users/bu/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getbu = file_get_contents($url);
            $bu = json_decode($getbu, true);
            foreach ($bu as $row)
        {
            if($row['NUM'] != null){
            $result[substr($row['NUM'], 0, 2)]= ucwords(strtolower($row['DESCRIPTION']));
            }
        }
            return $this->data['bu'] = $result;
        } else {
            return $this->data['bu'] = '';
        }
    }
}
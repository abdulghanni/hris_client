<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->load->database();
        $this->load->model('auth/auth_model','auth_model');
        $this->lang->load('auth');
        $this->load->helper('language');
        
    }

    function index($fname = "fn:",$email = "em:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin_bagian()) //remove this elseif if you want to enable this for non-admins
        {
            $id = $this->session->userdata('user_id');
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            redirect('person/detail/'.$id);
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by first name
            $this->data['fname_param'] = $fname; 
            $exp_fname = explode(":",$fname);
            $fname_re = str_replace("_", " ", $exp_fname[1]);
            $fname_post = (strlen($fname_re) > 0) ? array('users.username'=>$fname_re) : array() ;
            
            //set filter by email
            $this->data['email_param'] = $email;
            $exp_email = explode(":",$email);
            if(strlen($exp_email[1]) > 0) 
            {
                $rep_email_char = array("%5Bat%5D","%5Bdot%5D");
                $std_email_char = array("@",".");
                
                $email_post = array('users.email'=>str_replace($rep_email_char,$std_email_char,$exp_email[1]));
            }else{
                $email_post = array();
            }
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : $this->config->item('list_limit', 'ion_auth') ;

            $this->data['offset'] = $offset = $this->uri->segment($this->config->item('uri_segment_pager', 'ion_auth'));

            //list of filterize all users  
            $this->data['users_all'] = $this->ion_auth->like($fname_post)->like($email_post)->users()->result();
            
            //num rows of filterize all users
            $this->data['num_rows_all'] = $this->ion_auth->like($fname_post)->like($email_post)->users()->num_rows();

            //list of filterize limit users for pagination  
            $this->data['users'] = $this->ion_auth->like($fname_post)->like($email_post)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->users()->result();

            $this->data['users_num_rows'] = $this->ion_auth->like($fname_post)->like($email_post)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->users()->num_rows();

             //config pagination
             $config['base_url'] = base_url().'inventory/index/fn:'.$exp_fname[1].'/em:'.$exp_email[1].'/'.$sort_by.'/'.$sort_order.'/';
             $config['total_rows'] = $this->data['num_rows_all'];
             $config['per_page'] = $limit;
             $config['uri_segment'] = $this->config->item('uri_segment_pager', 'ion_auth');

            //inisialisasi config
             $this->pagination->initialize($config);

            //create pagination
            $this->data['halaman'] = $this->pagination->create_links();

            $this->data['fname_search'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->_render_page('inventory/index', $this->data);
        }
    }

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $fname_post = (strlen($this->input->post('first_name')) > 0) ? strtolower(url_title($this->input->post('first_name'),'_')) : "" ;

            redirect('inventory/index/fn:'.$fname_post.'/em:'.$email_post, 'refresh');
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            $this->data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
            $this->data['exit_type'] = getAll('exit_type', array('is_deleted'=>'where/0'));
            $this->_render_page('form_exit/input', $this->data);
    }

    function detail($user_id)
    { 
        $this->data['sess_nik'] = $sess_nik = get_nik($this->session->userdata('user_id'));
        $superior_it = getValue('user_app_lv1_it', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_hrd = getValue('user_app_lv1_hrd', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_logistik = getValue('user_app_lv1_logistik', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_koperasi = getValue('user_app_lv1_koperasi', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_perpus = getValue('user_app_lv1_perpus', 'users_exit', array('user_id'=>'where/'.$user_id));

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        
        }elseif($this->ion_auth->is_admin_bagian() || $sess_nik==$superior_hrd || $sess_nik==$superior_it || $sess_nik==$superior_logistik || $sess_nik==$superior_koperasi || $sess_nik==$superior_perpus){
          //  die($sess_nik.'=='.$superior_it);
            if($this->ion_auth->is_admin_it() || $sess_nik===$superior_it){
                $group_id = 2;
                $type = 'it';
            }elseif($this->ion_auth->is_admin_hrd() ||$sess_nik===$superior_hrd){
                $group_id = 1;
                $type = 'hrd';
            }elseif($this->ion_auth->is_admin_logistik() || $sess_nik===$superior_logistik){
                $group_id = 3;
                $type = 'logistik';
            }elseif($this->ion_auth->is_admin_perpustakaan() || $sess_nik===$superior_perpus){
                $group_id = 5;
                $type = 'perpus';
            }elseif($this->ion_auth->is_admin_koperasi() || $sess_nik===$superior_koperasi){
                $group_id = 4;
                $type = 'koperasi';
            }else{
                $group_id = 0;
            }

            $num_rows = getAll('users_exit', array('user_id'=>'where/'.$user_id))->num_rows();
            $num_rows_exit = getAll('users_exit')->num_rows();
            if($num_rows>0){
               $exit_id = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
               $this->data['is_submit'] = getValue('is_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_submit'] = getValue('user_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_submit'] = getValue('date_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_edit'] = getValue('user_edit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_edit'] = getValue('date_edit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['is_app_lv1'] = getValue('is_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_app_lv1'] = getValue('user_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_app_lv1'] = getValue('date_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['exit_id']  = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
            }else{
                $exit_id = $this->db->select('id')->order_by('id', 'asc')->get('users_exit')->last_row();
                $this->data['exit_id']  = ($num_rows_exit>0)?$exit_id->id+1:1;
                $this->data['is_submit'] = 0;
            }
            $this->db->insert_id();
            $q = $this->db->get('users_exit');
            
            $this->data['user_id'] = $user_id;
            $this->data['user_nik'] = get_nik($user_id);
            $this->get_user_atasan();
            $this->data['type'] = $type;
            $this->data['inventory'] = GetAll('inventory', array('type_inventory_id'=>'where/'.$group_id));
            $i =$this->db->select('users_inventory_exit.id as id, inventory.title, users_inventory_exit.is_available, users_inventory_exit.note')->from('users_inventory_exit')->join('inventory', 'users_inventory_exit.inventory_id = inventory.id', 'left')->where('inventory.type_inventory_id', $group_id)->where('users_inventory_exit.user_id', $user_id)->get();
          
            $this->data['users_inventory'] = $i;
            $this->_render_page('inventory/input_inventory', $this->data);
        }
    }

    function add_inventory($exit_id, $type)
    {
        $num_rows = getAll('users_exit', array('id'=>'where/'.$exit_id))->num_rows();

            if($num_rows>0){
                $exit_data = array(
                'id_comp_session'=>1,
                'user_id'=>$this->input->post('emp'),
                'user_app_lv1_'.$type => $this->input->post('atasan1'),
                'edited_by'=>$this->session->userdata('user_id'),
                'edited_on' => date('Y-m-d',strtotime('now')),
                );
                $this->db->where('id',$exit_id)->update('users_exit', $exit_data);
            }else{
                $exit_data = array(
                            'id_comp_session'=>1,
                            'user_id'=>$this->input->post('emp'),
                            'user_app_lv1_'.$type => $this->input->post('atasan1'),
                            'created_by'=>$this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d',strtotime('now')),
                            );
                $this->db->insert('users_exit', $exit_data);
                $exit_id = $this->db->insert_id();
            }

        $inventory_id = $this->input->post('inventory_id');
        
        $x='';
        $x2='';
        for ($i=1; $i<=sizeof($inventory_id);$i++) {
            $x .= $this->input->post('is_available_'.$i).',';
            $x2 .= $this->input->post('note_'.$i).',';
        }

        $is_available = explode(',',$x);
        $note = explode(',',$x2);
        for($i=0;$i<sizeof($inventory_id);$i++){
            $data = array(
                'user_id' => $this->input->post('emp'),
                'user_exit_id'=>$exit_id,
                'inventory_id' => $inventory_id[$i],
                'is_available'=>$is_available[$i],
                'note'=>$note[$i],
                'created_by'=>$this->session->userdata('user_id'),
                'created_on' => date('Y-m-d',strtotime('now')),
                );

            $this->db->insert('users_inventory', $data);
            $this->db->insert('users_inventory_exit', $data);
        }

        $data2 = array(
            'is_submit_'.$type => 1,
            'user_submit_'.$type =>$this->session->userdata('user_id'),
            'date_submit_'.$type => date('Y-m-d',strtotime('now')),
            );
        $this->db->where('id',$exit_id)->update('users_exit', $data2);
        $user_id = $this->input->post('emp');
        $this->send_approval_request($user_id, $type);
        redirect('inventory/detail/'.$user_id,'refresh');
    }

    function update($id, $type)
    {
        $user_inventory_id = $this->input->post('inventory_id_update');
        $x='';
        $x2='';
        for ($i=1; $i<=sizeof($user_inventory_id);$i++) {
            $x .= $this->input->post('is_available_update'.$i).',';
            $x2 .= $this->input->post('note_update'.$i).',';
        }

        $is_available = explode(',',$x);
        $note = explode(',',$x2);
        for($i=0;$i<sizeof($user_inventory_id);$i++){
            $data = array(
                'is_available'=>$is_available[$i],
                'note'=>$note[$i],
                'edited_by'=>$this->session->userdata('user_id'),
                'edited_on' => date('Y-m-d',strtotime('now')),
                );
            $this->db->where('id', $user_inventory_id[$i]);
            $this->db->update('users_inventory_exit', $data);
        }

        if(!empty($this->input->post('atasan1_update'))){
            $data2 = array(
                    'user_edit_'.$type =>$this->session->userdata('user_id'),
                    'date_edit_'.$type => date('Y-m-d',strtotime('now')),
                    'user_app_lv1_'.$type => $this->input->post('atasan1_update'),
                    'is_app_lv1_'.$type => 0,
                    );
        }else{
            $data2 = array(
                'user_edit_'.$type =>$this->session->userdata('user_id'),
                'date_edit_'.$type => date('Y-m-d',strtotime('now')),
                );
        }
        $this->db->where('user_id',$id)->update('users_exit', $data2);
        $this->send_approval_request_update($id, $type);
        redirect('inventory/detail/'.$id,'refresh');
    }

    function do_approve($id, $type)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        
        }
        
        $data = array(
            'is_app_lv1_'.$type => 1,
            'date_app_lv1_'.$type => date('Y-m-d',strtotime('now')),
            );
        $this->db->where('user_id',$id)->update('users_exit', $data);
        $this->approval_mail($id, $type);
    }

    function send_approval_request($id, $type)
    {
        $url = base_url().'inventory/detail/'.$id;
        $user_app_lv1 = getValue('user_app_lv1_'.$type, 'users_exit', array('user_id'=>'where/'.$id));
        $user_id = $this->session->userdata('user_id');
        //approval to LV1
        if(!empty($user_app_lv1)){
            $data1 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $user_app_lv1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Notifikasi Inventaris Karyawan',
                    'email_body' => get_name($user_id).' telah mengisi data inventaris '.get_name($id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data1);
        }
    }

    function send_approval_request_update($id, $type)
    {
        $url = base_url().'inventory/detail/'.$id;
        $user_app_lv1 = getValue('user_app_lv1_'.$type, 'users_exit', array('user_id'=>'where/'.$id));
        $user_id = $this->session->userdata('user_id');
        //approval to LV1
        if(!empty($user_app_lv1)){
            $data1 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $user_app_lv1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Notifikasi Perubahan data Inventaris Karyawan',
                    'email_body' => get_name($user_id).' telah mengubah data inventaris '.get_name($id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data1);
        }
    }

    function approval_mail($id, $type)
    {
        $url = base_url().'inventory/detail/'.$id;
        $user_admin = getValue('user_submit_'.$type, 'users_exit', array('user_id'=>'where/'.$id));
        $user_id = $this->session->userdata('user_id');
        //approval to LV1
        $data1 = array(
                'sender_id' => get_nik($user_id),
                'receiver_id' => get_nik($user_admin),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Notifikasi Inventaris Karyawan dari Atasan',
                'email_body' => get_name($user_id).' telah mengetahui pengisian data inventaris '.get_name($id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data1);
    }

    function detail_email($user_id)
    { 
        $this->data['sess_nik'] = $sess_nik = get_nik($this->session->userdata('user_id'));
        $superior_it = getValue('user_app_lv1_it', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_hrd = getValue('user_app_lv1_hrd', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_logistik = getValue('user_app_lv1_logistik', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_koperasi = getValue('user_app_lv1_koperasi', 'users_exit', array('user_id'=>'where/'.$user_id));
        $superior_perpus = getValue('user_app_lv1_perpus', 'users_exit', array('user_id'=>'where/'.$user_id));

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        
        }elseif($this->ion_auth->is_admin_bagian() || $sess_nik==$superior_hrd || $sess_nik==$superior_it || $sess_nik==$superior_logistik || $sess_nik==$superior_koperasi || $sess_nik==$superior_perpus){

            if($this->ion_auth->is_admin_it() || $sess_nik==$superior_it){
                $group_id = 2;
                $type = 'it';
            }elseif($this->ion_auth->is_admin_hrd() ||$sess_nik==$superior_hrd){
                $group_id = 1;
                $type = 'hrd';
            }elseif($this->ion_auth->is_admin_logistik() || $sess_nik==$superior_logistik){
                $group_id = 3;
                $type = 'logistik';
            }elseif($this->ion_auth->is_admin_perpustakaan() || $sess_nik==$superior_perpus){
                $group_id = 4;
                $type = 'perpus';
            }elseif($this->ion_auth->is_admin_koperasi() || $sess_nik==$superior_koperasi){
                $group_id = 5;
                $type = 'koperasi';
            }else{
                $group_id = 0;
            }

            $num_rows = getAll('users_exit', array('user_id'=>'where/'.$user_id))->num_rows();
            $num_rows_exit = getAll('users_exit')->num_rows();
            if($num_rows>0){
               $exit_id = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
               $this->data['is_submit'] = getValue('is_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_submit'] = getValue('user_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_submit'] = getValue('date_submit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_edit'] = getValue('user_edit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_edit'] = getValue('date_edit_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['is_app_lv1'] = getValue('is_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['user_app_lv1'] = getValue('user_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['date_app_lv1'] = getValue('date_app_lv1_'.$type,'users_exit', array('id'=>'where/'.$exit_id));
               $this->data['exit_id']  = getValue('id', 'users_exit', array('user_id'=>'where/'.$user_id));
            }else{
                $exit_id = $this->db->select('id')->order_by('id', 'asc')->get('users_exit')->last_row();
                $this->data['exit_id']  = ($num_rows_exit>0)?$exit_id->id+1:1;
                $this->data['is_submit'] = 0;
            }
            $this->db->insert_id();
            $q = $this->db->get('users_exit');
            
            $this->data['user_id'] = $user_id;
            $this->data['user_nik'] = get_nik($user_id);
            $this->get_user_atasan();
            $this->data['type'] = $type;
            $this->data['inventory'] = GetAll('inventory', array('type_inventory_id'=>'where/'.$group_id));
            $i =$this->db->select('users_inventory_exit.id as id, inventory.title, users_inventory_exit.is_available, users_inventory_exit.note')->from('users_inventory_exit')->join('inventory', 'users_inventory_exit.inventory_id = inventory.id', 'left')->where('inventory.type_inventory_id', $group_id)->where('users_inventory_exit.user_id', $user_id)->get();
          
            $this->data['users_inventory'] = $i;
            return $this->load->view('inventory/inventory_mail', $this->data, TRUE);
        }
    }

    function get_user_atasan()
    {
        $id = $this->session->userdata('user_id');
        $url = get_api_key().'users/superior/EMPLID/'.get_nik($id).'/format/json';
        $url_atasan_satu_bu = get_api_key().'users/atasan_satu_bu/EMPLID/'.get_nik($id).'/format/json';
        $headers = get_headers($url);
        $headers2 = get_headers($url_atasan_satu_bu);
        $response = substr($headers[0], 9, 3);
        $response2 = substr($headers2[0], 9, 3);
        if ($response != "404") {
            $get_atasan = file_get_contents($url);
            $atasan = json_decode($get_atasan, true);
            return $this->data['user_atasan'] = $atasan;
        }elseif($response == "404" && $response2 != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
           $atasan = json_decode($get_atasan, true);
           return $this->data['user_atasan'] = $atasan;
        }else{
            return $this->data['user_atasan'] = '- Karyawan Tidak Memiliki Atasan -';
        }
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('inventory/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('inventory/input_inventory')))
                {

                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('inventory.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('approval_img.css');
                     
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
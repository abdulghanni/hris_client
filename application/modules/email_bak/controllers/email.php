<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();
        $this->load->model('email_model');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    //redirect if needed, otherwise display the user list
    function index($name = "fn:",$subject = "em:", $sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = "Email Masuk";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //set sort order
        $this->data['sort_order'] = $sort_order;
        
        //set sort by
        $this->data['sort_by'] = $sort_by;
       
        //set filter by title
        $this->data['name_param'] = $name; 
        $exp_name = explode(":",$name);
        $name_re = str_replace("_", " ", $exp_name[1]);
        $name_post = (strlen($name_re) > 0) ? array('users.username'=>$name_re) : array() ;

        //set filter by title
        $this->data['subject_param'] = $subject; 
        $exp_subject = explode(":",$subject);
        $subject_re = str_replace("_", " ", $exp_subject[1]);
        $subject_post = (strlen($subject_re) > 0) ? array('email.subject'=>$subject_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 25 ;

        $this->data['offset'] = 6;

        //list of filterize all email  
        $this->data['email_all'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->email()->result();
        
        $this->data['num_rows_all'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->email()->num_rows();
        
        $this->data['email'] = $this->email_model->like($name_post)->like($subject_post)->where('receiver_id', (!empty($nik)) ? $nik : $this->session->userdata('user_id'))->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email()->result();
        //print_mz($this->data['email']);
        //list of filterize limit email for pagination  d();
        $this->data['_num_rows'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'email/index/fn:'.$exp_name[1].'/em:'.$exp_subject[1].'/'.$sort_by.'/'.$sort_order.'/';
         $config['total_rows'] = $this->data['num_rows_all'];
         $config['per_page'] = 25;
         $config['uri_segment'] = $this->config->item('uri_segment_pager', 'ion_auth');

        //inisialisasi config
         $this->pagination->initialize($config);

        //create pagination
        $this->data['halaman'] = $this->pagination->create_links();

        $this->_render_page('email/index', $this->data);
        }
    }

    function sent($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = "Email Terkirim";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //set sort order
        $this->data['sort_order'] = $sort_order;
        
        //set sort by
        $this->data['sort_by'] = $sort_by;
       
        //set filter by title
        $this->data['ftitle_param'] = $ftitle; 
        $exp_ftitle = explode(":",$ftitle);
        $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
        $ftitle_post = (strlen($ftitle_re) > 0) ? array('email.subject'=>$ftitle_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

        $this->data['offset'] = 6;

        //list of filterize all email  
        $this->data['email_all'] = $this->email_model->like($ftitle_post)->where('is_deleted',0)->email_sent()->result();
        
        $this->data['num_rows_all'] = $this->email_model->like($ftitle_post)->where('is_deleted',0)->email_sent()->num_rows();
        
        $this->data['email'] = $this->email_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email_sent()->result();

        //list of filterize limit email for pagination  d();
        $this->data['_num_rows'] = $this->email_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email_sent()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'email/sent/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
         $config['total_rows'] = $this->data['num_rows_all'];
         $config['per_page'] = $limit;
         $config['uri_segment'] = 6;

        //inisialisasi config
         $this->pagination->initialize($config);

        //create pagination
        $this->data['halaman'] = $this->pagination->create_links();

        $this->data['ftitle_search'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('title'),
        );

        $this->_render_page('email/sent', $this->data);
        }
    }

    function keywords()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $name_post = (strlen($this->input->post('name')) > 0) ? strtolower(url_title($this->input->post('name'),'_')) : "" ;
            $subject_post = (strlen($this->input->post('subject')) > 0) ? strtolower(url_title($this->input->post('subject'),'_')) : "" ;

            $this->session->set_userdata('last_link', 'email/index/fn:'.$name_post.'/em:'.$subject_post);
            redirect('email/index/fn:'.$name_post.'/em:'.$subject_post, 'refresh');

        }
    }

    function detail($id)
    {
        $this->data['title'] = "Email Detail";
        if (!$this->ion_auth->logged_in())
        {
             $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $data = array(
            'is_read' => 1
            );
        $this->db->where('id', $id)->update('email', $data);
        $this->data['email'] = $this->email_model->email_detail($id)->result();
        $r = getValue('email_body', 'email', array('id'=>'where/'.$id));

        preg_match('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $r, $match);

        if(!empty($match)){
            $uri = parse_url($match[0]);
            $urix = 'http://'.$_SERVER['HTTP_HOST']. $uri['path'];
            redirect($urix,'refresh');
        }else{
            $this->_render_page('email/detail', $this->data);
        }
        
    }

    function deactivate($id = NULL)
    {
                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
                {
                    $this->ion_auth->deactivate($id);
                }

            //redirect them back to the auth page
            redirect('email', 'refresh');
    }

     //activate the user
    function activate($id, $code=false)
    {
        if ($this->ion_auth->is_admin() || is_admin_cabang())
        {
            $user_nik = getValue('sender_id','email', array('id'=>'where/'.$id));
            $user_id = get_id($user_nik);
            $activation = $this->ion_auth->activate($user_id);
        }else{
            die("Silakan login sebagai administrator untuk mengaktifkan user");
        }

        if ($activation)
        {
            //die();
            /*$email_id = $this->db->where('sender_id', $id)->get('email')->row('id');
            $data = array('is_deleted' => 1);
            $this->db->where('id', $email_id)->update('email', $data);*/
            $this->delete_activation_mail($id);
            $user_id = getValue('sender_id', 'email', array('id'=>'where/'.$id));
            $isi_email = 'Akun anda di Web-HRIS Erlangga telah diaktifkan, silakan lakukan login untuk mulai mengakses Web-HRIS Erlangga';
            if(!empty(getEmail($user_id)))$this->send_email(getEmail($user_id), 'Status Aktivasi Akun', $isi_email);
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            //redirect($this->session->userdata('last_link'), 'refresh');
            //redirect('email', 'refresh');
            return true;
        }
        else
        {
             $this->delete_activation_mail($id);
            //die('fail');
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            //redirect('email', 'refresh');
            return false;
        }
    }

    function delete_activation_mail($id)
    {
        $id = get_nik($id);
        $data = array('is_deleted' => 1);
        $this->db->where('id', $id)->update('email', $data); 
    }

    public function delete(){
            $ids = ( explode( ',', $this->input->get_post('ids') ));
            $data = array(
                'is_deleted' => 1,
                'deleted_by'=> sessId(),
                'deleted_on'=>dateNow(),
                );
            $this->email_model->delete($ids, $data);
        }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
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
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            /*if ( ! in_array($view, array('auth/index')))
            {*/
                if(in_array($view, array('email/index',
                                         'email/sent',
                                         'email/detail')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');
                    
                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('email_comman.js');
                    
                    $this->template->add_js('jqueryblockui.js');

                    //$this->template->add_js('modules/skeleton.js');
                    //$this->template->add_css('modules/skeleton.css');
                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('approval_img.css');

                    //$this->template->add_css('pace-theme-flash.css');
                    //$this->template->add_css('datepicker.css');
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

    function email_cron()
    {
        $form = array('cuti','absen','demotion', 'exit', 'medical', 'promosi', 'recruitment', 'resignment', 'rolling', 'spd_dalam', 'spd_dalam_group', 'spd_luar', 'spd_luar_group', 'training', 'training_group');
       
        for($i=0;$i<sizeof($form);$i++):
            for($l=1;$l<4;$l++):
            $lv= $this->db->select("id, user_app_lv$l, created_on, is_app_lv$l")->from('users_'.$form[$i])->where("user_app_lv$l !=", '0')->where("is_app_lv$l !=", 1)->get()->result_array();
            for($j=0;$j<sizeof($lv);$j++){
                echo '<pre>';
                print_r($form[$i].' '.'lv'.$l.' '.$lv[$j]['id']);
                print_r(' '.$lv[$j]['user_app_lv'.$l]);
                print_r(' '.$lv[$j]['created_on']);
                print_r(' '.$lv[$j]['is_app_lv'.$l]);
                if(date('Y-m-d',strtotime('now')) == date('Y-m-d', strtotime($lv[$j]['created_on'] . ' +1 day'))):
                    echo 'kirim';
                endif;
                echo '</pre>';

            }endfor;
        endfor;
    }

    function load_body($id, $name = "fn:",$subject = "em:", $sort_by = "id", $sort_order = "asc", $offset = 0){
        $this->activate($id);
        $this->data['title'] = "Email Masuk";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //set sort order
        $this->data['sort_order'] = $sort_order;
        
        //set sort by
        $this->data['sort_by'] = $sort_by;
       
        //set filter by title
        $this->data['name_param'] = $name; 
        $exp_name = explode(":",$name);
        $name_re = str_replace("_", " ", $exp_name[1]);
        $name_post = (strlen($name_re) > 0) ? array('users.username'=>$name_re) : array() ;

        //set filter by title
        $this->data['subject_param'] = $subject; 
        $exp_subject = explode(":",$subject);
        $subject_re = str_replace("_", " ", $exp_subject[1]);
        $subject_post = (strlen($subject_re) > 0) ? array('email.subject'=>$subject_re) : array() ;
        
        //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
        $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 25 ;

        $this->data['offset'] = 6;

        //list of filterize all email  
        $this->data['email_all'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->email()->result();
        
        $this->data['num_rows_all'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->email()->num_rows();
        
        $this->data['email'] = $this->email_model->like($name_post)->like($subject_post)->where('receiver_id', (!empty($nik)) ? $nik : $this->session->userdata('user_id'))->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email()->result();
        //print_mz($this->data['email']);
        //list of filterize limit email for pagination  d();
        $this->data['_num_rows'] = $this->email_model->like($name_post)->like($subject_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->email()->num_rows();

         //config pagination
         $config['base_url'] = base_url().'email/index/fn:'.$exp_name[1].'/em:'.$exp_subject[1].'/'.$sort_by.'/'.$sort_order.'/';
         $config['total_rows'] = $this->data['num_rows_all'];
         $config['per_page'] = 25;
         $config['uri_segment'] = $this->config->item('uri_segment_pager', 'ion_auth');

        //inisialisasi config
         $this->pagination->initialize($config);

        //create pagination
        $this->data['halaman'] = $this->pagination->create_links();

        $this->load->view('email/body', $this->data);
        }
    }
}
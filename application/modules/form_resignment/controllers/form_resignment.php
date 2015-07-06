<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_resignment extends MX_Controller {

  public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_resignment/form_resignment_model','form_resignment_model');
    
        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);


            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('form_resignment.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_resignment  
            $this->data['form_resignment_all'] = $this->form_resignment_model->like($ftitle_post)->where('is_deleted',0)->form_resignment()->result();
            
            $this->data['num_rows_all'] = $this->form_resignment_model->like($ftitle_post)->where('is_deleted',0)->form_resignment()->num_rows();

            $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_resignment()->result();
            $this->data['_num_rows'] = $this->form_resignment_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_resignment()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_resignment/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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

            $this->_render_page('form_resignment/index', $this->data);
        }
    }

    function input()
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id'); 
        $this->data['sess_nik'] = get_nik($sess_id);

        $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
        $this->get_user_atasan();
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted'=>'where/0'));

        $this->_render_page('form_resignment/input', $this->data);
    }

    function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_resign' , 'Tanggal Akhir Kerja', 'trim|required');
            if($this->form_validation->run() == FALSE)
            {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
                redirect('form_resignment/input', 'refresh');
            }
            else
            {
                $user_id= $this->input->post('emp');

                $data = array(
                    'id_comp_session' => 1,
                    'date_resign' => date('Y-m-d',strtotime($this->input->post('date_resign'))),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id'),
                    );

                    if ($this->form_validation->run() == true && $this->form_resignment_model->create_($user_id, $data))
                    {
                     $resignment_id = $this->db->insert_id();
                     $user_app_lv1 = getValue('user_app_lv1', 'users_resignment', array('id'=>'where/'.$resignment_id));
                     if(!empty($user_app_lv1)):
                        $this->approval->request('lv1', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     else:
                        $this->approval->request('hrd', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     endif;
                     redirect('form_resignment', 'refresh');
                     //echo json_encode(array('st' =>1));     
                    }
            }
        }
    }

    function detail($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();
        
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->_render_page('form_resignment/detail', $this->data);
    }

    function add_wawancara()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_resign' , 'Tanggal Akhir Kerja', 'trim|required');
            //$this->form_validation->set_rules('alasan_resign_id' , 'Alasan berhenti kerja', 'trim|required');
            $this->form_validation->set_rules('desc_resign' , 'Alasan utama berhenti kerja', 'trim|required');
            $this->form_validation->set_rules('procedure_resign' , 'Prosedur perusahaan', 'trim|required');
            $this->form_validation->set_rules('kepuasan_resign' , 'Hal yang memuaskan', 'trim|required');
            $this->form_validation->set_rules('saran_resign' , 'Saran', 'trim|required');
            $this->form_validation->set_rules('rework_resign' , 'Pertimbangan Kembali', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            }
            else
            {
                $user_id= $this->input->post('emp');

                $data = array(
                    'id_comp_session' => 1,
                    'date_resign' => date('Y-m-d',strtotime($this->input->post('date_resign'))),
                    'alasan_resign_id' => implode(',',$this->input->post('alasan_resign_id')),
                    'desc_resign'            => $this->input->post('desc_resign'),
                    'procedure_resign'            => $this->input->post('procedure_resign'),
                    'kepuasan_resign'            => $this->input->post('kepuasan_resign'),
                    'saran_resign'            => $this->input->post('saran_resign'),
                    'rework_resign'            => $this->input->post('rework_resign'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $this->session->userdata('user_id'),
                    );

                    if ($this->form_validation->run() == true && $this->form_resignment_model->create_($user_id, $data))
                    {
                     $resignment_id = $this->db->insert_id();
                     $user_app_lv1 = getValue('user_app_lv1', 'users_resignment', array('id'=>'where/'.$resignment_id));
                     if(!empty($user_app_lv1)):
                        $this->approval->request('lv1', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     else:
                        $this->approval->request('hrd', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     endif;
                     redirect('form_resignment', 'refresh');
                     //echo json_encode(array('st' =>1));     
                    }
            }
        }
    }

    function detail_wawancara($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();
        
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
        $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
        $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->_render_page('form_resignment/detail', $this->data);
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $user_id = get_nik($this->session->userdata('user_id'));
            $date_now = date('Y-m-d');

            $data = array(
            'is_app_'.$type => 1, 
            'app_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $approval_status = $this->input->post('app_status_'.$type);

            $is_app = getValue('is_app_'.$type, 'users_resignment', array('id'=>'where/'.$id));
            $approval_status = $this->input->post('app_status_'.$type);

           $this->form_resignment_model->update($id,$data);
           $user_resignment_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
            if($is_app==0){
                $this->approval->approve('resignment', $id, $approval_status, $this->detail_email($id));
            }else{
                $this->approval->update_approve('resignment', $id, $approval_status, $this->detail_email($id));
            }
            if($type !== 'hrd'){
                $lv = substr($type, -1)+1;
                $lv_app = 'lv'.$lv;
                $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_resignment', array('id'=>'where/'.$id)):0;
                if(!empty($user_app)):
                    $this->approval->request($lv_app, 'resignment', $id, $user_resignment_id, $this->detail_email($id));
                else:
                    $this->approval->request('hrd', 'resignment', $id, $user_resignment_id, $this->detail_email($id));
                endif;
            }
            redirect('form_resignment/detail/'.$id, 'refresh');
        }
    }

    function detail_email($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();
        
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        return $this->load->view('form_resignment/resignment_mail', $this->data, TRUE);
    }

    function detail_email_wawancara($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();
        
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
        $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
        $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        return $this->load->view('form_resignment/resignment_mail', $this->data, TRUE);
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

    function form_resignment_pdf($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();

        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('resignment_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function form_resignment_wawancara_pdf($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->form_resignment_model->form_resignment($id)->result();
        $this->data['_num_rows'] = $this->form_resignment_model->form_resignment($id)->num_rows();
        
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted' => 'where/0'));
        $alasan = explode(',', getAll('users_resignment', array('id' => 'where/'.$id))->row('alasan_resign_id'));
        $this->data['alasan'] = $this->form_resignment_model->get_alasan($alasan);
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('resignment_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_resignment/index')))
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
                elseif(in_array($view, array('form_resignment/input',
                                             'form_resignment/detail',)))
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
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_resignment.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
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
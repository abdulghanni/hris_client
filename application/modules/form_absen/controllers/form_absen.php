<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_absen extends MX_Controller {

	public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_absen/form_absen_model','form_absen_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

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
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('users.username'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_absen  
            $this->data['form_absen_all'] = $this->form_absen_model->like($ftitle_post)->where('is_deleted',0)->form_absen()->result();
            
            $this->data['num_rows_all'] = $this->form_absen_model->like($ftitle_post)->where('is_deleted',0)->form_absen()->num_rows();

            $form_absen = $this->data['form_absen'] = $this->form_absen_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_absen()->result();
            $this->data['_num_rows'] = $this->form_absen_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_absen()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_absen/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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

            $this->_render_page('form_absen/index', $this->data);
        }
    }

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ftitle_post = (strlen($this->input->post('title')) > 0) ? strtolower(url_title($this->input->post('title'),'_')) : "" ;

            redirect('form_absen/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function detail($id)
    {
        
    
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $user_id= getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
            $this->data['user_nik'] = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            //$this->data['comp_session'] = $this->form_absen_model->render_session()->result();
            $form_absen = $this->data['form_absen'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->result();
            $this->data['_num_rows'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->num_rows();
            
            $this->_render_page('form_absen/detail', $this->data);
        }
    }


     function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id'); 
            $this->data['sess_nik'] = get_nik($sess_id);

			$form_absen = $this->data['form_absen'] = getAll('users_absen');
            $absen_id = $form_absen->last_row();
            $this->data['absen_id'] = ($form_absen->num_rows()>0)?$absen_id->id+1:1;

            $this->data['keterangan_absen'] = getAll('keterangan_absen', array('is_deleted'=>'where/0'));
            $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
            
            $this->_render_page('form_absen/input', $this->data);
        }
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->form_validation->set_rules('date_tidak_hadir', 'Tanggal Tidak Absen', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            redirect('form_absen/input', 'refresh');
            }
            else
            {
                $user_id= $this->input->post('emp');
                $sess_id = $this->session->userdata('user_id');
                $data = array(
                    'id_comp_session' => 1,
                    'date_tidak_hadir' => date('Y-m-d', strtotime($this->input->post('date_tidak_hadir'))),
                    'keterangan_id' => $this->input->post('keterangan'),
                    'alasan' => $this->input->post('alasan'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $sess_id
                    );

                if($this->input->post('potong_absen') == 1){
                    $user_nik = get_nik($user_id);
                    $date = $this->input->post('date_tidak_hadir');
                    $recid = $this->get_sisa_absen($user_id)[0]['RECID'];
                    $sisa_absen = $this->get_sisa_absen($user_id)[0]['ENTITLEMENT'] - 1;

                    $this->update_sisa_absen($recid, $sisa_absen);

                    $data2 = array(
                                'nik'       => get_mchid($user_nik),
                                'jhk'       => 1,
                                'absen'      => 1,
                                'tanggal'   => date("d", strtotime($date)),
                                'bulan'     => date("m", strtotime($date)),
                                'tahun'     => date("Y", strtotime($date)),
                                'create_date' => date('Y-m-d',strtotime('now')),
                                'create_user_id' => $this->session->userdata('user_id'),
                            );
                    $this->db->insert('attendance', $data2);
                }

                if ($this->form_validation->run() == true && $this->form_absen_model->create_($user_id,$data))
                {
                 $absen_id = $this->db->insert_id();
                 $user_app_lv1 = getValue('user_app_lv1', 'users_absen', array('id'=>'where/'.$absen_id));
                 $isi_email = get_name($user_id).' mengajukan keterangan tidak absen, untuk melihat detail silakan <a href='.base_url().'form_absen/detail/'.$absen_id.'>Klik Disini</a><br />';

                 if($user_id!==$sess_id):
                    $this->approval->by_admin('absen', $absen_id, $sess_id, $user_id, $this->detail_email($absen_id));
                 endif;
                 if(!empty($user_app_lv1)):
                     if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Keterangan Tidak Absen', $isi_email);
                     $this->approval->request('lv1', 'absen', $absen_id, $user_id, $this->detail_email($absen_id));
                 else:
                     if(!empty(getEmail($this->approval->approver('absen'))))$this->send_email(getEmail($this->approval->approver('absen')), 'Pengajuan Keterangan Tidak Absen', $isi_email);
                     $this->approval->request('hrd', 'absen', $absen_id, $user_id, $this->detail_email($absen_id));
                 endif;

                  redirect('form_absen', 'refresh');
                 //echo json_encode(array('st' =>1));     
                }
            }
        }
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_'.$type => 1,
        'user_app_'.$type => $user_id, 
        'date_app_'.$type => $date_now,
        );
        
        $this->form_absen_model->update($id,$data);
        $user_absen_id = getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
        $approval_status = 1;
        $this->approval->approve('absen', $id, $approval_status, $this->detail_email($id));
        $isi_email = 'Status pengajuan keterangan tidak absen anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_absen/detail/'.$id.'>Klik Disini</a><br />';
        $isi_email_request = get_name($user_absen_id).' mengajukan keterangan tidak absen absen, untuk melihat detail silakan <a href='.base_url().'form_absen/detail/'.$id.'>Klik Disini</a><br />';
        if(!empty(getEmail($user_absen_id)))$this->send_email(getEmail($user_absen_id), 'Status Pengajuan Keterangan Tidak Absen dari Atasan', $isi_email);
                
        if($type !== 'hrd'){
        $lv = substr($type, -1)+1;
        $lv = 'lv'.$lv;
        $user_app = getValue('user_app_'.$lv, 'users_absen', array('id'=>'where/'.$id));
        if(!empty($user_app)):
            if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Keterangan Tidak Absen', $isi_email_request);
            $this->approval->request($lv, 'absen', $id, $user_absen_id, $this->detail_email($id));
        else:
            if(!empty(getEmail($this->approval->approver('absen'))))$this->send_email(getEmail($this->approval->approver('absen')), 'Pengajuan Keterangan Tidak Absen', $isi_email_request);
            $this->approval->request('hrd', 'absen', $id, $user_absen_id, $this->detail_email($id));
        endif;
        }
    }

    function detail_email($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id= getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
        $this->data['user_nik'] = $sess_nik = get_nik($user_id);
        $this->data['sess_id'] = $this->session->userdata('user_id');
        
        $form_absen = $this->data['form_absen'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->result();
        $this->data['_num_rows'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->num_rows();
    
        return $this->load->view('form_absen/absen_mail', $this->data, TRUE);
    }

    function form_absen_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $user_id= getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
        $this->data['user_nik'] = $sess_nik = get_nik($user_id);
        $this->data['sess_id'] = $this->session->userdata('user_id');
        
        $form_absen = $this->data['form_absen'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->result();
        $this->data['_num_rows'] = $this->form_absen_model->where('is_deleted',0)->form_absen_detail($id)->num_rows();

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Keterangan Tidak Absen-'.get_name($user_id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('absen_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function get_sisa_absen($user_id = null)
    {
        //$id = $this->session->userdata('user_id');
        if($user_id !=null)
        {
            $url = get_api_key().'users/sisa_cuti/EMPLID/'.get_nik($user_id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getsisa_absen = file_get_contents($url);
                $sisa_absen = json_decode($getsisa_absen, true);
                return $sisa_absen;
            } else {
                return '-';
            }
        }
    }

    function update_sisa_absen($recid, $sisa_absen)
    { 
        $method = 'post';
        $params =  array();
        $uri = get_api_key().'users/sisa_cuti/RECID/'.$recid.'/ENTITLEMENT/'.$sisa_absen;

        $this->rest->format('application/json');

        $result = $this->rest->{$method}($uri, $params);


        if(isset($result->status) && $result->status == 'success')  
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

                if(in_array($view, array('form_absen/index')))
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
                elseif(in_array($view, array('form_absen/input',)))
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
                    $this->template->add_js('form_absen.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('approval_img.css');
                    
                     
                }elseif(in_array($view, array('form_absen/detail')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('form_absen.js');

                    
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
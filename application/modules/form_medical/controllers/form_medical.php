<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_medical extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->helper('url');
        
        $this->load->database();
		$this->load->model('person/person_model','person_model');
        $this->load->model('form_medical/form_medical_model','form_medical_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {   
        $sess_nik= get_nik($this->session->userdata('user_id'));
        $sess_id= $this->session->userdata('user_id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('form_medical.title'=>$ftitle_re) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_medical  
            $this->data['form_medical_all'] = $this->form_medical_model->like($ftitle_post)->where('is_deleted',0)->form_medical()->result();
            
            $this->data['num_rows_all'] = $this->form_medical_model->like($ftitle_post)->where('is_deleted',0)->form_medical()->num_rows();

            $form_medical = $this->data['form_medical'] = $this->form_medical_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_medical()->result();
            $this->data['_num_rows'] = $this->form_medical_model->like($ftitle_post)->where('is_deleted',0)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_medical()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_medical/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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

            $this->_render_page('form_medical/index', $this->data);
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $sess_id = $this->session->userdata('user_id');
        $this->data['bagian'] = get_user_organization(get_nik($sess_id));
        $this->data['all_users'] = getAll('users', array('active'=>'where/1'))->result_array();
        $this->data['hubungan'] = getAll('medical_hubungan', array('is_deleted' => 'where/0'))->result_array();
        $this->data['jenis'] = getAll('medical_jenis_pemeriksaan', array('is_deleted' => 'where/0'))->result_array();
        $this->_render_page('form_medical/input', $this->data);
    }

    function add()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->session->userdata('user_id');
        $num_rows_medical = getAll('users_medical')->num_rows();

        if($num_rows_medical>0){
            $last_medical_id = $this->db->select('id')->order_by('id', 'asc')->get('users_medical')->last_row();
            $last_medical_id = $last_medical_id->id+1;
        }else{
            $last_medical_id = 1;
        }

        $num_rows_medical_detail = getAll('users_medical_detail')->num_rows();

        if($num_rows_medical_detail>0){
            $last_medical_detail_id = $this->db->select('id')->order_by('id', 'asc')->get('users_medical_detail')->last_row();
            $last_medical_detail_id = $last_medical_detail_id->id+1;
        }else{
            $last_medical_detail_id = 1;
        }

        $medical_detail = array(
            'karyawan_id' => $this->input->post('emp'),
            'pasien' => $this->input->post('pasien'),
            'hubungan_id' => $this->input->post('hubungan'),
            'jenis_pemeriksaan_id' => $this->input->post('jenis'),
            'rupiah' => str_replace( ',', '', $this->input->post('rupiah') )
            );

        $medical_detail_id = '';
        for($i=0;$i<sizeof($medical_detail['karyawan_id']);$i++):
                $medical_detail_id .= $last_medical_detail_id + $i.',';
            endfor;
        
        $medical = array(
            'user_id' => $this->session->userdata('user_id'),
            'user_medical_detail_id' => $medical_detail_id,
            'created_by' => $this->session->userdata('user_id'),
            'created_on' => date('Y-m-d',strtotime('now')),
            );

        $this->db->insert('users_medical', $medical);

        for($i=0;$i<sizeof($medical_detail['karyawan_id']);$i++):
            $data_medical_detail = array(
                'user_medical_id' => $last_medical_id,
                'karyawan_id'=>$medical_detail['karyawan_id'][$i],
                'pasien'=>$medical_detail['pasien'][$i],
                'hubungan_id'=>$medical_detail['hubungan_id'][$i],
                'jenis_pemeriksaan_id'=>$medical_detail['jenis_pemeriksaan_id'][$i],
                'rupiah'=>$medical_detail['rupiah'][$i],
                'created_by' => $this->session->userdata('user_id'),
                'created_on' => date('Y-m-d',strtotime('now')),
                );

            $this->db->insert('users_medical_detail', $data_medical_detail);
            endfor;

            $this->send_approval_request($last_medical_id, $sess_id);
            redirect('form_medical', 'refresh');
    }

    function detail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $user_id = getValue('user_id', 'users_medical', array('id'=>'where'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['created_by'] = getValue('created_by', 'users_medical', array('id'=>'where/'.$id));
        $this->data['created_on'] = getValue('created_on', 'users_medical', array('id'=>'where/'.$id));
        $this->data['is_app'] = getValue('is_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['user_app'] = getValue('user_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['date_app'] = getValue('date_app', 'users_medical', array('id'=>'where/'.$id));
        $this->_render_page('form_medical/detail', $this->data);

    }

    function do_approve($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $data = array(
        'is_app' => 1, 
        'user_app' => $this->session->userdata('user_id'), 
        'date_app' => date('Y-m-d',strtotime('now')),
        );

        $this->approval_mail($id);
       if ($this->form_medical_model->update($id,$data)) {
           return TRUE;
       }
    }

    function send_approval_request($id, $user_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sender_id= $this->session->userdata('user_id');
        $url = base_url().'form_medical/detail';
        
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => get_superior($sender_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                'email_body' => get_name($sender_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a href='.$url.'/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function approval_mail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sender_id= $this->session->userdata('user_id');
        $receiver_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $url = base_url().'form_medical/detail';
        
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                'email_body' => get_name($sender_id).' menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a href='.$url.'/'.$id.'>Klik Disini</a><br/>'.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
    }

    function detail_email($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id = getValue('user_id', 'users_medical', array('id'=>'where'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['created_by'] = getValue('created_by', 'users_medical', array('id'=>'where/'.$id));
        $this->data['created_on'] = getValue('created_on', 'users_medical', array('id'=>'where/'.$id));
        $this->data['is_app'] = getValue('is_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['user_app'] = getValue('user_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['date_app'] = getValue('date_app', 'users_medical', array('id'=>'where/'.$id));
        return $this->_render_page('form_medical/medical_mail', $this->data, TRUE);
    }

    function form_medical_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $user_id = getValue('user_id', 'users_medical', array('id'=>'where'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['created_by'] = getValue('created_by', 'users_medical', array('id'=>'where/'.$id));
        $this->data['created_on'] = getValue('created_on', 'users_medical', array('id'=>'where/'.$id));
        $this->data['is_app'] = getValue('is_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['user_app'] = getValue('user_app', 'users_medical', array('id'=>'where/'.$id));
        $this->data['date_app'] = getValue('date_app', 'users_medical', array('id'=>'where/'.$id));

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'REKAPITULASI RAWAT JALAN & INAP - '.$id;
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('medical_pdf', $this->data, true); 
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

                if(in_array($view, array('form_medical/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    //$this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_medical.js');

                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_medical/input',
                                             'form_medical/detail',
                    )))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('jquery.maskMoney.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_medical.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                     
                }elseif(in_array($view, array('form_medical/approval/supervisor',
                                              'form_medical/approval/kabagian',
                                              'form_medical/approval/hr')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('form_medical.js');

                    
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

/* End of file form_medical.php */
/* Location: ./application/modules/form_medical/controllers/form_medical.php */
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_medical extends MX_Controller {

	public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
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
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['sess_nik'] = get_nik($this->session->userdata('user_id'));
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ftitle_post = (strlen($this->input->post('title')) > 0) ? strtolower(url_title($this->input->post('title'),'_')) : "" ;

            redirect('form_medical/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function input()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_admin() && !is_admin_bagian()){
            return show_error('You must be an administrator to view this page.');
        }else{
        $sess_id = $this->session->userdata('user_id');
        $this->data['bagian'] = get_user_organization(get_nik($sess_id));
        $this->data['hubungan'] = getAll('medical_hubungan', array('is_deleted' => 'where/0'))->result_array();
        $this->data['jenis'] = getAll('medical_jenis_pemeriksaan', array('is_deleted' => 'where/0'))->result_array();

        $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
        $this->get_user_atasan();
        $this->get_user_same_org();
        $this->_render_page('form_medical/input', $this->data);
        }
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
            'user_id' => $this->input->post('pengaju'),
            'user_medical_detail_id' => $medical_detail_id,
            'user_app_lv1'          => $this->input->post('atasan1'),
            'user_app_lv2'          => $this->input->post('atasan2'),
            'user_app_lv3'          => $this->input->post('atasan3'),
            'created_by' => $sess_id,
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
                'created_by' => $sess_id,
                'created_on' => date('Y-m-d',strtotime('now')),
                );

                $this->db->insert('users_medical_detail', $data_medical_detail);
                endfor;
                $user_id = $this->input->post('pengaju');
                $user_app_lv1 = getValue('user_app_lv1', 'users_medical', array('id'=>'where/'.$last_medical_id));
                $isi_email = get_name($user_id).' mengajukan Rekapitulasi Rawat Jalan/Inap, untuk melihat detail silakan <a href='.base_url().'form_medical/detail/'.$last_medical_id.'>Klik Disini</a><br />';

                if($user_id!==$sess_id):
                     $this->approval->by_admin('medical', $last_medical_id, $sess_id, $user_id, $this->detail_email($last_medical_id));
                     endif;
                if(!empty($user_app_lv1)):
                     if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Rekapitulasi Rawat Jalan/Inap', $isi_email);
                     $this->approval->request('lv1', 'medical', $last_medical_id, $user_id, $this->detail_email($last_medical_id));
                else:
                     if(!empty(getEmail($this->approval->approver('medical'))))$this->send_email(getEmail($this->approval->approver('medical')), 'Pengajuan Rekapitulasi Rawat Jalan/Inap', $isi_email);
                     $this->approval->request('hrd', 'medical', $last_medical_id, $user_id, $this->detail_email($last_medical_id));
                endif;
                
                $user_id = getValue('user_id', 'users_medical', array('id' => 'where/'.$last_medical_id));
                $user = getAll('users', array('id'=>'where/'.$user_id))->row();
                $user_folder = $user->id.$user->first_name;
                if(!is_dir('./'.'uploads')){
                mkdir('./'.'uploads', 0777);
                }
                if(!is_dir('./uploads/'.$user_folder)){
                mkdir('./uploads/'.$user_folder, 0777);
                }
                if(!is_dir("./uploads/$user_folder/medical/")){
                mkdir("./uploads/$user_folder/medical/", 0777);
                }


                $path = "./uploads/$user_folder/medical/";
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path"=>$path,
                    "allowed_types"=>"*"
                ));
                if($this->upload->do_multi_upload("userfile")){
                    $up = $this->upload->get_multi_upload_data();
                    $attachment = '';
                    for($i=0;$i<sizeof($up);$i++):
                        $koma = ($i<sizeof($up)-1)?',':'';
                        $attachment .= $up[$i]['file_name'].$koma;
                    endfor;
                    $data = array(
                            'attachment' => $attachment,
                        );
                    $this->db->where('id', $last_medical_id)->update('users_medical', $data);
                }
                redirect('form_medical', 'refresh');
    }

    function detail($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['user_id'] =$user_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $this->data['sess_id'] = $sess_id= $this->session->userdata('user_id');
        $this->data['sess_nik'] = get_nik($sess_id);
        $this->data['is_app_hrd'] = getValue('is_app_hrd', 'users_medical', array('id'=>'where/'.$id));
        $this->data['note_hrd'] = getValue('note_hrd', 'users_medical', array('id'=>'where/'.$id));
        $this->data['app_status_id_lv1'] = getValue('app_status_id_lv1', 'users_medical', array('id'=>'where/'.$id));
        $this->data['note_lv1'] = getValue('note_lv1', 'users_medical', array('id'=>'where/'.$id));
        $this->data['creator_id'] = getValue('created_by', 'users_medical', array('id'=>'where/'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['detail_hrd'] = $this->form_medical_model->form_medical_hrd($id)->result_array();
        $this->data['total_medical_hrd'] = $this->form_medical_model->get_total_medical_hrd($id);
        $form_medical = $this->data['form_medical'] = $this->form_medical_model->form_medical($id)->result();
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['_num_rows'] = $this->form_medical_model->form_medical($id)->num_rows();
        $first_name = getValue('first_name', 'users', array('id'=>'where/'.$user_id));
        $this->data['user_folder'] = $user_id.$first_name.'/medical/';
        $attachment = getValue('attachment', 'users_medical', array('id' => 'where/'.$id));
        $this->data['attachment'] = explode(",",$attachment);
        $this->get_user_same_org($user_id);
        $this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'))->result_array();
        $this->data['hubungan'] = getAll('medical_hubungan', array('is_deleted' => 'where/0'))->result_array();
        $this->data['jenis'] = getAll('medical_jenis_pemeriksaan', array('is_deleted' => 'where/0'))->result_array();

        $this->_render_page('form_medical/detail', $this->data);

    }

    function edit($id)
    {   
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');
        $is_app_hrd = getValue('is_app_hrd', 'users_medical', array('id'=>'where/'.$id));
        $medical_detail_id = $this->input->post('detail_id');
        $approve = $this->input->post('checkbox1');
        $user_medical_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        
        $medical_detail = array(
            'karyawan_id' => $this->input->post('emp'),
            'pasien' => $this->input->post('pasien'),
            'hubungan_id' => $this->input->post('hubungan'),
            'jenis_pemeriksaan_id' => $this->input->post('jenis'),
            'rupiah' => $this->input->post('rupiah_update')
            );


        for($i=0;$i<sizeof($medical_detail_id);$i++):
            $data = array(
                    'karyawan_id'=>$medical_detail['karyawan_id'][$i],
                    'pasien'=>$medical_detail['pasien'][$i],
                    'hubungan_id'=>$medical_detail['hubungan_id'][$i],
                    'jenis_pemeriksaan_id'=>$medical_detail['jenis_pemeriksaan_id'][$i],
                    'rupiah'=>$medical_detail['rupiah'][$i],
                    'edited_by' => $user_id,
                    'edited_on' => $date_now,
                ); 
            $this->db->where('id', $medical_detail_id[$i]);
            $this->db->update('users_medical_detail', $data);
        endfor;

         $user_id = getValue('user_id', 'users_medical', array('id' => 'where/'.$id));
                $user = getAll('users', array('id'=>'where/'.$user_id))->row();
                $user_folder = $user->id.$user->first_name;
                if(!is_dir('./'.'uploads')){
                mkdir('./'.'uploads', 0777);
                }
                if(!is_dir('./uploads/'.$user_folder)){
                mkdir('./uploads/'.$user_folder, 0777);
                }
                if(!is_dir("./uploads/$user_folder/medical/")){
                mkdir("./uploads/$user_folder/medical/", 0777);
                }


                $path = "./uploads/$user_folder/medical/";
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path"=>$path,
                    "allowed_types"=>"*"
                ));

        if($this->upload->do_multi_upload("userfile")){
                    $up = $this->upload->get_multi_upload_data();
                    $attachment = '';
                    for($i=0;$i<sizeof($up);$i++):
                        $koma = ($i<sizeof($up)-1)?',':'';
                        $attachment .= $up[$i]['file_name'].$koma;
                    endfor;
                    $file_old = $this->input->post('userfileold');
                    $attachment_old = '';
                    for($i=0;$i<sizeof($file_old);$i++):
                        $attachment_old .= $file_old[$i].',';
                    endfor;
                    $data = array(
                            'attachment' => $attachment_old.$attachment,
                            'edited_by' => $user_id,
                            'edited_on' => $date_now,
                        );
                    $this->db->where('id', $id)->update('users_medical', $data);
                }
        redirect('form_medical/detail/'.$id, 'refresh');
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $user_medical_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $date_now = date('Y-m-d');

        $data = array(
        'is_app_'.$type => 1,
        'user_app_'.$type => $user_id, 
        'date_app_'.$type => $date_now,
        'app_status_id_'.$type => $this->input->post('app_status_id_'.$type),
        'note_'.$type => $this->input->post('note_'.$type),
        );
        
       $this->form_medical_model->update($id,$data);
       $this->approval_mail($id);
       $isi_email = 'Status pengajuan Rekapitulasi Rawat Jalan/Inap anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
       $isi_email_request = get_name($user_medical_id).' mengajukan Rekapitulasi Rawat Jalan/Inap medical, untuk melihat detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
       if(!empty(getEmail($user_medical_id)))$this->send_email(getEmail($user_medical_id), 'Status Pengajuan Rekapitulasi Rawat Jalan/Inap dari Atasan', $isi_email);
          
       if($type !== 'hrd'){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_medical', array('id'=>'where/'.$id)):0;
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), 'Pengajuan Rekapitulasi Rawat Jalan/Inap', $isi_email_request);
                $this->approval->request($lv_app, 'medical', $id, $user_medical_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('medical'))))$this->send_email(getEmail($this->approval->approver('medical')), 'Pengajuan Rekapitulasi Rawat Jalan/Inap', $isi_email_request);
                $this->approval->request('hrd', 'medical', $id, $user_medical_id, $this->detail_email($id));
            endif;
        }
    }

    function do_approve_hrd($id)
    {   
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');
        $is_app_hrd = getValue('is_app_hrd', 'users_medical', array('id'=>'where/'.$id));
        $medical_detail_id = $this->input->post('detail_id');
        $rupiah = $this->input->post('rupiah_update');
        $approve = $this->input->post('checkbox1');
        $user_medical_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        
        if($is_app_hrd == 0){
            for($i=0;$i<sizeof($medical_detail_id);$i++):
                $data = array(
                        'user_medical_detail_id' => $medical_detail_id[$i],
                        'rupiah' => $rupiah[$i],
                        'is_approve' => $approve[$i],
                        'created_by' => $user_id,
                        'created_on' => $date_now,
                    ); 

                $this->db->insert('users_medical_hrd', $data);
            endfor;
        }else{
            for($i=0;$i<sizeof($medical_detail_id);$i++):
                $data = array(
                        'rupiah' => $rupiah[$i],
                        'is_approve' => $approve[$i],
                        'edited_by' => $user_id,
                        'edited_on' => $date_now,
                    ); 
                $this->db->where('user_medical_detail_id', $medical_detail_id[$i]);
                $this->db->update('users_medical_hrd', $data);
            endfor;
        }
        

        $data2 = array(
        'is_app_hrd' => 1,
        'user_app_hrd' => $user_id, 
        'date_app_hrd' => $date_now,
        'note_hrd' => $this->input->post('note_hrd'),
        );
        
        $this->form_medical_model->update($id,$data2);
        $this->approval_mail($id);
        $isi_email = 'Status pengajuan Rekapitulasi Rawat Jalan/Inap anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
        if(!empty(getEmail($user_medical_id)))$this->send_email(getEmail($user_medical_id), 'Status Pengajuan Rekapitulasi Rawat Jalan/Inap dari Atasan', $isi_email);
       

        redirect('form_medical/detail/'.$id, 'refresh');
    }

    function send_approval_request($id, $user_id)
    {
        $url = base_url().'form_medical/detail/'.$id;
        $user_app_lv1 = getValue('user_app_lv1', 'users_medical', array('id'=>'where/'.$id));
        $user_app_lv2 = getValue('user_app_lv2', 'users_medical', array('id'=>'where/'.$id));
        $user_app_lv3 = getValue('user_app_lv3', 'users_medical', array('id'=>'where/'.$id));
        
        //approval to LV1
        if(!empty($user_app_lv1)){
            $data1 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $user_app_lv1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                    'email_body' => get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data1);
        }

        //approval to LV2
        if(!empty($user_app_lv2)){
            $data2 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $user_app_lv2,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                    'email_body' => get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data2);
        }

        //approval to LV3
        if(!empty($user_app_lv3)){
            $data3 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $user_app_lv3,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                    'email_body' => get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data3);
        }

        //approval to hrd
            $data4 = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => 1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                    'email_body' => get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data4);
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
        $url = base_url().'form_medical/detail/'.$id;
        
        $data = array(
                'sender_id' => get_nik($sender_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Rekapitulasi Rawat Jalan & Inap',
                'email_body' => get_name($sender_id).' menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
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
        $user_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $sess_id= $this->session->userdata('user_id');
        $this->data['sess_nik'] = get_nik($sess_id);
        $this->data['is_app_hrd'] = getValue('is_app_hrd', 'users_medical', array('id'=>'where/'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['detail_hrd'] = $this->form_medical_model->form_medical_hrd($id)->result_array();
        $this->data['total_medical_hrd'] = $this->form_medical_model->get_total_medical_hrd($id);
        $form_medical = $this->data['form_medical'] = $this->form_medical_model->form_medical($id)->result();
        $this->data['_num_rows'] = $this->form_medical_model->form_medical($id)->num_rows();

        return $this->load->view('form_medical/medical_mail', $this->data, true);
    }

    function form_medical_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        
        $form_medical = $this->data['form_medical'] = $this->form_medical_model->form_medical($id)->result();

        $user_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->form_medical_model->form_medical_detail($id)->result_array();
        $this->data['detail_hrd'] = $this->form_medical_model->form_medical_hrd($id)->result_array();
        $this->data['total_medical_hrd'] = $this->form_medical_model->get_total_medical_hrd($id);
        $form_medical = $this->data['form_medical'] = $this->form_medical_model->form_medical($id)->result();
        $this->data['_num_rows'] = $this->form_medical_model->form_medical($id)->num_rows();
            

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'REKAPITULASI RAWAT JALAN & INAP - '.$id;
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('medical_pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function get_user_same_org($user_id = null)
    {

        $user_id = ($user_id != null) ? $user_id : $this->session->userdata('user_id');
        $url_org = get_api_key().'users/org/EMPLID/'.get_nik($user_id).'/format/json';
        $headers_org = get_headers($url_org);
        $response = substr($headers_org[0], 9, 3);
        if ($response != "404") {
        $get_user_pengganti = file_get_contents($url_org);
        $user_pengganti = json_decode($get_user_pengganti, true);
        return $this->data['user_same_org'] = $user_pengganti;
        }else{
         return $this->data['user_same_org'] = 'Tidak ada karyawan dengan departement yang sama';
        }
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
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    
                }
                elseif(in_array($view, array('form_medical/input',
                                             'form_medical/detail',
                    )))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('jquery.maskMoney.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('emp_dropdown.js');
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
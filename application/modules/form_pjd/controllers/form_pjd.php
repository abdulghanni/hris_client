<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_pjd extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('form_pjd/form_spd_luar_group_model','form_spd_luar_group_model');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    { 
        $this->data['title'] = "Daftar Perjalanan Dinas";
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //set sort order
            $this->data['sort_order'] = $sort_order;
            
            //set sort by
            $this->data['sort_by'] = $sort_by;
           
            //set filter by title
            $this->data['ftitle_param'] = $ftitle; 
            $exp_ftitle = explode(":",$ftitle);
            $ftitle_re = str_replace("_", " ", $exp_ftitle[1]);
            $ftitle_post = (strlen($ftitle_re) > 0) ? array('creator.username'=>$ftitle_re, 'users_spd_luar_group.task_receiver'=>get_nik_from_name($ftitle_re)) : array() ;
            
            //set default limit in var $config['list_limit'] at application/config/ion_auth.php 
            $this->data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : 10 ;

            $this->data['offset'] = 6;

            //list of filterize all form_spd_luar_group  
            $this->data['form_spd_luar_group_all'] = $this->form_spd_luar_group_model->like($ftitle_post)->form_spd_luar_group()->result();
            
            $this->data['num_rows_all'] = $this->form_spd_luar_group_model->like($ftitle_post)->form_spd_luar_group()->num_rows();

            $form_spd_luar_group = $this->data['form_spd_luar_group'] = $this->form_spd_luar_group_model->like($ftitle_post)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar_group()->result();
            $this->data['_num_rows'] = $this->form_spd_luar_group_model->like($ftitle_post)->limit($limit)->offset($offset)->order_by($sort_by, $sort_order)->form_spd_luar_group()->num_rows();
            

             //config pagination
             $config['base_url'] = base_url().'form_pjd/index/fn:'.$exp_ftitle[1].'/'.$sort_by.'/'.$sort_order.'/';
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
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/pjd'));
            $this->_render_page('form_pjd/index', $this->data);
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

            redirect('form_pjd/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function submit($id)
    {
        $this->data['title'] = "Detail Perjalanan Dinas";
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
        
            
            $receiver = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_receiver');
            $creator = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_creator');
            $user_submit = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('user_submit');
            $this->data['biaya_pjd_group'] = getAll('users_spd_luar_group_biaya', array('user_spd_luar_group_id'=>'where/'.$id));
            $this->data['biaya_tambahan'] = getAll('pjd_biaya', array('type_grade' => 'where/0'));
            $this->data['receiver'] = $p = explode(",", $receiver);
            $this->data['receiver_submit'] = explode(",", $user_submit);
            $this->data['id']=$id;
            $this->data['created_by'] = getValue('created_by', 'users_spd_luar_group', array('id'=>'where/'.$id));
            $this->data['task_creator'] = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
            $b = $this->data['biaya_pjd'] = $this->db->distinct()->select('users_spd_luar_group_biaya.pjd_biaya_id as biaya_id, pjd_biaya.title as jenis_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('pjd_biaya.type_grade', 0)->get();//print_mz($this->data['biaya_pjd']->result());                   
            $this->data['detail'] = $this->db->distinct()->select('user_id')->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
            $this->data['ci'] = $this;

            $a = strtotime(getValue('date_spd_end', 'users_spd_luar_group', array('id'=>'where/'.$id)));
        $b = strtotime(getValue('date_spd_start', 'users_spd_luar_group', array('id'=>'where/'.$id)));

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        $biaya_fix_1 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 1 or pjd_biaya_id=4 or pjd_biaya_id=7 or pjd_biaya_id=10 or pjd_biaya_id=13 or pjd_biaya_id=19 or pjd_biaya_id=16)) AS uang_makan", FALSE)->get()->row_array();
        $this->data['uang_makan'] = number_format($biaya_fix_1['uang_makan']*$jml_pjd);
        $biaya_fix_2 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 2 or pjd_biaya_id=5 or pjd_biaya_id=8 or pjd_biaya_id=11 or pjd_biaya_id=14 or pjd_biaya_id=20 or pjd_biaya_id=17)) AS uang_saku", FALSE)->get()->row_array();
        $this->data['uang_saku'] = number_format($biaya_fix_2['uang_saku']*$jml_pjd);
        $biaya_fix_3 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 3 or pjd_biaya_id=6 or pjd_biaya_id=9 or pjd_biaya_id=12 or pjd_biaya_id=15 or pjd_biaya_id=21 or pjd_biaya_id=18)) AS hotel", FALSE)->get()->row_array();
        $this->data['hotel'] = number_format($biaya_fix_3['hotel']*$jml_pjd);
            
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));

            $this->_render_page('form_pjd/submit', $this->data);
        }
    }

    public function do_submit($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $user_id = $this->session->userdata('user_id');
        $sess_nik = get_nik($user_id);
        $date_now = date('Y-m-d');

        
        $creator_id = $this->db->where('id', $id)->get('users_spd_luar_group')->row('task_creator');
        $user_submit_id = $this->db->where('id', $id)->get('users_spd_luar_group')->row('user_submit');
        $user_submit = (!empty($user_submit_id)) ? $user_submit_id.','.$sess_nik:$sess_nik;

        $additional_data = array(
        'is_submit' => 1,  
        'user_submit' => $user_submit,  
        'date_submit' => $date_now);

        if($this->form_spd_luar_group_model->update($id,$additional_data)) {
        $this->send_spd_submitted_mail($id, $creator_id);
        redirect('form_pjd/submit/'.$id,'refresh');
       }
    }

    public function do_cancel($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $date_now = date('Y-m-d');

        $sender_id = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $receiver_id = getValue('task_receiver', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $additional_data = array(
        'cancel_note' => $this->input->post('cancel_note'),
        'is_deleted' => 1,  
        'deleted_by' => $this->session->userdata('user_id'),
        'deleted_on' => $date_now);

        $this->form_spd_luar_group_model->update($id,$additional_data);
        
        $this->send_spd_canceled_mail($id, $sender_id, $receiver_id);
        return true;
       // redirect('form_spd_luar/submit/'.$id,'refresh');
    }

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $form = 'spd_luar_group';
        $user_id = get_nik($this->session->userdata('user_id'));
        $date_now = date('Y-m-d');
        $approval_status = $this->input->post('app_status_'.$type);
        $data = array(
        'is_app_'.$type => 1,
        'user_app_'.$type => $user_id, 
        'date_app_'.$type => $date_now,
        'app_status_id_'.$type => $approval_status,
        'note_'.$type => $this->input->post('note_'.$type)
        );

        $is_app = getValue('is_app_'.$type, 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->form_spd_luar_group_model->update($id,$data);

        if($is_app==0){
            $this->approval->approve($form, $id, $approval_status, $this->detail_email($id));
        }else{
            $this->approval->update_approve($form, $id, $approval_status, $this->detail_email($id));
        }

        if($type !== 'hrd'  && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_spd_luar_group', array('id'=>'where/'.$id)) : 0;
            $user_spd_luar_group_id = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
            //$subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Perjalanan Dinas Dalam Kota dari Atasan';
            $subject_email_request = get_form_no($id).' - Pengajuan Perjalanan Dinas';
            $isi_email = 'Status pengajuan perjalan dinas anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_pjd/submit/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_spd_luar_group_id ).' mengajukan Permohonan perjalan dinas, untuk melihat detail silakan <a href='.base_url().'form_pjd/submit/'.$id.'>Klik Disini</a><br />';
            
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                $this->approval->request($lv_app, $form, $id, $user_spd_luar_group_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), $subject_email_request, $isi_email_request);
                $this->approval->request('hrd', $form, $id, $user_spd_luar_group_id, $this->detail_email($id));
            endif;
        }elseif($type == 'hrd' && $approval_status == 1){
            $this->approval->task_receiver($form, $id, $this->detail_email($id));
        }else{
            $task_receiver = getValue('task_receiver', 'users_spd_luar_group', array('id'=>'where/'.$id));
            $task_receiver_id = explode(',',$task_receiver);
            //$email_body = "Status pengajuan permohonan spd_luar_group yang diajukan oleh ".get_name($user_spd_luar_group_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_pjd/detail/'.$id.'>Klik Disini</a><br />';
            switch($type){
                case 'lv1':
                    for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                break;

                case 'lv2':
                for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    $receiver_id = getValue('user_app_lv1', 'users_spd_luar_group', array('id'=>'where/'.$id));
                    $this->approval->not_approve($form, $id, $receiver_id, $approval_status ,$this->detail_email($id));
                    //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan Perjalanan Dinas Dari Atasan', $email_body);
                break;

                case 'lv3':
                for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    for($i=1;$i<3;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_luar_group', array('id'=>'where/'.$id));
                        if(!empty($receiver)):
                            $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                        endif;
                    endfor;
                break;

                case 'hrd':
                for($j=0;$j<sizeof($task_receiver_id);$j++):
                        $this->approval->not_approve($form, $id, $task_receiver_id[$j], $approval_status ,$this->detail_email($id));
                    endfor;
                    for($i=1;$i<4;$i++):
                        $receiver = getValue('user_app_lv'.$i, 'users_spd_luar_group', array('id'=>'where/'.$id));
                        if(!empty($receiver)):
                            $this->approval->not_approve($form, $id, $receiver, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver)))$this->send_email(getEmail($receiver), 'Status Pengajuan Permohonan PJD Dalam Kota Dari Atasan', $email_body);
                        endif;
                    endfor;
                break;
            }
        }
    }

    public function input()
    {
        $this->data['title'] = "Input Perjalanan Dinas";
        $user_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_id = $this->session->userdata('user_id');
        $nik = get_nik($sess_id);
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }elseif(!is_spv($nik)&&!is_admin()&&!is_admin_bagian()){
            return show_error('You must be an administrator to view this page.');
        }else{
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['all_users'] = $this->ion_auth->where('id != ', 1)->users();
            $this->data['selected'] = getValue('id','users', array('id'=>'where/'.$sess_id));
            $this->data['biaya_tambahan'] = getAll('pjd_biaya', array('type_grade' => 'where/0'));
            $this->get_penerima_tugas();
            $this->get_penerima_tugas_satu_bu();
            $this->get_user_atasan();

            $this->data['transportation_list'] = getAll('transportation', array('is_deleted'=>'where/0'))->result();
            $this->data['tl_num_rows'] = getAll('transportation', array('is_deleted'=>'where/0'))->num_rows();
            $this->data['city_list'] = getAll('city', array('is_deleted'=>'where/0'))->result();
            $this->data['cl_num_rows'] = getAll('city', array('is_deleted'=>'where/0'))->num_rows();

            $this->_render_page('form_pjd/input', $this->data);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('destination', 'Tujuan', 'trim|required');
        $this->form_validation->set_rules('title', 'Tanggal Terakhir Cuti', 'trim|required');
        $this->form_validation->set_rules('date_spd_start', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('date_spd_end', 'Tanggal Berangkat', 'trim|required');
        $this->form_validation->set_rules('city_to', 'Kota Tujuan', 'trim|required');
        $this->form_validation->set_rules('city_from', 'Kota Asal', 'trim|required');
        $this->form_validation->set_rules('vehicle', 'Kendaraan', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            //echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
            redirect('form_pjd/input','refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $task_receiver    = implode(',',$this->input->post('peserta'));

            $additional_data = array(
                'task_creator'          => $this->input->post('emp_tc'),
                'title'                 => $this->input->post('title'),
                'destination'           => $this->input->post('destination'),
                'date_spd_start'        => date('Y-m-d', strtotime($this->input->post('date_spd_start'))),
                'date_spd_end'          => date('Y-m-d', strtotime($this->input->post('date_spd_end'))),
                'from_city_id'          => $this->input->post('city_from'),
                'to_city_id'            => $this->input->post('city_to'),
                'transportation_id'     => $this->input->post('vehicle'),
                'user_app_lv1'          => $this->input->post('atasan1'),
                'user_app_lv2'          => $this->input->post('atasan2'),
                'user_app_lv3'          => $this->input->post('atasan3'),
                'created_on'            => date('Y-m-d',strtotime('now')),
                'created_by'            => $sess_id
            );

            $task_creator = $this->input->post('emp_tc');
            $created_by = $sess_nik;
            $biaya_tambahan_id = $this->input->post('biaya_tambahan_id');
            $biaya_tambahan = $this->input->post('jumlah_biaya_tambahan');
            if ($this->form_validation->run() == true && $this->form_spd_luar_group_model->create_($task_receiver,$additional_data))
            {
                $spd_id = $this->db->insert_id();
                $tr = $this->input->post('peserta');
                if(!empty($biaya_tambahan_id)){
                    for($i=0;$i<sizeof($tr);$i++){
                        for($j=0;$j<sizeof($biaya_tambahan_id);$j++):
                            $data = array(
                            'user_spd_luar_group_id' => $spd_id,
                            'user_id' => $tr[$i],
                            'pjd_biaya_id'=>$biaya_tambahan_id[$j],
                            'jumlah_biaya'=>str_replace( ',', '', $biaya_tambahan[$j]),
                            'created_on'            => date('Y-m-d',strtotime('now')),
                            'created_by'            => $sess_id
                            );
                            $this->db->insert('users_spd_luar_group_biaya', $data);
                        endfor;
                    }
                 }

                
                $task_receiver_id = explode(',',$task_receiver);

                $user_app_lv1 = getValue('user_app_lv1', 'users_spd_luar_group', array('id'=>'where/'.$spd_id));
                $subject_email = get_form_no($spd_id).' - Pengajuan Perjalanan Dinas';
                $isi_email = get_name($task_creator).' mengajukan Perjalanan Dinas, untuk melihat detail silakan <a href='.base_url().'form_pjd/submit/'.$spd_id.'>Klik Disini</a><br />';
                if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                $emails = '';
                foreach ($task_receiver_id as $key => $value) {
                    $email = getEmail($value).',';
                    $emails .= $email;
                }
                $msg = get_name($task_creator).' memberikan tugas perjalan dinas, untuk melihat detail silakan <a href='.base_url().'form_pjd/submit/'.$spd_id.'>Klik Disini</a><br />';
                if(!empty($emails))$this->send_email($emails, get_form_no($spd_id).' - Pemberian Tugas Perjalanan Dinas', $msg);
                redirect('form_pjd/input_biaya/'.$spd_id,'refresh');
            }
        }
    }

    function edit_biaya($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['id']=$id;
        $b = $this->data['biaya_pjd'] = $this->db->distinct()->select('users_spd_luar_group_biaya.pjd_biaya_id as biaya_id, pjd_biaya.title as jenis_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('pjd_biaya.type_grade', 0)->get();                  
        $this->data['detail'] = $this->db->distinct()->select('user_id')->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
        $this->data['ci'] = $this;
        $this->data['created_by'] = getValue('created_by', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['task_creator'] = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['spd_start'] = getValue('date_spd_start', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['spd_end'] = getValue('date_spd_end', 'users_spd_luar_group', array('id'=>'where/'.$id));

        $this->_render_page('form_pjd/edit_biaya', $this->data);
    }

    function do_edit($id)
    {
        $data1 = array(
                'date_spd_start'             => date('Y-m-d', strtotime($this->input->post('date_spd_start'))),
                'date_spd_end'              => date('Y-m-d', strtotime($this->input->post('date_spd_end'))),
            );

        $this->db->where('id', $id);
        $this->db->update('users_spd_luar_group', $data1);

        $this->db->where('id', $id);
        $this->db->update('users_spd_luar_group', $data1);

        $biaya_id = $this->input->post('biaya_id');
        $jumlah_biaya = $this->input->post('jumlah_biaya');
        for($i=0;$i<sizeof($biaya_id);$i++):
            $data2 = array('jumlah_biaya' => str_replace( ',', '',$jumlah_biaya[$i]));

        $this->db->where('id', $biaya_id[$i])->update('users_spd_luar_group_biaya', $data2);
        endfor;
        $this->edit_mail($id);
        redirect('form_pjd/submit/'.$id, 'refresh');

    }

    function edit_mail($id){
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = base_url().'form_pjd/submit/'.$id;
        $sess_id = $this->session->userdata('user_id');
        $sender_id = get_nik($sess_id);

        $task_receiver = getValue('task_receiver', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $task_receiver_id = explode(',',$task_receiver);

        for($i=0;$i<sizeof($task_receiver_id);$i++):
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $task_receiver_id[$i],
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Perubahan Data Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender_id).' melakukan perubahan data tugas perjalan dinas , untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        endfor;
        $user_app_lv1 = getValue('user_app_lv1', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $data2 = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $user_app_lv1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Perubahan Data Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender_id).' melakukan perubahan data tugas perjalan dinas , untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
    }

    public function report($id)
    {
        $this->data['title'] = "Daftar Report PJD";
        $user_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $report_id = $this->db->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->get('users_spd_luar_report_group')->row('id');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
             $this->data['file'] = array(
            'name'  => 'file',
            'id'    => 'file',
            'class'    => 'input-file-control',
            );
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group()->num_rows($id);
        
            $receiver = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_receiver');
            $creator = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_creator');
            $user_submit = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('user_submit');
            $this->data['receiver'] = $p = explode(",", $receiver);
            $this->data['receiver_submit'] = explode(",", $user_submit);

            $this->data['sess_id'] = $this->session->userdata('user_id');
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
            

           
            $report = $this->data['report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->num_rows();

            $receiver_id = getValue('task_receiver', 'users_spd_dalam', array('id'=>'where/'.$id));
            if($n_report==0){
                $this->data['is_done'] = '';
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = '';
                $this->data['why'] = '';
                $this->data['where'] = '';
                $this->data['when'] = '';
                $this->data['who'] = '';
                $this->data['how'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = $key->what;
                $this->data['why'] = $key->why;
                $this->data['where'] = $key->where;
                $this->data['when'] = $key->when;
                $this->data['who'] = $key->who;
                $this->data['how'] = $key->how;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}
            
            $this->_render_page('form_pjd/report', $this->data);
        }
    }

    public function report_detail($id, $user_id)
    {
        $this->data['title'] = "Report Detail PJD";
        $report_id = getValue('id','users_spd_luar_report_group', array('user_spd_luar_group_id'=>'where/'.$id, 'created_by'=>'where/'.$user_id));
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['sess_id'] = $this->session->userdata('user_id');
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
            
            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_luar_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['created_by'] = $this->data['user_folder'] = get_nik($report_creator);

           
            $report = $this->data['report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->num_rows();

            $receiver_id = getValue('task_receiver', 'users_spd_dalam', array('id'=>'where/'.$id));
            if($n_report==0){
                $this->data['is_done'] = '';
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = '';
                $this->data['why'] = '';
                $this->data['where'] = '';
                $this->data['when'] = '';
                $this->data['who'] = '';
                $this->data['how'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                //$this->data['tujuan'] = '';
                //$this->data['hasil'] = '';
                $this->data['what'] = $key->what;
                $this->data['why'] = $key->why;
                $this->data['where'] = $key->where;
                $this->data['when'] = $key->when;
                $this->data['who'] = $key->who;
                $this->data['how'] = $key->how;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}

            $this->_render_page('form_pjd/report_detail', $this->data);
        }
    }

    public function add_report($spd_id)
    {
        $this->form_validation->set_rules('what', 'What', 'trim|required');
        $this->form_validation->set_rules('who', 'Who', 'trim|required');
        $this->form_validation->set_rules('where', 'Where', 'trim|required');
        $this->form_validation->set_rules('when', 'When', 'trim|required');
        $this->form_validation->set_rules('why', 'Why', 'trim|required');
        $this->form_validation->set_rules('how', 'How', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_pjd/report/'.$spd_id, 'refresh');
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $user_folder = get_nik($sess_id);
            if(!is_dir('./'.'uploads/pdf/')){
            mkdir('./'.'uploads/pdf/', 0777);
            }
            if(!is_dir('./uploads/pdf/'.$user_folder)){
            mkdir('./uploads/pdf/'.$user_folder, 0777);
            }

                $config =  array(
                  'upload_path'     => "./uploads/pdf/".$user_folder,
                  'allowed_types'   => '*',
                  'overwrite'       => TRUE,
                );    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload())
                {
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'created_on'    => date('Y-m-d',strtotime('now')),
                        'created_by'    => $sess_id
                    );
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'created_on'    => date('Y-m-d',strtotime('now')),
                        'created_by'    => $sess_id
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_luar_group')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_luar_group_model->create_report($spd_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_pjd/report_detail/'.$spd_id.'/'.$sess_id, 'refresh');  
            }          
        }

    }

     public function update_report($report_id, $user_id)
    {
        $spd_id = getValue('user_spd_luar_group_id', 'users_spd_luar_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
        $this->form_validation->set_rules('what', 'What', 'trim|required');
        $this->form_validation->set_rules('who', 'Who', 'trim|required');
        $this->form_validation->set_rules('where', 'Where', 'trim|required');
        $this->form_validation->set_rules('when', 'When', 'trim|required');
        $this->form_validation->set_rules('why', 'Why', 'trim|required');
        $this->form_validation->set_rules('how', 'How', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('form_pjd/report/'.$spd_id, 'refresh');
        }
        else
        {

            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_luar_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['user_folder'] = $user_folder = get_nik($report_creator);
            if(!is_dir('./'.'uploads/pdf/')){
            mkdir('./'.'uploads/pdf/', 0777);
            }
            if(!is_dir('./uploads/pdf/'.$user_folder)){
            mkdir('./uploads/pdf/'.$user_folder, 0777);
            }

                $config =  array(
                  'upload_path'     => "./uploads/pdf/".$user_folder,
                  'allowed_types'   => '*',
                  'overwrite'       => TRUE,
                );    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload())
                {
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'attachment'    => '',
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'edited_on'    => date('Y-m-d',strtotime('now')),
                        'edited_by'    => $this->session->userdata('user_id')
                    );
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                
                    $additional_data = array(
                        'is_done'       => $this->input->post('is_done'),
                        //'description'   => $this->input->post('maksud'),
                        //'result'        => $this->input->post('hasil'),
                        'what' => $this->input->post('what'),
                        'why' => $this->input->post('why'),
                        'where' => $this->input->post('where'),
                        'when' => $this->input->post('when'),
                        'who' => $this->input->post('who'),
                        'how' => $this->input->post('how'),
                        'attachment'    => $file_name,
                        'date_submit'   => date('Y-m-d',strtotime('now')),
                        'edited_on'    => date('Y-m-d',strtotime('now')),
                        'edited_by'    => $this->session->userdata('user_id')
                    );
                }

                $receiver_id = $this->db->where('id', $spd_id)->get('users_spd_luar_group')->row('task_creator');
            if ($this->form_validation->run() == true && $this->form_spd_luar_group_model->update_report($report_id,$additional_data))
            {
                $this->send_spd_report_mail($spd_id, $receiver_id);
                redirect('form_pjd/report_detail/'.$spd_id.'/'.$user_id, 'refresh');  
            }          
        }

    }

    function send_spd_mail($spd_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $sender_id = getValue('task_creator', 'users_spd_luar_group', array('id' => 'where/'.$spd_id));
        $task_receiver = getValue('task_receiver', 'users_spd_luar_group', array('id' => 'where/'.$spd_id));
        $task_receiver_id = explode(',',$task_receiver);
        $url = base_url().'form_pjd/submit/'.$spd_id;

        for($i=0;$i<sizeof($task_receiver_id);$i++):
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $task_receiver_id[$i],
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => get_form_no($spd_id).'-Pemberian Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender_id).' memberikan tugas perjalan dinas , untuk melakukan konfirmasi silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        endfor;
    }

    function send_spd_submitted_mail($spd_id, $receiver_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $url = base_url().'form_pjd/submit/'.$spd_id;
        $sender = (!empty(get_nik($this->session->userdata('user_id')))) ? get_nik($this->session->userdata('user_id')) : $this->session->userdata('user_id');
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Persetujuan Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender).' telah menyetujui tugas perjalan dinas yang anda berikan, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>',//.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
    }

    function send_spd_canceled_mail($spd_id, $sender_id, $task_receiver_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $url = base_url().'form_pjd/submit/'.$spd_id;
        $receiver_id = explode(',',$task_receiver_id);
        for($i=0;$i<sizeof($task_receiver_id);$i++):
        $data = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id[$i],
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pembatalan Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender_id).' membatalkan tugas perjalan dinas , untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email($spd_id),
                    'is_read' => 0,
                );
            $this->db->insert('email', $data);
        endfor;
    }
    
    function send_spd_report_mail($spd_id, $receiver_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $sess_id = $this->session->userdata('user_id');
        $sender = (!empty(get_nik($sess_id))) ? get_nik($sess_id) : $sess_id;
        $url = base_url().'form_pjd/report_detail/'.$spd_id.'/'.$sess_id;
        $data = array(
                    'sender_id' => $sender,
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => get_form_no($spd_id).' - Laporan Tugas Perjalanan Dinas',
                    'email_body' => get_name($sender).' telah membuat laporan perjalanan dinas, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$this->detail_email_report($spd_id, $sess_id),
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
        else
        {
        $this->data['id'] = $id;
        $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
        $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
        $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
    
        
        $receiver = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_receiver');
        $creator = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_creator');
        $user_submit = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('user_submit');
        $this->data['biaya_pjd_group'] = getAll('users_spd_luar_group_biaya', array('user_spd_luar_group_id'=>'where/'.$id));
        $this->data['biaya_tambahan'] = getAll('pjd_biaya', array('type_grade' => 'where/0'));
        $this->data['receiver'] = $p = explode(",", $receiver);
        $this->data['receiver_submit'] = explode(",", $user_submit);
        $this->data['id']=$id;
        $b = $this->data['biaya_pjd'] = $this->db->distinct()->select('users_spd_luar_group_biaya.pjd_biaya_id as biaya_id, pjd_biaya.title as jenis_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('pjd_biaya.type_grade', 0)->get();//print_mz($this->data['biaya_pjd']->result());                   
        $this->data['detail'] = $this->db->distinct()->select('user_id')->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
        $this->data['ci'] = $this;
        $creator = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['form_id'] = 'PJD-LKG';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $a = strtotime(getValue('date_spd_end', 'users_spd_luar_group', array('id'=>'where/'.$id)));
        $b = strtotime(getValue('date_spd_start', 'users_spd_luar_group', array('id'=>'where/'.$id)));

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        $biaya_fix_1 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 1 or pjd_biaya_id=4 or pjd_biaya_id=7 or pjd_biaya_id=10 or pjd_biaya_id=13 or pjd_biaya_id=19 or pjd_biaya_id=16)) AS uang_makan", FALSE)->get()->row_array();
        $this->data['uang_makan'] = number_format($biaya_fix_1['uang_makan']*$jml_pjd);
        $biaya_fix_2 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 2 or pjd_biaya_id=5 or pjd_biaya_id=8 or pjd_biaya_id=11 or pjd_biaya_id=14 or pjd_biaya_id=20 or pjd_biaya_id=17)) AS uang_saku", FALSE)->get()->row_array();
        $this->data['uang_saku'] = number_format($biaya_fix_2['uang_saku']*$jml_pjd);
        $biaya_fix_3 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 3 or pjd_biaya_id=6 or pjd_biaya_id=9 or pjd_biaya_id=12 or pjd_biaya_id=15 or pjd_biaya_id=21 or pjd_biaya_id=18)) AS hotel", FALSE)->get()->row_array();
        $this->data['hotel'] = number_format($biaya_fix_3['hotel']*$jml_pjd);
        

            return $this->load->view('form_pjd/spd_luar_group_mail', $this->data, TRUE);
        }
    } 

    function input_biaya($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $this->data['id']=$id;
        $b = $this->data['biaya_pjd'] = $this->db->distinct()->select('users_spd_luar_group_biaya.pjd_biaya_id as biaya_id, pjd_biaya.title as jenis_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('pjd_biaya.type_grade', 0)->get();                  
        $this->data['detail'] = $this->db->distinct()->select('user_id')->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
        $this->data['ci'] = $this;
        $this->_render_page('form_pjd/input_biaya', $this->data);
    }

    function update_biaya($id)
    {
        $spd_id = $id;
        $biaya_fix_id = $this->input->post('biaya_fix_id');
        $biaya_tambahan_id = $this->input->post('biaya_tambahan_id');
        $biaya_fix = $this->input->post('biaya_fix');
        $biaya_tambahan = $this->input->post('biaya_tambahan');
        $tr = $this->input->post('emp');
        for($i=0;$i<sizeof($biaya_fix_id);$i++):
            $data = array(
            'user_spd_luar_group_id' => $spd_id,
            'user_id' => $tr[$i],
            'pjd_biaya_id'=>$biaya_fix_id[$i],
            'jumlah_biaya'=>str_replace( ',', '', $biaya_fix[$i]),
            'created_on'            => date('Y-m-d',strtotime('now')),
            'created_by'            => $this->session->userdata('user_id'),
            );
            $this->db->insert('users_spd_luar_group_biaya', $data);
        endfor;
            for($j=0;$j<sizeof($biaya_tambahan_id);$j++):
            $data = array(
            'jumlah_biaya'=>str_replace( ',', '', $biaya_tambahan[$j]),
            'edited_on'            => date('Y-m-d',strtotime('now')),
            'edited_by'            => $this->session->userdata('user_id'),
            );

            $this->db->where('id', $biaya_tambahan_id[$j])->update('users_spd_luar_group_biaya', $data);
        endfor;

        $task_receiver = getValue('task_receiver','users_spd_luar_group', array('id'=>'where/'.$id));
        $task_creator = getValue('task_creator','users_spd_luar_group', array('id'=>'where/'.$id));
        $created_by = getValue('created_by','users_spd_luar_group', array('id'=>'where/'.$id));
        $task_receiver_id = explode(',',$task_receiver);

        $this->send_spd_mail($spd_id);

        //if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), 'Pengajuan Perjalanan Dinas (Group)', $isi_email);
        $user_app_lv1 = getValue('user_app_lv1', 'users_spd_luar_group', array('id'=>'where/'.$spd_id));
        $subject_email = get_form_no($spd_id).' - Pengajuan Perjalanan Dinas';
        $isi_email = get_name($task_creator).' mengajukan Perjalanan Dinas, untuk melihat detail silakan <a href='.base_url().'form_pjd/submit/'.$spd_id.'>Klik Disini</a><br />';

        if($task_creator!==$created_by):
            $this->approval->by_admin('spd_luar_group', $spd_id, $created_by, $task_creator, $this->detail_email($spd_id));
        endif;
         if(!empty($user_app_lv1)):
            //if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
            $this->approval->request('lv1', 'spd_luar_group', $spd_id, $task_creator, $this->detail_email($spd_id));
         else:
            if(!empty(getEmail($this->approval->approver('dinas'))))$this->send_email(getEmail($this->approval->approver('dinas')), $subject_email, $isi_email);
            $this->approval->request('hrd', 'spd_luar_group', $spd_id, $task_creator, $this->detail_email($spd_id));
         endif;

        redirect('form_pjd', 'refresh');
    }

    function detail_email_report($id, $user_id)
    {
        $report_id = getValue('id','users_spd_luar_report_group', array('user_spd_luar_group_id'=>'where/'.$id, 'created_by'=>'where/'.$user_id));
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {

            $this->data['sess_id'] = $this->session->userdata('user_id');
            $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
            $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
            
            $this->data['report_creator'] = $report_creator = getValue('created_by','users_spd_luar_report_group', array('id'=>'where/'.$report_id, 'created_by'=>'where/'.$user_id));
            $this->data['user_folder'] = get_nik($report_creator);

           
            $report = $this->data['report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->result();
            $n_report = $this->data['n_report'] = $this->form_spd_luar_group_model->where('users_spd_luar_report_group.user_spd_luar_group_id', $id)->form_spd_luar_report_group($report_id, $user_id)->num_rows();

            if($n_report==0){
                $this->data['is_done'] = '';
                $this->data['tujuan'] = '';
                $this->data['hasil'] = '';
                $this->data['attachment'] = '-';
                $this->data['disabled'] = '';

            
            }else{
                foreach ($report as $key) {
                $this->data['id_report'] = $key->id;
                $this->data['is_done'] = $key->is_done;    
                $this->data['tujuan'] = $key->description;
                $this->data['hasil'] = $key->result;
                $this->data['attachment'] = (!empty($key->attachment)) ? $key->attachment : 2 ;
                $this->data['created_on'] = $key->created_on;
                $this->data['created_by'] = get_nik($key->created_by);
                $this->data['disabled'] = 'disabled='.'"disabled"';
            }}

            return $this->load->view('form_pjd/spd_luar_report_group_mail', $this->data, TRUE);
        }
    }

    function get_biaya_pjd($id)
    {
        $grade = get_grade($id);
            $pos_group = get_pos_group($id);

            if($grade == 'G08' && $pos_group == 'AMD')
            {
                return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/7'));
            }elseif($grade == 'G08' && $pos_group == 'MGR')
            {
               return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/6'));
            }elseif($grade == 'G08' && $pos_group == 'KACAB'){
                return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/5'));
            }elseif($grade == 'G07'){
               return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/4'));
            }elseif($grade == 'G06' || $grade == 'G05'){
                return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/3'));
            }elseif($grade == 'G04' || $grade == 'G03'){
                return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/2'));
            }elseif($grade == 'G02' || $grade == 'G01'){
                return $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/1'));
            }
    } 

    function get_penerima_tugas()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/bawahan_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas'] = 'Tidak ada karyawan dengan departement yang sama';
            }
    }

    function get_penerima_tugas_satu_bu()
    {
            $user_id = $this->session->userdata('user_id');
            $url_org = get_api_key().'users/emp_satu_bu/EMPLID/'.get_nik($user_id).'/format/json';
            $headers_org = get_headers($url_org);
            $response = substr($headers_org[0], 9, 3);
            if ($response != "404") {
            $get_penerima_tugas = file_get_contents($url_org);
            $penerima_tugas = json_decode($get_penerima_tugas, true);
            return $this->data['penerima_tugas_satu_bu'] = $penerima_tugas;
            }else{
             return $this->data['penerima_tugas_satu_bu'] = 'Tidak ada karyawan dengan Bussiness Unit yang sama';
            }
    }
    
    function pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['title'] = $title = get_form_no($id);
        $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
        $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
        $data_result = $this->data['task_detail'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->result();
        $this->data['td_num_rows'] = $this->form_spd_luar_group_model->where('users_spd_luar_group.id',$id)->form_spd_luar_group($id)->num_rows();
    
        
        $receiver = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_receiver');
        $receiver_size = explode(',', $receiver);$receiver_size = sizeof($receiver_size); 
        $this->data['biaya_single'] = getJoin('users_spd_luar_group_biaya','pjd_biaya','users_spd_luar_group_biaya.pjd_biaya_id = pjd_biaya.id','left', 'users_spd_luar_group_biaya.*, pjd_biaya.title as jenis_biaya, pjd_biaya.type_grade as type', array('user_spd_luar_group_id'=>'where/'.$id, 'user_id'=>'where/'.$receiver, 'pjd_biaya_id'=>'order/asc'));
        
        $creator = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('task_creator');
        $user_submit = getAll('users_spd_luar_group', array('id'=>'where/'.$id))->row('user_submit');
        $this->data['biaya_pjd_group'] = getAll('users_spd_luar_group_biaya', array('user_spd_luar_group_id'=>'where/'.$id));
        $this->data['biaya_tambahan'] = getAll('pjd_biaya', array('type_grade' => 'where/0'));
        $this->data['receiver'] = $p = explode(",", $receiver);
        $this->data['receiver_submit'] = explode(",", $user_submit);
        $this->data['id']=$id;
        $b = $this->data['biaya_pjd'] = $this->db->distinct()->select('users_spd_luar_group_biaya.pjd_biaya_id as biaya_id, pjd_biaya.title as jenis_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('pjd_biaya.type_grade', 0)->get();//print_mz($this->data['biaya_pjd']->result());                   
        $this->data['detail'] = $this->db->distinct()->select('user_id')->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
        $this->data['ci'] = $this;
        $creator = getValue('task_creator', 'users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['form_id'] = 'PJD';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_spd_luar_group', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $a = strtotime(getValue('date_spd_end', 'users_spd_luar_group', array('id'=>'where/'.$id)));
        $b = strtotime(getValue('date_spd_start', 'users_spd_luar_group', array('id'=>'where/'.$id)));

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        $biaya_fix_1 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 1 or pjd_biaya_id=4 or pjd_biaya_id=7 or pjd_biaya_id=10 or pjd_biaya_id=13 or pjd_biaya_id=19 or pjd_biaya_id=16)) AS uang_makan", FALSE)->get()->row_array();
        $this->data['uang_makan'] = number_format($biaya_fix_1['uang_makan']*$jml_pjd);
        $biaya_fix_2 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 2 or pjd_biaya_id=5 or pjd_biaya_id=8 or pjd_biaya_id=11 or pjd_biaya_id=14 or pjd_biaya_id=20 or pjd_biaya_id=17)) AS uang_saku", FALSE)->get()->row_array();
        $this->data['uang_saku'] = number_format($biaya_fix_2['uang_saku']*$jml_pjd);
        $biaya_fix_3 = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and (pjd_biaya_id = 3 or pjd_biaya_id=6 or pjd_biaya_id=9 or pjd_biaya_id=12 or pjd_biaya_id=15 or pjd_biaya_id=21 or pjd_biaya_id=18)) AS hotel", FALSE)->get()->row_array();
        $this->data['hotel'] = number_format($biaya_fix_3['hotel']*$jml_pjd);
        $this->load->library('mpdf60/mpdf');
        $html = ($receiver_size > 1) ? $this->load->view('spd_luar_group_pdf', $this->data, true) : $this->load->view('pjd_pdf', $this->data, true) ; 
        $orientation = ($receiver_size>1) ? 'L' : 'P';
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage($orientation, // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            10, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
    $this->mpdf->WriteHTML($html);
    $this->mpdf->Output($id.'-'.get_form_no($id).'pdf', 'I');
        
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('form_pjd/index')))
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
                elseif(in_array($view, array('form_pjd/input',
                                             'form_pjd/input_biaya',
                                             'form_pjd/edit_biaya'
                                             )))
                {

                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');
                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('jquery.maskMoney.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_spd_luar_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');

                }elseif(in_array($view, array('form_pjd/submit' )))
                {

                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('purl.js');

                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('form_spd_luar.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('approval_img.css');

                }elseif(in_array($view, array('form_pjd/report',
                                             'form_pjd/report_detail' )))
                {

                    $this->template->set_layout('default');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('form_spd_dalam_report.js');
                    
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

/* End of file form_spd_luar_group.php */
/* Location: ./application/modules/form_pjd/controllers/form_spd_luar_group.php */
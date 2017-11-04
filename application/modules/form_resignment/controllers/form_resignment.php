<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_resignment extends MX_Controller {

  public $data;
  var $form_name = 'resignment';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_resignment/form_resignment_model','main');
    
        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = 'Form Pengunduran Diri';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sess_id= $this->data['sess_id'] = $this->session->userdata('user_id');
            $this->data['sess_nik'] = $sess_nik = get_nik($sess_id);
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/resign'));
            $this->data['form_name'] = 'resignment';
            $this->data['form'] = 'resignment';
            $this->data['is_admin'] = is_admin();
            $this->_render_page('form_resignment/index', $this->data);
        }
    }

    function ajax_list($f){
        $list = $this->main->get_datatables($f);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_$this->form_name/detail/".$r->id; 
           $print = base_url()."form_$this->form_name/form_$this->form_name"."_pdf/".$r->id; 
           $delete = (($r->app_status_id_lv1 == 0 && $r->created_by == sessId()) || is_admin()) ? '<button onclick="showModal('.$r->id.')" class="btn btn-sm btn-danger" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : '';

            //APPROVAL
            if(!empty($r->user_app_lv1)){
                $status1 = ($r->app_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Langsung'></i>";
            }
            if(!empty($r->user_app_lv2)){
                $status2 = ($r->app_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Tidak Langsung'></i>";
            }
            if(!empty($r->user_app_lv3)){
                $status3 = ($r->app_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Lainnya'></i>";
            }
            
            $statushrd = ($r->app_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->nik.'</a>';
            $row[] = "<a href=$detail>".$r->username.'</a>';
            $row[] = dateIndo($r->date_resign);
            $row[] = dateIndo($r->created_on);
            $row[] = $status1;
            $row[] = $status2;
            $row[] = $status3;
            $row[] = $statushrd;
            $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
                      <a class='btn btn-sm btn-light-azure' target='_blank' href=$print title='Klik icon ini untuk mencetak form pengajuan'><i class='icon-print'></i></a>
                      ".$delete;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main->count_all($f),
                        "recordsFiltered" => $this->main->count_filtered($f),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function keywords(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ftitle_post = (strlen($this->input->post('title')) > 0) ? strtolower(url_title($this->input->post('title'),'_')) : "" ;

            redirect('form_resignment/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function input()
    {
        $this->data['title'] = 'Input - Form Pengunduran Diri';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['sess_id'] = $sess_id = $this->session->userdata('user_id'); 
        $this->data['sess_nik'] = sessNik();

        if(is_admin())$this->data['all_users'] = getAll('users', array('active'=>'where/1', 'username'=>'order/asc'), array('!=id'=>'1'));
        //$this->get_user_atasan();
        $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted'=>'where/0'));

        $this->data['phone'] = getValue('phone', 'users', array('id'=>'where/'.$sess_id));

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
                $sess_id = $this->session->userdata('user_id');
                $data = array(
                    'id_comp_session' => 1,
                    'date_resign' => date('Y-m-d',strtotime($this->input->post('date_resign'))),
                    'alasan'        => $this->input->post('alasan'),
                    'phone'       => $this->input->post('phone'),
                    'user_app_lv1'          => $this->input->post('atasan1'),
                    'user_app_lv2'          => $this->input->post('atasan2'),
                    'user_app_lv3'          => $this->input->post('atasan3'),
                    'created_on'            => date('Y-m-d',strtotime('now')),
                    'created_by'            => $sess_id,
                    );

                if ($this->form_validation->run() == true && $this->main->create_($user_id, $data))
                    {
                     $resignment_id = $this->db->insert_id();
                     $subject_email = get_form_no($resignment_id).'-Pengajuan Permohonan Pengunduran Diri';
                     $isi_email = get_name($user_id).' mengajukan Permohonan Pengunduran Diri, untuk melihat detail silakan <a href='.base_url().'form_resignment/detail/'.$resignment_id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_resignment/detail/'.$resignment_id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
                    
                     $user_app_lv1 = getValue('user_app_lv1', 'users_resignment', array('id'=>'where/'.$resignment_id));
                     if($user_id!==$sess_id):
                     $this->approval->by_admin('resignment', $resignment_id, $sess_id, $user_id, $this->detail_email($resignment_id));
                     endif;
                     if(!empty($user_app_lv1)):
                        if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                        $this->approval->request('lv1', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     else:
                        if(!empty(getEmail($this->approval->approver('resignment'))))$this->send_email(getEmail($this->approval->approver('resignment')), $subject_email, $isi_email);
                        $this->approval->request('hrd', 'resignment', $resignment_id, $user_id, $this->detail_email($resignment_id));
                     endif;

                     $this->notif_payroll($resignment_id);
                     redirect('form_resignment', 'refresh');
                     //echo json_encode(array('st' =>1));     
                    }
            }
        }
    }

    function notif_payroll($id)
    {
        $sess_id = $this->session->userdata('user_id');
        $admin_payroll = $this->db->where('group_id',10)->get('users_groups')->result_array('user_id');
        $msg = 'Dear Admin payroll,<br/><p>'.get_name($sess_id).' mengajukan Permohonan Pengunduran Diri, untuk melihat detail silakan <a href='.base_url().'form_resignment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_resignment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. </p>';
        for($i=0;$i<sizeof($admin_payroll);$i++):
        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => get_nik($admin_payroll[$i]['user_id']),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Pengajuan Pengunduran Diri Karyawan',
                'email_body' =>$msg.$this->detail_email($id),
                'is_read' => 0,
            );
        $this->db->insert('email', $data);
        if(!empty(getEmail(get_nik($admin_payroll[$i]['user_id']))))$this->send_email(getEmail(get_nik($admin_payroll[$i]['user_id'])), get_form_no($id).'-Pengajuan Pengunduran Diri Karyawan', $msg);
        endfor;
    }

    function detail($id, $lv = null)
    {
        $this->data['title'] = 'Detail - Form Pengunduran Diri';
        if(!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            redirect('auth/login', 'refresh');
        }
        $this->data['id'] = $id;
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
        $bu = get_user_buid($sess_nik);
        if(!is_admin()&&!is_user_logged($sess_nik,$id,'users_resignment')&&!is_user_app_lv1($sess_nik,$id,'users_resignment')&&!is_user_app_lv2($sess_nik,$id,'users_resignment')&&!is_user_app_lv3($sess_nik,$id,'users_resignment')&&!is_hrd_cabang($bu)&&!is_hrd_pusat($sess_nik,10)&&!is_cc_notif($sess_nik,$bu,10)&&!is_cc_tambahan($sess_nik,'P0081')){
            return show_error('Anda tidak dapat mengakses halaman ini.');
        }else{
            $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
            $user_nik = $this->data['user_nik'] = get_nik($user_id);
            $this->data['row'] = $this->main->detail($id)->row();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $this->data['alasan_resign'] = getAll('alasan_resign', array('is_deleted'=>'where/0'));
            $alasan = explode(',', getValue('alasan_resign_id', 'users_resignment_wawancara', array('user_resignment_id' => 'where/'.$id)));
            $this->data['alasan'] = $this->main->get_alasan($alasan);
            $buid = get_user_buid($user_nik);
            $this->data['hrd_list'] = $this->get_hrd($buid);
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->data['approved'] = assets_url('img/approved_stamp.png');
            $this->data['rejected'] = assets_url('img/rejected_stamp.png');
            $this->data['pending'] = assets_url('img/pending_stamp.png');
            if($lv != null){
                $app = $this->load->view('form_'.$this->form_name.'/'.$lv, $this->data, true);
                $note = $this->load->view('form_'.$this->form_name.'/note', $this->data, true);
                echo json_encode(array('app'=>$app, 'note'=>$note));
            }else{
                $this->_render_page('form_'.$this->form_name.'/detail', $this->data);
            }
        }
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

                    if ($this->form_validation->run() == true && $this->main->create_($user_id, $data))
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

    function do_approve($id, $type)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $is_app = getValue('is_app_'.$type, 'users_resignment', array('id'=>'where/'.$id));
            $num_rows = getAll('users_resignment_wawancara', array('user_resignment_id'=>'where/'.$id))->num_rows();
            $user_resignment_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
            $date_resignment = getValue('date_resign', 'users_resignment', array('id'=>'where/'.$id));
            $user_exit_id_num_rows = getAll('users_exit', array('user_id'=>'where/'.$user_resignment_id))->num_rows();
            
            $user_id = get_nik($this->session->userdata('user_id'));
            $date_now = date('Y-m-d');
            if($type == 'hrd'):
                $data1 = array(
                'user_resignment_id' => $id,
                'alasan_resign_id'   => implode(',',$this->input->post('alasan_resign_id')),
                'desc_resign'        => $this->input->post('desc_resign'),
                'procedure_resign'   => $this->input->post('procedure_resign'),
                'kepuasan_resign'    => $this->input->post('kepuasan_resign'),
                'saran_resign'       => $this->input->post('saran_resign'),
                'rework_resign'      => $this->input->post('rework_resign'),
                );
                $data2 = array(
                'is_app_'.$type => 1, 
                'app_status_id_'.$type => $this->input->post('app_status_'.$type),
                'user_app_'.$type => $user_id, 
                'date_app_'.$type => $date_now,
                'note_'.$type => $this->input->post('note_'.$type),
                );
                if($num_rows>0){
                    $this->db->where('user_resignment_id', $id)->update('users_resignment_wawancara',$data1);
                    if(!empty(get_superior($user_resignment_id))):
                            $this->approval->request_exit($user_resignment_id);
                        endif;
                }else{
                    if(!empty(get_superior($user_resignment_id))):
                            $this->approval->request_exit($user_resignment_id);
                        endif;
                    $this->db->insert('users_resignment_wawancara', $data1);
                    if($user_exit_id_num_rows>0):
                        $data_exit = array(
                            'date_exit' => $date_resignment,
                            'exit_type_id' => 3,
                            'is_resignment' => 1 
                            );
                        if(!empty(get_superior($user_resignment_id))){
                            $this->approval->request_exit($user_resignment_id);
                        }
                        $this->db->where('user_id', $user_resignment_id)->update('users_exit', $data_exit);
                    else:
                        $data_exit = array(
                            'id_comp_session' => 1,
                            'user_id' => $user_resignment_id,
                            'date_exit' => $date_resignment,
                            'exit_type_id' => 3,
                            'is_resignment' => 1,
                            );
                        $this->db->insert('users_exit', $data_exit);
                        $exit_id = $this->db->insert_id();
                        if(!empty(get_superior($user_resignment_id))){
                            $this->approval->request_exit($user_resignment_id);
                        }
                    endif;
                }
                $this->main->update($id,$data2);
                
                //kirim notif ke pak wisnu untuk update approval di HRD setelah melakukan wawancara
                if($user_id != 'P0227') 
                {
                    $url = base_url().'form_resignment/detail/'.$id;
                    $isi_email = get_name($this->session->userdata('user_id'))."telah selesai melakukan wawancara, silakan ubah wawancara untuk melihat detail wawancara dan merubah nama approval atas nama anda. untuk melihat detail silakan <a class='klikmail' href=$url>Klik Disini</a> atau <a href='http://123.231.241.12/hris_client/form_resignment/detail/".$id."'>Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />";

                    $pewawancara = 'P0227';
                    $data_wawancara = array(
                                'sender_id' => get_nik($this->session->userdata('user_id')),
                                'receiver_id' => $pewawancara,
                                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                                'subject' => get_name($this->session->userdata('user_id')).' Telah melakukan Wawancara Pengunduran Diri',
                                'email_body' => $isi_email.$this->detail_email($id),
                                'is_read' => 0,
                            );
                    $this->db->insert('email', $data_wawancara);
                    (!empty(getEmail($pewawancara))) ? $this->send_email(getEmail($pewawancara), get_form_no($id).' - Wawancara pengunduran diri telah selesai', $isi_email) : '';
                }else{
                    
                }
                
                

            else:
                $data = array(
                'is_app_'.$type => 1, 
                'app_status_id_'.$type => $this->input->post('app_status_'.$type),
                'user_app_'.$type => $user_id, 
                'date_app_'.$type => $date_now,
                'note_'.$type => $this->input->post('note_'.$type),
                );
                $this->main->update($id,$data);
            endif;
            redirect('form_resignment/detail/'.$id, 'refresh');
        }
    }

    function send_notif($id, $type){
        $user_id = sessNik();
        $is_app = 0;
        $is_app = getValue('is_app_'.$type, 'users_resignment', array('id'=>'where/'.$id));
        $num_rows = getAll('users_resignment_wawancara', array('user_resignment_id'=>'where/'.$id))->num_rows();
        $user_resignment_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $date_resignment = getValue('date_resign', 'users_resignment', array('id'=>'where/'.$id));
        $user_exit_id_num_rows = getAll('users_exit', array('user_id'=>'where/'.$user_resignment_id))->num_rows();
        $approval_status = getValue('app_status_id_'.$type, 'users_resignment', array('id'=>'where/'.$id));
        $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
        $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Pengunduran Diri dari Atasan';
        $subject_email_request = get_form_no($id).'-Pengajuan Pengunduran Diri';
        $isi_email = 'Status pengajuan Pengunduran Diri anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_resignment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_resignment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
        $isi_email_request = get_name($user_resignment_id).' mengajukan Permohonan Pengunduran Diri, untuk melihat detail silakan <a href='.base_url().'form_resignment/detail/'.$id.'>Klik Disini</a> atau <a href="http://123.231.241.12/hris_client/form_resignment/detail/'.$id.'">Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />';
        
        if($is_app==0){
            $this->approval->approve('resignment', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_resignment_id)))$this->send_email(getEmail($user_resignment_id), $subject_email, $isi_email);
        }else{
            $this->approval->update_approve('resignment', $id, $approval_status, $this->detail_email($id));
            if(!empty(getEmail($user_resignment_id)))$this->send_email(getEmail($user_resignment_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Permohonan Pengunduran Diri dari Atasan', $isi_email);
        }
        if($type !== 'hrd'  && $approval_status == 1){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_resignment', array('id'=>'where/'.$id)):0;
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                $this->approval->request($lv_app, 'resignment', $id, $user_resignment_id, $this->detail_email($id));
             else:
                if(!empty(getEmail($this->approval->approver('resignment', $user_id))))$this->send_email(getEmail($this->approval->approver('resignment', $user_id)), $subject_email_request, $isi_email_request);
                $this->approval->request('hrd', 'resignment', $id, $user_resignment_id, $this->detail_email($id));
             endif;
        }

        if($type == 'hrd' && $approval_status == 1){
            $this->send_notif_tambahan($id, 'resignment');
        }
    }
    
    function kirim_undangan($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $is_update = getValue('is_invited', 'users_resignment', array('id'=>'where/'.$id));
        $undangan = array('is_invited' => 1,
                          'date_invitation' => date('Y-m-d', strtotime($this->input->post('date_invited'))),
                          'time_invitation' => $this->input->post('time_invited'),
                          'nama_pewawancara' => $this->input->post('nama_pewawancara'),
                          'telp_pewawancara' => $this->input->post('telp_pewawancara'),
                          'note_invitation' => $this->input->post('note_invited'),
         );

        $this->db->where('id', $id)->update('users_resignment', $undangan);

        $sess_id = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $url = base_url().'form_resignment/detail/'.$id;
        $isi_email = ($is_update == 0) ? get_name($sess_id)." mengundang anda untuk melakukan wawancara pengajuan resign yang telah anda ajukan, untuk melihat detail silakan <a class='klikmail' href=$url>Klik Disini</a> atau <a href='http://123.231.241.12/hris_client/form_resignment/detail/".$id."'>Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />"
                                       : get_name($sess_id)." melakukan perubahan jadwal wawancara pengajuan resign yang telah anda ajukan, untuk melihat detail silakan <a class='klikmail' href=$url>Klik Disini</a> atau <a href='http://123.231.241.12/hris_client/form_resignment/detail/".$id."'>Klik Disini</a> jika anda akan mengakses diluar jaringan perusahaan. <br />";
        $subject = ($is_update == 0) ? '' : 'Perubahan Jadwal ';
        $data = array(
                    'sender_id' => get_nik($sess_id),
                    'receiver_id' => get_nik($user_id),
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => $subject.'Undangan Wawancara Pengunduran Diri',
                    'email_body' => $isi_email.$this->detail_email($id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
       if(!empty(getEmail(get_nik($user_id))))$this->send_email(getEmail($user_id), get_form_no($id).'- Undangan Wawancara Resignment', $isi_email);

        //$pewawancara = get_value('nama_pewawancara', 'users_resignment', array('id'=>'where/'.$id));
        $pewawancara = $this->input->post('nama_pewawancara');
        $data = array(
                    'sender_id' => get_nik($sess_id),
                    'receiver_id' => $pewawancara,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => $subject.'Undangan Melakukan Wawancara Pengunduran Diri',
                    'email_body' => $isi_email.$this->detail_email($id),
                    'is_read' => 0,
                );
        $this->db->insert('email', $data);
        if(!empty(getEmail($pewawancara)))$this->send_email(getEmail($pewawancara), get_form_no($id).'- Undangan Melakukan Wawancara Pengunduran Diri', $isi_email);
        
    }

    function detail_email($id)
    {
        return true;
    }

    public function get_hrd($buid)
    {
        if($buid == '51'){
            $buid = '50';
        }
        $url = get_api_key().'users/hrd_list/BUID/'.$buid.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_atasan = file_get_contents($url);
            $hrd = json_decode($get_atasan, true);
            return $hrd;
        }else{
            return false;
        }
    }

    function get_hrd_phone()
    {
        $nik = $this->input->post('id');
        if($nik == '0'){
        echo '-';
        }

        if(!empty($nik)){
            $url = get_api_key().'users/employement/EMPLID/'.$nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                echo  $user_info['CELLULARPHONE'];
            } else {
                echo '0';
            }
        }else{
            echo '0';
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
        $form_resignment = $this->data['form_resignment'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $creator = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $creator = get_nik($creator);
        $this->data['form_id'] = 'RES';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_resignment', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('resignment_pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            0, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    function pdf_blank($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
        $user_id = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $form_resignment = $this->data['form_resignment'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();

        $this->data['id'] = $id;
        $title = $this->data['title'] = 'Form Karyawan Keluar-'.get_name($user_id);
        $creator = getValue('user_id', 'users_resignment', array('id'=>'where/'.$id));
        $creator = get_nik($creator);
        $this->data['form_id'] = 'RES';
        $this->data['bu'] = get_user_buid($creator);
        $loc_id = get_user_locationid($creator);
        $this->data['location'] = get_user_location($loc_id);
        $date = getValue('created_on','users_resignment', array('id'=>'where/'.$id));
        $this->data['m'] = date('m', strtotime($date));
        $this->data['y'] = date('Y', strtotime($date));
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view('pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            0, // margin top
            10, // margin bottom
            10, // margin header
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output('form_template-resignment.pdf', 'I');
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
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');

                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('datatables.min.css');
                    
                }
                elseif(in_array($view, array('form_resignment/input')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_resignment.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                }elseif(in_array($view, array('form_resignment/detail')))
                {

                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('core.js');

                    $this->template->add_js('respond.min.js');

                    $this->template->add_js('jquery.bootstrap.wizard.min.js');
                    $this->template->add_js('jquery.validate.min.js');
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('bootstrap-timepicker.js');
                    $this->template->add_js('form_resignment_detail.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_approval.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    $this->template->add_css('bootstrap-timepicker.css');
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
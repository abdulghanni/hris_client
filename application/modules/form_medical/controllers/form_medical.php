<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_medical extends MX_Controller {

	public $data;
    var $form_name = 'medical';

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_medical/form_medical_model','main');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {   
        $this->data['title'] = ucfirst($this->form_name);
        $this->data['form_name'] = $this->form_name;
        $this->data['form'] = $this->form_name;
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->_render_page('form_medical/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->main->get_datatables($f);//lastq();//print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_".$this->form_name."/detail/".$r->id; 
           $print = base_url()."form_".$this->form_name."/form_".$this->form_name."_pdf/".$r->id; 
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
            


            //$statushrd = ($r->app_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->app_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->app_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $statushrd = ($r->is_app_hrd == 1) ? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>";

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->nik.'</a>';
            $row[] = "<a href=$detail>".$r->username.'</a>';
            $row[] = dateIndo($r->created_on);
            $row[] = get_user_organization($r->nik);
            $row[] = $status1;
            $row[] = $status2;
            $row[] = $status3;
            $row[] = $statushrd;
            //$row[] = $statushrd;
            $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='Klik icon ini untuk melihat detail'><i class='icon-info'></i></a>
                      <a class='btn btn-sm btn-light-azure' href=$print title='Klik icon ini untuk mencetak form pengajuan'><i class='icon-print'></i></a>
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

    function input()
    {
        $this->data['title'] = 'Input - Kesehatan';
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
                $subject_email = get_form_no($last_medical_id).'Pengajuan Rekapitulasi Rawat Jalan/Inap';
                $isi_email = get_name($user_id).' mengajukan Rekapitulasi Rawat Jalan/Inap, untuk melihat detail silakan <a href='.base_url().'form_medical/detail/'.$last_medical_id.'>Klik Disini</a><br />';

                if($user_id!==$sess_id):
                     $this->approval->by_admin('medical', $last_medical_id, $sess_id, $user_id, $this->detail_email($last_medical_id));
                     endif;
                if(!empty($user_app_lv1)):
                     if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                     $this->approval->request('lv1', 'medical', $last_medical_id, $user_id, $this->detail_email($last_medical_id));
                else:
                     if(!empty(getEmail($this->approval->approver('medical'))))$this->send_email(getEmail($this->approval->approver('medical')), $subject_email, $isi_email);
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
        $this->data['title'] = 'Detail - Kesehatan';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['id'] = $id;
        $this->data['user_id'] =$user_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $this->data['user_nik'] = get_nik($user_id);
        $this->data['sess_id'] = $sess_id= $this->session->userdata('user_id');
        $this->data['sess_nik'] = get_nik($sess_id);
        $this->data['is_app_hrd'] = getValue('is_app_hrd', 'users_medical', array('id'=>'where/'.$id));
        $this->data['note_hrd'] = getValue('note_hrd', 'users_medical', array('id'=>'where/'.$id));
        $this->data['app_status_id_lv1'] = getValue('app_status_id_lv1', 'users_medical', array('id'=>'where/'.$id));
        $this->data['note_lv1'] = getValue('note_lv1', 'users_medical', array('id'=>'where/'.$id));
        $this->data['user_lv1'] = getValue('user_app_lv1', 'users_medical', array('id'=>'where/'.$id));
        $this->data['creator_id'] = getValue('created_by', 'users_medical', array('id'=>'where/'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->main->form_medical_detail($id)->result_array();
        $this->data['detail_hrd'] = $this->main->form_medical_hrd($id)->result_array();
        $this->data['total_medical_hrd'] = $this->main->get_total_medical_hrd($id);
        $form_medical = $this->data['form_medical'] = $this->main->detail($id)->result();
        $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
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
        
       $approval_status = $this->input->post('app_status_id_'.$type);
       $this->main->update($id,$data);
       $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
       $this->approval_mail($id);
       $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Rekapitulasi Rawat Jalan/Inap dari Atasan';
       $subject_email_request = get_form_no($id).'Pengajuan Rekapitulasi Rawat Jalan/Inap';
       $isi_email = 'Status pengajuan Rekapitulasi Rawat Jalan/Inap anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
       $isi_email_request = get_name($user_medical_id).' mengajukan Rekapitulasi Rawat Jalan/Inap medical, untuk melihat detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
       if(!empty(getEmail($user_medical_id)))$this->send_email(getEmail($user_medical_id), $subject_email, $isi_email);
          
       if($type !== 'hrd'){
            $lv = substr($type, -1)+1;
            $lv_app = 'lv'.$lv;
            $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_medical', array('id'=>'where/'.$id)):0;
            if(!empty($user_app)):
                if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email_request, $isi_email_request);
                $this->approval->request($lv_app, 'medical', $id, $user_medical_id, $this->detail_email($id));
            else:
                if(!empty(getEmail($this->approval->approver('medical', $user_id))))$this->send_email(getEmail($this->approval->approver('medical', $user_id)), $subject_email_request, $isi_email_request);
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
        
        $this->main->update($id,$data2);
        $this->approval_mail($id);
        $isi_email = 'Status pengajuan Rekapitulasi Rawat Jalan/Inap anda disetujui oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_medical/detail/'.$id.'>Klik Disini</a><br />';
        if(!empty(getEmail($user_medical_id)))$this->send_email(getEmail($user_medical_id), get_form_no($id).'[APPROVED]Status Pengajuan Rekapitulasi Rawat Jalan/Inap dari Atasan', $isi_email);
       

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
        return '';
    }

    function form_medical_pdf($id)
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        
        $form_medical = $this->data['form_medical'] = $this->main->detail($id)->result();

        $user_id = getValue('user_id', 'users_medical', array('id'=>'where/'.$id));
        $this->data['bagian'] = get_user_organization(get_nik($user_id));
        $this->data['detail'] = $this->main->form_medical_detail($id)->result_array();
        $this->data['detail_hrd'] = $this->main->form_medical_hrd($id)->result_array();
        $this->data['total_medical_hrd'] = $this->main->get_total_medical_hrd($id);
        $form_medical = $this->data['form_medical'] = $this->main->detail($id)->result();
        $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            

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
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('datatables.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('core.js');
                    $this->template->add_js('select2.min.js');

                    $this->template->add_js('form_index.js');
                    $this->template->add_js('form_datatable_index.js');

                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datatables.min.css');
                    
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
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
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
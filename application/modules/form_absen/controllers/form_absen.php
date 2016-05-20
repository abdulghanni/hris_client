<?php defined('BASEPATH') OR exit('No direct script access allowed');

class form_absen extends MX_Controller {

	public $data;
    var $form_name = 'absen';
    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('rest');
        $this->load->library('approval');
        
        $this->load->database();
        $this->load->model('form_absen/form_absen_model','main');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        
    }

    function index($ftitle = "fn:",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {
        $this->data['title'] = 'Form Keterangan Tidak Absen';
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['form_id'] = getValue('form_id', 'form_id', array('form_name'=>'like/absen'));
            $this->data['form'] = 'absen';
            $this->data['form_name'] = $this->form_name;
            $this->_render_page('form_absen/index', $this->data);
        }
    }

    public function ajax_list($f)
    {
        $list = $this->main->get_datatables($f);//lastq();
        //print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            //AKSI
           $detail = base_url()."form_$this->form_name/detail/".$r->id; 
           $print = base_url()."form_$this->form_name/form_$this->form_name"."_pdf/".$r->id; 
           $delete = (($r->approval_status_id_lv1 == 0 && $r->created_by == sessId()) || is_admin()) ? '<button onclick="showModal('.$r->id.')" class="btn btn-sm btn-danger" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : '';

            //APPROVAL
            if(!empty($r->user_app_lv1)){
                $status1 = ($r->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Langsung'></i>";
            }
            if(!empty($r->user_app_lv2)){
                $status2 = ($r->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Tidak Langsung'></i>";
            }
            if(!empty($r->user_app_lv3)){
                $status3 = ($r->approval_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));
            }else{
                $status3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval Atasan Lainnya'></i>";
            }
            
            $statushrd = ($r->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($r->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($r->approval_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'Menunggu Status Approval'></i>"));

            $no++;
            $row = array();
            $row[] = "<a href=$detail>".$r->id.'</a>';
            $row[] = "<a href=$detail>".$r->nik.'</a>';
            $row[] = "<a href=$detail>".$r->username.'</a>';
            $row[] = dateIndo($r->date_tidak_hadir);
            $row[] = $r->keterangan;
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

            redirect('form_absen/index/fn:'.$ftitle_post, 'refresh');
        }
    }

    function detail($id)
    {
        $this->data['title'] = 'Detail - Keterangan Tidak Absen';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $user_id= getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
            $this->data['user_nik'] = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['form_absen'] = $this->main->detail($id)->result();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $this->data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
            $this->_render_page('form_absen/detail', $this->data);
        }
    }


     function input()
    {
        $this->data['title'] = 'Input - Keterangan Tidak Absen';
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
                $user_nik= get_nik($user_id);
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

                if($this->input->post('potong_cuti') == 1){
                    $user_nik = get_nik($user_id);
                    $date = $this->input->post('date_tidak_hadir');
                    $recid = $this->get_sisa_absen($user_id)[0]['RECID'];
                    $sisa_absen = $this->get_sisa_absen($user_id)[0]['ENTITLEMENT'] - 1;

                    $this->update_sisa_absen($recid, $sisa_absen);

                    $data2 = array(
                                'nik'       => get_mchid($user_nik),
                                'jhk'       => 1,
                                'cuti'      => 1,
                                'tanggal'   => date("d", strtotime($date)),
                                'bulan'     => date("m", strtotime($date)),
                                'tahun'     => date("Y", strtotime($date)),
                                'create_date' => date('Y-m-d',strtotime('now')),
                                'create_user_id' => $this->session->userdata('user_id'),
                            );
                    $this->db->insert('attendance', $data2);
                }

                if ($this->form_validation->run() == true && $this->main->create_($user_id,$data))
                {
                 $absen_id = $this->db->insert_id();
                 $user_app_lv1 = getValue('user_app_lv1', 'users_absen', array('id'=>'where/'.$absen_id));
                 $subject_email = get_form_no($absen_id).'-Pengajuan Keterangan Tidak Absen';
                 $isi_email = get_name($user_id).' mengajukan keterangan tidak absen, untuk melihat detail silakan <a href='.base_url().'form_absen/detail/'.$absen_id.'>Klik Disini</a><br />';

                 if($user_id!==$sess_id):
                    $this->approval->by_admin('absen', $absen_id, $sess_id, $user_id, $this->detail_email($absen_id));
                 endif;
                 if(!empty($user_app_lv1)):
                     if(!empty(getEmail($user_app_lv1)))$this->send_email(getEmail($user_app_lv1), $subject_email, $isi_email);
                     $this->approval->request('lv1', 'absen', $absen_id, $user_id, $this->detail_email($absen_id));
                 else:
                     if(!empty(getEmail($this->approval->approver('absen', $user_nik))))$this->send_email(getEmail($this->approval->approver('absen', $user_nik)), $subject_email, $isi_email);
                     $this->approval->request('hrd', 'absen', $absen_id, $user_id, $this->detail_email($absen_id));
                 endif;

                  redirect('form_absen', 'refresh');
                 //echo json_encode(array('st' =>1));     
                }
            }
        }
    }

    

    function detail_email($id)
    {
        return true;
    }

    function form_absen_pdf($id)
    {
        $this->data['title'] = 'Detail - Keterangan Tidak Absen';
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_userdata('last_link', $this->uri->uri_string());
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $user_id= getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
            $this->data['user_nik'] = get_nik($user_id);
            $sess_id = $this->data['sess_id'] = $this->session->userdata('user_id');
            $sess_nik = $this->data['sess_nik'] = get_nik($sess_id);
            $this->data['form_absen'] = $this->main->detail($id)->result();
            $this->data['_num_rows'] = $this->main->detail($id)->num_rows();
            $title = $this->data['title'] = 'Form Keterangan Tidak Absen-'.get_name($user_id);
            $this->load->library('mpdf60/mpdf');
            $html = $this->load->view('absen_pdf', $this->data, true); 
            $mpdf = new mPDF();
            $mpdf = new mPDF('A4');
            $mpdf->WriteHTML($html);
            $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        }
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
                    $this->template->add_js('jquery-validate.bootstrap-tooltip.min.js');
                    $this->template->add_js('bootstrap-datepicker.js');
                    $this->template->add_js('emp_dropdown.js');
                    $this->template->add_js('form_absen_input.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('datepicker.css');
                    
                     
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
            'approval_status_id_'.$type => $this->input->post('app_status_'.$type),
            'user_app_'.$type => $user_id, 
            'date_app_'.$type => $date_now,
            'note_'.$type => $this->input->post('note_'.$type)
            );
            $approval_status = $this->input->post('app_status_'.$type);
            $this->main->update($id,$data);
            $approval_status_mail = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));
            $user_absen_id = getValue('user_id', 'users_absen', array('id'=>'where/'.$id));
            $subject_email = get_form_no($id).'['.$approval_status_mail.']Status Pengajuan Permohonan Permintaan SDM dari Atasan';
            $subject_email_request = get_form_no($id).'Pengajuan Permintaan SDM';
            $isi_email = 'Status pengajuan permintaan SDM anda '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_absen/detail/'.$id.'>Klik Disini</a><br />';
            $isi_email_request = get_name($user_absen_id).' mengajukan Permohonan permintaan SDM, untuk melihat detail silakan <a href='.base_url().'form_absen/detail/'.$id.'>Klik Disini</a><br />';
            $is_app = getValue('is_app_'.$type, 'users_absen', array('id'=>'where/'.$id));
           if($is_app==0){
                $this->approval->approve('absen', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_absen_id)))$this->send_email(getEmail($user_absen_id), $subject_email, $isi_email);
            }else{
                $this->approval->update_approve('absen', $id, $approval_status, $this->detail_email($id));
                if(!empty(getEmail($user_absen_id)))$this->send_email(getEmail($user_absen_id), get_form_no($id).'['.$approval_status_mail.']Perubahan Status Pengajuan Permohonan Permintaan SDM dari Atasan', $isi_email);
            }
            if($type !== 'hrd' && $approval_status == 1){
                $lv = substr($type, -1)+1;
                $lv_app = 'lv'.$lv;
                $user_app = ($lv<4) ? getValue('user_app_'.$lv_app, 'users_absen', array('id'=>'where/'.$id)):0;
                if(!empty($user_app)):
                    if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app),  $subject_email_request , $isi_email_request);
                    $this->approval->request($lv_app, 'absen', $id, $user_absen_id, $this->detail_email($id));
                else:
                    if(!empty(getEmail($this->approval->approver('absen', $user_id))))$this->send_email(getEmail($this->approval->approver('absen', $user_id)),  $subject_email_request , $isi_email_request);
                    $this->approval->request('hrd', 'absen', $id, $user_absen_id, $this->detail_email($id));
                endif;
            }else{
                $email_body = "Status pengajuan permohonan absen yang diajukan oleh ".get_name($user_absen_id).' '.$approval_status_mail. ' oleh '.get_name($user_id).' untuk detail silakan <a href='.base_url().'form_absen/detail/'.$id.'>Klik Disini</a><br />';
                switch($type){
                    case 'lv1':
                        //$this->approval->not_approve('absen', $id, )
                    break;

                    case 'lv2':
                        $receiver_id = getValue('user_app_lv1', 'users_absen', array('id'=>'where/'.$id));
                        $this->approval->not_approve('absen', $id, $receiver_id, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_id)))$this->send_email(getEmail($receiver_id), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);
                    break;

                    case 'lv3':
                        $receiver_lv2 = getValue('user_app_lv2', 'users_absen', array('id'=>'where/'.$id));
                        $this->approval->not_approve('absen', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);

                        $receiver_lv1 = getValue('user_app_lv1', 'users_absen', array('id'=>'where/'.$id));
                        $this->approval->not_approve('absen', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                        //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);
                    break;

                    case 'hrd':
                        $receiver_lv3 = getValue('user_app_lv3', 'users_absen', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv3)):
                            $this->approval->not_approve('absen', $id, $receiver_lv3, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv3)))$this->send_email(getEmail($receiver_lv3), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);
                        endif;
                        $receiver_lv2 = getValue('user_app_lv2', 'users_absen', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv2)):
                            $this->approval->not_approve('absen', $id, $receiver_lv2, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv2)))$this->send_email(getEmail($receiver_lv2), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);
                        endif;
                        $receiver_lv1 = getValue('user_app_lv1', 'users_absen', array('id'=>'where/'.$id));
                        if(!empty($receiver_lv1)):
                            $this->approval->not_approve('absen', $id, $receiver_lv1, $approval_status ,$this->detail_email($id));
                            //if(!empty(getEmail($receiver_lv1)))$this->send_email(getEmail($receiver_lv1), 'Status Pengajuan Permohonan absen Dari Atasan', $email_body);
                        endif;
                    break;
                }
            }
               redirect('form_absen/detail/'.$id, 'refresh');
        }
    }
}
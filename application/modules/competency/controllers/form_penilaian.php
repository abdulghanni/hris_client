<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class form_penilaian extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        //$this->load->library('competency');

        $this->load->database();

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('competency/form_penilaian_model','main');
    }

    var $title = 'Form Penilaian Kemauan dan Kemampuan SDM';
    var $limit = 100000;
    var $controller = 'competency/form_penilaian';
    var $model_name = 'form_penilaian';
    var $table = 'competency_form_penilaian';
    var $id_table = 'id';
    var $list_view = 'form_penilaian/index';

    //redirect if needed, otherwise display the user list
    function index($id=NULL)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $data['title'] = $this->title;
            $data['url_ajax_list'] = site_url('form_penilaian/ajax_list');
            $data['url_ajax_add'] = site_url('form_penilaian/ajax_add');
            $data['url_ajax_edit'] = site_url('form_penilaian/ajax_edit');
            $data['url_ajax_delete'] = site_url('form_penilaian/ajax_delete');
            $data['url_ajax_update'] = site_url('form_penilaian/ajax_update');
            $data['ci'] = $this;
            $data['form'] = getAll($this->table);

            $this->_render_page($this->controller.'/index',$data);
        }
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['competency_penilaian'] = GetAll('competency_penilaian')->result();
        $data['users'] = GetAll('users')->result();
        $data['rekomendasi'] = GetAll('competency_rekomendasi')->result();
        $this->_render_page('form_penilaian/input', $data);
    }

    function approve($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['detail'] = $this->main->detail($id);//print_mz($data['detail']);
        $data['approver'] = getAll($this->table.'_approver', array($this->table.'_id'=>'where/'.$id));
        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['approved'] = assets_url('img/approved_stamp.png');
        $data['rejected'] = assets_url('img/rejected_stamp.png');
        $data['pending'] = assets_url('img/pending_stamp.png');
        if($approver_id != null){
            $f = array($this->table.'_id' => 'where/'.$id,
                       'user_id' => 'where/'.sessId(),
             );
            $data['app_status_id'] = getValue('app_status_id', $this->table.'_approver', $f);
            $data['date_app'] = getValue('date_app', $this->table.'_approver', $f);
            $app = $this->load->view($this->controller.'/app_stat', $data, true);
            // $note = $this->load->view('form_cuti/note', $data, true);
            $note = '';
            echo json_encode(array('app'=>$app, 'note'=>$note, 'date'=>lq()));
        }else{
            $this->_render_page($this->controller.'/approve', $data);
        }
    }

    function edit($id){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['competency_penilaian'] = GetAll('competency_penilaian')->result();
        $data['users'] = GetAll('users')->result();
        $data['rekomendasi'] = GetAll('competency_rekomendasi')->result();
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['detail'] = $this->main->detail($id);//print_mz($data['detail']);
        $data['approver'] = getAll($this->table.'_approver', array($this->table.'_id'=>'where/'.$id));
        $this->_render_page('form_penilaian/edit', $data);
    }

    function add(){
        // print_mz($_POST);
        permissionBiasa();
        // $this->form_validation->set_rules('competency_def_id', 'Kompetensi', 'trim|required');
        $approver_id = $this->input->post('approver_id');
        $com = $this->input->post('competency_penilaian_id');
        $kemampuan = $this->input->post('kemampuan');
        $kemauan = $this->input->post('kemauan');
        $alasan = $this->input->post('alasan');

        //print_mz($kemampuan[1]);
        // INSERT TO COMPETENCY_form_penilaian
        $data = array(
            'nik' => $this->input->post('nik'),
            'rekomendasi_id' => $this->input->post('rekomendasi_id'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );
        $this->db->insert($this->table, $data);
        $com_id = $this->db->insert_id();
        // INSERT TO COMPETENCY_form_penilaian_DETAIL
        for($i=1;$i<=sizeof($com);$i++) {
            $data = array(
                'competency_form_penilaian_id' => $com_id,
                'competency_penilaian_id' => $com[$i],
                'kemampuan' => $kemampuan[$i],
                'kemauan' => $kemauan[$i],
                'alasan' => $alasan[$i],
                );
            $this->db->insert($this->table.'_detail', $data);
        }

        $url = base_url().$this->controller.'/approve/'.$com_id;
        $subject_email = "Kompetensi - $this->title";
        $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
                     
        // INSERT TO COMPETENCY_form_penilaian_APPROVER
        $url = base_url().$this->controller.'/approve/'.$com_id;
        $subject_email = "Kompetensi - $this->title";
        $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
        for ($i=0;$i<sizeof($approver_id);$i++) {
            $data = array(
                $this->table.'_id' => $com_id,
                'user_id' => $approver_id[$i]
            );
            $this->db->insert($this->table.'_approver', $data);//print_ag(lq());

            $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => get_nik($approver_id[$i]),
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
            );
            $this->db->insert('email', $data4);
            if(!empty(getEmail($approver_id[$i])))$this->send_email(getEmail($approver_id[$i]), $subject_email, $isi_email);
        }
        redirect(base_url($this->controller), 'refresh');
    }

    function do_edit($id){
        // print_mz($_POST);
        permissionBiasa();
        // $this->form_validation->set_rules('competency_def_id', 'Kompetensi', 'trim|required');
        $approver_id = $this->input->post('approver_id');
        $com = $this->input->post('competency_penilaian_id');
        $kemampuan = $this->input->post('kemampuan');
        $kemauan = $this->input->post('kemauan');
        $alasan = $this->input->post('alasan');

        //print_mz($kemampuan[1]);
        // INSERT TO COMPETENCY_form_penilaian
        $data = array(
            // 'nik' => $this->input->post('nik'),
            'rekomendasi_id' => $this->input->post('rekomendasi_id'),
            // 'created_by'=>sessId(),
            // 'created_on'=>dateNow(),
            );
        $this->db->where('id', $id)->update($this->table, $data);
        $com_id = $id;
        // INSERT TO COMPETENCY_form_penilaian_DETAIL
        $this->db->where($this->table.'_id', $id)->delete($this->table.'_detail');
        for($i=1;$i<=sizeof($com);$i++) {
            $data = array(
                'competency_form_penilaian_id' => $com_id,
                'competency_penilaian_id' => $com[$i],
                'kemampuan' => $kemampuan[$i],
                'kemauan' => $kemauan[$i],
                'alasan' => $alasan[$i],
                );
            $this->db->insert($this->table.'_detail', $data);
        }

        $url = base_url().$this->controller.'/approve/'.$com_id;
        $subject_email = "Kompetensi - $this->title";
        $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
                     
        // INSERT TO COMPETENCY_form_penilaian_APPROVER
        $url = base_url().$this->controller.'/approve/'.$com_id;
        $subject_email = "Kompetensi - $this->title";
        $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
        $this->db->where($this->table.'_id', $id)->delete($this->table.'_approver');             
        for ($i=0;$i<sizeof($approver_id);$i++) {
            $data = array(
                $this->table.'_id' => $com_id,
                'user_id' => $approver_id[$i]
            );
            $this->db->insert($this->table.'_approver', $data);//print_ag(lq());

            $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => get_nik($approver_id[$i]),
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
            );
            $this->db->insert('email', $data4);
            if(!empty(getEmail($approver_id[$i])))$this->send_email(getEmail($approver_id[$i]), $subject_email, $isi_email);
        }
        redirect(base_url($this->controller), 'refresh');
    }
    // FOR js
    function do_approve($form_id){
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $sessId = sessId();
            $data = array(
                'is_app' => 1,
                'app_status_id' => $this->input->post('app_status_id'),
                'date_app'=>dateNow(),
                'note' => $this->input->post('note')
            );

            $this->db->where($this->table.'_id', $form_id)
                     ->where('user_id', $sessId)
                     ->update($this->table.'_approver', $data);
            return true;
        }
    }
    
    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array($this->controller.'/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/form_penilaian.js');
                    
            }elseif(in_array($view, array('form_penilaian/input')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/competency.js');
                $this->template->add_js('competency/form_penilaian_input.js');
                $this->template->add_js('emp_dropdown.js');
                    
            }elseif(in_array($view, array('form_penilaian/edit')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/competency.js');
                $this->template->add_js('competency/form_penilaian_input.js');
                $this->template->add_js('emp_dropdown.js');
                    
            }elseif(in_array($view, array($this->controller.'/approve')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
                $this->template->add_js('emp_dropdown.js');

                $this->template->add_js('competency/competency.js');
                
                $this->template->add_css('approval_img.css');
                $this->template->add_js('competency/approve.js');
                    
            }

            if(in_array($view, array('auth/login')))
            {
                $this->template->set_layout('layout_login');    
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

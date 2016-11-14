<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class form_evaluasi_training extends MX_Controller {

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
        $this->load->model('competency/form_evaluasi_training_model','main');
    }

    var $title = 'Form Evaluasi Keefektifan Training';
    var $limit = 100000;
    var $controller = 'competency/form_evaluasi_training';
    var $model_name = 'form_evaluasi_training';
    var $table = 'competency_form_evaluasi_training';
    var $id_table = 'id';
    var $list_view = 'form_evaluasi_training/index';

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
            $data['url_ajax_list'] = site_url('form_evaluasi_training/ajax_list');
            $data['url_ajax_add'] = site_url('form_evaluasi_training/ajax_add');
            $data['url_ajax_edit'] = site_url('form_evaluasi_training/ajax_edit');
            $data['url_ajax_delete'] = site_url('form_evaluasi_training/ajax_delete');
            $data['url_ajax_update'] = site_url('form_evaluasi_training/ajax_update');
            $data['ci'] = $this;
            $data['form'] = getAll($this->table);

            $this->_render_page($this->controller.'/index',$data);
        }
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['competency_evaluasi'] = GetAll('competency_evaluasi_training')->result();
        $data['competency_metode'] = GetAll('competency_metode_evaluasi')->result();
        $data['competency_pengetahuan'] = GetAll('competency_pengetahuan')->result();
        $data['competency_sikap'] = GetAll('competency_sikap')->result();
        $data['users'] = GetAll('users')->result();
        $this->_render_page('form_evaluasi_training/input', $data);
    }

    function approve($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;

        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['competency_metode'] = explode(',', $data['form']->competency_metode_evaluasi_id);
        $data['competency_pengetahuan'] = GetAll('competency_form_evaluasi_point_pengetahuan', array($this->table."_id"=>'where/'.$id))->result();
        $data['competency_sikap'] = GetAll('competency_form_evaluasi_point_sikap', array($this->table."_id"=>'where/'.$id))->result();
        $data['competency_keterampilan'] = GetAll('competency_form_evaluasi_point_keterampilan', array($this->table."_id"=>'where/'.$id))->result();
        $data['competency_output'] = GetAll('competency_form_evaluasi_point_output', array($this->table."_id"=>'where/'.$id))->result();
        $data['users'] = GetAll('users')->result();

        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['approved'] = assets_url('img/approved_stamp.png');
        $data['rejected'] = assets_url('img/rejected_stamp.png');
        $data['pending'] = assets_url('img/pending_stamp.png');
        if($approver_id != null){
            $f = array('id' => 'where/'.$id,
             );
            $data['app_status_id'] = getValue('app_status_id', $this->table, $f);
            $data['date_app'] = getValue('date_app', $this->table, $f);
            $app = $this->load->view($this->controller.'/app_stat', $data, true);
            // $note = $this->load->view('form_cuti/note', $data, true);
            $note = '';
            echo json_encode(array('app'=>$app, 'note'=>$note, 'date'=>dateNow()));
        }else{
            $this->_render_page($this->controller.'/approve', $data);
        }
    }

    function edit($id){
        permissionBiasa();
        $data['id'] = $id;
        $data['ci'] = $this;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['competency_evaluasi'] = GetAll('competency_evaluasi_training')->result();
        $data['competency_metode'] = GetAll('competency_metode_evaluasi')->result();
        $data['competency_pengetahuan'] = GetAll('competency_pengetahuan')->result();
        $data['competency_sikap'] = GetAll('competency_sikap')->result();
        $data['competency_keterampilan'] = GetAll('competency_form_evaluasi_point_keterampilan', array($this->table."_id"=>'where/'.$id))->result();

        $data['users'] = GetAll('users')->result();
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        // $data['competency_metode'] = explode(',', $data['form']->competency_metode_evaluasi_id);
        // $data['competency_pengetahuan'] = GetAll('competency_form_evaluasi_point_pengetahuan', array($this->table."_id"=>'where/'.$id))->result();
        // $data['competency_sikap'] = GetAll('competency_form_evaluasi_point_sikap', array($this->table."_id"=>'where/'.$id))->result();
        // $data['competency_keterampilan'] = GetAll('competency_form_evaluasi_point_keterampilan', array($this->table."_id"=>'where/'.$id))->result();
        // $data['competency_output'] = GetAll('competency_form_evaluasi_point_output', array($this->table."_id"=>'where/'.$id))->result();

        $this->_render_page('form_evaluasi_training/edit', $data);
    }

    function add(){
        //print_mz($_POST);
        permissionBiasa();

        $pengetahuan_point_id = $this->input->post('pengetahuan_point_id');
        $pengetahuan_point_sebelum = $this->input->post('pengetahuan_point_sebelum');
        $pengetahuan_point_sesudah = $this->input->post('pengetahuan_point_sesudah');
        $sikap_point_id = $this->input->post('sikap_point_id');
        $sikap_point_sebelum = $this->input->post('sikap_point_sebelum');
        $sikap_point_sesudah = $this->input->post('sikap_point_sesudah');
        $keterampilan = $this->input->post('keterampilan');
        // print_mz(sizeof($keterampilan));
        $keterampilan_point_sebelum = $this->input->post('keterampilan_point_sebelum');
        $keterampilan_point_sesudah = $this->input->post('keterampilan_point_sesudah');

        // INSERT TO COMPETENCY_form_evaluasi_training
        $data = array(
            'nik' => $this->input->post('nik'),
            'organization_id' => $this->input->post('organization_id'),
            'position_id' => $this->input->post('position_id'),
            'nama_training' => $this->input->post('nama_training'),
            'tgl_training' => date('Y-m-d', strtotime($this->input->post('tgl_training'))),
            'sasaran' => $this->input->post('sasaran'),
            'competency_evaluasi_training_id' => $this->input->post('competency_evaluasi_training_id'),
            'competency_evaluasi_training_lain' => $this->input->post('competency_evaluasi_training_lain'),
            'competency_metode_evaluasi_id' => implode(',', $this->input->post('competency_metode_evaluasi_id')),
            'tindak_lanjut' => $this->input->post('tindak_lanjut'),
            'realisasi_tgl' => date('Y-m-d', strtotime($this->input->post('realisasi_tgl'))),

            'hrd' => $this->input->post('hrd'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );

        if($this->db->insert($this->table, $data)){
            $form_id = $this->db->insert_id();
            
            //POINT PENGETAHUAN
            for ($i=0; $i < sizeof($pengetahuan_point_id) ; $i++) { 
                $pengetahuan = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'competency_pengetahuan_id' => $pengetahuan_point_id[$i], 
                    'point_sebelum' => $pengetahuan_point_sebelum[$i], 
                    'point_sesudah' => $pengetahuan_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_pengetahuan', $pengetahuan);
            }

            // POINT SIKAP
            for ($i=0; $i < sizeof($sikap_point_id) ; $i++) { 
                $sikap = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'competency_sikap_id' => $sikap_point_id[$i], 
                    'point_sebelum' => $sikap_point_sebelum[$i], 
                    'point_sesudah' => $sikap_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_sikap', $sikap);
            }

            // POINT KETERAMPILAN
            for ($i=0; $i < sizeof($keterampilan) ; $i++) { 
                $keterampilan_data = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'title' => $keterampilan[$i], 
                    'point_sebelum' => $keterampilan_point_sebelum[$i], 
                    'point_sesudah' => $keterampilan_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_keterampilan', $keterampilan_data);
            }

            // POINT OUTPUT
            $output = array(
                'competency_form_evaluasi_training_id' => $form_id, 
                'title' => $this->input->post('output'), 
                'point_sebelum' => $this->input->post('output_point_sebelum'), 
                'point_sesudah' => $this->input->post('output_point_sesudah'), 
            );

            $this->db->insert('competency_form_evaluasi_point_output', $output);

            //NOTIF KE HRD
            $hrd = $this->input->post('hrd');
            $url = base_url().$this->controller.'/approve/'.$form_id;
            $subject_email = "Kompetensi - $this->title";
            $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
            $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => $hrd,
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
            );
            $this->db->insert('email', $data4);
            if(!empty(getEmail($hrd)))$this->send_email(getEmail($hrd), $subject_email, $isi_email);

        }
        redirect(base_url($this->controller), 'refresh');
    }

    function do_edit($id){
        permissionBiasa();

        $pengetahuan_point_id = $this->input->post('pengetahuan_point_id');
        $pengetahuan_point_sebelum = $this->input->post('pengetahuan_point_sebelum');
        $pengetahuan_point_sesudah = $this->input->post('pengetahuan_point_sesudah');
        $sikap_point_id = $this->input->post('sikap_point_id');
        $sikap_point_sebelum = $this->input->post('sikap_point_sebelum');
        $sikap_point_sesudah = $this->input->post('sikap_point_sesudah');
        $keterampilan = $this->input->post('keterampilan');
        // print_mz(sizeof($keterampilan));
        $keterampilan_point_sebelum = $this->input->post('keterampilan_point_sebelum');
        $keterampilan_point_sesudah = $this->input->post('keterampilan_point_sesudah');

        // INSERT TO COMPETENCY_form_evaluasi_training
        $data = array(
            // 'nik' => $this->input->post('nik'),
            // 'organization_id' => $this->input->post('organization_id'),
            // 'position_id' => $this->input->post('position_id'),
            'nama_training' => $this->input->post('nama_training'),
            'tgl_training' => date('Y-m-d', strtotime($this->input->post('tgl_training'))),
            'sasaran' => $this->input->post('sasaran'),
            'competency_evaluasi_training_id' => $this->input->post('competency_evaluasi_training_id'),
            'competency_evaluasi_training_lain' => $this->input->post('competency_evaluasi_training_lain'),
            'competency_metode_evaluasi_id' => implode(',', $this->input->post('competency_metode_evaluasi_id')),
            'tindak_lanjut' => $this->input->post('tindak_lanjut'),
            'realisasi_tgl' => date('Y-m-d', strtotime($this->input->post('realisasi_tgl'))),

            'is_app' => 0,
            'date_app' => 0,
            'app_status_id' => 0,
            'hrd' => $this->input->post('hrd'),
            'edited_by'=>sessId(),
            'edited_on'=>dateNow(),
            );

        if($this->db->where('id', $id)->update($this->table, $data)){
            $form_id = $id;
            
            //POINT PENGETAHUAN
            $this->db->where($this->table.'_id', $id)->delete('competency_form_evaluasi_point_pengetahuan');
            for ($i=0; $i < sizeof($pengetahuan_point_id) ; $i++) { 
                $pengetahuan = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'competency_pengetahuan_id' => $pengetahuan_point_id[$i], 
                    'point_sebelum' => $pengetahuan_point_sebelum[$i], 
                    'point_sesudah' => $pengetahuan_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_pengetahuan', $pengetahuan);
            }

            // POINT SIKAP
            $this->db->where($this->table.'_id', $id)->delete('competency_form_evaluasi_point_sikap');
            for ($i=0; $i < sizeof($sikap_point_id) ; $i++) { 
                $sikap = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'competency_sikap_id' => $sikap_point_id[$i], 
                    'point_sebelum' => $sikap_point_sebelum[$i], 
                    'point_sesudah' => $sikap_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_sikap', $sikap);
            }

            // POINT KETERAMPILAN
            $this->db->where($this->table.'_id', $id)->delete('competency_form_evaluasi_point_keterampilan');
            for ($i=0; $i < sizeof($keterampilan) ; $i++) { 
                $keterampilan_data = array(
                    'competency_form_evaluasi_training_id' => $form_id, 
                    'title' => $keterampilan[$i], 
                    'point_sebelum' => $keterampilan_point_sebelum[$i], 
                    'point_sesudah' => $keterampilan_point_sesudah[$i], 
                );

                $this->db->insert('competency_form_evaluasi_point_keterampilan', $keterampilan_data);
            }

            // POINT OUTPUT

            $this->db->where($this->table.'_id', $id)->delete('competency_form_evaluasi_point_output');
            $output = array(
                'competency_form_evaluasi_training_id' => $form_id, 
                'title' => $this->input->post('output'), 
                'point_sebelum' => $this->input->post('output_point_sebelum'), 
                'point_sesudah' => $this->input->post('output_point_sesudah'), 
            );

            $this->db->insert('competency_form_evaluasi_point_output', $output);

            //NOTIF KE HRD
            $hrd = $this->input->post('hrd');
            $url = base_url().$this->controller.'/approve/'.$form_id;
            $subject_email = "Kompetensi - $this->title";
            $isi_email = get_name(sessId())." Membuat perubahan".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
            $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => $hrd,
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
            );
            $this->db->insert('email', $data4);
            if(!empty(getEmail($hrd)))$this->send_email(getEmail($hrd), $subject_email, $isi_email);

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

            $this->db->where('id', $form_id)
                     ->update($this->table, $data);
            return true;
        }
    }

    function add_keterampilan($id)
    {
        $data['id'] = $id;
        $this->load->view($this->controller.'/row_keterampilan', $data);
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

                $this->template->add_js('competency/form_evaluasi_training.js');
                    
            }elseif(in_array($view, array('form_evaluasi_training/input')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');
                $this->template->add_js('bootstrap-datepicker.js');

                $this->template->add_js('core.js');

                $this->template->add_js('competency/competency.js');
                $this->template->add_js('competency/form_evaluasi_training_input.js');
                $this->template->add_js('emp_dropdown.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
                $this->template->add_css('datepicker.css');
                    
            }elseif(in_array($view, array('form_evaluasi_training/edit')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');
                $this->template->add_js('bootstrap-datepicker.js');

                $this->template->add_js('core.js');

                $this->template->add_js('competency/competency.js');
                $this->template->add_js('competency/form_evaluasi_training_input.js');
                $this->template->add_js('emp_dropdown.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
                $this->template->add_css('datepicker.css');
                    
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

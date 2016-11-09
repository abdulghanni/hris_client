<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class kinerja_supporting extends MX_Controller {

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
        $this->load->model('competency/kinerja_supporting_model','main');
    }

    var $title = 'Penilaian Kinerja Supporting';
    var $limit = 100000;
    var $controller = 'competency/kinerja_supporting';
    var $model_name = 'kinerja_supporting';
    var $table = 'competency_kinerja_supporting';
    var $id_table = 'id';
    var $list_view = 'kinerja_supporting/index';

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
            $data['url_ajax_list'] = site_url('kinerja_supporting/ajax_list');
            $data['url_ajax_add'] = site_url('kinerja_supporting/ajax_add');
            $data['url_ajax_edit'] = site_url('kinerja_supporting/ajax_edit');
            $data['url_ajax_delete'] = site_url('kinerja_supporting/ajax_delete');
            $data['url_ajax_update'] = site_url('kinerja_supporting/ajax_update');
            $data['ci'] = $this;
            $data['form'] = getAll($this->table);

            $this->_render_page($this->controller.'/index',$data);
        }
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['users'] = GetAll('users')->result();
        $this->_render_page('kinerja_supporting/input', $data);
    }

    function approve($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['performance'] = getAll($this->table.'_performance', array($this->table.'_id'=>'where/'.$id))->result();
        $data['kompetensi'] = getAll($this->table.'_kompetensi', array($this->table.'_id'=>'where/'.$id))->result();
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
            echo json_encode(array('app'=>$app, 'note'=>$note, 'date'=>dateNow()));
        }else{
            $this->_render_page($this->controller.'/approve', $data);
        }
    }

    function add(){
        // print_mz($_POST);
        permissionBiasa();

        $aspek_performance = $this->input->post('aspek_performance');
        $bobot_performance = $this->input->post('bobot_performance');
        $nilai_performance = $this->input->post('nilai_performance');
        $persentase_performance = $this->input->post('persentase_performance');
        $aspek_kompetensi = $this->input->post('aspek_kompetensi');
        $bobot_kompetensi = $this->input->post('bobot_kompetensi');
        $nilai_kompetensi = $this->input->post('nilai_kompetensi');
        $persentase_kompetensi = $this->input->post('persentase_kompetensi');
        $approver_id = $this->input->post('approver_id');
        // INSERT TO COMPETENCY_form_evaluasi_training
        $data = array(
            'nik' => $this->input->post('nik'),
            'organization_id' => $this->input->post('organization_id'),
            'position_id' => $this->input->post('position_id'),
            'periode' => date('Y-m-d', strtotime($this->input->post('tgl_training'))),
            'sub_total_bobot_performance' => $this->input->post('sub_total_bobot_performance'),
            'sub_total_nilai_performance' => $this->input->post('sub_total_nilai_performance'),
            'sub_total_persentase_performance' => $this->input->post('sub_total_persentase_performance'),
            'sub_total_bobot_kompetensi' => $this->input->post('sub_total_bobot_kompetensi'),
            'sub_total_nilai_kompetensi' => $this->input->post('sub_total_nilai_kompetensi'),
            'sub_total_persentase_kompetensi' => $this->input->post('sub_total_persentase_kompetensi'),
            'total' => $this->input->post('total'),
            'konversi' => $this->input->post('konversi'),
            'potensi_promosi' => $this->input->post('potensi_promosi'),
            'catatan_perilaku' => $this->input->post('catatan_perilaku'),
            'kebutuhan_training' => $this->input->post('kebutuhan_training'),
            'target_kedepan' => $this->input->post('target_kedepan'),
            'created_by'=>sessId(),
            'created_on'=>dateNow(),
            );

        if($this->db->insert($this->table, $data)){
            $form_id = $this->db->insert_id();
            
            //table competency kinerja supporting performance
            for ($i=0; $i < sizeof($aspek_performance) ; $i++) { 
                $performance = array(
                    $this->table.'_id' => $form_id, 
                    'aspek' => $aspek_performance[$i], 
                    'bobot' => $bobot_performance[$i], 
                    'nilai' => $nilai_performance[$i], 
                    'persentase' => $persentase_performance[$i], 
                );

                $this->db->insert($this->table.'_performance', $performance);
            }

            //table competency kinerja supporting kompetensi
            for ($i=0; $i < sizeof($aspek_kompetensi) ; $i++) { 
                $kompetensi = array(
                    $this->table.'_id' => $form_id, 
                    'aspek' => $aspek_kompetensi[$i], 
                    'bobot' => $bobot_kompetensi[$i], 
                    'nilai' => $nilai_kompetensi[$i], 
                    'persentase' => $persentase_kompetensi[$i], 
                );

                $this->db->insert($this->table.'_kompetensi', $kompetensi);
            }

            //INSERT TO KINERJA SUPPORTING APPROVER
            $url = base_url().$this->controller.'/approve/'.$form_id;
            $subject_email = "Kompetensi - $this->title";
            $isi_email = get_name(sessId())." Membuat ".$this->title.
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
            for ($i=0;$i<sizeof($approver_id);$i++) {
                $data = array(
                    $this->table.'_id' => $form_id,
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
    
    function add_performance($id)
    {
        $data['id'] = $id;
        $this->load->view('competency/kinerja_supporting/row_performance', $data);
    }

    function add_kompetensi($id)
    {
        $data['id'] = $id;
        $this->load->view('competency/kinerja_supporting/row_kompetensi', $data);
    }


    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('kinerja_supporting/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/kinerja_supporting.js');
                    
            }elseif(in_array($view, array('kinerja_supporting/input')))
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
                $this->template->add_js('competency/kinerja_supporting_input.js');
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

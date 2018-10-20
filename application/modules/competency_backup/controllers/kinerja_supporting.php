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
        /*elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }*/
        else
        {
            $sess_id = $data['sess_id'] = $this->session->userdata('user_id');
            $data['title'] = $this->title;
            $data['url_ajax_list'] = site_url('kinerja_supporting/ajax_list');
            $data['url_ajax_add'] = site_url('kinerja_supporting/ajax_add');
            $data['url_ajax_edit'] = site_url('kinerja_supporting/ajax_edit');
            $data['url_ajax_delete'] = site_url('kinerja_supporting/ajax_delete');
            $data['url_ajax_update'] = site_url('kinerja_supporting/ajax_update');
            $data['ci'] = $this;
            if(is_admin_competency(50) == 1 || $this->ion_auth->is_admin())
            {
                $data['form'] = getAll($this->table,array('id'=>'order/desc'));    
            }else
            {
                $data['form'] = getJoin($this->table, 'users', $this->table.'.nik = users.nik', 'left', $this->table.'.*,users.superior_id', array('users.superior_id'=>'where/'.get_nik($sess_id),'id'=>'order/desc'));
                
            }

            $this->_render_page($this->controller.'/index',$data);
        }
    }

    function input(){
        permissionBiasa();
        $data['title'] = $this->title;
        $sess_id = $data['sess_id'] = $this->session->userdata('user_id');
        $data['controller'] = $this->controller;
        $data['users'] = GetAll('users')->result();
        $data['subordinate'] = getAll('users', array('superior_id'=>'where/'.get_nik($sess_id)));
        $periode = getAll('comp_session',array('is_deleted'=>'where/0'));
        if($periode->num_rows() > 0)
        {
            $data['periode'] = $periode->result_array();
        }else{
            $data['periode'] = array();
        }
        $this->_render_page('kinerja_supporting/input', $data);
    }

    function get_kpi_detail($comp_session_id,$organization_id,$position_id,$user_nik){
        $user_id = get_id($user_nik);
        $year_session = $this->main->get_year_session($comp_session_id);
        $year_kpi = $year_session-1;
        
        //$data['id'] = $rowcount;
        $kpi_detail = $this->main->get_kpi_detail($comp_session_id,$organization_id,$position_id, $user_id);
       // die('q : '.$this->db->last_query());
        if($kpi_detail->num_rows() > 0)
        {
            $data['kpi_detail'] = $r_kpi_detail = $kpi_detail->result_array();

            $no = 1;
            $bobot_performance = 0;
            $target_performance = 0;
            $nilai_performance = 0;
            $persentase_performance = 0;
            $html_performance = '';
            
            foreach ($r_kpi_detail as $key => $value) 
            { 
                $html_performance .='<tr>';
                $html_performance .= '<td>'.$no.'</td>';
                $html_performance .= '<td>';
                $html_performance .= '<input type="text" class="form-control" name="aspek_performance[]" placeholder="isi Aspek Penilaian Performance disini....." value="'.$value['kpi'].'">';
                $html_performance .= '</td>';
                $html_performance .= '<td>';
                    $html_performance .= '<input type="text" id="bobot_performance'.$value['id'].'" class="form-control text-right bobot_performance" name="bobot_performance[]" placeholder="....." onkeyup="hitungPerformance('.$value['id'].')" min="0"  max="100" readonly="readonly" value="'.$value['bobot_kpi'].'">';
                $html_performance .= '</td>';
                $html_performance .= '<td>';
                    $html_performance .= '<input type="text" id="target_performance'.$value['id'].'" class="form-control text-right target_performance" name="target_performance[]" placeholder="....." onkeyup="hitungPerformance('.$value['id'].')" min="0"  max="100" readonly="readonly" value="'.$value['target_kpi'].'">';
                $html_performance .= '</td>';
                $html_performance .= '<td>';
                    $html_performance .= '<input type="text" id="nilai_performance'.$value['id'].'" class="form-control text-right nilai_performance" name="nilai_performance[]" placeholder="....." min="0" max="100" readonly="readonly" value="'.$value['rata_rata'].'" onkeyup="hitungPerformance('.$value['id'].')">';
                $html_performance .= '</td>';
                $html_performance .= '<td>';
                    $html_performance .= '<input type="text" id="persentase_performance'.$value['id'].'" class="form-control text-right persentase_performance" name="persentase_performance[]" placeholder="....." readonly="readonly" value="'.number_format((($value['bobot_kpi']/100)*$value['rata_rata']),2).'">';
                $html_performance .= '</td>';
            $html_performance .= '</tr>';
            
                $no = $no+1;
                $bobot_performance = $bobot_performance + $value['bobot_kpi'];
                $target_performance = $target_performance + $value['target_kpi'];
                $nilai_performance = $nilai_performance + $value['rata_rata'];
                $persentase_performance = $persentase_performance + (($value['bobot_kpi']/100)*$value['rata_rata']);
            } 
            
            $html_performance .= '<tr>';
                $html_performance .= '<td></td>';
                $html_performance .= '<td>Subtotal Nilai Performance</td>';
                $html_performance .= '<td><input class="form-control text-right" type="text" id="sub_total_bobot_performance" name="sub_total_bobot_performance" value="'.$bobot_performance.'" readonly="readonly"></td>';
                $html_performance .= '<td><input class="form-control text-right" type="text" id="sub_total_target_performance" name="sub_total_target_performance" value="'.$target_performance.'" readonly="readonly"></td>';
                $html_performance .= '<td><input class="form-control text-right" id="sub_total_nilai_performance" type="text" name="sub_total_nilai_performance" value="'.$nilai_performance.'" readonly="readonly"></td>';
                $html_performance .= '<td><input class="form-control text-right" id="sub_total_persentase_performance_id" type="text" name="sub_total_persentase_performance" value="'.number_format($persentase_performance,2).'" ></td>';
            $html_performance .= '</tr>';
        }else{
            $data['kpi_detail'] = array();
            $html_performance = '';
        }
        $html_kompetensi = '';
        $bobot_kompetensi = 0;
        $target_kompetensi = 0;
        $nilai_kompetensi = 0;
        $persentase_kompetensi = 0;
        $kpi_standar = $this->main->get_competency_dasar();
        if($kpi_standar->num_rows() > 0)
        {
            $r_kpi_standar = $kpi_standar->result_array();
            $no_standar = 1;

            foreach ($r_kpi_standar as $key => $value) {
                $html_kompetensi .= '<tr>';
                    $html_kompetensi .= '<td>'.$no_standar.'</td>';
                    $html_kompetensi .= '<td>';
                        $html_kompetensi .= '<input type="text" class="form-control" name="aspek_kompetensi[]" placeholder="isi Aspek Penilaian kompetensi disini....." value="'.$value['title'].'">';
                    $html_kompetensi .= '</td>';
                    $html_kompetensi .= '<td>';
                        $html_kompetensi .= '<input type="text" id="bobot_kompetensi'.$value['id'].'" class="form-control text-right bobot_kompetensi" name="bobot_kompetensi[]" placeholder="....." onkeyup="hitungkompetensi('.$value['id'].')" min="0"  max="100"  value="'.$value['bobot'].'" readonly="readonly">';
                    $html_kompetensi .= '</td>';
                    $html_kompetensi .= '<td>';
                        $html_kompetensi .= '<input type="text" id="target_kompetensi'.$value['id'].'" class="form-control text-right target_kompetensi" name="target_kompetensi[]" placeholder="....." onkeyup="hitungkompetensi('.$value['id'].')" min="0"  max="100"  value="'.$value['target'].'" readonly="readonly">';
                    $html_kompetensi .= '</td>';
                    $html_kompetensi .= '<td>';
                        $html_kompetensi .= '<input type="text" id="nilai_kompetensi'.$value['id'].'" class="form-control text-right nilai_kompetensi" name="nilai_kompetensi[]" placeholder="....." min="0" max="100" value="0" onkeyup="hitungkompetensi('.$value['id'].')">';
                    $html_kompetensi .= '</td>';
                    $html_kompetensi .= '<td>';
                        $html_kompetensi .= '<input type="text" id="persentase_kompetensi'.$value['id'].'" class="form-control text-right persentase_kompetensi" name="persentase_kompetensi[]" placeholder="....." readonly="readonly" value="0">';
                    $html_kompetensi .= '</td>';
                $html_kompetensi .= '</tr>';
                $no_standar = $no_standar+1;
                $bobot_kompetensi = $bobot_kompetensi + $value['bobot'];
                $target_kompetensi = $target_kompetensi + $value['target'];
                //$nilai_kompetensi = $nilai_kompetensi + $value['rata_rata'];
                //$persentase_kompetensi = $persentase_kompetensi + (($value['bobot_kpi']/100)*$value['rata_rata']);
            }
            $html_kompetensi .= '<tr>';
                $html_kompetensi .= '<td></td>';
                $html_kompetensi .= '<td>Subtotal Nilai Kompetensi</td>';
                $html_kompetensi .= '<td><input class="form-control text-right" type="text" id="sub_total_bobot_kompetensi" name="sub_total_bobot_kompetensi" readonly="readonly" value="'.$bobot_kompetensi.'"></td>';
                $html_kompetensi .= '<td><input class="form-control text-right" type="text" id="sub_total_target_kompetensi" name="sub_total_target_kompetensi" readonly="readonly" value="'.$target_kompetensi.'"></td>';
                $html_kompetensi .= '<td><input class="form-control text-right" id="sub_total_nilai_kompetensi" type="text" name="sub_total_nilai_kompetensi" readonly="readonly"></td>';
                $html_kompetensi .= '<td><input class="form-control text-right" id="sub_total_persentase_kompetensi" type="text" name="sub_total_persentase_kompetensi" readonly="readonly"></td>';
            $html_kompetensi .= '</tr>';
        }else{
            $data['kpi_standar'] = array();
            $html_kompetensi = '';
        }

        $html_kedisiplinan = '';
        $bobot_kedisiplinan = 0;
        $target_kedisiplinan = 0;
        $nilai_kedisiplinan = 0;
        $persentase_kedisiplinan = 0;

        $url_menit_telat = get_api_key().'attendance/user/EMPLID/'.$user_nik.'/YEAR/'.$year_kpi.'/format/json';//print_mz($url);
        $headers = get_headers($url_menit_telat);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_user_menit_telat = file_get_contents($url_menit_telat);
            $user_menit_telat = json_decode($get_user_menit_telat, true);

            $jumlah_menit_telat = 0;
            for($i=0;$i<sizeof($user_menit_telat);$i++)
            {
                $jumlah_menit_telat = $jumlah_menit_telat + date('i',$user_menit_telat[$i]['CLOCKIN'] - 25200);
            }
            $jumlah_menit_telat = $jumlah_menit_telat;

        }else{
            $jumlah_menit_telat = 0;
        }

        $url_jumlah_telat = get_api_key().'attendance/user_jumlah_telat/EMPLID/'.$user_nik.'/YEAR/'.$year_kpi.'/format/json';//print_mz($url);
        $headers = get_headers($url_jumlah_telat);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $get_user_jumlah_telat = file_get_contents($url_jumlah_telat);
            $user_jumlah_telat = json_decode($get_user_jumlah_telat, true);
        }else{
            $user_jumlah_telat = 1;
        }

        if($user_jumlah_telat[0]['JUMLAH_HARI_TELAT'] != 0)
        {
            $nilai_keterlambatan = $jumlah_menit_telat/$user_jumlah_telat[0]['JUMLAH_HARI_TELAT'];
        }else{
            $nilai_keterlambatan = 1;
        }

        $point_keterlambatan = $this->point_keterlambatan($nilai_keterlambatan);


        $kpi_standar = $this->main->get_competency_kedisiplinan();
        if($kpi_standar->num_rows() > 0)
        {
            $r_kpi_standar = $kpi_standar->result_array();
            $no_standar = 1;

            foreach ($r_kpi_standar as $key => $value) {
                
                $html_kedisiplinan .= '<tr>';
                    $html_kedisiplinan .= '<td>'.$no_standar.'</td>';
                    $html_kedisiplinan .= '<td>';
                        $html_kedisiplinan .= '<input type="text" class="form-control" name="aspek_kedisiplinan[]" placeholder="isi Aspek Penilaian kedisiplinan disini....." value="'.$value['title'].'">';
                    $html_kedisiplinan .= '</td>';
                    $html_kedisiplinan .= '<td>';
                        $html_kedisiplinan .= '<input type="text" id="bobot_kedisiplinan'.$value['id'].'" class="form-control text-right bobot_kedisiplinan" name="bobot_kedisiplinan[]" placeholder="....." onkeyup="hitungkedisiplinan('.$value['id'].')" min="0"  max="100"  value="'.$value['bobot'].'" readonly="readonly">';
                    $html_kedisiplinan .= '</td>';
                    $html_kedisiplinan .= '<td>';
                        $html_kedisiplinan .= '<input type="text" id="target_kedisiplinan'.$value['id'].'" class="form-control text-right target_kedisiplinan" name="target_kedisiplinan[]" placeholder="....." onkeyup="hitungkedisiplinan('.$value['id'].')" min="0"  max="100"  value="'.$value['target'].'" readonly="readonly">';
                    $html_kedisiplinan .= '</td>';
                    $html_kedisiplinan .= '<td>';
                        $html_kedisiplinan .= '<input type="text" id="nilai_kedisiplinan'.$value['id'].'" class="form-control text-right nilai_kedisiplinan" name="nilai_kedisiplinan[]" placeholder="....." min="0" max="100" value="'.number_format($nilai_keterlambatan,2).'" onkeyup="hitungkedisiplinan('.$value['id'].')" readonly="readonly" >';
                    $html_kedisiplinan .= '</td>';
                    $html_kedisiplinan .= '<td>';
                        $html_kedisiplinan .= '<input type="text" id="persentase_kedisiplinan'.$value['id'].'" class="form-control text-right persentase_kedisiplinan" name="persentase_kedisiplinan[]" placeholder="....." readonly="readonly" value="'.$point_keterlambatan.'">';
                    $html_kedisiplinan .= '</td>';
                $html_kedisiplinan .= '</tr>';
                $bobot_kedisiplinan = $bobot_kedisiplinan + $value['bobot'];
                $target_kedisiplinan = $target_kedisiplinan + $value['target'];
                $no_standar = $no_standar+1;
            }
            $html_kedisiplinan .= '<tr>';
                $html_kedisiplinan .= '<td></td>';
                $html_kedisiplinan .= '<td>Subtotal Nilai kedisiplinan</td>';
                $html_kedisiplinan .= '<td><input class="form-control text-right" type="text" id="sub_total_bobot_kedisiplinan" name="sub_total_bobot_kedisiplinan" readonly="readonly" value="'.$bobot_kedisiplinan.'"></td>';
                $html_kedisiplinan .= '<td><input class="form-control text-right" type="text" id="sub_total_target_kedisiplinan" name="sub_total_target_kedisiplinan" readonly="readonly" value="'.$target_kedisiplinan.'"></td>';
                $html_kedisiplinan .= '<td><input class="form-control text-right" id="sub_total_nilai_kedisiplinan" type="text" name="sub_total_nilai_kedisiplinan" value="'.number_format($nilai_keterlambatan,2).'" readonly="readonly"></td>';
                $html_kedisiplinan .= '<td><input class="form-control text-right" id="sub_total_persentase_kedisiplinan_id" type="text" name="sub_total_persentase_kedisiplinan" value="'.$point_keterlambatan.'" readonly="readonly"></td>';
            $html_kedisiplinan .= '</tr>';
        }else{
            $data['kpi_standar'] = array();
            $html_kedisiplinan = '';
        }
        echo json_encode(array("status" => TRUE,"html_performance" => $html_performance,"html_kompetensi" => $html_kompetensi,"html_kedisiplinan" => $html_kedisiplinan));
        //$this->load->view('kinerja_supporting/result_performance', $data);
    }

    function point_keterlambatan($nilai_keterlambatan)
    {
        if($nilai_keterlambatan <= 5)
        {
            $point = 100;
        }
        elseif($nilai_keterlambatan <= 10)
        {
            $point = 90;
        }
        elseif($nilai_keterlambatan <= 15)
        {
            $point = 80;
        }
        elseif($nilai_keterlambatan <= 20)
        {
            $point = 60;
        }
        elseif($nilai_keterlambatan <= 25)
        {
            $point = 40;
        }
        elseif($nilai_keterlambatan > 25)
        {
            $point = 0;
        }

        return $point;
    }

    function approve($id, $approver_id=null){
        permissionBiasa();
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['performance'] = getAll($this->table.'_performance', array($this->table.'_id'=>'where/'.$id))->result();
        $data['kompetensi'] = getAll($this->table.'_kompetensi', array($this->table.'_id'=>'where/'.$id))->result();
        $data['kedisiplinan'] = getAll($this->table.'_kedisiplinan', array($this->table.'_id'=>'where/'.$id))->result();
        $data['approver'] = getAll($this->table.'_approver', array($this->table.'_id'=>'where/'.$id));
        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['kode_surat'] = get_no_surat('PKS',$this->table,$id);
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

        $aspek_kedisiplinan = $this->input->post('aspek_kedisiplinan');
        $bobot_kedisiplinan = $this->input->post('bobot_kedisiplinan');
        $target_kedisiplinan = $this->input->post('target_kedisiplinan');
        $nilai_kedisiplinan = $this->input->post('nilai_kedisiplinan');
        $persentase_kedisiplinan = $this->input->post('persentase_kedisiplinan');

        $approver_id = $this->input->post('approver_id');
        // INSERT TO COMPETENCY_form_evaluasi_training
        $data = array(
            'nik' => $this->input->post('nik'),
            'organization_id' => $this->input->post('organization_id'),
            'position_id' => $this->input->post('position_id'),
            'comp_session_id' => $this->input->post('comp_session_id'),
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

            //table competency kinerja supporting kedisiplinan
            for ($i=0; $i < sizeof($aspek_kedisiplinan) ; $i++) { 
                $kedisiplinan = array(
                    $this->table.'_id' => $form_id, 
                    'aspek' => $aspek_kedisiplinan[$i], 
                    'bobot' => $bobot_kedisiplinan[$i], 
                    'target' => $target_kedisiplinan[$i], 
                    'nilai' => $nilai_kedisiplinan[$i], 
                    'persentase' => $persentase_kedisiplinan[$i], 
                );

                $this->db->insert($this->table.'_kedisiplinan', $kedisiplinan);
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

     public function ajax_list()
    {
        $list = $this->main->get_datatables();//lastq();//print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
          

            $no++;
            $row = array();
            $row[] = $r->id;
            $row[] = get_year_session($r->comp_session_id);
            $row[] = $r->nik;
            $row[] = get_name($r->nik);
            $row[] = get_user_position($r->nik);
            $row[] = ' <a href="'.base_url().'competency/kinerja_supporting/approve/'.$r->id.'"><button type="button" class="btn btn-primary" title="Klik disini untuk melihat detail"><i class="icon-info"></i></button></a>
                                              <a class="btn btn-sm btn-light-azure" target="_blank" href="'.base_url().'competency/kinerja_supporting/print_pdf/'.$r->id.'" title="Klik icon ini untuk mencetak form pengajuan"><i class="icon-print"></i></a>';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main->count_all(),
                        "recordsFiltered" => $this->main->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    function print_pdf($id){
         if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }  
        
        $this->load->library('mpdf60/mpdf');
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['form'] = getAll($this->table, array('id'=>'where/'.$id))->row();
        $data['performance'] = getAll($this->table.'_performance', array($this->table.'_id'=>'where/'.$id))->result();
        $data['kompetensi'] = getAll($this->table.'_kompetensi', array($this->table.'_id'=>'where/'.$id))->result();
        $data['kedisiplinan'] = getAll($this->table.'_kedisiplinan', array($this->table.'_id'=>'where/'.$id))->result();
        $data['approver'] = getAll($this->table.'_approver', array($this->table.'_id'=>'where/'.$id));
        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['kode_surat'] = get_no_surat('PKS',$this->table,$id);
        $data['approved'] = './assets/img/approved_stamp.png';
        $data['rejected'] = './assets/img/rejected_stamp.png';
        $data['pending'] = './assets/img/pending_stamp.png';
        if($approver_id != null){
            $f = array($this->table.'_id' => 'where/'.$id,
                       'user_id' => 'where/'.sessId(),
             );
            $data['app_status_id'] = getValue('app_status_id', $this->table.'_approver', $f);
            $data['date_app'] = getValue('date_app', $this->table.'_approver', $f);
            $app = $this->load->view($this->controller.'/app_stat', $data, true);
            // $note = $this->load->view('form_cuti/note', $data, true);
            $note = '';
        }
        $html = $this->load->view('competency/kinerja_supporting/print_pdf',$data, true); 

        // echo $html;
        // die();
        //$html = $this->load->view('pdf_blank', $this->data, true); 
        $this->mpdf = new mPDF();
        //$this->mpdf->showImageErrors = true;
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            0, // margin top
            10, // margin bottom
            10, // margin header(string)
            10); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($id.'-'.$title.'.pdf', 'I');
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

                $this->template->add_css('datatables.min.css');
                $this->template->add_js('core.js');
                $this->template->add_js('datatables.min.js');

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

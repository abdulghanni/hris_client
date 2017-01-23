<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', 0);
class form_kpi extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->library('competency');

        $this->load->database();


        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('form_kpi_model','main');
    }

    var $title = 'Penilaian KPI';
    var $limit = 100000;
    var $controller = 'competency/form_kpi';
    var $table = 'competency_form_kpi';
    var $model_name = 'form_kpi_model';
    var $id_table = 'id';
    var $list_view = 'form_kpi/index';

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
            $data['title'] = "Mapping Standar";
            $data['url_ajax_list'] = site_url('form_kpi/ajax_list');
            $data['url_ajax_add'] = site_url('form_kpi/ajax_add');
            $data['url_ajax_edit'] = site_url('form_kpi/ajax_edit');
            $data['url_ajax_delete'] = site_url('form_kpi/ajax_delete');
            $data['url_ajax_update'] = site_url('form_kpi/ajax_update');
            $data['org'] = $this->competency->get_organization();

            $this->_render_page('form_kpi/index',$data);
        }
    }

    function input($org_id = null, $comp_session_id = null){
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['org_id'] = $org_id;
        $data['comp_session_id'] = $comp_session_id;
        $data['periode'] = getAll('comp_session',array('id'=>'where/'.$comp_session_id));
        $data['approver'] = getAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id));

        /*$data['users'] = get_users_in_org($org_id);*/
        $data['pos'] = $this->competency->get_position_from_org($org_id);

        $data['kpi'] = $indikatorx = GetJoin('competency_mapping_kpi_detail as a','competency_monitoring as b','a.competency_monitoring_id = b.id','LEFT','
            a.id as id, 
            a.organization_id as organization_id, 
            a.position_group_id as position_group_id, 
            a.area_kinerja_utama as area_kinerja_utama, 
            a.kpi as kpi, a.bobot_kpi as bobot_kpi, 
            a.target_kpi as target_kpi, 
            a.sumber_info as sumber_info, 
            a.competency_monitoring_id as competency_monitoring_id,
            a.is_deleted as is_deleted, 
            b.title as competency_monitoring
            ',array('a.organization_id'=>'where/'.$org_id,'a.is_deleted'=>'where/0','a.position_group_id'=>'order/asc'));
        $data['url_ajax_add'] = site_url('competency/form_kpi/ajax_add');
        $data['url_ajax_update'] = site_url('competency/form_kpi/ajax_update');
        $data['url_ajax_edit'] = site_url('competency/form_kpi/ajax_edit');
        $data['url_ajax_delete'] = site_url('competency/form_kpi/ajax_delete');
        $this->_render_page('form_kpi/input', $data);
    }

    function employee($org_id, $comp_session_id, $id)
    {
        permissionBiasa();
        /*$subordinate = getAll('users', array('superior_id'=>'where/'.get_nik($this->session->userdata('user_id'))));
        if($subordinate->num_rows() > 0) {*/
            $data['title'] = $this->title;
            $data['controller'] = $this->controller;
            $data['org_id'] = $org_id;
            $data['comp_session_id'] = $comp_session_id;
            $data['competency_mapping_kpi_detail_id'] = $id;
            $data['periode'] = getAll('comp_session',array('id'=>'where/'.$comp_session_id));
            $mapping_kpi_detail = getAll('competency_mapping_kpi_detail',array('id'=>'where/'.$id,'is_deleted'=>'where/0'));
            $data['approver'] = getAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$id));
            if($mapping_kpi_detail->num_rows() > 0)
            {
                $data['mapping_kpi'] = $mapping_kpi = $mapping_kpi_detail->row_array();
                $data['users'] = $qusers = $this->competency->get_emps_by_pos($mapping_kpi['position_group_id']);
                $kpi_detail = getAll('competency_form_kpi_detail',array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$id,'is_deleted'=>'where/0'));
                if($kpi_detail->num_rows() > 0)
                {
                    $data['kpi_detail'] = $kpi_detail->row_array();
                }else{
                    $data['kpi_detail'] = array();
                }           
            }else{
                $data['mapping_kpi'] = array();
                $data['kpi_detail'] = array();
                $data['users'] = "";
            }
            $data['url_ajax_add'] = site_url('competency/form_kpi/ajax_add');
            $data['url_ajax_update'] = site_url('competency/form_kpi/ajax_update');
            $data['url_ajax_edit'] = site_url('competency/form_kpi/ajax_edit');
            $data['url_ajax_delete'] = site_url('competency/form_kpi/ajax_delete');
            $this->_render_page('form_kpi/employee', $data);
       /* }else{
            $data['message'] = '
                Maaf anda tidak dapat melakukan penilaian, dikarenakan anda tidak mempunyai bawahan.
                <br/>Silakan hubungin HR Pusat / administrator.
                <br/><br/>Terima kasih
            ';
            $this->_render_page('form_kpi/no_subordinate', $data);
        }*/
       
    }

    function input_detail($org_id, $comp_session_id, $id, $user_id)
    {
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['org_id'] = $org_id;
        $data['comp_session_id'] = $comp_session_id;
        $data['competency_mapping_kpi_detail_id'] = $id;
        $data['periode'] = getAll('comp_session',array('id'=>'where/'.$comp_session_id));
        $mapping_kpi_detail = getAll('competency_mapping_kpi_detail',array('id'=>'where/'.$id,'is_deleted'=>'where/0'));
        $data['approver'] = getAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$id,'kpi_user_id'=>'where/'.$user_id));
        if($mapping_kpi_detail->num_rows() > 0)
        {
            $data['mapping_kpi'] = $mapping_kpi = $mapping_kpi_detail->row_array();
            //$data['users'] = $qusers = $this->competency->get_emps_by_pos($mapping_kpi['position_group_id']);
            $data['users'] = $user_id;
            $kpi_detail = getAll('competency_form_kpi_detail',array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$id,'is_deleted'=>'where/0'));
            if($kpi_detail->num_rows() > 0)
            {
                $data['kpi_detail'] = $kpi_detail->row_array();
            }else{
                $data['kpi_detail'] = array();
            }           
        }else{
            $data['mapping_kpi'] = array();
            $data['kpi_detail'] = array();
            $data['users'] = "";
        }
        $data['url_ajax_add'] = site_url('competency/form_kpi/ajax_add');
        $data['url_ajax_update'] = site_url('competency/form_kpi/ajax_update');
        $data['url_ajax_edit'] = site_url('competency/form_kpi/ajax_edit');
        $data['url_ajax_delete'] = site_url('competency/form_kpi/ajax_delete');
        $this->_render_page('form_kpi/input_detail', $data);
    }

    function edit_detail($org_id, $comp_session_id, $id,$kpi_detail_id, $user_id)
    {
        permissionBiasa();
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['org_id'] = $org_id;
        $data['comp_session_id'] = $comp_session_id;
        $data['competency_mapping_kpi_detail_id'] = $id;
        $data['periode'] = getAll('comp_session',array('id'=>'where/'.$comp_session_id));
        $mapping_kpi_detail = getAll('competency_mapping_kpi_detail',array('id'=>'where/'.$id,'is_deleted'=>'where/0'));
        $data['approver'] = getAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$id));
        if($mapping_kpi_detail->num_rows() > 0)
        {
            $data['mapping_kpi'] = $mapping_kpi = $mapping_kpi_detail->row_array();
            //$data['users'] = $qusers = $this->competency->get_emps_by_pos($mapping_kpi['position_group_id']);
            $data['users'] = $user_id;
            $kpi_detail = getAll('competency_form_kpi_detail',array('organization_id'=>'where/'.$org_id,'comp_session_id'=>'where/'.$comp_session_id,'id'=>'where/'.$kpi_detail_id,'is_deleted'=>'where/0'));
            if($kpi_detail->num_rows() > 0)
            {
                $data['kpi_detail'] = $kpi_detail->row_array();
            }else{
                $data['kpi_detail'] = array();
            }           
        }else{
            $data['mapping_kpi'] = array();
            $data['kpi_detail'] = array();
            $data['users'] = "";
        }
        $data['url_ajax_add'] = site_url('competency/form_kpi/ajax_add');
        $data['url_ajax_update'] = site_url('competency/form_kpi/ajax_update');
        $data['url_ajax_edit'] = site_url('competency/form_kpi/ajax_edit');
        $data['url_ajax_delete'] = site_url('competency/form_kpi/ajax_delete');
        $this->_render_page('form_kpi/edit_detail', $data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'organization_id' => $this->input->post('org_id'),
                'position_group_id' => $this->input->post('position_group_id'),
                'area_kinerja_utama' => $this->input->post('area_kinerja_utama'),
                'kpi' => $this->input->post('kpi'),
                'bobot_kpi' => $this->input->post('bobot_kpi'),
                'target_kpi' => $this->input->post('target_kpi'),
                'sumber_info' => $this->input->post('sumber_info'),
                'competency_monitoring_id' => $this->input->post('competency_monitoring_id'),
                'created_on' => date('Y-m-d H:i:s', now()),
                'created_by' => GetUserID()
                );
        $insert = $this->main->save($data);

        //$get_detail = GetAll('competency_form_kpi_detail', array('organization_id'=>'where/'.$this->input->post('org_id')));
        $get_detail = GetJoin('competency_form_kpi_detail as a','competency_monitoring as b','a.competency_monitoring_id = b.id','LEFT','a.id as id, a.organization_id as organization_id, a.position_group_id as position_group_id, a.area_kinerja_utama as area_kinerja_utama, a.kpi as kpi, a.bobot_kpi as bobot_kpi, a.target_kpi as target_kpi, a.sumber_info as sumber_info, a.competency_monitoring_id as competency_monitoring_id, a.is_deleted as is_deleted, b.title as competency_monitoring',array('a.organization_id'=>'where/'.$this->input->post('org_id'),'a.is_deleted'=>'where/0','a.position_group_id'=>'order/asc'));
        $html_detail = "";
        //$html_detail .= '<tr>';
        foreach ($get_detail->result_array() as $key => $value) { 
            $html_detail .= '<tr>';
                $html_detail .= '<td>'.$value['position_group_id'].'</td>';
                $html_detail .= '<td>'.$value['area_kinerja_utama'].'</td>';
                $html_detail .= '<td>'.$value['kpi'].'</td>';
                $html_detail .= '<td>'.$value['bobot_kpi'].'</td>';
                $html_detail .= '<td>'.$value['target_kpi'].'</td>';
                $html_detail .= '<td>'.$value['sumber_info'].'</td>';
                $html_detail .= '<td>'.$value['competency_monitoring'].'</td>';
                $html_detail .= '<td><a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_('.$value['id'].')"><i class="icon-edit"></i> Edit</a>
                                <a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_('.$value['id'].')"><i class="icon-remove"></i> Delete</a></td>';
            $html_detail .= '</tr>';
        }
        
        echo json_encode(array("status" => TRUE,"html_detail" => $html_detail));
    }

    public function ajax_edit($id)
    {
        $data = $this->main->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'organization_id' => $this->input->post('org_id'),
                'position_group_id' => $this->input->post('position_group_id'),
                'area_kinerja_utama' => $this->input->post('area_kinerja_utama'),
                'kpi' => $this->input->post('kpi'),
                'bobot_kpi' => $this->input->post('bobot_kpi'),
                'target_kpi' => $this->input->post('target_kpi'),
                'sumber_info' => $this->input->post('sumber_info'),
                'competency_monitoring_id' => $this->input->post('competency_monitoring_id'),
                'edited_on' => date('Y-m-d H:i:s', now()),
                'edited_by' => GetUserID()
            );
        $this->main->update(array('id' => $this->input->post('id')), $data);
        //echo json_encode(array("status" => TRUE));
        //$get_detail = GetAll('competency_form_kpi_detail', array('organization_id'=>'where/'.$this->input->post('org_id')));
        $get_detail = GetJoin('competency_form_kpi_detail as a','competency_monitoring as b','a.competency_monitoring_id = b.id','LEFT','a.id as id, a.organization_id as organization_id, a.position_group_id as position_group_id, a.area_kinerja_utama as area_kinerja_utama, a.kpi as kpi, a.bobot_kpi as bobot_kpi, a.target_kpi as target_kpi, a.sumber_info as sumber_info, a.competency_monitoring_id as competency_monitoring_id,a.is_deleted as is_deleted,b.title as competency_monitoring',array('a.organization_id'=>'where/'.$this->input->post('org_id'),'a.is_deleted'=>'where/0','a.position_group_id'=>'order/asc'));
        $html_detail = "";
        //$html_detail .= '<tr>';
        foreach ($get_detail->result_array() as $key => $value) { 
            $html_detail .= '<tr>';
                $html_detail .= '<td>'.$value['position_group_id'].'</td>';
                $html_detail .= '<td>'.$value['area_kinerja_utama'].'</td>';
                $html_detail .= '<td>'.$value['kpi'].'</td>';
                $html_detail .= '<td>'.$value['bobot_kpi'].'</td>';
                $html_detail .= '<td>'.$value['target_kpi'].'</td>';
                $html_detail .= '<td>'.$value['sumber_info'].'</td>';
                $html_detail .= '<td>'.$value['competency_monitoring'].'</td>';
                $html_detail .= '<td><a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_('.$value['id'].')"><i class="icon-edit"></i> Edit</a>
                                <a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_('.$value['id'].')"><i class="icon-remove"></i> Delete</a></td>';
            $html_detail .= '</tr>';
        }
        
        echo json_encode(array("status" => TRUE,"html_detail" => $html_detail));
    }

    public function ajax_delete($id)
    {
        $data = array(
                'is_deleted' => 1,
                'deleted_on' => date('Y-m-d H:i:s', now()),
                'deleted_by' => GetUserID()
            );
        $this->main->update(array('id' => $id), $data);
        $org_id = GetValue('organization_id','competency_form_kpi_detail', array('id'=>'where/'.$id));
        $get_detail = GetJoin('competency_form_kpi_detail as a','competency_monitoring as b','a.competency_monitoring_id = b.id','LEFT','a.id as id, a.organization_id as organization_id, a.position_group_id as position_group_id, a.area_kinerja_utama as area_kinerja_utama, a.kpi as kpi, a.bobot_kpi as bobot_kpi, a.target_kpi as target_kpi, a.sumber_info as sumber_info, a.competency_monitoring_id as competency_monitoring_id,a.is_deleted as is_deleted,b.title as competency_monitoring',array('a.organization_id'=>'where/'.$org_id,'a.is_deleted'=>'where/0','a.position_group_id'=>'order/asc'));
        $html_detail = "";
        //$html_detail .= '<tr>';
        foreach ($get_detail->result_array() as $key => $value) { 
            $html_detail .= '<tr>';
                $html_detail .= '<td>'.$value['position_group_id'].'</td>';
                $html_detail .= '<td>'.$value['area_kinerja_utama'].'</td>';
                $html_detail .= '<td>'.$value['kpi'].'</td>';
                $html_detail .= '<td>'.$value['bobot_kpi'].'</td>';
                $html_detail .= '<td>'.$value['target_kpi'].'</td>';
                $html_detail .= '<td>'.$value['sumber_info'].'</td>';
                $html_detail .= '<td>'.$value['competency_monitoring'].'</td>';
                $html_detail .= '<td><a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_('.$value['id'].')"><i class="icon-edit"></i> Edit</a>
                                <a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_('.$value['id'].')"><i class="icon-remove"></i> Delete</a></td>';
            $html_detail .= '</tr>';
        }
        //$html_detail = 'here';
        
        echo json_encode(array("status" => TRUE,"html_detail" => $html_detail));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('position_group_id') == '')
        {
            $data['inputerror'][] = 'position_group_id';
            $data['error_string'][] = 'Jabatan wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('area_kinerja_utama') == '')
        {
            $data['inputerror'][] = 'area_kinerja_utama';
            $data['error_string'][] = 'Area kinerja utama wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('kpi') == '')
        {
            $data['inputerror'][] = 'kpi';
            $data['error_string'][] = 'KPI wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('bobot_kpi') == '')
        {
            $data['inputerror'][] = 'bobot_kpi';
            $data['error_string'][] = 'Bobot KPI wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('target_kpi') == '')
        {
            $data['inputerror'][] = 'target_kpi';
            $data['error_string'][] = 'Target KPI wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('sumber_info') == '')
        {
            $data['inputerror'][] = 'sumber_info';
            $data['error_string'][] = 'Sumber info wajib diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('competency_monitoring_id') == '')
        {
            $data['inputerror'][] = 'competency_monitoring_id';
            $data['error_string'][] = 'Monitoring wajib diisi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function approve($org_id, $approver_id = null){
        permissionBiasa();
        $data['org_id'] = $org_id;
        $data['competency_group'] = GetAll('competency_group')->result();
        $data['data'] = $this->main->standar($org_id);
        $data['approver'] = GetAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id));

        $data['competency_mapping_indikator'] = $indikatorx = GetAll('competency_mapping_indikator_detail', array('organization_id'=>'where/'.$org_id));
        // print_mz($indikatorx->result());
        $indikator = array();
        foreach ($indikatorx->result() as $r) {
            $indikator[] = $r->competency_def_id;
        }

        $data['def_indikator'] = array_unique($indikator);

        $pos = $this->competency->get_position_group_from_org($org_id);
        $pos_group = array();
        foreach ($pos as $key => $value) {
            $pos_group[] = $value['POSITIONGROUP'];
        }

        $data['pos_group'] = $pos_group = array_unique($pos_group);
        $data['pg_size'] = sizeof($pos_group);
        $data['col'] = 70/sizeof($pos_group);

        $data['approval_status'] = GetAll('approval_status', array('is_deleted'=>'where/0'));
        $data['approved'] = assets_url('img/approved_stamp.png');
        $data['rejected'] = assets_url('img/rejected_stamp.png');
        $data['pending'] = assets_url('img/pending_stamp.png');
        $comp_def = array();
        $def = GetAllSelect($this->table.'_detail', 'competency_def_id', array('organization_id'=>'where/'.$org_id))->result_array();
        foreach ($def as $key => $value) {
           $comp_def[] = $value['competency_def_id'];
        }
        // print_mz($comp_def);
        $data['comp_def'] = $comp_def;
        $data['ci'] = $this;
        if($approver_id != null){
            $f = array('organization_id' => 'where/'.$org_id,
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

    function add(){
        permissionBiasa();
        $approver_id = $this->input->post('approver_id');
        $org = $this->input->post('org_id');
        $comp_session_id = $this->input->post('comp_session_id');
        $num_rows = getAll($this->table, array('organization_id'=>'where/'.$org,'comp_session_id'=>'where/'.$comp_session_id))->num_rows();

        // INSERT TO COMPETENCY_form_kpi
        if($num_rows == 0){
            $data = array(
                'organization_id' => $this->input->post('org_id'),
                'comp_session_id' => $this->input->post('comp_session_id'),
                'created_by'=>sessId(),
                'created_on'=>dateNow(),
                );
            $this->db->insert($this->table, $data);
        }else{
        }

        // INSERT TO COMPETENCY_form_kpi_DETAIL
        $num_rows = getAll($this->table.'_detail', array('organization_id'=>'where/'.$org,'comp_session_id'=>'where/'.$comp_session_id,'competency_mapping_kpi_detail_id'=>'where/'.$this->input->post('competency_mapping_kpi_detail_id')))->num_rows();
        
        $counter_rata = 0;
        if($this->input->post('jan') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('feb') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('mar') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('apr') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('may') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('jun') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('jul') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('aug') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('sept') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('oct') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('nov') != 0){
            $counter_rata = $counter_rata + 1;
        }

        if($this->input->post('dece') != 0){
            $counter_rata = $counter_rata + 1;
        }

        $rata = ($this->input->post('jan')+$this->input->post('feb')+$this->input->post('mar')+$this->input->post('apr')+$this->input->post('may')+$this->input->post('jun')+$this->input->post('jul')+$this->input->post('aug')+$this->input->post('sept')+$this->input->post('oct')+$this->input->post('nov')+$this->input->post('dece'))/$counter_rata;
            if($num_rows == 0){
                $data = array(
                    'organization_id' => $this->input->post('org_id'),
                    'comp_session_id' => $this->input->post('comp_session_id'),
                    'user_id' => $this->input->post('user_id'),
                    'competency_mapping_kpi_detail_id' => $this->input->post('competency_mapping_kpi_detail_id'),
                    'kpi' => $this->input->post('kpi'),
                    'target_kpi' => $this->input->post('target_kpi'),
                    'jan' => $this->input->post('jan'),
                    'pencapaian_jan' => $this->input->post('pencapaian_jan'),
                    'feb' => $this->input->post('feb'),
                    'pencapaian_feb' => $this->input->post('pencapaian_feb'),
                    'mar' => $this->input->post('mar'),
                    'pencapaian_mar' => $this->input->post('pencapaian_mar'),
                    'apr' => $this->input->post('apr'),
                    'pencapaian_apr' => $this->input->post('pencapaian_apr'),
                    'may' => $this->input->post('may'),
                    'pencapaian_may' => $this->input->post('pencapaian_may'),
                    'jun' => $this->input->post('jun'),
                    'pencapaian_jun' => $this->input->post('pencapaian_jun'),
                    'jul' => $this->input->post('jul'),
                    'pencapaian_jul' => $this->input->post('pencapaian_jul'),
                    'aug' => $this->input->post('aug'),
                    'pencapaian_aug' => $this->input->post('pencapaian_aug'),
                    'sept' => $this->input->post('sept'),
                    'pencapaian_sept' => $this->input->post('pencapaian_sept'),
                    'oct' => $this->input->post('oct'),
                    'pencapaian_oct' => $this->input->post('pencapaian_oct'),
                    'nov' => $this->input->post('nov'),
                    'pencapaian_nov' => $this->input->post('pencapaian_nov'),
                    'dece' => $this->input->post('dece'),
                    'pencapaian_dece' => $this->input->post('pencapaian_dece'),
                    'rata_rata' => $rata,
                    'keterangan' => $this->input->post('keterangan'),
                    'created_by'=>sessId(),
                    'created_on'=>dateNow(),
                    );
                $this->db->insert($this->table.'_detail', $data);
            }else{
                $data = array(
                    'edited_by'=>sessId(),
                    'edited_on'=>dateNow(),
                    'jan' => $this->input->post('jan'),
                    'pencapaian_jan' => $this->input->post('pencapaian_jan'),
                    'feb' => $this->input->post('feb'),
                    'pencapaian_feb' => $this->input->post('pencapaian_feb'),
                    'mar' => $this->input->post('mar'),
                    'pencapaian_mar' => $this->input->post('pencapaian_mar'),
                    'apr' => $this->input->post('apr'),
                    'pencapaian_apr' => $this->input->post('pencapaian_apr'),
                    'may' => $this->input->post('may'),
                    'pencapaian_may' => $this->input->post('pencapaian_may'),
                    'jun' => $this->input->post('jun'),
                    'pencapaian_jun' => $this->input->post('pencapaian_jun'),
                    'jul' => $this->input->post('jul'),
                    'pencapaian_jul' => $this->input->post('pencapaian_jul'),
                    'aug' => $this->input->post('aug'),
                    'pencapaian_aug' => $this->input->post('pencapaian_aug'),
                    'sept' => $this->input->post('sept'),
                    'pencapaian_sept' => $this->input->post('pencapaian_sept'),
                    'oct' => $this->input->post('oct'),
                    'pencapaian_oct' => $this->input->post('pencapaian_oct'),
                    'nov' => $this->input->post('nov'),
                    'pencapaian_nov' => $this->input->post('pencapaian_nov'),
                    'dece' => $this->input->post('dece'),
                    'pencapaian_dece' => $this->input->post('pencapaian_dece'),
                    'rata_rata' => $rata,
                    'keterangan' => $this->input->post('keterangan'),
                    );
                $this->db->where('organization_id', $org)->where('comp_session_id', $comp_session_id)->update($this->table.'_detail', $data);
            }

        $url = base_url().$this->controller.'/approve/'.$org;
        $subject_email = "Form Penilaian KPI Bulanan";
        $isi_email = get_name(sessId())." Membuat penilaian KPI untuk departemen ".get_organization_name($org).
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
        // INSERT TO COMPETENCY_form_kpi_APPROVER
        if($num_rows > 0)$this->db->where('organization_id', $org)->where('comp_session_id', $comp_session_id)->where('competency_mapping_kpi_detail_id',  $this->input->post('competency_mapping_kpi_detail_id'))->delete($this->table.'_approver');
        if(!empty($approver_id)){
            for ($i=0;$i<sizeof($approver_id);$i++) {
                $data = array(
                    'comp_session_id' => $this->input->post('comp_session_id'),
                    'organization_id' => $this->input->post('org_id'),
                    'competency_mapping_kpi_detail_id' => $this->input->post('competency_mapping_kpi_detail_id'),
                    'kpi_user_id' => $this->input->post('user_id'),
                    'user_id' => $approver_id[$i],
                    'created_by'=>sessId(),
                    'created_on'=>dateNow(),
                );
                $this->db->insert($this->table.'_approver', $data);

                $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => get_nik($approver_id[$i]),
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
                );
                $this->db->insert('email', $data4);
                //if(!empty(getEmail($approver_id[$i])))$this->send_email(getEmail($approver_id[$i]), $subject_email, $isi_email); //hilangkan remark jika ingin sync ke server production
            }
        }
        redirect(base_url($this->controller.'/input/'.$org.'/'.$comp_session_id), 'refresh');
    }

    function update($kpi_detail_id){
        permissionBiasa();
        $approver_id = $this->input->post('approver_id');
        $org = $this->input->post('org_id');
        $comp_session_id = $this->input->post('comp_session_id');
        $num_rows = getAll($this->table, array('organization_id'=>'where/'.$org,'comp_session_id'=>'where/'.$comp_session_id))->num_rows();

        // INSERT TO COMPETENCY_form_kpi
        if($num_rows == 0){
            $data = array(
                'organization_id' => $this->input->post('org_id'),
                'comp_session_id' => $this->input->post('comp_session_id'),
                'created_by'=>sessId(),
                'created_on'=>dateNow(),
                );
            $this->db->insert($this->table, $data);
        }else{
        }

        // INSERT TO COMPETENCY_form_kpi_DETAIL
        $num_rows = getAll($this->table.'_detail', array('organization_id'=>'where/'.$org,'comp_session_id'=>'where/'.$comp_session_id,'id'=>'where/'.$kpi_detail_id))->num_rows();
        $counter_rata = 0;
        if($this->input->post('jan_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_jan = $this->input->post('jan'); 
        }else{
            $tot_jan = 0;
        }

        if($this->input->post('feb_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_feb = $this->input->post('feb'); 
        }
        else{
            $tot_feb = 0;
        }

        if($this->input->post('mar_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_mar = $this->input->post('mar');
        }else{
            $tot_mar = 0;
        }

        if($this->input->post('apr_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_apr = $this->input->post('apr');
        }else{
            $tot_apr = 0;
        }

        if($this->input->post('may_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_may = $this->input->post('may');
        }else{
            $tot_may = 0;
        }

        if($this->input->post('jun_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_jun = $this->input->post('jun');
        }else{
            $tot_jun = 0;
        }

        if($this->input->post('jul_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_jul = $this->input->post('jul');
        }else{
            $tot_jul = 0;
        }

        if($this->input->post('aug_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_aug = $this->input->post('aug');
        }else{
            $tot_aug = 0;
        }

        if($this->input->post('sept_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_sept = $this->input->post('sept');
        }else{
            $tot_sept = 0;
        }

        if($this->input->post('oct_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_oct = $this->input->post('oct');
        }else{
            $tot_oct = 0;
        }

        if($this->input->post('nov_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_nov = $this->input->post('nov');
        }else{
            $tot_nov = 0;
        }

        if($this->input->post('dece_status') != 0){
            $counter_rata = $counter_rata + 1;
            $tot_dece = $this->input->post('dece');
        }else{
            $tot_dece = 0;
        }

        $rata = ($tot_jan+$tot_feb+$tot_mar+$tot_apr+$tot_may+$tot_jun+$tot_jul+$tot_aug+$tot_sept+$tot_oct+$tot_nov+$tot_dece)/$counter_rata;    
            if($num_rows == 0){
                
                $data = array(
                    'organization_id' => $this->input->post('org_id'),
                    'comp_session_id' => $this->input->post('comp_session_id'),
                    'user_id' => $this->input->post('user_id'),
                    'competency_mapping_kpi_detail_id' => $this->input->post('competency_mapping_kpi_detail_id'),
                    'kpi' => $this->input->post('kpi'),
                    'target_kpi' => $this->input->post('target_kpi'),
                    'jan' => $this->input->post('jan'),
                    'pencapaian_jan' => $this->input->post('pencapaian_jan'),
                    'feb' => $this->input->post('feb'),
                    'pencapaian_feb' => $this->input->post('pencapaian_feb'),
                    'mar' => $this->input->post('mar'),
                    'pencapaian_mar' => $this->input->post('pencapaian_mar'),
                    'apr' => $this->input->post('apr'),
                    'pencapaian_apr' => $this->input->post('pencapaian_apr'),
                    'may' => $this->input->post('may'),
                    'pencapaian_may' => $this->input->post('pencapaian_may'),
                    'jun' => $this->input->post('jun'),
                    'pencapaian_jun' => $this->input->post('pencapaian_jun'),
                    'jul' => $this->input->post('jul'),
                    'pencapaian_jul' => $this->input->post('pencapaian_jul'),
                    'aug' => $this->input->post('aug'),
                    'pencapaian_aug' => $this->input->post('pencapaian_aug'),
                    'sept' => $this->input->post('sept'),
                    'pencapaian_sept' => $this->input->post('pencapaian_sept'),
                    'oct' => $this->input->post('oct'),
                    'pencapaian_oct' => $this->input->post('pencapaian_oct'),
                    'nov' => $this->input->post('nov'),
                    'pencapaian_nov' => $this->input->post('pencapaian_nov'),
                    'dece' => $this->input->post('dece'),
                    'pencapaian_dece' => $this->input->post('pencapaian_dece'),
                    'jan_status' => $this->input->post('jan_status'),
                    'feb_status' => $this->input->post('feb_status'),
                    'mar_status' => $this->input->post('mar_status'),
                    'apr_status' => $this->input->post('apr_status'),
                    'may_status' => $this->input->post('may_status'),
                    'jun_status' => $this->input->post('jun_status'),
                    'jul_status' => $this->input->post('jul_status'),
                    'aug_status' => $this->input->post('aug_status'),
                    'sept_status' => $this->input->post('sept_status'),
                    'oct_status' => $this->input->post('oct_status'),
                    'nov_status' => $this->input->post('nov_status'),
                    'dece_status' => $this->input->post('dece_status'),
                    'rata_rata' => $rata,
                    'keterangan' => $this->input->post('keterangan'),
                    'created_by'=>sessId(),
                    'created_on'=>dateNow(),
                    );
                $this->db->insert($this->table.'_detail', $data);
            }else{
                $data = array(
                    'edited_by'=>sessId(),
                    'edited_on'=>dateNow(),
                    'jan' => $this->input->post('jan'),
                    'pencapaian_jan' => $this->input->post('pencapaian_jan'),
                    'feb' => $this->input->post('feb'),
                    'pencapaian_feb' => $this->input->post('pencapaian_feb'),
                    'mar' => $this->input->post('mar'),
                    'pencapaian_mar' => $this->input->post('pencapaian_mar'),
                    'apr' => $this->input->post('apr'),
                    'pencapaian_apr' => $this->input->post('pencapaian_apr'),
                    'may' => $this->input->post('may'),
                    'pencapaian_may' => $this->input->post('pencapaian_may'),
                    'jun' => $this->input->post('jun'),
                    'pencapaian_jun' => $this->input->post('pencapaian_jun'),
                    'jul' => $this->input->post('jul'),
                    'pencapaian_jul' => $this->input->post('pencapaian_jul'),
                    'aug' => $this->input->post('aug'),
                    'pencapaian_aug' => $this->input->post('pencapaian_aug'),
                    'sept' => $this->input->post('sept'),
                    'pencapaian_sept' => $this->input->post('pencapaian_sept'),
                    'oct' => $this->input->post('oct'),
                    'pencapaian_oct' => $this->input->post('pencapaian_oct'),
                    'nov' => $this->input->post('nov'),
                    'pencapaian_nov' => $this->input->post('pencapaian_nov'),
                    'dece' => $this->input->post('dece'),
                    'pencapaian_dece' => $this->input->post('pencapaian_dece'),
                    'jan_status' => $this->input->post('jan_status'),
                    'feb_status' => $this->input->post('feb_status'),
                    'mar_status' => $this->input->post('mar_status'),
                    'apr_status' => $this->input->post('apr_status'),
                    'may_status' => $this->input->post('may_status'),
                    'jun_status' => $this->input->post('jun_status'),
                    'jul_status' => $this->input->post('jul_status'),
                    'aug_status' => $this->input->post('aug_status'),
                    'sept_status' => $this->input->post('sept_status'),
                    'oct_status' => $this->input->post('oct_status'),
                    'nov_status' => $this->input->post('nov_status'),
                    'dece_status' => $this->input->post('dece_status'),
                    'rata_rata' => $rata,
                    'keterangan' => $this->input->post('keterangan'),
                    );
                $this->db->where('organization_id', $org)->where('comp_session_id', $comp_session_id)->where('id',$kpi_detail_id)->update($this->table.'_detail', $data);
            }

        $url = base_url().$this->controller.'/approve/'.$org;
        $subject_email = "Form Penilaian KPI Bulanan";
        $isi_email = get_name(sessId())." Membuat penilaian KPI untuk ".get_name(get_nik($this->input->post('user_id')))." dari departemen ".get_organization_name($org).
                     "<br/>Untuk melihat detail silakan <a href=$url>Klik disini</a>";
                     
        // INSERT TO COMPETENCY_form_kpi_APPROVER
        if($num_rows > 0)$this->db->where('organization_id', $org)->where('comp_session_id', $comp_session_id)->where('competency_mapping_kpi_detail_id',  $this->input->post('competency_mapping_kpi_detail_id'))->delete($this->table.'_approver');
        if(!empty($approver_id)){
            for ($i=0;$i<sizeof($approver_id);$i++) {
                $data = array(
                    'comp_session_id' => $this->input->post('comp_session_id'),
                    'organization_id' => $this->input->post('org_id'),
                    'competency_mapping_kpi_detail_id' => $this->input->post('competency_mapping_kpi_detail_id'),
                    'kpi_user_id' => $this->input->post('user_id'),
                    'user_id' => $approver_id[$i],
                    'created_by'=>sessId(),
                    'created_on'=>dateNow(),
                );
                $this->db->insert($this->table.'_approver', $data);

                $data4 = array(
                  'sender_id' => get_nik(sessId()),
                  'receiver_id' => get_nik($approver_id[$i]),
                  'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                  'subject' => $subject_email,
                  'email_body' => $isi_email,
                  'is_read' => 0,
                );
                $this->db->insert('email', $data4);
                // if(!empty(getEmail($approver_id[$i])))$this->send_email(getEmail($approver_id[$i]), $subject_email, $isi_email); //hilangkan remark jika akan upload ke server production
            }
        }
        redirect(base_url($this->controller.'/input/'.$org.'/'.$comp_session_id), 'refresh');
    }

    // FOR js
    function do_approve($org_id){
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

            $this->db->where('organization_id', $org_id)
                     ->where('user_id', $sessId)
                     ->update($this->table.'_approver', $data);
            return true;
        }
    }
    
    function get_organization(){
        if($this->ion_auth->is_admin())
        {
            $data['org'] = $this->competency->get_organization();
        }else{
            $data['org'] = $this->competency->get_login_organization(get_nik($this->session->userdata('user_id')));
        }
        
        $this->load->view('form_kpi/org',$data);
     }

     function get_periode(){
        $data['periode'] = $this->main->get_periode();
        $this->load->view('form_kpi/periode',$data);
     }

    function get_mapping_from_org($org_id,$comp_session_id){
        $data['org_id'] = $org_id;
        $f = array('is_deleted'=>'where/0');

        $data['approver'] = GetAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id, 'comp_session_id'=>'where/'.$comp_session_id));
        $data['data'] = $this->main->standar($org_id,$comp_session_id);
        $data['org_id'] = $org_id;
        $data['comp_session_id'] = $comp_session_id;
        
        $data['users'] = get_user_in_org($org_id);

        $data['pos'] = $this->competency->get_position_from_org($org_id);

        $data['ci'] = $this;
        $this->load->view('form_kpi/result', $data);
    }

    function get_kpi($org_id,$comp_session_id){
        $data['org_id'] = $org_id;
        $f = array('is_deleted'=>'where/0');

        $data['approver'] = GetAll($this->table.'_approver', array('organization_id'=>'where/'.$org_id, 'comp_session_id'=>'where/'.$comp_session_id));
        $data['data'] = $this->main->get_kpi_detail($org_id,$comp_session_id);
        $data['org_id'] = $org_id;
        $data['comp_session_id'] = $comp_session_id;
        
        $data['users'] = get_user_in_org($org_id);

        $data['pos'] = $this->competency->get_position_from_org($org_id);

        $data['ci'] = $this;
        $this->load->view('form_kpi/ ', $data);
    }


    function _render_page($view, $data=null, $render=false)
    {

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if (in_array($view, array('form_kpi/index')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/form_kpi.js');
                    
            }elseif (in_array($view, array('form_kpi/input','form_kpi/input_detail','form_kpi/edit_detail','form_kpi/employee')))
            {
                $this->template->set_layout('default');
                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');

                $this->template->add_js('core.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');

                $this->template->add_js('competency/form_kpi_input.js');
                    
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

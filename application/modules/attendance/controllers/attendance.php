<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance extends MX_Controller {
	
	var $filename = "attendance";
	var $tabel = "view_att";
	var $id_primary = "id";
	var $title = "Data Kehadiran";
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('authentication', NULL, 'ion_auth');
		$this->lang->load('auth');
	}
	
	function index($nik="nik", $bulan = "bln", $tahun = "thn", $sort_by = "id", $sort_order = "asc", $limit=10, $offset = 0)
  {
  	
    $webmaster_id = permissionBiasa();
	$dt_temp = date("d");
	//$dt_temp = date("d", mktime(1, 1, 1, date("m"), date("d")-1, date("Y")));
    $this->baca_cron($dt_temp, date("m"), date("Y"));
    if(!$this->ion_auth->is_admin()) $nik="nik".GetValue("nik", "users", array("id"=> "where/".$webmaster_id));
    $data['segment'] = $this->uri->segment(7);
		$data['path_file'] = 'attendance';
		$data['main_content'] = 'attendance';
		$data['filename'] = $this->filename;
		$data['title'] = $this->title;
		
		//Search
		$filter=array();
		$s_nik = substr($nik,3);
		if($s_nik) $filter['nik'] = "where/".$s_nik;
		$data['s_nik'] = $s_nik;
		
		$s_bulan = substr($bulan,3);
		if($s_bulan) $filter['bulan'] = "where/".$s_bulan;
		$data['s_bulan'] = $s_bulan;
		
		$s_tahun = substr($tahun,3);
		if($s_tahun) $filter['tahun'] = "where/".$s_tahun;
		$data['s_tahun'] = $s_tahun;
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$data['limit'] = $limit = (strlen($this->input->post('limit')) > 0) ? $this->input->post('limit') : $limit;
    	$path_paging = base_url().$this->filename.'/index/nik'.$data['s_nik'].'/bln'.$data['s_bulan'].'/thn'.$data['s_tahun'].'/'.$sort_by.'/'.$sort_order.'/'.$limit.'/';
		$uri_segment = 8;
		$data['offset'] = $offset = $this->uri->segment($uri_segment);
    
		$data['rekap_all'] = GetAll($this->tabel, $filter);
		$filter[$sort_by] = "order/".$sort_order;
		$filter["limit"] = $offset."/".$limit;
		$data['rekap'] = GetAll($this->tabel, $filter);
		//lastq();
		$data['rekap_hadir'] = array("total"=> 0, "hadir"=> 0, "terlambat"=> 0, "cuti"=> 0, "ijin"=> 0, "sakit"=> 0, "alpa"=> 0, "off"=> 0);
		foreach($data['rekap_all']->result_array() as $r) {
			if($r['jh']) $data['rekap_hadir']['hadir']++;
			if($r['terlambat']) $data['rekap_hadir']['terlambat']++;
			if($r['ijin']) $data['rekap_hadir']['ijin']++;
			if($r['sakit']) $data['rekap_hadir']['sakit']++;
			if($r['cuti']) $data['rekap_hadir']['cuti']++;
			if($r['alpa']) $data['rekap_hadir']['alpa']++;
			if($r['off']) $data['rekap_hadir']['off']++;
			$data['rekap_hadir']['total']++;
		}					
		
    //Page
		$pagination = MzPage($data['rekap_all']->num_rows(),$limit,$offset,$path_paging,$uri_segment);
		if(!$pagination) $pagination = "<strong>1</strong>";
		$data['halaman'] = $pagination;
		//End Page

    $this->_render_page('attendance/'.$data['main_content'], $data);
  }
	
	function search(){
		$nik = $this->input->post('nik');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		
		redirect(site_url($this->filename.'/index/nik'.$nik.'/bln'.$bulan.'/thn'.$tahun));
	}
	
	function detail($id=0,$flag=NULL)
	{
		//Set Global
		permissionBiasa();
		$data['path_file'] = $this->filename;
		$data['main_content'] = $data['path_file'].'_form';
		$data['filename'] = $this->filename;
		$data['title'] = $this->title;
		if($id > 0) $data['val_button'] = lang("edit");
		else $data['val_button'] = lang("add");
		//End Global
		
		$q = GetAll($this->tabel, array("id"=> "where/".$id));
		$r = $q->result_array();
		if($q->num_rows() > 0) $data['val'] = $r[0];
		else $data['val'] = array();
		
		if($q->num_rows() > 0)
		{
			//if($data['val']['cuti'] > 0) $data['dis_sampai_tanggal'] = "display:''";
			//else 
			$data['dis_sampai_tanggal'] = "display:none";
		}
		else $data['dis_sampai_tanggal'] = "display:none";
		
		$data['opt_users'] = GetOptUsers();
		$this->_render_page('attendance/'.$data['main_content'], $data);
	}
	
	function update()
	{
		permission();
		$webmaster_id = $this->session->userdata('user_id');
		$id = $this->input->post('id');
		$user = $this->input->post('nik');
		$data['nik'] = $user;
		$data['jhk'] = $this->input->post('jhk');
		$data['sakit']=$data['cuti']=$data['ijin']=$data['alpa']=$data['off']=$data['potong_gaji']=$data['pc']=$data['jh']=$data['hr']=$data['lembur']=0;
		$data['terlambat']=$data['opname']=$data['opname_istirahat']=$data['kecelakaan_kerja']=0;
		$absen = $this->input->post('absen');
		if($absen) {
		 $data[$absen] = 1;
		 if($absen=="terlambat") $data["jh"] = 1;
		} else $data["jh"] = 1;
		$tgl = $this->input->post('tgl');
		$exp = explode("/", $tgl);
		$data['tanggal'] = $exp[1];
		$data['bulan'] = $exp[0];
		$data['tahun'] = $exp[2];
		
		$data['scan_masuk'] = $this->input->post("scan_masuk");
		$data['scan_pulang'] = $this->input->post("scan_pulang");
		//$data['plg_cepat'] = $this->input->post("plg_cepat");
		
		$data['keterangan'] = $this->input->post('keterangan');
		
		$data['modify_date'] = date("Y-m-d H:i:s");

		if($id > 0)
		{
			$data['modify_user_id'] = $webmaster_id;
			$this->db->where($this->id_primary, $id);
			$this->db->update("attendance", $data);
			
			//Admin Log
			//$logs = $this->db->last_query();
			//$this->model_admin_all->LogActivities($webmaster_id,$this->tabel,$this->db->insert_id(),$logs,lang($this->filename),$data[$this->title_table],$this->filename,"Add");
			
			//$this->session->set_flashdata("message", lang('edit')." ".$this->title." ".lang('msg_sukses'));
		}
		else
		{
			$data['create_user_id'] = $webmaster_id;
			$data['create_date'] = $data['modify_date'];
			$this->db->insert("attendance", $data);
			$id = $this->db->insert_id();
			//Admin Log
			//$logs = $this->db->last_query();
			//$this->model_admin_all->LogActivities($webmaster_id,$this->tabel,$this->db->insert_id(),$logs,lang($this->filename),$data[$this->title_table],$this->filename,"Add");
			
			//$this->session->set_flashdata("message", lang('add')." ".$this->title." ".lang('msg_sukses'));
		}
		
		redirect($this->filename."/index");
	}
	
	function _render_page($view, $data=null, $render=false)
  {
      // $this->viewdata = (empty($data)) ? $this->data: $data;
      // $view_html = $this->load->view($view, $this->viewdata, $render);
      // if (!$render) return $view_html;
      $data = (empty($data)) ? $this->data : $data;
      if ( ! $render)
      {
        $this->load->library('template');
        $this->template->set_layout('default');
        if (!empty($data['title']))
        {
         	$this->template->set_title($data['title']);
        }
        
        $this->template->add_css('bootstrap-timepicker.css');
		$this->template->add_js('jquery-ui-1.10.1.custom.min.js');
		$this->template->add_js('jquery.sidr.min.js');
		$this->template->add_js('breakpoints.js');
		$this->template->add_js('select2.min.js');
		//$this->template->add_js('persondetail.js');
		$this->template->add_js('core.js');
		$this->template->add_js('bootstrap-datepicker.js');
		$this->template->add_js('jquery.animateNumbers.js');
		$this->template->add_js('jqueryblockui.js');

		$this->template->add_css('jquery-ui-1.10.1.custom.min.css');
		$this->template->add_css('plugins/select2/select2.css');
		$this->template->add_css('datepicker.css');
				
        $this->template->load_view($view, $data);
      }
      else
      {
          return $this->load->view($view, $data, TRUE);
      }
  }
  
  function baca_cron($tglz=NULL, $blnz=NULL, $thnz=NULL)
	{
		if(!$tglz) $tglz = date("d");
		if(strlen($tglz)==1) $tglz="0".$tglz;
		if(!$blnz) $blnz = date("m");
		if(!$thnz) $thnz = date("Y");
		$create_date=date("Y-m-d H:i:s");
		$temp=$temp_key="";
		$absen=array();
		//LEFT join untuk yg di cron karena mencatat ALPA, klo disini INNER join
		$sql = GetJoin("users", "tadat", "users.mchID=tadat.mchID AND DAY(tgl)='".$tglz."' AND MONTH(tgl)='".$blnz."' AND YEAR(tgl)='".$thnz."'", "inner", "users.mchID as nik_emp, tadat.*", array("nik_emp"=> "order/asc", "tgl"=> "order/asc"));
		//lastq();
		foreach($sql->result_array() as $r) {
			$cardno=$r['nik_emp'];
			if($temp != $cardno)
			{
				if($temp) $absen[$temp_key]['keluar'] = $last_data;
				$absen[$cardno]['masuk'] = substr($r['tgl'],11);
				$temp = $cardno;
				$temp_key=$cardno;
			}
			$last_data= substr($r['tgl'],11);
		}
		if($temp) $absen[$cardno]['keluar'] = $last_data;
		
		//print_mz($absen);
		foreach($absen as $id_nik=> $r)
		{
			$masuk=$r['masuk'];
			$keluar=$r['keluar'];
			if($masuk==$keluar) $keluar="";
			$cek_hadir = GetValue("id", "attendance", array("nik"=> "where/".$id_nik, "tanggal"=> "where/".$tglz, "bulan"=> "where/".$blnz, "tahun"=> "where/".$thnz));
			if(!$cek_hadir) {
				$jh=$alpa=$telat=0;
				//$jadwal = strtoupper(GetValue("tgl_".intval($tglz), "jadwal_shift", array("bulan"=> "where/".$blnz, "tahun"=> "where/".$thnz, "id_employee"=> "where/".$id_employee)));
				if($masuk) {
					$cek_jam=intval(substr($masuk,0,2));
					$cek_menit=substr($masuk,3,2);
					$jam_menit = $cek_jam.$cek_menit;
					$jh=1;
					//if(($jadwal) == "NS" && $jam_menit >= 901) $telat=1;
					//else 
					if($jam_menit >= 901) $telat=1;
				} else {
					$alpa=1;
				}
				
				$data = array("nik"=> $id_nik, "jhk"=> 1, "jh"=> $jh, "alpa"=> $alpa, "terlambat"=> $telat, "tanggal"=> $tglz, "bulan"=> $blnz, "tahun"=> $thnz,
				"scan_masuk"=> $masuk, "scan_pulang"=> $keluar, "create_date"=> $create_date);
				$this->db->insert("attendance", $data);
			} else {
				$data = array("scan_masuk"=> $masuk, "scan_pulang"=> $keluar, "modify_date"=> $create_date);
				$this->db->where("id", $cek_hadir);
				$this->db->update("attendance", $data);
			}
		}
	}
	
	function baca_dbf()
	{
		$filez = './uploads/urut.DBF';
		$dbf = dbase_open($filez, 0);
		$column_info = dbase_get_header_info($dbf);
		$loop = dbase_numrecords($dbf);
		for($i=1;$i<=$loop;$i++)
		{
			$row = dbase_get_record_with_names($dbf,$i);
			$data = array("nik"=> $row['ID'], "mchID"=> $row['IDABS']);
			$this->db->insert("mchID", $data);
			//echo $row['ID']."/".$row['IDABS']."<br>";
			
		}
		die();	
	}

	function task_cron() 
	{
		$tanggal=date("d");
		$bulan=date("m");
		$tahun=date("Y");
		
		$this->baca_cron($tanggal, $bulan, $tahun);
		
		$sql = "select * from users where mchID > 0 AND active='1' AND mchID not in (select nik from attendance where tanggal='".$tanggal."' AND bulan='".$bulan."' AND tahun='".$tahun."')";
		
		$q = $this->db->query($sql);
		foreach($q->result_array() as $r)
		{
			$sql_absen = "INSERT INTO attendance set nik='".$r['mchID']."',
							jhk='1', sakit='0', alpa='1', pc='0', cuti='0', jh='0',
							ijin='0', tanggal='".$tanggal."', bulan='".$bulan."', tahun='".$tahun."',
							scan_masuk='', scan_pulang='',
							terlambat='0', plg_cepat='0',
							lembur='0', jam_kerja='0', keterangan='',
							modify_user_id='1', modify_date='".date("Y-m-d H:i:s")."',
							create_user_id='1', create_date='".date("Y-m-d H:i:s")."'";
			$this->db->query($sql_absen);
		}
	}

}
?>
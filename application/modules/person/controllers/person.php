<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();
        $this->load->model('person_model');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $filter = array();
            $query_options = GetAll('users',$filter);
            $this->data['user_all'] = ($query_options->num_rows() > 0 ) ? $query_options : array();
 
            $this->_render_page('person/index', $this->data);
        }
    }

    function keywords()
    {
        $keyword = $this->input->post('first_name');
        $id = $this->uri->segment(3, 0);

        redirect(base_url()."person/detail/".$id);
    }

    function detail($id)
    {
        
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif ($id != $this->session->userdata('user_id') && !$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You can not view this page.');
        }
        else
        {
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$user = $this->person_model->getUsers($id)->row();

	 	$url = get_api_key().'users/employement/EMPLID/'.$user->nik.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getuser_info = file_get_contents($url);
            $user_info = json_decode($getuser_info, true);
            $this->data['user_info'] = $user_info;
        }

        //employee identity
		$this->data['id'] = $user->id;
        $this->data['nik'] = (!empty($user->nik)) ? $user->nik : '-';
        $this->data['bod'] = (!empty($user->bod)) ? $user->bod : '-';
        $this->data['is_birthday_reminder'] = $user->is_birthday_reminder;
        $this->data['first_name'] = (!empty($user->first_name)) ? $user->first_name : '';
        $this->data['last_name'] = (!empty($user->last_name)) ? $user->last_name : '';
        $this->data['business_unit'] = (!empty($user->organization_title)) ? $user->organization_title : '';
        $this->data['marital'] = (!empty($user->marital_title)) ? $user->marital_title : '';
        $this->data['phone'] = (!empty($user->phone)) ? $user->phone : '';
        $this->data['email'] = (!empty($user->email)) ? $user->email : '';
        $this->data['previous_email'] = (!empty($user->previous_email)) ? $user->previous_email : '';
        $this->data['bb_pin'] = (!empty($user->bb_pin)) ? $user->bb_pin : ''; 
        $this->data['photo'] = (!empty($user->photo)) ? $user->photo : '';
        $this->data['s_kk'] = $this->form_validation->set_value('kk', $user->scan_kk);
        $this->data['s_akta'] = $this->form_validation->set_value('akta', $user->scan_akta); 
        $user_folder = $user->id.$user->first_name;
        $this->data['u_folder'] = $user_folder;

		$url = get_api_key().'users/course/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getcourse = file_get_contents($url);
			$course = json_decode($getcourse, true);
			$this->data['course'] = $course;
		} 

		$url = get_api_key().'users/certificate/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getcertificate = file_get_contents(get_api_key().'users/certificate/EMPLID/'.$user->nik.'/format/json');
			$certificate = json_decode($getcertificate, true);
			$this->data['certificate'] = $certificate;
		}

		$url = get_api_key().'users/award/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getaward = file_get_contents(get_api_key().'users/award/EMPLID/'.$user->nik.'/format/json');
			$award = json_decode($getaward, true);
			$this->data['award'] = $award;
		}
			
		//Education Tab API
		
		$url = get_api_key().'users/education/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$geteducation = file_get_contents(get_api_key().'users/education/EMPLID/'.$user->nik.'/format/json');
			$education = json_decode($geteducation, true);
			$this->data['education'] = $education;
		}
			
		//Experience Tab API
		
		$url = get_api_key().'users/experience/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getexperience = file_get_contents(get_api_key().'users/experience/EMPLID/'.$user->nik.'/format/json');
			$experience = json_decode($getexperience, true);
			$this->data['experience'] = $experience;
		}
			
		//SK Tab API
		$url = get_api_key().'users/sk/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getsk = file_get_contents(get_api_key().'users/sk/EMPLID/'.$user->nik.'/format/json');
			$sk = json_decode($getsk, true);
			$this->data['sk'] = $sk;
		}
		
		//STI Tab API
		$url = get_api_key().'users/sti/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getsti = file_get_contents(get_api_key().'users/sti/EMPLID/'.$user->nik.'/format/json');
			$sti = json_decode($getsti, true);
			$this->data['sti'] = $sti;
		}
			
		//Riwayat_jabatan Tab API

		$url = get_api_key().'users/jabatan/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getjabatan = file_get_contents(get_api_key().'users/jabatan/EMPLID/'.$user->nik.'/format/json');
			$jabatan = json_decode($getjabatan, true);
			$this->data['jabatan'] = $jabatan;
		}
			
		//Ikatan_Dinas Tab API
		$url = get_api_key().'users/ikatan_dinas/EMPLID/'.$user->nik.'/format/json';
		$headers = get_headers($url);
		$response = substr($headers[0], 9, 3);
		if ($response != "404") {
			$getikatan_dinas = file_get_contents(get_api_key().'users/ikatan_dinas/EMPLID/'.$user->nik.'/format/json');
			$ikatan_dinas = json_decode($getikatan_dinas, true);
			$this->data['ikatan_dinas'] = $ikatan_dinas;
		}

        //Tab Inventaris

        $i =$this->db->select('users_inventory_exit.id as id, users_inventory_exit.is_available, users_inventory_exit.note, inventory.title as title')->from('users_inventory_exit')->join('inventory', 'users_inventory_exit.inventory_id = inventory.id', 'left')->where('users_inventory_exit.user_id', $id)->get();
        $this->data['users_inventory'] = $i;

		$this->data['aviva'] = (!empty($user_info['AVIVA'])) ? $user_info['AVIVA'] : '-';
        $this->data['bpjs_kerja'] = (!empty($user_info['JAMSOSTEK'])) ? $user_info['JAMSOSTEK'] : '-';
        $this->data['ktp'] = (!empty($user_info['KTP'])) ? $user_info['KTP'] : '-';
        $this->data['ktp_valid_date'] = (!empty($user_info['KTPVALIDDATE'])) ? $user_info['KTPVALIDDATE'] : '-';
        $this->data['npwp'] = (!empty($user_info['NPWP'])) ? $user_info['NPWP'] : '-';
        $this->data['tax'] = (!empty($user_info['TAX'])) ? $user_info['TAX'] : '-';
        $this->data['bpjs_kesehatan'] = (!empty($user_info['BPJS'])) ? $user_info['BPJS'] : '-';
        $this->data['bpjs_date'] = (!empty($user_info['BPJS'])) ? $user_info['BPJSDATE'] : '-';
        $this->data['bumida'] = (!empty($user_info['BUMIDA'])) ? $user_info['BUMIDA'] : '-';
        $this->data['bumida_date'] = (!empty($user_info['BPJS'])) ? $user_info['BUMIDADATE'] : '-';
		$this->data['seniority_date'] = (!empty($user_info['SENIORITYDATE'])) ? $user_info['SENIORITYDATE'] : '-';
        $this->data['position'] = (!empty($user_info['POSITION'])) ? $user_info['POSITION'] : '-';
        $this->data['organization'] = (!empty($user_info['ORGANIZATION'])) ? $user_info['ORGANIZATION'] : '-';
        $this->data['bu'] = (!empty($user_info['BU'])) ? $user_info['BU'] : '-';
        $this->data['empl_status'] = (!empty($user_info['EMPLOYEESTATUS'])) ? $user_info['EMPLOYEESTATUS'] : '-';
        $this->data['employee_status'] = (!empty($user_info['STATUS'])) ? $user_info['STATUS'] : '-';
        $this->data['cost_center'] = (!empty($user_info['COSTCENTER'])) ? $user_info['COSTCENTER'] : '-';
        $this->data['position_group'] = (!empty($user_info['POSITIONGROUP'])) ? $user_info['POSITIONGROUP'] : '-';
        $this->data['grade'] = (!empty($user_info['GRADE'])) ? $user_info['GRADE'] : '-';
        $this->data['resign_reason'] = (!empty($user_info['RESIGNREASONCODEID'])) ? $user_info['RESIGNREASONCODEID'] : '-';
        $this->data['active_inactive'] = (!empty($user_info['ACTIVEINACTIVE'])) ? $user_info['ACTIVEINACTIVE'] : '-';
		$this->data['s_photo'] = $this->form_validation->set_value('photo', $user->photo);
        $user_folder = $user->id.$user->first_name;
        $this->data['u_folder'] = $user_folder;
		
		//Mazhters
		$dt_temp = date("d");
		//$dt_temp = date("d", mktime(1, 1, 1, date("m"), date("d")-1, date("Y")));
		$this->baca_cron($dt_temp, date("m"), date("Y"));
		$mchID = GetValue("mchID", "users", array("id"=> "where/".$id));
		$q = GetAll("view_att", array("mchID"=> "where/".$mchID));
		$this->data['rekap_hadir'] = array("total"=> 0, "hadir"=> 0, "terlambat"=> 0, "cuti"=> 0, "ijin"=> 0, "sakit"=> 0, "alpa"=> 0, "off"=> 0);
		foreach($q->result_array() as $r) {
			if($r['jh'] || $r['terlambat']) $this->data['rekap_hadir']['hadir']++;
			if($r['terlambat']) $this->data['rekap_hadir']['terlambat']++;
			if($r['ijin']) $this->data['rekap_hadir']['ijin']++;
			if($r['sakit']) $this->data['rekap_hadir']['sakit']++;
			if($r['cuti']) $this->data['rekap_hadir']['cuti']++;
			if($r['alpa']) $this->data['rekap_hadir']['alpa']++;
			if($r['off']) $this->data['rekap_hadir']['off']++;
			$this->data['rekap_hadir']['total']++;
		}
		if($this->data['rekap_hadir']['hadir']!=0){
			$this->data['persen_hadir'] = (number_format($this->data['rekap_hadir']['hadir'] / $this->data['rekap_hadir']['total'] * 100,1)!=0)?number_format($this->data['rekap_hadir']['hadir'] / $this->data['rekap_hadir']['total'] * 100,1):$this->data['rekap_hadir']['hadir'] ;
			$this->data['persen_terlambat'] = number_format($this->data['rekap_hadir']['terlambat'] / $this->data['rekap_hadir']['total'] * 100,1);
		}else{
			$this->data['persen_hadir'] = 0;
			$this->data['persen_terlambat'] = 0;
		}
		//End Mazhters
        if(date("m-d")!==date('m-d',strtotime($user->bod)) && $user->is_birthday_reminder == 1) $this->db->query("update users set is_birthday_reminder = 0 where id = $id");
        $this->_render_page('person/detail', $this->data);
        }
    }
	
    function update_bd_reminder()
    {
        $id = $this->input->post('id');
        $data = array('is_birthday_reminder' => 1, );
        $this->db->where('id', $id)->update('users', $data);
    }

	function cekNik($array, $key, $val) {
    foreach ($array as $item)
        if (isset($item[$key]) && $item[$key] == $val)
            return true;
    return false;
	}

    function _get_csrf_nonce()
        {
            $this->load->helper('string');
            $key   = random_string('alnum', 8);
            $value = random_string('alnum', 20);
            $this->session->set_flashdata('csrfkey', $key);
            $this->session->set_flashdata('csrfvalue', $value);

            return array($key => $value);
        }

        function _valid_csrf_nonce()
        {
            if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
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
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if(in_array($view, array('person/index')))
            {
                $this->template->set_layout('default');

                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');
                $this->template->add_js('person.js');
                $this->template->add_js('core.js');
                
                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
            }elseif(in_array($view, array('person/detail')))
            {
                $this->template->set_layout('default');

                $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                $this->template->add_js('jquery.sidr.min.js');
                $this->template->add_js('breakpoints.js');
                $this->template->add_js('select2.min.js');
                $this->template->add_js('purl.js');
                $this->template->add_js('persondetail.js');
                $this->template->add_js('core.js');
                $this->template->add_js('jquery.animateNumbers.js');
                $this->template->add_js('jquery.prettyPhoto.js');

                $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                $this->template->add_css('plugins/select2/select2.css');
                $this->template->add_css('prettyPhoto.css');
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
}

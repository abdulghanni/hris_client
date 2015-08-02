<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance_axapta extends MX_Controller {
	
	public $data;

	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		$this->load->library('authentication', NULL, 'ion_auth');
		$this->lang->load('auth');
	}

    function index($nik="nik", $bulan = "bln", $tahun = "thn",$sort_by = "id", $sort_order = "asc", $offset = 0)
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{

        	$sess_id = $this->session->userdata('user_id');
        	$sess_nik = get_nik($sess_id);
        	$s_bulan = substr($bulan,3);
			if($s_bulan) $filter['bulan'] = "where/".$s_bulan;
			$this->data['s_bulan'] = $s_bulan;
			
			$filter=array();
			$s_nik = substr($nik,3);
			if($s_nik) $filter['nik'] = "where/".$s_nik;
			$this->data['s_nik'] = $s_nik;
			$s_tahun = substr($tahun,3);
			if($s_tahun) $filter['tahun'] = "where/".$s_tahun;
			$this->data['s_tahun'] = $s_tahun;
            $url = get_api_key().'attendance/user/EMPLID/'.$sess_nik.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
            $get_user_attendance = file_get_contents($url);
            $this->data['user_att'] = $user_attendance = json_decode($get_user_attendance, true);
            }else{
            $this->data['user_att'] = 'Tidak ada data kehadiran ditemukan';
            }

    		$this->_render_page('attendance_axapta/index', $this->data);
    	}
  }
	
	function search(){
		$nik = $this->input->post('nik');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		
		redirect(site_url($this->filename.'/index/nik'.$nik.'/bln'.$bulan.'/thn'.$tahun));
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
}
?>
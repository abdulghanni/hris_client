<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function debugCode($r=array(),$f=TRUE){
	echo "<pre>";
	print_r($r);
	echo "</pre>";
	
	if($f==TRUE)
		die;
}
function get_client_ip_server() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
	}

	function get_bln($date){
		$bln=substr($date, 5,2);
		$tgl=substr($date, 8,2);
		$thn=substr($date, 0,4);
		$monthNum = $bln;
 		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
 		$date=$monthName." ".$tgl.", ".$thn;
 		return $date;
	}

	function get_date($date){
		$yrdata= strtotime($date);
    	return date('D, d M Y ', $yrdata);
	}
	function idr($angka){
		$angka ="IDR. ".number_format($angka,2,',','.');
		$duitnya=str_replace(",00", "", $angka);
		return $duitnya;
	
	}
	function toMoney($arg) {
         return number_format($arg,2,",",".");
   }
	function persen($data1,$data2){
		$data=$data2*100/$data1;
		return $data;
	}

	function get_days_left($day){
		$date1 = new DateTime(substr($day,0,10)); 
  		$date2 = new DateTime(date('Y-m-d')); 
  		$diff = $date2->diff($date1)->format("%a"); 
  		$days = intval($diff);  
  		return $days;
	}

	function url($val){
		$a=str_replace(' ','-', $val);
		$b=str_replace(',','', $a);
		$c=str_replace('.','', $b);
		return $c;

	}
	function get_count($table){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		return $ci->db->get()->num_rows();
	}
	function select_all($table){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$data = $ci->db->get();
		return $data->result();
	}

	function select_all_order_row($table,$order,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->order_by($order,$order_type);
		$data = $ci->db->get();
		return $data;
	}
	function select_where($table,$column,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($column,$where);
		$data = $ci->db->get();
		return $data;
	}
	function select_where_order($table,$column,$where,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($column,$where);
                $ci->db->order_by($order_by, $order_type);
		$data = $ci->db->get();
		return $data;
	}
    function select_where_limit_order($table,$column,$where,$limit,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->where($column,$where);
                $ci->db->order_by($order_by, $order_type);
		$data = $ci->db->get($table,$limit);
		return $data;
	}

	function select_where_array_limit_order($table,$array,$limit,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->where($array);
        $ci->db->order_by($order_by, $order_type);
		$data = $ci->db->get($table,$limit);
		return $data;
	}

	function select_where_offset_limit_order($table,$column,$where,$offset,$limit,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->where($column,$where);
        $ci->db->order_by($order_by, $order_type);
		$ci->db->limit($offset, $limit);
		$data = $ci->db->get($table);
		return $data;
	}
	function select_where_array($table,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($where);
		$data = $ci->db->get();
		return $data;
	}
	function select_where_array_group($table,$where,$group){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($where);
		$ci->db->group_by($group);
		$data = $ci->db->get();
		return $data;
	}
	function select_where_array_order($table,$where,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($where);
		$ci->db->order_by($order_by, $order_type);
		$data = $ci->db->get();
		return $data;
	}

	function insert_all($table,$data) {
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		if(!$ci->db->insert($table,$data))
			return FALSE;
		$data["id"] = $ci->db->insert_id();
		return (object)$data;
	}
	function insert_all_batch($table,$data) {
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		if(!$ci->db->insert_batch($table,$data))
			return FALSE;
		$data["id"] = $ci->db->insert_id();
		return (object)$data;
	}
	function update($table,$data,$column,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->where($column,$where);
		return $ci->db->update($table,$data); 
	}
	function update_where_array($table,$data,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->where($where);
		return $ci->db->update($table,$data); 
	}
	function update_one($table,$column,$where,$target,$action){
		$ci->db->set($target, $target.$action, FALSE);
		$ci->db->where($column, $where);
		return $ci->db->update($table);
	}
	function delete($table,$column,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->where($column,$where);
		return $ci->db->delete($table);
	}
	function delete_where_array($table,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->where($where);
		return $ci->db->delete($table);
	}
    function select_all_limit($table, $limit){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$data = $ci->db->get($table, $limit);
		return $data;
	}
        function select_all_limit_order($table, $limit, $order_by, $order){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
                $ci->db->order_by($order_by, $order);
		$data = $ci->db->get($table, $limit);
		return $data;
	}

    function select_all_order($table, $order_by, $order){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
        $ci->db->order_by($order_by, $order);
		$data = $ci->db->get();
		return $data->result();
	}
	function get_paging($table,$limit,$from,$order,$type) {
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->limit($limit,$from);
		$ci->db->order_by($order,$type);
		return $ci->db->get()->result();
	}
        
        function get_paging_where($table,$column,$where,$limit,$from,$order,$type) {
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->limit($limit,$from);
                $ci->db->where($column,$where);
		$ci->db->order_by($order,$type);
		return $ci->db->get()->result();
	}
        
        function select_all_limit_random($table, $limit){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
                $ci->db->order_by('id', 'RANDOM');
                $ci->db->limit($limit);
		$ci->db->from($table);
		$data = $ci->db->get();
		return $data->result();
	}
        
        function select_where_double_order($table,$column,$where,$column2,$where2,$order_by,$order_type){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($column,$where);
                $ci->db->where($column2,$where2);
                $ci->db->order_by($order_by, $order_type);
		$data = $ci->db->get();
		return $data;
	}
	function select_field_where_array($field,$table,$where){
		$ci=& get_instance();
		$ci->load->database('default',TRUE);
		$ci->db->select($field);
		$ci->db->from($table);
		$ci->db->where($where);
		$data = $ci->db->get();
		return $data;
	}
	function debug_code($code){
		echo "<pre>";
		print_r($code);
		echo "</pre>";
		die();
	}
function tanggal_indo($tanggal)
{
	$bulan = array (

		0 =>   '0',
				'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function get_no_surat($nama_surat,$table,$id){
	$ci=& get_instance();
	$ci->load->database('default',TRUE);
	$row=select_where($table,'id',$id)->row();
	$buid=get_user_buid($row->nik);
	$date=substr($row->created_on,5,2);
	$year=substr($row->created_on,0,4);
	$kode_surat=$nama_surat."/".$buid."/".$date."/".$year."/".$id;
	return $kode_surat;
}
function get_no_surat2($nama_surat,$table,$id){
	$ci=& get_instance();
	$ci->load->database('default',TRUE);
	$row=$ci->db->query("select * from ".$table." where id='".$id."'")->row();
	$buid=get_user_buid($row->nik);
	$date=substr($row->created_on,5,2);
	$year=substr($row->created_on,0,4);
	$kode_surat=$nama_surat."/".$buid."/".$date."/".$year."/".$id;
	return $kode_surat;
}
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	//TO CHECK IS USER ADMIN IN ION AUTH LIBRARY
	if (!function_exists('is_admin'))
	{	
		function is_admin()
		{
			$CI =& get_instance();
			
			if($CI->ion_auth->is_admin())
			{
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	//TO CHECK IS USER HAVE AUTHORIZATION TO SEE FORM CUTI LIST
	if (!function_exists('is_authorized'))
	{	
		function is_authorized($sess_id, $user_cuti_id)
		{
			//print_mz(get_superior($sess_id));
			$CI =& get_instance();
			
			if($CI->ion_auth->is_admin() || $sess_id =$user_cuti_id || $sess_id = get_id(get_superior($user_cuti_id)) || $sess_id = get_id(get_superior(get_id(get_superior($user_cuti_id)))))
			{
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	//TO SEND EMAIL NOTIFICATION WHEN USER REGISTER
	if (!function_exists('send_email_activation'))
	{	
		function send_email_activation($nik)
		{
			$CI =& get_instance();
			$data = array(
					'sender_id' => $nik,
					'receiver_id' => 1,
					'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
					'subject' => 'Account Activation Request',
					'email_body' =>'Karyawan dengan Nik '.$nik.' meminta pengaktifan akun, silakan klik button "activate" untuk mengaktifkan akun',
					'is_request_activation' => 1,
					'is_read' => 0,
				);
			$CI->db->insert('email', $data);
		}
	}

	//TO GET NIK FROM SPECIFIED ID
	if (!function_exists('get_nik'))
	{	
		function get_nik($id)
		{
			$CI =& get_instance();
			
			$q = $CI->db->select('nik')->from('users')->where('id', $id)->get()->row('nik');
			if(!empty($q)){
				return $q;
			}else{
				return $id;
			}
		}
	}

	//TO GET ID FROM SPECIFIED NIK
	if (!function_exists('get_id'))
	{	
		function get_id($nik)
		{
			$CI =& get_instance();
			if($nik !== 0)
			{
			$q = $CI->db->select('id')->from('users')->where('nik', $nik)->get()->row('id');
			
				return $q;
			}else{
				return FALSE;
			}
		}
	}

	if (!function_exists('get_name'))
	{	
		function get_name($nik)
		{
			$CI =& get_instance();
			if(!empty($CI->db->select('username')->from('users')->where('nik', $nik)->get()->row('username')))
			{
			$q = $CI->db->select('username')->from('users')->where('nik', $nik)->get()->row('username');
			return $q;
			}elseif(!empty($CI->db->select('username')->from('users')->where('id', $nik)->get()->row('username'))){
			$q = $CI->db->select('username')->from('users')->where('id', $nik)->get()->row('username');
			return $q;
			}elseif(!empty(get_name_from_api($nik))){
				return get_name_from_api($nik);
			}else{
				return '';
			}
		}
	}
        
        if (!function_exists('get_name_from_api'))
	{	
            function get_name_from_api($nik)
            {
                $CI =& get_instance();
                if(!empty($nik)){
	                $url = get_api_key().'users/employement/EMPLID/'.$nik.'/format/json';
	                $headers = get_headers($url);
	                $response = substr($headers[0], 9, 3);
	                if ($response != "404") {
	                    $getuser_info = file_get_contents($url);
	                    $user_info = json_decode($getuser_info, true);
	                    return $CI->data['user_info'] = $user_info['NAME'];
	                } else {
	                    return $CI->data['user_info'] = '';
	                }
            	}else{
            		return false;
            	}
            }
	}

	if (!function_exists('get_mchid'))
	{	
		function get_mchid($nik)
		{
			$CI =& get_instance();
			if(!empty($CI->db->select('mchID')->from('mchid')->where('nik', $nik)->get()->row('mchID')))
			{
			$q = $CI->db->select('mchID')->from('mchid')->where('nik', $nik)->get()->row('mchID');
			return $q;
			}else{
			return '0';
			}
		}
	}


	//TO CHECK NUM ROWS EMAIL UNREAD IN SPECIFIED USER
	if (!function_exists('get_unread_email'))
	{	
		function get_unread_email($id)
		{
			$CI =& get_instance();
			
			$q = $CI->db->select('email.id as email_id')->from('email')->where('receiver_id', $id)->where('is_read', 0)->get()->num_rows();
			
			return $q;
		}
	}

	// TO CHECK IS USER HAVE SUPERIOR OR NOT
	if (!function_exists('is_have_superior'))
	{	
		function is_have_superior($id)
		{
			$CI =& get_instance();
			
			if($CI->db->select('superior_id')->from('users')->where('id', $id)->where('superior_id is not null')->get()->num_rows()>0)
			{
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	//TO GET SUPERIOR ID FROM SPECIFIED USER
	if (!function_exists('get_superior'))
	{	
		function get_superior($id)
		{
			$CI =& get_instance();
			
			$q =  $CI->db->select('superior_id')->from('users')->where('id', $id)->get()->row('superior_id');

			if($q!=NULL)
			{
				return $q;
			}else{
				return false;
			}
		}
	}

	//TO CHECK IS USER HAVE SUBORDINATE OR NOT
	if (!function_exists('is_have_subordinate'))
	{	
		function is_have_subordinate($id)
		{
			$CI =& get_instance();
			$nik = get_nik($id);
			if($CI->db->select('id')->from('users')->where('superior_id', $id)->get()->num_rows()>0)
			{
				return $CI->db->select('id')->from('users')->where('superior_id', $id)->get()->result_array('id');
			}elseif($CI->db->select('id')->from('users')->where('superior_id', $nik)->get()->num_rows()>0){
				return $CI->db->select('id')->from('users')->where('superior_id', $nik)->get()->result_array('id');
			}else{
				return false;
			}
		}
	}

	//TO CHECK IS SPECIFIED USER IN SUBORDINAT LIST OR NOT
	if (!function_exists('cek_subordinate'))
	{
		function cek_subordinate($array, $key, $val) {
		$CI =& get_instance();
		$sess_id = $CI->session->userdata('user_id');
		$sess_nik = get_nik($CI->session->userdata('user_id'));
		if(!empty(is_have_subsubordinate($sess_id) || is_have_subordinate($sess_nik) || is_have_subordinate($sess_id)))
        {
	    foreach ($array as $item)
	        if (isset($item[$key]) && $item[$key] == $val)
	            return true;
	    return false;
	    }
		}
	}

	// TO GET SUBORDINATE LIST
	if (!function_exists('get_subordinate'))
	{
	    function get_subordinate($id)
	    {
	        $x = '';
	        //print_mz(is_have_subordinate(get_nik(20)));
	        $input = is_have_subordinate(get_nik($id));
	        //print_r($input);
	        if(!empty($input))
	        {
	        $output = implode(', ', array_column($input, 'id'));

	        $exp = explode(',', $output);

	        for($i=0;$i<sizeof($exp);$i++){
	            $x .= ' OR users.id='.$exp[$i];
	        }

	        return $x;
	    	}
	    }
	}

	//TO CHECK SUBSUBORDINATE

	if (!function_exists('is_have_subsubordinate'))
	{	
		function is_have_subsubordinate($id)
		{
			$CI =& get_instance();
			
			$nik = get_nik($id);
			if($CI->db->select('id')->from('users')->where('superior_id', $nik)->get()->num_rows()>0)
			{
				$sup = get_subsubordinate($id);
				return $CI->db->select('id')->from('users')->where("($sup)",null,false)->get()->result_array('id');
			}else{
				return false;
			}
		}
	}

	if (!function_exists('get_subsubordinate'))
	{
		//$CI =& get_instance();
		//$sess_id = $CI->session->userdata('user_id');
		//if(!empty(is_have_subordinate(1)))
        //{
	    function get_subsubordinate($id)
	    {
	         $x = '';
	        //print_mz(is_have_subordinate(get_nik(20)));
	        $input = is_have_subordinate(get_nik($id));
	        //print_r($input);
	        if(!empty($input))
	        {
	        $output = implode(', ', array_column($input, 'id'));

	        $exp = explode(',', $output);

	        for($i=0;$i<1;$i++){
	        	$y = get_nik($exp[$i]);
	           $x .= 'superior_id='."'$y'";
	        }

	        for($i=1;$i<sizeof($exp);$i++){
	        	$y = get_nik($exp[$i]);
	            $x .= ' OR superior_id='."'$y'";
	        }

	        return $x;
	    	}
	    }
		//}
	}


	if (!function_exists('is_receiver'))
	{	
		function is_receiver()
		{
			$CI =& get_instance();
			$user_id = $CI->session->userdata('user_id');
			if($CI->email_model->is_receiver($user_id))
			{
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	if(!function_exists('get_pengganti'))
	{
		function get_pengganti($id)
		{
			$CI =&get_instance();
			$nik_pengganti = $CI->db->select('user_pengganti')->where('id', $id)->get('users_cuti')->row('user_pengganti');
			$url_pengganti2 = get_api_key().'/users/employement/EMPLID/'.$nik_pengganti.'/format/json';
			$url_pengganti = $CI->db->select('username')->where('nik', $nik_pengganti)->get('users')->row('username');
            //$headers = get_headers($url_pengganti);
            //$response = substr($headers[0], 9, 3);
            if (!empty($url_pengganti)){
                return $url_pengganti;
			}else{
				return '-';
			}

		}
	}

	if(!function_exists('get_bu_name'))
	{
		function get_bu_name($bu_id)
		{
			$CI =&get_instance();
			$url = get_api_key().'users/bu_name/BUID/'.$bu_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getbu = file_get_contents($url);
                $bu = json_decode($getbu, true);
                return $bu[0]['DESCRIPTION'];
            } elseif($bu_id == 0) {
            	return '-';
            }else{
                return '-';
            }

		}
	}

	if(!function_exists('get_organization_name'))
	{
		function get_organization_name($org_id)
		{
			$CI =&get_instance();
			$url = get_api_key().'users/org_name/ORGID/'.$org_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getorg = file_get_contents($url);
                $org = json_decode($getorg, true);
                return $org[0]['DESCRIPTION'];
            } elseif($org_id == 0) {
            	return '-';
            }else{
                return '-';
            }

		}
	}

	if(!function_exists('get_position_name'))
	{
		function get_position_name($pos_id)
		{
			$CI =&get_instance();
			$url = get_api_key().'users/pos_name/POSID/'.$pos_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $getpos = file_get_contents($url);
                $pos = json_decode($getpos, true);
                return $pos[0]['DESCRIPTION'];
            } elseif($pos_id == 0) {
            	return '-';
            }else{
                return '-';
            }

		}
	}

	if(!function_exists('get_seniority_date'))
	{
		function get_seniority_date($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['SENIORITYDATE'];
            } else {
                return '-';
            }
		}
	}

	if(!function_exists('get_user_organization'))
	{
		function get_user_organization($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['ORGANIZATION'];
            } else {
                return '-';
            }
		}
	}

	if(!function_exists('get_user_position'))
	{
		function get_user_position($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['POSITION'];
            } else {
                return '-';
            }
		}
	}

	if(!function_exists('get_user_branchid'))
	{
		function get_user_branchid($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['BRANCHID'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_dimension2_'))
	{
		function get_user_dimension2_($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['DIMENSION2_'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_locationid'))
	{
		function get_user_locationid($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['LOCATIONID'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_emplgroupid'))
	{
		function get_user_emplgroupid($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['EMPLGROUPID'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_dataareaid'))
	{
		function get_user_dataareaid($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['DATAAREAID'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_buid'))
	{
		function get_user_buid($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return substr($user_info['BUID'],0,2);
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_bu'))
	{
		function get_user_bu($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['BU'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_user_sen_date'))
	{
		function get_user_sen_date($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['SENIORITYDATE'];
            } else {
                return '';
            }
		}
	}

	if(!function_exists('get_grade'))
	{
		function get_grade($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['GRADE'];
            } else {
                return '-';
            }
		}
	}

	if(!function_exists('get_pos_group'))
	{
		function get_pos_group($user_id)
		{
			$CI =&get_instance();
            $url = get_api_key().'users/employement/EMPLID/'.$user_id.'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") 
            {
                $getuser_info = file_get_contents($url);
                $user_info = json_decode($getuser_info, true);
                return $user_info['POSITIONGROUP'];
            } else {
                return '-';
            }
		}
	}

	if(!function_exists('get_user_same_org'))
	{
		function get_user_same_org($id)
	    {
	    	$result = '';
	        $url = get_api_key().'users/org/EMPLID/'.$id.'/format/json';
	            $headers = get_headers($url);
	            $response = substr($headers[0], 9, 3);
	            if ($response != "404") {
	                $get_task_receiver = file_get_contents($url);
	                $task_receiver = json_decode($get_task_receiver, true);
	                //return print_r($task_receiver);
	                 foreach ($task_receiver as $row)
	                    {
	                        $result.=$row['ID'].' ';
	                    }
	            } else {
	               $result .= '';
	            }

	        return explode(' ' ,$result);
	    }
	}

	if(!function_exists('get_sisa_cuti'))
	{
		function get_sisa_cuti($user_id)
		{
			if($user_id !=null)
	        {
	            $url = get_api_key().'users/sisa_cuti/EMPLID/'.get_nik($user_id).'/format/json';
	            $headers = get_headers($url);
	            $response = substr($headers[0], 9, 3);
	            if ($response != "404") {
	                $getsisa_cuti = file_get_contents($url);
	                $sisa_cuti = json_decode($getsisa_cuti, true);
	                return $sisa_cuti;
	            } else {
	                return '-';
	            }
	        }
		}
	}



	if ( ! function_exists('dateIndo'))
	{
	function dateIndo($date,$format=null)
	{
		if($date!=0000-00-00){
			try {
				
				$newdate = date('d',strtotime($date)).' '.monthIndo(date('m',strtotime($date))).' '.date('Y',strtotime($date));
				return $newdate;

			} catch (Exception $e) {
				return array();
			}
		}else{
			return '';
		}

	}

	if(!function_exists('lq'))
	{
		function lq()
		{
			$CI =&get_instance();
			return $CI->db->last_query();
		}
	}


	if (!function_exists('get_api_key'))
	{
		function get_api_key()
		{
			$CI =&get_instance();
			$username = $CI->db->where('id', 1)->get('users_api')->row('username');
			$password = $CI->db->where('id', 1)->get('users_api')->row('password');

			if(!empty($username&&$password))
			{
				return 'http://'.$username.':'.$password.'@'.$_SERVER['HTTP_HOST'].'/hris_api/';
			}else
			{
				return false;
			}
		}
	}

	function monthIndo($date)
	{
		try {
			
			$month['01']  = 'Januari';
			$month['02']  = 'Februari';
			$month['03']  = 'Maret';
			$month['04']  = 'April';
			$month['05']  = 'Mei';
			$month['06']  = 'Juni';
			$month['07']  = 'Juli';
			$month['08']  = 'Agustus';
			$month['09']  = 'September';
			$month['10'] = 'Oktober';
			$month['11'] = 'Nopember';
			$month['12'] = 'Desember';
			return $month[$date];

		} catch (Exception $e) {
			return array();
		}

	}
}
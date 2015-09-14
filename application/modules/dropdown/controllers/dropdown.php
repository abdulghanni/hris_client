<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dropdown extends MX_Controller {

	public $data;
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_emp_bu()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo get_user_bu($id);
        }
    }

    public function get_emp_org()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo get_user_organization($id);
        }
    }

    public function get_emp_pos()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo get_user_position($id);
        }
    }

    public function get_emp_sen_date()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo dateIndo(get_user_sen_date($id));
        }
    }

    public function get_emp_nik()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo get_nik($id);
        }
    }


    public function get_emp_grade()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else{
        $id = get_nik($id);
        echo get_grade($id);
        }
    }

    public function get_biaya_fix()
    {
        $id = $this->input->post('id');
        if($id == '0'){
        echo '-';
        }else
        {
            $id = get_nik($id);
            $grade = get_grade($id);
            $pos_group = get_pos_group($id);

            if($grade == 'G08' && $pos_group == 'AMD')
            {
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/7'));
            }elseif($grade == 'G08' && $pos_group == 'MGR')
            {
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/6'));
            }elseif($grade == 'G08' && $pos_group == 'KACAB'){
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/5'));
            }elseif($grade == 'G07'){
               $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/4'));
            }elseif($grade == 'G06' || $grade == 'G05'){
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/3'));
            }elseif($grade == 'G04' || $grade == 'G03'){
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/2'));
            }elseif($grade == 'G02' || $grade == 'G01'){
                $this->data['biaya_fix'] = getAll('pjd_biaya', array('type_grade'=>'where/1'));
            }

            $this->load->view('form_spd_luar/biaya_fix', $this->data);
        }
    }

    public function get_asmen()
    {
        $id = $this->input->post('id');
        $data['nik']= $id = get_nik($id);
        if($id == '0'){
            echo '-';
        }else{
            $url = get_api_key().'users/admin_asset_management/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $get_atasan = file_get_contents($url);
                $atasan = json_decode($get_atasan, true);
                 foreach ($atasan as $row)
                    {
                        $result['0']= '-- Pilih Admin Asset Management --';
                        $result[$row['EMPLID']]= ucwords(strtolower($row['NAME']));
                    }
            }else{
                $result['0']= '- No Data Available -';
            }

            $data['result']=$result;
            $this->load->view('dropdown_asmen',$data);
        }
    }

    public function get_atasan($id)
    {
      $pos_group = get_pos_group(get_nik($id));
      $url = get_api_key().'users/superior/EMPLID/'.get_nik($id).'/format/json';
      $url_atasan_satu_bu = get_api_key().'users/atasan_by_posgroup/EMPLID/'.get_nik($id).'/format/json';
      $headers = get_headers($url);
      $headers2 = get_headers($url_atasan_satu_bu);
      $response = substr($headers[0], 9, 3);
      $response2 = substr($headers2[0], 9, 3);
      //$url_atasan_satu_bu = get_api_key().'users/atasan_satu_bu/EMPLID/'.get_nik($id).'/format/json';
      if($pos_group == 'AMD' || $pos_group == 'DIR' || $pos_group == 'KACAB' || $pos_group == 'MGR' || $pos_group == 'ASM'):
          if ($response != "404") {
              $get_atasan = file_get_contents($url);
              $atasan = json_decode($get_atasan, true);
              $get_atasan2 = file_get_contents($url_atasan_satu_bu);
              $atasan2 = json_decode($get_atasan2, true);
              $atasan3 = array_merge($atasan, $atasan2);
              foreach ($atasan3 as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
          }elseif($response == "404" && $response2 != "404") {
            $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
              foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
          }else{
              $result['0']= '- Karyawan Tidak Memiliki Atasan -';
          }
      else:
          if($response != "404") {
            $get_atasan = file_get_contents($url);
            $atasan = json_decode($get_atasan, true);
             foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        } elseif($response == "404" && $response2 != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
             foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        }else{
            $result['0']= '- Karyawan Tidak Memiliki Atasan -';
        }
      endif;

      $data['result']=$result;
      $this->load->view('dropdown_atasan',$data);      
    }

    public function get_atasan2($id)
    {
        $url = get_api_key().'users/superior/EMPLID/'.$id.'/format/json';
        $url_atasan_satu_bu = get_api_key().'users/atasan_satu_bu/EMPLID/'.$id.'/format/json';
        $headers = get_headers($url);
        $headers2 = get_headers($url_atasan_satu_bu);
        $response = substr($headers[0], 9, 3);
        $response2 = substr($headers2[0], 9, 3);
        if ($response != "404") {
            $get_atasan = file_get_contents($url);
            $atasan = json_decode($get_atasan, true);
             foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        } elseif($response == "404" && $response2 != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
             foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        }else{
            $result['0']= '- Karyawan Tidak Memiliki Atasan -';
        }

        $data['result']=$result;
        $this->load->view('dropdown_atasan',$data);
    }

    public function get_atasan3($id)
    {
        $url_atasan_satu_bu = get_api_key().'users/atasan_satu_bu/EMPLID/'.get_nik($id).'/format/json';
        $headers = get_headers($url_atasan_satu_bu);
        $response = substr($headers[0], 9, 3);
        if($response != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
             foreach ($atasan as $row)
                {
                    $result['0']= '-- Pilih Atasan --';
                    $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                }
        }else{
            $result['0']= '- Karyawan Tidak Memiliki Atasan -';
        }

        $data['result']=$result;
        $this->load->view('dropdown_atasan',$data);
    }

    public function get_pengganti_cuti($id)
    {
        $url = get_api_key().'users/org/EMPLID/'.get_nik($id).'/format/json';
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $get_task_receiver = file_get_contents($url);
                $task_receiver = json_decode($get_task_receiver, true);
                 foreach ($task_receiver as $row)
                    {
                        $result['0']= '-- Pilih User --';
                        $result[$row['ID']]= ucwords(strtolower($row['NAME']));
                    }
            } else {
               $result['-']= '- Tidak ada user dengan departemen yang sama -';
            }
        $data['result']=$result;
        $this->load->view('form_cuti/dropdown_up',$data);
    }

    public function get_penerima_tugas($id)
    {
        $url = get_api_key().'users/bawahan_satu_bu/EMPLID/'.get_nik($id).'/format/json';
      
            $headers = get_headers($url);
            $response = substr($headers[0], 9, 3);
            if ($response != "404") {
                $get_task_receiver = file_get_contents($url);
                $task_receiver = json_decode($get_task_receiver, true);
                 foreach ($task_receiver as $row)
                    {
                        $result['0']= '-- Pilih User --';
                        $result[$row['ID']]= ucwords(strtolower($row['NAME']).' - '.$row['ID']);
                    }
            } else {
               $result['-']= '- Not Availbale -';
            }
        $data['result']=$result;
        $this->load->view('form_cuti/dropdown_up',$data);
    }

    function get_sisa_cuti()
    {
        $id = get_nik($this->input->post('id'));

        $url = get_api_key().'users/sisa_cuti/EMPLID/'.$id.'/format/json';
        $seniority_date = get_seniority_date($id);
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getsisa_cuti = file_get_contents($url);
            $sisa_cuti = json_decode($getsisa_cuti, true);
            $sisa_cuti =  $sisa_cuti[0]['ENTITLEMENT'];
        } elseif($response == "404" && strtotime($seniority_date) < strtotime('-1 year')) {
            $sisa_cuti =  '10';
        }else{
            $sisa_cuti =  '0';
        }

        echo $sisa_cuti;
    }

    function get_subordinate()
    {
        $id = get_nik($this->input->post('id'));

        $subordinate =  getAll('users', array('superior_id'=>'where/'.$id));
        foreach ($subordinate->result_array()  as $row)
        {
            $result['0']= '-- Pilih User --';
            $result[$row['id']]= ucwords(strtolower($row['username']));
        }


        $data['result']=$result;
        $this->load->view('dropdown_atasan',$data);

    }
}
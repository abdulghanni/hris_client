<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}

	public function send_email($email, $subject, $isi_email)
  {

    $config = Array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'mail.erlangga.co.id',
                  'smtp_port' => 587,
                  'smtp_user' => 'ax.hrd@erlangga.co.id', 
                  'smtp_pass' => 'erlangga', 
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1',
                  'wordwrap' => TRUE
                  );

     $this->load->library('email', $config);
     $this->email->set_newline("\r\n");  
     $this->email->from('ax.hrd@erlangga.co.id', 'HRIS-Erlangga');
     $this->email->to($email);
     $this->email->subject($subject);
     $this->email->message($isi_email);
   
       if($this->email->send())
       {
         return true;
         //return $this->email->print_debugger();
       }
       else
       {
        return false;
        //return $this->email->print_debugger();
       }
   }

  function get_user_atasan()
  {
      $id = $this->session->userdata('user_id');

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
              return $this->data['user_atasan'] = $atasan3;
          }elseif($response == "404" && $response2 != "404") {
            $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
              return $this->data['user_atasan'] = $atasan;
          }else{
              return $this->data['user_atasan'] = '- Karyawan Tidak Memiliki Atasan -';
          }
      else:
          if($response != "404") {
            $get_atasan = file_get_contents($url);
            $atasan = json_decode($get_atasan, true);
             return $this->data['user_atasan'] = $atasan;
        } elseif($response == "404" && $response2 != "404") {
           $get_atasan = file_get_contents($url_atasan_satu_bu);
            $atasan = json_decode($get_atasan, true);
             return $this->data['user_atasan'] = $atasan;
        }else{
            return $this->data['user_atasan'] = '- Karyawan Tidak Memiliki Atasan -';
        }
      endif;
  }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Competency
*
*
* Author: Abdul Ghanni
*         abdul.ghanni2@gmail.com
*
*
* Requirements: PHP5 or above
*
*/
class Competency {

    public function get_position_group()
    {
        $CI =&get_instance();
        $url = get_api_key().'competency/position_group/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") 
        {
            $get_info = file_get_contents($url);
            $info = json_decode($get_info, true);
            return $info;
        } else {
            return '';
        }
    }

    public function get_organization()
    {
        $CI =&get_instance();
        $url = get_api_key().'users/all_org/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") 
        {
            $get_info = file_get_contents($url);
            $info = json_decode($get_info, true);
            return $info;
        } else {
            return '';
        }
    }

    public function get_position()
    {
        $CI =&get_instance();
        $url = get_api_key().'users/all_pos/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") 
        {
            $get_info = file_get_contents($url);
            $info = json_decode($get_info, true);
            return $info;
        } else {
            return '';
        }
    }

    function get_position_from_org($org_id)
    {
        $CI =&get_instance();
        $url = get_api_key().'users/pos_from_org/ORGID/'.$org_id.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getpos = file_get_contents($url);
            $pos = json_decode($getpos, true);
            return $pos;
        } elseif($pos_id == 0) {
            return '-';
        }else{
            return '-';
        }

    }

    function get_position_group_from_org($org_id)
    {
        $CI =&get_instance();
        $url = get_api_key().'users/pos_from_org/ORGID/'.$org_id.'/format/json';
        $headers = get_headers($url);
        $response = substr($headers[0], 9, 3);
        if ($response != "404") {
            $getpos = file_get_contents($url);
            $pos = json_decode($getpos, true);
            return $pos;
        } elseif($pos_id == 0) {
            return '-';
        }else{
            return '-';
        }

    }
}

/* End of file Approval.php */
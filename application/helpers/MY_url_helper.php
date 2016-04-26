<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Assets URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('assets_url'))
{
    function assets_url($uri = '')
    {
        $CI =& get_instance();
        $is_pdf = $this->uri->segment(2, 0);
        $is_pdf = substr($is_pdf, -3);

        if($is_pdf == "pdf"){
        	return "http://localhost/hris_client/assets/". trim($uri, '/');
        }else{
	        $assets_url = $CI->config->item('assets_url');
	        return $assets_url . trim($uri, '/');
	    }
    }
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
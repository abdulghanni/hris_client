<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_rolling_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_rolling($id = null)
    {
	}
}
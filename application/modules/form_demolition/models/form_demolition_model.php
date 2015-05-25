<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_demolition_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_demolition($id = null)
    {
	}
}
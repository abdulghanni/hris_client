<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_promosi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_promosi($id = null)
    {
	}
}
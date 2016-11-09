<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form_evaluasi_training_model extends CI_Model {

	var $t = 'competency_form_evaluasi_training';
	// var $tj1 = 'competency_form_evaluasi_training_detail';
	// var $tj2 = 'competency_form_evaluasi_training_approver';
	// var $tj2 = 'form_competency';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function detail($id)
	{
		return true;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_controller extends CI_Controller {
	public function survey_list(){
		$this->load->view('admin/survey_list');
	}
}

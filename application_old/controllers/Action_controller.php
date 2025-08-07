<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Action_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}   	
	public function purchase_add_on(){
		$this->form_validation->set_rules('add_on_plan','Add On','required');
		if($this->form_validation->run() === TRUE){
			$result = $this->Admin_model->purchase_add_on();
			if($result == "0"){
				$this->session->set_flashdata('success','Plan added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}  
	public function request_add_on(){
		$this->form_validation->set_rules('add_on_plan','Add On','required');
		if($this->form_validation->run() === TRUE){
			$result = $this->Admin_model->request_add_on();
			if($result == "0"){
				$this->session->set_flashdata('success','Plan Request added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}  

	public function set_wp_feature(){
		$this->Common_model->set_wp_feature();
	}
}	
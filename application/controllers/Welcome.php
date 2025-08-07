<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->is_login();   
	}
	public function is_login(){
		if($this->session->userdata('admin_id') != ""){
			$this->session->set_flashdata('success','You have already logged in');
			redirect('admin-dashboard');   
		}
	}	

	public function admin_login(){ 
		$this->form_validation->set_rules('email','email','required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('admin/login');  
		}else{
			$result = $this->Admin_model->admin_login();  
												
			if($result){
				$this->session->set_flashdata('success','Login successfully');
				redirect('admin-dashboard');
			}else{
				$this->session->set_flashdata('message','Login failed, please try again');
				redirect('login');
			}
		}
	}
	
	public function salon_login(){ 
		if($this->session->userdata('salon_id') != ""){
			$this->session->userdata('message','You already loggedin');
			redirect('salon-dashboard-new');
		}else{
			$this->form_validation->set_rules('email','email','required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('salon/salon-login');   
			}else{				
				$result = $this->Salon_model->salon_login();  		
				if($result == '1'){
					$this->session->set_flashdata('success','Login successfully');
					redirect('salon-dashboard-new');
				}elseif($result == '0'){
					$this->session->set_flashdata('message','Login failed, please try again');
				}elseif($result == '2'){
					$this->session->set_flashdata('message','Subscription payment not received. Please contact to admin');
				}elseif($result == '3'){
					$this->session->set_flashdata('message','Subscription validity expired. Please contact to admin');
				}
				redirect('');
			}
		}
	}  

	public function form(){ 
		if($this->input->post('submit_button') == 'submit_button'){
			$result = $this->Salon_model->submit_form(); 
		}else{
			$this->load->view('form');   
		}
	}  	
	public function test_notification(){
		$this->Common_model->test_notification();
	}
}

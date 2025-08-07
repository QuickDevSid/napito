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
	
	public function mobile_booking_print(){
		$data['single'] = $this->Salon_model->get_single_booking_details(base64_decode($this->uri->segment(2)));
		$data['single_bill_services'] = $this->Salon_model->get_single_booking_service_details_for_primary_bill(base64_decode($this->uri->segment(2)));
		// echo '<pre>'; print_r($data['single_bill_services']); exit;
		$this->load->view('salon/mobile-booking-print',$data);
	}
	public function booking_print(){
		$data['single'] = $this->Salon_model->get_single_booking_details(base64_decode($this->uri->segment(2)));
		$data['single_services'] = $this->Salon_model->get_single_booking_service_details(base64_decode($this->uri->segment(2)));
		$data['single_bill_services'] = $this->Salon_model->get_single_booking_service_details_for_bill(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		$data['single_payment_details'] = $this->Salon_model->get_single_booking_payment_details(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		// echo '<pre>'; print_r($data['single_bill_services']); exit;
	   $this->load->view('salon/booking-print',$data);
	}
	public function product_booking_print(){
		$data['single'] = $this->Salon_model->get_single_product_booking_details(base64_decode($this->uri->segment(2)));
		$data['single_products'] = $this->Salon_model->get_single_product_booking_product_details(base64_decode($this->uri->segment(2)));
		$data['single_bill_products'] = $this->Salon_model->get_single_product_booking_product_details_for_bill(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		$data['single_payment_details'] = $this->Salon_model->get_single_booking_payment_details(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		$data['single_profile'] = $this->Salon_model->get_single_branch_profile();
		// echo '<pre>'; print_r($data['single_bill_products']); exit;
	   $this->load->view('salon/product-booking-print',$data);
	}
	public function membership_print($customer_id){
		$customer_amount_history = $this->Salon_model->get_customer_membership_amount_history_all(base64_decode($customer_id));
		$data['customer_amount'] = $customer_amount_history;
		$this->load->view('salon/membership-print',$data);
	} 	
	public function package_print($customer_id){
		$customer_amount_history = $this->Salon_model->get_customer_package_amount_history_all(base64_decode($customer_id));
		$data['customer_amount'] = $customer_amount_history;
		$this->load->view('salon/package-print',$data);
	} 
	public function giftcard_print($customer_id){
		$data['customer_amount'] = $this->Salon_model->get_customer_giftcard_amount(base64_decode($customer_id));
		$this->load->view('salon/giftcard-print',$data);
	} 
	public function client_consent_form(){
		if($this->input->post('submit_consent') == 'submit_consent'){
			$result = $this->Salon_model->submit_client_consent_form();
			if($result){
				redirect('consent_thank');
			}else{
				redirect($this->input->post('consent_link'));
			}
		}else{
			$data['consent_form'] = $this->Salon_model->get_customer_consent_form(isset($_GET['consent']) ? base64_decode($_GET['consent']) : '');
			if(!empty($data['consent_form'])){
				if($data['consent_form']->customer_consent_status == '1'){
					$this->load->view('salon/client_consent_form_print',$data);
				}else{
					$this->load->view('salon/client_consent_form',$data);
				}
			}else{
				return false;
			}
		}
	}
	public function consent_thank(){
		$this->load->view('salon/thank_you');
	} 
	public function test_notification(){
		$this->Common_model->test_notification();
	}
	public function print_salary_slip(){
		$data['slip'] = $this->Salon_model->get_salary_slip_details();
		$data['single_profile'] = $this->Salon_model->get_single_branch_profile();
		$this->load->view("salon/print_salary_slip",$data);
	}
	public function complete_profile(){
		$data['store_profile'] = $this->Salon_model->get_user_profile();
		$onboarding_status = '';
		if(!empty($data['store_profile'])){
			$onboarding_status = $data['store_profile']->onboarding_status;
		}

		// if($onboarding_status < '17'){
			$this->load->view('salon/complete-profile-new'); 
		// }else{
		// 	$this->session->set_flashdata('success','Onboarding process completed successfully');
		// 	redirect('salon-dashboard-new');
		// }
	}
	public function salon_do_logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}  



	//Cron function
	public function change_rotational_shift(){
		$this->Salon_model->change_rotational_shift();
	}
	public function update_emergency_closure(){
		$this->Salon_model->update_emergency_closure();
	}
	public function send_birthday_wish(){
		$this->Salon_model->send_birthday_wish();
	}
	public function send_anniversary_wish(){
		$this->Salon_model->send_anniversary_wish();
	}
	public function send_service_reminder(){
		$this->Salon_model->send_service_reminder();
	}
	public function send_lost_customer_message(){
		$this->Salon_model->send_lost_customer_message();
	}
	public function send_tomorrow_booking_reminder(){
		$this->Salon_model->send_tomorrow_booking_reminder();
	}
	public function send_today_booking_reminder(){
		$this->Salon_model->send_today_booking_reminder();
	}
	public function reset_expired_subscriptions(){
		$this->Admin_model->reset_expired_subscriptions();
	}
}

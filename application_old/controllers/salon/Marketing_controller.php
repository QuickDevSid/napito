<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marketing_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->is_login(); 

		$this->check_onboarding();

		if($this->uri->segment(1) != "salon-dashboard-new" && $this->uri->segment(1) != "whatsapp-report" && $this->uri->segment(1) != "index" && $this->uri->segment(1) != "calendar"){
			$this->is_allowed();   
		}
	}
    
	public function check_onboarding(){
		$data['store_profile'] = $this->Salon_model->get_user_profile();
		$onboarding_status = '';
		if(!empty($data['store_profile'])){
			$onboarding_status = $data['store_profile']->onboarding_status;
		}

		if($onboarding_status < '18'){
			redirect('complete-profile');
		}
	}

	public function is_login(){
		if($this->session->userdata('branch_id') == ""){
			$this->session->set_flashdata('message','Please login to continue');
			redirect(base_url());   
		}
	}  

	public function is_allowed(){
		if(!in_array($this->uri->segment(1),explode(',',$this->session->userdata('subscription_feature_slugs')))){
			$this->session->set_flashdata('message', 'You are not allowed to access');
			redirect('salon-dashboard-new');
		}
	}
    
	public function add_message(){
		$result = $this->Marketing_model->add_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message added & sent for approval successfully');
		}else{
			$this->session->set_flashdata('success','Message updated successfully');
		}
		redirect('customize_message?customer_report_type=7');
	}
	public function send_customize_message(){
		$result = $this->Marketing_model->send_customize_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('customize_message?customer_report_type=1');
	}
	public function send_offer_message(){
		$result = $this->Marketing_model->send_offer_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}elseif($result == 2){
			$this->session->set_flashdata('message','Coins not available');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-offers');
	}
	public function send_coupon_message(){
		$result = $this->Marketing_model->send_coupon_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}elseif($result == 2){
			$this->session->set_flashdata('message','Coins not available');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-coupon-code');
	}
	public function send_giftcard_message(){
		$result = $this->Marketing_model->send_giftcard_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}elseif($result == 2){
			$this->session->set_flashdata('message','Coins not available');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-gift-card');
	}
    
	public function birthday(){
		$this->load->view('salon/birthday');
	}

	public function anniversary(){
		$data['report'] = array();
		if(isset($_GET['daterange'])){
			$data['report'] = $this->Marketing_model->get_date_time_anniversary_filter();
		}
		$this->load->view('salon/anniversary',$data);
	}	

	public function service_repeat(){
		$data['service'] = array();
		if(isset($_GET['daterange'])){
			$data['service'] = $this->Marketing_model->get_service_repeat_filter();
		}
		$this->load->view('salon/service_repeat',$data);
	}	

	public function cancel_appointment(){
		$data['appointment'] = array();
		if(isset($_GET['daterange'])){
			$data['appointment'] = $this->Marketing_model->get_cancel_appointment_filter();
		}
		$this->load->view('salon/cancel_appointment',$data);
	}	

	public function lost_customer(){
		$data['lost_customer'] = array();
		if(isset($_GET['daterange'])){
			$data['lost_customer'] = $this->Marketing_model->get_lost_customer_filter();
		}
		$this->load->view('salon/lost_customer',$data);
	}

	public function offer(){
		$data['offer'] = array();
		if(isset($_GET['offer'])){
			$data['offer'] = $this->Salon_model->get_offer_filter();
		}
		$this->load->view('salon/offer',$data);
	}

	public function giftcards(){
		$data['giftcards'] = array();
		if(isset($_GET['giftcards'])){
			$data['giftcards'] = $this->Salon_model->get_giftcards_filter();
		}
		$this->load->view('salon/giftcards',$data);
	}

	public function coupons(){
		$data['coupons'] = array();
		if(isset($_GET['coupons'])){
			$data['coupons'] = $this->Salon_model->get_coupons_filter();
		}
		$this->load->view('salon/coupons',$data);
	}
	
	public function customize_message(){
		$data['single'] = array();
		if(isset($_GET['edit']) && isset($_GET['customer_report_type']) && $_GET['customer_report_type'] == '7'){
			$data['single'] = $this->Marketing_model->get_single_customize_message($_GET['edit']);
		}
		$this->load->view('salon/customize_message',$data);
	}

	public function booking_promotion(){
		$this->load->view('salon/booking_promotion');
	}
	public function trying_booking(){
		$this->load->view('salon/trying_booking');
	}
	public function promo_message(){
		$result = $this->Marketing_model->send_promo_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}elseif($result == 2){
			$this->session->set_flashdata('message','Coins not available');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('booking-promotion?customer_report_type=1');
	}
}
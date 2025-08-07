<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
	public function about()
	{
		// $this->load->view('welcome_message');
		$this->load->view('contact_us');
	}
	public function contact()
	{
		// $this->load->view('welcome_message');
		$this->load->view('front/contact');
	}
	public function terms(){
		$data['data'] = $this->Common_model->get_terms_policy('1');
		$this->load->view('terms',$data);
	} 
	public function policy(){
		$data['data'] = $this->Common_model->get_terms_policy('0');
		$this->load->view('policy',$data);
	} 
	public function user_guide(){
		$data['data'] = $this->Common_model->get_terms_policy('2');
		$this->load->view('user_guide',$data);
	} 

	public function skip_onboarding(){
		if(isset($_GET['status']) && base64_decode($_GET['status']) != ""){
			$status = base64_decode($_GET['status']);
			$allowed_status = ['3','5','7','9','10','11','12','13','14','15','16','18'];
			if(in_array($status,$allowed_status)){
				if($status == '7'){	// for Product Setup Step
					$products = $this->Salon_model->get_all_salon_branch_products();
					if(!empty($products)){
						$this->Salon_model->set_onboarding_status(base64_decode($_GET['status']));
		
						if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
							$this->session->set_flashdata('success', base64_decode($_GET['skip_step']) . ' Skipped successfully');
						}else{
							$this->session->set_flashdata('success','Onboarding Step Skipped successfully');
						}
						
						if(isset($_GET['redirect']) && base64_decode($_GET['redirect']) != ""){
							redirect(base64_decode($_GET['redirect']));
						}else{
							redirect('complete-profile');
						}
					}else{		
						if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
							$this->session->set_flashdata('message', 'Can not skip ' . base64_decode($_GET['skip_step']) . ', as atleast one product needs to be added');
						}else{
							$this->session->set_flashdata('message','Can not skip this step, as atleast one product needs to be added');
						}
						
						redirect($_SERVER['HTTP_REFERER']);
					}
				}elseif($status == '8'){	// for Services Setup Step
					$services = $this->Salon_model->get_all_salon_branch_services();
					if(!empty($services)){
						$this->Salon_model->set_onboarding_status(base64_decode($_GET['status']));
		
						if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
							$this->session->set_flashdata('success', base64_decode($_GET['skip_step']) . ' Skipped successfully');
						}else{
							$this->session->set_flashdata('success','Onboarding Step Skipped successfully');
						}
						
						if(isset($_GET['redirect']) && base64_decode($_GET['redirect']) != ""){
							redirect(base64_decode($_GET['redirect']));
						}else{
							redirect('complete-profile');
						}
					}else{		
						if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
							$this->session->set_flashdata('message', 'Can not skip ' . base64_decode($_GET['skip_step']) . ', as atleast one service needs to be added');
						}else{
							$this->session->set_flashdata('message','Can not skip this step, as atleast one service needs to be added');
						}
						
						redirect($_SERVER['HTTP_REFERER']);
					}
				}else{
					$this->Salon_model->set_onboarding_status(base64_decode($_GET['status']));
		
					if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
						$this->session->set_flashdata('success', base64_decode($_GET['skip_step']) . ' Skipped successfully');
					}else{
						$this->session->set_flashdata('success','Onboarding Step Skipped successfully');
					}
					
					if(isset($_GET['redirect']) && base64_decode($_GET['redirect']) != ""){
						redirect(base64_decode($_GET['redirect']));
					}else{
						redirect('complete-profile');
					}
				}
			}else{	
				if(isset($_GET['skip_step']) && base64_decode($_GET['skip_step']) != ""){
					$this->session->set_flashdata('message','You can not skip ' . base64_decode($_GET['skip_step']));
				}else{
					$this->session->set_flashdata('message','You can not skip current required step');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('message','You can not skip current required step');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function inactive(){
		$success = $this->Salon_model->inactive();
		if ($success) {
			$this->session->set_flashdata('success', 'Record inactivated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to inactivate the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	} 
	public function active(){
		$success = $this->Salon_model->active();
		if ($success) {
			$this->session->set_flashdata('success', 'Record activated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to activate the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	} 
	public function delete(){ 
		$success = $this->Salon_model->delete();
		if ($success) {
			$this->session->set_flashdata('success', 'Record deleted successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to delete the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function cancel_membership(){ 
		$success = $this->Salon_model->cancel_membership();
		if ($success) {
			$this->session->set_flashdata('success', 'Membership cancelled successfully');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong, please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function update_bill(){ 
		$success = $this->Salon_model->update_bill();
		if ($success) {
			$this->session->set_flashdata('success', 'Bill payment details updated successfully');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong, please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function payment_receipt(){
		$data['single_payment_details'] = $this->Admin_model->get_single_payment_details(base64_decode($this->uri->segment(2)));
		// echo '<pre>'; print_r($data['single_payment_details']); exit;
		$this->load->view('admin/payment-print',$data);
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
		// echo '<pre>'; print_r($data['customer_amount']); exit;
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
		$this->Marketing_model->send_birthday_wish();
	}
	public function send_anniversary_wish(){
		$this->Marketing_model->send_anniversary_wish();
	}
	public function send_service_reminder(){
		$this->Marketing_model->send_service_reminder();
	}
	public function send_lost_customer_message(){
		$this->Marketing_model->send_lost_customer_message();
	}
	public function send_tomorrow_booking_reminder(){
		$this->Marketing_model->send_tomorrow_booking_reminder();
	}
	public function send_today_booking_reminder(){
		$this->Marketing_model->send_today_booking_reminder();
	}
	public function send_yesterday_cancel_booking_message(){
		$this->Marketing_model->send_yesterday_cancel_booking_message();
	}
	public function reset_expired_subscriptions(){
		$this->Admin_model->reset_expired_subscriptions();
	}
	public function is_login(){
		if($this->session->userdata('branch_id') == ""){
			$this->session->set_flashdata('message','Please login to continue');
			redirect(base_url());   
		}
	} 
    public function upload_customers() {
		$this->is_login(); 
		$this->form_validation->set_rules('branch_id','Branch','required');
		if($this->form_validation->run() === FALSE){
			if(!isset($_GET['uploaded'])){
				$this->session->unset_userdata('ids');
			}
        	$this->load->view("salon/upload_customers");
		}else{
			$result = $this->Salon_model->upload_customers();
			if(!$result){
				$this->session->set_flashdata('message','Something went wrong, Please try again');
			}else{
				$this->session->set_flashdata('success','Customers record added successfully');
			}
			redirect('upload_customers');
		}
    }
	public function socket_logs(){
        $this->load->view("salon/socket_logs");
	}
	
	public function reschedule_booking(){
	   $this->load->view('salon/reschedule_booking');
	}
}

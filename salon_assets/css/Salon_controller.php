<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Salon_controller extends CI_Controller {
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
		// echo '<pre>'; print_r(explode(',',$this->session->userdata('subscription_feature_slugs'))); exit;
		if(!in_array($this->uri->segment(1),explode(',',$this->session->userdata('subscription_feature_slugs')))){
			$this->session->set_flashdata('message', 'You are not allowed to access');
			redirect('salon-dashboard-new');
		}
	}




public function off_btn_offset_session_time($id) {
    $success = $this->Salon_model->off_btn_offset_session_time($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Field off successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to inactivate the record');
    }
    redirect($_SERVER['HTTP_REFERER']);
}

public function on_btn_offset_session_time($id) {
    $success = $this->Salon_model->on_btn_offset_session_time($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Field on successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to activate the record');
    }
    redirect($_SERVER['HTTP_REFERER']);
}

public function off_booking_manual_btn($id) {
    $success = $this->Salon_model->off_booking_manual_btn($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Field off successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to inactivate the record');
    }
    redirect($_SERVER['HTTP_REFERER']);
}

public function on_booking_manual_btn($id) {
    $success = $this->Salon_model->on_booking_manual_btn($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Field on successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to activate the record');
    }
    redirect($_SERVER['HTTP_REFERER']);
}
public function salon_status_open($id) {
    $success = $this->Salon_model->salon_status_open($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Salon open successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to activate the record');
    }
    redirect('booking-rules/4');
}
public function salon_status_close($id) {
    $success = $this->Salon_model->salon_status_close($id);
    if ($success) {
        $this->session->set_flashdata('success', 'Field on successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to activate the record');
    }
    redirect($_SERVER['HTTP_REFERER']);
}


// salon dashboard

	public function booking_print(){
		$data['single'] = $this->Salon_model->get_single_booking_details(base64_decode($this->uri->segment(2)));
		$data['single_services'] = $this->Salon_model->get_single_booking_service_details(base64_decode($this->uri->segment(2)));
		$data['single_bill_services'] = $this->Salon_model->get_single_booking_service_details_for_bill(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		$data['single_payment_details'] = $this->Salon_model->get_single_booking_payment_details(base64_decode($this->uri->segment(2)),base64_decode($this->uri->segment(3)));
		$data['single_profile'] = $this->Salon_model->get_single_branch_profile();
		// echo '<pre>'; print_r($data['single_profile']); exit;
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



public function salon_dashboard(){
	$data['single_profile'] = $this->Salon_model->get_single_profile();
	$data['shift_list'] = $this->Salon_model->get_all_shift();
	$data['offers_list'] = $this->Salon_model->get_all_offers();
	$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
	$data['service_list'] = $this->Salon_model->get_salon_services_list_for_calender();
	$data['product_list'] = $this->Salon_model->get_all_product_master();
	$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
	$data['booking_rules'] = $this->Salon_model->get_booking_rules();
	$data['booking_list'] = $this->Salon_model->get_all_booking_for_calendar();
	$data['customer_list'] = $this->Salon_model->get_customer_info_for_calender();
	$data['booking_status'] = $this->Salon_model->get_all_booking_status_list();
	$data['color_list'] = $this->Admin_model->get_all_status_color();

	// echo "<pre>";print_r($data['salon_employee_list']);exit;
	if ($this->input->post('cancel_btn') == 'cancel_btn') {
		$result = $this->Salon_model->cancel_booking();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Booking Cancel successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Booking Cancel successfully');
			redirect('salon-dashboard');
		}
	} elseif ($this->input->post('payment_btn') == 'payment_btn') {
		$result = $this->Salon_model->booking_payment();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}elseif ($this->input->post('reshedule_btn') == 'reshedule_btn') {
		$result = $this->Salon_model->add_booking_notes();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}
	elseif ($this->input->post('add_service_btn') == 'add_service_btn') {
		$result = $this->Salon_model->add_single_booking();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}
		$this->load->view('salon/salon-dashboard', $data);
}

public function reschedule_service(){
	$result = $this->Salon_model->reschedule_service(base64_decode($this->uri->segment(2)));
	if ($result) {
		$this->session->set_flashdata('success', 'Service rescheduled successfully');
	} else {
		$this->session->set_flashdata('success', 'Service details not found, Please try again');
	}
	redirect('salon-dashboard-new');
}
public function add_extra_service(){
	$result = $this->Salon_model->add_extra_service(base64_decode($this->uri->segment(2)));
	if ($result) {
		$this->session->set_flashdata('success', 'Service added successfully');
	} else {
		$this->session->set_flashdata('success', 'Booking details not found, Please try again');
	}
	redirect('salon-dashboard-new');
}
public function update_service(){
	$result = $this->Salon_model->update_service(base64_decode($this->uri->segment(2)));
	if ($result) {
		$this->session->set_flashdata('success', 'Service updated successfully');
	} else {
		$this->session->set_flashdata('success', 'Booking details not found, Please try again');
	}
	redirect('salon-dashboard-new');
}

public function cancel_booking_service(){
	$result = $this->Salon_model->cancel_booking_service(base64_decode($this->uri->segment(2)));
	if ($result) {
		$this->session->set_flashdata('success', 'Service cancelled successfully');
	} else {
		$this->session->set_flashdata('success', 'Service details not found, Please try again');
	}
	redirect('salon-dashboard-new');
}

public function complete_booking_service(){
	$result = $this->Salon_model->complete_booking_service(base64_decode($this->uri->segment(2)));
	$status = explode('@@',$result)[0];
	$id = explode('@@',$result)[1];
	if ($status == '1') {
		$this->session->set_flashdata('success', 'Service completed successfully');
		redirect('salon-dashboard-new');
		// redirect('booking-print/'.base64_encode($id));
	} else {
		$this->session->set_flashdata('success', 'Service details not found, Please try again');
		redirect('salon-dashboard-new');
	}
}
public function set_punch_out(){
	$result = $this->Salon_model->set_punch_out();
	if ($result) {
		$this->session->set_flashdata('success', 'Punch out set successfully');
	} else {
		$this->session->set_flashdata('message', 'Error occured, please try again');
	}
	redirect('salon-attendance-list');
}

public function index(){
	$data['single_profile'] = $this->Salon_model->get_single_profile();
	$data['shift_list'] = $this->Salon_model->get_all_shift();
	$data['offers_list'] = $this->Salon_model->get_all_active_offers();
	$data['salon_employee_list'] = $this->Salon_model->get_all_salon_stylists_bookingwise();
	$data['service_list'] = $this->Salon_model->get_salon_services_list_for_calender();
	$data['product_list'] = $this->Salon_model->get_all_product_master();
	$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
	$data['booking_rules'] = $this->Salon_model->get_booking_rules();
	$data['booking_list'] = $this->Salon_model->get_all_booking_for_calendar();
	$data['customer_list'] = $this->Salon_model->get_customer_info_for_calender();
	$data['booking_status'] = $this->Salon_model->get_all_booking_status_list();
	$data['color_list'] = $this->Admin_model->get_all_status_color();
	$data['statuswise'] = $this->Salon_model->get_all_bookings_statuswise_dashboard();
	$data['attendancewise'] = $this->Salon_model->get_all_employee_attendance_dashboard();
	$data['close_setup'] = $this->Salon_model->get_salon_close_for_period_setup();
	$data['salon_avg_working'] = $this->Salon_model->get_salon_avg_start();
	$this->load->view('salon/salon-dashboard-new-calendar', $data);
}
public function salon_dashboard_new(){
	$data['single_profile'] = $this->Salon_model->get_single_profile();
	$data['shift_list'] = $this->Salon_model->get_all_shift();
	$data['offers_list'] = $this->Salon_model->get_all_active_offers();
	$data['salon_employee_list'] = $this->Salon_model->get_all_salon_stylists_bookingwise();
	$data['service_list'] = $this->Salon_model->get_salon_services_list_for_calender();
	$data['product_list'] = $this->Salon_model->get_all_product_master();
	$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
	$data['booking_rules'] = $this->Salon_model->get_booking_rules();
	$data['booking_list'] = $this->Salon_model->get_all_booking_for_calendar();
	$data['customer_list'] = $this->Salon_model->get_customer_info_for_calender();
	$data['booking_status'] = $this->Salon_model->get_all_booking_status_list();
	$data['color_list'] = $this->Admin_model->get_all_status_color();
	$data['statuswise'] = $this->Salon_model->get_all_bookings_statuswise_dashboard();
	$data['attendancewise'] = $this->Salon_model->get_all_employee_attendance_dashboard();
	$data['close_setup'] = $this->Salon_model->get_salon_close_for_period_setup();
	$data['salon_avg_working'] = $this->Salon_model->get_salon_avg_start();

	// echo "<pre>";print_r($data['salon_employee_list']);exit;
	if ($this->input->post('cancel_btn') == 'cancel_btn') {
		$result = $this->Salon_model->cancel_booking();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Booking Cancel successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Booking Cancel successfully');
			redirect('salon-dashboard');
		}
	} elseif ($this->input->post('payment_btn') == 'payment_btn') {
		$result = $this->Salon_model->booking_payment();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}elseif ($this->input->post('reshedule_btn') == 'reshedule_btn') {
		$result = $this->Salon_model->add_booking_notes();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}
	elseif ($this->input->post('add_service_btn') == 'add_service_btn') {
		$result = $this->Salon_model->add_single_booking();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('salon-dashboard');
		}
	}
		$this->load->view('salon/salon-dashboard-new', $data);
		// $this->load->view('salon/salon-dashboard-new-calendar', $data);
}
// salon booking color

public function set_booking_status(){
	$this->form_validation->set_rules('status_name','status_name','required');
	if($this->form_validation->run() === FALSE){
	$data['color_list'] = $this->Admin_model->get_all_status_color();
	$data['status_list'] = $this->Salon_model->get_all_status_color_list();
	$data['single'] = $this->Salon_model->get_single_status_color();
	// echo "<pre>";print_r($data['status_list']);exit;
	$this->load->view('salon/set-booking-status',$data);

	}else{
		$result = $this->Salon_model->set_booking_status();
		if($result == "0"){
			$this->session->set_flashdata('success','Record added successfully');
		}else{
			$this->session->set_flashdata('success','Record updated successfully');
		}
		redirect('set-booking-status');
	}
	
}

// asign memebership 


	
public function asign_membership_list(){
	$data['asign_list'] = $this->Salon_model->get_all_assigned_membership_new();
	// echo "<pre>";print_r($data['asign_list']);exit;
   $this->load->view('salon/asign_membership_list',$data);
} 

public function asign_membership(){
	$this->form_validation->set_rules('customer_phone','customer phone','required');
	if($this->form_validation->run() === FALSE){
		// $data['membership_list'] = $this->Salon_model->get_all_memebership();
		$data['setup'] = $this->Master_model->get_backend_setups();	
		$data['single_profile'] = $this->Salon_model->get_single_profile();
		$data['single'] = $this->Salon_model->get_single_customer_name();
		$data['state'] = $this->Salon_model->get_india_state();
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		// echo'<pre>';print_r($data['membership_list']);exit();
		$this->load->view('salon/asign_membership',$data); 
	}else{
		$receipt = "";
		if($_FILES['receipt']['name'] !=""){
			$temp = explode('.', $_FILES['receipt']['name']);
			$ext = end($temp);
			$new_profile_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
			$config = array(
				'upload_path' 	=> "salon_assets/images/payment_receipt/",
				'allowed_types' => "pdf|jpg|jpeg|png",
				'file_name'		=> $new_profile_photo,
			);			
			$this->upload->initialize($config);
			if($this->upload->do_upload('receipt')){
				$data = $this->upload->data();				
				$receipt = $data['file_name'];	
			}else{ 
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
		}else{
			$receipt = $this->input->post('old_file');
		}
		$result = $this->Salon_model->asign_membership($receipt);
		if($result == "0"){
			$this->session->set_flashdata('success','Record added successfully');
		}else{
			$this->session->set_flashdata('success','Record updated successfully');
		}
		redirect('asign-membership');
	} 
}
// assign giftcard
public function asign_giftcard(){
	$this->form_validation->set_rules('customer_phone','customer phone','required');
	if($this->form_validation->run() === FALSE){
		// $data['package_list'] = $this->Salon_model->get_all_package();
		$data['setup'] = $this->Master_model->get_backend_setups();	
		$data['single_profile'] = $this->Salon_model->get_single_profile();
		$data['single'] = $this->Salon_model->get_single_customer_name();
		$data['state'] = $this->Salon_model->get_india_state();
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		$this->load->view('salon/asign_giftcard',$data); 
	}else{
		$result = $this->Salon_model->asign_giftcard();
		if($result){
			$this->session->set_flashdata('success','Record added successfully');
		}else{
			$this->session->set_flashdata('success','Record updated successfully');
		}
		redirect('asign-giftcard-list');
	} 
}
public function asign_giftcard_list(){
	$data['asign_list'] = $this->Salon_model->get_all_assigned_giftcard_new();
	// echo "<pre>";print_r($data['asign_list']);exit;
   $this->load->view('salon/asign_giftcard_list',$data);
} 
// assign package
public function asign_package_list(){
	$data['asign_list'] = $this->Salon_model->get_all_assigned_package_new();
	// echo "<pre>";print_r($data['asign_list']);exit;
   $this->load->view('salon/asign_package_list',$data);
} 

public function asign_package(){
	$this->form_validation->set_rules('customer_phone','customer phone','required');
	if($this->form_validation->run() === FALSE){
		// $data['package_list'] = $this->Salon_model->get_all_package();
		$data['setup'] = $this->Master_model->get_backend_setups();	
		$data['single_profile'] = $this->Salon_model->get_single_profile();
		$data['single'] = $this->Salon_model->get_single_customer_name();
		$data['state'] = $this->Salon_model->get_india_state();
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		$this->load->view('salon/asign_package',$data); 
	}else{
		$result = $this->Salon_model->asign_package();
		if($result == "0"){
			$this->session->set_flashdata('success','Record added successfully');
		}else{
			$this->session->set_flashdata('success','Record updated successfully');
		}
		redirect('asign-package');
	} 
}

public function store_images(){
	$this->form_validation->set_rules('store_images', 'Images', 'required');
	if ($this->input->post('images_submit') != 'images_submit') {
		$data['single_profile'] = $this->Salon_model->get_salon_detail_for_profile();
		$data['store_images'] = $this->Salon_model->get_salon_images();
		// echo "<pre>";print_r($data['single_profile']);exit;
		$this->load->view('salon/store_images', $data); 
	}else{
		if(isset($_FILES['store_images']) && $_FILES['store_images']['name'] != ""){
			$files = $_FILES;
			$cpt = count($_FILES['store_images']['name']);
			for($i=0; $i<$cpt; $i++){
				$_FILES['userfile']['name']= $files['store_images']['name'][$i];
				$_FILES['userfile']['type']= $files['store_images']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['store_images']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['store_images']['error'][$i];
				$_FILES['userfile']['size']= $files['store_images']['size'][$i];

				$this->load->library('upload');
				$this->upload->initialize($this->set_upload_options_store_images());

				if (! $this->upload->do_upload()){
					$error = array('error' => $this->upload->display_errors());
					echo $this->upload->display_errors();
				}else{
					$all_file = $this->upload->data();
					$file_name[] = $all_file['file_name'];	
				}	
			}
		}
		$store_images = implode(',',$file_name);
		$result  =$this->Salon_model->add_salon_images($store_images);
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
		} 
		redirect('store-images');
	}
} 
public function store_reviews(){
	$data['reviews'] = $this->Salon_model->get_salon_reviews();
	$this->load->view('salon/store_reviews', $data); 
} 





// booking rules


public function store_booking_rules(){
	$profile = $this->Salon_model->get_user_profile();
	if ($profile->booking_rule_setup_status == '1' || date('Y-m-d H:i:s', strtotime($profile->last_booking_rule_setup_block . ' + 1 Day')) <= date('Y-m-d H:i:s')) {
		$data['store_type'] = $this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));   
		$data['single_rules'] = $this->Salon_model->get_salon_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));
		$this->load->view('salon/store-booking-rules',$data);
	}else{
		$this->session->set_flashdata('message', 'You are not allowed to access. Please contact admin.');
		redirect('salon-dashboard-new');
	}
}
public function booking_rules(){
	$data['on_off_btn'] = $this->Salon_model->get_on_off_btn(); 
	$data['reason_list'] = $this->Salon_model->get_all_reason();
	$data['open_or_close'] = $this->Salon_model->get_salon_status(); 
	$data['booking_manual_btn'] = $this->Salon_model->get_booking_manual_btn(); 
	$data['holiday_list'] = $this->Salon_model->get_all_holiday_list();
	$data['shift_list'] = $this->Salon_model->get_all_shift();
	$data['single_shift'] = $this->Salon_model->get_single_shift(); 
	$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
	$data['single'] = $this->Salon_model->get_single_work_schedule(); 
	$data['notification'] = $this->Salon_model->get_all_notification_list(); 
	// echo "<pre>";print_r($data['open_or_close']);exit;

	if ($this->input->post('holiday-btn') == 'holiday-btn') {
		$result = $this->Salon_model->set_holiday();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/3');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/3');
		}
	 }
		 elseif ($this->input->post('per_session_stylist_btn') == 'per_session_stylist_btn') {
			$result = $this->Salon_model->set_session_stylist();
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record added successfully');
				redirect('booking-rules/1');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
				redirect('booking-rules/1');
			}
		 }
    elseif ($this->input->post('booking_time_range_btn') == 'booking_time_range_btn') {
        $result = $this->Salon_model->set_booking_time_range();
        if ($result == "0") {
            $this->session->set_flashdata('success', 'Record added successfully');
            redirect('booking-rules/1');
        } else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/1');
		}
	 }
	//  add
	 elseif($this->input->post('session_avg_duration_btn') == 'session_avg_duration_btn') {
		$result = $this->Salon_model->set_avg_duration();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/1');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/1');
		}
    }
	// end
	
    elseif($this->input->post('offset_session_time_btn') == 'offset_session_time_btn') {
		$result = $this->Salon_model->set_offset_session_time();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/1');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/1');
		}
    }
	elseif($this->input->post('reward_point_cancel_btn') == 'reward_point_cancel_btn') {
		$result = $this->Salon_model->set_cancel_reward_point();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/2');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/2');
		}
    }
	elseif($this->input->post('cancel_booking_number_btn') == 'cancel_booking_number_btn') {
		$result = $this->Salon_model->set_number_of_time_cancel_booking();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/2');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/2');
		}
    }
	elseif($this->input->post('cancel_appoinment_time_btn') == 'cancel_appoinment_time_btn') {
		$result = $this->Salon_model->set_cancel_appoinment_time();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/2');
		} else {
			redirect('booking-rules/2');
		}
    }
	elseif($this->input->post('salon_close_date_btn') == 'salon_close_date_btn') {
		$result = $this->Salon_model->set_salon_close_date();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/4');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/4');
		}
    }
	elseif($this->input->post('online_price_btn') == 'online_price_btn') {
		$result = $this->Salon_model->set_online_price();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/5');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/5');
		}
    }
	elseif($this->input->post('reshedule_hours_btn') == 'reshedule_hours_btn') {
		$result = $this->Salon_model->set_reshedule_hours();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/2');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/2');
		}
    }
	
	elseif($this->input->post('salon-time-btn') == 'salon-time-btn') {
		$result = $this->Salon_model->add_salon_time();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules');
		}
    }
	elseif($this->input->post('salon_type_btn') == 'salon_type_btn') {
		$result = $this->Salon_model->set_salon_type();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/6');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/6');
		}
    }
	elseif($this->input->post('emp_selection_btn') == 'emp_selection_btn') {
		$result = $this->Salon_model->set_emp_selection();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/7');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/7');
		}
    }

	// notification

	elseif($this->input->post('slot_confirm_btn') == 'slot_confirm_btn') {
		$result = $this->Salon_model->set_slot_confirm_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
    elseif($this->input->post('slot_reshedule_btn') == 'slot_reshedule_btn') {
		$result = $this->Salon_model->set_slot_reshedule_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('slot_cancel_btn') == 'slot_cancel_btn') {
		$result = $this->Salon_model->set_slot_cancel_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
    elseif($this->input->post('payment_received_btn') == 'payment_received_btn') {
		$result = $this->Salon_model->set_payment_receive_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('birthday_btn') == 'birthday_btn') {
		$result = $this->Salon_model->set_birthday_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('anniversary_btn') == 'anniversary_btn') {
		$result = $this->Salon_model->set_anniversary_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('online_slot_book_btn') == 'online_slot_book_btn') {
		$result = $this->Salon_model->set_online_slot_book_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('voucher_btn') == 'voucher_btn') {
		$result = $this->Salon_model->set_voucher_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }

	elseif($this->input->post('booking_reminder_btn') == 'booking_reminder_btn') {
		$result = $this->Salon_model->set_booking_reminder_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('stylist_booking_btn') == 'stylist_booking_btn') {
		$result = $this->Salon_model->set_stylist_booking_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }

	elseif($this->input->post('feedback_btn') == 'feedback_btn') {
		$result = $this->Salon_model->set_feedback_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('reward_message_btn') == 'reward_message_btn') {
		$result = $this->Salon_model->set_reward_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	elseif($this->input->post('otp_message_btn') == 'otp_message_btn') {
		$result = $this->Salon_model->set_otp_message();
		if ($result == "0") {
			$this->session->set_flashdata('success', 'Record added successfully');
			redirect('booking-rules/8');
		} else {
			
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('booking-rules/8');
		}
    }
	else {
        // $data['single'] = $this->Salon_model->set_booking_rules();
        $this->load->view('salon/booking-rules', $data);
    }
}

	// new Booking
	
	public function booking_calender(){
		$data['booking_list'] = $this->Salon_model->get_all_booking();
	   $this->load->view('salon/booking-calender',$data);
	}
	public function bill_setup(){
	   $this->load->view('salon/generate_bill');
	}
	public function generate_bill(){
		$result = $this->Salon_model->generate_bill(base64_decode($this->uri->segment(2)));
		$status = explode('@@@',$result)[0];
		$id = explode('@@@',$result)[1];
		if ($status == '1') {
			$this->session->set_flashdata('success', 'Bill Generated Successfully');
			// redirect('booking-print/'.$this->uri->segment(2).'/'.base64_encode($id));
			redirect('salon-dashboard-new');
		} else {
			$this->session->set_flashdata('success', 'Booking not found. Please try again');
			redirect('booking-list');
		}	
	}
	public function product_generate_bill(){
		$result = $this->Salon_model->product_generate_bill(base64_decode($this->uri->segment(2)));
		$status = explode('@@@',$result)[0];
		$id = explode('@@@',$result)[1];
		if ($status == '1') {
			$this->session->set_flashdata('success', 'Bill Generated Successfully');
			redirect('product-booking-print/'.$this->uri->segment(2).'/'.base64_encode($id));
		} else {
			$this->session->set_flashdata('success', 'Booking not found. Please try again');
			redirect('product-booking-list');
		}	
	}
	public function stop_bookings(){
		$result = $this->Salon_model->stop_bookings($this->uri->segment(2));
		if ($result) {
			$this->session->set_flashdata('success', 'Bookings stopped Successfully');
			redirect('working-hours?active='.$this->uri->segment(3));
		} else {
			$this->session->set_flashdata('success', 'Something went wrong. Please try again');
			redirect('working-hours?active='.$this->uri->segment(3));
		}	
	}
	public function start_bookings(){
		$result = $this->Salon_model->start_bookings($this->uri->segment(2));
		if ($result) {
			$this->session->set_flashdata('success', 'Bookings started Successfully');
			redirect('working-hours?active='.$this->uri->segment(3));
		} else {
			$this->session->set_flashdata('success', 'Something went wrong. Please try again');
			redirect('working-hours?active='.$this->uri->segment(3));
		}	
	}



	public function add_new_booking_new(){
		$data['setup'] = $this->Master_model->get_backend_setups();			
		$data['coupon_list'] = $this->Salon_model->get_all_active_coupon_list();
		$data['gift_card_list'] = $this->Salon_model->get_all_gift_list();
		$data['offers_list'] = $this->Salon_model->get_all_active_offers();
		$data['state'] = $this->Salon_model->get_state_list();
		$data['category'] = $this->Salon_model->get_all_sup_category();
		$data['package_list'] = $this->Salon_model->get_all_package();
		$data['booking_list'] = $this->Salon_model->get_all_booking();
		$data['service_booking'] = $this->Salon_model->get_service_for_booking();
		$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
		$data['product_list'] = $this->Salon_model->get_all_product_master();
		$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
		$data['shift_list'] = $this->Salon_model->get_all_shift();
		$data['service_list'] = $this->Salon_model->get_all_services();
		$data['membership_list'] = $this->Salon_model->get_all_memebership();
		$data['store_profile'] = $this->Salon_model->get_all_salon_profile_single();
		$data['default_service'] = $this->Salon_model->get_default_services_for_booking();
		$data['default_category'] = $this->Salon_model->get_default_category_for_booking();
		// $data['by_default'] = $this->Salon_model->get_category_from_by_default();
		$data['last_id'] = $this->Salon_model->get_last_customer_detail();
		$data['single'] = $this->Salon_model->get_single_booking_customer_detail();
        $data['booking_rules'] = $this->Salon_model->get_booking_rules();
		$data['close_setup'] = $this->Salon_model->get_salon_close_for_period_setup();
		$data['stylists'] = $this->Salon_model->get_salon_all_stylists();
		
        // $data['single_booking'] = $this->Salon_model->get_single_booking_row(isset($_GET['booking_id']) ? base64_decode($_GET['booking_id']) : '');
        // $data['single_booking_details'] = $this->Salon_model->get_single_booking_details_result(isset($_GET['booking_id']) ? base64_decode($_GET['booking_id']) : '');

		if ($this->input->post('customer_button') == 'customer_button') {
			$result = $this->Salon_model->add_new_customer();
			if ($result == 0) {
				// $this->session->set_flashdata('success', 'Record added successfully');
				// redirect('add-new-booking');
			}else if($result == 3) {
				$this->session->set_flashdata('success', 'Phone no already registered');
				redirect('add-new-booking-new');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
				redirect('add-new-booking-new');
			}
		}elseif ($this->input->post('booking_button') == 'booking_button') {
			// exit;
			$result = $this->Salon_model->add_new_booking_new();
			if($result == 'not_allowed'){
				$this->session->set_flashdata('message', 'Slot already taken, Please try again with another slot');
				redirect('add-new-booking-new');
			}else{
				if ($result != "") {
					$this->session->set_flashdata('success', 'Booking submitted successfully');
					redirect('salon-dashboard-new?stylist='.$result);
				} else {
					$this->session->set_flashdata('message', 'Error while booking confirmation, Please try again');
					redirect('add-new-booking-new');
				}
			}
		}else {
			$this->load->view('salon/add-new-booking-new', $data);
		}
	}
	
	public function product_booking(){	
		$data['setup'] = $this->Master_model->get_backend_setups();	
		$data['single_booking'] = $this->Salon_model->get_single_booking_details(isset($_GET['booking_id']) ? $_GET['booking_id'] : '');	
		$data['store_profile'] = $this->Salon_model->get_all_salon_profile_single();	
		$data['category'] = $this->Salon_model->get_salon_product_category();
        $data['booking_rules'] = $this->Salon_model->get_booking_rules();
		$data['stylists'] = $this->Salon_model->get_salon_all_stylists();
        $data['is_emergency_today'] = $this->Salon_model->check_is_salon_close_for_period_setup_datewise(date('Y-m-d'));
		$data['close_setup'] = $this->Salon_model->get_salon_close_for_period_setup();
		// echo '<pre>'; print_r($data['single_booking']); exit();
		if ($this->input->post('customer_button') == 'customer_button') {
			$result = $this->Salon_model->add_new_customer_add_product();
			if ($result == 0) {

			}else if($result == 3) {
				$this->session->set_flashdata('success', 'Phone no already registered');
				redirect('product-booking');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
				redirect('product-booking');
			}
		}elseif ($this->input->post('booking_button') == 'booking_button') {
			$result = $this->Salon_model->add_product_booking();
			if ($result['status']) {
				$this->session->set_flashdata('success', 'Booking submitted successfully');
				redirect('product-booking-list?booking_id=' . $result['booking_id']);
			} else {
				$this->session->set_flashdata('message', 'Error while booking confirmation, Please try again');
				redirect('product-booking');
			}
		}else {
			$this->load->view('salon/product_booking',$data);
		}	
	}
	
	public function add_new_booking(){
		
		$data['gift_card_list'] = $this->Salon_model->get_all_gift_list();
		$data['offers_list'] = $this->Salon_model->get_all_offers();
		$data['state'] = $this->Salon_model->get_state_list();
		$data['category'] = $this->Salon_model->get_all_sup_category();
		$data['package_list'] = $this->Salon_model->get_all_package();
		$data['booking_list'] = $this->Salon_model->get_all_booking();
		$data['service_booking'] = $this->Salon_model->get_service_for_booking();
		$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
		$data['product_list'] = $this->Salon_model->get_all_product_master();
		$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
		$data['shift_list'] = $this->Salon_model->get_all_shift();
		$data['service_list'] = $this->Salon_model->get_all_services();
		$data['membership_list'] = $this->Salon_model->get_all_memebership();
		$data['store_profile'] = $this->Salon_model->get_all_salon_profile();
		$data['default_service'] = $this->Salon_model->get_default_services_for_booking();
		$data['default_category'] = $this->Salon_model->get_default_category_for_booking();
		// $data['by_default'] = $this->Salon_model->get_category_from_by_default();
		$data['last_id'] = $this->Salon_model->get_last_customer_detail();
		$data['single'] = $this->Salon_model->get_single_booking_customer_detail();
		// echo "<pre>";print_r($data['salon_employee_list']);exit;
	
	if ($this->input->post('customer_button') == 'customer_button') {
		$result = $this->Salon_model->add_new_customer();
		if ($result == "0") {
			// $this->session->set_flashdata('success', 'Record added successfully');
			// redirect('add-new-booking');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('add-new-booking');
		}
	 }
	 elseif ($this->input->post('booking_button') == 'booking_button') {
		$result = $this->Salon_model->add_new_booking();
		if ($result == "0") {
				//  echo "<pre>";print_r($_POST);exit;
			$this->session->set_flashdata('success', 'Add new booking successfully');
			redirect('salon-dashboard');
		} else {
			$this->session->set_flashdata('success', 'Record updated successfully');
			redirect('add-new-booking');
		}
	 }
	 else {
		$this->load->view('salon/add-new-booking', $data);
	}
}
	

// public function add_booking_stylist($stylist_id){
// 		$services_history = $this->Salon_model->get_salon_services_list_by_selected_stylist($stylist_id);
// 		$data['stylist_services_list'] = $services_history;

// 		$data['gift_card_list'] = $this->Salon_model->get_all_gift_list();
// 		$data['offers_list'] = $this->Salon_model->get_all_offers();
// 		$data['state'] = $this->Salon_model->get_state_list();
// 		$data['category'] = $this->Salon_model->get_all_sup_category();
// 		$data['package_list'] = $this->Salon_model->get_all_package();
// 		$data['booking_list'] = $this->Salon_model->get_all_booking();
// 		$data['service_booking'] = $this->Salon_model->get_service_for_booking();
// 		$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
// 		$data['product_list'] = $this->Salon_model->get_all_product_master();
// 		$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
// 		$data['shift_list'] = $this->Salon_model->get_all_shift();
// 		$data['service_list'] = $this->Salon_model->get_salon_services_list_for_calender();
// 		$data['membership_list'] = $this->Salon_model->get_all_memebership();
// 		$data['last_id'] = $this->Salon_model->get_last_customer_detail();
// 		$data['store_profile'] = $this->Salon_model->get_single_profile();
// 		$data['by_default'] = $this->Salon_model->get_category_from_by_default();
// 		// echo "<pre>";print_r($data['service_list']);exit;

// 		if ($this->input->post('customer_button') == 'customer_button') {
// 			$result = $this->Salon_model->add_new_customer();
// 			if ($result == "0") {
// 				$this->session->set_flashdata('success', 'Record added successfully');
// 				redirect('add-new-booking-stylist',$data);
// 			} else {
// 				$this->session->set_flashdata('success', 'Record updated successfully');
// 				redirect('add-new-booking-stylist');
// 			}
// 		 }
// 		 else if ($this->input->post('booking_button') == 'booking_button') {
// 		$result = $this->Salon_model->add_new_booking();
// 		if ($result == "0") {
// 			$this->session->set_flashdata('success', 'Add new booking successfully');
// 			redirect('add-new-booking-stylist');
// 		} else {
// 			$this->session->set_flashdata('success', 'Record updated successfully');
// 			redirect('add-new-booking-stylist');
// 		}
// 	 }
// 	 else {
// 		$this->load->view('salon/add-new-booking-stylist', $data);
// 	}
// }


	
	
	
    
	// echo "<pre>";print_r($_POST);exit; 


	

	//for category Service master

	public function add_sup_category(){
		$this->form_validation->set_rules('sup_category','services name','required');
		if($this->form_validation->run() === FALSE){
			$data['category_name_list'] = $this->Salon_model->get_all_sup_category();
			$data['single'] = $this->Salon_model->get_single_sup_category();
			$this->load->view('salon/add-sup-category',$data);

		}else{
			$category_image = "";
			if($_FILES['category_image']['name'] !=""){
				$temp = explode('.', $_FILES['category_image']['name']);
				$ext = end($temp);
				$new_category_image = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/service_category_image/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_category_image,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('category_image')){
					$data = $this->upload->data();				
					$category_image = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$category_image = $this->input->post('old_category_image');
			} 
			$result=$this->Salon_model->add_sup_category($category_image);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-sup-category');
		}
	}
	public function add_service_sub_category(){
		$this->form_validation->set_rules('category','category name','required');
		if($this->form_validation->run() === FALSE){
			$data['category'] = $this->Salon_model->get_all_sup_category();
			$data['category_name_list'] = $this->Salon_model->get_all_service_sub_category();
			$data['single'] = $this->Salon_model->get_single_service_sub_category();
			$this->load->view('salon/add_service_sub_category',$data); 
		}else{
			$result = $this->Salon_model->add_service_sub_category();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add_service_sub_category');
		}
	}

	public function add_shift(){
		$this->form_validation->set_rules('shift_name','Shift Name','required');
		if($this->form_validation->run() === FALSE){
			$data['shift_list'] = $this->Salon_model->get_all_shift();

			$data['single'] = $this->Salon_model->get_single_shift();
			$this->load->view('salon/add-shift',$data);
		}else{
			$result = $this->Salon_model->add_shift();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-shift');
		}
	}



	// For Add designation



	public function add_designation(){
		
		$this->form_validation->set_rules('designation','desiganation Name','required');
		if($this->form_validation->run() === FALSE){
			$data['designation_list'] = $this->Salon_model->get_all_designation();
			$data['single'] = $this->Salon_model->get_single_designation();
			$this->load->view('salon/add-designation',$data);
		}else{
			

			$result = $this->Salon_model->add_designation();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-designation');
		}
	}


	// Add product Category

	public function product_category(){
		$this->form_validation->set_rules('product_category','Category','required');
		if($this->form_validation->run() === FALSE){
			$data['product_category_list'] = $this->Salon_model->get_all_product_category();
			$data['single'] = $this->Salon_model->get_single_product_category();
			$this->load->view('salon/product-category',$data);

		}else{
			$result = $this->Salon_model->product_category();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('product-category');
		}
	}

	
	// Add product UNit

	public function product_unit(){
		$this->form_validation->set_rules('product_unit','Category','required');
		if($this->form_validation->run() === FALSE){
			$data['product_unit_list'] = $this->Salon_model->get_all_product_unit();
			$data['single'] = $this->Salon_model->get_single_product_unit();
			$this->load->view('salon/product-unit',$data);

		}else{
			$result = $this->Salon_model->product_unit();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('product-unit');
		}
	}


	// For Add product
 

	public function product_stock_list(){
		$data['products'] = $this->Salon_model->get_all_salon_products();
		$data['select_product_category'] = $this->Salon_model->get_product_category();
		$data['supplier'] = $this->Salon_model->get_all_supplier();
		// echo "<pre>";print_r($data['product_list']);exit;
	   $this->load->view('salon/product-stock-list',$data);
	}

	public function add_product_stock(){
		$this->form_validation->set_rules('product_name','Product Name','required');
		if($this->form_validation->run() === FALSE){
			$data['product_list'] = $this->Salon_model->get_all_product();
			$data['single'] = $this->Salon_model->get_single_product();
			$data['product_master_list'] = $this->Salon_model->get_all_product_master();
			$data['select_product_category'] = $this->Salon_model->get_product_category();
			$data['service_booking'] = $this->Salon_model->get_service_for_booking();
			$data['supplier_list'] = $this->Salon_model->get_active_supplier();
			
			$this->load->view('salon/add-product-stock',$data);
		}else{
			$result=$this->Salon_model->add_product_stock();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('product-stock-list');
		 }			
		}
		
	public function supplier_management(){
		$this->form_validation->set_rules('name','Supplier Name','required');
		if($this->form_validation->run() === FALSE){
			$data['supplier_list'] = $this->Salon_model->get_all_supplier();
			$data['single'] = $this->Salon_model->get_single_supplier($this->uri->segment(2));			
			$this->load->view('salon/supplier_management',$data);
		}else{
			$result=$this->Salon_model->add_supplier();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('supplier-management');
		 }			
	}



// For Add gallary Master



		public function add_gallary(){
		$this->form_validation->set_rules('category','category Name','required');
		if($this->form_validation->run() === FALSE){
			$data['gallary_list'] = $this->Salon_model->get_all_gallary();
			$data['single'] = $this->Salon_model->get_single_gallary();
			$data['category'] = $this->Salon_model->get_category();
			$data['sub_category'] = $this->Salon_model->get_sub_category();
			$this->load->view('salon/add-gallary',$data);
		}else{

			$gallary_image = array();
			if(isset($_FILES['gallary_image']) && $_FILES['gallary_image']['name'] != ""){
			    $files = $_FILES;
			    $cpt = count($_FILES['gallary_image']['name']);
			    for($i=0; $i<$cpt; $i++){
			        $_FILES['userfile']['name'] = $files['gallary_image']['name'][$i];
			        $_FILES['userfile']['type'] = $files['gallary_image']['type'][$i];
			        $_FILES['userfile']['tmp_name'] = $files['gallary_image']['tmp_name'][$i];
			        $_FILES['userfile']['error'] = $files['gallary_image']['error'][$i];
			        $_FILES['userfile']['size'] = $files['gallary_image']['size'][$i];

			        $this->load->library('upload');
			        $this->upload->initialize($this->Salon_model->set_upload_gallary_img());

			        if (!$this->upload->do_upload()){
			            $error = array('error' => $this->upload->display_errors());
			            echo $this->upload->display_errors();
			            // Handle the error as needed
			        } else {
			            $all_file = $this->upload->data();
			            $gallary_image[] = $all_file['file_name']; 
			        }    
			    }
			   $gallary_image_str = implode(',', $gallary_image);
               $result=$this->Salon_model->add_gallary($gallary_image_str);
			   if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-gallary');
			}
		
			redirect('add-gallary');

        }
    }


		// For Add spesail service



	public function add_special_service(){
		$this->form_validation->set_rules('category','desiganation Name','required');
		if($this->form_validation->run() === FALSE){
			$data['special_service_list'] = $this->Salon_model->get_all_special_service(); 
			$data['single'] = $this->Salon_model->get_single_special_service();
			$data['category'] = $this->Salon_model->get_sup_category();
			$data['service_name'] = $this->Salon_model->get_service_name();
			//$data['sup_category'] = $this->Salon_model->get_sup_category();
			$this->load->view('salon/add-special-service',$data);
		}else{
			

			$result = $this->Salon_model->add_special_service();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-special-service');
		}
	}




	// For Add Salon Employee


	public function employee_list(){
		$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
	   $this->load->view('salon/salon-employee-list',$data);
	}


	public function add_salon_employee(){
		$this->form_validation->set_rules('full_name','Name','required');
		if($this->form_validation->run() === FALSE){
			$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
			$data['single'] = $this->Salon_model->get_single_salon_employee();
			$data['category'] = $this->Salon_model->get_category();
			$data['shift_name'] = $this->Salon_model->get_shift();
			$data['select_designation'] = $this->Salon_model->get_designation();
			$data['service_name'] = $this->Salon_model->get_salon_services_list_for_emp();
			
			$this->load->view('salon/add-salon-employee',$data);
		}else{
			echo "<pre>";print_r($_POST);exit;
			$aadhar_front = "";
			if($_FILES['aadhar_front']['name'] !=""){
				$temp = explode('.', $_FILES['aadhar_front']['name']);
				$ext = end($temp);
				$new_aadhar_front = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_aadhar/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_aadhar_front,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('aadhar_front')){
					$data = $this->upload->data();				
					$aadhar_front = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$aadhar_front = $this->input->post('old_aadhar_front');
			} 
			$profile_photo = "";
			if($_FILES['profile_photo']['name'] !=""){
				$temp = explode('.', $_FILES['profile_photo']['name']);
				$ext = end($temp);
				$new_profile_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_profile/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_profile_photo,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('profile_photo')){
					$data = $this->upload->data();				
					$profile_photo = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$profile_photo = $this->input->post('old_profile_photo');
			}

			$result = $this->Salon_model->add_salon_employee($aadhar_front,$profile_photo);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-salon-employee');
		}
	}


 

	public function add_customer_discount(){
		$this->form_validation->set_rules('days','days','required');
		if($this->form_validation->run() === FALSE){
			$data['discount_list'] = $this->Salon_model->get_all_discount();
			$data['single'] = $this->Salon_model->get_single_discount();
			// echo "<pre>";print_r($data['single']);exit;

			$this->load->view('salon/add-customer-discount',$data);
		}else{
			$result = $this->Salon_model->add_customer_discount();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-customer-discount');
		}
	}
	
	public function add_customer(){
		$this->form_validation->set_rules('full_name','Full Name','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Salon_model->get_single_customer($this->uri->segment(2));
			$data['state'] = $this->Salon_model->get_state_list();
			$this->load->view('salon/add-customer',$data);
		}else{
			$result = $this->Salon_model->add_new_customer();
			if($result == 0){
				$this->session->set_flashdata('success','Customer added successfully');
			}else{
				$this->session->set_flashdata('success','Customer updated successfully');
			}
			redirect('customer-list');
		}
	}
	public function add_message(){
		$result = $this->Salon_model->add_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message added & sent for approval successfully');
		}else{
			$this->session->set_flashdata('success','Message updated successfully');
		}
		redirect('customize_message?customer_report_type=7');
	}
	public function send_customize_message(){
		$result = $this->Salon_model->send_customize_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('customize_message?customer_report_type=1');
	}
	public function send_offer_message(){
		$result = $this->Salon_model->send_offer_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-offers');
	}
	public function send_coupon_message(){
		$result = $this->Salon_model->send_coupon_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-coupon-code');
	}
	public function send_giftcard_message(){
		$result = $this->Salon_model->send_giftcard_message();
		if($result == 0){
			$this->session->set_flashdata('success','Message sent sucessfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong, Please try again');
		}
		redirect('add-gift-card');
	}
	
	public function add_payment(){
		$this->form_validation->set_rules('customer','Customer','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Salon_model->get_single_payment($this->uri->segment(2));
			$data['customers'] = $this->Salon_model->get_all_customer();
			$this->load->view('salon/add-payment',$data);
		}else{
			$result = $this->Salon_model->add_payment();
			if($result == "0"){
				$this->session->set_flashdata('success','Payment added successfully');
			}else{
				$this->session->set_flashdata('success','Payment updated successfully');
			}
			redirect('add-payment');
		}
	}
	public function add_customer_payment(){
		$result = $this->Salon_model->add_customer_payment(base64_decode($this->uri->segment(2)));
		if($result == 1){
			$this->session->set_flashdata('success','Customer payment added successfully');
		}else{
			$this->session->set_flashdata('message','Error while addig payment, please try again');
		}
		redirect('customer-list');
	}


 
	public function add_facilities(){
		$this->form_validation->set_rules('facilities_name','Facilities Name','required');
		if($this->form_validation->run() === FALSE){
			$data['facilities_list'] = $this->Salon_model->get_all_facilities();
			$data['single'] = $this->Salon_model->get_single_facilities();
			$this->load->view('salon/add-facilities',$data);
		}else{
             $facilities_image = "";
			if($_FILES['facilities_image']['name'] !=""){
				$temp = explode('.', $_FILES['facilities_image']['name']);
				$ext = end($temp);
				$new_facilities_image = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/facilities_image/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_facilities_image,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('facilities_image')){
					$data = $this->upload->data();				
					$facilities_image = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$facilities_image = $this->input->post('old_facilities_image');
			} 
			$result=$this->Salon_model->add_facilities($facilities_image);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-facilities');
		 }			
	}




    public function student_list(){
		$data['student_list'] = $this->Salon_model->get_all_student();
		// echo "<pre>";print_r($data['student_list']);exit;
	   $this->load->view('salon/student-list',$data);
	}
	

	public function add_student(){
		$this->form_validation->set_rules('student_name','student name','required');
		if($this->form_validation->run() === FALSE){
			$data['student_list'] = $this->Salon_model->get_all_student();
			$data['single'] = $this->Salon_model->get_single_student();
			// echo "<pre>";print_r($data['single']);exit;
			$data['course_name'] = $this->Salon_model->get_course();
			$this->load->view('salon/add-student',$data);
		}else{
			$result = $this->Salon_model->add_student();
			if($result == "0"){
				$customer_id=$this->session->userdata('id');
				    $heading    = "Add Student Successfully";
				    $description = "You has been add student successfully. Your account is now secure with the updated password.";
				    $this->Salon_model->set_notifications($customer_id,$heading,$description);
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('payment-history');
		}
	}
	

	

	public function update_student(){
		$this->form_validation->set_rules('student_name','student name','required');
		if($this->form_validation->run() === FALSE){
			$data['student_list'] = $this->Salon_model->get_all_student();
			$data['single'] = $this->Salon_model->get_single_student();
			// echo "<pre>";print_r($data['single']);exit;
			$data['course_name'] = $this->Salon_model->get_course();
			$this->load->view('salon/update_student',$data);
		}else{
			$result = $this->Salon_model->update_student();
			if($result == "0"){
				$customer_id=$this->session->userdata('id');
				    $heading    = "Add Student Successfully";
				    $description = "You has been add student successfully. Your account is now secure with the updated password.";
				    $this->Salon_model->set_notifications($customer_id,$heading,$description);
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('payment-entry');
		}
	}

// public function fees_history() {
// 	$data['fees_history'] = $this->Salon_model->get_fees_history_all_student();
// 	// print_r($data['fees_history']);exit;
// 	$this->load->view('salon/fees-history',$data);
    
// }

// public function payment_history($student_id) {
//     $payment_history = $this->Salon_model->get_payment_history_by_student_id($student_id);
//     $data['payment_entry_list'] = $payment_history;
//     $this->load->view('salon/payment-history', $data);
// }

public function payment_history() {
    $payment_history = $this->Salon_model->get_payment_history_by_student_id();
    $data['payment_entry_list'] = $payment_history;
    $this->load->view('salon/payment-history', $data);
}

public function fees_history($id) {
	$data['fees_history'] = $this->Salon_model->get_fees_history_all_student($id);
	// $data['student_name'] = $this->Salon_model->get_unique_student_name($id);

	$this->load->view('salon/fees-history',$data);
}

public function student_fees_history($student_id){
	// echo "<pre>";print_r($student_id);exit;

	$student_fees_history = $this->Salon_model->get_student_fees_history($student_id);
	$data['student_fees'] = $student_fees_history;
	$data['student_name'] = $this->Salon_model->get_unique_student_name($student_id);
	// echo "<pre>";print_r($data['student_fees']);exit;

   $this->load->view('salon/student-fees-history',$data);
}






// For Add Payment Entry




	public function payment_entry(){
		$this->form_validation->set_rules('student_name','student name','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Salon_model->get_single_payment_entry();
			$data['student_list'] = $this->Salon_model->get_student_name();
			$data['course_name'] = $this->Salon_model->get_course();
			// echo "<pre>";print_r($data['course_name']);exit;
			$this->load->view('salon/payment-entry',$data);
		}else{
			$attachment_file = "";
			if($_FILES['attachment_file']['name'] !=""){
				$temp = explode('.', $_FILES['attachment_file']['name']);
				$ext = end($temp);
				$new_attachment_file = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/attachment_file/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_attachment_file,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('attachment_file')){
					$data = $this->upload->data();				
					$attachment_file = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$attachment_file = $this->input->post('old_attachment_file');
			} 
			$result=$this->Salon_model->payment_entry($attachment_file);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('payment-entry');
		 }			
	}


// For add_staff_attendance
public function salon_attendance_list(){
	$data['attendance'] = $this->Salon_model->get_all_attendance();
   $this->load->view('salon/salon-attendance-list',$data);
}
public function all_enquiries(){
	$data['result'] = $this->Salon_model->get_all_inquiries('','');
   $this->load->view('salon/all_enquiries',$data);
}
public function all_reminders(){
	$data['result'] = $this->Salon_model->get_all_reminders('','');
	// echo '<pre>'; print_r($data['result']); exit;
   $this->load->view('salon/all_reminders',$data);
}
	public function set_staff_attendance(){
		if($this->input->post('submit_attendence') == 'submit attendence'){
			$this->Salon_model->set_staff_attendance();
			$this->session->set_flashdata("success", "Attendance added successfully.");
			redirect('set_staff_attendance');
		}else{
			$data['shift_name'] = $this->Salon_model->get_shift();
			$data['employee'] = $this->Salon_model->get_all_active_staff();
			$data['attendance'] = $this->Salon_model->get_today_present_staff();
			$data['today_attendance'] = $this->Salon_model->get_today_attendance_ajx();
			// echo "<pre>"; print_r($data['today_attendance']); exit;
			$this->load->view("salon/set_staff_attendance",$data);
		}
	}
	public function employee_attendance(){
		$data['employee'] = $this->Salon_model->get_all_salon_employees();
		$this->load->view("salon/employee_attendance",$data);
	}
	public function add_staff_attendance(){
		$data['employee'] = $this->Salon_model->get_all_salon_employees();
		$this->load->view("salon/add_staff_attendance",$data);
	}
	public function add_staff_leave(){
		if($this->input->post('submit_leave') == 'submit_leave'){
			$result = $this->Salon_model->add_staff_leave();
			if($result == '1'){
				$this->session->set_flashdata("success", "Leave added successfully.");
			}else{
				$this->session->set_flashdata("success", "Leave updated successfully.");
			}
			redirect('salon-leaves-list');
		}else{
			$data['employee'] = $this->Salon_model->get_all_active_staff();
			$data['single'] = $this->Salon_model->get_single_leave();
			$this->load->view("salon/add_staff_leave",$data);
		}
	}
	public function salon_leaves_list(){
		$data['leaves'] = $this->Salon_model->get_all_leaves();
	   $this->load->view('salon/salon-leaves-list',$data);
	}
	

	

// For salary slip
public function salon_salary_list(){
	$data['salary_list'] = $this->Salon_model->get_all_salary();
	// echo "<pre>"; print_r($data['salary_list']); exit;
   $this->load->view('salon/salon-salary-list',$data);
}

	public function generate_salary_slip(){
		$this->form_validation->set_rules('staff','Staff','required');
		if ($this->form_validation->run()=== FALSE) {
			$data['employee'] = $this->Salon_model->get_all_active_staff();
			$data['single'] = $this->Salon_model->get_single_emp_salary();
			// echo "<pre>"; print_r($data['single']); exit;
			$this->load->view("salon/generate_salary_slip",$data);
		}else{
			$res = $this->Salon_model->set_salary_slip();
			$this->session->set_flashdata("success", "Salary slip generate Successfully.");
			redirect('salon_print_salary_slip/'.$res);
		}
	}
	public function search_salary_slip(){
		$data['employee'] = $this->Salon_model->get_all_active_staff();
		$this->load->view("salon/search_salary_slip",$data);
	}
	public function student_id_card(){
		$data['student'] = $this->Salon_model->get_single_student1();
		$this->load->view("salon/student_id_card",$data);
	}
	

// For Salon Expensese
public function salon_expense_list(){
	$data['expense_list'] = $this->Salon_model->get_all_salon_expense();
	$this->load->view("salon/salon-expense-list",$data);
}


public function add_salon_expense(){
	$this->form_validation->set_rules('expense_amount','amount','required');
	if($this->form_validation->run()=== FALSE){
		$data['salon'] = $this->Salon_model->get_active_salon();
		$data['expense_name'] = $this->Salon_model->get_all_expense_name();
		$data['single'] = $this->Salon_model->get_single_salon_expense();
		$data['expsense_details'] = $this->Salon_model->get_single_expense_details();
		//$data['expense_list'] = $this->Salon_model->get_all_salon_expense();
		//$data['expense_type'] = $this->Salon_model->get_active_salon_expense_type();
		$this->load->view("salon/add-salon-expense",$data);
	}else{
		$result = $this->Salon_model->add_salon_expense();
		if($result == 0){
			$this->session->set_flashdata("success", "Expense added successfully.");
		}else{
			$this->session->set_flashdata("message", "Expense updated successfully.");
		}
		redirect('salon-expense-list');
	}
}




// add work shedule


	public function add_work_schedule(){
		$this->form_validation->set_rules('schedule_name','Work schedule name','required');
		if($this->form_validation->run()==false){
			$data['single'] = $this->Salon_model->get_single_work_schedule();
			$this->load->view('salon/add_work_schedule',$data);
		}else{
			$result = $this->Salon_model->add_work_schedule();
			if($result == 1){
				$this->session->set_flashdata('success','Work Schedule Added Successfully.');
			}else{
				$this->session->set_flashdata('success','Work Schedule Updated Successfully.');
			}
			redirect('add_work_schedule');
		}
	}
	public function work_schedule_list(){
		$this->load->view('salon/work_schedule_list');
	}
	public function set_upload_options() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/product_image/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	}
	public function set_upload_options_store_images() {
		$config = array();
		$config ['upload_path'] = 'salon_assets/images/salon_images/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	}
	public function product_barcode() {	
		$data['product_category'] = $this->Salon_model->get_all_salon_products();	
		$data['select_product_category'] = $this->Salon_model->get_product_category();
		$data['products'] = $this->Salon_model->get_all_salon_products();	
		$this->load->view('salon/product-barcode',$data); 
	}
	public function add_product_consumption() {	
		$this->form_validation->set_rules('product_name','Product Name','required');
		if($this->form_validation->run() === FALSE){
			$data['product_master_list'] = $this->Salon_model->get_all_product_master();	
			$this->load->view('salon/add_product_consumption',$data); 
		}else{
			$result = $this->Salon_model->add_product_consumption();
			if($result == "0"){
				$this->session->set_flashdata('success','Consumption added successfully');
			}else{
				$this->session->set_flashdata('success','Consumption updated successfully');
			}
			redirect('product-stock-list');
		}
	}
	public function add_working_hours(){
		$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
		$this->load->view('salon/add_employee_list',$data);
	}
	public function booking_list(){
		$data['total_bookings'] = $this->Salon_model->get_salon_bookings();
		// echo '<pre>'; print_r($data['total_bookings']); exit;
		$data['customer'] = $this->Salon_model->get_all_salon_customer();
		$data['bookings'] = $this->Salon_model->get_all_salon_bookings();
		$data['services'] = $this->Salon_model->get_all_salon_services();
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		$this->load->view('salon/booking_list',$data);
	}
	public function product_booking_list(){
		$data['total'] = $this->Salon_model->get_salon_product_bookings();
		$data['customer'] = $this->Salon_model->get_all_salon_customer();
		$data['bookings'] = $this->Salon_model->get_all_salon_product_bookings();
		$data['products'] = $this->Salon_model->get_all_salon_products();
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		$this->load->view('salon/product_booking_list',$data);
	}
	public function customer_list(){
		if ($this->input->post('customer_button') == 'customer_button') {
			$result = $this->Salon_model->add_new_customer();
			if ($result == 0) {
				// $this->session->set_flashdata('success', 'Record added successfully');
				// redirect('add-new-booking');
			}else if($result == 3) {
				$this->session->set_flashdata('success', 'Phone no already registered');
				redirect('add-new-booking-new');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
				redirect('add-new-booking-new');
			}
		}else{
			$this->load->view('salon/customer_list');
		}
	}
	public function add_enquiry_form(){
		$this->load->view('salon/add_enquiry');
	}
	public function add_reminder_form(){
		$data['result'] = $this->Salon_model->get_all_reminders('','');
		$this->load->view('salon/add_reminder',$data);
	}
   

	public function some_function() {
        // Your logic to create or update events
        $event_data = json_encode([
            'booking_id' => 123,
            'service_name' => 'Haircut',
            'service_from' => '2024-05-18T10:00:00',
            'service_to' => '2024-05-18T11:00:00',
            'service_status' => '1',
            'id' => 456
        ]);

        // Send WebSocket message
        send_websocket_message($event_data);
    }

	public function birthday(){
		$this->load->view('salon/birthday');
	}

	public function anniversary(){
		$data['report'] = array();
		if(isset($_GET['daterange'])){
			$data['report'] = $this->Salon_model->get_date_time_anniversary_filter();
		}
		$this->load->view('salon/anniversary',$data);
	}

	

	public function service_repeat(){
		$data['service'] = array();
		if(isset($_GET['daterange'])){
			$data['service'] = $this->Salon_model->get_service_repeat_filter();
		}
		$this->load->view('salon/service_repeat',$data);
	}

	

	public function cancel_appointment(){
		$data['appointment'] = array();
		if(isset($_GET['daterange'])){
			$data['appointment'] = $this->Salon_model->get_cancel_appointment_filter();
		}
		$this->load->view('salon/cancel_appointment',$data);
	}


	

	public function lost_customer(){
		$data['lost_customer'] = array();
		if(isset($_GET['daterange'])){
			$data['lost_customer'] = $this->Salon_model->get_lost_customer_filter();
			// echo "<pre>";print_r($data['lost_customer']);exit;
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
			$data['single'] = $this->Salon_model->get_single_customize_message($_GET['edit']);
		}
		$this->load->view('salon/customize_message',$data);
	}
	public function sales_report(){
		$this->load->view('salon/sales_report');
	}
	public function package_report(){
		$this->load->view('salon/package_report');
	}
	public function membership_report(){
		$this->load->view('salon/membership_report');
	}
	public function giftcard_report(){
		$this->load->view('salon/giftcard_report');
	}
	public function subscription_report(){
		$data['branch_coin_history'] = $this->Admin_model->get_branch_coin_history($this->session->userdata('branch_id'));
		$data['branch_subscription_history'] = $this->Admin_model->get_branch_subscription_history($this->session->userdata('branch_id'));
		$data['app_customers'] = count($this->Salon_model->get_all_salon_customer_list_conditional('1',$this->session->userdata('branch_id')));
		$this->load->view('salon/subscription_report',$data);
	}
	public function whatsapp_report(){
		$profile = $this->Salon_model->get_user_profile();
		if(!empty($profile) && $profile->include_wp == '1'){
			$this->load->view('salon/whatsapp_report');
		}else{
			$this->session->set_flashdata('message', 'You are not allowed to access');
			redirect('salon-dashboard-new');
		}
	}
	public function employee_report(){
		$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
		$this->load->view('salon/employee_report',$data);
	}
	public function customer_report(){
		$this->load->view('salon/customer_report');
	}
	public function petty_cash(){
		$this->form_validation->set_rules('amount','Amount','required');
		if($this->form_validation->run() === FALSE){
			$data['entries'] = $this->Salon_model->get_all_petty_cash_entries();
			$data['single'] = $this->Salon_model->get_single_petty_cash_entry($this->uri->segment(2));	
			$data['employee'] = $this->Salon_model->get_all_salon_employees();		
			$this->load->view('salon/petty_cash',$data);
		}else{
			$result=$this->Salon_model->add_petty_cash_entry();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('petty-cash');
		 }			
	}
	public function set_store_close(){
		$result = $this->Salon_model->set_store_close();
		if($result){
			$this->session->set_flashdata('success','Record added successfully');
		}else{			
			$this->session->set_flashdata('message','Error while setup, Please try again');
		}
		redirect('salon-dashboard-new');
	}
	public function transfer_bookings(){
		if($this->input->post('submit_transfer_button') == 'submit_transfer_button'){
			$result = $this->Salon_model->transfer_bookings();
			if($result){
				$this->session->set_flashdata('success','Bookings transfered successfully');
			}else{			
				$this->session->set_flashdata('message','Error occured, Please try again');
			}
			redirect('salon-dashboard-new');
		}else{
			if(isset($_GET['stylist']) && $_GET['stylist'] != ""){
				$stylist = $_GET['stylist'];
			}else{
				$stylist = '';
			}
			$data['upcoming_appointments'] = $this->Salon_model->get_salon_employee_upcoming_appointments($stylist);
			$data['employee'] = $this->Salon_model->get_salon_all_stylists();
			$this->load->view('salon/transfer_bookings',$data);
		}
	}
	public function mobile_banner(){
		if($this->input->post('banner_submit') != 'banner_submit'){
			$data['banner'] = $this->Salon_model->get_all_banner();
			$data['single'] = $this->Salon_model->get_single_banner();
			$this->load->view('salon/mobile_banner',$data);
		}else{			
			$tips_photo = array();
			if(isset($_FILES['banner']) && $_FILES['banner']['name'] != ""){
			    $files = $_FILES;
			    $cpt = count($_FILES['banner']['name']);
			    for($i=0; $i<$cpt; $i++){
			        $_FILES['userfile']['name'] = $files['banner']['name'][$i];
			        $_FILES['userfile']['type'] = $files['banner']['type'][$i];
			        $_FILES['userfile']['tmp_name'] = $files['banner']['tmp_name'][$i];
			        $_FILES['userfile']['error'] = $files['banner']['error'][$i];
			        $_FILES['userfile']['size'] = $files['banner']['size'][$i];

			        $this->load->library('upload');
			        $this->upload->initialize($this->Master_model->set_upload_banner_img());

			        if (!$this->upload->do_upload()){
			            $error = array('error' => $this->upload->display_errors());
			            echo $this->upload->display_errors();
			        } else {
			            $all_file = $this->upload->data();
			            $tips_photo[] = $all_file['file_name']; 
			        }    
			    }
			}
			$result = $this->Salon_model->add_banner($tips_photo);

			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('salon-mobile-banner');
		}
	} 
	public function employee_loan(){
		$this->form_validation->set_rules('emp','Employee','required'); 
		$this->form_validation->set_rules('now_paid_amount','Settle Amount','required'); 
		if($this->form_validation->run() === FALSE){
			$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employees();
			$data['single'] = $this->Salon_model->get_single_employee_loan($this->uri->segment(2));
			$data['all_loans'] = $this->Salon_model->get_all_employee_loan();
			$this->load->view('salon/employee_loan',$data);
		}else{
			if($this->input->post('submit_settle_button') == 'submit_settle_button'){
				$result=$this->Salon_model->set_employee_loan_payment();
			}else{
				$result=$this->Salon_model->set_employee_loan();
			}
			if($result){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong');
			}
			redirect('employee_loan?emp='.$this->input->post('emp'));
		}
	} 
	public function set_employee_loan_payment(){
		$result=$this->Salon_model->set_employee_loan_payment();
		if($result){
			$this->session->set_flashdata('success','Record added successfully');
		}else{
			$this->session->set_flashdata('message','Something went wrong');
		}
		redirect('employee_loan?emp='.$this->input->post('emp'));
	} 
	public function branch_coin_history(){
		$data['branch_coin_history'] = $this->Admin_model->get_branch_coin_history($this->session->userdata('branch_id'));
		$this->load->view('salon/branch_coin_history',$data);
	}
	public function consent_form(){
		$this->form_validation->set_rules('customer','Customer Name','required');
		if($this->form_validation->run() === FALSE){
			$data['customer'] = $this->Salon_model->get_all_salon_customer();
			$data['consent_forms'] = $this->Salon_model->get_all_salon_consent_forms();
			$data['booking_rules'] = $this->Salon_model->get_booking_rules();
			$this->load->view('salon/consent_form',$data);
		}else{
			$result = $this->Salon_model->set_consent_form();
			if($result){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong. Please try again');
			}
			redirect('consent-form');
		}
	} 
	public function add_catlogue(){
		$this->form_validation->set_rules('gender','Gender','required');
		if($this->form_validation->run() === FALSE){
			$data['facility_list'] = $this->Master_model->get_all_salon_catlogue();
			$data['single'] = $this->Master_model->get_single_catlogue();
			$this->load->view('salon/add-catlogue',$data);
		}else{				
			$tips_photo = array();
			if(isset($_FILES['banner']) && $_FILES['banner']['name'] != ""){
			    $files = $_FILES;
			    $cpt = count($_FILES['banner']['name']);
			    for($i=0; $i<$cpt; $i++){
			        $_FILES['userfile']['name'] = $files['banner']['name'][$i];
			        $_FILES['userfile']['type'] = $files['banner']['type'][$i];
			        $_FILES['userfile']['tmp_name'] = $files['banner']['tmp_name'][$i];
			        $_FILES['userfile']['error'] = $files['banner']['error'][$i];
			        $_FILES['userfile']['size'] = $files['banner']['size'][$i];

			        $this->load->library('upload');
			        $this->upload->initialize($this->Master_model->set_upload_catalogue_img());

			        if (!$this->upload->do_upload()){
			            $error = array('error' => $this->upload->display_errors());
			            // echo $this->upload->display_errors();
			        } else {
			            $all_file = $this->upload->data();
			            $tips_photo[] = $all_file['file_name']; 
			        }    
			    }
			}
			$result = $this->Master_model->add_catalogue($tips_photo);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-catlogue-salon');
		}
	}  
	public function bill_generation(){
		if ($this->input->post('customer_modal_button') == 'customer_modal_button') {
			$result = $this->Salon_model->add_new_customer();
			if ($result == 0) {
				// $this->session->set_flashdata('success', 'Record added successfully');
				// redirect('add-new-booking');
			}else if($result == 3) {
				$this->session->set_flashdata('success', 'Phone no already registered');
				redirect('add-new-booking-new');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
				redirect('add-new-booking-new');
			}
		}else{
			$this->form_validation->set_rules('selected_customer_phone','customer phone','required');
			if($this->form_validation->run() === FALSE){
				$data['setup'] = $this->Master_model->get_backend_setups();	
				$data['single_profile'] = $this->Salon_model->get_single_profile();
				$data['single'] = $this->Salon_model->get_single_customer_name();
				$data['state'] = $this->Salon_model->get_india_state();
				$data['stylists'] = $this->Salon_model->get_all_salon_stylists();
				$this->load->view('salon/bill_generation',$data);
			}else{
				if($this->input->post('bill_for') == '0'){
					$result = $this->Salon_model->asign_membership();
					if($result == "0"){
						$this->session->set_flashdata('success','Record added successfully');
					}else{
						$this->session->set_flashdata('success','Record updated successfully');
					}
					redirect('bill-list');
				}elseif($this->input->post('bill_for') == '1'){
					$result = $this->Salon_model->asign_package();
					if($result == "0"){
						$this->session->set_flashdata('success','Record added successfully');
					}else{
						$this->session->set_flashdata('success','Record updated successfully');
					}
					redirect('bill-list');
				}elseif($this->input->post('bill_for') == '4'){
					$result = $this->Salon_model->asign_giftcard();
					if($result == "0"){
						$this->session->set_flashdata('success','Record added successfully');
					}else{
						$this->session->set_flashdata('success','Record updated successfully');
					}
					redirect('bill-list');
				}elseif($this->input->post('bill_for') == '5'){
					$result = $this->Salon_model->counter_bill_generation();
					if($result){
						$this->session->set_flashdata('success','Bill generated successfully');
					}else{
						$this->session->set_flashdata('success','Record updated successfully');
					}
					redirect('booking-list');
				}elseif($this->input->post('bill_for') == '6'){
					$result = $this->Salon_model->counter_product_bill_generation();
					if($result){
						$this->session->set_flashdata('success','Bill generated successfully');
					}else{
						$this->session->set_flashdata('success','Record updated successfully');
					}
					redirect('product-booking-list');
				}elseif($this->input->post('bill_for') == '2'){
					redirect('bill-setup/' . base64_encode($this->input->post('booking_id')));
				}elseif($this->input->post('bill_for') == '3'){
					redirect('product-booking-list?booking_id=' . $this->input->post('booking_id'));
				}
			}
		}
	}
	public function bill_list(){
		$data['asign_list'] = $this->Salon_model->get_all_assigned_payments();
		// echo "<pre>";print_r($data['asign_list']);exit;
	   $this->load->view('salon/bill_list',$data);
	} 
}
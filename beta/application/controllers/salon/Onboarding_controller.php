<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Onboarding_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->is_login(); 

		if($this->uri->segment(1) != "salon-dashboard-new"){
			$this->is_allowed();   
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
			redirect('complete-profile');
		}
	} 
	// store profile
	public function store_profile(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '0'){
			$this->form_validation->set_rules('salon_number','Phone number','required');
			if($this->form_validation->run() === FALSE){
				$data['setup'] = $this->Master_model->get_backend_setups();			
				$data['single_profile'] = $this->Salon_model->get_single_profile();
				$data['single_logo'] = $this->Salon_model->get_salon_detail_for_profile();
				$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
				$data['shift_list'] = $this->Salon_model->get_all_shift();
				$data['work_list'] = $this->Salon_model->get_all_work_shedule_profile();
				$data['notification'] = $this->Salon_model->get_all_notification_list(); 
				$this->load->view('salon/store-profile',$data);
			}else{
				$store_logo = "";
				if(isset($_FILES['store_logo']['name']) && $_FILES['store_logo']['name'] != "") {
						$temp = explode('.', $_FILES['store_logo']['name']);
						$ext = end($temp);
						$new_store_logo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
						$config = array(
							'upload_path' 	=> "admin_assets/images/store_logo/",
							'allowed_types' => "pdf|jpg|jpeg|png",
							'file_name'		=> $new_store_logo,
						);			
						$this->upload->initialize($config);
						if($this->upload->do_upload('store_logo')){
							$data = $this->upload->data();				
							$store_logo = $data['file_name'];	
						}else{ 
							$error = array('error' => $this->upload->display_errors());	
							$this->upload->display_errors();
						}
					}else{
						$store_logo = $this->input->post('old_store_logo');
					} 
					
					$shopact = "";
					if($_FILES['shopact']['name'] !=""){
						$temp = explode('.', $_FILES['shopact']['name']);
						$ext = end($temp);
						$new_shopact = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
						$config = array(
							'upload_path' 	=> "admin_assets/images/shopact-image/",
							'allowed_types' => "pdf|jpg|jpeg|png",
							'file_name'		=> $new_shopact,
						);			
						$this->upload->initialize($config);
						if($this->upload->do_upload('shopact')){
							$data = $this->upload->data();				
							$shopact = $data['file_name'];	
						}else{ 
							$error = array('error' => $this->upload->display_errors());	
							$this->upload->display_errors();
						}
					}else{
						$shopact = $this->input->post('old_shopact');
					} 
					$result=$this->Salon_model->store_profile($store_logo,$shopact);
				if($result == 0){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}

				if($onboarding_status < '18'){
					redirect('working-hours');
					// redirect('store-profile');
				}else{
					redirect('store-profile');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier onboarding steps first');
			redirect('complete-profile');
		}
	}
	// working Hours
	
	public function working_hours(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '1'){
			$data['single_rules'] = $this->Salon_model->get_all_booking_rules(); 
			$data['shift_list'] = $this->Salon_model->get_all_shift();
			$data['single_shift'] = $this->Salon_model->get_single_shift();
			$data['all_shifts'] = $this->Salon_model->get_all_shifts();
			$data['all_rotational_shifts'] = $this->Salon_model->get_all_rotational_shifts();
			
			if ($this->input->post('work-shedule-btn') == 'work-shedule-btn') {
				$result = $this->Salon_model->add_work_schedule();
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Record added successfully');
					redirect('working-hours/3');
				} else {
					$this->session->set_flashdata('success', 'Record updated successfully');
					redirect('working-hours/3');
				}
			}
			elseif ($this->input->post('shift_submit_button') == 'shift_submit_button') {
				$result = $this->Salon_model->add_shift();
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Record added successfully');
				} else {
					$this->session->set_flashdata('success', 'Record updated successfully');
				}
				if($this->input->post('shift_type') == '0'){
					if($onboarding_status < '18'){
						// redirect('add-product');
						redirect('working-hours?active=regular_shift_list');
					}else{
						redirect('working-hours?active=regular_shift_list');
					}
				}elseif($this->input->post('shift_type') == '1'){
					if($onboarding_status < '18'){
						// redirect('add-product');
						redirect('working-hours?active=rotational_shift_list');
					}else{
						redirect('working-hours?active=rotational_shift_list');
					}
				}else{
					if($onboarding_status < '18'){
						// redirect('add-product');
						redirect('working-hours/2');
					}else{
						redirect('working-hours/2');
					}
				}
			}
			elseif($this->input->post('salon-time-btn') == 'salon-time-btn') {
				$result = $this->Salon_model->add_salon_time();
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Record added successfully');
				} else {
					$this->session->set_flashdata('success', 'Record updated successfully');
				}

				if($onboarding_status < '18'){
					redirect('salon-bank-details');
					// redirect('working-hours/1');
				}else{
					redirect('working-hours/1');
				}
			}
			else {
				$this->load->view('salon/working-hours', $data);
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}

	// Bank Profile
	
	public function salon_bank_details(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '2'){
			$this->form_validation->set_rules('account_holder_name','account holder name','required');
			if($this->form_validation->run() === FALSE){
				$data['single_profile'] = $this->Salon_model->get_salon_detail_for_profile();
				$data['single_bank_profile'] = $this->Salon_model->get_single_branch_profile();
				$this->load->view('salon/salon-bank-details',$data);
		
			}else{
				$result = $this->Salon_model->salon_bank_details();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}

				if($onboarding_status < '18'){
					// redirect('salon-location');
					redirect('salon-bank-details');
				}else{
					redirect('salon-bank-details');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	// store location
	
	public function salon_location(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '3'){
			$this->form_validation->set_rules('location','salon location','required');
			$data['single_logo'] = $this->Salon_model->get_salon_detail_for_profile();
			if($this->form_validation->run() === FALSE){
				$this->load->view('salon/salon-location',$data);
		
			}else{
				$result = $this->Salon_model->salon_location();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}

				if($onboarding_status < '18'){
					// redirect('add-salon-facility');
					redirect('salon-location');
				}else{
					redirect('salon-location');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function add_facility(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '4'){
			$this->form_validation->set_rules('facility_name','vehicle type','required');
			if($this->form_validation->run() === FALSE){
				$data['facility_list'] = $this->Salon_model->get_all_facility();
				$data['single'] = $this->Salon_model->get_single_facility();
				$this->load->view('salon/add-facility',$data);
			}else{
				$icon = "";
				if($_FILES['icon']['name'] !=""){
					$temp = explode('.', $_FILES['icon']['name']);
					$ext = end($temp);
					$new_tips_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
					$config = array(
						'upload_path' 	=> "admin_assets/images/facility_icon/",
						'allowed_types' => "jpg|jpeg|png",
						'file_name'		=> $new_tips_photo,
					);			
					$this->upload->initialize($config);
					if($this->upload->do_upload('icon')){
						$data = $this->upload->data();				
						$icon = $data['file_name'];	
					}else{ 
						$error = array('error' => $this->upload->display_errors());	
						// $this->upload->display_errors();
					}
				}else{
					$icon = $this->input->post('old_icon');
				}
				$result = $this->Salon_model->add_facility($icon);
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}

				if($onboarding_status < '18'){
					// redirect('working-hours?active=add_shifts_page');
					redirect('add-salon-facility');
				}else{
					redirect('add-salon-facility');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}  

	public function add_salon_services(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '7'){
			if($this->session->userdata('store_gender') != ""){
				$this->form_validation->set_rules('service_duration', 'service duration', 'required');
				if ($this->form_validation->run() === FALSE) {
					$data['category_list'] = $this->Admin_model->get_all_services_name();
					$data['product_list'] = $this->Salon_model->get_all_product();
					$data['sub_category_list'] = $this->Salon_model->get_all_sub_category_list();
					$data['single'] = $this->Salon_model->get_single_service_for_edit();
					if(isset($_GET['use']) && isset($_GET['use_id'])){		
						$data['ready_single'] = $this->Salon_model->get_single_ready_service($_GET['use_id']);	
					}		
					$data['product_master_list'] = $this->Salon_model->get_all_product_master();
					$data['emp_name_list'] = $this->Salon_model->get_emp_name_for_service_name();
					$data['services'] = $this->Salon_model->get_all_services();
					$data['disaprove_services'] = $this->Salon_model->get_all_disaprove_services();
					$data['admin_services'] = $this->Admin_model->get_all_service_list();
					$this->load->view('salon/add_salon_services', $data); 
				}else{
					if($this->input->post('is_ready_service') == '1'){
						$result=$this->Salon_model->set_salon_services();
						$result = explode('@@',$result);
						if ($result[0] == "0") {
							$this->session->set_flashdata('success', 'Record added successfully');
						} else {
							$this->session->set_flashdata('success', 'Record updated successfully');
						} 
						$this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));
						if($onboarding_status < '18'){
							// redirect('add-membership');
							redirect('salon-services-list/'.$result[1]);
						}else{
							redirect('salon-services-list/'.$result[1]);
						}
					}else{
						// echo '<pre>'; print_r($_POST); exit;
						$category_image = "";
						if($_FILES['category_image']['name'] !=""){
							$temp = explode('.', $_FILES['category_image']['name']);
							$ext = end($temp);
							$new_category_image = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
							$config = array(
								'upload_path' 	=> "admin_assets/images/service_image/",
								'allowed_types' => "jpg|jpeg|png",
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
						$result=$this->Salon_model->add_salon_services($category_image);
						
						if ($result == "0") {
							$this->session->set_flashdata('success', 'Record added successfully');
						} else {
							$this->session->set_flashdata('success', 'Record updated successfully');
						} 
						$this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));   
						if($onboarding_status < '18'){
							// redirect('add-membership');
							redirect('add-salon-services');
						}else{
							redirect('add-salon-services');
						}
					}
				}
			}else{
				$this->session->set_flashdata('message', 'Salon category not set. Please add it first.');
				redirect('store-profile');
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}

	public function ready_sub_category($category_id) {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '7'){
			$services_data = $this->Salon_model->get_ready_sub_category_list_by_category($category_id);
			$data['salon_services_list'] = $services_data;
			$services_history = $this->Salon_model->get_ready_services_list_by_category($category_id);
			$data['services_list'] = $services_history;
			if (!empty($services_data)) {
				$category = $services_data[0]->category;
				$data['category_name'] = $category;
			}
			// echo "<pre>";print_r($data['salon_services_list']);exit;
			$this->load->view('salon/ready-sub-category', $data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	
	public function ready_services($category_id){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '7'){
			$services_history = $this->Salon_model->get_ready_services_list_by_category($category_id);
			$data['salon_services_list'] = $services_history;
			$data['product_master_list'] = $this->Salon_model->get_all_product_master();
			$data['added_services'] = $this->Salon_model->get_my_added_service();
			if ($this->input->post('set_price') == 'set_price') {
				$result=$this->Salon_model->set_salon_services();
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Record added successfully');
					redirect('add-salon-services');
				} else {
					$this->session->set_flashdata('success', 'Record updated successfully');
					redirect('add-salon-services');
				}
			}
			else {
				$this->load->view('salon/ready-services', $data);
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 

	public function add_salon_services_list($category_id) {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '7'){
			$services_history = $this->Salon_model->get_salon_services_list_by_category($category_id);
			$data['salon_services_list'] = $services_history; 
			$data['salon_services'] = $this->Salon_model->get_salon_services_list_by($category_id);
			$this->load->view('salon/salon_services_list', $data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function salon_services($category_id) {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '7'){
			$services_history = $this->Salon_model->get_salon_services_list_by_category($category_id);
			$data['salon_services_list'] = $services_history; 
			$data['salon_services'] = $this->Salon_model->get_salon_services_list_by($category_id);
			$this->load->view('salon/services_list', $data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function add_product(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '6'){
			$this->form_validation->set_rules('product_name','Product Name','required');
			if($this->form_validation->run() === FALSE){
				$data['product_master_list'] = $this->Salon_model->get_all_product_master();
				$data['product_category_list'] = $this->Salon_model->get_product_category_list();  
				$data['product_unit_list'] = $this->Salon_model->get_all_products_unit();
				$data['pending_products'] = $this->Salon_model->get_all_pending_products(); 
				if(isset($_GET['id'])){
					$data['single_setup'] = $this->Salon_model->get_single_product_setup_details();
				}
				if(isset($_GET['edit'])){
					$data['single_product_details'] = $this->Salon_model->get_single_product_details(); 
				}
				$this->load->view('salon/add_product',$data);
			}else{
				$product_photo = array();
				if(isset($_FILES['product_photo']) && $_FILES['product_photo']['name'] != ""){
					$files = $_FILES;
					$cpt = count($_FILES['product_photo']['name']);
					for($i=0; $i<$cpt; $i++){
						$_FILES['userfile']['name']= $files['product_photo']['name'][$i];
						$_FILES['userfile']['type']= $files['product_photo']['type'][$i];
						$_FILES['userfile']['tmp_name']= $files['product_photo']['tmp_name'][$i];
						$_FILES['userfile']['error']= $files['product_photo']['error'][$i];
						$_FILES['userfile']['size']= $files['product_photo']['size'][$i];

						$this->load->library('upload');
						$this->upload->initialize($this->set_upload_options());

						if(!$this->upload->do_upload()){
							$error = array('error' => $this->upload->display_errors());
						}else{
							$all_file = $this->upload->data();
							$product_photo[] = $all_file['file_name'];	
						}	
					}
				}
				$product_photo=implode(',',$product_photo);
				$result=$this->Salon_model->set_product($product_photo);
				$status = explode('@@@',$result)[0];
				$category = explode('@@@',$result)[1];
				if($status == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-salon-services');
					if($this->input->post('is_pending_product') == '1'){
						// redirect('add-product?pending_tab');
						redirect('product-list/'.$category);
					}else{
						redirect('product-list/'.$category);
					}
				}else{
					if($this->input->post('is_pending_product') == '1'){
						// redirect('add-product?pending_tab');
						redirect('product-list/'.$category);
					}else{
						redirect('product-list/'.$category);
					}
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function product_list($category_id){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '6'){
			$product_master_list = $this->Salon_model->get_all_product_by_category($category_id);
			$data['product_master_list'] = $product_master_list;
			$this->load->view('salon/product_list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function set_upload_options() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/product_image/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	}
	
	public function use_ready_product_cat(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '6'){
			$data['product_category'] = $this->Salon_model->get_product_single_category();
			$data['product_sub_category'] = $this->Salon_model->get_product_single_sub_category($this->uri->segment(3));
			$data['product_list'] = $this->Salon_model->get_product_list_by_category();
			$data['product_master_list'] = $this->Salon_model->get_all_product_master();
			$data['added_product'] = $this->Salon_model->get_my_added_product();
			$this->load->view('salon/use_ready_product_cat',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function use_ready_product_sub_cat(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '6'){
			$data['product_category'] = $this->Salon_model->get_product_single_category();
			$data['sub_categories'] = $this->Salon_model->get_all_sub_category($this->uri->segment(2));
			$data['product_master_list'] = $this->Salon_model->get_all_product_master();
			$this->load->view('salon/use_ready_product_sub_cat',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}

	// For Add membership
   

	public function membership_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '8'){
			$data['membership_list'] = $this->Salon_model->get_all_memebership();
			$this->load->view('salon/membership-list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 


	public function add_membership(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '8'){
			$this->form_validation->set_rules('membership_name','membership name','required');
			if($this->form_validation->run() === FALSE){
				$data['membership_list'] = $this->Salon_model->get_all_memebership();
				$data['ready_membership'] = $this->Salon_model->get_all_ready_memebership();
				if(isset($_GET['value'])){
					$data['setup_membership'] = $this->Salon_model->get_ready_membership_single_setup();
				}
				if(isset($_GET['edit'])){
					$data['single_membership'] = $this->Salon_model->get_single_membership();
				} 
				$this->load->view('salon/add_membership',$data);
			}else{ 
				$result = $this->Salon_model->add_membership();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-package');
					redirect('add-membership');
				}else{
					redirect('add-membership');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	
	public function package_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '9'){
			$data['package_list'] = $this->Salon_model->get_all_package();
		$this->load->view('salon/package-list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function add_package(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '9'){
			$this->form_validation->set_rules('package_name','Product Name','required');
			if($this->form_validation->run() === FALSE){
				$data['ready_packages'] = $this->Salon_model->get_ready_packages();
				$data['package_list'] = $this->Salon_model->get_all_package();
				if(isset($_GET['value'])){
					$data['setup_package'] = $this->Salon_model->get_single_ready_package();
				}
				if(isset($_GET['edit'])){
					$data['signle_package'] = $this->Salon_model->get_single_package();
				} 
				$data['service_title'] = $this->Salon_model->get_services_for_offers();
				$data['product_master_list'] = $this->Salon_model->get_all_product_master(); 
				$this->load->view('salon/add_package',$data);
			}else{
				$document = "";
				if($_FILES['package_image']['name'] !=""){
					$temp = explode('.', $_FILES['package_image']['name']);
					$ext = end($temp);
					$new_document = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
					$config = array(
						'upload_path' 	=> "admin_assets/images/package_image/",
						'allowed_types' => "jpg|jpeg|png",
						'file_name'	=> $new_document,
					);			
					$this->upload->initialize($config);
					if($this->upload->do_upload('package_image')){
						$data = $this->upload->data();				
						$document = $data['file_name'];	
					}else{ 
						$error = array('error' => $this->upload->display_errors());	
						$this->upload->display_errors();
					}
				}else{
					$document = $this->input->post('old_package_image');
				}
				$result = $this->Salon_model->set_package($document);
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-coupon-code');
					redirect('add-package');
				}else{
					redirect('add-package');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function offers_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '11'){
			$data['offers_list'] = $this->Salon_model->get_all_offers();
			$this->load->view('salon/offers-list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function add_offers(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '11'){
			$this->form_validation->set_rules('offers_name','Product Name','required');
			if($this->form_validation->run() === FALSE){
				$data['ready_offer'] = $this->Salon_model->get_ready_offer();
				$data['offers_list'] = $this->Salon_model->get_all_offers();
				if(isset($_GET['value'])){
					$data['setup_offer'] = $this->Salon_model->get_single_ready_offer();
				}
				if(isset($_GET['edit'])){
					$data['single_offer'] = $this->Salon_model->get_single_offer();
				}
				$data['category_name_list'] = $this->Salon_model->get_all_service_sub_category();
				$data['service_title'] = $this->Salon_model->get_services_for_offers();
				$data['single_profile'] = $this->Salon_model->get_single_profile();
				$this->load->view('salon/add_offers',$data);
			}else{
				$result = $this->Salon_model->set_offers();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-gift-card');
					redirect('add-offers');
				}else{
					redirect('add-offers');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function add_coupon_code(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '10'){
			$this->form_validation->set_rules('coupon_name','coupon Name','required');
			if($this->form_validation->run() === FALSE){
				$data['coupon_code_list'] = $this->Salon_model->get_all_coupon_code();
				$data['ready_coupon'] = $this->Salon_model->get_ready_coupon_code();
				// echo '<pre>'; print_r($data['ready_coupon']); exit;
				if(isset($_GET['value'])){
					$data['setup_coupon'] = $this->Salon_model->get_ready_coupon_single_setup();
				}
				if(isset($_GET['edit'])){
					$data['single_coupon'] = $this->Salon_model->get_single_coupon_code();
				}
				$this->load->view('salon/add_coupon_code',$data);
			}else{ 
				$result = $this->Salon_model->set_coupon_code();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-offers');
					redirect('add-coupon-code');
				}else{
					redirect('add-coupon-code');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function gift_card_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '12'){
			$data['gift_card_list'] = $this->Salon_model->get_all_gift_list();
			$this->load->view('salon/gift-card-list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	public function add_gift_card(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '12'){
			$this->form_validation->set_rules('gift_name','gift Name','required');
			if($this->form_validation->run() === FALSE){
				$data['ready_gift_card'] = $this->Salon_model->get_ready_gift_card();
				$data['gift_card_list'] = $this->Salon_model->get_all_gift_list();
				if(isset($_GET['value'])){
					$data['setup_gift'] = $this->Salon_model->get_single_ready_gift_card(); 
				}
				if(isset($_GET['edit'])){
					$data['signle_gift'] = $this->Salon_model->get_single_gift_card();
				}
				$data['service_title'] = $this->Salon_model->get_services_for_offers(); 
				$this->load->view('salon/add_gift_card',$data);
			}else{
				$result = $this->Salon_model->set_gift_card();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add-reward-point');
					redirect('add-gift-card');
				}else{
					redirect('add-gift-card');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	} 
	// For Add add reward point
	public function add_reward_point(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '13'){
			$this->form_validation->set_rules('gender','gender','required');
			if($this->form_validation->run() === FALSE){
				$data['ready_reward'] = $this->Salon_model->get_ready_reward_point();
				if(isset($_GET['value'])){
					$data['single_ready'] = $this->Salon_model->get_single_ready_reward_point();
				}
				if(isset($_GET['edit'])){
					$data['single_reward'] = $this->Salon_model->get_single_reward_point();
				}
				$data['reward_point_list'] = $this->Salon_model->get_all_reward_point();
				$this->load->view('salon/add_reward_point',$data);
			}else{ 
				$result = $this->Salon_model->set_reward_point();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add_automated_marketing?type=all');
					redirect('add-reward-point');
				}else{
					redirect('add-reward-point');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}  
	public function employee_incentive_master(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '15'){
			$this->form_validation->set_rules('level','Select level','required');
			if($this->form_validation->run() === FALSE){
				$data['single']=$this->Salon_model->get_employee_incetive();
				$data['incetive_list']=$this->Salon_model->get_all_added_employee_incetive();
				$this->load->view('salon/employee_incentive_master',$data);
			}else{
				$result = $this->Salon_model->add_employee_incentive_master();
				if($result == '0'){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				if($onboarding_status < '18'){
					// redirect('add_employee?redirect=complete-profile');
					redirect('employee_incentive_master');
				}else{
					redirect('employee_incentive_master');
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function add_employee(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '16'){
			$this->form_validation->set_rules('name','Enter Name','required');
			if($this->form_validation->run() === FALSE){
				$data['total_emp'] = count($this->Salon_model->get_all_salon_employee());
				$data['single'] = $this->Salon_model->get_single_salon_employee();
				$data['designation'] = $this->Salon_model->get_salon_designations();
				$data['service_name'] = $this->Salon_model->get_salon_services_list_for_emp();
				$data['upcoming_appointments'] = $this->Salon_model->get_salon_employee_upcoming_appointments($this->uri->segment(2));
				$this->load->view('salon/add_employee',$data);
			}else{
				$aadhar_front = "";
				if($_FILES['identy_proof']['name'] !=""){
					$temp = explode('.', $_FILES['identy_proof']['name']);
					$ext = end($temp);
					$new_aadhar_front = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
					$config = array(
						'upload_path' 	=> "admin_assets/images/employee_aadhar/",
						'allowed_types' => "pdf|jpg|jpeg|png",
						'file_name'		=> $new_aadhar_front,
					);			
					$this->upload->initialize($config);
					if($this->upload->do_upload('identy_proof')){
						$data = $this->upload->data();				
						$aadhar_front = $data['file_name'];	
					}else{ 
						$error = array('error' => $this->upload->display_errors());	
						$this->upload->display_errors();
					}
				}else{
					$aadhar_front = $this->input->post('old_identy_proof');
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
				$this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));
				
				
				if(isset($_GET['redirect']) && $_GET['redirect'] != ""){
					redirect($_GET['redirect'] . '?loader=true');
					// if($onboarding_status < '18'){
					// 	redirect('add-course');
					// }else{
					// 	redirect($_GET['redirect'] . '?loader=true');
					// }
				}else{
					if($onboarding_status < '18'){
						// redirect('add-course');
						redirect('add_employee_list');
					}else{
						redirect('add_employee_list');
					}
				}
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function add_employee_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '16'){
			$data['salon_employee_list'] = $this->Salon_model->get_all_salon_employee();
			$this->load->view('salon/add_employee_list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}

	// For Add courses
   

   public function course_list(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '17'){
			$data['course_list'] = $this->Salon_model->get_all_course();
			$this->load->view('salon/course-list',$data);
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}


	public function add_course(){
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '17'){
			$this->form_validation->set_rules('course_name','course Name','required');
			if($this->form_validation->run() === FALSE){
				$data['course_list'] = $this->Salon_model->get_all_course();
				$data['single'] = $this->Salon_model->get_single_course();
				$data['service_name'] = $this->Salon_model->get_services_for_offers();
				$this->load->view('salon/add-course',$data);
			}else{ 
				$result = $this->Salon_model->add_course();
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				redirect('course-list');
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function add_automated_marketing() {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '14'){
			if ($this->input->post('new_client_submit') == 'new_client_submit') {	
				$result = $this->Salon_model->set_automated_marketing('0');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}				
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=new');	
				}else{
					redirect('add_automated_marketing?type=new');	
				}	
			} elseif ($this->input->post('regular_submit') == 'regular_submit') {
				$result = $this->Salon_model->set_automated_marketing('1');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}							
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=regular');
				}else{
					redirect('add_automated_marketing?type=regular');	
				}			
			} elseif ($this->input->post('lost_client_submit') == 'lost_client_submit') {
				$result = $this->Salon_model->set_automated_marketing('2');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}							
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=lost');	
				}else{
					// redirect('add_automated_marketing?type=lost');	
				}	
			} elseif ($this->input->post('birthday_submit') == 'birthday_submit') {
				$result = $this->Salon_model->set_automated_marketing('3');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}							
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=birthday');	
				}else{
					redirect('add_automated_marketing?type=birthday');	
				}				
			} elseif ($this->input->post('anniversary_submit') == 'anniversary_submit') {
				$result = $this->Salon_model->set_automated_marketing('4');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}							
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=anniversary');
				}else{
					redirect('add_automated_marketing?type=anniversary');	
				}				
			} elseif ($this->input->post('product_marketing_submit') == 'product_marketing_submit') {
				$result = $this->Salon_model->set_automated_marketing('5');				
				if ($result == "0") {
					$this->session->set_flashdata('success', 'Updated successfully');
				} else {
					$this->session->set_flashdata('success', 'Added successfully');
				}							
				if($onboarding_status < '18'){
					// redirect('employee_incentive_master');
					redirect('add_automated_marketing?type=product_marketing');	
				}else{
					redirect('add_automated_marketing?type=product_marketing');	
				}				
			} else {	
				$data['single_new'] = $this->Salon_model->get_single_for_new();
				$data['single_regular'] = $this->Salon_model->get_single_for_regular();
				$data['single_lost'] = $this->Salon_model->get_single_for_lost();
				$data['single_birthday'] = $this->Salon_model->get_single_for_birthday();				
				$data['single_anniversary'] = $this->Salon_model->get_single_for_anniversary();				
				$data['single_product_marketing'] = $this->Salon_model->get_single_for_product_marketing();		
				$data['all_services'] = $this->Salon_model->all_servics($this->session->userdata('salon_id'), $this->session->userdata('branch_id'));	
				$data['all_products'] = $this->Salon_model->all_products($this->session->userdata('salon_id'), $this->session->userdata('branch_id'));	
				$this->load->view('salon/add_automated_marketing', $data);			
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	public function inactivate_marketing_discount() {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '14'){
			$result = $this->Salon_model->set_marketing_discount($this->uri->segment(2),'0');				
			if ($result == "0") {
				$this->session->set_flashdata('message', 'Something went wrong, Please try again');
			} else {
				$this->session->set_flashdata('success', 'Marketing discount inactivated successfully');
			}										
			if($onboarding_status < '18'){
				// redirect('employee_incentive_master');
				if($this->uri->segment(2) == '0'){
					redirect('add_automated_marketing?type=new');
				}elseif($this->uri->segment(2) == '1'){
					redirect('add_automated_marketing?type=regular');
				}elseif($this->uri->segment(2) == '2'){
					redirect('add_automated_marketing?type=lost');
				}elseif($this->uri->segment(2) == '3'){
					redirect('add_automated_marketing?type=birthday');
				}elseif($this->uri->segment(2) == '4'){
					redirect('add_automated_marketing?type=anniversary');
				}elseif($this->uri->segment(2) == '5'){
					redirect('add_automated_marketing?type=product_marketing');
				}else{
					redirect('add_automated_marketing?type=all');
				}	
			}else{
				if($this->uri->segment(2) == '0'){
					redirect('add_automated_marketing?type=new');
				}elseif($this->uri->segment(2) == '1'){
					redirect('add_automated_marketing?type=regular');
				}elseif($this->uri->segment(2) == '2'){
					redirect('add_automated_marketing?type=lost');
				}elseif($this->uri->segment(2) == '3'){
					redirect('add_automated_marketing?type=birthday');
				}elseif($this->uri->segment(2) == '4'){
					redirect('add_automated_marketing?type=anniversary');
				}elseif($this->uri->segment(2) == '5'){
					redirect('add_automated_marketing?type=product_marketing');
				}else{
					redirect('add_automated_marketing?type=all');
				}	
			}
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
	
	public function activate_marketing_discount() {
		$store_set_profile = $this->Salon_model->get_user_profile();
		$onboarding_status = !empty($store_set_profile) ? $store_set_profile->onboarding_status : '';
		if($onboarding_status >= '14'){
			$result = $this->Salon_model->set_marketing_discount($this->uri->segment(2),'1');				
			if ($result == "0") {
				$this->session->set_flashdata('message', 'Something went wrong, Please try again');
			} else {
				$this->session->set_flashdata('success', 'Marketing discount activated successfully');
			}										
			if($onboarding_status < '18'){
				// redirect('employee_incentive_master');
				if($this->uri->segment(2) == '0'){
					redirect('add_automated_marketing?type=new');
				}elseif($this->uri->segment(2) == '1'){
					redirect('add_automated_marketing?type=regular');
				}elseif($this->uri->segment(2) == '2'){
					redirect('add_automated_marketing?type=lost');
				}elseif($this->uri->segment(2) == '3'){
					redirect('add_automated_marketing?type=birthday');
				}elseif($this->uri->segment(2) == '4'){
					redirect('add_automated_marketing?type=anniversary');
				}elseif($this->uri->segment(2) == '5'){
					redirect('add_automated_marketing?type=product_marketing');
				}else{
					redirect('add_automated_marketing?type=all');
				}	
			}else{
				if($this->uri->segment(2) == '0'){
					redirect('add_automated_marketing?type=new');
				}elseif($this->uri->segment(2) == '1'){
					redirect('add_automated_marketing?type=regular');
				}elseif($this->uri->segment(2) == '2'){
					redirect('add_automated_marketing?type=lost');
				}elseif($this->uri->segment(2) == '3'){
					redirect('add_automated_marketing?type=birthday');
				}elseif($this->uri->segment(2) == '4'){
					redirect('add_automated_marketing?type=anniversary');
				}elseif($this->uri->segment(2) == '5'){
					redirect('add_automated_marketing?type=product_marketing');
				}else{
					redirect('add_automated_marketing?type=all');
				}	
			}	
		}else{
			$this->session->set_flashdata('message','Complete the earlier steps first');
			redirect('complete-profile');
		}
	}
}
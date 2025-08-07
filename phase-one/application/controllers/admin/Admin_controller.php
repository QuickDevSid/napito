<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->is_login();   
	}
	public function is_login(){
		if($this->session->userdata('admin_id') == ""){
			$this->session->set_flashdata('message','Please login to continue');
			redirect('login');   
		}
	}	 
	public function do_logout(){
		$this->session->sess_destroy();
		redirect('login');
	}     
	public function admin_dashboard(){
		$this->load->view('admin/admin-dashboard');
	} 
	public function pending_salon_service(){
		$this->form_validation->set_rules('reject_reason','reject reason','required');
		if($this->form_validation->run() === FALSE){
			$data['disaprove_services'] = $this->Admin_model->get_all_disaprove_services();
			$this->load->view('admin/pending-salon-service',$data);
		}else{
			$result = $this->Admin_model->pending_salon_service();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('pending-salon-service');
		}
		if($this->input->post('sent_btn') == "sent_btn"){	
			$this->Admin_model->set_for_approve_service(); 
			$this->session->set_flashdata('success','Pending services approved successfully');
			redirect('pending-salon-service');
		} 
	} 
	public function add_booking_status(){
		$this->form_validation->set_rules('status_name','status_name','required');
		if($this->form_validation->run() === FALSE){
			$data['color_list'] = $this->Admin_model->get_all_status_color();
			$data['single'] = $this->Admin_model->get_single_status_color();
			$this->load->view('admin/add-booking-status',$data);
		}else{
			$result = $this->Admin_model->add_booking_status();
			if($result == "0"){
				$this->session->set_flashdata('success','record inserted Completed');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-booking-status');
		} 
	}  
	public function add_expense_category(){
		$this->form_validation->set_rules('expenses_name','expenses type','required');
		if($this->form_validation->run() === FALSE){
			$data['expense_category_list'] = $this->Admin_model->get_all_expense_category();
			$data['single'] = $this->Admin_model->get_single_expense_category();
			$this->load->view('admin/add-expense-category',$data);
		}else{ 
			$result = $this->Admin_model->add_expense_category();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-expense-category');
		}
	} 
	public function category_type(){
		$this->form_validation->set_rules('category_type','vehicle type','required');
		if($this->form_validation->run() === FALSE){
			$data['category_type_list'] = $this->Admin_model->get_all_category_type();
			$data['single'] = $this->Admin_model->get_single_category_type();
			$this->load->view('admin/category-type',$data);
		}else{
			$result = $this->Admin_model->set_category_type();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('category-type');
		}
	}  
	public function admin_inactive(){  
		$success = $this->Admin_model->inactive();
		if($success){
			$this->session->set_flashdata('success', 'Record inactivated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to inactivate the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	} 
	public function admin_active(){
		$success = $this->Admin_model->active();
		if($success){
			$this->session->set_flashdata('success', 'Record activated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to activate the record');
		}	 
		redirect($_SERVER['HTTP_REFERER']);
	}	
	public function approve(){
		$success = $this->Admin_model->approve();
		if($success){
			$this->session->set_flashdata('success', 'Service approved successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to activate the record');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	} 
	public function admin_delete(){
		$success = $this->Admin_model->delete();
		if($success){
			$this->session->set_flashdata('success', 'Record deleted successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to delete the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}   
	public function invalid_lead(){
		$success = $this->Admin_model->invalid_lead();
		if($success){
			$this->session->set_flashdata('success', 'Record updated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to updated the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}  
	public function valid_lead(){
		$success = $this->Admin_model->valid_lead();
		if($success){
			$this->session->set_flashdata('success', 'Record updated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to updated the record');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}  
	public function salon_list(){
		$data['add_salon_record'] = $this->Admin_model->get_all_salon();
		$data['setup'] = $this->Master_model->get_backend_setups();			
		$this->load->view('admin/salon_list',$data);
	} 
	public function add_salon(){
		$this->form_validation->set_rules('salon_name','salon_name','required'); 
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Admin_model->get_single_salon();
			$this->load->view('admin/add_salon',$data);
		}else{
			$aadhar_front = "";
			if($_FILES['aadhar_front']['name'] !=""){
				$temp = explode('.', $_FILES['aadhar_front']['name']);
				$ext = end($temp);
				$new_aadhar_front = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/owner_aadhar/",
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
			$aadhar_back = "";
			if($_FILES['aadhar_back']['name'] !=""){
				$temp = explode('.', $_FILES['aadhar_back']['name']);
				$ext = end($temp);
				$new_aadhar_back = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/owner_aadhar/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_aadhar_back,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('aadhar_back')){
					$data = $this->upload->data();				
					$aadhar_back = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$aadhar_back = $this->input->post('old_aadhar_back');
			} 
			$salon_photo = "";
			/*if($_FILES['salon_photo']['name'] !=""){
				$temp = explode('.', $_FILES['salon_photo']['name']);
				$ext = end($temp);
				$new_salon_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/salon_photo/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_salon_photo,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('salon_photo')){
					$data = $this->upload->data();				
					$salon_photo = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$salon_photo = $this->input->post('old_salon_photo');
			}*/
			$result=$this->Admin_model->set_salon($aadhar_front,$aadhar_back,$salon_photo);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-salon');
		}
	} 
	
	public function branch_money_back(){
		$this->form_validation->set_rules('salon','Salon','required'); 
		if($this->form_validation->run() === FALSE){
			$this->load->view('admin/branch_money_back');
		}else{
			$result=$this->Admin_model->set_branch_money_back();
			if($result){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong');
			}
			redirect('branch_payment_history');
		}
	} 
	public function branch_payment(){
		$this->form_validation->set_rules('now_payment','Payment Amount','required'); 
		if($this->form_validation->run() === FALSE){
			$this->load->view('admin/branch_payment');
		}else{
			$result=$this->Admin_model->set_branch_payment();
			if($result){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('message','Something went wrong');
			}
			redirect('branch_payment_history?branch='.$this->input->post('branch'));
		}
	} 
	public function branch_timeline(){
		$data['branch_details'] = $this->Admin_model->get_branch_details(isset($_GET['branch']) ? $_GET['branch'] : '');
		$data['branch_timeline'] = $this->Admin_model->get_branch_log(isset($_GET['branch']) ? $_GET['branch'] : '');
		$this->load->view('admin/branch_timeline',$data);
	}
	public function branch_coin_history(){
		$data['branch_details'] = $this->Admin_model->get_branch_details(isset($_GET['branch']) ? $_GET['branch'] : '');
		$data['branch_coin_history'] = $this->Admin_model->get_branch_coin_history(isset($_GET['branch']) ? $_GET['branch'] : '');
		$this->load->view('admin/branch_coin_history',$data);
	}
	public function branch_payment_history(){
		$data['branch_details'] = $this->Admin_model->get_branch_details(isset($_GET['branch']) ? $_GET['branch'] : '');
		$this->load->view('admin/branch_payment_history',$data);
	}
	public function salon_gallary(){ 
		$this->form_validation->set_rules('category','category type','required');
		if($this->form_validation->run() === FALSE){
			$data['salon_gallary_list'] = $this->Admin_model->get_all_salon_gallary();
			$data['single'] = $this->Admin_model->get_single_salon_gallary();
			$data['gallary_category'] = $this->Admin_model->get_gallary_category(); 
			$this->load->view('admin/salon-gallary',$data);
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
			        $this->upload->initialize($this->Admin_model->set_upload_branch_gallary_img());

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
               $result=$this->Admin_model->salon_gallary($gallary_image_str);
				if($result == "0"){
					$this->session->set_flashdata('success','Record added successfully');
				}else{
					$this->session->set_flashdata('success','Record updated successfully');
				}
				redirect('salon-gallary/'.$this->uri->segment(2));
			}
		}
	}   
	public function add_branch(){
		$this->form_validation->set_rules('branch_name','salon_name','required'); 
		if($this->form_validation->run() === FALSE){
			$data['setup'] = $this->Master_model->get_backend_setups();
			$data['branch_list'] = $this->Admin_model->get_all_branch_list();
			$data['branches'] = $this->Admin_model->get_all_salon_branch_list();
			//$data['salon_name_list'] = $this->Admin_model->get_salon_name();
			$data['salon_name'] = $this->Admin_model->get_single_salon_name();
			$data['single'] = $this->Admin_model->get_single_branch();
			$data['single_bank_profile'] = $this->Admin_model->get_single_branch_profile();
			$data['state'] = $this->Admin_model->get_state_list();
			$data['salon_type'] = $this->Admin_model->get_type_of_salon_with_rules();
			$this->load->view('admin/add_branch',$data);
		}else{
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
			$result=$this->Admin_model->set_branch($shopact);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-branch');
		}
	} 
	public function branch_gallary(){ 
		$this->form_validation->set_rules('category','category type','required');
		if($this->form_validation->run() === FALSE){
			$data['gallary_list'] = $this->Admin_model->get_branch_gallary($this->uri->segment(2));
			$data['single'] = $this->Admin_model->get_single_gallary();
			$data['gallary_category'] = $this->Admin_model->get_gallary_category();
			$data['salon_name'] = $this->Admin_model->get_single_salon_name_by_branch();
		 	$this->load->view('admin/branch_gallary',$data);
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
			        $this->upload->initialize($this->Admin_model->set_upload_gallary_img());

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
				$result=$this->Admin_model->branch_gallary($gallary_image_str);
				$this->session->set_flashdata('success','Record added successfully');
				redirect('branch-gallary/'.$this->input->post('branch_id'));
			}
		}
	}
	public function delete_branch_images(){
		$this->Admin_model->delete_branch_images();
		$this->session->set_flashdata('success','Image deleted successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}	
	public function employee_list(){
		$data['add_employee_record'] = $this->Admin_model->get_all_employee();			
		$this->load->view('admin/employee-list',$data);
	} 
	public function add_employee(){
		$this->form_validation->set_rules('full_name','full name','required'); 
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Admin_model->get_single_employee();
			$this->load->view('admin/add-employee',$data);
		}else{
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
			$aadhar_back = "";
			if($_FILES['aadhar_back']['name'] !=""){
				$temp = explode('.', $_FILES['aadhar_back']['name']);
				$ext = end($temp);
				$new_aadhar_back = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_aadhar/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_aadhar_back,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('aadhar_back')){
					$data = $this->upload->data();				
					$aadhar_back = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$aadhar_back = $this->input->post('old_aadhar_back');
			} 
			$profile_photo = "";
			if($_FILES['profile_photo']['name'] !=""){
				$temp = explode('.', $_FILES['profile_photo']['name']);
				$ext = end($temp);
				$new_profile_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_profile/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_profile_photo,
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
			$pan_file = "";
			if($_FILES['pan_file']['name'] !=""){
				$temp = explode('.', $_FILES['pan_file']['name']);
				$ext = end($temp);
				$new_pan_file = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_pancard/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_pan_file,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('pan_file')){
					$data = $this->upload->data();				
					$pan_file = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$pan_file = $this->input->post('old_pan_file');
			}
			$this->Admin_model->set_employee($aadhar_front,$aadhar_back,$profile_photo,$pan_file);
			redirect('employee-list');
		}
	} 
	public function subscription_list(){
		$data['subscription_list'] = $this->Admin_model->get_all_subscription();		
		$this->load->view('admin/subscription-list',$data);
	} 
	public function add_subscription(){
		$this->form_validation->set_rules('subscription_name','vehicle type','required');
		if($this->form_validation->run() === FALSE){
			$data['subscription_list'] = $this->Admin_model->get_all_subscription();
			$data['feature_list'] = $this->Admin_model->get_all_subscription_feature();
			$data['single'] = $this->Admin_model->get_single_subscription();
			$this->load->view('admin/add-subscription',$data);
		}else{
			$result = $this->Admin_model->add_subscription();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('subscription-list');
		}
	} 
		
	public function subscription_features(){
		$this->form_validation->set_rules('feature','Feature','required');
		if($this->form_validation->run() === FALSE){
			$data['feature_list'] = $this->Admin_model->get_all_subscription_feature();
			$data['single'] = $this->Admin_model->get_single_subscription_feature();
			$this->load->view('admin/subscription_features',$data);
		}else{
			$result = $this->Admin_model->add_subscription_feature();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('subscription-features');
		}
	} 
	public function subscription_feature_slugs(){
		$this->form_validation->set_rules('feature','Feature','required');
		if($this->form_validation->run() === FALSE){
			$data['feature_list'] = $this->Admin_model->get_all_subscription_feature();
			$data['slug_list'] = $this->Admin_model->get_all_subscription_feature_slug();
			$data['single'] = $this->Admin_model->get_single_subscription_feature_slug();
			$this->load->view('admin/subscription_features_slug',$data);
		}else{
			$result = $this->Admin_model->add_subscription_feature_slug();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('subscription-features-slugs');
		}
	} 
	public function add_sup_category(){
		$this->form_validation->set_rules('sup_category','category','required');
		if($this->form_validation->run() === FALSE){
			$data['category_name_list'] = $this->Admin_model->get_all_services_name();
			$data['single'] = $this->Admin_model->get_single_services_name();
			$this->load->view('admin/add_admin_sup_category',$data);

		}else{
			$category_image = "";
			if($_FILES['category_image']['name'] !=""){
				$temp = explode('.', $_FILES['category_image']['name']);
				$ext = end($temp);
				$new_category_image = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/service_category_image/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_category_image,
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
			$result = $this->Admin_model->add_sup_category($category_image);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-admin-sup-category');
		}
	} 
	public function add_sub_category(){
		$this->form_validation->set_rules('sub_category','sub category','required');
		if($this->form_validation->run() === FALSE){
			$data['sub_category_list'] = $this->Admin_model->get_all_sub_category_list();
			$data['single'] = $this->Admin_model->get_single_sub_category();
			$data['sup_category'] = $this->Admin_model->get_services_name();
			
			$this->load->view('admin/add-admin-sub-category',$data);

		}else{
			$result = $this->Admin_model->add_sub_category();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-admin-sub-category');
		}
	}  
	public function add_admin_service(){
		$this->form_validation->set_rules('category','category','required');
		if($this->form_validation->run() === FALSE){
			$data['service_list'] = $this->Admin_model->get_all_service_list();
			$data['single'] = $this->Admin_model->get_single_service();
			$data['sup_category'] = $this->Admin_model->get_services_name(); 
			$this->load->view('admin/add_admin_service',$data);
		}else{
			$category_image = "";
			if($_FILES['category_image']['name'] !=""){
				$temp = explode('.', $_FILES['category_image']['name']);
				$ext = end($temp);
				$new_category_image = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/service_image/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_category_image,
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
			$result = $this->Admin_model->add_admin_service($category_image);

			if ($result == 0) {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}
			redirect('add-admin-service'); 
		}
	} 
	public function customer_care_list(){
		$data['customer_care_list'] = $this->Admin_model->get_all_customer_care();			
		$this->load->view('admin/customer-care-list',$data);
	} 
	public function add_customer_care(){
		$this->form_validation->set_rules('company_name','company name','required');
		if($this->form_validation->run() === FALSE){
			$data['customer_care_list'] = $this->Admin_model->get_all_customer_care();
			$data['single'] = $this->Admin_model->get_single_customer_care();
			$this->load->view('admin/add-customer-care',$data);
		}else{
				$document = "";
				if($_FILES['document']['name'] !=""){
					$temp = explode('.', $_FILES['document']['name']);
					$ext = end($temp);
					$new_document = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
					$config = array(
						'upload_path' 	=> "admin_assets/images/document/",
						'allowed_types' => "pdf|jpg|jpeg|png",
						'file_name'	=> $new_document,
					);			
					$this->upload->initialize($config);
					if($this->upload->do_upload('document')){
						$data = $this->upload->data();				
						$document = $data['file_name'];	
					}else{ 
						$error = array('error' => $this->upload->display_errors());	
						$this->upload->display_errors();
					}
				}else{
					$document = $this->input->post('old_document');
				}
				$result = $this->Admin_model->add_customer_care($document);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-customer-care');
		}
	}
	public function salon_customer_list(){  
		$data['add_salon_record'] = $this->Admin_model->get_all_salon();
		$data['branch_list'] = $this->Admin_model->get_all_branch_for_customer();		
		$this->load->view('admin/salon-customer-list',$data);
	}
	public function branch_customer_list(){  
		$data['branch'] = $this->Admin_model->get_single_branch();
		$data['customers'] = $this->Admin_model->get_all_salon_customers($this->uri->segment(2),$this->uri->segment(3));		
		$this->load->view('admin/branch_customer_list',$data);
	}
	public function customer_care_report_list(){  
		$data['customer_care_report_list'] = $this->Admin_model->get_all_customer_care_report();		
		$this->load->view('admin/customer-care-report-list',$data);
	}
	public function view_calling_history(){
		$data['view_history_list'] = $this->Admin_model->get_all_calling_history();			
		$this->load->view('admin/view-calling-history',$data);
	}
	public function customer_care_report(){
		$this->form_validation->set_rules('customer_name','customer name','required');
		if($this->form_validation->run() === FALSE){
			$data['customer_care_report_list'] = $this->Admin_model->get_all_customer_care_report();
			$data['single'] = $this->Admin_model->get_single_customer_care_report();
			$this->load->view('admin/customer-care-report',$data);
		}else{
			
			$audio_file = "";
			if($_FILES['audio_file']['name'] !=""){
				$temp = explode('.', $_FILES['audio_file']['name']);
				$ext = end($temp);
				$new_audio_file = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/audio_file/",
					'allowed_types' => "*",
					'file_name'	=> $new_audio_file,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('audio_file')){
					$data = $this->upload->data();				
					$audio_file = $data['file_name'];	
				}else{ echo $this->upload->display_errors();exit;
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$audio_file = $this->input->post('old_audio_file');
			}
			$result = $this->Admin_model->customer_care_report($audio_file);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('customer-care-report');
		}
	} 
	public function add_admin_attendance(){
		if($this->input->post('submit_attendence') == 'submit attendence'){
			$this->Admin_model->add_admin_attendance();
			$this->session->set_flashdata("success", "Attendance added successfully.");
			if(isset($_GET['date'])){
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER'].'?date='.$this->input->post('attendance_date'));
			}
		}else{
			$this->load->view("admin/add_admin_attendance");
		}
	} 
	public function admin_attendance(){
		$data['list'] = $this->Admin_model->get_all_attendance_staff();
		$this->load->view("admin/admin_attendance",$data);
	} 
	public function generate_admin_salary(){
		$this->form_validation->set_rules('staff','Staff','required');
		if ($this->form_validation->run()=== FALSE) {
			$data['employee'] = $this->Admin_model->get_all_active_staff();
			$this->load->view("admin/generate_admin_salary",$data);
		}else{
			$res = $this->Admin_model->set_salary_slip();
			$this->session->set_flashdata("success", "Salary slip generate Successfully.");
			redirect('print_salary_slip/'.$res);
		}
	} 
	public function admin_salary_list(){
		$data['salary_list'] = $this->Admin_model->get_all_salary();
		// echo "<pre>"; print_r($data['salary_list']); exit;
	   $this->load->view('admin/admin-salary-list',$data);
	}
	public function print_salary_slip(){
		$data['slip'] = $this->Admin_model->get_salary_slip_details();
		$this->load->view("admin/print_salary_slip",$data);
	}   
	public function add_lead(){
		if($this->input->post('upload_excel') == 'upload_excel'){ 
			$this->load->library('excel');
			if(isset($_FILES['excel_upload']['name'])){ 
				$path = $_FILES['excel_upload']["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				ini_set('memory_limit', '-1');
				$data = array();
				foreach($object->getWorksheetIterator() as $worksheet){
					$highestRow = $worksheet->getHighestRow(); 
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row <= $highestRow; $row++){ 
						if($worksheet->getCellByColumnAndRow(2, $row)->getValue() != ''){ 
							$salon_owner_name                = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
							$owner_number                    = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
							$email             	 	         = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
							$salon_address					 = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
							$salon_name 					 = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
							$salon_number 				     = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
							$source 		                 = $worksheet->getCellByColumnAndRow(8,$row)->getValue();
							$status_of_salon 				 = $worksheet->getCellByColumnAndRow(9,$row)->getValue();
							$assigned_executive 			 = $worksheet->getCellByColumnAndRow(10,$row)->getValue();
							$follow_up_date 				 = $worksheet->getCellByColumnAndRow(11,$row)->getValue();
							$remark 					     = $worksheet->getCellByColumnAndRow(12,$row)->getValue(); 
							$data[] = array( 
								'salon_owner_name'		=>$salon_owner_name,
								'owner_number'	       	=>$owner_number,
								'email'		   		    =>$email,
								'salon_address'		    =>$salon_address,
								'salon_name'              =>$salon_name,
								'salon_number'			=>$salon_number,
								'source'			        =>$source,
								'status_of_salon'		    =>$status_of_salon,
								'assigned_executive'      =>$assigned_executive,
								'follow_up_date'          =>$follow_up_date,
								'remark'                  =>$remark, 
							);
						}
					}
				} 
				if(!empty($data)){
					$res = $this->Admin_model->add_lead($data);
					if($res){
						$this->session->set_flashdata('success','Data imported successfullY!');
						redirect('add-person-lead');
					}else{
						$this->session->set_flashdata('message','Data Imported Is Empty.');
						redirect('add-person-lead');
					}
				}
			}
		}else{
			$this->load->view('admin/add-lead');
		}
	} 
	public function lead_list(){ 
		$this->form_validation->set_rules('status','status name','required');
		if($this->form_validation->run() === FALSE){ 
			$data['all_lead_list'] = $this->Admin_model->get_all_lead();
			$data['status_list'] = $this->Admin_model->get_all_status_name(); 
			$this->load->view('admin/lead-list',$data); 
		}else{ 
			$result = $this->Admin_model->customer_crm();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('lead-list');
		} 
	} 
	public function customer_crm(){ 
		if($this->session->userdata('id') !== null){ 
		    if($this->input->post('submit_action') =='submit_action' && $this->input->post('status') !='') {
				$res=$this->Admin_model->add_crm_status_activity(); 
				if($res == 1){
					$this->session->set_flashdata('success','Reminder Save Successfully!'); 
					redirect('customer-crm');
				}else{
					$this->session->set_flashdata('message','Something wrong try again!');
					redirect('customer-crm');
				}
			}
			$data['crm_status']=$this->Admin_model->get_crm_status();
			$data['status_name'] = $this->Admin_model->get_all_status_name();echo "<pre>";print_r($data['status_name']);exit;
			$this->load->view('front/customer_crm',$data);
		} 
	}  
	public function crm_status_master(){
		$this->form_validation->set_rules('status_name','status type','required');
		if($this->form_validation->run() === FALSE){
			$data['status_list'] = $this->Admin_model->get_all_status_name();
			$data['single'] = $this->Admin_model->get_single_status();
			$this->load->view('admin/crm-status-master',$data);
		}else{
			$result = $this->Admin_model->crm_status_master();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('crm-status-master');
		}
	}  
	public function owner_detail(){
		if($this->uri->segment(2) !=''){
			$data['get_single_lead_info']=$this->Admin_model->get_single_lead_info();
			$this->load->view('admin/owner-detail',$data);
		}
	}
	public function add_membership_management(){ 
		$this->form_validation->set_rules('membership_name','membership name','required');
		if($this->form_validation->run() === FALSE){
			$data['services']=$this->Admin_model->get_active_admin_services();
			$data['single']=$this->Admin_model->get_single_membership();
			// echo '<pre>'; print_r($data['single']); exit();
			$this->load->view('admin/add_membership',$data); 
		}else{
			$result = $this->Admin_model->add_membership();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			// redirect('add_membership_management');
			redirect('admin_membership_list');
		}
	}
	public function admin_membership_list(){ 
		$data['membership']=$this->Admin_model->get_all_membership();
		$this->load->view('admin/membership_list',$data);  
	}
	public function admin_add_coupon(){
		$this->form_validation->set_rules('coupon_name','coupon Name','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Admin_model->get_single_coupon_code();
			$this->load->view('admin/admin_add_coupon',$data);
		}else{  
			$result = $this->Admin_model->set_coupon_code();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_list_coupon');
		}
	}
	public function admin_list_coupon(){ 
		$data['coupon_code_list'] = $this->Admin_model->get_all_coupon_code();
		$this->load->view('admin/admin_list_coupon',$data);  
	}
	public function reward_point_management(){
		$this->form_validation->set_rules('gender','gender','required');
		if($this->form_validation->run() === FALSE){
			$data['reward_point_list'] = $this->Admin_model->get_all_reward_point();
			$data['single'] = $this->Admin_model->get_single_reward_point();
			$this->load->view('admin/reward_point_management',$data);
		}else{ 
			$result = $this->Admin_model->add_reward_point();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('reward_point_management');
		}
	}
	public function admin_add_booking_status(){
		$this->form_validation->set_rules('status_name','status_name','required');
		if($this->form_validation->run() === FALSE){
			$data['color_list'] = $this->Admin_model->get_all_status_color();
			$data['booking_status'] = $this->Admin_model->get_all_booking_status();
			$data['single'] = $this->Admin_model->get_single_status_color_data();
			$this->load->view('admin/admin_add_booking_status',$data); 
		}else{
			$result = $this->Admin_model->set_booking_status();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_add_booking_status');
		}
		
	}
	public function admin_add_offer(){
		$this->form_validation->set_rules('offers_name','Product Name','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Admin_model->get_single_offers();
			$this->load->view('admin/admin_add_offer',$data);
		}else{
			$result = $this->Admin_model->set_offers();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_add_offer');
		}
	}
	public function admin_offer_list(){
		$data['offers_list'] = $this->Admin_model->get_all_offer();
		$this->load->view('admin/admin_offer_list',$data);
	} 
	public function admin_add_giftcard(){
		$this->form_validation->set_rules('gift_name','gift Name','required');
		if($this->form_validation->run() === FALSE){
			$data['single'] = $this->Admin_model->get_single_giftcard();
			$data['services'] = $this->Admin_model->get_all_service_list_active();
			$this->load->view('admin/admin_add_giftcard',$data);
		}else{
			$result = $this->Admin_model->set_giftcard();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_add_giftcard');
		}
	}
	public function admin_giftcard_list(){
		$data['gift_card_list'] = $this->Admin_model->get_all_gift_card();
		$this->load->view('admin/admin_giftcard_list',$data);
	} 
	public function admin_add_package(){
		$this->form_validation->set_rules('package_name','Product Name','required');
		if($this->form_validation->run() === FALSE){
			$data['products'] = $this->Admin_model->get_all_product_list_active();
			$data['single'] = $this->Admin_model->get_single_package(); 
			$this->load->view('admin/admin_add_package',$data);
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
			$result = $this->Admin_model->set_package($document);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_add_package');
		}
	}
	public function admin_package_list(){
		$data['package_list'] = $this->Admin_model->get_all_package();
		$this->load->view('admin/admin_package_list',$data);
	} 
	public function admin_booking_rules(){
		if($this->input->post('next') == "next"){
			redirect('rules_setup?type='.$this->input->post('type'));
		}
		$data['salon_type'] = $this->Admin_model->get_type_of_salon();
		$this->load->view('admin/admin_booking_rules',$data);
	} 
	public function rules_setup(){
		$data['salon_type'] = $this->Admin_model->get_type_of_salon();
		$data['single_rules'] = $this->Admin_model->get_single_booking_rules();
		$this->load->view('admin/rules_setup',$data); 
	}
	public function admin_product_category(){
		$this->form_validation->set_rules('product_category','Product Category','required');
		if($this->form_validation->run() === FALSE){ 
			$data['category'] = $this->Admin_model->get_product_category();
			$data['single'] = $this->Admin_model->get_single_product_category(); 
			$this->load->view('admin/admin_product_category',$data);
		}else{
			$product_photo = "";
			if($_FILES['product_photo']['name'] !=""){
				$temp = explode('.', $_FILES['product_photo']['name']);
				$ext = end($temp);
				$new_product_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/product_category/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_product_photo,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('product_photo')){
					$data = $this->upload->data();				
					$product_photo = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$product_photo = $this->input->post('old_product_photo');
			} 
			$result = $this->Admin_model->set_product_category($product_photo);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_product_category');
		}
	}
	
	public function admin_product_subcategory(){
		$this->form_validation->set_rules('product_category','Product Category','required');
		if($this->form_validation->run() === FALSE){ 
			$data['category'] = $this->Admin_model->get_product_category();
			$data['subcategory'] = $this->Admin_model->get_product_subcategory();
			$data['single'] = $this->Admin_model->get_single_product_subcategory(); 
			$this->load->view('admin/admin_product_subcategory',$data);
		}else{ 
			$result = $this->Admin_model->set_product_subcategory();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_product_subcategory');
		}
	}
	public function admin_product_category_list(){
		$data['product_category'] = $this->Admin_model->get_all_product_category();
		$this->load->view('admin/admin_product_category_list',$data);
	}	
	public function admin_product_subcategory_list(){
		$data['product_sub_category'] = $this->Admin_model->get_all_product_sub_category();
		$this->load->view('admin/admin_product_subcategory_list',$data);
	}	
	public function admin_product_list(){
		$data['product'] = $this->Admin_model->get_all_product();
		$this->load->view('admin/admin_product_list',$data);
	}	
	public function admin_product_add(){
		$this->form_validation->set_rules('product_name','Product Name','required');
		if($this->form_validation->run() === FALSE){
			$data['unit'] = $this->Admin_model->get_all_product_unit(); 
			$data['category'] = $this->Admin_model->get_product_category();
			$data['single'] = $this->Admin_model->get_single_product(); 
			$this->load->view('admin/admin_product_add',$data);
		}else{
			$product_photo = "";
			if($_FILES['product_photo']['name'] !=""){
				$temp = explode('.', $_FILES['product_photo']['name']);
				$ext = end($temp);
				$new_product_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/product_image/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'		=> $new_product_photo,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('product_photo')){
					$data = $this->upload->data();				
					$product_photo = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$product_photo = $this->input->post('old_product_photo');
			} 
			$result = $this->Admin_model->set_product($product_photo);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('admin_product_add');
		}
	}
	public function pending_salon_product(){
		$this->form_validation->set_rules('reject_reason','reject reason','required');
		if($this->form_validation->run() === FALSE){
			$data['product'] = $this->Admin_model->get_all_pending_product();
			$this->load->view('admin/pending_salon_product',$data);
		}else{
			$result = $this->Admin_model->pending_salon_products();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('pending_salon_product');
		} 
		if($this->input->post('sent_btn') == "sent_btn"){	
			$this->Admin_model->set_for_approve_product(); 
			$this->session->set_flashdata('success','Pending product approved successfully');
			redirect('pending_salon_product');
		}
	} 
	public function customize_messages(){
		$this->load->view('admin/customize_messages');
	} 
	public function customize_message_response(){
		$result = $this->Admin_model->customize_message_response();
		if($result == 0){
			if($this->input->post('type') == '1'){
				$this->session->set_flashdata('success','Message approved successfully');
			}elseif($this->input->post('type') == '2'){
				$this->session->set_flashdata('success','Message rejected successfully');
			}
		}else{
			$this->session->set_flashdata('message','Message not found, Please try again');
		}
		redirect('customize-messages');
	} 
	public function rule_update_requests(){
		$this->load->view('admin/rule_update_requests');
	} 
	public function store_rule_update_requests(){
		$data['branch'] = $this->Admin_model->get_branch_details(isset($_GET['branch']) ? $_GET['branch'] : '');
		$this->load->view('admin/branch_rule_update_requests',$data);
	} 
	public function rule_update_requests_response(){
		$result = $this->Admin_model->rule_update_requests_response();
		if($result == 0){
			if($this->input->post('type') == '1'){
				$this->session->set_flashdata('success','Request approved successfully');
			}elseif($this->input->post('type') == '2'){
				$this->session->set_flashdata('success','Request rejected successfully');
			}
			redirect('store-rule-update-requests?status='.$this->input->post('type').'&branch='.$this->input->post('branch'));
		}else{
			$this->session->set_flashdata('message','Request not found, Please try again');
			redirect('store-rule-update-requests?branch='.$this->input->post('branch'));
		}
	} 


	
	public function add_reason(){
		$this->form_validation->set_rules('reason','Reason','required');
		if($this->form_validation->run() == false){
			$data['single'] = $this->Admin_model->get_single_reason();
			$this->load->view('admin/add_reason',$data);
		}else{
			$result = $this->Admin_model->add_reason();
			if($result == 1){
				$this->session->set_flashdata("success","New reason is added successfully ! ");
			}else{
				$this->session->set_flashdata("success","Reason updated successfully ! ");
			}	
			redirect("add-ticket-category");
		}
	}
	public function give_replay(){
		$this->Admin_model->give_replay();
		$this->session->set_flashdata("success","Replay submitted successfully ! ");
		redirect('customer-tickets');
	}
	public function give_final_remark(){
		$this->Admin_model->give_final_remark();
		$this->session->set_flashdata("success","Final remark submitted successfully ! ");
		redirect('customer-tickets');
	}
	public function customer_queries(){
		$data['customers'] = $this->Admin_model->get_all_customers();
		$data['salons'] = $this->Admin_model->get_all_salon();
		if(isset($_GET['salon'])){
			$data['branches'] = $this->Admin_model->get_all_salon_branch($_GET['salon']);
		}
		$data['queries'] = $this->Admin_model->get_all_customers_queries();
		$data['subjects'] = $this->Admin_model->get_all_subjects();
		$this->load->view('admin/customer_queries',$data);
	}
	public function app_users(){
		$this->load->view('admin/app_users');
	}


	
	public function update_profile(){
		$this->form_validation->set_rules('full_name','Full Name','required');
		if($this->form_validation->run() == false){
			$this->load->view('admin/my_profile');
		}else{			
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
			$aadhar_back = "";
			if($_FILES['aadhar_back']['name'] !=""){
				$temp = explode('.', $_FILES['aadhar_back']['name']);
				$ext = end($temp);
				$new_aadhar_back = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_aadhar/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_aadhar_back,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('aadhar_back')){
					$data = $this->upload->data();				
					$aadhar_back = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$aadhar_back = $this->input->post('old_aadhar_back');
			} 
			$profile_photo = "";
			if($_FILES['profile_photo']['name'] !=""){
				$temp = explode('.', $_FILES['profile_photo']['name']);
				$ext = end($temp);
				$new_profile_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_profile/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_profile_photo,
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
			$pan_file = "";
			if($_FILES['pan_file']['name'] !=""){
				$temp = explode('.', $_FILES['pan_file']['name']);
				$ext = end($temp);
				$new_pan_file = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$config = array(
					'upload_path' 	=> "admin_assets/images/employee_pancard/",
					'allowed_types' => "pdf|jpg|jpeg|png",
					'file_name'	=> $new_pan_file,
				);			
				$this->upload->initialize($config);
				if($this->upload->do_upload('pan_file')){
					$data = $this->upload->data();				
					$pan_file = $data['file_name'];	
				}else{ 
					$error = array('error' => $this->upload->display_errors());	
					$this->upload->display_errors();
				}
			}else{
				$pan_file = $this->input->post('old_pan_file');
			}
			$result = $this->Admin_model->update_profile($aadhar_front,$aadhar_back,$profile_photo,$pan_file);
			if($result){
				$this->session->set_flashdata("success","Profile updated successfully");
			}else{
				$this->session->set_flashdata("message","Something went wrong, Please try again");
			}	
			redirect("update-profile");
		}
	}
}   
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_controller extends CI_Controller {
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
	public function add_facility(){
		$this->form_validation->set_rules('facility_name','vehicle type','required');
		if($this->form_validation->run() === FALSE){
			$data['facility_list'] = $this->Master_model->get_all_facility();
			$data['single'] = $this->Master_model->get_single_facility();
			$this->load->view('admin/add-facility',$data);
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
			$result = $this->Master_model->add_facility($icon);
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('add-facility');
		}
	}  
	public function add_tips(){
		$this->form_validation->set_rules('tips','tips','required'); 
		if($this->form_validation->run() === FALSE){
			$data['tips_list'] = $this->Master_model->get_all_tips();
			$data['single'] = $this->Master_model->get_single_tips();
			$data['title_details'] = $this->Master_model->get_single_tip_titles($this->uri->segment(2));
			// echo '<pre>'; print_r($data['title_details']); exit();
			$this->load->view('admin/add-tips',$data);
		}else{			
			$tips_photo = array();
			if(isset($_FILES['tips_photo']) && $_FILES['tips_photo']['name'] != ""){
			    $files = $_FILES;
			    $cpt = count($_FILES['tips_photo']['name']);
			    for($i=0; $i<$cpt; $i++){
			        $_FILES['userfile']['name'] = $files['tips_photo']['name'][$i];
			        $_FILES['userfile']['type'] = $files['tips_photo']['type'][$i];
			        $_FILES['userfile']['tmp_name'] = $files['tips_photo']['tmp_name'][$i];
			        $_FILES['userfile']['error'] = $files['tips_photo']['error'][$i];
			        $_FILES['userfile']['size'] = $files['tips_photo']['size'][$i];

			        $this->load->library('upload');
			        $this->upload->initialize($this->Master_model->set_upload_tips_img());

			        if (!$this->upload->do_upload()){
			            $error = array('error' => $this->upload->display_errors());
			            // echo $this->upload->display_errors();
			        } else {
			            $all_file = $this->upload->data();
			            $tips_photo[] = $all_file['file_name']; 
			        }    
			    }
			}
			$tips_photo = implode(',', $tips_photo);
			$result = $this->Master_model->add_tips($tips_photo);

			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('add-tips');
		}
	} 
	public function add_location(){
		$this->form_validation->set_rules('location','Location Name','required'); 
		if($this->form_validation->run() === FALSE){
			$data['location_list'] = $this->Master_model->get_all_location();
			$data['single'] = $this->Master_model->get_single_location();
			$this->load->view('admin/add-location',$data);
		}else{			
			$result = $this->Master_model->add_location();

			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('add-location');
		}
	} 
	public function add_gst_rate(){
		$this->form_validation->set_rules('gst_rate','GST Rate','required'); 
		if($this->form_validation->run() === FALSE){
			$data['setup'] = $this->Master_model->get_backend_setups();
			$this->load->view('admin/add-gst-rate',$data);
		}else{			
			$result = $this->Master_model->set_gst_rate();
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}
			redirect('add-gst-rate');
		}
	} 
	public function mobile_banner(){
		if($this->input->post('banner_submit') != 'banner_submit'){
			$data['banner'] = $this->Master_model->get_all_banner();
			$data['single'] = $this->Master_model->get_single_banner();
			$this->load->view('admin/mobile_banner',$data);
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
			            // echo $this->upload->display_errors();
			        } else {
			            $all_file = $this->upload->data();
			            $tips_photo[] = $all_file['file_name']; 
			        }    
			    }
			}
			// $tips_photo = implode(',', $tips_photo);
			$result = $this->Master_model->add_banner($tips_photo);

			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('mobile-banner');
		}
	} 
	public function privacy_policy(){
		$this->form_validation->set_rules('text','Privacy Policy','required'); 
		if($this->form_validation->run() === FALSE){
			$data['privacy_policy'] = $this->Master_model->get_privacy_policy();
			$data['single'] = $this->Master_model->get_single_privacy_policy($this->uri->segment(2));
			$this->load->view('admin/privacy_policy',$data);
		}else{
			$result = $this->Master_model->set_privacy_policy();

			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('privacy-policy');
		}
	} 
	public function terms_conditions(){
		$this->form_validation->set_rules('text','Terms & Conditions','required'); 
		if($this->form_validation->run() === FALSE){
			$data['privacy_policy'] = $this->Master_model->get_terms_conditions();
			$data['single'] = $this->Master_model->get_single_terms_conditions($this->uri->segment(2));
			$this->load->view('admin/terms_conditions',$data);
		}else{
			$result = $this->Master_model->set_terms_conditions();

			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('terms-conditions');
		}
	} 
	public function salon_close_reason(){
		$this->form_validation->set_rules('reason_title','vehicle type','required');
		if($this->form_validation->run() === FALSE){
			$data['reason_list'] = $this->Master_model->get_all_reason();
			$data['single'] = $this->Master_model->get_single_reason();
			$this->load->view('admin/salon-close-reason',$data);
		}else{
			$result = $this->Master_model->salon_close_reason();
			if($result == "0"){
				$this->session->set_flashdata('success','Record added successfully');
			}else{
				$this->session->set_flashdata('success','Record updated successfully');
			}
			redirect('salon-close-reason');
		}
	} 
	public function salon_marketing(){
		if($this->input->post('service_remindner_button') == 'service_remindner_button'){
			$result = $this->Master_model->set_service_remindner_days();
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}elseif($this->input->post('lost_customer_button') == 'lost_customer_button'){
			$result = $this->Master_model->set_lost_customer_days();
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}elseif($this->input->post('set_money_back_1000_value') == 'set_money_back_1000_value'){
			$result = $this->Master_model->set_money_back_value(1000);
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}elseif($this->input->post('set_money_back_1500_value') == 'set_money_back_1500_value'){
			$result = $this->Master_model->set_money_back_value(1500);
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}elseif($this->input->post('set_money_back_2000_value') == 'set_money_back_2000_value'){
			$result = $this->Master_model->set_money_back_value(2000);
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}elseif($this->input->post('set_money_back_2500_value') == 'set_money_back_2500_value'){
			$result = $this->Master_model->set_money_back_value(2500);
			$this->session->set_flashdata('success','Record updated successfully');
			redirect('salon-marketing');
		}else{	
			$data['setup'] = $this->Master_model->get_backend_setups();
			$this->load->view('admin/salon_marketing',$data);
		}
	} 
	public function add_catlogue(){
		$this->form_validation->set_rules('gender','Gender','required');
		if($this->form_validation->run() === FALSE){
			$data['facility_list'] = $this->Master_model->get_all_catlogue();
			$data['single'] = $this->Master_model->get_single_catlogue();
			$this->load->view('admin/add-catlogue',$data);
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
			redirect('add-catlogue');
		}
	}  
	
	public function app_support(){
		$this->form_validation->set_rules('text','Description','required'); 
		if($this->form_validation->run() === FALSE){
			$data['privacy_policy'] = $this->Master_model->get_app_support();
			$data['single'] = $this->Master_model->get_single_app_support($this->uri->segment(2));
			$this->load->view('admin/app_support',$data);
		}else{
			$result = $this->Master_model->set_app_support();

			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record inserted successfully');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully');
			}

			redirect('app-support');
		}
	} 
}	
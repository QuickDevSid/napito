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
			// $allowed_status = ['7','8','9','10','11','12','13','15','16','18'];
			$allowed_status = ['3','5','9','10','11','12','13','15','16','18'];
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
}

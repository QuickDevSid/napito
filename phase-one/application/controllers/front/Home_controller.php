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
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_controller extends CI_Controller {
	public function survey_list(){
		$this->load->view('admin/survey_list');
	}
	public function survey_form() {
		if ($this->input->post('submit_basic_info') == 'submit_basic_info') {
			$last_id = $this->Survey_model->submit_survey_form();
			if ($last_id) {
				$no_of_people = $this->input->post('no_of_people');
				$no_of_chairs = $this->input->post('no_of_chairs');
				$this->session->set_userdata('last_id', $last_id);
				if ($no_of_people >= 3 && $no_of_chairs >= 3) {
					if($this->input->post('redirect_1') == ""){
						redirect('survey/'.$last_id.'/nav-other');
					}else{
						redirect('survey/'.$last_id.'/nav-other?edit');
					}
				} else {
					if($this->input->post('redirect_1') == ""){
						$this->session->set_flashdata('success', 'Survey inserted successfully');
						redirect('thank-you');
					}else{
						$this->session->set_flashdata('success', 'Survey updated successfully');
						redirect($this->input->post('redirect_1'));
					}
				}
			} else {
				$this->session->set_flashdata('message', 'Error occurred. Please try again');
				redirect('survey');
			}
		}
		if ($this->input->post('submit_other_info') == 'submit_other_info') {
			// echo '<pre>'; print_r($_POST); exit();
			$last_id = $this->session->userdata('last_id');
			if ($last_id) {
				$salon_owner_selfie = "";
				if(isset($_FILES['salon_owner_selfie']) && $_FILES['salon_owner_selfie']['name'] != "") {
					$this->load->library('upload');
					$config['upload_path']   = "admin_assets/images/survey/";
					$config['allowed_types'] = "*"; 
					$config['encrypt_name']  = TRUE; 
					$this->upload->initialize($config);
					if($this->upload->do_upload('salon_owner_selfie')) {
						$upload_data = $this->upload->data();
						$salon_owner_selfie = $upload_data['file_name'];
					} else {
						$error = $this->upload->display_errors();   
					}
				}else{
					$img = $_POST['image'];
					if($img !=""){
						$folderPath = "admin_assets/images/survey/";
					
						$image_parts = explode(";base64,", $img);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = $image_type_aux[1];
					
						$image_base64 = base64_decode($image_parts[1]);
						$fileName = uniqid() . '.png';
					
						$file = $folderPath . $fileName;
						file_put_contents($file, $image_base64);
						$salon_owner_selfie = $fileName;
					}else{
						$salon_owner_selfie = '';
					}
				}

				if (empty($salon_owner_selfie)) {
					$salon_owner_selfie = $this->input->post('old_salon_owner_selfie');
				}
				$this->Survey_model->submit_form($last_id,$salon_owner_selfie);
				if($this->input->post('redirect_2') == ""){
					$this->session->set_flashdata('success', 'Additional information submitted successfully');
					redirect('thank-you');
				}else{
					$this->session->set_flashdata('success', 'Additional information updated successfully');
					redirect($this->input->post('redirect_2'));
				}
			} else {
				$this->session->set_flashdata('message', 'Error occurred. Please try again');
				redirect('survey');
			}
		} 
		$data['single'] = $this->Survey_model->get_single_survey();
		$this->load->view('admin/survey_form',$data);
	}
    private function getImageTypeFromBase64($base64_metadata) {
        // Determine the file extension based on the base64 metadata
        if (strpos($base64_metadata, 'data:image/jpeg') !== false) {
            return ['type' => 'jpeg', 'extension' => 'jpg'];
        } elseif (strpos($base64_metadata, 'data:image/png') !== false) {
            return ['type' => 'png', 'extension' => 'png'];
        } elseif (strpos($base64_metadata, 'data:image/gif') !== false) {
            return ['type' => 'gif', 'extension' => 'gif'];
        } else {
            return null; // Unsupported image type
        }
    }
	public function thank_you(){
		$this->load->view('admin/thank_you');
	} 
}

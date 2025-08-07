<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Survey_model extends CI_Model {    
	public function get_salon_survey_list($length, $start, $search){
		$this->db->select('tbl_salon_survey.*,tbl_employee.full_name as executive_name'); 
		if($this->input->post('billing_counter') != ""){
			$billing_counter = explode('@@',$this->input->post('billing_counter'));
			if($billing_counter[0] == 'Yes'){
				$this->db->where('tbl_salon_survey.billing_counter','Yes');
				if($billing_counter[1] == "Receptionist"){
					$this->db->where('tbl_salon_survey.receptionist_available','Yes');
				}else{
					$this->db->where('tbl_salon_survey.receptionist_available','No');
				}
			}else{
				$this->db->where('tbl_salon_survey.billing_counter','No');
			}
		}
		if($this->input->post('date') != ""){
			$this->db->where('DATE(tbl_salon_survey.created_on)',date('Y-m-d',strtotime($this->input->post('date'))));
		}
		if($this->input->post('valid_invalid') != ""){
			$this->db->where('tbl_salon_survey.valid_invalid',$this->input->post('valid_invalid'));
		}
		if($this->input->post('salon_category') != ""){
			$this->db->where('tbl_salon_survey.salon_category',$this->input->post('salon_category'));
		}
		if($this->input->post('city') != ""){
			$this->db->where('tbl_salon_survey.city',$this->input->post('city'));
		}
		if($this->input->post('location') != ""){
			$this->db->where('tbl_salon_survey.location',$this->input->post('location'));
		}
		if($this->input->post('salon_type') != ""){
			$this->db->where('tbl_salon_survey.salon_type',$this->input->post('salon_type'));
		}
		if($this->input->post('service_provide_type') != ""){
			$this->db->where('tbl_salon_survey.service_provide_type',$this->input->post('service_provide_type'));
		}
		$this->db->where('tbl_salon_survey.is_deleted','0');

		if($this->input->post('executive_name') != ''){
			$this->db->where('tbl_salon_survey.added_by_id',$this->input->post('executive_name')); 
		}

		if($this->session->userdata('user_type') == '0'){

		}else{
			$this->db->where('tbl_salon_survey.added_by_id',$this->session->userdata('admin_id')); 
		}
		if($search !=""){
			$this->db->group_start();
			$this->db->or_like('tbl_salon_survey.service_provide_type',$search);
			$this->db->or_like('tbl_salon_survey.billing_counter',$search);
			$this->db->or_like('tbl_salon_survey.receptionist_available',$search);
			$this->db->or_like('tbl_salon_survey.salon_name',$search);
			$this->db->or_like('tbl_salon_survey.salon_address',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_name',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_contact',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_free_on',$search);
			$this->db->or_like('tbl_salon_survey.no_of_people',$search);
			$this->db->or_like('tbl_salon_survey.no_of_chairs',$search);
			$this->db->or_like('tbl_salon_survey.celebrities',$search);
			$this->db->group_end();
		}
		$this->db->join('tbl_employee','tbl_employee.id = tbl_salon_survey.added_by_id','left');
		$this->db->order_by('tbl_salon_survey.created_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_salon_survey');
		return $result->result();		
	}
	public function get_salon_survey_list_count($search){
	$this->db->select('tbl_salon_survey.*,tbl_employee.full_name as executive_name'); 
		if($this->input->post('billing_counter') != ""){
			$billing_counter = explode('@@',$this->input->post('billing_counter'));
			if($billing_counter[0] == 'Yes'){
				$this->db->where('tbl_salon_survey.billing_counter','Yes');
				if($billing_counter[1] == "Receptionist"){
					$this->db->where('tbl_salon_survey.receptionist_available','Yes');
				}
			}else{
				$this->db->where('tbl_salon_survey.billing_counter','No');
			}
		}
		if($this->input->post('date') != ""){
			$this->db->where('DATE(tbl_salon_survey.created_on)',date('Y-m-d',strtotime($this->input->post('date'))));
		}
		if($this->input->post('valid_invalid') != ""){
			$this->db->where('tbl_salon_survey.valid_invalid',$this->input->post('valid_invalid'));
		}
		if($this->input->post('salon_category') != ""){
			$this->db->where('tbl_salon_survey.salon_category',$this->input->post('salon_category'));
		}
		if($this->input->post('city') != ""){
			$this->db->where('tbl_salon_survey.city',$this->input->post('city'));
		}
		if($this->input->post('location') != ""){
			$this->db->where('tbl_salon_survey.location',$this->input->post('location'));
		}
		if($this->input->post('salon_type') != ""){
			$this->db->where('tbl_salon_survey.salon_type',$this->input->post('salon_type'));
		}
		if($this->input->post('service_provide_type') != ""){
			$this->db->where('tbl_salon_survey.service_provide_type',$this->input->post('service_provide_type'));
		}
		if($this->input->post('executive_name') != ''){
			$this->db->where('tbl_salon_survey.added_by_id',$this->input->post('executive_name')); 
		}
		$this->db->where('tbl_salon_survey.is_deleted','0');
		if($this->session->userdata('user_type') == '0'){

		}else{
			$this->db->where('tbl_salon_survey.added_by_id',$this->session->userdata('admin_id')); 
		}
		if($search !=""){
			$this->db->group_start();
			$this->db->or_like('tbl_salon_survey.service_provide_type',$search);
			$this->db->or_like('tbl_salon_survey.billing_counter',$search);
			$this->db->or_like('tbl_salon_survey.receptionist_available',$search);
			$this->db->or_like('tbl_salon_survey.salon_name',$search);
			$this->db->or_like('tbl_salon_survey.salon_address',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_name',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_contact',$search);
			$this->db->or_like('tbl_salon_survey.salon_owner_free_on',$search);
			$this->db->or_like('tbl_salon_survey.no_of_people',$search);
			$this->db->or_like('tbl_salon_survey.no_of_chairs',$search);
			$this->db->or_like('tbl_salon_survey.celebrities',$search);
			$this->db->group_end();
		}
		$this->db->join('tbl_employee','tbl_employee.id = tbl_salon_survey.added_by_id','left');
		$this->db->order_by('tbl_salon_survey.created_on','DESC');
		$result = $this->db->get('tbl_salon_survey');
		return $result->num_rows();
	}

	public function get_single_survey(){
        $this->db->where('tbl_salon_survey.is_deleted','0');
		$this->db->where('tbl_salon_survey.id',$this->uri->segment(2));
		$result = $this->db->get('tbl_salon_survey');
		return $result->row();
    }

	public function get_respective_state_city($state_id){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('state_id',$state_id);
		$this->db->order_by('id','desc');
		return $this->db->get('cities')->result();
	}

	public function get_respective_location($city_id){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('city_id',$city_id);
		$this->db->order_by('id','desc');
		return $this->db->get('tbl_location')->result();
	}

	public function get_last_entry_data(){
		$this->db->where('added_by_id',$this->session->userdata('admin_id'));
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);              
		$query = $this->db->get('tbl_salon_survey'); 
		return $query->row();      
	}

	public function submit_survey_form() {
        $salon_type = $this->input->post('salon_type');
        if ($salon_type == '0') { 
            $rate_wax = '';
            $rate_haircut =  $this->input->post('rate_haircut');
            $rate_beard = $this->input->post('rate_beard');
            $rate_eyebrows = '';
        } else if ($salon_type == '1') { 
            $rate_wax = $this->input->post('rate_wax');
            $rate_haircut =  '';
            $rate_beard = '';
            $rate_eyebrows = $this->input->post('rate_eyebrows');
        } else if ($salon_type == '2') { 
            $rate_wax = '';
            $rate_haircut =  $this->input->post('rate_haircut');
            $rate_beard = '';
            $rate_eyebrows = $this->input->post('rate_eyebrows');
        }else{
            $rate_wax = '';
            $rate_haircut =  '';
            $rate_beard = '';
            $rate_eyebrows = '';
        }
        
        $no_of_people = $this->input->post('no_of_people');
        $no_of_chairs = $this->input->post('no_of_chairs');
        if ($no_of_people >= 3 && $no_of_chairs >= 3) {
            $valid_invalid = '0';
        } else {
            $valid_invalid = '1';
        }
        $data = array(
            'salon_type'                =>  $salon_type,
            'billing_counter'           =>  $this->input->post('billing_counter'),
            'receptionist_available'    =>  $this->input->post('receptionist_available'),
            'salon_name'                =>  $this->input->post('salon_name'),
            'salon_owner_name'          =>  $this->input->post('salon_owner_name'),
            'no_of_people'              =>  $this->input->post('no_of_people'),
            'no_of_chairs'              =>  $this->input->post('no_of_chairs'),
            'rate_wax'                  =>  $rate_wax,
            'rate_haircut'              =>  $rate_haircut,
            'rate_beard'                =>  $rate_beard,
            'rate_eyebrows'             =>  $rate_eyebrows,
            'valid_invalid'             =>  null,
            'added_by_id'               =>   $this->session->userdata('admin_id'),
            'created_on'                =>  date('Y-m-d H:i:s')
        );
        if($this->input->post('id') == ""){
            $this->db->insert('tbl_salon_survey',$data);
            $last_id = $this->db->insert_id();
            return $last_id; 
        }else{
            if($valid_invalid == '1'){
                $additional_Array = array(
                    'service_provide_type'      => '',
                    'salon_address'             => '',
                    'street_name'               => '',
                    'latitude'                  => '',
                    'longitude'                 => '',
                    'salon_owner_contact'       => '',
                    'salon_owner_free_on'       => '',
                    'celebrities'               => '',
                    'state'                     => '',
                    'city'                      => '',
                    'location'                  => '',
                    'area'                      => '',
                    'pincode'                   => '',
                    'selfie'                    => '',
                    'salon_category'            => '',
                    'country'                   => '101',
                );
                $data = array_merge($data,$additional_Array);
            }
            $last_id = $this->input->post('id');
            $this->db->where('id',$last_id);
            $this->db->update('tbl_salon_survey',$data);
            return $last_id;
        }
    }
    
    public function submit_form($last_id,$photo) { 
        $this->db->where('id', $last_id);
        $single = $this->db->get('tbl_salon_survey')->row();      
        if(!empty($single)){ 
            $service_provide_type = $this->input->post('service_provide_type');
            if($service_provide_type == "Register" && $single->billing_counter == "Yes" && $single->receptionist_available == "Yes"){
                $salon_category = "Standard";
            }else if($service_provide_type == "Vendor App" && $single->billing_counter == "Yes" && $single->receptionist_available == "Yes"){
                $salon_category = "Premium";
            }else if(($service_provide_type == "Vendor App" && $single->billing_counter == "Yes" && $single->receptionist_available == "Yes") || ($service_provide_type == "Customer App" && $single->billing_counter == "Yes" && $single->receptionist_available == "Yes") || $service_provide_type == "Customer App" || $service_provide_type == "Vendor App"){
                $salon_category = "Competitor";
            }else if($service_provide_type == "Waiting"){
                $salon_category = "Basic";
            }else{
                $salon_category = '';
            }
            $data = array(
                'service_provide_type'      => $this->input->post('service_provide_type'),
                'salon_address'             => $this->input->post('salon_address'),
                'street_name'               => $this->input->post('street_name'),
                'latitude'                  => $this->input->post('latitude'),
                'longitude'                 => $this->input->post('longitude'),
                'salon_owner_contact'       => $this->input->post('salon_owner_contact'),
                'salon_owner_free_on'       => $this->input->post('salon_owner_free_on'),
                'celebrities'               => $this->input->post('celebrities'),
                'state'                     => $this->input->post('state'),
                'city'                      => $this->input->post('city'),
                'location'                  => $this->input->post('location'),
                'area'                      => $this->input->post('area'),
                'pincode'                   => $this->input->post('pincode'),
                'lead'                      =>  $this->input->post('lead'),
                'selfie'                    =>  $photo,
                'salon_category'            =>  $salon_category,
                'country'                   => '101',
            );
            $this->db->where('id', $last_id);
            $this->db->update('tbl_salon_survey', $data);
            return true;
        }else{
            return false;
        }
    }
}    
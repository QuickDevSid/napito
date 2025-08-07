<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marketing_model extends CI_Model {
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
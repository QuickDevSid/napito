<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model { 
    public function admin_login(){
        $this->db->where('is_deleted','0');  
        $this->db->where('status','1');        
        $this->db->where('email',$this->input->post('email'));  
        $this->db->where('password',$this->input->post('password'));   
        $result = $this->db->get('tbl_employee');
        $result = $result->row();       
        if(!empty($result)){
            $session = array(
                'admin_id' => $result->id,
            );
            $this->session->set_userdata($session);
            return true;       
        }else{
            return false;
        }
    }  
    public function get_user_profile(){
        $this->db->where('id',$this->session->userdata('admin_id'));
        $result = $this->db->get('tbl_employee');
        $result = $result->row();
        return $result;
    }  
    public function get_state_list(){
        $this->db->where('country_id','101');
        $result = $this->db->get('states');
        return $result->result();
    } 
    public function get_city_ajax(){
        $this->db->where('state_id',$this->input->post('state'));
        $result = $this->db->get('cities');
        echo json_encode($result->result());
    } 
    public function get_selected_state_city($state){
        $this->db->where('state_id',$state);
        $result = $this->db->get('cities');
        return $result->result();
    }
	public function salon_close_reason(){
		$data=array(
			'reason_title' 			=> $this->input->post('reason_title'),
			'salon_close_reason' 	=> $this->input->post('salon_close_reason'), 
		);
		if($this->input->post('id') == ""){
			$date=array( 
				'created_on'   => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data,$date);
			$this->db->insert('tbl_salon_close_reason',$new_arr);
			return 0;
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('tbl_salon_close_reason',$data);
			return 1;
		}
	} 
	public function get_all_reason(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_salon_close_reason');
		return $result->result();
	} 
    public function get_all_salon_close_reason(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->result();
    }
    public function get_single_reason(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->row();
    } 
    public function set_category_type(){
        $data=array(
            'category_type' => $this->input->post('category_type'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_category_type',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_category_type',$data);
            return 1;
        }
    } 
    public function get_all_category_type(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('category_type','DESC');
        $result = $this->db->get('tbl_category_type');
        return $result->result();
    } 
    public function get_single_category_type(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_category_type');
        return $result->row();
    } 
    public function inactive(){
        $data = array(
            'status' => '0'
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update($this->uri->segment(3),$data);
        return true;
    } 
    public function active(){
        $data = array(
            'status' => '1'
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update($this->uri->segment(3),$data);
        return true;
    }
    public function approve(){
        $data = array(
            'status' => '1'
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update($this->uri->segment(3),$data);
        return true;
    } 
    public function delete(){
        $data = array(
            'is_deleted' => '1'
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update($this->uri->segment(3),$data);
        return true;
    } 
    public function get_unique_category_type(){ 
        $this->db->where('category_type',$this->input->post('category_type'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_category_type');
        echo $result->num_rows();
    } 
	public function salon_gallary($gallary_image){
		$salon_id=$this->uri->segment(2);
		$data=array(
			'category' 		=> $this->input->post('category'), 
			'gallary_image' => $gallary_image,
			'salon_id'      => $salon_id,
		); 
		if($this->input->post('id') == ""){
			$date=array( 
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data,$date);
			$this->db->insert('tbl_salon_gallary',$new_arr);
			return 0;
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('tbl_salon_gallary',$data);
			return 1;
		}
	} 
	public function get_all_salon_gallary(){
		$this->db->select('tbl_salon_gallary.*,tbl_category_type.category_type ,tbl_category_type.id as category_id');
		$this->db->join('tbl_category_type','tbl_category_type.id=tbl_salon_gallary.category');
		$this->db->where('tbl_salon_gallary.is_deleted','0');
		$this->db->where('tbl_salon_gallary.salon_id',$this->uri->segment(2));
		$this->db->order_by('category','DESC');
		$result = $this->db->get('tbl_salon_gallary');
		return $result->result();
	}
	public function get_single_salon_gallary(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(3));
		$result = $this->db->get('tbl_salon_gallary');
		return $result->row();
	}
	public function set_upload_gallary_img() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/gallary_image/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	} 
    public function set_salon($aadhar_front,$aadhar_back,$salon_photo){
        $data=array(
            'salon_name'             => $this->input->post('salon_name'),
            'salon_owner_name'       => $this->input->post('salon_owner_name'),
            'salon_owner_number'     => $this->input->post('salon_owner_number'),
            'email'                  => $this->input->post('email'),
            'aadhar_number'          => $this->input->post('aadhar_number'),
            'aadhar_front'          => $aadhar_front,
            'aadhar_back'           => $aadhar_back,
            'salon_photo'            => $salon_photo,
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_salon',$new_arr);
            $last_id = $this->db->insert_id();
            $this->session->set_flashdata('success','Record added successfully');
            redirect('add-branch/'.$last_id);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_salon',$data);
            $this->session->set_flashdata('success','Success ! Record updated successfully');
            redirect('add-salon');
        }
    }
    public function get_all_salon(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon');
        return $result->result();
    } 
    public function get_single_salon(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_salon');
        return $result->row();
    } 
    public function get_unique_salon_email_ajax(){
        $email = $this->input->post('email');
        $this->db->where('is_deleted', '0');
        $this->db->where('email', $email);
        $result = $this->db->get('tbl_salon')->row(); 
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo 0;
        }
    } 
    public function get_salon_type($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_salon_type');
        return $result->row();
    } 
    public function set_branch($shopact){
        $data = array(
        'salon_id'             	=> $this->input->post('salon_id'),        
        'branch_name'      		=> $this->input->post('branch_name'),        
        'salon_number' 			=> $this->input->post('salon_number'),
        'email' 				=> $this->input->post('email'),
        'password'              => $this->input->post('password'),
        'salon_address' 		=> $this->input->post('salon_address'),
        'state' 				=> $this->input->post('state'),
        'city' 					=> $this->input->post('city'),
        'pincode' 				=> $this->input->post('pincode'),
        'category' 				=> $this->input->post('category'),
        'account_holder_name' 	=> $this->input->post('account_holder_name'),
        'account_number' 		=> $this->input->post('account_number'),
        'account_type' 			=> $this->input->post('account_type'),
        'bank_branch_name' 		=> $this->input->post('bank_branch_name'),
        'bank_name' 			=> $this->input->post('bank_name'),
        'ifsc' 					=> $this->input->post('ifsc'),
        'salon_type' 			=> explode('@@@',$this->input->post('salon_type'))[0],
        'salon_type_rules_id'	=> explode('@@@',$this->input->post('salon_type'))[1],
        'shopact' 				=> $shopact,
        ); 
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_branch',$new_arr);
            $this->db->insert('tbl_store_profile',$new_arr); 
            $this->session->set_flashdata('success','Record added successfully');
            redirect('add-branch/'.$this->input->post('salon_id'));
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_branch',$data);
            $this->session->set_flashdata('success','Success ! Record updated successfully');
            redirect('add-branch/'.$this->input->post('salon_id'));
        }
    } 
    public function get_all_branch_list() {
        $this->db->select('tbl_branch.*, tbl_salon.salon_name');
        $this->db->where('salon_id',$this->uri->segment(2)); 
        $this->db->join('tbl_salon', ' tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->order_by('tbl_branch.id', 'DESC'); 
        $result = $this->db->get('tbl_branch'); 
        return $result->result();
    }
    public function get_all_branch_for_customer() {
        $this->db->select('tbl_branch.*, tbl_salon.salon_name');
        $this->db->join('tbl_salon', ' tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->order_by('tbl_branch.id', 'DESC'); 
        $result = $this->db->get('tbl_branch'); 
        return $result->result();
    } 
    public function get_single_branch(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(3));
        $result = $this->db->get('tbl_branch');
        return $result->row();
    }
    public function get_salon_name(){
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_salon');
        return $result->result();
    } 
    public function get_single_salon_name(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_salon');
        return $result->row();
    } 
	public function get_single_salon_name_by_branch(){
		$this->db->select('tbl_salon.salon_name');
		$this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.id',$this->uri->segment(2));
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch.salon_id');
        $result = $this->db->get('tbl_branch');
        return $result->row();
	}
    public function get_unique_branch_email_ajax(){
        $email = $this->input->post('email');
        $this->db->where('is_deleted', '0');
        $this->db->where('email', $email);
        $result = $this->db->get('tbl_branch')->row(); 
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo 0;
        }
    } 
    public function branch_gallary($gallary_image){
        $branch_id=$this->uri->segment(2);
		$exp = explode(",",$gallary_image);
		$data = array();
		for($i=0;$i<count($exp);$i++){
			$data[] = array(
				'category'               => $this->input->post('category'), 
				'gallary_image'          => $exp[$i],
				'branch_id'              => $branch_id,
                'created_on'    		=> date("Y-m-d H:i:s")
			); 
		}
		if(!empty($data)){
			$this->db->insert_batch('tbl_branch_gallary',$data);
		}
		return true;
    } 
	public function delete_branch_images(){
		if(file_exists('admin_assets/images/gallary_image/'.$this->uri->segment(3))){
			unlink('admin_assets/images/gallary_image/'.$this->uri->segment(3));
		}
		$this->db->where('id',$this->uri->segment(2));
		$this->db->delete('tbl_branch_gallary');
	}
    public function get_all_gallary(){
        $this->db->select('tbl_branch_gallary.*,tbl_category_type.category_type ,tbl_category_type.id as category_id');
        $this->db->join('tbl_category_type','tbl_category_type.id=tbl_branch_gallary.category');
        $this->db->where('tbl_branch_gallary.is_deleted','0');
        $this->db->order_by('category','DESC');
        $result = $this->db->get('tbl_branch_gallary');
        return $result->result();
    } 
    public function get_single_gallary(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_branch_gallary');
        return $result->row();
    }
    public function set_upload_branch_gallary_img() {
        $config = array();
        $config ['upload_path'] = 'admin_assets/images/gallary_image/';
        $config ['allowed_types'] = '*';
        $config ['encrypt_name'] = true;
        return $config;
    }  
    public function get_gallary_category(){
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_category_type');
        return $result->result();
    }  
    public function set_employee($aadhar_front,$aadhar_back,$profile_photo,$pan_file){
        $data=array(
            'full_name'             => $this->input->post('full_name'),
            'phone'                 => $this->input->post('phone'),
            'family_phone'          => $this->input->post('family_phone'),
            'email'                 => $this->input->post('email'),
            'password'              => $this->input->post('password'),
            'desiganation'          => $this->input->post('desiganation'),
            'address'               => $this->input->post('address'),
            'date_of_birth'         => $this->input->post('date_of_birth'),
            'pan'                   => $this->input->post('pan'),
            'aadhar_number'         => $this->input->post('aadhar_number'),
            'education'         	=> $this->input->post('education'),
            'college_name'          => $this->input->post('college_name'),
            'passing_year'          => $this->input->post('passing_year'),
            'percentage'            => $this->input->post('percentage'),
            'salary'            	=> $this->input->post('salary'),
            'aadhar_front'          => $aadhar_front,
            'aadhar_back'           => $aadhar_back,
            'profile_photo'         => $profile_photo,
            'pan_file'              => $pan_file,
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_employee',$new_arr);
            $last_id = $this->db->insert_id();
            $this->session->set_flashdata('success','Record added successfully');
            redirect('add-employee/'.$last_id);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_employee',$data);
            $this->session->set_flashdata('success','Success ! Record updated successfully');
            redirect('add-employee');
        }
    }
    public function get_all_employee(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_employee');
        return $result->result();
    } 
    public function get_single_employee(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_employee');
        return $result->row();
    }
    public function get_unique_employee(){ 
        $this->db->where('salon',$this->input->post('salon'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_salon');
        echo $result->num_rows();
    } 
    public function add_subscription(){
        $data=array(
            'subscription_name' => $this->input->post('subscription_name'), 
            'pincode' 			=> $this->input->post('pincode'), 
            'category' 			=> $this->input->post('category'), 
            'stylist' 			=> $this->input->post('stylist'), 
            'amount' 			=> $this->input->post('amount'), 
            'installment' 		=> $this->input->post('installment'), 
            'percent_amount' 	=> $this->input->post('percent_amount'), 
            'duration' 			=> $this->input->post('duration'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_subscription_master',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_subscription_master',$data);
            return 1;
        }
    } 
    public function get_all_subscription(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_subscription_master');
        return $result->result();
    } 
    public function get_single_subscription(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_subscription_master');
        return $result->row();
    }
    public function get_unique_subscription_name(){ 
        $this->db->where('subscription_name',$this->input->post('subscription_name'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_master');
        echo $result->num_rows();
    } 
    public function add_facility(){
        $data=array(
            'facility_name' => $this->input->post('facility_name'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_facility_master',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_facility_master',$data);
            return 1;
        }
    } 
    public function get_all_facility(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_facility_master');
        return $result->result();
    } 
    public function get_single_facility(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_facility_master');
        return $result->row();
    }
    public function get_unique_facility_name(){ 
        $this->db->where('facility_name',$this->input->post('facility_name'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_facility_master');
        echo $result->num_rows();
    }  
    public function add_tips($tips_photo){
        $data=array(
            'tips' 			=> $this->input->post('tips'), 
            'description' 	=> $this->input->post('description'),
            'tips_photo'    => $tips_photo, 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_tips_master',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_tips_master',$data);
            return 1;
        }
    } 
    public function get_all_tips(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_tips_master');
        return $result->result();
    } 
    public function get_single_tips(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_tips_master');
        return $result->row();
    }
    public function get_unique_tips_name(){ 
        $this->db->where('tips',$this->input->post('tips'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_tips_master');
        echo $result->num_rows();
    } 
    public function add_sup_category($category_image){
        $data=array(
            'sup_category' 			=> $this->input->post('sup_category'),
            'sup_category_marathi' 	=> $this->input->post('sup_category_marathi'),
            'category_image'        => $category_image,
            'admin_id' 				=> $this->session->userdata('admin_id'),
            'default_status' 		=> $this->input->post('default_status'),
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_admin_service_category',$new_arr);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_admin_service_category',$data);
        } 
    } 
    public function get_all_services_name(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','ASC');
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    } 
    public function get_single_services_name(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_admin_service_category');
        return $result->row();
    }
    public function get_unique_services_name(){ 
        $this->db->where('services_name',$this->input->post('services_name'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_admin_service_category');
        echo $result->num_rows();
    } 
    public function add_expense_category(){
          $data = array(
             'expenses_name' 	=> $this->input->post('expenses_name'), 
          );
          if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_expenses_category', $new_arr);
			return 0;
        }else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_expenses_category', $data);
			return 1;
        }
    } 
    public function get_all_expense_category(){
		$this->db->where('is_deleted', '0');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_expenses_category');
		return $result->result();
    } 
	
    public function get_single_expense_category(){
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_expenses_category');
		return $result->row();
	}
    public function get_unique_expenses_name(){
		$this->db->where('expenses_name', $this->input->post('expenses_name'));
		if ($this->input->post('id') != "0") {
		  $this->db->where('id !=', $this->input->post('id'));
		}
		$this->db->where('is_deleted', '0'); 
		$result = $this->db->get('tbl_expenses_category');
		echo $result->num_rows();
    }  
	public function add_sub_category(){
        $data=array(
            'sub_category' => $this->input->post('sub_category'),
            'sup_category' => $this->input->post('sup_category'),
            'sub_category_marathi' => $this->input->post('sub_category_marathi'),
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_admin_sub_category',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_admin_sub_category',$data);
            return 1;
        }
    } 
    public function get_all_sub_category_list() {
        $this->db->select('tbl_admin_sub_category.*, tbl_admin_service_category.sup_category');
        $this->db->from('tbl_admin_sub_category');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_sub_category.sup_category= tbl_admin_service_category.id', 'left'); 
    
        $this->db->where('tbl_admin_sub_category.is_deleted', '0');
        // $this->db->where('sc.admin_id', $this->session->userdata('admin_id'));
    
        $result = $this->db->get();
        return $result->result();
    }
    
    public function get_single_sub_category(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_admin_sub_category');
        return $result->row();
    }

   
    public function get_services_name(){
        $this->db->where('is_deleted','0');
        // $this->db->where('admin_id',$this->session->userdata('admin_id'));
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    }

    public function pending_salon_service(){
        $data = array(
            'reject_reason' => $this->input->post('reject_reason'),
            'is_deleted' => '1',
        );
        
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_emp_service',$data); 
            return 1; 
    }
    


// for Add service



public function add_admin_service($category_image){
        $data=array(
            'salon_id'                  => '0',
            'branch_id'                 => '0',
            'category'                  => $this->input->post('category'),
            'sub_category'              => $this->input->post('sub_category'),
            'service_name'              => $this->input->post('service_name'),
            'service_description'       => $this->input->post('service_description'),
            'short_description'         => $this->input->post('short_description'),
            'service_duration'          => $this->input->post('service_duration'),
            'final_price'               => $this->input->post('final_price'),
            'service_name_marathi'      => $this->input->post('service_name_marathi'),
            'category_image'            => $category_image,
            'min'                       => $this->input->post('min'),
            'max'                       => $this->input->post('max'),
            'service_discount'          => $this->input->post('service_discount'),
            'discount_in'               => $this->input->post('discount_in'),
            'discount_type'             => $this->input->post('discount_type'),
            'reward_point'              => $this->input->post('reward_point'),
            'reminder_duration'         => $this->input->post('reminder_duration'),
            'default_status'            => $this->input->post('default_status'), 
        ); 
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date); 
            $this->db->insert('tbl_admin_services',$new_arr); 
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_admin_services',$data);
            return 1;
        }
    }
	public function get_selected_sub_category($category){
		$this->db->where('sup_category',$category);
		$this->db->where('is_deleted','0'); 
		$result = $this->db->get('tbl_admin_sub_category');
		return $result->result();
	}
    public function get_all_service_list(){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_all_service_list_active(){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.status', '1');
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }
    
    public function get_single_service(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_admin_services');
        return $result->row();
    }


    public function get_sub_category_by_category()
    {
        $sup_category = $this->input->post('sup_category');
        $this->db->where('is_deleted', '0');
        $this->db->where('sup_category', $sup_category);
        $result = $this->db->get('tbl_admin_sub_category')->result();
    
        if ($result !== FALSE) {
            echo json_encode($result);
        } 
    }
    

    public function get_third_category(){
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_admin_sub_category');
        return $result->result();
    }

    public function get_all_disaprove_services()
    {
        $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->where('tbl_salon_emp_service.status', '0');
       
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');
        $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
    
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result();
    }

    public function add_booking_status()
{
    $data = array(
        'status_name' => $this->input->post('status_name'),
    );
    // echo "<pre>";print_r($data);exit;
    if ($this->input->post('id') == "") {
        $date = array(
            'created_on'    => date("Y-m-d H:i:s")
        );
        $new_arr = array_merge($data, $date);
        $this->db->insert('tbl_admin_bokking_status_color', $new_arr);
        return 0;
    } else {
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_admin_bokking_status_color', $data);
        return 1;
    }
}


public function get_all_status_color()
{
    $this->db->where('is_deleted', '0');
    $this->db->order_by('id', 'DESC');
    $result = $this->db->get('tbl_admin_bokking_status_color');
    return $result->result();
}


public function get_single_status_color()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_admin_bokking_status_color');
        return $result->row();
    }



    

    // for customer care managment

    public function add_customer_care($document){
        $data=array(
            'company_name' => $this->input->post('company_name'),
            'whatsapp_number' => $this->input->post('whatsapp_number'),
            'description' => $this->input->post('description'),
            'email' => $this->input->post('email'),
            'address'              => $this->input->post('address'),
            'identity'          => $this->input->post('identity'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'account_number' => $this->input->post('account_number'),
            'account_type' => $this->input->post('account_type'),
            'bank_branch_name' => $this->input->post('bank_branch_name'),
            'ifsc' => $this->input->post('ifsc'),
            'document' => $document,
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );

            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_customer_care',$new_arr);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_customer_care',$data);
        }

    }

    public function get_all_customer_care(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_customer_care');
        return $result->result();
    }

    public function get_single_customer_care(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_customer_care');
        return $result->row();
    }
    

    // for customer care Report

    public function customer_care_report($audio_file){
        $salon_id=$this->uri->segment(2);
        $branch_id=$this->uri->segment(3);
        $data=array(
            'customer_name'          => $this->input->post('customer_name'),
            'phone'                  => $this->input->post('phone'),
            'emp_name'               => $this->input->post('emp_name'),
            'last_date'               => $this->input->post('last_date'),
            'remark'                  => $this->input->post('remark'),
            'audio_file'              => $audio_file,
            'branch_id'              => $branch_id,
            'salon_id'              => $salon_id,
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );

            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_customer_care_report',$new_arr);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_customer_care_report',$data);
        }

    }

    public function get_all_customer_care_report(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_customer_care_report');
        return $result->result();
    }

    public function get_single_customer_care_report(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_customer_care_report');
        return $result->row();
    }
    public function get_all_active_staff(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_employee');
		$result = $result->result();
		return $result;
	}
    public function get_all_calling_history(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		// $this->db->where('branch_id',$this->session->userdata('branch_id'));
		$result = $this->db->get('tbl_customer_care_report');
		$result = $result->result();
		return $result;
	}


    // for staff_attendance



    public function add_admin_attendance(){
		$staff = $this->input->post('staff_id');
		for($i=0;$i<count($staff);$i++){
			$this->db->where('id',$staff[$i]);
			$result = $this->db->get(' tbl_employee');
			$result_staff = $result->row();
			if(!empty($result_staff)){
				if($this->input->post('attendence_'.$staff[$i]) != ''){
					$emp_att = $this->get_employee_attendance_type($staff[$i],$this->input->post('attendance_date'));
					if(!empty($emp_att)){
						if($emp_att->attendence_type != $this->input->post('attendence_'.$staff[$i])){
							$data = array(
								'emp_id' 			=> $staff[$i],
								'attendence_type' 	=> $this->input->post('attendence_'.$staff[$i]),
								'att_date' 			=> date("Y-m-d",strtotime($this->input->post('attendance_date'))),
							);
							$this->db->where('id',$emp_att->id);
							$this->db->update('tbl_admin_emp_attendance',$data);
						}
					}else{
						$data = array(
							'emp_id' 			=> $staff[$i],
							'attendence_type' 	=> $this->input->post('attendence_'.$staff[$i]),
							'att_date' 			=> date("Y-m-d",strtotime($this->input->post('attendance_date'))),
							'created_on' 		=> date('Y-m-d H:i:s'),
						);
						$this->db->insert('tbl_admin_emp_attendance',$data);
					}

					
				}
			}
		}
		return true;
	}
	public function get_employee_attendance_type($staff_id,$attendance_date){
		$this->db->where('att_date',date("Y-m-d",strtotime($attendance_date)));
		$this->db->where('is_deleted','0');
		$this->db->where('emp_id',$staff_id);
		$result = $this->db->get('tbl_admin_emp_attendance');
		return $result->row();
	}
	public function get_attendance_emp_details(){
		$this->db->where('id',$this->input->post('employee_id'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get(' tbl_employee');
		echo json_encode($result->row());
	}
	public function get_today_attendance($id){
		$this->db->where('emp_id',$id);
		$this->db->where('att_date',date('Y-m-d'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_admin_emp_attendance');
		return $result->num_rows();
	}
	public function get_today_present_staff(){
		$this->db->select('tbl_admin_emp_attendance.*,  tbl_employee.full_name,  tbl_employee.email,  tbl_employee.phone');
		$this->db->where('tbl_admin_emp_attendance.att_date',date('Y-m-d'));
		$this->db->where('tbl_admin_emp_attendance.is_deleted','0');
		$this->db->join('tbl_employee',' tbl_employee.id = tbl_admin_emp_attendance.emp_id');
		$result = $this->db->get('tbl_admin_emp_attendance');
		return $result->result();
	}
    public function get_today_staff_attendence($employee_id){
		$this->db->where('att_date',date('Y-m-d'));
		$this->db->where('is_deleted','0');
		$this->db->where('emp_id',$employee_id);
		$result = $this->db->get('tbl_admin_emp_attendance');
		return $result->row();
	}


    // For sallary Slip


    public function set_salary_slip(){
		
		if($this->input->post('loan_deduct') == 'Yes'){
			$deduct_amt = $this->input->post('deduct_amt');
		}else if($this->input->post('loan_deduct') == 'No'){
			$deduct_amt = '0';
		}else{
			$deduct_amt = '0';
		}
		
		$this->db->where('id',$this->input->post('staff'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_employee');
		$result = $result->row();
		$basic_pay = 0;
		$paid_amt = 0;
		if(!empty($result)){
			$basic_pay = $result->salary;
			$per_day_amt = $result->salary/30;
			$total_full_days_amt = $per_day_amt*$this->input->post('present_days');
			$total_half_days_amt = ($per_day_amt/2)*$this->input->post('half_days');
			$paid_amt = $total_full_days_amt+$total_half_days_amt-$deduct_amt;
		}
		$data = array(
			'emp_id' 			=> $this->input->post('staff'),
            'salaried_month' 	=> $this->input->post('salaried_month'),
			'salaried_year' 	=> $this->input->post('salaried_year'),
			'from_date' 		=> date("Y-m-d",strtotime($this->input->post('from_date'))),
			'to_date' 			=> date("Y-m-d",strtotime($this->input->post('to_date'))),
			'half_days' 		=> $this->input->post('half_days'),
			'absent_days' 		=> $this->input->post('absent_days'),
			'payed_date' 		=> date("Y-m-d",strtotime($this->input->post('payed_date'))),
			'remark' 			=> $this->input->post('remark'),
			'basic_pay' 		=> $basic_pay,
			'paid_amt' 			=> $paid_amt,
			'present_days' 		=> $this->input->post('present_days'),
			'loan_deduction_amount' => $deduct_amt,
			'created_on' 	=> date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_admin_emp_salary_slip',$data);
		$salary_slip_id = $this->db->insert_id();
		
		if($this->input->post('loan_deduct') == 'Yes'){
			$loan = array(
				"staff_id"			=> $this->input->post('staff'),
				"loan_amount"		=> '0',
				"return_amount"		=> $deduct_amt,
				"date"				=> date("Y-m-d"),
				"remark"			=> 'Deducted from salary.',
			);
			$this->db->insert('tbl_staff_account',$loan);
		}

		$templateid = "1707169641514078983";
		$message = 'Dear '.$result->full_name.',%0a%0aWe are pleased to inform you that your salary '.date("Y-m-d",strtotime($this->input->post('from_date'))).' to '.date("Y-m-d",strtotime($this->input->post('to_date'))).'has been successfully generated and amounts to '.$paid_amt.'%0a%0aIt is now ready for disbursement.%0a%0aRegards,%0aSaurabh Travels';
		$whatsapp_number = $result->whatsapp_number;
		
		// $this->send_sms_sautra($templateid,$message,$whatsapp_number);
		
		$sms = array(
			'sms_type'			=> 'Staff Salary Generation SMS',
			'sms_sent_to'		=> '2',
			'sms_receiver_id'	=> $result->id,
			// 'whatsapp_number'		=> $whatsapp_number,
			'sms'				=> $message,
			'created_on' 		=> date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_sms_send_log',$sms);
		
		$staff_sms = array(
			'sms_type'		=> 'Staff Salary Generation SMS',
			'staff_id'		=> $result->id,
			'created_on' 	=> date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_staff_sms_send_log',$staff_sms);
		
		return $salary_slip_id;
	}
    public function get_field_executive_attendance_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('MONTH(att_date)',$this->input->post('salary_month'));
		$this->db->where('YEAR(att_date)',$this->input->post('salary_year'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_salon_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
	public function get_employee_present_days_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where('attendence_type','1');
		$result = $this->db->get('tbl_salon_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
	public function get_employee_half_days_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where('attendence_type','3');
		$result = $this->db->get('tbl_salon_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
	public function get_employee_absent_days_ajx(){
		$att_type = [1,3];
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where_in('attendence_type',$att_type);
		$result = $this->db->get('tbl_salon_emp_attendance');
		$result = $result->num_rows();
		
		$datetime1 = new DateTime(date("Y-m-d",strtotime($this->input->post('from_date'))));
		$datetime2 = new DateTime(date("Y-m-d",strtotime($this->input->post('to_date'))));

		$interval = $datetime1->diff($datetime2);
		
		$total_months_days = $interval->days;
		$absent_days = $total_months_days-$result;
		echo $absent_days;
	}
    public function get_employee_total_loan_ajx(){
		$this->db->where('staff_id',$this->input->post('staff_id'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_staff_account');
		$result = $result->result();
		$total_balance = 0;
		if(!empty($result)){
			$total_loan_amt = 0;
			$total_return_amt = 0;
			foreach($result as $result_amount){
				$total_loan_amt+=$result_amount->loan_amount;
				$total_return_amt+=$result_amount->return_amount;
			}
			$total_balance = $total_loan_amt-$total_return_amt;
		}
		echo $total_balance; 
	}
	
	public function get_already_generated_field_exe_slip_ajx(){
		$this->db->where('is_deleted','0');
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('from_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('to_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$result = $this->db->get('tbl_admin_emp_salary_slip');
		$result = $result->num_rows();
		echo json_encode($result);
	}
	
	public function get_all_staff_salary_slip($length,$start,$search){
		$this->db->select('tbl_admin_emp_salary_slip.*,  tbl_employee.full_name');
		$this->db->where('tbl_admin_emp_salary_slip.is_deleted','0');
		if($this->input->post('staff') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.emp_id',$this->input->post('staff'));
		}
		if($this->input->post('from_date') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.from_date',date("Y-m-d",strtotime($this->input->post('from_date'))));
		}
		if($this->input->post('to_date') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.to_date',date("Y-m-d",strtotime($this->input->post('to_date'))));
		}
		if($search !=""){
			$this->db->group_start();
			$this->db->or_like(' tbl_employee.full_name',$search);
			$this->db->or_like('tbl_admin_emp_salary_slip.salaried_month',$search);
			$this->db->or_like('tbl_admin_emp_salary_slip.salaried_year',$search);
			$this->db->group_end();
		}
		$this->db->join(' tbl_employee',' tbl_employee.id = tbl_admin_emp_salary_slip.emp_id');
		$this->db->order_by('tbl_admin_emp_salary_slip.id','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_admin_emp_salary_slip');
		return $result->result();		
	}
	public function get_all_staff_salary_slip_count($search){
		$this->db->select('tbl_admin_emp_salary_slip.*,  tbl_employee.full_name');
		$this->db->where('tbl_admin_emp_salary_slip.is_deleted','0');
		if($this->input->post('staff') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.emp_id',$this->input->post('staff'));
		}
		if($this->input->post('from_date') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.from_date',date("Y-m-d",strtotime($this->input->post('from_date'))));
		}
		if($this->input->post('to_date') != ""){
			$this->db->where('tbl_admin_emp_salary_slip.to_date',date("Y-m-d",strtotime($this->input->post('to_date'))));
		}
		if($search !=""){
			$this->db->group_start();
			$this->db->or_like(' tbl_employee.full_name',$search);
			$this->db->or_like('tbl_admin_emp_salary_slip.salaried_month',$search);
			$this->db->or_like('tbl_admin_emp_salary_slip.salaried_year',$search);
			$this->db->group_end();
		}
		$this->db->join(' tbl_employee',' tbl_employee.id = tbl_admin_emp_salary_slip.emp_id');
		$this->db->order_by('tbl_admin_emp_salary_slip.id','DESC');
		$result = $this->db->get('tbl_admin_emp_salary_slip');
		return $result->num_rows();
	}
	
	
	public function get_attendance($day,$month,$year,$student_id){
		$day = $day;
		$this->db->where('student_id',$student_id);
		$this->db->where('Year(att_date)',$year);
		$this->db->where('Month(att_date)',$month);
		$this->db->where('Day(att_date)',$day);
		$this->db->where('attendence_type','1');
		$result = $this->db->get('tbl_student_attendance');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return 0;
		}
	}

    

    public function get_salary_slip_details(){
		$this->db->select('tbl_admin_emp_salary_slip.*,  tbl_employee.full_name,  tbl_employee.phone,  tbl_employee.email,  tbl_employee.date_of_birth');
		$this->db->where('tbl_admin_emp_salary_slip.id',$this->uri->segment(2));
		$this->db->where('tbl_admin_emp_salary_slip.is_deleted','0');
		$this->db->join(' tbl_employee',' tbl_employee.id = tbl_admin_emp_salary_slip.emp_id');
		$result = $this->db->get('tbl_admin_emp_salary_slip');
		return $result->row();
	}
	public function get_single_student1(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_student');
		$result = $result->row(); 
		return $result;
	}


     // For CRM

     public function add_lead($bulk_upload){
        $this->db->insert_batch('tbl_lead_branch',$bulk_upload);
        return true;
    }
    public function get_all_lead(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_lead_branch');
        return $result->result();
    }
    public function get_single_lead_info(){
        $id=$this->uri->segment(2);
        $this->db->where('is_deleted','0');
        $this->db->where('id', $id);
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_lead_branch');
        // echo "<pre>";print_r($result);exit;
        return $result->result();
    }

    public function add_crm_status_activity(){
        $lead_id=$this->input->post("lead_id");
        $lead_type=$this->input->post("lead_type");
        $customer_id=$this->input->post("customer_id");
        $tbl_push_crm_lead_id=$this->input->post("tbl_push_crm_lead_id");
          $this->db->where('is_deleted','0');
          $this->db->where('status','1');
          $this->db->where('id',$tbl_push_crm_lead_id);
          $this->db->where('lead_id',$lead_id);
          $this->db->where('lead_type',$lead_type);
          $this->db->where('customer_id',$customer_id);
          $res=$this->db->get('tbl_push_crm_lead')->row();
          $reminder_date='';
          if($this->input->post("reminder") !=''){
              $reminder_date=$this->input->post("reminder"); 
          }
          if(!empty($res)){
             $data=array(
                 'activity_status'  =>$this->input->post("status"),
                 'add_reminder'     =>$reminder_date,
                 'updated_on'      =>date('Y-m-d H:i:s'),
             );
             $this->db->where('id',$tbl_push_crm_lead_id);
             $this->db->update('tbl_push_crm_lead',$data);
         }
         $reminder_date='';
         if($this->input->post("reminder") !=''){
             $reminder_date=$this->input->post("reminder"); 
         }
         $data2=array(
         'customer_id'     =>$customer_id,
         'tbl_push_crm_id' =>$tbl_push_crm_lead_id,
         'action_status'   =>$this->input->post("status"),
         'remark'          =>$this->input->post("remark"),
         'add_reminder'    =>$reminder_date,
         'lead_type'       =>$this->input->post("lead_type"),
         'lead_id'         =>$this->input->post("lead_id"),
         'created_on'      =>date('Y-m-d H:i:s'),
         );
         $this->db->insert('tbl_crm_activity',$data2);
         return 1;
     }

     public function get_all_status_name(){
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_status_master');
        return $result->result();
    }

    //  For Crm Status Master

    public function customer_crm(){
        // $id=$this->input->post("id");
        $lead_id=$this->input->post("lead_id");
          $this->db->where('is_deleted','0');
          $this->db->where('status','1');
          $this->db->where('id',$lead_id);
          $res=$this->db->get('tbl_lead_branch')->row();
          $reminder_date='';
          if($this->input->post("reminder") !=''){
              $reminder_date=$this->input->post("reminder"); 
          }
          if(!empty($res)){
             $data=array(
                 'status_of_salon'  =>$this->input->post("status"),
                 'add_reminder'     =>$reminder_date,
                 'updated_on'      =>date('Y-m-d H:i:s'),
             );
             $this->db->where('id',$lead_id);
             $this->db->update('tbl_lead_branch',$data);
         }
         $reminder_date='';
         if($this->input->post("reminder") !=''){
             $reminder_date=$this->input->post("reminder"); 
         }
         $data2=array(
         'lead_id' =>$lead_id,
         'action_status'   =>$this->input->post("status"),
         'remark'          =>$this->input->post("remark"),
         'add_reminder'    =>$reminder_date,
         'created_on'      =>date('Y-m-d H:i:s'),
         );
         $this->db->insert('tbl_crm_activity',$data2);
         return 1;
     }
    public function crm_status_master(){
        $data=array(
            'status_name' => $this->input->post('status_name'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_status_master',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_status_master',$data);
            return 1;
        }
    }

    public function get_all_status(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_status_master');
        return $result->result();
    }

    public function get_single_status(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_status_master');
        return $result->row();
    }
    public function get_unique_status_name(){ 
        $this->db->where('status_name',$this->input->post('status_name'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_status_master');
        echo $result->num_rows();
    }
    public function get_active_admin_services(){ 
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_admin_services');
        return $result->result();
    }
	public function add_membership(){
        $data = array( 
			'membership_name' 	=> $this->input->post('membership_name'),
			'gender' 			=> $this->input->post('gender'),
			'regular_price' 	=> $this->input->post('regular_price'),
			'service_discount' 	=> $this->input->post('service_discount'),
			'product_discount' 	=> $this->input->post('product_discount'),
			'discount_in' 		=> $this->input->post('discount_in'),
			'membership_price' 	=> $this->input->post('membership_price'),
			'description' 		=> $this->input->post('description'),
			'duration' 			=> $this->input->post('duration'),
			'duration_end' 		=> $this->input->post('duration_end'),
			'bg_color_input' 	=> $this->input->post('bg_color_input'),
			'bg_color' 			=> $this->input->post('bg_color'),
			'text_color_input' 	=> $this->input->post('text_color_input'),
			'text_color' 		=> $this->input->post('text_color'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                 'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_memebership', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_memebership', $data);
            return 1;
        }
    }
    public function get_single_membership(){
		$this->db->where('is_deleted','0'); 
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_memebership');
		return $result->row();
	}
    public function get_all_membership(){
		$this->db->where('is_deleted','0'); 
		$result = $this->db->get('tbl_admin_memebership');
		return $result->result();
	}
	public function get_all_coupon_code(){
        $this->db->where('is_deleted', '0'); 
        $result = $this->db->get('tbl_admin_coupon_code');
        return $result->result();
    }
	public function get_single_coupon_code(){
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_admin_coupon_code');
        return $result->row();
    }
    public function get_unique_coupan_code(){
        $this->db->where('coupan_code', $this->input->post('coupan_code'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_admin_coupon_code');
        echo $result->num_rows();
    }
	public function set_coupon_code(){
        $data = array(
            'coupon_name' 	=> $this->input->post('coupon_name'),
            'coupan_code' 	=> $this->input->post('coupan_code'),
            'coupan_expiry' => $this->input->post('coupan_expiry'),
            'coupon_offers' => $this->input->post('coupon_offers'),
            'min_price' 	=> $this->input->post('min_price'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_coupon_code', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_coupon_code', $data);
            return 1;
        }
    }
	public function get_all_reward_point(){
        $this->db->where('is_deleted', '0'); 
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_admin_reward_point');
        return $result->result();
    } 
    public function get_single_reward_point(){
        $this->db->where('is_deleted', '0'); 
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_admin_reward_point');
        return $result->row();
    }
	public function add_reward_point(){
        $data = array( 
            'rs_per_reward' 				=> $this->input->post('rs_per_reward'),
            'reward_point' 					=> $this->input->post('reward_point'),
            'gender' 						=> $this->input->post('gender'),
            'minimum_reward_required' 		=> $this->input->post('minimum_reward_required'),
            'maximum_reward_required' 		=> $this->input->post('maximum_reward_required'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_reward_point', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_reward_point', $data);
            return 1;
        }
    } 
	public function set_booking_status(){
		$data = array(
			'status_name' => $this->input->post('status_name'),
			'status_color' => $this->input->post('status_color'),
			'text_color' => $this->input->post('text_color'),
		); 
		if ($this->input->post('id') == "") {
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_admin_bokking_status_color', $new_arr);
			return 0;
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_admin_bokking_status_color', $data);
			return 1;
		}
	}
	public function get_all_booking_status(){
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_admin_bokking_status_color');
		return $result->result();
	}
	public function get_single_status_color_data(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_bokking_status_color');
		return $result->row();
	}
	public function set_offers(){
		$service = $this->input->post('service_name');
		$service_name = "";
		if(!empty($service)){
			for($i=0;$i<count($service);$i++){
				$service_name .= $service[$i].',';
			}
		}
        $data = array(
            'offers_name' 		=> $this->input->post('offers_name'), 
            'discount' 			=> $this->input->post('discount'),
            'gender' 			=> $this->input->post('gender'),
            'service_name' 		=> $service_name,
            'reward_point' 		=> $this->input->post('reward_point'),
            'duration' 			=> $this->input->post('duration'),
            'description' 		=> $this->input->post('description'),
            'discount_in' 		=> $this->input->post('discount_in'),
            'regular_price' 	=> $this->input->post('regular_price'),
            'offer_price' 		=> $this->input->post('offer_price'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_offers', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_offers', $data);
            return 1;
        }
    }
	public function get_all_offer(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_admin_offers');
		return $result->result();
	}
	public function get_single_offers(){
        $this->db->where('is_deleted','0'); 
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_admin_offers');
        return $result->row();
    }
	public function get_selected_product_name_for_offer($product_name){
		$exp = explode(',',$product_name);
		$this->db->where_in('id',$exp);
		$this->db->where('is_deleted','0'); 
		$this->db->where('status','1');
		$result = $this->db->get('tbl_admin_product');
		return $result->result(); 
	}
	public function get_selected_service_name_for_offer($service){
		$exp = explode(",",$service);
        $this->db->where('is_deleted','0'); 
        $this->db->where_in('id',$exp);
        $result = $this->db->get('tbl_admin_services');
        return $result->result();
    }
	public function get_service_price_details_ajax(){   
		$service_name_id = $this->input->post('service_name_id');
		$this->db->select('final_price');
		$this->db->where_in('id', $service_name_id);
		$this->db->where('status', '1'); 
		$result = $this->db->get('tbl_admin_services');
		$result = $result->result();
		if (!empty($result)) {
			echo json_encode($result);
		}
	}
	public function set_giftcard(){
		$service = $this->input->post('service_name');
		$service_name = "";
		if(!empty($service)){
			for($i=0;$i<count($service);$i++){
				$service_name .= $service[$i].',';
			}
		}
        $data = array( 
            'gift_name' 		=> $this->input->post('gift_name'), 
            'gender' 			=> $this->input->post('gender'),
            'service_name' 		=> $service_name,
            'regular_price' 	=> $this->input->post('regular_price'),
            'discount' 			=> $this->input->post('discount'),
            'discount_in' 		=> $this->input->post('discount_in'),
            'gift_price' 		=> $this->input->post('gift_price'),
            'bg_color_input' 	=> $this->input->post('bg_color_input'),
            'bg_color' 			=> $this->input->post('bg_color'),
            'text_color_input' 	=> $this->input->post('text_color_input'),
            'text_color' 		=> $this->input->post('text_color'),
            'gift_card_code' 	=> $this->input->post('gift_card_code'),
        ); 
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_gift_card', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_gift_card', $data);
            return 1;
        }
    }
	public function get_uinique_gift_code_ajax(){ 
        $this->db->where('is_deleted', '0');
        $this->db->where('gift_card_code',$this->input->post('gift_card_code'));
        $this->db->where('id !=',$this->input->post('id'));
        $result = $this->db->get('tbl_admin_gift_card')->row(); 
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo 0;
        }
    }
	public function get_all_gift_card(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->result();
	}
	public function get_single_giftcard(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->row();
	}
	public function set_package(){  
		$service_name = implode(",",$this->input->post('service_name'));
        $data = array( 
            'package_name' 		=> $this->input->post('package_name'),  
            'service_name' 		=> $service_name,  
            'actual_price' 		=> $this->input->post('actual_price'),
            'discount' 			=> $this->input->post('discount'),
            'amount' 			=> $this->input->post('amount'),
            'count_value' 		=> $this->input->post('count_value'),
            'count_type' 		=> $this->input->post('count_type'),
            'reward_point' 		=> $this->input->post('reward_point'),
            'bg_color_input' 	=> $this->input->post('bg_color_input'),
            'bg_color' 			=> $this->input->post('bg_color'),
            'text_color_input' 	=> $this->input->post('text_color_input'),
            'text_color' 		=> $this->input->post('text_color'),
            'discount_in' 		=> $this->input->post('discount_in'),
            'gender' 			=> $this->input->post('gender'),
        ); 
		if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_package', $new_arr);
            return 0;
        } else {
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_admin_package', $data);
            return 1;
        }
    }
	public function get_all_package(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_admin_package');
		return $result->result();
	}
	public function get_single_package(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_package');
		return $result->row();
	}
	public function get_type_of_salon(){
		$this->db->where('is_deleted','0'); 
		$result = $this->db->get('tbl_salon_type');
		return $result->result();
	}
	public function get_type_of_salon_with_rules(){
        $this->db->select('tbl_salon_type.*,tbl_rules_setup.id as rules_id');
        $this->db->join('tbl_rules_setup','tbl_rules_setup.type = tbl_salon_type.id');
		$this->db->where('tbl_salon_type.is_deleted','0'); 
		$this->db->where('tbl_rules_setup.is_deleted','0'); 
		$result = $this->db->get('tbl_salon_type');
		return $result->result();
	}
	public function update_emp_selection_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'employee_selection' 	=> $this->input->post('employee_selection'),  
				'type' 					=> $this->input->post('type_of_rules'),   
				'created_on'   	 		=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'employee_selection' 	=> $this->input->post('employee_selection'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_slot_time_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'slot_time' 	=> $this->input->post('slot_time'),  
				'type' 			=> $this->input->post('type_of_rules'),   
				'created_on'   	=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'slot_time' 	=> $this->input->post('slot_time'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_buffering_time_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'buffering_time' 	=> $this->input->post('buffering_time'),  
				'type' 				=> $this->input->post('type_of_rules'),   
				'created_on'   		=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'buffering_time' 	=> $this->input->post('buffering_time'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_rescheduling_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'booking_rescheduling' 	=> $this->input->post('rescheduling'),  
				'type' 					=> $this->input->post('type_of_rules'),   
				'created_on'   			=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'booking_rescheduling' 	=> $this->input->post('rescheduling'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_cancellation_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'cancellation' 	=> $this->input->post('cancellation'),  
				'type' 			=> $this->input->post('type_of_rules'),   
				'created_on'   	=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'cancellation' 	=> $this->input->post('cancellation'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_reward_cancellation_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'reward_point_cancellation' 				=> $this->input->post('reward_point_cancellation'),  
				'reward_point_cancellation_late_customer' 	=> $this->input->post('reward_point_cancellation_late_customer'),  
				'type' 										=> $this->input->post('type_of_rules'),   
				'created_on'   								=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'reward_point_cancellation' 				=> $this->input->post('reward_point_cancellation'),  
				'reward_point_cancellation_late_customer' 	=> $this->input->post('reward_point_cancellation_late_customer'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_booking_range_minute(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'booking_time_range' 	=> $this->input->post('booking_time_range'),  
				'max_booking_range_day' => $this->input->post('max_booking_range_day'),  
				'type' 					=> $this->input->post('type_of_rules'),   
				'created_on'   			=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'booking_time_range' 	=> $this->input->post('booking_time_range'),  
				'max_booking_range_day' => $this->input->post('max_booking_range_day'),  
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function update_availability_mode_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'availability_mode' 	=> $this->input->post('availability_mode'),     
				'type' 					=> $this->input->post('type_of_rules'),   
				'created_on'   			=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'availability_mode' 	=> $this->input->post('availability_mode'),   
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function get_single_booking_rules(){
		$this->db->where('type',$_GET['type']);
		$result = $this->db->get('tbl_rules_setup');
		return $result->row();
	}
	public function get_all_product_unit(){
		$this->db->where('is_deleted','0'); 
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_admin_product_unit');
		return $result->result();
    }
	public function set_product($product_photo){
        $data = array(
            'product_category' 		=> $this->input->post('product_category'),
            'product_name' 			=> $this->input->post('product_name'), 
            'hsn_code' 				=> $this->input->post('hsn_code'),
            'discount_in' 			=> $this->input->post('discount_in'),
            'discount' 				=> $this->input->post('discount'),
            'incentive' 			=> $this->input->post('incentive'),
            'description' 			=> $this->input->post('description'),
            'product_unit' 			=> $this->input->post('product_unit'),
            'selling_price' 		=> $this->input->post('selling_price'),
            'product_photo' 		=> $product_photo,
        ); 
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_product', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_product', $data);
            return 1;
        }
    }
	public function get_unique_hsn_code(){
        $this->db->where('hsn_code', $this->input->post('hsn_code'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0'); 
        $result = $this->db->get('tbl_admin_product');
        echo $result->num_rows();
    }
	public function get_product_category(){
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_product_category');
		return $result->result();
	}
	public function get_all_product(){
		$this->db->select('tbl_admin_product.*,tbl_product_category.product_category,tbl_admin_product_unit.product_unit as unit_name');
        $this->db->where('tbl_admin_product.is_deleted','0'); 
		$this->db->join('tbl_product_category','tbl_product_category.id = tbl_admin_product.product_category');
		$this->db->join('tbl_admin_product_unit','tbl_admin_product_unit.id = tbl_admin_product.product_unit');
        $result = $this->db->get('tbl_admin_product');
        return $result->result();
    } 
	public function get_single_product(){
		$this->db->where('is_deleted','0'); 
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_product');
		return $result->row();
    }
	public function get_all_product_list_active(){
		$this->db->where('is_deleted','0'); 
		$this->db->where('status','1');  
		$result = $this->db->get('tbl_admin_product');
		return $result->result();
    }
	public function get_service_price_for_package_ajax(){
		$service_name_id = $this->input->post('service_name_id'); 
		$this->db->where_in('tbl_admin_services.id', $service_name_id); 
		$result = $this->db->get('tbl_admin_services')->result(); 
		if(!empty($result)) {
			echo json_encode($result);
		}else{
			echo '[]';
		}
	}
	public function get_all_pending_product(){
		$this->db->select('tbl_product.*,tbl_branch.branch_name,tbl_product_category.product_category,tbl_admin_product_unit.product_unit as unit_name');
		$this->db->where('tbl_product.is_deleted','0');
		$this->db->where('tbl_product.status','0');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_product.branch_id');
		$this->db->join('tbl_product_category','tbl_product_category.id = tbl_product.product_category');
		$this->db->join('tbl_admin_product_unit','tbl_admin_product_unit.id = tbl_product.product_unit');
		$this->db->order_by('tbl_product.id','ASC');
		$result = $this->db->get('tbl_product');
		return $result->result();
	}
	public function set_product_category($product_photo){
        $data = array(
            'product_category' 			=> $this->input->post('product_category'),
            'product_category_marathi' 	=> $this->input->post('product_category_marathi'),  
            'product_photo' 			=> $product_photo,
        ); 
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_product_category', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_product_category', $data);
            return 1;
        }
    }
	public function get_unique_product_category(){ 
        $this->db->where('product_category',$this->input->post('product_category'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_product_category');
        echo $result->num_rows();
    }
	public function get_all_product_category(){ 
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_product_category');
        return $result->result();
    }
	public function get_single_product_category(){ 
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_product_category');
        return $result->row();
    }
}    
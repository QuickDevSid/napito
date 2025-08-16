<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model { 
    public function admin_login(){
        $this->db->where('is_deleted','0');  
        $this->db->where('status','1');        
        $this->db->where('email',$this->input->post('email'));  
        $result = $this->db->get('tbl_employee');
        $result = $result->row();       
        if(!empty($result)){
            if($this->input->post('password') != $result->password){
                return '2';
            }else{
                $session = array(
                    'admin_id'  => $result->id,
                    'user_type' => $result->user_type,
                );
                $this->session->set_userdata($session);
                return '1';     
            }  
        }else{
            return '0';
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
    public function get_city($id){
        $this->db->select('cities.*,states.name as state_name');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('cities.id',$id);
        $result = $this->db->get('cities');
        return $result->row();
    } 
    public function get_all_location(){
        $this->db->select('tbl_location.*,cities.name as city_name,states.name as state_name');
        $this->db->join('cities','cities.id = tbl_location.city_id');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('tbl_location.is_deleted','0');
        $result = $this->db->get('tbl_location');
        return $result->result();
    } 
    public function get_location($id){
        $this->db->select('tbl_location.*,cities.name as city_name,states.name as state_name');
        $this->db->join('cities','cities.id = tbl_location.city_id');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('tbl_location.id',$id);
        $this->db->where('tbl_location.is_deleted','0');
        $result = $this->db->get('tbl_location');
        return $result->row();
    } 
    public function get_city_ajax(){
        $this->db->where('state_id',$this->input->post('state'));
        $result = $this->db->get('cities');
        echo json_encode($result->result());
    } 
    public function get_selected_city_ajax(){
        $this->db->select('cities.*,states.name as state_name');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('cities.name',$this->input->post('term'));
        $this->db->where('states.name',$this->input->post('state_term'));
        $this->db->where('cities.is_deleted','0');
        $this->db->order_by('cities.id','desc');
        $result = $this->db->get('cities');
        echo json_encode($result->row());
    } 
    public function get_state_city_list($id){
        $this->db->select('cities.*,states.name as state_name');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('cities.state_id',$id);
        $result = $this->db->get('cities');
        return $result->result();
    } 
    public function get_city_location($city){
        $this->db->select('tbl_location.*,cities.name as city_name,states.name as state_name');
        $this->db->join('cities','cities.id = tbl_location.city_id');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('tbl_location.city_id',$city);
        $this->db->where('tbl_location.is_deleted','0');
        $result = $this->db->get('tbl_location');
        return $result->result();
    } 
    public function get_city_location_ajax(){
        $this->db->where('city_id',$this->input->post('city_name'));
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_location');
        echo json_encode($result->result());
    } 
    public function get_selected_state_city($state){
        $this->db->where('state_id',$state);
        $result = $this->db->get('cities');
        return $result->result();
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
    public function get_all_salon_close_reason(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->result();
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
    public function inactivate_booking_rule_setup(){
        $data = array(
            'booking_rule_setup_status'         => '0',
            'last_booking_rule_setup_activated' => null
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update('tbl_branch',$data);
        return true;
    } 
    public function activate_booking_rule_setup(){
        $data = array(
            'booking_rule_setup_status'         => '1',
            'last_booking_rule_setup_activated' => date('Y-m-d H:i:s')
        );
        $this->db->where('id',$this->uri->segment(2));
        $this->db->update('tbl_branch',$data);
        return true;
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
        if(isset($_GET['facilities'])){
            $data = array(
                'is_deleted' => '1'
            );
            $this->db->where('primary_table_id',$this->uri->segment(2));
            $this->db->update('tbl_salon_facility_master',$data);
        }

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
    public function set_salon($aadhar_front,$aadhar_back,$salon_photo,$pancard_copy,$shopact){
        $salon_data=array(
            'salon_name'             => $this->input->post('salon_name'),
            'salon_owner_name'       => $this->input->post('salon_owner_name'),
            'salon_owner_number'     => $this->input->post('salon_owner_number'),
            'email'                  => $this->input->post('email'),
            'aadhar_number'          => $this->input->post('aadhar_number'),
            'is_gst_applicable'      => $this->input->post('is_gst_applicable'),
            'gst_no'                 => $this->input->post('is_gst_applicable') == '1' ? $this->input->post('gst_no') : '',
            'aadhar_front'           => $aadhar_front,
            'aadhar_back'            => $aadhar_back,
            'salon_photo'            => $salon_photo,
            'referred_by'            => $this->input->post('referred_by'),
            'pancard_copy'           => $pancard_copy,
            'is_payment_gateway'     => $this->input->post('is_payment_gateway'),
            'is_branch_available'    => $this->input->post('is_branch_available') != "" ? $this->input->post('is_branch_available') : $this->input->post('old_is_branch_available'),
        );
        // echo '<pre>'; print_r($salon_data); exit;
        $payment_options = $this->input->post('payment_options');
        $payment_options_text = null;
        if($payment_options != "" && !empty($payment_options)){
            $payment_options_text = implode(',',$payment_options);
        }

        if($this->input->post('id') == ""){        
            $this->db->where('email',$this->input->post('email'));
            $this->db->where('is_deleted','0');
            $exist = $this->db->get('tbl_salon');
            $exist = $exist->row();
            if(!empty($exist)){
                return 'failed';
            }
              
            if($this->input->post('is_branch_available') == '0'){
                $this->db->where('email',$this->input->post('email'));
                $this->db->where('is_deleted','0');
                $exist = $this->db->get('tbl_branch');
                $exist = $exist->row();
                if(!empty($exist)){
                    return 'failed_branch';
                }
            }

            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($salon_data,$date);
            $this->db->insert('tbl_salon',$new_arr);
            $last_id = $this->db->insert_id();

            if($this->input->post('is_branch_available') == '0'){
                $data = array(
                    'salon_id'             	=> $last_id,        
                    'branch_name'      		=> $this->input->post('salon_name'),   
                    'salon_number' 			=> $this->input->post('salon_owner_number'),
                    'email' 				=> $this->input->post('email'),
                    // 'email' 				=> $this->input->post('branch_email'),
                    'password'              => $this->input->post('password'),
                    'salon_address' 		=> $this->input->post('salon_address'),
                    'state' 				=> $this->input->post('state'),
                    'city' 					=> $this->input->post('city'),
                    'pincode' 				=> $this->input->post('pincode'),
                    'category' 				=> $this->input->post('category'),
                    // 'agree_terms' 			=> $this->input->post('agree_terms') == 'Yes' ? 'Yes' : 'No',
                    'payment_options' 	    => $payment_options_text,
                    'shopact' 				=> $shopact,
                ); 
                $referred_by_data=array( 
                    'referred_by' 			=> $this->input->post('branch_referred_by')   
                );
        
                $subscription_name = '';
                $subscription_price = '';
                $subscription_valid_till = '';
                $date=array( 
                    'created_on'            => date("Y-m-d H:i:s")     
                );
                $new_arr = array_merge($data,$date);
                $referred_by_data = array_merge($new_arr,$referred_by_data);
                $this->db->insert('tbl_branch',$referred_by_data);
                $branch_id = $this->db->insert_id();

                $self_branch_data = array(
                    'self_branch_id'    =>  $branch_id
                );
                $this->db->where('id',$last_id);
                $this->db->update('tbl_salon',$self_branch_data);
    
                $branch_id_array=array( 
                    'branch_id'            => $branch_id    
                );
    
                $year_month = date('ym');
                $formatted_branch_id = str_pad($branch_id, 4, '0', STR_PAD_LEFT);
                $unique_id = $year_month . $formatted_branch_id; 
                $code_data = array(
                    'branch_unique_code'    =>  $unique_id
                );
                $this->db->where('id',$branch_id);
                $this->db->update('tbl_branch',$code_data);
    
                $this->db->where('id',$this->input->post('subscription'));
                $this->db->where('is_deleted','0');
                $subscription = $this->db->get('tbl_subscription_master');
                $subscription = $subscription->row();
                if(!empty($subscription)){
                    $current_date = new DateTime();
                    
                    $subscription_duration_days = $subscription->duration != "" && $subscription->duration != null ? $subscription->duration : '1';
                    $current_date->modify("+$subscription_duration_days days");
                    $subscription_end = $current_date->format("Y-m-d H:i:s");
                    $subscription_start = date("Y-m-d H:i:s");
    
                    $sub_allocation_data = array(
                        'branch_id'                 =>  $branch_id,
                        'salon_id'                  =>  $last_id,
                        'subscription_name'         =>  $subscription->subscription_name, 
                        'subscription_id'  		    =>  $subscription->id, 
                        'subscription_price'        =>  $subscription->amount,
                        'subscription_validity'     =>  $subscription->duration,
                        'subscription_start'        =>  $subscription_start,
                        'subscription_end'          =>  $subscription_end,
                        'added_by'                  =>  $this->session->userdata('admin_id'),
                        'paid_amount'               =>  '0.00',
                        'due_amount'                =>  $subscription->amount,
                        'include_wp'                =>  $subscription->include_wp,
                        'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                        'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                        'created_on'                =>  date("Y-m-d H:i:s")   
                    );
                    $this->db->insert('tbl_branch_subscription_allocation',$sub_allocation_data);
                    $subscription_allocation_id = $this->db->insert_id();
    
                    $sub_data = array(
                        'subscription_id'  		    =>  $subscription->id, 
                        'subscription_price'        =>  $subscription->amount,
                        'subscription_validity'     =>  $subscription->duration,
                        'subscription_start'        =>  date("Y-m-d H:i:s"),
                        'subscription_end'          =>  $subscription_end,
                        'subscription_allocation_id'=>  $subscription_allocation_id,
                        'pending_due_amount'        =>  $subscription->amount,
                        'include_wp'                =>  $subscription->include_wp,
                        'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                        'current_wp_coins_balance'  =>  $subscription->wp_coins_qty
                    );
                    $this->db->where('id',$branch_id);
                    $this->db->update('tbl_branch',$sub_data);
        
                    if(rtrim($subscription->subscription_name) == 'Starter'){
                        $design_array = ['Stylist','Owner'];
                    }elseif(rtrim($subscription->subscription_name) == 'Growth'){
                        $design_array = ['Stylist','Receptionist','Owner'];
                    }elseif(rtrim($subscription->subscription_name) == 'Professional'){
                        $design_array = ['Stylist','Receptionist','Owner','Manager', 'Cleaner'];
                    }else{
                        $design_array = ['Stylist','Owner'];
                    }
    
                    for($i=0;$i<count($design_array);$i++){
                        $design_data = array(
                            'branch_id'     =>  $branch_id,
                            'salon_id'      =>  $last_id,
                            'designation'   =>  $design_array[$i],
                            'created_on'    =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_emp_designation', $design_data);
                    }
    
                    $subscription_name = $subscription->subscription_name;
                    $subscription_price = $subscription->amount;
                    $subscription_valid_till = $subscription_end;

                    $marketing_type = [];
                    $features = $subscription->features != "" ? explode(',',$subscription->features) : [];
                    if(in_array('55',$features)){   // Lost
                        $marketing_type[] = '2';
                    }
                    if(in_array('56',$features)){   // Regular
                        $marketing_type[] = '1';
                    }
                    if(in_array('57',$features)){   // Birthday
                        $marketing_type[] = '3';
                    }
                    if(in_array('58',$features)){   // Anniversary
                        $marketing_type[] = '4';
                    }
                    if(in_array('59',$features)){   // New
                        $marketing_type[] = '0';
                    }
                    if(in_array('60',$features)){
                        $marketing_type[] = '5';
                    }

                    for($i=0;$i<count($marketing_type);$i++){    
                        $for_product = '0';
                        $employee_product_incentive = null;                        
                        if($marketing_type[$i] == '2'){   // Lost
                            $discount_amount = '20';
                            $discount_in = '0';
                            $discount_type = null;
                            $flexible_min = null;
                            $flexible_max = null;
                        }elseif($marketing_type[$i] == '1'){   // Regular
                            $discount_amount = null;
                            $discount_in = '0';
                            $discount_type = '1';
                            $flexible_min = '5';
                            $flexible_max = '15';
                        }elseif($marketing_type[$i] == '3'){   // Birthday
                            $discount_amount = '20';
                            $discount_in = '0';
                            $discount_type = null;
                            $flexible_min = null;
                            $flexible_max = null;
                        }elseif($marketing_type[$i] == '4'){   // Anniversary
                            $discount_amount = '20';
                            $discount_in = '0';
                            $discount_type = null;
                            $flexible_min = null;
                            $flexible_max = null;
                        }elseif($marketing_type[$i] == '0'){   // New
                            $discount_amount = '10';
                            $discount_in = '0';
                            $discount_type = null;
                        }elseif($marketing_type[$i] == '5'){   // New
                            $discount_amount = '5';
                            $discount_in = '0';
                            $discount_type = '0';
                            $for_product = '0';
                            $employee_product_incentive = '5';
                        }else{
                            $discount_amount = '10';
                            $discount_in = '0';
                            $discount_type = null;
                            $flexible_min = null;
                            $flexible_max = null;
                        }

                        $this->db->where('salon_id',$last_id);
                        $this->db->where('branch_id',$branch_id);
                        $this->db->where('marketing_type',$marketing_type[$i]);
                        $this->db->where('is_deleted','0');
                        $exist_marketing = $this->db->get('tbl_automated_marketing');
                        $exist_marketing = $exist_marketing->row();
                        $automated_data = array(
                            'salon_id'          => $last_id,
                            'branch_id'         => $branch_id,
                            'marketing_type'    => $marketing_type[$i],
                            'discount_status'   => '1',
                            'for_service'       => '0',
                            'selected_service'  => null,
                            'discount_in'       => $discount_in,
                            'discount_type'     => $discount_type,
                            'discount_amount'   => $discount_amount,
                            'flexible_max'      => $flexible_max,
                            'flexible_min'      => $flexible_min,
                            'for_product'       => $for_product,
                            'employee_product_incentive'      => $employee_product_incentive,
                            'created_on'        => date('Y-m-d H:i:s')
                        );
                        if(!empty($exist_marketing)){
                            $this->db->where('id',$exist_marketing->id);
                            $this->db->update('tbl_automated_marketing', $automated_data);
                        }else{
                            $this->db->insert('tbl_automated_marketing', $automated_data);
                        }
                    }
                }
                
                if($this->input->post('branch_referred_by') != ''){
                    $this->setup_referal_benefits($this->input->post('branch_referred_by'),$branch_id);
                }
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $incentive = $this->db->get('tbl_admin_employee_incentive');
                $incentive = $incentive->result();
                if(!empty($incentive)){
                    foreach($incentive as $incentive_result){
                        $incentive_arr = array(
                            'level' 		=> $incentive_result->level,
                            'start_amount' 	=> $incentive_result->start_amount,
                            'end_amount' 	=> $incentive_result->end_amount,
                            'incentive' 	=> $incentive_result->incentive,
                            'per_or_flat' 	=> $incentive_result->per_or_flat,
                            'salon_id' 		=> $last_id,
                            'branch_id' 	=> $branch_id,
                            'created_on' 	=> date("Y-m-d H:i:s"),
                        );
                        $this->db->insert('tbl_salon_employee_incentive',$incentive_arr);
                    }
                }      
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $facilities = $this->db->get('tbl_facility_master');
                $facilities = $facilities->result();
                if(!empty($facilities)){
                    foreach($facilities as $facilities_result){
                        $facilities_result_data = array(
                            'icon' 	        => $facilities_result->icon,
                            'facility_name' => $facilities_result->facility_name,
                            'salon_id' 		=> $last_id,
                            'branch_id' 	=> $branch_id,
                            'primary_table_id'  =>  $facilities_result->id,
                            'created_on' 	=> date("Y-m-d H:i:s"),
                        );
                        $this->db->insert('tbl_salon_facility_master',$facilities_result_data);
                    }
                }          
    
                $new_profile_array = array_merge($new_arr,$branch_id_array);
                $this->db->insert('tbl_store_profile',$new_profile_array); 
    
                $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                $salon_id = $last_id;
                $branch_id = $branch_id;
                $type = '0';
                $title = 'Branch Created';
                $desc = 'New Branch created' . (!empty($profile) ? ' by '. $profile->full_name : '');
                if($subscription_name != "" && $subscription_price != "" & $subscription_valid_till != ""){
                    $desc .= ' and ' . $subscription_name . ' subscription allocated worth Rs. ' . $subscription_price . ' (Valid Till: ' . date('d M, Y h:i A',strtotime($subscription_valid_till)) . ')';
                }
                $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);
                
                $message_type = '13';
                $email_subject = 'Branch Registration Completed Successfully';
                $to_email = $this->input->post('email');
                // $to_email = $this->input->post('branch_email');
                $email_html = $this->get_registration_content($branch_id,$last_id);
                if($to_email != "" && $email_html != ""){
                    $membership_history_id = '';
                    $giftcard_purchase_id = '';
                    $package_allocation_id = '';
                    $trying_booking_id = '';
                    $cron_id = '';
                    $this->Salon_model->send_email($email_html,'','',$message_type,'',$last_id,$branch_id,'','','',$to_email,$email_subject,'',$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$cron_id);
                }

                $this->session->set_flashdata('success','Record added successfully');
                
                redirect('branch_payment?salon='.$last_id.'&branch='.$branch_id);
                // redirect('salon-list');
            }else{
                $this->session->set_flashdata('success','Record added successfully');
                redirect('add-branch/'.$last_id);
            }
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_salon',$salon_data);
            $last_id = $this->input->post('id');

            if($this->input->post('old_is_branch_available') == '0'){
                $this->db->where('id',$this->input->post('hidden_self_branch_id'));
                $exist_branch = $this->db->get('tbl_branch')->row();
                if(!empty($exist_branch)){
                    $data = array(
                        'salon_id'             	=> $last_id,        
                        'branch_name'      		=> $this->input->post('salon_name'),   
                        'salon_number' 			=> $this->input->post('salon_owner_number'),
                        'email' 				=> $this->input->post('email'),
                        // 'email' 				=> $this->input->post('branch_email'),
                        'password'              => $this->input->post('password'),
                        'salon_address' 		=> $this->input->post('salon_address'),
                        'state' 				=> $this->input->post('state'),
                        'city' 					=> $this->input->post('city'),
                        'pincode' 				=> $this->input->post('pincode'),
                        'category' 				=> $this->input->post('category'),
                        // 'agree_terms' 			=> $this->input->post('agree_terms') == 'Yes' ? 'Yes' : 'No',
                        'payment_options' 	    => $payment_options_text,
                        'shopact' 				=> $shopact,
                    ); 
                    // echo '<pre>'; print_r($data); exit;
                    $referred_by_data=array( 
                        'referred_by' 			=> $this->input->post('branch_referred_by')   
                    );

                    $old_subscription = $exist_branch->subscription_id;
                    $new_subscription = $this->input->post('subscription');
                    
                    $old_referred_by = $exist_branch->referred_by;
                    $new_referred_by = $this->input->post('branch_referred_by');

                    $referred_by_data = array_merge($data,$referred_by_data);

                    $this->db->where('id',$exist_branch->id);
                    $this->db->update('tbl_branch',$referred_by_data);

                    $year_month = date('ym',strtotime($exist_branch->created_on));
                    $formatted_branch_id = str_pad($exist_branch->id, 4, '0', STR_PAD_LEFT);
                    $unique_id = $year_month . $formatted_branch_id; 
                    $code_data = array(
                        'branch_unique_code'    =>  $unique_id
                    );
                    $this->db->where('id',$exist_branch->id);
                    $this->db->update('tbl_branch',$code_data);
                    
                    $this->db->where('salon_id',$exist_branch->salon_id);
                    $this->db->where('branch_id',$exist_branch->id);
                    $this->db->update('tbl_store_profile',$data);

                    $design_data = array(
                        'salon_id'      =>  $last_id,
                    );
                    $this->db->where('branch_id', $exist_branch->id);
                    $this->db->where('designation', 'Stylist');
                    $this->db->update('tbl_emp_designation', $design_data);

                    if($new_subscription != $old_subscription){
                        $this->db->where('id',$new_subscription);
                        $this->db->where('is_deleted','0');
                        $subscription = $this->db->get('tbl_subscription_master');
                        $subscription = $subscription->row();
                        if(!empty($subscription)){
                            $current_date = new DateTime();
                            
                            $subscription_duration_days = $subscription->duration != "" && $subscription->duration != null ? $subscription->duration : '1';
                            $current_date->modify("+$subscription_duration_days days");
                            $subscription_end = $current_date->format("Y-m-d H:i:s");
                            $subscription_start = date("Y-m-d H:i:s");

                            $sub_allocation_data = array(
                                'branch_id'                 =>  $exist_branch->id,
                                'salon_id'                  =>  $last_id,
                                'subscription_name'         =>  $subscription->subscription_name, 
                                'subscription_id'  		    =>  $subscription->id, 
                                'subscription_price'        =>  $subscription->amount,
                                'subscription_validity'     =>  $subscription->duration,
                                'subscription_start'        =>  $subscription_start,
                                'subscription_end'          =>  $subscription_end,
                                'added_by'                  =>  $this->session->userdata('admin_id'),
                                'paid_amount'               =>  '0.00',
                                'due_amount'                =>  $subscription->amount,
                                'include_wp'                =>  $subscription->include_wp,
                                'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                                'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                                'created_on'                =>  date("Y-m-d H:i:s")   
                            );
                            $this->db->insert('tbl_branch_subscription_allocation',$sub_allocation_data);
                            $subscription_allocation_id = $this->db->insert_id();

                            $sub_data = array(
                                'subscription_id'  		    =>  $subscription->id, 
                                'subscription_price'        =>  $subscription->amount,
                                'subscription_validity'     =>  $subscription->duration,
                                'subscription_start'        =>  date("Y-m-d H:i:s"),
                                'subscription_end'          =>  $subscription_end,
                                'subscription_allocation_id'=>  $subscription_allocation_id,
                                'pending_due_amount'        =>  $subscription->amount,
                                'include_wp'                =>  $subscription->include_wp,
                                'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                                'current_wp_coins_balance'  =>  $subscription->wp_coins_qty
                            );
                            $this->db->where('id',$exist_branch->id);
                            $this->db->update('tbl_branch',$sub_data);
        
                            if(rtrim($subscription->subscription_name) == 'Starter'){
                                $design_array = ['Stylist','Owner'];
                            }elseif(rtrim($subscription->subscription_name) == 'Growth'){
                                $design_array = ['Stylist','Receptionist','Owner'];
                            }elseif(rtrim($subscription->subscription_name) == 'Professional'){
                                $design_array = ['Stylist','Receptionist','Owner','Manager', 'Cleaner'];
                            }else{
                                $design_array = ['Stylist','Owner'];
                            }

                            $this->db->where('branch_id',$exist_branch->id);
                            $this->db->where('salon_id',$last_id);
                            $this->db->where('is_deleted', '0');
                            $old_design = $this->db->get('tbl_emp_designation')->result();
                            if(!empty($old_design)){
                                foreach($old_design as $old_design_result){
                                    if(!in_array($old_design_result->designation,$design_array)){
                                        $this->db->where('branch_id',$exist_branch->id);
                                        $this->db->where('salon_id',$last_id);
                                        $this->db->where('designation', $old_design_result->id);
                                        $this->db->update('tbl_salon_employee',array('is_deleted'=>'1'));

                                        $this->db->where('branch_id',$exist_branch->id);
                                        $this->db->where('salon_id',$last_id);
                                        $this->db->where('id', $old_design_result->id);
                                        $this->db->update('tbl_emp_designation',array('is_deleted'=>'1'));
                                    }
                                    $index = array_search($old_design_result->designation, $design_array);
                                    if ($index !== false) {
                                        unset($design_array[$index]);
                                    }
                                }
                            }
                            $design_array = array_values($design_array);
                            for($i=0;$i<count($design_array);$i++){
                                $this->db->where('branch_id',$exist_branch->id);
                                $this->db->where('salon_id',$last_id);
                                $this->db->where('designation', $design_array[$i]);
                                $this->db->where('is_deleted', '0');
                                $designation_exist = $this->db->get('tbl_emp_designation')->row();
                                if(empty($designation_exist)){
                                    $design_data = array(
                                        'branch_id'     =>  $exist_branch->id,
                                        'salon_id'      =>  $last_id,
                                        'designation'   =>  $design_array[$i],
                                        'created_on'    =>  date("Y-m-d H:i:s")
                                    );
                                    $this->db->insert('tbl_emp_designation', $design_data);
                                }
                            }

                            $subscription_name = $subscription->subscription_name;
                            $subscription_price = $subscription->amount;
                            $subscription_valid_till = $subscription_end;
                            
                            $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                            $salon_id = $last_id;
                            $branch_id = $exist_branch->id;
                            $type = '4';
                            $title = 'New Subscription Allocated';
                            $desc = 'New Subscription ' . $subscription_name . ' worth Rs. ' . $subscription_price . ' allocated' . (!empty($profile) ? ' by '. $profile->full_name : '') . ' (Valid Till: ' . date('d M, Y h:i A',strtotime($subscription_valid_till)) . ')';
                            $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);
                        }
                        
                        $uid = $exist_branch->id.'@@@'.$exist_branch->salon_id;
                        $type = 'sender';
                        $project = 'salon';
                        $message = '';
                        $data = json_encode([
                            'message_type'  => 'subscription_updation',
                            'branch_id'     => $exist_branch->id,
                            'salon_id'      => $exist_branch->salon_id,
                            'project'       => $project,
                            'uid'           => $uid,
                            'message'       => $message,
                            'subscription_id'     => $new_subscription,
                        ]);
                        $socket_response = $this->Salon_model->send_data_to_socket_client('admin_panel',$uid,$type,$project,$message,$data);
                    }

                    if($old_referred_by != $new_referred_by){
                        $this->setup_referal_benefits($new_referred_by,$exist_branch->id);
                    }

                    $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                    $salon_id = $last_id;
                    $branch_id = $exist_branch->id;
                    $type = '1';
                    $title = 'Branch details updated';
                    $desc = 'Branch details updated' . (!empty($profile) ? ' by '. $profile->full_name : '');
                    $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

                    $this->session->set_flashdata('success','Success ! Record updated successfully');
                    
                    if($new_subscription != $old_subscription){
                        redirect('branch_payment?salon='.$last_id.'&branch='.$exist_branch->id);
                    }else{
                        redirect('add-branch/'.$last_id);
                    }
                }
            }else{
                $this->session->set_flashdata('success','Success ! Record updated successfully');
                redirect('add-branch/'.$last_id);
            }
        }
    }
    public function get_all_salon(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon');
        return $result->result();
    } 
    public function get_all_salon_except($id){
        $this->db->where('is_deleted','0');
        if($id != ""){
            $this->db->where('id !=',$id);
        }
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon');
        return $result->result();
    } 
    public function check_is_subscription_applied($id){
        $this->db->where('is_deleted','0');
        $this->db->where('subscription_id',$id);
        $result = $this->db->get('tbl_branch');
        return $result->result();
    } 
    public function get_all_salon_branch($id){
		$this->db->select('tbl_branch.*,tbl_salon.salon_name');
		$this->db->join('tbl_salon','tbl_salon.id=tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.salon_id',$id);
        $this->db->order_by('tbl_branch.id','DESC');
        $result = $this->db->get('tbl_branch');
        return $result->result();
    } 
	public function get_unique_name_ajax(){
    	$this->db->where($this->input->post('label'),$this->input->post('name'));
    	if($this->input->post('id') != "0"){
			$this->db->where('id !=',$this->input->post('id'));
		}
		$this->db->where('is_deleted','0');
    	$result = $this->db->get($this->input->post('table_name'));
    	$result = $result->row();
    	if(!empty($result)){
    		echo '1';
    	}else{
    		echo '0';
    	}
    }
    public function get_all_salon_ajx(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon');
        echo json_encode($result->result());
    } 
    public function get_all_salon_branch_ajx($id){
		$this->db->select('tbl_branch.*,tbl_salon.salon_name');
		$this->db->join('tbl_salon','tbl_salon.id=tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.salon_id',$id);
        $this->db->order_by('tbl_branch.id','DESC');
        $result = $this->db->get('tbl_branch');
        echo json_encode($result->result());
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
    public function get_profile_name($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_employee');
        $single = $result->row();
        return $single;
    } 
    public function get_salon_type($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_salon_type');
        return $result->row();
    } 
    public function set_branch($shopact){
        $payment_options = $this->input->post('payment_options');
        $payment_options_text = null;
        if($payment_options != "" && !empty($payment_options)){
            $payment_options_text = implode(',',$payment_options);
        }
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
            // 'salon_type' 			=> $this->input->post('salon_type') != "" ? explode('@@@',$this->input->post('salon_type'))[0] : '',
            // 'salon_type_rules_id'	=> $this->input->post('salon_type') != "" ? explode('@@@',$this->input->post('salon_type'))[1] : '',
            'shopact' 				=> $shopact,
            'payment_options' 	    => $payment_options_text,
        ); 
        $referred_by_data=array( 
            'referred_by' 			=> $this->input->post('referred_by')   
        );

        $subscription_name = '';
        $subscription_price = '';
        $subscription_valid_till = '';
        if($this->input->post('id') == ""){
            $this->db->where('email',$this->input->post('email'));
            $this->db->where('is_deleted','0');
            $exist = $this->db->get('tbl_branch');
            $exist = $exist->row();
            if(!empty($exist)){
                return 'failed_branch';
            }

            $date=array( 
                'created_on'            => date("Y-m-d H:i:s")     
            );
            $new_arr = array_merge($data,$date);
            $referred_by_data = array_merge($new_arr,$referred_by_data);
            $this->db->insert('tbl_branch',$referred_by_data);
            $branch_id = $this->db->insert_id();

            $branch_id_array=array( 
                'branch_id'            => $branch_id    
            );

            $year_month = date('ym');
            $formatted_branch_id = str_pad($branch_id, 4, '0', STR_PAD_LEFT);
            $unique_id = $year_month . $formatted_branch_id; 
            $code_data = array(
                'branch_unique_code'    =>  $unique_id
            );
			$this->db->where('id',$branch_id);
            $this->db->update('tbl_branch',$code_data);

            $this->db->where('id',$this->input->post('subscription'));
            $this->db->where('is_deleted','0');
			$subscription = $this->db->get('tbl_subscription_master');
			$subscription = $subscription->row();
            if(!empty($subscription)){
                $current_date = new DateTime();
                
                $subscription_duration_days = $subscription->duration != "" && $subscription->duration != null ? $subscription->duration : '1';
                $current_date->modify("+$subscription_duration_days days");
                $subscription_end = $current_date->format("Y-m-d H:i:s");
                $subscription_start = date("Y-m-d H:i:s");

                $sub_allocation_data = array(
                    'branch_id'                 =>  $branch_id,
                    'salon_id'                  =>  $this->input->post('salon_id'),
                    'subscription_name'         =>  $subscription->subscription_name, 
                    'subscription_id'  		    =>  $subscription->id, 
                    'subscription_price'        =>  $subscription->amount,
                    'subscription_validity'     =>  $subscription->duration,
                    'subscription_start'        =>  $subscription_start,
                    'subscription_end'          =>  $subscription_end,
                    'added_by'                  =>  $this->session->userdata('admin_id'),
                    'paid_amount'               =>  '0.00',
                    'due_amount'                =>  $subscription->amount,
                    'include_wp'                =>  $subscription->include_wp,
                    'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                    'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                    'created_on'                =>  date("Y-m-d H:i:s")   
                );
                $this->db->insert('tbl_branch_subscription_allocation',$sub_allocation_data);
                $subscription_allocation_id = $this->db->insert_id();

                $sub_data = array(
                    'subscription_id'  		    =>  $subscription->id, 
                    'subscription_price'        =>  $subscription->amount,
                    'subscription_validity'     =>  $subscription->duration,
                    'subscription_start'        =>  date("Y-m-d H:i:s"),
                    'subscription_end'          =>  $subscription_end,
                    'subscription_allocation_id'=>  $subscription_allocation_id,
                    'pending_due_amount'        =>  $subscription->amount,
                    'include_wp'                =>  $subscription->include_wp,
                    'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                    'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                );
                $this->db->where('id',$branch_id);
                $this->db->update('tbl_branch',$sub_data);
        
                if(rtrim($subscription->subscription_name) == 'Starter'){
                    $design_array = ['Stylist','Owner'];
                }elseif(rtrim($subscription->subscription_name) == 'Growth'){
                    $design_array = ['Stylist','Receptionist','Owner'];
                }elseif(rtrim($subscription->subscription_name) == 'Professional'){
                    $design_array = ['Stylist','Receptionist','Owner','Manager', 'Cleaner'];
                }else{
                    $design_array = ['Stylist','Owner'];
                }

                for($i=0;$i<count($design_array);$i++){
                    $design_data = array(
                        'branch_id'     =>  $branch_id,
                        'salon_id'      =>  $this->input->post('salon_id'),
                        'designation'   =>  $design_array[$i],
                        'created_on'    =>  date("Y-m-d H:i:s")
                    );
                    $this->db->insert('tbl_emp_designation', $design_data);
                }

                $subscription_name = $subscription->subscription_name;
                $subscription_price = $subscription->amount;
                $subscription_valid_till = $subscription_end;

                $marketing_type = [];
                $features = $subscription->features != "" ? explode(',',$subscription->features) : [];
                if(in_array('55',$features)){
                    $marketing_type[] = '2';
                }
                if(in_array('56',$features)){
                    $marketing_type[] = '1';
                }
                if(in_array('57',$features)){
                    $marketing_type[] = '3';
                }
                if(in_array('58',$features)){
                    $marketing_type[] = '4';
                }
                if(in_array('59',$features)){
                    $marketing_type[] = '0';
                }
                if(in_array('60',$features)){
                    $marketing_type[] = '5';
                }

                for($i=0;$i<count($marketing_type);$i++){    
                    $for_product = '0';
                    $employee_product_incentive = null;                                            
                    if($marketing_type[$i] == '2'){   // Lost
                        $discount_amount = '20';
                        $discount_in = '0';
                        $discount_type = null;
                        $flexible_min = null;
                        $flexible_max = null;
                    }elseif($marketing_type[$i] == '1'){   // Regular
                        $discount_amount = null;
                        $discount_in = '0';
                        $discount_type = '1';
                        $flexible_min = '5';
                        $flexible_max = '15';
                    }elseif($marketing_type[$i] == '3'){   // Birthday
                        $discount_amount = '20';
                        $discount_in = '0';
                        $discount_type = null;
                        $flexible_min = null;
                        $flexible_max = null;
                    }elseif($marketing_type[$i] == '4'){   // Anniversary
                        $discount_amount = '20';
                        $discount_in = '0';
                        $discount_type = null;
                        $flexible_min = null;
                        $flexible_max = null;
                    }elseif($marketing_type[$i] == '0'){   // New
                        $discount_amount = '10';
                        $discount_in = '0';
                        $discount_type = null;
                    }elseif($marketing_type[$i] == '5'){   // New
                        $discount_amount = '5';
                        $discount_in = '0';
                        $discount_type = '0';
                        $for_product = '0';
                        $employee_product_incentive = '5';
                    }else{
                        $discount_amount = '10';
                        $discount_in = '0';
                        $discount_type = null;
                        $flexible_min = null;
                        $flexible_max = null;
                    }

                    $this->db->where('salon_id',$this->input->post('salon_id'));
                    $this->db->where('branch_id',$branch_id);
                    $this->db->where('marketing_type',$marketing_type[$i]);
                    $this->db->where('is_deleted','0');
                    $exist_marketing = $this->db->get('tbl_automated_marketing');
                    $exist_marketing = $exist_marketing->row();
                    $automated_data = array(
                        'salon_id'          => $this->input->post('salon_id'),
                        'branch_id'         => $branch_id,
                        'marketing_type'    => $marketing_type[$i],
                        'discount_status'   => '1',
                        'for_service'       => '0',
                        'selected_service'  => null,
                        'discount_in'       => $discount_in,
                        'discount_type'     => $discount_type,
                        'discount_amount'   => $discount_amount,
                        'flexible_max'      => $flexible_max,
                        'flexible_min'      => $flexible_min,
                        'for_product'       => $for_product,
                        'employee_product_incentive'      => $employee_product_incentive,
                        'created_on'        => date('Y-m-d H:i:s')
                    );
                    if(!empty($exist_marketing)){
                        $this->db->where('id',$exist_marketing->id);
                        $this->db->update('tbl_automated_marketing', $automated_data);
                    }else{
                        $this->db->insert('tbl_automated_marketing', $automated_data);
                    }
                }
            }
            
            if($this->input->post('referred_by') != ''){
                $this->setup_referal_benefits($this->input->post('referred_by'),$branch_id);
            }
            
            $this->db->where('is_deleted','0');
			$this->db->where('status','1');
			$incentive = $this->db->get('tbl_admin_employee_incentive');
			$incentive = $incentive->result();
			if(!empty($incentive)){
				foreach($incentive as $incentive_result){
					$incentive_arr = array(
						'level' 		=> $incentive_result->level,
						'start_amount' 	=> $incentive_result->start_amount,
						'end_amount' 	=> $incentive_result->end_amount,
						'incentive' 	=> $incentive_result->incentive,
						'per_or_flat' 	=> $incentive_result->per_or_flat,
						'salon_id' 		=> $this->input->post('salon_id'),
						'branch_id' 	=> $branch_id,
						'created_on' 	=> date("Y-m-d H:i:s"),
					);
					$this->db->insert('tbl_salon_employee_incentive',$incentive_arr);
				}
			}            

            $new_profile_array = array_merge($new_arr,$branch_id_array);
            $this->db->insert('tbl_store_profile',$new_profile_array); 

            $profile = $this->get_profile_name($this->session->userdata('admin_id'));
            $salon_id = $this->input->post('salon_id');
            $branch_id = $branch_id;
            $type = '0';
            $title = 'Branch Created';
            $desc = 'New Branch created' . (!empty($profile) ? ' by '. $profile->full_name : '');
            if($subscription_name != "" && $subscription_price != "" & $subscription_valid_till != ""){
                $desc .= ' and ' . $subscription_name . ' subscription allocated worth Rs. ' . $subscription_price . ' (Valid Till: ' . date('d M, Y h:i A',strtotime($subscription_valid_till)) . ')';
            }
            $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

            $this->session->set_flashdata('success','Record added successfully');
            redirect('branch_payment?salon='.$this->input->post('salon_id').'&branch='.$branch_id);
        }else{
            $this->db->where('id',$this->input->post('id'));
            $exist_branch = $this->db->get('tbl_branch')->row();
            if(!empty($exist_branch)){
                $old_subscription = $exist_branch->subscription_id;
                $new_subscription = $this->input->post('subscription');
                
                $old_referred_by = $exist_branch->referred_by;
                $new_referred_by = $this->input->post('referred_by');

                $referred_by_data = array_merge($data,$referred_by_data);

                $this->db->where('id',$this->input->post('id'));
                $this->db->update('tbl_branch',$referred_by_data);

                $this->db->where('id',$this->input->post('id'));
                $exist = $this->db->get('tbl_branch')->row();
                if(!empty($exist)){
                    $year_month = date('ym',strtotime($exist->created_on));
                    $formatted_branch_id = str_pad($this->input->post('id'), 4, '0', STR_PAD_LEFT);
                    $unique_id = $year_month . $formatted_branch_id; 
                    $code_data = array(
                        'branch_unique_code'    =>  $unique_id
                    );
                    $this->db->where('id',$exist->id);
                    $this->db->update('tbl_branch',$code_data);
                }
                
                $this->db->where('salon_id',$exist_branch->salon_id);
                $this->db->where('branch_id',$exist_branch->id);
                $this->db->update('tbl_store_profile',$data);

                $design_data = array(
                    'salon_id'      =>  $this->input->post('salon_id'),
                );
                $this->db->where('branch_id', $this->input->post('id'));
                $this->db->where('designation', 'Stylist');
                $this->db->update('tbl_emp_designation', $design_data);

                if($new_subscription != $old_subscription){
                    $this->db->where('id',$new_subscription);
                    $this->db->where('is_deleted','0');
                    $subscription = $this->db->get('tbl_subscription_master');
                    $subscription = $subscription->row();
                    if(!empty($subscription)){
                        $current_date = new DateTime();
                        
                        $subscription_duration_days = $subscription->duration != "" && $subscription->duration != null ? $subscription->duration : '1';
                        $current_date->modify("+$subscription_duration_days days");
                        $subscription_end = $current_date->format("Y-m-d H:i:s");
                        $subscription_start = date("Y-m-d H:i:s");

                        $sub_allocation_data = array(
                            'branch_id'                 =>  $this->input->post('id'),
                            'salon_id'                  =>  $this->input->post('salon_id'),
                            'subscription_name'         =>  $subscription->subscription_name, 
                            'subscription_id'  		    =>  $subscription->id, 
                            'subscription_price'        =>  $subscription->amount,
                            'subscription_validity'     =>  $subscription->duration,
                            'subscription_start'        =>  $subscription_start,
                            'subscription_end'          =>  $subscription_end,
                            'added_by'                  =>  $this->session->userdata('admin_id'),
                            'paid_amount'               =>  '0.00',
                            'due_amount'                =>  $subscription->amount,
                            'include_wp'                =>  $subscription->include_wp,
                            'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                            'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                            'created_on'                =>  date("Y-m-d H:i:s")   
                        );
                        $this->db->insert('tbl_branch_subscription_allocation',$sub_allocation_data);
                        $subscription_allocation_id = $this->db->insert_id();

                        $old_current_wp_coins_balance = !empty($exist) ? (int)$exist->current_wp_coins_balance : 0;
                        $current_wp_coins_balance = $old_current_wp_coins_balance + (int)$subscription->wp_coins_qty;
                        $sub_data = array(
                            'subscription_id'  		    =>  $subscription->id, 
                            'subscription_price'        =>  $subscription->amount,
                            'subscription_validity'     =>  $subscription->duration,
                            'subscription_start'        =>  date("Y-m-d H:i:s"),
                            'subscription_end'          =>  $subscription_end,
                            'subscription_allocation_id'=>  $subscription_allocation_id,
                            'pending_due_amount'        =>  $subscription->amount,
                            'include_wp'                =>  $subscription->include_wp,
                            'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                            'current_wp_coins_balance'  =>  $current_wp_coins_balance,
                        );
                        $this->db->where('id',$this->input->post('id'));
                        $this->db->update('tbl_branch',$sub_data);
        
                        if(rtrim($subscription->subscription_name) == 'Starter'){
                            $design_array = ['Stylist','Owner'];
                        }elseif(rtrim($subscription->subscription_name) == 'Growth'){
                            $design_array = ['Stylist','Receptionist','Owner'];
                        }elseif(rtrim($subscription->subscription_name) == 'Professional'){
                            $design_array = ['Stylist','Receptionist','Owner','Manager', 'Cleaner'];
                        }else{
                            $design_array = ['Stylist','Owner'];
                        }

                        $this->db->where('branch_id',$this->input->post('id'));
                        $this->db->where('salon_id',$this->input->post('salon_id'));
                        $this->db->where('is_deleted', '0');
                        $old_design = $this->db->get('tbl_emp_designation')->result();
                        if(!empty($old_design)){
                            foreach($old_design as $old_design_result){
                                if(!in_array($old_design_result->designation,$design_array)){
                                    $this->db->where('branch_id',$this->input->post('id'));
                                    $this->db->where('salon_id',$this->input->post('salon_id'));
                                    $this->db->where('designation', $old_design_result->id);
                                    $this->db->update('tbl_salon_employee',array('is_deleted'=>'1'));

                                    $this->db->where('branch_id',$this->input->post('id'));
                                    $this->db->where('salon_id',$this->input->post('salon_id'));
                                    $this->db->where('id', $old_design_result->id);
                                    $this->db->update('tbl_emp_designation',array('is_deleted'=>'1'));
                                }
                                $index = array_search($old_design_result->designation, $design_array);
                                if ($index !== false) {
                                    unset($design_array[$index]);
                                }
                            }
                        }
                        $design_array = array_values($design_array);
                        for($i=0;$i<count($design_array);$i++){
                            $this->db->where('branch_id',$this->input->post('id'));
                            $this->db->where('salon_id',$this->input->post('salon_id'));
                            $this->db->where('designation', $design_array[$i]);
                            $this->db->where('is_deleted', '0');
                            $designation_exist = $this->db->get('tbl_emp_designation')->row();
                            if(empty($designation_exist)){
                                $design_data = array(
                                    'branch_id'     =>  $this->input->post('id'),
                                    'salon_id'      =>  $this->input->post('salon_id'),
                                    'designation'   =>  $design_array[$i],
                                    'created_on'    =>  date("Y-m-d H:i:s")
                                );
                                $this->db->insert('tbl_emp_designation', $design_data);
                            }
                        }

                        $subscription_name = $subscription->subscription_name;
                        $subscription_price = $subscription->amount;
                        $subscription_valid_till = $subscription_end;
                        
                        $marketing_type = [];
                        $features = $subscription->features != "" ? explode(',',$subscription->features) : [];
                        if(in_array('55',$features)){
                            $marketing_type[] = '2';
                        }
                        if(in_array('56',$features)){
                            $marketing_type[] = '1';
                        }
                        if(in_array('57',$features)){
                            $marketing_type[] = '3';
                        }
                        if(in_array('58',$features)){
                            $marketing_type[] = '4';
                        }
                        if(in_array('59',$features)){
                            $marketing_type[] = '0';
                        }
                        if(in_array('60',$features)){
                            $marketing_type[] = '5';
                        }

                        if(!empty($marketing_type) && count($marketing_type) > 0){
                            $this->db->where('salon_id',$this->input->post('salon_id'));
                            $this->db->where('branch_id',$this->input->post('id'));
                            $this->db->delete('tbl_automated_marketing');

                            for($i=0;$i<count($marketing_type);$i++){    
                                $for_product = '0';
                                $employee_product_incentive = null;                                           
                                if($marketing_type[$i] == '2'){   // Lost
                                    $discount_amount = '20';
                                    $discount_in = '0';
                                    $discount_type = null;
                                    $flexible_min = null;
                                    $flexible_max = null;
                                }elseif($marketing_type[$i] == '1'){   // Regular
                                    $discount_amount = null;
                                    $discount_in = '0';
                                    $discount_type = '1';
                                    $flexible_min = '5';
                                    $flexible_max = '15';
                                }elseif($marketing_type[$i] == '3'){   // Birthday
                                    $discount_amount = '20';
                                    $discount_in = '0';
                                    $discount_type = null;
                                    $flexible_min = null;
                                    $flexible_max = null;
                                }elseif($marketing_type[$i] == '4'){   // Anniversary
                                    $discount_amount = '20';
                                    $discount_in = '0';
                                    $discount_type = null;
                                    $flexible_min = null;
                                    $flexible_max = null;
                                }elseif($marketing_type[$i] == '0'){   // New
                                    $discount_amount = '10';
                                    $discount_in = '0';
                                    $discount_type = null;
                                }elseif($marketing_type[$i] == '5'){   // New
                                    $discount_amount = '5';
                                    $discount_in = '0';
                                    $discount_type = '0';
                                    $for_product = '0';
                                    $employee_product_incentive = '5';
                                }else{
                                    $discount_amount = '10';
                                    $discount_in = '0';
                                    $discount_type = null;
                                    $flexible_min = null;
                                    $flexible_max = null;
                                }
            
                                $this->db->where('salon_id',$this->input->post('salon_id'));
                                $this->db->where('branch_id',$this->input->post('id'));
                                $this->db->where('marketing_type',$marketing_type[$i]);
                                $this->db->where('is_deleted','0');
                                $exist_marketing = $this->db->get('tbl_automated_marketing');
                                $exist_marketing = $exist_marketing->row();
                                $automated_data = array(
                                    'salon_id'          => $this->input->post('salon_id'),
                                    'branch_id'         => $this->input->post('id'),
                                    'marketing_type'    => $marketing_type[$i],
                                    'discount_status'   => '1',
                                    'for_service'       => '0',
                                    'selected_service'  => null,
                                    'discount_in'       => $discount_in,
                                    'discount_type'     => $discount_type,
                                    'discount_amount'   => $discount_amount,
                                    'flexible_max'      => $flexible_max,
                                    'flexible_min'      => $flexible_min,
                                    'for_product'       => $for_product,
                                    'employee_product_incentive'      => $employee_product_incentive,
                                    'created_on'        => date('Y-m-d H:i:s')
                                );
                                if(!empty($exist_marketing)){
                                    $this->db->where('id',$exist_marketing->id);
                                    $this->db->update('tbl_automated_marketing', $automated_data);
                                }else{
                                    $this->db->insert('tbl_automated_marketing', $automated_data);
                                }
                            }
                        }
                        
                        $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                        $salon_id = $this->input->post('salon_id');
                        $branch_id = $this->input->post('id');
                        $type = '4';
                        $title = 'New Subscription Allocated';
                        $desc = 'New Subscription ' . $subscription_name . ' worth Rs. ' . $subscription_price . ' allocated' . (!empty($profile) ? ' by '. $profile->full_name : '') . ' (Valid Till: ' . date('d M, Y h:i A',strtotime($subscription_valid_till)) . ')';
                        $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

                        $reset_data = array(
                            'earn_coins_flag'               =>  '0',
                            'earn_coins_last_stopped_on'    =>  date('Y-m-d H:i:s'),
                            'earn_coins_last_stopped_reason'=>  $desc
                        );
                        $this->db->where('id',$this->input->post('id'));
                        $this->db->update('tbl_branch',$reset_data);
                    }
                    
                    $uid = $exist_branch->id.'@@@'.$exist_branch->salon_id;
                    $type = 'sender';
                    $project = 'salon';
                    $message = '';
                    $data = json_encode([
                        'message_type'  => 'subscription_updation',
                        'branch_id'     => $exist_branch->id,
                        'salon_id'      => $exist_branch->salon_id,
                        'project'       => $project,
                        'uid'           => $uid,
                        'message'       => $message,
                        'subscription_id'     => $new_subscription,
                    ]);
                    $socket_response = $this->Salon_model->send_data_to_socket_client('admin_panel',$uid,$type,$project,$message,$data);
                }

                if($old_referred_by != $new_referred_by){
                    $this->setup_referal_benefits($new_referred_by,$this->input->post('id'));
                }

                $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                $salon_id = $this->input->post('salon_id');
                $branch_id = $exist_branch->id;
                $type = '1';
                $title = 'Branch details updated';
                $desc = 'Branch details updated' . (!empty($profile) ? ' by '. $profile->full_name : '');
                $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

                $this->session->set_flashdata('success','Success ! Record updated successfully');
                
                if($new_subscription != $old_subscription){
                    redirect('branch_payment?salon='.$this->input->post('salon_id').'&branch='.$this->input->post('id'));
                }else{
                    redirect('add-branch/'.$this->input->post('salon_id'));
                }
            }else{
                $this->session->set_flashdata('success','Success ! Record updated successfully');
                redirect('add-branch/'.$this->input->post('salon_id'));
            }
        }
    } 

    public function get_registration_content($branch_id, $salon_id){
        $email_html = '';
        $this->db->select('tbl_branch.*, tbl_salon.salon_name');
        $this->db->join('tbl_salon', 'tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.id', $branch_id);
        $this->db->where('tbl_branch.salon_id', $salon_id);
        $this->db->where('tbl_branch.is_deleted', '0');
        $exist = $this->db->get('tbl_branch')->row();    
        if (!empty($exist)) {
            // <div style="text-align:right;">
            //     <p style="font-size: 18px; font-weight: 600; color: white;">Branch Registration</p>
            // </div>
            $email_html = '
                <!DOCTYPE html>
                    <html>
                        <head>
                            <title></title>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans">
                            <style>
                                body {
                                }
                            </style>
                        </head>
                        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                            <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; max-width: 0px; opacity: 0; overflow: hidden;"> 
                            </div>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background: #fff;">
                                            <tr>
                                                <td align="start" style=" border-radius: 4px 4px 4px 4px; color: #666666;  font-size: 18px; font-weight: 400; line-height: 25px;">
                                                    
                                                    <div style="text-align:center;"> 
                                                        <div style="display:flex; justify-content: space-between; padding: 5px; align-items: center; background-color: #181f2f;">
                                                            <div>
                                                                <img style="width:150px;" src="https://napito.in/assets/images/napito_logo.jpg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif; width: 600px; border: 2px solid black; margin: auto; padding: 25px;">
                                                        <div style="height: 550px; padding: 10px 15px;">
                                                            <p style="color: black;">Dear ' . $exist->branch_name . ',</p>
                                                            <p style="color: black;">Welcome to Napito...!!!</p>
                                                            <p style="color: black;">Congratulations on successfully registering with us! We are excited to have you on board.</p>
                                                            <p style="color: black;">Your registration details are as follows:</p>
                                                            <p style="color: black;"><strong>Email:</strong> ' . $exist->email . '</p>
                                                            <p style="color: black;"><strong>Password:</strong> ' . $exist->password . '</p>
                                                            <p style="color: black;">You can login using the following link:</p>
                                                            <p style="color: black;"><a href="http://napito.in/" style="color: #3498db;">Login from here</a></p>
                                                            <p class="center" style="line-height: 0.8; color: black; margin-top: 50px"><b>Thanks & Regards,</b></p> 
                                                            <p style="color: black;">Napito Team</p>
                                                            <p style="color: black;">' . EMAIL_COMPANY_EMAIL . '</p>
                                                        </div> 
                                                    </div> 
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr> 
                            </table>
                        </body> 
                    </html>';
        }
        return $email_html;
    }    
    
    public function set_bulk_branch(){  
        $indices = $this->input->post('indices');
        if($indices != "" && !empty($indices) && is_array($indices)){
            for($count_index=0;$count_index<count($indices);$count_index++){
                $index = $indices[$count_index];
                $this->db->where('email',$this->input->post('email_' . $index));
                $this->db->where('is_deleted','0');
                $exist = $this->db->get('tbl_branch');
                $exist = $exist->row();
                if(empty($exist)){
                    $shopact = "";
                    if($_FILES['shopact_' . $index]['name'] !=""){
                        $temp = explode('.', $_FILES['shopact_' . $index]['name']);
                        $ext = end($temp);
                        $new_shopact = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
                        $config = array(
                            'upload_path' 	=> "admin_assets/images/shopact-image/",
                            'allowed_types' => "pdf|jpg|jpeg|png",
                            'file_name'		=> $new_shopact,
                        );			
                        $this->upload->initialize($config);
                        if($this->upload->do_upload('shopact_' . $index)){
                            $data = $this->upload->data();				
                            $shopact = $data['file_name'];	
                        }else{ 
                            $error = array('error' => $this->upload->display_errors());	
                            $this->upload->display_errors();
                        }
                    }
                    $payment_options = $this->input->post('payment_options_' . $index);
                    $payment_options_text = null;
                    if($payment_options != "" && !empty($payment_options)){
                        $payment_options_text = implode(',',$payment_options);
                    }
                    $data = array(
                        'salon_id'             	=> $this->input->post('salon_id_' . $index),        
                        'branch_name'      		=> $this->input->post('branch_name_' . $index),     
                        'salon_number' 			=> $this->input->post('salon_number_' . $index),  
                        'email' 				=> $this->input->post('email_' . $index),  
                        'password'              => $this->input->post('password_' . $index),  
                        'salon_address' 		=> $this->input->post('salon_address_' . $index),  
                        'state' 				=> $this->input->post('state_' . $index),  
                        'city' 					=> $this->input->post('city_' . $index),  
                        'pincode' 				=> $this->input->post('pincode_' . $index),  
                        'category' 				=> $this->input->post('category_' . $index),  
                        'account_holder_name' 	=> $this->input->post('account_holder_name_' . $index),  
                        'account_number' 		=> $this->input->post('account_number_' . $index),  
                        'account_type' 			=> $this->input->post('account_type_' . $index),  
                        'bank_branch_name' 		=> $this->input->post('bank_branch_name_' . $index),  
                        'bank_name' 			=> $this->input->post('bank_name_' . $index),  
                        'ifsc' 					=> $this->input->post('ifsc_' . $index),  
                        // 'agree_terms' 			=> $this->input->post('agree_terms_' . $index) == 'Yes' ? 'Yes' : 'No',
                        'shopact' 				=> $shopact,
                        'payment_options'       => $payment_options_text
                    ); 
                    $referred_by_data=array( 
                        'referred_by' 			=> $this->input->post('referred_by_' . $index)   
                    );
            
                    $subscription_name = '';
                    $subscription_price = '';
                    $subscription_valid_till = '';
            
                    $date=array( 
                        'created_on'            => date("Y-m-d H:i:s")     
                    );
                    $new_arr = array_merge($data,$date);
                    $referred_by_data = array_merge($new_arr,$referred_by_data);
                    $this->db->insert('tbl_branch',$referred_by_data);
                    $branch_id = $this->db->insert_id();
            
                    $branch_id_array=array( 
                        'branch_id'            => $branch_id    
                    );
            
                    $year_month = date('ym');
                    $formatted_branch_id = str_pad($branch_id, 4, '0', STR_PAD_LEFT);
                    $unique_id = $year_month . $formatted_branch_id; 
                    $code_data = array(
                        'branch_unique_code'    =>  $unique_id
                    );
                    $this->db->where('id',$branch_id);
                    $this->db->update('tbl_branch',$code_data);
            
                    $this->db->where('id',$this->input->post('subscription_' . $index));
                    $this->db->where('is_deleted','0');
                    $subscription = $this->db->get('tbl_subscription_master');
                    $subscription = $subscription->row();
                    if(!empty($subscription)){
                        $current_date = new DateTime();
                        
                        $subscription_duration_days = $subscription->duration != "" && $subscription->duration != null ? $subscription->duration : '1';
                        $current_date->modify("+$subscription_duration_days days");
                        $subscription_end = $current_date->format("Y-m-d H:i:s");
                        $subscription_start = date("Y-m-d H:i:s");
            
                        $sub_allocation_data = array(
                            'branch_id'                 =>  $branch_id,
                            'salon_id'                  =>  $this->input->post('salon_id_' . $index),
                            'subscription_name'         =>  $subscription->subscription_name, 
                            'subscription_id'  		    =>  $subscription->id, 
                            'subscription_price'        =>  $subscription->amount,
                            'subscription_validity'     =>  $subscription->duration,
                            'subscription_start'        =>  $subscription_start,
                            'subscription_end'          =>  $subscription_end,
                            'added_by'                  =>  $this->session->userdata('admin_id'),
                            'paid_amount'               =>  '0.00',
                            'due_amount'                =>  $subscription->amount,
                            'include_wp'                =>  $subscription->include_wp,
                            'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                            'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                            'created_on'                =>  date("Y-m-d H:i:s")   
                        );
                        $this->db->insert('tbl_branch_subscription_allocation',$sub_allocation_data);
                        $subscription_allocation_id = $this->db->insert_id();
            
                        $sub_data = array(
                            'subscription_id'  		    =>  $subscription->id, 
                            'subscription_price'        =>  $subscription->amount,
                            'subscription_validity'     =>  $subscription->duration,
                            'subscription_start'        =>  date("Y-m-d H:i:s"),
                            'subscription_end'          =>  $subscription_end,
                            'subscription_allocation_id'=>  $subscription_allocation_id,
                            'pending_due_amount'        =>  $subscription->amount,
                            'include_wp'                =>  $subscription->include_wp,
                            'wp_coins_qty'              =>  $subscription->wp_coins_qty,
                            'current_wp_coins_balance'  =>  $subscription->wp_coins_qty,
                        );
                        $this->db->where('id',$branch_id);
                        $this->db->update('tbl_branch',$sub_data);
            
                        if(rtrim($subscription->subscription_name) == 'Starter'){
                            $design_array = ['Stylist','Owner'];
                        }elseif(rtrim($subscription->subscription_name) == 'Growth'){
                            $design_array = ['Stylist','Receptionist','Owner'];
                        }elseif(rtrim($subscription->subscription_name) == 'Professional'){
                            $design_array = ['Stylist','Receptionist','Owner','Manager', 'Cleaner'];
                        }else{
                            $design_array = ['Stylist','Owner'];
                        }
            
                        for($i=0;$i<count($design_array);$i++){
                            $design_data = array(
                                'branch_id'     =>  $branch_id,
                                'salon_id'      =>  $this->input->post('salon_id_' . $index),
                                'designation'   =>  $design_array[$i],
                                'created_on'    =>  date("Y-m-d H:i:s")
                            );
                            $this->db->insert('tbl_emp_designation', $design_data);
                        }
            
                        $subscription_name = $subscription->subscription_name;
                        $subscription_price = $subscription->amount;
                        $subscription_valid_till = $subscription_end;
                        
                        $marketing_type = [];
                        $features = $subscription->features != "" ? explode(',',$subscription->features) : [];
                        if(in_array('55',$features)){
                            $marketing_type[] = '2';
                        }
                        if(in_array('56',$features)){
                            $marketing_type[] = '1';
                        }
                        if(in_array('57',$features)){
                            $marketing_type[] = '3';
                        }
                        if(in_array('58',$features)){
                            $marketing_type[] = '4';
                        }
                        if(in_array('59',$features)){
                            $marketing_type[] = '0';
                        }
                        if(in_array('60',$features)){
                            $marketing_type[] = '5';
                        }

                        if(!empty($marketing_type) && count($marketing_type) > 0){    
                            $for_product = '0';
                            $employee_product_incentive = null;                                              
                            if($marketing_type[$i] == '2'){   // Lost
                                $discount_amount = '20';
                                $discount_in = '0';
                                $discount_type = null;
                                $flexible_min = null;
                                $flexible_max = null;
                            }elseif($marketing_type[$i] == '1'){   // Regular
                                $discount_amount = null;
                                $discount_in = '0';
                                $discount_type = '1';
                                $flexible_min = '5';
                                $flexible_max = '15';
                            }elseif($marketing_type[$i] == '3'){   // Birthday
                                $discount_amount = '20';
                                $discount_in = '0';
                                $discount_type = null;
                                $flexible_min = null;
                                $flexible_max = null;
                            }elseif($marketing_type[$i] == '4'){   // Anniversary
                                $discount_amount = '20';
                                $discount_in = '0';
                                $discount_type = null;
                                $flexible_min = null;
                                $flexible_max = null;
                            }elseif($marketing_type[$i] == '0'){   // New
                                $discount_amount = '10';
                                $discount_in = '0';
                                $discount_type = null;
                                $flexible_min = null;
                                $flexible_max = null;
                            }elseif($marketing_type[$i] == '5'){   // New
                                $discount_amount = '5';
                                $discount_in = '0';
                                $discount_type = '0';
                                $for_product = '0';
                                $employee_product_incentive = '5';
                                $flexible_min = null;
                                $flexible_max = null;
                            }else{
                                $discount_amount = '10';
                                $discount_in = '0';
                                $discount_type = null;
                                $flexible_min = null;
                                $flexible_max = null;
                            }
        
                            $this->db->where('salon_id',$this->input->post('salon_id_' . $index));
                            $this->db->where('branch_id',$branch_id);
                            $this->db->where('marketing_type',$marketing_type[$i]);
                            $this->db->where('is_deleted','0');
                            $exist_marketing = $this->db->get('tbl_automated_marketing');
                            $exist_marketing = $exist_marketing->row();
                            $automated_data = array(
                                'salon_id'          => $this->input->post('salon_id_' . $index),
                                'branch_id'         => $branch_id,
                                'marketing_type'    => $marketing_type[$i],
                                'discount_status'   => '1',
                                'for_service'       => '0',
                                'selected_service'  => null,
                                'discount_in'       => $discount_in,
                                'discount_type'     => $discount_type,
                                'discount_amount'   => $discount_amount,
                                'flexible_max'      => $flexible_max,
                                'flexible_min'      => $flexible_min,
                                'for_product'       => $for_product,
                                'employee_product_incentive'      => $employee_product_incentive,
                                'created_on'        => date('Y-m-d H:i:s')
                            );
                            if(!empty($exist_marketing)){
                                $this->db->where('id',$exist_marketing->id);
                                $this->db->update('tbl_automated_marketing', $automated_data);
                            }else{
                                $this->db->insert('tbl_automated_marketing', $automated_data);
                            }
                        }
                    }
                    
                    if($this->input->post('referred_by_' . $index) != ''){
                        $this->setup_referal_benefits($this->input->post('referred_by_' . $index),$branch_id);
                    }
                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $incentive = $this->db->get('tbl_admin_employee_incentive');
                    $incentive = $incentive->result();
                    if(!empty($incentive)){
                        foreach($incentive as $incentive_result){
                            $incentive_arr = array(
                                'level' 		=> $incentive_result->level,
                                'start_amount' 	=> $incentive_result->start_amount,
                                'end_amount' 	=> $incentive_result->end_amount,
                                'incentive' 	=> $incentive_result->incentive,
                                'per_or_flat' 	=> $incentive_result->per_or_flat,
                                'salon_id' 		=> $this->input->post('salon_id_' . $index),
                                'branch_id' 	=> $branch_id,
                                'created_on' 	=> date("Y-m-d H:i:s"),
                            );
                            $this->db->insert('tbl_salon_employee_incentive',$incentive_arr);
                        }
                    }             
                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $facilities = $this->db->get('tbl_facility_master');
                    $facilities = $facilities->result();
                    if(!empty($facilities)){
                        foreach($facilities as $facilities_result){
                            $facilities_result_data = array(
                                'icon' 	        => $facilities_result->icon,
                                'facility_name' => $facilities_result->facility_name,
                                'salon_id' 		=> $this->input->post('salon_id_' . $index),
                                'branch_id' 	=> $branch_id,
                                'primary_table_id'  =>  $facilities_result->id,
                                'created_on' 	=> date("Y-m-d H:i:s"),
                            );
                            $this->db->insert('tbl_salon_facility_master',$facilities_result_data);
                        }
                    }  
            
                    $new_profile_array = array_merge($new_arr,$branch_id_array);
                    $this->db->insert('tbl_store_profile',$new_profile_array); 
            
                    $profile = $this->get_profile_name($this->session->userdata('admin_id'));
                    $salon_id = $this->input->post('salon_id_' . $index);
                    $branch_id = $branch_id;
                    $type = '0';
                    $title = 'Branch Created';
                    $desc = 'New Branch created' . (!empty($profile) ? ' by '. $profile->full_name : '');
                    if($subscription_name != "" && $subscription_price != "" & $subscription_valid_till != ""){
                        $desc .= ' and ' . $subscription_name . ' subscription allocated worth Rs. ' . $subscription_price . ' (Valid Till: ' . date('d M, Y h:i A',strtotime($subscription_valid_till)) . ')';
                    }
                    $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

                    $message_type = '13';
                    $email_subject = 'Branch Registration Completed Successfully';
                    $to_email = $this->input->post('email_' . $index);
                    $email_html = $this->get_registration_content($branch_id,$this->input->post('salon_id_' . $index));
                    if($to_email != "" && $email_html != ""){
                        $membership_history_id = '';
                        $giftcard_purchase_id = '';
                        $package_allocation_id = '';
                        $trying_booking_id = '';
                        $cron_id = '';
                        $this->Salon_model->send_email($email_html,'','',$message_type,'',$this->input->post('salon_id_' . $index),$branch_id,'','','',$to_email,$email_subject,'',$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$cron_id);
                    }
                }
            }
            return true;
        }else{
            return false;
        }
    } 
    public function get_subcategory_services($id){
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->where('tbl_salon_emp_service.sub_category', $id);
        $query = $this->db->get('tbl_salon_emp_service');
        return $query->result();
    }
    public function get_subcategory_admin_services($id){
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.sub_category', $id);
        $query = $this->db->get('tbl_admin_services');
        return $query->result();
    }
    public function get_category_services($id){
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->where('tbl_salon_emp_service.category', $id);
        $query = $this->db->get('tbl_salon_emp_service');
        return $query->result();
    }
    public function get_category_admin_services($id){
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.category', $id);
        $query = $this->db->get('tbl_admin_services');
        return $query->result();
    }


    
    public function get_category_products($id){
        $this->db->where('is_deleted', '0');
        $this->db->where('product_category', $id);
        $query = $this->db->get('tbl_product');
        return $query->result();
    }
    public function get_category_admin_products($id){
        $this->db->where('tbl_admin_product.is_deleted', '0');
        $this->db->where('tbl_admin_product.product_category', $id);
        $query = $this->db->get('tbl_admin_product');
        return $query->result();
    }
    public function get_subcategory_products($id){
        $this->db->where('is_deleted', '0');
        $this->db->where('product_subcategory', $id);
        $query = $this->db->get('tbl_product');
        return $query->result();
    }
    public function get_service_products_in($ids,$branch_id,$salon_id){
        if(!empty($ids)){
            $this->db->select('tbl_product.*, tbl_product_category.product_category as product_category_name, tbl_product_sub_category.product_sub_category as product_sub_category_name');
            $this->db->from('tbl_product');
            $this->db->join('tbl_product_category', 'tbl_product.product_category = tbl_product_category.id', 'left');
            $this->db->join('tbl_product_sub_category', 'tbl_product.product_subcategory = tbl_product_sub_category.id', 'left');
            $this->db->where('tbl_product.is_deleted', '0');
            $this->db->where('tbl_product.branch_id', $branch_id);
            $this->db->where('tbl_product.salon_id', $salon_id);
            $this->db->where_in('tbl_product.id', $ids);
            $this->db->order_by('tbl_product.id', 'DESC'); 
            $result = $this->db->get();
            return $result->result();
        }else{
            return array();
        }
    }
    public function get_subcategory_admin_products($id){
        $this->db->where('tbl_admin_product.is_deleted', '0');
        $this->db->where('tbl_admin_product.sub_category', $id);
        $query = $this->db->get('tbl_admin_product');
        return $query->result();
    }
    public function setup_referal_benefits($benefits_for,$benefits_from){
		$this->db->select('tbl_branch.*,tbl_subscription_master.subscription_name,tbl_branch_subscription_allocation.allocation_status');		
		$this->db->join('tbl_subscription_master','tbl_subscription_master.id = tbl_branch.subscription_id');
		$this->db->join('tbl_branch_subscription_allocation','tbl_branch_subscription_allocation.id = tbl_branch.subscription_allocation_id');
        $this->db->where('tbl_branch.is_deleted','0');
        // $this->db->where('tbl_subscription_master.is_deleted','0');
        $this->db->where('tbl_branch_subscription_allocation.allocation_status','1');
        $this->db->where('tbl_branch.subscription_end >=', date('Y-m-d H:i:s'));
        $this->db->where('tbl_branch.subscription_start <=', date('Y-m-d H:i:s'));
        $this->db->where('tbl_branch.id',$benefits_for);
		$benefits_for_branch = $this->db->get('tbl_branch')->row();

        if(!empty($benefits_for_branch)){
            $feature_slugs = $this->Salon_model->get_subscription_slugs($benefits_for_branch->subscription_id);
            if(!empty(array_intersect(['refer-earn-v-to-v'], $feature_slugs))){
                $coin_amount = coin_earn_on_every_referral;
                $coin_insert_data = array(
                    'branch_id'     =>  $benefits_for_branch->id,
                    'salon_id'      =>  $benefits_for_branch->salon_id,
                    'entry_type'    =>  '1',
                    'credit_type'   =>  '1',
                    'refer_to_branch_id'   =>  $benefits_from,
                    'coin_amount'   =>  $coin_amount,
                );
                $response = $this->Salon_model->insert_salon_coin_entry($coin_insert_data);
                return $response;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function get_branch_payment_details_ajx(){
        $branch = $this->input->post('branch');
		$this->db->select('tbl_branch.*,tbl_subscription_master.subscription_name,tbl_salon.is_gst_applicable,tbl_salon.gst_no');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch.salon_id');
		$this->db->join('tbl_subscription_master','tbl_subscription_master.id = tbl_branch.subscription_id');
		$this->db->join('tbl_branch_subscription_allocation','tbl_branch_subscription_allocation.id = tbl_branch.subscription_allocation_id');
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.subscription_end >=', date('Y-m-d H:i:s'));
        $this->db->where('tbl_branch.subscription_start <=', date('Y-m-d H:i:s'));
        $this->db->where('tbl_branch.id',$branch);
		$result = $this->db->get('tbl_branch');
		$branch = $result->row();	
        if(!empty($branch)){
            $subscription_allocation = $this->get_subscription_allocation_details($branch->subscription_allocation_id);
            if(!empty($subscription_allocation)){
                if($subscription_allocation->allocation_status == '1' || $subscription_allocation->allocation_status == '0'){
                    $per_coin_in_rs = per_coin_in_rs;
                    $subscription_price = $branch->subscription_price != "" ? (float)$branch->subscription_price : 0.00;
                    $coin_balance = $branch->coin_balance != "" ? (float)$branch->coin_balance : 0.00;
                    $coin_balance_in_rs = $coin_balance * $per_coin_in_rs;
                    $pending_amount = $branch->pending_due_amount != "" ? (float)$branch->pending_due_amount : 0.00;
                    $setup = $this->Master_model->get_backend_setups();
                    $array = array(
                        'subscription_name'     =>  $branch->subscription_name,
                        'subscription_start'    =>  $branch->subscription_start,
                        'subscription_end'      =>  $branch->subscription_end,
                        'subscription_price'    =>  $subscription_price,
                        'pending_amount'        =>  $pending_amount,
                        'coin_balance'          =>  $coin_balance,
                        'coin_balance_in_rs'    =>  $coin_balance_in_rs,
                        'per_coin_in_rs'        =>  $per_coin_in_rs,
                        'is_gst_applicable'     =>  $branch->is_gst_applicable,
                        'gst_no'                =>  $branch->gst_no,
                        'gst_rate'              =>  $branch->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0,
                        'igst_rate'             =>  0,
                        // 'igst_rate'             =>  $branch->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0,
                        'cgst_rate'             =>  $branch->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0,
                        'sgst_rate'             =>  $branch->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0
                    );
                    echo json_encode($array);
                }else{
                    echo '0';
                }
            }else{
                echo '0';
            }
        }else{
            echo '0';
        }
    }
    public function set_branch_payment(){
        $branch = $this->input->post('branch') != "" ? $this->input->post('branch') : $this->input->post('selected_branch');
        $salon = $this->input->post('salon') != "" ? $this->input->post('salon') : $this->input->post('selected_salon');

        $this->db->where('id',$branch);
        $this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_branch')->row();
        if(!empty($result)){
            $opening_due = $result->pending_due_amount != "" ? (float)$result->pending_due_amount : 0.00;
            $closing_due = $opening_due - (float)$this->input->post('now_payment');
            $coin_earn_on_every_download = $this->input->post('per_coin_in_rs');
            $coin_balance_used = $this->input->post('coin_balance_used') != "" ? (int)$this->input->post('coin_balance_used') : 0;
            $coin_balance_used_in_rs = $this->input->post('coin_balance_used_in_rs') != "" ? (float)$this->input->post('coin_balance_used_in_rs') : 0.00;
            $closing_due = $closing_due - $coin_balance_used_in_rs;

            $data = array(
                'branch_id'     =>  $branch,
                'salon_id'      =>  $salon,
                'payment_type'  =>  '0',
                'payment_amount'=>  $this->input->post('now_payment'),

                'is_gst_applicable' =>  $this->input->post('is_gst_applicable'),
                'branch_gst_no'     =>  $this->input->post('gst_no'),
                'gst'               =>  $this->input->post('gst_hidden'),
                'gst_rate'          =>  $this->input->post('gst_rate'),
                'igst'              =>  $this->input->post('igst_hidden'),
                'igst_rate'         =>  $this->input->post('igst_rate'),
                'cgst'              =>  $this->input->post('cgst_hidden'),
                'cgst_rate'         =>  $this->input->post('cgst_rate'),
                'sgst'              =>  $this->input->post('sgst_hidden'),
                'sgst_rate'         =>  $this->input->post('sgst_rate'),
                'final_amount'      =>  $this->input->post('final_payment_hidden'),

                'coin_balance_used'             =>  $this->input->post('coin_balance_used'),
                'coin_balance_used_in_rs'       =>  $this->input->post('coin_balance_used_in_rs'),
                'per_coin_rs_value'             =>  $coin_earn_on_every_download,

                'payment_date'                  =>  date('Y-m-d',strtotime($this->input->post('payment_date'))),
                'remark'                        =>  $this->input->post('payment_remark'),
                'subscription_id'               =>  $result->subscription_id,
                'subscription_allocation_id'    =>  $result->subscription_allocation_id,
                'subscription_price'            =>  $result->subscription_price,
                'payment_entry_by'              =>  $this->session->userdata('admin_id'),
                'opening_due'   =>  $opening_due,
                'closing_due'   =>  $closing_due,
                'created_on'    =>  date('Y-m-d H:i:s')
            );
            echo '<pre>'; print_r($data); exit;
            $this->db->insert('tbl_branch_payment_details',$data);
            $branch_payment_id = $this->db->insert_id();
            
            $total_count = $this->get_year_booking_count(date('Y-m-d H:i:s'),$branch_payment_id);
            $year = date('Y');
            $month = date('m');

            if ((int)$month >= 4) {
                $fy_start = (int)$year % 100;
                $fy_end = $fy_start + 1;
            } else {
                $fy_end = (int)$year % 100;
                $fy_start = $fy_end - 1;
            }
            $financial_year = 'FY' . sprintf('%02d', $fy_start) . '-' . sprintf('%02d', $fy_end);
            $count_formatted = sprintf('%04d', $total_count + 1);
            $invoice_id = 'NAP-GST-' . $financial_year . '-' . $count_formatted;
            $invoice_id_data = array(
                'invoice_id' => $invoice_id
            );

            $this->db->where('id',$branch_payment_id);
            $this->db->update('tbl_branch_payment_details',$invoice_id_data);

            $this->db->where('id',$result->subscription_allocation_id);
            $subscription_allocation = $this->db->get('tbl_branch_subscription_allocation')->row();
            if(!empty($subscription_allocation)){
                $allocation_paid = (float)$subscription_allocation->paid_amount;
                $allocation_pending = (float)$subscription_allocation->due_amount;

                $new_paid = $allocation_paid + (float)$this->input->post('now_payment');
                $new_pending = $allocation_pending - (float)$this->input->post('now_payment');

                if($new_pending <= 0.00){
                    $sub_allocation_data = array(
                        'paid_amount'   =>  $new_paid,
                        'due_amount'    =>  $new_pending,
                        'payment_status'=>  '1',
                        'allocation_status'=>  '1'
                    );
                }else{
                    $sub_allocation_data = array(
                        'paid_amount'   =>  $new_paid,
                        'due_amount'    =>  $new_pending,
                        'allocation_status'=>  '1'
                    );
                }
                $this->db->where('id',$result->subscription_allocation_id);
                $this->db->update('tbl_branch_subscription_allocation',$sub_allocation_data);
            }

            $branch_data = array(
                'pending_due_amount'    =>  $closing_due
            );
            $this->db->where('id',$result->id);
            $this->db->update('tbl_branch',$branch_data);

            if($coin_balance_used > 0){
                $coin_insert_data = array(
                    'branch_id'     =>  $branch,
                    'salon_id'      =>  $salon,
                    'entry_type'    =>  '0',
                    'debit_type'    =>  '0',
                    'branch_payment_id'   =>  $branch_payment_id,
                    'coin_amount'   =>  $coin_balance_used,
                );
                $this->Salon_model->insert_salon_coin_entry($coin_insert_data);
            }

            $salon_id = $result->salon_id;
            $branch_id = $result->id;
            $type = '2';
            $title = 'Subscription Payment Received';
            $desc = 'Received subscription payment of Rs. ' . $this->input->post('now_payment') . '' . (($closing_due > 0) ? ' (New Due Amount: . ' . $closing_due . ')' : '');
            $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

            return true;
        }else{
            return false;
        }
    }
    public function get_branch_log($branch){
        if($branch != ""){
            $this->db->select('tbl_branch_log.*,tbl_employee.full_name');
            $this->db->join('tbl_employee','tbl_employee.id=tbl_branch_log.activity_by','left');
            $this->db->where('tbl_branch_log.is_deleted','0');
            $this->db->where('tbl_branch_log.branch_id',$branch);
            $this->db->order_by('tbl_branch_log.activity_on','desc');
            $result = $this->db->get('tbl_branch_log')->result();
            return $result;
        }else{
            return array();
        }
    }
    public function get_branch_wp_coin_history($branch){
        if($branch != ""){
            $this->db->select('tbl_salon_coin_history.*');
            $this->db->where('tbl_salon_coin_history.is_deleted','0');
            $this->db->where('tbl_salon_coin_history.branch_id',$branch);
            $this->db->order_by('tbl_salon_coin_history.id','desc');
            $result = $this->db->get('tbl_salon_coin_history')->result();
            return $result;
        }else{
            return array();
        }
    }
    public function get_branch_coin_history($branch){
        if($branch != ""){
            $this->db->select('tbl_salon_coin_history.*');
            $this->db->where('tbl_salon_coin_history.is_deleted','0');
            $this->db->where('tbl_salon_coin_history.branch_id',$branch);
            $this->db->order_by('tbl_salon_coin_history.id','desc');
            $result = $this->db->get('tbl_salon_coin_history')->result();
            return $result;
        }else{
            return array();
        }
    }
    public function get_branch_subscription_history($branch){
        if($branch != ""){
            $this->db->select('tbl_branch_subscription_allocation.*');
            $this->db->where('tbl_branch_subscription_allocation.branch_id',$branch);
            $this->db->order_by('tbl_branch_subscription_allocation.id','desc');
            $result = $this->db->get('tbl_branch_subscription_allocation')->result();
            return $result;
        }else{
            return array();
        }
    }
    public function set_branch_log($branch,$salon,$type,$desc,$title){
        $sub_allocation_data = array(
            'branch_id'     =>  $branch,
            'salon_id'      =>  $salon,
            'type'          =>  $type,
            'description'   =>  $desc,
            'title'         =>  $title,
            'activity_on'   =>  date('Y-m-d H:i:s'),
            'activity_by'   =>  $this->session->userdata('admin_id'),
            'created_on'    =>  date('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_branch_log',$sub_allocation_data);
        return true;
    }
    public function set_branch_money_back(){
        $this->db->where('id',$this->input->post('branch'));
        $this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_branch')->row();
        if(!empty($result)){   
            $is_money_back = $this->Admin_model->get_is_money_back_applicable($result->id);      
            if($is_money_back){   
                $this->db->where('id',$result->subscription_allocation_id);
                $subscription_allocation = $this->db->get('tbl_branch_subscription_allocation')->row();
                if(!empty($subscription_allocation)){
                    $sub_allocation_data = array(
                        'money_back_by'     =>  $this->session->userdata('admin_id'),
                        'money_back_remark' =>  $this->input->post('remark'),
                        'money_back_amount' =>  $this->input->post('money_back_amount'),
                        'allocation_status' =>  '4',
                        'money_back_on'     =>  date('Y-m-d H:i:s')
                    );
                    $this->db->where('id',$result->subscription_allocation_id);
                    $this->db->update('tbl_branch_subscription_allocation',$sub_allocation_data);
                    
                    $sub_data = array(
                        'subscription_id'  		    =>  null, 
                        'subscription_price'        =>  '',
                        'subscription_validity'     =>  '',
                        'subscription_start'        =>  null,
                        'subscription_end'          =>  null,
                        'pending_due_amount'        =>  ''
                    );
                    $this->db->where('id',$result->id);
                    $this->db->update('tbl_branch',$sub_data);

                    $salon_id = $result->salon_id;
                    $branch_id = $result->id;
                    $type = '3';
                    $title = 'Money Back Payment Done';
                    $desc = 'Money back payment of Rs. ' . $this->input->post('money_back_amount') . ' is done and active subscription is closed';
                    $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);

                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function get_is_money_back_applicable($id){
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.id',$id);
		$result = $this->db->get('tbl_branch');
		$single = $result->row();	
        if(!empty($single)){
            $feature_slugs = $this->Salon_model->get_subscription_slugs($single->subscription_id);
            $setup = $this->Master_model->get_backend_setups();	
            if(!empty(array_intersect(['money-back-1000'], $feature_slugs))){
                $req_customers = 1000;
                if(!empty($setup) && $setup->money_back_1000_value != ""){
                    $req_customers = (int)$setup->money_back_1000_value;
                }
            }elseif(!empty(array_intersect(['money-back-1500'], $feature_slugs))){
                $req_customers = 1500;
                if(!empty($setup) && $setup->money_back_1500_value != ""){
                    $req_customers = (int)$setup->money_back_1500_value;
                }
            }elseif(!empty(array_intersect(['money-back-2000'], $feature_slugs))){
                $req_customers = 2000;
                if(!empty($setup) && $setup->money_back_2000_value != ""){
                    $req_customers = (int)$setup->money_back_2000_value;
                }
            }elseif(!empty(array_intersect(['money-back-2500'], $feature_slugs))){
                $req_customers = 2500;
                if(!empty($setup) && $setup->money_back_2500_value != ""){
                    $req_customers = (int)$setup->money_back_2500_value;
                }
            }else{
                return false;
            }

            $customers = $this->get_branch_customers_for_moneyback($single->id,$single->salon_id);
            if($customers >= $req_customers){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function get_branch_customers_for_moneyback($branch,$salon){
		$this->db->select('tbl_booking_services_details.*');		
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->where('tbl_booking_services_details.branch_id',$branch);
        $this->db->where('tbl_booking_services_details.salon_id',$salon);
        $this->db->where('tbl_salon_customer.branch_id',$branch);
        $this->db->where('tbl_salon_customer.salon_id',$salon);
        $this->db->where('tbl_salon_customer.registered_from','1');
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $this->db->where('tbl_booking_services_details.service_status','1');
        $this->db->group_by('tbl_booking_services_details.customer_name');
        $result = $this->db->get('tbl_booking_services_details')->num_rows();
        return $result;
    }
	public function get_saloon_customize_messages_ajx($length, $start, $search){
		$this->db->select('tbl_salon_customize_messages.*,tbl_salon.salon_name,tbl_branch.branch_name');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_salon_customize_messages.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_salon_customize_messages.branch_id','left');
		if($search !=""){
			$this->db->or_like('tbl_salon_customize_messages.message',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        $this->db->where('tbl_salon_customize_messages.is_deleted','0');
		$this->db->order_by('tbl_salon_customize_messages.added_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_salon_customize_messages');
		return $result->result();		
	}
	public function get_saloon_customize_messages_ajx_count($search){
		$this->db->select('tbl_salon_customize_messages.*,tbl_salon.salon_name,tbl_branch.branch_name');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_salon_customize_messages.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_salon_customize_messages.branch_id','left');
		if($search !=""){
			$this->db->or_like('tbl_salon_customize_messages.message',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        $this->db->where('tbl_salon_customize_messages.is_deleted','0');
		$this->db->order_by('tbl_salon_customize_messages.added_on','DESC');
		$result = $this->db->get('tbl_salon_customize_messages');
		return $result->num_rows();
	}

    
	public function get_saloon_addon_requests_ajx($length, $start, $search){
		$this->db->select('tbl_wp_addon_requests.*,tbl_salon.salon_name,tbl_branch.branch_name,tbl_branch.subscription_id,tbl_branch.subscription_allocation_id');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_wp_addon_requests.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_wp_addon_requests.branch_id','left');
		if($search !=""){
			$this->db->or_like('tbl_wp_addon_requests.remark',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_name',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_price',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_qty',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        $this->db->where('tbl_wp_addon_requests.is_deleted','0');
		$this->db->order_by('tbl_wp_addon_requests.created_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_wp_addon_requests');
		return $result->result();		
	}
	public function get_saloon_addon_requests_ajx_count($search){
		$this->db->select('tbl_wp_addon_requests.*,tbl_salon.salon_name,tbl_branch.branch_name,tbl_branch.subscription_id,tbl_branch.subscription_allocation_id');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_wp_addon_requests.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_wp_addon_requests.branch_id','left');
		if($search !=""){
			$this->db->or_like('tbl_wp_addon_requests.remark',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_name',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_price',$search);
			$this->db->or_like('tbl_wp_addon_requests.plan_qty',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        $this->db->where('tbl_wp_addon_requests.is_deleted','0');
		$this->db->order_by('tbl_wp_addon_requests.created_on','DESC');
		$result = $this->db->get('tbl_wp_addon_requests');
		return $result->num_rows();
	}
	public function get_branch_payments_ajx($length, $start, $search){
		$this->db->select('tbl_branch_payment_details.*,tbl_employee.full_name,tbl_salon.salon_name,tbl_branch.branch_name,tbl_branch.is_deleted as branch_is_deleted');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch_payment_details.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_branch_payment_details.branch_id','left');
		$this->db->join('tbl_employee','tbl_employee.id = tbl_branch_payment_details.payment_entry_by','left');

        if($this->input->post('branch') != ""){
            $this->db->where('tbl_branch_payment_details.branch_id',$this->input->post('branch'));
        }
        if($this->input->post('payment_type') != ""){
            $this->db->where('tbl_branch_payment_details.payment_type',$this->input->post('payment_type'));
        }
        if($this->input->post('from_date') != ""){
            $this->db->where('DATE(tbl_branch_payment_details.payment_date) >=', date('Y-m-d',strtotime($this->input->post('from_date'))));
        }
        if($this->input->post('to_date') != ""){
            $this->db->where('DATE(tbl_branch_payment_details.payment_date) <=', date('Y-m-d',strtotime($this->input->post('to_date'))));
        }

		if($search !=""){
			$this->db->or_like('tbl_branch_payment_details.payment_amount',$search);
			$this->db->or_like('tbl_branch_payment_details.payment_date',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
			$this->db->or_like('tbl_employee.full_name',$search);
		}	
        $this->db->where('tbl_branch_payment_details.is_deleted','0');
		$this->db->order_by('tbl_branch_payment_details.created_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_branch_payment_details');
		return $result->result();		
	}
	public function get_branch_payments_ajx_count($search){
		$this->db->select('tbl_branch_payment_details.*,tbl_employee.full_name,tbl_salon.salon_name,tbl_branch.branch_name,tbl_branch.is_deleted as branch_is_deleted');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch_payment_details.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_branch_payment_details.branch_id','left');
		$this->db->join('tbl_employee','tbl_employee.id = tbl_branch_payment_details.payment_entry_by','left');

        if($this->input->post('branch') != ""){
            $this->db->where('tbl_branch_payment_details.branch_id',$this->input->post('branch'));
        }
        if($this->input->post('payment_type') != ""){
            $this->db->where('tbl_branch_payment_details.payment_type',$this->input->post('payment_type'));
        }
        if($this->input->post('from_date') != ""){
            $this->db->where('DATE(tbl_branch_payment_details.payment_date) >=', date('Y-m-d',strtotime($this->input->post('from_date'))));
        }
        if($this->input->post('to_date') != ""){
            $this->db->where('DATE(tbl_branch_payment_details.payment_date) <=', date('Y-m-d',strtotime($this->input->post('to_date'))));
        }

		if($search !=""){
			$this->db->or_like('tbl_branch_payment_details.payment_amount',$search);
			$this->db->or_like('tbl_branch_payment_details.payment_date',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
			$this->db->or_like('tbl_employee.full_name',$search);
		}	
        $this->db->where('tbl_branch_payment_details.is_deleted','0');
		$this->db->order_by('tbl_branch_payment_details.created_on','DESC');
		$result = $this->db->get('tbl_branch_payment_details');
		return $result->num_rows();
	}
    
	public function get_cron_report_ajx($length, $start, $search){
		$this->db->select('tbl_cron_reports.*');		

        if($this->input->post('type') != ""){
            $this->db->where('tbl_cron_reports.type',$this->input->post('type'));
        }
        if($this->input->post('from_date') != ""){
            $this->db->where('DATE(tbl_cron_reports.created_on) >=', date('Y-m-d',strtotime($this->input->post('from_date'))));
        }
        if($this->input->post('to_date') != ""){
            $this->db->where('DATE(tbl_cron_reports.created_on) <=', date('Y-m-d',strtotime($this->input->post('to_date'))));
        }

		if($search !=""){
			$this->db->or_like('tbl_cron_reports.description',$search);
			$this->db->or_like('tbl_cron_reports.response',$search);
		}	

        $this->db->where('tbl_cron_reports.is_deleted','0');
		$this->db->order_by('tbl_cron_reports.created_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_cron_reports');
		return $result->result();		
	}
	public function get_cron_report_ajx_count($search){
		$this->db->select('tbl_cron_reports.*');		

        if($this->input->post('type') != ""){
            $this->db->where('tbl_cron_reports.type',$this->input->post('type'));
        }
        if($this->input->post('from_date') != ""){
            $this->db->where('DATE(tbl_cron_reports.created_on) >=', date('Y-m-d',strtotime($this->input->post('from_date'))));
        }
        if($this->input->post('to_date') != ""){
            $this->db->where('DATE(tbl_cron_reports.created_on) <=', date('Y-m-d',strtotime($this->input->post('to_date'))));
        }

		if($search !=""){
			$this->db->or_like('tbl_cron_reports.description',$search);
			$this->db->or_like('tbl_cron_reports.response',$search);
		}	
        
        $this->db->where('tbl_cron_reports.is_deleted','0');
		$this->db->order_by('tbl_cron_reports.created_on','DESC');
		$result = $this->db->get('tbl_cron_reports');
		return $result->num_rows();	
	}
    public function get_year_booking_count($date,$id){
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        if ((int)$month >= 4) {
            $from_date = date('Y-04-01', strtotime($date));
            $to_date = date(($year + 1) . '-03-31');
        } else {
            $from_date = date(($year - 1) . '-04-01');
            $to_date = date($year . '-03-31', strtotime($date));
        }

		$this->db->select('tbl_branch_payment_details.*,tbl_employee.full_name,tbl_salon.salon_name,tbl_branch.salon_number,tbl_branch.email,tbl_branch.branch_name,tbl_branch.is_deleted as branch_is_deleted');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch_payment_details.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_branch_payment_details.branch_id','left');
		$this->db->join('tbl_employee','tbl_employee.id = tbl_branch_payment_details.payment_entry_by','left');
        $this->db->where('tbl_branch_payment_details.created_on >=', $from_date);
        $this->db->where('tbl_branch_payment_details.created_on <=', $to_date);
        $this->db->where('tbl_branch_payment_details.id <',$id);
        $this->db->where('tbl_branch_payment_details.is_deleted','0');
		$this->db->order_by('tbl_branch_payment_details.created_on','DESC');
		$result = $this->db->get('tbl_branch_payment_details');
		return $result->num_rows();
    }
	public function get_single_payment_details($id){
		$this->db->select('tbl_branch_payment_details.*,tbl_employee.full_name,tbl_salon.salon_name,tbl_branch.salon_number,tbl_branch.email,tbl_branch.branch_name,tbl_branch.is_deleted as branch_is_deleted');		
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch_payment_details.salon_id','left');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_branch_payment_details.branch_id','left');
		$this->db->join('tbl_employee','tbl_employee.id = tbl_branch_payment_details.payment_entry_by','left');
        $this->db->where('tbl_branch_payment_details.id',$id);
        $this->db->where('tbl_branch_payment_details.is_deleted','0');
		$this->db->order_by('tbl_branch_payment_details.created_on','DESC');
		$result = $this->db->get('tbl_branch_payment_details');
		return $result->row();
	}
    public function get_salon_rule_update_requestes($branch,$status){
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon.salon_name, tbl_branch.branch_name');		
        $this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
		$this->db->order_by('tbl_booking_rule_update_requests.submitted_on','DESC');
        if($status != ""){
		    $this->db->where('tbl_booking_rule_update_requests.approval_status',$status);
        }
        if($branch != ""){
		    $this->db->where('tbl_booking_rule_update_requests.branch_id',$branch);
        }
		$result = $this->db->get('tbl_booking_rule_update_requests');
		return $result->result();
    }
	public function get_saloon_rule_update_requests_ajx($length, $start, $search){
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon.salon_name, tbl_branch.branch_name');		
        $this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
		if($search !=""){
			$this->db->or_like('tbl_booking_rule_update_requests.booking_rule_field',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.tbl_booking_rule_column',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.submitted_on',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
		$this->db->order_by('tbl_booking_rule_update_requests.submitted_on','DESC');
		$this->db->group_by('tbl_booking_rule_update_requests.branch_id');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_booking_rule_update_requests');
		return $result->result();		
	}
	public function get_saloon_rule_update_requests_ajx_count($search){
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon.salon_name, tbl_branch.branch_name');				
		$this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
		if($search !=""){
			$this->db->or_like('tbl_booking_rule_update_requests.booking_rule_field',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.tbl_booking_rule_column',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.submitted_on',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
		$this->db->order_by('tbl_booking_rule_update_requests.submitted_on','DESC');
		$this->db->group_by('tbl_booking_rule_update_requests.branch_id');
		$result = $this->db->get('tbl_booking_rule_update_requests');
		return $result->num_rows();
	}
    
	public function get_saloon_branch_rule_update_requests_ajx($length, $start, $search){
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon_type.type as store_type_text , tbl_salon.salon_name, tbl_branch.branch_name');
		$this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
        $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rule_update_requests.store_type');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');

        if($this->input->post('branch') != ""){
            $this->db->where('tbl_booking_rule_update_requests.branch_id',$this->input->post('branch'));
        }
        if($this->input->post('status') != ""){
            $this->db->where('tbl_booking_rule_update_requests.approval_status',$this->input->post('status'));
        }

		if($search !=""){
			$this->db->or_like('tbl_salon_type.type',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.booking_rule_field',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.tbl_booking_rule_column',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.submitted_on',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        if($this->input->post('status') != ""){
		    $this->db->order_by('tbl_booking_rule_update_requests.updated_on','DESC');
        }else{
		    $this->db->order_by('tbl_booking_rule_update_requests.submitted_on','DESC');
        }
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_booking_rule_update_requests');
		return $result->result();		
	}
	public function get_saloon_branch_rule_update_requests_ajx_count($search){
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon_type.type as store_type_text , tbl_salon.salon_name, tbl_branch.branch_name');
		$this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
        $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rule_update_requests.store_type');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');

        if($this->input->post('branch') != ""){
            $this->db->where('tbl_booking_rule_update_requests.branch_id',$this->input->post('branch'));
        }
        if($this->input->post('status') != ""){
            $this->db->where('tbl_booking_rule_update_requests.approval_status',$this->input->post('status'));
        }

		if($search !=""){
			$this->db->or_like('tbl_salon_type.type',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.booking_rule_field',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.tbl_booking_rule_column',$search);
			$this->db->or_like('tbl_booking_rule_update_requests.submitted_on',$search);
			$this->db->or_like('tbl_salon.salon_name',$search);
			$this->db->or_like('tbl_branch.branch_name',$search);
		}	
        if($this->input->post('status') != ""){
		    $this->db->order_by('tbl_booking_rule_update_requests.updated_on','DESC');
        }else{
		    $this->db->order_by('tbl_booking_rule_update_requests.submitted_on','DESC');
        }
		$result = $this->db->get('tbl_booking_rule_update_requests');
		return $result->num_rows();
	}
    public function get_salon_rule_update_requests_ajx(){
        $id = $this->input->post('id');
        $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon_type.type as store_type_text , tbl_salon.salon_name, tbl_branch.branch_name');
		$this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rule_update_requests.store_type');
		$this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
		$this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
        $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
        $this->db->where('tbl_booking_rule_update_requests.branch_id',$id);
        $result = $this->db->get('tbl_booking_rule_update_requests')->result();
        if(!empty($result)){          
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Rule Type</th>
                    <th>Rule</th>
                    <th>New Value</th>
                    <th>Old Value</th>
                    <th>Submitted On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $k = 1;
                    if(!empty($result)){
                        foreach($result as $data){
                ?>
                <tr>
                    <td><?=$k++;?></td>
                    <td><?=$data->store_type_text;?></td>
                    <td>
                        <?php 
                            $fields = explode('@@@', $data->booking_rule_field); 
                            $count = count($fields);
                            for ($i = 0; $i < $count; $i++) {
                                echo ($i + 1) . '. ' . $fields[$i] . '<br>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            $fields = explode('@@@', $data->change_to); 
                            $count = count($fields);
                            for ($i = 0; $i < $count; $i++) {
                                echo ($i + 1) . '. ' . $fields[$i] . '<br>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            $fields = explode('@@@', $data->change_from); 
                            $count = count($fields);
                            for ($i = 0; $i < $count; $i++) {
                                echo ($i + 1) . '. ' . $fields[$i] . '<br>';
                            }
                        ?>
                    </td>
                    <td><?=date('d-m-Y h:i A',strtotime($data->submitted_on));?></td>
                    <td>
                        <?php
                            if($data->approval_status == '0'){
                                echo '<label class="label label-warning">Pending</label>';
                            }elseif($data->approval_status == '1'){
                                echo '<label class="label label-success">Approved</label>';
                                if($data->accepted_on != ""){
                                    echo '<br>On: '.date('d-m-Y h:i A',strtotime($data->accepted_on));
                                }
                            }elseif($data->approval_status == '2'){
                                echo '<label class="label label-danger">Rejected</label>';
                                if($data->rejected_on != ""){
                                    echo '<br>On: '.date('d-m-Y h:i A',strtotime($data->rejected_on));
                                }
                            }else{
                                echo '-';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($data->approval_status == '0'){
                                echo '<button class="btn btn-success" id="response_button_'.$data->id.'" onclick="setResponse('.$data->id.', \'1\')">Approve</button>';
                                echo '<button class="btn btn-danger" id="response_button_'.$data->id.'" onclick="setResponse('.$data->id.', \'2\')">Reject</button>';
                            }else{
                                echo '-';
                            }
                        ?>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        <?php
        }
    }
    public function get_customize_message_ajx(){
        $id = $this->input->post('id');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){            
            $message = htmlspecialchars($row->message, ENT_QUOTES, 'UTF-8');
            $message = preg_replace('/\*([^\*]+)\*/', '<strong>$1</strong>', $message);
            $message = preg_replace('/_([^_]+)_/', '<em>$1</em>', $message);
            $message = preg_replace('/~([^~]+)~/', '<del>$1</del>', $message);
            $message = preg_replace('/`([^`]+)`/', '<code>$1</code>', $message);
            
            $message = str_replace('%0a', '<br>', $message);
        ?>
            <p><?=$message;?></p>
            <label style="color:#73879C; font-size: 11px;margin-top: 10px;font-weight: unset;">On: <?=date('d M, Y h:i A',strtotime($row->created_on));?></label>
        <?php
        }
    }
    public function customize_message_response(){
        $id = $this->input->post('hidden_id');
        $remark = $this->input->post('remark');
        $type = $this->input->post('type');

        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){
            if($type == '1'){
                $data = array(
                    'approval_on'       =>  date("Y-m-d H:i:s"),
                    'approval_remark'   =>  $remark,
                    'approval_status'   =>  '1',
                );
                $this->db->where('id',$row->id);
                $this->db->update('tbl_salon_customize_messages',$data);
            }elseif($type == '2'){
                $data = array(
                    'rejected_on'       =>  date("Y-m-d H:i:s"),
                    'reject_remark'     =>  $remark,
                    'approval_status'   =>  '2',
                );
                $this->db->where('id',$row->id);
                $this->db->update('tbl_salon_customize_messages',$data);
            }
            return 0;
        }else{
            return 1;
        }
    }
    public function get_customize_message_response_form_ajx(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');

        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){
            if($type == '1'){
                $style="background-color:#4cae4c;";
                $text = 'Approve';
            }elseif($type == '2'){
                $style="background-color:#d43f3a;";
                $text = 'Reject';
            }else{
                $style="";
                $text = '';
            }
        ?>
        <form method="post" name="add_message_form" id="add_message_form" enctype="multipart/form-data" action="<?=base_url();?>customize_message_response">        
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <label style="display:block;">Enter <?=$text;?> Remark*</label>                   
                    <textarea class="form-control" id="remark" name="remark"></textarea>  
                    <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $row->id; ?>">                             
                    <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">                             
                </div>
            </div>   
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                    <button type="submit" id="submit_message_button" class="btn btn-primary" style="<?=$style;?>margin-top:25px;">Submit</button>
                </div>
            </div>
        </form>
        <script>
            $('#add_message_form').validate({
                ignore: [],
                rules: {
                    remark: {
                        required: true
                    }
                },
                messages: {
                    remark: "Please enter remark!"
                },
                submitHandler: function(form) {
                    if (confirm("Are you sure you want to submit form?")) {
                        form.submit();
                    }
                }
            });
        </script>
        <?php
        }
    }
    public function get_customize_message_remark_ajx(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){
            if($type == '0'){
                if($row->remark != ""){
                    $remark = $row->remark;
                    $added_on = $row->added_on;
                }else{
                    $remark = 'Not Available';
                    $added_on = '';
                }
            }elseif($type == '1'){
                $remark = $row->approval_remark;
                $added_on = $row->approval_on;
            }elseif($type == '2'){
                $remark = $row->reject_remark;
                $added_on = $row->rejected_on;
            }elseif($type == '3'){
                $remark = $row->cancelled_remark;
                $added_on = $row->cancelled_on;
            }else{
                $remark = '-';
                $added_on = '';
            }
        ?>
            <p><?=$remark;?></p>
            <label style="color:#73879C; font-size: 11px;margin-top: 10px;font-weight: unset;"><?=$added_on != "" ? date('d M, Y h:i A',strtotime($added_on)) : '';?></label>
        <?php
        }
    }
    public function get_all_salon_branch_list() {
        $this->db->select('tbl_branch.*, tbl_salon.is_gst_applicable,tbl_salon.gst_no,tbl_salon.salon_name');
        $this->db->join('tbl_salon', ' tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->order_by('tbl_branch.id', 'DESC'); 
        $result = $this->db->get('tbl_branch'); 
        return $result->result();
    }
    public function get_low_coin_balance_branch() {
        $setup = $this->Master_model->get_backend_setups();
        $value = !empty($setup) ? (int)$setup->wp_low_qty_value : 25;

        $this->db->select('tbl_branch.*, tbl_salon.is_gst_applicable, tbl_salon.gst_no, tbl_salon.salon_name');
        $this->db->from('tbl_branch');
        $this->db->join('tbl_salon', 'tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->where('tbl_branch.include_wp', '1');
        // $this->db->where('tbl_branch.current_wp_coins_balance <= ' . (int)$value, NULL, FALSE);
        $this->db->where('tbl_branch.current_wp_coins_balance <= (tbl_branch.wp_coins_qty * ' . (int)$value . ' / 100)', NULL, FALSE);
        $this->db->order_by('tbl_branch.id', 'DESC');
        
        $result = $this->db->get();
        return $result->result();
    }
    public function get_branch_subscription_renewals() {
        $from_date = '';
        if(isset($_GET['from_date']) && $_GET['from_date'] != ""){
            $from_date = $_GET['from_date'];
        }

        $to_date = '';
        if(isset($_GET['to_date']) && $_GET['to_date'] != ""){
            $to_date = $_GET['to_date'];
        }

        if($from_date == ""){
            $from_date = date('Y-m-01');
        }
        if($to_date == ""){
            $to_date = date('Y-m-t');
        }

        $this->db->select('tbl_branch.*, tbl_salon.is_gst_applicable, tbl_salon.gst_no, tbl_salon.salon_name');
        $this->db->from('tbl_branch');
        $this->db->join('tbl_salon', 'tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        
        if($from_date != ""){
            $this->db->where('DATE(tbl_branch.subscription_end) >=', date('Y-m-d',strtotime($from_date)));
        }

        if($to_date != ""){
            $this->db->where('DATE(tbl_branch.subscription_end) <=', date('Y-m-d',strtotime($to_date)));
        }

        $this->db->order_by('tbl_branch.id', 'DESC');        
        $result = $this->db->get();
        return $result->result();
    }
    public function get_all_branch_list() {
        $this->db->select('tbl_branch.*, tbl_salon.is_gst_applicable,tbl_salon.gst_no,tbl_salon.salon_name');
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
    public function get_all_salon_customers($salon_id,$branch_id) {
        $this->db->select('tbl_salon_customer.*, tbl_branch.branch_name, tbl_salon.salon_name');
        $this->db->join('tbl_salon', ' tbl_salon.id = tbl_salon_customer.salon_id');
        $this->db->join('tbl_branch', ' tbl_branch.id = tbl_salon_customer.branch_id');
        if($salon_id != ""){
            $this->db->where('tbl_salon_customer.salon_id', $salon_id);
        }
        if($branch_id != ""){
            $this->db->where('tbl_salon_customer.branch_id', $branch_id);
        }
        $this->db->where('tbl_salon_customer.is_deleted', '0');
        $this->db->order_by('tbl_salon_customer.id', 'DESC'); 
        $result = $this->db->get('tbl_salon_customer'); 
        return $result->result();
    } 
    public function get_single_branch(){
        $this->db->select('tbl_branch.*, tbl_salon.salon_name');
        $this->db->join('tbl_salon', ' tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.id',$this->uri->segment(3));
        $result = $this->db->get('tbl_branch');
        return $result->row();
    }
    public function get_single_branch_profile(){
        $this->db->select('tbl_branch.*,tbl_store_profile.store_logo,tbl_store_profile.account_holder_name,tbl_store_profile.bank_name,tbl_store_profile.account_number,tbl_store_profile.account_type,tbl_store_profile.bank_branch_name,tbl_store_profile.ifsc');
        $this->db->join('tbl_store_profile','tbl_store_profile.branch_id = tbl_branch.id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->where('tbl_branch.id',$this->uri->segment(3));
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
	public function get_branch_details($id){
		$this->db->select('tbl_branch.*, tbl_salon.salon_name,tbl_salon.gst_no,tbl_salon.is_gst_applicable');
		$this->db->join('tbl_salon','tbl_salon.id = tbl_branch.salon_id');
		$this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_branch.id',$id);
        $result = $this->db->get('tbl_branch');
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
    public function get_branch_gallary($branch){
        $this->db->select('tbl_branch_gallary.*,tbl_category_type.category_type ,tbl_category_type.id as category_id');
        $this->db->join('tbl_category_type','tbl_category_type.id=tbl_branch_gallary.category');
        $this->db->where('tbl_branch_gallary.is_deleted','0');
        $this->db->where('tbl_branch_gallary.branch_id',$branch);
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
            return 1;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_employee',$data);
            $this->session->set_flashdata('success','Success ! Record updated successfully');
            return 0;
        }
    }
    public function update_profile($aadhar_front,$aadhar_back,$profile_photo,$pan_file){
        $this->db->where('id',$this->session->userdata('admin_id'));
        $exist = $this->db->get('tbl_employee')->row();
        if(!empty($exist)){
            $old_password = $exist->password;
            $old_email = $exist->email;
            $data=array(
                'full_name'             => $this->input->post('full_name'),
                'phone'                 => $this->input->post('phone'),
                'family_phone'          => $this->input->post('family_phone'),
                'email'                 => $this->input->post('email'),
                'password'              => $this->input->post('password'),
                'address'               => $this->input->post('address'),
                'date_of_birth'         => $this->input->post('date_of_birth'),
                'pan'                   => $this->input->post('pan'),
                'aadhar_number'         => $this->input->post('aadhar_number'),
                'education'         	=> $this->input->post('education'),
                'college_name'          => $this->input->post('college_name'),
                'passing_year'          => $this->input->post('passing_year'),
                'percentage'            => $this->input->post('percentage'),
                'aadhar_front'          => $aadhar_front,
                'aadhar_back'           => $aadhar_back,
                'profile_photo'         => $profile_photo,
                'pan_file'              => $pan_file,
            );
            $this->db->where('id',$exist->id);
            $this->db->update('tbl_employee',$data);

            if($old_password != $this->input->post('password') || $old_email != $this->input->post('email')){
                $this->session->sess_destroy();
				$this->session->set_flashdata('message','You have changed the password, please login again with credentials');
                redirect('login');
            }
            return true;
        }else{
            return false;
        }
    }
    public function get_all_employee(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_employee');
        return $result->result();
    } 

    public function get_all_employee_list(){
        $this->db->where('user_type','1');
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
    public function get_feature_subscriptions($feature){
        $this->db->where('is_deleted','0');
		$this->db->where('find_in_set("'.$feature.'", features) <> 0');
        $result = $this->db->get('tbl_subscription_master')->num_rows();
        return $result;
    }
    public function get_subscription_typewise($category){
        $this->db->where('category',$category);
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_master')->result();
        return $result;
    }
    public function get_subscription_typewise_ajx(){
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_master')->result();
        echo json_encode($result);
    }
    public function get_subscription_details($id){
        $this->db->where('id',$id);
        // $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_master')->row();
        return $result;
    }
    public function get_subscription_allocation_details($id){
        $this->db->where('id',$id);
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_branch_subscription_allocation')->row();
        return $result;
    }
    public function add_subscription(){
        $wp_feature = $this->input->post('wp_feature');
        if($wp_feature != "" && is_array($wp_feature) && !empty($wp_feature)){
            $wp_feature_text = implode(',',$wp_feature);
        }else{
            $wp_feature_text = null;
        }

        $feature = $this->input->post('feature');
        if($feature != "" && is_array($feature) && !empty($feature)){
            $feature_text = implode(',',$feature);
            $feature_text .= ',3,28,25,22,26';
        }else{
            $feature_text = '3,28,25,22,26';
        }
        $data=array(
            'subscription_name' => $this->input->post('subscription_name'), 
            'category' 			=> $this->input->post('category'), 
            'amount' 			=> $this->input->post('amount'), 
            'installment' 		=> $this->input->post('installment'), 
            'percent_amount' 	=> $this->input->post('percent_amount'), 
            'duration' 			=> $this->input->post('validity'), 
            'features'          =>  $feature_text,
            'include_wp' 		                =>  $this->input->post('include_wp') == 'on' ? '1' : '0', 
            'wp_coins_qty' 		                =>  $this->input->post('include_wp') == 'on' ? $this->input->post('wp_coins_qty') : null, 
            'whatsapp_notification_features'    =>  $this->input->post('include_wp') == 'on' ? $wp_feature_text : null
        );
		// echo '<pre>'; print_r($data); exit;
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_subscription_master',$new_arr);
            
            $flag = 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_subscription_master',$data);

            $this->db->where('is_deleted','0');
            $this->db->where('subscription_id',$this->input->post('id'));
            $branches = $this->db->get('tbl_branch')->row();
            if(!empty($branches)){
                $uid = $branches->id.'@@@'.$branches->salon_id;
                $type = 'sender';
                $project = 'salon';
                $message = '';
                $data = json_encode([
                    'message_type'  => 'subscription_updation',
                    'branch_id'     => $branches->id,
                    'salon_id'      => $branches->salon_id,
                    'project'       => $project,
                    'uid'           => $uid,
                    'message'       => $message,
                    'subscription_id'     => $this->input->post('id'),
                ]);
                $socket_response = $this->Salon_model->send_data_to_socket_client('admin_panel',$uid,$type,$project,$message,$data);
            }
            $flag = 1;
        }

        return $flag;
    } 
    public function get_all_subscription(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_subscription_master');
        return $result->result();
    } 
    public function get_single_subscription(){
        // $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_subscription_master');
        return $result->row();
    }
    public function add_subscription_feature(){
        $data=array(
            'feature'   => $this->input->post('feature'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s"),
                'added_by'      => $this->session->userdata('admin_id'),
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_subscription_feature',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_subscription_feature',$data);
            return 1;
        }
    } 
    public function get_all_subscription_feature(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_subscription_feature');
        return $result->result();
    } 
    public function get_all_subscription_wp_feature($id = ''){
        $this->db->where('feature',$id);
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_subscription_feature_slug');
        return $result->result();
    } 
    public function get_single_subscription_feature(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_subscription_feature');
        return $result->row();
    }
    public function get_unique_subscription_feature(){ 
        $this->db->where('feature',$this->input->post('feature'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_feature');
        echo $result->num_rows();
    } 
    public function add_subscription_feature_slug(){
        $data=array(
            'feature'       => $this->input->post('feature'), 
            'slug'          => $this->input->post('slug'), 
            'description'   => $this->input->post('description'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s"),
                'added_by'      => $this->session->userdata('admin_id'),
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_subscription_feature_slug',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_subscription_feature_slug',$data);
            return 1;
        }
    } 
    public function get_all_subscription_feature_slug(){
        $this->db->select('tbl_subscription_feature_slug.*, tbl_subscription_feature.feature as feature_name');
        $this->db->join('tbl_subscription_feature', 'tbl_subscription_feature_slug.feature= tbl_subscription_feature.id'); 
        $this->db->where('tbl_subscription_feature_slug.is_deleted','0');
        $this->db->order_by('tbl_subscription_feature_slug.id','DESC');
        $result = $this->db->get('tbl_subscription_feature_slug');
        return $result->result();
    } 
    public function get_single_subscription_feature_slug(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_subscription_feature_slug');
        return $result->row();
    }
    public function get_unique_subscription_feature_slug(){ 
        $this->db->where('slug',$this->input->post('slug'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_subscription_feature_slug');
        echo $result->num_rows();
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
    public function add_sup_category($category_image){
        // echo '<pre>'; print_r($category_image); exit();
        $data=array(
            'sup_category' 			=> $this->input->post('sup_category'),
            'sup_category_marathi' 	=> $this->input->post('sup_category_marathi'),
            'gender' 	            => $this->input->post('gender'),
            'category_image'        => $category_image,
            'admin_id' 				=> $this->session->userdata('admin_id'),
            'default_status' 		=> $this->input->post('default_status'),
        );
        if($this->input->post('id') == ""){
            $this->db->where('is_deleted', '0');
            $this->db->where('gender', $this->input->post('gender'));
            $count = $this->db->get('tbl_admin_service_category')->num_rows();
            $date=array( 
                'order'         =>  $count + 1,
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender',$_GET['filter_gender']);
        }
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    } 
    public function get_all_gender_services_name($gender){
        $this->db->where('is_deleted','0');
        if($gender != ""){
            $this->db->where('gender',$gender);
        }
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
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
	public function add_sub_category($image){
        $data=array(
            'sub_category' => $this->input->post('sub_category'),
            'image' => $image,
            'gender' => $this->input->post('gender'),
            'sup_category' => $this->input->post('sup_category'),
            'sub_category_marathi' => $this->input->post('sub_category_marathi'),
        );
        if($this->input->post('id') == ""){
            $this->db->where('is_deleted', '0'); 
            $this->db->where('gender', $this->input->post('gender')); 
            $current_order = $this->db->get('tbl_admin_sub_category')->num_rows();
            $date=array( 
                'order'         =>  (int)$current_order + 1,
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
        $this->db->join('tbl_admin_service_category', 'tbl_admin_sub_category.sup_category= tbl_admin_service_category.id', 'left'); 
        $this->db->where('tbl_admin_sub_category.is_deleted', '0');
        $this->db->order_by('CAST(tbl_admin_sub_category.order AS UNSIGNED)', 'asc');
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('tbl_admin_sub_category.gender', $_GET['filter_gender']);
        }
        $result = $this->db->get('tbl_admin_sub_category');
        return $result->result();
    }
    public function get_gender_categories($gender) {
        $this->db->where('is_deleted','0');
        if($gender != ""){
            $this->db->where('gender', $gender);
        }
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc'); 
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    }
    public function get_gender_categories_ajax() {
        $this->db->where('is_deleted','0');
        if($this->input->post('gender') != ""){
            $this->db->where('gender', $this->input->post('gender'));
        }
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc'); 
        $result = $this->db->get('tbl_admin_service_category');
        echo json_encode($result->result());
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
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc'); 
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
            'gender'                    => $this->input->post('gender'),
            'sub_category'              => $this->input->post('sub_category'),
            'service_name'              => $this->input->post('service_name'),
            'service_description'       => $this->input->post('service_description'),
            'short_description'         => $this->input->post('short_description'),
            'service_duration'          => $this->input->post('service_duration'),
            'final_price'               => $this->input->post('final_price'),
            'service_name_marathi'      => $this->input->post('service_name_marathi'),
            'category_image'            => $category_image,
            'min'                       => $this->input->post('discount_type') == '1' ? $this->input->post('min') : '',
            'max'                       => $this->input->post('discount_type') == '1' ? $this->input->post('max') : '',
            'service_discount'          => $this->input->post('discount_type') == '0' ? $this->input->post('service_discount') : '',
            'discount_in'               => $this->input->post('discount_in'),
            'discount_type'             => $this->input->post('discount_type'),
            'reward_point'              => $this->input->post('discount_type') == '0' ? $this->input->post('reward_point') : '',
            'reminder_duration'         => $this->input->post('reminder_duration'),
            'default_status'            => $this->input->post('default_status'), 
        ); 
        if($this->input->post('id') == ""){            
            $this->db->where('is_deleted', '0'); 
            $this->db->where('gender', $this->input->post('gender')); 
            $current_order = $this->db->get('tbl_admin_services')->num_rows();
            $date=array( 
                'order'         =>  (int)$current_order + 1,
                'created_on'    =>  date("Y-m-d H:i:s")
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
    public function update_pending_service($category_image){
            $data=array(
                'category'                  => $this->input->post('category'),
                'gender'                    => $this->input->post('gender'),
                'sub_category'              => $this->input->post('sub_category'),
                'service_name'              => $this->input->post('service_name'),
                'service_description'       => $this->input->post('service_description'),
                'short_description'         => $this->input->post('short_description'),
                'service_duration'          => $this->input->post('service_duration'),
                'final_price'               => $this->input->post('final_price'),
                'service_name_marathi'      => $this->input->post('service_name_marathi'),
                'category_image'            => $category_image,
                'min'                       => $this->input->post('discount_type') == '1' ? $this->input->post('min') : '',
                'max'                       => $this->input->post('discount_type') == '1' ? $this->input->post('max') : '',
                'service_discount'          => $this->input->post('discount_type') == '0' ? $this->input->post('service_discount') : '',
                'discount_in'               => $this->input->post('discount_in'),
                'discount_type'             => $this->input->post('discount_type'),
                'reward_point'              => $this->input->post('discount_type') == '0' ? $this->input->post('reward_point') : '',
                'reminder_duration'         => $this->input->post('reminder_duration'),
                'default_status'            => $this->input->post('default_status'), 
            ); 
            // echo '<pre>'; print_r($this->input->post('id')); exit;
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_salon_emp_service',$data);
            return 1;
        }
	public function get_selected_sub_category($category){
		$this->db->where('sup_category',$category);
		$this->db->where('is_deleted','0'); 
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
		$result = $this->db->get('tbl_admin_sub_category');
		return $result->result();
	}
    public function get_services_ajax(){
        $salon_type = $this->input->post('salon_type');
        if($salon_type == '0'){
            $allowed_gender = ['0'] ;
        }elseif($salon_type == '1'){
            $allowed_gender = ['1'] ;
        }elseif($salon_type == '2'){
            $allowed_gender = ['0','1'] ;
        }else{
            $allowed_gender = [];
        }

        if(!empty($allowed_gender)){
            $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category, tbl_admin_sub_category.sub_category_marathi');
            $this->db->from('tbl_admin_services');
            $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
            $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
            $this->db->where('tbl_admin_services.is_deleted', '0');
            $this->db->where_in('tbl_admin_services.gender', $allowed_gender);
            $this->db->order_by('tbl_admin_services.id', 'DESC');
            $result = $this->db->get();
            echo json_encode($result->result());
        }else{
            echo json_encode(array());
        }
    }
    public function get_service($id){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.id', $id);
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        return $result->row();
    }
    public function get_all_service_list(){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.is_deleted', '0');
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('tbl_admin_services.gender', $_GET['filter_gender']);
        }
        $this->db->order_by('CAST(tbl_admin_services.order AS UNSIGNED)', 'asc');    
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
    public function get_all_service_list_genderwise($gender){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category as sub_category_name, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.gender', $gender);
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.status', '1');
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_all_service_list_genderwise_ajax(){
        $this->db->select('tbl_admin_services.*,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi, tbl_admin_sub_category.sub_category as sub_category_name, tbl_admin_sub_category.sub_category_marathi');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_service_category','tbl_admin_services.category = tbl_admin_service_category.id', 'left'); 
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id', 'left'); 
        $this->db->where('tbl_admin_services.gender', $this->input->post('gender'));
        $this->db->where('tbl_admin_services.is_deleted', '0');
        $this->db->where('tbl_admin_services.status', '1');
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        echo json_encode($result->result());
    }
    
    public function get_single_service(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_admin_services');
        return $result->row();
    }
    public function get_single_salon_service(){
        $this->db->select('tbl_salon_emp_service.*,tbl_branch.branch_name,tbl_salon.salon_name,tbl_branch.category as salon_category');
        $this->db->join('tbl_branch','tbl_salon_emp_service.branch_id = tbl_branch.id', 'left'); 
        $this->db->join('tbl_salon', 'tbl_salon_emp_service.salon_id = tbl_salon.id', 'left'); 
        $this->db->where('tbl_salon_emp_service.is_deleted','0');
        $this->db->where('tbl_salon_emp_service.id',$this->uri->segment(2));
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->row();
    }


    public function get_sub_category_by_category()
    {
        $sup_category = $this->input->post('sup_category');
        $gender = $this->input->post('gender');
        $this->db->where('is_deleted', '0');
        $this->db->where('gender', $gender);
        $this->db->where('sup_category', $sup_category);
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
        $result = $this->db->get('tbl_admin_sub_category')->result();
    
        if ($result !== FALSE) {
            echo json_encode($result);
        } 
    }
    

    public function get_third_category(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
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

    public function add_booking_status(){
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
    public function get_all_attendance_staff(){
		$this->db->select('tbl_admin_emp_attendance.*,tbl_employee.full_name');
		$this->db->join('tbl_employee','tbl_employee.id = tbl_admin_emp_attendance.emp_id');
		$this->db->where('tbl_admin_emp_attendance.is_deleted','0');
		$this->db->order_by('tbl_admin_emp_attendance.att_date','desc');
		$result = $this->db->get('tbl_admin_emp_attendance');
		return $result->result();
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
    
    public function check_employee_salary_generation($staff_id, $date)
    {
        $date = date('Y-m-d', strtotime($date));
        $this->db->where('tbl_admin_emp_salary_slip.from_date <=', $date);
        $this->db->where('tbl_admin_emp_salary_slip.to_date >=', $date);
        $this->db->where('tbl_admin_emp_salary_slip.emp_id', $staff_id);
        $this->db->where('tbl_admin_emp_salary_slip.is_deleted', '0');
        $result = $this->db->get('tbl_admin_emp_salary_slip');
        return $result->result();
    }
    public function get_datewise_emp_attendance_ajx(){
        $employee = $this->Admin_model->get_all_active_staff();
        ?>        
            <ul class="list_heading">
                <li class="list_staff_name">STAFF NAME</li>
                <li class="list_action">ACTION</li>
            </ul>
        <?php
        if(!empty($employee)){
            foreach($employee as $employee_result){
                $this->db->where('att_date',date('Y-m-d',strtotime($this->input->post('attendance_date'))));
                $this->db->where('is_deleted','0');
                $this->db->where('emp_id',$employee_result->id);
                $today_attendance = $this->db->get('tbl_admin_emp_attendance');
                $today_attendance = $today_attendance->row();
                
                $month_salary = $this->check_employee_salary_generation($employee_result->id,$this->input->post('attendance_date'));
        ?>   
            <ul>
                <li class="list_staff_name">
                    <?=$employee_result->full_name;?> <?php if(!empty($month_salary)){ echo '<small class="error"> (Salary Already Generated)</small>'; }?>
                    <input type="hidden" name="staff_id[]" id="staff_id_<?=$employee_result->id;?>" value="<?=$employee_result->id;?>">
                </li>
                <li class="list_action">
                    <button type="button" class="btn_choose_sent bg_btn_chose_1">
                        <input <?php if(!empty($month_salary)){ echo 'disabled title="Salary Already Generated"'; } ?> type="radio" name="attendence_<?=$employee_result->id;?>" value="1" <?php if(!empty($today_attendance) && $today_attendance->attendence_type == '1'){?>checked<?php }?> />Present
                    </button>
                    <button type="button" class="btn_choose_sent bg_btn_chose_2">
                        <input <?php if(!empty($month_salary)){ echo 'disabled title="Salary Already Generated"'; } ?> type="radio" name="attendence_<?=$employee_result->id;?>" value="2" <?php if(!empty($today_attendance) && $today_attendance->attendence_type == '2'){?>checked<?php }?> />Absent
                    </button>
                    <button type="button" class="btn_choose_sent bg_btn_chose_3">
                        <input <?php if(!empty($month_salary)){ echo 'disabled title="Salary Already Generated"'; } ?> type="radio" name="attendence_<?=$employee_result->id;?>" value="3" <?php if(!empty($today_attendance) && $today_attendance->attendence_type == '3'){?>checked<?php }?> />Half Day
                    </button>
                </li>
            </ul>
        <?php
            }
        }else{
        ?>
            <ul>
                <li class="list_staff_name" style="width:100%; text-align:center;">
                    No staff found...
                </li>
            </ul>
        <?php
        }
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
        // echo '<pre>'; print_r($data); exit();
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

		// $templateid = "1707169641514078983";
		// $message = 'Dear '.$result->full_name.',%0a%0aWe are pleased to inform you that your salary '.date("Y-m-d",strtotime($this->input->post('from_date'))).' to '.date("Y-m-d",strtotime($this->input->post('to_date'))).'has been successfully generated and amounts to '.$paid_amt.'%0a%0aIt is now ready for disbursement.%0a%0aRegards,%0aSaurabh Travels';
		// $whatsapp_number = $result->whatsapp_number;
		
		// // $this->send_sms_sautra($templateid,$message,$whatsapp_number);
		
		// $sms = array(
		// 	'sms_type'			=> 'Staff Salary Generation SMS',
		// 	'sms_sent_to'		=> '2',
		// 	'sms_receiver_id'	=> $result->id,
		// 	// 'whatsapp_number'		=> $whatsapp_number,
		// 	'sms'				=> $message,
		// 	'created_on' 		=> date('Y-m-d H:i:s'),
		// );
		// $this->db->insert('tbl_sms_send_log',$sms);
		
		// $staff_sms = array(
		// 	'sms_type'		=> 'Staff Salary Generation SMS',
		// 	'staff_id'		=> $result->id,
		// 	'created_on' 	=> date('Y-m-d H:i:s'),
		// );
		// $this->db->insert('tbl_staff_sms_send_log',$staff_sms);
		
		return $salary_slip_id;
	}
    public function get_field_executive_attendance_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('MONTH(att_date)',$this->input->post('salary_month'));
		$this->db->where('YEAR(att_date)',$this->input->post('salary_year'));
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_admin_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
	public function get_employee_present_days_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where('attendence_type','1');
		$result = $this->db->get('tbl_admin_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
	public function get_employee_half_days_ajx(){
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where('attendence_type','3');
		$result = $this->db->get('tbl_admin_emp_attendance');
		$result = $result->num_rows();
		echo $result;
	}
    public function get_all_salary()
    {
        $this->db->select('tbl_admin_emp_salary_slip.*, tbl_employee.full_name');
        $this->db->from('tbl_admin_emp_salary_slip');
        $this->db->join('tbl_employee', 'tbl_employee.id = tbl_admin_emp_salary_slip.emp_id', 'left');
        $this->db->where('tbl_admin_emp_salary_slip.is_deleted', '0');
        $this->db->order_by('tbl_admin_emp_salary_slip.id', 'DESC');
    
        $result = $this->db->get();
    
        return $result->result();
    }
	public function get_employee_absent_days_ajx(){
		$att_type = [1,3];
		$this->db->where('emp_id',$this->input->post('staff_id'));
		$this->db->where('att_date >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		$this->db->where('att_date <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		$this->db->where('is_deleted','0');
		$this->db->where_in('attendence_type',$att_type);
		$result = $this->db->get('tbl_admin_emp_attendance');
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
        $this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_admin_memebership');
		return $result->result();
	}
	public function get_all_coupon_code(){
        $this->db->where('is_deleted', '0'); 
        $this->db->where('status','1');
        // $this->db->where('coupan_expiry >=',date('Y-m-d'));
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
        $this->db->order_by('id','DESC');
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
            'coupan_expiry' => date('Y-m-d', strtotime($this->input->post('coupan_expiry'))) ,
            'coupon_offers' => $this->input->post('coupon_offers'),
            'min_price' 	=> $this->input->post('min_price'),
            'gender' 	=> $this->input->post('gender'),
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
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
	// public function get_selected_service_name_for_offer($service){
	// 	$exp = explode(",",$service);
    //     $this->db->where('is_deleted','0'); 
    //     $this->db->where_in('id',$exp);
    //     $result = $this->db->get('tbl_admin_services');
    //     return $result->result();
    // }
    public function get_selected_service_name_for_offer($service){
    
        if (empty($service)) {
            return []; 
        }
        $exp = explode(",", $service);
        $this->db->where('is_deleted', '0');
        $this->db->where_in('id', $exp);
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
            'min_booking_amt' 	=> $this->input->post('min_booking_amt'),
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
        $this->db->where('gender',$this->input->post('gender'));
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->result();
	}
	public function get_single_giftcard(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->row();
	}
	public function set_package($package_image){  
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
            'package_image'     => $package_image,
            'package_name_marathi' 			=> $this->input->post('package_name_marathi'),
            'description' 	    => $this->input->post('description'),
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
        if(isset($_GET['filter_gender']) && $_GET['filter_gender'] != ""){
            $this->db->where('gender', $_GET['filter_gender']);
        }
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
    
	public function update_booking_reminder_type_setup(){ 
		$this->db->where('type',$this->input->post('type_of_rules'));
		$exist = $this->db->get('tbl_rules_setup');
		$exist = $exist->row();
		if(empty($exist)){
			$data = array( 
				'booking_reminder_type' => $this->input->post('reminder_type'),     
				'type' 					=> $this->input->post('type_of_rules'),   
				'created_on'   			=> date("Y-m-d H:i:s")
			);  
            $this->db->insert('tbl_rules_setup', $data); 
        }else{
			$data = array( 
				'booking_reminder_type' => $this->input->post('reminder_type'),     
			);  
            $this->db->where('type',$this->input->post('type_of_rules'));
            $this->db->update('tbl_rules_setup', $data);
        }
		return true;
	}
	public function get_single_booking_rules(){
        $this->db->select('tbl_rules_setup.*,tbl_salon_type.type as salon_type_title');
        $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_rules_setup.type');
		$this->db->where('tbl_rules_setup.type',$_GET['type']);
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
	    $discount_in = '0';
	    if($this->input->post('discount_in') != ''){
	        $discount_in = $this->input->post('discount_in');
	    }
        $data = array(
            'product_category' 		=> $this->input->post('product_category'),
            'sub_category' 		    => $this->input->post('product_sub_category'),
            'product_name' 			=> $this->input->post('product_name'), 
            'hsn_code' 				=> $this->input->post('hsn_code'),
            'discount_in' 			=> $discount_in,
            'discount' 				=> $this->input->post('discount'),
            'incentive' 			=> $this->input->post('incentive'),
            'description' 			=> $this->input->post('description'),
            'product_unit' 			=> $this->input->post('product_unit'),
            'selling_price' 		=> $this->input->post('selling_price'),
            'product_photo' 		=> $product_photo,
        ); 
        // echo '<pre>'; print_r($data); exit;
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

    
	public function get_unique_product_name(){
        // echo "<pre>";print_r($this->input->post('id'));exit;
        $this->db->where('product_category',$this->input->post('product_category'));
        $this->db->where('product_name',$this->input->post('product_name'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0'); 
        $result = $this->db->get('tbl_admin_product');
        echo $result->num_rows();
    }
	public function get_product_category(){
		$this->db->where('is_deleted','0');
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
		$result = $this->db->get('tbl_product_category');
		return $result->result();
	}
	public function get_product_subcategory(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
		$result = $this->db->get('tbl_product_sub_category');
		return $result->result();
	}
	public function get_product_category_sub_categories_ajax(){
        $id = $this->input->post('product_category');
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('product_category',$id);
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
		$result = $this->db->get('tbl_product_sub_category');
		echo json_encode($result->result());
	}
	public function get_product_category_sub_categories($id){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('product_category',$id);
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
		$result = $this->db->get('tbl_product_sub_category');
		return $result->result();
	}
	public function get_all_product(){
		$this->db->select('tbl_admin_product.*,tbl_product_category.product_category,tbl_admin_product_unit.product_unit as unit_name');
        $this->db->where('tbl_admin_product.is_deleted','0'); 
        $this->db->order_by('tbl_admin_product.id','DESC');
		$this->db->join('tbl_product_category','tbl_product_category.id = tbl_admin_product.product_category');
		$this->db->join('tbl_admin_product_unit','tbl_admin_product_unit.id = tbl_admin_product.product_unit','left');
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
		$this->db->join('tbl_admin_product_unit','tbl_admin_product_unit.id = tbl_product.product_unit','left');
		$this->db->order_by('tbl_product.id','desc');
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
            $this->db->where('is_deleted', '0'); 
            $current_order = $this->db->get('tbl_product_category')->num_rows();
            $date=array( 
                'order'         =>  (int)$current_order + 1,
                'created_on'    => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_product_category', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_product_category', $data);
            return 1;
        }
    }
	public function set_product_subcategory(){
        $data = array(
            'product_category' 			    => $this->input->post('product_category'),
            'product_sub_category' 			=> $this->input->post('product_sub_category'), 
        ); 
        if ($this->input->post('id') == "") {
            $this->db->where('is_deleted', '0'); 
            $current_order = $this->db->get('tbl_product_sub_category')->num_rows();
            $date=array( 
                'order'         =>  (int)$current_order + 1,
                'created_on'    => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_product_sub_category', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_product_sub_category', $data);
            return 1;
        }
    }
	public function check_unique_salon_email_ajx(){ 
        $this->db->where('email',$this->input->post('email'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_salon');
        echo $result->num_rows();
    }
	public function check_unique_salon_number_ajx(){ 
        $this->db->where('salon_owner_number',$this->input->post('salon_owner_number'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_salon');
        echo $result->num_rows();
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
	public function get_unique_product_subcategory(){ 
        $this->db->where('product_sub_category',$this->input->post('product_sub_category'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_product_sub_category');
        echo $result->num_rows();
    }
	public function get_all_product_category(){ 
        $this->db->where('is_deleted','0');
        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
        $result = $this->db->get('tbl_product_category');
        return $result->result();
    }
	public function get_all_product_sub_category(){ 
        $this->db->select('tbl_product_sub_category.*,tbl_product_category.product_category as product_category_name,tbl_product_category.product_category_marathi');
        $this->db->join('tbl_product_category','tbl_product_sub_category.product_category = tbl_product_category.id');
        $this->db->where('tbl_product_sub_category.is_deleted','0');
        $this->db->order_by('CAST(tbl_product_sub_category.order AS UNSIGNED)', 'asc');    
        $result = $this->db->get('tbl_product_sub_category');
        return $result->result();
    }
	public function get_single_product_category(){ 
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_product_category');
        return $result->row();
    }
	public function get_single_product_subcategory(){ 
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_product_sub_category');
        return $result->row();
    }
	public function get_sub_category_details($id){ 
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_product_sub_category');
        return $result->row();
    }

    public function pending_salon_products(){
        $data = array(
            'reject_reason' => $this->input->post('reject_reason'),
            'is_deleted' => '1',
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_product',$data); 
        return 1; 
    }
    

    public function set_for_approve_service(){ 
		$ids = $this->input->post('ids'); 
		if(!empty($ids)){
			for($i=0;$i<count($ids);$i++){
				$data = array(
                    'status' => '1'
				);
				$this->db->where('id',$ids[$i]);
				$this->db->update('tbl_salon_emp_service',$data);
			}
		}
		return true;
	}

    public function set_for_approve_product(){ 
		$ids = $this->input->post('ids'); 
		if(!empty($ids)){
			for($i=0;$i<count($ids);$i++){
				$data = array(
                    'status' => '1'
				);
				$this->db->where('id',$ids[$i]);
				$this->db->update('tbl_product',$data);
			}
		}
		return true;
	}




    
	public function get_single_reason(){
		$this->db->where('id',$this->uri->segment(2));
		$this->db->where('is_deleted','0');
		// $this->db->where('status','1');
		$result = $this->db->get('tbl_complaint_reason');
		return $result->row();
	}
	public function get_all_complaint_list($length,$start,$search){
		$this->db->where('is_deleted','0');
		if($search !=""){
			// $this->db->group_start();
			$this->db->or_like('reason',$search);
			// $this->db->group_end();
		}
		$this->db->order_by('id','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_complaint_reason');
		return $result->result();		
	}
	public function get_all_complaint_list_count($search){
		$this->db->where('is_deleted','0');
		if($search !=""){
			// $this->db->group_start();
			$this->db->or_like('reason',$search);
			// $this->db->group_end();
		}
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_complaint_reason');
		return $result->num_rows();
	}
	public function add_reason(){
		$data = array (
			'reason' 			=>	$this->input->post('reason'), 
		);
		if($this->input->post('id') == ''){
			$date=array(
				'created_on'	=> date('Y-m-d H:i:s'),
			);
			$new_arr=array_merge($data,$date);
			$this->db->insert('tbl_complaint_reason',$new_arr);
			return 1;
		}else{
			$this->db->where('id' , $this->input->post('id'));
			$this->db->update('tbl_complaint_reason',$data);
			return 0;
		}
	}
	public function get_all_customer_queries_list($length, $start, $search, $customer, $ticket, $category, $status, $branch, $salon){
		$this->db->select('tbl_customer_support.*,tbl_branch.branch_name,tbl_salon.salon_name,tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone,tbl_complaint_reason.reason');
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_customer_support.customer_id');
		$this->db->join('tbl_complaint_reason','tbl_complaint_reason.id = tbl_customer_support.subject_id');
		$this->db->join('tbl_branch','tbl_customer_support.branch_id = tbl_branch.id');
		$this->db->join('tbl_salon','tbl_customer_support.salon_id = tbl_salon.id');
		if($salon != "") {
			$this->db->where('tbl_customer_support.salon_id', $salon);
		}
		if($branch != "") {
			$this->db->where('tbl_customer_support.branch_id', $branch);
		}
		if($customer != ""){
			$this->db->where('tbl_customer_support.customer_id',$customer);
		}
		if($ticket != "") {
			$this->db->where('tbl_customer_support.support_id', $ticket);
		}
		if($category != "") {
			$this->db->where('tbl_customer_support.subject_id', $category);
		}
		if($status != "") {
			$this->db->where('tbl_customer_support.final_resolution_status', $status);
		}
		if($search !=""){
			// $this->db->group_start();
			$this->db->or_like('tbl_salon_customer.full_name',$search);
			$this->db->or_like('tbl_salon_customer.email',$search);
			$this->db->or_like('tbl_salon_customer.customer_phone',$search);
			$this->db->or_like('tbl_customer_support.created_on',$search);
			$this->db->or_like('tbl_customer_support.support_id',$search);
			$this->db->or_like('tbl_customer_support.description',$search);
			$this->db->or_like('tbl_customer_support.final_remark',$search);
			$this->db->or_like('tbl_customer_support.final_remark_date',$search);
			$this->db->or_like('tbl_complaint_reason.reason',$search);
			// $this->db->group_end();
		}
		$this->db->order_by('tbl_customer_support.updated_on','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_customer_support');
		return $result->result();		
	}
	public function get_all_customer_queries_list_count($search, $customer, $ticket, $category, $status, $branch, $salon){
		$this->db->select('tbl_customer_support.*,tbl_branch.branch_name,tbl_salon.salon_name,tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone,tbl_complaint_reason.reason');
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_customer_support.customer_id');
		$this->db->join('tbl_complaint_reason','tbl_complaint_reason.id = tbl_customer_support.subject_id');
		$this->db->join('tbl_branch','tbl_customer_support.branch_id = tbl_branch.id');
		$this->db->join('tbl_salon','tbl_customer_support.salon_id = tbl_salon.id');
		if($salon != "") {
			$this->db->where('tbl_customer_support.salon_id', $salon);
		}
		if($branch != "") {
			$this->db->where('tbl_customer_support.branch_id', $branch);
		}
		if($customer != "") {
			$this->db->where('tbl_customer_support.customer_id', $customer);
		}
		if($ticket != "") {
			$this->db->where('tbl_customer_support.support_id', $ticket);
		}
		if($category != "") {
			$this->db->where('tbl_customer_support.subject_id', $category);
		}
		if($status != "") {
			$this->db->where('tbl_customer_support.final_resolution_status', $status);
		}
		if($search !=""){
			// $this->db->group_start();
			$this->db->or_like('tbl_salon_customer.full_name',$search);
			$this->db->or_like('tbl_salon_customer.email',$search);
			$this->db->or_like('tbl_salon_customer.customer_phone',$search);
			$this->db->or_like('tbl_customer_support.created_on',$search);
			$this->db->or_like('tbl_customer_support.support_id',$search);
			$this->db->or_like('tbl_customer_support.description',$search);
			$this->db->or_like('tbl_customer_support.final_remark',$search);
			$this->db->or_like('tbl_customer_support.final_remark_date',$search);
			$this->db->or_like('tbl_complaint_reason.reason',$search);
			// $this->db->group_end();
		}
		$this->db->order_by('tbl_customer_support.updated_on','DESC');
		$result = $this->db->get('tbl_customer_support');
		return $result->num_rows();
	}

	public function give_final_remark(){
		$this->db->where('id',$this->uri->segment(2));
		$ticket = $this->db->get('tbl_customer_support')->row();
		if(!empty($ticket)){
			$data = array(
				'final_remark'				=>	$this->input->post('final_remark'),
				'final_remark_date'			=>	date("Y-m-d H:i:s"),
				'final_resolution_status'	=>	'1',
			);
			// print_r($data);exit();
			$this->db->where('id',$this->uri->segment(2));
			$this->db->update('tbl_customer_support',$data);

			$data = array(
				'customer_id'	=> $ticket->customer_id,
				'support_id'	=> $ticket->support_id,
				'tbl_support_id'=> $ticket->id,
				'replay'		=> $this->input->post('final_remark'),
				'replay_type'		=> '1',
				'admin_rly_type'	=> '1',
				'created_on'	=> date('Y-m-d H:i:s'),
				'received_on'	=> date('Y-m-d H:i:s'),
			);
			// print_r($data);exit();
			$this->db->insert('tbl_customer_support_ticket_history',$data);

            $this->db->where('id',$ticket->customer_id);
            $customer_details = $this->db->get('tbl_salon_customer')->row();

            $type = '19';
            $message = "Final resolution for Ticket ID ".$ticket->support_id." received on ".date("d/m/Y");            
            $app_message = $message;
            $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
            $finalNumber = substr($cleanedNumber, -10);
            $finalNumber = '91' . $finalNumber;
            $number = $finalNumber;
            $customer = $customer_details->id;
            $salon_id = $customer_details->salon_id;
            $branch_id = $customer_details->branch_id;
            $for_order_id = '';
            $for_offer_id = '';
            $consent_form_id = '';
            $for_query_id = $this->uri->segment(2);
            $title = 'Query Resolved';
            $generated_from = '0';
            $notification_data = [
                "landing_page"  => 'query_details',
                "redirect_id"   => (string)$for_query_id
            ];
                    
            $message_send_on = '';
            $template_id = '';
            $email_subject = '';
            $email_html = '';
            $booking_rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
            if(!empty($booking_rules)){
                if($booking_rules->booking_reminder_type == '1'){
                    $message_send_on = '0'; //SMS
                    $template_id = '';
                }elseif($booking_rules->booking_reminder_type == '2'){
                    $message_send_on = '2'; //EMAIL
                    $email_html = '';
                }elseif($booking_rules->booking_reminder_type == '3'){
                    $message_send_on = '1'; //WP
                }
            }
            $membership_history_id = '';
            $package_allocation_id = '';
            $giftcard_purchase_id = '';
            $trying_booking_id = '';
            $wp_template_data = [];
            $cron_id = '';

            $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data,$cron_id);
		}
		return true;
	}
	
	public function give_replay(){
		$this->db->where('id',$this->uri->segment(2));
		$ticket = $this->db->get('tbl_customer_support')->row();
		if(!empty($ticket)){
			$data = array(
				'customer_id'	=> $ticket->customer_id,
				'support_id'	=> $ticket->support_id,
				'tbl_support_id'=> $ticket->id,
				'replay'		=> $this->input->post('replay'),
				'replay_type'		=> '1',
				'admin_rly_type'	=> '0',
				'created_on'	=> date('Y-m-d H:i:s'),
				'received_on'	=> date('Y-m-d H:i:s'),
			);
			// print_r($data);exit();
			$this->db->insert('tbl_customer_support_ticket_history',$data);
			
			$this->db->where('id',$this->uri->segment(2));
			$this->db->update('tbl_customer_support',array('final_resolution_status'=>'2'));

            $this->db->where('id',$ticket->customer_id);
            $customer_details = $this->db->get('tbl_salon_customer')->row();

            $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
            $finalNumber = substr($cleanedNumber, -10);
            $finalNumber = '91' . $finalNumber;

            $type = '18';
            $message = "Admin has given replay to customer query of Ticket ID ".$ticket->support_id." on ".date("d/m/Y");
            $app_message = $message;
            $number = $finalNumber;
            $customer = $customer_details->id;
            $salon_id = $customer_details->salon_id;
            $branch_id = $customer_details->branch_id;
            $for_query_id = $this->uri->segment(2);
            $for_order_id = '';
            $for_offer_id = '';
            $consent_form_id = '';
            $title = 'Received replay from Admin';
            $generated_from = '0';
            $notification_data = [
                "landing_page"  => 'query_details',
                "redirect_id"   => (string)$for_query_id
            ];
                    
            $message_send_on = '';
            $template_id = '';
            $email_subject = '';
            $email_html = '';
            $booking_rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
            if(!empty($booking_rules)){
                if($booking_rules->booking_reminder_type == '1'){
                    $message_send_on = '0'; //SMS
                    $template_id = '';
                }elseif($booking_rules->booking_reminder_type == '2'){
                    $message_send_on = '2'; //EMAIL
                    $email_html = '';
                }elseif($booking_rules->booking_reminder_type == '3'){
                    $message_send_on = '1'; //WP
                }
            }
            $membership_history_id = '';
            $package_allocation_id = '';
            $giftcard_purchase_id = '';
            $trying_booking_id = '';
            $wp_template_data = [];
            $cron_id = '';

            $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data,$cron_id);
		}
		return true;
	}
	public function get_query_resolution_history($id){
		$this->db->select('tbl_customer_support_ticket_history.*, tbl_salon_customer.full_name, tbl_salon_customer.customer_phone');
		$this->db->join('tbl_salon_customer','tbl_customer_support_ticket_history.customer_id = tbl_salon_customer.id');
		$this->db->join('tbl_customer_support','tbl_customer_support.id = tbl_customer_support_ticket_history.tbl_support_id');
		$this->db->where('tbl_customer_support_ticket_history.tbl_support_id',$id);
		$this->db->order_by('tbl_customer_support_ticket_history.received_on','asc');
		$result = $this->db->get('tbl_customer_support_ticket_history')->result();
		return $result;
	}
    public function update_service_category_order() {
        $order = $this->input->post('order');    
        if (!empty($order)) {
            foreach ($order as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $this->db->where('id', $item['id']);
                    $this->db->where('gender', $item['gender']);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('tbl_admin_service_category', ['order' => $item['order']]);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
    public function update_product_category_order() {
        $order = $this->input->post('order');    
        if (!empty($order)) {
            foreach ($order as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $this->db->where('id', $item['id']);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('tbl_product_category', ['order' => $item['order']]);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
    public function update_product_subcategory_order() {
        $order = $this->input->post('order');    
        if (!empty($order)) {
            foreach ($order as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $this->db->where('id', $item['id']);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('tbl_product_sub_category', ['order' => $item['order']]);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
    public function update_service_subcategory_order() {
        $order = $this->input->post('order');    
        if (!empty($order)) {
            foreach ($order as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $this->db->where('id', $item['id']);
                    $this->db->where('gender', $item['gender']);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('tbl_admin_sub_category', ['order' => $item['order']]);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
    public function update_service_order() {
        $order = $this->input->post('order');    
        if (!empty($order)) {
            foreach ($order as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $this->db->where('id', $item['id']);
                    $this->db->where('gender', $item['gender']);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('tbl_admin_services', ['order' => $item['order']]);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }
	public function get_query_resolution_history_popup(){
		$history = $this->get_query_resolution_history($this->input->post('id'));
		$this->db->select('tbl_customer_support.*,tbl_complaint_reason.reason,tbl_salon_customer.full_name, tbl_salon_customer.customer_phone,tbl_branch.branch_name,tbl_salon.salon_name');
		$this->db->join('tbl_complaint_reason','tbl_customer_support.subject_id = tbl_complaint_reason.id');
		$this->db->join('tbl_salon_customer','tbl_customer_support.customer_id = tbl_salon_customer.id');
		$this->db->join('tbl_branch','tbl_customer_support.branch_id = tbl_branch.id');
		$this->db->join('tbl_salon','tbl_customer_support.salon_id = tbl_salon.id');
		$this->db->where('tbl_customer_support.id',$this->input->post('id'));
		$ticket = $this->db->get('tbl_customer_support')->row();
		if(!empty($ticket)){
		?>
			<div>
				<table class="table" style="width:100%;">
					<thead>
						<tr>
							<th>Ticket No.</th>
							<th>Customer</th>
							<th>Salon</th>
							<th>Subject</th>
							<th>Attachment</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?=$ticket->support_id;?></td>
							<td><?=$ticket->full_name.', '.$ticket->customer_phone;?></td>
							<td><?=$ticket->branch_name.', '.$ticket->salon_name;?></td>
							<td><?=$ticket->reason;?></td>
							<td>
								<?php							
									if($ticket->attachments != ""){
										echo '
											<a target="_blank" href="'.base_url().'admin_assets/images/customer_queries/'.$ticket->attachments.'"><i class="fas fa-paperclip"></i></a>
										';
									}else{
										echo "-";
									}
								?>
							</td>
                            <td>
                                <?php
                                    if($ticket->final_resolution_status == 1){
                                        echo '<span class="label label-success">Closed</span>';
                                    }elseif($ticket->final_resolution_status == 0){
                                        echo '<span class="label label-danger">Pending</span>';
                                    }else{
                                        echo '<span class="label label-warning">In Process</span>';
                                    }
                                ?>
                            </td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php if(!empty($history)){ ?>
			<div class="resolution-replays">
				<?php 
				if(!empty($history)){ foreach($history as $history_result){
					if($history_result->replay_type == '0'){
						$name = $history_result->full_name;
						$float = 'left';
						$background = "#09424a21";
					}else{
						$name = 'Admin';
						$float = 'right';
						$background = "#E0F2F1";
					}
				?>
				<div class="single-replay" style="float:<?=$float;?>; background-color:<?=$background;?>;">
					<p style="color:black;margin: 0px;line-height: 30px;font-size: 14px;"><?=$name;?></p>
					<p style="color:black;margin: 0px; margin-bottom:6px;"><?=$history_result->replay;?></p>
					<p style="color: black;margin: 0px;text-align: right;font-size: 11px;width: 50%;float: right;"><?=date('d M, Y h:i A',strtotime($history_result->received_on));?></p>
				</div>
				<?php }}else{ ?>
					<label class="error" style="font-size: 12px;">Data not available</label>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if($ticket->final_resolution_status != 1){ ?>
			<form id="make_form_2" method="post" action="<?=base_url()?>give-replay/<?=$this->input->post('id')?>" style="margin-top: 15px;">
				<div class="col-xs-12 form-group">
					<textarea class="form-control" name="replay" id="replay" placeholder="Enter Replay"></textarea>
					<input type="hidden" name="ticket_id" value="<?=$this->input->post('ticket');?>">
				</div>
				<div class="clearfix"></div>
				<div class="col-md-3  col-sm-3 col-xs-12">
					<button type="submit" id="submit_button" class="btn btn-success">Submit</button>
				</div>	
				<div class="clearfix"></div>
			</form>
			<?php } ?>
			<script>
				$(document).ready(function() {
					$("#make_form_2").validate({
						rules: {
							replay: {
								required: true
							}
						},
						messages: {
							replay: {
								required: "Please enter replay"
							}
						},
						submitHandler: function(form) {
							form.submit();
						}
					});
				});
			</script>
		<?php }
	}
	public function get_final_remark_popup(){
		?>
			<form id="make_form_2" method="post" action="<?=base_url()?>give-final-remark/<?=$this->input->post('id')?>">
				<div class="col-xs-12 form-group">
					<label for="fullname">Final Remark * :</label>
					<textarea class="form-control" name="final_remark" id="final_remark" placeholder="Enter Final Remark"></textarea>
					<input type="hidden" name="ticket_id" value="<?=$this->input->post('ticket');?>">
				</div>
				<div class="clearfix"></div>
				<div class="col-md-3  col-sm-3 col-xs-12">
					<button type="submit" id="submit_button" class="btn btn-success">Submit</button>
				</div>	
				<div class="clearfix"></div>
			</form>
			<script>
				$(document).ready(function() {
					$("#make_form_2").validate({
						rules: {
						final_remark: {
							required: true
						}
						},
						messages: {
						final_remark: {
							required: "Please enter final remark"
						}
						},
						submitHandler: function(form) {
						form.submit();
						}
					});
				});
			</script>
		<?php
	}
	public function get_all_customers(){
        $this->db->select('tbl_salon_customer.*,tbl_branch.branch_name,tbl_salon.salon_name');
        $this->db->join('tbl_branch','tbl_branch.id = tbl_salon_customer.branch_id');
        $this->db->join('tbl_salon','tbl_salon.id = tbl_salon_customer.salon_id');
		$this->db->where('tbl_salon_customer.is_deleted','0');
		$this->db->order_by('tbl_salon_customer.id','DESC');
		$result = $this->db->get('tbl_salon_customer');
		return $result->result();
	}
	public function get_all_customers_queries(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_customer_support');
		return $result->result();
	}
	public function get_all_subjects(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_complaint_reason');
		return $result->result();
	}
    public function rule_update_requests_response(){
        $hidden_id = $this->input->post('hidden_id') != "" ? explode(',',$this->input->post('hidden_id')) : []; 
        $type = $this->input->post('type');
        $branch = $this->input->post('branch');
        $remark = $this->input->post('remark');
        if($hidden_id != "" && is_array($hidden_id) && !empty($hidden_id)){
            $this->db->where_in('tbl_booking_rule_update_requests.id',$hidden_id);
            $result = $this->db->get('tbl_booking_rule_update_requests')->result();
            if(!empty($result)){
                foreach($result as $data){
                    if($type == '1'){
                        $this->db->where('salon_id',$data->salon_id);
                        $this->db->where('branch_id',$data->branch_id);
                        $this->db->where('id',$data->booking_rule_id);
                        $exist_rule = $this->db->get('tbl_booking_rules')->row();
                        if(!empty($exist_rule)){
                            $db_columns = explode('@@@',$data->tbl_booking_rule_column);
                            $change_to_values = explode('@@@',$data->change_to);
                            if($change_to_values != "" && is_array($change_to_values) && !empty($change_to_values) && $db_columns != "" && is_array($db_columns) && !empty($db_columns) && count($change_to_values) && count($db_columns)){
                                for($i=0;$i<count($change_to_values);$i++){
                                    if ($this->db->field_exists($db_columns[$i], 'tbl_booking_rules')) {
                                        $update_rule_data = array(
                                            $db_columns[$i]   =>  $change_to_values[$i]
                                        );
                                        $this->db->where('id',$exist_rule->id);
                                        $this->db->update('tbl_booking_rules',$update_rule_data);
                                    }
                                }
                                $update_data = array(
                                    'approval_status'   =>  '1',
                                    'accept_remark'     =>  $remark,
                                    'accepted_by'       =>  $this->session->userdata('admin_id'),
                                    'accepted_on'       =>  date('Y-m-d H:i:s'),
                                );
                                $this->db->where('id',$data->id);
                                $this->db->update('tbl_booking_rule_update_requests',$update_data);
                            }
                        }
                    }elseif($type == '2'){
                        $update_data = array(
                            'approval_status'   =>  '2',
                            'reject_remark'     =>  $remark,
                            'rejected_by'       =>  $this->session->userdata('admin_id'),
                            'rejected_on'       =>  date('Y-m-d H:i:s'),
                        );
                        $this->db->where('id',$data->id);
                        $this->db->update('tbl_booking_rule_update_requests',$update_data);
                    }
                }
                return 0;
            }else{
                return 1;
            }
        }else{
            return 1;
        }
    }
    public function get_request_response_form(){
        $type = $this->input->post('type');
        $branch = $this->input->post('branch');
        if($type == '1'){
            $style="background-color:#4cae4c;";
            $text = 'Approve';
        }elseif($type == '2'){
            $style="background-color:#d43f3a;";
            $text = 'Reject';
        }
        $ids = $this->input->post('ids');
        if($ids != "" && $ids != null && !empty($ids)){
            $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon_type.type as store_type_text , tbl_salon.salon_name, tbl_branch.branch_name');
            $this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
            $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rule_update_requests.store_type');
            $this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
            $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
            $this->db->where_in('tbl_booking_rule_update_requests.id',$ids);
            $single = $this->db->get('tbl_booking_rule_update_requests')->result();
            if(!empty($single)){
                ?>
                <h3 style="color: #2d334f; font-size: 20px; font-weight: 700;"><?='Total ' . count($ids);?> Requests selected</h3>
                <hr>
                <form method="post" name="add_message_form" id="add_message_form" enctype="multipart/form-data" action="<?=base_url();?>rule-update-requests-response">        
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label style="display:block;">Enter <?=$text;?> Remark</label>                   
                            <textarea style="width:100%;height:100px;" class="form-control" id="remark" name="remark"></textarea>  
                            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo implode(',',$ids); ?>">                             
                            <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">                             
                            <input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>">                             
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                            <button type="submit" id="submit_message_button" class="btn btn-primary" style="<?=$style;?>margin-top:25px;">Submit</button>
                        </div>
                    </div>
                </form>
                <script>
                    $('#add_message_form').validate({
                        ignore: [],
                        rules: {
                            remark: {
                                // required: true
                            },
                        },
                        messages: {
                            remark: "Please enter remark!",
                        },
                        submitHandler: function(form) {
                            if (confirm("Are you sure to update request?")) {
                                form.submit();
                            } else {
                                return false;
                            }
                        }
                    });
                </script>
                <?php
            }
        }else{
            $this->db->select('tbl_booking_rule_update_requests.*, tbl_salon_type.type as store_type_text , tbl_salon.salon_name, tbl_branch.branch_name');
            $this->db->join('tbl_salon','tbl_salon.id = tbl_booking_rule_update_requests.salon_id');
            $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rule_update_requests.store_type');
            $this->db->join('tbl_branch','tbl_branch.id = tbl_booking_rule_update_requests.branch_id');
            $this->db->where('tbl_booking_rule_update_requests.is_deleted','0');
            $this->db->where('tbl_booking_rule_update_requests.id',$this->input->post('id'));
            $lead_single = $this->db->get('tbl_booking_rule_update_requests')->row();            
            if(!empty($lead_single)){
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Rule Type</th>
                        <th>Rule Description</th>
                        <th>Submitted On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$lead_single->store_type_text;?></td>
                        <td>
                            <?php
                                $rules_fields = explode('@@@', $lead_single->booking_rule_field); 
                                $new_values_fields = explode('@@@', $lead_single->change_to_label); 
                                $old_values_fields = explode('@@@', $lead_single->change_from_label); 
                                $rules_desc = '';
                                if($lead_single->field_main_label != ""){
                                    $rules_desc .= '<p style="color:#000;"><b>'.str_replace('*', '', $lead_single->field_main_label).'</b></p>';
                                }
                                $count = count($rules_fields);
                                if ($count > 1) {
                                    for ($i = 0; $i < $count; $i++) {
                                        if($rules_fields[$i] != ""){
                                            $rules_desc .= '<p style="margin:0px;color:#000;">' . ($i + 1) . '. ' . preg_replace('/\*(.*)/', '<br><small>$1</small>', $rules_fields[$i]) . '</p>';
                                        }else{
                                            $rules_desc .= '<p style="margin:0px;color:#000;">' . ($i + 1) . '. -</p>';
                                        }
                                        $new_value = $new_values_fields[$i];
                                        $old_value = $old_values_fields[$i];
                                        $rules_desc .= '<p style="font-size: 12px;margin:0px;color:#000;padding-left:40px;">New Value: <span style="color:#525252;">' . $new_value . '</span></p>';
                                        $rules_desc .= '<p style="font-size: 12px;margin:0px;color:#000;padding-left:40px;">Previous Value: <span style="color:#525252;">' . $old_value . '</span></p>';
                                    }
                                } else {
                                    $rules_desc = '<p style="margin:0px;color:#000;">' . preg_replace('/\*(.*)/', '<br><small>$1</small>', $rules_fields[0]) . '</p>';
                                    $new_value = $new_values_fields[0];
                                    $old_value = $old_values_fields[0];
                                    $rules_desc .= '<p style="font-size: 12px;margin:0px;color:#000;padding-left:40px;">New Value: <span style="color:#525252;">' . $new_value . '</span></p>';
                                    $rules_desc .= '<p style="font-size: 12px;margin:0px;color:#000;padding-left:40px;">Previous Value: <span style="color:#525252;">' . $old_value . '</span></p>';
                                }
                                echo $rules_desc;
                            ?>
                        </td>
                        <td><?=date('d-m-Y h:i A',strtotime($lead_single->submitted_on));?></td>
                    </tr>
                </tbody>
            </table>
            <form method="post" name="add_message_form" id="add_message_form" enctype="multipart/form-data" action="<?=base_url();?>rule-update-requests-response">        
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                        <label style="display:block;">Enter <?=$text;?> Remark</label>                   
                        <textarea style="width:100%;height:100px;" class="form-control" id="remark" name="remark"></textarea>  
                        <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $lead_single->id; ?>">                             
                        <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">                        
                        <input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>">                            
                    </div>
                </div>   
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                        <button type="submit" id="submit_message_button" class="btn btn-primary" style="<?=$style;?>margin-top:25px;">Submit</button>
                    </div>
                </div>
            </form>
            <script>
                $('#add_message_form').validate({
                    ignore: [],
                    rules: {
                        remark: {
                            // required: true
                        },
                    },
                    messages: {
                        remark: "Please enter remark!",
                    },
                    submitHandler: function(form) {
                        if (confirm("Are you sure to update request?")) {
                            form.submit();
                        } else {
                            return false;
                        }
                    },
                });
            </script>
            <?php
        }}
    }
    public function invalid_lead(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $exist = $this->db->get('tbl_salon_survey')->row();
        if(!empty($exist)){
            $data = array(
                'valid_invalid' =>  '1',
                'valid_by'      =>  $this->session->userdata('admin_id'),
                'valid_on'      =>  date('Y-m-d H:i:s'),
                'invalid_by'    =>  '',
                'invalid_on'    =>  '',
            );
            $this->db->where('id',$this->uri->segment(2));
            $this->db->update('tbl_salon_survey',$data);
            return true;
        }else{
            return false;
        }
    }
    public function valid_lead(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $exist = $this->db->get('tbl_salon_survey')->row();
        if(!empty($exist)){
            $data = array(
                'valid_invalid' =>  '0',
                'invalid_by'    =>  $this->session->userdata('admin_id'),
                'invalid_on'    =>  date('Y-m-d H:i:s'),
                'valid_by'      =>  '',
                'valid_on'      =>  '',
            );
            $this->db->where('id',$this->uri->segment(2));
            $this->db->update('tbl_salon_survey',$data);
            return true;
        }else{
            return false;
        }
    }
    public function get_dashboard_counts_ajx() {
        function calculate_percentage_change($current_value, $last_week_value) {
            if ($last_week_value == 0) {
                return [
                    'change_percentage' => $current_value > 0 ? 100 : 0,
                    'status' => $current_value > 0 ? 1 : 2,
                    'difference' => $current_value
                ];
            }
    
            $percentage_change = (($current_value - $last_week_value) / $last_week_value) * 100;
            $status = $percentage_change > 0 ? 1 : ($percentage_change < 0 ? 0 : 2);

            return [
                    'change_percentage' => abs($percentage_change),
                    'status' => $status,
                    'difference' => $current_value - $last_week_value
                ];
        }
    
        $salon_count = count($this->get_salons('', '', date('Y-m-d')));
        $branch_count = count($this->get_branches('', '', '', date('Y-m-d')));
        $total_customer = count($this->get_customers('', '', '', '', '', '', date('Y-m-d')));
        $total_app_customer = count($this->get_customers('1', '', '', '', '', '', date('Y-m-d')));
        $bought_subscriptions_amount = $this->get_sold_subscriptions('', '', '', date('Y-m-d'));
        $due_subscriptions_amount = $this->get_sold_subscriptions_due('', '', '', date('Y-m-d'));
        
        $today_salon_count = count($this->get_salons(date('Y-m-d'), date('Y-m-d'), ''));
        $today_branch_count = count($this->get_branches('', date('Y-m-d'), date('Y-m-d'), ''));
        $today_customer = count($this->get_customers('', '', '', date('Y-m-d'), date('Y-m-d'), '', ''));
        $today_app_customers = count($this->get_customers('1', '', '', date('Y-m-d'), date('Y-m-d'), '', ''));
        $today_bought_subscriptions_amount = $this->get_sold_subscriptions('', date('Y-m-d'), date('Y-m-d'), '');        
        
        $currentDate = new DateTime();
        $this_month_start = $currentDate->modify('first day of this month')->format('Y-m-d');
        $this_month_end = $currentDate->modify('last day of this month')->format('Y-m-d');
        $month_salon_count = count($this->get_salons($this_month_start, $this_month_end, ''));
        $month_branch_count = count($this->get_branches('', $this_month_start, $this_month_end, ''));
        $month_customer = count($this->get_customers('', '', '', $this_month_start, $this_month_end, '', ''));
        $month_app_customers = count($this->get_customers('1', '', '', $this_month_start, $this_month_end, '', ''));
        $month_bought_subscriptions_amount = $this->get_sold_subscriptions('', $this_month_start, $this_month_end, '');
    
        $current_date = new DateTime();
        $last_week_from = (clone $current_date)->modify('-7 days')->format('Y-m-d');
    
        $salon_count_last_week = count($this->get_salons('','',$last_week_from));
        $branch_count_last_week = count($this->get_branches('', '','',$last_week_from));
        $total_customer_last_week = count($this->get_customers('', '', '', '','', '',$last_week_from));
        $total_app_customers_last_week = count($this->get_customers('1', '', '', '','', '',$last_week_from));
        $bought_subscriptions_amount_last_week = $this->get_sold_subscriptions('', '','',$last_week_from);
        $due_subscriptions_amount_last_week = $this->get_sold_subscriptions_due('', '','',$last_week_from);
    
        $custom = array(
            'salon_count' => $salon_count,
            'salon_count_last_week' => $salon_count_last_week,
            'salon_count_comparison' => calculate_percentage_change($salon_count, $salon_count_last_week),
            'branch_count' => $branch_count,
            'branch_count_last_week' => $branch_count_last_week,
            'branch_count_comparison' => calculate_percentage_change($branch_count, $branch_count_last_week),
            'total_customer' => $total_customer,
            'total_customer_last_week' => $total_customer_last_week,
            'total_customer_comparison' => calculate_percentage_change($total_customer, $total_customer_last_week),
            'total_app_customers' => $total_app_customer,
            'total_app_customers_last_week' => $total_app_customers_last_week,
            'total_app_customers_comparison' => calculate_percentage_change($total_app_customer, $total_app_customers_last_week),
            'bought_subscriptions_amount' => $bought_subscriptions_amount,
            'bought_subscriptions_amount_last_week' => $bought_subscriptions_amount_last_week,
            'bought_subscriptions_amount_comparison' => calculate_percentage_change($bought_subscriptions_amount, $bought_subscriptions_amount_last_week),
            'due_subscriptions_amount' => $due_subscriptions_amount,
            'due_subscriptions_amount_last_week' => $due_subscriptions_amount_last_week,
            'due_subscriptions_amount_comparison' => calculate_percentage_change($due_subscriptions_amount, $due_subscriptions_amount_last_week),
            
            'today_salon_count'                 => $today_salon_count,
            'today_branch_count'                => $today_branch_count,
            'today_customer'                    => $today_customer,
            'today_app_customers'               => $today_app_customers,
            'today_bought_subscriptions_amount' => $today_bought_subscriptions_amount,
            
            'month_salon_count'                 => $month_salon_count,
            'month_branch_count'                => $month_branch_count,
            'month_customer'                    => $month_customer,
            'month_app_customers'               => $month_app_customers,
            'month_bought_subscriptions_amount' => $month_bought_subscriptions_amount,
        );
    
        echo json_encode($custom);
    }  
    
    public function get_sold_subscriptions_due($salon,$from_date,$to_date,$beyond_date){
        $this->db->where('is_deleted','0');
        if($salon != ""){
            $this->db->where('salon_id',$salon);
        }
        if($from_date != ""){
            $this->db->where('DATE(created_on) >= ',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($to_date)));
        }
        if($beyond_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($beyond_date)));
        }
        $result = $this->db->get('tbl_branch')->result();  
        $total = 0;
        if(!empty($result)){
            foreach($result as $data){
                $total += $data->pending_due_amount != "" ? (float)$data->pending_due_amount : 0.00;
            }
        }
        return $total;
    }
    public function get_sold_subscriptions($salon,$from_date,$to_date,$beyond_date){
        $this->db->where('is_deleted','0');
        if($salon != ""){
            $this->db->where('salon_id',$salon);
        }
        if($from_date != ""){
            $this->db->where('DATE(created_on) >= ',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($to_date)));
        }
        if($beyond_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($beyond_date)));
        }
        $result = $this->db->get('tbl_branch')->result();  
        $total = 0;
        if(!empty($result)){
            foreach($result as $data){
                $total += $data->subscription_price != "" ? (float)$data->subscription_price : 0.00;
            }
        }
        return $total;
    }
    public function get_all_salons($id){
        $this->db->select('tbl_branch.*, tbl_salon.salon_name');
        $this->db->join('tbl_salon','tbl_salon.id = tbl_branch.salon_id');
        $this->db->where('tbl_branch.is_deleted','0');
        $this->db->where('tbl_salon.is_deleted','0');
        if($id != ""){
            $this->db->where('tbl_branch.id', $id);
        }
        $result = $this->db->get('tbl_branch')->result();  
        return $result;
    }  
    public function get_salons($from_date,$to_date,$beyond_date){
        $this->db->where('is_deleted','0');
        if($from_date != ""){
            $this->db->where('DATE(created_on) >= ',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($to_date)));
        }
        if($beyond_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($beyond_date)));
        }
        $result = $this->db->get('tbl_salon')->result();  
        return $result;
    }  
    public function get_branches($salon,$from_date,$to_date,$beyond_date){
        $this->db->where('is_deleted','0');
        if($salon != ""){
            $this->db->where('salon_id',$salon);
        }
        if($from_date != ""){
            $this->db->where('DATE(created_on) >= ',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($to_date)));
        }
        if($beyond_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($beyond_date)));
        }
        $result = $this->db->get('tbl_branch')->result();  
        return $result;
    } 
    public function get_customers($source,$branch,$salon,$from_date,$to_date,$is_logged_in,$beyond_date){
        $this->db->where('is_deleted','0');
        if($is_logged_in != ""){
            $this->db->where('is_logged_in',$is_logged_in);
        }
        if($source != ""){
            $this->db->where('registered_from',$source);
        }
        if($salon != ""){
            $this->db->where('salon_id',$salon);
        }
        if($salon != ""){
            $this->db->where('branch_id',$branch);
        }
        if($from_date != ""){
            $this->db->where('DATE(created_on) >= ',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($to_date)));
        }
        if($beyond_date != ""){
            $this->db->where('DATE(created_on) <= ',date('Y-m-d',strtotime($beyond_date)));
        }
        $result = $this->db->get('tbl_salon_customer')->result();  
        return $result;
    } 
    public function reset_expired_subscriptions(){
        $this->db->select('tbl_branch.*,tbl_branch_subscription_allocation.allocation_status');
        $this->db->join('tbl_branch_subscription_allocation', 'tbl_branch_subscription_allocation.id = tbl_branch.subscription_allocation_id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->where('tbl_branch.status', '1');
        $this->db->where('tbl_branch_subscription_allocation.allocation_status', '1');
        $result = $this->db->get('tbl_branch');
        $result = $result->result(); 
        if(!empty($result)){
            foreach($result as $data){
                $currentDateTime = date('Y-m-d H:i:s');
                if (strtotime($data->subscription_end) < strtotime($currentDateTime)) {
                    $sub_allocation_data = array(
                        'allocation_status' =>  '2'
                    );
                    $this->db->where('id',$data->subscription_allocation_id);
                    $this->db->update('tbl_branch_subscription_allocation',$sub_allocation_data);

                    $sub_data = array(
                        'subscription_id'  		    =>  null, 
                        'subscription_price'        =>  '',
                        'subscription_validity'     =>  '',
                        'subscription_start'        =>  null,
                        'subscription_end'          =>  null,
                        'pending_due_amount'        =>  ''
                    );
                    $this->db->where('id',$data->id);
                    $this->db->update('tbl_branch',$sub_data);

                    $salon_id = $data->salon_id;
                    $branch_id = $data->id;
                    $type = '5';
                    $title = 'Branch Subscription Reset Because Validity Expired';
                    $desc = 'Subscription details of branch are reset because subscription validity is expired';
                    $this->set_branch_log($branch_id,$salon_id,$type,$desc,$title);
                }
            }
            echo '1';
        }else{
            echo '0';
        }
    }  
    public function get_subscription_features($id){
        // $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_subscription_master')->row();
        $features = [];
        if(!empty($result)){
            $all_features = $result->features != "" ? explode(',', $result->features) : [];
            for($i=0; $i<count($all_features); $i++){
                $this->db->select('tbl_subscription_feature_slug.*,tbl_subscription_feature.feature as feature_name');
                $this->db->join('tbl_subscription_feature', 'tbl_subscription_feature.id = tbl_subscription_feature_slug.feature');
                $this->db->where('tbl_subscription_feature_slug.is_deleted', '0');
                $this->db->order_by('tbl_subscription_feature_slug.id', 'asc');
                $this->db->where('tbl_subscription_feature_slug.feature', $all_features[$i]);
                $all_units = $this->db->get('tbl_subscription_feature_slug')->result();
                if(!empty($all_units)){
                    foreach($all_units as $data){
                        $features[] = array(
                            'feature'       => $data->feature_name,
                            'description'   => $data->description,
                            'slug'          => $data->slug,
                        );
                    }
                }
            }
            return $features;
        }else{
            return false;
        }
    }
    public function get_subscription_features_list($ids){
        $this->db->select('tbl_subscription_feature_slug.*,tbl_subscription_feature.feature as feature_name');
        $this->db->join('tbl_subscription_feature', 'tbl_subscription_feature.id = tbl_subscription_feature_slug.feature');
        $this->db->where('tbl_subscription_feature_slug.is_deleted', '0');
        $this->db->order_by('tbl_subscription_feature_slug.id', 'asc');
        $this->db->where_in('tbl_subscription_feature_slug.feature', $ids);
        $all_units = $this->db->get('tbl_subscription_feature_slug')->result();
        return $all_units;
    }
    public function get_subscription_wp_features_list($id,$slug_ids){
        $this->db->select('tbl_subscription_feature_slug.*,tbl_subscription_feature.feature as feature_name');
        $this->db->join('tbl_subscription_feature', 'tbl_subscription_feature.id = tbl_subscription_feature_slug.feature');
        $this->db->where('tbl_subscription_feature_slug.is_deleted', '0');
        $this->db->order_by('tbl_subscription_feature_slug.id', 'asc');
        $this->db->where('tbl_subscription_feature_slug.feature', $id);
        $this->db->where_in('tbl_subscription_feature_slug.slug', $slug_ids);
        $all_units = $this->db->get('tbl_subscription_feature_slug')->result();
        return $all_units;
    }

    
	public function get_app_users_list_ajx($length, $start, $search){
        if($search !=""){
            $this->db->or_like('tbl_app_users.project',$search);
            $this->db->or_like('tbl_app_users.username',$search);
            $this->db->or_like('tbl_app_users.password',$search);
            $this->db->or_like('tbl_app_users.mobile_no',$search);
            $this->db->or_like('tbl_app_users.email',$search);
            $this->db->or_like('tbl_app_users.name',$search);
            $this->db->or_like('tbl_app_users.last_login_on',$search);
            $this->db->or_like('tbl_app_users.device_details',$search);
        }	

        if($this->input->post('project') !=""){
            $this->db->where('tbl_app_users.project', $this->input->post('project'));
        }
        
        $this->db->where('tbl_app_users.is_deleted','0');
        $this->db->order_by('tbl_app_users.id','DESC');
        $this->db->limit($length,$start);
        $result = $this->db->get('tbl_app_users');
        return $result->result();		
	}
	public function get_app_users_count_ajx($search){
        if($search !=""){
            $this->db->or_like('tbl_app_users.project',$search);
            $this->db->or_like('tbl_app_users.username',$search);
            $this->db->or_like('tbl_app_users.password',$search);
            $this->db->or_like('tbl_app_users.mobile_no',$search);
            $this->db->or_like('tbl_app_users.email',$search);
            $this->db->or_like('tbl_app_users.name',$search);
            $this->db->or_like('tbl_app_users.last_login_on',$search);
            $this->db->or_like('tbl_app_users.device_details',$search);
        }

        if($this->input->post('project') !=""){
            $this->db->where('tbl_app_users.project', $this->input->post('project'));
        }	

        $this->db->where('tbl_app_users.is_deleted','0');
        $this->db->order_by('tbl_app_users.id','DESC');
        $result = $this->db->get('tbl_app_users');
        return $result->num_rows();
	}
    public function check_gender_reward_ajax(){
        $gender = $this->input->post('gender');
        $this->db->where('is_deleted','0');
        $this->db->where('gender',$gender);
        $result = $this->db->get('tbl_admin_reward_point')->num_rows();
        if($result > 0){
            echo '0';
        }else{
            echo '1';
        }
    }
    public function get_unique_sup_category()
    {
        $this->db->where('sup_category', rtrim($this->input->post('sup_category')));
        $this->db->where('gender', $this->input->post('gender'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $result = $this->db->get('tbl_admin_service_category');
        echo $result->num_rows();
    }
    public function check_unique_email_ajax(){
        $this->db->where('email',$this->input->post('email'));
        $this->db->where('is_deleted','0');
        $count = $this->db->get('tbl_branch')->num_rows();
        if($count > 0){
            echo '0';
        }else{
            echo '1';
        }
    }
    
	public function update_pending_product($product_photo){
        if($product_photo == ''){
            $product_photo = $this->input->post('old_product_photo');
        }
        
        $discount_in = '0';
	    if($this->input->post('discount_in') != ''){
	        $discount_in = $this->input->post('discount_in');
	    }
        $data = array(
            'product_category' 	    => $this->input->post('product_category') != "" ? $this->input->post('product_category') : $this->input->post('selected_product_category'),
            'product_subcategory' 	=> $this->input->post('product_sub_category') != "" ? $this->input->post('product_sub_category') : $this->input->post('selected_product_sub_category'),
            'product_name' 		=> $this->input->post('product_name'),
            'low_stock' 		=> $this->input->post('low_stock'),
            'high_stock' 		=> $this->input->post('high_stock'),
            'hsn_code' 			=> $this->input->post('hsn_code'),
            'date_require' 		=> $this->input->post('date_require'),
            'expiry_date' 		=> $this->input->post('expiry_date') != "" ? date('Y-m-d', strtotime($this->input->post('expiry_date'))) : '',
            'mfg_date' 			=> $this->input->post('mfg_date') != "" ? date('Y-m-d', strtotime($this->input->post('mfg_date'))) : '',
            'discount' 			=> $this->input->post('discount'),
            'discount_in'		=> $discount_in,
            'incentive' 		=> $this->input->post('incentive'),
            'description' 		=> $this->input->post('description'),
            'product_unit' 		=> $this->input->post('product_unit'),
            'selling_price' 	=> $this->input->post('selling_price'),
            'low_stock_alert' 	=> $this->input->post('low_stock_alert'),
            'online_store' 		=> $this->input->post('online_store'),
            'product_photo' 	=> $product_photo,
        ); 
        // echo '<pre>'; print_r($data); exit;
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_product', $data);
        return true;
    } 

    public function get_website_contact_list(){
        $this->db->select('tbl_contact_us.*');
        $this->db->where('tbl_contact_us.is_deleted', '0');
        $this->db->where('tbl_contact_us.website_type', '0');
        $result = $this->db->get('tbl_contact_us');
		return $result->result();
    }

    

    public function get_business_contact_list(){
        $this->db->select('tbl_contact_us.*');
        $this->db->where('tbl_contact_us.is_deleted', '0');
        $this->db->where('tbl_contact_us.website_type', '1');
        $result = $this->db->get('tbl_contact_us');
		return $result->result();
    }

    public function set_whatsapp_addon_plans(){
        $this->db->where('id', $this->input->post('subscription_id'));
        $this->db->where('is_deleted', '0');
        $subscription = $this->db->get('tbl_subscription_master')->row();
        $indices = $this->input->post('indices');
        if(!empty($subscription) && $indices != "" && !empty($indices) && is_array($indices)){
            for($count_index=0;$count_index<count($indices);$count_index++){
                $index = $indices[$count_index];
                $data = array(
                    'subscription_id'   => $this->input->post('subscription_id'), 
                    'plan_name'         => $this->input->post('plan_name_' . $index), 
                    'qty'               => $this->input->post('qty_' . $index), 
                    'price'             => $this->input->post('price_' . $index), 
                    'created_on'        => date("Y-m-d H:i:s")
                );
                $this->db->insert('tbl_whatsapp_addon_plans',$data);
            }
            return 1;
        }else{
            return 0;
        }
    } 
    public function update_whatsapp_addon_plans(){
        $this->db->where('id', $this->input->post('subscription_id'));
        $this->db->where('is_deleted', '0');
        $subscription = $this->db->get('tbl_subscription_master')->row();
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->where('subscription_id', $this->input->post('subscription_id'));
        $this->db->where('is_deleted', '0');
        $exist = $this->db->get('tbl_whatsapp_addon_plans')->row();
        if(!empty($subscription) && !empty($exist)){
            $data = array(
                'plan_name'         => $this->input->post('plan_name'), 
                'qty'               => $this->input->post('qty'), 
                'price'             => $this->input->post('price'), 
            );
            $this->db->where('subscription_id', $subscription->id);
            $this->db->where('id', $exist->id);
            $this->db->update('tbl_whatsapp_addon_plans', $data);
            return 1;
        }else{
            return 0;
        }
    }
    public function get_all_whatsapp_addon_plans(){
        $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
        $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
        $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
        $this->db->where('tbl_subscription_master.is_deleted','0');
        $this->db->order_by('tbl_whatsapp_addon_plans.id','DESC');
        $result = $this->db->get('tbl_whatsapp_addon_plans');
        return $result->result();
    } 
    public function get_subscription_whatsapp_addon_plans($subscription){
        $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
        $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
        $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$subscription);
        $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
        $this->db->where('tbl_subscription_master.is_deleted','0');
        $this->db->order_by('tbl_whatsapp_addon_plans.id','DESC');
        $result = $this->db->get('tbl_whatsapp_addon_plans');
        return $result->result();
    } 
    public function get_single_subscription_whatsapp_addon_plan($id,$subscription = ''){
        $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
        $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
        if($subscription != "0"){
            $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$subscription);
        }
        $this->db->where('tbl_whatsapp_addon_plans.id',$id);
        $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
        $this->db->where('tbl_subscription_master.is_deleted','0');
        $this->db->order_by('tbl_whatsapp_addon_plans.id','DESC');
        $result = $this->db->get('tbl_whatsapp_addon_plans');
        return $result->row();
    } 
    public function get_unique_whatsapp_addon_plan_name(){         
        $plan_names = $this->input->post('plan_names');
        $subscription_id = $this->input->post('subscription_id');
        $id = $this->input->post('id');

        $duplicates = [];

        if(!empty($plan_names)){
            foreach ($plan_names as $name) {
                $exists = $this->is_plan_name_exist($name, $subscription_id, $id);
                if ($exists) {
                    $duplicates[] = $name;
                }
            }
        }

        echo json_encode($duplicates);
    } 
    public function is_plan_name_exist($name, $subscription_id, $exclude_id) {
        $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
        $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
        $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$subscription_id);
        $this->db->where('tbl_whatsapp_addon_plans.plan_name',$name);
        if($exclude_id != ""){
            $this->db->where('tbl_whatsapp_addon_plans.id !=',$exclude_id);
        }
        $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
        $this->db->where('tbl_subscription_master.is_deleted','0');
        $result = $this->db->get('tbl_whatsapp_addon_plans');
        return $result->num_rows() > 0;
    }
    public function get_unique_whatsapp_addon_plan_qty(){ 
        $qtys = $this->input->post('qtys');
        $subscription_id = $this->input->post('subscription_id');
        $id = $this->input->post('id');

        $duplicates = [];

        if(!empty($qtys)){
            foreach ($qtys as $qty) {
                $exists = $this->is_qty_name_exist($qty, $subscription_id, $id);
                if ($exists) {
                    $duplicates[] = $qty;
                }
            }
        }

        echo json_encode($duplicates);
    } 
    public function is_qty_name_exist($qty, $subscription_id, $exclude_id) {
        $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
        $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
        $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$subscription_id);
        $this->db->where('tbl_whatsapp_addon_plans.qty',$qty);
        if($exclude_id != ""){
            $this->db->where('tbl_whatsapp_addon_plans.id !=',$exclude_id);
        }
        $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
        $this->db->where('tbl_subscription_master.is_deleted','0');
        $result = $this->db->get('tbl_whatsapp_addon_plans');
        return $result->num_rows() > 0;
    }

    public function purchase_add_on(){
		// echo '<pre>'; print_r($_POST); exit;
        $branch = $this->input->post('id');
        $payment_id = $this->input->post('payment_id');
        $payment_mode = $this->input->post('payment_mode');
        $setup = $this->Master_model->get_backend_setups();
        $value = !empty($setup) ? (int)$setup->wp_low_qty_value : 25;
		$branch_details = $this->Admin_model->get_branch_details($branch);
		if(!empty($branch_details)){ 
			$wp_coins_qty = $branch_details->wp_coins_qty != "" ? (int)$branch_details->wp_coins_qty : 0;
			$value = ($value * $wp_coins_qty) / 100;
            if($branch_details->include_wp == '1' && $branch_details->current_wp_coins_balance <= $value){
                $add_on_plan = $this->input->post('add_on_plan');
                $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
                $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
                $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$branch_details->subscription_id);
                $this->db->where('tbl_whatsapp_addon_plans.id',$add_on_plan);
                $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
                $this->db->where('tbl_subscription_master.is_deleted','0');
                $this->db->order_by('tbl_whatsapp_addon_plans.id','DESC');
                $result = $this->db->get('tbl_whatsapp_addon_plans');
                $exist = $result->row();
                if(!empty($exist)){                
                    $opening_due = $branch_details->pending_due_amount != "" ? (float)$branch_details->pending_due_amount : 0.00;
                    $closing_due = $opening_due - (float)$exist->price;

                    $active_addon = $this->Salon_model->get_branch_active_addons($branch_details->id,$branch_details->salon_id);
                    $old_addon_payment_id = null;
                    if(!empty($active_addon)){
                        $old_addon_payment_id = $active_addon->id;
                        $this->db->where('id',$old_addon_payment_id);
                        $this->db->update('tbl_branch_payment_details',array('wp_addon_status'=>'0','addon_inactive_on'=>date('Y-m-d H:i:s'),'addon_inactive_remark'=>'New Add on Purchased'));
                    }
                    
                    $active_addon_request = $this->Salon_model->get_branch_active_addon_request($branch_details->id,$branch_details->salon_id);
                    $old_addon_request_id = null;
                    if(!empty($active_addon_request)){
                        $old_addon_request_id = $active_addon_request->id;
                        $this->db->where('id',$old_addon_request_id);
                        $this->db->update('tbl_wp_addon_requests',array('wp_addon_request_status'=>'0','inactive_on'=>date('Y-m-d H:i:s'),'inactive_remark'=>'Add on Plan Purchased'));
                    }

                    $gst_no = $branch_details->is_gst_applicable == '1' ? ($branch_details->gst_no != "" ? $branch_details->gst_no : null) : null;

                    $igst_rate = 0;
                    // $igst_rate = $branch_details->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0;
                    $cgst_rate = $branch_details->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0;
                    $sgst_rate = $branch_details->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0;
                    $gst_rate = $branch_details->is_gst_applicable == '1' ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0;

                    $igst = ($igst_rate * $exist->price) / 100;
                    $cgst = ($cgst_rate * $exist->price) / 100;
                    $sgst = ($sgst_rate * $exist->price) / 100;
                    $gst = ($gst_rate * $exist->price) / 100;

                    $final_amount = $gst + $exist->price;

                    $data = array(
                        'branch_id'                     =>  $branch_details->id,
                        'salon_id'                      =>  $branch_details->salon_id,
                        'payment_type'                  =>  '1',
                        'wp_addon_status'               =>  '1',
                        'payment_amount'                =>  $exist->price,

                        'is_gst_applicable'             =>  $branch_details->is_gst_applicable,
                        'branch_gst_no'                 =>  $gst_no,
                        'gst'                           =>  $gst,
                        'gst_rate'                      =>  $gst_rate,
                        'igst'                          =>  $igst,
                        'igst_rate'                     =>  $igst_rate,
                        'cgst'                          =>  $cgst,
                        'cgst_rate'                     =>  $cgst_rate,
                        'sgst'                          =>  $sgst,
                        'sgst_rate'                     =>  $sgst_rate,
                        'final_amount'                  =>  $final_amount,

                        'coin_balance_used'             =>  0,
                        'coin_balance_used_in_rs'       =>  0,
                        'per_coin_rs_value'             =>  null,
                        'payment_date'                  =>  date('Y-m-d'),
                        'remark'                        =>  'Whatsapp Add On Plan Payment',
                        'add_on_plan_id'                =>  $exist->id,
                        'plan_name'                     =>  $exist->plan_name,
                        'plan_price'                    =>  $exist->price,
                        'plan_qty'                      =>  $exist->qty,
                        'payment_entry_by'              =>  $this->session->userdata('admin_id'),
                        'opening_due'                   =>  $opening_due,
                        'closing_due'                   =>  $closing_due,
                        'payment_mode'                  =>  $payment_mode,
                        'payment_id'                    =>  $payment_id,
                        'old_addon_payment_id'          =>  $old_addon_payment_id,
                        'addon_request_id'              =>  $old_addon_request_id,
                        'created_on'                    =>  date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tbl_branch_payment_details',$data);
                    $branch_payment_id = $this->db->insert_id();
                    
                    $total_count = $this->get_year_booking_count(date('Y-m-d H:i:s'),$branch_payment_id);
                    $year = date('Y');
                    $month = date('m');

                    if ((int)$month >= 4) {
                        $fy_start = (int)$year % 100;
                        $fy_end = $fy_start + 1;
                    } else {
                        $fy_end = (int)$year % 100;
                        $fy_start = $fy_end - 1;
                    }
                    $financial_year = 'FY' . sprintf('%02d', $fy_start) . '-' . sprintf('%02d', $fy_end);
                    $count_formatted = sprintf('%04d', $total_count + 1);
                    $invoice_id = 'NAP-GST-' . $financial_year . '-' . $count_formatted;
                    $invoice_id_data = array(
                        'invoice_id' => $invoice_id
                    );

                    $this->db->where('id',$branch_payment_id);
                    $this->db->update('tbl_branch_payment_details',$invoice_id_data);
                    
                    $old_current_wp_coins_balance = $branch_details->current_wp_coins_balance != "" ? (int)$branch_details->current_wp_coins_balance : 0;
                    $count = $exist->qty != "" ? (int)$exist->qty : 0;
                    $branch_data = array(
                        'current_wp_coins_balance'  =>  $old_current_wp_coins_balance + $count
                    );
                    $this->db->where('subscription_id', $branch_details->subscription_id);
                    $this->db->where('id', $branch_details->id);
                    $this->db->update('tbl_branch', $branch_data);

                    return '0';
                }else{
                    return '1';
                }
            }else{
                return '1';
            }
        }else{
            return '1';
        }
    }
    

    public function request_add_on(){
		// echo '<pre>'; print_r($_POST); exit;
        $branch = $this->input->post('id');
        $setup = $this->Master_model->get_backend_setups();
        $value = !empty($setup) ? (int)$setup->wp_low_qty_value : 25;
		$branch_details = $this->Admin_model->get_branch_details($branch);
		if(!empty($branch_details)){ 
			$wp_coins_qty = $branch_details->wp_coins_qty != "" ? (int)$branch_details->wp_coins_qty : 0;
			$value = ($value * $wp_coins_qty) / 100;
            if($branch_details->include_wp == '1' && $branch_details->current_wp_coins_balance <= $value){
                $add_on_plan = $this->input->post('add_on_plan');
                $this->db->select('tbl_whatsapp_addon_plans.*,tbl_subscription_master.subscription_name');
                $this->db->join('tbl_subscription_master', 'tbl_subscription_master.id = tbl_whatsapp_addon_plans.subscription_id');
                $this->db->where('tbl_whatsapp_addon_plans.subscription_id',$branch_details->subscription_id);
                $this->db->where('tbl_whatsapp_addon_plans.id',$add_on_plan);
                $this->db->where('tbl_whatsapp_addon_plans.is_deleted','0');
                $this->db->where('tbl_subscription_master.is_deleted','0');
                $this->db->order_by('tbl_whatsapp_addon_plans.id','DESC');
                $result = $this->db->get('tbl_whatsapp_addon_plans');
                $exist = $result->row();
                if(!empty($exist)){      
                    $active_addon_request = $this->Salon_model->get_branch_active_addon_request($branch_details->id,$branch_details->salon_id);
                    $old_addon_request_id = null;
                    if(!empty($active_addon_request)){
                        $old_addon_request_id = $active_addon_request->id;
                        $this->db->where('id',$old_addon_request_id);
                        $this->db->update('tbl_wp_addon_requests',array('wp_addon_request_status'=>'0','inactive_on'=>date('Y-m-d H:i:s'),'inactive_remark'=>'New Add on Request Raised'));
                    }
                    $addon_remark = $this->input->post('addon_remark');   
                    $data = array(
                        'branch_id'                     =>  $branch_details->id,
                        'salon_id'                      =>  $branch_details->salon_id,
                        'wp_addon_request_status'       =>  '1',
                        'request_type'                  =>  '0',
                        'remark'                        =>  $addon_remark,
                        'add_on_plan_id'                =>  $exist->id,
                        'plan_name'                     =>  $exist->plan_name,
                        'plan_price'                    =>  $exist->price,
                        'plan_qty'                      =>  $exist->qty,
                        'old_addon_request_id'          =>  $old_addon_request_id,
                        'created_on'                    =>  date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tbl_wp_addon_requests',$data);

                    return '0';
                }else{
                    return '1';
                }
            }else{
                return '1';
            }
        }else{
            return '1';
        }
    }
}   
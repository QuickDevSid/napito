<?php
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__DIR__, 3) . '/vendor/autoload.php';
use WebSocket\Client;

class Salon_model extends CI_Model{
    public function salon_login(){
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', $this->input->post('password')); 
        $result = $this->db->get('tbl_branch');
        $result = $result->row(); 
        if (!empty($result)) {
			$this->db->where('is_deleted', '0');
			$this->db->where('branch_id',$result->id);
			$this->db->where('salon_id',$result->salon_id);
			$store = $this->db->get('tbl_store_profile');
			$store = $store->row();
            $session = array(
                'branch_id' 	=> $result->id,
                'salon_id' 		=> $result->salon_id,
                'branch_name' 	=> $result->branch_name,
                'store_gender' 	=> !empty($store) ? $store->category : '',
            );
            $this->session->set_userdata($session);
            return true;
        } else {
            return false;
        }
    }  
    public function get_user_profile(){
        $this->db->where('id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('branch_name', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_branch');
        $result = $result->row();
        return $result;
    }
    public function get_store_category(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_store_profile');
        $result = $result->row();
        return $result;
    }
    public function get_salon_all_staff(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_employee');
        return $result->num_rows();
    } 
    public function booking_payment(){
		$data = array(
			'branch_id' => $this->session->userdata('branch_id'),
			'salon_id' => $this->session->userdata('salon_id'),
			'amount' => $this->input->post('amount'),
			'stylist_id' => $this->input->post('stylist_id'),
			'service_id' => $this->input->post('service_id'),
			'customer_id' => $this->input->post('customer_id'),
			'payment_date' => $this->input->post('payment_date'),
			'payment_mode' => $this->input->post('payment_mode'),
			'booking_status' => '5',
		); 
		$data1 = array(
			'booking_status' => '5',
		); 
		if($this->input->post('id') == ""){
			$date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$existing_booking = $this->db->get_where('tbl_new_booking', array('stylist' => $data['stylist_id'], 'customer_name' => $data['customer_id']))->row();

			if ($existing_booking) {
				$this->db->where('id', $existing_booking->id);
				$this->db->update('tbl_new_booking', $data1);
			}  
			$this->db->insert('tbl_service_payment', $new_arr);
			$last_insert_id = $this->db->insert_id();
			redirect('booking-print/' . $last_insert_id);
			return 0;
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_service_payment', $data);
			$existing_booking = $this->db->get_where('tbl_new_booking', array('stylist_id' => $data['stylist_id'], 'customer_id' => $data['customer_id']))->row();
			if($existing_booking){
				$this->db->where('id', $existing_booking->id);
				$this->db->update('tbl_new_booking', $data1);
			} 
			return 1;
		}
	} 
	public function cancel_booking(){
		$data = array(
			'is_deleted' => '1',
		);
		if($this->input->post('id') == ""){
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_new_booking', $new_arr);
			return 0;
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_new_booking', $data);
			return 1;
		}
	} 
	public function reschedule_booking_ajax(){
		$data = array(
			'time_slot' 		=> $this->input->post('time_slot'),
			'booking_date' 		=> $this->input->post('booking_date'),
			'stylist' 			=> $this->input->post('stylist'),
		);
		if($this->input->post('id') != ""){
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_new_booking', $data);
			$this->session->set_flashdata('success', 'Booking Reshedule successfully');
			if (!empty($data)) {
				echo 1;
			}else{
				echo 0;
			} 
		}
	}
	public function add_booking_notes(){
		$data = array(
			'personal_note' => $this->input->post('personal_note'),
			'note' => $this->input->post('note'),
		); 
		if ($this->input->post('id') !== "") {
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_new_booking', $new_arr);
			return 1;
		}
	} 
    public function get_salon_services_list_for_calender_booking(){
        $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
    
        $result = $this->db->get();
        return $result->result();
    }
    public function get_all_booking_status_list(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_service_payment');
        $result = $result->result();
        return $result;
    }

    public function get_single_booking_list(){
		$this->db->select('tbl_service_payment.*, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_service_payment');
		$this->db->join('tbl_salon_customer', 'tbl_service_payment.customer_id = tbl_salon_customer.id', 'left');
		$this->db->where('tbl_service_payment.is_deleted', '0');
		$this->db->where('tbl_service_payment.id', $this->uri->segment(2));
		$this->db->where('tbl_service_payment.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_service_payment.salon_id', $this->session->userdata('salon_id')); 
		$result = $this->db->get();
		$result = $result->row(); 
		return $result;
	}  
    public function get_single_booking_details($id){
		$this->db->select('tbl_new_booking.*, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_new_booking');
		$this->db->join('tbl_salon_customer', 'tbl_new_booking.customer_name = tbl_salon_customer.id');
		$this->db->where('tbl_new_booking.is_deleted', '0');
		$this->db->where('tbl_new_booking.id', $id);
		$result = $this->db->get();
		$result = $result->row(); 
		return $result;
	} 
    public function get_single_booking_payment_details($booking_id,$id){
		$this->db->select('tbl_service_payment.*, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_service_payment');
		$this->db->join('tbl_salon_customer', 'tbl_service_payment.customer_name = tbl_salon_customer.id');
		$this->db->where('tbl_service_payment.is_deleted', '0');
		$this->db->where('tbl_service_payment.booking_id', $booking_id);
		$this->db->where('tbl_service_payment.id', $id);
		$result = $this->db->get();
		$result = $result->row(); 
		return $result;
	} 
    public function get_service_paid_products($service_details_id,$booking_id){
		$this->db->select('tbl_booking_services_products_details.*,tbl_product.product_name,tbl_new_booking.selected_coupon_id,tbl_new_booking.pacakge_id,tbl_new_booking.package_amount,tbl_new_booking.total_service_price,tbl_new_booking.total_product_price,tbl_new_booking.service_price,tbl_new_booking.product_price,tbl_new_booking.gst_amount,tbl_new_booking.payble_price,tbl_new_booking.coupon_discount_amount,tbl_new_booking.reward_discount_amount,tbl_new_booking.booking_amount,tbl_new_booking.amount_to_paid,tbl_new_booking.is_giftcard_applied,tbl_new_booking.applied_giftcard_id,tbl_new_booking.gift_discount,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.booking_date,tbl_new_booking.note,tbl_new_booking.payment_date,tbl_new_booking.payment_mode,tbl_new_booking.payment_status,tbl_new_booking.reminder, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_booking_services_products_details');
		$this->db->join('tbl_salon_customer', 'tbl_booking_services_products_details.customer_name = tbl_salon_customer.id');
		$this->db->join('tbl_new_booking', 'tbl_booking_services_products_details.booking_id = tbl_new_booking.id');
		$this->db->join('tbl_product', 'tbl_booking_services_products_details.product_id = tbl_product.id');
		$this->db->where('tbl_booking_services_products_details.payment_status', '1');
		$this->db->where('tbl_booking_services_products_details.is_deleted', '0');
		$this->db->where('tbl_booking_services_products_details.booking_service_details_id', $service_details_id);
		$this->db->where('tbl_booking_services_products_details.booking_id', $booking_id);
		$result = $this->db->get();
		$result = $result->result(); 
		return $result;
	} 
    public function get_single_booking_service_details($id){
		$this->db->select('tbl_booking_services_details.*,tbl_salon_employee.full_name as stylist_name, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_new_booking.selected_coupon_id,tbl_new_booking.pacakge_id,tbl_new_booking.package_amount,tbl_new_booking.total_service_price,tbl_new_booking.total_product_price,tbl_new_booking.service_price,tbl_new_booking.product_price,tbl_new_booking.gst_amount,tbl_new_booking.payble_price,tbl_new_booking.coupon_discount_amount,tbl_new_booking.reward_discount_amount,tbl_new_booking.booking_amount,tbl_new_booking.amount_to_paid,tbl_new_booking.is_giftcard_applied,tbl_new_booking.applied_giftcard_id,tbl_new_booking.gift_discount,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.booking_date,tbl_new_booking.note,tbl_new_booking.payment_date,tbl_new_booking.payment_mode,tbl_new_booking.payment_status,tbl_new_booking.reminder, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_booking_services_details');
		$this->db->join('tbl_salon_customer', 'tbl_booking_services_details.customer_name = tbl_salon_customer.id');
		$this->db->join('tbl_salon_employee', 'tbl_booking_services_details.stylist_id = tbl_salon_employee.id');
		$this->db->join('tbl_salon_emp_service', 'tbl_booking_services_details.service_id = tbl_salon_emp_service.id');
		$this->db->join('tbl_new_booking', 'tbl_booking_services_details.booking_id = tbl_new_booking.id');
		$this->db->where('tbl_booking_services_details.payment_status', '1');
		$this->db->where('tbl_booking_services_details.is_deleted', '0');
		$this->db->where('tbl_booking_services_details.booking_id', $id);
		$result = $this->db->get();
		$result = $result->result(); 
		return $result;
	} 
    public function get_single_booking_service_details_for_bill($id,$payment_id){
		$this->db->select('tbl_booking_services_details.*,tbl_salon_employee.full_name as stylist_name, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_new_booking.selected_coupon_id,tbl_new_booking.pacakge_id,tbl_new_booking.package_amount,tbl_new_booking.total_service_price,tbl_new_booking.total_product_price,tbl_new_booking.service_price,tbl_new_booking.product_price,tbl_new_booking.gst_amount,tbl_new_booking.payble_price,tbl_new_booking.coupon_discount_amount,tbl_new_booking.reward_discount_amount,tbl_new_booking.booking_amount,tbl_new_booking.amount_to_paid,tbl_new_booking.is_giftcard_applied,tbl_new_booking.applied_giftcard_id,tbl_new_booking.gift_discount,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.booking_date,tbl_new_booking.note,tbl_new_booking.payment_date,tbl_new_booking.payment_mode,tbl_new_booking.payment_status,tbl_new_booking.reminder, tbl_salon_customer.full_name,tbl_salon_customer.email,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_booking_services_details');
		$this->db->join('tbl_salon_customer', 'tbl_booking_services_details.customer_name = tbl_salon_customer.id');
		$this->db->join('tbl_salon_employee', 'tbl_booking_services_details.stylist_id = tbl_salon_employee.id');
		$this->db->join('tbl_salon_emp_service', 'tbl_booking_services_details.service_id = tbl_salon_emp_service.id');
		$this->db->join('tbl_new_booking', 'tbl_booking_services_details.booking_id = tbl_new_booking.id');
		$this->db->where('tbl_booking_services_details.payment_status', '1');
		$this->db->where('tbl_booking_services_details.is_deleted', '0');
		$this->db->where('tbl_booking_services_details.booking_id', $id);
		$this->db->where('tbl_booking_services_details.booking_payment_id', $payment_id);
		$result = $this->db->get();
		$result = $result->result(); 
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
	public function store_profile($store_logo){
        // echo "<pre>";print_r($_POST);exit;
		$data = array(
			'branch_id' 			=> $this->input->post('id'),
			'salon_id' 				=> $this->session->userdata('salon_id'),
			'branch_name' 			=> $this->input->post('branch_name'),
			'salon_number' 			=> $this->input->post('salon_number'),
			'customer_support_phone'=> $this->input->post('customer_support_phone'),
			'email' 				=> $this->input->post('email'),
			// 'gst' 					=> $this->input->post('gst'),
			'gst_number' 			=> $this->input->post('gst_number'),
			'pan' 					=> $this->input->post('pan'),
			'category' 				=> $this->input->post('category'),
			'description' 			=> $this->input->post('description'),
			'instagram_link' 		=> $this->input->post('instagram_link'),
			'facebook_link' 		=> $this->input->post('facebook_link'),
			'youtube_link' 			=> $this->input->post('youtube_link'),
			'website_link' 			=> $this->input->post('website_link'),
			// 'store_logo' 			=> $store_logo,
			'profile_status' 		=> '1',
		); 
        // echo "<pre>";print_r($data);exit;
		if($this->input->post('id') != ""){
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_store_profile', $new_arr);
			return 0;
		}else{  
        // echo "<pre>";print_r($this->input->post('id'));exit;
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_store_profile', $data);
			return 1;
		}
	} 
    public function get_salon_detail_for_profile(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_store_profile');
        return $result->row();
    } 
    public function get_single_profile(){
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_branch');
        return $result->row();
    }
    public function get_single_branch_profile(){
        $this->db->select('tbl_branch.*,tbl_store_profile.store_logo');
        $this->db->join('tbl_store_profile','tbl_store_profile.branch_id = tbl_branch.id');
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->where('tbl_branch.id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_branch.salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_branch');
        return $result->row();
    }
    public function get_all_salon_profile_single(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_store_profile');
        return $result->row();
    }
    public function get_all_salon_profile(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_store_profile');
        return $result->result();
    }
    public function get_salon_profile(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_store_profile');
        return $result->result();
    }
    public function get_all_work_shedule_profile(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_work_schedule_days');
        $num_entries = $result->num_rows(); 
        return ($num_entries > 125) ? 1 : 0;
    } 
    public function salon_bank_details(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_store_profile', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 				=> $branch_id,
            'salon_id' 					=> $salon_id,
            'account_holder_name' 		=> $this->input->post('account_holder_name'),
            'account_number' 			=> $this->input->post('account_number'),
            'account_type' 				=> $this->input->post('account_type'),
            'bank_branch_name' 			=> $this->input->post('bank_branch_name'),
            'bank_name' 				=> $this->input->post('bank_name'),
            'ifsc' 						=> $this->input->post('ifsc'),
            'bank_status' 				=> '1', 
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_store_profile', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_store_profile', $data);
            return 1;
        }
    } 
    public function salon_location(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_store_profile', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 	=> $branch_id,
            'salon_id' 		=> $salon_id,
            'location' 		=> $this->input->post('location'), 
         ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_store_profile', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_store_profile', $data);
            return 1;
        }
     }  
    public function get_unique_holiday_ajax(){
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1'); 
        $this->db->where('holiday_date', date("Y-m-d", strtotime($this->input->post('holiday_date'))));
        if ($this->input->post('id') != '') {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $result = $this->db->get('tbl_holiday');
        echo $result->num_rows();
    } 
    public function set_holiday(){
        $data = array(
            'branch_id'        => $this->session->userdata('branch_id'),
            'salon_id'         => $this->session->userdata('salon_id'),
            'holiday_name'     => $this->input->post('holiday_name'),
            'holiday_date'     => $this->input->post('holiday_date'),
        ); 
        if($this->input->post('hidden_id') == ''){
            $date = array(
                'created_on'     => date("Y-m-d H:i:s"),
            );
            $newarr = array_merge($data, $date);
            $this->db->insert('tbl_holiday', $newarr);
            return 1;
        }else{
            $this->db->where('id', $this->input->post('hidden_id'));
            $this->db->update('tbl_holiday', $data);
            return 0;
        }
    } 
    public function get_holiday_days_list($length, $start, $search){
        if($this->input->post('date') != ""){
            $this->db->where('DAY(holiday_date)', $this->input->post('date'));
        }
        if($this->input->post('month') != ""){
            $this->db->where('MONTH(holiday_date)', $this->input->post('month'));
        }
        if($this->input->post('year') != ""){
            $this->db->where('YEAR(holiday_date)', $this->input->post('year'));
        }
        $this->db->where('is_deleted', '0');
        if($search != ""){ 
            $this->db->or_like('holiday_name', $search); 
        }
        $this->db->order_by('holiday_date', 'DESC');
        $this->db->limit($length, $start);
        $result = $this->db->get('tbl_holiday');
        return $result->result();
    }
    public function get_holiday_days_list_count($search){
        if($this->input->post('date') != ""){
            $this->db->where('DAY(holiday_date)', $this->input->post('date'));
        }
        if($this->input->post('month') != ""){
            $this->db->where('MONTH(holiday_date)', $this->input->post('month'));
        }
        if($this->input->post('year') != ""){
            $this->db->where('YEAR(holiday_date)', $this->input->post('year'));
        }
        $this->db->where('is_deleted', '0');
        if($search != ""){ 
            $this->db->or_like('holiday_name', $search); 
        }
        $this->db->order_by('holiday_date', 'DESC');
        $result = $this->db->get('tbl_holiday');
        return $result->num_rows();
    }
    public function get_single_holiday(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_holiday');
        $result = $result->row();
        return $result;
    }
    public function get_all_holiday_list(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_holiday');
        $result = $result->result();
        return $result;
    } 
    public function set_session_stylist(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' => $branch_id,
            'salon_id' => $salon_id,
            'per_session_stylist' => $this->input->post('per_session_stylist'),
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array('per_session_stylist' => $data['per_session_stylist']);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }  
    public function set_avg_duration(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row(); 
        $data = array(
            'branch_id' 			=> $branch_id,
            'salon_id' 				=> $salon_id,
            'session_avg_duration' 	=> $this->input->post('session_avg_duration'),
        ); 
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array('session_avg_duration' => $data['session_avg_duration']);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }  
    public function set_offset_session_time(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $branch_id,
            'salon_id' 				=> $salon_id,
            'offset_session_time' 	=> $this->input->post('offset_session_time'),
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
				'offset_session_time' => $data['offset_session_time'] 
			);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    } 
    public function set_booking_time_range(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 	=> $branch_id,
            'salon_id' 		=> $salon_id,
            'hours' 		=> $this->input->post('hours'),
            'days' 			=> $this->input->post('days'),
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'hours' => $data['hours'],
                'days' 	=> $data['days']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    } 
    public function set_cancel_reward_point(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $branch_id,
            'salon_id' 				=> $salon_id,
            'reward_point_cancel' 	=> $this->input->post('reward_point_cancel'),
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_booking_rules',$new_arr);
            return 0;
        }else{
            $update_data = array('reward_point_cancel' => $data['reward_point_cancel']);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_cancel_appoinment_time(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 				=> $branch_id,
            'salon_id' 					=> $salon_id,
            'cancel_appoinment_hours' 	=> $this->input->post('cancel_appoinment_hours'),
            'cancel_appoinment_minit' 	=> $this->input->post('cancel_appoinment_minit'), 
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'cancel_appoinment_hours' => $data['cancel_appoinment_hours'],
                'cancel_appoinment_minit' => $data['cancel_appoinment_minit']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_number_of_time_cancel_booking(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $branch_id,
            'salon_id' 				=> $salon_id,
            'cancel_booking_number' => $this->input->post('cancel_booking_number'),
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
				'cancel_booking_number' => $data['cancel_booking_number']
			);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_salon_close_date(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $branch_id,
            'salon_id' 				=> $salon_id,
            'from_date' 			=> $this->input->post('from_date'),
            'to_date' 				=> $this->input->post('to_date'),
            'salon_close_reason' 	=> $this->input->post('salon_close_reason'),
            'reason_title' 			=> $this->input->post('reason_title'),
            'salon_status' 			=> '0',
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'from_date' 		=> $data['from_date'],
                'to_date' 			=> $data['to_date'],
                'salon_close_reason'=> $data['salon_close_reason'],
                'reason_title' 		=> $data['reason_title'],
                'salon_status' 		=> $data['0'],
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_online_price(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $branch_id,
            'salon_id' 			=> $salon_id,
            'online_price' 		=> $this->input->post('online_price'), 
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
				'online_price' => $data['online_price']
			);
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_reshedule_hours(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id'); 
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $branch_id,
            'salon_id' 			=> $salon_id,
            'reshedule_hours' 	=> $this->input->post('reshedule_hours'),
            'reshedule_minit' 	=> $this->input->post('reshedule_minit'), 
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $data);
            return 1;
        }
    } 
    public function add_salon_time(){
        // echo "<pre>";print_r($this->session->userdata('branch_id'));exit;
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');

		$monday = '0';
		$tuesday = '0';
		$wednesday = '0';
		$thursday = '0';
		$friday = '0';
		$saturday = '0';
		$sunday = '0';
	    if($this->input->post("Monday") == "on"){
			$monday = "1";
		}
		if($this->input->post("Tuesday") == "on"){
			$tuesday = "1";
		}
		if($this->input->post("Wednesday") == "on"){
			$wednesday = '1';
		}
		if($this->input->post("Thursday") == "on"){
            $thursday = '1';
		} 
		if($this->input->post("Friday") == "on"){
			$friday = '1';
		}
		if($this->input->post("Saturday") == "on"){
			$saturday = '1';
		}
		if($this->input->post("Sunday") == "on"){
			$sunday = '1';
		}
		$data = array(
			'branch_id'         => $branch_id,
			'salon_id'          => $salon_id,
			'is_monday'         => $monday,
			'is_tuesday'        => $tuesday,
			'is_wednesday'      => $wednesday,
			'is_thursday'       => $thursday,
			'is_friday'         => $friday,
			'is_saturday'       => $saturday,
			'is_sunday'         => $sunday,
			'from_monday'       => ($monday == '1' && $this->input->post('from_monday') != "") ? date('H:i:s',strtotime($this->input->post('from_monday'))) : null,
			'to_monday'         => ($monday == '1' && $this->input->post('to_monday') != "") ? date('H:i:s',strtotime($this->input->post('to_monday'))) : null,
			'from_tuesday'      => ($tuesday == '1' && $this->input->post('from_tuesday') != "") ? date('H:i:s',strtotime($this->input->post('from_tuesday'))) : null,
			'to_tuesday'        => ($tuesday == '1' && $this->input->post('to_tuesday') != "") ? date('H:i:s',strtotime($this->input->post('to_tuesday'))) : null,
			'from_wednesday'    => ($wednesday == '1' && $this->input->post('from_wednesday') != "") ? date('H:i:s',strtotime($this->input->post('from_wednesday'))) : null,
			'to_wednesday'      => ($wednesday == '1' && $this->input->post('to_wednesday') != "") ? date('H:i:s',strtotime($this->input->post('to_wednesday'))) : null,
			'from_thursday'     => ($thursday == '1' && $this->input->post('from_thursday') != "") ? date('H:i:s',strtotime($this->input->post('from_thursday'))) : null,
			'to_thursday'       => ($thursday == '1' && $this->input->post('to_thursday') != "") ? date('H:i:s',strtotime($this->input->post('to_thursday'))) : null,
			'from_friday'       => ($friday == '1' && $this->input->post('from_friday') != "") ? date('H:i:s',strtotime($this->input->post('from_friday'))) : null,
			'to_friday'         => ($friday == '1' && $this->input->post('to_friday') != "") ? date('H:i:s',strtotime($this->input->post('to_friday'))) : null,
			'from_saturday'     => ($saturday == '1' && $this->input->post('from_saturday') != "") ? date('H:i:s',strtotime($this->input->post('from_saturday'))) : null,
			'to_saturday'       => ($saturday == '1' && $this->input->post('to_saturday') != "") ? date('H:i:s',strtotime($this->input->post('to_saturday'))) : null,
			'from_sunday'       => ($sunday == '1' && $this->input->post('from_sunday') != "") ? date('H:i:s',strtotime($this->input->post('from_sunday'))) : null,
			'to_sunday'         => ($sunday == '1' && $this->input->post('to_sunday') != "") ? date('H:i:s',strtotime($this->input->post('to_sunday'))) : null,
		);
		$this->db->where('is_deleted','0');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('salon_id',$salon_id);
		$exits_entry = $this->db->get('tbl_booking_rules')->row();
        // echo '<pre>';print_r($data);exit;

		if(!empty($exits_entry)){
			$this->db->where('id',$exits_entry->id);
			$this->db->update('tbl_booking_rules',$data);
		}else{
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
			$this->db->insert('tbl_booking_rules',$new_arr);
		}

        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'salon_start_time' 		=> $this->input->post('salon_start_time'),
            'salon_end_time' 		=> $this->input->post('salon_end_time'),
            'salon_status_profile' 	=> '1', 
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $data);
            return 1;
        }
    } 
    public function set_salon_type(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 	=> $branch_id,
            'salon_id' 		=> $salon_id,
            'salon_type' 	=> $this->input->post('salon_type'),
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'salon_type' => $data['salon_type'],
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    }
    public function set_emp_selection(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_booking_rules', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $branch_id,
            'salon_id' 			=> $salon_id,
            'emp_selection' 	=> $this->input->post('emp_selection'),
        );
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_booking_rules', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'emp_selection' => $data['emp_selection'],
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_booking_rules', $update_data);
            return 1;
        }
    } 
	public function set_slot_confirm_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'slot_confirm_sms' 		=> $this->input->post('slot_confirm_sms'),
            'slot_confirm_email' 	=> $this->input->post('slot_confirm_email'),
            'slot_confirm_whatsapp' => $this->input->post('slot_confirm_whatsapp'),
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'slot_confirm_sms' 		=> $data['slot_confirm_sms'],
                'slot_confirm_email'	=> $data['slot_confirm_email'],
                'slot_confirm_whatsapp' => $data['slot_confirm_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }  
    public function set_slot_reshedule_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 				=> $this->session->userdata('branch_id'),
            'salon_id' 					=> $this->session->userdata('salon_id'),
            'slot_reshedule_sms' 		=> $this->input->post('slot_reshedule_sms'),
            'slot_reshedule_email' 		=> $this->input->post('slot_reshedule_email'),
            'slot_reshedule_whatsapp' 	=> $this->input->post('slot_reshedule_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'slot_reshedule_sms' 		=> $data['slot_reshedule_sms'],
                'slot_reshedule_email' 		=> $data['slot_reshedule_email'],
                'slot_reshedule_whatsapp' 	=> $data['slot_reshedule_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_slot_cancel_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'slot_cancel_sms' 		=> $this->input->post('slot_cancel_sms'),
            'slot_cancel_email' 	=> $this->input->post('slot_cancel_email'),
            'slot_cancel_whatsapp' 	=> $this->input->post('slot_cancel_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'slot_cancel_sms' 		=> $data['slot_cancel_sms'],
                'slot_cancel_email' 	=> $data['slot_cancel_email'],
                'slot_cancel_whatsapp' 	=> $data['slot_cancel_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    } 
    public function set_payment_receive_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 				=> $this->session->userdata('branch_id'),
            'salon_id' 					=> $this->session->userdata('salon_id'),
            'payment_receive_sms' 		=> $this->input->post('payment_receive_sms'),
            'payment_receive_email' 	=> $this->input->post('payment_receive_email'),
            'payment_receive_whatsapp' 	=> $this->input->post('payment_receive_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'payment_receive_sms' 		=> $data['payment_receive_sms'],
                'payment_receive_email' 	=> $data['payment_receive_email'],
                'payment_receive_whatsapp' 	=> $data['payment_receive_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }  
    public function set_birthday_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'birthday_sms' 		=> $this->input->post('birthday_sms'),
            'birthday_email' 	=> $this->input->post('birthday_email'),
            'birthday_whatsapp' => $this->input->post('birthday_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'birthday_sms' 		=> $data['birthday_sms'],
                'birthday_email' 	=> $data['birthday_email'],
                'birthday_whatsapp' => $data['birthday_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_anniversary_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'anniversary_sms' 		=> $this->input->post('anniversary_sms'),
            'anniversary_email'		=> $this->input->post('anniversary_email'),
            'anniversary_whatsapp' 	=> $this->input->post('anniversary_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'anniversary_sms' 		=> $data['anniversary_sms'],
                'anniversary_email' 	=> $data['anniversary_email'],
                'anniversary_whatsapp' 	=> $data['anniversary_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_online_slot_book_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 					=> $this->session->userdata('branch_id'),
            'salon_id' 						=> $this->session->userdata('salon_id'),
            'online_slot_confirm_sms' 		=> $this->input->post('online_slot_confirm_sms'),
            'online_slot_confirm_email' 	=> $this->input->post('online_slot_confirm_email'),
            'online_slot_confirm_whatsapp' 	=> $this->input->post('online_slot_confirm_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'online_slot_confirm_sms' 		=> $data['online_slot_confirm_sms'],
                'online_slot_confirm_email' 	=> $data['online_slot_confirm_email'],
                'online_slot_confirm_whatsapp' 	=> $data['online_slot_confirm_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_voucher_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'voucher_sms' 		=> $this->input->post('voucher_sms'),
            'voucher_email' 	=> $this->input->post('voucher_email'),
            'voucher_whatsapp' => $this->input->post('voucher_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'voucher_sms' 		=> $data['voucher_sms'],
                'voucher_email' 	=> $data['voucher_email'],
                'voucher_whatsapp' 	=> $data['voucher_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_booking_reminder_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'slot_reminder_sms' 	=> $this->input->post('slot_reminder_sms'),
            'slot_reminder_email' 	=> $this->input->post('slot_reminder_email'),
            'slot_reminder_whatsapp'=> $this->input->post('slot_reminder_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'slot_reminder_sms' 		=> $data['slot_reminder_sms'],
                'slot_reminder_email' 		=> $data['slot_reminder_email'],
                'slot_reminder_whatsapp' 	=> $data['slot_reminder_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_stylist_booking_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 				=> $this->session->userdata('branch_id'),
            'salon_id' 					=> $this->session->userdata('salon_id'),
            'stylist_booking_sms' 		=> $this->input->post('stylist_booking_sms'),
            'stylist_booking_email' 	=> $this->input->post('stylist_booking_email'),
            'stylist_booking_whatsapp' 	=> $this->input->post('stylist_booking_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'stylist_booking_sms' 		=> $data['stylist_booking_sms'],
                'stylist_booking_email' 	=> $data['stylist_booking_email'],
                'stylist_booking_whatsapp' 	=> $data['stylist_booking_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    } 
    public function set_feedback_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'feedback_sms' 			=> $this->input->post('feedback_sms'),
            'feedback_email' 		=> $this->input->post('feedback_email'),
            'feedback_whatsapp' 	=> $this->input->post('feedback_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'feedback_sms' 		=> $data['feedback_sms'],
                'feedback_email'	=> $data['feedback_email'],
                'feedback_whatsapp' => $data['feedback_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    }
    public function set_reward_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'reward_sms' 		=> $this->input->post('reward_sms'),
            'reward_email' 		=> $this->input->post('reward_email'),
            'reward_whatsapp' 	=> $this->input->post('reward_whatsapp'),
        );
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'reward_sms' 		=> $data['reward_sms'],
                'reward_email' 		=> $data['reward_email'],
                'reward_whatsapp' 	=> $data['reward_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    } 
    public function set_otp_message(){
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $existingEntry = $this->db->get_where('tbl_notification', array('branch_id' => $branch_id, 'salon_id' => $salon_id))->row();
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'otp_sms' 			=> $this->input->post('otp_sms'),
            'otp_email' 		=> $this->input->post('otp_email'),
            'otp_whatsapp' 		=> $this->input->post('otp_whatsapp'),
        ); 
        if(empty($existingEntry)){
            $date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_notification', $new_arr);
            return 0;
        }else{
            $update_data = array(
                'otp_sms' 		=> $data['otp_sms'],
                'otp_email' 	=> $data['otp_email'],
                'otp_whatsapp' 	=> $data['otp_whatsapp']
            );
            $this->db->where('id', $existingEntry->id);
            $this->db->update('tbl_notification', $update_data);
            return 1;
        }
    } 
    public function get_all_notification_list(){
        $this->db->where('is_deleted','0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_notification');
        return $result->row();
    } 
    public function get_on_off_btn(){
        $this->db->where('is_deleted','0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_booking_rules');
        return $result->result();
    }
    public function get_booking_manual_btn(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_booking_rules');
        return $result->result();
    }
    public function get_salon_status(){
        $this->db->where('is_deleted','0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_booking_rules');
        return $result->result();
    }
    public function get_all_reason(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->result();
    }
    public function get_all_shift_name(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_booking_rules');
        return $result->result();
    } 
    public function get_all_booking_rules(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id')); 
        $result = $this->db->get('tbl_booking_rules');
        return $result->row();
    }  
	public function asign_membership(){ 
        // $this->db->select('tbl_memebership.*,tbl_admin_memebership.duration_end');
		$this->db->where('tbl_memebership.id',$this->input->post('membership_id'));
        // $this->db->join('tbl_admin_memebership','tbl_admin_memebership.id = tbl_memebership.membership_id','left');
		$membership_data = $this->db->get('tbl_memebership');
		$membership_data = $membership_data->row();

        $duration_months = $membership_data->duration;
        $membership_start = date("Y-m-d");
        $membership_end = date("Y-m-d", strtotime("+" . $duration_months . " months", strtotime($membership_start)));
        // $membership_ends = date("Y-m-d", strtotime("-1 day", strtotime($membership_end)));
        // echo "<pre>";print_r($membership_data);exit;
		$customer_phone = $this->input->post('customer_phone');
		$existing_customer = $this->db->get_where('tbl_salon_customer', array('customer_phone' => $customer_phone))->row_array();
        $data = array(   
			'branch_id' 				=> $this->session->userdata('branch_id'),
			'salon_id'	 				=> $this->session->userdata('salon_id'),
			'full_name' 				=> $this->input->post('full_name'),
			'customer_phone' 			=> $this->input->post('customer_phone'),
			'email' 					=> $this->input->post('email'),
			'address' 					=> $this->input->post('address'),
			'dob' 						=> $this->input->post('dob'),
			'gender' 					=> $this->input->post('gender'),
			'state' 					=> $this->input->post('state'),
			'city' 						=> $this->input->post('city'),
			'doa' 						=> $this->input->post('doa'),
			'married_status' 			=> $this->input->post('married_status'),
			'membership_id' 			=> $this->input->post('membership_id'), 
			'membership_price' 			=> $this->input->post('price'),
		);  
		if(empty($existing_customer)){
			$data['customer_phone'] = $customer_phone;
			$date = array(
				'created_on' => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_salon_customer', $new_arr);
			$customer_id = $this->db->insert_id();
			$data1 = array(
				'branch_id' 		=> $this->session->userdata('branch_id'),
				'salon_id' 			=> $this->session->userdata('salon_id'),
				'customer_id' 		=> $customer_id,
				'membership_id' 	=> $this->input->post('membership_id'), 
				'membership_price' 	=> $membership_data->membership_price, 
				'service_discount' 	=> $membership_data->service_discount, 
				'product_discount' 	=> $membership_data->product_discount, 
				'discount_in' 		=> $membership_data->discount_in, 
				'duration' 			=> $membership_data->duration, 
				'duration_end' 		=> $membership_data->duration_end, 
				'bg_color_input' 	=> $membership_data->bg_color_input, 
				'bg_color' 			=> $membership_data->bg_color, 
				'text_color_input' 	=> $membership_data->text_color_input, 
				'text_color' 		=> $membership_data->text_color, 
				'membership_start'  => $membership_start, 
				'membership_end' 	=> $membership_end, 
				'created_on' 		=> date("Y-m-d H:i:s")
			); 
            // echo "<pre>";print_r($data1);exit;
			$this->db->insert('tbl_customer_membership_history',$data1);
			$mebmership_key = $this->db->insert_id();
			$membership_pkey = $this->db->insert_id(); 
			$this->db->where('id',$customer_id);
            $single = $this->db->get('tbl_salon_customer')->row();

            $current_total_bill_amount = $single->total_bill_amount;
            $current_total_paid_amount = $single->total_paid_amount;
            $current_current_pending_amount = $single->current_pending_amount;
            
            $new_total_bill_amount = (float)$current_total_bill_amount + (float)$membership_data->membership_price;
            $new_total_paid_amount = (float)$current_total_paid_amount + (float)$membership_data->membership_price;
            $new_current_pending_amount = (float)$new_total_bill_amount - (float)$new_total_paid_amount;

			$update_pkey = array(
				'total_bill_amount'         => $new_total_bill_amount,
				'total_paid_amount'         => $new_total_paid_amount,
				'current_pending_amount'    => $new_current_pending_amount,

				'membership_pkey'           => $membership_pkey,
			);
			$this->db->where('id',$customer_id);
			$this->db->update('tbl_salon_customer',$update_pkey);
            
            $payment_data = array(
                'branch_id' 		        => $this->session->userdata('branch_id'),
                'salon_id' 			        => $this->session->userdata('salon_id'),
                'customer_id' 		        => $customer_id,
                'type' 		                => '1',
                'opening_pending_amount' 	=> $current_current_pending_amount,
                'paid_amount' 		        => $membership_data->membership_price,
                'closing_pending_amount' 	=> $new_current_pending_amount,
                'total_bill_amount' 		=> $current_total_bill_amount,
                'total_paid_amount' 	    => $current_total_paid_amount,
                'remark' 	                => 'Payment for membership purchase',
                'payment_date' 	            => date("Y-m-d"),
                'payment_mode' 	            => $this->input->post('membership_mode'),
            );
			$this->db->insert('tbl_booking_payment_entry', $payment_data);
			return 0;
		}else{
			$this->db->where('id', $existing_customer['id']);
			$this->db->update('tbl_salon_customer', $data);
			$data1 = array(
				'branch_id' 		=> $this->session->userdata('branch_id'),
				'salon_id'	 		=> $this->session->userdata('salon_id'),
				'customer_id' 		=> $existing_customer['id'],
				'membership_id' 	=> $this->input->post('membership_id'), 
				'membership_price' 	=> $membership_data->membership_price, 
				'service_discount' 	=> $membership_data->service_discount, 
				'product_discount' 	=> $membership_data->product_discount, 
				'discount_in' 		=> $membership_data->discount_in, 
				'duration' 			=> $membership_data->duration, 
				'duration_end' 		=> $membership_data->duration_end, 
				'bg_color_input' 	=> $membership_data->bg_color_input, 
				'bg_color' 			=> $membership_data->bg_color, 
				'text_color_input' 	=> $membership_data->text_color_input, 
				'text_color' 		=> $membership_data->text_color, 
				'membership_start'  => $membership_start, 
				'membership_end' 	=> $membership_end, 
				'created_on' 		=> date("Y-m-d H:i:s")
			);
        // echo "<pre>";print_r($data1);exit;
			$this->db->insert('tbl_customer_membership_history', $data1);
			$membership_pkey = $this->db->insert_id(); 
            
			$this->db->where('id',$existing_customer['id']);
            $single = $this->db->get('tbl_salon_customer')->row();

            $current_total_bill_amount = $single->total_bill_amount;
            $current_total_paid_amount = $single->total_paid_amount;
            $current_current_pending_amount = $single->current_pending_amount;
            
            $new_total_bill_amount = (float)$current_total_bill_amount + (float)$membership_data->membership_price;
            $new_total_paid_amount = (float)$current_total_paid_amount + (float)$membership_data->membership_price;
            $new_current_pending_amount = (float)$new_total_bill_amount - (float)$new_total_paid_amount;
			$update_pkey = array(
				'total_bill_amount'         => $new_total_bill_amount,
				'total_paid_amount'         => $new_total_paid_amount,
				'current_pending_amount'    => $new_current_pending_amount,

				'membership_pkey'           => $membership_pkey,
			);
			$this->db->where('id',$existing_customer['id']);
			$this->db->update('tbl_salon_customer',$update_pkey);
            
            $payment_data = array(
                'branch_id' 		        => $this->session->userdata('branch_id'),
                'salon_id' 			        => $this->session->userdata('salon_id'),
                'customer_id' 		        => $existing_customer['id'],
                'type' 		                => '1',
                'opening_pending_amount' 	=> $current_current_pending_amount,
                'paid_amount' 		        => $membership_data->membership_price,
                'closing_pending_amount' 	=> $new_current_pending_amount,
                'total_bill_amount' 		=> $current_total_bill_amount,
                'total_paid_amount' 	    => $current_total_paid_amount,
                'remark' 	                => 'Payment for membership purchase',
                'payment_date' 	            => date("Y-m-d"),
                'payment_mode' 	            => $this->input->post('membership_mode'),
            );
			$this->db->insert('tbl_booking_payment_entry', $payment_data);
			return 1;
		}
	}
	public function get_single_customer($id){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $id);
        $result = $this->db->get('tbl_salon_customer');
        return $result->row();
    } 
	public function get_single_customer_name(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_salon_customer');
        return $result->row();
    } 

	public function get_all_assigned_membership(){
		$this->db->select('tbl_salon_customer.*, tbl_memebership.membership_name, tbl_memebership.membership_price, tbl_customer_membership_history.membership_start, tbl_customer_membership_history.membership_end');
		$this->db->from('tbl_salon_customer');
		$this->db->join('tbl_memebership', 'tbl_salon_customer.membership_id = tbl_memebership.id AND tbl_memebership.is_deleted = 1');
		$this->db->join('tbl_customer_membership_history', 'tbl_salon_customer.membership_pkey = tbl_customer_membership_history.id');
		$this->db->where('tbl_salon_customer.is_deleted', '0');
		$this->db->where('tbl_salon_customer.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_customer.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_salon_customer.id', 'DESC');
		$result = $this->db->get();
		return $result->result();
	} 

	public function get_customer_membership_amount_history($customer_id){
		$this->db->select('tbl_salon_customer.*, tbl_memebership.membership_name, tbl_memebership.membership_price');
		$this->db->from('tbl_salon_customer');
		$this->db->join('tbl_memebership', 'tbl_salon_customer.membership_id = tbl_memebership.id', 'left');
		$this->db->where('tbl_salon_customer.id', $customer_id);
		$this->db->where('tbl_salon_customer.is_deleted', '0');
		$this->db->where('tbl_salon_customer.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_customer.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_salon_customer.id', 'DESC');
		$result = $this->db->get();
		return $result->row();
	} 
	public function get_membership_info_ajax(){
		$membership_id = $this->input->post('membership_id');
		$this->db->where('id', $membership_id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_memebership')->row();
		if (!empty($result)) {
			echo json_encode($result);
		}
	} 
    public function add_new_customer(){
        $this->db->where('is_deleted','0');
        $this->db->where('customer_phone',$this->input->post('customer_phone'));
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $exist = $this->db->get('tbl_salon_customer')->result();
        if(empty($exist)){
            $data = array(
                'branch_id' 		=> $this->session->userdata('branch_id'),
                'salon_id' 			=> $this->session->userdata('salon_id'),
                'full_name' 		=> $this->input->post('full_name'),
                'customer_phone' 	=> $this->input->post('customer_phone'),
                'email' 			=> $this->input->post('email'),
                'address' 			=> $this->input->post('address'),
                'dob' 				=> date('Y-m-d',strtotime($this->input->post('dob'))),
                'gender' 			=> $this->input->post('gender'),
                'state' 			=> $this->input->post('state'),
                'city' 				=> $this->input->post('city'),
                'doa' 				=> date('Y-m-d',strtotime($this->input->post('DOA'))),
            );
            if($this->input->post('id') == ""){
                $date = array(
                    'created_on'  => date("Y-m-d H:i:s")
                );
                $new_arr = array_merge($data, $date);
                $this->db->insert('tbl_salon_customer', $new_arr);
                $last_id = $this->db->insert_id();

                if($this->input->post('added_from') == 'seperate'){
                    return 0;
                }else{
                    $this->session->set_flashdata('success', 'Success ! Customer added successfully');
                    redirect('add-new-booking-new?customer=' . $last_id);
                }
            }else{
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('tbl_salon_customer', $data);
                return 1;
            }   
        }else{
            return 3;
        }
	} 
    public function add_payment(){
        $id = $this->input->post('customer');

        $this->db->where('id',$id);
        $single = $this->db->get('tbl_salon_customer')->row();

        if(!empty($single)){
            $data = array(
                'branch_id' 		        => $this->session->userdata('branch_id'),
                'salon_id' 			        => $this->session->userdata('salon_id'),
                'customer_id' 		        => $single->id,
                'type' 		                => '2',
                'opening_pending_amount' 	=> $this->input->post('pending'),
                'paid_amount' 		        => $this->input->post('now_paid'),
                'closing_pending_amount' 	=> $this->input->post('new_pending'),
                'total_bill_amount' 		=> $this->input->post('booking'),
                'total_paid_amount' 	    => $this->input->post('paid'),
                'remark' 	                => $this->input->post('remark'),
                'payment_date' 	            => date('Y-m-d',strtotime($this->input->post('payment_date'))),
                'payment_mode' 	            => $this->input->post('payment_mode'),
            );
            if($this->input->post('id') == ""){
                $date = array(
                    'created_on'                => date("Y-m-d H:i:s"),
                );
                $newarr = array_merge($data, $date);
                $this->db->insert('tbl_booking_payment_entry',$newarr);

                $update_data = array(
                    'current_pending_amount'    =>  $this->input->post('new_pending'),
                    'total_paid_amount'         =>  (float)$this->input->post('paid') + (float)$this->input->post('now_paid'),
                );
                $this->db->where('id',$single->id);
                $this->db->update('tbl_salon_customer',$update_data);
            }else{
                $this->db->where('id',$this->input->post('id'));
                $this->db->update('tbl_booking_payment_entry',$data);

                $pre_total_paid = $single->total_paid_amount;
                $pre_pending = $single->current_pending_amount;

                $old_paid_amount = (float)$this->input->post('old_paid_amount');

                $temp_paid_amount = (float)$pre_total_paid - $old_paid_amount;
                $temp_pending_amount = (float)$pre_pending + $old_paid_amount;

                $new_paid_amount = (float)$temp_paid_amount + (float)$this->input->post('now_paid');
                $new_pending_amount = (float)$temp_pending_amount - (float)$this->input->post('now_paid');
                
                $update_data = array(
                    'current_pending_amount'    =>  $new_pending_amount,
                    'total_paid_amount'         =>  $new_paid_amount,
                );
                $this->db->where('id',$single->id);
                $this->db->update('tbl_salon_customer',$update_data);
            }
            return 1;
        }else{
            return 0;
        }
    }
    public function add_customer_payment($id){
        $this->db->where('id',$id);
        $single = $this->db->get('tbl_salon_customer')->row();

        if(!empty($single)){
            $data = array(
                'branch_id' 		=> $this->session->userdata('branch_id'),
                'salon_id' 			=> $this->session->userdata('salon_id'),
                'customer_id' 		=> $single->id,
                'type' 		                => '2',
                'opening_pending_amount' 	=> $single->current_pending_amount,
                'paid_amount' 		        => $this->input->post('paid_amount_' . $single->id),
                'closing_pending_amount' 	=> $this->input->post('new_pending_amount_' . $single->id),
                'total_bill_amount' 		=> $this->input->post('total_bill_amount_' . $single->id),
                'total_paid_amount' 	    => $this->input->post('total_paid_amount_' . $single->id),
                'remark' 	                => $this->input->post('remark_' . $single->id),
                'payment_date' 	=> date('Y-m-d',strtotime($this->input->post('payment_date_' . $single->id))),
                'payment_mode' 	=> $this->input->post('payment_mode_' . $single->id),
				'created_on'        => date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_booking_payment_entry',$data);

            $update_data = array(
                'current_pending_amount'    =>  $this->input->post('new_pending_amount_' . $single->id),
                'total_paid_amount'         =>  (float)$single->total_paid_amount + (float)$this->input->post('paid_amount_' . $single->id),
            );
            $this->db->where('id',$single->id);
            $this->db->update('tbl_salon_customer',$update_data);
            return 1;
        }else{
            return 0;
        }
	} 
	public function get_last_customer_detail(){
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_salon_customer');
		$result = $query->row();
		return $result;
	}
	public function get_single_booking_customer_detail(){
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_salon_customer');
		return $result->row();
	} 
	public function add_single_booking(){
		$data = array(
			'branch_id' 		=> $this->session->userdata('branch_id'),
			'salon_id' 			=> $this->session->userdata('salon_id'),
			'services' 			=> $this->input->post('services'),
			'customer_name' 	=> $this->input->post('customer_name'),
			'time_slot' 		=> $this->input->post('time_slot'),
			'stylist' 			=> $this->input->post('stylist'),
			'booking_date' 		=> $this->input->post('booking_date'),
			'payble_price' 		=> $this->input->post('payble_price'),
			'amount_to_paid' 	=> $this->input->post('amount_to_paid'),
			'gst_amount' 		=> $this->input->post('gst_amount'),
		); 
		if($this->input->post('id') == ""){
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_new_booking', $new_arr);
			return 0;
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_new_booking', $data);
			return 1;
		}
	} 
	public function add_new_booking(){
		$services = $this->input->post('services');
		$time_slots = $this->input->post('time_slot');
		$stylists = $this->input->post('stylist');
		$booking_date = $this->input->post('booking_date');
		$services_array = explode(',', $services);
		$time_slots_array = explode(',', $time_slots);
		$stylists_array = explode(',', $stylists);
		$date_array = explode(',', $booking_date);
		$count = count($services_array);
		for($i = 0; $i < $count; $i++){
			$data = array(
				'branch_id' 			=> $this->session->userdata('branch_id'),
				'salon_id' 				=> $this->session->userdata('salon_id'),
				'customer_name' 		=> $this->input->post('customer_name'),
				'service_category' 		=> $this->input->post('service_category'),
				'services' 				=> $services_array[$i],
				'pacakge_id' 			=> $this->input->post('pacakge_id'),
				'products_id' 			=> $this->input->post('products_id'),
				'time_slot' 			=> $time_slots_array[$i],
				'stylist' 				=> $stylists_array[$i],
				'service_price' 		=> $this->input->post('service_price'),
				'product_price' 		=> $this->input->post('product_price'),
				'booking_date' 			=> $date_array[$i],
				'selected_shift' 		=> $this->input->post('selected_shift'),
				'reminder' 				=> $this->input->post('reminder'),
				'note' 					=> $this->input->post('note'),
				'gst_amount' 			=> $this->input->post('gst_amount'),
				'payble_price' 			=> $this->input->post('payble_price'),
				'amount_to_paid' 		=> $this->input->post('amount_to_paid'),
				'gift_discount' 		=> $this->input->post('gift_discount'),
				'offer_discount' 		=> $this->input->post('offer_discount'),
				'm_service_discount'	=> $this->input->post('m_service_discount'),
				'm_product_discount' 	=> $this->input->post('m_product_discount'),
			); 
			if($this->input->post('id') == ""){
				$date = array(
					'created_on' => date("Y-m-d H:i:s")
				);
				$new_arr = array_merge($data, $date);
				$this->db->insert('tbl_new_booking', $new_arr);
			}else{
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('tbl_new_booking', $data);
			}
		} 
		return 0;
	} 
    public function get_active_package_allocation($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_customer_package_allocations')->row();
        return $result;
    }
    public function get_active_package_allocation_item_status($allocation_id,$item_id,$item_type){
        $this->db->where('allocation_id',$allocation_id);
        $this->db->where('item_id',$item_id);
        $this->db->where('item_type',$item_type);
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_booking_package_detail_status')->row();
        return $result;
    }
    public function get_saloon_branch_total_orders($saloon,$branch){
        $this->db->where('branch_id',$branch);
        $this->db->where('salon_id',$saloon);
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_new_booking')->num_rows();
        return $result;
    }
    
	public function generate_bill($booking_id){
        $customer_id = $this->input->post('customer_id_' . $booking_id);

        $this->db->where('id',$booking_id);
        $single = $this->db->get('tbl_new_booking')->row();

        if(!empty($single)){
            $this->db->where('id',$customer_id);
            $customer = $this->db->get('tbl_salon_customer')->row();

            if(!empty($customer)){
                $payment_mode = $this->input->post('payment_mode_' . $booking_id);
                $payment_date = $this->input->post('payment_date_' . $booking_id);
                $paid_amount = $this->input->post('paid_amount_' . $booking_id);

                $is_member = $this->input->post('is_membership_booking_' . $booking_id);
                $membership_id = $this->input->post('membership_id_' . $booking_id);

                $customer_reward_available = $this->input->post('customer_reward_available_' . $booking_id);
                $used_rewards = $this->input->post('used_rewards_' . $booking_id);
                $reward_discount_hidden = $this->input->post('reward_discount_amount_' . $booking_id);

                $giftcard_discount = $this->input->post('gift_discount_' . $booking_id);
                $is_giftcard_applied = $this->input->post('is_giftcard_applied_' . $booking_id);
                $applied_giftcard_id = $this->input->post('applied_giftcard_id_' . $booking_id);
                
                $send_appointment_details = $this->input->post('send_appointment_details_' . $booking_id);
                $message_type = $this->input->post('message_type_' . $booking_id);

                $applicable_giftcard_total_service_amount = 0;

                $product_details_ids = array();
                $services = array();
                $products = array();
                $services_details_ids = $this->input->post('service_checkbox_' . $booking_id);
                if($services_details_ids != "" && is_array($services_details_ids) && !empty($services_details_ids)){
                    for($i=0;$i<count($services_details_ids);$i++){
                        $single_array = $this->input->post('service_products_checkbox_' . $services_details_ids[$i]);
                        $services[] = $this->input->post('single_service_id_' . $services_details_ids[$i]);
                        if ($single_array != "" && $single_array != null && is_array($single_array) && !empty($single_array)) {
                            $product_details_ids = array_merge($product_details_ids,$single_array);
                            for($j=0;$j<count($single_array);$j++){
                                $products[] = $this->input->post('single_service_product_id_' . $services_details_ids[$i] . '_' . $single_array[$j]);
                            }
                        }
                        
                        $this->db->where('id',$services_details_ids[$i]);
                        $single_service_details = $this->db->get('tbl_booking_services_details')->row();
                        if(!empty($single_service_details)){
                            if($single_service_details->service_added_from == '0'){
                                if($is_giftcard_applied == '1'){
                                    $this->db->where('id',$applied_giftcard_id);
                                    $giftcard = $this->db->get('tbl_gift_card')->row();
                                    if(!empty($giftcard)){
                                        $giftcard_services = explode(',',$giftcard->service_name);
                                        if(in_array($single_service_details->service_id,$giftcard_services)){
                                            $service_price = $single_service_details->service_price;
                                            $applicable_giftcard_total_service_amount = $applicable_giftcard_total_service_amount + $service_price;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // echo '<pre>'; print_r($services_details_ids);

                $selected_coupon_id = $this->input->post('selected_coupon_id_' . $booking_id);

                $total_service_amount = $this->input->post('total_service_amount_' . $booking_id);
                $total_product_amount = $this->input->post('total_product_amount_' . $booking_id);
                $service_payable_amount = $this->input->post('service_payable_hidden_' . $booking_id);
                $product_payable_amount = $this->input->post('product_payable_hidden_' . $booking_id);
                $selected_package = $this->input->post('package_id_' . $booking_id);
                $package_amount = $this->input->post('package_amount_' . $booking_id);
                $payable_amount = $this->input->post('payable_hidden_' . $booking_id);
                $coupon_discount_amount = $this->input->post('coupon_discount_amount_' . $booking_id);
                $total_discount_hidden = $this->input->post('total_discount_hidden_' . $booking_id);
                $booking_amount = $this->input->post('booking_amount_hidden_' . $booking_id);
                $gst_amount = $this->input->post('gst_amount_hidden_' . $booking_id);
                $grand_total_amount = $this->input->post('grand_total_hidden_' . $booking_id);
                
                $membership_discount_type = $this->input->post('membership_discount_type_' . $booking_id);
                $membership_service_discount_amount = $this->input->post('m_service_discount_amount_' . $booking_id);
                $membership_product_discount_amount = $this->input->post('m_product_discount_amount_' . $booking_id);
                $membership_service_discount = $this->input->post('m_service_discount_' . $booking_id);
                $membership_product_discount = $this->input->post('m_product_discount_' . $booking_id);

                $booking_data = array(
                    'branch_id' 			=> $this->session->userdata('branch_id'),
                    'salon_id' 				=> $this->session->userdata('salon_id'),
                    'booking_id' 		    => $booking_id,
                    'booking_date'          => date('Y-m-d',strtotime($single->booking_date)),
                    'customer_name' 		=> $customer_id,
                    'is_membership_booking' => $is_member,
                    'membership_id' 		=> $membership_id,
                    'membership_discount_type'	=> $membership_discount_type,
                    'm_service_discount'	=> $membership_service_discount,
                    'm_product_discount' 	=> $membership_product_discount,
                    'm_service_discount_amount'	    => $membership_service_discount_amount,
                    'm_product_discount_amount' 	=> $membership_product_discount_amount,
                    'services' 		        => !empty($services) ? implode(',',$services) : '',
                    'products' 		        => !empty($products) ? implode(',',$products) : '',
                    'selected_coupon_id' 	=> $selected_coupon_id,
                    'pacakge_id' 			=> $selected_package,
                    'package_amount' 		=> $package_amount,
                    'total_service_price'   => $total_service_amount,
                    'total_product_price'   => $total_product_amount,
                    'service_price'         => $service_payable_amount,
                    'product_price'         => $product_payable_amount,
                    'payble_price'          => $payable_amount,
                    'coupon_discount_amount'=> $coupon_discount_amount,
                    'reward_discount_amount'=> $reward_discount_hidden,
                    'total_discount_amount' => $total_discount_hidden,
                    'used_rewards'          => $used_rewards,
                    'booking_amount'        => $booking_amount,
                    'gst_amount'            => $gst_amount,
                    'amount_to_paid'        => $grand_total_amount,
                    'actual_paid_amount'    => $paid_amount,
                    'is_giftcard_applied' 	=> $is_giftcard_applied,
                    'applied_giftcard_id'   => ($is_giftcard_applied == '1') ? $applied_giftcard_id : '',
                    'gift_discount'         => ($is_giftcard_applied == '1') ? $giftcard_discount : '',
                    'payment_date'          => date('Y-m-d',strtotime($payment_date)),
                    'payment_mode'          => $payment_mode,
                    
                    'send_appointment_details'          => $send_appointment_details,
                    'message_type'                      => $message_type,

                    'payment_status'        => '1',
                    'created_on'            => date("Y-m-d H:i:s"),
                );
                // echo '<pre>'; print_r($_POST); exit();
                $this->db->insert('tbl_service_payment', $booking_data);
                $booking_payment_id = $this->db->insert_id();

                $receipt_data = array(
                    'receipt_no'   => $single->receipt_no.'-'.$booking_payment_id,
                );
                $this->db->where('id',$booking_payment_id);
                $this->db->update('tbl_service_payment',$receipt_data);

                if($is_giftcard_applied == '1'){
                    if($applied_giftcard_id != $single->applied_giftcard_id){
                        $this->db->where('id',$applied_giftcard_id);
                        $giftcard = $this->db->get('tbl_gift_card')->row();
                        if(!empty($giftcard)){
                            $existing_customers = explode(',',$giftcard->used_by_customers);
                            $existing_customers[] = $customer_id.'@@@'.$booking_id.'@@@'.date("Y-m-d");

                            $this->db->where('id',$giftcard->id);
                            $this->db->update('tbl_gift_card',array('used_by_customers'=>implode(',',$existing_customers)));
                        }
                    }
                }

                if($single->applied_giftcard_id != "" && $single->applied_giftcard_id != null && $single->applied_giftcard_id != '0'){
                    $this->db->where('id',$single->applied_giftcard_id);
                    $giftcard = $this->db->get('tbl_gift_card')->row();
                    if(!empty($giftcard)){
                        $existing_customers = explode(',',$giftcard->used_by_customers);

                        $index = array_search($customer_id . '@@@' . $booking_id . '@@@' . date('Y-m-d',strtotime($single->booking_date)), $existing_customers);
                        if($index !== false) {
                            unset($existing_customers[$index]);
                        }
                        
                        $new_existing_customers = implode(',', $existing_customers);
                        $this->db->where('id',$giftcard->id);
                        $this->db->update('tbl_gift_card',array('used_by_customers'=>$new_existing_customers));
                    }
                }

                if($used_rewards > 0){
                    $this->db->where('id',$customer_id);
                    $customer_rewards = $this->db->get('tbl_salon_customer')->row();
                    if(!empty($customer_rewards)){
                        $pre_balance = $customer_rewards->rewards_balance;
                        $rewards = $used_rewards;
                        $new_balance = $pre_balance - $rewards;

                        $reward_data = array(
                            'customer_id'                   =>  $customer_id,
                            'branch_id'                     =>  $this->session->userdata('branch_id'),
                            'salon_id'                      =>  $this->session->userdata('salon_id'),
                            'booking_id'                    =>  $booking_id,
                            'transaction_type'              =>  '3',
                            'remark'                        =>  'Reward points used for booking payment',
                            'previous_reward_balance'       =>  $customer_rewards->rewards_balance,
                            'reward_value'                  =>  $rewards,
                            'new_reward_balance'            =>  $new_balance,
                            'created_on'                    =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_customer_rewards_history',$reward_data);

                        $this->db->where('id',$customer_id);
                        $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                    }
                }
                
                if($services_details_ids != "" && is_array($services_details_ids) && !empty($services_details_ids)){
                    for($i=0;$i<count($services_details_ids);$i++){
                        $this->db->where('id',$services_details_ids[$i]);
                        $single_service_details = $this->db->get('tbl_booking_services_details')->row();
                        if(!empty($single_service_details)){
                            $old_stylist = $this->input->post('old_stylist_' . $services_details_ids[$i]);
                            $new_stylist = $this->input->post('new_stylist_' . $services_details_ids[$i]);

                            $products_single = $this->input->post('service_products_checkbox_' . $services_details_ids[$i]);

                            $service_price = $single_service_details->service_price;
                            $service_id = $single_service_details->service_id;
                            
                            $received_total_service = $total_service_amount;
                            if($received_total_service != "" && $received_total_service != "0.00" && $received_total_service != null && $received_total_service != 0){
                                $price_share_in_total_service = (float)(($service_price/$received_total_service) * 100);
                                $discount_share_membership_amount = (float)(($membership_service_discount_amount * $price_share_in_total_service) / 100);
                            }else{
                                $discount_share_membership_amount = 0;
                            }

                            $received_total = $total_product_amount + $total_service_amount;
                            if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                $price_share_in_total = (float)(($service_price/$received_total) * 100);
                                $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                                $discount_share_reward_amount = (float)(($reward_discount_hidden * $price_share_in_total) / 100);
                            }else{
                                $discount_share_coupon_amount = 0;
                                $discount_share_reward_amount = 0;
                            }

                            $discount_share_giftcard_amount = 0 ;
                            if($is_giftcard_applied == '1'){
                                $this->db->where('id',$applied_giftcard_id);
                                $giftcard = $this->db->get('tbl_gift_card')->row();
                                if(!empty($giftcard)){
                                    $giftcard_services = explode(',',$giftcard->service_name);
                                    if(in_array($service_id,$giftcard_services)){
                                        if($applicable_giftcard_total_service_amount != "" && $applicable_giftcard_total_service_amount != "0.00" && $applicable_giftcard_total_service_amount != null && $applicable_giftcard_total_service_amount != 0){
                                            $price_share_in_total_giftcard_service_amount = (float)(($service_price/$applicable_giftcard_total_service_amount) * 100);
                                            $discount_share_giftcard_amount = (float)(($giftcard_discount * $price_share_in_total_giftcard_service_amount) / 100);
                                        }
                                    }
                                }
                            }

                            $total_single_service_discount = $discount_share_membership_amount + $discount_share_coupon_amount + $discount_share_reward_amount + $discount_share_giftcard_amount;
                            $single_service_discounted_amount = $service_price - $total_single_service_discount;

                            $payment_data = array(
                                'payment_date'          => date('Y-m-d',strtotime($payment_date)),
                                'payment_mode'          => $payment_mode,
                                'payment_status'        => '1',
                                'booking_payment_id'    => $booking_payment_id,    
                                'stylist_id_after_bill' => $new_stylist,                            
                    
                                'received_discount_amount_while_bill'     	=> $total_single_service_discount,
                                'received_coupon_discount_while_bill'     	=> $discount_share_coupon_amount,
                                'received_reward_discount_while_bill'     	=> $discount_share_reward_amount,
                                'received_membership_discount_while_bill'   => $discount_share_membership_amount,
                                'received_giftcard_discount_while_bill'     => $discount_share_giftcard_amount,
                                'service_discounted_price_while_bill'     	=> $single_service_discounted_amount,
                            );
                            $this->db->where('id',$services_details_ids[$i]);
                            $this->db->update('tbl_booking_services_details', $payment_data);
                            $booking_service_details_id = $services_details_ids[$i];

                            if($products_single != "" && is_array($products_single) && !empty($products_single)){
                                for($j=0;$j<count($products_single);$j++){
                                    $this->db->where('booking_service_details_id',$booking_service_details_id);
                                    $this->db->where('id',$products_single[$j]);
                                    $single_product_details = $this->db->get('tbl_booking_services_products_details')->row();
                                    if(!empty($single_product_details)){
                                        $product_price = $single_product_details->product_price;

                                        $received_total_product = $total_product_amount;
                                        if($received_total_product != "" && $received_total_product != "0.00" && $received_total_product != null && $received_total_product != 0){
                                            $price_share_in_total_product = (float)(($product_price/$received_total_product) * 100);
                                            $discount_share_membership_amount = (float)(($membership_product_discount_amount * $price_share_in_total_product) / 100);
                                        }else{
                                            $discount_share_membership_amount = 0;
                                        }

                                        $received_total = $total_product_amount + $total_service_amount;
                                        if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                            $price_share_in_total = (float)(($product_price/$received_total) * 100);
                                            $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                                            $discount_share_reward_amount = (float)(($reward_discount_hidden * $price_share_in_total) / 100);
                                        }else{
                                            $discount_share_coupon_amount = 0;
                                            $discount_share_reward_amount = 0;
                                        }

                                        $total_single_product_discount = $discount_share_membership_amount + $discount_share_coupon_amount + $discount_share_reward_amount;
                                        $single_product_discounted_amount = $product_price - $total_single_product_discount;
    
                                        $service_product_data = array(
                                            'payment_date'          => date('Y-m-d',strtotime($payment_date)),
                                            'payment_mode'          => $payment_mode,
                                            'payment_status'        => '1',
                                            'booking_payment_id'    => $booking_payment_id,
                    
                                            'received_discount_amount_while_bill'     	=> $total_single_product_discount,
                                            'received_coupon_discount_while_bill'     	=> $discount_share_coupon_amount,
                                            'received_reward_discount_while_bill'     	=> $discount_share_reward_amount,
                                            'received_membership_discount_while_bill'   => $discount_share_membership_amount,
                                            'product_discounted_price_while_bill'     	=> $single_product_discounted_amount,
                                        );
                                        $this->db->where('booking_service_details_id',$booking_service_details_id);
                                        $this->db->where('id',$products_single[$j]);
                                        $this->db->update('tbl_booking_services_products_details', $service_product_data);
                                    }
                                }
                            }
                        }
                    }
                }

                $pre_total_bill_amount = (float)$customer->total_bill_amount;
                $pre_total_paid_amount = (float)$customer->total_paid_amount;
                $pre_current_pending_amount = (float)$customer->current_pending_amount;

                $new_total_bill_amount = $pre_total_bill_amount + (float)$grand_total_amount;
                $new_total_paid_amount = $pre_total_paid_amount + (float)$paid_amount;

                $single_pending_amount = (float)$grand_total_amount - (float)$paid_amount;

                $new_current_pending_amount = $pre_current_pending_amount + (float)$single_pending_amount;

                $payment_entry_data = array(
                    'customer_id'     =>  $customer_id,
                    'branch_id'       =>  $this->session->userdata('branch_id'),
                    'salon_id'        =>  $this->session->userdata('salon_id'),
                    'booking_id'      =>  $booking_id,
                    'paid_amount'     =>  $paid_amount,
                    'type' 		                 => '0',
                    'remark' 	                 => 'Payment for booking bill generation',
                    'opening_pending_amount'     =>  $pre_current_pending_amount,
                    'closing_pending_amount'     =>  $new_current_pending_amount,                    
                    'total_bill_amount'          =>  $pre_total_bill_amount,
                    'total_paid_amount'          =>  $pre_total_paid_amount,
                    'booking_payment_amount'     =>  $grand_total_amount,
                    'booking_payment_id'         =>  $booking_payment_id,
                    'payment_date'    => date('Y-m-d',strtotime($payment_date)),
                    'payment_mode'    => $payment_mode,
                    'created_on'      =>  date("Y-m-d H:i:s")
                );
                $this->db->insert('tbl_booking_payment_entry',$payment_entry_data);

                $payment_data = array(
                    'total_bill_amount'         =>  $new_total_bill_amount,
                    'total_paid_amount'         =>  $new_total_paid_amount,
                    'current_pending_amount'    =>  $new_current_pending_amount,
                );
                $this->db->where('id',$customer_id);
                $this->db->update('tbl_salon_customer',$payment_data);   
                
                $this->db->where('booking_id',$booking_id);
                $this->db->where('is_deleted','0');
                $this->db->where('payment_status','0');
                $pending_services = $this->db->get('tbl_booking_services_details')->result(); 
                if(empty($pending_services)){
                    $update_data = array(
                        'payment_date'          => date('Y-m-d',strtotime($payment_date)),
                        'payment_mode'          => $payment_mode,
                        'payment_status'        => '1',
                        'booking_payment_id'    => $booking_payment_id,
                    );
                    $this->db->where('id',$booking_id);
                    $this->db->update('tbl_new_booking',$update_data);
                }
                return '1@@@'.$booking_payment_id;
            }else{
                return '0@@@';
            }
        }else{
            return '0@@@';
        }
	} 
	public function add_new_booking_new(){
		$customer_id = $this->input->post('customer_name');
		$is_member = $this->input->post('is_member');
		$membership_id = $this->input->post('membership_id');
		$note = $this->input->post('note');
		$reminder = $this->input->post('reminder');
		$payment_method = $this->input->post('payment_method');

		$customer_reward_available = $this->input->post('customer_reward_available');
		$used_rewards = $this->input->post('used_rewards');
		$reward_discount_hidden = $this->input->post('reward_discount_hidden');

		$giftcard_discount = $this->input->post('giftcard_discount');
		$is_giftcard_applied = $this->input->post('is_giftcard_applied');
		$applied_giftcard_id = $this->input->post('applied_giftcard_id');

        $applicable_giftcard_total_service_amount = 0;

        $products = array();
		$services = $this->input->post('service_name_check');
        if($services != "" && is_array($services) && !empty($services)){
            for($i=0;$i<count($services);$i++){
                $single_array = $this->input->post('product_checkbox_' . $services[$i]);
                if ($single_array != "" && $single_array != null && is_array($single_array) && !empty($single_array)) {
                    $products = array_merge($products,$single_array);
                }
                
                if($is_giftcard_applied == '1'){
                    $this->db->where('id',$applied_giftcard_id);
                    $giftcard = $this->db->get('tbl_gift_card')->row();
                    if(!empty($giftcard)){
                        $giftcard_services = explode(',',$giftcard->service_name);
                        if(in_array($services[$i],$giftcard_services)){
                            $service_price = $this->input->post('service_price_' . $services[$i]);
                            $applicable_giftcard_total_service_amount = $applicable_giftcard_total_service_amount + $service_price;
                        }
                    }
                }
            }
        }

		$selected_package = $this->input->post('selected_package_id');
        $package_products = array();
        $package_services = $this->input->post('package_service_name_check_' . $selected_package);
        if($package_services != "" && is_array($package_services) && !empty($package_services)){
            for($i=0;$i<count($package_services);$i++){
                $single_array = $this->input->post('package_product_name_check_' . $selected_package .'_' . $package_services[$i]);
                if ($single_array != "" && $single_array != null && is_array($single_array) && !empty($single_array)) {
                    $package_products = array_merge($products,$single_array);
                }
            }
        }

        if(!empty($package_services)){
            if(!empty($services)){
                $merged_services = array_merge($services,$package_services);
            }else{
                $merged_services = $package_services;
            }
        }else{
            $merged_services = $services;
        }
        if(!empty($package_products)){
            if(!empty($products)){
                $merged_products = array_merge($products,$package_products);
            }else{
                $merged_products = $package_products;
            }
        }else{
            $merged_products = $products;
        }

		$selected_coupon_id = $this->input->post('selected_coupon_id_hidden');

		$total_service_amount = $this->input->post('total-service-amount');
		$total_product_amount = $this->input->post('total-product-amount');
		$service_payable_amount = $this->input->post('service_payable_hidden');
		$product_payable_amount = $this->input->post('product_payable_hidden');
		$package_amount = $this->input->post('total-package-amount');
		$payable_amount = $this->input->post('payable_hidden');
		$coupon_discount_amount = $this->input->post('coupon_discount_hidden');
		$total_discount_hidden = $this->input->post('total_discount_hidden');
		$booking_amount = $this->input->post('booking_amount_hidden');
		$gst_amount = $this->input->post('gst_amount_hidden');
		$grand_total_amount = $this->input->post('grand_total_hidden');
        
		$membership_discount_type = $this->input->post('membership_discount_type');
		$membership_service_discount_amount = $this->input->post('membership_service_discount_amount_hidden');
		$membership_product_discount_amount = $this->input->post('membership_product_discount_amount_hidden');
		$membership_service_discount = $this->input->post('membership_service_discount');
		$membership_product_discount = $this->input->post('membership_product_discount');

        $booking_data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'customer_name' 		=> $customer_id,
            'is_membership_booking' => $is_member,
            'membership_id' 		=> $membership_id,
            'membership_discount_type'	=> $membership_discount_type,
            'm_service_discount'	=> $membership_service_discount,
            'm_product_discount' 	=> $membership_product_discount,
            'm_service_discount_amount'	    => $membership_service_discount_amount,
            'm_product_discount_amount' 	=> $membership_product_discount_amount,
            'original_services'     => !empty($merged_services) ? implode(',',$merged_services) : '',
            'original_products' 	=> !empty($merged_products) ? implode(',',$merged_products) : '',
            'services' 		        => !empty($merged_services) ? implode(',',$merged_services) : '',
            'products' 		        => !empty($merged_products) ? implode(',',$merged_products) : '',
            'selected_coupon_id' 	=> $selected_coupon_id,
            'pacakge_id' 			=> $selected_package,
            'package_amount' 		=> $package_amount,
            'total_service_price'   => $total_service_amount,
            'total_product_price'   => $total_product_amount,
            'service_price'         => $service_payable_amount,
            'product_price'         => $product_payable_amount,
            'payble_price'          => $payable_amount,
            'coupon_discount_amount'=> $coupon_discount_amount,
            'reward_discount_amount'=> $reward_discount_hidden,
            'total_discount_amount' => $total_discount_hidden,
            'used_rewards'          => $used_rewards,
            'booking_amount'        => $booking_amount,
            'gst_amount'            => $gst_amount,
            'amount_to_paid'        => $grand_total_amount,
            'reminder' 				=> $reminder,
            'payment_method' 		=> $payment_method,
            'note'   				=> $note,
            'is_giftcard_applied' 	=> $is_giftcard_applied,
            'applied_giftcard_id'   => ($is_giftcard_applied == '1') ? $applied_giftcard_id : '',
            'gift_discount'         => ($is_giftcard_applied == '1') ? $giftcard_discount : '',
            'booking_date'          => date("Y-m-d"),
            'service_start_date'    => date("Y-m-d",strtotime($this->input->post('booking_date'))),
            'service_start_time'    => date("H:i:s",strtotime($this->input->post('booking_start'))),
            'created_on'            => date("Y-m-d H:i:s"),
        );
        // echo '<pre>'; print_r($_POST); exit();
        $this->db->insert('tbl_new_booking', $booking_data);
        $booking_id = $this->db->insert_id();

        $order_counts = $this->get_saloon_branch_total_orders($this->session->userdata('salon_id'),$this->session->userdata('branch_id'));
        $branch_formatted = sprintf('%03d', $this->session->userdata('branch_id'));
        $salon_formatted = sprintf('%03d', $this->session->userdata('salon_id'));
        $count_formatted = sprintf('%04d', ($order_counts + 1));
        $invoice_no = $branch_formatted.$salon_formatted.$count_formatted;

        $update_data = array(
            'receipt_no'    =>  $invoice_no,
        );
        $this->db->where('id',$booking_id);
        $this->db->update('tbl_new_booking',$update_data);


        if($is_giftcard_applied == '1'){
            $this->db->where('id',$applied_giftcard_id);
            $giftcard = $this->db->get('tbl_gift_card')->row();
            if(!empty($giftcard)){
                $existing_customers = explode(',',$giftcard->used_by_customers);
                $existing_customers[] = $customer_id.'@@@'.$booking_id.'@@@'.date("Y-m-d");

                $this->db->where('id',$giftcard->id);
                $this->db->update('tbl_gift_card',array('used_by_customers'=>implode(',',$existing_customers)));
            }
        }else{
            $giftcard = array();
        }

        if($used_rewards > 0){
            $this->db->where('id',$customer_id);
            $customer_rewards = $this->db->get('tbl_salon_customer')->row();
            if(!empty($customer_rewards)){
                $pre_balance = $customer_rewards->rewards_balance;
                $rewards = $used_rewards;
                $new_balance = $pre_balance - $rewards;

                $reward_data = array(
                    'customer_id'                   =>  $customer_id,
                    'branch_id'                     =>  $this->session->userdata('branch_id'),
                    'salon_id'                      =>  $this->session->userdata('salon_id'),
                    'booking_id'                    =>  $booking_id,
                    'transaction_type'              =>  '2',
                    'remark'                        =>  'Reward points used for booking confirmation',
                    'previous_reward_balance'       =>  $customer_rewards->rewards_balance,
                    'reward_value'                  =>  $rewards,
                    'new_reward_balance'            =>  $new_balance,
                    'created_on'                    =>  date("Y-m-d H:i:s")
                );
                $this->db->insert('tbl_customer_rewards_history',$reward_data);

                $this->db->where('id',$customer_id);
                $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
            }
        }
        
        if($services != "" && is_array($services) && !empty($services)){
            for($i=0;$i<count($services);$i++){
                $products_single = $this->input->post('product_checkbox_' . $services[$i]);
                $service_price = $this->input->post('service_price_' . $services[$i]);

                $original_service_price = $this->input->post('service_original_price_' . $services[$i]); 
                $is_service_offer_applied = $this->input->post('is_service_offer_applied_' . $services[$i]);
                $applied_offer_id = $this->input->post('applied_offer_id_' . $services[$i]);
                $service_offer_discount = $this->input->post('service_offer_discount_' . $services[$i]);
                $service_offer_discount_type = $this->input->post('service_offer_discount_type_' . $services[$i]);
                $service_offer_discount_amount = $this->input->post('service_offer_discount_amount_' . $services[$i]);

                $received_total_service = $total_service_amount;
                if($received_total_service != "" && $received_total_service != "0.00" && $received_total_service != null && $received_total_service != 0){
                    $price_share_in_total_service = (float)(($service_price/$received_total_service) * 100);
                    $discount_share_membership_amount = (float)(($membership_service_discount_amount * $price_share_in_total_service) / 100);
                }else{
                    $discount_share_membership_amount = 0;
                }

                $received_total = $total_product_amount + $total_service_amount;
                if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                    $price_share_in_total = (float)(($service_price/$received_total) * 100);
                    $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                    $discount_share_reward_amount = (float)(($reward_discount_hidden * $price_share_in_total) / 100);
                }else{
                    $discount_share_coupon_amount = 0;
                    $discount_share_reward_amount = 0;
                }
                $discount_share_giftcard_amount = 0 ;
                if($is_giftcard_applied == '1' && !empty($giftcard)){
                    $giftcard_services = explode(',',$giftcard->service_name);
                    if(in_array($services[$i],$giftcard_services)){
                        if($applicable_giftcard_total_service_amount != "" && $applicable_giftcard_total_service_amount != "0.00" && $applicable_giftcard_total_service_amount != null && $applicable_giftcard_total_service_amount != 0){
                            $price_share_in_total_giftcard_service_amount = (float)(($service_price/$applicable_giftcard_total_service_amount) * 100);
                            $discount_share_giftcard_amount = (float)(($giftcard_discount * $price_share_in_total_giftcard_service_amount) / 100);
                        }
                    }
                }

                $total_single_service_discount = $discount_share_membership_amount + $discount_share_coupon_amount + $discount_share_reward_amount + $discount_share_giftcard_amount;
                $single_service_discounted_amount = $service_price - $total_single_service_discount;

                $stylist_data = array(
                    'booking_id' 		    => $booking_id,
                    'branch_id' 			=> $this->session->userdata('branch_id'),
                    'salon_id' 				=> $this->session->userdata('salon_id'),
                    'customer_name' 		=> $customer_id,
                    'service_added_from'	=> '0', //single
                    'service_id'     		=> $services[$i],
                    'service_price'     	=> $service_price,
                    'original_service_price'=> $original_service_price,
                    'product_ids'     		=> (!empty($products_single)) ? implode(',',$products_single) : null,
                    'service_reward_points' => $this->input->post('service_reward_points_' . $services[$i]),
                    'stylist_id'      		=> $this->input->post('service_stylist_id_' . $services[$i]),
                    'service_date'     		=> date('Y-m-d',strtotime($this->input->post('booking_date'))),
                    'service_from'    	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $services[$i]))[0])),
                    'service_to'      	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $services[$i]))[1])),
                    'created_on'            => date("Y-m-d H:i:s"),
                    
                    'received_discount_amount_while_booking'     	=> $total_single_service_discount,
                    'received_coupon_discount_while_booking'     	=> $discount_share_coupon_amount,
                    'received_reward_discount_while_booking'     	=> $discount_share_reward_amount,
                    'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                    'received_giftcard_discount_while_booking'     	=> $discount_share_giftcard_amount,
                    'service_discounted_price_while_booking'     	=> $single_service_discounted_amount,
                    
                    'is_service_offer_applied'     	                => $is_service_offer_applied,
                    'applied_offer_id'     	                        => $is_service_offer_applied == '1' ? $applied_offer_id : '',
                    'service_offer_discount'                        => $is_service_offer_applied == '1' ? $service_offer_discount : '',
                    'service_offer_discount_type'     	            => $is_service_offer_applied == '1' ? $service_offer_discount_type : '',
                    'service_offer_discount_amount'     	        => $is_service_offer_applied == '1' ? $service_offer_discount_amount : '',
                );
                $this->db->insert('tbl_booking_services_details', $stylist_data);
                $booking_service_details_id = $this->db->insert_id();

                if($products_single != "" && is_array($products_single) && !empty($products_single)){
                    for($j=0;$j<count($products_single);$j++){
                        $product_price = $this->input->post('product_price_' . $services[$i] . '_' . $products_single[$j]);                        

                        $received_total_product = $total_product_amount;
                        if($received_total_product != "" && $received_total_product != "0.00" && $received_total_product != null && $received_total_product != 0){
                            $price_share_in_total_product = (float)(($product_price/$received_total_product) * 100);
                            $discount_share_membership_amount = (float)(($membership_product_discount_amount * $price_share_in_total_product) / 100);
                        }else{
                            $discount_share_membership_amount = 0;
                        }

                        $received_total = $total_product_amount + $total_service_amount;
                        if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                            $price_share_in_total = (float)(($product_price/$received_total) * 100);
                            $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                            $discount_share_reward_amount = (float)(($reward_discount_hidden * $price_share_in_total) / 100);
                        }else{
                            $discount_share_coupon_amount = 0;
                            $discount_share_reward_amount = 0;
                        }

                        $total_single_product_discount = $discount_share_membership_amount + $discount_share_coupon_amount + $discount_share_reward_amount;
                        $single_product_discounted_amount = $product_price - $total_single_product_discount;

                        $service_product_data = array(
                            'booking_service_details_id'  => $booking_service_details_id,
                            'booking_id' 		    => $booking_id,
                            'branch_id' 			=> $this->session->userdata('branch_id'),
                            'salon_id' 				=> $this->session->userdata('salon_id'),
                            'customer_name' 		=> $customer_id,
                            'product_added_from'	=> '0', //single
                            'service_id'     		=> $services[$i],
                            'product_id'     		=> $products_single[$j],
                            'product_price'     	=> $product_price,
                            'created_on'            => date("Y-m-d H:i:s"),
                    
                            'received_discount_amount_while_booking'     	=> $total_single_product_discount,
                            'received_coupon_discount_while_booking'     	=> $discount_share_coupon_amount,
                            'received_reward_discount_while_booking'     	=> $discount_share_reward_amount,
                            'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                            'product_discounted_price_while_booking'     	=> $single_product_discounted_amount,
                        );
                        $this->db->insert('tbl_booking_services_products_details', $service_product_data);
                    }
                }

                $this->db->where('id',$customer_id);
                $customer_rewards = $this->db->get('tbl_salon_customer')->row();
                if(!empty($customer_rewards)){
                    $pre_balance = $customer_rewards->rewards_balance;
                    $rewards = ($this->input->post('service_reward_points_' . $services[$i]) != "" && $this->input->post('service_reward_points_' . $services[$i]) != null) ? $this->input->post('service_reward_points_' . $services[$i]) : '0';
                    $new_balance = $pre_balance + $rewards;

                    $reward_data = array(
                        'customer_id'                   =>  $customer_id,
                        'branch_id'                     =>  $this->session->userdata('branch_id'),
                        'salon_id'                      =>  $this->session->userdata('salon_id'),
                        'booking_id'                    =>  $booking_id,
                        'rewards_for'                   =>  '0',
                        'for_service'                   =>  $services[$i],
                        'booking_service_details_id'    =>  $booking_service_details_id,
                        'transaction_type'              =>  '0',
                        'remark'                        =>  'Reward points credited for service booking',
                        'previous_reward_balance'       =>  $pre_balance,
                        'reward_value'                  =>  $rewards,
                        'new_reward_balance'            =>  $new_balance,
                        'created_on'                    =>  date("Y-m-d H:i:s")
                    );
                    $this->db->insert('tbl_customer_rewards_history',$reward_data);

                    $this->db->where('id',$customer_id);
                    $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                }
            }
        }
        if($package_services != "" && is_array($package_services) && !empty($package_services)){
            for($i=0;$i<count($package_services);$i++){
                $products_single = $this->input->post('package_product_name_check_' . $selected_package .'_' . $package_services[$i]);
                $stylist_data = array(
                    'booking_id' 		    => $booking_id,
                    'branch_id' 			=> $this->session->userdata('branch_id'),
                    'salon_id' 				=> $this->session->userdata('salon_id'),
                    'customer_name' 		=> $customer_id,
                    'service_added_from'	=> '1', //package
                    'service_id'     		=> $package_services[$i],
                    'product_ids'     		=> (!empty($products_single)) ? implode(',',$products_single) : null,
                    'service_reward_points' => $this->input->post('service_reward_points_' . $package_services[$i]),
                    'stylist_id'      		=> $this->input->post('service_stylist_id_' . $package_services[$i]),
                    'service_date'     		=> date('Y-m-d',strtotime($this->input->post('booking_date'))),
                    'service_from'    	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_services[$i]))[0])),
                    'service_to'      	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_services[$i]))[1])),
                    'created_on'            => date("Y-m-d H:i:s"),
                );
                $this->db->insert('tbl_booking_services_details', $stylist_data);                
                $booking_service_details_id = $this->db->insert_id();

                if($products_single != "" && is_array($products_single) && !empty($products_single)){
                    for($j=0;$j<count($products_single);$j++){
                        $service_product_data = array(
                            'booking_service_details_id'  => $booking_service_details_id,
                            'booking_id' 		    => $booking_id,
                            'branch_id' 			=> $this->session->userdata('branch_id'),
                            'salon_id' 				=> $this->session->userdata('salon_id'),
                            'customer_name' 		=> $customer_id,
                            'package_id' 		    => $selected_package,
                            'product_added_from'	=> '1', //package
                            'service_id'     		=> $package_services[$i],
                            'product_id'     		=> $products_single[$j],
                            'created_on'            => date("Y-m-d H:i:s"),
                        );
                        $this->db->insert('tbl_booking_services_products_details', $service_product_data);
                    }
                }
            }  
        }   

        if($selected_package != ""){
            $package_details = $this->get_package_details($selected_package);
            if(!empty($package_details)){
                if($this->input->post('is_old_package') == '1'){
                    $active_package_allocation = $this->get_active_package_allocation($this->input->post('old_package_allocation_id'));
                    if(!empty($active_package_allocation)){
                        if(!empty($package_services)){
                            for($i=0;$i<count($package_services);$i++){
                                $old_details = $this->get_active_package_allocation_item_status($active_package_allocation->id,$package_services[$i],'0');
                                if(!empty($old_details)){
                                    $package_item_used_details = array(
                                        'item_used_in_booking_id'   => $booking_id,
                                        'used_status'               => '1',
                                        'service_date'     		    => date('Y-m-d',strtotime($this->input->post('booking_date'))),
                                        'service_from'    	        => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_services[$i]))[0])),
                                        'service_to'      	        => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_services[$i]))[1])),
                                        'item_used_on'              => date("Y-m-d"),
                                    );
                                    $this->db->where('id',$old_details->id);
                                    $this->db->update('tbl_booking_package_detail_status', $package_item_used_details);
                                }
                            }
                        }

                        $this->db->where('allocation_id',$active_package_allocation->id);
                        $this->db->where('customer_name',$customer_id);
                        $this->db->where('pacakge_id',$selected_package);
                        $this->db->where('used_status','0');
                        $this->db->where('is_deleted','0');
                        $available_unused_item = $this->db->get('tbl_booking_package_detail_status')->num_rows();
                        if($available_unused_item == 0){
                            $lapsed_data = array(
                                'is_lapsed' =>  '1',
                            );
                            $this->db->where('id',$active_package_allocation->id);
                            $this->db->update('tbl_customer_package_allocations', $lapsed_data);
                        }
                    }
                }else{
                    $this->db->where('id',$customer_id);
                    $customer_rewards = $this->db->get('tbl_salon_customer')->row();
                    if(!empty($customer_rewards)){
                        $pre_balance = $customer_rewards->rewards_balance;
                        $rewards = ($package_details->reward_point != "" && $package_details->reward_point != null) ? $package_details->reward_point : '0';
                        $new_balance = $pre_balance + $rewards;

                        $reward_data = array(
                            'customer_id'                   =>  $customer_id,
                            'branch_id'                     =>  $this->session->userdata('branch_id'),
                            'salon_id'                      =>  $this->session->userdata('salon_id'),
                            'booking_id'                    =>  $booking_id,
                            'rewards_for'                   =>  '1',
                            'for_package'                   =>  $selected_package,
                            'transaction_type'              =>  '0',
                            'remark'                        =>  'Reward points credited for package booking',
                            'previous_reward_balance'       =>  $pre_balance,
                            'reward_value'                  =>  $rewards,
                            'new_reward_balance'            =>  $new_balance,
                            'created_on'                    =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_customer_rewards_history',$reward_data);

                        $this->db->where('id',$customer_id);
                        $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                    }

                    $allocation_data = array(
                        'customer_name'         =>  $customer_id,
                        'allocated_in_booking_id'   =>  $booking_id,
                        'package_id'            =>  $selected_package,
                        'branch_id' 			=>  $this->session->userdata('branch_id'),
                        'salon_id' 				=>  $this->session->userdata('salon_id'),
                        'package_start_date'    =>  date("Y-m-d"),
                        'package_amount'        =>  $package_amount,
                        'created_on'            =>  date("Y-m-d H:i:s"),
                    );
                    $this->db->insert('tbl_customer_package_allocations', $allocation_data);
                    $allocation_id = $this->db->insert_id();

                    $allocation_data_for_product = array(
                        'package_allocation_id' =>  $allocation_id
                    );
                    $this->db->where('product_added_from','1');
                    $this->db->where('customer_name',$customer_id);
                    $this->db->where('booking_id',$booking_id);
                    $this->db->where('package_id',$selected_package);
                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                    $this->db->where('salon_id',$this->session->userdata('salon_id'));
                    $this->db->update('tbl_booking_services_products_details',$allocation_data_for_product);

                    $package_all_services = explode(',',$package_details->service_name);

                    if(!empty($package_all_services)){
                        for($i=0;$i<count($package_all_services);$i++){
                            $package_service_products = $this->get_package_products_single($package_details->id,$package_all_services[$i]);
                            $package_item_details = array(
                                'branch_id' 			=> $this->session->userdata('branch_id'),
                                'salon_id' 				=> $this->session->userdata('salon_id'),
                                'allocation_id' 		=> $allocation_id,
                                'customer_name' 		=> $customer_id,
                                'pacakge_id' 		    => $selected_package,
                                'package_amount' 		=> $package_amount,
                                'added_in_booking_id'   => $booking_id,
                                'item_type'             =>  '0',
                                'item_id'               =>  $package_all_services[$i],
                                'products_id'           =>  !empty($package_service_products) ? $package_service_products->product_ids : null,
                                'item_added_on'         =>  date("Y-m-d"),
                                'package_start_date'    =>  date("Y-m-d"),
                                'created_on'            =>  date("Y-m-d H:i:s"),
                            );
                            $this->db->insert('tbl_booking_package_detail_status', $package_item_details);
                            $single_package_details_id = $this->db->insert_id();

                            if(!empty($package_services)){
                                if(in_array($package_all_services[$i],$package_services)){
                                    $package_item_used_details = array(
                                        'item_used_in_booking_id'   => $booking_id,
                                        'used_status'               =>  '1',
                                        'service_date'     		    =>  date('Y-m-d',strtotime($this->input->post('booking_date'))),
                                        'service_from'    	        =>  date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_all_services[$i]))[0])),
                                        'service_to'      	        =>  date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $package_all_services[$i]))[1])),
                                        'item_used_on'              =>  date("Y-m-d"),
                                    );
                                    $this->db->where('item_type','0');
                                    $this->db->where('allocation_id',$allocation_id);
                                    $this->db->where('id',$single_package_details_id);
                                    $this->db->where('item_id',$package_all_services[$i]);
                                    $this->db->update('tbl_booking_package_detail_status', $package_item_used_details);
                                }
                            }
                        }
                    }                

                    $this->db->where('allocation_id',$allocation_id);
                    $this->db->where('customer_name',$customer_id);
                    $this->db->where('pacakge_id',$selected_package);
                    $this->db->where('used_status','0');
                    $this->db->where('is_deleted','0');
                    $available_unused_item = $this->db->get('tbl_booking_package_detail_status')->num_rows();
                    if($available_unused_item == 0){
                        $lapsed_data = array(
                            'is_lapsed' =>  '1',
                        );
                        $this->db->where('id',$allocation_id);
                        $this->db->update('tbl_customer_package_allocations', $lapsed_data);
                    }
                }
            }
        }

		return true;
	} 
	public function get_salon_services_list_by_selected_stylist($stylist_id){
        $this->db->where('is_deleted','0');
        $this->db->where('id', $stylist_id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_employee');
        return $result->row();
    } 
	public function get_all_booking_for_calendar(){
		$this->db->select('tbl_new_booking.*,tbl_salon_customer.email,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone');
		$this->db->from('tbl_new_booking');
		$this->db->join('tbl_salon_customer', 'tbl_new_booking.customer_name = tbl_salon_customer.id', 'left');
		$this->db->where('tbl_new_booking.is_deleted', '0');
		$this->db->where('tbl_new_booking.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_new_booking.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_new_booking.id', 'DESC');
		$result = $this->db->get();
		return $result->result();
	} 
	public function get_all_booking_list_for_selecteddate_ajax(){
		$this->db->select('tbl_new_booking.*,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_name, tbl_salon_customer.full_name,tbl_salon_customer.customer_phone,tbl_salon_employee.full_name as employee_name');
		$this->db->join('tbl_salon_customer', 'tbl_new_booking.customer_name = tbl_salon_customer.id', 'left');
		$this->db->join('tbl_salon_employee', 'tbl_new_booking.stylist = tbl_salon_employee.id', 'left');
		$this->db->join('tbl_salon_emp_service', 'tbl_new_booking.services = tbl_salon_emp_service.id', 'left');
		$booking_date = $this->input->post('booking_date');
		$this->db->where('tbl_new_booking.is_deleted', '0');
		$this->db->where('tbl_new_booking.booking_date', $booking_date);
		$this->db->where('tbl_new_booking.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_new_booking.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_new_booking')->result();
		if (!empty($result)) {
			echo json_encode($result);
		} else{
			echo 0;
		}
	} 
	public function get_customer_info_for_calender(){
		$this->db->where('is_deleted', '0');
		$this->db->where('booking_status', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_customer');
		return $result->result();
	} 
	public function get_salon_services_list_for_calender(){
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service');
		return $result->result();
	} 
	public function get_all_booking(){
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_new_booking');
		return $result->result();
	} 
    public function get_single_booking(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_new_booking');
        return $result->row();
    }
    public function get_service_for_booking(){
        $this->db->select('tbl_sub_category.*,tbl_salon_service_category.sup_category');
        $this->db->from('tbl_sub_category');
        $this->db->join('tbl_salon_service_category', 'tbl_salon_service_category.id = tbl_sub_category.sup_category', 'left');
        $this->db->where('tbl_sub_category.is_deleted', '0');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_shift_name_for_employee(){
        $stylistId = $this->input->post('stylist_id');
        $this->db->select('tbl_salon_employee.*,tbl_new_booking.time_slot,tbl_new_booking.stylist, tbl_shift_master.id, tbl_shift_master.lunch_start_time, tbl_shift_master.lunch_close_time, tbl_shift_master.shift_in_time, tbl_shift_master.shift_out_time, tbl_booking_rules.session_avg_duration ,tbl_booking_rules.offset_session_time,tbl_booking_rules.on_off_btn,tbl_booking_rules.salon_start_time,tbl_booking_rules.salon_end_time');
        $this->db->from('tbl_salon_employee');
        $this->db->join('tbl_shift_master', 'tbl_shift_master.id = tbl_salon_employee.shift_name', 'left');
        $this->db->join('tbl_booking_rules', 'tbl_booking_rules.id = tbl_booking_rules.branch_id', 'left');
        $this->db->join('tbl_new_booking', 'tbl_new_booking.id = tbl_new_booking.branch_id', 'left');
        $this->db->where('tbl_salon_employee.id', $stylistId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->row(); 
            echo json_encode(array(
                'shift_in_time' 		=> $result->shift_in_time,
                'shift_out_time' 		=> $result->shift_out_time,
                'session_avg_duration' 	=> $result->session_avg_duration,
                'offset_session_time' 	=> $result->offset_session_time,
                'on_off_btn' 			=> $result->on_off_btn,
                'time_slot' 			=> $result->time_slot,
                'salon_start_time' 		=> $result->salon_start_time,
                'salon_end_time' 		=> $result->salon_end_time,
                'lunch_start_time' 		=> $result->lunch_start_time,
                'lunch_close_time' 		=> $result->lunch_close_time,
            ));
        }
    }  
    public function get_customer_details($id){
		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');		
        $this->db->where('tbl_salon_customer.id',$id);
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->row();
        return $result;
    } 
    
	public function get_all_salon_customer_list($length, $start, $search){
		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');		
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
		if($search !=""){
			$this->db->or_like('tbl_salon_customer.full_name',$search);
			$this->db->or_like('tbl_salon_customer.email',$search);
			$this->db->or_like('tbl_salon_customer.customer_phone',$search);
			$this->db->or_like('tbl_salon_customer.dob',$search);
			$this->db->or_like('tbl_salon_customer.rewards_balance',$search);
			$this->db->or_like('tbl_salon_customer.current_pending_amount',$search);
			$this->db->or_like('states.name',$search);
			$this->db->or_like('cities.name',$search);
		}	
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
		$this->db->order_by('tbl_salon_customer.id','DESC');
		$this->db->limit($length,$start);
		$result = $this->db->get('tbl_salon_customer');
		return $result->result();		
	}
	public function get_all_salon_customer_count($search){
		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');		
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
		if($search !=""){
			$this->db->or_like('tbl_salon_customer.full_name',$search);
			$this->db->or_like('tbl_salon_customer.email',$search);
			$this->db->or_like('tbl_salon_customer.customer_phone',$search);
			$this->db->or_like('tbl_salon_customer.dob',$search);
			$this->db->or_like('tbl_salon_customer.rewards_balance',$search);
			$this->db->or_like('tbl_salon_customer.current_pending_amount',$search);
			$this->db->or_like('states.name',$search);
			$this->db->or_like('cities.name',$search);
		}	
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
		$this->db->order_by('tbl_salon_customer.id','DESC');
		$result = $this->db->get('tbl_salon_customer');
		return $result->num_rows();
	}
    public function get_customer_all_details_ajax(){
        $customer = $this->input->post('customer');
        $this->db->where('tbl_salon_customer.id',$customer);
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->row();
        echo json_encode($result);
    } 
    public function get_customer_details_ajax(){
        $keyword = $this->input->post('keyword');
        $this->db->select('tbl_salon_customer.*, cities.name as city_name, states.name as state_name');
        $this->db->where('tbl_salon_customer.is_deleted', '0');
        $this->db->where('tbl_salon_customer.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id', $this->session->userdata('salon_id'));
        $this->db->group_start();
        $this->db->like('tbl_salon_customer.customer_phone', $keyword);
        $this->db->or_like('tbl_salon_customer.full_name', $keyword);
        $this->db->group_end();
        $this->db->join('states', 'states.id = tbl_salon_customer.state', 'left');
        $this->db->join('cities', 'cities.id = tbl_salon_customer.city', 'left');
        $result = $this->db->get('tbl_salon_customer');
        $result = $result->result();
        echo json_encode($result);
    }
    
    public function get_reward_setup_ajx(){
        $gender = $this->input->post('gender');

		$this->db->select('tbl_reward_point.*');		
        $this->db->where('tbl_reward_point.gender',$gender);
        $this->db->where('tbl_reward_point.is_deleted','0');
        $this->db->where('tbl_reward_point.status','1');
        $this->db->where('tbl_reward_point.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_reward_point.salon_id',$this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_reward_point');
		$result = $result->row();
        echo json_encode($result);
    }	
    public function get_customer_details_for_booking_ajax(){
        $phone = $this->input->post('phone');
        $id = $this->input->post('id');

		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');	
        if($id == ""){	
            $this->db->where('tbl_salon_customer.customer_phone',$phone);
        }else{
            $this->db->where('tbl_salon_customer.id',$id);
        }
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_customer.is_deleted','0');
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->row();
        if(!empty($result)){
            if($result->membership_id != "" && $result->membership_id != null && $result->membership_id != "0"){
                $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                $this->db->where('tbl_customer_membership_history.id',$result->membership_pkey);
                $this->db->where('tbl_customer_membership_history.customer_id', $result->id);
                $this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
                $this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
                $this->db->where('tbl_customer_membership_history.is_deleted','0');
                $membership_details = $this->db->get('tbl_customer_membership_history')->row();

                if(!empty($membership_details)){
                    $membership = $membership_details;
                    $is_member = '1';
                }else{
                    $membership = array();
                    $is_member = '0';
                }
            }else{
                $membership = array();
                $is_member = '0';
            }

            $this->db->where('tbl_booking_payment_entry.customer_id', $result->id);
            $this->db->where('tbl_booking_payment_entry.is_deleted', '0');
            $this->db->order_by('tbl_booking_payment_entry.payment_date', 'desc');
            $payments = $this->db->get('tbl_booking_payment_entry')->result();
            
            $this->db->where('tbl_new_booking.customer_name', $result->id);
            $this->db->where('tbl_new_booking.is_deleted', '0');
            $this->db->order_by('tbl_new_booking.booking_date', 'asc');
            $order_history = $this->db->get('tbl_new_booking')->result();
            
            $this->db->select('tbl_booking_services_details.*, tbl_salon_emp_service.service_name, tbl_salon_emp_service.service_name_marathi,tbl_salon_employee.full_name');
            $this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
            $this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
            $this->db->where('tbl_booking_services_details.customer_name', $result->id);
            // $this->db->order_by('tbl_booking_services_details.service_from', 'asc');
            $this->db->where('tbl_booking_services_details.is_deleted', '0');
            $this->db->order_by('tbl_booking_services_details.id', 'desc');
            $order_service_history = $this->db->get('tbl_booking_services_details')->result();

            $this->db->where('customer_id', $result->id);
            $this->db->where('branch_id',$this->session->userdata('branch_id'));
            $this->db->where('salon_id',$this->session->userdata('salon_id'));
            $this->db->where('is_deleted', '0');
            $resch_count = $this->db->get('tbl_customer_rescheduled_bookings')->num_rows();

            $this->db->where('customer_name', $result->id);
            $this->db->where('branch_id',$this->session->userdata('branch_id'));
            $this->db->where('salon_id',$this->session->userdata('salon_id'));
            $this->db->where('is_deleted', '0');
            $this->db->where('service_status', '1');
            $completed_count = $this->db->get('tbl_booking_services_details')->num_rows();

            $this->db->where('customer_name', $result->id);
            $this->db->where('branch_id',$this->session->userdata('branch_id'));
            $this->db->where('salon_id',$this->session->userdata('salon_id'));
            $this->db->where('is_deleted', '0');
            $this->db->where('service_status', '2');
            $cancelled_count = $this->db->get('tbl_booking_services_details')->num_rows();

            $this->db->where('customer_name', $result->id);
            $this->db->where('branch_id',$this->session->userdata('branch_id'));
            $this->db->where('salon_id',$this->session->userdata('salon_id'));
            $this->db->where('is_deleted', '0');
            $this->db->where('service_status', '0');
            $pending_count = $this->db->get('tbl_booking_services_details')->num_rows();

            $counts = array(
                'cancelled'     =>  $cancelled_count,
                'pending'       =>  $pending_count,
                'completed'     =>  $completed_count,
                'rescheduled'   =>  $resch_count,
            );

            echo json_encode(
                array(
                    'customer'              =>  $result,
                    'is_member'             =>  $is_member,
                    'membership'            =>  $membership,
                    'order_history'         =>  $order_history,
                    'order_service_history' =>  $order_service_history,
                    'payments'              =>  $payments,
                    'counts'                =>  $counts,
                )
            );
        }else{
            echo 0;
        }
    } 
    
    public function get_customer_membership_details($id){
		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');	
        $this->db->where('tbl_salon_customer.id',$id);
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->row();
        if(!empty($result)){
            if($result->membership_id != "" && $result->membership_id != null && $result->membership_id != "0"){
                $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                $this->db->where('tbl_customer_membership_history.id',$result->membership_pkey);
                $this->db->where('tbl_customer_membership_history.customer_id', $result->id);
                $this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
                $this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
                $membership_details = $this->db->get('tbl_customer_membership_history')->row();

                if(!empty($membership_details)){
                    $membership = $membership_details;
                    $is_member = '1';
                }else{
                    $membership = array();
                    $is_member = '0';
                }
            }else{
                $membership = array();
                $is_member = '0';
            }

            return
                array(
                    'customer'              =>  $result,
                    'is_member'             =>  $is_member,
                    'membership'            =>  $membership,
                );
        }else{
            return array(
                'customer'              =>  array(),
                'is_member'             =>  '0',
                'membership'            =>  array(),
            );
        }
    }
	public function get_package_details($id){
		$this->db->where('id', $id);
		$result = $this->db->get('tbl_package')->row();
        return $result;
	} 
	public function get_giftcard_details($id){
		$this->db->where('id', $id);
		$result = $this->db->get('tbl_gift_card')->row();
        return $result;
	} 
	public function get_package_details_ajax(){
		$package_id = $this->input->post('package_name_id');
		$this->db->where('id', $package_id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_package')->row();
		if(!empty($result)){
			echo json_encode($result);
		}
	} 
	public function get_time_slot_by_shift_ajax(){
		$shift_name_id = $this->input->post('shift_name_id');
		$this->db->where('id', $shift_name_id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));    
		$result = $this->db->get('tbl_shift_master')->row(); 
		if(!empty($result)){
			echo json_encode($result);
		}
	}
	public function get_booking_single_service_details($booking,$service){	
		$this->db->where('booking_id', $booking);
		$this->db->where('service_id', $service);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id')); 
		$result = $this->db->get('tbl_booking_services_details')->row(); 
		return $result;
	} 
	public function get_service_stylists($id){	
        $this->db->where('is_deleted', '0');
        $this->db->where('find_in_set("'.$id.'", service_name) <> 0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id')); 
		$result = $this->db->get('tbl_salon_employee')->result(); 
		return $result;
	} 
	public function get_service_details($id){	
		$this->db->where('id', $id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id')); 
		$result = $this->db->get('tbl_salon_emp_service')->row(); 
		return $result;
	} 
	public function get_service_details_for_booking_ajax(){
		$sup_category = $this->input->post('sup_category');		
		$this->db->where('category', $sup_category);
		$this->db->where('status', '1');
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id')); 
		$result = $this->db->get('tbl_salon_emp_service')->result(); 
		if(!empty($result)){
			echo json_encode($result);
		} 
	} 
	public function get_stylist_details_ajax(){
		$service_name_id = $this->input->post('service_name_id');
		$this->db->select('tbl_sub_category.*, tbl_salon_employee.full_name, tbl_salon_employee.id');
		$this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_sub_category.id', 'left');
		$this->db->where('tbl_sub_category.id', $service_name_id);
		$this->db->where('tbl_new_booking.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_new_booking.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_sub_category')->row();
		if(!empty($result)){
			echo json_encode($result);
		}
	}
	public function get_product_details($id){
		$this->db->where('id', $id);
		$result = $this->db->get('tbl_product')->row();
	    return $result;
	} 
	public function get_product_details_for_booking_ajax(){
		$service_id = $this->input->post('service_id');
		$this->db->where('id', $service_id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->result();
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	} 
	public function get_service_selected_shift_ajax(){
		$service_id = $this->input->post('service_id');
		$this->db->where('id', $service_id);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->row();
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	}
	public function get_booking_by_time_ajax(){
		$time = $this->input->post('time');
		$this->db->where('time_slot', $time);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_new_booking')->result();
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	} 
	public function get_booking_by_time_and_date_ajax(){
		$time = $this->input->post('time');
		$date = $this->input->post('date');
		$this->db->where('booking_date', $date);
		$this->db->where('time_slot', $time);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_new_booking')->result();
		if (!empty($result)) {
			echo json_encode($result);
		} else {
			echo 0;
		}
	} 
	public function get_booking_by_date_ajax(){
		$date = $this->input->post('date');
		$this->db->where('booking_date', $date);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_new_booking')->result();
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	} 
	public function get_default_services_for_booking(){
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_salon_emp_service');
		return $result->result();
	}
	public function get_default_category_for_booking(){
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('default_status', '1');
		$this->db->order_by('id', 'asc');
		$result = $this->db->get('tbl_admin_service_category');
		return $result->result();
	}
	public function get_default_services_ajax(){
		$category = $this->input->post('category');
		$this->db->select('tbl_salon_emp_service.*, tbl_admin_service_category.sup_category');
		$this->db->from('tbl_salon_emp_service');
		$this->db->join('tbl_admin_service_category', 'tbl_salon_emp_service.category = tbl_admin_service_category.id', 'left');
		$this->db->where('tbl_salon_emp_service.category', $category);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get()->result();
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	} 
	public function set_booking_status(){
		$data = array(
			'branch_id' 	=> $this->session->userdata('branch_id'),
			'salon_id' 		=> $this->session->userdata('salon_id'),
			'status_name' 	=> $this->input->post('status_name'),
			'status_color' 	=> $this->input->post('status_color'),
		); 
		if($this->input->post('id') == ""){
			$date = array(
				'created_on'  => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_bokking_status_color', $new_arr);
			return 0;
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_bokking_status_color', $data);
			return 1;
		}
	} 
	public function get_all_status_color_list(){
		$this->db->where('tbl_bokking_status_color.is_deleted', '0');
		$this->db->where('tbl_bokking_status_color.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_bokking_status_color.salon_id', $this->session->userdata('salon_id')); 
		$this->db->select('tbl_bokking_status_color.*, tbl_admin_bokking_status_color.status_name');
		$this->db->from('tbl_bokking_status_color');
		$this->db->join('tbl_admin_bokking_status_color', 'tbl_bokking_status_color.status_name = tbl_admin_bokking_status_color.id');
		$this->db->order_by('tbl_bokking_status_color.id', 'DESC');
		$result = $this->db->get();
		return $result->result();
	}  
	public function get_single_status_color(){
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $this->uri->segment(2));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_bokking_status_color');
        return $result->row();
    } 
    public function get_unique_color_status_details_ajax(){
        $status_name_id = $this->input->post('status_name_id');
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('status_name', $status_name_id);
        $result = $this->db->get('tbl_bokking_status_color')->row();
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo 0;
        }
    } 
    public function set_notifications($customer_id, $heading, $description){
        $data = array(
            'customer_id'  => $customer_id,
            'heading'      => $heading,
            'discription'  => $description,
            'created_on'   => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_set_notification', $data);
    }
    public function get_all_notifications(){
        $this->db->where('is_deleted', '0');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_set_notification');
        return $result->result();
    } 
    public function add_sup_category($category_image){
		$data = array(
			'branch_id' 			=> $this->session->userdata('branch_id'),
			'salon_id' 				=> $this->session->userdata('salon_id'),
			'sup_category' 			=> $this->input->post('sup_category'),
			'category_image' 		=> $category_image,
			'sup_category_marathi' 	=> $this->input->post('sup_category_marathi'),
		); 
		if($this->input->post('id') == ""){
			$date = array(
				'created_on' => date("Y-m-d H:i:s")
			); 
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_salon_service_category', $new_arr);
		}else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_salon_service_category', $data);
		}
	}
	
	
	
	/*--------------------Code optimised------------------------*/
	

    
	public function add_service_sub_category(){
        $data = array(
            'salon_id' 			=> $this->session->userdata('salon_id'),
			'branch_id' 			=> $this->session->userdata('branch_id'),
			'category_id' 			=> $this->input->post('category'), 
            'sub_category' 			=> $this->input->post('sub_category'),
            'sub_category_marathi' 	=> $this->input->post('sub_category_marathi'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on' => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_service_sub_category', $new_arr);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_service_sub_category', $data);
        }
    }
	public function get_all_service_sub_category(){
		$this->db->select('tbl_salon_service_category.sup_category,tbl_service_sub_category.*');
		$this->db->where('tbl_service_sub_category.salon_id',$this->session->userdata('salon_id'));
		$this->db->where('tbl_service_sub_category.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('tbl_service_sub_category.is_deleted','0');
		$this->db->join('tbl_salon_service_category','tbl_salon_service_category.id = tbl_service_sub_category.category_id');
		$this->db->order_by('tbl_salon_service_category.sup_category', 'DESC');
		$result = $this->db->get('tbl_service_sub_category');
		return $result->result();
	}
	public function get_single_service_sub_category(){
		$this->db->where('tbl_service_sub_category.salon_id',$this->session->userdata('salon_id'));
		$this->db->where('tbl_service_sub_category.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('tbl_service_sub_category.id',$this->uri->segment(2));
		$this->db->where('tbl_service_sub_category.is_deleted','0'); 
		$result = $this->db->get('tbl_service_sub_category');
		return $result->row();
	}
    public function get_all_sup_category(){
        $this->db->where('is_deleted', '0');
        $this->db->order_by('sup_category', 'DESC');
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    }
    public function get_category_from_by_default(){
        $this->db->where('is_deleted', '0');
        $this->db->where('tbl_salon_service_category.salon_id','0');
		$this->db->where('tbl_salon_service_category.branch_id','0');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_service_category');
        return $result->result();
    }

    public function get_sub_category_ajax(){
        $this->db->where('sup_category',$this->input->post('sup_category'));
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_admin_sub_category');
        $result = $result->result();  
        echo json_encode($result); 
    }

    public function get_single_sup_category()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_salon_service_category');
        return $result->row();
    }
    
    public function get_unique_sup_category()
    {
        $this->db->where('sup_category', $this->input->post('sup_category'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_service_category');
        echo $result->num_rows();
    }


    // for Add Sub Category and Third Category


	public function get_selected_service_products($products){
        $this->db->where('is_deleted', '0');
		$exp = explode(",",$products);
		$this->db->where_in('id',$exp);
		$result = $this->db->get('tbl_product');
		return $result->result();
	}
	public function get_selected_service_employee($products){
		$exp = explode(",",$products);
		$this->db->where_in('id',$exp);
		$result = $this->db->get('tbl_salon_employee');
		return $result->result();
	}

	// public function get_all_services(){
	// 	$this->db->select('tbl_salon_emp_service.*,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi,tbl_salon_service_category.sup_category,tbl_salon_service_category.sup_category_marathi');
	// 	$this->db->where('tbl_salon_emp_service.is_deleted', '0');  
    //     $this->db->where('(tbl_salon_emp_service.branch_id = "'.$this->session->userdata('branch_id').'" OR tbl_salon_emp_service.branch_id = "0")');
    //     $this->db->where('(tbl_salon_emp_service.salon_id = "'.$this->session->userdata('salon_id').'" OR tbl_salon_emp_service.salon_id = "0")');
	// 	$this->db->join('tbl_salon_service_category','tbl_salon_service_category.id = tbl_salon_emp_service.category');
	// 	$this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
	// 	$this->db->order_by('tbl_salon_emp_service.id', 'DESC'); 
	// 	$result = $this->db->get('tbl_salon_emp_service');
	// 	return $result->result();
	// }

    public function get_all_services()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result();
    }



    public function get_current_branch($branch_id){
        $this->db->where('is_deleted', '0');
		$this->db->where_in('id',$branch_id);
		$result = $this->db->get('tbl_branch');
		return $result->result();
	}

    public function get_current_salon($salon_id){
        $this->db->where('is_deleted', '0');
		$this->db->where_in('id',$salon_id);
		$result = $this->db->get('tbl_salon');
		return $result->result();
	}
   
    

    public function get_salon_services_list_by_category($category_id)
    {
        $this->db->where('tbl_salon_emp_service.category', $category_id);
        $this->db->where('tbl_salon_emp_service.status', '1');
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
        $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
        $this->db->from('tbl_salon_emp_service');
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');
      
        $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
    
        $result = $this->db->get();
        return $result->result();
    }


    public function get_salon_services_list_by($category_id)
    {
        $this->db->where('tbl_admin_service_category.id', $category_id);
        $this->db->where('tbl_admin_service_category.status', '1');
        $this->db->where('tbl_admin_service_category.is_deleted', '0');
        $this->db->order_by('tbl_admin_service_category.id', 'DESC');
        $result = $this->db->get('tbl_admin_service_category');
        return $result->row();
    }



    public function get_all_disaprove_services()
    {
        $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
        $this->db->from('tbl_salon_emp_service');
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');
        $this->db->where('tbl_salon_emp_service.status', '0');
        $this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
    
        $result = $this->db->get();
        return $result->result();
    }
    


    public function get_ready_sub_category_list_by_category($category_id) {
        $this->db->select('tbl_admin_sub_category.*, tbl_admin_service_category.sup_category as category');
        $this->db->from('tbl_admin_sub_category');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_admin_sub_category.sup_category', 'left');
        $this->db->where('tbl_admin_sub_category.is_deleted', '0');
        $this->db->where_in('tbl_admin_sub_category.sup_category', $category_id);
    
        $result = $this->db->get();
        return $result->result();
    }
    


    public function get_ready_services_list_by_category($category_id)
    {
       
        $this->db->where('tbl_admin_services.sub_category', $category_id);
        $this->db->where('tbl_admin_services.is_deleted', '0');       
        $this->db->select('tbl_admin_services.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_service_category.sup_category as supcategory');
        $this->db->from('tbl_admin_services');
        $this->db->join('tbl_admin_sub_category', 'tbl_admin_services.sub_category = tbl_admin_sub_category.id');
        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_admin_services.category', 'left');
      
        $this->db->order_by('tbl_admin_services.id', 'DESC');
        $result = $this->db->get();
        return $result->result(); 
    }
    

    public function get_service_details_for_price_set_ajax()
{
    $service_id = $this->input->post('service_id');
    $this->db->where('id', $service_id);
    $result = $this->db->get('tbl_admin_services')->row();

    if (!empty($result)) {
        echo json_encode($result);
    } else {
        echo '[]';
    }
}
    
    
    public function get_single_service_from_admin(){
        $this->db->select('tbl_admin_services.*,tbl_admin_sub_category.sub_category as sub_category_name,tbl_admin_service_category.sup_category as category_name');
        $this->db->where('tbl_admin_services.id',$this->uri->segment(2));
        $this->db->where('tbl_admin_services.status', '1');  
        $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_admin_services.category');
        $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_admin_services.sub_category');
        $result = $this->db->get('tbl_admin_services');
       // echo "<pre>";print_r($result->row());exit;
        return $result->row();
    }
    public function get_salon_services_list_for_emp()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result();
    }

    public function set_salon_services(){ 
          // echo "<pre>";print_r($_POST);exit;
        $this->db->where('id',$this->input->post('service_pkey'));
        $service = $this->db->get('tbl_admin_services');
        $service = $service->row();
        if(!empty($service)){
            $data = array(
                'branch_id' 				=> $this->session->userdata('branch_id'),
                'salon_id' 					=> $this->session->userdata('salon_id'),
                'category'   				=> $service->category,
                'sub_category'   			=> $service->sub_category,
                'service_name'   			=> $service->service_name,
                'service_name_marathi'   	=> $service->service_name_marathi,
                'service_description' 		=> $service->service_description,
                'service_duration' 			=> $service->service_duration,
                'service_discount' 			=> $service->service_discount,
                'discount_in' 				=> $service->discount_in,
                'reward_point' 				=> $service->reward_point,
                'final_price' 				=> $this->input->post('final_price'),
                'reminder_duration' 	    => $service->reminder_duration,
                'discount_type' 	        => $service->discount_type,
                'min' 	                    => $service->min,
                'max' 	                    => $service->max,
                'default_status' 	        => $service->default_status,
                'category_image' 			=> $service->category_image,
                'service_id'                => $this->input->post('service_pkey'),
                'status' 			        => '1',
            );
        
            if ($this->input->post('product') == "") {
                $data['product'] = ' ';
            } else {
                $data['product'] = implode(',', $this->input->post('product'));
            }
        }
      
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on' => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_emp_service', $new_arr);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_emp_service', $data);
        }
    }
    public function get_my_added_service(){
        $this->db->select('service_id');
        $this->db->where('is_deleted', '0'); 
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_emp_service');
        $result = $result->result();
        $ids = array();
        if(!empty($result)){
            foreach($result as $result_res){
                $ids[] = $result_res->service_id;
            }
        }
        return $ids;
    }
    public function add_salon_services($category_image){ 
        $data = array(
            'branch_id' 				=> $this->session->userdata('branch_id'),
            'salon_id' 					=> $this->session->userdata('salon_id'),
            'category'   				=> $this->input->post('sup_category'),
            'sub_category'   			=> $this->input->post('sub_category'),
            'service_name'   			=> $this->input->post('service_name'),
            'service_name_marathi'   	=> $this->input->post('service_name_marathi'),
            'service_description' 		=> $this->input->post('service_description'),
            'service_duration' 			=> $this->input->post('service_duration'),
            'service_discount' 			=> $this->input->post('service_discount'),
            'discount_in' 				=> $this->input->post('discount_in'),
            'reward_point' 				=> $this->input->post('reward_point'),
            'final_price' 				=> $this->input->post('final_price'),
            'reminder_duration' 	    => $this->input->post('reminder_duration'),
            'discount_type' 	        => $this->input->post('discount_type'),
            'min' 	                    => $this->input->post('min'),
            'max' 	                    => $this->input->post('max'),
            'default_status' 	        => $this->input->post('default_status'),
			'category_image' 			=> $category_image,
        );
        // echo "<pre>";print_r($this->input->post('id'));exit;
        if ($this->input->post('product') == "") {
            $data['product'] = ' ';
        } else {
            $data['product'] = implode(',', $this->input->post('product'));
        }
        // echo "<pre>";print_r( $data);exit;
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on' => date("Y-m-d H:i:s")
            ); 
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_emp_service', $new_arr);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_emp_service', $data);
        }
    }

 



    public function get_all_sub_category_list()
{
    $this->db->select('tbl_sub_category.*, tbl_salon_service_category.sup_category');
    $this->db->from('tbl_sub_category');
    $this->db->join('tbl_salon_service_category', 'tbl_sub_category.sup_category = tbl_salon_service_category.id', 'left');
    $this->db->where('tbl_sub_category.is_deleted', '0');  
    $this->db->where('tbl_sub_category.branch_id', $this->session->userdata('branch_id'));
    $this->db->where('tbl_sub_category.salon_id', $this->session->userdata('salon_id'));
    $this->db->order_by('tbl_sub_category.id', 'DESC'); 
    $result = $this->db->get();
    return $result->result();
}


public function get_single_service_for_edit(){
    $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory');
    $this->db->from('tbl_salon_emp_service');
    $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
    $this->db->where('tbl_salon_emp_service.is_deleted', '0');
    $this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
    $this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
    $this->db->where('tbl_salon_emp_service.id', $this->uri->segment(2));
    $result = $this->db->get();
    return $result->row();
}


    public function get_sup_category(){
        $this->db->where('is_deleted', '0');
        $this->db->where('(tbl_salon_service_category.branch_id = "'.$this->session->userdata('branch_id').'" OR tbl_salon_service_category.branch_id = "0")');
        $this->db->where('(tbl_salon_service_category.salon_id = "'.$this->session->userdata('salon_id').'" OR tbl_salon_service_category.salon_id = "0")');
        $result = $this->db->get('tbl_salon_service_category');
        return $result->result();
    }

    public function get_emp_name_for_service(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_employee');
        return $result->result();
    }
	public function get_emp_name_for_service_name(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        // $this->db->where('desgnation','1');
        $result = $this->db->get('tbl_salon_employee');
        return $result->result();
    } 
    public function inactive(){
        $data = array(
            'status' => '0'
        );
        $this->db->where('id', $this->uri->segment(2));
        $this->db->update($this->uri->segment(3), $data);
        return true;
    } 
    public function active(){
        $data = array(
            'status' => '1'
        );
        $this->db->where('id', $this->uri->segment(2));
        $this->db->update($this->uri->segment(3), $data);
        return true;
    } 
    public function delete(){
        $data = array(
            'is_deleted' => '1'
        );
        $this->db->where('id', $this->uri->segment(2));
        $this->db->update($this->uri->segment(3), $data); 
        return true;
    }
    public function off_btn_offset_session_time($id){
        $this->db->where('id', $id);
        $data = array('on_off_btn' => '0');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    } 
    public function on_btn_offset_session_time($id){
        $this->db->where('id', $id);
        $data = array('on_off_btn' => '1');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    }
    public function off_booking_manual_btn($id){
        $this->db->where('id', $id);
        $data = array('booking_manual_btn' => '0');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    } 
    public function on_booking_manual_btn($id){
        $this->db->where('id', $id);
        $data = array('booking_manual_btn' => '1');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    } 
    public function salon_status_open($id){
        $this->db->where('id', $id);
        $data = array('salon_status' => '0');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    }
    public function salon_status_close($id){
        $this->db->where('id', $id);
        $data = array('salon_status' => '1');
        $this->db->update('tbl_booking_rules', $data);
        return $this->db->affected_rows() > 0;
    }  

    public function add_shift(){
        $data = array(
            'branch_id'             => $this->session->userdata('branch_id'),
            'salon_id'              => $this->session->userdata('salon_id'),
            'shift_name'            => $this->input->post('shift_name'),
            'shift_type'            => $this->input->post('shift_type'),
            
            'is_monday_shift'       => $this->input->post('is_monday_shift'),
            'monday_working_from'   => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_working_from') : null,
            'monday_working_to'     => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_working_to') : null,
            'monday_shift_from'     => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_shift_from') : null,
            'monday_shift_to'       => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_shift_to') : null,
            'monday_break_from'     => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_break_from') : null,
            'monday_break_to'       => ($this->input->post('is_monday_shift') == '1') ? $this->input->post('monday_break_to') : null,

            'is_tuesday_shift'      => $this->input->post('is_tuesday_shift'),
            'tuesday_working_from'  => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_working_from') : null,
            'tuesday_working_to'    => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_working_to') : null,
            'tuesday_shift_from'    => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_shift_from') : null,
            'tuesday_shift_to'      => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_shift_to') : null,
            'tuesday_break_from'    => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_break_from') : null,
            'tuesday_break_to'      => ($this->input->post('is_tuesday_shift') == '1') ? $this->input->post('tuesday_break_to') : null,
            
            'is_wednesday_shift'    => $this->input->post('is_wednesday_shift'),
            'wednesday_working_from'=> ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_working_from') : null,
            'wednesday_working_to'  => ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_working_to') : null,
            'wednesday_shift_from'  => ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_shift_from') : null,
            'wednesday_shift_to'    => ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_shift_to') : null,
            'wednesday_break_from'  => ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_break_from') : null,
            'wednesday_break_to'    => ($this->input->post('is_wednesday_shift') == '1') ? $this->input->post('wednesday_break_to') : null,
            
            'is_thursday_shift'     => $this->input->post('is_thursday_shift'),
            'thursday_working_from' => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_working_from') : null,
            'thursday_working_to'   => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_working_to') : null,
            'thursday_shift_from'   => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_shift_from') : null,
            'thursday_shift_to'     => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_shift_to') : null,
            'thursday_break_from'   => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_break_from') : null,
            'thursday_break_to'     => ($this->input->post('is_thursday_shift') == '1') ? $this->input->post('thursday_break_to') : null,
            
            'is_friday_shift'       => $this->input->post('is_friday_shift'),
            'friday_working_from'   => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_working_from') : null,
            'friday_working_to'     => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_working_to') : null,
            'friday_shift_from'     => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_shift_from') : null,
            'friday_shift_to'       => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_shift_to') : null,
            'friday_break_from'     => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_break_from') : null,
            'friday_break_to'       => ($this->input->post('is_friday_shift') == '1') ? $this->input->post('friday_break_to') : null,
            
            'is_saturday_shift'     => $this->input->post('is_saturday_shift'),
            'saturday_working_from' => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_working_from') : null,
            'saturday_working_to'   => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_working_to') : null,
            'saturday_shift_from'   => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_shift_from') : null,
            'saturday_shift_to'     => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_shift_to') : null,
            'saturday_break_from'   => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_break_from') : null,
            'saturday_break_to'     => ($this->input->post('is_saturday_shift') == '1') ? $this->input->post('saturday_break_to') : null,
            
            'is_sunday_shift'       => $this->input->post('is_sunday_shift'),
            'sunday_working_from'   => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_working_from') : null,
            'sunday_working_to'     => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_working_to') : null,
            'sunday_shift_from'     => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_shift_from') : null,
            'sunday_shift_to'       => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_shift_to') : null,
            'sunday_break_from'     => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_break_from') : null,
            'sunday_break_to'       => ($this->input->post('is_sunday_shift') == '1') ? $this->input->post('sunday_break_to') : null,
        );
        // echo'<pre>'; print_r($data); exit;
        if ($this->input->post('hidden_shift_id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_shift_master', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('hidden_shift_id'));
            $this->db->update('tbl_shift_master', $data);
            return 1;
        }
    }

    public function get_all_shift()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_shift_master');
        return $result->result();
    }

    public function get_single_shift()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(3));
        $result = $this->db->get('tbl_shift_master');
        return $result->row();
    }

    public function get_all_shifts()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_shift_master');
        return $result->result();
    }

    public function get_all_active_shifts()
    {
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_shift_master');
        return $result->result();
    }
    public function get_all_shifts_typewise($shift_type)
    {
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('shift_type', $shift_type);
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_shift_master');
        return $result->result();
    }
    public function get_saloon_shifts_typewise_ajax()
    {
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('shift_type', $this->input->post('shift_type'));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_shift_master')->result();
    
        if (!empty($result)) {
            echo json_encode($result);
        }
    }


    // For Add product category 




    public function product_category()
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'product_category' => $this->input->post('product_category'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_admin_service_category', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_admin_service_category', $data);
            return 1;
        }
    }
    public function get_all_product_category()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_admin_service_category');
        return $result->result();
    }

    public function get_single_product_category()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_admin_service_category');
        return $result->row();
    }

    public function get_unique_product_category()
    {
        $this->db->where('product_category', $this->input->post('product_category'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_admin_service_category');
        echo $result->num_rows();
    }


     // For Add product unit 




     public function product_unit()
     {
         $data = array(
             'branch_id' => $this->session->userdata('branch_id'),
             'salon_id' => $this->session->userdata('salon_id'),
             'product_unit' => $this->input->post('product_unit'),
         );
         if ($this->input->post('id') == "") {
             $date = array(
                 'created_on'    => date("Y-m-d H:i:s")
             );
             $new_arr = array_merge($data, $date);
             $this->db->insert('tbl_product_unit', $new_arr);
             return 0;
         } else {
             $this->db->where('id', $this->input->post('id'));
             $this->db->update('tbl_product_unit', $data);
             return 1;
         }
     }
     public function get_all_product_unit()
     {
         $this->db->where('is_deleted', '0');
         $this->db->where('branch_id', $this->session->userdata('branch_id'));
         $this->db->where('salon_id', $this->session->userdata('salon_id'));
         $this->db->order_by('id', 'DESC');
         $result = $this->db->get('tbl_product_unit');
         return $result->result();
     }
 
     public function get_single_product_unit()
     {
         $this->db->where('is_deleted', '0');
         $this->db->where('branch_id', $this->session->userdata('branch_id'));
         $this->db->where('salon_id', $this->session->userdata('salon_id'));
         $this->db->where('id', $this->uri->segment(2));
         $result = $this->db->get('tbl_product_unit');
         return $result->row();
     }
 
     public function get_unique_product_unit()
     {
         $this->db->where('product_unit', $this->input->post('product_unit'));
         if ($this->input->post('id') != "0") {
             $this->db->where('id !=', $this->input->post('id'));
         }
         $this->db->where('is_deleted', '0');
         $this->db->where('branch_id', $this->session->userdata('branch_id'));
         $this->db->where('salon_id', $this->session->userdata('salon_id'));
         $result = $this->db->get('tbl_product_unit');
         echo $result->num_rows();
     }
 


     
    public function get_all_products_unit()
    {
        $this->db->where('tbl_admin_product_unit.is_deleted','0'); 
        // $this->db->where('tbl_admin_product_unit.branch_id', $this->session->userdata('branch_id'));
        // $this->db->where('tbl_admin_product_unit.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_admin_product_unit.id','DESC');
		$result = $this->db->get('tbl_admin_product_unit');
		return $result->result();
    }

    // For Add Designation 




    public function add_designation()
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'designation' => $this->input->post('designation'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_emp_designation', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_emp_designation', $data);
            return 1;
        }
    }

    public function get_all_designation()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_emp_designation');
        return $result->result();
    }

    public function get_single_designation()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_emp_designation');
        return $result->row();
    }

    public function get_unique_designation()
    {
        $this->db->where('designation', $this->input->post('designation'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_emp_designation');
        echo $result->num_rows();
    }


    public function get_unique_phone()
    {
        $this->db->where('phone', $this->input->post('phone'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_student');
        echo $result->num_rows();
    }

    // For Add Product 




    public function add_product_stock()
{
    $data = array(
        'branch_id' => $this->session->userdata('branch_id'),
        'salon_id' => $this->session->userdata('salon_id'),
        'product_name' => $this->input->post('product_name'),
        'product_category' => $this->input->post('product_category'),
        'product_unit' => $this->input->post('product_unit'),
        'opening_stock' => $this->input->post('opening_stock'),
        'closing_stock' => $this->input->post('closing_stock'),
        'quantity' => $this->input->post('quantity'),
        'purchase_price' => $this->input->post('purchase_price'),
    );
    
    $data1 = array(
        'branch_id' => $this->session->userdata('branch_id'),
        'salon_id' => $this->session->userdata('salon_id'),
        'product_name' => $this->input->post('product_name'),
        'closing_stock' => $this->input->post('closing_stock'),
    );
    $l_id = $this->Salon_model->get_all_product_barcode();
    $count = count($l_id);
    $data2Array = array();
    $startCount = ($count == 0) ? 1 : $count;
    for ($i = 0; $i < $data['quantity']; $i++,$startCount++) {
        $data2 = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'product_name' => $this->input->post('product_name'),
            'barcode_id' => $this->session->userdata('salon_id') . $this->session->userdata('branch_id') .$this->input->post('product_name').$i.$startCount,
        );

        $data2Array[] = $data2;
    }
    // echo "<pre>";print_r($data2Array);exit;
    
    $this->db->where('product_name', $this->input->post('product_name'));
    $existingRow = $this->db->get('tbl_product_closing_stock')->row();

    if (!$existingRow) {
        $date = array('created_on' => date("Y-m-d H:i:s"));
        $new_arr = array_merge($data, $date);
        $new_arr1 = array_merge($data1, $date);
        $new_arr2 = array_merge($data2Array, $date);
       
        $this->db->insert('tbl_product_stock', $new_arr);
        $this->db->insert('tbl_product_closing_stock', $new_arr1);
        $this->db->insert('tbl_product_stock_history', $new_arr); 
        $this->db->insert_batch('tbl_product_barcode', $new_arr2);

        return 0; 
    } else {
        // $date = array('created_on' => date("Y-m-d H:i:s"));
        // $new_arr2 = array_merge($data2Array, $date);
        $this->db->where('product_name', $this->input->post('product_name'));
        $this->db->update('tbl_product_stock', $data);
        $this->db->where('product_name', $this->input->post('product_name'));
        $this->db->update('tbl_product_closing_stock', $data1);
        $this->db->insert('tbl_product_stock_history', $data);
        $this->db->insert_batch('tbl_product_barcode', $data2Array);
        return 1;
    }
}


    public function get_all_product()
{
    $this->db->select('tbl_product_stock.*, tbl_admin_service_category.sup_category as productcategory, tbl_product_unit.product_unit, tbl_product.product_name');
    $this->db->from('tbl_product_stock');
    $this->db->join('tbl_admin_service_category', 'tbl_product_stock.product_category = tbl_admin_service_category.id', 'left');
    $this->db->join('tbl_product_unit', 'tbl_product_stock.product_unit = tbl_product_unit.id', 'left');
    $this->db->join('tbl_product', 'tbl_product_stock.product_name = tbl_product.id', 'left');
    $this->db->where('tbl_product_stock.is_deleted', '0');
    $this->db->where('tbl_product_stock.branch_id', $this->session->userdata('branch_id'));
    $this->db->where('tbl_product_stock.salon_id', $this->session->userdata('salon_id'));
    $this->db->order_by('tbl_product_stock.id', 'DESC');
    $result = $this->db->get();

    return $result->result();
}


public function get_single_product()
{
    $this->db->where('tbl_product_stock.is_deleted', '0');
    $this->db->where('tbl_product_stock.branch_id', $this->session->userdata('branch_id'));
    $this->db->where('tbl_product_stock.salon_id', $this->session->userdata('salon_id'));
    $this->db->where('tbl_product_stock.id', $this->uri->segment(2));
    $this->db->select('tbl_product_stock.*, tbl_admin_service_category.sup_category as productcategory, tbl_product_unit.product_unit as productunit');
    $this->db->from('tbl_product_stock');
    $this->db->join('tbl_admin_service_category', 'tbl_product_stock.product_category = tbl_admin_service_category.id', 'left');
    $this->db->join('tbl_product_unit', 'tbl_product_stock.product_unit = tbl_product_unit.id', 'left');
    
    $result = $this->db->get();
    return $result->row();
}

    public function get_product_category()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_product');
        return $result->result();
    }
    public function get_product_detail_for_stock_ajax()
    {   
        $product_name = $this->input->post('product_name');
       
        $this->db->where_in('tbl_product.id', $product_name);
        $this->db->where('tbl_product.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product.salon_id', $this->session->userdata('salon_id'));
        $this->db->select('tbl_product.*, tbl_admin_service_category.sup_category as productcategory,tbl_product_unit.product_unit as productunit');
        $this->db->join('tbl_admin_service_category', 'tbl_product.product_category = tbl_admin_service_category.id', 'left');
        $this->db->join('tbl_product_unit', 'tbl_product.product_unit = tbl_product_unit.id', 'left');
    
        $result = $this->db->get('tbl_product')->row();
        
        if (!empty($result)) {
            echo json_encode($result);
        }
    }
  
    public function get_product_stock_deytails_ajax()
    {   
        $product_name = $this->input->post('product_name');
        
        $this->db->where_in('tbl_product_closing_stock.product_name', $product_name);
        $this->db->where('tbl_product_closing_stock.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product_closing_stock.salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_product_closing_stock')->row();
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(0);
        }
    
    }


    // For Add gallary 




    public function add_gallary($gallary_image)
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('sub_category'),
            'gallary_image'            => $gallary_image,
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_gallary', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_gallary', $data);
            return 1;
        }
    }
    public function set_upload_gallary_img()
    {
        $config = array();
        $config['upload_path'] = 'admin_assets/images/gallary_image/';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = true;
        return $config;
    }
    public function get_all_gallary()
    {
        $this->db->select('tbl_gallary.*, tbl_salon_service_category.sup_category,tbl_sub_category.sub_category');
        $this->db->where('tbl_gallary.is_deleted', '0');
        $this->db->join('tbl_salon_service_category', 'tbl_salon_service_category.id = tbl_gallary.category',);
        $this->db->join('tbl_sub_category', 'tbl_sub_category.id = tbl_gallary.sub_category',);
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_gallary');
        return $result->result();
    }

    public function get_single_gallary()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_gallary');
        return $result->row();
    }


    // For Add service Management 



    public function get_category()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_service_category');
        return $result->result();
    }
  
    public function get_sub_category($category)
    {
        $this->db->where_in('sup_category', $category);
        $this->db->order_by('id', 'DESC');
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_sub_category')->result();
        return $result;
    }

    public function get_third_category_options($sup_category_id, $sub_category_id)
    {
        
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('sup_category_id', $sup_category_id);
        $this->db->select('id, third_category');
        $result = $this->db->get('tbl_third_category')->result();
        return $result;
    }





    // For Add speacial service Management 



    public function add_special_service()
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'category' => $this->input->post('category'),
            'service_name' => $this->input->post('service_name'),
            'discount' => $this->input->post('discount'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_special_service', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_special_service', $data);
            return 1;
        }
    }

    public function get_all_special_service(){
		$this->db->select('tbl_special_service.*, tbl_salon_service_category.sup_category,tbl_salon_emp_service.sub_category as name_of_service');
		$this->db->from('tbl_special_service');
		$this->db->join('tbl_salon_service_category', 'tbl_special_service.category = tbl_salon_service_category.id', 'left');
		$this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_special_service.service_name', 'left');
		$this->db->where('tbl_special_service.is_deleted', '0');
		$this->db->where('tbl_special_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_special_service.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_special_service.id', 'DESC'); 
		$result = $this->db->get(); 
		return $result->result();
	}
	public function get_selected_special_cerive_by_cat($category){
		$this->db->where('category',$category);
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_salon_emp_service');
		return $result->result();
	}

    public function get_single_special_service()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_special_service');
        return $result->row();
    }

    public function get_unique_special_service()
    {
        $this->db->where('category', $this->input->post('category'));
        if ($this->input->post('id') != "0") {
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_special_service');
        echo $result->num_rows();
    }




    // For Add Salon Employee Management 



    public function add_salon_employee($identy_proof,$profile_photo)
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'full_name' => $this->input->post('name'),
            'whatsapp_number' => $this->input->post('phone_number'),
            'description' => $this->input->post('description'),
            'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
            'date_of_join' => date('Y-m-d',strtotime($this->input->post('date_of_join'))),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'gender' => $this->input->post('gender'),
            'staff_type' => $this->input->post('staff_type'),
            'identity' => $this->input->post('identity'),
            // 'identity_number' => $this->input->post('identity_number'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'account_number' => $this->input->post('account_number'),
            // 'account_type' => $this->input->post('account_type'),
            // 'bank_branch_name' => $this->input->post('bank_branch_name'),
            'ifsc' => $this->input->post('ifsc'),
            // 'designation' => $this->input->post('designation'),
            'service_name' 					=> implode(',', $this->input->post('service_name')),
            'salary' => $this->input->post('salary'),
            'bank_name' => $this->input->post('bank_name'),
            'identy_proof' => $identy_proof,
            'profile_photo' => $profile_photo,
            
            'shift' => $this->input->post('shift'),
            'shift_type' => $this->input->post('shift_type'),
            'salary_method' => $this->input->post('salary_method'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_employee', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_employee', $data);
            return 1;
        }
    }

    public function get_all_salon_customer()
    {       
        $this->db->where('tbl_salon_customer.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_customer.is_deleted', '0');
        $this->db->order_by('tbl_salon_customer.id', 'DESC');
        $result = $this->db->get('tbl_salon_customer');
        return $result->result();
    }
    public function get_all_salon_services()
    {       
        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
        $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result();
    }
    public function get_all_salon_stylists()
    {       
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_employee.is_deleted', '0');
        $this->db->order_by('tbl_salon_employee.id', 'DESC');
        $result = $this->db->get('tbl_salon_employee');
        return $result->result();
    }

    public function get_all_salon_employee()
    {       
        $this->db->select('tbl_salon_employee.*,tbl_shift_master.shift_name as shift_names,tbl_salon_emp_service.service_name as service_names');
       
        $this->db->select('GROUP_CONCAT(tbl_salon_emp_service.service_name) as service_names', false);
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_employee.is_deleted', '0');
        $this->db->select('tbl_salon_employee.*, tbl_emp_designation .designation');
		$this->db->join('tbl_emp_designation', 'tbl_salon_employee.designation = tbl_emp_designation.id', 'left');
		$this->db->join('tbl_shift_master', 'tbl_shift_master.id = tbl_salon_employee.shift', 'left');
		// $this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_salon_employee.service_name', 'left');
        $this->db->join('tbl_salon_emp_service', 'FIND_IN_SET(tbl_salon_emp_service.id, tbl_salon_employee.service_name)', 'left'); // Join and find service names based on IDs
        $this->db->group_by('tbl_salon_employee.id'); 
	
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_employee');
        return $result->result();

    }
    public function get_all_salon_employee_bookingwise()
    {       
        // Get today's date
        $today_date = date('Y-m-d');

        // Select the necessary columns and join with tbl_emp_designation
        $this->db->select('tbl_salon_employee.*, tbl_emp_designation.designation');
        $this->db->join('tbl_emp_designation', 'tbl_salon_employee.designation = tbl_emp_designation.id', 'left');

        // Filter based on branch, salon, and not deleted
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_employee.is_deleted', '0');

        // Order by id in descending order
        $this->db->order_by('id', 'DESC');

        // Get all salon employees
        $salon_employees = $this->db->get('tbl_salon_employee')->result();

        // Initialize an array to store the sorted employees
        $sorted_employees = array();

        // Loop through each salon employee
        foreach ($salon_employees as $employee) {
            // Count the number of services for the stylist for today's date
            $this->db->where('stylist_id', $employee->id);
            $this->db->where('service_date', $today_date);
            $services_count = $this->db->count_all_results('tbl_booking_services_details');

            // Add the count as a new property to the employee object
            $employee->services_count_today = $services_count;

            // Add the employee to the sorted array
            $sorted_employees[$employee->id] = $employee;
        }

        // Sort the array based on the services count for today in descending order
        usort($sorted_employees, function($a, $b) {
            return $b->services_count_today - $a->services_count_today;
        });

        return $sorted_employees;
    }


    public function get_single_salon_employee()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_salon_employee');
        return $result->row();
    }

    public function get_shift()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_shift_master');
        return $result->result();
    }
    public function get_designation()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_emp_designation');
        return $result->result();
    }



     // For Add Membership Management 



     public function add_membership(){
		$data = array(
			'branch_id' 		=> $this->session->userdata('branch_id'),
			'salon_id' 			=> $this->session->userdata('salon_id'),
			'membership_id' 	=> $this->input->post('membership_id'),
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
        // echo "<pre>";print_r($data);exit;
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_memebership', $new_arr);
            return 0;
         }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_memebership', $data);
            return 1;
        }
    } 

    public function get_all_memebership(){
		$this->db->where('is_deleted', '0');
        $this->db->where('status','1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_memebership');
		return $result->result();
	} 
     
     
     
     
     
    public function get_single_memebership(){
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_memebership');
		return $result->row();
	}


    // For Add Package Management 



    

   
  


    // for customer discount
    public function add_customer_discount()
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'days' => $this->input->post('days'),
            'discount' => $this->input->post('discount'),
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_discount_master', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_discount_master', $data);
            return 1;
        }
    }

    public function get_all_discount()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_discount_master');
        return $result->result();
    }

    public function get_single_discount()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_discount_master');
        return $result->row();
    } 

    public function add_facilities($facilities_image)
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'facilities_name' => $this->input->post('facilities_name'),
            'facilities_image' => $facilities_image,
        );
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_facilities', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_facilities', $data);
            return 1;
        }
    }

    public function get_all_facilities()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_facilities');
        return $result->result();
    }

    public function get_single_facilities(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_salon_facilities');
        return $result->row();
    }



    // For Add course 



    public function add_course(){
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'course_name' => $this->input->post('course_name'),
            'service' => implode(',',$this->input->post('service')),
            // 'time' => $this->input->post('time'),
            'fees_amount' => $this->input->post('fees_amount'),
            'duration' => $this->input->post('duration'),
            'holiday' => implode(',',$this->input->post('holiday')),
        );
        
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_course_master', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_course_master', $data);
            return 1;
        }
    }
	public function get_saloon_services(){ 
		$this->db->where_in("is_deleted",'0');
		$result = $this->db->get('tbl_salon_service_category');
		return $result->result();
	}
	public function get_selected_services($service_id){
		$exp = explode(",",$service_id);
		$this->db->where_in("id",$exp);
		$result = $this->db->get('tbl_salon_service_category');
		return $result->result();
	}
    public function get_all_course()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_course_master');
        return $result->result();
    }


    public function get_single_course()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_course_master');
        return $result->row();
    }





    // For Add reward points 



    public function set_reward_point(){
		$data = array(
            'branch_id' 				=> $this->session->userdata('branch_id'),
            'salon_id' 					=> $this->session->userdata('salon_id'),
            'reward_id' 				=> $this->input->post('reward_id'),
            'rs_per_reward' 			=> $this->input->post('rs_per_reward'),
            'reward_point' 				=> $this->input->post('reward_point'),
            'gender'		 			=> $this->input->post('gender'),
            'minimum_reward_required'	=> $this->input->post('minimum_reward_required'),
            'maximum_reward_required'	=> $this->input->post('maximum_reward_required'), 
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_reward_point', $new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_reward_point', $data);
            return 1;
        }
    } 
    public function get_ready_reward_point(){
        $this->db->where('is_deleted','0');  
        $this->db->where('status','1');  
        $result = $this->db->get('tbl_admin_reward_point');
        return $result->result();
    }
    public function get_single_ready_reward_point(){
        $this->db->where('is_deleted','0');   
        $this->db->where('id',$_GET['value']);  
        $result = $this->db->get('tbl_admin_reward_point');
        return $result->row();
    }
    public function get_all_reward_point(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_reward_point');
        return $result->result();
    }

    public function get_single_reward_point(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id',$_GET['edit']);
        $result = $this->db->get('tbl_reward_point');
        return $result->row();
    }


    public function check_reward_point_ajax()
    {
        $gender = $this->input->post('gender');
        $this->db->where('gender', $gender);
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_reward_point')->row();
    
        if (!empty($result)) {
            echo json_encode($result);
        }
    }



    // For Add Student mangement 



    // public function add_student()
    // {
    //     $student_name = $this->input->post('student_name');
    //     $existing_student = $this->db->get_where('tbl_student', array('student_name' => $student_name))->row();
    //     $data = array(
    //         'branch_id'             => $this->session->userdata('branch_id'),
    //         'salon_id'              => $this->session->userdata('salon_id'),
    //         'phone'                 => $this->input->post('phone'),
    //         'description'           => $this->input->post('description'),
    //         'address'               => $this->input->post('address'),
    //         'course_name'           => $this->input->post('course_name'),
    //         'fees_amount'           => $this->input->post('fees_amount'),
    //         'duration'              => $this->input->post('duration'),
    //         'email'                 => $this->input->post('email'),
    //         'dob'                   => $this->input->post('dob'),
    //         'add_date'              => $this->input->post('add_date'),
    //         'gender'                => $this->input->post('gender'),
    //     );
    
    //     if (empty($existing_student)) {
    //         $data['student_name'] = $student_name;
    //         $date = array('created_on' => date("Y-m-d H:i:s"));
    //         $new_arr = array_merge($data, $date);
    //         $this->db->insert('tbl_student', $new_arr);
    //         return 0;
    //     } else {
    //         $this->db->where('id', $existing_student->id);
    //         $this->db->update('tbl_student', $data);
    //         return 1; 
    //     }
    // }

    public function add_student()
    {
        // echo "<pre>";print_r($this->input->post('old_student_id'));exit;
        $data = array(
            'branch_id'             => $this->session->userdata('branch_id'),
            'salon_id'              => $this->session->userdata('salon_id'),
            'phone'                 => $this->input->post('phone'),
            'student_name'          => $this->input->post('student_name'),
            'description'           => $this->input->post('description'),
            'address'               => $this->input->post('address'),
            'fees_amount'           => $this->input->post('fees_amount'),
            'duration'              => $this->input->post('duration'),
            'email'                 => $this->input->post('email'),
            'dob'                   => $this->input->post('dob'),
            'add_date'              => $this->input->post('add_date'),
            'gender'                => $this->input->post('gender'),
        );
        // echo "<pre>";print_r($data);exit;
        if ($this->input->post('old_student_id') == "") {
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_student', $new_arr);
            $student_id = $this->db->insert_id();
        }else{
            $this->db->where('id', $this->input->post('old_student_id'));
            $this->db->update('tbl_student', $data);
            $student_id = $this->input->post('old_student_id');
        }

        $course_data = array(
            'branch_id'           => $this->session->userdata('branch_id'),
            'salon_id'            => $this->session->userdata('salon_id'),
            'total_fees'          => $this->input->post('fees_amount'),
            'course_name'         => $this->input->post('course_name'),
            'student_name'        => $student_id,
            'created_on'          => date("Y-m-d H:i:s"),
        );
        $this->db->insert('tbl_payment_entry',$course_data);
        $this->session->set_flashdata('success', 'Success ! Record added successfully');
        redirect('student-list');
    }

    public function update_student()
    {
        $data = array(
            'branch_id'             => $this->session->userdata('branch_id'),
            'salon_id'              => $this->session->userdata('salon_id'),
            'phone'                 => $this->input->post('phone'),
            'student_name'          => $this->input->post('student_name'),
            'description'           => $this->input->post('description'),
            'address'               => $this->input->post('address'),
            'email'                 => $this->input->post('email'),
            'dob'                   => $this->input->post('dob'),
            'add_date'              => $this->input->post('add_date'),
            'gender'                => $this->input->post('gender'),
        );
        if ($this->input->post('old_student_id') == "") {
            $date = array('created_on' => date("Y-m-d H:i:s"));
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_student', $new_arr);
            $student_id = $this->db->insert_id();
        }else{
            $this->db->where('id', $this->input->post('old_student_id'));
            $this->db->update('tbl_student', $data);
            $student_id = $this->input->post('old_student_id');
        }
        $this->session->set_flashdata('success', 'Success ! Record added successfully');
        redirect('payment-entry/' . $student_id);
    }


    // public function get_all_student()
    // {
    //     $this->db->select('tbl_student.*, tbl_course_master.course_name,tbl_payment_entry.course_name as c_name,payment_entry.course_name as test');
    //     $this->db->from('tbl_student');
    //     $this->db->join('tbl_course_master', 'tbl_student.id = tbl_course_master.id', 'left');
    //     $this->db->join('tbl_payment_entry','tbl_payment_entry.id = tbl_student.id','left');
    //     $this->db->join('tbl_payment_entry as payment_entry','payment_entry.id = tbl_course_master.course_name','left');
    //     $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('tbl_student.is_deleted', '0');
    //     $this->db->order_by('tbl_student.id', 'DESC');
    //     $result = $this->db->get();
    //     return $result->result();
    // }


public function get_all_student()
{
    $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    $this->db->where('tbl_student.is_deleted', '0');
    $this->db->order_by('tbl_student.id', 'DESC');
    $result = $this->db->get('tbl_student');
    return $result->result();
}


    public function get_all_fees_history()
    {
        $this->db->where('is_deleted', '0');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_student');
        return $result->result();
    }

    public function get_single_student()
    {
        $this->db->select('tbl_student.*, 
                       tbl_payment_entry.course_name as payment_course_name,
                       tbl_course_master.course_name as master_course_name,tbl_payment_entry.total_fees');
        $this->db->join('tbl_payment_entry', 'tbl_payment_entry.student_name = tbl_student.id', 'left');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
        $this->db->where('tbl_student.is_deleted', '0');
        $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_student.id', $this->uri->segment(2));
        $result = $this->db->get('tbl_student');
        return $result->row();
    }
    public function get_course()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_course_master');
        return $result->result();
    }


    // public function get_course()
    // {
    //     $this->db->select('tbl_student.*, 
    //     tbl_payment_entry.course_name as payment_course_name,
    //     tbl_course_master.course_name as master_course_name');

    //     $this->db->join('tbl_payment_entry', 'tbl_payment_entry.student_name = tbl_student.id', 'left');
    //     $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');

    //     $this->db->where('tbl_student.is_deleted', '0');
    //     $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    //     $result = $this->db->get('tbl_student');
    //     return $result->result();
    // }



  



    // public function get_fees_history_all_student()
    // {
    //     $this->db->select('tbl_fees_history.*, tbl_student.student_name');
    //     $this->db->from('tbl_fees_history');
    //     $this->db->join('tbl_student', 'tbl_fees_history.student_name = tbl_student.id', 'left');
    //     $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('tbl_fees_history.is_deleted', '0');
    //     $this->db->order_by('tbl_fees_history.id', 'DESC');
        
    //     $result = $this->db->get();
    //     return $result->result();
    // }

    public function get_fees_history_all_student($id)
    {
        $this->db->select('tbl_fees_history.*, tbl_course_master.course_name');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_fees_history.course_name', 'left');
        $this->db->where('tbl_fees_history.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_fees_history.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_fees_history.payment_entry_id', $id);
        $this->db->where('tbl_fees_history.is_deleted', '0');
        $this->db->order_by('tbl_fees_history.id', 'DESC');
        $result = $this->db->get('tbl_fees_history');
        return $result->result();
    }
    
    // public function get_payment_history_by_student_id($id)
    // {
    //     // $this->db->where('tbl_payment_entry.student_name', $student_name);
    //     $this->db->where('tbl_payment_entry.student_name', $id);
    //     $this->db->where('tbl_payment_entry.is_deleted', '0');
    //     $this->db->order_by('date', 'DESC');
    //     $result = $this->db->get('tbl_payment_entry');
    //     return $result->result();
    // }


     public function get_payment_history_by_student_id()
    {
        $this->db->select('tbl_payment_entry.*,tbl_student.student_name,tbl_course_master.course_name,tbl_student.phone as mobile_number');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
        $this->db->join('tbl_student', 'tbl_student.id = tbl_payment_entry.student_name', 'left');
        $this->db->where('tbl_payment_entry.is_deleted', '0');
        $this->db->order_by('tbl_payment_entry.id', 'DESC');
        $result = $this->db->get('tbl_payment_entry');
        return $result->result();
    }


    // public function get_student_fees_history($student_id)
    // {
    //     $this->db->select('tbl_student.*, tbl_course_master.course_name, tbl_payment_entry.total_paid_fees, tbl_payment_entry.total_pending_fees');
    //     $this->db->from('tbl_student');
    //     $this->db->join('tbl_course_master', 'tbl_student.id = tbl_course_master.id', 'left');
    //     $this->db->join('tbl_payment_entry', 'tbl_student.id = tbl_payment_entry.student_name', 'left');
    //     $this->db->where('tbl_student.id', $student_id);
    //     $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('tbl_student.is_deleted', '0');
    //     $this->db->order_by('tbl_student.id', 'DESC');
    //     $result = $this->db->get();

    //     return $result->result();
    // }


    


    // public function get_student_fees_history($student_id)
    // {
    //     $this->db->select('tbl_payment_entry.*, tbl_student.student_name,tbl_course_master.course_name,tbl_fees_history.total_paid_fees,tbl_fees_history.total_pending_fees,tbl_fees_history.amount_to_paid');
    //     $this->db->join('tbl_student','tbl_payment_entry.student_name = tbl_student.id', 'left');
    //     $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
    //     $this->db->join('tbl_fees_history', 'tbl_fees_history.course_name = tbl_payment_entry.course_name', 'left');
    //     $this->db->where('tbl_payment_entry.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_payment_entry.salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('tbl_payment_entry.student_name', $student_id);
    //     $this->db->where('tbl_payment_entry.is_deleted', '0');
    //     $this->db->order_by('tbl_payment_entry.id', 'DESC');
    //     $result = $this->db->get('tbl_payment_entry');
    //     return $result->result();
    // }

    public function get_student_fees_history($student_id)
    {
        $this->db->select('tbl_fees_history.*, tbl_student.student_name,tbl_course_master.course_name');
        $this->db->join('tbl_student','tbl_student.id = tbl_fees_history.student_name', 'left');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_fees_history.course_name', 'left');
        $this->db->where('tbl_fees_history.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_fees_history.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_fees_history.student_name', $student_id);
        $this->db->where('tbl_fees_history.is_deleted', '0');
        $this->db->order_by('tbl_fees_history.id', 'DESC');
        $result = $this->db->get('tbl_fees_history');
        return $result->result();
    }

    public function get_unique_student_name($student_id){
        $this->db->where('tbl_student.id', $student_id);
        $this->db->where('tbl_student.is_deleted', '0');
        $this->db->order_by('tbl_student.id', 'DESC');
        $result = $this->db->get('tbl_student');
        return $result->row();
    }
    
    // For Payment mangement 



    // public function payment_entry($attachment_file)
    // {
    //     $this->db->where('payment_entry_id',$this->input->post('id'));
	// 	$exist = $this->db->get('tbl_fees_history');
	// 	$exist = $exist->row();
    //     // echo "<pre>";print_r($exist);exit;
    //     if(empty($exist)){
    //     $data = array(
    //         'branch_id'             => $this->session->userdata('branch_id'),
    //         'salon_id'              => $this->session->userdata('salon_id'),
    //         'student_name'          => $this->input->post('student_name'),
    //         'course_name'           => explode('@@@',$this->input->post('course_name'))[0],
    //         'payment_entry_id'      => explode('@@@',$this->input->post('course_name'))[1],
    //         'total_fees'            => $this->input->post('total_fees'),
    //         'total_paid_fees'       => 0,
    //         'total_pending_fees'    => $this->input->post('total_pending_fees'),
    //         'amount_to_paid'        => $this->input->post('amount_to_paid'),
    //         'date'                  => $this->input->post('date'),
    //         'payment_mode'          => $this->input->post('payment_mode'),
    //         'remark'                => $this->input->post('remark'),
    //         'attachment_file'       => $attachment_file,
    //         'created_on' 		    => date("Y-m-d H:i:s"),
    //     );
    //     // if ($this->input->post('payment_id') == "") {
    //     //     $date = array(
    //     //         'created_on'    => date("Y-m-d H:i:s")
    //     //     );
    //     //     $new_arr = array_merge($data, $date);
    //     //     $this->db->insert('tbl_payment_entry', $new_arr);
    //     //     $last_id = $this->db->insert_id();
    //     // } else {
    //     //     $this->db->where('id', $this->input->post('payment_id'));
    //     //     $this->db->update('tbl_payment_entry', $data); 
    //     //     $last_id = $this->db->insert_id();
    //     //     $this->session->set_flashdata('success', 'Success ! Record updated successfully');
    //     //     redirect('fees-history/' . $this->input->post('payment_id'));
    //     // }

    //         $this->db->insert('tbl_fees_history', $data);
    //         $this->session->set_flashdata('success', 'Success ! Record added successfully');
    //         redirect('payment-history');
    //     }else{
    //         $data = array(
    //             'branch_id'             => $this->session->userdata('branch_id'),
    //             'salon_id'              => $this->session->userdata('salon_id'),
    //             'student_name'          => $this->input->post('student_name'),
    //             'course_name'           => explode('@@@',$this->input->post('course_name'))[0],
    //             'payment_entry_id'      => explode('@@@',$this->input->post('course_name'))[1],
    //             'total_fees'            => $this->input->post('total_fees'),
    //             'total_paid_fees'       => $this->input->post('total_paid_fees')+$this->input->post('amount_to_paid'),
    //             'total_pending_fees'    => $this->input->post('total_fees')-$this->input->post('total_pending_fees'),
    //             'amount_to_paid'        => $this->input->post('amount_to_paid'),
    //             'date'                  => $this->input->post('date'),
    //             'payment_mode'          => $this->input->post('payment_mode'),
    //             'remark'                => $this->input->post('remark'),
    //             'attachment_file'       => $attachment_file,
    //             'created_on' 		    => date("Y-m-d H:i:s"),
    //         );
    //         $this->db->insert('tbl_fees_history', $exist->id);
    //         $this->session->set_flashdata('success', 'Success ! Record added successfully');
    //         redirect('payment-history');
    //     }
    // }




    public function payment_entry($attachment_file)
    {
        $data = array(
            'branch_id'             => $this->session->userdata('branch_id'),
            'salon_id'              => $this->session->userdata('salon_id'),
            'student_name'          => $this->input->post('student_name'),
            'course_name'           => explode('@@@',$this->input->post('course_name'))[0],
            'payment_entry_id'      => explode('@@@',$this->input->post('course_name'))[1],
            'total_fees'            => $this->input->post('total_fees'),
            'total_paid_fees'       => $this->input->post('total_paid_fees'),
            'total_pending_fees'    => $this->input->post('total_pending_fees'),
            'amount_to_paid'        => $this->input->post('amount_to_paid'),
            'date'                  => $this->input->post('date'),
            'payment_mode'          => $this->input->post('payment_mode'),
            'remark'                => $this->input->post('remark'),
            'attachment_file'       => $attachment_file,
        );
        if ($this->input->post('payment_id') == "") {
            $history_data = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_array_data = array_merge($data, $history_data);
            $this->db->insert('tbl_fees_history', $new_array_data);
            $this->session->set_flashdata('success', 'Success ! Record added successfully');
            redirect('payment-history');
        } 
    }

    public function get_all_payment_entry()
    {
        $this->db->select('tbl_payment_entry.*, tbl_student.student_name');
        $this->db->select('tbl_payment_entry.*, tbl_course_master.course_name');
        $this->db->from('tbl_payment_entry');
        $this->db->join('tbl_student', 'tbl_payment_entry.id = tbl_student.id', 'left');
        $this->db->join('tbl_course_master', 'tbl_payment_entry.id = tbl_course_master.id', 'left');
        $this->db->where('tbl_payment_entry.is_deleted', '0');
        $this->db->order_by('tbl_payment_entry.id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_single_payment_entry()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_payment_entry');
        return $result->row();
    }

    public function get_student_name()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_student');
        return $result->result();
    }
    public function get_course_detail($course_name_id)
    {
        $this->db->where('id', $course_name_id);
        $result = $this->db->get('tbl_course_master')->row();
        $data = array();
        if (!empty($result)) {
            $data['fees_amount'] = $result->fees_amount;
            $data['duration'] = $result->duration;
        }
        return $data;
    }
    // public function get_course_fees($id)
    // {
    //     $this->db->where('is_deleted', '0');
    //     $this->db->where('branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('id', $id);
    //     $result = $this->db->get('tbl_course_master');
    //     return $result->row();
    // }


    // public function get_course_fees($id)
    // {
    //     $this->db->select('tbl_student.*, 
    //     tbl_payment_entry.course_name as payment_course_name,
    //     tbl_course_master.course_name as master_course_name');
    //     $this->db->join('tbl_payment_entry', 'tbl_payment_entry.student_name = tbl_student.id', 'left');
    //     $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
    //     $this->db->where('tbl_student.is_deleted', '0');
    //     $this->db->where('tbl_student.branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('tbl_student.salon_id', $this->session->userdata('salon_id'));
    //     $this->db->where('tbl_student.id', $id);
    //     $result = $this->db->get('tbl_student');
    //     return $result->row();
    // }


    public function get_course_fees($id)
    {
        $this->db->select('tbl_payment_entry.*, 
        tbl_student.student_name as payment_student_name,
        tbl_course_master.course_name as master_course_name');
        $this->db->join('tbl_student', 'tbl_student.id = tbl_payment_entry.student_name', 'left');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
        $this->db->where('tbl_payment_entry.is_deleted', '0');
        $this->db->where('tbl_payment_entry.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_payment_entry.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_payment_entry.student_name', $id);
        $result = $this->db->get('tbl_payment_entry');
        return $result->result();
    }


   
    public function get_old_course_name($old_course_name){
        $this->db->where('id', $old_course_name->course_name);
		$result = $this->db->get('tbl_course_master');
		return $result->row();
    }





    // For sallary Slip
    public function set_salary_slip()
    {

        if ($this->input->post('loan_deduct') == 'Yes') {
            $deduct_amt = $this->input->post('deduct_amt');
        } else if ($this->input->post('loan_deduct') == 'No') {
            $deduct_amt = '0';
        } else {
            $deduct_amt = '0';
        }

        $this->db->where('id', $this->input->post('staff'));
        $this->db->where('is_deleted', '0');
        $result = $this->db->get(' tbl_salon_employee');
        $result = $result->row();
        $basic_pay = 0;
        $paid_amt = 0;
        if (!empty($result)) {
            $basic_pay = $result->salary;
            $per_day_amt = $result->salary / 30;
            $total_full_days_amt = $per_day_amt * $this->input->post('present_days');
            $total_half_days_amt = ($per_day_amt / 2) * $this->input->post('half_days');
            $paid_amt = $total_full_days_amt + $total_half_days_amt - $deduct_amt;
        }
        $data = array(
            'emp_id'             => $this->input->post('staff'),
            'from_date'         => date("Y-m-d", strtotime($this->input->post('from_date'))),
            'to_date'             => date("Y-m-d", strtotime($this->input->post('to_date'))),
            'half_days'         => $this->input->post('half_days'),
            'absent_days'         => $this->input->post('absent_days'),
            'payed_date'         => date("Y-m-d", strtotime($this->input->post('payed_date'))),
            'remark'             => $this->input->post('remark'),
            'basic_pay'         => $basic_pay,
            'paid_amt'             => $paid_amt,
            'present_days'         => $this->input->post('present_days'),
            'loan_deduction_amount' => $deduct_amt,
            'created_on'     => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_salon_emp_salary_slip', $data);
        $salary_slip_id = $this->db->insert_id();

        if ($this->input->post('loan_deduct') == 'Yes') {
            $loan = array(
                "staff_id"            => $this->input->post('staff'),
                "loan_amount"        => '0',
                "return_amount"        => $deduct_amt,
                "date"                => date("Y-m-d"),
                "remark"            => 'Deducted from salary.',
            );
            $this->db->insert('tbl_staff_account', $loan);
        }

        $templateid = "1707169641514078983";
        $message = 'Dear ' . $result->full_name . ',%0a%0aWe are pleased to inform you that your salary ' . date("Y-m-d", strtotime($this->input->post('from_date'))) . ' to ' . date("Y-m-d", strtotime($this->input->post('to_date'))) . 'has been successfully generated and amounts to ' . $paid_amt . '%0a%0aIt is now ready for disbursement.%0a%0aRegards,%0aSaurabh Travels';
        $whatsapp_number = $result->whatsapp_number;

        // $this->send_sms_sautra($templateid,$message,$whatsapp_number);

        $sms = array(
            'sms_type'            => 'Staff Salary Generation SMS',
            'sms_sent_to'        => '2',
            'sms_receiver_id'    => $result->id,
            // 'whatsapp_number'		=> $whatsapp_number,
            'sms'                => $message,
            'created_on'         => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_sms_send_log', $sms);

        $staff_sms = array(
            'sms_type'        => 'Staff Salary Generation SMS',
            'staff_id'        => $result->id,
            'created_on'     => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_staff_sms_send_log', $staff_sms);

        return $salary_slip_id;
    }
    public function get_field_executive_attendance_ajx()
    {
        $this->db->where('emp_id', $this->input->post('staff_id'));
        $this->db->where('MONTH(att_date)', $this->input->post('salary_month'));
        $this->db->where('YEAR(att_date)', $this->input->post('salary_year'));
        $this->db->where('is_deleted', '0');
        $result = $this->db->get('tbl_salon_emp_attendance');
        $result = $result->num_rows();
        echo $result;
    }
    public function get_employee_present_days_ajx()
    {
        $this->db->where('emp_id', $this->input->post('staff_id'));
        $this->db->where('att_date >=', date("Y-m-d", strtotime($this->input->post('from_date'))));
        $this->db->where('att_date <=', date("Y-m-d", strtotime($this->input->post('to_date'))));
        $this->db->where('is_deleted', '0');
        $this->db->where('attendence_type', '1');
        $result = $this->db->get('tbl_salon_emp_attendance');
        $result = $result->num_rows();
        echo $result;
    }
    public function get_employee_half_days_ajx()
    {
        $this->db->where('emp_id', $this->input->post('staff_id'));
        $this->db->where('att_date >=', date("Y-m-d", strtotime($this->input->post('from_date'))));
        $this->db->where('att_date <=', date("Y-m-d", strtotime($this->input->post('to_date'))));
        $this->db->where('is_deleted', '0');
        $this->db->where('attendence_type', '3');
        $result = $this->db->get('tbl_salon_emp_attendance');
        $result = $result->num_rows();
        echo $result;
    }
    public function get_employee_absent_days_ajx()
    {
        $att_type = [1, 3];
        $this->db->where('emp_id', $this->input->post('staff_id'));
        $this->db->where('att_date >=', date("Y-m-d", strtotime($this->input->post('from_date'))));
        $this->db->where('att_date <=', date("Y-m-d", strtotime($this->input->post('to_date'))));
        $this->db->where('is_deleted', '0');
        $this->db->where_in('attendence_type', $att_type);
        $result = $this->db->get('tbl_salon_emp_attendance');
        $result = $result->num_rows();

        $datetime1 = new DateTime(date("Y-m-d", strtotime($this->input->post('from_date'))));
        $datetime2 = new DateTime(date("Y-m-d", strtotime($this->input->post('to_date'))));

        $interval = $datetime1->diff($datetime2);

        $total_months_days = $interval->days;
        $absent_days = $total_months_days - $result;
        echo $absent_days;
    }
    public function get_employee_total_loan_ajx()
    {
        $this->db->where('staff_id', $this->input->post('staff_id'));
        $this->db->where('is_deleted', '0');
        $result = $this->db->get('tbl_staff_account');
        $result = $result->result();
        $total_balance = 0;
        if (!empty($result)) {
            $total_loan_amt = 0;
            $total_return_amt = 0;
            foreach ($result as $result_amount) {
                $total_loan_amt += $result_amount->loan_amount;
                $total_return_amt += $result_amount->return_amount;
            }
            $total_balance = $total_loan_amt - $total_return_amt;
        }
        echo $total_balance;
    }

    public function get_already_generated_field_exe_slip_ajx()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('emp_id', $this->input->post('staff_id'));
        $this->db->where('from_date >=', date("Y-m-d", strtotime($this->input->post('from_date'))));
        $this->db->where('to_date <=', date("Y-m-d", strtotime($this->input->post('to_date'))));
        $result = $this->db->get('tbl_salon_emp_salary_slip');
        $result = $result->num_rows();
        echo json_encode($result);
    }

    public function get_all_staff_salary_slip($length, $start, $search)
    {
        $this->db->select('tbl_salon_emp_salary_slip.*,  tbl_salon_employee.full_name');
        $this->db->where('tbl_salon_emp_salary_slip.is_deleted', '0');
        if ($this->input->post('staff') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.emp_id', $this->input->post('staff'));
        }
        if ($this->input->post('from_date') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.from_date', date("Y-m-d", strtotime($this->input->post('from_date'))));
        }
        if ($this->input->post('to_date') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.to_date', date("Y-m-d", strtotime($this->input->post('to_date'))));
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->or_like(' tbl_salon_employee.full_name', $search);
            $this->db->or_like('tbl_salon_emp_salary_slip.salaried_month', $search);
            $this->db->or_like('tbl_salon_emp_salary_slip.salaried_year', $search);
            $this->db->group_end();
        }
        $this->db->join(' tbl_salon_employee', ' tbl_salon_employee.id = tbl_salon_emp_salary_slip.emp_id');
        $this->db->order_by('tbl_salon_emp_salary_slip.id', 'DESC');
        $this->db->limit($length, $start);
        $result = $this->db->get('tbl_salon_emp_salary_slip');
        return $result->result();
    }
    public function get_all_staff_salary_slip_count($search)
    {
        $this->db->select('tbl_salon_emp_salary_slip.*,  tbl_salon_employee.full_name');
        $this->db->where('tbl_salon_emp_salary_slip.is_deleted', '0');
        if ($this->input->post('staff') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.emp_id', $this->input->post('staff'));
        }
        if ($this->input->post('from_date') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.from_date', date("Y-m-d", strtotime($this->input->post('from_date'))));
        }
        if ($this->input->post('to_date') != "") {
            $this->db->where('tbl_salon_emp_salary_slip.to_date', date("Y-m-d", strtotime($this->input->post('to_date'))));
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->or_like(' tbl_salon_employee.full_name', $search);
            $this->db->or_like('tbl_salon_emp_salary_slip.salaried_month', $search);
            $this->db->or_like('tbl_salon_emp_salary_slip.salaried_year', $search);
            $this->db->group_end();
        }
        $this->db->join(' tbl_salon_employee', ' tbl_salon_employee.id = tbl_salon_emp_salary_slip.emp_id');
        $this->db->order_by('tbl_salon_emp_salary_slip.id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_salary_slip');
        return $result->num_rows();
    }


    public function get_attendance($day, $month, $year, $student_id)
    {
        $day = $day;
        $this->db->where('student_id', $student_id);
        $this->db->where('Year(att_date)', $year);
        $this->db->where('Month(att_date)', $month);
        $this->db->where('Day(att_date)', $day);
        $this->db->where('attendence_type', '1');
        $result = $this->db->get('tbl_student_attendance');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return 0;
        }
    }

    public function get_all_active_staff()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $result = $this->db->get('tbl_salon_employee');
        $result = $result->result();
        return $result;
    }

    public function get_salary_slip_details()
    {
        $this->db->select('tbl_salon_emp_salary_slip.*,  tbl_salon_employee.full_name,  tbl_salon_employee.whatsapp_number,  tbl_salon_employee.email');
        $this->db->where('tbl_salon_emp_salary_slip.id', $this->uri->segment(2));
        $this->db->where('tbl_salon_emp_salary_slip.is_deleted', '0');
        $this->db->join(' tbl_salon_employee', ' tbl_salon_employee.id = tbl_salon_emp_salary_slip.emp_id');
        $result = $this->db->get('tbl_salon_emp_salary_slip');
        return $result->row();
    }
    public function get_single_student1()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_student');
        $result = $result->row();
        return $result;
    }

    



    // for staff_attendance
    


    public function set_staff_attendance()
    {
        $staff_array = $this->input->post('staff_id_array');
        $exploded_array = explode(',', $staff_array[0]);
        $staff = count($exploded_array);

        // echo "<pre>";print_r($exploded_array);exit;

        for ($i = 0; $i < $staff; $i++) {
                    $this->db->where('id', $exploded_array[$i]);
                    $result = $this->db->get(' tbl_salon_employee');
                    $result_staff = $result->row();
                   

                    if (!empty($result_staff)) {
                        if ($this->input->post('attendence_' . $exploded_array[$i]) != '') {
                            $emp_att = $this->get_employee_attendance_type($exploded_array[$i], $this->input->post('attendance_date'));
                            if (!empty($emp_att)) {
                                if ($emp_att->attendence_type != $this->input->post('attendence_' . $exploded_array[$i])) {
                                    $data = array(
                                        'emp_id'             => $exploded_array[$i],
                                        'attendence_type'     => $this->input->post('attendence_' . $exploded_array[$i]),
                                        'att_date'             => date("Y-m-d", strtotime($this->input->post('attendance_date'))),
                                    );
                                    $this->db->where('id', $emp_att->id);
                                    $this->db->update('tbl_salon_emp_attendance', $data);
                                }
                            } else {
                                
                                $data = array(
                                    'emp_id'             => $exploded_array[$i],
                                    'branch_id'          => $this->session->userdata('branch_id'),
                                    'salon_id'           => $this->session->userdata('salon_id'),
                                    'attendence_type'    => $this->input->post('attendence_' . $exploded_array[$i]),
                                    'shift_name'         => $this->input->post('shift_name'),
                                    'att_date'           => date("Y-m-d", strtotime($this->input->post('attendance_date'))),
                                    'created_on'         => date('Y-m-d H:i:s'),
                                );
                                $this->db->insert('tbl_salon_emp_attendance', $data);
                            }
                        }
                    }
                 
        }
        return true;
    }
    public function get_employee_attendance_type($staff_id, $attendance_date)
    {
        $this->db->where('att_date', date("Y-m-d", strtotime($attendance_date)));
        $this->db->where('is_deleted', '0');
        $this->db->where('emp_id', $staff_id);
        $result = $this->db->get('tbl_salon_emp_attendance');
        return $result->row();
    }
    public function get_attendance_emp_details()
    {
        $this->db->where('id', $this->input->post('employee_id'));
        $this->db->where('is_deleted', '0');
        $result = $this->db->get(' tbl_salon_employee');
        echo json_encode($result->row());
    }
    public function get_today_attendance($id)
    {
        $this->db->where('emp_id', $id);
        $this->db->where('att_date', date('Y-m-d'));
        $this->db->where('is_deleted', '0');
        $result = $this->db->get('tbl_salon_emp_attendance');
        return $result->num_rows();
    }
    public function get_today_present_staff()
    {
        $this->db->select('tbl_salon_emp_attendance.*,  tbl_salon_employee.full_name,  tbl_salon_employee.email,  tbl_salon_employee.whatsapp_number');
        $this->db->where('tbl_salon_emp_attendance.att_date', date('Y-m-d'));
        $this->db->where('tbl_salon_emp_attendance.is_deleted', '0');
        $this->db->join('tbl_salon_employee', ' tbl_salon_employee.id = tbl_salon_emp_attendance.emp_id');
        $result = $this->db->get('tbl_salon_emp_attendance');
        return $result->result();
    }
    public function get_today_staff_attendence($employee_id)
    {
        $this->db->where('att_date', date('Y-m-d'));
        $this->db->where('is_deleted', '0');
        $this->db->where('emp_id', $employee_id);
        $result = $this->db->get('tbl_salon_emp_attendance');
        return $result->row();
    }
    public function get_all_attendance()
    {
        $this->db->select('tbl_salon_emp_attendance.*, tbl_salon_employee.full_name');
        $this->db->from('tbl_salon_emp_attendance');
        $this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_salon_emp_attendance.emp_id', 'left');
        $this->db->where('tbl_salon_emp_attendance.is_deleted', '0');
        $this->db->where('tbl_salon_emp_attendance.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_emp_attendance.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_salon_emp_attendance.id', 'DESC');
    
        $result = $this->db->get();
    
        return $result->result();
    }
    
    public function get_employee_by_shift_name_ajx($shift_name)
    {
        $this->db->where_in('full_name', $shift_name);
        $this->db->order_by('id', 'DESC');
        $this->db->where('is_deleted', '0');
        $result = $this->db->get('tbl_salon_employee')->result();
        return $result;
    }

    public function get_today_attendance_ajx()
    {
        // $this->db->where_in('shift_name', $shift_name);
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('att_date',date('Y-m-d'));
    
        $result = $this->db->get('tbl_salon_emp_attendance');
        $result = $result->result();
        return $result;
    }
    
    public function get_emp_by_shift_name_ajx()
    {   
        $shift_name = $this->input->post('shift_name');
        
        $this->db->where_in('tbl_salon_employee.shift_name', $shift_name);
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_employee')->result();
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(0);
        }

       /* if(!empty($result)){
            foreach($result as $employee_result){
                $check_employee_attendance =  $this->get_today_attendance_ajx($shift_name);
        ?>
        <div class="row"><div class="col-md-6"><li class="staff_name_list"><b id="staff_name_<?=$employee_result->id;?>"><?=$employee_result->full_name;?></b>
            <input type="hidden" name="staff_id_<?=$employee_result->id;?>" class="staff_id" value="<?=$employee_result->id;?>"></li>
            </div>
            <div class="col-md-6">

                <li class="action_button_list">
                    <button type="button" class="btn_choose_sent bg_btn_chose_1">
                        <input type="radio" name="attendence_<?=$employee_result->id;?>" value="1" <?=$check_employee_attendance->idattendence_type == 1? 'checked' : '';?>>>Present
                    </button>
                    <button type="button" class="btn_choose_sent bg_btn_chose_2">
                        <input type="radio" name="attendence_<?=$employee_result->id;?>" value="2" <?=$check_employee_attendance->idattendence_type == 2? 'checked' : '';?>>>Absent
                    </button>
                    <button type="button" class="btn_choose_sent bg_btn_chose_3">
                        <input type="radio" name="attendence_<?=$employee_result->id;?>" value="3" <?=$check_employee_attendance->idattendence_type == 3? 'checked' : '';?>>>Half Day
                    </button>
                </li>
            </div>
        </div>


        <?php
            }
        }*/
    
    }
    public function get_all_salary()
    {
        $this->db->select('tbl_salon_emp_salary_slip.*, tbl_salon_employee.full_name');
        $this->db->from('tbl_salon_emp_salary_slip');
        $this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_salon_emp_salary_slip.emp_id', 'left');
        $this->db->where('tbl_salon_emp_salary_slip.is_deleted', '0');
        $this->db->where('tbl_salon_emp_salary_slip.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_emp_salary_slip.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_salon_emp_salary_slip.id', 'DESC');
    
        $result = $this->db->get();
    
        return $result->result();
    }
    public function get_single_emp_salary()
    {
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $this->uri->segment(2)); 
        $result = $this->db->get('tbl_salon_emp_salary_slip');
        return $result->row();
    }




    // For Salon Expense


    public function add_salon_expense(){
        $data = array(
            'branch_id' 			=> $this->session->userdata('branch_id'),
            'salon_id' 				=> $this->session->userdata('salon_id'),
            'branch_name' 			=> $this->session->userdata('branch_name'),
            "expense_type"        	=> $this->input->post("expense_type"),
            "expense_amount"    	=> $this->input->post("expense_amount"),
            "payment_mode"        	=> $this->input->post("payment_mode"),
            "expense_date"        	=> date("Y-m-d", strtotime($this->input->post("expense_date"))),
            "expense_remark"        => $this->input->post("expense_remark"),
            "given_to"        		=> $this->input->post("given_to"),
        );
		 
		$details = array();
        if ($this->input->post('id') == "") {
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_expense', $new_arr);
			$expense_id = $this->db->insert_id(); 
			$item_name = $this->input->post('item_name');
			$quantity = $this->input->post('quantity');
			$rate = $this->input->post('rate');
			$total_amount = $this->input->post('total_amount');
			for($i = 0;$i <count($item_name);$i++){
				$details[] = array(
					'expense_id' 	=> $expense_id,
					'item_name' 	=> $item_name[$i],
					'quantity' 		=> $quantity[$i],
					'rate' 			=> $rate[$i],
					'total_amount' 	=> $total_amount[$i],
					'created_on' 	=> date("Y-m-d H:i:s"),
				); 
			}
			if(!empty($details)){
				$this->db->insert_batch('tbl_expense_details',$details);
			}
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_expense', $data);
			
			$update_details = array(
				'is_deleted' => '1'
			);
			$this->db->where('expense_id',$this->input->post('id'));
			$this->db->update('tbl_expense_details',$update_details);
			
			$item_name = $this->input->post('item_name');
			$quantity = $this->input->post('quantity');
			$rate = $this->input->post('rate');
			$total_amount = $this->input->post('total_amount');
			for($i = 0;$i <=count($item_name);$i++){
				$details[] = array(
					'expense_id' 	=> $this->input->post('id'),
					'item_name' 	=> $item_name[$i],
					'quantity' 		=> $quantity[$i],
					'rate' 			=> $rate[$i],
					'total_amount' 	=> $total_amount[$i],
					'created_on' 	=> date("Y-m-d H:i:s"),
				);
				if(!empty($details)){
					$this->db->insert_batch('tbl_expense_details',$details);
				}
			}
            return 1;
        }
    }
    public function get_single_salon_expense(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_salon_expense');
        return $result->row();
    }
	public function get_single_expense_details(){
		$this->db->where('is_deleted','0');
		$this->db->where('expense_id',$this->uri->segment(2));
		$result = $this->db->get('tbl_expense_details');
		return $result->result();
	}
    public function get_all_salon_expense(){
    $this->db->select('tbl_salon_expense.*, tbl_expenses_category.expenses_name');
    $this->db->from('tbl_salon_expense');
    $this->db->join('tbl_expenses_category', 'tbl_expenses_category.id = tbl_salon_expense.expense_type');
    $this->db->where('tbl_salon_expense.is_deleted', '0');
    //$this->db->where('tbl_salon_expense.branch_id', $this->session->userdata('branch_id'));
    //$this->db->where('tbl_salon_expense.salon_id', $this->session->userdata('salon_id'));
    $this->db->order_by('tbl_salon_expense.id', 'DESC');
    
    $result = $this->db->get();
    
    return $result->result();
}


    

    public function get_all_expense_list_of_salon_ajx($length, $start, $search)
    {
        $this->db->select('tbl_salon_expense.*,tbl_salon_expense_type.expense_type');
        $this->db->where('tbl_salon_expense.is_deleted', '0');
        $this->db->where('tbl_salon_expense.salon_id', $this->input->post('salon_id'));
        if ($search != "") {
            $this->db->group_start();
            $this->db->or_like('tbl_salon_expense.expense_type', $search);
            $this->db->or_like('tbl_salon_expense.expense_amount', $search);
            $this->db->or_like('tbl_salon_expense.expense_date', $search);
            $this->db->group_end();
        }
        $this->db->join('tbl_salon_expense_type', 'tbl_salon_expense_type.id = tbl_salon_expense.expense_type', 'left');
        $this->db->order_by('tbl_salon_expense.id', 'DESC');
        $this->db->limit($length, $start);
        $result = $this->db->get('tbl_salon_expense');
        return $result->result();
    }
    public function get_active_salon()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $result = $this->db->get('tbl_salon');
        $result = $result->result();
        return $result;
    }
    public function get_all_expense_name()
    {
        $this->db->where('is_deleted', '0');
        //$this->db->where('branch_id', $this->session->userdata('branch_id'));
        //$this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_expenses_category');
        return $result->result();
    }






  
    // add work shedule

    public function get_schedule_data_ajax()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('schedules_id', $this->input->post('schedule_id'));
        $result = $this->db->get('tbl_work_schedule_days');
        $result = $result->result();
        if (!empty($result)) {
?>
            <div class="row">

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="color-code-section">
                        <li>
                            <span class="colored_div" style="background-color:#4caf50;"></span>
                            <h4>Full Day Work</h4>
                        </li>
                        <li>
                            <span class="colored_div" style="background-color:#ffc107;"></span>
                            <h4>Half Day Work</h4>
                        </li>
                        <li>
                            <span class="colored_div" style="background-color:#ff0000;"></span>
                            <h4>Weekend</h4>
                        </li>
                    </ul>

                    <table style="width:100%;" class="working_days_table">
                        <thead>
                            <tr>
                                <th rowspan="2">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom: 30px;padding-top: 20px;">Weeks</div>
                                </th>
                                <th colspan="7" style="border-bottom:1px solid #ddd;border-left: 1px solid #ddd;">Days</th>
                            </tr>
                            <tr>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Sunday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Monday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Tuesday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Wednesday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Thursday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Friday</div>
                                </th>
                                <th style="border-left: 1px solid #ddd;">
                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Saturday</div>
                                </th>
                            </tr>
                        </thead>
                        <thead>

                            <?php $f = 1;
                            foreach ($result as $schedule_result) { ?>
                                <tr>
                                    <th><?= $schedule_result->week; ?><?php
                                                                    if ($schedule_result->week == '1') {
                                                                        echo 'st';
                                                                    } else if ($schedule_result->week == '2') {
                                                                        echo 'nd';
                                                                    } else if ($schedule_result->week == '3') {
                                                                        echo 'rd';
                                                                    } else if ($schedule_result->week == '4' || $schedule_result->week == '5' || $schedule_result->week == '6') {
                                                                        echo 'th';
                                                                    }
                                                                    ?>

                                        <input type="hidden" name="week_name[]" id="week_name_<?= $f; ?>" value="<?= $schedule_result->week; ?>">
                                        <input type="hidden" name="weeking_days_row_id[]" id="weeking_days_row_id_<?= $f; ?>" value="<?= $schedule_result->id; ?>">
                                    </th>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="sun_check[]" id="sun_check_<?= $f; ?>" class="sun_checkBox custom-checkbox-input <?php if ($schedule_result->sunday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->sunday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->sunday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->sunday_status; ?>" <?php if ($schedule_result->sunday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->sunday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->sunday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->sunday_status == '3') { ?>weekendDayClass<?php } ?>" for="sun_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="mon_check[]" id="mon_check_<?= $f; ?>" class="mon_checkBox custom-checkbox-input <?php if ($schedule_result->monday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->monday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->monday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->monday_status; ?>" <?php if ($schedule_result->monday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->monday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->monday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->monday_status == '3') { ?>weekendDayClass<?php } ?>" for="mon_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="tue_check[]" id="tue_check_<?= $f; ?>" class="tue_checkBox custom-checkbox-input <?php if ($schedule_result->tuesday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->tuesday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->tuesday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->tuesday_status; ?>" <?php if ($schedule_result->tuesday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->tuesday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->tuesday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->tuesday_status == '3') { ?>weekendDayClass<?php } ?>" for="tue_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="wed_check[]" id="wed_check_<?= $f; ?>" class="wed_checkBox custom-checkbox-input <?php if ($schedule_result->wednesday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->wednesday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->wednesday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->wednesday_status; ?>" <?php if ($schedule_result->wednesday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->wednesday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->wednesday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->wednesday_status == '3') { ?>weekendDayClass<?php } ?>" for="wed_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="thu_check[]" id="thu_check_<?= $f; ?>" class="thu_checkBox custom-checkbox-input <?php if ($schedule_result->thursday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->thursday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->thursday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->thursday_status; ?>" <?php if ($schedule_result->thursday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->thursday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->thursday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->thursday_status == '3') { ?>weekendDayClass<?php } ?>" for="thu_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="fri_check[]" id="fri_check_<?= $f; ?>" class="fri_checkBox custom-checkbox-input <?php if ($schedule_result->friday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->friday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->friday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->friday_status; ?>" <?php if ($schedule_result->friday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->friday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->friday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->friday_status == '3') { ?>weekendDayClass<?php } ?>" for="fri_check_<?= $f; ?>" style="pointer-events: none;"></label>
                                    </td>
                                    <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                        <input type="checkbox" name="sat_check[]" id="sat_check_<?= $f; ?>" class="sat_checkBox custom-checkbox-input <?php if ($schedule_result->saturday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->saturday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->saturday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $schedule_result->saturday_status; ?>" <?php if ($schedule_result->saturday_status != '') { ?>checked<?php } ?> readonly style="pointer-events: none;">
                                        <label class="custom-checkbox-input <?php if ($schedule_result->saturday_status == '1') { ?>fullDayClass<?php } else if ($schedule_result->saturday_status == '2') { ?>halfDayClass<?php } else if ($schedule_result->saturday_status == '3') { ?>weekendDayClass<?php } ?>" for="sat_check_<?= $f; ?>" style="pointer-events: none;"></label>

                                    </td>
                                </tr>
                            <?php $f++;
                            } ?>
                        </thead>
                    </table>


                    <div class="error checkbox_error" style="text-align:center;"></div>
                </div>
            </div>
	<?php
        }
    }

    public function get_work_schedule_list($length, $start, $search)
    {
        $this->db->where('is_deleted', '0');
        if ($search != "") {
            //$this->db->group_start();
            $this->db->or_like('schedule_name', $search);
            //$this->db->group_end();
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($length, $start);
        $result = $this->db->get('tbl_work_schedules');
        return $result->result();
    }
    public function get_work_schedule_list_count($search)
    {
        $this->db->where('is_deleted', '0');
        if ($search != "") {
            //$this->db->group_start();
            $this->db->or_like('schedule_name', $search);
            //$this->db->group_end();
        }
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_work_schedules');
        return $result->num_rows();
    }
    public function add_work_schedule()
    {
        $data = array(
            'branch_id' => $this->session->userdata('branch_id'),
            'salon_id' => $this->session->userdata('salon_id'),
            'schedule_name'            => $this->input->post('schedule_name'),
            'schedule_description'    => $this->input->post('schedule_description'),
            'added_by'                => $this->session->userdata('id'),
        );
        if ($this->input->post('hidden_id') == '') {
            $date = array(
                'created_on'     => date("Y-m-d H:i:s"),
            );
            $newarr = array_merge($data, $date);
            $this->db->insert('tbl_work_schedules', $newarr);
            $schedule_id = $this->db->insert_id();

            $week_name = $this->input->post('week_name');
            $sun_check = $this->input->post('sun_check');
            $mon_check = $this->input->post('mon_check');
            $tue_check = $this->input->post('tue_check');
            $wed_check = $this->input->post('wed_check');
            $thu_check = $this->input->post('thu_check');
            $fri_check = $this->input->post('fri_check');
            $sat_check = $this->input->post('sat_check');


            for ($i = 0; $i < count($week_name); $i++) {
                if (isset($sun_check[$i])) {
                    $sunday = $sun_check[$i];
                } else {
                    $sunday = '';
                }
                if (isset($mon_check[$i])) {
                    $monday = $mon_check[$i];
                } else {
                    $monday = '';
                }
                if (isset($tue_check[$i])) {
                    $tue = $tue_check[$i];
                } else {
                    $tue = '';
                }
                if (isset($wed_check[$i])) {
                    $wed = $wed_check[$i];
                } else {
                    $wed = '';
                }
                if (isset($thu_check[$i])) {
                    $thu = $thu_check[$i];
                } else {
                    $thu = '';
                }
                if (isset($fri_check[$i])) {
                    $fri = $fri_check[$i];
                } else {
                    $fri = '';
                }
                if (isset($sat_check[$i])) {
                    $sat = $sat_check[$i];
                } else {
                    $sat = '';
                }
                $week = array(
                     'branch_id' => $this->session->userdata('branch_id'),
                     'salon_id' => $this->session->userdata('salon_id'), 
                    'schedules_id'        => $schedule_id,
                    'week'                => $week_name[$i],
                    'sunday_status'        => $sunday,
                    'monday_status'        => $monday,
                    'tuesday_status'    => $tue,
                    'wednesday_status'    => $wed,
                    'thursday_status'    => $thu,
                    'friday_status'        => $fri,
                    'saturday_status'    => $sat,
                    'added_by'            => $this->session->userdata('id'),
                    'created_on'         => date("Y-m-d H:i:s"),
                    'shift_name' => $this->input->post('shift_name'),
                );
                $this->db->insert('tbl_work_schedule_days', $week);
            }
            return 1;
        } else {
            $this->db->where('id', $this->input->post('hidden_id'));
            $this->db->update('tbl_work_schedules', $data);
            $schedule_id = $this->input->post('hidden_id');


            $week_name = $this->input->post('week_name');
            $sun_check = $this->input->post('sun_check');
            $mon_check = $this->input->post('mon_check');
            $tue_check = $this->input->post('tue_check');
            $wed_check = $this->input->post('wed_check');
            $thu_check = $this->input->post('thu_check');
            $fri_check = $this->input->post('fri_check');
            $sat_check = $this->input->post('sat_check');
            $weeking_days_row_id = $this->input->post('weeking_days_row_id');


            for ($i = 0; $i < count($week_name); $i++) {
                if (isset($sun_check[$i])) {
                    $sunday = $sun_check[$i];
                } else {
                    $sunday = '';
                }
                if (isset($mon_check[$i])) {
                    $monday = $mon_check[$i];
                } else {
                    $monday = '';
                }
                if (isset($tue_check[$i])) {
                    $tue = $tue_check[$i];
                } else {
                    $tue = '';
                }
                if (isset($wed_check[$i])) {
                    $wed = $wed_check[$i];
                } else {
                    $wed = '';
                }
                if (isset($thu_check[$i])) {
                    $thu = $thu_check[$i];
                } else {
                    $thu = '';
                }
                if (isset($fri_check[$i])) {
                    $fri = $fri_check[$i];
                } else {
                    $fri = '';
                }
                if (isset($sat_check[$i])) {
                    $sat = $sat_check[$i];
                } else {
                    $sat = '';
                }
                $week = array(
                    'schedules_id'        => $schedule_id,
                    'week'                => $week_name[$i],
                    'sunday_status'        => $sunday,
                    'monday_status'        => $monday,
                    'tuesday_status'    => $tue,
                    'wednesday_status'    => $wed,
                    'thursday_status'    => $thu,
                    'friday_status'        => $fri,
                    'saturday_status'    => $sat,
                    'added_by'            => $this->session->userdata('id'),
                );
                $this->db->where('id', $weeking_days_row_id[$i]);
                $this->db->update('tbl_work_schedule_days', $week);
            }
            return 0;
        }
    }
    public function get_single_work_schedule()
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_work_schedules');
        $result = $result->row();
        return $result;
    }
    public function get_work_schedule_working_days($schedule_id)
    {
        $this->db->where('is_deleted', '0');
        $this->db->where('schedules_id', $schedule_id);
        $result = $this->db->get('tbl_work_schedule_days');
        $result = $result->result();
        return $result;
    }

    public function get_work_shedule_ajax()
{
    $work_shift_name = $this->input->post('work_shift_name');
    $this->db->where('shift_name', $work_shift_name);
    $result = $this->db->get('tbl_work_schedule_days')->result();

    if (!empty($result)) {
        echo json_encode($result);
    }
}

//     public function get_work_shedule_ajax()
// {
//     $work_shift_name = $this->input->post('work_shift_name');
//     $this->db->where('shift_name', $work_shift_name);
//     // $this->db->where('tbl_work_schedule_days.branch_id', $this->session->userdata('branch_id'));
//     // $this->db->where('tbl_work_schedule_days.salon_id', $this->session->userdata('salon_id'));
//     $result = $this->db->get('tbl_work_schedule_days')->row();


//     if (!empty($result)) {
//         echo json_encode($result);
//     }
// }
    public function get_ready_coupon_code(){
		$this->db->where('is_deleted','0');
		$result = $this->db->get('tbl_admin_coupon_code');
		return $result->result();
	}
    public function get_ready_coupon_single_setup(){
		$this->db->where('is_deleted','0');
		$this->db->where('id',$_GET['value']);
		$result = $this->db->get('tbl_admin_coupon_code');
		return $result->row();
	}
	public function set_coupon_code(){
        $data = array(
            'branch_id' 	=> $this->session->userdata('branch_id'),
            'salon_id' 		=> $this->session->userdata('salon_id'),
            'coupon_id' 	=> $this->input->post('coupon_id'),
            'coupon_name' 	=> $this->input->post('coupon_name'),
            'coupan_code' 	=> $this->input->post('coupan_code'),
            'coupan_expiry' => date('Y-m-d',strtotime($this->input->post('coupan_expiry'))),
            'coupon_offers' => $this->input->post('coupon_offers'),
            'min_price' 	=> $this->input->post('min_price'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_coupon_code', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_coupon_code', $data);
            return 1;
        }
    } 
    public function get_all_coupon_list(){
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_coupon_code');
        return $result->result();
    } 
    public function get_all_active_coupon_list(){
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $this->db->where('DATE(coupan_expiry) >=', date('Y-m-d'));
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_coupon_code');
        return $result->result();
    } 
    public function get_all_coupon_code(){
        $this->db->where('is_deleted','0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_coupon_code');
        return $result->result();
    } 
    public function get_single_coupon_code(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->where('id',$_GET['edit']);
        $result = $this->db->get('tbl_coupon_code');
        return $result->row();
    }
    public function get_unique_coupan_code(){
        $this->db->where('coupan_code', $this->input->post('coupan_code'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_coupon_code');
        echo $result->num_rows();
    }
    public function get_unique_customer_mobile(){
        $this->db->where('customer_phone', $this->input->post('customer_phone'));
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_customer');
        echo $result->num_rows();
    }
	public function set_offers(){
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'offers_name' 		=> $this->input->post('offers_name'),
            'offer_id' 			=> $this->input->post('offer_id'),
            'service_name' 		=> implode(',', $this->input->post('service_name')),
            'discount' 			=> $this->input->post('discount'),
            'gender' 			=> $this->input->post('gender'),
            'reward_point' 		=> $this->input->post('reward_point'),
            'duration' 			=> $this->input->post('duration'),
            'description' 		=> $this->input->post('description'),
            'discount_in' 		=> $this->input->post('discount_in'),
            'regular_price' 	=> $this->input->post('regular_price'),
            'offer_price' 		=> $this->input->post('offer_price'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_offers', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_offers', $data);
            return 1;
        }
    } 
    public function get_all_offers(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_offers');
        return $result->result();
    } 
    public function get_all_active_offers(){
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_offers');
        return $result->result();
    } 
    public function get_single_offer(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $_GET['edit']);
        $result = $this->db->get('tbl_offers');
        return $result->row();
    }
    public function get_services($services){
        $this->db->where_in('id',$services);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result(); 
    }
    public function get_services_for_offers(){
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_salon_emp_service');
        return $result->result(); 
    }
    public function get_ready_offer(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_offers');
		return $result->result();
	}
    public function get_single_ready_offer(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('id',$_GET['value']);
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_offers');
		return $result->row();
	}
    public function get_bookings($status,$from_date,$to_date){
        $this->db->select('tbl_booking_services_details.*, tbl_salon_emp_service.service_name, tbl_salon_emp_service.service_name_marathi,tbl_salon_employee.full_name');
        $this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        if($status != ""){
            $this->db->where('tbl_booking_services_details.service_status', $status);
        }
        if($from_date != ""){
            $this->db->where('DATE(tbl_booking_services_details.service_date) >=', $from_date);
        }
        if($to_date != ""){
            $this->db->where('DATE(tbl_booking_services_details.service_date) <=', $to_date);
        }
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $result = $this->db->get('tbl_booking_services_details')->result();
        return $result;
    }
    public function get_dashboard_counts_ajx(){   
        $custom = array(
            'in_process'    =>  0,
            'trying_booking'=>  0,
            'pending'       =>  count($this->get_bookings('0','','')),
            'completed'     =>  count($this->get_bookings('1','','')),
            'cancelled'     =>  count($this->get_bookings('2','','')),
            'today_all'     =>  count($this->get_bookings('',date('Y-m-d'),date('Y-m-d'))),
        );
		echo json_encode($custom);
	}
    public function get_total_product_sale($status, $from_date, $to_date) {
        $this->db->select('tbl_booking_services_products_details.*,tbl_booking_services_details.service_status,tbl_booking_services_details.payment_status as service_payment_status,tbl_booking_services_details.service_date, tbl_product.product_name');
        $this->db->select_sum('tbl_booking_services_products_details.product_discounted_price_while_bill', 'total_discounted_product_price');
        $this->db->join('tbl_product', 'tbl_product.id = tbl_booking_services_products_details.service_id');
        $this->db->join('tbl_booking_services_details', 'tbl_booking_services_details.id = tbl_booking_services_products_details.booking_service_details_id');
        if ($status != "") {
            $this->db->where('tbl_booking_services_details.service_status', $status);
        }
        if ($from_date != "") {
            $this->db->where('DATE(tbl_booking_services_details.service_date) >=', $from_date);
        }
        if ($to_date != "") {
            $this->db->where('DATE(tbl_booking_services_details.service_date) <=', $to_date);
        }
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_products_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.payment_status', '1');
        $this->db->where('tbl_booking_services_products_details.payment_status', '1');
        
        $query = $this->db->get('tbl_booking_services_products_details');
        $result = $query->result();
        
        $total_discounted_product_price = 0;
        if (!empty($result)) {
            $total_discounted_product_price = $query->row()->total_discounted_product_price;
        }
        
        return array(
            'result'      => $result,
            'total_price' => (int)$total_discounted_product_price
        );
    }
    public function get_total_service_sale($status, $from_date, $to_date) {
        $this->db->select('tbl_booking_services_details.*, tbl_salon_emp_service.service_name, tbl_salon_emp_service.service_name_marathi, tbl_salon_employee.full_name');
        $this->db->select_sum('tbl_booking_services_details.service_discounted_price_while_bill', 'total_discounted_service_price');
        $this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_employee', 'tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        if ($status != "") {
            $this->db->where('tbl_booking_services_details.service_status', $status);
        }
        if ($from_date != "") {
            $this->db->where('DATE(tbl_booking_services_details.service_date) >=', $from_date);
        }
        if ($to_date != "") {
            $this->db->where('DATE(tbl_booking_services_details.service_date) <=', $to_date);
        }
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.payment_status', '1');
        
        $query = $this->db->get('tbl_booking_services_details');
        $result = $query->result();
        
        $total_discounted_service_price = 0;
        if (!empty($result)) {
            $total_discounted_service_price = $query->row()->total_discounted_service_price;
        }
        
        return array(
            'result'      => $result,
            'total_price' => (int)$total_discounted_service_price
        );
    }
    
    public function get_dashboard_sales_counts_ajx(){   
        $custom = array(
            'total_sale'    =>  $this->get_total_service_sale('','','')['total_price'] + $this->get_total_product_sale('','','')['total_price'],
            'trying_booking'=>  0,
            'in_process'    =>  0,
            'pending'       =>  $this->get_total_service_sale('0','','')['total_price'] + $this->get_total_product_sale('0','','')['total_price'],
            'completed'     =>  $this->get_total_service_sale('1','','')['total_price'] + $this->get_total_product_sale('1','','')['total_price'],
            'cancelled'     =>  $this->get_total_service_sale('2','','')['total_price'] + $this->get_total_product_sale('2','','')['total_price'],
            'today_sale'    =>  $this->get_total_service_sale('',date('Y-m-d'),date('Y-m-d'))['total_price'] + $this->get_total_product_sale('',date('Y-m-d'),date('Y-m-d'))['total_price'],

            'total_service_sale'    =>  $this->get_total_service_sale('','','')['total_price'],
            'total_product_sale'    =>  $this->get_total_product_sale('','','')['total_price'],

            'total_package_sale'    =>  $this->get_total_package_sale('1','','')['total_price'],
        );
		echo json_encode($custom);
	}
    public function get_total_package_sale($payment_status,$from_date,$to_date){
        $this->db->select('tbl_new_booking.*, tbl_package.package_name');
        $this->db->select_sum('tbl_new_booking.package_amount', 'total_package_price');
        $this->db->join('tbl_package', 'tbl_package.id = tbl_new_booking.pacakge_id');
        if ($payment_status != "") {
            $this->db->where('tbl_new_booking.payment_status', $payment_status);
        }
        if ($from_date != "") {
            $this->db->where('DATE(tbl_new_booking.booking_date) >=', $from_date);
        }
        if ($to_date != "") {
            $this->db->where('DATE(tbl_new_booking.booking_date) <=', $to_date);
        }
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.package_amount !=', '0.00');
        
        $query = $this->db->get('tbl_new_booking');
        $result = $query->result();
        
        $total_package_price = 0;
        if (!empty($result)) {
            $total_package_price = $query->row()->total_package_price;
        }
        
        return array(
            'result'      => $result,
            'total_price' => (int)$total_package_price
        );
    }
    
    public function get_dashboard_redemption_counts_ajx(){   
        $custom = array(
            'total_used_memberships_count'      =>  count($this->get_total_used_memberships()),
            'total_used_coupons_count'          =>  count($this->get_total_used_coupons()),
            'total_used_offers_count'           =>  count($this->get_total_used_offers()),
            'total_used_package_count'          =>  count($this->get_total_used_package()),
            'total_used_giftcards_count'        =>  count($this->get_total_used_giftcards()),            
        );
		echo json_encode($custom);
	}
    public function get_total_used_giftcards(){
        $this->db->select('tbl_new_booking.*, tbl_gift_card.gift_name');
        $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_new_booking.applied_giftcard_id');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.is_giftcard_applied', '1');
        $this->db->where('tbl_new_booking.applied_giftcard_id !=', '');
        $this->db->where('tbl_new_booking.applied_giftcard_id !=', '0');
        $this->db->where('tbl_new_booking.applied_giftcard_id !=', null);
        $this->db->group_by('tbl_new_booking.applied_giftcard_id');        
        $query = $this->db->get('tbl_new_booking');
        $result = $query->result();
        return $result;
    }
    public function get_total_used_memberships(){
        $this->db->select('tbl_new_booking.*, tbl_memebership.membership_name');
        $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_new_booking.membership_id');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.is_membership_booking', '1');
        $this->db->where('tbl_new_booking.membership_id !=', '');
        $this->db->where('tbl_new_booking.membership_id !=', '0');
        $this->db->where('tbl_new_booking.membership_id !=', null);
        $this->db->group_by('tbl_new_booking.membership_id');   
        $query = $this->db->get('tbl_new_booking');
        $result = $query->result();
        return $result;
    }
    public function get_total_used_coupons(){
        $this->db->select('tbl_new_booking.*, tbl_coupon_code.coupon_name');
        $this->db->join('tbl_coupon_code', 'tbl_coupon_code.id = tbl_new_booking.selected_coupon_id');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.selected_coupon_id !=', '');
        $this->db->where('tbl_new_booking.selected_coupon_id !=', '0');
        $this->db->where('tbl_new_booking.selected_coupon_id !=', null);
        $this->db->group_by('tbl_new_booking.selected_coupon_id');        
        $query = $this->db->get('tbl_new_booking');
        $result = $query->result();
        return $result;
    }
    public function get_total_used_package(){
        $this->db->select('tbl_new_booking.*, tbl_package.package_name');
        $this->db->join('tbl_package', 'tbl_package.id = tbl_new_booking.pacakge_id');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.pacakge_id !=', '');
        $this->db->where('tbl_new_booking.pacakge_id !=', '0');
        $this->db->where('tbl_new_booking.pacakge_id !=', null);
        $this->db->group_by('tbl_new_booking.pacakge_id');        
        $query = $this->db->get('tbl_new_booking');
        $result = $query->result();
        return $result;
    }
    public function get_total_used_offers(){
        $this->db->select('tbl_booking_services_details.*, tbl_offers.offers_name, tbl_new_booking.is_deleted');
        $this->db->join('tbl_offers', 'tbl_offers.id = tbl_booking_services_details.applied_offer_id');
        $this->db->join('tbl_new_booking', 'tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.is_service_offer_applied', '1');
        $this->db->where('tbl_booking_services_details.applied_offer_id !=', '');
        $this->db->where('tbl_booking_services_details.applied_offer_id !=', '0');
        $this->db->where('tbl_booking_services_details.applied_offer_id !=', null);
        $this->db->group_by('tbl_booking_services_details.applied_offer_id');        
        $this->db->group_by('tbl_booking_services_details.booking_id');        
        $query = $this->db->get('tbl_booking_services_details');
        $result = $query->result();
        return $result;
    }
    public function get_service_price_details_ajax(){   
		$service_name_id = $this->input->post('service_name_id');
		$this->db->where_in('id', $service_name_id);
		$this->db->where('status', '1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->result();
		if (!empty($result)) {
			echo json_encode($result);
		}
	}
    public function get_product_details_div_ajx(){   
		$product_ids = explode(',',$this->input->post('product_ids'));

		$this->db->where_in('id', $product_ids);
		$result = $this->db->get('tbl_product')->result();

        if(!empty($result)){
        ?>
            <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        foreach($result as $data){ 
                    ?>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th><?=$data->product_name;?></th>
                        <th><?=$data->selling_price;?></th>
                    </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>
        <?php 
        }
	}
	public function get_service_info_details_ajax(){   
		$service_name_id = $this->input->post('service_name_id');
		$this->db->where_in('id', $service_name_id);
		$this->db->where('status', '1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->row();
		if (!empty($result)) {
			echo json_encode($result);
		}
	}
	public function get_selected_service_name_for_offer($service_name){
		$exp = explode(',',$service_name);
		$this->db->where_in('id',$exp);
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_salon_emp_service');
		return $result->result();
		
	}
	public function get_selected_product_name_for_offer($product_name){
		$exp = explode(',',$product_name);
		$this->db->where_in('id',$exp);
		$this->db->where('is_deleted', '0');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_product');
		return $result->result(); 
	}
	public function get_ready_gift_card(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->result();
	}
	public function get_single_ready_gift_card(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('id',$_GET['value']);
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_gift_card');
		return $result->row();
	}
	public function set_gift_card(){
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'giftcard_id' 		=> $this->input->post('giftcard_id'),
            'gift_name' 		=> $this->input->post('gift_name'),
            'service_name' 		=> implode(',',$this->input->post('service_name')),
            'gender' 			=> $this->input->post('gender'),
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
                'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_gift_card', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_gift_card', $data);
            return 1;
        }
    } 
    public function get_all_gift_list(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_gift_card');
        return $result->result();
    }
    public function get_single_gift_card(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $this->db->where('id',$_GET['edit']);
        $result = $this->db->get('tbl_gift_card');
        return $result->row();
    } 
    public function get_uinique_gift_code_ajax(){
        $gift_card_code = $this->input->post('gift_card_code');
        $this->db->where('is_deleted', '0');
        $this->db->where('gift_card_code', $gift_card_code);
        $result = $this->db->get('tbl_gift_card')->row(); 
        if(!empty($result)){
            echo json_encode($result);
        } else {
            echo 0;
        }
    } 
	public function get_ready_packages(){
		$this->db->where('is_deleted', '0'); 
		$this->db->where('status','1');
		$result = $this->db->get('tbl_admin_package');
		return $result->result();
	}
	public function get_single_ready_package(){
		$this->db->where('is_deleted', '0'); 
		$this->db->where('status','1');
		$this->db->where('id',$_GET['value']);
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_package');
		return $result->row();
	}
	public function get_all_package(){
		$this->db->where('is_deleted','0');
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('salon_id',$this->session->userdata('salon_id'));
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_package');
		return $result->result();
	} 
	public function get_single_package(){
		$this->db->select('tbl_package.*');
		$this->db->from('tbl_package');
		//$this->db->join('tbl_product','tbl_package.product_name = tbl_product.id', 'left'); 
		$this->db->where('tbl_package.is_deleted', '0');
		$this->db->where('tbl_package.id',$_GET['edit']);
		$result = $this->db->get();
		return $result->row();
	}
    public function get_product_for_package_ajax_new(){
		$service_name_id = $this->input->post('service_name_id'); 
		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->result(); 

        $allowed_products = [];
        $allowed_products_array = array();

		if(!empty($result)){
            foreach($result as $data){
                $single_products = explode(',',$data->product);
                $this->db->where_in('id', $single_products);
                $products = $this->db->get('tbl_product')->result(); 
                if(!empty($products)){
                    foreach($products as $products_result){
                        // if(!in_array($products_result->id,$allowed_products)){
                            $allowed_products[] = $products_result->id;
                            $allowed_products_array[] = array(
                                'id'                =>  $products_result->id,
                                'service_name'      =>  $data->service_name,
                                'product_name'      =>  $products_result->product_name,
                            );
                        // }
                    }
                }
            }
			echo json_encode(array(
                'result'                    =>  $result,
                'allowed_products_array'    =>  $allowed_products_array,
                'allowed_products'          =>  $allowed_products,
            ));
		}else{
			echo '[]';
		}
	}
    
    public function get_service_product_for_package_ajax(){
		$service_name_id = $this->input->post('service_name_id'); 
		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service')->result(); 

		if(!empty($result)){
            foreach($result as &$data){
                $single_products = explode(',',$data->product);
                $this->db->where_in('id', $single_products);
                $products = $this->db->get('tbl_product')->result(); 

                $data->products = $products;
            }
        }

        echo json_encode($result);
	}
    public function get_product_for_package_ajax(){
		$service_name_id = $this->input->post('service_name_id'); 
		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$this->db->group_by('product');
		$result = $this->db->get('tbl_salon_emp_service')->result(); 
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo '[]';
		}
	}
	public function get_product_for_package_by_service($service_name_id){
		$service_name_id = explode(",",$service_name_id); 
		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$this->db->group_by('product');
		$result = $this->db->get('tbl_salon_emp_service');
		return $result->result(); 
		 
	}
	public function get_product_for_package_by_service_during_update_new($service_name_id){
		$service_name_id = explode(",",$service_name_id); 

		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_salon_emp_service');
		$result = $result->result(); 

		if(!empty($result)){
			foreach($result as &$result_res){
                $this->db->where_in('id',explode(',',$result_res->product)); 
                $product = $this->db->get('tbl_product')->result();
                $result_res->products = $product;
			}
		}

        return $result;
	}
	public function get_product_for_package_by_service_during_update($service_name_id){
		$service_name_id = explode(",",$service_name_id); 
		$this->db->where_in('tbl_salon_emp_service.id', $service_name_id);
		$this->db->where('tbl_salon_emp_service.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_salon_emp_service.salon_id', $this->session->userdata('salon_id'));
		$this->db->group_by('product');
		$result = $this->db->get('tbl_salon_emp_service');
		$result = $result->result(); 
		$product_ids = array();
		if(!empty($result)){
			foreach($result as $result_res){
				$products_id = explode(",",$result_res->product);
				for($i=0;$i<count($products_id);$i++){
					$product_ids[] = $products_id[$i];
				}
			}
		}
		if(!empty($product_ids)){
			$this->db->where_in('id',$product_ids); 
			$this->db->where('branch_id', $this->session->userdata('branch_id'));
			$this->db->where('salon_id', $this->session->userdata('salon_id'));
			$product = $this->db->get('tbl_product');
			return $product->result();
		}
	}
	public function set_package(){
        $services = $this->input->post('service_name');
		$data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'package_id' 		=> $this->input->post('package_id'),
            'package_name' 		=> $this->input->post('package_name'),
            'service_name' 		=> ($this->input->post('service_name') != "") ? implode(',', $this->input->post('service_name')) : null,
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
        // echo '<pre>'; print_r($services); exit();
		if($this->input->post('id') == ""){
            $date = array(
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_package', $new_arr);
            $package_id = $this->db->insert_id();

            $all_products = [];
            if($services != ""){
                for($i=0;$i<count($services);$i++){
                    $service_details = $this->get_service_details($services[$i]);
                    if(!empty($service_details) && $service_details->product != "" && $service_details->product != null){
                        $package_product_data = array(
                            'branch_id' 		=> $this->session->userdata('branch_id'),
                            'salon_id' 			=> $this->session->userdata('salon_id'),
                            'tbl_package_id' 	=> $package_id,
                            'service_id' 	    => $services[$i],
                            'product_ids' 	    => $service_details->product,
                            'created_on'        => date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_package_products', $package_product_data);

                        for($j=0;$j<count(explode(',',$service_details->product));$j++){
                            $all_products[] = explode(',',$service_details->product)[$j];
                        }
                    }
                }
            }

            $products_data = array(
                'product_name' 		=> (!empty($all_products) && count($all_products) > 0 && is_array($all_products)) ? implode(',', $all_products) : null,
            );
            $this->db->where('id', $package_id);
            $this->db->update('tbl_package', $products_data);

            return 0;
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_package', $data);
            $package_id = $this->input->post('id');

            $this->db->where('tbl_package_id',$package_id);
            $this->db->delete('tbl_package_products');

            $all_products = [];
            if($services != ""){
                for($i=0;$i<count($services);$i++){
                    $service_details = $this->get_service_details($services[$i]);
                    if(!empty($service_details) && $service_details->product != "" && $service_details->product != null){
                        $package_product_data = array(
                            'branch_id' 		=> $this->session->userdata('branch_id'),
                            'salon_id' 			=> $this->session->userdata('salon_id'),
                            'tbl_package_id' 	=> $package_id,
                            'service_id' 	    => $services[$i],
                            'product_ids' 	    => $service_details->product,
                            'created_on'        => date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_package_products', $package_product_data);

                        for($j=0;$j<count(explode(',',$service_details->product));$j++){
                            $all_products[] = explode(',',$service_details->product)[$j];
                        }
                    }
                }
            }

            $products_data = array(
                'product_name' 		=> (!empty($all_products) && count($all_products) > 0 && is_array($all_products)) ? implode(',', $all_products) : null,
            );
            $this->db->where('id', $package_id);
            $this->db->update('tbl_package', $products_data);

            return 1;
        }
    }
	public function get_product_category_list(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_product_category');
		return $result->result();
	}
	public function get_product_single_category(){
		$this->db->where('id',$this->uri->segment(2));
		$result = $this->db->get('tbl_product_category');
		return $result->row();
	}
	public function get_product_list_by_category(){
		$this->db->where('product_category',$this->uri->segment(2));
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_admin_product');
		return $result->result();
	}
	public function get_single_product_setup_details(){
		$this->db->where('id',$_GET['id']);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_admin_product');
		return $result->row();
	}
	public function get_single_product_details(){
		$this->db->where('id',$_GET['edit']);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_product');
		return $result->row();
	}
	public function get_my_added_product(){ 
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
		$result = $this->db->get('tbl_product');
		return $result->result();
	}
	public function set_product($product_photo){
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'product_id' 		=> $this->input->post('product_id'),
            'product_category' 	=> $this->input->post('product_category'),
            'product_name' 		=> $this->input->post('product_name'),
            'low_stock' 		=> $this->input->post('low_stock'),
            'high_stock' 		=> $this->input->post('high_stock'),
            'hsn_code' 			=> $this->input->post('hsn_code'),
            'date_require' 		=> $this->input->post('date_require'),
            'expiry_date' 		=> date('Y-m-d', strtotime($this->input->post('expiry_date'))),
            'mfg_date' 			=> date('Y-m-d', strtotime($this->input->post('mfg_date'))),
            'discount' 			=> $this->input->post('discount'),
            'incentive' 		=> $this->input->post('incentive'),
            'description' 		=> $this->input->post('description'),
            'product_unit' 		=> $this->input->post('product_unit'),
            'selling_price' 	=> $this->input->post('selling_price'),
            'low_stock_alert' 	=> $this->input->post('low_stock_alert'),
            'online_store' 		=> $this->input->post('online_store'),
            'product_photo' 	=> $product_photo,
        ); 
        if($this->input->post('id') == ""){
			$status = 0;
			if($this->input->post('product_id') == 0){
				$status = '0';
			}else{
				$status = '1';
			}
            $date = array(
				'status'		=> $status,
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_product', $new_arr);
            return 0;
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_product', $data);
            return 1;
        }
    } 
    public function get_all_active_product(){
        $this->db->select('tbl_product.*, tbl_product_category.product_category');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product.product_category = tbl_product_category.id', 'left');
        $this->db->where('tbl_product.is_deleted', '0');
        $this->db->where('tbl_product.status', '1');
        $this->db->where('tbl_product.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_product.id', 'DESC'); 
        $result = $this->db->get();
        return $result->result();
    } 
    public function get_all_product_master(){
        $this->db->select('tbl_product.*, tbl_product_category.product_category');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product.product_category = tbl_product_category.id', 'left');
        $this->db->where('tbl_product.is_deleted', '0');
        $this->db->where('tbl_product.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_product.id', 'DESC'); 
        $result = $this->db->get();
        return $result->result();
    } 
    public function get_all_product_by_category($category_id){
        $this->db->select('tbl_product.*,tbl_product_category.product_category as productcategory,tbl_product_unit.product_unit as productunit');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product.product_category = tbl_product_category.id', 'left');
        $this->db->join('tbl_product_unit', 'tbl_product.product_unit = tbl_product_unit.id', 'left');
        $this->db->where('tbl_product.is_deleted', '0');
        $this->db->where('tbl_product.status', '1');
        $this->db->where('tbl_product.product_category', $category_id);
        $this->db->where('tbl_product.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_product.id', 'DESC'); 
        $result = $this->db->get();
        return $result->result();
    }
    public function get_all_pending_products(){
        $this->db->select('tbl_product.*,tbl_product_category.product_category as productcategory,tbl_product_unit.product_unit as productunit');
        $this->db->join('tbl_product_category','tbl_product.product_category = tbl_product_category.id', 'left');
        $this->db->join('tbl_product_unit','tbl_product.product_unit = tbl_product_unit.id', 'left');
        // $this->db->where('tbl_product.is_deleted','0');
        $this->db->where('tbl_product.status','0'); 
        $this->db->where('tbl_product.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_product.salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('tbl_product.id','DESC'); 
        $result = $this->db->get('tbl_product');
        return $result->result();
    } 
    public function get_single_product_master(){
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('id', $this->uri->segment(2));
        $result = $this->db->get('tbl_product');
        return $result->row();
    }  
    // public function get_unique_hsn_code(){
    //     $this->db->where('hsn_code', $this->input->post('hsn_code'));
    //     if($this->input->post('id') != "0"){
    //         $this->db->where('id !=', $this->input->post('id'));
    //     }
    //     $this->db->where('is_deleted', '0');
    //     $this->db->where('branch_id', $this->session->userdata('branch_id'));
    //     $this->db->where('salon_id', $this->session->userdata('salon_id'));
    //     $result = $this->db->get('tbl_product');
    //     echo $result->num_rows();
    // }
    

    public function get_unique_hsn_code(){
        $this->db->where('hsn_code', $this->input->post('hsn_code'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=', $this->input->post('id'));
        }
        $this->db->where('is_deleted', '0');
        // $this->db->where('branch_id', $this->session->userdata('branch_id'));
        // $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_admin_product');
        echo $result->num_rows();
    }

    public function get_all_product_barcode(){
		$this->db->select('tbl_product_barcode.*, tbl_product.product_name');
		$this->db->from('tbl_product_barcode');
		$this->db->join('tbl_product', 'tbl_product_barcode.product_name = tbl_product.id', 'left');
		$this->db->where('tbl_product_barcode.is_deleted', '0');
		$this->db->where('tbl_product_barcode.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_product_barcode.salon_id', $this->session->userdata('salon_id'));
		$this->db->order_by('tbl_product_barcode.id', 'DESC'); 
		$result = $this->db->get();
		return $result->result();
	}
    
    public function add_employee_incentive_master(){
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'level'             =>$this->input->post('level'),
            'start_amount'             =>$this->input->post('start_amount'),
            'end_amount'             =>$this->input->post('end_amount'),
            'incentive'             =>$this->input->post('incentive'),
        );
        if($this->input->post('id') == ""){
            $date = array(
                'created_on'  => date("Y-m-d H:i:s")
            );
            $new_arr =array_merge($data, $date);
            $this->db->where('is_deleted','0');
            $this->db->where('branch_id',$this->session->userdata('branch_id'));
            $this->db->where('salon_id',$this->session->userdata('salon_id'));
            $this->db->where('level',$this->input->post('level'));
            $exits_entry=$this->db->get('tbl_salon_employee_incentive')->row();
            if(!empty($exits_entry)){
                $this->db->where('id',$exits_entry->id);
                $this->db->update('tbl_salon_employee_incentive',$data);
                return 1;
            }else{
                $this->db->insert('tbl_salon_employee_incentive', $new_arr);
                return 0;
            }
           
        }else{
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_salon_employee_incentive', $data);
            return 1;
        }
    } 
    public function get_employee_incetive(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        return $this->db->get('tbl_salon_employee_incentive')->row();
    }
    public function get_all_added_employee_incetive(){
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
        return $this->db->get('tbl_salon_employee_incentive')->result();
    }
    public function get_salary_method(){
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        // $this->db->where('id',$salary_method);
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
        return $this->db->get('tbl_salon_employee_incentive')->result();
    }
    public function check_unique_field($table,$column,$label,$id){
        $this->db->where('is_deleted', '0');
        if($id != ""){
            $this->db->where('id !=', $id);
        }
        $this->db->where($column, $label);
        $result = $this->db->get($table)->num_rows(); 

        if($result > 0){
            echo '1';
        }else{
            echo '0';
        }
    } 
    public function check_unique_shift(){
        $table = 'tbl_shift_master';
        $column = 'shift_name';
        $label = $this->input->post('label');
        $id = $this->input->post('id');

		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->check_unique_field($table,$column,$label,$id);
    } 
    public function get_services_ajax(){
        $category = $this->input->post('category');

        $this->db->where('id',$category);
        $single = $this->db->get('tbl_admin_service_category')->row();
        
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $this->db->where('category',$category);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_emp_service')->result();

        echo json_encode(array(
            'single' => $single,
            'result' => $result,
        ));
    }
    public function get_india_state(){
		$this->db->where('country_id','101');
		$result = $this->db->get('states');
		return $result->result();
	} 
    public function get_all_ready_memebership(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		if($this->session->userdata('store_gender') == "0"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}else if($this->session->userdata('store_gender') == "1"){
			$this->db->where('gender',$this->session->userdata('store_gender'));
		}
		$result = $this->db->get('tbl_admin_memebership');
		return $result->result();
	}
    public function get_ready_membership_single_setup(){
		$this->db->where('id',$_GET['value']);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_admin_memebership');
		return $result->row();
	}
	public function get_single_membership(){
		$this->db->where('id',$_GET['edit']);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$result = $this->db->get('tbl_memebership');
		return $result->row();
	}
    
    public function create_services_div_ajx(){
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $active_offers = $this->input->post('active_offers');

        $this->db->where('id',$category);
        $single = $this->db->get('tbl_admin_service_category')->row();
        
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $this->db->where('category',$category);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_salon_emp_service')->result();

        if(!empty($single)){
        ?>
        <div class="row single_service_details_append category_services_box" id="single_service_details_append_<?=$single->id;?>">
            <div class="row ">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="title_c" id="category_name_t_<?=$single->id;?>"><?=$single->sup_category;?> | <?=$single->sup_category_marathi;?></div>
                </div>
                <?php
                    if($type == 'manual'){
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a class="service-search-icon" onclick="removeCategory(<?=$single->id;?>)"><i class="fa fa-trash"></i></a>
                </div>
                <?php } ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input autocomplete="off" onkeyup="search_service(<?=$single->id;?>)" class="form-control ss-search" type="text" name="search_services" id="search_services_<?=$single->id;?>" value="" placeholder="Search services by service name"><a class="service-search-icon" href="#"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <?php if(!empty($result)){ ?>
            <div class="all_services_div" id="all_services_div_<?=$single->id;?>">
                <?php 
                    if(!empty($result)){
                        foreach($result as $data){
                            $this->db->where_in('id', explode(',',$data->product));
                            $this->db->where('is_deleted', '0');
                            $this->db->where('status', '1');
                            $products = $this->db->get('tbl_product')->result();
                            $rewards = $data->reward_point;

                            if(!empty($active_offers)){
                                $count = count($active_offers);
                            }else{
                                $count = 0;
                            }
                            $service_offer_discount = 0;
                            $single_offer_discount_type = '';
                            $single_offer_discount = '';
                            $applied_offer_id = '';
                            for ($i = 0; $i < $count; $i++) {
                                $single_offer_services = explode(',',$active_offers[$i]['service_name']);
                                if (in_array($data->id,$single_offer_services)) {
                                    $single_offer_discount_type = $active_offers[$i]['discount_in'];
                                    if($single_offer_discount_type == '0'){
                                        $service_offer_discount = ($data->final_price * $active_offers[$i]['discount']) / 100;
                                    }else{
                                        $service_offer_discount = $active_offers[$i]['discount'];
                                    }
                                    $single_offer_discount = $active_offers[$i]['discount'];
                                    $rewards = $active_offers[$i]['reward_point'];
                                    $applied_offer_id = $active_offers[$i]['id'];
                                    break;
                                }
                            }

                            $service_price_consider = $data->final_price - $service_offer_discount;
                            $original_price = $data->final_price;
                ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name_<?=$data->id;?>">
                        <input onclick="setServicePrice(<?=$data->id;?>)" class="service_name_check" type="checkbox" name="service_name_check[]" id="service_name_check_<?=$data->id;?>" value="<?=$data->id;?>">
                        <div class="selected_service_name service_name_t_<?=$single->id;?>" id="service_name_t_<?=$data->id;?>"><?=$data->service_name;?>|<?=$data->service_name_marathi;?></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 service_price_t" id="service_price_t_<?=$data->id;?>">
                        <?php if($original_price != $service_price_consider){ $is_offer_applied = '1'; ?>
                            <div class="service_price_title"  title="Offer Price"><b>Rs. <s><?=$original_price;?></s> <?=$service_price_consider;?></b></div>
                        <?php }else{ $is_offer_applied = '0'; ?>
                            <div class="service_price_title" ><b>Rs. <?=$original_price;?></b></div>
                        <?php } ?>
                        <input type="hidden" name="service_original_price_<?=$data->id;?>" id="service_original_price_<?=$data->id;?>" value="<?=$original_price;?>">
                        <input type="hidden" name="applied_offer_id_<?=$data->id;?>" id="applied_offer_id_<?=$data->id;?>" value="<?=$applied_offer_id;?>">
                        <input type="hidden" name="is_service_offer_applied_<?=$data->id;?>" id="is_service_offer_applied_<?=$data->id;?>" value="<?=$is_offer_applied;?>">
                        <input type="hidden" name="service_offer_discount_<?=$data->id;?>" id="service_offer_discount_<?=$data->id;?>" value="<?=$single_offer_discount;?>">
                        <input type="hidden" name="service_offer_discount_type_<?=$data->id;?>" id="service_offer_discount_type_<?=$data->id;?>" value="<?=$single_offer_discount_type;?>">
                        <input type="hidden" name="service_offer_discount_amount_<?=$data->id;?>" id="service_offer_discount_amount_<?=$data->id;?>" value="<?=$service_offer_discount;?>">

                        <input type="hidden" name="service_added_from_<?=$data->id;?>" id="service_added_from_<?=$data->id;?>" value="<?=$type;?>">
                        <input type="hidden" name="service_duration_<?=$data->id;?>" id="service_duration_<?=$data->id;?>" value="<?=$data->service_duration;?>">
                        <input type="hidden" name="service_price_<?=$data->id;?>" id="service_price_<?=$data->id;?>" value="<?=$service_price_consider;?>">
                        <input type="hidden" name="service_name_<?=$data->id;?>" id="service_name_<?=$data->id;?>" value="<?=$data->service_name;?>">
                        <input type="hidden" name="service_rewards_hidden_<?=$data->id;?>" id="service_rewards_hidden_<?=$data->id;?>" value="<?=$rewards;?>">
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model_<?=$data->id;?>">
                        <button type="button" class="product_model_a" id="product_modal_button_<?=$data->id;?>" data-toggle="modal" data-target="#exampleModal_<?=$data->id;?>" onclick="showPopup('exampleModal_<?=$data->id;?>')">
                            <span id="selected_product_<?=$data->id;?>">0</span>/<?=count($products);?>
                        </button>                                 
                        <div class="modal fade" style="background-color: #00000080;" id="exampleModal_<?=$data->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$data->id;?>" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin-top:125px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel_<?=$data->id;?>"><?=$data->service_name;?> Products:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('exampleModal_<?=$data->id;?>')">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if(!empty($products)){ ?>
                                        <table class="table" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Product</th>
                                                    <th>Price <small>(In INR)</small></th>
                                                </tr>
                                            <thead>
                                            <tbody>
                                            <?php 
                                                if(!empty($products)){
                                                    foreach($products as $products_result){                                       
                                            ?>
                                            <tr>
                                                <th><input disabled class="product_checkbox_<?=$data->id;?>" onclick="setServiceProductPrice(<?=$data->id;?>,<?=$products_result->id;?>)" type="checkbox" name="product_checkbox_<?=$data->id;?>[]" id="product_checkbox_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$products_result->id;?>"></th>
                                                <th><?=$products_result->product_name;?></th>
                                                <th><?=$products_result->selling_price;?></th>
                                                <input type="hidden" class="product_price_<?=$data->id;?>" name="product_added_from_<?=$data->id;?>_<?=$products_result->id;?>" id="product_added_from_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$type;?>">
                                                <input type="hidden" class="product_price_<?=$data->id;?>" name="product_price_<?=$data->id;?>_<?=$products_result->id;?>" id="product_price_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$products_result->selling_price;?>">
                                                <input type="hidden" class="product_name_<?=$data->id;?>" name="product_name_<?=$data->id;?>_<?=$products_result->id;?>" id="product_name_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$products_result->product_name;?>">
                                            </tr>
                                            <?php }} ?>
                                            </tbody>
                                        </table>
                                        <?php }else{ ?>
                                            <label class="error">Products not available</label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <?php }else{ ?>
                <div class="all_services_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="error noserviceavl" >Services not available</label>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        }
    }
    public function check_customer_package_items_used_status($allocation_id,$customer,$package,$item_id,$item_type){
        $this->db->where('allocation_id',$allocation_id);
        $this->db->where('customer_name',$customer);
        $this->db->where('pacakge_id',$package);
        $this->db->where('is_deleted','0');
        $this->db->where('item_type',$item_type);
        $this->db->where('item_id',$item_id);
        $customer_package_details = $this->db->get('tbl_booking_package_detail_status')->row();
        if(!empty($customer_package_details)){
            if($customer_package_details->used_status == '0'){
                return '1@@'.$customer_package_details->id;
            }else{
                return '0@@'.$customer_package_details->id;
            }
        }else{
            return '1@@';
        }
    }
    public function check_is_unused_item_available($booking,$customer){
        $this->db->where('customer_name',$customer);
        $this->db->where('is_deleted','0');
        $this->db->where('used_status','0');
        $this->db->where('added_in_booking_id',$booking);
        $result = $this->db->get('tbl_booking_package_detail_status')->result();
        return $result;
    }
    public function get_customer_active_package_allocation($customer_id,$package){
        $this->db->where('customer_name',$customer_id);
        $this->db->where('package_id',$package);
        $this->db->where('is_deleted','0');
        $this->db->where('is_lapsed','0');
        $result = $this->db->get('tbl_customer_package_allocations')->row();
        return $result;
    }
    public function create_package_div_ajx(){
        $customer_id = $this->input->post('customer');
        $package = $this->input->post('package');
        $type = $this->input->post('type');

        $this->db->where('id',$package);
        $package = $this->db->get('tbl_package')->row();

        if($customer_id != ""){   
            if(!empty($package)){  
                $active_package_allocation = $this->get_customer_active_package_allocation($customer_id,$package->id);
                $this->db->where_in('id',explode(',',$package->service_name));
                $this->db->where('branch_id', $this->session->userdata('branch_id'));
                $this->db->where('salon_id', $this->session->userdata('salon_id'));
                $services = $this->db->get('tbl_salon_emp_service')->result();
                
                $this->db->where_in('id', explode(',',$package->product_name));
                $products = $this->db->get('tbl_product')->result();
            ?>
            <div class="row single_service_details_append" id="single_package_details_append_<?=$package->id;?>">
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="title_c" id="package_id_<?=$package->id;?>">
                            <!-- <?=$package->package_name;?> -->
                            <button class="btn btn-sm" style="float:left; background-color:<?=$package->bg_color;?>; color:<?=$package->text_color?>"><?=$package->package_name;?></button>
                        </div>
                    </div>
                    <?php 
                        $original_price = $package->amount;
                        if(!empty($active_package_allocation)){ 
                            $package_price_to_consider = 0;
                        }else{
                            $package_price_to_consider = $original_price;
                        }
                    ?>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a style="float:right;" class="service-search-icon" onclick="removePackage(<?=$package->id;?>)"><i class="fa fa-times" style="color: red;"></i></a>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <?php if($package_price_to_consider == $original_price){ ?>
                            <div style="padding: 0px 8px !important; width: 25% !important;" class="title_c package_price_title" id="package_price_<?=$package->id;?>">Rs. <?= number_format($package->amount, 2); ?></div>
                        <?php }else{ ?>
                            <div style="padding: 0px 8px !important; width: 25% !important;" class="title_c package_price_title" id="package_price_<?=$package->id;?>">Rs. <s><?= number_format($package->amount, 2); ?></s> <?= number_format($package_price_to_consider, 2); ?></div>
                        <?php } ?>
                        <input type="hidden" name="package_price_hidden_<?=$package->id;?>" id="package_price_hidden_<?=$package->id;?>" value="<?=$package_price_to_consider;?>">
                        <input type="hidden" name="package_name_hidden_<?=$package->id;?>" id="package_name_hidden_<?=$package->id;?>" value="<?=$package->package_name;?>">
                    </div>
                </div>
                <?php if(!empty($active_package_allocation)){ ?>
                <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <label class="label label-success">Active Package Available</label>
                    </div>
                    <input type="hidden" name="is_old_package" id="is_old_package" value="1">
                    <input type="hidden" name="old_package_allocation_id" id="old_package_allocation_id" value="<?=$active_package_allocation->id;?>">
                </div>
                <?php } ?>
                <?php if(!empty($services)){ ?>
                <div class="" id="all_package_services_div_<?=$package->id;?>">
                    <!-- <h5><b>Package Services</b></h5> -->
                    <?php 
                        if(!empty($services)){
                            foreach($services as $data){
                                if(!empty($active_package_allocation)){    
                                    $service_availability_status = $this->check_customer_package_items_used_status($active_package_allocation->id,$customer_id,$package->id,$data->id,'0');
                                    $is_available = explode('@@',$service_availability_status)[0];
                                    $old_id = explode('@@',$service_availability_status)[1];
                                }else{
                                    $is_available = '1';
                                    $old_id = '';
                                }
                                $package_products = $this->get_package_products($package->id,$data->id);
                    ?>
                    <div class="row">
                        <div class="col-md-10 col-sm-12 col-xs-12" id="package_service_<?=$data->id;?>">
                            <input <?php if(!empty($active_package_allocation)){ if($is_available == '1'){ echo ''; }else{ echo 'disabled'; }}else{ echo ''; } ?> onclick="setPackageService(<?=$package->id;?>,<?=$data->id;?>)" class="service_name_check" type="checkbox" name="package_service_name_check_<?=$package->id;?>[]" id="package_service_name_check_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->id;?>">
                            <div class="selected_service_name package_service_name_t_<?=$package->id;?>_<?=$data->id;?>" id="package_service_name_t_<?=$package->id;?>_<?=$data->id;?>"><?=$data->service_name;?>|<?=$data->service_name_marathi;?></div>
                            <input type="hidden" name="package_service_name_hidden_<?=$package->id;?>_<?=$data->id;?>" id="package_service_name_hidden_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->service_name;?>">
                            <input type="hidden" name="package_service_duration_<?=$package->id;?>_<?=$data->id;?>" id="package_service_duration_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->service_duration;?>">
                            <input type="hidden" name="package_service_rewards_hidden_<?=$package->id;?>_<?=$data->id;?>" id="package_service_rewards_hidden_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->reward_point;?>">
                            <input type="hidden" name="old_package_service_details_table_id_<?=$package->id;?>_<?=$data->id;?>" id="old_package_service_details_table_id_<?=$package->id;?>_<?=$data->id;?>" value="<?=$old_id;?>">
                        </div>                        
                        <div class="col-md-2 col-sm-12 col-xs-12" id="package_service_product_model_<?=$package->id;?>_<?=$data->id;?>">
                            <button type="button" class="product_model_a" id="package_product_modal_button_<?=$package->id;?>_<?=$data->id;?>" data-toggle="modal" data-target="#PackageProductModal_<?=$package->id;?>_<?=$data->id;?>" onclick="showPopup('PackageProductModal_<?=$package->id;?>_<?=$data->id;?>')">
                                <span id="selected_package_product_<?=$package->id;?>_<?=$data->id;?>">0</span>/<?=($package_products && !empty($package_products)) ? count($package_products) : '0';?>
                            </button>                                 
                            <div class="modal fade" style="background-color: #00000080;" id="PackageProductModal_<?=$package->id;?>_<?=$data->id;?>" tabindex="-1" role="dialog" aria-labelledby="PackageProductModalLabel_<?=$package->id;?>_<?=$data->id;?>" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="margin-top:125px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="PackageProductModalLabel_<?=$package->id;?>_<?=$data->id;?>"><?=$data->service_name;?> Products:</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('PackageProductModal_<?=$package->id;?>_<?=$data->id;?>')">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if(!empty($package_products)){ ?>
                                            <table class="table" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Product</th>
                                                    </tr>
                                                <thead>
                                                <tbody>
                                                <?php 
                                                    if($package_products && !empty($package_products)){
                                                        foreach($package_products as $products_result){                                       
                                                ?>
                                                <tr>
                                                    <th><input disabled class="package_product_checkbox_<?=$package->id;?>_<?=$data->id;?>" onclick="setPackageServiceProduct(<?=$package->id;?>,<?=$data->id;?>,<?=$products_result->id;?>)" type="checkbox" name="package_product_name_check_<?=$package->id;?>_<?=$data->id;?>[]" id="package_product_name_check_<?=$package->id;?>_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$products_result->id;?>"></th>
                                                    <th><?=$products_result->product_name;?></th>
                                                    <input type="hidden" name="package_product_name_hidden_<?=$package->id;?>_<?=$data->id;?>_<?=$products_result->id;?>" id="package_product_name_hidden_<?=$package->id;?>_<?=$data->id;?>_<?=$products_result->id;?>" value="<?=$products_result->product_name;?>">
                                                </tr>
                                                <?php }} ?>
                                                </tbody>
                                            </table>
                                            <?php }else{ ?>
                                                <label class="error">Products not available</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <?php }else{ ?>
                    <label class="error">Services not available</label>
                <?php } ?>
                <!-- <?php if(!empty($products)){ ?>
                <div class="" id="all_package_products_div_<?=$package->id;?>">
                    <h5><b>Package Products</b></h5>
                    <?php 
                        if(!empty($products)){
                            foreach($products as $data){                 
                                if(!empty($active_package_allocation)){    
                                    $product_availability_status = $this->check_customer_package_items_used_status($active_package_allocation->id,$customer_id,$package->id,$data->id,'1');
                                    $is_available = explode('@@',$product_availability_status)[0];
                                    $old_id = explode('@@',$product_availability_status)[1];
                                }else{
                                    $is_available = '1';
                                    $old_id = '';
                                }
                    ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="package_product_<?=$data->id;?>">
                            <input <?php if(!empty($active_package_allocation)){ if($is_available == '1'){ echo ''; }else{ echo 'disabled'; }}else{ echo ''; } ?> onclick="setPackageServiceProduct(<?=$package->id;?>,<?=$data->id;?>)" class="package_product_name_check" type="checkbox" name="package_product_name_check_<?=$package->id;?>[]" id="package_product_name_check_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->id;?>">
                            <div class="selected_service_name package_product_name_t_<?=$package->id;?>_<?=$data->id;?>" id="package_product_name_t_<?=$package->id;?>_<?=$data->id;?>"><?=$data->product_name;?></div>
                            <input type="hidden" name="old_package_product_details_table_id_<?=$package->id;?>_<?=$data->id;?>" id="old_package_product_details_table_id_<?=$package->id;?>_<?=$data->id;?>" value="<?=$old_id;?>">
                            <input type="hidden" name="package_product_name_hidden_<?=$package->id;?>_<?=$data->id;?>" id="package_product_name_hidden_<?=$package->id;?>_<?=$data->id;?>" value="<?=$data->product_name;?>">
                        </div>                        
                    </div>
                    <?php }} ?>
                </div>
                <?php }else{ ?>
                    <label class="error">Products not available</label>
                <?php } ?> -->
            </div>
            <?php
            }
        }else{ ?>
            <label class="error">Please select customer first</label>
        <?php }
    }
    public function get_package_products($package,$service){
        $this->db->where('tbl_package_products.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_package_products.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_package_products.tbl_package_id', $package);
        $this->db->where('tbl_package_products.service_id', $service);
        $single = $this->db->get('tbl_package_products')->row();
        if(!empty($single)){
            $products = explode(',',$single->product_ids);
            $this->db->where_in('id',$products);
            $products = $this->db->get('tbl_product')->result();
            return $products;
        }
        return false;
    }
    public function get_package_products_single($package,$service){
        $this->db->where('tbl_package_products.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_package_products.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_package_products.tbl_package_id', $package);
        $this->db->where('tbl_package_products.service_id', $service);
        $single = $this->db->get('tbl_package_products')->row();
        return $single;
    }
    public function get_booking_rules(){
        $this->db->select('tbl_rules_setup.*');
        $this->db->join('tbl_rules_setup','tbl_rules_setup.id = tbl_branch.salon_type_rules_id');
        $this->db->where('tbl_branch.id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_branch.is_deleted', '0');
        $this->db->where('tbl_rules_setup.is_deleted', '0');
        $single = $this->db->get('tbl_branch')->row();
        return $single;
    }
    public function get_stylist_shifts($date,$exe){
        $booking_rules = $this->get_booking_rules();
        
        $timestamp = strtotime($date);        
        $dayOfWeek = date('l', $timestamp);

        $this->db->where('id', $exe);
        $single = $this->db->get('tbl_salon_employee')->row();

        if(!empty($booking_rules)){
            if(!empty($single)){
                $shift = $single->shift;
                $shift_type = $single->shift_type;

                if($dayOfWeek == 'Monday'){
                    $column = 'is_monday_shift';
                    $from = 'monday_shift_from';
                    $to = 'monday_shift_to';
                    $break_from = 'monday_break_from';
                    $break_to = 'monday_break_to';
                }elseif($dayOfWeek == 'Tuesday'){
                    $column = 'is_tuesday_shift';
                    $from = 'tuesday_shift_from';
                    $to = 'tuesday_shift_to';
                    $break_from = 'tuesday_break_from';
                    $break_to = 'tuesday_break_to';
                }elseif($dayOfWeek == 'Wednesday'){
                    $column = 'is_wednesday_shift';
                    $from = 'wednesday_shift_from';
                    $to = 'wednesday_shift_to';
                    $break_from = 'wednesday_break_from';
                    $break_to = 'wednesday_break_to';
                }elseif($dayOfWeek == 'Thursday'){
                    $column = 'is_thursday_shift';
                    $from = 'thursday_shift_from';
                    $to = 'thursday_shift_to';
                    $break_from = 'thursday_break_from';
                    $break_to = 'thursday_break_to';
                }elseif($dayOfWeek == 'Friday'){
                    $column = 'is_friday_shift';
                    $from = 'friday_shift_from';
                    $to = 'friday_shift_to';
                    $break_from = 'friday_break_from';
                    $break_to = 'friday_break_to';
                }elseif($dayOfWeek == 'Saturday'){
                    $column = 'is_saturday_shift';
                    $from = 'saturday_shift_from';
                    $to = 'saturday_shift_to';
                    $break_from = 'saturday_break_from';
                    $break_to = 'saturday_break_to';
                }elseif($dayOfWeek == 'Sunday'){
                    $column = 'is_sunday_shift';
                    $from = 'sunday_shift_from';
                    $to = 'sunday_shift_to';
                    $break_from = 'sunday_break_from';
                    $break_to = 'sunday_break_to';
                }else{
                    $column = '';
                    $from = '';
                    $to = '';
                    $break_from = '';
                    $break_to = '';
                }

                $this->db->where($column, '1');
                $this->db->where('id',$shift);
                $shift_details = $this->db->get('tbl_shift_master')->row();
                
                if(!empty($shift_details)){
                    $shift_from = $shift_details->$from;
                    $shift_to = $shift_details->$to;
                    $shift_break_from = $shift_details->$break_from;
                    $shift_break_to = $shift_details->$break_to;
                    
                    return array(
                        'shift_from'        =>  $shift_from,
                        'shift_to'          =>  $shift_to,
                        'shift_break_from'  =>  $shift_break_from,
                        'shift_break_to'    =>  $shift_break_to,
                    );
                }else{
                    return array();
                }
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
    public function get_stylistwise_shift_ajx(){
        $shift_details = $this->get_stylist_shifts($this->input->post('date'),$this->input->post('exe'));

        echo json_encode($shift_details);
    }
    public function get_stylist_timeslots_ajx(){
        $booking_rules = $this->get_booking_rules();
        
        $date = $this->input->post('date');
        $exe = $this->input->post('exe');
        $duration = $this->input->post('duration');
        $service_id = $this->input->post('service_id');
        $selected_start = $this->input->post('selected_start');

        if(!empty($booking_rules)){
            if($exe != ""){
                $shift_details = $this->get_stylist_shifts($date,$exe);
                if(!empty($shift_details)){
                    $shift_from = strtotime($shift_details['shift_from']);
                    $shift_to = strtotime($shift_details['shift_to']);
                    $shift_break_from = strtotime($shift_details['shift_break_from']);
                    $shift_break_to = strtotime($shift_details['shift_break_to']);
                    $buffer = $booking_rules->buffering_time;
                    $minutes_early_booking = $booking_rules->booking_time_range;
                    // $interval = $booking_rules->slot_time;
                    $interval = $duration;

                    $slots = $this->generateTimePairs($date,$shift_from,$shift_to,$interval,$buffer,$minutes_early_booking,$shift_break_from,$shift_break_to);
                ?>
                <div class="row timeslot_row">
                <?php
                    for($i=0;$i<count($slots);$i++){
                        $from_slot = date('Y-m-d H:i:s',strtotime($date.' '.$slots[$i]['from']));
                        $to_slot = date('Y-m-d H:i:s',strtotime($date.' '.$slots[$i]['to']));
                        $current_time = date('Y-m-d H:i:s');
                        if($selected_start != ""){
                            $selected_start_formated = date('Y-m-d H:i:s',strtotime($selected_start));
                            if($selected_start_formated <= $from_slot) {
                                if($current_time < $from_slot) {
                                    $is_allowed = '1';
                                }else{
                                    $is_allowed = '0';
                                }
                            }else{
                                $is_allowed = '0';
                            }
                        }else{
                            if($current_time < $from_slot) {
                                $is_allowed = '1';
                            }else{
                                $is_allowed = '0';
                            }
                        }
                        // echo $current_time;
                        if($is_allowed == '1') {
                            $is_available = $this->check_stylist_timeslot_availability($exe,$from_slot,$to_slot);
                ?>
                    <div class="single_timeslot" style="background:<?php if($is_available){ echo '#01a900'; }else{ echo '#ff0000'; } ?>;">
                        <input <?php if($is_available){ echo ''; }else{ echo 'disabled'; } ?> type="radio" class="service_stylist_time_slots_<?=$service_id;?>" name="service_stylist_time_slots_<?=$service_id;?>" id="service_stylist_time_slots_<?=$service_id;?>_<?=$slots[$i]['from'];?>@@@<?=$slots[$i]['to'];?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>@@@<?=date('h:i A',strtotime($slots[$i]['to']));?>">
                        <label><?=date('h:i A',strtotime($slots[$i]['from']));?> to <?=date('h:i A',strtotime($slots[$i]['to']));?></label>
                    </div>
                <?php
                    }}
                ?>
                </div>
                <?php }else{ ?>
                    <div class="col-lg-12">
                        <label class="error">Shift not available for this date</label>
                    </div>
                <?php }
            }else{ ?>
                <div class="col-lg-12">
                    <label class="error">Please select Stylist</label>
                </div>
            <?php }
        }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
        <?php }
    }
    public function get_saloon_working_hrs($date){   
        $timestamp = strtotime($date);        
        $dayOfWeek = date('l', $timestamp);

        $start = '';
        $end ='';
        $is_allowed = 0;

        if($dayOfWeek == 'Monday'){
            $column = 'is_monday';
            $from = 'from_monday';
            $to = 'to_monday';
        }elseif($dayOfWeek == 'Tuesday'){
            $column = 'is_tuesday';
            $from = 'from_tuesday';
            $to = 'to_tuesday';
        }elseif($dayOfWeek == 'Wednesday'){
            $column = 'is_wednesday';
            $from = 'from_wednesday';
            $to = 'to_wednesday';
        }elseif($dayOfWeek == 'Thursday'){
            $column = 'is_thursday';
            $from = 'from_thursday';
            $to = 'to_thursday';
        }elseif($dayOfWeek == 'Friday'){
            $column = 'is_friday';
            $from = 'from_friday';
            $to = 'to_friday';
        }elseif($dayOfWeek == 'Saturday'){
            $column = 'is_saturday';
            $from = 'from_saturday';
            $to = 'to_saturday';
        }elseif($dayOfWeek == 'Sunday'){
            $column = 'is_sunday';
            $from = 'from_sunday';
            $to = 'to_sunday';
        }else{
            $column = '';
            $from = '';
            $to = '';
        }
        $this->db->where($column, '1');
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $working_hrs = $this->db->get('tbl_booking_rules')->row();
        if(!empty($working_hrs)){
            $start = $working_hrs->$from;
            $end = $working_hrs->$to;
            $is_allowed = 1;
        }
        return array('is_allowed'=>$is_allowed,'start'=>$start,'end'=>$end);
    }
    public function generateServiceTimePairs($booking_date, $start_time, $end_time, $duration) {
        $time_pairs = array();
        
        // Get the current date and time
        $current_date = new DateTime();
        
        // Convert start and end times to DateTime objects
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);

        // Validate if start time is before end time
        if ($start >= $end) {
            // Handle invalid input
            return $time_pairs;
        }
        
        // Ensure booking date is today or later
        $booking_date_obj = new DateTime($booking_date);
        if ($booking_date_obj->format('Y-m-d') < $current_date->format('Y-m-d')) {
            // Handle invalid booking date
            return $time_pairs;
        }
        
        // Loop through the time range with the specified duration
        while ($start < $end) {
            // Check if 'from' time is greater than or equal to current time
            if ($start >= $current_date) {
                $to = clone $start;
                $to->add(new DateInterval('PT' . $duration . 'M'));
                
                // Check if 'to' time exceeds the end time
                if ($to > $end) {
                    $to = $end;
                }
                
                // Add current time pair to the array
                $time_pairs[] = array(
                    'from' => $start->format('Y-m-d H:i:s'),
                    'to' => $to->format('Y-m-d H:i:s')
                );
                
                // Move to the next interval
                $start = $to;
            } else {
                // Move to the next interval
                $start->add(new DateInterval('PT' . $duration . 'M'));
            }
        }
        
        return $time_pairs;
    }
    
    public function generateCommonTimePairs($booking_date, $start_time, $end_time, $duration) {
        $time_pairs = array();
        
        // Get the current date and time
        $current_date = new DateTime();
        
        // Convert start and end times to DateTime objects
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);

        // Validate if start time is before end time
        if ($start >= $end) {
            // Handle invalid input
            return $time_pairs;
        }
        
        // Ensure booking date is today or later
        $booking_date_obj = new DateTime($booking_date);
        if ($booking_date_obj->format('Y-m-d') < $current_date->format('Y-m-d')) {
            // Handle invalid booking date
            return $time_pairs;
        }
        
        // Loop through the time range with the specified duration
        while ($start < $end) {
            // Check if 'from' time is greater than or equal to current time
            if ($start >= $current_date) {
                $to = clone $start;
                $to->add(new DateInterval('PT' . $duration . 'M'));
                
                // Check if 'to' time exceeds the end time
                if ($to > $end) {
                    $to = $end;
                }
                
                // Add current time pair to the array
                $time_pairs[] = array(
                    'from' => $start->format('Y-m-d H:i:s'),
                    'to' => $to->format('Y-m-d H:i:s')
                );
                
                // Move to the next interval
                $start = $to;
            } else {
                // Move to the next interval
                $start->add(new DateInterval('PT' . $duration . 'M'));
            }
        }
        
        return $time_pairs;
    }
    
    public function check_stylist_booking_available($stylist, $from_date, $from_time, $to_date, $to_time) {
        $this->db->where('service_status', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('stylist_id', $stylist);
        $this->db->where('DATE(service_date)', date('Y-m-d', strtotime($from_date)));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $bookings = $this->db->get('tbl_booking_services_details')->result();
        
        if (!empty($bookings)) {
            foreach($bookings as $result){
                $from = date('Y-m-d H:i:s',strtotime($result->service_from));
                $to = date('Y-m-d H:i:s',strtotime($result->service_to));
                
                $selected_from = date('Y-m-d H:i:s',strtotime($from_date . ' ' . $from_time));
                $selected_to = date('Y-m-d H:i:s',strtotime($to_date . ' ' . $to_time));

                if(($selected_from >= $from && $selected_from <= $to) || ($selected_to >= $from && $selected_to <= $to)){
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }
    
    public function check_customer_booking_available_reschedule($customer, $from_date, $from_time, $to_date, $to_time) {
        $this->db->where('service_status', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('customer_name', $customer);
        $this->db->where('DATE(service_date)', date('Y-m-d', strtotime($from_date)));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $bookings = $this->db->get('tbl_booking_services_details')->result();
        
        return $bookings;
    }
    
    public function check_stylist_booking_available_reschedule($stylist, $from_date, $from_time, $to_date, $to_time) {
        $this->db->where('service_status', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('stylist_id', $stylist);
        $this->db->where('DATE(service_date)', date('Y-m-d', strtotime($from_date)));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $bookings = $this->db->get('tbl_booking_services_details')->result();
        
        return $bookings;
    }

    // public function check_stylist_booking_available($stylist,$from_date,$from_time,$to_date,$to_time){
    //     $this->db->where('service_status', '0');
    //     $this->db->where('is_deleted', '0');
    //     $this->db->where('stylist_id',$stylist);
    //     $this->db->where('DATE(service_date)',date('Y-m-d',strtotime($from_date)));
    //     $this->db->where('branch_id',$this->session->userdata('branch_id'));
    //     $this->db->where('salon_id',$this->session->userdata('salon_id'));
    //     $bookings = $this->db->get('tbl_booking_services_details')->result();

    //     if(!empty($bookings)){
    //         foreach($bookings as $result){
    //             $booking_service_from = date('Y-m-d H:i:s',strtotime($result->service_from));
    //             $booking_service_to = date('Y-m-d H:i:s',strtotime($result->service_to));

    //             $selected_service_from = date('Y-m-d H:i:s',strtotime($from_date.' ' .$from_time));
    //             $selected_service_to = date('Y-m-d H:i:s',strtotime($to_date.' ' .$to_time));

    //             if(($selected_service_from >= $booking_service_from && $selected_service_from <= $booking_service_to) ||
    //             ($selected_service_to >= $booking_service_from && $selected_service_to <= $booking_service_to)) {
    //                 return true;
    //             }                
    //         }
    //     }else{
    //         return false;
    //     }
    //     return false;
    // }
    public function check_stylist_shift_available($stylist,$date,$time){
        $this->db->where('id', $stylist);
        $single = $this->db->get('tbl_salon_employee')->row();

        if(!empty($single)){
            $shift = $single->shift;
            $shift_type = $single->shift_type;

            $details = $this->get_stylist_shift_details($shift,$shift_type,$date);
            if(!empty($details)){
                $shift_from = date('Y-m-d H:i:s',strtotime($date.' '.$details['shift_from']));
                $shift_to = date('Y-m-d H:i:s',strtotime($date.' '.$details['shift_to']));
                $shift_break_from = date('Y-m-d H:i:s',strtotime($date.' '.$details['shift_break_from']));
                $shift_break_to = date('Y-m-d H:i:s',strtotime($date.' '.$details['shift_break_to']));

                $booking_date_time = date('Y-m-d H:i:s',strtotime($date.' '.$time));

                if ($booking_date_time >= $shift_from && $booking_date_time <= $shift_to) {
                    if ($booking_date_time >= $shift_break_from && $booking_date_time <= $shift_break_to) {
                        return '0@@@break';
                    } else {
                        return '1@@@';
                    }
                } else {
                    return '0@@@'; 
                }
            }else{
                return '0@@@';
            }
        }else{
            return '0@@@';
        }
    }
    public function get_stylist_shift_details($shift_id,$shift_type,$date){        
        $booking_rules = $this->get_booking_rules();
        
        $timestamp = strtotime($date);        
        $dayOfWeek = date('l', $timestamp);

        if(!empty($booking_rules) && $shift_id != "" && $shift_id != null){
            $shift = $shift_id;
            $shift_type = $shift_type;

            if($dayOfWeek == 'Monday'){
                $column = 'is_monday_shift';
                $from = 'monday_shift_from';
                $to = 'monday_shift_to';
                $break_from = 'monday_break_from';
                $break_to = 'monday_break_to';
            }elseif($dayOfWeek == 'Tuesday'){
                $column = 'is_tuesday_shift';
                $from = 'tuesday_shift_from';
                $to = 'tuesday_shift_to';
                $break_from = 'tuesday_break_from';
                $break_to = 'tuesday_break_to';
            }elseif($dayOfWeek == 'Wednesday'){
                $column = 'is_wednesday_shift';
                $from = 'wednesday_shift_from';
                $to = 'wednesday_shift_to';
                $break_from = 'wednesday_break_from';
                $break_to = 'wednesday_break_to';
            }elseif($dayOfWeek == 'Thursday'){
                $column = 'is_thursday_shift';
                $from = 'thursday_shift_from';
                $to = 'thursday_shift_to';
                $break_from = 'thursday_break_from';
                $break_to = 'thursday_break_to';
            }elseif($dayOfWeek == 'Friday'){
                $column = 'is_friday_shift';
                $from = 'friday_shift_from';
                $to = 'friday_shift_to';
                $break_from = 'friday_break_from';
                $break_to = 'friday_break_to';
            }elseif($dayOfWeek == 'Saturday'){
                $column = 'is_saturday_shift';
                $from = 'saturday_shift_from';
                $to = 'saturday_shift_to';
                $break_from = 'saturday_break_from';
                $break_to = 'saturday_break_to';
            }elseif($dayOfWeek == 'Sunday'){
                $column = 'is_sunday_shift';
                $from = 'sunday_shift_from';
                $to = 'sunday_shift_to';
                $break_from = 'sunday_break_from';
                $break_to = 'sunday_break_to';
            }else{
                $column = '';
                $from = '';
                $to = '';
                $break_from = '';
                $break_to = '';
            }

            $this->db->where($column, '1');
            $this->db->where('id',$shift);
            $shift_details = $this->db->get('tbl_shift_master')->row();
            
            if(!empty($shift_details)){
                $shift_from = $shift_details->$from;
                $shift_to = $shift_details->$to;
                $shift_break_from = $shift_details->$break_from;
                $shift_break_to = $shift_details->$break_to;
                
                return array(
                    'shift_from'        =>  $shift_from,
                    'shift_to'          =>  $shift_to,
                    'shift_break_from'  =>  $shift_break_from,
                    'shift_break_to'    =>  $shift_break_to,
                );
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
    
    
    
    public function get_all_salon_employee_datewise($date)
    {       
        // Get today's date
        $today_date = $date;

        // Select the necessary columns and join with tbl_emp_designation
        $this->db->select('tbl_salon_employee.*, tbl_emp_designation.designation');
        $this->db->join('tbl_emp_designation', 'tbl_salon_employee.designation = tbl_emp_designation.id', 'left');

        // Filter based on branch, salon, and not deleted
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_employee.is_deleted', '0');

        // Order by id in descending order
        $this->db->order_by('id', 'DESC');

        // Get all salon employees
        $salon_employees = $this->db->get('tbl_salon_employee')->result();

        // Initialize an array to store the sorted employees
        $sorted_employees = array();

        // Loop through each salon employee
        foreach ($salon_employees as $employee) {
            // Count the number of services for the stylist for today's date
            $this->db->where('stylist_id', $employee->id);
            $this->db->where('service_date', $today_date);
            $services_count = $this->db->count_all_results('tbl_booking_services_details');

            // Add the count as a new property to the employee object
            $employee->services_count_today = $services_count;

            // Add the employee to the sorted array
            $sorted_employees[$employee->id] = $employee;
        }

        // Sort the array based on the services count for today in asending order
        usort($sorted_employees, function($a, $b) {
            return $a->services_count_today - $b->services_count_today;
        });

        return $sorted_employees;
    }
    public function get_available_stylists_servicewise_ajx(){
        $service = $this->input->post('service');

        $selectedTimeSlot = $this->input->post('selectedTimeSlot');
        $selectedfrom = date('Y-m-d H:i:s',strtotime(explode('@@@',$selectedTimeSlot)[0]));
        $selectedto = date('Y-m-d H:i:s',strtotime(explode('@@@',$selectedTimeSlot)[1]));

        $selected_from_date = date('Y-m-d',strtotime($selectedfrom));

		$salon_employee_list = $this->get_all_salon_employee_datewise($selected_from_date);

        $custom_array = array();
        if(!empty($salon_employee_list)){
            foreach($salon_employee_list as $result){
                $break_flag = '1';
                $shift_flag = '0';
                $store_flag = '0';
                $booking_flag = '1';
                $is_service_available = '0';
                
                $stylist_services = explode(',',$result->service_name);
                if(in_array($service,$stylist_services)){
                    $is_service_available = '1';
                }

                $is_stylist_available_storewise = $this->get_is_selected_booking_available_storewise($selectedfrom,$selectedto);
                if($is_stylist_available_storewise){
                    $store_flag = '1';
                }

                $is_stylist_available_shiftwise = $this->get_is_selected_stylist_available_shiftwise($result->id,$selectedfrom,$selectedto);
                if($is_stylist_available_shiftwise){
                    $shift_flag = '1';
                }

                $is_stylist_available_breakwise = $this->get_is_selected_stylist_available_breakwise($result->id,$selectedfrom,$selectedto);
                if($is_stylist_available_breakwise){
                    $break_flag = '0';
                }

                $is_stylist_available_bookingwise = $this->get_is_selected_stylist_available_bookingwise($result->id,$selectedfrom,$selectedto);
                if($is_stylist_available_bookingwise){
                    $booking_flag = '0';
                }

                $custom_array[] = array(
                    'selectedTimeSlot'      =>  $selectedTimeSlot,
                    'is_service_available'  =>  $is_service_available,
                    'is_shift_available'    =>  $shift_flag,
                    'is_on_break'           =>  $break_flag,
                    'is_booking_present'    =>  $booking_flag,
                    'store_flag'            =>  $store_flag,
                    'stylist_details'       =>  $result,
                );
            }
        }

        echo json_encode($custom_array);
    }
    public function get_available_stylists_servicewise_reschedule_ajx(){
        $booking_details_id = $this->input->post('booking_details_id');
        $selectedTimeSlot = $this->input->post('selectedTimeSlot');

        $this->db->where('id',$booking_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();

        $custom_array = array();

        if(!empty($single)){
            $service = $single->service_id;
            $customer_name = $single->customer_name;
            
            $selectedfrom = date('Y-m-d H:i:s',strtotime(explode('@@@',$selectedTimeSlot)[0]));
            $selectedto = date('Y-m-d H:i:s',strtotime(explode('@@@',$selectedTimeSlot)[1]));

            $selected_from_date = date('Y-m-d',strtotime($selectedfrom));
            $selected_from_time = date('H:i:s',strtotime($selectedfrom));
            $selected_to_date = date('Y-m-d',strtotime($selectedto));
            $selected_to_time = date('H:i:s',strtotime($selectedto));

            $salon_employee_list = $this->get_all_salon_employee_datewise($selected_from_date);

            if(!empty($salon_employee_list)){
                foreach($salon_employee_list as $result){
                    $break_flag = '0';
                    $shift_flag = '0';
                    $booking_flag = '0';
                    $is_service_available = '0';
                    $is_customer_booking_present_flag = '0';
                    
                    $stylist_services = explode(',',$result->service_name);
                    if(in_array($service,$stylist_services)){
                        $is_service_available = '1';
                    }

                    $is_shift_available = $this->check_stylist_shift_available($result->id,$selected_from_date,$selected_from_time);
                    $shift_status = explode('@@@',$is_shift_available)[0];
                    $shift_type = explode('@@@',$is_shift_available)[1];
                    if($shift_status == '1'){
                        $shift_flag = '1';
                    }else{
                        if($shift_type == 'break'){
                            $break_flag = '1';
                        }
                    }

                    $is_booking_present = $this->check_stylist_booking_available_reschedule($result->id,$selected_from_date,$selected_from_time,$selected_to_date,$selected_to_time);
                    if(!empty($is_booking_present)){
                        foreach($is_booking_present as $booking_result){
                            $from = date('Y-m-d H:i:s',strtotime($booking_result->service_from));
                            $to = date('Y-m-d H:i:s',strtotime($booking_result->service_to));
                            
                            $selected_from = date('Y-m-d H:i:s',strtotime($selected_from_date . ' ' . $selected_from_time));
                            $selected_to = date('Y-m-d H:i:s',strtotime($selected_to_date . ' ' . $selected_to_time));

                            if(($selected_from >= $from && $selected_from <= $to) || ($selected_to >= $from && $selected_to <= $to)){
                                if($booking_result->id == $booking_details_id){
                                    $booking_flag = '0';
                                }else{
                                    $booking_flag = '1';
                                    break;
                                }
                            }
                        }
                    }

                    $is_customer_booking_present = $this->check_customer_booking_available_reschedule($customer_name,$selected_from_date,$selected_from_time,$selected_to_date,$selected_to_time);
                    if(!empty($is_customer_booking_present)){
                        foreach($is_customer_booking_present as $booking_result){
                            $from = date('Y-m-d H:i:s',strtotime($booking_result->service_from));
                            $to = date('Y-m-d H:i:s',strtotime($booking_result->service_to));
                            
                            $selected_from = date('Y-m-d H:i:s',strtotime($selected_from_date . ' ' . $selected_from_time));
                            $selected_to = date('Y-m-d H:i:s',strtotime($selected_to_date . ' ' . $selected_to_time));

                            if(($selected_from >= $from && $selected_from <= $to) || ($selected_to >= $from && $selected_to <= $to)){
                                if($booking_result->id == $booking_details_id){
                                    $is_customer_booking_present_flag = '0';
                                }else{
                                    $is_customer_booking_present_flag = '1';
                                    break;
                                }
                            }
                        }
                    }

                    $custom_array[] = array(
                        'is_service_available'  =>  $is_service_available,
                        'is_shift_available'    =>  $shift_flag,
                        'is_on_break'           =>  $break_flag,
                        'is_booking_present'    =>  $booking_flag,
                        'is_customer_booking_present'    =>  $is_customer_booking_present_flag,
                        'stylist_details'       =>  $result,
                    );
                }
            }
        }
        // echo '<pre>'; print_r($custom_array);

        echo json_encode($custom_array);
    }
    
    public function get_service_timeslots_ajx(){        
        $date = date('Y-m-d',strtotime($this->input->post('date')));
        $duration = $this->input->post('duration');
        $service_id = $this->input->post('service_id');

        $selected_start = date('Y-m-d H:i:s',strtotime($this->input->post('selected_start')));
        $selected_end = date('Y-m-d H:i:s',strtotime($this->input->post('selected_end')));
        // $selected_end = date('Y-m-d H:i:s', strtotime($selected_start . ' +' . $duration . ' minutes'));
        ?>
        <div class="row timeslot_row">
            <div class="single_timeslot" style="display: inline-block;padding: 5px 5px !important;">
                <input type="radio" class="stylists_timeslots_<?=$service_id;?> service_stylist_time_slots_<?=$service_id;?>" name="service_stylist_time_slots_<?=$service_id;?>" id="service_stylist_time_slots_<?=$service_id;?>" value="<?=date('Y-m-d H:i:s',strtotime($selected_start));?>@@@<?=date('Y-m-d H:i:s',strtotime($selected_end));?>" onchange="setStylist(this, '<?=$service_id;?>')">
                <label><?=date('h:i A',strtotime($selected_start));?> to <?=date('h:i A',strtotime($selected_end));?></label>
            </div>
        </div>
        <?php
    }
    public function get_service_timeslot_stylists_ajx(){        
        $date = date('Y-m-d',strtotime($this->input->post('date')));
        $duration = $this->input->post('duration');
        $service_id = $this->input->post('service_id');

        $selected_start = date('Y-m-d H:i:s',strtotime($this->input->post('selected_start')));
        $selected_end = date('Y-m-d H:i:s', strtotime($selected_start . ' +' . $duration . ' minutes'));
        ?>
        <div class="row timeslot_row">
            <div class="single_timeslot" style="display: inline-block;padding: 5px 5px !important;">
                <input type="radio" class="stylists_timeslots_<?=$service_id;?> service_stylist_time_slots_<?=$service_id;?>" name="service_stylist_time_slots_<?=$service_id;?>" id="service_stylist_time_slots_<?=$service_id;?>" value="<?=date('Y-m-d H:i:s',strtotime($selected_start));?>@@@<?=date('Y-m-d H:i:s',strtotime($selected_end));?>" onchange="setStylist(this, '<?=$service_id;?>')">
                <label><?=date('h:i A',strtotime($selected_start));?> to <?=date('h:i A',strtotime($selected_end));?></label>
            </div>
        </div>
        <?php
    }
    
    public function get_stylist_reschedule_timeslots_updated_ajx(){    
        $booking_rules = $this->get_booking_rules();
        
        $date = date('Y-m-d',strtotime($this->input->post('date')));
        $duration = $this->input->post('duration');
        $booking_details_id = $this->input->post('booking_details_id');
        if(!empty($booking_rules)){
            $working_hrs = $this->get_saloon_working_hrs($date);
            if($working_hrs['is_allowed'] == 1){
                $minutes_early_booking = !empty($booking_rules->booking_time_range) ? $booking_rules->booking_time_range : 0;

                $store_start = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['start']));
                $store_end = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['end']));
                $slots = $this->generateServiceTimePairs($date,$store_start,$store_end,$duration);                
                ?>
                <div class="row timeslot_row" style="justify-content: center;">
                <?php
                    for($i=0;$i<count($slots);$i++){
                        $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slots[$i]['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                        $current_date = date('Y-m-d H:i:s');
                        if ($current_date <= $allowed_booking_datetime) {
                            $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s',strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s',strtotime($slots[$i]['from']));
                            if(date('Y-m-d H:i:s',strtotime($slots[$i]['from'])) >= $selected_start){
                ?>
                    <div class="single_timeslot">
                        <input type="radio" class="stylists_timeslots_<?=$booking_details_id;?> service_stylist_time_slots_<?=$booking_details_id;?>" name="service_stylist_time_slots_<?=$booking_details_id;?>" id="service_stylist_time_slots_<?=$booking_details_id;?>" value="<?=date('Y-m-d H:i:s',strtotime($slots[$i]['from']));?>@@@<?=date('Y-m-d H:i:s',strtotime($slots[$i]['to']));?>" onchange="setStylist(this, '<?=$booking_details_id;?>')">
                        <label><?=date('h:i A',strtotime($slots[$i]['from']));?> to <?=date('h:i A',strtotime($slots[$i]['to']));?></label>
                    </div>
                <?php }}}} ?>
                </div>
            <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
            <?php }
    }
    public function get_stylist_reschedule_timeslots_ajx(){
        $booking_rules = $this->get_booking_rules();
        
        $date = $this->input->post('date');
        $exe = $this->input->post('exe');
        $duration = $this->input->post('duration');
        $booking_details_id = $this->input->post('booking_details_id');
        if(!empty($booking_rules)){
            if($exe != ""){
                $shift_details = $this->get_stylist_shifts($date,$exe);
                if(!empty($shift_details)){
                    $shift_from = strtotime($shift_details['shift_from']);
                    $shift_to = strtotime($shift_details['shift_to']);
                    $shift_break_from = strtotime($shift_details['shift_break_from']);
                    $shift_break_to = strtotime($shift_details['shift_break_to']);
                    $buffer = $booking_rules->buffering_time;
                    $minutes_early_booking = $booking_rules->booking_time_range;
                    // $interval = $booking_rules->slot_time;
                    $interval = $duration;

                    $slots = $this->generateTimePairs($date,$shift_from,$shift_to,$interval,$buffer,$minutes_early_booking,$shift_break_from,$shift_break_to);
                
                ?>
                <div class="row timeslot_row" style="justify-content: center;">
                <?php
                    for($i=0;$i<count($slots);$i++){
                        $from_slot = date('Y-m-d H:i:s',strtotime($date.' '.$slots[$i]['from']));
                        $to_slot = date('Y-m-d H:i:s',strtotime($date.' '.$slots[$i]['to']));
                        $current_time = date('Y-m-d H:i:s');

                        if($current_time < $from_slot) {
                            $is_allowed = '1';
                        }else{
                            $is_allowed = '0';
                        }
                        if($is_allowed == '1') {
                            $is_available = $this->check_stylist_timeslot_availability_reschedule($exe,$from_slot,$to_slot,$booking_details_id);
                ?>
                    <div class="single_timeslot" style="width:19%;background:<?php if(empty($is_available)){ echo '#01a900'; }else{ if($is_available->id == $booking_details_id){ echo '#01a900'; }else{ echo '#ff0000'; }} ?>;">
                        <input <?php if(empty($is_available)){ echo ''; }else{ if($is_available->id == $booking_details_id){ echo 'checked';}else{ echo 'disabled'; }} ?> type="radio" name="service_stylist_time_slots_<?=$booking_details_id;?>" id="service_stylist_time_slots_<?=$booking_details_id;?>_<?=$slots[$i]['from'];?>@@@<?=$slots[$i]['to'];?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>@@@<?=date('h:i A',strtotime($slots[$i]['to']));?>">
                        <label style="font-size:10px;"><?=date('h:i A',strtotime($slots[$i]['from']));?> to <?=date('h:i A',strtotime($slots[$i]['to']));?></label>
                    </div>
                <?php
                    }}
                ?>
                </div>
                <?php }else{ ?>
                    <div class="col-lg-12">
                        <label class="error">Shift not available for this date</label>
                    </div>
                <?php }
            }else{ ?>
                <div class="col-lg-12">
                    <label class="error">Please select Stylist</label>
                </div>
            <?php }
        }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
        <?php }
    }
    public function reschedule_service($service_details_id){
        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            $time_slot = $this->input->post('service_stylist_timeslot_hidden_' . $service_details_id);
            $service_from = explode('@@@',$time_slot)[0];
            $service_to = explode('@@@',$time_slot)[1];
            $service_date = $this->input->post('service_date_' . $service_details_id);
            $service_executive = $this->input->post('service_executive_' . $service_details_id);

            $old_service_from = $single->service_from;
            $old_service_to = $single->service_to;
            $old_service_executive = $single->stylist_id;

            $data = array(
                'stylist_id'        =>  $service_executive,
                'service_date'      =>  date('Y-m-d',strtotime($service_date)),
                'service_from'    	=>  date('Y-m-d H:i:s',strtotime($service_from)),
                'service_to'    	=>  date('Y-m-d H:i:s',strtotime($service_to)),
            );
            // echo '<pre>'; print_r($data); exit;
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$data);
            
            if($single->service_added_from == '1'){
                $this->db->where('allocated_in_booking_id',$single->booking_id);
                $this->db->where('customer_name',$single->customer_name);
                $package_allocation = $this->db->get('tbl_customer_package_allocations')->row();
                if(!empty($package_allocation)){
                    $this->db->where('customer_name',$package_allocation->customer_name);
                    $this->db->where('pacakge_id',$package_allocation->package_id);
                    $this->db->where('added_in_booking_id',$single->booking_id);
                    $this->db->where('allocation_id',$package_allocation->id);
                    $this->db->where('item_id',$single->service_id);
                    $this->db->where('item_type','0');
                    $package_allocation_details = $this->db->get('tbl_booking_package_detail_status')->row();
                    if(!empty($package_allocation_details)){
                        $update_data = array(
                            'service_date'      =>  date('Y-m-d',strtotime($service_date)),
                            'service_from'    	=>  date('Y-m-d H:i:s',strtotime($service_from)),
                            'service_to'    	=>  date('Y-m-d H:i:s',strtotime($service_to)),
                        );
                        $this->db->where('id',$package_allocation_details->id);
                        $this->db->update('tbl_booking_package_detail_status',$update_data);
                    }
                }
            }

            $reschedule_data = array(
                'customer_id'       =>  $single->customer_name,
                'branch_id'         =>  $single->branch_id,
                'salon_id'          =>  $single->salon_id,
                'booking_id'        =>  $single->booking_id,
                'service_details_id'=>  $single->id,
                'service_id'        =>  $single->service_id,
                'old_details'       =>  date('Y-m-d H:i:s',strtotime($old_service_from)).'@@@'.date('Y-m-d H:i:s',strtotime($old_service_to)).'@@@'.$old_service_executive,
                'new_details'       =>  date('Y-m-d H:i:s',strtotime($service_from)).'@@@'.date('Y-m-d H:i:s',strtotime($service_to)).'@@@'.$service_executive,
                'created_on'        =>  date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_customer_rescheduled_bookings',$reschedule_data);

            return true;
        }else{
            return false;
        }
    }
    public function reschedule_service_ajx(){
        $service_details_id = $this->input->post('booking_service_details_id');
        $service_date = $this->input->post('service_date');
        $service_executive = $this->input->post('service_executive');
        $service_stylist_timeslot_hidden = $this->input->post('service_stylist_timeslot_hidden');

        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            $time_slot = $service_stylist_timeslot_hidden;
            $service_from = explode('@@@',$time_slot)[0];
            $service_to = explode('@@@',$time_slot)[1];
            $service_date = $service_date;
            $service_executive = $service_executive;

            $old_service_from = $single->service_from;
            $old_service_to = $single->service_to;
            $old_service_executive = $single->stylist_id;

            $data = array(
                'stylist_id'        =>  $service_executive,
                'service_date'      =>  date('Y-m-d',strtotime($service_date)),
                'service_from'    	=>  date('Y-m-d H:i:s',strtotime($service_from)),
                'service_to'    	=>  date('Y-m-d H:i:s',strtotime($service_to)),
            );
            // echo '<pre>'; print_r($data); exit;
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$data);
            
            if($single->service_added_from == '1'){
                $this->db->where('allocated_in_booking_id',$single->booking_id);
                $this->db->where('customer_name',$single->customer_name);
                $package_allocation = $this->db->get('tbl_customer_package_allocations')->row();
                if(!empty($package_allocation)){
                    $this->db->where('customer_name',$package_allocation->customer_name);
                    $this->db->where('pacakge_id',$package_allocation->package_id);
                    $this->db->where('added_in_booking_id',$single->booking_id);
                    $this->db->where('allocation_id',$package_allocation->id);
                    $this->db->where('item_id',$single->service_id);
                    $this->db->where('item_type','0');
                    $package_allocation_details = $this->db->get('tbl_booking_package_detail_status')->row();
                    if(!empty($package_allocation_details)){
                        $update_data = array(
                            'service_date'      =>  date('Y-m-d',strtotime($service_date)),
                            'service_from'    	=>  date('Y-m-d H:i:s',strtotime($service_from)),
                            'service_to'    	=>  date('Y-m-d H:i:s',strtotime($service_to)),
                        );
                        $this->db->where('id',$package_allocation_details->id);
                        $this->db->update('tbl_booking_package_detail_status',$update_data);
                    }
                }
            }

            $reschedule_data = array(
                'customer_id'       =>  $single->customer_name,
                'branch_id'         =>  $single->branch_id,
                'salon_id'          =>  $single->salon_id,
                'booking_id'        =>  $single->booking_id,
                'service_details_id'=>  $single->id,
                'service_id'        =>  $single->service_id,
                'old_details'       =>  date('Y-m-d H:i:s',strtotime($old_service_from)).'@@@'.date('Y-m-d H:i:s',strtotime($old_service_to)).'@@@'.$old_service_executive,
                'new_details'       =>  date('Y-m-d H:i:s',strtotime($service_from)).'@@@'.date('Y-m-d H:i:s',strtotime($service_to)).'@@@'.$service_executive,
                'created_on'        =>  date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_customer_rescheduled_bookings',$reschedule_data);

            echo '1';
        }else{
            echo '0';
        }
    }
    public function complete_service_ajx(){
        $service_details_id = $this->input->post('booking_service_details_id');
        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            $details_data = array(
                'service_status'    =>  '1',
                'completed_on'      =>  date("Y-m-d H:i:s")
            );
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$details_data);

            echo '1';
        }else{
            echo '0';
        }
    }
    public function complete_booking_service($service_details_id){
        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            // $payment_date = date('Y-m-d',strtotime($this->input->post('payment_date_' . $service_details_id)));
            // $payment_mode = $this->input->post('payment_mode_' . $service_details_id);

            // if($single->payment_status == '0'){
            //     $data = array(
            //         'payment_date'      =>  $payment_date,
            //         'payment_mode'      =>  $payment_mode,
            //         'payment_status'    =>  '1',
            //     );
            //     $this->db->where('id',$single->booking_id);
            //     $this->db->update('tbl_new_booking',$data);

            //     $details_all_data = array(
            //         'payment_date'      =>  $payment_date,
            //         'payment_mode'      =>  $payment_mode,
            //         'payment_status'    =>  '1',
            //     );
            //     $this->db->where('booking_id',$single->booking_id);
            //     $this->db->update('tbl_booking_services_details',$details_all_data);
            // }

            $details_data = array(
                'service_status'    =>  '1',
                'completed_on'      =>  date("Y-m-d H:i:s")
            );
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$details_data);

            return '1@@'.$single->booking_id;
        }else{
            return '0@@'.$single->booking_id;
        }
    }
    
    public function cancel_booking_service($service_details_id){
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules) && $booking_rules->reward_point_cancellation == "1"){
            $servicewise_cancellation = 1;
        }else{
            $servicewise_cancellation = 0;
        }

        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            $data = array(
                'service_status'    =>  '2',
                'cancel_remark'     =>  $this->input->post('remark_' . $service_details_id),
                'cancelled_on'      =>  date("Y-m-d H:i:s")
            );
            // echo '<pre>'; print_r($data); exit;
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$data);
            
            if($single->service_added_from == '1'){
                $this->db->where('allocated_in_booking_id',$single->booking_id);
                $this->db->where('customer_name',$single->customer_name);
                $package_allocation = $this->db->get('tbl_customer_package_allocations')->row();
                if(!empty($package_allocation)){
                    $this->db->where('customer_name',$package_allocation->customer_name);
                    $this->db->where('pacakge_id',$package_allocation->package_id);
                    $this->db->where('added_in_booking_id',$single->booking_id);
                    $this->db->where('allocation_id',$package_allocation->id);
                    $this->db->where('item_id',$single->service_id);
                    $this->db->where('item_type','0');
                    $package_allocation_details = $this->db->get('tbl_booking_package_detail_status')->row();
                    if(!empty($package_allocation_details)){
                        $update_data = array(
                            'used_status'               =>  '0',
                            'item_used_in_booking_id'   =>  null,
                            'service_date'              =>  null,
                            'service_from'              =>  null,
                            'service_to'                =>  null,
                        );
                        $this->db->where('id',$package_allocation_details->id);
                        $this->db->update('tbl_booking_package_detail_status',$update_data);
                    }
                }
            }

            if(!empty($booking_rules) && $servicewise_cancellation == 1){
                if($single->service_reward_points != "" && $single->service_reward_points != null){
                    $deduct_rewards = $single->service_reward_points;
                }else{
                    $deduct_rewards = 0;
                }
                $this->db->where('branch_id',$single->branch_id);
                $this->db->where('salon_id',$single->salon_id);
                $this->db->where('id',$single->customer_name);
                $customer = $this->db->get('tbl_salon_customer')->row();
                if(!empty($customer)){
                    $pre_balance = $customer->rewards_balance;
                    $rewards = $deduct_rewards;
                    $new_balance = $pre_balance - $rewards;

                    $reward_data = array(
                        'customer_id'                   =>  $single->customer_name,
                        'branch_id'                     =>  $single->branch_id,
                        'salon_id'                      =>  $single->salon_id,
                        'booking_id'                    =>  $single->booking_id,
                        'rewards_for'                   =>  ($single->service_added_from == "1") ? '1' : '0',
                        'for_service'                   =>  $single->service_id,
                        'booking_service_details_id'    =>  $single->id,
                        'transaction_type'              =>  '1',
                        'remark'                        =>  'Reward points deducted because of service cancellation',
                        'previous_reward_balance'       =>  $pre_balance,
                        'reward_value'                  =>  $rewards,
                        'new_reward_balance'            =>  $new_balance,
                        'created_on'                    =>  date("Y-m-d H:i:s")
                    );
                    $this->db->insert('tbl_customer_rewards_history',$reward_data);

                    $this->db->where('id',$customer->id);
                    $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                }
            }
            return true;
        }else{
            return false;
        }
    }
    public function cancel_service_ajx(){
        $service_details_id = $this->input->post('booking_service_details_id');
        $remark = $this->input->post('remark');
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules) && $booking_rules->reward_point_cancellation == "1"){
            $servicewise_cancellation = 1;
        }else{
            $servicewise_cancellation = 0;
        }

        $this->db->where('id',$service_details_id);
        $single = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single)){
            $data = array(
                'service_status'    =>  '2',
                'cancel_remark'     =>  $remark,
                'cancelled_on'      =>  date("Y-m-d H:i:s")
            );
            // echo '<pre>'; print_r($data); exit;
            $this->db->where('id',$service_details_id);
            $this->db->update('tbl_booking_services_details',$data);
            
            if($single->service_added_from == '1'){
                $this->db->where('allocated_in_booking_id',$single->booking_id);
                $this->db->where('customer_name',$single->customer_name);
                $package_allocation = $this->db->get('tbl_customer_package_allocations')->row();
                if(!empty($package_allocation)){
                    $this->db->where('customer_name',$package_allocation->customer_name);
                    $this->db->where('pacakge_id',$package_allocation->package_id);
                    $this->db->where('added_in_booking_id',$single->booking_id);
                    $this->db->where('allocation_id',$package_allocation->id);
                    $this->db->where('item_id',$single->service_id);
                    $this->db->where('item_type','0');
                    $package_allocation_details = $this->db->get('tbl_booking_package_detail_status')->row();
                    if(!empty($package_allocation_details)){
                        $update_data = array(
                            'used_status'               =>  '0',
                            'item_used_in_booking_id'   =>  null,
                            'service_date'              =>  null,
                            'service_from'              =>  null,
                            'service_to'                =>  null,
                        );
                        $this->db->where('id',$package_allocation_details->id);
                        $this->db->update('tbl_booking_package_detail_status',$update_data);
                    }
                }
            }

            if(!empty($booking_rules) && $servicewise_cancellation == 1){
                if($single->service_reward_points != "" && $single->service_reward_points != null){
                    $deduct_rewards = $single->service_reward_points;
                }else{
                    $deduct_rewards = 0;
                }
                $this->db->where('branch_id',$single->branch_id);
                $this->db->where('salon_id',$single->salon_id);
                $this->db->where('id',$single->customer_name);
                $customer = $this->db->get('tbl_salon_customer')->row();
                if(!empty($customer)){
                    $pre_balance = $customer->rewards_balance;
                    $rewards = $deduct_rewards;
                    $new_balance = $pre_balance - $rewards;

                    $reward_data = array(
                        'customer_id'                   =>  $single->customer_name,
                        'branch_id'                     =>  $single->branch_id,
                        'salon_id'                      =>  $single->salon_id,
                        'booking_id'                    =>  $single->booking_id,
                        'rewards_for'                   =>  ($single->service_added_from == "1") ? '1' : '0',
                        'for_service'                   =>  $single->service_id,
                        'booking_service_details_id'    =>  $single->id,
                        'transaction_type'              =>  '1',
                        'remark'                        =>  'Reward points deducted because of service cancellation',
                        'previous_reward_balance'       =>  $pre_balance,
                        'reward_value'                  =>  $rewards,
                        'new_reward_balance'            =>  $new_balance,
                        'created_on'                    =>  date("Y-m-d H:i:s")
                    );
                    $this->db->insert('tbl_customer_rewards_history',$reward_data);

                    $this->db->where('id',$customer->id);
                    $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                }
            }
            echo '1';
        }else{
            echo '0';
        }
    }
    function check_stylist_timeslot_availability($stylist,$slot_from,$slot_to){
        $this->db->where('is_deleted','0');
        $this->db->where('service_status','0');
        $this->db->where('stylist_id',$stylist);
        $result = $this->db->get('tbl_booking_services_details')->result();

        if(!empty($result)){
            foreach($result as $data){
                $service_from = date('Y-m-d H:i:s', strtotime($data->service_from));
                $service_to = date('Y-m-d H:i:s', strtotime($data->service_to));
                $slot_from = date('Y-m-d H:i:s', strtotime($slot_from));
                $slot_to = date('Y-m-d H:i:s', strtotime($slot_from));

                if(($service_from <= $slot_from && $service_to >= $slot_from) || ($service_from <= $slot_to && $service_to >= $slot_to)){
                    return false;
                }
            }
        }else{
            return true;
        }
        return true;
    }
    
    function check_stylist_timeslot_availability_reschedule($stylist,$slot_from,$slot_to,$booking_details_id){
        $this->db->where('is_deleted','0');
        $this->db->where('service_status','0');
        $this->db->where('stylist_id',$stylist);
        $result = $this->db->get('tbl_booking_services_details')->result();

        if(!empty($result)){
            foreach($result as $data){
                $service_from = date('Y-m-d H:i:s', strtotime($data->service_from));
                $service_to = date('Y-m-d H:i:s', strtotime($data->service_to));
                $slot_from = date('Y-m-d H:i:s', strtotime($slot_from));
                $slot_to = date('Y-m-d H:i:s', strtotime($slot_from));

                if(($service_from <= $slot_from && $service_to >= $slot_from) || ($service_from <= $slot_to && $service_to >= $slot_to)){
                    return $data;
                }
            }
        }else{
            return array();
        }
        return array();
    }
    function generateTimePairs($booking_date, $shift_from, $shift_to, $duration, $buffer, $minutes_early_booking, $break_from, $break_to) {
        $current_time = $shift_from;
        $time_pairs = array();

        while ($current_time < $shift_to) {
            $time_difference = 0;

            // Check if current time is within break period
            $current_hour = date('H', $current_time);
            $current_minute = date('i', $current_time);
            $break_from_hour = date('H', $break_from);
            $break_from_minute = date('i', $break_from);
            $break_to_hour = date('H', $break_to);
            $break_to_minute = date('i', $break_to);
    
            if (
                ($current_hour >= $break_from_hour && $current_hour <= $break_to_hour) &&
                ($current_minute >= $break_from_minute && $current_minute <= $break_to_minute)
            ) {
                // Skip generating time slot during break period
                $current_time = strtotime('+1 minute', $break_to);
                continue;
            }
    
            // Check if adding service duration exceeds shift end time
            $next_time = strtotime('+' . $duration . ' minutes', $current_time);
            
            if ($next_time > $shift_to) {
                // Adjust next time to not exceed shift end time
                $next_time = $shift_to;
            }
    
            // $time_pairs[] = array(
            //     'from' => date('H:i', $current_time),
            //     'to' => date('H:i', $next_time)
            // );

            $running_timestamp = time(); // Current timestamp
            $current_time_timestamp = strtotime($booking_date . ' ' . date('H:i', $current_time));

            $time_difference = $current_time_timestamp - $running_timestamp;

            $early_booking_seconds = $minutes_early_booking * 60;

            if ($time_difference >= $early_booking_seconds) {
                $time_pairs[] = array(
                    'from'  => date('H:i', $current_time),
                    'to'    => date('H:i', $next_time)
                );
            }
    
            // Move to the next pair
            $current_time = strtotime('+'.$buffer.' minute', $next_time);
        }
    
        return $time_pairs;
    }  
    public function check_giftcard_ajx(){
        $code = $this->input->post('code');
        $customer = $this->input->post('customer');
        $booking_id = $this->input->post('booking_id');

        $this->db->where('gift_card_code',$code);
        $this->db->where('is_deleted','0');
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $result = $this->db->get('tbl_gift_card')->row();
        $custom_array = array();
        $giftcard_services = array();

        if(!empty($result)){
            $used_customers = explode(',',$result->used_by_customers);
    
            $customer_ids = array_map(function($used_customers) {
                return explode('@@@', $used_customers)[0];
            }, $used_customers);  
            $customer_ids = array_values(array_filter($customer_ids));
            
            if($booking_id != ''){
                $booking_ids = array_map(function ($used_customers) use ($booking_id) {
                    $parts = explode('@@@', $used_customers);
                    return isset($parts[1]) ? $parts[1] : null;
                }, $used_customers);
                $booking_ids = array_values(array_filter($booking_ids));

                if (in_array($booking_id, $booking_ids)) {
                    $booking_flag = 1;
                }else{
                    $booking_flag = 0;
                }
            }else{
                $booking_flag = 1;
            }

            if (!in_array($customer, $customer_ids) && $booking_flag == 1) {
                $is_customer_used = '0';
                $is_valid = '1';
                $giftcard_id = $result->id;
                $allowed_services = explode(',',$result->service_name);
                for($i=0;$i<count($allowed_services);$i++){
                    $custom_array[] = array(
                        'service'           =>  $allowed_services[$i],
                        'discount_type'     =>  $result->discount_in,
                        'discount'          =>  $result->discount,
                    );
                    $giftcard_services[] = (int)$allowed_services[$i];
                }
            }else{
                $is_customer_used = '1';
                $is_valid = '1';
                $giftcard_id = $result->id;
            }
        }else{
            $is_customer_used = '0';
            $is_valid = '0';
            $giftcard_id = '';
        }

        echo json_encode(
            array(
                'custom_array'      =>  $custom_array,
                'is_customer_used'  =>  $is_customer_used,
                'is_valid'          =>  $is_valid,
                'giftcard_services' =>  $giftcard_services,
                'giftcard_id'       =>  $giftcard_id
            ));
    }

    public function get_stylistwise_calender_data(){
        $stylist_id = $this->input->post('stylist_id');

        $this->db->where('id',$stylist_id);
        $this->db->where('is_deleted','0');
        $single = $this->db->get('tbl_salon_employee')->row();

        $this->db->select('tbl_booking_services_details.*,tbl_salon_employee.full_name as stylist_name, tbl_new_booking.payment_status as main_payment_status, tbl_salon_customer.id as customer_id, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.stylist_id',$stylist_id);
        $this->db->where('tbl_booking_services_details.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_booking_services_details.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $bookings = $this->db->get('tbl_booking_services_details')->result();

        echo json_encode(
            array(
                'single'      =>  $single,
                'bookings'    =>  $bookings,
            )
        );
    }
    
    public function get_all_stylists_data(){
        $this->db->select('id, full_name');
        $this->db->where('is_deleted', '0');
        $stylists = $this->db->get('tbl_salon_employee')->result();
    
        $this->db->select('tbl_booking_services_details.*, tbl_new_booking.payment_status as main_payment_status, tbl_salon_customer.full_name as customer_name, tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name');
        $this->db->join('tbl_salon_emp_service', 'tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking', 'tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->where('tbl_booking_services_details.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_booking_services_details.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $bookings = $this->db->get('tbl_booking_services_details')->result();
    
        echo json_encode(array(
            'stylists' => $stylists,
            'bookings' => $bookings,
        ));
    }
    
    
    
    public function get_booking_service_details_ajx(){
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules)){
            $booking_rescheduling = $booking_rules->booking_rescheduling;
            $cancellation = $booking_rules->cancellation;

            $booking_service_details_id = $this->input->post('booking_service_details_id');

            $this->db->select('tbl_booking_services_details.*,tbl_new_booking.payment_status as final_payment_status, tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
            $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
            $this->db->where('tbl_booking_services_details.id',$booking_service_details_id);
            $this->db->where('tbl_booking_services_details.is_deleted','0');
            $bookings = $this->db->get('tbl_booking_services_details')->row();

            if(!empty($bookings)){
                $products = explode(',',$bookings->product_ids);
                $product_details_str = '';
                if (empty($products)) {
                    $product_details_str = '-';
                } else {
                    for ($k = 0; $k < count($products); $k++) {
                        $product_details = $this->get_product_details($products[$k]);
                        if (!empty($product_details)) {
                            $product_details_str .= $product_details->product_name;
                            if ($k < count($products) - 1) {
                                $product_details_str .= ', ';
                            }
                        }
                    }
                }
                $service_from = new DateTime($bookings->service_from);
                $service_from->modify("-$booking_rescheduling minutes");
                $allowed_rescheduling_time = $service_from->format('Y-m-d H:i:s');
                
                $service_from_cancel = new DateTime($bookings->service_from);
                $service_from_cancel->modify("-$cancellation minutes");
                $allowed_cancel_time = $service_from_cancel->format('Y-m-d H:i:s');
            ?>
                <div class="calender_booking_details">
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <td>
                                    <?=$bookings->customer_name;?>, <?=$bookings->customer_phone;?>
                                    <?php                                          
                                        if ($bookings->service_status === '0' || $bookings->service_status === '1') {
                                            if ($bookings->payment_status === '0') {
                                                echo '<button style="float:right;margin-top:10px;background-color:#2d2dcb !important;" title="Generate Bill" type="button" id="bill_generate_button_' . $bookings->id . '" onclick="showBillGenerationPopup(' . $bookings->booking_id . ')" data-toggle="modal" data-target="#BookingBillModal" class="btn btn-primary event-action-button">Generate Bill</button>';
                                            }
                                        }                                      
                                        if ($bookings->service_status === '0') {
                                            if ($bookings->payment_status === '0') {
                                                $eventStartTime = date('Y-m-d H:i:s',strtotime($bookings->service_from));
                                                $currentTime = date('Y-m-d H:i:s');
                                                if ($eventStartTime > $currentTime) {
                                                    echo '<button style="float:right;margin-top:10px;background-color:#2d2dcb !important;" title="Add New Service" id="addServiceButton_' . $bookings->id . '" onclick="showAddServicePopup(' . $bookings->id . ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button">Add New Service</button>';
                                                }
                                            }
                                        }
                                    ?>
								    <?php if($bookings->service_status != "2" && $bookings->payment_status == "1"){ ?>	
                                        <a style="float:right;" class="btn btn-info" target="_blank" href="<?=base_url(); ?>booking-print/<?=base64_encode($bookings->booking_id);?>/<?=base64_encode($bookings->booking_payment_id);?>">Receipt</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Booking Amount</th>
                                <td>Rs. <?=$bookings->amount_to_paid;?></td>
                            </tr> -->
                            <tr>
                                <th>Payment Status</th>
                                <td>
                                    <?php
                                        if($bookings->payment_status == '1'){
                                            echo '<label class="label label-success">Completed</label>';
                                            echo ' On: '.date('d-m-Y',strtotime($bookings->payment_date));
                                        }else{
                                            echo '<label class="label label-warning">Pending</label>';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Service</th>
                                <td><?=$bookings->service_name;?> | <?=$bookings->service_name_marathi;?> <?php if($bookings->service_added_from == '1') { ?><small>(Package Service)</small><?php } ?></td>
                            </tr>
                            <?php if($product_details_str != ""){ ?>
                            <tr>
                                <th>Products</th>
                                <td><?=$product_details_str;?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th>Date</th>
                                <td><?=date('d-m-Y',strtotime($bookings->service_date));?></td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td><?=date('h:i A',strtotime($bookings->service_from));?> to <?=date('h:i A',strtotime($bookings->service_to));?></td>
                            </tr>
                            <tr>
                                <th>Stylist</th>
                                <td><?=$bookings->stylist_name;?></td>
                            </tr>
                            <tr>
                                <th>Service Status</th>
                                <td>
                                    <?php 
                                        if($bookings->service_status == '0'){
                                            echo '<label class="label label-warning">Pending</label>';
                                        }elseif($bookings->service_status == '1'){
                                            echo '<label class="label label-success">Completed</label>';
                                            echo ' On: '.date('d-m-Y',strtotime($bookings->completed_on));
                                        }elseif($bookings->service_status == '2'){
                                            echo '<label class="label label-danger">Cancelled</label>';
                                        }elseif($bookings->service_status == '3'){
                                            echo '<label class="label label-default">Lapsed</label>';
                                        }else{
                                            echo 'NA';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td>
                                    <?php 
                                        if($bookings->service_status == '0'){
                                            if(date('Y-m-d H:i:s') <= $allowed_cancel_time){
                                                if($bookings->service_added_from != '1'){
                                                    echo '<button type="button" class="btn btn-danger" id="cancel_button" onclick="showCancelPopup('.$bookings->id.')" data-toggle="modal" data-target="#ServiceCancelModal">Cancel</button>';
                                                }
                                            }
                                            if(date('Y-m-d H:i:s') <= $allowed_rescheduling_time){
                                                echo '<button type="button" class="btn btn-default" id="reschedule_button" onclick="showReschedulePopup('.$bookings->id.')" data-toggle="modal" data-target="#ServiceRescheduleModal">Reschedule</button>';
                                            }
                                            echo '<button type="button" class="btn btn-info" id="complete_button" onclick="showCompletePopup('.$bookings->id.')" data-toggle="modal" data-target="#ServiceCompleteModal">Complete</button>';
                                        }elseif($bookings->service_status == '1'){
                                            echo '-';
                                        }elseif($bookings->service_status == '2'){
                                            echo '-';
                                        }elseif($bookings->service_status == '3'){
                                            echo '-';
                                        }else{
                                            echo '-';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php 
            }else{ 
            ?>
                <div>
                    <label class="error">Booking details not found</label>
                </div>
            <?php 
            }
        }else{ 
        ?>
        <div>
            <label class="error">Booking rules not available</label>
        </div>
        <?php
        }
    }
    
    public function get_single_booking_row($booking_id){
        $this->db->select('tbl_new_booking.*,tbl_salon_customer.current_pending_amount, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone,tbl_salon_customer.id as customer_id,tbl_salon_customer.gender as customer_gender,tbl_salon_customer.rewards_balance');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
        $this->db->where('tbl_new_booking.id',$booking_id);
        $this->db->where('tbl_new_booking.is_deleted','0');
        $booking = $this->db->get('tbl_new_booking')->row();
        return $booking;
    }
    public function get_single_booking_details_result($booking_id){
        $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $booking_services = $this->db->get('tbl_booking_services_details')->result();
        return $booking_services;
    }
    public function get_booking_bill_generation_details_ajx(){
        $booking_rules = $this->get_booking_rules();
		$coupon_list = $this->get_all_coupon_list();
        $all_stylist = $this->get_all_salon_stylists();
        if(!empty($booking_rules)){
            $booking_id = $this->input->post('booking_id');
            $this->db->select('tbl_new_booking.*,tbl_salon_customer.current_pending_amount, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone,tbl_salon_customer.id as customer_id,tbl_salon_customer.gender as customer_gender,tbl_salon_customer.rewards_balance');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
            $this->db->where('tbl_new_booking.id',$booking_id);
            $this->db->where('tbl_new_booking.is_deleted','0');
            $booking = $this->db->get('tbl_new_booking')->row();

            $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
            $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
            $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
            $this->db->where('tbl_booking_services_details.is_deleted','0');
            $booking_services = $this->db->get('tbl_booking_services_details')->result();

            if(!empty($booking)){
                $package_details = $this->get_package_details($booking->pacakge_id);
                $giftcard_details = $this->get_giftcard_details($booking->applied_giftcard_id);
                $all_service_details_ids = array();
                $customer_membership = $this->get_customer_membership_details($booking->customer_id);

                $is_member = $customer_membership['is_member'];
                $membership_details = $customer_membership['membership'];
                // echo '<pre>'; print_r($membership_details);exit;
            ?>
                <div class="calender_booking_details" style="margin-top: -10px;">
                    <table style="width:100%;">
                        <thead>
                            <tr style="border-bottom: 0.5px solid #afafaf;">
                                <th>Customer</th>
                                <th>Booking Date</th>
                                <th>Booking Amt</th>
                                <th>Customer Pending Amount</th>
                                <th>Membership</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <?=$booking->customer_name;?>, <?=$booking->customer_phone;?>
                                </th>
                                <th><?=date('d M, Y',strtotime($booking->booking_date));?></th>
                                <th><?=($booking->amount_to_paid != "") ? 'Rs. '.$booking->amount_to_paid : 'Rs. 0.00';?></th>
                                <th><?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? 'Rs. '.$booking->current_pending_amount : 'Rs. 0.00';?></th>
                                <th>
                                    <?php 
                                        if($is_member == "1"){
                                            echo !empty($membership_details) ? '<br><a class="btn btn-sm" style="background-color:'.$membership_details->bg_color.'; color:'.$membership_details->text_color.'">'.$membership_details->membership_name.'</a>' : '-';
                                        }else{
                                            echo '<a class="btn" style="text-decoration:underline;" target="_blank" href="' . base_url() . 'asign-membership/' . $booking->customer_id . '" title="Assign Membership">Assign Membership</a>';
                                        }
                                    ?>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form method="post" name="payment_form_<?=$booking->id;?>" id="payment_form_<?=$booking->id;?>" action="<?=base_url();?>generate-bill/<?=base64_encode($booking->id);?>">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="calender_booking_details service_details_div service_details_box" style="height: 150px; overflow-y: scroll; border: 0.5px solid #afafaf;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr style="border-bottom: 0.5px solid #afafaf;">
                                                    <th>Select</th>
                                                    <th>Service</th>
                                                    <th>Products</th>
                                                    <th>Service Date</th>
                                                    <th>Amount</th>
                                                    <th>Stylist</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(!empty($booking_services)){
                                                        foreach($booking_services as $booking_services_result){
                                                            // if($booking_services_result->payment_status != '1'){
                                                                if($booking_services_result->is_extra_service == '1'){
                                                                    $row_style = "background-color:#0000ff21;";
                                                                }else{
                                                                    $row_style = "";
                                                                }
                                                            // }else{
                                                            //     $row_style = "background-color:#8bc34a61;";
                                                            // }
                                                            $products = explode(',',$booking_services_result->product_ids);
                                                            $product_details_str = '';
                                                            if (empty($products)) {
                                                                $product_details_str = '-';
                                                            } else {
                                                                for ($k = 0; $k < count($products); $k++) {
                                                                    $product_details = $this->get_product_details($products[$k]);
                                                                    if (!empty($product_details)) {
                                                                        $product_details_str .= $product_details->product_name;
                                                                        if ($k < count($products) - 1) {
                                                                            $product_details_str .= ', ';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            if($booking_services_result->service_status != '2'){
                                                                if($booking_services_result->payment_status == '0'){
                                                                    $all_service_details_ids[] = $booking_services_result->id;
                                                                }
                                                            }

                                                            $this->db->select('tbl_booking_services_products_details.*,tbl_product.product_name, tbl_new_booking.amount_to_paid, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
                                                            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_products_details.service_id');
                                                            $this->db->join('tbl_product','tbl_product.id = tbl_booking_services_products_details.product_id');
                                                            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_products_details.customer_name');
                                                            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_products_details.booking_id');
                                                            $this->db->where('tbl_booking_services_products_details.booking_service_details_id',$booking_services_result->id);
                                                            $this->db->where('tbl_booking_services_products_details.is_deleted','0');
                                                            $booking_products = $this->db->get('tbl_booking_services_products_details')->result();
                                                ?>
                                                <tr style="<?=$row_style;?>">
                                                    <td>
                                                        <input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked style="pointer-events: none;"'; }else{ echo 'disabled'; }}?> type="checkbox" class="booking_services_<?=$booking->id;?>" name="service_checkbox_<?=$booking->id;?>[]" id="service_checkbox_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->id;?>" onclick="setServicePrice(<?=$booking_services_result->id;?>,<?=$booking->id;?>)">
                                                    </td>
                                                    <td title="<?=$booking_services_result->service_name_marathi;?>">
                                                        <?=$booking_services_result->service_name;?>
                                                        <?php if($booking_services_result->service_added_from == '1'){ ?>
                                                            <?php if(!empty($package_details)){ ?>
                                                                <br><small>(Package: <?=$package_details->package_name; ?>)</small>
                                                            <?php }else{ ?>
                                                                <br><small>(Package Service)</small>
                                                            <?php } ?>
                                                        <?php if($booking->package_amount == '0' ||  $booking->package_amount == '' || $booking->package_amount == null || $booking->package_amount == '0.00'){ ?>
                                                            <small> (Active)</small>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($product_details_str != ""){ ?>
                                                            <a style="text-decoration:underline;" type="button" id="service_products_button_<?=$booking_services_result->id;?>" data-toggle="modal" data-target="#ServiceProductModal_<?=$booking_services_result->id;?>" onclick="showPopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                <span id="selected_product_<?=$booking_services_result->id;?>">0</span>/<?=count($booking_products);?>
                                                            </a>
                                                            
                                                            <div class="modal fade" id="ServiceProductModal_<?=$booking_services_result->id;?>" tabindex="-1" aria-labelledby="ServiceProductLabel_<?=$booking_services_result->id;?>" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1030 !important;overflow:hidden !important;opacity:0 !important;">
                                                                <div class="modal-dialog" style="margin-top:100px;width:500px;position:fixed;left:30%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="ServiceProductLabel_<?=$booking_services_result->id;?>"><?php echo $booking_services_result->service_name; ?> Products</h5>
                                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" id="booking_service_product_response_<?=$booking_services_result->id;?>">
                                                                            <div class="calender_booking_details product_details_div">
                                                                                <table style="width:100%; border: 0.5px solid #afafaf;">
                                                                                    <thead>
                                                                                        <tr style="border-bottom: 0.5px solid #afafaf;">
                                                                                            <th>Select</th>
                                                                                            <th>Product</th>
                                                                                            <th>Price</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                            if(!empty($booking_products)){
                                                                                                foreach($booking_products as $booking_products_result){
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked style="pointer-events: none;"'; }else{ echo 'disabled'; }}?> type="checkbox" class="product_checkbox_<?=$booking_services_result->id;?>" name="service_products_checkbox_<?=$booking_services_result->id;?>[]" id="service_products_checkbox_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->id;?>" onclick="setServiceProductPrice(<?=$booking_services_result->id;?>,<?=$booking_products_result->id;?>,<?=$booking->id;?>)"></td>
                                                                                            <td><?=$booking_products_result->product_name;?></td>
                                                                                            <td><?=($booking_products_result->product_price != "") ? 'Rs. '.$booking_products_result->product_price : 'Rs. 0.00';?></td>
                                                                                        </tr>
                                                                                        <input type="hidden" name="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->product_id;?>">
                                                                                        <input type="hidden" name="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=($booking_products_result->product_price != "" && $booking_products_result->product_price != "" && $booking_products_result->product_price != "0" && $booking_products_result->product_price != "0.00") ? $booking_products_result->product_price : '0.00';?>">
                                                                                        <?php }} ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        <?php }else{ ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                    <td><?=date('d M, y',strtotime($booking_services_result->service_date));?></td>
                                                    <td><?=($booking_services_result->service_price != "") ? 'Rs. '.$booking_services_result->service_price : 'Rs. 0.00';?></td>
                                                    <td>
                                                        <select class="form-control chosen-select single_booking_stylists_<?=$booking->id;?>" id="new_stylist_<?=$booking_services_result->id;?>"  name="new_stylist_<?=$booking_services_result->id;?>">
                                                            <option value="">Select Stylist</option>
                                                            <?php if(!empty($all_stylist)){ foreach($all_stylist as $all_stylist_result){ ?>
                                                            <option value="<?=$all_stylist_result->id;?>" <?php if($all_stylist_result->id == $booking_services_result->stylist_id){ echo 'selected'; }?>>
                                                                <?=$all_stylist_result->full_name; ?>
                                                            </option>
                                                            <?php }} ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($booking_services_result->service_status == '0'){
                                                                echo '<label style="color:black;" class="label label-warning">Pending</label>';
                                                            }elseif($booking_services_result->service_status == '1'){
                                                                echo '<label style="color:black;" class="label label-success">Completed</label>';
                                                                echo '<br>On: '.date('d-m-Y',strtotime($booking_services_result->completed_on));
                                                            }elseif($booking_services_result->service_status == '2'){
                                                                echo '<label style="color:black;" class="label label-danger">Cancelled</label>';
                                                            }elseif($booking_services_result->service_status == '3'){
                                                                echo '<label style="color:black;" class="label label-default">Lapsed</label>';
                                                            }else{
                                                                echo 'NA';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="old_stylist_<?=$booking_services_result->id;?>" id="old_stylist_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->stylist_id;?>">
                                                <input type="hidden" name="single_service_id_<?=$booking_services_result->id;?>" id="single_service_id_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->service_id;?>">
                                                <input type="hidden" name="single_service_price_<?=$booking_services_result->id;?>" id="single_service_price_<?=$booking_services_result->id;?>" value="<?=($booking_services_result->service_price != "" && $booking_services_result->service_price != "" && $booking_services_result->service_price != "0" && $booking_services_result->service_price != "0.00") ? $booking_services_result->service_price : '0.00';?>">
                                                <?php }}else{ ?>
                                                <tr>
                                                    <td colspan="7">Services Not Available</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                                        
                                        <label for="service_checkbox_<?=$booking->id;?>[]" generated="true" class="error" style="display:none;">Please select at least one service!</label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="calender_booking_details service_details_box coupon_details_div" style="height: 95px;border: 0.5px solid #afafaf;margin-top:10px;">
                                        <div class="calender_booking_details">
                                            <span><h6 style="margin-left: 6px;">Apply Coupon</h6></span>
                                            <hr style="margin: 0; border: none; border-top: 0.5px solid #afafaf;">
                                        </div>
                                        <table style="width:100%;">
                                            <thead>
                                                <?php 
                                                    if(!empty($coupon_list)){ 
                                                        foreach($coupon_list as $coupon_list_result){ 
                                                ?>
                                                <tr>
                                                    <th>
                                                        <?=$coupon_list_result->coupon_name; ?>
                                                        <div id="coupon_details_div_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="position: relative;display:inline-block; width:auto;">
                                                            <div id="coupon_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>
                                                                <div class="coupon-tooltip">
                                                                    <div style="margin-top:1px;">
                                                                        <p>Minimum Amount: Rs. <?=$coupon_list_result->min_price;?></p>
                                                                        <p>Discount: Rs. <?=$coupon_list_result->coupon_offers;?></p>
                                                                        <p>Expiry: <?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('d-m-Y',strtotime($coupon_list_result->coupan_expiry)) : 'NA';?></p>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th id="coupon_button_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="text-align: right;">
                                                        <!-- <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the coupon?')) applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new');">Apply</button> -->
                                                        <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the coupon?', function(confirmed) { if (confirmed) { applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new'); } })">Apply</button>
                                                        <label class="error" id="coupon_error_<?=$booking->id;?>_<?=$coupon_list_result->id?>"></label>
                                                    </th>
                                                </tr>
                                                <input type="hidden" id="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('Y-m-d',strtotime($coupon_list_result->coupan_expiry)) : '';?>">
                                                <input type="hidden" id="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_name; ?>">
                                                <input type="hidden" id="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->min_price;?>">
                                                <input type="hidden" id="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_offers;?>">
                                                <?php }} ?>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="calender_booking_details giftcard_details_div" style="border: 0.5px solid #afafaf;margin-top:10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input style="width: 100%;" type="text" name="giftcard_no_<?=$booking->id;?>" id="giftcard_no_<?=$booking->id;?>" value="<?php if($booking->is_giftcard_applied == '1' && !empty($giftcard_details)){ echo $giftcard_details->gift_name; } ?>" placeholder="Enter Giftcard No">
                                                        <br><label id="giftcard_error_<?=$booking->id;?>" class="error" style="display:none;"></label>
                                                    </th>
                                                    <th style="text-align: right;">
                                                        <!-- <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the gift card?')) applyGiftCard(<?=$booking->id; ?>,'new');">Apply</button>
                                                        <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the gift card?')) removeGiftCard(<?=$booking->id; ?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                    
                                                        <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the gift card?', function(confirmed) { if (confirmed) { applyGiftCard(<?=$booking->id; ?>,'new'); } })">Apply</button>
                                                        <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('Are you sure you want to remove the gift card?', function(confirmed) { if (confirmed) { removeGiftCard(<?=$booking->id; ?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="calender_booking_details rewards_details_div" style="border: 0.5px solid #afafaf;margin-top:10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <span id="customer_rewards_text_<?=$booking->id;?>">Rewards Balance: <?= $booking->rewards_balance?></span>
                                                        <div id="used_rewards_msg_<?=$booking->id;?>"></div>
                                                        <input type="hidden" name="customer_reward_available_<?=$booking->id;?>" id="customer_reward_available_<?=$booking->id;?>" value="<?=$booking->rewards_balance; ?>">
                                                        <input type="hidden" name="customer_gender_<?=$booking->id;?>" id="customer_gender_<?=$booking->id;?>" value="<?=$booking->customer_gender;?>">
                                                    </th>
                                                    <th style="text-align: right;">
                                                        <button id="rewards_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyRewards(<?=$booking->id;?>)">Apply</button>
                                                        <!-- <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the reward points?')) removeRewards(<?=$booking->id;?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                        <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('re you sure you want to remove the reward points?', function(confirmed) { if (confirmed) { removeRewards(<?=$booking->id;?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-5" style="margin-top: 40px;">
                                    <div class="form-group col-md-12 col-xs-12">
                                        <label>Send Appointments Details<b class="require">*</b></label>
                                        <select class="form-control form-select" name="send_appointment_details_<?=$booking->id;?>" id="send_appointment_details_<?=$booking->id;?>" onchange="toggleMessageType(<?=$booking->id;?>)">
                                            <option value="">Select Option</option>
                                            <option value="1" selected>Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        <label for="send_appointment_details_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                    <div class="form-group col-md-12 col-xs-12" id="message_type_div_<?=$booking->id;?>" style="display:none;">
                                        <label>Select Message Type<b class="require">*</b></label>
                                        <select class="form-control form-select" name="message_type_<?=$booking->id;?>" id="message_type_<?=$booking->id;?>">
                                            <option value="">Select Option</option>
                                            <option value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'selected'; }?>>SMS</option>
                                            <option value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'selected'; }?>>Email</option>
                                            <option value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'selected'; }?>>Whatapp</option>
                                        </select>
                                        <label for="message_type_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="customer_id_<?=$booking->id;?>" id="customer_id_<?=$booking->id;?>" value="<?=$booking->customer_id;?>">
                        <input type="hidden" name="customer_pending_amount_<?=$booking->id;?>" id="customer_pending_amount_<?=$booking->id;?>" value="<?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? $booking->current_pending_amount : '0.00';?>">
                        <input type="hidden" name="package_id_<?=$booking->id;?>" id="package_id_<?=$booking->id;?>" value="<?=$booking->pacakge_id;?>">
                        <input type="hidden" name="package_amount_<?=$booking->id;?>" id="package_amount_<?=$booking->id;?>" value="<?=$booking->package_amount;?>">
                        <input type="hidden" name="selected_coupon_id_<?=$booking->id;?>" id="selected_coupon_id_<?=$booking->id;?>" value="<?=($booking->selected_coupon_id != "" && $booking->selected_coupon_id != null && $booking->selected_coupon_id != "0") ? $booking->selected_coupon_id : '';?>">
                        <input type="hidden" name="is_membership_booking_<?=$booking->id;?>" id="is_membership_booking_<?=$booking->id;?>" value="<?=$is_member;?>">
                        <input type="hidden" name="membership_id_<?=$booking->id;?>" id="membership_id_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->membership_id : '';?>">
                        <input type="hidden" name="membership_discount_type_<?=$booking->id;?>" id="membership_discount_type_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->discount_in : '';?>">
                        <input type="hidden" name="m_service_discount_<?=$booking->id;?>" id="m_service_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->service_discount : '0';?>">
                        <input type="hidden" name="m_product_discount_<?=$booking->id;?>" id="m_product_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->product_discount : '0';?>">
                        <input type="hidden" name="is_giftcard_applied_<?=$booking->id;?>" id="is_giftcard_applied_<?=$booking->id;?>" value="">
                        <input type="hidden" name="applied_giftcard_id_<?=$booking->id;?>" id="applied_giftcard_id_<?=$booking->id;?>" value="">
                        
                        <input type="hidden" name="total_service_amount_<?=$booking->id;?>" id="total_service_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="total_product_amount_<?=$booking->id;?>" id="total_product_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="coupon_discount_amount_<?=$booking->id;?>" id="coupon_discount_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="reward_discount_amount_<?=$booking->id;?>" id="reward_discount_amount_<?=$booking->id;?>" value="0.00">    
                        <input type="hidden" name="used_rewards_<?=$booking->id;?>" id="used_rewards_<?=$booking->id;?>" value="0">    
                        <input type="hidden" name="gift_discount_<?=$booking->id;?>" id="gift_discount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="m_service_discount_amount_<?=$booking->id;?>" id="m_service_discount_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="m_product_discount_amount_<?=$booking->id;?>" id="m_product_discount_amount_<?=$booking->id;?>" value="0.00">
                        
                        <input type="hidden" name="service_payable_hidden_<?=$booking->id;?>" id="service_payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="product_payable_hidden_<?=$booking->id;?>" id="product_payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="payable_hidden_<?=$booking->id;?>" id="payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="total_discount_hidden_<?=$booking->id;?>" id="total_discount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="booking_amount_hidden_<?=$booking->id;?>" id="booking_amount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="gst_amount_hidden_<?=$booking->id;?>" id="gst_amount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="grand_total_hidden_<?=$booking->id;?>" id="grand_total_hidden_<?=$booking->id;?>" value="0.00">
                        <div class="col-lg-4">
                            <div class="calender_booking_details booking_pricing_div" style="border: 0.5px solid #afafaf;">
                                <table style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Service Price</th>
                                            <th id="total_service_amount_text_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr>
                                            <th>Products Price</th>
                                            <th id="total_product_amount_text_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <?php if($booking->pacakge_id != "" && $booking->package_amount != "" && $booking->package_amount != "0.00"){ ?>
                                        <tr>
                                            <th>Package Price <?php if(!empty($package_details)){ ?><small>(<?=$package_details->package_name;?>)</small><?php } ?></th>
                                            <th id="package_price_<?=$booking->id;?>"><?=$booking->package_amount;?></th>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <th>
                                                Discount                                        
                                                <div id="discount_details_div_<?=$booking->id;?>" style="position: relative;display:inline-block; width:auto;"></div>
                                            </th>
                                            <th id="discount_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr style="border-top: 0.5px solid #afafaf;">
                                            <th>Total Amount</th>
                                            <th id="booking_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr>
                                            <th>GST <small>(18%)</small></th>
                                            <th id="gst_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr style="border-top: 0.5px solid #afafaf;">
                                            <th>Total</th>
                                            <th id="grand_total_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 bill_generation_prices" style="margin-top:10px;">
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Amount<b class="require">*</b></label>
                                    <input type="number" class="form-control" name="paid_amount_<?=$booking->id;?>" id="paid_amount_<?=$booking->id;?>" placeholder="Enter Paid Amount" value="" onkeyup="calculatePendingAmount(<?=$booking->id;?>)">
                                    <label for="paid_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Pending Amount<b class="require"></b></label>
                                    <input readonly type="number" class="form-control" name="pending_amount_<?=$booking->id;?>" id="pending_amount_<?=$booking->id;?>" placeholder="Enter Pending Amount" value="">
                                    <label for="pending_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Mode<b class="require">*</b></label>
                                    <select class="form-control form-select" name="payment_mode_<?=$booking->id;?>" id="payment_mode_<?=$booking->id;?>">
                                        <option value="">Select Payment Mode</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Online">Online</option>
                                    </select>
                                    <label for="payment_mode_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Date<b class="require">*</b></label>
                                    <input readonly type="date" class="form-control" name="payment_date_<?=$booking->id;?>" id="payment_date_<?=$booking->id;?>" value="<?php echo date("Y-m-d"); ?>">
                                    <label for="payment_date_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="payment_btn_<?=$booking->id;?>" name="payment_btn_<?=$booking->id;?>" value="payment_btn_<?=$booking->id;?>">Generate Bill</button>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </form>              
                <script>
                    $(document).ready(function () {                        
                        $("#chosen-select").chosen();
                        var selected_service_details = <?php echo json_encode($all_service_details_ids); ?>;
                        var bookingID = <?php echo $booking->id; ?>;
                        $('.loader_div').show();   
                        setTimeout(function() {
                            for(k=0;k<selected_service_details.length;k++){
                                setServicePrice(selected_service_details[k],bookingID);
                            }
                            $('.loader_div').hide(); 
                        }, 1500);

                        toggleMessageType(bookingID);

                        var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                        var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                        if(selected_coupon_id != "" && selected_coupon_id != '0'){
                            applyCoupon(bookingID,selected_coupon_id,'previous');
                        }else if(is_giftcard_applied == '1'){
                            applyGiftCard(bookingID,'previous');
                        }

                        $('#payment_form_<?=$booking->id;?>').validate({
                            ignore:[],
                            rules: {
                                'service_checkbox_<?=$booking->id;?>[]': {
                                    required: true,
                                },
                                'payment_date_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'payment_mode_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'paid_amount_<?=$booking->id;?>': {
                                    required: true,
                                    number: true,
                                    min: 0,
                                },
                                'send_appointment_details_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'message_type_<?=$booking->id;?>': {
                                    required: function(element) {
                                        return $('#send_appointment_details_<?=$booking->id;?>').val() == '1';
                                    },
                                },
                                <?php if(!empty($booking_services)){
                                    foreach($booking_services as $booking_services_result){ ?>
                                        'new_stylist_<?=$booking_services_result->id;?>': {
                                            required: true,
                                        },
                                <?php }} ?>
                            },
                            messages: {
                                'service_checkbox_<?=$booking->id;?>[]': {
                                    required: "Please select at least one service!",
                                },
                                'payment_date_<?=$booking->id;?>': {
                                    required: "Please select payment date!",
                                },
                                'payment_mode_<?=$booking->id;?>': {
                                    required: "Please select payment mode!",
                                },
                                'paid_amount_<?=$booking->id;?>': {
                                    required: "Please enter payment amount!",
                                    number: "Please enter number only!",
                                    min: "Minimum amount 0 is allowed!",
                                },
                                'send_appointment_details_<?=$booking->id;?>': {
                                    required: "Please select option!",
                                },
                                'message_type_<?=$booking->id;?>': {
                                    required: "Please select option!",
                                },
                                <?php if(!empty($booking_services)){
                                    foreach($booking_services as $booking_services_result){ ?>
                                        'new_stylist_<?=$booking_services_result->id;?>': {
                                            required: "Please select stylist!",
                                        },
                                <?php }} ?>
                            },
                            submitHandler: function(form) {
                                if(confirm("Are you sure to generate bill?")) {
                                // openConfirmationDialog("Are you sure to generate bill?", function (confirmed) {
                                // if (confirmed) {
                                    form.submit();
                                } else {
                                    return false;
                                }
                                // });
                            }
                        });
                    });
                    $('#payment_date_<?=$booking->id;?>').datepicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: 0
                    });
                    function toggleMessageType(bookingID){
                        if($('#send_appointment_details_' + bookingID).val() == '1'){
                            $('#message_type_div_' + bookingID).show();
                        }else{
                            $('#message_type_div_' + bookingID).hide();
                        }
                    }
                </script>
            <?php 
            }else{ 
            ?>
                <div>
                    <label class="error">Booking details not found</label>
                </div>
            <?php 
            }
        }else{ 
        ?>
        <div>
            <label class="error">Booking rules not available</label>
        </div>
        <?php
        }
    }    
    public function get_booking_edit_details_ajx(){
        $booking_rules = $this->get_booking_rules();

        if(!empty($booking_rules)){
            $days_early_booking = $booking_rules->max_booking_range_day;
            if($days_early_booking != ""){
                $max_date = date('d-m-Y', strtotime('+'.$days_early_booking.' day'));
            }else{
                $max_date = date('d-m-Y', strtotime('+0 day'));
            }
        }else{
            $max_date = date('d-m-Y', strtotime('+0 day'));
        }
        $today = date('d-m-Y');

		$category = $this->get_all_sup_category();
        $offers_list = $this->Salon_model->get_all_active_offers();
        $products = $this->Salon_model->get_all_active_product();

		$coupon_list = $this->get_all_coupon_list();
        if(!empty($booking_rules)){
            $booking_id = $this->input->post('booking_id');
            $this->db->select('tbl_new_booking.*,tbl_salon_customer.current_pending_amount, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone,tbl_salon_customer.id as customer_id,tbl_salon_customer.gender as customer_gender,tbl_salon_customer.rewards_balance');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
            $this->db->where('tbl_new_booking.id',$booking_id);
            $this->db->where('tbl_new_booking.is_deleted','0');
            $booking = $this->db->get('tbl_new_booking')->row();

            $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
            $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
            $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
            $this->db->where('tbl_booking_services_details.is_deleted','0');
            $booking_services = $this->db->get('tbl_booking_services_details')->result();

            if(!empty($booking)){
                $package_details = $this->get_package_details($booking->pacakge_id);
                $giftcard_details = $this->get_giftcard_details($booking->applied_giftcard_id);
                $all_service_details_ids = array();
                $customer_membership = $this->get_customer_membership_details($booking->customer_id);

                $is_member = $customer_membership['is_member'];
                $membership_details = $customer_membership['membership'];
                // echo '<pre>'; print_r($membership_details);exit;
            ?>
                <div class="calender_booking_details" style="margin-top: -10px;">
                    <table style="width:100%;">
                        <thead>
                            <tr style="border-bottom: 0.5px solid #afafaf;">
                                <th>Customer</th>
                                <th>Category</th>
                                <th>Service</th>
                                <th>Booking Date</th>
                                <th>Booking Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <?=$booking->customer_name;?>, <?=$booking->customer_phone;?>
                                </th>
                                <th>
                                    <select id="category_<?=$booking->id;?>" name="category_<?=$booking->id;?>" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php
                                            if(!empty($category)){
                                                foreach($category as $category_result){
                                        ?>
                                        <option value="<?=$category_result->id; ?>"><?=$category_result->sup_category; ?>|<?=$category_result->sup_category_marathi; ?></option>
                                        <?php }} ?>
                                    </select>
                                    <label for="category_<?=$booking->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select category!</label>
                                </th>
                                <th>
                                    <select id="service_<?=$booking->id;?>" name="service_<?=$booking->id;?>" class="form-control">
                                        <option value="">Select Service</option>
                                    </select>
                                    <label for="selected_add_service_<?=$booking->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select service!</label>
                                </th>
                                <th>
                                    <input readonly type="text" class="form-control" name="booking_date_<?=$booking->id;?>" id="booking_date_<?=$booking->id;?>" placeholder="Select Booking Date" onchange="fetchTimeSlots(<?=$booking->id;?>)" value="<?=date('d-m-Y',strtotime($booking->service_start_date));?>">
                                </th>
                                <th>
                                    <input readonly type="text" class="form-control" name="booking_start_<?=$booking->id;?>" id="booking_start_<?=$booking->id;?>" placeholder="Start From Time Slot" value="<?=date('H:i:s',strtotime($booking->service_start_time));?>">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="previous_start_<?=$booking->id;?>" id="previous_start_<?=$booking->id;?>" value="">
                    <input type="hidden" name="slot_start_time_<?=$booking->id;?>" id="slot_start_time_<?=$booking->id;?>" value="<?=date('H:i:s',strtotime($booking->service_start_time));?>">
                    <div class="form-group col-md-12 col-xs-12" id="booking_timeslots_<?=$booking->id;?>"></div> 
                </div>
                <form method="post" name="payment_form_<?=$booking->id;?>" id="payment_form_<?=$booking->id;?>" action="<?=base_url();?>generate-bill/<?=base64_encode($booking->id);?>">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="calender_booking_details service_details_div service_details_box" style="height: 150px; overflow-y: scroll; border: 0.5px solid #afafaf;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr style="border-bottom: 0.5px solid #afafaf;">
                                                    <th>Select</th>
                                                    <th>Service</th>
                                                    <th>Duration<small>(In Min)</small></th>
                                                    <th>Period</th>
                                                    <th>Stylist</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(!empty($booking_services)){
                                                        foreach($booking_services as $booking_services_result){
                                                            // if($booking_services_result->payment_status != '1'){
                                                                if($booking_services_result->is_extra_service == '1'){
                                                                    $row_style = "background-color:#0000ff21;";
                                                                }else{
                                                                    $row_style = "";
                                                                }
                                                            // }else{
                                                            //     $row_style = "background-color:#8bc34a61;";
                                                            // }
                                                            $products = explode(',',$booking_services_result->product_ids);
                                                            $product_details_str = '';
                                                            if (empty($products)) {
                                                                $product_details_str = '-';
                                                            } else {
                                                                for ($k = 0; $k < count($products); $k++) {
                                                                    $product_details = $this->get_product_details($products[$k]);
                                                                    if (!empty($product_details)) {
                                                                        $product_details_str .= $product_details->product_name;
                                                                        if ($k < count($products) - 1) {
                                                                            $product_details_str .= ', ';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            if($booking_services_result->service_status != '2'){
                                                                if($booking_services_result->payment_status == '0'){
                                                                    $all_service_details_ids[] = $booking_services_result->id;
                                                                }
                                                            }

                                                            $this->db->select('tbl_booking_services_products_details.*,tbl_product.product_name, tbl_new_booking.amount_to_paid, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
                                                            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_products_details.service_id');
                                                            $this->db->join('tbl_product','tbl_product.id = tbl_booking_services_products_details.product_id');
                                                            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_products_details.customer_name');
                                                            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_products_details.booking_id');
                                                            $this->db->where('tbl_booking_services_products_details.booking_service_details_id',$booking_services_result->id);
                                                            $this->db->where('tbl_booking_services_products_details.is_deleted','0');
                                                            $booking_products = $this->db->get('tbl_booking_services_products_details')->result();
                                                ?>
                                                <tr style="<?=$row_style;?>">
                                                    <td>
                                                        <input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked'; }else{ echo 'disabled'; }}?> type="checkbox" class="booking_services_<?=$booking->id;?>" name="service_checkbox_<?=$booking->id;?>[]" id="service_checkbox_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->id;?>" onclick="setServicePrice(<?=$booking_services_result->id;?>,<?=$booking->id;?>)">
                                                    </td>
                                                    <td title="<?=$booking_services_result->service_name_marathi;?>">
                                                        <?=$booking_services_result->service_name;?>
                                                        <?php if($booking_services_result->service_added_from == '1'){ ?>
                                                            <?php if(!empty($package_details)){ ?>
                                                                <br><small>(Package: <?=$package_details->package_name; ?>)</small>
                                                            <?php }else{ ?>
                                                                <br><small>(Package Service)</small>
                                                            <?php } ?>
                                                        <?php if($booking->package_amount == '0' ||  $booking->package_amount == '' || $booking->package_amount == null || $booking->package_amount == '0.00'){ ?>
                                                            <small> (Active)</small>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($product_details_str != ""){ ?>
                                                            <a style="text-decoration:underline;" type="button" id="service_products_button_<?=$booking_services_result->id;?>" data-toggle="modal" data-target="#ServiceProductModal_<?=$booking_services_result->id;?>" onclick="showPopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                <span id="selected_product_<?=$booking_services_result->id;?>">0</span>/<?=count($booking_products);?>
                                                            </a>
                                                            
                                                            <div class="modal fade" id="ServiceProductModal_<?=$booking_services_result->id;?>" tabindex="-1" aria-labelledby="ServiceProductLabel_<?=$booking_services_result->id;?>" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1030 !important;overflow:hidden !important;opacity:0 !important;">
                                                                <div class="modal-dialog" style="margin-top:100px;width:500px;position:fixed;left:30%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="ServiceProductLabel_<?=$booking_services_result->id;?>"><?php echo $booking_services_result->service_name; ?> Products</h5>
                                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" id="booking_service_product_response_<?=$booking_services_result->id;?>">
                                                                            <div class="calender_booking_details product_details_div">
                                                                                <table style="width:100%; border: 0.5px solid #afafaf;">
                                                                                    <thead>
                                                                                        <tr style="border-bottom: 0.5px solid #afafaf;">
                                                                                            <th>Select</th>
                                                                                            <th>Product</th>
                                                                                            <th>Price</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                            if(!empty($booking_products)){
                                                                                                foreach($booking_products as $booking_products_result){
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked'; }else{ echo 'disabled'; }}?> type="checkbox" class="product_checkbox_<?=$booking_services_result->id;?>" name="service_products_checkbox_<?=$booking_services_result->id;?>[]" id="service_products_checkbox_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->id;?>" onclick="setServiceProductPrice(<?=$booking_services_result->id;?>,<?=$booking_products_result->id;?>,<?=$booking->id;?>)"></td>
                                                                                            <td><?=$booking_products_result->product_name;?></td>
                                                                                            <td><?=($booking_products_result->product_price != "") ? 'Rs. '.$booking_products_result->product_price : 'Rs. 0.00';?></td>
                                                                                        </tr>
                                                                                        <input type="hidden" name="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->product_id;?>">
                                                                                        <input type="hidden" name="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=($booking_products_result->product_price != "" && $booking_products_result->product_price != "" && $booking_products_result->product_price != "0" && $booking_products_result->product_price != "0.00") ? $booking_products_result->product_price : '0.00';?>">
                                                                                        <?php }} ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        <?php }else{ ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                    <td><?=date('d M, y',strtotime($booking_services_result->service_date));?></td>
                                                    <td><?=($booking_services_result->service_price != "") ? 'Rs. '.$booking_services_result->service_price : 'Rs. 0.00';?></td>
                                                    <td>
                                                        <select class="form-control chosen-select single_booking_stylists_<?=$booking->id;?>" id="new_stylist_<?=$booking_services_result->id;?>"  name="new_stylist_<?=$booking_services_result->id;?>">
                                                            <option value="">Select Stylist</option>
                                                            <?php if(!empty($all_stylist)){ foreach($all_stylist as $all_stylist_result){ ?>
                                                            <option value="<?=$all_stylist_result->id;?>" <?php if($all_stylist_result->id == $booking_services_result->stylist_id){ echo 'selected'; }?>>
                                                                <?=$all_stylist_result->full_name; ?>
                                                            </option>
                                                            <?php }} ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($booking_services_result->service_status == '0'){
                                                                echo '<label style="color:black;" class="label label-warning">Pending</label>';
                                                            }elseif($booking_services_result->service_status == '1'){
                                                                echo '<label style="color:black;" class="label label-success">Completed</label>';
                                                                echo '<br>On: '.date('d-m-Y',strtotime($booking_services_result->completed_on));
                                                            }elseif($booking_services_result->service_status == '2'){
                                                                echo '<label style="color:black;" class="label label-danger">Cancelled</label>';
                                                            }elseif($booking_services_result->service_status == '3'){
                                                                echo '<label style="color:black;" class="label label-default">Lapsed</label>';
                                                            }else{
                                                                echo 'NA';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="old_stylist_<?=$booking_services_result->id;?>" id="old_stylist_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->stylist_id;?>">
                                                <input type="hidden" name="single_service_id_<?=$booking_services_result->id;?>" id="single_service_id_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->service_id;?>">
                                                <input type="hidden" name="single_service_price_<?=$booking_services_result->id;?>" id="single_service_price_<?=$booking_services_result->id;?>" value="<?=($booking_services_result->service_price != "" && $booking_services_result->service_price != "" && $booking_services_result->service_price != "0" && $booking_services_result->service_price != "0.00") ? $booking_services_result->service_price : '0.00';?>">
                                                <?php }}else{ ?>
                                                <tr>
                                                    <td colspan="7">Services Not Available</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                                        
                                        <label for="service_checkbox_<?=$booking->id;?>[]" generated="true" class="error" style="display:none;">Please select at least one service!</label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="calender_booking_details service_details_box coupon_details_div" style="height: 95px;border: 0.5px solid #afafaf;margin-top:10px;">
                                        <div class="calender_booking_details">
                                            <span><h6 style="margin-left: 6px;">Apply Coupon</h6></span>
                                            <hr style="margin: 0; border: none; border-top: 0.5px solid #afafaf;">
                                        </div>
                                        <table style="width:100%;">
                                            <thead>
                                                <?php 
                                                    if(!empty($coupon_list)){ 
                                                        foreach($coupon_list as $coupon_list_result){ 
                                                ?>
                                                <tr>
                                                    <th>
                                                        <?=$coupon_list_result->coupon_name; ?>
                                                        <div id="coupon_details_div_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="position: relative;display:inline-block; width:auto;">
                                                            <div id="coupon_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>
                                                                <div class="coupon-tooltip">
                                                                    <div style="margin-top:1px;">
                                                                        <p>Minimum Amount: Rs. <?=$coupon_list_result->min_price;?></p>
                                                                        <p>Discount: Rs. <?=$coupon_list_result->coupon_offers;?></p>
                                                                        <p>Expiry: <?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('d-m-Y',strtotime($coupon_list_result->coupan_expiry)) : 'NA';?></p>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th id="coupon_button_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="text-align: right;">
                                                        <!-- <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the coupon?')) applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new');">Apply</button> -->
                                                        <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the coupon?', function(confirmed) { if (confirmed) { applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new'); } })">Apply</button>
                                                        <label class="error" id="coupon_error_<?=$booking->id;?>_<?=$coupon_list_result->id?>"></label>
                                                    </th>
                                                </tr>
                                                <input type="hidden" id="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('Y-m-d',strtotime($coupon_list_result->coupan_expiry)) : '';?>">
                                                <input type="hidden" id="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_name; ?>">
                                                <input type="hidden" id="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->min_price;?>">
                                                <input type="hidden" id="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_offers;?>">
                                                <?php }} ?>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="calender_booking_details giftcard_details_div" style="border: 0.5px solid #afafaf;margin-top:10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input style="width: 100%;" type="text" name="giftcard_no_<?=$booking->id;?>" id="giftcard_no_<?=$booking->id;?>" value="<?php if($booking->is_giftcard_applied == '1' && !empty($giftcard_details)){ echo $giftcard_details->gift_name; } ?>" placeholder="Enter Giftcard No">
                                                        <br><label id="giftcard_error_<?=$booking->id;?>" class="error" style="display:none;"></label>
                                                    </th>
                                                    <th style="text-align: right;">
                                                        <!-- <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the gift card?')) applyGiftCard(<?=$booking->id; ?>,'new');">Apply</button>
                                                        <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the gift card?')) removeGiftCard(<?=$booking->id; ?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                    
                                                        <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the gift card?', function(confirmed) { if (confirmed) { applyGiftCard(<?=$booking->id; ?>,'new'); } })">Apply</button>
                                                        <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('Are you sure you want to remove the gift card?', function(confirmed) { if (confirmed) { removeGiftCard(<?=$booking->id; ?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="calender_booking_details rewards_details_div" style="border: 0.5px solid #afafaf;margin-top:10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <span id="customer_rewards_text_<?=$booking->id;?>">Rewards Balance: <?= $booking->rewards_balance?></span>
                                                        <div id="used_rewards_msg_<?=$booking->id;?>"></div>
                                                        <input type="hidden" name="customer_reward_available_<?=$booking->id;?>" id="customer_reward_available_<?=$booking->id;?>" value="<?=$booking->rewards_balance; ?>">
                                                        <input type="hidden" name="customer_gender_<?=$booking->id;?>" id="customer_gender_<?=$booking->id;?>" value="<?=$booking->customer_gender;?>">
                                                    </th>
                                                    <th style="text-align: right;">
                                                        <button id="rewards_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyRewards(<?=$booking->id;?>)">Apply</button>
                                                        <!-- <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the reward points?')) removeRewards(<?=$booking->id;?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                        <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('re you sure you want to remove the reward points?', function(confirmed) { if (confirmed) { removeRewards(<?=$booking->id;?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-5" style="margin-top: 40px;">
                                    <div class="form-group col-md-12 col-xs-12">
                                        <label>Send Appointments Details<b class="require">*</b></label>
                                        <select class="form-control form-select" name="send_appointment_details_<?=$booking->id;?>" id="send_appointment_details_<?=$booking->id;?>" onchange="toggleMessageType(<?=$booking->id;?>)">
                                            <option value="">Select Option</option>
                                            <option value="1" selected>Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        <label for="send_appointment_details_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                    <div class="form-group col-md-12 col-xs-12" id="message_type_div_<?=$booking->id;?>" style="display:none;">
                                        <label>Select Message Type<b class="require">*</b></label>
                                        <select class="form-control form-select" name="message_type_<?=$booking->id;?>" id="message_type_<?=$booking->id;?>">
                                            <option value="">Select Option</option>
                                            <option value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'selected'; }?>>SMS</option>
                                            <option value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'selected'; }?>>Email</option>
                                            <option value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'selected'; }?>>Whatapp</option>
                                        </select>
                                        <label for="message_type_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="customer_id_<?=$booking->id;?>" id="customer_id_<?=$booking->id;?>" value="<?=$booking->customer_id;?>">
                        <input type="hidden" name="customer_pending_amount_<?=$booking->id;?>" id="customer_pending_amount_<?=$booking->id;?>" value="<?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? $booking->current_pending_amount : '0.00';?>">
                        <input type="hidden" name="package_id_<?=$booking->id;?>" id="package_id_<?=$booking->id;?>" value="<?=$booking->pacakge_id;?>">
                        <input type="hidden" name="package_amount_<?=$booking->id;?>" id="package_amount_<?=$booking->id;?>" value="<?=$booking->package_amount;?>">
                        <input type="hidden" name="selected_coupon_id_<?=$booking->id;?>" id="selected_coupon_id_<?=$booking->id;?>" value="<?=($booking->selected_coupon_id != "" && $booking->selected_coupon_id != null && $booking->selected_coupon_id != "0") ? $booking->selected_coupon_id : '';?>">
                        <input type="hidden" name="is_membership_booking_<?=$booking->id;?>" id="is_membership_booking_<?=$booking->id;?>" value="<?=$is_member;?>">
                        <input type="hidden" name="membership_id_<?=$booking->id;?>" id="membership_id_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->membership_id : '';?>">
                        <input type="hidden" name="membership_discount_type_<?=$booking->id;?>" id="membership_discount_type_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->discount_in : '';?>">
                        <input type="hidden" name="m_service_discount_<?=$booking->id;?>" id="m_service_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->service_discount : '0';?>">
                        <input type="hidden" name="m_product_discount_<?=$booking->id;?>" id="m_product_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->product_discount : '0';?>">
                        <input type="hidden" name="is_giftcard_applied_<?=$booking->id;?>" id="is_giftcard_applied_<?=$booking->id;?>" value="">
                        <input type="hidden" name="applied_giftcard_id_<?=$booking->id;?>" id="applied_giftcard_id_<?=$booking->id;?>" value="">
                        
                        <input type="hidden" name="total_service_amount_<?=$booking->id;?>" id="total_service_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="total_product_amount_<?=$booking->id;?>" id="total_product_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="coupon_discount_amount_<?=$booking->id;?>" id="coupon_discount_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="reward_discount_amount_<?=$booking->id;?>" id="reward_discount_amount_<?=$booking->id;?>" value="0.00">    
                        <input type="hidden" name="used_rewards_<?=$booking->id;?>" id="used_rewards_<?=$booking->id;?>" value="0">    
                        <input type="hidden" name="gift_discount_<?=$booking->id;?>" id="gift_discount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="m_service_discount_amount_<?=$booking->id;?>" id="m_service_discount_amount_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="m_product_discount_amount_<?=$booking->id;?>" id="m_product_discount_amount_<?=$booking->id;?>" value="0.00">
                        
                        <input type="hidden" name="service_payable_hidden_<?=$booking->id;?>" id="service_payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="product_payable_hidden_<?=$booking->id;?>" id="product_payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="payable_hidden_<?=$booking->id;?>" id="payable_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="total_discount_hidden_<?=$booking->id;?>" id="total_discount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="booking_amount_hidden_<?=$booking->id;?>" id="booking_amount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="gst_amount_hidden_<?=$booking->id;?>" id="gst_amount_hidden_<?=$booking->id;?>" value="0.00">
                        <input type="hidden" name="grand_total_hidden_<?=$booking->id;?>" id="grand_total_hidden_<?=$booking->id;?>" value="0.00">
                        <div class="col-lg-4">
                            <div class="calender_booking_details booking_pricing_div" style="border: 0.5px solid #afafaf;">
                                <table style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Service Price</th>
                                            <th id="total_service_amount_text_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr>
                                            <th>Products Price</th>
                                            <th id="total_product_amount_text_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <?php if($booking->pacakge_id != "" && $booking->package_amount != "" && $booking->package_amount != "0.00"){ ?>
                                        <tr>
                                            <th>Package Price <?php if(!empty($package_details)){ ?><small>(<?=$package_details->package_name;?>)</small><?php } ?></th>
                                            <th id="package_price_<?=$booking->id;?>"><?=$booking->package_amount;?></th>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <th>
                                                Discount                                        
                                                <div id="discount_details_div_<?=$booking->id;?>" style="position: relative;display:inline-block; width:auto;"></div>
                                            </th>
                                            <th id="discount_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr style="border-top: 0.5px solid #afafaf;">
                                            <th>Total Amount</th>
                                            <th id="booking_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr>
                                            <th>GST <small>(18%)</small></th>
                                            <th id="gst_amount_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                        <tr style="border-top: 0.5px solid #afafaf;">
                                            <th>Total</th>
                                            <th id="grand_total_<?=$booking->id;?>">0.00</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 bill_generation_prices" style="margin-top:10px;">
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Amount<b class="require">*</b></label>
                                    <input type="number" class="form-control" name="paid_amount_<?=$booking->id;?>" id="paid_amount_<?=$booking->id;?>" placeholder="Enter Paid Amount" value="" onkeyup="calculatePendingAmount(<?=$booking->id;?>)">
                                    <label for="paid_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Pending Amount<b class="require"></b></label>
                                    <input readonly type="number" class="form-control" name="pending_amount_<?=$booking->id;?>" id="pending_amount_<?=$booking->id;?>" placeholder="Enter Pending Amount" value="">
                                    <label for="pending_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Mode<b class="require">*</b></label>
                                    <select class="form-control form-select" name="payment_mode_<?=$booking->id;?>" id="payment_mode_<?=$booking->id;?>">
                                        <option value="">Select Payment Mode</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Online">Online</option>
                                    </select>
                                    <label for="payment_mode_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Payment Date<b class="require">*</b></label>
                                    <input readonly type="date" class="form-control" name="payment_date_<?=$booking->id;?>" id="payment_date_<?=$booking->id;?>" value="<?php echo date("Y-m-d"); ?>">
                                    <label for="payment_date_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="payment_btn_<?=$booking->id;?>" name="payment_btn_<?=$booking->id;?>" value="payment_btn_<?=$booking->id;?>">Generate Bill</button>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </form>              
                <script>
                    $(document).ready(function () {    
                        $("#booking_date_<?=$booking->id;?>").datepicker({
                            dateFormat: 'dd-mm-yy',
                            maxDate: '<?php echo $max_date; ?>',
                            minDate: '<?php echo $today; ?>',
                        });                     
                        $("#chosen-select").chosen();
                        var selected_service_details = <?php echo json_encode($all_service_details_ids); ?>;
                        var bookingID = <?php echo $booking->id; ?>;
                        $('.loader_div').show();   
                        setTimeout(function() {
                            for(k=0;k<selected_service_details.length;k++){
                                setServicePrice(selected_service_details[k],bookingID);
                            }
                            $('.loader_div').hide(); 
                        }, 1500);

                        toggleMessageType(bookingID);

                        var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                        var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                        if(selected_coupon_id != "" && selected_coupon_id != '0'){
                            applyCoupon(bookingID,selected_coupon_id,'previous');
                        }else if(is_giftcard_applied == '1'){
                            applyGiftCard(bookingID,'previous');
                        }

                        $('#payment_form_<?=$booking->id;?>').validate({
                            ignore:[],
                            rules: {
                                'service_checkbox_<?=$booking->id;?>[]': {
                                    required: true,
                                },
                                'payment_date_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'payment_mode_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'paid_amount_<?=$booking->id;?>': {
                                    required: true,
                                    number: true,
                                    min: 0,
                                },
                                'send_appointment_details_<?=$booking->id;?>': {
                                    required: true,
                                },
                                'message_type_<?=$booking->id;?>': {
                                    required: function(element) {
                                        return $('#send_appointment_details_<?=$booking->id;?>').val() == '1';
                                    },
                                },
                                <?php if(!empty($booking_services)){
                                    foreach($booking_services as $booking_services_result){ ?>
                                        'new_stylist_<?=$booking_services_result->id;?>': {
                                            required: true,
                                        },
                                <?php }} ?>
                            },
                            messages: {
                                'service_checkbox_<?=$booking->id;?>[]': {
                                    required: "Please select at least one service!",
                                },
                                'payment_date_<?=$booking->id;?>': {
                                    required: "Please select payment date!",
                                },
                                'payment_mode_<?=$booking->id;?>': {
                                    required: "Please select payment mode!",
                                },
                                'paid_amount_<?=$booking->id;?>': {
                                    required: "Please enter payment amount!",
                                    number: "Please enter number only!",
                                    min: "Minimum amount 0 is allowed!",
                                },
                                'send_appointment_details_<?=$booking->id;?>': {
                                    required: "Please select option!",
                                },
                                'message_type_<?=$booking->id;?>': {
                                    required: "Please select option!",
                                },
                                <?php if(!empty($booking_services)){
                                    foreach($booking_services as $booking_services_result){ ?>
                                        'new_stylist_<?=$booking_services_result->id;?>': {
                                            required: "Please select stylist!",
                                        },
                                <?php }} ?>
                            },
                            submitHandler: function(form) {
                                if(confirm("Are you sure to generate bill?")) {
                                // openConfirmationDialog("Are you sure to generate bill?", function (confirmed) {
                                // if (confirmed) {
                                    form.submit();
                                } else {
                                    return false;
                                }
                                // });
                            }
                        });
                    });
                    $('#payment_date_<?=$booking->id;?>').datepicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: 0
                    });
                    function toggleMessageType(bookingID){
                        if($('#send_appointment_details_' + bookingID).val() == '1'){
                            $('#message_type_div_' + bookingID).show();
                        }else{
                            $('#message_type_div_' + bookingID).hide();
                        }
                    }
                </script>
            <?php 
            }else{ 
            ?>
                <div>
                    <label class="error">Booking details not found</label>
                </div>
            <?php 
            }
        }else{ 
        ?>
        <div>
            <label class="error">Booking rules not available</label>
        </div>
        <?php
        }
    }    
    public function get_service_products_details_ajx(){
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules)){
            $booking_details_id = $this->input->post('booking_details_id');
            $this->db->select('tbl_booking_services_products_details.*,tbl_product.product_name, tbl_new_booking.amount_to_paid, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_products_details.service_id');
            $this->db->join('tbl_product','tbl_product.id = tbl_booking_services_products_details.product_id');
            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_products_details.customer_name');
            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_products_details.booking_id');
            $this->db->where('tbl_booking_services_products_details.booking_service_details_id',$booking_details_id);
            $this->db->where('tbl_booking_services_products_details.is_deleted','0');
            $booking_products = $this->db->get('tbl_booking_services_products_details')->result();

            if(!empty($booking_products)){
                $this->db->select('tbl_booking_services_details.*, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
                $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
                $this->db->where('tbl_booking_services_details.id',$booking_details_id);
                $booking_service = $this->db->get('tbl_booking_services_details')->row();
            ?>
                <div class="calender_booking_details">
                    <label style="font-size:15px;"><?php if(!empty($booking_service)){ echo $booking_service->service_name.' '; } ?>Product Details</label>
                </div>
                <div class="calender_booking_details">
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Product</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($booking_products)){
                                    foreach($booking_products as $booking_products_result){
                            ?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <th><?=$booking_products_result->product_name;?></th>
                                <th><?=($booking_products_result->product_price != "") ? 'Rs. '.$booking_products_result->product_price : 'Rs. 0.00';?></th>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            <?php 
            }else{ 
            ?>
                <div>
                    <label class="error">Products not found</label>
                </div>
            <?php 
            }
        }else{ 
        ?>
        <div>
            <label class="error">Booking rules not available</label>
        </div>
        <?php
        }
    }
    
    public function get_all_bookings_payments($booking_id){
        $this->db->select('tbl_service_payment.*');
        $this->db->where('tbl_service_payment.booking_id',$booking_id);
        $this->db->where('tbl_service_payment.is_deleted','0');
        $this->db->order_by('tbl_service_payment.id','asc');
        $payments = $this->db->get('tbl_service_payment')->result();
        return $payments;
    }
    public function get_customer_payments_ajx(){
        $customer = $this->input->post('customer');

        $this->db->where('tbl_salon_customer.id',$customer);
        $customer_details = $this->db->get('tbl_salon_customer')->row();

        $this->db->select('tbl_booking_payment_entry.*');
        $this->db->where('tbl_booking_payment_entry.customer_id',$customer);
        $this->db->where('tbl_booking_payment_entry.is_deleted','0');
        $this->db->order_by('tbl_booking_payment_entry.id','asc');
        $payments = $this->db->get('tbl_booking_payment_entry')->result();

        if(!empty($payments)){
        ?>
            <div class="calender_booking_details">
                <label style="font-size:15px;"><?php if(!empty($customer_details)){ echo $customer_details->full_name.' Payments'; } ?></label>
            </div>
            <div class="calender_booking_details">
                <table style="width:100%;" id="payments_table_<?=$customer;?>">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <!-- <th>Opening Pending Amount</th> -->
                            <th>Paid Amount</th>
                            <!-- <th>Closing Pending Amount</th> -->
                            <th>Payment Date</th>
                            <th>Payment Mode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach($payments as $payments_result){ 
                        ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <!-- <td><?=$payments_result->opening_pending_amount;?></td> -->
                            <td><?=$payments_result->paid_amount;?></td>
                            <!-- <td><?=$payments_result->closing_pending_amount;?></td> -->
                            <td><?=date('d-m-Y',strtotime($payments_result->payment_date));?></td>
                            <td><?=$payments_result->payment_mode;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <script>                
                $('#payments_table_<?=$customer;?>').DataTable({ 
                    dom: 'Bfrtip',
                    responsive: true,
                    scrollX: false,
                    lengthMenu: [ [10, 25, 50,], [10, 25, 50] ],                    
                    buttons: [                            
                        {
                            extend: 'excel',
                            filename: 'course-list',
                            exportOptions: {
                                columns: [0,1,2,3] 
                            }
                        }                            
                    ], 
                });
            </script>
        <?php }else{ ?>
            <div>
                <label class="error">Payments not found</label>
            </div>
        <?php } 
    }
    
    
    public function add_customer_payment_ajx(){
        $customer = $this->input->post('customer');

        $this->db->where('tbl_salon_customer.id',$customer);
        $customer_details = $this->db->get('tbl_salon_customer')->row();

        if(!empty($customer_details)){
        ?>
            <div class="calender_booking_details">
                <label style="font-size:15px;"><?php if(!empty($customer_details)){ echo 'Payment for '. $customer_details->full_name; } ?></label>
            </div>
            <div class="calender_booking_details">                
                <form method="post" name="payment_form_<?=$customer_details->id;?>" id="payment_form_<?=$customer_details->id;?>" action="<?=base_url();?>add-customer-payment/<?=base64_encode($customer_details->id);?>">
                    <div class="row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Current Pending Amount<b class="require"></b></label>
                            <input readonly type="text" class="form-control" id="pending_amount_<?=$customer_details->id; ?>" name="pending_amount_<?=$customer_details->id; ?>" value="<?=($customer_details->current_pending_amount != "" && $customer_details->current_pending_amount != null && $customer_details->current_pending_amount != "0" && $customer_details->current_pending_amount != "0.0") ? $customer_details->current_pending_amount : '0.00'; ?>">
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Paid Amount<b class="require">*</b></label>
                            <input placeholder="Enter Paid Amount" max="<?=($customer_details->current_pending_amount != "" && $customer_details->current_pending_amount != null && $customer_details->current_pending_amount != "0" && $customer_details->current_pending_amount != "0.0") ? $customer_details->current_pending_amount : '0.00'; ?>" type="number" class="form-control" id="paid_amount_<?=$customer_details->id; ?>" name="paid_amount_<?=$customer_details->id; ?>" value="" onkeyup="calculatePendingAmount(<?=$customer_details->id; ?>)">
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>New Pending Amount<b class="require"></b></label>
                            <input readonly type="text" class="form-control" id="new_pending_amount_<?=$customer_details->id; ?>" name="new_pending_amount_<?=$customer_details->id; ?>" value="">
                        </div>
                    </div>    
                    <input type="hidden" id="total_bill_amount_<?=$customer_details->id; ?>" name="total_bill_amount_<?=$customer_details->id; ?>" value="<?=$customer_details->total_bill_amount; ?>">
                    <input type="hidden" id="total_paid_amount_<?=$customer_details->id; ?>" name="total_paid_amount_<?=$customer_details->id; ?>" value="<?=$customer_details->total_paid_amount; ?>">               
                    <div class="row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Payment Mode<b class="require">*</b></label>
                            <select class="form-control form-select" name="payment_mode_<?=$customer_details->id;?>" id="payment_mode_<?=$customer_details->id;?>">
                                <option value="">Select Payment Mode</option>
                                <option value="UPI">UPI</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Payment Date<b class="require">*</b></label>
                            <input readonly type="date" class="form-control" name="payment_date_<?=$customer_details->id;?>" id="payment_date_<?=$customer_details->id;?>" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 col-xs-12">
                            <label>Remark <b class="require">*</b></label>
                            <textarea class="form-control" placeholder="Enter Remark" name="remark_<?=$customer_details->id;?>" id="remark_<?=$customer_details->id;?>"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12 col-xs-12">
                                <button type="submit" class="btn btn-primary" id="payment_btn" value="payment_btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script>    
                $("#payment_date_<?=$customer_details->id;?>").datepicker({
                    dateFormat: 'dd-mm-yy',
                    maxDate: '<?php echo date('Y-d-m'); ?>',
                });    
                $('#payment_form_<?=$customer_details->id;?>').validate({
                    ignore:[],
                    rules: {
                        'payment_date_<?=$customer_details->id;?>': {
                            required: true,
                        },
                        'payment_mode_<?=$customer_details->id;?>': {
                            required: true,
                        },
                        'paid_amount_<?=$customer_details->id;?>': {
                            required: true,
                            number: true,
                            min: 1,
                        },
                        'remark_<?=$customer_details->id;?>': {
                            required: true,
                        },
                    },
                    messages: {
                        'payment_date_<?=$customer_details->id;?>': {
                            required: "Please select payment date!",
                        },
                        'payment_mode_<?=$customer_details->id;?>': {
                            required: "Please select payment mode!",
                        },
                        'paid_amount_<?=$customer_details->id;?>': {
                            required: "Please enter payment amount!",
                            number: "Please enter number only!",
                            min: "Minimum amount 1 is allowed!",
                        },
                        'remark_<?=$customer_details->id;?>': {
                            required: "Please enter remark!",
                        },
                    },
                    submitHandler: function(form) {
                        if(confirm("Are you sure to add payment?")) {
                        // openConfirmationDialog("Are you sure to add payment?", function (confirmed) {
                        // if (confirmed) {
                            form.submit();
                        } else {
                            return false;
                        }
                        // });
                    }
                });
            </script>
        <?php }else{ ?>
            <div>
                <label class="error">Payments not found</label>
            </div>
        <?php } 
    }
    
    public function get_booking_service_details($id){
        $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.booking_id',$id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $result = $this->db->get('tbl_booking_services_details')->result();
        return $result;
    }
    
    public function show_service_reschedule_popup_ajx(){
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules)){
            $days_early_booking = $booking_rules->max_booking_range_day;
            if($days_early_booking != ""){
                $max_date = date('d-m-Y', strtotime('+'.$days_early_booking.' day'));
            }else{
                $max_date = date('d-m-Y', strtotime('+0 day'));
            }
        }else{
            $max_date = date('d-m-Y', strtotime('+0 day'));
        }
        $today = date('d-m-Y');

        $booking_service_details_id = $this->input->post('booking_service_details_id');

        $this->db->select('tbl_booking_services_details.*,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.id',$booking_service_details_id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $bookings = $this->db->get('tbl_booking_services_details')->row();

        if(!empty($bookings)){ 
            $products = explode(',',$bookings->product_ids);
            $product_details_str = '';
            if (empty($products)) {
                $product_details_str = '-';
            } else {
                for ($k = 0; $k < count($products); $k++) {
                    $product_details = $this->get_product_details($products[$k]);
                    if (!empty($product_details)) {
                        $product_details_str .= $product_details->product_name;
                        if ($k < count($products) - 1) {
                            $product_details_str .= ', ';
                        }
                    }
                }
            }
        ?>
            <div class="calender_booking_details">
                <table style="width:100%;" border="1">
                    <thead>
                        <tr>
                            <th>Customer:</th>
                            <td><?=$bookings->customer_name;?>, <?=$bookings->customer_phone;?></td>
                        </tr>
                        <tr>
                            <th>Service:</th>
                            <td><?=$bookings->service_name;?> | <?=$bookings->service_name_marathi;?> <?php if($bookings->service_added_from == '1') { ?><small>(Package Service)</small><?php } ?></td>
                        </tr>
                        <?php if($product_details_str != ""){ ?>
                        <tr>
                            <th>Products:</th>
                            <td><?=$product_details_str; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th>Scheduled On:</th>
                            <td><?=date('d-m-Y',strtotime($bookings->service_date));?>, <?=date('h:i A',strtotime($bookings->service_from));?> to <?=date('h:i A',strtotime($bookings->service_to));?></td>
                        </tr>
                        <tr>
                            <th>Stylist:</th>
                            <td><?=$bookings->stylist_name;?></td>
                        </tr>
                    </thead>
                </table>
                <!-- <form method="post" name="reschedule_form_<?=$bookings->id;?>" id="reschedule_form_<?=$bookings->id;?>" action="<?=base_url();?>reschedule_service/<?=base64_encode($bookings->id);?>">
                    <input type="hidden" name="service_id_<?=$bookings->id;?>" id="service_id_<?=$bookings->id;?>" value="<?=$bookings->service_id;?>">    
                    <input type="hidden" name="service_details_id_<?=$bookings->id;?>" id="service_details_id_<?=$bookings->id;?>" value="<?=$bookings->id;?>">    
                    <input type="hidden" name="service_duration_<?=$bookings->id;?>" id="service_duration_<?=$bookings->id;?>" value="<?=$bookings->service_duration;?>">    
                    <input type="hidden" name="service_stylist_timeslot_hidden_<?=$bookings->id;?>" id="service_stylist_timeslot_hidden_<?=$bookings->id;?>" value="">    
                    <div class="row">                
                        <div class="col-lg-3 form-group">
                            <label for="service_date">Select Date*</label>
                            <input type="text" class="form-control" name="service_date_<?=$bookings->id;?>" id="service_date_<?=$bookings->id;?>" onchange="fetchTimeSlotsReschedule(<?=$bookings->id;?>)" value="<?=date('d-m-Y', strtotime($bookings->service_date));?>">
                        </div>
                        <div class="col-lg-3 form-group">
                            <label for="service_date">Service Start*</label>
                            <input readonly type="text" class="form-control" name="service_start_<?=$bookings->id;?>" id="service_start_<?=$bookings->id;?>" placeholder="Service Start Time" value="<?=date('h:i A', strtotime($bookings->service_from));?>">
                        </div> 
                        <div class="col-lg-6 form-group" style="display:none;" id="service_executive_div_<?=$bookings->id;?>">
                            <label for="service_executive">Select Stylist*</label>
                            <select class="form-control" name="service_executive_<?=$bookings->id;?>" id="service_executive_<?=$bookings->id;?>"></select>
                            <label for="service_executive_<?=$bookings->id;?>" style="display:none;" generated="true" class="error">Please select stylist!</label>
                        </div>            
                        <div class="col-lg-12 form-group">
                            <label for="service_date">Select Time Slot*</label>
                            <div id="booking_timeslots_<?=$bookings->id;?>"></div>
                        </div>          
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary" id="submit_reschedule">Submit</button>
                        </div>
                    </div>
                </form> -->
                <input type="hidden" name="service_id_<?=$bookings->id;?>" id="service_id_<?=$bookings->id;?>" value="<?=$bookings->service_id;?>">    
                <input type="hidden" name="service_details_id_<?=$bookings->id;?>" id="service_details_id_<?=$bookings->id;?>" value="<?=$bookings->id;?>">    
                <input type="hidden" name="service_duration_<?=$bookings->id;?>" id="service_duration_<?=$bookings->id;?>" value="<?=$bookings->service_duration;?>">    
                <input type="hidden" name="service_stylist_timeslot_hidden_<?=$bookings->id;?>" id="service_stylist_timeslot_hidden_<?=$bookings->id;?>" value="">    
                <div class="row" id="reschedule_btn_div" style="margin-top:20px;">                
                    <div class="col-lg-3 form-group">
                        <label for="service_date">Select Date*</label>
                        <input style="margin-left:0px !important;" type="text" class="form-control" name="service_date_<?=$bookings->id;?>" id="service_date_<?=$bookings->id;?>" onchange="fetchTimeSlotsReschedule(<?=$bookings->id;?>)" value="<?=date('d-m-Y', strtotime($bookings->service_date));?>">
                        <label for="service_date_<?=$bookings->id;?>" id="service_date_error_<?=$bookings->id;?>" style="display:none;" generated="true" class="error">Please select date!</label>
                    </div>
                    <div class="col-lg-3 form-group">
                        <label for="service_date">Service Start*</label>
                        <input style="margin-left:0px !important;" readonly type="text" class="form-control" name="service_start_<?=$bookings->id;?>" id="service_start_<?=$bookings->id;?>" placeholder="Service Start Time" value="<?=date('h:i A', strtotime($bookings->service_from));?>">
                    </div> 
                    <div class="col-lg-6 form-group" style="display:none;" id="service_executive_div_<?=$bookings->id;?>">
                        <label for="service_executive">Select Stylist*</label>
                        <select class="form-control" name="service_executive_<?=$bookings->id;?>" id="service_executive_<?=$bookings->id;?>"></select>
                        <label for="service_executive_<?=$bookings->id;?>" id="service_executive_error_<?=$bookings->id;?>" style="display:none;" generated="true" class="error">Please select stylist!</label>
                    </div>            
                    <div class="col-lg-12 form-group">
                        <label for="service_date">Select Time Slot*</label>
                        <div id="booking_timeslots_<?=$bookings->id;?>"></div>
                    </div>          
                    <div class="col-lg-12 form-group">
                        <button type="button" class="btn btn-primary" id="submit_reschedule" onclick="rescheduleService(<?=$bookings->id;?>)">Submit</button>
                    </div>
                </div>
            </div>
            <script>
            let user_selected_reschedule_service = [$('#service_id_<?=$bookings->id;?>').val()];
            $(document).ready(function () {   
                fetchTimeSlotsReschedule(<?=$bookings->id;?>);     
                $('#reschedule_form_<?=$bookings->id;?>').validate({
                    ignore : [],
                    rules: {
                        service_executive_<?=$bookings->id;?>: {
                            required: true,
                        },
                        service_date_<?=$bookings->id;?>: {
                            required: true,
                        },
                    },
                    messages: {
                        service_executive_<?=$bookings->id;?>: {
                            required:'Please select stylist!',
                        },
                        service_date_<?=$bookings->id;?>: {
                            required: "Please select date!",
                        },
                    },
                    submitHandler: function(form) {
                        if(confirm("Are you sure to reschedule service?")) {
                        // openConfirmationDialog("Are you sure to reschedule service?", function (confirmed) {
                        // if (confirmed) {
                            form.submit();
                        } else {
                            return false;
                        }
                        // });
                    }
                });
                $("#service_date_<?=$bookings->id;?>").datepicker({
                    dateFormat: 'dd-mm-yy',
                    maxDate: '<?php echo $max_date; ?>',
                    minDate: '<?php echo $today; ?>',
                });
            });              
            function formatToOnlyDate_PHPFormatResc(date) {
                var year = date.getFullYear();
                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding leading zero if necessary
                var day = ('0' + date.getDate()).slice(-2); // Adding leading zero if necessary
                return year + '-' + month + '-' + day;
            }                               
            function convertTo24HourFormatResc(time) {
                var hours = parseInt(time.split(':')[0]);
                var minutes = parseInt(time.split(':')[1].split(' ')[0]);
                var ampm = time.split(' ')[1];

                if (ampm === 'PM' && hours < 12) {
                    hours += 12;
                }
                if (ampm === 'AM' && hours === 12) {
                    hours = 0;
                }

                var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':00';
                return formattedTime;
            }
            function fetchTimeSlotsReschedule(booking_details_id){
                var booking_date = $('#service_date_' + booking_details_id).val();
                var booking_start = $('#service_start_' + booking_details_id).val();
                if(booking_date != ""){
                    $('#booking_timeslots_' + booking_details_id).html('');
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url();?>salon/Ajax_controller/get_day_timeslots_reschedule_ajx",
                        data:{
                            'booking_details_id':booking_details_id,
                            'booking_date':booking_date,
                            'booking_start':booking_start,
                            'user_selected_service': user_selected_reschedule_service
                        },
                        success: function(data){
                            $('#booking_timeslots_' + booking_details_id).show();
                            $('#booking_timeslots_' + booking_details_id).html(data);

                            if(booking_start != ""){
                                setServiceTimeSlotsReschedule(booking_details_id);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    }); 
                }
            }
            function setBookingStartReschedule(booking_details_id,value){
                if(value == ""){
                    var selectedValue = $('input[name="booking_start_time_slot_' + booking_details_id + ']:checked').val();
                }else{
                    var selectedValue = value;
                }
                if (selectedValue != "") {
                    // $('#booking_timeslots').hide();
                    $('#service_start_' + booking_details_id).val(selectedValue);

                    fetchTimeSlotsReschedule(booking_details_id);
                }
            }
            function setServiceTimeSlotsReschedule(booking_details_id){
                $('#service_executive_error_' + booking_details_id).hide();
                $('#service_executive_error_' + booking_details_id).text('');
                $('#service_date_error_' + booking_details_id).hide();
                $('#service_date_error_' + booking_details_id).text('');
                for(var i=0;i<user_selected_reschedule_service.length;i++){
                    var singleService = user_selected_reschedule_service[i];            
                    var service_duration = $('#service_duration_' + booking_details_id).val();

                    var booking_date = $('#service_date_' + booking_details_id).val();

                    if(booking_date != "" && $('#service_start_' + booking_details_id).val() != ""){
                        var booking_start = $('#service_start_' + booking_details_id).val();
                        var dateParts = booking_date.split("-");
                        var day = parseInt(dateParts[0], 10);
                        var month = parseInt(dateParts[1], 10);
                        var year = parseInt(dateParts[2], 10);

                        booking_start = convertTo24HourFormatResc(booking_start)

                        var timeParts = booking_start.split(":");
                        var hours = parseInt(timeParts[0], 10);
                        var minutes = parseInt(timeParts[1], 10);

                        if (booking_start.includes("PM") && hours !== 12) {
                            hours += 12;
                        } else if (booking_start.includes("AM") && hours === 12) {
                            hours = 0;
                        }
                        
                        selected_slot_start = new Date(year, month - 1, day, hours, minutes, 0);
                        var selected_slot_end = new Date(selected_slot_start.getTime() + (service_duration * 60000));

                        var formatted_slot_start_time = formatTime(selected_slot_start);
                        var formatted_slot_end_time = formatTime(selected_slot_end);

                        var formatted_slot_start_time_24hr = convertTo24HourFormatResc(formatted_slot_start_time);
                        var formatted_slot_end_time_24hr = convertTo24HourFormatResc(formatted_slot_end_time);
                        var formatted_booking_date_PHP = formatToOnlyDate_PHPFormatResc(selected_slot_start);
                        var timeslot_string = formatted_booking_date_PHP + ' ' + formatted_slot_start_time_24hr + '@@@' + formatted_booking_date_PHP + ' ' + formatted_slot_end_time_24hr;

                        $('#service_stylist_timeslot_hidden_'+ booking_details_id +'').val(timeslot_string);

                        getTimeStylistResc(booking_details_id,booking_date,selected_slot_start,selected_slot_end,singleService,service_duration);
                    }
                }
            }
            function formatTime(time) {
                var hours = time.getHours();
                var minutes = time.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;

                return hours + ':' + minutes + ' ' + ampm;
            }            
                
            function formatDate(date) {
                var year = date.getFullYear();
                var month = ('0' + (date.getMonth() + 1)).slice(-2);
                var day = ('0' + date.getDate()).slice(-2);
                var hours = ('0' + date.getHours()).slice(-2);
                var minutes = ('0' + date.getMinutes()).slice(-2);
                var seconds = ('0' + date.getSeconds()).slice(-2);

                return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
            } 
            
            function getTimeStylistResc(booking_details_id,booking_date,selected_slot_start,selected_slot_end,serviceID,service_duration){
                var formatted_start = formatDate(selected_slot_start);
                var formatted_end = formatDate(selected_slot_end);
                if (formatted_start !== "" && typeof formatted_start !== "undefined" && formatted_end !== "" && typeof formatted_end !== "undefined") {
                    selectedTimeSlot = formatted_start + '@@@' + formatted_end;

                    $("#service_executive_div_"+booking_details_id).hide();
                    $("#service_executive_"+booking_details_id).html("");
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_servicewise_ajx",
                        data: { 'service':serviceID,'selectedTimeSlot': selectedTimeSlot },
                        success: function(data) {
                            $("#service_executive_"+booking_details_id).chosen();
                            $("#service_executive_"+booking_details_id).val('');
                            var stylists = $.parseJSON(data);
                            if(stylists.length > 0){
                                $("#service_executive_"+booking_details_id).empty();
                                $("#service_executive_"+booking_details_id).append('<option value="">Select Executive</option>');
                                var opts = $.parseJSON(data);
                                var count = 1;
                                console.log(opts)
                                $.each(opts, function(i, d) {
                                    store_flag = d.store_flag;
                                    is_service_available = d.is_service_available;
                                    is_shift_available = d.is_shift_available;
                                    is_booking_present = d.is_booking_present;
                                    is_on_break = d.is_on_break;
                                    if(is_service_available == '1'){
                                        if(store_flag == '1'){
                                            if(is_shift_available == '1'){
                                                if(is_booking_present == '0'){
                                                    if(is_on_break == '0'){
                                                        var message = '';
                                                        var disabled = '';
                                                        var is_Allowed = 1;
                                                        if(count == 1){
                                                            var selected = 'selected';
                                                        }
                                                    }else{
                                                        var message = '- Stylist On Break';
                                                        var disabled = 'disabled';
                                                        var is_Allowed = 0;
                                                    }
                                                }else{
                                                    var message = '- Slot Already Booked';
                                                    // var message = '- Not Available';
                                                    var disabled = 'disabled';
                                                    var is_Allowed = 0;
                                                }
                                            }else{
                                                var message = '- Shift Not Available';
                                                var disabled = 'disabled';
                                                var is_Allowed = 0;
                                            }
                                        }else{
                                            var message = '- Exceed Salon Times';
                                            var disabled = 'disabled';
                                            var is_Allowed = 0;
                                        }

                                        if(is_Allowed == 1){
                                            if(count == 1){
                                                var selected = 'selected';
                                            }else{
                                                var selected = '';
                                            }
                                        }else{
                                            var selected = '';
                                        }

                                        $("#service_executive_"+booking_details_id).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                                    
                                        count++;
                                    }else{
                                        var disabled = 'disabled';
                                        var message = '- Stylist Not Available';
                                    }
                                });
                                $("#service_executive_"+booking_details_id).trigger('chosen:updated');
                                $("#service_executive_div_"+booking_details_id).show();
                            }
                        },
                    });
                }
            }
            </script>
        <?php 
        }else{ 
        ?>
            <div>
                <label class="error">Booking details not found</label>
            </div>
        <?php 
        }
    }
    
    
    public function show_service_complete_popup_ajx(){
        $booking_service_details_id = $this->input->post('booking_service_details_id');

        $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_new_booking.payment_status,tbl_new_booking.payment_date,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.id',$booking_service_details_id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $bookings = $this->db->get('tbl_booking_services_details')->row();

        if(!empty($bookings)){
        ?>
            <div class="calender_booking_details">
                <table style="width:100%;" border="1">
                    <thead>
                        <tr>
                            <th>Customer:</th>
                            <td><?=$bookings->customer_name;?>, <?=$bookings->customer_phone;?></td>
                        </tr>
                        <tr>
                            <th>Service:</th>
                            <td><?=$bookings->service_name;?> | <?=$bookings->service_name_marathi;?> <?php if($bookings->service_added_from == '1') { ?><small>(Package Service)</small><?php } ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?=date('d-m-Y',strtotime($bookings->service_date));?></td>
                        </tr>
                        <tr>
                            <th>Duration:</th>
                            <td><?=date('h:i A',strtotime($bookings->service_from));?> to <?=date('h:i A',strtotime($bookings->service_to));?></td>
                        </tr>
                        <tr>
                            <th>Stylist:</th>
                            <td><?=$bookings->stylist_name;?></td>
                        </tr>
                    </thead>
                </table>
                <!-- <form method="post" name="payment_form_<?=$bookings->id;?>" id="payment_form_<?=$bookings->id;?>" action="<?=base_url();?>complete_booking_service/<?=base64_encode($bookings->id);?>">
                    <div class="col-md-12">
                        <div class="form-group col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary" id="payment_btn" value="payment_btn">Complete Service</button>
                        </div>
                    </div>
                </form> -->
                <div class="col-md-12" style="margin-top:20px;">
                    <div class="form-group col-md-12 col-xs-12" id="payment_btn_div">
                        <button type="button" class="btn btn-primary" id="payment_btn" value="payment_btn" onclick="completeService(<?=$bookings->id;?>,<?=$bookings->stylist_id;?>)">Complete Service</button>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function () {        
                $('#payment_form_<?=$bookings->id;?>').validate({
                    rules: {},
                    messages: {},
                    submitHandler: function(form) {
                        if(confirm("Are you sure to complete service?")) {
                        // openConfirmationDialog("Are you sure to complete service?", function (confirmed) {
                        // if (confirmed) {
                            form.submit();
                        } else {
                            return false;
                        }
                        // });
                    }
                });
            });
            </script>
        <?php 
        }else{ 
        ?>
            <div>
                <label class="error">Booking details not found</label>
            </div>
        <?php 
        }
    }
    
    public function add_extra_service($booking_details_id){
        $this->db->where('id',$booking_details_id);
        $single_details = $this->db->get('tbl_booking_services_details')->row();
        if(!empty($single_details)){
            $this->db->where('id',$single_details->booking_id);
            $single = $this->db->get('tbl_new_booking')->row();
            if(!empty($single)){
                $customer_id = $single->customer_name;   
        
                $products = array();
                $services = explode(',',$this->input->post('selected_add_service_' . $booking_details_id));
                if($services != "" && is_array($services) && !empty($services)){
                    for($i=0;$i<count($services);$i++){
                        $single_array = $this->input->post('add_service_product_checkbox_' . $booking_details_id . '_' . $services[$i]);
                        if ($single_array != "" && $single_array != null && is_array($single_array) && !empty($single_array)) {
                            $products = array_merge($products,$single_array);
                        }
                    }
                }
            
                $total_service_amount = $this->input->post('total_add_service_price_' . $booking_details_id);
                $total_product_amount = $this->input->post('total_add_service_product_price_' . $booking_details_id);
                $service_payable_amount = $this->input->post('add_service_payable_hidden_' . $booking_details_id);
                $product_payable_amount = $this->input->post('add_service_product_payable_hidden_' . $booking_details_id);
                $payable_amount = $this->input->post('add_service_final_payable_hidden_' . $booking_details_id);
                
                $is_membership = $this->input->post('add_service_is_membership_' . $booking_details_id);
                $membership_id = $this->input->post('add_service_membership_id_' . $booking_details_id);
                $membership_discount_type = $this->input->post('add_service_membership_discount_type_' . $booking_details_id);
                $membership_service_discount = $this->input->post('add_service_membership_service_discount_' . $booking_details_id);
                $membership_product_discount = $this->input->post('add_service_membership_product_discount_' . $booking_details_id);
                $membership_service_discount_amount = $this->input->post('add_service_membership_service_discount_amount_' . $booking_details_id);
                $membership_product_discount_amount = $this->input->post('add_service_membership_product_discount_amount_' . $booking_details_id);
                
                $total_discount_amount = $this->input->post('add_service_total_discount_amount_' . $booking_details_id);
                
                $pre_services = explode(',',$single->services);
                $pre_products = explode(',',$single->products);

                if ($pre_services != "" && $pre_services != null && is_array($pre_services) && !empty($pre_services)) {
                    if ($services != "" && $services != null && is_array($services) && !empty($services)) {
                        $new_services = array_merge($services,$pre_services);
                    }else{
                        $new_services = $pre_services;
                    }
                }else{
                    if ($services != "" && $services != null && is_array($services) && !empty($services)) {
                        $new_services = $services;
                    }else{
                        $new_services = array();
                    }
                }

                if ($pre_products != "" && $pre_products != null && is_array($pre_products) && !empty($pre_products)) {
                    if ($products != "" && $products != null && is_array($products) && !empty($products)) {
                        $new_products = array_merge($products,$pre_products);
                    }else{
                        $new_products = $pre_products;
                    }
                }else{
                    if ($products != "" && $products != null && is_array($products) && !empty($products)) {
                        $new_products = $products;
                    }else{
                        $new_products = array();
                    }
                }                
                
                $extra_booking_data = array(
                    'booking_id' 		                => $single->id,
                    'branch_id' 			            => $this->session->userdata('branch_id'),
                    'salon_id' 				            => $this->session->userdata('salon_id'),
                    'customer_name' 		            => $customer_id,
                    'added_against_service_details_id' 	=> $booking_details_id,
                    'services' 		                    => !empty($services) ? implode(',',$services) : '',
                    'products' 		                    => !empty($products) ? implode(',',$products) : '',   
                    'extra_services_total_amount' 		=> $total_service_amount,
                    'extra_products_total_amount' 		=> $total_product_amount, 
                    'extra_services_payable_amount' 	=> $service_payable_amount,
                    'extra_products_payable_amount' 	=> $product_payable_amount, 
                    'extra_service_payable_final_amount'=> $payable_amount,                       
                    'is_membership' 		            => $is_membership,
                    'membership_id' 		            => $membership_id, 
                    'membership_discount_type' 	        => $membership_discount_type,
                    'membership_service_discount' 	    => $membership_service_discount, 
                    'membership_product_discount'       => $membership_product_discount, 
                    'membership_service_discount_amount'=> $membership_service_discount_amount, 
                    'membership_product_discount_amount'=> $membership_product_discount_amount, 
                    'total_discount_amount'             => $total_discount_amount, 
                    'added_on'                          => date("Y-m-d"),
                );
                // echo '<pre>'; print_r($_POST); exit;
                $this->db->insert('tbl_booking_extra_services', $extra_booking_data);
                $extra_booking_id = $this->db->insert_id();

                $pre_extra_booking_id = explode(',',$single->extra_booking_ids);
                $pre_extra_booking_id[] = $extra_booking_id;
                $new_extra_booking_ids = implode(',',$pre_extra_booking_id);

                $booking_data = array(
                    'services' 		        => !empty($new_services) ? implode(',',$new_services) : '',
                    'products' 		        => !empty($new_products) ? implode(',',$new_products) : '',
                    'extra_services' 		=> !empty($services) ? implode(',',$services) : '',
                    'extra_products' 		=> !empty($products) ? implode(',',$products) : '',                       
                    'extra_booking_ids'     => $new_extra_booking_ids,        
                );
                // echo '<pre>'; print_r($_POST); exit();
                $this->db->where('id', $single->id);
                $this->db->update('tbl_new_booking', $booking_data);
                $booking_id = $single->id; 

                if($services != "" && is_array($services) && !empty($services)){
                    for($i=0;$i<count($services);$i++){
                        $products_single = $this->input->post('add_service_product_checkbox_' . $booking_details_id . '_' . $services[$i]);
                        $service_price = $this->input->post('service_price_' . $booking_details_id . '_' . $services[$i]); 
                        $original_service_price = $this->input->post('service_original_price_' . $booking_details_id . '_' . $services[$i]); 

                        $is_offer_applied = $this->input->post('is_offer_applied_' . $booking_details_id . '_' . $services[$i]);    
                        $applied_offer_id = $this->input->post('applied_offer_id_' . $booking_details_id . '_' . $services[$i]);    
                        $service_offer_discount = $this->input->post('service_offer_discount_' . $booking_details_id . '_' . $services[$i]);    
                        $service_offer_discount_type = $this->input->post('service_offer_discount_type_' . $booking_details_id . '_' . $services[$i]);    
                        $service_offer_discount_amount = $this->input->post('service_offer_discount_amount_' . $booking_details_id . '_' . $services[$i]);                                                

                        $received_total_service = $total_service_amount;
                        if($received_total_service != "" && $received_total_service != "0.00" && $received_total_service != null && $received_total_service != 0){
                            $price_share_in_total_service = (float)(($service_price/$received_total_service) * 100);
                            $discount_share_membership_amount = (float)(($membership_service_discount_amount * $price_share_in_total_service) / 100);
                        }else{
                            $discount_share_membership_amount = 0;
                        }

                        $total_single_service_discount = $discount_share_membership_amount;
                        $single_service_discounted_amount = $service_price - $total_single_service_discount;

                        $stylist_data = array(
                            'booking_id' 		    => $booking_id,
                            'branch_id' 			=> $this->session->userdata('branch_id'),
                            'salon_id' 				=> $this->session->userdata('salon_id'),
                            'customer_name' 		=> $customer_id,
                            'service_added_from'	=> '0', //single
                            'is_extra_service'	    => '1',
                            'service_id'     		=> $services[$i],
                            'service_price'     	=> $service_price,
                            'original_service_price'=> $original_service_price,
                            'product_ids'     		=> (!empty($products_single)) ? implode(',',$products_single) : null,
                            'service_reward_points' => $this->input->post('service_rewards_' . $booking_details_id . '_' . $services[$i]),
                            'stylist_id'      		=> $this->input->post('service_stylist_id_' . $booking_details_id . '_' . $services[$i]),
                            'service_date'     		=> date('Y-m-d',strtotime($this->input->post('booking_date_' . $booking_details_id))),
                            'service_from'    	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $booking_details_id . '_' . $services[$i]))[0])),
                            'service_to'      	    => date('Y-m-d H:i:s',strtotime(explode('@@@',$this->input->post('service_stylist_timeslot_hidden_' . $booking_details_id . '_' . $services[$i]))[1])),
                            'created_on'            => date("Y-m-d H:i:s"),
                    
                            'received_discount_amount_while_booking'     	=> $total_single_service_discount,
                            'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                            'service_discounted_price_while_booking'     	=> $single_service_discounted_amount,
                    
                            'is_service_offer_applied'     	                => $is_offer_applied,
                            'applied_offer_id'     	                        => $is_offer_applied == '1' ? $applied_offer_id : '',
                            'service_offer_discount'                        => $is_offer_applied == '1' ? $service_offer_discount : '',
                            'service_offer_discount_type'     	            => $is_offer_applied == '1' ? $service_offer_discount_type : '',
                            'service_offer_discount_amount'     	        => $is_offer_applied == '1' ? $service_offer_discount_amount : '',
                        );
                        $this->db->insert('tbl_booking_services_details', $stylist_data);
                        $booking_service_details_id = $this->db->insert_id();
        
                        if($products_single != "" && is_array($products_single) && !empty($products_single)){
                            for($j=0;$j<count($products_single);$j++){
                                $product_price = $this->input->post('service_product_price_' . $booking_details_id . '_' . $services[$i] . '_' . $products_single[$j]);
                                
                                $received_total_product = $total_product_amount;
                                if($received_total_product != "" && $received_total_product != "0.00" && $received_total_product != null && $received_total_product != 0){
                                    $price_share_in_total_product = (float)(($product_price/$received_total_product) * 100);
                                    $discount_share_membership_amount = (float)(($membership_product_discount_amount * $price_share_in_total_product) / 100);
                                }else{
                                   $discount_share_membership_amount = 0; 
                                }
                                $total_single_product_discount = $discount_share_membership_amount;
                                $single_product_discounted_amount = $product_price - $total_single_product_discount;

                                $service_product_data = array(
                                    'booking_service_details_id'  => $booking_service_details_id,
                                    'booking_id' 		    => $booking_id,
                                    'branch_id' 			=> $this->session->userdata('branch_id'),
                                    'salon_id' 				=> $this->session->userdata('salon_id'),
                                    'customer_name' 		=> $customer_id,
                                    'product_added_from'	=> '0', //single
                                    'is_extra_product'	    => '1',
                                    'service_id'     		=> $services[$i],
                                    'product_id'     		=> $products_single[$j],
                                    'product_price'     	=> $product_price,
                                    'created_on'            => date("Y-m-d H:i:s"),
                    
                                    'received_discount_amount_while_booking'     	=> $total_single_product_discount,
                                    'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                                    'product_discounted_price_while_booking'     	=> $single_product_discounted_amount,
                                );
                                $this->db->insert('tbl_booking_services_products_details', $service_product_data);
                            }
                        }
        
                        $this->db->where('id',$customer_id);
                        $customer_rewards = $this->db->get('tbl_salon_customer')->row();
                        if(!empty($customer_rewards)){
                            $pre_balance = $customer_rewards->rewards_balance;
                            $rewards = ($this->input->post('service_reward_points_' . $services[$i]) != "" && $this->input->post('service_reward_points_' . $services[$i]) != null) ? $this->input->post('service_reward_points_' . $services[$i]) : '0';
                            $new_balance = $pre_balance + $rewards;
        
                            $reward_data = array(
                                'customer_id'                   =>  $customer_id,
                                'branch_id'                     =>  $this->session->userdata('branch_id'),
                                'salon_id'                      =>  $this->session->userdata('salon_id'),
                                'booking_id'                    =>  $booking_id,
                                'rewards_for'                   =>  '0',
                                'for_service'                   =>  $services[$i],
                                'booking_service_details_id'    =>  $booking_service_details_id,
                                'transaction_type'              =>  '0',
                                'remark'                        =>  'Reward points credited for service booking',
                                'previous_reward_balance'       =>  $pre_balance,
                                'reward_value'                  =>  $rewards,
                                'new_reward_balance'            =>  $new_balance,
                                'created_on'                    =>  date("Y-m-d H:i:s")
                            );
                            $this->db->insert('tbl_customer_rewards_history',$reward_data);
        
                            $this->db->where('id',$customer_id);
                            $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                        }
                    }
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function get_single_payment($id){
        $this->db->where('tbl_booking_payment_entry.id',$id);
        $result = $this->db->get('tbl_booking_payment_entry');
		$result = $result->row();
        return $result;
    }
    public function get_all_customer(){
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->order_by('tbl_salon_customer.id','desc');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->result();
        return $result;
    }
    public function get_customer_details_extra_service($id){
		$this->db->select('tbl_salon_customer.*,cities.name as city_name,states.name as state_name');
        $this->db->where('tbl_salon_customer.id',$id);
        $this->db->where('tbl_salon_customer.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customer.salon_id',$this->session->userdata('salon_id'));
		$this->db->join('states','states.id = tbl_salon_customer.state','left');
		$this->db->join('cities','cities.id = tbl_salon_customer.city','left');
        $result = $this->db->get('tbl_salon_customer');
		$result = $result->row();

        if(!empty($result)){
            if($result->membership_id != "" && $result->membership_id != null && $result->membership_id != "0"){
                $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                $this->db->where('tbl_customer_membership_history.id',$result->membership_pkey);
                $this->db->where('tbl_customer_membership_history.customer_id', $result->id);
                $this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
                $this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
                $membership_details = $this->db->get('tbl_customer_membership_history')->row();

                if(!empty($membership_details)){
                    $membership = $membership_details;
                    $is_member = '1';
                }else{
                    $membership = array();
                    $is_member = '0';
                }
            }else{
                $membership = array();
                $is_member = '0';
            }

            return
                array(
                    'customer'              =>  $result,
                    'is_member'             =>  $is_member,
                    'membership'            =>  $membership,
                );
        }else{
            return array();
        }
    }
    public function get_membership_details($membership_pkey,$customer){
        $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
        $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
        $this->db->where('tbl_customer_membership_history.id',$membership_pkey);
        $this->db->where('tbl_customer_membership_history.customer_id', $customer);
        $membership_details = $this->db->get('tbl_customer_membership_history')->row();
        return $membership_details;
    }
    public function show_add_service_popup_ajx(){
        $booking_rules = $this->get_booking_rules();
        if(!empty($booking_rules)){
            $days_early_booking = $booking_rules->max_booking_range_day;
            if($days_early_booking != ""){
                $max_date = date('d-m-Y', strtotime('+'.$days_early_booking.' day'));
            }else{
                $max_date = date('d-m-Y', strtotime('+0 day'));
            }
        }else{
            $max_date = date('d-m-Y', strtotime('+0 day'));
        }
        $today = date('d-m-Y');

		$category = $this->get_all_sup_category();
        $offers_list = $this->Salon_model->get_all_active_offers();
        $products = $this->Salon_model->get_all_active_product();

        $booking_service_details_id = $this->input->post('booking_service_details_id');

        $this->db->select('tbl_booking_services_details.*,tbl_salon_customer.membership_pkey,tbl_salon_customer.id as customer_id, tbl_new_booking.amount_to_paid,tbl_new_booking.payment_status,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.m_service_discount,tbl_new_booking.m_product_discount,tbl_new_booking.payment_date,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.id',$booking_service_details_id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $bookings = $this->db->get('tbl_booking_services_details')->row();

        if(!empty($bookings)){
            $is_member = '0';
            $membership_id = '';
            $membership_discount_type = '';
            $membership_service_discount = '0.00';
            $membership_product_discount = '0.00';
            $membership_button = '';

            if($bookings->is_membership_booking == '1'){
                $membership_details = $this->get_membership_details($bookings->membership_pkey,$bookings->customer_id);
                if(!empty($membership_details)){
                    $is_member = '1';
                    $membership_id = $bookings->membership_id;
                    $membership_discount_type = $bookings->membership_discount_type;
                    $membership_service_discount = $bookings->m_service_discount;
                    $membership_product_discount = $bookings->m_product_discount;
                    $membership_text_color = $membership_details->text_color;
                    $membership_bg_color = $membership_details->bg_color;
                    $membership_name = $membership_details->membership_name;
                    $membership_button = '<a class="btn btn-sm" style="margin-top: -5px;float:right; background-color:'.$membership_bg_color.'; color:'.$membership_text_color.'">'.$membership_name.'</a>';
                }    
            }
        ?>
            <h5 style="margin-bottom: -10px;margin-left: 10px;margin-top:-5px;"><b style="font-weight: 600;">Customer: <?=$bookings->customer_name.' ['.$bookings->customer_phone.']';?></b><?=$membership_button; ?></h5>
            <hr>
            <form style="margin-top:-10px;" method="post" name="payment_form_<?=$bookings->id;?>" id="payment_form_<?=$bookings->id;?>" action="<?=base_url();?>add_extra_service/<?=base64_encode($bookings->id);?>">
                <div class="row">
                    <div class="form-group custom_label col-md-3 col-xs-12">
                        <label>Category<b class="require">*</b></label>
                        <select id="category_<?=$bookings->id;?>" name="category_<?=$bookings->id;?>" class="form-control">
                            <option value="">Select Category</option>
                            <?php
                                if(!empty($category)){
                                    foreach($category as $category_result){
                            ?>
                            <option value="<?=$category_result->id; ?>"><?=$category_result->sup_category; ?>|<?=$category_result->sup_category_marathi; ?></option>
                            <?php }} ?>
                        </select>
                        <label for="category_<?=$bookings->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select category!</label>
                    </div>
                    <div class="form-group custom_label col-md-3 col-xs-12">
                        <label>Service<b class="require">*</b></label>
                        <select id="service_<?=$bookings->id;?>" name="service_<?=$bookings->id;?>" class="form-control">
                            <option value="">Select Service</option>
                        </select>
                        <label for="selected_add_service_<?=$bookings->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select service!</label>
                    </div>
                    <div class="form-group custom_label col-md-3 col-xs-12">
                        <label>Service Date<b class="require">*</b></label>
                        <input readonly type="text" class="form-control" name="booking_date_<?=$bookings->id;?>" id="booking_date_<?=$bookings->id;?>" placeholder="Select Booking Date" onchange="fetchTimeSlots(<?=$bookings->id;?>)" value="<?=date('d-m-Y',strtotime($bookings->service_date));?>">
                    </div>
                    <div class="form-group custom_label col-md-3 col-xs-12">
                        <label>Service Start<b class="require">*</b></label>
                        <input readonly type="text" class="form-control" name="booking_start_<?=$bookings->id;?>" id="booking_start_<?=$bookings->id;?>" placeholder="Start From Time Slot">
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="previous_start_<?=$bookings->id;?>" id="previous_start_<?=$bookings->id;?>" value="">
                        <input type="hidden" name="slot_start_time_<?=$bookings->id;?>" id="slot_start_time_<?=$bookings->id;?>" value="<?=date('H:i:s',strtotime($bookings->service_to));?>">
                        <div class="form-group col-md-12 col-xs-12" id="booking_timeslots_<?=$bookings->id;?>"></div> 
                        <div class="form-group col-md-12 col-xs-12" id="selected_services_empty_<?=$bookings->id;?>">
                            <div class="row single_added_extra_service_details">
                                <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox" style="height:60px; padding-top: 9px; padding-left:0px;">
                                    <div class="col-md-12" style="text-align:center;">
                                        <label class="noserviceavl" style="margin-top: 10px;background-color:transparent !important; font-size: 11px !important;color: #4c4c4c !important;">Service not selected</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-xs-12" id="selected_services_<?=$bookings->id;?>" style="display:none;"></div>
                    </div>
                    <div class="col-lg-4 extra_service_price_table">
                        <table style="width:100%;" class="">
                            <thead>
                                <tr style="background-color: white;">
                                    <th>Service Price</th>
                                    <th id="total_add_service_price_text_<?=$bookings->id;?>">0.00</th>
                                </tr>
                                <tr style="background-color: white;">
                                    <th>Products Price</th>
                                    <th id="total_add_service_product_price_text_<?=$bookings->id;?>">0.00</th>
                                </tr>
                                <tr style="background-color: white;border-top: 1px solid #ccc;">
                                    <th>
                                        Discount
                                        <div id="add_service_discount_details_div_<?=$bookings->id;?>" style="position: relative;display:inline-block; width:auto;"></div>
                                    </th>
                                    <th id="add_service_total_discount_amount_text_<?=$bookings->id;?>">0.00</th>
                                </tr>
                                <tr style="border-top: 0.5px solid #afafaf;">
                                    <th>Total Amount</th>
                                    <th id="add_service_final_payable_text_<?=$bookings->id;?>">0.00</th>
                                </tr>
                            </thead>
                        </table>
                        <input type="hidden" name="add_service_is_membership_<?=$bookings->id;?>" id="add_service_is_membership_<?=$bookings->id;?>" value="<?=$is_member;?>">
                        <input type="hidden" name="add_service_membership_id_<?=$bookings->id;?>" id="add_service_membership_id_<?=$bookings->id;?>" value="<?=$membership_id;?>">
                        <input type="hidden" name="add_service_membership_discount_type_<?=$bookings->id;?>" id="add_service_membership_discount_type_<?=$bookings->id;?>" value="<?=$membership_discount_type;?>">
                        <input type="hidden" name="add_service_membership_service_discount_<?=$bookings->id;?>" id="add_service_membership_service_discount_<?=$bookings->id;?>" value="<?=$membership_service_discount;?>">
                        <input type="hidden" name="add_service_membership_product_discount_<?=$bookings->id;?>" id="add_service_membership_product_discount_<?=$bookings->id;?>" value="<?=$membership_product_discount;?>">
                        
                        <input type="hidden" name="add_service_membership_service_discount_amount_<?=$bookings->id;?>" id="add_service_membership_service_discount_amount_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="add_service_membership_product_discount_amount_<?=$bookings->id;?>" id="add_service_membership_product_discount_amount_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="add_service_total_discount_amount_<?=$bookings->id;?>" id="add_service_total_discount_amount_<?=$bookings->id;?>" value="">

                        <input type="hidden" name="total_add_service_price_<?=$bookings->id;?>" id="total_add_service_price_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="add_service_payable_hidden_<?=$bookings->id;?>" id="add_service_payable_hidden_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="add_service_product_payable_hidden_<?=$bookings->id;?>" id="add_service_product_payable_hidden_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="total_add_service_product_price_<?=$bookings->id;?>" id="total_add_service_product_price_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="add_service_final_payable_hidden_<?=$bookings->id;?>" id="add_service_final_payable_hidden_<?=$bookings->id;?>" value="0.00">
                        <input type="hidden" name="selected_add_service_<?=$bookings->id;?>" id="selected_add_service_<?=$bookings->id;?>" value="">
                        
                        <label class="error" id="stylist_timeslot_error_<?=$bookings->id;?>" style="display:none;margin-top:5px;"></label>
                        <div class="form-group col-md-12 col-xs-12" style="margin-top: 10px;margin-left: -10px;">
                            <button type="submit" class="btn btn-primary" id="payment_btn" value="payment_btn">Add Service</button>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                var user_selected_add_service = [];
                var user_selected_add_service_product = [];
                var user_selected_timeslots_add_service = [];
                var user_selected_stylist_timeslots_add_service = [];

                var selected_slot_start = '<?php echo  ($bookings->service_to != "") ? date('Y-m-d H:i:s',strtotime($bookings->service_to)) : ''; ?>';
                var selected_slot_start_date = '<?php echo ($bookings->service_to != "") ? date('d-m-Y', strtotime($bookings->service_to)) : ''; ?>';
                var selected_slot_start_time = '<?php echo  ($bookings->service_to != "") ? date('H:i:s',strtotime($bookings->service_to)) : ''; ?>';

                if(selected_slot_start_date != ""){
                    var parts = selected_slot_start_date.split('-');
                    var day = parts[0].trim();
                    if (day.length === 1) {
                        day = '0' + day; 
                    }
                    var selected_formattedDate = day + '-' + parts[1].trim() + '-' + parts[2].trim();
                } else {
                    var selected_formattedDate = '';
                }
                
                $(document).ready(function () {  
                    if(selected_slot_start_date != "" && selected_slot_start_time != ""){
                        $('#booking_date_<?=$bookings->id;?>').val(selected_slot_start_date);
                        fetchTimeSlots(<?=$bookings->id;?>);
                        
                        var timeParts = selected_slot_start_time.split(":");
                        var hours = parseInt(timeParts[0], 10);
                        var minutes = parseInt(timeParts[1], 10);
                        
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12;
                        
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        
                        selectedValue = hours + ':' + minutes + ' ' + ampm;

                        setBookingStart(selectedValue,<?=$bookings->id;?>);
                        
                        // $('#booking_timeslots_<?=$bookings->id;?>').hide();
                    }
                    $("#booking_date_<?=$bookings->id;?>").datepicker({
                        dateFormat: 'dd-mm-yy',
                        maxDate: '<?php echo $max_date; ?>',
                        minDate: '<?php echo $today; ?>',
                    });  
                    var today_date = '<?php echo  ($today != "") ? date('d-m-Y',strtotime($today)) : ''; ?>';

                    $("#category_<?=$bookings->id;?>").chosen(); 
                    $("#service_<?=$bookings->id;?>").chosen(); 

                    $('#payment_form_<?=$bookings->id;?>').validate({
                        ignore:[],
                        rules: {
                            'category_<?=$bookings->id;?>': {
                                required: true,
                            },
                            'selected_add_service_<?=$bookings->id;?>': {
                                required: true,
                            },
                        },
                        messages: {
                            'category_<?=$bookings->id;?>': {
                                required: "Please select category!",
                            },
                            'selected_add_service_<?=$bookings->id;?>': {
                                required: "Please select service!",
                            },
                        },
                        submitHandler: function(form) {
                            var validation_flag = 1;
                            $(".service_executive_<?=$bookings->id;?>").each(function () {
                                if ($(this).val() == "") {
                                    validation_flag = 0;
                                    return false;
                                }
                            });
                            if (validation_flag == 1) {
                                if (confirm("Are you sure you want to add service?")) {
                                // openConfirmationDialog("Are you sure you want to add service?", function (confirmed) {
                                // if (confirmed) {
                                    $("#stylist_timeslot_error_<?=$bookings->id;?>").hide('');
                                    $("#stylist_timeslot_error_<?=$bookings->id;?>").html('');

                                    form.submit();
                                } else {
                                    $("#stylist_timeslot_error_<?=$bookings->id;?>").hide('');
                                    $("#stylist_timeslot_error_<?=$bookings->id;?>").html('');
                                    return false;
                                }
                                // });
                            } else {
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").show('');
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").html('Please select stylists for the selected service'); 
                            }
                        }
                    });

                    $('#category_<?=$bookings->id;?>').change(function() {
                        $('.loader_div').show();   
                        setTimeout(function() {
                            var booking_details_id = <?= $bookings->id; ?>;
                            var category = $('#category_' + booking_details_id).val();
                            if (category !== "" && typeof category !== "undefined") {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url(); ?>salon/Ajax_controller/get_category_services",
                                    data: { 'category': category },
                                    success: function(data) {
                                        $('.loader_div').hide(); 

                                        $("#service_"+booking_details_id).empty();
                                        $("#service_"+booking_details_id).append('<option value="">Select Service</option>');
                                        var stylists = $.parseJSON(data);
                                        if (stylists.length > 0) {
                                            var opts = $.parseJSON(data);
                                            var offers_list = <?php echo json_encode($offers_list); ?>;

                                            $.each(opts, function(i, d) {
                                                $("#service_" + booking_details_id).append('<option value="' + d.id + '">' + d.service_name + '|' + d.service_name_marathi + '</option>');

                                                var count = offers_list.length;
                                                var service_offer_discount = 0;
                                                var rewards = 0;

                                                var single_offer_discount_type = '';
                                                var service_offer_discount_offers = '';
                                                var service_offer_discount = '';
                                                var offer_id = '';
                                                var is_offer_applied = '0';

                                                for (var j = 0; j < count; j++) {
                                                    var single_offer_services = offers_list[j]['service_name'];

                                                    if (single_offer_services.includes(d.id.toString())) {                                                        
                                                        var single_offer_discount_type = offers_list[j]['discount_in'];
                                                        if (single_offer_discount_type === '0') {
                                                            service_offer_discount = (d.final_price * offers_list[j]['discount']) / 100;
                                                        } else {
                                                            service_offer_discount = offers_list[j]['discount'];
                                                        }
                                                        service_offer_discount_offers = offers_list[j]['discount'];
                                                        rewards = offers_list[j]['reward_point'];
                                                        offer_id = offers_list[j]['id'];
                                                        is_offer_applied = '1';
                                                        break;
                                                    }
                                                }

                                                var service_price_consider = d.final_price - service_offer_discount;
                                                var original_price = d.final_price;

                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_price_' + booking_details_id + '_' + d.id + '" id="service_price_' + booking_details_id + '_' + d.id + '" value="' + parseFloat(service_price_consider).toFixed(2) + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_original_price_' + booking_details_id + '_' + d.id + '" id="service_original_price_' + booking_details_id + '_' + d.id + '" value="' + parseFloat(original_price).toFixed(2) + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_marathi_name_' + booking_details_id + '_' + d.id + '" id="service_marathi_name_' + booking_details_id + '_' + d.id + '" value="' + d.service_name_marathi + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_name_' + booking_details_id + '_' + d.id + '" id="service_name_' + booking_details_id + '_' + d.id + '" value="' + d.service_name + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_duration_' + booking_details_id + '_' + d.id + '" id="service_duration_' + booking_details_id + '_' + d.id + '" value="' + d.service_duration + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_rewards_' + booking_details_id + '_' + d.id + '" id="service_rewards_' + booking_details_id + '_' + d.id + '" value="' + d.reward_point + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_products_' + booking_details_id + '_' + d.id + '" id="service_products_' + booking_details_id + '_' + d.id + '" value="' + d.product + '">');
                                                
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="is_offer_applied_' + booking_details_id + '_' + d.id + '" id="is_offer_applied_' + booking_details_id + '_' + d.id + '" value="' + is_offer_applied + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="applied_offer_id_' + booking_details_id + '_' + d.id + '" id="applied_offer_id_' + booking_details_id + '_' + d.id + '" value="' + offer_id + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_' + booking_details_id + '_' + d.id + '" id="service_offer_discount_' + booking_details_id + '_' + d.id + '" value="' + service_offer_discount_offers + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_type_' + booking_details_id + '_' + d.id + '" id="service_offer_discount_type_' + booking_details_id + '_' + d.id + '" value="' + single_offer_discount_type + '">');
                                                $("#service_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_amount_' + booking_details_id + '_' + d.id + '" id="service_offer_discount_amount_' + booking_details_id + '_' + d.id + '" value="' + service_offer_discount + '">');
                                            });
                                        }
                                        $("#service_"+booking_details_id).trigger('chosen:updated');
                                        $("#service_"+booking_details_id).chosen();
                                    }
                                });
                            }
                        }, 1500);
                    });

                    $('#service_<?=$bookings->id;?>').change(function() {
                        var booking_details_id = <?= $bookings->id; ?>;
                        var all_products = <?= json_encode($products); ?>;
                        var selected_from = 'extra_service_add';
                        var category = $('#category_' + booking_details_id).val();
                        var serviceID = $('#service_' + booking_details_id).val();
                        
                        $("#stylist_timeslot_error_" + booking_details_id).hide('');
                        $("#stylist_timeslot_error_" + booking_details_id).html('');

                        if(!user_selected_add_service.includes(serviceID)){   
                            // $('#booking_timeslots_' + booking_details_id).hide();                
                            var booking_date = $('#booking_date_' + booking_details_id).val();
                            var booking_start = $('#booking_start_' + booking_details_id).val();

                            if (booking_date !== "" && booking_start !== "") {
                                $('.loader_div').show();   
                                setTimeout(function() {
                                    var productsArray = [];
                                    var service_duration = $('#service_duration_' + booking_details_id + '_' + serviceID).val();
                                    var service_name = $('#service_name_' + booking_details_id + '_' + serviceID).val();
                                    var service_marathi_name = $('#service_marathi_name_' + booking_details_id + '_' + serviceID).val();
                                    var service_rewards = $('#service_rewards_' + booking_details_id + '_' + serviceID).val();
                                    var final_price = $('#service_price_' + booking_details_id + '_' + serviceID).val();
                                    var service_original_price = $('#service_original_price_' + booking_details_id + '_' + serviceID).val();
                                    var service_products = $('#service_products_' + booking_details_id + '_' + serviceID).val();
                                    productsArray = service_products.split(',');
                                    if(parseFloat(final_price) < parseFloat(service_original_price)){
                                        price = '<s>'+parseFloat(service_original_price).toFixed(2)+'</s> '+parseFloat(final_price).toFixed(2)+'';
                                    }else{
                                        price = final_price;
                                    }

                                    var tomorrow = new Date();
                                    tomorrow.setDate(tomorrow.getDate() + 1);

                                    var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
                                    var total_count = 0;
                                    var z = 0;
                                    var product_count = 0;
                                    service_details = 
                                        '<div class="row single_added_extra_service_details" id="selected_service_details_'+ booking_details_id +'_'+ serviceID +'">'+
                                            '<input type="hidden" id="service_added_from_'+ booking_details_id +'_'+ serviceID +'" value="'+ selected_from +'">'+
                                            '<div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox" style="height: 80px; padding-top: 9px; padding-left:0px;">'+
                                                '<div class="col-md-8">'+
                                                    '<span class="left-span" style="font-size: 13px !important;">'+ service_name +'|'+service_marathi_name+' <span style="margin-left:15px;">'+ price +'</span></span>'+
                                                    '<div class="span-row">'+
                                                        '<span class="bottom-span">'+ service_duration +' Mins</span>'+
                                                        '<input type="hidden" id="service_reward_points_'+ booking_details_id +'_'+ serviceID +'" name="service_reward_points_'+ booking_details_id +'_'+ serviceID +'" value="">'+
                                                        '<span class="bottom-span" id="service_stylist_timeslot_'+ booking_details_id +'_'+ serviceID +'"></span>'+
                                                        '<div class="col-lg-6" id="service_executive_div_'+ booking_details_id +'_' + serviceID + '" style="display:none;">'+
                                                            '<select class="form-control service_executive_'+ booking_details_id +'" name="service_stylist_id_'+ booking_details_id +'_' + serviceID + '" id="service_stylist_id_'+ booking_details_id +'_' + serviceID + '"></select>'+
                                                        '</div>'+
                                                        '<input type="hidden" class="service_stylist_timeslot_validation_'+ booking_details_id +'" id="service_stylist_timeslot_hidden_'+ booking_details_id +'_'+ serviceID +'" name="service_stylist_timeslot_hidden_'+ booking_details_id +'_'+ serviceID +'" value="">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:flex; justify-content:center;">'+
                                                    '<button style="display: block;position: static; margin-top:5px;" type="button" id="product_for_service_button_'+ booking_details_id +'_' + serviceID + '" class="btn  modalbtn" onclick="showPopup(\'ServiceProductModal_'+ booking_details_id +'_' + serviceID + '\')" data-toggle="modal" data-target="#ServiceProductModal_'+ booking_details_id +'_' + serviceID + '"><span id="selected_service_product_'+ booking_details_id +'_' + serviceID + '">0</span>/<span id="total_service_product_'+ booking_details_id +'_' + serviceID + '">0</span></button>'+
                                                    '<div class="modal fade" style="background-color: #00000080; overflow-x:visible !important; overflow-y:visible !important;" id="ServiceProductModal_'+ booking_details_id +'_'+ serviceID +'" tabindex="-1" role="dialog" aria-labelledby="ServiceProductModalLabel_'+ booking_details_id +'_'+ serviceID +'" aria-hidden="true">'+
                                                        '<div class="modal-dialog" role="document" style="margin-top:55px;width:500px;">'+
                                                            '<div class="modal-content">'+
                                                                '<div class="modal-header">'+
                                                                    '<h5 class="modal-title" id="ServiceProductModalLabel_'+ booking_details_id +'_'+ serviceID +'">'+ service_name +' Service Products</h5>'+
                                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup(\'ServiceProductModal_'+ booking_details_id +'_'+ serviceID + '\')">'+
                                                                        '<span aria-hidden="true">&times;</span>'+
                                                                    '</button>'+
                                                                '</div>'+
                                                                '<div class="modal-body extra_service_products">'+
                                                                    '<table style="width:100%;">'+
                                                                        '<thead>'+
                                                                            '<tr>'+
                                                                                '<th>Select</th>'+
                                                                                '<th>Product</th>'+
                                                                                '<th>Price</th>'+
                                                                            '</tr>'+
                                                                        '</thead>'+
                                                                        '<tbody>';
                                                    all_products.forEach(function(product) {
                                                        if (productsArray.includes(product.id)) {
                                                            product_count++;
                                                        service_details += '<tr>' +
                                                                                '<td><input type="checkbox" class="product-checkbox add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'" name="add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'[]" id="add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'_' + product.id + '" value="' + product.id + '" onclick="setAddServiceProductPrice('+ booking_details_id +',' + serviceID + ',' + product.id + ')"></td>' +
                                                                                '<td>' + product.product_name + '</td>' +
                                                                                '<td>' + product.selling_price + '</td>' +
                                                                            '</tr>' +
                                                                            '<input type="hidden" id="service_product_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" name="service_product_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="'+ product.selling_price +'">';
                                                        }
                                                    });
                                                    if(product_count == 0){
                                                        service_details += '<tr>' +
                                                                                '<td colspan="3" style="text-align:center;">Products not available</td>' +
                                                                            '</tr>';
                                                    }
                                                    service_details += '</tbody>'+
                                                                    '</table>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<button style="display: block;position: absolute;background: white;border: none;outline: none;box-shadow: none;padding: 0px;margin: 0px;right: 0px;top: 0px; margin-top:2px;" type="button" id="remove_add_service_button_'+ booking_details_id +'_' + serviceID + '" class="btn" onclick="removeAddService(' + booking_details_id + ',' + serviceID + ')"><span style="color: white;font-size: 10px;background: red;padding: 2px 6px;border-radius: 100%;"><i class="fa fa-times"></i></span></button>'+
                                                '</div>'+
                                            '</div>'+   
                                        '</div>';
                                    $('#selected_services_empty_'+booking_details_id).hide();
                                    $('#selected_services_' + booking_details_id).append(service_details);
                                    $('#selected_services_' + booking_details_id).show();
                                    $('#total_service_product_' + booking_details_id + '_' + serviceID).text(product_count);

                                    $('.loader_div').hide();   
                                    setAddServicePrice(booking_details_id,serviceID,service_duration,service_rewards,final_price);
                                }, 3000);
                            }else{
                                // alert('Please select booking date and timeslot first');
                                openDialog('Please select booking date and timeslot first'); 
                                $('#service_' + booking_details_id).val('');
                            }
                        }else{
                            $('.loader_div').hide(); 
                            // alert('Service already selected');
                            openDialog('Service already selected'); 
                        }                        
                        $('#service_' + booking_details_id).val('');
                        $('#service_' + booking_details_id).trigger("chosen:updated");
                    });
                });
                
                function formatTime(time) {
                    var hours = time.getHours();
                    var minutes = time.getMinutes();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;

                    return hours + ':' + minutes + ' ' + ampm;
                }
                function formatToOnlyDate(date) {
                    var monthNames = [
                        "Jan", "Feb", "Mar",
                        "Apr", "May", "Jun", "Jul",
                        "Aug", "Sep", "Oct",
                        "Nov", "Dec"
                    ];

                    var day = date.getDate();
                    var monthIndex = date.getMonth();
                    var year = date.getFullYear();

                    return day + ' ' + monthNames[monthIndex] + ' ' + year;
                }
                function formatToOnlyDate_PHPFormat(date) {
                    var year = date.getFullYear();
                    var month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding leading zero if necessary
                    var day = ('0' + date.getDate()).slice(-2); // Adding leading zero if necessary
                    return year + '-' + month + '-' + day;
                }                
                function convertTo24HourFormat(time) {
                    var hours = parseInt(time.split(':')[0]);
                    var minutes = parseInt(time.split(':')[1].split(' ')[0]);
                    var ampm = time.split(' ')[1];

                    if (ampm === 'PM' && hours < 12) {
                        hours += 12;
                    }
                    if (ampm === 'AM' && hours === 12) {
                        hours = 0;
                    }

                    var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':00';
                    return formattedTime;
                }
                function fetchTimeSlots(booking_details_id){
                    var booking_date = $('#booking_date_'+booking_details_id).val();
                    var booking_start = $('#booking_start_'+booking_details_id).val();
                    var slot_start_time = $('#slot_start_time_'+booking_details_id).val();
                    if(booking_date != ""){
                        $('#booking_timeslots_'+booking_details_id).html('');
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url();?>salon/Ajax_controller/get_day_timeslots_extra_service_ajx",
                            data:{
                                'booking_details_id':booking_details_id,
                                'booking_date':booking_date,
                                'selected_slot_start_time':slot_start_time,
                                'booking_start':booking_start,
                                'user_selected_service': user_selected_add_service
                            },
                            success: function(data){
                                $('#booking_timeslots_'+booking_details_id).show();
                                $('#booking_timeslots_'+booking_details_id).html(data);

                                if($('#booking_start_'+booking_details_id).val() != ""){
                                    setServiceTimeSlots(booking_details_id);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        }); 
                    }
                }                
                function setBookingStart(value,booking_details_id) {
                    if(value == ""){
                        var selectedValue = $('input[name="booking_start_time_slot_'+booking_details_id+'"]:checked').val();
                    }else{
                        var selectedValue = value;
                    }
                    if (selectedValue != "") {
                        // $('#booking_timeslots').hide();
                        $('#booking_start_'+booking_details_id).val(selectedValue);
                        fetchTimeSlots(booking_details_id);
                    }
                }
                
                function setServiceTimeSlots(booking_details_id){
                    for(var i=0;i<user_selected_add_service.length;i++){
                        var singleService = user_selected_add_service[i];            
                        var service_duration = $('#service_duration_' + booking_details_id + '_' + singleService).val();
                        var service_rewards = $('#service_rewards_' + booking_details_id + '_' + singleService).val();

                        var booking_date = $('#booking_date_'+booking_details_id).val();
                        var previous_start = $('#previous_start_'+booking_details_id).val();

                        if(booking_date != "" && $('#booking_start_'+booking_details_id).val() != ""){
                            if(i == 0){
                                var booking_start = $('#booking_start_'+booking_details_id).val();
                            }else{
                                var booking_start = previous_start;
                            }
                            
                            var dateParts = booking_date.split("-");
                            var day = parseInt(dateParts[0], 10);
                            var month = parseInt(dateParts[1], 10);
                            var year = parseInt(dateParts[2], 10);

                            var timeParts = booking_start.split(":");
                            var hours = parseInt(timeParts[0], 10);
                            var minutes = parseInt(timeParts[1], 10);

                            if (booking_start.includes("PM") && hours !== 12) {
                                hours += 12;
                            } else if (booking_start.includes("AM") && hours === 12) {
                                hours = 0;
                            }
                            
                            selected_slot_start = new Date(year, month - 1, day, hours, minutes, 0);
                            var selected_slot_end = new Date(selected_slot_start.getTime() + (service_duration * 60000));

                            var formatted_slot_start_time = formatTime(selected_slot_start);
                            var formatted_slot_end_time = formatTime(selected_slot_end);

                            var formatted_slot_start_time_24hr = convertTo24HourFormat(formatted_slot_start_time);
                            var formatted_slot_end_time_24hr = convertTo24HourFormat(formatted_slot_end_time);
                            var formatted_booking_date_PHP = formatToOnlyDate_PHPFormat(selected_slot_start);
                            var timeslot_string = formatted_booking_date_PHP + ' ' + formatted_slot_start_time_24hr + '@@@' + formatted_booking_date_PHP + ' ' + formatted_slot_end_time_24hr;

                            $('#service_reward_points_' + booking_details_id + '_' + singleService).val(service_rewards);
                            $('#service_stylist_timeslot_hidden_' + booking_details_id + '_' + singleService).val(timeslot_string);
                            $('#service_stylist_timeslot_' + booking_details_id + '_' + singleService).text(formatted_slot_start_time + ' to ' + formatted_slot_end_time);
                                        
                            getTimeStylist(booking_details_id,booking_date,selected_slot_start,selected_slot_end,singleService,service_duration);

                            $('#previous_start_'+booking_details_id).val(formatted_slot_end_time_24hr);
                        }
                    }
                }
                
                function formatDate(date) {
                    var year = date.getFullYear();
                    var month = ('0' + (date.getMonth() + 1)).slice(-2);
                    var day = ('0' + date.getDate()).slice(-2);
                    var hours = ('0' + date.getHours()).slice(-2);
                    var minutes = ('0' + date.getMinutes()).slice(-2);
                    var seconds = ('0' + date.getSeconds()).slice(-2);

                    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                }    
                function getTimeStylist(booking_details_id,booking_date,selected_slot_start,selected_slot_end,singleService,service_duration){
                    var formatted_start = formatDate(selected_slot_start);
                    var formatted_end = formatDate(selected_slot_end);

                    if (formatted_start !== "" && typeof formatted_start !== "undefined" && formatted_end !== "" && typeof formatted_end !== "undefined") {
                        selectedTimeSlot = formatted_start + '@@@' + formatted_end;
                        $('#service_executive_div_' + booking_details_id + '_' + singleService).hide();
                        $('#service_stylist_id_' + booking_details_id + '_' + singleService).html("");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_servicewise_ajx",
                            data: { 'service':singleService,'selectedTimeSlot': selectedTimeSlot },
                            success: function(data) {
                                $('#service_stylist_id_' + booking_details_id + '_' + singleService).chosen();
                                $('#service_stylist_id_' + booking_details_id + '_' + singleService).val('');
                                var stylists = $.parseJSON(data);
                                if(stylists.length > 0){
                                    $('#service_stylist_id_' + booking_details_id + '_' + singleService).empty();
                                    $('#service_stylist_id_' + booking_details_id + '_' + singleService).append('<option value="">Select Executive</option>');
                                    var opts = $.parseJSON(data);
                                    var count = 1;
                                    $.each(opts, function(i, d) {
                                        store_flag = d.store_flag;
                                        is_service_available = d.is_service_available;
                                        is_shift_available = d.is_shift_available;
                                        is_booking_present = d.is_booking_present;
                                        is_on_break = d.is_on_break;
                                        
                                        if(is_service_available == '1'){
                                            if(store_flag == '1'){
                                                if(is_shift_available == '1'){
                                                    if(is_booking_present == '0'){
                                                        if(is_on_break == '0'){
                                                            var message = '';
                                                            var disabled = '';
                                                            var is_Allowed = 1;
                                                            if(count == 1){
                                                                var selected = 'selected';
                                                            }
                                                        }else{
                                                            var message = '- Stylist On Break';
                                                            var disabled = 'disabled';
                                                            var is_Allowed = 0;
                                                        }
                                                    }else{
                                                        var message = '- Slot Already Booked';
                                                        // var message = '- Not Available';
                                                        var disabled = 'disabled';
                                                        var is_Allowed = 0;
                                                    }
                                                }else{
                                                    var message = '- Shift Not Available';
                                                    var disabled = 'disabled';
                                                    var is_Allowed = 0;
                                                }
                                            }else{
                                                var message = '- Exceed Salon Times';
                                                var disabled = 'disabled';
                                                var is_Allowed = 0;
                                            }

                                            if(is_Allowed == 1){
                                                if(count == 1){
                                                    var selected = 'selected';
                                                }else{
                                                    var selected = '';
                                                }
                                            }else{
                                                var selected = '';
                                            }

                                            $('#service_stylist_id_' + booking_details_id + '_' + singleService).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                                        
                                            count++;
                                        }else{
                                            var disabled = 'disabled';
                                            var message = '- Stylist Not Available';
                                        }
                                    });
                                    $('#service_stylist_id_' + booking_details_id + '_' + singleService).trigger('chosen:updated');
                                    $('#service_executive_div_' + booking_details_id + '_' + singleService).show();
                                }
                            },
                        });
                    }
                }
                function removeAddService(booking_details_id,serviceID){
                    // if(confirm('Are you sure you want to remove service?')){ 
                    openConfirmationDialog("Are you sure you want to remove service?", function (confirmed) {
                    if (confirmed) {
                        $('.loader_div').show();   
                        setTimeout(function() {
                            var current_total = parseFloat($("#total_add_service_price_" + booking_details_id).val());                      
                            var selected_product = parseInt($('#selected_service_product_' + booking_details_id + '_'+serviceID).text());
                            var service_price = $('#service_price_' + booking_details_id + '_' + serviceID).val();

                            var index = user_selected_add_service.findIndex(function(id) {
                                return id === serviceID.toString();
                            });

                            if (index !== -1) {
                                user_selected_add_service.splice(index, 1);
                                var updatedValue = user_selected_add_service.join(',');
                                $("#selected_add_service_" + booking_details_id).val(updatedValue);
                            }

                            $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).attr('disabled', true);

                            current_total = current_total - service_price;

                            $('#executive_for_service_button_'+booking_details_id+'_'+serviceID).text('Select Stylist'); 
                                
                            if(user_selected_add_service.length == 0){
                                $('#selected_services_empty_'+booking_details_id).show();
                                $('#selected_services_'+booking_details_id).hide();
                            }

                            var tempArray = [];
                            $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).each(function() {
                                if ($(this).prop('checked')) {
                                    $(this).prop('checked', false); 
                                    tempArray.push($(this).val());
                                }
                            });

                            for (var i = 0; i < tempArray.length; i++) {
                                setAddServiceProductPrice(booking_details_id,serviceID,tempArray[i]);
                            }

                            calculateTotalAddServiceDuration(booking_details_id,serviceID);
                
                            fetchTimeSlots(booking_details_id);

                            $('#total_add_service_price_' + booking_details_id).val(parseFloat(current_total).toFixed(2));
                            $('#total_add_service_price_text_' + booking_details_id).text(parseFloat(current_total).toFixed(2));

                            setPayableAddServiceAmount(booking_details_id,serviceID);

                            $("#selected_service_details_"+booking_details_id+"_"+serviceID).remove();

                            $('.loader_div').hide();   
                        }, 3000);
                    }
                    });
                }
                function setAddServicePrice(booking_details_id,serviceID,service_duration,service_rewards,service_price){ 
                    var current_total = parseFloat($("#total_add_service_price_" + booking_details_id).val());
                    if(!user_selected_add_service.includes(serviceID)){                        
                        var booking_date = $('#booking_date_' + booking_details_id).val();
                        var booking_start = $('#booking_start_' + booking_details_id).val();

                        if (booking_date !== "" && booking_start !== "") {
                            $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).attr('disabled', false);

                            current_total = current_total + parseFloat(service_price);

                            user_selected_add_service.push(serviceID);
                            var currentValue = $("#selected_add_service_" + booking_details_id).val(); 
                            if (currentValue === '') {
                                $("#selected_add_service_" + booking_details_id).val(serviceID); 
                            } else {
                                $("#selected_add_service_" + booking_details_id).val(currentValue + ',' + serviceID);
                            }

                            var tempArray = [];

                            $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).each(function() {
                                $(this).prop('checked', true); 
                                tempArray.push($(this).val());
                            });

                            for (var i = 0; i < tempArray.length; i++) {
                                setAddServiceProductPrice(booking_details_id,serviceID,tempArray[i]);
                            }
                        }else{
                            // alert('Please select booking date and timeslot first');
                            openDialog('Please select booking date and timeslot first'); 
                            $('#service_' + booking_details_id).val('');
                        }
                    }else{
                        // alert('Service already selected');
                        openDialog('Service already selected'); 
                    }
                    
                    calculateTotalAddServiceDuration(booking_details_id,serviceID);
                    fetchTimeSlots(booking_details_id);

                    $('#total_add_service_price_' + booking_details_id).val(parseFloat(current_total).toFixed(2));
                    $('#total_add_service_price_text_' + booking_details_id).text(parseFloat(current_total).toFixed(2));

                    setPayableAddServiceAmount(booking_details_id,serviceID);
                }

                function setAddServiceProductPrice(booking_details_id,serviceID,productID){
                    $('.loader_div').show();   
                    setTimeout(function() {
                        var product_price = parseFloat($('#service_product_price_' + booking_details_id + '_'+serviceID+'_'+productID).val());
                        var current_total = parseFloat($('#total_add_service_product_price_' + booking_details_id).val());
                        var selected_product = parseInt($('#selected_service_product_' + booking_details_id + '_'+serviceID).text());
                        
                        if ($('#add_service_product_checkbox_' + booking_details_id + '_'+serviceID+'_'+productID).is(':checked')) {      
                            current_total = current_total + product_price;
                            selected_product = selected_product + 1;

                            user_selected_add_service_product.push(productID);
                        } else {
                            addServiceRemoveValue(user_selected_add_service_product, productID);

                            current_total = current_total - product_price;
                            selected_product = selected_product - 1;
                        }

                        $('#total_add_service_product_price_' + booking_details_id).val(parseFloat(current_total).toFixed(2));
                        $('#total_add_service_product_price_text_' + booking_details_id).text(parseFloat(current_total).toFixed(2));
                        $('#selected_service_product_' + booking_details_id + '_'+serviceID).text(parseInt(selected_product));
                        
                        setPayableAddServiceProductAmount(booking_details_id,serviceID);
                        $('.loader_div').hide();   
                    }, 1500);
                }
                function addServiceRemoveValue(arr, value) {
                    var index = arr.indexOf(value);
                    if (index !== -1) {
                        arr.splice(index, 1);
                    }
                    return arr;
                }
                
                function setPayableAddServiceProductAmount(booking_details_id,serviceID){
                    total_product_amount = parseFloat($('#total_add_service_product_price_' + booking_details_id).val());

                    member_product_discount = $('#add_service_membership_product_discount_' + booking_details_id).val();
                    membership_discount_type = $('#add_service_membership_discount_type_' + booking_details_id).val();

                    if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
                        member_product_discount = 0;
                    }else{
                        member_product_discount = parseFloat(member_product_discount);
                    }
                    
                    if(membership_discount_type == '0'){
                        discount = (total_product_amount * member_product_discount)/100;
                    }else if(membership_discount_type == '1'){
                        discount = member_product_discount;
                    }else{
                        discount = 0;
                    }        

                    if(total_product_amount == 0){
                        discount = 0;
                    }

                    $('#add_service_membership_product_discount_amount_' + booking_details_id).val(parseFloat(discount).toFixed(2));

                    payable = total_product_amount - discount;
                    
                    $('#add_service_product_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));
                    $('#add_service_product_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));

                    setPayableAddServiceAmount(booking_details_id,serviceID);
                }
                
                function setPayableAddServiceAmount(booking_details_id,serviceID){
                    total_service_amount = parseFloat($('#total_add_service_price_' + booking_details_id).val());   
                    
                    member_service_discount = $('#add_service_membership_service_discount_' + booking_details_id).val();
                    membership_discount_type = $('#add_service_membership_discount_type_' + booking_details_id).val();

                    if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
                        member_service_discount = 0;
                    }else{
                        member_service_discount = parseFloat(member_service_discount);
                    }
                    
                    if(membership_discount_type == '0'){
                        discount = (total_service_amount * member_service_discount)/100;
                    }else if(membership_discount_type == '1'){
                        discount = member_service_discount;
                    }else{
                        discount = 0;
                    }        

                    if(total_service_amount == 0){
                        discount = 0;
                    }

                    $('#add_service_membership_service_discount_amount_' + booking_details_id).val(parseFloat(discount).toFixed(2));

                    payable = total_service_amount - discount;

                    $('#add_service_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));    
                    $('#add_service_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));    

                    setAddServicePayableAmount(booking_details_id,serviceID);
                } 
                function setAddServicePayableAmount(booking_details_id,serviceID){
                    calculateAddServiceTotalDiscount(booking_details_id,serviceID);

                    service_payable = parseFloat($('#add_service_payable_hidden_' + booking_details_id).val());
                    product_payable = parseFloat($('#add_service_product_payable_hidden_' + booking_details_id).val());

                    payable = service_payable + product_payable;

                    $('#add_service_final_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));
                    $('#add_service_final_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));
                }
                
                function calculateAddServiceTotalDiscount(booking_details_id,serviceID){
                    $('#add_service_discount_details_div_' + booking_details_id).html('');
                    var membership_service_discount_amount = parseFloat($('#add_service_membership_service_discount_amount_' + booking_details_id).val());
                    var membership_product_discount_amount = parseFloat($('#add_service_membership_product_discount_amount_' + booking_details_id).val());

                    total_discount = membership_service_discount_amount + membership_product_discount_amount;
                    $('#add_service_total_discount_amount_text_' + booking_details_id).text(parseFloat(total_discount).toFixed(2));
                    $('#add_service_total_discount_amount_' + booking_details_id).val(parseFloat(total_discount).toFixed(2));

                    var discount_details = '<div id="extra_service_discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
                    discount_details += '<div class="extra-service-discount-tooltip">';
                    if (membership_service_discount_amount > 0) {
                        discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
                    }
                    if (membership_product_discount_amount > 0) {
                        discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
                    }
                    discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>';
                    discount_details += '</div></div>';
                    if(total_discount > 0){
                        $('#add_service_discount_details_div_' + booking_details_id).html(discount_details);
                    }
                } 

                function calculateTotalAddServiceDuration(booking_details_id,serviceID){
                    total_duration = 0;

                    for(var i=0;i<user_selected_add_service.length;i++){
                        duration = $('#service_duration_' + booking_details_id + '_' + serviceID).val();
                        total_duration = total_duration + parseFloat(duration);
                    }

                    $('#upper_duration').text(parseInt(total_duration) + ' Mins');
                }
            </script>
        <?php 
        }else{ 
        ?>
            <div>
                <label class="error">Booking details not found</label>
            </div>
        <?php 
        }
    }
    
    public function get_category_services(){
        $category = $this->input->post('category');

        $this->db->where('tbl_salon_emp_service.category',$category);
        $this->db->where('tbl_salon_emp_service.is_deleted','0');
        $services = $this->db->get('tbl_salon_emp_service')->result();

        echo json_encode($services);
    }
    
    public function show_service_cancel_popup_ajx(){
        $booking_service_details_id = $this->input->post('booking_service_details_id');

        $this->db->select('tbl_booking_services_details.*,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration');
        $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
        $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
        $this->db->where('tbl_booking_services_details.id',$booking_service_details_id);
        $this->db->where('tbl_booking_services_details.is_deleted','0');
        $bookings = $this->db->get('tbl_booking_services_details')->row();

        if(!empty($bookings)){
        ?>
            <div class="calender_booking_details">
                <table style="width:100%;" border="1">
                    <thead>
                        <tr>
                            <th>Customer:</th>
                            <td><?=$bookings->customer_name;?>, <?=$bookings->customer_phone;?></td>
                        </tr>
                        <tr>
                            <th>Service:</th>
                            <td><?=$bookings->service_name;?> | <?=$bookings->service_name_marathi;?> <?php if($bookings->service_added_from == '1') { ?><small>(Package Service)</small><?php } ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?=date('d-m-Y',strtotime($bookings->service_date));?></td>
                        </tr>
                        <tr>
                            <th>Duration:</th>
                            <td><?=date('h:i A',strtotime($bookings->service_from));?> to <?=date('h:i A',strtotime($bookings->service_to));?></td>
                        </tr>
                        <tr>
                            <th>Stylist:</th>
                            <td><?=$bookings->stylist_name;?></td>
                        </tr>
                    </thead>
                </table>
                <!-- <form method="post" name="cancel_form_<?=$bookings->id;?>" id="cancel_form_<?=$bookings->id;?>" enctype="multipart/form-data" action="<?=base_url();?>cancel_booking_service/<?=base64_encode($bookings->id);?>">
                    <div class="col-md-12">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Remark<b class="require">*</b></label>
                            <textarea class="form-control" name="remark_<?=$bookings->id;?>" id="remark_<?=$bookings->id;?>"></textarea>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary" id="cancel_btn" value="cancel_btn">Save</button>
                        </div>
                    </div>
                </form> -->                
                <div class="col-md-12" id="cancel_btn_div" style="margin-top:20px;">
                    <div class="form-group col-md-12 col-xs-12">
                        <label>Remark<b class="require">*</b></label>
                        <textarea class="form-control" name="remark_<?=$bookings->id;?>" id="remark_<?=$bookings->id;?>"></textarea>
                        <label for="remark_<?=$bookings->id;?>" id="remark_error_<?=$bookings->id;?>" generated="true" class="error"></label>
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <button type="button" class="btn btn-danger" id="cancel_btn" value="cancel_btn" onclick="cancelService(<?=$bookings->id;?>,<?=$bookings->stylist_id;?>)">Cancel</button>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function () {        
                $('#cancel_form_<?=$bookings->id;?>').validate({
                    rules: {
                        remark_<?=$bookings->id;?>: {
                            required: true,
                        },
                    },
                    messages: {
                        remark_<?=$bookings->id;?>: {
                            required:'Please enter remark!',
                        },
                    },
                    submitHandler: function(form) {
                        if(confirm("Are you sure to cancel service?")) {
                        // openConfirmationDialog("Are you sure to cancel service?", function (confirmed) {
                        // if (confirmed) {
                            form.submit();
                        } else {
                            return false;
                        }
                        // });
                    }
                });
            });
            </script>
        <?php 
        }else{ 
        ?>
            <div>
                <label class="error">Booking details not found</label>
            </div>
        <?php 
        }
    }
    public function get_saloon_working_hrs_slots(){
        $booking_rules = $this->get_booking_rules();
        $date = $this->input->post('date');

        $timestamp = strtotime($date);        
        $dayOfWeek = date('l', $timestamp);

        if($dayOfWeek == 'Monday'){
            $column = 'is_monday';
            $from = 'from_monday';
            $to = 'to_monday';
        }elseif($dayOfWeek == 'Tuesday'){
            $column = 'is_tuesday';
            $from = 'from_tuesday';
            $to = 'to_tuesday';
        }elseif($dayOfWeek == 'Wednesday'){
            $column = 'is_wednesday';
            $from = 'from_wednesday';
            $to = 'to_wednesday';
        }elseif($dayOfWeek == 'Thursday'){
            $column = 'is_thursday';
            $from = 'from_thursday';
            $to = 'to_thursday';
        }elseif($dayOfWeek == 'Friday'){
            $column = 'is_friday';
            $from = 'from_friday';
            $to = 'to_friday';
        }elseif($dayOfWeek == 'Saturday'){
            $column = 'is_saturday';
            $from = 'from_saturday';
            $to = 'to_saturday';
        }elseif($dayOfWeek == 'Sunday'){
            $column = 'is_sunday';
            $from = 'from_sunday';
            $to = 'to_sunday';
        }else{
            $column = '';
            $from = '';
            $to = '';
        }
        $this->db->where($column, '1');
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $working_hrs = $this->db->get('tbl_booking_rules')->row();
        
        if(!empty($working_hrs)){
            $start = $working_hrs->$from;
            $end = $working_hrs->$to;

            if(!empty($booking_rules)){

            }
        }

    }
    public function get_all_salon_bookings()
    {       
        $this->db->select('tbl_new_booking.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone');
        $this->db->where('tbl_new_booking.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_new_booking.salon_id', $this->session->userdata('salon_id'));
		$this->db->join('tbl_salon_customer', 'tbl_new_booking.customer_name = tbl_salon_customer.id');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        $this->db->where('tbl_new_booking.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_new_booking.salon_id',$this->session->userdata('salon_id'));
        $this->db->order_by('tbl_new_booking.id', 'DESC');
        $result = $this->db->get('tbl_new_booking');
        return $result->result();
    }
    public function get_salon_bookings()
    {       
        $this->db->select('tbl_new_booking.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone,tbl_salon_customer.email,tbl_booking_services_details.service_date,tbl_booking_services_details.service_from,tbl_booking_services_details.service_to,tbl_booking_services_details.stylist_id,tbl_booking_services_details.service_id');
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
		$this->db->join('tbl_booking_services_details','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->where('tbl_new_booking.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_new_booking.salon_id',$this->session->userdata('salon_id'));
		$this->db->where('tbl_new_booking.is_deleted','0');
		
        if(isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] != '0'){
			$this->db->where('tbl_new_booking.id',$_GET['id']);
		}
        if(isset($_GET['customer']) && $_GET['customer'] != "" && $_GET['customer'] != '0'){
			$this->db->where('tbl_new_booking.customer_name',$_GET['customer']);
		}
        if(isset($_GET['from_date']) && $_GET['from_date'] != "" && $_GET['from_date'] != '0'){
			$this->db->where('DATE(tbl_booking_services_details.service_date) >=',date('Y-m-d',strtotime($_GET['from_date'])));
		}
        if(isset($_GET['to_date']) && $_GET['to_date'] != "" && $_GET['to_date'] != '0'){
			$this->db->where('DATE(tbl_booking_services_details.service_date) <=',date('Y-m-d',strtotime($_GET['to_date'])));
		}
        if(isset($_GET['service']) && $_GET['service'] != "" && $_GET['service'] != '0'){
			$this->db->where('tbl_booking_services_details.service_id',$_GET['service']);
		}
        if(isset($_GET['stylist']) && $_GET['stylist'] != "" && $_GET['stylist'] != '0'){
			$this->db->where('tbl_booking_services_details.stylist_id',$_GET['stylist']);
		}
        if(isset($_GET['status']) && $_GET['status'] != ""){
			$this->db->where('tbl_booking_services_details.service_status',$_GET['status']);
		}
		$this->db->order_by('tbl_new_booking.id','desc');
		$this->db->group_by('tbl_new_booking.id');
		$result = $this->db->get('tbl_new_booking')->result();
		return $result;
    }
    public function get_all_bookings_statuswise_dashboard()
    {       
		return array(
            'today_all'               =>  $this->get_all_bookings_status_date('',date('Y-m-d')),
            'today_completed'         =>  $this->get_all_bookings_status_date('1',date('Y-m-d')),
            'today_pending'           =>  $this->get_all_bookings_status_date('0',date('Y-m-d')),
            'today_cancelled'         =>  $this->get_all_bookings_status_date('2',date('Y-m-d')),
        );
    }
    public function get_all_bookings_status_date($status,$date)
    {       
        $this->db->select('tbl_booking_services_details.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone,tbl_salon_customer.email');
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
		$this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
		$this->db->where('tbl_booking_services_details.is_deleted','0');
        $this->db->where('tbl_booking_services_details.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_booking_services_details.salon_id',$this->session->userdata('salon_id'));
        if($status != ""){
		    $this->db->where('tbl_booking_services_details.service_status',$status);
        }
        if($date != ""){
		    $this->db->where('DATE(tbl_booking_services_details.service_date)',$date);
        }
		$result = $this->db->get('tbl_booking_services_details')->num_rows();
		return $result;
    }
    
	public function get_all_bookings_ajax(){
		$limit = $this->input->post('limit');
		$offset = $this->input->post('offset');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$customer = $this->input->post('customer');
		$id = $this->input->post('id');
		$service = $this->input->post('service');
		$stylist = $this->input->post('stylist');
		$status = $this->input->post('status');

		$this->db->select('tbl_new_booking.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone,tbl_salon_customer.email,tbl_booking_services_details.service_date,tbl_booking_services_details.service_from,tbl_booking_services_details.service_to,tbl_booking_services_details.stylist_id,tbl_booking_services_details.service_id');
		$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
		$this->db->join('tbl_booking_services_details','tbl_new_booking.id = tbl_booking_services_details.booking_id');
        $this->db->where('tbl_new_booking.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_new_booking.salon_id',$this->session->userdata('salon_id'));
		$this->db->where('tbl_new_booking.is_deleted','0');
		
		if($id != "" && $id != '0'){
			$this->db->where('tbl_new_booking.id',$id);
		}
		if($customer != "" && $customer != '0'){
			$this->db->where('tbl_new_booking.customer_name',$customer);
		}
		if($from_date != "" && $from_date != '0'){
			$this->db->where('DATE(tbl_booking_services_details.service_date) >=',date('Y-m-d',strtotime($from_date)));
		}
		if($to_date != "" && $to_date != '0'){
			$this->db->where('DATE(tbl_booking_services_details.service_date) <=',date('Y-m-d',strtotime($to_date)));
		}
		if($service != "" && $service != '0'){
			$this->db->where('tbl_booking_services_details.service_id',$service);
		}
		if($stylist != "" && $stylist != '0'){
			$this->db->where('tbl_booking_services_details.stylist_id',$stylist);
		}
		if($status != ""){
			$this->db->where('tbl_booking_services_details.service_status',$status);
		}
		$this->db->order_by('tbl_new_booking.id','desc');
		$this->db->group_by('tbl_new_booking.id');
		$this->db->limit($limit,$offset);
		$result = $this->db->get('tbl_new_booking')->result();
		return $result;
    }

	public function get_stylist_details($id){
		$this->db->where('tbl_salon_employee.id', $id);
		$result = $this->db->get('tbl_salon_employee')->row();
		return $result;
	}
    
    // public function submit_form() {
    //     $stylist = '5';
    //     $stylist_details = $this->get_stylist_details($stylist);
    //     $service_details = $this->get_service_details(6);
    //     $stylist_data = array(
    //         'booking_id' 		    => 28,
    //         'branch_id' 			=> 2,
    //         'salon_id' 				=> 2,
    //         'customer_name' 		=> 3,
    //         'service_added_from'	=> '0', //single
    //         'service_id'     		=> 6,
    //         'service_price'     	=> '1000',
    //         'original_service_price'=> '1000',
    //         'product_ids'     		=> null,
    //         'service_reward_points' => '20',
    //         'stylist_id'      		=> $stylist,
    //         'service_date'     		=> '2024-05-24',
    //         'service_from'    	    => '2024-05-24 10:00:00',
    //         'service_to'      	    => '2024-05-24 10:30:00',
    //         'created_on'            => '2024-05-20 10:30:00',
            
    //         'received_discount_amount_while_booking'     	=> '187.91208791209',
    //         'received_coupon_discount_while_booking'     	=> '87.912087912088',
    //         'received_reward_discount_while_booking'     	=> '0',
    //         'received_membership_discount_while_booking'    => '100',
    //         'received_giftcard_discount_while_booking'     	=> '0',
    //         'service_discounted_price_while_booking'     	=> '812.08791208791',
            
    //         'is_service_offer_applied'     	                => '0',
    //     );
    //     // echo '<pre>'; print_r($stylist_data);exit();
    //     $this->db->insert('tbl_booking_services_details', $stylist_data);
    //     $message = 'Received booking of ' . (!empty($service_details) ? $service_details->service_name : '') . ' for ' . (!empty($stylist_details) ? $stylist_details->full_name : '') . ' on 2024-05-24 10:30:00';
    //     $data = json_encode(['message' => $message,'stylist' => $stylist,'service_from' => '2024-05-24 10:00:00','service_to' => '2024-05-24 10:30:00','service_date' => '2024-05-24','service_name' => !empty($service_details) ? $service_details->service_name : '','stylist_name' => !empty($stylist_details) ? $stylist_details->full_name : '']);
    //     try {
    //         $client = new Client("ws://localhost:8080");
    //         $client->send($data);
    //         echo "Data sent to WebSocket server.";
    //     } catch (Exception $e) {
    //         echo "ERROR: " . $e->getMessage();
    //     }
    // }


    public function submit_form() {
        $service = $this->iput->post('service');
        $stylist = $this->iput->post('stylist');
        
        $stylist_details = $this->get_stylist_details($stylist);
        $service_details = $this->get_service_details($service);

        $duration = $service_details->service_duration;

        $from_date = $this->iput->post('date');
        $from_time = $this->iput->post('time');
        $service_from = date('Y-m-d H:i:s',strtotime($from_date.' '.$from_time));
        $service_end = date('Y-m-d H:i:s', strtotime($service_from . ' +' . $duration . ' minutes'));

        $stylist_data = array(
            'booking_id' 		    => 81,
            'branch_id' 			=> 6,
            'salon_id' 				=> 2,
            'customer_name' 		=> 13,
            'service_added_from'	=> '0', //single
            'service_id'     		=> $service,
            'service_price'     	=> '1000',
            'original_service_price'=> '1000',
            'product_ids'     		=> null,
            'service_reward_points' => '20',
            'stylist_id'      		=> $stylist,
            'service_date'     		=> date('Y-m-d',strtotime($from_date)),
            'service_from'    	    => $service_from,
            'service_to'      	    => $service_end,
            'created_on'            => date("Y-m-d H:i:s"),
            
            'received_discount_amount_while_booking'     	=> '187.91208791209',
            'received_coupon_discount_while_booking'     	=> '87.912087912088',
            'received_reward_discount_while_booking'     	=> '0',
            'received_membership_discount_while_booking'    => '100',
            'received_giftcard_discount_while_booking'     	=> '0',
            'service_discounted_price_while_booking'     	=> '812.08791208791',
            
            'is_service_offer_applied'     	                => '0',
        );
        echo '<pre>'; print_r($stylist_data);exit();
        $this->db->insert('tbl_booking_services_details', $stylist_data);
        $message = 'Received booking of ' . (!empty($service_details) ? $service_details->service_name : '') . ' for ' . (!empty($stylist_details) ? $stylist_details->full_name : '') . ' on '.date('d M, Y h:i A',strtotime($service_from)).'';
        $data = json_encode(['message' => $message,'stylist' => $stylist,'service_from' => $service_from,'service_to' => $service_end,'service_date' => date('Y-m-d',strtotime($from_date)),'service_name' => !empty($service_details) ? $service_details->service_name : '','stylist_name' => !empty($stylist_details) ? $stylist_details->full_name : '']);
        try {
            $client = new Client("wss://staginglink.org:8000");
            $client->send($data);
            echo "Data sent to WebSocket server.";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function get_day_timeslots_ajx(){
        $booking_rules = $this->get_booking_rules();
        
        $user_selected_service = $this->input->post('user_selected_service');

        $date = date('Y-m-d',strtotime($this->input->post('booking_date')));

        if($this->input->post('booking_start') == ""){
            if($this->input->post('selected_slot_start_time') != ""){
                $booking_start = date('H:i:s',strtotime($this->input->post('selected_slot_start_time')));
            }else{
                $booking_start = '';
            }
        }else{
            $booking_start = date('H:i:s',strtotime($this->input->post('booking_start')));
        }

        if(!empty($booking_rules)){
            $working_hrs = $this->get_saloon_working_hrs($date);
            $duration = $booking_rules->slot_time;

            if($working_hrs['is_allowed'] == 1){
                $minutes_early_booking = !empty($booking_rules->booking_time_range) ? $booking_rules->booking_time_range : 0;

                $store_start = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['start']));
                $store_end = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['end']));
                $slots = $this->generateCommonTimePairs($date,$store_start,$store_end,$duration);
        ?>
        <div class="row timeslot_row" style="margin: 0px !important; display: block !important;height: 100px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
        <?php
            for($i=0;$i<count($slots);$i++){
                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slots[$i]['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                $current_date = date('Y-m-d H:i:s');
                if ($current_date <= $allowed_booking_datetime) {
                    $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s',strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s',strtotime($slots[$i]['from']));
                    if(date('Y-m-d H:i:s',strtotime($slots[$i]['from'])) >= $selected_start){
                        $is_vacent = $this->check_slot_vacent_for_selected_services($slots[$i]['from'],$user_selected_service);
                        if($is_vacent){
                            $style = "#00800045";
                        }else{
                            $style = '#ff000061';
                        }
        ?>
            <div class="single_timeslot" style="background-color:<?=$style;?>;display: inline-block !important;padding: 2px 2px !important; width: 24% !important;margin: 5px 0px !important;">
                <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot" id="booking_start_time_slot" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStart('')">
                <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
            </div>
        <?php }}} ?>
        </div>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Store is closed for selected date</label>
            </div>
        <?php } ?>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
        <?php }
    }
    
    public function get_day_timeslots_reschedule_ajx(){
        $booking_rules = $this->get_booking_rules();
        
        $booking_details_id = $this->input->post('booking_details_id');
        $user_selected_service = $this->input->post('user_selected_service');

        $date = date('Y-m-d',strtotime($this->input->post('booking_date')));

        if($this->input->post('booking_start') == ""){
            if($this->input->post('selected_slot_start_time') != ""){
                $booking_start = date('H:i:s',strtotime($this->input->post('selected_slot_start_time')));
            }else{
                $booking_start = '';
            }
        }else{
            $booking_start = date('H:i:s',strtotime($this->input->post('booking_start')));
        }

        if(!empty($booking_rules)){
            $working_hrs = $this->get_saloon_working_hrs($date);
            $duration = $booking_rules->slot_time;

            if($working_hrs['is_allowed'] == 1){
                $minutes_early_booking = !empty($booking_rules->booking_time_range) ? $booking_rules->booking_time_range : 0;

                $store_start = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['start']));
                $store_end = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['end']));
                $slots = $this->generateCommonTimePairs($date,$store_start,$store_end,$duration);
        ?>
        <div class="row timeslot_row resc_service_timeslots" style="margin: 0px !important; gap:5px !important; display: flex !important;height: 100px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
        <?php
            for($i=0;$i<count($slots);$i++){
                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slots[$i]['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                $current_date = date('Y-m-d H:i:s');
                if ($current_date <= $allowed_booking_datetime) {
                    $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s',strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s',strtotime($slots[$i]['from']));
                    if(date('Y-m-d H:i:s',strtotime($slots[$i]['from'])) >= $selected_start){
                        $is_vacent = $this->check_slot_vacent_for_selected_services($slots[$i]['from'],$user_selected_service);
                        if($is_vacent){
                            $style = "#00800045";
                        }else{
                            $style = '#ff000061';
                        }
        ?>
            <div class="single_timeslot" style="background-color:<?=$style;?>;display: flex !important;padding: 2px 2px !important; width: 9% !important;margin: 0px 0px !important;">
                <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot_<?=$booking_details_id;?>" id="booking_start_time_slot_<?=$booking_details_id;?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStartReschedule(<?=$booking_details_id;?>,'<?=date('h:i A',strtotime($slots[$i]['from']));?>')">
                <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
            </div>
        <?php }}} ?>
        </div>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Store is closed for selected date</label>
            </div>
        <?php } ?>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
        <?php }
    }
    public function check_slot_vacent_for_selected_services($from,$selected_services){
        $selected_from = date('Y-m-d H:i:s',strtotime($from));

        if(!empty($selected_services)){
            for($i=0;$i<count($selected_services);$i++){
                $single_stylist_flag = 0;

                $stylists = $this->get_service_stylists($selected_services[$i]);

                if(!empty($stylists)){
                    $service_details = $this->get_service_details($selected_services[$i]);
                    if(!empty($service_details)){
                        $duration = (int)$service_details->service_duration;

                        $selected_to = date('Y-m-d H:i:s', strtotime($selected_from . ' +' . $duration . ' minutes'));

                        $is_stylist_available_storewise = $this->get_is_selected_booking_available_storewise($selected_from,$selected_to);
                        if($is_stylist_available_storewise){
                            foreach($stylists as $stylists_result){
                                $is_stylist_available_shiftwise = $this->get_is_selected_stylist_available_shiftwise($stylists_result->id,$selected_from,$selected_to);
                                if($is_stylist_available_shiftwise){
                                    $is_stylist_available_bookingwise = $this->get_is_selected_stylist_available_bookingwise($stylists_result->id,$selected_from,$selected_to);
                                    if($is_stylist_available_bookingwise){
                                        $is_stylist_available_breakwise = $this->get_is_selected_stylist_available_breakwise($stylists_result->id,$selected_from,$selected_to);
                                        if($is_stylist_available_breakwise){
                                            $single_stylist_flag = 1;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }            

                if($single_stylist_flag == 0){
                    return false;
                }

                $selected_from = $selected_to;
            }
        }
        return true;
    }
    

    public function get_is_selected_booking_available_storewise($selected_from, $selected_to){
        $working_hrs = $this->get_saloon_working_hrs(date('Y-m-d',strtotime($selected_from)));
        if(!empty($working_hrs)){
            $store_start = date('H:i:s',strtotime($working_hrs['start']));
            $store_end = date('H:i:s',strtotime($working_hrs['end']));

            $selected_from_time = date('H:i:s',strtotime($selected_from));
            $selected_to_time = date('H:i:s',strtotime($selected_to));

            if ($selected_from_time >= $store_start && $selected_to_time <= $store_end) {
                return true;
            }
        }

        return false;
    }
    public function get_is_selected_stylist_available_shiftwise($stylist, $selected_from, $selected_to){
        $shift_details = $this->get_stylist_shifts(date('Y-m-d',strtotime($selected_from)),$stylist);
        if(!empty($shift_details)){
            $shift_from = date('H:i:s',strtotime($shift_details['shift_from']));
            $shift_to = date('H:i:s',strtotime($shift_details['shift_to']));

            $selected_from_time = date('H:i:s',strtotime($selected_from));
            $selected_to_time = date('H:i:s',strtotime($selected_to));

            if ($selected_from_time >= $shift_from && $selected_to_time <= $shift_to) {
                return true;
            }
        }

        return false;
    }
    public function get_is_selected_stylist_available_breakwise($stylist, $selected_from, $selected_to){
        $shift_details = $this->get_stylist_shifts(date('Y-m-d',strtotime($selected_from)),$stylist);
        if(!empty($shift_details)){
            $shift_break_from = date('H:i:s',strtotime($shift_details['shift_break_from']));
            $shift_break_to = date('H:i:s',strtotime($shift_details['shift_break_to']));

            $selected_from_time = date('H:i:s',strtotime($selected_from));
            $selected_to_time = date('H:i:s',strtotime($selected_to));
            
            if(($selected_from_time >= $shift_break_from && $selected_from_time < $shift_break_to) || 
                ($selected_to_time > $shift_break_from && $selected_to_time <= $shift_break_to) ||
                ($selected_from_time < $shift_break_from && $selected_to_time > $shift_break_to)){
                return false;
            }

            return true;
        }
        
        return false;
    }
    public function get_is_selected_stylist_available_bookingwise($stylist, $selected_from, $selected_to){
        $custom = array();
        $selected_from_dt = strtotime($selected_from);
        $selected_to_dt = strtotime($selected_to);

        $this->db->where('tbl_booking_services_details.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_booking_services_details.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_booking_services_details.stylist_id', $stylist);
        $this->db->where('DATE(tbl_booking_services_details.service_date)', date('Y-m-d', $selected_from_dt));
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.service_status != ', '2');
        $bookings = $this->db->get('tbl_booking_services_details')->result();

        $overlapping_bookings = array();
        $stylist_available = true;

        if(!empty($bookings)){
            foreach($bookings as $bookings_result){
                $service_from_dt = strtotime($bookings_result->service_from);
                $service_to_dt = strtotime($bookings_result->service_to);

                if(($selected_from_dt >= $service_from_dt && $selected_from_dt < $service_to_dt) || 
                    ($selected_to_dt > $service_from_dt && $selected_to_dt <= $service_to_dt) ||
                    ($selected_from_dt < $service_from_dt && $selected_to_dt > $service_to_dt)){
                    $stylist_available = false;
                    $overlapping_bookings[] = $bookings_result->id;
                }
            }
        }

        $custom[] = array(
            'stylist'                 =>  $stylist,
            'overlapping_bookings'    =>  $overlapping_bookings,
        );

        if($stylist_available){
            return true; // Return true as soon as an available stylist is found
        }
    
        return false; // Return false only if no stylist is available
    }
    public function get_is_any_stylist_available($selected_from, $selected_to){
        $stylists = $this->get_all_salon_stylists();
        $custom = array();
    
        if(!empty($stylists)){
            $selected_from_dt = strtotime($selected_from);
            $selected_to_dt = strtotime($selected_to);
    
            foreach($stylists as $result){
                $this->db->where('tbl_booking_services_details.branch_id', $this->session->userdata('branch_id'));
                $this->db->where('tbl_booking_services_details.salon_id', $this->session->userdata('salon_id'));
                $this->db->where('tbl_booking_services_details.stylist_id', $result->id);
                $this->db->where('DATE(tbl_booking_services_details.service_date)', date('Y-m-d', $selected_from_dt));
                $this->db->where('tbl_booking_services_details.is_deleted', '0');
                $bookings = $this->db->get('tbl_booking_services_details')->result();
    
                $overlapping_bookings = array();
                $stylist_available = true;
    
                if(!empty($bookings)){
                    foreach($bookings as $bookings_result){
                        $service_from_dt = strtotime($bookings_result->service_from);
                        $service_to_dt = strtotime($bookings_result->service_to);
    
                        if(($selected_from_dt >= $service_from_dt && $selected_from_dt < $service_to_dt) || 
                            ($selected_to_dt > $service_from_dt && $selected_to_dt <= $service_to_dt) ||
                            ($selected_from_dt < $service_from_dt && $selected_to_dt > $service_to_dt)){
                            $stylist_available = false;
                            $overlapping_bookings[] = $bookings_result->id;
                        }
                    }
                }
    
                $custom[] = array(
                    'stylist'                 =>  $result->id,
                    'overlapping_bookings'    =>  $overlapping_bookings,
                );
    
                if($stylist_available){
                    return true; // Return true as soon as an available stylist is found
                }
            }
        }
    
        return false; // Return false only if no stylist is available
    }
    
    public function get_day_timeslots_extra_service_ajx(){
        $booking_rules = $this->get_booking_rules();
        
        $user_selected_service = $this->input->post('user_selected_service');
        
        $date = date('Y-m-d',strtotime($this->input->post('booking_date')));
        $booking_details_id = $this->input->post('booking_details_id');

        if($this->input->post('booking_start') == ""){
            if($this->input->post('selected_slot_start_time') != ""){
                $booking_start = date('H:i:s',strtotime($this->input->post('selected_slot_start_time')));
            }else{
                $booking_start = '';
            }
        }else{
            $booking_start = date('H:i:s',strtotime($this->input->post('booking_start')));
        }

        if(!empty($booking_rules)){
            $working_hrs = $this->get_saloon_working_hrs($date);
            $duration = $booking_rules->slot_time;

            if($working_hrs['is_allowed'] == 1){
                $minutes_early_booking = !empty($booking_rules->booking_time_range) ? $booking_rules->booking_time_range : 0;

                $store_start = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['start']));
                $store_end = date('Y-m-d H:i:s',strtotime($date.' '.$working_hrs['end']));
                $slots = $this->generateCommonTimePairs($date,$store_start,$store_end,$duration);
                
                // echo '<pre>'; print_r($slots);
        ?>
        <div class="row timeslot_row extra_service_timeslots" style="margin: 0px !important; display: block !important;height: 75px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
        <?php
            for($i=0;$i<count($slots);$i++){
                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slots[$i]['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                $current_date = date('Y-m-d H:i:s');
                if ($current_date <= $allowed_booking_datetime) {
                    $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s',strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s',strtotime($slots[$i]['from']));
                    if(date('Y-m-d H:i:s',strtotime($slots[$i]['from'])) >= $selected_start){
                        $is_vacent = $this->check_slot_vacent_for_selected_services($slots[$i]['from'],$user_selected_service);
                        if($is_vacent){
                            $style = "#00800045";
                        }else{
                            $style = '#ff000061';
                        }
        ?>
            <div class="single_timeslot" style="background-color:<?=$style;?>;display: inline-block !important;padding: 2px 2px !important; width: 13% !important;margin: 5px 0px !important;">
                <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot_<?=$booking_details_id;?>" id="booking_start_time_slot_<?=$booking_details_id;?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStart('',<?=$booking_details_id;?>)">
                <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
            </div>
        <?php }}} ?>
        </div>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Store is closed for selected date</label>
            </div>
        <?php } ?>
        <?php }else{ ?>
            <div class="col-lg-12">
                <label class="error">Booking Rules not available</label>
            </div>
        <?php }
    }



    public function get_student_data_ajax(){
        $this->db->select('tbl_student.*, 
                       tbl_payment_entry.course_name as payment_course_name,
                       tbl_course_master.course_name as master_course_name');
        $this->db->join('tbl_payment_entry', 'tbl_payment_entry.student_name = tbl_student.id', 'left');
        $this->db->join('tbl_course_master', 'tbl_course_master.id = tbl_payment_entry.course_name', 'left');
        $this->db->where('tbl_student.is_deleted','0');
        $this->db->where('tbl_student.phone',$this->input->post('phone'));
        $result = $this->db->get('tbl_student');
        echo json_encode($result->row());
    }

    public function get_student_payment_ajax(){
        $this->db->where('tbl_payment_entry.is_deleted','0');
        $this->db->where('tbl_payment_entry.student_name',$this->input->post('student_name'));
        $result = $this->db->get('tbl_payment_entry');
        echo json_encode($result->row());
    }


    // public function  get_total_fees_ajax($id){

    //     $course_names = explode('@@@',$id);
    //     // echo "<pre>";print_r($id);exit;
    //     $this->db->where('is_deleted','0');
	// 	$this->db->where('status','1');
    //     $this->db->group_start();
    //     foreach($course_names as $course_name){
    //         $this->db->or_where('course_name',$course_name);
    //     }
    //     $this->db->group_end();

    //     $result = $this->db->get('tbl_payment_entry');
	// 	$result = $result->result();
    //     // echo "<pre>";print_r($result);exit;

    //     $total_fees = 0;
    //     if ($result) {
    //         foreach($result as $row){
    //             $total_fees += $row->total_fees;
    //         }
    //     }
    //         return ['total_fees' => $total_fees];
    // }

    public function get_total_fees_ajax() {
        $id = $this->input->post('course_name_id');
        $course_names = explode('@@@', $id);
    
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $this->db->group_start();
        foreach($course_names as $course_name){
            $this->db->or_where('course_name', $course_name);
        }
        $this->db->group_end();
    
        $result = $this->db->get('tbl_payment_entry');
        $result = $result->result();
    
        $total_fees = 0;
        if ($result) {
            foreach($result as $row){
                $total_fees = $row->total_fees;
            }
        }
    
        return ['total_fees' => $total_fees];
    }
    
    
    

    
    // public function  get_fees_data_ajax($course_name_id,$student_id){
    //     $course_names = explode('@@@',$course_name_id);
    //     $course_name = $course_names[0];
    //     $this->db->where('is_deleted','0');
    //     $this->db->where('student_name',$student_id);
    //     $this->db->where('course_name',$course_name);
    //     $this->db->where('id','DESC');
    //     $result = $this->db->get('tbl_fees_history',1);
    //     if ($result->num_rows() > 0){
    //         $fees_data = $result->row_array();
    //         $total_paid_fees = $fees_data['total_paid_fees'];
    //         $total_pending_fees = $fees_data['total_pending_fees'];
    //     } else {
    //         $total_paid_fees = 0;
    //         $total_pending_fees = 0;          
    //     }
    //     $response  = array(
    //         'total_paid_fees' => $total_paid_fees,
    //         'total_pending_fees' => $total_pending_fees
    //     );
    //     echo json_encode($response);
    // } 

    public function get_fees_data_ajax() {
        $course_name_id = $this->input->post('course_name_id');
        $student_id = $this->input->post('student_id');
        $course_names = explode('@@@', $course_name_id);
        $course_name = $course_names[0];
        $this->db->select('tbl_fees_history.*,SUM(amount_to_paid) as paid_amount');
        $this->db->where('tbl_fees_history.is_deleted', '0');
        $this->db->where('tbl_fees_history.student_name', $student_id);
        $this->db->where('tbl_fees_history.course_name', $course_name);
        $this->db->order_by('tbl_fees_history.id', 'DESC'); 
        $result = $this->db->get('tbl_fees_history'); 
        
        if ($result->num_rows() > 0) {
            $fees_data = $result->row_array();
            $total_paid_fees = $fees_data['paid_amount'];
            $total_fees = $fees_data['total_fees'];
            // $total_pending_fees = $fees_data['total_pending_fees'];
            $total_pending_fees = (float) $total_fees - (float) $total_paid_fees;

            $total_fees = $this->get_total_fees_for_course($course_name, $student_id);

            if($total_pending_fees == "0"){
                $total_pending_fee = $total_fees;
            }else{
                $total_pending_fee = $total_pending_fees;
            }
            // echo "<pre>";print_r($total_fees);exit;

        } 
        else {
            $total_paid_fees = 0;
            $total_fees = 0;
            $total_pending_fees = (float) $total_fees - (float) $total_paid_fees;

            // echo "<pre>";print_r($total_fees);exit;
            $total_pending_fees = (float) $total_fees - (float) $total_paid_fees;
        }
        $response = array(
            'total_paid_fees' => $total_paid_fees,
            'total_pending_fees' => $total_pending_fee,
        );
        echo json_encode($response);
    }
    

    public function get_total_fees_for_course($course_name, $student_id) {
        // $this->db->select('tbl_payment_entry');
        $this->db->where('course_name', $course_name);
        $this->db->where('student_name', $student_id);
        $result = $this->db->get('tbl_payment_entry'); 
        if ($result->num_rows() > 0) {
            $course_data = $result->row_array();
            return $course_data['total_fees'];
        } else {
            return 0; 
        }
    }

    // public function get_date_time_filter(){
      
    //     $this->db->where('is_deleted','0');
    //     if(isset($_GET['dob']) && $_GET['dob'] != ""){
    //         $exp = explode("to",$_GET['dob']);
	// 		$this->db->where('DATE(tbl_salon_customer.dob) >=',date("Y-m-d",strtotime($exp[0]))); 
	// 		$this->db->where('DATE(tbl_salon_customer.dob) <=',date("Y-m-d",strtotime($exp[1]))); 
    //     }
    //     $this->db->order_by('id','DESC');
    //     $result = $this->db->get('tbl_salon_customer');
    //     return $result->result();
    // }
    
    
    // public function get_date_time_filter() {
    //     if(isset($_GET['dob'])){
    //         $dobRange = json_decode($_GET['dob']);
    //         $from = isset($dobRange->start) ? date('m-d', strtotime($dobRange->start)) : '';
    //         $to = isset($dobRange->end) ? date('m-d', strtotime($dobRange->end)) : '';
    //     } else {
    //         $from = '';
    //         $to = '';
    //     }
    //     $this->db->where('is_deleted', '0');
    //     $this->db->where('DAY(tbl_salon_customer.dob) >=',date('d'));
    //     $this->db->where('MONTH(tbl_salon_customer.dob)',date('m'));
    
    //     $this->db->order_by('id', 'DESC');
    //     $result = $this->db->get('tbl_salon_customer')->result();
    //     return $result;
    // }
    

    public function get_date_time_filter() {

        if(isset($_GET['dob'])){
            $dobRange = json_decode($_GET['dob']);
        // echo "<pre>";print_r($_GET['dob']);exit;
        $from = isset($dobRange->start) ? date('m-d', strtotime($dobRange->start)) : '';
        $to = isset($dobRange->end) ? date('m-d', strtotime($dobRange->end)) : '';
         
        } else {
            $from = '';
            $to = '';
        }
        
        $this->db->where('is_deleted', '0');
        $this->db->where('DAY(tbl_salon_customer.dob) >=', date('d', strtotime($dobRange->start)));
        $this->db->where('DAY(tbl_salon_customer.dob) <=', date('d', strtotime($dobRange->end)));
        $this->db->where('MONTH(tbl_salon_customer.dob) >=', date('m', strtotime($dobRange->start)));
        $this->db->where('MONTH(tbl_salon_customer.dob) <=', date('m', strtotime($dobRange->end)));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $customers = $this->db->get('tbl_salon_customer')->result();
        $results = array();
        foreach ($customers as $customer) {
            $dob = date('Y') . '-' . date('m-d', strtotime($customer->dob));
            $nextBirthday = date('Y') . '-' . date('m-d', strtotime($customer->dob));
            if (strtotime($nextBirthday) < time()) {
                $nextBirthday = date('Y-m-d', strtotime($nextBirthday . ' +1 year'));
            }
    
            $daysUntilNextBirthday = floor((strtotime($nextBirthday) - time()) / (60 * 60 * 24));
            $monthsUntilNextBirthday = floor($daysUntilNextBirthday / 30.4375); 
        
            $result = array(
                'customer' => $customer,
                'days_until_next_birthday' => $daysUntilNextBirthday,
                'months_until_next_birthday' => $monthsUntilNextBirthday
            );
            $results[] = $result;
        }
  
        return $results;

    }
    

    
      
    public function get_date_time_anniversary_filter() {
        if(isset($_GET['doa'])){
            $doaRange = json_decode($_GET['doa']);
            $from = isset($doaRange->start) ? date('m-d', strtotime($doaRange->start)) : '';
       
            $to = isset($doaRange->end) ? date('m-d', strtotime($doaRange->end)) : '';
    
        } else {
            $from = '';
            $to = '';
        }
        $this->db->where('is_deleted', '0');
        $this->db->where('DAY(tbl_salon_customer.doa) >=', date('d', strtotime($doaRange->start)));
        $this->db->where('DAY(tbl_salon_customer.doa) <=', date('d', strtotime($doaRange->end)));
        $this->db->where('MONTH(tbl_salon_customer.doa) >=', date('m', strtotime($doaRange->start)));
        $this->db->where('MONTH(tbl_salon_customer.doa) <=', date('m', strtotime($doaRange->end)));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->order_by('id', 'DESC');
        $customers = $this->db->get('tbl_salon_customer')->result();

        $results = array();
        foreach ($customers as $customer) {
            $dob = date('Y') . '-' . date('m-d', strtotime($customer->doa));
            $nextAnniversary = date('Y') . '-' . date('m-d', strtotime($customer->doa));
            if (strtotime($nextAnniversary) < time()) {
                $nextAnniversary = date('Y-m-d', strtotime($nextAnniversary . ' +1 year'));
            }
    
            $daysUntilNextAnniversary = floor((strtotime($nextAnniversary) - time()) / (60 * 60 * 24));
            $monthsUntilNextAnniversary = floor($daysUntilNextAnniversary / 30.4375); 
           
            $result = array(
                'customer' => $customer,
                'days_until_next_anniversary' => $daysUntilNextAnniversary,
                'months_until_next_anniversary' => $monthsUntilNextAnniversary
            );
            $results[] = $result;
        }
   
        return $results;

    }
    
    public function get_service_repeat_filter() {
        if(isset($_GET['service_date'])){
            $service_dateRange = json_decode($_GET['service_date']);
            $from = isset($service_dateRange->start) ? date('Y-m-d', strtotime($service_dateRange->start)) : '';
            // echo "<pre>";print_r($from);exit;
            $to = isset($service_dateRange->end) ? date('Y-m-d', strtotime($service_dateRange->end)) : '';
            // echo "<pre>";print_r($to);exit;
        } else {
            $from = '';
            $to = '';
        }
        $this->db->select('tbl_booking_services_details.*,tbl_salon_customer.full_name as fullname');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');

        if ($from && $to) {
            $this->db->where('tbl_booking_services_details.service_date >=', $from);
            $this->db->where('tbl_booking_services_details.service_date <=', $to);
        }
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name','left');
        $this->db->order_by('tbl_booking_services_details.id', 'DESC');
        $result = $this->db->get('tbl_booking_services_details')->result();
        return $result;
        // echo "<pre>";print_r($result);exit;
    }
   

    public function get_cancel_appointment_filter() {
        if(isset($_GET['cancelled_on'])){
            $cancelled_onRange = json_decode($_GET['cancelled_on']);
            $from = isset($cancelled_onRange->start) ? date('Y-m-d', strtotime($cancelled_onRange->start)) : '';
            $to = isset($cancelled_onRange->end) ? date('Y-m-d', strtotime($cancelled_onRange->end)) : '';
        } else {
            $from = '';
            $to = '';
        }
        $this->db->select('tbl_booking_services_details.*, tbl_salon_customer.full_name as fullname');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.service_status', '2');
        if ($from && $to) {
            $this->db->where("DATE(tbl_booking_services_details.cancelled_on) BETWEEN '$from' AND '$to'");
        }
        $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_services_details.customer_name', 'left');
        $this->db->order_by('tbl_booking_services_details.id', 'DESC');
        $result = $this->db->get('tbl_booking_services_details')->result();
        return $result;
    }
    
    // public function get_lost_customer_filter() {
    //     if(isset($_GET['service_date'])){
    //         $service_dateRange = json_decode($_GET['service_date']);
    //         $from = isset($service_dateRange->start) ? date('Y-m-d', strtotime($service_dateRange->start)) : '';
    //     // echo "<pre>";print_r($result);exit;
    //         $to = isset($service_dateRange->end) ? date('Y-m-d', strtotime($service_dateRange->end)) : '';
    //     } else {
    //         $from = '';
    //         $to = '';
    //     }
    //     $this->db->select('tbl_booking_services_details.*,tbl_salon_customer.full_name as fullname');
    //     $this->db->where('tbl_booking_services_details.is_deleted', '0');

    //     if ($from && $to) {
    //         $this->db->where('tbl_booking_services_details.service_date >=', $from);
    //         $this->db->where('tbl_booking_services_details.service_date <=', $to);
    //     }
    //     $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name','left');
    //     $this->db->order_by('tbl_booking_services_details.id', 'DESC');
    //     $result = $this->db->get('tbl_booking_services_details')->result();
    //     return $result;
    //     // echo "<pre>";print_r($result);exit;
    // }

    

    public function get_lost_customer_filter() {
        if (isset($_GET['service_date'])) {
            $service_dateRange = json_decode($_GET['service_date']);
            $from = isset($service_dateRange->start) ? date('Y-m-d', strtotime($service_dateRange->start)) : '';
            $to = isset($service_dateRange->end) ? date('Y-m-d', strtotime($service_dateRange->end)) : '';
        } else {
            $from = '';
            $to = '';
        }
    
        $this->db->select('tbl_booking_services_details.*, tbl_salon_customer.full_name as fullname, tbl_salon_customer.customer_phone as contact');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
    
        if ($from && $to) {
            $this->db->where('tbl_booking_services_details.service_date >=', $from);
            $this->db->where('tbl_booking_services_details.service_date <=', $to);
        }
    
        $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_services_details.customer_name', 'left');
        $this->db->order_by('tbl_booking_services_details.id', 'DESC');
        $result = $this->db->get('tbl_booking_services_details')->result();
    
        // Calculate the range in months
        $start_date = new DateTime($from);
        $end_date = new DateTime($to);
        $interval = $start_date->diff($end_date);
        $months_difference = $interval->m + ($interval->y * 12);
    
        // Append the month difference to each record
        foreach ($result as $key => $row) {
            $result[$key]->months_difference = $months_difference;
        }
    
        return $result;
        // echo "<pre>";print_r($result);exit;

    }
    
    
}

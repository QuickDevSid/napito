<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Firebase\JWT\JWT;

class Common_model extends CI_Model {	
	public function test_notification() {
		$client = new Client();
		$title = 'Test Notification Title';
		$message = 'Description';
        $serviceAccountPath = 'ms-saloon-62cc32c90636.json';
		
		$device_token = 'dFKcIBU_QAaQCmgdGIsWEy:APA91bErHRbwoVmg2L0214fYXEXi5yeFh9bZK9p6RzHIS8qqAxwLPGqGppvl8-mhVOnx4LnHMfzAi0vT5BKGq-j7c8xO2VBVaxhfLDN5tl3NL9MKQjliftI';

        $jsonKey = json_decode(file_get_contents($serviceAccountPath), true);
        $jwt = $this->generate_jwt($jsonKey);
		if($jwt['status']){
			$jwt_token = $jwt['data'];
			$url = 'https://fcm.googleapis.com/v1/projects/ms-saloon/messages:send';
			
			$body = [
				"message" => [
					"token" => $device_token,
					"notification" => [
						"title" => $title,
						"body" => $message,
					],
					"data" => [
						"landing_page" => '',
						"order_id" => ''
					]
				]
			];		

			try {
				$response = $client->post($url, [
					'headers' => [
						'Authorization' => 'Bearer ' . $jwt_token,
						'Content-Type' => 'application/json'
					],
					'json' => $body
				]);
				
				echo $response->getBody();
			} catch (RequestException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}else{
			echo 'Response: ' . json_encode($jwt);
		}
	}
	private function generate_jwt($jsonKey) {
		try {
			$now_seconds = time();
			$payload = array(
				"iss" => $jsonKey['client_email'],
				"sub" => $jsonKey['client_email'],
				"aud" => "https://oauth2.googleapis.com/token",
				"iat" => $now_seconds,
				"exp" => $now_seconds + 3600,
				"scope" => "https://www.googleapis.com/auth/cloud-platform"
			);
	
			$jwt = JWT::encode($payload, $jsonKey['private_key'], 'RS256');
	
			$client = new Client();
			$response = $client->post('https://oauth2.googleapis.com/token', [
				'form_params' => [
					'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
					'assertion' => $jwt
				]
			]);
	
			$accessToken = json_decode($response->getBody(), true);
	
			return [
				'status' => true,
				'error' => 'none',
				'message' => '',
				'data' => $accessToken['access_token'],
			];
	
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			// Handle client exceptions like 400 errors
			$response = $e->getResponse();
			$responseBody = $response->getBody()->getContents();
			error_log('ClientException: ' . $responseBody);
	
			return [
				'status' => false,
				'error' => 'ClientException',
				'message' => $responseBody,
				'data' => '',
			];
	
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			// Handle other request exceptions
			error_log('RequestException: ' . $e->getMessage());
	
			return [
				'status' => false,
				'error' => 'RequestException',
				'message' => $e->getMessage(),
				'data' => '',
			];
	
		} catch (\Exception $e) {
			// Handle other types of exceptions
			error_log('Exception: ' . $e->getMessage());
	
			return [
				'status' => false,
				'error' => 'Exception',
				'message' => $e->getMessage(),
				'data' => '',
			];
		}
    }
	public function send_app_notification($device_token,$title,$message,$data) {
		$client = new Client();

		$serviceAccountPath = 'ms-saloon-62cc32c90636.json';

		$jsonKey = json_decode(file_get_contents($serviceAccountPath), true);
		$jwt = $this->generate_jwt($jsonKey);
		if($jwt['status']){
			$jwt_token = $jwt['data'];
			$url = 'https://fcm.googleapis.com/v1/projects/ms-saloon/messages:send';
			
			$body = [
				"message" => [
					"token" => $device_token,
					"notification" => [
						"title" => $title,
						"body" => urldecode(str_replace('%0a', '\n', $message)),
					],
					"data" => $data
				]
			];

			try {
				$response = $client->post($url, [
					'headers' => [
						'Authorization' => 'Bearer ' . $jwt_token,
						'Content-Type' => 'application/json',
					],
					'json' => $body,
				]);
				
				// Check if the response status code is in the 2xx range
				if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
					// echo "Notification sent successfully: " . $response->getBody();
					// return true;
					return "Notification sent successfully: " . $response->getBody();
				} else {
					// echo "Failed to send notification: " . $response->getBody();
					// return false;
					return "Failed to send notification: " . $response->getBody();
				}
			} catch (RequestException $e) {
				// Handle any errors that occur during the request
				if ($e->hasResponse()) {
					$errorResponse = $e->getResponse();
					// echo "Error occurred: " . $errorResponse->getBody();
					return "Error occurred: " . $errorResponse->getBody();
				} else {
					// echo "Error occurred: " . $e->getMessage();
					return "Error occurred: " . $e->getMessage();
				}
				// return false;
			}
		}else{
			return "Error occurred: " . $jwt['message'];
		}
	}

	private function generate_jwt_old($jsonKey) {
        $now_seconds = time();
        $payload = array(
            "iss" => $jsonKey['client_email'],
            "sub" => $jsonKey['client_email'],
            "aud" => "https://oauth2.googleapis.com/token",
            "iat" => $now_seconds,
            "exp" => $now_seconds + 3600,
            "scope" => "https://www.googleapis.com/auth/cloud-platform"
        );

        $jwt = JWT::encode($payload, $jsonKey['private_key'], 'RS256');

        $client = new Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ]
        ]);

        $accessToken = json_decode($response->getBody(), true);

        return $accessToken['access_token'];
    }

	public function get_terms_policy($type){		
		$this->db->where('type', $type);
		if(isset($_GET['type']) && $_GET['type'] != ""){
			$this->db->where('for', $_GET['type']);
		}else{
			$this->db->where('for', '0');
		}
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');                  
		$this->db->order_by('id', 'DESC');                
		$result = $this->db->get('tbl_privacy_policy_and_terms');
		$terms = $result->result();
		return $terms;
	}

	public function get_message_type($type){
		$message_type = '-';
		switch ($type) {
			case '0': $message_type = 'Login OTP'; break;
			case '1': $message_type = 'Birthday'; break;
			case '2': $message_type = 'Anniversary'; break;
			case '3': $message_type = 'Service Repeat'; break;
			case '4': $message_type = 'Lost Customer'; break;
			case '5': $message_type = 'Booking Confirmed'; break;
			case '6': $message_type = 'Booking Rescheduled'; break;
			case '7': $message_type = 'Service Cancelled'; break;
			case '8': $message_type = 'Payment Done'; break;
			case '9': $message_type = 'Booking Reminder'; break;
			case '10': $message_type = 'Customize Message'; break;
			case '11': $message_type = 'Offer Message'; break;
			case '12': $message_type = 'Consent Form Share'; break;
			case '13': $message_type = 'Branch Registration Email'; break;
			case '14': $message_type = 'Coupon Message'; break;
			case '15': $message_type = 'Giftcard Message'; break;
			case '16': $message_type = 'Support Query Raised'; break;
			case '17': $message_type = 'Query Replay By Customer'; break;
			case '18': $message_type = 'Query Replay By Admin'; break;
			case '19': $message_type = 'Query Resolved'; break;
			case '20': $message_type = 'Membership Purchase'; break;
			case '21': $message_type = 'Package Purchase'; break;
			case '22': $message_type = 'Giftcard Purchase'; break;
			case '23': $message_type = 'Trying for Booking'; break;
			case '24': $message_type = 'Easy Booking Promotion'; break;
			case '25': $message_type = 'Yesterday Appointment Cancelled'; break;
		}
		return $message_type;

	}

	public function set_wp_feature(){
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('include_wp','0');
		$branches = $this->db->get('tbl_branch')->result();
		$is_found = false;
		$count = 0;
		if(!empty($branches)){
			foreach($branches as $row){				
				$this->db->where('id',$row->subscription_id);
				$this->db->where('include_wp','1');
				$wp_subscription = $this->db->get('tbl_subscription_master')->row();
				if(!empty($wp_subscription)){
					if(!$is_found){
						$is_found = true;
					}

					$count++;

					$include_wp = $wp_subscription->include_wp;
					$wp_coins_qty = $wp_subscription->wp_coins_qty;

					$wp_update_data = array(
						'include_wp'				=>	$include_wp,
						'wp_coins_qty'				=>	$wp_coins_qty,
						'current_wp_coins_balance'	=>	$wp_coins_qty
					);

					$this->db->where('id',$row->id);
					$this->db->update('tbl_branch',$wp_update_data);
					
					$this->db->where('id',$row->subscription_allocation_id);
					$this->db->update('tbl_branch_subscription_allocation',$wp_update_data);
				}
			}
		}

		if($is_found){
			echo json_encode(array(
				'status'			=>	'success',
				'message'			=>	'Whatsapp feature allocated to respective branches',
				'updated_branches'	=>	$count
			));
		}else{
			echo json_encode(array(
				'status'	=>	'failed',
				'message'	=>	'Branches not available for updation'
			));
		}
	}
	public function set_cron_report($data){
		$data['created_on'] = date('Y-m-d H:i:s');
		$this->db->insert('tbl_cron_reports',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_cron_report($data,$single_id){
		$data['updated_on'] = date('Y-m-d H:i:s');
		$this->db->where('id',$single_id);
		$this->db->update('tbl_cron_reports',$data);
		return $single_id;
	}

	public function booking_calculations($customer_id, $service_ids, $services_data, $product_ids, $products_data, $branch_id, $salon_id, $applied_offer_id, $applied_coupon_id, $applied_giftcard_no, $is_user_rewards_applied, $selected_package_details, $selected_membership_details){		
		$return_data = array();
				
		$this->db->select('tbl_salon_customer.*,tbl_salon.is_gst_applicable,tbl_salon.gst_no');
		$this->db->join('tbl_salon','tbl_salon_customer.salon_id = tbl_salon.id');
		$this->db->join('tbl_branch','tbl_salon_customer.branch_id = tbl_branch.id');
		$this->db->where('tbl_salon_customer.is_deleted','0');
		$this->db->where('tbl_salon.is_deleted','0');
		$this->db->where('tbl_branch.is_deleted','0');
		$this->db->where('tbl_salon_customer.status','1');
		$this->db->where('tbl_salon_customer.id',$customer_id);
		$this->db->where('tbl_salon_customer.branch_id', $branch_id);
		$this->db->where('tbl_salon_customer.salon_id', $salon_id);
		$single = $this->db->get('tbl_salon_customer')->row();
		if(empty($single)){
			$is_gst_applicable = '0';
			$gst_rate = 0;

			$service_total = 0;
			$product_total = 0;  

			$setup = $this->Master_model->get_backend_setups();	
			if(!empty($setup)){
				$gst_rate = $setup->gst_rate;
			}
			$is_gst_applicable = $single->is_gst_applicable == '1' ? '1' : '0';
			$gst_no = $is_gst_applicable == '1' ? ($single->gst_no != "" ? $single->gst_no : '') : '';
			
			if($is_gst_applicable == '0'){
				$gst_rate = 0;
			}

			foreach ($services_data as $service) {
				$added_from = $service['added_from'];
				$service_total += $added_from == '0' && $service['price'] != "" ? (float)$service['price'] : 0.00;
			}

			if(!empty($products_data)){
				foreach ($products_data as $product) {
					$added_from = $product['added_from'];
					$product_total += $added_from == '0' && $product['price'] != "" ? (float)$product['price'] : 0.00;
				}
			}

			$is_offer_applied      = '0';
			$is_coupon_applied     = '0';
			$is_giftcard_applied   = '0';
			
			// Apply Automated Services Start
			$marketing_service_discount_data = $this->apply_services_automated_discounts($customer_id, $services_data, $branch_id, $salon_id);
			$marketing_service_discount = !empty($marketing_service_discount_data) && isset($marketing_service_discount_data['marketing_service_discount']) ? $marketing_service_discount_data['marketing_service_discount'] : 0.00;
			$is_automated_service_discount_applied = !empty($marketing_service_discount_data) && isset($marketing_service_discount_data['is_automated_service_discount_applied']) ? $marketing_service_discount_data['is_automated_service_discount_applied'] : '0';
			$automated_service_discount_type = !empty($marketing_service_discount_data) && isset($marketing_service_discount_data['automated_discount_type']) ? $marketing_service_discount_data['automated_discount_type'] : null;
			$is_automated_service_discount_applied = $is_automated_service_discount_applied == '1' ? ($automated_service_discount_type == '0' ? '1' : '0') : $is_automated_service_discount_applied;
			// Apply Automated Services End
			
			// Apply Automated Products Start
			$marketing_product_discount_data = $this->apply_products_automated_discounts($customer_id, $products_data, $branch_id, $salon_id);
			$marketing_product_discount = !empty($marketing_product_discount_data) && isset($marketing_product_discount_data['marketing_product_discount']) ? $marketing_product_discount_data['marketing_product_discount'] : 0.00;
			$is_automated_product_discount_applied = !empty($marketing_product_discount_data) && isset($marketing_product_discount_data['is_automated_product_discount_applied']) ? $marketing_product_discount_data['is_automated_product_discount_applied'] : '0';
			// Apply Automated Products End
						
			// Apply Membership Start
			$membership_data = $this->apply_membership($customer_id, $services_data, $products_data, $branch_id, $salon_id, $selected_membership_details);
			$membership_service_discount = !empty($membership_data) && isset($membership_data['membership_service_discount']) ? $membership_data['membership_service_discount'] : 0.00;
			$membership_product_discount = !empty($membership_data) && isset($membership_data['membership_product_discount']) ? $membership_data['membership_product_discount'] : 0.00;
			$membership_price = !empty($membership_data) && isset($membership_data['membership_price']) ? $membership_data['membership_price'] : 0.00;
			// Apply Membership End
			
			// Apply Package Start
			$package_data = $this->apply_package($customer_id, $branch_id, $salon_id, $selected_package_details);
			$package_price = !empty($package_data) && isset($package_data['package_price']) ? $package_data['package_price'] : 0.00;
			// Apply Package End

			// Apply Offer Start
			if ($is_automated_service_discount_applied == '0' && $is_automated_product_discount_applied == '0'){
				$offers_data = $this->apply_offer($customer_id, $single->gender, $service_ids, $services_data, $branch_id, $salon_id, $applied_offer_id);
				$total_offer_discount = !empty($offers_data) && isset($offers_data['total_offer_discount']) ? $offers_data['total_offer_discount'] : 0.00;
				$is_offer_applied = !empty($offers_data) && isset($offers_data['is_offer_applied']) ? $offers_data['is_offer_applied'] : '0';
			}
			// Apply Offer End
			
			// Apply Coupon Start
			if ($is_automated_service_discount_applied == '0' && $is_automated_product_discount_applied == '0' && $is_offer_applied == '0') {
				$coupon_data = $this->apply_coupon($customer_id, $single->gender, $service_ids, $services_data, $products_data, $branch_id, $salon_id, $applied_coupon_id);
				$coupon_discount = !empty($coupon_data) && isset($coupon_data['coupon_discount']) ? $coupon_data['coupon_discount'] : 0.00;
				$is_coupon_applied = !empty($coupon_data) && isset($coupon_data['is_coupon_applied']) ? $coupon_data['is_coupon_applied'] : '0';
			}
			// Apply Coupon End
			
			// Apply Giftcard Start
			if ($is_automated_service_discount_applied == '0' && $is_automated_product_discount_applied == '0' && $is_offer_applied == '0' && $is_coupon_applied == '0'){
				$giftcard_data = $this->apply_giftcard($customer_id, $single->gender, $services_data, $products_data, $branch_id, $salon_id, $applied_giftcard_no);
				$giftcard_discount = !empty($giftcard_data) && isset($giftcard_data['giftcard_discount']) ? $giftcard_data['giftcard_discount'] : 0.00;
				$is_giftcard_applied = !empty($giftcard_data) && isset($giftcard_data['is_giftcard_applied']) ? $giftcard_data['is_giftcard_applied'] : '0';
			}
			// Apply Giftcard End
			
			// Apply Rewards Start
			if ($is_automated_service_discount_applied == '0' && $is_automated_product_discount_applied == '0' && $is_offer_applied == '0' && $is_coupon_applied == '0' && $is_giftcard_applied == '0'){
				$rewards_data = $this->apply_reward($customer_id, $single->gender, $services_data, $products_data, $branch_id, $salon_id, $is_user_rewards_applied);
				$rewards_discount = !empty($rewards_data) && isset($rewards_data['rewards_discount']) ? $rewards_data['rewards_discount'] : 0.00;
			}
			// Apply Rewards End

			$total = $service_total + $product_total + $membership_price + $package_price;

			$membership_discount = $membership_service_discount + $membership_product_discount;
			$marketing_discount = $marketing_service_discount + $marketing_product_discount;
			
			$total_discount = $membership_discount + $rewards_discount + $giftcard_discount + $coupon_discount + $marketing_discount + $total_offer_discount;
			
			$sub_total = $total - $total_discount;
			$sub_total = $sub_total >= 0 ? $sub_total : 0.00;

			$gst_amount = $is_gst_applicable == '1' ? ((float)$sub_total * (float)$gst_rate) : 0.00;
			$grand_total = $sub_total + $gst_amount;

			$return_data = array(
				'service_total'     => $service_total, 
				'product_total'     => $product_total, 
				'membership_price'  => $membership_price, 
				'package_price'     => $package_price, 
				'total'             => $total, 
				'total_discount'    => $total_discount,
				'sub_total'         => $sub_total,
				'gst_amount'        => $gst_amount,
				'grand_total'       => $grand_total,
				'gst_data'       	=> array(
											'is_gst_applicable' =>  $is_gst_applicable,
											'gst_rate'          =>  $gst_rate,
											'gst_no'            =>  $gst_no
										),
				'discount_details'  => array(       
											'membership_data'           		=> $membership_data,     
											'marketing_service_discount_data'   => $marketing_service_discount_data,     
											'marketing_product_discount_data'   => $marketing_product_discount_data,    
											'offers_data'               		=> $offers_data,     
											'giftcard_data'             		=> $giftcard_data,       
											'coupon_data'               		=> $coupon_data,          
											'rewards_data'              		=> $rewards_data      
										),
				'package_details'	=> $package_data	
			);
		}

		return $return_data;
	}

	public function apply_services_automated_discounts($customer_id, $services_data, $branch_id, $salon_id){	
		$final_is_automated_service_discount_applied = '0';
		$automated_discount_type = null;
		$marketing_service_discount = 0;
		$marketing_service_rewards = 0;
		$final_discount_head_text = null;
		$final_discount_subhead_text = null;
		$final_customer_criteria = null;
		$final_discount_row_id = null;
		$final_discount_in = null;
		$final_discount_type = null;
		$final_discount_amount_value = null;
		$marketing_service_discount_data = array();  
		$services_discount_data = array();

		foreach ($services_data as $service) {
			$service_price = $service['price'] != "" ? (float)$service['price'] : 0.00;
			$added_from = $service['added_from'];
													
			$service_discount_rewards_type = '';
			$discount_in = '';
			$discount_type = '';
			$discount_amount_value = '';
			$discount_row_id = '';
			$customer_criteria = '';
			$is_discount_applied = '0';

			$discount_amount = 0;
			$slab_increment = '5';
			$slab_consider = '';
			$min_slab = '';
			$max_slab = '';

			$rewards_discount_amount = 0;
			$rewards_slab_increment = '5';
			$rewards_slab_consider = '';
			$rewards_min_slab = '';
			$rewards_max_slab = '';

			$service_applied_discount = $this->Salon_model->get_customer_service_applied_discount($customer_id,$service['id']);
			if($service_applied_discount['is_discount_applied'] == '1' && $added_from == '0'){
				$is_discount_applied = '1';
				$customer_criteria = $service_applied_discount['customer_criteria'];
				$discount_type = $service_applied_discount['discount_type'];
				$discount_in = $service_applied_discount['discount_in'];
				$discount_amount_value = (float)$service_applied_discount['discount_amount'];
				$min_slab = $service_applied_discount['min_flexible'];
				$max_slab = $service_applied_discount['max_flexible'];
				if($discount_type == '1'){    //Flexible
					$customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($customer_id,$service['id']);
					if(!empty($customer_last_service_booking)){                                                   
						if($customer_criteria == '1'){                             
							$prev_Applied_slab = $customer_last_service_booking->rewards_applied_flexible_slab;
						}else{
							$prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;
						}   

						if($prev_Applied_slab != ""){
							$next_slab = $prev_Applied_slab + $slab_increment;
						}else{
							$next_slab = $min_slab + $slab_increment;
						}

						if($next_slab > $max_slab){
							$slab_consider = $min_slab;
						}else{
							$slab_consider = $next_slab;
						}
					}else{
						$slab_consider = $min_slab;
					}

					if($discount_in == '0'){  //percentage
						$discount_amount = ((float)$slab_consider * (float)$service_price) / 100;
						$discount_text = $slab_consider . '% Off';
					}elseif($discount_in == '1'){ //flat
						$discount_amount = (float)$slab_consider;
						$discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
					}
				}elseif($discount_type == '0'){   //Fixed
					if($discount_in == '0'){  //percentage
						$discount_amount = ((float)$discount_amount_value * (float)$service_price) / 100;
						$discount_text = $discount_amount_value . '% Off';
					}elseif($discount_in == '1'){ //flat
						$discount_amount = (float)$discount_amount_value;
						$discount_text = 'Flat Rs. ' . $discount_amount_value . ' Off';
					}
				}

				$rewards_text = 'Earn ' . $discount_amount . ' Reward Points';
			}

			$discount_head_text = null;
			$discount_subhead_text = null;
			if($is_discount_applied == '1'){
				if($customer_criteria == '1'){  //for regular customer rewards are given
					$rewards_discount_amount = $discount_amount;
					$rewards_slab_increment = $slab_increment;
					$rewards_slab_consider = $slab_consider;
					$rewards_min_slab = $min_slab;
					$rewards_max_slab = $max_slab;

					$discount_amount = 0;
					$slab_increment = '5';
					$slab_consider = '';
					$min_slab = '';
					$max_slab = '';

					$service_discount_rewards_type = '1';   // rewards
					$discount_subhead_text = $rewards_text;
				}else{                                    
					$service_discount_rewards_type = '0';   // discount
					$discount_subhead_text = $discount_text;
				}
				
				if($customer_criteria == '0'){
					$discount_head_text = 'New Client Benefits Applied';
				}elseif($customer_criteria == '1'){
					$discount_head_text = 'Regular Client Benefits Applied';
				}elseif($customer_criteria == '2'){
					$discount_head_text = 'Lost Client Benefits Applied';
				}elseif($customer_criteria == '3'){
					$discount_head_text = 'Birthday Benefits Applied';
				}elseif($customer_criteria == '4'){
					$discount_head_text = 'Anniversary Benefits Applied';
				}elseif($customer_criteria == '5'){
					$discount_head_text = 'Products Marketing Benefits Applied';
				}

				$automated_discount_type = $final_is_automated_service_discount_applied == '0' ? $service_discount_rewards_type : $automated_discount_type;
				$final_discount_head_text = $final_is_automated_service_discount_applied == '0' ? $discount_head_text : $final_discount_head_text;
				$final_discount_subhead_text = $final_is_automated_service_discount_applied == '0' ? $discount_subhead_text : $final_discount_subhead_text;
				
				$final_customer_criteria = $final_is_automated_service_discount_applied == '0' ? $customer_criteria : $final_customer_criteria;
				$final_discount_row_id = $final_is_automated_service_discount_applied == '0' ? $discount_row_id : $final_discount_row_id;
				$final_discount_in = $final_is_automated_service_discount_applied == '0' ? $discount_in : $final_discount_in;
				$final_discount_type = $final_is_automated_service_discount_applied == '0' ? $discount_type : $final_discount_type;
				$final_discount_amount_value = $final_is_automated_service_discount_applied == '0' ? $discount_amount_value : $final_discount_amount_value;

				$final_is_automated_service_discount_applied = $final_is_automated_service_discount_applied == '0' ? '1' : $final_is_automated_service_discount_applied;
			}
			
			$services_discount_data[] = array(
				'service_id'			=>	$service['id'],
				'is_discount_applied'	=>	$is_discount_applied,

				'original_price'		=>	$service_price,
				'final_amount'			=>	$service_price - $discount_amount,
				'discount_head_text'	=>	$discount_head_text,
				'discount_subhead_text'	=>	$discount_subhead_text,

				'service_discount_rewards_type'		=>	$service_discount_rewards_type,
				'customer_criteria'		=>	$customer_criteria,
				'discount_row_id'		=>	$discount_row_id,
				'discount_in'			=>	$discount_in,
				'discount_type'			=>	$discount_type,
				'discount_amount_value'	=>	$discount_amount_value,

				'discount_amount'		=>	$discount_amount,
				'slab_increment'		=>	$slab_increment,
				'slab_consider'			=>	$slab_consider,
				'min_slab'				=>	$min_slab,
				'max_slab'				=>	$max_slab,

				'rewards_discount_amount'			=>	$rewards_discount_amount,
				'rewards_slab_increment'			=>	$rewards_slab_increment,
				'rewards_slab_consider'				=>	$rewards_slab_consider,
				'rewards_min_slab'					=>	$rewards_min_slab,
				'rewards_max_slab'					=>	$rewards_max_slab
			);

			$marketing_service_discount += $discount_amount;
			$marketing_service_rewards += $rewards_discount_amount;
		}

		$marketing_service_discount_data = array(
			'is_automated_service_discount_applied'	=>	$final_is_automated_service_discount_applied,
			'automated_discount_type'				=>	$automated_discount_type,
			'marketing_service_discount'			=>	$marketing_service_discount,
			'marketing_service_rewards'				=>	$marketing_service_rewards,
			'discount_head_text'					=>	$final_discount_head_text,
			'discount_subhead_text'					=>	$final_discount_subhead_text,
			'customer_criteria'						=>	$final_customer_criteria,
			'discount_row_id'						=>	$final_discount_row_id,
			'discount_in'							=>	$final_discount_in,
			'discount_type'							=>	$final_discount_type,
			'discount_amount_value'					=>	$final_discount_amount_value,
			'services_discount_data'				=>	$services_discount_data,
		);

		return $marketing_service_discount_data;
	}

	public function apply_products_automated_discounts($customer_id, $products_data, $branch_id, $salon_id){	
		$final_is_automated_product_discount_applied = '0';
		$marketing_product_discount = 0;
		$final_discount_head_text = null;
		$final_discount_subhead_text = null;
		$final_discount_row_id = null;
		$final_discount_in = null;
		$final_discount_type = null;
		$final_discount_amount_value = null;
		$marketing_product_discount_data = array();  
		$products_discount_data = array();  
		
		if(!empty($products_data)){
			foreach($products_data as $product){  
				$added_from = $product['added_from'];
				$this->db->where('id',$product['id']);
        		$this->db->where('is_deleted', '0');
				$products_result = $this->db->get('tbl_product')->row();
				if(!empty($products_result) && $added_from == '0'){
					$discount_in = $products_result->discount_in;
					$discount = $products_result->discount != "" ? (float)$products_result->discount : 0;
					$selling_price = $products_result->selling_price != "" ? (float)$products_result->selling_price : 0.00;
					if($discount_in == '0'){
						$selling_price = $selling_price - ($selling_price * $discount) / 100;
					}elseif($discount_in == '1'){
						$selling_price = $selling_price - $discount;
					}else{
						$selling_price = $selling_price;
					}                                                        
			
					$product_discount_in = '';
					$product_discount_type = '';
					$product_discount_amount_value = '';
					$product_discount_row_id = '';
					$is_product_discount_applied = '0';

					$product_discount_amount = 0;
					$product_slab_increment = '5';
					$product_slab_consider = '';
					$product_min_slab = '';
					$product_max_slab = '';
					
					$discount_head_text = null;
					$discount_subhead_text = null;

					$product_applied_discount = $this->Salon_model->get_customer_product_applied_discount($customer_id,$products_result->id);
					if($product_applied_discount['is_discount_applied'] == '1'){
						$is_product_discount_applied = '1';
						$product_discount_row_id = $product_applied_discount['discount_row_id'];
						$product_discount_type = $product_applied_discount['discount_type'];
						$product_discount_in = $product_applied_discount['discount_in'];
						$product_discount_amount_value = (float)$product_applied_discount['discount_amount'];
						$product_min_slab = $product_applied_discount['min_flexible'];
						$product_max_slab = $product_applied_discount['max_flexible'];
						if($product_discount_type == '1'){    //Flexible
							$customer_last_service_product_booking = $this->Salon_model->get_customer_last_service_product_booking($customer_id,$products_result->id);
							if(!empty($customer_last_service_product_booking)){      
								$prev_Applied_product_slab = $customer_last_service_product_booking->product_applied_flexible_slab;

								if($prev_Applied_product_slab != ""){
									$next_product_slab = $prev_Applied_product_slab + $product_slab_increment;
								}else{
									$next_product_slab = $product_min_slab + $product_slab_increment;
								}

								if($next_product_slab > $product_max_slab){
									$product_slab_consider = $product_min_slab;
								}else{
									$product_slab_consider = $next_product_slab;
								}
							}else{
								$product_slab_consider = $product_min_slab;
							}

							if($product_discount_in == '0'){  //percentage
								$product_discount_amount = ((float)$product_slab_consider * (float)$selling_price) / 100;
								$discount_subhead_text = $product_slab_consider . '% Off';
							}elseif($product_discount_in == '1'){ //flat
								$product_discount_amount = (float)$product_slab_consider;
								$discount_subhead_text = 'Flat Rs. ' . $product_slab_consider . ' Off';
							}
						}elseif($product_discount_type == '0'){   //Fixed
							if($product_discount_in == '0'){  //percentage
								$product_discount_amount = ((float)$product_discount_amount_value * (float)$selling_price) / 100;
								$discount_subhead_text = $product_discount_amount_value . '% Off';
							}elseif($product_discount_in == '1'){ //flat
								$product_discount_amount = (float)$product_discount_amount_value;
								$discount_subhead_text = 'Flat Rs. ' . $product_discount_amount_value . ' Off';
							}
						}

						$discount_head_text = 'Products Marketing Benefits Applied';

						$final_discount_head_text = $final_is_automated_product_discount_applied == '0' ? $discount_head_text : $final_discount_head_text;
						$final_discount_subhead_text = $final_is_automated_product_discount_applied == '0' ? $discount_subhead_text : $final_discount_subhead_text;
						
						$final_discount_row_id = $final_is_automated_product_discount_applied == '0' ? $product_discount_row_id : $final_discount_row_id;
						$final_discount_in = $final_is_automated_product_discount_applied == '0' ? $product_discount_in : $final_discount_in;
						$final_discount_type = $final_is_automated_product_discount_applied == '0' ? $product_discount_type : $final_discount_type;
						$final_discount_amount_value = $final_is_automated_product_discount_applied == '0' ? $product_discount_amount_value : $final_discount_amount_value;

						$final_is_automated_product_discount_applied = $final_is_automated_product_discount_applied == '0' ? '1' : $final_is_automated_product_discount_applied;
					}
			
					$products_discount_data[] = array(
						'product_id'			=>	$products_result->id,
						'is_discount_applied'	=>	$is_product_discount_applied,

						'original_price'		=>	$selling_price,
						'final_amount'			=>	$selling_price - $product_discount_amount,
						'discount_head_text'	=>	$discount_head_text,
						'discount_subhead_text'	=>	$discount_subhead_text,

						'customer_criteria'		=>	'5',
						'discount_row_id'		=>	$product_discount_row_id,
						'discount_in'			=>	$product_discount_in,
						'discount_type'			=>	$product_discount_type,
						'discount_amount_value'	=>	$product_discount_amount_value,

						'discount_amount'		=>	$product_discount_amount,
						'slab_increment'		=>	$product_slab_increment,
						'slab_consider'			=>	$product_slab_consider,
						'min_slab'				=>	$product_min_slab,
						'max_slab'				=>	$product_max_slab
					);

					$marketing_product_discount += $product_discount_amount;
				}
			}
		}

		$marketing_product_discount_data = array(
			'is_automated_product_discount_applied'	=>	$final_is_automated_product_discount_applied,
			'marketing_product_discount'			=>	$marketing_product_discount,
			'discount_head_text'					=>	$final_discount_head_text,
			'discount_subhead_text'					=>	$final_discount_subhead_text,
			
			'customer_criteria'						=>	$final_is_automated_product_discount_applied == '1' ? '5' : null,
			'discount_row_id'						=>	$final_discount_row_id,
			'discount_in'							=>	$final_discount_in,
			'discount_type'							=>	$final_discount_type,
			'discount_amount_value'					=>	$final_discount_amount_value,

			'products_discount_data'				=>	$products_discount_data,
		);

		return $marketing_product_discount_data;
	}

	public function apply_package($customer_id, $branch_id, $salon_id, $selected_package_details){
		$package_data = array();  

		if($selected_package_details != "" && is_array($selected_package_details) && !empty($selected_package_details)){
			$this->db->where('tbl_package.id',$selected_package_details['selected_package_id']);
			$this->db->where('tbl_package.branch_id',$branch_id);
			$this->db->where('tbl_package.salon_id',$salon_id);
			$this->db->where('tbl_package.is_deleted','0');
			$single_package_details = $this->db->get('tbl_package');
			$single_package_details = $single_package_details->row();
			if(!empty($single_package_details)){
				if($selected_package_details['is_old_package'] == '1'){					
					$this->db->select('tbl_customer_package_allocations.*, tbl_package.package_name, tbl_package.bg_color, tbl_package.text_color');
					$this->db->join('tbl_package', 'tbl_package.id = tbl_customer_package_allocations.package_id');
					$this->db->where('tbl_customer_package_allocations.id',$selected_package_details['selected_package_allocation_id']);
					$this->db->where('tbl_customer_package_allocations.package_id',$single_package_details->id);
					$this->db->where('tbl_customer_package_allocations.customer_name',$customer_id);
					$this->db->where('tbl_customer_package_allocations.is_deleted','0');
					$single_package = $this->db->get('tbl_customer_package_allocations');
					$single_package = $single_package->row();
					if(!empty($single_package)){
						$package_data = array(
							'is_package_applied' 			=>  '1',
							'is_old_package'				=>	'1',
							'package_id'     				=>  $single_package_details->id,
							'payment_status'				=>	$single_package->is_booking_done,
							'is_package_payment_included'	=>  $single_package->is_booking_done == '0' ? '1' : '0',
							'package_price'					=>	$single_package->is_booking_done == '0' ? $single_package->package_amount : 0.00,
							'package_allocation_id'			=>	$single_package->id
						);
					}
				}else{
					$package_data = array(
						'is_package_applied' 			=>  '1',
						'is_old_package'				=>	'0',
						'package_id'     				=>  $single_package_details->id,
						'payment_status'				=>	'0',
						'is_package_payment_included'	=>  '1',
						'package_price'					=>	$single_package_details->amount,
						'package_allocation_id'			=>	null
					);
				}
			}
		}

		return $package_data;
	}	

	public function apply_membership($customer_id, $services_data, $products_data, $branch_id, $salon_id, $selected_membership_details){
		$membership_data = array();  
		
		$total_service_amount = 0;
		foreach ($services_data as $service) {
			$added_from = $service['added_from'];
			$total_service_amount += $added_from == '0' && $service['price'] != "" ? (float)$service['price'] : 0.00;
		}

		$total_product_amount = 0;
		if(!empty($products_data)){
			foreach ($products_data as $product) {
				$added_from = $product['added_from'];
				$total_product_amount += $added_from == '0' && $product['price'] != "" ? (float)$product['price'] : 0.00;
			}
		}

		if($selected_membership_details != "" && is_array($selected_membership_details) && !empty($selected_membership_details)){
			if($selected_membership_details['is_old_member'] == '1'){
				$this->db->select('tbl_customer_membership_history.id, tbl_customer_membership_history.payment_status, tbl_customer_membership_history.membership_price, tbl_customer_membership_history.service_discount, tbl_customer_membership_history.discount_in, tbl_customer_membership_history.product_discount, tbl_customer_membership_history.membership_id as applied_membership_id, tbl_memebership.membership_name');
				$this->db->join('tbl_customer_membership_history', 'tbl_customer_membership_history.id = tbl_salon_customer.membership_pkey');
				$this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
				$this->db->where('tbl_salon_customer.is_deleted','0');
				$this->db->where('tbl_salon_customer.status','1');
				$this->db->where('tbl_salon_customer.id',$customer_id);
				$this->db->where('tbl_salon_customer.branch_id', $branch_id);
				$this->db->where('tbl_salon_customer.salon_id', $salon_id);
				$this->db->where('tbl_customer_membership_history.customer_id', $customer_id);
				$this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
				$this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
				$this->db->where('tbl_customer_membership_history.is_deleted','0');
				$this->db->where('tbl_customer_membership_history.membership_status','0');
				$this->db->where('tbl_customer_membership_history.payment_status','1');
				$membership_details = $this->db->get('tbl_salon_customer')->row();
				if(!empty($membership_details)){
					$membership_discount_type = $membership_details->discount_in;
					$membership_service_discount = $membership_details->service_discount;
					$membership_product_discount = $membership_details->product_discount;
					if($membership_discount_type == '0'){
						$membership_service_discount_amount = ($total_service_amount * $membership_service_discount) / 100;
						$membership_product_discount_amount = ($total_product_amount * $membership_product_discount) / 100;
						if(!empty($products_data)){
							$discount_subhead_text = $membership_service_discount . ' % off on all Services and Products';
						}else{					
							$discount_subhead_text = $membership_service_discount . ' % off on all Services';
						}
					}elseif($membership_discount_type == '1'){
						$membership_service_discount_amount = $membership_service_discount;
						$membership_product_discount_amount = $membership_product_discount;
						if(!empty($products_data)){
							$discount_subhead_text = 'Flat Rs. ' . $membership_service_discount . ' off on all Services and Products';
						}else{					
							$discount_subhead_text = 'Flat Rs. ' . $membership_service_discount . ' off on all Services';
						}
					}

					$membership_data = array(
						'is_membership_applied' 		=>  '1',
						'is_old_member'					=>	'1',
						'membership_id'     			=>  $membership_details->applied_membership_id,
						'discount_head_text'			=>	$membership_details->membership_name . ' Membership applied',
						'discount_subhead_text'			=>	$discount_subhead_text,
						'membership_service_discount'	=>	$membership_service_discount_amount,
						'membership_product_discount'	=>	$membership_product_discount_amount,
						'membership_service_discount_value'	=>	$membership_service_discount,
						'membership_product_discount_value'	=>	$membership_product_discount,
						'membership_discount_type'			=>	$membership_discount_type,
						'payment_status'				=>	$membership_details->payment_status,
						'membership_allocation_id'		=>	$membership_details->id,
						'is_membership_payment_included'=>  $membership_details->payment_status == '0' ? '1' : '0',
						'membership_price'				=>	$membership_details->payment_status == '0' ? $membership_details->membership_price : 0.00
					);
				}
			}else{
				$this->db->where('is_deleted','0');
				$this->db->where('status','1');
				$this->db->where('id',$selected_membership_details['membership_id']);
				$this->db->where('branch_id', $branch_id);
				$this->db->where('salon_id', $salon_id);
				$membership_details = $this->db->get('tbl_memebership')->row();
				if(!empty($membership_details)){ 
					$membership_discount_type = $membership_details->discount_in;
					$membership_service_discount = $membership_details->service_discount;
					$membership_product_discount = $membership_details->product_discount;
					if($membership_discount_type == '0'){
						$membership_service_discount_amount = ($total_service_amount * $membership_service_discount) / 100;
						$membership_product_discount_amount = ($total_product_amount * $membership_product_discount) / 100;
						if(!empty($products_data)){
							$discount_subhead_text = $membership_service_discount . ' % off on all Services and Products';
						}else{					
							$discount_subhead_text = $membership_service_discount . ' % off on all Services';
						}
					}elseif($membership_discount_type == '1'){
						$membership_service_discount_amount = $membership_service_discount;
						$membership_product_discount_amount = $membership_product_discount;
						if(!empty($products_data)){
							$discount_subhead_text = 'Flat Rs. ' . $membership_service_discount . ' off on all Services and Products';
						}else{					
							$discount_subhead_text = 'Flat Rs. ' . $membership_service_discount . ' off on all Services';
						}
					}

					$membership_data = array(
						'is_membership_applied' 		=>  '1',
						'is_old_member'					=>	'0',
						'membership_id'     			=>  $membership_details->applied_membership_id,
						'discount_head_text'			=>	$membership_details->membership_name . ' Membership applied',
						'discount_subhead_text'			=>	$discount_subhead_text,
						'membership_service_discount'	=>	$membership_service_discount_amount,
						'membership_product_discount'	=>	$membership_product_discount_amount,
						'membership_service_discount_value'	=>	$membership_service_discount,
						'membership_product_discount_value'	=>	$membership_product_discount,
						'membership_discount_type'			=>	$membership_discount_type,
						'payment_status'				=>	'0',
						'membership_allocation_id'		=>	null,
						'is_membership_payment_included'=>  '1',
						'membership_price'				=>	$membership_details->membership_price
					);
				}
			}
		}

		return $membership_data;
	}

	public function apply_offer($customer_id, $gender, $service_ids, $services_data, $branch_id, $salon_id, $applied_offer_id){
		$total_offer_discount = 0;
		$offers_data = array();  
		$is_final_offer_applied = '0';

		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('validity_status','1');
		$this->db->where('id',$applied_offer_id);
		$this->db->where('gender',$gender);
		$this->db->where('branch_id', $branch_id);
		$this->db->where('salon_id', $salon_id);
		$offer_data = $this->db->get('tbl_offers')->row();
		if(!empty($offer_data)){
			$offer_services_data = [];

			$service_offer_discount = $offer_data->discount;
			$service_offer_discount_type = $offer_data->discount_in;
			if($service_offer_discount_type == '0'){
				$discount_text = $service_offer_discount . '% Off';
			}elseif($service_offer_discount_type == '1'){
				$discount_text = 'Flat Rs.' . $service_offer_discount . ' Off';
			}else{
				$discount_text = '';
			}

			$offer_services = $offer_data->service_name != "" ? explode(',',$offer_data->service_name) : [];

			$diff = array_diff($offer_services, $service_ids);
			if (empty($diff)) {
				$is_final_offer_applied = '1';
			}
			
			for($i=0;$i<count($services_data);$i++){
				$added_from = $services_data[$i]['added_from'];
				if($added_from == '0'){
					$is_offer_applied = '0';
					$service_offer_discount_amount = 0;
					if ($is_final_offer_applied == '1' && in_array($services_data[$i]['id'], $offer_services)) {
						if($service_offer_discount_type == '0'){
							$service_offer_discount_amount = ($services_data[$i]['price'] * $service_offer_discount) / 100;
						}elseif($service_offer_discount_type == '1'){
							$service_offer_discount_amount = $service_offer_discount;
						}
						$is_offer_applied = '1';
					}
					$offer_services_data[] = array(
						'service_id'        =>  $services_data[$i]['id'],
						'is_offer_applied'  =>  $is_final_offer_applied == '1' ? $is_offer_applied : '0',
						'price'             =>  $services_data[$i]['price'],
						'discount'          =>  $is_final_offer_applied == '1' ? $service_offer_discount_amount : 0,
						'final_price'       =>  $services_data[$i]['price'] - ($is_final_offer_applied == '1' ? $service_offer_discount_amount : 0),
						'discount_text'     =>  $is_final_offer_applied == '1' ? $discount_text : ''
					);
					$total_offer_discount += ($is_final_offer_applied == '1' ? $service_offer_discount_amount : 0);
				}
			}                  

			$discount_subhead_text = null;
			if ($is_final_offer_applied == '1') {
				$discount_head_text = $offer_data->offers_name . ' offer applied.';
				$discount_subhead_text = $discount_text;
			} else {
				$discount_head_text = $offer_data->offers_name . ' offer not eligible.';

				$missing_service_names = [];
				$missing_count = count($diff);

				if ($missing_count > 0) {
					$this->db->select('service_name');
					$this->db->from('tbl_salon_emp_service');
					$this->db->where_in('id', $diff);
					$this->db->where('is_deleted', '0');
					$this->db->where('branch_id', $branch_id);
					$this->db->where('salon_id', $salon_id);
					$missing_services = $this->db->get()->result();

					foreach ($missing_services as $ms) {
						$missing_service_names[] = $ms->service_name;
					}

					$discount_subhead_text = 'Add ' . $missing_count . ' more ' . ($missing_count > 1 ? 'services' : 'service') .
										' to unlock ' . $offer_data->offers_name . ': ' .
										implode(', ', $missing_service_names) . '.';
				}
			}

			$offers_data = array(
				'is_offer_applied'      =>  $is_final_offer_applied,
				'offer_id'              =>  $offer_data->id,
				'discount_head_text'    =>  $discount_head_text,
				'discount_subhead_text' =>  $discount_subhead_text,
				'total_offer_discount' 	=>  $is_final_offer_applied == '1' ? $total_offer_discount : 0,
				'service_offer_discount_value' 	=>  $is_final_offer_applied == '1' ? $service_offer_discount : 0,
				'service_offer_discount_type' 	=>  $is_final_offer_applied == '1' ? $service_offer_discount_type : 0,
				'offer_services_data'   =>  $offer_services_data
			);    
		} 

		return $offers_data;
	}

	public function apply_coupon($customer_id, $gender, $service_ids, $services_data, $products_data, $branch_id, $salon_id, $applied_coupon_id){
		$coupon_data = array();  

		$this->db->where('id',$applied_coupon_id);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('salon_id',$salon_id);
		$this->db->where('gender',$gender);
		$this->db->where('is_deleted','0');
		$this->db->where('DATE(coupan_expiry) >=',date('Y-m-d'));
		$single_coupon_details = $this->db->get('tbl_coupon_code');
		$single_coupon_details = $single_coupon_details->row();
		if(!empty($single_coupon_details)){
			$discount = $single_coupon_details->coupon_offers != "" ? (float)$single_coupon_details->coupon_offers : 0.00;
			$min_price = $single_coupon_details->min_price != "" ? (float)$single_coupon_details->min_price : 0.00;

			$total_service_amount = 0;
			foreach ($services_data as $service) {
				$added_from = $service['added_from'];
				$total_service_amount += $added_from == '0' && $service['price'] != "" ? (float)$service['price'] : 0.00;
			}

			$total_product_amount = 0;
			if(!empty($products_data)){
				foreach ($products_data as $product) {
					$added_from = $product['added_from'];
					$total_product_amount += $added_from == '0' && $product['price'] != "" ? (float)$product['price'] : 0.00;
				}
			}

			$total = $total_service_amount + $total_product_amount;

			if($total >= $min_price){
				$is_coupon_applied = '1';
				$discount_head_text = $single_coupon_details->coupon_name . ' Coupon applied';
				$discount_subhead_text = 'Flat Rs. ' . $discount . ' off';
			}else{
				$is_coupon_applied = '0';
				$discount_head_text = 'Requires Minimum amount of Rs. ' . $min_price;
				$discount_subhead_text = '';
			}

			$coupon_data = array(
				'is_coupon_applied'     =>  $is_coupon_applied,
				'coupon_id'             =>  $single_coupon_details->id,
				'coupon_discount' 		=>  $is_coupon_applied == '1' ? $discount : 0,
				'discount_head_text'    =>  $discount_head_text,
				'discount_subhead_text' =>  $is_coupon_applied == '1' ? $discount_subhead_text : null,
			);   
		} 

		return $coupon_data;
	}

	public function apply_reward($customer_id, $gender, $services_data, $products_data, $branch_id, $salon_id, $is_user_rewards_applied){
		$rewards_data = array();  
		$is_rewards_applied = '0';

		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$this->db->where('id',$customer_id);
		$this->db->where('gender',$gender);
		$this->db->where('branch_id', $branch_id);
		$this->db->where('salon_id', $salon_id);
		$this->db->where('CAST(rewards_balance AS DECIMAL(10,2)) >', 0);
		$single = $this->db->get('tbl_salon_customer')->row();
		if(!empty($single) && $is_user_rewards_applied == '1'){     
			$total_service_amount = 0;
			foreach ($services_data as $service) {
				$added_from = $service['added_from'];
				$total_service_amount += $added_from == '0' && $service['price'] != "" ? (float)$service['price'] : 0.00;
			}

			$total_product_amount = 0;
			if(!empty($products_data)){
				foreach ($products_data as $product) {
					$added_from = $product['added_from'];
					$total_product_amount += $added_from == '0' && $product['price'] != "" ? (float)$product['price'] : 0.00;
				}
			}

			$total = $total_service_amount + $total_product_amount;

			$this->db->select('tbl_reward_point.*');		
			$this->db->where('tbl_reward_point.gender',$gender);
			$this->db->where('tbl_reward_point.is_deleted','0');
			$this->db->where('tbl_reward_point.status','1');
			$this->db->where('tbl_reward_point.branch_id',$branch_id);
			$this->db->where('tbl_reward_point.salon_id',$salon_id);
			$result = $this->db->get('tbl_reward_point');
			$rewards_result = $result->row();

			$rs_per_reward = !empty($rewards_result) ? $rewards_result->rs_per_reward : 0.00;
			$reward_point = !empty($rewards_result) ? $rewards_result->reward_point : 0.00;
			$minimum_reward_required = !empty($rewards_result) ? (int)$rewards_result->minimum_reward_required : 0.00;
			$maximum_reward_required = !empty($rewards_result) ? $rewards_result->maximum_reward_required : 0.00;

			$customer_reward_available = $single->rewards_balance != "" ? (float)$single->rewards_balance : 0.00;
			if($customer_reward_available >= $minimum_reward_required){
				if($customer_reward_available > $maximum_reward_required){
					$available_rewards = $maximum_reward_required;
				}else{
					$available_rewards = $customer_reward_available;
				}

				$consider_rewards = $available_rewards / $reward_point;
				$total_value = $consider_rewards * $rs_per_reward;

				$is_rewards_applied = '1';
				$rewards_discount = $total_value;
				$discount_head_text = $available_rewards .' Rewards applied';
				$discount_subhead_text = 'Flat Rs. ' . $total_value . ' off applied';
			}else{
				$is_rewards_applied = '0';
				$rewards_discount = 0.00;
				$consider_rewards = 0;
				$discount_head_text = 'Requires Minimum ' . $minimum_reward_required .' Reward Points';
				$discount_subhead_text = null;
			}

			$rewards_data = array(
				'is_rewards_applied'	=>	$is_rewards_applied,
				'rewards_discount'      =>  $rewards_discount,
				'discount_head_text'    =>  $discount_head_text,
				'discount_subhead_text' =>  $discount_subhead_text,
				'used_rewards'			=>	$consider_rewards
			);
		}

		return $rewards_data;
	}

	public function apply_giftcard($customer_id, $gender, $services_data, $products_data, $branch_id, $salon_id, $applied_giftcard_no){
		$giftcard_data = array();  
		$is_giftcard_applied = '0';
		$is_new_giftcard_applied = '0';
                    
		$this->db->select('tbl_booking_payment_entry.*, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
		$this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
		$this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
		$this->db->where('tbl_gift_card.gender',$gender);
		$this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
		$this->db->where('tbl_booking_payment_entry.giftcard_customer_uid',$applied_giftcard_no);
		$this->db->where('tbl_booking_payment_entry.is_deleted','0');
		$this->db->where('tbl_booking_payment_entry.gift_card_status','0');
		$this->db->where('tbl_booking_payment_entry.type','3');
		$result = $this->db->get('tbl_booking_payment_entry')->row();

		if(!empty($result)){
			$gift_card_balance = $result->gift_card_balance != "" ? $result->gift_card_balance : 0.00;
			$gift_card_price = $result->gift_card_price != "" ? $result->gift_card_price : 0.00;
			$min_amount = $result->giftcard_min_amount != "" ? $result->giftcard_min_amount : 0.00;
			$giftcard_redemption_id = $result->id;                        
			$giftcard_id = $result->giftcard_id;
			$giftcard_owner_id = $result->customer_id;
			$is_giftcard_applied = '1';
			
			$total_service_amount = 0;
			foreach ($services_data as $service) {
				$added_from = $service['added_from'];
				$total_service_amount += $added_from == '0' && $service['price'] != "" ? (float)$service['price'] : 0.00;
			}

			$total_product_amount = 0;
			if(!empty($products_data)){
				foreach ($products_data as $product) {
					$added_from = $product['added_from'];
					$total_product_amount += $added_from == '0' && $product['price'] != "" ? (float)$product['price'] : 0.00;
				}
			}

			$total = $total_service_amount + $total_product_amount;

			if($total >= $min_amount){
				$is_giftcard_applied = '1';
				$giftcard_discount = $total >= $gift_card_balance ? $gift_card_balance : $total;
				$discount_head_text = 'Giftcard applied';
				$discount_subhead_text = 'Flat Rs. ' . $giftcard_discount . ' off';
				$is_new_giftcard_applied = $gift_card_price == $gift_card_balance ? '1' : '0';
			}else{
				$is_giftcard_applied = '0';
				$giftcard_discount = 0.00;
				$discount_head_text = 'Requires Minimum amount of Rs. ' . $min_amount;
				$discount_subhead_text = null;
				$is_new_giftcard_applied = '0';
			}

		}

		$giftcard_data = array(
			'is_giftcard_applied'		=>	$is_giftcard_applied,
			'is_new_giftcard_applied'	=>	$is_new_giftcard_applied,
			'discount_head_text'		=>	$discount_head_text,
			'discount_subhead_text'		=>	$discount_subhead_text,
			'giftcard_discount'  		=>  $giftcard_discount,
			'giftcard_id'              	=>  $is_giftcard_applied == '1' ? $giftcard_id : null,
			'giftcard_redemption_id'    =>  $is_giftcard_applied == '1' ? $giftcard_redemption_id : null,
			'giftcard_owner_id'         =>  $is_giftcard_applied == '1' ? $giftcard_owner_id : null
		);

		return $giftcard_data;
	}
}
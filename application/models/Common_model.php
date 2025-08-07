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
}
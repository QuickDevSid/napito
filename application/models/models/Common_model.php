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
}
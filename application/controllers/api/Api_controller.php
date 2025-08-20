<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @OA\Info(
 *     title="Napito Salon Management API",
 *     version="1.0.0",
 *     description="Comprehensive API for salon management operations",
 *     @OA\Contact(
 *         email="support@napito.com",
 *         name="API Support"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://127.0.0.1/saloon/napito/api/v1",
 *     description="Development server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class Api_controller extends CI_Controller {
    
    /**
     * @OA\Post(
     *     path="/api/v1/api/customer_login",
     *     summary="Customer Login",
     *     description="Authenticate customer and return access token",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone","password"},
     *             @OA\Property(property="phone", type="string", example="9876543210"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="phone", type="string", example="9876543210")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials"
     *     )
     * )
     */
    public function customer_login(){
        $this->Api_model->customer_login_new();
    }
    public function set_fcm_token(){
        $this->Api_model->set_fcm_token();
    }
    public function get_customer_profile(){
        $this->Api_model->get_customer_profile();
    }
    public function update_customer_profile(){
        $this->Api_model->update_customer_profile();
    }
    public function get_store_details(){
        $this->Api_model->get_store_details();
    }
    public function set_store(){
        $this->Api_model->set_store();
    }
    public function set_new_store(){
        $this->Api_model->set_new_store();
    }
    public function booking_calculations(){
        $this->Api_model->booking_calculations();
    }
    public function get_store_genders(){
        $this->Api_model->get_store_genders();
    }
    public function get_customer_stores(){
        $this->Api_model->get_customer_stores();
    }
    public function login_otp(){
        $this->Api_model->login_otp();
    }
    public function get_store_profile(){
        $this->Api_model->get_store_profile();
    }
    public function get_store_employees(){
        $this->Api_model->get_store_employees();
    }
    public function get_store_about_us(){
        $this->Api_model->get_store_about_us();
    }
    public function get_store_gallary(){
        $this->Api_model->get_store_gallary();
    }
    public function get_store_tips(){
        $this->Api_model->get_store_tips();
    }
    public function get_privacy_policy(){
        $this->Api_model->get_privacy_policy_terms('0');
    }
    public function get_terms_conditions(){
        $this->Api_model->get_privacy_policy_terms('1');
    }
    public function get_banner(){
        $this->Api_model->get_banner();
    }
    public function get_catlogue(){
        $this->Api_model->get_catlogue();
    }
    public function get_store_facility(){
        $this->Api_model->get_store_facility();
    }
    public function get_store_packages(){
        $this->Api_model->get_store_packages();
    }
    public function get_customer_packages(){
        $this->Api_model->get_customer_packages();
    }
    public function get_customer_notifications(){
        $this->Api_model->get_customer_notifications();
    }
    public function get_customer_giftcards(){
        $this->Api_model->get_customer_giftcards();
    }
    public function get_store_memberships(){
        $this->Api_model->get_store_memberships();
    }
    public function get_store_offers(){
        $this->Api_model->get_store_offers();
    }
    public function get_store_coupons(){
        $this->Api_model->get_store_coupons();
    }
    public function apply_offer(){
        $this->Api_model->apply_offer();
    }
    public function apply_rewards(){
        $this->Api_model->apply_rewards();
    }
    public function reschedule_appointment(){
        $this->Api_model->reschedule_appointment();
    }
    public function get_store_services(){
        $this->Api_model->get_store_services();
    }
    public function get_store_special_services(){
        $this->Api_model->get_store_special_services();
    }
    public function get_booking_services(){
        $this->Api_model->get_booking_services();
    }
    public function get_store_service_products(){
        $this->Api_model->get_store_service_products();
    }
    public function get_store_service_category(){
        $this->Api_model->get_store_service_category();
    }
    public function get_store_product_category(){
        $this->Api_model->get_store_product_category();
    }
    public function get_help_types(){
        $this->Api_model->get_help_types();
    }
    public function get_user_queries(){
        $this->Api_model->get_user_queries();
    }
    public function get_user_single_query(){
        $this->Api_model->get_user_single_query();
    }
    public function insert_user_query(){
        $this->Api_model->insert_user_query();
    }
    public function get_user_single_query_replays(){
        $this->Api_model->get_user_single_query_replays();
    }
    public function insert_user_query_replay(){
        $this->Api_model->insert_user_query_replay();
    }
    public function get_booking_rules(){
        $this->Api_model->get_booking_rules();
    }
    public function get_available_timeslots(){
        $this->Api_model->get_available_timeslots();
    }
    public function get_available_reschedule_timeslots(){
        $this->Api_model->get_available_reschedule_timeslots();
    }
    public function get_selected_reschedule_service_stylists(){
        $this->Api_model->get_selected_reschedule_service_stylists();
    }
    public function get_reschedule_stylist_selection_page_flag(){
        $this->Api_model->get_reschedule_stylist_selection_page_flag();
    }
    public function get_selected_stylists(){
        $this->Api_model->get_selected_stylists();
    }
    public function get_selected_service_stylists(){
        $this->Api_model->get_selected_service_stylists();
    }
    public function get_booking_stylists_review(){
        $this->Api_model->get_booking_stylists_review();
    }
    public function get_reschedule_stylists_review(){
        $this->Api_model->get_reschedule_stylists_review();
    }
    public function get_store_socials(){
        $this->Api_model->get_store_socials();
    }
    public function booking_dates(){
        $this->Api_model->booking_dates();
    }
    public function get_customer_membership(){
        $this->Api_model->get_customer_membership();
    }
    public function set_booking(){
        $request = json_decode(file_get_contents('php://input'), true);
        if(!empty($request) && isset($request['branch_id'])){
            if($request['branch_id'] == 1){
                $this->Api_model->set_booking_new();
            }else{            
                $this->Api_model->set_booking();
            }
        }
    }   
    public function buy_membership(){
        $this->Api_model->buy_membership();
    }
    public function buy_packages(){
        $this->Api_model->buy_packages();
    }
    public function buy_giftcard(){
        $this->Api_model->buy_giftcard();
    }
    public function pending_bookings(){
        $this->Api_model->pending_bookings();
    }
    public function booking_details(){
        $this->Api_model->booking_details();
    }
    public function cancelled_bookings(){
        $this->Api_model->cancelled_bookings();
    }
    public function completed_bookings(){
        $this->Api_model->completed_bookings();
    }
    public function cancel_service(){
        $this->Api_model->cancel_service();
    }
    public function set_booking_reminder(){
        $this->Api_model->set_booking_reminder();
    }
    public function get_giftcard_details(){
        $this->Api_model->get_giftcard_details();
    }

    public function insert_user_review(){
        $this->Api_model->insert_user_review();
    }
    public function get_store_reviews(){
        $this->Api_model->get_store_reviews();
    }
    public function get_store_giftcards(){
        $this->Api_model->get_store_giftcards();
    }
    public function get_stylist_selection_page_flag(){
        $this->Api_model->get_stylist_selection_page_flag();
    }
	public function set_logged_in_user(){
		$this->Api_model->set_logged_in_user();
	}
	public function set_user_logout(){
		$this->Api_model->set_user_logout();
	}
	public function customer_payments(){
		$this->Api_model->customer_payments();
	}
	public function store_gst(){
		$this->Api_model->store_gst();
	}

    public function api_get_all_state(){
        $this->Api_model->api_get_all_state();
    }
    public function api_get_state_wise_city(){
        $this->Api_model->api_get_state_wise_city();
    }
    public function booking_stylists(){
        $this->Api_model->booking_stylists();
    }
    public function reschedule_stylists(){
        $this->Api_model->reschedule_stylists();
    }
    public function api_get_salon_rules(){
        $this->Api_model->api_get_salon_rules();
    }
    public function customer_booking_reminder(){
        $this->Api_model->customer_booking_reminder();
    }
    public function set_trying_for_booking(){
        $this->Api_model->set_trying_for_booking();
    }
    public function reserve_timeslot(){
        $this->Api_model->reserve_timeslot();
    }
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api_model extends CI_Model {
    public function login_otp(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['mobile_number']){
                $mobilenumber = $request['mobile_number'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('customer_phone',$mobilenumber);
                $exist = $this->db->get('tbl_salon_customer');
                $exist_count = $exist->num_rows();
                $customer_data = $exist->row();
                if($exist_count > 0){
                    $otp = rand(100000,999999);
                    $otpString = (string)$otp; 
    
                    $type = '0';
                    $firstName = "Customer";
                    $lastName = "";
                    $otp = $otpString;
                    
                    $message = "Dear " . $firstName . " " . $lastName . ",\nYour OTP for salon booking at Napito is " . $otp . ". Please enter this OTP to confirm your booking.\nThank you,\nTeam Napito. rx3WCuxr6NN";
                    
                    $number = $mobilenumber;
                    $customer = '';
                    $template_id = '1107173588546445327';   // new ID with encoded field in message content for app developer
                    $response = $this->send_sms($message,$number,$type,$customer,$salon_id,$branch_id,'','','',$template_id,'');
    
                    if($response || $mobilenumber == '1591591591'){
                        $data = array(
                            'otp'       =>  $otpString,
                            'is_new'    =>  false,
                            'is_connect_store'    =>  false,
                            'customer_id' => $customer_data->id,
                            'gender' => $customer_data->gender,
                        );
    
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Failed to send OTP. Please try again.';
                        $json_arr['data'] = [];
                    }
                }else{                    
                    if($salon_id != "0" && $branch_id != '0'){                        
                        $otp = rand(100000,999999);  
                        $otpString = (string)$otp; 
        
                        $type = '0';
                        $firstName = "Customer";
                        $lastName = "";
                        $otp = $otpString;

                        $message = "Dear " . $firstName . " " . $lastName . ",\nYour OTP for salon booking at Napito is " . $otp . ". Please enter this OTP to confirm your booking.\nThank you,\nTeam Napito. rx3WCuxr6NN";

                        $number = $mobilenumber;
                        $customer = '';
                        $template_id = '1107173588546445327';   // new ID with encoded field in message content for app developer
                        $response = $this->send_sms($message,$number,$type,$customer,$salon_id,$branch_id,'','','',$template_id,'');
        
                        if($response || $mobilenumber == '1591591591'){
                            $data = array(
                                'otp'       =>  $otpString,
                                'is_new'    =>  true,
                                'is_connect_store'    =>  false,
                            );
        
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Failed to send OTP. Please try again.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $data = array(
                            'otp'       =>  '',
                            'is_new'    =>  true,
                            'is_connect_store'    =>  true,
                        );
    
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Mobile number not found. Please try again.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found. Please try again.';
            $json_arr['data'] = [];
        }

        echo json_encode($json_arr);
    }
    public function send_sms($message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$for_query_id,$template_id,$consent_form_id){
        $curl = curl_init();
        $campaign_name = "testing";
        $authKey = SMSKEY;
        $mobileNumber = $number; 
        $sender = SENDERID; 
        $message = $message;
        $route = ROUTE; 
        $template_id = $template_id; 
        $scheduleTime = ""; 
        $coding = "1"; 
        
        $postData = array(
            "campaign_name"     => $campaign_name, 
            "auth_key"          => $authKey, 
            "receivers"         => $mobileNumber, 
            "sender"            => $sender, 
            "route"             => $route, 
            "scheduleTime"      => $scheduleTime,
            "message"           => [
                                        'msgdata'       => $message,
                                        'Template_ID'   => $template_id,
                                        'coding'        => $coding
                                    ]
        );
        
        curl_setopt_array($curl, array(
            CURLOPT_URL                 => 'http://sms.bulksmsserviceproviders.com/api/send/sms',
            CURLOPT_RETURNTRANSFER      => true,
            CURLOPT_ENCODING            => '',
            CURLOPT_MAXREDIRS           => 10,
            CURLOPT_TIMEOUT             => 0,
            CURLOPT_FOLLOWLOCATION      => true,
            CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST       => 'POST',
            CURLOPT_POSTFIELDS          => json_encode($postData),
            CURLOPT_HTTPHEADER          => array(
                                                    'Content-Type: application/json'
                                            ),
        ));
        
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        if($data['status'] == 'Success'){
            $this->Salon_model->set_message_log($customer,'0',$type,$number,'',$message,$data['status'],$salon_id,$branch_id,$response,$for_order_id,$for_offer_id,$for_query_id,$template_id,'',$consent_form_id,'','','','',[],'');
            return true;
        }else{
            return false;
        }
	}
    public function customer_login_new(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['mobile_number']){
                $is_new = $request['is_new'];
                $mobilenumber = $request['mobile_number'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                
                $this->db->where('is_deleted','0');
                $this->db->where('id',$branch_id);
                $this->db->where('salon_id',$salon_id);
                $branch = $this->db->get('tbl_branch')->row();

                $secret_token = $this->generate_secret_token();
                $data = array();
                if($is_new){
                    $user_data = array(
                        'customer_phone'    =>  $mobilenumber,
                        'salon_id'          =>  $salon_id,
                        'branch_id'         =>  $branch_id,
                        'auth_key'          =>  $secret_token,
                        'gender'            =>  '',
                        'is_logged_in'      =>  '1',
                        'registered_from'   =>  '1',
                        'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                        'created_on'        =>  date('Y-m-d H:i:s')
                    );
                    $this->db->where('customer_phone',$mobilenumber);
                    $exist_customer = $this->db->get('tbl_salon_customer');
                    $exist_customer = $exist_customer->row();
                    if(empty($exist_customer)){
                        $this->db->insert('tbl_salon_customer',$user_data);
                        $customer_id = $this->db->insert_id();
                    }else{
                        $user_data = array(
                            'customer_phone'    =>  $mobilenumber, 
                            'auth_key'          =>  $secret_token,
                            'gender'            => '',
                            'is_logged_in'      =>  '1',
                            'registered_from'   =>  '1',
                            'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null, 
                        );
                        $this->db->where('id',$exist_customer->id);


                        $this->db->update('tbl_salon_customer',$user_data);
                        $customer_id = $exist_customer->id;
                    }                        

                    $data = array(
                        'customer_name' =>  '',
                        'customer_id'   =>  $customer_id,
                        'branch_mobile' =>  !empty($branch) ? $branch->salon_number : '',
                        'branch_id'     =>  $branch_id,
                        'salon_id'      =>  $salon_id,
                        'is_profile_update'     =>  true,
                        'is_store_selection'    =>  false,
                    );
    
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;   
                }else{
                    $this->db->where('customer_phone',$mobilenumber);
                    $this->db->where('is_deleted','0');
                    $exist = $this->db->get('tbl_salon_customer')->num_rows();
                    if($exist > 0){
                        if($salon_id != "" && $branch_id != ""){
                            $this->db->where('customer_phone',$mobilenumber);
                            $this->db->where('branch_id',$branch_id);
                            $this->db->where('salon_id',$salon_id);
                            $this->db->where('is_deleted','0');
                            $single_exist = $this->db->get('tbl_salon_customer')->row();
                            if(!empty($single_exist)){
                                $user_data = array(
                                    'auth_key'      =>  $secret_token,
                                    'is_logged_in'  =>  '1',
                                    'fcm_token'     =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                                );
                                $this->db->where('id',$single_exist->id);
                                $this->db->update('tbl_salon_customer',$user_data);

                                if($single_exist->full_name != ""){  
                                    $data = array(
                                        'customer_name' =>  $single_exist->full_name,
                                        'customer_id'   =>  $single_exist->id,
                                        'gender'   =>  $single_exist->gender,
                                        'branch_mobile' =>  !empty($branch) ? $branch->salon_number : '',
                                        'branch_id'     =>  $branch_id,
                                        'salon_id'      =>  $salon_id,
                                        'is_profile_update'     =>  false,
                                        'is_store_selection'    =>  false,
                                    );
                                }else{
                                    $data = array(
                                        'customer_name' =>  $single_exist->full_name,
                                        'gender' =>  $single_exist->gender,
                                        'customer_id'   =>  $single_exist->id,
                                        'branch_mobile' =>  !empty($branch) ? $branch->salon_number : '',
                                        'branch_id'     =>  $branch_id,
                                        'salon_id'      =>  $salon_id,
                                        'is_profile_update'     =>  true,
                                        'is_store_selection'    =>  false,
                                    );
                                }
                
                                $json_arr['status'] = 'true';
                                $json_arr['message'] = 'success';
                                $json_arr['data'] = $data; 
                            }else{
                                $user_data = array(
                                    'customer_phone'    =>  $mobilenumber,
                                    'salon_id'          =>  $salon_id,
                                    'branch_id'         =>  $branch_id,
                                    'auth_key'          =>  $secret_token,
                                    'is_logged_in'      =>  '1',
                                    'registered_from'   =>  '1',
                                    'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                                    'created_on'        =>  date('Y-m-d H:i:s')
                                );
                                
                                
                                $this->db->where('customer_phone',$mobilenumber);
                                $exist_customer = $this->db->get('tbl_salon_customer');
                                $exist_customer = $exist_customer->row();
                                if(empty($exist_customer)){
                                    $this->db->insert('tbl_salon_customer',$user_data);
                                    $customer_id = $this->db->insert_id();
                                }else{
                                    $user_data = array(
                                        'customer_phone'    =>  $mobilenumber, 
                                        'auth_key'          =>  $secret_token,
                                        'gender'            => '',
                                        'is_logged_in'      =>  '1',
                                        'registered_from'   =>  '1',
                                        'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null, 
                                    );
                                    $this->db->where('id',$exist_customer->id);
                                    $this->db->update('tbl_salon_customer',$user_data);
                                    $customer_id = $exist_customer->id;
                                }
            
                                $data = array(
                                    'customer_name' =>  '',
                                    'customer_id'   =>  $customer_id,
                                    'branch_mobile' =>  !empty($branch) ? $branch->salon_number : '',
                                    'branch_id'     =>  $branch_id,
                                    'salon_id'      =>  $salon_id,
                                    'is_profile_update'     =>  true,
                                    'is_store_selection'    =>  false,
                                );
                
                                $json_arr['status'] = 'true';
                                $json_arr['message'] = 'success';
                                $json_arr['data'] = $data;   
                            }
                        }else{
                            $this->db->where('customer_phone',$mobilenumber); 
                            $this->db->where('is_deleted','0');
                            $single_exist = $this->db->get('tbl_salon_customer')->row();
                            if(!empty($single_exist)){
                                $data = array(
                                        'customer_name' =>  $single_exist->full_name,
                                        'gender' =>  $single_exist->gender,
                                        'customer_id'   =>  $single_exist->id,
                                        'branch_mobile' =>  !empty($branch) ? $branch->salon_number : '',
                                        'branch_id'     =>  $branch_id,
                                        'salon_id'      =>  $salon_id,
                                        'is_profile_update'     =>  false,
                                        'is_store_selection'    =>  false,
                                    );
                            }else{
                                $data = array(
                                    'customer_name' =>  '',
                                    'customer_id'   =>  '',
                                    'branch_mobile' =>  '',
                                    'branch_id'     =>  '',
                                    'salon_id'      =>  '',
                                    'category'      =>  '',
                                    'is_profile_update'     =>  false,
                                    'is_store_selection'    =>  true,
                                ); 
                            }
            
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;   
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Something went wrong. Please try again.';
                        $json_arr['data'] = [];
                    }
                }           
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Mobile number not found. Please try again.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found. Please try again.';
            $json_arr['data'] = [];
        }

        echo json_encode($json_arr);
    } 
    public function customer_login(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['mobile_number']){
                $mobilenumber = $request['mobile_number'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('customer_phone',$mobilenumber);
                $exist = $this->db->get('tbl_salon_customer')->row();

                $otp = rand(100000,999999); 
                $otp = 123456;  
                $otpString = (string)$otp; 
                $secret_token = $this->generate_secret_token();

                if($salon_id != "" && $branch_id != ""){
                    $is_store_selection = false;
                }else{
                    $is_store_selection = true;
                }

                if(empty($exist)){
                    $user_data = array(
                        'customer_phone'    =>  $mobilenumber,
                        'auth_key'          =>  $secret_token,
                        'is_logged_in'      =>  '1',
                        'registered_from'   =>  '1',
                        'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                        'created_on'        =>  date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tbl_salon_customer',$user_data);
                    $customer_id = $this->db->insert_id();

                    $data = array(
                        'customer_id'   =>  $customer_id,
                        'branch_id'     =>  '',
                        'salon_id'      =>  '',
                        'otp'           =>  $otpString,
                        'is_profile_update'  =>  true,
                        'is_store_selection' =>  $is_store_selection,
                    );
                }else{
                    $customer_id = $exist->id;
                    $user_data = array(
                        'auth_key'      =>  $secret_token,
                        'is_logged_in'  =>  '1',
                        'fcm_token'     =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                    );
                    $this->db->where('id',$customer_id);
                    $this->db->update('tbl_salon_customer',$user_data);

                    if($exist->full_name != ""){
                        $data = array(
                            'customer_id'   =>  $customer_id,
                            'branch_id'     =>  $exist->branch_id,
                            'salon_id'      =>  $exist->salon_id,
                            'otp'           =>  $otpString,
                            'is_profile_update'     =>  false,
                            'is_store_selection'    =>  $is_store_selection,
                        );
                    }else{
                        $data = array(
                            'customer_id'   =>  $customer_id,
                            'branch_id'     =>  $exist->branch_id,
                            'salon_id'      =>  $exist->salon_id,
                            'otp'           =>  $otpString,
                            'is_profile_update'     =>  true,
                            'is_store_selection'    =>  $is_store_selection,
                        );
                    }
                }

                $type = '0';
                $message = $otpString." is your OTP to login to MS Salon app. DO NOT share with anyone.";
                $number = $mobilenumber;
                $customer = $customer_id;
                $response = $this->send_whatsapp_message($customer,$message,$number,$type);
                
                if($response){
                    if($salon_id != "" && $branch_id != ""){
                        $user_data = array(
                            'salon_id'          =>  $salon_id,
                            'branch_id'         =>  $branch_id,
                            'is_logged_in'      =>  '1',
                            'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                        );
                        $this->db->where('id',$customer_id);
                        $this->db->update('tbl_salon_customer',$user_data);
                    }

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Failed to send OTP. Please try again.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 

    public function get_customer_profile(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['customer_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->select('id as customer_id, full_name, f_name, l_name, dob as date_of_birth, doa as date_of_anniversary, customer_phone, profile_pic, gender, rewards_balance');
                $this->db->where('is_deleted','0');
                $this->db->where('id',$customer_id);
                //$this->db->where('salon_id',$salon_id);
                //$this->db->where('branch_id',$branch_id);
                $exist = $this->db->get('tbl_salon_customer')->result();

                if(!empty($exist)){
                    foreach ($exist as &$row) {
                        if($row->gender == '0'){
                            $row->gender = 'Male';
                        }elseif($row->gender == '1'){
                            $row->gender = 'Female';
                        }elseif($row->gender == '2'){
                            $row->gender = 'Other';
                        }else{
                            $row->gender = '';
                        }
                        
                        if($row->date_of_anniversary != '' && $row->date_of_anniversary != '0000-00-00' && $row->date_of_anniversary != '1970-01-01'){
                            $row->date_of_anniversary = date('d-m-Y',strtotime($row->date_of_anniversary));
                        }else{
                            $row->date_of_anniversary = '';
                        }

                        if($row->date_of_birth != '' && $row->date_of_birth != '0000-00-00' && $row->date_of_birth != '1970-01-01'){
                            $row->date_of_birth = date('d-m-Y',strtotime($row->date_of_birth));
                        }else{
                            $row->date_of_birth = '';
                        }

                        if ($row->profile_pic != "" && $row->profile_pic != null) {
                            $row->profile_pic = base_url('salon_assets/images/customer_profile/' . $row->profile_pic);
                        } else {
                            $row->profile_pic = "";
                        }

                        if ($row->f_name == "") {
                            $nameParts = explode(' ', $row->full_name);
                            $row->f_name = isset($nameParts[0]) ? $nameParts[0] : '';
                        }
                        
                        if ($row->l_name == "") {
                            $nameParts = explode(' ', $row->full_name);
                            $row->l_name = isset($nameParts[1]) ? $nameParts[1] : '';
                        }
                    }
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $exist;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Profile details not available.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 
    
    public function store_gst(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['customer_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                
                $this->db->select('tbl_store_profile.*,tbl_salon.is_gst_applicable,tbl_salon.gst_no');
                $this->db->join('tbl_salon','tbl_store_profile.salon_id = tbl_salon.id');
                $this->db->where('tbl_store_profile.is_deleted', '0');
                $this->db->where('tbl_store_profile.branch_id', $branch_id);
                $this->db->where('tbl_store_profile.salon_id', $salon_id);
                $this->db->order_by('tbl_store_profile.id', 'DESC');
                $result = $this->db->get('tbl_store_profile');
                $result = $result->row();

                if(!empty($result)){
                    $gst_rate = '0';
                    $setup = $this->Master_model->get_backend_setups();	
                    if(!empty($setup)){
                        $gst_rate = $setup->gst_rate;
                    }
                    $is_gst_applicable = $result->is_gst_applicable == '1' ? '1' : '0';
                    $gst_no = $is_gst_applicable == '1' ? ($result->gst_no != "" ? $result->gst_no : '') : '';
                    
                    if($is_gst_applicable == '0'){
                        $gst_rate = '0';
                    }

                    $data =array(
                        'is_gst_applicable' =>  $is_gst_applicable,
                        'gst_rate'          =>  $gst_rate,
                        'gst_no'            =>  $gst_no
                    );
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'GST details not available.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 

    public function get_store_profile(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = isset($request['customer_id']) ? $request['customer_id'] : '';
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->select('tbl_store_profile.*,tbl_branch.branch_unique_code,tbl_branch.salon_address as branch_salon_address,tbl_branch.pincode as branch_salon_pincode');
                $this->db->join('tbl_branch','tbl_branch.id = tbl_store_profile.branch_id');
                $this->db->where('tbl_store_profile.is_deleted','0');
                $this->db->where('tbl_branch.is_deleted','0');
                $this->db->where('tbl_store_profile.salon_id',$salon_id);
                $this->db->where('tbl_store_profile.branch_id',$branch_id);
                $this->db->where('tbl_branch.id',$branch_id);
                $profile = $this->db->get('tbl_store_profile')->row();

                if(!empty($profile)){                                     
                    $this->db->select('tbl_store_reviews.*,tbl_salon_customer.full_name,tbl_salon_customer.profile_pic');
                    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_store_reviews.customer_id');
                    $this->db->order_by('tbl_store_reviews.created_on','desc');
                    $this->db->where('tbl_store_reviews.is_deleted','0');
                    $this->db->where('tbl_store_reviews.salon_id',$salon_id);
                    $this->db->where('tbl_store_reviews.branch_id',$branch_id);
                    $result = $this->db->get('tbl_store_reviews');
                    $result = $result->result();
                    
                    $total = 0;
                    $rating = '';
                    if(!empty($result)){
                        foreach($result as $result_data){
                            $total += (float)str_replace('.', '', $result_data->stars);
                        }
                    }
                    
                    $total_entries = count($result);
                    if($total_entries > 0){
                        $rating = round($total / $total_entries);
                    }

                    $data['branch_id'] = $profile->branch_id;
                    $data['salon_id'] = $profile->salon_id;
                    $data['branch_unique_code'] = $profile->branch_unique_code;
                    $data['branch_name'] = $profile->branch_name;
                    $data['pincode'] = $profile->branch_salon_pincode;
                    $data['address'] = $profile->branch_salon_address . ($profile->branch_salon_pincode != "" ? ' '.$profile->branch_salon_pincode : '');
                    $data['website'] = $profile->website_link;
                    $data['phone_number'] = $profile->customer_support_phone;
                    $data['owner_phone_number'] = $profile->salon_number;
                    $data['customer_support_phone'] = $profile->customer_support_phone;
                    $data['profile_status'] = $profile->profile_status;
                    $data['status'] = $profile->status;
                    $data['starCount'] = $rating;
                    $data['reviewCount'] = $total_entries;
                    if ($profile->store_logo != "" && $profile->store_logo != null) {
                        $data['store_logo'] = base_url('admin_assets/images/store_logo/' . $profile->store_logo);
                    } else {
                        $data['store_logo'] = "";
                    }
                    
                    $unread_notifications = false;                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$customer_id);
                    $exist_customer = $this->db->get('tbl_salon_customer')->row();
                    if(!empty($exist_customer)){
                        $this->db->where('is_deleted','0');
                        $this->db->where('salon_id',$salon_id);
                        $this->db->where('branch_id',$branch_id);
                        $this->db->where('send_customer',$exist_customer->id);
                        $this->db->order_by('id','desc');
                        $this->db->limit(1);
                        $last_notification = $this->db->get('tbl_customer_notifications')->row();
                        if(!empty($last_notification)){
                            $last_notification_date = $last_notification->created_on;
                            $last_seen_date = $exist_customer->last_notifications_seen != "" ? $exist_customer->last_notifications_seen : 0;
                            if ($last_notification_date > $last_seen_date) {
                                $unread_notifications = true;
                            }
                        }
                    }
                    $data['customer_gender'] = !empty($exist_customer) ? $exist_customer->gender : '';
                    $data['unread_notifications'] = $unread_notifications;

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Profile details not available.';
                    $json_arr['data'] = [];
                }                
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 

    public function get_store_about_us(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->select('tbl_store_profile.*,tbl_branch.salon_address as branch_salon_address,tbl_branch.category as store_category,tbl_branch.pincode as branch_salon_pincode');
                $this->db->join('tbl_branch','tbl_branch.id = tbl_store_profile.branch_id');
                $this->db->where('tbl_store_profile.is_deleted','0');
                $this->db->where('tbl_branch.is_deleted','0');
                $this->db->where('tbl_store_profile.salon_id',$salon_id);
                $this->db->where('tbl_store_profile.branch_id',$branch_id);
                $this->db->where('tbl_branch.id',$branch_id);
                $profile = $this->db->get('tbl_store_profile')->row();

                if(!empty($profile)){
                    $data['branch_id'] = $profile->branch_id;
                    $data['salon_id'] = $profile->salon_id;
                    $data['owner_phone_number'] = $profile->salon_number;
                    $data['customer_support_phone'] = $profile->customer_support_phone;
                    $data['phone_number'] = $profile->customer_support_phone;
                    $data['pincode'] = $profile->branch_salon_pincode;
                    $data['address'] = $profile->location;
                    $data['latitude'] = $profile->latitude;
                    $data['longitude'] = $profile->longitude;
                    $data['description'] = $profile->description;
                    
                    $data['branch_name'] = $profile->branch_name;
                    $data['website'] = $profile->website_link;
                    if ($profile->store_logo != "" && $profile->store_logo != null) {
                        $data['store_logo'] = base_url('admin_assets/images/store_logo/' . $profile->store_logo);
                    } else {
                        $data['store_logo'] = "";
                    }

                    if($profile->store_category == '0'){
                        $category = 'Male';
                    }elseif($profile->store_category == '1'){
                        $category = 'Female';
                    }elseif($profile->store_category == '2'){
                        $category = 'Unisex';
                    }
                    $data['category'] = $category;
                    
                    $this->db->where('status', '1');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('branch_id',$profile->branch_id);
                    $this->db->where('salon_id',$profile->salon_id);
                    $working_hrs = $this->db->get('tbl_booking_rules')->row();
                    $opening_hrs = array();
                    if(!empty($working_hrs)){
                        if($working_hrs->is_monday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Monday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_monday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_monday))
                            );
                        }
                        if($working_hrs->is_tuesday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Tuesday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_tuesday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_tuesday))
                            );
                        }
                        if($working_hrs->is_wednesday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Wednesday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_wednesday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_wednesday))
                            );
                        }
                        if($working_hrs->is_thursday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Thursday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_thursday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_thursday))
                            );
                        }
                        if($working_hrs->is_friday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Friday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_friday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_friday))
                            );
                        }
                        if($working_hrs->is_saturday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Saturday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_saturday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_saturday))
                            );
                        }
                        if($working_hrs->is_sunday == '1'){
                            $opening_hrs[] = array(
                                'day'   =>  'Sunday',
                                'time'  =>  date('h:i A',strtotime($working_hrs->from_sunday)) . ' - ' . date('h:i A',strtotime($working_hrs->to_sunday))
                            );
                        }
                        $data['opening_hrs'] = $opening_hrs;
                    }else{
                        $data['opening_hrs'] = $opening_hrs;
                    }
                    
                    $this->db->select('tbl_store_images.*');
                    $this->db->join('tbl_branch','tbl_branch.id = tbl_store_images.branch_id');
                    $this->db->where('tbl_store_images.is_deleted','0');
                    $this->db->where('tbl_branch.is_deleted','0');
                    $this->db->where('tbl_store_images.salon_id',$salon_id);
                    $this->db->where('tbl_store_images.branch_id',$branch_id);
                    $this->db->where('tbl_branch.id',$branch_id);
                    $this->db->order_by('tbl_branch.id','desc');
                    $images = $this->db->get('tbl_store_images')->row();

                    if(!empty($images)){
                        $data['image'] = base_url('salon_assets/images/salon_images/' . $images->image);
                    }else{
                        $data['image'] = '';
                    }

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Profile details not available.';
                    $json_arr['data'] = [];
                }                
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 

    public function get_store_gallary(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('id',$branch_id);
                $this->db->where('salon_id',$salon_id);
                $branch = $this->db->get('tbl_branch')->row();
                if(!empty($branch)){
                    $feature_slugs = $this->Salon_model->get_subscription_slugs($branch->subscription_id);
                    if(!empty(array_intersect(['store-images'], $feature_slugs))){
                        $this->db->select('tbl_store_images.*');
                        $this->db->join('tbl_branch','tbl_branch.id = tbl_store_images.branch_id');
                        $this->db->where('tbl_store_images.is_deleted','0');
                        $this->db->where('tbl_branch.is_deleted','0');
                        $this->db->where('tbl_store_images.salon_id',$salon_id);
                        $this->db->where('tbl_store_images.branch_id',$branch_id);
                        $this->db->where('tbl_branch.id',$branch_id);
                        $images = $this->db->get('tbl_store_images')->result();

                        if(!empty($images)){
                            $data = array();
                            foreach($images as $images_result){
                                $data[] = base_url('salon_assets/images/salon_images/' . $images_result->image);
                            }
                            
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Gallary not available.';
                            $json_arr['data'] = [];
                        }        
                    }else{
                        $this->db->select('tbl_branch_gallary.*');
                        $this->db->join('tbl_branch','tbl_branch.id = tbl_branch_gallary.branch_id');
                        $this->db->where('tbl_branch_gallary.is_deleted','0');
                        $this->db->where('tbl_branch_gallary.branch_id',$branch_id);
                        $images = $this->db->get('tbl_branch_gallary')->result();

                        if(!empty($images)){
                            $data = array();
                            foreach($images as $images_result){
                                $data[] = base_url('admin_assets/images/gallary_image/' . $images_result->gallary_image);
                            }
                            
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Gallary not available.';
                            $json_arr['data'] = [];
                        }    
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found.';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 
    public function get_store_tips(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('tbl_branch.is_deleted','0');
                $this->db->where('tbl_branch.salon_id',$salon_id);
                $this->db->where('tbl_branch.id',$branch_id);
                $branch = $this->db->get('tbl_branch')->row();

                if(!empty($branch)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $tips = $this->db->get('tbl_tips_master')->result();
                    if(!empty($tips)){
                        $data = array();
                        foreach($tips as $tips_result){
                            $title_data = array();
                            $add_items = '0';
                            if($tips_result->add_items == '1'){
                                $single_title_details = $this->Master_model->get_single_tip_titles($tips_result->id);
                                if(!empty($single_title_details)){
                                    foreach($single_title_details as $single_title_details_result){
                                        $title_data[] = array(
                                            'item_name'     =>  $single_title_details_result->item_name,
                                            'description'   =>  $single_title_details_result->description
                                        );
                                    }
                                    $add_items = '1';
                                }
                            }

                            $all_images = [];
                            $banner_image = '';
                            for($i=0;$i<count(explode(',',$tips_result->tips_photo));$i++){
                                $all_images[] = array(
                                    'path'  =>  base_url('admin_assets/images/tips_photo/' . explode(',',$tips_result->tips_photo)[$i])
                                );
                                if($i == 0){
                                    $banner_image = base_url('admin_assets/images/tips_photo/' . explode(',',$tips_result->tips_photo)[$i]);
                                }
                            }
                            $data[] = array(
                                'is_extra_tips' =>  $add_items,
                                'title'         =>  $tips_result->tips,
                                'description'   =>  $tips_result->description,
                                'banner_image'  =>  $banner_image,
                                'all_images'    =>  $all_images,
                                'extra_tips'    =>  $title_data,
                            );
                        }
                        
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Tips not available.';
                        $json_arr['data'] = [];
                    }     
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not available.';
                    $json_arr['data'] = [];
                }                
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 
    public function get_store_facility(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('tbl_branch.is_deleted','0');
                $this->db->where('tbl_branch.salon_id',$salon_id);
                $this->db->where('tbl_branch.id',$branch_id);
                $branch = $this->db->get('tbl_branch')->row();

                if(!empty($branch)){                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('salon_id', $salon_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->order_by('id','DESC');
                    $facility = $this->db->get('tbl_salon_facility_master')->result();
                    if(empty($facility)){
                        $this->db->where('is_deleted','0');
                        $this->db->order_by('id','DESC');
                        $facility = $this->db->get('tbl_facility_master')->result();
                    }

                    if(!empty($facility)){
                        $data = array();
                        foreach($facility as $facility_result){
                            $icon = base_url('admin_assets/images/facility_icon/' . $facility_result->icon);
                            $data[] = array(
                                'title' =>  $facility_result->facility_name,
                                'icon'  =>  $icon
                            );
                        }
                        
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Facilities not available.';
                        $json_arr['data'] = [];
                    }     
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not available.';
                    $json_arr['data'] = [];
                }                
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 
    public function get_store_services(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                
                $category = $request['category_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    if($category != ""){
                        $this->db->where('tbl_salon_emp_service.category', $category);
                    }
                    $this->db->where('tbl_salon_emp_service.status', '1');
                    $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                    $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                    $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                    if($single->gender != ""){
                        $this->db->where('tbl_salon_emp_service.gender',$single->gender);
                    }
                    $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
                    $this->db->from('tbl_salon_emp_service');
                    $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                    $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                    // $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
                    $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');
                
                    $result = $this->db->get();
                    $services = $result->result();
                    
                    if(!empty($services)){ 
                        $data = array();
                        foreach($services as $services_result){
                            $service_products = $this->Salon_model->get_selected_service_products($services_result->product);
                            $products = [];
                            if(!empty($service_products)){
                                foreach($service_products as $service_products_result){
                                    $products[] = array(
                                        'service_id'    =>  $services_result->id,
                                        'product_id'    =>  $service_products_result->id,
                                        'price'         =>  $service_products_result->selling_price,
                                        'product_name'  =>  $service_products_result->product_name,
                                        'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
                                    );
                                }
                            }
                            
                            // new discount flow start
                            $discount_in = '';
                            $discount_type = '';
                            $discount_amount_value = '';
                            $customer_criteria = '';
                            $is_discount_applied = '0';

                            $discount_text = '';
                            $discount_amount = 0;
                            $slab_increment = '5';
                            $slab_consider = '';
                            $min_slab = '';
                            $max_slab = '';

                            $rewards_text = '';

                            $service_applied_discount = $this->Salon_model->get_customer_service_applied_discount($single->id,$services_result->id);
                            if($service_applied_discount['is_discount_applied'] == '1'){
                                $is_discount_applied = '1';
                                $customer_criteria = $service_applied_discount['customer_criteria'];
                                $discount_type = $service_applied_discount['discount_type'];
                                $discount_in = $service_applied_discount['discount_in'];
                                $discount_amount_value = (float)$service_applied_discount['discount_amount'];
                                $min_slab = $service_applied_discount['min_flexible'];
                                $max_slab = $service_applied_discount['max_flexible'];
                                if($discount_type == '1'){    //Flexible
                                    $customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($single->id,$services_result->id);
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
                                        $discount_amount = ((float)$slab_consider * (float)$services_result->final_price) / 100;
                                        $discount_text = $slab_consider . '% Off';
                                    }elseif($discount_in == '1'){ //flat
                                        $discount_amount = (float)$slab_consider;
                                        $discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
                                    }
                                }elseif($discount_type == '0'){   //Fixed
                                    if($discount_in == '0'){  //percentage
                                        $discount_amount = ((float)$discount_amount_value * (float)$services_result->final_price) / 100;
                                        $discount_text = $discount_amount_value . '% Off';
                                    }elseif($discount_in == '1'){ //flat
                                        $discount_amount = (float)$discount_amount_value;
                                        $discount_text = 'Flat Rs. ' . $discount_amount_value . ' Off';
                                    }
                                }

                                $rewards_text = 'Earn ' . $discount_amount . ' Reward Points';
                            }

                            if($is_discount_applied == '1'){
                                if($customer_criteria == '1'){  //for regular customer rewards are given
                                    $discount_text = $rewards_text;
                                    $discount_amount = 0;
                                }
                            }

                            //new discount flow end

                            $service_price_consider = $services_result->final_price - $discount_amount;
                            $original_price = $services_result->final_price;

                            $data[] = array(
                                'is_special'        =>  $services_result->is_special,
                                'service_id'        =>  $services_result->id,
                                'category_id'       =>  $services_result->category,
                                'sub_category_id'   =>  $services_result->sub_category,
                                
                                'service_name'      =>  $services_result->service_name,
                                'service_marathi_name'    =>  $services_result->service_name_marathi,
                                'service_description'     =>  strip_tags($services_result->service_description),
                                'category_name'     =>  $services_result->sup_category,
                                'sub_category_name' =>  $services_result->subcategory,
                                'category_marathi_name'     =>  $services_result->sup_category_marathi,
                                'sub_category_marathi_name' =>  $services_result->sub_category_marathi,

                                'original_price'    =>  $original_price,
                                'received_discount_amount'   =>  $discount_amount,
                                'price'             =>  $service_price_consider,

                                'service_duration'  =>  $services_result->service_duration,
                                'reward_points'     =>  $services_result->reward_point,
                                'offer_text'        =>  $discount_text,
                                'products'          =>  $products,
                                'image'             =>  $services_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $services_result->category_image) : '',
                            );
                        }                            
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Services not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    
    public function get_privacy_policy_terms($type){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_branch')->row();

                if(!empty($single) && $type != ""){ 
                    $this->db->where('type', $type);
                    $this->db->where('status', '1');
                    $this->db->where('for', '0');
                    $this->db->where('is_deleted', '0');                  
                    $this->db->order_by('id', 'DESC');                
                    $result = $this->db->get('tbl_privacy_policy_and_terms');
                    $terms = $result->result();
                    
                    if(!empty($terms)){ 
                        $data = array();
                        foreach($terms as $services_result){
                            $data[] = $services_result->text;
                        }                            
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Data not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch details not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_banner(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_branch')->row();

                if(!empty($single)){ 
                    $this->db->where('status', '1');
                    $this->db->where('is_deleted', '0');  
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);                
                    $this->db->where('DATE(show_till) >', date('Y-m-d'));                
                    $this->db->where('created_on <', date('Y-m-d H:i:s', strtotime('-1 day')));              
                    $this->db->order_by('id', 'DESC');                
                    $result = $this->db->get('tbl_salon_mobile_banner');
                    $terms = $result->result();
                    if(empty($terms)){
                        $this->db->where('status', '1');
                        $this->db->where('is_deleted', '0');                  
                        $this->db->order_by('id', 'DESC');                
                        $result = $this->db->get('tbl_mobile_banner');
                        $terms = $result->result();
                    }
                    
                    if(!empty($terms)){ 
                        $data = array();
                        foreach($terms as $services_result){
                            $data[] = base_url().'admin_assets/images/mobile_banner_photo/'.$services_result->banner;
                        }                            
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Images not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch details not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    
    public function get_catlogue(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['branch_id']) && isset($request['customer_id'])){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                
                $customer_id = $request['customer_id'];         
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();
                if(!empty($customer)){  
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_branch')->row();

                    if(!empty($single)){ 
                        $this->db->where('status', '1');
                        $this->db->where('is_deleted', '0');  
                        $this->db->where('branch_id', $branch_id);
                        $this->db->where('salon_id', $salon_id);                
                        $this->db->order_by('id', 'DESC');                
                        $result = $this->db->get('tbl_catalogue');
                        $terms = $result->result();
                        if(empty($terms)){
                            $this->db->where('salon_id ',null);
                            $this->db->where('branch_id',null);   
                            $this->db->where('status', '1');
                            $this->db->where('is_deleted', '0');                  
                            $this->db->order_by('id', 'DESC');                
                            $result = $this->db->get('tbl_catalogue');
                            $terms = $result->result();
                        }
                        
                        if(!empty($terms)){ 
                            $data_male = array();
                            $data_female = array();

                            foreach ($terms as $services_result) {
                                $image_url = base_url() . 'admin_assets/images/catalogue/' . $services_result->banner;

                                if ($services_result->gender == '0') {
                                    $data_male[] = $image_url;
                                } elseif ($services_result->gender == '1') { 
                                    $data_female[] = $image_url;
                                }
                            }

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = array(
                                'customer_gender' => $customer->gender == '0' ? 'male' : ($customer->gender == '1' ? 'female' : ''),
                                'male' => $data_male,
                                'female' => $data_female
                            );
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Images not available';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch details not found';
                        $json_arr['data'] = [];
                    } 
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer details not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID and Customer ID required.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_booking_rules(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];    
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);                        
                        if(!empty($rules)){
                            $allowed_booking_dates = [];
                            $max_booking_range_day = $rules->max_booking_range_day;
                            $max_days = $max_booking_range_day != "" ? (int)$max_booking_range_day : 1;

                            $start_date = new DateTime();
                            for ($i = 0; $i < $max_days; $i++) {
                                $allowed_booking_dates[] = $start_date->format('Y-m-d');
                                $start_date->modify('+1 day');
                            }

                            $data = array(
                                'rule_id'               =>  $rules->id,
                                'mins_before_booking'   =>  $rules->booking_time_range,
                                'days_before_booking'   =>  $max_booking_range_day,
                                'allowed_booking_dates' =>  $allowed_booking_dates,
                            );   

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Rules not available';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not found';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    // public function get_booking_services(){
    //     $request = json_decode(file_get_contents('php://input'), true);
    //     if($request){
    //         if($request['branch_id']){
    //             $customer_id = $request['customer_id'];
    //             $salon_id = $request['salon_id'];
    //             $branch_id = $request['branch_id'];   

    //             $this->db->where('is_deleted','0');
    //             $this->db->where('status','1');
    //             $this->db->where('id',$customer_id);
    //             $this->db->where('branch_id', $branch_id);
    //             $this->db->where('salon_id', $salon_id);
    //             $single = $this->db->get('tbl_salon_customer')->row();

    //             $data = array();
    //             if(!empty($single)){                 
    //                 $this->db->where('is_deleted', '0');
    //                 $this->db->order_by('order', 'asc');
    //                 $categories = $this->db->get('tbl_admin_service_category');
    //                 $categories = $categories->result();
    //                 if(!empty($categories)){
    //                     foreach($categories as $categories_result){
    //                         $this->db->where('tbl_salon_emp_service.category', $categories_result->id);
    //                         $this->db->where('tbl_salon_emp_service.status', '1');
    //                         $this->db->where('tbl_salon_emp_service.is_deleted', '0');
    //                         $this->db->where('tbl_admin_service_category.is_deleted', '0');
    //                         $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
    //                         $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
    //                         if($single->gender != ""){
    //                             $this->db->where('tbl_salon_emp_service.gender',$single->gender);
    //                         }
    //                         $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
    //                         $this->db->from('tbl_salon_emp_service');
    //                         $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
    //                         $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
    //                         $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
                        
    //                         $result = $this->db->get();
    //                         $services = $result->result();
                            
    //                         $services_array = [];
    //                         if(!empty($services)){ 
    //                             foreach($services as $services_result){
    //                                 $service_products = $this->Salon_model->get_selected_service_in_stock_products($services_result->product);
    //                                 $products = [];
    //                                 if(!empty($service_products)){
    //                                     foreach($service_products as $service_products_result){
    //                                         $discount_in = $service_products_result->discount_in;
    //                                         $discount = $service_products_result->discount != "" ? (float)$service_products_result->discount : 0;
    //                                         $selling_price = $service_products_result->selling_price != "" ? (float)$service_products_result->selling_price : 0.00;
    //                                         if($discount_in == '0'){
    //                                             $selling_price = $selling_price - ($selling_price * $discount) / 100;
    //                                             $discount_text = $discount . '% Off';
    //                                         }elseif($discount_in == '1'){
    //                                             $selling_price = $selling_price - $discount;
    //                                             $discount_text = 'Flat Rs. '. $discount . ' Off';
    //                                         }else{
    //                                             $selling_price = $selling_price;
    //                                             $discount_text = '';
    //                                         }
    //                                         $products[] = array(
    //                                             'service_id'    =>  $services_result->id,
    //                                             'product_id'    =>  $service_products_result->id,
    //                                             'price'         =>  $selling_price,
    //                                             'original_price'=>  $service_products_result->selling_price,
    //                                             'discount_text' =>  $discount_text,
    //                                             'product_name'  =>  $service_products_result->product_name,
    //                                             'product_added_from'=>  '0',
    //                                             'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
    //                                         );
    //                                     }
    //                                 }
                                    
    //                                 $active_offers = $this->Salon_model->get_all_active_offers_all($branch_id,$salon_id);
    //                                 if(!empty($active_offers)){
    //                                     $count = count($active_offers);
    //                                     $count = 0;
    //                                 }else{
    //                                     $count = 0;
    //                                 }
    //                                 $service_offer_discount = 0;
    //                                 $single_offer_discount_type = '';
    //                                 $single_offer_discount = '';
    //                                 $applied_offer_id = '';
    //                                 $rewards = '';
    //                                 $is_offer_applied = '0';
    //                                 $discount_text = '';
    //                                 for ($i = 0; $i < $count; $i++) {
    //                                     $single_offer_services = explode(',',$active_offers[$i]->service_name);
    //                                     if (in_array($services_result->id,$single_offer_services)) {
    //                                         $single_offer_discount_type = $active_offers[$i]->discount_in;
    //                                         if($single_offer_discount_type == '0'){
    //                                             $service_offer_discount = ($services_result->final_price * $active_offers[$i]->discount) / 100;
    //                                         }else{
    //                                             $service_offer_discount = $active_offers[$i]->discount;
    //                                         }
    //                                         $single_offer_discount = $active_offers[$i]->discount;
    //                                         $rewards = $active_offers[$i]->reward_point;
    //                                         $applied_offer_id = $active_offers[$i]->id;
    //                                         break;
    //                                     }
    //                                 }

    //                                 $rewards = '';
    //                                 $min_slab = $services_result->min;
    //                                 $max_slab = $services_result->max;
    //                                 $slab_increment = $services_result->slab_increment;
    //                                 $slab_consider = '';
    //                                 $discount_amount = 0;
    //                                 if($services_result->discount_type == '1'){    //Flexible
    //                                     $customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($single->id,$services_result->id);
    //                                     if(!empty($customer_last_service_booking)){                                        
    //                                         $min_slab = $services_result->min;
    //                                         $max_slab = $services_result->max;
    //                                         $slab_increment = $services_result->slab_increment;
    //                                         $prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;
        
    //                                         if($prev_Applied_slab != ""){
    //                                             $next_slab = $prev_Applied_slab + $slab_increment;
    //                                         }else{
    //                                             $next_slab = $min_slab + $slab_increment;
    //                                         }
        
    //                                         if($next_slab > $max_slab){
    //                                             $slab_consider = $min_slab;
    //                                         }else{
    //                                             $slab_consider = $next_slab;
    //                                         }
    //                                     }else{
    //                                         $min_slab = $services_result->min;
    //                                         $max_slab = $services_result->max;
    //                                         $slab_increment = $services_result->slab_increment;
    //                                         $slab_consider = $min_slab;
    //                                     }
        
    //                                     if($services_result->discount_in == '0'){  //percentage
    //                                         $discount_amount = ((float)$slab_consider * (float)$services_result->final_price) / 100;
    //                                         $discount_text = $slab_consider . '% Off';
    //                                     }elseif($services_result->discount_in == '1'){ //flat
    //                                         $discount_amount = (float)$slab_consider;
    //                                         $discount_text = 'Rs. ' . $slab_consider . ' Off';
    //                                     }
    //                                 }elseif($services_result->discount_type == '0'){   //Fixed
    //                                     if($services_result->discount_in == '0'){  //percentage
    //                                         $discount_amount = ((float)$services_result->service_discount * (float)$services_result->final_price) / 100;
    //                                         $discount_text = $services_result->service_discount . '% Off';
    //                                     }elseif($services_result->discount_in == '1'){ //flat
    //                                         $discount_amount = (float)$services_result->service_discount;
    //                                         $discount_text = 'Rs. ' . $services_result->service_discount . ' Off';
    //                                     }
    //                                     $rewards = $services_result->reward_point;
    //                                 }

    //                                 $service_price_consider = $services_result->final_price - $discount_amount;
    //                                 $original_price = $services_result->final_price;
                                    
    //                                 if($services_result->discount_type == '0'){
    //                                     $discount_text .= $rewards != "" ? ' & ' . $rewards . ' Reward Points' : ' & ' . $services_result->reward_point . ' Reward Points';
    //                                 }
    //                                 $services_array[] = array(
    //                                     'is_special'        =>  $services_result->is_special,
    //                                     'service_id'        =>  $services_result->id,
    //                                     'category_id'       =>  $services_result->category,
    //                                     'sub_category_id'   =>  $services_result->sub_category,                                        
    //                                     'service_name'      =>  $services_result->service_name,
    //                                     'service_marathi_name'    =>  $services_result->service_name_marathi,
    //                                     'image'             =>  $services_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $services_result->category_image) : '',
    //                                     'category_name'     =>  $services_result->sup_category,
    //                                     'sub_category_name' =>  $services_result->subcategory,
    //                                     'category_marathi_name'     =>  $services_result->sup_category_marathi,
    //                                     'sub_category_marathi_name' =>  $services_result->sub_category_marathi,
    //                                     'products'          =>  $products,
    //                                     'service_description'     =>  strip_tags($services_result->service_description),
    //                                     'service_duration'  =>  $services_result->service_duration,
    //                                     'reward_points'     =>  $rewards != "" ? $rewards : $services_result->reward_point,

    //                                     'original_price'    =>  $original_price,
    //                                     'discount_amount'   =>  $discount_amount,
    //                                     'discount_text'     =>  $discount_text,
    //                                     'price'             =>  $service_price_consider,
    //                                     'is_offer_applied'  =>  $is_offer_applied,
    //                                     'applied_offer_id'  =>  $applied_offer_id,
    //                                     'service_added_from'=>  '0',
    //                                 );
    //                             }    
    //                             $data[] = array(
    //                                 'category_id'       =>  $categories_result->id,
    //                                 'category_name'     =>  $categories_result->sup_category,
    //                                 'category_marathi_name'     =>  $categories_result->sup_category_marathi,
    //                                 'image'             =>  $categories_result->category_image != "" ? base_url('admin_assets/images/service_category_image/' . $categories_result->category_image) : '',
    //                                 'services'          =>  $services_array,
    //                             );                      
    //                         }  
    //                     }
    //                     $json_arr['status'] = 'true';
    //                     $json_arr['message'] = 'success';
    //                     $json_arr['data'] = $data;
    //                 }else{
    //                     $json_arr['status'] = 'false';
    //                     $json_arr['message'] = 'Services not available';
    //                     $json_arr['data'] = [];
    //                 }
    //             }else{
    //                 $json_arr['status'] = 'false';
    //                 $json_arr['message'] = 'Customer not found';
    //                 $json_arr['data'] = [];
    //             }          
    //         }else{
    //             $json_arr['status'] = 'false';
    //             $json_arr['message'] = 'Branch ID not available.';
    //             $json_arr['data'] = [];
    //         }
    //     }else{
    //         $json_arr['status'] = 'false';
    //         $json_arr['message'] = 'Request not found.';
    //         $json_arr['data'] = [];
    //     }
    //     echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    // } 
    public function get_booking_services(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];  

                $this->db->where('active_for_mobile_apps','1');
                $this->db->where('is_deleted','0');
                $this->db->where('id',$branch_id);
                $this->db->where('salon_id',$salon_id);
                $branch = $this->db->get('tbl_branch')->row();
                if(!empty($branch)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id',$customer_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();
                    $data = array();
                    if(!empty($single)){                 
                        $this->db->where('is_deleted', '0');
                        if($single->gender != ""){
                            $this->db->where('gender',$single->gender);
                        }
                        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');
                        $categories = $this->db->get('tbl_admin_service_category');
                        $categories = $categories->result();
                        if(!empty($categories)){
                            foreach($categories as $categories_result){       
                                $subcat_data = array(); 
                                $this->db->where('is_deleted', '0');
                                $this->db->where('sup_category', $categories_result->id);
                                if($single->gender != ""){
                                    $this->db->where('gender',$single->gender);
                                }
                                $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');
                                $subcategories = $this->db->get('tbl_admin_sub_category');
                                $subcategories = $subcategories->result();
                                if(!empty($subcategories)){
                                    foreach($subcategories as $subcategories_result){
                                        $this->db->where('tbl_salon_emp_service.category', $categories_result->id);
                                        $this->db->where('tbl_salon_emp_service.sub_category', $subcategories_result->id);
                                        $this->db->where('tbl_salon_emp_service.status', '1');
                                        $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                                        $this->db->where('tbl_admin_service_category.is_deleted', '0');
                                        $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                        $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                        if($single->gender != ""){
                                            $this->db->where('tbl_salon_emp_service.gender',$single->gender);
                                        }
                                        $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
                                        $this->db->from('tbl_salon_emp_service');
                                        $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                                        $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                                        $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');
                                    
                                        $result = $this->db->get();
                                        $services = $result->result();
                                        
                                        $services_array = [];
                                        if(!empty($services)){ 
                                            foreach($services as $services_result){
                                                $service_products = $this->Salon_model->get_selected_service_in_stock_products($services_result->product);
                                                $products = [];
                                                if(!empty($service_products)){
                                                    foreach($service_products as $service_products_result){
                                                        $discount_in = $service_products_result->discount_in;
                                                        $discount = $service_products_result->discount != "" ? (float)$service_products_result->discount : 0;
                                                        $selling_price = $service_products_result->selling_price != "" ? (float)$service_products_result->selling_price : 0.00;
                                                        if($discount_in == '0'){
                                                            $selling_price = $selling_price - ($selling_price * $discount) / 100;
                                                            $discount_text = $discount . '% Off';
                                                        }elseif($discount_in == '1'){
                                                            $selling_price = $selling_price - $discount;
                                                            $discount_text = 'Flat Rs. '. $discount . ' Off';
                                                        }else{
                                                            $selling_price = $selling_price;
                                                            $discount_text = '';
                                                        }

                                                        $product_discount_in = '';
                                                        $product_discount_type = '';
                                                        $product_discount_amount_value = '';
                                                        $product_discount_row_id = '';
                                                        $is_product_discount_applied = '0';

                                                        $product_discount_text = '';
                                                        $product_discount_amount = 0;
                                                        $product_slab_increment = '5';
                                                        $product_slab_consider = '';
                                                        $product_min_slab = '';
                                                        $product_max_slab = '';

                                                        $product_applied_discount = $this->Salon_model->get_customer_product_applied_discount($single->id,$service_products_result->id);
                                                        if($product_applied_discount['is_discount_applied'] == '1'){
                                                            $is_product_discount_applied = '1';
                                                            $product_discount_row_id = $product_applied_discount['discount_row_id'];
                                                            $product_discount_type = $product_applied_discount['discount_type'];
                                                            $product_discount_in = $product_applied_discount['discount_in'];
                                                            $product_discount_amount_value = (float)$product_applied_discount['discount_amount'];
                                                            $product_min_slab = $product_applied_discount['min_flexible'];
                                                            $product_max_slab = $product_applied_discount['max_flexible'];
                                                            if($product_discount_type == '1'){    //Flexible
                                                                $customer_last_service_product_booking = $this->Salon_model->get_customer_last_service_product_booking($single->id,$service_products_result->id);
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
                                                                    $product_discount_text = $product_slab_consider . '% Off';
                                                                }elseif($product_discount_in == '1'){ //flat
                                                                    $product_discount_amount = (float)$product_slab_consider;
                                                                    $product_discount_text = 'Flat Rs. ' . $product_slab_consider . ' Off';
                                                                }
                                                            }elseif($product_discount_type == '0'){   //Fixed
                                                                if($product_discount_in == '0'){  //percentage
                                                                    $product_discount_amount = ((float)$product_discount_amount_value * (float)$selling_price) / 100;
                                                                    $product_discount_text = $product_discount_amount_value . '% Off';
                                                                }elseif($product_discount_in == '1'){ //flat
                                                                    $product_discount_amount = (float)$product_discount_amount_value;
                                                                    $product_discount_text = 'Flat Rs. ' . $product_discount_amount_value . ' Off';
                                                                }
                                                            }
                                                        }

                                                        $service_product_price_consider = $selling_price - $product_discount_amount;
                                                        $original_product_price = $selling_price;

                                                        $products[] = array(
                                                            'service_id'    =>  $services_result->id,
                                                            'product_id'    =>  $service_products_result->id,
                                                            'price'         =>  $service_product_price_consider,
                                                            'original_price'=>  $original_product_price,
                                                            'discount_text' =>  $product_discount_text,
                                                            'product_name'  =>  $service_products_result->product_name,
                                                            'product_added_from'=>  '0',
                                                            'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
                                                        );
                                                    }
                                                }
                                                
                                                $active_offers = $this->Salon_model->get_all_active_offers_all($branch_id,$salon_id);
                                                if(!empty($active_offers)){
                                                    $count = count($active_offers);
                                                    $count = 0;
                                                }else{
                                                    $count = 0;
                                                }
                                                $service_offer_discount = 0;
                                                $single_offer_discount_type = '';
                                                $single_offer_discount = '';
                                                $applied_offer_id = '';
                                                $rewards = '';
                                                $is_offer_applied = '0';
                                                $discount_text = '';
                                                for ($i = 0; $i < $count; $i++) {
                                                    $single_offer_services = explode(',',$active_offers[$i]->service_name);
                                                    if (in_array($services_result->id,$single_offer_services)) {
                                                        $single_offer_discount_type = $active_offers[$i]->discount_in;
                                                        if($single_offer_discount_type == '0'){
                                                            $service_offer_discount = ($services_result->final_price * $active_offers[$i]->discount) / 100;
                                                        }else{
                                                            $service_offer_discount = $active_offers[$i]->discount;
                                                        }
                                                        $single_offer_discount = $active_offers[$i]->discount;
                                                        $rewards = $active_offers[$i]->reward_point;
                                                        $applied_offer_id = $active_offers[$i]->id;
                                                        break;
                                                    }
                                                }

                                                // new discount flow start
                                                $discount_in = '';
                                                $discount_type = '';
                                                $discount_amount_value = '';
                                                $customer_criteria = '';
                                                $discount_type_criteria = '';
                                                $is_discount_applied = '0';

                                                $discount_text = '';
                                                $discount_amount = 0;
                                                $slab_increment = '5';
                                                $slab_consider = '';
                                                $min_slab = '';
                                                $max_slab = '';

                                                $rewards_text = '';

                                                $service_applied_discount = $this->Salon_model->get_customer_service_applied_discount($single->id,$services_result->id);
                                                if($service_applied_discount['is_discount_applied'] == '1'){
                                                    $is_discount_applied = '1';
                                                    $customer_criteria = $service_applied_discount['customer_criteria'];
                                                    $discount_type = $service_applied_discount['discount_type'];
                                                    $discount_in = $service_applied_discount['discount_in'];
                                                    $discount_amount_value = (float)$service_applied_discount['discount_amount'];
                                                    $min_slab = $service_applied_discount['min_flexible'];
                                                    $max_slab = $service_applied_discount['max_flexible'];
                                                    if($discount_type == '1'){    //Flexible
                                                        $customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($single->id,$services_result->id);
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
                                                            $discount_amount = ((float)$slab_consider * (float)$services_result->final_price) / 100;
                                                            $discount_text = $slab_consider . '% Off';
                                                        }elseif($discount_in == '1'){ //flat
                                                            $discount_amount = (float)$slab_consider;
                                                            $discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
                                                        }
                                                    }elseif($discount_type == '0'){   //Fixed
                                                        if($discount_in == '0'){  //percentage
                                                            $discount_amount = ((float)$discount_amount_value * (float)$services_result->final_price) / 100;
                                                            $discount_text = $discount_amount_value . '% Off';
                                                        }elseif($discount_in == '1'){ //flat
                                                            $discount_amount = (float)$discount_amount_value;
                                                            $discount_text = 'Flat Rs. ' . $discount_amount_value . ' Off';
                                                        }
                                                    }

                                                    $rewards_text = 'To Be Earned ' . $discount_amount . ' Reward Points';
                                                }

                                                if($is_discount_applied == '1'){
                                                    if($customer_criteria == '1'){  //for regular customer rewards are given
                                                        $discount_text = $rewards_text;
                                                        $discount_amount = 0;
                                                    }
                                                }
                                                //new discount flow end

                                                $service_price_consider = $services_result->final_price - $discount_amount;
                                                $original_price = $services_result->final_price;

                                                
                                                if($customer_criteria == '0'){
                                                    $discount_type_criteria = 'New Client Benefits';
                                                }elseif($customer_criteria == '1'){
                                                    $discount_type_criteria = 'Regular Client Benefits';
                                                }elseif($customer_criteria == '2'){
                                                    $discount_type_criteria = 'Lost Client Benefits';
                                                }elseif($customer_criteria == '3'){
                                                    $discount_type_criteria = 'Birthday Benefits';
                                                }elseif($customer_criteria == '4'){
                                                    $discount_type_criteria = 'Anniversary Benefits';
                                                }elseif($customer_criteria == '5'){
                                                    $discount_type_criteria = 'Products Marketing Benefits';
                                                }

                                                $services_array[] = array(
                                                    'is_special'        =>  $services_result->is_special,
                                                    'service_id'        =>  $services_result->id,
                                                    'category_id'       =>  $services_result->category,
                                                    'sub_category_id'   =>  $services_result->sub_category,                                        
                                                    'service_name'      =>  $services_result->service_name,
                                                    'service_marathi_name'    =>  $services_result->service_name_marathi,
                                                    'image'             =>  $services_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $services_result->category_image) : '',
                                                    'category_name'     =>  $services_result->sup_category,
                                                    'sub_category_name' =>  $services_result->subcategory,
                                                    'category_marathi_name'     =>  $services_result->sup_category_marathi,
                                                    'sub_category_marathi_name' =>  $services_result->sub_category_marathi,
                                                    'products'          =>  $products,
                                                    'service_description'           =>  strip_tags($services_result->service_description),
                                                    'service_short_description'     =>  strip_tags($services_result->short_description),
                                                    'service_duration'  =>  $services_result->service_duration,
                                                    'reward_points'     =>  $rewards != "" ? $rewards : $services_result->reward_point,

                                                    'original_price'    =>  $original_price,
                                                    'discount_amount'   =>  $discount_amount,
                                                    'discount_type'     =>  $discount_type_criteria,
                                                    'discount_text'     =>  $discount_text,
                                                    'price'             =>  $service_price_consider,
                                                    'is_offer_applied'  =>  $is_offer_applied,
                                                    'applied_offer_id'  =>  $applied_offer_id,
                                                    'service_added_from'=>  '0',
                                                );
                                            }    
                                            $subcat_data[] = array(
                                                'sub_category_id'       =>  $subcategories_result->id,
                                                'sub_category_name'     =>  $subcategories_result->sub_category,
                                                'sub_category_marathi_name'         =>  $subcategories_result->sub_category_marathi,
                                                'sub_category_image'                =>  $subcategories_result->image != "" ? base_url('admin_assets/images/service_category_image/' . $subcategories_result->image) : '',
                                                'services'              =>  $services_array,
                                            );   
                                        }   
                                    }     
                                    $data[] = array(
                                        'category_id'       =>  $categories_result->id,
                                        'category_name'     =>  $categories_result->sup_category,
                                        'category_marathi_name'     =>  $categories_result->sup_category_marathi,
                                        'image'             =>  $categories_result->category_image != "" ? base_url('admin_assets/images/service_category_image/' . $categories_result->category_image) : '',
                                        'sub_categories'    =>  $subcat_data,
                                    );         
                                }   
                            }
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Services not available';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer not found';
                        $json_arr['data'] = [];
                    }       
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Napito services are no longer available for this salon. Please contact the salon directly.';
                    $json_arr['data'] = [];
                }        
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    
    public function get_store_special_services(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $ignore_services = isset($request['ignore_services']) && $request['ignore_services'] != "" && !empty($request['ignore_services']) ? $request['ignore_services'] : [];
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){   
                    $this->db->where('tbl_salon_emp_service.is_special', '1');
                    $this->db->where('tbl_salon_emp_service.status', '1');
                    $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                    if (!empty($ignore_services) && is_array($ignore_services)) {
                        $this->db->where_not_in('tbl_salon_emp_service.id', $ignore_services);
                    }                    
                    $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                    $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                    if($single->gender != ""){
                        $this->db->where('tbl_salon_emp_service.gender',$single->gender);
                    }
                    $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
                    $this->db->from('tbl_salon_emp_service');
                    $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                    $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                    $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');

                    $result = $this->db->get();
                    $services = $result->result();
                    
                    $services_array = [];
                    if(!empty($services)){ 
                        foreach($services as $services_result){
                            $service_products = $this->Salon_model->get_selected_service_products($services_result->product);
                            $products = [];
                            if(!empty($service_products)){
                                foreach($service_products as $service_products_result){
                                    $products[] = array(
                                        'service_id'    =>  $services_result->id,
                                        'product_id'    =>  $service_products_result->id,
                                        'price'         =>  $service_products_result->selling_price,
                                        'product_name'  =>  $service_products_result->product_name,
                                        'product_added_from'=>  '0',
                                        'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
                                    );
                                }
                            }
                            
                            $active_offers = $this->Salon_model->get_all_active_offers_all($branch_id,$salon_id);
                            if(!empty($active_offers)){
                                $count = count($active_offers);
                                $count = 0;
                            }else{
                                $count = 0;
                            }
                            $service_offer_discount = 0;
                            $single_offer_discount_type = '';
                            $single_offer_discount = '';
                            $applied_offer_id = '';
                            $rewards = '';
                            $is_offer_applied = '0';
                            for ($i = 0; $i < $count; $i++) {
                                $single_offer_services = explode(',',$active_offers[$i]->service_name);
                                if (in_array($services_result->id,$single_offer_services)) {
                                    $single_offer_discount_type = $active_offers[$i]->discount_in;
                                    if($single_offer_discount_type == '0'){
                                        $service_offer_discount = ($services_result->final_price * $active_offers[$i]->discount) / 100;
                                    }else{
                                        $service_offer_discount = $active_offers[$i]->discount;
                                    }
                                    $single_offer_discount = $active_offers[$i]->discount;
                                    $rewards = $active_offers[$i]->reward_point;
                                    $applied_offer_id = $active_offers[$i]->id;
                                    break;
                                }
                            }

                            $min_slab = $services_result->min;
                            $max_slab = $services_result->max;
                            $slab_increment = $services_result->slab_increment;
                            $slab_consider = '';
                            $discount_amount = 0;
                            if($services_result->discount_type == '1'){    //Flexible
                                $customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($single->id,$services_result->id);
                                if(!empty($customer_last_service_booking)){                                        
                                    $min_slab = $services_result->min;
                                    $max_slab = $services_result->max;
                                    $slab_increment = $services_result->slab_increment;
                                    $prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;

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
                                    $min_slab = $services_result->min;
                                    $max_slab = $services_result->max;
                                    $slab_increment = $services_result->slab_increment;
                                    $slab_consider = $min_slab;
                                }

                                if($services_result->discount_in == '0'){  //percentage
                                    $discount_amount = ((float)$slab_consider * (float)$services_result->final_price) / 100;
                                }elseif($services_result->discount_in == '1'){ //flat
                                    $discount_amount = (float)$slab_consider;
                                }
                            }elseif($services_result->discount_type == '0'){   //Fixed
                                if($services_result->discount_in == '0'){  //percentage
                                    $discount_amount = ((float)$services_result->service_discount * (float)$services_result->final_price) / 100;
                                }elseif($services_result->discount_in == '1'){ //flat
                                    $discount_amount = (float)$services_result->service_discount;
                                }
                            }

                            $service_price_consider = $services_result->final_price - $discount_amount;
                            $original_price = $services_result->final_price;

                            $services_array[] = array(
                                'is_special'        =>  $services_result->is_special,
                                'service_id'        =>  $services_result->id,
                                'category_id'       =>  $services_result->category,
                                'sub_category_id'   =>  $services_result->sub_category,                                        
                                'service_name'      =>  $services_result->service_name,
                                'service_marathi_name'    =>  $services_result->service_name_marathi,
                                'image'             =>  $services_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $services_result->category_image) : '',
                                'category_name'     =>  $services_result->sup_category,
                                'sub_category_name' =>  $services_result->subcategory,
                                'category_marathi_name'     =>  $services_result->sup_category_marathi,
                                'sub_category_marathi_name' =>  $services_result->sub_category_marathi,
                                'products'          =>  $products,
                                'service_description'     =>  strip_tags($services_result->service_description),
                                'service_duration'  =>  $services_result->service_duration,
                                'reward_points'     =>  $rewards != "" ? $rewards : $services_result->reward_point,

                                'original_price'    =>  $original_price,
                                'discount_amount'   =>  $discount_amount,
                                'price'             =>  $service_price_consider,
                                'is_offer_applied'  =>  $is_offer_applied,
                                'applied_offer_id'  =>  $applied_offer_id,
                                'service_added_from'=>  '0',
                            );
                        }       
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $services_array;   
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Services not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_available_timeslots(){
        $request = json_decode(file_get_contents('php://input'), true);
        $is_show_tabs = '0';
        if($request){
            if(isset($request['branch_id'])){
                $customer_id = $request['customer_id'];

                $slot_type = isset($request['slot_type']) ? $request['slot_type'] : '';
                $slot_thresholds = [
                    'morning'   => ['start' => '05:00:00', 'end' => '12:00:00', 'label' => 'morning_slots'],
                    'afternoon' => ['start' => '12:00:00', 'end' => '17:00:00', 'label' => 'afternoon_slots'],
                    'evening'   => ['start' => '17:00:00', 'end' => '23:00:00', 'label' => 'evening_slots'],
                ];

                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   
                $stylist_id = isset($request['stylist_id']) ? $request['stylist_id'] : '';   
                $reservation_id = isset($request['reservation_id']) ? $request['reservation_id'] : '';   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                $data = array();
                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();                      
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);  
                        if(!empty($rules)){
                            $selected_services = $request['selected_services'];                            

                            $offset = $request['offset'];   
                            $limit = $request['limit']; 

                            $booking_date = $request['booking_date'];   

                            $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_entry($booking_date,$branch_id,$salon_id);
                            
                            if(empty($is_emergency)){
                                $working_hrs = $this->Salon_model->get_saloon_working_hrs_all($booking_date,$branch_id,$salon_id);
                                if($working_hrs['is_allowed'] == 1){
                                    $duration = $rules->slot_time;
                                    $minutes_early_booking = !empty($rules->booking_time_range) ? $rules->booking_time_range : 0;

                                    $store_start = date('Y-m-d H:i:s',strtotime($booking_date.' '.$working_hrs['start']));
                                    $store_end = date('Y-m-d H:i:s',strtotime($booking_date.' '.$working_hrs['end']));

                                    $slot_start_time = $store_start;
                                    $slot_end_time = $store_end;

                                    if (!empty($slot_type) && isset($slot_thresholds[$slot_type])) {
                                        $threshold = $slot_thresholds[$slot_type];

                                        $threshold_start = date('Y-m-d H:i:s', strtotime($booking_date . ' ' . $threshold['start']));
                                        $threshold_end   = date('Y-m-d H:i:s', strtotime($booking_date . ' ' . $threshold['end']));

                                        $slot_start_time = max($store_start, $threshold_start);
                                        $slot_end_time   = min($store_end, $threshold_end);

                                        $slots = $this->Salon_model->generateCommonTimePairs($booking_date, $slot_start_time, $slot_end_time, $duration);

                                        if($limit != ""){
                                            $slots = array_slice($slots, $offset, $limit);
                                        }
                                        
                                        $final_slots = array();
                                        if(!empty($slots)){
                                            foreach ($slots as $slot) {
                                                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                $current_date = date('Y-m-d H:i:s');
                                                if ($current_date <= $allowed_booking_datetime) {
                                                    $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                    if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                        $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_services_all_stylist($slot['from'], $selected_services, $branch_id, $salon_id,$stylist_id, $reservation_id);
                                                        if($is_vacent){
                                                            $is_vacent_flag = '1';
                                                        }else{
                                                            $is_vacent_flag = '0';
                                                        }
                                                        if($is_vacent_flag == '1'){
                                                            $final_slots[] = array(
                                                                'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                'is_vacent' =>  $is_vacent_flag
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                            if(date('H:i:s') > date('H:i:s',strtotime($working_hrs['end']))){
                                                $json_arr['status'] = 'false';
                                                $json_arr['message'] = 'Booking time for today is over. Try another day.';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = [];
                                            }else{
                                                $is_show_tabs = '1';
                                                if (empty($final_slots)) {
                                                    $json_arr['status'] = 'false';
                                                    $json_arr['message'] = ucfirst($slot_type) . ' slots not available';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = [];
                                                } else {
                                                    $data = array(
                                                        $threshold['label'] => $final_slots,
                                                        'limit'             => $limit,
                                                        'offset'            => $limit != "" ? $offset + $limit : '',
                                                    );
                                                    $json_arr['status'] = 'true';
                                                    $json_arr['message'] = 'success';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = $data;
                                                }
                                            }
                                        }else{
                                            $is_show_tabs = '1';
                                            if (empty($final_slots)) {
                                                $json_arr['status'] = 'false';
                                                $json_arr['message'] = ucfirst($slot_type) . ' slots not available';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = [];
                                            } else {
                                                $data = array(
                                                    $threshold['label'] => $final_slots,
                                                    'limit'             => $limit,
                                                    'offset'            => $limit != "" ? $offset + $limit : '',
                                                );
                                                $json_arr['status'] = 'true';
                                                $json_arr['message'] = 'success';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = $data;
                                            }
                                        }
                                    }else{
                                        $slots = $this->Salon_model->generateCommonTimePairs($booking_date,$store_start,$store_end,$duration);                                        
                
                                        $slots_morning = [];
                                        $slots_afternoon = [];
                                        $slots_evening = [];

                                        for($i=0;$i<count($slots);$i++){
                                            $slot_time = date('H:i:s', strtotime($slots[$i]['from']));
                                            if ($slot_time >= '05:00:00' && $slot_time < '12:00:00') {
                                                $slots_morning[] = $slots[$i];
                                            } elseif ($slot_time >= '12:00:00' && $slot_time < '17:00:00') {
                                                $slots_afternoon[] = $slots[$i];
                                            } else {
                                                $slots_evening[] = $slots[$i];
                                            }
                                        }
                                        
                                        // $sliced_morning_slots = array_slice($slots_morning, $offset, $limit);
                                        // $sliced_afternoon_slots = array_slice($slots_afternoon, $offset, $limit);
                                        // $sliced_evening_slots = array_slice($slots_evening, $offset, $limit);

                                        $sliced_morning_slots = $slots_morning;
                                        $sliced_afternoon_slots = $slots_afternoon;
                                        $sliced_evening_slots = $slots_evening;

                                        $morning_slots = array();
                                        if(!empty($sliced_morning_slots)){
                                            foreach ($sliced_morning_slots as $slot) {
                                                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                $current_date = date('Y-m-d H:i:s');
                                                if ($current_date <= $allowed_booking_datetime) {
                                                    $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                    if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                        $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_services_all_stylist($slot['from'], $selected_services, $branch_id, $salon_id,$stylist_id, $reservation_id);
                                                        if($is_vacent){
                                                            $is_vacent_flag = '1';
                                                        }else{
                                                            $is_vacent_flag = '0';
                                                        }
                                                        if($is_vacent_flag == '1'){
                                                            $morning_slots[] = array(
                                                                'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                'is_vacent' =>  $is_vacent_flag
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        $afternoon_slots = array();
                                        if(!empty($sliced_afternoon_slots)){
                                            foreach ($sliced_afternoon_slots as $slot) {
                                                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                $current_date = date('Y-m-d H:i:s');
                                                if ($current_date <= $allowed_booking_datetime) {
                                                    $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                    if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                        $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_services_all_stylist($slot['from'], $selected_services, $branch_id, $salon_id,$stylist_id, $reservation_id);
                                                        if($is_vacent){
                                                            $is_vacent_flag = '1';
                                                        }else{
                                                            $is_vacent_flag = '0';
                                                        }
                                                        if($is_vacent_flag == '1'){
                                                            $afternoon_slots[] = array(
                                                                'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                'is_vacent' =>  $is_vacent_flag
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        $evening_slots = array();
                                        if(!empty($sliced_evening_slots)){
                                            foreach ($sliced_evening_slots as $slot) {
                                                $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                $current_date = date('Y-m-d H:i:s');
                                                if ($current_date <= $allowed_booking_datetime) {
                                                    $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                    if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                        $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_services_all_stylist($slot['from'], $selected_services, $branch_id, $salon_id,$stylist_id, $reservation_id);
                                                        if($is_vacent){
                                                            $is_vacent_flag = '1';
                                                        }else{
                                                            $is_vacent_flag = '0';
                                                        }
                                                        if($is_vacent_flag == '1'){
                                                            $evening_slots[] = array(
                                                                'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                'is_vacent' =>  $is_vacent_flag
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        // if($branch_id == 1){
                                        //     echo '<pre>'; print_r($morning_slots); 
                                        //     echo '<pre>'; print_r($afternoon_slots); 
                                        //     echo '<pre>'; print_r($evening_slots); exit;
                                        // }
                                        
                                        $morning_slots = array_slice($morning_slots, $offset, $limit);
                                        $afternoon_slots = array_slice($afternoon_slots, $offset, $limit);
                                        $evening_slots = array_slice($evening_slots, $offset, $limit);

                                        if (empty($morning_slots) && empty($afternoon_slots) && empty($evening_slots)) {
                                            if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                                if(date('H:i:s') > date('H:i:s',strtotime($working_hrs['end']))){
                                                    $json_arr['status'] = 'false';
                                                    $json_arr['message'] = 'Sorry, all time slots for today are closed. Please book for another day.';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = [];
                                                }else{
                                                    $json_arr['status'] = 'false';
                                                    $json_arr['message'] = 'Sorry, todays slots are full. Please book for another day.';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = [];
                                                }
                                            }else{
                                                $json_arr['status'] = 'false';
                                                $json_arr['message'] = 'Sorry, slots for selected date are full. Please book for another day.';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = [];
                                            }
                                        } else {
                                            $is_show_tabs = '1';
                                            $data = array(
                                                'morning_slots'   => $morning_slots,
                                                'afternoon_slots' => $afternoon_slots,
                                                'evening_slots'   => $evening_slots,
                                                'limit'           => $limit,
                                                'offset'          => $offset + $limit,
                                            );
                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['is_show_tabs'] = $is_show_tabs;
                                            $json_arr['data'] = $data;
                                        }
                                    }
                                }else{
                                    if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Salon is closed today. Book for another day.';
                                        $json_arr['is_show_tabs'] = $is_show_tabs;
                                        $json_arr['data'] = [];
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Salon is closed on ' . date('d M, Y',strtotime($booking_date)) . '. Book for another day.';
                                        $json_arr['is_show_tabs'] = $is_show_tabs;
                                        $json_arr['data'] = [];
                                    }
                                }
                            }else{
                                if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = $is_emergency->reason != "" ? 'Salon is closed today. Reason: ' . $is_emergency->reason : 'Salon is closed today. Please conact salon.';
                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                    $json_arr['data'] = [];
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = $is_emergency->reason != "" ? 'Salon is closed on ' . date('d M, Y',strtotime($booking_date)) . '. Reason: ' . $is_emergency->reason : 'Salon is closed on' . date('d M, Y',strtotime($booking_date)) . '. Please conact salon.';
                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                    $json_arr['data'] = [];
                                }
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['is_show_tabs'] = $is_show_tabs;
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['is_show_tabs'] = $is_show_tabs;
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['is_show_tabs'] = $is_show_tabs;
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID required.';
                $json_arr['is_show_tabs'] = $is_show_tabs;
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['is_show_tabs'] = $is_show_tabs;
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_selected_stylists(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id); 
                        if(!empty($rules)){
                            $selected_services = $request['selected_services'];   
                            $booking_date = $request['booking_date'];   
                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_from']));   
                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_to']));   
                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));

                            $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                            $service_array = [];
                            for($i=0;$i<count($selected_services);$i++){
                                $service = $selected_services[$i];
                                $selected_stylist_id = '';
                                $selected_stylist_name = '';
                                $selected_stylist_designation = '';

                                $this->db->where('id',$service);
                                $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                if (!empty($salon_employee_list)) {
                                    foreach ($salon_employee_list as $result) {
                                        $short_break_flag = '0';
                                        $break_flag = '1';
                                        $shift_flag = '0';
                                        $store_flag = '0';
                                        $booking_flag = '1';
                                        $is_service_available = '0';

                                        $stylist_services = explode(',', $result->service_name);
                                        if (in_array($service, $stylist_services)) {
                                            $is_service_available = '1';
                                        }
                        
                                        $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_storewise) {
                                            $store_flag = '1';
                                        }
                        
                                        $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                        if ($is_emergency) {
                                            $is_emergency_flag = '1';
                                        } else {
                                            $is_emergency_flag = '0';
                                        }
                        
                                        $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                        // $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_shiftwise['is_allowed']) {
                                            $shift_flag = '1';
                                        }
                        
                                        $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_breakwise) {
                                            $break_flag = '0';
                                        }
                        
                                        $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_short_breakwise) {
                                            $short_break_flag = '1';
                                        }
                        
                                        $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_bookingwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_bookingwise) {
                                            $booking_flag = '0';
                                        }
                        
                                        $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                        
                                        $to_be_selected = '0';
                                        if ($is_service_available == '1' && $store_flag == '1' && $is_emergency_flag == '0' && $leave_flag == '0' && $shift_flag == '1' && $booking_flag == '0' && $break_flag == '0' && $short_break_flag == '1') {
                                            $to_be_selected = '1';
                                            $selected_stylist_id = $result->id;
                                            $selected_stylist_name = $result->full_name;
                                            $selected_stylist_designation = $result->designation_name;
                                        }

                                        if($to_be_selected == '1' && $selected_stylist_id != ""){
                                            break;
                                        }
                                    }

                                    if($selected_stylist_id != "" && !empty($single_service)){
                                        $service_array[] = array(
                                            'service_id'                    =>  $service,
                                            'service_name'                  =>  $single_service->service_name,
                                            'service_marathi_name'          =>  $single_service->service_name_marathi,
                                            'selected_stylist_id'           =>  $selected_stylist_id,
                                            'selected_stylist_name'         =>  $selected_stylist_name,
                                            'selected_stylist_designation'  =>  $selected_stylist_designation,
                                            
                                            'selected_stylist_shift_id'     =>  $is_stylist_available_shiftwise['shift_id'],
                                            'selected_stylist_shift_type'   =>  $is_stylist_available_shiftwise['shift_type']
                                        );
                                    }
                                }
                            }

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $service_array;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not found';
                        $json_arr['data'] = [];
                    } 
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }              
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_selected_service_stylists(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
                        if(!empty($rules)){
                            $rules_employee_selection = $rules->employee_selection;
                            
                            $selected_services = $request['selected_services'];   
                            $booking_date = $request['booking_date'];   
                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_from']));   
                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_to']));   
                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));

                            $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                            $service_array = [];
                            $pre_selected = '';
                            $pre_selected_flag = false;
                            $empty_selected_stylist_flag = '0';
                            for($i=0;$i<count($selected_services);$i++){
                                $service = $selected_services[$i];

                                $this->db->where('id',$service);
                                $this->db->where('salon_id', $salon_id);
                                $this->db->where('branch_id', $branch_id);
                                $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                if (!empty($single_service)) {
                                    $available_employees = [];
                                    $selected_stylists = array();

                                    $service_from_datetime = new DateTime($selectedfrom);
                                    $service_to_datetime = new DateTime($selectedfrom);

                                    $service_duration = $single_service->service_duration;
                                    $interval = new DateInterval("PT{$service_duration}M");
                                    $service_to_datetime->add($interval);

                                    $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                    $is_service_stylist_selected = '0';
                                    if (!empty($salon_employee_list)) {
                                        foreach ($salon_employee_list as $result) {
                                            $stylist_services = explode(',', $result->service_name);
                                            if (in_array($service, $stylist_services)) {
                                                $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                if ($is_stylist_available_storewise) {
                                                    $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                    if (!$is_emergency) {
                                                        // $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                        $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                        if ($is_stylist_available_shiftwise['is_allowed']) {
                                                            $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_breakwise) {
                                                                $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_short_breakwise) {
                                                                    $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_bookingwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                    if ($is_stylist_available_bookingwise) {
                                                                        $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                        if($leave_flag == '0'){
                                                                            $is_selected = '0';
                                                                            if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                $is_selected = '1';
                                                                                $pre_selected = $result->id;
                                                                                $pre_selected_flag = true;
                                                                            }

                                                                            $single_service_emp = array(
                                                                                'stylist_id'            => $result->id,
                                                                                'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                'stylist_name'          => $result->full_name,
                                                                                'stylist_designation'   => $result->designation_name,
                                                                                'profile_photo'         => $result->profile_photo != "" ? base_url('admin_assets/images/employee_profile/' . $result->profile_photo) : '',
                                                                                'is_selected'           => $rules_employee_selection == '2' ? '0' : $is_selected,
                                                                            );

                                                                            $available_employees[] = $single_service_emp;

                                                                            if($is_selected == '1'){
                                                                                $selected_stylists = $single_service_emp;
                                                                                $is_service_stylist_selected = '1';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }                                                
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if(empty($selected_stylists)){
                                        if($empty_selected_stylist_flag == '0'){
                                            $empty_selected_stylist_flag = '1';
                                        }
                                    }
                                    $service_array[] = array(
                                        'service_id'                    =>  $service,
                                        'service_name'                  =>  $single_service->service_name,
                                        'service_marathi_name'          =>  $single_service->service_name_marathi,
                                        'image'                         =>  $single_service->category_image != "" ? base_url('admin_assets/images/service_image/' . $single_service->category_image) : '',
                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                        'service_to'                    =>  $service_to,
                                        'is_service_stylist_selected'   =>  $is_service_stylist_selected,
                                        'selected_stylists'             =>  $selected_stylists,
                                        'available_stylists'            =>  $available_employees
                                    );
                                    $selectedfrom = $service_to;
                                }
                            }

                            if($rules_employee_selection == '2'){
                                $is_stylist_selection_page = '1';
                            }else{
                                $is_stylist_selection_page = '0';
                            }

                            if($empty_selected_stylist_flag == '1'){
                                $is_stylist_selection_page = '1';
                            }

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            // $json_arr['data'] = array(
                            //     'is_stylist_selection_page'     => $is_stylist_selection_page, 
                            //     'stylist_selection_data'        => $service_array 
                            // );
                            $json_arr['data'] = $service_array;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_stylist_selection_page_flag(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
                        if(!empty($rules)){
                            $rules_employee_selection = $rules->employee_selection;
                            
                            $selected_services = $request['selected_services'];   
                            $booking_date = $request['booking_date'];   
                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_from']));   
                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$request['selected_slot_to']));   
                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));

                            $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                            $service_array = [];
                            $pre_selected = '';
                            $pre_selected_flag = false;
                            $empty_selected_stylist_flag = '0';
                            for($i=0;$i<count($selected_services);$i++){
                                $service = $selected_services[$i];

                                $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi');
                                $this->db->where('tbl_salon_emp_service.id',$service);
                                $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                if (!empty($single_service)) {
                                    $available_employees = [];
                                    $selected_stylists = array();

                                    $service_from_datetime = new DateTime($selectedfrom);
                                    $service_to_datetime = new DateTime($selectedfrom);

                                    $service_duration = $single_service->service_duration;
                                    $interval = new DateInterval("PT{$service_duration}M");
                                    $service_to_datetime->add($interval);

                                    $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                    $is_service_stylist_selected = '0';
                                    if (!empty($salon_employee_list)) {
                                        foreach ($salon_employee_list as $result) {
                                            $stylist_services = explode(',', $result->service_name);
                                            if (in_array($service, $stylist_services)) {
                                                $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                if ($is_stylist_available_storewise) {
                                                    $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                    if (!$is_emergency) {
                                                        // $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                        $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                        if ($is_stylist_available_shiftwise['is_allowed']) {
                                                            $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_breakwise) {
                                                                $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_short_breakwise) {
                                                                    $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_bookingwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                    if ($is_stylist_available_bookingwise) {
                                                                        $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                        if($leave_flag == '0'){
                                                                            $is_selected = '0';
                                                                            if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                $is_selected = '1';
                                                                                $pre_selected = $result->id;
                                                                                $pre_selected_flag = true;
                                                                            }

                                                                            $single_service_emp = array(
                                                                                'stylist_id'            => $result->id,
                                                                                'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                'stylist_name'          => $result->full_name,
                                                                                'is_selected'           => $rules_employee_selection == '2' ? '0' : $is_selected,
                                                                            );

                                                                            $available_employees[] = $single_service_emp;

                                                                            if($is_selected == '1'){
                                                                                $selected_stylists = $single_service_emp;
                                                                                $is_service_stylist_selected = '1';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }                                                
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if(empty($selected_stylists)){
                                        if($empty_selected_stylist_flag == '0'){
                                            $empty_selected_stylist_flag = '1';
                                        }
                                    }
                                    $service_array[] = array(
                                        'service_id'                    =>  $service,
                                        'service_name'                  =>  $single_service->service_name,
                                        'sup_category'                  =>  $single_service->sup_category,
                                        'sup_category_marathi'          =>  $single_service->sup_category_marathi,
                                        'sub_category'                  =>  $single_service->sub_category,
                                        'sub_category_marathi'          =>  $single_service->sub_category_marathi,
                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                        'service_to'                    =>  $service_to,
                                        'is_service_stylist_selected'   =>  $is_service_stylist_selected,
                                        'selected_stylists'             =>  $selected_stylists,
                                    );
                                    $selectedfrom = $service_to;
                                }
                            }

                            if($rules_employee_selection == '2'){
                                $is_stylist_selection_page = '1';
                            }else{
                                $is_stylist_selection_page = '0';
                            }

                            if($empty_selected_stylist_flag == '1'){
                                $is_stylist_selection_page = '1';
                            }

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = array(
                                'is_stylist_selection_page'     => $is_stylist_selection_page, 
                                'service_stylists_data'         => $service_array 
                            );
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking rules not available, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function set_booking(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){                         
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id']; 
                $selected_stylist = '';               

                $profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                if(!empty($profile)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id',$customer_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();
                    if(!empty($single)){ 
                        $booking_date = $request['booking_date'];
                        $slot_from = $request['selected_slot_from'];
                        $slot_to = $request['selected_slot_to'];
                        $services = $request['selected_services'];
                        if($booking_date != "" && $slot_from != ""){    
                            $selected_stylist_id = isset($request['selected_stylist_id']) ? $request['selected_stylist_id'] : "";
                            $packages_details = isset($request['packages_details']) ? $request['packages_details'] : "";
                            $membership_details = isset($request['membership_details']) ? $request['membership_details'] : '';
                            $rewards_details = isset($request['reward_details']) ? $request['reward_details'] : '';
                            $note = $request['note'];

                            $offer_details = isset($request['offer_details']) ? $request['offer_details'] : [];
                            $coupon_details = isset($request['coupon_details']) ? $request['coupon_details'] : [];
                            $giftcard_details = isset($request['giftcard_details']) ? $request['giftcard_details'] : [];

                            $is_offer_applied = '0';
                            $applied_offer_id = '';
                            if($offer_details != "" && is_array($offer_details) && !empty($offer_details)){
                                $is_offer_applied = $offer_details['is_offer_applied'];
                                if($is_offer_applied == '1'){
                                    $applied_offer_id = $offer_details['applied_offer_id'];
                                }
                            }

                            $giftcard_discount = 0;
                            $is_giftcard_applied = '0';
                            $applied_giftcard_id = '';
                            $giftcard_owner_id = '';
                            if($giftcard_details != "" && is_array($giftcard_details) && !empty($giftcard_details)){
                                $is_giftcard_applied = $giftcard_details['is_giftcard_applied'];
                                if($is_giftcard_applied == '1'){
                                    $applied_giftcard_id = $giftcard_details['applied_giftcard_id'];
                                    $giftcard_owner_id = $giftcard_details['giftcard_owner_id'];
                                }
                            }

                            $all_services = [];
                            $all_products = [];
                            $giftcard = [];
                            $total_service_amount = 0;
                            $total_product_amount = 0;
                            if($services != "" && is_array($services) && !empty($services)){
                                for($i=0;$i<count($services);$i++){
                                    if($services[$i]['service_id'] != ""){  
                                        $booking_date = date('Y-m-d',strtotime($booking_date));
                                        $slot_from = date('H:i:s',strtotime($slot_from));
                                        list($year, $month, $day) = explode('-', $booking_date);
                                        list($hour, $minute, $second) = explode(':', $slot_from);
                                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                                        $selected_slot_from = date('Y-m-d H:i:s', $timestamp);
                                        for($i=0;$i<count($services);$i++){
                                            if($services[$i]['service_id'] != ""){
                                                $service_id = $services[$i]['service_id'];
                                                $this->db->where('tbl_salon_emp_service.branch_id',$branch_id);
                                                $this->db->where('tbl_salon_emp_service.salon_id',$salon_id);
                                                $this->db->where('tbl_salon_emp_service.id',$service_id);
                                                $this->db->where('tbl_salon_emp_service.is_deleted','0');
                                                $single_service = $this->db->get('tbl_salon_emp_service');
                                                $single_service = $single_service->row();
                                                if(!empty($single_service)){
                                                    $service_duration = (int)$single_service->service_duration;
                                                    $service_from = $selected_slot_from;
                                                    $service_to = date('Y-m-d H:i:s', strtotime("+$service_duration minutes", strtotime($service_from)));

                                                    $services[$i]['service_from'] = $service_from;
                                                    $services[$i]['service_to'] = $service_to;
                                                    $services[$i]['service_duration'] = $service_duration;

                                                    $selected_slot_from = $service_to;

                                                    $service_added_from = $services[$i]['service_added_from'];
                                                    if($service_added_from == '1'){
                                                        if($i == 0){
                                                            $packages_details = array(
                                                                'selected_package_id'               =>  $services[$i]['selected_package_id'],
                                                                'selected_package_allocation_id'    =>  $services[$i]['selected_package_allocation_id'],
                                                                'is_old_package'                    =>  $services[$i]['is_old_package'],
                                                            );
                                                        }
                                                    }

                                                    if($service_added_from == '0'){
                                                        $service_price = floatval($services[$i]['price']);
                                                        $total_service_amount += $service_price;
                                                    }else{
                                                        $total_service_amount += floatval($services[$i]['price']);
                                                    }

                                                    $all_services[] = $services[$i]['service_id'];
                                                    if($services[$i]['products'] != "" && is_array($services[$i]['products']) && !empty($services[$i]['products'])){
                                                        for($j=0;$j<count($services[$i]['products']);$j++){
                                                            if($services[$i]['products'][$j]['productId'] != ""){
                                                                $all_products[] = $services[$i]['products'][$j]['productId'];
                                                                $total_product_amount += floatval($services[$i]['products'][$j]['productPrice']);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            // echo $total_service_amount; exit;
                            $is_membership_payment_included = '0';
                            $mem_service_discount_amt = 0;
                            $mem_product_discount_amt = 0;
                            $membership_amount = 0;
                            $membership_discount_type = '';
                            $membership_service_discount = '';
                            $membership_product_discount = '';
                            $is_old_member = '0';
                            $membership_id = '';
                            $is_membership_booking = '0';
                            if($membership_details != "" && is_array($membership_details) && !empty($membership_details)){
                                $membership_id = $membership_details['membership_id'];
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$membership_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $membership_data = $this->db->get('tbl_memebership')->row();
                                if(!empty($membership_data)){ 
                                    $is_membership_booking = '1';
                                    $is_old_member = $membership_details['is_old_member'];
                                    if($is_old_member == '1'){
                                        $membership_allocation_id = $membership_details['membership_allocation_id'];
                                        $this->db->where('is_deleted','0');
                                        $this->db->where('id',$membership_allocation_id);
                                        $this->db->where('membership_id',$membership_id);
                                        $this->db->where('customer_id',$customer_id);
                                        $membership_details = $this->db->get('tbl_customer_membership_history')->row();
                                        if(!empty($membership_details)){
                                            $membership_discount_type = $membership_details->discount_in;
                                            $membership_service_discount = $membership_details->service_discount;
                                            $membership_product_discount = $membership_details->product_discount;
                                            if($membership_discount_type == '0'){
                                                $mem_service_discount_amt = ($total_service_amount * $membership_service_discount) / 100;
                                                $mem_product_discount_amt = ($total_product_amount * $membership_product_discount) / 100;
                                            }elseif($membership_discount_type == '1'){
                                                $mem_service_discount_amt = $membership_service_discount;
                                                $mem_product_discount_amt = $membership_product_discount;
                                            }

                                            if($membership_details->payment_status == '0'){
                                                $membership_amount = $membership_details->membership_price;
                                                $is_membership_payment_included = '1';
                                            }
                                        }
                                    }else{
                                        $membership_discount_type = $membership_data->discount_in;
                                        $membership_service_discount = $membership_data->service_discount;
                                        $membership_product_discount = $membership_data->product_discount;
                                        if($membership_discount_type == '0'){
                                            $mem_service_discount_amt = ($total_service_amount * $membership_service_discount) / 100;
                                            $mem_product_discount_amt = ($total_product_amount * $membership_product_discount) / 100;
                                        }elseif($membership_discount_type == '1'){
                                            $mem_service_discount_amt = $membership_service_discount;
                                            $mem_product_discount_amt = $membership_product_discount;
                                        }

                                        $membership_amount = $membership_data->membership_price;
                                        $is_membership_payment_included = '1';
                                    }
                                }
                            }  

                            $package_amount = 0;
                            $selected_package_id = '';
                            $is_package_included = '0';
                            $is_old_package = '0';
                            $selected_package_allocation_id = '';
                            if($packages_details != "" && is_array($packages_details) && !empty($packages_details)){
                                $selected_package_id = $packages_details['selected_package_id'];

                                $this->db->where('tbl_package.id',$selected_package_id);
                                $this->db->where('tbl_package.branch_id',$branch_id);
                                $this->db->where('tbl_package.salon_id',$salon_id);
                                $this->db->where('tbl_package.is_deleted','0');
                                $single_package_details = $this->db->get('tbl_package');
                                $single_package_details = $single_package_details->row();
                                if(!empty($single_package_details)){
                                    $is_package_included = '1';
                                    $is_old_package = $packages_details['is_old_package'];

                                    if($is_old_package == '1'){
                                        $selected_package_allocation_id = $packages_details['selected_package_allocation_id'];
                                        
                                        $this->db->select('tbl_customer_package_allocations.*, tbl_package.package_name, tbl_package.bg_color, tbl_package.text_color');
                                        $this->db->join('tbl_package', 'tbl_package.id = tbl_customer_package_allocations.package_id');
                                        $this->db->where('tbl_customer_package_allocations.id',$selected_package_allocation_id);
                                        $this->db->where('tbl_customer_package_allocations.package_id',$selected_package_id);
                                        $this->db->where('tbl_customer_package_allocations.customer_name',$customer_id);
                                        $this->db->where('tbl_customer_package_allocations.is_deleted','0');
                                        $single_package = $this->db->get('tbl_customer_package_allocations');
                                        $single_package = $single_package->row();
        
                                        if(!empty($single_package)){
                                            if($single_package->is_booking_done == '0'){
                                                $package_amount = $single_package->package_amount;
                                            }
                                        }
                                    }else{
                                        $package_amount = $single_package_details->amount;
                                    }
                                }
                            }

                            $service_payable_amount = floatval($total_service_amount) - floatval($mem_service_discount_amt);
                            $product_payable_amount = floatval($total_product_amount) - floatval($mem_product_discount_amt);
                            
                            $payable_amount = floatval($service_payable_amount) + floatval($product_payable_amount) + floatval($package_amount) + floatval($membership_amount);

                            if($is_giftcard_applied == '1'){      
                                $this->db->where('type','3');
                                $this->db->where('is_deleted','0');
                                $this->db->where('gift_card_status','0');
                                // $this->db->where('customer_id',$single->id);
                                $this->db->where('id',$applied_giftcard_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $giftcard_result = $this->db->get('tbl_booking_payment_entry')->row();

                                // $this->db->where('id',$applied_giftcard_id);
                                // $this->db->where('is_deleted','0');
                                // $this->db->where('branch_id', $branch_id);
                                // $this->db->where('salon_id', $salon_id);
                                // $giftcard_result = $this->db->get('tbl_gift_card')->row();
                                
                                $is_valid = '0';
                                $is_new = '';
                                $min_amount = '';
                                $considered_amount = '';
                                $giftcard_redemption_id = '';
                                if(!empty($giftcard_result)){
                                    $gift_card_status = $this->Salon_model->check_giftcard_redemption_all($giftcard_result->id,$single->id,$giftcard_result->giftcard_id,$branch_id,$salon_id);
                                    if(!empty($gift_card_status)){
                                        $considered_amount = $gift_card_status->gift_card_balance != "" ? $gift_card_status->gift_card_balance : '0';
                                        $min_amount = $gift_card_status->giftcard_min_amount != "" ? $gift_card_status->giftcard_min_amount : '0';
                                        $is_new = '0';
                                        $giftcard_redemption_id = $gift_card_status->id;
                                    }else{
                                        $considered_amount =  $giftcard_result->gift_price != "" ? $giftcard_result->gift_price : '0';
                                        $min_amount =  $giftcard_result->min_booking_amt != "" ? $giftcard_result->min_booking_amt : '0';
                                        $is_new = '1';
                                    }
                                    $is_valid = '1';
                                }
                                if($is_new == '0'){
                                    if($is_valid == '1'){
                                        // if($payable_amount >= $min_amount){
                                            if($considered_amount >= $payable_amount){
                                                $giftcard_discount = $payable_amount;                                                        
                                            }else{
                                                $giftcard_discount = $considered_amount;       
                                            }
                                        // }
                                    }else{                                    
                                        $is_giftcard_applied = '0';
                                    }
                                }else{
                                    $is_giftcard_applied = '0';
                                }
                            }   

                            $coupon_discount_amount = 0;
                            $is_coupon_applied = '0';
                            $applied_coupon_id = '';
                            if($coupon_details != "" && is_array($coupon_details) && !empty($coupon_details)){
                                $is_coupon_applied = $coupon_details['is_coupon_applied'];
                                if($is_coupon_applied == '1'){
                                    $applied_coupon_id = $coupon_details['applied_coupon_id'];
                                    $this->db->where('tbl_coupon_code.id',$applied_coupon_id);
                                    $this->db->where('tbl_coupon_code.branch_id',$branch_id);
                                    $this->db->where('tbl_coupon_code.salon_id',$salon_id);
                                    $this->db->where('tbl_coupon_code.is_deleted','0');
                                    $this->db->where('DATE(tbl_coupon_code.coupan_expiry) >=',date('Y-m-d'));
                                    $single_coupon_details = $this->db->get('tbl_coupon_code');
                                    $single_coupon_details = $single_coupon_details->row();
                                    if(!empty($single_coupon_details)){
                                        if($payable_amount >= $single_coupon_details->min_price){
                                            $coupon_discount_amount = $single_coupon_details->coupon_offers;
                                            $is_coupon_applied = '1';
                                        }
                                    }
                                }
                            }
                              
                            $total_offer_discount = 0;
                            $is_final_offer_applied = '0';
                            if($is_offer_applied == '1'){ 
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('validity_status','1');
                                $this->db->where('id',$applied_offer_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $offer_data = $this->db->get('tbl_offers')->row();
                                if(!empty($offer_data)){   
                                    $input_service_ids = [];

                                    $service_offer_discount = $offer_data->discount;
                                    $service_offer_discount_type = $offer_data->discount_in;

                                    $offer_services = $offer_data->service_name != "" ? explode(',',$offer_data->service_name) : [];
                                    foreach ($services as $srv) {
                                        if (!empty($srv['service_id'])) {
                                            $input_service_ids[] = $srv['service_id'];
                                        }
                                    }

                                    $diff = array_diff($offer_services, $input_service_ids);
                                    if (empty($diff)) {
                                        $is_final_offer_applied = '1';
                                    }
                                    
                                    for($i=0;$i<count($services);$i++){
                                        $service_offer_discount_amount = 0;
                                        if($services[$i]['service_id'] != ""){
                                            if ($is_final_offer_applied == '1' && in_array($services[$i]['service_id'], $offer_services)) {
                                                if($service_offer_discount_type == '0'){
                                                    $service_offer_discount_amount = ($services[$i]['price'] * $service_offer_discount) / 100;
                                                }elseif($service_offer_discount_type == '1'){
                                                    $service_offer_discount_amount = $service_offer_discount;
                                                }
                                            }
                                        }
                                        $total_offer_discount += ($is_final_offer_applied == '1' ? $service_offer_discount_amount : 0);
                                    } 
                                }
                            }
                            $is_offer_applied = $is_final_offer_applied;

                            $used_rewards = 0;
                            $reward_discount = 0;
                            $is_reward_applied = '0';
                            if($rewards_details != "" && !empty($rewards_details)){
                                $is_reward_applied = $rewards_details['is_reward_applied'];
                                if($is_reward_applied == '1'){
                                    $used_rewards = $rewards_details['used_rewards'];
                                    $reward_discount = $rewards_details['reward_discount'];
                                }
                            }

                            $total_discount_hidden = floatval($reward_discount) + floatval($mem_service_discount_amt) + floatval($mem_product_discount_amt) + floatval($coupon_discount_amount) + floatval($giftcard_discount) + floatval($total_offer_discount);                        

                            // $booking_amount = floatval($payable_amount);
                            $booking_amount = floatval($payable_amount) - (floatval($reward_discount) + floatval($coupon_discount_amount) + floatval($giftcard_discount) + floatval($total_offer_discount));
                                                        
                            $is_gst_applicable = '0';
                            $gst_no = '';
                            $gst_rate = 0;
                            if($profile->is_gst_applicable == '1'){
                                $gst_no = $profile->gst_no;
                                $is_gst_applicable = '1';
                                $setup = $this->Master_model->get_backend_setups();	
                                if(!empty($setup)){
                                    $gst_rate = $setup->gst_rate;
                                }
                            }
                            $gst_amount = ($booking_amount * ((float)$gst_rate)) / 100;
                            $grand_total_amount = floatval($booking_amount) + floatval($gst_amount);
                                                
                            $booking_rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
                            $employee_selection_rule = !empty($booking_rules) ? $booking_rules->employee_selection : '';
                            $booking_data = array(
                                'booking_generated_from'=> '1',
                                'branch_id' 			=> $branch_id,
                                'salon_id' 				=> $salon_id,
                                'stylist_id' 	        => $employee_selection_rule == '2' && $selected_stylist_id != '' ? $selected_stylist_id : null,
                                'customer_name' 		=> $customer_id,
                                'booking_type' 		    => '0',

                                'is_membership_booking' => $is_membership_booking,
                                'membership_id' 		=> $membership_id,
                                'membership_discount_type'	=> $membership_discount_type,
                                'm_service_discount'	=> $membership_service_discount,
                                'm_product_discount' 	=> $membership_product_discount,
                                'm_service_discount_amount'	    => $mem_service_discount_amt,
                                'm_product_discount_amount' 	=> $mem_product_discount_amt,
                                'membership_amount' 	=> $membership_amount,
                                'is_membership_payment_included' 	=> $is_membership_payment_included,

                                'is_package_included'	=> $is_package_included,
                                'pacakge_id' 			=> $selected_package_id,
                                'package_amount' 		=> $package_amount,
                                
                                'selected_coupon_id' 	=> $is_coupon_applied == '1' ? $applied_coupon_id : null,

                                'is_giftcard_applied' 	=> $is_giftcard_applied,
                                'applied_giftcard_id'   => ($is_giftcard_applied == '1') ? $applied_giftcard_id : '',
                                'applied_giftcard_owner_id' => ($is_giftcard_applied == '1') ? $giftcard_owner_id : '',
                                'gift_discount'         => ($is_giftcard_applied == '1') ? $giftcard_discount : '',
                                'is_new_giftcard_applied'   => ($is_giftcard_applied == '1') ? $is_new : '',
                                'giftcard_redemption_id'    => ($is_giftcard_applied == '1') ? $giftcard_redemption_id : '',
                                
                                'is_offer_booking' 	    =>  $is_offer_applied,
                                'applied_offer_id'      => ($is_offer_applied == '1') ? $applied_offer_id : '',
                                'offer_discount_amount' => ($is_offer_applied == '1') ? $total_offer_discount : '',
                                
                                'total_service_price'   => $total_service_amount,
                                'total_product_price'   => $total_product_amount,
                                'service_price'         => $service_payable_amount,
                                'product_price'         => $product_payable_amount,
                                'payble_price'          => $payable_amount,
                                'coupon_discount_amount'=> $coupon_discount_amount,

                                'reward_discount_amount'=> $reward_discount,
                                'used_rewards'          => $used_rewards,
                                'is_reward_applied'     => $is_reward_applied,

                                'total_discount_amount' => $total_discount_hidden,
                                'booking_amount'        => $booking_amount,
                                'gst_amount'            => $gst_amount,
                                'amount_to_paid'        => $grand_total_amount,
                                
                                'is_gst_applicable'     => $is_gst_applicable == '1' ? $is_gst_applicable : '0',
                                'salon_gst_no'          => $gst_no,
                                'salon_gst_rate'        => $gst_rate,

                                'reminder' 				=> null,
                                'note'   				=> $note,
                                'booking_date'          => date("Y-m-d"),
                                'service_start_date'    => date("Y-m-d",strtotime($booking_date)),
                                'service_start_time'    => date("H:i:s",strtotime($slot_from)),
                                'created_on'            => date("Y-m-d H:i:s"),                            

                                'original_services'     => $all_services != "" && is_array($all_services) && !empty($all_services) ? implode(',',$all_services) : '',
                                'original_products' 	=> $all_products != "" && is_array($all_products) && !empty($all_products) ? implode(',',$all_products) : '',
                                'services' 		        => $all_services != "" && is_array($all_services) && !empty($all_services) ? implode(',',$all_services) : '',
                                'products' 		        => $all_products != "" && is_array($all_products) && !empty($all_products) ? implode(',',$all_products) : '',
                            );
                            // echo '<pre>'; print_r($booking_data); exit();
                            $valid_booking_short_breakwise = $this->Salon_model->validate_booking_short_breakwise($services,$branch_id,$salon_id);
                            if($valid_booking_short_breakwise == 1){
                                $valid_booking = $this->Salon_model->validate_booking($services,$branch_id,$salon_id);
                                // $valid_booking = 1 ;
                                if($valid_booking == 1){
                                    $this->db->insert('tbl_new_booking', $booking_data);
                                    $booking_id = $this->db->insert_id();
                            
                                    $order_counts = $this->Salon_model->get_saloon_branch_total_orders($salon_id,$branch_id);
                                    $branch_formatted = sprintf('%03d', $branch_id);
                                    $salon_formatted = sprintf('%03d', $salon_id);
                                    $count_formatted = sprintf('%04d', ($order_counts + 1));
                                    $invoice_no = $branch_formatted.$salon_formatted.$count_formatted;
                            
                                    $update_data = array(
                                        'receipt_no'    =>  $invoice_no,
                                    );
                                    $this->db->where('id',$booking_id);
                                    $this->db->update('tbl_new_booking',$update_data);                        
                                    
                                    //insert giftcard redemption data
                                    // if($is_giftcard_applied == '1'){
                                    //     $redemption_history = array(
                                    //         'booking_id'        =>  $booking_id,
                                    //         'redeemed_amount'   =>  $giftcard_discount,
                                    //         'redeemed_on'       =>  date('d-m-Y H:i:s')
                                    //     );
                                    //     if($is_new == '1'){
                                    //         $this->db->where('branch_id',$branch_id);
                                    //         $this->db->where('salon_id',$salon_id);
                                    //         $this->db->where('id',$applied_giftcard_id);
                                    //         $this->db->where('is_deleted','0');
                                    //         $single_giftcard = $this->db->get('tbl_gift_card')->row();
                                    //         if(!empty($single_giftcard)){
                                    //             $gift_card_balance = $single_giftcard->gift_price - $giftcard_discount;
                                    //             if($gift_card_balance > 0){
                                    //                 $gift_card_status = '0';
                                    //             }elseif($gift_card_balance == 0){
                                    //                 $gift_card_status = '1';
                                    //                 $gift_card_balance = '0';
                                    //             }else{
                                    //                 $gift_card_status = '1';
                                    //                 $gift_card_balance = '0';
                                    //             }
                                    //             $giftcard_gst = ((float)$single_giftcard->regular_price * (float)$gst_rate)/100;
                                    //             $giftcard_data = array(
                                    //                 'branch_id' 			=> $branch_id,
                                    //                 'salon_id' 				=> $salon_id,
                                    //                 'booking_id' 		    => $booking_id,
                                    //                 'payment_from'          => '1', 
                                    //                 'type'                  => '3',
                                    //                 'customer_id' 		    => $customer_id,
                                                    
                                    //                 'giftcard_id' 	        => $single_giftcard->id,
                                    //                 'gift_card_name' 	    => $single_giftcard->gift_name,
                                    //                 'gift_card_code' 	        => $single_giftcard->gift_card_code,
                                    //                 'giftcard_min_amount' 	    => $single_giftcard->min_booking_amt,
                                    //                 'gift_card_regular_price' 	=> $single_giftcard->regular_price,
                                    //                 'gift_card_price' 	        => $single_giftcard->gift_price,
                                    //                 'gift_card_balance' 	    => $gift_card_balance,
                                    //                 'gift_card_status' 	        => $gift_card_status,
                                    //                 'redemption_history'        => !empty($redemption_history) ? json_encode($redemption_history) : '',
                                    //                 'created_on'                => date("Y-m-d H:i:s"),                                            
                                            
                                    //                 'paid_amount' 	            => $single_giftcard->regular_price + $giftcard_gst,
                                                    
                                    //                 'is_gst_applicable'         => $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                    //                 'salon_gst_no' 	            => $gst_no, 
                                    //                 'salon_gst_rate' 	        => $gst_rate, 
                                    //                 'gst_amount' 	            => $giftcard_gst, 
        
                                    //                 'payment_date'              => date("Y-m-d H:i:s"),
                                    //             );
                                    //             $this->db->insert('tbl_booking_payment_entry', $giftcard_data);
                                    //             $giftcard_payment_id = $this->db->insert_id();
                    
                                    //             $giftcard_customer_uid = $single_giftcard->gift_card_code . '' . $giftcard_payment_id . '' . date("YmdHis"); 
                                    //             $this->db->where('id',$giftcard_payment_id);
                                    //             $this->db->update('tbl_booking_payment_entry',array('giftcard_customer_uid'=>$giftcard_customer_uid));
                                    //         }
                                    //     }else{
                                    //         $this->db->where('branch_id',$branch_id);
                                    //         $this->db->where('salon_id',$salon_id);
                                    //         $this->db->where('customer_id',$customer_id);
                                    //         $this->db->where('type','3');
                                    //         $this->db->where('is_deleted','0');
                                    //         $this->db->where('id',$giftcard_redemption_id);
                                    //         $single_giftcard_redemption = $this->db->get('tbl_booking_payment_entry')->row();
                                    //         if(!empty($single_giftcard_redemption)){
                                    //             $current_redemption_history = json_decode($single_giftcard_redemption->redemption_history);
                                    //             $current_redemption_history[] = $redemption_history;
                    
                                    //             $gift_card_balance = $single_giftcard_redemption->gift_card_balance - $giftcard_discount;
                                    //             if($gift_card_balance > 0){
                                    //                 $gift_card_status = '0';
                                    //             }elseif($gift_card_balance == 0){
                                    //                 $gift_card_status = '1';
                                    //                 $gift_card_balance = '0';
                                    //             }else{
                                    //                 $gift_card_status = '1';
                                    //                 $gift_card_balance = '0';
                                    //             }
                                                
                                    //             $giftcard_data = array(
                                    //                 'gift_card_balance' 	        => $gift_card_balance,
                                    //                 'gift_card_status' 	        => $gift_card_status,
                                    //                 'redemption_history'        => !empty($current_redemption_history) ? json_encode($current_redemption_history) : ''
                                    //             );
                                    //             $this->db->where('id',$single_giftcard_redemption->id);
                                    //             $this->db->update('tbl_booking_payment_entry', $giftcard_data);
                                    //         }
                                    //     }
                                    // }
        
                                    // insert new membership details
                                    if($is_membership_booking == '1' && $is_old_member == "0"){
                                        $this->db->where('is_deleted','0');
                                        $this->db->where('status','1');
                                        $this->db->where('id',$membership_id);
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('salon_id', $salon_id);
                                        $membership_data = $this->db->get('tbl_memebership')->row();
                                        if(!empty($membership_data)){ 
                                            $duration_months = $membership_data->duration;
                                            $membership_start = date("Y-m-d");
                                            $membership_end = date("Y-m-d", strtotime("+" . $duration_months . " months", strtotime($membership_start)));
        
                                            $data1 = array(
                                                'buy_from' 		    => '1',
                                                'branch_id' 		=> $branch_id,
                                                'salon_id' 			=> $salon_id,
                                                'customer_id' 		=> $customer_id,
                                                'membership_id' 	=> $membership_data->id, 
                                                'employee_id' 	    => '', 
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
                                                'payment_mode' 	    => 'Online', 
                                                'payment_status'    => '1',
                                                'payment_in_booking_id'  =>  $booking_id,
                                                'payment_on'        => date("Y-m-d H:i:s"),
                                                'payment_date'      => date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
                                            ); 
                                            $this->db->insert('tbl_customer_membership_history',$data1);
                                            $membership_pkey = $this->db->insert_id();
                                    
                                            $update_pkey = array(                    
                                                'membership_pkey'           => $membership_pkey,
                                                'membership_id'             => $membership_id,
                                            );
                                            $this->db->where('id',$customer_id);
                                            $this->db->update('tbl_salon_customer',$update_pkey); 
                                        }
                                    }
                                    
                                    // rewards used
                                    // if($used_rewards > 0){
                                    //     $this->db->where('id',$customer_id);
                                    //     $customer_rewards = $this->db->get('tbl_salon_customer')->row();
                                    //     if(!empty($customer_rewards)){
                                    //         $pre_balance = $customer_rewards->rewards_balance;
                                    //         $rewards = $used_rewards;
                                    //         $new_balance = $pre_balance - $rewards;
        
                                    //         $reward_data = array(
                                    //             'customer_id'                   =>  $customer_id,
                                    //             'branch_id' 		            => $branch_id,
                                    //             'salon_id' 			            => $salon_id,
                                    //             'booking_id'                    =>  $booking_id,
                                    //             'transaction_type'              =>  '3',
                                    //             'remark'                        =>  'Reward points used for booking payment',
                                    //             'previous_reward_balance'       =>  $customer_rewards->rewards_balance,
                                    //             'reward_value'                  =>  $rewards,
                                    //             'new_reward_balance'            =>  $new_balance,
                                    //             'created_on'                    =>  date("Y-m-d H:i:s")
                                    //         );
                                    //         $this->db->insert('tbl_customer_rewards_history',$reward_data);
        
                                    //         $this->db->where('id',$customer_id);
                                    //         $this->db->update('tbl_salon_customer',array('rewards_balance'=>$new_balance));
                                    //     }
                                    // }
        
                                    if($services != "" && is_array($services) && !empty($services)){
                                        for($i=0;$i<count($services);$i++){
                                            $service_id = $services[$i]['service_id'];
                                            $this->db->where('tbl_salon_emp_service.branch_id',$branch_id);
                                            $this->db->where('tbl_salon_emp_service.salon_id',$salon_id);
                                            $this->db->where('tbl_salon_emp_service.id',$service_id);
                                            $this->db->where('tbl_salon_emp_service.is_deleted','0');
                                            $single_service = $this->db->get('tbl_salon_emp_service');
                                            $single_service = $single_service->row();
                                            if(!empty($single_service)){
                                                $service_duration = $services[$i]['service_duration'];
                                                $service_added_from = $services[$i]['service_added_from'];
                                                $service_from = $services[$i]['service_from'];
                                                $service_to = $services[$i]['service_to'];
                                                $selected_stylist = $services[$i]['selected_stylist'];
                                                $selected_stylist_shift_id = $services[$i]['selected_stylist_shift_id'];
                                                $selected_stylist_shift_type = $services[$i]['selected_stylist_shift_type'];
                                                $products_single = $services[$i]['products'];
                                                if($service_added_from == '0'){
                                                    $original_service_price = $single_service->final_price;
                                                    
                                                    $is_service_offer_applied = '0';
                                                    $service_offer_discount = 0;
                                                    $service_offer_discount_type = '';
                                                    $service_offer_discount_amount = 0;
                                                    if($is_offer_applied == '1'){
                                                        $this->db->where('is_deleted','0');
                                                        $this->db->where('status','1');
                                                        $this->db->where('id',$applied_offer_id);
                                                        $this->db->where('branch_id', $branch_id);
                                                        $this->db->where('salon_id', $salon_id);
                                                        $offer_data = $this->db->get('tbl_offers')->row();
                                                        if(!empty($offer_data) && in_array($service_id,explode(',',$offer_data->service_name))){
                                                            $service_offer_discount = $offer_data->discount;
                                                            $service_offer_discount_type = $offer_data->discount_in;
                                                            if($service_offer_discount_type == '0'){
                                                                $service_offer_discount_amount = ($services[$i]['price'] * $service_offer_discount) / 100;
                                                            }elseif($service_offer_discount_type == '1'){
                                                                $service_offer_discount_amount = $service_offer_discount;
                                                            }
                                                        }
                                                    }
                                                                                            
                                                    // service regular discount related start
                                                    $service_discount_rewards_type = '';
                                                    $discount_in = '';
                                                    $discount_type = '';
                                                    $discount_amount_value = '';
                                                    $discount_row_id = '';
                                                    $service_discount_customer_criteria = '';
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

                                                    $service_applied_discount = $this->Salon_model->get_customer_service_applied_discount($customer_id,$service_id);
                                                    if($service_applied_discount['is_discount_applied'] == '1'){
                                                        $is_discount_applied = '1';
                                                        $discount_row_id = $service_applied_discount['discount_row_id'];
                                                        $service_discount_customer_criteria = $service_applied_discount['customer_criteria'];
                                                        $discount_type = $service_applied_discount['discount_type'];
                                                        $discount_in = $service_applied_discount['discount_in'];
                                                        $discount_amount_value = (float)$service_applied_discount['discount_amount'];
                                                        $min_slab = $service_applied_discount['min_flexible'];
                                                        $max_slab = $service_applied_discount['max_flexible'];
                                                        if($discount_type == '1'){    //Flexible
                                                            $customer_last_service_booking = $this->Salon_model->get_customer_last_service_booking($customer_id,$service_id);
                                                            if(!empty($customer_last_service_booking)){                                        
                                                                if($service_discount_customer_criteria == '1'){                             
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
                                                                $discount_amount = ((float)$slab_consider * (float)$original_service_price) / 100;
                                                            }elseif($discount_in == '1'){ //flat
                                                                $discount_amount = (float)$slab_consider;
                                                            }
                                                        }elseif($discount_type == '0'){   //Fixed
                                                            if($discount_in == '0'){  //percentage
                                                                $discount_amount = ((float)$discount_amount_value * (float)$original_service_price) / 100;
                                                            }elseif($discount_in == '1'){ //flat
                                                                $discount_amount = (float)$discount_amount_value;
                                                            }
                                                        }
                                                    }

                                                    if($is_discount_applied == '1'){
                                                        if($service_discount_customer_criteria == '1'){  //for regular customer rewards are given
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

                                                            $service_discount_rewards_type = $is_offer_applied == '0' ? '1' : null;   // rewards
                                                        }else{                                    
                                                            $service_discount_rewards_type = $is_offer_applied == '0' ? '0' : null;   // discount
                                                        }
                                                    }
                                                    
                                                    $service_price = $original_service_price - $discount_amount;
                                                    // $service_price = $services[$i]['price'];
        
                                                    // service regular discount related end
        
                                                    $received_total_service = $total_service_amount;
                                                    if($received_total_service != "" && $received_total_service != "0.00" && $received_total_service != null && $received_total_service != 0){
                                                        $price_share_in_total_service = (float)(($service_price/$received_total_service) * 100);
                                                        $discount_share_membership_amount = (float)(($mem_service_discount_amt * $price_share_in_total_service) / 100);
                                                    }else{
                                                        $discount_share_membership_amount = 0;
                                                    }
        
                                                    $received_total = $total_product_amount + $total_service_amount;
                                                    if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                                        $price_share_in_total = (float)(($service_price/$received_total) * 100);
                                                        $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                                                        $discount_share_reward_amount = (float)(($reward_discount * $price_share_in_total) / 100);
                                                    }else{
                                                        $discount_share_coupon_amount = 0;
                                                        $discount_share_reward_amount = 0;
                                                    }
        
                                                    $discount_share_giftcard_amount = 0 ;
                                                    $received_total = $total_product_amount + $total_service_amount;
                                                    if($is_giftcard_applied == '1'){
                                                        if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                                            $price_share_in_total_giftcard_service_amount = (float)(($service_price/$received_total) * 100);
                                                            $discount_share_giftcard_amount = (float)(($giftcard_discount * $price_share_in_total_giftcard_service_amount) / 100);
                                                        }else{
                                                            $discount_share_giftcard_amount = 0;
                                                        }
                                                    }

                                                    $discount_share_reward_amount = $is_offer_applied == '1' ? 0.00 : $discount_share_reward_amount;
                                    
                                                    $total_single_service_discount = $discount_share_membership_amount + $discount_share_reward_amount + $discount_share_coupon_amount + $discount_share_giftcard_amount + $service_offer_discount_amount;
                                                    $single_service_discounted_amount = $service_price - $total_single_service_discount;
                                    
                                                    $stylist_data = array(
                                                        'booking_id' 		    => $booking_id,
                                                        'branch_id' 			=> $branch_id,
                                                        'salon_id' 				=> $salon_id,
                                                        'customer_name' 		=> $customer_id,
                                                        'booking_generated_from'=> '1',
                                                        'service_added_from'	=> '0', //single
                                                        'service_id'     		=> $service_id,
                                                        'service_price'     	=> $service_price,
                                                        'original_service_price'=> $original_service_price,
                                                        
                                                        'service_reward_points' => $single_service->reward_point,
                                                        'stylist_id'      		=> $selected_stylist != "" ? $selected_stylist : '',
                                                        'booking_shift_id'      => $selected_stylist != "" ? $selected_stylist_shift_id : '',
                                                        'booking_shift_type'    => $selected_stylist != "" ? $selected_stylist_shift_type : '',
                                                        'service_date'     		=> date('Y-m-d',strtotime($booking_date)),
                                                        'service_from'    	    => $service_from != "" ? date('Y-m-d H:i:s',strtotime($service_from)) : null,
                                                        'service_to'      	    => $service_to != "" ? date('Y-m-d H:i:s',strtotime($service_to)) : null,
                                                        'created_on'            => date("Y-m-d H:i:s"),
                                                        
                                                        'received_discount_amount_while_booking'     	=> $total_single_service_discount,
                                                        'received_coupon_discount_while_booking'     	=> $discount_share_coupon_amount,
                                                        'received_reward_discount_while_booking'     	=> $discount_share_reward_amount,
                                                        'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                                                        'received_giftcard_discount_while_booking'     	=> $discount_share_giftcard_amount,
                                                        'service_discounted_price_while_booking'     	=> $single_service_discounted_amount,     
        
                                                        'is_service_offer_applied'     	                => $is_offer_applied,
                                                        'applied_offer_id'     	                        => $is_offer_applied == '1' ? $applied_offer_id : '',
                                                        'service_offer_discount'                        => $is_offer_applied == '1' ? $service_offer_discount : '',
                                                        'service_offer_discount_type'     	            => $is_offer_applied == '1' ? $service_offer_discount_type : '',
                                                        'service_offer_discount_amount'     	        => $is_offer_applied == '1' ? $service_offer_discount_amount : '0.00',                                            
        
                                                        'is_service_discount_applied'                   => $is_discount_applied,
                                                        'service_marketing_discount_type'               => $service_discount_rewards_type,
                                                        'service_discount_customer_criteria'            => $service_discount_customer_criteria,
                                                        'service_discount_row_id'                       => $discount_row_id,
                                                        'discount_in'     	                            => $single_service->discount_in,
                                                        'discount_type'     	                        => $single_service->discount_type,
                                                        'discount_value'     	                        => $single_service->service_discount,

                                                        'discount_slab_min'     	                    => $min_slab,
                                                        'discount_slab_max'     	                    => $max_slab,
                                                        'slab_increment'     	                        => $slab_increment,
                                                        'applied_flexible_slab'     	                => $slab_consider,
                                                        'received_discount'     	                    => $discount_amount,

                                                        'rewards_discount_slab_min'     	            => $rewards_min_slab,
                                                        'rewards_discount_slab_max'     	            => $rewards_max_slab,
                                                        'rewards_slab_increment'     	                => $rewards_slab_increment,
                                                        'rewards_applied_flexible_slab'     	        => $rewards_slab_consider,
                                                        'rewards_received_discount'     	            => $is_offer_applied == "0" ? $rewards_discount_amount : null,

                                                        'service_duration'                              => $service_duration
                                                    );
                                                    $this->db->insert('tbl_booking_services_details', $stylist_data);
                                                    $booking_service_details_id = $this->db->insert_id();
                                    
                                                    $single_service_all_products = [];
                                                    if($products_single != "" && is_array($products_single) && !empty($products_single)){
                                                        for($j=0;$j<count($products_single);$j++){
                                                            $product_id = $products_single[$j]['productId'];
                                                            $this->db->where('tbl_product.branch_id',$branch_id);
                                                            $this->db->where('tbl_product.salon_id',$salon_id);
                                                            $this->db->where('tbl_product.id',$product_id);
                                                            $this->db->where('tbl_product.is_deleted','0');
                                                            $this->db->where('tbl_product.status','1');
                                                            $single_product = $this->db->get('tbl_product');
                                                            $single_product = $single_product->row();
                                                            if(!empty($single_product)){
                                                                $single_service_all_products[] = $single_product->id;
                                                                $product_price = $single_product->selling_price; 

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

                                                                $product_applied_discount = $this->Salon_model->get_customer_product_applied_discount($customer_id,$single_product->id);
                                                                if($product_applied_discount['is_discount_applied'] == '1'){
                                                                    $is_product_discount_applied = '1';
                                                                    $product_discount_row_id = $product_applied_discount['discount_row_id'];
                                                                    $product_discount_type = $product_applied_discount['discount_type'];
                                                                    $product_discount_in = $product_applied_discount['discount_in'];
                                                                    $product_discount_amount_value = (float)$product_applied_discount['discount_amount'];
                                                                    $product_min_slab = $product_applied_discount['min_flexible'];
                                                                    $product_max_slab = $product_applied_discount['max_flexible'];
                                                                    if($product_discount_type == '1'){    //Flexible
                                                                        $customer_last_service_product_booking = $this->Salon_model->get_customer_last_service_product_booking($customer_id,$single_product->id);
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
                                                                            $product_discount_amount = ((float)$product_slab_consider * (float)$product_price) / 100;
                                                                        }elseif($product_discount_in == '1'){ //flat
                                                                            $product_discount_amount = (float)$product_slab_consider;
                                                                        }
                                                                    }elseif($product_discount_type == '0'){   //Fixed
                                                                        if($product_discount_in == '0'){  //percentage
                                                                            $product_discount_amount = ((float)$product_discount_amount_value * (float)$product_price) / 100;
                                                                        }elseif($product_discount_in == '1'){ //flat
                                                                            $product_discount_amount = (float)$product_discount_amount_value;
                                                                        }
                                                                    }
                                                                }

                                                                $product_price = $product_price - $product_discount_amount;
                                                                $original_product_price = $single_product->selling_price;                       
                                        
                                                                $received_total_product = $total_product_amount;
                                                                if($received_total_product != "" && $received_total_product != "0.00" && $received_total_product != null && $received_total_product != 0){
                                                                    $price_share_in_total_product = (float)(($product_price/$received_total_product) * 100);
                                                                    $discount_share_membership_amount = (float)(($mem_product_discount_amt * $price_share_in_total_product) / 100);
                                                                }else{
                                                                    $discount_share_membership_amount = 0;
                                                                }
                                                                
                                                                $received_total = $total_product_amount + $total_service_amount;
                                                                if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                                                    $price_share_in_total = (float)(($product_price/$received_total) * 100);
                                                                    $discount_share_coupon_amount = (float)(($coupon_discount_amount * $price_share_in_total) / 100);
                                                                    $discount_share_reward_amount = (float)(($reward_discount * $price_share_in_total) / 100);
                                                                }else{
                                                                    $discount_share_coupon_amount = 0;
                                                                    $discount_share_reward_amount = 0;
                                                                }
                                                                
                                                                $discount_share_giftcard_amount = 0 ;
                                                                $received_total = $total_product_amount + $total_service_amount;
                                                                if($is_giftcard_applied == '1'){
                                                                    if($received_total != "" && $received_total != "0.00" && $received_total != null && $received_total != 0){
                                                                        $price_share_in_total_giftcard_service_amount = (float)(($product_price/$received_total) * 100);
                                                                        $discount_share_giftcard_amount = (float)(($giftcard_discount * $price_share_in_total_giftcard_service_amount) / 100);
                                                                    }else{
                                                                        $discount_share_giftcard_amount = 0;
                                                                    }
                                                                }
                                        
                                                                $total_single_product_discount = $discount_share_membership_amount + $discount_share_giftcard_amount + $discount_share_reward_amount + $discount_share_coupon_amount;
                                                                $single_product_discounted_amount = $product_price - $total_single_product_discount;
                                        
                                                                $service_product_data = array(
                                                                    'booking_service_details_id'  => $booking_service_details_id,
                                                                    'booking_id' 		    => $booking_id,
                                                                    'branch_id' 			=> $branch_id,
                                                                    'salon_id' 				=> $salon_id,
                                                                    'customer_name' 		=> $customer_id,
                                                                    'booking_generated_from'=> '1',
                                                                    'product_added_from'	=> '0', //single
                                                                    'service_id'     		=> $service_id,
                                                                    'product_id'     		=> $product_id,
                                                                    'product_price'     	=> $product_price,
                                                                    'product_original_price'=> $original_product_price,
                                                                    'created_on'            => date("Y-m-d H:i:s"),
                                                            
                                                                    'received_discount_amount_while_booking'     	=> $total_single_product_discount,
                                                                    'received_coupon_discount_while_booking'     	=> $discount_share_coupon_amount,
                                                                    'received_reward_discount_while_booking'     	=> $discount_share_reward_amount,
                                                                    'received_membership_discount_while_booking'    => $discount_share_membership_amount,
                                                                    'product_discounted_price_while_booking'     	=> $single_product_discounted_amount,
                                                                    'received_giftcard_discount_while_booking'     	=> $discount_share_giftcard_amount,                                                                                            

                                                                    'is_product_discount_applied'                   => $is_product_discount_applied,
                                                                    'product_discount_row_id'                       => $product_discount_row_id,

                                                                    'product_discount_in'     	                    => $product_discount_in,
                                                                    'product_discount_type'     	                => $product_discount_type,
                                                                    'product_discount_value'     	                => $product_discount_amount_value,
                                                                    
                                                                    'product_discount_slab_min'     	            => $product_min_slab,
                                                                    'product_discount_slab_max'     	            => $product_max_slab,
                                                                    'product_slab_increment'     	                => $product_slab_increment,
                                                                    'product_applied_flexible_slab'     	        => $product_slab_consider,
                                                                    'product_received_discount'     	            => $product_discount_amount,
                                                                );
                                                                $this->db->insert('tbl_booking_services_products_details', $service_product_data);
                                                            }
                                                        }
                                                    }
        
                                                    $service_product_details = array(
                                                        'product_ids'     		=> ($single_service_all_products != "" && is_array($single_service_all_products) && !empty($single_service_all_products)) ? implode(',',$single_service_all_products) : null,
                                                    );
                                                    $this->db->where('id',$booking_service_details_id);
                                                    $this->db->update('tbl_booking_services_details',$service_product_details);
                                                }elseif($service_added_from == '1'){
                                                    $stylist_data = array(
                                                        'booking_id' 		    => $booking_id,
                                                        'branch_id' 			=> $branch_id,
                                                        'salon_id' 				=> $salon_id,
                                                        'customer_name' 		=> $customer_id,
                                                        'booking_generated_from'=> '1',
                                                        'service_added_from'	=> '1', //package
                                                        'package_id'     		=> $selected_package_id,
                                                        'service_id'     		=> $service_id,
        
                                                        'service_reward_points' => $single_service->reward_point,
                                                        'stylist_id'      		=> $selected_stylist != "" ? $selected_stylist : '',
                                                        'service_date'     		=> date('Y-m-d',strtotime($booking_date)),
                                                        'service_from'    	    => $service_from != "" ? date('Y-m-d H:i:s',strtotime($service_from)) : null,
                                                        'service_to'      	    => $service_to != "" ? date('Y-m-d H:i:s',strtotime($service_to)) : null,
                                                        'created_on'            => date("Y-m-d H:i:s"),
                                                    );
                                                    $this->db->insert('tbl_booking_services_details', $stylist_data);                
                                                    $booking_service_details_id = $this->db->insert_id();
                                    
                                                    $single_service_all_products = [];
                                                    if($products_single != "" && is_array($products_single) && !empty($products_single)){
                                                        for($j=0;$j<count($products_single);$j++){
                                                            $product_id = $products_single[$j]['productId'];
                                                            $this->db->where('tbl_product.branch_id',$branch_id);
                                                            $this->db->where('tbl_product.salon_id',$salon_id);
                                                            $this->db->where('tbl_product.id',$product_id);
                                                            $this->db->where('tbl_product.is_deleted','0');
                                                            $this->db->where('tbl_product.status','1');
                                                            $single_product = $this->db->get('tbl_product');
                                                            $single_product = $single_product->row();
                                                            if(!empty($single_product)){
                                                                $single_service_all_products[] = $single_product->id;
                                                                $service_product_data = array(
                                                                    'booking_service_details_id'  => $booking_service_details_id,
                                                                    'booking_id' 		    => $booking_id,
                                                                    'branch_id' 			=> $branch_id,
                                                                    'salon_id' 				=> $salon_id,
                                                                    'customer_name' 		=> $customer_id,
                                                                    'booking_generated_from'=> '1',
                                                                    'package_id' 		    => $selected_package_id,
                                                                    'product_added_from'	=> '1', //package
                                                                    'service_id'     		=> $service_id,
                                                                    'product_id'     		=> $product_id,
                                                                    'created_on'            => date("Y-m-d H:i:s"),
                                                                );
                                                                $this->db->insert('tbl_booking_services_products_details', $service_product_data);
                                                            }
                                                        }
                                                    }
        
                                                    $service_product_details = array(
                                                        'product_ids'     		=> ($single_service_all_products != "" && is_array($single_service_all_products) && !empty($single_service_all_products)) ? implode(',',$single_service_all_products) : null,
                                                    );
                                                    $this->db->where('id',$booking_service_details_id);
                                                    $this->db->update('tbl_booking_services_details',$service_product_details);
                                                }
                                            }
                                        }
                                    }
                            
                                    if($selected_package_id != "" && $is_package_included == '1'){
                                        $package_details = $this->Salon_model->get_package_details($selected_package_id);
                                        if(!empty($package_details)){
                                            $package_rewards_data = array(
                                                'package_rewards' =>  $package_details->reward_point
                                            );
                                            
                                            $this->db->where('id',$booking_id);
                                            $this->db->where('branch_id',$branch_id);
                                            $this->db->where('salon_id',$salon_id);
                                            $this->db->update('tbl_new_booking',$package_rewards_data);
                            
                                            if($is_old_package == '1'){
                                                $active_package_allocation = $this->Salon_model->get_active_package_allocation($selected_package_allocation_id);
                                                if(!empty($active_package_allocation)){
                                                    if($services != "" && is_array($services) && !empty($services)){
                                                        for($i=0;$i<count($services);$i++){
                                                            $service_added_from = $services[$i]['service_added_from'];
                                                            if($service_added_from == '1'){
                                                                $service_id = $services[$i]['service_id'];
                                                                $old_details = $this->Salon_model->get_active_package_allocation_item_status($active_package_allocation->id,$service_id,'0');
                                                                if(!empty($old_details)){
                                                                    $package_item_used_details = array(
                                                                        'item_used_in_booking_id'   => $booking_id,
                                                                        'used_status'               => '1',
                                                                        'service_date'     		    => date('Y-m-d',strtotime($booking_date)),
                                                                        'service_from'    	        => $service_from != "" ? date('Y-m-d H:i:s',strtotime($service_from)) : null,
                                                                        'service_to'      	        => $service_to != "" ? date('Y-m-d H:i:s',strtotime($service_to)) : null,
                                                                        'item_used_on'              => date("Y-m-d"),
                                                                    );
                                                                    $this->db->where('id',$old_details->id);
                                                                    $this->db->update('tbl_booking_package_detail_status', $package_item_used_details);                                    
                                
                                                                    $allocation_data_for_service = array(
                                                                        'package_allocation_id'         =>  $active_package_allocation->id,
                                                                        'package_allocation_status_id'  =>  $old_details->id,
                                                                    );
                                                                    $this->db->where('service_id', $service_id);
                                                                    $this->db->where('customer_name',$customer_id);
                                                                    $this->db->where('booking_id',$booking_id);
                                                                    $this->db->where('service_added_from','1');
                                                                    $this->db->where('branch_id',$branch_id);
                                                                    $this->db->where('salon_id',$salon_id);
                                                                    $this->db->update('tbl_booking_services_details',$allocation_data_for_service);
                                                                }
                                                            }
                                                        }
                                                    }
                            
                                                    $used_in_booking_status_data = array(
                                                        'is_booking_done'       =>  '1',
                                                        'added_in_booking_id'   =>  $booking_id,
                                                    );
                                                    $this->db->where('allocation_id',$active_package_allocation->id);
                                                    $this->db->update('tbl_booking_package_detail_status', $used_in_booking_status_data);
                                                    
                                                    $used_in_booking_data = array(
                                                        'is_booking_done'           =>  '1',
                                                        'allocated_in_booking_id'   =>  $booking_id,
                                                    );
                                                    $this->db->where('id',$active_package_allocation->id);
                                                    $this->db->update('tbl_customer_package_allocations', $used_in_booking_data);
                            
                                                    $this->db->where('allocation_id',$active_package_allocation->id);
                                                    $this->db->where('customer_name',$customer_id);
                                                    $this->db->where('pacakge_id',$selected_package_id);
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
                                                    
                                                    $allocation_data_for_product = array(
                                                        'package_allocation_id' =>  $active_package_allocation->id,
                                                        'used_package_type'     =>  '0'
                                                    );
                                                    
                                                    $this->db->where('id',$booking_id);
                                                    $this->db->where('branch_id',$branch_id);
                                                    $this->db->where('salon_id',$salon_id);
                                                    $this->db->update('tbl_new_booking',$allocation_data_for_product);
                                                }
                                            }else{
                                                $allocation_data = array(
                                                    'customer_name'         =>  $customer_id,
                                                    'allocated_in_booking_id'   =>  $booking_id,
                                                    'package_id'            =>  $selected_package_id,
                                                    'branch_id' 			=>  $branch_id,
                                                    'salon_id' 				=>  $salon_id,
                                                    'package_start_date'    =>  date("Y-m-d"),
                                                    'package_amount'        =>  $package_amount,
                                                    'created_on'            =>  date("Y-m-d H:i:s"),
                                                );
                                                $this->db->insert('tbl_customer_package_allocations', $allocation_data);
                                                $allocation_id = $this->db->insert_id();
                            
                                                $allocation_data_for_product = array(
                                                    'package_allocation_id' =>  $allocation_id
                                                );
                                                $allocation_data_for_booking = array(
                                                    'package_allocation_id' =>  $allocation_id,
                                                    'used_package_type'     =>  '1'
                                                );
                                                
                                                $this->db->where('id',$booking_id);
                                                $this->db->where('branch_id',$branch_id);
                                                $this->db->where('salon_id',$salon_id);
                                                $this->db->update('tbl_new_booking',$allocation_data_for_booking);
                            
                                                $this->db->where('product_added_from','1');
                                                $this->db->where('customer_name',$customer_id);
                                                $this->db->where('booking_id',$booking_id);
                                                $this->db->where('package_id',$selected_package_id);
                                                $this->db->where('branch_id',$branch_id);
                                                $this->db->where('salon_id',$salon_id);
                                                $this->db->update('tbl_booking_services_products_details',$allocation_data_for_product);
                            
                                                $package_all_services = explode(',',$package_details->service_name);
                            
                                                if(!empty($package_all_services)){
                                                    for($i=0;$i<count($package_all_services);$i++){
                                                        $package_service_products = $this->Salon_model->get_package_products_single_all($package_details->id,$package_all_services[$i],$branch_id,$salon_id);
                                                        $package_item_details = array(
                                                            'branch_id' 			=> $branch_id,
                                                            'salon_id' 				=> $salon_id,
                                                            'allocation_id' 		=> $allocation_id,
                                                            'customer_name' 		=> $customer_id,
                                                            'pacakge_id' 		    => $selected_package_id,
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
                            
                                                        if($services != "" && is_array($services) && !empty($services)){
                                                            for($i=0;$i<count($services);$i++){
                                                                $service_added_from = $services[$i]['service_added_from'];
                                                                if($service_added_from == '1'){
                                                                    $service_id = $services[$i]['service_id'];
                                                                    if($package_all_services[$i] == $service_id){
                                                                        $package_item_used_details = array(
                                                                            'item_used_in_booking_id'   => $booking_id,
                                                                            'used_status'               =>  '1',
                                                                            'item_used_on'              =>  date("Y-m-d"),                                                                
                                                                            'service_date'     		    => date('Y-m-d',strtotime($booking_date)),
                                                                            'service_from'    	        => $service_from != "" ? date('Y-m-d H:i:s',strtotime($service_from)) : null,
                                                                            'service_to'      	        => $service_to != "" ? date('Y-m-d H:i:s',strtotime($service_to)) : null,
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
                            
                                                        $allocation_data_for_service = array(
                                                            'package_allocation_id'         =>  $allocation_id,
                                                            'package_allocation_status_id'  =>  $single_package_details_id,
                                                        );
                                                        $this->db->where('service_id', $package_all_services[$i]);
                                                        $this->db->where('customer_name',$customer_id);
                                                        $this->db->where('booking_id',$booking_id);
                                                        $this->db->where('service_added_from','1');
                                                        $this->db->where('branch_id',$branch_id);
                                                        $this->db->where('salon_id',$salon_id);
                                                        $this->db->update('tbl_booking_services_details',$allocation_data_for_service);
                                                    }
                                                }                
                            
                                                $this->db->where('allocation_id',$allocation_id);
                                                $this->db->where('customer_name',$customer_id);
                                                $this->db->where('pacakge_id',$selected_package_id);
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
                            
                                    $this->Salon_model->update_booking_service_end_all($booking_id,$branch_id,$salon_id);
                            
                                    $this->db->where('id',$customer_id);
                                    $this->db->where('branch_id',$branch_id);
                                    $this->db->where('salon_id',$salon_id);
                                    $this->db->where('is_deleted','0');
                                    $customer_details = $this->db->get('tbl_salon_customer')->row();
                                    if(!empty($customer_details) && $customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                                        $services_text = '';
                                        $this->db->where('id',$booking_id);
                                        $booking_details = $this->db->get('tbl_new_booking')->row();
                                        if(!empty($booking_details)){
                                            $services = explode(',',$booking_details->services);
                                            if(count($services) > 0){
                                                for($i=0;$i<count($services);$i++){
                                                    $this->db->where('id',$services[$i]);
                                                    $this->db->where('branch_id',$branch_id);
                                                    $this->db->where('salon_id',$salon_id);
                                                    $this->db->where('is_deleted','0');
                                                    $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                                    if (!empty($service_details)) {
                                                        // $services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                                        $services_text .= $service_details->service_name;
                                                        
                                                        if ($i < count($services) - 1) {
                                                            $services_text .= ', ';
                                                        }
                                                    }
                                                }
                                                $services_text = trim($services_text,',');
                                                $services_text = trim($services_text,' ');
                                                $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                                                $finalNumber = substr($cleanedNumber, -10);
                                                $finalNumber = '91' . $finalNumber;
                            
                                                $this->db->where('is_deleted','0');
                                                $this->db->where('id',$customer_details->branch_id);
                                                $this->db->where('salon_id',$customer_details->salon_id);
                                                $branch = $this->db->get('tbl_branch')->row();
                                                $visit_text = '';
                                                if(!empty($branch)){
                                                    if($branch->branch_name != ""){
                                                        $visit_text .= $branch->branch_name.'%0a';
                                                    }
                                                }
                                                $receipt_link = base_url() . 'mobile-booking-print/' . base64_encode($booking_details->id) . '?print&mobile';
        
                                                $type = '5';
                                                $message = "Hello, " . $customer_details->full_name . "!%0a%0aYou're booked\u{1F389}%0a\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " at%0a\u{1F55B}" . date('h:i A',strtotime($booking_details->service_start_time)) . " for%0a\u{1F488}" . $services_text . "%0a%0aFollow the link for booking receipt.%0a" . $receipt_link . "%0a%0aNeed changes !!! Just Feel Free To Contact Us.%0a%0aThanks for choosing us!%0a" . $visit_text . "";
                                                $app_message = "Hello, " . $customer_details->full_name . "!\n\nYou're booked\u{1F389}\n\u{1F5D3}" . date('d M, Y', strtotime($booking_details->service_start_date)) . " at\n\u{1F55B}" . date('h:i A', strtotime($booking_details->service_start_time)) . " for\n\u{1F488}" . $services_text . "\nFollow the link for booking receipt." . $receipt_link . "\n\nNeed changes!!! Just Feel Free To Contact Us.\n\nThanks for choosing us!\n" . $visit_text . "";
                                                // echo $message; exit;
                                                $number = $finalNumber;
                                                $customer = $customer_details->id;
                                                $salon_id = $customer_details->salon_id;
                                                $branch_id = $customer_details->branch_id;
                                                $for_order_id = $booking_details->id;
                                                $for_offer_id = '';
                                                $for_query_id = '';
                                                $consent_form_id = '';
                                                $title = 'Booking Received';
                                                $generated_from = '1';
                                                $notification_data = [
                                                    "landing_page"  => 'booking_details',
                                                    "redirect_id"   => (string)$for_order_id
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
                                        }
                                    }
        
                                    if($selected_stylist != "" && $branch_id != "" && $salon_id != ""){
                                        $this->db->where('id',$booking_id);
                                        $booking_details = $this->db->get('tbl_new_booking')->row();
                                        if(!empty($booking_details)){
                                            $this->db->where('id',$selected_stylist);
                                            $emp_details = $this->db->get('tbl_salon_employee')->row();
                                            if(!empty($emp_details)){
                                                $uid = $branch_id.'@@@'.$salon_id;
                                                $type = 'sender';
                                                $project = 'salon';
                                                $message = 'Received booking for ' . $emp_details->full_name . ' on ' . date('d M, Y h:i A', strtotime($booking_details->service_start_date.' '.$booking_details->service_start_time));
                                                $data = json_encode([
                                                    'message_type'  => 'booking_placed',
                                                    'branch_id'     => $branch_id,
                                                    'salon_id'      => $salon_id,
                                                    'project'       => $project,
                                                    'uid'           => $uid,
                                                    'message'       => $message,
                                                    'stylist'       => $selected_stylist,
                                                    'service_start_time'  => $booking_details->service_start_time,
                                                    'service_from'  => $booking_details->service_start_date.' '.$booking_details->service_start_time,
                                                    'service_to'    => $booking_details->service_start_date.' '.$booking_details->service_end_time,
                                                    'service_date'  => date('Y-m-d', strtotime($booking_details->service_start_date)),
                                                    'service_name'  => !empty($service_details) ? $service_details->service_name : '',
                                                    'stylist_name'  => $emp_details->full_name
                                                ]);
                                                $this->Salon_model->send_data_to_socket_client('app',$uid,$type,$project,$message,$data);
                                            }
                                        }
                                    }

                                    if(isset($request['temp_booking_id']) && $request['temp_booking_id'] != ""){    
                                        $this->db->where('customer_id', $customer_id);
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('salon_id', $salon_id);
                                        $this->db->where('is_deleted', '0');
                                        $this->db->where('id', $request['temp_booking_id']);
                                        $this->db->update('tbl_trying_for_booking', array(
                                            'step'              => null,
                                            'booking_status'    => '1',
                                            'booking_id'        => $booking_id,
                                            'booking_placed_on' => date('Y-m-d H:i:s')
                                        ));
                                    }

                                    if(isset($request['reservation_id']) && $request['reservation_id'] != ""){                                    
                                        $booking_date = date('Y-m-d',strtotime($booking_date));
                                        $slot_from = date('H:i:s',strtotime($slot_from));
                                        list($year, $month, $day) = explode('-', $booking_date);
                                        list($hour, $minute, $second) = explode(':', $slot_from);
                                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                                        $slot = date('Y-m-d H:i:s', $timestamp);

                                        $this->db->where('status', '0');
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('salon_id', $salon_id);
                                        $this->db->where('id', $request['reservation_id']);
                                        $this->db->update('tbl_stylist_slot_reservations', array(
                                            'status'                => '1',
                                            'confirm_booking_id'    => $booking_id
                                        ));
                                    }
        
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Booking placed successfully';
                                    $json_arr['data'] = array('booking_id'  =>  $booking_id, 'receipt'  =>  base_url().'mobile-booking-print/'.base64_encode($booking_id).'?print&mobile');
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Slot not available now, Please try again with another slot';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Slot not available now, Stylist Short Break overlapped';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking date and Timeslot not available';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer not found';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found';
                    $json_arr['data'] = [];
                }                  
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function get_available_reschedule_timeslots(){
        $request = json_decode(file_get_contents('php://input'), true);
        $is_show_tabs = '0';
        if($request){
            if(isset($request['branch_id'])){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                $stylist_id = isset($request['stylist_id']) ? $request['stylist_id'] : '';    
                $reservation_id = isset($request['reservation_id']) ? $request['reservation_id'] : '';    

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                $data = array();
                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id); 
                        if(!empty($rules)){
                            $slot_type = isset($request['slot_type']) ? $request['slot_type'] : '';
                            $slot_thresholds = [
                                'morning'   => ['start' => '05:00:00', 'end' => '12:00:00', 'label' => 'morning_slots'],
                                'afternoon' => ['start' => '12:00:00', 'end' => '17:00:00', 'label' => 'afternoon_slots'],
                                'evening'   => ['start' => '17:00:00', 'end' => '23:00:00', 'label' => 'evening_slots'],
                            ];                         

                            $offset = $request['offset'];   
                            $limit = $request['limit']; 

                            $booking_id = $request['booking_id'];    
                            $this->db->where('is_deleted','0');
                            $this->db->where('status','1');
                            $this->db->where('id',$booking_id);
                            $this->db->where('customer_name',$customer->id);
                            $this->db->where('branch_id', $branch_id);
                            $this->db->where('salon_id', $salon_id);
                            $single_booking = $this->db->get('tbl_new_booking')->row();
                            $selected_services = [];
                            if(!empty($single_booking)){ 
                                $reschedule_details = $request['reschedule_details']; 
                                if($reschedule_details != "" && !empty($reschedule_details)){ 
                                    for($i=0;$i<count($reschedule_details);$i++){
                                        $this->db->where('is_deleted','0');
                                        $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                        $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                        $this->db->where('booking_id',$single_booking->id);
                                        $this->db->where('customer_name',$customer->id);
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('salon_id', $salon_id);
                                        $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                        if(!empty($single_booking_services)){   
                                            $selected_services[] = $single_booking_services->service_id;
                                        }
                                    }
                                    if(!empty($selected_services)){
                                        $booking_date = $request['booking_date'];   

                                        $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all($booking_date,$branch_id,$salon_id);
                                        
                                        if(!$is_emergency){
                                            $working_hrs = $this->Salon_model->get_saloon_working_hrs_all($booking_date,$branch_id,$salon_id);
                                            if($working_hrs['is_allowed'] == 1){
                                                $duration = $rules->slot_time;
                                                $minutes_early_booking = !empty($rules->booking_time_range) ? $rules->booking_time_range : 0;

                                                $store_start = date('Y-m-d H:i:s',strtotime($booking_date.' '.$working_hrs['start']));
                                                $store_end = date('Y-m-d H:i:s',strtotime($booking_date.' '.$working_hrs['end']));
                                                
                                                if (!empty($slot_type) && isset($slot_thresholds[$slot_type])) {
                                                    $threshold = $slot_thresholds[$slot_type];

                                                    $threshold_start = date('Y-m-d H:i:s', strtotime($booking_date . ' ' . $threshold['start']));
                                                    $threshold_end   = date('Y-m-d H:i:s', strtotime($booking_date . ' ' . $threshold['end']));

                                                    $slot_start_time = max($store_start, $threshold_start);
                                                    $slot_end_time   = min($store_end, $threshold_end);

                                                    $slots = $this->Salon_model->generateCommonTimePairs($booking_date, $slot_start_time, $slot_end_time, $duration);

                                                    if($limit != ""){
                                                        $slots = array_slice($slots, $offset, $limit);
                                                    }
                                                    
                                                    $final_slots = array();
                                                    if(!empty($slots)){
                                                        foreach ($slots as $slot) {
                                                            $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                            $current_date = date('Y-m-d H:i:s');
                                                            if ($current_date <= $allowed_booking_datetime) {
                                                                $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                                if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                                    $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all_stylist($slot['from'], $reschedule_details, $branch_id, $salon_id, $stylist_id, $reservation_id);
                                                                    if($is_vacent){
                                                                        $is_vacent_flag = '1';
                                                                    }else{
                                                                        $is_vacent_flag = '0';
                                                                    }
                                                                    if($is_vacent_flag == '1'){
                                                                        $final_slots[] = array(
                                                                            'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                            'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                            'is_vacent' =>  $is_vacent_flag
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }                                                
                                        
                                                    if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                                        if(date('H:i:s') > date('H:i:s',strtotime($working_hrs['end']))){
                                                            $json_arr['status'] = 'false';
                                                            $json_arr['message'] = 'Booking time for today is over. Try another day.';
                                                            $json_arr['is_show_tabs'] = $is_show_tabs;
                                                            $json_arr['data'] = [];
                                                        }else{
                                                            $is_show_tabs = '1';
                                                            if (empty($final_slots)) {
                                                                $json_arr['status'] = 'false';
                                                                $json_arr['message'] = ucfirst($slot_type) . ' slots not available';
                                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                                $json_arr['data'] = [];
                                                            } else {
                                                                $data = array(
                                                                    $threshold['label'] => $final_slots,
                                                                    'limit'             => $limit,
                                                                    'offset'            => $limit != "" ? $offset + $limit : '',
                                                                );
                                                                $json_arr['status'] = 'true';
                                                                $json_arr['message'] = 'success';
                                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                                $json_arr['data'] = $data;
                                                            }
                                                        }
                                                    }else{
                                                        $is_show_tabs = '1';
                                                        if (empty($final_slots)) {
                                                            $json_arr['status'] = 'false';
                                                            $json_arr['message'] = ucfirst($slot_type) . ' slots not available';
                                                            $json_arr['is_show_tabs'] = $is_show_tabs;
                                                            $json_arr['data'] = [];
                                                        } else {
                                                            $data = array(
                                                                $threshold['label'] => $final_slots,
                                                                'limit'             => $limit,
                                                                'offset'            => $limit != "" ? $offset + $limit : '',
                                                            );
                                                            $json_arr['status'] = 'true';
                                                            $json_arr['message'] = 'success';
                                                            $json_arr['is_show_tabs'] = $is_show_tabs;
                                                            $json_arr['data'] = $data;
                                                        }
                                                    }
                                                }else{
                                                    $slots = $this->Salon_model->generateCommonTimePairs($booking_date,$store_start,$store_end,$duration);
                                
                                                    $slots_morning = [];
                                                    $slots_afternoon = [];
                                                    $slots_evening = [];

                                                    for($i=0;$i<count($slots);$i++){
                                                        $slot_time = date('H:i:s', strtotime($slots[$i]['from']));
                                                        if ($slot_time >= '05:00:00' && $slot_time < '12:00:00') {
                                                            $slots_morning[] = $slots[$i];
                                                        } elseif ($slot_time >= '12:00:00' && $slot_time < '17:00:00') {
                                                            $slots_afternoon[] = $slots[$i];
                                                        } else {
                                                            $slots_evening[] = $slots[$i];
                                                        }
                                                    }

                                                    $offset = $request['offset'];   
                                                    $limit = $request['limit']; 
                                                    
                                                    $slots_morning_array = array();
                                                    if(!empty($slots_morning)){
                                                        foreach ($slots_morning as &$slot) {
                                                            $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                            $current_date = date('Y-m-d H:i:s');
                                                            if ($current_date <= $allowed_booking_datetime) {
                                                                $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                                if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                                    // $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all($slot['from'], $reschedule_details, $branch_id, $salon_id);
                                                                    $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all_stylist($slot['from'], $reschedule_details, $branch_id, $salon_id, $stylist_id, $reservation_id);
                                                                    if($is_vacent){
                                                                        $is_vacent_flag = '1';
                                                                    }else{
                                                                        $is_vacent_flag = '0';
                                                                    }
                                                                    if($is_vacent_flag == '1'){
                                                                        $slots_morning_array[] = array(
                                                                            'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                            'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                            'is_vacent' =>  $is_vacent_flag
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    $slots_afternoon_array = array();
                                                    if(!empty($slots_afternoon)){
                                                        foreach ($slots_afternoon as &$slot) {
                                                            $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                            $current_date = date('Y-m-d H:i:s');
                                                            if ($current_date <= $allowed_booking_datetime) {
                                                                $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                                if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                                    // $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all($slot['from'], $reschedule_details, $branch_id, $salon_id);
                                                                    $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all_stylist($slot['from'], $reschedule_details, $branch_id, $salon_id, $stylist_id, $reservation_id);
                                                                    if($is_vacent){
                                                                        $is_vacent_flag = '1';
                                                                    }else{
                                                                        $is_vacent_flag = '0';
                                                                    }
                                                                    if($is_vacent_flag == '1'){
                                                                        $slots_afternoon_array[] = array(
                                                                            'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                            'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                            'is_vacent' =>  $is_vacent_flag
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    $slots_evening_array = array();
                                                    if(!empty($slots_evening)){
                                                        foreach ($slots_evening as &$slot) {
                                                            $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                                                            $current_date = date('Y-m-d H:i:s');
                                                            if ($current_date <= $allowed_booking_datetime) {
                                                                $selected_start = date('Y-m-d H:i:s', strtotime($slot['from']));
                                                                if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                                                    // $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all($slot['from'], $reschedule_details, $branch_id, $salon_id);
                                                                    $is_vacent = $this->Salon_model->check_slot_vacent_for_selected_resch_services_all_stylist($slot['from'], $reschedule_details, $branch_id, $salon_id, $stylist_id, $reservation_id);
                                                                    if($is_vacent){
                                                                        $is_vacent_flag = '1';
                                                                    }else{
                                                                        $is_vacent_flag = '0';
                                                                    }
                                                                    if($is_vacent_flag == '1'){
                                                                        $slots_evening_array[] = array(
                                                                            'from'      =>  date('h:i A', strtotime($slot['from'])),
                                                                            'to'        =>  date('h:i A', strtotime($slot['to'])),
                                                                            'is_vacent' =>  $is_vacent_flag
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $morning_slots = array_slice($slots_morning_array, $offset, $limit);
                                                    $afternoon_slots = array_slice($slots_afternoon_array, $offset, $limit);
                                                    $evening_slots = array_slice($slots_evening_array, $offset, $limit);                                                   

                                                    if (empty($morning_slots) && empty($afternoon_slots) && empty($evening_slots)) {
                                                        if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                                            if(date('H:i:s') > date('H:i:s',strtotime($working_hrs['end']))){
                                                                $json_arr['status'] = 'false';
                                                                $json_arr['message'] = 'Sorry, all time slots for today are closed. Please book for another day.';
                                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                                $json_arr['data'] = [];
                                                            }else{
                                                                $json_arr['status'] = 'false';
                                                                $json_arr['message'] = 'Sorry, todays slots are full. Please book for another day.';
                                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                                $json_arr['data'] = [];
                                                            }
                                                        }else{
                                                            $json_arr['status'] = 'false';
                                                            $json_arr['message'] = 'Sorry, slots for selected date are full. Please book for another day.';
                                                            $json_arr['is_show_tabs'] = $is_show_tabs;
                                                            $json_arr['data'] = [];
                                                        }
                                                    } else {
                                                        $is_show_tabs = '1';
                                                        $data = array(
                                                            'morning_slots'   => $morning_slots,
                                                            'afternoon_slots' => $afternoon_slots,
                                                            'evening_slots'   => $evening_slots,
                                                            'limit'           => $limit,
                                                            'offset'          => $offset + $limit,
                                                        );
                                                        $json_arr['status'] = 'true';
                                                        $json_arr['message'] = 'success';
                                                        $json_arr['is_show_tabs'] = $is_show_tabs;
                                                        $json_arr['data'] = $data;
                                                    }
                                                }
                                            }else{
                                                if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                                    $json_arr['status'] = 'false';
                                                    $json_arr['message'] = 'Salon is closed today. Book for another day.';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = [];
                                                }else{
                                                    $json_arr['status'] = 'false';
                                                    $json_arr['message'] = 'Salon is closed on ' . date('d M, Y',strtotime($booking_date)) . '. Book for another day.';
                                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                                    $json_arr['data'] = [];
                                                }
                                            }
                                        }else{
                                            if(date('Y-m-d') == date('Y-m-d',strtotime($booking_date))){
                                                $json_arr['status'] = 'false';
                                                $json_arr['message'] = $is_emergency->reason != "" ? 'Salon is closed today. Reason: ' . $is_emergency->reason : 'Salon is closed today. Please conact salon.';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = [];
                                            }else{
                                                $json_arr['status'] = 'false';
                                                $json_arr['message'] = $is_emergency->reason != "" ? 'Salon is closed on ' . date('d M, Y',strtotime($booking_date)) . '. Reason: ' . $is_emergency->reason : 'Salon is closed on' . date('d M, Y',strtotime($booking_date)) . '. Please conact salon.';
                                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                                $json_arr['data'] = [];
                                            }
                                        }
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Service details not found';
                                        $json_arr['is_show_tabs'] = $is_show_tabs;
                                        $json_arr['data'] = [];
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Reschedule details not found';
                                    $json_arr['is_show_tabs'] = $is_show_tabs;
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Booking currently not available, Please contact salon';
                                $json_arr['is_show_tabs'] = $is_show_tabs;
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['is_show_tabs'] = $is_show_tabs;
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['is_show_tabs'] = $is_show_tabs;
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['is_show_tabs'] = $is_show_tabs;
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID required.';
                $json_arr['is_show_tabs'] = $is_show_tabs;
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['is_show_tabs'] = $is_show_tabs;
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_selected_reschedule_service_stylists(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   
                $from_slot = $request['slot_from'];   
                $to_slot = $request['slot_to'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id); 
                        if(!empty($rules)){
                            if($from_slot != "" && $to_slot != ""){
                                $rules_employee_selection = $rules->employee_selection;
                                $booking_id = $request['booking_id'];    
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$booking_id);
                                $this->db->where('customer_name',$customer->id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $single_booking = $this->db->get('tbl_new_booking')->row();
                                $selected_services = [];
                                $selected_service_details = [];
                                if(!empty($single_booking)){
                                    $reschedule_details = $request['reschedule_details']; 
                                    if($reschedule_details != "" && !empty($reschedule_details)){  
                                        for($i=0;$i<count($reschedule_details);$i++){
                                            $this->db->where('is_deleted','0');
                                            $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                            $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                            $this->db->where('booking_id',$single_booking->id);
                                            $this->db->where('customer_name',$customer->id);
                                            $this->db->where('branch_id', $branch_id);
                                            $this->db->where('salon_id', $salon_id);
                                            $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                            if(!empty($single_booking_services)){   
                                                $selected_services[] = $single_booking_services->service_id;
                                                $selected_service_details[] = $single_booking_services->id;
                                            }
                                        }
                                        if(!empty($selected_services)){ 
                                            $booking_date = $request['booking_date'];   
                                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$from_slot));   
                                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$to_slot));   
                                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));

                                            $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                                            $service_array = [];
                                            $pre_selected = '';
                                            $pre_selected_flag = false;
                                            for($i=0;$i<count($selected_services);$i++){
                                                $service = $selected_services[$i];
                                                $service_details = $selected_service_details[$i];

                                                $this->db->where('id',$service);
                                                $this->db->where('salon_id', $salon_id);
                                                $this->db->where('branch_id', $branch_id);
                                                $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                                if (!empty($single_service)) {
                                                    $available_employees = [];

                                                    $service_from_datetime = new DateTime($selectedfrom);
                                                    $service_to_datetime = new DateTime($selectedfrom);

                                                    $service_duration = $single_service->service_duration;
                                                    $interval = new DateInterval("PT{$service_duration}M");
                                                    $service_to_datetime->add($interval);

                                                    $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                                    if (!empty($salon_employee_list)) {
                                                        foreach ($salon_employee_list as $result) {
                                                            $stylist_services = explode(',', $result->service_name);
                                                            if (in_array($service, $stylist_services)) {
                                                                $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_storewise) {
                                                                    $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                    if (!$is_emergency) {
                                                                        // $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        if ($is_stylist_available_shiftwise['is_allowed']) {
                                                                            $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                            if ($is_stylist_available_breakwise) {
                                                                                $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                                if ($is_stylist_available_short_breakwise) {
                                                                                    $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_resch_bookingwise_all($service_details, $result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                                    if ($is_stylist_available_bookingwise) {
                                                                                        $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                                        if($leave_flag == '0'){
                                                                                            $is_selected = '0';
                                                                                            if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                                $is_selected = '1';
                                                                                                $pre_selected = $result->id;
                                                                                                $pre_selected_flag = true;
                                                                                            }

                                                                                            $available_employees[] = array(
                                                                                                'stylist_id'            => $result->id,
                                                                                                'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                                'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                                'stylist_name'          => $result->full_name,
                                                                                                'stylist_designation'   => $result->designation_name,
                                                                                                'profile_photo'         => $result->profile_photo != "" ? base_url('admin_assets/images/employee_profile/' . $result->profile_photo) : '',
                                                                                                'is_selected'           => $rules_employee_selection == '2' ? '0' : $is_selected,
                                                                                            );
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }                                                
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $service_array[] = array(
                                                        'service_id'                    =>  $service,
                                                        'service_name'                  =>  $single_service->service_name,
                                                        'service_marathi_name'          =>  $single_service->service_name_marathi,
                                                        'image'                         =>  $single_service->category_image != "" ? base_url('admin_assets/images/service_image/' . $single_service->category_image) : '',
                                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                        'service_to'                    =>  $service_to,
                                                        'available_stylists'            =>  $available_employees,
                                                    );
                                                    $selectedfrom = $service_to;
                                                }
                                            }

                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = $service_array;
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Reschedule services not found';
                                            $json_arr['data'] = [];
                                        }
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Reschedule details not found';
                                        $json_arr['data'] = [];
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Booking details not found';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Booking slot not selected';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not found';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    
    public function get_reschedule_stylist_selection_page_flag(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   
                $from_slot = $request['slot_from'];   
                $to_slot = $request['slot_to'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id); 
                        if(!empty($rules)){
                            if($from_slot != "" && $to_slot != ""){
                                $rules_employee_selection = $rules->employee_selection;

                                $booking_id = $request['booking_id'];    
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$booking_id);
                                $this->db->where('customer_name',$customer->id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $single_booking = $this->db->get('tbl_new_booking')->row();
                                $selected_services = [];
                                $selected_service_details = [];
                                if(!empty($single_booking)){
                                    $reschedule_details = $request['reschedule_details']; 
                                    if($reschedule_details != "" && !empty($reschedule_details)){  
                                        for($i=0;$i<count($reschedule_details);$i++){
                                            $this->db->where('is_deleted','0');
                                            $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                            $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                            $this->db->where('booking_id',$single_booking->id);
                                            $this->db->where('customer_name',$customer->id);
                                            $this->db->where('branch_id', $branch_id);
                                            $this->db->where('salon_id', $salon_id);
                                            $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                            if(!empty($single_booking_services)){   
                                                $selected_services[] = $single_booking_services->service_id;
                                                $selected_service_details[] = $single_booking_services->id;
                                            }
                                        }
                                        $empty_selected_stylist_flag = '0';
                                        if(!empty($selected_services)){ 
                                            $booking_date = $request['booking_date'];   
                                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$from_slot));   
                                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$to_slot));   
                                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));

                                            $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                                            $service_array = [];
                                            $pre_selected = '';
                                            $pre_selected_flag = false;
                                            for($i=0;$i<count($selected_services);$i++){
                                                $service = $selected_services[$i];
                                                $service_details = $selected_service_details[$i];

                                                $this->db->where('id',$service);
                                                $this->db->where('salon_id', $salon_id);
                                                $this->db->where('branch_id', $branch_id);
                                                $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                                if (!empty($single_service)) {
                                                    $selected_stylists = array();
                                                    $available_employees = [];

                                                    $service_from_datetime = new DateTime($selectedfrom);
                                                    $service_to_datetime = new DateTime($selectedfrom);

                                                    $service_duration = $single_service->service_duration;
                                                    $interval = new DateInterval("PT{$service_duration}M");
                                                    $service_to_datetime->add($interval);

                                                    $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                                    $is_service_stylist_selected = '0';
                                                    if (!empty($salon_employee_list)) {
                                                        foreach ($salon_employee_list as $result) {
                                                            $stylist_services = explode(',', $result->service_name);
                                                            if (in_array($service, $stylist_services)) {
                                                                $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_storewise) {
                                                                    $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                    if (!$is_emergency) {
                                                                        // $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        if ($is_stylist_available_shiftwise['is_allowed']) {
                                                                            $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                            if ($is_stylist_available_breakwise) {
                                                                                $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                                if ($is_stylist_available_short_breakwise) {
                                                                                    $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_resch_bookingwise_all($service_details, $result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                                    if ($is_stylist_available_bookingwise) {
                                                                                        $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                                        if($leave_flag == '0'){
                                                                                            $is_selected = '0';
                                                                                            if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                                $is_selected = '1';
                                                                                                $pre_selected = $result->id;
                                                                                                $pre_selected_flag = true;
                                                                                            }                                                                                  

                                                                                            $single_service_emp = array(
                                                                                                'stylist_id'            => $result->id,
                                                                                                'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                                'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                                'stylist_name'          => $result->full_name,
                                                                                                'is_selected'           => $rules_employee_selection == '2' ? '0' : $is_selected,
                                                                                            );

                                                                                            $available_employees[] = $single_service_emp;

                                                                                            if($is_selected == '1'){
                                                                                                $selected_stylists = $single_service_emp;
                                                                                                $is_service_stylist_selected = '1';
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }                                                
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    if(empty($selected_stylists)){
                                                        if($empty_selected_stylist_flag == '0'){
                                                            $empty_selected_stylist_flag = '1';
                                                        }
                                                    }

                                                    $service_array[] = array(
                                                        'service_id'                    =>  $service,
                                                        'service_name'                  =>  $single_service->service_name,
                                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                        'service_to'                    =>  $service_to,
                                                        'is_service_stylist_selected'   =>  $is_service_stylist_selected,
                                                        'selected_stylists'             =>  $selected_stylists,
                                                    );
                                                    $selectedfrom = $service_to;
                                                }
                                            }

                                            if($rules_employee_selection == '2'){
                                                $is_stylist_selection_page = '1';
                                            }else{
                                                $is_stylist_selection_page = '0';
                                            }
                
                                            if($empty_selected_stylist_flag == '1'){
                                                $is_stylist_selection_page = '1';
                                            }
                
                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = array(
                                                'is_stylist_selection_page'     => $is_stylist_selection_page, 
                                                'service_stylists_data'         => $service_array 
                                            );
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Reschedule services not found';
                                            $json_arr['data'] = [];
                                        }
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Reschedule details not found';
                                        $json_arr['data'] = [];
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Booking details not found';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Booking slot not selected';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not found';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function reschedule_appointment(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                
                $reschedule_date = $request['booking_date'];                
                $reschedule_slot_from = $request['slot_from'];   
                $validate_data = array();             

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();
                if(!empty($single)){ 
                    if($reschedule_slot_from != ""){ 
                        $service_start_date = date('Y-m-d',strtotime($reschedule_date)) ?? '';
                        $service_start_time = date('H:i:s',strtotime($reschedule_slot_from)) ?? '';
                        
                        list($year, $month, $day) = explode('-', $service_start_date);
                        list($hour, $minute, $second) = explode(':', $service_start_time);
                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

                        $selectedfrom = date('Y-m-d H:i:s', $timestamp);  
                        $validate_selectedfrom = date('Y-m-d H:i:s', $timestamp);  

                        $booking_id = $request['booking_id'];    
                        $this->db->where('is_deleted','0');
                        $this->db->where('status','1');
                        $this->db->where('id',$booking_id);
                        $this->db->where('customer_name',$single->id);
                        $this->db->where('branch_id', $branch_id);
                        $this->db->where('salon_id', $salon_id);
                        $single_booking = $this->db->get('tbl_new_booking')->row();
                        if(!empty($single_booking)){ 
                            $reschedule_details = $request['reschedule_details']; 
                            if($reschedule_details != "" && !empty($reschedule_details)){
                                for($i=0;$i<count($reschedule_details);$i++){
                                    $this->db->where('is_deleted','0');
                                    $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                    $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                    $this->db->where('booking_id',$single_booking->id);
                                    $this->db->where('customer_name',$single->id);
                                    $this->db->where('branch_id', $branch_id);
                                    $this->db->where('salon_id', $salon_id);
                                    $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                    if(!empty($single_booking_services)){ 
                                        $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi'); 
                                        $this->db->where('tbl_salon_emp_service.id',$single_booking_services->service_id);
                                        $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                        $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                        $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                        $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                        $single_service = $this->db->get('tbl_salon_emp_service')->row();                        
                                        if (!empty($single_service)) {
                                            $validate_service_to_datetime = new DateTime($validate_selectedfrom);

                                            $service_duration = $single_service->service_duration;
                                            $interval = new DateInterval("PT{$service_duration}M");
                                            $validate_service_to_datetime->add($interval);

                                            $validate_selectedto = $validate_service_to_datetime->format('Y-m-d H:i:s');

                                            $validate_data[] = array(
                                                'stylist_id'            =>  $reschedule_details[$i]['stylist_id'],
                                                'service_date'          =>  date('Y-m-d',strtotime($reschedule_date)),
                                                'service_from'          =>  date('Y-m-d H:i:s',strtotime($validate_selectedfrom)),
                                                'service_to'            =>  date('Y-m-d H:i:s',strtotime($validate_selectedto)),
                                                'booking_id'            =>  $single_booking->id
                                            );

                                            $validate_selectedfrom = $validate_selectedto;
                                        }
                                    }
                                }

                                $valid_booking = $this->Salon_model->validate_booking_resc($validate_data,$branch_id,$salon_id);
                                if($valid_booking == 1){
                                    for($i=0;$i<count($reschedule_details);$i++){
                                        $this->db->where('is_deleted','0');
                                        $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                        $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                        $this->db->where('booking_id',$single_booking->id);
                                        $this->db->where('customer_name',$single->id);
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('salon_id', $salon_id);
                                        $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                        if(!empty($single_booking_services)){ 
                                            $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi'); 
                                            $this->db->where('tbl_salon_emp_service.id',$single_booking_services->service_id);
                                            $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                            $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                            $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                            $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                            $single_service = $this->db->get('tbl_salon_emp_service')->row();                        
                                            if (!empty($single_service)) {
                                                $service_to_datetime = new DateTime($selectedfrom);

                                                $service_duration = $single_service->service_duration;
                                                $interval = new DateInterval("PT{$service_duration}M");
                                                $service_to_datetime->add($interval);

                                                $selectedto = $service_to_datetime->format('Y-m-d H:i:s');

                                                $old_service_from = $single_booking_services->service_from;
                                                $old_service_to = $single_booking_services->service_to;
                                                $old_service_executive = $single_booking_services->stylist_id;
                                                $update_data = array(
                                                    'stylist_id'            =>  $reschedule_details[$i]['stylist_id'],
                                                    'booking_shift_id'      =>  $reschedule_details[$i]['stylist_shift_id'],
                                                    'booking_shift_type'    =>  $reschedule_details[$i]['stylist_shift_type'],
                                                    'service_date'          =>  date('Y-m-d',strtotime($reschedule_date)),
                                                    'service_from'          =>  date('Y-m-d H:i:s',strtotime($selectedfrom)),
                                                    'service_to'            =>  date('Y-m-d H:i:s',strtotime($selectedto))
                                                );
                                                $this->db->where('id',$single_booking_services->id);
                                                $this->db->update('tbl_booking_services_details',$update_data);                                        
                                                    
                                                $reschedule_data = array(
                                                    'customer_id'       =>  $single->id,
                                                    'branch_id'         =>  $branch_id,
                                                    'salon_id'          =>  $salon_id,
                                                    'rescheduled_from'  =>  '1',
                                                    'booking_id'        =>  $single_booking->id,
                                                    'service_details_id'=>  $single_booking_services->id,
                                                    'service_id'        =>  $single_booking_services->service_id,
                                                    'old_details'       =>  date('Y-m-d H:i:s',strtotime($old_service_from)).'@@@'.date('Y-m-d H:i:s',strtotime($old_service_to)).'@@@'.$old_service_executive,
                                                    'new_details'       =>  date('Y-m-d H:i:s',strtotime($selectedfrom)).'@@@'.date('Y-m-d H:i:s',strtotime($selectedto)).'@@@'.$reschedule_details[$i]['stylist_id'],
                                                    'created_on'        =>  date("Y-m-d H:i:s")
                                                );
                                                $this->db->insert('tbl_customer_rescheduled_bookings',$reschedule_data);
                                                        
                                                $selectedfrom = $selectedto;
                                            }
                                        }
                                    } 
                                    $update_booking_data = array(                                    
                                        'service_start_date'    => date("Y-m-d",strtotime($reschedule_date)),
                                        'service_start_time'    => date("H:i:s",strtotime($reschedule_slot_from)),
                                    );
                                    $this->db->where('id',$single_booking->id);
                                    $this->db->where('branch_id', $branch_id);
                                    $this->db->where('salon_id', $salon_id);
                                    $this->db->where('customer_name',$single->id);
                                    $this->db->update('tbl_new_booking',$update_booking_data);

                                    $this->Salon_model->update_booking_service_end_all($single_booking->id,$branch_id,$salon_id);                                

                                    $this->db->where('id',$single->id);
                                    $this->db->where('branch_id', $branch_id);
                                    $this->db->where('salon_id', $salon_id);
                                    $this->db->where('is_deleted','0');
                                    $customer_details = $this->db->get('tbl_salon_customer')->row();
                                    if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                                        $services_text = '';
                                        $this->db->where('id',$single_booking->id);
                                        $booking_details = $this->db->get('tbl_new_booking')->row();
                                        if(!empty($booking_details)){
                                            $services = explode(',',$booking_details->services);
                                            if(count($services) > 0){
                                                for($i=0;$i<count($services);$i++){
                                                    $this->db->where('id',$services[$i]);
                                                    $this->db->where('branch_id', $branch_id);
                                                    $this->db->where('salon_id', $salon_id);
                                                    $this->db->where('is_deleted','0');
                                                    $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                                    if (!empty($service_details)) {
                                                        // $services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                                        $services_text .= $service_details->service_name;
                                                        
                                                        if ($i < count($services) - 1) {
                                                            $services_text .= ', ';
                                                        }
                                                    }
                                                }
                                                $services_text = trim($services_text,',');
                                                $services_text = trim($services_text,' ');
                                                $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                                                $finalNumber = substr($cleanedNumber, -10);
                                                $finalNumber = '91' . $finalNumber;

                                                $this->db->where('is_deleted','0');
                                                $this->db->where('id', $branch_id);
                                                $this->db->where('salon_id', $salon_id);
                                                $branch = $this->db->get('tbl_branch')->row();
                                                $visit_text = '';
                                                if(!empty($branch)){
                                                    if($branch->branch_name != ""){
                                                        $visit_text .= $branch->branch_name;
                                                    }
                                                }

                                                $type = '6';
                                                $message = "Hello, " . $customer_details->full_name . "!%0aRescheduled Appointment:%0a%0a\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " at%0a\u{1F55B}" . date('h:i A',strtotime($booking_details->service_start_time)) . " for%0a\u{1F488}" . $services_text . "%0a%0aFeel free to reach out if you have any questions.%0a%0aThank you!%0a" . $visit_text . "";
                                                $app_message = "Hello, " . $customer_details->full_name . "!\nRescheduled Appointment:\n\n📅 " . date('d M, Y', strtotime($booking_details->service_start_date)) . " at\n🕒 " . date('h:i A', strtotime($booking_details->service_start_time)) . " for\n💇‍♀️ " . $services_text . "\n\nFeel free to reach out if you have any questions.\n\nThank you!\n" . $visit_text . "";
                                                $number = $finalNumber;
                                                $customer = $customer_details->id;
                                                $salon_id = $customer_details->salon_id;
                                                $branch_id = $customer_details->branch_id;
                                                $for_order_id = $booking_details->id;
                                                $for_offer_id = '';
                                                $for_query_id = '';
                                                $consent_form_id = '';
                                                $title = 'Appointment Rescheduled';
                                                $generated_from = '0';
                                                $notification_data = [
                                                    "landing_page"  => 'order_details',
                                                    "redirect_id"   => (string)$for_order_id
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
                                        }
                                    }

                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'success';
                                    $json_arr['data'] = array('booking_id'  =>  $single_booking->id);
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Slot not available now. Please select another slot';
                                    $json_arr['data'] = [];
                                }  
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Services not available for reschedule';
                                $json_arr['data'] = [];
                            }  
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not found';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Slot not selected';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function buy_membership(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                if(!empty($profile)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id',$customer_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();

                    if(!empty($single)){ 
                        $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                        $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                        $this->db->where('tbl_customer_membership_history.id',$single->membership_pkey);
                        $this->db->where('tbl_customer_membership_history.customer_id', $single->id);
                        $this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
                        $this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
                        $this->db->where('tbl_customer_membership_history.is_deleted','0');
                        $this->db->where('tbl_customer_membership_history.membership_status','0');
                        // $this->db->where('tbl_customer_membership_history.payment_status','1');
                        $membership_details = $this->db->get('tbl_customer_membership_history')->row();
                        if(empty($membership_details)){
                            $membership_id = $request['membership_id'];   
                            $payment_status = $request['payment_status']; 
                            if($payment_status == '1'){
                                $payment_status = '1';
                            }else{
                                $payment_status = '0';
                            }  
                            $payment_mode = $request['payment_mode'];   
                            if($payment_mode == '0'){
                                $membership_mode = 'UPI';
                            }elseif($payment_mode == '1'){
                                $membership_mode = 'Online';
                            }else{
                                $membership_mode = '';
                            }
                            if($payment_status == '1'){
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$membership_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $membership_data = $this->db->get('tbl_memebership')->row();
                                if(!empty($membership_data)){ 
                                    $duration_months = $membership_data->duration;
                                    $membership_start = date("Y-m-d");
                                    $membership_end = date("Y-m-d", strtotime("+" . $duration_months . " months", strtotime($membership_start)));
        
                                    $is_gst_applicable = '0';
                                    $gst_no = '';
                                    $gst_rate = 0;
                                    if($profile->is_gst_applicable == '1'){
                                        $gst_no = $profile->gst_no;
                                        $is_gst_applicable = '1';
                                        $setup = $this->Master_model->get_backend_setups();	
                                        if(!empty($setup)){
                                            $gst_rate = $setup->gst_rate;
                                        }
                                    }
                                    $gst_amount = ($membership_data->membership_price * ((float)$gst_rate)) / 100;

                                    $data1 = array(
                                        'buy_from' 		    => '1',
                                        'branch_id' 		=> $branch_id,
                                        'salon_id' 			=> $salon_id,
                                        'customer_id' 		=> $customer_id,
                                        'membership_id' 	=> $membership_data->id, 
                                        'employee_id' 	    => '', 
                                        'membership_price' 	=> $membership_data->membership_price, 

                                        'is_gst_applicable' => $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                        'salon_gst_no' 	    => $gst_no, 
                                        'salon_gst_rate' 	=> $gst_rate, 
                                        'gst_amount' 	    => $gst_amount, 

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
                                        'payment_mode' 	    => $membership_mode,  
                                        'payment_status'    => $payment_status == '1' ? $payment_status : '0',
                                        'payment_on'        => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'payment_date'      => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'created_on' 		=> date("Y-m-d H:i:s")
                                    ); 
                                    $this->db->insert('tbl_customer_membership_history',$data1);
                                    $membership_pkey = $this->db->insert_id();
                            
                                    $current_total_bill_amount = $single->total_bill_amount;
                                    $current_total_paid_amount = $single->total_paid_amount;
                                    $current_current_pending_amount = $single->current_pending_amount;
                                    $mem_final_price = $membership_data->membership_price + $gst_amount;
                                    
                                    $new_total_bill_amount = (float)$current_total_bill_amount + (float)$mem_final_price;
                                    $new_total_paid_amount = (float)$current_total_paid_amount + (float)$mem_final_price;
                                    $new_current_pending_amount = (float)$new_total_bill_amount - (float)$new_total_paid_amount;
                            
                                    $update_pkey = array(
                                        'total_bill_amount'         => $new_total_bill_amount,
                                        'total_paid_amount'         => $new_total_paid_amount,
                                        'current_pending_amount'    => $new_current_pending_amount,
                            
                                        'membership_pkey'           => $membership_pkey,
                                        'membership_id'             => $membership_id,
                                    );
                                    $this->db->where('id',$customer_id);
                                    $this->db->update('tbl_salon_customer',$update_pkey);                        
                                    
                                    $payment_data = array(
                                        'payment_from' 		        => '1',
                                        'branch_id' 		        => $branch_id,
                                        'salon_id' 			        => $salon_id,
                                        'customer_id' 		        => $customer_id,
                                        'type' 		                => '1',
                                        'membership_pkey'           => $membership_pkey,
                                        'membership_id'             => $membership_id,
                                        'opening_pending_amount' 	=> $current_current_pending_amount,
                                        'paid_amount' 		        => $mem_final_price,
                                        'closing_pending_amount' 	=> $new_current_pending_amount,
                                        'total_bill_amount' 		=> $current_total_bill_amount,
                                        'total_paid_amount' 	    => $current_total_paid_amount,
                                        'remark' 	                => 'Payment for membership purchase',
                                        'payment_date'              => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'payment_mode' 	            => $membership_mode, 
                                        'transaction_id' 	        => isset($request['transaction_id']) ? $request['transaction_id'] : '', 
                                    );
                                    $this->db->insert('tbl_booking_payment_entry', $payment_data);
                                    $payment_id = $this->db->insert_id();
        
                                    $data = array('payment_id'  =>  $payment_id);
                                    $this->db->where('id',$membership_pkey);
                                    $this->db->update('tbl_customer_membership_history',$data);  
        
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Membership added successfully';
                                    $json_arr['data'] = array('receipt'=>base_url('membership-print/' . base64_encode($membership_pkey) . '?print&mobile'));
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Membership not valid.';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Payment failed. Please complete the payment first.';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $membership_id = $request['membership_id'];   
                            $payment_status = $request['payment_status']; 
                            if($payment_status == '1'){
                                $payment_status = '1';
                            }else{
                                $payment_status = '0';
                            }  
                            $payment_mode = $request['payment_mode'];   
                            if($payment_mode == '0'){
                                $membership_mode = 'UPI';
                            }elseif($payment_mode == '1'){
                                $membership_mode = 'Online';
                            }else{
                                $membership_mode = '';
                            }
                            if($payment_status == '1'){
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$membership_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $membership_data = $this->db->get('tbl_memebership')->row();
                                if(!empty($membership_data)){ 
                                    $duration_months = $membership_data->duration;
                                    $membership_start = date("Y-m-d");
                                    $membership_end = date("Y-m-d", strtotime("+" . $duration_months . " months", strtotime($membership_start)));
        
                                    $is_gst_applicable = '0';
                                    $gst_no = '';
                                    $gst_rate = 0;
                                    if($profile->is_gst_applicable == '1'){
                                        $gst_no = $profile->gst_no;
                                        $is_gst_applicable = '1';
                                        $setup = $this->Master_model->get_backend_setups();	
                                        if(!empty($setup)){
                                            $gst_rate = $setup->gst_rate;
                                        }
                                    }
                                    $gst_amount = ($membership_data->membership_price * ((float)$gst_rate)) / 100;

                                    $data1 = array(
                                        'buy_from' 		    => '1',
                                        'branch_id' 		=> $branch_id,
                                        'salon_id' 			=> $salon_id,
                                        'customer_id' 		=> $customer_id,
                                        'membership_id' 	=> $membership_data->id, 
                                        'employee_id' 	    => '', 
                                        'membership_price' 	=> $membership_data->membership_price, 

                                        'is_gst_applicable' => $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                        'salon_gst_no' 	    => $gst_no, 
                                        'salon_gst_rate' 	=> $gst_rate, 
                                        'gst_amount' 	    => $gst_amount, 

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
                                        'payment_mode' 	    => $membership_mode, 
                                        'payment_status'    => $payment_status == '1' ? $payment_status : '0',
                                        'payment_on'        => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'payment_date'      => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'created_on' 		=> date("Y-m-d H:i:s")
                                    ); 
                                    $this->db->insert('tbl_customer_membership_history',$data1);
                                    $membership_pkey = $this->db->insert_id();
                            
                                    $current_total_bill_amount = $single->total_bill_amount;
                                    $current_total_paid_amount = $single->total_paid_amount;
                                    $current_current_pending_amount = $single->current_pending_amount;
                                    $mem_final_price = $membership_data->membership_price + $gst_amount;
                                    
                                    $new_total_bill_amount = (float)$current_total_bill_amount + (float)$mem_final_price;
                                    $new_total_paid_amount = (float)$current_total_paid_amount + (float)$mem_final_price;
                                    $new_current_pending_amount = (float)$new_total_bill_amount - (float)$new_total_paid_amount;
                            
                                    $update_pkey = array(
                                        'total_bill_amount'         => $new_total_bill_amount,
                                        'total_paid_amount'         => $new_total_paid_amount,
                                        'current_pending_amount'    => $new_current_pending_amount,
                            
                                        'membership_pkey'           => $membership_pkey,
                                        'membership_id'             => $membership_id,
                                    );
                                    $this->db->where('id',$customer_id);
                                    $this->db->update('tbl_salon_customer',$update_pkey);                        
                                    
                                    $payment_data = array(
                                        'payment_from' 		        => '1',
                                        'branch_id' 		        => $branch_id,
                                        'salon_id' 			        => $salon_id,
                                        'customer_id' 		        => $customer_id,
                                        'type' 		                => '1',
                                        'membership_pkey'           => $membership_pkey,
                                        'membership_id'             => $membership_id,
                                        'opening_pending_amount' 	=> $current_current_pending_amount,
                                        'paid_amount' 		        => $mem_final_price,
                                        'closing_pending_amount' 	=> $new_current_pending_amount,
                                        'total_bill_amount' 		=> $current_total_bill_amount,
                                        'total_paid_amount' 	    => $current_total_paid_amount,
                                        'remark' 	                => 'Payment for membership purchase',
                                        'payment_date'              => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'payment_mode' 	            => $membership_mode, 
                                        'transaction_id' 	        => isset($request['transaction_id']) ? $request['transaction_id'] : '', 
                                    );
                                    $this->db->insert('tbl_booking_payment_entry', $payment_data);
                                    $payment_id = $this->db->insert_id();
        
                                    $data = array('payment_id'  =>  $payment_id);
                                    $this->db->where('id',$membership_pkey);
                                    $this->db->update('tbl_customer_membership_history',$data);  
                                    
                                    $old_membership_data = array(
                                        'membership_status' =>  '2',
                                        'cancel_remark'     =>  'Membership cancelled because new membership purchased',
                                        'cancelled_on'      =>  date("Y-m-d H:i:s")
                                    );
                                    $this->db->where('id', $membership_details->id);
                                    $this->db->update('tbl_customer_membership_history', $old_membership_data);
        
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Membership added successfully';
                                    $json_arr['data'] = array('receipt'=>base_url('membership-print/' . base64_encode($membership_pkey) . '?print&mobile'));
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Membership not valid.';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Payment failed. Please complete the payment first.';
                                $json_arr['data'] = [];
                            }
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer not found';
                        $json_arr['data'] = [];
                    }   
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found';
                    $json_arr['data'] = [];
                }        
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function cancel_service(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $booking_id = $request['booking_id'];  
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('customer_name',$customer_id);
                    $this->db->where('id',$booking_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single_booking = $this->db->get('tbl_new_booking')->row();
                    if(!empty($single_booking)){      
                        $services_to_cancel = $request['services_to_cancel'];                    
                        $remark = $request['remark'];                    
                        $booking_rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
                        if(!empty($booking_rules) && $booking_rules->reward_point_cancellation == "1"){
                            $servicewise_cancellation = 1;
                        }else{
                            $servicewise_cancellation = 0;
                        }

                        $this->db->where('booking_id',$booking_id);
                        $this->db->where('is_deleted','0');
                        $services = $this->db->get('tbl_booking_services_details')->result();
                        if(!empty($services)){
                            foreach($services as $services_result){
                                if(in_array($services_result->id,$services_to_cancel)){
                                    $data = array(
                                        'service_status'    =>  '2',
                                        'cancel_remark'     =>  $remark,
                                        'canceled_by'       =>  '1',
                                        'cancelled_on'      =>  date("Y-m-d H:i:s"),
                                        'is_emergency_closure_cancellation'     =>  '0'
                                    );
                                    $this->db->where('id',$services_result->id);
                                    $this->db->update('tbl_booking_services_details',$data);                    
                
                                    if($services_result->service_added_from == '1'){
                                        $this->db->where('allocated_in_booking_id',$services_result->booking_id);
                                        $this->db->where('customer_name',$services_result->customer_name);
                                        $package_allocation = $this->db->get('tbl_customer_package_allocations')->row();
                                        if(!empty($package_allocation)){
                                            $this->db->where('customer_name',$package_allocation->customer_name);
                                            $this->db->where('pacakge_id',$package_allocation->package_id);
                                            $this->db->where('added_in_booking_id',$services_result->booking_id);
                                            $this->db->where('allocation_id',$package_allocation->id);
                                            $this->db->where('item_id',$services_result->service_id);
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
                                        if($services_result->service_marketing_discount_type == '1' && $services_result->is_service_discount_applied == '1' && $services_result->rewards_received_discount != "" && $services_result->rewards_received_discount != null){
                                            $deduct_rewards = $services_result->rewards_received_discount;
                                        
                                            $this->db->where('branch_id',$branch_id);
                                            $this->db->where('salon_id',$salon_id);
                                            $this->db->where('id',$services_result->customer_name);
                                            $customer = $this->db->get('tbl_salon_customer')->row();
                                            if(!empty($customer)){
                                                $pre_balance = $customer->rewards_balance;
                                                $rewards = $deduct_rewards;
                                                $new_balance = $pre_balance - $rewards;

                                                $reward_data = array(
                                                    'customer_id'                   =>  $services_result->customer_name,
                                                    'branch_id'                     =>  $services_result->branch_id,
                                                    'salon_id'                      =>  $services_result->salon_id,
                                                    'booking_id'                    =>  $services_result->booking_id,
                                                    'rewards_for'                   =>  ($services_result->service_added_from == "1") ? '1' : '0',
                                                    'for_service'                   =>  $services_result->service_id,
                                                    'booking_service_details_id'    =>  $services_result->id,
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
                                    }
                                }
                            }
                            $this->Salon_model->update_booking_service_end_all($booking_id,$branch_id,$salon_id);

                            $this->db->where('booking_id',$single_booking->id);
                            $this->db->where('is_deleted','0');
                            $this->db->where('service_status','2');
                            $cancelled_services = $this->db->get('tbl_booking_services_details')->result();
                            if(count($services) == count($cancelled_services)){
                                $update_data = array(
                                    'booking_status'    =>  '2',
                                    'canceled_by'       =>  '1',
                                    'cancel_remark'     =>  $remark,
                                    'cancelled_on'      =>  date("Y-m-d H:i:s"),
                                    'is_emergency_closure_cancellation'     =>  '0'
                                );
                                $this->db->where('id',$single_booking->id);
                                $this->db->update('tbl_new_booking',$update_data);
                            }                

                            if(!empty($services_to_cancel) && $services_to_cancel != ""){
                                $this->db->where('id',$single_booking->customer_name);
                                $this->db->where('branch_id',$branch_id);
                                $this->db->where('salon_id',$salon_id);
                                $this->db->where('is_deleted','0');
                                $customer_details = $this->db->get('tbl_salon_customer')->row();
                                if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                                    $services_text = '';
                                    $this->db->where('id',$single_booking->id);
                                    $booking_details = $this->db->get('tbl_new_booking')->row();
                                    if(!empty($booking_details)){
                                        $services = $services_to_cancel;
                                        if(count($services) > 0){
                                            for($i=0;$i<count($services);$i++){
                                                $this->db->where('booking_id',$single_booking->id);
                                                $this->db->where('id',$services[$i]);
                                                $this->db->where('is_deleted','0');
                                                $service_schedule_details = $this->db->get('tbl_booking_services_details')->row();
                                                if(!empty($service_schedule_details)){
                                                    $this->db->where('id',$service_schedule_details->service_id);
                                                    $this->db->where('branch_id',$branch_id);
                                                    $this->db->where('salon_id',$salon_id);
                                                    $this->db->where('is_deleted','0');
                                                    $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                                    if (!empty($service_details)) {
                                                        // $services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                                        $services_text .= $service_details->service_name;
                                                        
                                                        if ($i < count($services) - 1) {
                                                            $services_text .= ', ';
                                                        }
                                                    }
                                                }
                                            }
                                            $services_text = trim($services_text,',');
                                            $services_text = trim($services_text,' ');
                                            $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                                            $finalNumber = substr($cleanedNumber, -10);
                                            $finalNumber = '91' . $finalNumber;

                                            $this->db->where('is_deleted','0');
                                            $this->db->where('id',$customer_details->branch_id);
                                            $this->db->where('salon_id',$customer_details->salon_id);
                                            $branch = $this->db->get('tbl_branch')->row();
                                            $visit_text = '';
                                            if(!empty($branch)){
                                                if($branch->branch_name != ""){
                                                    $visit_text .= $branch->branch_name.'%0a';
                                                }
                                            }

                                            $type = '7';
                                            $message = "Hello, " . $customer_details->full_name . "!%0aCancelled Appointment:%0a%0a\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " for%0a\u{1F488}" . $services_text . "%0a%0aThank you!%0a" . $visit_text . "";
                                            $app_message = "Hello, " . $customer_details->full_name . "!\nCancelled Appointment:\n\n\u{1F5D3}" . date('d M, Y', strtotime($booking_details->service_start_date)) . " for\n\u{1F488}" . $services_text . "\n\nThank you!\n" . $visit_text . "";
                                            $number = $finalNumber;
                                            $customer = $customer_details->id;
                                            $salon_id = $customer_details->salon_id;
                                            $branch_id = $customer_details->branch_id;
                                            $for_order_id = $booking_details->id;
                                            $for_offer_id = '';
                                            $for_query_id = '';
                                            $consent_form_id = '';
                                            $title = 'Appointment Cancelled';
                                            $generated_from = '1';
                                            $notification_data = [
                                                "landing_page"  => 'cancelled_list',
                                                "redirect_id"   => (string)$for_order_id
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
                                    }
                                }
                            }   

                            $this->db->where('booking_id',$single_booking->id);
                            $this->db->where('is_deleted','0');
                            $this->db->where('service_status','0');
                            $new_services = $this->db->get('tbl_booking_services_details')->result();
                            $array = array();
                            if(!empty($new_services)){
                                foreach($new_services as $new_services_result){
                                    $array[] = $new_services_result->service_id;
                                }
                            }

                            $update_data = array(
                                'services'    =>  implode(',',$array),
                            );
                            $this->db->where('id',$single->id);
                            $this->db->update('tbl_new_booking',$update_data);                            

                            $this->Salon_model->send_trying_for_booking_messages($single->id);
    
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'Service canceled successfully';
                            $json_arr['data'] = array('booking_id'=>$booking_id);
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Something went wrong, Please try again.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Booking not found';
                        $json_arr['data'] = [];
                    } 
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function buy_packages(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                if(!empty($profile)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id',$customer_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();

                    if(!empty($single)){ 
                        $package_id = $request['package_id'];   
                        $payment_status = $request['payment_status']; 
                        if($payment_status == '1'){
                            $payment_status = '1';
                        }else{
                            $payment_status = '0';
                        }  
                        $payment_mode = $request['payment_mode'];   
                        if($payment_mode == '0'){
                            $payment_mode = 'UPI';
                        }elseif($payment_mode == '1'){
                            $payment_mode = 'Online';
                        }else{
                            $payment_mode = '';
                        }
                        if($payment_status == '1'){
                            $this->db->where('is_deleted','0');
                            $this->db->where('status','1');
                            $this->db->where('is_lapsed','0');
                            $this->db->where('customer_name',$customer_id);
                            $this->db->where('package_id',$package_id);
                            $this->db->where('branch_id', $branch_id);
                            $this->db->where('salon_id', $salon_id);
                            $this->db->where('DATE(package_start_date) <=', date('Y-m-d'));
                            $this->db->where('DATE(package_end_date) >=', date('Y-m-d'));
                            $is_package_active = $this->db->get('tbl_customer_package_allocations')->row();
                            if(empty($is_package_active)){
                                $this->db->where('is_deleted','0');
                                $this->db->where('status','1');
                                $this->db->where('id',$package_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $package_data = $this->db->get('tbl_package')->row();
                                if(!empty($package_data)){ 
                                    $count_type = $package_data->count_type;
                                    if($count_type == 'Days'){
                                        $count_value = $package_data->count_value;
                                    }elseif($count_type == 'Week'){
                                        $count_value = $package_data->count_value * 7;
                                    }elseif($count_type == 'Month'){
                                        $count_value = $package_data->count_value * 30;
                                    }elseif($count_type == 'Year'){
                                        $count_value = $package_data->count_value * 365;
                                    }else{
                                        $count_value = $package_data->count_value;
                                    }
                                    $package_start = date("Y-m-d");
                                    $package_end = date("Y-m-d", strtotime("+" . $count_value . " days", strtotime($package_start)));     

                                    $is_gst_applicable = '0';
                                    $gst_no = '';
                                    $gst_rate = 0;
                                    if($profile->is_gst_applicable == '1'){
                                        $gst_no = $profile->gst_no;
                                        $is_gst_applicable = '1';
                                        $setup = $this->Master_model->get_backend_setups();	
                                        if(!empty($setup)){
                                            $gst_rate = $setup->gst_rate;
                                        }
                                    }
                                    $gst_amount = ($package_data->amount * ((float)$gst_rate)) / 100;

                                    $allocation_data = array(
                                        'buy_from' 		        => '1',
                                        'customer_name'         =>  $customer_id,
                                        'allocated_by'          =>  '',
                                        'package_id'            =>  $package_id,
                                        'branch_id' 			=>  $branch_id,
                                        'salon_id' 				=>  $salon_id,
                                        'package_start_date'    =>  $package_start,
                                        'package_end_date'      =>  $package_end,
                                        'actual_price'          =>  $package_data->actual_price,
                                        'discount'              =>  $package_data->discount,
                                        'discount_in'           =>  $package_data->discount_in,
                                        'package_amount'        =>  $package_data->amount,
                                        
                                        'is_gst_applicable'     => $is_gst_applicable == '1' ? $is_gst_applicable : '0',
                                        'salon_gst_no'          => $gst_no,
                                        'salon_gst_rate'        => $gst_rate,
                                        'gst_amount'            => $gst_amount,

                                        'payment_mode' 	        => $payment_mode, 
                                        'is_booking_done'       => $payment_status == '1' ? $payment_status : '0',
                                        'payment_on'            => $payment_status == '1' ? date("Y-m-d H:i:s") : null,

                                        'created_on'            =>  date("Y-m-d H:i:s"),
                                    );
                                    $this->db->insert('tbl_customer_package_allocations', $allocation_data);
                                    $allocation_id = $this->db->insert_id();

                                    $package_all_services = explode(',',$package_data->service_name);

                                    if(!empty($package_all_services)){
                                        for($i=0;$i<count($package_all_services);$i++){
                                            $package_service_products = $this->Salon_model->get_package_products_single_all($package_data->id,$package_all_services[$i],$branch_id,$salon_id);
                                            $package_item_details = array(
                                                'branch_id' 			=> $branch_id,
                                                'salon_id' 				=> $salon_id,
                                                'allocation_id' 		=> $allocation_id,
                                                'customer_name' 		=> $customer_id,
                                                'pacakge_id' 		    => $package_id,
                                                'package_amount' 		=> $package_data->amount,
                                                'item_type'             =>  '0',
                                                'item_id'               =>  $package_all_services[$i],
                                                'products_id'           =>  !empty($package_service_products) ? $package_service_products->product_ids : null,
                                                'item_added_on'         =>  date("Y-m-d"),
                                                'package_start_date'    =>  $package_start,
                                                'created_on'            =>  date("Y-m-d H:i:s"),
                                            );
                                            $this->db->insert('tbl_booking_package_detail_status', $package_item_details);      
                                        }
                                    }  
                            
                                    $current_total_bill_amount = $single->total_bill_amount;
                                    $current_total_paid_amount = $single->total_paid_amount;
                                    $current_current_pending_amount = $single->current_pending_amount;
                                    $package_final_price = $package_data->amount + $gst_amount;
                                    
                                    $new_total_bill_amount = (float)$current_total_bill_amount + (float)$package_final_price;
                                    $new_total_paid_amount = (float)$current_total_paid_amount + (float)$package_final_price;
                                    $new_current_pending_amount = (float)$new_total_bill_amount - (float)$new_total_paid_amount;
                            
                                    $update_pkey = array(
                                        'total_bill_amount'         => $new_total_bill_amount,
                                        'total_paid_amount'         => $new_total_paid_amount,
                                        'current_pending_amount'    => $new_current_pending_amount,
                                    );
                                    $this->db->where('id',$customer_id);
                                    $this->db->update('tbl_salon_customer',$update_pkey);                        
                                    
                                    $payment_data = array(
                                        'payment_from' 		        => '1',
                                        'branch_id' 		        => $branch_id,
                                        'salon_id' 			        => $salon_id,
                                        'customer_id' 		        => $customer_id,
                                        'type' 		                => '4',
                                        'package_id'                => $package_id,
                                        'package_allocation_id'     => $allocation_id,
                                        'opening_pending_amount' 	=> $current_current_pending_amount,
                                        'paid_amount' 		        => $package_final_price,
                                        'closing_pending_amount' 	=> $new_current_pending_amount,
                                        'total_bill_amount' 		=> $current_total_bill_amount,
                                        'total_paid_amount' 	    => $current_total_paid_amount,
                                        'remark' 	                => 'Payment for package purchase',
                                        'payment_date'              => $payment_status == '1' ? date("Y-m-d H:i:s") : null,
                                        'payment_mode' 	            => $payment_mode, 
                                        'transaction_id' 	        => isset($request['transaction_id']) ? $request['transaction_id'] : '', 
                                    );
                                    $this->db->insert('tbl_booking_payment_entry', $payment_data);
                                    $payment_id = $this->db->insert_id();

                                    $data = array('payment_id'  =>  $payment_id);
                                    $this->db->where('id',$allocation_id);
                                    $this->db->update('tbl_customer_package_allocations',$data);  

                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Package added successfully';
                                    $json_arr['data'] = array('receipt'=>base_url('package-print/' . base64_encode($allocation_id) . '?print&mobile'));
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Package not valid.';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'This Package is currently active.';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Complete the payment first.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer not found';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found';
                    $json_arr['data'] = [];
                }         
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function buy_giftcard(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                if(!empty($profile)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('id',$customer_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();

                    if(!empty($single)){ 
                        $giftcard_id = $request['giftcard_id'];   
                        $payment_status = $request['payment_status']; 
                        if($payment_status == '1'){
                            $payment_status = '1';
                        }else{
                            $payment_status = '0';
                        }  
                        $payment_mode = $request['payment_mode'];   
                        if($payment_mode == '0'){
                            $payment_mode = 'UPI';
                        }elseif($payment_mode == '1'){
                            $payment_mode = 'Online';
                        }else{
                            $payment_mode = '';
                        }
                        if($payment_status == '1'){                        
                            $this->db->where('branch_id', $branch_id);
                            $this->db->where('salon_id', $salon_id);
                            $this->db->where('id',$giftcard_id);
                            $this->db->where('is_deleted','0');
                            $single_giftcard = $this->db->get('tbl_gift_card')->row();
                            if(!empty($single_giftcard)){
                                $gift_card_balance = $single_giftcard->gift_price != "" ? $single_giftcard->gift_price : $single_giftcard->regular_price;
                                if($gift_card_balance > 0){
                                    $gift_card_status = '0';
                                }elseif($gift_card_balance == 0){
                                    $gift_card_status = '1';
                                    $gift_card_balance = '0';
                                }else{
                                    $gift_card_status = '1';
                                    $gift_card_balance = '0';
                                }
                                // echo '<pre>'; print_r($gift_card_status); 
                                // echo '<pre>'; print_r($gift_card_balance); exit();
                                
                                $is_gst_applicable = '0';
                                $gst_no = '';
                                $gst_rate = 0;
                                if($profile->is_gst_applicable == '1'){
                                    $gst_no = $profile->gst_no;
                                    $is_gst_applicable = '1';
                                    $setup = $this->Master_model->get_backend_setups();	
                                    if(!empty($setup)){
                                        $gst_rate = $setup->gst_rate;
                                    }
                                }
                                $gst_amount = ($single_giftcard->regular_price * ((float)$gst_rate)) / 100;

                                $giftcard_data = array(
                                    'branch_id' 			=> $branch_id,
                                    'salon_id' 				=> $salon_id,
                                    'payment_from'          => '1', 
                                    'type'                  => '3',
                                    'customer_id' 		    => $customer_id,
                                    
                                    'giftcard_id' 	        => $single_giftcard->id,
                                    'gift_card_name' 	    => $single_giftcard->gift_name,
                                    'gift_card_code' 	        => $single_giftcard->gift_card_code,
                                    'giftcard_min_amount' 	    => $single_giftcard->min_booking_amt,
                                    'gift_card_regular_price' 	=> $single_giftcard->regular_price,
                                    'paid_amount' 	            => $single_giftcard->regular_price + $gst_amount,
                                    
                                    'is_gst_applicable'         => $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                    'salon_gst_no' 	            => $gst_no, 
                                    'salon_gst_rate' 	        => $gst_rate, 
                                    'gst_amount' 	            => $gst_amount, 

                                    'gift_card_price' 	        => $single_giftcard->gift_price != "" ? $single_giftcard->gift_price : $single_giftcard->regular_price,
                                    'gift_card_balance' 	    => $gift_card_balance,
                                    'gift_card_status' 	        => $gift_card_status,
                                    'created_on'                => date("Y-m-d H:i:s"),
                                    'payment_date'              => date("Y-m-d H:i:s"),
                                    'payment_mode' 	            => $payment_mode,
                                    'transaction_id' 	        => isset($request['transaction_id']) ? $request['transaction_id'] : '', 
                                );
                                $this->db->insert('tbl_booking_payment_entry', $giftcard_data);
                                $giftcard_payment_id = $this->db->insert_id();

                                $giftcard_customer_uid = $single_giftcard->gift_card_code . '' . $giftcard_payment_id . '' . date("ym"); 
                                $this->db->where('id',$giftcard_payment_id);
                                $this->db->update('tbl_booking_payment_entry',array('giftcard_customer_uid'=>$giftcard_customer_uid));
                                
                                $json_arr['status'] = 'true';
                                $json_arr['message'] = 'Giftcard added successfully';
                                $json_arr['data'] = array('receipt'=>base_url('giftcard-print/' . base64_encode($giftcard_payment_id) . '?print&mobile'));
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Giftcard details not found.';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Complete the payment first.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer not found';
                        $json_arr['data'] = [];
                    }  
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found';
                    $json_arr['data'] = [];
                }            
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function set_booking_reminder(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $booking_id = $request['booking_id'];  
                    $this->db->where('is_deleted','0');
                    $this->db->where('status','1');
                    $this->db->where('customer_name',$customer_id);
                    $this->db->where('id',$booking_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single_booking = $this->db->get('tbl_new_booking')->row();
                    if(!empty($single_booking)){  
                        if(date('Y-m-d H:i:s') <= date('Y-m-d H:i:s',strtotime($single_booking->service_start_date.' '.$single_booking->service_end_date))){
                            $is_reminder_set = $request['is_reminder_set'];  
                            if($is_reminder_set == '1'){
                                $update_data = array(
                                    'reminder'  =>  '3'
                                ); 
                            }else{
                                $update_data = array(
                                    'reminder'  =>  null
                                ); 
                            }
                            $this->db->where('id',$single_booking->id);
                            $this->db->update('tbl_new_booking',$update_data);

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'Booking reminder updated successfully';
                            $json_arr['data'] = array('booking_id'=>$booking_id);
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'The booking time has already passed. Reminder could not be updated.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Booking not found';
                        $json_arr['data'] = [];
                    } 
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function get_store_service_products(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                
                $service_id = $request['service_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $this->db->where('tbl_salon_emp_service.status', '1');
                    $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                    $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                    $this->db->where('tbl_salon_emp_service.id', $service_id);
                    $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_service_category.order');
                    $this->db->from('tbl_salon_emp_service');
                    $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                    $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                    // $this->db->order_by('tbl_salon_emp_service.id', 'DESC');
                    $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');
                
                    $result = $this->db->get();
                    $services = $result->row();
                    
                    if(!empty($services)){ 
                        $service_products = $this->Salon_model->get_selected_service_products($services->product);
                        $products = [];
                        if(!empty($service_products)){       
                            foreach($service_products as $service_products_result){  
                                $selling_price = $service_products_result->selling_price != "" ? (float)$service_products_result->selling_price : 0.00;
                                $product_discount_in = '';
                                $product_discount_type = '';
                                $product_discount_amount_value = '';
                                $product_discount_row_id = '';
                                $is_product_discount_applied = '0';

                                $product_discount_text = '';
                                $product_discount_amount = 0;
                                $product_slab_increment = '5';
                                $product_slab_consider = '';
                                $product_min_slab = '';
                                $product_max_slab = '';

                                $product_applied_discount = $this->Salon_model->get_customer_product_applied_discount($single->id,$service_products_result->id);
                                if($product_applied_discount['is_discount_applied'] == '1'){
                                    $is_product_discount_applied = '1';
                                    $product_discount_row_id = $product_applied_discount['discount_row_id'];
                                    $product_discount_type = $product_applied_discount['discount_type'];
                                    $product_discount_in = $product_applied_discount['discount_in'];
                                    $product_discount_amount_value = (float)$product_applied_discount['discount_amount'];
                                    $product_min_slab = $product_applied_discount['min_flexible'];
                                    $product_max_slab = $product_applied_discount['max_flexible'];
                                    if($product_discount_type == '1'){    //Flexible
                                        $customer_last_service_product_booking = $this->Salon_model->get_customer_last_service_product_booking($single->id,$service_products_result->id);
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
                                            $product_discount_text = $product_slab_consider . '% Off';
                                        }elseif($product_discount_in == '1'){ //flat
                                            $product_discount_amount = (float)$product_slab_consider;
                                            $product_discount_text = 'Flat Rs. ' . $product_slab_consider . ' Off';
                                        }
                                    }elseif($product_discount_type == '0'){   //Fixed
                                        if($product_discount_in == '0'){  //percentage
                                            $product_discount_amount = ((float)$product_discount_amount_value * (float)$selling_price) / 100;
                                            $product_discount_text = $product_discount_amount_value . '% Off';
                                        }elseif($product_discount_in == '1'){ //flat
                                            $product_discount_amount = (float)$product_discount_amount_value;
                                            $product_discount_text = 'Flat Rs. ' . $product_discount_amount_value . ' Off';
                                        }
                                    }
                                }

                                $service_product_price_consider = $selling_price - $product_discount_amount;
                                $original_product_price = $selling_price;
                                $products[] = array(
                                    'service_id'    =>  $services->id,
                                    'product_id'    =>  $service_products_result->id,
                                    'price'         =>  $service_product_price_consider,
                                    'product_name'  =>  $service_products_result->product_name,
                                    'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
                                );
                            }
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $products;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Products not available';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Service not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_packages(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $package_id = isset($request['package_id']) ? $request['package_id'] : '';  
                    
                    if($package_id != ""){
                        $this->db->where('tbl_package.id', $package_id);
                    } 
                    $this->db->where('tbl_package.status', '1');
                    $this->db->where('tbl_package.is_deleted', '0');
                    $this->db->where('tbl_package.branch_id', $branch_id);
                    $this->db->where('tbl_package.salon_id', $salon_id);
                    if($single->gender != ""){
                        $this->db->where('tbl_package.gender',$single->gender);
                    }
                    $this->db->order_by('tbl_package.id', 'DESC');                
                    $result = $this->db->get('tbl_package');
                    $packages = $result->result();
                    
                    $salon_profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                    $is_gst_applicable = '0';
                    $gst_rate = 0;
                    if(!empty($salon_profile)){
                        if($salon_profile->is_gst_applicable == '1'){
                            $is_gst_applicable = '1';
                            $setup = $this->Master_model->get_backend_setups();	
                            if(!empty($setup)){
                                $gst_rate = $setup->gst_rate;
                            }
                        }
                    }

                    if(!empty($packages)){ 
                        $data = array();
                        foreach($packages as $packages_result){   
                            $this->db->where('tbl_customer_package_allocations.is_deleted','0');
                            $this->db->where('tbl_customer_package_allocations.is_lapsed','0');
                            $this->db->where('tbl_customer_package_allocations.branch_id', $branch_id);
                            $this->db->where('tbl_customer_package_allocations.salon_id', $salon_id);
                            $this->db->where('tbl_customer_package_allocations.customer_name',$customer_id);
                            $this->db->where('tbl_customer_package_allocations.package_id', $packages_result->id);
                            $this->db->where('DATE(tbl_customer_package_allocations.package_start_date) <=', date('Y-m-d'));
                            $this->db->where('DATE(tbl_customer_package_allocations.package_end_date) >=', date('Y-m-d'));
                            $is_active = $this->db->get('tbl_customer_package_allocations')->num_rows();
                            if($is_active > 0){
                                $is_active = '1';
                            }else{
                                $is_active = '0';
                            }

                            $discount_text = '';
                            $discount_type = $packages_result->discount_in;
                            $discount_amt = 0;
                            if($discount_type == '0'){
                                $discount_amt = ($packages_result->actual_price * $packages_result->discount) / 100;
                                $package_amt = $packages_result->actual_price - $discount_amt;
                                $discount_text = $packages_result->discount . '% Off';
                            }elseif($discount_type == '1'){
                                $discount_amt = $packages_result->discount;
                                $package_amt = $packages_result->actual_price - $discount_amt;
                                $discount_text = 'Flat Rs.' . $packages_result->discount . ' Off';
                            }else{
                                $package_amt = $packages_result->actual_price;
                            }

                            $services_text = '';
                            $duration = 0;
                            $services_array = [];
                            $service_names = explode(',', $packages_result->service_name);
                            $service_count = count($service_names);

                            for($i = 0; $i < $service_count; $i++){                               
                                $this->db->where('tbl_salon_emp_service.status', '1');
                                $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                                $this->db->where('tbl_salon_emp_service.id', $service_names[$i]);
                                $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
                                $this->db->from('tbl_salon_emp_service');
                                $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                                $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                                $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');                        
                                $result = $this->db->get();
                                $single_service = $result->row();
                                if(!empty($single_service)){
                                    $service_products = $this->Salon_model->get_selected_service_products($single_service->product);
                                    $products = [];
                                    if(!empty($service_products)){
                                        foreach($service_products as $service_products_result){
                                            $selling_price = $service_products_result->selling_price != "" ? (float)$service_products_result->selling_price : 0.00;
                                            $product_discount_in = '';
                                            $product_discount_type = '';
                                            $product_discount_amount_value = '';
                                            $product_discount_row_id = '';
                                            $is_product_discount_applied = '0';
            
                                            $product_discount_text = '';
                                            $product_discount_amount = 0;
                                            $product_slab_increment = '5';
                                            $product_slab_consider = '';
                                            $product_min_slab = '';
                                            $product_max_slab = '';
            
                                            $product_applied_discount = $this->Salon_model->get_customer_product_applied_discount($single->id,$service_products_result->id);
                                            if($product_applied_discount['is_discount_applied'] == '1'){
                                                $is_product_discount_applied = '1';
                                                $product_discount_row_id = $product_applied_discount['discount_row_id'];
                                                $product_discount_type = $product_applied_discount['discount_type'];
                                                $product_discount_in = $product_applied_discount['discount_in'];
                                                $product_discount_amount_value = (float)$product_applied_discount['discount_amount'];
                                                $product_min_slab = $product_applied_discount['min_flexible'];
                                                $product_max_slab = $product_applied_discount['max_flexible'];
                                                if($product_discount_type == '1'){    //Flexible
                                                    $customer_last_service_product_booking = $this->Salon_model->get_customer_last_service_product_booking($single->id,$service_products_result->id);
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
                                                        $product_discount_text = $product_slab_consider . '% Off';
                                                    }elseif($product_discount_in == '1'){ //flat
                                                        $product_discount_amount = (float)$product_slab_consider;
                                                        $product_discount_text = 'Flat Rs. ' . $product_slab_consider . ' Off';
                                                    }
                                                }elseif($product_discount_type == '0'){   //Fixed
                                                    if($product_discount_in == '0'){  //percentage
                                                        $product_discount_amount = ((float)$product_discount_amount_value * (float)$selling_price) / 100;
                                                        $product_discount_text = $product_discount_amount_value . '% Off';
                                                    }elseif($product_discount_in == '1'){ //flat
                                                        $product_discount_amount = (float)$product_discount_amount_value;
                                                        $product_discount_text = 'Flat Rs. ' . $product_discount_amount_value . ' Off';
                                                    }
                                                }
                                            }
            
                                            $service_product_price_consider = $selling_price - $product_discount_amount;
                                            $original_product_price = $selling_price;
                                            $products[] = array(
                                                'service_id'    =>  $single_service->id,
                                                'product_id'    =>  $service_products_result->id,
                                                'product_name'  =>  $service_products_result->product_name,
                                                'product_price' =>  $service_product_price_consider,
                                                'product_added_from'=>  '1',
                                                'image'         =>  $service_products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$service_products_result->product_photo)[0]) : '',
                                            );
                                        }
                                    }

                                    $services_text .= $single_service->service_name;
                                    if ($i < $service_count - 1) {
                                        $services_text .= ', ';
                                    }
                                    $duration += intval($single_service->service_duration);

                                    $services_array[] = array(
                                        'is_special'        =>  $single_service->is_special,
                                        'service_id'        =>  $single_service->id,
                                        'category_id'       =>  $single_service->category,
                                        'sub_category_id'   =>  $single_service->sub_category,                                        
                                        'service_name'      =>  $single_service->service_name,
                                        'service_marathi_name'    =>  $single_service->service_name_marathi,
                                        'image'             =>  $single_service->category_image != "" ? base_url('admin_assets/images/service_image/' . $single_service->category_image) : '',
                                        'category_name'     =>  $single_service->sup_category,
                                        'sub_category_name' =>  $single_service->subcategory,
                                        'category_name_marathi'     =>  $single_service->sup_category_marathi,
                                        'sub_category_name_marathi' =>  $single_service->sub_category_marathi,
                                        'products'          =>  $products,
                                        'service_description'     =>  strip_tags($single_service->service_description),
                                        'service_duration'  =>  $single_service->service_duration,
                                        'service_added_from'=>  '1',
                                        'is_old_package'    =>  $is_active
                                    );
                                }
                            }
                            
                            $duration = $packages_result->count_value;
                            $duration_type = $packages_result->count_type;
                            if($duration_type == 'Days'){
                                if($duration > 1){
                                    $duration_text = $duration.' Days';
                                }else{
                                    $duration_text = $duration.' Day';
                                }
                            }elseif($duration_type == 'Week'){
                                if($duration > 1){
                                    $duration_text = $duration.' Weeks';
                                }else{
                                    $duration_text = $duration.' Week';
                                }
                            }elseif($duration_type == 'Month'){
                                if($duration > 1){
                                    $duration_text = $duration.' Months';
                                }else{
                                    $duration_text = $duration.' Month';
                                }
                            }elseif($duration_type == 'Year'){
                                if($duration > 1){
                                    $duration_text = $duration.' Years';
                                }else{
                                    $duration_text = $duration.' Year';
                                }
                            }else{
                                if($duration > 1){
                                    $duration_text = $duration.' Days';
                                }else{
                                    $duration_text = $duration.' Day';
                                }
                            }

                            $gst_amount = ($package_amt * ((float)$gst_rate)) / 100;
                            if($is_active == '0'){
                                $data[] = array(
                                    'package_id'    =>  $packages_result->id,
                                    'package_name'  =>  $packages_result->package_name,
                                    'package_name_marathi'     =>  $packages_result->package_name_marathi,
                                    
                                    'is_old_package'=>  $is_active,
                                    'services'      =>  $services_text,
                                    'services_array'=>  $services_array,
                                    'description'   =>  $packages_result->description,
                                    'duration'      =>  $duration,
                                    'duration_text' =>  $duration_text,
                                    'discount_text' =>  $discount_text,
                                    'discounted_price'  =>  $package_amt,
                                    'price'         =>  $package_amt + $gst_amount,
                                    'original_price'=>  $packages_result->actual_price,
                                    'description'   =>  $packages_result->description,
                                    'image'         =>  $packages_result->package_image != "" ? base_url('admin_assets/images/package_image/' . $packages_result->package_image) : '',
                                    
                                    'discount_amount'       =>  $discount_amt,
                                    'is_gst_applicable'     =>  $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                    'salon_gst_rate' 	    =>  $gst_rate, 
                                    'gst_amount' 	        =>  $gst_amount, 
                                );
                            }
                        }                            
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Packages not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_giftcard_details(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $giftcard_no = $request['giftcard_no'];  
                    
                    $this->db->select('tbl_booking_payment_entry.*, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
                    $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
                    $this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
                    $this->db->where('tbl_gift_card.gender',$single->gender);
                    $this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
                    // $this->db->where('tbl_booking_payment_entry.customer_id',$single->id);
                    $this->db->where('tbl_booking_payment_entry.giftcard_customer_uid',$giftcard_no);
                    $this->db->where('tbl_booking_payment_entry.is_deleted','0');
                    $this->db->where('tbl_booking_payment_entry.gift_card_status','0');
                    $this->db->where('tbl_booking_payment_entry.type','3');
                    $result = $this->db->get('tbl_booking_payment_entry')->row();

                    if(!empty($result)){
                        $considered_amount = $result->gift_card_balance != "" ? $result->gift_card_balance : '0';
                        $min_amount = $result->giftcard_min_amount != "" ? $result->giftcard_min_amount : '0';
                        $giftcard_redemption_id = $result->id;                        
                        $giftcard_id = $result->giftcard_id;
                        $giftcard_owner_id = $result->customer_id;

                        $data = array(
                            'giftcard_id'                   =>  $giftcard_id,
                            'giftcard_min_amount'           =>  $min_amount,
                            'giftcard_discount_amount'      =>  $considered_amount,
                            'giftcard_redemption_id'        =>  $giftcard_redemption_id,
                            'giftcard_owner_id'             =>  $giftcard_owner_id,
                        );

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Invalid Giftcard No';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function apply_rewards(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    if($single->rewards_balance > 0){ 
                        $gender = $single->gender;            
                        $this->db->select('tbl_reward_point.*');		
                        $this->db->where('tbl_reward_point.gender',$gender);
                        $this->db->where('tbl_reward_point.is_deleted','0');
                        $this->db->where('tbl_reward_point.status','1');
                        $this->db->where('tbl_reward_point.branch_id',$branch_id);
                        $this->db->where('tbl_reward_point.salon_id',$salon_id);
                        $result = $this->db->get('tbl_reward_point');
                        $rewards_result = $result->row();

                        if(!empty($rewards_result)){
                            $payable_amount = $request['payable_amount'];
                            $rs_per_reward = $rewards_result->rs_per_reward;
                            $reward_point = $rewards_result->reward_point;
                            $minimum_reward_required = (int)$rewards_result->minimum_reward_required;
                            $maximum_reward_required = $rewards_result->maximum_reward_required;
                            $customer_reward_available = $single->rewards_balance;
                            if($customer_reward_available >= $minimum_reward_required){
                                if($customer_reward_available > $maximum_reward_required){
                                    $available_rewards = $maximum_reward_required;
                                }else{
                                    $available_rewards = $customer_reward_available;
                                }

                                $consider_rewards = $available_rewards / $reward_point;
                                $total_value = $consider_rewards * $rs_per_reward;

                                $data = array(
                                    'used_rewards'          =>  $available_rewards,
                                    'used_rewards_msg'      =>  $available_rewards .' Rewards used',
                                    'new_reward_balance'    =>  $customer_reward_available - $available_rewards,
                                    'discount_amount'       =>  $total_value
                                );
                                $json_arr['status'] = 'true';
                                $json_arr['message'] = 'success';
                                $json_arr['data'] = $data;
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Minimum reward points required are: '. $minimum_reward_required;
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Reward point redemption rules not found';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Customer Reward point balance is not sufficient';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function apply_offer(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){  
                    $services = $request['selected_services'];   
                    if(!empty($services)){        
                        $this->db->where('is_deleted','0');
                        $this->db->where('status','1');
                        $this->db->where('validity_status','1');
                        $this->db->where('id',$request['applied_offer_id']);
                        $this->db->where('gender',$single->gender);
                        $this->db->where('branch_id', $branch_id);
                        $this->db->where('salon_id', $salon_id);
                        $offer_data = $this->db->get('tbl_offers')->row();
                        if(!empty($offer_data)){   
                            $services_data = [];
                            $input_service_ids = [];
                            $total_offer_discount = 0;
                            $is_final_offer_applied = '0';

                            $service_offer_discount = $offer_data->discount;
                            $service_offer_discount_type = $offer_data->discount_in;
                            if($service_offer_discount_type == '0'){
                                $discount_text = $service_offer_discount . '% Off';
                            }elseif($service_offer_discount_type == '1'){
                                $discount_text = 'Flat Rs.' . $service_offer_discount . ' Off';
                            }

                            $offer_services = $offer_data->service_name != "" ? explode(',',$offer_data->service_name) : [];
                            foreach ($services as $srv) {
                                $service_id = $srv['service_id'];
                                if (!empty($service_id)) {
                                    $input_service_ids[] = $service_id;
                                }
                            }

                            $diff = array_diff($offer_services, $input_service_ids);
                            if (empty($diff)) {
                                $is_final_offer_applied = '1';
                            }
                            
                            for($i=0;$i<count($services);$i++){
                                $service_id = $services[$i]['service_id'];
                                $is_offer_applied = '0';
                                $service_offer_discount_amount = 0;
                                if($service_id != ""){
                                    if ($is_final_offer_applied == '1' && in_array($service_id, $offer_services)) {
                                        if($service_offer_discount_type == '0'){
                                            $service_offer_discount_amount = ($services[$i]['price'] * $service_offer_discount) / 100;
                                        }elseif($service_offer_discount_type == '1'){
                                            $service_offer_discount_amount = $service_offer_discount;
                                        }
                                        $is_offer_applied = '1';
                                    }
                                    $services_data[] = array(
                                        'service_id'        =>  $service_id,
                                        'is_offer_applied'  =>  $is_final_offer_applied == '1' ? $is_offer_applied : '0',
                                        'price'             =>  $services[$i]['price'],
                                        'discount'          =>  $is_final_offer_applied == '1' ? $service_offer_discount_amount : 0,
                                        'final_price'       =>  $services[$i]['price'] - ($is_final_offer_applied == '1' ? $service_offer_discount_amount : 0),
                                        'discount_text'     =>  $is_final_offer_applied == '1' ? $discount_text : ''
                                    );
                                }
                                $total_offer_discount += ($is_final_offer_applied == '1' ? $service_offer_discount_amount : 0);
                            }                            

                            $not_applied_text = '';
                            if ($is_final_offer_applied == '1') {
                                $offer_text = $offer_data->offers_name . ' offer applied.';
                            } else {
                                $offer_text = $offer_data->offers_name . ' offer not eligible.';

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

                                    $not_applied_text = 'Add ' . $missing_count . ' more ' . ($missing_count > 1 ? 'services' : 'service') .
                                                        ' to unlock ' . $offer_data->offers_name . ': ' .
                                                        implode(', ', $missing_service_names) . '.';
                                }
                            }

                            $data = array(
                                'offer_id'              =>  $offer_data->id,
                                'is_offer_applied'      =>  $is_final_offer_applied,
                                'total_offer_discount'  =>  $is_final_offer_applied == '1' ? $total_offer_discount : 0,
                                'discount_text'         =>  $is_final_offer_applied == '1' ? $discount_text : '',
                                'offer_text'            =>  $offer_text,
                                'not_applied_text'      =>  $not_applied_text,
                                'services_data'         =>  $services_data
                            );
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Offer not found';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Services not selected';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    public function get_customer_packages(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $this->db->select('tbl_customer_package_allocations.*,tbl_package.package_image, tbl_package.description as package_desc, tbl_package.service_name as package_service_name,tbl_package.product_name as package_product_name,tbl_package.package_name,tbl_package.package_name_marathi,tbl_package.discount_in,tbl_package.actual_price,tbl_package.discount');
                    $this->db->join('tbl_package','tbl_package.id = tbl_customer_package_allocations.package_id');
                    $this->db->where('tbl_customer_package_allocations.is_lapsed', '0');
                    $this->db->where('tbl_customer_package_allocations.is_deleted', '0');
                    // $this->db->where('tbl_customer_package_allocations.is_booking_done', '1');
                    $this->db->where('tbl_customer_package_allocations.branch_id', $branch_id);
                    $this->db->where('tbl_customer_package_allocations.salon_id', $salon_id);
                    $this->db->where('tbl_customer_package_allocations.customer_name',$customer_id);
                    $this->db->where('DATE(tbl_customer_package_allocations.package_start_date) <=', date('Y-m-d'));
                    $this->db->where('DATE(tbl_customer_package_allocations.package_end_date) >=', date('Y-m-d'));
                    $this->db->order_by('tbl_customer_package_allocations.id', 'DESC');                
                    $result = $this->db->get('tbl_customer_package_allocations');
                    $packages = $result->result();
                    
                    if(!empty($packages)){ 
                        $data = array();
                        foreach($packages as $active_package_allocation){ 
                            $this->db->select('tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category as sub_category_name,tbl_admin_sub_category.sub_category_marathi,tbl_salon_emp_service.*');      
                            $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                            $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                            $this->db->where_in('tbl_salon_emp_service.id',explode(',',$active_package_allocation->package_service_name));
                            $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                            $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                            $services = $this->db->get('tbl_salon_emp_service')->result();

                            if($active_package_allocation->is_booking_done == '1'){ 
                                $package_price_to_consider = 0;
                            }else{
                                $package_price_to_consider = $active_package_allocation->package_amount;
                            }

                            $services_array = array();
                            if(!empty($services)){
                                foreach($services as $services_result){
                                    $service_availability_status = $this->Salon_model->check_customer_package_items_used_status($active_package_allocation->id,$customer_id,$active_package_allocation->package_id,$services_result->id,'0');
                                    $is_available = explode('@@',$service_availability_status)[0];
                                    $old_id = explode('@@',$service_availability_status)[1];

                                    $package_products = $this->Salon_model->get_package_products_all($active_package_allocation->package_id,$services_result->id,$salon_id,$branch_id);   
                                    
                                    $products_array= array();
                                    if($package_products && !empty($package_products)){
                                        foreach($package_products as $products_result){ 
                                            $products_array[] = array(
                                                'product_id'        =>  $products_result->id,
                                                'product_name'      =>  $products_result->product_name,
                                                'product_added_from'=>  '1',
                                                'price'             =>  '0.00',
                                                'image'         =>  $products_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$products_result->product_photo)[0]) : '',
                                            );
                                        }
                                    }
                                    $services_array[] = array(
                                        'is_special'            =>  $services_result->is_special,
                                        'service_id'            =>  $services_result->id,
                                        'package_id'            =>  $active_package_allocation->package_id,
                                        'package_allocation_id' =>  $active_package_allocation->id,
                                        'is_old_package'        =>  '1',
                                        'is_service_available'  =>  $is_available,
                                        'package_details_id'    =>  $old_id,
                                        'category_name'         =>  $services_result->sup_category,
                                        'category_name_marathi'  =>  $services_result->service_name_marathi,
                                        'sub_category_name'          =>  $services_result->sub_category_name,
                                        'sub_category_name_marathi'  =>  $services_result->sub_category_marathi,
                                        'service_name'          =>  $services_result->service_name,
                                        'service_name_marathi'  =>  $services_result->service_name_marathi,
                                        'service_rewards'       =>  $services_result->reward_point,
                                        'duration'              =>  $services_result->service_duration,
                                        'service_added_from'    =>  '1',
                                        'price'                 =>  '0.00',
                                        'image'                 =>  $services_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $services_result->category_image) : '',
                                        'products'              =>  $products_array
                                    );
                                }

                                $data[] = array(
                                    'package_id'                =>  $active_package_allocation->package_id,
                                    'package_allocation_id'     =>  $active_package_allocation->id,
                                    'package_name'              =>  $active_package_allocation->package_name,
                                    'package_name_marathi'      =>  $active_package_allocation->package_name_marathi,
                                    'package_start'             =>  date('d M, Y',strtotime($active_package_allocation->package_start_date)),
                                    'package_end'               =>  date('d M, Y',strtotime($active_package_allocation->package_end_date)),
                                    'price'                     =>  $package_price_to_consider,
                                    'is_old_package'            =>  '1',
                                    'services'                  =>  $services_array,
                                    'description'               =>  $active_package_allocation->package_desc,
                                    'image'                     =>  $active_package_allocation->package_image != "" ? base_url('admin_assets/images/package_image/' . $active_package_allocation->package_image) : '',
                                    'receipt'                   =>  $active_package_allocation->is_booking_done == '1' ? base_url('package-print/' . base64_encode($active_package_allocation->id) . '?print&mobile') : ''
                                );
                            }
                        }                          
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Packages not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_customer_notifications(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $this->db->where('id', $single->id);
                    $this->db->update('tbl_salon_customer',array('last_notifications_seen'=>date('Y-m-d H:i:s')));

                    $this->db->where('tbl_customer_notifications.is_deleted', '0');
                    $this->db->where('tbl_customer_notifications.branch_id', $branch_id);
                    $this->db->where('tbl_customer_notifications.salon_id', $salon_id);
                    $this->db->where('tbl_customer_notifications.send_customer',$customer_id);
                    $this->db->order_by('tbl_customer_notifications.id', 'DESC');                
                    $result = $this->db->get('tbl_customer_notifications');
                    $notifications = $result->result();
                    
                    if(!empty($notifications)){ 
                        $data = array();
                        foreach($notifications as $notifications_allocation){  
                            $data[] = array(
                                'title'              =>  $notifications_allocation->title,
                                'content'            =>  urldecode(str_replace('%0a', '<br>', $notifications_allocation->content)),
                                'date_time'          =>  date('d M, Y h:i A',strtotime($notifications_allocation->created_on)),
                                'redirection_data'   =>  json_decode($notifications_allocation->notification_data)
                            );
                        }                          
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Notifications not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_customer_giftcards(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   
                $giftcard_allocation_id = isset($request['giftcard_allocation_id']) ? $request['giftcard_allocation_id'] : '';   
                $giftcard_id = isset($request['giftcard_id']) ? $request['giftcard_id'] : '';   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $this->db->select('tbl_booking_payment_entry.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
                    $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
                    $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_payment_entry.customer_id');
                    $this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
                    $this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
                    if($giftcard_allocation_id != ""){
                        $this->db->where('tbl_booking_payment_entry.id',$giftcard_allocation_id);
                    }
                    if($giftcard_id != ""){
                        $this->db->where('tbl_booking_payment_entry.giftcard_id',$giftcard_id);
                    }
                    $this->db->where('tbl_booking_payment_entry.customer_id',$customer_id);
                    $this->db->where('tbl_booking_payment_entry.is_deleted','0');
                    $this->db->where('tbl_booking_payment_entry.type','3');
                    $this->db->order_by('tbl_booking_payment_entry.updated_on','desc');
                    $result = $this->db->get('tbl_booking_payment_entry');
                    $giftcards = $result->result();
                    
                    if(!empty($giftcards)){ 
                        $data = array();
                        foreach($giftcards as $active_giftcards){    
                            $redemption_history = [];
                            if($active_giftcards->gift_card_status == '0'){
                                $status = 'Active';
                            }elseif($active_giftcards->gift_card_status == '1'){
                                $status = 'Used';
                            }else{
                                $status = '';
                            }

                            $redemptions = $active_giftcards->redemption_history != "" ? json_decode($active_giftcards->redemption_history, true) : [];
                            if(!empty($redemptions)){
                                for ($k = 0; $k < count($redemptions); $k++) {
                                    if(isset($redemptions[$k]['booking_id']) && $redemptions[$k]['booking_id'] != ""){
                                        $booking_details = $this->Salon_model->get_booking_details_single($redemptions[$k]['booking_id']);
                                        if(!empty($booking_details)){
                                            $redemptions_by = '-';
                                            if(isset($redemptions[$k]['used_customer_id']) && $redemptions[$k]['used_customer_id'] == $customer_id){
                                                $redemptions_by = 'Self';
                                            }else{
                                                if(isset($redemptions[$k]['used_customer_id']) && $redemptions[$k]['used_customer_id'] != ""){
                                                    $redemptions_by = $this->Salon_model->get_customer_details_all($redemptions[$k]['used_customer_id']);
                                                    $redemptions_by = !empty($redemptions_by) ? $redemptions_by->full_name . ' [' . $redemptions_by->full_name . ']' : '-';
                                                }
                                            }
                                            $redemption_history[] = array(
                                                'booking_id'        =>  $booking_details->receipt_no,
                                                'redeemed_by'       =>  $redemptions_by,
                                                'redeemed_amount'   =>  isset($redemptions[$k]['redeemed_amount']) && $redemptions[$k]['redeemed_amount'] != "" ? $redemptions[$k]['redeemed_amount'] : '',
                                                'redeemed_on'       =>  isset($redemptions[$k]['redeemed_on']) && $redemptions[$k]['redeemed_on'] != "" ? date('d-m-Y h:i A', strtotime($redemptions[$k]['redeemed_on'])) : '',
                                                'booking_receipt'   =>  base_url().'booking-print/'.base64_encode($booking_details->id).'/'.base64_encode($booking_details->booking_payment_id).'?print&mobile'
                                            );
                                        }
                                    }
                                }
                            }
                            $data[] = array(
                                'giftcard_id'               =>  $active_giftcards->giftcard_id,
                                'giftcard_allocation_id'    =>  $active_giftcards->id,
                                'giftcard_name'             =>  $active_giftcards->gift_name,
                                'customer_name'             =>  $single->full_name,
                                'giftcard_gender'           =>  $active_giftcards->gender,
                                'giftcard_code'             =>  $active_giftcards->giftcard_customer_uid,
                                'status_text'               =>  $status,
                                'status_flag'               =>  $active_giftcards->gift_card_status,
                                'offered_price'             =>  $active_giftcards->gift_card_price,
                                'giftcard_balance'          =>  $active_giftcards->gift_card_balance,
                                'giftcard_min_booking_amount'   =>  $active_giftcards->giftcard_min_amount,
                                'purchase_price'            =>  $active_giftcards->gift_card_price,
                                'receipt'                   =>  base_url('giftcard-print/' . base64_encode($active_giftcards->id) . '?print&mobile'),
                                'redemptions'               =>  $redemption_history,
                                'text_color'                =>  $active_giftcards->text_color,
                                'background_color'          =>  $active_giftcards->bg_color
                            );
                        }                          
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Giftcard not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_customer_membership(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    if($single->membership_id != "" && $single->membership_id != null && $single->membership_id != "0"){
                        $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                        $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                        $this->db->where('tbl_customer_membership_history.id',$single->membership_pkey);
                        $this->db->where('tbl_customer_membership_history.customer_id', $single->id);
                        $this->db->where('DATE(tbl_customer_membership_history.membership_start) <=', date('Y-m-d'));
                        $this->db->where('DATE(tbl_customer_membership_history.membership_end) >=', date('Y-m-d'));
                        $this->db->where('tbl_customer_membership_history.is_deleted','0');
                        $this->db->where('tbl_customer_membership_history.membership_status','0');
                        $this->db->where('tbl_customer_membership_history.payment_status','1');
                        $membership_details = $this->db->get('tbl_customer_membership_history')->row();
        
                        if(!empty($membership_details)){
                            $gst_amount = $membership_details->gst_amount != "" ? (float)$membership_details->gst_amount : 0.00;
                            $data = array(
                                'is_member'         =>  '1',
                                'membership_details'=>  array(
                                                            'membership_allocation_id'     =>  $membership_details->id,
                                                            'membership_id'     =>  $membership_details->membership_id,
                                                            'name'              =>  $membership_details->membership_name,
                                                            'discount_type'     =>  $membership_details->discount_in,
                                                            'service_discount'  =>  $membership_details->service_discount,
                                                            'product_discount'  =>  $membership_details->product_discount,
                                                            'price'             =>  (float)$membership_details->membership_price + (float)$gst_amount,
                                                            'payment_status'    =>  $membership_details->payment_status,
                                                            'background_color'  =>  $membership_details->bg_color,
                                                            'text_color'        =>  $membership_details->text_color,
                                                            'membership_start'  =>  date('d M, Y',strtotime($membership_details->membership_start)),
                                                            'membership_end'    =>  date('d M, Y',strtotime($membership_details->membership_end)),
                                                            'receipt'           =>  $membership_details->payment_status == '1' ? base_url('membership-print/' . base64_encode($membership_details->id) . '?print&mobile') : ''
                                                        )
                            );
                        }else{
                            $data = array(
                                'is_member'         =>  '0',
                                'membership_details'=>  []
                            );
                        }

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Membership not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_customer_booking($api_type,$customer_id,$salon_id,$branch_id,$booking_id,$booking_status,$service_status,$limit,$offset){
        $this->db->select('tbl_customer_rewards_history.reward_value,tbl_new_booking.*,tbl_salon_customer.full_name as customer_full_name,tbl_salon_customer.customer_phone');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
        $this->db->join('tbl_customer_rewards_history','tbl_customer_rewards_history.booking_id = tbl_new_booking.id','left');
        $this->db->where('tbl_new_booking.is_deleted', '0');
        if(!empty($booking_id)){
            $this->db->where('tbl_new_booking.id', $booking_id);
        }
        if(!empty($booking_status)){
            $this->db->where_in('tbl_new_booking.booking_status', $booking_status);
        }
        $this->db->where('tbl_new_booking.branch_id', $branch_id);
        $this->db->where('tbl_new_booking.salon_id', $salon_id);
        $this->db->where('tbl_new_booking.customer_name',$customer_id);
        // $this->db->order_by('tbl_new_booking.service_start_date', 'DESC');
        if($api_type == 'pending'){
            $this->db->order_by('tbl_new_booking.id', 'DESC');
        }elseif($api_type == 'cancelled'){
            $this->db->order_by('tbl_new_booking.cancelled_on', 'DESC');
        }elseif($api_type == 'completed'){
            $this->db->order_by('tbl_new_booking.completed_on', 'DESC');
        }else{
            $this->db->order_by('tbl_new_booking.id', 'DESC');
        }
        if (is_numeric($limit) && is_numeric($offset)) {
            $this->db->limit((int)$limit, (int)$offset);
        }          
        $result = $this->db->get('tbl_new_booking');
        $bookings = $result->result();   
        $data = array();                 
        if(!empty($bookings)){ 
            foreach($bookings as $bookings_result){  
                $services_data = array();   
                $services_text = '';   
                $stylists_text = '';   
                $reward_value = 0;
                $stylists_text_with_service = '';   
                $booking_service_details = $this->Salon_model->get_booking_all_service_details($bookings_result->id,$branch_id,$salon_id);  
                if(!empty($booking_service_details)){ 
                    foreach($booking_service_details as $booking_service_details_result){ 
                        if($api_type != 'cancelled'){
                            if(in_array($booking_service_details_result->service_status,['0','1','3'])){
                                $services_text .= rtrim($booking_service_details_result->sub_category_name.'-'.$booking_service_details_result->service_name,' ').', ';
                            }
                        }else{
                            $services_text .= rtrim($booking_service_details_result->sub_category_name.'-'.$booking_service_details_result->service_name,' ').', ';
                        }
                        $stylists_text .= rtrim($booking_service_details_result->full_name,' ').', ';
                        $reward_value += $booking_service_details_result->rewards_received_discount != "" && $booking_service_details_result->rewards_received_discount != null ? (int)$booking_service_details_result->rewards_received_discount : 0;
                        $stylists_text_with_service .= rtrim($booking_service_details_result->full_name,' ').' ('.rtrim($booking_service_details_result->service_name,' ').'), ';
                        $services_products_data = array();
                        $booking_service_products_details = $this->Salon_model->get_booking_all_service_product_details($booking_service_details_result->service_id,$booking_service_details_result->id,$bookings_result->id,$branch_id,$salon_id);  
                        if(!empty($booking_service_products_details)){ 
                            foreach($booking_service_products_details as $booking_service_products_details_result){ 
                                $services_products_data[] = array(
                                    'product_id'            =>  $booking_service_products_details_result->product_id,
                                    'product_details_id'    =>  $booking_service_products_details_result->id,
                                    'product_name'          =>  $booking_service_products_details_result->product_name,
                                    'price'                 =>  $booking_service_products_details_result->product_price != "" && $booking_service_products_details_result->product_price != null ? $booking_service_products_details_result->product_price : 0.00,
                                    'discount'              =>  $booking_service_products_details_result->received_discount_amount_while_booking,
                                    'final_price'           =>  $booking_service_products_details_result->product_discounted_price_while_booking,
                                    'product_added_from'    =>  $booking_service_products_details_result->product_added_from,
                                    'image'                 =>  $booking_service_products_details_result->product_photo != "" ? base_url('admin_assets/images/product_image/' . explode(',',$booking_service_products_details_result->product_photo)[0]) : '',
                                );
                            }
                        }
                        if($booking_service_details_result->service_status == '0'){
                            $service_status_text = 'Pending';
                        }elseif($booking_service_details_result->service_status == '1'){
                            $service_status_text = 'Completed';
                        }elseif($booking_service_details_result->service_status == '2'){
                            $service_status_text = 'Cancelled';
                        }else{
                            $service_status_text = '';
                        }
                        $services_data[] = array(
                            'service_id'            =>  $booking_service_details_result->service_id,
                            'service_details_id'    =>  $booking_service_details_result->id,
                            'category_name'          =>  $booking_service_details_result->sup_category,
                            'category_name_marathi' =>  $booking_service_details_result->sup_category_marathi,
                            'sub_category_name'         =>  $booking_service_details_result->sub_category_name,
                            'sub_category_name_marathi' =>  $booking_service_details_result->sub_category_marathi,
                            'service_name'          =>  $booking_service_details_result->service_name,
                            'service_name_marathi'  =>  $booking_service_details_result->service_name_marathi,
                            'stylist'               =>  $booking_service_details_result->full_name,
                            'duration'              =>  $booking_service_details_result->service_duration,
                            'service_from'          =>  $booking_service_details_result->service_from != "" ? date('h:i A',strtotime($booking_service_details_result->service_from)) : null,
                            'service_to'            =>  $booking_service_details_result->service_to != "" ? date('h:i A',strtotime($booking_service_details_result->service_to)) : null,
                            'image'                 =>  $booking_service_details_result->category_image != "" ? base_url('admin_assets/images/service_image/' . $booking_service_details_result->category_image) : '',
                            'price'                 =>  $booking_service_details_result->service_price != "" && $booking_service_details_result->service_price != null ? $booking_service_details_result->service_price : 0.00,
                            'discount'              =>  $booking_service_details_result->received_discount_amount_while_booking,
                            'final_price'           =>  $booking_service_details_result->service_discounted_price_while_booking,
                            'service_added_from'    =>  $booking_service_details_result->service_added_from,
                            'service_status_text'   =>  $service_status_text,
                            'service_status_flag'   =>  $booking_service_details_result->service_status,
                            'service_description'   =>  $booking_service_details_result->service_description, 
                            'products'              =>  $services_products_data
                        );
                    }
                }

                if($bookings_result->booking_status == '1' || $bookings_result->booking_status == '3' || $bookings_result->booking_status == '4'){
                    $booking_status_text = 'Confirmed';
                }elseif($bookings_result->booking_status == '5'){
                    $booking_status_text = 'Completed';
                }elseif($bookings_result->booking_status == '2'){
                    $booking_status_text = 'Cancelled';
                }else{
                    $booking_status_text = '';
                }

                if($bookings_result->payment_status == '1'){
                    $payment_status_text = 'Completed';
                }else{
                    $payment_status_text = 'Pending';
                }

                if($bookings_result->reminder == '3'){
                    $is_reminder_set = '1';
                }else{
                    $is_reminder_set = '0';
                }
                
                $booking_rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);
                if(!empty($booking_rules)){
                    $booking_rescheduling = $booking_rules->booking_rescheduling != "" ? (int)$booking_rules->booking_rescheduling : 0;
                    $cancellation = $booking_rules->cancellation != "" ? (int)$booking_rules->cancellation : 0;
                }else{
                    $cancellation = 0;
                    $booking_rescheduling = 0;
                }
                
                $service_from = new DateTime($bookings_result->service_start_date . ' ' . $bookings_result->service_start_time);
                $service_from->modify("-$booking_rescheduling minutes"); // Adjust for rescheduling
                $allowed_rescheduling_time = clone $service_from;
                
                $service_from_cancel = new DateTime($bookings_result->service_start_date . ' ' . $bookings_result->service_start_time);
                $service_from_cancel->modify("-$cancellation minutes"); // Adjust for cancellation
                $allowed_cancel_time = clone $service_from_cancel;
                
                $is_reschedule_allowed = '0';
                $is_cancellation_allowed = '0';
                
                if ($bookings_result->payment_status == '0' && ($bookings_result->booking_status === '1' || $bookings_result->booking_status === '3' || $bookings_result->booking_status === '4')) {
                    $currentDateTime = new DateTime(); // Current date and time
                
                    if ($allowed_rescheduling_time > $currentDateTime) {
                        $is_reschedule_allowed = '1'; // Rescheduling is allowed
                    }
                
                    if ($allowed_cancel_time > $currentDateTime) {
                        $is_cancellation_allowed = '1'; // Cancellation is allowed
                    }
                }
                
                // // Debugging: Print times for comparison
                // echo "Current DateTime: " . $currentDateTime->format('Y-m-d H:i:s') . "\n";
                // echo "Allowed Rescheduling Time: " . $allowed_rescheduling_time->format('Y-m-d H:i:s') . "\n";
                // echo "Allowed Cancellation Time: " . $allowed_cancel_time->format('Y-m-d H:i:s') . "\n";
                // echo "Is Reschedule Allowed? $is_reschedule_allowed\n";
                // echo "Is Cancellation Allowed? $is_cancellation_allowed\n";

                // exit;
                $this->db->where('is_deleted', '0');
                $this->db->where('booking_id', $bookings_result->id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $this->db->where('customer_id',$customer_id);
                $result = $this->db->get('tbl_store_reviews');
                $booking_review = $result->row();
                
                $applied_giftcard_details = array(
                    'giftcard_id'               =>  '',
                    'giftcard_allocation_id'    =>  '',
                    'giftcard_name'             =>  '',
                    'giftcard_code'             =>  '',
                    'text_color'                =>  '',
                    'background_color'          =>  '',
                    'discount_amount'           =>  ''
                );
                $applied_offer_details = array(
                    'offer_id'          =>  '',
                    'offer_text'        =>  '',
                    'offer_name'        =>  '',
                    'services_text'     =>  '',
                    'discount_type'     =>  '',
                    'discount'          =>  '',
                    'services'          =>  '',
                    'discount_amount'   =>  ''
                );
                $applied_coupon_details = array(
                    'coupon_id'         =>  '',
                    'coupon_name'       =>  '',
                    'coupon_code'       =>  '',
                    'discount_amount'   =>  ''
                );
                $applied_membership_details = array(
                    'membership_id'     =>  '',
                    'name'              =>  '',
                    'discount_type'     =>  '',
                    'service_discount'  =>  '',
                    'product_discount'  =>  '',
                    'background_color'  =>  '',
                    'text_color'        =>  '',
                    'service_discount_amount'   =>  '',
                    'product_discount_amount'   =>  ''
                );
                $applied_package_details = array(
                    'package_id'                =>  '',
                    'package_allocation_id'     =>  '',
                    'package_name'              =>  '',
                    'package_name_marathi'      =>  '',
                    'package_start'             =>  '',
                    'package_end'               =>  '',
                    'description'               =>  '',
                    'image'                     =>  ''
                );                      
                $applied_reward_details = array(
                    'reward_used'               =>  '',
                    'discount_amount'           =>  ''
                );

                $single_payment_details = $this->Salon_model->get_single_booking_payment_details($bookings_result->id,$bookings_result->booking_payment_id);
                if(!empty($single_payment_details)){
                    $offer_discount = is_numeric($single_payment_details->offer_discount_amount) ? floatval($single_payment_details->offer_discount_amount) : 0;
                    $coupon_discount = is_numeric($single_payment_details->coupon_discount_amount) ? floatval($single_payment_details->coupon_discount_amount) : 0;
                    $reward_discount = is_numeric($single_payment_details->reward_discount_amount) ? floatval($single_payment_details->reward_discount_amount) : 0;
                    $gift_discount = is_numeric($single_payment_details->gift_discount) ? floatval($single_payment_details->gift_discount) : 0;
                    $m_service_discount = is_numeric($single_payment_details->m_service_discount_amount) ? floatval($single_payment_details->m_service_discount_amount) : 0;
                    $m_product_discount = is_numeric($single_payment_details->m_product_discount_amount) ? floatval($single_payment_details->m_product_discount_amount) : 0;
                    
                    $applied_giftcard_redemption = $single_payment_details->giftcard_redemption_id;
                    $this->db->select('tbl_booking_payment_entry.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
                    $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
                    $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_payment_entry.customer_id');
                    $this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
                    $this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
                    $this->db->where('tbl_booking_payment_entry.id',$applied_giftcard_redemption);
                    $this->db->where('tbl_booking_payment_entry.is_deleted','0');
                    $this->db->where('tbl_booking_payment_entry.type','3');
                    $this->db->order_by('tbl_booking_payment_entry.updated_on','desc');
                    $result = $this->db->get('tbl_booking_payment_entry');
                    $applied_giftcards = $result->row();
                    
                    if(!empty($applied_giftcards)){ 
                        $applied_giftcard_details = array(
                            'giftcard_id'               =>  $applied_giftcards->giftcard_id,
                            'giftcard_allocation_id'    =>  $applied_giftcards->id,
                            'giftcard_name'             =>  $applied_giftcards->gift_name,
                            'giftcard_code'             =>  $applied_giftcards->giftcard_customer_uid,
                            'text_color'                =>  $applied_giftcards->text_color,
                            'background_color'          =>  $applied_giftcards->bg_color,
                            'discount_amount'           =>  $gift_discount
                        );
                    }

                    $applied_offer = $single_payment_details->applied_offer_id;
                    $this->db->where('tbl_offers.id', $applied_offer);
                    $this->db->where('tbl_offers.is_deleted', '0');
                    $this->db->where('tbl_offers.branch_id', $branch_id);
                    $this->db->where('tbl_offers.salon_id', $salon_id);
                    $this->db->order_by('tbl_offers.id', 'DESC');                
                    $result = $this->db->get('tbl_offers');
                    $applied_offers = $result->row();

                    if(!empty($applied_offers)){ 
                        $applied_offer_services = explode(',',$applied_offers->service_name);
                        $offer_services_text = '';
                        $services_array = [];
                        if(count($applied_offer_services) > 0){
                            for($i=0;$i<count($applied_offer_services);$i++){
                                $this->db->where('id',$applied_offer_services[$i]);
                                $this->db->where('branch_id',$branch_id);
                                $this->db->where('salon_id',$salon_id);
                                $this->db->where('is_deleted','0');
                                $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                if (!empty($service_details)) {
                                    // $offer_services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                    $offer_services_text .= $service_details->service_name;
                                    
                                    $services_array[] = array(
                                        'service_id'        =>  $service_details->id,
                                        'service_name'      =>  $service_details->service_name,
                                        'service_name_marathi'    =>  $service_details->service_name_marathi,
                                    );
                                    
                                    if ($i < count($applied_offer_services) - 1) {
                                        $offer_services_text .= ', ';
                                    }
                                }
                            }
                        }

                        if($applied_offers->discount_in == '0'){
                            $offer_text = $applied_offers->discount.'%';
                        }elseif($applied_offers->discount_in == '1'){
                            $offer_text = 'Flat Rs.'.$applied_offers->discount;
                        }else{
                            $offer_text = '';
                        }
                        $applied_offer_details = array(
                            'offer_id'          =>  $applied_offers->id,
                            'offer_text'        =>  $offer_text.' Off on '.$offer_services_text,
                            'offer_name'        =>  $applied_offers->offers_name,
                            'services_text'     =>  trim($offer_services_text,','),
                            'discount_type'     =>  $applied_offers->discount_in,
                            'discount'          =>  $applied_offers->discount,
                            'services'          =>  $services_array,
                            'discount_amount'   =>  $offer_discount
                        );
                    }

                    $applied_coupon = $single_payment_details->selected_coupon_id;
                    $this->db->where('tbl_coupon_code.id', $applied_coupon);
                    $this->db->where('tbl_coupon_code.status', '1');
                    $this->db->where('tbl_coupon_code.is_deleted', '0');
                    $this->db->where('tbl_coupon_code.branch_id', $branch_id);
                    $this->db->where('tbl_coupon_code.salon_id', $salon_id);
                    $this->db->order_by('tbl_coupon_code.id', 'DESC');                
                    $result = $this->db->get('tbl_coupon_code');
                    $applied_coupons = $result->row();
                    
                    if(!empty($applied_coupons)){ 
                        $applied_coupon_details = array(
                            'coupon_id'         =>  $applied_coupons->id,
                            'coupon_name'       =>  $applied_coupons->coupon_name,
                            'coupon_code'       =>  $applied_coupons->coupan_code,
                            'discount_amount'   =>  $coupon_discount
                        );
                    }

                    $applied_membership = $single_payment_details->membership_history_id;
                    $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
                    $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
                    $this->db->where('tbl_customer_membership_history.id',$applied_membership);
                    $this->db->where('tbl_customer_membership_history.is_deleted','0');
                    $applied_membership = $this->db->get('tbl_customer_membership_history')->row();
                    
                    if(!empty($applied_membership)){
                        $applied_membership_details = array(
                            'membership_id'     =>  $applied_membership->membership_id,
                            'name'              =>  $applied_membership->membership_name,
                            'discount_type'     =>  $applied_membership->discount_in,
                            'service_discount'  =>  $applied_membership->service_discount,
                            'product_discount'  =>  $applied_membership->product_discount,
                            'background_color'  =>  $applied_membership->bg_color,
                            'text_color'        =>  $applied_membership->text_color,
                            'service_discount_amount'   =>  $m_service_discount,
                            'product_discount_amount'   =>  $m_product_discount
                        );
                    }

                    $applied_package = $single_payment_details->package_allocation_id;
                    $this->db->select('tbl_customer_package_allocations.*,tbl_package.package_image, tbl_package.description as package_desc, tbl_package.service_name as package_service_name,tbl_package.product_name as package_product_name,tbl_package.package_name,tbl_package.package_name_marathi,tbl_package.discount_in,tbl_package.actual_price,tbl_package.discount');
                    $this->db->join('tbl_package','tbl_package.id = tbl_customer_package_allocations.package_id');
                    $this->db->where('tbl_customer_package_allocations.is_deleted', '0');
                    $this->db->where('tbl_customer_package_allocations.branch_id', $branch_id);
                    $this->db->where('tbl_customer_package_allocations.salon_id', $salon_id);
                    $this->db->where('tbl_customer_package_allocations.id',$applied_package);
                    $this->db->order_by('tbl_customer_package_allocations.id', 'DESC');                
                    $result = $this->db->get('tbl_customer_package_allocations');
                    $applied_packages = $result->row();
                    
                    if(!empty($applied_packages)){ 
                        $applied_package_details = array(
                            'package_id'                =>  $applied_packages->package_id,
                            'package_allocation_id'     =>  $applied_packages->id,
                            'package_name'              =>  $applied_packages->package_name,
                            'package_name_marathi'      =>  $applied_packages->package_name_marathi,
                            'package_start'             =>  date('d M, Y',strtotime($applied_packages->package_start_date)),
                            'package_end'               =>  date('d M, Y',strtotime($applied_packages->package_end_date)),
                            'description'               =>  $applied_packages->package_desc,
                            'image'                     =>  $applied_packages->package_image != "" ? base_url('admin_assets/images/package_image/' . $applied_packages->package_image) : '',
                        );  
                    } 
                    
                    $applied_reward_details = array(
                        'reward_used'               =>  $single_payment_details->used_rewards,
                        'discount_amount'           =>  $reward_discount
                    );

                    $amount_to_paid = is_numeric($single_payment_details->amount_to_paid) ? floatval($single_payment_details->amount_to_paid) : 0;
                    $salon_gst_rate = is_numeric($single_payment_details->salon_gst_rate) ? floatval($single_payment_details->salon_gst_rate) : 0;
                    $gst_amount = is_numeric($single_payment_details->gst_amount) ? floatval($single_payment_details->gst_amount) : 0;
                    $booking_amount = is_numeric($single_payment_details->booking_amount) ? floatval($single_payment_details->booking_amount) : 0;
                    

                    $total_product_price = is_numeric($single_payment_details->total_product_price) ? floatval($single_payment_details->total_product_price) : 0;
                    $total_service_price = is_numeric($single_payment_details->total_service_price) ? floatval($single_payment_details->total_service_price) : 0;
                    $package_amount = is_numeric($single_payment_details->package_amount) ? floatval($single_payment_details->package_amount) : 0;
                    $membership_payment_amount = $single_payment_details->is_membership_payment_included == '1' ? floatval($single_payment_details->membership_payment_amount) : 0;
                }else{                   
                    $applied_giftcard_redemption = $bookings_result->giftcard_redemption_id;
                    $this->db->select('tbl_booking_payment_entry.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
                    $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
                    $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_payment_entry.customer_id');
                    $this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
                    $this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
                    $this->db->where('tbl_booking_payment_entry.id',$applied_giftcard_redemption);
                    $this->db->where('tbl_booking_payment_entry.is_deleted','0');
                    $this->db->where('tbl_booking_payment_entry.type','3');
                    $this->db->order_by('tbl_booking_payment_entry.updated_on','desc');
                    $result = $this->db->get('tbl_booking_payment_entry');
                    $applied_giftcards = $result->row();
                    
                    if(!empty($applied_giftcards)){ 
                        $applied_giftcard_details = array(
                            'giftcard_id'               =>  $applied_giftcards->giftcard_id,
                            'giftcard_allocation_id'    =>  $applied_giftcards->id,
                            'giftcard_name'             =>  $applied_giftcards->gift_name,
                            'giftcard_code'             =>  $applied_giftcards->giftcard_customer_uid,
                            'text_color'                =>  $applied_giftcards->text_color,
                            'background_color'          =>  $applied_giftcards->bg_color,
                            'discount_amount'           =>  $bookings_result->gift_discount
                        );
                    }

                    $applied_offer = $bookings_result->applied_offer_id;
                    $this->db->where('tbl_offers.id', $applied_offer);
                    $this->db->where('tbl_offers.is_deleted', '0');
                    $this->db->where('tbl_offers.branch_id', $branch_id);
                    $this->db->where('tbl_offers.salon_id', $salon_id);
                    $this->db->order_by('tbl_offers.id', 'DESC');                
                    $result = $this->db->get('tbl_offers');
                    $applied_offers = $result->row();

                    if(!empty($applied_offers)){ 
                        $applied_offer_services = explode(',',$applied_offers->service_name);
                        $offer_services_text = '';
                        $services_array = [];
                        if(count($applied_offer_services) > 0){
                            for($i=0;$i<count($applied_offer_services);$i++){
                                $this->db->where('id',$applied_offer_services[$i]);
                                $this->db->where('branch_id',$branch_id);
                                $this->db->where('salon_id',$salon_id);
                                $this->db->where('is_deleted','0');
                                $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                if (!empty($service_details)) {
                                    // $offer_services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                    $offer_services_text .= $service_details->service_name;
                                    
                                    $services_array[] = array(
                                        'service_id'        =>  $service_details->id,
                                        'service_name'      =>  $service_details->service_name,
                                        'service_name_marathi'    =>  $service_details->service_name_marathi,
                                    );
                                    
                                    if ($i < count($applied_offer_services) - 1) {
                                        $offer_services_text .= ', ';
                                    }
                                }
                            }
                        }

                        if($applied_offers->discount_in == '0'){
                            $offer_text = $applied_offers->discount.'%';
                        }elseif($applied_offers->discount_in == '1'){
                            $offer_text = 'Flat Rs.'.$applied_offers->discount;
                        }else{
                            $offer_text = '';
                        }
                        $applied_offer_details = array(
                            'offer_id'          =>  $applied_offers->id,
                            'offer_text'        =>  $offer_text.' Off on '.$offer_services_text,
                            'offer_name'        =>  $applied_offers->offers_name,
                            'services_text'     =>  trim($offer_services_text,','),
                            'discount_type'     =>  $applied_offers->discount_in,
                            'discount'          =>  $applied_offers->discount,
                            'services'          =>  $services_array,
                            'discount_amount'   =>  $bookings_result->offer_discount_amount
                        );
                    }

                    $applied_coupon = $bookings_result->selected_coupon_id;
                    $this->db->where('tbl_coupon_code.id', $applied_coupon);
                    $this->db->where('tbl_coupon_code.status', '1');
                    $this->db->where('tbl_coupon_code.is_deleted', '0');
                    $this->db->where('tbl_coupon_code.branch_id', $branch_id);
                    $this->db->where('tbl_coupon_code.salon_id', $salon_id);
                    $this->db->order_by('tbl_coupon_code.id', 'DESC');                
                    $result = $this->db->get('tbl_coupon_code');
                    $applied_coupons = $result->row();
                    
                    if(!empty($applied_coupons)){ 
                        $applied_coupon_details = array(
                            'coupon_id'         =>  $applied_coupons->id,
                            'coupon_name'       =>  $applied_coupons->coupon_name,
                            'coupon_code'       =>  $applied_coupons->coupan_code,
                            'discount_amount'   =>  $bookings_result->coupon_discount_amount
                        );
                    }

                    $applied_membership = $bookings_result->membership_id;
                    $this->db->where('tbl_memebership.id',$applied_membership);
                    $this->db->where('tbl_memebership.is_deleted','0');
                    $applied_membership = $this->db->get('tbl_memebership')->row();
                    
                    if(!empty($applied_membership)){
                        $applied_membership_details = array(
                            'membership_id'     =>  $applied_membership->id,
                            'name'              =>  $applied_membership->membership_name,
                            'discount_type'     =>  $applied_membership->discount_in,
                            'service_discount'  =>  $bookings_result->m_service_discount,
                            'product_discount'  =>  $bookings_result->m_product_discount,
                            'background_color'  =>  $applied_membership->bg_color,
                            'text_color'        =>  $applied_membership->text_color,
                            'service_discount_amount'   =>  $bookings_result->m_service_discount_amount,
                            'product_discount_amount'   =>  $bookings_result->m_product_discount_amount
                        );
                    }

                    $applied_package = $bookings_result->package_allocation_id;
                    $this->db->select('tbl_customer_package_allocations.*,tbl_package.package_image, tbl_package.description as package_desc, tbl_package.service_name as package_service_name,tbl_package.product_name as package_product_name,tbl_package.package_name,tbl_package.package_name_marathi,tbl_package.discount_in,tbl_package.actual_price,tbl_package.discount');
                    $this->db->join('tbl_package','tbl_package.id = tbl_customer_package_allocations.package_id');
                    $this->db->where('tbl_customer_package_allocations.is_deleted', '0');
                    $this->db->where('tbl_customer_package_allocations.branch_id', $branch_id);
                    $this->db->where('tbl_customer_package_allocations.salon_id', $salon_id);
                    $this->db->where('tbl_customer_package_allocations.id',$applied_package);
                    $this->db->order_by('tbl_customer_package_allocations.id', 'DESC');                
                    $result = $this->db->get('tbl_customer_package_allocations');
                    $applied_packages = $result->row();
                    
                    if(!empty($applied_packages)){ 
                        $applied_package_details = array(
                            'package_id'                =>  $applied_packages->package_id,
                            'package_allocation_id'     =>  $applied_packages->id,
                            'package_name'              =>  $applied_packages->package_name,
                            'package_name_marathi'      =>  $applied_packages->package_name_marathi,
                            'package_start'             =>  date('d M, Y',strtotime($applied_packages->package_start_date)),
                            'package_end'               =>  date('d M, Y',strtotime($applied_packages->package_end_date)),
                            'description'               =>  $applied_packages->package_desc,
                            'image'                     =>  $applied_packages->package_image != "" ? base_url('admin_assets/images/package_image/' . $applied_packages->package_image) : '',
                        );  
                    } 
                    
                    $applied_reward_details = array(
                        'reward_used'               =>  $bookings_result->used_rewards,
                        'discount_amount'           =>  $bookings_result->reward_discount_amount
                    );

                    $offer_discount = is_numeric($bookings_result->offer_discount_amount) ? floatval($bookings_result->offer_discount_amount) : 0;
                    $coupon_discount = is_numeric($bookings_result->coupon_discount_amount) ? floatval($bookings_result->coupon_discount_amount) : 0;
                    $reward_discount = is_numeric($bookings_result->reward_discount_amount) ? floatval($bookings_result->reward_discount_amount) : 0;
                    $gift_discount = is_numeric($bookings_result->gift_discount) ? floatval($bookings_result->gift_discount) : 0;
                    $m_service_discount = is_numeric($bookings_result->m_service_discount_amount) ? floatval($bookings_result->m_service_discount_amount) : 0;
                    $m_product_discount = is_numeric($bookings_result->m_product_discount_amount) ? floatval($bookings_result->m_product_discount_amount) : 0;
                    
                    $booking_amount = is_numeric($bookings_result->booking_amount) ? floatval($bookings_result->booking_amount) : 0;
                    $salon_gst_rate = is_numeric($bookings_result->salon_gst_rate) ? floatval($bookings_result->salon_gst_rate) : 0;
                    $gst_amount = is_numeric($bookings_result->gst_amount) ? floatval($bookings_result->gst_amount) : 0;
                    $amount_to_paid = is_numeric($bookings_result->amount_to_paid) ? floatval($bookings_result->amount_to_paid) : 0;

                    $total_product_price = is_numeric($bookings_result->total_product_price) ? floatval($bookings_result->total_product_price) : 0;
                    $total_service_price = is_numeric($bookings_result->total_service_price) ? floatval($bookings_result->total_service_price) : 0;
                    $package_amount = is_numeric($bookings_result->package_amount) ? floatval($bookings_result->package_amount) : 0;
                    $membership_payment_amount = $bookings_result->is_membership_payment_included == '1' ? floatval($bookings_result->membership_amount) : 0;
                }

                $total_discount = $coupon_discount + $offer_discount + $reward_discount + $gift_discount + $m_service_discount + $m_product_discount;

                $discount_details = array(
                    'mem_service_discount'  =>  $m_service_discount,
                    'mem_product_discount'  =>  $m_product_discount,
                    'gift_discount'         =>  $gift_discount,
                    'offer_discount'        =>  $offer_discount,
                    'reward_discount'       =>  $reward_discount,
                    'coupon_discount'       =>  $coupon_discount,
                    'total_discount'        =>  $total_discount
                    // 'total_discount'        =>  0
                );
                
                $this->db->where('booking_id',$bookings_result->id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $this->db->where('is_deleted','0');
                $this->db->order_by('service_to','desc');
                $this->db->limit(1);
                $last_service = $this->db->get('tbl_booking_services_details')->row();
                
                $this->db->where('booking_id',$bookings_result->id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $this->db->where('is_deleted','0');
                $this->db->order_by('service_from','asc');
                $this->db->limit(1);
                $first_service = $this->db->get('tbl_booking_services_details')->row();

                $data[] = array(
                    'booking_id'                    =>  $bookings_result->id,
                    'is_direct_billing'             =>  $bookings_result->is_direct_billing,
                    'ref_id'                        =>  $bookings_result->receipt_no,
                    'customer'                      =>  $bookings_result->customer_full_name,
                    'phone_no'                      =>  $bookings_result->customer_phone,
                    'booking_date'                  =>  date('d M, Y',strtotime($bookings_result->service_start_date)),
                    'from'                          =>  !empty($first_service) && $first_service->service_from != "" ? date('h:i A',strtotime($first_service->service_from)) : null,
                    'to'                            =>  !empty($last_service) && $last_service->service_to != "" ? date('h:i A',strtotime($last_service->service_to)) : null,
                    'services_text'                 =>  rtrim($services_text, ', '),
                    'stylists_text'                 =>  rtrim($stylists_text, ', '),
                    'reward_value'                  => $reward_value == 0 ? '' : (string)$reward_value,
                    'stylists_text_with_service'    =>  rtrim($stylists_text_with_service, ', '),
                    'services'                      =>  $services_data,
                    'booking_status_text'           =>  $booking_status_text,
                    'booking_status_flag'           =>  $bookings_result->booking_status,
                    'payment_status_text'           =>  $payment_status_text,
                    'payment_status_flag'           =>  $bookings_result->payment_status,
                    'is_reschedule_allowed'         =>  $is_reschedule_allowed,
                    'is_cancellation_allowed'       =>  $is_cancellation_allowed,
                    'is_reminder_set'               =>  $is_reminder_set,

                    'all_discount_details'          =>  $discount_details,
                    'applied_offer_details'         =>  $applied_offer_details,
                    'applied_coupon_details'        =>  $applied_coupon_details,
                    'applied_membership_details'    =>  $applied_membership_details,
                    'applied_package_details'       =>  $applied_package_details,
                    'applied_reward_details'        =>  $applied_reward_details,
                    'applied_giftcard_details'      =>  $applied_giftcard_details,

                    'total_product_price'           =>  number_format($total_product_price, 2, '.', ''),
                    'total_service_price'           =>  number_format($total_service_price, 2, '.', ''),
                    'package_amount'                =>  number_format($package_amount, 2, '.', ''),
                    'membership_payment_amount'     =>  number_format($membership_payment_amount, 2, '.', ''),
                    // 'total_discount_amount'          =>  number_format($total_discount, 2, '.', ''),
                    'total_discount_amount'         =>  '0.00',
                    'booking_amount'                =>  number_format($booking_amount, 2, '.', ''),
                    'salon_gst_rate'                =>  number_format($salon_gst_rate, 2, '.', ''),
                    'gst_amount'                    =>  number_format($gst_amount, 2, '.', ''),
                    'amount_to_paid'                =>  number_format($amount_to_paid, 2, '.', ''),
                    
                    'is_review_submitted'           =>  $bookings_result->is_review_submitted,
                    'review_id'                     =>  !empty($booking_review) ? $booking_review->id : '',
                    'review_stars'                  =>  !empty($booking_review) ? $booking_review->stars : '',
                    'review_description'            =>  !empty($booking_review) ? $booking_review->description : '',
                    'receipt'                       =>  $bookings_result->payment_status == '1' ? base_url().'booking-print/'.base64_encode($bookings_result->id).'/'.base64_encode($bookings_result->booking_payment_id).'?print&mobile' : base_url().'mobile-booking-print/'.base64_encode($bookings_result->id).'?print&mobile',
                );
            }   
        }
        return $data;
    }
    public function pending_bookings(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $limit = $request['limit'];   
                    $offset = $request['offset'];   
                    $booking_id = isset($request['booking_id']) ? $request['booking_id'] : '';   
                    $booking_status = ['1','3','4'];   
                    $service_status = [];   
                    $api_type = 'pending';
                    $bookings = $this->get_customer_booking($api_type,$customer_id,$salon_id,$branch_id,$booking_id,$booking_status,$service_status,$limit,$offset);
                    
                    if(!empty($bookings)){ 
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $bookings;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Bookings not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function booking_details(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $limit = '';   
                    $offset = '';   
                    $booking_id = $request['booking_id'];   
                    $booking_status = [];   
                    $service_status = [];    
                    $api_type = '';
                    $bookings = $this->get_customer_booking($api_type,$customer_id,$salon_id,$branch_id,$booking_id,$booking_status,$service_status,$limit,$offset);
                    
                    if(!empty($bookings)){ 
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $bookings;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Bookings not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function cancelled_bookings(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $limit = $request['limit'];   
                    $offset = $request['offset'];   
                    $booking_id = isset($request['booking_id']) ? $request['booking_id'] : '';    
                    $booking_status = ['2'];   
                    $service_status = [];   
                    $api_type = 'cancelled';
                    $bookings = $this->get_customer_booking($api_type,$customer_id,$salon_id,$branch_id,$booking_id,$booking_status,$service_status,$limit,$offset);
                    
                    if(!empty($bookings)){ 
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $bookings;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Bookings not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function completed_bookings(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $limit = $request['limit'];   
                    $offset = $request['offset'];   
                    $booking_id = isset($request['booking_id']) ? $request['booking_id'] : '';     
                    $booking_status = ['5'];   
                    $service_status = [];   
                    $api_type = 'completed';
                    $bookings = $this->get_customer_booking($api_type,$customer_id,$salon_id,$branch_id,$booking_id,$booking_status,$service_status,$limit,$offset);
                    
                    if(!empty($bookings)){ 
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $bookings;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Bookings not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_memberships(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];  

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){ 
                    $membership_id = isset($request['membership_id']) ? $request['membership_id'] : '';  
                    
                    if($membership_id != ""){
                        $this->db->where('tbl_memebership.id', $membership_id);
                    } 
                    $this->db->where('tbl_memebership.status', '1');
                    $this->db->where('tbl_memebership.is_deleted', '0');
                    $this->db->where('tbl_memebership.branch_id', $branch_id);
                    $this->db->where('tbl_memebership.salon_id', $salon_id);
                    if($single->gender != ""){
                        $this->db->where('tbl_memebership.gender',$single->gender);
                    }
                    $this->db->order_by('tbl_memebership.id', 'DESC');                
                    $result = $this->db->get('tbl_memebership');
                    $memberships = $result->result();
                     
                    $salon_profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                    $is_gst_applicable = '0';
                    $gst_rate = 0;
                    if(!empty($salon_profile)){
                        if($salon_profile->is_gst_applicable == '1'){
                            $is_gst_applicable = '1';
                            $setup = $this->Master_model->get_backend_setups();	
                            if(!empty($setup)){
                                $gst_rate = $setup->gst_rate;
                            }
                        }
                    }
                    if(!empty($memberships)){ 
                        $data = array();
                        foreach($memberships as $memberships_result){                             
                            $discount_type = $memberships_result->discount_in;
                            if($discount_type == '0'){
                                $service_discount_text = $memberships_result->service_discount.'% Discount on Services';
                                $product_discount_text = $memberships_result->product_discount.'% Discount on Products';
                            }elseif($discount_type == '1'){
                                $service_discount_text = 'Flat Rs. ' . $memberships_result->service_discount . ' Discount on Services';
                                $product_discount_text = 'Flat Rs. ' . $memberships_result->product_discount . ' Discount on Products';
                            }else{
                                $service_discount_text = '';
                                $product_discount_text = '';
                            }

                            if($memberships_result->service_discount != "" && $memberships_result->product_discount == ""){
                                $discount_text = $service_discount_text;
                            }elseif($memberships_result->service_discount == "" && $memberships_result->product_discount != ""){
                                $discount_text = $product_discount_text;
                            }elseif($memberships_result->service_discount != "" && $memberships_result->product_discount != ""){
                                $discount_text = $service_discount_text . ' & ' . $product_discount_text;
                            }else{
                                $discount_text = '';
                            }

                            $gst_amount = ($memberships_result->membership_price * ((float)$gst_rate)) / 100;
                            $data[] = array(
                                'membership_id'     =>  $memberships_result->id,
                                'name'              =>  $memberships_result->membership_name,                                
                                'discount_text'     =>  $discount_text,
                                'duration_text'     =>  'Valid Upto ' . $memberships_result->duration . ' Months',
                                'price'             =>  $memberships_result->membership_price + $gst_amount,
                                'background_color'  =>  $memberships_result->bg_color,
                                'text_color'        =>  $memberships_result->text_color,
                                'description'       =>  $memberships_result->description,

                                'original_price'    =>  $memberships_result->membership_price,
                                'is_gst_applicable' =>  $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                'salon_gst_rate' 	=>  $gst_rate, 
                                'gst_amount' 	    =>  $gst_amount, 
                            );
                        }                            
                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Memberships not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    } 
    public function get_store_offers(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){      
                    $offer_id = isset($request['offer_id']) ? $request['offer_id'] : '';  
                    
                    if($offer_id != ""){
                        $this->db->where('tbl_offers.id', $offer_id);
                    }                
                    $this->db->where('tbl_offers.status', '1');
                    $this->db->where('validity_status','1');
                    $this->db->where('tbl_offers.is_deleted', '0');
                    $this->db->where('tbl_offers.branch_id', $branch_id);
                    $this->db->where('tbl_offers.salon_id', $salon_id);
                    if($single->gender != ""){
                        $this->db->where('tbl_offers.gender',$single->gender);
                    }
                    $this->db->order_by('tbl_offers.id', 'DESC');                
                    $result = $this->db->get('tbl_offers');
                    $offers = $result->result();
                    
                    if(!empty($offers)){ 
                        $data = [];
                        foreach($offers as $offers_result){
                            $services = explode(',',$offers_result->service_name);
                            $services_text = '';
                            $services_array = [];
                            if(count($services) > 0){
                                for($i=0;$i<count($services);$i++){
                                    $this->db->select('tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category as sub_category_name,tbl_admin_sub_category.sub_category_marathi,tbl_salon_emp_service.*');      
                                    $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                    $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                    $this->db->where('tbl_salon_emp_service.id',$services[$i]);
                                    $this->db->where('tbl_salon_emp_service.branch_id',$branch_id);
                                    $this->db->where('tbl_salon_emp_service.salon_id',$salon_id);
                                    $this->db->where('tbl_salon_emp_service.is_deleted','0');
                                    $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                    if (!empty($service_details)) {
                                        // $services_text .= $service_details->service_name . '|' . $service_details->service_name_marathi;
                                        $services_text .= ($service_details->sub_category_name != "" ? $service_details->sub_category_name . '-' : '') . '' . $service_details->service_name;
                                        
                                        $services_array[] = array(
                                            'service_id'        =>  $service_details->id,
                                            'service_name'      =>  $service_details->service_name,
                                            'service_name_marathi'    =>  $service_details->service_name_marathi,
                                            'category_name'           =>  $service_details->sup_category,
                                            'category_name_marathi'   =>  $service_details->service_name_marathi,
                                            'sub_category_name'       =>  $service_details->sub_category_name,
                                            'sub_category_name_marathi'  =>  $service_details->sub_category_marathi,
                                        );
                                        
                                        if ($i < count($services) - 1) {
                                            $services_text .= ', ';
                                        }
                                    }
                                }
                            }

                            if($offers_result->discount_in == '0'){
                                $offer_text = $offers_result->discount.'%';
                                $offer_discount_text = $offers_result->discount.'% Off';
                            }elseif($offers_result->discount_in == '1'){
                                $offer_text = 'Flat Rs.'.$offers_result->discount;
                                $offer_discount_text = 'Flat Rs.'.$offers_result->discount.' Off';
                            }else{
                                $offer_text = '';
                                $offer_discount_text = '';
                            }

                            $validity_text = '';
                            if (!empty($offers_result->offer_ends)) {
                                $today = new DateTime();
                                $offer_ends = new DateTime($offers_result->offer_ends);
                                $interval = $today->diff($offer_ends);
                                $days_left = (int)$interval->format('%r%a');

                                if ($days_left < 0) {
                                    $validity_text = 'Offer expired';
                                } elseif ($days_left == 0) {
                                    $validity_text = 'Offer valid till today';
                                } elseif ($days_left < 7) {
                                    $validity_text = 'Offer valid for ' . $days_left . ' day' . ($days_left > 1 ? 's' : '');
                                } else {
                                    $weeks_left = floor($days_left / 7);
                                    $validity_text = 'Offer valid for ' . $weeks_left . ' week' . ($weeks_left > 1 ? 's' : '');
                                }
                            } else {
                                if ($offers_result->duration > 1) {
                                    $validity_text = 'Offer valid for ' . $offers_result->duration . ' weeks';
                                } else {
                                    $validity_text = 'Offer valid for ' . $offers_result->duration . ' week';
                                }
                            }

                            $data[] = array(
                                'offer_id'          =>  $offers_result->id,
                                'offer_text'        =>  $offer_text.' Off on '.$services_text,
                                'offer_discount_text'        =>  $offer_discount_text,
                                'validity'          =>  $offers_result->duration,
                                'validity_text'     =>  $validity_text,
                                'offer_starts'      =>  $offers_result->offer_starts != "" ? date('d M, Y',strtotime($offers_result->offer_starts)) : null,
                                'offer_ends'        =>  $offers_result->offer_ends != "" ? date('d M, Y',strtotime($offers_result->offer_ends)) : null,
                                'rewards'           =>  $offers_result->reward_point,
                                'offer_icon'        =>  '',
                                'offer_name'        =>  $offers_result->offers_name,
                                'services_text'     =>  trim($services_text,','),
                                'discount_type'     =>  $offers_result->discount_in,
                                'discount'          =>  $offers_result->discount,
                                'services'          =>  $services_array,
                            );
                        }

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'Success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Offers not found';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_coupons(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){      
                    $coupon_id = isset($request['coupon_id']) ? $request['coupon_id'] : '';  
                    
                    if($coupon_id != ""){
                        $this->db->where('tbl_coupon_code.id', $coupon_id);
                    }                
                    $this->db->where('tbl_coupon_code.status', '1');
                    $this->db->where('tbl_coupon_code.is_deleted', '0');
                    if($single->gender != ""){
                        $this->db->where('tbl_coupon_code.gender',$single->gender);
                    }
                    $this->db->where('tbl_coupon_code.branch_id', $branch_id);
                    $this->db->where('tbl_coupon_code.salon_id', $salon_id);
                    $this->db->order_by('tbl_coupon_code.id', 'DESC');                
                    $result = $this->db->get('tbl_coupon_code');
                    $coupons = $result->result();
                    
                    if(!empty($coupons)){ 
                        $data = [];
                        foreach($coupons as $coupons_result){
                            $data[] = array(
                                'coupon_id'         =>  $coupons_result->id,
                                'coupon_name'       =>  $coupons_result->coupon_name,
                                'coupon_code'       =>  $coupons_result->coupan_code,
                                'minimum_amount'    =>  $coupons_result->min_price,
                                'offered_price'     =>  $coupons_result->coupon_offers,
                                'gender'            =>  $coupons_result->gender,
                                'coupan_expiry'      =>  $coupons_result->coupan_expiry,
                                'gender_text'       =>  ($coupons_result->gender =='1') ? 'Female' : (($coupons_result->gender == '0') ? 'Male' : '-'),
                            );
                        }

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'Success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Coupons not found';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_giftcards(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){      
                    $giftcard_id = isset($request['giftcard_id']) ? $request['giftcard_id'] : '';  
                    
                    if($giftcard_id != ""){
                        $this->db->where('tbl_gift_card.id', $giftcard_id);
                    }                
                    $this->db->where('tbl_gift_card.status', '1');
                    $this->db->where('tbl_gift_card.is_deleted', '0');
                    if($single->gender != ""){
                        $this->db->where('tbl_gift_card.gender',$single->gender);
                    }
                    $this->db->where('tbl_gift_card.branch_id', $branch_id);
                    $this->db->where('tbl_gift_card.salon_id', $salon_id);
                    $this->db->order_by('tbl_gift_card.id', 'DESC');                
                    $result = $this->db->get('tbl_gift_card');
                    $giftcards = $result->result();                    
                            
                    $salon_profile = $this->Salon_model->get_all_salon_profile_single_all($branch_id,$salon_id);
                    $is_gst_applicable = '0';
                    $gst_rate = 0;
                    if(!empty($salon_profile)){
                        if($salon_profile->is_gst_applicable == '1'){
                            $is_gst_applicable = '1';
                            $setup = $this->Master_model->get_backend_setups();	
                            if(!empty($setup)){
                                $gst_rate = $setup->gst_rate;
                            }
                        }
                    }
                    
                    if(!empty($giftcards)){ 
                        $data = [];
                        foreach($giftcards as $giftcards_result){
                            if($giftcards_result->discount_in == '0'){
                                $discount_amount = ($giftcards_result->regular_price * $giftcards_result->discount) / 100;
                                $discount_text = $giftcards_result->discount . '% Off';
                            }elseif($giftcards_result->discount_in == '1'){
                                $discount_amount = $giftcards_result->discount;
                                $discount_text = 'Flat' . $giftcards_result->discount . ' Off';
                            }else{
                                $discount_amount = '0';
                                $discount_text = '';
                            }

                            $gst_amount = ($giftcards_result->regular_price * ((float)$gst_rate)) / 100;
                            $data[] = array(
                                'giftcard_id'           =>  $giftcards_result->id,
                                'giftcard_name'         =>  $giftcards_result->gift_name,
                                'giftcard_code'         =>  $giftcards_result->gift_card_code,
                                'giftcard_gender'       =>  $giftcards_result->gender,
                                'regular_price'         =>  $giftcards_result->regular_price,
                                'discount_text'         =>  $discount_text,
                                'discount_amount'       =>  $discount_amount,
                                'final_buy_price'       =>  $giftcards_result->regular_price + $gst_amount,
                                'offered_price'         =>  $giftcards_result->gift_price,
                                'min_booking_amt'       =>  $giftcards_result->min_booking_amt,
                                'text_color'            =>  $giftcards_result->text_color,
                                'background_color'      =>  $giftcards_result->bg_color,
                                
                                'is_gst_applicable'     => $is_gst_applicable == '1' ? $is_gst_applicable : '0', 
                                'salon_gst_rate' 	    => $gst_rate, 
                                'gst_amount' 	        => $gst_amount, 
                            );
                        }

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'Success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Giftcards not found';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_employees(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->select('tbl_salon_employee.*,tbl_emp_designation.designation as designation_name');
                $this->db->join('tbl_branch','tbl_branch.id = tbl_salon_employee.branch_id');
                $this->db->join('tbl_emp_designation','tbl_emp_designation.id = tbl_salon_employee.designation');
                $this->db->where('tbl_salon_employee.is_deleted','0');
                // $this->db->where('LOWER(tbl_emp_designation.designation)', strtolower('Stylist'));
                $this->db->where('tbl_branch.is_deleted','0');
                $this->db->where('tbl_salon_employee.salon_id',$salon_id);
                $this->db->where('tbl_salon_employee.branch_id',$branch_id);
                $result = $this->db->get('tbl_salon_employee')->result();

                if(!empty($result)){
                    $data = array();
                    foreach($result as $result_data){
                        $this->db->where('is_deleted', '0');
                        $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');                           
                        $result = $this->db->get('tbl_admin_service_category');
                        $result = $result->result();
                        $data[] = array(
                            'employee_id'   =>  $result_data->id,
                            'employee_name' =>  $result_data->full_name,
                            'designation'   =>  $result_data->designation_name,
                            'branch_id'     =>  $result_data->branch_id,
                            'salon_id'      =>  $result_data->salon_id,
                            'profile_photo' =>  $result_data->profile_photo != "" ? base_url('admin_assets/images/employee_profile/' . $result_data->profile_photo) : '',
                        );
                    }

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Employees not available.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_service_category(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                $customer_id = $request['customer_id'];
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();
                if(!empty($single)){                
                    $this->db->where('is_deleted', '0');
                    $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');      
                    if($single->gender != ""){
                        $this->db->where('gender',$single->gender);
                    }                     
                    $result = $this->db->get('tbl_admin_service_category');
                    $result = $result->result();
                    if(!empty($result)){
                        $data = array();
                        foreach($result as $result_data){
                            $this->db->where('tbl_salon_emp_service.category', $result_data->id);
                            $this->db->where('tbl_salon_emp_service.status', '1');
                            $this->db->where('tbl_salon_emp_service.is_deleted', '0');
                            if($single->gender != ""){
                                $this->db->where('tbl_salon_emp_service.gender',$single->gender);
                            }
                            $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                            $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                            $this->db->select('tbl_salon_emp_service.*, tbl_admin_sub_category.sub_category as subcategory,tbl_admin_sub_category.sub_category_marathi,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi');
                            $this->db->from('tbl_salon_emp_service');
                            $this->db->join('tbl_admin_sub_category', 'tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category', 'left');
                            $this->db->join('tbl_admin_service_category', 'tbl_admin_service_category.id = tbl_salon_emp_service.category', 'left');                  
                            $this->db->order_by('CAST(tbl_salon_emp_service.order AS UNSIGNED)', 'asc');
                        
                            $result = $this->db->get();
                            $services = $result->result();
                            if(!empty($services)){
                                $data[] = array(
                                    'category_id'   =>  $result_data->id,
                                    'name'          =>  $result_data->sup_category,
                                    'marathi_name'  =>  $result_data->sup_category_marathi,
                                    'image'         =>  $result_data->category_image != "" ? base_url('admin_assets/images/service_category_image/' . $result_data->category_image) : '',
                                );
                            }
                        }

                        if(!empty($data)){
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Category with services not available.';
                            $json_arr['data'] = $data;
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Category not available.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_product_category(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->order_by('CAST(`order` AS UNSIGNED)', 'asc');
                $result = $this->db->get('tbl_product_category');
                $result = $result->result();

                if(!empty($result)){
                    $data = array();
                    foreach($result as $result_data){
                        $data[] = array(
                            'category_id'   =>  $result_data->id,
                            'name'          =>  $result_data->product_category,
                            'marathi_name'  =>  $result_data->product_category_marathi,
                            'image'         =>  $result_data->product_photo != "" ? base_url('admin_assets/images/product_category/' . $result_data->product_photo) : '',
                        );
                    }

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Category not available.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function get_store_genders(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['salon_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('salon_id',$salon_id);
                $this->db->where('id',$branch_id);
                $exist = $this->db->get('tbl_branch')->row();

                if(!empty($exist)){
                    if($exist->category == '0'){
                        $genders = ['Male'];
                    }elseif($exist->category == '1'){
                        $genders = ['Female'];
                    }elseif($exist->category == '2'){
                        $genders = ['Male','Female'];
                    }else{
                        $genders = [];
                    }

                    // $genders = ['Male','Female'];

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $genders;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Genders not available.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 
    public function get_customer_stores(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['mobile_number']){
                $mobilenumber = $request['mobile_number'];

                $this->db->where('is_deleted','0');
                $this->db->where('customer_phone',$mobilenumber);
                $stores = $this->db->get('tbl_salon_customer')->result();

                $data = array();
                if(!empty($stores)){
                    foreach($stores as $stores_result){
                        $is_profile_update = false;
                        $this->db->select('tbl_store_profile.*,tbl_branch.salon_address as branch_salon_address,tbl_branch.pincode as branch_salon_pincode, tbl_branch.salon_number as branch_salon_number');
                        $this->db->join('tbl_branch','tbl_branch.id = tbl_store_profile.branch_id');
                        $this->db->where('tbl_store_profile.is_deleted','0');
                        $this->db->where('tbl_store_profile.branch_id',$stores_result->branch_id);
                        $this->db->where('tbl_store_profile.salon_id',$stores_result->salon_id);
                        $branch_profile = $this->db->get('tbl_store_profile')->row();
                        if(!empty($branch_profile)){      
                            if($stores_result->full_name == "" || $stores_result->gender == ""){
                                $is_profile_update = true;
                            }            
                            $data[] = array(
                                'branch_id'             =>  $stores_result->branch_id,
                                'salon_id'              =>  $stores_result->salon_id,
                                'branch_name'           =>  $branch_profile->branch_name,
                                'salon_mobile_number'   =>  $branch_profile->branch_salon_number,
                                'store_logo'            =>  base_url('admin_assets/images/store_logo/' . $branch_profile->store_logo),
                                'address'               =>  $branch_profile->branch_salon_address . ($branch_profile->branch_salon_pincode != "" ? ' '.$branch_profile->branch_salon_pincode : ''),
                                'customer_id'           =>  $stores_result->id,
                                'is_profile_update'     =>  $is_profile_update,
                                'customer_name'         =>  $stores_result->full_name
                            );
                        }
                    }
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = $data;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Stores not available.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 

    public function set_fcm_token(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['fcm_token'])){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted', '0');
                $this->db->where('id', $customer_id);
                $this->db->where('salon_id', $salon_id);
                $this->db->where('branch_id', $branch_id);
                $exist = $this->db->get('tbl_salon_customer')->row();
                if (!empty($exist)) {
                    $data = array(
                        'fcm_token'     =>  $request['fcm_token'],
                        'is_logged_in'  =>  '1',
                    );
                    $this->db->where('id',$exist->id);
                    $this->db->update('tbl_salon_customer',$data);
                    
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'FCM Token set successfully.';
                    $json_arr['data'] = [];
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'FCM Token not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr);
    }
    public function update_customer_profile(){
        if (isset($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $salon_id = $_POST['salon_id'];
            $branch_id = $_POST['branch_id'];
    
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $customer_id);
            $this->db->where('salon_id', $salon_id);
            $this->db->where('branch_id', $branch_id);
            $exist = $this->db->get('tbl_salon_customer')->row();
    
            if (!empty($exist)) {
                $data = array();
    
                if (isset($_POST['f_name']) && $_POST['f_name'] != "") {
                    $data['f_name'] = $_POST['f_name'];
                }
    
                if (isset($_POST['l_name']) && $_POST['l_name'] != "") {
                    $data['l_name'] = $_POST['l_name'];
                }
    
                if (isset($_POST['f_name']) && $_POST['f_name'] != "" && isset($_POST['l_name']) && $_POST['l_name'] != "") {
                    $data['full_name'] = $_POST['f_name'] . ' ' . $_POST['l_name'];
                }else if (isset($_POST['full_name']) && $_POST['full_name'] != "") {
                    $data['full_name'] = $_POST['full_name'];
                }
    
                if (isset($_POST['customer_phone']) && $_POST['customer_phone'] != "") {
                    $data['customer_phone'] = $_POST['customer_phone'];
                }
    
                if (isset($_POST['date_of_anniversary']) && $_POST['date_of_anniversary'] != "") {
                    $data['doa'] = date('Y-m-d', strtotime($_POST['date_of_anniversary']));
                }
    
                if (isset($_POST['date_of_birth']) && $_POST['date_of_birth'] != "") {
                    $data['dob'] = date('Y-m-d', strtotime($_POST['date_of_birth']));
                }
    
                if (isset($_POST['gender']) && $_POST['gender'] != "") {
                    $gender = '';
                    switch ($_POST['gender']) {
                        case "Male":
                            $gender = '0';
                            break;
                        case "Female":
                            $gender = '1';
                            break;
                        case "Other":
                            $gender = '2';
                            break;
                    }
                    $data['gender'] = $gender;
                }
                
                if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
                    $temp = explode('.', $_FILES['profile_pic']['name']);
					$ext = end($temp);
					$new_profile_photo = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
					$config = array(
						'upload_path' 	=> "salon_assets/images/customer_profile/",
						'allowed_types' => "pdf|jpg|jpeg|png",
						'file_name'		=> $new_profile_photo,
					);			
					$this->upload->initialize($config);
					if($this->upload->do_upload('profile_pic')){
						$file_data = $this->upload->data();				
						$new_profile_photo = $file_data['file_name'];	
					}else{ 
						$error = array('error' => $this->upload->display_errors());	
						$this->upload->display_errors();
                        $new_profile_photo = '';
					}
    
                    if ($new_profile_photo != "") {
                        $data['profile_pic'] = $new_profile_photo;
                    }
                }
    
                $this->db->where('id', $exist->id);
                $this->db->update('tbl_salon_customer', $data);   
    
                $json_arr['status'] = 'true';
                $json_arr['message'] = 'success';
                $json_arr['data'] = [];
            } else {
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Profile details not available.';
                $json_arr['data'] = [];
            }
    
            echo json_encode($json_arr);
        }
    }
    
    public function get_store_details(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['branch_id']) && $request['branch_id'] != ""){
                $this->db->where('active_for_mobile_apps','1');
                $this->db->where('is_deleted','0');
                $this->db->where('id',$request['branch_id']);
                $branch = $this->db->get('tbl_branch')->row();
                if(empty($branch)){
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Napito services are no longer available for this salon. Please contact the salon directly.';
                    $json_arr['data'] = [];
                    echo json_encode($json_arr);
                    exit;
                }
            }

            if(isset($request['store_code'])){
                $store_code = $request['store_code'];
                $this->db->where('is_deleted','0');
                $this->db->where('branch_unique_code',$store_code);
                $branch = $this->db->get('tbl_branch')->row();

                if(!empty($branch)){
                    if($branch->active_for_mobile_apps == '1'){
                        $this->db->select('tbl_store_profile.*,tbl_branch.category as branch_category');
                        $this->db->where('tbl_store_profile.is_deleted','0');
                        $this->db->where('tbl_store_profile.branch_id',$branch->id);
                        $this->db->where('tbl_store_profile.salon_id',$branch->salon_id);
                        $this->db->join('tbl_branch','tbl_branch.id = tbl_store_profile.branch_id');
                        $branch_profile = $this->db->get('tbl_store_profile');
                        $branch_profile = $branch_profile->row();
                        if(!empty($branch_profile)){                    
                            $this->db->select('tbl_store_reviews.*,tbl_salon_customer.full_name,tbl_salon_customer.profile_pic');
                            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_store_reviews.customer_id');
                            $this->db->order_by('tbl_store_reviews.created_on','desc');
                            $this->db->where('tbl_store_reviews.is_deleted','0');
                            $this->db->where('tbl_store_reviews.salon_id',$branch->salon_id);
                            $this->db->where('tbl_store_reviews.branch_id',$branch->id);
                            $result = $this->db->get('tbl_store_reviews');
                            $result = $result->result();
                            
                            $total = 0;
                            $rating = '';
                            if(!empty($result)){
                                foreach($result as $result_data){
                                    $total += (float)str_replace('.', '', $result_data->stars);
                                }
                            }
                            
                            $total_entries = count($result);
                            if($total_entries > 0){
                                $rating = round($total / $total_entries);
                            }

                            $data['branch_id'] = $branch->id;
                            $data['salon_id'] = $branch->salon_id;
                            $data['branch_name'] = $branch_profile->branch_name;
                            $data['mobile_number'] = $branch->salon_number;
                            $data['description'] = $branch_profile->description;
                            $data['category'] = $branch_profile->branch_category;
                            $data['store_logo'] = base_url('admin_assets/images/store_logo/' . $branch_profile->store_logo);
                            $data['address'] = $branch->salon_address . ($branch->pincode != "" ? ' '.$branch->pincode : '');
                            $data['rating'] = $rating;

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = [$data];
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Details not found. Please contact the store.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Napito services are no longer available for this salon. Please contact the salon directly.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Details not found. Please contact the store.';
                    $json_arr['data'] = [];
                }
                
                echo json_encode($json_arr);
            }
        }
    } 
    public function set_store(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['customer_id'])){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('id',$customer_id);
                $this->db->where('salon_id',$salon_id);
                $this->db->where('branch_id',$branch_id);
                $exist = $this->db->get('tbl_salon_customer')->row();

                if(!empty($exist)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$branch_id);
                    $this->db->where('salon_id',$salon_id);
                    $branch = $this->db->get('tbl_branch')->row();

                    if(!empty($branch)){
                        if($branch->active_for_mobile_apps == '1'){
                            $update_data = array(
                                'salon_id'  =>  $salon_id,
                                'branch_id' =>  $branch_id
                            );
                            $this->db->where('id',$exist->id);
                            $this->db->update('tbl_salon_customer',$update_data);

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = [];                     
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Napito services are no longer available for this salon. Please contact the salon directly.';
                            $json_arr['data'] = [];
                        }                      
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Invalid store. Please try again.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $update_data = array(
                        'salon_id'  =>  $salon_id,
                        'branch_id' =>  $branch_id
                    );
                    $this->db->where('id',$customer_id);
                    $this->db->update('tbl_salon_customer',$update_data);
                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'success';
                    $json_arr['data'] = [];  
                }

                $this->Salon_model->insert_new_customer_coin_entry($customer_id,$branch_id,$salon_id);
                
                echo json_encode($json_arr);
            }
        }
    }
    public function set_new_store(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['customer_id'])){
                $customer_id = $request['customer_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('id',$customer_id);
                $current_customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($current_customer)){
                    $customer_mobile = $current_customer->customer_phone;
                    $salon_id = $request['salon_id'];
                    $branch_id = $request['branch_id'];

                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$branch_id);
                    $this->db->where('salon_id',$salon_id);
                    $new_branch = $this->db->get('tbl_branch')->row();
                    if(!empty($new_branch)){
                        if($new_branch->active_for_mobile_apps == '1'){
                            $this->db->where('is_deleted','0');
                            $this->db->where('salon_id',$new_branch->salon_id);
                            $this->db->where('branch_id',$new_branch->id);
                            $this->db->where('customer_phone',$customer_mobile);
                            $this->db->order_by('created_on','desc');
                            $this->db->limit(1);
                            $exist = $this->db->get('tbl_salon_customer')->row();
                            if(!empty($exist)){
                                if(isset($request['fcm_token']) && $request['fcm_token'] != ""){
                                    $user_data = array(
                                        'fcm_token'      =>  $request['fcm_token'],
                                        'is_logged_in'   =>  '1'
                                    );     
                                }else{
                                    $user_data = array(
                                        'is_logged_in'   =>  '1'
                                    );  
                                }
                                $this->db->where('id',$exist->id);  
                                $this->db->update('tbl_salon_customer',$user_data);

                                $customer_id = $exist->id;
                                $is_new = false;
                            }else{     
                                $user_data = array(
                                    'customer_phone'    =>  $customer_mobile,
                                    'salon_id'          =>  $new_branch->salon_id,
                                    'branch_id'         =>  $new_branch->id,
                                    'is_logged_in'      =>  '1',
                                    'registered_from'   =>  '1',
                                    'fcm_token'         =>  isset($request['fcm_token']) ? $request['fcm_token'] : null,
                                    'created_on'        =>  date('Y-m-d H:i:s')
                                );           
                                $this->db->insert('tbl_salon_customer',$user_data);

                                $customer_id = $this->db->insert_id();                
                                $is_new = true;
                            }                        

                            $this->Salon_model->insert_new_customer_coin_entry($customer_id,$branch_id,$salon_id);

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = ['is_new'=>$is_new,'customer_id'=>$customer_id];                        
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Napito services are no longer available for this salon. Please contact the salon directly.';
                            $json_arr['data'] = [];
                        }                     
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Invalid store. Please try again.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer details not found. Please try again.';
                    $json_arr['data'] = [];
                }                
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Customer ID not found.';
                $json_arr['data'] = [];
            }  
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found. Please try again.';
            $json_arr['data'] = [];
        }  
        echo json_encode($json_arr);
    } 

    
	
	public function get_help_types(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$customer_id = $request['customer_id'];

			$this->db->select('id as query_type_id,reason as query_type');
			$this->db->where('is_deleted', '0');
			$this->db->where('status', '1');
			$result = $this->db->get('tbl_complaint_reason');
			$result = $result->result();
	
			foreach ($result as &$row) {
				foreach ($row as $key => &$value) {
					if (is_null($value) || $value == "") {
						$value = "";
					}
				}
			}

			if (!empty($result)) {
				$data['status'] = 'true';
				$data['message'] = 'success';
				$data['data'] = $result;
			} else {
				$data['status'] = 'false';
				$data['message'] = 'Query Type not found';
				$data['data'] = null;
			}			
		} else {
            $data['status'] = 'false';
            $data['message'] = 'Request not found';
            $data['data'] = null;
		}
        echo json_encode($data);
	}
	
	public function get_user_queries(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$customer_id = $request['customer_id'];
			$salon_id = $request['salon_id'];
			$branch_id = $request['branch_id'];

			$this->db->select('tbl_customer_support.id, tbl_customer_support.support_id, tbl_salon_customer.full_name,tbl_salon_customer.email, tbl_salon_customer.customer_phone, tbl_customer_support.subject_id as query_type_id,tbl_customer_support.description,tbl_customer_support.final_resolution_status,tbl_customer_support.attachments,tbl_customer_support.final_remark,tbl_customer_support.final_remark_date,tbl_complaint_reason.reason as query_type, tbl_customer_support.created_on as ticket_datetime');
			$this->db->join('tbl_complaint_reason','tbl_complaint_reason.id = tbl_customer_support.subject_id');
			$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_customer_support.customer_id');
			$this->db->where('tbl_customer_support.is_deleted', '0');
			$this->db->where('tbl_customer_support.status', '1');
			$this->db->where('tbl_customer_support.customer_id', $customer_id);
			$this->db->where('tbl_customer_support.salon_id', $salon_id);
			$this->db->where('tbl_customer_support.branch_id', $branch_id);
			$this->db->order_by('tbl_customer_support.updated_on', 'desc');
			$result = $this->db->get('tbl_customer_support');
			$result = $result->result();
	
			foreach ($result as &$row) {
				foreach ($row as $key => &$value) {
					if (is_null($value) || $value == "") {
						$value = "";
					}
                }

                if (!empty($row->attachments)) {
                    $row->attachment_link = base_url() . 'admin_assets/images/customer_queries/' . $row->attachments;
                } else {
                    $row->attachment_link = "";
                }

                if ($row->final_resolution_status == '0') {
                    $row->final_resolution_status_text = 'Pending';
                } else if ($row->final_resolution_status == '1') {
                    $row->final_resolution_status_text = 'Completed';
                } else if ($row->final_resolution_status == '2') {
                    $row->final_resolution_status_text = 'In Process';
                } else {
                    $row->final_resolution_status_text = '';
                }

                $row->ticket_datetime = date('d M, Y h:i A', strtotime($row->ticket_datetime));
			}

			if (!empty($result)) {
				$data['status'] = 'true';
				$data['message'] = 'success';
				$data['data'] = $result;
			} else {
				$data['status'] = 'false';
				$data['message'] = 'Queries not found';
				$data['data'] = null;
			}
		} else {
            $data['status'] = 'false';
            $data['message'] = 'Request not found';
            $data['data'] = null;
		}
        echo json_encode($data);
	}
	
	
    public function insert_user_query(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$data = array(
				'customer_id'	=> $request['customer_id'],
				'salon_id'	    => $request['salon_id'],
				'branch_id'	    => $request['branch_id'],
				'subject_id'	=> $request['query_type'],
				'description'	=> $request['description'],
				'created_on'	=> date('Y-m-d H:i:s'),
			);
			$this->db->insert('tbl_customer_support',$data);
			$support_id = $this->db->insert_id();

			$support_unique_id = $support_id . '-' . time();

			$profile_photo = '';
            $photo = $request['attachment'];
            if (!empty($photo)) {
                $tmp = explode('.', $request['attachment_filename']);
                $ext = end($tmp);
                $folder_save = "admin_assets/images/customer_queries/";
                $key = random_int(0, 99999);
                $key = str_pad($key, 6, 0, STR_PAD_LEFT);
                $profile_photo =  $support_unique_id . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT).'.'.$ext;
                $file_save = $folder_save . $profile_photo;
        
                if (file_put_contents($file_save, base64_decode($photo))) {
					$attachment_data = array(
						'attachments' => $profile_photo,
					);
					$this->db->where('id',$support_id);
					$this->db->update('tbl_customer_support',$attachment_data);
                }
			}

			$support_data = array(
				'support_id' => $support_unique_id,
			);
			$this->db->where('id',$support_id);
			$this->db->update('tbl_customer_support',$support_data);
			
			// $data = array(
			// 	'customer_id'	=> $request['customer_id'],
			// 	'support_id'	=> $support_unique_id,
			// 	'tbl_support_id'=> $support_id,
			// 	'replay'		=> $request['description'],
			// 	'replay_type'	=> '0',
			// 	'created_on'	=> date('Y-m-d H:i:s'),
			// 	'received_on'	=> date('Y-m-d H:i:s'),
			// );
			// $this->db->insert('tbl_customer_support_ticket_history',$data);

            $this->db->where('id',$request['customer_id']);
            $customer_details = $this->db->get('tbl_salon_customer')->row();

            $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
            $finalNumber = substr($cleanedNumber, -10);
            $finalNumber = '91' . $finalNumber;

            $type = '16';
            
            $message = "We have received your query with Ticket No. ' . $support_unique_id . '. Our admin team will review it and get back to you as soon as possible.";
            $app_message = $message;
            $number = $finalNumber;
            $customer = $customer_details->id;
            $salon_id = $customer_details->salon_id;
            $branch_id = $customer_details->branch_id;
            $for_order_id = '';
            $for_query_id = $support_id;
            $for_offer_id = '';
            $consent_form_id = '';
            $title = 'Support Query Raised';
            $generated_from = '1';
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
                            
			$reponse_data['data'] = array('support_id'=>$support_id);
			$reponse_data['status'] = 'true';
			$reponse_data['message'] = 'success';
		} else {
            $reponse_data['status'] = 'false';
            $reponse_data['message'] = 'Request not found';
            $reponse_data['data'] = null;
		}
        echo json_encode($reponse_data);
    } 
	
    public function insert_user_query_replay(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$this->db->where('id',$request['selected_ticket_id']);
			$ticket = $this->db->get('tbl_customer_support')->row();
			if(!empty($ticket)){
				$data = array(
					'customer_id'	=> $request['customer_id'],
					'support_id'	=> $ticket->support_id,
					'tbl_support_id'=> $request['selected_ticket_id'],
					'replay'		=> $request['replay'],
					'replay_type'	=> '0',
					'created_on'	=> date('Y-m-d H:i:s'),
					'received_on'	=> date('Y-m-d H:i:s'),
				);
				$this->db->insert('tbl_customer_support_ticket_history',$data);
				
				$reponse_data['data'] = array('ticket_id'=>$request['selected_ticket_id']);
				$reponse_data['status'] = 'true';
				$reponse_data['message'] = 'success';
			}else{				
				$reponse_data['status'] = 'false';
				$reponse_data['message'] = 'Ticket not found';
				$reponse_data['data'] = null;
			}
		} else {
            $reponse_data['status'] = 'false';
            $reponse_data['message'] = 'Request not found';
            $reponse_data['data'] = null;
		}
        echo json_encode($reponse_data);
    } 
	public function get_user_single_query(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$customer_id = $request['customer_id'];
			$selected_ticket_id = $request['selected_ticket_id'];

			$this->db->select('tbl_customer_support.id, tbl_customer_support.support_id, tbl_salon_customer.full_name,tbl_salon_customer.email, tbl_salon_customer.customer_phone, tbl_customer_support.subject_id as query_type_id,tbl_customer_support.description,tbl_customer_support.final_resolution_status,tbl_customer_support.attachments,tbl_customer_support.final_remark,tbl_customer_support.final_remark_date,tbl_complaint_reason.reason as query_type,tbl_customer_support.created_on as ticket_datetime');
			$this->db->join('tbl_complaint_reason','tbl_complaint_reason.id = tbl_customer_support.subject_id');
			$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_customer_support.customer_id');
			$this->db->where('tbl_customer_support.is_deleted', '0');
			$this->db->where('tbl_customer_support.status', '1');
			$this->db->where('tbl_customer_support.customer_id', $customer_id);
			$this->db->where('tbl_customer_support.id', $selected_ticket_id);
			$result = $this->db->get('tbl_customer_support');
			$result = $result->result();
	
			foreach ($result as &$row) {
				foreach ($row as $key => &$value) {
					if (is_null($value) || $value == "") {
						$value = "";
					}
				}

                if (!empty($row->attachments)) {
                    $row->attachment_link = base_url() . 'admin_assets/images/customer_queries/' . $row->attachments;
                } else {
                    $row->attachment_link = "";
                }

                if ($row->final_resolution_status == '0') {
                    $row->final_resolution_status_text = 'Pending';
                } else if ($row->final_resolution_status == '1') {
                    $row->final_resolution_status_text = 'Completed';
                } else if ($row->final_resolution_status == '2') {
                    $row->final_resolution_status_text = 'In Process';
                }

                $row->ticket_datetime = date('d M, Y h:i A', strtotime($row->ticket_datetime));
			}

			if (!empty($result)) {
				$data['status'] = 'true';
				$data['message'] = 'success';
				$data['data'] = $result;
			} else {
				$data['status'] = 'false';
				$data['message'] = 'Query not found';
				$data['data'] = null;
			}
		} else {
            $data['status'] = 'false';
            $data['message'] = 'Request not found';
            $data['data'] = null;
		}
        echo json_encode($data);
	}
	
	public function get_user_single_query_replays(){
		$request = json_decode(file_get_contents('php://input'), true);
		if($request != ""){
			$customer_id = $request['customer_id'];
			$selected_ticket_id = $request['selected_ticket_id'];

			$this->db->select('tbl_customer_support_ticket_history.*, tbl_salon_customer.full_name');
			$this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_customer_support_ticket_history.customer_id');
			$this->db->join('tbl_customer_support','tbl_customer_support.id = tbl_customer_support_ticket_history.tbl_support_id');
			$this->db->where('tbl_customer_support_ticket_history.is_deleted', '0');
			$this->db->where('tbl_customer_support_ticket_history.customer_id', $customer_id);
			$this->db->where('tbl_customer_support_ticket_history.tbl_support_id', $selected_ticket_id);
			$result = $this->db->get('tbl_customer_support_ticket_history');
			$result = $result->result();
	
			$custom = array();
			if(!empty($result)){
				foreach ($result as $row) {
					$custom[] = array(
						'replay_id'	=>	$row->id,	
						'message'	=>	$row->replay,	
						'datetime'	=>	date('d M, Y h:i A',strtotime($row->received_on)),	
						'replay_by'	=>	$row->replay_type == '1' ? 'admin' : 'customer',	
						'name'		=>	$row->replay_type == '1' ? 'Admin' : $row->full_name 
					);
				}
			}

			if (!empty($result)) {
				$data['status'] = 'true';
				$data['message'] = 'success';
				$data['data'] = $custom;
			} else {
				$data['status'] = 'false';
				$data['message'] = 'Replay not available';
				$data['data'] = null;
			}
			
			echo json_encode($data);
		} else {
			echo null;
		}
	}

    function generate_secret_token($length = 32) {
        return bin2hex(random_bytes($length));
    }

    private function authenticate($auth_token) {
        $this->db->where('auth_key', $auth_token);
        $this->db->where('is_deleted', '0');
        $user = $this->db->get('tbl_salon_customer')->row();
    
        if (!empty($user)) {
            return true;
        }
        return false;
    }
    
    public function insert_user_review(){
		$request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['customer_id'])){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('id',$customer_id);
                $this->db->where('salon_id',$salon_id);
                $this->db->where('branch_id',$branch_id);
                $exist = $this->db->get('tbl_salon_customer')->row();

                if(!empty($exist)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$branch_id);
                    $this->db->where('salon_id',$salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $feature_slugs = $this->Salon_model->get_subscription_slugs($branch->subscription_id);
                        if(!empty(array_intersect(['insert_app_review'], $feature_slugs))){
                            $this->db->where('is_deleted','0');
                            $this->db->where('id',$request['booking_id']);
                            $this->db->where('customer_name',$customer_id);
                            $this->db->where('salon_id',$salon_id);
                            $this->db->where('branch_id',$branch_id);
                            $booking = $this->db->get('tbl_new_booking')->row();
                            if(!empty($booking)){
                                if($booking->is_review_submitted == '0'){
                                    $data = array(
                                        'customer_id'	=> $customer_id,
                                        'salon_id'	    => $salon_id,
                                        'branch_id'	    => $branch_id,
                                        'booking_id'	=> $request['booking_id'],
                                        'stars'	        => $request['stars'] != "" && $request['stars'] != "0" ? trim($request['stars'], '.') : '0',
                                        'description'	=> $request['description'],
                                        'created_on'	=> date('Y-m-d H:i:s'),
                                    );
                                    $this->db->insert('tbl_store_reviews',$data);

                                    $this->db->where('id',$booking->id);
                                    $this->db->update('tbl_new_booking',array('is_review_submitted'=>'1'));
                                    
                                    $json_arr['data'] = [];
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Review submitted succesfully';     
                                } else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Review already submitted.';
                                    $json_arr['data'] = [];
                                }               
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Booking details not available. Please try again.';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Reviews not allowed. Please contact your salon.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Invalid Branch. Please try again.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Customer ID not found.';
                $json_arr['data'] = [];
            }
        } else {
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found';
            $json_arr['data'] = null;
        }
        echo json_encode($json_arr);
    } 
    
    public function customer_payments(){
		$request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['customer_id'])){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];

                $this->db->where('is_deleted','0');
                $this->db->where('id',$customer_id);
                $this->db->where('salon_id',$salon_id);
                $this->db->where('branch_id',$branch_id);
                $exist = $this->db->get('tbl_salon_customer')->row();

                if(!empty($exist)){
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$branch_id);
                    $this->db->where('salon_id',$salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    if(!empty($branch)){
                        $this->db->where('branch_id',$branch_id);
                        $this->db->where('salon_id',$salon_id);
                        $this->db->where('customer_id',$customer_id);
                        $this->db->where('is_deleted','0');
                        $this->db->order_by('payment_date','desc');
                        $payments = $this->db->get('tbl_booking_payment_entry')->result();
                        $data = [];
                        if(!empty($payments)){
                            foreach($payments as $payments_result){
                                $payment_for = '';
                                $receipt = '';
                                if($payments_result->type == '0'){
                                    $payment_for = 'Appointment Booking Payment';
                                    $bookings_result = $this->db->where('id', $payments_result->booking_id)->get('tbl_new_booking')->row();
                                    if(!empty($bookings_result)){
                                        $receipt = base_url().'booking-print/'.base64_encode($bookings_result->id).'/'.base64_encode($bookings_result->booking_payment_id).'?print&mobile';
                                    }
                                }else if($payments_result->type == '2'){
                                    $payment_for = 'Remaining Due Payment';
                                }else if($payments_result->type == '1'){
                                    $payment_for = 'Membership Payment';
                                    $receipt = base_url('membership-print/' . base64_encode($payments_result->membership_pkey) . '?print&mobile');
                                }else if($payments_result->type == '3'){
                                    $payment_for = 'Giftcard Payment';
                                    $receipt = base_url('giftcard-print/' . base64_encode($payments_result->id) . '?print&mobile');
                                }else if($payments_result->type == '4'){
                                    $payment_for = 'Package Payment';
                                    $receipt = base_url('package-print/' . base64_encode($payments_result->package_allocation_id) . '?print&mobile');
                                }

                                $data[] = array(
                                    'payment_for'	    => $payment_for,
                                    'paid_amount'	    => $payments_result->paid_amount,
                                    'payment_date' => empty($payments_result->payment_date) || date('H:i:s', strtotime($payments_result->payment_date)) == '00:00:00' 
                                        ? date('d-m-Y', strtotime($payments_result->payment_date)) 
                                        : date('d-m-Y h:i A', strtotime($payments_result->payment_date)),                                    
                                    'transaction_id'	=> $payments_result->transaction_id,
                                    'payment_mode'      => $payments_result->payment_mode,
                                    'remark'	        => $payments_result->remark != "" ? $payments_result->remark : '',
                                    'payment_from'	    => $payments_result->payment_from,
                                    'receipt'	        => $receipt
                                );
                            }
                            
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';   
                            $json_arr['data'] = $data;             
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Customer payments not available.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Invalid Branch. Please try again.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Customer ID not found.';
                $json_arr['data'] = [];
            }
        } else {
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found';
            $json_arr['data'] = null;
        }
        echo json_encode($json_arr);
    } 
    public function get_store_reviews(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                
                $this->db->where('is_deleted','0');
                $this->db->where('salon_id',$salon_id);
                $this->db->where('id',$branch_id);
                $exist = $this->db->get('tbl_branch')->row();
                if(!empty($exist)){
                    $feature_slugs = $this->Salon_model->get_subscription_slugs($exist->subscription_id);
                    if(!empty(array_intersect(['insert_app_review'], $feature_slugs))){
                        $this->db->select('tbl_store_reviews.*,tbl_salon_customer.full_name,tbl_salon_customer.profile_pic');
                        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_store_reviews.customer_id');
                        $this->db->where('tbl_store_reviews.is_deleted','0');
                        $this->db->order_by('tbl_store_reviews.created_on','desc');
                        $this->db->where('tbl_store_reviews.salon_id',$salon_id);
                        $this->db->where('tbl_store_reviews.branch_id',$branch_id);
                        $result = $this->db->get('tbl_store_reviews');
                        $result = $result->result();

                        if(!empty($result)){
                            $data = array();
                            foreach($result as $result_data){
                                $data[] = array(
                                    'stars'         =>  $result_data->stars,
                                    'description'   =>  $result_data->description,
                                    'customer_name' =>  $result_data->full_name,
                                    'date'          =>  date('d M, Y h:i A',strtotime($result_data->created_on)),
                                    'profile_pic'   =>  $result_data->profile_pic != "" ? base_url('salon_assets/images/customer_profile/' . $result_data->profile_pic) : '',
                                );
                            }

                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = $data;
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Reviews not available.';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Reviews not allowed. Please contact your salon.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 

    public function send_whatsapp_message($customer,$message,$number,$type){			
        $username = WP_USERNAME;

        // $token = '';		//		client no
        $mobile_nos = $number;
        
        $token = WP_API_KEY;		// company realme (added on 18-07-2024)
        // $mobile_nos = '919766869071';
        
        $data = 'username='.$username.'&number='.$mobile_nos.'&message='.$message.'&token='.$token.'';

        $url = 'https://int.chatway.in/api/send-msg?'.$data;
        
        $url = preg_replace("/ /", "%20", $url);
        $api_response = file_get_contents($url);
        
        $response = json_decode($api_response);

        if (is_array($response) && isset($response[0])) {
            $sending_status	= $response[0]->status;

            $this->set_message_log($customer,'1',$type,$number,$message,$sending_status,$api_response);
        }else{
            return false;
        }

        return $sending_status;
        // return true;
    }
    
    public function set_message_log($customer,$sent_on,$type,$number,$message,$sending_status,$api_response){
        $data = array(
            'sent_on'		=>	$sent_on,
            'type'		    =>	$type,
            'customer_id'	=>	$customer,
            'mobile_no'     =>	$number,
            'message'		=>	$message,
            'api_response_status'	=>	$sending_status,
            'api_response'	=>	$api_response,
            'created_on'	=>	date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_customer_app_message_history',$data);

        return true;
    }
	public function api_get_all_state(){
	    $request = json_decode(file_get_contents('php://input'), true);
        $this->db->where('country_id','101');
        $result = $this->db->get('states');
        $result = $result->result();
        $json_arr['status'] = 'true';
        $json_arr['message'] = 'success';
        $json_arr['data'] = $result; 
        echo json_encode($json_arr);
    }
    public function api_get_state_wise_city(){
        $request = json_decode(file_get_contents('php://input'), true);
        $this->db->where('state_id',$request['state_id']);
        $result = $this->db->get('cities');
        $result = $result->result();
        $json_arr['status'] = 'true';
        $json_arr['message'] = 'success';
        $json_arr['data'] = $result; 
        echo json_encode($json_arr);
    }

    public function set_logged_in_user(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['username']) && isset($request['project']) && isset($request['device_id']) && isset($request['device_details']) && isset($request['user_id']) && isset($request['permission_details'])){
                $username = $request['username'];
                $password = isset($request['password']) ? $request['password'] : '';
                $mobile_no = isset($request['mobile_no']) ? $request['mobile_no'] : '';
                $email = isset($request['email']) ? $request['email'] : '';
                $name = isset($request['name']) ? $request['name'] : '';
                $project = strtolower(trim($request['project']));
                $user_id = $request['user_id'];
                $device_id = $request['device_id'];
                $device_details = $request['device_details'] != "" ? json_encode($request['device_details']) : '';
                $permission_details = $request['permission_details'] != "" ? json_encode($request['permission_details']) : '';

                $this->db->where('project_user_table_id', $user_id);
                $this->db->where('project', $project);
                $this->db->where('username', $username);
                $this->db->where('device_id', $device_id);
                $this->db->where('is_deleted', '0');
                $result = $this->db->get('tbl_app_users');
                $exist = $result->row();
                if(!empty($exist)){
                    $this->db->where('id', $exist->id);
                    $this->db->update('tbl_app_users', array(
                                                                'password'          => $password,
                                                                'mobile_no'         => $mobile_no,
                                                                'email'             => $email,
                                                                'name'              => $name,
                                                                'is_active_login'   => '1', 
                                                                'last_login_on'     => date('Y-m-d H:i:s'), 
                                                                'device_details'    => $device_details,
                                                                'permission_details'=> $permission_details,
                                                                'created_on'        => date('Y-m-d H:i:s')
                                                            ));
                    $app_panel_user_id = $exist->id;
                }else{
                    $this->db->insert('tbl_app_users', array(
                                                                'project'               => $project,
                                                                'device_id'             => $device_id,
                                                                'username'              => $username,
                                                                'password'              => $password,
                                                                'mobile_no'             => $mobile_no,
                                                                'project_user_table_id' => $user_id,
                                                                'email'                 => $email,
                                                                'name'                  => $name,
                                                                'device_details'        => $device_details,
                                                                'permission_details'    => $permission_details,
                                                                'is_active_login'       => '1',
                                                                'last_login_on'         => date('Y-m-d H:i:s')
                                                            ));
                    $app_panel_user_id = $this->db->insert_id();
                }
                echo json_encode(array('status' => 'success', 'message' => 'Device details set successfully', 'app_panel_user_id' => $app_panel_user_id));
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Username, Device Details, Project, Permission Details, User ID required.';
                echo json_encode($json_arr);
            } 
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found. Please try again.';
            echo json_encode($json_arr);
        }
    }    
    public function set_user_logout(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if(isset($request['device_id']) && isset($request['project']) && isset($request['user_id']) && isset($request['app_panel_user_id'])){
                $project = strtolower(trim($request['project']));
                $user_id = $request['user_id'];
                $device_id = $request['device_id'];
                $app_panel_user_id = $request['app_panel_user_id'];

                $this->db->where('id',$user_id);
                $this->db->where('is_deleted', '0');
                $this->db->where('is_logged_in', '1');
                $this->db->update('tbl_salon_customer',array('is_logged_in'=>'0','fcm_token'=>null));

                $this->db->where('project_user_table_id', $user_id);
                $this->db->where('project', $project);
                $this->db->where('id', $app_panel_user_id);
                $this->db->where('device_id', $device_id);
                $this->db->where('is_deleted', '0');
                $this->db->where('is_active_login', '1');
                $result = $this->db->get('tbl_app_users');
                $exist = $result->row();
                if(!empty($exist)){
                    $this->db->where('id', $exist->id);
                    $this->db->update('tbl_app_users', array(
                                                                'is_active_login'   => '0', 
                                                                'last_logout_on'    => date('Y-m-d H:i:s')
                                                            ));
                    echo json_encode(array('status' => 'success', 'message' => 'Successfully Log Out from device'));
                }else{
                    echo json_encode(array('status' => 'error', 'message' => 'Log In device not found'));
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Project, User ID, App Panel User ID, Device ID required.';
                $json_arr['data'] = [];
                echo json_encode($json_arr);
            } 
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found. Please try again.';
            $json_arr['data'] = [];
            echo json_encode($json_arr);
        }
    } 
    
    public function get_store_socials(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];
                
                $this->db->where('is_deleted','0');
                $this->db->where('salon_id',$salon_id);
                $this->db->where('id',$branch_id);
                $exist = $this->db->get('tbl_branch')->row();
                if(!empty($exist)){
                    $this->db->select('tbl_store_profile.*');
                    $this->db->join('tbl_branch','tbl_branch.id = tbl_store_profile.branch_id');
                    $this->db->where('tbl_store_profile.is_deleted','0');
                    $this->db->where('tbl_store_profile.salon_id',$salon_id);
                    $this->db->where('tbl_store_profile.branch_id',$branch_id);
                    $result = $this->db->get('tbl_store_profile');
                    $result = $result->row();

                    if(!empty($result)){
                        $data = array(
                            'instagram_link'    =>  $result->instagram_link != "" ? $result->instagram_link : '',
                            'facebook_link'     =>  $result->facebook_link != "" ? $result->facebook_link : '',
                            'youtube_link'      =>  $result->youtube_link != "" ? $result->youtube_link : '',
                            'website_link'      =>  $result->website_link != "" ? $result->website_link : '',
                        );

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $data;
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Socials not available.';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Branch not found.';
                    $json_arr['data'] = [];
                }
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 
    public function booking_dates() {
        $request = json_decode(file_get_contents('php://input'), true);
        if($request) {
            if(isset($request['branch_id']) && isset($request['salon_id'])) {
                if(isset($request['offset']) && isset($request['limit']) && $request['offset'] != "" && $request['limit'] != "") {
                    $salon_id = $request['salon_id'];
                    $branch_id = $request['branch_id'];
                    $offset = (int)$request['offset'];
                    $limit = (int)$request['limit'];    
    
                    $this->db->where('is_deleted', '0');
                    $this->db->where('salon_id', $salon_id);
                    $this->db->where('id', $branch_id);
                    $exist = $this->db->get('tbl_branch')->row();
    
                    if(!empty($exist)) {
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id, $salon_id);
                        if(!empty($rules)) {
                            $allowed_booking_dates = [];
                            $max_booking_range_day = $rules->max_booking_range_day;
                            $max_days = $max_booking_range_day ? (int)$max_booking_range_day : 1;
                            $start_date = new DateTime();
    
                            for ($i = 0; $i < $max_days; $i++) {
                                $allowed_booking_dates[] = $start_date->format('Y-m-d');
                                $start_date->modify('+1 day');
                            }
                            
                            if (isset($request['month']) && isset($request['year']) && $request['year'] != "" && $request['month'] != "") {
                                $filter_month = (int)$request['month'];
                                $filter_year = (int)$request['year'];
                            
                                $date = DateTime::createFromFormat('Y-m-d', "$filter_year-$filter_month-01");
                            
                                $date->modify("+$offset days");
                            
                                $data = [];
                                for ($i = 0; $i < $limit; $i++) {
                                    if ($date->format('m') != $filter_month) break;
                            
                                    $current_date = $date->format('Y-m-d');
                                    $day_name = $date->format('D');
                                    $is_booking_allowed = in_array($current_date, $allowed_booking_dates) ? 1 : 0;
                            
                                    $data[] = array(
                                        'date' => $current_date,
                                        'day' => $day_name,
                                        'is_booking_allowed' => $is_booking_allowed
                                    );
                            
                                    $date->modify('+1 day');
                                }
                            } else {
                                $date = new DateTime();
                                $date->modify("+$offset days");
    
                                $data = [];
                                for ($i = 0; $i < $limit; $i++) {
                                    $current_date = $date->format('Y-m-d');
                                    $day_name = $date->format('D');
                                    $is_booking_allowed = in_array($current_date, $allowed_booking_dates) ? 1 : 0;
    
                                    $data[] = array(
                                        'date' => $current_date,
                                        'day' => $day_name,
                                        'is_booking_allowed' => $is_booking_allowed
                                    );
    
                                    $date->modify('+1 day');
                                }
                            }
    
                            $json_arr['status'] = 'true';
                            $json_arr['message'] = 'success';
                            $json_arr['data'] = array_values($data);
                        } else {
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not allowed.';
                            $json_arr['data'] = [];
                        }
                    } else {
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not found.';
                        $json_arr['data'] = [];
                    }
                } else {
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Offset & Limit values not available.';
                    $json_arr['data'] = [];
                }
            } else {
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID or Salon ID not available.';
                $json_arr['data'] = [];
            }
        } else {
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not available.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }      
    
    public function booking_stylists(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                $data = array();
                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();                      
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);  
                        if(!empty($rules)){ 
                            $booking_date = isset($request['booking_date']) ? $request['booking_date'] : '';  
                            $selected_services_array = isset($request['selected_services']) ? $request['selected_services'] : [];
                            if(!empty($selected_services_array) && $booking_date != ""){
                                $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all($booking_date,$branch_id,$salon_id);
                                // if(!$is_emergency){
                                if(true){
                                    $working_hrs = $this->Salon_model->get_saloon_working_hrs_all($booking_date,$branch_id,$salon_id);
                                    // if($working_hrs['is_allowed'] == 1){
                                    if(true){
                                        $rules_employee_selection = $rules->employee_selection;
                                        if($rules_employee_selection == '2'){
                                            $is_stylist_selection_page = '1';
                                        }else{
                                            $is_stylist_selection_page = '0';
                                        }
                                        $this->db->select('tbl_salon_employee.id,tbl_salon_employee.full_name,tbl_salon_employee.whatsapp_number as mobile_no,tbl_salon_employee.gender,tbl_salon_employee.dob,tbl_salon_employee.profile_photo,tbl_salon_employee.description,tbl_emp_designation.designation as designation_name');
                                        $this->db->join('tbl_emp_designation','tbl_emp_designation.id = tbl_salon_employee.designation');
                                        $this->db->where('tbl_emp_designation.designation', 'Stylist');
                                        $this->db->where('tbl_salon_employee.branch_id', $branch_id);
                                        $this->db->where('tbl_salon_employee.salon_id', $salon_id);
                                        $this->db->group_start();
                                        foreach ($selected_services_array as $service) {
                                            $this->db->or_where('find_in_set("' . $this->db->escape_str($service) . '", tbl_salon_employee.service_name) <> 0');
                                        }
                                        $this->db->group_end();
                                        $this->db->where('tbl_salon_employee.is_deleted','0');
                                        $this->db->where('tbl_salon_employee.status','1');
                                        $this->db->group_by('tbl_salon_employee.id');
                                        $this->db->order_by('tbl_salon_employee.id','desc');
                                        $result = $this->db->get('tbl_salon_employee')->result();
                                        if(!empty($result)){                                        
                                            // Get today's date
                                            $today_date = date('Y-m-d',strtotime($booking_date));
    
                                            // Initialize an array to store the sorted employees
                                            $sorted_employees = array();
    
                                            // Loop through each salon employee
                                            foreach ($result as $employee) {
                                                // Count the number of services for the stylist for today's date
                                                $this->db->where_in('service_status', ['0','1']);
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

                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = $sorted_employees;
                                            $json_arr['is_stylist_selection_page'] = $is_stylist_selection_page;
                                            $json_arr['profile_path'] = base_url('admin_assets/images/employee_profile/');
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Stylists not available';
                                            $json_arr['data'] = [];
                                            $json_arr['is_stylist_selection_page'] = '';
                                            $json_arr['profile_path'] = '';
                                        }
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Booking Slots not available, Please contact salon';
                                        $json_arr['data'] = [];
                                        $json_arr['is_stylist_selection_page'] = '';
                                        $json_arr['profile_path'] = '';
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Booking currently not available as salon is closed because of emergency, Please contact salon';
                                    $json_arr['data'] = [];
                                    $json_arr['is_stylist_selection_page'] = '';
                                    $json_arr['profile_path'] = '';
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Services list and booking date required';
                                $json_arr['data'] = [];
                                $json_arr['is_stylist_selection_page'] = '';
                                $json_arr['profile_path'] = '';
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                            $json_arr['is_stylist_selection_page'] = '';
                            $json_arr['profile_path'] = '';
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                        $json_arr['is_stylist_selection_page'] = '';
                        $json_arr['profile_path'] = '';
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                    $json_arr['is_stylist_selection_page'] = '';
                    $json_arr['profile_path'] = '';
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
                $json_arr['is_stylist_selection_page'] = '';
                $json_arr['profile_path'] = '';
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
            $json_arr['is_stylist_selection_page'] = '';
            $json_arr['profile_path'] = '';
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }

    public function reschedule_stylists(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();                      
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);  
                        if(!empty($rules)){ 
                            $booking_date = isset($request['booking_date']) ? $request['booking_date'] : '';  
                            $booking_id = isset($request['booking_id']) ? $request['booking_id'] : '';  
                            $reschedule_details = isset($request['reschedule_details']) ? $request['reschedule_details'] : [];
                            if(!empty($reschedule_details) && $booking_date != ""){
                                $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all($booking_date,$branch_id,$salon_id);
                                if(!$is_emergency){
                                    $working_hrs = $this->Salon_model->get_saloon_working_hrs_all($booking_date,$branch_id,$salon_id);
                                    if($working_hrs['is_allowed'] == 1){
                                        $rules_employee_selection = $rules->employee_selection;
                                        if($rules_employee_selection == '2'){
                                            $is_stylist_selection_page = '1';
                                        }else{
                                            $is_stylist_selection_page = '0';
                                        }
                                        $this->db->select('tbl_salon_employee.id,tbl_salon_employee.full_name,tbl_salon_employee.whatsapp_number as mobile_no,tbl_salon_employee.gender,tbl_salon_employee.dob,tbl_salon_employee.profile_photo,tbl_salon_employee.description,tbl_emp_designation.designation as designation_name');
                                        $this->db->join('tbl_emp_designation','tbl_emp_designation.id = tbl_salon_employee.designation');
                                        $this->db->where('tbl_emp_designation.designation', 'Stylist');
                                        $this->db->where('tbl_salon_employee.branch_id', $branch_id);
                                        $this->db->where('tbl_salon_employee.salon_id', $salon_id);
                                        $this->db->group_start();
                                        foreach ($reschedule_details as $service) {
                                            $this->db->or_where('find_in_set("' . $this->db->escape_str($service['service_id']) . '", tbl_salon_employee.service_name) <> 0');
                                        }
                                        $this->db->group_end();
                                        $this->db->where('tbl_salon_employee.is_deleted','0');
                                        $this->db->where('tbl_salon_employee.status','1');
                                        $this->db->group_by('tbl_salon_employee.id');
                                        $this->db->order_by('tbl_salon_employee.id','desc');
                                        $result = $this->db->get('tbl_salon_employee')->result();

                                        if(!empty($result)){                                      
                                            // Get today's date
                                            $today_date = date('Y-m-d',strtotime($booking_date));
    
                                            // Initialize an array to store the sorted employees
                                            $sorted_employees = array();
    
                                            // Loop through each salon employee
                                            foreach ($result as $employee) {
                                                // Count the number of services for the stylist for today's date
                                                $this->db->where_in('service_status', ['0','1']);
                                                if($booking_id != ""){
                                                    $this->db->where('booking_id !=', $booking_id);
                                                }
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

                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = $sorted_employees;
                                            $json_arr['is_stylist_selection_page'] = $is_stylist_selection_page;
                                            $json_arr['profile_path'] = base_url('admin_assets/images/employee_profile/');
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Stylists not available';
                                            $json_arr['data'] = [];
                                            $json_arr['is_stylist_selection_page'] = '';
                                            $json_arr['profile_path'] = '';
                                        }
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Booking Slots not available, Please contact salon';
                                        $json_arr['data'] = [];
                                        $json_arr['is_stylist_selection_page'] = '';
                                        $json_arr['profile_path'] = '';
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Booking currently not available as salon is closed because of emergency, Please contact salon';
                                    $json_arr['data'] = [];
                                    $json_arr['is_stylist_selection_page'] = '';
                                    $json_arr['profile_path'] = '';
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Reschedule Services list and booking date required';
                                $json_arr['data'] = [];
                                $json_arr['is_stylist_selection_page'] = '';
                                $json_arr['profile_path'] = '';
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                            $json_arr['is_stylist_selection_page'] = '';
                            $json_arr['profile_path'] = '';
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                        $json_arr['is_stylist_selection_page'] = '';
                        $json_arr['profile_path'] = '';
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                    $json_arr['is_stylist_selection_page'] = '';
                    $json_arr['profile_path'] = '';
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
                $json_arr['is_stylist_selection_page'] = '';
                $json_arr['profile_path'] = '';
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
            $json_arr['is_stylist_selection_page'] = '';
            $json_arr['profile_path'] = '';
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }

    public function get_booking_stylists_review(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();                      
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);  
                        if(!empty($rules)){ 
                            $stylist_id = isset($request['stylist_id']) ? $request['stylist_id'] : '';  
                            $selected_slot_from = isset($request['selected_slot_from']) ? $request['selected_slot_from'] : '';  
                            $selected_slot_to = isset($request['selected_slot_to']) ? $request['selected_slot_to'] : '';  
                            $booking_date = isset($request['booking_date']) ? $request['booking_date'] : '';  
                            $selected_services_array = isset($request['selected_services']) ? $request['selected_services'] : [];
                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$selected_slot_from));   
                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$selected_slot_to));   
                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));
                            $stylist_review_data = array();
                            if($stylist_id !=""){   //stylist selected from front
                                $salon_employee_list_result = $this->Salon_model->get_all_salon_stylists_datewise_all_stylist($selected_from_date,$branch_id,$salon_id,$stylist_id);
                                if(!empty($selected_services_array) && $booking_date != "" && $selected_slot_from != ""){
                                    for($i=0;$i<count($selected_services_array);$i++){
                                        $service = $selected_services_array[$i];
        
                                        $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi'); 
                                        $this->db->where('tbl_salon_emp_service.id',$service);
                                        $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                        $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                        $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                        $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                        $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                        if (!empty($salon_employee_list_result) && !empty($single_service)) {
                                            $service_from_datetime = new DateTime($selectedfrom);
                                            $service_to_datetime = new DateTime($selectedfrom);

                                            $service_duration = $single_service->service_duration;
                                            $interval = new DateInterval("PT{$service_duration}M");
                                            $service_to_datetime->add($interval);

                                            $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                            $selected_stylist_id = '';
                                            $short_break_flag = '0';
                                            $break_flag = '1';
                                            $shift_flag = '0';
                                            $store_flag = '0';
                                            $booking_flag = '1';
                                            $is_service_available = '0';

                                            $stylist_services = explode(',', $salon_employee_list_result->service_name);
                                            if (in_array($service, $stylist_services)) {
                                                $is_service_available = '1';
                                            }
                            
                                            $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                            if ($is_stylist_available_storewise) {
                                                $store_flag = '1';
                                            }
                            
                                            $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                            if ($is_emergency) {
                                                $is_emergency_flag = '1';
                                            } else {
                                                $is_emergency_flag = '0';
                                            }
                            
                                            $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                            if ($is_stylist_available_shiftwise['is_allowed']) {
                                                $shift_flag = '1';
                                            }
                            
                                            $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                            if ($is_stylist_available_breakwise) {
                                                $break_flag = '0';
                                            }
                            
                                            $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                            if ($is_stylist_available_short_breakwise) {
                                                $short_break_flag = '1';
                                            }
                            
                                            $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_bookingwise_all($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                            if ($is_stylist_available_bookingwise) {
                                                $booking_flag = '0';
                                            }
                            
                                            $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($salon_employee_list_result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                            
                                            if ($is_service_available == '1' && $store_flag == '1' && $is_emergency_flag == '0' && $leave_flag == '0' && $shift_flag == '1' && $booking_flag == '0' && $break_flag == '0' && $short_break_flag == '1') {
                                                $selected_stylist_id = $salon_employee_list_result->id;
                                            }
        
                                            if($selected_stylist_id != "" && !empty($single_service)){
                                                $stylist_review_data[] = array(
                                                    'service_id'                    =>  $service,
                                                    'service_name'                  =>  rtrim($single_service->service_name),
                                                    'service_marathi_name'          =>  rtrim($single_service->service_name_marathi),
                                                    'sup_category'                  =>  $single_service->sup_category,
                                                    'sup_category_marathi'          =>  $single_service->sup_category_marathi,
                                                    'sub_category'                  =>  $single_service->sub_category,
                                                    'sub_category_marathi'          =>  $single_service->sub_category_marathi, 
                                                    'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                    'service_to'                    =>  $service_to,
                                                    'service_duration'              =>  rtrim($service_duration),
                                                    'selected_stylist_id'           =>  $selected_stylist_id,
                                                    'selected_stylist_name'         =>  rtrim($salon_employee_list_result->full_name),                                                
                                                    'selected_stylist_shift_id'     =>  $is_stylist_available_shiftwise['shift_id'],
                                                    'selected_stylist_shift_type'   =>  $is_stylist_available_shiftwise['shift_type']
                                                );
                                            }

                                            $selectedfrom = $service_to;
                                        }
                                    }

                                    if(!empty($stylist_review_data)){
                                        $json_arr['status'] = 'true';
                                        $json_arr['message'] = 'success';
                                        $json_arr['data'] = $stylist_review_data;
                                    }else{
                                        $json_arr['status'] = 'false';
                                        $json_arr['message'] = 'Stylist reviews data not available';
                                        $json_arr['data'] = [];
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Services list, booking date and selected timeslot required';
                                    $json_arr['data'] = [];
                                }
                            }else{  //stylist selection from backend
                                $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                                $pre_selected = '';
                                $pre_selected_flag = false;
                                for($i=0;$i<count($selected_services_array);$i++){
                                    $service = $selected_services_array[$i];
 
                                    $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi'); 
                                    $this->db->where('tbl_salon_emp_service.id',$service);
                                    $this->db->where('tbl_salon_emp_service.id',$service);
                                    $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                    $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                    $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                    $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                    $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                    
                                    if (!empty($single_service)) {
                                        $selected_stylists = array();

                                        $service_from_datetime = new DateTime($selectedfrom);
                                        $service_to_datetime = new DateTime($selectedfrom);

                                        $service_duration = $single_service->service_duration;
                                        $interval = new DateInterval("PT{$service_duration}M");
                                        $service_to_datetime->add($interval);

                                        $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                        if (!empty($salon_employee_list)) {
                                            foreach ($salon_employee_list as $result) {
                                                $stylist_services = explode(',', $result->service_name);
                                                if (in_array($service, $stylist_services)) {
                                                    $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                    if ($is_stylist_available_storewise) {
                                                        $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                        if (!$is_emergency) {
                                                            $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_shiftwise['is_allowed']) {
                                                                $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_breakwise) {
                                                                    $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                    if ($is_stylist_available_short_breakwise) {
                                                                        $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_bookingwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        if ($is_stylist_available_bookingwise) {
                                                                            $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                            if($leave_flag == '0'){
                                                                                $is_selected = '0';
                                                                                if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                    $is_selected = '1';
                                                                                    $pre_selected = $result->id;
                                                                                    $pre_selected_flag = true;
                                                                                }

                                                                                if($is_selected == '1'){
                                                                                    $selected_stylists = array(
                                                                                        'stylist_id'            => $result->id,
                                                                                        'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                        'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                        'stylist_name'          => $result->full_name,
                                                                                        'stylist_designation'   => $result->designation_name,
                                                                                        'profile_photo'         => $result->profile_photo != "" ? base_url('admin_assets/images/employee_profile/' . $result->profile_photo) : '',
                                                                                    );;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }                                                
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        if(!empty($selected_stylists)){
                                            $stylist_review_data[] = array(
                                                'service_id'                    =>  $service,
                                                'service_name'                  =>  rtrim($single_service->service_name),
                                                'service_marathi_name'          =>  rtrim($single_service->service_name_marathi),
                                                'sup_category'                  =>  $single_service->sup_category,
                                                'sup_category_marathi'          =>  $single_service->sup_category_marathi,
                                                'sub_category'                  =>  $single_service->sub_category,
                                                'sub_category_marathi'          =>  $single_service->sub_category_marathi, 
                                                'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                'service_to'                    =>  $service_to,
                                                'service_duration'              =>  rtrim($service_duration),
                                                'selected_stylist_id'           =>  $selected_stylists['stylist_id'],
                                                'selected_stylist_name'         =>  rtrim($selected_stylists['stylist_name']),                                                
                                                'selected_stylist_shift_id'     =>  $selected_stylists['stylist_shift_id'],
                                                'selected_stylist_shift_type'   =>  $selected_stylists['stylist_shift_type']
                                            );
                                        }
                                        $selectedfrom = $service_to;
                                    }
                                }                                

                                if(!empty($stylist_review_data)){
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'success';
                                    $json_arr['data'] = $stylist_review_data;
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Stylist reviews data not available';
                                    $json_arr['data'] = [];
                                }
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    
    public function get_reschedule_stylists_review(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];   

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $customer = $this->db->get('tbl_salon_customer')->row();

                if(!empty($customer)){  
                    $this->db->where('tbl_branch.salon_id', $salon_id);
                    $this->db->where('tbl_branch.id', $branch_id);
                    $this->db->where('tbl_branch.is_deleted', '0');
                    $branch = $this->db->get('tbl_branch')->row();                      
                    if(!empty($branch)){
                        $rules = $this->Salon_model->get_booking_rules_all($branch_id,$salon_id);  
                        if(!empty($rules)){ 
                            $booking_id = isset($request['booking_id']) ? $request['booking_id'] : '';  
                            $stylist_id = isset($request['stylist_id']) ? $request['stylist_id'] : '';  
                            $selected_slot_from = isset($request['selected_slot_from']) ? $request['selected_slot_from'] : '';  
                            $selected_slot_to = isset($request['selected_slot_to']) ? $request['selected_slot_to'] : '';  
                            $booking_date = isset($request['booking_date']) ? $request['booking_date'] : '';  
                            $reschedule_details = isset($request['reschedule_details']) ? $request['reschedule_details'] : [];
                            $selectedfrom = date('Y-m-d H:i:s', strtotime($booking_date.' '.$selected_slot_from));   
                            $selectedto = date('Y-m-d H:i:s', strtotime($booking_date.' '.$selected_slot_to));   
                            $selected_from_date = date('Y-m-d', strtotime($selectedfrom));
                            $stylist_review_data = array();

                            $this->db->where('is_deleted','0');
                            $this->db->where('status','1');
                            $this->db->where('id',$booking_id);
                            $this->db->where('customer_name',$customer->id);
                            $this->db->where('branch_id', $branch_id);
                            $this->db->where('salon_id', $salon_id);
                            $single_booking = $this->db->get('tbl_new_booking')->row();
                            if(!empty($single_booking)){
                                for($i=0;$i<count($reschedule_details);$i++){
                                    $this->db->where('is_deleted','0');
                                    $this->db->where('id',$reschedule_details[$i]['booking_details_id']);
                                    $this->db->where('service_id',$reschedule_details[$i]['service_id']);
                                    $this->db->where('booking_id',$single_booking->id);
                                    $this->db->where('customer_name',$customer->id);
                                    $this->db->where('branch_id', $branch_id);
                                    $this->db->where('salon_id', $salon_id);
                                    $single_booking_services = $this->db->get('tbl_booking_services_details')->row();
                                    if(!empty($single_booking_services)){   
                                        $selected_services[] = $single_booking_services->service_id;
                                        $selected_service_details[] = $single_booking_services->id;
                                    }
                                }
                                if(!empty($reschedule_details) && $booking_date != "" && $selected_slot_from != "" && $booking_id != ""){
                                    if($stylist_id != ""){  //stylist selected from front
                                        $salon_employee_list_result = $this->Salon_model->get_all_salon_stylists_datewise_all_stylist($selected_from_date,$branch_id,$salon_id,$stylist_id);
                                        
                                        $pre_selected = '';
                                        $pre_selected_flag = false;
                                        for($i=0;$i<count($selected_services);$i++){
                                            $service = $selected_services[$i];
                                            $service_details = $selected_service_details[$i];
            
                                            $this->db->where('id',$service);
                                            $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                            if (!empty($salon_employee_list_result) && !empty($single_service)) {
                                                $service_from_datetime = new DateTime($selectedfrom);
                                                $service_to_datetime = new DateTime($selectedfrom);

                                                $service_duration = $single_service->service_duration;
                                                $interval = new DateInterval("PT{$service_duration}M");
                                                $service_to_datetime->add($interval);

                                                $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                                $stylist_services = explode(',', $salon_employee_list_result->service_name);
                                                $selected_stylists = [];
                                                if (in_array($service, $stylist_services)) {
                                                    $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                    if ($is_stylist_available_storewise) {
                                                        $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                        if (!$is_emergency) {
                                                            $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_shiftwise['is_allowed']) {
                                                                $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                if ($is_stylist_available_breakwise) {
                                                                    $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                    if ($is_stylist_available_short_breakwise) {
                                                                        $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_resch_bookingwise_all($service_details, $salon_employee_list_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        if ($is_stylist_available_bookingwise) {
                                                                            $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($salon_employee_list_result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                            if($leave_flag == '0'){
                                                                                $is_selected = '0';
                                                                                if (!$pre_selected_flag || $salon_employee_list_result->id == $pre_selected) {
                                                                                    $is_selected = '1';
                                                                                    $pre_selected = $salon_employee_list_result->id;
                                                                                    $pre_selected_flag = true;
                                                                                }                                                                                  

                                                                                $single_service_emp = array(
                                                                                    'stylist_id'            => $salon_employee_list_result->id,
                                                                                    'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                    'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                    'stylist_name'          => $salon_employee_list_result->full_name,
                                                                                );

                                                                                if($is_selected == '1'){
                                                                                    $selected_stylists = $single_service_emp;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }                                                
                                                        }
                                                    }
                                                }

                                                if(!empty($selected_stylists)){
                                                    $stylist_review_data[] = array(
                                                        'service_id'                    =>  $service,
                                                        'booking_details_id'            =>  $service_details,
                                                        'service_name'                  =>  rtrim($single_service->service_name),
                                                        'service_marathi_name'          =>  rtrim($single_service->service_name_marathi),
                                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                        'service_to'                    =>  $service_to,
                                                        'service_duration'              =>  rtrim($service_duration),
                                                        'selected_stylist_id'           =>  $selected_stylists['stylist_id'],
                                                        'selected_stylist_name'         =>  rtrim($selected_stylists['stylist_name']),                                                
                                                        'selected_stylist_shift_id'     =>  $selected_stylists['stylist_shift_id'],
                                                        'selected_stylist_shift_type'   =>  $selected_stylists['stylist_shift_type']
                                                    );
                                                }

                                                $selectedfrom = $service_to; 
                                            }
                                        }

                                        if(!empty($stylist_review_data)){
                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = $stylist_review_data;
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Stylist reviews data not available';
                                            $json_arr['data'] = [];
                                        }
                                    }else{  //selecte stylist from backend 
                                        $salon_employee_list = $this->Salon_model->get_all_salon_stylists_datewise_all($selected_from_date,$branch_id,$salon_id);

                                        $pre_selected = '';
                                        $pre_selected_flag = false;
                                        for($i=0;$i<count($selected_services);$i++){
                                            $service = $selected_services[$i];
                                            $service_details = $selected_service_details[$i];

                                            $this->db->where('id',$service);
                                            $this->db->where('salon_id', $salon_id);
                                            $this->db->where('branch_id', $branch_id);
                                            $single_service = $this->db->get('tbl_salon_emp_service')->row();
                                            if (!empty($single_service)) {
                                                $single_selected_stylist = array();

                                                $service_from_datetime = new DateTime($selectedfrom);
                                                $service_to_datetime = new DateTime($selectedfrom);

                                                $service_duration = $single_service->service_duration;
                                                $interval = new DateInterval("PT{$service_duration}M");
                                                $service_to_datetime->add($interval);

                                                $service_to = $service_to_datetime->format('Y-m-d H:i:s');

                                                if (!empty($salon_employee_list)) {
                                                    foreach ($salon_employee_list as $result) {
                                                        $stylist_services = explode(',', $result->service_name);
                                                        if (in_array($service, $stylist_services)) {
                                                            $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_storewise) {
                                                                $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                if (!$is_emergency) {
                                                                    $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                    if ($is_stylist_available_shiftwise['is_allowed']) {
                                                                        $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                        if ($is_stylist_available_breakwise) {
                                                                            $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                            if ($is_stylist_available_short_breakwise) {
                                                                                $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_resch_bookingwise_all($service_details, $result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                                                if ($is_stylist_available_bookingwise) {
                                                                                    $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                                    if($leave_flag == '0'){
                                                                                        $is_selected = '0';
                                                                                        if (!$pre_selected_flag || $result->id == $pre_selected) {
                                                                                            $is_selected = '1';
                                                                                            $pre_selected = $result->id;
                                                                                            $pre_selected_flag = true;
                                                                                        }

                                                                                        if($is_selected == '1'){
                                                                                            $single_selected_stylist = array(
                                                                                                'stylist_id'            => $result->id,
                                                                                                'stylist_shift_id'      => $is_stylist_available_shiftwise['shift_id'],
                                                                                                'stylist_shift_type'    => $is_stylist_available_shiftwise['shift_type'],
                                                                                                'stylist_name'          => $result->full_name,
                                                                                            );
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }                                                
                                                                }
                                                            }
                                                        }
                                                    }
                                                }

                                                if(!empty($single_selected_stylist)){
                                                    $stylist_review_data[] = array(                                                    
                                                        'service_id'                    =>  $service,
                                                        'booking_details_id'            =>  $service_details,
                                                        'service_name'                  =>  rtrim($single_service->service_name),
                                                        'service_marathi_name'          =>  rtrim($single_service->service_name_marathi),
                                                        'service_from'                  =>  $service_from_datetime->format('Y-m-d H:i:s'),
                                                        'service_to'                    =>  $service_to,
                                                        'service_duration'              =>  rtrim($service_duration),
                                                        'selected_stylist_id'           =>  $single_selected_stylist['stylist_id'],
                                                        'selected_stylist_name'         =>  rtrim($single_selected_stylist['stylist_name']),                                                
                                                        'selected_stylist_shift_id'     =>  $single_selected_stylist['stylist_shift_id'],
                                                        'selected_stylist_shift_type'   =>  $single_selected_stylist['stylist_shift_type']
                                                    );
                                                }

                                                $selectedfrom = $service_to;
                                            }
                                        }

                                        if(!empty($stylist_review_data)){
                                            $json_arr['status'] = 'true';
                                            $json_arr['message'] = 'success';
                                            $json_arr['data'] = $stylist_review_data;
                                        }else{
                                            $json_arr['status'] = 'false';
                                            $json_arr['message'] = 'Stylist reviews data not available';
                                            $json_arr['data'] = [];
                                        }
                                    }
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'Booking ID, Reschedule Services list, booking date and selected timeslot required';
                                    $json_arr['data'] = [];
                                }
                            }else{
                                $json_arr['status'] = 'false';
                                $json_arr['message'] = 'Booking details not found';
                                $json_arr['data'] = [];
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Booking not available now, Please contact salon';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Branch not available';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    
    public function api_get_salon_rules(){
        $request = json_decode(file_get_contents('php://input'), true);
        
        $salon_id = $request['salon_id'];
        $branch_id = $request['branch_id'];   
        
        $this->db->select('tbl_booking_rules.*,tbl_salon_type.type as salon_type_title');
        $this->db->join('tbl_salon_type','tbl_salon_type.id = tbl_booking_rules.salon_type');
        $this->db->where('tbl_booking_rules.salon_id', $salon_id);
        $this->db->where('tbl_booking_rules.branch_id', $branch_id);
        $this->db->where('tbl_booking_rules.is_deleted', '0');
        $result = $this->db->get('tbl_booking_rules')->row();
        if(!empty($result)){
            $json_arr['status'] = 'true';
            $json_arr['message'] = 'success';
            $json_arr['data'] = $result;
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Data not found';
            $json_arr['data'] = []; 
        }
        echo json_encode($json_arr);
    }
    public function customer_booking_reminder(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){                         
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id']; 

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();
                if(!empty($single)){ 
                    $reminder_minutes = isset($request['reminder_minutes']) ? $request['reminder_minutes'] : '';
                    $message = 'Booking Reminder fetched successfully';
                    if($reminder_minutes != ""){
                        $this->db->where('id',$single->id);
                        $this->db->where('branch_id', $branch_id);
                        $this->db->where('salon_id', $salon_id);
                        $this->db->update('tbl_salon_customer',array('reminder_minutes'=>$reminder_minutes));
                        $message = 'Booking Reminder set successfully';
                    }
                    
                    $this->db->select('id as customer_id,reminder_minutes');
                    $this->db->where('id',$single->id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $single = $this->db->get('tbl_salon_customer')->row();
                    
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = $message;
                    $json_arr['data'] = $single;
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }                  
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
    
    public function set_trying_for_booking() {
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){                         
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id']; 

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();
                if(!empty($single)){ 
                    $temp_booking_id = isset($request['temp_booking_id']) ? $request['temp_booking_id'] : null;
                    $step = $request['step'];
                    $services = isset($request['services']) ? $request['services'] : [];
                    $stylist_id = isset($request['stylist_id']) ? $request['stylist_id'] : null;
                    $slot_from = isset($request['slot_from']) ? $request['slot_from'] : null;
                    $booking_date = isset($request['booking_date']) ? $request['booking_date'] : null;

                    $booking_date = $booking_date != "" ? date('Y-m-d',strtotime($booking_date)) : null;
                    $slot_from = $slot_from != "" ? date('H:i:s',strtotime($slot_from)) : null;
                    $slot = null;
                    if($slot_from != ""){
                        list($year, $month, $day) = explode('-', $booking_date);
                        list($hour, $minute, $second) = explode(':', $slot_from);
                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                        $slot = date('Y-m-d H:i:s', $timestamp);  
                    }

                    $this->db->where('customer_id', $customer_id);
                    $this->db->where('id', $temp_booking_id);
                    $this->db->where('branch_id', $branch_id);
                    $this->db->where('salon_id', $salon_id);
                    $this->db->where('is_deleted', '0');
                    $existing = $this->db->get('tbl_trying_for_booking')->row();
                
                    if (empty($existing)) {          
                        $insert_data = array(
                            'customer_id'   => $customer_id,
                            'salon_id'      => $salon_id,
                            'branch_id'     => $branch_id,
                            'booking_date'  => $booking_date,
                            'services'      => !empty($services) ? implode(',',$services) : null,
                            'stylist_id'    => $stylist_id,
                            'slot'          => $slot,
                            'step'          => $step,
                            'booking_status'=> '0',
                            'created_on'    => date('Y-m-d H:i:s'),
                            'updated_on'    => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tbl_trying_for_booking', $insert_data);
                        $temp_booking_id = $this->db->insert_id();
                    }else{
                        $insert_data = array(
                            'booking_date'  => $booking_date,
                            'services'      => !empty($services) ? implode(',',$services) : null,
                            'stylist_id'    => $stylist_id,
                            'slot'          => $slot,
                            'step'          => $step,
                            'booking_status'=> '0',
                            'updated_on'    => date('Y-m-d H:i:s')
                        );
                        $this->db->where('id', $existing->id);
                        $this->db->update('tbl_trying_for_booking', $insert_data);
                        $temp_booking_id = $existing->id;
                    }
                    
                    if($step == "2"){
                        $uid = $branch_id.'@@@'.$salon_id;
                        $type = 'sender';
                        $project = 'salon';
                        $message = $single->full_name . ' (' . $single->customer_phone . ') customer is trying for booking from Napito Mobile App.';
                        $data = json_encode([
                            'message_type'  => 'trying_for_booking',
                            'branch_id'     => $branch_id,
                            'salon_id'      => $salon_id,
                            'project'       => $project,
                            'uid'           => $uid,
                            'message'       => $message,
                            'customer_id'   => $single->id
                        ]);
                        $this->Salon_model->send_data_to_socket_client('app',$uid,$type,$project,$message,$data);
                    }

                    $json_arr['status'] = 'true';
                    $json_arr['message'] = 'Success';
                    $json_arr['data'] = array(
                        'temp_booking_id'    =>  $temp_booking_id
                    );
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }                  
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }

        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    } 

    public function reserve_timeslot() {
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){                         
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id']; 

                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();
                if(!empty($single)){ 
                    $setup = $this->Master_model->get_backend_setups();	
                    $reserve_mins = !empty($setup) && $setup->reserve_slot_mins != "" ? (int)$setup->reserve_slot_mins : 3;
                    $reservation_id = isset($request['reservation_id']) ? $request['reservation_id'] : '';
                    $stylist_id = $request['stylist_id'];
                    $slot_from = $request['slot_from'];
                    $slot_to = $request['slot_to'];
                    $booking_date = $request['booking_date'];
                    if($slot_to != "" && $slot_from != "" && $stylist_id != "" && $booking_date != ""){    
                        $booking_date = date('Y-m-d',strtotime($booking_date));

                        $slot_from = date('H:i:s',strtotime($slot_from));
                        list($year, $month, $day) = explode('-', $booking_date);
                        list($hour, $minute, $second) = explode(':', $slot_from);
                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                        $from_slot = date('Y-m-d H:i:s', $timestamp);  
                        
                        $slot_to = date('H:i:s',strtotime($slot_to));
                        list($year, $month, $day) = explode('-', $booking_date);
                        list($hour, $minute, $second) = explode(':', $slot_to);
                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                        $to_slot = date('Y-m-d H:i:s', $timestamp);  
 
                        if($from_slot != "" && $from_slot != "1970-01-01 05:30:00" && $from_slot != "0000-00-00 00:00:00" && $to_slot != "" && $to_slot != "1970-01-01 05:30:00" && $to_slot != "0000-00-00 00:00:00"){
                            $reserved_on = date('Y-m-d H:i:s');
                            $expire_on = date('Y-m-d H:i:s', strtotime('+' . $reserve_mins . ' minutes'));  
                                      
                            $this->db->where('id', $reservation_id);
                            $this->db->where('customer_id', $customer_id);
                            $this->db->where('branch_id', $branch_id);
                            $this->db->where('salon_id', $salon_id);
                            $this->db->where('status', '0');
                            $existing = $this->db->get('tbl_stylist_slot_reservations')->row();                      
                            if (empty($existing)) {               
                                $this->db->where('slot_from <', $to_slot);
                                $this->db->where('slot_to >', $from_slot);
                                $this->db->where('stylist_id', $stylist_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $this->db->where('status', '0');
                                $this->db->where('expire_on >', date('Y-m-d H:i:s'));
                                $already_reserved = $this->db->get('tbl_stylist_slot_reservations')->row(); 
                                if(empty($already_reserved)){
                                    $insert_data = array(
                                        'salon_id'      => $salon_id,
                                        'branch_id'     => $branch_id,
                                        'stylist_id'    => $stylist_id,
                                        'slot_from'     => $from_slot,
                                        'slot_to'       => $to_slot,
                                        'customer_id'   => $customer_id,
                                        'status'        => '0',
                                        'expire_on'     => $expire_on,
                                        'reserved_on'   => $reserved_on
                                    );
                                    $this->db->insert('tbl_stylist_slot_reservations', $insert_data);
                                    $reservation_id = $this->db->insert_id();
                                
                                    $json_arr['status'] = 'true';
                                    $json_arr['message'] = 'Slot Reserved';
                                    $json_arr['data'] = array(
                                        'reservation_id'    =>  $reservation_id,
                                        'slot_from'         =>  $slot_from,
                                        'slot_to'           =>  $slot_to,
                                        'reserved_on'       =>  $reserved_on,
                                        'expire_on'         =>  $expire_on
                                    );
                                }else{
                                    $json_arr['status'] = 'false';
                                    $json_arr['message'] = 'This slot is already reserved';
                                    $json_arr['data'] = [];
                                }
                            }else{     
                                $update_data = array(
                                    'stylist_id'    => $stylist_id,
                                    'slot_from'     => $from_slot,
                                    'slot_to'       => $to_slot,
                                    'status'        => '0',
                                    'expire_on'     => $expire_on,
                                    'reserved_on'   => $reserved_on
                                );
                                $this->db->where('id', $reservation_id);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('salon_id', $salon_id);
                                $this->db->update('tbl_stylist_slot_reservations', $update_data);
                                $reservation_id = $this->db->insert_id();
                            
                                $json_arr['status'] = 'true';
                                $json_arr['message'] = 'Slot Reserved';
                                $json_arr['data'] = array(
                                    'reservation_id'    =>  $reservation_id,
                                    'slot_from'         =>  $slot_from,
                                    'slot_to'           =>  $slot_to,
                                    'reserved_on'       =>  $reserved_on,
                                    'expire_on'         =>  $expire_on
                                );
                            }
                        }else{
                            $json_arr['status'] = 'false';
                            $json_arr['message'] = 'Invalid Slot and Booking Date values';
                            $json_arr['data'] = [];
                        }
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Slot, Booking Date and Stylist values required';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }                  
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }

        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }    

    
    public function calculate_discounts(){
        $request = json_decode(file_get_contents('php://input'), true);
        if($request){
            if($request['branch_id']){
                $customer_id = $request['customer_id'];
                $salon_id = $request['salon_id'];
                $branch_id = $request['branch_id'];                   
                
                $this->db->where('is_deleted','0');
                $this->db->where('status','1');
                $this->db->where('id',$customer_id);
                $this->db->where('branch_id', $branch_id);
                $this->db->where('salon_id', $salon_id);
                $single = $this->db->get('tbl_salon_customer')->row();

                if(!empty($single)){  
			        $services = isset($request['selected_services']) ? $request['selected_services'] : [];
                    if(!empty($services)){ 
                        $services_data = [];
                        foreach($services as $service){
                            $this->db->where('id',$service['id']);
                            $this->db->where('branch_id',$branch_id);
                            $this->db->where('salon_id',$salon_id);
                            $this->db->where('is_deleted','0');
                            $service_details = $this->db->get('tbl_salon_emp_service')->row();
                            if (!empty($service_details)) {
                                $services_data[] = array(
                                    'id'            =>  $service_details->id,
                                    'price'         =>  $service_details->final_price != "" ? (float)$service_details->final_price : 0.00,
                                    'added_from'    =>  $service['added_from']
                                );
                                if($service['added_from'] == '0'){
                                    $service_ids[] = $service_details->id;
                                }
                            }
                        }

			            $products = isset($request['selected_products']) ? $request['selected_products'] : [];
                        $products_data = [];
                        if(!empty($products)){
                            foreach($products as $product){
                                $this->db->where('id',$product['id']);
                                $this->db->where('branch_id',$branch_id);
                                $this->db->where('salon_id',$salon_id);
                                $this->db->where('is_deleted','0');
                                $product_details = $this->db->get('tbl_product')->row();
                                if (!empty($product_details)) {
                                    $products_data[] = array(
                                        'id'            =>  $product_details->id,
                                        'price'         =>  $product_details->selling_price != "" ? (float)$product_details->selling_price : 0.00,
                                        'added_from'    =>  $product['added_from']
                                    );
                                    if($product['added_from'] == '0'){
                                        $product_ids[] = $product_details->id;
                                    }
                                }
                            }
                        }

			            $is_offer_applied = isset($request['is_offer_applied']) ? $request['is_offer_applied'] : '0';
			            $applied_offer_id = $is_offer_applied == '1' && isset($request['applied_offer_id']) ? $request['applied_offer_id'] : null;
                        
			            $is_coupon_applied = isset($request['is_coupon_applied']) ? $request['is_coupon_applied'] : '0';
			            $applied_coupon_id = $is_coupon_applied == '1' && isset($request['applied_coupon_id']) ? $request['applied_coupon_id'] : null;
                        
			            $is_giftcard_applied = isset($request['is_giftcard_applied']) ? $request['is_giftcard_applied'] : '0';
			            $applied_giftcard_no = $is_giftcard_applied == '1' && isset($request['applied_giftcard_no']) ? $request['applied_giftcard_no'] : null;
                        
			            $is_user_rewards_applied = isset($request['is_rewards_applied']) ? $request['is_rewards_applied'] : '0';

                        $json_arr['status'] = 'true';
                        $json_arr['message'] = 'success';
                        $json_arr['data'] = $this->Common_model->calculate_discounts($customer_id, $service_ids, $services_data, $product_ids, $products_data, $branch_id, $salon_id, $applied_offer_id, $applied_coupon_id, $applied_giftcard_no, $is_user_rewards_applied);
                    }else{
                        $json_arr['status'] = 'false';
                        $json_arr['message'] = 'Services not selected';
                        $json_arr['data'] = [];
                    }
                }else{
                    $json_arr['status'] = 'false';
                    $json_arr['message'] = 'Customer not found';
                    $json_arr['data'] = [];
                }          
            }else{
                $json_arr['status'] = 'false';
                $json_arr['message'] = 'Branch ID not available.';
                $json_arr['data'] = [];
            }
        }else{
            $json_arr['status'] = 'false';
            $json_arr['message'] = 'Request not found.';
            $json_arr['data'] = [];
        }
        echo json_encode($json_arr, JSON_UNESCAPED_UNICODE);
    }
}    
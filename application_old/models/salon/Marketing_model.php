<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marketing_model extends CI_Model {     
    public function get_marketing_data_ajx_list($length, $start, $search) {
        $customer_report_type = $this->input->post('customer_report_type');
        if($customer_report_type == '1'){
            //today
            $from = date('Y-m-d'); 
            $to = date('Y-m-d');   
        }elseif($customer_report_type == '2'){
            //Yesterday
            $from = date('Y-m-d', strtotime('-1 day'));
            $to = $from;
        }elseif($customer_report_type == '3'){
            //This week
            $from = date('Y-m-d', strtotime('monday this week'));
            $to = date('Y-m-d');
        }elseif($customer_report_type == '4'){
            //This month
            $from = date('Y-m-01');
            $to = date('Y-m-d');
        }elseif($customer_report_type == '5'){
            //Last month
            $from = date('Y-m-d', strtotime('first day of previous month'));
            $to = date('Y-m-d', strtotime('last day of previous month'));
        }elseif($customer_report_type == '6'){
            //Custom
            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
        }else{
            $from = '';
            $to = '';
        }

        $this->db->select('tbl_messages_history.*,tbl_salon_customer.dob, tbl_salon_customer.doa,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_trying_for_booking.booking_status as trying_booking_status, tbl_trying_for_booking.booking_id as trying_booking_confirm_id');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_messages_history.send_customer');
        $this->db->join('tbl_trying_for_booking','tbl_trying_for_booking.id = tbl_messages_history.trying_for_booking_id', 'left');
        $this->db->where('tbl_messages_history.is_deleted', '0');
        $this->db->where('tbl_messages_history.type', $this->input->post('marketing_type'));
        $this->db->where('tbl_messages_history.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_messages_history.salon_id', $this->session->userdata('salon_id')); 
        if($from != "" && $to != ""){       
            $this->db->where('DATE(tbl_messages_history.created_on) >=',date('Y-m-d',strtotime($from)));
            $this->db->where('DATE(tbl_messages_history.created_on) <=', date('Y-m-d',strtotime($to)));
        }
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_messages_history.created_on', $search);
            $this->db->or_like('tbl_messages_history.content', $search);
            $this->db->or_like('tbl_salon_customer.full_name', $search);
            $this->db->or_like('tbl_salon_customer.customer_phone', $search);
            $this->db->or_like('tbl_salon_customer.email', $search);
            $this->db->or_like('tbl_salon_customer.dob', $search);
            $this->db->group_end();
        }
        
        $this->db->limit($length, $start);
        $this->db->order_by('tbl_messages_history.created_on', 'DESC');
        $result = $this->db->get('tbl_messages_history');
        return $result->result();
    } 
    
    public function get_marketing_data_ajx_count($search){
        $customer_report_type = $this->input->post('customer_report_type');
        if($customer_report_type == '1'){
            //today
            $from = date('Y-m-d'); 
            $to = date('Y-m-d');   
        }elseif($customer_report_type == '2'){
            //Yesterday
            $from = date('Y-m-d', strtotime('-1 day'));
            $to = $from;
        }elseif($customer_report_type == '3'){
            //This week
            $from = date('Y-m-d', strtotime('monday this week'));
            $to = date('Y-m-d');
        }elseif($customer_report_type == '4'){
            //This month
            $from = date('Y-m-01');
            $to = date('Y-m-d');
        }elseif($customer_report_type == '5'){
            //Last month
            $from = date('Y-m-d', strtotime('first day of previous month'));
            $to = date('Y-m-d', strtotime('last day of previous month'));
        }elseif($customer_report_type == '6'){
            //Custom
            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
        }else{
            $from = '';
            $to = '';
        }

        $this->db->select('tbl_messages_history.*,tbl_salon_customer.dob, tbl_salon_customer.doa,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_trying_for_booking.booking_status as trying_booking_status');
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_messages_history.send_customer');
        $this->db->join('tbl_trying_for_booking','tbl_trying_for_booking.id = tbl_messages_history.trying_for_booking_id', 'left');
        $this->db->where('tbl_messages_history.is_deleted', '0');
        $this->db->where('tbl_messages_history.type', $this->input->post('marketing_type'));
        $this->db->where('tbl_messages_history.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_messages_history.salon_id', $this->session->userdata('salon_id')); 
        if($from != "" && $to != ""){       
            $this->db->where('DATE(tbl_messages_history.created_on) >=',date('Y-m-d',strtotime($from)));
            $this->db->where('DATE(tbl_messages_history.created_on) <=', date('Y-m-d',strtotime($to)));
        }
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_messages_history.created_on', $search);
            $this->db->or_like('tbl_messages_history.content', $search);
            $this->db->or_like('tbl_salon_customer.full_name', $search);
            $this->db->or_like('tbl_salon_customer.customer_phone', $search);
            $this->db->or_like('tbl_salon_customer.email', $search);
            $this->db->or_like('tbl_salon_customer.dob', $search);
            $this->db->group_end();
        }

        $this->db->order_by('tbl_messages_history.id', 'DESC');
		$result = $this->db->get('tbl_messages_history');
		return $result->num_rows();
	}
     public function get_socket_logs_data_ajx($length, $start, $search) {
        $customer_report_type = $this->input->post('customer_report_type');
        if($customer_report_type == '1'){
            //today
            $from = date('Y-m-d'); 
            $to = date('Y-m-d');   
        }elseif($customer_report_type == '2'){
            //Yesterday
            $from = date('Y-m-d', strtotime('-1 day'));
            $to = $from;
        }elseif($customer_report_type == '3'){
            //This week
            $from = date('Y-m-d', strtotime('monday this week'));
            $to = date('Y-m-d');
        }elseif($customer_report_type == '4'){
            //This month
            $from = date('Y-m-01');
            $to = date('Y-m-d');
        }elseif($customer_report_type == '5'){
            //Last month
            $from = date('Y-m-d', strtotime('first day of previous month'));
            $to = date('Y-m-d', strtotime('last day of previous month'));
        }elseif($customer_report_type == '6'){
            //Custom
            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
        }else{
            $from = '';
            $to = '';
        }

        $this->db->select('tbl_salon_socket_notification.*');
        $this->db->where('tbl_salon_socket_notification.is_deleted', '0');
        $this->db->where('tbl_salon_socket_notification.uid', $this->session->userdata('branch_id') . '@@@' . $this->session->userdata('salon_id'));
        if($from != "" && $to != ""){       
            $this->db->where('DATE(tbl_salon_socket_notification.created_on) >=',date('Y-m-d',strtotime($from)));
            $this->db->where('DATE(tbl_salon_socket_notification.created_on) <=', date('Y-m-d',strtotime($to)));
        }
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_salon_socket_notification.created_on', $search);
            $this->db->or_like('tbl_salon_socket_notification.message', $search);
            $this->db->or_like('tbl_salon_socket_notification.data', $search);
            $this->db->group_end();
        }
        
        $this->db->limit($length, $start);
        $this->db->order_by('tbl_salon_socket_notification.created_on', 'DESC');
        $result = $this->db->get('tbl_salon_socket_notification');
        return $result->result();
    } 
    
    public function get_socket_logs_data_ajx_count($search){
        $customer_report_type = $this->input->post('customer_report_type');
        if($customer_report_type == '1'){
            //today
            $from = date('Y-m-d'); 
            $to = date('Y-m-d');   
        }elseif($customer_report_type == '2'){
            //Yesterday
            $from = date('Y-m-d', strtotime('-1 day'));
            $to = $from;
        }elseif($customer_report_type == '3'){
            //This week
            $from = date('Y-m-d', strtotime('monday this week'));
            $to = date('Y-m-d');
        }elseif($customer_report_type == '4'){
            //This month
            $from = date('Y-m-01');
            $to = date('Y-m-d');
        }elseif($customer_report_type == '5'){
            //Last month
            $from = date('Y-m-d', strtotime('first day of previous month'));
            $to = date('Y-m-d', strtotime('last day of previous month'));
        }elseif($customer_report_type == '6'){
            //Custom
            $from = $this->input->post('from_date');
            $to = $this->input->post('to_date');
        }else{
            $from = '';
            $to = '';
        }

        $this->db->select('tbl_salon_socket_notification.*');
        $this->db->where('tbl_salon_socket_notification.is_deleted', '0');
        $this->db->where('tbl_salon_socket_notification.uid', $this->session->userdata('branch_id') . '@@@' . $this->session->userdata('salon_id'));
        if($from != "" && $to != ""){       
            $this->db->where('DATE(tbl_salon_socket_notification.created_on) >=',date('Y-m-d',strtotime($from)));
            $this->db->where('DATE(tbl_salon_socket_notification.created_on) <=', date('Y-m-d',strtotime($to)));
        }
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_salon_socket_notification.created_on', $search);
            $this->db->or_like('tbl_salon_socket_notification.message', $search);
            $this->db->or_like('tbl_salon_socket_notification.data', $search);
            $this->db->group_end();
        }
        
        $this->db->order_by('tbl_salon_socket_notification.created_on', 'DESC');
        $result = $this->db->get('tbl_salon_socket_notification');
        return $result->num_rows();
	}
    
    public function send_birthday_wish(){
        $this->db->select('tbl_salon_customer.*,tbl_branch.subscription_id');
        $this->db->join('tbl_branch','tbl_salon_customer.branch_id = tbl_branch.id');
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->where('tbl_salon_customer.status','1');
        $this->db->where('tbl_salon_customer.is_guest', '0');
        $this->db->where('MONTH(tbl_salon_customer.dob)', date('m'));
        $this->db->where('DAY(tbl_salon_customer.dob)', date('d'));
        $result = $this->db->get('tbl_salon_customer')->result();

        if(!empty($result)){
            foreach($result as $data){
                $feature_slugs = $this->Salon_model->get_subscription_slugs($data->subscription_id);
                if(!empty(array_intersect(['birthday_marketing'], $feature_slugs)) && $data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;

                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$data->branch_id);
                    $this->db->where('salon_id',$data->salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    $visit_text = '';
                    if(!empty($branch)){
                        if($branch->branch_name != ""){
                            $visit_text .= $branch->branch_name;
                        }
                    }

				    $birthday_offer = $this->Salon_model->get_single_for_birthday();
                    $discount_text = '';
                    if(!empty($birthday_offer)){
                        if($birthday_offer->discount_status == '1'){                                    
                            $max_flexible = $birthday_offer->flexible_max;
                            $min_flexible = $birthday_offer->flexible_min;
                            if($birthday_offer->discount_type == '1'){    //Flexible
                                $customer_last_service_booking = $this->Salon_model->get_customer_last_any_service_booking($result->id);
                                if(!empty($customer_last_service_booking)){  
                                    $prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;

                                    if($prev_Applied_slab != ""){
                                        $next_slab = $prev_Applied_slab + '5';
                                    }else{
                                        $next_slab = $min_flexible + '5';
                                    }

                                    if($next_slab > $max_flexible){
                                        $slab_consider = $min_flexible;
                                    }else{
                                        $slab_consider = $next_slab;
                                    }
                                }else{
                                    $slab_consider = $min_flexible;
                                }

                                if($birthday_offer->discount_in == '0'){  //percentage
                                    $discount_text = $slab_consider . '% Off';
                                }elseif($birthday_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
                                }
                            }else{   //Fixed
                                if($birthday_offer->discount_in == '0'){  //percentage
                                    $discount_text = $birthday_offer->discount_amount . '% Off';
                                }elseif($birthday_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $birthday_offer->discount_amount . ' Off';
                                }
                            }
                        }
                    }

                    $message = "Hi " . $data->full_name . ", It’s time to celebrate you! 🎉 Enjoy a special Discount Offer " . $discount_text . " as our birthday treat, valid during your birthday week. Book your appointment now and celebrate in style! Warm wishes, " . $visit_text . ".";
                    $app_message = "Hi " . $data->full_name . ", It’s time to celebrate you! 🎉\n\nEnjoy a special Discount Offer " . $discount_text . " as our birthday treat, valid during your birthday week.\n\nBook your appointment now and celebrate in style!\n\nWarm wishes,\n" . $visit_text . ".";
                    
                    $type = '1';
                    $number = $finalNumber;
                    $customer = $data->id;
                    $salon_id = $data->salon_id;
                    $branch_id = $data->branch_id;
                    $for_order_id = '';
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Birthday Celebrations';
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => '',
                        "redirect_id"   => ''
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
                    $wp_template_data = [
                        'template_name' =>  'birthdayoffer',
                        'pay_load_components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [ 'type' => 'text', 'text' => $data->full_name ],
                                    [ 'type' => 'text', 'text' => $discount_text ],
                                    [ 'type' => 'text', 'text' => $visit_text ]
                                ]
                            ]
                        ]
                    ];
        
                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'No Birthday Today'));
        }
    }
    
    public function send_anniversary_wish(){
        $this->db->select('tbl_salon_customer.*,tbl_branch.subscription_id');
        $this->db->join('tbl_branch','tbl_salon_customer.branch_id = tbl_branch.id');
        $this->db->where('tbl_salon_customer.is_deleted','0');
        $this->db->where('tbl_salon_customer.status','1');
        $this->db->where('tbl_salon_customer.is_guest', '0');
        $this->db->where('MONTH(tbl_salon_customer.dob)', date('m'));
        $this->db->where('DAY(tbl_salon_customer.dob)', date('d'));
        $result = $this->db->get('tbl_salon_customer')->result();

        if(!empty($result)){
            foreach($result as $data){
                $feature_slugs = $this->Salon_model->get_subscription_slugs($data->subscription_id);
                if(!empty(array_intersect(['anniversary_marketing'], $feature_slugs)) && $data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;

                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$data->branch_id);
                    $this->db->where('salon_id',$data->salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    $visit_text = '';
                    if(!empty($branch)){
                        if($branch->branch_name != ""){
                            $visit_text .= $branch->branch_name.'%0a';
                        }
                    }

				    $anniversary_offer = $this->Salon_model->get_single_for_anniversary();
                    $discount_text = '';
                    if(!empty($anniversary_offer)){
                        if($anniversary_offer->discount_status == '1'){                                    
                            $max_flexible = $anniversary_offer->flexible_max;
                            $min_flexible = $anniversary_offer->flexible_min;
                            if($anniversary_offer->discount_type == '1'){    //Flexible
                                $customer_last_service_booking = $this->Salon_model->get_customer_last_any_service_booking($result->id);
                                if(!empty($customer_last_service_booking)){  
                                    $prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;

                                    if($prev_Applied_slab != ""){
                                        $next_slab = $prev_Applied_slab + '5';
                                    }else{
                                        $next_slab = $min_flexible + '5';
                                    }

                                    if($next_slab > $max_flexible){
                                        $slab_consider = $min_flexible;
                                    }else{
                                        $slab_consider = $next_slab;
                                    }
                                }else{
                                    $slab_consider = $min_flexible;
                                }

                                if($anniversary_offer->discount_in == '0'){  //percentage
                                    $discount_text = $slab_consider . '% Off';
                                }elseif($anniversary_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
                                }
                            }else{   //Fixed
                                if($anniversary_offer->discount_in == '0'){  //percentage
                                    $discount_text = $anniversary_offer->discount_amount . '% Off';
                                }elseif($anniversary_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $anniversary_offer->discount_amount . ' Off';
                                }
                            }
                        }
                    }

                    $type = '2';
                    $message = "Hi " . $data->full_name . ", Your anniversary is a milestone worth celebrating! 🎉💖 As a special gift, enjoy " . $discount_text . " valid during your anniversary week. Make this occasion extra special—book your appointment today! With love, " . $visit_text . ".";
                    $app_message = "Hi " . $data->full_name . ",\n\nYour anniversary is a milestone worth celebrating! 🎉💖\n\nAs a special gift, enjoy " . $discount_text . " valid during your anniversary week.\n\nMake this occasion extra special—book your appointment today!\n\nWith love,\n" . $visit_text . ".";
                    $number = $finalNumber;
                    $customer = $data->id;
                    $salon_id = $data->salon_id;
                    $branch_id = $data->branch_id;
                    $for_order_id = '';
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Anniversary Celebrations';
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => '',
                        "redirect_id"   => ''
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
                    $wp_template_data = [
                        'template_name' =>  'anniversaryspecial',
                        'pay_load_components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [ 'type' => 'text', 'text' => $data->full_name ],
                                    [ 'type' => 'text', 'text' => $discount_text ],
                                    [ 'type' => 'text', 'text' => $visit_text ]
                                ]
                            ]
                        ]
                    ];

                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'No Anniversary Today'));
        }
    }
    
    public function send_service_reminder(){
        $today_service_reminders = $this->Salon_model->get_service_reminders_fixed_all(date('Y-m-d'));
        if(!empty($today_service_reminders)){
            foreach($today_service_reminders as $data){
                if($data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;

                    $type = '3';
                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$data->branch_id);
                    $this->db->where('salon_id',$data->salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    $visit_text = '';
                    if(!empty($branch)){
                        if($branch->branch_name != ""){
                            $visit_text .= $branch->branch_name.'%0a';
                        }
                    }

                    $message = "Hello, " . $data->full_name . "! %0a%0aIt’s been a while since we last saw you! Would you like to book your next appointment with us? We can’t wait to serve you again!%0a" . $visit_text . ".";
                    $app_message = "Hello, " . $data->full_name . "!\n\nIt’s been a while since we last saw you! Would you like to book your next appointment with us? We can’t wait to serve you again!\n" . $visit_text . ".";

                    $number = $finalNumber;
                    $customer = $data->customer_name;
                    $salon_id = $data->salon_id;
                    $branch_id = $data->branch_id;
                    $for_order_id = $data->id;
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Service Reminder';
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => '',
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
                    $wp_template_data = [
                        'template_name' =>  'servicesrepeat',
                        'pay_load_components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                                    ["type" => "text", "text" => $data->full_name],
                                                    ["type" => "text", "text" => $visit_text],
                                ]
                            ]
                        ]
                    ];
        
                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'Reminders not available'));
        }
    }
    public function send_lost_customer_message(){
        $today_lost_customer = $this->Salon_model->get_lost_customers_all(date('Y-m-d'));
        if(!empty($today_lost_customer)){
            foreach($today_lost_customer as $data){
                $feature_slugs = $this->Salon_model->get_subscription_slugs($data->subscription_id);
                if(!empty(array_intersect(['lost_customer_marketing'], $feature_slugs)) && $data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;
                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$data->branch_id);
                    $this->db->where('salon_id',$data->salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    $visit_text = '';
                    if(!empty($branch)){
                        if($branch->branch_name != ""){
                            $visit_text .= $branch->branch_name.'%0a';
                        }
                    }

                    $lost_offer = $this->Salon_model->get_single_for_lost();
                    $discount_text = '';
                    if(!empty($lost_offer)){
                        if($lost_offer->discount_status == '1'){                                    
                            $max_flexible = $lost_offer->flexible_max;
                            $min_flexible = $lost_offer->flexible_min;
                            if($lost_offer->discount_type == '1'){    //Flexible
                                $customer_last_service_booking = $this->Salon_model->get_customer_last_any_service_booking($data->id);
                                if(!empty($customer_last_service_booking)){  
                                    $prev_Applied_slab = $customer_last_service_booking->applied_flexible_slab;

                                    if($prev_Applied_slab != ""){
                                        $next_slab = $prev_Applied_slab + '5';
                                    }else{
                                        $next_slab = $min_flexible + '5';
                                    }

                                    if($next_slab > $max_flexible){
                                        $slab_consider = $min_flexible;
                                    }else{
                                        $slab_consider = $next_slab;
                                    }
                                }else{
                                    $slab_consider = $min_flexible;
                                }

                                if($lost_offer->discount_in == '0'){  //percentage
                                    $discount_text = $slab_consider . '% Off';
                                }elseif($lost_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $slab_consider . ' Off';
                                }
                            }else{   //Fixed
                                if($lost_offer->discount_in == '0'){  //percentage
                                    $discount_text = $lost_offer->discount_amount . '% Off';
                                }elseif($lost_offer->discount_in == '1'){ //flat
                                    $discount_text = 'Flat Rs. ' . $lost_offer->discount_amount . ' Off';
                                }
                            }
                        }
                    }

                    $type = '4';
                    $message = "Dear " . $data->full_name . ",%0a%0aWe noticed you haven’t visited us in a while, and we truly miss you! Your satisfaction is our priority, and we’d love to welcome you back with a special offer. 🎁%0a%0aEnjoy " . $discount_text . " on your next visit! Don’t miss out—this offer is valid for a limited time!%0a%0aIf there’s anything we can improve or assist you with, please let us know.%0a%0aWe look forward to seeing you soon!%0a" . $visit_text;
                    $app_message = "Dear " . $data->full_name . ",\n\nWe noticed you haven’t visited us in a while, and we truly miss you! Your satisfaction is our priority, and we’d love to welcome you back with a special offer. 🎁\n\nEnjoy " . $discount_text . " on your next visit! Don’t miss out—this offer is valid for a limited time!\n\nIf there’s anything we can improve or assist you with, please let us know.\n\nWe look forward to seeing you soon!\n" . $visit_text;
                    $number = $finalNumber;
                    $customer = $data->customer_name;
                    $salon_id = $data->salon_id;
                    $branch_id = $data->branch_id;
                    $for_order_id = $data->id;
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Long Time No See';
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => '',
                        "redirect_id"   => ''
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
                    $wp_template_data = [
                        'template_name' =>  'lostclient',
                        'pay_load_components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                                    ["type" => "text", "text" => $data->full_name],
                                                    ["type" => "text", "text" => $discount_text],
                                                    ["type" => "text", "text" => $visit_text],
                                ]
                            ]
                        ]
                    ];
        
                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'Customers not found'));
        }
    }
    public function send_tomorrow_booking_reminder(){
        $tomorrow_bookings = $this->Salon_model->get_customer_bookings_reminders(date('Y-m-d', strtotime('+1 day')),date('Y-m-d', strtotime('+1 day')),'1','3');
        if(!empty($tomorrow_bookings)){
            foreach($tomorrow_bookings as $data){
                if($data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $services_text = '';
                    $this->db->where('id',$data->id);
                    $booking_details = $this->db->get('tbl_new_booking')->row();
                    if(!empty($booking_details)){
                        $services = explode(',',$booking_details->services);
                        if(count($services) > 0){
                            for($i=0;$i<count($services);$i++){
                                $this->db->where('id',$services[$i]);
                                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                $this->db->where('salon_id',$this->session->userdata('salon_id'));
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
                            $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                            $finalNumber = substr($cleanedNumber, -10);
                            $finalNumber = '91' . $finalNumber;

                            $this->db->where('is_deleted','0');
                            $this->db->where('id',$data->branch_id);
                            $this->db->where('salon_id',$data->salon_id);
                            $branch = $this->db->get('tbl_branch')->row();
                            $visit_text = '';
                            if(!empty($branch)){
                                if($branch->branch_name != ""){
                                    $visit_text .= $branch->branch_name.'%0a';
                                }
                            }

                            $type = '9';
                            $message = "Hello, " . $data->full_name . "!%0aAppointment reminder:%0a%0a\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " at%0a\u{1F55B}" . date('h:i A',strtotime($booking_details->service_start_time)) . " for%0a\u{1F488}" . $services_text . "%0a%0aPlease arrive 5 minutes before your appointment time.%0a%0aSee you soon !%0a" . $visit_text . "";
                            $app_message = "Hello, " . $data->full_name . "!\nAppointment reminder:\n\n\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " at\n\u{1F55B}" . date('h:i A',strtotime($booking_details->service_start_time)) . " for\n\u{1F488}" . $services_text . "\n\nPlease arrive 5 minutes before your appointment time.\n\nSee you soon !\n" . $visit_text . "";
                            $number = $finalNumber;
                            $customer = $data->customer_name;
                            $salon_id = $data->salon_id;
                            $branch_id = $data->branch_id;
                            $for_order_id = $booking_details->id;
                            $for_offer_id = '';
                            $for_query_id = '';
                            $consent_form_id = '';
                            $title = 'Appointment Reminder';
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

                            $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                        }
                    }
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'Bookings not available'));
        }
    }
    public function send_yesterday_cancel_booking_message(){
        $bookings = $this->Salon_model->get_yesterday_cancelled_bookings();
        // echo '<pre>'; print_r($bookings);
        if(!empty($bookings)){
            foreach($bookings as $data){
                $this->db->where('id',$data->branch_id);
                $branch = $this->db->get('tbl_branch')->row();
                $feature_slugs = $this->Salon_model->get_subscription_slugs($branch->subscription_id);
                if(!empty(array_intersect(['yesterday-cancel-bookings'], $feature_slugs)) && $data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;
                    // echo $branch->branch_name;
                    // echo '<pre>'; print_r($finalNumber); exit;

                    $this->db->where('is_deleted','0');
                    $this->db->where('id',$data->branch_id);
                    $this->db->where('salon_id',$data->salon_id);
                    $branch = $this->db->get('tbl_branch')->row();
                    $visit_text = '';
                    if(!empty($branch)){
                        if($branch->branch_name != ""){
                            $visit_text .= $branch->branch_name.'%0a';
                        }
                    }

                    $type = '25';
                    $message = "Hello, " . $data->full_name . "!%0a%0aWe noticed you cancelled your appointment yesterday. If you’re free today, please book your slot through the app and visit us.%0a%0aLooking forward to seeing you!%0a" . $visit_text;
                    $app_message = "Hello " . $data->full_name . "!\n\nWe noticed you cancelled your appointment yesterday. If you’re free today, please book your slot through the app and visit us.\n\nLooking forward to seeing you!\n" . $visit_text;
                    $number = $finalNumber;
                    $customer = $data->customer_name;
                    $salon_id = $data->salon_id;
                    $branch_id = $data->branch_id;
                    $for_order_id = $data->id;
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Booking appointment for today';
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => 'new_booking',
                        "redirect_id"   => ''
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
                    $wp_template_data = [
                        'template_name' =>  'cancelledappointment',
                        'pay_load_components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [ 'type' => 'text', 'text' => $data->full_name ],
                                    [ 'type' => 'text', 'text' => $visit_text ]
                                ]
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => '0',
                                'parameters' => [
                                    [ 'type' => 'text', 'text' => 'https://ms-saloon.web.app/' ]
                                ]
                            ]
                        ]
                    ];

                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'Bookings not available'));
        }
    }
    public function send_today_booking_reminder(){
        $tomorrow_bookings = $this->Salon_model->get_customer_bookings_reminders(date('Y-m-d'),date('Y-m-d'),'1','3');
        if(!empty($tomorrow_bookings)){
            foreach($tomorrow_bookings as $data){
                if($data->customer_phone != "" && $data->customer_phone != null && $data->customer_phone != '0000000000'){
                    $services_text = '';
                    $this->db->where('id',$data->id);
                    $booking_details = $this->db->get('tbl_new_booking')->row();
                    if(!empty($booking_details)){
                        $services = explode(',',$booking_details->services);
                        if(count($services) > 0){
                            for($i=0;$i<count($services);$i++){
                                $this->db->where('id',$services[$i]);
                                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                $this->db->where('salon_id',$this->session->userdata('salon_id'));
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
                            $cleanedNumber = preg_replace('/[^0-9]/', '', $data->customer_phone);
                            $finalNumber = substr($cleanedNumber, -10);
                            $finalNumber = '91' . $finalNumber;

                            $this->db->where('is_deleted','0');
                            $this->db->where('id',$data->branch_id);
                            $this->db->where('salon_id',$data->salon_id);
                            $branch = $this->db->get('tbl_branch')->row();
                            $visit_text = '';
                            if(!empty($branch)){
                                if($branch->branch_name != ""){
                                    $visit_text .= $branch->branch_name.'%0a';
                                }
                            }

                            $type = '9';
                            $message = "Hello, " . $data->full_name . "!%0aAppointment reminder:%0a%0a\u{1F5D3}" . date('d M, Y',strtotime($booking_details->service_start_date)) . " at%0a\u{1F55B}" . date('h:i A',strtotime($booking_details->service_start_time)) . " for%0a\u{1F488}" . $services_text . "%0a%0aPlease arrive 5 minutes before your appointment time.%0a%0aSee you soon !%0a" . $visit_text . "";
                            $app_message = "Hello, " . $data->full_name . "!\nAppointment reminder:\n\n\u{1F5D3}" . date('d M, Y', strtotime($booking_details->service_start_date)) . " at\n\u{1F55B}" . date('h:i A', strtotime($booking_details->service_start_time)) . " for\n\u{1F488}" . $services_text . "\n\nPlease arrive 5 minutes before your appointment time.\n\nSee you soon !\n" . $visit_text . "";
                            $number = $finalNumber;
                            $customer = $data->customer_name;
                            $salon_id = $data->salon_id;
                            $branch_id = $data->branch_id;
                            $for_order_id = $booking_details->id;
                            $for_offer_id = '';
                            $for_query_id = '';
                            $consent_form_id = '';
                            $title = 'Appointment Reminder';
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

                            $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                        }
                    }
                }
            }
            echo json_encode(array('status'=>'true','message'=>'Messages sent successfully'));
        }else{
            echo json_encode(array('status'=>'false','message'=>'Bookings not available'));
        }
    }
    
    public function add_message(){
        $data = array(
            'branch_id' 		=> $this->session->userdata('branch_id'),
            'salon_id' 			=> $this->session->userdata('salon_id'),
            'message' 		    => $this->input->post('message'),
            'remark' 	        => $this->input->post('remark'),
        );
        if($this->input->post('hidden_id') == ""){
            $date = array(
                'added_on'      => date("Y-m-d H:i:s"),
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data, $date);
            $this->db->insert('tbl_salon_customize_messages', $new_arr);
            return 0;
        }else{
            $this->db->where('id', $this->input->post('hidden_id'));
            $this->db->update('tbl_salon_customize_messages', $data);
            return 1;
        } 
	} 
    public function send_customize_message(){
        $id = $this->input->post('hidden_id');
        $message_type = $this->input->post('message_type');
        $customers = $this->input->post('customers');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row) && !empty($customers)){
            $custom_message = trim($row->message);
            for($i=0;$i<count($customers);$i++){
                $this->db->where('id',$customers[$i]);
                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                $this->db->where('salon_id',$this->session->userdata('salon_id'));
                $this->db->where('is_deleted','0');
                $customer_details = $this->db->get('tbl_salon_customer')->row();
                if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                    $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                    $finalNumber = substr($cleanedNumber, -10);
                    $finalNumber = '91' . $finalNumber;

                    $type = '10';
                    $message = $custom_message;
                    $app_message = $message;
                    $number = $finalNumber;
                    $customer = $customer_details->id;
                    $salon_id = $customer_details->salon_id;
                    $branch_id = $customer_details->branch_id;
                    $for_order_id = '';
                    $for_offer_id = '';
                    $for_query_id = '';
                    $consent_form_id = '';
                    $title = 'Hello '.$customer_details->full_name;
                    $generated_from = '0';
                    $notification_data = [
                        "landing_page"  => '',
                        "redirect_id"   => ''
                    ];
                    
                    $message_send_on = '';
                    $template_id = '';                    
                    $email_subject = '';
                    $email_html = '';
                    if($message_type != ""){
                        if($message_type == '1'){
                            $message_send_on = '0'; //SMS
                            $template_id = '';
                        }elseif($message_type == '2'){
                            $message_send_on = '2'; //EMAIL
                            $email_html = '';
                        }elseif($message_type == '3'){
                            $message_send_on = '1'; //WP
                        }
                    }else{
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
                    }
                    $membership_history_id = '';
                    $package_allocation_id = '';
                    $giftcard_purchase_id = '';
                    $trying_booking_id = '';
                    $wp_template_data = [];

                    $this->Salon_model->send_notification($app_message,$title,$notification_data,$message,$number,$type,$customer,$salon_id,$branch_id,$for_order_id,$for_offer_id,$generated_from,$for_query_id,$message_send_on,$template_id,$email_subject,$email_html,$consent_form_id,$membership_history_id,$giftcard_purchase_id,$package_allocation_id,$trying_booking_id,$wp_template_data);
                }
            }
            return 0;
        }else{
            return 1;
        }
    }
    
    public function send_offer_message(){
        $id = $this->input->post('hidden_id');
        $customers = $this->input->post('customers');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_offers')->row();
        
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $branch = $this->db->get('tbl_branch')->row();
        if(!empty($row) && !empty($customers)){ 
            if(count($customers) <= (int)$branch->current_wp_coins_balance){     
                $services_text = '';
                $services = explode(',',$row->service_name);
                for($i=0;$i<count($services);$i++){
                    $this->db->where('id',$services[$i]);
                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                    $this->db->where('salon_id',$this->session->userdata('salon_id'));
                    $this->db->where('is_deleted','0');
                    $service_details = $this->db->get('tbl_salon_emp_service')->row();
                    if (!empty($service_details)) {
                        $services_text .= $service_details->service_name;
                        
                        if ($i < count($services) - 1) {
                            $services_text .= ', ';
                        }
                    }
                }
                $services_text = trim($services_text,',');
                $services_text = trim($services_text,' ');

                $single_offer_discount_type = $row->discount_in;
                if($single_offer_discount_type == '0'){
                    $service_offer_discount_text = $row->discount.'%';
                }else{
                    $service_offer_discount_text = 'Flat Rs. '.$row->discount;
                }
                
                $visit_text = '';
                if(!empty($branch)){
                    if($branch->branch_name != ""){
                        $visit_text .= $branch->branch_name;
                    }
                }

                if (!empty($row->duration) && $row->duration != '0') {
                    $start_date = date('d M, Y', strtotime($row->created_on));
                    $end_date = date('d M, Y', strtotime($row->created_on . ' + ' . (int)$row->duration . ' weeks'));
                } else {
                    $start_date = '';
                    $end_date = '';
                }

                $festival_name = 'Festive Season';

                $message = "🌟 Festival Offer Alert! 🌟%0a" .
                    "Celebrate " . $festival_name . " with " . $visit_text . "!%0a" .
                    "Get " . $service_offer_discount_text . " off on all services from " . $start_date . " to " . $end_date . ".%0a" .
                    "Hurry, book your appointment now!";

                $finalNumbers = [];
                $insertIDS = [];
                
                $type = '11';
                $for_offer_id = $row->id;             
                $message_send_on = '1'; //WP
                $template_name = 'festivaloffer2';
                $pay_load_components = [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [ 'type' => 'text', 'text' => $festival_name ],
                                [ 'type' => 'text', 'text' => $visit_text ],
                                [ 'type' => 'text', 'text' => $service_offer_discount_text ],
                                [ 'type' => 'text', 'text' => $start_date ],
                                [ 'type' => 'text', 'text' => $end_date ]
                            ]
                        ]
                    ];

                for($i=0;$i<count($customers);$i++){
                    $this->db->where('id',$customers[$i]);
                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                    $this->db->where('salon_id',$this->session->userdata('salon_id'));
                    $this->db->where('is_deleted','0');
                    $customer_details = $this->db->get('tbl_salon_customer')->row();
                    if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                        $customer = $customer_details->id;
                        $salon_id = $customer_details->salon_id;
                        $branch_id = $customer_details->branch_id;

                        $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                        $finalNumber = substr($cleanedNumber, -10);
                        $finalNumber = '91' . $finalNumber;
                        $finalNumbers[] = $finalNumber;

                        $this->db->where('is_deleted','0');
                        $this->db->where('id',$this->session->userdata('branch_id'));
                        $this->db->where('salon_id',$this->session->userdata('salon_id'));
                        $single_branch = $this->db->get('tbl_branch')->row();

                        $wp_coins_opening_balance = $single_branch->current_wp_coins_balance != "" ? (int)$single_branch->current_wp_coins_balance : 0;
                        $wp_coins_used = 1;
                        $wp_coins_closing_balance = $wp_coins_opening_balance - $wp_coins_used;

                        $branch_data = array(
                            'current_wp_coins_balance'  =>  $wp_coins_closing_balance
                        );
                        $this->db->where('id',$single_branch->id);
                        $this->db->update('tbl_branch',$branch_data);
                        
                        $data = array(
                            'send_on'		=>	$message_send_on,
                            'type'		    =>	$type,
                            'send_to'		=>	$finalNumber,
                            'send_customer' =>	$customer,
                            'content'		=>	$message,
                            'salon_id'		=>	$salon_id,
                            'branch_id'	    =>	$branch_id,
                            'for_offer_id'	=>	$for_offer_id,
                            'template_name' =>  $template_name,
                            'wp_gateway'    =>  '1',
                            'wp_coins_used' =>  $wp_coins_used,
                            'wp_coins_opening_balance' =>  $wp_coins_opening_balance,
                            'wp_coins_closing_balance' =>  $wp_coins_closing_balance,
                            'created_on'	=>	date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tbl_messages_history',$data);
                        $insertIDS[] = $this->db->insert_id();
                    }
                }

                $finalNumbers = !empty($finalNumbers) ? implode(',',$finalNumbers) : '';
                if($finalNumbers != "" && !empty($insertIDS)){
                    if(!empty($branch) && $branch->include_wp == '1'){
                        if((int)$branch->current_wp_coins_balance > 0){
                            $response = $this->Salon_model->send_whatsapp_messages_newgateway($finalNumbers,$template_name,$pay_load_components);
                            $sending_status = $response['sending_status'];
                            $api_response = $response['api_response'];
                        }else{
                            $sending_status = 'failed';
                            $api_response = json_encode(
                                array(
                                    'status'       =>  'failed',
                                    'statusDesc'    =>  'Insufficient coin balance'
                                )
                            );
                        }
                    }else{
                        $sending_status = 'failed';
                        $api_response = json_encode(
                            array(
                                'status'       =>  'failed',
                                'statusDesc'    =>  'Whatsapp notifications not allowed'
                            )
                        );
                    }


                    $update_data = array(
                        'api_response_status'	=>	$sending_status,
                        'api_response'	        =>	$api_response
                    );
                    $this->db->where_in('id',$insertIDS);
                    $this->db->update('tbl_messages_history',$update_data);
                }

                return 0;
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }
    public function send_coupon_message(){
        $id = $this->input->post('hidden_id');
        $customers = $this->input->post('customers');

        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_coupon_code')->row();        
        
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $branch = $this->db->get('tbl_branch')->row();
        if(!empty($row) && !empty($customers)){           
            if(count($customers) <= (int)$branch->current_wp_coins_balance){           
                $validity_text = '';
                if($row->coupan_expiry != "" && $row->coupan_expiry != null && $row->coupan_expiry != "0000-00-00" && $row->coupan_expiry != "1970-01-01"){
                    $validity_text = date('d M, Y',strtotime($row->coupan_expiry));
                }
                    
                $discount_text = '';
                if($row->coupon_offers != "" && $row->coupon_offers != null){
                    $discount_text = 'Flat Rs. ' . rtrim($row->coupon_offers);
                }

                $min_purchase = '';
                if($row->min_price != "" && $row->min_price != null){
                    $min_purchase = rtrim($row->min_price);
                }
                
                $visit_text = '';
                if(!empty($branch)){
                    if($branch->branch_name != ""){
                        $visit_text .= 'Visit '.$branch->branch_name.'%0a';
                    }
                }

                $message = "\u{1F4B8} Special Offer Just for You! \u{1F4B8}%0a%0a" .
                    "Make a minimum purchase of Rs. {$min_purchase} and get {$discount_text} OFF on your next visit!%0a%0a" .
                    "Hurry—this offer is valid until {$validity_text} Don’t miss out.%0a%0a";  

                $finalNumbers = [];
                $insertIDS = [];
                
                $type = '14';
                $for_coupon_id = $row->id;                
                $message_send_on = '1'; //WP
                $template_name = 'couponoffer1';
                $pay_load_components = [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [ 'type' => 'text', 'text' => $min_purchase ],
                                [ 'type' => 'text', 'text' => $discount_text ],
                                [ 'type' => 'text', 'text' => $validity_text ]
                            ]
                        ]
                    ];

                for($i=0;$i<count($customers);$i++){
                    $this->db->where('id',$customers[$i]);
                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                    $this->db->where('salon_id',$this->session->userdata('salon_id'));
                    $this->db->where('is_deleted','0');
                    $customer_details = $this->db->get('tbl_salon_customer')->row();
                    if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                        $customer = $customer_details->id;
                        $salon_id = $customer_details->salon_id;
                        $branch_id = $customer_details->branch_id;

                        $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                        $finalNumber = substr($cleanedNumber, -10);
                        $finalNumber = '91' . $finalNumber;
                        $finalNumbers[] = $finalNumber;

                        $this->db->where('is_deleted','0');
                        $this->db->where('id',$this->session->userdata('branch_id'));
                        $this->db->where('salon_id',$this->session->userdata('salon_id'));
                        $single_branch = $this->db->get('tbl_branch')->row();

                        $wp_coins_opening_balance = $single_branch->current_wp_coins_balance != "" ? (int)$single_branch->current_wp_coins_balance : 0;
                        $wp_coins_used = 1;
                        $wp_coins_closing_balance = $wp_coins_opening_balance - $wp_coins_used;

                        $branch_data = array(
                            'current_wp_coins_balance'  =>  $wp_coins_closing_balance
                        );
                        $this->db->where('id',$single_branch->id);
                        $this->db->update('tbl_branch',$branch_data);
                        
                        $data = array(
                            'send_on'		=>	$message_send_on,
                            'type'		    =>	$type,
                            'send_to'		=>	$finalNumber,
                            'send_customer' =>	$customer,
                            'content'		=>	$message,
                            'salon_id'		=>	$salon_id,
                            'branch_id'	    =>	$branch_id,
                            'for_coupon_id'	=>	$for_coupon_id,
                            'template_name' =>  $template_name,
                            'wp_gateway'    =>  '1',
                            'wp_coins_used' =>  $wp_coins_used,
                            'wp_coins_opening_balance' =>  $wp_coins_opening_balance,
                            'wp_coins_closing_balance' =>  $wp_coins_closing_balance,
                            'created_on'	=>	date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tbl_messages_history',$data);
                        $insertIDS[] = $this->db->insert_id();
                    }
                }

                $finalNumbers = !empty($finalNumbers) ? implode(',',$finalNumbers) : '';
                if($finalNumbers != "" && !empty($insertIDS)){
                    if(!empty($branch) && $branch->include_wp == '1'){
                        if((int)$branch->current_wp_coins_balance > 0){
                            $response = $this->Salon_model->send_whatsapp_messages_newgateway($finalNumbers,$template_name,$pay_load_components);
                            $sending_status = $response['sending_status'];
                            $api_response = $response['api_response'];
                        }else{
                            $sending_status = 'failed';
                            $api_response = json_encode(
                                array(
                                    'status'       =>  'failed',
                                    'statusDesc'    =>  'Insufficient coin balance'
                                )
                            );
                        }
                    }else{
                        $sending_status = 'failed';
                        $api_response = json_encode(
                            array(
                                'status'       =>  'failed',
                                'statusDesc'    =>  'Whatsapp notifications not allowed'
                            )
                        );
                    }

                    $update_data = array(
                        'api_response_status'	=>	$sending_status,
                        'api_response'	        =>	$api_response
                    );
                    $this->db->where_in('id',$insertIDS);
                    $this->db->update('tbl_messages_history',$update_data);
                }
                return 0;
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }

    public function send_giftcard_message(){
        $id = $this->input->post('hidden_id');
        $customers = $this->input->post('customers');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_gift_card')->row();        
        
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $branch = $this->db->get('tbl_branch')->row();
        if(!empty($row) && !empty($customers)){       
            if(count($customers) <= (int)$branch->current_wp_coins_balance){    
                $visit_text = '';
                if(!empty($branch)){
                    if($branch->branch_name != ""){
                        $visit_text .= 'Visit '.$branch->branch_name.'';
                    }
                }

                $message = "🎁 Gift the Joy of Beauty & Wellness! 🎁%0a%0a" .
                    "Surprise your loved ones with premium beauty and care services from {$visit_text} 💌%0a%0a" .
                    "How to Get & Share:%0a1️⃣ Open the Napito app.%0a2️⃣ Buy a gift card.%0a3️⃣ Share it from the app.%0a%0a" .
                    "💖 Make someone’s day special!";

                $finalNumbers = [];
                $insertIDS = [];
                
                $type = '15';
                $for_giftcard_id = $row->id;                
                $message_send_on = '1'; //WP
                $template_name = 'giftcard';
                $pay_load_components = [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [ 'type' => 'text', 'text' => $visit_text ]
                            ]
                        ]
                    ];

                for($i=0;$i<count($customers);$i++){
                    $this->db->where('id',$customers[$i]);
                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                    $this->db->where('salon_id',$this->session->userdata('salon_id'));
                    $this->db->where('is_deleted','0');
                    $customer_details = $this->db->get('tbl_salon_customer')->row();
                    if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                        $customer = $customer_details->id;
                        $salon_id = $customer_details->salon_id;
                        $branch_id = $customer_details->branch_id;

                        $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                        $finalNumber = substr($cleanedNumber, -10);
                        $finalNumber = '91' . $finalNumber;
                        $finalNumbers[] = $finalNumber;

                        $this->db->where('is_deleted','0');
                        $this->db->where('id',$this->session->userdata('branch_id'));
                        $this->db->where('salon_id',$this->session->userdata('salon_id'));
                        $single_branch = $this->db->get('tbl_branch')->row();

                        $wp_coins_opening_balance = $single_branch->current_wp_coins_balance != "" ? (int)$single_branch->current_wp_coins_balance : 0;
                        $wp_coins_used = 1;
                        $wp_coins_closing_balance = $wp_coins_opening_balance - $wp_coins_used;

                        $branch_data = array(
                            'current_wp_coins_balance'  =>  $wp_coins_closing_balance
                        );
                        $this->db->where('id',$single_branch->id);
                        $this->db->update('tbl_branch',$branch_data);
                        
                        $data = array(
                            'send_on'		=>	$message_send_on,
                            'type'		    =>	$type,
                            'send_to'		=>	$finalNumber,
                            'send_customer' =>	$customer,
                            'content'		=>	$message,
                            'salon_id'		=>	$salon_id,
                            'branch_id'	    =>	$branch_id,
                            'for_giftcard_id'=>	$for_giftcard_id,
                            'template_name' =>  $template_name,
                            'wp_gateway'    =>  '1',
                            'wp_coins_used' =>  $wp_coins_used,
                            'wp_coins_opening_balance' =>  $wp_coins_opening_balance,
                            'wp_coins_closing_balance' =>  $wp_coins_closing_balance,
                            'created_on'	=>	date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tbl_messages_history',$data);
                        $insertIDS[] = $this->db->insert_id();
                    }
                }

                $finalNumbers = !empty($finalNumbers) ? implode(',',$finalNumbers) : '';
                if($finalNumbers != "" && !empty($insertIDS)){
                    if(!empty($branch) && $branch->include_wp == '1'){
                        if((int)$branch->current_wp_coins_balance > 0){
                            $response = $this->Salon_model->send_whatsapp_messages_newgateway($finalNumbers,$template_name,$pay_load_components);
                            $sending_status = $response['sending_status'];
                            $api_response = $response['api_response'];
                        }else{
                            $sending_status = 'failed';
                            $api_response = json_encode(
                                array(
                                    'status'       =>  'failed',
                                    'statusDesc'    =>  'Insufficient coin balance'
                                )
                            );
                        }
                    }else{
                        $sending_status = 'failed';
                        $api_response = json_encode(
                            array(
                                'status'       =>  'failed',
                                'statusDesc'    =>  'Whatsapp notifications not allowed'
                            )
                        );
                    }

                    $update_data = array(
                        'api_response_status'	=>	$sending_status,
                        'api_response'	        =>	$api_response
                    );
                    $this->db->where_in('id',$insertIDS);
                    $this->db->update('tbl_messages_history',$update_data);
                }
                return 0;
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }
      
    public function get_date_time_anniversary_filter() {
        if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
            $daterange = json_decode($_GET['daterange']);
            $from = date('Y-m-d', strtotime($daterange->start));
            $to = date('Y-m-d', strtotime($daterange->end));         
        } else {
            $from = '';
            $to = '';
        }
        $this->db->where('is_deleted', '0');
        if ($from != "" && $to != "") {
            $this->db->where('DAY(tbl_salon_customer.doa) >=', date('d', strtotime($from)));
            $this->db->where('DAY(tbl_salon_customer.doa) <=', date('d', strtotime($to)));
            $this->db->where('MONTH(tbl_salon_customer.doa) >=', date('m', strtotime($from)));
            $this->db->where('MONTH(tbl_salon_customer.doa) <=', date('m', strtotime($to)));
        }
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
        if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
            $daterange = json_decode($_GET['daterange']);
            $from = date('Y-m-d', strtotime($daterange->start));
            $to = date('Y-m-d', strtotime($daterange->end));         
        } else {
            $from = '';
            $to = '';
        }
        $this->db->select('tbl_booking_services_details.*,tbl_salon_customer.full_name as fullname');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');

        if ($from != "" && $to != "") {
            $this->db->where('DATE(tbl_booking_services_details.service_date) >=', $from);
            $this->db->where('DATE(tbl_booking_services_details.service_date) <=', $to);
        }
        $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name','left');
        $this->db->order_by('tbl_booking_services_details.id', 'DESC');
        $result = $this->db->get('tbl_booking_services_details')->result();
        return $result;
        // echo "<pre>";print_r($result);exit;
    }
   

    public function get_cancel_appointment_filter() {
        if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
            $daterange = json_decode($_GET['daterange']);
            $from = date('Y-m-d', strtotime($daterange->start));
            $to = date('Y-m-d', strtotime($daterange->end));         
        } else {
            $from = '';
            $to = '';
        }
        $this->db->select('tbl_booking_services_details.*, tbl_salon_customer.full_name as fullname');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.service_status', '2');
        if ($from != "" && $to != "") {
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
        if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
            $daterange = json_decode($_GET['daterange']);
            $from = date('Y-m-d', strtotime($daterange->start));
            $to = date('Y-m-d', strtotime($daterange->end));         
        } else {
            $from = '';
            $to = '';
        }
    
        $this->db->select('tbl_booking_services_details.*, tbl_salon_customer.full_name as fullname, tbl_salon_customer.customer_phone as contact');
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
    
        if ($from != "" && $to != "") {
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
    public function get_single_customize_message($id){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        return $row;
    }
    
    public function get_message_content_ajx(){
        $id = $this->input->post('id');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_messages_history')->row();
        if(!empty($row)){
            $message = htmlspecialchars($row->content, ENT_QUOTES, 'UTF-8');
            $message = preg_replace('/\*([^\*]+)\*/', '<strong>$1</strong>', $message);
            $message = preg_replace('/_([^_]+)_/', '<em>$1</em>', $message);
            $message = preg_replace('/~([^~]+)~/', '<del>$1</del>', $message);
            $message = preg_replace('/`([^`]+)`/', '<code>$1</code>', $message);
            
            $message = str_replace('%0a', '<br>', $message);
        ?>
            <p><?= $message; ?></p>
            <label style="color:#73879C; font-size: 11px;margin-top: 10px;font-weight: unset;"><?=date('d M, Y h:i A',strtotime($row->created_on));?></label>
            <?php if(strtolower($row->api_response_status) == 'failed'){ ?>
                <label class="label label-danger">Failed</label>
            <?php }else{ ?>
                <label class="label label-success">Success</label>
            <?php } ?>
        <?php
        }
    }
    public function get_message_gateway_response_ajx(){
        $id = $this->input->post('id');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $row = $this->db->get('tbl_messages_history')->row();
        if(!empty($row)){
            $api_response = $row->api_response;
        ?>
        <div class="message-response">
            <div class="response-text"><strong>Response:</strong> <p><?=nl2br(htmlspecialchars($api_response)); ?></p></div>
            <div class="response-status">
            <?php if(strtolower($row->api_response_status) == 'failed'){ ?>
                <label class="label label-danger">Failed</label>
            <?php }else{ ?>
                <label class="label label-success">Success</label>
            <?php } ?>
            </div>
        </div>
        <?php
        }
    }
    public function get_customize_message_ajx(){
        $id = $this->input->post('id');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){
            $message = htmlspecialchars($row->message, ENT_QUOTES, 'UTF-8');
            $message = preg_replace('/\*([^\*]+)\*/', '<strong>$1</strong>', $message);
            $message = preg_replace('/_([^_]+)_/', '<em>$1</em>', $message);
            $message = preg_replace('/~([^~]+)~/', '<del>$1</del>', $message);
            $message = preg_replace('/`([^`]+)`/', '<code>$1</code>', $message);
            
            $message = str_replace('%0a', '<br>', $message);
        ?>
            <p><?= $message; ?></p>
            <label style="color:#73879C; font-size: 11px;margin-top: 10px;font-weight: unset;"><?=date('d M, Y h:i A',strtotime($row->created_on));?></label>
        <?php
        }
    }
    public function get_customize_message_remark_ajx(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
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
    public function get_send_customize_message_form_ajx(){
        $id = $this->input->post('id');
        $booking_rules = $this->Salon_model->get_booking_rules();
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $this->db->where('branch_id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $row = $this->db->get('tbl_salon_customize_messages')->row();
        if(!empty($row)){
            $customer = $this->Salon_model->get_all_salon_customer();
            
            $message = htmlspecialchars($row->message, ENT_QUOTES, 'UTF-8');
            $message = preg_replace('/\*([^\*]+)\*/', '<strong>$1</strong>', $message);
            $message = preg_replace('/_([^_]+)_/', '<em>$1</em>', $message);
            $message = preg_replace('/~([^~]+)~/', '<del>$1</del>', $message);
            $message = preg_replace('/`([^`]+)`/', '<code>$1</code>', $message);
            
            $message = str_replace('%0a', '<br>', $message);
        ?>
        <form method="post" name="send_message_form" id="send_message_form" enctype="multipart/form-data" action="<?=base_url();?>send_customize_message">        
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group custom_message_div">
                    <?=$message;?>
                </div>
            </div>  
            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $row->id; ?>">     
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <label for="customers">Select Customers<b class="require">*</b></label>
                    <select class="form-control choosen" id="customers" name="customers[]" multiple>
                    <?php 
                        if(!empty($customer)){
                        foreach($customer as $customer_result){
                    ?>
                    <option value="<?=$customer_result->id;?>"><?=$customer_result->full_name.' ('.$customer_result->customer_phone.')';?></option>
                    <?php }} ?>
                    </select>   
                    <label for="customers" generated="true" class="error" style="display:none;">Please select customer!</label>                          
                </div>
            </div>       
            <div class="row">
                <div class="form-group col-md-6 col-xs-12" id="message_type_div">
                    <label>Select Message Type<b class="require">*</b></label>
                    <select class="form-control choosen" name="message_type" id="message_type">
                        <option value="">Select Option</option>
                        <option value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'selected'; }?>>SMS</option>
                        <option value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'selected'; }?>>Email</option>
                        <option value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'selected'; }?>>Whatsapp</option>
                    </select>
                    <label for="message_type" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                </div>
            </div>    
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                    <button type="submit" id="submit_message_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                </div>
            </div>
        </form>
        <script>
            $(".choosen").chosen({
                no_results_text: "Oops, nothing found!"
            });
            $('#send_message_form').validate({
                ignore: [],
                rules: {
                    'customers[]': {
                        required: true
                    },
                    message_type: {
                        required: true
                    }
                },
                messages: {
                    'customers[]': "Please select customer!",
                    message_type: "Please select message type!"
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
    public function get_all_customize_messages_ajx($length, $start, $search) {
        $this->db->select('tbl_salon_customize_messages.*');
        $this->db->where('tbl_salon_customize_messages.is_deleted', '0');
        $this->db->where('tbl_salon_customize_messages.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customize_messages.salon_id', $this->session->userdata('salon_id')); 
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_salon_customize_messages.message', $search);
            $this->db->lor_likeike('tbl_salon_customize_messages.added_on', $search);
            $this->db->or_like('tbl_salon_customize_messages.reject_remark', $search);
            $this->db->or_like('tbl_salon_customize_messages.rejected_on', $search);
            $this->db->or_like('tbl_salon_customize_messages.remark', $search);
            $this->db->or_like('tbl_salon_customize_messages.approval_on', $search);
            $this->db->group_end();
        }
        
        $this->db->limit($length, $start);
        $this->db->order_by('tbl_salon_customize_messages.created_on', 'DESC');
        $result = $this->db->get('tbl_salon_customize_messages');
        return $result->result();
    } 
    
    public function get_all_customize_messages_ajx_count($search){
        $this->db->select('tbl_salon_customize_messages.*');
        $this->db->where('tbl_salon_customize_messages.is_deleted', '0');
        $this->db->where('tbl_salon_customize_messages.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_customize_messages.salon_id', $this->session->userdata('salon_id')); 
            
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('tbl_salon_customize_messages.message', $search);
            $this->db->or_like('tbl_salon_customize_messages.added_on', $search);
            $this->db->or_like('tbl_salon_customize_messages.reject_remark', $search);
            $this->db->or_like('tbl_salon_customize_messages.rejected_on', $search);
            $this->db->or_like('tbl_salon_customize_messages.remark', $search);
            $this->db->or_like('tbl_salon_customize_messages.approval_on', $search);
            $this->db->group_end();
        }

        $this->db->order_by('tbl_salon_customize_messages.created_on', 'DESC');
        $result = $this->db->get('tbl_salon_customize_messages');
		return $result->num_rows();
	}
    
    
    public function send_promo_message(){
        $customers = $this->input->post('customers');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->session->userdata('branch_id'));
        $this->db->where('salon_id',$this->session->userdata('salon_id'));
        $branch = $this->db->get('tbl_branch')->row();
        if(!empty($customers) && !empty($branch)){              
            if(count($customers) <= (int)$branch->current_wp_coins_balance){     
                $this->db->where('is_deleted','0');
                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                $this->db->where('salon_id',$this->session->userdata('salon_id'));
                $store_profile = $this->db->get('tbl_store_profile')->row();

                $visit_text = '';
                $branch_unique_code = '';
                if(!empty($branch)){
                    if($branch->branch_name != ""){
                        $visit_text .= $branch->branch_name;
                    }
                    $branch_unique_code = $branch->branch_unique_code;
                }

                $contactInfo = '';
                if(!empty($store_profile)){
                    if($store_profile->customer_support_phone != ""){
                        $contactInfo = $store_profile->customer_support_phone;
                    }
                }

                if($contactInfo == "" && !empty($branch)){
                    if($branch->salon_number != ""){
                        $contactInfo = $branch->salon_number;
                    }
                }

                $message = "No more waiting! Booking an appointment at {$visit_text} is now super easy!%0a%0a" .
                    "No need to call – just book through the Napito App and enjoy exclusive offers and discounts!%0a%0a" .
                    "Download the Napito App Now: https://napito.page.link/download%0a%0a" .
                    "How to register?%0a" .
                    "1. Enter your mobile number and verify with OTP%0a" .
                    "2. Fill in your details:%0a" .
                    "– Gender%0a" .
                    "– Name%0a" .
                    "– Birthday%0a" .
                    "– Anniversary%0a%0a" .
                    "Scan the QR code or enter this Store Code: {$branch_unique_code}%0a%0a" .
                    "For more info, contact: {$contactInfo}";

                // $message = "Hello {$visit_text}, we noticed your appointment scheduled for yesterday was canceled. If you need any assistance or would like to reschedule, please let us know. {$contactInfo}";

                $finalNumbers = [];
                $insertIDS = [];
                
                $type = '24';
                $message_send_on = '1'; //WP
                $template_name = 'easybookingpromo';
                $pay_load_components = [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [ 'type' => 'text', 'text' => $visit_text ],
                                [ 'type' => 'text', 'text' => $branch_unique_code ],
                                [ 'type' => 'text', 'text' => $contactInfo ]
                            ]
                        ]
                    ];
                    
                // $template_name = 'cancel_apt';
                // $pay_load_components = [
                //         [
                //             'type' => 'body',
                //             'parameters' => [
                //                 [ 'type' => 'text', 'text' => $visit_text ],
                //                 [ 'type' => 'text', 'text' => $contactInfo ]
                //             ]
                //         ]
                //     ];

                $this->db->where_in('id',$customers);
                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                $this->db->where('salon_id',$this->session->userdata('salon_id'));
                $this->db->where('is_deleted','0');
                $customer_details_result = $this->db->get('tbl_salon_customer')->result();
                if(!empty($customer_details_result)){
                    foreach($customer_details_result as $customer_details){
                        if($customer_details->customer_phone != "" && $customer_details->customer_phone != null && $customer_details->customer_phone != '0000000000'){
                            $customer = $customer_details->id;
                            $salon_id = $customer_details->salon_id;
                            $branch_id = $customer_details->branch_id;

                            $cleanedNumber = preg_replace('/[^0-9]/', '', $customer_details->customer_phone);
                            $finalNumber = substr($cleanedNumber, -10);
                            $finalNumber = '91' . $finalNumber;
                            $finalNumbers[] = $finalNumber;

                            $this->db->where('is_deleted','0');
                            $this->db->where('id',$this->session->userdata('branch_id'));
                            $this->db->where('salon_id',$this->session->userdata('salon_id'));
                            $single_branch = $this->db->get('tbl_branch')->row();

                            $wp_coins_opening_balance = $single_branch->current_wp_coins_balance != "" ? (int)$single_branch->current_wp_coins_balance : 0;
                            $wp_coins_used = 1;
                            $wp_coins_closing_balance = $wp_coins_opening_balance - $wp_coins_used;

                            $branch_data = array(
                                'current_wp_coins_balance'  =>  $wp_coins_closing_balance
                            );
                            $this->db->where('id',$single_branch->id);
                            $this->db->update('tbl_branch',$branch_data);
                            
                            $data = array(
                                'send_on'		=>	$message_send_on,
                                'type'		    =>	$type,
                                'send_to'		=>	$finalNumber,
                                'send_customer' =>	$customer,
                                'content'		=>	$message,
                                'salon_id'		=>	$salon_id,
                                'branch_id'	    =>	$branch_id,
                                'template_name' =>  $template_name,
                                'wp_gateway'    =>  '1',
                                'wp_coins_used' =>  $wp_coins_used,
                                'wp_coins_opening_balance' =>  $wp_coins_opening_balance,
                                'wp_coins_closing_balance' =>  $wp_coins_closing_balance,
                                'created_on'	=>	date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tbl_messages_history',$data);
                            $insertIDS[] = $this->db->insert_id();
                        }
                    }

                    $finalNumbers = !empty($finalNumbers) ? implode(',',$finalNumbers) : '';
                    if($finalNumbers != "" && !empty($insertIDS)){
                        if(!empty($branch) && $branch->include_wp == '1'){
                            if((int)$branch->current_wp_coins_balance > 0){
                                $response = $this->Salon_model->send_whatsapp_messages_newgateway($finalNumbers,$template_name,$pay_load_components);
                                $sending_status = $response['sending_status'];
                                $api_response = $response['api_response'];
                            }else{
                                $sending_status = 'failed';
                                $api_response = json_encode(
                                    array(
                                        'status'       =>  'failed',
                                        'statusDesc'    =>  'Insufficient coin balance'
                                    )
                                );
                            }
                        }else{
                            $sending_status = 'failed';
                            $api_response = json_encode(
                                array(
                                    'status'       =>  'failed',
                                    'statusDesc'    =>  'Whatsapp notifications not allowed'
                                )
                            );
                        }

                        $update_data = array(
                            'api_response_status'	=>	$sending_status,
                            'api_response'	        =>	$api_response
                        );
                        $this->db->where_in('id',$insertIDS);
                        $this->db->update('tbl_messages_history',$update_data);
                    }

                    return 0;
                }else{
                    return 1;
                }
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }
}
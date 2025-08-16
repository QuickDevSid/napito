<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_controller extends CI_Controller {
	public function get_unique_product_category(){
		$this->Admin_model->get_unique_product_category();
	}
	public function get_unique_product_subcategory(){
		$this->Admin_model->get_unique_product_subcategory();
	}
	public function get_unique_category_type(){
		$this->Admin_model->get_unique_category_type();
	}
	public function get_product_category_sub_categories_ajax(){
		$this->Admin_model->get_product_category_sub_categories_ajax();
	}
	public function get_unique_service(){
		$this->Admin_model->get_unique_service();
	}
	public function get_unique_services_name(){
		$this->Admin_model->get_unique_services_name();
	}
	public function get_all_service_list_genderwise_ajax(){
		$this->Admin_model->get_all_service_list_genderwise_ajax();
	}

	public function get_city_ajax(){
		$this->Admin_model->get_city_ajax();
	}
	public function get_selected_city_ajax(){
		$this->Admin_model->get_selected_city_ajax();
	}
	public function get_city_location_ajax(){
		$this->Admin_model->get_city_location_ajax();
	}
	public function get_selected_state_city() {
        $state = $this->request->getPost('state');
        $cities = $this->Admin_model->get_selected_state_city($state);
        return $this->response->setJSON($cities);
    }
	public function get_unique_email(){
		$this->Admin_model->get_unique_owner_email();
	}
	public function get_unique_subscription_name(){
		$this->Admin_model->get_unique_subscription_name();
    }
	public function get_subscription_typewise_ajx(){
		$this->Admin_model->get_subscription_typewise_ajx();
    }
	public function get_unique_subscription_feature_slug(){
		$this->Admin_model->get_unique_subscription_feature_slug();
    }
	public function get_unique_subscription_feature(){
		$this->Admin_model->get_unique_subscription_feature();
    }
    public function get_unique_facility_name(){
		$this->Master_model->get_unique_facility_name();
    }
    public function get_unique_tips_name(){
		$this->Master_model->get_unique_tips_name();
    }
    public function get_unique_location_name(){
		$this->Master_model->get_unique_location_name();
    }
    public function get_services_ajax(){
		$this->Admin_model->get_services_ajax();
    }
  
	public function get_all_salon_ajx(){
		$this->Admin_model->get_all_salon_ajx();
    }

	public function get_unique_status_name(){
		$this->Admin_model->get_unique_status_name();
	}
	public function get_branch_payment_details_ajx(){
		$this->Admin_model->get_branch_payment_details_ajx();
	}

	public function get_sub_category_by_category(){
		$this->Admin_model->get_sub_category_by_category();
	}
	
	// For sallary Slip

	public function get_already_generated_field_exe_slip_ajx(){
		$this->Admin_model->get_already_generated_field_exe_slip_ajx();
	}
	public function get_employee_present_days_ajx(){
		$this->Admin_model->get_employee_present_days_ajx();
	}
	public function get_datewise_emp_attendance_ajx(){
		$this->Admin_model->get_datewise_emp_attendance_ajx();
	}
	public function get_employee_half_days_ajx(){
		$this->Admin_model->get_employee_half_days_ajx();
	}
	public function get_employee_absent_days_ajx(){
		$this->Admin_model->get_employee_absent_days_ajx();
	}
	public function get_employee_total_loan_ajx(){
		$this->Admin_model->get_employee_total_loan_ajx();
	}
	public function get_unique_salon_email_ajax(){
		$this->Admin_model->get_unique_salon_email_ajax();
	}
	public function get_unique_branch_email_ajax(){
		$this->Admin_model->get_unique_branch_email_ajax();
	}
	public function get_unique_coupan_code(){
		$this->Admin_model->get_unique_coupan_code();
	}
	public function get_uinique_gift_code_ajax(){
		$this->Admin_model->get_uinique_gift_code_ajax();
	}
	public function get_unique_expenses_name(){
		$this->Admin_model->get_unique_expenses_name();
	}
	public function update_emp_selection_setup(){
		$this->Admin_model->update_emp_selection_setup();
	} 
	public function update_slot_time_setup(){
		$this->Admin_model->update_slot_time_setup();
	} 
	public function update_buffering_time_setup(){
		$this->Admin_model->update_buffering_time_setup();
	} 
	public function update_rescheduling_setup(){
		$this->Admin_model->update_rescheduling_setup();
	} 
	public function update_cancellation_setup(){
		$this->Admin_model->update_cancellation_setup();
	} 
	public function update_reward_cancellation_setup(){
		$this->Admin_model->update_reward_cancellation_setup();
	} 
	public function update_booking_range_minute(){
		$this->Admin_model->update_booking_range_minute();
	} 
	public function update_availability_mode_setup(){
		$this->Admin_model->update_availability_mode_setup();
	} 
	public function update_booking_reminder_type_setup(){
		$this->Admin_model->update_booking_reminder_type_setup();
	} 
	public function get_service_price_details_ajax() {
		$this->Admin_model->get_service_price_details_ajax(); 
	}
	public function get_unique_hsn_code() {
		$this->Admin_model->get_unique_hsn_code(); 
	}
	public function get_service_price_for_package_ajax() {
		$this->Admin_model->get_service_price_for_package_ajax(); 
	}

	public function get_unique_product_name() {
		$this->Admin_model->get_unique_product_name(); 
	}
	public function get_customize_message_ajx() {
		$this->Admin_model->get_customize_message_ajx(); 
	}
	public function showWPAddonForm_ajx() {
        $data['setup'] = $this->Master_model->get_backend_setups();
        $value = !empty($data['setup']) ? (int)$data['setup']->wp_low_qty_value : 25;
		$data['branch'] = $this->Admin_model->get_branch_details($this->input->post('id'));
		if(!empty($data['branch'])){ 
			$wp_coins_qty = $data['branch']->wp_coins_qty != "" ? (int)$data['branch']->wp_coins_qty : 0;
			$value = ($value * $wp_coins_qty) / 100;
			if($data['branch']->include_wp == '1' && $data['branch']->current_wp_coins_balance <= $value){
				$data['add_ons'] = $this->Admin_model->get_subscription_whatsapp_addon_plans($data['branch']->subscription_id);
				$data['payment_modes'] = $data['branch']->payment_options != "" ? explode(',', $data['branch']->payment_options) : [];
				$this->load->view('purchase_wp_add_on',$data);
			}
		}
	}
	public function get_customize_message_response_form_ajx() {
		$this->Admin_model->get_customize_message_response_form_ajx(); 
	}
	public function get_customize_message_remark_ajx() {
		$this->Admin_model->get_customize_message_remark_ajx(); 
	}
	public function check_unique_salon_number_ajx() {
		$this->Admin_model->check_unique_salon_number_ajx(); 
	}
	public function check_unique_salon_email_ajx() {
		$this->Admin_model->check_unique_salon_email_ajx(); 
	}
	public function check_gender_reward_ajax() {
		$this->Admin_model->check_gender_reward_ajax(); 
	}
	public function get_saloon_customize_messages_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_saloon_customize_messages_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $print->salon_name;
				$sub_array[] = $print->branch_name;
				$sub_array[] = '<button style="float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showCustomizeMessage('.$print->id.')" data-toggle="modal" data-target="#customMessageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
				$sub_array[] = $print->added_on != "" && $print->added_on != '0000-00-00 00:00:00' && $print->added_on != '1970-01-01 00:00:00' ? date('d M, Y', strtotime($print->added_on)) : '-';
				
				$actions = '';
				if($print->approval_status == '0'){
					$sub_array[] = '<label class="label label-warning"><a style="color:black;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'0\')" data-toggle="modal" data-target="#MessageRemarkModal">Pending</a></label>';
					$actions .= '<button style="float:left;" title="Approve" type="button" class="btn btn-success event-action-button" id="approve_details_button_'.$print->id.'" onclick="showResponse('.$print->id.', \'1\')" data-toggle="modal" data-target="#MessageResponseModal"><i style="color:white;font-size: 15px;margin-left: 0px;" class="fa-solid fa-check"></i></button>';
					$actions .= '<button style="float:left;" title="Reject" type="button" class="btn btn-danger event-action-button" id="reject_details_button_'.$print->id.'" onclick="showResponse('.$print->id.', \'2\')" data-toggle="modal" data-target="#MessageResponseModal"><i style="color:white;font-size: 15px;margin-left: 0px;" class="fa-solid fa-times"></i></button>';
				}elseif($print->approval_status == '1'){
					$sub_array[] = '<label class="label label-success"><a style="text-decoration:underline;color:black;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'1\')" data-toggle="modal" data-target="#MessageRemarkModal">Approved</a></label><br>On: '.date('d-m-Y',strtotime($print->approval_on));
				}elseif($print->approval_status == '2'){
					$sub_array[] = '<label class="label label-danger"><a style="text-decoration:underline;color:black;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'2\')" data-toggle="modal" data-target="#MessageRemarkModal">Rejected</a></label><br>On: '.date('d-m-Y',strtotime($print->rejected_on));
				}elseif($print->approval_status == '3'){
					$sub_array[] = '<label class="label label-primary"><a style="text-decoration:underline;color:black;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'3\')" data-toggle="modal" data-target="#MessageRemarkModal">Cancelled</a></label><br>On: '.date('d-m-Y',strtotime($print->cancelled_on));
				}else{
					$sub_array[] = '-';
				}
	
				$sub_array[] = $actions != "" ? $actions : '-';
	
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_saloon_customize_messages_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_saloon_addon_requests_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_saloon_addon_requests_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$subscription = $this->Admin_model->get_subscription_details($print->subscription_id);
				$subscription_allocation = $this->Admin_model->get_subscription_allocation_details($print->subscription_allocation_id);
				if(!empty($subscription)){
					$subscription_details = '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription->subscription_name;	
				}				
				if(!empty($subscription_allocation)){
					if(!empty($subscription)){
						$subscription_details .= ', Rs. '.$subscription_allocation->subscription_price.'</b></p>' . ($subscription_allocation->include_wp == '1' ? '<br>Whatsapp Coins: ' . $subscription_allocation->wp_coins_qty : '');
					}
					if($subscription_allocation->allocation_status == '0'){
						$subscription_status = '<label class="label label-warning">Inactive</label>';
					}elseif($subscription_allocation->allocation_status == '1'){
						$subscription_status = '<label class="label label-success">Active</label>';
					}elseif($subscription_allocation->allocation_status == '2'){
						$subscription_status = '<label class="label label-primary">Expired</label>';
					}elseif($subscription_allocation->allocation_status == '3'){
						$subscription_status = '<label class="label label-info">Cancelled</label>';
					}elseif($subscription_allocation->allocation_status == '4'){
						$subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
					}elseif($subscription_allocation->allocation_status == '5'){
						$subscription_status = '<label class="label label-primary">Hold</label>';
					}else{
						$subscription_status = '';
					}
					if($subscription_status != ""){
						$subscription_details .= $subscription_status;
					}
				}else{
					if(!empty($subscription)){
						$subscription_details .= '</b></p>';
					}
				}	

				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $print->salon_name;
				$sub_array[] = $print->branch_name;
				$sub_array[] = $subscription_details;
				$sub_array[] = '<b>' . $print->plan_name.'</b><br>Price: Rs. ' . $print->plan_price.'<br>Coins: ' . $print->plan_qty;
				$sub_array[] = $print->created_on != "" && $print->created_on != '0000-00-00 00:00:00' && $print->created_on != '1970-01-01 00:00:00' ? date('d M, Y h:i A', strtotime($print->created_on)) : '-';

				if($print->wp_addon_request_status == '1'){
					$sub_array[] = '<label class="label label-success">Active</label>';
					$requested_plan = $print->add_on_plan_id;
				}else{
					$sub_array[] = '<label class="label label-warning">Inactive</label>' . ($print->inactive_remark != "" ? '<br>Remark: ' . $print->inactive_remark : '');
					$requested_plan = '';
				}
				
				$actions = '';
				$actions .= $requested_plan != "" ? '<button style="" title="Purchase Add On" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->branch_id.'" onclick="showWPAddonForm('.$print->branch_id.','.$requested_plan.')" data-toggle="modal" data-target="#customMessageModal"><i style="" class="fa-solid fa-plus"></i></button>' : '';
				$actions .= '<a onclick="return confirm(\'Are you sure to delete this record?\');" href="'.base_url().'delete/'.$print->id.'/tbl_wp_addon_requests" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>';
									
				$sub_array[] = $actions != "" ? $actions : '-';
	
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_saloon_addon_requests_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_branch_payments_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_branch_payments_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$subscription = $this->Admin_model->get_subscription_details($print->subscription_id);
				$subscription_allocation = $this->Admin_model->get_subscription_allocation_details($print->subscription_allocation_id);
				$subscription_details = '';						
				if($print->payment_type == '0'){
					$payment_type = '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">Subscription Payment</p>';
					if(!empty($subscription)){
						$payment_type .= '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription->subscription_name;
						$subscription_details .= '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription->subscription_name;
					}
					if(!empty($subscription_allocation)){
						if(!empty($subscription)){
							$payment_type .= ', Rs. '.$subscription_allocation->subscription_price.'</b></p>';
							$subscription_details .= ', Rs. '.$subscription_allocation->subscription_price.'</b></p>';
						}
						if($subscription_allocation->allocation_status == '0'){
							$subscription_status = '<label class="label label-warning">Inactive</label>';
						}elseif($subscription_allocation->allocation_status == '1'){
							$subscription_status = '<label class="label label-success">Active</label>';
						}elseif($subscription_allocation->allocation_status == '2'){
							$subscription_status = '<label class="label label-primary">Expired</label>';
						}elseif($subscription_allocation->allocation_status == '3'){
							$subscription_status = '<label class="label label-info">Cancelled</label>';
						}elseif($subscription_allocation->allocation_status == '4'){
							$subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
						}elseif($subscription_allocation->allocation_status == '5'){
							$subscription_status = '<label class="label label-primary">Hold</label>';
						}else{
							$subscription_status = '';
						}
						if($subscription_status != ""){
							$payment_type .= $subscription_status;
							$subscription_details .= $subscription_status;
						}
					}else{
						if(!empty($subscription)){
							$payment_type .= '</b></p>';
							$subscription_details .= '</b></p>';
						}
					}
				}elseif($print->payment_type == '1'){
					$payment_type = '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">Whatsapp Add On Payment</p>';
					$subscription_details .= '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$print->plan_name . ' Rs. '.$print->payment_amount.'</b></p>';
				}else{
					$payment_type = '-';
					$subscription_details = '-';
				}

				$style = '';
				$title = '';
				if($print->branch_is_deleted == '1'){
					$style= 'style="background-color:#ffb3b3; color:black; padding: 5px;"';
					$title= 'title="Deleted Branch"';
				}

				$sub_array = array();
				$sub_array[] = $offset++;
				if($this->input->post('branch') == ""){
					$sub_array[] = $print->salon_name;
					$sub_array[] = '<div '.$style.' '.$title.'>'.$print->branch_name.'</div>';
				}
				if($this->input->post('salon') == ""){
					$sub_array[] = $payment_type;
				}else{
					$sub_array[] = $subscription_details;
				}
				
				$sub_array[] = $print->coin_balance_used != "" ? $print->coin_balance_used : '-';
				$sub_array[] = $print->coin_balance_used_in_rs != "" ? number_format((float)($print->coin_balance_used_in_rs), 2, '.', ',').'<br><small>(Rs. ' . $print->per_coin_rs_value . ' Per Coin)</small>' : '-';
				$sub_array[] = $print->opening_due != "" ? number_format((float)($print->opening_due), 2, '.', ',') : '0.00';
				$sub_array[] = $print->payment_amount != "" ? number_format((float)($print->payment_amount), 2, '.', ',') : '0.00';
				$sub_array[] = $print->closing_due != "" ? number_format((float)($print->closing_due), 2, '.', ',') : '0.00';
				
				$gst_text = '';
				if($print->is_gst_applicable == '1'){
					if($print->cgst_rate != '' && $print->cgst_rate > 0){
						$gst_text .= 'CGST <small>(' . number_format((float)($print->cgst_rate), 2, '.', ',') . '%)</small>: ' . number_format((float)($print->cgst), 2, '.', ',') . '<br>';
					}
					if($print->sgst_rate != '' && $print->sgst_rate > 0){
						$gst_text .= 'SGST <small>(' . number_format((float)($print->sgst_rate), 2, '.', ',') . '%)</small>: ' . number_format((float)($print->sgst), 2, '.', ',') . '<br>';
					}
					if($print->igst_rate != '' && $print->igst_rate > 0){
						$gst_text .= 'IGST <small>(' . number_format((float)($print->igst_rate), 2, '.', ',') . '%)</small>: ' . number_format((float)($print->igst), 2, '.', ',') . '<br>';
					}
				}else{
					$gst_text = '0.00';
				}
				$sub_array[] = $gst_text;
				
				$sub_array[] = $print->final_amount != "" ? number_format((float)($print->final_amount), 2, '.', ',') : ($print->payment_amount != "" ? number_format((float)($print->payment_amount), 2, '.', ',') : '0.00');
				$sub_array[] = $print->payment_date != "" && $print->payment_date != '0000-00-00' && $print->payment_date != '1970-01-01' ? date('d M, Y', strtotime($print->payment_date)) : '-';
				if($this->input->post('salon') == ""){
					$sub_array[] = $print->full_name;
				}
				$sub_array[] = date('d M, Y h:i A',strtotime($print->created_on));
				$sub_array[] = '<a target="_blank" href="' . base_url() . 'payment_receipt/' . base64_encode($print->id) . '" class="btn btn-info">Receipt</a>';
					
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_branch_payments_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_cron_report_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_cron_report_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = date('d M, Y h:i A',strtotime($print->created_on));
				if($print->sent_on == '1'){
					$sub_array[] = '<a href="' . base_url() . 'notifications-message-report?cron_id=' . $print->id . '" class="btn btn-info">View</a>';	
				}elseif($print->sent_on == ''){
					$sub_array[] = '-';
				}else{
					$sub_array[] = '<a href="' . base_url() . 'whatsapp-message-report?cron_id=' . $print->id . '" class="btn btn-info">View</a>';	
				}						
				$sub_array[] = $print->description != "" ? $print->description : '-';
				$sub_array[] = $print->response != "" ? $print->response : '-';
					
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_cron_report_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_saloon_branch_rule_update_requests_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = isset($search['value']) ? $search['value'] : '';
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_saloon_branch_rule_update_requests_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $print->store_type_text;

				$rules_fields = explode('@@@', $print->booking_rule_field); 
				$new_values_fields = explode('@@@', $print->change_to_label); 
				$old_values_fields = explode('@@@', $print->change_from_label); 
				$rules_desc = '';
				if($print->field_main_label != ""){
					$rules_desc .= '<p style="color:#000;"><b>'.str_replace('*', '', $print->field_main_label).'</b></p>';
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
				$sub_array[] = $rules_desc;

				$sub_array[] = date('d-m-Y h:i A',strtotime($print->submitted_on));

				if($print->approval_status == '0'){
					$sub_array[] = '<label class="label label-warning">Pending</label>';
				}elseif($print->approval_status == '1'){
					$Approved = '<label class="label label-success">Approved</label>';
					if($print->accepted_on != ""){
						$Approved .= '<br>On: '.date('d-m-Y h:i A',strtotime($print->accepted_on));
					}
					$sub_array[] = $Approved;
				}elseif($print->approval_status == '2'){
					$Rejected = '<label class="label label-danger">Rejected</label>';
					if($print->rejected_on != ""){
						$Rejected .= '<br>On: '.date('d-m-Y h:i A',strtotime($print->rejected_on));
					}
					$sub_array[] = $Rejected;
				}else{
					$sub_array[] = '-';
				}
				
				if($print->approval_status == '0'){
					$action = '<button class="btn btn-success" title="Approve" id="response_button_'.$print->id.'" onclick="setResponse('.$print->id.', \'1\','.$print->branch_id.')"><i class="fas fa-check"></i></button>';
					$action .= '<button class="btn btn-danger" title="Reject" id="response_button_'.$print->id.'" onclick="setResponse('.$print->id.', \'2\','.$print->branch_id.')"><i class="fas fa-times"></i></button>';
				}else{
					$action = '-';
				}
				$sub_array[] = $action;
					
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_saloon_branch_rule_update_requests_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_request_response_form(){
		$this->Admin_model->get_request_response_form();
	} 
	public function get_saloon_rule_update_requests_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		
		$document = $this->Admin_model->get_saloon_rule_update_requests_ajx($length, $start, $search);
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $print->salon_name;
				$sub_array[] = $print->branch_name;
				$sub_array[] = '<a style="color:black !important;text-decoration:underline;float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="All Requests" class="btn btn-primary event-action-button" id="service_details_all_button_'.$print->branch_id.'" href="'.base_url().'store-rule-update-requests?branch='.$print->branch_id.'&status=">' . count($this->Admin_model->get_salon_rule_update_requestes($print->branch_id,'')) . ' Request</a>';
				$sub_array[] = '<a style="color:black !important;text-decoration:underline;float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Pending Requests" class="btn btn-primary event-action-button" id="service_details_pending_button_'.$print->branch_id.'" href="'.base_url().'store-rule-update-requests?branch='.$print->branch_id.'&status=0">' . count($this->Admin_model->get_salon_rule_update_requestes($print->branch_id,'0')) . ' Request</a>';
				$sub_array[] = '<a style="color:black !important;text-decoration:underline;float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Approved Requests" class="btn btn-primary event-action-button" id="service_details_approved_button_'.$print->branch_id.'" href="'.base_url().'store-rule-update-requests?branch='.$print->branch_id.'&status=1">' . count($this->Admin_model->get_salon_rule_update_requestes($print->branch_id,'1')) . ' Request</a>';
				$sub_array[] = '<a style="color:black !important;text-decoration:underline;float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Rejected Requests" class="btn btn-primary event-action-button" id="service_details_rejected_button_'.$print->branch_id.'" href="'.base_url().'store-rule-update-requests?branch='.$print->branch_id.'&status=2">' . count($this->Admin_model->get_salon_rule_update_requestes($print->branch_id,'2')) . ' Request</a>';
					
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_saloon_rule_update_requests_ajx_count($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_salon_rule_update_requests_ajx(){
		$this->Admin_model->get_salon_rule_update_requests_ajx();
	}
	public function get_final_remark_popup(){
		$this->Admin_model->get_final_remark_popup();
	}
	public function get_query_resolution_history_popup(){
		$this->Admin_model->get_query_resolution_history_popup();
	}
	public function get_all_salon_branch_ajx(){
		$this->Admin_model->get_all_salon_branch_ajx($this->input->post('salon'));
	}
	public function update_service_category_order(){
		$this->Admin_model->update_service_category_order();
	}
	public function update_product_category_order(){
		$this->Admin_model->update_product_category_order();
	}
	public function update_product_subcategory_order(){
		$this->Admin_model->update_product_subcategory_order();
	}
	public function update_service_subcategory_order(){
		$this->Admin_model->update_service_subcategory_order();
	}
	public function update_service_order(){
		$this->Admin_model->update_service_order();
	}
	public function check_unique_email_ajax(){
		$this->Admin_model->check_unique_email_ajax();
	}
	public function get_customer_queries_ajx(){
		$draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
        $dir = "";
		if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }
		if($dir != "asc" && $dir != "desc"){
            $dir = "desc";
        }		
		$customer = $this->input->post('customer');
		$ticket = $this->input->post('ticket');
		$category = $this->input->post('category');
		$status = $this->input->post('status');
		$salon = $this->input->post('salon');
		$branch = $this->input->post('branch');
		$document = $this->Admin_model->get_all_customer_queries_list($length, $start, $search, $customer, $ticket, $category, $status, $branch, $salon);
		
        $data = array();
        if(!empty($document)){
			$page = $start / $length + 1;
    	$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				if($print->final_resolution_status != 1){
					$sub_array[] = '
									<a data-toggle="modal" data-target="#basicModal2" onclick="return click_popup_replay('.$print->id.',/'.$print->support_id.'/)" title="Resolution History" class="btn btn-info"><i class="fa fa-history"></i></a>
									<a data-toggle="modal" data-target="#basicModal" onclick="return click_popup('.$print->id.',/'.$print->support_id.'/)" title="Final Remark" class="btn btn-primary"><i class="fa fa-comment"></i></a>
									<a onclick="return confirm(\'Are you sure to delete this record?\');" href="'.base_url().'delete/'.$print->id.'/tbl_customer_support" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>
								';
				}else{
					$sub_array[] = '
									<a data-toggle="modal" data-target="#basicModal2" onclick="return click_popup_replay('.$print->id.',/'.$print->support_id.'/)" title="Resolution History" class="btn btn-info"><i class="fa fa-history"></i></a>
									<a onclick="return confirm(\'Are you sure to delete this record?\');" href="'.base_url().'delete/'.$print->id.'/tbl_customer_support" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>
								';
				}
				if($print->final_resolution_status == 1){
					$sub_array[] = '<span class="label label-success">Closed</span>';
				}elseif($print->final_resolution_status == 0){
					$sub_array[] = '<span class="label label-danger">Pending</span>';
				}else{
					$sub_array[] = '<span class="label label-warning">In Process</span>';
				}
				$sub_array[] = $print->support_id;
				$sub_array[] = $print->full_name;
				$sub_array[] = $print->customer_phone;
				$sub_array[] = $print->email;
				$sub_array[] = $print->branch_name.', '.$print->salon_name;
				$sub_array[] = '
					<a class="btn btn-primary" data-toggle="modal" data-target="#basicModal_new_'.$print->id.'">View</a>
					<div class="modal fade" id="basicModal_new_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="basicModal_new_'.$print->id.'" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h2 class="modal-title" id="myModalLabel_'.$print->id.'">Description</h2>
								</div>
								<div class="modal-body py-5 px-5" id="response_2_'.$print->id.'">
									<p>'.$print->description.'</p>
								</div>
							</div>
						</div>
					</div>
					';
				$sub_array[] = $print->reason;
				$sub_array[] = date('d-m-Y h:i A', strtotime($print->created_on));
				if($print->attachments != ""){
					$sub_array[] = '
						<a class="btn btn-primary" target="_blank" href="'.base_url().'admin_assets/images/customer_queries/'.$print->attachments.'">View</a>
					';
				}else{
					$sub_array[] = "NA";
				}
				if($print->final_resolution_status == "1"){
					$sub_array[] = '
						<a class="btn btn-primary" data-toggle="modal" data-target="#basicModal_new_1_'.$print->id.'">View</a>
						<div class="modal fade" id="basicModal_new_1_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="basicModal_new_1_'.$print->id.'" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h2 class="modal-title" id="myModalLabel_new_'.$print->id.'">Final Remark</h2>
									</div>
									<div class="modal-body py-5 px-5" id="response_2_new_'.$print->id.'">
										<p>'.$print->final_remark.'</p>
									</div>
								</div>
							</div>
						</div>
						';
				}else{
					$sub_array[] = '';
				}
				if($print->final_resolution_status == "1"){
					$sub_array[] = date('d-m-Y h:i A', strtotime($print->final_remark_date));
				}else{
					$sub_array[] = "NA";
				}
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_all_customer_queries_list_count($search, $customer, $ticket, $category, $status, $branch, $salon);
		
        $output = array(
            "draw" 				=> $draw,
            "recordsTotal" 		=> $TotalProducts,
            "recordsFiltered" 	=> $TotalProducts,
            "data" 				=> $data
        );
        echo json_encode($output);
        exit();
	}
	public function get_salon_survey_ajx(){
		$draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
        $dir = "";
		if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }
		if($dir != "asc" && $dir != "desc"){
            $dir = "desc";
        }		

		$document = $this->Survey_model->get_salon_survey_list($length, $start, $search);
		
        $data = array();
        if(!empty($document)){
			$page = $start / $length + 1;
    		$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$is_valid = '0';
				if($print->no_of_chairs >= 3){
					if($print->no_of_people >= 3){
						$is_valid = '1';
					}
				}
				
				$rate_table = '<table class="table">
								<thead>
									<tr>
										<th>Service</th>
										<th>Rate <small>(In INR)</small></th>
									</tr>
								</thead>    
								<tbody>';
					if($print->rate_haircut != ""){
						$rate_table .= '<tr>
							<td>HAIRCUT</td>
							<td>' . $print->rate_haircut . '</td>
						</tr>';
					}
					if($print->rate_beard != ""){
						$rate_table .= '<tr>
							<td>Beard</td>
							<td>' . $print->rate_beard . '</td>
						</tr>';
					}
					if($print->rate_wax != ""){
						$rate_table .= '<tr>
							<td>Wax</td>
							<td>' . $print->rate_wax . '</td>
						</tr>';
					}
					if($print->rate_eyebrows != ""){
						$rate_table .= '<tr>
							<td>Eyebrows</td>
							<td>' . $print->rate_eyebrows . '</td>
						</tr>';
					}

				$rate_table .= '</tbody>
							</table>';

				$service_rate = '<a style="cursor:pointer;text-decoration:underline;color:blue;" data-toggle="modal" data-target="#basicModal_new_1_'.$print->id.'">View</a>
						<div class="modal fade" id="basicModal_new_1_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="basicModal_new_1_'.$print->id.'" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h2 class="modal-title" id="myModalLabel_new_'.$print->id.'">Service Rates</h2>
									</div>
									<div class="modal-body py-5 px-5" id="response_2_new_'.$print->id.'">
										'.$rate_table.'
									</div>
								</div>
							</div>
						</div>';

				$address = '<a style="text-decoration:underline;color:blue;cursor:pointer;" data-toggle="modal" data-target="#basicModal_address_'.$print->id.'">View</a>
						<div class="modal fade" id="basicModal_address_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="basicModal_address_'.$print->id.'" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h2 class="modal-title" id="myModalLabel_new_'.$print->id.'">Salon Address</h2>
									</div>
									<div class="modal-body py-5 px-5" id="response_address_'.$print->id.'">
										<p>'.$print->salon_address.'</p>
										' . ($print->street_name != "" ? '<br><label>Street: ' . $print->street_name.'</label>' : '') . '
										' . ($print->area != "" ? '<br><label>Area: ' . $print->area.'</label>' : '') . '
									</div>
								</div>
							</div>
						</div>';

				$location_name = $this->Admin_model->get_location($print->location);
				$sub_array = array();

				if ($this->session->userdata('user_type') == "0") {
					$sub_array[] = $offset++;
					$action = '<a style="padding: 3px 6px;" href="' . base_url() . 'survey/' . $print->id . '?edit" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
					if ($print->valid_invalid == '0') {
						$action .= '<a style="padding: 3px 6px;" onclick="return confirm(\'Are you sure you want to mark this as Not Accept?\')" title="Not Accept" href="' . base_url() . 'invalid-lead/' . $print->id . '" class="btn btn-warning"><i class="fas fa-times-circle"></i></a>';
					} else {
						$action .= '<a style="padding: 3px 6px;" onclick="return confirm(\'Are you sure you want to mark this as Accept?\')" title="Accept" href="' . base_url() . 'valid-lead/' . $print->id . '" class="btn btn-success"><i class="fas fa-check-circle"></i></a>';
					}

					$sub_array[] = $action;
					if ($print->valid_invalid == '0') {
						$sub_array[] = '<i class="fas fa-check-circle" style="color: green;cursor:pointer;" title="Accept"></i>';
					} else {
						$sub_array[] = '<i class="fas fa-times-circle" style="color: red;cursor:pointer;" title="Not Accept"></i>';
					}
					
					if($print->salon_category == 'Standard'){
						$salon_category = '<i title="Standard" style="color:black;cursor:pointer;" class="fas fa-star"></i><br>Standard';
					}elseif($print->salon_category == 'Premium'){
						$salon_category = '<i title="Premium" style="color:black;cursor:pointer;" class="fas fa-crown"></i><br>Premium';
					}elseif($print->salon_category == 'Competitor'){
						$salon_category = '<i title="Competitor" style="color:black;cursor:pointer;" class="fas fa-users"></i><br>Competitor';
					}elseif($print->salon_category == 'Basic'){
						$salon_category = '<i title="Basic" style="color:black;cursor:pointer;" class="fas fa-hourglass-half"></i><br>Basic';
					}else{
						$salon_category = '-';
					}

					// $sub_array[] = $print->salon_category;
					// $sub_array[] = $salon_category;

					$sub_array[] = date('d-m-Y h:i A',strtotime($print->created_on));
					if($print->salon_type == '0'){
						$salon_type = 'Male';
					}elseif($print->salon_type == '0'){
						$salon_type = 'Female';
					}elseif($print->salon_type == '2'){
						$salon_type = 'Unisex';
					}else{
						$salon_type = '-';
					}
					// $sub_array[] = $print->executive_name;
					// $sub_array[] = $salon_type;
					$sub_array[] = $print->salon_name != "" ? $print->salon_name : '-';
					$sub_array[] = $address;
					// $sub_array[] = !empty($location_name) ? $location_name->name.', '.$location_name->city_name.', '.$location_name->state_name : '-';
					
					$sub_array[] = $print->service_provide_type != "" ? $print->service_provide_type : '-';
					
					if($print->billing_counter == 'Yes'){
						if($print->receptionist_available == 'Yes'){
							$billing_counter = 'Receptionist';
						}else{
							$billing_counter = 'Yes';
						}
					}else{
						$billing_counter = 'No';
					}
					$sub_array[] = $billing_counter;
					$sub_array[] = $print->no_of_people;
					$sub_array[] = $print->no_of_chairs;
					// $sub_array[] = $print->celebrities != "" ? $print->celebrities : '-';
					$sub_array[] = $service_rate != "" ? $service_rate : '-';
					$sub_array[] = $print->salon_owner_name != "" ? $print->salon_owner_name : '-';
					$sub_array[] = $print->salon_owner_contact != "" ?  $print->salon_owner_contact : '-';
					// $sub_array[] = $print->salon_owner_free_on;
					$sub_array[] = $print->selfie != "" ? '<a href="'.base_url().'admin_assets/images/survey/'.$print->selfie.'" style="color:blue;text-decoration:underline;" target="_blank">View</a>' : '-';
				} else { 
					if ($this->session->userdata('admin_id') == $print->added_by_id) {
						$entry_data = $this->Survey_model->get_last_entry_data();
						$sub_array[] = $offset++;
						$sub_array[] = $print->salon_name != "" ? $print->salon_name : '-';
						$is_last_entry = ($entry_data->id == $print->id);
						$sub_array[] = ($is_last_entry) ? '<a href="' . base_url() . 'survey/' . $print->id . '" class="btn btn-primary">Edit</a>' : '-';
					}
				}
				if (!empty($sub_array)) {
					$data[] = $sub_array;
				}
			}
		}
		$TotalProducts = $this->Survey_model->get_salon_survey_list_count($search);
        $output = array(
            "draw" 				=> $draw,
            "recordsTotal" 		=> $TotalProducts,
            "recordsFiltered" 	=> $TotalProducts,
            "data" 				=> $data
        );
        echo json_encode($output);
        exit();
	}
	public function get_all_complaint_reason_ajx(){
		$draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
        $dir = "";
		if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }
		if($dir != "asc" && $dir != "desc"){
            $dir = "desc";
        }		
		$document = $this->Admin_model->get_all_complaint_list($length,$start,$search);
		
        $data = array();
        if(!empty($document)){
			$page = $start / $length + 1;
    	$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $print->reason;
				$sub_array[] = '
								<a href="'.base_url().'add-ticket-category/'.$print->id.'"  title="Edit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
								<a onclick="return confirm(\'Are you sure to delete this record?\');" href="'.base_url().'delete/'.$print->id.'/tbl_complaint_reason" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>
							';
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_all_complaint_list_count($search);
		
        $output = array(
            "draw" 				=> $draw,
            "recordsTotal" 		=> $TotalProducts,
            "recordsFiltered" 	=> $TotalProducts,
            "data" 				=> $data
        );
        echo json_encode($output);
        exit();
	}
	public function get_unique_name_ajax(){
		$this->Admin_model->get_unique_name_ajax();
	}
	public function get_gender_categories_ajax(){
		$this->Admin_model->get_gender_categories_ajax();
	}
	public function get_unique_sup_category(){
		$this->Admin_model->get_unique_sup_category();
	}
	public function get_dashboard_counts_ajx(){
		$this->Admin_model->get_dashboard_counts_ajx();
	} 
	public function reset_expired_subscriptions_ajx(){
		$this->Admin_model->reset_expired_subscriptions();
	} 
	public function get_app_users_ajx(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order)){
			foreach($order as $o){
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}
		if($dir != "asc" && $dir != "desc"){
			$dir = "desc";
		}		

		$document = $this->Admin_model->get_app_users_list_ajx($length, $start, $search);
		// echo '<pre>'; print_r($document); exit;
		$data = array();
		if(!empty($document)){
			$page = $start / $length + 1;
			$offset = ($page - 1) * $length + 1;
			foreach($document as $print){
				if($print->is_active_login == '1'){
					$login_details = '<span class="badge badge-success" style="background-color: green;">Active</span>';
					// $login_details .= $print->last_login_on != "" ? '<br>Last Login On: '.date('d M, Y h:i A',strtotime($print->last_login_on)) : '';
				}else{
					$login_details = '<span class="badge badge-danger" background-color: orange;>Inactive</span>';
					$login_details .= $print->last_logout_on != "" ? '<br><small>Logout On:<br>'.date('d M, Y h:i A',strtotime($print->last_logout_on)).'</small>' : '';
				}
				
				$project = $print->project;

				$sub_array = array();
				$sub_array[] = $offset++;
				$sub_array[] = $login_details;
				$sub_array[] = $print->last_login_on != "" ? date('d M, Y h:i A',strtotime($print->last_login_on)) : '';
				// $sub_array[] = $project;
				$sub_array[] = $print->username;
				$sub_array[] = ($print->name != "" ? '<p><b>Name:</b> '.$print->name.'</p>' : '') . '' . ($print->mobile_no != "" ? '<p><b>Mobile:</b> '.$print->mobile_no.'</p>' : '') . '' . ($print->email != "" ? '<p><b>Email:</b> '.$print->email.'</p>' : '');
				$sub_array[] = $print->device_id;
				$device_Details_table = '
					<button type="button" onclick="showDevicePopup(\'exampleModal_'.$print->id.'\')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_'.$print->id.'">
						View
					</button>
					<div class="modal fade" id="exampleModal_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_'.$print->id.'" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel_'.$print->id.'">Device Details</h5>
									<button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeDevicePopup(\'exampleModal_'.$print->id.'\')">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<table class="device_Details_table table table-bordered">
										<thead>
											<tr>
												<th>Key</th>
												<th>Value</th>
											</tr>
										</thead>
										<tbody>';

					$device_details = json_decode($print->device_details, true);
					foreach ($device_details as $key => $value) {
						$display_name = ucwords(str_replace('_', ' ', $key));
						$device_Details_table .= '<tr>
													<td><strong>' . htmlspecialchars($display_name) . '</strong></td>
													<td>' . ($value !== null ? htmlspecialchars($value) : 'N/A') . '</td>
												</tr>';
					}

					$device_Details_table .= '    </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<script>
					$(document).ready(function() {
						// Initialize DataTable when the modal is shown
						$("#exampleModal_'.$print->id.'").on("shown.bs.modal", function() {
							$(this).find(".device_Details_table").DataTable({ 
								dom: "Blfrtip",
								lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
								buttons: [				
									{
										extend: "excel",
										filename: "Device Details",
										exportOptions: {
											columns: [0, 1] 
										}
									},	
								],
								destroy: true // Allow reinitialization
							});
						});
					});
					</script>';
				$sub_array[] = $device_Details_table;
				$permission_Details_table = '
					<button type="button" onclick="showLocationPopup(\'examplePermissionModal_'.$print->id.'\')" class="btn btn-primary" data-toggle="modal" data-target="#examplePermissionModal_'.$print->id.'">
						View
					</button>
					<div class="modal fade" id="examplePermissionModal_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="examplePermissionModalLabel_'.$print->id.'" aria-hidden="true">
						<div class="modal-dialog" role="document" style="width: 750px;">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="examplePermissionModalLabel_'.$print->id.'">Permission Details</h5>
									<button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeLocationPopup(\'examplePermissionModal_'.$print->id.'\')">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<table class="permission_details_table table table-bordered">
										<thead>
											<tr>
												<th>Permission</th>
												<th>Is Required</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>';

					$permission_details = json_decode($print->permission_details, true);
					foreach ($permission_details as $permission) {
						$permission_name = htmlspecialchars($permission['permission']);
						$is_required = isset($permission['is_required']) ? htmlspecialchars($permission['is_required']) : '-';
						$status = htmlspecialchars($permission['status']);
						
						$permission_Details_table .= '<tr>
											<td>' . $permission_name . '</td>
											<td>' . $is_required . '</td>
											<td>' . $status . '</td>
										</tr>';
					}

					$permission_Details_table .= '    </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<script>
					$(document).ready(function() {
						$("#examplePermissionModal_'.$print->id.'").on("shown.bs.modal", function() {
							$(this).find(".permission_details_table").DataTable({ 
								dom: "Blfrtip",
								lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
								buttons: [				
									{
										extend: "excel",
										filename: "Permission Details",
										exportOptions: {
											columns: [0, 1, 2] 
										}
									},	
								],
								destroy: true // Allow reinitialization
							});
						});
					});
					</script>';
				$sub_array[] = $permission_Details_table;
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Admin_model->get_app_users_count_ajx($search);
		
		$output = array(
			"draw" 				=> $draw,
			"recordsTotal" 		=> $TotalProducts,
			"recordsFiltered" 	=> $TotalProducts,
			"data" 				=> $data
		);
		echo json_encode($output);
		exit();
	}
	public function get_tips_other_titles_ajx() {
		$this->Master_model->get_tips_other_titles_ajx(); 
	}

	public function get_all_help_management_list_ajax()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $document = $this->Master_model->get_all_help_management_list_ajax($length, $start, $search);
        $data = array();
        if (!empty($document)) {
            $zz = 1;
            foreach ($document as $print) {
                $sub_array = array();
                $sub_array[] = $zz++;
                $sub_array[] = $print->help_title;

				if($print->website_type == '0'){
					$sub_array[] = 'website';
				}else if($print->website_type == '1'){
					$sub_array[] = 'Business';
				}
                $sub_array[] = $print->help_description;
                $sub_array[] = $print->status == '1' ? 'Active' : 'Inactive';
             
                $action = '';
                if ($print->status == "1") {
                    $action .= '<a class="btn btn-info inactive_btn" href="' . base_url() . 'inactive/' . $print->id . '/tbl_help_management"  onclick="return confirm(\'Are you sure you want to inactivate this record?\');"><i class="fa-solid fa-xmark"></i></a>';
                } else {
                    $action .= '<a class="btn btn-warning active_btn" href="' . base_url() . 'active/' . $print->id . '/tbl_help_management"  onclick="return confirm(\'Are you sure you want to activate this record?\');"><i class="fa-solid fa-check"></i></a>';
                }
                $action .= '<a class="btn btn-danger table_btn" href="' . base_url() . 'delete/' . $print->id . '/tbl_help_management"  onclick="return confirm(\'Are you sure you want to delete this record permanently?\');"><i class="fa-solid fa-trash"></i></a>';
                $action .= '<a class="btn btn-success table_btn" href="' . base_url() . 'app-help-management/' . $print->id . '"><i class="fa-solid fa-pencil"></i></a>';
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
        }
        $TotalProducts = $this->Master_model->get_all_help_management_list_ajax_count($search);
        $output = array(
            "draw"                 => $draw,
            "recordsTotal"         => $TotalProducts,
            "recordsFiltered"     =>  $TotalProducts,
            "data"                 => $data
        );
        echo json_encode($output);
        exit();
    }

    public function get_unique_help_title(){
        $this->Admin_model->get_unique_help_title();
    }
	public function get_unique_whatsapp_addon_plan_name(){
        $this->Admin_model->get_unique_whatsapp_addon_plan_name();
	}
	public function get_unique_whatsapp_addon_plan_qty(){
        $this->Admin_model->get_unique_whatsapp_addon_plan_qty();
	}
}    
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_controller extends CI_Controller { 
	public function get_sub_category_ajax(){
		$this->Salon_model->get_sub_category_ajax();
	}
	public function get_city_ajax(){
		$this->Salon_model->get_city_ajax();
	}
	public function get_selected_state_city() {
        $state = $this->request->getPost('state');
        $cities = $this->Salon_model->get_selected_state_city($state);
        return $this->response->setJSON($cities);
    }
	public function get_service_details_for_booking_ajax() {
        $this->Salon_model->get_service_details_for_booking_ajax();
    }
	public function get_unique_color_status_details_ajax() {
        $this->Salon_model->get_unique_color_status_details_ajax();
    }
	public function get_uinique_gift_code_ajax() {
        $this->Salon_model->get_uinique_gift_code_ajax();
    }
	public function check_unique_shift() {
        $this->Salon_model->check_unique_shift();
    }
	public function reschedule_booking_ajax() {
        $this->Salon_model->reschedule_booking_ajax();
    }
	public function get_saloon_shifts_typewise_ajax() {
        $this->Salon_model->get_saloon_shifts_typewise_ajax();
    }

	public function check_reward_point_ajax() {
        $this->Salon_model->check_reward_point_ajax();
    }
	public function get_service_info_details_ajax() {
        $this->Salon_model->get_service_info_details_ajax();
    }
	public function get_all_booking_list_for_selecteddate_ajax() {
        $this->Salon_model->get_all_booking_list_for_selecteddate_ajax();
    }
	public function get_product_details_for_booking_ajax() {
        $this->Salon_model->get_product_details_for_booking_ajax();
    }
	public function get_service_details_for_price_set_ajax() {
        $this->Salon_model->get_service_details_for_price_set_ajax();
    }
	public function get_service_selected_shift_ajax() {
        $this->Salon_model->get_service_selected_shift_ajax();
    }
	public function get_booking_by_time_ajax() {
        $this->Salon_model->get_booking_by_time_ajax();
    }
	public function get_booking_by_time_and_date_ajax() {
        $this->Salon_model->get_booking_by_time_and_date_ajax();
    }
	public function get_booking_by_date_ajax() {
        $this->Salon_model->get_booking_by_date_ajax();
    }
    public function get_shift_name_for_employee() {
        $this->Salon_model->get_shift_name_for_employee();
    }
	public function get_unique_designation(){
		$this->Salon_model->get_unique_designation();
	}
	public function get_unique_supplier(){
		$this->Salon_model->get_unique_supplier();
	}
	public function get_default_services_ajax(){
		$this->Salon_model->get_default_services_ajax();
	}
	public function get_unique_coupan_code(){
		$this->Salon_model->get_unique_coupan_code();
	}
	public function get_unique_expenses_name(){
		$this->Admin_model->get_unique_expenses_name();
	}
	public function get_unique_customer_mobile(){
		$this->Salon_model->get_unique_customer_mobile();
	}
	public function get_sub_category(){
		$res=$this->Salon_model->get_sub_category($this->input->post('category'));
		echo json_encode($res);
    }
	
	public function get_unique_product_category() {
		$this->Salon_model->get_unique_product_category();
	   
   }
   public function get_unique_product_unit() {
	$this->Salon_model->get_unique_product_unit();
   
}
public function get_unique_hsn_code() {
	$this->Salon_model->get_unique_hsn_code();
   
}
public function get_unique_barcode_id() {
	$this->Salon_model->get_unique_barcode_id();
   
}
public function get_service_price_details_ajax() {
	$this->Salon_model->get_service_price_details_ajax();
   
}
public function get_product_details_div_ajx() {
	$this->Salon_model->get_product_details_div_ajx();
}
public function get_product_stock_deytails_ajax() {
	$this->Salon_model->get_product_stock_deytails_ajax();
   
}

public function get_product_detail_for_stock_ajax() {
	$this->Salon_model->get_product_detail_for_stock_ajax();
   
}
	public function get_employee_by_shift_name_ajx() {
		$this->Salon_model->get_employee_by_shift_name_ajx();
	   
   }
   public function get_emp_by_shift_name_ajx() {
	$this->Salon_model->get_emp_by_shift_name_ajx();
   
}
   public function get_work_shedule_ajax() {
	$this->Salon_model->get_work_shedule_ajax();
   
}
   public function get_stylist_details_ajax() {
	$this->Salon_model->get_stylist_details_ajax();
  }
  public function get_product_for_package_ajax() {
	$this->Salon_model->get_service_product_for_package_ajax();
  }
   public function get_customer_details_ajax() {
	$this->Salon_model->get_customer_details_ajax();
   }
   public function get_customer_all_details_ajax() {
	$this->Salon_model->get_customer_all_details_ajax();
   }
   public function get_customer_membership_details_ajax() {
	$this->Salon_model->get_customer_membership_details_ajax();
   }
   public function get_customer_package_details_ajax() {
	$this->Salon_model->get_customer_package_details_ajax();
   }
   public function get_customer_details_for_booking_ajax() {
	$this->Salon_model->get_customer_details_for_booking_ajax();
   }
   public function get_reward_setup_ajx() {
	$this->Salon_model->get_reward_setup_ajx();
   }
   public function get_saloon_working_hrs_slots() {
	$this->Salon_model->get_saloon_working_hrs_slots();
   }
   public function get_booking_service_details_ajx() {
	$this->Salon_model->get_booking_service_details_ajx();
   }
   public function get_booking_details_ajx() {
	$this->Salon_model->get_booking_details_ajx();
   }
   public function get_booking_note_ajx() {
	$this->Salon_model->get_customer_note_ajx();
   }
   public function get_booking_review_ajx() {
	$this->Salon_model->get_booking_review_ajx();
   }
   public function show_service_reschedule_popup_ajx() {
	$this->Salon_model->show_service_reschedule_popup_ajx();
   }
   public function show_service_cancel_popup_ajx() {
	$this->Salon_model->show_service_cancel_popup_ajx();
   }
   public function complete_service_ajx() {
	$this->Salon_model->complete_service_ajx();
   }
   public function cancel_service_ajx() {
	$this->Salon_model->cancel_service_ajx();
   }
   public function reschedule_service_ajx() {
	$this->Salon_model->reschedule_service_ajx();
   }
   public function show_service_complete_popup_ajx() {
	$this->Salon_model->show_service_complete_popup_ajx();
   }
   public function show_add_service_popup_ajx() {
	$this->Salon_model->show_add_service_popup_ajx();
   }
   public function get_category_services() {
	$this->Salon_model->get_category_services();
   }
   public function get_booking_category_services() {
	$this->Salon_model->get_booking_category_services();
   }
   public function get_stylistwise_calender_data() {
	$this->Salon_model->get_stylistwise_calender_data();
   }
   public function get_all_stylists_data() {
	$this->Salon_model->get_all_stylists_data();
   }
   public function get_time_slot_by_shift_ajax() {
	$this->Salon_model->get_time_slot_by_shift_ajax();
   }
   public function check_shift_in_time_ajax() {
	$this->Salon_model->check_shift_in_time_ajax();
  }
  public function check_shift_out_time_ajax() {
	$this->Salon_model->check_shift_out_time_ajax();
  }
  public function get_unique_phone() {
	$this->Salon_model->get_unique_phone();
  }

  public function get_student_payment_ajax() {
	$this->Salon_model->get_student_payment_ajax();
  }
  

  public function get_membership_info_ajax() {
	$this->Salon_model->get_membership_info_ajax();
  }
  public function get_package_info_ajax() {
	$this->Salon_model->get_package_info_ajax();
  }
  public function get_package_details_ajax() {
	$this->Salon_model->get_package_details_ajax();
  }
	
	public function get_third_category_options() {
		$sup_category_id = $this->input->post('sup_category');
		$sub_category_id = $this->input->post('sub_category');

		$third_category_options = $this->Salon_model->get_third_category_options($sup_category_id, $sub_category_id);

		echo json_encode($third_category_options);
	}

	public function get_course_detail(){
		$res = $this->Salon_model->get_course_detail($this->input->post('course_name_id'));
		echo json_encode($res);
	}
	public function get_course_fees(){
	
		$res=$this->Salon_model->get_course_fees($this->input->post('course_name_id'));
		echo json_encode($res);
	}

	// For sallary Slip

	public function get_already_generated_field_exe_slip_ajx(){
		$this->Salon_model->get_already_generated_field_exe_slip_ajx();
	}
	public function get_employee_salary_details_ajx(){
		$this->Salon_model->get_employee_salary_details_ajx();
	}
	public function get_employee_present_days_ajx(){
		$this->Salon_model->get_employee_present_days_ajx();
	}
	public function get_employee_half_days_ajx(){
		$this->Salon_model->get_employee_half_days_ajx();
	}
	public function get_employee_absent_days_ajx(){
		$this->Salon_model->get_employee_absent_days_ajx();
	}
	public function get_employee_leave_days_ajx(){
		$this->Salon_model->get_employee_leave_days_ajx();
	}
	public function get_employee_total_loan_ajx(){
		$this->Salon_model->get_employee_total_loan_ajx();
	}
	public function get_unique_sup_category(){
		$this->Salon_model->get_unique_sup_category();
    }
	public function get_dashboard_counts_ajx(){
		$this->Salon_model->get_dashboard_counts_ajx();
	} 
	public function get_settle_loan_form_ajx(){
		$this->Salon_model->get_settle_loan_form_ajx();
	} 
	public function get_loan_payment_ajx(){
		$this->Salon_model->get_loan_payment_ajx();
	} 
	public function get_customer_exist_loan_ajax(){
		$this->Salon_model->get_customer_exist_loan_ajax();
	} 
	public function get_dashboard_sales_counts_ajx(){
		$this->Salon_model->get_dashboard_sales_counts_ajx();
	}
	public function get_dashboard_redemption_counts_ajx(){
		$this->Salon_model->get_dashboard_redemption_counts_ajx();
	}
	public function get_dashboard_product_counts_ajx(){
		$this->Salon_model->get_dashboard_product_counts_ajx();
	}
	public function get_employees_by_shift_id() {
		$shift_name_id = $this->input->post('shift_name_id');
		
		$employees = $this->Salon_model->get_employees_by_shift_id($shift_name_id);
		
		echo json_encode($employees);
	}
	
	
	public function get_fees_data_ajax(){
	 	$this->Salon_model->get_fees_data_ajax($this->input->post('course_name_id'),$this->input->post('student_id'));
	}


	public function get_work_schedule_list_ajx(){
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
		$document = $this->Salon_model->get_work_schedule_list($length,$start,$search);
		//print_r($document);exit();
        $data = array();
        if(!empty($document)){
			$zz=0;
			foreach($document as $print){
				$zz++;
				$sub_array = array();
				$sub_array[] = $zz;
				$sub_array[] = $print->schedule_name;
				$sub_array[] = $print->schedule_description;
				$sub_array[] = '<div class="btn-group">
								<button type="button" class="btn btn-success" onclick="openschedulemodal('.$print->id.')" data-toggle="modal" data-target="#exampleModal">
									View
								</button>
							</div>';
				if($print->status == 1){
					$sub_array[] = '<span class="label label-success">Active</span>';
				}else{
					$sub_array[] = '<span class="label label-warning">Inactive</span>';
				}
				if($print->status == 1){
					$sub_array[] = '<ul class="navbar-nav ml-auto">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle btn" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
										</a>
										<div class="dropdown-menu ac" aria-labelledby="navbarDropdown">
											<a href="'.base_url().'update_work_schedule/'.$print->id.'"  class="dropdown-item">Update</a>
											<a href="'.base_url().'inactive/'.$print->id.'/tbl_work_schedules" class="dropdown-item">Inactive</a>
											<a href="'.base_url().'delete/'.$print->id.'/id/tbl_work_schedules" data-toggle="tooltip" data-placement="left"  class="dropdown-item delete">Delete</a>
										</div>
									</li>
								</ul>';
				}else{
					$sub_array[] = '<ul class="navbar-nav ml-auto">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle btn" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
										</a>
										<div class="dropdown-menu ac" aria-labelledby="navbarDropdown">
												<a href="'.base_url().'update_work_schedule/'.$print->id.'" class="dropdown-item">Update</a>
											<a href="'.base_url().'active/'.$print->id.'/tbl_work_schedules" class="dropdown-item">Active</a>
											<a href="'.base_url().'delete/'.$print->id.'/id/tbl_work_schedules" data-toggle="tooltip" data-placement="left"  class="dropdown-item delete">Delete</a>
										</div>
									</li>
								</ul>';
				}
				
				$data[] = $sub_array; 
			}
		}
		$TotalProducts = $this->Salon_model->get_work_schedule_list_count($search);
		
        $output = array(
            "draw" 				=> $draw,
            "recordsTotal" 		=> $TotalProducts,
            "recordsFiltered" 	=> $TotalProducts,
            "data" 				=> $data
        );
        echo json_encode($output);
        exit();
	}
	


	
public function get_holiday_days_list_ajx(){
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
	$document = $this->Salon_model->get_holiday_days_list($length,$start,$search);
	
	$data = array();
	if(!empty($document)){
		$zz=1;
		foreach($document as $print){
			$sub_array = array();
			$date = $print->holiday_date; //format date
			$get_name = date('l', strtotime($date)); //get week day
			$day_name = $get_name;
			
			$sub_array[] = $zz++;
			$sub_array[] = $print->holiday_name;
			$sub_array[] = $day_name;
			$sub_array[] = date("d-m-Y",strtotime($print->holiday_date));
			if($print->status == '0'){
				$sub_array[] = '<span class="label label-warning">Inactive</span>';
			}else if($print->status == '1'){
				$sub_array[] = '<span class="label label-success">Active</span>';
			}else{
				$sub_array[] = '';
			}
			if($print->status == 1){
				$sub_array[] = '<ul class="navbar-nav ml-auto">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle btn" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
									<div class="dropdown-menu ac" aria-labelledby="navbarDropdown">
										<a href="'.base_url().'update_holiday/'.$print->id.'"  class="dropdown-item">Update</a>
										<a href="'.base_url().'inactive/'.$print->id.'/tbl_holiday"  class="dropdown-item">Inactive</a>
										<a href="'.base_url().'delete/'.$print->id.'/id/tbl_holiday"  data-toggle="tooltip" data-placement="left"  class="dropdown-item delete">Delete</a>
									</div>
								</li>
							</ul>';
			}else{
				$sub_array[] = '<ul class="navbar-nav ml-auto">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle btn" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
									<div class="dropdown-menu ac" aria-labelledby="navbarDropdown">
											<a href="'.base_url().'update_holiday/'.$print->id.'" class="dropdown-item">Update</a>
										<a href="'.base_url().'active/'.$print->id.'/tbl_holiday"  class="dropdown-item">Active</a>
										<a href="'.base_url().'delete/'.$print->id.'/id/tbl_holiday"  data-toggle="tooltip" data-placement="left"  class="dropdown-item delete">Delete</a>
									</div>
								</li>
							</ul>';
			}
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_holiday_days_list_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}


public function get_unique_holiday_ajax(){
	$this->Salon_model->get_unique_holiday_ajax();
}
public function get_services_ajax() {
	$this->Salon_model->get_services_ajax();
}
public function create_services_div_ajx() {
	$this->Salon_model->create_services_div_ajx();
}
public function create_product_div_ajx() {
	$this->Salon_model->create_product_div_ajx();
}
public function create_package_div_ajx() {
	$this->Salon_model->create_package_div_ajx();
}
public function get_stylist_timeslots() {
	$this->Salon_model->get_stylist_timeslots_ajx();
}
public function get_service_timeslots() {
	$this->Salon_model->get_service_timeslots_ajx();
}
public function get_service_timeslot_stylists() {
	$this->Salon_model->get_service_timeslot_stylists_ajx();
}
public function get_service_timeslots_add_service() {
	$this->Salon_model->get_service_timeslots_add_service_ajx();
}
public function get_available_stylists_servicewise_ajx() {
	$this->Salon_model->get_available_stylists_servicewise_ajx();
}
public function get_available_stylists_edit_servicewise_ajx() {
	$this->Salon_model->get_available_stylists_edit_servicewise_ajx();
}
public function get_day_timeslots_ajx() {
	$this->Salon_model->get_day_timeslots_ajx();
}
public function get_day_timeslots_reschedule_ajx() {
	$this->Salon_model->get_day_timeslots_reschedule_ajx();
}
public function get_day_timeslots_extra_service_ajx() {
	$this->Salon_model->get_day_timeslots_extra_service_ajx();
}
public function get_day_timeslots_edit_service_ajx() {
	$this->Salon_model->get_day_timeslots_edit_service_ajx();
}
public function get_available_stylists_servicewise_reschedule_ajx() {
	$this->Salon_model->get_available_stylists_servicewise_reschedule_ajx();
}
public function get_stylist_reschedule_timeslots() {
	$this->Salon_model->get_stylist_reschedule_timeslots_ajx();
}
public function get_stylist_reschedule_timeslots_updated_ajx() {
	$this->Salon_model->get_stylist_reschedule_timeslots_updated_ajx();
}
public function check_giftcard_ajx() {
 	$this->Salon_model->check_giftcard_ajx();
}
public function get_stylistwise_shift_ajx() {
 	$this->Salon_model->get_stylistwise_shift_ajx();
}
public function get_booking_bill_generation_details_ajx() {
 	$this->Salon_model->get_booking_bill_generation_details_ajx();
}
public function get_product_booking_bill_generation_details_ajx() {
 	$this->Salon_model->get_product_booking_bill_generation_details_ajx();
}
public function get_booking_edit_details_ajx() {
 	$this->Salon_model->get_booking_edit_details_ajx();
}
public function set_salon_close_ajx() {
 	$this->Salon_model->set_salon_close_ajx();
}
public function get_product_booking_edit_details_ajx() {
 	$this->Salon_model->get_product_booking_edit_details_ajx();
}
public function get_service_products_details_ajx() {
 	$this->Salon_model->get_service_products_details_ajx();
}
public function get_customer_payments_ajx() {
 	$this->Salon_model->get_customer_payments_ajx();
}
public function add_customer_payment_ajx() {
 	$this->Salon_model->add_customer_payment_ajx();
}
public function get_product_barcodes_ajax() {
 	$this->Salon_model->get_product_barcodes_ajax();
}
public function get_category_product_ajax() {
 	$this->Salon_model->get_category_product_ajax();
}
public function fetch_total_sales_report_data_ajx() {
 	$this->Salon_model->fetch_total_sales_report_data_ajx();
}
public function fetch_redemption_report_data_ajx() {
 	$this->Salon_model->fetch_redemption_report_data_ajx();
}
public function fetch_finance_report_data_ajx() {
 	$this->Salon_model->fetch_finance_report_data_ajx();
}
public function get_petty_cash_balance_ajax() {
 	$this->Salon_model->get_petty_cash_balance_ajax();
}
public function get_dashboard_popup_data_ajx() {
 	$this->Salon_model->get_dashboard_popup_data_ajx();
}
public function check_is_salon_close_for_period_setup_datewise_ajx() {
 	$this->Salon_model->check_is_salon_close_for_period_setup_datewise_ajx();
}
public function update_customer_note_ajx() {
 	$this->Salon_model->update_customer_note_ajx();
}
public function get_category_products_ajx() {
 	$this->Salon_model->get_category_products_ajx();
}
public function get_product_details_row_ajx() {
 	$this->Salon_model->get_product_details_row_ajx();
}
public function get_all_bookings_ajax(){
	$booking_rules = $this->Salon_model->get_booking_rules();
	if(!empty($booking_rules)){
		// $booking_rescheduling = $booking_rules->booking_rescheduling;
		// $cancellation = $booking_rules->cancellation;
		
		$cancellation = 0;
		$booking_rescheduling = 0;
	}else{
		$cancellation = 0;
		$booking_rescheduling = 0;
	}

	$result = $this->Salon_model->get_all_bookings_ajax();
	if(!empty($result)){
		$k = 1;
		foreach($result as $data){
			$booking_services = $this->Salon_model->get_booking_service_details($data->id);
			$booking_review = $this->Salon_model->get_booking_review($data->id,$data->customer_name);

			$services = $booking_services;
            $services_str = '';
            if (empty($services)) {
                $services_str = '-';
            } else {
                for ($k = 0; $k < count($services); $k++) {
                    $service_details = $this->Salon_model->get_service_details($services[$k]->service_id);
                    if (!empty($service_details)) {
						$single_html = '';

						if($services[$k]->service_status == '1'){
							$single_html = '<button style="background: rgb(144, 238, 144);color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button" onclick="showBookingDetailsDiv('.$services[$k]->booking_id.')" data-toggle="modal" data-target="#detailsModal">'.$service_details->service_name.'</button>';
						}elseif($services[$k]->service_status == '0'){
							$single_html = '<button style="background: rgb(255, 213, 128);color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button" onclick="showBookingDetailsDiv('.$services[$k]->booking_id.')" data-toggle="modal" data-target="#detailsModal">'.$service_details->service_name.'</button>';
						}elseif($services[$k]->service_status == '2'){
							$single_html = '<button style="background: #ffd8d8;color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button" onclick="showBookingDetailsDiv('.$services[$k]->booking_id.')" data-toggle="modal" data-target="#detailsModal">'.$service_details->service_name.'</button>';
						}else{
							$single_html = '<button style="background: white;color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button" onclick="showBookingDetailsDiv('.$services[$k]->booking_id.')" data-toggle="modal" data-target="#detailsModal">'.$service_details->service_name.'</button>';
						}

                        $services_str .= $single_html;
                        if ($k < count($services) - 1) {
                            $services_str .= '';
                        }
                    }
                }
            }
			
			$service_from = new DateTime($data->service_start_date.' '.$data->service_start_time);
			$service_from->modify("-$booking_rescheduling minutes");
			$allowed_rescheduling_time = $service_from->format('Y-m-d H:i:s');
			
			$service_from_cancel = new DateTime($data->service_start_date.' '.$data->service_start_time);
			$service_from_cancel->modify("-$cancellation minutes");
			$allowed_cancel_time = $service_from_cancel->format('Y-m-d H:i:s');	
			
			$package_background_color = '';
			$package_text = '';
			$package_title_name = '';
			if($data->is_package_included == '1'){
				$package_details = $this->Salon_model->get_package_details($data->pacakge_id);
				if(!empty($package_details)){
					$package_text = '<button class="btn btn-sm" style="float:left; background-color: '. $package_details->bg_color .'; color:' . $package_details->text_color . ';">' . $package_details->package_name . '</button>';
					$package_background_color = $this->Salon_model->lightenColor($package_details->bg_color, 60);                                                
					$package_title_name = 'Package: '.$package_details->package_name;
				}
			}

			$background_color = '';
			if($data->booking_generated_from == '1'){
				$background_color = 'background-color:#e5fff9;';
			}
?>
	<div class="accordion" id="accordion_<?=$data->id;?>">
		<div class="panel">
			<div class="panel-heading" style="<?=$background_color;?>padding: 10px !important;">
				<h4 class="panel-title">
					<a style="color:black;" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_<?=$data->id;?>" href="#collapse_<?=$data->id;?>" onclick="changeCSS(<?=$data->id;?>)">
						<div class="row accordian_row_booking">
							<div class="col-lg-1 text-left">	
								<button class="btn arrow_btn" style="outline: none;background: #fff0;" onclick="changeCSS(<?=$data->id;?>)"><i class="fas fa-chevron-right" id="arrow_<?=$data->id;?>"></i></button>
								<span style="padding: 8px;font-size: 15px;font-weight: 700;"></span>
							</div>
					
							<div class="col-lg-8">	
								<div class="row" >
									<div class="col-lg-4">
										<p style="font-size: 15px;color: #2b2b2b;"><b>Customer: <?=$data->full_name;?></b></p>
									</div>
									<div class="col-lg-8">
										<p style="font-size: 13px;color: #414141;"><b>Booking Date: <?= date('d M, Y',strtotime($data->service_start_date));?> <?= date('h:i A',strtotime($data->service_start_time)).' to '.date('h:i A',strtotime($data->service_end_time));?></b></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<p style="font-size: 15px;color: #414141;margin: 0px;"><b>Mobile: <?=$data->customer_phone;?></b></p>
									</div>
									<div class="col-lg-8">
										<?=$services_str;?>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<p style="font-size: 11px;color: #414141;margin: 0px;"><b>Booking ID: <?=$data->receipt_no != "" ? $data->receipt_no : '-';?></b></p>
									</div>
								</div>
							</div>
							<?php if(!empty($booking_review) && $booking_review->description != ""){ ?>
								<div class="modal fade" id="BookingReviewModal_<?=$booking_review->id;?>" tabindex="-1" role="dialog" aria-labelledby="BookingReviewLabel_<?=$booking_review->id;?>" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="BookingReviewLabel_<?=$booking_review->id;?>">Booking Review</h5>
												<button style="margin-top: -25px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup('BookingReviewModal_<?=$booking_review->id;?>')">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php if(!empty($booking_review)){
													$totalStars = 5;
													$filledStars = $booking_review->stars;
													$emptyStars = $totalStars - $filledStars;
												
													for ($j = 0; $j < $filledStars; $j++) {
														echo '<i class="fa fa-star" style="margin-left: 3px;font-size: 15px;color: gold;"></i>';
													}
												
													for ($j = 0; $j < $emptyStars; $j++) {
														echo '<i class="fa fa-star" style="margin-left: 3px;font-size: 15px;color: #cccc;"></i>';
													}
												} ?>
												<?=$booking_review->description != "" ? '<p>'.$booking_review->description.'</p>' : '<p style="text-align: center;">Not Available</p>'; ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<div class="col-lg-3 text-right">
							<?php if(!empty($booking_review) && $booking_review->description != ""){ ?>
								<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Customer Review" onclick="showBookingReviewDiv(<?=$booking_review->id;?>)" data-toggle="modal" data-target="#BookingReviewModal_<?=$booking_review->id;?>" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-comment-dots"></i></a>
							<?php } ?>
							<?php
								if ($data->payment_status == '0' && ($data->booking_status === '1' || $data->booking_status === '3' || $data->booking_status === '4')) {
									$eventStartTime = new DateTime($data->service_start_date.' '.$data->service_start_time); // Corrected instantiation of DateTime
									$currentDateTime = new DateTime(); // Corrected instantiation of DateTime
									// if ($eventStartTime > $currentDateTime) {
							?>
										<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Edit Booking" id="edit_button<?=$data->id;?>" onclick="showBookingEditPopup(<?=$data->id;?>)" data-toggle="modal" data-target="#BookingEditModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-pencil"></i></a>
							<?php	
								// }
								if ($data->payment_status == '0' && ($data->booking_status === '1' || $data->booking_status === '3' || $data->booking_status === '4')) {                    
									echo '<button type="button" style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" class="btn btn-primary" id="complete_button" onclick="showCompletePopup('.$data->id.')" data-toggle="modal" data-target="#ServiceCompleteModal"><i style="color:green;font-size: 20px;" class="fas fa-check"></i></button>';
									if(date('Y-m-d H:i:s') <= $allowed_cancel_time){
										echo '<button type="button" style="margin-right:0px;outline:none; box-shadow:none;" class="btn btn-primary table-tbns-punch" id="cancel_button" onclick="showCancelPopup('.$data->id.')" data-toggle="modal" data-target="#ServiceCancelModal"><i style="color:red;font-size: 20px;" class="fas fa-times"></i></button>';
									}
								}        
								if ($data->payment_status == '0' && ($data->booking_status === '1' || $data->booking_status === '3' || $data->booking_status === '4')) {                    
									$eventStartTime = date('Y-m-d H:i:s',strtotime($data->service_start_date.' '.$data->service_start_time));
									$currentTime = date('Y-m-d H:i:s');
									// if ($eventStartTime > $currentTime) {
										echo '<button style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Add New Service" id="addServiceButton_' . $data->id . '" onclick="showAddServicePopup(' . $data->id . ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i style="font-size: 17px;color: black;" class="fa fa-plus"></i></button>';
									// }
								}
							?>
							<?php
								}      
								if ($data->booking_status === '5') {
									if ($data->payment_status === '0') {
							?>	
									<!-- <a class="btn btn-primary event-action-button" style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button" onclick="showBillGenerationPopup('<?=$data->id;?>')" data-toggle="modal" data-target="#BookingBillModal"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></a>	 -->
									<a class="btn btn-primary event-action-button" style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button" href="<?=base_url();?>bill-setup/<?=base64_encode($data->id);?>"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></a>	
							<?php 
									}
								} 
								if($data->booking_status == "5" && $data->payment_status == "1"){
							?>
									<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" class="btn btn-primary event-action-button" target="_blank" href="<?=base_url();?>booking-print/<?=base64_encode($data->id);?>/<?=base64_encode($data->booking_payment_id);?>?list" title="Receipt"><i style="font-size: 15px;color: black;" class="fas fa-receipt"></i></a>
							<?php 
								} 
								echo '<button type="button" style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" class="btn btn-primary" id="note_button" onclick="showBookingNotesDiv('.$data->id.')" data-toggle="modal" data-target="#bookingNoteModal"><i style="color:black;font-size: 20px;" class="fas fa-sticky-note"></i></button>'; 
							?>
							<button style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_<?=$data->id;?>" class="btn btn-primary event-action-button" onclick="window.location.href='tel:<?= $data->customer_phone ?>'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>
							</div>
						</div>
						</a>
				</h4>
			</div>
			<div id="collapse_<?=$data->id;?>" class="panel-collapse collapse">
				<div class="panel-body">
					<table id="example" class="table  table-bordered dt-responsive nowrap example list_table"  style="width:100%">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Status</th>
								<th>Service</th>
								<th>Date</th>
								<th>Duration</th>
								<th>Stylist</th>
								<th>Products</th>
								<th>Stylist<br><small>(After Bill)</small></th>
								<th>Products<br><small>(After Bill)</small></th>
							<tr>
						</thead>
						<tbody>
						<?php
							if(!empty($booking_services)){
								$z = 1;
								foreach($booking_services as $booking_services_result){
									$stylist_id_after_bill = $this->Salon_model->get_stylist_details($booking_services_result->stylist_id_after_bill);
									$products = explode(',',$booking_services_result->product_ids);
									$product_details_str = '';
									if (empty($products)) {
										$product_details_str = '-';
									} else {
										for ($k = 0; $k < count($products); $k++) {
											$product_details = $this->Salon_model->get_product_details($products[$k]);
											if (!empty($product_details)) {
												$product_details_str .= $product_details->product_name;
												if ($k < count($products) - 1) {
													$product_details_str .= ', ';
												}
											}
										}
									}
									$after_bill_products = explode(',',$booking_services_result->product_ids_after_bill);
									$after_bill_product_details_str = '';
									if (empty($after_bill_products)) {
										$after_bill_product_details_str = '-';
									} else {
										for ($k = 0; $k < count($after_bill_products); $k++) {
											$product_details = $this->Salon_model->get_product_details($after_bill_products[$k]);
											if (!empty($product_details)) {
												$after_bill_product_details_str .= $product_details->product_name;
												if ($k < count($after_bill_products) - 1) {
													$after_bill_product_details_str .= ', ';
												}
											}
										}
									}		

									if($booking_services_result->service_added_from == '1'){
                                        $background_color = 'background-color:'.$package_background_color.';';
                                    }else{
                                        if($booking_services_result->is_extra_service == '1'){
                                            $background_color = 'background-color:#0000ff21;';
                                        }else{
                                            $background_color = '';
                                        }
                                    }
                                    if($booking_services_result->service_status == '2'){
                                        $background_color = 'background-color:#ffd8d8;';
                                    }
						?>
							<tr title="<?=$package_title_name;?>" style="<?=$background_color;?>">
								<td><?=$z++; ?></td>
								<td>
                                    <?php 
                                        if($booking_services_result->service_status == '0'){
                                            echo '<label class="label label-warning">Pending</label>';
                                        }elseif($booking_services_result->service_status == '1'){
                                            echo '<label class="label label-success">Completed</label>';
                                            echo '<br>On: '.date('d-m-Y',strtotime($booking_services_result->completed_on));
                                        }elseif($booking_services_result->service_status == '2'){
                                            echo '<label class="label label-danger">Cancelled</label>';
                                        }elseif($booking_services_result->service_status == '3'){
                                            echo '<label class="label label-default">Lapsed</label>';
                                        }else{
                                            echo 'NA';
                                        }
                                    ?>
                                </td>
								<td><?=$booking_services_result->service_name;?><br><?=$booking_services_result->service_name_marathi;?></td>
								<td><?= date('d M, Y',strtotime($booking_services_result->service_date));?></td>
								<td><?= date('h:i A',strtotime($booking_services_result->service_from)).' to '.date('h:i A',strtotime($booking_services_result->service_to));?></td>
								<td><?=$booking_services_result->stylist_name;?></td>
								<td><?=($product_details_str != "") ? $product_details_str : '-';?></td>
								<td><?=!empty($stylist_id_after_bill) ? $stylist_id_after_bill->full_name : '-';?></td>
								<td><?=($after_bill_product_details_str != "") ? $after_bill_product_details_str : '-';?></td>
							</tr>
							<?php 
								}} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
		}
	} else {
?>
	<script>
		$(document).ready(function(){
			$('#load-more').hide();
			$('#no-more').show();
		});
	</script>
<?php
	}
}

public function get_all_product_bookings_ajax(){
	$result = $this->Salon_model->get_all_product_bookings_ajax();
	if(!empty($result)){
		$k = 1;
		foreach($result as $data){
			$booking_review = $this->Salon_model->get_booking_review($data->id,$data->customer_name);
			$products = explode(',',$data->products);
            $products_str = '';
            if (empty($products)) {
                $products_str = '-';
            } else {
                for ($k = 0; $k < count($products); $k++) {
                    $product_details = $this->Salon_model->get_product_details($products[$k]);
                    if (!empty($product_details)) {
						$single_html = '<button style="cursor:default;background: white;color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" type="button" class="btn btn-info" id="product_details_button">'.$product_details->product_name.'</button>';
                        $products_str .= $single_html;
                        if ($k < count($products) - 1) {
                            $products_str .= '';
                        }
                    }
                }
            }
			$booking_products = $this->Salon_model->get_product_booking_details($data->id);
			$booking_payments = $this->Salon_model->get_all_bookings_payments($data->id);
			// echo '<pre>'; print_r($booking_products);
?>
	<div class="accordion" id="accordion_<?=$data->id;?>">
		<div class="panel">
			<div class="panel-heading" style="padding: 10px !important;">
				<h4 class="panel-title">
					<a style="color:black;" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_<?=$data->id;?>" href="#collapse_<?=$data->id;?>" onclick="changeCSS(<?=$data->id;?>)">
						<div class="row accordian_row_booking">
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-left">	
								<button class="btn arrow_btn" style="outline: none;background: #fff0;" onclick="changeCSS(<?=$data->id;?>)"><i class="fas fa-chevron-right" id="arrow_<?=$data->id;?>"></i></button>
								<span style="padding: 8px;font-size: 15px;font-weight: 700;"></span>
							</div>
					
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">	
								<div class="row" >
									<div class="col-lg-4">
										<p style="font-size: 15px;color: #2b2b2b;"><b>Customer: <?=$data->full_name;?></b></p>
									</div>
									<div class="col-lg-8">
										<p style="font-size: 13px;color: #414141;"><b>Booking Date: <?= date('d M, Y',strtotime($data->booking_date));?></b></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<p style="font-size: 15px;color: #414141;margin: 0px;"><b>Mobile: <?=$data->customer_phone;?></b></p>
									</div>
									<div class="col-lg-8">
										<?=$products_str;?>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<p style="font-size: 11px;color: #414141;margin: 0px;"><b>Booking ID: <?=$data->receipt_no;?></b></p>
									</div>
								</div>
							</div>
							<?php if(!empty($booking_review)){ ?>
								<div class="modal fade" id="BookingReviewModal_<?=$booking_review->id;?>" tabindex="-1" role="dialog" aria-labelledby="BookingReviewLabel_<?=$booking_review->id;?>" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="BookingReviewLabel_<?=$booking_review->id;?>">Booking Review</h5>
												<button style="margin-top: -25px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup('BookingReviewModal_<?=$booking_review->id;?>')">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php if(!empty($booking_review)){
													$totalStars = 5;
													$filledStars = $booking_review->stars;
													$emptyStars = $totalStars - $filledStars;
												
													for ($j = 0; $j < $filledStars; $j++) {
														echo '<i class="fa fa-star" style="margin-left: 3px;font-size: 15px;color: gold;"></i>';
													}
												
													for ($j = 0; $j < $emptyStars; $j++) {
														echo '<i class="fa fa-star" style="margin-left: 3px;font-size: 15px;color: #cccc;"></i>';
													}
												} ?>
												<?=$booking_review->description != "" ? '<p>'.$booking_review->description.'</p>' : ''; ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?php if(!empty($booking_review) && $booking_review->description != ""){ ?>
								<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Customer Review" onclick="showPopup('BookingReviewModal_<?=$booking_review->id;?>')" data-toggle="modal" data-target="#BookingReviewModal_<?=$booking_review->id;?>" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-comment-dots"></i></a>
							<?php } ?>
							<?php
								if ($data->payment_status == '0') {
									$eventStartTime = new DateTime($data->booking_date);
									$currentDateTime = new DateTime();
									// if ($eventStartTime > $currentDateTime) {
							?>
										<!-- <a style="width: 110px; cursor:pointer;" title="Edit Booking" id="edit_button<?=$data->id;?>" onclick="showProductBookingEditPopup(<?=$data->id;?>)" data-toggle="modal" data-target="#BookingEditModal"><i class="fas fa-pencil"></i></a> -->
										<a class="custom_icon" style="margin-right:10px;background:transparent !important;outline:none; box-shadow:none;" title="Add Extra Products" id="edit_button<?=$data->id;?>" href="<?=base_url();?>product-booking?customer=<?=$data->customer_name;?>&booking_id=<?=$data->id;?>"><i style="font-size: 15px;color: black;" class="fa fa-plus"></i></a>
							<?php
									// }
								}
							?>
							<?php if($data->payment_status == "0"){ ?>	
								<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button" onclick="showBillProductGenerationPopup('<?=$data->id;?>')" data-toggle="modal" data-target="#BookingBillModal"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></a>	
							<?php } 
								if(!empty($booking_payments)){
									foreach($booking_payments as $booking_payments_result){
										// echo $booking_payments_result->id;
							?>
								<a style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" class="btn" target="_blank" href="<?=base_url();?>product-booking-print/<?=base64_encode($data->id);?>/<?=base64_encode($booking_payments_result->id);?>?list" title="Receipt"><i style="font-size: 15px;color: black;" class="fas fa-receipt"></i></a>
							<?php }} ?>
							</div>
						</div>
						</a>
				</h4>
			</div>
			<div id="collapse_<?=$data->id;?>" class="panel-collapse collapse">
				<div class="panel-body">
					<table id="example" class="table  table-bordered dt-responsive nowrap example list_table"  style="width:100%">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Product</th>
								<th>Booking Quantity</th>
								<th>Booking Price<br><small>(Before Discount)</small></th>
								<th>Booking Stylist</th>
								<th>Billing Quantity</th>
								<th>Billing Price<br><small>(Before Discount)</small></th>
								<th>Billing Stylist</th>
								<th>Payment Status</th>
							<tr>
						</thead>
						<tbody>
						<?php
							if(!empty($booking_products)){
								$z = 1;
								foreach($booking_products as $booking_products_result){	
									$booking_stylist_details = $this->Salon_model->get_stylist_details($booking_products_result->stylist_id);
									$bill_stylist_details = $this->Salon_model->get_stylist_details($booking_products_result->stylist_after_bill);
						?>
							<tr>
								<td><?=$z++; ?></td>
								<td>
									<?=$booking_products_result->product_category;?>| <?=$booking_products_result->product_category_marathi;?>
									<br>
									<?=$booking_products_result->product_name;?>
								</td>
								<td><?=$booking_products_result->quantity;?></td>
								<td><?=$booking_products_result->total_product_price;?></td>
								<td><?=!empty($booking_stylist_details) ? $booking_stylist_details->full_name : '-';?></td>
								<!-- <td><?=$booking_products_result->product_discounted_price_while_booking;?></td> -->
								<td><?=$data->payment_status == '1' && $booking_products_result->payment_status == '1' ? $booking_products_result->quantity_after_bill : '-';?></td>
								<!-- <td><?=$data->payment_status == '1' && $booking_products_result->payment_status == '1' ? $booking_products_result->product_discounted_price_while_bill : '-';?></td> -->
								<td><?=$data->payment_status == '1' && $booking_products_result->payment_status == '1' ? $booking_products_result->total_product_price_after_bill : '-';?></td>
								<td><?=!empty($bill_stylist_details) ? $bill_stylist_details->full_name : '-';?></td>
								<td>
									<?php 
										if($booking_products_result->payment_status == '1' && $data->payment_status == '1'){
											echo 'Completed';
										}elseif($booking_products_result->payment_status == '0' && $data->payment_status == '0'){
											echo 'Pending';
										}elseif($booking_products_result->payment_status == '2'){
											echo 'Product Removed';
										}else{
											echo '-';
										}
									?>
								</td>
							</tr>
							<?php 
								}} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
		}
	} else {
?>
	<script>
		$(document).ready(function(){
			$('#load-more').hide();
			$('#no-more').show();
		});
	</script>
<?php
	}
}

public function get_saloon_customers_ajx(){
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

	$document = $this->Salon_model->get_all_salon_customer_list($length, $start, $search);
	
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$membership_details = $this->Salon_model->get_membership_details($print->membership_pkey,$print->id);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->customer_phone;
			if($this->input->post('is_app_customers') == '1'){				
				$sub_array[] = $print->is_logged_in == '1' ? '<label class="label label-success">Logged In</label>' : ($print->is_logged_in == '0' ? '<label class="label label-warning">Logged Out</label>' : '-');
			}
			$sub_array[] = ($print->email != "" && $print->email != null) ? $print->email : '-';
			if($print->gender == '0'){
				$sub_array[] = 'Male';
			}elseif($print->gender == '1'){				
				$sub_array[] = 'Female';
			}elseif($print->gender == '2'){				
				$sub_array[] = 'Other';
			}else{
				$sub_array[] = '-';
			}
			$sub_array[] = ($print->dob != "" && $print->dob != null && $print->dob != "0000-00-00" && $print->dob != "1970-01-01") ? date('d-m-Y', strtotime($print->dob)) : '-';
			$sub_array[] = !empty($membership_details) ? '<a class="btn btn-sm" style="background-color:'.$membership_details->bg_color.'; color:'.$membership_details->text_color.'">'.$membership_details->membership_name.'</a>' : '-';
			$custom_note = $print->custom_note ? '<p>'.$print->custom_note.'</p>' : '<p style="text-align:center;">Not Available</p>';
			$sub_array[] = '
			<button type="button" onclick="showPopup(\'exampleModal_'.$print->id.'\')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_'.$print->id.'">
				View
			</button>
			<div class="modal fade" id="exampleModal_'.$print->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_'.$print->id.'" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel_'.$print->id.'">Note</h5>
						<button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(\'exampleModal_'.$print->id.'\')">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="response_'.$print->id.'">
							'.$custom_note.'
						</div>
					</div>
					</div>
				</div>
			</div>';
			$sub_array[] = $print->current_pending_amount;
			$sub_array[] = $print->rewards_balance;	
			$add_mem_button = '';		
			if(empty($membership_details)){
				$add_mem_button = '<br><a style="color:black"; href="'.base_url().'asign-membership/'.$print->id.'">Add Membership</a>';
			}
			$sub_array[] = '<ul class="navbar-nav ml-auto" style="list-style-type:none;">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle btn" href="#" title="Action" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-v" aria-hidden="true" style="color: black;"></i>
									</a>
									<div class="dropdown-menu ac" aria-labelledby="navbarDropdown" style="text-align:left; padding:10px;">
										<a style="color:black"; target="_blank" href="'.base_url().'booking-list??status=&id=&customer='.$print->id.'&from_date=&to_date=&service=&stylist=">Bookings</a>
										<br><a style="color:black"; target="_blank" href="'.base_url().'add-new-booking-new?customer='.$print->id.'">Add New Booking</a>
										<br><a style="color:black"; id="payment_button" onclick="showCustomerPayments('.$print->id.')" data-toggle="modal" data-target="#CustomerPaymentsModal">Payments</a>
										<br><a style="color:black"; id="add_payment_button" onclick="showAddCustomerPaymentForm('.$print->id.')" data-toggle="modal" data-target="#CustomerAddPaymentsModal">Add Payment</a>
										'.$add_mem_button.'
										<br><a style="color:black"; href="'.base_url().'add-customer/'.$print->id.'">Edit</a>
									</div>
								</li>
							</ul>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_all_salon_customer_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_employee_attendance_ajx(){
	$this->Salon_model->get_employee_attendance_ajx();
}
public function get_employee_attendance_form_ajx(){
	$this->Salon_model->get_employee_attendance_form_ajx();
}
public function get_unique_product_name(){
	$this->Admin_model->get_unique_product_name();
}

public function get_student_data_ajax(){
	$this->Salon_model->get_student_data_ajax();
}
public function set_employee_punch_in_ajx(){
	$this->Salon_model->punch_in();
}
public function set_employee_punch_out_ajx(){
	$this->Salon_model->punch_out();
}
public function valdiate_staff_leave_for_period_ajx(){
	$this->Salon_model->valdiate_staff_leave_for_period_ajx();
}
public function get_customize_message_ajx(){
	$this->Salon_model->get_customize_message_ajx();
}
public function get_send_offer_message_form_ajx(){
	$this->Salon_model->get_send_offer_message_form_ajx();
}
public function get_send_coupon_message_form_ajx(){
	$this->Salon_model->get_send_coupon_message_form_ajx();
}
public function get_send_giftcard_message_form_ajx(){
	$this->Salon_model->get_send_giftcard_message_form_ajx();
}
public function get_message_content_ajx(){
	$this->Salon_model->get_message_content_ajx();
}

public function update_shift_order(){
	$this->Salon_model->update_shift_order();
}
public function get_salon_memberships_ajx(){
	$this->Salon_model->get_salon_memberships_ajx();
}
public function get_salon_packages_ajx(){
	$this->Salon_model->get_salon_packages_ajx();
}
public function get_total_fees_ajax(){
	
	$res= $this->Salon_model->get_total_fees_ajax($this->input->post('course_name_id'));
		echo json_encode($res);
}
public function get_product_barcodes_ajx(){
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
	$document = $this->Salon_model->get_product_barcodes_ajx_list($length, $start, $search);
	
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$product_sub_category = $this->Admin_model->get_sub_category_details($print->product_subcategory);
			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->product_name;
			$sub_array[] = $print->product_category_name;
			$sub_array[] = !empty($product_sub_category) ? $product_sub_category->product_sub_category : '-';
			$sub_array[] = $print->barcode_id;
			$sub_array[] = '<img class="barcode-img" src="'.base_url().'barcode.php?codetype=Code39&size=40&text='.$print->barcode_id.'&print=true" />';

			if($print->product_status == '0'){
				$sub_array[] = 'Un-Used';
			}elseif($print->product_status == '1'){
				$sub_array[] = 'Used in Booking';
			}elseif($print->product_status == '2'){
				$sub_array[] = 'Expired';
			}elseif($print->product_status == '3'){
				$sub_array[] = 'Garbage';
			}elseif($print->product_status == '4'){
				$sub_array[] = 'Damaged';
			}elseif($print->product_status == '5'){
				$sub_array[] = 'Internally Used';
			}else{
				$sub_array[] = 'NA';
			}

			$sub_array[] = $print->inward_date != "" ? date('d-m-Y',strtotime($print->inward_date)) : '-';
			// $sub_array[] = $print->mfg_date != "" ? date('d-m-Y',strtotime($print->mfg_date)) : '-';
			// $sub_array[] = $print->exp_date != "" ? date('d-m-Y',strtotime($print->exp_date)) : '-';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_product_barcodes_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_rotational_shifts_ajx(){
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
	$document = $this->Salon_model->get_rotational_shifts_ajx_list($length, $start, $search);
	
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$id_deleted_allowed = '1';
			$shift_emps = $this->Salon_model->get_shift_emps($print->id);
			if(!empty($shift_emps)){
				$id_deleted_allowed = '0';
			}
			
			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->product_name;
			$sub_array[] = $print->product_category_name;
			$sub_array[] = !empty($product_sub_category) ? $product_sub_category->product_sub_category : '-';
			$sub_array[] = $print->barcode_id;
			$sub_array[] = '<img class="barcode-img" src="'.base_url().'barcode.php?codetype=Code39&size=40&text='.$print->barcode_id.'&print=true" />';

			if($print->product_status == '0'){
				$sub_array[] = 'Un-Used';
			}elseif($print->product_status == '1'){
				$sub_array[] = 'Used in Booking';
			}elseif($print->product_status == '2'){
				$sub_array[] = 'Expired';
			}elseif($print->product_status == '3'){
				$sub_array[] = 'Garbage';
			}elseif($print->product_status == '4'){
				$sub_array[] = 'Damaged';
			}elseif($print->product_status == '5'){
				$sub_array[] = 'Internally Used';
			}else{
				$sub_array[] = 'NA';
			}

			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_rotational_shifts_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}

public function get_employee_attendance_list_ajx(){
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
	$document = $this->Salon_model->get_employee_attendance_ajx_list($length, $start, $search);
	
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = date('d-m-Y',strtotime($print->att_date));
			$sub_array[] = $print->shift_name_text != "" ? $print->shift_name_text : '-';
			$sub_array[] = date('h:i A',strtotime($print->punch_in));
			$sub_array[] = $print->punch_out != '' ? date('h:i A',strtotime($print->punch_out)) : '-';
			$sub_array[] = date('h:i A',strtotime($print->shift_in));
			$sub_array[] = date('h:i A',strtotime($print->shift_out));
			$sub_array[] = date('h:i A',strtotime($print->shift_break_from)) . ' To ' . date('h:i A',strtotime($print->shift_break_to));
			$sub_array[] = $print->is_ot_hrs == '1' ? $print->ot_hrs : '-';

			$action = '';
			if($print->punch_out == ''){
				$action = '<button type="button" style="margin-right:0px;outline:none; box-shadow:none;" class="btn btn-primary punch-out-btn" id="cancel_button" onclick="setPunchOut('.$print->id.')" data-toggle="modal" data-target="#myModal" title="Set Punch Out"><i style="font-size: 20px;" class="fas fa-clock"></i></button>';
			}
			$sub_array[] = $action;
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_employee_attendance_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function check_offer_ajx(){
	$this->Salon_model->check_offer_ajx();
}
public function set_employee_attendance_ajx(){
	$this->Salon_model->set_employee_attendance_ajx();
}

public function get_customer_report_data_ajx(){
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
	$document = $this->Salon_model->get_customer_report_data_ajx_list($length, $start, $search);
	// echo '<pre>'; print_r($document);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$first_booking = $this->Salon_model->get_customer_first_booking($print->id);
			$last_booking = $this->Salon_model->get_customer_last_booking($print->id);
			$all_bookings = count($this->Salon_model->get_customer_booking($print->id));
			$membership = $this->Salon_model->get_membership_details($print->membership_pkey,$print->id);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->customer_phone;
			$sub_array[] = $print->email;
			$sub_array[] = $print->dob != "" && $print->dob != '0000-00-00' && $print->dob != '1970-01-01' ? date('d-m-Y',strtotime($print->dob)) : '-';
			$sub_array[] = $print->doa != "" && $print->doa != '0000-00-00' && $print->doa != '1970-01-01' ? date('d-m-Y',strtotime($print->doa)) : '-';

			$sub_array[] = $all_bookings;
			$sub_array[] = !empty($first_booking) && $first_booking->booking_date != "" ? date('d-m-Y',strtotime($first_booking->booking_date)) : '-';
			$sub_array[] = !empty($last_booking) && $last_booking->booking_date != "" ? date('d-m-Y',strtotime($last_booking->booking_date)) : '-';
			$sub_array[] = !empty($membership) ? '<a class="btn btn-sm" style="float:right; background-color:'.$membership->bg_color.'; color:'.$membership->text_color.'">'.$membership->membership_name.'</a>' : '-';

			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_customer_report_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_birthday_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			if ($print->dob != "" && $print->dob != '0000-00-00' && $print->dob != '1970-01-01') {
                $dob = new DateTime($print->dob);
                $today = new DateTime();
                $next_birthday = new DateTime($today->format('Y') . '-' . $dob->format('m') . '-' . $dob->format('d'));

                if ($today > $next_birthday) {
                    $next_birthday->modify('+1 year');
                }

                $interval = $today->diff($next_birthday);
                $next_birthday_in = $interval->days;
            } else {
                $next_birthday_in = '-';
            }

			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->dob != "" && $print->dob != '0000-00-00' && $print->dob != '1970-01-01' ? date('d M, Y',strtotime($print->dob)) : '-';
			$sub_array[] = $next_birthday_in;
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.htmlspecialchars(addslashes($print->content)).'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_anniversary_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			if ($print->doa != "" && $print->doa != '0000-00-00' && $print->doa != '1970-01-01') {
                $doa = new DateTime($print->doa);
                $today = new DateTime();
                $next_anniversary = new DateTime($today->format('Y') . '-' . $doa->format('m') . '-' . $doa->format('d'));

                if ($today > $next_anniversary) {
                    $next_anniversary->modify('+1 year');
                }

                $interval = $today->diff($next_anniversary);
                $next_anniversary_in = $interval->days;
            } else {
                $next_anniversary_in = '-';
            }

			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->doa != "" && $print->doa != '0000-00-00' && $print->doa != '1970-01-01' ? date('d M, Y',strtotime($print->doa)) : '-';
			$sub_array[] = $next_anniversary_in;
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.htmlspecialchars(addslashes($print->content)).'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}

public function get_marketing_service_repeat_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$last_booking = $this->Salon_model->get_customer_last_booking($print->send_customer);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($last_booking) && $last_booking->service_start_date != "" && $last_booking->service_start_date != '0000-00-00' && $last_booking->service_start_date != '1970-01-01' ? '<a style="text-decoration:underline;" target="_blank" href="' . base_url() . 'booking-list?id=' . $last_booking->id . '&status=&customer=' . $print->send_customer . '&from_date=&to_date=&service=&stylist=" title="View Booking">' . date('d M, Y', strtotime($last_booking->service_start_date)) . '</a>' : '-';
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.htmlspecialchars(addslashes($print->content)).'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_offer_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$send_on = $print->send_on;
			if($send_on == '0'){
				$send_on = 'SMS';
			}elseif($send_on == '1'){
				$send_on = 'Whatsapp';
			}elseif($send_on == '2'){
				$send_on = 'Email;';
			}else{
				$send_on = '';
			}

			$offer_details = $this->Salon_model->get_single_offer_details($print->for_offer_id);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$formatted_content = urldecode($print->content);
			$formatted_content = str_replace('%0a', '<br>', $formatted_content);
	
			$escaped_content = json_encode($formatted_content);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($offer_details) ? $offer_details->offers_name : '-';
			$sub_array[] = $print->created_on != "" && $print->created_on != '0000-00-00' && $print->created_on != '1970-01-01' ? date('d M, Y', strtotime($print->created_on)) : '-';
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage('.$print->id.')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$sub_array[] = $send_on;
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_giftcards_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$send_on = $print->send_on;
			if($send_on == '0'){
				$send_on = 'SMS';
			}elseif($send_on == '1'){
				$send_on = 'Whatsapp';
			}elseif($send_on == '2'){
				$send_on = 'Email;';
			}else{
				$send_on = '';
			}

			$offer_details = $this->Salon_model->get_single_giftcard_details($print->for_giftcard_id);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$formatted_content = urldecode($print->content);
			$formatted_content = str_replace('%0a', '<br>', $formatted_content);
	
			$escaped_content = json_encode($formatted_content);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($offer_details) ? $offer_details->gift_name . '' . ($offer_details->gift_card_code != "" ? ' [' . $offer_details->gift_card_code . ']' : '') : '-';
			$sub_array[] = $print->created_on != "" && $print->created_on != '0000-00-00' && $print->created_on != '1970-01-01' ? date('d M, Y', strtotime($print->created_on)) : '-';
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage('.$print->id.')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$sub_array[] = $send_on;
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_coupons_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$send_on = $print->send_on;
			if($send_on == '0'){
				$send_on = 'SMS';
			}elseif($send_on == '1'){
				$send_on = 'Whatsapp';
			}elseif($send_on == '2'){
				$send_on = 'Email;';
			}else{
				$send_on = '';
			}

			$offer_details = $this->Salon_model->get_single_coupon_details($print->for_coupon_id);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$formatted_content = urldecode($print->content);
			$formatted_content = str_replace('%0a', '<br>', $formatted_content);
	
			$escaped_content = json_encode($formatted_content);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($offer_details) ? $offer_details->coupon_name . '' . ($offer_details->coupan_code != "" ? ' [' . $offer_details->coupan_code . ']' : '') : '-';
			$sub_array[] = $print->created_on != "" && $print->created_on != '0000-00-00' && $print->created_on != '1970-01-01' ? date('d M, Y', strtotime($print->created_on)) : '-';
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage('.$print->id.')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$sub_array[] = $send_on;
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_service_cancelled_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$details = $this->Salon_model->get_booking_details_single($print->for_order_id);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($details) && $details->service_start_date != "" && $details->service_start_date != '0000-00-00' && $details->service_start_date != '1970-01-01' ? '<a style="text-decoration:underline;" target="_blank" href="' . base_url() . 'booking-list?id=' . $details->id . '&status=&customer=' . $print->send_customer . '&from_date=&to_date=&service=&stylist=" title="View Booking">' . date('d M, Y', strtotime($details->service_start_date)) . '</a>' : '-';
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.htmlspecialchars(addslashes($print->content)).'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_customize_message_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$formatted_content = $print->content;
			$send_on = $print->send_on;
			if($send_on == '0'){
				$send_on = 'SMS';
			}elseif($send_on == '1'){
				$send_on = 'Whatsapp';
			}elseif($send_on == '2'){
				$send_on = 'Email;';
			}else{
				$send_on = '';
			}

			$formatted_content = htmlspecialchars($formatted_content, ENT_QUOTES, 'UTF-8');
			$formatted_content = preg_replace('/\*([^\*]+)\*/', '<strong>$1</strong>', $formatted_content);
			$formatted_content = preg_replace('/_([^_]+)_/', '<em>$1</em>', $formatted_content);
			$formatted_content = preg_replace('/~([^~]+)~/', '<del>$1</del>', $formatted_content);
			$formatted_content = preg_replace('/`([^`]+)`/', '<code>$1</code>', $formatted_content);
			$formatted_content = str_replace('%0a', '<br>', $formatted_content);
			
			$escaped_content = addslashes($formatted_content);

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->created_on != "" && $print->created_on != '0000-00-00 00:00:00' && $print->created_on != '1970-01-01 00:00:00' ? date('d M, Y', strtotime($print->created_on)) : '-';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.$escaped_content.'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$sub_array[] = $send_on;
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_customize_message_remark_ajx() {
	$this->Salon_model->get_customize_message_remark_ajx(); 
}
public function get_send_customize_message_form_ajx() {
	$this->Salon_model->get_send_customize_message_form_ajx(); 
}
public function get_all_customize_messages_ajx(){
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
	$document = $this->Salon_model->get_all_customize_messages_ajx($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$sub_array = array();
			$sub_array[] = $offset++;

			if($print->approval_status == '1'){
				$sub_array[] = '<button style="float:left;color:white;background-color:#25D366 !important;border:none;" title="Send Message" type="button" class="btn btn-primary btn-sm" id="send_details_button_'.$print->id.'" onclick="sendCustomMessage('.$print->id.')" data-toggle="modal" data-target="#sendCustomMessageModal"><i style="font-size: 15px;padding: 2px;" class="fa fa-whatsapp"></i></button>';
			}else{
				$sub_array[] = '<button style="float:left;color:white;background-color: transparent !important;border:none;" title="Not Approved" type="button" class="btn btn-primary btn-sm"><i style="color:red;font-size: 15px;" class="fa fa-ban"></i></button>';
			}

			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showCustomizeMessage('.$print->id.')" data-toggle="modal" data-target="#customMessageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = $print->added_on != "" && $print->added_on != '0000-00-00 00:00:00' && $print->added_on != '1970-01-01 00:00:00' ? date('d M, Y', strtotime($print->added_on)) : '-';
			
			$actions = '';
			if($print->approval_status == '0'){
				$sub_array[] = '<label class="label label-warning"><a style="color:black;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'0\')" data-toggle="modal" data-target="#MessageRemarkModal">Pending</a></label>';
				$actions .= '<a title="Edit" class="btn btn-success" href="'.base_url().'customize_message?customer_report_type=7&edit='.$print->id.'"><i class="fa-solid fa-pen-to-square"></i></a>';
				$actions .= '<a title="Cancel" class="btn btn-primary" onclick="return confirm(\'Are you sure to cancel message request?\');" href="'.base_url().'cancel_message/'.$print->id.'"><i class="fa-solid fa-times"></i></a>';
			}elseif($print->approval_status == '1'){
				$sub_array[] = '<label class="label label-success"><a style="color:black;text-decoration:underline;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'1\')" data-toggle="modal" data-target="#MessageRemarkModal">Approved</a></label><br>On: '.date('d-m-Y',strtotime($print->approval_on));
			}elseif($print->approval_status == '2'){
				$sub_array[] = '<label class="label label-danger"><a style="color:black;text-decoration:underline;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'2\')" data-toggle="modal" data-target="#MessageRemarkModal">Rejected</a></label><br>On: '.date('d-m-Y',strtotime($print->rejected_on));
			}elseif($print->approval_status == '3'){
				// $sub_array[] = '<label class="label label-primary"><a style="color:white;cursor:pointer;" title="View Remark" onclick="showRemarkMessage('.$print->id.', \'3\')" data-toggle="modal" data-target="#MessageRemarkModal">Cancelled</a></label><br>On: '.date('d-m-Y',strtotime($print->cancelled_on));
				$sub_array[] = '<label class="label label-primary">Cancelled</label><br>On: '.date('d-m-Y',strtotime($print->cancelled_on));
			}else{
				$sub_array[] = '-';
			}

			$actions .= '<a title="Delete" class="btn btn-danger" onclick="return confirm(\'Are you sure to delete this record?\');" href="'.base_url().'delete/'.$print->id.'/tbl_salon_customize_messages"><i class="fa-solid fa-trash"></i></a>';

			$sub_array[] = $actions != "" ? $actions : '-';

			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_all_customize_messages_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function get_marketing_lost_customer_data_ajx(){
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
	$document = $this->Salon_model->get_marketing_data_ajx_list($length, $start, $search);
	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$last_booking = $this->Salon_model->get_customer_last_booking($print->send_customer);
			$is_visited_after_message = $this->Salon_model->is_customer_visited_after_message($print->send_customer,$print->created_on);

			$days_since_last_booking = '-';
			if (!empty($last_booking) && $last_booking->service_start_date != "" && $last_booking->service_start_date != '0000-00-00' && $last_booking->service_start_date != '1970-01-01') {
				$service_date = new DateTime($last_booking->service_start_date);
				$today = new DateTime();
				
				$interval = $today->diff($service_date);
				$days_since_last_booking = $interval->days;
			}

			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = !empty($last_booking) && $last_booking->service_start_date != "" && $last_booking->service_start_date != '0000-00-00' && $last_booking->service_start_date != '1970-01-01' ? '<a style="text-decoration:underline;" target="_blank" href="' . base_url() . 'booking-list?id=' . $last_booking->id . '&status=&customer=' . $print->send_customer . '&from_date=&to_date=&service=&stylist=" title="View Booking">' . date('d M, Y', strtotime($last_booking->service_start_date)) . '</a>' : '-';
			$sub_array[] = $days_since_last_booking;
			$sub_array[] = $is_visited_after_message ? '<span class="badge badge-success" style="background-color: #28a745;">Yes</span>' : '<span class="badge badge-danger" style="background-color: #dc3545;">No</span>';
			$sub_array[] = '<button style="float:left;background:transparent !important;outline:none; box-shadow:none;" title="View Message" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$print->id.'" onclick="showMessage(\''.htmlspecialchars(addslashes($print->content)).'\',\''.date('d M, Y h:i A',strtotime($print->created_on)).'\')" data-toggle="modal" data-target="#messageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-comment"></i></button>';
			$sub_array[] = '<button style="background:transparent !important;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_'.$print->id.'" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:'.$print->customer_phone.'\'"><i style="color:red;font-size: 15px;margin-left: -5px;" class="fas fa-phone"></i></button>';
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_marketing_data_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}

public function get_employee_report_data_ajx(){
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

	$employee_report_type = $this->input->post('employee_report_type');
	$selected_month = $this->input->post('selected_month');
	$selected_year = $this->input->post('selected_year');
	$from_date = $this->input->post('from_date') != "" ? date('Y-m-d',strtotime($this->input->post('from_date'))) : '';
	$to_date = $this->input->post('to_date') != "" ? date('Y-m-d',strtotime($this->input->post('to_date'))) : '';

	$document = $this->Salon_model->get_employee_ajx_list($length, $start, $search);

	$data = array();
	if(!empty($document)){
		$page = $start / $length + 1;
		$offset = ($page - 1) * $length + 1;
		foreach($document as $print){
			$sub_array = array();
			$sub_array[] = $offset++;
			$sub_array[] = $print->full_name;
			$sub_array[] = $print->whatsapp_number;
			$sub_array[] = $print->designation_name != "" ? $print->designation_name : '-';

			if($employee_report_type == '1'){
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($print->salary);
				$is_salary_generated = $this->Salon_model->check_employee_salary_generation($print->id,$selected_month,$selected_year);
				$target_incentive = $this->Salon_model->get_employee_target_incentive_total($print->id,$from_date,$to_date);
				$product_incentive = $this->Salon_model->get_employee_product_incentive_total($print->id,$from_date,$to_date);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($target_incentive);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($product_incentive);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat((float)$print->salary + (float)$target_incentive + (float)$product_incentive);
				if(!empty($is_salary_generated)){
					$sub_array[] = '<a target="_blank" title="View" href="'.base_url().'salon_print_salary_slip/'.$is_salary_generated->id.'"><label style="cursor:pointer;color:black;" class="label label-success"><u>Generated</u></label></a>';
				}else{
					$sub_array[] = '<a target="_blank" title="Generate Now" href="'.base_url().'generate_salary_slip?staff='.$print->id.'&month='.$selected_month.'&year='.$selected_year.'"><label style="cursor:pointer;color:black;" class="label label-warning"><u>Pending</u></label></a>';
				}

			}else if($employee_report_type == '2'){
				$emp_attendance = $this->Salon_model->get_employee_single_attendance_monthwise($print->id,$selected_month,$selected_year);
				$sub_array[] = $emp_attendance['present'];
				$sub_array[] = $emp_attendance['half_days'];
				$sub_array[] = $emp_attendance['absent'];
				$sub_array[] = $emp_attendance['total_ot'];
			}else if($employee_report_type == '3'){
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($this->Salon_model->get_employee_service_sale($print->id, $from_date, $to_date, '1','1')['amount'] + $this->Salon_model->get_employee_service_product_sale($print->id, $from_date, $to_date, '1','1')['amount']);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($this->Salon_model->get_employee_product_sale($print->id, $from_date, $to_date,'1')['amount']);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($this->Salon_model->get_employee_membership_sale($print->id, $from_date, $to_date,'1')['amount']);
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($this->Salon_model->get_employee_package_sale($print->id, $from_date, $to_date,'1')['amount']);

			}else if($employee_report_type == '4'){
				$target = $this->Salon_model->get_single_target_details($print->salary_method);
				if(!empty($target)){
					$start_amount = $target->start_amount;
					$end_amount = $target->end_amount;
				}else{
					$start_amount = 0;
					$end_amount = 0;
				}
				$packages_sale = $this->Salon_model->get_employee_package_sale($print->id, $from_date, $to_date,'1')['amount'];
				$service_sale = $this->Salon_model->get_employee_service_sale($print->id, $from_date, $to_date, '1','1')['amount'];
				$service_product_sale = (float)$this->Salon_model->get_employee_service_product_sale($print->id, $from_date, $to_date, '1','1')['amount'];
				$membership_sale = $this->Salon_model->get_employee_membership_sale($print->id, $from_date, $to_date,'1')['amount'];

				$total_performance = $service_sale + $service_product_sale + $membership_sale + $packages_sale;

				$sub_array[] = !empty($target) ? $this->Salon_model->formatNumberInIndianFormat($target->start_amount) : '-';
				$sub_array[] = !empty($target) ? $this->Salon_model->formatNumberInIndianFormat($target->end_amount) : '-';
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($total_performance);
				$sub_array[] = !empty($target) && $total_performance >= $start_amount ? '<i class="fas fa-check-circle" style="color: green;"></i>' : '<i class="fas fa-times-circle" style="color: red;"></i>';
				$sub_array[] = $this->Salon_model->formatNumberInIndianFormat($this->Salon_model->get_employee_target_incentive_total($print->id,$from_date,$to_date));

			}
			$data[] = $sub_array; 
		}
	}
	$TotalProducts = $this->Salon_model->get_employee_ajx_count($search);
	
	$output = array(
		"draw" 				=> $draw,
		"recordsTotal" 		=> $TotalProducts,
		"recordsFiltered" 	=> $TotalProducts,
		"data" 				=> $data
	);
	echo json_encode($output);
	exit();
}
public function update_emp_selection_setup(){
	$this->Salon_model->update_emp_selection_setup();
} 
public function update_slot_time_setup(){
	$this->Salon_model->update_slot_time_setup();
} 
public function update_buffering_time_setup(){
	$this->Salon_model->update_buffering_time_setup();
} 
public function update_rescheduling_setup(){
	$this->Salon_model->update_rescheduling_setup();
} 
public function update_cancellation_setup(){
	$this->Salon_model->update_cancellation_setup();
} 
public function update_reward_cancellation_setup(){
	$this->Salon_model->update_reward_cancellation_setup();
} 
public function update_booking_range_minute(){
	$this->Salon_model->update_booking_range_minute();
} 
public function update_availability_mode_setup(){
	$this->Salon_model->update_availability_mode_setup();
} 
public function update_booking_reminder_type_setup(){
	$this->Salon_model->update_booking_reminder_type_setup();
} 
public function submit_booking_rule_change_request(){
	$this->Salon_model->submit_booking_rule_change_request();
} 
public function set_updated_subscription_data_ajx(){
	$this->Salon_model->set_updated_subscription_data_ajx();
} 
public function get_consent_form_details_ajx(){
	$this->Salon_model->get_consent_form_details_ajx();
} 

public function add_reminder(){
	$result = $this->Salon_model->add_reminder();
	$this->session->set_flashdata('success','Record added successfully');
	if($this->input->post('redirect_to') == '1'){
		redirect('add-reminder-form');
	}else{
		redirect('salon-dashboard-new');
	}
}
public function add_enquiry(){
	$result = $this->Salon_model->add_enquiry();
	$this->session->set_flashdata('success','Record added successfully');
	if($this->input->post('redirect_to') == '1'){
		redirect('all-enquiries');
	}else{
		redirect('salon-dashboard-new');
	}
}
public function set_attendance(){
	if($this->input->post('type') == '1'){
		$result = $this->Salon_model->punch_in();
	}else{
		$result = $this->Salon_model->punch_out();
	}
	$this->session->set_flashdata("success", "Attendance added successfully.");
	if($this->input->post('originated_from') == 'dashboard'){
		redirect('salon-dashboard-new');
	}else{
		redirect('employee-attendance?employee='.$this->input->post('staff_id').'&month='.date('n',strtotime($this->input->post('date'))).'&year='.date('Y',strtotime($this->input->post('date'))).'');
	}
}
public function cancel_message(){
	$result = $this->Salon_model->cancel_message();
	if($result == 0){
		$this->session->set_flashdata('success','Message cancelled successfully');
	}else{
		$this->session->set_flashdata('message','Message not found. Please try again');
	}
	redirect('customize_message?customer_report_type=7');
}
public function get_unique_facility_name(){
	$this->Salon_model->get_unique_facility_name();
}
public function update_product_order(){
	$this->Salon_model->update_product_order();
}
public function update_service_order(){
	$this->Salon_model->update_service_order();
}
public function fetch_categories_ajax(){
	$this->Salon_model->fetch_categories_ajax();
}
public function get_level_incentive_setup(){
	$this->Salon_model->get_level_incentive_setup();
}
}  


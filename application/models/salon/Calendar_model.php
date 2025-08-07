<?php
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__DIR__,3) . '/vendor/autoload.php';
class Calendar_model extends CI_Model{
    public function fetch_resources(){   
        // Get today's date
        $today_date = date('Y-m-d');

        // Select the necessary columns and join with tbl_emp_designation
        $this->db->select('tbl_salon_employee.id ,tbl_salon_employee.full_name as title,tbl_salon_employee.shift,tbl_salon_employee.shift_type,tbl_salon_employee.salary_method');
        $this->db->join('tbl_emp_designation', 'tbl_salon_employee.designation = tbl_emp_designation.id', 'left');

        // Filter based on branch, salon, and not deleted
        $this->db->where('tbl_salon_employee.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('tbl_salon_employee.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('tbl_salon_employee.is_deleted', '0');
        $this->db->where('tbl_emp_designation.designation', 'Stylist');

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
            $this->db->where('is_deleted', '0');
            $this->db->where_in('service_status', ['0','1']);
            $this->db->where('service_date', $today_date);
            $this->db->group_by('booking_id');
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

        if(!empty($sorted_employees)){
            foreach($sorted_employees as &$result){
                $today_service_sale = (float)$this->Salon_model->get_employee_service_sale($result->id,date('Y-m-d'),date('Y-m-d'),'','1')['amount'];
                $today_service_product_sale = (float)$this->Salon_model->get_employee_service_product_sale($result->id,date('Y-m-d'),date('Y-m-d'),'','1')['amount'];
                $today_product_sale = (float)$this->Salon_model->get_employee_product_sale($result->id,date('Y-m-d'),date('Y-m-d'),'1')['amount'];
                $today_membership_sale = (float)$this->Salon_model->get_employee_membership_sale($result->id,date('Y-m-d'),date('Y-m-d'),'1')['amount'];
                $today_package_sale = (float)$this->Salon_model->get_employee_package_sale($result->id,date('Y-m-d'),date('Y-m-d'),'1')['amount'];
                $today_sale = $today_service_sale + $today_service_product_sale + $today_product_sale + $today_membership_sale + $today_package_sale;
                
                $total_available = $this->Salon_model->get_employee_available_total_time($result->id,date('Y-m-d'),$result->shift,$result->shift_type);
                
                $total_actual_avaiable = $total_available['total_actual_avaiable'];
                if ($total_actual_avaiable < 0) {
                    $total_actual_avaiable = 0;
                }
                $hours = floor($total_actual_avaiable / 60);
                $minutes = $total_actual_avaiable % 60;
                $formatted_time = sprintf('%02d hrs %02d mins', $hours, $minutes);

                $result->today_sale = (float)$today_sale;
                $result->total_actual_avaiable = $total_available['total_actual_avaiable'];
                $result->total_service_minutes = $total_available['total_service_minutes'];
                $result->total_working = $total_available['total_working'];
                $result->total_minutes_shift = $total_available['total_minutes_shift'];
                $result->total_minutes_break = $total_available['total_minutes_break'];
                $result->total_available_time = $formatted_time;
                
                $month_target = $this->Salon_model->get_single_target_details($result->salary_method);
                $year = date('Y');
                $month = date('m');                
                $start_date = date("$year-$month-01");
                $end_date = date("Y-m-t", strtotime($start_date));
                $start_date_mysql = date("Y-m-d", strtotime($start_date));
                $end_date_mysql = date("Y-m-d", strtotime($end_date));
                $start_timestamp = strtotime($start_date);
                $end_timestamp = strtotime($end_date);
                $total_days = ($end_timestamp - $start_timestamp) / (60 * 60 * 24) + 1;
                $emp_leaves = $this->Salon_model->get_employee_leaves($result->id,$start_date_mysql,$end_date_mysql);
                $weekly_off = 0;

                $consider_days = $total_days - $emp_leaves - $weekly_off;
                if(!empty($month_target)){
                    $start_amount = $month_target->start_amount;
                    $end_amount = $month_target->end_amount;
                    
                    $daily_target_min = $start_amount/$consider_days;
                    $daily_target_max = $end_amount/$consider_days;
                }else{
                    $daily_target_min = 0;
                    $daily_target_max = 0;
                }

                $result->daily_target_min = $daily_target_min;
                $result->daily_target_max = $daily_target_max;
                $result->is_month_target = !empty($month_target) ? true : false;
                
                $emp_leave = $this->Salon_model->check_emp_leave($result->id, date('Y-m-d'));
                if (empty($emp_leave)) {
                    $emp_today_attendance = $this->Salon_model->get_employee_attendance($result->id, '', date('Y-m-d'), date('Y-m-d'));
                    if (!empty($emp_today_attendance)) {
                        $back_color = '';
                        $att_text = '';
                    } else {
                        $back_color = 'background-color:#c0dcf3 !important;';
                        $att_text = 'Not Present Today';
                    }
                } else {
                    $back_color = 'background-color:#e5819375 !important;';
                    $att_text = 'On Leave Today';
                }

                $result->back_color = $back_color;
                $result->att_text = $att_text;

                $title = '<div class="stylist-sale-tooltip" style="' . $back_color . '">';

                if ($att_text != "") {
                    $title .= '<p style="text-align: center;border-bottom: 1px solid #ccc;">' . htmlspecialchars($att_text) . '</p>';
                }

                if ($result->is_month_target) {
                    $title .= '<p>Daily Target <span class="amount" style="float: right;">Rs. ' 
                        . number_format($result->daily_target_min, 2, '.', ',') . ' To ' 
                        . number_format($result->daily_target_max, 2, '.', ',') . '</span></p>';
                }

                $title .= '<p>Today Booking <span class="amount" style="float: right;">' 
                    . $result->services_count_today . '</span></p>';

                $title .= '<p style="border-bottom: 1px solid #ccc;">Today Sale <span class="amount" style="float: right;">Rs. ' 
                    . $result->today_sale . '</span></p>';

                $title .= '<p>Available Time <span class="amount" style="float: right;">' 
                    . $result->total_available_time . ' Hrs</span></p>';

                $title .= '<div class="comment-square__arrow" style="' . $back_color . '"></div></div>';

                $result->column_header = $result->title . '' . $title;
            }
        }
        return $sorted_employees;
        
    }
    public function get_working_hours(){
        if ($this->input->post('date')) {
            $date = $this->input->post('date');
            $working_hrs = $this->Salon_model->get_saloon_working_hrs($date);
            echo json_encode($working_hrs);
        } else {
            echo json_encode(['is_allowed' => 0, 'start' => '06:30:00', 'end' => '23:59:59']);
        }
    }
    public function get_stylist_shift_events($date){
        $shift_events = [];
        $emps = $this->fetch_resources();
        if(!empty($emps)){
            foreach($emps as $row){
                $single_shift_details = $this->Salon_model->get_stylist_shifts($date,$row->id);
                if(!empty($single_shift_details)){
                    $shift_single_from = date('H:i:s',strtotime($single_shift_details['shift_from']));
                    $shift_single_to = date('H:i:s',strtotime($single_shift_details['shift_to']));

                    $shift_break_from = $single_shift_details['shift_break_from'];
                    $shift_break_to = $single_shift_details['shift_break_to'];

                    $shift_from_datetime = date('Y-m-d H:i:s', strtotime("$date $shift_single_from"));
                    $shift_to_datetime = date('Y-m-d H:i:s', strtotime("$date $shift_single_to"));

                    $shift_break_from_datetime = date('Y-m-d H:i:s', strtotime("$date $shift_break_from"));
                    $shift_break_to_datetime = date('Y-m-d H:i:s', strtotime("$date $shift_break_to"));
                    
                    $this->db->select('
                        b.id as leave_id,
                        b.emp_id,
                        e.full_name as stylist_name,
                        b.from_date as leave_start,
                        b.to_date as leave_end
                    ');
                    $this->db->from('tbl_salon_emp_leaves b');
                    $this->db->join('tbl_salon_employee e', 'e.id = b.emp_id');
                    if ($date != "") {
                        $this->db->where('DATE(b.from_date) <= ', $date);
                        $this->db->where('DATE(b.to_date) >= ', $date);
                    }
                    $this->db->where('b.emp_id', $row->id);
                    $this->db->where('b.branch_id', $this->session->userdata('branch_id'));
                    $this->db->where('b.salon_id', $this->session->userdata('salon_id'));
                    $this->db->where('b.is_deleted', '0');
                    $this->db->where_in('b.leave_status', ['0','1']);
                    $this->db->order_by('b.emp_id', 'asc');
                    $this->db->order_by('b.from_date', 'asc');    
                    $leave_results = $this->db->get()->row();
                    if(!empty($leave_results)){
                        $shift_events[] = [
                            'event_type' => '4',
                            'id' => 'shift_' . $single_shift_details['shift_id'],
                            'resourceId' => $row->id,
                            'stylist_name' => $row->full_name ?? '',
                            'start' => $shift_from_datetime,
                            'end' => $shift_to_datetime,
                            'leave_start' => $leave_results->leave_start,
                            'leave_end' => $leave_results->leave_end,
                            'title' => 'Leave',
                            'backgroundColor' => '#ffebee',
                            'borderColor' => '#f44336',
                            'textColor' => '#b71c1c',  
                            'is_cancel_allowed' => '0',
                            'is_rescheduling_allowed' => '0',
                        ];
                    }else{
                        $shift_events[] = [
                            'event_type' => '3',
                            'id' => 'shift_' . $single_shift_details['shift_id'],
                            'resourceId' => $row->id,
                            'stylist_name' => $row->full_name ?? '',
                            'start' => $shift_break_from_datetime,
                            'end' => $shift_break_to_datetime,
                            'title' => 'Shift Break',
                            'backgroundColor'=> '#E0E0E0',
                            'borderColor'=> '#9E9E9E',
                            'textColor'=> '#333333',
                            'is_cancel_allowed' => '0',
                            'is_rescheduling_allowed' => '0',
                        ];
                    }
                }
            }
        }
        return $shift_events;
    }
    public function fetch_resources_events($date = "") {
        $booking_rules = $this->Salon_model->get_booking_rules();
        $cancellation = $booking_rules->cancellation ?? 0;
        $booking_rescheduling = $booking_rules->booking_rescheduling ?? 0;
        
        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $start_date = date('Y-m-d', strtotime($start));
        $end_date = date('Y-m-d', strtotime($end));

        if($date == ''){
            $date = $start_date;
        }
        
        $this->db->select('
            b.id as break_id,
            b.stylist_id,
            e.full_name as stylist_name,
            b.from as break_start,
            b.to as break_end
        ');
        $this->db->from('tbl_stylist_short_breaks b');
        $this->db->join('tbl_salon_employee e', 'e.id = b.stylist_id');
        if ($date != "") {
            $this->db->where('DATE(b.break_date)', $date);
        }
        $this->db->where('b.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('b.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('b.is_deleted', '0');
        $this->db->where_in('b.break_status', ['0','2']);
        $this->db->order_by('b.stylist_id', 'asc');
        $this->db->order_by('b.from', 'asc');    
        $break_results = $this->db->get()->result();
        
        $shift_events = $this->get_stylist_shift_events($date);

        $this->db->select('
            b.id as booking_service_id,
            b.booking_id,
            b.stylist_id,
            e.full_name as stylist_name,
            b.service_from as service_start,
            b.service_to as service_end,
            s.service_name,
            s.service_name_marathi,
            nb.payment_status as main_payment_status,
            nb.receipt_no,
            nb.booking_status,
            nb.booking_payment_id,
            nb.payble_price,
            nb.total_discount_amount,
            nb.gst_amount,
            nb.amount_to_paid,
            c.id as customer_id,
            c.full_name as customer_name,
            c.customer_phone,
            scr.id as review_id,
            ascat.sup_category,
            ascat.sup_category_marathi,
            asubcat.sub_category as sub_category_name,
            asubcat.sub_category_marathi
        ');
        $this->db->from('tbl_booking_services_details b');
        $this->db->join('tbl_salon_emp_service s', 's.id = b.service_id');
        $this->db->join('tbl_salon_customer c', 'c.id = b.customer_name');
        $this->db->join('tbl_new_booking nb', 'nb.id = b.booking_id');
        $this->db->join('tbl_salon_employee e', 'e.id = b.stylist_id');
        $this->db->join('tbl_store_reviews scr', 'scr.booking_id = b.booking_id', 'left');
        $this->db->join('tbl_admin_sub_category asubcat', 'asubcat.id = s.sub_category');
        $this->db->join('tbl_admin_service_category ascat', 'ascat.id = s.category');
        if ($date != "") {
            $this->db->where('DATE(b.service_date)', $date);
        }
        $this->db->where('b.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('b.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('b.is_deleted', '0');
        $this->db->where_in('b.service_status', ['0', '1']);
        $this->db->order_by('b.booking_id', 'asc');
        $this->db->order_by('b.stylist_id', 'asc');
        $this->db->order_by('b.service_from', 'asc');
    
        $results = $this->db->get()->result();
        $grouped_appointments = [];
        $current_group_data = [];
    
        foreach ($results as $row) {
            $group_key = $row->booking_id . '-' . $row->stylist_id;
    
            if (!isset($grouped_appointments[$group_key])) {
                $service_from = new DateTime($row->service_start);
                $allowed_rescheduling_time = $service_from->modify("-$booking_rescheduling minutes")->format('Y-m-d H:i:s');
    
                $service_from_cancel = new DateTime($row->service_start);
                $allowed_cancel_time = $service_from_cancel->modify("-$cancellation minutes")->format('Y-m-d H:i:s');
                
                if ($row->booking_status == '1') {
                    $backgroundColor = '#FFD580';
                    $borderColor = '#E6B800';
                    $textColor = '#5A4500';
                } elseif ($row->booking_status == '2') {
                    $backgroundColor = '#FFB6C1';
                    $borderColor = '#CC7A8B';
                    $textColor = '#5C1F2D';
                } elseif ($row->booking_status == '5') {
                    $backgroundColor = '#90EE90';
                    $borderColor = '#4CAF50';
                    $textColor = '#215821';
                } else {
                    $backgroundColor = '#ADD8E6';
                    $borderColor = '#5AA9D6';
                    $textColor = '#1F3D4C';
                }

                $grouped_appointments[$group_key] = [
                    'event_type'                => '1',
                    'id'                        => $row->booking_id,
                    'resourceId'                => $row->stylist_id,
                    'booking_id'                => $row->booking_id,
                    'stylist_id'                => $row->stylist_id,
                    'stylist_name'              => $row->stylist_name,
                    'start'                     => $row->service_start,
                    'end'                       => $row->service_end,
                    'title'                     => '',
                    'booking_payment_status'    => $row->main_payment_status,
                    'customer_id'               => $row->customer_id,
                    'customer_name'             => $row->customer_name,
                    'customer_phone'            => $row->customer_phone,
                    'booking_no'                => $row->receipt_no,
                    'booking_status'            => $row->booking_status,
                    'color'                     => $backgroundColor,
                    'booking_payment_id'        => $row->booking_payment_id,
                    'is_rescheduling_allowed'   => '1', // You can add the actual logic here if needed: date('Y-m-d H:i:s') <= $allowed_rescheduling_time ? '1' : '0',
                    'is_cancel_allowed'         => '1', // You can add the actual logic here if needed: date('Y-m-d H:i:s') <= $allowed_cancel_time ? '1' : '0',
                    'final_payable_price'       => $row->payble_price,
                    'final_discount_amount'     => $row->total_discount_amount,
                    'final_gst_amount'          => $row->gst_amount,
                    'final_final_price'         => $row->amount_to_paid,
                    'review_id'                 => $row->review_id,
                    'booking_description'       => '',
                    'service_start_date'        => date('Y-m-d', strtotime($row->service_start)),
                    'service_start_time'        => date('H:i:s', strtotime($row->service_start)),
                    'service_end_date'          => date('Y-m-d', strtotime($row->service_end)),
                    'service_end_time'          => date('H:i:s', strtotime($row->service_end)),
                    'services'                  => [],                
                    'backgroundColor'           => $backgroundColor,
                    'borderColor'               => $borderColor,
                    'textColor'                 => $textColor,
                    'merged_service_ids'        => [],
                ];
            }
    
            $grouped_appointments[$group_key]['end'] = max($grouped_appointments[$group_key]['end'], $row->service_end);
            $grouped_appointments[$group_key]['merged_service_ids'][] = $row->booking_service_id;
            $grouped_appointments[$group_key]['services'][] = [
                'service_name'                  => $row->service_name,
                'service_name_marathi'          => $row->service_name_marathi,
                'sub_category_name'             => $row->sub_category_name,
                'sub_category_marathi'          => $row->sub_category_marathi,
                'service_start_time'            => date('H:i', strtotime($row->service_start)),
                'service_end_time'              => date('H:i', strtotime($row->service_end)),
            ];
        }
    
        $final_appointments = [];
        foreach ($grouped_appointments as &$appointment) {
            $services_description = '';
            $service_names = [];
            foreach ($appointment['services'] as $service) {
                $services_description .= $service['sub_category_name'] . ' -> <b>' . $service['service_name'] . '</b><br><br>';
                $service_names[] = $service['service_name'];
            }
            $appointment['booking_description'] = rtrim($services_description, '<br><br>');
            $appointment['title'] = implode(', ', $service_names);
            $appointment['merged_service_ids'] = implode(',', $appointment['merged_service_ids']);
            $final_appointments[] = $appointment;
        }

        $break_events = [];
        foreach ($break_results as $break) {
            $break_events[] = [
                'event_type'                => '2',
                'id'                        => $break->break_id,
                'resourceId'                => $break->stylist_id,
                'stylist_name'              => $break->stylist_name,
                'start'                     => $break->break_start,
                'end'                       => $break->break_end,
                'title'                     => 'Short Break',
                'color'                     => '#fb968f',
                'backgroundColor'           => '#fb968f',
                'borderColor'               => '#d25b53',
                'textColor'                 => '#4B2C2C',
                'is_cancel_allowed'         => '0',
                'is_rescheduling_allowed'   => '0',
            ];
        }
        
        $all_events = array_merge($final_appointments, $break_events, $shift_events);
    
        echo json_encode(array_values($all_events));
    }

    public function validate_timeslot($stylist_id, $selected_from, $selected_to, $branch_id, $salon_id) {
        $selected_from_date = date('Y-m-d', strtotime($selected_from));
        $selected_from = date('Y-m-d H:i:s', strtotime($selected_from));
        $selected_to = date('Y-m-d H:i:s', strtotime($selected_to));

        $current_datetime = date('Y-m-d H:i:s');
        if ($selected_from < $current_datetime) {
            return false;
        }
        
        $this->db->where('DATE(break_date)', $selected_from_date);
        $this->db->where('branch_id', $branch_id);
        $this->db->where('salon_id', $salon_id);
        $this->db->where('stylist_id', $stylist_id);
        $this->db->where('`from` <', $selected_to);
        $this->db->where('`to` >', $selected_from);
        $this->db->where('is_deleted', '0');
        $this->db->where_in('break_status', ['0','2']);
        $breaks = $this->db->get('tbl_stylist_short_breaks')->result();

        if (!empty($breaks)) {
            return false;
        }
        
        $this->db->where('tbl_booking_services_details.branch_id', $branch_id);
        $this->db->where('tbl_booking_services_details.salon_id', $salon_id);
        $this->db->where('tbl_booking_services_details.stylist_id', $stylist_id);
        $this->db->where('DATE(tbl_booking_services_details.service_date)', date('Y-m-d', strtotime($selected_from_date)));
        $this->db->where('tbl_booking_services_details.service_from <', $selected_to);
        $this->db->where('tbl_booking_services_details.service_to >', $selected_from);
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.service_status !=', '2');
        $bookings = $this->db->get('tbl_booking_services_details')->result();

        if (!empty($bookings)) {
            return false;
        }
        
        $single_shift_details = $this->Salon_model->get_stylist_shifts_all($selected_from_date,$stylist_id, $branch_id, $salon_id);
        if(!empty($single_shift_details)){
            $shift_break_from = $single_shift_details['shift_break_from'];
            $shift_break_to = $single_shift_details['shift_break_to'];

            $shift_break_from_datetime = date('Y-m-d H:i:s', strtotime("$selected_from_date $shift_break_from"));
            $shift_break_to_datetime = date('Y-m-d H:i:s', strtotime("$selected_from_date $shift_break_to"));

            // if(($selected_from < $shift_break_to_datetime && $selected_from > $shift_break_from_datetime) || ($selected_to < $shift_break_to_datetime && $selected_to > $shift_break_from_datetime)){
            //     return false;
            // }
            if ($selected_from < $shift_break_to_datetime && $selected_to > $shift_break_from_datetime) {
                return false;
            }
        }

        $is_leave = $this->Salon_model->check_staff_is_on_leave_all($stylist_id,$selected_from_date, $branch_id, $salon_id);
        if($is_leave == '1'){
            return false;
        }

        return true;
    }
    
    public function validate_timeslot_resc($stylist_id, $selected_from, $selected_to, $branch_id, $salon_id, $booking_id) {
        $selected_from_date = date('Y-m-d', strtotime($selected_from));
        $selected_from = date('Y-m-d H:i:s', strtotime($selected_from));
        $selected_to = date('Y-m-d H:i:s', strtotime($selected_to));

        $current_datetime = date('Y-m-d H:i:s');
        if ($selected_from < $current_datetime) {
            return false;
        }
        
        $this->db->where('DATE(break_date)', $selected_from_date);
        $this->db->where('branch_id', $branch_id);
        $this->db->where('salon_id', $salon_id);
        $this->db->where('stylist_id', $stylist_id);
        $this->db->where('`from` <', $selected_to);
        $this->db->where('`to` >', $selected_from);
        $this->db->where('is_deleted', '0');
        $this->db->where_in('break_status', ['0','2']);
        $breaks = $this->db->get('tbl_stylist_short_breaks')->result();

        if (!empty($breaks)) {
            return false;
        }
        
        $this->db->where('tbl_booking_services_details.branch_id', $branch_id);
        $this->db->where('tbl_booking_services_details.salon_id', $salon_id);
        $this->db->where('tbl_booking_services_details.stylist_id', $stylist_id);
        $this->db->where('DATE(tbl_booking_services_details.service_date)', date('Y-m-d', strtotime($selected_from_date)));
        $this->db->where('tbl_booking_services_details.service_from <', $selected_to);
        $this->db->where('tbl_booking_services_details.service_to >', $selected_from);
        $this->db->where('tbl_booking_services_details.is_deleted', '0');
        $this->db->where('tbl_booking_services_details.service_status !=', '2');
        $this->db->where('tbl_booking_services_details.booking_id !=', $booking_id);
        $bookings = $this->db->get('tbl_booking_services_details')->result();

        if (!empty($bookings)) {
            return false;
        }
        
        $single_shift_details = $this->Salon_model->get_stylist_shifts_all($selected_from_date,$stylist_id, $branch_id, $salon_id);
        if(!empty($single_shift_details)){
            $shift_break_from = $single_shift_details['shift_break_from'];
            $shift_break_to = $single_shift_details['shift_break_to'];

            $shift_break_from_datetime = date('Y-m-d H:i:s', strtotime("$selected_from_date $shift_break_from"));
            $shift_break_to_datetime = date('Y-m-d H:i:s', strtotime("$selected_from_date $shift_break_to"));

            // if(($selected_from < $shift_break_to_datetime && $selected_from > $shift_break_from_datetime) || ($selected_to < $shift_break_to_datetime && $selected_to > $shift_break_from_datetime)){
            //     return false;
            // }
            if ($selected_from < $shift_break_to_datetime && $selected_to > $shift_break_from_datetime) {
                return false;
            }
        }

        $is_leave = $this->Salon_model->check_staff_is_on_leave_all($stylist_id,$selected_from_date, $branch_id, $salon_id);
        if($is_leave == '1'){
            return false;
        }

        return true;
    }

    public function lock_time_period(){
        $from = $this->input->post('start');
        $to = $this->input->post('end');
        $stylist_id = $this->input->post('stylist_id');
        $salon_id = $this->session->userdata('salon_id');
        $branch_id = $this->session->userdata('branch_id');

        $is_allowed = $this->validate_timeslot($stylist_id, $from, $to, $branch_id, $salon_id);
        if($is_allowed){
            $data = array(
                'stylist_id'    =>  $stylist_id,
                'branch_id'     =>  $this->session->userdata('branch_id'),
                'salon_id'      =>  $this->session->userdata('salon_id'),
                'break_date'    =>  date('Y-m-d',strtotime($from)),
                'from'          =>  date('Y-m-d H:i:s',strtotime($from)),
                'to'            =>  date('Y-m-d H:i:s',strtotime($to)),
                'created_on'    =>  date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_stylist_short_breaks',$data);
            $break_id = $this->db->insert_id();

            echo json_encode(array('status'=>'1','break_id'=>$break_id));
        }else{
            echo json_encode(array('status'=>'0'));
        }
    }

    public function remove_short_break(){
        $data = array(
            'break_status'  =>  '1',
            'cancelled_on'  =>  date('Y-m-d H:i:s')
        );
        $this->db->where('salon_id', $this->session->userdata('salon_id'));
        $this->db->where('branch_id', $this->session->userdata('branch_id'));
        $this->db->where('id', $this->input->post('break_id'));
        $this->db->update('tbl_stylist_short_breaks',$data);
        echo '1';
    }

    public function fetch_appointment_ajax(){
        $currentDateTime = $this->input->post('currentDateTime');
        $this->db->select('
            b.booking_id,
            b.stylist_id,
            e.full_name as stylist_name,
            b.service_from as service_start,
            b.service_to as service_end,
            s.service_name,
            s.service_name_marathi,
            nb.payment_status as main_payment_status,
            nb.receipt_no,
            nb.booking_status,
            nb.booking_payment_id,
            nb.payble_price,
            nb.total_discount_amount,
            nb.gst_amount,
            nb.amount_to_paid,
            c.id as customer_id,
            c.full_name as customer_name,
            c.customer_phone,
            scr.id as review_id,
            ascat.sup_category,
            ascat.sup_category_marathi,
            asubcat.sub_category as sub_category_name,
            asubcat.sub_category_marathi
        ');
        $this->db->from('tbl_booking_services_details b');
        $this->db->join('tbl_salon_emp_service s', 's.id = b.service_id');
        $this->db->join('tbl_salon_customer c', 'c.id = b.customer_name');
        $this->db->join('tbl_new_booking nb', 'nb.id = b.booking_id');
        $this->db->join('tbl_salon_employee e', 'e.id = b.stylist_id');
        $this->db->join('tbl_store_reviews scr', 'scr.booking_id = b.booking_id', 'left');
        $this->db->join('tbl_admin_sub_category asubcat', 'asubcat.id = s.sub_category');
        $this->db->join('tbl_admin_service_category ascat', 'ascat.id = s.category');
        $this->db->where('nb.service_start_date', date('Y-m-d',strtotime($currentDateTime)));
        $this->db->where('nb.service_start_time', date('H:i:s',strtotime($currentDateTime)));
        $this->db->where('b.branch_id', $this->session->userdata('branch_id'));
        $this->db->where('b.salon_id', $this->session->userdata('salon_id'));
        $this->db->where('b.is_deleted', '0');
        $this->db->where_in('b.service_status', ['0']);
        $this->db->order_by('b.booking_id', 'asc');
        $this->db->order_by('b.stylist_id', 'asc');
        $this->db->order_by('b.service_from', 'asc');    
        $this->db->group_by('b.booking_id');    
        $results = $this->db->get()->result();
        if(!empty($results)){
            if(count($results) == 1){
                $count = count($results) . ' appointment';
            }else{
                $count = count($results) . ' appointments'; 
            }

            echo json_encode(array('status'=>'1','message'=>'You have ' . $count . ' scheduled for ' . date('h:i A',strtotime($currentDateTime))));
        }else{
            echo json_encode(array('status'=>'0','message'=>''));
        }
    }

    public function reschedule_appointment_ajax(){
        // echo '<pre>'; print_r($_POST); exit;
        $branch_id = $this->session->userdata('branch_id');
        $salon_id = $this->session->userdata('salon_id');
        $booking_id = $this->input->post('id');
        $stylist_id = $this->input->post('resourceId');
        $selectedfrom = $this->input->post('start') != "" ? date('Y-m-d H:i:s',strtotime($this->input->post('start'))) : '';
        $start_date = $selectedfrom != "" ? date('Y-m-d',strtotime($selectedfrom)) : '';
        $start_time = $selectedfrom != "" ? date('H:i:s',strtotime($selectedfrom)) : '';
        $end = $this->input->post('end');
        $merged_service_ids = $this->input->post('merged_service_ids') != "" ? explode(',',$this->input->post('merged_service_ids')) : [];
        if(!empty($merged_service_ids)){
            $this->db->where('branch_id', $branch_id);
            $this->db->where('salon_id', $salon_id);
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $booking_id);
            $booking_result = $this->db->get('tbl_new_booking')->row();
            if(!empty($booking_result)){
                $this->db->select('tbl_salon_employee.*, tbl_emp_designation.designation as designation_name');
                $this->db->join('tbl_emp_designation', 'tbl_salon_employee.designation = tbl_emp_designation.id', 'left');
                $this->db->where('tbl_salon_employee.branch_id', $branch_id);
                $this->db->where('tbl_salon_employee.salon_id', $salon_id);
                $this->db->where('tbl_salon_employee.is_deleted', '0');
                $this->db->where('tbl_salon_employee.id', $stylist_id);
                $this->db->where('tbl_emp_designation.designation', 'Stylist');
                $stylist_result = $this->db->get('tbl_salon_employee')->row();
                if(!empty($stylist_result)){                    
                    $this->db->where('is_deleted','0');
                    $this->db->where('booking_id', $booking_id);
                    $all_service_details = $this->db->get('tbl_booking_services_details')->result();

                    $this->db->where_in('id',$merged_service_ids);
                    $this->db->where('is_deleted','0');
                    $this->db->where('booking_id', $booking_id);
                    $service_details = $this->db->get('tbl_booking_services_details')->result();
                    if(count($all_service_details) == count($service_details)){
                        if(!empty($service_details)){
                            $stylist_services = explode(',', $stylist_result->service_name);
                            $complete_allowed = '1';
                            $update_data = [];
                            foreach($service_details as $row){ 
                                $is_allowed = false;
                                $service = $row->service_id;
                                $service_details_id = $row->id;
                                $old_rescheduled_count = $row->rescheduled_count != "" ? (int)$row->rescheduled_count : 0;
                                $this->db->select('tbl_salon_emp_service.*,tbl_admin_service_category.sup_category,tbl_admin_service_category.sup_category_marathi,tbl_admin_sub_category.sub_category,tbl_admin_sub_category.sub_category_marathi'); 
                                $this->db->where('tbl_salon_emp_service.id',$service);
                                $this->db->where('tbl_salon_emp_service.salon_id', $salon_id);
                                $this->db->where('tbl_salon_emp_service.branch_id', $branch_id);
                                $this->db->join('tbl_admin_service_category','tbl_admin_service_category.id = tbl_salon_emp_service.category');
                                $this->db->join('tbl_admin_sub_category','tbl_admin_sub_category.id = tbl_salon_emp_service.sub_category');
                                $single_service = $this->db->get('tbl_salon_emp_service')->row();                        
                                if (!empty($single_service)) {
                                    $service_from_datetime = new DateTime($selectedfrom);
                                    $service_to_datetime = new DateTime($selectedfrom);

                                    $service_duration = $single_service->service_duration;
                                    $interval = new DateInterval("PT{$service_duration}M");
                                    $service_to_datetime->add($interval);

                                    $selectedto = $service_to_datetime->format('Y-m-d H:i:s');
                                    if (in_array($service, $stylist_services)) {
                                        $is_stylist_available_storewise = $this->Salon_model->get_is_selected_booking_available_storewise_all($selectedfrom, $selectedto,$branch_id,$salon_id);
                                        if ($is_stylist_available_storewise) {
                                            $is_emergency = $this->Salon_model->check_is_salon_close_for_period_setup_datewise_all(date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                            if (!$is_emergency) {
                                                $is_stylist_available_shiftwise = $this->Salon_model->get_is_selected_stylist_available_shiftwise_details_all($stylist_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                if ($is_stylist_available_shiftwise['is_allowed']) {
                                                    $booking_shift_id = $is_stylist_available_shiftwise['shift_id'];
                                                    $booking_shift_type = $is_stylist_available_shiftwise['shift_type'];
                                                    $is_stylist_available_breakwise = $this->Salon_model->get_is_selected_stylist_available_breakwise_all($stylist_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                    if ($is_stylist_available_breakwise) {
                                                        $is_stylist_available_short_breakwise = $this->Salon_model->get_is_selected_stylist_available_short_breakwise($stylist_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                        if ($is_stylist_available_short_breakwise) {
                                                            $is_stylist_available_bookingwise = $this->Salon_model->get_is_selected_stylist_available_resch_bookingwise_all($service_details_id, $stylist_result->id, $selectedfrom, $selectedto,$branch_id,$salon_id);
                                                            if ($is_stylist_available_bookingwise) {
                                                                $leave_flag = $this->Salon_model->check_staff_is_on_leave_all($stylist_result->id, date('Y-m-d', strtotime($selectedfrom)),$branch_id,$salon_id);
                                                                if($leave_flag == '0'){
                                                                    $is_allowed = true;
                                                                    $update_data[] = array(
                                                                        'service_details_id'    =>  $service_details_id,
                                                                        'stylist_id'            =>  $stylist_result->id,
                                                                        'booking_shift_id'      =>  $booking_shift_id,
                                                                        'booking_shift_type'    =>  $booking_shift_type,
                                                                        'service_date'          =>  $start_date,
                                                                        'service_duration'      =>  $service_duration,
                                                                        'service_from'          =>  date('Y-m-d H:i:s',strtotime($selectedfrom)),
                                                                        'service_to'            =>  date('Y-m-d H:i:s',strtotime($selectedto)),
                                                                        'old_rescheduled_count' =>  $old_rescheduled_count
                                                                    );
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }                            
                                    $selectedfrom = $selectedto;
                                }                        
                                if (!$is_allowed) {
                                    $complete_allowed = '0';
                                }
                            }             

                            // echo '<pre>'; print_r($update_data);
                            // echo '<pre>'; print_r($merged_service_ids);
                            // echo $complete_allowed; exit; 

                            if($complete_allowed == '1' && !empty($update_data) && count($update_data) == count($merged_service_ids)){
                                for($j=0;$j<count($update_data);$j++){
                                    $service_update_data = array(
                                        'stylist_id'            =>  $update_data[$j]['stylist_id'],
                                        'booking_shift_id'      =>  $update_data[$j]['booking_shift_id'],
                                        'booking_shift_type'    =>  $update_data[$j]['booking_shift_type'],
                                        'service_date'          =>  $update_data[$j]['service_date'],
                                        'service_duration'      =>  $update_data[$j]['service_duration'],
                                        'service_from'          =>  $update_data[$j]['service_from'],
                                        'service_to'            =>  $update_data[$j]['service_to'],
                                        'is_rescheduled'        =>  '1',
                                        'lasr_rescheduled_on'   =>  date('Y-m-d H:i:s'),
                                        'rescheduled_count'     =>  $update_data[$j]['old_rescheduled_count'] + 1,
                                    );
                                    $this->db->where('id',$update_data[$j]['service_details_id']);
                                    $this->db->update('tbl_booking_services_details',$service_update_data);
                                }
                                
                                $this->Salon_model->update_booking_service_end($booking_id);

                                echo '3';
                            }else{
                                echo '1';
                            }
                        }else{
                            echo '0';
                        }    
                    }else{
                        echo '2';
                    }          
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
}
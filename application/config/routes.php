<?php defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Welcome/salon_login'; 
$route['set-offer-expiry'] = 'Welcome/set_offer_expiry'; 
$route['login']="Welcome/admin_login";
$route['test-notification']			= "welcome/test_notification";
$route['form'] = 'Welcome/form';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*-----------Swagger API Documentation Routes------*/
$route['swagger'] = "Swagger_controller/index";
$route['swagger/spec'] = "Swagger_controller/spec";
$route['swagger/controller/(:any)'] = "Swagger_controller/controller/$1";
$route['swagger/export'] = "Swagger_controller/export";


/*-----------Admin Routing Starts------*/
$route['admin-dashboard'] = "admin/Admin_controller/admin_dashboard";
$route['admin_do-logout'] = "admin/Admin_controller/do_logout"; 
$route['admin_inactive/(:any)/(:any)']='admin/Admin_controller/admin_inactive/$1';
$route['admin_active/(:any)/(:any)']='admin/Admin_controller/admin_active/$1';
$route['admin_delete/(:any)/(:any)']='admin/Admin_controller/admin_delete/$1';
$route['approve/(:any)/(:any)']='admin/Admin_controller/approve/$1';
$route['update-profile']='admin/Admin_controller/update_profile';
$route['salon-list'] = "admin/Admin_controller/salon_list";
$route['salon-list/(:any)'] = "admin/Admin_controller/salon_list/$1";
$route['add-salon']="admin/Admin_controller/add_salon";
$route['branch_payment']="admin/Admin_controller/branch_payment";
$route['branch_payment_history']="admin/Admin_controller/branch_payment_history";
$route['cron-reports']="admin/Admin_controller/cron_reports";
$route['whatsapp-message-report']="admin/Admin_controller/whatsapp_message_report";
$route['notifications-message-report']="admin/Admin_controller/notifications_message_report";
$route['branch_timeline']="admin/Admin_controller/branch_timeline";
$route['branch_coin_history']="admin/Admin_controller/branch_coin_history";
$route['branch_wp_coin_history']="admin/Admin_controller/branch_wp_coin_history";
$route['money-back'] = "admin/Admin_controller/branch_money_back"; 
$route['add-salon/(:any)']="admin/Admin_controller/add_salon/$1";
$route['category-type']="admin/Admin_controller/category_type";
$route['category-type/(:any)']="admin/Admin_controller/category_type/$1";
$route['add-branch/(:any)']="admin/Admin_controller/add_branch/$1";
$route['add-branch/(:any)/(:any)']="admin/Admin_controller/update_branch/$1";
$route['add-branch']="admin/Admin_controller/add_branch"; 
$route['branch-gallary/(:any)']="admin/Admin_controller/branch_gallary/$1"; 
$route['delete_branch_images/(:any)/(:any)']="admin/Admin_controller/delete_branch_images/$1";
// $route['branch-gallary/(:any)/(:any)']="admin/Admin_controller/branch_gallary/$1";
$route['owner-detail/(:any)']="admin/Admin_controller/owner_detail/$1";
$route['salon-gallary']="admin/Admin_controller/salon_gallary";
$route['salon-gallary/(:any)']="admin/Admin_controller/salon_gallary/$1";
$route['add-employee']="admin/Admin_controller/add_employee";
$route['add-employee/(:any)']="admin/Admin_controller/add_employee/$1";
$route['employee-list']="admin/Admin_controller/employee_list";
$route['whatsapp-addon-plans/(:any)']="admin/Admin_controller/whatsapp_addon_plans/$1";
$route['whatsapp-addon-plans/(:any)/(:any)']="admin/Admin_controller/whatsapp_addon_plans/$1";
$route['subscription-list']="admin/Admin_controller/subscription_list";
$route['add-subscription']="admin/Admin_controller/add_subscription";
$route['add-subscription/(:any)']="admin/Admin_controller/add_subscription/$1";
$route['subscription-features']="admin/Admin_controller/subscription_features";
$route['subscription-features-slugs']="admin/Admin_controller/subscription_feature_slugs";
$route['subscription-features/(:any)']="admin/Admin_controller/subscription_features/$1";
$route['subscription-features-slugs/(:any)']="admin/Admin_controller/subscription_feature_slugs/$1";
$route['add-admin-sup-category']="admin/Admin_controller/add_sup_category";
$route['add-admin-sup-category/(:any)']="admin/Admin_controller/add_sup_category/$1";
$route['add-admin-sub-category']="admin/Admin_controller/add_sub_category";
$route['add-admin-sub-category/(:any)']="admin/Admin_controller/add_sub_category/$1";
$route['add-admin-service']="admin/Admin_controller/add_admin_service";
$route['add-admin-service/(:any)']="admin/Admin_controller/add_admin_service/$1";
$route['add-customer-care']="admin/Admin_controller/add_customer_care";
$route['add-customer-care/(:any)']="admin/Admin_controller/add_customer_care/$1";
$route['customer-care-list']="admin/Admin_controller/customer_care_list";
$route['customer-care-report']="admin/Admin_controller/customer_care_report";
$route['customer-care-report/(:any)/(:any)']="admin/Admin_controller/customer_care_report/$1";
$route['customer-care-report-list']="admin/Admin_controller/customer_care_report_list";
$route['add_admin_attendance'] = "admin/Admin_controller/add_admin_attendance";
$route['admin_attendance'] = "admin/Admin_controller/admin_attendance";
$route['generate_admin_salary'] = "admin/Admin_controller/generate_admin_salary";
$route['print_salary_slip/(:num)'] = "admin/Admin_controller/print_salary_slip/$1";
$route['admin-salary-list'] = "admin/Admin_controller/admin_salary_list";
$route['add-lead'] = "admin/Admin_controller/add_lead";
$route['lead-list'] = "admin/Admin_controller/lead_list";
$route['crm-status-master'] = "admin/Admin_controller/crm_status_master";
$route['crm-status-master/(:any)'] = "admin/Admin_controller/crm_status_master/$1";
$route['view-calling-history'] = "admin/Admin_controller/view_calling_history";
$route['salon-customer-list'] = "admin/Admin_controller/salon_customer_list";
$route['pending-salon-service'] = "admin/Admin_controller/pending_salon_service";
$route['add-expense-category'] = "admin/Admin_controller/add_expense_category";
$route['add-expense-category/(:any)'] = "admin/Admin_controller/add_expense_category/$1";
$route['add-booking-status'] = "admin/Admin_controller/add_booking_status"; 
$route['add-booking-status/(:any)'] = "admin/Admin_controller/add_booking_status/$1"; 
$route['add_membership_management'] = "admin/Admin_controller/add_membership_management"; 
$route['add_membership_management/(:any)'] = "admin/Admin_controller/add_membership_management/$1"; 
$route['admin_membership_list'] = "admin/Admin_controller/admin_membership_list"; 
$route['admin_add_coupon'] = "admin/Admin_controller/admin_add_coupon"; 
$route['admin_add_coupon/(:any)'] = "admin/Admin_controller/admin_add_coupon/$1"; 
$route['admin_list_coupon'] = "admin/Admin_controller/admin_list_coupon"; 
$route['reward_point_management'] = "admin/Admin_controller/reward_point_management"; 
$route['reward_point_management/(:any)'] = "admin/Admin_controller/reward_point_management/$1"; 
$route['admin_offer_list'] = "admin/Admin_controller/admin_offer_list"; 
$route['admin_add_offer'] = "admin/Admin_controller/admin_add_offer"; 
$route['admin_add_offer/(:any)'] = "admin/Admin_controller/admin_add_offer/$1"; 
$route['admin_giftcard_list'] = "admin/Admin_controller/admin_giftcard_list"; 
$route['admin_add_giftcard'] = "admin/Admin_controller/admin_add_giftcard"; 
$route['admin_add_giftcard/(:any)'] = "admin/Admin_controller/admin_add_giftcard/$1"; 
$route['admin_add_booking_status'] = "admin/Admin_controller/admin_add_booking_status"; 
$route['admin_add_booking_status/(:any)'] = "admin/Admin_controller/admin_add_booking_status/$1"; 
$route['admin_package_list'] = "admin/Admin_controller/admin_package_list"; 
$route['admin_add_package'] = "admin/Admin_controller/admin_add_package"; 
$route['admin_add_package/(:any)'] = "admin/Admin_controller/admin_add_package/$1"; 
$route['admin_booking_rules'] = "admin/Admin_controller/admin_booking_rules"; 
$route['rules_setup'] = "admin/Admin_controller/rules_setup"; 
$route['admin_product_category_list'] = "admin/Admin_controller/admin_product_category_list";
$route['admin_product_subcategory_list'] = "admin/Admin_controller/admin_product_subcategory_list";
$route['admin_product_category'] = "admin/Admin_controller/admin_product_category";
$route['admin_product_category/(:any)'] = "admin/Admin_controller/admin_product_category/$1";
$route['admin_product_subcategory'] = "admin/Admin_controller/admin_product_subcategory";
$route['admin_product_subcategory/(:any)'] = "admin/Admin_controller/admin_product_subcategory/$1";
$route['admin_product_list'] = "admin/Admin_controller/admin_product_list";
$route['admin_product_add'] = "admin/Admin_controller/admin_product_add";
$route['admin_product_add/(:any)'] = "admin/Admin_controller/admin_product_add/$1";
$route['pending_salon_product'] = "admin/Admin_controller/pending_salon_product";
$route['customize-messages'] = "admin/Admin_controller/customize_messages";
$route['addon-requests'] = "admin/Admin_controller/addon_requests";
$route['customize_message_response'] = "admin/Admin_controller/customize_message_response";
$route['rule-update-requests'] = "admin/Admin_controller/rule_update_requests";
$route['store-rule-update-requests'] = "admin/Admin_controller/store_rule_update_requests";
$route['rule-update-requests-response'] = "admin/Admin_controller/rule_update_requests_response";
$route["inactivate_booking_rule_setup/(:any)"] = "admin/Admin_controller/inactivate_booking_rule_setup/$1";
$route["activate_booking_rule_setup/(:any)"] = "admin/Admin_controller/activate_booking_rule_setup/$1";
//Customer Support Routes
$route['branch-customer-list/(:any)/(:any)'] = "admin/Admin_controller/branch_customer_list/$1";
$route['add-ticket-category'] = "admin/Admin_controller/add_reason";
$route['add-ticket-category/(:any)'] = "admin/Admin_controller/add_reason/$1";
$route['customer-tickets'] = "admin/Admin_controller/customer_queries";
$route['give-final-remark/(:any)'] = "admin/Admin_controller/give_final_remark/$1";
$route['give-replay/(:any)'] = "admin/Admin_controller/give_replay/$1";
$route['invalid-lead/(:any)'] = "admin/Admin_controller/invalid_lead/$1";
$route['valid-lead/(:any)'] = "admin/Admin_controller/valid_lead/$1";
$route['app-users'] = "admin/Admin_controller/app_users";
$route['website-contact-us'] = "admin/Admin_controller/all_website_contact_list";
$route['business-contact-us'] = "admin/Admin_controller/all_business_contact_list";
/*-----------Admin Routing Ends------*/



// Salon Survey Routes Start
$route['survey-list'] = 'admin/Survey_controller/survey_list';
// Salon Survey Routes End



// Salon_controller Starts
$route['set-store-close']="salon/Salon_controller/set_store_close";
$route['add-enquiry']="salon/Ajax_controller/add_enquiry";
$route['add-enquiry-form']="salon/Salon_controller/add_enquiry_form";
$route['add-reminder-form']="salon/Salon_controller/add_reminder_form";
$route['add-reminder']="salon/Ajax_controller/add_reminder";
$route['asign-membership']="salon/Salon_controller/asign_membership";
$route['asign-membership/(:any)']="salon/Salon_controller/asign_membership/$1";
$route['asign-membership-list']="salon/Salon_controller/asign_membership_list";
$route['asign-giftcard']="salon/Salon_controller/asign_giftcard";
$route['asign-package']="salon/Salon_controller/asign_package";
$route['asign-package/(:any)']="salon/Salon_controller/asign_package/$1";
$route['asign-package-list']="salon/Salon_controller/asign_package_list";
$route['asign-giftcard-list']="salon/Salon_controller/asign_giftcard_list";
$route['product-category']='salon/Salon_controller/product_category';
$route['product-category/(:any)']='salon/Salon_controller/product_category/$1';
$route['product-unit']='salon/Salon_controller/product_unit';
$route['product-unit/(:any)']='salon/Salon_controller/product_unit/$1';
$route['stop-bookings/(:any)/(:any)']='salon/Salon_controller/stop_bookings/$1';
$route['start-bookings/(:any)/(:any)']='salon/Salon_controller/start_bookings/$1';
$route['add-customer-discount'] = "salon/Salon_controller/add_customer_discount";
$route['add-customer-discount/(:any)'] = "salon/Salon_controller/add_customer_discount/$1";
$route['off_booking_manual_btn/(:any)']='salon/Salon_controller/off_booking_manual_btn/$1';
$route['on_booking_manual_btn/(:any)']='salon/Salon_controller/on_booking_manual_btn/$1';
$route['add-payment'] = "salon/Salon_controller/add_payment";
$route['add-payment/(:any)'] = "salon/Salon_controller/add_payment/$1";
$route['add-customer'] = "salon/Salon_controller/add_customer";
$route['add-customer/(:any)'] = "salon/Salon_controller/add_customer/$1";
$route['add-customer-payment/(:any)'] = "salon/Salon_controller/add_customer_payment/$1";
$route['off_btn_offset_session_time/(:any)']='salon/Salon_controller/off_btn_offset_session_time/$1';
$route['on_btn_offset_session_time/(:any)']='salon/Salon_controller/on_btn_offset_session_time/$1';
$route['salon_status_close/(:any)/(:any)']='salon/Salon_controller/salon_status_close/$1';
$route['salon_status_open/(:any)']='salon/Salon_controller/salon_status_open/$1';
$route['add-sup-category']="salon/Salon_controller/add_sup_category";
$route['add-sup-category/(:any)']="salon/Salon_controller/add_sup_category/$1";
$route['add_service_sub_category']="salon/Salon_controller/add_service_sub_category";
$route['add_service_sub_category/(:any)']="salon/Salon_controller/add_service_sub_category/$1";
$route['add-sub-category']="salon/Salon_controller/add_sub_category";
$route['add-sub-category/(:any)']="salon/Salon_controller/add_sub_category/$1";
$route['add_staff_attendance'] = "salon/Salon_controller/add_staff_attendance";
$route['add_staff_leave'] = "salon/Salon_controller/add_staff_leave";
$route['add_staff_leave/(:any)'] = "salon/Salon_controller/add_staff_leave/$1";
$route['set-attendance'] = "salon/Ajax_controller/set_attendance";
$route['employee-attendance'] = "salon/Salon_controller/employee_attendance";
$route['generate_salary_slip'] = "salon/Salon_controller/generate_salary_slip";
$route['generate_salary_slip/(:any)'] = "salon/Salon_controller/generate_salary_slip/$1";
$route['all-enquiries'] = "salon/Salon_controller/all_enquiries";
$route['all-reminders'] = "salon/Salon_controller/all_reminders";
$route['salon-dashboard'] = "salon/Salon_controller/salon_dashboard";
$route['salon-dashboard-new'] = "salon/Salon_controller/salon_dashboard_new";
$route['reschedule_service/(:any)'] = "salon/Salon_controller/reschedule_service/$1";
$route['cancel_booking_service/(:any)'] = "salon/Salon_controller/cancel_booking_service/$1";
$route['complete_booking_service/(:any)'] = "salon/Salon_controller/complete_booking_service/$1";
$route['bill-setup/(:any)'] = "salon/Salon_controller/bill_setup/$1";
$route['set-punch-out'] = "salon/Salon_controller/set_punch_out";
$route['generate-bill/(:any)'] = "salon/Salon_controller/generate_bill/$1";
$route['reschedule/(:any)'] = "front/Home_controller/reschedule_booking/$1";
$route['product-generate-bill/(:any)'] = "salon/Salon_controller/product_generate_bill/$1";
$route['bill-generation'] = "salon/Salon_controller/bill_generation";
$route['bill-list'] = "salon/Salon_controller/bill_list";
$route['add_extra_service/(:any)'] = "salon/Salon_controller/add_extra_service/$1";
$route['update_service/(:any)'] = "salon/Salon_controller/update_service/$1";
$route['do-logout'] = "salon/Salon_controller/do_logout";
$route['supplier-management'] = "salon/Salon_controller/supplier_management"; 
$route['supplier-management/(:any)'] = "salon/Salon_controller/supplier_management/$1"; 
$route['add-product-stock'] = "salon/Salon_controller/add_product_stock"; 
$route['add-product-stock/(:any)'] = "salon/Salon_controller/add_product_stock/$1"; 
$route['product-stock-list'] = "salon/Salon_controller/product_stock_list"; 
$route['add-product/(:any)'] = "salon/Salon_controller/add_product/$1"; 
$route['add-shift'] = "salon/Salon_controller/add_shift"; 
$route['add-shift/(:any)'] = "salon/Salon_controller/add_shift/$1"; 
$route['add-designation/(:any)'] = "salon/Salon_controller/add_designation/$1"; 
$route['add-designation'] = "salon/Salon_controller/add_designation"; 
$route['add_working_hours'] = "salon/Salon_controller/add_working_hours"; 
$route['add_working_hours/(:any)'] = "salon/Salon_controller/add_working_hours/$1"; 
$route['add-gallary'] = "salon/Salon_controller/add_gallary"; 
$route['add-gallary/(:any)'] = "salon/Salon_controller/add_gallary/$1"; 
$route['add-special-service'] = "salon/Salon_controller/add_special_service"; 
$route['add-special-service/(:any)'] = "salon/Salon_controller/add_special_service/$1";
$route['cancel_message/(:any)'] = "salon/Ajax_controller/cancel_message/$1"; 
$route['add-salon-employee'] = "salon/Salon_controller/add_salon_employee"; 
$route['add-salon-employee/(:any)'] = "salon/Salon_controller/add_salon_employee/$1"; 
$route['salon-employee-list'] = "salon/Salon_controller/employee_list"; 
$route['add-facilities'] = "salon/Salon_controller/add_facilities"; 
$route['add-facilities/(:any)'] = "salon/Salon_controller/add_facilities/$1"; 
$route['add-student'] = "salon/Salon_controller/add_student"; 
$route['add-student/(:any)'] = "salon/Salon_controller/add_student/$1"; 
$route['student-list'] = "salon/Salon_controller/student_list"; 
$route['update-student/(:any)'] = "salon/Salon_controller/update_student/$1"; 
$route['fees-history'] = "salon/Salon_controller/fees_history"; 
$route['fees-history/(:any)'] = "salon/Salon_controller/fees_history/$1"; 
// $route['fees-history/(:any)/(:any)'] = "salon/Salon_controller/fees_history/$1"; 
$route['payment-history'] = "salon/Salon_controller/payment_history"; 
$route['payment-history/(:any)'] = "salon/Salon_controller/payment_history/$1";
$route['payment-history/(:any)/(:any)'] = "salon/Salon_controller/payment_history/$1";
$route['payment-entry'] = "salon/Salon_controller/payment_entry"; 
$route['payment-entry/(:any)'] = "salon/Salon_controller/payment_entry/$1"; 
$route['student-fees-history/(:any)'] = "salon/Salon_controller/student_fees_history/$1"; 
$route['product-barcode'] = "salon/Salon_controller/product_barcode"; 
$route['add-product-consumption'] = "salon/Salon_controller/add_product_consumption"; 
$route['salon-expense-list'] = "salon/Salon_controller/salon_expense_list";
$route['add-salon-expense'] = "salon/Salon_controller/add_salon_expense";
$route['add-salon-expense/(:any)'] = "salon/Salon_controller/add_salon_expense/$1";
$route['add-new-booking-new'] = "salon/Salon_controller/add_new_booking_new";
$route['add-new-booking-new/(:any)'] = "salon/Salon_controller/add_new_booking_new/$1";
$route['product-booking'] = "salon/Salon_controller/product_booking";
$route['add-new-booking'] = "salon/Salon_controller/add_new_booking";
$route['add-new-booking/(:any)'] = "salon/Salon_controller/add_new_booking/$1";
// $route['add-new-booking-stylist/(:any)/(:any)'] = "salon/Salon_controller/add_booking_stylist/$1";
$route['booking-calender'] = "salon/Salon_controller/booking_calender";
$route['store-booking-rules'] = "salon/Salon_controller/store_booking_rules";
$route['booking-rules'] = "salon/Salon_controller/booking_rules";
$route['booking-rules/(:any)'] = "salon/Salon_controller/booking_rules/$1";
$route['add_work_schedule'] = "salon/Salon_controller/add_work_schedule";
$route['update_work_schedule/(:any)'] = "salon/Salon_controller/add_work_schedule/$1";
$route['work_schedule_list'] = "salon/Salon_controller/work_schedule_list";
$route['salon-salary-list'] = "salon/Salon_controller/salon_salary_list";
$route['salon-attendance-list'] = "salon/Salon_controller/salon_attendance_list";
$route['salon-leaves-list'] = "salon/Salon_controller/salon_leaves_list";
$route['set-booking-status'] = "salon/Salon_controller/set_booking_status"; 
$route['set-booking-status/(:any)'] = "salon/Salon_controller/set_booking_status/$1"; 
$route['booking-list'] = "salon/Salon_controller/booking_list"; 
$route['product-booking-list'] = "salon/Salon_controller/product_booking_list"; 
$route['customer-list'] = "salon/Salon_controller/customer_list"; 
$route['transfer-bookings'] = "salon/Salon_controller/transfer_bookings"; 
$route['add-sub-category']="salon/Salon_controller/add_sub_category";
// $route['add-sub-category/(:any)']="salon/Salon_controller/add_sub_category/$1";
$route['subscription-report']="salon/Salon_controller/subscription_report";
$route['whatsapp-report']="salon/Salon_controller/whatsapp_report";
$route['trying-booking-list']="salon/Salon_controller/trying_booking_list";
$route['package-report']="salon/Salon_controller/package_report";
$route['membership-report']="salon/Salon_controller/membership_report";
$route['giftcard-report']="salon/Salon_controller/giftcard_report";
$route['sales-report']="salon/Salon_controller/sales_report";
$route['employee-report']="salon/Salon_controller/employee_report";
$route['customer-report']="salon/Salon_controller/customer_report";
$route['petty-cash']="salon/Salon_controller/petty_cash";
$route['store-images'] = "salon/Salon_controller/store_images"; 
$route['store-reviews-list'] = "salon/Salon_controller/store_reviews"; 
$route['salon-mobile-banner']="salon/Salon_controller/mobile_banner";
$route['salon-mobile-banner/(:any)']="salon/Salon_controller/mobile_banner/$1";
$route['employee_loan']="salon/Salon_controller/employee_loan";
$route['employee_loan/(:any)']="salon/Salon_controller/employee_loan/$1";
$route['coin_history']="salon/Salon_controller/branch_coin_history";
$route['consent-form']="salon/Salon_controller/consent_form";
$route['add-catlogue-salon'] = "salon/Salon_controller/add_catlogue";
$route['index'] = "salon/Salon_controller/index";
$route['calendar'] = "salon/Salon_controller/index";
// Salon_controller Ends



// Marketing_controller Start
$route['add-message']="salon/Marketing_controller/add_message";
$route['send_customize_message']="salon/Marketing_controller/send_customize_message";
$route['send_offer_message']="salon/Marketing_controller/send_offer_message";
$route['send_coupon_message']="salon/Marketing_controller/send_coupon_message";
$route['send_giftcard_message']="salon/Marketing_controller/send_giftcard_message";
$route['birthday'] = "salon/Marketing_controller/birthday"; 
$route['anniversary'] = "salon/Marketing_controller/anniversary"; 
$route['service_repeat'] = "salon/Marketing_controller/service_repeat"; 
$route['cancel_appointment'] = "salon/Marketing_controller/cancel_appointment"; 
$route['lost_customer'] = "salon/Marketing_controller/lost_customer"; 
$route['offer'] = "salon/Marketing_controller/offer"; 
$route['giftcards'] = "salon/Marketing_controller/giftcards"; 
$route['coupons'] = "salon/Marketing_controller/coupons"; 
$route['booking-promotion'] = "salon/Marketing_controller/booking_promotion"; 
$route['customize_message'] = "salon/Marketing_controller/customize_message"; 
$route['trying-booking']="salon/Marketing_controller/trying_booking";
$route['promo-message']="salon/Marketing_controller/promo_message";
// Marketing_controller End



//MASTERS CONTROLLER START
$route['add-facility']="Master_controller/add_facility";
$route['add-facility/(:any)']="Master_controller/add_facility/$1";
$route['salon-close-reason'] = "Master_controller/salon_close_reason";
$route['salon-close-reason/(:any)'] = "Master_controller/salon_close_reason/$1";
$route['add-tips']="Master_controller/add_tips";
$route['add-tips/(:any)']="Master_controller/add_tips/$1";
$route['add-gst-rate']="Master_controller/add_gst_rate";
$route['add-location']="Master_controller/add_location";
$route['add-location/(:any)']="Master_controller/add_location/$1";
$route['privacy-policy']="Master_controller/privacy_policy";
$route['terms-conditions']="Master_controller/terms_conditions";
$route['privacy-policy/(:any)']="Master_controller/privacy_policy/$1";
$route['app-support']="Master_controller/app_support";
$route['app-support/(:any)']="Master_controller/app_support/$1";
$route['terms-conditions/(:any)']="Master_controller/terms_conditions/$1";
$route['salon-marketing']="Master_controller/salon_marketing";
$route['salon-marketing/(:any)']="Master_controller/salon_marketing/$1";
$route['mobile-banner']="Master_controller/mobile_banner";
$route['mobile-banner/(:any)']="Master_controller/mobile_banner/$1";
$route['add-catlogue'] = "Master_controller/add_catlogue";
$route['app-help-management'] = "Master_controller/add_help_section";
$route['app-help-management/(:any)'] = "Master_controller/add_help_section/$1";
//MASTERS CONTROLLER END



//Onboarding Routes Start
$route['store-profile']='salon/Onboarding_controller/store_profile';
$route['working-hours']='salon/Onboarding_controller/working_hours';
$route['working-hours/(:any)']='salon/Onboarding_controller/working_hours/$1';
$route['working-hours/(:any)/(:any)']='salon/Onboarding_controller/working_hours/$1';
$route['salon-bank-details']='salon/Onboarding_controller/salon_bank_details';
$route['salon-location']='salon/Onboarding_controller/salon_location';
$route['product-list/(:any)'] = "salon/Onboarding_controller/product_list/$1"; 
$route['add-product'] = "salon/Onboarding_controller/add_product"; 
$route['use_ready_product_cat/(:any)/(:any)'] = "salon/Onboarding_controller/use_ready_product_cat/$1"; 
$route['use_ready_product_sub_cat/(:any)'] = "salon/Onboarding_controller/use_ready_product_sub_cat/$1"; 
$route['add_employee'] = "salon/Onboarding_controller/add_employee"; 
$route['add_employee/(:any)'] = "salon/Onboarding_controller/add_employee/$1"; 
$route['add_employee_list'] = "salon/Onboarding_controller/add_employee_list"; 
$route['add-salon-services'] = "salon/Onboarding_controller/add_salon_services"; 
$route['add-salon-services/(:any)'] = "salon/Onboarding_controller/add_salon_services/$1"; 
$route['add-salon-services/(:any)/(:any)'] = "salon/Onboarding_controller/add_salon_services/$1"; 
$route['salon-services-list/(:any)'] = "salon/Onboarding_controller/add_salon_services_list/$1"; 
$route['salon-services/(:any)'] = "salon/Onboarding_controller/salon_services/$1"; 
$route['ready-sub-category/(:any)'] = "salon/Onboarding_controller/ready_sub_category/$1";  
$route['ready-services/(:any)/(:any)'] = "salon/Onboarding_controller/ready_services/$1"; 
$route['employee_incentive_master'] = "salon/Onboarding_controller/employee_incentive_master"; 
$route['employee_incentive_master/(:any)'] = "salon/Onboarding_controller/employee_incentive_master/$1"; 
$route['add-package'] = "salon/Onboarding_controller/add_package"; 
$route['add-package/(:any)'] = "salon/Onboarding_controller/add_package/$1"; 
$route['package-list'] = "salon/Onboarding_controller/package_list"; 
$route['add-offers'] = "salon/Onboarding_controller/add_offers"; 
$route['add-offers/(:any)'] = "salon/Onboarding_controller/add_offers/$1"; 
$route['offers-list'] = "salon/Onboarding_controller/offers_list"; 
$route['add-coupon-code'] = "salon/Onboarding_controller/add_coupon_code"; 
$route['add-coupon-code/(:any)'] = "salon/Onboarding_controller/add_coupon_code/$1"; 
$route['add-salon-facility'] = "salon/Onboarding_controller/add_facility"; 
$route['add-salon-facility/(:any)'] = "salon/Onboarding_controller/add_facility/$1"; 
$route['add-reward-point'] = "salon/Onboarding_controller/add_reward_point"; 
$route['add-reward-point/(:any)'] = "salon/Onboarding_controller/add_reward_point/$1"; 
$route['add-gift-card'] = "salon/Onboarding_controller/add_gift_card";
$route['add-gift-card/(:any)'] = "salon/Onboarding_controller/add_gift_card/$1";
$route['gift-card-list'] = "salon/Onboarding_controller/gift_card_list";
$route['add-membership'] = "salon/Onboarding_controller/add_membership";
$route['add-membership/(:any)'] = "salon/Onboarding_controller/add_membership/$1";
$route['membership-list'] = "salon/Onboarding_controller/membership_list";
$route["add_automated_marketing"] = "salon/Onboarding_controller/add_automated_marketing";
$route["inactivate_marketing_discount/(:any)"] = "salon/Onboarding_controller/inactivate_marketing_discount/$1";
$route["activate_marketing_discount/(:any)"] = "salon/Onboarding_controller/activate_marketing_discount/$1";
$route['add-course'] = "salon/Onboarding_controller/add_course"; 
$route['add-course/(:any)'] = "salon/Onboarding_controller/add_course/$1"; 
$route['course-list'] = "salon/Onboarding_controller/course_list"; 
//Onboarding Routes End



//API Routes Start
$route['customer/login-otp']="api/Api_controller/login_otp";
$route['customer/set-fcm-token']="api/Api_controller/set_fcm_token";
$route['customer/login']="api/Api_controller/customer_login";
$route['customer/get-store']="api/Api_controller/get_store_details";
$route['customer/set-store']="api/Api_controller/set_store";
$route['customer/set-new-store']="api/Api_controller/set_new_store";
$route['customer/stores-list']="api/Api_controller/get_customer_stores";
$route['customer/profile-details']="api/Api_controller/get_customer_profile";
$route['customer/update-profile-details']="api/Api_controller/update_customer_profile";
$route['customer/get-store-genders']="api/Api_controller/get_store_genders";
$route['customer/store-profile']="api/Api_controller/get_store_profile";
$route['customer/store-employees']="api/Api_controller/get_store_employees";
$route['customer/store-about-us']="api/Api_controller/get_store_about_us";
$route['customer/store-gallary']="api/Api_controller/get_store_gallary";
$route['customer/store-facility']="api/Api_controller/get_store_facility";
$route['customer/store-tips']="api/Api_controller/get_store_tips";
$route['customer/store-reviews'] = "api/Api_controller/get_store_reviews";
$route['customer/privacy-policy']="api/Api_controller/get_privacy_policy";
$route['customer/terms-conditions']="api/Api_controller/get_terms_conditions";
$route['customer/banner']="api/Api_controller/get_banner";
$route['customer/catlogue']="api/Api_controller/get_catlogue";
$route['customer/store-service-products']="api/Api_controller/get_store_service_products";
$route['customer/store-services']="api/Api_controller/get_store_services";
$route['customer/store-special-services']="api/Api_controller/get_store_special_services";
$route['customer/store-product-category']="api/Api_controller/get_store_product_category";
$route['customer/store-service-category']="api/Api_controller/get_store_service_category";
$route['customer/store-socials']="api/Api_controller/get_store_socials";
$route['customer/store-packages']="api/Api_controller/get_store_packages";
$route['customer/store-memberships']="api/Api_controller/get_store_memberships";
$route['customer/store-offers']="api/Api_controller/get_store_offers";
$route['customer/store-coupons']="api/Api_controller/get_store_coupons";
$route['customer/store-giftcards']="api/Api_controller/get_store_giftcards";
$route['customer/store-stylist-selection']="api/Api_controller/get_stylist_selection_page_flag";
$route['customer/giftcard-details']="api/Api_controller/get_giftcard_details";
$route['customer/discounts']="api/Api_controller/calculate_discounts";
$route['customer/apply-offer']="api/Api_controller/apply_offer";
$route['customer/apply-rewards']="api/Api_controller/apply_rewards";
$route['customer/booking-rules']="api/Api_controller/get_booking_rules";
$route['customer/packages']="api/Api_controller/get_customer_packages";
$route['customer/notifications']="api/Api_controller/get_customer_notifications";
$route['customer/giftcards']="api/Api_controller/get_customer_giftcards";
$route['customer/booking-services']="api/Api_controller/get_booking_services";
$route['customer/timeslots']="api/Api_controller/get_available_timeslots";
$route['customer/reschedule-timeslots']="api/Api_controller/get_available_reschedule_timeslots";
$route['customer/service-stylists']="api/Api_controller/get_selected_service_stylists";
$route['customer/booking-stylists-review']="api/Api_controller/get_booking_stylists_review";
$route['customer/reschedule-stylists-review']="api/Api_controller/get_reschedule_stylists_review";
$route['customer/reschedule-service-stylists']="api/Api_controller/get_selected_reschedule_service_stylists";
$route['customer/reschedule-stylist-selection']="api/Api_controller/get_reschedule_stylist_selection_page_flag";
$route['customer/selected-stylists']="api/Api_controller/get_selected_stylists";
$route['customer/membership']="api/Api_controller/get_customer_membership";
$route['customer/booking-stylists']="api/Api_controller/booking_stylists";
$route['customer/reschedule-stylists']="api/Api_controller/reschedule_stylists";
$route['customer/booking']="api/Api_controller/set_booking";
$route['customer/buy-membership']="api/Api_controller/buy_membership";
$route['customer/buy-package']="api/Api_controller/buy_packages";
$route['customer/buy-giftcard']="api/Api_controller/buy_giftcard";
$route['customer/booking-dates']="api/Api_controller/booking_dates";
$route['customer/store-gst']="api/Api_controller/store_gst";
$route['customer/payments']="api/Api_controller/customer_payments";
$route['customer/canceled-bookings']="api/Api_controller/cancelled_bookings";
$route['customer/completed-bookings']="api/Api_controller/completed_bookings";
$route['customer/pending-bookings']="api/Api_controller/pending_bookings";
$route['customer/booking-details']="api/Api_controller/booking_details";
$route['customer/cancel-service']="api/Api_controller/cancel_service";
$route['customer/set-booking-reminder']="api/Api_controller/set_booking_reminder";
$route['customer/reschedule-appointment']="api/Api_controller/reschedule_appointment";
$route['customer/query-types'] = "api/Api_controller/get_help_types";
$route['customer/queries'] = "api/Api_controller/get_user_queries";
$route['customer/single-query'] = "api/Api_controller/get_user_single_query";
$route['customer/raise-query'] = "api/Api_controller/insert_user_query";
$route['customer/query-replays'] = "api/Api_controller/get_user_single_query_replays";
$route['customer/submit-query-replay'] = "api/Api_controller/insert_user_query_replay";
$route['customer/raise-review'] = "api/Api_controller/insert_user_review";
$route['customer/booking-reminder'] = "api/Api_controller/customer_booking_reminder";
$route['api_get_all_state']="api/Api_controller/api_get_all_state";
$route['api_get_state_wise_city']="api/Api_controller/api_get_state_wise_city";
$route['set_logged_in_user']='api/Api_controller/set_logged_in_user';
$route['set_user_logout']='api/Api_controller/set_user_logout';
$route['customer/reserve-timeslot']='api/Api_controller/reserve_timeslot';
$route['customer/trying-booking']='api/Api_controller/set_trying_for_booking';
$route['api_get_salon_rules']='api/Api_controller/api_get_salon_rules';
//API Routes Ends



// Home_controller Starts
$route['socket-logs'] = 'front/Home_controller/socket_logs';
$route['terms'] = 'front/Home_controller/terms';
$route['policy'] = 'front/Home_controller/policy';
$route['app_support'] = 'front/Home_controller/user_guide';
$route['payment_receipt/(:any)'] = "front/Home_controller/payment_receipt/$1";
$route['salon_do_logout'] = "front/Home_controller/salon_do_logout";
$route['inactive/(:any)/(:any)']='front/Home_controller/inactive/$1';
$route['active/(:any)/(:any)']='front/Home_controller/active/$1';
$route['delete/(:any)/(:any)']='front/Home_controller/delete/$1';
$route['upload_customers']			= "front/Home_controller/upload_customers";
$route['membership-print/(:any)']="front/Home_controller/membership_print/$1";
$route['package-print/(:any)']="front/Home_controller/package_print/$1";
$route['giftcard-print/(:any)']="front/Home_controller/giftcard_print/$1";
$route['salon_print_salary_slip/(:num)'] = "front/Home_controller/print_salary_slip/$1";
$route['mobile-booking-print/(:any)'] = "front/Home_controller/mobile_booking_print/$1"; 
$route['booking-print/(:any)/(:any)'] = "front/Home_controller/booking_print/$1"; 
$route['product-booking-print/(:any)/(:any)'] = "front/Home_controller/product_booking_print/$1"; 
$route['complete-profile'] = "front/Home_controller/complete_profile"; 
$route['client_consent_form']="front/Home_controller/client_consent_form";
$route['consent_thank']="front/Home_controller/consent_thank";
$route['skip-onboarding']="front/Home_controller/skip_onboarding";
$route['cancel-membership/(:any)']="front/Home_controller/cancel_membership/$1";
$route['update_bill/(:any)/(:any)']="front/Home_controller/update_bill/$1";
//CRON every day midnight
$route['update-emergency-closure']="front/Home_controller/update_emergency_closure";
//CRON everyday shift change
$route['change-rotational-shift']="front/Home_controller/change_rotational_shift";
//CRON every day morning 9am
$route['anniversary-wish']="front/Home_controller/send_anniversary_wish";
//CRON every day morning 9am
$route['birthday-wish']="front/Home_controller/send_birthday_wish";
//CRON every day evening 7pm
$route['service-reminder']="front/Home_controller/send_service_reminder";
//CRON every day evening 8pm
$route['lost-customer-message']="front/Home_controller/send_lost_customer_message";
//CRON every day morning 9am
$route['yesterday-cancel-bookings']="front/Home_controller/send_yesterday_cancel_booking_message";
//CRON every day evening 9pm
$route['tomorrow-booking-reminder']="front/Home_controller/send_tomorrow_booking_reminder";
//CRON every day morning 8am
$route['today-booking-reminder']="front/Home_controller/send_today_booking_reminder";
//CRON every day 3 times (8 Hrs Apart)
$route['reset-expired-subscriptions']="front/Home_controller/reset_expired_subscriptions";
// Home_controller Ends



// Survey Routes Starts
$route['survey'] = 'admin/Survey_controller/survey_form';
$route['survey/(:any)'] = 'admin/Survey_controller/survey_form/$1';
$route['survey/(:any)/(:any)'] = 'admin/Survey_controller/survey_form/$1';
$route['survey/(:any)/(:any)/(:any)'] = 'admin/Survey_controller/survey_form/$1';
$route['thank-you'] = 'admin/Survey_controller/thank_you';
// Survey Routes Ends



//Action Routes Starts
$route['purchase-add-on'] = 'Action_controller/purchase_add_on';
$route['request-add-on'] = 'Action_controller/request_add_on';
// $route['set-wp-feature'] = 'Action_controller/set_wp_feature';
//Action Routes Ends



$route['upload_services']			= "Upload_controller/upload_services";
$route['websocket'] = 'Websocket_controller/index';
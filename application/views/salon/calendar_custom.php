<?php include('header.php'); 
$total_stylists = count($salon_employee_list);
$single_size = 100/$total_stylists;
?>
<!-- FullCalendar Scheduler CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.5/main.min.css" rel="stylesheet"> -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.10.5/main.min.css" rel="stylesheet" />
 
<style>
    .fc .fc-button {
        height: 42px;
        padding: 10px !important;
        width: 60px;
    }
    .booking-legends {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
    .legend-item {
        display: flex;
        align-items: center;
    }
    .legend-color {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 10px;
        border-radius: 4px;
    }
    .completed {
        background-color: rgb(144, 238, 144);
    }
    .pending {
        background-color: rgb(255, 213, 128);
    }
    .bill_generated {
        background-color: #9ed8f2;
    }
    .cancelled {
        background-color: #ffd8d8;
    }
    @media (max-width: 767px) {
        .booking-legends {
            justify-content: space-between;
        }
        .legend-item {
            flex: 1 1 100%;
            margin-bottom: 10px;
        }
    }
    .fc .fc-timegrid-slot {
        height: 37px !important;
    }
    .timeslot-loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        margin: auto;
        margin-top: 25px;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    .timeslot_box {
        padding: 5px;
        border: 1px solid #ccc;
        height: 115px;
        display: block;
        float: left;
        width: 100%;
        margin-bottom: 2px;
    }
    .slot-tablinks {
        margin-bottom: 5px !important;
        padding: 2px 5px;
        border: none !important;
        cursor: pointer;
        background: transparent;
        color: #333;
        margin: 0px 1px;
        transition: color 0.4s, background-color 0.4s, font-size 0.4s;
        font-size: 12px;
        border: 0.5px solid #0000ff33;
    }
    .slot-tablinks:hover {
        color: #de4da7;
    }
    .timeslot_box .tab {
        display: flex;
        justify-content: space-around;
    }
    .slot-tablinks.active {
        color: #de4da7;
        border-bottom: 2px solid #de4da7 !important;
        border-radius: 1px;
    }
    .slot-tabcontent {
        display: none;
        max-width: 800px;
        text-align: center;
    }
    .slot-tabcontent.active {
        display: block;
    }
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');
    .list_radio {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .comment-square__arrow {
        border-bottom: none;
        border-right: none;
        height: 14px;
        width: 13px;
        position: absolute;
        bottom: -16px;
        left: calc(15% - 8px);
        transform: translatey(-9px) rotate(45deg);
        background-color: #feefdc;
    }
    .WrapRow {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        width: 95%;
        margin: 0 auto;
    }
    .add_enquiry_form .form-control {
        margin: 0px !important;
    }
    .add_enquiry_form {
        text-align: left !important;
    }
    .add_reminder_form .form-control {
        margin: 0px !important;
    }
    .add_reminder_form {
        text-align: left !important;
    }
    .navtabs {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
        margin-top: -10px;
        padding: 2px 0px;
        position: relative;
        margin-left: 22px;
    }
    .navtabs-center {
        text-align: center;
        justify-content: left;
        margin-bottom: 20px;
        margin-top: -10px;
        background: white;
        padding: 2px 0px;
        position: relative;
    }
    .navtab {
        padding: 10px;
        width: 90px;
        min-width: max-content;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
        color: black;
        margin-right: 10px !important;
        background-color: var(--white);
        color: var(--primary);
        margin: 0px 1px;
        transition: color 0.4s, background-color 0.4s, font-size 0.4s;
        font-size: 12px;
        border: 0.5px solid #0000ff33;
    }
    .stylist_sale_details_info {
        text-align: center;
    }
    .navtab:hover {
        color: var(--hover) !important;
        background-color: var(--hbg);
    }
    .navtab.active {
        color: var(--hover);
        background-color: var(--hbg);
    }
    .content {
        display: none;
        padding: 100px 20px 20px;
        max-width: 800px;
        text-align: center;
    }
    .content.active {
        display: block;
    }
    .custom_label input {
        margin-left: 0px !important;
    }
    .custom_label label {
        float: none !important;
        width: 100% !important;
        text-align: left !important;
    }
    .toggle-switch {
        position: relative;
        width: 60px;
        display: inline-block;
        text-align: left;
    }
    .toggle-switch-checkbox {
        display: none;
    }
    .toggle-switch-label {
        display: block;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 20px;
    }
    .toggle-switch-label:before {
        content: "";
        display: block;
        width: 22px;
        height: 22px;
        background: #ccc;
        border-radius: 20px;
        transition: 0.3s;
        margin: 2px;
    }
    .toggle-switch-checkbox:checked+.toggle-switch-label:before {
        background: #0000ff;
        transform: translateX(36px);
    }
    .service_details_div table tr td {
        padding: 5px !important;
    }
    .service_details_div table tr th {
        padding: 5px !important;
    }
    .booking_pricing_div table tr th {
        padding: 5px !important;
    }
    .coupon_details_div table tr td {
        padding: 5px !important;
    }
    .coupon_details_div table tr th {
        padding: 5px !important;
    }
    .giftcard_details_div table tr td {
        padding: 5px !important;
    }
    .giftcard_details_div table tr th {
        padding: 5px !important;
    }
    .rewards_details_div table tr td {
        padding: 5px !important;
    }
    .rewards_details_div table tr th {
        padding: 5px !important;
    }
    .product_details_div table tr td {
        padding: 5px !important;
    }
    .product_details_div table tr th {
        padding: 5px !important;
    }
    .service_details_box {
        max-height: 250px;
        overflow: hidden;
        overflow-y: auto;
    }
    .extra_service_price_table table tr th {
        padding: 5px !important;
    }
    .extra_service_products table tr th {
        padding: 5px !important;
    }
    .extra_service_products table tr td {
        padding: 5px !important;
    }
    .single_added_extra_service_details {
        margin-left: 0px;
        margin-right: 0px;
    }
    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
    .time {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .title {
        margin-top: 0;
        margin-bottom: 0;
    }
    .event-container {
        display: flex;
        align-items: center;
    }
    .right_col {
        min-height: auto !important;
    }
    #page {
        max-width: 960px;
        padding: 0 15px;
        margin: 40px auto;
        @media (max-height: 790px) {
            margin-top: 0;
        }
    }
    .page-header h1 {
        font-weight: 100;
    }
    .input,
    select {
        padding: 2px 5px;
    }
    .btn {
        padding: 10px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        background-repeat: no-repeat;
    }
    .fc .fc-button-primary:disabled {
        background-color: #cbcbd2;
        color: black;
    }
    .fc .fc-button-primary {
        background-color: var(--white);
        color: black;
        border-color: var(--hover);
        border: none;
        border-radius: none;
    }
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background-color: var(--white);
        color: var(--hover) !important;
        border-bottom: 2px solid var(--hover);
    }
    .bubble {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
        border-radius: 2px;
        background: #fff;
        padding: 15px;
        width: 420px;
        z-index: 99;
        position: absolute;
        .close {
            position: absolute;
            font-size: 24px;
            line-height: 1;
            padding: 0 5px;
            right: 5px;
            top: 5px;
        }
    }
    .bubble {
        border-color: #ccc;
        border: 1px solid;
        &-top,
        &-bottom {
            .arrow {
                left: 50%;
                margin-left: -10px;
            }
            .arrow:after {
                content: '';
                left: -10px;
            }
        }
        &-top {
            .arrow {
                border-top: 10px solid;
                top: 100%;
            }
            .arrow:after {
                border-top: #FFF 10px solid;
                bottom: 1px;
            }
        }
        &-bottom {
            .arrow {
                border-bottom: 10px solid;
                bottom: 100%;
            }
            .arrow:after {
                border-bottom: #FFF 10px solid;
                top: 1px;
            }
        }
    }
    .form-group {
        padding-bottom: 8px;
        &>input,
        &>.input-wrapper {
            margin-left: 4em;
            display: block;
        }
    }
    .btn-delete {
        margin-top: 5px;
        display: none;
        &:hover {
            text-decoration: underline;
        }
    }
    .usage {
        margin-top: 10px;
    }
    .popup {
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        background: rgba(0, 0, 0, 0.75);
        z-index: 999;
    }
    .popup_cancel {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        background: rgba(0, 0, 0, 0.75);
        z-index: 99999999999999;
    }
    .popup-inner-cancel {
        max-width: 400px;
        width: 90%;
        padding: 20px;
        position: absolute;
        top: 15%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }
    .popup-inner {
        max-width: 700px;
        width: 90%;
        padding: 20px;
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }
    .popup-inner_payment {
        max-width: 500px;
        width: 90%;
        padding: 20px;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }
    .popup_inner_reshedule {
        max-width: 800px;
        width: 90%;
        max-height: 500px;
        overflow-y: scroll;
        padding: 20px;
        position: absolute;
        top: 43%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }
    .popup-close:hover {
        background: rgba(0, 0, 0, 1);
        text-decoration: none;
        color: #fff;
    }
    .cc_payment_fild_1 {
        margin-left: 0px !important;
    }
    #payment_form label {
        width: auto !important;
    }
    .dropzone {
        min-height: 225px;
        background: #fffadf;
        border: 0px !important;
        width: 183px;
        list-style: none;
        padding-left: 9px;
        padding-top: 0px;
    }
    .time_slot_and_detail .cc_bb_detail_booked {
        background-color: #fffadf;
        width: 556px;
        height: 226px;
        cursor: pointer;
    }
    .time_slot_and_detail .cc_bb_detail_booked div {
        font-size: 10px;
        height: 36px;
    }
    .current_month_name {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        width: calc(100%/<?php echo $staff_count; ?>);
        background-color: #97c8f9;
        color: #2e1f1f;
        font-weight: 700;
        padding: 5px;
    }
    .current_month_date_detail {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        width: calc(100%/<?php echo $staff_count; ?>);
        color: #605353;
        font-weight: 700;
        padding: 15px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .emp_name_content {
        width: calc(95%/<?php echo $staff_count; ?>);
        float: left;
        text-align: center;
        padding-left: 24px;
        cursor: pointer !important;
    }
    .current_week_name {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        width: calc(100%/<?php echo $staff_count; ?>);
        background-color: #97c8f9;
        color: #2e1f1f;
        font-weight: 700;
        padding: 5px;
    }
    .current_week_name_for_month {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        width: calc(100%/<?php echo $staff_count; ?>);
        background-color: #97c8f9;
        color: #2e1f1f;
        font-weight: 700;
        padding: 5px;
    }
    .current_week_time_detail {
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        width: calc(100%/<?php echo $staff_count; ?>);
        color: #605353;
        font-weight: 700;
        padding: 15px;
        border-left: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }
    .time_slot_and_detail .cc_bb_detail {
        background-color: #fffadf;
        padding-left: 0px;
        width: calc(95% /<?php echo $staff_count; ?>);
        float: left;
        height: 226px;
        border-right: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
    }
    .dashboard_list_btn {
        padding: 10px;
        min-width: 110px;
        margin: 0 10px 10px 0px;
    }
    .dashboard_list_btn a {
        color: var(--white);
    }
    .dashboard_list_btn i {
        margin-right: 5px;
        font-size: 15px;
    }
    .dashboard_list_btn:hover i,
    .dashboard_list_btn:hover a {
        color: var(--hover);
    }
    .dashboard_menu_list .tabs {
        margin-top: 7px;
    }
    .message-tab li.active a {
        color: var(--hover) !important;
    }
    .message-tab li.active {
        border-color: var(--hover) !important;
    }
    .fc .fc-col-header-cell-cushion {
        display: inline-block;
        padding: 10px !important;
        color: white;
        font-weight: 500 !important;
        letter-spacing: 1.1px;
    }
    table.fc-col-header {
        background: linear-gradient(271deg, #800080, #ff69b4) !important;
    }
    .chosen-container .chosen-results li {
        padding: 10px !important;
    }
    thead {
        background-color: linear-gradient(271deg, #800080, #ff69b4) !important;
    }
    .toggle-icon {
        transition: transform 0.75s ease;
    }

    .toggle-icon.rotated {
        transform: rotate(90deg);
    }
</style>
<div class="right_col" role="main">
    <?php
    if (!empty($close_setup)) {
        if (date('Y-m-d', strtotime($close_setup->to_date)) >= date('Y-m-d')) {
    ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" style="background-color: #f443362e;color: red;border: 1px solid #f4433647 !important;">
                        <div style="text-align: center;font-size: 15px;">
                            Salon is closed from <?php echo date('d M, Y', strtotime($close_setup->from_date)) . ' To ' . date('d M, Y', strtotime($close_setup->to_date)); ?>. <a onclick="showDashboardDataPopup('6')" data-toggle="modal" data-target="#DashboardModal" style="cursor:pointer;color:black;text-decoration:underline;" class="store-profile">Update</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
    <?php
    if ($gst == "") { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                        Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="show_more_div">
            <button class="btn btn-primary show_nav" id="alter_btn">
                <i class="fa-solid fa-chevron-right toggle-icon"></i>
            </button>
        </div>
        <div class="row dashboard_list_links_row" id="counts_div" style="display:block;">
            <div class="col-md-12 dashboard_menu_list">
                <div class="tabs" id="exTab2">
                    <ul class="nav nav-tabs message-tab">
                        <li class="active" id="tab_1">
                            <a href="#1" data-toggle="tab">Appoinment</a>
                        </li>
                        <li id="tab_2">
                            <a href="#2" data-toggle="tab" onclick="calculateSalesDashbaordCounts()">Sales</a>
                        </li>
                        <li id="tab_3">
                            <a href="#3" data-toggle="tab" onclick="calculateRedemptionDashbaordCounts()">Redemptions</a>
                        </li>
                        <li id="tab_4">
                            <a href="#4" data-toggle="tab" onclick="calculateFinanceDashbaordCounts()">Finance</a>
                        </li>
                        <li id="tab_5">
                            <a href="#5" data-toggle="tab" onclick="calculateProductDashbaordCounts()">Product</a>
                        </li>
                    </ul><br>
                </div>
                <div class="dashboard_list_col">
                    <?php if (!empty($profile) && $profile->subscription_name != "" && $profile->pending_due_amount != "" && (float)$profile->pending_due_amount > 0) { ?>
                        <a onclick="showDashboardDataPopup('8')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['subscription-report'], $feature_slugs))) {
                                                                                                                                echo 'blurred ';
                                                                                                                            } ?>add_new_booking">
                            <div class="btn btn-primary dashboard_list_btn">
                                <i class="fas fa-user-check"></i> Active Subscription
                            </div>
                        </a>
                    <?php } ?>
                    <a onclick="showDashboardDataPopup('5')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['add_staff_attendance'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-user-check"></i> Mark Attendance
                        </div>
                    </a>
                    <?php $check_slugs = [
                        'salon-reminder',
                        'add-reminder-form',
                        'today_reminders',
                        'yesterday_cancel_appointments',
                        'service_repeat_reminder_list'
                    ]; ?>
                    <a onclick="showDashboardDataPopup('0')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect($check_slugs, $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-bell"></i> Reminder
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('7')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['today-enquiries'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-question-circle"></i> Enquiry
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('1')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['today_birthday_reminder_list'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-birthday-cake"></i> Birthday
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('2')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['today_anniversary_reminder_list'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-heart"></i> Anniversary
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('3')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['low_stock_products'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-box"></i> Inventory
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('4')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['dashboard_account_counts'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                    </a>
                    <a onclick="showDashboardDataPopup('6')" data-toggle="modal" data-target="#DashboardModal" class="<?php if (empty(array_intersect(['close_store_emergency'], $feature_slugs))) {
                                                                                                                            echo 'blurred ';
                                                                                                                        } ?>add_new_booking">
                        <div class="btn btn-primary dashboard_list_btn">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="1">
                    <div class="row tile_count">
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Todays Booking</span>
                                <div class="center-part">
                                    <div class="count" id="today_booking_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\today_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Pending</span>
                                <div class="center-part">
                                    <div class="count" id="pending_booking_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\pending_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> In Progress</b>
                            <div class="center-part">
                                <div class="count" id="in_process_booking_count">0</div>
                                <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div> -->
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Completed </span>
                                <div class="center-part">
                                    <div class="count" id="completed_booking_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\completed_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Cancelled</span>
                                <div class="center-part">
                                    <div class="count " id="cancelled_booking_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\cancel-booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Trying for Booking</span>
                                <div class="center-part">
                                    <div class="count " id="trying_booking_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\trying.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="2">
                    <div class="row tile_count">
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Todays Total Sale</span>
                                <div class="center-part">
                                    <div class="count" id="today_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\today_sale.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i>Total Sale</span>
                                <div class="center-part">
                                    <div class="count" id="total_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_sale.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div> -->
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Service</span>
                                <div class="center-part">
                                    <div class="count" id="total_service_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_services.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Product </span>
                                <div class="center-part">
                                    <div class="count" id="total_product_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_product_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Membership </span>
                                <div class="center-part">
                                    <div class="count" id="total_membership_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_product_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Package</span>
                                <div class="center-part">
                                    <div class="count " id="total_package_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_package_sale.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Giftcard </span>
                                <div class="center-part">
                                    <div class="count" id="total_giftcard_sale_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_product_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="3">
                    <div class="row tile_count">
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Memberships</span>
                                <div class="center-part">
                                    <div class="count" id="total_used_memberships_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\membership.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Packages</span>
                                <div class="center-part">
                                    <div class="count" id="total_used_package_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\package.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Giftcards</span>
                                <div class="center-part">
                                    <div class="count" id="total_used_giftcards_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\gift-card.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Coupons</span>
                                <div class="center-part">
                                    <div class="count" id="total_used_coupons_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\coupons.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Offers</span>
                                <div class="center-part">
                                    <div class="count" id="total_used_offers_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\offers.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="4">
                    <div class="row tile_count">
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Cash</span>
                                <div class="center-part">
                                    <div class="count" id="total_cash_sales">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\cash_payments.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> UPI</span>
                                <div class="center-part">
                                    <div class="count" id="total_upi_sales">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\cash_payments.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-clock-o"></i> Card </span>
                                <div class="center-part">
                                    <div class="count" id="total_card_sales">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\card.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Cheque</span>
                                <div class="center-part">
                                    <div class="count" id="total_cheque_sales">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\online_booking.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Total Due</span>
                                <div class="center-part">
                                    <div class="count" id="total_due_sales">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\total_due.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd3 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Petty Cash</span>
                                <div class="center-part">
                                    <div class="count" id="total_petty_cash">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\petty_cash.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="5">
                    <div class="row tile_count">
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> High Stock</span>
                                <div class="center-part">
                                    <div class="count" id="high_stock_product_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\high_stock.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                        <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                            <div class="right">
                                <span class="count_top"><i class="fa fa-user"></i> Low Stock</span>
                                <div class="center-part">
                                    <div class="count" id="low_stock_product_count">0</div>
                                    <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\low_stock.png" class="img-responsive dashboard_imgs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (empty($booking_rules)) { ?>
            <div class="row" style="text-align:center;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="error">Booking rules are not set.</label>
                </div>
            </div>
        <?php } ?>
        <div class="<?php if (empty(array_intersect(['booking_calendar'], $feature_slugs))) {
                        echo 'blurred ';
                    } ?>row" style="height: auto;overflow: hidden;padding: 0px;margin: 0px;background: white;box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <!-- Horizontal Scrollable Calendar Wrapper -->
            <div class="calendar-container">
              <div class="calendar" id="calendar"></div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Booking Legends</h3>
                    </div>
                    <div class="x_content">
                        <div class="booking-legends">
                            <div class="legend-item">
                                <span class="legend-color completed"></span> Completed
                            </div>
                            <div class="legend-item">
                                <span class="legend-color pending"></span> Pending
                            </div>
                            <div class="legend-item">
                                <span class="legend-color cancelled"></span> Cancelled
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="footer_terms">
        <a href="<?= base_url(); ?>terms?type=1" style="text-decoration:underline;">Terms and conditions</a>
        <a href="<?= base_url(); ?>policy?type=1" style="text-decoration:underline;">Privacy Policy</a>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-md" id="order_details_dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Booking Details</span>
                    <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 0px; margin-right: 30px;">
                        <div style="background-color:#0000ff21; height: 20px; width: 20px; border: 0.5px solid #ccc;margin-left: 5px;"></div>
                        <p style="margin-right: 5px; color:#000; margin-left: 10px; margin-top: 7px;font-size: 12px;">Extra Added Service</p>
                    </div>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('myModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="BookingReviewModal" tabindex="-1" aria-labelledby="BookingReviewLabel" aria-hidden="true">
    <div class="modal-dialog" id="order_review_dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BookingReviewLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Booking Review</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('BookingReviewModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_review_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="bookingNoteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="order_note_dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Customer Note</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('bookingNoteModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_note_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceRescheduleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Reschedule Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('ServiceRescheduleModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reschedule_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceCompleteModal" tabindex="-1" aria-labelledby="exampleModalComplete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalComplete">Complete Booking</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('ServiceCompleteModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="complete_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service<small style="float:right;margin-right: 25px;">(Note: Customer will get up to total discount)</small></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('addServiceModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_service_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateBillModal" tabindex="-1" aria-labelledby="exampleModalUpdateBill" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 450px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalUpdateBill">Update Payment Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('updateBillModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="update_bill_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceCancelModal" tabindex="-1" aria-labelledby="exampleModalCancel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 450px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCancel">Cancel Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('ServiceCancelModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cancel_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="BookingBillModal" tabindex="-1" aria-labelledby="BillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BillModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Generate Booking Bill</span>
                    <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 5px; margin-right: 30px;">
                        <div style="background-color:#0000ff21; height: 20px; width: 20px; border: 0.5px solid #ccc;"></div>
                        <p style="margin-right: 5px; color:#000; margin-left: 10px; margin-top: 7px;font-size: 12px;">Extra Added Service</p>
                    </div>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="openConfirmationDialog('Are you sure you want to close bill generation?', function(confirmed) { if (confirmed) { closePopup('BookingBillModal'); } })">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_bill_generation_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="BookingEditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Edit Booking</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('BookingEditModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_edit_response"></div>
        </div>
    </div>
</div>
<div class="loader_div">
    <div class="loader-new"></div>
</div>
<?php include('footer.php');
if (!empty($booking_rules)) {
    $rules_employee_selection = $booking_rules->employee_selection;
    $slot = $booking_rules->slot_time;
    $days_early_booking = $booking_rules->max_booking_range_day;
    $minutes_early_booking = $booking_rules->booking_time_range;
    if ($days_early_booking != "") {
        $max_date = date('Y-m-d', strtotime('+' . $days_early_booking . ' day'));
    } else {
        $max_date = date('Y-m-d', strtotime('+0 day'));
    }
} else {
    $rules_employee_selection = '1';
    $slot = 5;
    // $minutes_early_booking = $booking_rules->buffering_time;
    $minutes_early_booking = 0;
    $max_date = date('Y-m-d', strtotime('+0 day'));
}
$today = date('Y-m-d');
$hours = floor($slot / 60);
$minutes = $slot % 60;
$hoursFormatted = str_pad($hours, 2, '0', STR_PAD_LEFT);
$minutesFormatted = str_pad($minutes, 2, '0', STR_PAD_LEFT);

$slotDuration = "'{$hoursFormatted}:{$minutesFormatted}:00'";
?>

<!-- FullCalendar Scheduler JS (includes core and scheduler) -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.17/index.global.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_dashboard_counts_ajx",
            data: {},
            success: function(data) {
                var opts = $.parseJSON(data);

                $('#today_booking_count').text(parseInt(opts.today_all));
                $('#in_process_booking_count').text(parseInt(opts.in_process));
                $('#pending_booking_count').text(parseInt(opts.pending));
                $('#completed_booking_count').text(parseInt(opts.completed));
                $('#cancelled_booking_count').text(parseInt(opts.cancelled));
                $('#trying_booking_count').text(parseInt(opts.trying_booking));
            },
        });
    });
    function calculateSalesDashbaordCounts() {
        $('.loader_div').show();
        $('#today_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_service_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_product_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_package_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_membership_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_giftcard_sale_count').text(parseFloat('0.00').toFixed(2));
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_dashboard_sales_counts_ajx",
            data: {},
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var opts = $.parseJSON(data);
                    $('#today_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_service_sale + opts.today_service_product_sale + opts.today_product_sale + opts.today_membership_sale + opts.today_package_sale + opts.today_giftcard_sale).toFixed(2)));
                    $('#total_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_service_sale + opts.total_service_product_sale + opts.total_product_sale + opts.total_membership_sale + opts.total_package_sale + opts.total_giftcard_sale).toFixed(2)));
                    $('#total_service_sale_count').html(formatNumberInIndianFormat(parseFloat(opts.total_service_product_sale + opts.total_service_sale).toFixed(2)) + '<small><i title="Including Service Products" style="font-size: 12px;margin-top: 5px;margin-left: 5px;cursor:pointer;color:#008ec8;float:right;" class="fas fa-info-circle"></i></small>');
                    $('#total_product_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_product_sale).toFixed(2)));
                    $('#total_package_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_package_sale).toFixed(2)));
                    $('#total_membership_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_membership_sale).toFixed(2)));
                    $('#total_giftcard_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_giftcard_sale).toFixed(2)));
                }, 1000);
            },
        });
    }

    function formatNumberInIndianFormat(num) {
        // Convert number to string
        num = num.toString();

        // Split integer and decimal parts
        let [integerPart, decimalPart] = num.split('.');

        // Add commas to the integer part
        let lastThree = integerPart.slice(-3);
        let otherNumbers = integerPart.slice(0, -3);

        if (otherNumbers !== '') {
            lastThree = ',' + lastThree;
        }

        integerPart = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;

        // Combine integer and decimal parts
        return decimalPart ? integerPart + '.' + decimalPart : integerPart;
    }

    function calculateRedemptionDashbaordCounts() {
        $('.loader_div').show();
        $('#total_used_memberships_count').text(parseInt('0.00'));
        $('#total_used_coupons_count').text(parseInt('0.00'));
        $('#total_used_offers_count').text(parseInt('0.00'));
        $('#total_used_package_count').text(parseInt('0.00'));
        $('#total_used_giftcards_count').text(parseInt('0.00'));
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_dashboard_redemption_counts_ajx",
            data: {},
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var opts = $.parseJSON(data);
                    $('#total_used_memberships_count').text(parseInt(opts.total_used_memberships_count));
                    $('#total_used_coupons_count').text(parseInt(opts.total_used_coupons_count));
                    $('#total_used_offers_count').text(parseInt(opts.total_used_offers_count));
                    $('#total_used_package_count').text(parseInt(opts.total_used_package_count));
                    $('#total_used_giftcards_count').text(parseInt(opts.total_used_giftcards_count));
                }, 1000);
            },
        });
    }

    function calculateFinanceDashbaordCounts() {
        $('.loader_div').show();
        $('#total_cash_sales').text(parseFloat('0.00'));
        $('#total_upi_sales').text(parseFloat('0.00'));
        $('#total_cheque_sales').text(parseFloat('0.00'));
        $('#total_card_sales').text(parseFloat('0.00'));
        $('#total_due_sales').text(parseFloat('0.00'));
        $('#total_petty_cash').text(parseFloat('0.00'));
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/fetch_finance_report_data_ajx",
            method: 'POST',
            data: {
                from_date: '',
                to_date: ''
            },
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var response = JSON.parse(data);
                    $('#total_cash_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cash_sales).toFixed(2)));
                    $('#total_upi_sales').text(formatNumberInIndianFormat(parseFloat(response.total_upi_sales).toFixed(2)));
                    $('#total_cheque_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cheque_sales).toFixed(2)));
                    $('#total_card_sales').text(formatNumberInIndianFormat(parseFloat(response.total_card_sales).toFixed(2)));
                    $('#total_due_sales').text(formatNumberInIndianFormat(parseFloat(response.total_due_sales).toFixed(2)));
                    $('#total_petty_cash').text(formatNumberInIndianFormat(parseFloat(response.total_petty_cash).toFixed(2)));
                }, 1000);
            },
            error: function() {
                $('.loader_div').hide();
                alert("Error fetching service details");
            }
        });
    }

    function calculateProductDashbaordCounts() {
        $('.loader_div').show();
        $('#low_stock_product_count').text(parseInt('0.00'));
        $('#high_stock_product_count').text(parseInt('0.00'));
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_dashboard_product_counts_ajx",
            method: 'POST',
            data: {
                from_date: '',
                to_date: ''
            },
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var response = JSON.parse(data);
                    $('#low_stock_product_count').text(parseInt(response.low_stock_product_count));
                    $('#high_stock_product_count').text(parseInt(response.high_stock_product_count));
                }, 1000);
            },
            error: function() {
                $('.loader_div').hide();
                alert("Error fetching service details");
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $("#today_date").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
        $('.b_date').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });

        $('#dashboard').addClass('nv active');

        $('#toggleSwitch').change(function() {
            if (this.checked) {
                $('#counts_div').show();
            } else {
                $('#counts_div').hide();
            }
        });
    });
    function showPopup(id) {
        var exampleModal = $('#' + id);
        exampleModal.css('display', 'block');
        exampleModal.css('opacity', '1');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }

    function closePopup(id) {
        var exampleModal = $('#' + id);

        exampleModal.css('display', 'none');
        exampleModal.css('opacity', '0');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }
</script>

<script>
    var slotDuration = <?php echo $slotDuration; ?>;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            initialView: 'resourceTimeGridDay', // Agenda view with resources
            slotDuration: slotDuration, // Use the PHP-generated variable directly
            slotLabelInterval: slotDuration,
            editable: true,
            selectable: true,
            selectMirror: true,
            resourceAreaWidth: '<?php echo $single_size; ?>',
            resourceAreaHeaderContent: 'Resources',
            resources: '<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_ajx',
            events: '<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_events',
            headerToolbar: {
                left: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth,yearView',
                center: 'title',
                right: 'prev,customTodayButton,next'
            },
            customButtons: {
                customTodayButton: {
                    text: 'Today',
                    click: function() {
                        calendar.today();
                    }
                }
            },
            views: {
                yearView: {
                    type: 'dayGrid',
                    duration: { years: 1 },
                    buttonText: 'Year',
                    titleFormat: { year: 'numeric' }
                },
                resourceTimeGridDay: {
                    buttonText: 'Day',
                    titleFormat: { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }
                },
                resourceTimeGridWeek: {
                    buttonText: 'Week',
                    titleFormat: { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }
                },
                dayGridMonth: {
                    buttonText: 'Month',
                    titleFormat: { month: 'long', year: 'numeric' }
                }
            },
            eventClick: function(arg) {
                if (arg.event.extendedProps.booking_service_status == "2") {
                    var selectedDate = arg.event.start;
                    var maxDate = new Date(max_date_str);
                    var allowed_early_mins = minutes_early_booking_str;
                    if (selectedDate.toLocaleDateString() <= maxDate.toLocaleDateString()) {
                        var currentDate = new Date();
                        if (selectedDate >= currentDate) {
                            var currentTimeMillis = currentDate.getTime();
                            var allowedTimeMillis = allowed_early_mins * 60000;
                            var allowedTime = currentTimeMillis + allowedTimeMillis;

                            var allowedDateTime = new Date(allowedTime);
                            var date = arg.event.start.toLocaleDateString();
                            var time = arg.event.start.toLocaleTimeString();
                            var dateTimeString = date + ' ' + time;
                            var url = '<?= base_url(); ?>add-new-booking-new?start=' + dateTimeString + '&stylist=' + stylistData.single.id + '&customer=';
                            // if (confirm("Are you sure you want to book for this timeslot?")) {
                            openConfirmationDialog("Are you sure you want to book for this timeslot?", function(confirmed) {
                                if (confirmed) {
                                    window.open(url, '_blank');
                                }
                            });
                        }
                    }
                } else {
                    showBookingDetailsDiv(arg.event.extendedProps.booking_id);
                }
            },
            eventDrop: function(info) {
                // Update event on drag-and-drop
                $.ajax({
                    url: 'edit-event.php',
                    type: 'POST',
                    data: {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : null,
                        resourceId: info.event.getResources()[0]?.id || null
                    },
                    success: function(response) {
                        displayMessage('Event updated successfully', 'success');
                    },
                    error: function() {
                        displayMessage('Error updating event', 'error');
                        info.revert();
                    }
                });
            },
            eventResize: function(info) {
                // Update event on resize
                $.ajax({
                    url: 'edit-event.php',
                    type: 'POST',
                    data: {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : null,
                        resourceId: info.event.getResources()[0]?.id || null
                    },
                    success: function(response) {
                        displayMessage('Event updated successfully', 'success');
                    },
                    error: function() {
                        displayMessage('Error updating event', 'error');
                        info.revert();
                    }
                });
            },
            dateClick: function(arg) {
                calendar.changeView('resourceTimeGridDay', arg.date);
            },
            eventContent: function(arg) {
                var viewType = arg.view.type;
                var bookingStatus = arg.event.extendedProps.booking_status;
                var color = '#ADD8E6'; // Default color

                switch (bookingStatus) {
                    case '1':
                        color = '#FFD580';
                        break;
                    case '5':
                        color = '#90EE90';
                        break;
                    case '2':
                        color = '#FFB6C1';
                        break;
                    // Add more cases for other booking statuses if needed
                }
                var timeHtml = '';
                var descHtml = '';
                var customerHtml = '';
                var servicesHtml = ''; // To hold the merged service names
                var editButtonHtml = '';
                var completeButtonHtml = '';
                var cancelButtonHtml = '';
                var buttonHtml = '';
                var callButtonHtml = '';
                var noteButtonHtml = '';
                var reviewButtonHtml = '';
                var dotHtml = '';

                if (viewType == 'resourceTimeGridDay' || viewType == 'resourceTimeGridWeek') {
                    customerHtml = '<p class="customer" style="font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + '</b></p>';
                    timeHtml = '<p class="time" style="color:#000;"><b>' + arg.timeText + '</b></p>';
                    descHtml = '<p class="description" style="color:#000;">' + (arg.event.extendedProps.booking_description || '') + '</p>';
                    servicesHtml = '<p class="services" style="color:#000; font-size: 12px;">' + arg.event.title + '</p>'; // Display merged services
                }else if(viewType == 'dayGridMonth' || viewType == 'yearView'){
                    dotHtml = '<div class="dot" style="background-color:' + arg.event.backgroundColor + ';"></div>';
                    customerHtml = '<label class="customer" style="font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + '</b></label>';
                    timeHtml = '<label class="time" style="color:#000;">&nbsp;&nbsp;(' + arg.timeText + ')</label>';
                }

                if (viewType === 'resourceTimeGridDay') {
                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var eventStartTime = new Date(arg.event.start);
                        var currentTime = new Date();
                        // buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Add New Service" id="addServiceButton_' + arg.event.extendedProps.booking_id + '" onclick="showAddServicePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i style="font-size: 17px;color: black;" class="fa fa-plus"></i></button>';
                    }
                    if (arg.event.extendedProps.booking_status === '5') {
                        if (arg.event.extendedProps.booking_payment_status === '0') {
                            var base_url = "<?php echo base_url(); ?>";
                            var encodedId = btoa(arg.event.extendedProps.booking_id);
                            var bill_url = base_url + 'bill-setup/' + encodedId;
                            buttonHtml += '<a style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button_' + arg.event.extendedProps.booking_id + '" href=" ' + bill_url + ' " class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></button>';
                        } else {
                            buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Receipt" id="receiptButton_' + arg.event.extendedProps.booking_id + '" onclick="openReceiptLink(event, \'' + btoa(arg.event.extendedProps.booking_id) + '\', \'' + btoa(arg.event.extendedProps.booking_service_payment_id) + '\')" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-receipt"></i></button>';
                            buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Update Payment Details" type="button" id="updateBill_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBillUpdatePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#updateBillModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-edit"></i></button>';
                        }
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var eventStartTime = new Date(arg.event.start);
                        var currentTime = new Date();
                        var editButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Edit Booking" type="button" id="edit_button_' + arg.event.extendedProps.booking_id + '" onclick="showBookingEditPopupFromEvent(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#BookingEditModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-pencil"></i></button>';
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && arg.event.extendedProps.is_cancel_allowed == '1' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var cancelButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Cancel Service" type="button" id="cancel_button_' + arg.event.extendedProps.booking_id + '" onclick="showCancelPopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#exampleModalCancel" class="btn btn-primary event-action-button"><i style="color:red;font-size: 20px;" class="fas fa-times"></i></button>';
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var completeButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Complete Booking" type="button" id="complete_button_' + arg.event.extendedProps.booking_id + '" onclick="showCompletePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#ServiceCompleteModal" class="btn btn-primary event-action-button"><i style="color:green;font-size: 20px;" class="fas fa-check"></i></button>';
                    }

                    var callButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:' + arg.event.extendedProps.customer_mobile + '\'"><i style="color:red;font-size: 15px;margin-left: 4px;" class="fas fa-phone"></i></button>';

                    var noteButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Note" type="button" id="note_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingNotesDivCalendar(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#bookingNoteModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-sticky-note"></i></button>';

                    if (arg.event.extendedProps.review_id != '') {
                        var reviewButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Review" type="button" id="review_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingReviewDivCalender(event, ' + arg.event.extendedProps.review_id + ')" data-toggle="modal" data-target="#bookingReviewModal"><i style="color:black;font-size: 15px;margin-left: 3px;" class="fas fa-comment-dots"></i></button>';
                    }                     
                }

                var eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' +
                    '<div class="event-info">' +
                    dotHtml +
                    customerHtml +
                    timeHtml +
                    descHtml +
                    '<p class="title" style="color:#000;"></p>' +
                    editButtonHtml +
                    completeButtonHtml +
                    cancelButtonHtml +
                    buttonHtml +
                    callButtonHtml +
                    noteButtonHtml +
                    // reviewButtonHtml +
                    '</div></div>';   

                var popuphtml = '' +
                    '<p>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_phone + '</p>';
                // if (arg.event.extendedProps.booking_payment_status === '1') {
                //     popuphtml += '<p style="font-size:12px;width:100%;">Payable <small style="float:right;">Rs. ' + (parseFloat(arg.event.extendedProps.final_discount_amount) + parseFloat(arg.event.extendedProps.final_payable_price)).toFixed(2) + '</small></p>' +
                //         '<p style="font-size:12px;width:100%;">Discount <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_discount_amount).toFixed(2) + '</small></p>' +
                //         '<p style="font-size:12px;width:100%;">GST <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_gst_amount).toFixed(2) + '</small></p>' +
                //         '<p style="font-size:12px;width:100%;">Final Amt <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_final_price).toFixed(2) + '</small></p>';
                // }
                setTimeout(() => {
                    tippy('.calender_event_' + arg.event.extendedProps.booking_id + '', {
                        content: popuphtml,
                        allowHTML: true,
                        placement: 'top',
                        theme: 'light-border',
                    });
                }, 0);

                return {
                    html: eventContentHtml
                };
            },
            // Set the start and end of the visible time slots
            visibleRange: {
                start: '<?php echo $salon_avg_working['start']; ?>',
                end: '<?php echo $salon_avg_working['end']; ?>'
            },
            // Ensure that the slotMinTime and slotMaxTime are also set for proper rendering
            slotMinTime: '<?php echo $salon_avg_working['start']; ?>',
            slotMaxTime: '<?php echo $salon_avg_working['end']; ?>'
        });

        // Populate resource dropdown
        $.getJSON('<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_ajx', function(data) {
            var $select = $('#eventResource');
            $select.empty();
            data.forEach(function(resource) {
                $select.append(`<option value="${resource.id}">${resource.title || resource.id}</option>`); // Use resource.title here
            });
        });

        calendar.render();

        function displayMessage(message, type) {
            $('.response').html(`<div class="${type}">${message}</div>`);
            setTimeout(function() {
                $('.response').empty();
            }, 3000);
        }
    });
</script>
<script>
    function formatDate(dateString, timeString) {
        const date = new Date(dateString + 'T' + timeString);
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        const hours = ('0' + date.getHours()).slice(-2);
        const minutes = ('0' + date.getMinutes()).slice(-2);
        const seconds = ('0' + date.getSeconds()).slice(-2);

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function openReceiptLink(event, bookingId, bookingDetailsId) {
        event.stopPropagation();
        var url = "<?= base_url(); ?>booking-print/" + bookingId + "/" + bookingDetailsId;
        window.open(url, '_blank');
    }

    function openEditLink(event, bookingId, dateTimeString, customer) {
        event.stopPropagation();
        var url = '<?= base_url(); ?>add-new-booking-new?start=' + dateTimeString + '&booking_id= ' + bookingId + '&customer= ' + customer + '';
        window.open(url, '_blank');
    }

    function showPopup(id) {
        var exampleModal = $('#' + id);
        exampleModal.css('display', 'block');
        exampleModal.css('opacity', '1');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }

    function closePopup(id) {
        var exampleModal = $('#' + id);

        exampleModal.css('display', 'none');
        exampleModal.css('opacity', '0');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }
    
    function showBookingEditPopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_edit_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_edit_response').html(response)
                showPopup('BookingEditModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingEditPopupFromEvent(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_edit_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_edit_response').html(response)
                showPopup('BookingEditModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBillGenerationPopupCalendar(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_bill_generation_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_bill_generation_response').html(response)
                showPopup('BookingBillModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBillGenerationPopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_bill_generation_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_bill_generation_response').html(response)
                showPopup('BookingBillModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function setServicePrice(serviceDetailsID, bookingID) {
        var service_price = parseFloat($('#single_service_price_' + serviceDetailsID).val());
        var service_rewards = $('#service_rewards_hidden_' + serviceDetailsID).val();
        var current_total = parseFloat($('#total_service_amount_' + bookingID).val());
        var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
        var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
        var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

        if ($('#service_checkbox_' + serviceDetailsID).is(':checked')) {
            $(".product_checkbox_" + serviceDetailsID).attr('disabled', false);

            current_total = current_total + service_price;

            var tempArray = [];

            $(".product_checkbox_" + serviceDetailsID).each(function() {
                $(this).prop('checked', true);
                tempArray.push($(this).val());
            });

            for (var i = 0; i < tempArray.length; i++) {
                setServiceProductPrice(serviceDetailsID, tempArray[i], bookingID);
            }
        } else {
            $(".product_checkbox_" + serviceDetailsID).attr('disabled', true);

            current_total = current_total - service_price;

            var tempArray = [];
            $(".product_checkbox_" + serviceDetailsID).each(function() {
                if ($(this).prop('checked')) {
                    $(this).prop('checked', false);
                    tempArray.push($(this).val());
                }
            });

            for (var i = 0; i < tempArray.length; i++) {
                setServiceProductPrice(serviceDetailsID, tempArray[i], bookingID);
            }

            if (selected_coupon_id != '' && selected_coupon_id != "0") {
                removeCoupon(bookingID, selected_coupon_id, 'prev');
            }

            if (is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0") {
                removeGiftCard(bookingID);
            }
        }
        $('#total_service_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
        $('#total_service_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));

        setPayableServiceAmount(bookingID);
    }

    function setServiceProductPrice(serviceDetailsID, productDetailsID, bookingID) {
        var product_price = parseFloat($('#single_service_product_price_' + serviceDetailsID + '_' + productDetailsID).val());
        var current_total = parseFloat($('#total_product_amount_' + bookingID).val());
        var selected_product = parseInt($('#selected_product_' + serviceDetailsID).text());
        var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
        var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
        var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

        if ($('#service_products_checkbox_' + serviceDetailsID + '_' + productDetailsID).is(':checked')) {
            current_total = current_total + product_price;
            selected_product = selected_product + 1;
        } else {
            current_total = current_total - product_price;
            selected_product = selected_product - 1;

            if (selected_coupon_id != '' && selected_coupon_id != "0") {
                removeCoupon(bookingID, selected_coupon_id, 'prev');
            }

            if (is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0") {
                removeGiftCard(bookingID);
            }
        }
        $('#total_product_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
        $('#total_product_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));
        $('#selected_product_' + serviceDetailsID).text(parseInt(selected_product));

        setPayableServiceProductAmount(bookingID);
    }

    function setPayableServiceAmount(bookingID) {
        giftcard_discount = parseFloat($('#gift_discount_' + bookingID).val());
        member_service_discount = $('#m_service_discount_' + bookingID).val();
        membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

        if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
            member_service_discount = 0;
        } else {
            member_service_discount = parseFloat(member_service_discount);
        }

        total_service_amount = parseFloat($('#total_service_amount_' + bookingID).val());

        if (membership_discount_type == '0') {
            discount = (total_service_amount * member_service_discount) / 100;
        } else if (membership_discount_type == '1') {
            discount = member_service_discount;
        } else {
            discount = 0;
        }

        if (total_service_amount == 0) {
            discount = 0;
        }

        $('#m_service_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

        payable = total_service_amount - discount - giftcard_discount;

        $('#service_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        $('#service_payable_text_' + bookingID).text(parseFloat(payable).toFixed(2));

        setPayableAmount(bookingID);
    }

    function setPayableServiceProductAmount(bookingID) {
        member_product_discount = $('#m_product_discount_' + bookingID).val();
        membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

        if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
            member_product_discount = 0;
        } else {
            member_product_discount = parseFloat(member_product_discount);
        }

        total_product_amount = parseFloat($('#total_product_amount_' + bookingID).val());

        if (membership_discount_type == '0') {
            discount = (total_product_amount * member_product_discount) / 100;
        } else if (membership_discount_type == '1') {
            discount = member_product_discount;
        } else {
            discount = 0;
        }

        if (total_product_amount == 0) {
            discount = 0;
        }

        $('#m_product_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

        payable = total_product_amount - discount;

        $('#product_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        $('#product_payable_text_' + bookingID).html(parseFloat(payable).toFixed(2));

        setPayableAmount(bookingID);
    }

    function setPayableAmount(bookingID) {
        service_payable = parseFloat($('#service_payable_hidden_' + bookingID).val());
        product_payable = parseFloat($('#product_payable_hidden_' + bookingID).val());
        package_payable = parseFloat($('#package_amount_' + bookingID).val());
        membership_payable = parseFloat($('#membership_payment_amount_' + bookingID).val());

        payable = service_payable + product_payable + package_payable + membership_payable;

        $('#payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        setBookingAmount(bookingID);
    }


    function setBookingAmount(bookingID) {
        calculateTotalDiscount(bookingID);

        coupon_discount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
        reward_discount = parseFloat($('#reward_discount_amount_' + bookingID).val());
        payable = parseFloat($('#payable_hidden_' + bookingID).val());

        booking = payable - coupon_discount - reward_discount;

        $('#booking_amount_hidden_' + bookingID).val(parseFloat(booking).toFixed(2));
        $('#booking_amount_' + bookingID).text(parseFloat(booking).toFixed(2));

        setGST(bookingID);
    }

    function setGST(bookingID) {
        rate = 18;
        booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());

        gst_amount = (rate * booking_amount) / 100;

        $('#gst_amount_hidden_' + bookingID).val(parseFloat(gst_amount).toFixed(2));
        $('#gst_amount_' + bookingID).text(parseFloat(gst_amount).toFixed(2));

        setGrandTotal(bookingID);
    }

    function setGrandTotal(bookingID) {
        booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());
        gst_amount = parseFloat($('#gst_amount_hidden_' + bookingID).val());
        customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val());

        total = booking_amount + gst_amount;

        allowed_max = total + customer_pending_amount;
        $('#total_due_' + bookingID).text(parseFloat(allowed_max).toFixed(2));

        $('#paid_amount_' + bookingID).val(parseFloat(allowed_max).toFixed(2)).attr('max', parseFloat(allowed_max).toFixed(2));
        $('#grand_total_hidden_' + bookingID).val(parseFloat(total).toFixed(2));
        $('#grand_total_' + bookingID).text(parseFloat(total).toFixed(2));

        calculatePendingAmount(bookingID);
    }

    function calculatePendingAmount(bookingID) {
        grand_total = parseFloat($('#grand_total_hidden_' + bookingID).val()) || 0;
        paid_amount = parseFloat($('#paid_amount_' + bookingID).val()) || 0;
        customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val()) || 0;

        pending_now = (grand_total + customer_pending_amount) - paid_amount;

        $('#pending_amount_' + bookingID).val(parseFloat(pending_now).toFixed(2));
    }

    function calculateTotalDiscount(bookingID) {
        $('#discount_details_div_' + bookingID).html('');
        var membership_service_discount_amount = parseFloat($('#m_service_discount_amount_' + bookingID).val());
        var membership_product_discount_amount = parseFloat($('#m_product_discount_amount_' + bookingID).val());
        var coupon_discount_amount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
        var giftcard_discount_amount = parseFloat($('#gift_discount_' + bookingID).val());
        var reward_discount_amount = parseFloat($('#reward_discount_amount_' + bookingID).val());

        total_discount = membership_service_discount_amount + membership_product_discount_amount + coupon_discount_amount + giftcard_discount_amount + reward_discount_amount;
        $('#discount_amount_' + bookingID).text(parseFloat(total_discount).toFixed(2));
        $('#total_discount_hidden_' + bookingID).val(parseFloat(total_discount).toFixed(2));

        var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#008ec8;"></i>';
        discount_details += '<div class="discount-tooltip">';
        if (membership_service_discount_amount > 0) {
            discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
        }
        if (membership_product_discount_amount > 0) {
            discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
        }
        if (coupon_discount_amount > 0) {
            discount_details += '<p>Coupon Discount <span class="amount" style="float: right;">' + coupon_discount_amount.toFixed(2) + '</span></p>';
        }
        if (giftcard_discount_amount > 0) {
            discount_details += '<p>Gift Card Discount <span class="amount" style="float: right;">' + giftcard_discount_amount.toFixed(2) + '</span></p>';
        }
        if (reward_discount_amount > 0) {
            discount_details += '<p>Reward Discount <span class="amount" style="float: right;">' + reward_discount_amount.toFixed(2) + '</span></p>';
        }
        discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>'; // Add total discount here
        discount_details += '</div></div>';
        if (total_discount > 0) {
            $('#discount_details_div_' + bookingID).html(discount_details);
        }
    }

    function applyCoupon(bookingID, couponId, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#coupon_error_' + bookingID + '_' + couponId).html('');
            var coupon_expiry = $('#coupon_expiry_' + bookingID + '_' + couponId).val();
            var coupon_min_price = parseFloat($('#coupon_min_price_' + bookingID + '_' + couponId).val());
            var coupon_offers = parseFloat($('#coupon_offers_' + bookingID + '_' + couponId).val());
            var coupon_name = $('#coupon_name_' + bookingID + '_' + couponId).val();

            var payable = parseFloat($('#payable_hidden_' + bookingID).val());
            var selected_package_id = $('#package_id_' + bookingID).val();
            var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();

            if (selected_package_id == "") {
                if (is_giftcard_applied == "0" || is_giftcard_applied == "") {
                    var currentDate = new Date();
                    var yyyy = currentDate.getFullYear();
                    var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
                    var dd = String(currentDate.getDate()).padStart(2, '0');
                    var todayDate = yyyy + '-' + mm + '-' + dd;

                    if (payable >= coupon_min_price) {
                        if (todayDate <= coupon_expiry) {
                            expiry_flag = 0;
                        } else {
                            if (type == 'previous') {
                                expiry_flag = 0;
                            } else {
                                expiry_flag = 1;
                            }
                        }
                        if (expiry_flag == 0) {
                            var previousCouponId = $('#package_id_' + bookingID).val();
                            if (previousCouponId !== '') {
                                removeCoupon(bookingID, previousCouponId, 'prev');
                            }
                            $('.loader_div').show();

                            $('#coupon_discount_amount_' + bookingID).val(parseFloat(coupon_offers).toFixed(2));
                            $('#selected_coupon_id_' + bookingID).val(couponId);

                            coupon_div = $('#coupon_button_' + bookingID + '_' + couponId);

                            coupon_div.html('');

                            // new_coupon_div = '<button class="btn btn-warning" type="button" onclick="if(confirm(\'Are you sure you want to remove the coupon?\')) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); }" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';
                            new_coupon_div = '<button class="btn btn-warning" type="button" onclick="openConfirmationDialog(\'Are you sure you want to remove the coupon?\', function(confirmed) { if (confirmed) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); } })" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';

                            coupon_div.html(new_coupon_div);

                            $('.loader_div').hide();
                        } else {
                            if (type == 'previous') {
                                $('#coupon_error_' + bookingID + '_' + couponId).html('');
                                $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                                $('#selected_coupon_id_' + bookingID).val('');
                            }
                            $('.loader_div').hide();
                            // alert('Coupon code is expired');
                            openDialog('Coupon code is expired');
                        }
                    } else {
                        $('.loader_div').hide();
                        if (type == 'previous') {
                            $('#coupon_error_' + bookingID + '_' + couponId).html('');
                            $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                            $('#selected_coupon_id_' + bookingID).val('');
                            // alert('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.'+coupon_min_price);
                            openDialog('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.' + coupon_min_price);
                        } else {
                            // alert('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.'+coupon_min_price);
                            openDialog('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.' + coupon_min_price);
                        }
                    }
                } else {
                    $('.loader_div').hide();
                    // alert('Coupon code not applicable on applied giftcard');
                    openDialog('Coupon code not applicable on applied giftcard');
                }
            } else {
                $('.loader_div').hide();
                // alert('Coupon code not applicable if package is selected');
                openDialog('Coupon code not applicable if package is selected');
            }
            setBookingAmount(bookingID);
        }, 1500);
    }

    function removeCoupon(bookingID, couponId, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#coupon_error_' + bookingID + '_' + couponId).html('');
            $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
            if (type === 'new') {
                $('#selected_coupon_id_' + bookingID).val('');
            }

            coupon_div = $('#coupon_button_' + bookingID + '_' + couponId);
            coupon_div.html('');
            new_coupon_div =
                '<button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyCoupon(' + bookingID + ',' + couponId + ')">Apply</button>\
        ';
            coupon_div.html(new_coupon_div);

            setBookingAmount(bookingID);

            $('.loader_div').hide();
        }, 1500);
    }

    function applyGiftCard(bookingID, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#giftcard_error_' + bookingID).hide();
            var selected_package_id = $('#package_id_' + bookingID).val();
            var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
            var customer = $('#customer_id_' + bookingID).val();

            var booking_services = [];

            $('.booking_services_' + bookingID + ':checked').each(function() {
                var selected_service_id = $('#single_service_id_' + $(this).val()).val();
                var details_id = $(this).val();

                var serviceDetails = {
                    service_id: selected_service_id,
                    details_id: details_id
                };

                booking_services.push(serviceDetails);
            });
            var code = $('#giftcard_no_' + bookingID).val();
            if (selected_package_id == "") {
                if (selected_coupon_id == "") {
                    if (code != "") {
                        if (booking_services.length > 0) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>salon/Ajax_controller/check_giftcard_ajx",
                                data: {
                                    'code': code,
                                    'customer': customer,
                                    'services': booking_services,
                                    'booking_id': bookingID
                                },
                                success: function(data) {
                                    $('.loader_div').hide();
                                    $('#is_giftcard_applied_' + bookingID).val('0');
                                    $('#applied_giftcard_id_' + bookingID).val('');
                                    var opts = $.parseJSON(data);

                                    is_valid = opts.is_valid;
                                    is_customer_used = opts.is_customer_used;
                                    giftcard_services = opts.giftcard_services;
                                    custom_array = opts.custom_array;
                                    giftcard_id = opts.giftcard_id;

                                    total_giftcard_discount = 0;

                                    if (is_valid == '1') {
                                        const onlyServiceIds = booking_services.map(item => item.service_id);
                                        const hasMatchingService = onlyServiceIds.some(id => giftcard_services.includes(id));
                                        if (hasMatchingService) {
                                            if (is_customer_used == '0') {
                                                if (!$.isEmptyObject(custom_array)) {
                                                    $('#giftcard_error_' + bookingID).hide();
                                                    $('#giftcard_error_' + bookingID).html('');

                                                    $('#giftcard_remove_button_' + bookingID).show();
                                                    $('#giftcard_button_' + bookingID).hide();
                                                    $('#giftcard_no_' + bookingID).prop('disabled', true);

                                                    $.each(custom_array, function(i, d) {
                                                        var service = parseInt(d.service, 10);
                                                        for (l = 0; l < booking_services.length; l++) {
                                                            if (d.service == booking_services[l].service_id) {
                                                                service_price = parseFloat($('#single_service_price_' + booking_services[l].details_id).val());
                                                                discount = parseFloat(d.discount);
                                                                if (d.discount_in == '0') {
                                                                    discount = discount * service_price;
                                                                }

                                                                total_giftcard_discount = total_giftcard_discount + discount;
                                                            }
                                                        }
                                                    });
                                                    $('#gift_discount_' + bookingID).val(parseFloat(total_giftcard_discount).toFixed(2));
                                                    $('#is_giftcard_applied_' + bookingID).val('1');
                                                    $('#applied_giftcard_id_' + bookingID).val(giftcard_id);

                                                    $('#giftcard_success_' + bookingID).html('Giftcard applied successfully');
                                                    $('#giftcard_success_' + bookingID).show();

                                                    setPayableServiceAmount(bookingID);
                                                } else {
                                                    $('#giftcard_error_' + bookingID).html('Invalid Giftcard no');
                                                    $('#giftcard_error_' + bookingID).show();
                                                    $('#giftcard_success_' + bookingID).html('');
                                                    $('#giftcard_success_' + bookingID).hide();
                                                    $('#giftcard_no_' + bookingID).val('');

                                                    setTimeout(function() {
                                                        $('#giftcard_error_' + bookingID).hide();
                                                    }, 4000);
                                                }
                                            } else {
                                                $('#giftcard_error_' + bookingID).html('Customer has used it before');
                                                $('#giftcard_error_' + bookingID).show();
                                                $('#giftcard_success_' + bookingID).html('');
                                                $('#giftcard_success_' + bookingID).hide();
                                                $('#giftcard_no_' + bookingID).val('');

                                                setTimeout(function() {
                                                    $('#giftcard_error_' + bookingID).hide();
                                                }, 4000);
                                            }
                                        } else {
                                            if (type == 'previous') {
                                                $('#giftcard_error_' + bookingID).html('Previously applied giftcard is not applicable now, as available services not allowed for this Gift Card');
                                            } else {
                                                $('#giftcard_error_' + bookingID).html('Selected Services not allowed for applied Gift Card');
                                            }
                                            $('#giftcard_error_' + bookingID).show();
                                            $('#giftcard_success_' + bookingID).html('');
                                            $('#giftcard_success_' + bookingID).hide();
                                            $('#giftcard_no_' + bookingID).val('');

                                            setTimeout(function() {
                                                $('#giftcard_error_' + bookingID).hide();
                                            }, 4000);
                                        }
                                    } else {
                                        $('#giftcard_error_' + bookingID).html('Invalid Giftcard no');
                                        $('#giftcard_error_' + bookingID).show();
                                        $('#giftcard_success_' + bookingID).html('');
                                        $('#giftcard_success_' + bookingID).hide();
                                        $('#giftcard_no_' + bookingID).val('');

                                        setTimeout(function() {
                                            $('#giftcard_error_' + bookingID).hide();
                                        }, 4000);
                                    }
                                },
                            });
                        } else {
                            $('.loader_div').hide();
                            // alert('Please select services');
                            openDialog('Please select services');
                            $('#giftcard_no_' + bookingID).val('');
                        }
                    } else {
                        $('.loader_div').hide();
                        // alert('Please enter giftcard no');
                        openDialog('Please enter giftcard no');
                        $('#giftcard_no_' + bookingID).val('');
                    }
                } else {
                    $('.loader_div').hide();
                    // alert('Giftcard not applicable on applied coupon');
                    openDialog('Giftcard not applicable on applied coupon');
                    $('#giftcard_no_' + bookingID).val('');
                }
            } else {
                $('.loader_div').hide();
                // alert('Giftcard not applicable on packages');
                openDialog('Giftcard not applicable on packages');
                $('#giftcard_no_' + bookingID).val('');
            }
        }, 1500);
    }

    function removeGiftCard(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#giftcard_error_' + bookingID).html('');
            $('#giftcard_error_' + bookingID).hide();
            $('#giftcard_success_' + bookingID).html('');
            $('#giftcard_success_' + bookingID).hide();

            $('#gift_discount_' + bookingID).val(parseFloat(0.00).toFixed(2));
            $('#is_giftcard_applied_' + bookingID).val('0');
            $('#applied_giftcard_id_' + bookingID).val('');
            $('#giftcard_no_' + bookingID).val('');

            $('#giftcard_remove_button_' + bookingID).hide();
            $('#giftcard_button_' + bookingID).show();
            $('#giftcard_no_' + bookingID).prop('disabled', false);
            setPayableServiceAmount(bookingID);
            $('.loader_div').hide();
        }, 1500);
    }

    function applyRewards(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
            var customer_gender = $('#customer_gender_' + bookingID).val();
            var total_value = 0;

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_reward_setup_ajx",
                data: {
                    'gender': customer_gender
                },
                success: function(data) {
                    var opts = $.parseJSON(data);
                    if (!$.isEmptyObject(opts)) {
                        rs_per_reward = opts.rs_per_reward;
                        reward_point = opts.reward_point;
                        minimum_reward_required = parseInt(opts.minimum_reward_required);
                        maximum_reward_required = opts.maximum_reward_required;

                        payableHidden = parseFloat($('#payable_hidden_' + bookingID).val());

                        if (payableHidden > 0) {
                            if (customer_reward_available >= minimum_reward_required) {
                                if (customer_reward_available > maximum_reward_required) {
                                    available_rewards = maximum_reward_required;
                                } else {
                                    available_rewards = customer_reward_available;
                                }

                                consider_rewards = available_rewards / reward_point;
                                total_value = consider_rewards * rs_per_reward;

                                $('#reward_discount_amount_' + bookingID).val(parseFloat(total_value).toFixed(2));
                                $('#used_rewards_' + bookingID).val(available_rewards);
                                $('#customer_rewards_text_' + bookingID).html('');
                                $('#customer_rewards_text_' + bookingID).html('Rewards Balance: <s>' + customer_reward_available + '</s> ' + (customer_reward_available - available_rewards) + '<br>Discount: Rs.' + parseFloat(total_value).toFixed(2));
                                $('#used_rewards_msg_' + bookingID).html('<label style="color:green;font-size:10px;">' + available_rewards + ' Rewards used</label>');

                                setBookingAmount(bookingID);

                                $('#rewards_button_' + bookingID).hide();
                                $('#rewards_remove_button_' + bookingID).show();
                            } else {
                                // alert('Minimum reward points required are: '+ minimum_reward_required);
                                openDialog('Minimum reward points required are: ' + minimum_reward_required);
                            }
                        } else {
                            // alert('Total amount is not valid.');
                            openDialog('Total amount is not valid.');
                        }
                        $('.loader_div').hide();
                    }
                },
            });
        }, 1500);
    }

    function removeRewards(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
            $('#reward_discount_amount_' + bookingID).val(parseFloat(0).toFixed(2));
            $('#used_rewards_' + bookingID).val(0);
            $('#customer_rewards_text_' + bookingID).html('');
            $('#customer_rewards_text_' + bookingID).html('Rewards Balance: ' + customer_reward_available);
            $('#used_rewards_msg_' + bookingID).html('');

            setBookingAmount(bookingID);

            $('#rewards_button_' + bookingID).show();
            $('#rewards_remove_button_' + bookingID).hide();

            $('.loader_div').hide();
        }, 1500);
    }

    function checkArraysMatch(array1, array2) {
        return $.grep(array1, function(value1) {
            return $.grep(array2, function(value2) {
                return value1 === value2;
            }).length > 0;
        }).length > 0;
    }

    
    function showServiceDetailsDiv(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_service_details_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: id,
                redirect: window.location.href
            },
            success: function(response) {
                $('#booking_details_response').html(response)
                showPopup('myModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingDetailsDiv(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_details_ajx",
            method: 'POST',
            data: {
                booking_id: id,
                redirect: window.location.href
            },
            success: function(response) {
                $('#booking_details_response').html(response)
                showPopup('myModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingNotesDivCalendar(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_note_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_note_response').html(response)
                showPopup('bookingNoteModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingNotesDiv(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_note_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_note_response').html(response)
                showPopup('bookingNoteModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingReviewDiv(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_review_ajx",
            method: 'POST',
            data: {
                booking_review_id: id
            },
            success: function(response) {
                $('#booking_review_response').html(response)
                showPopup('BookingReviewModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingReviewDivCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_review_ajx",
            method: 'POST',
            data: {
                booking_review_id: id
            },
            success: function(response) {
                $('#booking_review_response').html(response)
                showPopup('BookingReviewModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showReschedulePopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_service_reschedule_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: id
            },
            success: function(response) {
                $('#reschedule_details_response').html(response)
                showPopup('ServiceRescheduleModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function rescheduleService(id) {
        var service_date = $('#service_date_' + id).val();
        var service_executive = $('#service_executive_' + id).val();
        var service_stylist_timeslot_hidden = $('#service_stylist_timeslot_hidden_' + id).val();
        if (service_executive != '') {
            $('#service_executive_error_' + id).hide();
            $('#service_executive_error_' + id).text('');
            if (service_date != '') {
                $('#service_date_error_' + id).hide();
                $('#service_date_error_' + id).text('');
                // if (confirm("Are you sure you want to proceed?")) {
                openConfirmationDialog("Are you sure you want to proceed?", function(confirmed) {
                    if (confirmed) {
                        $('.loader_div').show();
                        $.ajax({
                            url: "<?= base_url(); ?>salon/Ajax_controller/reschedule_service_ajx",
                            method: 'POST',
                            data: {
                                booking_service_details_id: id,
                                service_date: service_date,
                                service_executive: service_executive,
                                service_stylist_timeslot_hidden: service_stylist_timeslot_hidden,
                            },
                            success: function(response) {
                                setTimeout(function() {
                                    $('.loader_div').hide();
                                    if (response === '1') {
                                        closePopup('ServiceRescheduleModal');
                                        $('#reschedule_btn_div').html('')
                                        showServiceDetailsDiv(id);
                                        setStylistCalendar(service_executive);
                                    }
                                }, 2000);
                            },
                            error: function() {
                                alert("Error fetching service details");
                            }
                        });
                    }
                });
            } else {
                $('#service_date_error_' + id).show();
                $('#service_date_error_' + id).text('Please select date!');
            }
        } else {
            $('#service_executive_error_' + id).show();
            $('#service_executive_error_' + id).text('Please select stylist!');
        }
    }

    function showCancelPopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_service_cancel_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#cancel_details_response').html(response)
                showPopup('ServiceCancelModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showCancelPopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_service_cancel_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#cancel_details_response').html(response)
                showPopup('ServiceCancelModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }
    function showBillUpdatePopupCalender(event,id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_bill_update_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#update_bill_response').html(response)
                showPopup('updateBillModal');
            },
            error: function() {
                alert("Error fetching booking details");
            }
        });
    }
    function showBillUpdatePopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_bill_update_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#update_bill_response').html(response)
                showPopup('updateBillModal');
            },
            error: function() {
                alert("Error fetching booking details");
            }
        });
    }

    function cancelService(id) {
        var remark = $('#remark_' + id).val();
        var checkedServices = [];
        $('.service_details_checkboxes:checked').each(function() {
            checkedServices.push($(this).val());
        });
        if (checkedServices.length > 0) {
            $('#remark_error_' + id).text('');
            // if (confirm("Are you sure you want to proceed?")) {
            // openConfirmationDialog("Are you sure you want to proceed?", function(confirmed) {
                var confirmed = true;
                if (confirmed) {
                    $('.loader_div').show();
                    $.ajax({
                        url: "<?= base_url(); ?>salon/Ajax_controller/cancel_service_ajx",
                        method: 'POST',
                        data: {
                            booking_id: id,
                            remark: remark,
                            services_to_cancel: checkedServices
                        },
                        success: function(response) {
                            setTimeout(function() {
                                $('.loader_div').hide();
                                if (response === '1') {
                                    closePopup('ServiceCancelModal');
                                    $('#cancel_btn_div').html('')
                                    showBookingDetailsDiv(id);
                                    setStylistCalendar($('#selected_stylist').val());
                                }
                            }, 2000);
                        },
                        error: function() {
                            alert("Error fetching service details");
                        }
                    });
                }
            // });
        } else {
            $('#remark_error_' + id).text('Please select atleast one service!');
        }
    }

    function completeService(id) {
        // if (confirm("Are you sure you want to proceed?")) {
        openConfirmationDialog("Are you sure you want to proceed?", function(confirmed) {
            if (confirmed) {
                $('.loader_div').show();
                $.ajax({
                    url: "<?= base_url(); ?>salon/Ajax_controller/complete_service_ajx",
                    method: 'POST',
                    data: {
                        booking_id: id
                    },
                    success: function(response) {
                        setTimeout(function() {
                            $('.loader_div').hide();
                            if (response === '1') {
                                closePopup('ServiceCompleteModal');
                                $('#payment_btn_div').html('-')
                                // showBookingDetailsDiv(id);
                                // showBillGenerationPopup(id);
                                setStylistCalendar($('#selected_stylist').val());

                                var base_url = "<?php echo base_url(); ?>";
                                var encodedId = btoa(id);
                                window.location.href = base_url + 'bill-setup/' + encodedId;
                            }
                        }, 2000);
                    },
                    error: function() {
                        alert("Error fetching service details");
                    }
                });
            }
        });
    }

    function showCompletePopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_service_complete_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#complete_details_response').html(response)
                showPopup('ServiceCompleteModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showCompletePopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_service_complete_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#complete_details_response').html(response)
                showPopup('ServiceCompleteModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showAddServicePopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_add_service_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#add_service_response').html(response)
                showPopup('addServiceModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showAddServicePopup(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/show_add_service_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#add_service_response').html(response)
                showPopup('addServiceModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function appendSlotsDiv(booking_details_id, append_to_ID, duration) {
        var date = $('#service_date_' + booking_details_id).val();

        $("#service_executive_div_" + booking_details_id).hide();
        $("#service_executive_" + booking_details_id).val('');

        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_stylist_reschedule_timeslots_updated_ajx",
            data: {
                'date': date,
                'duration': duration,
                'booking_details_id': booking_details_id
            },
            success: function(data) {
                $("#" + append_to_ID).html('');
                $("#" + append_to_ID).append(data);
            },
        });
    }

    function setStylist(radioButton, booking_details_id) {
        var selectedTimeSlot = $(radioButton).val();
        if (selectedTimeSlot !== "" && typeof selectedTimeSlot !== "undefined") {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_servicewise_reschedule_ajx",
                data: {
                    'booking_details_id': booking_details_id,
                    'selectedTimeSlot': selectedTimeSlot
                },
                success: function(data) {
                    $("#service_executive_" + booking_details_id).chosen();
                    $("#service_executive_" + booking_details_id).val('');
                    var stylists = $.parseJSON(data);
                    if (stylists.length > 0) {
                        $("#service_executive_" + booking_details_id).empty();
                        $("#service_executive_" + booking_details_id).append('<option value="">Select Executive</option>');
                        var opts = $.parseJSON(data);
                        var count = 1;
                        // console.log(opts)
                        $.each(opts, function(i, d) {
                            is_service_available = d.is_service_available;
                            is_shift_available = d.is_shift_available;
                            is_booking_present = d.is_booking_present;
                            is_customer_booking_present = d.is_customer_booking_present;
                            is_on_break = d.is_on_break;

                            if (is_service_available == '1') {
                                if (is_shift_available == '1') {
                                    if (is_booking_present == '0') {
                                        if (is_customer_booking_present == '0') {
                                            var message = '';
                                            var disabled = '';
                                            var is_Allowed = 1;
                                            if (count == 1) {
                                                var selected = 'selected';
                                            }
                                        } else {
                                            var message = '- Customer Service Present';
                                            // var message = '- Not Available';
                                            var disabled = 'disabled';
                                            var is_Allowed = 0;
                                        }
                                    } else {
                                        var message = '- Slot Already Booked';
                                        // var message = '- Not Available';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                } else {
                                    if (is_on_break == '1') {
                                        var message = '- Stylist On Break';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    } else {
                                        var message = '- Shift Not Available';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                }

                                if (is_Allowed == 1 && disabled != 'disabled') {
                                    if (count == 1) {
                                        var selected = 'selected';
                                        count++;
                                    } else {
                                        var selected = '';
                                    }
                                } else {
                                    var selected = '';
                                }

                                if (rules_employee_selection == '2') {
                                    selected = '';
                                }

                                $("#service_executive_" + booking_details_id).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                            } else {
                                var disabled = 'disabled';
                                var message = '- Stylist Not Available';
                            }
                        });
                        $("#service_executive_" + booking_details_id).trigger('chosen:updated');
                        $("#service_executive_div_" + booking_details_id).show();
                    } else {
                        $("#service_executive_" + booking_details_id + "_chosen").hide();
                        $("#service_executive_" + booking_details_id).hide();
                        $("#service_executive_div_" + booking_details_id).append('<label style="font-size:10px;" class="error">Please, first set Stylist designation employees.</label>');
                        $("#service_executive_div_" + booking_details_id).show();
                    }
                },
            });
        }
    }
</script>
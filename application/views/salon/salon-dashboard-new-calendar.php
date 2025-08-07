<?php include('header.php');
$total_stylists = count($salon_employee_list);
$single_size = 100/$total_stylists;
?>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.10.5/main.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
    /* Responsive adjustments */
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
    .timeslot_box .tab{
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
        top: 3px;
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
<style>
    #dashboardModal_response .dataTables_wrapper{
    min-height: auto;
}
  #dashboardModal_response .dataTables_length{
    width: auto;
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
        <?php include('dashboard-topbar-new.php');?>
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
            <div class="calendar-container">
                <div id="calendar" class="calendar"></div>
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
<div class="modal fade" id="BookingReviewModal"  tabindex="-1" aria-labelledby="BookingReviewLabel" aria-hidden="true">
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
<div class="modal fade" id="bookingNoteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true" >
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
<div class="modal fade" id="ServiceRescheduleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="ServiceCompleteModal" tabindex="-1" aria-labelledby="exampleModalComplete" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="updateBillModal" tabindex="-1" aria-labelledby="exampleModalUpdateBill" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="">
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
<div class="modal fade" id="ServiceCancelModal" tabindex="-1" aria-labelledby="exampleModalCancel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="">
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
<div class="modal fade" id="BookingBillModal" tabindex="-1" aria-labelledby="BillModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="BookingEditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
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
<div class="response"></div>
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

$offers_services = [];
if (!empty($offers_list)) {
    foreach ($offers_list as $offer) {
        $service_names = explode(',', $offer->service_name);
        foreach ($service_names as $service_name) {
            $offers_services[] = $service_name;
        }
    }
}
?>

<script>
    const BASE_URL = "<?= base_url(); ?>";
    const salon_avg_working = JSON.parse('<?= json_encode($salon_avg_working); ?>');
    var slotDurationMain = <?php echo $slotDuration; ?>;
    var single_size = <?php echo $single_size; ?>;
    var ENC_BRANCH_ID = '<?php echo base64_encode($this->session->userdata('branch_id')); ?>';
    var ENC_SALON_ID = '<?php echo base64_encode($this->session->userdata('salon_id')); ?>';
    var UID = '<?php echo base64_encode($this->session->userdata('branch_id') . '@@@' . $this->session->userdata('salon_id')); ?>';
    var CONNECTION_TYPE = '<?php echo base64_encode('receiver'); ?>';
    var WS_PROJECT = '<?php echo base64_encode('salon'); ?>';
    var SOCKET_BASE_URL = '<?php echo SOCKET_URL; ?>';
    var FULL_CALENDAR_KEY = '<?php echo FULL_CALENDAR_KEY; ?>';
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.17/index.global.min.js"></script>
<script src="<?= base_url() ?>salon_assets/js/dashboard.js"></script>
<script src="<?= base_url() ?>salon_assets/js/dashboard-vertical-calendar.js"></script>

<script>
    $(document).ready(function() {
        $('#dashboard').addClass('nv active');    
        $("#today_date").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
        $('.b_date').datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
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
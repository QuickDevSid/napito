<?php include('header.php'); ?>
<style>
    .page-title h3 {
        font-size: 24px;
        color: var(--primary);
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

    <?php if (isset($_GET['status']) && $_GET['status'] != "") { ?>#status_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #status_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['from_date']) && $_GET['from_date'] != "") { ?>#from_date_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #from_date_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['to_date']) && $_GET['to_date'] != "") { ?>#to_date_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #to_date_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['customer']) && $_GET['customer'] != "") { ?>#customer_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #customer_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['id']) && $_GET['id'] != "") { ?>#id_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #id_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['service']) && $_GET['service'] != "") { ?>#service_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #service_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?><?php if (isset($_GET['stylist']) && $_GET['stylist'] != "") { ?>#stylist_chosen .chosen-single {
        color: black !important;
        background-color: #607d8b38 !important;
    }

    #stylist_chosen .chosen-container-single .chosen-single span {
        color: #000 !important;
    }

    <?php } ?>
    
  

    .slot-tabcontent {
        display: none;
        max-width: 800px;
        text-align: center;
    }

    .slot-tabcontent.active {
        display: block;
    }

   

    .service_details_box {
        max-height: 250px;
        overflow: hidden;
        overflow-y: auto;
    }

  

    .coupon-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .coupon-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #coupon_details_info {
        cursor: pointer;
    }

    #coupon_details_info:hover .coupon-tooltip {
        display: block;
    }

    .discount-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .discount-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #discount_details_info {
        cursor: pointer;
    }

    #discount_details_info:hover .discount-tooltip {
        display: block;
    }

    .loading-skeleton {
        height: 70px;
        background-color: #d7d7d7;
        /* Background color of skeleton */
        border-radius: 4px;
        /* Rounded corners */
        padding: 20px;
        /* Padding around the skeleton */
        margin-bottom: 20px;
        /* Margin at the bottom */
    }

    .loading-project {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        /* Margin between project details */
    }

    .loading-project-details {
        flex: 1;
    }

    .loading-project-details1 {
        flex: 0 0 30%;
        /* Fixed width for this section */
    }

    .loading-line {
        height: 10px;
        /* Height of each skeleton line */
        background-color: #ffffff;
        /* Background color of each skeleton line */
        margin-bottom: 5px;
        /* Margin between lines */
    }

    .modal-backdrop.in {
        opacity: 0 !important;
    }

    .loader {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .loader div {
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #000;
        animation: loader 1.2s linear infinite;
    }

    .loader div:nth-child(1) {
        animation-delay: 0s;
        top: 32px;
        left: 32px;
    }

    .loader div:nth-child(2) {
        animation-delay: -0.4s;
        top: 0;
        left: 32px;
    }

    .loader div:nth-child(3) {
        animation-delay: -0.8s;
        top: 0;
        left: 0;
    }

    .loader div:nth-child(4) {
        animation-delay: -1.2s;
        top: 32px;
        left: 0;
    }

    .loader div:nth-child(5) {
        animation-delay: -1.6s;
        top: 64px;
        left: 32px;
    }

    @keyframes loader {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
            opacity: 0;
        }
    }

    .loader_container {
        position: fixed;
        background-color: #ffffffb5;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
    }

    .loader_container .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .arrow_btn:active {
        box-shadow: none;
    }



    .loader_div {
        display: none;
        position: fixed;
        width: 100%;
        height: 100% !important;
        background: #00000042;
        z-index: 999999;
        left: 0;
        top: 0;
    }

    .loader-new {
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 9999;
        --d: 22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #0056d0;
        box-shadow:
            calc(1*var(--d)) calc(0*var(--d)) 0 0,
            calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d)) calc(1*var(--d)) 0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
        animation: l27 1s infinite steps(8);
    }

    @keyframes l27 {
        100% {
            transform: rotate(1turn)
        }
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


    .extra-service-discount-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .extra-service-discount-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #extra_service_discount_details_info {
        cursor: pointer;
    }

    #extra_service_discount_details_info:hover .extra-service-discount-tooltip {
        display: block;
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

    input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ccc;
        margin-right: 25px;
        margin-top: 5px;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
        display: block;
    }

    #booking_edit_response h5 {
        color: #2a2a2a;
    }

    td .row .btn-primary:hover {
        background: white !important;

    }

    input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ff000085;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
    }



    input[class="dashboardToggle"]::after {
        position: absolute;
        content: "";
        width: 25px;
        height: 25px;
        top: 0;
        left: 0;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: 0.4s;
    }

    input:checked[class="dashboardToggle"] {
        background: #1aab00b3;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <h3 style="margin-left: 20px;"><b>All Bookings</b></h3>
            <div class="title_left">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Status</label>
                                    <select class="form-control choosen" id="status" name="status">
                                        <option value="">All Status</option>
                                        <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { ?>selected<?php } ?>>Pending</option>
                                        <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { ?>selected<?php } ?>>Completed</option>
                                        <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { ?>selected<?php } ?>>Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Booking</label>
                                    <select class="form-control choosen" id="id" name="id">
                                        <option value="">All Bookings</option>
                                        <?php
                                        if (!empty($bookings)) {
                                            foreach ($bookings as $bookings_result) {
                                        ?>
                                                <option value="<?= $bookings_result->id; ?>" <?php if (isset($_GET['id']) && $_GET['id'] == $bookings_result->id) { ?>selected<?php } ?>><?= $bookings_result->receipt_no . ' (' . $bookings_result->full_name . ',' . $bookings_result->customer_phone . ')'; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Customer</label>
                                    <select class="form-control choosen" id="customer" name="customer">
                                        <option value="">All Customers</option>
                                        <?php
                                        if (!empty($customer)) {
                                            foreach ($customer as $customer_result) {
                                        ?>
                                                <option value="<?= $customer_result->id; ?>" <?php if (isset($_GET['customer']) && $_GET['customer'] == $customer_result->id) { ?>selected<?php } ?>><?= $customer_result->full_name . ' (' . $customer_result->customer_phone . ')'; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">From Service Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="From Service Date" name="from_date" id="from_date" value="<?php if (isset($_GET["from_date"]) && $_GET["from_date"] != "0" && $_GET["from_date"] != "") {
                                                                                                                                                                    echo date('d-m-Y', strtotime($_GET['from_date']));
                                                                                                                                                                } ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">To Service Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="To Service Date" name="to_date" id="to_date" value="<?php if (isset($_GET["to_date"]) && $_GET["to_date"] != "0" && $_GET["to_date"] != "") {
                                                                                                                                                                echo date('d-m-Y', strtotime($_GET['to_date']));
                                                                                                                                                            } ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Service</label>
                                    <select class="form-control choosen" id="service" name="service">
                                        <option value="">All Services</option>
                                        <?php
                                        if (!empty($services)) {
                                            foreach ($services as $services_result) {
                                        ?>
                                                <option value="<?= $services_result->id; ?>" <?php if (isset($_GET['service']) && $_GET['service'] == $services_result->id) { ?>selected<?php } ?>><?= $services_result->service_name . '|' . $services_result->service_name_marathi; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Employee</label>
                                    <select class="form-control choosen" id="stylist" name="stylist">
                                        <option value="">All Employee</option>
                                        <?php
                                        if (!empty($stylists)) {
                                            foreach ($stylists as $stylist_result) {
                                        ?>
                                                <option value="<?= $stylist_result->id; ?>" <?php if (isset($_GET['stylist']) && $_GET['stylist'] == $stylist_result->id) { ?>selected<?php } ?>><?= $stylist_result->full_name; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Show Mobile App Bookings?</label>
                                    <input style="height: 25px !important;" <?php if (isset($_GET['is_app']) && $_GET['is_app'] == 'on') {
                                                                                echo 'checked';
                                                                            } ?> type="checkbox" name="is_app" id="is_app" class="dashboardToggle">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Show Counter Bookings?</label>
                                    <input style="height: 25px !important;" <?php if (isset($_GET['counter_bookings']) && $_GET['counter_bookings'] == 'on') {
                                                                                echo 'checked';
                                                                            } ?> type="checkbox" name="counter_bookings" id="counter_bookings" class="dashboardToggle">
                                </div>
                            </div>
                            <div class="error" id="status_error_new_2"></div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Show Guest Bookings?</label>
                                    <input style="height: 25px !important;" <?php if (isset($_GET['guest_bookings']) && $_GET['guest_bookings'] == 'on') {
                                                                                echo 'checked';
                                                                            } ?> type="checkbox" name="guest_bookings" id="guest_bookings" class="dashboardToggle">
                                </div>
                                <div class="col-md-2  col-sm-3 col-xs-12">
                                    <button type="submit" id="submit_button" class="btn btn-success" style="margin:15px 0;">Search</button>
                                    <?php if (isset($_GET['id']) || isset($_GET['customer']) || isset($_GET['from_date']) || isset($_GET['to_date']) || isset($_GET['status']) || isset($_GET['service']) || isset($_GET['stylist'])) { ?>
                                        <a href="<?= base_url(); ?><?= $this->uri->segment(1); ?>" class="btn btn-info" style="margin-top:6px;padding:6px 10px">Reset</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <div class="x_content">
                        <span style="text-align: center;display: block;line-height: 35px;color: var(--white);font-weight: 600;font-size: 15px;background:linear-gradient(135deg, #f05dae, #cf42a0);margin-bottom: 15px;" id="">Total Bookings: <?= count($total_bookings); ?></span>
                        <div id="all_rows"></div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="loading-skeleton">
                            <div class="loading-project">
                                <div class="loading-project-details">
                                    <div class="loading-line4"></div>
                                    <div class="loading-line2"></div>
                                    <div class="loading-line"></div>
                                    <div class="loading-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="load_more_box text-center mt-5">
                            <label id="no-more" class="error" style="display:none;margin: 30px;color: #f00;">No Data Available</label>
                            <button id="load-more" class="btn btn-info mt-5">Load more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader_container" style="display:none;">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="success_alert_div" class="alert mymsg_alert alert-success animated fadeInUp success_alert" style="display:none;"></div>
        <div id="error_alert_div" class="alert  mymsg_alert alert-danger animated fadeInUp error_alert" style="display:none;"></div>

        <div class="loader_div">
            <div class="loader-new"></div>
        </div>

        </div></div>
        <div class="modal fade" id="BookingBillModal" tabindex="-1" aria-labelledby="BillModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="BillModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Generate Booking Bill</span>
                            <!-- <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 5px; margin-right: -600px;">
                        <div style="background-color:#8bc34a61; height: 20px; width: 20px; border: 0.5px solid #ccc;"></div>
                        <p style="margin-right: 5px; color:#000; margin-left: 10px; margin-top: 7px;font-size: 12px;">Bill Already Generated</p>
                    </div> -->
                            <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 5px; margin-right: 30px;">
                                <div style="background-color:#0000ff21; height: 20px; width: 20px; border: 0.5px solid #ccc;"></div>
                                <p style="margin-right: 5px; color:#000; margin-left: 10px; margin-top: 7px;font-size: 12px;">Extra Added Service</p>
                            </div>
                        </h5>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="if(confirm('Are you sure you want to close bill generation?')) { closePopup('BookingBillModal'); }"> -->
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="openConfirmationDialog('Are you sure you want to close bill generation?', function(confirmed) { if (confirmed) { closePopup('BookingBillModal'); } })">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="booking_bill_generation_response"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Booking Details</span>
                            <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 0px; margin-right: 30px;">
                                <div style="background-color:#0000ff21; height: 20px; width: 20px; border: 0.5px solid #ccc;margin-left: 5px;"></div>
                                <p style="margin-right: 5px; color:#000; margin-left: 10px; margin-top: 7px;font-size: 12px;">Extra Added Service</p>
                            </div>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('detailsModal')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="booking_details_response"></div>
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
                <div class="modal-content" style="">
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
   
    <div class="modal fade" id="BookingEditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Edit Booking</span>
                    </h5>
                    <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="if(confirm('Are you sure you want to close bill generation?')) { closePopup('BookingBillModal'); }"> -->
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('BookingEditModal')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="booking_edit_response"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="BookingReviewModal"  tabindex="-1" aria-labelledby="BookingReviewLabel" aria-hidden="true">
        <div class="modal-dialog" id="order_note_dialog">
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
    <div class="modal fade" id="bookingNoteModal"  tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
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


<?php include('footer.php');
    $booking_rules = $this->Salon_model->get_booking_rules();
    if (!empty($booking_rules)) {
        $rules_employee_selection = $booking_rules->employee_selection;
    } else {
        $rules_employee_selection = '1';
    }
    ?>
    <script>
        var rules_employee_selection = <?php echo $rules_employee_selection; ?>;
        var offset = 0;
        var limit = 15;
        var maxEntriesToShowSkeleton = 1;
        var from_date = '<?php if (isset($_GET['from_date']) && $_GET['from_date'] != "") {
                                echo $_GET['from_date'];
                            } else {
                                echo '0';
                            } ?>';
        var to_date = '<?php if (isset($_GET['to_date']) && $_GET['to_date'] != "") {
                            echo $_GET['to_date'];
                        } else {
                            echo '0';
                        } ?>';
        var customer = '<?php if (isset($_GET['customer']) && $_GET['customer'] != "") {
                            echo $_GET['customer'];
                        } else {
                            echo '0';
                        } ?>';
        var id = '<?php if (isset($_GET['id']) && $_GET['id'] != "") {
                        echo $_GET['id'];
                    } else {
                        echo '0';
                    } ?>';
        var service = '<?php if (isset($_GET['service']) && $_GET['service'] != "") {
                            echo $_GET['service'];
                        } else {
                            echo '0';
                        } ?>';
        var stylist = '<?php if (isset($_GET['stylist']) && $_GET['stylist'] != "") {
                            echo $_GET['stylist'];
                        } else {
                            echo '0';
                        } ?>';
        var status = '<?php if (isset($_GET['status']) && $_GET['status'] != "") {
                            echo $_GET['status'];
                        } else {
                            echo '';
                        } ?>';
        var is_app = '<?php if (isset($_GET['is_app']) && $_GET['is_app'] != "") {
                            echo $_GET['is_app'];
                        } else {
                            echo '';
                        } ?>';
        var counter_bookings = '<?php if (isset($_GET['counter_bookings']) && $_GET['counter_bookings'] != "") {
                            echo $_GET['counter_bookings'];
                        } else {
                            echo '';
                        } ?>';        
        var guest_bookings = '<?php if (isset($_GET['guest_bookings']) && $_GET['guest_bookings'] != "") {
                            echo $_GET['guest_bookings'];
                        } else {
                            echo '';
                        } ?>';
        $(document).ready(function() {
            $(".custom_date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy",
                minDate: "-10y",
                maxDate: "+10y"
            });
            $(".choosen").chosen({
                no_results_text: "Oops, nothing found!"
            });
            $('.loader_container').hide();
            $('.loader_area').hide();
            $('#success_alert_div').html('');
            $('#error_alert_div').html('');
            $('#success_alert_div').hide();
            $('#error_alert_div').hide();

            loadBookings();

            $('#load-more').click(function() {
                loadBookings();
            });

        });

        function loadBookings() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_all_bookings_ajax",
                data: {
                    'offset': offset,
                    'limit': limit,
                    'from_date': from_date,
                    'to_date': to_date,
                    'customer': customer,
                    'id': id,
                    'service': service,
                    'stylist': stylist,
                    'status': status,
                    'is_app': is_app,
                    'counter_bookings': counter_bookings,
                    'guest_bookings': guest_bookings,
                },
                success: function(data) {
                    $('.loading-skeleton').show();
                    setTimeout(function() {
                        $('.loading-skeleton').hide();
                        if (!data || $.isEmptyObject(data)) {
                            $('#load-more').hide();
                            $('#no-more').show();
                        } else {
                            $('#no-more').hide();
                            $('#load-more').show();
                            $("#all_rows").append(data);
                            offset += limit;
                        }
                    }, 1000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        var user_selected_service = [];

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
                                            showServiceDetailsPopup(id);
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

        function showCancelPopup(id) {
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/show_service_cancel_popup_ajx",
                method: 'POST',
                data: {
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
                                        $('#cancel_btn_div').html('');
                                        $('#all_rows').html('');
                                        limit = offset;
                                        offset = 0;
                                        loadBookings();
                                        showBookingDetailsDiv(id);
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
                                    $('#payment_btn_div').html('-');
                                    $('#all_rows').html('');
                                    limit = offset;
                                    offset = 0;
                                    loadBookings();
                                    // showBookingDetailsDiv(id);
                                    // showBillGenerationPopup(id);

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

        function showServiceDetailsPopup(id) {
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_service_details_ajx",
                method: 'POST',
                data: {
                    booking_service_details_id: id,
                    redirect: window.location.href
                },
                success: function(response) {
                    $('#booking_details_response').html(response)
                    showPopup('detailsModal');
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
                    showPopup('detailsModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching booking details:', error);
                    alert("Error fetching booking details");
                }
            });
        }

        function showAddServicePopup(id) {
            event.stopPropagation();
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/show_add_service_popup_ajx",
                method: 'POST',
                data: {
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

        function showServiceProductsPopup(id) {
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_service_products_details_ajx",
                method: 'POST',
                data: {
                    booking_details_id: id
                },
                success: function(response) {
                    $('#booking_service_product_response').html(response)
                    showPopup('ServiceProductModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching booking details:', error);
                    alert("Error fetching booking details");
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
                            $.each(opts, function(i, d) {
                                is_service_available = d.is_service_available;
                                is_shift_available = d.is_shift_available;
                                is_booking_present = d.is_booking_present;
                                is_on_leave_flag = d.is_on_leave_flag;
                                is_customer_booking_present = d.is_customer_booking_present;
                                is_on_break = d.is_on_break;
                                short_break_flag = d.short_break_flag;
                                is_emergency_flag = d.is_emergency_flag;

                                if (is_service_available == '1') {
                                    if (is_emergency_flag == '0') {
                                        if (is_on_leave_flag == '0') {
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
                                        } else {
                                            var message = '- On Leave';
                                            var disabled = 'disabled';
                                            var is_Allowed = 0;
                                        }
                                    } else {
                                        var message = '- Store Emergency Closed';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                    if (is_Allowed == 1 && disabled != 'disabled') {
                                        if(short_break_flag == '1'){
                                            if (count == 1) {
                                                var selected = 'selected';
                                                count++;
                                            } else {
                                                var selected = '';
                                            }
                                        }else{
                                            var message = '- Stylist On Short Break';
                                            var disabled = 'disabled';
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

            setGrandTotal_bill(bookingID);
        }

        function setGrandTotal_bill(bookingID) {
            booking_amount_single = parseFloat($('#booking_amount_hidden_' + bookingID).val());
            gst_amount_single = parseFloat($('#gst_amount_hidden_' + bookingID).val());
            customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val());

            grand_total_single = booking_amount_single + gst_amount_single;

            allowed_max = grand_total_single + customer_pending_amount;
            $('#total_due_' + bookingID).text(parseFloat(allowed_max).toFixed(2));

            $('#paid_amount_' + bookingID).val(parseFloat(allowed_max).toFixed(2)).attr('max', parseFloat(allowed_max).toFixed(2));
            $('#grand_total_hidden_' + bookingID).val(parseFloat(grand_total_single).toFixed(2));
            $('#grand_total_' + bookingID).text(parseFloat(grand_total_single).toFixed(2));

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

            var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
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
                var coupon_gender = $('#coupon_gender_' + bookingID + '_' + couponId).val();

                var payable = parseFloat($('#payable_hidden_' + bookingID).val());
                var selected_package_id = $('#package_id_' + bookingID).val();
                var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                var customer_gender = $('#customer_gender_' + bookingID).val();

                if (selected_package_id == "") {
                    if (is_giftcard_applied == "0" || is_giftcard_applied == "") {
                        if (customer_gender == coupon_gender) {
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
                            openDialog('Coupon code not valid for customer gender');
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
                                                $('#giftcard_success_' + bookingID).html('');
                                                $('#giftcard_success_' + bookingID).hide();
                                                $('#giftcard_error_' + bookingID).show();
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

        function showBookingEditPopup(id) {
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_edit_details_ajx",
                method: 'POST',
                data: {
                    booking_id: id
                },
                success: function(response) {
                    var encodedId = btoa(id);
                    window.location.href = '<?= base_url(); ?>reschedule/' + encodedId;
                    // $('#booking_edit_response').html(response)
                    // showPopup('BookingEditModal');
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
        $('.panel-heading').click(function() {
            $(this).find('.fas.fa-chevron-right').toggleClass('rotate-90');
        });
        $("#from_date, #to_date").on("change", function() {
            var fromDateStr = $('#from_date').val();
            var toDateStr = $('#to_date').val();

            var fromDateParts = fromDateStr.split("-");
            var toDateParts = toDateStr.split("-");

            var fromDate = new Date(fromDateParts[2], fromDateParts[1] - 1, fromDateParts[0]);
            var toDate = new Date(toDateParts[2], toDateParts[1] - 1, toDateParts[0]);

            if (!isNaN(fromDate) && !isNaN(toDate)) {
                if (fromDate > toDate) {
                    $("#status_error_new_2").html("From Date should be less than or equal to To Date");
                    $("#submit_button").prop('disabled', true);
                } else {
                    $("#status_error_new_2").html("");
                    $("#submit_button").prop('disabled', false);
                }
            } else {
                $("#status_error_new_2").html("");
                $("#submit_button").prop('disabled', false);
            }
        });

        function changeCSS(id) {
            if ($('#collapse_' + id).hasClass('in')) {
                $('#arrow_' + id).css({
                    'transform': 'rotate(0deg)',
                    'transition': 'transform 0.5s ease'
                });
            } else {
                $('#arrow_' + id).css({
                    'transform': 'rotate(90deg)',
                    'transition': 'transform 0.5s ease'
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // $('#reports .child_menu').show();
            $('#reports').addClass('nv active');
            // $('.right_col').addClass('active_right');
            $('.booking-lists').addClass('active_cc');
        });
    </script>
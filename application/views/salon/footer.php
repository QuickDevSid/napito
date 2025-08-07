<style>
    .dialog-container {
        position: fixed;
        top: 0;
        left: 0;
        /* transform: translate(-50%, -50%); */
        z-index: 9999;
        width: 100%;
        height: 100%;
        background-color: #20202066;
    }

    .dialog {
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .dialog-header {
        padding: 10px;
        font-weight: bold;
        background: linear-gradient(271deg, #800080, #ff69b4);
        color: #f6f7f8;
    }

    .dialog-body {
        padding: 10px;
    }

    .dialog-footer {
        text-align: center;
        padding: 10px 0;
    }

    .dialog-footer button {
        padding: 5px 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background: #eee;
        cursor: pointer;
    }

    .active_profile {
        width: 200px;
        /* transition: all 0.3s; */
    }

    .dialog-footer button:hover {
        box-shadow: inset 2px 2px 4px 0 #ccc;
    }
</style>
<?php if ($this->uri->segment(1) == 'add-enquiry-form') { ?>
    <div id="feedback-form" class="feedback-form">
        <!-- <button type="button" class="feedback-form-btn btn-lg btn-enquiry" id="OpenForm">Rate Card</button> -->
        <div class="feedback_form_area">
            <div class="form-head">
                <h3>Rate Card</h3>
            </div>
            <div class="feedback_form_area_inner">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Services</h4>
                            <table class="declare" style="450px;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Category</th>
                                        <th>Service</th>
                                        <th>Price</th>
                                        <th>Discounted Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>May</td>
                                        <td>2021</td>
                                        <td>01-11-2021 </td>
                                        <td>01-11-2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Products</h4>
                            <table class="declare" style="450px;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Discounted Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>July</td>
                                        <td>2021</td>
                                        <td>01-11-2021</td>
                                        <td>01-11-2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal fade" id="dashboardModal" tabindex="-1" aria-labelledby="dashboardModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" id="dashboardModal_dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dashboardModalLabel"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('dashboardModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dashboardModal_response"></div>
        </div>
    </div>
</div>
<div class="dialog-container" id="alertDialog" style="display: none;">
    <div class="dialog">
        <div class="dialog-header" id="alertMessage"></div>
        <div class="dialog-footer">
            <button onclick="closeDialog()">OK</button>
        </div>
    </div>
</div>
<div class="dialog-container" id="confirmDialog" style="display: none;">
    <div class="dialog">
        <div class="dialog-header">Confirmation</div>
        <div class="dialog-body" id="confirmMessage">Are you sure?</div>
        <div class="dialog-footer">
            <button id="cancelButton">Cancel</button>
            <button id="okButton">OK</button>
        </div>
    </div>
</div>

<!-- Onboarding Sidebar Start -->
<?php
if ($footer_onboarding_status < '18' || $this->uri->segment(1) == 'complete-profile') {
    $total_steps = count($steps) - 1;
    $completed_steps = $footer_onboarding_status;
    $completion_percentage = ($completed_steps / $total_steps) * 100;
?>
    <style>
        .completion-percentage {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 3px;
            text-align: left;
            color: green;
        }

        .right_col {
            min-height: 98%;
            /* overflow-y: scroll; */
        }

        .page-title .title_left h3 {
            margin-left: 45px;
        }


        .footer-timeline-container {
            display: flex;
            background: white;
            /* transform: translate(300px, 30px); */
            transition: 0.3s all;
            flex-direction: column;
            height: 100%;
            /* min-height: 700px; */
            align-items: flex-end;
            /* margin: 20px 0; */
            position: fixed;
            left: 0;
            /* border: 1px solid; */
            top: 0;
            z-index: 100;
            width: 270px;
            overflow: hidden;

            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }

        .log_out_btn {
            float: left;
            font-size: 10px;
        }

        .onboard-steps {
            /* Basic styling for the container */
            overflow-y: auto;
            /* max-height: 300px; */
            /* Adjust height as needed */
        }

        /* Custom scrollbar for Webkit browsers (Chrome, Edge, Safari) */
        .onboard-steps::-webkit-scrollbar {
            width: 2px;
            height: 10px;
            display: none;
            /* Width of the scrollbar */
        }

        .onboard-steps::-webkit-scrollbar-track {
            background: rgb(226, 226, 226);
            /* Background of the scrollbar track */
            border-radius: 10px;
        }

        .onboard-steps::-webkit-scrollbar-thumb {
            background: rgb(172, 172, 172);
            /* Color of the scrollbar thumb */
            border-radius: 5px;
            /* Rounded edges */
            border: 0px solid rgb(221, 106, 106);
            /* Adds padding-like effect */
            height: 10px;
        }

        .onboard-steps::-webkit-scrollbar-thumb:hover {
            background: var(--hover);
            /* Darker shade on hover */
        }

        /* Scrollbar for Firefox */
        .onboard-stepsr {
            scrollbar-width: thin;
            /* Makes the scrollbar thinner */
            scrollbar-color: #fff;
            /* Thumb color and track color */
        }

        /* Optional: Smooth scrolling */
        .onboard-steps {
            scroll-behavior: smooth;
        }


        .footer-current-status {
            width: 100%;
            padding: 10px;
            background-color: #ebebebcc;
            text-align: center;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        .footer-group {
            width: 100%;
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        .footer-group-line {
            position: absolute;
            top: 31px;
            left: 21px;
            width: 2px;
            background-color: gray;
            height: 100%;
            z-index: 0;
        }

        .footer-group-header {
            font-size: 16px;
            /* font-weight: bold; */
            cursor: pointer;
            padding: 5px 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: black;
        }

        .footer-group-content a {
            color: black !important;
        }

        .footer-group-header:hover,
        .footer-group-content a:hover {
            /* background-color: #e9e9e9; */
            color: var(--hover) !important;
            text-decoration: none !important;
        }

        .footer-group-content {
            display: none;
            padding: 3px 0;
        }

        .footer-step {
            position: relative;
            display: flex;
            align-items: center;
            flex-direction: row;
            margin-bottom: 10px;
            margin-right: 15px;
        }

        .footer-dot {
            width: 15px;
            position: relative;
            height: 15px;
            border-radius: 50%;
            background-color: white;
            border: 1px solid;
            z-index: 20;
            margin-left: 11px;
            left: 3px;
        }

        .footer-step.footer-completed .footer-dot {
            background-color: green;
        }

        .footer-step.footer-next_step .footer-dot {
            background-color: #e4cea8;
        }

        .footer-line {
            width: 2px;
            height: 30px;
            background-color: gray;
            position: absolute;
            top: 20px;
            left: 21px;
            z-index: 10;
        }

        .footer-step.footer-completed .footer-line {
            background-color: green;
        }



        .footer-label {
            font-size: 14px;
            text-align: right;
            margin-left: 15px;
            max-width: 150px;
            word-wrap: break-word;
        }


        .footer-label a {
            text-decoration: none;
            color: blue;
            font-size: 12px;
        }

        .footer-label a:hover {
            text-decoration: underline;
        }

        .open-btn-timeline {
            position: fixed;
            top: 18px;
            /* padding: 5px 5px; */
            font-size: 16px;
            left: 0;
            border-radius: 4px;
            z-index: 99;
        }

        .onboard-steps>.footer-group:last-child .footer-group-line {
            display: none;
        }

        .onboard-steps>.footer-group:last-child .footer-group-header i {
            background-color: #2fd22f;
        }

        .right_col {
            /* border: 1px solid; */
            margin-top: 80px;
            background: white !important;
            /* min-height: 609px; */
            margin-left: 290px;
            /* min-width: 1046px; */
            border-radius: 15px;

        }

        @media (max-width:997px) {
            .right_col {
                margin-left: 0px !important;
            }

        }


        .open-btn-timeline {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
            background: white;
        }

        .open-btn-timeline button,
        .close-btn-timeline button {
            background: white;
            border: none;
            color: black;
            margin-top: 5px;

        }

        .open-btn-timeline:hover button,
        .close-btn-timeline:hover button {
            background: white;
            border: none;
            color: var(--hover);

        }

        .footer-group-header {
            margin-left: 30px;
            font-size: 14px;
        }

        .footer-current-status,
        .footer-group-content,
        .footer-group-header {
            background: white;
            border: none;
        }

        .onboard-steps {
            width: 100%;
            margin: 0 auto;
            height: 520px;
        }

        .intro-logo {
            width: 60px;
            position: fixed;
            right: 53px;
            z-index: 100;
            top: 15px;
            border-radius: 20px;
            overflow: hidden;



        }

        .intro-logo img {
            width: 100%;
            border-radius: 50%;



        }

        .profile_img {
            width: 40px;

        }

        .profile_img img {
            width: 100%;

        }

        .footer-group-header i {
            font-size: 12px;
            margin-right: 8px;
            color: #545454;
            border: 1px solid #b9b9b9;
            margin-left: -31px;
            /* padding: 4px 4px; */
            height: 25px;
            width: 25px;
            border-radius: 50%;
            text-align: center;
            line-height: 25px;
            background: white;
        }

        .user_name {
            text-align: left;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .profile_container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    <div class="open-btn-timeline">
        <button class='toggle-timeline'>&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-bars"></i> &nbsp;&nbsp;&nbsp;Onboarding Steps <label style="color:green;">(<?= round($completion_percentage) ?>%)</label></button>

    </div>
    <div class="intro-logo">
        <img src="<?= base_url() ?>/assets/images/napito_logo.jpg" alt="">
    </div>

    <div class="footer-timeline-container open-timeline">


        <div class="footer-current-status">

            <div class="profile_container">
                <div class="col">
                    <div class="profile_img">
                        <?php if (!empty($gst) && $gst->store_logo != "") { ?>
                            <img src="<?= base_url() ?>admin_assets/images/store_logo/<?php echo $gst->store_logo; ?>" alt="profile image">
                        <?php } else { ?>
                            <img src="<?= base_url() ?>\salon_assets\images\user.png" alt="profile image">
                        <?php } ?>
                    </div>
                </div>
                <div class="col">
                    <h4 class="user_name">Hello! <?= !empty($profile) ? $profile->branch_name : ""; ?></h4>
                    <div class="completion-percentage">
                        <?= round($completion_percentage) ?>% Complete
                    </div>
                    <div class="log_out_btn">
                        <a href="<?= base_url(); ?>salon_do_logout"><i class="fa fa-sign-out"></i>Logout</a>
                    </div>
                </div>

            </div>

            <?php
            $groups = [
                // 'Registration' => [0],
                'Store Settings' => range(1, 5),
                'Shift Management' => [6],
                'Master Setup' => range(7, 10),
                'Marketing Setup' => range(11, 15),
                'Employee Setup' => range(16, 17),
                'Academy Setup' => [18]
            ];

            $icons = [
                'Store Settings' => 'fa-store',
                'Shift Management' => 'fa-clock',
                'Master Setup' => 'fa-sitemap',
                'Marketing Setup' => 'fa-bullhorn',
                'Employee Setup' => 'fa-users',
                'Academy Setup' => 'fa-graduation-cap'
            ];

            $current_group = null;
            $current_step = $steps[$footer_onboarding_status];

            foreach ($groups as $group_name => $statuses) {
                if (in_array($footer_onboarding_status, $statuses)) {
                    $current_group = $group_name;
                    break;
                }
            }
            ?>
        </div>

        <div class="onboard-steps">
            <?php foreach ($groups as $group_name => $statuses) { ?>


                <div class="footer-group">
                    <div class="footer-group-line"></div>
                    <div class="footer-group-header">
                        <?php if (isset($icons[$group_name])) { ?>
                            <i class="fa <?= $icons[$group_name] ?>"></i>
                        <?php } ?>
                        <?= $group_name ?>
                    </div>
                    <div class="footer-group-content <?= ($group_name == $current_group) ? 'display' : '' ?>">
                        <?php foreach ($statuses as $status_key) {
                            if (isset($steps[$status_key])) {
                                $check_array = $steps[$status_key]['check_array'];
                                $link_allowed = '0';
                                if (((int)$steps[$status_key]['flag'] <= (int)$footer_onboarding_status) || ($next_status_flag == (int)$steps[$status_key]['flag'])) {
                                    $link_allowed = '1';
                                }
                        ?>
                                <div class="footer-step <?= $status_key <= $footer_onboarding_status ? 'footer-completed' : ($next_status_flag == (int)$steps[$status_key]['flag'] ? 'footer-next_step' : '') ?>">
                                    <div class="footer-dot"></div>
                                    <div class="footer-label" title="<?= $steps[$status_key]['name'] ?>">
                                        <?php if ($link_allowed == '1') { ?>
                                            <a class="<?php if (empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; } ?>" href="<?= $steps[$status_key]['link'] ?>"><?= $steps[$status_key]['name'] ?></a>
                                        <?php } else { ?>
                                            <a class="<?php if (empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; } ?>"><?= $steps[$status_key]['name'] ?></a>
                                        <?php } ?>
                                    </div>
                                    <?php if ($status_key < max($statuses)) { ?>
                                        <div class="footer-line"></div>
                                    <?php } ?>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="footer-group">
                <div class="footer-group-line"></div>
                <div class="footer-group-header" style="<?php if ($footer_onboarding_status >= '18') { ?> <?php } else { ?>cursor: not-allowed;<?php } ?>">
                    <?php if ($footer_onboarding_status >= '18') { ?>
                        <i class="fas fa-check"></i>
                        <a href="<?= base_url(); ?>salon-dashboard-new" title="Onboarding Completed">Let's Go</a>
                    <?php } else { ?>
                        <i class="fas fa-stop" style="background-color:#e4cea8;"></i>
                        Let's Go
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>



    <script>
        $(document).ready(function() {

            // $('.footer-group-line').hide();

            $(".profile-dropdown button").click(function() {
                $(".profile-dropdown dropdownMenu1").toggleClass('.active_profile');
            });

            $('.footer-group-header').on('click', function() {
                const content = $(this).next('.footer-group-content');
                const line = $(this).prev('.footer-group-line');

                // line.toggle();
                content.slideToggle();
                $('.footer-group-content').not(content).slideUp();
            });

            const currentStatus = <?= $footer_onboarding_status ?>;
            const nextStatus = currentStatus + 1;

            $('.footer-group').each(function() {
                const group = $(this);
                const groupName = group.find('.footer-group-header').text().trim();

                if (
                    (groupName === "Store Settings" && nextStatus >= 1 && nextStatus <= 5) ||
                    (groupName === "Shift Management" && nextStatus === 6) ||
                    (groupName === "Master Setup" && nextStatus >= 7 && nextStatus <= 10) ||
                    (groupName === "Marketing Setup" && nextStatus >= 11 && nextStatus <= 15) ||
                    (groupName === "Employee Setup" && nextStatus >= 16 && nextStatus <= 17) ||
                    (groupName === "Academy Setup" && nextStatus === 18)
                ) {
                    group.find(".footer-group-content").slideDown();
                }
            });
        });
    </script>
    <?php
    $show_skip_button = true;
    $show_next_button = true;
    $next_url = '';
    $skip_status_name = '';
    $skip_status_flag = '';
    $skip_link = '';
    if ($this->uri->segment(1) != 'complete-profile') {
        if ($this->uri->segment(1) == 'store-profile') {
            $show_next_button = !empty($gst) && $gst->store_logo != "" ? true : false;
            $show_skip_button = false;
            $next_url = 'working-hours';
        } elseif ($this->uri->segment(1) == 'working-hours' && !isset($_GET['active']) && $this->uri->segment(2) != 'shifts') {
            $show_next_button = $this->Salon_model->get_salon_working_hrs() ? true : false;
            $show_skip_button = false;
            $next_url = 'salon-bank-details';
        } elseif ($this->uri->segment(1) == 'salon-bank-details') {
            $show_next_button = $this->Salon_model->get_salon_bank_details() ? true : false;
            if ($footer_onboarding_status >= '3') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'salon-location';
            $skip_status_flag = '3';
            $skip_status_name = 'Bank Details';
            $next_url = 'salon-location';
        } elseif ($this->uri->segment(1) == 'salon-location') {
            $show_next_button = $this->Salon_model->get_salon_location_details() ? true : false;
            $show_skip_button = false;
            $next_url = 'add-salon-facility';
        } elseif ($this->uri->segment(1) == 'add-salon-facility') {
            if ($footer_onboarding_status >= '5') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'working-hours?active=add_shifts_page';
            $skip_status_flag = '5';
            $skip_status_name = 'Store Facilities';
            $next_url = 'working-hours?active=add_shifts_page';
        } elseif ($this->uri->segment(1) == 'working-hours' && ((isset($_GET['active']) && ($_GET['active'] == 'add_shifts_page' || $_GET['active'] == 'regular_shift_list')) || $this->uri->segment(2) == 'shifts')) {
            $show_next_button = !empty($this->Salon_model->get_salon_shifts()) ? true : false;
            $show_skip_button = false;
            $next_url = 'add-product';
        } elseif ($this->uri->segment(1) == 'add-product' || $this->uri->segment(1) == 'product-list' || $this->uri->segment(1) == 'use_ready_product_sub_cat' || $this->uri->segment(1) == 'use_ready_product_cat') {
            if ($footer_onboarding_status >= '7') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-salon-services';
            $skip_status_flag = '7';
            $skip_status_name = 'Products';            
            $next_url = 'add-salon-services';
        } elseif ($this->uri->segment(1) == 'add-salon-services' || $this->uri->segment(1) == 'salon-services-list' || $this->uri->segment(1) == 'ready-sub-category' || $this->uri->segment(1) == 'ready-services') {
            $show_next_button = !empty($this->Salon_model->get_salon_services()) ? true : false;
            $show_skip_button = false;
            $next_url = 'add-membership';
        } elseif ($this->uri->segment(1) == 'add-membership') {
            if ($footer_onboarding_status >= '9') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-package';
            $skip_status_flag = '9';
            $skip_status_name = 'Memberships';
            $next_url = 'add-package';
        } elseif ($this->uri->segment(1) == 'add-package') {
            if ($footer_onboarding_status >= '10') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-coupon-code';
            $skip_status_flag = '10';
            $skip_status_name = 'Packages';
            $next_url = 'add-coupon-code';
        } elseif ($this->uri->segment(1) == 'add-coupon-code') {
            if ($footer_onboarding_status >= '11') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-offers';
            $skip_status_flag = '11';
            $skip_status_name = 'Coupons';
            $next_url = 'add-offers';
        } elseif ($this->uri->segment(1) == 'add-offers') {
            if ($footer_onboarding_status >= '12') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-gift-card';
            $skip_status_flag = '12';
            $skip_status_name = 'Offers';
            $next_url = 'add-gift-card';
        } elseif ($this->uri->segment(1) == 'add-gift-card') {
            if ($footer_onboarding_status >= '13') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add-reward-point';
            $skip_status_flag = '13';
            $skip_status_name = 'Giftcard';
            $next_url = 'add-reward-point';
        } elseif ($this->uri->segment(1) == 'add-reward-point') {
            $show_next_button = !empty($this->Salon_model->get_salon_rewards()) ? true : false;
            $show_skip_button = false;
            $next_url = 'add_automated_marketing?type=all';
        } elseif ($this->uri->segment(1) == 'add_automated_marketing' && isset($_GET['type']) && $_GET['type'] == 'all') {
            if ($footer_onboarding_status >= '15') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'employee_incentive_master';
            $skip_status_flag = '15';
            $skip_status_name = 'Automated Marketing';
            $next_url = 'employee_incentive_master';
        } elseif ($this->uri->segment(1) == 'employee_incentive_master') {
            if ($footer_onboarding_status >= '16') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'add_employee';
            $skip_status_flag = '16';
            $skip_status_name = 'Employee Incentives';
            $next_url = 'add_employee';
        } elseif ($this->uri->segment(1) == 'add_employee' || $this->uri->segment(1) == 'add_employee_list') {
            $show_next_button = !empty($this->Salon_model->get_salon_employees()) ? true : false;
            $show_skip_button = false;
            $next_url = 'add-course';
        } elseif ($this->uri->segment(1) == 'add-course') {
            if ($footer_onboarding_status >= '18') {
                $show_next_button = true;
                $show_skip_button = false;
            } else {
                $show_next_button = false;
                $show_skip_button = true;
            }
            $skip_link = 'complete-profile?loader=true';
            $skip_status_flag = '18';
            $skip_status_name = 'Academy Courses';
            $next_url = 'complete-profile?loader=true';
        }
    ?>
        <!-- <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                <a onclick="return confirm('Are you sure you want to skip <?= $next_status_name; ?>?');" href="<?= base_url(); ?>skip-onboarding?status=<?= base64_encode($next_status_flag); ?>&redirect=<?= base64_encode($skip_link); ?>&skip_step=<?= base64_encode($next_status_name); ?>" class="btn btn-default back_button_class" id="backButton"><i class="fa fa-step-forward"></i>&nbsp;&nbsp;Skip <?= $next_status_name; ?></a>
            </div>
        </div> -->
        <?php if ($show_skip_button || $show_next_button) { ?>
            <div class="row">
                <?php if ($show_skip_button) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer_back_strip" style="text-align:right;">
                        <a onclick="return confirm('Are you sure you want to skip <?= $next_status_name; ?>?');" href="<?= base_url(); ?>skip-onboarding?status=<?= base64_encode($skip_status_flag); ?>&redirect=<?= base64_encode($skip_link); ?>&skip_step=<?= base64_encode($skip_status_name); ?>" class="btn btn-default back_button_class" id="skipButton"><i class="fa fa-step-forward"></i>&nbsp;&nbsp;Skip</a>
                    </div>
                <?php } ?>
                <?php if ($show_next_button) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer_back_strip" style="text-align:right;">
                        <a onclick="return confirm('Are you sure you want to move to next step?');" href="<?= base_url(); ?><?= $next_url; ?>" class="btn btn-default back_button_class" id="nextButton"><i class="fa fa-step-forward"></i>&nbsp;&nbsp;Next</a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
    <?php if($this->uri->segment(1) != "bill-generation"){ ?>
    <!-- Onboarding Sidebar end -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer_back_strip">
            <button class="btn btn-default back_button_class" id="backButton"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Back</button>
            <?php $check_array = ['bill-generation']; ?>
            <?php if(!empty(array_intersect($check_array, $feature_slugs))){ ?>
                <!-- <a class="btn btn-default back_button_class" href="<?=base_url();?>bill-generation"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Generate Bill</a> -->
            <?php } ?>       
        </div>
    </div>
    <?php } ?>
<?php } ?>
<!-- footer content -->
<!-- <?php if ($this->session->flashdata('success') != "") { ?>
                <div class="login_hide_show">
                <div class="alert alert-success animated fadeInUp " style="color:#297401;">
                    <strong style="color:#297401;">Success!</strong> <?= $this->session->flashdata('success') ?>
                </div>
                </div>
            <?php } else if ($this->session->flashdata('message') != "") { ?>
                <div class="login_hide_show">
                <div class="alert alert-danger animated fadeInUp">
                    <strong>Error!</strong> <?= $this->session->flashdata('message') ?>
                </div>
                </div>
            <?php } elseif (validation_errors() != '') { ?>
                <div class="login_hide_show">
                <div class="alert alert-danger animated fadeInUp">
                    <strong>Error!</strong> <?= validation_errors() ?>
                </div>
            </div>
            <?php } ?>
            <script>
             $(".alert").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                });  -->

<div id="alert-box"></div>

<?php if ($this->session->flashdata('success') != "") { ?>
    <div class="login_hide_show alert alert-success animated fadeInUp" style="color:#297401;">
        <strong style="color:#297401;"></strong> <?= $this->session->flashdata('success') ?>
    </div>
<?php } else if ($this->session->flashdata('message') != "") { ?>
    <div class="login_hide_show alert alert-danger animated fadeInUp">
        <strong></strong> <?= $this->session->flashdata('message') ?>
    </div>
<?php } elseif (validation_errors() != '') { ?>
    <div class="login_hide_show alert alert-danger animated fadeInUp">
        <strong></strong> <?= validation_errors() ?>
    </div>
<?php } ?>

<script>
    $("#OpenForm").click(function() {
        $(".feedback_form_area").animate({
            width: "toggle"
        }, function() {
            if ($(".feedback_form_area").is(":visible")) {
                $('body').append('<div class="hide_body"></div>');
            } else {
                $('.hide_body').remove();
            }
        });
    });
    document.getElementById("backButton").addEventListener("click", function() {
        window.history.back();
    });

    function openDialog(message) {
        $("#alertMessage").text(message);
        $("#alertDialog").show();
    }

    function closeDialog() {
        $("#alertDialog").hide();
    }

    function openConfirmationDialog(message, callback) {
        $("#confirmMessage").text(message);
        $("#confirmDialog").show();

        $("#okButton").click(function() {
            $("#confirmDialog").hide();
            callback(true);
        });

        $("#cancelButton").click(function() {
            $("#confirmDialog").hide();
            callback(false);
        });
    }

    $(".alert").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });
</script>



<!-- /footer content -->


<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>



<!-- here php code written which is use for success or login fail with color -->



<script src="<?= base_url() ?>salon_assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/slick.js"></script>

<script src="<?= base_url() ?>salon_assets/js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?= base_url() ?>salon_assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?= base_url() ?>salon_assets/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?= base_url() ?>salon_assets/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/moment.min.js"></script>
<!-- <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/datepicker/daterangepicker.js"></script> -->

<script src="<?= base_url() ?>salon_assets/js/custom-salon.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/js/jquery.filer.min.js"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/date.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>admin_assets/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?= base_url() ?>admin_assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>admin_assets/js/chosen.proto.js"></script>
<script type="text/javascript" src="<?= base_url() ?>admin_assets/js/chosen.proto.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
<!-- <script src="admin_assets/js/jquery.timesetter.js"></script> -->
<!-- <script src="admin_assets/js/booking_calender.js"></script> -->
<!-- <script src="admin_assets/js/jquery.timesetter.es5"></script> -->
<!-- <script src="admin_assets/js/jquery.timesetter.es5.min"></script> -->


<!-- script for validation which is used in all forms -->



<!-- worldmap -->

<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/maps/jquery-jvectormap-2.0.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/maps/jquery-jvectormap-us-aea-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>salon_assets/js/datepicker/daterangepicker.js"></script>
<!-- Datatables -->
<script src="<?= base_url() ?>salon_assets/js/datatables/js/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>salon_assets/js/datatables/tools/js/dataTables.tableTools.js"></script>


<script src="<?= base_url("assets/admin/js/popper.min.js"); ?>"></script>
<script src="<?= base_url("assets/admin/js/bootstrap.js"); ?>"></script>

<script src="<?= base_url("assets/admin/js/plugins/jquery-ui/jquery-ui.min.js"); ?>"></script>

<!-- Jvectormap -->
<script src="<?= base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"); ?>"></script>
<script src="<?= base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"); ?>"></script>

<!-- EayPIE -->
<script src="<?= base_url("assets/admin/js/plugins/easypiechart/jquery.easypiechart.js") ?>"></script>


<!-- SUMMERNOTE -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- jquery foemvalidation - added-->
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>

<!-- for datatable -->
<script src="<?= base_url('assets/admin/js/plugins/dataTables/datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- Tags Input -->
<script src="<?= base_url('assets/admin/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>"></script>

<!-- Data picker -->
<!-- <script src="<?= base_url('assets/admin/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script> -->
<script src="<?= base_url(); ?>assets/admin/js/chosen.jquery.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>salon_assets/css/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.1/tippy-bundle.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#alter_btn').click(function () {
            $('.dashboard_list_links_row').slideToggle(750);
            $('#alter_btn .toggle-icon').toggleClass('rotated');
        });
    });
    $(document).ready(function() {
        $('.single_date').daterangepicker({ //here single_date which is use for date display
            //which is used by using class="single_date"
            singleDatePicker: true,
            calender_style: "picker_1",
            format: "DD-MM-YYYY"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal2').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_2"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal3').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_3"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal4').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen();
        $(".form-select").chosen();
        $('.bell_open').click(function() {
            $('.bell_open_cc').toggle();
        });
    });
    setTimeout(function() {
        $('.loader_Box').fadeOut();
    }, 1500);
</script>

<script>
    $(document).ready(function() {
        updateSubscriptionData();
        updateOfferData();
        updateActiveBookingRulesData();
        updateLapsedShortBreaks();
        $('.timepicker').clockpicker({
            donetext: 'Done',
            twelvehour: false
        });
    });

    function formatDateTime_without_second(date) {
        const pad = (n) => n.toString().padStart(2, '0');

        const year = date.getFullYear();
        const month = pad(date.getMonth() + 1);
        const day = pad(date.getDate());

        const hours = pad(date.getHours());
        const minutes = pad(date.getMinutes());
        const seconds = '00';

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }
</script>
<script>
    flatpickr(".datepicker_show", {
        dateFormat: "d-m-Y",
    });
</script>

<script>
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#sidebar-menu').length && window.innerWidth <= '1200') {
            $('.nav.child_menu').hide();
            $('.right_col').removeClass('active_right');

        }
        if (!$(event.target).closest('.footer-timeline-container').length && !(event.target).closest('.open-btn-timeline') && window.innerWidth <= '997') {
            $('.footer-timeline-container').hide();

        }
    });
    $('.toggle-timeline').click(function() {
        $('.footer-timeline-container').show();


    });
</script>


<script>
    $(document).ready(function () {
        $('.blurred').each(function () {
            if (!$(this).is('li') && !$(this).parent().is('li')) {
                if (!$(this).parent().hasClass('blurred-wrapper')) {
                    var $wrapper = $('<div class="blurred-wrapper"></div>');
                    var $overlay = $('<div class="blurred-overlay"><a target="_blank" href="https://business.napito.in/">&#x1F513; <br> Upgrade Plan</a></div>');

                    $(this).wrap($wrapper).after($overlay);
                }
            }            
        });
    });
</script>



<script>
    function setLostCustomers() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_lost_customers_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Lost customers set successfully');
                } else {
                    console.log('Something went wrong');
                }
            },
            error: function() {
                console.log('Error while finding lost customers');
            }
        });
    }
    function updateOfferData() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_updated_offer_data_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Offer data updated successfully');
                } else {
                    console.log('Something went wrong');
                }
            },
            error: function() {
                console.log('Error while offer data update');
            }
        });
    }
    function updateSubscriptionData() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_updated_subscription_data_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Subscription data updated successfully');
                } else {
                    console.log('Something went wrong');
                }
            },
            error: function() {
                console.log('Error while subscription data update');
            }
        });
    }
    function updateInactiveBookingRulesData() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_updated_inactive_booking_rule_data_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Inactive booking rules data updated successfully');
                } else {
                    console.log('Inactive booking rules not available');
                }
            },
            error: function() {
                console.log('Error while inactive booking rule data update');
            }
        });
    }
    function updateActiveBookingRulesData() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_updated_active_booking_rule_data_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Active booking rules data updated successfully');
                } else {
                    console.log('Active booking rules not available');
                }
            },
            error: function() {
                console.log('Error while Active booking rule data update');
            }
        });
    }
    function updateLapsedShortBreaks() {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/set_short_break_lapsed_data_ajx",
            method: 'POST',
            data: {},
            success: function(response) {
                if (response == '1') {
                    console.log('Lapsed short breaks data updated successfully');
                } else {
                    console.log('Lapsed short breaks not available');
                }
            },
            error: function() {
                console.log('Error while lapsed short breaks data update');
            }
        });
    }
</script>


<!-- /datepicker -->
<!-- /footer content -->
<!-- Datatables -->
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<!-- <script src='https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

</div>
</div>

</body>

</html>
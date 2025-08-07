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
            <div class="stylist_list_box" style="display: none"></div>
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
            <a onclick="showDashboardDataPopup('9')" data-toggle="modal" data-target="#DashboardModal" class="<?php if ($profile->include_wp != '1') {
                                                                                                                    echo 'blurred ';
                                                                                                                } ?>add_new_booking">
                <div class="btn btn-primary dashboard_list_btn">
                    <i class="fa-brands fa-whatsapp"></i> Whatsapp
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
                <a href="<?=base_url();?>trying-booking-list"> 
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Trying for Booking</span>
                            <div class="center-part">
                                <div class="count " id="trying_booking_count">0</div>
                                <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\trying.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                </a>
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
                <!-- <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                <div class="right">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Completed</span>
                    <div class="center-part">
                        <div class="count">123</div>
                        <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\appointment.png" class="img-responsive dashboard_imgs">
                    </div>
                </div>
            </div>
            <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Cancelled</span>
                    <div class="center-part">
                        <div class="count ">10</div>
                        <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\appointment.png" class="img-responsive dashboard_imgs">
                    </div>
                </div>
            </div>
            <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Trying for Booking</span>
                    <div class="center-part">
                        <div class="count ">8</div>
                        <img style="" src="<?= base_url() ?>salon_assets\images\dashboarad\appointment.png" class="img-responsive dashboard_imgs">
                    </div>
                </div>
            </div> -->
            </div>
        </div>
    </div>
</div>
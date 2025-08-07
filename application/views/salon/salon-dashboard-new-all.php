<?php include('header.php'); ?>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.css" rel="stylesheet" />


<style>
    
    .extra-service-discount-tooltip{
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
    .extra-service-discount-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #extra_service_discount_details_info{
        cursor: pointer;
    }
    #extra_service_discount_details_info:hover .extra-service-discount-tooltip{
       display: block;
    }

    .extra_service_price_table table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr td{
        padding: 5px !important;
    }
    .single_added_extra_service_details{    
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
        padding: .2em .8em;
        border-radius: 4px;
        border: 1px solid #bcbcbc;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        /* background-image: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(239, 239, 239, 1) 60%, rgba(225, 223, 226, 1) 100%); */
        background-repeat: no-repeat;
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

        &>label {
            float: left;
            width: 4em;
            text-align: right;
            padding-right: 5px;
        }

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

    .colmd2 {
        width: 19.666667%;
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
        /* display: none; */
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
        /* -moz-transform: translate(-50%, -50%); */
        /* -webkit-transform: translate(-50%, -50%); */
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
        /* -moz-transform: translate(-50%, -50%); */
        /* -webkit-transform: translate(-50%, -50%); */
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
.time_slot_and_detail .cc_bb_detail_booked{
    background-color: #fffadf;
    width: 556px;
    height: 226px;
    cursor: pointer;
}
.time_slot_and_detail .cc_bb_detail_booked div{
 font-size: 10px;
 height: 36px;
}
.current_month_name{
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
.current_month_date_detail{
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
.emp_name_content{
    width: calc(95%/<?php echo $staff_count; ?>);
    float: left;
    text-align: center;
    padding-left: 24px;
    cursor: pointer !important;
}

.current_week_name{
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
.current_week_name_for_month{
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
.current_week_time_detail{
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
.time_slot_and_detail .cc_bb_detail{
    background-color: #fffadf;
    /* padding: 18px; */
    padding-left: 0px;
    width: calc(95% /<?php echo $staff_count; ?>);
    float: left;
    height: 226px;
    border-right: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
}
/* .dropzone .bb_ll_status{
    margin-top: 6px;
}
.dropzone .bb_ll_status i{
    margin-left: 12px;
    font-size: 17px;
} */
</style>


<!-- <div class="loader_Box">
    <span class="loader"></span>
    <div class="loaders">Time to Shine, Time to Dazzle</div>
</div> -->

<div class="right_col" role="main">
<?php
        if($gst == ""){?>
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
        <?php }else{?>
    <div class="row dashboard_list_links_row">
        <div class="col-md-12 dashboard_menu_list">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="active" id="tab_1">
                        <a href="#1" data-toggle="tab">Appoinment</a>
                    </li>
                    <li id="tab_2">
                        <a href="#2" data-toggle="tab">Sales View</a>
                    </li>
                    <li id="tab_3">
                        <a href="#3" data-toggle="tab">Redemptions</a>
                    </li>
                    <li id="tab_4">
                        <a href="#4" data-toggle="tab">Finance View</a>
                    </li>
                    <li id="tab_5">
                        <a href="#5" data-toggle="tab">Product</a>
                    </li>
                </ul><br>
            </div>
            <div class="dashboard_list_col">
                <!-- <div class="btn btn-primary dashboard_list_btn" id="get_staff">
                    Select staff
                </div> -->
                <div class="stylist_list_box" style="display: none">

                </div>
                <div class="btn btn-primary dashboard_list_btn">
                    <a href="<?=base_url();?>booking-list?status=0&id=&customer=&from_date=&to_date=&service=&stylist=">Booking List</a>
                </div>
                <!-- <div class="btn btn-light dashboard_list_btn">
                    <input id="today_date" placeholder="DD/MM/YYYY" value="<?php $currentDate = date("d/m/Y");echo $currentDate; ?>">
                    <input type="hidden" id="dummy_t_date" placeholder="DD/MM/YYYY" value="<?php $currentDate = date("d/m/Y");echo $currentDate; ?>">
                </div> -->
                <div class="btn btn-primary dashboard_list_btn">
                    <a class="add_new_booking" href="<?= base_url(); ?>add-new-booking-new"> Add New </a>
                </div>
            </div>
        </div>

        <div class="tab-content">

            <div class="tab-pane active" id="1">
                <div class="row tile_count">
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Todays Booking</b>
                            <div class="center-part">
                                <div class="count">500</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> In Progress</b>
                            <div class="center-part">
                                <div class="count">25</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-clock-o"></i> Completed </b>
                            <div class="center-part">
                                <div class="count">123</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Cancelled</b>
                            <div class="center-part">
                                <div class="count ">10</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Trying for Booking</b>
                            <div class="center-part">
                                <div class="count ">8</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="2">
                <div class="row tile_count">
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Total Sale</b>
                            <div class="center-part">
                                <div class="count">500</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> In Progress</b>
                            <div class="center-part">
                                <div class="count">25</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-clock-o"></i> Completed </b>
                            <div class="center-part">
                                <div class="count">123</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Cancelled</b>
                            <div class="center-part">
                                <div class="count ">10</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Trying for Booking</b>
                            <div class="center-part">
                                <div class="count ">8</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="3">
                <div class="row tile_count">
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Todays Booking</b>
                            <div class="center-part">
                                <div class="count">500</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> In Progress</b>
                            <div class="center-part">
                                <div class="count">25</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-clock-o"></i> Completed </b>
                            <div class="center-part">
                                <div class="count">123</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Cancelled</b>
                            <div class="center-part">
                                <div class="count ">10</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <b class="count_top"><i class="fa fa-user"></i> Trying for Booking</b>
                            <div class="center-part">
                                <div class="count ">8</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="4">
                <div class="row tile_count">
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Todays Booking</span>
                            <div class="center-part">
                                <div class="count">500</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> In Progress</span>
                            <div class="center-part">
                                <div class="count">25</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Completed </span>
                            <div class="center-part">
                                <div class="count">123</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Cancelled</span>
                            <div class="center-part">
                                <div class="count ">10</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Trying for Booking</span>
                            <div class="center-part">
                                <div class="count ">8</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
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
                                <div class="count">0</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Low Stock</span>
                            <div class="center-part">
                                <div class="count">21</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/cancel-booking.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Completed</span>
                            <div class="center-part">
                                <div class="count">123</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Cancelled</span>
                            <div class="center-part">
                                <div class="count ">10</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                    <div class="animated flipInY colmd2 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Trying for Booking</span>
                            <div class="center-part">
                                <div class="count ">8</div>
                                <img style="" src="<?= base_url() ?>salon_assets/images/other/appointment.png" class="img-responsive dashboard_imgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php if(empty($booking_rules)){ ?>
    <div class="row" style="text-align:center;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label class="error">Booking rules are not set.</label>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="form-group col-lg-4">
            <select class="form-select form-control chosen-select" onchange="setStylistCalendar()" name="service_stylist_id" id="service_stylist_id">
                <option value="">Select Stylist</option>
                <?php if (!empty($salon_employee_list)) {
                    foreach ($salon_employee_list as $salon_employee_list_result) { ?>
                        <option value="<?= $salon_employee_list_result->id ?>"><?= $salon_employee_list_result->full_name; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row" >
        <div id="calendar"></div>
    </div>
    <!-- <div class="row">
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="customer_name" id="customer_name" value="" placeholder="Search customer by name or phone" style="margin-left: 0px;">
        </div>
        <div class="customer_info_search" style="display: none;">
        </div>
        <div class="col-md-6 rr_bb_aa_box">
            <input type="hidden" name="count_revenue" id="count_revenue" value="0">
        </div>
    </div> -->
    <div id="bokking_detail_model" class="popup" data-popup="popup-1">
        <div class="popup-inner">
            <div class="row">
                <div class="col-md-12 stylist_name_id"></div><br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>Services</th>
                                <th>Products</th>
                                <th>Stylist</th>
                                <th>Time</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="">

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 status_btn_content">

                </div>
            </div>
            <hr>
            <div class="btn btn-light"><a style="text-decoration: none;" href="#" data-popup-close="popup-1">Close</a></div>
        </div>
    </div>

    <div id="payment_model" class="popup" data-popup="popup-2" style="display: none;">
        <div class="popup-inner_payment">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3>Add Payment</h3>
                </div>
                <hr>
                <form method="post" name="payment_form" id="payment_form" enctype="multipart/form-data">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Paid Amount<b class="require">*</b></label>
                            <input readonly type="text" class="form-control cc_payment_fild_1" name="amount" id="amount" placeholder="Enter paid amount">
                            <input type="hidden" name="service_id" id="service_id">
                            <input type="hidden" name="stylist_id" id="stylist_id">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Payment Method<b class="require">*</b></label>
                            <select class="form-control form-select" name="payment_mode" id="payment_mode">
                                <option value="">Select Payment Method</option>
                                <option value="1">UPI</option>
                                <option value="2">Cash</option>
                                <option value="3">Cheque</option>
                                <option value="4">Online</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Payment Date<b class="require">*</b></label>
                            <input readonly type="text" class="form-control cc_payment_fild_1" name="payment_date" value="<?php $currentDate = date("d/m/Y");
                                                                                                                            echo $currentDate; ?>">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary" id="payment_btn" value="payment_btn">Save</button>
                            <div class="btn btn-light"><a style="text-decoration: none;" href="#" data-popup-close="popup-2">Close</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="cancel_bokking_model" class="popup_cancel" style="display: none;">
        <div class="popup-inner-cancel">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form method="post" name="cancel_form" id="cancel_form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="tbl_id">
                        <h4>Are you sure to cancel this booking !</h4>
                        <hr>
                        <button type="submit" class="btn btn-success" id="cancel_btn" name="cancel_btn" value="cancel_btn">Yes</button>
                        <div class="btn btn-light" onclick="closecancelbooking_model()">No</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="reshedule_model" class="popup" data-popup="popup-4" style="display: none;">
        <div class="popup_inner_reshedule">
            <div class="x_panel">
                <div class="x_content">

                    <div class="row pp_title_cc">
                        <p>Customer Details</p>
                    </div>
                    <div class="form-group col-md-6 col-xs-12 cc-details-input">
                        <input readonly type="text" class="form-control" name="c_name" id="c_name">
                    </div>
                    <!-- <div class="form-group col-md-4 col-xs-12 cc-details-input">
                        <input readonly type="text" class="form-control" name="c_email" id="c_email">
                    </div> -->
                    <div class="form-group col-md-6 col-xs-12 cc-details-input">
                        <input readonly type="text" class="form-control" name="c_phone" id="c_phone">
                    </div>

                    <div class="row pp_title_cc">
                        <p>Date & Time</p>
                    </div>

                    <div class="row c_ss_date_time">

                    </div>

                    <div class="row pp_title_cc">
                        <p>Add Services</p>
                    </div>
                    <form method="post" name="services_form" id="services_form" enctype="multipart/form-data">
                        <div class="row pp_title_cc">
                            <div class="form-group col-md-4 col-sm-6 cc-details-input">
                                <label>Select Services</label>
                                <select class="form-select form-control chosen-select" name="services" id="services">
                                    <option value="">Select Services</option>
                                    <?php if (!empty($service_list)) {
                                        foreach ($service_list as $service_list_result) { ?> 
                                        <option value="<?= $service_list_result->id ?>"><?=$service_list_result->service_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-xs-6 cc-details-input">
                                 <label>Select Time Slot</label>
                                <input autocomplete="off" onclick="open_stylist_by_datetime()" type="text" class="form-control" name="time_slot" id="new_time_slot" placeholder="Select time slot">
                                <input type="hidden" name="booking_date" id="booking_date">
                                <input type="hidden" name="customer_name" id="customer_id">
                                <input type="hidden" name="payble_price" id="payble_price">
                                <input type="hidden" name="amount_to_paid" id="amount_to_paid">
                                <input type="hidden" name="gst_amount" id="gst_amount">
                                <div class="tt_ss_content_content"></div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 cc-details-input">
                                <label>Select Stylist</label>
                                <select class="form-select form-control" name="stylist" id="stylist">
                                    <option value="">Select Stylist</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                             <button type="submit" class="btn btn-primary" id="add_service_btn" name="add_service_btn" value="add_service_btn">Save</button>
                           </div>
                        </div>
                    </form>
                        <div class="row pp_title_cc">
                            <p>Services & Stylist</p>
                        </div>
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Services</th>
                                    <!-- <th>Products</th> -->
                                    <th>Stylist</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="booking_data_table_row">

                            </tbody>
                        </table>
                        <form method="post" name="notes_form" id="notes_form" enctype="multipart/form-data">
                        <div class="row pp_title_cc">
                            <p>Customer Notes</p>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 cc-details-input">
                        <label>Personal Note</label>
                            <textarea type="text" class="form-control" name="personal_note" id="personal_note"></textarea>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 cc-details-input">
                        <label>Admin Note</label>
                            <textarea type="text" class="form-control" name="note" id="note"></textarea>
                            <input type="hidden" class="form-control" name="id" id="table_id">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                           <button type="submit" class="btn btn-primary" id="reshedule_btn" name="reshedule_btn" value="reshedule_btn">Save</button>
                        <div class="btn btn-light"><a style="text-decoration: none;" href="#" data-popup-close="popup-4">Close</a></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Today's All Booking</h3>
                </div>
                <div id="cchart"></div>
            </div>
        </div>
        <div class="col-md-6 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Today's Employees Attendance</h3>
                </div>
                <div id="achart"></div>
            </div>
        </div>
    </div>
<?php }?>
</div>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:125px;width:950px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Service Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('myModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceRescheduleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true" >
    <div class="modal-dialog" style="margin-top:200px;width:1050px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Reschedule Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceRescheduleModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reschedule_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceCompleteModal" tabindex="-1" aria-labelledby="exampleModalComplete" aria-hidden="true" >
    <div class="modal-dialog" style="margin-top:175px;width:850px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalComplete">Complete Service <small style="float:right;margin-right:20px;">(Note: Payment for complete booking is considered here)</small></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceCompleteModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="complete_details_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="margin-top:200px;width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('addServiceModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_service_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="ServiceCancelModal" tabindex="-1" aria-labelledby="exampleModalCancel" aria-hidden="true" >
    <div class="modal-dialog" style="margin-top:175px;width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCancel">Cancel Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceCancelModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cancel_details_response"></div>
        </div>
    </div>
</div>

<?php include('footer.php'); 
if(!empty($booking_rules)){
    $slot = $booking_rules->slot_time;
    $days_early_booking = $booking_rules->max_booking_range_day;
    $minutes_early_booking = $booking_rules->booking_time_range;
    if($days_early_booking != ""){
        $max_date = date('Y-m-d', strtotime('+'.$days_early_booking.' day'));
    }else{
        $max_date = date('Y-m-d', strtotime('+0 day'));
    }
}else{
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
if(!empty($offers_list)){
    foreach ($offers_list as $offer) {
        $service_names = explode(',', $offer->service_name);
        foreach ($service_names as $service_name) {
            $offers_services[] = $service_name;
        }
    }   
}
?>

<script src="<?= base_url() ?>admin_assets/js/booking_calender.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/resource-common.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/resource-timegrid.min.js"></script>
<script>
    var max_date_str = '<?php echo  ($max_date != "") ? date('Y-m-d',strtotime($max_date)) : ''; ?>';
    var minutes_early_booking_str = '<?php echo  ($minutes_early_booking != "") ? $minutes_early_booking : ''; ?>';
    $(document).ready(function() {
        setStylistCalendar();
        $('#payment_form').validate({
            ignore: "",
            rules: {
                paid_amount: {
                    required: true,
                    noHTMLtags: true,
                },
                payment_mode: {
                    required: true,
                    noHTMLtags: true,
                },
                payment_date: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                paid_amount: {
                    required: "Please enter paid amount!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                payment_mode: {
                    required: "Please enter payment method!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                payment_date: {
                    required: "Please select date!",
                    noHTMLtags: "HTML tags not allowed!",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<script>
    function reschedule_booking(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/reschedule_booking_ajax",
            data: {
                'id': id,
                'time_slot': $('#b_time_'+id+'').val(),
                'booking_date': $('#b_date_'+id+'').val(),
                'stylist': $('#stylist_'+id+'').val(),
            },
            success: function(data) {
                if(data==1){
                    location.reload();
                }else{
                    alert('Booking did not get rescheduled. Please try again.')
                }
                
            },
        });
        $('#reshedule_model').hide();
    }
</script>

<script>
    function opencancelbooking_model(tbl_id) {
        $("#cancel_bokking_model").show();
        $("#tbl_id").val(tbl_id);
    }

    function closecancelbooking_model() {
        $("#cancel_bokking_model").hide();
    }
</script>

<!-- openbookingpayment -->

<script>
    function openbookingpayment() {
        $("#payment_model").show();
        $("#bokking_detail_model").hide();
    }

    function makebookingpayment(amount, stylist_id, service_id, customer_id) {
        $("#amount").val(amount);
        $("#stylist_id").val(stylist_id);
        $("#service_id").val(service_id);
        $("#customer_id").val(customer_id);
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
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
    });
</script>

<!-- // Open modal -->
            <!-- showPopup('myModal');

            // Handle button clicks inside the modal
            $('#cancelButton').on('click', function() {
                // Handle cancel action
                // For example, you can perform an AJAX call to cancel the event
                console.log('Cancel button clicked for event with id:', arg.event.id);
            });

            $('#rescheduleButton').on('click', function() {
                // Handle reschedule action
                // For example, you can open a form to reschedule the event
                console.log('Reschedule button clicked for event with id:', arg.event.id);
            });

            $('#makePaymentButton').on('click', function() {
                // Handle make payment action
                // For example, you can redirect to a payment page
                console.log('Make payment button clicked for event with id:', arg.event.id);
            }); -->
<script>
function showReschedulePopup(id) {
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/show_service_reschedule_popup_ajx",
        method: 'POST',
        data: { booking_service_details_id: id },
        success: function(response) {
            $('#reschedule_details_response').html(response)
            showPopup('ServiceRescheduleModal');
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
        data: { booking_service_details_id: id },
        success: function(response) {
            $('#cancel_details_response').html(response)
            showPopup('ServiceCancelModal');
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
        data: { booking_service_details_id: id },
        success: function(response) {
            $('#complete_details_response').html(response)
            showPopup('ServiceCompleteModal');
        },
        error: function() {
            alert("Error fetching service details");
        }
    });
}
function showAddServicePopup(event, id) {
    event.stopPropagation();
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/show_add_service_popup_ajx",
        method: 'POST',
        data: { booking_service_details_id: id },
        success: function(response) {
            $('#add_service_response').html(response)
            showPopup('addServiceModal');
        },
        error: function() {
            alert("Error fetching service details");
        }
    });
}

function appendSlotsDiv(booking_details_id,append_to_ID,duration){
    var date = $('#service_date_'+booking_details_id).val();

    $("#service_executive_div_"+booking_details_id).hide();
    $("#service_executive_"+booking_details_id).val('');

    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_stylist_reschedule_timeslots_updated_ajx",
        data: { 'date': date, 'duration': duration, 'booking_details_id': booking_details_id },
        success: function(data) {
            $("#"+append_to_ID).html('');
            $("#"+append_to_ID).append(data);
        },
    });
}

function setStylist(radioButton,booking_details_id){
    var selectedTimeSlot = $(radioButton).val();
    if (selectedTimeSlot !== "" && typeof selectedTimeSlot !== "undefined") {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_servicewise_reschedule_ajx",
            data: { 'booking_details_id':booking_details_id,'selectedTimeSlot': selectedTimeSlot },
            success: function(data) {
                $("#service_executive_"+booking_details_id).chosen();
                $("#service_executive_"+booking_details_id).val('');
                var stylists = $.parseJSON(data);
                if(stylists.length > 0){
                    $("#service_executive_"+booking_details_id).empty();
                    $("#service_executive_"+booking_details_id).append('<option value="">Select Executive</option>');
                    var opts = $.parseJSON(data);
                    var count = 1;
                    $.each(opts, function(i, d) {
                        is_service_available = d.is_service_available;
                        is_shift_available = d.is_shift_available;
                        is_booking_present = d.is_booking_present;
                        if(is_service_available == '1'){
                            if(is_shift_available == '1'){
                                if(is_booking_present == '0'){
                                    var message = '';
                                    var disabled = '';
                                    var is_Allowed = 1;
                                    if(count == 1){
                                        var selected = 'selected';
                                    }
                                }else{
                                    // var message = '- Already Booked';
                                    var message = '- Not Available';
                                    var disabled = 'disabled';
                                    var is_Allowed = 0;
                                }
                            }else{
                                var message = '- Not Available';
                                var disabled = 'disabled';
                                var is_Allowed = 0;
                            }

                            if(is_Allowed == 1){
                                if(count == 1){
                                    var selected = 'selected';
                                }else{
                                    var selected = '';
                                }
                            }else{
                                var selected = '';
                            }

                            $("#service_executive_"+booking_details_id).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                        
                            count++;
                        }else{
                            var disabled = 'disabled';
                            var message = '- Stylist Not Available';
                        }
                    });
                    $("#service_executive_"+booking_details_id).trigger('chosen:updated');
                    $("#service_executive_div_"+booking_details_id).show();
                }
            },
        });
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setStylistCalendar(); // Fetch all stylists' data on page load
});

function setStylistCalendar() {
    var calendarEl = document.getElementById('calendar');
    fetchAllStylistsData(calendarEl);
}

function fetchAllStylistsData(calendarEl) {
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/get_all_stylists_data",
        method: 'POST',
        success: function(response) {
            try {
                var allStylistsData = JSON.parse(response);
                console.log("Response Data:", allStylistsData);
                renderCalendar(calendarEl, allStylistsData);
            } catch (error) {
                console.error("Error parsing response data:", error);
                alert("Error fetching all stylists' schedules");
            }
        },
        error: function() {
            alert("Error fetching all stylists' schedules");
        }
    });
}

function renderCalendar(calendarEl, data) {
    if (!Array.isArray(data.stylists) || !Array.isArray(data.bookings)) {
        console.error("Data structure is incorrect:", data);
        alert("Error: Invalid data structure");
        return;
    }

    var slotDuration = <?php echo $slotDuration; ?>;

    var resources = data.stylists.map(stylist => {
        return {
            id: stylist.id,
            title: stylist.full_name
        };
    });

    var events = data.bookings.map(booking => {
        return {
            resourceId: booking.stylist_id,
            booking_id: booking.booking_id,
            booking_payment_status: booking.main_payment_status,
            booking_service_details_id: booking.id,
            booking_service_id: booking.service_id,
            booking_service_stylist_id: booking.stylist_id,
            booking_service_status: booking.service_status,
            title: booking.service_name,
            description: 'For: ' + booking.customer_name + ' [' + booking.customer_phone + ']',
            start: booking.service_from,
            end: booking.service_to,
            color: getColorBasedOnStatus(booking.service_status)
        };
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'resourceTimeGrid' ],
        initialView: 'resourceTimeGridDay',
        resources: resources,
        events: events,
        slotDuration: slotDuration,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth'
        },
        views: {
            resourceTimeGridDay: { buttonText: 'Day' },
            resourceTimeGridWeek: { buttonText: 'Week' },
            dayGridMonth: { buttonText: 'Month' }
        },
        eventContent: function(arg) {
            var viewType = arg.view.type;
            var dotHtml = '<div class="dot" style="background-color:' + arg.event.backgroundColor + ';"></div>';
            var timeHtml = '';

            if (viewType !== 'dayGridMonth') {
                timeHtml = '<p class="time" style="color:#000;">' + arg.timeText + '</p>';
            }

            var buttonHtml = '';
            if (viewType === 'resourceTimeGridDay' || viewType === 'resourceTimeGridWeek') {
                if (arg.event.extendedProps.booking_service_status === '0') {
                    if (arg.event.extendedProps.booking_payment_status === '0') {
                        var eventStartTime = new Date(arg.event.start);
                        var currentTime = new Date();
                        if (eventStartTime > currentTime) {
                            buttonHtml = '<button style="margin-top:10px;background-color:#2d2dcb !important;" title="Add New Service" id="addServiceButton_' + arg.event.extendedProps.booking_service_details_id + '" onclick="showAddServicePopup(event, ' + arg.event.extendedProps.booking_service_details_id + ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i class="fas fa-plus-circle"></i></button>';
                        }
                    } else {
                        buttonHtml = '<button style="margin-top:10px;background-color:#2d2dcb !important;" title="Receipt" id="receiptButton_' + arg.event.extendedProps.booking_service_details_id + '" onclick="openReceiptLink(event, \'' + btoa(arg.event.extendedProps.booking_id) + '\')" class="btn btn-primary event-action-button"><i class="fas fa-receipt"></i></button>';
                    }
                }
            }

            return {
                html: '<div class="event-container">' + dotHtml + '<div class="event-info">' + timeHtml + '<p class="title" style="color:#000;"><b>' + arg.event.title + '</b></p>' + buttonHtml + '</div></div>',
            };
        },
        selectable: true,
        resourceAreaHeaderContent: 'Stylists'
    });

    calendar.render();
}

function getColorBasedOnStatus(status) {
    switch (status) {
        case '0':
            return 'orange';
        case '1':
            return 'green';
        case '2':
            return 'red';
        case '3':
            return 'violet';
        default:
            return 'blue';
    }
}


function openReceiptLink(event, bookingId) {
    event.stopPropagation();
    var url = "<?= base_url(); ?>booking-print/" + bookingId;
    window.open(url, '_blank');
}
function showPopup(id){
    var exampleModal = $('#'+id);
    exampleModal.css('display','block');
    exampleModal.css('opacity','1');
    $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
}
function closePopup(id){
    var exampleModal = $('#'+id);

    exampleModal.css('display','none');
    exampleModal.css('opacity','0');
    $('.modal-open').css('overflow','auto').css('padding-right','0px');
}
</script>
<!-- dashboard view -->

<script>
    var options = {
        series: [44, 13, 57],
        chart: {
            width: 450,
            type: 'pie',
        },
        labels: ['Today’s Present Employees', 'Today’s Absent Employees', 'Total Employees'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 500
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#achart"), options);
    chart.render();

    var options = {
        series: [<?php echo $statuswise['today_cancelled']; ?>, <?php echo $statuswise['today_completed']; ?>, <?php echo $statuswise['today_pending']; ?>],
        chart: {
            width: 450,
            type: 'pie',
        },
        labels: ['Today’s Cancelled Booking', 'Today’s Completed Booking', 'Today’s Pending Booking'],
        colors: ['#FF0000', '#008000', '#FFA500'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 500
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#cchart"), options);
    chart.render();
</script>


<!-- active page -->

<script>
    $(document).ready(function() {
        $('#dashboard').addClass('nv active');

    });
</script>
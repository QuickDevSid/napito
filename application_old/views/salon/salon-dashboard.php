<?php include('header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.css" rel="stylesheet">


<style>
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
                <div class="btn btn-primary dashboard_list_btn" id="get_staff">
                    Select staff
                </div>
                <div class="stylist_list_box" style="display: none">

                </div>
                <div class="btn btn-primary dashboard_list_btn">
                    list view
                </div>
                <div class="btn btn-light dashboard_list_btn">
                    <input id="today_date" placeholder="DD/MM/YYYY" value="<?php $currentDate = date("d/m/Y");echo $currentDate; ?>">
                    <input type="hidden" id="dummy_t_date" placeholder="DD/MM/YYYY" value="<?php $currentDate = date("d/m/Y");echo $currentDate; ?>">
                </div>
                <div class="btn btn-primary dashboard_list_btn">
                    <a class="add_new_booking" href="<?= base_url(); ?>add-new-booking"> Add New </a>
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

                <!-- <div class="row">
                        <div class="col-md-12 completed_service_list">
                            <div class="col-md-9">
                                <div class="col-md-12 client_name_list">
                                    Sumit Gaikwad
                                </div>
                                <div class="col-md-12 complete_service_name">
                                    <span>Hair</span>
                                    <span>skin</span>
                                    <span>Beard</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    online|02:30
                                </div>
                                <div class="col-md-12 complete_title">
                                    <b>Service Completed</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_time_box">
                                    <p>45</p>
                                    <p>Min</p>
                                </div>
                                <div class="service_charge_button">
                                    <b>Duration</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_charge_box">
                                    <p>4500</p>
                                    <p>Paid</p>
                                </div>
                                <div class="service_charge_button" >
                                    <b>Charges</b>
                                </div>
                            </div>
                            <div class="col-md-1 add_more_plus">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 completed_service_list">
                            <div class="col-md-9">
                                <div class="col-md-12 client_name_list">
                                    Sumit Gaikwad
                                </div>
                                <div class="col-md-12 complete_service_name">
                                    <span>Hair</span>
                                    <span>skin</span>
                                    <span>Beard</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    online|02:30
                                </div>
                                <div class="col-md-12 complete_title">
                                    <b>Service Completed</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_time_box">
                                    <p>45</p>
                                    <p>Min</p>
                                </div>
                                <div class="service_charge_button">
                                    <b>Duration</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_charge_box">
                                    <p>4500</p>
                                    <p>Paid</p>
                                </div>
                                <div class="service_charge_button" >
                                    <b>Charges</b>
                                </div>
                            </div>
                            <div class="col-md-1 add_more_plus">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 completed_service_list">
                            <div class="col-md-9">
                                <div class="col-md-12 client_name_list">
                                    Sumit Gaikwad
                                </div>
                                <div class="col-md-12 complete_service_name">
                                    <span>Hair</span>
                                    <span>skin</span>
                                    <span>Beard</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    online|02:30
                                </div>
                                <div class="col-md-12 complete_title">
                                    <b>Service Completed</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_time_box">
                                    <p>45</p>
                                    <p>Min</p>
                                </div>
                                <div class="service_charge_button">
                                    <b>Duration</b>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="service_charge_box">
                                    <p>4500</p>
                                    <p>Paid</p>
                                </div>
                                <div class="service_charge_button" >
                                    <b>Charges</b>
                                </div>
                            </div>
                            <div class="col-md-1 add_more_plus">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div> -->

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
    <div class="row">
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="customer_name" id="customer_name" value="" placeholder="Search customer by name or phone" style="margin-left: 0px;">
        </div>
        <div class="customer_info_search" style="display: none;">
        </div>
        <div class="col-md-6 rr_bb_aa_box">
            <input type="hidden" name="count_revenue" id="count_revenue" value="0">
        </div>
    </div>


    <div class="x_panel">
        <div class="x_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 cc_date_btn">
                        <button id="past_btn" onclick="get_this_date_booking(),show_past_day()"><i class="fa-solid fa-arrow-left"></i></button>
                        <button id="next_btn" onclick="get_this_date_booking(),show_next_day()"><i class="fa-solid fa-arrow-right"></i></button>
                        <button onclick="showcurrent_day()">Today</button>
                    </div>
                    <div class="col-md-6 currentDate_selected_day_content">
                        <div class="currentDate_php"><?php $currentDate = date("F j, Y"); echo $currentDate; ?></div>
                        <input type="hidden" id="current_date" value="<?php $currentDate = date("j");echo $currentDate; ?>">
                        <input type="hidden" id="dummy_min" value="">
                    </div>
                    <div class="col-md-3 cc_date_btn">
                        <button id="btn_day" onclick="showcurrent_day()" style="background-color: black;">Day</button>
                        <button id="btn_week" onclick="showcurrent_week()">Week</button>
                        <button id="btn_month" onclick="showcurrent_month()">Month</button>
                        <input type="hidden" id="calender_status" value="1">
                        <input type="hidden" id="month_status" value="0">
                        <input type="hidden" id="week_status" value="0">
                    </div>
                </div>

                <div class="row cc_bb_today" style="border: 1px solid #ccc;">
                    <div class="col-md-12 currentDate_week_name">
                        <div class="cc_bb_time_title">Time</div>
                        <?php if (!empty($salon_employee_list)) {
                            $i = 1;
                            foreach ($salon_employee_list as $salon_employee_list_result) {
                        ?>
                                <div class="emp_name_content"><?= $salon_employee_list_result->full_name ?></div>
                                <!-- <div class="stylist_revenue_box" id="stylist_revenue_box_<?= $salon_employee_list_result->id ?>"></div> -->
                        <?php }
                        } ?>
                    </div>
                    <div class="col-md-12 time_slot_and_detail">

                    </div>
                </div>

                <div class="row cc_bb_week_name" style="border: 1px solid #ccc;display:none">
                    <div class="current_week_name">
                        <div class="">Time</div>
                    </div>
                </div>

                <div class="row cc_bb_week_detail" style="border: 1px solid #ccc;display:none">
              
                </div>


                <div class="row cc_bb_month_name" style="border: 1px solid #ccc;display:none">

                </div>
                <div class="row cc_bb_month_detail" style="border: 1px solid #ccc;display:none">

                </div>

            </div>
        </div>
    </div>


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

<?php include('footer.php'); ?>

<script src="<?= base_url() ?>admin_assets/js/booking_calender.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>


<script>
    $(document).ready(function() {
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



<!-- show booking details -->

<script>
    function showbookingdetails(tbl_id,stylist_id, customer_id) {
        // alert(tbl_id);
        $('#customer_id').val(customer_id);
        $('.customer_info_search').hide();
        $('#table_id').val(tbl_id);
        $('.c_ss_date_time').empty();
        $('#reshedule_model').show();
        $('#booking_data_table_row').empty()
        var product_data = <?php echo json_encode($product_list) ?>;
        var product_l = product_data.length
        var booking_data = <?php echo json_encode($booking_list) ?>;
        var customer_l = booking_data.length;
        for (var i = 0; i < customer_l; i++) {
            if (customer_id == booking_data[i].customer_name) {
                $('.stylist_name_id').text(booking_data[i].full_name + '(' + booking_data[i].customer_phone + ')');
                $('#c_name').val(booking_data[i].full_name);
                $('#c_email').val(booking_data[i].email);
                $('#c_phone').val(booking_data[i].customer_phone);
                $('#booking_data_table_row').append('<tr>\
                                                    <td id="services_col' + booking_data[i].id + '"></td>\
                                                    <td>' + booking_data[i].employee_name + '</td>\
                                                    <td>' + booking_data[i].time_slot + '</td>\
                                                    <td>' + booking_data[i].service_price + '</td>\
                                                    <td style="color: red;align-item: center;"><i onclick="opencancelbooking_model(' + booking_data[i].id + ')" class="fa-solid fa-xmark" style="font-size: 21px;"></i>\</td>\
                                                </tr>');
        
                $('.c_ss_date_time').append('<div class="col-md-12 ss_tt_row"><h4 id="services_name_' + booking_data[i].id + '"></h4></div>\
                                                       <div class="form-group col-md-3 col-xs-12 cc-details-input">\
                                                       <label>Booking Date<b class="require">*</b></label>\
                                                            <input type="text" class="b_date form-control" name="booking_date" id="b_date_' + booking_data[i].id + '" value="' + booking_data[i].booking_date + '">\
                                                        </div>\
                                                        <div class="form-group col-md-3 col-xs-12 cc-details-input">\
                                                        <label>Time<b class="require">*</b></label>\
                                                           <input onclick="open_time_booking_box(' + booking_data[i].id + ','+ booking_data[i].services +')" type="text" class="form-control" name="time_slot" id="b_time_' + booking_data[i].id + '" value="' + booking_data[i].time_slot + '">\
                                                        </div>\
                                                        <div class="tt_ss_content_box"></div>\
                                                        <div class="form-group col-md-3 col-xs-12 cc-details-input">\
                                                        <label>Stylist<b class="require">*</b></label>\
                                                        <select class="form-control form-select" name="stylist" id="stylist_' + booking_data[i].id + '" >\
                                                            <option value="' + booking_data[i].stylist + '">' + booking_data[i].employee_name + '</option>\
                                                        </select>\
                                                        </div>\
                                                        <div class="form-group col-md-3 col-xs-12 cc-details-input">\
                                                        <label>Status<b class="require">*</b></label>\
                                                            <input readonly type="text" class="form-control" name="c_phone" id="b_status" value="Confirmed">\
                                                        </div>\
                                                        <div class="form-group col-md-3 col-xs-12" style="padding: 0px 0px 0px 0px;">\
                                                            <button type="text" class="btn btn-primary" onclick="reschedule_booking(' + booking_data[i].id + ')">Reshedule</button>\
                                                        </div>');
                open_time_booking_box(booking_data[i].id,booking_data[i].services)
                $('.tt_ss_content_box').hide();
                makebookingpayment(booking_data[i].service_price, stylist_id, booking_data[i].services, customer_id, )
                // showbookingproductname(booking_data[i].products_id,booking_data[i].id);
                // <td id="product_col'+booking_data[i].id+'"></td>
                showbookingservicesname(booking_data[i].services, booking_data[i].id);
        $('#b_date_'+booking_data[i].id+'').datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "30",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
            }
        }
    }
</script>

<!-- perticular employee revenue and booking -->

<!-- <script>
    function get_stylist_revenue(emp_id) {
        var booking_data = <?php echo json_encode($booking_list) ?>;
        var booking_length = booking_data.length;
        var booking_count=0;
        for (var a = 0; a < booking_length; a++) {
            alert(booking_data[a].stylist);
            if(booking_data[a].stylist == emp_id){
                booking_count++;
                var cc_revenue = parseInt($("#count_revenue").val());
                $("#count_revenue").val(parseFloat(cc_revenue) + parseFloat(booking_data[a].amount_to_paid));
                var total_revenue = parseFloat($("#count_revenue").val());

               
                var totalMinutes=$('#dummy_min').val();
                var tt_mm=totalMinutes-duration;
                var result=convertMinutesToHoursAndMinutes(tt_mm);

                $('#stylist_revenue_box_'+emp_id+'').html(' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+ emp_id +'</div>\
                                                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Today booking <br><span>'+ booking_count +'</span></div>\
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Todaty Revenue <br><span>'+ total_revenue +'</span></div>\
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> Available Time Left <br><span> ' + result.hours + ' hrs ' + result.minutes + 'mns</span></div>');
            }
        }
        $('#stylist_revenue_box_'+emp_id+'').toggle();
    } 
</script> -->

<script>
    function open_time_booking_box(tbl_id,service_id){
        $('.tt_ss_content_box').empty();
        $('.tt_ss_content_box').toggle();
        var selected_time=$('#b_time_'+ tbl_id +'').val();
        var rules_data = <?php echo json_encode($single_rules) ?>;
        var startTime = parseInt(rules_data.salon_start_time);
        var endTime = parseInt(rules_data.salon_end_time);
        var duration = parseInt(rules_data.session_avg_duration);


        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        hours = (hours < 10) ? "0" + hours : hours;
        minutes = (minutes < 10) ? "0" + minutes : minutes;
        var formattedTime = hours + ":" + minutes;

        for (var hour = startTime; hour < endTime; hour++) {
            for (var minute = 0; minute < 60; minute += duration) {

                var formattedHour = ('0' + hour).slice(-2);
                var formattedMinute = ('0' + minute).slice(-2);
                var time = formattedHour + ':' + formattedMinute;
                if(formattedTime < time){
                    if(selected_time == time){
                        $('.tt_ss_content_box').append('<div class="time_slot_bb slot_time_disabled">'+ time +'</div>');
                        $('.tt_ss_content_content').append('<div class="time_slot_bb">'+ time +'</div>');
                    }else{
                        $('.tt_ss_content_box').append('<div class="time_slot_bb" onclick="show_time_slot_on_feild(\'' + time + '\',' + tbl_id + ','+ service_id +')" >'+ time +'</div>');
                        $('.tt_ss_content_content').append('<div class="time_slot_bb" onclick="get_stylist_by_datetime(\'' + time + '\')" >'+ time +'</div>');
                    }
                }
            }
        }
        $('.tt_ss_content_box').append('<div class="col-md-12 btn btn-danger" onclick="close_time_slot_model()">Close</div>');
        $('.tt_ss_content_content').append('<div class="col-md-12 btn btn-danger" onclick="close_time_slot_model()">Close</div>');
    }
</script>

<script>
    function close_time_slot_model() {
        $('.tt_ss_content_box').hide();
        $('.tt_ss_content_content').hide();
    }
    function show_time_slot_on_feild(selected_time_slot,tbl_id,service_id) {
            $('#stylist_'+tbl_id+'').empty();
            $('#stylist_'+tbl_id+'').append('<option value="">Select Stylist</option>');
            $('#b_time_'+ tbl_id +'').val(selected_time_slot);
            var emp_data = <?php echo json_encode($salon_employee_list) ?>;
            var shift_data = <?php echo json_encode($shift_list) ?>;
            var booking_data = <?php echo json_encode($booking_list) ?>;
            var booking_length = booking_data.length;
            var shift_length = shift_data.length;
            var emp_length = emp_data.length;

            for (var i = 0; i < shift_length; i++) {
                if((shift_data[i].shift_in_time < selected_time_slot) && (shift_data[i].shift_out_time > selected_time_slot)){
                    var shift_id=shift_data[i].id;
                }
            }

            for (var a = 0; a < emp_length; a++) {
                var emp_s_l=emp_data[a].service_name.length;
                for (var b = 0; b < emp_s_l; b++) {
                    if(emp_data[a].service_name[b] !==','){
                        if(emp_data[a].service_name[b] == service_id){
                            if(emp_data[a].shift_name == shift_id){
                              $('#stylist_'+tbl_id+'').append('<option value="'+ emp_data[a].id +'">'+ emp_data[a].full_name +'</option>');
                            }
                        }

                    }
                }
            }
            $('.tt_ss_content_box').hide();
        }
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
function open_stylist_by_datetime() {
    $('.tt_ss_content_content').toggle();
}
function get_stylist_by_datetime(time) {
    $('#stylist').empty();
    $("#new_time_slot").val(time)
    $("#booking_date").val($('#dummy_t_date').val())
    var service_id=$("#services").val()
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_by_time_and_date_ajax",
                            data: {
                                'date': $('#dummy_t_date').val(),
                                'time': time
                            },
                            success: function(data) {
                                var parsedData = JSON.parse(data);
                                if (parsedData.length === 0) {
                                    $('#stylist').append('<option>Select stylist</option>');
                                    var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                                    var emp_length = emp_data.length;
                                    var shift_data = <?php echo json_encode($shift_list) ?>;
                                    var shift_length = shift_data.length;

                                    for (var k = 0; k < emp_length; k++) {
                                    
                                        var emp_service_l = emp_data[k].service_name.length;
                                        var service_emp_id = emp_data[k].service_name;
                                        var emp_shift_id = emp_data[k].shift_name;
                                        for (var n = 0; n < emp_service_l; n++) {
                                            if (service_emp_id[n] !== ',') {
                                                if (service_id == service_emp_id[n]) {
                                                    for (var b = 0; b < shift_length; b++) {
                                                        if ((shift_data[b].shift_in_time <= time) && (shift_data[b].shift_out_time >= time)) {
                                                            if (shift_data[b].id == emp_data[k].shift_name) {
                                                                $('#stylist').append('<option value="'+ emp_data[k].id +'">'+ emp_data[k].full_name +'</option>')  
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } 
                                else {
                                    if (parsedData.length > 0) { 
                                        parsedData.forEach(function(record) {
                                            var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                                            var emp_length = emp_data.length;
                                            var shift_data = <?php echo json_encode($shift_list) ?>;
                                            var shift_length = shift_data.length;
                                            for (var i = 0; i < shift_length; i++) {
                                                if((shift_data[i].shift_in_time < selected_time_slot) && (shift_data[i].shift_out_time > selected_time_slot)){
                                                    var shift_id=shift_data[i].id;
                                                }
                                            }
                                            for (var k = 0; k < emp_length; k++) {
                                            
                                                if(record.time_slot == time){
                                                var book_stylist_id=record.stylist;
                                                }
                                                var emp_service_l = emp_data[k].service_name.length;
                                                var service_emp_id = emp_data[k].service_name;
                                                var emp_shift_id = emp_data[k].shift_name;

                                                for (var n = 0; n < emp_service_l; n++) {
                                                    if (service_emp_id[n] !== ',') {
                                                        if (service_id == service_emp_id[n]) {
                                                            if (shift_id == emp_data[k].shift_name) {
                                                                if(emp_data[k].id !== book_stylist_id){ 
                                                                $('#stylist').append('<option value="'+ emp_data[k].id +'">'+ emp_data[k].full_name +'</option>')  
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        });
                        $('.tt_ss_content_content').hide();
    }
</script>

<!-- opencancelbooking_model -->

<script>
    function opencancelbooking_model(tbl_id) {
        $("#cancel_bokking_model").show();
        $("#tbl_id").val(tbl_id);
    }

    function closecancelbooking_model() {
        $("#cancel_bokking_model").hide();
    }
</script>

<script type="text/javascript">
   $("#stylist").change(function () {
        alert();
    });
        function get_calculate_gst_amount() {
            var price=$("#payble_price").val();
            var store_data = <?php echo json_encode($store_profile) ?>;
            if (store_data.gst == 1) {

                var gst_dd = (parseFloat(price) * (1 - 18 / 100).toFixed(2));
                // $('#service_gst_amount').val(parseFloat(price - gst_dd).toFixed(2));
                var aaa = (parseFloat(price - gst_dd).toFixed(2));
                var pppp = parseFloat(price) + parseFloat(aaa);
                $('#gst_amount').val(parseFloat(price - gst_dd).toFixed(2));
                $('#amount_to_paid').val(pppp.toFixed(2));
            }
        }
</script>


<script type="text/javascript">
    $("#services").change(function () {
        $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_service_info_details_ajax",
        data: {
            'service_name_id': $('#services').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            $("#payble_price").val(parseFloat(parsedData.final_price));
        },
    });
});
</script>

    <!-- calculate Gst amount -->


 <!-- Selected Date get  offer duration -->

 <script>
        function  check_gift_card(book_date,total_amount) {
            var offers_data = <?php echo json_encode($offers_list) ?>;
            var offer_length = offers_data.length;

            for (var i = 0; i < offer_length; i++) {
                var dateString = offers_data[i].created_on;
                var offer_end = offers_data[i].duration;
                var offer_end_number = offer_end * 7;

                var end_date = new Date(dateString);
                end_date.setDate(end_date.getDate() + offer_end_number);
                var end = formatDate(end_date);

                var start_date = new Date(dateString);
                var start = formatDate(start_date);

                if ((book_date >= start) && (book_date <= end)) {
                    if (offers_data[i].discount_in == 0) {
                        ff_amount = total_amount - offers_data[i].discount;
                        $("#payble_price").val(parseFloat(ff_amount));
                        get_calculate_gst_amount(ff_amount);
                    } else {
                        ff_amount = total_amount - (total_amount * (offers_data[i].discount / 100));
                        $("#payble_price").val(parseFloat(ff_amount));
                        get_calculate_gst_amount(ff_amount);
                    }
                } 
            }
        }

        function formatDate(date) {
            if (!(date instanceof Date) || isNaN(date)) {
                console.error('Invalid date:', date);
                return 'Invalid Date';
            }
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            if (day < 10) {
                day = '0' + day;
            }

            if (month < 10) {
                month = '0' + month;
            }

            return day + '/' + month + '/' + year;
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

<!-- showcurrent_month -->

<script>
    function showcurrent_month() {

        $('.cc_bb_week_name').hide();
        $('.cc_bb_week_detail').hide();
        $('.cc_bb_today').hide();
        $('.cc_bb_month_name').show();
        $('.cc_bb_month_detail').show();
        $('.cc_bb_month_detail').empty();
        $('#btn_day').css('background-color', '#2c3e50');
        $('#btn_week').css('background-color', '#2c3e50');
        $('#btn_month').css('background-color', 'black');
        $('#calender_status').val(30);


        var currentDate = new Date();
        var opt = {
            month: 'long',
            year: 'numeric'
        };
        var formattedDate = currentDate.toLocaleDateString('en-US', opt);
        $('.currentDate_php').text(formattedDate);

        var currentDate = new Date();
        var opt = {
            month: 'numeric',
            day: 'numeric',
            year: 'numeric'
        };
        var todaydate = currentDate.toLocaleDateString('en-US', opt);

        var currentDate = new Date();
        currentDate.setDate(1);
        var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        var lastDayOfMonth = lastDay.getDate();

        get_all_week_day_name_for_month(currentDate, lastDay, todaydate);

        $('.cc_bb_month_detail').append('<div class="current_month_date_detail" onclick="get_selected_date_booking(' + lastDayOfMonth + ')">\
                                            <div>' + lastDayOfMonth + '</div>\
                                        </div>');

    }
</script>

<!-- get_all_week_day_name_for_month -->

<script>
    function get_all_week_day_name_for_month(currentDate, lastDay, todaydate) {
        $('.cc_bb_month_name').empty();

        var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        for (var i = 0; i < daysOfWeek.length; i++) {

            $('.cc_bb_month_name').append('<div class="current_week_name_for_month">\
                                            <div class="">' + daysOfWeek[i] + '</div>\
                                            </div>');
        }

        while (currentDate <= lastDay) {
            var options = {
                day: 'numeric'
            };
            var active_date = {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric'
            };
            var opt_week = {
                weekday: 'long'
            };
            var format_active = currentDate.toLocaleDateString('en-US', active_date);
            var formattedDay = currentDate.toLocaleDateString('en-US', options);
            var format_week = currentDate.toLocaleDateString('en-US', opt_week);
            var week_index = count_week_index(format_week);
            for (var j = 0; j < daysOfWeek.length; j++) {
                if (week_index == j) {
                    if (todaydate !== format_active) {

                        $('.cc_bb_month_detail').append('<div class="current_month_date_detail" onclick="get_selected_date_booking(' + formattedDay + ')">\
                                                        <div class="">' + formattedDay + '</div>\
                                                    </div>');
                        break;
                    } else {
                        $('.cc_bb_month_detail').append('<div onclick="get_selected_date_booking()" class="current_month_date_detail" style="background-color: #fffadf;color: black;">\
                                                        <div>' + formattedDay + '</div>\
                                                        </div>');
                        break;

                    }
                } else if (formattedDay == 1 && formattedDay) {
                    $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                                        <div>------</div>\
                                                        </div>');

                }
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }
    }
</script>


<!-- get_selected_date_booking -->

<script>
    function get_selected_date_booking(date) {
        var f_date = $('.currentDate_php').text();
        $('#calender_status').val(1);
        $('#current_date').val(date);
        var dateString = date + ' ' + f_date;
        $('.currentDate_php').text(dateString);
        get_this_date_booking()
    }
</script>

<script>
   (function() {
      var dragged, listener;

      console.clear();

      dragged = null;

      listener = document.addEventListener;

      listener("dragstart", (event) => {
        console.log("start !");
        return dragged = event.target;
      });

      listener("dragend", (event) => {
        return console.log("end !");
      });

      listener("dragover", function(event) {
        return event.preventDefault();
      });

      listener("drop", (event) => {
        console.log("drop !");
        event.preventDefault();
        if (event.target.className === "dropzone") {
          dragged.parentNode.removeChild(dragged);
          return event.target.appendChild(dragged);
        }
      });

    }).call(this);
</script>

<!-- $(window).on('load', function() -->

<script>
    $(window).on('load', function() {
        get_this_date_booking();
    });

    function get_this_date_booking() {
       console.log("hi");
        // alert();
        $('.cc_bb_week_name').fadeOut();
        $('.cc_bb_week_detail').fadeOut();
        $('.cc_bb_month_name').fadeOut();
        $('.cc_bb_month_detail').fadeOut();
        $('.cc_bb_today').fadeIn();
        // $('.cc_bb_detail').empty();
        $('.time_slot_and_detail').empty();
        $('.revenue_count_number').empty();
        var selected_date = $('.currentDate_php').text();
        var converted_date = new Date(selected_date);
        if (!isNaN(converted_date.getTime())) {
            
            var formatted_date = ('0' + converted_date.getDate()).slice(-2) + '/' + ('0' + (converted_date.getMonth() + 1)).slice(-2) + '/' + converted_date.getFullYear();

            var rules_data = <?php echo json_encode($single_rules) ?>;
            if (rules_data.length !== 0) {
                var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                var booking_data = <?php echo json_encode($booking_list) ?>;
                var color_data = <?php echo json_encode($color_list) ?>;
                var color_length = color_data.length;
                var booking_length = booking_data.length;
                var emp_length = emp_data.length;
                var startTime = parseInt(rules_data.salon_start_time);
                var endTime = parseInt(rules_data.salon_end_time);
                var duration = parseInt(rules_data.session_avg_duration);
                var openingMinutes = convertToMinutes(rules_data.salon_start_time);
                var closingMinutes = convertToMinutes(rules_data.salon_end_time);
                var totalMinutes = closingMinutes - openingMinutes;
                $('#dummy_min').val(totalMinutes);
                var totalMinutesOpen = totalMinutes * emp_length;
                var booking_count = 0;
                // alert(endTime);
                for (var hour = startTime; hour < endTime; hour++) {
                    // alert(hour);
                    for (var minute = 0; minute < 60; minute += duration) {

                        var formattedHour = ('0' + hour).slice(-2);
                        var formattedMinute = ('0' + minute).slice(-2);
                        var time = formattedHour + ':' + formattedMinute;

                        var sub_min = minute + duration;
                        var f_sub_hour = ('0' + hour).slice(-2);
                        var f_sub_min = ('0' + sub_min).slice(-2);
                        var sub_time = f_sub_hour + ':' + f_sub_min;
                        var booked = 0;
                        // alert(minute);
                        for (var a = 0; a < booking_length; a++) {
                            if ((booking_data[a].time_slot == time) && (booking_data[a].booking_date == formatted_date)) {
                                booking_count++;
                                $('.time_slot_and_detail').append('<div class="cc_timeslot">' + time + '</div>');
                                for (var j = 0; j < emp_length; j++) {
                                    if (emp_data[j].id == booking_data[a].stylist) {
                                        for (var k = 0; k < color_length; k++) {
                                            if (color_data[k].id == booking_data[a].booking_status) {
                                                var cc_revenue = parseInt($("#count_revenue").val());
                                                $("#count_revenue").val(parseFloat(cc_revenue) + parseFloat(booking_data[a].amount_to_paid));

                                                $('.time_slot_and_detail').append('<div class="col-md-1 cc_bb_detail_booked" style="color: white;background-color: ' + color_data[k].status_color + ';" data-popup-open="popup-0">\
                                                                                            <ul class="booking_list_ui"  draggable="true">\
                                                                                            <li class="bb_ll_client">' + booking_data[a].full_name + '</li>\
                                                                                            <li class="bb_ll_ss_name">' + booking_data[a].service_name + ' | ' + booking_data[a].service_name_marathi + '</li>\
                                                                                            <li>' + booking_data[a].employee_name + '</li>\
                                                                                            <li>' + time + ' <i class="fa-solid fa-arrow-right"></i> ' + sub_time + ' </li>\
                                                                                            </ul>\
                                                                                            <ul class="booking_list_amount_ui" style="background-color: ' + color_data[k].status_color + ';">\
                                                                                                <li>Total Amount <i class="fa-solid fa-indian-rupee-sign"></i> ' + booking_data[a].payble_price + '</li>\
                                                                                                <li>Discount <i class="fa-solid fa-indian-rupee-sign"></i>30</li>\
                                                                                                <li>Due <i class="fa-solid fa-indian-rupee-sign"></i> ' + booking_data[a].amount_to_paid + '</li>\
                                                                                                <li class="bb_ll_status">\
                                                                                                <i class="fa-solid fa-phone"></i>\
                                                                                                <i onclick="opencancelbooking_model(' + booking_data[a].id + ')" class="fa-solid fa-xmark" style="font-size: 21px;"></i>\
                                                                                                <i onclick="openbookingpayment()" class="fa-solid fa-file-invoice-dollar"></i>\
                                                                                                <i class="fa-regular fa-clipboard"></i>\
                                                                                                <i onclick="showbookingdetails(' + booking_data[a].id + ',' + booking_data[a].stylist + ','+booking_data[a].customer_name+')" class="fa-solid fa-pencil"></i>\
                                                                                                </li>\
                                                                                        </ul>\
                                                                                        </div>');
                                            }
                                        }
                                    } else {
                                        $('.time_slot_and_detail').append('<a href="' + '<?php echo base_url("add-new-booking?staff_id="); ?>' + booking_data[a].id + '&Time=' + time + '"><div class="col-md-1 cc_bb_detail"> <ul class="dropzone"><li></li></ul></div></a>');

                                    }
                                }
                                booked = 1;
                                var count_left_time = totalMinutesOpen - duration;
                            }
                        }
                        if (booked == 0) {
                            $('.time_slot_and_detail').append('<div class="cc_timeslot">' + time + '</div>');
                            for (var b = 0; b < emp_length; b++) {
                                $('.time_slot_and_detail').append('<a href="' + '<?php echo base_url("add-new-booking?staff_id="); ?>' + emp_data[b].id + '&Time=' + time + '"><div class="col-md-1 cc_bb_detail"><ul class="dropzone"><li></li></ul></div></a>');
                            }
                        }
                    }
                }
                if(booking_count == 0){
                    var count_result = convertMinutesToHoursAndMinutes(totalMinutesOpen, emp_length);
                    $('.rr_bb_aa_box').html(' <div class="boking_list_count">Today booking <br><span>0 Booking</span></div>\
                                                                        <div class="revenue_count_number">Todaty Revenue <br><span>0,00</span></div>\
                                                                        <div class="avialable_time_left"> Available Time Left <br><span> ' + count_result.hours + ' hrs ' + count_result.minutes + 'mns</span></div>');
                }
                else{
                    var count_result = convertMinutesToHoursAndMinutes(count_left_time, emp_length);
                    var total_revenue = parseFloat($("#count_revenue").val());
                    $('.rr_bb_aa_box').html(' <div class="boking_list_count">Today booking <br><span>' + booking_count + ' Booking</span></div>\
                                                                        <div class="revenue_count_number">Todaty Revenue <br><span>' + total_revenue + '</span></div>\
                                                                        <div class="avialable_time_left"> Available Time Left <br><span> ' + count_result.hours + ' hrs ' + count_result.minutes + 'mns</span></div>');
                }                                                        
            }                                                        

        }
    }
</script>


<script>
    function convertToMinutes(timeString) {
        var parts = timeString.split(":");
        var hours = parseInt(parts[0], 10);
        var minutes = parseInt(parts[1], 10);
        return hours * 60 + minutes;
    }

    function convertMinutesToHoursAndMinutes(totalMinutes, emp_length) {

        var hours = Math.floor(totalMinutes / 60);
        var minutes = totalMinutes % 60;

        return {
            hours: hours,
            minutes: minutes
        };
    }
</script>

<!-- show booking product name -->

<!-- <script>
    function showbookingproductname(products_id,b_id){
        var product_data = <?php echo json_encode($product_list) ?>;
        var product_l = product_data.length
        
                var pp_ll=products_id.length;
                for(var k=0;k<pp_ll;k++){
                    if(products_id[k] !== ','){
                        for(var j=0;j<product_l;j++){
                            if(product_data[j].id == products_id[k]){
                              $('#product_col'+ b_id+'').append(product_data[j].product_name+',<br>');
                            }
                        }
                    }
                }
            }
</script> -->

<!-- show booking services name -->

<script>
    function showbookingservicesname(services_id, b_id) {
        var service_data = <?php echo json_encode($service_list) ?>;
        var service_l = service_data.length

        var ss_ll = services_id.length;
        for (var k = 0; k < ss_ll; k++) {
            if (services_id[k] !== ',') {
                for (var j = 0; j < service_l; j++) {
                    if (service_data[j].id == services_id[k]) {
                        $('#services_col' + b_id + '').append(service_data[j].service_name);
                        $('#services_name_' + b_id + '').text(service_data[j].service_name);
                    }
                }
            }
        }
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
</script>

<script>
    var options = {
        series: [44, 55, 13, 43, 22],
        chart: {
            width: 450,
            type: 'pie',
        },
        labels: ['Today’s Booking', 'Today’s Cancelled Booking', 'Today’s Completed Booking', 'Today’s Offline Booking', 'Today’s All Booking'],
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
        // $('#dashboard .child_menu').show();
        $('#dashboard').addClass('nv active');
        // $('.right_col').addClass('active_right');

    });
</script>

<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                timeZone: 'UTC', // Set your desired timezone here, e.g., 'America/New_York'
            });
            calendar.render();
        });
    </script> -->

<!-- get staff button -->

<script>
    $("#get_staff").click(function() {
        var emp_data = <?php echo json_encode($salon_employee_list) ?>;
        var emp_length = emp_data.length;
        $('.stylist_list_box').empty();
        $('.stylist_list_box').toggle();
        for (var i = 0; i < emp_length; i++) {
            $('.stylist_list_box').append('<div id="staff_name_box' + emp_data[i].id + '" class="staff_name_box" onclick="get_name_in_feild(' + emp_data[i].id + ')">' + emp_data[i].full_name + '</div>');
        }
    });
</script>

<!-- get_name_in_feild -->

<script>
    function get_name_in_feild(emp_id) {
        var emp_data = <?php echo json_encode($salon_employee_list) ?>;
        var emp_length = emp_data.length;
        for (var i = 0; i < emp_length; i++) {
            if (emp_id == emp_data[i].id) {
                $('#get_staff').html(emp_data[i].full_name);
                $('#staff_name_box' + emp_id).css('background-color', 'blue');
            }
        }
        $('.stylist_list_box').hide();
    }
</script>

<!-- open popup and close -->

<script>
    $(function() {
        // Open
        $('[data-popup-open]').on('click', function(e) {
            var targeted_popup_class = $(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
            e.preventDefault();
        });

        // Close
        $('[data-popup-close]').on('click', function(e) {
            var targeted_popup_class = $(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
            e.preventDefault();
        });

    });
</script>


<script>
    $(document).ready(function() {
        // $('.customer_info_search').empty();
        $("#customer_name").keyup(function() {
            var c_name = $("#customer_name").val();
            if (c_name == "") {
                $('.customer_info_search').hide();
            }
            var selected_date = $('.currentDate_php').text();
            var converted_date = new Date(selected_date);
            if (!isNaN(converted_date.getTime())) {
                var formatted_date = ('0' + converted_date.getDate()).slice(-2) + '/' + ('0' + (converted_date.getMonth() + 1)).slice(-2) + '/' + converted_date.getFullYear();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_all_booking_list_for_selecteddate_ajax",
                    data: {
                        'booking_date': formatted_date,
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                $('.customer_info_search').empty();
                                console.log(record);
                                var c_name_words = c_name.toLowerCase().split(' ');
                                var record_name_words = record.full_name.toLowerCase().split(' ');
                                if (c_name_words.every(word => record_name_words.includes(word)) || (c_name == record.customer_phone)) {
                                    $('.customer_info_search').show();
                                    $('.customer_info_search').append('<ul class="c_info_ui">\
                                                                            <li>\
                                                                                <ul class="c_info_ui_content">\
                                                                                    <li>Cutomer<br><span>' + record.full_name + '</span></li>\
                                                                                    <li>ID<br><span>' + record.id + '</span></li>\
                                                                                    <li>Time<br><span>' + record.time_slot + '</span></li>\
                                                                                    <li>Amount<br><span>' + record.payble_price + '</span></li> \
                                                                                    <li>Status<br><span>Confirmed</span></li> \
                                                                                </ul>\
                                                                            </li>\
                                                                            <li class="ui_btn">' + record.service_name + '|' + record.service_name_marathi + '</li>\
                                                                            <li class="staff_name">\
                                                                            stylist: <span>' + record.employee_name + '</span>\
                                                                            </li>\
                                                                            <li style="margin-top: 10px;">\
                                                                                <div onclick="showbookingdetails(' + record.stylist + ', \'' + record.customer_name + '\')" class="btn btn-primary">Details</div>\
                                                                                <div class="btn btn-danger" onclick="close_customer_info_box()">Close</div>\
                                                                            </li>\
                                                                        </ul>');
                                }
                            });
                        }
                    }
                });
            }
        });
    });

    function close_customer_info_box() {
        $('.customer_info_search').hide();
    }

</script>
<?php include('header.php'); ?>
<link href="<?=base_url();?>assets/css/jquery.timepicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/jquery.timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
<style type="text/css">
    .handle {
        cursor: move;
    }
    .toggle {
        position: relative;
        margin-top: 8px;
    }
    .toggle:before {
        content: '';
        position: absolute;
        border-bottom: 3px solid #fff;
        border-right: 3px solid #fff;
        width: 6px;
        height: 14px;
        /* z-index: 2; */
        transform: rotate(45deg);
        top: 6px;
        left: 15px;
    }
    .toggle:after {
        /* content: '×'; */
        position: absolute;
        top: 0;
        left: 46px;
        z-index: 2;
        line-height: 30px;
        font-size: 26px;
        color: #aaa;
    }
    .toggle input[type="checkbox"] {
        position: absolute;
        left: 0;
        top: 0;
        z-index: 10;
        width: 100%;
        height: 100%;
        cursor: pointer;
        opacity: 0;
    }
    .toggle label {
    position: relative;
    display: flex;
    align-items: center;
    }
    .toggle label:before {
        content: '';
        width: 35px;
        height: 20px;
        box-shadow: 0 0 1px 2px #0001;
        background: #eee;
        position: relative;
        display: inline-block;
        border-radius: 46px;
        transition: 0.2s ease-in;
    }
    .toggle label:after {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        left: 0;
        top: 1px;
        z-index: 5;
        background: #fff;
        box-shadow: 0 0 5px #0002;
        transition: 0.2s ease-in;
    }
    .toggle input[type="checkbox"]:hover + label:after {
    box-shadow: 0 2px 15px 0 #0002, 0 3px 8px 0 #0001;
    }
    .toggle input[type="checkbox"]:checked + label:before {
        transition: 0.1s 0.2s ease-in;
        background: #4BD865;
    }
    .toggle input[type="checkbox"]:checked + label:after {
        left: 15px;
    }
    .combo-arrow{
        content: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" height="5" width="5" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="%23000000" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>');
        padding: 5px;
    }
    .time_row{
        padding: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* border: 1px solid #ededed; */
        background: #fff;
        margin-bottom:8px;
    }

    .time_row .div_2 p{
        margin:0px;
    }
    .time_row .div_1{
        width: 10%;
    }
    .time_row .div_2{
        width: 15%;
        text-align: left;
    }
    .error {
        color: red;
        float: left;
    }
    .modal-header .close{
        position: absolute;
        right: 15px;
        top: 15px;
    }
    .modal-dialog{
        width: 850px;
    }
    .dataTables_paginate{
        float:none;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
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
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Working Hours
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container">
            <div id="exTab2" class="container">	
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if(!isset($_GET['active'])){ if($this->uri->segment(3) == ""){?>active<?php }}?>" id="tab_1">
                        <a  href="#1" data-toggle="tab">Salon Working Hours</a>
                    </li>
                    <li id="tab_2" class="<?php if(!isset($_GET['active'])){ if($this->uri->segment(3) != ""){?>active<?php }}?>">
                        <a href="#2" data-toggle="tab">Shift Managment</a>
                    </li>
                    <li id="tab_3" class="<?php if(isset($_GET['active']) && $_GET['active'] == 'regular_shift_list'){?>active<?php }?>">
                        <a href="#3" data-toggle="tab">Regular Shifts</a>
                    </li>
                    <li id="tab_4" class="<?php if(empty(array_intersect(['rotational-shift'], $feature_slugs))) { echo 'blurred '; }?> <?php if(isset($_GET['active']) && $_GET['active'] == 'rotational_shift_list'){?>active<?php }?>">
                        <a href="#4" data-toggle="tab">Rotational Shifts</a>
                    </li>
                </ul><br>

                <div class="tab-content ">

                    <!-- salon time -->
                   
                    <div class="tab-pane <?php if(!isset($_GET['active'])){ if($this->uri->segment(3) == ""){?>active<?php }}?>" id="1">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Salon Working Hours</h3>
                                    </div>
                                    <div class="container">
                                        <form method="post" id="post_job" class="post_job">
                                            <div class="col-lg-12 filter_head">
                                                <div class="fliter_for_apply">
                                                    <div class="toggle">
                                                        <input name="all_apply" id="all_apply" type="checkbox"/>
                                                        <label></label>
                                                    </div>
                                                    <div>
                                                        <h5>Select All Days</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1" style="visibility:hidden;">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="" name="" id="" value="">
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Day</p>
                                                    </div>
                                                    <div class="div_3 show_monday_time_div">
                                                        <label for="">From Time</label>
                                                    </div>
                                                    <div class="div_4 show_monday_time_div">
                                                        <label for="">To Time</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" name="Monday" id="Monday" value="on" <?php if(!empty($single_rules) && $single_rules->is_monday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Monday</p>
                                                    </div>
                                                    <div class="div_3 show_monday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" type="text"  placeholder="Select Time" name="from_monday" id="from_monday" value="<?php if(!empty($single_rules) && $single_rules->from_monday != ""){ echo date('h:iA',strtotime($single_rules->from_monday)); }?>">
                                                        <label for="from_monday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_monday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample"  placeholder="Select Time" name="to_monday" id="to_monday" value="<?php if(!empty($single_rules) && $single_rules->to_monday != ""){ echo date('h:iA',strtotime($single_rules->to_monday)); }?>">
                                                        <label for="to_monday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" name="Tuesday" id="Tuesday" value="on" <?php if(!empty($single_rules) && $single_rules->is_tuesday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Tuesday</p>
                                                    </div>
                                                    <div class="div_3 show_tuesday_time_div" style="display:grid;">
                                                        <input autocomplete="off" readonly class="basicExample" placeholder="Select Time" name="from_tuesday" id="from_tuesday" value="<?php if(!empty($single_rules) && $single_rules->from_tuesday != ""){ echo date('h:iA',strtotime($single_rules->from_tuesday)); }?>">
                                                        <label for="from_tuesday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_tuesday_time_div" style="display:grid;">
                                                        <input autocomplete="off" readonly class="basicExample" placeholder="Select Time" name="to_tuesday" id="to_tuesday" value="<?php if(!empty($single_rules) && $single_rules->to_tuesday != ""){ echo date('h:iA',strtotime($single_rules->to_tuesday)); }?>">
                                                        <label for="to_tuesday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" name="Wednesday" id="Wednesday" value="on" <?php if(!empty($single_rules) && $single_rules->is_wednesday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Wednesday</p>
                                                    </div>
                                                    <div class="div_3 show_wednesday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="from_wednesday" id="from_wednesday" value="<?php if(!empty($single_rules) && $single_rules->from_wednesday != ""){ echo date('h:iA',strtotime($single_rules->from_wednesday)); }?>">
                                                        <label for="from_wednesday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_wednesday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="to_wednesday" id="to_wednesday" value="<?php if(!empty($single_rules) && $single_rules->to_wednesday != ""){ echo date('h:iA',strtotime($single_rules->to_wednesday)); }?>">
                                                        <label for="to_wednesday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" id="Thursday" name="Thursday" value="on" <?php if(!empty($single_rules) && $single_rules->is_thursday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Thursday</p>
                                                    </div>
                                                    <div class="div_3 show_thursday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="from_thursday" id="from_thursday" value="<?php if(!empty($single_rules) && $single_rules->from_thursday != ""){ echo date('h:iA',strtotime($single_rules->from_thursday)); }?>">
                                                        <label for="from_thursday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_thursday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="to_thursday" id="to_thursday" value="<?php if(!empty($single_rules) && $single_rules->to_thursday != ""){ echo date('h:iA',strtotime($single_rules->to_thursday)); }?>">
                                                        <label for="to_thursday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" id="Friday" name="Friday" value="on" <?php if(!empty($single_rules) && $single_rules->is_friday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Friday</p>
                                                    </div>
                                                    <div class="div_3 show_friday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="from_friday" id="from_friday" value="<?php if(!empty($single_rules) && $single_rules->from_friday != ""){ echo date('h:iA',strtotime($single_rules->from_friday)); }?>">
                                                        <label for="from_friday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_friday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="to_friday" id="to_friday" value="<?php if(!empty($single_rules) && $single_rules->to_friday != ""){ echo date('h:iA',strtotime($single_rules->to_friday)); }?>">
                                                        <label for="to_friday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" id="Saturday" name="Saturday" value="on" <?php if(!empty($single_rules) && $single_rules->is_saturday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Saturday</p>
                                                    </div>
                                                    <div class="div_3 show_saturday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="from_saturday" id="from_saturday" value="<?php if(!empty($single_rules) && $single_rules->from_saturday != ""){ echo date('h:iA',strtotime($single_rules->from_saturday)); }?>">
                                                        <label for="from_saturday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_saturday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="to_saturday" id="to_saturday" value="<?php if(!empty($single_rules) && $single_rules->to_saturday != ""){ echo date('h:iA',strtotime($single_rules->to_saturday)); }?>">
                                                        <label for="to_saturday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 time_row">
                                                    <div class="div_1">
                                                        <div class="toggle">
                                                            <input type="checkbox" class="check_box_len" id="Sunday" name="Sunday" value="on" <?php if(!empty($single_rules) && $single_rules->is_sunday == '1'){ echo 'checked'; }?>>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <div class="div_2">
                                                        <p>Sunday</p>
                                                    </div>
                                                    <div class="div_3 show_sunday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="from_sunday" id="from_sunday" value="<?php if(!empty($single_rules) && $single_rules->from_sunday != ""){ echo date('h:iA',strtotime($single_rules->from_sunday)); }?>">
                                                        <label for="from_sunday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                    <div class="div_4 show_sunday_time_div" style="display:grid;">
                                                        <input autocomplete="off" class="basicExample" readonly placeholder="Select Time" name="to_sunday" id="to_sunday" value="<?php if(!empty($single_rules) && $single_rules->to_sunday != ""){ echo date('h:iA',strtotime($single_rules->to_sunday)); }?>">
                                                        <label for="to_sunday" generated="true" class="error" style="display:none;"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-12 text-right">
                                                        <button type="submit" name="salon-time-btn" value="salon-time-btn" class="btn btn-primary" id="post_third_box">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- shift managment -->

                    <div class="tab-pane <?php if(!isset($_GET['active'])){ if($this->uri->segment(3) != ""){?>active<?php }}?>" id="2">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Add Shift Management</h3>
                                    </div>
                                    <div class="container">
                                        <?php if(!empty($single_rules) && ($single_rules->is_monday == '1' || $single_rules->is_tuesday == '1' || $single_rules->is_wednesday == '1' || $single_rules->is_thursday == '1' || $single_rules->is_friday == '1' || $single_rules->is_saturday == '1' || $single_rules->is_sunday == '1')){ ?>
                                        <form id="shift_form" name="shift_form" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Shift Name<b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="shift_name" id="shift_name" placeholder="Enter shift name" value="<?php if(!empty($single_shift)){ echo $single_shift->shift_name; }?>">
                                                    <label class="error" id="shift_name_error"></label>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Shift Type<b class="require">*</b></label>
                                                    <select class="form-control" name="shift_type" id="shift_type">
                                                        <option value="">Select Shift Type</option>
                                                        <option value="0" <?php if(!empty($single_shift) && $single_shift->shift_type == '0'){ echo 'selected'; }?>>Fixed</option>
                                                        <option value="1" <?php if(empty(array_intersect(['rotational-shift'], $feature_slugs))) { echo 'disabled '; }?> <?php if(!empty($single_shift) && $single_shift->shift_type == '1'){ echo 'selected'; }?>>Rotational <?php if(empty(array_intersect(['rotational-shift'], $feature_slugs))) { echo ' - Not Allowed'; }?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                    <table id="" class="table table-striped responsive-utilities jambo_table table_shift_add" style="width:100%;">
                                                        <thead>
                                                            <th>
                                                                <div class="fliter_for_apply">
                                                                    <div class="toggle">
                                                                        <input name="all_apply_selectbox" id="all_apply_selectbox" type="checkbox"/>
                                                                        <label></label>
                                                                    </div>
                                                                    <div>
                                                                        <h5>Apply For All</h5>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th>Day</th>
                                                            <th>Working Hrs</th>
                                                            <th>Shift From</th>
                                                            <th>Shift To</th>
                                                            <th>Break From</th>
                                                            <th>Break To</th>
                                                        </thead>
                                                        <tbody>
                                                            <input type="hidden" name="hidden_shift_id" id="hidden_shift_id" value="<?php if(!empty($single_rules) && !empty($single_shift)){ echo $single_shift->id; }?>">
                                                            <input type="hidden" name="is_monday_shift" id="is_monday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_monday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_monday == '1'){ ?>

                                                            <tr>
                                                                <th>                                                           
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="monday_shift" id="monday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_monday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Monday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_monday != "" && $single_rules->to_monday != ""){ echo date('h:i A',strtotime($single_rules->from_monday)).' To '.date('h:i A',strtotime($single_rules->to_monday)); }?></th>
                                                                <input type="hidden" name="monday_working_from" id="monday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_monday == "1"){ echo date('h:iA',strtotime($single_rules->from_monday)); }?>">
                                                                <input type="hidden" name="monday_working_to" id="monday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_monday == "1"){ echo date('h:iA',strtotime($single_rules->to_monday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="monday_shift_from" id="monday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->monday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->monday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="monday_shift_to" id="monday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->monday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->monday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="monday_break_from" id="monday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->monday_break_from != ""){ echo date('h:iA',strtotime($single_shift->monday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="monday_break_to" id="monday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->monday_break_to != ""){ echo date('h:iA',strtotime($single_shift->monday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <label class="error" id="monday_shift_error"></label>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_tuesday_shift" id="is_tuesday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_tuesday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_tuesday == '1'){ ?>
                                                            <tr>
                                                                <th>
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="tuesday_shift" id="tuesday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_tuesday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Tuesday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_tuesday != "" && $single_rules->to_tuesday != ""){ echo date('h:i A',strtotime($single_rules->from_tuesday)).' To '.date('h:i A',strtotime($single_rules->to_tuesday)); }?></th>
                                                                <input type="hidden" name="tuesday_working_from" id="tuesday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_tuesday == "1"){ echo date('h:iA',strtotime($single_rules->from_tuesday)); }?>">
                                                                <input type="hidden" name="tuesday_working_to" id="tuesday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_tuesday == "1"){ echo date('h:iA',strtotime($single_rules->to_tuesday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="tuesday_shift_from" id="tuesday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->tuesday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->tuesday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="tuesday_shift_to" id="tuesday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->tuesday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->tuesday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="tuesday_break_from" id="tuesday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->tuesday_break_from != ""){ echo date('h:iA',strtotime($single_shift->tuesday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="tuesday_break_to" id="tuesday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->tuesday_break_to != ""){ echo date('h:iA',strtotime($single_shift->tuesday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_wednesday_shift" id="is_wednesday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_wednesday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_wednesday == '1'){ ?>
                                                            <tr>
                                                            <th>
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="wednesday_shift" id="wednesday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_wednesday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Wednesday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_wednesday != "" && $single_rules->to_wednesday != ""){ echo date('h:i A',strtotime($single_rules->from_wednesday)).' To '.date('h:i A',strtotime($single_rules->to_wednesday)); }?></th>
                                                                <input type="hidden" name="wednesday_working_from" id="saturday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_wednesday == "1"){ echo date('h:iA',strtotime($single_rules->from_wednesday)); }?>">
                                                                <input type="hidden" name="wednesday_working_to" id="saturday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_wednesday == "1"){ echo date('h:iA',strtotime($single_rules->to_wednesday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="wednesday_shift_from" id="wednesday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->wednesday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->wednesday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="wednesday_shift_to" id="wednesday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->wednesday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->wednesday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="wednesday_break_from" id="wednesday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->wednesday_break_from != ""){ echo date('h:iA',strtotime($single_shift->wednesday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="wednesday_break_to" id="wednesday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->wednesday_break_to != ""){ echo date('h:iA',strtotime($single_shift->wednesday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_thursday_shift" id="is_thursday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_thursday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_thursday == '1'){ ?>
                                                            <tr>
                                                                <th>                                                                
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="thursday_shift" id="thursday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_thursday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Thursday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_thursday != "" && $single_rules->to_thursday != ""){ echo date('h:i A',strtotime($single_rules->from_thursday)).' To '.date('h:i A',strtotime($single_rules->to_thursday)); }?></th>
                                                                <input type="hidden" name="thursday_working_from" id="thursday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_thursday == "1"){ echo date('h:iA',strtotime($single_rules->from_thursday)); }?>">
                                                                <input type="hidden" name="thursday_working_to" id="thursday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_thursday == "1"){ echo date('h:iA',strtotime($single_rules->to_thursday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="thursday_shift_from" id="thursday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->thursday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->thursday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="thursday_shift_to" id="thursday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->thursday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->thursday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="thursday_break_from" id="thursday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->thursday_break_from != ""){ echo date('h:iA',strtotime($single_shift->thursday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="thursday_break_to" id="thursday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->thursday_break_to != ""){ echo date('h:iA',strtotime($single_shift->thursday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_friday_shift" id="is_friday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_friday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_friday == '1'){ ?>
                                                            <tr>
                                                                <th>
                                                                
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="friday_shift" id="friday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_friday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
        
                                                                </th>
                                                                <th>Friday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_friday != "" && $single_rules->to_friday != ""){ echo date('h:i A',strtotime($single_rules->from_friday)).' To '.date('h:i A',strtotime($single_rules->to_friday)); }?></th>
                                                                <input type="hidden" name="friday_working_from" id="friday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_friday == "1"){ echo date('h:iA',strtotime($single_rules->from_friday)); }?>">
                                                                <input type="hidden" name="friday_working_to" id="friday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_friday == "1"){ echo date('h:iA',strtotime($single_rules->to_friday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="friday_shift_from" id="friday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->friday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->friday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="friday_shift_to" id="friday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->friday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->friday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="friday_break_from" id="friday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->friday_break_from != ""){ echo date('h:iA',strtotime($single_shift->friday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="friday_break_to" id="friday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->friday_break_to != ""){ echo date('h:iA',strtotime($single_shift->friday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_saturday_shift" id="is_saturday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_saturday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_saturday == '1'){ ?>
                                                            <tr>
                                                                <th>
                                                                    
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="saturday_shift" id="saturday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_saturday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Saturday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_saturday != "" && $single_rules->to_saturday != ""){ echo date('h:i A',strtotime($single_rules->from_saturday)).' To '.date('h:i A',strtotime($single_rules->to_saturday)); }?></th>
                                                                <input type="hidden" name="saturday_working_from" id="saturday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_saturday == "1"){ echo date('h:iA',strtotime($single_rules->from_saturday)); }?>">
                                                                <input type="hidden" name="saturday_working_to" id="saturday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_saturday == "1"){ echo date('h:iA',strtotime($single_rules->to_saturday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="saturday_shift_from" id="saturday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->saturday_shift_from != ""){ echo date('h:iA',strtotime($single_shift->saturday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="saturday_shift_to" id="saturday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->saturday_shift_to != ""){ echo date('h:iA',strtotime($single_shift->saturday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="saturday_break_from" id="saturday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->saturday_break_from != ""){ echo date('h:iA',strtotime($single_shift->saturday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="saturday_break_to" id="saturday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->saturday_break_to != ""){ echo date('h:iA',strtotime($single_shift->saturday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                            <input type="hidden" name="is_sunday_shift" id="is_sunday_shift" value="<?php if(!empty($single_rules) && $single_rules->is_sunday == '1'){ echo '1'; }else{ echo '0'; }?>">
                                                            <?php if(!empty($single_rules) && $single_rules->is_sunday == '1'){ ?>
                                                            <tr>
                                                                <th>
                                                                    <div class="div_1">
                                                                        <div class="toggle">
                                                                            <input type="checkbox" class="box_length" name="sunday_shift" id="sunday_shift" value="on" <?php if(!empty($single_shift) && $single_shift->is_sunday_shift == '1'){ echo 'checked'; }?>>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th>Sunday</th>
                                                                <th><?php if(!empty($single_rules) && $single_rules->from_sunday != "" && $single_rules->to_sunday != ""){ echo date('h:i A',strtotime($single_rules->from_sunday)).' To '.date('h:i A',strtotime($single_rules->to_sunday)); }?></th>
                                                                <input type="hidden" name="sunday_working_from" id="sunday_working_from" value="<?php if(!empty($single_rules) && $single_rules->is_sunday == "1"){ echo date('h:iA',strtotime($single_rules->from_sunday)); }?>">
                                                                <input type="hidden" name="sunday_working_to" id="sunday_working_to" value="<?php if(!empty($single_rules) && $single_rules->is_sunday == "1"){ echo date('h:iA',strtotime($single_rules->to_sunday)); }?>">
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift From Time" name="sunday_shift_from" id="sunday_shift_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->sunday_shift_from != "" && $single_shift->sunday_shift_from != "05:30:00"){ echo date('h:iA',strtotime($single_shift->sunday_shift_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Shift To Time" name="sunday_shift_to" id="sunday_shift_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->sunday_shift_to != "" && $single_shift->sunday_shift_to != "05:30:00"){ echo date('h:iA',strtotime($single_shift->sunday_shift_to)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break From Time" name="sunday_break_from" id="sunday_break_from" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->sunday_break_from != "" && $single_shift->sunday_break_from != "05:30:00"){ echo date('h:iA',strtotime($single_shift->sunday_break_from)); }?>">
                                                                </th>
                                                                <th>
                                                                    <input autocomplete="off" type="text" class="basicExample" placeholder="Select Break To Time" name="sunday_break_to" id="sunday_break_to" value="<?php if(!empty($single_rules) && !empty($single_shift) && $single_shift->sunday_break_to != "" && $single_shift->sunday_break_to != "05:30:00"){ echo date('h:iA',strtotime($single_shift->sunday_break_to)); }?>">
                                                                </th>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <button type="submit" class="btn btn-primary" id="shift_submit_button" name="shift_submit_button" value="shift_submit_button">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php }else{ ?>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label class="error">Salon working hrs not set yet. Please add</label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- all shifts -->

                    <div class="tab-pane <?php if(isset($_GET['active']) && $_GET['active'] == 'regular_shift_list'){?>active<?php }?>" id="3">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Regular Shifts</h3>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                <table id="table_all_shift" class="table table-striped  jambo_table" style="width:100% !important;">
                                                    <thead>
                                                        <th>Sr. No.</th>
                                                        <th>Shift Name</th>
                                                        <th>Shift Type</th>
                                                        <th>Shift Details</th>
                                                        <th>Bookings Status</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $k = 1;
                                                            // echo'<pre>'; print_r($all_shifts);exit;
                                                            if(!empty($all_shifts)){
                                                                foreach($all_shifts as $all_shifts_result){
                                                                    $id_deleted_allowed = '1';
                                                                    $shift_emps = $this->Salon_model->get_shift_emps($all_shifts_result->id);
                                                                    if(!empty($shift_emps)){
                                                                        $id_deleted_allowed = '0';
                                                                    }
                                                        ?>
                                                        <tr>
                                                            <td><?=$k++;?></td>
                                                            <td><?=$all_shifts_result->shift_name;?></td>
                                                            <td>
                                                                <?php
                                                                    if($all_shifts_result->shift_type == '1'){
                                                                        echo 'Rotational';
                                                                    }else{
                                                                        echo 'Fixed';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" onclick="showPopup(<?=$all_shifts_result->id;?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?=$all_shifts_result->id;?>">
                                                                    View
                                                                </button>
                                                                <div class="modal fade" id="exampleModal_<?=$all_shifts_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$all_shifts_result->id;?>" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel_<?=$all_shifts_result->id;?>">Shift Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?=$all_shifts_result->id;?>)">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div id="response_<?=$all_shifts_result->id;?>">
                                                                                <table id="table_shift_details_<?=$all_shifts_result->id;?>" class="table table_shift_details table-striped jambo_table" style="width:100% !important;">
                                                                                    <thead>
                                                                                        <th>Day</th>
                                                                                        <th>Working Hrs</th>
                                                                                        <th>Shift From</th>
                                                                                        <th>Shift To</th>
                                                                                        <th>Break From</th>
                                                                                        <th>Break To</th>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php if($all_shifts_result->is_monday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Monday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_working_from != "" && $all_shifts_result->monday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->monday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_tuesday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Tuesday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_working_from != "" && $all_shifts_result->tuesday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->tuesday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_wednesday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Wednesday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_working_from != "" && $all_shifts_result->wednesday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->wednesday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_thursday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Thursday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_working_from != "" && $all_shifts_result->thursday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->thursday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_friday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Friday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_working_from != "" && $all_shifts_result->friday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->friday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_saturday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Saturday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_working_from != "" && $all_shifts_result->saturday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->saturday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_sunday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Sunday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_working_from != "" && $all_shifts_result->sunday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->sunday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php if($all_shifts_result->is_bookings_allowed == "1"){?>
                                                                    <a title="Stop Receiving Bookings"  onclick="return confirm('Are you sure to stop receiving bookings?');" class="btn btn-light" href="<?=base_url()?>stop-bookings/<?=$all_shifts_result->id?>/regular_shift_list"><i class="fa-solid fa-toggle-on"></i></a>  
                                                                <?php }else{?> 
                                                                    <a title="Start Receiving Bookings"  class="btn btn-light" onclick="return confirm('Are you sure to start receiving bookings?');" href="<?=base_url()?>start-bookings/<?=$all_shifts_result->id?>/regular_shift_list"><i  style="color: red;" class="fa-solid fa-toggle-off"></i></a> 
                                                                <?php }?>
                                                            </td>
                                                            <td>
                                                                <?php if($id_deleted_allowed == '1'){ 
                                                                    $shift_bookings = $this->Salon_model->get_shift_bookings($all_shifts_result->id);
                                                                    if(empty($shift_bookings)){
                                                                ?>
                                                                    <a onclick="return confirm('Are you sure to update this shift?');" href="<?=base_url();?>working-hours/shifts/<?=$all_shifts_result->id;?>" class="btn btn-primary" title="Update"><i class="fa-solid fa-pen-to-square"></i></a>       
                                                                    <a onclick="return confirm('Are you sure to delete this shift?');" href="<?=base_url();?>delete/<?=$all_shifts_result->id ?>/tbl_shift_master" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>                               
                                                                <?php }else{ ?>
                                                                    Bookings received.<br>Can't Delete/Update
                                                                <?php }}else{ ?>
                                                                    Already assigned.<br>Can't Delete/Update
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php if(isset($_GET['active']) && $_GET['active'] == 'rotational_shift_list'){?>active<?php }?>" id="4">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Rotational Shifts</h3>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                <table id="table_all_rotational_shift" class="table table-striped  jambo_table" style="width:100% !important;">
                                                    <thead>
                                                        <th>Sr. No.</th>
                                                        <th>Rotation Order</th>
                                                        <th>Shift Name</th>
                                                        <th>Shift Type</th>
                                                        <th>Shift Details</th>
                                                        <th>Bookings Status</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $k = 1;
                                                            if(!empty($all_rotational_shifts)){
                                                                foreach($all_rotational_shifts as $all_shifts_result){
                                                                    $id_deleted_allowed = '1';
                                                                    $shift_emps = $this->Salon_model->get_shift_emps($all_shifts_result->id);
                                                                    if(!empty($shift_emps)){
                                                                        $id_deleted_allowed = '0';
                                                                    }
                                                                    
                                                                    $shift_bookings = $this->Salon_model->get_shift_bookings($all_shifts_result->id);
                                                                    if($id_deleted_allowed == '1' && empty($shift_bookings)){
                                                                        $is_reorder_allowed = '1';
                                                                    }else{
                                                                        $is_reorder_allowed = '0';
                                                                        break;
                                                                    }
                                                                }
                                                                foreach($all_rotational_shifts as $all_shifts_result){
                                                                    $id_deleted_allowed = '1';
                                                                    $shift_emps = $this->Salon_model->get_shift_emps($all_shifts_result->id);
                                                                    if(!empty($shift_emps)){
                                                                        $id_deleted_allowed = '0';
                                                                    }
                                                                    if($is_reorder_allowed == '1'){
                                                        ?>
                                                        <tr class="draggable-rows" data-id="<?=$all_shifts_result->id;?>" data-order="<?=$all_shifts_result->order;?>">
                                                            <td class="sr-no"><?=$k++;?></td>
                                                            <td style="cursor:grab;" class="handle order">
                                                                <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?=$all_shifts_result->order != "" ? $all_shifts_result->order : '0';?>
                                                            </td>
                                                            <td class=""><?=$all_shifts_result->shift_name;?></td>
                                                        <?php       }else{ ?>
                                                        <tr>
                                                            <td><?=$k++;?></td>
                                                            <td>
                                                                <i class="fas fa-times" style="color:red;cursor:pointer;" title="Reorder not allowed because bookings received for one of the shift"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?=$all_shifts_result->order != "" ? $all_shifts_result->order : '0';?>
                                                            </td>
                                                            <td><?=$all_shifts_result->shift_name;?></td>
                                                        <?php       } ?>
                                                            <td>
                                                                <?php
                                                                    if($all_shifts_result->shift_type == '1'){
                                                                        echo 'Rotational';
                                                                    }else{
                                                                        echo 'Fixed';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" onclick="showPopup(<?=$all_shifts_result->id;?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?=$all_shifts_result->id;?>">
                                                                    View
                                                                </button>
                                                                <div class="modal fade" id="exampleModal_<?=$all_shifts_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$all_shifts_result->id;?>" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel_<?=$all_shifts_result->id;?>">Shift Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?=$all_shifts_result->id;?>)">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div id="response_<?=$all_shifts_result->id;?>">
                                                                                <table id="table_shift_details_<?=$all_shifts_result->id;?>" class="table table_shift_details table-striped jambo_table" style="width:100% !important;">
                                                                                    <thead>
                                                                                        <th>Day</th>
                                                                                        <th>Working Hrs</th>
                                                                                        <th>Shift From</th>
                                                                                        <th>Shift To</th>
                                                                                        <th>Break From</th>
                                                                                        <th>Break To</th>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php if($all_shifts_result->is_monday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Monday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_working_from != "" && $all_shifts_result->monday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->monday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->monday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->monday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_tuesday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Tuesday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_working_from != "" && $all_shifts_result->tuesday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->tuesday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->tuesday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->tuesday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_wednesday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Wednesday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_working_from != "" && $all_shifts_result->wednesday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->wednesday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->wednesday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->wednesday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_thursday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Thursday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_working_from != "" && $all_shifts_result->thursday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->thursday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->thursday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->thursday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_friday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Friday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_working_from != "" && $all_shifts_result->friday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->friday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->friday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->friday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_saturday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Saturday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_working_from != "" && $all_shifts_result->saturday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->saturday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->saturday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->saturday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                        <?php if($all_shifts_result->is_sunday_shift == '1'){ ?>
                                                                                        <tr>
                                                                                            <th>Sunday</th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_working_from != "" && $all_shifts_result->sunday_working_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_working_from)).' To '.date('h:i A',strtotime($all_shifts_result->sunday_working_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_shift_from != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_shift_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_shift_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_shift_to)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_break_from != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_break_from)); }?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <?php if($all_shifts_result->sunday_break_to != ""){ echo date('h:i A',strtotime($all_shifts_result->sunday_break_to)); }?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php if($all_shifts_result->is_bookings_allowed == "1"){?>
                                                                    <a title="Stop Receiving Bookings"  onclick="return confirm('Are you sure to stop receiving bookings?');" class="btn btn-light" href="<?=base_url()?>stop-bookings/<?=$all_shifts_result->id?>/rotational_shift_list"><i class="fa-solid fa-toggle-on"></i></a>  
                                                                <?php }else{?> 
                                                                    <a title="Start Receiving Bookings"  class="btn btn-light" onclick="return confirm('Are you sure to start receiving bookings?');" href="<?=base_url()?>start-bookings/<?=$all_shifts_result->id?>/rotational_shift_list"><i style="color: red;" class="fa-solid fa-toggle-off"></i></a> 
                                                                <?php }?>
                                                            </td>
                                                            <td>
                                                                <?php if($id_deleted_allowed == '1'){ 
                                                                    $shift_bookings = $this->Salon_model->get_shift_bookings($all_shifts_result->id);
                                                                    if(empty($shift_bookings)){
                                                                ?>
                                                                    <a onclick="return confirm('Are you sure to update this shift?');" href="<?=base_url();?>working-hours/shifts/<?=$all_shifts_result->id;?>" class="btn btn-primary" title="Update"><i class="fa-solid fa-pen-to-square"></i></a>       
                                                                    <a onclick="return confirm('Are you sure to delete this shift?');" href="<?=base_url();?>delete/<?=$all_shifts_result->id ?>/tbl_shift_master" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>                               
                                                                <?php }else{ ?>
                                                                    Bookings received.<br>Can't Delete/Update
                                                                <?php }}else{ ?>
                                                                    Already assigned.<br>Can't Delete/Update
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    </div>
    <?php }?>
</div>
</div>
<?php include('footer.php');
if(!empty($single_shift)){
    $single_shift_id = $single_shift->id;
}else{
    $single_shift_id = '0';
}
?>
<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>

 <script>



    $(document).ready(function() { 
        $('.check_box_len').change(function() {
            var anyUnchecked = $('.check_box_len:not(:checked)').length > 0;
            $('#all_apply').prop('checked', !anyUnchecked);
            // updateTimes();
        });

        $('#all_apply').change(function() {
            var applyForAllChecked = $(this).is(':checked');
            $('.check_box_len').prop('checked', applyForAllChecked);
            // updateTimes();
        });

        function updateTimes() {
            var fromMondayValue = $('#from_monday').val();
            var toMondayValue = $('#to_monday').val();
            var applyForAllChecked = $('#all_apply').is(':checked');

            if (applyForAllChecked && fromMondayValue !== '' && toMondayValue !== '') {
                $('.basicExample').val(fromMondayValue);
                $('[name^="to_"]').val(toMondayValue);
            } else {
                $('.basicExample, [name^="to_"]').val('');
            }
        }












        // $('.check_box_len').change(function() {
        //     var anyUnchecked = $('.check_box_len:not(:checked)').length > 0;
        //     $('#all_apply').prop('checked', !anyUnchecked);
        // });   

        // $('#all_apply').change(function() {
        //     var fromMondayValue = $('#from_monday').val();
        //     var toMondayValue = $('#to_monday').val();
        //     var applyForAllChecked = fromMondayValue !== '' && toMondayValue !== '';
        //     // alert(applyForAllChecked);
        //     $(this).prop('checked', applyForAllChecked);

        //    $('.check_box_len').prop('checked', applyForAllChecked);
        //     if (fromMondayValue !== '' && toMondayValue !== '') {
        //         $('#monday_error').text('');
        //         if (applyForAllChecked) {
        //             $('.basicExample').val(fromMondayValue);
        //             $('[name^="to_"]').val(toMondayValue);
        //         }
        //     } else {
        //         $('#monday_error').text('From and To times for Monday are required.');
        //         $('.basicExample, [name^="to_"]').val('');
        //     }
        // });

        $('.basicExample').clockpicker({
            donetext: 'Done', 
            twelvehour: true
        });
        
        $("#post_job").validate({
            rules: {
                from_monday: {
                    required: function(element) {
                        return $('#Monday').is(':checked');
                    },
                },
                to_monday: {
                    required: function(element) {
                        return $('#Monday').is(':checked');
                    },
                    greaterThan: "#from_monday"
                },
                from_tuesday: {
                    required: function(element) {
                        return $('#Tuesday').is(':checked');
                    },
                },
                to_tuesday: {
                    required: function(element) {
                        return $('#Tuesday').is(':checked');
                    },
                    greaterThan: "#from_tuesday"
                },
                from_wednesday: {
                    required: function(element) {
                        return $('#Wednesday').is(':checked');
                    },
                },
                to_wednesday: {
                    required: function(element) {
                        return $('#Wednesday').is(':checked');
                    },
                    greaterThan: "#from_wednesday"
                },
                from_thursday: {
                    required: function(element) {
                        return $('#Thursday').is(':checked');
                    },
                },
                to_thursday: {
                    required: function(element) {
                        return $('#Thursday').is(':checked');
                    },
                    greaterThan: "#from_thursday"
                },
                from_friday: {
                    required: function(element) {
                        return $('#Friday').is(':checked');
                    },
                },
                to_friday: {
                    required: function(element) {
                        return $('#Friday').is(':checked');
                    },
                    greaterThan: "#from_friday"
                },
                from_saturday: {
                    required: function(element) {
                        return $('#Saturday').is(':checked');
                    },
                },
                to_saturday: {
                    required: function(element) {
                        return $('#Saturday').is(':checked');
                    },
                    greaterThan: "#from_saturday"
                },
                from_sunday: {
                    required: function(element) {
                        return $('#Sunday').is(':checked');
                    },
                },
                to_sunday: {
                    required: function(element) {
                        return $('#Sunday').is(':checked');
                    },
                    greaterThan: "#from_sunday"
                },
            },
            messages: {
                from_monday: {
                    required: 'Please enter from time',
                },
                to_monday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_tuesday: {
                    required: 'Please enter from time',
                },
                to_tuesday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_wednesday: {
                    required: 'Please enter from time',
                },
                to_wednesday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_thursday: {
                    required: 'Please enter from time',
                },
                to_thursday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_friday: {
                    required: 'Please enter from time',
                },
                to_friday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_saturday: {
                    required: 'Please enter from time',
                },
                to_saturday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
                from_sunday: {
                    required: 'Please enter from time',
                },
                to_sunday: {
                    required: 'Please enter to time',
                    greaterThan: "End time should be greater than start time.",
                },
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want submit form?")) {
                    form.submit();
                }
            }
        });
        
        $.validator.addMethod("greaterThan", function(value, element, params) {
            var startTime = $(params).val();
            if (!startTime || !value) {
                return true;
            }
            var start = parseTime(startTime);
            var end = parseTime(value);
            return end > start;
        }, "End time must be greater than start time.");
        $.validator.addMethod("timeInBetween", function(value, element, params) {
            var startTime = $(params[0]).val();
            var endTime = $(params[1]).val();
            if (!startTime || !endTime || !value) {
                return true;
            }
            var start = parseTime(startTime);
            var end = parseTime(endTime);
            var time = parseTime(value);
            return (time >= start && time <= end);
        }, "Please enter a time between {0} and {1}.");

        $("#shift_form").validate({
            rules: {
                monday_shift_from: {
                    required: function(element) {
                        return $('#monday_shift').is(':checked');
                    },
                    timeInBetween: ["#monday_working_from", "#monday_working_to"],
                },
                monday_shift_to: {
                    required: function(element) {
                        return $('#monday_shift').is(':checked');
                    },
                    timeInBetween: ["#monday_working_from", "#monday_working_to"],
                    greaterThan: "#monday_shift_from"
                },
                monday_break_from: {
                    required: function(element) {
                        return $('#monday_shift').is(':checked');
                    },
                    timeInBetween: ["#monday_shift_from", "#monday_shift_to"]
                },
                monday_break_to: {
                    required: function(element) {
                        return $('#monday_shift').is(':checked');
                    },
                    timeInBetween: ["#monday_shift_from", "#monday_shift_to"],
                    greaterThan: "#monday_break_from"
                },
                tuesday_shift_from: {
                    required: function(element) {
                        return $('#tuesday_shift').is(':checked');
                    },
                    timeInBetween: ["#tuesday_working_from", "#tuesday_working_to"],
                },
                tuesday_shift_to: {
                    required: function(element) {
                        return $('#tuesday_shift').is(':checked');
                    },
                    timeInBetween: ["#tuesday_working_from", "#tuesday_working_to"],
                    greaterThan: "#tuesday_shift_from"
                },
                tuesday_break_from: {
                    required: function(element) {
                        return $('#tuesday_shift').is(':checked');
                    },
                    timeInBetween: ["#tuesday_shift_from", "#tuesday_shift_to"]
                },
                tuesday_break_to: {
                    required: function(element) {
                        return $('#tuesday_shift').is(':checked');
                    },
                    timeInBetween: ["#tuesday_shift_from", "#tuesday_shift_to"],
                    greaterThan: "#tuesday_break_from"
                },
                wednesday_shift_from: {
                    required: function(element) {
                        return $('#wednesday_shift').is(':checked');
                    },
                    timeInBetween: ["#wednesday_working_from", "#wednesday_working_to"],
                },
                wednesday_shift_to: {
                    required: function(element) {
                        return $('#wednesday_shift').is(':checked');
                    },
                    timeInBetween: ["#wednesday_working_from", "#wednesday_working_to"],
                    greaterThan: "#wednesday_shift_from"
                },
                wednesday_break_from: {
                    required: function(element) {
                        return $('#wednesday_shift').is(':checked');
                    },
                    timeInBetween: ["#wednesday_shift_from", "#wednesday_shift_to"]
                },
                wednesday_break_to: {
                    required: function(element) {
                        return $('#wednesday_shift').is(':checked');
                    },
                    timeInBetween: ["#wednesday_shift_from", "#wednesday_shift_to"],
                    greaterThan: "#wednesday_break_from"
                },
                thursday_shift_from: {
                    required: function(element) {
                        return $('#thursday_shift').is(':checked');
                    },
                    timeInBetween: ["#thursday_working_from", "#thursday_working_to"],
                },
                thursday_shift_to: {
                    required: function(element) {
                        return $('#thursday_shift').is(':checked');
                    },
                    timeInBetween: ["#thursday_working_from", "#thursday_working_to"],
                    greaterThan: "#thursday_shift_from"
                },
                thursday_break_from: {
                    required: function(element) {
                        return $('#thursday_shift').is(':checked');
                    },
                    timeInBetween: ["#thursday_shift_from", "#thursday_shift_to"]
                },
                thursday_break_to: {
                    required: function(element) {
                        return $('#thursday_shift').is(':checked');
                    },
                    timeInBetween: ["#thursday_shift_from", "#thursday_shift_to"],
                    greaterThan: "#thursday_break_from"
                },
                friday_shift_from: {
                    required: function(element) {
                        return $('#friday_shift').is(':checked');
                    },
                    timeInBetween: ["#friday_working_from", "#friday_working_to"],
                },
                friday_shift_to: {
                    required: function(element) {
                        return $('#friday_shift').is(':checked');
                    },
                    timeInBetween: ["#friday_working_from", "#friday_working_to"],
                    greaterThan: "#friday_shift_from"
                },
                friday_break_from: {
                    required: function(element) {
                        return $('#friday_shift').is(':checked');
                    },
                    timeInBetween: ["#friday_shift_from", "#friday_shift_to"]
                },
                friday_break_to: {
                    required: function(element) {
                        return $('#friday_shift').is(':checked');
                    },
                    timeInBetween: ["#friday_shift_from", "#friday_shift_to"],
                    greaterThan: "#friday_break_from"
                },
                saturday_shift_from: {
                    required: function(element) {
                        return $('#saturday_shift').is(':checked');
                    },
                    timeInBetween: ["#saturday_working_from", "#saturday_working_to"],
                },
                saturday_shift_to: {
                    required: function(element) {
                        return $('#saturday_shift').is(':checked');
                    },
                    timeInBetween: ["#saturday_working_from", "#saturday_working_to"],
                    greaterThan: "#saturday_shift_from"
                },
                saturday_break_from: {
                    required: function(element) {
                        return $('#saturday_shift').is(':checked');
                    },
                    timeInBetween: ["#saturday_shift_from", "#saturday_shift_to"]
                },
                saturday_break_to: {
                    required: function(element) {
                        return $('#saturday_shift').is(':checked');
                    },
                    timeInBetween: ["#saturday_shift_from", "#saturday_shift_to"],
                    greaterThan: "#saturday_break_from"
                },
                sunday_shift_from: {
                    required: function(element) {
                        return $('#sunday_shift').is(':checked');
                    },
                    timeInBetween: ["#sunday_working_from", "#sunday_working_to"],
                },
                sunday_shift_to: {
                    required: function(element) {
                        return $('#sunday_shift').is(':checked');
                    },
                    timeInBetween: ["#sunday_working_from", "#sunday_working_to"],
                    greaterThan: "#sunday_shift_from"
                },
                sunday_break_from: {
                    required: function(element) {
                        return $('#sunday_shift').is(':checked');
                    },
                    timeInBetween: ["#sunday_shift_from", "#sunday_shift_to"]
                },
                sunday_break_to: {
                    required: function(element) {
                        return $('#sunday_shift').is(':checked');
                    },
                    timeInBetween: ["#sunday_shift_from", "#sunday_shift_to"],
                    greaterThan: "#sunday_break_from"
                },
                shift_name: {
                    required: function(element) {
                        return true;
                    },
                },
                shift_type: {
                    required: function(element) {
                        return true;
                    },
                },
            },
            messages: {
                monday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                monday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                monday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                monday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                tuesday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                tuesday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                tuesday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                tuesday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                wednesday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                wednesday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                wednesday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                wednesday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                thursday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                thursday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                thursday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                thursday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                friday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                friday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                friday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                friday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                saturday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                saturday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                saturday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                saturday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                sunday_shift_from: {
                    required: 'Please enter shift from time',
                    timeInBetween: "Shift start time should be between working hours."
                },
                sunday_shift_to: {
                    required: 'Please enter shift to time',
                    timeInBetween: "Shift end time should be between working hours.",
                    greaterThan: "Shift end time should be greater than start time.",
                },
                sunday_break_from: {
                    required: 'Please enter break from time',
                    timeInBetween: "Break start time should be between shift hours."
                },
                sunday_break_to: {
                    required: 'Please enter break to time',
                    timeInBetween: "Break end time should be between shift hours.",
                    greaterThan: "Break end time should be greater than start time.",
                },
                shift_name: {
                    required: 'Please enter shift name',
                },
                shift_type: {
                    required: 'Please select shift type',
                },
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want to submit the form? The shift cannot be edited once it is created.")) {
                    form.submit();
                }
            }
        });
        
        $('#table_shift_add').DataTable({ 
            dom: 'Blfrtip',
            responsive: false,
            scrollX:300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            ordering: false,
            order: [],
            buttons: [         
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5] 
                    }
                }
            ], 
        });
        
        $('#table_all_shift').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            // scrollX:300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            ordering: false,
            order: [],
            buttons: [
                            
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,1,2] 
                    }
                }
            ], 
        });
        
        $('#table_all_rotational_shift').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            // scrollX:300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            ordering: false,
            order: [], 
            buttons: [
                            
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,1,2] 
                    }
                }
            ], 
        });
        
        $('.table_shift_details').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            // scrollX:300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            ordering: false,
            order: [],
            buttons: [
                            
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5] 
                    }
                }
            ], 
        });

        $('#shift_name').keyup(function() {
            var shift_name = $('#shift_name').val();
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/check_unique_shift",
                data: {'label': shift_name, 'id': <?php echo $single_shift_id; ?>},
                success: function(data) {
                    if(data === '1'){
                        $('#shift_name_error').html('This shift name already exist');
                    }else{
                        $('#shift_name_error').html('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
        

    function parseTime(time) {
        var timeSplit = time.match(/(\d{1,2}):(\d{2})([AP]M)/i);
        if (timeSplit && timeSplit.length === 4) {
            var hour = parseInt(timeSplit[1]);
            var minute = parseInt(timeSplit[2]);
            var period = timeSplit[3].toUpperCase();
            
            if (period === 'PM' && hour !== 12) {
                hour += 12;
            } else if (period === 'AM' && hour === 12) {
                hour = 0;
            }
            
            return hour * 60 + minute;
        }
        return NaN; // Invalid time format
    }

    function showPopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
</script>

<script>
// $(document).ready(function() {
//     $('.box_length').prop('checked', false);

//     // function clearInputs() {
//     //     $('input[name$="_shift_from"]').val(''); 
//     //     $('input[name$="_shift_to"]').val('');
//     //     $('input[name$="_break_from"]').val('');
//     //     $('input[name$="_break_to"]').val('');
//     // }

//     $('.box_length').change(function(){
//         var anyUnchecked = $('.box_length:not(:checked)').length > 0;
//         $('#all_apply_selectbox').prop('checked', !anyUnchecked); 
//     });

//     $('#all_apply_selectbox').change(function(){
//         var MondayShiftFrom = $('#monday_shift_from').val();
//         var MondayShiftTo = $('#monday_shift_to').val();
//         var MondayBreakFrom = $('#monday_break_from').val();
//         var MondayBreakTo = $('#monday_break_to').val();
//         var ApplyForAllCheck = MondayShiftFrom !== '' && MondayShiftTo !== '' && MondayBreakFrom !== '' && MondayBreakTo !== '';
//         $('.box_length').prop('checked', ApplyForAllCheck);

//         if (ApplyForAllCheck) {
//             $('input[name$="_shift_from"]').val(MondayShiftFrom);
//             $('input[name$="_shift_to"]').val(MondayShiftTo);
//             $('input[name$="_break_from"]').val(MondayBreakFrom);
//             $('input[name$="_break_to"]').val(MondayBreakTo);
//             $('#monday_shift_error').text('');
//         } else {
//             $('#monday_shift_error').text('From and To times for Monday are required.');
//             $('input[name$="_shift_from"]').val(''); 
//             $('input[name$="_shift_to"]').val('');
//             $('input[name$="_break_from"]').val('');
//             $('input[name$="_break_to"]').val('');
//             // clearInputs();
//         }
//     });

//     // Disabling and clearing inputs when #all_apply_selectbox is unchecked
//     // $('#all_apply_selectbox').change(function(){
//         // alert();
//         if (!$(this).prop('checked')) {
//             $('.box_length').prop('disabled', true);
//             // clearInputs();
//             $('input[name$="_shift_from"]').val(MondayShiftFrom); 
//             $('input[name$="_shift_to"]').val(MondayShiftTo);
//             $('input[name$="_break_from"]').val(MondayBreakFrom);
//             $('input[name$="_break_to"]').val(MondayBreakTo);
//         } else {
//             alert();
//             $('.box_length').prop('disabled', false);
//             $('input[name$="_shift_from"]').val(''); 
//             $('input[name$="_shift_to"]').val('');
//             $('input[name$="_break_from"]').val('');
//             $('input[name$="_break_to"]').val('');
//         }

//         if($(this).prop('disabled')){
//             $('.box_length').prop('disabled', false);
//             $('input[name$="_shift_from"]').val(''); 
//             $('input[name$="_shift_to"]').val('');
//             $('input[name$="_break_from"]').val('');
//             $('input[name$="_break_to"]').val('');
//         }
//     // });
// });




// $(document).ready(function() {
//     $('.box_length').prop('checked', false);
//     $('.box_length').change(function(){
//         var anyUnchecked = $('.box_length:not(:checked)').length > 0;
//         $('#all_apply_selectbox').prop('checked', !anyUnchecked); 
//     });

//     $('#all_apply_selectbox').change(function(){
//         var MondayShiftFrom = $('#monday_shift_from').val();
//         var MondayShiftTo = $('#monday_shift_to').val();
//         var MondayBreakFrom = $('#monday_break_from').val();
//         var MondayBreakTo = $('#monday_break_to').val();
//         var ApplyForAllCheck = MondayShiftFrom !== '' && MondayShiftTo !== '' && MondayBreakFrom !== '' && MondayBreakTo !== '';

//         $('.box_length').prop('checked', ApplyForAllCheck);

//         if (ApplyForAllCheck) {
//             $('input[name$="_shift_from"]').val(MondayShiftFrom);
//             $('input[name$="_shift_to"]').val(MondayShiftTo);
//             $('input[name$="_break_from"]').val(MondayBreakFrom);
//             $('input[name$="_break_to"]').val(MondayBreakTo);
//             $('#monday_shift_error').text('');
//         } else {
//             $('#monday_shift_error').text('From and To times for Monday are required.');
//             $('input[name$="_shift_from"]').val(''); 
//             $('input[name$="_shift_to"]').val('');
//             $('input[name$="_break_from"]').val('');
//             $('input[name$="_break_to"]').val('');
//         }
//     });
// });













$(document).ready(function() {
    // $('.box_length').prop('checked', false);
    function updateAllApplyCheckbox() {
        var allChecked = $('.box_length:checked').length === $('.box_length').length;
        $('#all_apply_selectbox').prop('checked', allChecked);
    }

    updateAllApplyCheckbox();

    function clearInputs() {
        $('input[name$="_shift_from"]').val(''); 
        $('input[name$="_shift_to"]').val('');
        $('input[name$="_break_from"]').val('');
        $('input[name$="_break_to"]').val('');
    }

    $('.box_length').change(function(){
        updateAllApplyCheckbox();
    });

    $('#monday_shift').change(function() {
        $('#monday_shift_error').text('');
    });
    $('#all_apply_selectbox').change(function() {
        var MondayShiftFrom = $('#monday_shift_from').val();
        var MondayShiftTo = $('#monday_shift_to').val();
        var MondayBreakFrom = $('#monday_break_from').val();
        var MondayBreakTo = $('#monday_break_to').val();
        var ApplyForAllCheck = MondayShiftFrom !== '' && MondayShiftTo !== '' && MondayBreakFrom !== '' && MondayBreakTo !== '';

        if ($(this).prop('checked')) {
            if (ApplyForAllCheck) {
                $('.box_length').prop('checked', true);
                $('input[name$="_shift_from"]').val(MondayShiftFrom);
                $('input[name$="_shift_to"]').val(MondayShiftTo);
                $('input[name$="_break_from"]').val(MondayBreakFrom);
                $('input[name$="_break_to"]').val(MondayBreakTo);
                $('#monday_shift_error').text('');
            } else {
                $('#monday_shift_error').text('From and To times for Monday are required.');
                clearInputs();
                $(this).prop('checked', false);
            }
        } else {
            if (confirm('Are you sure you want to uncheck? All values will be cleared.')) {
                $('.box_length').prop('checked', false);
                clearInputs();
            } else {
                $(this).prop('checked', true);
            }
        }
    });
});
$(document).ready(function() {
    $('#table_all_rotational_shift tbody').sortable({
        handle: '.handle',
        update: function(event, ui) {
            var order = [];
            $('.draggable-rows').each(function(index, element) {
                var id = $(this).data('id');
                $(this).data('order', index + 1);
                
                if (id) {
                    order.push({
                        id: id,
                        order: index + 1
                    });
                }
            });

            $.ajax({
                url: '<?=base_url();?>salon/Ajax_controller/update_shift_order',
                method: 'POST',
                data: { order: order },
                dataType: 'json',
                success: function(response) {
                    console.log('Order updated successfully', response);

                    $('.draggable-rows').each(function(index) {
                        var newOrder = index + 1;
                        
                        $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+newOrder);
                        $(this).find('.sr-no').text(newOrder);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('An error occurred while updating the order', error);
                }
            });
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.working-hours').addClass('active_cc');
    });
</script>
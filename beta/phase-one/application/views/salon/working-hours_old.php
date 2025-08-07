<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
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
                    <li class="<?php if($this->uri->segment(3) == ""){?>active<?php }?>" id="tab_1">
                        <a  href="#1" data-toggle="tab">Salon Time</a>
                    </li>
                    <li id="tab_2" class="<?php if($this->uri->segment(3) != ""){?>active<?php }?>">
                        <a href="#2" data-toggle="tab">Shift Managment</a>
                    </li>
                    <li id="tab_3">
                        <a href="#3" data-toggle="tab">Work Shedule</a>
                    </li>
                </ul><br>

                <div class="tab-content ">

                    <!-- salon time -->
                   
                    <div class="tab-pane <?php if($this->uri->segment(3) == ""){?>active<?php }?>" id="1">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Salon Time</h3>
                                    </div>
                                    <div class="container">
                                        <form method="post" name="salon_time_form" id="salon_time_form" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Salon Opening Time<b class="require">*</b></label>
                                                    <input autocomplete="off" readonly type="text" class="form-control timepicker" name="salon_start_time" id="salon_start_time" placeholder="HH:MM" value="<?php if (!empty($single_rules)) { echo $single_rules->salon_start_time; } ?>">
                                                    <p>Set these options carefully because it will affect the salon opening time.</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Salon Closing time<b class="require">*</b></label>
                                                    <input autocomplete="off" readonly type="text" class="form-control timepicker" name="salon_end_time" id="salon_end_time" placeholder="HH:MM" value="<?php if (!empty($single_rules)) { echo $single_rules->salon_end_time   ; } ?>">
                                                    <p>Set these options carefully because it will affect on salon closing time.</p>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                    <button style="margin-top: 30px;" type="submit" value="salon-time-btn" id="salon-time-btn" name="salon-time-btn" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- shift managment -->

                    <div class="tab-pane <?php if($this->uri->segment(3) != ""){?>active<?php }?>" id="2">
                        <?php if (!empty($single_rules->salon_start_time)) {?>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="x_title">
                                        <h3>Salon Shift Time</h3>
                                    </div>
                                    <div class="container">
                                        <form method="post" name="shift_form" id="shift_form" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                    <label>Shift Name <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="shift_name" id="shift_name" value="<?php if (!empty($single_shift)) {echo $single_shift->shift_name;} ?>" placeholder="Enter shift name">
                                                    <input autocomplete="off" type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single_shift)) {echo $single_shift->id;} ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Shift Start Time <b class="require">*</b></label>
                                                    <input maxlength="5" readonly autocomplete="off" type="text" class="form-control timepicker" name="shift_in_time" id="shift_in_time" value="<?php if (!empty($single_shift)) {echo $single_shift->shift_in_time;} ?>" placeholder="HH:MM">
                                                    <div id="validationMessage1" style="display:none; color: red; font-weight: bold;"></div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Shift End Time <b class="require">*</b></label>
                                                    <input maxlength="5" readonly autocomplete="off" type="text" class="form-control timepicker" name="shift_out_time" id="shift_out_time" value="<?php if (!empty($single_shift)) {echo $single_shift->shift_out_time; } ?>" placeholder="HH:MM">
                                                    <div id="validationMessage2" style="display:none; color: red; font-weight: bold;"></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Lunch Start Time <b class="require">*</b></label>
                                                    <input maxlength="5" readonly autocomplete="off" type="text" class="form-control timepicker" name="lunch_start_time" id="lunch_start_time" value="<?php if (!empty($single_shift)) {echo $single_shift->lunch_start_time; } ?>" placeholder="HH:MM">
                                                    <div id="lunchStart_message" style="display:none; color: red; font-weight: bold;"></div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Lunch End Time <b class="require">*</b></label>
                                                    <input maxlength="5" readonly autocomplete="off" type="text" class="form-control timepicker" name="lunch_close_time" id="lunch_close_time" value="<?php if (!empty($single_shift)) {echo $single_shift->lunch_close_time;} ?>" placeholder="HH:MM">
                                                    <div id="lunchclose_message" style="display:none; color: red; font-weight: bold;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary" value="shift-btn" name="shift-btn">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h3>Shift List</h3>
                                </div>

                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Shift Name</th>
                                                <th>Shift Start Time</th>
                                                <th>Shift End Time</th>
                                                <th>Lunch Start Time</th>
                                                <th>Lunch End Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($shift_list)) {
                                                $i = 1;
                                                foreach ($shift_list as $shift_list_result) {
                                            ?>
                                                    <tr>
                                                        <td scope="row">
                                                            <?= $i++ ?>
                                                        </td>
                                                        <td><?= $shift_list_result->shift_name ?></td>
                                                        <td><?= $shift_list_result->shift_in_time ?></td>
                                                        <td><?= $shift_list_result->shift_out_time ?></td>
                                                        <td><?= $shift_list_result->lunch_start_time ?></td>
                                                        <td><?= $shift_list_result->lunch_close_time ?></td>
                                                        <td>
                                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $shift_list_result->id ?>/tbl_shift_master"><i class="fa-solid fa-trash"></i></a>

                                                            <a title="Edit" class="btn btn-success" href="<?= base_url() ?>working-hours/2/<?= $shift_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php }else{?>
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title" style="text-align: center;">
                                            <img src="<?= base_url(); ?>\admin_assets\images\no_data\work_no.jpg">
                                        </div>
                                        <div style="text-align: center;font-size: 15px;">
                                        Click to complete working hours  <a style="color:blue;" href="#1" data-toggle="tab">Salon Time</a>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                    </div>

                    <!-- work shedule -->
                    
                    <div class="tab-pane" id="3">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <form id="work_shedule_form" name="work_shedule_form" method="post" data-parsley-validate>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="x_title">
                                                            <h3>Work Schedule</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <label>Select shift</label>
                                                        <select class="form-select form-control" name="shift_name" id="work_shift_name">
                                                            <option value="">Select shift</option>
                                                            <?php if (!empty($shift_list)) {
                                                                foreach ($shift_list as $shift_list_result) { ?>

                                                                    <option value="<?= $shift_list_result->id ?>" <?php if (!empty($single) && $single->shift_name == $shift_list_result->id) { ?>selected="selected" <?php } ?>><?= $shift_list_result->shift_name ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                        <span style="display:none;" for="work_shift_name" generated="true" class="error invalid-feedback">Please select shift name</span>
                                                    </div>
                                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                                        <ul class="color-code-section">
                                                            <li>
                                                                <span class="colored_div" style="background-color:#4caf50;"></span>
                                                                <h4>Full Day Work</h4>
                                                            </li>
                                                            <li>
                                                                <span class="colored_div" style="background-color:#ffc107;"></span>
                                                                <h4>Half Day Work</h4>
                                                            </li>
                                                            <li>
                                                                <span class="colored_div" style="background-color:#ff0000;"></span>
                                                                <h4>Weekend</h4>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php if (!empty($single)) {
                                                    $work_days = $this->Salon_model->get_work_schedule_working_days($single->id);
                                                ?>
                                                    <table style="width:100%;" class="working_days_table">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom: 30px;padding-top: 20px;">
                                                                        Weeks</div>
                                                                </th>
                                                                <th colspan="7" style="border-bottom:1px solid #ddd;border-left: 1px solid #ddd;">
                                                                    Days</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Sunday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Monday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Tuesday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Wednesday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Thursday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Friday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Saturday</div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <thead>

                                                            <?php if (!empty($work_days)) {
                                                                $f = 1;
                                                                foreach ($work_days as $work_days_result) { ?>
                                                                    <tr>
                                                                        <th><?= $work_days_result->week; ?><?php
                                                                                                            if ($work_days_result->week == '1') {
                                                                                                                echo 'st';
                                                                                                            } else if ($work_days_result->week == '2') {
                                                                                                                echo 'nd';
                                                                                                            } else if ($work_days_result->week == '3') {
                                                                                                                echo 'rd';
                                                                                                            } else if ($work_days_result->week == '4' || $work_days_result->week == '5' || $work_days_result->week == '6') {
                                                                                                                echo 'th';
                                                                                                            }
                                                                                                            ?>

                                                                            <input type="hidden" name="week_name[]" id="week_name_<?= $f; ?>" value="<?= $work_days_result->week; ?>">
                                                                            <input type="hidden" name="weeking_days_row_id[]" id="weeking_days_row_id_<?= $f; ?>" value="<?= $work_days_result->id; ?>">
                                                                        </th>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="sun_check[]" id="sun_check_<?= $f; ?>" class="sun_checkBox custom-checkbox-input <?php if ($work_days_result->sunday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->sunday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->sunday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->sunday_status; ?>" <?php if ($work_days_result->sunday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->sunday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->sunday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->sunday_status == '3') { ?>weekendDayClass<?php } ?>" for="sun_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="mon_check[]" id="mon_check_<?= $f; ?>" class="mon_checkBox custom-checkbox-input <?php if ($work_days_result->monday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->monday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->monday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->monday_status; ?>" <?php if ($work_days_result->monday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->monday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->monday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->monday_status == '3') { ?>weekendDayClass<?php } ?>" for="mon_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="tue_check[]" id="tue_check_<?= $f; ?>" class="tue_checkBox custom-checkbox-input <?php if ($work_days_result->tuesday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->tuesday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->tuesday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->tuesday_status; ?>" <?php if ($work_days_result->tuesday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->tuesday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->tuesday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->tuesday_status == '3') { ?>weekendDayClass<?php } ?>" for="tue_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="wed_check[]" id="wed_check_<?= $f; ?>" class="wed_checkBox custom-checkbox-input <?php if ($work_days_result->wednesday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->wednesday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->wednesday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->wednesday_status; ?>" <?php if ($work_days_result->wednesday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->wednesday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->wednesday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->wednesday_status == '3') { ?>weekendDayClass<?php } ?>" for="wed_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="thu_check[]" id="thu_check_<?= $f; ?>" class="thu_checkBox custom-checkbox-input <?php if ($work_days_result->thursday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->thursday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->thursday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->thursday_status; ?>" <?php if ($work_days_result->thursday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->thursday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->thursday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->thursday_status == '3') { ?>weekendDayClass<?php } ?>" for="thu_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="fri_check[]" id="fri_check_<?= $f; ?>" class="fri_checkBox custom-checkbox-input <?php if ($work_days_result->friday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->friday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->friday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->friday_status; ?>" <?php if ($work_days_result->friday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->friday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->friday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->friday_status == '3') { ?>weekendDayClass<?php } ?>" for="fri_check_<?= $f; ?>"></label>
                                                                        </td>
                                                                        <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                            <input type="checkbox" name="sat_check[]" id="sat_check_<?= $f; ?>" class="sat_checkBox custom-checkbox-input <?php if ($work_days_result->saturday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->saturday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->saturday_status == '3') { ?>weekendDayClass<?php } ?>" value="<?= $work_days_result->saturday_status; ?>" <?php if ($work_days_result->saturday_status != '') { ?>checked<?php } ?>>
                                                                            <label class="custom-checkbox-input <?php if ($work_days_result->saturday_status == '1') { ?>fullDayClass<?php } else if ($work_days_result->saturday_status == '2') { ?>halfDayClass<?php } else if ($work_days_result->saturday_status == '3') { ?>weekendDayClass<?php } ?>" for="sat_check_<?= $f; ?>"></label>

                                                                        </td>
                                                                    </tr>
                                                            <?php $f++;
                                                                }
                                                            } ?>
                                                        </thead>
                                                    </table>

                                                <?php } else { ?>
                                                    <table style="width:100%;" class="working_days_table">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom: 30px;padding-top: 20px;">
                                                                        Weeks</div>
                                                                </th>
                                                                <th colspan="7" style="border-bottom:1px solid #ddd;border-left: 1px solid #ddd;">
                                                                    Days</th>
                                                            </tr>
                                                            <tr>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Sunday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Monday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Tuesday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Wednesday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Thursday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Friday</div>
                                                                </th>
                                                                <th style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:10px;">
                                                                        Saturday</div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;">All</div>
                                                                </th>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="sun_check_all" id="sun_check_all" class="sun_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="sun_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="mon_check_all" id="mon_check_all" class="mon_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="mon_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="tue_check_all" id="tue_check_all" class="tue_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="tue_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="wed_check_all" id="wed_check_all" class="wed_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="wed_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="thu_check_all" id="thu_check_all" class="thu_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="thu_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="fri_check_all" id="fri_check_all" class="fri_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="fri_check_all"></label>
                                                                    </div>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;">
                                                                    <div style="border-bottom:1px solid #ddd; padding-bottom:17px;" class="custom-checkbox">
                                                                        <input type="checkbox" name="sat_check_all" id="sat_check_all" class="sat_check_all custom-checkbox-input">
                                                                        <label class="custom-checkbox-input" for="sat_check_all"></label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>1st <input type="hidden" name="week_name[]" id="week_name_one" value="1"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_one" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_one" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_one" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_one" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_one" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_one" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_one"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_one" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_one"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>2nd <input type="hidden" name="week_name[]" id="week_name_two" value="2"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_second" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_second" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_second" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_second" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_second" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_second" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_second"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_second" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_second"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>3rd <input type="hidden" name="week_name[]" id="week_name_three" value="3"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_third" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_third" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_third" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_third" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_third" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_third" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_third"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_third" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_third"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>4th <input type="hidden" name="week_name[]" id="week_name_four" value="4"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_fourth" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_fourth" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_fourth" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_fourth" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_fourth" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_fourth" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_fourth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_fourth" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_fourth"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>5th <input type="hidden" name="week_name[]" id="week_name_fifth" value="5"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_fifth" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_fifth" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_fifth" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_fifth" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_fifth" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_fifth" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_fifth"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_fifth" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_fifth"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>6th <input type="hidden" name="week_name[]" id="week_name_six" value="6"></th>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sun_check[]" id="sun_check_six" class="sun_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sun_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="mon_check[]" id="mon_check_six" class="mon_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="mon_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="tue_check[]" id="tue_check_six" class="tue_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="tue_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="wed_check[]" id="wed_check_six" class="wed_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="wed_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="thu_check[]" id="thu_check_six" class="thu_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="thu_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="fri_check[]" id="fri_check_six" class="fri_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="fri_check_six"></label>
                                                                </td>
                                                                <td style="border-left: 1px solid #ddd;" class="custom-checkbox">
                                                                    <input type="checkbox" name="sat_check[]" id="sat_check_six" class="sat_checkBox custom-checkbox-input">
                                                                    <label class="custom-checkbox-input" for="sat_check_six"></label>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                <?php } ?>
                                                <div class="error checkbox_error" style="text-align:center;">
                                                </div>
                                            </div>
                                        </div>
                                        <button style="margin-top: 30px;" class="btn btn-primary" type="submit" id="submit_button" name="work-shedule-btn" value="work-shedule-btn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade custome_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
                            <div class="modal-dialog custome_modal_dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal1Label">Please Select Weekday Type</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="fullname">Day Type</label>
                                            <select id="day_type" name="day_type" class="form-control">
                                                <option value="1" selected>Full Day Work</option>
                                                <option value="2">Half Day Work</option>
                                                <option value="3">Weekend</option>
                                            </select>
                                            <input type="hidden" class="form_control" name="input_class" id="input_class" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary close_btn" onclick="closeModal()">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="saveDayType()">Save</button>
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
$id = 0;
if ($this->uri->segment(3) != "") {
    $id = $this->uri->segment(3);
}
?>
<script>
    $(document).ready(function () {
        var pageName = window.location.pathname.split('/').pop();
        if(pageName == 1){
            $("#1").addClass('active');
            $("#tab_1").addClass('active');
            $("#2, #3").removeClass('active');
            $("#tab_2, #tab_3").removeClass('active');
        } else if(pageName == 2){
            $("#2").addClass('active');
            $("#tab_2").addClass('active');
            $("#1, #3").removeClass('active');
            $("#tab_1, #tab_3").removeClass('active');
        }else if(pageName == 3){
            $("#3").addClass('active');
            $("#tab_3").addClass('active');
            $("#1, #2").removeClass('active');
            $("#tab_1, #tab_2").removeClass('active');
        }
    });
</script>
       
<script>
    $("#work_shift_name").change(function() {
        $('input[type="checkbox"]').prop('checked', false).removeClass('fullDayClass halfDayClass weekendDayClass');
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_work_shedule_ajax",
            data: {
                'work_shift_name': $('#work_shift_name').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                var all_1 = 0;
                var all_2 = 0;
                var all_3 = 0;
                var all_4 = 0;
                var all_5 = 0;
                var all_6 = 0;
                var all_7 = 0;
                for (var i = 0; i < parsedData.length; i++) {

                    // sunday **************************

                    if (parsedData[i].sunday_status === '1') {
                        all_1++;
                        if (parsedData[i].week === '1') {
                            $('#sun_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#sun_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#sun_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#sun_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#sun_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_1 == '6') {
                                all_1 = 0;
                                $('#sun_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#sun_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].sunday_status === '2') {
                        all_1++;
                        if (parsedData[i].week === '1') {
                            $('#sun_check_one').prop('checked', true).addClass('halfDayClass');;
                        } else if (parsedData[i].week === '2') {
                            $('#sun_check_second').prop('checked', true).addClass('halfDayClass');;
                        } else if (parsedData[i].week === '3') {
                            $('#sun_check_third').prop('checked', true).addClass('halfDayClass');;
                        } else if (parsedData[i].week === '4') {
                            $('#sun_check_fourth').prop('checked', true).addClass('halfDayClass');;
                        } else if (parsedData[i].week === '5') {
                            $('#sun_check_fifth').prop('checked', true).addClass('halfDayClass');;
                        } else if (parsedData[i].week === '6') {
                            if (all_1 == '6') {
                                all_1 = 0;
                                $('#sun_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#sun_check_six').prop('checked', true).addClass('halfDayClass');;
                        }



                    } else if (parsedData[i].sunday_status == '3') {
                        all_1++;
                        if (parsedData[i].week === '1') {
                            $('#sun_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#sun_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#sun_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#sun_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#sun_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_1 == '6') {
                                all_1 = 0;
                                $('#sun_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#sun_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }


                    // monday **************************

                    if (parsedData[i].monday_status === '1') {
                        all++;
                        if (parsedData[i].week === '1') {
                            $('#mon_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#mon_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#mon_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#mon_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#mon_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_1 == '6') {
                                all = 0;
                                $('#mon_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#mon_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].monday_status === '2') {

                        all_2++;
                        if (parsedData[i].week === '1') {
                            $('#mon_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#mon_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#mon_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#mon_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#mon_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_2 == '6') {
                                all_2 = 0;
                                $('#mon_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#mon_check_six').prop('checked', true).addClass('halfDayClass');
                        }

                    } else if (parsedData[i].monday_status === '3') {
                        all_2++;
                        if (parsedData[i].week === '1') {
                            $('#mon_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#mon_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#mon_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#mon_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#mon_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_2 == '6') {
                                all_2 = 0;
                                $('#mon_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#mon_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }


                    // tueday **************************

                    if (parsedData[i].tuesday_status === '1') {

                        all_3++;
                        if (parsedData[i].week === '1') {
                            $('#tue_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#tue_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#tue_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#tue_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#tue_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_3 == '6') {
                                all_3 = 0;
                                $('#tue_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#tue_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].tuesday_status === '2') {
                        all_3++;
                        if (parsedData[i].week === '1') {
                            $('#tue_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#tue_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#tue_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#tue_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#tue_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_3 == '6') {
                                all_3 = 0;
                                $('#tue_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#tue_check_six').prop('checked', true).addClass('halfDayClass');
                        }


                    } else if (parsedData[i].tuesday_status === '3') {
                        all_3++;
                        if (parsedData[i].week === '1') {
                            $('#tue_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#tue_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#tue_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#tue_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#tue_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_3 == '6') {
                                all_3 = 0;
                                $('#tue_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#tue_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }


                    // wedsday **************************


                    if (parsedData[i].wednesday_status === '1') {
                        all_4++;
                        if (parsedData[i].week === '1') {
                            $('#wed_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#wed_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#wed_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#wed_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#wed_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_4 == '6') {
                                all_4 = 0;
                                $('#wed_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#wed_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].wednesday_status === '2') {
                        all_4++;
                        if (parsedData[i].week === '1') {
                            $('#wed_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#wed_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#wed_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#wed_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#wed_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_4 == '6') {
                                all_4 = 0;
                                $('#wed_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#wed_check_six').prop('checked', true).addClass('halfDayClass');
                        }


                    } else if (parsedData[i].wednesday_status === '3') {
                        all_4++;
                        if (parsedData[i].week === '1') {
                            $('#wed_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#wed_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#wed_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#wed_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#wed_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_4 == '6') {
                                all_4 = 0;
                                $('#wed_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#wed_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }




                    // thursday **************************



                    if (parsedData[i].thursday_status === '1') {
                        all_5++;
                        if (parsedData[i].week === '1') {
                            $('#thu_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#thu_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#thu_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#thu_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#thu_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_5 == '6') {
                                all_5 = 0;
                                $('#thu_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#thu_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].thursday_status === '2') {
                        all_5++;
                        if (parsedData[i].week === '1') {
                            $('#thu_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#thu_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#thu_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#thu_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#thu_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_5 == '6') {
                                all_5 = 0;
                                $('#thu_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#thu_check_six').prop('checked', true).addClass('halfDayClass');
                        }


                    } else if (parsedData[i].thursday_status === '3') {
                        all_5++;
                        if (parsedData[i].week === '1') {
                            $('#thu_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#thu_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#thu_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#thu_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#thu_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_5 == '6') {
                                all_5 = 0;
                                $('#thu_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#thu_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }




                    // friday **************************


                    if (parsedData[i].friday_status === '1') {
                        all_6++;
                        if (parsedData[i].week === '1') {
                            $('#fri_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#fri_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#fri_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#fri_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#fri_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_6 == '6') {
                                all_6 = 0;
                                $('#fri_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#fri_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].friday_status === '2') {
                        all_6++;
                        if (parsedData[i].week === '1') {
                            $('#fri_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#fri_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#fri_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#fri_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#fri_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_6 == '6') {
                                all_6 = 0;
                                $('#fri_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#fri_check_six').prop('checked', true).addClass('halfDayClass');
                        }


                    } else if (parsedData[i].friday_status === '3') {
                        all_6++;
                        if (parsedData[i].week === '1') {
                            $('#fri_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#fri_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#fri_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#fri_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#fri_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_6 == '6') {
                                all_6 = 0;
                                $('#fri_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#fri_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }



                    // satday **************************


                    if (parsedData[i].saturday_status === '1') {
                        all_7++;
                        if (parsedData[i].week === '1') {
                            $('#sat_check_one').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#sat_check_second').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#sat_check_third').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#sat_check_fourth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#sat_check_fifth').prop('checked', true).addClass('fullDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_7 == '6') {
                                console.log(all_7);
                                all_7 = 0;
                                $('#sat_check_all').prop('checked', true).addClass('fullDayClass');
                            }
                            $('#sat_check_six').prop('checked', true).addClass('fullDayClass');
                        }

                    } else if (parsedData[i].saturday_status === '2') {
                        all_7++;
                        if (parsedData[i].week === '1') {
                            $('#sat_check_one').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#sat_check_second').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#sat_check_third').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#sat_check_fourth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#sat_check_fifth').prop('checked', true).addClass('halfDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_7 == '6') {
                                all_7 = 0;
                                $('#sat_check_all').prop('checked', true).addClass('halfDayClass');
                            }
                            $('#sat_check_six').prop('checked', true).addClass('halfDayClass');
                        }


                    } else if (parsedData[i].saturday_status === '3') {
                        all_7++;
                        if (parsedData[i].week === '1') {
                            $('#sat_check_one').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '2') {
                            $('#sat_check_second').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '3') {
                            $('#sat_check_third').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '4') {
                            $('#sat_check_fourth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '5') {
                            $('#sat_check_fifth').prop('checked', true).addClass('weekendDayClass');
                        } else if (parsedData[i].week === '6') {
                            if (all_7 == '6') {
                                all_7 = 0;
                                $('#sat_check_all').prop('checked', true).addClass('weekendDayClass');
                            }
                            $('#sat_check_six').prop('checked', true).addClass('weekendDayClass');
                        }


                    }

                }

            },
        });
    });
</script>

<script>


    $("#shift_in_time").change(function() {
        
        var rule_data = <?php echo json_encode($single_rules) ?>;
        var salon_open_time = timeToMinutes(rule_data.salon_start_time);
        var in_time =  timeToMinutes($('#shift_in_time').val());
        if (salon_open_time >  in_time) {
            $('#validationMessage1').text('You can not select a time before the salon opens time!').show();
            $('#shift_in_time').val(" ");
        } else {
            $('#validationMessage1').hide();
        }
    });


    $("#shift_out_time").change(function() {
        var rule_data = <?php echo json_encode($single_rules) ?>;

        var salon_open_time = timeToMinutes($("#shift_in_time").val());
        var salon_close_time = timeToMinutes(rule_data.salon_end_time);
        var out_time =  timeToMinutes($("#shift_out_time").val());

        console.log(salon_open_time);
        console.log(salon_close_time);
        console.log(out_time);

        if (((salon_close_time > out_time) && (salon_open_time < out_time))) {
            $('#validationMessage2').text('You cannot select a time after the salon closing time!').show();
            $('#shift_out_time').val(" ");
        } else {
            $('#validationMessage2').hide();
        }
    });

    $("#lunch_start_time").change(function() {
        var shift_in_time = timeToMinutes($('#shift_in_time').val());
        var shift_out_time = timeToMinutes($('#shift_out_time').val());
        var lunch_start_time = timeToMinutes($('#lunch_start_time').val());

        if (lunch_start_time >= shift_in_time && lunch_start_time <= shift_out_time) {
            $('#lunchStart_message').hide();
        } else {
            $('#lunchStart_message').text('Please select time according to shift time!').show();
            $('#lunch_start_time').val(" ");

        }

    });
    $("#lunch_close_time").change(function() {
        var shift_in_time = timeToMinutes($('#shift_in_time').val());
        var shift_out_time = timeToMinutes($('#shift_out_time').val());
        var lunch_start_time = timeToMinutes($('#lunch_start_time').val());
        var lunch_close_time = timeToMinutes($('#lunch_close_time').val());
        var yes=0;

        if ((lunch_close_time <= shift_out_time) && (lunch_close_time >= shift_in_time)) {
            if(lunch_close_time > lunch_start_time){
               $('#lunchclose_message').hide();
               yes=1;
            }
        }
        if(yes == 0){
            $('#lunchclose_message').text('Please select time according to shift time!').show();
            $('#lunch_close_time').val(" ");

        }

    });

    function timeToMinutes(time) {
    var splitTime = time.split(":");
    var hours = parseInt(splitTime[0]);
    var minutes = parseInt(splitTime[1]);

    return parseInt(hours * 60 + minutes);
}
</script>

<script>
        $(document).ready(function () {     
           
            $('#salon_time_form').validate({
                rules: {
                    salon_start_time: {
                        required: true,
                    },
                    salon_end_time: {
                        required: true,
                    },
                },
                messages: {
                    salon_start_time: {
                        required: "Please select salon start time!", 
                    },
                    salon_end_time: {
                        required: "Please select salon end time!", 
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
</script>

<script>
    $(document).ready(function() {
        $('#work_shedule_form').validate({
            ignore: "hidden",
            rules: {
                shift_name: {
                    required: true,
                },
            },
            messages: {
                shift_name: {
                    required: "Please select shift name!",
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
        $('#shift_form').validate({
            ignore: "hidden",
            rules: {
                shift_name: {
                    required: true,
                },
                shift_in_time: {
                    required: true,
                },
                shift_out_time: {
                    required: true,
                },
                lunch_start_time: {
                    required: true,
                },
                lunch_close_time: {
                    required: true,
                },
            },
            messages: {
                shift_name: {
                    required: "Please enter shift name!",
                },
                shift_in_time: {
                    required: "Please enter shift start time!",
                },
                shift_out_time: {
                    required: "Please enter shift end time!",
                },
                lunch_start_time: {
                    required: "Please enter lunch start time!",
                },
                lunch_close_time: {
                    required: "Please enter lunch end time!",
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
    $(document).ready(function() {

        var oldExportAction = function(self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };

        var newExportAction = function(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;

            dt.one('preXhr', function(e, s, data) {
                data.start = 0;
                data.length = 2147483647;

                dt.one('preDraw', function(e, settings) {
                    oldExportAction(self, e, dt, button, config);

                    dt.one('preXhr', function(e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });

                    setTimeout(dt.ajax.reload, 0);

                    return false;
                });
            });


            dt.ajax.reload();
        };

        var date = '<?php if (isset($_GET['date'])) {
                        echo $_GET['date'];
                    } else {
                        echo "";
                    } ?>';
        var month = '<?php if (isset($_GET['month'])) {
                            echo $_GET['month'];
                        } else {
                            echo "";
                        } ?>';
        var year = '<?php if (isset($_GET['year'])) {
                        echo $_GET['year'];
                    } else {
                        echo "";
                    } ?>';
        var table = $('.example').DataTable({
            "lengthChange": true,
            'searching': true,
            "processing": true,
            "serverSide": true,

            "cache": false,
            "order": [
                [0, "desc"]
            ],
            dom: 'Blfrtip',

            buttons: [

                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            lengthMenu: [
                [10, 25, 50],
                [10, 25, 50]
            ],
            "ajax": {
                "url": "<?= base_url(); ?>salon/Ajax_controller/get_holiday_days_list_ajx",
                "type": "POST",
                "data": {
                    'date': date,
                    'month': month,
                    'year': year
                },
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();
            },
        });
    });
</script>

<script>
    $(document).ready(function() {

        $(".btn-light").click(function() {

            $("#myModal").modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#store-setting .child_menu').show();
        $('#store-setting').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.booking_rules').addClass('active_cc');
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,

        });
    });
    $("#package_form").validate({
        rules: {
            schedule_name: "required",

        },
        messages: {
            schedule_name: " Please enter work schedule name!",


        },
        submitHandler: function(form) {
            var fields = $("input[type='checkbox']").serializeArray();

            if (fields.length === 0) {

                $('.checkbox_error').text('Please select atleast one checkbox.');
                return false;
            } else {

                form.submit();
            }

        }
    });

    function JXX_Check() {

    }

    $("#enquiry_status ").keyup(function() {

        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/ajax_controller/get_unique_enquiry_status_ajax",
            data: {
                'name': $("#enquiry_status ").val(),
                'table_name': "tbl_enquiry_status",
                'id': '<?= $id ?>'
            },

            success: function(data) {
                if (data == "0") {
                    $(".status_error").html("");

                    $("#submit_button").attr('disabled', false);
                } else {
                    $(".status_error").html("Enquiry Status is already added.");

                    $("#submit_button").attr('disabled', true);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#sun_check_all').click(function() {

        if ($(this).is(":checked")) {
            $("#exampleModal").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");

            $('#input_class').val('sun_check_all');
        } else {
            $('.sun_checkBox').prop('checked', false);
            $('.sun_check_all').removeClass('fullDayClass');
            $('.sun_check_all').removeClass('halfDayClass');
            $('.sun_check_all').removeClass('weekendDayClass');
        }
    });
    $('#mon_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('mon_check_all');
        } else {
            $('.mon_checkBox').prop('checked', false);
            $('.mon_check_all').removeClass('fullDayClass');
            $('.mon_check_all').removeClass('halfDayClass');
            $('.mon_check_all').removeClass('weekendDayClass');
            $('.mon_checkBox').removeClass('fullDayClass');
            $('.mon_checkBox').removeClass('halfDayClass');
            $('.mon_checkBox').removeClass('weekendDayClass');
            $('.mon_checkBox').val('');
        }
    });
    $('#tue_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('tue_check_all');
        } else {
            $('.tue_checkBox').prop('checked', false);
            $('.tue_check_all').removeClass('fullDayClass');
            $('.tue_check_all').removeClass('halfDayClass');
            $('.tue_check_all').removeClass('weekendDayClass');
            $('.tue_checkBox').removeClass('fullDayClass');
            $('.tue_checkBox').removeClass('halfDayClass');
            $('.tue_checkBox').removeClass('weekendDayClass');
            $('.tue_checkBox').val('');
        }
    });
    $('#wed_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('wed_check_all');
        } else {
            $('.wed_checkBox').prop('checked', false);
            $('.wed_check_all').removeClass('fullDayClass');
            $('.wed_check_all').removeClass('halfDayClass');
            $('.wed_check_all').removeClass('weekendDayClass');
            $('.wed_checkBox').removeClass('fullDayClass');
            $('.wed_checkBox').removeClass('halfDayClass');
            $('.wed_checkBox').removeClass('weekendDayClass');
            $('.wed_checkBox').val('');
        }
    });
    $('#thu_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('thu_check_all');
        } else {
            $('.thu_checkBox').prop('checked', false);
            $('.thu_check_all').removeClass('fullDayClass');
            $('.thu_check_all').removeClass('halfDayClass');
            $('.thu_check_all').removeClass('weekendDayClass');
            $('.thu_checkBox').removeClass('fullDayClass');
            $('.thu_checkBox').removeClass('halfDayClass');
            $('.thu_checkBox').removeClass('weekendDayClass');
            $('.thu_checkBox').val('');
        }
    });
    $('#fri_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");

            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('fri_check_all');
        } else {
            $('.fri_checkBox').prop('checked', false);
            $('.fri_check_all').removeClass('fullDayClass');
            $('.fri_check_all').removeClass('halfDayClass');
            $('.fri_check_all').removeClass('weekendDayClass');
            $('.fri_checkBox').removeClass('fullDayClass');
            $('.fri_checkBox').removeClass('halfDayClass');
            $('.fri_checkBox').removeClass('weekendDayClass');
            $('.fri_checkBox').val('');
        }
    });
    $('#sat_check_all').click(function() {
        if ($(this).is(":checked")) {

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('sat_check_all');
        } else {

            $('.sat_checkBox').prop('checked', false);
            $('.sat_check_all').removeClass('fullDayClass');
            $('.sat_check_all').removeClass('halfDayClass');
            $('.sat_check_all').removeClass('weekendDayClass');
            $('.sat_checkBox').removeClass('fullDayClass');
            $('.sat_checkBox').removeClass('halfDayClass');
            $('.sat_checkBox').removeClass('weekendDayClass');
            $('.sat_checkBox').val('');
        }
    });



    $('.sun_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#sun_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');

            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }

    });
    $('.mon_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#mon_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });
    $('.tue_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#tue_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });
    $('.wed_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#wed_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });
    $('.thu_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#thu_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });
    $('.fri_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#fri_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });
    $('.sat_checkBox').click(function() {
        if ($(this).prop("checked") == false) {
            $('#sat_check_all').prop('checked', false);
        }
        if ($(this).prop("checked") == true) {
            var checkBox_value = $(this).attr('id');
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val(checkBox_value);
        }
    });


    function saveDayType() {
        $("#exampleModal1").modal("hide");
        $("#exampleModal").css("display", "none");
        $("#exampleModal").css("opacity", "0");
        var inputClass = $('#input_class').val();

        var dayType = $('#day_type').val();
        var dayTypeClass = '';
        if (dayType == '1') {
            dayTypeClass = 'fullDayClass';
        } else if (dayType == '2') {
            dayTypeClass = 'halfDayClass';
        } else if (dayType == '3') {
            dayTypeClass = 'weekendDayClass';
        }

        if (inputClass == 'sun_check_all') {
            $('.sun_checkBox').removeClass('fullDayClass');
            $('.sun_checkBox').removeClass('halfDayClass');
            $('.sun_checkBox').removeClass('weekendDayClass');
            $('.sun_check_all').removeClass('fullDayClass');
            $('.sun_check_all').removeClass('halfDayClass');
            $('.sun_check_all').removeClass('weekendDayClass');

            $('.sun_check_all').prop('checked', true);
            $('.sun_checkBox').prop('checked', true);
            $('.sun_checkBox').val(dayType);

            $('.sun_checkBox').addClass(dayTypeClass);
            $('.sun_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'mon_check_all') {
            $('.mon_checkBox').removeClass('fullDayClass');
            $('.mon_checkBox').removeClass('halfDayClass');
            $('.mon_checkBox').removeClass('weekendDayClass');
            $('.mon_check_all').removeClass('fullDayClass');
            $('.mon_check_all').removeClass('halfDayClass');
            $('.mon_check_all').removeClass('weekendDayClass');

            $('.mon_check_all').prop('checked', true);
            $('.mon_checkBox').prop('checked', true);
            $('.mon_checkBox').val(dayType);

            $('.mon_checkBox').addClass(dayTypeClass);
            $('.mon_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'tue_check_all') {
            $('.tue_checkBox').removeClass('fullDayClass');
            $('.tue_checkBox').removeClass('halfDayClass');
            $('.tue_checkBox').removeClass('weekendDayClass');
            $('.tue_check_all').removeClass('fullDayClass');
            $('.tue_check_all').removeClass('halfDayClass');
            $('.tue_check_all').removeClass('weekendDayClass');

            $('.tue_check_all').prop('checked', true);
            $('.tue_checkBox').prop('checked', true);
            $('.tue_checkBox').val(dayType);

            $('.tue_checkBox').addClass(dayTypeClass);
            $('.tue_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'wed_check_all') {
            $('.wed_checkBox').removeClass('fullDayClass');
            $('.wed_checkBox').removeClass('halfDayClass');
            $('.wed_checkBox').removeClass('weekendDayClass');
            $('.wed_check_all').removeClass('fullDayClass');
            $('.wed_check_all').removeClass('halfDayClass');
            $('.wed_check_all').removeClass('weekendDayClass');

            $('.wed_check_all').prop('checked', true);
            $('.wed_checkBox').prop('checked', true);
            $('.wed_checkBox').val(dayType);

            $('.wed_checkBox').addClass(dayTypeClass);
            $('.wed_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'thu_check_all') {
            $('.thu_checkBox').removeClass('fullDayClass');
            $('.thu_checkBox').removeClass('halfDayClass');
            $('.thu_checkBox').removeClass('weekendDayClass');
            $('.thu_check_all').removeClass('fullDayClass');
            $('.thu_check_all').removeClass('halfDayClass');
            $('.thu_check_all').removeClass('weekendDayClass');

            $('.thu_check_all').prop('checked', true);
            $('.thu_checkBox').prop('checked', true);
            $('.thu_checkBox').val(dayType);

            $('.thu_checkBox').addClass(dayTypeClass);
            $('.thu_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'fri_check_all') {
            $('.fri_checkBox').removeClass('fullDayClass');
            $('.fri_checkBox').removeClass('halfDayClass');
            $('.fri_checkBox').removeClass('weekendDayClass');
            $('.fri_check_all').removeClass('fullDayClass');
            $('.fri_check_all').removeClass('halfDayClass');
            $('.fri_check_all').removeClass('weekendDayClass');

            $('.fri_check_all').prop('checked', true);
            $('.fri_checkBox').prop('checked', true);
            $('.fri_checkBox').val(dayType);
            $('.fri_checkBox').addClass(dayTypeClass);
            $('.fri_check_all').addClass(dayTypeClass);
        } else if (inputClass == 'sat_check_all') {
            $('.sat_checkBox').removeClass('fullDayClass');
            $('.sat_checkBox').removeClass('halfDayClass');
            $('.sat_checkBox').removeClass('weekendDayClass');
            $('.sat_check_all').removeClass('fullDayClass');
            $('.sat_check_all').removeClass('halfDayClass');
            $('.sat_check_all').removeClass('weekendDayClass');

            $('.sat_check_all').prop('checked', true);
            $('.sat_checkBox').prop('checked', true);
            $('.sat_checkBox').val(dayType);

            $('.sat_checkBox').addClass(dayTypeClass);
            $('.sat_check_all').addClass(dayTypeClass);
        } else {
            $('#' + inputClass).removeClass('fullDayClass');
            $('#' + inputClass).removeClass('halfDayClass');
            $('#' + inputClass).removeClass('weekendDayClass');

            $('#' + inputClass).prop('checked', true);
            $('#' + inputClass).val(dayType);

            $('#' + inputClass).addClass(dayTypeClass);
            $('#' + inputClass).addClass(dayTypeClass);
        }
    }

    function closeModal() {
        $("#exampleModal1").modal("hide");
        $("#exampleModal").css("display", "none");
        $("#exampleModal").css("opacity", "0");

        var inputClass = $('#input_class').val();

        if (inputClass == 'sun_check_all') {
            $('.sun_check_all').prop('checked', false);
            $('.sun_checkBox').prop('checked', false);
        } else if (inputClass == 'mon_check_all') {
            $('.mon_check_all').prop('checked', false);
            $('.mon_checkBox').prop('checked', false);
        } else if (inputClass == 'tue_check_all') {
            $('.tue_check_all').prop('checked', false);
            $('.tue_checkBox').prop('checked', false);
        } else if (inputClass == 'wed_check_all') {
            $('.wed_check_all').prop('checked', false);
            $('.wed_checkBox').prop('checked', false);
        } else if (inputClass == 'thu_check_all') {
            $('.thu_check_all').prop('checked', false);
            $('.thu_checkBox').prop('checked', false);
        } else if (inputClass == 'fri_check_all') {
            $('.fri_check_all').prop('checked', false);
            $('.fri_checkBox').prop('checked', false);
        } else if (inputClass == 'sat_check_all') {
            $('.sat_check_all').prop('checked', false);
            $('.sat_checkBox').prop('checked', false);
        } else {
            $('#' + inputClass).prop('checked', false);
        }
    }
</script>


<script>
    $(document).ready(function() {

        var oldExportAction = function(self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };

        var newExportAction = function(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;

            dt.one('preXhr', function(e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;

                dt.one('preDraw', function(e, settings) {
                    // Call the original action function 
                    oldExportAction(self, e, dt, button, config);

                    dt.one('preXhr', function(e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });

                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);

                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });

            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        };

        var date = '<?php if (isset($_GET['date'])) {
                        echo $_GET['date'];
                    } else {
                        echo "";
                    } ?>';
        var month = '<?php if (isset($_GET['month'])) {
                            echo $_GET['month'];
                        } else {
                            echo "";
                        } ?>';
        var year = '<?php if (isset($_GET['year'])) {
                        echo $_GET['year'];
                    } else {
                        echo "";
                    } ?>';
        var table = $('.example').DataTable({
            "lengthChange": true,
            'searching': true,
            "processing": true,
            "serverSide": true,

            "cache": false,
            "order": [
                [0, "desc"]
            ],
            dom: 'Blfrtip',

            buttons: [

                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            lengthMenu: [
                [10, 25, 50],
                [10, 25, 50]
            ],
            "ajax": {
                "url": "<?= base_url(); ?>salon/Ajax_controller/get_holiday_days_list_ajx",
                "type": "POST",
                "data": {
                    'date': date,
                    'month': month,
                    'year': year
                },
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();
            },
        });
    });
</script>
<script>
   
    $(document).ready(function() {
        $(".btn-light").click(function() {
            $("#myModal").modal('show');
        });
    });
</script>

<!-- work shedule script -->

<script>
	$(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
            /*callbacks: {
                onKeyup: function(e) {
                    setTimeout(function() {
                        $(".store_input").val($('#template_footer').attr('id'));
                    }, 200);
                }
            }*/
        });
	});
	$("#package_form").validate({
		rules: {
			schedule_name: "required",
			//'sun_check[]': "required",
		},
		messages: {
			schedule_name: " Please enter work schedule name!",
			//'sun_check[]': "Please select!",

		},
		submitHandler: function(form) {
			var fields = $("input[type='checkbox']").serializeArray(); 
			//alert(fields);
			if (fields.length === 0){ 
				//alert('Atleast one checkbox select.'); 
				// cancel submit
				$('.checkbox_error').text('Please select atleast one checkbox.');
				return false;
			}else{ 
				//alert(fields.length + " items selected"); 
				form.submit();
			}
			//form.submit();
		}
	});
	function JXX_Check(){
		
	}
	/*$('#package_form').submit(function(event) {
        // prevent form submission
        event.preventDefault();
		
		// get the value of the input field
        var inputValue = $('#schedule_name').val();
		
		if(inputValue === ''){
			$('.input_error').text(' Please enter work schedule name!');
		}else{
			$('.input_error').text('');
		}
        
        // check if at least one checkbox is checked
        if ($('input[name="sun_check[]"]').is(':checked')) {
            alert('At least one checkbox is checked!');
        } else {
            alert('Please check at least one checkbox.');
        }
    });*/
	$("#enquiry_status ").keyup(function() {
		// alert("Hiii");
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>admin/ajax_controller/get_unique_enquiry_status_ajax",
			data: {
				'name': $("#enquiry_status ").val(),
				'table_name': "tbl_enquiry_status",
				'id': '<?=$id?>'
			},

			success: function(data) {
				if (data == "0") {
					$(".status_error").html("");

					$("#submit_button").attr('disabled', false);
				} else {
					$(".status_error").html("Enquiry Status is already added.");

					$("#submit_button").attr('disabled', true);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	
	$('#sun_check_all').click(function(){
        
		if($(this).is(":checked")){
			$("#exampleModal").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			//$('.sun_checkBox').prop('checked',true);
			$('#input_class').val('sun_check_all');
		}else{
			$('.sun_checkBox').prop('checked',false);
			$('.sun_check_all').removeClass('fullDayClass');
			$('.sun_check_all').removeClass('halfDayClass');
			$('.sun_check_all').removeClass('weekendDayClass');
		}
	});
	$('#mon_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.mon_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('mon_check_all');
		}else{
			$('.mon_checkBox').prop('checked',false);
			$('.mon_check_all').removeClass('fullDayClass');
			$('.mon_check_all').removeClass('halfDayClass');
			$('.mon_check_all').removeClass('weekendDayClass');
			$('.mon_checkBox').removeClass('fullDayClass');
			$('.mon_checkBox').removeClass('halfDayClass');
			$('.mon_checkBox').removeClass('weekendDayClass');
			$('.mon_checkBox').val('');
		}
	});
	$('#tue_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.tue_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('tue_check_all');
		}else{
			$('.tue_checkBox').prop('checked',false);
			$('.tue_check_all').removeClass('fullDayClass');
			$('.tue_check_all').removeClass('halfDayClass');
			$('.tue_check_all').removeClass('weekendDayClass');
			$('.tue_checkBox').removeClass('fullDayClass');
			$('.tue_checkBox').removeClass('halfDayClass');
			$('.tue_checkBox').removeClass('weekendDayClass');
			$('.tue_checkBox').val('');
		}
	});
	$('#wed_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.wed_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('wed_check_all');
		}else{
			$('.wed_checkBox').prop('checked',false);
			$('.wed_check_all').removeClass('fullDayClass');
			$('.wed_check_all').removeClass('halfDayClass');
			$('.wed_check_all').removeClass('weekendDayClass');
			$('.wed_checkBox').removeClass('fullDayClass');
			$('.wed_checkBox').removeClass('halfDayClass');
			$('.wed_checkBox').removeClass('weekendDayClass');
			$('.wed_checkBox').val('');
		}
	});
	$('#thu_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.thu_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('thu_check_all');
		}else{
			$('.thu_checkBox').prop('checked',false);
			$('.thu_check_all').removeClass('fullDayClass');
			$('.thu_check_all').removeClass('halfDayClass');
			$('.thu_check_all').removeClass('weekendDayClass');
			$('.thu_checkBox').removeClass('fullDayClass');
			$('.thu_checkBox').removeClass('halfDayClass');
			$('.thu_checkBox').removeClass('weekendDayClass');
			$('.thu_checkBox').val('');
		}
	});
	$('#fri_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.fri_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('fri_check_all');
		}else{
			$('.fri_checkBox').prop('checked',false);
			$('.fri_check_all').removeClass('fullDayClass');
			$('.fri_check_all').removeClass('halfDayClass');
			$('.fri_check_all').removeClass('weekendDayClass');
			$('.fri_checkBox').removeClass('fullDayClass');
			$('.fri_checkBox').removeClass('halfDayClass');
			$('.fri_checkBox').removeClass('weekendDayClass');
			$('.fri_checkBox').val('');
		}
	});
	$('#sat_check_all').click(function(){
		if($(this).is(":checked")){
			//$('.sat_checkBox').prop('checked',true);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val('sat_check_all');
		}else{
			//alert('Yes');
			$('.sat_checkBox').prop('checked',false);
			$('.sat_check_all').removeClass('fullDayClass');
			$('.sat_check_all').removeClass('halfDayClass');
			$('.sat_check_all').removeClass('weekendDayClass');
			$('.sat_checkBox').removeClass('fullDayClass');
			$('.sat_checkBox').removeClass('halfDayClass');
			$('.sat_checkBox').removeClass('weekendDayClass');
			$('.sat_checkBox').val('');
		}
	});
	
	
	
	$('.sun_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#sun_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			//alert(checkBox_value);
			$("#exampleModal1").modal("show");
            $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
		
	});
	$('.mon_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#mon_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.tue_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#tue_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.wed_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#wed_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.thu_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#thu_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.fri_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#fri_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.sat_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#sat_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal1").modal("show");
             $("#exampleModal").css("display","block");
            $("#exampleModal").css("opacity","1");
			$('#input_class').val(checkBox_value);
		}
	});
	
	
	function saveDayType(){
		$("#exampleModal1").modal("hide");
        $("#exampleModal").css("display","none");
        $("#exampleModal").css("opacity","0");
		var inputClass = $('#input_class').val();
		
		var dayType = $('#day_type').val();
		var dayTypeClass = '';
		if(dayType == '1'){
			dayTypeClass = 'fullDayClass';
		}else if(dayType == '2'){
			dayTypeClass = 'halfDayClass';
		}else if(dayType == '3'){
			dayTypeClass = 'weekendDayClass';
		}
		
		if(inputClass == 'sun_check_all'){
			$('.sun_checkBox').removeClass('fullDayClass');
			$('.sun_checkBox').removeClass('halfDayClass');
			$('.sun_checkBox').removeClass('weekendDayClass');
			$('.sun_check_all').removeClass('fullDayClass');
			$('.sun_check_all').removeClass('halfDayClass');
			$('.sun_check_all').removeClass('weekendDayClass');
			
			$('.sun_check_all').prop('checked',true);
			$('.sun_checkBox').prop('checked',true);
			$('.sun_checkBox').val(dayType);
			
			$('.sun_checkBox').addClass(dayTypeClass);
			$('.sun_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'mon_check_all'){
			$('.mon_checkBox').removeClass('fullDayClass');
			$('.mon_checkBox').removeClass('halfDayClass');
			$('.mon_checkBox').removeClass('weekendDayClass');
			$('.mon_check_all').removeClass('fullDayClass');
			$('.mon_check_all').removeClass('halfDayClass');
			$('.mon_check_all').removeClass('weekendDayClass');
			
			$('.mon_check_all').prop('checked',true);
			$('.mon_checkBox').prop('checked',true);
			$('.mon_checkBox').val(dayType);
			
			$('.mon_checkBox').addClass(dayTypeClass);
			$('.mon_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'tue_check_all'){
			$('.tue_checkBox').removeClass('fullDayClass');
			$('.tue_checkBox').removeClass('halfDayClass');
			$('.tue_checkBox').removeClass('weekendDayClass');
			$('.tue_check_all').removeClass('fullDayClass');
			$('.tue_check_all').removeClass('halfDayClass');
			$('.tue_check_all').removeClass('weekendDayClass');
			
			$('.tue_check_all').prop('checked',true);
			$('.tue_checkBox').prop('checked',true);
			$('.tue_checkBox').val(dayType);
			
			$('.tue_checkBox').addClass(dayTypeClass);
			$('.tue_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'wed_check_all'){
			$('.wed_checkBox').removeClass('fullDayClass');
			$('.wed_checkBox').removeClass('halfDayClass');
			$('.wed_checkBox').removeClass('weekendDayClass');
			$('.wed_check_all').removeClass('fullDayClass');
			$('.wed_check_all').removeClass('halfDayClass');
			$('.wed_check_all').removeClass('weekendDayClass');
			
			$('.wed_check_all').prop('checked',true);
			$('.wed_checkBox').prop('checked',true);
			$('.wed_checkBox').val(dayType);
			
			$('.wed_checkBox').addClass(dayTypeClass);
			$('.wed_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'thu_check_all'){
			$('.thu_checkBox').removeClass('fullDayClass');
			$('.thu_checkBox').removeClass('halfDayClass');
			$('.thu_checkBox').removeClass('weekendDayClass');
			$('.thu_check_all').removeClass('fullDayClass');
			$('.thu_check_all').removeClass('halfDayClass');
			$('.thu_check_all').removeClass('weekendDayClass');
			
			$('.thu_check_all').prop('checked',true);
			$('.thu_checkBox').prop('checked',true);
			$('.thu_checkBox').val(dayType);
			
			$('.thu_checkBox').addClass(dayTypeClass);
			$('.thu_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'fri_check_all'){
			$('.fri_checkBox').removeClass('fullDayClass');
			$('.fri_checkBox').removeClass('halfDayClass');
			$('.fri_checkBox').removeClass('weekendDayClass');
			$('.fri_check_all').removeClass('fullDayClass');
			$('.fri_check_all').removeClass('halfDayClass');
			$('.fri_check_all').removeClass('weekendDayClass');
			
			$('.fri_check_all').prop('checked',true);
			$('.fri_checkBox').prop('checked',true);
			$('.fri_checkBox').val(dayType);
			$('.fri_checkBox').addClass(dayTypeClass);
			$('.fri_check_all').addClass(dayTypeClass);
		}else if(inputClass == 'sat_check_all'){
			$('.sat_checkBox').removeClass('fullDayClass');
			$('.sat_checkBox').removeClass('halfDayClass');
			$('.sat_checkBox').removeClass('weekendDayClass');
			$('.sat_check_all').removeClass('fullDayClass');
			$('.sat_check_all').removeClass('halfDayClass');
			$('.sat_check_all').removeClass('weekendDayClass');
			
			$('.sat_check_all').prop('checked',true);
			$('.sat_checkBox').prop('checked',true);
			$('.sat_checkBox').val(dayType);
			
			$('.sat_checkBox').addClass(dayTypeClass);
			$('.sat_check_all').addClass(dayTypeClass);
		}else{
			$('#'+inputClass).removeClass('fullDayClass');
			$('#'+inputClass).removeClass('halfDayClass');
			$('#'+inputClass).removeClass('weekendDayClass');
			
			$('#'+inputClass).prop('checked',true);
			$('#'+inputClass).val(dayType);
			
			$('#'+inputClass).addClass(dayTypeClass);
			$('#'+inputClass).addClass(dayTypeClass);
		}
	}
	
	function closeModal(){
		$("#exampleModal1").modal("hide");
        $("#exampleModal").css("display","none");
            $("#exampleModal").css("opacity","0");
		
		var inputClass = $('#input_class').val();
		
		if(inputClass == 'sun_check_all'){
			$('.sun_check_all').prop('checked',false);
			$('.sun_checkBox').prop('checked',false);
		}else if(inputClass == 'mon_check_all'){
			$('.mon_check_all').prop('checked',false);
			$('.mon_checkBox').prop('checked',false);
		}else if(inputClass == 'tue_check_all'){
			$('.tue_check_all').prop('checked',false);
			$('.tue_checkBox').prop('checked',false);
		}else if(inputClass == 'wed_check_all'){
			$('.wed_check_all').prop('checked',false);
			$('.wed_checkBox').prop('checked',false);
		}else if(inputClass == 'thu_check_all'){
			$('.thu_check_all').prop('checked',false);
			$('.thu_checkBox').prop('checked',false);
		}else if(inputClass == 'fri_check_all'){
			$('.fri_check_all').prop('checked',false);
			$('.fri_checkBox').prop('checked',false);
		}else if(inputClass == 'sat_check_all'){
			$('.sat_check_all').prop('checked',false);
			$('.sat_checkBox').prop('checked',false);
		}else{
			$('#'+inputClass).prop('checked',false);
		}
	}
</script>
  

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.working-hours').addClass('active_cc');
    });
</script>
<?php include('header.php'); ?>
<!-- page content -->
<div class="right_col" role="main">
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
        <div class="page-title">
            <div class="title_left">
                <h3>Add Booking Rules</h3>
            </div>
            <div class="title_right">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <div id="exTab3" class="container">
                                <div class="container st_container">
                                    <div class="scroller scroller-left"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
                                    <div class="scroller scroller-right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
                                    <div class="wrapper">
                                        <ul class="nav nav-tabs list" id="myTab">
                                            <li id="tab_1" class="tab-title active">
                                                <a href="#1a" data-toggle="tab"><b>Booking Policy</b></a>
                                            </li>

                                            <li id="tab_2" class="tab-title">
                                                <a href="#2a" data-toggle="tab"><b>Cancellation & Reschedule Policy</b></a>
                                            </li>
                                            <li id="tab_3" class="tab-title">
                                                <a href="#3a" data-toggle="tab"><b>Holiday</b></a>
                                            </li>
                                            <li id="tab_4" class="tab-title">
                                                <a href="#4a" data-toggle="tab"><b>Emergency Alert </b></a>
                                            </li>
                                            <li id="tab_5" class="tab-title">
                                                <a href="#5a" data-toggle="tab"><b>Price Variation</b></a>
                                            </li>
                                            <li id="tab_6" class="tab-title">
                                                <a href="#6a" data-toggle="tab"><b>Salon Type</b></a>
                                            </li>
                                            <li id="tab_7" class="tab-title ">
                                                <a href="#7a" data-toggle="tab"><b>Stylist Selection</b></a>
                                            </li>
                                            <li id="tab_8" class="tab-title">
                                                <a href="#8a" data-toggle="tab"><b>Notification</b></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="tab-content clearfix tab-content-box">



                                    <!-- Booking policy -->

                                    <div class="tab-pane active" id="1a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Customers Per Slot</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="per_session_stylist_form" id="per_session_stylist_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                    <label>In per slot how many customer can be able to booking.<b class="require">*</b></label>
                                                                    <div class="row cc_row">
                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                        <div class=" col-md-3 col-sm-3 col-xs-3">
                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="per_session_stylist" id="per_session_stylist" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                                                                                            echo $single_rules->per_session_stylist;
                                                                                                                                                                                                                                        } ?>">
                                                                        </div>
                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                    </div>
                                                                    <!-- <p>Set these options carefully because it will affect
                                                                        the number of bookings you can accept for the same
                                                                        time/session.</p> -->
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" value="per_session_stylist_btn" id="per_session_stylist_btn" name="per_session_stylist_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Slot Time</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="session_avg_duration_form" id="session_avg_duration_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                    <label>In per slot how many customer can able to accommodate.<b class="require">*</b></label>
                                                                    <div class="row cc_row">
                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                        <div class=" col-md-3 col-sm-3 col-xs-3">
                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="session_avg_duration" id="session_avg_duration" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                                                                                            echo $single_rules->session_avg_duration;
                                                                                                                                                                                                                                        } ?>">
                                                                        </div>
                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                    </div>
                                                                <p>We suggest you to set this option accordingly with
                                                                        the duration of your shortest service.</p> 
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" id="session_avg_duration_btn" name="session_avg_duration_btn" value="session_avg_duration_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Buffering Time</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="offset_session_time_form" id="offset_session_time_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                  
                                                                    <?php if (!empty($on_off_btn)) {
                                                                        $i = 1;
                                                                        foreach ($on_off_btn as $on_off_btn_result) { ?>
                                                                            <?php if ($on_off_btn_result->on_off_btn == "1") { ?>
                                                                                <label>Enable Offset<b class="require">*</b></label><br>
                                                                                <a title="On" onclick="return confirm('Are you sure to off buffer time?');" class="btn btn-light" href="<?= base_url() ?>off_btn_offset_session_time/<?= $on_off_btn_result->id ?>">
                                                                                    <i style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i>
                                                                                </a>
                                                                                <p>Do you want to turn off Offset?</p>
                                                                            <?php } else { ?>
                                                                                <label>Disable Offset<b class="require">*</b></label><br>
                                                                                <a title="Off" class="btn btn-light" onclick="return confirm('Are you sure to on buffer time?');" href="<?= base_url() ?>on_btn_offset_session_time/<?= $on_off_btn_result->id ?>">
                                                                                    <i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i>
                                                                                </a>
                                                                                <p>Do you want to turn on Offset?</p>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    
                                                                </div>
                                                                <?php if (!empty($on_off_btn)) {
                                                                        $i = 1;
                                                                        foreach ($on_off_btn as $on_off_btn_result) { ?>
                                                                            <?php if ($on_off_btn_result->on_off_btn == "1") { ?>
                                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                                    <label>This is time delays as per Slot Time.<b class="require">*</b></label>
                                                                                    <div class="row cc_row">
                                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                                        <div class=" col-md-3 col-sm-3 col-xs-3">
                                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="offset_session_time" id="offset_session_time" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {echo $single_rules->offset_session_time;} ?>">
                                                                                        </div>
                                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                                    </div><br>
                                                                                    <p>This is time within a “Slot Time” allows for the accommodation of potential delays.</p>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                               
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                            </div>
                                                            <div class="">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" id="offset_session_time_btn" name="offset_session_time_btn" value="offset_session_time_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Booking Time Range</h3>
                                                        <p>Duration within which customers can secure a time slot before the scheduled appointment.</p>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="booking_time_range_form" id="booking_time_range_form" enctype="multipart/form-data">
                                                            <div class="row cc_row">
                                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                                                                    <label>Select option in Hours.(Maximum)<b class="require">*</b></label>
                                                                    <div class="">
                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                        <div class=" col-md-6 col-sm-3 col-xs-3">
                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="hours" id="hours" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                                                                echo $single_rules->hours;
                                                                                                                                                                                                            } ?>">
                                                                        </div>
                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label>Select option in minute(Minimum).<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <Select name="days" id="days" class="form-control col-md-3">
                                                                                <?php if (!empty($single_rules->days)){ ?>
                                                                                    <option value="<?php $single_rules->days?>" ><?php $single_rules->days?></option>
                                                                                <?php }else{?>
                                                                                    <option value="">MM</option>
                                                                                <?php }?>
                                                                                <option value="00" <?php if (!empty($single_rules) && $single_rules->days == "00") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>00</option>
                                                                                <option value="01" <?php if (!empty($single_rules) && $single_rules->days == "01") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>01</option>
                                                                                <option value="02" <?php if (!empty($single_rules) && $single_rules->days == "02") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>02</option>
                                                                                <option value="03" <?php if (!empty($single_rules) && $single_rules->days == "03") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>03</option>
                                                                                <option value="04" <?php if (!empty($single_rules) && $single_rules->days == "04") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>04</option>
                                                                                <option value="05" <?php if (!empty($single_rules) && $single_rules->days == "05") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>05</option>
                                                                                <option value="06" <?php if (!empty($single_rules) && $single_rules->days == "06") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>06</option>
                                                                                <option value="07" <?php if (!empty($single_rules) && $single_rules->days == "07") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>07</option>
                                                                                <option value="08" <?php if (!empty($single_rules) && $single_rules->days == "08") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>08</option>
                                                                                <option value="09" <?php if (!empty($single_rules) && $single_rules->days == "09") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>09</option>
                                                                                <option value="10" <?php if (!empty($single_rules) && $single_rules->days == "10") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>10</option>
                                                                                <option value="11" <?php if (!empty($single_rules) && $single_rules->days == "11") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>11</option>
                                                                                <option value="12" <?php if (!empty($single_rules) && $single_rules->days == "12") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>12</option>
                                                                                <option value="13" <?php if (!empty($single_rules) && $single_rules->days == "13") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>13</option>
                                                                                <option value="14" <?php if (!empty($single_rules) && $single_rules->days == "14") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>14</option>
                                                                                <option value="15" <?php if (!empty($single_rules) && $single_rules->days == "15") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>15</option>
                                                                                <option value="16" <?php if (!empty($single_rules) && $single_rules->days == "16") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>16</option>
                                                                                <option value="17" <?php if (!empty($single_rules) && $single_rules->days == "17") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>17</option>
                                                                                <option value="18" <?php if (!empty($single_rules) && $single_rules->days == "18") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>18</option>
                                                                                <option value="19" <?php if (!empty($single_rules) && $single_rules->days == "19") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>19</option>
                                                                                <option value="20" <?php if (!empty($single_rules) && $single_rules->days == "20") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>20</option>
                                                                                <option value="21" <?php if (!empty($single_rules) && $single_rules->days == "21") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>21</option>
                                                                                <option value="22" <?php if (!empty($single_rules) && $single_rules->days == "22") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>22</option>
                                                                                <option value="23" <?php if (!empty($single_rules) && $single_rules->days == "23") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>23</option>
                                                                                <option value="24" <?php if (!empty($single_rules) && $single_rules->days == "24") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>24</option>
                                                                                <option value="25" <?php if (!empty($single_rules) && $single_rules->days == "25") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>25</option>
                                                                                <option value="26" <?php if (!empty($single_rules) && $single_rules->days == "26") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>26</option>
                                                                                <option value="27" <?php if (!empty($single_rules) && $single_rules->days == "27") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>27</option>
                                                                                <option value="28" <?php if (!empty($single_rules) && $single_rules->days == "28") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>28</option>
                                                                                <option value="29" <?php if (!empty($single_rules) && $single_rules->days == "29") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>29</option>
                                                                                <option value="30" <?php if (!empty($single_rules) && $single_rules->days == "30") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>30</option>
                                                                                <option value="31" <?php if (!empty($single_rules) && $single_rules->days == "31") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>31</option>
                                                                                <option value="32" <?php if (!empty($single_rules) && $single_rules->days == "32") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>32</option>
                                                                                <option value="33" <?php if (!empty($single_rules) && $single_rules->days == "33") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>33</option>
                                                                                <option value="34" <?php if (!empty($single_rules) && $single_rules->days == "34") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>34</option>
                                                                                <option value="35" <?php if (!empty($single_rules) && $single_rules->days == "35") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>35</option>
                                                                                <option value="36" <?php if (!empty($single_rules) && $single_rules->days == "36") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>36</option>
                                                                                <option value="37" <?php if (!empty($single_rules) && $single_rules->days == "37") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>37</option>
                                                                                <option value="38" <?php if (!empty($single_rules) && $single_rules->days == "38") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>38</option>
                                                                                <option value="39" <?php if (!empty($single_rules) && $single_rules->days == "39") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>39</option>
                                                                                <option value="40" <?php if (!empty($single_rules) && $single_rules->days == "40") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>40</option>
                                                                                <option value="41" <?php if (!empty($single_rules) && $single_rules->days == "41") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>41</option>
                                                                                <option value="42" <?php if (!empty($single_rules) && $single_rules->days == "42") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>42</option>
                                                                                <option value="43" <?php if (!empty($single_rules) && $single_rules->days == "43") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>43</option>
                                                                                <option value="44" <?php if (!empty($single_rules) && $single_rules->days == "44") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>44</option>
                                                                                <option value="45" <?php if (!empty($single_rules) && $single_rules->days == "45") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>45</option>
                                                                                <option value="46" <?php if (!empty($single_rules) && $single_rules->days == "46") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>46</option>
                                                                                <option value="47" <?php if (!empty($single_rules) && $single_rules->days == "47") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>47</option>
                                                                                <option value="48" <?php if (!empty($single_rules) && $single_rules->days == "48") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>48</option>
                                                                                <option value="49" <?php if (!empty($single_rules) && $single_rules->days == "49") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>49</option>
                                                                                <option value="50" <?php if (!empty($single_rules) && $single_rules->days == "50") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>50</option>
                                                                                <option value="51" <?php if (!empty($single_rules) && $single_rules->days == "51") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>51</option>
                                                                                <option value="52" <?php if (!empty($single_rules) && $single_rules->days == "52") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>52</option>
                                                                                <option value="53" <?php if (!empty($single_rules) && $single_rules->days == "53") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>53</option>
                                                                                <option value="54" <?php if (!empty($single_rules) && $single_rules->days == "54") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>54</option>
                                                                                <option value="55" <?php if (!empty($single_rules) && $single_rules->days == "55") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>55</option>
                                                                                <option value="56" <?php if (!empty($single_rules) && $single_rules->days == "56") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>56</option>
                                                                                <option value="57" <?php if (!empty($single_rules) && $single_rules->days == "57") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>57</option>
                                                                                <option value="58" <?php if (!empty($single_rules) && $single_rules->days == "58") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>58</option>
                                                                                <option value="59" <?php if (!empty($single_rules) && $single_rules->days == "59") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>59</option>
                                                                                <option value="60" <?php if (!empty($single_rules) && $single_rules->days == "60") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>60</option>

                                                                            </Select>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button style="margin-top: 30px;" type="submit" id="booking_time_range_btn" name="booking_time_range_btn" value="booking_time_range_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Booking Manual Confirmation</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="booking_manual_form" id="booking_manual_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                    <label>Activate the option to accept manual bookings.<b class="require">*</b></label><br>
                                                                    <?php if (!empty($booking_manual_btn)) {
                                                                        $i = 1;
                                                                        foreach ($booking_manual_btn as $booking_manual_btn_result) { ?>
                                                                            <?php if ($booking_manual_btn_result->booking_manual_btn == "1") { ?>
                                                                                <a title="On" onclick="return confirm('Are you sure to off this feild?');" class="btn btn-light" href="<?= base_url() ?>off_booking_manual_btn/<?= $booking_manual_btn_result->id ?>">
                                                                                    <i style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i>
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a title="Off" class="btn btn-light" onclick="return confirm('Are you sure to on this feild?');" href="<?= base_url() ?>on_booking_manual_btn/<?= $booking_manual_btn_result->id ?>">
                                                                                    <i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i>
                                                                                </a>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    <!-- <p>Select this option to manually confirm each booking.
                                                                    </p> -->
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!--Cancellation Policy -->

                                    <div class="tab-pane" id="2a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Reward Point Cancellation</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="cancel_reward_point_form" id="cancel_reward_point_form" enctype="multipart/form-data">
                                                            <div class="row ">
                                                                <div class="form-group col-md-10 col-sm-6 col-xs-12 b_tabs">
                                                                    <label>Establish the reward point cancellation count for a single booking.<b class="require">*</b></label>
                                                                    <div class="row cc_row">
                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                        <div class=" col-md-3 col-sm-3 col-xs-3">
                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="reward_point_cancel" id="reward_point_cancel" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                                                                                            echo $single_rules->reward_point_cancel;
                                                                                                                                                                                                                                        } ?>">
                                                                        </div>
                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                    </div>
                                                                    <!-- <p>Set these options carefully because it will affect
                                                                        the number of reward point you can accept for the
                                                                        user.</p> -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" value="reward_point_cancel_btn" id="reward_point_cancel_btn" name="reward_point_cancel_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3> Frequency for booking cancellations.</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="number_of_time_cancel_booking_form" id="number_of_time_cancel_booking_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-10 col-sm-6 col-xs-12 b_tabs">
                                                                    <label>Count of booking cancellations by individual customers.<b class="require">*</b></label>
                                                                    <div class="row cc_row">
                                                                        <div style="float: left;" class="plus span-plus-minus"><i class="fa-solid fa-plus"></i></div>
                                                                        <div class=" col-md-3 col-sm-3 col-xs-3">
                                                                            <input autocomplete="off" style="float: left;" type="text" class="form-control" name="cancel_booking_number" id="cancel_booking_number" placeholder="Enter session value" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                                                                                                echo $single_rules->cancel_booking_number;
                                                                                                                                                                                                                                            } ?>">
                                                                        </div>
                                                                        <div style="float: left;" class="minus span-plus-minus"><i class="fa-solid fa-minus"></i></div>
                                                                    </div>
                                                                    <!-- <p>We suggest you to set this option accordingly with
                                                                        User.</p> -->
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" id="cancel_booking_number_btn" name="cancel_booking_number_btn" value="cancel_booking_number_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Set Cancellation Time</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="cancel_appoinment_time_form" id="cancel_appoinment_time_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <label> Minimum time in hours before a booking users are allowed to initiate cancellations.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class=" col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="cancel_appoinment_hours" id="cancel_appoinment_hours" class="form-control col-md-3">
                                                                                <?php if (!empty($single_rules->cancel_appoinment_hours)){ ?>
                                                                                    <option value="<?php $single_rules->cancel_appoinment_hours?>" ><?php $single_rules->cancel_appoinment_hours?></option>
                                                                                <?php }else{?> 
                                                                                    <option value="" >HH</option>
                                                                                <?php }?>
                                                                                <option value="00" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "00") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>00</option>
                                                                                <option value="01" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "01") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>01</option>
                                                                                <option value="02" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "02") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>02</option>
                                                                                <option value="03" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "03") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>03</option>
                                                                                <option value="04" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "04") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>04</option>
                                                                                <option value="05" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "05") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>05</option>
                                                                                <option value="06" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "06") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>06</option>
                                                                                <option value="07" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "07") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>07</option>
                                                                                <option value="08" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "08") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>08</option>
                                                                                <option value="09" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "09") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>09</option>
                                                                                <option value="10" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "10") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>10</option>
                                                                                <option value="11" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "11") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>11</option>
                                                                                <option value="12" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "12") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>12</option>
                                                                                <option value="13" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "13") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>13</option>
                                                                                <option value="14" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "14") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>14</option>
                                                                                <option value="15" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "15") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>15</option>
                                                                                <option value="16" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "16") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>16</option>
                                                                                <option value="17" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "17") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>17</option>
                                                                                <option value="18" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "18") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>18</option>
                                                                                <option value="19" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "19") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>19</option>
                                                                                <option value="20" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "20") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>20</option>
                                                                                <option value="21" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "21") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>21</option>
                                                                                <option value="22" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "22") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>22</option>
                                                                                <option value="23" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "23") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>23</option>
                                                                                <option value="24" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_hours == "24") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>24</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect every Appoinment.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <label>Minimum time in minutes before a booking users are allowed to initiate cancellations.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class=" col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="cancel_appoinment_minit" id="cancel_appoinment_minit" class="form-control col-md-3">
                                                                            <?php if (!empty($single_rules->cancel_appoinment_minit)){ ?>
                                                                                <option value="<?php $single_rules->cancel_appoinment_minit?>" ><?php $single_rules->cancel_appoinment_minit?></option>
                                                                            <?php }else{?> 
                                                                                <option value="" >MM</option>
                                                                            <?php }?>   
                                                                                <option value="00" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "00") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>00</option>
                                                                                <option value="01" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "01") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>01</option>
                                                                                <option value="02" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "02") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>02</option>
                                                                                <option value="03" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "03") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>03</option>
                                                                                <option value="04" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "04") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>04</option>
                                                                                <option value="05" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "05") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>05</option>
                                                                                <option value="06" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "06") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>06</option>
                                                                                <option value="07" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "07") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>07</option>
                                                                                <option value="08" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "08") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>08</option>
                                                                                <option value="09" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "09") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>09</option>
                                                                                <option value="10" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "10") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>10</option>
                                                                                <option value="11" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "11") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>11</option>
                                                                                <option value="12" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "12") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>12</option>
                                                                                <option value="13" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "13") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>13</option>
                                                                                <option value="14" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "14") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>14</option>
                                                                                <option value="15" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "15") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>15</option>
                                                                                <option value="16" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "16") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>16</option>
                                                                                <option value="17" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "17") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>17</option>
                                                                                <option value="18" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "18") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>18</option>
                                                                                <option value="19" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "19") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>19</option>
                                                                                <option value="20" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "20") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>20</option>
                                                                                <option value="21" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "21") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>21</option>
                                                                                <option value="22" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "22") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>22</option>
                                                                                <option value="23" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "23") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>23</option>
                                                                                <option value="24" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "24") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>24</option>
                                                                                <option value="25" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "25") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>25</option>
                                                                                <option value="26" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "26") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>26</option>
                                                                                <option value="27" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "27") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>27</option>
                                                                                <option value="28" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "28") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>28</option>
                                                                                <option value="29" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "29") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>29</option>
                                                                                <option value="30" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "30") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>30</option>
                                                                                <option value="31" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "31") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>31</option>
                                                                                <option value="32" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "32") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>32</option>
                                                                                <option value="33" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "33") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>33</option>
                                                                                <option value="34" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "34") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>34</option>
                                                                                <option value="35" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "35") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>35</option>
                                                                                <option value="36" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "36") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>36</option>
                                                                                <option value="37" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "37") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>37</option>
                                                                                <option value="38" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "38") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>38</option>
                                                                                <option value="39" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "39") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>39</option>
                                                                                <option value="40" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "40") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>40</option>
                                                                                <option value="41" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "41") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>41</option>
                                                                                <option value="42" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "42") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>42</option>
                                                                                <option value="43" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "43") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>43</option>
                                                                                <option value="44" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "44") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>44</option>
                                                                                <option value="45" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "45") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>45</option>
                                                                                <option value="46" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "46") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>46</option>
                                                                                <option value="47" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "47") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>47</option>
                                                                                <option value="48" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "48") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>48</option>
                                                                                <option value="49" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "49") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>49</option>
                                                                                <option value="50" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "50") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>50</option>
                                                                                <option value="51" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "51") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>51</option>
                                                                                <option value="52" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "52") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>52</option>
                                                                                <option value="53" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "53") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>53</option>
                                                                                <option value="54" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "54") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>54</option>
                                                                                <option value="55" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "55") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>55</option>
                                                                                <option value="56" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "56") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>56</option>
                                                                                <option value="57" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "57") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>57</option>
                                                                                <option value="58" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "58") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>58</option>
                                                                                <option value="59" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "59") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>59</option>
                                                                                <option value="60" <?php if (!empty($single_rules) && $single_rules->cancel_appoinment_minit == "60") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>60</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect every Appoinment.</p> -->
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button style="margin-top: 30px;" type="submit" id="cancel_appoinment_time_btn" name="cancel_appoinment_time_btn" value="cancel_appoinment_time_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Set Booking Reschedule  Time</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="reshedule_hours_form" id="reshedule_hours_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <label> Minimum time in hours before a booking users are allowed to initiate reschedule.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class=" col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="reshedule_hours" id="reshedule_hours" class="form-control col-md-3">
                                                                                <?php if (!empty($single_rules->reshedule_hours)){ ?>
                                                                                    <option value="<?php $single_rules->reshedule_hours?>" ><?php $single_rules->reshedule_hours?></option>
                                                                                <?php }else{?> 
                                                                                    <option value="" >HH</option>
                                                                                <?php }?>   
                                                                                <option value="00" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "00") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>00</option>
                                                                                <option value="01" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "01") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>01</option>
                                                                                <option value="02" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "02") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>02</option>
                                                                                <option value="03" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "03") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>03</option>
                                                                                <option value="04" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "04") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>04</option>
                                                                                <option value="05" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "05") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>05</option>
                                                                                <option value="06" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "06") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>06</option>
                                                                                <option value="07" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "07") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>07</option>
                                                                                <option value="08" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "08") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>08</option>
                                                                                <option value="09" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "09") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>09</option>
                                                                                <option value="10" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "10") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>10</option>
                                                                                <option value="11" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "11") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>11</option>
                                                                                <option value="12" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "12") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>12</option>
                                                                                <option value="13" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "13") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>13</option>
                                                                                <option value="14" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "14") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>14</option>
                                                                                <option value="15" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "15") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>15</option>
                                                                                <option value="16" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "16") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>16</option>
                                                                                <option value="17" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "17") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>17</option>
                                                                                <option value="18" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "18") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>18</option>
                                                                                <option value="19" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "19") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>19</option>
                                                                                <option value="20" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "20") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>20</option>
                                                                                <option value="21" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "21") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>21</option>
                                                                                <option value="22" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "22") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>22</option>
                                                                                <option value="23" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "23") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>23</option>
                                                                                <option value="24" <?php if (!empty($single_rules) && $single_rules->reshedule_hours == "24") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>24</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect every Appoinment.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <label>Minimum time in minutes before a booking users are allowed to initiate reschedule.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class=" col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="reshedule_minit" id="reshedule_minit" class="form-control col-md-3">
                                                                                <?php if (!empty($single_rules->reshedule_minit)){ ?>
                                                                                        <option value="<?php $single_rules->reshedule_minit?>" ><?php $single_rules->reshedule_minit?></option>
                                                                                    <?php }else{?> 
                                                                                        <option value="" >MM</option>
                                                                                <?php }?>   
                                                                                <option value="00" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "00") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>00</option>
                                                                                <option value="01" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "01") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>01</option>
                                                                                <option value="02" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "02") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>02</option>
                                                                                <option value="03" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "03") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>03</option>
                                                                                <option value="04" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "04") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>04</option>
                                                                                <option value="05" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "05") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>05</option>
                                                                                <option value="06" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "06") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>06</option>
                                                                                <option value="07" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "07") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>07</option>
                                                                                <option value="08" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "08") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>08</option>
                                                                                <option value="09" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "09") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>09</option>
                                                                                <option value="10" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "10") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>10</option>
                                                                                <option value="11" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "11") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>11</option>
                                                                                <option value="12" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "12") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>12</option>
                                                                                <option value="13" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "13") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>13</option>
                                                                                <option value="14" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "14") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>14</option>
                                                                                <option value="15" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "15") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>15</option>
                                                                                <option value="16" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "16") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>16</option>
                                                                                <option value="17" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "17") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>17</option>
                                                                                <option value="18" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "18") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>18</option>
                                                                                <option value="19" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "19") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>19</option>
                                                                                <option value="20" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "20") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>20</option>
                                                                                <option value="21" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "21") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>21</option>
                                                                                <option value="22" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "22") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>22</option>
                                                                                <option value="23" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "23") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>23</option>
                                                                                <option value="24" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "24") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>24</option>
                                                                                <option value="25" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "25") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>25</option>
                                                                                <option value="26" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "26") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>26</option>
                                                                                <option value="27" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "27") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>27</option>
                                                                                <option value="28" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "28") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>28</option>
                                                                                <option value="29" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "29") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>29</option>
                                                                                <option value="30" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "30") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>30</option>
                                                                                <option value="31" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "31") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>31</option>
                                                                                <option value="32" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "32") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>32</option>
                                                                                <option value="33" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "33") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>33</option>
                                                                                <option value="34" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "34") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>34</option>
                                                                                <option value="35" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "35") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>35</option>
                                                                                <option value="36" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "36") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>36</option>
                                                                                <option value="37" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "37") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>37</option>
                                                                                <option value="38" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "38") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>38</option>
                                                                                <option value="39" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "39") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>39</option>
                                                                                <option value="40" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "40") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>40</option>
                                                                                <option value="41" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "41") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>41</option>
                                                                                <option value="42" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "42") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>42</option>
                                                                                <option value="43" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "43") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>43</option>
                                                                                <option value="44" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "44") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>44</option>
                                                                                <option value="45" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "45") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>45</option>
                                                                                <option value="46" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "46") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>46</option>
                                                                                <option value="47" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "47") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>47</option>
                                                                                <option value="48" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "48") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>48</option>
                                                                                <option value="49" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "49") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>49</option>
                                                                                <option value="50" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "50") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>50</option>
                                                                                <option value="51" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "51") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>51</option>
                                                                                <option value="52" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "52") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>52</option>
                                                                                <option value="53" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "53") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>53</option>
                                                                                <option value="54" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "54") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>54</option>
                                                                                <option value="55" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "55") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>55</option>
                                                                                <option value="56" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "56") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>56</option>
                                                                                <option value="57" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "57") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>57</option>
                                                                                <option value="58" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "58") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>58</option>
                                                                                <option value="59" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "59") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>59</option>
                                                                                <option value="60" <?php if (!empty($single_rules) && $single_rules->reshedule_minit == "60") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>60</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class=" col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affectevery Appoinment.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" value="reshedule_hours_btn" id="reshedule_hours_btn" name="reshedule_hours_btn" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Holiday -->

                                    <div class="tab-pane" id="3a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <?php if ($this->uri->segment(2) == '') { ?>
                                                        <h3>Add Holiday</h3>
                                                    <?php } else { ?>
                                                        <h3>Add Holiday</h3>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="container">
                                                        <form id="holiday_form" name="holiday_form" method="post" data-parsley-validate>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="fullname">Holiday Name <b class="require">*</b></label>
                                                                    <input autocomplete="off" type="text" id="holiday_name" class="form-control" name="holiday_name" placeholder="Enter holiday name">
                                                                    <input autocomplete="off" type="hidden" id="id" class="form-control" name="id" value="">

                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="fullname">Holiday Date <b class="require">*</b></label>
                                                                    <input autocomplete="off" type="text" placeholder="DD/MM/YYYY" class="form-control datepick form-control" autocomplete="off" id="holiday_date" name="holiday_date">
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit" id="submit_button" name="holiday-btn" value="holiday-btn" style="margin-top: 30px;">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="container">
                                                        <div class="filter_section">
                                                            <form id="make_form" name="make_form" method="GET" enctype="multipart/form-data" data-parsley-validate>
                                                                <div class="row">
                                                                    <div class="col-xl-2 col-lg-3 form-group">
                                                                        <label for="fullname">Date</label>
                                                                        <Select class="form-control search-input" name="date" id="date">
                                                                            <option value="">Please Select Date</option>
                                                                            <?php for ($j = 1; $j <= 31; $j++) { ?>
                                                                                <option value="<?= $j; ?>" <?php if (isset($_GET["date"]) && $_GET["date"] == $j) { ?>Selected<?php } ?>>
                                                                                    <?= $j; ?></option>
                                                                            <?php } ?>
                                                                        </Select>
                                                                    </div>
                                                                    <div class="col-xl-2 col-lg-3 form-group">
                                                                        <label>Month</label>
                                                                        <Select class="form-control search-input" name="month" id="month">
                                                                            <option value="">Please Select Month</option>
                                                                            <option value="0" <?php if (isset($_GET["month"]) && $_GET["month"] == '01') { ?>Selected<?php } ?>>
                                                                                January</option>
                                                                            <option value="02" <?php if (isset($_GET["month"]) && $_GET["month"] == '02') { ?>Selected<?php } ?>>
                                                                                February</option>
                                                                            <option value="0" <?php if (isset($_GET["month"]) && $_GET["month"] == '03') { ?>Selected<?php } ?>>
                                                                                March</option>
                                                                            <option value="0" <?php if (isset($_GET["month"]) && $_GET["month"] == '04') { ?>Selected<?php } ?>>
                                                                                April</option>
                                                                            <option value="05" <?php if (isset($_GET["month"]) && $_GET["month"] == '05') { ?>Selected<?php } ?>>
                                                                                May</option>
                                                                            <option value="06" <?php if (isset($_GET["month"]) && $_GET["month"] == '06') { ?>Selected<?php } ?>>
                                                                                June</option>
                                                                            <option value="07" <?php if (isset($_GET["month"]) && $_GET["month"] == '0') { ?>Selected<?php } ?>>
                                                                                July</option>
                                                                            <option value="08" <?php if (isset($_GET["month"]) && $_GET["month"] == '08') { ?>Selected<?php } ?>>
                                                                                August</option>
                                                                            <option value="09" <?php if (isset($_GET["month"]) && $_GET["month"] == '09') { ?>Selected<?php } ?>>
                                                                                September</option>
                                                                            <option value="10" <?php if (isset($_GET["month"]) && $_GET["month"] == '10') { ?>Selected<?php } ?>>
                                                                                October</option>
                                                                            <option value="11" <?php if (isset($_GET["month"]) && $_GET["month"] == '11') { ?>Selected<?php } ?>>
                                                                                November</option>
                                                                            <option value="12" <?php if (isset($_GET["month"]) && $_GET["month"] == '12') { ?>Selected<?php } ?>>
                                                                                December</option>
                                                                        </Select>
                                                                    </div>
                                                                    <div class="col-xl-2 col-lg-3 form-group">
                                                                        <label>Year</label>
                                                                        <input autocomplete="off" type="text" class="yearpicker form-control search-input" autocomplete="off" name="year" id="year" value="<?php if (isset($_GET["year"])) {
                                                                                                                                                                                            echo $_GET["year"];
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('Y');
                                                                                                                                                                                        } ?>">
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <button type="submit" id="submit_button" class="btn btn-primary search-btn" name="holiday-btn" value="holiday-btn" style="margin-top: 27px;">Search</button>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </form>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="x_panel">
                                                                    <div class="x_title">
                                                                        <h3>Holiday List</h3>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Sr. No.</th>
                                                                                    <th>Holiday Name</th>
                                                                                    <th>Holiday Date</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php if (!empty($holiday_list)) {
                                                                                    $i = 1;
                                                                                    foreach ($holiday_list as $holiday_list_result) {
                                                                                ?>
                                                                                        <tr>
                                                                                            <th scope="row">
                                                                                                <?= $i++ ?>
                                                                                            </th>
                                                                                            <td><?= $holiday_list_result->holiday_name ?></td>
                                                                                            <td><?= $holiday_list_result->holiday_date ?></td>
                                                                                           
                                                                                            <td>
                                                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $holiday_list_result->id ?>/tbl_holiday"><i class="fa-solid fa-trash"></i></a>

                                                                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>booking-rules/3/<?= $holiday_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                <?php }
                                                                                } ?>
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


                                    <!-- Emergency Alert  -->

                                    <div class="tab-pane" id="4a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>The salon should be closed for the specified duration as mentioned.</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="salon_close_date_form" id="salon_close_date_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label>From Date<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input autocomplete="off" type="text" placeholder="DD/MM/YYYY" class="datepick form-control" name="from_date" id="from_date">
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect salon opening and closing status.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label>To Date<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input autocomplete="off" type="text" placeholder="DD/MM/YYYY" class="datepick form-control" name="to_date" id="to_date">
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect salon opening and closing status.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <?php if (!empty($open_or_close)) {
                                                                        $i = 1;
                                                                        foreach ($open_or_close as $open_or_close_result) { ?>
                                                                            <label>Is <?php
                                                                                            if ($open_or_close_result->salon_status == '1') {
                                                                                                echo "Salon Open?";
                                                                                            } else {
                                                                                                echo "Salon Close?";
                                                                                            }
                                                                                            ?><b class="require">*</b></label><br>
                                                                          
                                                                                <?php if ($open_or_close_result->salon_status == "1") { ?>
                                                                                    <button style="margin-top: 30px; background:none !important;" type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal">
                                                                                       <i style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i>
                                                                                    </button>
                                                                                <?php } else { ?>
                                                                                    <a title="Reopen" style="font-size: 25px;" class="btn btn-light" onclick="return confirm('Are you sure to reopen salon?');" href="<?=base_url()?>salon_status_close/<?=$open_or_close_result->id?>/tbl_booking_rules"><i class="fa-solid fa-toggle-off"></i></a> 
                                                                                <?php } ?>
                                                                           
                                                                            <p>Enable the option to reopen the salon.</p>
                                                                            <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header cc">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                            <h5 class="modal-title">Add this option to display reason.</h5>
                                                                                        </div>
                                                                                        <div class="modal-body cc">
                                                                                            <?php
                                                                                            if (!empty($reason_list)) {
                                                                                                $j = 1;
                                                                                                foreach ($reason_list as $reason_list_result) {
                                                                                            ?>
                                                                                                    <div class="form-check" style="margin-top: 10px;">
                                                                                                        <input autocomplete="off" type="radio" name="reason_title" id="reason<?= $j ?>" value="<?= $reason_list_result->reason_title ?>">
                                                                                                        <input autocomplete="off" type="hidden" name="salon_close_reason" id="reason<?= $j ?>" value="<?= $reason_list_result->salon_close_reason ?>">

                                                                                                        <label class="form-check-label" for="reason<?= $j ?>">
                                                                                                            <?= $reason_list_result->reason_title ?>
                                                                                                        </label><br>
                                                                                                        <p class="form-check-label" for="reason<?= $j ?>">
                                                                                                            <?= $reason_list_result->salon_close_reason ?>
                                                                                                        </p>
                                                                                                    </div>
                                                                                            <?php
                                                                                                    $j++;
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" value="salon_close_date_btn" id="salon_close_date_btn" name="salon_close_date_btn" class="btn btn-primary" style="color: white;">Submit</button>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- price various -->

                                    <div class="tab-pane" id="5a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Set Online Booking Price</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="online_price_form" id="online_price_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 b_tabs">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label>Set price for online booking platform.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input autocomplete="off" type="text" class="form-control" name="online_price" id="online_price" value="<?php if (!empty($single_rules)) {
                                                                                                                                                                        echo $single_rules->online_price;
                                                                                                                                                                    } ?>" placeholder="Enter amount in Rs">
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect the online and offline service charge.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button type="submit" value="online_price_btn" id="online_price_btn" name="online_price_btn" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- salon type -->

                                    <div class="tab-pane" id="6a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Set Salon type</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="salon_type_form" id="salon_type_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label>Choose the salon type option to specify services of the salon.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="salon_type" id="salon_type" class="form-control col-md-3">
                                                                                <option value="" <?php echo (!empty($single_rules) && ($single_rules->salon_type === 'Medium' || $single_rules->salon_type === 'Standard')) ? 'class="hidden"' : ''; ?>>Select an option</option>
                                                                                <option value="Medium" <?php if (!empty($single_rules) && $single_rules->salon_type == 'Medium') {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Medium</option>
                                                                                <option value="Standard" <?php if (!empty($single_rules) && $single_rules->salon_type == 'Standard') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Standard</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect on salon type.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button style="margin-top: 30px;" type="submit" value="salon_type_btn" id="salon_type_btn" name="salon_type_btn" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- salon Employee selection -->

                                    <div class="tab-pane" id="7a">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Set stylist selection at the time of booking</h3>
                                                    </div>

                                                    <div class="container">
                                                        <form method="post" name="emp_selection_form" id="emp_selection_form" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <label> Enabling customers to choose their preferred stylist at the time of scheduling an appointment.<b class="require">*</b></label>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <Select name="emp_selection" id="emp_selection" class="form-control col-md-3">
                                                                                <option value="" <?php echo (!empty($single_rules) && $single_rules->emp_selection >= ' ') ? 'class="hidden"' : ''; ?>>Select an option</option>
                                                                                <option value="1" <?php if (!empty($single_rules) && $single_rules->emp_selection == '1') {
                                                                                                        echo 'selected';
                                                                                                    } ?>>Yes</option>
                                                                                <option value="0" <?php if (!empty($single_rules) && $single_rules->emp_selection == '0') {
                                                                                                        echo 'selected';
                                                                                                    } ?>>No</option>
                                                                            </Select>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <!-- <p>Set these options carefully because it will affect on salon appointment booking stylist selection.</p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <button style="margin-top: 30px;" type="submit" value="emp_selection_btn" id="emp_selection_btn" name="emp_selection_btn" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- salon notification -->



                                    <div class="tab-pane" id="8a">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Appointment Confirmed Message</h3>
                                                    </div>
                                                    <form method="post" name="slot_confirm_form" id="slot_confirm_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#4" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#5" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#6" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="4">
                                                                        <textarea class="form-control" name="slot_confirm_sms" id="slot_confirm_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                    echo $notification->slot_confirm_sms;
                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                    echo $notification->slot_confirm_sms;
                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="5">
                                                                        <textarea class="form-control" name="slot_confirm_email" id="slot_confirm_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->slot_confirm_email;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->slot_confirm_email;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="6">
                                                                        <textarea class="form-control" name="slot_confirm_whatsapp" id="slot_confirm_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                    echo $notification->slot_confirm_whatsapp;
                                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                        echo $notification->slot_confirm_whatsapp;
                                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="slot_confirm_btn" id="slot_confirm_btn" name="slot_confirm_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Appointment Reshedule Message</h3>
                                                    </div>
                                                    <form method="post" name="slot_reshedule_form" id="slot_reshedule_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#1" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#2" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#3" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="1">
                                                                        <textarea class="form-control" name="slot_reshedule_sms" id="slot_reshedule_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                        echo $notification->slot_reshedule_sms;
                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                        echo $notification->slot_reshedule_sms;
                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="2">
                                                                        <textarea class="form-control" name="slot_reshedule_email" id="slot_reshedule_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                echo $notification->slot_reshedule_email;
                                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                echo $notification->slot_reshedule_email;
                                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="3">
                                                                        <textarea class="form-control" name="slot_reshedule_whatsapp" id="slot_reshedule_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                        echo $notification->slot_reshedule_whatsapp;
                                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                            echo $notification->slot_reshedule_whatsapp;
                                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="slot_reshedule_btn" id="slot_reshedule_btn" name="slot_reshedule_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Appointment Cancel Message</h3>
                                                    </div>
                                                    <form method="post" name="slot_cancel_form" id="slot_cancel_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#7" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#8" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#9" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="7">
                                                                        <textarea class="form-control" name="slot_cancel_sms" id="slot_cancel_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                    echo $notification->slot_cancel_sms;
                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                echo $notification->slot_cancel_sms;
                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="8">
                                                                        <textarea class="form-control" name="slot_cancel_email" id="slot_cancel_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                        echo $notification->slot_cancel_email;
                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                        echo $notification->slot_cancel_email;
                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="9">
                                                                        <textarea class="form-control" name="slot_cancel_whastapp" id="slot_cancel_whastapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                    echo $notification->slot_cancel_whatsapp;
                                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                    echo $notification->slot_cancel_whatsapp;
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="slot_cancel_btn" id="slot_cancel_btn" name="slot_cancel_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Payment Receive Message</h3>
                                                    </div>
                                                    <form method="post" name="payment_received_form" id="payment_received_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#10" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#11" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#12" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="10">
                                                                        <textarea class="form-control" name="payment_receive_sms" id="payment_receive_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->payment_receive_sms;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->payment_receive_sms;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="11">
                                                                        <textarea class="form-control" name="payment_receive_email" id="payment_receive_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                echo $notification->payment_receive_email;
                                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                    echo $notification->payment_receive_email;
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="12">
                                                                        <textarea class="form-control" name="payment_receive_whatsapp" id="payment_receive_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                            echo $notification->payment_receive_whatsapp;
                                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                                echo $notification->payment_receive_whatsapp;
                                                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="payment_received_btn" id="payment_received_btn" name="payment_received_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Birthday Message</h3>
                                                    </div>
                                                    <form method="post" name="birthday_form" id="birthday_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#13" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#14" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#15" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="13">
                                                                        <textarea class="form-control" name="birthday_sms" id="birthday_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                            echo $notification->birthday_sms;
                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                        echo $notification->birthday_sms;
                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="14">
                                                                        <textarea class="form-control" name="birthday_email" id="birthday_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                    echo $notification->birthday_email;
                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                echo $notification->birthday_email;
                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="15">
                                                                        <textarea class="form-control" name="birthday_whatsapp" id="birthday_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->birthday_whatsapp;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->birthday_whatsapp;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="birthday_btn" id="birthday_btn" name="birthday_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Anniversary Message</h3>
                                                    </div>
                                                    <form method="post" name="anniversary_form" id="anniversary_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#16" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#17" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#18" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="16">
                                                                        <textarea class="form-control" name="anniversary_sms" id="anniversary_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                    echo $notification->anniversary_sms;
                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                echo $notification->anniversary_sms;
                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="17">
                                                                        <textarea class="form-control" name="anniversary_email" id="anniversary_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                        echo $notification->anniversary_email;
                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                        echo $notification->anniversary_email;
                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="18">
                                                                        <textarea class="form-control" name="anniversary_whatsapp" id="anniversary_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                    echo $notification->anniversary_whatsapp;
                                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                    echo $notification->anniversary_whatsapp;
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="anniversary_btn" id="anniversary_btn" name="anniversary_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Online Appointment Message</h3>
                                                    </div>
                                                    <form method="post" name="online_slot_book_form" id="online_slot_book_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#19" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#20" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#21" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="19">
                                                                        <textarea class="form-control" name="online_slot_confirm_sms" id="online_slot_confirm_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                    echo $notification->online_slot_confirm_sms;
                                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                        echo $notification->online_slot_confirm_sms;
                                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="20">
                                                                        <textarea class="form-control" name="online_slot_confirm_email" id="online_slot_confirm_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                        echo $notification->online_slot_confirm_email;
                                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                                echo $notification->online_slot_confirm_email;
                                                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="21">
                                                                        <textarea class="form-control" name="online_slot_confirm_whatsapp" id="online_slot_confirm_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                                    echo $notification->online_slot_confirm_whatsapp;
                                                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                                            echo $notification->online_slot_confirm_whatsapp;
                                                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="online_slot_book_btn" id="online_slot_book_btn" name="online_slot_book_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Stlist Cancel Message</h3>
                                                    </div>
                                                    <form method="post" name="voucher_form" id="voucher_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#22" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#23" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#24" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="22">
                                                                        <textarea class="form-control" name="voucher_sms" id="voucher_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                            echo $notification->voucher_sms;
                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                    echo $notification->voucher_sms;
                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="23">
                                                                        <textarea class="form-control" name="voucher_eamil" id="voucher_eamil" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                echo $notification->voucher_email;
                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                            echo $notification->voucher_email;
                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="24">
                                                                        <textarea class="form-control" name="voucher_whatsapp" id="voucher_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->voucher_whatsapp;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                        echo $notification->voucher_whatsapp;
                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="voucher_btn" id="voucher_btn" name="voucher_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Booking Reminder Message</h3>
                                                    </div>
                                                    <form method="post" name="booking_reminder_form" id="booking_reminder_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#25" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#26" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#27" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="25">
                                                                        <textarea class="form-control" name="slot_reminder_sms" id="slot_reminder_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                        echo $notification->slot_reminder_sms;
                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                    echo $notification->slot_reminder_sms;
                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="26">
                                                                        <textarea class="form-control" name="slot_reminder_email" id="slot_reminder_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->slot_reminder_email;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->slot_reminder_email;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="27">
                                                                        <textarea class="form-control" name="slot_reminder_whatsapp" id="slot_reminder_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                        echo $notification->slot_reminder_whatsapp;
                                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                        echo $notification->slot_reminder_whatsapp;
                                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="booking_reminder_btn" id="booking_reminder_btn" name="booking_reminder_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Stylist Booking Message (Room Calendar)</h3>
                                                    </div>
                                                    <form method="post" name="stylist_booking_form" id="stylist_booking_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#28" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#29" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#30" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="28">
                                                                        <textarea class="form-control" name="stylist_booking_sms" id="stylist_booking_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->stylist_booking_sms;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->stylist_booking_sms;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="29">
                                                                        <textarea class="form-control" name="stylist_booking_email" id="stylist_booking_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                echo $notification->stylist_booking_email;
                                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                    echo $notification->stylist_booking_email;
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="30">
                                                                        <textarea class="form-control" name="stylist_booking_whatsapp" id="stylist_booking_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                                            echo $notification->stylist_booking_whatsapp;
                                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                                                echo $notification->stylist_booking_whatsapp;
                                                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="stylist_booking_btn" id="stylist_booking_btn" name="stylist_booking_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Feedback Message</h3>
                                                    </div>
                                                    <form method="post" name="feedback_form" id="feedback_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#31" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#32" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#33" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="31">
                                                                        <textarea class="form-control" name="feedback_sms" id="feedback_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                            echo $notification->feedback_sms;
                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                        echo $notification->feedback_sms;
                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="32">
                                                                        <textarea class="form-control" name="feedback_email" id="feedback_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                    echo $notification->feedback_email;
                                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                echo $notification->feedback_email;
                                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="33">
                                                                        <textarea class="form-control" name="feedback_whatsapp" id="feedback_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                            echo $notification->feedback_whatsapp;
                                                                                                                                                                                                        } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                            echo $notification->feedback_whatsapp;
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="feedback_btn" id="feedback_btn" name="feedback_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>Reward Message</h3>
                                                    </div>
                                                    <form method="post" name="reward_message_form" id="reward_message_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#34" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#35" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#36" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="34">
                                                                        <textarea class="form-control" name="reward_sms" id="reward_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                        echo $notification->reward_sms;
                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                echo $notification->reward_sms;
                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="35">
                                                                        <textarea class="form-control" name="reward_email" id="reward_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                echo $notification->reward_email;
                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                        echo $notification->reward_email;
                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="36">
                                                                        <textarea class="form-control" name="reward_whatsapp" id="reward_whatsapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                        echo $notification->reward_whatsapp;
                                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                                    echo $notification->reward_whatsapp;
                                                                                                                                                                                                                                                                                } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="reward_message_btn" id="reward_message_btn" name="reward_message_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="x_title">
                                                        <h3>OTP Message</h3>
                                                    </div>
                                                    <form method="post" name="otp_message_form" id="otp_message_form" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div id="exTab2" class="container">
                                                                <ul class="nav nav-tabs message-tab">
                                                                    <li class="active">
                                                                        <a href="#37" data-toggle="tab">SMS</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#38" data-toggle="tab">Email</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#39" data-toggle="tab">Whatsapp</a>
                                                                    </li>
                                                                </ul><br>
                                                                <div class="tab-content ">
                                                                    <div class="tab-pane active" id="37">
                                                                        <textarea class="form-control" name="otp_sms" id="otp_sms" placeholder="Enter sms description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                    echo $notification->otp_sms;
                                                                                                                                                                                } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                        echo $notification->otp_sms;
                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="38">
                                                                        <textarea class="form-control" name="otp_email" id="otp_email" placeholder="Enter email description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                        echo $notification->otp_email;
                                                                                                                                                                                    } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                echo $notification->otp_email;
                                                                                                                                                                                                                                                            } ?></textarea>
                                                                    </div>
                                                                    <div class="tab-pane" id="39">
                                                                        <textarea class="form-control" name="otp_whatapp" id="otp_whatapp" placeholder="Enter whatsapp description" value="<?php if (!empty($notification)) {
                                                                                                                                                                                                echo $notification->otp_whatsapp;
                                                                                                                                                                                            } ?>"><?php if (!empty($notification)) {
                                                                                                                                                                                                                                                                        echo $notification->otp_whatsapp;
                                                                                                                                                                                                                                                                    } ?></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <button style="margin-top: 30px;" type="submit" value="otp_message_btn" id="otp_message_btn" name="otp_message_btn" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                    <!-- **********end************** -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<script>
    $(document).ready(function() {
        var pageName = window.location.pathname.split('/').pop();
        if (pageName == 1) {
            $("#1a").addClass('active');
            $("#tab_1").addClass('active');
            $("#2a, #3a, #4a, #5a, #6a, #7a, #8a").removeClass('active');
            $("#tab_2, #tab_3, #tab_4, #tab_5, #tab_6, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 2) {
            $("#2a").addClass('active');
            $("#tab_2").addClass('active');
            $("#1a, #3a, #4a, #5a, #6a, #7a, #8a").removeClass('active');
            $("#tab_1, #tab_3, #tab_4, #tab_5, #tab_6, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 3) {
            $("#3a").addClass('active');
            $("#tab_3").addClass('active');
            $("#1a, #2a, #4a, #5a, #6a, #7a, #8a").removeClass('active');
            $("#tab_1, #tab_2, #tab_4, #tab_5, #tab_6, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 4) {
            $("#4a").addClass('active');
            $("#tab_4").addClass('active');
            $("#1a, #2a, #3a, #5a, #6a, #7a, #8a").removeClass('active');
            $("#tab_1, #tab_2, #tab_3, #tab_5, #tab_6, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 5) {
            $("#5a").addClass('active');
            $("#tab_5").addClass('active');
            $("#1a, #2a, #3a, #4a, #6a, #7a, #8a").removeClass('active');
            $("#tab_1, #tab_2, #tab_3, #tab_4, #tab_6, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 6) {
            $("#6a").addClass('active');
            $("#tab_6").addClass('active');
            $("#1a, #2a, #3a, #4a, #5a, #7a, #8a").removeClass('active');
            $("#tab_1, #tab_2, #tab_3, #tab_4, #tab_5, #tab_7, #tab_8").removeClass('active');
        } else if (pageName == 7) {
            $("#7a").addClass('active');
            $("#tab_7").addClass('active');
            $("#1a, #2a, #3a, #4a, #5a, #6a, #8a").removeClass('active');
            $("#tab_1, #tab_2, #tab_3, #tab_4, #tab_5, #tab_6, #tab_8").removeClass('active');
        } else if (pageName == 8) {
            $("#8a").addClass('active');
            $("#tab_8").addClass('active');
            $("#1a, #2a, #3a, #4a, #6a, #7a, #5a").removeClass('active');
            $("#tab_1, #tab_2, #tab_3, #tab_4, #tab_6, #tab_7, #tab_5").removeClass('active');
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('#store-setting .child_menu').show();
        $('#store-setting').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.booking-rules').addClass('active_cc');
    });
</script>
<script type="text/javascript">
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

    $("#shift_in_time").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/check_shift_in_time_ajax",
            data: {
                'shift_in_time': $('#shift_in_time').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                var shift_in_time = parseInt($('#shift_in_time').val())
                var salon_open_time = parseInt(parsedData.salon_start_time);
                if (salon_open_time > shift_in_time) {
                    $('#validationMessage1').text('You can not select a time before the salon opens.').show();
                    $('#shift_in_time').val(" ");
                } else {
                    $('#validationMessage1').hide();
                }
            },
        });
    });
    $("#shift_out_time").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/check_shift_out_time_ajax",
            data: {
                'shift_out_time': $('#shift_out_time').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                var shift_out_time = parseInt($('#shift_out_time').val())
                var salon_close_time = parseInt(parsedData.salon_end_time);

                if (salon_close_time < shift_out_time) {
                    $('#validationMessage').text('You cannot select a time after the salon closing.').show();
                    $('#shift_out_time').val(" ");
                } else {
                    $('#validationMessage').hide();
                }
            },
        });
    });
    $("#lunch_start_time").change(function() {
        var shift_in_time = parseInt($('#shift_in_time').val());
        var shift_out_time = parseInt($('#shift_out_time').val());
        var lunch_start_time = parseInt($('#lunch_start_time').val());

        if (lunch_start_time < shift_in_time) {
            $('#lunchStart_message').hide();
        } else {
            $('#lunchStart_message').text('Please select time according to shift time.').show();
            $('#lunch_start_time').val(" ");

        }

    });
    $("#lunch_close_time").change(function() {
        var shift_in_time = parseInt($('#shift_in_time').val());
        var shift_out_time = parseInt($('#shift_out_time').val());
        var lunch_start_time = parseInt($('#lunch_start_time').val());
        var lunch_close_time = parseInt($('#lunch_close_time').val());

        console.log("Shift In Time:", lunch_close_time);



        if ((lunch_out_time < shift_out_time) && (lunch_out_time > shift_in_time)) {
            $('#lunchcolse_message').hide();
        } else {
            $('#lunchclose_message').text('Please select time according to shift time.').show();
            $('#lunch_out_time').val(" ");

        }

    });
</script>
<script>
    $(".datepick").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        maxDate: 765,
        minDate: "-2Y",
        yearRange: "-2:+2",
        beforeShow: function(input, inst) {
            inst.settings.yearRange = "-2:+2";
        }
    });
</script>

<script>
    // $(document).ready(function() {
    //     $('.minus').click(function() {
    //         var $input = $(this).parent().find('input');
    //         var count = parseInt($input.val()) - 1;
    //         count = count < 1 ? 1 : count;
    //         $input.val(count);
    //         $input.change();
    //         return false;
    //     });
    //     $('.plus').click(function() {
    //         var $input = $(this).parent().find('input');
    //         $input.val(parseInt($input.val()) + 1);
    //         $input.change();
    //         return false;
    //     });
    // });

$(document).ready(function() {
    $('.minus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    
    $('.plus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val() || 0) + 1; 
        $input.val(count);
        $input.change();
        return false;
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
        $('#emp_selection_form').validate({
            ignore: "hidden",
            rules: {
                emp_selection: {
                    required: true,
                },
            },
            messages: {
                emp_selection: {
                    required: "Please select option!",
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

        $('#salon_type_form').validate({
            ignore: "hidden",
            rules: {
                salon_type: {
                    required: true,
                },
            },
            messages: {
                salon_type: {
                    required: "Please select salon type!",
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
        $('#salon_time_form').validate({
            ignore: "hidden",
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
                    required: "Please enter salon start time!",
                },
                salon_end_time: {
                    required: "Please enter salon closing time!",
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
        $('#holiday_form').validate({
            ignore: "hidden",
            rules: {
                holiday_name: {
                    required: true,
                },
                holiday_date: {
                    required: true,
                },
            },
            messages: {
                holiday_name: {
                    required: "Please enter holiday name!",
                },
                holiday_date: {
                    required: "Please Select date!",
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
        $('#per_session_stylist_form').validate({
            ignore: "hidden",
            rules: {
                per_session_stylist: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                per_session_stylist: {
                    required: "Please select/enter value!",
                    number: "Only number allowed!",
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
        $('#session_avg_duration_form').validate({
            ignore: "hidden",
            rules: {
                session_avg_duration: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                session_avg_duration: {
                    required: "Please select/enter value!",
                    number: "Only number allowed!",
                    
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
        $('#offset_session_time_form').validate({
            ignore: "hidden",
            rules: {
                offset_session_time: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                offset_session_time: {
                    required: "Please select/enter value!",
                    number: "Only number allowed!",
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
        $('#booking_time_range_form').validate({
            ignore: "hidden",
            rules: {
                hours: {
                    required: true,
                    number: true,
                },
                days: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                hours: {
                    required: "Please select/enter value in hours!",
                    number: "Only number allowed!",
                },
                days: {
                    required: "Please Select value in days!",
                    number: "Only number allowed!",
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
        $('#cancel_reward_point_form').validate({
            ignore: "hidden",
            rules: {
                reward_point_cancel: {
                    required: true,
                    number: true,
                },

            },
            messages: {
                reward_point_cancel: {
                    required: "Please select/enter value!",
                    number: "Only number allowed!",
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
        $('#number_of_time_cancel_booking_form').validate({
            ignore: "hidden",
            rules: {
                cancel_booking_number: {
                    required: true,
                    number: true,
                },

            },
            messages: {
                cancel_booking_number: {
                    required: "Please select/enter value!",
                    number: "Only number allowed!",
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
        $('#cancel_appoinment_time_form').validate({
            rules: {
                cancel_appoinment_hours: {
                    required: true,
                },
                cancel_appoinment_minit: {
                    required: true,
                },

            },
            messages: {
                cancel_appoinment_hours: {
                    required: "Please select/enter value!",
                },
                cancel_appoinment_minit: {
                    required: "Please select/enter value!",
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
        $('#salon_close_date_form').validate({
            // ignore: "hidden",
            rules: {
                from_date: {
                    required: true,
                },
                to_date: {
                    required: true,
                },
                salon_close_reason: {
                    required: true,
                },
                reason_title: {
                    required: true,
                },

            },
            messages: {
                from_date: {
                    required: "Please select from date!",
                },
                to_date: {
                    required: "Please select to date!",
                },
                salon_close_reason: {
                    required: "Please select reason!",
                },
                reason_title: {
                    required: "Please select reason!",
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
        $('#online_price_form').validate({
            ignore: "hidden",
            rules: {

                online_price: {
                    required: true,
                    number: true,
                },

            },
            messages: {

                online_price: {
                    required: "Please enter price!",
                    number: "Only number allowed!",
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
        $('#reshedule_hours_form').validate({
            ignore: "hidden",
            rules: {

                reshedule_hours: {
                    required: true,
                    number: true,
                },
                reshedule_minit: {
                    required: true,
                    number: true,
                },

            },
            messages: {

                reshedule_hours: {
                    required: "Please select hours!",
                    number: "Only number allowed!",
                },
                reshedule_minit: {
                    required: "Please select minutes!",
                    number: "Only number allowed!",
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
        $('#remainder_hours_form').validate({
            ignore: "hidden",
            rules: {

                remainder_hours: {
                    required: true,
                    number: true,
                },

            },
            messages: {

                remainder_hours: {
                    required: "Please Select to hours!",
                    number: "Only number allowed!",
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
    // jQuery code to open the modal
    $(document).ready(function() {
        // Select the button by its class and add a click event handler
        $(".btn-light").click(function() {
            // Use the modal's ID to show it
            $("#myModal").modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.booking_rules').addClass('active_cc');
    });
</script>
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
            schedule_name: " Please enter work schedule name",
            //'sun_check[]': "Please select",

        },
        submitHandler: function(form) {
            var fields = $("input[type='checkbox']").serializeArray();
            //alert(fields);
            if (fields.length === 0) {
                //alert('Atleast one checkbox select.'); 
                // cancel submit
                $('.checkbox_error').text('Please select atleast one checkbox.');
                return false;
            } else {
                //alert(fields.length + " items selected"); 
                form.submit();
            }
            //form.submit();
        }
    });

    function JXX_Check() {

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
            //$('.sun_checkBox').prop('checked',true);
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
            //$('.mon_checkBox').prop('checked',true);
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
            //$('.tue_checkBox').prop('checked',true);
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
            //$('.wed_checkBox').prop('checked',true);
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
            //$('.thu_checkBox').prop('checked',true);
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
            //$('.fri_checkBox').prop('checked',true);
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
            //$('.sat_checkBox').prop('checked',true);
            $("#exampleModal1").modal("show");
            $("#exampleModal").css("display", "block");
            $("#exampleModal").css("opacity", "1");
            $('#input_class').val('sat_check_all');
        } else {
            //alert('Yes');
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
            //alert(checkBox_value);
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
    var hidWidth;
    var scrollBarWidths = 100;

    var widthOfList = function() {
        var itemsWidth = 0;
        $('.list li').each(function() {
            var itemWidth = $(this).outerWidth();
            itemsWidth += itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function() {
        return (
            $('.wrapper').outerWidth() - widthOfList() - getLeftPosi() - scrollBarWidths
        );
    };

    var getLeftPosi = function() {
        return $('.list').position().left;
    };

    var reAdjust = function() {
        $('.scroller-right, .scroller-left').show(); // Show both buttons initially

        if ($('.wrapper').outerWidth() < widthOfList()) {

            $('.scroller-right').show();
        } else {
            $('.scroller-right').show();
        }

        if (getLeftPosi() < 0) {
            $('.scroller-left').hide();
        } else {
            $('.scroller-left').hide();
        }
    };

    reAdjust();

    $(window).on('resize', function(e) {
        reAdjust();
    });

    $('.scroller-right').click(function() {
        $('.scroller-left').fadeIn('slow');
        $('.scroller-right').fadeOut('slow');

        $('.list').animate({
                left: '+=' + widthOfHidden() + 'px'
            },
            'slow',
            function() {}
        );
    });

    $('.scroller-left').click(function() {
        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');

        $('.list').animate({
                left: '-=' + getLeftPosi() + 'px'
            },
            'slow',
            function() {}
        );
    });
</script>

<script>
    $(document).ready(function() {
        $(".btn-light").click(function() {
            $("#myModal").modal('show');
        });
    });
</script>
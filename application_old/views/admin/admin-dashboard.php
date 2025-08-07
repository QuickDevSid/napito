    <?php include('header.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
       .right {
    background-color: #fff;
    margin: 5px;
    padding: 10px 25px;
    border: 1px solid #e6e5e5;
    height: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    border-radius: 5px;
    position: relative;
    /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
}
        footer {
            background: none;
            padding: 5px 20px 0;
            height: 45px;
            margin: 0 -17px;
        }
        .tile_count {
            margin-bottom: 0px;
            margin-top: 10px;
        }
        
    </style>

    <style>
        .nav-tabs {
            border-bottom: 2px solid #ddd;
        }

        .nav-tabs .nav-item {
            margin-right: 5px;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-radius: 0.25rem;
            padding: 6px 12px;
            background-color: #f8f9fa;
            color: #333;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e2e6ea;
            color: #000;
        }

        .nav-tabs .nav-link.active {
               background:linear-gradient(135deg, #800080, #ff69b4); ;
            color: #fff !important;
         
        }

        .nav-tabs .form-control {
            display: inline-block;
            width: auto;
            padding: 6px 10px;
            margin-left: 10px;
            font-size: 14px;
            height: 35px;
            line-height: 1.5;
            border-radius: 0.25rem;
            border: 1px solid #ccc;
        }

        @media screen and (max-width: 768px) {
            .nav-tabs .nav-item {
                display: block;
                margin-bottom: 5px;
            }
            .nav-tabs .form-control {
                display: block;
                margin-left: 0;
                margin-top: 5px;
            }
        }

        /* give the picker input same height/spacing as tabs */
        #custom_range.form-control {
            padding: 6px 10px;
            height: 35px;
            cursor: pointer;
        }

        /* when picker is open, mimic active tab colour */
        .flatpickr-input.flatpickr-open {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <div class="right_col" role="main">

<div class="row tile_count" >
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-store"></i> Total Salon</span>
            <div class="count" id="salon_count">2500</div>
            <span class="count_bottom" style="font-size: 12px;" id="salon_count_comparison"><i class="green"><i class="fa fa-sort-asc"></i>4% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-code-branch"></i> Total Branch</span>
            <div class="count" id="branch_count">123.50</div>
            <span class="count_bottom" style="font-size: 12px;" id="branch_count_comparison"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-users"></i> Total Customers</span>
            <div class="count green" id="total_customer">2,500</div>
            <span class="count_bottom" style="font-size: 12px;" id="total_customer_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-mobile"></i> Total App Customers</span>
            <div class="count" id="total_app_customers">4,567</div>
            <span class="count_bottom" style="font-size: 12px;" id="total_app_customers_comparison"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-sack-dollar"></i> Total Collections</span>
            <div class="count" id="bought_subscriptions_amount">2,315</div>
            <span class="count_bottom" style="font-size: 12px;" id="bought_subscriptions_amount_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-clock"></i> Collection Due</span>
            <div class="count" id="due_subscriptions_amount">7,325</div>
            <span class="count_bottom" style="font-size: 12px;" id="due_subscriptions_amount_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
<!-- </div>
<div class="row tile_count" > -->
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-calendar-week"></i></i> Today Salon</span>
            <div class="count" id="today_salon_count">2500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-arrows-split-up-and-left"></i> Today Branch</span>
            <div class="count" id="today_branch_count">123.50</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today Customers</span>
            <div class="count green" id="today_customer">2,500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today App Customers</span>
            <div class="count" id="today_app_customers">4,567</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa-solid fa-dollar-sign"></i> Today Collections</span>
            <div class="count" id="today_bought_subscriptions_amount">2,315</div>
        </div>
    </div>
<!-- </div>
<div class="row tile_count" > -->
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-store"></i> <?=date('M Y');?> Salon</span>
            <div class="count" id="month_salon_count">2500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-arrows-split-up-and-left"></i> <?=date('M Y');?> Branch</span>
            <div class="count" id="month_branch_count">123.50</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> Customers</span>
            <div class="count green" id="month_customer">2,500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> App Customers</span>
            <div class="count" id="month_app_customers">4,567</div>
        </div>
    </div>
    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-dollar-sign"></i> <?=date('M Y');?> Collections</span>
            <div class="count" id="month_bought_subscriptions_amount">2,315</div>
        </div>
    </div>
</div>
<?php
    $today = date('Y-m-d');
    $first_day_this_month = date('Y-m-01');
    $last_day_this_month = date('Y-m-t');

    $first_day_last_month = date('Y-m-01', strtotime('first day of last month'));
    $last_day_last_month = date('Y-m-t', strtotime('last month'));

    $first_day_next_month = date('Y-m-01', strtotime('first day of next month'));
    $last_day_next_month = date('Y-m-t', strtotime('last day of next month'));

    $current_from = isset($_GET['from_date']) ? $_GET['from_date'] : $first_day_this_month;
    $current_to = isset($_GET['to_date']) ? $_GET['to_date'] : $last_day_this_month;

    // Month Names
    $this_month_name = date('F Y'); // e.g. May 2025
    $last_month_name = date('F Y', strtotime('first day of last month'));
    $next_month_name = date('F Y', strtotime('first day of next month'));
?>
<div class="row tile_count" style="display:block;">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Branch Subscription Renewal Report
            </h3>
        </div>
    </div>
    <form method="get" id="dateFilterForm">
        <input type="hidden" name="from_date" id="from_date" value="<?= date('d-m-Y',strtotime($current_from)); ?>">
        <input type="hidden" name="to_date" id="to_date" value="<?= date('d-m-Y',strtotime($current_to)); ?>">

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <button type="button" class="nav-link <?= ($current_from == $today && $current_to == $today) ? 'active' : '' ?>"
                    onclick="setDateRange('<?= $today ?>','<?= $today ?>')"><b>Today</b></button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link <?= ($current_from == $first_day_this_month && $current_to == $last_day_this_month) ? 'active' : '' ?>"
                    onclick="setDateRange('<?= $first_day_this_month ?>','<?= $last_day_this_month ?>')"><b>Current Month</b> (<?= $this_month_name ?>)</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link <?= ($current_from == $first_day_last_month && $current_to == $last_day_last_month) ? 'active' : '' ?>"
                    onclick="setDateRange('<?= $first_day_last_month ?>','<?= $last_day_last_month ?>')"><b>Last Month</b> (<?= $last_month_name ?>)</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link <?= ($current_from == $first_day_next_month && $current_to == $last_day_next_month) ? 'active' : '' ?>"
                    onclick="setDateRange('<?= $first_day_next_month ?>','<?= $last_day_next_month ?>')"><b>Next Month</b> (<?= $next_month_name ?>)</button>
            </li>
            <li class="nav-item">
                <input type="text"
                    id="custom_range" title="Custom Range"
                    class="form-control d-inline w-auto"
                    placeholder="Custom range"
                    readonly> 
            </li>
        </ul>
    </form>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="example_2" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
            <thead>
                <tr class="headings">
                    <th>Sr. No.</th>
                    <th>Branch Name</th>
                    <th>Salon Name</th>
                    <th>Branch Number</th>
                    <th>Branch Email</th>
                    <th>Subscription</th>
                    <th>Renewal On</th>
                    <th class=" no-link last"><span class="nobr">Action</span>
                    </th>
                </tr>
            </thead> 
            <tbody>
                <?php 
                    $i = 1;
                    if (!empty($branch_renewals)) {
                        foreach ($branch_renewals as $gbranch_list_result) {
                            $active_addon_request = $this->Salon_model->get_branch_active_addon_request($gbranch_list_result->id,$gbranch_list_result->salon_id);
                            $saloon_type = $this->Admin_model->get_salon_type($gbranch_list_result->salon_type);
                            $subscription = $this->Admin_model->get_subscription_details($gbranch_list_result->subscription_id);
                            $subscription_allocation = $this->Admin_model->get_subscription_allocation_details($gbranch_list_result->subscription_allocation_id);
                            $referred_by = $this->Admin_model->get_branch_details($gbranch_list_result->referred_by);
                            $is_money_back = $this->Admin_model->get_is_money_back_applicable($gbranch_list_result->id);
                            if(!empty($subscription_allocation)){
                                if($subscription_allocation->allocation_status == '0'){
                                    $subscription_status = '<label class="label label-warning">Inactive</label>';
                                }elseif($subscription_allocation->allocation_status == '1'){
                                    $subscription_status = '<label class="label label-success">Active</label>';
                                }elseif($subscription_allocation->allocation_status == '2'){
                                    $subscription_status = '<label class="label label-primary">Expired</label>';
                                }elseif($subscription_allocation->allocation_status == '3'){
                                    $subscription_status = '<label class="label label-info">Cancelled</label>';
                                }elseif($subscription_allocation->allocation_status == '4'){
                                    $subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
                                }elseif($subscription_allocation->allocation_status == '5'){
                                    $subscription_status = '<label class="label label-primary">Hold</label>';
                                }else{
                                    $subscription_status = '';
                                }
                            }else{
                                $subscription_status = '';
                            }
                ?>
                    <tr>
                        <td scope="row">
                            <?= $i++ ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->branch_name ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->salon_name ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->salon_number ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->email ?>
                        </td>
                        <td>
                            <?php echo $subscription_status; ?>
                            <?= !empty($subscription_allocation) ? '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription_allocation->subscription_name.'</b></p>' : ''; ?>
                            <?= $gbranch_list_result->subscription_price != "" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Price: </b><span style="font-size: 12px;">Rs. '.$gbranch_list_result->subscription_price.'</span></p>' : ''; ?>
                            <?= $gbranch_list_result->subscription_start != "" && $gbranch_list_result->subscription_end != "" && $gbranch_list_result->subscription_end != "0000-00-00 00:00:00" && $gbranch_list_result->subscription_start != "0000-00-00 00:00:00" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Validity: </b><span style="font-size: 12px;">'.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_start)) .' To '.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_end)).'</span></p>' : ''; ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->subscription_end != "" && $gbranch_list_result->subscription_end != "0000-00-00 00:00:00" ? date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_end)) : '-'; ?>
                        </td>
                        <td>
                            <?php
                                echo '<button style="float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Upgrade Now" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$gbranch_list_result->id.'" href="' . base_url('add-branch/' . $gbranch_list_result->salon_id . '/' . $gbranch_list_result->id) . '" data-toggle="modal" data-target="#customMessageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-arrow-up"></i></button>';
                            ?>
                        </td>
                <?php }} ?>
            </tbody>
        </table> 
    </div>
</div>
<div class="row tile_count" >
    <?php if (!empty($low_coin_balance_branch)) { ?>
    <div class="page-title">
        <div class="title_left">
            <h3>
                Branch with Low Whatsapp Coin Balance
            </h3>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
            <thead>
                <tr class="headings">
                    <th>Sr. No.</th>
                    <th>Branch Name</th>
                    <th>Salon Name</th>
                    <th>Branch Number</th>
                    <th>Branch Email</th>
                    <th>Subscription</th>
                    <th>Whatsapp Coin Balance</th>
                    <th>Request Status</th>
                    <th class=" no-link last"><span class="nobr">Action</span>
                    </th>
                </tr>
            </thead> 
            <tbody>
                <?php 
                    $i = 1;
                    foreach ($low_coin_balance_branch as $gbranch_list_result) {
                        $active_addon_request = $this->Salon_model->get_branch_active_addon_request($gbranch_list_result->id,$gbranch_list_result->salon_id);
                        $saloon_type = $this->Admin_model->get_salon_type($gbranch_list_result->salon_type);
                        $subscription = $this->Admin_model->get_subscription_details($gbranch_list_result->subscription_id);
                        $subscription_allocation = $this->Admin_model->get_subscription_allocation_details($gbranch_list_result->subscription_allocation_id);
                        $referred_by = $this->Admin_model->get_branch_details($gbranch_list_result->referred_by);
                        $is_money_back = $this->Admin_model->get_is_money_back_applicable($gbranch_list_result->id);
                        if(!empty($subscription_allocation)){
                            if($subscription_allocation->allocation_status == '0'){
                                $subscription_status = '<label class="label label-warning">Inactive</label>';
                            }elseif($subscription_allocation->allocation_status == '1'){
                                $subscription_status = '<label class="label label-success">Active</label>';
                            }elseif($subscription_allocation->allocation_status == '2'){
                                $subscription_status = '<label class="label label-primary">Expired</label>';
                            }elseif($subscription_allocation->allocation_status == '3'){
                                $subscription_status = '<label class="label label-info">Cancelled</label>';
                            }elseif($subscription_allocation->allocation_status == '4'){
                                $subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
                            }elseif($subscription_allocation->allocation_status == '5'){
                                $subscription_status = '<label class="label label-primary">Hold</label>';
                            }else{
                                $subscription_status = '';
                            }
                        }else{
                            $subscription_status = '';
                        }
                ?>
                    <tr>
                        <td scope="row">
                            <?= $i++ ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->branch_name ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->salon_name ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->salon_number ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->email ?>
                        </td>
                        <td>
                            <?php echo $subscription_status; ?>
                            <?= !empty($subscription_allocation) ? '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription_allocation->subscription_name.'</b></p>' : ''; ?>
                            <?= $gbranch_list_result->subscription_price != "" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Price: </b><span style="font-size: 12px;">Rs. '.$gbranch_list_result->subscription_price.'</span></p>' : ''; ?>
                            <?= $gbranch_list_result->subscription_start != "" && $gbranch_list_result->subscription_end != "" && $gbranch_list_result->subscription_end != "0000-00-00 00:00:00" && $gbranch_list_result->subscription_start != "0000-00-00 00:00:00" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Validity: </b><span style="font-size: 12px;">'.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_start)) .' To '.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_end)).'</span></p>' : ''; ?>
                        </td>
                        <td>
                            <?= $gbranch_list_result->include_wp != '1' ? 'NA' : ($gbranch_list_result->current_wp_coins_balance != "" ? '<a title="Branch Whatsapp Coin History" style="text-decoration:underline;" href="'.base_url().'branch_wp_coin_history?branch='.$gbranch_list_result->id.'" target="_blank">'.(int)$gbranch_list_result->current_wp_coins_balance.'</a>' : '-'); ?>
                        </td>
                        <td>
                            <?php
                                if(!empty($active_addon_request)){
                                    echo '<b>' . $print->plan_name.'</b><br>Price: Rs. ' . $print->plan_price.'<br>Coins: ' . $print->plan_qty . '<br>Requested On: ' . date('d M, Y h:i A',strtotime($active_addon_request->created_on));
                                    $requested_plan = $active_addon_request->add_on_plan_id;
                                }else{  
                                    echo 'NA';
                                    $requested_plan = '';
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                echo '<button style="float:left;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Purchase Add On" type="button" class="btn btn-primary event-action-button" id="service_details_button_'.$gbranch_list_result->id.'" onclick="showWPAddonForm('.$gbranch_list_result->id.','.$requested_plan.')" data-toggle="modal" data-target="#customMessageModal"><i style="color:gray;font-size: 20px;margin-left: -5px;" class="fa-solid fa-plus"></i></button>';
                            ?>
                        </td>
                <?php } ?>
            </tbody>
        </table> 
    </div>
    <?php } ?>
</div>
<!-- /top tiles -->

<!-- <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                </div>
                <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-9 col-xs-12">
                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                        <p>Facebook Campaign</p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Twitter Campaign</p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                        <p>Conventional Media</p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Bill boards</p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div> -->
<br />
<div class="modal fade" id="customMessageModal" tabindex="-1" aria-labelledby="customMessageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customMessageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Purchase Whatsapp Add On</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('customMessageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="customMessageModalResponse"></div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function showWPAddonForm(id,requested_plan){
        $.ajax({
            url: "<?= base_url(); ?>admin/Ajax_controller/showWPAddonForm_ajx",
            method: 'POST',
            data: { id: id, requested_plan: requested_plan },
            success: function(response) {
                $('#customMessageModalResponse').html(response)
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
    $(document).ready(function() {		
		$('#example').DataTable({ 
			responsive: true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
			buttons: [				
				{
					extend: 'excel',
					filename: 'Branch with Low Whatsapp Coin Balance',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7] 
					}
				},	
			], 
        });	
		$('#example_2').DataTable({ 
			responsive: true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
			buttons: [				
				{
					extend: 'excel',
					filename: 'Branch Renewals',
					exportOptions: {
						columns: [0,1,2,3,4,5,6] 
					}
				},	
			], 
        });
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_dashboard_counts_ajx",
            data: { },
            success: function(data) {
                var opts = $.parseJSON(data);

                $('#today_salon_count').text(parseInt(opts.today_salon_count));
                $('#today_branch_count').text(parseInt(opts.today_branch_count));
                $('#today_customer').text(parseInt(opts.today_customer));
                $('#today_app_customers').text(parseInt(opts.today_app_customers));
                $('#today_bought_subscriptions_amount').text(parseInt(opts.today_bought_subscriptions_amount));

                $('#month_salon_count').text(parseInt(opts.month_salon_count));
                $('#month_branch_count').text(parseInt(opts.month_branch_count));
                $('#month_customer').text(parseInt(opts.month_customer));
                $('#month_app_customers').text(parseInt(opts.month_app_customers));
                $('#month_bought_subscriptions_amount').text(parseInt(opts.month_bought_subscriptions_amount));

                $('#salon_count').text(parseInt(opts.salon_count));
                $('#branch_count').text(parseInt(opts.branch_count));
                $('#total_customer').text(parseInt(opts.total_customer));
                $('#total_app_customers').text(parseInt(opts.total_app_customers));
                $('#bought_subscriptions_amount').text(parseInt(opts.bought_subscriptions_amount));
                $('#due_subscriptions_amount').text(parseInt(opts.due_subscriptions_amount));

                salon_count_comparison = opts.salon_count_comparison;
                branch_count_comparison = opts.branch_count_comparison;
                total_customer_comparison = opts.total_customer_comparison;
                total_app_customers_comparison = opts.total_app_customers_comparison;
                bought_subscriptions_amount_comparison = opts.bought_subscriptions_amount_comparison;
                due_subscriptions_amount_comparison = opts.due_subscriptions_amount_comparison;

                if(salon_count_comparison.status == '0'){
                    $('#salon_count_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(salon_count_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(salon_count_comparison.status == '1'){
                    $('#salon_count_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(salon_count_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(salon_count_comparison.status == '2'){
                    $('#salon_count_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#salon_count_comparison').html('');
                }                

                if(branch_count_comparison.status == '0'){
                    $('#branch_count_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(branch_count_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(branch_count_comparison.status == '1'){
                    $('#branch_count_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(branch_count_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(branch_count_comparison.status == '2'){
                    $('#branch_count_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#branch_count_comparison').html('');
                }                

                if(total_customer_comparison.status == '0'){
                    $('#total_customer_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(total_customer_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(total_customer_comparison.status == '1'){
                    $('#total_customer_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(total_customer_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(total_customer_comparison.status == '2'){
                    $('#total_customer_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#total_customer_comparison').html('');
                }                

                if(total_app_customers_comparison.status == '0'){
                    $('#total_app_customers_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(total_app_customers_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(total_app_customers_comparison.status == '1'){
                    $('#total_app_customers_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(total_app_customers_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(total_app_customers_comparison.status == '2'){
                    $('#total_app_customers_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#total_app_customers_comparison').html('');
                }                

                if(bought_subscriptions_amount_comparison.status == '0'){
                    $('#bought_subscriptions_amount_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(bought_subscriptions_amount_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(bought_subscriptions_amount_comparison.status == '1'){
                    $('#bought_subscriptions_amount_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(bought_subscriptions_amount_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(bought_subscriptions_amount_comparison.status == '2'){
                    $('#bought_subscriptions_amount_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#bought_subscriptions_amount_comparison').html('');
                }
                
                if(due_subscriptions_amount_comparison.status == '0'){
                    $('#due_subscriptions_amount_comparison').html('<i class="red"><i class="fa fa-sort-desc"></i>' + parseFloat(due_subscriptions_amount_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(due_subscriptions_amount_comparison.status == '1'){
                    $('#due_subscriptions_amount_comparison').html('<i class="green"><i class="fa fa-sort-asc"></i>' + parseFloat(due_subscriptions_amount_comparison.change_percentage).toFixed(2) + '% </i> From Last Week');
                }else if(due_subscriptions_amount_comparison.status == '2'){
                    $('#due_subscriptions_amount_comparison').html('<i class="blue"><i class="fa fa-exchange-alt"></i>No Change </i> From Last Week');
                }else{
                    $('#due_subscriptions_amount_comparison').html('');
                }
            },
        });

        
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/reset_expired_subscriptions_ajx",
            data: { },
            success: function(data) {

            },
        });
    });
</script>
<script>
function setDateRange(from, to) {
    document.getElementById('from_date').value = from;
    document.getElementById('to_date').value = to;
    document.getElementById('dateFilterForm').submit();
}

function customRangeChanged() {
    let from = document.getElementById('custom_from').value;
    let to = document.getElementById('custom_to').value;
    if (from && to) {
        document.getElementById('from_date').value = from;
        document.getElementById('to_date').value = to;
        document.getElementById('dateFilterForm').submit();
    }
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Tabs still use setDateRange()
    window.setDateRange = function (from, to) {
        document.getElementById('from_date').value = from;
        document.getElementById('to_date').value   = to;
        document.getElementById('dateFilterForm').submit();
    };

    flatpickr("#custom_range", {
        mode: "range",
        dateFormat: "d-m-Y", // show in dd-mm-yyyy
        defaultDate: [
            document.getElementById('from_date').value,
            document.getElementById('to_date').value
        ],
        onClose: function (selectedDates) {
            if (selectedDates.length === 2) {
                const [from, to] = selectedDates;
                const format = d => ('0' + d.getDate()).slice(-2) + '-' +
                                    ('0' + (d.getMonth() + 1)).slice(-2) + '-' +
                                    d.getFullYear();
                document.getElementById('from_date').value = format(from);
                document.getElementById('to_date').value   = format(to);
                document.getElementById('dateFilterForm').submit();
            }
        }
    });

});
</script>
    <?php include('header.php'); ?>
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
        .tile_stats_count .count {
            font-size: 25px;
        }
    </style>
    <div class="right_col" role="main">

<div class="row tile_count" style="background: #e1e1e1;">
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Salon</span>
            <div class="count" id="salon_count">2500</div>
            <span class="count_bottom" style="font-size: 12px;" id="salon_count_comparison"><i class="green"><i class="fa fa-sort-asc"></i>4% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Branch</span>
            <div class="count" id="branch_count">123.50</div>
            <span class="count_bottom" style="font-size: 12px;" id="branch_count_comparison"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
            <div class="count green" id="total_customer">2,500</div>
            <span class="count_bottom" style="font-size: 12px;" id="total_customer_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total App Customers</span>
            <div class="count" id="total_app_customers">4,567</div>
            <span class="count_bottom" style="font-size: 12px;" id="total_app_customers_comparison"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count" id="bought_subscriptions_amount">2,315</div>
            <span class="count_bottom" style="font-size: 12px;" id="bought_subscriptions_amount_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Collection Due</span>
            <div class="count" id="due_subscriptions_amount">7,325</div>
            <span class="count_bottom" style="font-size: 12px;" id="due_subscriptions_amount_comparison"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
</div>
<div class="row tile_count" style="background: #e1e1e1;">
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today Salon</span>
            <div class="count" id="today_salon_count">2500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-clock-o"></i> Today Branch</span>
            <div class="count" id="today_branch_count">123.50</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today Customers</span>
            <div class="count green" id="today_customer">2,500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today App Customers</span>
            <div class="count" id="today_app_customers">4,567</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Today Collections</span>
            <div class="count" id="today_bought_subscriptions_amount">2,315</div>
        </div>
    </div>
</div>
<div class="row tile_count" style="background: #e1e1e1;">
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> Salon</span>
            <div class="count" id="month_salon_count">2500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-clock-o"></i> <?=date('M Y');?> Branch</span>
            <div class="count" id="month_branch_count">123.50</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> Customers</span>
            <div class="count green" id="month_customer">2,500</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> App Customers</span>
            <div class="count" id="month_app_customers">4,567</div>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> <?=date('M Y');?> Collections</span>
            <div class="count" id="month_bought_subscriptions_amount">2,315</div>
        </div>
    </div>
</div>
<!-- /top tiles -->

<!-- <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
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
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
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
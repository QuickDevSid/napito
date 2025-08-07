<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="font-size: 20px;">
                Branch Timeline
            </h3>
        </div>
        <?php if(!empty($branch_details)){ ?>
        <div class="title_left">
        <h4 style="color:#383838; text-align:center;"><?=$branch_details->branch_name;?>, <?=$branch_details->salon_name;?></h4>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="dashboard-widget-content scrollable_recent_div">
                        <ul class="list-unstyled timeline widget">
                        <?php 
                        if(!empty($branch_timeline)){
                            foreach($branch_timeline as $active_log_result){
                        ?>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a style="text-decoration:underline; font-size: 15px;color:#4b5b6c;"><?=$active_log_result->title;?></a>
                                        </h2>
                                        <div class="byline">
                                            <span style="font-size: 11px;color:#747774;"><time class="date" datetime="9-25"><?=date('d M, Y h:i A',strtotime($active_log_result->activity_on));?></time></span><?=$active_log_result->full_name != "" ? ' by <a style="font-size: 12px;">'.$active_log_result->full_name.'</a>' : '';?>
                                        </div>
                                        <p style="font-size: 14px;color:#4b5b6c;" class="excerpt"><?=$active_log_result->description?></p>
                                    </div>
                                </div>
                            </li>
                        <?php }}else{ ?> 
                            <span class="text">Timeline not available</span>
                        <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
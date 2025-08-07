<?php include('header.php');?>
<link href="<?=base_url();?>css/summernote.min.css" rel="stylesheet">
<style>
	.note-insert{
		display:none;
	}
	
	
	/*.fullDayClass:checked {
	  background-color: green!important;
	}*/
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	
	.custom-checkbox > .custom-checkbox-input,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked),
	.custom-checkbox > .custom-checkbox-input:checked {
		position: absolute;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label,
	.custom-checkbox > .custom-checkbox-input:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ff0000;
		background: #ff0000;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .custom-checkbox-input[data-indeterminate] + label:after,
	.custom-checkbox > .custom-checkbox-input[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .custom-checkbox-input:disabled:not(:checked) + label:before,
	.custom-checkbox > .custom-checkbox-input:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	
	
	.custom-checkbox > .fullDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .fullDayClass:not(:checked),
	.custom-checkbox > .fullDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .fullDayClass:not(:checked) + label,
	.custom-checkbox > .fullDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .fullDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .fullDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .fullDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #4caf50;
		background: #4caf50;
		border-radius: 2px;
	}
	.custom-checkbox > .fullDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .fullDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .fullDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .fullDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .fullDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .fullDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .fullDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	.custom-checkbox > .halfDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .halfDayClass:not(:checked),
	.custom-checkbox > .halfDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .halfDayClass:not(:checked) + label,
	.custom-checkbox > .halfDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .halfDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .halfDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .halfDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ffc107;
		background: #ffc107;
		border-radius: 2px;
	}
	
	.custom-checkbox > .halfDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .halfDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .halfDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .halfDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .halfDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .halfDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .halfDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	.custom-checkbox > .weekendDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .weekendDayClass:not(:checked),
	.custom-checkbox > .weekendDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .weekendDayClass:not(:checked) + label,
	.custom-checkbox > .weekendDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .weekendDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .weekendDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .weekendDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ff0000;
		background: #ff0000;
		border-radius: 2px;
	}
	.custom-checkbox > .weekendDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .weekendDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .weekendDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .weekendDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .weekendDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .weekendDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .weekendDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}

	
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Work Schedule</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="package_form" name="package_form" method="post" data-parsley-validate>
							<div class="row">
								<div class="form-group col-lg-12">
									<label for="fullname">Work Schedule Name*</label>
									<input type="text" id="schedule_name" class="form-control" name="schedule_name" value="<?php if(!empty($single)){ echo $single->schedule_name;}?>">
									<input type="hidden" id="hidden_id" class="form-control" name="hidden_id" value="<?php if(!empty($single)){ echo $single->id;}?>">
									<div class="error input_error"></div>
								</div>
								<div class="form-group col-lg-12">
									<label for="fullname">Work Schedule Description</label>
									<textarea id="schedule_description" rows="5" class="form-control summernote" name="schedule_description"><?php if(!empty($single)){ echo $single->schedule_description;}?></textarea>
								</div>
								<div class="form-group col-lg-12">
									<label for="fullname">Work Schedule</label>
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
									<?php if(!empty($single)){
										$work_days = $this->hr_model->get_work_schedule_working_days($single->id);
									?>
										<table style="width:100%;" class="working_days_table">
											<thead>
												<tr>
													<th rowspan="2"><div style="border-bottom:1px solid #ddd; padding-bottom: 30px;padding-top: 20px;">Weeks</div></th>
													<th colspan="7" style="border-bottom:1px solid #ddd;border-left: 1px solid #ddd;">Days</th>
												</tr>
												<tr>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Sunday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Monday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Tuesday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Wednesday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Thursday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Friday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Saturday</div>
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
												<?php if(!empty($work_days)){$f=1; foreach($work_days as $work_days_result){?>
													<tr>
														<th><?=$work_days_result->week;?><?php 
																if($work_days_result->week == '1'){
																	echo 'st';
																}else if($work_days_result->week == '2'){
																	echo 'nd';
																}else if($work_days_result->week == '3'){
																	echo 'rd';
																}else if($work_days_result->week == '4' || $work_days_result->week == '5' || $work_days_result->week == '6'){
																	echo 'th';
																}
															?>
															
															<input type="hidden" name="week_name[]" id="week_name_<?=$f;?>" value="<?=$work_days_result->week;?>">
															<input type="hidden" name="weeking_days_row_id[]" id="weeking_days_row_id_<?=$f;?>" value="<?=$work_days_result->id;?>">
														</th>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="sun_check[]" id="sun_check_<?=$f;?>" class="sun_checkBox custom-checkbox-input <?php if($work_days_result->sunday_status == '1'){?>fullDayClass<?php }else if($work_days_result->sunday_status == '2'){?>halfDayClass<?php }else if($work_days_result->sunday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->sunday_status;?>" <?php if($work_days_result->sunday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->sunday_status == '1'){?>fullDayClass<?php }else if($work_days_result->sunday_status == '2'){?>halfDayClass<?php }else if($work_days_result->sunday_status == '3'){?>weekendDayClass<?php }?>" for="sun_check_<?=$f;?>"></label>  
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="mon_check[]" id="mon_check_<?=$f;?>" class="mon_checkBox custom-checkbox-input <?php if($work_days_result->monday_status == '1'){?>fullDayClass<?php }else if($work_days_result->monday_status == '2'){?>halfDayClass<?php }else if($work_days_result->monday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->monday_status;?>" <?php if($work_days_result->monday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->monday_status == '1'){?>fullDayClass<?php }else if($work_days_result->monday_status == '2'){?>halfDayClass<?php }else if($work_days_result->monday_status == '3'){?>weekendDayClass<?php }?>" for="mon_check_<?=$f;?>"></label>  
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="tue_check[]" id="tue_check_<?=$f;?>" class="tue_checkBox custom-checkbox-input <?php if($work_days_result->tuesday_status == '1'){?>fullDayClass<?php }else if($work_days_result->tuesday_status == '2'){?>halfDayClass<?php }else if($work_days_result->tuesday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->tuesday_status;?>" <?php if($work_days_result->tuesday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->tuesday_status == '1'){?>fullDayClass<?php }else if($work_days_result->tuesday_status == '2'){?>halfDayClass<?php }else if($work_days_result->tuesday_status == '3'){?>weekendDayClass<?php }?>" for="tue_check_<?=$f;?>"></label>  
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="wed_check[]" id="wed_check_<?=$f;?>" class="wed_checkBox custom-checkbox-input <?php if($work_days_result->wednesday_status == '1'){?>fullDayClass<?php }else if($work_days_result->wednesday_status == '2'){?>halfDayClass<?php }else if($work_days_result->wednesday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->wednesday_status;?>" <?php if($work_days_result->wednesday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->wednesday_status == '1'){?>fullDayClass<?php }else if($work_days_result->wednesday_status == '2'){?>halfDayClass<?php }else if($work_days_result->wednesday_status == '3'){?>weekendDayClass<?php }?>" for="wed_check_<?=$f;?>"></label> 
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="thu_check[]" id="thu_check_<?=$f;?>" class="thu_checkBox custom-checkbox-input <?php if($work_days_result->thursday_status == '1'){?>fullDayClass<?php }else if($work_days_result->thursday_status == '2'){?>halfDayClass<?php }else if($work_days_result->thursday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->thursday_status;?>" <?php if($work_days_result->thursday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->thursday_status == '1'){?>fullDayClass<?php }else if($work_days_result->thursday_status == '2'){?>halfDayClass<?php }else if($work_days_result->thursday_status == '3'){?>weekendDayClass<?php }?>" for="thu_check_<?=$f;?>"></label> 
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="fri_check[]" id="fri_check_<?=$f;?>" class="fri_checkBox custom-checkbox-input <?php if($work_days_result->friday_status == '1'){?>fullDayClass<?php }else if($work_days_result->friday_status == '2'){?>halfDayClass<?php }else if($work_days_result->friday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->friday_status;?>" <?php if($work_days_result->friday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->friday_status == '1'){?>fullDayClass<?php }else if($work_days_result->friday_status == '2'){?>halfDayClass<?php }else if($work_days_result->friday_status == '3'){?>weekendDayClass<?php }?>" for="fri_check_<?=$f;?>"></label> 
														</td>
														<td style="border-left: 1px solid #ddd;" class="custom-checkbox">
															<input type="checkbox" name="sat_check[]" id="sat_check_<?=$f;?>" class="sat_checkBox custom-checkbox-input <?php if($work_days_result->saturday_status == '1'){?>fullDayClass<?php }else if($work_days_result->saturday_status == '2'){?>halfDayClass<?php }else if($work_days_result->saturday_status == '3'){?>weekendDayClass<?php }?>" value="<?=$work_days_result->saturday_status;?>" <?php if($work_days_result->saturday_status != ''){?>checked<?php }?>>
															<label class="custom-checkbox-input <?php if($work_days_result->saturday_status == '1'){?>fullDayClass<?php }else if($work_days_result->saturday_status == '2'){?>halfDayClass<?php }else if($work_days_result->saturday_status == '3'){?>weekendDayClass<?php }?>" for="sat_check_<?=$f;?>"></label> 
														
														</td>
													</tr>
												<?php $f++; }}?>
											</thead>
										</table>
									
									<?php }else{?>
										<table style="width:100%;" class="working_days_table">
											<thead>
												<tr>
													<th rowspan="2"><div style="border-bottom:1px solid #ddd; padding-bottom: 30px;padding-top: 20px;">Weeks</div></th>
													<th colspan="7" style="border-bottom:1px solid #ddd;border-left: 1px solid #ddd;">Days</th>
												</tr>
												<tr>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Sunday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Monday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Tuesday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Wednesday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Thursday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Friday</div>
													</th>
													<th style="border-left: 1px solid #ddd;">
														<div style="border-bottom:1px solid #ddd; padding-bottom:10px;">Saturday</div>
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
									<?php }?>
									<div class="error checkbox_error" style="text-align:center;"></div>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-lg-12">
									<ul class="colorNotice">
										<li><span class="fullDay_notice"></span> Full Day</li>
										<li><span class="halfDay_notice"></span> Half Day</li>
										<li><span class="weekend_notice"></span> Weekend</li>
									</ul>
								</div>
							</div>-->
                            <button class="btn btn-primary" type="submit" id="submit_button" name="submit_button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Please Select Weekday Type</h5>
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
				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
				<button type="button" class="btn btn-secondary close_btn" onclick="closeModal()">Close</button>
				<button type="button" class="btn btn-primary" onclick="saveDayType()">Save</button>
			  </div>
			</div>
		  </div>
		</div>
        <div class="clearfix"></div>
        <?php include('footer.php');
			$id = 0;
			if($this->uri->segment(2) != ""){
				$id = $this->uri->segment(2);
			}
		?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
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
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
		
	});
	$('.mon_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#mon_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.tue_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#tue_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.wed_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#wed_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.thu_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#thu_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.fri_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#fri_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	$('.sat_checkBox').click(function(){
		if($(this).prop("checked") == false){
			$('#sat_check_all').prop('checked',false);
		}
		if($(this).prop("checked") == true){
			var checkBox_value = $(this).attr('id');
			$("#exampleModal").modal("show");
			$('#input_class').val(checkBox_value);
		}
	});
	
	
	function saveDayType(){
		$("#exampleModal").modal("hide");
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
		$("#exampleModal").modal("hide");
		
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

<?php include('header.php');?>
<style>
	.rs_label{
		display:block;
	}
	input[type="radio"], input[type="checkbox"]{
		margin: 4px 8px 0;
	}
	.loader-container {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
}

.loader {
    border: 8px solid #f3f3f3; /* Light grey border */
    border-top: 8px solid #3498db; /* Blue border on top */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite; /* Apply rotation animation */
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -25px; /* Half of the loader height */
    margin-left: -25px; /* Half of the loader width */
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

 <div class="right_col" role="main">
		<div id="loader" class="loader-container">
			<div class="loader"></div>
		</div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Booking Rules   
                    <?php 
                        if(!empty($single_rules)){ 
                            echo '<small style="float:right;color:red;"><b>'.$single_rules->salon_type_title.' Rules applied</b></small>';
                        } 
                    ?>
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

        <div class="row">

            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<label class="rs_label" id="employee_selection_label">Employee Selection | कर्मचारी  निवड<b class="require">*</b></label>
									<?php if($store_type == '1'){ ?>
										<input type="radio" class="" name="employee_selection" id="employee_selection_multiple" value="0" <?php if(!empty($single_rules) && $single_rules->employee_selection == "0"){?>checked="checked"<?php }?>><span>Select Multiple stylist from backend |अनेक स्टायलिस्ट </span>
										<input type="radio" class="" name="employee_selection" id="employee_selection_single" value="1" <?php if(!empty($single_rules) && $single_rules->employee_selection == "1"){?>checked="checked"<?php }?>><span>Select Single stylist from backend |एक स्टायलिस्ट</span> 
										<input type="radio" class=" " name="employee_selection" id="employee_selection_single_frontend" value="2" <?php if(!empty($single_rules) && $single_rules->employee_selection == "2"){?>checked="checked"<?php }?>><span>Select Single stylist from frontend |एक स्टायलिस्ट</span>
									<?php }elseif($store_type == '2'){ ?>
										<input type="radio" class="" name="employee_selection" id="employee_selection_single" value="1" <?php if(!empty($single_rules) && $single_rules->employee_selection == "1"){?>checked="checked"<?php }?>><span>Select Single stylist from backend |एक स्टायलिस्ट</span> 
										<input type="radio" class=" " name="employee_selection" id="employee_selection_single_frontend" value="2" <?php if(!empty($single_rules) && $single_rules->employee_selection == "2"){?>checked="checked"<?php }?>><span>Select Single stylist from frontend |एक स्टायलिस्ट</span>
									<?php } ?>
										<div class="error" id="selection_error"></div>
									<input type="hidden" name="old_employee_selection" id="old_employee_selection" value="<?php if(!empty($single_rules)){ echo $single_rules->employee_selection; } ?>">
									<input type="hidden" name="old_employee_selection_value_label" id="old_employee_selection_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->employee_selection == '0'){
												echo 'Select Multiple stylist from backend |अनेक स्टायलिस्ट';
											}elseif($single_rules->employee_selection == '1'){
												echo 'Select Single stylist from backend |एक स्टायलिस्ट';
											}elseif($single_rules->employee_selection == '1'){
												echo 'Select Single stylist from frontend |एक स्टायलिस्ट';
											}
										} 
									?>
									">
									<input type="hidden" name="rule_id" id="rule_id" value="<?php if(!empty($single_rules)){ echo $single_rules->id; }?>">
									<input type="hidden" name="store_type" id="store_type" value="<?php echo $store_type; ?>">
								</div> 
							</div> 	  	
							<?php 
								if($store_type == '2'){ 
									$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['employee_selection']);	
									if(empty($rule_request)){
							?>						
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="button" name="update_selection" value="update_selection" class="btn btn-primary update_selection">Update</button>
								</div>
							</div> 
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>								
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="button" name="update_selection" value="update_selection" class="btn btn-primary update_selection">Update</button>
								</div>
							</div> 
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }}} ?>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<label class="rs_label" id="slot_time_label">Slot time | बफरिंग वेळ<b class="require">*</b></label>
									<input type="radio" class=" " name="slot_time" id="slot_time" value="5" <?php if(!empty($single_rules) && $single_rules->slot_time == "5"){?>checked="checked"<?php }?>><span>5 min</span> 
									<input type="hidden" name="old_slot_time" id="old_slot_time" value="<?php if(!empty($single_rules)){ echo $single_rules->slot_time; } ?>">
									<input type="hidden" name="old_slot_time_value_label" id="old_slot_time_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->slot_time == '5'){
												echo '5 min';
											}
										} 
									?>
									">
								</div> 
							</div>  
							<div class="error" id="slot_time_error"></div>		
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['slot_time']);	
								if(empty($rule_request)){
							?>							
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_slot_time" value="update_slot_time" class="btn btn-primary update_slot_time">Update</button>
								</div>
							</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>								
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_slot_time" value="update_slot_time" class="btn btn-primary update_slot_time">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label id="buffering_time_label" class="rs_label">Buffering time | बफरिंग वेळ (Break between two appointments | दोन अपॉइिंटमेंट मधील ब्रेक)<b class="require">*</b></label>
									<input type="radio" class=" " name="buffering_time" id="buffering_time" value="5" <?php if(!empty($single_rules) && $single_rules->buffering_time == "5"){?>checked="checked"<?php }?>><span>5 min</span>  
									<input type="radio" class=" " name="buffering_time" id="buffering_time_another" value="10"  <?php if(!empty($single_rules) && $single_rules->buffering_time == "10"){?>checked="checked"<?php }?>><span>10 min</span>  
									<input type="hidden" name="old_buffering_time" id="old_buffering_time" value="<?php if(!empty($single_rules)){ echo $single_rules->buffering_time; } ?>">
								</div>
								<input type="hidden" name="old_buffering_time_value_label" id="old_buffering_time_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->buffering_time == '5'){
												echo '5 min';
											}elseif($single_rules->buffering_time == '10'){
												echo '10 min';
											}
										} 
									?>
								"> 
							</div>  
							<div class="error" id="buffering_time_error"></div>			
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['buffering_time']);	
								if(empty($rule_request)){
							?>						
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_buffer_time" value="update_buffer_time" class="btn btn-primary update_buffer_time">Update</button>
								</div>
							</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>							
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_buffer_time" value="update_buffer_time" class="btn btn-primary update_buffer_time">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="rescheduling_label">Booking Rescheduling बुकिंग रीशेड्युलिंग <b class="require">*</b> <small style="float:right;">How far in time advance can an appointment be changed? | अपॉइिंटमेंट किती वेळ अगोदर बदलली जाऊ शकते?</small></label>
									<input type="radio" class=" " name="rescheduling" id="rescheduling_time_one" value="30" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "30"){?>checked="checked"<?php }?>><span>30 min</span>  
									<input type="radio" class=" " name="rescheduling" id="rescheduling_time_two" value="45" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "45"){?>checked="checked"<?php }?>><span>45 min</span>  
									<input type="radio" class="" name="rescheduling" id="rescheduling_time_two" value="60" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "60"){?>checked="checked"<?php }?>><span>60 min</span>  
									<input type="radio" class=" " name="rescheduling" id="rescheduling_time_two" value="1440" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "1440"){?>checked="checked"<?php }?>><span>1 Day</span>  
								</div> 
								<input type="hidden" name="old_booking_rescheduling_value_label" id="old_booking_rescheduling_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->booking_rescheduling == '30'){
												echo '30 min';
											}elseif($single_rules->booking_rescheduling == '45'){
												echo '45 min';
											}elseif($single_rules->booking_rescheduling == '60'){
												echo '60 min';
											}elseif($single_rules->booking_rescheduling == '1440'){
												echo '1 Day';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_booking_rescheduling" id="old_booking_rescheduling" value="<?php if(!empty($single_rules)){ echo $single_rules->booking_rescheduling; } ?>">
							</div> 
							<div class="error" id="rescheduling_error"></div>		
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['booking_rescheduling']);	
								if(empty($rule_request)){
							?>								
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_rescheduling" value="update_rescheduling" class="btn btn-primary update_rescheduling">Update</button>
								</div>
							</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>									
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_rescheduling" value="update_rescheduling" class="btn btn-primary update_rescheduling">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="cancellation_label">Cancellation | रद्द करणे<b class="require">*</b><small style="float:right;">How many minutes in advance can an appointment be cancelled?| अपॉइिंटमेंट किती मिनिटे अगोदर रद्द केली जाऊ शकते?</small></label>
									<input type="radio" class=" " name="cancellation" id="rescheduling_time_one" value="00" <?php if(!empty($single_rules) && $single_rules->cancellation == "00"){?>checked="checked"<?php }?>><span>Anytime</span>  
									<input type="radio" class=" " name="cancellation" id="rescheduling_time_two" value="60" <?php if(!empty($single_rules) && $single_rules->cancellation == "60"){?>checked="checked"<?php }?>><span>60 min</span>    
									<input type="radio" class=" " name="cancellation" id="rescheduling_time_three" value="45" <?php if(!empty($single_rules) && $single_rules->cancellation == "45"){?>checked="checked"<?php }?>><span>45 min</span>    
									<input type="radio" class=" " name="cancellation" id="rescheduling_time_four" value="30" <?php if(!empty($single_rules) && $single_rules->cancellation == "30"){?>checked="checked"<?php }?>><span>30 min</span>    
									<input type="radio" class=" " name="cancellation" id="rescheduling_time_five" value="15" <?php if(!empty($single_rules) && $single_rules->cancellation == "15"){?>checked="checked"<?php }?>><span>15 min</span>    
									
								</div> 
								<input type="hidden" name="old_cancellation_value_label" id="old_cancellation_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->cancellation == '00'){
												echo 'Anytime';
											}elseif($single_rules->cancellation == '60'){
												echo '60 min';
											}elseif($single_rules->cancellation == '45'){
												echo '45 min';
											}elseif($single_rules->cancellation == '30'){
												echo '30 min';
											}elseif($single_rules->cancellation == '15'){
												echo '15 min';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_cancellation" id="old_cancellation" value="<?php if(!empty($single_rules)){ echo $single_rules->cancellation; } ?>">
							</div>  
							<div class="error" id="cancellation_error"></div>								
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['cancellation']);	
								if(empty($rule_request)){
							?>	
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_cancellation" value="update_cancellation" class="btn btn-primary update_cancellation">Update</button>
								</div>
							</div> 
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>				
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_cancellation" value="update_cancellation" class="btn btn-primary update_cancellation">Update</button>
								</div>
							</div> 
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div>
				<!-- <div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="reward_point_cancellation_main_label">Reward point Cancellation | रिवॉर्ड पॉइंट रद्द करणे <b class="require">*</b></label>
									<label class="rs_label" id="reward_point_cancellation_label">Cancel Appointment <b class="require">*</b></label>
									<input type="radio" class=" " name="reward_point_cancellation" id="reward_point_cancellation" value="1" <?php if(!empty($single_rules) && $single_rules->reward_point_cancellation == "1"){?>checked="checked"<?php }?>><span>Will the reduction of reward points depend on the service chosen?| रिवॉर्ड पॉइंट्सची कपात निवडलेल्या सेवेवर अवलंबून असेल का?</span>    
								</div>  
								<input type="hidden" name="old_reward_point_cancellation_value_label" id="old_reward_point_cancellation_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->reward_point_cancellation == '1'){
												echo 'Will the reduction of reward points depend on the service chosen?| रिवॉर्ड पॉइंट्सची कपात निवडलेल्या सेवेवर अवलंबून असेल का?';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_reward_point_cancellation" id="old_reward_point_cancellation" value="<?php if(!empty($single_rules)){ echo $single_rules->reward_point_cancellation; } ?>">
							</div>  
							<div class="error" id="reward_point_cancellation_error"></div>								
								<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="display:none;">
									<label class="rs_label" id="reward_point_cancellation_late_customer_label">Late Customer | ग्राहक उशिरा आल्यास <b class="require">*</b></label>
									<input type="radio" class=" " name="reward_point_cancellation_late_customer" id="reward_point_cancellation_late_customer" value="1" <?php if(!empty($single_rules) && $single_rules->reward_point_cancellation_late_customer == "1"){?>checked="checked"<?php }?>><span>If you are late for more than 5 minutes, 2 rewards will be reduced per minute | 5 तुम्हाला ५ मिनिटांपेक्षा जास्त उशीर झाल्यास, प्रति मिनिट २ रिवॉर्ड कमी केली जातील</span>    
								</div> 
								<input type="hidden" name="old_reward_point_cancellation_late_customer_value_label" id="old_reward_point_cancellation_late_customer_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->reward_point_cancellation_late_customer == '1'){
												echo 'If you are late for more than 5 minutes, 2 rewards will be reduced per minute | 5 तुम्हाला ५ मिनिटांपेक्षा जास्त उशीर झाल्यास, प्रति मिनिट २ रिवॉर्ड कमी केली जातील';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_reward_point_cancellation_late_customer" id="old_reward_point_cancellation_late_customer" value="<?php if(!empty($single_rules)){ echo $single_rules->reward_point_cancellation_late_customer; } ?>">
							</div>  
							<div class="error" id="reward_point_cancellation_late_customer_error" style="display:none;"></div>	
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['reward_point_cancellation','reward_point_cancellation_late_customer']);	
								if(empty($rule_request)){
							?>									
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_reward_point_cancellation" value="update_reward_point_cancellation" class="btn btn-primary update_reward_point_cancellation">Update</button>
								</div>
							</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>										
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_reward_point_cancellation" value="update_reward_point_cancellation" class="btn btn-primary update_reward_point_cancellation">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div> -->
				 
				
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label id="booking_time_range_main_label">Booking time range <b class="require">*</b></label>
								</div> 
							</div>  
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="booking_time_range_label">How many minutes in advance can I book? | किती मिनिटे अगोदर बुक करू शकतो <b class="require">*</b></label>
									<input type="radio" class=" " name="booking_time_range" id="booking_range_one" value="15" <?php if(!empty($single_rules) && $single_rules->booking_time_range == "15"){?>checked="checked"<?php }?>><span>Before 15 Minutes</span>    
									<input type="radio" class=" " name="booking_time_range" id="booking_range_twwo" value="30" <?php if(!empty($single_rules) && $single_rules->booking_time_range == "30"){?>checked="checked"<?php }?>><span>Before 30 Minutes</span>    
								</div>  
								<input type="hidden" name="old_booking_time_range_value_label" id="old_booking_time_range_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->booking_time_range == '15'){
												echo 'Before 15 Minutes';
											}elseif($single_rules->booking_time_range == '30'){
												echo 'Before 30 Minutes';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_booking_time_range" id="old_booking_time_range" value="<?php if(!empty($single_rules)){ echo $single_rules->booking_time_range; } ?>">
							</div> 
							<div class="error" id="booking_range_minute_error"></div>
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="max_booking_range_day_label">How many days can I book | मी किती दिवस बुक करू शकतो <b class="require">*</b></label>
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_one" value="2" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "2"){?>checked="checked"<?php }?>><span>2 Days</span>    
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_two" value="3" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "3"){?>checked="checked"<?php }?>><span>3 Days</span>    
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_three" value="7" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "7"){?>checked="checked"<?php }?>><span>1 Week</span>    
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_four" value="14" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "14"){?>checked="checked"<?php }?>><span>2 Week</span>    
									<input type="radio" class="" name="max_booking_range_day" id="max_booking_range_day_five" value="21" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "21"){?>checked="checked"<?php }?>><span>3 Week</span>    
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_six" value="30" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "30"){?>checked="checked"<?php }?>><span>1 Month</span>
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_seven" value="60" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "60"){?>checked="checked"<?php }?>><span>2 Month</span>    
									<input type="radio" class=" " name="max_booking_range_day" id="max_booking_range_day_seven" value="90" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "90"){?>checked="checked"<?php }?>><span>3 Month</span>    
								</div> 
								<input type="hidden" name="old_max_booking_range_day_value_label" id="old_max_booking_range_day_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->max_booking_range_day == '2'){
												echo '2 Days';
											}elseif($single_rules->max_booking_range_day == '3'){
												echo '3 Days';
											}elseif($single_rules->max_booking_range_day == '7'){
												echo '1 Week';
											}elseif($single_rules->max_booking_range_day == '14'){
												echo '2 Week';
											}elseif($single_rules->max_booking_range_day == '21'){
												echo '3 Week';
											}elseif($single_rules->max_booking_range_day == '30'){
												echo '1 Month';
											}elseif($single_rules->max_booking_range_day == '60'){
												echo '2 Month';
											}elseif($single_rules->max_booking_range_day == '90'){
												echo '3 Month';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_max_booking_range_day" id="old_max_booking_range_day" value="<?php if(!empty($single_rules)){ echo $single_rules->max_booking_range_day; } ?>">
							</div>
							<div class="error" id="max_booking_range_day_error"></div>			
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['booking_time_range','max_booking_range_day']);	
								if(empty($rule_request)){
							?>						
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_booking_range_minute" value="update_booking_range_minute" class="btn btn-primary update_booking_range_minute">Update</button>
								</div>
							</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>							
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_booking_range_minute" value="update_booking_range_minute" class="btn btn-primary update_booking_range_minute">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div>
				<!-- <div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="availability_mode_label">Availability mode | उपलब्धता<b class="require">*</b></label>
									<input type="radio" class=" " name="availability_mode" id="availability_mode_one" value="0" <?php if(!empty($single_rules) && $single_rules->availability_mode == "0"){?>checked="checked"<?php }?>><span>Standard (as soon as possible for availability and equal booking for all stylist)</span>    
									<input type="radio" class=" " name="availability_mode" id="availability_mode_one" value="1" <?php if(!empty($single_rules) && $single_rules->availability_mode == "1"){?>checked="checked"<?php }?>><span> Basic (Will check available stylists and their available time)</span>    
								</div> 
								<input type="hidden" name="old_availability_mode_value_label" id="old_availability_mode_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->availability_mode == '0'){
												echo 'Standard (as soon as possible for availability and equal booking for all stylist)';
											}elseif($single_rules->availability_mode == '1'){
												echo 'Basic (Will check available stylists and their available time)';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_availability_mode" id="old_availability_mode" value="<?php if(!empty($single_rules)){ echo $single_rules->availability_mode; } ?>">
							</div>  
							<div class="error" id="availability_mode_error"></div>		
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['availability_mode']);	
								if(empty($rule_request)){
							?>							
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_availability_mode" value="update_availability_mode" class="btn btn-primary update_availability_mode">Update</button>
								</div>
							</div>							
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>							
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_availability_mode" value="update_availability_mode" class="btn btn-primary update_availability_mode">Update</button>
								</div>
							</div>	
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div> -->
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label" id="booking_reminder_type_label">Booking Reminder Type | बुकिंग स्मरणपत्र प्रकार<b class="require">*</b></label>
									<input type="radio" class=" " name="booking_reminder_type" id="sms" value="1" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "1"){?>checked="checked"<?php }?>><span>SMS</span>    
									<input type="radio" class=" " name="booking_reminder_type" id="email" value="2" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "2"){?>checked="checked"<?php }?>><span>Email</span>    
									<input type="radio" class=" " name="booking_reminder_type" id="whatsapp" value="3" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "3"){?>checked="checked"<?php }?>><span>Whatsapp</span>    
								</div> 
								<input type="hidden" name="old_booking_reminder_type_value_label" id="old_booking_reminder_type_value_label" value="
									<?php 
										if(!empty($single_rules)){ 
											if($single_rules->booking_reminder_type == '1'){
												echo 'SMS';
											}elseif($single_rules->booking_reminder_type == '2'){
												echo 'Email';
											}elseif($single_rules->booking_reminder_type == '3'){
												echo 'Whatsapp';
											}
										} 
									?>
								"> 
								<input type="hidden" name="old_booking_reminder_type" id="old_booking_reminder_type" value="<?php if(!empty($single_rules)){ echo $single_rules->booking_reminder_type; } ?>">
							</div>  
							<div class="error" id="reminder_type_error"></div>			
							<?php 
								$rule_request = $this->Salon_model->get_salon_booking_rule_request($this->session->userdata('branch_id'),$this->session->userdata('salon_id'),['booking_reminder_type']);	
								if(empty($rule_request)){
							?>						
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" id="update_reminder_type" name="update_reminder_type" value="update_reminder_type" class="btn btn-primary update_reminder_type">Update</button>
									</div>
								</div>
							<?php 
								}else{									
									if($rule_request->approval_status == '1' || $rule_request->approval_status == '2'){ 
							?>					
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" id="update_reminder_type" name="update_reminder_type" value="update_reminder_type" class="btn btn-primary update_reminder_type">Update</button>
								</div>
							</div>
							<?php }else{ ?>
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12 form-group">
											<label style="color:red;font-size:12px;">Rule update request is pending for admin approval. Raised on: <?=date('d-m-Y h:i A',strtotime($rule_request->submitted_on));?></label>
										</div>
									</div>
							<?php }} ?>
						</div> 
					</div>
				</div>
				
			</div> 
		</div>
	</div>
 
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.store-booking-rules').addClass('active_cc');
    });
	function setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column){
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>salon/Ajax_controller/submit_booking_rule_change_request",
			data: {
				rule_id: $("#rule_id").val(),
				store_type: $("#store_type").val(),
				field_main_label: field_main_label,
				change_to : change_to,
				change_to_label : change_to_label,
				change_from: change_from,
				change_from_label : change_from_label,
				db_column : db_column,
				booking_rule_field: booking_rule_field,
			},
			success: function(response){ 
				$('#loader').hide();
				location.reload();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	}
	$('.update_selection').on('click', function(e){
		e.preventDefault();
		var old_employee_selection_value = $('#old_employee_selection').val();
		var old_employee_selection_value_label = $('#old_employee_selection_value_label').val().trim();
		var employee_selection_value = $('input[name="employee_selection"]:checked').val();
		var checkedemployeeSelectionValueLabel = $('input[name="employee_selection"]:checked').next('span').text().trim();
		var employee_selection_label = $('#employee_selection_label').text().trim();
		if(employee_selection_value === undefined) { 
			$("#selection_error").html("Please select employee selection option");
			return false;
		}else{
			$("#selection_error").html("");
		}
		$('#loader').show();

		var field_main_label = '';
		let change_to = [employee_selection_value];
		let change_to_label = [checkedemployeeSelectionValueLabel];
		let change_from = [old_employee_selection_value];
		let change_from_label = [old_employee_selection_value_label];
		let booking_rule_field = [employee_selection_label];
		let db_column = ['employee_selection'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_slot_time').on('click', function(e){
		e.preventDefault();
		var old_slot_time = $('#old_slot_time').val();
		var slot_time = $('input[name="slot_time"]:checked').val();		
		var old_slot_time_value_label = $('#old_slot_time_value_label').val().trim();
		var selected_slot_time_value_label = $('input[name="slot_time"]:checked').next('span').text().trim();
		var slot_time_label = $('#slot_time_label').text().trim();
		if(slot_time === undefined) { 
			$("#slot_time_error").html("Please select slot time");
			return false;
		}else{
			$("#slot_time_error").html("");
		}
		$('#loader').show();

		var field_main_label = '';
		let change_from = [old_slot_time];
		let change_to = [slot_time];
		let booking_rule_field = [slot_time_label];
		let db_column = ['slot_time'];

		let change_to_label = [selected_slot_time_value_label];
		let change_from_label = [old_slot_time_value_label];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_buffer_time').on('click', function(e){
		e.preventDefault();
		var old_buffering_time = $('#old_buffering_time').val();
		var buffering_time = $('input[name="buffering_time"]:checked').val();
		var buffering_time_label = $('#buffering_time_label').text().trim();
		var old_buffering_time_value_label = $('#old_buffering_time_value_label').val().trim();
		var selected_buffering_time_value_label = $('input[name="buffering_time"]:checked').next('span').text().trim();
		if(buffering_time === undefined) { 
			$("#buffering_time_error").html("Please select buffer time");
			return false;
		}else{
			$("#buffering_time_error").html("");
		}
		$('#loader').show();
		
		var field_main_label = '';
		let change_to = [buffering_time];
		let change_to_label = [selected_buffering_time_value_label];
		let change_from = [old_buffering_time];
		let change_from_label = [old_buffering_time_value_label];
		let booking_rule_field = [buffering_time_label];
		let db_column = ['buffering_time'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_rescheduling').on('click', function(e){
		e.preventDefault();
		var rescheduling = $('input[name="rescheduling"]:checked').val();
		var old_booking_rescheduling = $('#old_booking_rescheduling').val();
		var rescheduling_label = $('#rescheduling_label').text().trim();
		var old_booking_rescheduling_value_label = $('#old_booking_rescheduling_value_label').val().trim();
		var selected_rescheduling_value_label = $('input[name="rescheduling"]:checked').next('span').text().trim();
		if(rescheduling === undefined) { 
			$("#rescheduling_error").html("Please select rescheduling");
			return false;
		}else{
			$("#rescheduling_error").html("");
		}
		$('#loader').show();
		
		var field_main_label = '';
		let change_to = [rescheduling];
		let change_to_label = [selected_rescheduling_value_label];
		let change_from = [old_booking_rescheduling];
		let change_from_label = [old_booking_rescheduling_value_label];
		let booking_rule_field = [rescheduling_label];
		let db_column = ['booking_rescheduling'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_cancellation').on('click', function(e){
		e.preventDefault();
		var cancellation = $('input[name="cancellation"]:checked').val();
		var old_cancellation = $('#old_cancellation').val();
		var cancellation_label = $('#cancellation_label').text().trim();
		var old_cancellation_value_label = $('#old_cancellation_value_label').val().trim();
		var selected_cancellation_value_label = $('input[name="cancellation"]:checked').next('span').text().trim();
		if(cancellation === undefined) { 
			$("#cancellation_error").html("Please select cancellation");
			return false;
		}else{
			$("#cancellation_error").html("");
		}
		$('#loader').show();
		
		var field_main_label = '';
		let change_to = [cancellation];
		let change_to_label = [selected_cancellation_value_label];
		let change_from = [old_cancellation];
		let change_from_label = [old_cancellation_value_label];
		let booking_rule_field = [cancellation_label];
		let db_column = ['cancellation'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_reward_point_cancellation').on('click', function(e){
		e.preventDefault();
		var reward_point_cancellation = $('input[name="reward_point_cancellation"]:checked').val();
		var old_reward_point_cancellation = $('#old_reward_point_cancellation').val();
		var reward_point_cancellation_label = $('#reward_point_cancellation_label').text().trim();
		var old_reward_point_cancellation_value_label = $('#old_reward_point_cancellation_value_label').val().trim();
		var selected_reward_point_cancellation_value_label = $('input[name="reward_point_cancellation"]:checked').next('span').text().trim();
		if(reward_point_cancellation === undefined) { 
			$("#reward_point_cancellation_error").html("Please select cancellation reward point");
			return false;
		}else{
			$("#reward_point_cancellation_error").html("");
		}
		var reward_point_cancellation_late_customer = $('input[name="reward_point_cancellation_late_customer"]:checked').val();
		var old_reward_point_cancellation_late_customer = $('#old_reward_point_cancellation_late_customer').val();
		var reward_point_cancellation_late_customer_label = $('#reward_point_cancellation_late_customer_label').text().trim();
		var old_reward_point_cancellation_late_customer_value_label = $('#old_reward_point_cancellation_late_customer_value_label').val().trim();
		var selected_reward_point_cancellation_late_customer_value_label = $('input[name="reward_point_cancellation_late_customer"]:checked').next('span').text().trim();
		// if(reward_point_cancellation_late_customer === undefined) { 
		// 	$("#reward_point_cancellation_late_customer_error").html("Please select cancellation reward point");
		// 	return false;
		// }else{
		// 	$("#reward_point_cancellation_late_customer_error").html("");
		// }
		$('#loader').show();
		
		var field_main_label = $('#reward_point_cancellation_main_label').text().trim();
		let change_to = [reward_point_cancellation,reward_point_cancellation_late_customer];
		let change_to_label = [selected_reward_point_cancellation_value_label,selected_reward_point_cancellation_value_label];
		let change_from = [old_reward_point_cancellation,old_reward_point_cancellation_late_customer];
		let change_from_label = [old_reward_point_cancellation_value_label,old_reward_point_cancellation_late_customer_value_label];
		let booking_rule_field = [reward_point_cancellation_label,reward_point_cancellation_late_customer_label];
		let db_column = ['reward_point_cancellation','reward_point_cancellation_late_customer'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_booking_range_minute').on('click', function(e){
		e.preventDefault();
		var booking_time_range = $('input[name="booking_time_range"]:checked').val();
		var old_booking_time_range = $('#old_booking_time_range').val();
		var booking_time_range_label = $('#booking_time_range_label').text().trim();
		var old_booking_time_range_value_label = $('#old_booking_time_range_value_label').val().trim();
		var selected_booking_time_range_value_label = $('input[name="booking_time_range"]:checked').next('span').text().trim();
		if(booking_time_range === undefined) { 
			$("#booking_range_minute_error").html("Please select booking time range");
			return false;
		}else{
			$("#booking_range_minute_error").html("");
		}
		var max_booking_range_day = $('input[name="max_booking_range_day"]:checked').val();
		var old_max_booking_range_day = $('#old_max_booking_range_day').val();
		var max_booking_range_day_label = $('#max_booking_range_day_label').text().trim();
		var old_max_booking_range_day_value_label = $('#old_max_booking_range_day_value_label').val().trim();
		var selected_max_booking_range_day_value_label = $('input[name="max_booking_range_day"]:checked').next('span').text().trim();
		if(max_booking_range_day === undefined) { 
			$("#max_booking_range_day_error").html("Please select booking range day");
			return false;
		}else{
			$("#max_booking_range_day_error").html("");
		}
		$('#loader').show();
		
		var field_main_label = $('#booking_time_range_main_label').text().trim();
		let change_to = [booking_time_range,max_booking_range_day];
		let change_to_label = [selected_booking_time_range_value_label,selected_max_booking_range_day_value_label];
		let change_from = [old_booking_time_range,old_max_booking_range_day];
		let change_from_label = [old_booking_time_range_value_label,old_max_booking_range_day_value_label];
		let booking_rule_field = [booking_time_range_label,max_booking_range_day_label];
		let db_column = ['booking_time_range','max_booking_range_day'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	$('.update_availability_mode').on('click', function(e){
		e.preventDefault();
		var availability_mode = $('input[name="availability_mode"]:checked').val();
		var old_availability_mode = $('#old_availability_mode').val();
		var availability_mode_label = $('#availability_mode_label').text().trim();
		var old_availability_mode_value_label = $('#old_availability_mode_value_label').val().trim();
		var selected_availability_mode_value_label = $('input[name="availability_mode"]:checked').next('span').text().trim();
		if(availability_mode === undefined) { 
			$("#availability_mode_error").html("Please select availability mode");
			return false;
		}else{
			$("#availability_mode_error").html("");
		}		 
		$('#loader').show();
		
		var field_main_label = '';
		let change_to = [availability_mode];
		let change_to_label = [selected_availability_mode_value_label];
		let change_from = [old_availability_mode];
		let change_from_label = [old_availability_mode_value_label];
		let booking_rule_field = [availability_mode_label];
		let db_column = ['availability_mode'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
	
	$('#update_reminder_type').on('click', function(e){
		e.preventDefault();
		var reminder_type = $('input[name="booking_reminder_type"]:checked').val();
		var old_booking_reminder_type = $('#old_booking_reminder_type').val();
		var booking_reminder_type_label = $('#booking_reminder_type_label').text().trim();
		var old_booking_reminder_type_value_label = $('#old_booking_reminder_type_value_label').val().trim();
		var selected_booking_reminder_type_value_label = $('input[name="booking_reminder_type"]:checked').next('span').text().trim();
		if(reminder_type === undefined) { 
			$("#reminder_type_error").html("Please select reminder type");
			return false;
		}else{
			$("#reminder_type_error").html("");
		}
		 
		$('#loader').show();
		
		var field_main_label = '';
		let change_to = [reminder_type];
		let change_to_label = [selected_booking_reminder_type_value_label];
		let change_from = [old_booking_reminder_type];
		let change_from_label = [old_booking_reminder_type_value_label];
		let booking_rule_field = [booking_reminder_type_label];
		let db_column = ['booking_reminder_type'];

		setRuleUpdateRequest(field_main_label,change_to,change_to_label,change_from,change_from_label,booking_rule_field,db_column);
	});
</script>
 
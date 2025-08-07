<?php include('header.php'); 
?>
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
                    Manage Booking Rules
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
									<label class="rs_label">Employee Selection | कर्मचारी  निवड<b class="require">*</b></label>
									<?php 
										if(isset($_GET['type']) && $_GET['type'] == "1"){
									?>
									<input type="radio" class="form-select" name="employee_selection" id="employee_selection_multiple" value="0" <?php if(!empty($single_rules) && $single_rules->employee_selection == "0"){?>checked="checked"<?php }?>><span>Select Multiple stylist from backend |अनेक स्टायलिस्ट </span>
									<input type="radio" class="form-select" name="employee_selection" id="employee_selection_single" value="1" <?php if(!empty($single_rules) && $single_rules->employee_selection == "1"){?>checked="checked"<?php }?>><span>Select Single stylist from backend |एक स्टायलिस्ट</span> 
									<?php }else{?>
									<input type="radio" class="form-select " name="employee_selection" id="employee_selection_single_frontend" value="2" <?php if(!empty($single_rules) && $single_rules->employee_selection == "2"){?>checked="checked"<?php }?>><span>Select Single stylist from frontend |एक स्टायलिस्ट</span>
									<?php }?>
									<div class="error" id="selection_error"></div>
									<input type="hidden" name="type_of_rules" id="type_of_rules" value="<?=$_GET['type']?>">
								</div> 
							</div>  
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="button" name="update_selection" value="update_selection" class="btn btn-primary update_selection">Update</button>
								</div>
							</div> 
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<label class="rs_label">Slot time | बफरिंग वेळ<b class="require">*</b></label>
									<input type="radio" class="form-select " name="slot_time" id="slot_time" value="5" <?php if(!empty($single_rules) && $single_rules->slot_time == "5"){?>checked="checked"<?php }?>><span>5 min</span> 
								</div> 
							</div>  
							<div class="error" id="slot_time_error"></div>
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_slot_time" value="update_slot_time" class="btn btn-primary update_slot_time">Update</button>
								</div>
							</div>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Buffering time | बफरिंग वेळ (Break between two appointments | दोन अपॉइिंटमेंट मधील ब्रेक)<b class="require">*</b></label>
									<input type="radio" class="form-select " name="buffering_time" id="buffering_time" value="5" <?php if(!empty($single_rules) && $single_rules->buffering_time == "5"){?>checked="checked"<?php }?>><span>5 min</span>  
									<?php if(isset($_GET['type']) && $_GET['type'] == "1"){?>
									<input type="radio" class="form-select " name="buffering_time" id="buffering_time_another" value="10"  <?php if(!empty($single_rules) && $single_rules->buffering_time == "10"){?>checked="checked"<?php }?>><span>10 min</span>  
									<?php }?>
								</div> 
							</div>  
							<div class="error" id="buffering_time_error"></div>
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_buffer_time" value="update_buffer_time" class="btn btn-primary update_buffer_time">Update</button>
								</div>
							</div>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Booking Rescheduling बुकिंग रीशेड्युलिंग <b class="require">*</b></label>
									<input type="radio" class="form-select " name="rescheduling" id="rescheduling_time_one" value="30" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "30"){?>checked="checked"<?php }?>><span>30 min</span>  
									<input type="radio" class="form-select " name="rescheduling" id="rescheduling_time_two" value="45" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "45"){?>checked="checked"<?php }?>><span>45 min</span>  
									<input type="radio" class="form-select" name="rescheduling" id="rescheduling_time_two" value="60" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "60"){?>checked="checked"<?php }?>><span>60 min</span>  
									<input type="radio" class="form-select " name="rescheduling" id="rescheduling_time_two" value="1440" <?php if(!empty($single_rules) && $single_rules->booking_rescheduling == "1440"){?>checked="checked"<?php }?>><span>1 Day</span>  
									<p>How far in time advance can an appointment be changed? | अपॉइिंटमेंट किती वेळ अगोदर बदलली जाऊ शकते?</p>
								</div> 
							</div> 
							<div class="error" id="rescheduling_error"></div>	
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_rescheduling" value="update_rescheduling" class="btn btn-primary update_rescheduling">Update</button>
								</div>
							</div>
						</div> 
					</div>
				</div> 
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Cancellation | रद्द करणे<b class="require">*</b></label>
									<input type="radio" class="form-select " name="cancellation" id="rescheduling_time_one" value="00" <?php if(!empty($single_rules) && $single_rules->cancellation == "00"){?>checked="checked"<?php }?>><span>Anytime</span>  
									<input type="radio" class="form-select " name="cancellation" id="rescheduling_time_two" value="60" <?php if(!empty($single_rules) && $single_rules->cancellation == "60"){?>checked="checked"<?php }?>><span>60 min</span>    
									<input type="radio" class="form-select " name="cancellation" id="rescheduling_time_three" value="45" <?php if(!empty($single_rules) && $single_rules->cancellation == "45"){?>checked="checked"<?php }?>><span>45 min</span>    
									<input type="radio" class="form-select " name="cancellation" id="rescheduling_time_four" value="30" <?php if(!empty($single_rules) && $single_rules->cancellation == "30"){?>checked="checked"<?php }?>><span>30 min</span>    
									<input type="radio" class="form-select " name="cancellation" id="rescheduling_time_five" value="15" <?php if(!empty($single_rules) && $single_rules->cancellation == "15"){?>checked="checked"<?php }?>><span>15 min</span>    
									<p>How many minutes in advance can an appointment be cancelled?| अपॉइिंटमेंट किती मिनिटे अगोदर रद्द केली जाऊ शकते?</p>
								</div> 
							</div>  
							<div class="error" id="cancellation_error"></div>	
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_cancellation" value="update_cancellation" class="btn btn-primary update_cancellation">Update</button>
								</div>
							</div> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Reward point Cancellation | रिवॉर्ड पॉइंट रद्द करणे <b class="require">*</b></label>
									<label class="rs_label">Cancel Appointment <b class="require">*</b></label>
									<input type="radio" class="form-select " name="reward_point_cancellation" id="reward_point_cancellation" value="1" <?php if(!empty($single_rules) && $single_rules->reward_point_cancellation == "1"){?>checked="checked"<?php }?>><span>Will the reduction of reward points depend on the service chosen?| रिवॉर्ड पॉइंट्सची कपात निवडलेल्या सेवेवर अवलंबून असेल का?</span>    
									</div> 
							</div>  
							<div class="error" id="reward_point_cancellation_error"></div>	
							<pre></pre>
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Late Customer | ग्राहक उशिरा आल्यास <b class="require">*</b></label>
									<input type="radio" class="form-select " name="reward_point_cancellation_late_customer" id="reward_point_cancellation_late_customer" value="1" <?php if(!empty($single_rules) && $single_rules->reward_point_cancellation_late_customer == "1"){?>checked="checked"<?php }?>><span>If you are late for more than 5 minutes, 2 rewards will be reduced per minute | 5 तुम्हाला ५ मिनिटांपेक्षा जास्त उशीर झाल्यास, प्रति मिनिट २ रिवॉर्ड कमी केली जातील</span>    
								</div> 
							</div>  
							<div class="error" id="reward_point_cancellation_late_customer_error"></div>	
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_reward_point_cancellation" value="update_reward_point_cancellation" class="btn btn-primary update_reward_point_cancellation">Update</button>
								</div>
							</div> 
						</div> 
					</div>
				 
				
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label>Booking time range <b class="require">*</b></label>
								</div> 
							</div>  
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">How many minutes in advance can I book? | किती मिनिटे अगोदर बुक करू शकतो <b class="require">*</b></label>
									<input type="radio" class="form-select " name="booking_time_range" id="booking_range_one" value="15" <?php if(!empty($single_rules) && $single_rules->booking_time_range == "15"){?>checked="checked"<?php }?>><span>Before 15 Minutes</span>    
									<?php if(isset($_GET['type']) && $_GET['type'] == "1"){?>
									<input type="radio" class="form-select " name="booking_time_range" id="booking_range_twwo" value="30" <?php if(!empty($single_rules) && $single_rules->booking_time_range == "30"){?>checked="checked"<?php }?>><span>Before 30 Minutes</span>    
									<?php }?>
								</div> 
							</div> 
							<div class="error" id="booking_range_minute_error"></div>
							<br>
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">How many days can I book | मी किती दिवस बुक करू शकतो <b class="require">*</b></label>
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_one" value="2" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "2"){?>checked="checked"<?php }?>><span>2 Days</span>    
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_two" value="3" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "3"){?>checked="checked"<?php }?>><span>3 Days</span>    
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_three" value="7" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "7"){?>checked="checked"<?php }?>><span>1 Week</span>    
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_four" value="14" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "14"){?>checked="checked"<?php }?>><span>2 Week</span>    
									<input type="radio" class="form-select" name="max_booking_range_day" id="max_booking_range_day_five" value="21" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "21"){?>checked="checked"<?php }?>><span>3 Week</span>    
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_six" value="30" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "30"){?>checked="checked"<?php }?>><span>1 Month</span>
									<?php if(isset($_GET['type']) && $_GET['type'] == "1"){?>
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_seven" value="60" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "60"){?>checked="checked"<?php }?>><span>2 Month</span>    
									<input type="radio" class="form-select " name="max_booking_range_day" id="max_booking_range_day_seven" value="90" <?php if(!empty($single_rules) && $single_rules->max_booking_range_day == "90"){?>checked="checked"<?php }?>><span>3 Month</span>    
									<?php }?>
								</div> 
							</div>
							<div class="error" id="max_booking_range_day_error"></div>
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_booking_range_minute" value="update_booking_range_minute" class="btn btn-primary update_booking_range_minute">Update</button>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Availability mode | उपलब्धता<b class="require">*</b></label>
									<?php if(isset($_GET['type']) && $_GET['type'] == "1"){?>
									<input type="radio" class="form-select " name="availability_mode" id="availability_mode_one" value="0" <?php if(!empty($single_rules) && $single_rules->availability_mode == "0"){?>checked="checked"<?php }?>><span>Standard (as soon as possible for availability and equal booking for all stylist</span>    
									<?php }else{?>
									<input type="radio" class="form-select " name="availability_mode" id="availability_mode_one" value="1" <?php if(!empty($single_rules) && $single_rules->availability_mode == "0"){?>checked="checked"<?php }?>><span> Basic (Will check available stylists and their available time)</span>    
									<?php }?>
									 </div> 
							</div>  
							<div class="error" id="availability_mode_error"></div>
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" name="update_availability_mode" value="update_availability_mode" class="btn btn-primary update_availability_mode">Update</button>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="rs_label">Booking Reminder Type | बुकिंग स्मरणपत्र प्रकार<b class="require">*</b></label>
									<input type="radio" class="form-select " name="booking_reminder_type" id="sms" value="1" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "1"){?>checked="checked"<?php }?>><span>SMS</span>    
									<input type="radio" class="form-select " name="booking_reminder_type" id="email" value="2" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "2"){?>checked="checked"<?php }?>><span>Email</span>    
									<input type="radio" class="form-select " name="booking_reminder_type" id="whatsapp" value="3" <?php if(!empty($single_rules) && $single_rules->booking_reminder_type == "3"){?>checked="checked"<?php }?>><span>Whatsapp</span>    
								</div> 
							</div>  
							<div class="error" id="reminder_type_error"></div>
							<pre></pre>
							<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12 form-group">
									<button type="submit" id="update_reminder_type" name="update_reminder_type" value="update_reminder_type" class="btn btn-primary update_reminder_type">Update</button>
								</div>
							</div>
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
        $('#rules_form').validate({
            ignore: "",
            rules: {
                type: 'required',
            },
            messages: {
                type: 'Please select salon type!', 
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
	$('.update_selection').on('click', function(e){
		e.preventDefault();
		var employeeSelection = $('input[name="employee_selection"]:checked').val();
		if(employeeSelection === undefined) { 
			$("#selection_error").html("Please select employee selection option");
			return false;
		}else{
			$("#selection_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_emp_selection_setup",
			data: {employee_selection: employeeSelection,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_slot_time').on('click', function(e){
		e.preventDefault();
		var slot_time = $('input[name="slot_time"]:checked').val();
		if(slot_time === undefined) { 
			$("#slot_time_error").html("Please select slot time");
			return false;
		}else{
			$("#slot_time_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_slot_time_setup",
			data: {slot_time: slot_time,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_buffer_time').on('click', function(e){
		e.preventDefault();
		var buffering_time = $('input[name="buffering_time"]:checked').val();
		if(buffering_time === undefined) { 
			$("#buffering_time_error").html("Please select buffer time");
			return false;
		}else{
			$("#buffering_time_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_buffering_time_setup",
			data: {buffering_time: buffering_time,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_rescheduling').on('click', function(e){
		e.preventDefault();
		var rescheduling = $('input[name="rescheduling"]:checked').val();
		if(rescheduling === undefined) { 
			$("#rescheduling_error").html("Please select rescheduling");
			return false;
		}else{
			$("#rescheduling_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_rescheduling_setup",
			data: {rescheduling: rescheduling,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_cancellation').on('click', function(e){
		e.preventDefault();
		var cancellation = $('input[name="cancellation"]:checked').val();
		if(cancellation === undefined) { 
			$("#cancellation_error").html("Please select cancellation");
			return false;
		}else{
			$("#cancellation_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_cancellation_setup",
			data: {cancellation: cancellation,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_reward_point_cancellation').on('click', function(e){
		e.preventDefault();
		var reward_point_cancellation = $('input[name="reward_point_cancellation"]:checked').val();
		if(reward_point_cancellation === undefined) { 
			$("#reward_point_cancellation_error").html("Please select cancellation reward point");
			return false;
		}else{
			$("#reward_point_cancellation_error").html("");
		}
		var reward_point_cancellation_late_customer = $('input[name="reward_point_cancellation_late_customer"]:checked').val();
		if(reward_point_cancellation_late_customer === undefined) { 
			$("#reward_point_cancellation_late_customer_error").html("Please select cancellation reward point");
			return false;
		}else{
			$("#reward_point_cancellation_late_customer_error").html("");
		}
		 $('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_reward_cancellation_setup",
			data: {reward_point_cancellation: reward_point_cancellation,reward_point_cancellation_late_customer:reward_point_cancellation_late_customer,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_booking_range_minute').on('click', function(e){
		e.preventDefault();
		var booking_time_range = $('input[name="booking_time_range"]:checked').val();
		if(booking_time_range === undefined) { 
			$("#booking_range_minute_error").html("Please select booking time range");
			return false;
		}else{
			$("#booking_range_minute_error").html("");
		}
		var max_booking_range_day = $('input[name="max_booking_range_day"]:checked').val();
		if(max_booking_range_day === undefined) { 
			$("#max_booking_range_day_error").html("Please select booking range day");
			return false;
		}else{
			$("#max_booking_range_day_error").html("");
		}
		$('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_booking_range_minute",
			data: {booking_time_range:booking_time_range,max_booking_range_day: max_booking_range_day,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	$('.update_availability_mode').on('click', function(e){
		e.preventDefault();
		var availability_mode = $('input[name="availability_mode"]:checked').val();
		if(availability_mode === undefined) { 
			$("#availability_mode_error").html("Please select availability mode");
			return false;
		}else{
			$("#availability_mode_error").html("");
		}
		 
		$('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_availability_mode_setup",
			data: {availability_mode:availability_mode,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				console.log(response);
				$('#loader').hide();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
	
	$('#update_reminder_type').on('click', function(e){
		e.preventDefault();
		var reminder_type = $('input[name="booking_reminder_type"]:checked').val();
		if(reminder_type === undefined) { 
			$("#reminder_type_error").html("Please select reminder type");
			return false;
		}else{
			$("#reminder_type_error").html("");
		}
		 
		$('#loader').show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/Ajax_controller/update_booking_reminder_type_setup",
			data: {reminder_type:reminder_type,'type_of_rules':$("#type_of_rules").val()},
			success: function(response){ 
				$('#loader').hide();
				location.reload();
			},
			error: function(xhr, status, error) { 
				console.error(xhr.responseText);
			}
		});
	});
</script>
 
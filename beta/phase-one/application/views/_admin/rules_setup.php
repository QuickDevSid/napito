<?php include('header.php'); 
?>
 <div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Manage Booking Rules for <?php if(isset($_GET['type']) && $_GET['type'] == "1"){?>Standard<?php }else{?>Medium<?php }?>
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
							<form method="post" class="form-group" name="selection_form" id="selection_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<label>Employee Selection | कर्मचारी ननवड<b class="require">*</b></label>
										<?php 
											if(isset($_GET['type']) && $_GET['type'] == "1"){
										?>
										<input type="radio" class="form-select form-control" name="employee_selection" id="employee_selection_multiple" value="0">Select Multiple stylist from backend |अनेक स्टायलिस्ट 
										<input type="radio" class="form-select form-control" name="employee_selection" id="employee_selection_single" value="1">Select Single stylist from backend |एक स्टायलिस्ट 
										<?php }else{?>
										<input type="radio" class="form-select form-control" name="employee_selection" id="employee_selection_single_frontend" value="2">Select Single stylist from frontend |एक स्टायलिस्ट
										<?php }?>
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_selection" value="update_selection" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="slot_form" id="slot_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<label>Slot time | स्िॉट वेळ<b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="slot_time" id="slot_time" value="5">5 min  
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_slot_time" value="update_slot_time" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="buffer_form" id="buffer_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Slot time | स्िॉट वेळ (Break between two appointments | दोन अपॉइिंटमेंट मधीि ब्रेक)<b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="buffering_time" id="buffering_time" value="5">5 min  
										<input type="radio" class="form-select form-control" name="buffering_time" id="buffering_time_another" value="10">10 min  
										
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_slot_time" value="update_slot_time" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="rescheduling_form" id="rescheduling_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Booking Rescheduling अपॉइिंटमेंट <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="rescheduling" id="rescheduling_time_one" value="30">30 min  
										<input type="radio" class="form-select form-control" name="rescheduling" id="rescheduling_time_two" value="45">45 min  
										<input type="radio" class="form-select form-control" name="rescheduling" id="rescheduling_time_two" value="60">60 min  
										<input type="radio" class="form-select form-control" name="rescheduling" id="rescheduling_time_two" value="1440">1 Day  
										<p>How far in time advance can an appointment be changed? | अपॉइंटर्ेंट ककती वेळ अगोदर बदलली जाऊ शकते?</p>
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_rescheduling" value="update_rescheduling" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="cancellation_form" id="cancellation_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Cancellation <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_one" value="00">Anytime  
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_two" value="60">60 min    
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_three" value="45">45 min    
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_four" value="30">30 min    
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_five" value="15">15 min    
										<p>How many minutes in advance can an appointment be cancelled?| अपॉइंटर्ेंट ककती मर्ननटे अगोदर कॅ न्सि होऊ शकते?</p>
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_cancellation" value="update_cancellation" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="reward_point_cancellation_form" id="reward_point_cancellation_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Reward point Cancellation | ररवॉडा पॉइिंट कॅ न्सि करि <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="cancellation" id="rescheduling_time_one" value="1">Depends on the service chosen? | ननवडिेल्या सर्व्हास वर अवििंबून असेि?    
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_reward_point_cancellation" value="update_reward_point_cancellation" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="booking_range_form" id="booking_range_form" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Booking time range <b class="require">*</b></label>
									</div> 
								</div>  
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>How many minutes in advance can I book? | ककती लमननट अगोदर बुककिं ग करता येईि <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="booking_range_minute" id="booking_range_one" value="15">Before 15 Minutes    
										<input type="radio" class="form-select form-control" name="booking_range_minute" id="booking_range_twwo" value="30">Before 30 Minutes    
									</div> 
								</div>  
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>How many days can I book | ककती ददवसापयंत बु ककिंग करता येईि <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_one" value="2">2 Days    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_two" value="3">3 Days    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_three" value="7">1 Week    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_four" value="14">2 Week    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_five" value="21">3 Week    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_six" value="30">1 Month    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_seven" value="60">2 Month    
										<input type="radio" class="form-select form-control" name="max_booking_range_day" id="max_booking_range_day_seven" value="90">3 Month    
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_reward_point_cancellation" value="update_reward_point_cancellation" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
						</div> 
					</div>
				</div>
				<div class="x_panel">
                    <div class="x_content">
						<div class="container"> 
							<form method="post" class="form-group" name="availability_mode_form" id="availability_mode_form" enctype="multipart/form-data">
								 
								<div class="row"> 
									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label>Availability mode <b class="require">*</b></label>
										<input type="radio" class="form-select form-control" name="availability_mode" id="availability_mode_one" value="0">Basic (checks booking date only)    
										<input type="radio" class="form-select form-control" name="availability_mode" id="availability_mode_two" value="1">Advanced (also evaluates booking duration)    
										<input type="radio" class="form-select form-control" name="availability_mode" id="availability_mode_three" value="2">High End (also assesses duration and priority of service)    
									</div> 
								</div>  
								<pre></pre>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12 form-group">
										<button type="submit" name="update_availability_mode" value="update_availability_mode" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form> 
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
</script> 
 
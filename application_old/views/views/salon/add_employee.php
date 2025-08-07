<?php 
// echo "<pre>";print_r($single);exit;

include('header.php'); ?>


	
<style> 
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
a {
	text-decoration: none;
}
ul {
	list-style-type: none;
}
 

.radio-section {
	display: flex;
	align-items: center;
	/* justify-content: center; */
	/*height: 100vh;*/
}
.radio-list h3{
  font-size: 16px;
  color: black;

}
h1 {
	margin-bottom: 20px;
}
.radio-item [type="radio"] {
	display: none;
}
.radio-item + .radio-item {
	margin-top: 15px;
}
.radio-item label {
    display: block;
    padding: 8px 60px;
    background: #ffffff;
    border: 2px solid rgb(203 182 182 / 10%);
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 400;
    min-width: 250px;
    white-space: nowrap;
    position: relative;
    transition: 0.4s ease-in-out 0s;
}
.radio-item label:after,
.radio-item label:before {
	content: "";
	position: absolute;
	border-radius: 50%;
}
.radio-item label:after {
    height: 15px;
    width: 15px;
    border: 2px solid var(--hover);
    left: 19px;
    top: calc(50% - 6px);
}
.radio-item label:before {
	background: var(--hover);
	height: 15px;
	width: 15px;
	left: 19px;
	top: 12px;
	transform: scale(5);
	opacity: 0;
	visibility: hidden;
	transition: 0.4s ease-in-out 0s;
}
.radio-item [type="radio"]:checked ~ label {
	border-color: var(--hover);
}
.radio-item [type="radio"]:checked ~ label::before {
	opacity: 1;
	visibility: visible;
	transform: scale(1);
}

.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #0000ff;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #0000ff;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #0000ff;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #0000ff;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
 /*background-color: #0000ff;
  border: 4px dashed #fff;*/
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
   
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}




.slide {   
  display: none;
}

.slide.active {
  display: block;
}
.next_btn{
	
}
.prev_btn{
	margin-bottom: 5px;
    margin-right: 5px;
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.remove-btn{
  margin-left: 68px;
  padding: 3px;
  color: #1a698a;
  font-weight: 600;
}
.checkbox-container {
  max-height: 300px; /* Adjust the height as needed */
  overflow-y: auto; /* Make the container scrollable */
  border: 1px solid #ddd; /* Optional: add a border */
  padding: 10px; /* Optional: add padding */
}
.checkbox-container label {
  display: block; /* Ensures each checkbox is on a new line */
  margin-bottom: 5px; /* Adds space between checkboxes */
}
    .search-box {
      margin-bottom: 10px; /* Space between search box and checkboxes */
    }
    

</style>
<div class="right_col" role="main">
    
       
        <div class="row">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="active">
                        <a href="<?=base_url()?>add_employee<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Add Employee</a>
                    </li>
                    <li class="">
                        <a href="<?=base_url()?>add_employee_list<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Employee List</a>
                    </li>                   
                    <li>
                        <a class="<?php if(empty(array_intersect(['employee_incentive_master'], $feature_slugs))) { echo 'blurred '; }?>" href="<?=base_url()?>employee_incentive_master<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Empolyee Incentive</a>
                    </li>


                </ul>
                <br>
            </div>

            <div class="tab-content">
                <div class="tab-panel">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php 
                                      $is_update = $this->uri->segment(2) == "" ? false : true;
                                      $allowed_emps = 'Unlimited';
                                      $compare_value = '0';
                                      if (!empty(array_intersect(['3_stylists'], $feature_slugs))) {
                                          $allowed_emps = 3;
                                          $compare_value = '1';
                                      } elseif (!empty(array_intersect(['4_stylists'], $feature_slugs))) {
                                          $allowed_emps = 4;
                                          $compare_value = '1';
                                      } elseif (!empty(array_intersect(['unlimited_stylists'], $feature_slugs))) {
                                          $compare_value = '0';
                                          $allowed_emps = 'Unlimited';
                                      }
                                      $can_add_employee = ($compare_value === '0') || ($total_emp < $allowed_emps);
                                      if ($can_add_employee || $is_update) {
                                    ?>
										<form  method="post" name="employee_form" id="employee_form" class="employee_form" enctype="multipart/form-data">
                      <div class="slide one active">
                        <div style="float:right;">
                          <label class="next_step">1/8</label>
                        </div>
												<section class="radio-section">
													<div class="radio-list">
														<h3>Choose Staff Designation?</h3>
                            <?php if(!empty($designation)){ foreach($designation as $designation_result){ ?>
                              <div class="radio-item"><input onchange="setServiceDiv()" class="next-step" name="staff_type" id="radio<?=$designation_result->id;?>" value="<?=$designation_result->id;?>" type="radio" <?php if (!empty($single) && $single->designation == $designation_result->id) {echo "checked";} ?>><label for="radio<?=$designation_result->id;?>"><?=$designation_result->designation;?></label></div>
                              <input type="hidden" name="designation_name_<?=$designation_result->id;?>" id="designation_name_<?=$designation_result->id;?>" value="<?=$designation_result->designation;?>">
                            <?php }}else{ ?>
                              <div class=""> 
                                <label class="error">Designations Not Available <a href="<?=base_url();?>add-designation" style="text-decoration:underline;">ADD NOW</a></label>
                              </div>
                            <?php } ?>
                            <input type="hidden" name="selected_designation_name" id="selected_designation_name" value="">
														<!-- <div class="radio-item"><input class="next-step" name="staff_type" id="radio1" value="1" type="radio" <?php if (!empty($single) && $single->staff_type == 1) {echo "checked";} ?>><label for="radio1">Stylist</label></div>
														<div class="radio-item"><input class="next-step" name="staff_type" id="radio2" value="2" type="radio" <?php if (!empty($single) && $single->staff_type == 2) {echo "checked";} ?>><label for="radio2">Receptionist</label></div>
														<div class="radio-item"><input class="next-step" name="staff_type" id="radio3" value="3" type="radio" <?php if (!empty($single) && $single->staff_type == 3) {echo "checked";} ?>><label for="radio3">Manager</label></div>
														<div class="radio-item"><input class="next-step" name="staff_type" id="radio4" value="4" type="radio" <?php if (!empty($single) && $single->staff_type == 4) {echo "checked";} ?>><label for="radio4">Cleaner</label></div> -->
                            <label class="error" id="staff_type_error"></label>
													</div>
												</section>
                        
                        <div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <!-- <button type="button" id="rev_two" class="prev_btn">Previous</button> -->
                             <?php if(!empty($designation)){ ?>
															  <button type="button" id="first_next" class="next_step btn btn-primary">Next</button>
                              <?php } ?>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide two">
                        <div style="float:right;">
                          <label class="next_step">2/8</label>
                        </div>
												<section class="radio-section">
													<div class="radio-list">
														<!-- <h3>Upload Photo</h3> -->
														<div class="form-group col-md-12 col-sm-12 col-xs-12"> 
															<div class="file-upload" style="display: <?php if (!empty($single->profile_photo)) {echo 'none';} else {echo 'block';} ?>">
																<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload photo here</button> 
																
                    
                                <div class="image-upload-wrap">
																	<input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="profile_photo" id="profile_photo">
																	<div class="drag-text">
																		<!-- <h3>Drag and drop a file or select add Image</h3> -->
																		<h3>Select Image</h3>
																	</div>
																</div>


																<div class="file-upload-content">
																	<img class="file-upload-image" alt="your image" />
																	<div class="image-title-wrap">
																	  <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
																	</div>
																</div>
															</div>
															<input  type="hidden" name="old_profile_photo" value="<?php if (!empty($single)) {echo $single->profile_photo;} ?>">
														</div>

                            <div class="uploaded-contents" style="display: <?php if (!empty($single->profile_photo)) {echo 'block';} else {echo 'none';} ?>">
                              <?php if(!empty($single) && $single->profile_photo != ""){?>
																	<img class="file-upload-image" src="<?= base_url();?>admin_assets/images/employee_profile/<?=$single->profile_photo?>" alt="your image" />
                              <?php } ?>
                              <div>
                                <button type="button" name="remove" id="remove" onclick="removeUpload_button()" class="remove-btn">Remove</button>
                              </div>
                            </div>



													</div>
												</section> 
												<div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <button type="button" id="rev_two" class="prev_btn">Previous</button>
															  <button type="button" id="second_next" class="next_step btn btn-primary">Next</button>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide three">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">3/8</label>
                          </div>
                        </div>
												<div class="row">
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Name <b class="require">*</b></label>
														<input autocomplete="off" class="form-control" type="text" name="name" id="name" value="<?php if (!empty($single)) { echo $single->full_name; } ?>" placeholder="Enter Name">
														<input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
													</div>
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Phone Number <b class="require">*</b></label>
														<input autocomplete="off" maxlength="10" oninput="this.value = this.value.replace(/\s/g, '');" class="form-control" type="text" name="phone_number" id="phone_number" value="<?php if (!empty($single)) {echo $single->whatsapp_number; } ?>" placeholder="Enter Phone Number">
													</div>
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Email</label>
														<input autocomplete="off" class="form-control" type="text" oninput="this.value = this.value.replace(/\s/g, '');" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter Email">
													</div>
												</div>
												<div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <button type="button" id="rev_three" class="prev_btn">Previous</button>
															  <button type="button" id="third_next" class="next_step btn btn-primary">Next</button>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide four">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">4/8</label>
                          </div>
                        </div>
												<div class="row">   
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Gender<b class="require">*</b></label>
                                <select class="form-select form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                    <option value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                    <!-- <option value="2" <?php if(!empty($single) && $single->gender == '2'){?>selected="selected"<?php }?>>Other</option>  -->
                                </select>
														<div class="error" id="gender_error"></div>
                                                    </div>  
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Date Of Birth </label>
														<input autocomplete="off" class="form-control datepicker_employee" readonly style="cursor:pointer;" type="text" name="dob" id="dob" value="<?php if (!empty($single) && $single->dob != "" && $single->dob != NULL && $single->dob != '0000-00-00' && $single->dob != '1970-01-01') {echo date('d-m-Y',strtotime($single->dob));} ?>"placeholder="Select Date Of Birth">
													</div>
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Address</label>
														<input autocomplete="off" class="form-control" type="address" name="address" id="address" value="<?php if (!empty($single)) {echo $single->address; } ?>" placeholder="Enter description">
													</div> 	
                                                </div>
												<div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <button type="button" id="rev_four" class="prev_btn">Previous</button>
															  <button type="button" id="fourth_next" class="next_step btn btn-primary">Next</button>
															</div>
														  </div>
													</div>
												</div> 
											</div>
                                                    
												<div class="slide five">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">5/8</label>
                          </div>
                        </div>
                                <input type="hidden" name="is_upcoming_bookings" id="is_upcoming_bookings" value="<?php if(empty($upcoming_appointments)){ echo '0'; }else{ echo '1'; } ?>">
                              <div class="row" style="<?php if(empty($upcoming_appointments)){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>"> 
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                  <label>Shift Type<b class="require">*</b></label>
                                  <select class="form-select form-control fifth_validate" name="shift_type" id="shift_type">
                                      <option value="">Select Shift Type</option>
                                      <option value="0" <?php if (!empty($single) && $single->shift_type == '0') { echo 'selected'; } ?>>Regular</option>
                                      <option value="1" class="<?php if(empty(array_intersect(['rotational-shift'], $feature_slugs))) { echo 'blurred '; }?>" <?php if (!empty($single) && $single->shift_type == '1') { echo 'selected'; } ?>>Rotational</option>
                                  </select>
                                  <div class="error" id="shift_type_error"></div>
                                </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Shift<b class="require">*</b></label>
                                <select class="form-select form-control fifth_validate" name="shift" id="shift">
                                    <option value="">Select Shift</option>
                                    <?php
                                        if(!empty($single)){
                                            $shifts = $this->Salon_model->get_all_shifts_typewise($single->shift_type);   
                                            if(!empty($shifts)){
                                                foreach($shifts as $shifts_result){
                                    ?>
                                    <option value="<?=$shifts_result->id;?>" <?php if (!empty($single) && $single->shift == $shifts_result->id) { echo 'selected'; } ?>><?=$shifts_result->shift_name;?></option>
                                    <?php }}
                                    } 
                                    ?>
                                </select>
                                <div class="error" id="shift_error"></div>
                              </div>
                            </div>
                              <div class="row" style="<?php if(empty($upcoming_appointments)){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>"> 
                                    <div class="form-group col-md-8 col-sm-6 col-xs-12 service_name_validation" id="services_selection_div">
                                      <div class="form-group col-md-6 col-sm-6 col-xs-6 service_name_validation">
                                        <label>Select Service <b class="require">*</b></label>
                                      </div>
                                      <div class="form-group col-md-6 col-sm-6 col-xs-6 service_name_validation">
                                        <label>Check All</label>
                                      <input type="checkbox" class="" name="all_service_name" id="all_service_name">
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12 checkbox-container">
                                        <?php 
                                          if (!empty($service_name)) {
                                            $service_exp = [];
                                            if (!empty($single)){
                                              $service_exp = explode(",",$single->service_name);
                                            }
                                            foreach ($service_name as $service_name) { 
                                              if($service_name->gender = '0'){
                                                $service_gender = '[Male]';
                                              }elseif($service_name->gender = '1'){
                                                $service_gender = '[Female]';
                                              }else{
                                                $service_gender = '';
                                              }
                                        ?>
                                        <label class="service-name">
                                          <input type="checkbox" class="services-checkbox" name="service_name[]" id="service_name_<?= $service_name->id ?>" <?php if (in_array($service_name->id,$service_exp)){?>checked<?php }?> value="<?= $service_name->id ?>">
                                          <?= $service_name->service_name . ' | ' . $service_name->service_name_marathi . '' . $service_gender; ?>
                                        </label>
                                        <?php }} ?>
                                      </div>
                                      <div class="error" id="service_name_error"></div>
                                    </div> 
                                </div>
                                <?php if(!empty($upcoming_appointments)){ ?>
                                  <div class="row"> 
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <label class="" style="color:red;">Can not update shift and services details now as this stylist has already received bookings.<br>Transfer those bookings, if you want to update the details. <a href="<?=base_url();?>transfer-bookings<?php if (!empty($single)) { echo '?stylist='.$single->id; } ?>" style="text-decoration:underline;" target="_blank">Transfer Now</a></label>
                                    </div>
                                  </div>
                                <?php } ?>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_five" class="prev_btn">Previous</button>
																  <button type="button" id="fifth_next" class="next_step btn btn-primary">Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide six"> 
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">6/8</label>
                          </div>
                        </div>
                                                    <div class="row"> 
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Select Identity Type <b class="require">*</b></label>
                                                            <select class="form-select form-control" name="identity" id="identity">
                                                                <option value="">Select Identity</option>
                                                                <option value="1" <?php if (!empty($single) && $single->identity == 1) echo 'selected'; ?>>Pan Card</option>
                                                                <option value="2" <?php if (!empty($single) && $single->identity == 2) echo 'selected'; ?>>Aadhaar Card</option>
                                                                <option value="3" <?php if (!empty($single) && $single->identity == 3) echo 'selected'; ?>>Driving License</option>
                                                                <!-- <option value="4" <?php if (!empty($single) && $single->identity == 4) echo 'selected'; ?>>Passport</option> -->
                                                                <option value="5" <?php if (!empty($single) && $single->identity == 5) echo 'selected'; ?>>Voter ID</option>
                                                            </select>
															<div class="error" id="identity_error"></div>
                                                        </div>  
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Upload Identity Proof <b class="require">*</b> 
                                    <?php if(!empty($single) && $single->identy_proof !=''){?>
                                        <a class="" href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a class="" download href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </label>
                                    <input autocomplete="off" class="form-control" type="file" accept=".pdf,.jpg,.png,.jpeg,.webp" name="identy_proof" id="identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
															<input type="hidden" accept=".pdf,.jpg,.png,.jpeg,.webp" name="old_identy_proof" id="old_identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
															<div class="error" id="identity_proof_error"></div>
                                                            
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Description</label>
                                                            <input autocomplete="off" class="form-control" type="text" name="description" id="description" value="<?php if (!empty($single)) {echo $single->description; } ?>" placeholder="Enter description">

                                                        </div>
													</div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_six" class="prev_btn">Previous</button>
																  <button type="button" id="sixth_next" class="next_step btn btn-primary">Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide seven">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">7/8</label>
                          </div>
                        </div>
													<div class="row">
                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                  <label>Target <b class="require">*</b></label>
                                  <select class="form-select form-control" name="salary_method" id="salary_method">
                                      <option value="">Select Target</option>
                                      <?php 
                                          $get_salary_method = $this->Salon_model->get_salary_method();                                        
                                          $selected_salary_method = !empty($single) ? $single->salary_method : '';
                                          if (!empty($get_salary_method)) {
                                              foreach ($get_salary_method as $method) {
                                                      $selected = ($selected_salary_method == $method->id) ? 'selected' : '';
                                                      echo '<option value="' . $method->id . '" ' . $selected . '>Level ' . $method->level . ' [Rs. ' . $method->start_amount . ' to Rs. ' . $method->end_amount . ']</option>';
                                              }
                                          }
                                          ?>
                                  </select>
															<div class="error" id="salary_method_error"></div>
                                  </div> 

                                  <div class="form-group group col-md-4 col-sm-6 col-xs-12">
                                      <label>Monthly Payment<b class="require">*</b> <small>(In INR)</small></label>
                                      <input autocomplete="off" type="text" class="form-control" oninput="this.value = this.value.replace(/\s/g, '');" name="salary" id="salary" value="<?php if (!empty($single)) {echo $single->salary;} ?>" placeholder="Enter Monthly Payment">
															<div class="error" id="salary_error"></div>
                                                        </div>
														<div class="form-group group col-md-4 col-sm-6 col-xs-12">
                          <label>Date Of Joining<b class="require">*</b></label>
                          <input style="cursor:pointer;" readonly autocomplete="off" type="text" class="form-control datepicker_employee" name="date_of_join" id="date_of_join" value="<?php if (!empty($single)) {echo date("d-m-Y",strtotime($single->date_of_join));}else{ echo date('d-m-Y'); } ?>" placeholder="Select Date Of Joining"> 
															<div class="error" id="date_of_join_error"></div>
                                                        </div>
													</div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_seven" class="prev_btn">Previous</button>
																  <button type="button" id="seventh_next" class="next_step btn btn-primary" >Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide eight">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
                            <label class="next_step">8/8</label>
                          </div>
                        </div>
													<div class="row">
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Account Holder Name <b class="require"></b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) { echo $single->account_holder_name;} ?>" placeholder="Enter Account Holder Name">
                                                        </div>   
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Bank Name<b class="require"></b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="bank_name" id="bank_name" value="<?php if (!empty($single)) { echo $single->bank_name;} ?>" placeholder="Enter Bank Name">
                                                        </div>
														<div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Account Number <b class="require"></b></label>
                                                            <input autocomplete="off" class="form-control" type="text" oninput="this.value = this.value.replace(/\s/g, '');" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter Account Number">
                                                        </div>   
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Confirm Bank Account Number <b class="require"></b></label>
                                                            <input autocomplete="off" class="form-control" type="text" oninput="this.value = this.value.replace(/\s/g, '');" name="confirm_account_number" id="confirm_account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Confirm Account Number">
                                                        </div>   
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>IFSC Code <b class="require"></b></label>
                                                            <input autocomplete="off" class="form-control" type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '');" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {echo $single->ifsc; } ?>" placeholder="SBIN0011513">
                                                        </div>
                                                    </div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_eight" class="prev_btn">Previous</button>
																  <button type="submit" id="submit_form" class="btn btn-primary">Submit</button>
																</div>
															  </div>
														</div>
													</div>
												</div>    
                                        </form>
                                        <?php }else{ ?>
                                          <div style="text-align: center;">
                                            <label class="error">
                                              You have reached the maximum number of employees allowed for your subscription.<br>
                                              <small>(Allowed Employees: <?=$allowed_emps;?>)</small>
                                            </label>
                                          </div>
                                        <?php } ?>
                                   </div> 
                                 
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
$(".slide.one .next_step").click(function() {
    $('.error').hide();
    $('.error').text('');
    if (!$("input[name='staff_type']:checked").val()) {
        $('#staff_type_error').show();
        $('#staff_type_error').text('Please select staff designation');
        return;
    }
    
    $(".slide.one").removeClass("active");
    $(".slide.two").addClass("active");
});
$(".slide.two .next_step").click(function() {
    $(".slide.two").removeClass("active");
    $(".slide.three").addClass("active");
});
$.validator.addMethod("equalToAccountNumber", function(value, element) {
    return value === $("#account_number").val();
}, "Account numbers do not match.");

$(".slide.three .next_step").click(function() {
  var form = $("#employee_form");
  form.validate({
    rules: {
      name: {
        required: true, 
      },
      phone_number: {
        required: true, 
        number: true, 
        minlength: 10, 
        maxlength: 10, 
      }, 
      email: {
        // required: true, 
        email: true, 
      }, 
      account_number: {
        number: true, 
        min: 0, 
      }, 
      confirm_account_number: {
        number: true, 
        min: 0, 
        equalToAccountNumber: true
      }, 
    },
    messages: {
      name: {
        required: "Please enter name", 
      },
      phone_number: {
        required: "Please enter phone number", 
        number: "Please enter valid phone number", 
        minlength: "Please enter phone number", 
        maxlength: "Please enter valid phone number", 
      },
      email: {
        // required: "Please enter eemail", 
        email: "Please enter valid email", 
      },
      account_number: {
        min: "Please enter valid account number", 
        number: "Please enter valid account number", 
      },
      confirm_account_number: {
        min: "Please enter valid account number", 
        number: "Please enter valid account number", 
        equalToAccountNumber: "Account numbers do not match."
      },
    }
  });
  if (form.valid() === true) {
    $(".slide.three").removeClass("active");
    $(".slide.four").addClass("active");
  }
});

$(".slide.four .next_step").click(function() {
  valid = true; 
  if($("#gender").val() === ""){
	  valid = false;
	  $("#gender_error").show();
	  $("#gender_error").html('Please select gender');
  }else{
	  $("#gender_error").html('');
	  $("#gender_error").hide();
	   valid = true;
  } 
  if(valid === true){
    $(".slide.four").removeClass("active");
    $(".slide.five").addClass("active");
  }
});


$("#gender").change(function() {
  $("#gender_error").html(''); // Clear the validation message
});

$(".slide.five .next_step").click(function() {
 	valid = true;
  if($('#is_upcoming_bookings').val() == '0'){
    if($("#shift_type").val() == ""){
      valid = false;
      $("#shift_type_error").html('Please select shift type');
      $("#shift_type_error").show();
    }else if($("#shift").val() == ""){
      valid = false;
      $("#shift_type_error").html('');
      $("#shift_type_error").hide();
      $("#shift_error").html('Please select shift'); 
      $("#shift_error").show();
    }else if($("input[name='service_name[]']:checked").length === 0){
      $("#shift_error").html('');
      $("#shift_error").hide();
      if($('#selected_designation_name').val() == 'Stylist'){
        valid = false;
        $("#service_name_error").html('Please select services'); 
        $("#service_name_error").show();
      }else{
        $("#service_name_error").html('');
        $("#service_name_error").hide();
      }
    }else{
      $("#service_name_error").html('');
      $("#service_name_error").hide();
    } 
  }
	if(valid === true){ 
		$(".slide.five").removeClass("active");
		$(".slide.six").addClass("active");
	}
});


$(document).ready(function() {
      setServiceDiv();
      function updateCheckAll() {
        var allChecked = $('.services-checkbox').length === $('.services-checkbox:checked').length;
        $('#all_service_name').prop('checked', allChecked);
      }

      // Check or uncheck all checkboxes when the "Check All" checkbox is clicked
      $('#all_service_name').change(function() {
        var isChecked = $(this).is(':checked');
        $('.services-checkbox').prop('checked', isChecked);
      });

      // Update the "Check All" checkbox state when individual checkboxes change
      $('.services-checkbox').change(function() {
        updateCheckAll();
      });

      // Initialize the "Check All" checkbox state on page load
      updateCheckAll();

      // Search functionality
      $('#search').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();

        $('.checkbox-container div').each(function() {
          var labelText = $(this).find('label.service-name').text().toLowerCase();
          if (labelText.includes(searchTerm)) {
            $(this).show(); // Show the div if the label text contains the search term
          } else {
            $(this).hide(); // Hide the div if the label text does not contain the search term
          }
        });
      });

    $(".slide.six .next_step").click(function() {
        var valid = true; 

        if($("#identity").val() == ""){
            valid = false;
            $("#identity_error").html('Please select identity type');
            $("#identity_error").show();
        } else if($("#old_identy_proof").val() == ""){
            if($("#identy_proof").val() == ""){
                valid = false;
                $("#identity_error").html('');
                $("#identity_error").hide();
                $("#identity_proof_error").html('Please upload identity proof');
                $("#identity_proof_error").show();
            } else {
                valid = true;
                $("#identity_error").html('');
                $("#identity_error").hide();
                $("#identity_proof_error").html('');
                $("#identity_proof_error").hide();
            } 
        } else {
          $("#identity_proof_error").html('');
          $("#identity_proof_error").hide();
          $("#identity_error").html('');
          $("#identity_error").hide();
        } 

        if(valid === true){ 
            $(".slide.six").removeClass("active");
            $(".slide.seven").addClass("active");
        }
    });

    $("#identy_proof").change(function() {
        $("#identity_proof_error").html('');
        $("#identity_proof_error").hide();
    });
});

$(".slide.seven .next_step").click(function() {
	valid = true; 
	if($("#salary_method").val() == ""){
		valid = false;
		$("#salary_method_error").html('Please select salary method');
		$("#salary_method_error").show();
	}else if($("#salary").val() === ""){
		valid = false;
		$("#salary_method_error").html('');
		$("#salary_method_error").hide();
		$("#salary_error").html('Please enter salary'); 
		$("#salary_error").show();
	}else if(isNaN($("#salary").val()) || parseInt($("#salary").val()) < 1){
		valid = false;
		$("#salary_method_error").html('');
		$("#salary_method_error").hide();
		$("#salary_error").html('Please enter valid salary'); 
		$("#salary_error").show();
	}else if($("#date_of_join").val() == ""){
		valid = false;
		$("#salary_error").html('');
		$("#salary_error").hide();
		$("#date_of_join_error").html('Please select date of join'); 
		$("#date_of_join_error").show();
	}else{
		$("#salary_error").html('');
		$("#salary_error").hide();
		$("#date_of_join_error").html('');
		$("#date_of_join_error").hide();
	} 
	if(valid === true){ 
		$(".slide.seven").removeClass("active");
		$(".slide.eight").addClass("active");
	}
});
$(".slide.eight .next_step").click(function() { 
  alert();
    $("#submit_form").submit();
  
});
$("#rev_two").click(function() {
    $(".slide.two").removeClass("active");
    $(".slide.one").addClass("active");
});
$("#rev_three").click(function() {
    $(".slide.three").removeClass("active");
    $(".slide.two").addClass("active");
});
$("#rev_four").click(function() {
    $(".slide.four").removeClass("active");
    $(".slide.three").addClass("active");
});
$("#rev_five").click(function() {
    $(".slide.five").removeClass("active");
    $(".slide.four").addClass("active");
});
$("#rev_six").click(function() {
    $(".slide.six").removeClass("active");
    $(".slide.five").addClass("active");
});
$("#rev_seven").click(function() {
    $(".slide.seven").removeClass("active");
    $(".slide.six").addClass("active");
});
$("#rev_eight").click(function() {
    $(".slide.eight").removeClass("active");
    $(".slide.seven").addClass("active");
});
 
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({

        });
    });
     
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-setup').addClass('active_cc');

        $('#shift_type').change(function() {            
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_saloon_shifts_typewise_ajax",
                data:{'shift_type':$("#shift_type").val()},
                success: function(data){
                    $("#shift").empty();
                    $('#shift').append('<option value="">Select Shift</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#shift').append('<option value="' + d.id + '">' + d.shift_name + '</option>');
                    });
                    $('#shift').trigger('change');
                    $('#shift').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script> 
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap').hide();
      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();
      $('.image-title').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    removeUpload();
  }
}
function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

function removeUpload_button() {
    // Clear the old profile photo
    $('input[name="old_profile_photo"]').val('');
    $('.uploaded-contents').hide();
    $('.file-upload').show(); // Display the file-upload div
}
</script>
<script>	
        $(".datepicker_employee").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "0",  // Maximum date is 10 years from today
            minDate: "-100Y", // Minimum date is 100 years ago from today
            yearRange: "-100:+0" // Year range from 100 years ago to 10 years in the future
        });
    flatpickr(".datepicker_shows", { 
      dateFormat: "d-m-Y", 
      maxDate:"today",
    });    
    $('#service_name').change(function() {
        if ($(this).val() != null && $(this).val().includes('all_services')) {
            // Disable other options if "Select All Services" is selected
            $(this).find('option').not(':selected').prop('disabled', true);
        } else {
            // Enable all options if "Select All Services" is not selected
            $(this).find('option').prop('disabled', false);
        }
        $(this).trigger('chosen:updated');
    });
    function setServiceDiv(){      
      let selectedRadio = $('input[name="staff_type"]:checked');      
      if (selectedRadio.length) {
        let selectedValue = selectedRadio.val();
        let selectedDesignation = $('#designation_name_' + selectedValue).val();

        $('#selected_designation_name').val(selectedDesignation);
        if(selectedDesignation == 'Stylist'){
          $('#services_selection_div').show();
        }else{
          $('#services_selection_div').hide();
        }
      }
    }
</script>
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
	justify-content: center;
	/*height: 100vh;*/
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
    font-size: 18px;
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
	height: 19px;
	width: 19px;
	border: 2px solid #524eee;
	left: 19px;
	top: calc(50% - 12px);
}
.radio-item label:before {
	background: #524eee;
	height: 20px;
	width: 20px;
	left: 21px;
	top: calc(50%-5px);
	transform: scale(5);
	opacity: 0;
	visibility: hidden;
	transition: 0.4s ease-in-out 0s;
}
.radio-item [type="radio"]:checked ~ label {
	border-color: #524eee;
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
</style>
<div class="right_col" role="main">
    
       
        <div class="row">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="">
                        <a href="<?=base_url()?>add_employee_list" >Employee List</a>
                    </li>
                    <li class="active">
                        <a href="<?=base_url()?>add_employee" >Add Employee</a>
                    </li>
                   
                    <li>
                        <a class="" href="<?=base_url()?>employee_incentive_master" >Empolyee Incentive</a>
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
                                   <div class="col-md-12">
										<form  method="post" name="employee_form" id="employee_form" class="employee_form" enctype="multipart/form-data">
											<div class="slide one active" id="first_div">
												<section class="radio-section">
													<div class="radio-list">
														<h3>Choose Staff Type?</h3>
														<div class="radio-item"><input class="next-step first_validates" name="staff_type" id="radio1" value="1" type="radio" <?php if (!empty($single) && $single->staff_type == 1) {echo "checked";} ?>><label for="radio1">Stylist</label></div>
														<div class="radio-item"><input class="next-step first_validates" name="staff_type" id="radio2" value="2" type="radio" <?php if (!empty($single) && $single->staff_type == 2) {echo "checked";} ?>><label for="radio2">Receptionist</label></div>
														<div class="radio-item"><input class="next-step first_validates" name="staff_type" id="radio3" value="3" type="radio" <?php if (!empty($single) && $single->staff_type == 3) {echo "checked";} ?>><label for="radio3">Manager</label></div>
														<div class="radio-item"><input class="next-step first_validates" name="staff_type" id="radio4" value="4" type="radio" <?php if (!empty($single) && $single->staff_type == 4) {echo "checked";} ?>><label for="radio4">Cleaner</label></div>
													</div>
												</section>
                        
                        <div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <button type="button" id="first_next" class="next_step btn btn-primary" onclick="validateInputs('.first_validates','#first_div','#second_div')">Next</button>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide two" id="second_div">
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
                              <?php if(!empty($single)){?>
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
															  <button type="button" id="rev_two" class="prev_btn" onclick="showDivs('#second_div','#first_div')">Previous</button>
															  <button type="button" id="" class="next_step btn btn-primary" onclick="validateInputs('.second_validates','#second_div','#third_div')">Next</button>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide three" id="third_div">
												<div class="row">
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Name <b class="require">*</b></label>
														<input autocomplete="off" class="form-control third_validates" type="text" name="name" id="name" value="<?php if (!empty($single)) { echo $single->full_name; } ?>" placeholder="Enter Name">
														<input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
													</div>
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Phone Number <b class="require">*</b></label>
														<input autocomplete="off" maxlength="10" class="form-control third_validates" type="text" name="phone_number" id="phone_number" value="<?php if (!empty($single)) {echo $single->whatsapp_number; } ?>" placeholder="Enter Phone Number">
													</div>
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Email <b class="require">*</b></label>
														<input autocomplete="off" class="form-control third_validates" type="text" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter Email">
													</div>
												</div>
												<div class="row">
													 <div class="form-group col-md-12 col-sm-12 col-xs-12">
														<div style="overflow:auto;">
															<div style="float:right;">
															  <button type="button" id="rev_three" class="prev_btn" onclick="showDivs('#third_div','#second_div')">Previous</button>
															  <button type="button" id="" class="next_step btn btn-primary" onclick="validateInputs('.third_validates','#third_div','#fourth_div')">Next</button>
															</div>
														  </div>
													</div>
												</div>
											</div>
											<div class="slide four" id="fourth_div">
												<div class="row">   
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Gender<b class="require">*</b></label>
                                <select class="form-select form-control fourth_validates" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                    <option value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                    <option value="2" <?php if(!empty($single) && $single->gender == '2'){?>selected="selected"<?php }?>>Other</option> 
                                </select>
														<div class="error" id="gender_error"></div>
                                                    </div>  
													<div class="form-group col-md-4 col-sm-6 col-xs-12">
														<label>Date Of Birth </label>
														<input autocomplete="off" class="form-control datepicker_show" readonly style="cursor:pointer;" type="text" name="dob" id="dob" value="<?php if (!empty($single) && $single->dob != "" && $single->dob != NULL && $single->dob != '0000-00-00' && $single->dob != '1970-01-01') {echo date('d-m-Y',strtotime($single->dob));} ?>"placeholder="Select Date Of Birth">
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
															  <button type="button" id="rev_four" class="prev_btn" onclick="showDivs('#fourth_div','#third_div')">Previous</button>
															  <button type="button" id="" class="next_step btn btn-primary" onclick="validateInputs('.fourth_validates','#fourth_div','#fifth_div')">Next</button>
															</div>
														  </div>
													</div>
												</div> 
											</div>
                                                    
												<div class="slide five" id="fifth_div">
                              <div class="row"> 
                                  <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                      <label>Shift Type<b class="require">*</b></label>
                                      <select class="form-select fifth_validates form-control" name="shift_type" id="shift_type">
                                          <option value="">Select Shift Type</option>
                                          <option value="0" <?php if (!empty($single) && $single->shift_type == '0') { echo 'selected'; } ?>>Regular</option>
                                          <option value="1" <?php if (!empty($single) && $single->shift_type == '1') { echo 'selected'; } ?>>Rotational</option>
                                      </select>
															<div class="error" id="shift_type_error"></div>
                              </div>
                              <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                  <label>Shift<b class="require">*</b></label>
                                  <select class="form-select fifth_validates form-control" name="shift" id="shift">
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
                                <div class="form-group col-md-4 col-sm-6 col-xs-12 service_name_validation">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select class="form-select form-control fifth_validates chosen-select" name="service_name[]" id="service_name" multiple> 
                                        <option value="" class="" disabled>Select Service</option>
                                        <?php if (!empty($service_name)) {
                                            $service_exp = [];
                                            if (!empty($single)){
                                                $service_exp = explode(",",$single->service_name);
                                            }
                                            foreach ($service_name as $service_name) { ?>

                                                <option value="<?= $service_name->id ?>" <?php if (in_array($service_name->id,$service_exp)){?>selected="selected"<?php }?>><?= $service_name->service_name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
															<div class="error" id="service_name_error"></div>
                                                        </div> 
                                                    </div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_five" class="prev_btn" onclick="showDivs('#fifth_div','#fourth_div')">Previous</button>
																  <button type="button" class="next_step btn btn-primary" onclick="validateInputs('.fifth_validates','#fifth_div','#sixth_div')">Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide six" id="sixth_div"> 
                                                    <div class="row"> 
                                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Select Identity Type <b class="require">*</b></label>
                                                            <select class="form-select form-control sixth_validates" name="identity" id="identity">
                                                                <option value="">Select Identity</option>
                                                                <option value="1" <?php if (!empty($single) && $single->identity == 1) echo 'selected'; ?>>Pan Card</option>
                                                                <option value="2" <?php if (!empty($single) && $single->identity == 2) echo 'selected'; ?>>Aadhaar Card</option>
                                                                <option value="3" <?php if (!empty($single) && $single->identity == 3) echo 'selected'; ?>>Driving License</option>
                                                                <!-- <option value="4" <?php if (!empty($single) && $single->identity == 4) echo 'selected'; ?>>Passport</option> -->
                                                                <option value="5" <?php if (!empty($single) && $single->identity == 5) echo 'selected'; ?>>Voter ID</option>
                                                            </select>
															<div class="error" id="identity_error"></div>
                                                        </div>  
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Upload Identity Proof <b class="require">*</b> 
                                    <?php if(!empty($single) && $single->identy_proof !=''){?>
                                        <a class="btn btn-primary" href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a class="btn btn-primary" download href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </label>
                                    <input autocomplete="off" class="form-control sixth_validates" type="file" accept=".pdf,.jpg,.png,.jpeg,.webp" name="identy_proof" id="identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
															<input type="hidden" accept=".pdf,.jpg,.png,.jpeg,.webp" name="old_identy_proof" id="old_identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
															<div class="error" id="identity_proof_error"></div>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Description</label>
                                                            <input autocomplete="off" class="form-control" type="text" name="description" id="description" value="<?php if (!empty($single)) {echo $single->description; } ?>" placeholder="Enter description">

                                                        </div>
													</div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_six" class="prev_btn" onclick="showDivs('#sixth_div','#fifth_div')">Previous</button>
																  <button type="button" class="next_step btn btn-primary" onclick="validateInputs('.sixth_validates','#sixth_div','#seventh_div')">Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide seven" id="seventh_div">
													<div class="row">
                              <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                  <label>Target <b class="require">*</b></label>
                                  <select class="form-select form-control seventh_validates" name="salary_method" id="salary_method">
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
                                      <label>Monthly Payment<b class="require">*</b></label>
                                      <input autocomplete="off" type="text" class="form-control seventh_validates" name="salary" id="salary" value="<?php if (!empty($single)) {echo $single->salary;} ?>" placeholder="Enter Monthly Payment">
															<div class="error" id="salary_error"></div>
                                                        </div>
														<div class="form-group group col-md-4 col-sm-6 col-xs-12">
                          <label>Date Of Joining<b class="require">*</b></label>
                          <input style="cursor:pointer;" readonly autocomplete="off" type="text" class="form-control datepicker_shows seventh_validates" name="date_of_join" id="date_of_join" value="<?php if (!empty($single)) {echo date("d-m-Y",strtotime($single->date_of_join));} ?>" placeholder="Select Date Of Joining"> 
															<div class="error" id="date_of_join_error"></div>
                                                        </div>
													</div>
													<div class="row">
														 <div class="form-group col-md-12 col-sm-12 col-xs-12">
															<div style="overflow:auto;">
																<div style="float:right;">
																  <button type="button" id="rev_seven" class="prev_btn" onclick="showDivs('#seventh_div','#sixth_div')">Previous</button>
																  <button type="button" class="next_step btn btn-primary" onclick="validateInputs('.seventh_validates','#seventh_div','#eighth_div')">Next</button>
																</div>
															  </div>
														</div>
													</div>
												</div>
												<div class="slide eight" id="eighth_div">
													<div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Account Holder Name <b class="require"></b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) { echo $single->account_holder_name;} ?>" placeholder="Enter Account Holder Name">
                                                </div>   
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Bank Name<b class="require"></b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="bank_name" id="bank_name" value="<?php if (!empty($single)) { echo $single->bank_name;} ?>" placeholder="Enter Bank Name">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Account Number <b class="require"></b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter Account Number">
                                                </div>   
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Confirm Bank Account Number <b class="require"></b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="confirm_account_number" id="confirm_account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Confirm Account Number">
                                                </div>   
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>IFSC Code <b class="require"></b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {echo $single->ifsc; } ?>" placeholder="SBIN0011513">
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div style="overflow:auto;">
                                                  <div style="float:right;">
                                                    <button type="button" class="prev_btn" onclick="showDivs('#eighth_div','#seventh_div')">Previous</button>
                                                    <button type="submit" id="submit_form" class="btn btn-primary">Next</button>
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
  $("#employee_form").validate({
    rules: {
      account_holder_name: {
        required: true, 
      },
      bank_name: {
        required: true, 
      }, 
      account_number: {
        required: true, 
      }, 
      confirm_account_number: {
        required: true, 
      }, 
      ifsc: {
        required: true, 
      }, 
    },
    messages: {
      account_holder_name: {
        required: "Please account holder name", 
      },
      bank_name: {
        required: "Please enter bank name", 
      }, 
      account_number: {
        required: "Please enter account number", 
      }, 
      confirm_account_number: {
        required: "Please re enter account number", 
      }, 
      ifsc: {
        required: "Please enter IFSC Code", 
      },
    }
  }); 
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({});
        
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
  $('input[name="old_profile_photo"]').val('');
  $('.uploaded-contents').hide();
  $('.file-upload').show();
}
flatpickr(".datepicker_shows", { 
  dateFormat: "d-m-Y", 
  maxDate:"today",
});   
    
function validateInputs(validate_class_name,to_hide_div,to_show_div) {
  var isValid = true;
  $(validate_class_name).each(function() {
    var $input = $(this);
    var inputValue;

    if ($input.is(':checkbox')) {
      // For checkboxes, check if at least one is checked
      if (!$input.is(':checked')) {
        isValid = false;
      }
    } else if ($input.is(':radio')) {
      // For radio buttons, check if any are checked within the same group
      if ($('input[name="' + $input.attr('name') + '"]:checked').length === 0) {
        isValid = false;
      }
    } else {
      // For text inputs and other input types
      inputValue = $input.val().trim();
      alert(inputValue)
      if (inputValue === '') {
        isValid = false;
      }
    }

    // Handle validation message
    if (!isValid) {
      $input.parent().find('.validation-message').remove(); // Remove any existing message
      $input.parent().append('<span style="color:red;" class="validation-message">This field cannot be blank.</span>');
    } else {
      $input.parent().find('.validation-message').remove(); // Remove validation message if valid
    }
  });

  // Example of handling validation result
  if (isValid) {
    // Proceed to next step or submit form, etc.
    showDivs(to_hide_div,to_show_div);
  } else {
    return false;
  }
}
function showDivs(to_hide_div,to_show_div) {
  $('.validation-message').hide();
  $(to_hide_div).hide();
  $(to_show_div).show();
}

</script>
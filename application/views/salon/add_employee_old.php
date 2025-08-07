<?php include('header.php'); ?>
<style>
    .tabs {
        width: 100%;
    }

    .tab-nav {
        display: flex;
        /* background: #f0f0f0; */
        border-bottom: 1px solid #ddd;
        text-decoration: none !important;
    }

    .nav-item {
        display: block;
        padding: 10px 0px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none !important;
        font-weight: bold;
    }

    .nav-item.selected {
        font-weight: bold;
        /* background: #fff; */
        background: none !important;
        border-bottom: 2px solid #0000ff !important;
        border-radius: 0px !important;
        color: #0000ff;
    }

    .tab {
        display: none;
        padding: 16px;
    }

    .tab.selected {
        display: block;
    }

    .tab-pag {
        padding: 0 16px;
        display: flex;
        justify-content: flex-end;
    }

    .pag-item {
        display: block;
        padding: 12px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 8px;
    }

    .pag-item:last-child {
        margin-right: 0;
    }

    .pag-item.hidden {
        display: none;
    }

    .pag-item-submit {

        font-size: 14px;
        color: #fff;


    }
    .popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 999999999999;
}
 
/* Inner */
.popup-inner {
    max-width:700px;
    width: 45%;
    padding:40px;
    position:absolute;
    top:20%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}
 
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}



.popup-scroll{
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
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
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <form  method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                                           <div class="row">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Name <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="name" id="name" value="<?php if (!empty($single)) { echo $single->full_name; } ?>" placeholder="Enter Name">
                                                    <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Phone Number <b class="require">*</b></label>
                                                    <input autocomplete="off" maxlength="10" class="form-control" type="text" name="phone_number" id="phone_number" value="<?php if (!empty($single)) {echo $single->whatsapp_number; } ?>" placeholder="Enter Phone Number">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Email <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="row">   
                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <label>Gender<b class="require">*</b></label>
                                                        <select class="form-select form-control" name="gender" id="gender">
                                                            <option value="" class="">Select Gender</option>
                                                            <option value="0" <?=(!empty($single) && $single->gender == '0') ? 'selected' : ''; ?>>Male</option>
                                                            <option value="1" <?=(!empty($single) && $single->gender == '1') ? 'selected' : ''; ?>>Female</option>
                                                            <option value="2" <?=(!empty($single) && $single->gender == '2') ? 'selected' : ''; ?>>Other</option>
                                                            
                                                        </select>
                                                    </div> 

                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Date Of Birth </label>
                                                            <input autocomplete="off" class="form-control" readonly style="cursor:pointer;" type="text" name="dob" id="dob" value="<?php if (!empty($single)) {echo date('d-m-Y',strtotime($single->dob));} ?>"placeholder="Select Date Of Birth">
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Upload Profile Image <b class="require">*</b>
                                                            <?php if(!empty($single) && $single->profile_photo !=''){?>
                                                                <a class="btn btn-primary" href="<?=base_url()?>admin_assets/images/employee_profile/<?=$single->profile_photo?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                <a class="btn btn-primary" download href="<?=base_url()?>admin_assets/images/employee_profile/<?=$single->profile_photo?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                        </label>
                                                            <input autocomplete="off" accept=".pdf,.jpg,.png,.jpeg,.webp" class="form-control" type="file" name="profile_photo" id="profile_photo" value="<?php if (!empty($single)) {echo $single->profile_photo;} ?>">
                                                            <input  type="hidden" name="old_profile_photo" value="<?php if (!empty($single)) {echo $single->profile_photo;} ?>">
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- <div class="row">    -->
                                                      <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Address</label>
                                                            <input autocomplete="off" class="form-control" type="address" name="address" id="address" value="<?php if (!empty($single)) {echo $single->address; } ?>" placeholder="Enter description">

                                                        </div> -->
                                                        <!-- <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                                            <label></label>
                                                            <textarea style="max-width:100%" name="address" id="address"  class="form-control" placeholder="Enter address" cols="10" rows="3"><?php if (!empty($single)) {echo $single->address; } ?></textarea>
                                                            
                                                        </div> -->
                                                    <!-- </div> -->
                                               


                                              
                                                    <div class="row">
<!-- 
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Select Designation<b class="require">*</b></label>
                                                            <select class="form-select form-control " name="designation" id="designation">
                                                                <option value="">Select Designation</option>
                                                                <?php if (!empty($select_designation)) {
                                                                    foreach ($select_designation as $select_designation_result) { ?>
                                                                        <option value="<?= $select_designation_result->id ?>" <?php if (!empty($single) && $single->designation == $select_designation_result->id) { ?>selected="selected" <?php } ?>><?= $select_designation_result->designation ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div> -->
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Address</label>
                                                            <input autocomplete="off" class="form-control" type="address" name="address" id="address" value="<?php if (!empty($single)) {echo $single->address; } ?>" placeholder="Enter description">

                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Staff Type<b class="require">*</b></label>
                                                            <select class="form-select form-control" name="staff_type" id="staff_type">
                                                                <option value="" class="">Select Staff Type</option>
                                                                <option value="1">Stylist</option>
                                                                <option value="2">Receptionist</option>
                                                                <option value="3">Manager</option>
                                                                <option value="4">Cleaner</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-6 col-xs-12 service_name_validation">
                                                            <label>Select Service <b class="require">*</b></label>
                                                            <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple> 
                                                                <option value="" class="">Select Service</option>
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
                                                            <label for="service_name" style="display:none;" generated="true" class="error">Please enter service name</label>
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Shift Type<b class="require">*</b></label>
                                                            <select class="form-select form-control" name="shift_type" id="shift_type">
                                                                <option value="">Select Shift Type</option>
                                                                <option value="0" <?php if (!empty($single) && $single->shift_type == '0') { echo 'selected'; } ?>>Regular</option>
                                                                <option value="1" <?php if (!empty($single) && $single->shift_type == '1') { echo 'selected'; } ?>>Rotational</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Shift<b class="require">*</b></label>
                                                            <select class="form-select form-control" name="shift" id="shift">
                                                                <option value="">Select Shift</option>
                                                                <?php
                                                                    if(!empty($single)){
                                                                        $shifts = $this->Salon_model->get_all_shifts_typewise($single->shift_type);
                                                                        // $shifts = $this->Salon_model->get_all_active_shifts();
                                                                        if(!empty($shifts)){
                                                                            foreach($shifts as $shifts_result){
                                                                ?>
                                                                <option value="<?=$shifts_result->id;?>" <?php if (!empty($single) && $single->shift == $shifts_result->shift_name) { echo 'selected'; } ?>><?=$shifts_result->shift_name;?></option>
                                                                <?php }}
                                                                } 
                                                                ?>
                                                            </select>
                                                        </div>
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
                                                        </div>
                                                        <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Enter Identity Number</label>
                                                            <input autocomplete="off" class="form-control" type="text" name="identity_number" id="identity_number" value="<?php if (!empty($single)) {echo $single->identity_number;} ?>" placeholder="Enter identity number">
                                                        </div> -->
                                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Upload Identity Proof <b class="require">*</b> 
                                                            <?php if(!empty($single) && $single->identy_proof !=''){?>
                                                                <a class="btn btn-primary" href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                <a class="btn btn-primary" download href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->identy_proof?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                        </label>
                                                            <input autocomplete="off" class="form-control" type="file" accept=".pdf,.jpg,.png,.jpeg,.webp" name="identy_proof" id="identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
                                                            <input type="hidden" accept=".pdf,.jpg,.png,.jpeg,.webp" name="old_identy_proof" id="old_identy_proof" value="<?php if (!empty($single)) {echo $single->identy_proof;} ?>">
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Description</label>
                                                            <input autocomplete="off" class="form-control" type="text" name="description" id="description" value="<?php if (!empty($single)) {echo $single->description; } ?>" placeholder="Enter description">

                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Salary Method <b class="require">*</b></label>
                                                            <select class="form-select form-control" name="salary_method" id="salary_method">
                                                                <option value="">Select Identity</option>
                                                                <?php 
                                                                $get_salary_method=$this->Salon_model->get_salary_method();
                                                                if(!empty($get_salary_method)){
                                                                    foreach($get_salary_method as $method){?>
                                                                        <option value="<?=$method->id?>">Level <?=$method->level?> </option>
                                                                <?php  }} ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                

                                              
                                                    <div class="row">
                                                        <div class="form-group group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Monthly Payment<b class="require">*</b></label>
                                                            <input autocomplete="off" type="text" class="form-control" name="salary" id="salary" value="<?php if (!empty($single)) {echo $single->salary;} ?>" placeholder="Enter Monthly Payment">
                                                        </div>
                                                    <div class="form-group group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Date Of Joining<b class="require">*</b></label>
                                                            <input style="cursor:pointer;" readonly autocomplete="off" type="text" class="form-control" name="date_of_join" id="date_of_join" value="<?php if (!empty($single)) {echo date("d-m-Y",strtotime($single->date_of_join));} ?>" placeholder="Select Date Of Joining">

                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Account Holder Name <b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) { echo $single->account_holder_name;} ?>" placeholder="Enter Account Holder Name">
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Bank Name<b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="bank_name" id="bank_name" value="<?php if (!empty($single)) { echo $single->bank_name;} ?>" placeholder="Enter Bank Name">
                                                        </div>
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Account Number <b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter Account Number">
                                                        </div>   
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Confirm Bank Account Number <b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="confirm_account_number" id="confirm_account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Confirm Account Number">
                                                        </div>
                                                        <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Account Type<b class="require">*</b></label>
                                                            <select class="form-control" name="account_type" id="account_type">
                                                                <option value="">Select account type</option>
                                                                <option value="1" <?php if (!empty($single) && $single->account_type == 1) echo 'selected="selected"'; ?>>Saving</option>
                                                                <option value="2" <?php if (!empty($single) && $single->account_type == 2) echo 'selected="selected"'; ?>>Current</option>
                                                                <option value="3" <?php if (!empty($single) && $single->account_type == 3) echo 'selected="selected"'; ?>>Salary</option>

                                                            </select>
                                                        </div> -->
                                                        <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label>Branch Name <b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="bank_branch_name" id="bank_branch_name" value="<?php if (!empty($single)) {echo $single->bank_branch_name; } ?>" placeholder="Enter Branch Name">
                                                        </div> -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <label>IFSC Code <b class="require">*</b></label>
                                                            <input autocomplete="off" class="form-control" type="text" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {echo $single->ifsc; } ?>" placeholder="SBIN0011513">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                            <button style="float:right;" class="btn btn-primary" type="submit">Submit</button>
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
$(document).ready(function(){
    jQuery.validator.addMethod("validAccountNumber", function(value, element) {
    // Regex to match numeric values with length between 9 and 18
            return this.optional(element) || /^\d{9,18}$/.test(value);
        }, "Please enter a valid bank account number.");

$("#employee_form").validate({
    ignore:'',
    rules: {
        name: {
            required: true
        },
        phone_number: {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
        },
        email: {
            required: true,
            email: true,
        },
        gender: {
            required: true,
        },
        dob: {
            required: true,
        },
        <?php 
         if(!empty($single) && $single->profile_photo !=''){

         }else{?>
            profile_photo: {
            required: true,
        },
        <?php } ?>
      
        staff_type: {
            required: true
        },
        'service_name[]': {
            required: true
        },
        shift_type: {
            required: true
        },
        shift: {
            required: true
        },
        identity: {
            required: true
        },
        <?php 
         if(!empty($single) && $single->identy_proof !=''){

         }else{?>
            identy_proof: {
                required: true
            },
        <?php } ?>
        
        description: {
            required: true
        },
        salary_method: {
            required: true
        },
        salary: {
            required: true
        },
        date_of_join: {
            required: true
        },
        account_holder_name: {
            required: true
        },
        bank_name: {
            required: true
        },
        account_number: {
            required: true,
            validAccountNumber: true,
        },
        confirm_account_number: {
            required: true,
            equalTo: "#account_number"
        },
        ifsc: {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please enter name",
        },
        phone_number: {
            required: "Please enter mobile number",
            minlength: "Enter minimum 10 digit number",
            maxlength: "Enter maximum 10 digit number",
            digits: "Enter valid format",
        },
        email: {
            required: "Please enter email address",
            email: "Please enter a valid email address",
        },
        gender: {
            required: "Please select gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
        <?php 
         if(!empty($single) && $single->profile_photo !=''){

         }else{?>
           profile_photo: {
            required: "Please upload profile photo",
        },
        <?php } ?>
        
        staff_type: {
            required: "Please select staff type",
        },
        'service_name[]': {
            required: "Please enter service name",
        },
        shift_type: {
            required: "Please select shift type",
        },
        shift: {
            required: "Please select shift",
        },
        identity: {
            required: "Please enter identity",
        },
        <?php 
         if(!empty($single) && $single->identy_proof !=''){

         }else{?>
            identy_proof: {
            required: "Please select identity proof",
        },
        <?php } ?>
       
        description: {
            required: "Please enter description",
        },
        salary_method: {
            required: "Please select salary method",
        },
        salary: {
            required: "Please enter salary",
        },
        date_of_join: {
            required: "Please enter date of join",
        },
        account_holder_name: {
            required: "Please enter account holder name",
        },
        bank_name: {
            required: "Please enter bank name",
        },
        account_number: {
            required: "Please enter account number",
            validAccountNumber: "Please enter a valid bank account number",
        },
        confirm_account_number: {
            required: "Please confirm account number",
            equalTo: "Account numbers do not match",
        },
        ifsc: {
            required: "Please enter IFSC code",
        }
    }
});

});

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({

        });
    });
    $("#dob").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: new Date(), // Set maxDate to today's date
        
    });

    $("#date_of_join").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        maxDate: "+100Y",
    });
</script>

<script>
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






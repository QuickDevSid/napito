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
.popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	
</style>
<div class="right_col" role="main">
      <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                    Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
        <?php if(!empty($shift_name)){?>
        <div class="row">
           
            <div class="dropdown top-btn-btn">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog" aria-hidden="true"></i> Setting
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                    <li><a class="cc_add_staff_attendance"  href="<?= base_url(); ?>add_staff_attendance">Add Attendance</a></li>
                    <li><a class="cc_generate_salary_slip" href="<?= base_url(); ?>generate_salary_slip">Add Salary</a></li>
                    <li><a class="add_designation" href="<?=base_url()?>add-designation">Add Designation</a></li>
                </ul>
            </div>
          
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Employee List</a>
                    </li>
                    <li >
                        <a href="<?=base_url()?>add_employee" >Add Employee</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "employee_incentive_master"){?>active<?php }?>">
                        <a href="<?=base_url()?>employee_incentive_master" >Empolyee Incentive</a>
                    </li>


                </ul><br>
            </div>

            <div class="tab-content">

                <div class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Email </th>
                                                    <th>Gender</th>
                                                    <th>DOB</th>
                                                    <th>Profile Image</th>
                                                    <th>Identity Type</th>
                                                    <!-- <th>Identity Proof</th> -->
                                                    <th>Address</th>
                                                    <th>Staff Type</th>
                                                    <th>Service</th>
                                                    <th>Shift</th>
                                                    <th>Salary Method</th>
                                                    <th>Monthly Payment</th>
                                                    <th>Date Of Joining</th>
                                                    <th>Account Holder Name</th>
                                                    <th>Account Number</th>
                                                    <th>Account Type</th>
                                            
                                                    <th>IFSC Code</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($salon_employee_list)){
                                                    $i=1;
                                                        foreach($salon_employee_list as $salon_employee_list_result){
                                                 ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$salon_employee_list_result->full_name?></td>
                                                    <td><?=$salon_employee_list_result->whatsapp_number?></td>
                                                    <td><?=$salon_employee_list_result->email?></td>
                                                    <td><?=($salon_employee_list_result->gender == 0) ? 'Female' : (($salon_employee_list_result->gender == 1) ? 'Male' : 'Other'); ?></td>
                                                    <td><?=date('d-m-Y',strtotime($salon_employee_list_result->dob))?></td>
                                                    <td>
                                                        <?php
                                                         if($salon_employee_list_result->profile_photo !=''){ ?>
                                                         <a class="btn btn-info" target="_blank" href="<?= base_url(); ?>admin_assets/images/employee_profile/<?=$salon_employee_list_result->profile_photo?>">View</a>
                                                        <?php } else{
                                                            echo "-";
                                                          }
                                                        ?>
                                                   </td>
                                                   <td>
                                                        <?php
                                                            $identity = $salon_employee_list_result->identity;
                                                            if ($identity == 1) {
                                                                echo "Pan Card";
                                                            } elseif ($identity == 2) {
                                                                echo "Aadhaar Card";
                                                            } elseif ($identity == 3) {
                                                                echo "Driving License";
                                                            } elseif ($identity == 4) {
                                                                echo "Passport";
                                                            } elseif ($identity == 5) {
                                                                echo "Voter ID";
                                                            } else {
                                                                echo "Unknown";
                                                            }
                                                        ?>
                                                    </td>
                                                    <!-- <td>
                                                    <?php
                                                         if($salon_employee_list_result->identy_proof !=''){ ?>
                                                       <a class="btn btn-info" target="_blank" href="<?= base_url(); ?>admin_assets/images/employee_aadhar/<?=$salon_employee_list_result->identy_proof?>">View</a>
                                                        <?php } else{
                                                            echo "-";
                                                          }
                                                        ?>
                                                   </td> -->
                                                    <td><?=$salon_employee_list_result->salary?> Per Month</td>
                                                    <td><?=$salon_employee_list_result->shiftname?></td>

                                                    
                                                    <td><?=$salon_employee_list_result->identity_number?></td>
                                                    <td><?=$salon_employee_list_result->address?></td>
                                                    <td><?=$salon_employee_list_result->account_holder_name?></td>
                                                    <td><?=$salon_employee_list_result->account_number?></td>
                                                    <td>
                                                        <?php
                                                            $account_type = $salon_employee_list_result->account_type;
                                                            switch ($account_type) {
                                                                case 1:
                                                                    echo "Saving";
                                                                    break;
                                                                case 2:
                                                                    echo "Current";
                                                                    break;
                                                                case 3:
                                                                    echo "Salary";
                                                                    break;
                                                                default:
                                                                    echo "Unknown";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?=$salon_employee_list_result->bank_branch_name?></td>
                                                    <td><?=$salon_employee_list_result->ifsc?></td>
                                                    <td style="display: none;"><?=$salon_employee_list_result->profile_photo?></td>
                                                    <td style="display: none;"><?=$salon_employee_list_result->aadhar_front?></td>
                                                    <td style="display: none;"><?=$salon_employee_list_result->description?></td>
                                                   
                                                   
                                                   <td><a class="btn btn-info" data-popup-open="popup-1" onclick="view_description('<?php echo $salon_employee_list_result->description; ?>')">View</a></td>
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon-employee/<?=$salon_employee_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

                                                    </td>
                                                </tr>
                                            <?php }}?>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="2">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form  method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                                    <div class="tabs" id="tabbedForm">
                                        <nav class="tab-nav"></nav>
                                        <div class="tab" data-name="Personal Details">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Name <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="full_name" id="full_name" value="<?php if (!empty($single)) { echo $single->full_name; } ?>" placeholder="Enter full name">
                                                    <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Phone Number <b class="require">*</b></label>
                                                    <input autocomplete="off" maxlength="10" class="form-control" type="text" name="whatsapp_number" id="whatsapp_number" value="<?php if (!empty($single)) {echo $single->whatsapp_number; } ?>" placeholder="Enter employee whatsapp number">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Email <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter employee email">
                                                </div>
                                            </div>
                                            <div class="row">   
                                               
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label for="gender">Please Select Gender <b class="require">*</b></label>
                                                    <div class="form-control" style="float: left; border:none;box-shadow:none;">
                                                        <input autocomplete="off" type="radio" id="male" name="gender" value="0" <?= ($single && $single->gender == 0) ? 'checked' : ''; ?>>
                                                        <label for="male">Male</label>&nbsp;&nbsp;
                                                        <input autocomplete="off" type="radio" id="female" name="gender" value="1" <?= ($single && $single->gender == 1) ? 'checked' : ''; ?>>
                                                        <label for="female">Female</label>&nbsp;&nbsp;
                                                        <input autocomplete="off" type="radio" id="prefer-not-say" name="gender" value="2" <?= ($single && $single->gender == 2) ? 'checked' : ''; ?>>
                                                        <label for="unisex">Other</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Staff Type<b class="require">*</b></label>
                                                    <select class="form-select form-control" name="employee_type" id="employee_type">
                                                        <option value="" class="">Select Staff Type</option>
                                                        <option value="1">Stylist</option>
                                                        <option value="2">Receptionist</option>
                                                        <option value="3">Manager</option>
                                                        <option value="4">Cleaner</option>
                                                    </select>
                                                </div> 

                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Date Of Birth</label>
                                                    <input autocomplete="off" class="form-control" readonly style="cursor:pointer;" type="text" name="dob" id="dob" value="<?php if (!empty($single)) {echo date('d-m-Y',strtotime($single->dob));} ?>"placeholder="Select Date Of Birth">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Upload Profile Image <b class="require">*</b>
                                                    <?php if(!empty($single) && $single->profile_photo !=''){?>
                                                     <a href="<?=base_url()?>admin_assets/images/employee_profile/<?=$single->profile_photo?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                     <a download href="<?=base_url()?>admin_assets/images/employee_profile/<?=$single->profile_photo?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                  </label>
                                                    <input autocomplete="off" accept=".pdf,.jpg,.png,.jpeg,.webp" class="form-control" type="file" name="profile_photo" id="profile_photo" value="<?php if (!empty($single)) {echo $single->profile_photo;} ?>">
                                                    <input  type="hidden" name="old_profile_photo" value="<?php if (!empty($single)) {echo $single->profile_photo;} ?>">
                                                </div>
                                                
                                            </div>
                                            <div class="row">   
                                               
                                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                                    <label>Address</label>
                                                    <textarea style="max-width:100%" name="address" id="address"  class="form-control" placeholder="Enter address" cols="10" rows="3"><?php if (!empty($single)) {echo $single->address; } ?></textarea>
                                                    
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab" data-name="Other Details">
                                            <div class="row">

                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Select Designation<b class="require">*</b></label>
                                                    <select class="form-select form-control " name="designation" id="designation">
                                                        <option value="">Select Designation</option>
                                                        <?php if (!empty($select_designation)) {
                                                            foreach ($select_designation as $select_designation_result) { ?>
                                                                <option value="<?= $select_designation_result->id ?>" <?php if (!empty($single) && $single->designation == $select_designation_result->id) { ?>selected="selected" <?php } ?>><?= $select_designation_result->designation ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Staff Type<b class="require">*</b></label>
                                                    <select class="form-select form-control" name="employee_type" id="employee_type">
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
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Description</label>
                                                    <input autocomplete="off" class="form-control" type="text" name="description" id="description" value="<?php if (!empty($single)) {echo $single->description; } ?>" placeholder="Enter description">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Select Identity Type <b class="require">*</b></label>
                                                    <select class="form-select form-control" name="identity" id="identity">
                                                        <option value="">Select Identity</option>
                                                        <option value="1" <?php if (!empty($single) && $single->identity == 1) echo 'selected="selected"'; ?>>Pan Card</option>
                                                        <option value="2" <?php if (!empty($single) && $single->identity == 2) echo 'selected="selected"'; ?>>Aadhaar Card</option>
                                                        <option value="3" <?php if (!empty($single) && $single->identity == 3) echo 'selected="selected"'; ?>>Driving License</option>
                                                        <!-- <option value="4" <?php if (!empty($single) && $single->identity == 4) echo 'selected="selected"'; ?>>Passport</option> -->
                                                        <option value="5" <?php if (!empty($single) && $single->identity == 5) echo 'selected="selected"'; ?>>Voter ID</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Enter Identity Number</label>
                                                    <input autocomplete="off" class="form-control" type="text" name="identity_number" id="identity_number" value="<?php if (!empty($single)) {echo $single->identity_number;} ?>" placeholder="Enter identity number">
                                                </div> -->

                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Upload Identity Proof <b class="require">*</b>   </label>
                                                    <input autocomplete="off" class="form-control" type="file" accept=".pdf,.jpg,.png,.jpeg,.webp" name="aadhar_front" id="aadhar_front" value="<?php if (!empty($single)) {echo $single->aadhar_front;} ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Salary Method <b class="require">*</b></label>
                                                    <select class="form-select form-control" name="salary_method" id="salary_method">
                                                        <option value="">Select Identity</option>
                                                        <?php 
                                                         $get_salary_method=$this->Salon_model->get_salary_method();
                                                         if(!empty($get_salary_method)){
                                                            foreach($get_salary_method as $method){?>
                                                                <option value="<?=$method->id?>">Level <?=$method->level?></option>
                                                          <?php  }} ?>
                                                    </select>
                                                </div>
                                                <div class="form-group group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Monthly Payment<b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="salary" id="salary" value="<?php if (!empty($single)) {echo $single->salary;} ?>" placeholder="Enter Monthly Payment">

                                                </div>
                                                <div class="form-group group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Date Of Joining<b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="date_of_join" id="date_of_join" value="<?php if (!empty($single)) {echo date("d-m-Y",strtotime($single->date_of_join));} ?>" placeholder="Select Date Of Joining">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab" data-name="Bank Details">
                                            <div class="row">

                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Account Holder Name <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) { echo $single->account_holder_name;} ?>" placeholder="Enter Account Holder Name">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Bank Name<b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="bank_name" id="bank_name" value="<?php if (!empty($single)) { echo $single->bank_name;} ?>" placeholder="Enter Bank Name">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Account Number <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter Account Number">
                                                </div>
                                                
                                            </div>
                                            <div class="row">    
                                               <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Confirm Bank Account Number <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="confirm_account_number" id="confirm_account_number" value="<?php if (!empty($single)) {echo $single->confirm_account_number;} ?>" placeholder="Confirm Account Number">
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
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Branch Name <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="bank_branch_name" id="bank_branch_name" value="<?php if (!empty($single)) {echo $single->bank_branch_name; } ?>" placeholder="Enter Branch Name">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>IFSC Code <b class="require">*</b></label>
                                                    <input autocomplete="off" class="form-control" type="text" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {echo $single->ifsc; } ?>" placeholder="SBIN0011513">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                            </div>

                                        </div>
                                    </div>
                                    <nav class="tab-pag"></nav>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="popup" data-popup="popup-1">
                <div class="popup-inner">
                    <h3>Description</h3>
                 <div class="popup-scroll">
                  <div class="descrip"></div>
                </div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
            </div>
            <?php }else{?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title" style="text-align: center;">
                            <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                        </div>
                        <div style="text-align: center;font-size: 15px;">
                            Click to complete working hours <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>working-hours">Working Hours</a>
                        </div>
                    </div>
                </div>
            <?php }?>
          
    <?php }?>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>

        $("#service_name").change(function() {
        if( $("#service_name").val() !== ""){
            $("#service_name").removeClass('is-invalid'); 
            $(".service_name_validation .error").hide(); 
        }else{
            $(".service_name_validation .error").show(); 
        }
    });
     $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
 
        e.preventDefault();
    });
});

function view_description(des){
$('.descrip').text(des);
}
$("#dob").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    maxDate: '-18Y',
    yearRange: "-100:-18" 
});
$("#date_of_join").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    minDate: 0,
    maxDate: "+100Y",
});



 $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/
                .test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email!");
        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
            if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
                if (value == "") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, "HTML tags are Not allowed.");
        $('#employee_form').validate({
            ignore:'',
            rules: {
                full_name: 'required',
                employee_type: 'required',
                bank_name: 'required',
                gender: 'required',
                whatsapp_number: {
                    required: true,
                    number: true,
                    mobile_no: true,
                    minlength: 10,
                    maxlength: 10,
                },
                email: {
                    required: true,
                    validate_email: true,
                    noHTMLtags: true,
                },
                shift_name: 'required',
                account_holder_name: 'required',
                account_number: 'required',
                account_type: 'required',
                bank_branch_name: 'required',
                ifsc: 'required',
                designation: 'required',
                "service_name[]": 'required',
                profile_photo: 'required',

                salary: {
                    required: true,
                    number: true,
                },
                account_number: {
                    required: true,
                    number: true,
                },


            },
            messages: {
                full_name: "Please enter full name!",
                bank_name: "Please enter bank name!",
                employee_type: "Please select employee type!",
                gender: "Please select gender!",
                profile_photo: "Please upload profile Image!",
                whatsapp_number: {
                    required: "Please enter whatsapp number!",
                    number: "Only number allowed!",
                    mobile_no: "Please enter valid number!",
                    minlength: "Minimum 10 digit required!",
                    maxlength: "Maximum 10 digit allowed!",
                },
                salary: {
                    required: "Please enter salary per month!",
                    number: "Only number allowed!",
                  
                },
                email: {
                    required: "Please enter email!",
                    validate_email: "Please enter valid email!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                shift_name: "Please select shift!",
                account_holder_name: 'Please enter account holder name!',
                account_number: {
                    required: "Please enter account number!",
                    number: "Only number allowed!",
                  
                },
                account_type: 'Please enter account type!',
                bank_branch_name: 'Please enter bank branch name!',
                ifsc: 'Please enter ifsc code!',
                designation: 'Please enter designation!',
                "service_name[]": 'Please enter service name!',
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





    $("#email").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_owner_email",
            data: {
                'email': $("#email").val(),
                'id': '<?= $id ?>'
            },
            success: function(data) {
                if (data == "0") {
                    $("#email_error").html('');
                    $("#submit").show();
                } else {
                    $("#email_error").html('This email is already added');
                    $("#submit").hide();
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-setup').addClass('active_cc');
    });
</script>

<script>
    var tabs = function(id) {
        this.el = document.getElementById(id);

        this.tab = {
            el: '.tab',
            list: null
        }

        this.nav = {
            el: '.tab-nav',
            list: null
        }

        this.pag = {
            el: '.tab-pag',
            list: null
        }

        this.count = null;
        this.selected = 0;

        this.init = function() {
            // Create tabs
            this.tab.list = this.createTabList();
            this.count = this.tab.list.length;

            // Create nav
            this.nav.list = this.createNavList();
            this.renderNavList();

            // Create pag
            this.pag.list = this.createPagList();
            this.renderPagList();

            // Set selected
            this.setSelected(this.selected);
        }

        this.createTabList = function() {
            var list = [];

            this.el.querySelectorAll(this.tab.el).forEach(function(el, i) {
                list[i] = el;
            });

            return list;
        }

        this.createNavList = function() {
            var list = [];

            this.tab.list.forEach(function(el, i) {
                var listitem = document.createElement('a');
                listitem.className = 'nav-item',
                    listitem.innerHTML = el.getAttribute('data-name'),
                    listitem.onclick = function() {
                        this.setSelected(i);
                        return false;
                    }.bind(this);

                list[i] = listitem;
            }.bind(this));

            return list;
        }

        this.createPagList = function() {
            var list = [];

            list.prev = document.createElement('a');
            list.prev.className = 'pag-item pag-item-prev btn btn-secondary',
                list.prev.innerHTML = 'Prev',
                list.prev.onclick = function() {
                    this.setSelected(this.selected - 1);
                    return false;
                }.bind(this);

            list.next = document.createElement('a');
            list.next.className = 'pag-item pag-item-next btn btn-primary',
                list.next.innerHTML = 'Next',
                list.next.onclick = function() {
                    this.setSelected(this.selected + 1);
                    return false;
                }.bind(this);

            list.submit = document.createElement('button');
            list.submit.className = 'pag-item pag-item-submit btn btn-primary',
                list.submit.innerHTML = 'Submit';

            return list;
        }

        this.renderNavList = function() {
            var nav = document.querySelector(this.nav.el);

            this.nav.list.forEach(function(el) {
                nav.appendChild(el);
            });
        }

        this.renderPagList = function() {
            var pag = document.querySelector(this.pag.el);

            pag.appendChild(this.pag.list.prev);
            pag.appendChild(this.pag.list.next);
            pag.appendChild(this.pag.list.submit);
        }

        this.setSelected = function(target) {
            var min = 0,
                max = this.count - 1;

            if (target > max || target < min) {
                return;
            }

            if (target == min) {
                this.pag.list.prev.classList.add('hidden');
            } else {
                this.pag.list.prev.classList.remove('hidden');
            }

            if (target == max) {
                this.pag.list.next.classList.add('hidden');
                this.pag.list.submit.classList.remove('hidden');
            } else {
                this.pag.list.next.classList.remove('hidden');
                this.pag.list.submit.classList.add('hidden');
            }

            this.tab.list[this.selected].classList.remove('selected');
            this.nav.list[this.selected].classList.remove('selected');

            this.selected = target;
            this.tab.list[this.selected].classList.add('selected');
            this.nav.list[this.selected].classList.add('selected');
        }
    };

    var tabbedForm = new tabs('tabbedForm');
    tabbedForm.init();
</script>


<script>

        $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: false,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-salon-employee',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19] 
                }
            }
        ], 
    });
</script>



<script>
    var hidWidth;
    var scrollBarWidths = 100;

    var widthOfList = function() {
        var itemsWidth = 0;
        $('.list li').each(function() {
            var itemWidth = $(this).outerWidth();
            itemsWidth += itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function() {
        return (
            $('.wrapper').outerWidth() - widthOfList() - getLeftPosi() - scrollBarWidths
        );
    };

    var getLeftPosi = function() {
        return $('.list').position().left;
    };

    var reAdjust = function() {
        $('.scroller-right, .scroller-left').show(); // Show both buttons initially

        if ($('.wrapper').outerWidth() < widthOfList()) {

            $('.scroller-right').show();
        } else {
            $('.scroller-right').show();
        }

        if (getLeftPosi() < 0) {
            $('.scroller-left').hide();
        } else {
            $('.scroller-left').hide();
        }
    };

    reAdjust();

    $(window).on('resize', function(e) {
        reAdjust();
    });

    $('.scroller-right').click(function() {
        $('.scroller-left').fadeIn('slow');
        $('.scroller-right').fadeOut('slow');

        $('.list').animate({
                left: '+=' + widthOfHidden() + 'px'
            },
            'slow',
            function() {}
        );
    });

    $('.scroller-left').click(function() {
        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');

        $('.list').animate({
                left: '-=' + getLeftPosi() + 'px'
            },
            'slow',
            function() {}
        );
    });
    </script>
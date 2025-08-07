<?php
// echo "<pre>";print_r($this->uri->segment(2));exit;

include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .fade.in {
        display: block !important;
    }
   
    .min_message{
        color: red;
        font-weight: bold;
    }
    .max_message{
        color: red;
        font-weight: bold;
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
    top:35%;
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

input[class="dashboardToggle"] {
		position: relative;
		appearance: none;
		width: 50px;
		height: 25px;
		background: #ccc;
		border-radius: 50px;
		box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
		cursor: pointer;
		transition: 0.4s;
	}

	input:checked[class="dashboardToggle"] {
		background: #7da6ff;
	}

	input[class="dashboardToggle"]::after {
		position: absolute;
		content: "";
		width: 25px;
		height: 25px;
		top: 0;
		left: 0;
		background: #fff;
		border-radius: 50%;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		transform: scale(1.1);
		transition: 0.4s;
	}

	input:checked[class="dashboardToggle"]::after {
		left: 50%;
	}
</style>
<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <?php
        if(empty($gst)){?>
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
        <div class="row">
            <!-- <div class="dropdown top-btn-btn">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog" aria-hidden="true"></i> Setting
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                    <li><a class="add-sup-catagory" href="<?= base_url(); ?>add-sup-category">Add Services Category</a></li>
                    <li><a class="add_service_sub_category" href="<?= base_url(); ?>add_service_sub_category">Add Services Sub Category</a></li>
                </ul>
            </div> -->

            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">My Services</a>
                    </li>
                    <li id="tab_2">
                        <a href="#2" data-toggle="tab">Ready To Use</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_3">
                        <a href="<?=base_url();?>add-salon-services#3" data-toggle="tab">Add Services</a>
                    </li>
                    <li id="tab_4">
                        <a href="#4" data-toggle="tab">Pending Services</a>
                    </li>
                </ul><br>
            </div>

            <div class="tab-content ">
       
                <div class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>My Services</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($category_name_list)) {
                                    $j = 0;
                                    $m = 0;
                                    $i = 1;
                                    $k = 1;
                                    foreach ($category_name_list as $services_result) {  $checkout=0;?>
                                        <div class="col-md-2 category_row_box">
                                                <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_category_image/' . $services_result->category_image) ?>)"></div>

                                                <div class="row category_head">
                                                    <a href="<?=base_url();?>salon-services-list/<?=$services_result->id?>"><h4><?= $services_result->sup_category ?></h4></a>
                                                </div>
                                        <?php if (!empty($services)) {
                                            foreach ($services as $services_list_result) { ?>
                                                <?php if($services_list_result->category == $services_result->id){?>
                                                   <?php $checkout=1;?>
                                                <?php break;}?>
                                                <?php }} ?>

                                                <?php if($checkout == 0){?>
                                                    <div class="row category_head">
                                                    <span style="float: left; padding: 5px;">No Service</span>
                                                    <span style="float: right; padding: 5px;"><a style="color: blue;" href="<?=base_url();?>ready-sub-category/<?=$services_result->id?>">Add</a></span>
                                                </div>
                                                <?php }?>
                                        </div>
                                <?php $k++; $m=0;$j=0;}
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="2">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Ready To Use</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($category_name_list)) {
                                    foreach ($category_name_list as $admin_services) {
                                       ?>
                                        <div class="col-md-2 category_row_box">
                                            <div class="row">
                                                <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_category_image/' . $admin_services->category_image) ?>)">
                                                  </div>

                                                <div class="row category_head">
                                                <a href="<?= base_url('ready-sub-category/' . $admin_services->id) ?>">
                                                   <h4><?= $admin_services->sup_category?></h4>
                                                </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="3">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="container">
                                
                                    <form method="post" name="sub_category_form" id="sub_category_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php 
                                            if(isset($_GET['use']) && isset($_GET['use_id'])){
                                                $single = $ready_single;
                                                if (!empty($single) && $single->id != '0') { 
                                                    $flag = '1';
                                                }else{
                                                    $flag = '0';
                                                }
                                                $is_ready_service = '1';
                                                $is_special_service = '0';
                                                $service_pkey = $_GET['use_id'];
                                            }else{
                                                if (!empty($single) && $single->service_id != '0') { 
                                                    $flag = '1';
                                                }else{
                                                    $flag = '0';
                                                }
                                                $is_ready_service = '0';
                                                $is_special_service = !empty($single) ? $single->is_special : '0';
                                                $service_pkey = '';
                                            }
                                            // echo "<pre>";print_r($single);exit;
                                            if ($flag == '1') {   ?>
                                                <div class="form-group col-md-4 col-sm-64 col-xs-12">
                                                    <label>Select Category<b class="require">*</b></label>
                                                    <select class="form-control form-select" name="sup_category" id="sup_category" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                        <i class="fa fa-chavron-down"></i>
                                                        <option>Select Category</option>
                                                        <?php
                                                        if (!empty($sup_category)) {
                                                            foreach ($sup_category as $sup_category_result) { ?>
                                                                <option value="<?=$sup_category_result->id?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?=$sup_category_result->sup_category ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id; } ?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Add Sub Category <b class="require">*</b></label>
                                                    <select style="pointer-events: none;"  class="form-control" name="sub_category" id="sub_category" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                        <option>Select Sub Category</option>
                                                        <?php if (!empty($single)) {?>
                                                            <option value="<?= $single->sub_category?>" <?php if (!empty($single) && $single->sub_category) { echo 'selected';} ?>><?= $single->subcategory ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Service Name <b class="require">*</b></label>
                                                    <input  autocomplete="off" type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter Service Name" value="<?php if (!empty($single)) { echo $single->service_name; } ?>" <?php if($this->uri->segment(2) != ""){ echo 'readonly';}?>>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Service Name In Marathi<b class="require">*</b></label>
                                                    <input  autocomplete="off" type="text" class="form-control" name="service_name_marathi" id="service_name_marathi" value="<?php if (!empty($single)) { echo $single->service_name_marathi; } ?>" placeholder="Enter service name in marathi" <?php if($this->uri->segment(2) != ""){ echo 'readonly';}?>>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Service Image<b class="require">*</b></label>
                                                    <input <?php if($is_ready_service == '1'){ echo 'disabled'; } ?> type="file"  name="category_image" id="category_image" class="form-control">
                                                    <input  type="hidden"  name="old_category_image" id="old_category_image" value="<?php if (!empty($single) && $single->category_image != "") {echo $single->category_image;} ?>">
                                                    <?php if (!empty($single)) {?>
                                                        <a style="color: blue;float: right;margin-top: -63px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/service_image/<?php if (!empty($single)) {echo $single->category_image;} ?>" class="view_image">View</a>
                                                    <?php } ?>
                                                </div>
                                                
                                            <?php }else{?>
                                                <div class="form-group col-md-4 col-sm-64 col-xs-12">
                                                    <label>Select Category <b class="require">*</b></label>
                                                    <select class="form-control chosen-select form-select" name="sup_category" id="sup_category" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                        <i class="fa fa-chavron-down"></i>
                                                        <option>Select Category</option>
                                                        <?php if (!empty($sup_category)) {
                                                            foreach ($sup_category as $sup_category_result) { ?>
                                                                <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php }?>><?= $sup_category_result->sup_category ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id; } ?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Add Sub Category <b class="require">*</b></label>
                                                    <select class="form-control" name="sub_category" id="sub_category" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                        <option>Select Sub Category</option>
                                                        <?php if (!empty($single)) {?>
                                                            <option value="<?= $single->sub_category ?>" <?php if (!empty($single) && $single->sub_category) { echo 'selected';} ?>><?=$single->subcategory?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Service Name <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter Service Name" value="<?php if (!empty($single)) { echo $single->service_name; } ?>" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Service Name In Marathi<b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="service_name_marathi" id="service_name_marathi" value="<?php if (!empty($single)) { echo $single->service_name_marathi; } ?>" placeholder="Enter service name in marathi" <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?>>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Service Image<b class="require">*</b></label>
                                                    <input <?php if($is_ready_service == '1'){ echo 'disabled'; } ?> type="file"  name="category_image" id="category_image" class="form-control">
                                                    <input type="hidden"  name="old_category_image" id="old_category_image" value="<?php if (!empty($single)) {echo $single->category_image;} ?>">
                                                    <?php if (!empty($single)) {?>
                                                        <a style="color: blue;float: right;margin-top: -63px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/service_image/<?php if (!empty($single)) {echo $single->category_image;} ?>" class="view_image">View</a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" id="is_ready_service" name="is_ready_service" value="<?=$is_ready_service;?>">
                                            <input type="hidden" id="service_pkey" name="service_pkey" value="<?=$service_pkey;?>">
                                            <div class=" form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Gender<b class="require">*</b></label>          
                                                <input autocomplete="off" type="hidden" name="service_gender" id="service_gender" value="<?php if (!empty($single)) { echo $single->gender; } ?>">                                      
                                                <select <?php if($this->uri->segment(2) != ""){ echo 'disabled';}?> class="form-select form-control" name="gender" id="gender">
                                                    <?php if ($store_category->category == '0'){?>
                                                        <option id="male" value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == '1'){?>
                                                        <option id="female" value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == '2'){?>
                                                        <option id="male" value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                                        <option id="female" value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                                        <!-- <option id="other" value="2" <?php if(!empty($single) && $single->gender == '2'){?>selected="selected"<?php }?>>Other</option> -->
                                                    <?php }?>
                                                </select>
												<div class="error" id="gender_error"></div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class=" form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Duration in minutes<b class="require">*</b></label>
                                               <input autocomplete="off" type="text" name="service_duration" id="service_duration" class="form-control" placeholder="Select duration of service" value="<?php if (!empty($single)) { echo $single->service_duration; } ?>">
                                            </div> 
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Actual Price <b class="require">*</b></label>
                                                <input autocomplete="off" value="<?php if (!empty($single)) {echo $single->final_price; } ?>" type="text" name="final_price" id="final_price" class="form-control" placeholder="Enter price" >
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="1" <?php if (!empty($single) && $single->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                                    <option value="0" <?php if (!empty($single) && $single->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Discount Type<small></small><b class="require">*</b></label>
                                                <select name="discount_type" id="discount_type" class="form-control">
                                                    <option value="1" <?php if (!empty($single) && $single->discount_type == '1') { echo 'selected'; } ?>>Flexible</option>
                                                    <option value="0" <?php if (!empty($single) && $single->discount_type == '0') { echo 'selected'; } ?>>Fixed</option>
                                                </select>
                                            </div>
                                            <div class="form-group flexible_discount col-md-4 col-sm-4 col-xs-12 min">
                                                <label>Flexible Min Length<b class="require">*</b></label>
                                                <input autocomplete="off" value="<?php if(!empty($single)) {echo $single->min; }?>" type="text" name="min" id="min" class="form-control" placeholder="Enter greater than 5">
                                                <div class="min_message"></div>
                                            </div>
                                            <div class="form-group flexible_discount col-md-4 col-sm-4 col-xs-12 max">
                                                <label>Flexible Max Length<b class="require">*</b></label>
                                                <input autocomplete="off" value="<?php if (!empty($single)) {echo $single->max; } ?>" type="text" name="max" id="max" class="form-control" placeholder="Enter smallest than 30">
                                                <div class="max_message"></div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12 service_discount" style="display: none;">
                                                <label>Service Discount<b class="require">*</b></label>
                                                <input autocomplete="off" value="<?php if (!empty($single)) {echo $single->service_discount; } ?>" type="text" name="service_discount" id="service_discount" class="form-control" placeholder="Service Discount">
                                                <div id="service_discount_error" class="error"></div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12 reward_point" style="display: none;">
                                                <label>Reward Point <small></small><b class="require"></b></label>
                                                <input autocomplete="off" value="<?php if (!empty($single)) {echo $single->reward_point; } ?>" type="text" name="reward_point" id="reward_point" class="form-control" placeholder="Reward Point">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                                <label>Select Products <small>(After Home care)</small></label>
                                                <select class="form-select form-control chosen-select" name="product[]" id="product" multiple> 
                                                 <option class="">Select</option>
                                                    <?php if (!empty($product_master_list)) {
                                                        $service_exp = [];
                                                            if (!empty($single)){
                                                                $service_exp = explode(",",$single->product);
                                                            }
                                                            foreach ($product_master_list as $product_master_list_result) { ?>
                                                            <option value="<?= $product_master_list_result->id ?>" <?php if (in_array($product_master_list_result->id,$service_exp)){?>selected="selected"<?php }?>><?= $product_master_list_result->product_category_name . ' -> ' . $product_master_list_result->product_sub_category_name . ' -> ' . $product_master_list_result->product_name ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Is Special Service ? </label>
                                                <input style="height: 25px !important; display:block;margin-bottom: 15px;" type="checkbox" name="is_special" id="is_special" class="dashboardToggle" <?php if (!empty($single) && $is_special_service == '1') { echo 'checked';} ?>>
                                            </div>
                                            <!-- <div class="form-group col-md-4 col-sm-4 col-xs-12" style="display:none;">
                                                <label>Reminder Duration in Days</label>
                                                <input autocomplete="off" value="<?php if (!empty($single)) {echo $single->reminder_duration; } ?>" type="text" name="reminder_duration" id="reminder_duration" class="form-control" placeholder="Enter reminder duration">
                                            </div> -->
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Service description</label>
                                                <textarea type="text" class="full-featured-non-premium" name="service_description" id="service_description"  cols="30" rows="10"><?php if (!empty($single)) {echo $single->service_description; } ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="4">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Service List</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($disaprove_services)) {
                                    $j = 0;
                                    $m = 0;
                                    $i = 1;
                                    $k = 1;
                                    foreach ($disaprove_services as $services_result) {
                                        $service_products = $this->Salon_model->get_selected_service_products($services_result->product);
                                       ?>
                                        <div class="col-md-6">
                                            <div class="service_card_box">
                                                <div class="dropdown card-btn-btn">
                                                    <ul style="list-style: none;">
                                                            <?php if($services_result->is_deleted == "0"){?>
                                                                <a title="Waiting for approval via administration"  class="btn btn-danger">Pending</a>  
                                                            <?php }else{?>
                                                                <a title="<?php echo $services_result->reject_reason ?>"  class="btn btn-danger">Rejected</a> 
                                                            <?php }?>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_image/' . $services_result->category_image) ?>)"></div>

                                                <div class="service-info-div">
                                                    <h4><?= $services_result->service_name ?></h4>
                                                    <p><span><?=$services_result->sup_category?>|<?=$services_result->sup_category_marathi?></span></p>
                                                    <p><?= $services_result->subcategory ?>|<?= $services_result->sub_category_marathi ?></p>
                                                    <?php
                                                        if($services_result->gender == '0'){
                                                            echo '<p>Male<p/>';
                                                        }elseif($services_result->gender == '1'){
                                                            echo '<p>Female</p>';
                                                        }elseif($services_result->gender == '2'){
                                                            echo '<p>Other</p>';
                                                        }
                                                    ?>
                                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                    <p><span style="text-decoration: line-through;">Rs: <?= $services_result->final_price ?></span>&nbsp; <span>Rs: <?= $services_result->final_price ?></span></p>
                                                </div>
                                            </div>
                                            <div class="service-card-footer">
                                                <div>
                                                    <p class="services_footer_count"><?= $services_result->reward_point ?></p>
                                                    <p> Reward</p>
                                                </div>
                                               
                                                <div class="product-modal-link"data-popup-open="popup-<?=$services_result->id?>"  onclick="view_description('<?=$services_result->id?>')">
                                                <?php if (!empty($service_products)) {
                                                    foreach ($service_products as $service_products_result) {
                                                        $j++;
                                                    }
                                                } ?>
                                                    <p class="services_footer_count"><?=$j?></p>
                                                    <p> Product</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="popup" data-popup="popup-<?=$services_result->id?>">
                                            <div class="popup-inner">
                                                <h3>Products</h3>
                                                <div class="popup-scroll">
                                                    <div class="as-service-box">
                                                        <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_image/' . $services_result->category_image) ?>)"></div>
                                                        <div>
                                                            <h4><?= $services_result->service_name ?></h4>
                                                            <p><span><?=$services_result->sup_category?>|<?=$services_result->sup_category_marathi?></span></p>
                                                            <p><?= $services_result->subcategory ?>|<?= $services_result->sub_category_marathi ?></p>
                                                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                            <p><span style="text-decoration: line-through;">Rs: <?= $services_result->final_price ?></span>&nbsp; <span>Rs: <?= $services_result->final_price ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="modal-emp-box">
                                                    <?php if (!empty($service_products)) {
                                                        foreach ($service_products as $service_products_result) {?>
                                                            <div>
                                                                <div class="emp-img-box" style="background-image:url(<?= base_url('admin_assets/images/product_image/' . $service_products_result->product_photo) ?>)"></div> 
                                                                <span><?= $service_products_result->product_name ?></span>
                                                            </div>    
                                                    <?php }}?>
                                                </div>
                                                <a class="popup-close" data-popup-close="popup-<?=$services_result->id?>" href="javascript:void(0);">x</a>
                                            </div>
                                        </div>

                                        <!-- <?=$j?> -->

                                        <?php $k++; $m=0;$j=0;}}else{?>
                                    <div class="col-md-12" style="font-size: 25px;">
                                       <img src="<?= base_url() ?>admin_assets/images/no_data/no_service.jpg">
                                    </div>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>


<?php include('footer.php');

$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<!-- <script src="<?=base_url();?>assets/js/jquery.validate.min.js"></script> -->
<script>
    $(document).ready(function() {
        $.validator.addMethod("divisibleByFive", function(value, element) {
            return this.optional(element) || (value % 5 === 0);
        }, "Please enter a value divisible by 5.");
        $('#sub_category_form').validate({
            ignore: '',
            rules: {
                sup_category: {
                    required: true,
                },
                sub_category: {
                    required: true,
                },
                discount_in: {
                    required: true,
                },
                service_name: {
                    required: true,
                },
                'userfile[]': {
                    required: true,
                },
                duration: {
                    required: true,
                    number: true,
                },
                final_price: {
                    required: true,
                    number: true,
                },
                service_discount: {
                    required: function(element) {
                        return $('#discount_type').val() == '0';
                    },
                    number: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                },
                discount_type: {
                    required: true,
                },
                service_duration: {
                    required: true,
                    number: true,
                },
                gender: {
                    required: true,
                },
                reminder_duration: {
                    number: true,
                },
                min: {
                    required: function(element) {
                        return $('#discount_type').val() == '1';
                    },
                    number: true,
                    min: 5,
                    max: 30,
                    divisibleByFive: true,
                },
                max: {
                    required: function(element) {
                        return $('#discount_type').val() == '1';
                    },
                    number: true,
                    min: 5,
                    max: 30,
                    divisibleByFive: true,
                },
                service_name_marathi:{
                    required: true,
                },
                <?php if(!empty($single) && $single->category_image == ""){?>
                category_image:{
                    required: true,
                },
                <?php } else if(empty($single)){?>
                    category_image:{
                        required: true,
                    },
                <?php } ?>

            },
            messages: {
                sup_category: {
                    required: "Please select category!",
                },
                sub_category: {
                    required: "Please select sub category!",
                },
                discount_in: {
                    required: "Please select discount type!",
                },
                service_name: {
                    required: "Please enter service name!",
                },
                'userfile[]': {
                    required: "Please upload image!",
                },
                duration: {
                    required: "Please enter duration!",
                    number: "Only number allowed!",
                },
                final_price: {
                    required: "Please enter actual price!",
                    number: "Only number allowed!",
                },
                service_discount: {
                    required: "Please enter service discount!",
                    number: "Only number allowed!",
                },
                discount_type: {
                    required: "Please select discount type!",
                },
                service_duration: {
                    required: "Please enter service duration!",
                    number: "Only number allowed!",
                },
                gender: {
                    required: "Please select gender!",
                },
                max: {
                    required:"Please enter flexible max length!",
                    number: "Only number allowed!",
                    min: "Value must be at least 5.",
                    max: "Value must be no more than 30.",
                    divisibleByFive: "Please enter a value divisible by 5.",
                },
                min: {
                    required:"Please enter flexible min length!",
                    number: "Only number allowed!",
                    min: "Value must be at least 5.",
                    max: "Value must be no more than 30.",
                    divisibleByFive: "Please enter a value divisible by 5.",
                },
                reminder_duration: {
                    number: "Only number allowed!",
                },
                service_name_marathi:{
                    required: "Please enter service name in marathi!",
                },
                <?php if(!empty($single) && $single->category_image == ""){?>
                category_image:{
                    required: "Please upload category image!",
                },
                <?php }else if(empty($single)){ ?>
                    category_image:{
                        required: "Please upload category image!",
                    },
                <?php } ?>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var discountTypeSelect = document.getElementById('discount_type');
        var serviceDiscountDiv = document.querySelector('.service_discount');
        var rewardPointDiv = document.querySelector('.reward_point');

        var serviceDiscountDiv_min = document.querySelector('.min');
        var rewardPointDiv_max = document.querySelector('.max');

        function toggleFields() {
            var discountType = discountTypeSelect.value;
            if (discountType == '0') { // Fixed
                serviceDiscountDiv.style.display = 'block';
                rewardPointDiv.style.display = 'block';
                serviceDiscountDiv_min.style.display = 'none';
                rewardPointDiv_max.style.display = 'none';
            } else { // Flexible
                serviceDiscountDiv.style.display = 'none';
                rewardPointDiv.style.display = 'none';
                serviceDiscountDiv_min.style.display = 'block';
                rewardPointDiv_max.style.display = 'block';
            }
        }
        // Initial toggle based on the selected value
        toggleFields();
        // Toggle fields on change
        discountTypeSelect.addEventListener('change', toggleFields);
    });
</script>
<script>
     $("#discount_type").change(function() {
        // alert();
            if($("#discount_type").val()== 1){
                $(".flexible_discount").fadeIn();
                $("#min").fadeIn();
                $("#max").fadeIn();
                $(".service_discount").fadeOut();
                $(".reward_point").fadeOut();
            }else{
                $(".flexible_discount").fadeOut();
                $(".service_discount").fadeIn();
                $(".reward_point").fadeIn();
            }
        });
        $("#service_discount").keyup(function() {
            $("#reward_point").val($("#service_discount").val());
        });
        $("#min").change(function() {
        var minValue = parseFloat($("#min").val());
        if ((minValue < 5) || (minValue > 30)){
            $('.min_message').text("Min value is not small than 5 and greater than 30");
            $("#min").val("")
        }else{
            $('.min_message').empty();
            getdiscountvalue();
        }
        });

        $("#max").change(function() {
            var maxValue = parseFloat($("#max").val());
        if ((maxValue > 30) || (maxValue < 5)){
            $('.max_message').text("Max value is not greater than 30 and not small than 5");
            $("#max").val("")
        }else{
            $('.max_message').empty();
            getdiscountvalue();
        }
        });

        function getdiscountvalue() {
            var validValues = [15, 20, 10];
            var randomIndex = Math.floor(Math.random() * validValues.length);
            var randomValue = validValues[randomIndex];
           
                $("#service_discount").val(randomValue);
                $("#reward_point").val(randomValue);
        }

       
    $("#sup_category").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_sub_category_ajax",
            data: {
                'sup_category': $("#sup_category").val()
            },
            success: function(data) {
                $("#sub_category").empty();
                $('#sub_category').append('<option>Select Sub Category</option>');
                var opts = $.parseJSON(data);
                console.log(opts);
                $.each(opts, function(i, d) {
                    $('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#sub_category').trigger('change');
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
    $('#value_check').change(function() {
        if ($('#value_check').val() == 'No') {
            $('.sub-category-box').show();
            $('.third-category-box').hide();
            // $('#third_category').attr('required', true);
        } else if ($('#value_check').val() == 'Yes') {
            $('.third-category-box').show();
            $('.sub-category-box').hide();
            // $('#third_category').attr('required', false);
        }
    });
    $(document).ready(function() {
        $('.timepicker').clockpicker({
            donetext: 'Done',
            twelvehour: false
        });
    });
</script>

<script>
    function view_description(service_id){
    $('[data-popup-open]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + service_id + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + service_id + '"]').fadeOut(350);
 
        e.preventDefault();
    });
}
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.service-setup').addClass('active_cc');
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
                                  tinymce.init({
                                  selector: 'textarea.full-featured-non-premium',
                                  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                                  imagetools_cors_hosts: ['picsum.photos'],
                                  menubar: 'file edit view insert format tools table help',
                                  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                  toolbar_sticky: true,
                                  autosave_ask_before_unload: true,
                                  autosave_interval: "30s",
                                  autosave_prefix: "{path}{query}-{id}-",
                                  autosave_restore_when_empty: false,
                                  autosave_retention: "2m",
                                  image_advtab: true,
                                  content_css: '//www.tiny.cloud/css/codepen.min.css',
                                  link_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_class_list: [
                                    { title: 'None', value: '' },
                                    { title: 'Some class', value: 'class-name' }
                                  ],
                                  importcss_append: true,
                                  file_picker_callback: function (callback, value, meta) {
                                  
                                    if (meta.filetype === 'file') {
                                      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                                    }

                                  
                                    if (meta.filetype === 'image') {
                                      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                                    }

                                  
                                    if (meta.filetype === 'media') {
                                      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                                    }
                                  },
                                  templates: [
                                        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                                  ],
                                  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                                  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                                  height: 178,
                                  image_caption: true,
                                  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                                  noneditable_noneditable_class: "mceNonEditable",
                                  toolbar_mode: 'sliding',
                                  contextmenu: "link image imagetools table",
                                });
</script>


<script>
                                  tinymce.init({
                                  selector: '#service_description1',
                                  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                                  imagetools_cors_hosts: ['picsum.photos'],
                                  menubar: 'file edit view insert format tools table help',
                                  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                  toolbar_sticky: true,
                                  autosave_ask_before_unload: true,
                                  autosave_interval: "30s",
                                  autosave_prefix: "{path}{query}-{id}-",
                                  autosave_restore_when_empty: false,
                                  autosave_retention: "2m",
                                  image_advtab: true,
                                  content_css: '//www.tiny.cloud/css/codepen.min.css',
                                  link_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_class_list: [
                                    { title: 'None', value: '' },
                                    { title: 'Some class', value: 'class-name' }
                                  ],
                                  importcss_append: true,
                                  file_picker_callback: function (callback, value, meta) {
                                  
                                    if (meta.filetype === 'file') {
                                      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                                    }

                                  
                                    if (meta.filetype === 'image') {
                                      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                                    }

                                  
                                    if (meta.filetype === 'media') {
                                      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                                    }
                                  },
                                  templates: [
                                        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                                  ],
                                  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                                  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                                  height: 178,
                                  image_caption: true,
                                  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                                  noneditable_noneditable_class: "mceNonEditable",
                                  toolbar_mode: 'sliding',
                                  contextmenu: "link image imagetools table",
                                });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var finalPriceInput = document.getElementById('final_price');
        var serviceDiscountInput = document.getElementById('service_discount');
        var serviceDiscountError = document.getElementById('service_discount_error');

        serviceDiscountInput.addEventListener('input', function() {
            var finalPrice = parseFloat(finalPriceInput.value);
            var serviceDiscount = parseFloat(serviceDiscountInput.value);

            if (isNaN(finalPrice) || isNaN(serviceDiscount)) {
                return;
            }
            if (serviceDiscount >= finalPrice) {
                serviceDiscountError.innerHTML = 'Service Discount cannot be greater than Actual Price';
                // serviceDiscountInput.value = ''; // Optionally, clear the discount input field
            } else {
                serviceDiscountError.innerHTML = '';
            }
        });
    });
</script>

<!-- <script>
    $(document).ready(function() {
        <?php if (!empty($single)) { ?>
            $('#sup_category').prop('disabled', true);
        <?php } ?>
    });

</script> -->

<!-- <script>
    document.querySelector('sub_category_form').addEventListener('submit', function() {
        document.querySelectorAll('select[disabled]').forEach(function(input) {
            input.disabled = false;
        });
    });
</script> -->
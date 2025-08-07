<?php include('header.php'); ?>
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
        background-color: rgba(0, 0, 0, 0.5); 
    }

    .loader {
        border: 8px solid #f3f3f3; 
        border-top: 8px solid #3498db; 
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite; 
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 25px; 
        margin-left: 25px; 
    }

.page-title .title_left h3 {
    margin: 8px 0px;
    margin-left: 0px;

}

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="right_col" role="main">
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="page-title">
        <div class="title_left">
            <h3>Automated Marketing</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'new' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-new-customers'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">                    
                        <form method="POST" id="new_client_form">                           
                            <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label id="new_client">New Client <small>(First Booking)</small></label>
                            </div>                          
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_new)){ ?>
                                        <?php if($single_new->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/0" title="Active Marketing Discount"><i id="discount_status_on_0" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/0" title="Inactive Marketing Discount"><i id="discount_status_off_0" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_0" id="all_service_0" value="0" <?php if (!empty($single_new) && $single_new->for_service == '0') { echo 'checked'; } ?> onclick="toggleServiceDropdown_0()"><span>All service</span>
                                    <input type="radio" name="service_option_0" id="selected_service_0" value="1" <?php if (!empty($single_new) && $single_new->for_service == '1') { echo 'checked'; } ?> onclick="toggleServiceDropdown_0()"><span>Selected service</span>
                                    <span for="service_option_0" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>                         
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_0" style="<?php if (!empty($single_new)){ if($single_new->for_service == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Services<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_0" name="selected_service_0[]" multiple="multiple">
                                        <option value="">Select Services</option>
                                        <?php if(!empty($all_services)) { 
                                            $selected_services = [];
                                            if(!empty($single_new) && $single_new->for_service == '1'){
                                                $selected_services = explode(',',$single_new->selected_service);
                                            }
                                            foreach($all_services as $service_result) { 
                                        ?>
                                                <option value="<?=$service_result->id; ?>" 
                                                    <?php if (!empty($single_new) && in_array($service_result->id, $selected_services) && $single_new->for_service == '1') { echo 'selected'; } ?>>
                                                    <?=$service_result->service_name; ?> | <?=$service_result->service_name_marathi; ?>
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_0" id="discount_in_0" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_new) && $single_new->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_new) && $single_new->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_new)) { echo $single_new->discount_amount; } ?>" type="text" name="discount_amount_0" id="discount_amount_0" class="form-control" placeholder="Discount Amount">
                                </div>
                             </div>
                            <button type="submit" name="new_client_submit" value="new_client_submit" id="new_client_submit" class="btn btn-primary">Save Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'regular' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-regular-customers'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">
                        <form method="POST" id="regular_form">                           
                            <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label id="regular_client" name="regular_client">Regular Client <small>(Reward Points)</small></label>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_regular)){ ?>
                                        <?php if($single_regular->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/1" title="Active Marketing Discount"><i id="discount_status_on_1" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/1" title="Inactive Marketing Discount"><i id="discount_status_off_1" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_1" id="all_service_1" <?php if (!empty($single_regular) && $single_regular->for_service == '0') { echo 'checked'; } ?> value="0" onclick="toggleServiceDropdown()"><span>All service</span>
                                    <input type="radio" name="service_option_1" id="selected_service_1" <?php if (!empty($single_regular) && $single_regular->for_service == '1') { echo 'checked'; } ?> value="1" onclick="toggleServiceDropdown()"><span>Selected service</span>
                                    <span for="service_option_1" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>                         
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_1" style="<?php if (!empty($single_regular)){ if($single_regular->for_service == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Services<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_1" name="selected_service_1[]" multiple="multiple">
                                        <option value="">Select Services</option>
                                        <?php if(!empty($all_services)) { 
                                            $selected_services = [];
                                            if(!empty($single_regular) && $single_regular->for_service == '1'){
                                                $selected_services = explode(',',$single_regular->selected_service);
                                            }
                                            foreach($all_services as $all_services_result) { ?>
                                                <option value="<?=$all_services_result->id?>" 
                                                    <?php if (!empty($single_regular) && in_array($all_services_result->id, $selected_services) && $single_new->for_service == '1') { echo 'selected'; } ?>>
                                                    <?=$all_services_result->service_name?> | <?=$all_services_result->service_name_marathi; ?>
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_1" id="discount_in_1" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_regular) && $single_regular->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_regular) && $single_regular->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Type<small></small><b class="require">*</b></label>
                                    <select name="discount_type_1" id="discount_type_1" class="form-control chosen-select">
                                        <option value="">Select Discount Type</option>
                                        <option value="1" <?php if (!empty($single_regular) && $single_regular->discount_type == '1') { echo 'selected'; } ?>>Flexible</option>
                                        <option value="0" <?php if (!empty($single_regular) && $single_regular->discount_type == '0') { echo 'selected'; } ?>>Fixed</option>
                                    </select>
                                </div> 
                                <div class="form-group col-md-4 col-sm-4 col-xs-12 regular_discount_amount" style="<?php if (!empty($single_regular)){ if($single_regular->discount_type == '0') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_regular) && $single_regular->discount_type == '0') { echo $single_regular->discount_amount; }else{ echo ''; } ?>" type="text" name="discount_amount_1" id="discount_amount_1" class="form-control" placeholder="Discount Amount">
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group flexible_discount col-md-4 col-sm-4 col-xs-12 flexible_min" style="<?php if (!empty($single_regular)){ if($single_regular->discount_type == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Flexible Min Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if(!empty($single_regular)) {echo $single_regular->flexible_min; }?>" type="text" name="flexible_min_1" id="flexible_min_1" class="form-control" placeholder="Enter greater than 5">
                                    <div class="min_message"></div>
                                </div> 
                                <div class="form-group flexible_discount col-md-4 col-sm-4 col-xs-12 flexible_max" style="<?php if (!empty($single_regular)){ if($single_regular->discount_type == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Flexible Max Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_regular)) {echo $single_regular->flexible_max; } ?>" type="text" name="flexible_max_1" id="flexible_max_1" class="form-control" placeholder="Enter smallest than 30">
                                    <div class="max_message"></div>
                                </div>
                            </div>
                            <button type="submit" name="regular_submit" value="regular_submit" id="regular_submit" class="btn btn-primary">Save Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'lost' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-lost-customers'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">
                        <form method="POST" id="lost_client_form">                                                             
                            <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                               <label id="new_client">Lost Client</label>
                            </div>                           
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_lost)){ ?>
                                        <?php if($single_lost->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/2" title="Active Marketing Discount"><i id="discount_status_on_2" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/2" title="Inactive Marketing Discount"><i id="discount_status_off_2" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_2" id="all_service_2" value="0" <?php if (!empty($single_lost) && $single_lost->for_service == '0') { echo 'checked'; } ?> onclick="toggleServiceDropdown_2()"><span>All service</span>
                                    <input type="radio" name="service_option_2" id="selected_service_2" value="1" <?php if (!empty($single_lost) && $single_lost->for_service == '1') { echo 'checked'; } ?> onclick="toggleServiceDropdown_2()"><span>Selected service</span>
                                    <span for="service_option_2" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>     
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_2" style="<?php if (!empty($single_lost)){ if($single_lost->for_service == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Services<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_2" name="selected_service_2[]" multiple="multiple">
                                        <option value="">Select Services</option>
                                        <?php if(!empty($all_services)) { 
                                            $selected_services = [];
                                            if(!empty($single_lost) && $single_lost->for_service == '1'){
                                                $selected_services = explode(',',$single_lost->selected_service);
                                            }
                                            foreach($all_services as $service_result) { 
                                        ?>
                                                <option value="<?=$service_result->id; ?>" 
                                                    <?php if (!empty($single_lost) && in_array($service_result->id, $selected_services) && $single_lost->for_service == '1') { echo 'selected'; } ?>>
                                                    <?=$service_result->service_name; ?> | <?=$service_result->service_name_marathi; ?>
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_2" id="discount_in_2" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_lost) && $single_lost->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_lost) && $single_lost->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_lost)) { echo $single_lost->discount_amount; } ?>" type="text" name="discount_amount_2" id="discount_amount_2" class="form-control" placeholder="Discount Amount">
                                </div>
                             </div>
                           <button type="submit" name="lost_client_submit" value="lost_client_submit" id="lost_client_submit" class="btn btn-primary">Save Data</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'birthday' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-birthday-customers'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">
                        <form method="POST" id="birthday_form">                                                               
                            <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label id="new_client">Birthday Offers</label>
                            </div>                          
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_birthday)){ ?>
                                        <?php if($single_birthday->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/3" title="Active Marketing Discount"><i id="discount_status_on_3" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/3" title="Inactive Marketing Discount"><i id="discount_status_off_3" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_3" id="all_service_3" value="0" <?php if (!empty($single_birthday) && $single_birthday->for_service == '0') { echo 'checked'; } ?> onclick="toggleServiceDropdown_3()"><span>All service</span>
                                    <input type="radio" name="service_option_3" id="selected_service_3" value="1" <?php if (!empty($single_birthday) && $single_birthday->for_service == '1') { echo 'checked'; } ?> onclick="toggleServiceDropdown_3()"><span>Selected service</span>
                                    <span for="service_option_3" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>                         
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_3" style="<?php if (!empty($single_birthday)){ if($single_birthday->for_service == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Services<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_3" name="selected_service_3[]" multiple="multiple">
                                        <option value="">Select Services</option>
                                        <?php if(!empty($all_services)) { 
                                            $selected_services = [];
                                            if(!empty($single_birthday) && $single_birthday->for_service == '1'){
                                                $selected_services = explode(',',$single_birthday->selected_service);
                                            }
                                            foreach($all_services as $service_result) { 
                                        ?>
                                                <option value="<?=$service_result->id; ?>" 
                                                    <?php if (!empty($single_birthday) && in_array($service_result->id, $selected_services) && $single_birthday->for_service == '1') { echo 'selected'; } ?>>
                                                    <?=$service_result->service_name; ?> | <?=$service_result->service_name_marathi; ?>
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_3" id="discount_in_3" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_birthday) && $single_birthday->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_birthday) && $single_birthday->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_birthday)) { echo $single_birthday->discount_amount; } ?>" type="text" name="discount_amount_3" id="discount_amount_3" class="form-control" placeholder="Discount Amount">
                                </div>
                             </div>
                            <button type="submit" name="birthday_submit" value="birthday_submit" id="birthday_submit" class="btn btn-primary">Save Data</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'anniversary' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-anniversary-customers'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">
                        <form method="POST" id="anniversary_form">                                                               
                            <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label id="new_client">Anniversary Offers</label>
                            </div>                          
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_anniversary)){ ?>
                                        <?php if($single_anniversary->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/4" title="Active Marketing Discount"><i id="discount_status_on_4" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/4" title="Inactive Marketing Discount"><i id="discount_status_off_4" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_4" id="all_service_4" value="0" <?php if (!empty($single_anniversary) && $single_anniversary->for_service == '0') { echo 'checked'; } ?> onclick="toggleServiceDropdown_4()"><span>All service</span>
                                    <input type="radio" name="service_option_4" id="selected_service_4" value="1" <?php if (!empty($single_anniversary) && $single_anniversary->for_service == '1') { echo 'checked'; } ?> onclick="toggleServiceDropdown_4()"><span>Selected service</span>
                                    <span for="service_option_4" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>                         
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_4" style="<?php if (!empty($single_anniversary)){ if($single_anniversary->for_service == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Services<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_4" name="selected_service_4[]" multiple="multiple">
                                        <option value="">Select Services</option>
                                        <?php if(!empty($all_services)) { 
                                            $selected_services = [];
                                            if(!empty($single_anniversary) && $single_anniversary->for_service == '1'){
                                                $selected_services = explode(',',$single_anniversary->selected_service);
                                            }
                                            foreach($all_services as $service_result) { 
                                        ?>
                                                <option value="<?=$service_result->id; ?>" 
                                                    <?php if (!empty($single_anniversary) && in_array($service_result->id, $selected_services) && $single_anniversary->for_service == '1') { echo 'selected'; } ?>>
                                                    <?=$service_result->service_name; ?> | <?=$service_result->service_name_marathi; ?>
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_4" id="discount_in_4" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_anniversary) && $single_anniversary->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_anniversary) && $single_anniversary->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_anniversary)) { echo $single_anniversary->discount_amount; } ?>" type="text" name="discount_amount_4" id="discount_amount_4" class="form-control" placeholder="Discount Amount">
                                </div>
                            </div>
                            <button type="submit" name="anniversary_submit" value="anniversary_submit" id="anniversary_submit" class="btn btn-primary">Save Data</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if(isset($_GET['type']) && ($_GET['type'] == 'product_marketing' || $_GET['type'] == 'all')){ ?>
        <div class="x_panel <?php if(empty(array_intersect(['automated-product-marketing'], $feature_slugs))) { echo 'blurred '; }?>">
            <div class="x_content">
                <div class="container">
                    <div class="row">
                        <form method="POST" id="product_marketing_form">                                                             
                        <div style="margin-bottom: 0 !important;padding-left:0;" class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label id="product_marketing" name="product_marketing">Product Marketing</label>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <?php if(!empty($single_product_marketing)){ ?>
                                        <?php if($single_product_marketing->discount_status == '0'){ ?>
                                            <a onclick="return confirm('Are you sure you want to activate the marketing discount?');" href="<?=base_url();?>activate_marketing_discount/5" title="Active Marketing Discount"><i id="discount_status_on_5" class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you sure you want to inactivate the marketing discount?');" href="<?=base_url();?>inactivate_marketing_discount/5" title="Inactive Marketing Discount"><i id="discount_status_off_5" style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="service_option_5" id="all_service_5" <?php if (!empty($single_product_marketing) && $single_product_marketing->for_product == '0') { echo 'checked'; } ?> value="0" onclick="toggleServiceDropdown_5()"><span>All Product</span>
                                    <input type="radio" name="service_option_5" id="selected_service_5" <?php if (!empty($single_product_marketing) && $single_product_marketing->for_product == '1') { echo 'checked'; } ?> value="1" onclick="toggleServiceDropdown_5()"><span>Selected Product</span>
                                    <span for="service_option_1" style="display:block;" generated="true" class="error invalid-feedback"></span>                    
                                </div>                         
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="serviceDropdown_5" style="<?php if (!empty($single_product_marketing)){ if($single_product_marketing->for_product == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Select Products<b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="selected_service_5" name="selected_service_5[]" multiple="multiple">
                                        <option value="">Select Products</option>
                                        <?php if(!empty($all_products)) { 
                                            $selected_services = [];
                                            if(!empty($single_product_marketing) && $single_product_marketing->for_product == '1'){
                                                $selected_services = explode(',',$single_product_marketing->selected_product);
                                            }
                                            foreach($all_products as $all_services_result) { ?>
                                                <option value="<?=$all_services_result->id?>" 
                                                    <?php if (!empty($single_product_marketing) && in_array($all_services_result->id, $selected_services) && $single_product_marketing->for_product == '1') { echo 'selected'; } ?>>
                                                    <?=$all_services_result->product_name?> [<?=rtrim($all_services_result->productcategory); ?><?=$all_services_result->product_sub_category_name != "" ? '->' . rtrim($all_services_result->product_sub_category_name) : ''; ?>]
                                                </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount In<b class="require">*</b></label>
                                    <select name="discount_in_5" id="discount_in_5" class="form-control chosen-select">
                                        <option value="">Select Discount In</option>
                                        <option value="0" <?php if (!empty($single_product_marketing) && $single_product_marketing->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        <option value="1" <?php if (!empty($single_product_marketing) && $single_product_marketing->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Discount Type<small></small><b class="require">*</b></label>
                                    <select name="discount_type_5" id="discount_type_5" class="form-control chosen-select">
                                        <option value="">Select Discount Type</option>
                                        <option value="1" <?php if (!empty($single_product_marketing) && $single_product_marketing->discount_type == '1') { echo 'selected'; } ?>>Flexible</option>
                                        <option value="0" <?php if (!empty($single_product_marketing) && $single_product_marketing->discount_type == '0') { echo 'selected'; } ?>>Fixed</option>
                                    </select>
                                </div> 
                                <div class="form-group col-md-4 col-sm-4 col-xs-12 product_regular_discount_amount" style="<?php if (!empty($single_product_marketing)){ if($single_product_marketing->discount_type == '0') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Discount Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_product_marketing) && $single_product_marketing->discount_type == '0') { echo $single_product_marketing->discount_amount; }else{ echo ''; } ?>" type="text" name="discount_amount_5" id="discount_amount_5" class="form-control" placeholder="Discount Amount">
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group product_flexible_discount col-md-4 col-sm-4 col-xs-12 product_flexible_min" style="<?php if (!empty($single_product_marketing)){ if($single_product_marketing->discount_type == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Flexible Min Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if(!empty($single_product_marketing)) {echo $single_product_marketing->flexible_min; }?>" type="text" name="flexible_min_5" id="flexible_min_5" class="form-control" placeholder="Enter greater than 5">
                                    <div class="min_message"></div>
                                </div> 
                                <div class="form-group product_flexible_discount col-md-4 col-sm-4 col-xs-12 product_flexible_max" style="<?php if (!empty($single_product_marketing)){ if($single_product_marketing->discount_type == '1') { echo 'display: block;'; }else{ echo 'display: none;'; }}else{ echo 'display: none;'; } ?>">
                                    <label>Flexible Max Amount<b class="require">*</b></label>
                                    <input autocomplete="off" value="<?php if (!empty($single_product_marketing)) {echo $single_product_marketing->flexible_max; } ?>" type="text" name="flexible_max_5" id="flexible_max_5" class="form-control" placeholder="Enter smallest than 30">
                                    <div class="max_message"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Employee Incentive<b class="require">*</b> <small>(For each Product Sell)</small></label>
                                    <input autocomplete="off" value="<?php if(!empty($single_product_marketing)) {echo $single_product_marketing->employee_product_incentive; }?>" type="text" name="employee_product_incentive_5" id="employee_product_incentive_5" class="form-control" placeholder="Enter employee incentive amount">
                                    <div class="min_message"></div>
                                </div> 
                            </div>
                           <button type="submit" name="product_marketing_submit" value="product_marketing_submit" id="product_marketing_submit" class="btn btn-primary">Save Data</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>
    </div>
</div>
<input type="hidden" id="type" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; }?>">
<?php include('footer.php'); ?>
<script>
    function toggleStockAlert_new(state) {
        const onIcon = document.getElementById('discount_status_on_0');
        const offIcon = document.getElementById('discount_status_off_0');
        const hiddenInput = document.getElementById('discount_status');

        if (state === 1) {
            onIcon.style.display = 'none';
            offIcon.style.display = 'inline-block';
            hiddenInput.value = '1'; 
        } else {
            onIcon.style.display = 'inline-block';
            offIcon.style.display = 'none';
            hiddenInput.value = '0';  
        }
    }

    function toggleStockAlert_1(state) {
        const onIcon = document.getElementById('discount_status_on_1');
        const offIcon = document.getElementById('discount_status_off_1');
        const hiddenInput = document.getElementById('discount_status');

        if (state === 1) {
            onIcon.style.display = 'none';
            offIcon.style.display = 'inline-block';
            hiddenInput.value = '1'; 
        } else {
            onIcon.style.display = 'inline-block';
            offIcon.style.display = 'none';
            hiddenInput.value = '0';  
        }
    }

    function toggleStockAlert_test(state) {
        const onIcon = document.getElementById('discount_status_on_test');
        const offIcon = document.getElementById('discount_status_off_test');
        const hiddenInput = document.getElementById('discount_status_new');

        if (state === 1) {
            onIcon.style.display = 'none';
            offIcon.style.display = 'inline-block';
            hiddenInput.value = '1'; 
        } else {
            onIcon.style.display = 'inline-block';
            offIcon.style.display = 'none';
            hiddenInput.value = '0';  
        }
    }

    function toggleStockAlert_3(state) {
        const onIcon = document.getElementById('discount_status_on_3');
        const offIcon = document.getElementById('discount_status_off_3');
        const hiddenInput = document.getElementById('discount_status_3');

        if (state === 1) {
            onIcon.style.display = 'none';
            offIcon.style.display = 'inline-block';
            hiddenInput.value = '1'; 
        } else {
            onIcon.style.display = 'inline-block';
            offIcon.style.display = 'none';
            hiddenInput.value = '0';  
        }
    }
    </script>

    <script>
        function toggleServiceDropdown_0() {
            const serviceDropdown = document.getElementById('serviceDropdown_0');
            const allServiceRadio = document.getElementById('all_service_0');
            const selectedServiceRadio = document.getElementById('selected_service_0');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }

        function toggleServiceDropdown_3() {
            const serviceDropdown = document.getElementById('serviceDropdown_3');
            const allServiceRadio = document.getElementById('all_service_3');
            const selectedServiceRadio = document.getElementById('selected_service_3');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }
        
        function toggleServiceDropdown_4() {
            const serviceDropdown = document.getElementById('serviceDropdown_4');
            const allServiceRadio = document.getElementById('all_service_4');
            const selectedServiceRadio = document.getElementById('selected_service_4');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }
        
        function toggleServiceDropdown_5() {
            const serviceDropdown = document.getElementById('serviceDropdown_5');
            const allServiceRadio = document.getElementById('all_service_5');
            const selectedServiceRadio = document.getElementById('selected_service_5');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }

        function toggleServiceDropdown_2() {
            const serviceDropdown = document.getElementById('serviceDropdown_2');
            const allServiceRadio = document.getElementById('all_service_2');
            const selectedServiceRadio = document.getElementById('selected_service_2');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }
        function toggleServiceDropdown() {
            const serviceDropdown = document.getElementById('serviceDropdown_1');
            const allServiceRadio = document.getElementById('all_service_1');
            const selectedServiceRadio = document.getElementById('selected_service_1');

            if (selectedServiceRadio.checked) {
                serviceDropdown.style.display = 'block';
            } else {
                serviceDropdown.style.display = 'none';
            }
        }
        $("#discount_type_1").change(function() {
            if($("#discount_type_1").val() == '1'){
                $(".flexible_discount").fadeIn();
                $(".regular_discount_amount").fadeOut();               
            }else{
                $(".flexible_discount").fadeOut();         
                $(".regular_discount_amount").fadeIn();                
            }
        });
        $("#discount_type_5").change(function() {
            if($("#discount_type_5").val() == '1'){
                $(".product_flexible_discount").fadeIn();
                $(".product_regular_discount_amount").fadeOut();               
            }else{
                $(".product_flexible_discount").fadeOut();         
                $(".product_regular_discount_amount").fadeIn();                
            }
        });
        $(document).ready(function () {
            $('#new_client_form').validate({
                ignore: [],
                rules: {
                    service_option_0: 'required',
                    'selected_service_0[]': {
                        required: function(element) {
                            return $('[name=service_option_0]:checked').val() == '1';
                        }
                    },
                    discount_in_0: {
                        required: true,
                        number: true
                    },
                    discount_amount_0: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_0: 'Please select option!',
                    'selected_service_0[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_0: {
                        required: 'Please select discount in option!'
                    },
                    discount_amount_0: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('#lost_client_form').validate({
                ignore: [],
                rules: {
                    service_option_2: 'required',
                    'selected_service_2[]': {
                        required: function(element) {
                            return $('[name=service_option_2]:checked').val() == '1';
                        }
                    },
                    discount_in_2: {
                        required: true,
                        number: true
                    },
                    discount_amount_2: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_2: 'Please select option!',
                    'selected_service_2[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_2: {
                        required: 'Please select discount in option!'
                    },
                    discount_amount_2: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('#birthday_form').validate({
                ignore: [],
                rules: {
                    service_option_3: 'required',
                    'selected_service_3[]': {
                        required: function(element) {
                            return $('[name=service_option_3]:checked').val() == '1';
                        }
                    },
                    discount_in_3: {
                        required: true,
                        number: true
                    },
                    discount_amount_3: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_3: 'Please select option!',
                    'selected_service_3[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_3: {
                        required: 'Please select discount in option!'
                    },
                    discount_amount_3: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            
            $('#anniversary_form').validate({
                ignore: [],
                rules: {
                    service_option_4: 'required',
                    'selected_service_4[]': {
                        required: function(element) {
                            return $('[name=service_option_4]:checked').val() == '1';
                        }
                    },
                    discount_in_4: {
                        required: true,
                        number: true
                    },
                    discount_amount_4: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_4: 'Please select option!',
                    'selected_service_4[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_4: {
                        required: 'Please select discount in option!'
                    },
                    discount_amount_4: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            
            $('#regular_form').validate({
                ignore: [],
                rules: {
                    service_option_1: 'required',
                    'selected_service_1[]': {
                        required: function(element) {
                            return $('[name=service_option_1]:checked').val() == '1';
                        }
                    },
                    discount_in_1: {
                        required: true,
                    },
                    discount_type_1: {
                        required: true,
                    },
                    discount_amount_1: {
                        required: function(element) {
                            return $('#discount_type_1').val() == '0';
                        },
                        number: true,
                        min: 0
                    },
                    flexible_max_1: {
                        required: function(element) {
                            return $('#discount_type_1').val() == '1';
                        },
                        number: true,
                        min: 0
                    },
                    flexible_min_1: {
                        required: function(element) {
                            return $('#discount_type_1').val() == '1';
                        },
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_1: 'Please select option!',
                    'selected_service_1[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_1: {
                        required: 'Please select discount in option!'
                    },
                    discount_type_1: {
                        required: 'Please select discount type option!'
                    },
                    discount_amount_1: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    },
                    flexible_max_1: {
                        required: 'Please enter flexible max amount!',
                        number: "Only number allowed!",
                        min: 0
                    },
                    flexible_min_1: {
                        required: 'Please enter flexible min amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            
            $('#product_marketing_form').validate({
                ignore: [],
                rules: {
                    service_option_5: 'required',
                    'selected_service_5[]': {
                        required: function(element) {
                            return $('[name=service_option_5]:checked').val() == '1';
                        }
                    },
                    discount_in_5: {
                        required: true,
                    },
                    discount_type_5: {
                        required: true,
                    },
                    discount_amount_5: {
                        required: function(element) {
                            return $('#discount_type_5').val() == '0';
                        },
                        number: true,
                        min: 0
                    },
                    flexible_max_5: {
                        required: function(element) {
                            return $('#discount_type_5').val() == '1';
                        },
                        number: true,
                        min: 0
                    },
                    flexible_min_5: {
                        required: function(element) {
                            return $('#discount_type_5').val() == '1';
                        },
                        number: true,
                        min: 0
                    },
                    employee_product_incentive_5: {                        
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    service_option_5: 'Please select option!',
                    'selected_service_5[]': {
                        required: 'Please select atleast one service!'
                    },
                    discount_in_5: {
                        required: 'Please select discount in option!'
                    },
                    discount_type_5: {
                        required: 'Please select discount type option!'
                    },
                    discount_amount_5: {
                        required: 'Please enter discount amount!',
                        number: "Only number allowed!",
                        min: 0
                    },
                    flexible_max_5: {
                        required: 'Please enter flexible max amount!',
                        number: "Only number allowed!",
                        min: 0
                    },
                    flexible_min_5: {
                        required: 'Please enter flexible min amount!',
                        number: "Only number allowed!",
                        min: 0
                    },
                    employee_product_incentive_5: {
                        required: 'Please enter employee product incentive amount!',
                        number: "Only number allowed!",
                        min: 0
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        
            $("input[type=radio][name=service_option]").on("change", function () {
                var target = $(this).val();
                var serviceDropdown = $(this).closest('form').find(".serviceDropdown");
                
                if (target == "1") {
                    serviceDropdown.show();
                } else {
                    serviceDropdown.hide();
                }
            });
            $(".fa-toggle-on, .fa-toggle-off").on("click", function() {
                var isOn = $(this).hasClass("fa-toggle-on");
                var hiddenInput = $(this).closest('.form-group').find("input[type=hidden]");
                hiddenInput.val(isOn ? 0 : 1);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#back-office .child_menu').show();
            $('#back-office').addClass('nv active');
            $('.right_col').addClass('active_right');
            var type = $('#type').val();
            var activeClass = type != "" ? 'add_' + type + '_automated_marketing' : 'add_automated_marketing';
            $('.' + activeClass + '').addClass('active_cc');
        });
    </script>

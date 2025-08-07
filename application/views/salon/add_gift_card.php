<?php include('header.php');?>
<style type="text/css">
    
    .error {
        color: red;
        float: left;
       
    }
	label{
		display:block;
	}
	.color_input{
	  display: block;
	  width: 17%;
	  float: left;
	  height: 40px !important;
	}
	.color_value_input{
		display: block;
		width: 75%;
		float: left;
		height: 40px !important;
		padding-left: 10px;
		border-radius: 2px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
	.text_color_input{
	  display: block;
	  width: 17%;
	  float: left;
	  height: 40px !important;
	}
	.button_text_color_input{
		display: block;
		width: 75%;
		float: left;
		height: 40px !important;
		padding-left: 10px;
		border-radius: 2px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}

    .status-column-hidden {
        display: none;
    }

    .status-column-hidden-visible {
        display: table-cell;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if(!isset($_GET['use_this'])){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Gift Card List</a>
                    </li>
					 <li class="" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready to use Gift Card</a>
                    </li>
					<?php if(isset($_GET['use_this']) && $_GET['use_this'] != ""){?>
                    <li class="active" id="tab_2">
                        <a href="#2" data-toggle="tab">Gift Card Setup</a>
                    </li>
					<?php }?>

                </ul><br>
            </div>

            <div class="tab-content">
                <?php if (!empty($store_category)){
                        if($store_category->category == '2'){ ?>
                <form method="get" name="" id="" enctype="multipart/form-data" style="<?php if((isset($_GET['use_this']) && $_GET['use_this'] != "")){?>display:none;<?php }?>">
                    <div class="row cc_row">
                        <div  class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Gender</label>
                            <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                <option value="">Select Gender</option>
                                <option value="0" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0'){?>selected="selected"<?php }?>>Male</option>
                                <option value="1" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1'){?>selected="selected"<?php }?>>Female</option>
                            </select>
                            <div class="error" id="filter_gender_error"></div>
                        </div> 
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                            <?php if(isset($_GET['filter_gender'])){ ?>
                                <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=$this->uri->segment(2);?>">Reset</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                    <input type="hidden" name="filter_gender" id="filter_gender" value="<?=$store_category->category;?>">
                <?php }} ?>
                <div class="tab-pane <?php if(!isset($_GET['use_this'])){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.no</th>
                                                    <th>Gift Name</th>
                                                    <!-- <th>Services</th>  -->
                                                    <th>Purchase Price</th> 
                                                    <th>Gender</th> 
                                                    <!-- <th>Discount</th> -->
                                                    <!-- <th>Worth Price</th>
                                                    <th>Min. Booking Price</th> -->
                                                    <th>Gift Card Code</th>
                                                    <th class="status-column-hidden">Gift Button</th>
                                                    <th>Gift Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                            <?php 
											$added_gift	= array();
											if(!empty($gift_card_list)){
                                                    $i=1;
                                                        foreach($gift_card_list as $gift_card_list_result){
															$added_gift[]=$gift_card_list_result->giftcard_id;
                                                            $service_name=$this->Salon_model->get_selected_service_name_for_offer($gift_card_list_result->service_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$gift_card_list_result->gift_name?></td>
                                                    <!-- <td> -->
                                                        <?php 
                                                            // if(!empty($service_name)) {
                                                            //     $firstService = true;
                                                            //     foreach($service_name as $service_name_result) {
                                                            //         if (!$firstService) {
                                                            //             echo " + ";
                                                            //         }
                                                            //         echo $service_name_result->service_name;
                                                            //         $firstService = false; 
                                                            //     } 
                                                            // }
                                                        ?>
                                                    <!-- </td> -->
                                                    <td><?=$gift_card_list_result->regular_price?></td>
                                                    <td><?php if($gift_card_list_result->gender == 1){ echo 'Female';}else{ echo 'Male';} ?></td>
                                                    <!-- <?php if($gift_card_list_result->discount_in == 0){ ?>
                                                        <td><?=$gift_card_list_result->discount?>%</td>
                                                    <?php }else{ ?>
                                                        <td>Rs.<?=$gift_card_list_result->discount?></td>
                                                    <?php } ?> -->
                                                    <!-- <td><?=$gift_card_list_result->gift_price?></td>
                                                    <td><?=$gift_card_list_result->min_booking_amt != "" ? $gift_card_list_result->min_booking_amt : '-';?></td> -->
                                                    <td><?=$gift_card_list_result->gift_card_code?></td>
                                                    <td class="status-column-hidden">
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                    </td>
                                                    <td>
                                                        <button style="float:left;color:white;background-color:#25D366 !important;border:none;" title="Send Message" type="button" class="btn btn-primary btn-sm whatsapp_Btn" id="send_details_button_<?=$gift_card_list_result->id;?>" onclick="sendOfferMessage('<?=$gift_card_list_result->id;?>')" data-toggle="modal" data-target="#sendMessageModal"><i style="font-size: 15px;padding: 2px;" class="fa fa-whatsapp"></i></button>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$gift_card_list_result->id?>/tbl_gift_card"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-gift-card?use_this=1&edit=<?=$gift_card_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
				<div class="tab-pane" id="3">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="example1" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Gift Name</th>
                                                    <!-- <th>Services</th>  -->
                                                    <th>Purchase Price</th> 
                                                    <th>Gender</th> 
                                                    <!-- <th>Discount</th> -->
                                                    <!-- <th>Worth Price</th>
                                                    <th>Min. Booking Price</th> -->
                                                    <th>Gift Card Code</th>
                                                    <th class="status-column-hidden">Gift Button</th>
                                                    <th>Gift Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <?php if(!empty($ready_gift_card)){
                                                    $i=1;
                                                        foreach($ready_gift_card as $ready_gift_card_result){
                                                            $service_name=$this->Admin_model->get_selected_service_name_for_offer($ready_gift_card_result->service_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$ready_gift_card_result->gift_name?></td>
                                                    <!-- <td> -->
                                                        <?php 
                                                            // if(!empty($service_name)) {
                                                            //     $firstService = true;
                                                            //     foreach($service_name as $service_name_result) {
                                                            //         if (!$firstService) {
                                                            //             echo " + ";
                                                            //         }
                                                            //         echo $service_name_result->service_name;
                                                            //         $firstService = false; 
                                                            //     } 
                                                            // }
                                                        ?>
                                                    <!-- </td> -->
                                                    <td><?=$ready_gift_card_result->regular_price?></td>
                                                    <td><?php if($ready_gift_card_result->gender == 1){ echo 'Female';}else{ echo 'Male';} ?></td>
                                                    <!-- <?php if($ready_gift_card_result->discount_in == 0){ ?>
                                                        <td><?=$ready_gift_card_result->discount?>%</td>
                                                    <?php }else{ ?>
                                                        <td>Rs.<?=$ready_gift_card_result->discount?></td>
                                                    <?php } ?> -->
                                                    <!-- <td><?=$ready_gift_card_result->gift_price?></td>
                                                    <td><?=$ready_gift_card_result->min_booking_amt != "" ? $ready_gift_card_result->min_booking_amt : '-';?></td> -->
                                                    <td><?=$ready_gift_card_result->gift_card_code?></td>
                                                    <td class="status-column-hidden">
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$ready_gift_card_result->bg_color;?>; color:<?=$ready_gift_card_result->text_color;?>"><?=$ready_gift_card_result->gift_name;?></button>

                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$ready_gift_card_result->bg_color;?>; color:<?=$ready_gift_card_result->text_color;?>"><?=$ready_gift_card_result->gift_name;?></button>
                                                    </td>
                                                    <td>
														<?php if(!in_array($ready_gift_card_result->id,$added_gift)){?>
														<a title="Giftcard Setup" class="btn btn-primary" href="<?=base_url()?>add-gift-card?use_this=1&value=<?=$ready_gift_card_result->id?>">Use This Gift Card</a>
														<?php }else{?>
														<a title="Added" class="btn btn-info" href="javascript:void(0)">Offer Used</a> 
														<?php }?> 
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

                <div class="tab-pane <?php if((isset($_GET['use_this']) && $_GET['use_this'] != "") || (isset($_GET['edit']) && $_GET['edit'] != "")){?>active<?php }?>" id="2">
					<?php 
						$giftcard_id = "0";
						$single_setup_offer = array();
						if(!empty($setup_gift)){
							$single_setup_gift = $setup_gift;
							$giftcard_id = $setup_gift->id;
						}else if(!empty($signle_gift)){ 
							$single_setup_gift = $signle_gift;
							$giftcard_id = $signle_gift->giftcard_id;
						}
					?>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="gift_form" id="gift_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_name" id="gift_name" value="<?php if(!empty($single_setup_gift)){ echo $single_setup_gift->gift_name;} ?>" placeholder="Enter gift name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single_setup_gift) && isset($_GET['edit'])) { echo $single_setup_gift->id; } ?>">
                                            <input autocomplete="off" type="hidden" name="giftcard_id" id="giftcard_id" value="<?php echo $giftcard_id;?>">
                                        </div>
                                        <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">										
											   <?php 
												$actual_price = 0;
													$service_exp = [];
													if(!empty($single_setup_gift)){
														$service_exp = explode(",",$single_setup_gift->service_name);
													}
												?>
                                            <label>Select Service <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
                                                <option value="">Select Service </option>
                                                <?php if (!empty($service_title)) { 
													if(!empty($setup_gift)){
														foreach ($service_title as $service_name) {
															if(in_array($service_name->service_id,$service_exp)){
																$actual_price += $service_name->final_price;
															}
												?>
												<option value="<?=$service_name->id?>" <?php if (in_array($service_name->service_id,$service_exp)){?>selected="selected"<?php }?>><?= $service_name->service_name ?></option>
													<?php }
													}else{
														foreach($service_title as $service_name){
															if(in_array($service_name->id,$service_exp)){
																$actual_price += $service_name->final_price;
															}		
													?>
													<option value="<?=$service_name->id?>" <?php if (in_array($service_name->id,$service_exp)){?>selected="selected"<?php }?>><?= $service_name->service_name ?></option>
													<?php }}
                                                } ?>
                                            </select>
                                        </div> -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label> Gender<b class="require">*</b></label>
                                            <input type="hidden" class="form-control" name="gender" id="gender" value="<?php if (!empty($single_setup_gift)) { echo $single_setup_gift->gender;} ?>">
                                            <input type="text" readonly class="form-control" name="gender_name" id="gender_name" value="<?php if(!empty($single_setup_gift)){ if($single_setup_gift->gender == "0"){ echo "Male";}else{ echo "Female";}} ?>"> 
                                        </div>
                                        <?php  
											$final_price = 0;
											if(!empty($single_setup_gift) && $single_setup_gift->discount_in == 0){
												$part = $single_setup_gift->discount;
												$total = $actual_price; 
                                                if($total != '' && $total != '0'){
												    $percentage = ($part / $total) * 100;
                                                }else{
                                                    $percentage = 0;
                                                }
												$final_price = $actual_price-$percentage;
											}else if(!empty($single_setup_gift)){
												$final_price = $actual_price-$single_setup_gift->discount;
											}
										?>                                    
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Purchase Price<b class="require">*</b></label>
                                            <div id="price_div">
                                            <input autocomplete="off" type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single_setup_gift)) { echo $single_setup_gift->regular_price;} ?>" placeholder="Gift Card Purchase Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--   <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Ex. percantage/Flat</option>
                                                    <option value="0" <?php if(!empty($single_setup_gift) && $single_setup_gift->discount_in == 0){ ?>selected="selected"<?php }?>>Percentage</option>
                                                    <option value="1" <?php if(!empty($single_setup_gift) && $single_setup_gift->discount_in == 1){ ?>selected="selected"<?php } ?>>Flat</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="discount" id="discount" value="<?php if(!empty($single_setup_gift)){ echo $single_setup_gift->discount;} ?>" placeholder="Enter discount">
                                            <div class="discount_validation error" style="display: none;"></div> 
                                        </div>  -->
                                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Worth Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_price" id="gift_price" value="<?php if(!empty($single_setup_gift)){ echo $single_setup_gift->gift_price;} ?>" placeholder="Gift Card Worth Price">
                                        </div>    -->
                                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Minimum Booking Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="min_booking_amt" id="min_booking_amt" value="<?php if(!empty($single_setup_gift)){ echo $single_setup_gift->min_booking_amt;} ?>" placeholder="Minimum Booking Price">
                                        </div> -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Code<b class="require">*</b></label>
                                            <div id="price_div">
                                                <input autocomplete="off" type="text" class="form-control" name="gift_card_code" id="gift_card_code" value="<?php if(!empty($single_setup_gift)){ echo $single_setup_gift->gift_card_code;} ?>" placeholder="Enter gift card code">
                                                <div class="gift_card_code_unique error"></div>
                                            </div>                                    
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label for="department_master">Button Background Color <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single_setup_gift)){echo $single_setup_gift->bg_color;}else{ echo '#bada55';} ?>" id="hexcolor">
                                            <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single_setup_gift)){echo $single_setup_gift->bg_color;}else{ echo '#bada55';} ?>"> 
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label for="department_master">Button Text Color <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single_setup_gift)){echo $single_setup_gift->text_color;}else{ echo '#000000';} ?>" id="texthexcolor">
                                            <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single_setup_gift)){echo $single_setup_gift->text_color;}else{ echo '#000000';} ?>"> 
                                        </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            
            </div>
        <?php }?>
    </div>
</div>

</div>
</div>
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMessageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Send Message</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('sendMessageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="sendMessageModalResponse"></div>
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

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Please enter aphanumeric characters!");


    $(document).ready(function() {
        $.validator.addMethod('alphanumeric', function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, 'Please enter only letters and numbers.');
        $('#gift_form').validate({
            ignore: "",
            rules: {
                gift_name: 'required',
                discount: {
                    required: true,
                    number: true,
                },
                gift_card_code: {
                    required: true,
                    alphanumeric: true,
                },
                //  gift_price: {
                //     required: true,
                //     number: true,
                // },
                // "service_name[]":{
                //     required: true,
                // },
                gender: 'required',
                discount_in: 'required',
                bg_color_input: 'required',
                text_color_input: 'required',
                regular_price: 'required',
                // gift_price: 'required',
                // min_booking_amt: 'required',
            },
            messages: {
                gift_name: 'Please enter gift name!',
                bg_color_input: 'Please select gift backgound colour!',
                text_color_input: 'Please select gift colour!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                gift_card_code: {
                    required: "Please enter gift card code!",
                    alphanumeric: "Please enter aphanumeric characters!",
                },
                // gift_price: {
                //     required: "Please enter gift price!",
                //     number: "Only number allowed!",
                // },
                // "service_name[]": 'Please select service name!',
                gender: 'Please select gender!',
                discount_in: 'Please select discount in!',
                regular_price: 'Please enter giftcard card purchase price!',
                // gift_price: 'Please enter gift card worth price',
                // min_booking_amt: 'Please enter minimum booking amount!',               
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


<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
    $("#service_name").change(function() {
     if( $("#service_name").val() !== ""){
         $("#service_name").removeClass('is-invalid'); 
         $(".service_name .error").hide(); 
     }else{
        $(".service_name .error").show(); 
     }
    });
    $("#discount").keyup(function() {
        var discount = parseFloat($("#discount").val());
        var regular_price = parseFloat($('#regular_price').val());

        if(!isNaN(regular_price)){
            if($("#discount_in").val() !== ""){
                if(!isNaN($("#discount").val())){
                    if (discount > regular_price) {
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        // $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        if($('#discount_in').val() == 0){
                            if(100 < discount){
                                $('.discount_validation').show();
                                $('.discount_validation').html("Discount percantage can not be greater than 100!");
                                // $('#gift_price').val(0);
                            }else{
                                $('.discount_validation').hide();
                                var discounted_amount = regular_price - (regular_price * (discount / 100));
                                // $('#gift_price').val(discounted_amount);
                            }
                        }
                        else{
                            var discounted_amount = regular_price - discount;
                            // $('#gift_price').val(discounted_amount);
                        }
                    }
                }
                else{
                    // $('#gift_price').val(0); 
                }
            }
        }
       
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }
        
    });
    $("#discount_in").change(function () {

        var regular_price=$('#regular_price').val(); 
        var discount=$('#discount').val(); 
       
         if(regular_price !== ""){
            if($('#discount').val() <= regular_price){
                if($('#discount_in').val() == 0){
                    if(100 < discount){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount percantage can not be greater than 100!");
                        // $('#gift_price').val(0);
                    }else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - (regular_price * (discount / 100));
                        // $('#gift_price').val(discounted_amount);
                    }
                }
                else{
                    if(discount > regular_price){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        // $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - discount;
                        // $('#gift_price').val(discounted_amount);
                    }
                }
            }
            else{
                $('.discount_validation').show();
                $('.discount_validation').html("Discount can not be greater than regular price!");
                // $('#gift_price').val(0);
            }
        }
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }

        
    });
    $("#service_name").change(function () {

        if($("#service_name").val()==null){
            $('#regular_price').val("0");
            // $('#gift_price').val("0");
        } 
    var total_service_price = parseFloat($('#regular_price').val());
    if (isNaN(total_service_price)) {
        total_service_price = 0; 
    }

    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_service_price_details_ajax",
        data: {
            'service_name_id': $('#service_name').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var tttt=0;
            if (parsedData.length > 0) {
                parsedData.forEach(function(record) {
                    tttt = tttt + parseFloat(record.final_price);
                });
            } 
            $('#regular_price').val(tttt);  

            var regular_price=$('#regular_price').val(); 
            var discount=$('#discount').val(); 
       
         if($('#discount').val() <= regular_price){
            if($('#discount_in').val() == 0){
                if(100 < discount){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount percantage can not be greater than 100!");
                    // $('#gift_price').val(0);
                }else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - (regular_price * (discount / 100));
                    // $('#gift_price').val(discounted_amount);
                }
            }
            else{
                if(discount > regular_price){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than regular price!");
                    // $('#gift_price').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - discount;
                    // $('#gift_price').val(discounted_amount);
                }
            }
        }
        else{
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than regular price!");
            // $('#gift_price').val(0);
        }
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }
        },
    });
});
   
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.gift-setup').addClass('active_cc');
    });
$("#gift_card_code").keyup(function () {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_uinique_gift_code_ajax",
        data:{'gift_card_code':$("#gift_card_code").val(),'id':'<?=$id?>'},
        success: function(data) {
            if(data == "0"){
				$(".gift_card_code_unique").html('');
				$("#submit").show();
			}else{
				$(".gift_card_code_unique").html('This code is already generate!');
				$("#submit").hide();
			}
        },
    });
});
</script>
<script>
    $(document).ready(function(){
        $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-gift-card',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8] 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }
        ], 
    });

    $('#example1').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'use-gift-card',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8] 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }
        ], 
    });
    });
    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#'+id);

        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    } 
    function sendOfferMessage(id){
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_send_giftcard_message_form_ajx",
            method: 'POST',
            data: { id: id },
            success: function(response) {
                $('#sendMessageModalResponse').html(response)
                showPopup('sendMessageModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
</script>
<?php 
// print_r($this->session->userdata('salon_id'));exit;

include('header.php'); ?>
<style type="text/css">

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
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
        <div class="row">


           <div class="dropdown top-btn-btn">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog" aria-hidden="true"></i> Setting
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                    <li ><a class="add_product" href="<?= base_url(); ?>add-product-stock">Add Product Stock</a></li>
                    <li><a class="product_list" href="<?= base_url(); ?>product-stock-list">Product Stock Entries</a></li>
                    <li ><a class="product-barcode" href="<?= base_url(); ?>product-barcode">Product Stock Ledger</a></li>
                    <!-- <li ><a class="product_category" href="<?= base_url(); ?>product-category">Add Product Category</a></li> -->
                    <!-- <li ><a class="product-unit" href="<?= base_url(); ?>product-unit">Add Product Unit</a></li> -->
                </ul>
            </div>


            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="tab-pane <?php if($this->uri->segment(2) == "" && !isset($_GET['use_this'])){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">My Product</a>
                    </li>
                    <li class="tab-pane" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready To use Product</a>
                    </li>
                    <li class="tab-pane <?php if(isset($_GET['use_this'])){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Product</a>
                    </li>
                    <li class="tab-pane" id="tab_4">
                        <a href="#4" data-toggle="tab">Pending Product</a>
                    </li>  
                </ul><br>
            </div>

            <div class="tab-content">


                <div class="tab-pane <?php if($this->uri->segment(2) == "" && !isset($_GET['use_this'])){?>active<?php }?>" id="1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>My Product</h3>
                            </div>
                            <div class="x_content">
                                <?php if(!empty($product_category_list)) {
                                    foreach($product_category_list as $product_category_list_result){ 
                                       ?>
                         
                                        <div class="col-md-2 category_row_box">
                                            <div class="row">
                                                <div class="service-img-box" style="background-image:url(<?=base_url('admin_assets/images/product_category/'.$product_category_list_result->product_photo) ?>)"></div>

                                                <div class="row category_head">
                                                    <a href="<?=base_url();?>product-list/<?=$product_category_list_result->id?>"><h4><?=$product_category_list_result->product_category ?></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="3">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Ready Products</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($product_category_list)) {
                                    foreach ($product_category_list as $product_category_list_result) {
                                       ?> 
                                        <div class="col-md-2 category_row_box">
                                            <div class="row">
                                                <div class="service-img-box" style="background-image:url(<?= base_url()?>admin_assets/images/product_category/<?= $product_category_list_result->product_photo?>)"></div>

                                                <div class="row category_head">
                                                    <a href="<?=base_url();?>use_ready_product_sub_cat/<?=$product_category_list_result->id?>"><h4><?=$product_category_list_result->product_category?></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="tab-pane" id="4">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Pending Products</h3>
                            </div>
                            <div class="x_content">
								<table  id="example" class="table table-striped responsive-utilities jambo_table">
									<thead>
										<tr>
											<th>Sr.no</th>
											<th>Product Name</th>
											<th>Category</th>
											<th>Sub Category</th>
											<!-- <th>Product Unit</th>  -->
											<th>HSN code</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										
									<?php if(!empty($pending_products)){
										$i = 1;
										foreach ($pending_products as $pending_products_result) {
                                            $product_sub_category = $this->Admin_model->get_sub_category_details($pending_products_result->product_subcategory);
										   ?> 
												<tr>
													<td><?=$i++?></td>
													<td><?=$pending_products_result->product_name?></td>
													<td><?=$pending_products_result->productcategory?></td>
                                                    <td><?=!empty($product_sub_category) ? $product_sub_category->product_sub_category : '-'; ?></td>
													<!-- <td><?=$pending_products_result->productunit?></td>  -->
													<td><?=$pending_products_result->hsn_code?></td> 
													<td>
														<!-- <a class="btn btn-info" href="javascript:void(0)">Pending</a> -->
                                                        <?php if($pending_products_result->is_deleted == "0"){?>
                                                            <a title="Waiting for approval via administration"  class="btn btn-danger">Pending</a>  
                                                        <?php }else{?>
                                                            <a title="<?php echo $pending_products_result->reject_reason ?>"  class="btn btn-danger">Rejected</a> 
                                                        <?php }?>
													</td>
												</tr>
										<?php }
										} ?>
									</tbody>
								</table>  
                            </div>
                        </div>
                    </div>
                </div>
            
                
                <div class="tab-pane <?php if(isset($_GET['use_this'])){?>active<?php }?>" id="2">
					<?php 
						$single_product = array();
						$product_id = 0;
                        $product_subcategory = '';
						if(!empty($single_setup)){
							$single_product = $single_setup;
							$product_id = $single_setup->id;
                            $product_subcategory = $single_product->sub_category;
						}else if(!empty($single_product_details)){
							$single_product = $single_product_details;
							$product_id = $single_product_details->product_id;
                            $product_subcategory = $single_product->product_subcategory;
						}
                            // echo "<pre>";print_r($single_product);
					?>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Category <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_category" id="product_category" <?php if(isset($_GET['id']) || isset($_GET['use_this'])){ echo 'disabled';}?>>
                                                <option value="">Select product category</option>
                                                <?php if (!empty($product_category_list)) {
                                                    foreach ($product_category_list as $product_category_list_result) { ?>
                                                        <option value="<?= $product_category_list_result->id ?>" <?php if(!empty($single_product) && $single_product->product_category == $product_category_list_result->id) { ?>selected="selected" <?php } ?>><?=$product_category_list_result->product_category ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <div class="error" id="product_category_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single_product) && isset($_GET['edit'])) { echo $single_product->id;} ?>">
                                            <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?=$product_id?>">
                                            <input type="hidden" class="form-control" name="selected_product_category" id="selected_product_category" value="<?php if(!empty($single_product) && (isset($_GET['id']) || isset($_GET['use_this']))){ echo $single_product->product_category;}?>">
                                            <input type="hidden" class="form-control" name="selected_product_sub_category" id="selected_product_sub_category" value="<?php if(!empty($single_product) && (isset($_GET['id']) || isset($_GET['use_this']))){ echo $product_subcategory;}?>">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Sub-Category <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_sub_category" id="product_sub_category" <?php if(isset($_GET['id']) || isset($_GET['use_this'])){ echo 'disabled';}?>>
                                                <option value="">Select product sub category</option>
                                                <?php 
                                                if(!empty($single_product)){
                                                    $subcategory = $this->Admin_model->get_product_category_sub_categories($single_product->product_category);
                                                    if (!empty($subcategory)) {
                                                        foreach ($subcategory as $category_result) { ?>
                                                        <option value="<?=$category_result->id?>" <?php if (!empty($single_product) && $product_subcategory == $category_result->id) { ?>selected="selected" <?php } ?>><?=$category_result->product_sub_category?></option>
                                                <?php }}
                                                } ?>
                                            </select>
                                            <div class="error" id="product_category_error"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Name <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if (!empty($single_product)) {echo $single_product->product_name;} ?>" placeholder="Enter product name" <?php if(isset($_GET['id']) || isset($_GET['use_this'])){ echo 'readonly';}?>>
                                            <div class="error" id="product_name_error"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Image<b class="require">*</b>
                                            <?php 
                                                if (!empty($single_product) && $single_product->product_photo != "") {
                                                    $images = explode(',',$single_product->product_photo);
                                                    for($i=0;$i<count($images);$i++){
                                            ?>
                                              <a style="color: blue;float: right; text-decoration:underline;margin-left: 8px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_image/<?php if ($images[$i] != "") { echo $images[$i]; } ?>" class="view_image">View</a>
                                            <?php }} ?>  
                                            </label>
                                            <input accept=".jpeg,.jpg,.png" type="file" class="form-control" name="product_photo[]" id="product_photo" multiple>
                                            <input type="hidden" class="form-control" name="old_product_photo" id="old_product_photo"  value="<?php if (!empty($single_product)) {echo $single_product->product_photo;} ?>">
                                            
                                        </div>
									</div>
									<div class="row">
                                        <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Unit<b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_unit" id="product_unit">
                                                <option value="">Select product unit</option>
                                                <?php if(!empty($product_unit_list)){
                                                    foreach($product_unit_list as $product_unit_list_result){ ?>
                                                        <option value="<?=$product_unit_list_result->id?>" <?php if(!empty($single_product) && $single_product->product_unit == $product_unit_list_result->id) echo 'selected="selected"'; ?>><?= $product_unit_list_result->product_unit ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div> -->
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>High stock <b class="require">*</b></label>
                                            <input type="text" class="form-control low_stock" name="high_stock" id="high_stock" value="<?php if (!empty($single_product)) {echo $single_product->high_stock;} ?>" placeholder="Enter high stock">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Low Stock <b class="require">*</b></label>
                                            <input type="text" class="form-control low_stock" name="low_stock" id="low_stock" value="<?php if (!empty($single_product)) { echo $single_product->low_stock; } ?>" placeholder="Enter low stock">
                                            <div class="error" id="low_stock_error"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>HSN Code </label>
                                            <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?php if (!empty($single_product)) { echo $single_product->hsn_code;} ?>" placeholder="Enter hsn code">
                                            <div class="error" id="hsn_code_error"></div>
                                        </div>
									</div>
									<div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Does dates required?<b class="require">*</b> <small>(In Product Inward)</small></label>
                                            <select class="form-select form-control" name="date_require" id="date_require">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php if(!empty($single_product) && $single_product->date_require == 1) echo 'selected="selected"'; ?>>Require</option>
                                                <option value="0" <?php if(!empty($single_product) && $single_product->date_require == 0) echo 'selected="selected"'; ?>>Not Require</option>
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group m_date">
                                            <label>Manufacturing Date</label>
                                            <input readonly type="text" class="form-control" name="mfg_date" id="mfg_date" value="<?php if (!empty($single_product)) { echo $single_product->mfg_date; } ?>" placeholder="DD-MM-YYYY">
                                        </div> -->
									</div>
									<div class="row">
                                        <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group e_date">
                                            <label>Expiry Date</label>
                                            <input readonly type="text" class="form-control" name="expiry_date" id="expiry_date" value="<?php if (!empty($single_product)) {echo $single_product->expiry_date; } ?>" placeholder="DD-MM-YYYY">
                                        </div> -->


                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount in <b class="require">*</b></label>
                                            <select class="form-select form-control" name="discount_in" id="discount_in">
                                                <!-- <option value="">Select Option</option> -->
                                                <option value="1" <?php if(!empty($single_product) && $single_product->discount_in == '1') echo 'selected="selected"'; ?>>Flat</option>
                                                <option value="0" <?php if(!empty($single_product) && $single_product->discount_in == '0') echo 'selected="selected"'; ?>>Percentage</option>
                                                <option value="2" <?php if(!empty($single_product) && $single_product->discount_in == '2') echo 'selected="selected"'; ?>>None</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount
                                                <b class="require">*</b>
                                            </label>                                     
                                            <input type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single_product)) {echo $single_product->discount;} ?>" placeholder="Enter product discount">                                                                                       
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Stylist Incentive<b class="require">*</b> <small>(In INR & Per Product Unit Sale)</small></label>
                                            <input type="text" class="form-control" name="incentive" id="incentive" value="<?php if (!empty($single_product)) { echo $single_product->incentive;} ?>" placeholder="Enter incentive">
                                        </div>
									</div>
									<div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Product Price <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="selling_price" id="selling_price" value="<?php if (!empty($single_product)) {echo $single_product->selling_price; } ?>" placeholder="Enter product price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group" style="z-index: 999999999999;">
                                            <label>Product Description<b class="require">*</b></label>
                                            <textarea type="text" class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single_product)) { echo $single_product->description;} ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Active/Deactive Low Stock Alert<b class="require">*</b></label>
                                            <div>
                                            <i id="low_stock_off" class="fa-solid fa-toggle-off fffftttt" <?= (!empty($single_product) && $single_product->low_stock_alert == 1) ? 'style="display:none;"' : ''; ?>></i>
                                            <?php if (!empty($single_product) && $single_product->low_stock_alert == 1) : ?>
                                                <i id="low_stock_on_1" class="fa-solid fa-toggle-on fffftttt"></i>
                                            <?php endif; ?>
                                                <i style="display: none;" id="low_stock_on" class="fa-solid fa-toggle-on fffftttt"></i>
                                                <input class="form-control" type="hidden" name="low_stock_alert" id="low_stock_alert" value="<?php if (!empty($single_product)) { echo $single_product->low_stock_alert; } ?>">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12" style="margin-top: 28px;">
                                            <input type="checkbox" name="online_store" id="online_store" value="1" <?php if (!empty($single_product) && $single_product->online_store == 1) echo 'checked'; ?>>
                                            <label>Product Show in Online Store</label>
                                        </div>
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <pre></pre>
                                        <button type="submit" id="submit" name="add_product_submit" value="add_product_submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
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
<script>
    $("#hsn_code").keyup(function(){
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_hsn_code",
		data:{'hsn_code':$("#hsn_code").val(),'id':'<?=$id?>'},
		success: function(data){
            
			if(data == "0"){
				$("#hsn_code_error").html('');
				$("#submit").show();
			}else{
				$("#hsn_code_error").html('This hsn code is already added for another product');
				$("#submit").hide();
			}
		},
		});	
	});	 

</script>
<script>

    $("#product_name").keyup(function(){
        // alert();
        $.ajax({
            type:"POST",
            url:"<?=base_url();?>salon/Ajax_controller/get_unique_product_name",
            data:{
                'product_category':$("#product_category").val(),

                'product_name':$("#product_name").val(),
                'id':'<?=$id?>'
            },
            success:function(data){
              console.log(data);
                if(data == "0"){
                    $('#product_name_error').html('');
                    $("#submit").show();
                }else{
                    $('#product_name_error').html('This product category and product name is already added');
                    $("#submit").hide();
                }
            },
        });
    });


</script>

<script>
    $("#mfg_date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true, 
        minDate: "-80Y",
    });
    $("#expiry_date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        
        minDate: "-80Y", 
    });
</script>

<script>    
//  function reuire_notrequire() {
// //    alert($("#date_require").val());
//     if($("#date_require").val() == 0){
//         $('.e_date').hide();
//         $('.m_date').hide();
//         // $('#mfg_date').prop('placeholder', '');
//     }else{
//         $('.e_date').show();
//         $('.m_date').show();
//         // $('#mfg_date').prop('placeholder', 'DD-MM-YYYY');
//     }
//  }
  $(document).ready(function() {
    $.validator.addMethod("positiveNumber", function(value, element) {
        // Check if the value is a positive number greater than 0
        return this.optional(element) || /^[1-9]\d*$/.test(value);
    }, "Please enter a positive number greater than 0."); 
    $.validator.addMethod("nonNegativeInteger", function(value, element) {
        // Check if the value is a non-negative integer (0 or positive number)
        return this.optional(element) || /^([0-9]|[1-9][0-9]*)$/.test(value);
    }, "Please enter a non-negative integer (0 or positive number).");
        $('#master_form').validate({
            ignore: [],
            rules: {
                product_category: 'required',
                product_sub_category: 'required',
                product_name: 'required',
                low_stock: {
                    required: true,
                    number: true,
                    min: 0,
                    nonNegativeInteger: true
                },
                high_stock: {
                    required: true,
                    number: true,
                    min: 0,
                    nonNegativeInteger: true
                },
                // hsn_code: 'required',
                <?php if (empty($single_product)) {?>
                    'product_photo[]': 'required', 
                <?php }?>
                description: 'required',
                // product_unit: 'required',
                date_require: 'required',
                discount: {
                    required: true,
                    number: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                },
                discount_in: {
                    required: true,
                },
              
                incentive: {
                    required: true,
                    number: true,
                    min: 0,
                },
                selling_price: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                product_category: "Please select product category!",
                product_sub_category: 'Please select product sub category!',
                product_name: "Please enter product name!",
				<?php if (empty($single_product)) {?>
                'product_photo[]': 'Please upload product photo', 
				<?php }?>
                description: "Please enter description!",
               //  product_unit: "Please select product unit!",
                date_require: "Please Select option!",
                low_stock: {
                    required: "Please enter low stock!",
                    number: "Only number allowed!",
                    min: "Please enter valid number!",
                    nonNegativeInteger: "Please enter valid number!",
                },
                high_stock: {
                    required: "Please enter high stock!",
                    number: "Only number allowed!",
                    min: "Please enter valid number!",
                    nonNegativeInteger: "Please enter valid number!",
                },
                selling_price: {
                    required: "Please enter product price!",
                    number: "Only number allowed!",
                },
                // hsn_code: "Please enter hsn code!",
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                discount_in: {
                    required: "Please select option!",
                },
                
                incentive: {
                    required: "Please enter incentive!",
                    number: "Only number allowed!",
                    min: "Minimum 0 amount allowed!",
                },

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
    // $("#hsn_code").change(function() {
    //     var product_data = <?php echo json_encode($product_master_list) ?>;
    //     var product_length = product_data.length;

    //     for (var i = 0; i < product_length; i++) {
    //         if ($("#hsn_code").val() === product_data[i].hsn_code) {
    //             $("#hsn_code_error").html('This hsn code is already added!');
    //         } else {
    //             $("#hsn_code_error").html('');
    //         }
    //     }

    // });
    $(".low_stock").keyup(function() {
        var high_stock = $("#high_stock").val()
        var low_stock = $("#low_stock").val()

        if (parseFloat(low_stock) >= parseFloat(high_stock)) {
            $("#low_stock_error").html('Low stock cannot be greater than or equal to high stock!');
        } else {
            $("#low_stock_error").html('');
        }
    }); 
    $(document).ready(function () {
        $("#low_stock_off").click(function() {
            alert("Are you sure to activate low stock alert?");
            $("#low_stock_alert").val(1);
            $("#low_stock_off").hide();
            $("#low_stock_on").show();
        });

        $("#low_stock_on").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
        });
        $("#low_stock_on_1").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
            $("#low_stock_on_1").hide();
        });
    }); 
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-setup').addClass('active_cc');
    }); 
    $('#example').DataTable({ 
        dom: 'Bfrtip',
        responsive: false,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-product',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7] 
                }
            }
        ], 
    });
</script>



<script>
$(document).ready(function() {
    function toggleDateFields() {
        var dateRequire = $('#date_require').val();
        if (dateRequire == '1') {
            $('.m_date, .e_date').show();
        } else {
            $('.m_date, .e_date').hide();
        }
    }

    toggleDateFields();

    $('#date_require').change(function() {
        toggleDateFields();
    });
});
        $('#product_category').change(function() {            
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/Ajax_controller/get_product_category_sub_categories_ajax",
                data:{'product_category':$("#product_category").val()},
                success: function(data){
                    console.log(data)
                    $("#product_sub_category").empty();
                    $('#product_sub_category').append('<option value="">Select Product Sub Category</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#product_sub_category').append('<option value="' + d.id + '">' + d.product_sub_category + '</option>');
                    });
                    $('#product_sub_category').trigger('change');
                    $('#product_sub_category').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
</script>

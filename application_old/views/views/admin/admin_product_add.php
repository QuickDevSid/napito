<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Product
					<a href="<?=base_url();?>admin_product_list" class="btn btn-primary pull-right">Go to List</a>
                </h3>
            </div>

           <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                                <form method="post" name="product_form" id="product_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Category <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_category" id="product_category">
                                                <option value="">Select product category</option>
                                                <?php if (!empty($category)) {
                                                    foreach ($category as $category_result) { ?>
                                                        <option value="<?=$category_result->id?>" <?php if (!empty($single) && $single->product_category == $category_result->id) { ?>selected="selected" <?php } ?>><?=$category_result->product_category?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <div class="error" id="product_category_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id;} ?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Sub-Category <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_sub_category" id="product_sub_category">
                                                <option value="">Select Product Sub Category</option>
                                                <?php 
                                                if(!empty($single)){
                                                    $subcategory = $this->Admin_model->get_product_category_sub_categories($single->product_category);
                                                    if (!empty($subcategory)) {
                                                        foreach ($subcategory as $category_result) { ?>
                                                        <option value="<?=$category_result->id?>" <?php if (!empty($single) && $single->sub_category == $category_result->id) { ?>selected="selected" <?php } ?>><?=$category_result->product_sub_category?></option>
                                                <?php }}
                                                } ?>
                                            </select>
                                            <div class="error" id="product_category_error"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Name <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if (!empty($single)) {echo $single->product_name;} ?>" placeholder="Enter product name">
                                        </div>
                                    <!-- </div> 
                                    <div class="row"> -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Image</label>
                                            <input type="file" class="form-control" name="product_photo" id="product_photo"  value="<?php if (!empty($single)) {echo $single->product_photo;} ?>">
                                            <input type="hidden" class="form-control" name="old_product_photo" id="old_product_photo"  value="<?php if (!empty($single)) {echo $single->product_photo;} ?>">
                                            <?php if (!empty($single)) {?>
                                              <a style="color: blue;float: right;margin-top: -63px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_image/<?php if (!empty($single)) {echo $single->product_photo;} ?>" class="view_image">View</a>
                                            <?php } ?>  
                                        </div>
                                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Unit<b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_unit" id="product_unit">
                                                <option value="">Select product unit</option>
                                                <?php if (!empty($unit)) {
                                                    foreach ($unit as $unit_result) { ?>
                                                        <option value="<?= $unit_result->id ?>" <?php if (!empty($single) && $single->product_unit == $unit_result->id) echo 'selected="selected"'; ?>><?=$unit_result->product_unit?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div> -->
                                         
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>HSN Code</label>
                                            <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?php if (!empty($single)) { echo $single->hsn_code;} ?>" placeholder="Enter hsn code">
                                            <div class="error" id="hsn_code_error"></div>
                                        </div>
                                    <!-- </div> 
                                    <div class="row"> -->
                                        <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label>Discount In<small></small><b class="require">*</b></label>
											<select name="discount_in" id="discount_in" class="form-control">
												<option value="" >Ex. Percentage/Flat</option>
												<option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
												<option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
											</select>
										</div> 
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount<b class="require">*</b></label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {echo $single->discount;} ?>" placeholder="Enter product discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Incentive<b class="require">*</b></label>
                                            <input type="text" class="form-control" name="incentive" id="incentive" value="<?php if (!empty($single)) { echo $single->incentive;} ?>" placeholder="Enter incentive">
                                        </div> -->
                                    <!-- </div> 
                                    <div class="row"> -->
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Product Selling Price <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="selling_price" id="selling_price" value="<?php if (!empty($single)) {echo $single->selling_price; } ?>" placeholder="Enter product selling price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Description<b class="require"></b></label>
                                            <textarea type="text" class="form-control" style="resize:none;" name="description" id="description" value="<?php if (!empty($single)) { echo $single->description;} ?>" placeholder="Enter description"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
                                        </div> 
                                    </div> 
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
$(document).ready(function() {
	$(".chosen-select").chosen({
		 
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
$("#hsn_code").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_hsn_code",
		data:{'hsn_code':$("#hsn_code").val(),'id':'<?=$id?>'},
		success: function(data){
            // console.log(data);
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
$(document).ready(function() {
	$('#product_form').validate({
		// ignore: '',
        ignore: ":hidden:not(select)",
		rules: {
			product_category: 'required',
			product_sub_category: 'required',
			product_name: 'required',
			// hsn_code: 'required',
			<?php if (empty($single)) {?>
				product_photo: 'required', 
			<?php }?>
			selling_price:  {
				required: true,
				number: true,
			},
			// product_unit: 'required',
			discount_in: 'required',
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
		  
			incentive: {
				required: true,
				number: true,
			}, 
		},
		messages: {
			product_category: "Please select product category!",
			product_sub_category: "Please select product sub category!",
			product_name: "Please enter product name!",
			// hsn_code: "Please enter hsn code!",
			product_photo: 'Please upload product image!', 
			selling_price: {
				required:  "Please enter selling price!",
				number: "Only number allowed!",
			},
			// product_unit: "Please select product unit!",
			discount_in: "Please select discount in!",
			discount: {
				required: "Please enter discount!",
				number: "Only number allowed!",
			}, 
			incentive: {
				required: "Please enter incentive!",
				number: "Only number allowed!",
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

$('#product_category').on('change', function() {
    $('#product_category').valid();
});

$('#product_unit').on('change', function() {
    $('#product_unit').valid();
});
</script>

<script>
    $('#product_photo').on('change', function() {
        // alert();
          var fileName = $(this).val();
          var extension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
          //alert(fileName);
          var allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
          if ($.inArray(extension, allowedExtensions) === -1) {
              alert('Only .png, .jpg, .jpeg, .pdf files are allowed.');
              // Clear the file input field
              $(this).val('');
          }
        });
</script>
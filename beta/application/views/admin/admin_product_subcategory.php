<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Product Sub-Category
					<a href="<?=base_url();?>admin_product_subcategory_list" class="btn btn-primary pull-right">Go to List</a>
                </h3>
            </div>

        <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
    </div>
    <!-- <div class="clearfix"></div> -->

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="product_form" id="product_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="error" id="product_category_error"></div>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                        echo $single->id;
                                                                                                    } ?>">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Product Category <b class="require">*</b></label>
                                    <select type="text" class="form-control chosen-select" name="product_category" id="product_category">
                                        <option value="">Select Product Category</option>
                                        <?php
                                        if (!empty($category)) {
                                            foreach ($category as $category_result) {
                                        ?>
                                                <option value="<?= $category_result->id; ?>" <?php if (!empty($single) && $category_result->id == $single->product_category) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $category_result->product_category . '|' . $category_result->product_category_marathi; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Product Sub-Category <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="product_sub_category" id="product_sub_category" value="<?php if (!empty($single)) {
                                                                                                                                                echo $single->product_sub_category;
                                                                                                                                            } ?>" placeholder="Enter product sub category">
                                    <div id="hsn_code_error" class="error"></div>
                                </div>
                            </div>
                            <pre></pre>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
$("#product_sub_category").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_product_subcategory",
		data:{'product_sub_category':$("#product_sub_category").val(),'id':'<?=$id?>'},
		success: function(data){
			if(data == "0"){
				$("#hsn_code_error").html('');
				$("#submit").show();
			}else{
				$("#hsn_code_error").html('This sub category is already added');
				$("#submit").hide();
			}
		},
		});	
	});	 
$(document).ready(function() {
	$('#product_form').validate({
		ignore: '',
		rules: {
			product_category: 'required',
			product_sub_category: 'required',
		},
		messages: {
			product_category: "Please select product category!",
			product_sub_category: "Please enter product sub category!",
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
<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }
    .divTimeSetterContainer {
        margin: 5px;
        float: left;
        position: absolute;
        left: 385px;
    }
    .tox.tox-tinymce{
        height:350px !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Update Pending Product <?=!empty($single_product) ? '<small>for ' . $single_product->branch_name . ', ' . $single_product->salon_name . '</small>' : '-'; ?></h3>
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
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Product Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="product_category" id="product_category">
                                            <option value="">Select product category</option>
                                            <?php if (!empty($product_category_list)) {
                                                foreach ($product_category_list as $product_category_list_result) { ?>
                                                    <option value="<?= $product_category_list_result->id ?>" <?php if(!empty($single_product) && $single_product->product_category == $product_category_list_result->id) { ?>selected="selected" <?php } ?>><?=$product_category_list_result->product_category ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="error" id="product_category_error"></div>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single_product)) { echo $single_product->id;} ?>">
                                        <input type="hidden" class="form-control" name="selected_product_category" id="selected_product_category" value="<?php if(!empty($single_product)){ echo $single_product->product_category;}?>">
                                        <input type="hidden" class="form-control" name="selected_product_sub_category" id="selected_product_sub_category" value="<?php if(!empty($single_product)){ echo $single_product->product_subcategory;}?>">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Product Sub-Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="product_sub_category" id="product_sub_category">
                                            <option value="">Select product sub category</option>
                                            <?php 
                                            if(!empty($single_product)){
                                                $subcategory = $this->Admin_model->get_product_category_sub_categories($single_product->product_category);
                                                if (!empty($subcategory)) {
                                                    foreach ($subcategory as $category_result) { ?>
                                                    <option value="<?=$category_result->id?>" <?php if (!empty($single_product) && $single_product->product_subcategory == $category_result->id) { ?>selected="selected" <?php } ?>><?=$category_result->product_sub_category?></option>
                                            <?php }}
                                            } ?>
                                        </select>
                                        <div class="error" id="product_category_error"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Product Name <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if (!empty($single_product)) {echo $single_product->product_name;} ?>" placeholder="Enter product name">
                                        <div class="error" id="product_name_error"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
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
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>HSN Code </label>
                                        <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?php if (!empty($single_product)) { echo $single_product->hsn_code;} ?>" placeholder="Enter hsn code">
                                        <div class="error" id="hsn_code_error"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Does dates required?<b class="require">*</b> <small>(In Product Inward)</small></label>
                                        <select class="form-select form-control chosen-select" name="date_require" id="date_require">
                                            <option value="">Select Option</option>
                                            <option value="1" <?php if(!empty($single_product) && $single_product->date_require == 1) echo 'selected="selected"'; ?>>Require</option>
                                            <option value="0" <?php if(!empty($single_product) && $single_product->date_require == 0) echo 'selected="selected"'; ?>>Not Require</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Product Discount in <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="discount_in" id="discount_in">
                                            <option value="1" <?php if(!empty($single_product) && $single_product->discount_in == '1') echo 'selected="selected"'; ?>>Flat</option>
                                            <option value="0" <?php if(!empty($single_product) && $single_product->discount_in == '0') echo 'selected="selected"'; ?>>Percentage</option>
                                            <option value="2" <?php if(!empty($single_product) && $single_product->discount_in == '2') echo 'selected="selected"'; ?>>None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Product Discount
                                            <b class="require">*</b>
                                        </label>                                     
                                        <input type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single_product)) {echo $single_product->discount;} ?>" placeholder="Enter product discount">                                                                                       
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Stylist Incentive<b class="require">*</b> <small>(In INR & Per Product Unit Sale)</small></label>
                                        <input type="text" class="form-control" name="incentive" id="incentive" value="<?php if (!empty($single_product)) { echo $single_product->incentive;} ?>" placeholder="Enter incentive">
                                    </div> -->
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Product Price <b class="require">*</b></label>
                                        <input class="form-control" type="text" name="selling_price" id="selling_price" value="<?php if (!empty($single_product)) {echo $single_product->selling_price; } ?>" placeholder="Enter product price">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="">
                                        <label>Product Description<b class="require">*</b></label>
                                        <textarea type="text" class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single_product)) { echo $single_product->description;} ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>High stock <b class="require">*</b></label>
                                        <input type="text" class="form-control low_stock" name="high_stock" id="high_stock" value="<?php if (!empty($single_product)) {echo $single_product->high_stock;} ?>" placeholder="Enter high stock">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Low Stock <?php if (!empty($single_product)){ if($single_product->low_stock_alert == 1){ echo '<b class="stock_require require">*</b>'; }else{ echo '<b class="stock_require"></b>'; }}else{ echo '<b class="stock_require"></b>'; } ?></label>
                                        <input type="text" class="form-control low_stock" <?php if (!empty($single_product)){ if($single_product->low_stock_alert == 1){ echo ''; }else{ echo 'readonly'; }}else{ echo 'readonly'; } ?> name="low_stock" id="low_stock" value="<?php if (!empty($single_product)) { echo $single_product->low_stock; } ?>" placeholder="Enter low stock">
                                        <div class="error" id="low_stock_error"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12" style="margin-top: 28px;">
                                        <input type="checkbox" name="online_store" id="online_store" value="1" <?php if (!empty($single_product) && $single_product->online_store == 1) echo 'checked'; ?>>
                                        <label>Product Show in Online Store</label>
                                    </div>
                                </div>    
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">                                    
                                    <button style="margin-left: -10px;" type="submit" id="submit" name="add_product_submit" value="add_product_submit" class="btn btn-primary">Submit</button>
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
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>
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

    $("#product_name").keyup(function(){
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
    $(document).ready(function() {
        $(".form-select").chosen();
        $.validator.addMethod("positiveNumber", function(value, element) {
            return this.optional(element) || /^[1-9]\d*$/.test(value);
        }, "Please enter a positive number greater than 0."); 
        $.validator.addMethod("nonNegativeInteger", function(value, element) {
            return this.optional(element) || /^([0-9]|[1-9][0-9]*)$/.test(value);
        }, "Please enter a non-negative integer (0 or positive number).");
        $('#master_form').validate({
            ignore: [],
            rules: {
                product_category: 'required',
                product_sub_category: 'required',
                product_name: 'required',
                low_stock: {
                    required: function () {
                        return $("#low_stock_alert").val() == "1";
                    },
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
                <?php if (empty($single_product)) {?>
                    'product_photo[]': 'required', 
                <?php }?>
                description: 'required',
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
        
        $("#low_stock_off").click(function() {
            alert("Are you sure to activate low stock alert?");
            $('.stock_require').addClass('require').text('*');
            $("#high_stock").attr('readonly',false);
            $("#low_stock").attr('readonly',false);
            $("#low_stock_alert").val(1);
            $("#low_stock_off").hide();
            $("#low_stock_on").show();
        });

        $("#low_stock_on").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $('.stock_require').removeClass('require').text('');
            $("#high_stock").attr('readonly',false);
            $("#low_stock").attr('readonly',true).val('');
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
        });
        $("#low_stock_on_1").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $('.stock_require').removeClass('require').text('');
            $("#high_stock").attr('readonly',false);
            $("#low_stock").attr('readonly',true).val('');
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
            $("#low_stock_on_1").hide();
        });
    }); 
    $(".low_stock").keyup(function() {
        var high_stock = $("#high_stock").val()
        var low_stock = $("#low_stock").val()

        if (parseFloat(low_stock) >= parseFloat(high_stock)) {
            $("#low_stock_error").html('Low stock cannot be greater than or equal to high stock!');
        } else {
            $("#low_stock_error").html('');
        }
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
                    if(d.id == $('#selected_product_sub_category').val()){
                        $('#product_sub_category').append('<option selected value="' + d.id + '">' + d.product_sub_category + '</option>');
                    }else{
                        $('#product_sub_category').append('<option value="' + d.id + '">' + d.product_sub_category + '</option>');
                    }
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
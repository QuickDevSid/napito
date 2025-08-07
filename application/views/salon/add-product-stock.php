<?php include('header.php'); ?>
<style type="text/css">
    .form-control-option {
        height: 35px;
        width: 590px;
        float: left;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Product Stock
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_panel">
            <div class="x_content">
                <div class="container">
                    <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                        <div class="row flex_wrap">
                            <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Inward ID <b class="require">*</b></label>
                                <input autocomplete="off" class="form-control" type="text" name="barcode_id" id="barcode_id" placeholder="Enter Inward ID">
                                <label id="barcode_id_error" class="error" style="display:none;"></lable>
                            </div> -->
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Product Name <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="product_name" id="product_name" onchange="setProductSelection()">
                                    <option value="">Select Product Name</option>
                                    <?php if (!empty($product_master_list)) {
                                        foreach ($product_master_list as $product_master_list_result) { ?>
                                            <option value="<?= $product_master_list_result->id ?>" <?php if (!empty($single) && $single->product_name == $product_master_list_result->id) { ?>selected="selected" <?php }else{ if(isset($_GET['product']) && $_GET['product'] == $product_master_list_result->id){ echo 'selected'; }} ?>><?= $product_master_list_result->product_category_name ?> -> <?= $product_master_list_result->product_sub_category_name ?> -> <?= $product_master_list_result->product_name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Product Category</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_category_id" id="product_category_id" value="<?php if (!empty($single)) { echo $single->productcategory;} ?>" placeholder="Product category">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_category" id="product_category" value="<?php if (!empty($single)) { echo $single->product_category;} ?>">
                            </div>
                        <!-- </div> -->
                        <input type="hidden" name="date_require" id="date_require" value="0">
                        <!-- <div class="row"> -->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Product Sub Category</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_sub_category_id" id="product_sub_category_id" value="<?php if (!empty($single)) { echo $single->product_subcategory;} ?>" placeholder="Product sub category">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_subcategory" id="product_subcategory" value="<?php if (!empty($single)) { echo $single->product_subcategory;} ?>">
                            </div>
                            <!-- <div class="form-group col-md-2 col-sm-6 col-xs-12">
                                <label>Product Unit</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_unit_id" id="product_unit_id" value="<?php if (!empty($single)) {echo $single->productunit;} ?>" placeholder="Product unit">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_unit" id="product_unit" value="<?php if (!empty($single)) { echo $single->product_unit;} ?>">
                            </div> -->
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;" id="mfg_date_div">
                                <label>Manufacturing Date </label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="mfg_date" id="mfg_date" value="<?php if (!empty($single) && $single->mfg_date != "") {echo date('d-m-Y',strtotime($single->mfg_date)); } ?>" placeholder="Select Manufacturing Date">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;" id="exp_date_div">
                                <label>Expiry Date <b class="require">*</b></label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="exp_date" id="exp_date" value="<?php if (!empty($single) && $single->exp_date != "") {echo date('d-m-Y',strtotime($single->exp_date)); } ?>" placeholder="Select Expiry Date">
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Product opening Stock <b class="require">*</b></label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="opening_stock" id="opening_stock" value="<?php if (!empty($single)) {echo $single->opening_stock;} ?>" placeholder="Enter product opening stock">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Quantity<b class="require">*</b></label>
                                <input autocomplete="off" class="form-control" type="text" name="quantity" id="quantity" value="<?php if (!empty($single)) {echo $single->quantity; } ?>" placeholder="Enter product quantity">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Product Closing Stock <b class="require">*</b></label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="closing_stock" id="closing_stock" value="<?php if (!empty($single)) {echo $single->closing_stock; } ?>" placeholder="Enter product closing stock">
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Product Purchase Price <small>(Per Unit)</small></label>
                                <input autocomplete="off" class="form-control" type="text" name="purchase_price" id="purchase_price" value="<?php if (!empty($single)) {echo $single->purchase_price; } ?>" placeholder="Enter product purchase price">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Supplier</label>
                                <select class="form-select form-control chosen-select" name="supplier" id="supplier">
                                    <option value="">Select Supplier</option>
                                    <?php if (!empty($supplier_list)) {
                                        foreach ($supplier_list as $product_master_list_result) { ?>
                                            <option value="<?= $product_master_list_result->id ?>" <?php if (!empty($single) && $single->supplier == $product_master_list_result->id) { ?>selected="selected" <?php } ?>><?= $product_master_list_result->name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <span for="supplier" generated="true" style="display:none;" class="error invalid-feedback">Please select product name!</span>
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " style="margin-top: 10px;margin-left:-10px;">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
        $('#barcode_id').on('input', function() {
            var $input = $(this);
            var uppercaseValue = $input.val().toUpperCase();
            $input.val(uppercaseValue);
        });
        $.validator.addMethod('alphanumeric', function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, 'Please enter only letters and numbers.');
        $('#employee_form').validate({
            ignore: [],
            rules: {
                barcode_id: {
                    required: true,
                    alphanumeric: true
                },
                supplier: {
                    required: false,
                    alphanumeric: true
                },
                product_name: 'required',
                product_category: 'required',
              
                product_unit_id: {
                    required: true,
                },
                discount: {
                    required: true,
                    number: true,
                },
                opening_stock: {
                    required: true,
                    number: true,
                },
                closing_stock: {
                    required: true,
                    number: true,
                },
               
                purchase_price: {
                    required: false,
                    number: true,
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 1,
                },
                exp_date: {
                    required: function(element) {
                        return $('#date_require').val() == '1';
                    }
                },
                mfg_date: {
                    // required: function(element) {
                    //     return $('#date_require').val() == '1';
                    // }
                    required: false
                },
            },
            messages: {
                barcode_id: {
                    required: "Please enter unique Inward ID!",
                    alphanumeric: "Inward ID must be alphanumeric"
                },
                supplier: "Please select supplier!",
                product_name: "Please select product name!",
                product_category: "Please enter product category !",
                product_unit_id: {
                    required: "Please enter product unit !",
                },
                opening_stock: {
                    required: "Please enter product opening stock!",
                    number: "Only number allowed!",
                },
                quantity: {
                    required: "Please enter product quantity!",
                    number: "Only number allowed!",
                    min: "Minimum 1 quantity required!",
                },
                closing_stock: {
                    required: "Please enter product closing stock!",
                    number: "Only number allowed!",
                },
                purchase_price: {
                    required: "Please enter product purchase price !",
                    number: "Only number allowed!",
                },
                exp_date: {
                    required: "Please select expiry date !",
                },
                mfg_date: {
                    required: "Please select manufacturing date !",
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
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({             
        });

        $("#mfg_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: 0,
        });

        $("#exp_date").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: '+1d',
        });

        setProductSelection();
    });
</script>
<script>
    $("#barcode_id").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_barcode_id",
		data:{'barcode_id':$("#barcode_id").val()},
		success: function(data){
			if(data == "0"){
				$("#barcode_id_error").html('').hide();
				$("#submit").show();
			}else{
				$("#barcode_id_error").html('This Inward ID is already added for another inward').show();
				$("#submit").hide();
			}
		},
		});	
	});	 
    function setProductSelection(){
        if($("#product_name").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_product_detail_for_stock_ajax",
                data: {
                    'product_name': $("#product_name").val()
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $("#product_category").val(parsedData.product_category);
                    $("#product_category_id").val(parsedData.productcategory);
                    $("#product_sub_category").val(parsedData.product_subcategory);
                    $("#product_sub_category_id").val(parsedData.product_sub_category_name);
                    $("#product_unit").val(parsedData.product_unit);
                    $("#product_unit_id").val(parsedData.productunit);
                    $("#opening_stock").val(parsedData.current_stock);
                    // $("#purchase_price").val(parsedData.selling_price);
                    if(parsedData.date_require == '1'){
                        $('#mfg_date_div').show();
                        $('#exp_date_div').show();
                        $('#date_require').val('1');
                    }else{
                        $('#mfg_date_div').hide();
                        $('#exp_date_div').hide();
                        $('#date_require').val('0');
                    }
                },
            });
        }
    }
</script>
<script>
     $("#quantity").keyup(function() {
        var open_stock=$("#opening_stock").val();
        var quantity=$("#quantity").val();
        if(quantity == ''){
            $("#closing_stock").val('');
            return false;
            quantity = 0;
        }else{
            quantity = parseInt(quantity);
        }
        if(open_stock == ''){
            open_stock = 0;
        }else{
            open_stock = parseInt(open_stock);
        }
        var ttt=open_stock + quantity;
        $("#closing_stock").val(parseInt(ttt));

    });
</script>
<script>
    $(document).ready(function() {
        $('#inventory .child_menu').show();
        $('#inventory').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-inward').addClass('active_cc');
    });
</script>

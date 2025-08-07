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
                    Add Product Consumption
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
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Product Name <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="product_name" id="product_name" onchange="setProductBarcodes()">
                                    <option value="">Select Product Name</option>
                                    <?php if (!empty($product_master_list)) {
                                        foreach ($product_master_list as $product_master_list_result) { ?>
                                            <option value="<?= $product_master_list_result->id ?>" <?php if (!empty($single) && $single->product_name == $product_master_list_result->id) { ?>selected="selected" <?php }else{ if(isset($_GET['product']) && $_GET['product'] == $product_master_list_result->id){ echo 'selected'; }} ?>><?= $product_master_list_result->product_name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <label for="product_name" style="display:none;" generated="true" class="error">Please select product name!</label>
                                <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Product Category</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_category_id" id="product_category_id" value="<?php if (!empty($single)) { echo $single->productcategory;} ?>" placeholder="Product category">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_category" id="product_category" value="<?php if (!empty($single)) { echo $single->product_category;} ?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Product Sub Category</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_sub_category_id" id="product_sub_category_id" value="<?php if (!empty($single)) { echo $single->product_subcategory;} ?>" placeholder="Product sub category">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_subcategory" id="product_subcategory" value="<?php if (!empty($single)) { echo $single->product_subcategory;} ?>">
                            </div>
                            <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Product Unit</label>
                                <input autocomplete="off" readonly class="form-control" type="text" name="product_unit_id" id="product_unit_id" value="<?php if (!empty($single)) {echo $single->productunit;} ?>" placeholder="Product unit">
                                <input autocomplete="off" class="form-control" type="hidden" name="product_unit" id="product_unit" value="<?php if (!empty($single)) { echo $single->product_unit;} ?>">
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Product opening Stock <b class="require">*</b></label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="opening_stock" id="opening_stock" value="<?php if (!empty($single)) {echo $single->opening_stock;} ?>" placeholder="Product Opening Stock">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Consumed Quantity<b class="require">*</b></label>
                                <input autocomplete="off" class="form-control" type="text" name="quantity" id="quantity" onkeyup="setProductBarcodes()" value="<?php if (!empty($single)) {echo $single->quantity; } ?>" placeholder="Consumed Quantity">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Product Closing Stock <b class="require">*</b></label>
                                <input readonly autocomplete="off" class="form-control" type="text" name="closing_stock" id="closing_stock" value="<?php if (!empty($single)) {echo $single->closing_stock; } ?>" placeholder="Product Closing Stock">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Consumption Type <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="consumption" id="consumption">
                                    <option value="">Select Consumption Type</option>
                                    <option value="5">Internal Use</option>
                                    <option value="4">Damaged</option>
                                    <option value="2">Expired</option>
                                </select>
                                <label for="consumption" style="display:none;" generated="true" class="error">Please select product name!</label>
                            </div>
                            <div class="form-group col-md-8 col-sm-6 col-xs-12" id="barcodes_div" style="display:none;">
                                <label>Stock Products <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="selected_barcodes[]" id="selected_barcodes" multiple onchange="validateBarcodeSelection()">
                                    <option value="">Select Stock Products</option>
                                </select>
                                <label style="display:none;margin-top:5px;" generated="true" class="" id="selected_barcodes_count"></label>
                                <label id="out_of_stock_error" style="display:none;" generated="true" class="error">Please select product name!</label>
                                <label for="selected_barcodes" id="selected_barcodes_error" style="display:none;" generated="true" class="error">Please select product name!</label>
                            </div>
                            <label class="error" style="display:none;font-size: 10px;" id="stock_selection_single_error">Please enter payment amount!</label>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12 " style="margin-top: 40px">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        $('#employee_form').validate({
            ignore: [],
            rules: {
                product_name: 'required',
                quantity: {
                    required: true,
                    number: true,
                    min: 1,
                },
                consumption: {
                    required: true,
                },
                'selected_barcodes[]': {
                    required: true,
                },
            },
            messages: {
                product_name: "Please select product name!",
                quantity: {
                    required: "Please enter product quantity!",
                    number: "Only number allowed!",
                    min: "Minimum 1 quantity required!",
                },
                consumption: {
                    required: "Please select consumption type!",
                },
                'selected_barcodes[]': {
                    required: "Please select atleast 1 product!",
                },
              
            },
            submitHandler: function(form) {
                var isValid = true;
                var selectedValue = $('#selected_barcodes').val();
                var selectedProductQuantity = $('#quantity').val();
                if (selectedValue || selectedValue.length != 0 ||  selectedValue != "" || selectedValue != null) {
                    if(selectedValue.length == selectedProductQuantity){
                        $('#stock_selection_single_error').html('');
                        $('#stock_selection_single_error').hide();
                    }else{
                        $('#stock_selection_single_error').html('Please select stock products for entered quantity');
                        $('#stock_selection_single_error').show();
                        isValid = false;
                    }
                }

                if (isValid && confirm("Are you sure to submit?")) {
                    $('#stock_selection_single_error').html('');
                    $('#stock_selection_single_error').hide();
                    form.submit();
                } else {
                    return false;
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({ });
    });
</script>
<script>
    function validateBarcodeSelection() {
        $('#selected_barcodes_error').text('');
        $('#selected_barcodes_error').hide();
        var product_quantity = $('#quantity').val();
        var $chosenSelect = $('#selected_barcodes').chosen();
        
        $chosenSelect.find('option').prop('disabled', false);
        
        var selectedOptions = $chosenSelect.val() || [];
        
        if (product_quantity != null && product_quantity !== '') {
            if (selectedOptions.length === parseInt(product_quantity, 10)) {
                $chosenSelect.find('option:not(:selected)').prop('disabled', true);
            }
        }
        
        $chosenSelect.trigger('chosen:updated');
        
        var selectedbarcodes = selectedOptions.length;
        
        if(selectedbarcodes > 0){
            $('#selected_barcodes_count').text('Selected Stock Products: ' + selectedbarcodes);
            $('#selected_barcodes_count').show();
        }else{
            $('#selected_barcodes_count').text('');
            $('#selected_barcodes_count').hide();
        }
    }
    function setProductBarcodes(){
        if($("#product_name").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_product_barcodes_ajax",
                data: {
                    'product_name': $("#product_name").val()
                },
                success: function(data) {
                    $('#selected_barcodes').val('');
                    $("#selected_barcodes").empty();
                    $('#selected_barcodes').trigger('change');
                    $('#selected_barcodes').trigger('chosen:updated');

                    var count = 1;
                    var quantity = $("#quantity").val();
                    if(quantity == ''){
                        quantity = 0;
                        $('#barcodes_div').hide();
                    }else{
                        quantity = parseInt(quantity);
                        $('#barcodes_div').show();
                    }

                    var opts = $.parseJSON(data);
                    var availableproducts = opts.length;
                    $('#available_quantity').val(availableproducts);
                    if(availableproducts >= quantity){
                        $('#out_of_stock_error').html('');
                        $('#out_of_stock_error').hide();

                        $("#selected_barcodes").empty();
                        $('#selected_barcodes').append('<option value="">Select Stock Products</option>');
                        $.each(opts, function(i, d) {
                            if(count <= quantity){
                                var selected = 'selected';
                            }else{
                                var selected = '';
                            }
                            $('#selected_barcodes').append('<option value="' + d.id + '" ' + selected + ' >' + d.barcode_id + '</option>');
                            count++;
                        });
                        $('#selected_barcodes').trigger('change');
                        $('#selected_barcodes').trigger('chosen:updated');
                        validateBarcodeSelection();
                    }else{
                        $('#selected_barcodes').val('');
                        $('#selected_barcodes').trigger('change');
                        $('#selected_barcodes').trigger('chosen:updated');
                        $('#out_of_stock_error').html('Entered quantity is greater then available product stock');
                        $('#out_of_stock_error').show();
                    }
                },
            });
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
                },
            });
        }
    }
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
        var ttt=open_stock - quantity;
        $("#closing_stock").val(parseInt(ttt));

    });
</script>
<script>
    $(document).ready(function() {
        $('#inventory .child_menu').show();
        $('#inventory').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-consumption').addClass('active_cc');
    });
</script>

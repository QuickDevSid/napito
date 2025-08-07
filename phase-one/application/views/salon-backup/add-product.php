<?php include('header.php'); ?>
<style type="text/css">
    
    
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Product Details
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
                            <form method="post" name="product_form" id="product_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Name <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="product_name" id="product_name"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->product_name;
                                                } ?>"
                                                placeholder="Enter product name">
                                            <input class="form-control" type="hidden" name="id" id="id"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->id;
                                                } ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Description<b class="require">*</b></label>
                                            <input class="form-control" type="text" name="description" id="description"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->description;
                                                } ?>"
                                                placeholder="Enter product description">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Select Product Category <b class="require">*</b></label>
                                                <select class="form-select form-control  chosen-select" name="product_category" id="product_category">
                                                    <option value="">Select Product Category</option>
                                                    <?php if (!empty($select_product_category)) {
                                                    foreach ($select_product_category as $select_product_category_result) { ?>

                                                        <option value="<?= $select_product_category_result->id ?>" <?php if (!empty($single) && $single->select_product_category == $select_product_category_result->id) { ?>selected="selected"
                                                            <?php } ?>>
                                                            <?= $select_product_category_result->product_category ?>
                                                        </option>
                                                        <?php }
                                                    } ?>
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Unit</label>
                                            <input class="form-control" type="number" name="product_unit" id="product_unit"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->product_unit;
                                                } ?>"
                                                placeholder="Enter product unit">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        <div class="form-group">
                                            <label>Product opening Stock <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="opening_stock" id="opening_stock"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->opening_stock;
                                                } ?>"
                                                placeholder="Enter product opening stock">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Closing Stock <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="closing_stock" id="closing_stock"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->closing_stock;
                                                } ?>"
                                                placeholder="Enter product closing stock">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Upload Product Image 
                                            <?php if (!empty($single) && isset($single->old_product_image)) { ?>
                                                <a href="<?= base_url() . 'admin_assets/images/product_image/' . $single->old_product_image; ?>">View</a>
                                            <?php } ?>
                                            <b class="require">*</b></label>
                                            <input class="form-control" type="file" name="product_image" id="product_image">
                                            <input class="form-control" type="hidden" name="old_product_image" id="old_product_image"
                                                value="<?php if (!empty($single) && isset($single->old_product_image)) {
                                                    echo $single->old_product_image;
                                                } ?>">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Purchase Price <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="purchase_price" id="purchase_price"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->purchase_price;
                                                } ?>"
                                                placeholder="Enter product purchase price">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="row">      
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Gst Amount <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="gst_amount" id="gst_amount"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->gst_amount;
                                                } ?>"
                                                placeholder="Enter gst amount">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Selling Price <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="selling_price" id="selling_price"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->selling_price;
                                                } ?>"
                                                placeholder="Enter product selling price">
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Product Discount <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="discount" id="discount"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->discount;
                                                } ?>"
                                                placeholder="Enter product discount">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Reward Point <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="reward_point" id="reward_point"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->reward_point;
                                                } ?>"
                                                placeholder="Enter reward point">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">      
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Incentive <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="incentive" id="incentive"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->incentive;
                                                } ?>"
                                                placeholder="Enter incentive">
                                           
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top: 40px">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->
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
    $(document).ready(function () {
        $('#product_form').validate({
            ignore: "",
            rules: {
                product_name: 'required',
                product_image: 'required',
                description: 'required',
                product_category: 'required',
                product_unit: 'required',
                opening_stock: 'required',
                closing_stock: 'required',
                gst_amount: 'required',
                purchase_price: 'required',
                selling_price: 'required',
                discount: 'required',
                reward_point: 'required',
                incentive: 'required',


            },
            messages: {
                product_name: "Please enter product name",
                product_image: "Please upload product image",
                description: "Please enter description ",
                product_category: "Please enter product category ",
                product_unit: "Please enter product unit ",
                opening_stock: "Please enter opening stock",
                closing_stock: "Please enter closing stock",
                purchase_price: "Please enter product purchase price ",
                gst_amount: "Please enter gst amount",
                selling_price: "Please enter product selling price ",
                discount: "Please enter product discount",
                reward_point: "Please enter reward point",
                incentive: "Please enter incentive",
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
    });

    $("#state").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: { 'state': $("#state").val() },
            success: function (data) {
                $("#city").empty();
                $('#city').append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function (i, d) {
                    $('#city').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $('#city').trigger('change');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });



    $("#email").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_owner_email",
            data: { 'email': $("#email").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#email_error").html('');
                    $("#submit").show();
                } else {
                    $("#email_error").html('This email is already added');
                    $("#submit").hide();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>
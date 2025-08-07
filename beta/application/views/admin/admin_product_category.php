<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Product Category
					<a href="<?=base_url();?>admin_product_category_list" class="btn btn-primary pull-right">Go to List</a>
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
                                    <input type="text" class="form-control" name="product_category" <?php if (isset($_GET['flag']) && base64_decode($_GET['flag']) == 'not_allowed') {
                                                                                                        echo 'readonly';
                                                                                                    } ?> id="product_category" value="<?php if (!empty($single)) {
                                                                                                                                            echo $single->product_category;
                                                                                                                                        } ?>" placeholder="Enter product category">
                                    <div id="hsn_code_error" class="error"></div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Product Category in Marathi <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="product_category_marathi" <?php if (isset($_GET['flag']) && base64_decode($_GET['flag']) == 'not_allowed') {
                                                                                                                echo 'readonly';
                                                                                                            } ?> id="product_category_marathi" value="<?php if (!empty($single)) {
                                                                                                                                                            echo $single->product_category_marathi;
                                                                                                                                                        } ?>" placeholder="Enter product category in marathi">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Product Image<b class="require">*</b></label>
                                    <input type="file" class="form-control" name="product_photo" id="product_photo" value="<?php if (!empty($single)) {
                                                                                                                                echo $single->product_photo;
                                                                                                                            } ?>">
                                    <input type="hidden" class="form-control" name="old_product_photo" id="old_product_photo" value="<?php if (!empty($single)) {
                                                                                                                                            echo $single->product_photo;
                                                                                                                                        } ?>">
                                    <?php if (!empty($single)) { ?>
                                        <a style="color: blue;float: right;margin-top: -63px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_category/<?php if (!empty($single)) {
                                                                                                                                                                                echo $single->product_photo;
                                                                                                                                                                            } ?>" class="view_image">View</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- <pre></pre> -->

                            <div class="row">
                                <div style="margin-top: 10px;" class="col-md-6 col-sm-6 col-xs-12 form-group">
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
    $("#product_category").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_product_category",
            data: {
                'product_category': $("#product_category").val(),
                'id': '<?= $id ?>'
            },
            success: function(data) {
                // console.log(data);
                if (data == "0") {
                    $("#hsn_code_error").html('');
                    $("#submit").show();
                } else {
                    $("#hsn_code_error").html('This category is already added for another product');
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
                product_category_marathi: 'required',
                <?php if (empty($single)) { ?>
                    product_photo: 'required',
                <?php } ?>
            },
            messages: {
                product_category: "Please enter product category!",
                product_category_marathi: "Please enter product category!",
                product_photo: 'Please upload category photo',
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
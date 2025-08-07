<?php include('header.php'); ?>
<style type="text/css">

.gridDiv{
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 12px;
    width: 100%;
    min-width: auto;
}
.gridDiv img{
    width: 100%;
    height: 150px;
    margin-bottom: 5px;
    margin-top: 5px;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Store Gallary
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="gallary_form" id="gallary_form" enctype="multipart/form-data">
                               <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Upload Image <b class="require">*</b></label>
                                        <input type="file" accept=".jpeg,.png,.jpg" class="form-control" name="store_images[]" id="store_images" multiple>
                                        <input type="hidden" name="id" id="id" value="<?php if(!empty($single_profile)){ echo $single_profile->id; }?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button style="margin-top: 30px;" type="submit" id="images_submit" name="images_submit" value="images_submit"
                                            class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($single_profile) && !empty($store_images)){ ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <div class="row">
                            <?php 
                                if(!empty($single_profile) && !empty($store_images)){ 
                                    foreach($store_images as $store_images_result){
                            ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                                <div class="gridDiv">
                                <a href="<?=base_url();?>salon_assets/images/salon_images/<?=$store_images_result->image;?>" download>
                                    <div>
                                        <img src="<?=base_url();?>salon_assets/images/salon_images/<?=$store_images_result->image;?>">
                                    </div>
                                </a>
                                <a class="btn btn-danger" href="<?=base_url();?>delete/<?=$store_images_result->id;?>/tbl_store_images"><i class='fas fa-trash'></i></a>
                                </div>
                            </div>
                            <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include('footer.php'); ?>
<script>

    $(document).ready(function () {
        jQuery.validator.addMethod("noHTMLtags", function (value, element) {
            if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
                if (value == "") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, "HTML tags are Not allowed.");
        $('#gallary_form').validate({
            ignore: "",
            rules: {
                "store_images[]": {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                "store_images[]": {
                    required: "Please upload image",
                    noHTMLtags: "HTML tags not allowed!",
                },
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
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.store-images').addClass('active_cc');
    });
</script>
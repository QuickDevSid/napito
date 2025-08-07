<?php include('header.php'); ?>
<style type="text/css">


</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Gallary Master
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="gallary_form" id="gallary_form" enctype="multipart/form-data">
                               <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Select Catagory <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="category"
                                            id="category">
                                            <option value="" class="">Select</option>
                                            <?php if (!empty($catagory)) {
                                                foreach ($catagory as $sup_catagory_result) { ?>

                                                    <option value="<?= $sup_catagory_result->id ?>" <?php if (!empty($single) && $single->category == $sup_catagory_result->id) { ?>selected="selected" <?php } ?>>
                                                        <?= $sup_catagory_result->services_name ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Select Sub Catagory <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="sub_catagory"
                                            id="sub_catagory">
                                            <option value="" class="">Select</option>
                                            <?php if (!empty($sub_category)) {
                                                foreach ($sub_category as $sub_catagory_result) { ?>

                                                    <option value="<?= $sub_catagory_result->id ?>" <?php if (!empty($single) && $single->sub_catagory == $sub_catagory_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $sub_catagory_result->sub_catagory ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Upload Image <b class="require">*</b></label>
                                        <input type="file" class="form-control" name="gallary_image[]" id="gallary_image"
                                            value="<?php if (!empty($single)) {
                                                echo $single->gallary_image;
                                            } ?>" multiple>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <button style="margin-top: 30px;" type="submit" id="submit"
                                            class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>

            </div>



            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <!-- <div class="clearfix"></div> -->
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($gallary_list)) {
                                    $i = 1;
                                    foreach ($gallary_list as $gallary_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td>
                                                <?= $gallary_list_result->services_name ?>
                                            </td>
                                            <td>
                                                <?= $gallary_list_result->sub_catagory ?>
                                            </td>
                                            <td> <a class="btn btn-success" target="_blank"
                                                    href="<?= base_url() ?>\admin_assets\images\gallary_image/<?= $gallary_list_result->gallary_image ?>">View
                                                </a></td>
                                            <td>
                                                <?php if ($gallary_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $gallary_list_result->id ?>/tbl_gallary"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $gallary_list_result->id ?>/tbl_gallary"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $gallary_list_result->id ?>/tbl_gallary"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-gallary/<?= $gallary_list_result->id ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
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

    </div>
</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("validate_email", function (value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
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
                category: {
                    required: true,
                    noHTMLtags: true,
                },
                sub_catagory: {
                    required: true,
                    noHTMLtags: true,
                },
                "gallary_image[]": {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                sub_catagory: {
                    required: "Please enter sub category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category: {
                    required: "Please enter category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                "gallary_image[]": {
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
    });
    $("#sub_category").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_sub_category",
            data: { 'sub_category': $("#sub_category").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#sub_category_error").html('');
                    $("#submit").show();
                } else {
                    $("#sub_category_error").html('This category type is already added');
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
<script>
    $("#category").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_sub_category",
            data: { 'category': $("#category").val() },
            success: function (data) {
                $("#sub_catagory").empty();
                $('#sub_catagory').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#sub_catagory').append('<option value="' + d.id + '">' + d.sub_catagory + '</option>');
                });
                $('#sub_catagory').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Salon Gallary
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="gallary_form" id="gallary_form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Select Catagory <b class="require">*</b></label>
                                <select class="form-select form-control" name="category" id="category">
                                    <option value="" class="">Select Category</option>
                                            <?php if (!empty($gallary_category)) {
                                                foreach ($gallary_category as $gallary_category_result) { ?>

                                                    <option value="<?= $gallary_category_result->id ?>" <?php if (!empty($single) && $single->category == $gallary_category_result->id) { ?>selected="selected" <?php } ?>><?= $gallary_category_result->category_type ?></option>
                                                <?php }
                                            } ?>
                                    <input type="hidden" class="form-control" name="salon_id" id="salon_id" value="<?php echo $this->uri->segment(2); ?>">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Upload Image <b class="require">*</b></label>
                                <input style="height: 50px;border: 0px;" type="file" class="form-control" name="gallary_image[]" id="gallary_image" value="<?php if (!empty($single)) {
                                                                                                                                                                echo $single->gallary_image;
                                                                                                                                                            } ?>" multiple>


                                <div class="error" id="gallary_image_error"></div>
                            </div>



                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form> <!------------end of form---->
                    </div> <!----------end of container-------->

                </div>
            </div>

        </div>



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <!-- <div class="clearfix"></div> -->
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Catagory</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($salon_gallary_list)) {
                                $i = 1;
                                foreach ($salon_gallary_list as $salon_gallary_list_result) {
                            ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i++ ?>
                                        </th>
                                        <td><?= $salon_gallary_list_result->category_type ?></td>
                                        <td> <a target="_blank" href="<?= base_url() ?>\admin_assets\images\gallary_image/<?= $salon_gallary_list_result->gallary_image ?>">View
                                            </a></td>
                                        <td>
                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $salon_gallary_list_result->id ?>/tbl_salon_gallary"><i class="fa-solid fa-trash"></i></a>

                                            <a title="Edit" class="btn btn-success" href="<?= base_url() ?>salon-gallary/<?= $salon_gallary_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                    <!-- Button trigger modal -->






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
    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
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
                "category": {
                    required: true,
                    noHTMLtags: true,
                },

                "gallary_image[]": {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {

                "category": {
                    required: "Please enter catagory!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                "gallary_image[]": {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
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
            max_selected_options: 5
        });
    });
</script>
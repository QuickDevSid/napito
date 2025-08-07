<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Sub Category
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


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="sup_category"
                                            id="sup_category">
                                            <option value="" class="">Select Category</option>
                                            <?php if (!empty($sup_category)) {
                                                foreach ($sup_category as $sup_category_result) { ?>

                                                    <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->sup_category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?= $sup_category_result->sup_category ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Sub Category <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="sub_category" id="sub_category"
                                            value="<?php if (!empty($single)) {
                                                echo $single->sub_category;
                                            } ?>"
                                            placeholder="Enter sub category">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Sub Category in मराठी<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="sub_category_marathi" id="sub_category_marathi"
                                            value="<?php if (!empty($single)) {
                                                echo $single->sub_category_marathi;
                                            } ?>"
                                            placeholder="Enter sub category marathi">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <button style="margin-top: 15px;" type="submit" id="submit"
                                            class="btn btn-success">Submit</button>
                                </div>    
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>

            </div>



            <div class="col-md-12 col-sm-12 col-xs-12">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sub_category_list)) {
                                    $i = 1;
                                    foreach ($sub_category_list as $sub_category_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $sub_category_list_result->sup_category?></td>
                                            <td><?= $sub_category_list_result->sub_category?>|<?= $sub_category_list_result->sub_category_marathi?></td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>admin_delete/<?= $sub_category_list_result->id ?>/tbl_admin_sub_category"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success"
                                                    href="<?= base_url() ?>add-admin-sub-category/<?= $sub_category_list_result->id ?>"><i
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
        $('#master_form').validate({
            ignore: "hidden",
            rules: {
                sub_category: {
                    required: true,
                    noHTMLtags: true,
                },
                sup_category: {
                    required: true,
                    noHTMLtags: true,
                },
                sub_category_marathi: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                sup_category: {
                    required: "Please select category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category: {
                    required: "Please enter sub category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category_marathi: {
                    required: "Please enter sub category in marathi",
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

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>




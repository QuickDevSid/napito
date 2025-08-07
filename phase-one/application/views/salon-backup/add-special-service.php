<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .input-content-option {
        height: 35px;
        width: 570px;
        border-radius: 5px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div>
                <h3>
                    Add Service
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
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Select Catagory <b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select" name="category"
                                        id="category">
                                        <option value="" class="">Select</option>
                                        <?php if (!empty($catagory)) {
                                            foreach ($catagory as $sup_catagory_result) { ?>

                                                <option value="<?= $sup_catagory_result->id ?>" <?php if (!empty($single) && $single->category == $sup_catagory_result->id) { ?>selected="selected"
                                                    <?php } ?>><?= $sup_catagory_result->services_name ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <div class="error" id="category_error"></div>
                                </div>
                                <div class="form-group">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select" name="service_name"
                                        id="service_name">
                                        <option value="" class="">Select</option>
                                        <?php if (!empty($service_name)) {
                                            foreach ($service_name as $sub_catagory_result) { ?>

                                                <option value="<?= $sub_catagory_result->id ?>" <?php if (!empty($single) && $single->service_name == $sub_catagory_result->id) { ?>selected="selected" <?php } ?>><?= $sub_catagory_result->service ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <div class="error" id="service_name_error"></div>
                                </div>


                                <div class="form-group">
                                    <label>Discount <b class="require">*</b></label></label>
                                    <input type="text" class="form-control" name="discount" id="  discount"
                                        value="<?php if (!empty($single)) {
                                            echo $single->discount;
                                        } ?>">

                                    <div class="error" id="sub_catagory_error"></div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-success"
                                        style="margin-top: 25px;">Submit</button>
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
                                    <th>Catagory</th>
                                    <th>Service</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($special_service_list)) {
                                    $i = 1;
                                    foreach ($special_service_list as $special_service_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $sub_catagory_result->service ?></td>
                                            <td><?= $sup_catagory_result->services_name ?></td>
                                            <td><?= $special_service_list_result->discount ?></td>
                                            <td>
                                                <?php if ($special_service_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $special_service_list_result->id ?>/tbl_special_service"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $special_service_list_result->id ?>/tbl_special_service"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $special_service_list_result->id ?>/tbl_special_service"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-special-service/<?= $special_service_list_result->id ?>"><i
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
            ignore: "",
            rules: {
                service_name: {
                    required: true,
                    noHTMLtags: true,
                },
                discount: {
                    required: true,
                    noHTMLtags: true,
                },
                category: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                service_name: {
                    required: "Please enter service name",
                    noHTMLtags: "HTML tags not allowed!",
                },
                discount: {
                    required: "Please enter discount",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category: {
                    required: "Please enter service catagory",
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
    $("#sub_catagory").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_sub_catagory",
            data: { 'sub_catagory': $("#sub_catagory").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#sub_catagory_error").html('');
                    $("#submit").show();
                } else {
                    $("#sub_catagory_error").html('This catagory type is already added');
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
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
                                    <label>Add Service <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="service" id="service"
                                        value="<?php if (!empty($single)) {
                                            echo $single->service;
                                        } ?>"
                                        placeholder="Enter service name">

                                    <div class="error" id="sub_category_error"></div>
                                    <input type="hidden" class="form-control" name="id" id="id"
                                        value="<?php if (!empty($single)) {
                                            echo $single->id;
                                        } ?>">
                                         <div class="error" id="service_error"></div>
                                </div>
                                <div class="form-group">
                                    <label>Description <b class="require">*</b></label></label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        value="<?php if (!empty($single)) {
                                            echo $single->description;
                                        } ?>"
                                        placeholder="Enter description">

                                    
                                </div>
                                <div class="form-group">
                                    <label>Upload Image <b class="require">*</b></label>
                                    <input style="height: 50px;border: 0px;" type="file" class="form-control"
                                        name="service_image" id="service_image"
                                        value="<?php if (!empty($single)) {
                                            echo $single->service_image;
                                        } ?>">
                                    <input style="height: 50px;border: 0px;" type="hidden" class="form-control"
                                        name="old_service_image" id="old_service_image"
                                        value="<?php if (!empty($single)) {
                                            echo $single->service_image;
                                        } ?>">

                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-success">Submit</button>
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
                                    <!-- <th>Category</th>
                                                <th> Sub Category</th> -->
                                    <th> Service</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($service_list)) {
                                    $i = 1;
                                    foreach ($service_list as $service_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <!-- <td><?= $service_list_result->services_name ?></td>
                                                <td><?= $service_list_result->sub_category ?></td> -->
                                            <td><?= $service_list_result->service ?></td>
                                            <td><?= $service_list_result->description ?></td>
                                            <td><button class="photo-btn btn btn-light"><a target="_blank"
                                                        href="<?= base_url() ?>\admin_assets\images\service_image/<?= $service_list_result->service_image ?>"
                                                        target="_blank">View</a></button> </td>
                                            <td>
                                                <?php if ($service_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $service_list_result->id ?>/tbl_service_name"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $service_list_result->id ?>/tbl_service_name"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $service_list_result->id ?>/tbl_service_name"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-service/<?= $service_list_result->id ?>"><i
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
                service: {
                    required: true,
                    noHTMLtags: true,
                },
                description: {
                    required: true,
                    noHTMLtags: true,
                },
                sup_category: {
                    required: true,
                    noHTMLtags: true,
                },
                service_sub_category: {
                    required: true,
                    noHTMLtags: true,
                },
                <?php if (empty($single) || (isset($single) && $single->service_image == "")) { ?>
            service_image: {
                        required: true,
                        noHTMLtags: true,
                    },
                <?php } ?>
            },
            messages: {
                service: {
                    required: "Please enter service",
                    noHTMLtags: "HTML tags not allowed!",
                },
                description: {
                    required: "Please enter description",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sup_category: {
                    required: "Please enter category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_sub_category: {
                    required: "Please enter sub category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                <?php if (empty($single) || (isset($single) && $single->service_image == "")) { ?>
            service_image: {
                        required: "Please upload image",
                        noHTMLtags: "HTML tags not allowed!",
                    },
                <?php } ?>
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
<script>
    $("#sup_category").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_sub_category",
            data: { 'category': $("#sup_category").val() },
            success: function (data) {


                $("#service_sub_category").empty();
                $('#service_sub_category').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#service_sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#service_sub_category').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $("#service").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_service",
            data: { 'service': $("#service").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#service_error").html('');
                    $("#submit").show();
                } else {
                    $("#service_error").html('This service name is already added');
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
    $(document).ready(function () {
        $("#btn-yes").click(function () {
            $("#third-category").toggle();
        });
    });
</script>
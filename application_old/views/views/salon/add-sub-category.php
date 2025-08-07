<?php include('header.php'); ?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<style type="text/css">
    .error {
        font-weight: bold;
    }

    .fade.in {
        display: block !important;
    }


    /* .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    } */
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <!-- <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Services
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div> -->
        <div class="clearfix"></div>
        <!-- Single button -->


        <div class="row">
            <div class="dropdown top-btn-btn">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog" aria-hidden="true"></i> Setting
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                    <li><a class="add-sup-catagory" href="<?= base_url(); ?>add-sup-category">Add Services Category</a></li>
                    <li><a class="add_service_sub_category" href="<?= base_url(); ?>add_service_sub_category">Add Services Sub Category</a></li>
                </ul>
            </div>

            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="active" id="tab_1">
                        <a href="#1" data-toggle="tab">Service List</a>
                    </li>
                    <li id="tab_2">
                        <a href="#2" data-toggle="tab">Add Service</a>
                    </li>


                </ul><br>
            </div>
            <!-- Single button -->

            <div class="tab-content ">




                <div class="tab-pane" id="2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!-- <div class="title_left">
                                    <h3>
                                        Add Services
                                    </h3>
                                </div> -->
                            <div class="x_content">
                                <div class="container">

                                    <form method="post" name="sub_category_form" id="sub_category_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                <label>Select Category <b class="require">*</b></label>
                                                <select class="form-select form-control chosen-select" name="sup_category" id="sup_category">
                                                    <option value="">Select Category</option>
                                                    <?php if (!empty($sup_category)) {
                                                        foreach ($sup_category as $sup_category_result) { ?>
                                                            <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?= $sup_category_result->sup_category ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                    echo $single->id;
                                                                                                } ?>">
                                            </div>

                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Add Sub Category <b class="require">*</b></label>
                                                <select class="form-control" name="sub_category" id="sub_category">
                                                    <option value="">Select Sub Category</option>
                                                    <option value=" <?php if ((!empty($single) && $single->sub_category)) echo 'selected="selected"'; ?>"><?= $single->sub_category ?></option>
                                                </select>

                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Service Name <b class="require">*</b></label>
                                                <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter Service Name" value="<?php if (!empty($single)) {
                                                                                                                                                                            echo $single->service_name;
                                                                                                                                                                        } ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Service photographs <b class="require">*</b></label>
                                                <input type="file" class="form-control" name="userfile[]" id="category_image" multiple>
                                                <input type="hidden" class="form-control" name="old_images" id="old_images" value="<?php if (!empty($single)) {
                                                                                                                                        echo $single->category_image;
                                                                                                                                    } ?>">
                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Service description <b class="require"></b></label>
                                                <textarea class="form-control" name="service_description" id="service_description"><?php if (!empty($single)) {
                                                                                                                                        echo $single->service_description;
                                                                                                                                    } ?></textarea>
                                            </div>

                                            <div class=" form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Duration in minuts<b class="require">*</b></label>
                                                <input type="text" name="service_duration" id="service_duration" class="form-control" placeholder="Select duration of service" value="<?php if (!empty($single)) {
                                                                                                                                                                                            echo $single->service_duration;
                                                                                                                                                                                        } ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Actual Price <b class="require">*</b></label>
                                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" value="<?php if (!empty($single)) {
                                                                                                                                                        echo $single->price;
                                                                                                                                                    } ?>">
                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Service Discount<b class="require">*</b></label>
                                                <input type="text" name="service_discount" id="service_discount" class="form-control" placeholder="Service Discount" value="<?php if (!empty($single)) {
                                                                                                                                                                                echo $single->service_discount;
                                                                                                                                                                            } ?>">
                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="">Select discount type</option>
                                                    <option value="0" <?php if (!empty($single) && $single->discount_in == 0) {
                                                                            echo 'selected';
                                                                        } ?>>Percentage</option>
                                                    <option value="1" <?php if (!empty($single) && $single->discount_in == 1) {
                                                                            echo 'selected';
                                                                        } ?>>Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Final Price<b class="require">*</b></label>
                                                <input type="text" name="final_price" id="final_price" class="form-control" placeholder="Final price" value="<?php if (!empty($single)) {
                                                                                                                                                                    echo $single->final_price;
                                                                                                                                                                } ?>">
                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Reward Point <small></small><b class="require"></b></label>
                                                <input type="text" name="reward_point" id="reward_point" class="form-control" placeholder="Reward Point" value="<?php if (!empty($single)) {
                                                                                                                                                                    echo $single->reward_point;
                                                                                                                                                                } ?>">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-8 col-xs-12">
                                                <label>Select Employee<b class="require">*</b></label>
                                                <select class="form-select form-control chosen-select" name="emp_name[]" id="emp_name" multiple>
                                                    <option value="">Select Employee</option>
                                                    <?php if (!empty($emp_name_list)) {
                                                        foreach ($emp_name_list as $emp_name_list_result) { ?>
                                                            <option value="<?= $emp_name_list_result->id ?>" <?php if (!empty($single) && $single->emp_name == $emp_name_list_result->id) { ?>selected="selected" <?php } ?>><?= $emp_name_list_result->full_name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                    echo $single->id;
                                                                                                } ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label> Select Product</label>
                                                <select class="form-select form-control chosen-select" name="product[]" id="product" multiple>
                                                    <option value="" class="">Select Product</option>
                                                    <?php if (!empty($product_master_list)) {
                                                        foreach ($product_master_list as $product_master_list_result) { ?>
                                                            <option value="<?= $product_master_list_result->id ?>" <?php if (!empty($single) && $single->product == $product_master_list_result->id) { ?>selected="selected" <?php } ?>><?= $product_master_list_result->product_name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Reminder Duration in Days<b class="require">*</b></label>
                                                <input type="text" name="reminder_duration" id="reminder_duration" class="form-control" placeholder="Enter reminder duration" value="<?php if (!empty($single)) {
                                                                                                                                                                                            echo $single->reminder_duration;
                                                                                                                                                                                        } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <button style="margin-top: 15px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane active" id="1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Service List</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($services)) {
                                    $j = 0;
                                    $m = 0;
                                    $i = 1;
                                    $k=1;
                                    foreach ($services as $services_result) {
                                        $service_employee = $this->Salon_model->get_selected_service_employee($services_result->emp_name);
                                        $service_products = $this->Salon_model->get_selected_service_products($services_result->product);
                                       ?>
                                        <div class="col-md-6">
                                            <div class="service_card_box">
                                                <div class="dropdown card-btn-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span class="fas fa-ellipsis-v"></span>
                                                    </button>
                                                    <ul class="dropdown-menu card-menu" aria-labelledby="dropdownMenu1">
                                                        <li>
                                                            <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="" style="border:1px solid #ccc;"><i tyle="color: blue; font-size: 15px;" class="fa-solid fa-toggle-on"></i>Active</a>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href=""><i class="fa-solid fa-trash"></i>Delete
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a title="Edit" class="btn btn-primary" ref=""><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/category_image/' . $services_result->category_image) ?>)"></div>

                                                <div class="service-info-div">
                                                    <p><span><?= $services_result->sup_category ?>|<?= $services_result->sup_category_marathi ?></span>,&nbsp; &nbsp; <span></span></p>
                                                    <p><?= $services_result->sub_category ?>|<?= $services_result->sub_category_marathi ?></p>
                                                    
                                                    <h4><?= $services_result->service_name ?></h4>
                                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                    <p><span style="text-decoration: line-through;">Rs: <?= $services_result->price ?></span>&nbsp; <span>Rs: <?= $services_result->final_price ?></span></p>
                                                </div>
                                            </div>
                                            <div class="service-card-footer">
                                                <div>
                                                    <p class="services_footer_count"><?= $services_result->reward_point ?></p>
                                                    <p> Reward</p>
                                                </div>
                                                <div class="employee-modal-link" data-toggle="modal" data-target="#employeeModal<?=$k?>">
                                                <?php if (!empty($service_employee)) {
                                                    foreach ($service_employee as $service_employee_result) {
                                                        $m++;
                                                    }
                                                } ?>
                                                    <p class="services_footer_count"><?=$m?></p>
                                                    <p> Employee</p>
                                                </div>
                                                <div class="product-modal-link" data-toggle="modal" data-target="#productModal<?=$k?>">
                                                <?php if (!empty($service_products)) {
                                                    foreach ($service_products as $service_products_result) {
                                                        $j++;
                                                    }
                                                } ?>
                                                    <p class="services_footer_count"><?=$j?></p>
                                                    <p> Product</p>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- product model -->

                                        <div class="modal fade" id="productModal<?=$k?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display:none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background: #ebebeb;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <div class="as-service-box">
                                                        <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/category_image/' . $services_result->category_image) ?>)"></div>
                                                            <div>
                                                                <h4><?= $services_result->service_name ?></h4>
                                                                <p><span><?= $services_result->sup_category ?>|<?= $services_result->sup_category_marathi ?></span>,&nbsp; &nbsp; <span></span></p>
                                                                <p><?= $services_result->sub_category ?>|<?= $services_result->sub_category_marathi ?></p>
                                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                                <p><span style="text-decoration: line-through;">Rs: <?= $services_result->price ?></span>&nbsp; <span>Rs: <?= $services_result->final_price ?></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 class="modal-title customize" id="myModalLabel">Employee</h4>
                                                        <br>
                                                        <?php if (!empty($service_products)) {
                                                            foreach ($service_products as $service_products_result) {?>
                                                            <div class="modal-emp-box">
                                                                <div class="emp-img-box" style="background-image:url(<?= base_url('admin_assets/images/product_image/' . $service_products_result->product_photo) ?>)"></div>
                                                                <div>  
                                                                    <span><?= $service_products_result->product_name ?></span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                        }?>
                                                    </div>
                                                    <div class="modal-footer" style="border-top:none;">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- employee model -->


                                        <div class="modal fade" id="employeeModal<?=$k?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display:none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background: #ebebeb;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <div class="as-service-box">
                                                        <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/category_image/' . $services_result->category_image) ?>)"></div>
                                                            <div class="">
                                                                <h4><?= $services_result->service_name ?></h4>
                                                                <p><span><?= $services_result->sup_category ?>|<?= $services_result->sup_category_marathi ?></span>,&nbsp; &nbsp; <span></span></p>
                                                                <p><?= $services_result->sub_category ?>|<?= $services_result->sub_category_marathi ?></p>
                                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                                <p><span style="text-decoration: line-through;">Rs: <?= $services_result->price ?></span>&nbsp; <span>Rs: <?= $services_result->final_price ?></span></p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 class="modal-title customize" id="myModalLabel">Employee</h4>
                                                        <br>
                                                   <?php 
                                                        if (!empty($service_employee)) {
                                                            foreach ($service_employee as $service_employee_result) {
                                                    ?>
                                                    <div class="modal-emp-box">
                                                    <div class="emp-img-box" style="background-image:url(<?= base_url('admin_assets/images/employee_profile/' . $service_employee_result->profile_photo) ?>)"></div>
                                                            <div>  
                                                                    <span><?= $service_employee_result->full_name ?></span>
                                                                </div>
                                                                </div>
                                                    <?php
                                                            }
                                                        } 
                                                    ?>
                                                    </div>
                                                    <div class="modal-footer" style="border-top:none;">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php $k++; $m=0;$j=0;}
                                } ?>
                            </div>
                        </div>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script>
    $("#discount_in").change(function() {
        var regular_price = $('#price').val();
        var discount = $('#service_discount').val();
        if ($('#discount_in').val() == 0) {
            var discounted_amount = regular_price - (regular_price * (discount / 100));
            $('#final_price').val(discounted_amount);
        } else {
            var discounted_amount = regular_price - discount;
            $('#final_price').val(discounted_amount);
        }

    });
    $("#service_discount").keyup(function() {
        var regular_price = $('#price').val();
        var discount = $('#service_discount').val();
        if ($('#discount_in').val() == 0) {
            var discounted_amount = regular_price - (regular_price * (discount / 100));
            $('#final_price').val(discounted_amount);
        } else {
            var discounted_amount = regular_price - discount;
            $('#final_price').val(discounted_amount);
        }

    });
    $("#sup_category").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_sub_category_ajax",
            data: {
                'sup_category': $("#sup_category").val()
            },
            success: function(data) {
                $("#sub_category").empty();
                $('#sub_category').append('<option value="">Select Sub Category</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#sub_category').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
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
        $('#sub_category_form').validate({
            ignore: '',
            rules: {
                sup_category: {
                    required: true,
                    noHTMLtags: true,
                },
                sub_category: {
                    required: true,
                    noHTMLtags: true,
                },
                discount_in: {
                    required: true,
                    noHTMLtags: true,
                },
                service_name: {
                    required: true,
                    noHTMLtags: true,
                },
                reminder_duration: {
                    required: true,
                    number: true,
                    noHTMLtags: true,
                },
                'userfile[]': {
                    required: true,
                    noHTMLtags: true,
                },
                "emp_name[]": {
                    required: true,
                    noHTMLtags: true,
                },


                duration: {
                    required: true,
                    number: true,
                    noHTMLtags: true,
                },
                price: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
                final_price: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
                service_discount: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
                service_duration: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },

            },
            messages: {
                discount_in: {
                    required: "Please select discount type!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_duration: {
                    required: "Please enter service duration!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sup_category: {
                    required: "Please select category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category: {
                    required: "Please select sub category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_name: {
                    required: "Please enter service name!",
                    noHTMLtags: "HTML tags not allowed!",
                },

                'userfile[]': {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                "emp_name[]": {
                    required: "Please selecte employee name!",
                    noHTMLtags: "HTML tags not allowed!",
                },

                price: {
                    required: "Please enter price!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                reminder_duration: {
                    required: "Please enter reminder duration!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                final_price: {
                    required: "Please enter final price!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                duration: {
                    required: "Please enter duration!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_discount: {
                    required: "Please enter service discount!",
                    number: "Only number allowed!",
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
             
        });
    });
</script>

<script>
    $('#value_check').change(function() {
        if ($('#value_check').val() == 'No') {
            $('.sub-category-box').show();
            $('.third-category-box').hide();
            // $('#third_category').attr('required', true);
        } else if ($('#value_check').val() == 'Yes') {
            $('.third-category-box').show();
            $('.sub-category-box').hide();
            // $('#third_category').attr('required', false);
        }
    });
    $(document).ready(function() {
        $('.timepicker').clockpicker({
            donetext: 'Done',
            twelvehour: false
        });
    });
</script>
<!-- <script>
      $(document).ready(function () {
			$('#services .child_menu').show();
			$('#services').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.add-sub-category').addClass('active_cc');
		});
</script> -->

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.service-setup').addClass('active_cc');
    });
</script>
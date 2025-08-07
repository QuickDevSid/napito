<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .chosen-choices {
        height: 33px !important;

    }

    .error {
        color: red;
        float: left;

    }

    label {
        display: block;
    }

    .color_input {
        display: block;
        width: 17%;
        float: left;
        height: 40px !important;
    }

    .color_value_input {
        display: block;
        width: 75%;
        float: left;
        height: 40px !important;
        padding-left: 10px;
        border-radius: 2px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }

    .text_color_input {
        display: block;
        width: 17%;
        float: left;
        height: 40px !important;
    }

    .button_text_color_input {
        display: block;
        width: 75%;
        float: left;
        height: 40px !important;
        padding-left: 10px;
        border-radius: 2px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }


    .status-column-hidden {
        display: none;
    }

    .status-column-hidden-visible {
        display: table-cell;
    }

    table.dataTable {
        width: 100% !important;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php if ($gst == "") { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                        Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>

            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if (!isset($_GET['use_this'])) { ?>active<?php } ?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Package List</a>
                    </li>
                    <li class="" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready to use Packages</a>
                    </li>
                    <?php if (isset($_GET['use_this']) && $_GET['use_this'] != "") { ?>
                        <li class="active" id="tab_2">
                            <a href="#2" data-toggle="tab">Package Setup</a>
                        </li>
                    <?php } ?>
                </ul><br>
            </div>
            <div class="tab-content">
                <?php if (!empty($store_category)) {
                    if ($store_category->category == '2') { ?>
                        <form method="get" name="" id="" enctype="multipart/form-data" style="<?php if ((isset($_GET['use_this']) && $_GET['use_this'] != "")) { ?>display:none;<?php } ?>">
                            <div class="row cc_row">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Gender</label>
                                    <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                        <option value="">Select Gender</option>
                                        <option value="0" <?php if (isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0') { ?>selected="selected" <?php } ?>>Male</option>
                                        <option value="1" <?php if (isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1') { ?>selected="selected" <?php } ?>>Female</option>
                                    </select>
                                    <div class="error" id="filter_gender_error"></div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                                    <?php if (isset($_GET['filter_gender'])) { ?>
                                        <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?= base_url(); ?><?= $this->uri->segment(1); ?>/<?= $this->uri->segment(2); ?>">Reset</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <input type="hidden" name="filter_gender" id="filter_gender" value="<?= $store_category->category; ?>" />
                <?php }
                } ?>
                <div class="tab-pane <?php if (!isset($_GET['use_this'])) { ?>active<?php } ?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr. No.</th>
                                                    <th>Package Name</th>
                                                    <th>Services</th>
                                                    <th>Regular Price</th>
                                                    <th>Gender</th>
                                                    <th>Discount</th>
                                                    <th>Offer Price</th>
                                                    <th>Package Expiry Number Of Days </th>
                                                    <th class="status-column-hidden">Package Button</th>
                                                    <th>Package Button</th>

                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $added_package = array();
                                                if (!empty($package_list)) {
                                                    $i = 1;
                                                    foreach ($package_list as $package_list_result) {
                                                        $active_customers = $this->Salon_model->get_active_salon_package_customers($package_list_result->id);
                                                        $products = !empty($package_list_result->product_name) ? explode(',', $package_list_result->product_name) : [];
                                                        $product_details_str = '';
                                                        if (empty($products)) {
                                                            $product_details_str = '-';
                                                        } else {
                                                            for ($k = 0; $k < count($products); $k++) {
                                                                $product_details = $this->Salon_model->get_product_details($products[$k]);
                                                                if (!empty($product_details)) {
                                                                    $product_details_str .= $product_details->product_name;
                                                                    if ($k < count($products) - 1) {
                                                                        $product_details_str .= '+';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $added_package[] = $package_list_result->package_id;
                                                        $service_name = $this->Salon_model->get_selected_service_name_for_offer($package_list_result->service_name);
                                                        $product_name = $this->Salon_model->get_selected_product_name_for_offer($package_list_result->product_name)
                                                ?>
                                                        <tr>
                                                            <td scope="row"><?= $i++ ?></td>
                                                            <td><?= $package_list_result->package_name ?></td>
                                                            <td>
                                                                <?php
                                                                if (!empty($service_name)) {
                                                                    $firstService = true;
                                                                    foreach ($service_name as $service_name_result) {
                                                                        if (!$firstService) {
                                                                            echo " + ";
                                                                        }
                                                                        echo $service_name_result->service_name;
                                                                        $firstService = false;
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $package_list_result->actual_price ?></td>
                                                            <td>
                                                                <?php
                                                                if ($package_list_result->gender == '1') {
                                                                    echo 'Female';
                                                                } elseif ($package_list_result->gender == '0') {
                                                                    echo 'Male';
                                                                } else {
                                                                    echo '-';
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php if ($package_list_result->discount_in == 0) { ?>
                                                                <td><?= $package_list_result->discount ?>%</td>
                                                            <?php } else { ?>
                                                                <td>Rs.<?= $package_list_result->discount ?></td>
                                                            <?php } ?>
                                                            <td><?= $package_list_result->amount ?></td>
                                                            <td><?= $package_list_result->count_value ?> Days </td>
                                                            <td class="status-column-hidden">
                                                                <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?= $package_list_result->bg_color; ?>; color:<?= $package_list_result->text_color; ?>"><?= $package_list_result->package_name; ?></button>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?= $package_list_result->bg_color; ?>; color:<?= $package_list_result->text_color; ?>"><?= $package_list_result->package_name; ?></button>
                                                            </td>
                                                            <td>
                                                                <?php if (empty($active_customers)) { ?>
                                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $package_list_result->id ?>/tbl_package"><i class="fa-solid fa-trash"></i></a>
                                                                    <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-package?use_this=1&edit=<?= $package_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                <?php } else { ?>
                                                                    Package currently active for customers
                                                                <?php } ?>
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
                <div class="tab-pane" id="3">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="example1" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr. No.</th>
                                                    <th>Package Name</th>
                                                    <th>Services</th>
                                                    <th>Regular Price</th>
                                                    <th>Gender</th>
                                                    <th>Discount</th>
                                                    <th>Final Price</th>
                                                    <th>Package Expiry Number Of Days </th>
                                                    <th class="status-column-hidden">Package Button</th>
                                                    <th>Package Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($ready_packages)) {
                                                    $i = 1;
                                                    foreach ($ready_packages as $ready_packages_result) {
                                                        $final_price = 0;
                                                        $single_setup_offer = array();
                                                        if (!empty($ready_packages_result) && $ready_packages_result->discount_in == 0) {
                                                            $part = $ready_packages_result->discount;
                                                            $total = $ready_packages_result->actual_price;
                                                            if ($total != 0 && $total != "" && $total != "0") {
                                                                $percentage = $total - ($total * ($part / 100));
                                                            } else {
                                                                $percentage = 0;
                                                            }
                                                            $final_price = $ready_packages_result->actual_price - $percentage;
                                                        } else if (!empty($single_setup_offer)) {
                                                            $final_price = $ready_packages_result->actual_price - $ready_packages_result->discount;
                                                        }
                                                        $service_name = $this->Admin_model->get_selected_service_name_for_offer($ready_packages_result->service_name);
                                                ?>
                                                        <tr>
                                                            <td scope="row"><?= $i++ ?></td>
                                                            <td><?= $ready_packages_result->package_name ?></td>
                                                            <td>
                                                                <?php
                                                                if (!empty($service_name)) {
                                                                    $firstService = true;
                                                                    foreach ($service_name as $service_name_result) {
                                                                        if (!$firstService) {
                                                                            echo " + ";
                                                                        }
                                                                        echo $service_name_result->service_name;
                                                                        $firstService = false;
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $ready_packages_result->actual_price ?></td>
                                                            <td>
                                                                <?php
                                                                if ($ready_packages_result->gender == '1') {
                                                                    echo 'Female';
                                                                } elseif ($ready_packages_result->gender == '0') {
                                                                    echo 'Male';
                                                                } else {
                                                                    echo '-';
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php if ($ready_packages_result->discount_in == 0) { ?>
                                                                <td><?= $ready_packages_result->discount ?>%</td>
                                                            <?php } else { ?>
                                                                <td>Rs.<?= $ready_packages_result->discount ?></td>
                                                            <?php } ?>
                                                            <td><?= $ready_packages_result->amount ?></td>
                                                            <td><?= $ready_packages_result->count_value ?> Days </td>
                                                            <td class="status-column-hidden">
                                                                <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?= $ready_packages_result->bg_color; ?>; color:<?= $ready_packages_result->text_color; ?>"><?= $ready_packages_result->package_name; ?></button>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?= $ready_packages_result->bg_color; ?>; color:<?= $ready_packages_result->text_color; ?>"><?= $ready_packages_result->package_name; ?></button>
                                                            </td>
                                                            <td>
                                                                <?php if (!in_array($ready_packages_result->id, $added_package)) { ?>
                                                                    <a title="Use this Package" class="btn btn-primary" href="<?= base_url() ?>add-package?use_this=1&value=<?= $ready_packages_result->id ?>">Use This Package</a>
                                                                <?php } else { ?>
                                                                    <a title="Added" class="btn btn-info" href="javascript:void(0)">Package Used</a>
                                                                <?php } ?>
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
                <div class="tab-pane <?php if ((isset($_GET['use_this']) && $_GET['use_this'] != "")) { ?>active<?php } ?>" id="2">
                    <?php
                    $services_ids = "";
                    $type = "";
                    $package_id = "0";
                    $single_setup_offer = array();
                    if (!empty($setup_package)) {
                        $single_setup_package = $setup_package;
                        $package_id = $setup_package->id;
                        $type = 'ready_use';
                        $services_ids = $setup_package->service_name;
                    } else if (!empty($signle_package)) {
                        $single_setup_package = $signle_package;
                        $package_id = $signle_package->package_id;
                        $type = 'edit';
                        $services_ids = $signle_package->service_name;
                    }
                    $services_ids_array = $services_ids != "" ? explode(',', $services_ids) : [];
                    ?>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" class="form-group" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Name <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="package_name" id="package_name" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                        echo $single_setup_package->package_name;
                                                                                                                                                    } ?>" placeholder="Enter package name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single_setup_package) && isset($_GET['edit'])) {
                                                                                                                    echo $single_setup_package->id;
                                                                                                                } ?>">
                                            <input autocomplete="off" type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">
                                            <div style="display: none;" name="product_ids" id="product_ids"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Name in मराठी<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="package_name_marathi" id="package_name_marathi" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                        echo $single_setup_package->package_name_marathi;
                                                                                                                                                                    } ?>" placeholder="Enter package name in मराठी">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label> Gender<b class="require">*</b></label>
                                            <input type="hidden" class="form-control" name="gender" id="gender" value="<?php if (!empty($single_setup_package)) {
                                                                                                                            echo $single_setup_package->gender;
                                                                                                                        } ?>">
                                            <input type="text" readonly class="form-control" name="gender_name" id="gender_name" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                            if ($single_setup_package->gender == "0") {
                                                                                                                                                echo "Male";
                                                                                                                                            } else {
                                                                                                                                                echo "Female";
                                                                                                                                            }
                                                                                                                                        } ?>">
                                        </div>
                                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 form-group service_name">
                                            <?php
                                            if (!empty($single_setup_package)) {
                                                $service_title = $this->Salon_model->get_services_for_offers_genderwise_new($single_setup_package->gender);
                                            }
                                            ?>
                                            <label>Select Service <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
                                                <?php if (!empty($service_title)) {
                                                    foreach ($service_title as $service_name) {
                                                ?>
                                                        <option value="<?= $service_name->id ?>"
                                                            <?php
                                                            if ($type == 'edit') {
                                                                if (in_array($service_name->id, $services_ids_array)) {
                                                                    echo 'selected="selected"';
                                                                }
                                                            } else {
                                                                if (in_array($service_name->service_id, $services_ids_array)) {
                                                                    echo 'selected="selected"';
                                                                }
                                                            }
                                                            ?>><?= $service_name->service_name . ' | ' . $service_name->service_name_marathi; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <?php if (!empty($service_title)) {
                                                foreach ($service_title as $service_name) {
                                            ?>
                                                    <input type="hidden" name="service_price_<?= $service_name->id; ?>" id="service_price_<?= $service_name->id; ?>" value="<?php echo $service_name->final_price; ?>">
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Add Package Image<b class="require">*</b> <?php if (!empty($single_setup_package) && $single_setup_package->package_image != "") { ?> <a href="<?= base_url() ?>admin_assets/images/package_image/<?= $single_setup_package->package_image ?>" target="_blank">View</a><?php } ?></label>
                                            <input accept=".png,.jpg,.jpeg" autocomplete="off" type="file" class="form-control" name="package_image" id="package_image">
                                            <input type="hidden" name="old_package_image" id="old_package_image" value="<?php if (!empty($single_setup_package)) {
                                                                                                                            echo $single_setup_package->package_image;
                                                                                                                        } ?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Actual Price <b class="require">*</b></label>
                                            <input autocomplete="off" readonly type="text" class="form-control" name="actual_price" id="actual_price" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                    echo $single_setup_package->actual_price;
                                                                                                                                                                } ?>" placeholder="Actual price">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Discount In<small></small><b class="require">*</b></label>
                                            <select name="discount_in" id="discount_in" class="form-control" onchange="set_discount()">
                                                <option value="">Ex. percantage/Flat</option>
                                                <option value="0" <?php if ((!empty($single_setup_package) && $single_setup_package->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                <option value="1" <?php if ((!empty($single_setup_package) && $single_setup_package->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" onkeyup="set_discount()" class="form-control" name="discount" id="discount" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                            echo $single_setup_package->discount;
                                                                                                                                                                        } ?>" placeholder="Enter discount">
                                            <div class="discount_validation error"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Final Price <b class="require">*</b></label>
                                            <input autocomplete="off" readonly type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                        echo $single_setup_package->amount;
                                                                                                                                                    } ?>" placeholder="Final price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Number Of Days <b class="require">*</b></label>
                                            <input autocomplete="off" type="number" class="form-control" name="count_value" id="count_value" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                        echo $single_setup_package->count_value;
                                                                                                                                                    } ?>" placeholder="Enter package expiry number">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="custom_fields_data">
                                                <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                                                echo $single_setup_package->bg_color;
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '#bada55';
                                                                                                                                                                                            } ?>" id="hexcolor">
                                                <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                                                        echo $single_setup_package->bg_color;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo '#bada55';
                                                                                                                                                                                                    } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="custom_fields_data">
                                                <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                                                        echo $single_setup_package->text_color;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo '#000000';
                                                                                                                                                                                                    } ?>" id="texthexcolor">
                                                <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single_setup_package)) {
                                                                                                                                                                                                                echo $single_setup_package->text_color;
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo '#000000';
                                                                                                                                                                                                            } ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label>Description </label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single_setup_package)) {
                                                                                                                                                    echo $single_setup_package->description;
                                                                                                                                                } ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Blfrtip',
            responsive: true,
            // scrollX:300,
            ordering: false,
            order: [],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                extend: 'excel',
                filename: 'add-package',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }],
        });

        $('#example1').DataTable({
            dom: 'Blfrtip',
            responsive: true,
            scrollX: 300,
            ordering: false,
            order: [],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                extend: 'excel',
                filename: 'use-package',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }],
        });
    });
</script>
<script>
    $("#service_name").change(function() {
        if ($("#service_name").val() !== "") {
            $("#service_name").removeClass('is-invalid');
            $(".service_name_validation .error").hide();
        } else {
            $(".service_name_validation .error").show();
        }
        setServicePrice();
    });

    function setServicePrice() {
        let service_name = $('#service_name').val();
        var regular_price = 0;
        if (Array.isArray(service_name) && service_name.length > 0) {
            for (i = 0; i < service_name.length; i++) {
                var single_price = $('#service_price_' + service_name[i]).val();
                regular_price += parseFloat(single_price);
            }
        }
        $('#actual_price').val(parseFloat(regular_price).toFixed(2));
        set_discount();
    }
    $("#product_name").change(function() {
        if ($("#product_name").val() !== "") {
            $("#service_name").removeClass('is-invalid');
            $(".product_name_validation .error").hide();
        } else {
            $(".product_name_validation .error").show();
        }
    });

    function set_discount() {
        var regular_price = parseFloat($('#actual_price').val()) ?? 0.00;
        var discount_in = $('#discount_in').val();
        var discount = parseFloat($('#discount').val()) ?? 0.00;
        if (discount_in == '0') {
            discount_amount = discount * regular_price / 100;
        } else if (discount_in == '1') {
            discount_amount = discount;
        } else {
            discount_amount = 0;
        }
        final_price = regular_price - discount_amount;
        $('#amount').val(parseFloat(final_price).toFixed(2));
    }
</script>
<script>
    $(document).ready(function() {
        $(".chosen-select").chosen({});
        $('#service_name').trigger('change');
        $('#customer_form').validate({
            ignore: "",
            rules: {
                package_image: {
                    required: function(element) {
                        return $('#old_package_image').val() === "";
                    }
                },
                package_name_marathi: 'required',
                package_name: 'required',
                discount: {
                    required: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                    number: true,
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0,
                },
                count_value: {
                    required: true,
                    number: true,
                },
                count_type: 'required',
                discount_in: 'required',
                gender: 'required',
                "service_name[]": 'required',
            },
            messages: {
                package_image: 'Please select image!',
                package_name_marathi: 'Please enter package name in मराठी!',
                package_name: 'Please enter package name!',
                gender: 'Please select gender!',
                discount: {
                    required: "Please enter discount!",
                },
                amount: {
                    required: 'Please enter amount!',
                    number: "Only number allowed!",
                },
                count_value: {
                    required: 'Please enter package expiry number!',
                    number: "Only number allowed!",
                },
                count_type: 'Please select package expiry type!',
                "product_name[]": 'Please select product name!',
                discount_in: 'Please select discount type!',
                "service_name[]": "Please select service name!",

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
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.package-setup').addClass('active_cc');
    });
</script>
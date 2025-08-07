<?php include('header.php'); ?>
<style type="text/css">
    .custom_message_div {
        border: 1px solid #71467680;
        padding: 8px;
        border-radius: 8px;
        width: 96%;
        margin: 0 auto;
        float: none;
        background-color: #71467608;
        color: #4c4c4c !important;
    }

    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    


    .popup {
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        background: rgba(0, 0, 0, 0.75);
        z-index: 999999999999;
    }

    /* Inner */
    .popup-inner {
        max-width: 700px;
        width: 45%;
        padding: 40px;
        position: absolute;
        top: 20%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }

    /* Close Button */
    .popup-close {
        width: 30px;
        height: 30px;
        padding-top: 4px;
        display: inline-block;
        position: absolute;
        top: 24px;
        right: 28px;
        transition: ease 0.25s all;
        -webkit-transform: translate(50%, -50%);
        transform: translate(50%, -50%);
        border-radius: 1000px;
        /* background: rgba(0, 0, 0, 0.8); */
        font-family: Arial, Sans-Serif;
        font-size: 20px;
        text-align: center;
        line-height: 100%;
        color: red;
        text-decoration: none;
    }

    .popup-scroll {
        overflow-y: scroll;
        max-height: 300px;
        padding: 0 1em 0 0;
    }

    /* .popup-scroll::-webkit-scrollbar {
        background-color: #EEE;
        width: 10px;
    }

    .popup-scroll::-webkit-scrollbar-thumb {
        border: 1px #EEE solid;
        border-radius: 2px;
        background: #777;
        -webkit-box-shadow: 0 0 8px #555 inset;
        box-shadow: 0 0 8px #555 inset;
        -webkit-transition: all .3s ease-out;
        transition: all .3s ease-out;
    }

    .popup-scroll::-webkit-scrollbar-track {
        -webkit-box-shadow: 0 0 2px #ccc;
        box-shadow: 0 0 2px #ccc;
    } */

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
    <?php
    if ($gst == "") { ?>
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
                        <a href="#1" data-toggle="tab">Offers List</a>
                    </li>
                    <li class="" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready to use Offer</a>
                    </li>
                    <?php if (isset($_GET['use_this']) && $_GET['use_this'] != "") { ?>
                        <li class="active" id="tab_2">
                            <a href="#2" data-toggle="tab">Offer Setup</a>
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
                        <input type="hidden" name="filter_gender" id="filter_gender" value="<?= $store_category->category; ?>">
                    <?php }
                } ?>
                    <div class="tab-pane <?php if (!isset($_GET['use_this'])) { ?>active<?php } ?>" id="1">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table style="width: 100%;" id="example" class="table table-striped responsive-utilities jambo_table">
                                                <thead>
                                                    <tr class="headings">
                                                        <th>Sr. No.</th>
                                                        <th>Offers Name</th>

                                                        <th>Description</th>
                                                        <th>Services</th>
                                                        <th>Regular Price</th>
                                                        <th>Discount</th>
                                                        <th>Offers Price</th>
                                                        <th>Validity</th>
                                                        <th>Gender</th>
                                                        <th style="display: none;">Description</th>
                                                        <th class="status-column-hidden">Status</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $added_offer = array();
                                                    if (!empty($offers_list)) {
                                                        $i = 1;
                                                        foreach ($offers_list as $offers_list_result) {
                                                            $added_offer[] = $offers_list_result->offer_id;
                                                            $service_name = $this->Salon_model->get_selected_service_name_for_offer($offers_list_result->service_name)
                                                    ?>
                                                            <tr>
                                                                <td scope="row"><?= $i++ ?></td>
                                                                <td><?= $offers_list_result->offers_name ?></td>

                                                                <td><a class="btn btn-primary" data-popup-open="popup-1" onclick="view_description('<?php echo $offers_list_result->description; ?>')">View</a></td>
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
                                                                <td><?= $offers_list_result->regular_price ?></td>
                                                                <?php if ($offers_list_result->discount_in == 0) { ?>
                                                                    <td><?= $offers_list_result->discount ?>%</td>
                                                                <?php } else { ?>
                                                                    <td>Rs.<?= $offers_list_result->discount ?></td>
                                                                <?php } ?>
                                                                <td><?= $offers_list_result->offer_price ?></td>
                                                                <td><?= $offers_list_result->duration ?> Week</td>
                                                                <td><?php if ($offers_list_result->gender == 1) {
                                                                        echo "Female";
                                                                    } else {
                                                                        echo "Male";
                                                                    } ?></td>
                                                                <td style="display: none;"><?= $offers_list_result->description ?></td>
                                                                <td class="status-column-hidden">
                                                                    <?php if ($offers_list_result->status == "1") { ?>
                                                                        <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $offers_list_result->id ?>/tbl_offers">Active</a>
                                                                    <?php } else { ?>
                                                                        <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $offers_list_result->id ?>/tbl_offers">Inactive</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($offers_list_result->status == "1") { ?>
                                                                        <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $offers_list_result->id ?>/tbl_offers"><i class="fa-solid fa-toggle-on"></i></a>
                                                                    <?php } else { ?>
                                                                        <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $offers_list_result->id ?>/tbl_offers"><i class="fa-solid fa-toggle-off"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <button style="float:left;color:white;background-color:#25D366 !important;border:none;" title="Send Message" type="button" class="btn btn-primary btn-sm" id="send_details_button_<?= $offers_list_result->id; ?>" onclick="sendOfferMessage('<?= $offers_list_result->id; ?>')" data-toggle="modal" data-target="#sendMessageModal"><i style="font-size: 15px;padding: 2px;" class="fa fa-whatsapp"></i></button>
                                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $offers_list_result->id ?>/tbl_offers"><i class="fa-solid fa-trash"></i></a>
                                                                    <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-offers?use_this=1&edit=<?= $offers_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                    <div class="tab-pane " id="3">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table style="width: 100%;" id="example1" class="table table-striped responsive-utilities jambo_table">
                                                <thead>
                                                    <tr class="headings">
                                                        <th>Sr.no</th>
                                                        <th>Offers Name</th>
                                                        <th>Services</th>
                                                        <th>Regular Price</th>
                                                        <th>Discount</th>
                                                        <th>Offers Price</th>
                                                        <th>Validity</th>
                                                        <th>Gender</th>
                                                        <th style="display: none;">Description</th>
                                                        <th>Description</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($ready_offer)) {
                                                        $i = 1;
                                                        foreach ($ready_offer as $ready_offer_result) {
                                                            $service_name = $this->Admin_model->get_selected_service_name_for_offer($ready_offer_result->service_name)
                                                    ?>
                                                            <tr>
                                                                <td scope="row"><?= $i++ ?></td>
                                                                <td><?= $ready_offer_result->offers_name ?></td>
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
                                                                <td><?= $ready_offer_result->regular_price ?></td>
                                                                <?php if ($ready_offer_result->discount_in == 0) { ?>
                                                                    <td><?= $ready_offer_result->discount ?>%</td>
                                                                <?php } else { ?>
                                                                    <td>Rs.<?= $ready_offer_result->discount ?></td>
                                                                <?php } ?>
                                                                <td><?= $ready_offer_result->offer_price ?></td>
                                                                <td><?= $ready_offer_result->duration ?> Week</td>
                                                                <td><?php if ($ready_offer_result->gender == 1) {
                                                                        echo "Female";
                                                                    } else {
                                                                        echo "Male";
                                                                    } ?></td>
                                                                <td style="display: none;"><?= $ready_offer_result->description ?></td>
                                                                <td><a class="btn btn-primary" data-popup-open="popup-1" onclick="view_description('<?php echo $ready_offer_result->description; ?>')">View</a></td>
                                                                <td>
                                                                    <?php if (!in_array($ready_offer_result->id, $added_offer)) { ?>
                                                                        <a title="Offer Setup" class="btn btn-primary" href="<?= base_url() ?>add-offers?use_this=1&value=<?= $ready_offer_result->id ?>">Use This Offer</a>
                                                                    <?php } else { ?>
                                                                        <a title="Added" class="btn btn-info" href="javascript:void(0)">Offer Used</a>
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
                    <div class="tab-pane <?php if ((isset($_GET['use_this']) && $_GET['use_this'] != "") || (isset($_GET['edit']) && $_GET['edit'] != "")) { ?>active<?php } ?>" id="2">
                        <?php
                        $services_ids = "";
                        $type = "";
                        $offer_id = "0";
                        $single_setup_offer = array();
                        if (!empty($setup_offer)) {
                            $single_setup_offer = $setup_offer;
                            $offer_id = $setup_offer->id;
                            $type = 'ready_use';
                            $services_ids = $setup_offer->service_name;
                        } else if (!empty($single_offer)) {
                            $single_setup_offer = $single_offer;
                            $offer_id = $single_offer->offer_id;
                            $type = 'edit';
                            $services_ids = $single_offer->service_name;
                        }
                        $services_ids_array = $services_ids != "" ? explode(',', $services_ids) : [];
                        ?>
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="container">
                                    <form method="post" name="offer_form" id="offer_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Offer Name<b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="form-control" name="offers_name" id="offers_name" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                            echo $single_setup_offer->offers_name;
                                                                                                                                                        } ?>" placeholder="Enter offer name">
                                                <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single_setup_offer) && isset($_GET['edit'])) {
                                                                                                                        echo $single_setup_offer->id;
                                                                                                                    } ?>">
                                                <input autocomplete="off" type="hidden" name="offer_id" id="offer_id" value="<?php echo $offer_id; ?>">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Offers Duration in Week<b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                    echo $single_setup_offer->duration;
                                                                                                                                                } ?>" placeholder="Enter duration in week">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Gender<b class="require">*</b></label>
                                                <input type="hidden" class="form-control" name="gender" id="gender" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                echo $single_setup_offer->gender;
                                                                                                                            } ?>">
                                                <input type="text" readonly class="form-control" name="gender_name" id="gender_name" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                if ($single_setup_offer->gender == "0") {
                                                                                                                                                    echo "Male";
                                                                                                                                                } else {
                                                                                                                                                    echo "Female";
                                                                                                                                                }
                                                                                                                                            } ?>">
                                            </div>
                                            <?php
                                            if (!empty($single_setup_offer)) {
                                                $service_title = $this->Salon_model->get_services_for_offers_genderwise_new($single_setup_offer->gender);
                                            }
                                            ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group service_name">
                                                <label>Select Service <b class="require">*</b></label>
                                                <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
                                                    <?php if (!empty($service_title)) {
                                                        foreach ($service_title as $service_name) {
                                                            if ($service_name->gender == "0") {
                                                                $service_gender = " (Male)";
                                                            } else {
                                                                $service_gender = " (Female)";
                                                            }
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
                                                                ?>><?= $service_name->sub_cat_name . ' | ' . $service_name->sup_category_marathi . ' -> ' . $service_name->service_name . ' | ' . $service_name->service_name_marathi; ?> <?=$service_gender;?></option>
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
                                                <label>Regular Price<b class="require">*</b></label>
                                                <div id="price_div">
                                                    <input autocomplete="off" readonly type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                                            echo $single_setup_offer->regular_price;
                                                                                                                                                                        } ?>" placeholder="Regular price">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="">Ex. Percentage/Flat</option>
                                                    <option value="0" <?php if ((!empty($single_setup_offer) && $single_setup_offer->discount_in == 0)) { ?>selected="selected" <?php } ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single_setup_offer) && $single_setup_offer->discount_in == 1)) { ?>selected="selected" <?php } ?>>Flat</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Discount <b class="require">*</b></label>
                                                <input autocomplete="off" type="number" class="form-control" name="discount" id="discount" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                        echo $single_setup_offer->discount;
                                                                                                                                                    } ?>" placeholder="Enter discount">
                                                <div class="discount_validation error" style="display: none;"></div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Offer Price<b class="require">*</b></label>
                                                <input readonly autocomplete="off" type="number" class="form-control" name="offer_price" id="offer_price" value="<?php if (!empty($single_setup_offer)) {
                                                                                                                                                                        echo $single_setup_offer->offer_price;
                                                                                                                                                                    } ?>" placeholder="Offer price">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Description </label>
                                                <textarea autocomplete="off" type="text" class="form-control" name="description" id="description"><?php if (!empty($single_setup_offer)) {
                                                                                                                                                        echo $single_setup_offer->description;
                                                                                                                                                    } ?></textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="popup" data-popup="popup-1">
            <div class="popup-inner">
                <h3>Description</h3>
                <div class="popup-scroll">
                    <div class="descrip"></div>
                </div>
                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
            </div>
        </div>
</div>
<?php } ?>
</div>
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMessageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Send Message</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('sendMessageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="sendMessageModalResponse"></div>
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
        $(".chosen-select").chosen({});
        $('#service_name').trigger('change');
        $('#offer_form').validate({
            ignore: "",
            rules: {
                offers_name: 'required',
                discount: {
                    required: true,
                    number: true,
                },
                "service_name[]": 'required',
                gender: 'required',
                discount_in: 'required',
                duration: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                discount_in: 'Please select discount in!',
                offers_name: 'Please enter offer name!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                "service_name[]": 'Please select service!',
                gender: 'Please select gender!',
                duration: 'Please enter duration in week!',

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
    $("#service_name").change(function() {
        if ($("#service_name").val() !== "") {
            $("#service_name").removeClass('is-invalid');
            $(".service_name .error").hide();
        } else {
            $(".service_name .error").show();
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
        $('#regular_price').val(parseFloat(regular_price).toFixed(2));
        $("#discount").trigger('keyup');
    }
    $("#discount").keyup(function() {
        var discount = parseFloat($("#discount").val());
        var regular_price = parseFloat($('#regular_price').val());
        if (!isNaN(regular_price)) {
            if ($("#discount_in").val() !== "") {
                if (!isNaN($("#discount").val())) {
                    if (discount > regular_price) {
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        $('#offer_price').val(0);
                    } else {
                        $('.discount_validation').hide();
                        if ($('#discount_in').val() == 0) {
                            if (100 < discount) {
                                $('.discount_validation').show();
                                $('.discount_validation').html("Discount percantage can not be greater than 100!");
                                $('#offer_price').val(0);
                            } else {
                                $('.discount_validation').hide();
                                var discounted_amount = regular_price - (regular_price * (discount / 100));
                                $('#offer_price').val(discounted_amount);
                            }
                        } else {
                            var discounted_amount = regular_price - discount;
                            $('#offer_price').val(discounted_amount);
                        }
                    }
                } else {
                    $('.discount_validation').show();
                    $('.discount_validation').html("Only number allowed!");
                    $('#offer_price').val(0);
                }
            }
        }
        if ($("#discount").val() == "") {
            $('#offer_price').val(0);
        }
    });
    $("#discount_in").change(function() {
        $("#discount").trigger('keyup');
    });
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.offers-setup').addClass('active_cc');
    });
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Blfrtip',
            responsive: true,
            scrollX:true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                extend: 'excel',
                filename: 'add-offers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 11]
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
            scrollX:true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                extend: 'excel',
                filename: 'add-offers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                },

            }],
        });
    });
    $(function() {
        //----- OPEN
        $('[data-popup-open]').on('click', function(e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function(e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();
        });
    });

    function view_description(des) {
        $('.descrip').text(des);
    }

    function showPopup(id) {
        var exampleModal = $('#' + id);
        exampleModal.css('display', 'block');
        exampleModal.css('opacity', '1');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }

    function closePopup(id) {
        var exampleModal = $('#' + id);

        exampleModal.css('display', 'none');
        exampleModal.css('opacity', '0');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }

    function sendOfferMessage(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_send_offer_message_form_ajx",
            method: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('#sendMessageModalResponse').html(response)
                showPopup('sendMessageModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
</script>
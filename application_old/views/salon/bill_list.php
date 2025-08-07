<?php include('header.php'); ?>
<style type="text/css">
    .buttons-html5 {
        background-color: lightblue;
    }

    .custom_td {
        display: flex;
        flex-direction: column;

    }
</style>

<!-- page content -->
<div class="right_col" role="main">
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
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Bill List
                </h3>
            </div>
            <!-- 
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Select Bill Type</label>
                                    <select class="form-control choosen" id="type" name="type">
                                        <option value="">Select Bill Type</option><?php 
                                        $membership_check_array = ['asign-membership', 'asign-membership-list']; 
                                        if (!empty(array_intersect($membership_check_array, $feature_slugs))) { 
                                        ?>
                                        <option value="1" <?php if (isset($_GET['type']) && $_GET['type'] == '1') { ?>selected<?php } ?>>Membership</option>
                                        <?php 
                                        } 
                                        $package_check_array = ['asign-package', 'asign-package-list']; 
                                        if (!empty(array_intersect($package_check_array, $feature_slugs))) {
                                        ?>
                                        <option value="4" <?php if (isset($_GET['type']) && $_GET['type'] == '4') { ?>selected<?php } ?>>Package</option>
                                        <?php 
                                        } 
                                        $package_check_array = ['asign-giftcard', 'asign-giftcard-list']; 
                                        if (!empty(array_intersect($package_check_array, $feature_slugs))) {
                                        ?>
                                        <option value="3" <?php if (isset($_GET['type']) && $_GET['type'] == '3') { ?>selected<?php } ?>>Gift Card</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2  col-sm-3 col-xs-12">
                                    <button type="submit" id="submit_button" class="btn btn-success" style="margin:25px 0;">Search</button>
                                    <?php if (isset($_GET['type'])) { ?>
                                        <a href="<?= base_url(); ?><?= $this->uri->segment(1); ?>" class="btn btn-warning" style="margin-top:6px;padding:6px 10px">Reset</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <table class="table table-striped responsive-utilities jambo_table" style="width: 100%;" id="example">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Purchased From</th>
                                    <th>Bill Type</th>
                                    <th>Customer</th>
                                    <th>Details</th>
                                    <th>Discounted Amount</th>
                                    <th>GST</th>
                                    <th>Total Amount</th>
                                    <th>Sold By</th>
                                    <th>Payment Status</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($asign_list)) {
                                    $i = 1;
                                    foreach ($asign_list as $asign_list_result) {
                                        $purchase_from = '-';
                                        if ($asign_list_result->payment_from == '0') {
                                            $purchase_from = 'Vendor Panel';
                                        } elseif ($asign_list_result->payment_from == '1') {
                                            $purchase_from = 'Mobile App';
                                        }
                                        $type = '-';
                                        $gst_amount = 0.00;
                                        $gst_rate = '';
                                        $paid_amount = 0.00;
                                        $payment_status = '-';
                                        $payment_link = '';
                                        $discount_amount = $asign_list_result->discount_in_rs != "" ? $asign_list_result->discount_in_rs : 0.00;
                                        if ($asign_list_result->type == '1') {
                                            $sold_by = $this->Salon_model->get_single_emp_details($asign_list_result->mem_sold_employee_id);
                                            $type = 'Membership';
                                            $paid_amount = $asign_list_result->membership_price;
                                            $gst_amount = $asign_list_result->mem_gst_amount;
                                            $gst_rate = $asign_list_result->mem_salon_gst_rate != "" && $asign_list_result->mem_salon_gst_rate != "0" ? ' <small>(Rate: ' . $asign_list_result->mem_salon_gst_rate . '%' : '';

                                            if ($asign_list_result->mem_payment_status == "1") {
                                                $payment_status = '<label class="label label-success">Completed</label>';
                                            } else {
                                                $payment_status = '<label class="label label-warning">Pending</label>';
                                            }

                                            $payment_link = base_url() . 'membership-print/' . base64_encode($asign_list_result->membership_pkey);
                                        } elseif ($asign_list_result->type == '4') {
                                            $sold_by = $this->Salon_model->get_single_emp_details($asign_list_result->package_sold_employee_id);
                                            $type = 'Package';
                                            $paid_amount = $asign_list_result->package_amount;
                                            $gst_amount = $asign_list_result->package_gst_amount;
                                            $gst_rate = $asign_list_result->package_salon_gst_rate != "" && $asign_list_result->package_salon_gst_rate != "0" ? ' <small>(Rate: ' . $asign_list_result->package_salon_gst_rate . '%' : '';

                                            if ($asign_list_result->package_payment_status == '1') {
                                                $payment_status = '<label class="label label-success">Completed</label>';
                                            } elseif ($asign_list_result->package_payment_status == '0') {
                                                $payment_status = '<label class="label label-warning">Pending</label>';
                                            }

                                            $payment_link = base_url() . 'package-print/' . base64_encode($asign_list_result->package_allocation_id);
                                        } elseif ($asign_list_result->type == '3') {
                                            $sold_by = $this->Salon_model->get_single_emp_details($asign_list_result->giftcard_added_by);
                                            $type = 'Gift Card';
                                            $paid_amount = $asign_list_result->gift_card_price;
                                            $gst_amount = $asign_list_result->gst_amount;
                                            $gst_rate = $asign_list_result->salon_gst_rate != "" && $asign_list_result->salon_gst_rate != "0" ? ' <small>(Rate: ' . $asign_list_result->salon_gst_rate . '%' : '';

                                            $payment_status = '<label class="label label-success">Completed</label>';

                                            $payment_link = base_url() . 'giftcard-print/' . base64_encode($asign_list_result->id);
                                        }
                                        $discounted_amount = $paid_amount != "" ? ($paid_amount - $discount_amount) : 0.00;
                                        $paid_amount = $discounted_amount + $gst_amount;
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $purchase_from; ?></td>
                                            <td><?= $type; ?></td>
                                            <td><?= $asign_list_result->full_name ?><br><?= $asign_list_result->customer_phone ?></td>
                                            <?php if ($asign_list_result->type == '1') { ?>
                                                <td class="custom_td">
                                                    <button class="btn btn-sm" style="float:left; background-color: <?= $asign_list_result->mem_bg_color; ?>; color:<?= $asign_list_result->mem_text_color; ?>;"><?= $asign_list_result->membership_name ?></button>
                                                    <label>Period: <?= ($asign_list_result->membership_start != "" && $asign_list_result->membership_end != "") ? date('d M Y', strtotime($asign_list_result->membership_start)) . ' to ' . date('d M Y', strtotime($asign_list_result->membership_end)) : '-'; ?></label>
                                                    <label>Price: Rs. <?= $asign_list_result->membership_price ?></label>
                                                    <label>Discount: Rs. <?= $asign_list_result->discount_in_rs != "" ? $asign_list_result->discount_in_rs : 0.00; ?></label>
                                                    <?php if ($asign_list_result->membership_status == "0") { ?>
                                                        <label>Status: Active</label>
                                                    <?php } elseif ($asign_list_result->membership_status == "1") { ?>
                                                        <label>Status: Expired</label>
                                                    <?php } elseif ($asign_list_result->membership_status == "2") { ?>
                                                        <label>Status: Cancelled <small>(On: <?= date('d-m-Y h:i A', strtotime($asign_list_result->mem_cancelled_on)); ?>)</small></label>
                                                    <?php } elseif (date('Y-m-d') < date('Y-m-d', strtotime($asign_list_result->membership_end))) { ?>
                                                        <label>Status: Expired</label>
                                                    <?php } ?>
                                                </td>
                                            <?php } elseif ($asign_list_result->type == '4') { ?>
                                                <td class="custom_td">
                                                    <button class="btn btn-sm" style="float:left; background-color: <?= $asign_list_result->package_bg_color; ?>; color:<?= $asign_list_result->package_text_color; ?>;"><?= $asign_list_result->package_name ?></button>
                                                    <label>Period: <?= ($asign_list_result->package_start_date != "" && $asign_list_result->package_start_date != "" && $asign_list_result->package_end_date != "" && $asign_list_result->package_end_date != "") ? date('d M, Y', strtotime($asign_list_result->package_start_date)) . ' To ' . date('d M, Y', strtotime($asign_list_result->package_end_date)) : '-'; ?></label>
                                                    <label>Price: Rs. <?= $asign_list_result->package_amount ?></label>
                                                    <label>Discount: Rs. <?= $asign_list_result->discount_in_rs != "" ? $asign_list_result->discount_in_rs : 0.00; ?></label>
                                                    <?php
                                                    if ($asign_list_result->package_status == '0') {
                                                        echo '<label>Status: Active</label>';
                                                    } elseif ($asign_list_result->package_status == '1') {
                                                        echo '<label>Status: Lapsed</label>';
                                                    }
                                                    ?>
                                                </td>
                                            <?php } elseif ($asign_list_result->type == '3') { ?>
                                                <td class="custom_td">
                                                    <button class="btn btn-sm" style="float:left; background-color: <?= $asign_list_result->gc_bg_color; ?>; color:<?= $asign_list_result->gc_text_color; ?>;"><?= $asign_list_result->gift_name ?></button>
                                                    <label>Code: <?= $asign_list_result->gift_card_code != "" ? $asign_list_result->gift_card_code : '-'; ?></label>
                                                    <label>UID: <?= $asign_list_result->giftcard_customer_uid != "" ? $asign_list_result->giftcard_customer_uid : '-'; ?></label>
                                                    <label>Price: Rs. <?= $asign_list_result->gift_card_regular_price ?></label>
                                                    <label>Discount: Rs. <?= $asign_list_result->discount_in_rs != "" ? $asign_list_result->discount_in_rs : 0.00; ?></label>
                                                    <?php
                                                    if ($asign_list_result->package_status == '0') {
                                                        echo '<label>Status: Active</label>';
                                                    } elseif ($asign_list_result->package_status == '1') {
                                                        echo '<label>Status: Lapsed</label>';
                                                    }
                                                    ?>
                                                </td>
                                            <?php } else { ?>
                                                <td>-</td>
                                            <?php } ?>
                                            <td><?= $discounted_amount ?></td>
                                            <td><?= $gst_amount; ?><?= $gst_rate; ?></td>
                                            <td><?= $paid_amount ?></td>
                                            <td><?= !empty($sold_by) ? $sold_by->full_name : '-'; ?></td>
                                            <td><?= $payment_status; ?></td>
                                            <td><?= $payment_link != "" ? '<a class="btn btn-primary event-action-button" style="margin-right:0px;background:transparent !important;outline:none; box-shadow:none;" href=" ' . $payment_link . '" title="View Receipt"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></a>' : ''; ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <br />
            <br />
            <br />

        </div>
    <?php } ?>
</div>
<?php include('footer.php'); ?>


<script>
    $('#example').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        scrollX: false,

        lengthMenu: [
            [10, 25, 50, ],
            [10, 25, 50]
        ],

        buttons: [

            {
                extend: 'excel',
                filename: 'bill-list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }

        ],
    });

    function showPopup(id) {
        var exampleModal = $('#exampleModal_' + id);
        exampleModal.css('display', 'block');
        exampleModal.css('opacity', '1');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }

    function closePopup(id) {
        var exampleModal = $('#exampleModal_' + id);
        exampleModal.css('display', 'none');
        exampleModal.css('opacity', '0');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
    }
</script>
<script>
    $(document).ready(function() {
        $(".choosen").chosen({
            no_results_text: "Oops, nothing found!"
        });


        $('#generate_bill .child_menu').show();
        $('#generate_bill').addClass('nv active');
        $('.bill_list').addClass('active_cc');
        $('.right_col').addClass('active_right');

    });
</script>
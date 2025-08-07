<?php include('header.php'); ?>
<style type="text/css">
    .buttons-html5 {
        background-color: lightblue;
    }

    table.dataTable {
        width: 100% !important;
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
                    Assign Giftcard List
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
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Giftcard</th>
                                    <th>Giftcard Code</th>
                                    <th>Gender</th>
                                    <th>Offer Price</th>
                                    <th>Balance</th>
                                    <th>Min. Booking Amt.</th>
                                    <th>Allocated On</th>
                                    <th>Allocated By</th>
                                    <th>Redemption</th>
                                    <!-- <th>Receipt</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($asign_list)) {
                                    $i = 1;
                                    foreach ($asign_list as $asign_list_result) {
                                        $sold_by = $this->Salon_model->get_single_emp_details($asign_list_result->giftcard_added_by);
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php
                                                if ($asign_list_result->gift_card_status == '0') {
                                                    echo '<label class="label label-success">Active</label>';
                                                } elseif ($asign_list_result->gift_card_status == '1') {
                                                    echo '<label class="label label-warning">Used</label>';
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $asign_list_result->full_name ?></td>
                                            <td><?= $asign_list_result->customer_phone ?></td>
                                            <td>
                                                <button class="btn btn-sm" style="float:left; background-color: <?= $asign_list_result->bg_color; ?>; color:<?= $asign_list_result->text_color; ?>;"><?= $asign_list_result->gift_name ?></button>
                                            </td>
                                            <td><?= $asign_list_result->giftcard_customer_uid ?></td>
                                            <td><?= $asign_list_result->gender == '0' ? 'Male' : ($asign_list_result->gender == '1' ? 'Female' : '-'); ?></td>
                                            <td><?= $asign_list_result->gift_card_price ?></td>
                                            <td><?= $asign_list_result->gift_card_balance ?></td>
                                            <td><?= $asign_list_result->giftcard_min_amount ?></td>
                                            <td><?= date('d-m-y h:i A', strtotime($asign_list_result->created_on)) ?></td>
                                            <td><?= !empty($sold_by) ? $sold_by->full_name : '-'; ?></td>
                                            <td>
                                                <?php
                                                $rate_table = '';
                                                $redemptions = json_decode($asign_list_result->redemption_history, true);
                                                if (!empty($redemptions)) {
                                                    $rate_table .= '<table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr. No.</th>
                                                                                        <th>Redeem Amount</th>
                                                                                        <th>Redeemed By</th>
                                                                                        <th>Booking</th>
                                                                                        <th>Redeemed On</th>
                                                                                    </tr>
                                                                                </thead>    
                                                                                <tbody>';

                                                    for ($k = 0; $k < count($redemptions); $k++) {
                                                        if ($redemptions[$k] != "" && is_array($redemptions[$k]) && !empty($redemptions[$k])) {
                                                            $redemptions_by = '-';
                                                            if (isset($redemptions[$k]['used_customer_id']) && $redemptions[$k]['used_customer_id'] == $asign_list_result->customer_id) {
                                                                $redemptions_by = 'Self';
                                                            } else {
                                                                if (isset($redemptions[$k]['used_customer_id']) && $redemptions[$k]['used_customer_id'] != "") {
                                                                    $redemptions_by = $this->Salon_model->get_customer_details_all($redemptions[$k]['used_customer_id']);
                                                                    $redemptions_by = !empty($redemptions_by) ? $redemptions_by->full_name . ' [' . $redemptions_by->full_name . ']' : '-';
                                                                }
                                                            }
                                                            $rate_table .= '<tr>
                                                                                        <td>' . ($k + 1) . '</td>
                                                                                        <td>' . $redemptions[$k]['redeemed_amount'] . '</td>
                                                                                        <td>' . $redemptions_by . '</td>
                                                                                        <td><a target="_blank" href="' . base_url() . 'booking-list?id=' . $redemptions[$k]['booking_id'] . '" style="text-decoration:underline;">View</a></td>
                                                                                        <td>' . (!empty($redemptions[$k]['redeemed_on']) ? date('d-m-Y h:i A', strtotime($redemptions[$k]['redeemed_on'])) : '-') . '</td>
                                                                                    </tr>';
                                                        }
                                                    }

                                                    $rate_table .= '</tbody>
                                                                            </table>';
                                                } else {
                                                    $rate_table = '<p style="text-align:center;">Redemptions not available</p>';
                                                }
                                                ?>
                                                <button type="button" onclick="showPopup(<?= $asign_list_result->id; ?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?= $asign_list_result->id; ?>">
                                                    View
                                                </button>

                                            </td>
                                            
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <?php if (!empty($asign_list)) {
                foreach ($asign_list as $asign_list_result) {
            ?>
            <div class="modal fade" id="exampleModal_<?= $asign_list_result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?= $asign_list_result->id; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel_<?= $asign_list_result->id; ?>">Giftcard Redemptions</h5>
                            <button style="margin-top:-22px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?= $asign_list_result->id; ?>)">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="response_<?= $asign_list_result->id; ?>">
                                <?= $rate_table; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }} ?>
            <br />
            <br />
            <br />

        </div>
    <?php } ?>
</div>
<?php include('footer.php'); ?>

<script>
    $(document).ready(function() {
        $('#asign_membership .child_menu').show();
        $('#asign_membership').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.asign_giftcard_list').addClass('active_cc');
    });
</script>
<script>
    $(document).ready(function() {


        $('#example').DataTable({
            responsive: true,
            scrollX:true,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, ],
                [10, 25, 50]
            ],
            ordering: false,
            order: [],
            buttons: [

                {
                    extend: 'excel',
                    filename: 'asign-giftcard-list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }

            ],
        });


      
    });
</script>
<script>
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
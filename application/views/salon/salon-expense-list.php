<?php include('header.php'); ?>
<style type="text/css">
    .buttons-html5 {
        background-color: lightblue;
    }

    .status-column-hidden {
        display: none;
    }
    

    .status-column-hidden-visible {
        display: table-cell;
    }

    .dataTables_scrollHeadInner {
        width: 100% !important;
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
                    Expenses List
                </h3>
            </div>

            <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                               
                            </div>
                        </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <!-- <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div> -->
                    <div class="x_content">
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr class="">
                                    <th>
                                        <!-- <input type="checkbox" class="tableflat"> -->
                                        Sr.No
                                    </th>
                                    <th>Details</th>
                                    <th>Branch Name</th>
                                    <th>Category</th>
                                    <th>Given To</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <!-- <th class="status-column-hidden">Status</th>
                                                <th>Status</th> -->
                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (!empty($expense_list)) {
                                    $i = 1;
                                    foreach ($expense_list as $expense_list_result) {
                                        $expsense_details = $this->Salon_model->get_single_expense_details_single($expense_list_result->id);
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <button type="button" onclick="showPopup(<?= $expense_list_result->id; ?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?= $expense_list_result->id; ?>">
                                                    View
                                                </button>
                                                <div class="modal fade" id="exampleModal_<?= $expense_list_result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?= $expense_list_result->id; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel_<?= $expense_list_result->id; ?>">Expense Details</h5>
                                                                <button type="button" class="close" style="margin-top: -25px;" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?= $expense_list_result->id; ?>)">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="response_<?= $expense_list_result->id; ?>">
                                                                    <table id="table_shift_details_<?= $expense_list_result->id; ?>" class="table table_shift_details table-striped jambo_table" style="width:100% !important;">
                                                                        <thead>
                                                                            <th>Sr. No.</th>
                                                                            <th>Item Name</th>
                                                                            <th>Quantity</th>
                                                                            <th>Rate</th>
                                                                            <th>Total Amount</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $k = 1;
                                                                            if (!empty($expsense_details)) {
                                                                                foreach ($expsense_details as $expsense_details_result) {
                                                                            ?>
                                                                                    <tr>
                                                                                        <th><?= $k++; ?></th>
                                                                                        <th><?= $expsense_details_result->item_name; ?></th>
                                                                                        <th><?= $expsense_details_result->quantity; ?></th>
                                                                                        <th><?= $expsense_details_result->rate; ?></th>
                                                                                        <th><?= $expsense_details_result->total_amount; ?></th>
                                                                                    </tr>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <tr>
                                                                                    <th colspan="5" style="text-align:center;">Data not available</th>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $expense_list_result->branch_name ?></td>
                                            <td><?= $expense_list_result->expenses_name ?></td>
                                            <td><?= $expense_list_result->given_to ?></td>
                                            <td><?= $expense_list_result->payment_mode ?></td>
                                            <td><?= $expense_list_result->expense_amount ?></td>

                                            <td><?= $expense_list_result->expense_date != "" && $expense_list_result->expense_date != "0000-00-00" && $expense_list_result->expense_date != "1970-01-01" ? date("d-m-Y", strtotime($expense_list_result->expense_date)) : '-' ?></td>


                                            <!-- <td class="status-column-hidden">
                                                    <?php if ($expense_list_result->status == "1") { ?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $expense_list_result->id ?>/tbl_salon_expense">Active</a>  
                                                    <?php } else { ?>

                                                        <a  title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $expense_list_result->id ?>/tbl_salon_expense">Inactive</a> 
                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <?php if ($expense_list_result->status == "1") { ?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $expense_list_result->id ?>/tbl_salon_expense"><i  class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php } else { ?>

                                                        <a  title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $expense_list_result->id ?>/tbl_salon_expense"><i  class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php } ?>
                                                </td> -->
                                            <td>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $expense_list_result->id ?>/tbl_salon_expense"><i class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-salon-expense/<?= $expense_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>

                                            </td>
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
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 100]
        ],
        buttons: [{
            extend: 'excel',
            filename: 'salon-expense-list',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 7]
            },
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="K"]', sheet).attr('s', '2');
            }
        }],
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
        $('#expenses .child_menu').show();
        $('#expenses').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.salon-expense-list').addClass('active_cc');
    });
</script>
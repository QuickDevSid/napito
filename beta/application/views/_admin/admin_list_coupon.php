<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Coupon List
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="example" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Coupan Name</th>
                                                    <th>Coupan Code</th>
                                                    <th>Coupan Minimum Price</th>
                                                    <th>Coupan Offer Price</th>
                                                    <th>Coupan Expiry Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($coupon_code_list)) {
                                                    $i = 1;
                                                    foreach ($coupon_code_list as $coupon_code_list_result) {
                                                        ?>
                                                        <tr>
                                                            <td scope="row">
                                                                <?= $i++ ?>
                                                            </td>
                                                            <td><?= $coupon_code_list_result->coupon_name ?></td>
                                                            <td><?= $coupon_code_list_result->coupan_code ?></td>
                                                            <td>Rs.<?= $coupon_code_list_result->min_price ?></td>
                                                            <td>Rs.<?= $coupon_code_list_result->coupon_offers ?></td>
                                                            <td><?= $coupon_code_list_result->coupan_expiry ?></td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                                    href="<?= base_url() ?>admin_delete/<?= $coupon_code_list_result->id ?>/tbl_admin_coupon_code"><i
                                                                        class="fa-solid fa-trash"></i></a>

                                                                <a title="Edit" class="btn btn-success"
                                                                    href="<?= base_url() ?>admin_add_coupon/<?= $coupon_code_list_result->id ?>"><i
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

            <br />
            <br />
            <br />

        </div>
    </div>
    <?php include('footer.php');?>


<script>
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
       
        {
            extend: 'excel',
            filename: 'customer-care-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        
        
    ], 
});
</script>
</body>

</html>
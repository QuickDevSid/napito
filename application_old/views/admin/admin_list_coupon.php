<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Coupon List
					<a href="<?=base_url();?>admin_add_coupon" class="btn btn-primary pull-right">Add New</a>
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
                <form method="get" name="" id="" enctype="multipart/form-data">
                    <div class="row cc_row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Gender</label>
                            <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                <option value="">Select Gender</option>
                                <option value="0" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0'){?>selected="selected"<?php }?>>Male</option>
                                <option value="1" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1'){?>selected="selected"<?php }?>>Female</option>
                            </select>
                            <div class="error" id="filter_gender_error"></div>
                        </div> 
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <button type="submit" id="filter_submit" style="margin-top:25px;" class="btn btn-success">Search</button>
                            <?php if(isset($_GET['filter_gender'])){ ?>
                                <a id="filter_reset" style="margin-top:25px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>">Reset</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
                <div class="x_panel">
                    <div class="x_title">
                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="example" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Coupon Name</th>
                                                    <th>Coupon Code</th>
                                                    <th>Gender</th>
                                                    <th>Coupon Minimum Price</th>
                                                    <th>Coupon Offer Price</th>
                                                    <th>Coupon Expiry Date</th>
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
                                                              
                                                            <td><?= ($coupon_code_list_result->gender =='1') ? 'Female' : (($coupon_code_list_result->gender == '0') ? 'Male' : '-'); ?></td>
                                                            <td>Rs.<?= $coupon_code_list_result->min_price ?></td>
                                                            <td>Rs.<?= $coupon_code_list_result->coupon_offers ?></td>
                                                            <!-- <td><?= $coupon_code_list_result->coupan_expiry ?></td> -->
                                                            <td><?= date('d-m-Y', strtotime($coupon_code_list_result->coupan_expiry)) ?></td>

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
            $(".chosen-select").chosen({
                    
            });
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        {
            extend: 'excel',
            filename: 'coupon-list',
            exportOptions: {
                columns: [0,1,2,3,4,5] 
            }
        },
        
        
    ], 
});
</script>
</body>

</html>
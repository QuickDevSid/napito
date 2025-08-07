<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Coupon Code
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
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Coupan Name<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="coupon_name" id="coupon_name"
                                            value="<?php if (!empty($single)) {
                                                echo $single->coupon_name;
                                            } ?>"
                                            placeholder="Enter coupon name">
                                        <input type="hidden" name="id" id="id"
                                            value="<?php if (!empty($single)) {
                                                echo $single->id;
                                            } ?>">
                                        <label style="display: none;" id="coupon_name-error" class="error col-md-12"
                                            for="coupon_name"></label>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Coupan Code <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="coupan_code" id="coupan_code"
                                            value="<?php if (!empty($single)) {
                                                echo $single->coupan_code;
                                            } ?>"
                                            placeholder="Enter coupan code ">
                                        <label style="display: none;" id="coupan_code-error" class="error col-md-12"
                                            for="coupan_code"></label>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label style="">Coupon offer<b
                                                class="require">*</b></label>
                                        <input type="text" class="form-control" name="coupon_offers" id="coupon_offers"
                                            value="<?php if (!empty($single)) {
                                                echo $single->coupon_offers;
                                            } ?>"
                                            placeholder="Enter coupon offer">
                                        <label style="display: none;" id="coupon_offers-error" class="error col-md-12"
                                            for="coupon_offers"></label>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label style="">Coupon Expiry Date <b
                                                class="require">*</b></label>
                                        <input type="date" class="form-control" name="coupan_expiry" id="coupan_expiry"
                                            value="<?php if (!empty($single)) {
                                                echo $single->coupan_expiry;
                                            } ?>"
                                            placeholder="Enter coupan expiry date">
                                        <label style="display: none;" id="coupan_expiry-error" class="error col-md-12"
                                            for="coupan_expiry"></label>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
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
                                    <th>Coupan Name</th>
                                    <th>Coupan Code</th>
                                    <th>Coupan Offers</th>
                                    <th>Coupan Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($coupon_code_list)) {
                                    $i = 1;
                                    foreach ($coupon_code_list as $coupon_code_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $coupon_code_list_result->coupon_name ?></td>
                                            <td><?= $coupon_code_list_result->coupan_code ?></td>
                                            <td><?= $coupon_code_list_result->coupon_offers ?></td>
                                            <td><?= $coupon_code_list_result->coupan_expiry ?></td>
                                            <td>
                                                <?php if ($coupon_code_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $coupon_code_list_result->id ?>/tbl_coupon_code"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $coupon_code_list_result->id ?>/tbl_coupon_code"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $coupon_code_list_result->id ?>/tbl_coupon_code"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-coupon-code/<?= $coupon_code_list_result->id ?>"><i
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
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        $('#customer_form').validate({
            rules: {
                coupon_name: 'required',
                coupan_code: 'required',
                coupan_expiry: 'required',
                coupon_offers: 'required',
            },
            messages: {
                coupon_name: 'Please enter coupan name',
                coupan_code: 'Please enter coupan code',
                coupon_offers: 'Please enter coupon offers',
                coupan_expiry: 'Please select coupan expiry date',
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
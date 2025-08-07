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
                    Add Customer Discount
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


            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="discount_form" id="discount_form" enctype="multipart/form-data">
                                <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Select Days<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="days"  id="days">
                                            <option value=""></option>
                                            <option value="30"  <?php if (!empty($single) && $single->days == 30) echo 'selected="selected"'; ?>>30 days</option>
                                            <option value="60"  <?php if (!empty($single) && $single->days == 60) echo 'selected="selected"'; ?>>60 days</option>
                                            <option value="90"  <?php if (!empty($single) && $single->days == 90) echo 'selected="selected"'; ?>>90 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 120) echo 'selected="selected"'; ?>>120 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 150) echo 'selected="selected"'; ?>>150 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 180) echo 'selected="selected"'; ?>>180 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 210) echo 'selected="selected"'; ?>>210 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 240) echo 'selected="selected"'; ?>>240 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 270) echo 'selected="selected"'; ?>>270 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 300) echo 'selected="selected"'; ?>>300 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 330) echo 'selected="selected"'; ?>>330 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 370) echo 'selected="selected"'; ?>>370 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 400) echo 'selected="selected"'; ?>>400 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 430) echo 'selected="selected"'; ?>>430 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 460) echo 'selected="selected"'; ?>>460 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 490) echo 'selected="selected"'; ?>>490 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 520) echo 'selected="selected"'; ?>>520 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 550) echo 'selected="selected"'; ?>>550 days</option>
                                            <option value="120"  <?php if (!empty($single) && $single->days == 580) echo 'selected="selected"'; ?>>580 days</option>
                                        </select>
                                        <input type="hidden" name="id" id="id"
                                            value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Discount<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="discount" id="discount" placeholder="Enter discount value in %" value="<?php if (!empty($single)) {echo $single->discount;} ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>    
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <!-- <div class="clearfix"></div> -->
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Days</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($discount_list)) {
                                    $i = 1;
                                    foreach ($discount_list as $discount_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $discount_list_result->days?></td>
                                            <td><?= $discount_list_result->discount ?></td>
                                           
                                            <td>
                                                <?php if ($discount_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $discount_list_result->id ?>/tbl_discount_master"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $discount_list_result->id ?>/tbl_discount_master"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $discount_list_result->id?>/tbl_discount_master"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-customer-discount/<?= $discount_list_result->id ?>"><i
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
        $('#discount_form').validate({
            ignore:"",
            rules: {
                days: 'required',
               
                discount: {
                    required: true,
                    number: true,
                },
               
            },
            messages: {
                days: 'Please select days!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
               
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
      $(document).ready(function () {
			$('#services .child_menu').show();
			$('#services').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.add-customer-discount').addClass('active_cc');
		});
</script>
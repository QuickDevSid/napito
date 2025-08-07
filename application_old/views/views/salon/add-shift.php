<?php include('header.php'); ?>


</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Shift Master
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Shift Name <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="shift_name" id="shift_name" value="<?php if (!empty($single)) {echo $single->shift_name;} ?>" placeholder="Enter shift name">
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Shift In Time <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="shift_in_time" id="shift_in_time" value="<?php if (!empty($single)) {echo $single->shift_in_time;} ?>" placeholder="Enter in time">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Lunch Start Time <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="lunch_start_time" id="lunch_start_time" value="<?php if (!empty($single)) {echo $single->lunch_start_time;} ?>" placeholder="Enter in time">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Shift Out Time <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="shift_out_time" id="shift_out_time" value="<?php if (!empty($single)) {echo $single->shift_out_time;} ?>" placeholder="Enter out time">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Lunch Close Time <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="lunch_close_time" id="lunch_close_time" value="<?php if (!empty($single)) {echo $single->lunch_close_time;} ?>" placeholder="Enter out time">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>

            </div>



            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <h3>  Shift List</h3>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Shift Name</th>
                                    <th>Shift In Out</th>
                                    <th>Shift Out Out</th>
                                    <th>Lunch Open Time</th>
                                    <th>Lunch Close Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($shift_list)) {
                                    $i = 1;
                                    foreach ($shift_list as $shift_list_result) {
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $shift_list_result->shift_name ?></td>
                                            <td><?= $shift_list_result->shift_in_time ?></td>
                                            <td><?= $shift_list_result->shift_out_time ?></td>
                                            <td><?= $shift_list_result->lunch_start_time ?></td>
                                            <td><?= $shift_list_result->lunch_close_time ?></td>
                                            <td>
                                                <?php if ($shift_list_result->status == "1") { ?>
                                                    <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $shift_list_result->id ?>/tbl_shift_master"><i style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $shift_list_result->id ?>/tbl_shift_master"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $shift_list_result->id ?>/tbl_shift_master"><i class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary" href="<?= base_url() ?>add-shift/<?= $shift_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function() {
        $('#master_form').validate({
            rules: {
                shift_name: 'required',
                shift_in_time: 'required',
                shift_out_time: 'required',
                lunch_start_time: 'required',
                lunch_close_time: 'required',
            },
            messages: {
                shift_name: "Please enter shift name",
                shift_in_time: "Please enter shift in time",
                shift_out_time: "Please enter shift out time",
                lunch_start_time: "Please enter lunch start time",
                lunch_close_time: "Please enter lunch close time",
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#employee .child_menu').show();
        $('#employee').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_shift').addClass('active_cc');
    });
</script>
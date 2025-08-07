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
                    Add Reward Point
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
                                        <label>Rs Per Reward <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="rs_per_reward" id="rs_per_reward"
                                            value="<?php if (!empty($single)) {
                                                echo $single->rs_per_reward;
                                            } ?>"
                                            placeholder="Enter coupon name">
                                        <input class="input-content col-md-6 col-xs-12" type="hidden" name="id" id="id"
                                            value="<?php if (!empty($single)) {
                                                echo $single->id;
                                            } ?>">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Reward Point <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="reward_point" id="reward_point"
                                            value="<?php if (!empty($single)) {
                                                echo $single->reward_point;
                                            } ?>"
                                            placeholder="Enter coupan code ">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Select Gender <b class="require">*</b></label><br>
                                            <input type="radio" id="male"  value="0" <?= ($single && $single->gender == 0) ? 'checked' : ''; ?>>&nbsp&nbspMale
                                            <input type="radio" id="female"  value="1" <?= ($single && $single->gender == 1) ? 'checked' : ''; ?>>&nbsp&nbspFemale
                                            <label style="margin-top: 30px; display: none; position: absolute;margin-left: 0px;" for="gender" generated="true" class="error">Please enter coupon offers</label>
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
                                    <th>Rs Per Reward</th>
                                    <th>Reward Point</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reward_point_list)) {
                                    $i = 1;
                                    foreach ($reward_point_list as $reward_point_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $reward_point_list_result->rs_per_reward ?></td>
                                            <td><?= $reward_point_list_result->reward_point ?></td>
                                            <td>
                                                <?= $reward_point_list_result->gender == 0 ? "Male" : ($reward_point_list_result->gender == 1 ? "Female" : "Other"); ?>
                                            </td>

                                            <td>
                                                <?php if ($reward_point_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $reward_point_list_result->id ?>/tbl_reward_point"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $reward_point_list_result->id ?>/tbl_reward_point"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $reward_point_list_result->id ?>/tbl_reward_point"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>add-reward-point/<?= $reward_point_list_result->id ?>"><i
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
                    rs_per_reward: 'required',
                    reward_point: 'required',
                    gender: 'required',
                },
                messages: {
                    rs_per_reward: 'Please enter coupan name',
                    reward_point: 'Please enter coupan code',
                    gender: 'Please enter coupon offers',
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
            });
        });


    </script>
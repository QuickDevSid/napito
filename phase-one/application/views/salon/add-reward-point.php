<?php include('header.php'); ?>
<style type="text/css">
    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
        <?php
        if ($gst == "") { ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <li class="<?php if ($this->uri->segment(2) == "") { ?>active<?php } ?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Reward Point List</a>
                    </li>
                    <li class="<?php if ($this->uri->segment(2) != "") { ?>active<?php } ?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Reward Point</a>
                    </li>
                </ul><br>
            </div>

            <div class="tab-content">

                <div class="tab-pane <?php if ($this->uri->segment(2) == "") { ?>active<?php } ?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table  id="example" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Price Per Reward</th>
                                                    <th>Reward Point</th>
                                                    <th>Gender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($reward_point_list)) {
                                                    $i = 1;
                                                    foreach ($reward_point_list as $reward_point_list_result) {
                                                ?>
                                                        <tr>
                                                            <td scope="row">
                                                                <?= $i++ ?>
                                                            </td>
                                                            <td>Rs.<?= $reward_point_list_result->rs_per_reward ?></td>
                                                            <td><?= $reward_point_list_result->reward_point ?></td>
                                                            <td>
                                                                <?= $reward_point_list_result->gender == 0 ? "Male" : ($reward_point_list_result->gender == 1 ? "Female" : "Other"); ?>
                                                            </td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $reward_point_list_result->id ?>/tbl_reward_point"><i class="fa-solid fa-trash"></i></a>
                                                                <!-- <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-reward-point/<?= $reward_point_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a> -->
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

                <div class="tab-pane <?php if ($this->uri->segment(2) != "") { ?>active<?php } ?>" id="2">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="reward_point_form" id="reward_point_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Reward Point <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="reward_point" id="reward_point" value="1" placeholder="Enter reward point " readonly>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
                                                <option value="">Select gender</option>
                                                <?php if ($store_category->category == 0) { ?>
                                                    <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                <?php } ?>
                                                <?php if ($store_category->category == 1) { ?>
                                                    <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                <?php } ?>
                                                <?php if ($store_category->category == 2) { ?>
                                                    <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                    <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                    <!-- <option id="female" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>Unisex</option> -->
                                                <?php } ?>
                                            </select>
                                            <div class="dender_validation error" style="display: none;"></div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Price Per Reward <b class="require">*</b></label>
                                            <select class="form-control" name="rs_per_reward" id="rs_per_reward">
                                            <option value="">Select price per reward point</option>
                                                <option value="0.5"<?php if (!empty($single) && $single->rs_per_reward == 0.5) { echo ' selected'; } ?>>0.5</option>
                                                <option value="1"<?php if (!empty($single) && $single->rs_per_reward == 1) { echo ' selected'; } ?>>1</option>
                                                <option value="1.5"<?php if (!empty($single) && $single->rs_per_reward == 1.5) { echo ' selected'; } ?>>1.5</option>
                                                <option value="2"<?php if (!empty($single) && $single->rs_per_reward == 2) { echo ' selected'; } ?>>2</option>
                                                <option value="2.5"<?php if (!empty($single) && $single->rs_per_reward == 2.5) { echo ' selected'; } ?>>2.5</option>
                                                <option value="3"<?php if (!empty($single) && $single->rs_per_reward == 3) { echo ' selected'; } ?>>3</option>
                                                <option value="3.5"<?php if (!empty($single) && $single->rs_per_reward == 3.5) { echo ' selected'; } ?>>3.5</option>
                                                <option value="4"<?php if (!empty($single) && $single->rs_per_reward == 4) { echo ' selected'; } ?>>4</option>
                                                <option value="4.5"<?php if (!empty($single) && $single->rs_per_reward == 4.5) { echo ' selected'; } ?>>4.5</option>
                                                <option value="5"<?php if (!empty($single) && $single->rs_per_reward == 5) { echo ' selected'; } ?>>5</option>
                                            </select>
                                            <input autocomplete="off" class="input-content col-md-6 col-xs-12" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       <?php } ?>
</div>

<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function() {
        $('#reward_point_form').validate({
            rules: {
                rs_per_reward: {
                    required: true,
                    number: true,
                },
                reward_point: {
                    required: true,
                    number: true,
                },
                gender: 'required',
            },
            messages: {
                rs_per_reward: {
                    required: 'Please enter price per reward point!',
                    number: "Only number allowed!",
                },
                reward_point: {
                    required: 'Please enter reward point!',
                    number: "Only number allowed!",
                },
                gender: 'Please select gender!',
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

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.reward-setup').addClass('active_cc');
    });
</script>


<script>
 $("#gender").change(function () {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/check_reward_point_ajax",
        data: {
            'gender': $('#gender').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
        //    console.log(parsedData);
        if(parsedData.gender == $('#gender').val()){
           $("#btn_submit").hide();
           $(".dender_validation").show();
           $(".dender_validation").html("Reward point already added for this gender!");
        }
        else{
            $("#btn_submit").show(); 
            $(".dender_validation").hide(); 
        }
        }
    });
});
</script>

<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: false,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-reward-point',
                exportOptions: {
                    columns: [0,1,2,3] 
                }
            }
        ], 
    });
</script>
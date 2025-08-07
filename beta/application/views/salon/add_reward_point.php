<?php include('header.php'); ?>
<style type="text/css">
    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }
 }

    .status-column-hidden-visible {
          .status-column-hidden {
        display: none;
     display: table-cell;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
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
        <div class="row">

            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if(!isset($_GET['use_reward'])){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Reward Point List</a>
                    </li>
                    <li class="" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready to Use</a>
                    </li>
					<?php if(isset($_GET['use_reward']) && $_GET['use_reward'] != ""){?>
						<li class="active" id="tab_2">
							<a href="#2" data-toggle="tab">Add Reward Point</a>
						</li>
					<?php }?>
                </ul><br>
            </div>

            <div class="tab-content">
                <?php if (!empty($store_category)){
                        if($store_category->category == '2'){ ?>
                <form method="get" name="" id="" enctype="multipart/form-data" style="<?php if((isset($_GET['use_reward']) && $_GET['use_reward'] != "")){?>display:none;<?php }?>">
                    <div class="row cc_row">
                        <div  class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Gender</label>
                            <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                <option value="">Select Gender</option>
                                <option value="0" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0'){?>selected="selected"<?php }?>>Male</option>
                                <option value="1" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1'){?>selected="selected"<?php }?>>Female</option>
                            </select>
                            <div class="error" id="filter_gender_error"></div>
                        </div> 
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                            <?php if(isset($_GET['filter_gender'])){ ?>
                                <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=$this->uri->segment(2);?>">Reset</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                    <inout type="hidden" name="filter_gender" id="filter_gender" value="<?=$store_category->category;?>">
                <?php }} ?>
                <div class="tab-pane <?php if(!isset($_GET['use_reward'])){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table style="width: 100%;"  id="example" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Price Per Reward</th>
                                                    <th>Reward Point</th>
                                                    <th>Minimum Reward Required</th>
                                                    <th>Maximum Reward Required</th>
                                                    <th>Gender</th>
                                                    <th class="status-column-hidden">Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
												$added_coupon = array();
												if(!empty($reward_point_list)){
                                                    $i = 1;
                                                    foreach($reward_point_list as $reward_point_list_result){
														$added_coupon[]=$reward_point_list_result->reward_id;
                                                ?>
                                                        <tr>
                                                            <td scope="row">
                                                                <?= $i++ ?>
                                                            </td>
                                                            <td>Rs.<?=$reward_point_list_result->rs_per_reward?></td>
                                                            <td><?=$reward_point_list_result->reward_point?></td>
                                                            <td><?=$reward_point_list_result->minimum_reward_required?></td>
                                                            <td><?=$reward_point_list_result->maximum_reward_required?></td>
                                                            <td>
                                                                <?= $reward_point_list_result->gender == 0 ? "Male" : ($reward_point_list_result->gender == 1 ? "Female" : "Other"); ?>
                                                            </td>
                                                            <td class="status-column-hidden">
                                                            <?php if($reward_point_list_result->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$reward_point_list_result->id?>/tbl_reward_point">Active</a>  
                                                            <?php }else{?> 
                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$reward_point_list_result->id?>/tbl_reward_point">Inactive</a> 
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php if($reward_point_list_result->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$reward_point_list_result->id?>/tbl_reward_point"><i class="fa-solid fa-toggle-on"></i></a>  
                                                            <?php }else{?> 
                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$reward_point_list_result->id?>/tbl_reward_point"><i class="fa-solid fa-toggle-off"></i></a> 
                                                            <?php }?>
                                                        </td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?=$reward_point_list_result->id?>/tbl_reward_point"><i class="fa-solid fa-trash"></i></a>
                                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-reward-point?use_reward=1&edit=<?=$reward_point_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
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
				<div class="tab-pane" id="3">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                
                                        <table style="width: 100%!important;"  id="example1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Price Per Reward</th>
                                                    <th>Reward Point</th>
													<th>Minimum Reward Required</th>
                                                    <th>Maximum Reward Required</th>
                                                    <th>Gender</th>
                                                    
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($ready_reward)){
                                                    $i = 1;
                                                    foreach($ready_reward as $ready_reward_result){ 
												?>
													<tr>
														<td scope="row"><?=$i++?></td>
														<td>Rs.<?=$ready_reward_result->rs_per_reward?></td>
														<td><?=$ready_reward_result->reward_point?></td>
														<td><?=$ready_reward_result->minimum_reward_required?></td>
														<td><?=$ready_reward_result->maximum_reward_required?></td>
														<td>
															<?php if($ready_reward_result->gender == 0){ echo "Male";}else{ echo "Female";}?>
														</td>	
                                                        
                                                        
														<td>
														   <?php if(!in_array($ready_reward_result->id,$added_coupon)){?>
															<a title="Coupon Setup" class="btn btn-primary" href="<?=base_url()?>add-reward-point?use_reward=1&value=<?=$ready_reward_result->id?>">Use This Reward</a>
															<?php }else{?>
															<a title="Coupon Added" class="btn btn-info" href="javascript:void(0)">Reward Used</a> 
															<?php }?> 
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

                <div class="tab-pane <?php if((isset($_GET['use_reward']) && $_GET['use_reward'] != "") || (isset($_GET['edit']) && $_GET['edit'] != "")){?>active<?php }?>" id="2">
					<?php 
						$reward_id = "0";
						$single_setup_coupn = array();
						if(!empty($single_ready)){
							$single_setup_reward = $single_ready;
							$reward_id = $single_ready->id;
						}else if(!empty($single_reward)){ 
							$single_setup_reward = $single_reward;
							$reward_id = $single_reward->reward_id;
						} 
					?>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="reward_point_form" id="reward_point_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Reward Point <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="reward_point" id="reward_point" value="1" placeholder="Enter reward point " readonly>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gender<b class="require">*</b></label>
                                            <input type="hidden" class="form-control" name="gender" id="gender" value="<?php if(!empty($single_setup_reward)){ echo $single_setup_reward->gender;}?>">
                                            <input type="text" readonly class="form-control" name="gender_label" id="gender_label" value="<?php if(!empty($single_setup_reward) && $single_setup_reward->gender == "0"){ echo "Male";}else{ echo "Female";}?>"> 
                                            <div class="dender_validation error" style="display: none;"></div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Price Per Reward <b class="require">*</b></label>
                                            <select class="form-control" name="rs_per_reward" id="rs_per_reward">
                                            <option value="">Select price per reward point</option>
                                                <option value="0.5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 0.5) { ?>selected="selected"<?php }?>>0.5</option>
                                                <option value="1"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 1) { ?>selected="selected"<?php }?>>1</option>
                                                <option value="1.5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 1.5) {?>selected="selected"<?php }?>>1.5</option>
                                                <option value="2"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 2) { ?>selected="selected"<?php }?>>2</option>
                                                <option value="2.5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 2.5) {?>selected="selected"<?php }?>>2.5</option>
                                                <option value="3"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 3) { ?>selected="selected"<?php }?>>3</option>
                                                <option value="3.5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 3.5) { ?>selected="selected"<?php }?>>3.5</option>
                                                <option value="4"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 4) { ?>selected="selected"<?php }?>>4</option>
                                                <option value="4.5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 4.5) { ?>selected="selected"<?php }?>>4.5</option>
                                                <option value="5"<?php if (!empty($single_setup_reward) && $single_setup_reward->rs_per_reward == 5) { ?>selected="selected"<?php }?>>5</option>
                                            </select>
                                            <input autocomplete="off" class="input-content col-md-6 col-xs-12" type="hidden" name="id" id="id" value="<?php if (!empty($single_setup_reward) && isset($_GET['edit'])){ echo $single_setup_reward->id;}?>">
                                            <input autocomplete="off" class="input-content col-md-6 col-xs-12" type="hidden" name="reward_id" id="reward_id" value="<?=$reward_id;?>">
                                        </div> 
										  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label>Minimum Required Reward to use <b class="require">*</b></label>
											<input autocomplete="off" type="text" class="form-control" name="minimum_reward_required" id="minimum_reward_required"  placeholder="Enter minimum required for use" value="<?php if(!empty($single_setup_reward)){ echo $single_setup_reward->minimum_reward_required ;}?>">
										</div>
										  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label>Maximum Reward can be use <b class="require">*</b></label>
											<input autocomplete="off" type="text" class="form-control" name="maximum_reward_required" id="maximum_reward_required"  placeholder="Enter maximum reward can be use" value="<?php if(!empty($single_setup_reward)){ echo $single_setup_reward->maximum_reward_required;}?>">
										</div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
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
		<?php }?>
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
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-reward-point',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6] 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }
        ], 
    });

    $('#example1').DataTable({ 
        dom: 'Blfrtip',
        scrollX:true,
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'use-reward-point',
                exportOptions: {
                    columns: [0,1,2,3,4,5] 
                }
                
            }
        ], 
    });
</script>
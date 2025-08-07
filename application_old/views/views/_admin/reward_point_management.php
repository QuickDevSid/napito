<?php include('header.php');?>
<style type="text/css">
.input-content-option{
    height: 33px;
    width: 570px;
   
}
</style>

  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Rewards Point Management              
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
                                <div class="x_content">
                                    <form method="post" name="reward_point_form" id="reward_point_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Gender<b class="require">*</b></label>
                                                <select class="form-control" name="gender" id="gender">
													<option value="">Select Gender</option>
													<option value="0">Male</option>
													<option value="1">Female</option>
												</select>

                                                <div class="error" id="facility_name_error"></div>
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                            </div>
											<div class="form-group col-md-4 col-sm-4 col-xs-12">
												<label>Reward Point <b class="require">*</b></label>
												<input autocomplete="off" type="text" class="form-control" name="reward_point" id="reward_point" value="1" placeholder="Enter reward point " readonly>
											</div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
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
                                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button style="margin-top: 30px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>  
                            </div>
                        </div>
                    </div>



                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

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
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>admin_delete/<?= $reward_point_list_result->id ?>/tbl_admin_reward_point"><i class="fa-solid fa-trash"></i></a>
                                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>reward_point_management/<?= $reward_point_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                	$id= '0';
                	if($this->uri->segment(2) != ""){
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
	 $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
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







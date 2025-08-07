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

    .status-column-hidden {
        display: none;
    }

    .status-column-hidden-visible {
        display: table-cell;
    }
    table.dataTable{
        width: 100% !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
        <div class="clearfix"></div>
        <?php
        if($gst == ""){?>
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
        <?php }else{?>
        <div class="row">

            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if(!isset($_GET['use_coupon'])){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">My Coupon List</a>
                    </li>
                    <li class="" id="tab_3">
                        <a href="#3" data-toggle="tab">Ready to use Coupon</a>
                    </li>
					<?php if(isset($_GET['use_coupon']) && $_GET['use_coupon'] != ""){?>
						<li class="<?php if(isset($_GET['use_coupon']) && $_GET['use_coupon'] != ""){?>active<?php }?>" id="tab_2">
							<a href="#2" data-toggle="tab">Coupon Setting</a>
						</li>
					<?php }?>

                </ul><br>
            </div>

            <div class="tab-content">

                <div class="tab-pane <?php if(!isset($_GET['use_coupon'])){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Coupan Name</th>
                                                    <th>Coupan Code</th>
                                                    <th>Gender</th>
                                                    <th>Coupan Minimum Price</th>
                                                    <th>Coupan Offer Price</th>
                                                    <th>Coupan Expiry Date</th>
                                                    <th class="status-column-hidden">Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
												$added_coupon = array();
												if (!empty($coupon_code_list)) {
                                                    $i = 1;
                                                    foreach($coupon_code_list as $coupon_code_list_result){
														    $added_coupon[]=$coupon_code_list_result->coupon_id;
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
                                                            <td><?= ($coupon_code_list_result->coupan_expiry != "" && $coupon_code_list_result->coupan_expiry != null && $coupon_code_list_result->coupan_expiry != '1970-01-01' && $coupon_code_list_result->coupan_expiry != '0000-00-00') ? date('d-m-Y',strtotime($coupon_code_list_result->coupan_expiry)) : '-'; ?></td>
                                                            
                                                            <td class="status-column-hidden">
                                                                <?php if($coupon_code_list_result->status == "1"){?>
                                                                    <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$coupon_code_list_result->id?>/tbl_coupon_code">Active</a>  
                                                                <?php }else{?> 
                                                                    <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$coupon_code_list_result->id?>/tbl_coupon_code">Inactive</a> 
                                                                <?php }?>
                                                            </td>
                                                            <td>
                                                                <?php if($coupon_code_list_result->status == "1"){?>
                                                                    <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$coupon_code_list_result->id?>/tbl_coupon_code"><i class="fa-solid fa-toggle-on"></i></a>  
                                                                <?php }else{?> 
                                                                    <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$coupon_code_list_result->id?>/tbl_coupon_code"><i class="fa-solid fa-toggle-off"></i></a> 
                                                                <?php }?>
                                                            </td>

                                                            <td>
                                                                <a title="Delete" class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                                    href="<?= base_url() ?>delete/<?= $coupon_code_list_result->id ?>/tbl_coupon_code"><i
                                                                        class="fa-solid fa-trash"></i></a>

                                                                <a title="Edit" class="btn btn-success"
                                                                    href="<?=base_url()?>add-coupon-code?use_coupon=1&edit=<?=$coupon_code_list_result->id?>"><i
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
				<div class="tab-pane" id="3">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Coupan Name</th>
                                                    <th>Coupan Code</th>
                                                    <th>Gender</th>
                                                    <th>Coupan Minimum Price</th>
                                                    <th>Coupan Offer Price</th> 
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($ready_coupon)){
                                                    $i = 1;
                                                    foreach($ready_coupon as $ready_coupon_result){
                                                        if(date('Y-m-d') <= date('Y-m-d',strtotime($ready_coupon_result->coupan_expiry))){
                                                ?>
												<tr>
													<td scope="row">
														<?= $i++ ?>
													</td>
													<td><?=$ready_coupon_result->coupon_name?></td>
													<td><?=$ready_coupon_result->coupan_code?></td>
                                                    <td><?= ($ready_coupon_result->gender =='1') ? 'Female' : (($ready_coupon_result->gender == '0') ? 'Male' : '-'); ?></td>
													<td>Rs.<?=$ready_coupon_result->min_price?></td>
													<td>Rs.<?=$ready_coupon_result->coupon_offers?></td> 
													<td>	
														<?php if(!in_array($ready_coupon_result->id,$added_coupon)){?>
														<a title="Coupon Setup" class="btn btn-primary" href="<?=base_url()?>add-coupon-code?use_coupon=1&value=<?=$ready_coupon_result->id?>">Use This Coupon</a>
														<?php }else{?>
														<a title="Coupon Added" class="btn btn-info" href="javascript:void(0)">Coupon Used</a> 
														<?php }?> 
													</td>
												</tr>
											<?php }}
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

                <div class="tab-pane <?php if((isset($_GET['use_coupon']) && $_GET['use_coupon'] != "") || (isset($_GET['edit']) && $_GET['edit'] != "")){?>active<?php }?>" id="2">
					<?php 
					$coupon_id = "0";
					$single_setup_coupn = array();
					if(!empty($setup_coupon)){
						$single_setup_coupn = $setup_coupon;
                    // echo "hii<pre>";print_r($setup_coupon);exit;

						$coupon_id = $setup_coupon->id;
					}else if(!empty($single_coupon)){ 
						$single_setup_coupn = $single_coupon;
						$coupon_id = $single_coupon->coupon_id;
					}

					?>
                        <div class="x_panel">
                            <div class="x_content">
                                <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupan Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupon_name" id="coupon_name" value="<?php if (!empty($single_setup_coupn)) { echo $single_setup_coupn->coupon_name; } ?>" placeholder="Enter coupon name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single_setup_coupn) && isset($_GET['edit'])) { echo $single_setup_coupn->id; } ?>">
                                            <input autocomplete="off" type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $coupon_id;?>">
                                        </div>

                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupan Code <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupan_code" id="coupan_code" value="<?php if (!empty($single_setup_coupn)) { echo $single_setup_coupn->coupan_code; } ?>" placeholder="Enter coupan code ">
                                            <div class="error" id="coupan_code_error"></div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Minimum Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="min_price" id="min_price" value="<?php if (!empty($single_setup_coupn)) { echo $single_setup_coupn->min_price; } ?>" placeholder="Enter coupon minimum price">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label> Gender<b class="require">*</b></label>
                                            <input type="hidden" class="form-control" name="gender" id="gender" value="<?php if (!empty($single_setup_coupn)) { echo $single_setup_coupn->gender;} ?>">
                                            <input type="text" readonly class="form-control" name="gender_name" id="gender_name" value="<?php if(!empty($single_setup_coupn) && $single_setup_coupn->gender=="0"){ echo "Male";}else{if(!empty($single_setup_coupn) && $single_setup_coupn->gender=="1"){ echo "Female";}else{ echo ''; }}?>"> 
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Offer Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupon_offers" id="coupon_offers" value="<?php if (!empty($single_setup_coupn)) { echo $single_setup_coupn->coupon_offers; } ?>" placeholder="Enter coupon offer price">
                                        </div>

                                        <?php 
                                        // echo "hii<pre>";print_r($single_setup_coupn);exit;
                                        ?>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Expiry Date <b class="require">*</b></label>
                                            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="coupan_expiry" id="coupan_expiry" 
                                            value="<?php 
                                            if (!empty($single_setup_coupn) && $single_setup_coupn->coupan_expiry != "" && $single_setup_coupn->coupan_expiry != null) 
                                            { 
                                                echo ($single_setup_coupn->coupan_expiry == "0000-00-00") ? "-" : date('d-m-Y',strtotime($single_setup_coupn->coupan_expiry));
                                            }  ?>" placeholder="Enter Coupon Expiry Date">
                                        

                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                        </div>
                                    </div>    
                                </form> 
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
  $("#coupan_expiry").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    minDate: 0, 
    maxDate: "+10Y", 
    yearRange: "-100:+10"

});

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Please enter aphanumeric characters");

    $(document).ready(function () {
        $('#customer_form').validate({
            rules: {
                coupon_name: 'required',
                coupan_code: {
                    required: true,
                    alphanumeric: true,
                },
                coupon_offers: {
                    required: true,
                    number: true,
                },
                min_price: {
                    required: true,
                    number: true,
                },
                coupan_expiry: 'required',
                gender: 'required',
            },
            messages: {
                coupon_name: 'Please enter coupan name!',
                coupan_code: {
                    required: 'Please enter coupan code!',
                    alphanumeric: "Please enter aphanumeric characters!",
                },
                coupon_offers: {
                    required: 'Please enter coupon offer price!',
                    number: "Only number allowed!",
                },
                min_price: {
                    required: 'Please enter coupon minimum price!',
                    number: "Only number allowed!",
                },
                coupan_expiry: 'Please select coupan expiry date!',
                gender: 'Please select gender!',
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
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.coupon-setup').addClass('active_cc');
    });
</script>
<script>
    $("#coupan_code").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_coupan_code",
		data:{'coupan_code':$("#coupan_code").val(),'id':'<?=$id?>'},
		success: function(data){
           
                var code = $("#coupan_code").val();
                var isValid = true;

                for (var i = 0; i < code.length; i++) {
                    if (code[i] !== "0") {
                        isValid = false;
                        break;
                    }
                }
                if(code !== ""){
                   
                    if (!isValid) {
                        if(data == "0"){
                            $("#coupan_code_error").html('');
                            $("#submit").show();
                        }else{
                            $("#coupan_code_error").html('This code is already added for another offer');
                            $("#submit").hide();
                        }
                    } else {
                        $("#coupan_code_error").html('Please enter a valid code!');
                        $("#submit").hide();
                    }
                }
		},  
		
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
                filename: 'add-coupan-code',
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
        responsive: false,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'use-coupan-code',
                exportOptions: {
                    columns: [0,1,2,3,4] 
                }
               
            }
        ], 
    });
</script>
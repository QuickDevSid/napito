<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    

    .chosen-select {
        height: 35px !important;
        border-radius: 5px !important;
        border: solid gray 1px !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
        <div class="page-title">
            <div>
                <h3>
                    Add Services
                </h3>
            </div>

            <div class="title_right">
                
            </div>
        </div>

                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="service_form" id="service_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Select Catagory <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select"
                                            name="category" id="category">
                                            <option value="" class="">Select</option>
                                            <?php if (!empty($catagory)) {
                                                foreach ($catagory as $sup_catagory_result) { ?>

                                                    <option value="<?= $sup_catagory_result->id ?>" <?php if (!empty($single) && $single->catagory == $sup_catagory_result->id) { ?>selected="selected" <?php } ?>>
                                                        <?= $sup_catagory_result->services_name ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Select Sub Catagory <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select"
                                            name="sub_catagory" id="sub_catagory">
                                            <option value="">Select Sub Category</option>
                                            <?php if (!empty($sub_category)) {
                                                foreach ($sub_category as $sub_catagory_result) { ?>

                                                    <option value="<?= $sub_catagory_result->id ?>" <?php if (!empty($single) && $single->sub_catagory == $sub_catagory_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $sub_catagory_result->sub_catagory ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" id="thirdCategoryField" style="display: none;">
                                        <label>Select Third Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="third_catagory" id="third_catagory">
                                            <option value="">Select Third Category</option>
                                            <?php
                                            if (!empty($third_category)) {
                                                foreach ($third_category as $third_catagory_result) {
                                            ?>
                                                <option value="<?= $third_catagory_result->id ?>" <?php if (!empty($single) && $single->third_catagory == $third_catagory_result->id) { ?>selected="selected"<?php } ?>>
                                                    <?= $third_catagory_result->third_catagory ?>
                                                </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Description</label>
                                        <input class="form-control" type="text" class="form-control" name="description"
                                            id="description" value="<?php if (!empty($single)) {
                                                echo $single->description;
                                            } ?>" placeholder="Enter service description">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Upload Image <b class="require">*</b></label>
                                        <input class="form-control" type="file" accept=".png, .jpg, .jpeg .pdf"
                                        class="form-control" name="service_image" id="service_image" value="<?php if (!empty($single)) {
                                            echo $single->service_image;
                                        } ?>">
                                    </div>   
                                    <!-- <div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Loan Deduct From Salary<b class="require">*</b></label>
										<select name="loan_deduct" id="loan_deduct" class="form-control">
											<option value="">Please Select Yes or No</option>
											<option value="Yes">Yes</option>
											<option value="No">No</option>
										</select>
									</div> -->
                                </div> 
                                <div class="row third-category-box" style="display: none;">
                                    <!-- <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Select Service <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select"
                                            name="service_name" id="service_name">
                                            <option value="" class="">Select</option>
                                            <?php if (!empty($service_name)) {
                                                foreach ($service_name as $service_name_result) { ?>

                                                    <option value="<?= $service_name_result->id ?>" <?php if (!empty($single) && $single->service_name == $service_name_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $service_name_result->service ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div> -->
                                
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Service time <b class="require">*</b></label>
                                        <input class="form-control" type="text" class="form-control" name="service_time"
                                            id="service_time" value="<?php if (!empty($single)) {
                                                echo $single->service_time;
                                            } ?>" placeholder="Enter service time">
                                    </div>
                                
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Service Price <b class="require">*</b></label>
                                        <input class="form-control" type="text" class="form-control" name="service_price"
                                            id="service_price" value="<?php if (!empty($single)) {
                                                echo $single->service_price;
                                            } ?>" placeholder="Enter service price">
                                    </div>
                                
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Service Discount</label>
                                        <input class="form-control" type="text" class="form-control" name="service_discount"
                                            id="service_discount" value="<?php if (!empty($single)) {
                                                echo $single->service_discount;
                                            } ?>" placeholder="Enter service discount">
                                    </div>
                                
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Reward point</label>
                                        <input class="form-control" type="text" class="form-control" name="reward_point"
                                            id="reward_point" value="<?php if (!empty($single)) {
                                                echo $single->reward_point;
                                            } ?>" placeholder="Enter service reward point">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 35px; margin-left: 25px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->
                    </div>
                </div>
        
        <div class="row">    
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_title">
                    <h3>Service List</h3>
                </div>
                            <div class="x_panel">
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Service Name</th>
                                                <th>Service time</th>
                                                <th>Service Price</th>
                                                <th>Service Discount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($salon_service_list)){
                                        		$i=1;
                                        			foreach($salon_service_list as $salon_service_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$salon_service_list_result->category?></td>
                                                <td><?=$salon_service_list_result->service_discount?></td>
                                                <td><?=$salon_service_list_result->service_name?></td>
                                                <td><?=$salon_service_list_result->service_time?></td>
                                                <td><?=$salon_service_list_result->service_price?></td>
                                                <td><?=$salon_service_list_result->service_discount?></td>
                                                <td>
                                                    <?php if($salon_service_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$salon_service_list_result->id?>/tbl_salon_service"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$salon_service_list_result->id?>/tbl_salon_service"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                	<a  title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$salon_service_list_result->id?>/tbl_salon_service"><i class="fa-solid fa-trash"></i></a>	

                                                	<a  title="Edit" class="btn btn-primary" href="<?=base_url()?>add-salon-service/<?=$salon_service_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                                                </td>
                                            </tr>
                                        <?php }}?>
                                        </tbody>
                                    </table>
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
        $('#service_form').validate({
            ignore: "",
            rules: {
                category: 'required',
                sub_catagory: 'required',
                service_name: 'required',
                service_image: 'required',
                service_time: 'required',
                service_price: 'required',
            },
            messages: {
                category: 'Please enter category',
                sub_catagory: 'Please enter sub category',
                service_name: 'Please enter service name',
                service_image: 'Please upload image',
                service_time: 'Please enter service time',
                service_price: 'Please enter service price',
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
    $("#category").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_sub_category",
            data: { 'category': $("#category").val() },
            success: function (data) {
                $("#sub_catagory").empty();
                $('#sub_catagory').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#sub_catagory').append('<option value="' + d.id + '">' + d.sub_catagory + '</option>');
                });
                $('#sub_catagory').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script>
    $('#loan_deduct').change(function () {
		if ($('#loan_deduct').val() == 'Yes') {
			$('.third-category-box').show();
			$('#deduct_amt').attr('required', true);
		} else if ($('#loan_deduct').val() == 'No') {
			$('.third-category-box').hide();
			$('#deduct_amt').attr('required', false);
		}
	});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $("#sub_catagory").change(function () {
        if ($("#sub_catagory option:selected").val() === "has_third_category") {
            $("#thirdCategoryField").show();
        } else {
            $("#thirdCategoryField").hide();
        }
    });
});
</script>

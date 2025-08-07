<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

     /* {
        height: 35px;
        width: 590px;
        border-radius: 5px;
        border: solid gray 1px;
    } */

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
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select"
                                            name="category" id="category">
                                            <option value="" class="">Select</option>
                                            <?php if (!empty($category)) {
                                                foreach ($category as $sup_category_result) { ?>

                                                    <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php } ?>>
                                                        <?= $sup_category_result->sup_category ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Select Sub Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select"
                                            name="sub_category" id="sub_category">
                                            <option value="">Select Sub Category</option>
                                            <?php if (!empty($sub_category)) {
                                                foreach ($sub_category as $sub_category_result) { ?>

                                                    <option value="<?= $sub_category_result->id ?>" <?php if (!empty($single) && $single->sub_category == $sub_category_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $sub_category_result->sub_category ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" id="thirdCategoryField">
                                        <label>Select Third Category</label>
                                        <select class="form-select form-control chosen-select" name="third_category" id="third_category">
                                            <option value="">Select Third Category</option>
                                            <?php
                                            if (!empty($get_third_category)) {
                                                foreach ($get_third_category as $get_third_category) {
                                            ?>
                                                <option value="<?= $get_third_category->id ?>" <?php if (!empty($single) && $single->third_category == $get_third_category->id) { ?>selected="selected"<?php } ?>>
                                                    <?= $get_third_category->third_category ?>
                                                </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Description</label>
                                        <input class="form-control" type="text" class="form-control" name="description"
                                            id="description" value="<?php if (!empty($single)) {
                                                echo $single->description;
                                            } ?>" placeholder="Enter service description">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Upload Image <b class="require">*</b></label>
                                        <input class="form-control" type="file" accept=".png, .jpg, .jpeg .pdf"
                                        class="form-control" name="service_image" id="service_image" value="<?php if (!empty($single)) {
                                            echo $single->service_image;
                                        } ?>">
                                    </div>   
                                </div> 
                                <div class="row third-category-box" style="display: none;">
                                    <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                                
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Service time <b class="require">*</b></label>
                                        <input class="form-control" type="text" class="form-control" name="service_time"
                                            id="service_time" value="<?php if (!empty($single)) {
                                                echo $single->service_time;
                                            } ?>" placeholder="Enter service time">
                                    </div>
                                
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Service Price <b class="require">*</b></label>
                                        <input class="form-control" type="text" class="form-control" name="service_price"
                                            id="service_price" value="<?php if (!empty($single)) {
                                                echo $single->service_price;
                                            } ?>" placeholder="Enter service price">
                                    </div>
                                
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Service Discount</label>
                                        <input class="form-control" type="text" class="form-control" name="service_discount"
                                            id="service_discount" value="<?php if (!empty($single)) {
                                                echo $single->service_discount;
                                            } ?>" placeholder="Enter service discount">
                                    </div>
                                
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Reward point</label>
                                        <input class="form-control" type="text" class="form-control" name="reward_point"
                                            id="reward_point" value="<?php if (!empty($single)) {
                                                echo $single->reward_point;
                                            } ?>" placeholder="Enter service reward point">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-top: 35px; margin-left: 25px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    <div>
                                <div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>
        
        <div class="row">    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#service_form').validate({
            ignore: "",
            rules: {
                category: 'required',
                sub_category: 'required',
                service_name: 'required',
                service_image: 'required',
                service_time: 'required',
                service_price: 'required',
            },
            messages: {
                category: 'Please enter category',
                sub_category: 'Please enter sub category',
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
                // alert(data);
                $("#sub_category").empty();
                $('#sub_category').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#sub_category').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script>
$("#sub_category").change(function () {
    var sup_category = $("#category").val();
    var sub_category = $("#sub_category").val();

    if (sup_category && sub_category) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_third_category_options",
            data: { 'sup_category': sup_category, 'sub_category': sub_category },

            success: function (data) {
                
                var opts = JSON.parse(data);

                $("#third_category").empty();
                $('#third_category').append('<option value="">Select Third Category</option>');

                if (opts.length > 0) {
                    $.each(opts, function (i, d) {
                        $('#third_category').append('<option value="' + d.id + '">' + d.third_category + '</option>');
                    });

                    $('#third_category').css('display', 'block');
                } else {
                    $('#third_category').css('display', 'none');
                }

                $('#third_category').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});
$(document).ready(function () {
    $('#third_category').css('display', 'none');
});
</script>

<script>
      $(document).ready(function () {
			$('#services .child_menu').show();
			$('#services').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.add_salon_service').addClass('active_cc');
		});
</script>





<!-- <script>
$(document).ready(function () {
    $("#sub_category").change(function () {
        if ($("#sub_category option:selected").val() === "has_third_category") {
            $("#thirdCategoryField").show();
        } else {
            $("#thirdCategoryField").hide();
        }
    });
});
</script> -->

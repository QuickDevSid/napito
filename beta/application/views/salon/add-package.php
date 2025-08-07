<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .chosen-choices {
        height: 33px !important;

    }

    .error {
        color: red;
        float: left;
       
    }
	label{
		display:block;
	}
	.color_input{
	  display: block;
	  width: 17%;
	  float: left;
	  height: 40px !important;
	}
	.color_value_input{
		display: block;
		width: 75%;
		float: left;
		height: 40px !important;
		padding-left: 10px;
		border-radius: 2px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
	.text_color_input{
	  display: block;
	  width: 17%;
	  float: left;
	  height: 40px !important;
	}
	.button_text_color_input{
		display: block;
		width: 75%;
		float: left;
		height: 40px !important;
		padding-left: 10px;
		border-radius: 2px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}

</style>

<!-- page content --> 
<div class="right_col" role="main">
        <div class="clearfix"></div>
        <?php
        if($gst == ""){?>
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
        <?php }else{?>
        <div class="row">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="<?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Package List</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Package</a>
                    </li>
                </ul><br>
            </div>
            <div class="tab-content">


                <div class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Package Name</th>
                                                    <th>Services</th>
                                                    <th>Product Name</th>
                                                    <th>Regular Price</th>
                                                    <th>Discount</th>
                                                    <th>Amount</th>
                                                    <th>Reward Point</th>
                                                    <th>Package Expiry Number </th>
                                                    <th>Package Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($package_list)){
                                                    $i=1;
                                                        foreach($package_list as $package_list_result){ 
                                                            $service_name=$this->Salon_model->get_selected_service_name_for_offer($package_list_result->service_name);
                                                            $product_name=$this->Salon_model->get_selected_product_name_for_offer($package_list_result->product_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$package_list_result->package_name?></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($service_name)) { 
                                                                $firstService = true;
                                                                foreach($service_name as $service_name_result) {
                                                                    if (!$firstService) {
                                                                        echo " + ";
                                                                    }
                                                                    echo $service_name_result->service_name;
                                                                    $firstService = false; 
                                                                }
                                                                // echo ".";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($product_name)) { 
                                                                $firstService = true;
                                                                foreach($product_name as $product_name_result) {
                                                                    if (!$firstService) {
                                                                        echo " + ";
                                                                    }
                                                                    echo $product_name_result->product_name;
                                                                    $firstService = false; 
                                                                }
                                                                // echo ".";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?=$package_list_result->actual_price?></td>

                                                    <?php if($package_list_result->discount_in == 0): ?>
                                                        <td><?=$package_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$package_list_result->discount?></td>
                                                    <?php endif; ?>


                                                    <td><?=$package_list_result->amount?></td>
                                                    <td><?=$package_list_result->reward_point?></td>
                                                    <td><?=$package_list_result->count_value?> <?=$package_list_result->count_type?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?=$package_list_result->bg_color;?>; color:<?=$package_list_result->text_color;?>"><?=$package_list_result->package_name;?></button>
                                                    </td>
                                                   
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$package_list_result->id?>/tbl_package"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-package/<?=$package_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                </div>

                <div class="tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="2">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" class="form-group" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Name <b class="require">*</b></label>
                                            <input autocomplete="off"  type="text" class="form-control" name="package_name" id="package_name" value="<?php if (!empty($single)) {echo $single->package_name;} ?>" placeholder="Enter package name">
                                            <input autocomplete="off"  type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id;} ?>">
                                            <div style="display: none;" name="product_ids" id="product_ids"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
                                                <option value="">Select gender</option>
                                                <?php if ($store_category->category == 0){?>
                                                    <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == 1){?>
                                                    <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == 2){?>
                                                    <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                    <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                    <option id="female" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>Unisex</option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group service_name_validation">
                                            <label>Select Service <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
                                                <option value="">Select Service </option>
                                                <?php if (!empty($service_title)) {
                                                    $service_exp = [];
                                                    if (!empty($single)){
                                                        $service_exp = explode(",",$single->service_name);
                                                    }
                                                    foreach ($service_title as $service_name) { ?>
                                                        <option value="<?= $service_name->id ?>" <?php if (in_array($service_name->id,$service_exp)){?>selected="selected"<?php }?>><?= $service_name->service_name ?></option>
                                                <?php }
                                                } ?>
                                            </select>

                                        </div>
                                    <!-- </div>
                                    <div class="row">  -->
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group product_name_validation">
                                            <label>Select Product<b class="require">*</b></label>
                                            <select style="border: solid gray 1px;" class="form-select form-control chosen-select" name="product_name[]" id="product_name" multiple>  
                                                <option value="">Select Product</option>
                                                <?php if (!empty($single)){?>
                                                <option value="<?= $single->product_name?>" <?php if ((!empty($single) && $single->product_name)) echo 'selected="selected"'; ?>><?= $single->product_name?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Actual Price <b class="require">*</b></label>
                                            <input autocomplete="off" readonly type="text" class="form-control" name="actual_price" id="actual_price" value="<?php if (!empty($single)) {echo $single->actual_price;} ?>" placeholder="Actual price">
                                        </div>
                                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Select discount in</option>
                                                    <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                                </select>
                                            </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off"  type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) { echo $single->discount; } ?>" placeholder="Enter discount">
                                            <div class="discount_validation error"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Final Price <b class="require">*</b></label>
                                            <input autocomplete="off"  readonly type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) { echo $single->amount;} ?>" placeholder="Final price">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Type<b class="require">*</b></label>
                                            <select class="form-select form-control col-md-4 col-xs-12" name="count_type" id="count_type">
                                                <option value="">Select package expiry type</option>
                                                <option value="Days" <?php if (!empty($single) && $single->count_type == "Days") echo 'selected="selected"'; ?>>Days</option>
                                                <option value="Week" <?php if (!empty($single) && $single->count_type == "Week") echo 'selected="selected"'; ?>>Week</option>
                                                <option value="Month" <?php if (!empty($single) && $single->count_type == "Month") echo 'selected="selected"'; ?>>Month</option>
                                                <option value="Year" <?php if (!empty($single) && $single->count_type == "Year") echo 'selected="selected"'; ?>>Year</option>
                                            </select>
                                        </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Number <b class="require">*</b></label>
                                            <input autocomplete="off"  type="number" class="form-control" name="count_value" id="count_value" value="<?php if (!empty($single)) { echo $single->count_value; } ?>" placeholder="Enter package expiry number">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Reward Point <b class="require">*</b></label>
                                                <input autocomplete="off"  type="text" class="form-control" name="reward_point" id="reward_point" value="<?php if (!empty($single)) {echo $single->reward_point; } ?>" placeholder="Enter reward point">
                                            </div> 
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                    <input autocomplete="off"  type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>" id="hexcolor"></input>
                                                    <input autocomplete="off"  type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>"> 
                                                </div>
                                            </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                    <input autocomplete="off"  type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off"  type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-package',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8] 
                }
            }
        ], 
    });
</script>


<script>

   $("#service_name").change(function() {
        if( $("#service_name").val() !== ""){
            $("#service_name").removeClass('is-invalid'); 
            $(".service_name_validation .error").hide(); 
        }else{
            $(".service_name_validation .error").show(); 
        }
    });

    $("#product_name").change(function() {
     if( $("#product_name").val() !== ""){
         $("#service_name").removeClass('is-invalid'); 
         $(".product_name_validation .error").hide(); 
     }else{
        $(".product_name_validation .error").show(); 
     }
    });
    
   
   $("#service_name").change(function() {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_product_for_package_ajax",
        data: {
            'service_name_id': $('#service_name').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var tttt=0;
            $('#product_name').empty();
            $('#product_ids').empty();
            if (parsedData.length >= 0) {
                $("#product_name").append('<option value="">Select product</option>');
                
                parsedData.forEach(function(record) {
                    tttt = tttt + parseFloat(record.final_price);
                    var product_data = <?php echo json_encode($product_master_list)?>;
                    var p_length = product_data.length;
                    var r_length = record.product.length;
                   

                    for(var j=0; j<r_length; j++){
                        for(var i=0; i<p_length; i++){
                            if(product_data[i].id == record.product[j]){
                              
                               $('#product_name').append('<option value="' + record.product + '">' + product_data[i].product_name + '</option>');
                               $('#product_ids').append(product_data[i].id);

                            }
                        }    
                    }    
                });
                $("#product_name").trigger("chosen:updated");
                $('#actual_price').val(tttt);   

            }
            $('#actual_price').val(tttt);  

            var regular_price=$('#actual_price').val(); 
            var discount=$('#discount').val(); 
        
            if($('#discount').val() <= regular_price){
                if($('#discount_in').val() == 0){
                    if(100 < discount){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount percantage can not be greater than 100!");
                        $('#amount').val(0);
                    }else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - (regular_price * (discount / 100));
                        $('#amount').val(discounted_amount);
                    }
                }
                else{
                    if(discount > regular_price){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than actual price!");
                        $('#amount').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - discount;
                        $('#amount').val(discounted_amount);
                    }
                }
            }
            else{
                $('.discount_validation').show();
                $('.discount_validation').html("Discount can not be greater than actual price!");
                $('#amount').val(0);
            }
            if($("#discount").val() == ""){
                $('#amount').val(0); 
            }
        },
    });
    // check_product_duplicate();
  });

//   function check_product_duplicate(){

//     var p_array = $('#product_ids').html();
  
//         var product_data = <?php echo json_encode($product_master_list)?>;
//         var p_length = product_data.length;

//         for(var j=0; j<p_array.length; j++){
//             for(var i=0; i<p_length; i++){
//                 if(product_data[i].id == p_array[j]){
                                
//                     $('#product_name').append('<option value="' +product_data[i].id + '">' + product_data[i].product_name + '</option>');

//                 }
//             }    
//         } 
//   }

  $("#discount").keyup(function() {
        var discount = parseFloat($("#discount").val());
        var actual_price = parseFloat($('#actual_price').val());
        if($('#discount_in').val() !== ""){
            if(!isNaN($("#discount").val())){
                if (discount > actual_price) {
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than actual price!");
                    $('#amount').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    if($('#discount_in').val() == 0){
                        if(100 < discount){
                            $('.discount_validation').show();
                            $('.discount_validation').html("Discount percantage can not be greater than 100!");
                            $('#amount').val(0);
                        }else{
                            $('.discount_validation').hide();
                            var discounted_amount = actual_price - (actual_price * (discount / 100));
                            $('#amount').val(discounted_amount);
                        }
                    }
                    else{
                        var discounted_amount = actual_price - discount;
                        $('#amount').val(discounted_amount);
                    }
                }
            }else{
                $('.discount_validation').show();
                $('.discount_validation').html("Only number allowed!"); 
                $('#amount').val(0);
            }
        }

        if($("#discount").val() == ""){
            $('#amount').val(0); 
        }
        
    });
   

$("#discount_in").change(function () {

    var regular_price=$('#actual_price').val(); 
    var discount=$('#discount').val(); 
    alert(regular_price);
    alert(discount);
    if(regular_price !== ""){
        if(discount <= regular_price){
            if($('#discount_in').val() == 0){
                if(100 < discount){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount percantage can not be greater than 100!");
                    $('#amount').val(0);
                }else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - (regular_price * (discount / 100));
                    $('#amount').val(discounted_amount);
                }
            }
            else{
                if(discount > regular_price){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than actual price!");
                    $('#amount').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - discount;
                    $('#amount').val(discounted_amount);
                }
            }
        }
        else{
            alert();
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than actual price!");
            $('#amount').val(0);
        }
    }
    if($("#discount").val() == ""){
        $('#amount').val(0); 
    }

});
</script>


<script>
    $(document).ready(function() {
        $('#customer_form').validate({
            ignore: "",
            rules: {
                package_name: 'required',
                discount: {
                    required: true,
                    number: true,
                },
                // amount: {
                //     required: true,
                //     number: true,
                // },
                count_value: {
                    required: true,
                    number: true,
                },
                count_type: 'required',
                reward_point: {
                    required: true,
                    number: true,
                },
                // actual_price: {
                //     required: true,
                //     number: true,
                // },
                "product_name[]": 'required',
                discount_in: 'required',
                gender: 'required',
                "service_name[]": 'required',
            },
            messages: {
                package_name: 'Please enter package name!',
                gender: 'Please select gender!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                // amount: {
                //     required: 'Please enter amount!',
                //     number: "Only number allowed!",
                // },
                count_value: {
                    required: 'Please enter package expiry number!',
                    number: "Only number allowed!",
                },
                count_type: 'Please select package expiry type!',
                reward_point: {
                    required: 'Please enter reward point!',
                    number: "Only number allowed!",
                },
                // actual_price: {
                //     required: 'Please enter actual price!',
                //     number: "Only number allowed!",
                // },
                "product_name[]": 'Please select product name!',
                discount_in: 'Please select discount type!',
                "service_name[]": "Please select service name!",

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
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.package-setup').addClass('active_cc');
    });
</script>
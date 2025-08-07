<?php include('header.php');
                                                    // echo "<pre>";print_r($service_name);exit;
                                                     ?>
<style type="text/css">
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
    <div class="">
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
                    <li class="<?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Gift Card List</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Gift Card</a>
                    </li>


                </ul><br>
            </div>

            <div class="tab-content">

                <div class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="1">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Gift Name</th>
                                                    <th>Services</th> 
                                                    <th>Regular Price</th> 
                                                    <th>Gender</th> 
                                                    <th>Discount</th>
                                                    <th>Gift Price</th>
                                                    <th>Gift Card Code</th>
                                                    <th>Gift Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <?php if(!empty($gift_card_list)){
                                                    $i=1;
                                                        foreach($gift_card_list as $gift_card_list_result){
                                                            $service_name=$this->Salon_model->get_selected_service_name_for_offer($gift_card_list_result->service_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$gift_card_list_result->gift_name?></td>
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
                                                    <td><?=$gift_card_list_result->regular_price?></td>
                                                    <td><?= ($gift_card_list_result->gender == 1) ? 'Female' : (($gift_card_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
                                                    <?php if($gift_card_list_result->discount_in == 0): ?>
                                                        <td><?=$gift_card_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$gift_card_list_result->discount?></td>
                                                    <?php endif; ?>
                                                    <td><?=$gift_card_list_result->gift_price?></td>
                                                    <td><?=$gift_card_list_result->gift_card_code?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                    </td>
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$gift_card_list_result->id?>/tbl_gift_card"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-gift-card/<?=$gift_card_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                                <form method="post" name="gift_form" id="gift_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_name" id="gift_name" value="<?php if (!empty($single)) { echo $single->gift_name;} ?>" placeholder="Enter gift name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">

                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">
                                            <label>Select Service <b class="require">*</b></label>
                                            <select class="form-control form-select chosen-select" name="service_name[]" id="service_name" multiple>
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
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
                                                <option value="" class="">Select gender</option>
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
                                    </div>
                                    <div class="row">
                                        
                                    
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Regular Price<b class="require">*</b></label>
                                            <div id="price_div">
                                            <input readonly autocomplete="off" type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single)) {echo $single->regular_price;} ?>" placeholder="Regular price">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Select Discount In</option>
                                                    <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {echo $single->discount;} ?>" placeholder="Enter discount">
                                            <div class="discount_validation error" style="display: none;"></div> 
                                        </div> 
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Price<b class="require">*</b></label>
                                            <input readonly autocomplete="off" type="text" class="form-control" name="gift_price" id="gift_price" value="<?php if (!empty($single)) {echo $single->gift_price;} ?>" placeholder="Gift price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Code<b class="require">*</b></label>
                                            <div id="price_div">
                                            <input autocomplete="off" type="text" class="form-control" name="gift_card_code" id="gift_card_code" value="<?php if (!empty($single)) {echo $single->gift_card_code;} ?>" placeholder="Enter gift card code">
                                           <div class="gift_card_code_unique error"></div>
                                        </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>" id="hexcolor"></input>
                                                    <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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

    
    $(document).ready(function() {
        $('#gift_form').validate({
            ignore: "",
            rules: {
                gift_name: 'required',
                discount: {
                    required: true,
                    number: true,
                },
                gift_card_code: {
                    required: true,
                    number: true,
                },
                //  gift_price: {
                //     required: true,
                //     number: true,
                // },
                "service_name[]":{
                    required: true,
                },
                gender: 'required',
                discount_in: 'required',
                bg_color_input: 'required',
                text_color_input: 'required',
            },
            messages: {
                gift_name: 'Please enter gift name!',
                bg_color_input: 'Please select gift backgound colour!',
                text_color_input: 'Please select gift colour!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                gift_card_code: {
                    required: "Please enter gift card code!",
                    number: "Only number allowed!",
                },
                // gift_price: {
                //     required: "Please enter gift price!",
                //     number: "Only number allowed!",
                // },
                "service_name[]": 'Please select service name!',
                gender: 'Please select gender!',
                discount_in: 'Please select discount in!',
               
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
    $("#service_name").change(function() {
     if( $("#service_name").val() !== ""){
         $("#service_name").removeClass('is-invalid'); 
         $(".service_name .error").hide(); 
     }else{
        $(".service_name .error").show(); 
     }
    });
    $("#discount").keyup(function() {
        var discount = parseFloat($("#discount").val());
        var regular_price = parseFloat($('#regular_price').val());

        if(!isNaN(regular_price)){
            if($("#discount_in").val() !== ""){
                if(!isNaN($("#discount").val())){
                    if (discount > regular_price) {
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        if($('#discount_in').val() == 0){
                            if(100 < discount){
                                $('.discount_validation').show();
                                $('.discount_validation').html("Discount percantage can not be greater than 100!");
                                $('#gift_price').val(0);
                            }else{
                                $('.discount_validation').hide();
                                var discounted_amount = regular_price - (regular_price * (discount / 100));
                                $('#gift_price').val(discounted_amount);
                            }
                        }
                        else{
                            var discounted_amount = regular_price - discount;
                            $('#gift_price').val(discounted_amount);
                        }
                    }
                }
                else{
                    $('#gift_price').val(0); 
                }
            }
        }
       
        if($("#discount").val() == ""){
            $('#gift_price').val(0); 
        }
        
    });
    $("#discount_in").change(function () {

        var regular_price=$('#regular_price').val(); 
        var discount=$('#discount').val(); 
       
         if(regular_price !== ""){
            if($('#discount').val() <= regular_price){
                if($('#discount_in').val() == 0){
                    if(100 < discount){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount percantage can not be greater than 100!");
                        $('#gift_price').val(0);
                    }else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - (regular_price * (discount / 100));
                        $('#gift_price').val(discounted_amount);
                    }
                }
                else{
                    if(discount > regular_price){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - discount;
                        $('#gift_price').val(discounted_amount);
                    }
                }
            }
            else{
                $('.discount_validation').show();
                $('.discount_validation').html("Discount can not be greater than regular price!");
                $('#gift_price').val(0);
            }
        }
        if($("#discount").val() == ""){
            $('#gift_price').val(0); 
        }

        
    });
    $("#service_name").change(function () {

        if($("#service_name").val()==null){
            $('#regular_price').val("0");
            $('#gift_price').val("0");
        } 
    var total_service_price = parseFloat($('#regular_price').val());
    if (isNaN(total_service_price)) {
        total_service_price = 0; 
    }

    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_service_price_details_ajax",
        data: {
            'service_name_id': $('#service_name').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var tttt=0;
            if (parsedData.length > 0) {
                parsedData.forEach(function(record) {
                    tttt = tttt + parseFloat(record.final_price);
                });
            } 
            $('#regular_price').val(tttt);  

            var regular_price=$('#regular_price').val(); 
            var discount=$('#discount').val(); 
       
         if($('#discount').val() <= regular_price){
            if($('#discount_in').val() == 0){
                if(100 < discount){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount percantage can not be greater than 100!");
                    $('#gift_price').val(0);
                }else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - (regular_price * (discount / 100));
                    $('#gift_price').val(discounted_amount);
                }
            }
            else{
                if(discount > regular_price){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than regular price!");
                    $('#gift_price').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - discount;
                    $('#gift_price').val(discounted_amount);
                }
            }
        }
        else{
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than regular price!");
            $('#gift_price').val(0);
        }
        if($("#discount").val() == ""){
            $('#gift_price').val(0); 
        }
        },
    });
});
   
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.gift-setup').addClass('active_cc');
    });
$("#gift_card_code").keyup(function () {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_uinique_gift_code_ajax",
        data:{'gift_card_code':$("#gift_card_code").val(),'id':'<?=$id?>'},
        success: function(data) {
            if(data == "0"){
				$(".gift_card_code_unique").html('');
				$("#submit").show();
			}else{
				$(".gift_card_code_unique").html('This code is already generate!');
				$("#submit").hide();
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
                filename: 'add-gift-card',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7] 
                }
            }
        ], 
    });
</script>
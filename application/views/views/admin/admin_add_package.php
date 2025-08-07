<?php include('header.php'); ?>
<style>
    .chosen-container {
        width: 100%;
    }

    .chosen-container-multi .chosen-choices {

        border-radius: 4px;
        padding: 7px 5px;
        width: 100%;
        border: 1px solid #dde2e8;
        background-image: none;


    }

  
    .chosen-div{
        display: flex;
        flex-direction: column;

    }
    .chosen-div #service_name-error{
        order: 6;
    }

</style>
<div class="right_col" role="main">

    <div class="page-title">
        <div class="title_left">
            <h3>
                Add Package
                <a href="<?= base_url(); ?>admin_package_list" class="btn btn-primary pull-right">Go to List</a>
            </h3>
        </div>


    </div>


    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" class="form-group" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Package Name <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="package_name" id="package_name" value="<?php if (!empty($single)) {
                                                                                                                                                echo $single->package_name;
                                                                                                                                            } ?>" placeholder="Enter package name">
                                    <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                            echo $single->id;
                                                                                                        } ?>">
                                    <div style="display: none;" name="product_ids" id="product_ids"></div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Package Name In मराठी<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="package_name_marathi" id="package_name_marathi" value="<?php if (!empty($single)) {
                                                                                                                                                                echo $single->package_name_marathi;
                                                                                                                                                            } ?>" placeholder="Enter package name in मराठी">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Gender<b class="require">*</b></label>
                                    <select class="form-select form-control" name="gender" id="gender">
                                        <option value="">Ex. Male/Female</option>
                                        <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                        <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <div class="chosen-div">
                                        <label style="display:block;">Service <b class="require">*</b></label>
                                        <?php
                                        $service_exp = array();
                                        if (!empty($single)) {
                                            $service_exp = explode(",", $single->service_name);
                                            $services = $this->Admin_model->get_all_service_list_genderwise($single->gender);
                                        } ?>
                                        <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
                                            <?php
                                            if (!empty($services)) {
                                                foreach ($services as $service_name_result) { ?>
                                                    <option value="<?= $service_name_result->id ?>" <?php if (!empty($single) && in_array($service_name_result->id, $service_exp)) { ?>selected="selected" <?php } ?>><?=$services_result->service_name . '|' . $services_result->service_name_marathi; ?> [<?=$services_result->sup_category . '|' . $services_result->sup_category_marathi; ?> - <?=$services_result->sub_category_name . '|' . $services_result->sub_category_marathi; ?>]</option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <!-- <span id="service_name-error" class="error" style="display:block;"></span> -->
                                    </div>
                                    <input type="hidden" name="old_services" id="old_services" value="<?php if (!empty($single)) {
                                                                                                            echo $single->service_name;
                                                                                                        } ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Add Package Image<b class="require">*</b> <?php if (!empty($single) && $single->package_image != "") { ?> <a href="<?= base_url() ?>admin_assets/images/package_image/<?= $single->package_image ?>" target="_blank">View</a><?php } ?></label>
                                    <input accept=".png,.jpg,.jpeg" autocomplete="off" type="file" class="form-control" name="package_image" id="package_image">
                                    <input type="hidden" name="old_package_image" id="old_package_image" value="<?php if (!empty($single)) {
                                                                                                                    echo $single->package_image;
                                                                                                                } ?>">
                                </div>

                                <!-- </div>
                                    <div class="row">   -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Actual Price <b class="require">*</b></label>
                                    <input autocomplete="off" readonly type="text" class="form-control" name="actual_price" id="actual_price" value="<?php if (!empty($single)) {
                                                                                                                                                            echo $single->actual_price;
                                                                                                                                                        } ?>" placeholder="Actual price">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Discount In<small></small><b class="require">*</b></label>
                                    <select name="discount_in" id="discount_in" class="form-control">
                                        <option value="">Ex. Percentage/Flat</option>
                                        <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                        <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Discount <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {
                                                                                                                                        echo $single->discount;
                                                                                                                                    } ?>" placeholder="Enter discount">
                                    <!-- <div class="discount_validation error"></div> -->
                                </div>
                                <!-- </div>
                                    <div class="row">  -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Final Price <b class="require">*</b></label>
                                    <input autocomplete="off" readonly type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) {
                                                                                                                                                echo $single->amount;
                                                                                                                                            } ?>" placeholder="Final price">
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Type<b class="require">*</b></label>
                                            <select class="form-select form-control col-md-4 col-xs-12" name="count_type" id="count_type">
                                                <option value="">Ex. Days/Week</option>
                                                <option value="Days" <?php if (!empty($single) && $single->count_type == "Days") echo 'selected="selected"'; ?>>Days</option>
                                                <option value="Week" <?php if (!empty($single) && $single->count_type == "Week") echo 'selected="selected"'; ?>>Week</option>
                                            </select>
                                        </div> -->
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Package Expiry Number of <span id="days_number"> Days</span><b class="require">*</b></label>
                                    <input autocomplete="off" type="number" class="form-control" name="count_value" id="count_value" value="<?php if (!empty($single)) {
                                                                                                                                                echo $single->count_value;
                                                                                                                                            } ?>" placeholder="Enter package expiry number">
                                </div>

                                <!-- </div>
                                    <div class="row"> -->
                                <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Reward Point <b class="require">*</b></label>
                                                <input autocomplete="off"  type="text" class="form-control" name="reward_point" id="reward_point" value="<?php if (!empty($single)) {
                                                                                                                                                                echo $single->reward_point;
                                                                                                                                                            } ?>" placeholder="Enter reward point">
                                            </div>  -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="custom_fields_data">
                                        <label for="department_master">Button Background Color <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single)) {
                                                                                                                                                                                        echo $single->bg_color;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo '#bada55';
                                                                                                                                                                                    } ?>" id="hexcolor"></input>
                                        <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single)) {
                                                                                                                                                                                                echo $single->bg_color;
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '#bada55';
                                                                                                                                                                                            } ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="custom_fields_data">
                                        <label for="department_master">Button Text Color <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single)) {
                                                                                                                                                                                                echo $single->text_color;
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '#000000';
                                                                                                                                                                                            } ?>" id="texthexcolor"></input>
                                        <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if (!empty($single)) {
                                                                                                                                                                                                        echo $single->text_color;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo '#000000';
                                                                                                                                                                                                    } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label>Description <b class="require">*</b></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single)) {
                                                                                                                                            echo $single->description;
                                                                                                                                        } ?></textarea>
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

</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
 $(document).ready(function() {
	$(".chosen-select").chosen({
		 
	});
});    
// $("#count_type").change(function() {
// 	if( $("#count_type").val() == "Days"){
// 		$("#days_number").html('Days');  
// 	}else{
// 		$("#days_number").html('Week'); 
// 	}
// });    
$(".service_name").change(function() {
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

$('#gender').change(function() {            
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/Ajax_controller/get_all_service_list_genderwise_ajax",
                data:{'gender':$("#gender").val()},
                success: function(data){
                    var old_services = $('#old_services').val().split(',').map(function(item) {
                        return item.trim();
                    });
                    $("#service_name").empty();
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        if (old_services.includes(d.id.toString())) {
                            $('#service_name').append('<option selected value="' + d.id + '">' + d.service_name + '|' + d.service_name_marathi + ' [' + d.sup_category + '|' + d.sup_category_marathi + ' - ' + d.sub_category_name + '|' + d.sub_category_marathi + ']</option>');
                        }else{
                            $('#service_name').append('<option value="' + d.id + '">' + d.service_name + '|' + d.service_name_marathi + ' [' + d.sup_category + '|' + d.sup_category_marathi + ' - ' + d.sub_category_name + '|' + d.sub_category_marathi + ']</option>');
                        }
                    });
                    $('#service_name').trigger('change');
                    $('#service_name').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
$("#service_name").change(function(){
	/*var service_ids = '';
    $(".service_name").each(function(){
        if ($(this).is(':checked')) {  
            service_ids += $(this).val()+','; 
        }
    }); */
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_service_price_for_package_ajax",
        data: {
            'service_name_id': $("#service_name").val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var service_price=0;
            if (parsedData.length >= 0) {
                parsedData.forEach(function(record) {
					service_price = service_price + parseFloat(record.final_price);  
				});
            }
            $('#actual_price').val(service_price);   
            var regular_price=$('#actual_price').val(); 
            var discount=$('#discount').val();  
            // console.log($('#discount').val());

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
                }else{
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
            }else{
                $('.discount_validation').show();
                $('.discount_validation').html("Discount can not be greater than actual price!");
                $('#amount').val(0);
            }
            if($("#discount").val() == ""){
                $('#amount').val(0); 
            }
        },
    }); 
  });
 

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
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than actual price!");
            $('#amount').val(0);
        }
    }
    if($("#discount").val() == ""){
        $('#amount').val(0); 
    }

}); 
    $(document).ready(function() {
        $('#customer_form').validate({
            // ignore: "",
            ignore: ":hidden:not(select)",
            rules: {
                description: 'required',
                package_name: 'required',
                package_name_marathi: 'required',
                package_image: {
                    required: function(element) {
                        return $('#old_package_image').val() === "";
                    }
                },
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
                // reward_point: {
                //     required: true,
                //     number: true,
                // },
                // actual_price: {
                //      required: true,
                //      number: true,
                //  },
                discount_in: 'required',
                gender: 'required',
                "service_name[]": 'required',
            },
            messages: {
                description: 'Please enter description!',
                package_name: 'Please enter package name!',
                package_image: 'Please select image!',
                package_name_marathi: 'Please enter package name in मराठी!',
                gender: 'Please select gender!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                // amount: {
                //     required: 'Please enter final price!',
                //     number: "Only number allowed!",
                // },
                count_value: {
                    required: 'Please enter package expiry number!',
                    number: "Only number allowed!",
                },
                count_type: 'Please select package expiry type!',
                // reward_point: {
                //     required: 'Please enter reward point!',
                //     number: "Only number allowed!",
                // },
                // actual_price: {
                //     required: 'Please enter actual price!',
                //     number: "Only number allowed!",
                // }, 
                discount_in: 'Please select discount type!',
                "service_name[]": "Please select service name!",

            },
            errorElement: 'span',
			errorPlacement: function(error, element) {
                if (element.attr("type") == "radio") {
                    error.insertAfter(element.parents('div').find('.radio-list'));
                } else {
                    if(element.parent('.form-control').length) {
                         error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });


    $('#service_name').on('change', function() {
        $('#service_name').valid();
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
 
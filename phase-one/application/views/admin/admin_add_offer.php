<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Offer
					<a href="<?=base_url();?>admin_offer_list" class="btn btn-primary pull-right">Go to List</a>
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
                        <div class="container">
                                <form method="post" name="offer_form" id="offer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Offer Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="offers_name" id="offers_name" value="<?php if (!empty($single)) { echo $single->offers_name;} ?>" placeholder="Enter offer name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Offers Duration in Week<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) {echo $single->duration;} ?>" placeholder="Enter duration in week">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
												<option value="" class="">Ex. Male/Female</option> 
												<option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
												<option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option> 
                                            </select>
                                        </div>
                                    </div>
									<?php 
										$service_added = array();
										if(!empty($single)){
											$service_added = explode(",",$single->service_name);
                                            $services = $this->Admin_model->get_all_service_list_genderwise($single->gender);
										} 
									?>
                                    <div class="row"> 
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">
                                            <label>Service <b class="require"></b></label>
                                           <select class="form-select form-control chosen-select" name="service_name[]" id="service_name" multiple>
												<?php if(!empty($services)){ foreach($services as $services_result){?>
												<option value="<?=$services_result->id?>" <?php if(!empty($service_added) && in_array($services_result->id,$service_added)){?>selected="selected"<?php }?>><?=$services_result->service_name?></option>
												<?php }}?>
											</select> 
                                        </div>
                                        <input type="hidden" name="old_services" id="old_services" value="<?php if (!empty($single)) {echo $single->service_name;} ?>">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Regular Price<b class="require"></b></label>
                                            <div id="price_div">
                                            <input autocomplete="off" readonly type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single)) {echo $single->regular_price;} ?>" placeholder="Regular price">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Ex. Percentage/Flat</option>
                                                    <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                                </select>
                                            </div>    
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="number" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {echo $single->discount;} ?>" placeholder="Enter discount">
                                            <div class="discount_validation error" style="display: none;"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Offer Price<b class="require"></b></label>
                                            <input readonly autocomplete="off" type="number" class="form-control" name="offer_price" id="offer_price" value="<?php if (!empty($single)) {echo $single->offer_price;} ?>" placeholder="Offer price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Reward Point <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="reward_point" id="reward_point" value="<?php if (!empty($single)) { echo $single->reward_point; } ?>" placeholder="Enter reward point">
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Description </label>
                                            <textarea autocomplete="off" style="resize:none;" type="text" class="form-control" name="description" id="description"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
                                        </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
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
        $('#offer_form').validate({
            ignore: "",
            rules: {
                offers_name: 'required',
                discount: {
                    required: true,
                    number: true,
                },
                "service_name[]": 'required',
                reward_point: {
                    required: true,
                    number: true,
                },
                gender: 'required',
                discount_in: 'required',
                duration: {
                    required: true,
                    number: true,
                    min: 1,
                },
            },
            messages: {
                discount_in: 'Please select discount in!',
                offers_name: 'Please enter offer name!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                reward_point: {
                    required: 'Please enter reward point!',
                    number: "Only number allowed!",
                },
                "service_name[]": 'Please select service!',
                gender: 'Please select gender!',
                // duration: 'Please enter duration in week!',
                duration: {
                    required: 'Please enter duration in weeks!',
                    number: 'Please enter a valid number for duration!',
                    min: 'Duration must be at least 1 week!'
                },
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
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
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
                            $('#service_name').append('<option selected value="' + d.id + '">' + d.service_name + '</option>');
                        }else{
                            $('#service_name').append('<option value="' + d.id + '">' + d.service_name + '</option>');
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
       
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.offers-setup').addClass('active_cc');
    }); 
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: false,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-offers',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9] 
                }
            }
        ], 
    });


    $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
 
        e.preventDefault();
    });
});

function view_description(des){
$('.descrip').text(des);
}

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
                        $('#offer_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        // alert($('#discount_in').val());
                        if($('#discount_in').val() == 0){
                            if(100 < discount){
                                $('.discount_validation').show();
                                $('.discount_validation').html("Discount percantage can not be greater than 100!");
                                $('#offer_price').val(0);
                            }else{
                                $('.discount_validation').hide();
                                var discounted_amount = regular_price - (regular_price * (discount / 100));
                                $('#offer_price').val(discounted_amount);
                            }
                        }
                        else{
                            var discounted_amount = regular_price - discount;
                            $('#offer_price').val(discounted_amount);
                        }
                    }
                }else{
                    $('.discount_validation').show();
                    $('.discount_validation').html("Only number allowed!"); 
                    $('#offer_price').val(0);
                }
            }
        }

        if($("#discount").val() == ""){
            $('#offer_price').val(0); 
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
                    $('#offer_price').val(0);
                }else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - (regular_price * (discount / 100));
                    $('#offer_price').val(discounted_amount);
                }
            }
            else{
                if(discount > regular_price){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than regular price!");
                    $('#offer_price').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - discount;
                    $('#offer_price').val(discounted_amount);
                }
            }
        }
    }
        else{
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than regular price!");
            $('#offer_price').val(0); 
        }

        if($("#discount").val() == ""){
            $('#offer_price').val(0); 
        }
        
    });
    $("#service_name").change(function (){ 
        if($("#service_name").val()==null){
            $('#regular_price').val("0");
            $('#offer_price').val("0");
        } 
		var total_service_price = parseFloat($('#regular_price').val());
		if (isNaN(total_service_price)) {
			total_service_price = 0; 
		} 
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>admin/Ajax_controller/get_service_price_details_ajax",
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
				var discount = parseFloat($("#discount").val());
				var regular_price = parseFloat($('#regular_price').val());
				if(!isNaN($("#discount").val())){
					if (discount > regular_price) {
						$('.discount_validation').show();
						$('.discount_validation').html("Discount can not be greater than regular price!");
						$('#offer_price').val(0);
					}else{
						$('.discount_validation').hide();
						if($('#discount_in').val() == 0){
							if(100 < discount){
								$('.discount_validation').show();
								$('.discount_validation').html("Discount percantage can not be greater than 100!");
								$('#offer_price').val(0);
							}else{
								$('.discount_validation').hide();
								var discounted_amount = regular_price - (regular_price * (discount / 100));
								$('#offer_price').val(discounted_amount);
							}
						}else{
							var discounted_amount = regular_price - discount;
							$('#offer_price').val(discounted_amount);
						}
					}
				}else{
					$('.discount_validation').show();
					$('.discount_validation').html("Only number allowed!"); 
					$('#offer_price').val(0);
				}
			},
		});
	});
</script>

<!-- <script>
$(document).ready(function() {
    $("#duration").on("keyup", function() {
        var durationValue = parseInt($('#duration').val());

        if (durationValue == 0) {
            alert('Duration must be a number greater than 0');
            $('#duration').val('');
        } 
    });
});

</script> -->
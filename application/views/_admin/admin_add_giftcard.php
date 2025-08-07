<?php include('header.php');?> 
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Gift Card
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
                                <form method="post" name="gift_form" id="gift_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_name" id="gift_name" value="<?php if (!empty($single)) { echo $single->gift_name;} ?>" placeholder="Enter gift card name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">

                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">
                                            <label>Select Service <b class="require">*</b></label>
                                            <input type="text" readonly class="form-control" name="service_name" id="service_name" placeholder="Salon will select Services">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
												<option value="" class="">Select gender</option>
												<option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
												<option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
												<option id="female" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>Unisex</option>
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
     
    
$("#gift_card_code").keyup(function () {
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_uinique_gift_code_ajax",
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
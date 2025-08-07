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
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Coupon Code
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
                                <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupan Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupon_name" id="coupon_name"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->coupon_name;
                                                } ?>"
                                                placeholder="Enter coupon name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)){ echo $single->id; } ?>">
                                        </div>

                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupan Code <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupan_code" id="coupan_code"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->coupan_code;
                                                } ?>"
                                                placeholder="Enter coupan code ">
                                                <div class="error" id="coupan_code_error"></div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Minimum Price<b
                                                    class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="min_price" id="min_price"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->min_price;
                                                } ?>"
                                                placeholder="Enter coupon minimum price">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Offer Price<b
                                                    class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="coupon_offers" id="coupon_offers"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->coupon_offers;
                                                } ?>"
                                                placeholder="Enter coupon offer price">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Coupon Expiry Date <b
                                                    class="require">*</b></label>
                                            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="coupan_expiry" id="coupan_expiry"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->coupan_expiry;
                                                } ?>"
                                                placeholder="DD/MM/YYYY">
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
        

</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
  $("#coupan_expiry").datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth: true,
    changeYear: true,
    minDate: 0, 
    maxDate: "+10Y", 
    yearRange: "-100:+10"

});


    $(document).ready(function () {
        $('#customer_form').validate({
            rules: {
                coupon_name: 'required',
                coupan_code: {
                    required: true,
                    number: true,
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
            },
            messages: {
                coupon_name: 'Please enter coupan name!',
                coupan_code: {
                    required: 'Please enter coupan code!',
                    number: "Only number allowed!",
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
			url: "<?=base_url();?>admin/Ajax_controller/get_unique_coupan_code",
			data:{'coupan_code':$("#coupan_code").val(),'id':'<?=$id?>'},
			success: function(data){  console.log('1452');
				if(data == "0"){
					$("#coupan_code_error").html('');
					$("#submit").show();
				}else{
					$("#coupan_code_error").html('This code is already added for another offer');
					$("#submit").hide();
				}  
			}	
		});	 
	});	 
</script> 
<?php
// echo "<pre>";print_r($single);exit;
include('header.php'); ?>

<style type="text/css">
    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }
.divTimeSetterContainer {
  margin: 5px;
  float: left;
  position: absolute;
  left: 385px;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Membership
					<a href="<?=base_url();?>admin_membership_list" class="btn btn-primary pull-right">Go to List</a>
                </h3>
            </div>


        </div>


        <div class="row">

                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="offer_form" id="offer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="membership_name" id="membership_name" value="<?php if (!empty($single)) { echo $single->membership_name;} ?>" placeholder="Enter membership name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">

                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
                                                <option value="" class="">Ex. Male/Female</option>
                                                    <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                    <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                            </select>
                                        </div>
                                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="">Ex. Percentage/Flat</option>
                                                    <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                                </select>
                                        </div>  
                                       
                                    <!-- </div>
                                    <div class="row"> -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Service Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="service_discount" id="service_discount" value="<?php if (!empty($single)) {echo $single->service_discount;} ?>" placeholder="Enter service discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount </label>
                                            <input autocomplete="off" type="text" class="form-control" name="product_discount" id="product_discount" value="<?php if (!empty($single)) {echo $single->product_discount;} ?>" placeholder="Enter product discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="membership_price" id="membership_price" value="<?php if (!empty($single)) {echo $single->membership_price;} ?>" placeholder="Enter membership price">
                                        </div> 
                                    <!-- </div>
                                    <div class="row"> -->
                                       
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Duration in month <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" maxlength="2" minlength="1" value="<?php if (!empty($single)) {echo $single->duration;} ?>" placeholder="Enter duration">
                                            <input autocomplete="off" type="hidden" class="form-control" name="duration_end" id="duration_end">
                                        </div>
                                       
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#808080';} ?>" id="hexcolor"></input>
                                                    <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#808080';} ?>"> 
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label><br>
                                                    <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Description </label>
                                            <textarea autocomplete="off" type="text" class="form-control" name="description" id="description" placeholder="Enter description" style="resize:none;"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
                                        </div>
                                            
                                           
                                            
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                        <?php if (!empty($single)){?>
                                            <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group card-box">
                                                <label>Membership Card</label><br>
                                                <div class="membership_card_box">
                                                    <div class="membership-logo" style="color: black"><?php if (!empty($branch_list)) {echo $branch_list->branch_name;} ?></div>
                                                    <div class="membership-name" id="m_name"><?php echo $single->membership_name?></div>
                                                    <div class="membership-number" id="m_number">Customer Phone Number</div>
                                                    <div class="membership-in-date" id="m_in_date">From:<?php echo date('d/m/y', strtotime($single->created_on)) ?></div>
                                                    <?php
                                                        $expiry_date = date('d/m/y', strtotime($single->created_on . ' +' . $single->duration . ' months'));
                                                    ?>
                                                    <div class="membership-out-date" id="m_out_date">To: <?php echo $expiry_date ?></div>

                                                </div>
                                            </div> -->
                                            <?php } else{?>
                                                <!-- <div class="col-md-4 col-sm-6 col-xs-12 form-group card-box" style="display: none;">
                                                <label>Membership Card</label><br>
                                                <div class="membership_card_box">
                                                    <div class="membership-logo" style="color: black"><?php if (!empty($branch_list)) {echo $branch_list->branch_name;} ?></div>
                                                    <div class="membership-name" id="m_name"></div>
                                                    <div class="membership-number" id="m_number">Customer Phone Number</div>
                                                    <div class="membership-in-date" id="m_in_date"></div>
                                                    <div class="membership-out-date" id="m_out_date"></div>
                                                </div>
                                            </div> -->
                                            <?php }?>
                                </form> 
                            </div>
                        </div> 

                    </div>
                </div>

            </div>
        </div>

        <!-- <div class="popup" data-popup="popup-1">
                <div class="popup-inner">
                    <h3>Description</h3>
                 <div class="popup-scroll">
                  <div class="descrip"></div>
                </div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
            </div>
         -->
    </div>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $("#membership_name").keyup(function () {
    $('.card-box').show();
    $('#m_name').html( $("#membership_name").val());
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();
    var formattedDay = (day < 10) ? '0' + day : day;
    var formattedMonth = (month < 10) ? '0' + month : month;
    var formattedDate = formattedDay + '/' + formattedMonth + '/' + String(year).slice(-2);
    $('#m_in_date').html('<b>From</b>:'+formattedDate);
    });

    $("#duration").keyup(function () {
       var duration = parseInt($("#duration").val(), 10);
    //    alert(duration);
       if (!isNaN(duration)) {
            var currentDate = new Date();
            var day = currentDate.getDate()-1;
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var newMonth = (month + duration) % 12;
            var newYear = year + Math.floor((month + duration) / 12);
            if (newMonth > 12) {
                newYear++;
            }
            var formattedMonth = (newMonth < 10) ? '0' + newMonth : newMonth;
            var formattedDate = day+'/'+formattedMonth + '/' + String(newYear).slice(-2);
            // alert(formattedDate);
            $('#m_out_date').html('<b>To</b>:'+formattedDate);
            $('#duration_end').val(formattedDate);
        }
    });

    $("#colorpicker").change(function () {
    var selectedColor = $("#colorpicker").val();
    $('#hexcolor').val(selectedColor);
    $('.membership_card_box').css('background-color', selectedColor);
});

    $("#textcolorpicker").change(function () {
        var selectedColor = $("#textcolorpicker").val();
       $('#texthexcolor').val(selectedColor);
       $('.membership_card_box div').css('color', selectedColor);
    });

</script>

<script>
    $(document).ready(function() {
$.validator.addMethod("noSpecialChars", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9 ]*$/.test(value);
}, "Please avoid special characters.");
        $('#offer_form').validate({
            ignore: "",
            rules: {
                membership_name: {
                    required: true,
                    noSpecialChars: true // Use the custom validation method
                },
                service_discount: {
                    required: true,
                    number: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                },
                // regular_price: {
                //     required: true,
                //     number: true,
                // },
                product_discount: {
                    required: false,
                    number: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                },
                "service_name[]": 'required',
                membership_price: {
                    required: true,
                    number: true,
                },
                gender: 'required',
                discount_in: 'required',
                duration: {
                    required: true,
                    number: true,
                },
            },
            messages: {
            membership_name: {
                required: 'Please enter membership name!',
                noSpecialChars: 'Membership name must not contain special characters!'
            },
                // regular_price: {
                //     required: "Please enter regular price!",
                //     number: "Only number allowed!",
                // },
                service_discount: {
                    required: "Please enter service discount!",
                    number: "Only number allowed!",
                },
                product_discount: {
                    required: "Please enter product discount!",
                    number: "Only number allowed!",
                },
                membership_price: {
                    required: 'Please enter membership price!',
                    number: "Only number allowed!",
                },
                duration: {
                    required: 'Please enter duration!',
                    number: "Only number allowed!",
                },
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
             
        });
    });
//     $("#discount_in").change(function () {
//     var regular_price = parseFloat($('#regular_price').val()); 
//     var service_discount = parseFloat($('#service_discount').val());
//     var product_discount = parseFloat($('#product_discount').val());
    
//     if ($('#discount_in').val() == 0) {
//         var total_discount = (service_discount + product_discount) / 100; 
//         var discounted_amount = regular_price - (regular_price * total_discount);
//         $('#membership_price').val(discounted_amount.toFixed(2));
//     } else {
//         var total_discount = service_discount + product_discount; 
//         var discounted_amount = regular_price - total_discount;
//         $('#membership_price').val(discounted_amount.toFixed(2)); 
//     }
//    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.membership-setup').addClass('active_cc');
    });
</script>


<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-membership',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7] 
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
</script>

<script>
    // $('#service_discount').on('keyup',function(){
    //     var discountamonut= $('#discount_in').val();
    //     if(discountamonut == 0){
    //         var service_discount = parseInt($('#service_discount').val()) || 0;
    //         if(service_discount > 100){
    //             alert('You can not enter percentage more than 100');
    //             $('#service_discount').val(0);
    //         }
    //     }
    // });


    // $('#product_discount').on('keyup',function(){
    //     var discountamonut = $('#discount_in').val();
    //     if(discountamonut == 0){
    //         var product_discount = parseInt($('#product_discount').val()) || 0;
    //         if(product_discount > 100){
    //             alert('You can not enter percentage more than 100');
    //             $('#product_discount').val(0);
    //         }
    //     }
    // });

</script>
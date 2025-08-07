<?php include('header.php'); ?>
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

    .popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 999999999999;
}
 
/* Inner */
.popup-inner {
    max-width:700px;
    width: 45%;
    padding:40px;
    position:absolute;
    top:20%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}
 
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}



.popup-scroll{
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
}
/* .popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	 */

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
                    <li class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">Membership List</a>
                    </li>
                    <li class="tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Membership</a>
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
                                    <table id="example" class="table table-striped responsive-utilities jambo_table" >
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.no</th>
                                                    <th>Membership Name</th>
                                                    <th>Service Discount</th> 
                                                    <th>Product Discount</th> 
                                                    <th>Memebership Price</th> 
                                                    <th>Gender</th> 
                                                    <th>Membership Duration</th> 
                                                    <th style="display: none;">Description</th> 
                                                    <th>Description</th> 
                                                    <th>Memebership Button</th> 
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                <?php if(!empty($membership_list)){
                                                    $i=1;
                                                        foreach($membership_list as $membership_list_result){
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$membership_list_result->membership_name?></td>
                                                   

                                                    <?php if($membership_list_result->discount_in == 0): ?>
                                                        <td><?=$membership_list_result->service_discount?>%</td>
                                                        <td><?=$membership_list_result->product_discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$membership_list_result->service_discount?></td>
                                                        <td>Rs.<?=$membership_list_result->product_discount?></td>
                                                    <?php endif; ?>

                                                    <td><?=$membership_list_result->membership_price?></td>
                                                    <td><?= ($membership_list_result->gender == 1) ? 'Female' : (($membership_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
                                                    <td><?=$membership_list_result->duration?> Month</td>
                                                    <td style="display: none;"><?=$membership_list_result->description?></td>
                                                    <td><a class="btn btn-primary" data-popup-open="popup-1" onclick="view_description('<?php echo $membership_list_result->description; ?>')">View</a></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="background-color:<?=$membership_list_result->bg_color;?>; color:<?=$membership_list_result->text_color;?>"><?=$membership_list_result->membership_name;?></button>
                                                    </td>
                                                    
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$membership_list_result->id?>/tbl_memebership"><i class="fa-solid fa-trash"></i></a>   

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-membership/<?=$membership_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>   
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
                                <form method="post" name="offer_form" id="offer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="membership_name" id="membership_name" value="<?php if (!empty($single)) { echo $single->membership_name;} ?>" placeholder="Enter membership name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">

                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
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
                                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Select Option</option>
                                                    <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                    <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                                </select>
                                        </div>  
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Service Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="service_discount" id="service_discount" value="<?php if (!empty($single)) {echo $single->service_discount;} ?>" placeholder="Enter service discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="product_discount" id="product_discount" value="<?php if (!empty($single)) {echo $single->product_discount;} ?>" placeholder="Enter product discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="membership_price" id="membership_price" value="<?php if (!empty($single)) {echo $single->membership_price;} ?>" placeholder="Enter membership price">
                                        </div> 
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Membership Duration in month <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) {echo $single->duration;} ?>" placeholder="Enter duration">
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
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Description </label>
                                            <textarea autocomplete="off" type="text" class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
                                        </div>
                                            
                                           
                                            
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                        <?php if (!empty($single)){?>
                                            <div class="col-md-4 col-sm-6 col-xs-12 form-group card-box">
                                                <label>Memebership Card</label>
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
                                            </div>
                                            <?php } else{?>
                                                <div class="col-md-4 col-sm-6 col-xs-12 form-group card-box" style="display: none;">
                                                <label>Memebership Card</label>
                                                <div class="membership_card_box">
                                                    <div class="membership-logo" style="color: black"><?php if (!empty($branch_list)) {echo $branch_list->branch_name;} ?></div>
                                                    <div class="membership-name" id="m_name"></div>
                                                    <div class="membership-number" id="m_number">Customer Phone Number</div>
                                                    <div class="membership-in-date" id="m_in_date"></div>
                                                    <div class="membership-out-date" id="m_out_date"></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                </form> 
                            </div>
                        </div> 

                    </div>
                </div>

            </div>
        </div>

        <div class="popup" data-popup="popup-1">
                <div class="popup-inner">
                    <h3>Description</h3>
                 <div class="popup-scroll">
                  <div class="descrip"></div>
                </div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
            </div>
        <?php }?>
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
        $('#offer_form').validate({
            ignore: "",
            rules: {
                membership_name: 'required',
                service_discount: {
                    required: true,
                    number: true,
                },
                // regular_price: {
                //     required: true,
                //     number: true,
                // },
                product_discount: {
                    required: true,
                    number: true,
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
                membership_name: 'Please enter membership name!',
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
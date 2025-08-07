<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
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
.popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	

</style>
<!-- page content -->
<div class="right_col" role="main">
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
                        <a href="#1" data-toggle="tab">Offers List</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Offer</a>
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
                                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.no</th>
                                                    <th>Offers Name</th>
                                                    <th>Services</th> 
                                                    <th>Regular Price</th> 
                                                    <th>Discount</th>
                                                    <th>Offers Price</th>
                                                    <th>Validity</th>
                                                    <th>Gender</th>
                                                    <th>Reward Point</th>
                                                    <th style="display: none;">Description</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($offers_list)){
                                                    $i=1;
                                                        foreach($offers_list as $offers_list_result){
                                                            $service_name=$this->Salon_model->get_selected_service_name_for_offer($offers_list_result->service_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$offers_list_result->offers_name?></td>
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
                                                    <td><?=$offers_list_result->regular_price?></td>
                                                    <?php if($offers_list_result->discount_in == 0): ?>
                                                        <td><?=$offers_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$offers_list_result->discount?></td>
                                                    <?php endif; ?>
                                                    <td><?=$offers_list_result->offer_price?></td>
                                                    <td><?=$offers_list_result->duration?> Week</td>
                                                    <td><?= ($offers_list_result->gender == 1) ? 'Female' : (($offers_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
                                                    <td><?=$offers_list_result->reward_point?></td>
                                                    <td style="display: none;"><?=$offers_list_result->description?></td>
                                                    
                                                    <td><a class="btn btn-info" data-popup-open="popup-1" onclick="view_description('<?php echo $offers_list_result->description; ?>')">View</a></td>
                                                    <td>
                                                        <?php if($offers_list_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$offers_list_result->id?>/tbl_offers"><i class="fa-solid fa-toggle-on"></i></a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$offers_list_result->id?>/tbl_offers"><i class="fa-solid fa-toggle-off"></i></a> 
                                                        <?php }?>
                                                        </td>
                                                        <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$offers_list_result->id?>/tbl_offers"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-offers/<?=$offers_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                                        
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">
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
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Regular Price<b class="require">*</b></label>
                                            <div id="price_div">
                                            <input autocomplete="off" readonly type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single)) {echo $single->regular_price;} ?>" placeholder="Regular price">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label>Discount In<small></small><b class="require">*</b></label>
                                                <select name="discount_in" id="discount_in" class="form-control">
                                                    <option value="" >Select discount in</option>
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
                                            <label>Offer Price<b class="require">*</b></label>
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
                                            <textarea autocomplete="off" type="text" class="form-control" name="description" id="description"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
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

            <div class="popup" data-popup="popup-1">
                <div class="popup-inner">
                    <h3>Description</h3>
                 <div class="popup-scroll">
                  <div class="descrip"></div>
                </div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
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
                duration: 'Please enter duration in week!',
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
                        $('#offer_price').val(0);
                    }
                    else{
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
    $("#service_name").change(function () {

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

            var discount = parseFloat($("#discount").val());
        var regular_price = parseFloat($('#regular_price').val());
        // if($('#discount_in').val() !== ""){
            if(!isNaN($("#discount").val())){
                if (discount > regular_price) {
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than regular price!");
                    $('#offer_price').val(0);
                }
                else{
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
        },
    });
});
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.offers-setup').addClass('active_cc');
    });
</script>
<script>
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
</script>
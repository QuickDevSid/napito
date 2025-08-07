<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Offer
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
												<option value="" class="">Select gender</option> 
												<option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
												<option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
												<option id="female" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>Unisex</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name">
                                            <label>Service <b class="require"></b></label>
                                            <input type="text" readonly placeholder="Salon will select services" class="form-control" name="service_name" id="service_name">
                                                 
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Regular Price<b class="require"></b></label>
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
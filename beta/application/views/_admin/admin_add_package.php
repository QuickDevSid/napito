<?php include('header.php'); ?>
 <div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Package
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
                                <form method="post" class="form-group" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Name <b class="require">*</b></label>
                                            <input autocomplete="off"  type="text" class="form-control" name="package_name" id="package_name" value="<?php if (!empty($single)) {echo $single->package_name;} ?>" placeholder="Enter package name">
                                            <input autocomplete="off"  type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id;} ?>">
                                            <div style="display: none;" name="product_ids" id="product_ids"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
												<option value="">Select gender</option>
												<option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
												<option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
												<option id="female" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>Unisex</option> 
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group service_name_validation">
                                            <label>Services <b class="require"></b></label>
                                            <input type="text" readonly class="form-control" name="service_name" id="service_name" placeholder="Salon will select services">
                                                 
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group product_name_validation">
                                            <label>Select Product<b class="require"></b></label>
                                            <input type="text" readonly class="form-control" name="product_name" id="product_name" placeholder="Salon will select packages">  
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Actual Price <b class="require">*</b></label>
                                            <input autocomplete="off" readonly type="text" class="form-control" name="actual_price" id="actual_price" value="<?php if (!empty($single)) {echo $single->actual_price;} ?>" placeholder="Actual price">
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
                                            <input autocomplete="off"  type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) { echo $single->discount; } ?>" placeholder="Enter discount">
                                            <div class="discount_validation error"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Final Price <b class="require">*</b></label>
                                            <input autocomplete="off"  readonly type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) { echo $single->amount;} ?>" placeholder="Final price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Type<b class="require">*</b></label>
                                            <select class="form-select form-control col-md-4 col-xs-12" name="count_type" id="count_type">
                                                <option value="">Select package expiry type</option>
                                                <option value="Days" <?php if (!empty($single) && $single->count_type == "Days") echo 'selected="selected"'; ?>>Days</option>
                                                <option value="Week" <?php if (!empty($single) && $single->count_type == "Week") echo 'selected="selected"'; ?>>Week</option>
                                                <option value="Month" <?php if (!empty($single) && $single->count_type == "Month") echo 'selected="selected"'; ?>>Month</option>
                                                <option value="Year" <?php if (!empty($single) && $single->count_type == "Year") echo 'selected="selected"'; ?>>Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Package Expiry Number <b class="require">*</b></label>
                                            <input autocomplete="off"  type="number" class="form-control" name="count_value" id="count_value" value="<?php if (!empty($single)) { echo $single->count_value; } ?>" placeholder="Enter package expiry number">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                                <label>Reward Point <b class="require">*</b></label>
                                                <input autocomplete="off"  type="text" class="form-control" name="reward_point" id="reward_point" value="<?php if (!empty($single)) {echo $single->reward_point; } ?>" placeholder="Enter reward point">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                    <input autocomplete="off"  type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>" id="hexcolor"></input>
                                                    <input autocomplete="off"  type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                    <input autocomplete="off"  type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off"  type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
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
    $(document).ready(function() {
        $('#customer_form').validate({
            ignore: "",
            rules: {
                package_name: 'required',
                discount: {
                    required: true,
                    number: true,
                }, 
                count_value: {
                    required: true,
                    number: true,
                },
                count_type: 'required',
                reward_point: {
                    required: true,
                    number: true,
                },
				discount_in: 'required',
                gender: 'required',
            },
            messages: {
                package_name: 'Please enter package name!',
                gender: 'Please select gender!',
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                count_value: {
                    required: 'Please enter package expiry number!',
                    number: "Only number allowed!",
                },
                count_type: 'Please select package expiry type!',
                reward_point: {
                    required: 'Please enter reward point!',
                    number: "Only number allowed!",
                },
                discount_in: 'Please select discount type!',
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
 
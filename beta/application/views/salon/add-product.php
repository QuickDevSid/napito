<?php include('header.php'); ?>
<style type="text/css">

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
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


           <div class="dropdown top-btn-btn">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog" aria-hidden="true"></i> Setting
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                    <li ><a class="add_product" href="<?= base_url(); ?>add-product-stock">Add Product Stock</a></li>
                    <li><a class="product_list" href="<?= base_url(); ?>product-stock-list">Product Stock List</a></li>
                    <li ><a class="product-barcode" href="<?= base_url(); ?>product-barcode">Product Barcode</a></li>
                    <!-- <li ><a class="product_category" href="<?= base_url(); ?>product-category">Add Product Category</a></li> -->
                    <li ><a class="product-unit" href="<?= base_url(); ?>product-unit">Add Product Unit</a></li>
                </ul>
            </div>


            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="tab_1">
                        <a href="#1" data-toggle="tab">My Product</a>
                    </li>
                    <li class="tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Add Product</a>
                    </li>


                </ul><br>
            </div>

            <div class="tab-content">


                <div class="tab-pane <?php if($this->uri->segment(2) == ""){?>active<?php }?>" id="1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>My Product</h3>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($category_name_list)) {
                                    foreach ($category_name_list as $services_result) {
                                       ?>
                         
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                            <div class="category_row_box">
                                                <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_category_image/' . $services_result->category_image) ?>)"></div>

                                                <div class="row category_head">
                                                    <a href="<?=base_url();?>product-list/<?=$services_result->id?>"><h4><?= $services_result->sup_category ?></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

            
                <!-- <div class="tab-pane" id="2">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Product Category</th>
                                                    <th>Product Name</th>
                                                    <th>Low Stock</th>
                                                    <th>High Stock</th>
                                                    <th>HSN code</th>
                                                    <th>Manufacturing Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($product_master_list)) {
                                                    $i = 1;
                                                    foreach ($product_master_list as $product_master_list_result) {
                                                ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?= $i++ ?>
                                                            </th>
                                                            <td><?= $product_master_list_result->product_category ?></td>
                                                            <td><?= $product_master_list_result->product_name ?></td>
                                                            <td><?= $product_master_list_result->low_stock ?></td>
                                                            <td><?= $product_master_list_result->high_stock ?></td>
                                                            <td><?= $product_master_list_result->hsn_code ?></td>
                                                            <td><?= date("d-m-Y", strtotime($product_master_list_result->mfg_date)) ?></td>
                                                            <td><?= date("d-m-Y", strtotime($product_master_list_result->expiry_date)) ?></td>
                                                            <td>
                                                                <?php if ($product_master_list_result->status == "1") { ?>
                                                                    <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $product_master_list_result->id ?>/tbl_product"><i class="fa-solid fa-toggle-on"></i></a>
                                                                <?php } else { ?>

                                                                    <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $product_master_list_result->id ?>/tbl_product"><i class="fa-solid fa-toggle-off"></i></a>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_product"><i class="fa-solid fa-trash"></i></a>

                                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-product/<?= $product_master_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="tab-pane <?php if($this->uri->segment(2) != ""){?>active<?php }?>" id="2">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Category <b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_category" id="product_category">
                                                <option value="">Select product category</option>
                                                <?php if (!empty($product_category_list)) {
                                                    foreach ($product_category_list as $product_category_list_result) { ?>
                                                        <option value="<?= $product_category_list_result->id ?>" <?php if (!empty($single) && $single->product_category == $product_category_list_result->id) { ?>selected="selected" <?php } ?>><?= $product_category_list_result->sup_category ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <div class="error" id="product_category_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id;} ?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Name <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if (!empty($single)) {echo $single->product_name;} ?>" placeholder="Enter product name">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Image<b class="require">*</b></label>
                                            <input type="file" class="form-control" name="product_photo" id="product_photo"  value="<?php if (!empty($single)) {echo $single->product_photo;} ?>">
                                            <input type="hidden" class="form-control" name="old_product_photo" id="old_product_photo"  value="<?php if (!empty($single)) {echo $single->product_photo;} ?>">
                                            <?php if (!empty($single)) {?>
                                              <a style="color: blue;float: right;margin-top: -63px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_image/<?php if (!empty($single)) {echo $single->product_photo;} ?>" class="view_image">View</a>
                                            <?php } ?>  
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Unit<b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="product_unit" id="product_unit">
                                                <option value="">Select product unit</option>
                                                <?php if (!empty($product_unit_list)) {
                                                    foreach ($product_unit_list as $product_unit_list_result) { ?>
                                                        <option value="<?= $product_unit_list_result->id ?>" <?php if (!empty($single) && $single->product_unit == $product_unit_list_result->id) echo 'selected="selected"'; ?>><?= $product_unit_list_result->product_unit ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>High stock <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="high_stock" id="high_stock" value="<?php if (!empty($single)) {echo $single->high_stock;} ?>" placeholder="Enter high stock">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Low Stock <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="low_stock" id="low_stock" value="<?php if (!empty($single)) { echo $single->low_stock; } ?>" placeholder="Enter low stock">
                                            <div class="error" id="low_stock_error"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>HSN Code <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?php if (!empty($single)) { echo $single->hsn_code;} ?>" placeholder="Enter hsn code">
                                            <div class="error" id="hsn_code_error"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Do you want to Require Date<b class="require">*</b></label>
                                            <select onchange="reuire_notrequire()" class="form-select form-control" name="date_require" id="date_require">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php if (!empty($single) && $single->date_require == 1) echo 'selected="selected"'; ?>>Require</option>
                                                <option value="0" <?php if (!empty($single) && $single->date_require == 0) echo 'selected="selected"'; ?>>Not Require</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group m_date">
                                            <label>Manufacturing Date</label>
                                            <input readonly type="text" class="form-control" name="mfg_date" id="mfg_date" value="<?php if (!empty($single)) { echo $single->mfg_date; } ?>" placeholder="DD-MM-YYYY">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group e_date">
                                            <label>Expiry Date</label>
                                            <input readonly type="text" class="form-control" name="expiry_date" id="expiry_date" value="<?php if (!empty($single)) {echo $single->expiry_date; } ?>" placeholder="DD-MM-YYYY">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Product Discount in %<b class="require">*</b></label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {echo $single->discount;} ?>" placeholder="Enter product discount">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Incentive<b class="require">*</b></label>
                                            <input type="text" class="form-control" name="incentive" id="incentive" value="<?php if (!empty($single)) { echo $single->incentive;} ?>" placeholder="Enter incentive">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Product Selling Price <b class="require">*</b></label>
                                            <input class="form-control" type="text" name="selling_price" id="selling_price" value="<?php if (!empty($single)) {echo $single->selling_price; } ?>" placeholder="Enter product selling price">
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12 form-group" style="">
                                            <label>Product Description<b class="require">*</b></label>
                                            <textarea type="text" class="form-control" name="description" id="description" value="<?php if (!empty($single)) { echo $single->description;} ?>" placeholder="Enter description"><?php if (!empty($single)) { echo $single->description;} ?></textarea>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Active/Deactive Low Stock Alert<b class="require">*</b></label>
                                            <div>
                                            <i id="low_stock_off" class="fa-solid fa-toggle-off fffftttt" <?= (!empty($single) && $single->low_stock_alert == 1) ? 'style="display:none;"' : ''; ?>></i>
                                            <?php if (!empty($single) && $single->low_stock_alert == 1) : ?>
                                                <i id="low_stock_on_1" class="fa-solid fa-toggle-on fffftttt"></i>
                                            <?php endif; ?>
                                                <i style="display: none;" id="low_stock_on" class="fa-solid fa-toggle-on fffftttt"></i>
                                                <input class="form-control" type="hidden" name="low_stock_alert" id="low_stock_alert" value="<?php if (!empty($single)) {echo $single->low_stock_alert; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12" style="margin-top: 28px;">
                                            <input type="checkbox" name="online_store" id="online_store" value="1" <?php if (!empty($single) && $single->online_store == 1) echo 'checked'; ?>>
                                            <label>Product Show in Online Store</label>
                                        </div>
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <pre></pre>
                                        <button type="submit" id="submit" style="margin-left:-10px" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php }?>
    </div>
</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script>
    $("#hsn_code").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_hsn_code",
		data:{'hsn_code':$("#hsn_code").val(),'id':'<?=$id?>'},
		success: function(data){
            // console.log(data);
			if(data == "0"){
				$("#hsn_code_error").html('');
				$("#submit").show();
			}else{
				$("#hsn_code_error").html('This hsn code is already added for another product');
				$("#submit").hide();
			}
		},
		});	
	});	 
</script>

<script>
    $("#mfg_date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        maxDate: "0",
        minDate: "-80Y",
        yearRange: "-100:-0"
    });
    $("#expiry_date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        maxDate: "0",
        minDate: "-80Y",
        yearRange: "-100:-0"
    });
</script>

<script>    
 function reuire_notrequire() {
   
    if( $("#date_require").val() == 0){
        $('.e_date').hide();
        $('.m_date').hide();
    }else{
        $('.e_date').show();
        $('.m_date').show();
    }
 }
  $(document).ready(function() {
        $('#master_form').validate({
            ignore: '',
            rules: {
                product_category: 'required',
                product_name: 'required',
                low_stock: {
                    required: true,
                    number: true,
                },
                high_stock: {
                    required: true,
                    number: true,
                },
                hsn_code: 'required',
                <?php if (empty($single)) {?>
                    product_photo: 'required', 
                <?php }?>
                description: 'required',
                product_unit: 'required',
                date_require: 'required',
                discount: {
                    required: true,
                    number: true,
                },
              
                incentive: {
                    required: true,
                    number: true,
                },
                selling_price: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                product_category: "Please select product category!",
                product_name: "Please enter product name!",
                product_photo: 'Please upload product photo', 
                description: "Please enter description!",
                product_unit: "Please select product unit!",
                date_require: "Please Select option!",
                low_stock: {
                    required: "Please enter low stock!",
                    number: "Only number allowed!",
                },
                high_stock: {
                    required: "Please enter high stock!",
                    number: "Only number allowed!",
                },
                selling_price: {
                    required: "Please enter product selling price!",
                    number: "Only number allowed!",
                },
                hsn_code: "Please enter hsn code!",
                discount: {
                    required: "Please enter discount!",
                    number: "Only number allowed!",
                },
                
                incentive: {
                    required: "Please enter incentive!",
                    number: "Only number allowed!",
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
</script>

<script> 
    $("#hsn_code").change(function() {
        var product_data = <?php echo json_encode($product_master_list) ?>;
        var product_length = product_data.length;

        for (var i = 0; i < product_length; i++) {
            if ($("#hsn_code").val() === product_data[i].hsn_code) {
                $("#hsn_code_error").html('This hsn code is already added!');
            } else {
                $("#hsn_code_error").html('');
            }
        }

    });
    $("#low_stock").keyup(function() {
        var high_stock = $("#high_stock").val()
        var low_stock = $("#low_stock").val()


        if (low_stock > high_stock) {
            $("#low_stock_error").html('Low stock cannot be greater than high stock!');
        } else {
            $("#low_stock_error").html('');
        }

    });
</script>
<script>
    $(document).ready(function () {
        $("#low_stock_off").click(function() {
            alert("Are you sure to activate low stock alert?");
            $("#low_stock_alert").val(1);
            $("#low_stock_off").hide();
            $("#low_stock_on").show();
        });

        $("#low_stock_on").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
        });
        $("#low_stock_on_1").click(function() {
            alert("Are you sure to deactivate low stock alert?");
            $("#low_stock_alert").val(0);
            $("#low_stock_off").show();
            $("#low_stock_on").hide();
            $("#low_stock_on_1").hide();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-setup').addClass('active_cc');
    });
</script>
<script>
    $('#example').DataTable({ 
        dom: 'Bfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-product',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7] 
                }
            }
        ], 
    });
</script>
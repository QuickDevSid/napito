<?php include('header.php');?>
<style type="text/css">
    .input-content-option{
        height: 33px;
        width: 570px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
        Whatsapp Add On Plans<?=!empty($subscription) ? ' for ' .$subscription->subscription_name . ' Plan' : ''; ?>                 
    </h3>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                    <?php if(!empty($single)){ ?>
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Plan Name <b class="require">*</b></label>
                                <input type="text" class="form-control plan_name" name="plan_name" id="plan_name" value="<?php if(!empty($single)){ echo $single->plan_name; }?>" placeholder="Enter Plan Name">
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Quantity <b class="require">*</b></label>
                                <input type="number" class="form-control qty" name="qty" id="qty" value="<?php if(!empty($single)){ echo $single->qty; }?>" placeholder="Enter Quantity">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Price <b class="require">*</b> <small>(In INR)</small></label>
                                <input type="number" class="form-control plan_price" name="price" id="price" value="<?php if(!empty($single)){ echo $single->price; }?>" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="error" id="facility_name_error"></div>
                        <div class="error" id="facility_name_error_qty"></div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <button style="margin-top: 10px;" type="submit" id="submit" name="submit" value="update_form" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" name="indices[]" id="indices_0" value="0">
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Plan Name <b class="require">*</b></label>
                                <input type="text" class="form-control plan_name" name="plan_name_0" id="plan_name_0" placeholder="Enter Plan Name">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Quantity <b class="require">*</b></label>
                                <input type="number" class="form-control qty" name="qty_0" id="qty_0" placeholder="Enter Quantity">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-10">
                                <label>Price <b class="require">*</b> <small>(In INR)</small></label>
                                <input type="number" class="form-control plan_price" name="price_0" id="price_0" placeholder="Enter Price">
                            </div>
                            <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-success add-row" title="Add More" onclick="createAddMoreFields()"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>                        
						<div id="add_more_div"></div>
                        <div class="error" id="facility_name_error"></div>
                        <div class="error" id="facility_name_error_qty"></div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <button style="margin-top: 10px;" type="submit" id="submit" name="submit" value="insert_form" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="subscription_id" id="subscription_id" value="<?php if(!empty($subscription)){ echo $subscription->id; }?>">
                </form> 
            </div>  
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Subscription Name</th>
                            <th>Add On Plan Name</th>
                            <th>Quantity</th>
                            <th>Price<br><small>(In INR)</small></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($whatsapp_plans)){
                            $i=1;
                                foreach($whatsapp_plans as $tips_list_result){
                        ?>
                        <tr>
                            <td scope="row"><?=$i++?></td>
                            <td><?=$tips_list_result->subscription_name?></td>
                            <td><?=$tips_list_result->plan_name?></td>
                            <td><?=$tips_list_result->qty?></td>
                            <td><?=$tips_list_result->price?></td>
                            <td>
                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$tips_list_result->id?>/tbl_whatsapp_addon_plans"><i class="fa-solid fa-trash"></i></a>	
                                <a title="Edit" class="btn btn-success" href="<?=base_url()?>whatsapp-addon-plans/<?=$this->uri->segment(2);?>/<?=$tips_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                            </td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');
    $id = $this->uri->segment(3);
?>
<script>
    let isFormValid = true;
    function validateAllPlanNames(){
        const allValues = [];
        let hasDuplicate = false;

        $(".plan_name").each(function () {
            const val = $(this).val().trim();
            if (val !== "") {
                if (allValues.includes(val)) {
                    hasDuplicate = true;
                    return false;
                }
                allValues.push(val);
            }
        });

        if (hasDuplicate) {
            $("#facility_name_error").html('Duplicate Plan Name found in the form');
            isFormValid = false;
            toggleSubmitButton();
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/Ajax_controller/get_unique_whatsapp_addon_plan_name",
            data: {
                'plan_names[]': allValues,
                'subscription_id': $('#subscription_id').val(),
                'id': '<?=$id?>'
            },
            success: function(response) {
                try {
                    const data = JSON.parse(response);

                    if (Array.isArray(data) && data.length === 0) {
                        $("#facility_name_error").html('');
                    } else {
                        $("#facility_name_error").html('These Plan Names already exist: <b>' + data.join(", ") + '</b>');
                        isFormValid = false;
                    }
                } catch (e) {
                    console.error("Invalid response from server", response);
                    $("#facility_name_error").html('Server validation failed');
                    isFormValid = false;
                }
                toggleSubmitButton();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#facility_name_error").html('Server error occurred');
                isFormValid = false;
                toggleSubmitButton();
            }
        });
    }
    
    function validateAllQty(){
        const allValues = [];
        let hasDuplicate = false;

        $(".qty").each(function () {
            const val = $(this).val().trim();
            if (val !== "") {
                if (allValues.includes(val)) {
                    hasDuplicate = true;
                    return false;
                }
                allValues.push(val);
            }
        });

        if (hasDuplicate) {
            $("#facility_name_error_qty").html('Duplicate Quantity found in the form');
            isFormValid = false;
            toggleSubmitButton();
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/Ajax_controller/get_unique_whatsapp_addon_plan_qty",
            data: {
                'qtys[]': allValues,
                'subscription_id': $('#subscription_id').val(),
                'id': '<?=$id?>'
            },
            success: function(response) {
                try {
                    const data = JSON.parse(response);

                    if (Array.isArray(data) && data.length === 0) {
                        $("#facility_name_error_qty").html('');
                    } else {
                        $("#facility_name_error_qty").html('These Quantity values already exist: <b>' + data.join(", ") + '</b>');
                        isFormValid = false;
                    }
                } catch (e) {
                    console.error("Invalid response from server", response);
                    $("#facility_name_error_qty").html('Server validation failed');
                    isFormValid = false;
                }
                toggleSubmitButton();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#facility_name_error_qty").html('Server error occurred');
                isFormValid = false;
                toggleSubmitButton();
            }
        });
    }

    $(document).on("keyup", ".plan_name, .qty", function () {
        isFormValid = true;
        validateAllPlanNames();
        validateAllQty();
    });	

    function toggleSubmitButton() {
        if (isFormValid) {
            $("#submit").show();
        } else {
            $("#submit").hide();
        }
    }
</script>
<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        buttons: [
            {
                extend: 'excel',
                filename: 'Whatsapp Add On Plans<?=!empty($subscription) ? ' for ' .$subscription->subscription_name . ' Plan' : ''; ?>',
                exportOptions: {
                    columns: [0,1,2,3,4] 
                }
            }
        ], 
    });
</script>
<script>
    <?php if(!empty($single)){ ?>
    $('#master_form').validate({
        rules: {
            price: {
                required: true, 
            },
            plan_name: {
                required: true, 
            },
            qty: {
                required: true, 
            },
        },
        messages: {
            price: {
                required: "Please enter price!", 
            },
            plan_name: {
                required: "Please enter plan name!", 
            },
            qty: {
                required: "Please enter quantity!", 
            },
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
    <?php }else{ ?>
        $('#master_form').validate({
            rules: {
                price_0: {
                    required: true, 
                },
                plan_name_0: {
                    required: true, 
                },
                qty_0: {
                    required: true, 
                },
            },
            messages: {
                price_0: {
                    required: "Please enter price!", 
                },
                plan_name_0: {
                    required: "Please enter plan name!", 
                },
                qty_0: {
                    required: "Please enter quantity!", 
                },
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
    <?php } ?>
    function initializeValidationForFields() {
		$(".qty").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter quantity",
				},
			});
		});
		$(".plan_name").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter plan name",
				},
			});
		});
		$(".plan_price").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter price",
				},
			});
		});
    }
	function removeRow(arg) {
		$(arg).parent().parent().remove();
		initializeValidationForFields();
        validateAllPlanNames();
        validateAllQty();
	} 
    
	var i = 1;
	function createAddMoreFields() {
		let appedData = `<div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Plan Name <b class="require">*</b></label>
                                <input type="text" class="form-control plan_name" name="plan_name_${i}" id="plan_name_${i}" placeholder="Enter Plan Name">
                            </div>
                            <input type="hidden" name="indices[]" id="indices_${i}" value="${i}">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Quantity <b class="require">*</b></label>
                                <input type="number" class="form-control qty" name="qty_${i}" id="qty_${i}" placeholder="Enter Quantity">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-10">
                                <label>Price <b class="require">*</b> <small>(In INR)</small></label>
                                <input type="number" class="form-control plan_price" name="price_${i}" id="price_${i}" placeholder="Enter Price">
                            </div>
                            <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <label>&nbsp;</label>
                                <span onclick="removeRow(this)" title="Remove It" class="btn btn-success"><i class="fa fa-trash" style="color:white;" aria-hidden="true"></i></span>
                            </div>
                        </div>`;
		$('#add_more_div').append(appedData);
		i++;
		initializeValidationForFields();
	}
</script>
<?php include('header.php'); ?>
<style type="text/css">
    .type-title {
        margin-left: 20px;
        color: red;
    }



    .section-title {
        color: black;
        font-weight: bold;
    }

    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }

    input[type="file"] {
        height: 50px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Branch 
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post" name="branch_form" id="branch_form" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="branch_name" id="branch_name" value="<?php if (!empty($single)) {echo $single->branch_name; } ?>" placeholder="Enter branch name">
                                <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id; } ?>">
                                <input autocomplete="off" type="hidden" class="form-control" name="salon_id" id="salon_id" value="<?php echo $this->uri->segment(2); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salon Mobile<b class="require">*</b></label>
                                <input maxlength="10" autocomplete="off" type="text" class="form-control" name="salon_number" id="salon_number" value="<?php if (!empty($single)) { echo $single->salon_number;} ?>" placeholder="Enter salon number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter salon email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="password" id="password" value="<?php if (!empty($single)) {echo $single->password; } ?>" placeholder="Enter salon password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salon Address <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="salon_address" id="salon_address" value="<?php if (!empty($single)) {echo $single->salon_address; } ?>" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control form-select  chosen-select" name="state" id="state">
                                    <option value="" class="">Select State</option>
                                    <?php if (!empty($state)) {
                                        foreach ($state as $state_result) { ?>
                                            <option value="<?= $state_result->id ?>" <?php if (!empty($single) && $single->state == $state_result->id) { ?>selected="selected" <?php } ?>>
                                                <?= $state_result->name ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <?php
                            $city = array();
                            if (!empty($single)) {
                                $city = $this->Admin_model->get_selected_state_city($single->state);
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select City</label>
                                <div>
                                    <select class="form-control form-select  chosen-select" name="city" id="city_name">
                                        <option value="">Select City</option>
                                        <?php if (!empty($city)) {
                                            foreach ($city as $city_result) { ?>
                                                <option value="<?= $city_result->id ?>" <?php if (!empty($single) && $single->city == $city_result->id) { ?>selected="selected" <?php } ?>>
                                                    <?= $city_result->name ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pin Code</label>
                                <input autocomplete="off" type="text" class="form-control" name="pincode" id="pincode" value="<?php if (!empty($single)) {echo $single->pincode;} ?>" placeholder="Enter pincode">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Shopact <b class="require">*</b></label>
                                <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control" name="shopact" id="shopact">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Salon Category</label><br>

                                <input autocomplete="off" type="radio" id="male" name="category" value="0" <?= ($single && $single->category == 0) ? 'checked' : ''; ?>>
                                <label for="male">Male</label>&nbsp&nbsp

                                <input autocomplete="off" type="radio" id="female" name="category" value="1" <?= ($single && $single->category == 1) ? 'checked' : ''; ?>>
                                <label for="female">Female</label>&nbsp&nbsp

                                <input autocomplete="off" type="radio" id="unisex" name="category" value="2" <?= ($single && $single->category == 2) ? 'checked' : ''; ?>>
                                <label for="unisex">Unisex</label>

                                <span id="category-error" class="error invalid-feedback" style="display:none;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salon Type<b class="require">*</b></label>
                                <select class="form-select form-control" name="salon_type" id="salon_type">
                                    <option value="">Select Type</option>
                                    <?php if(!empty($salon_type)){ foreach($salon_type as $salon_type_result){?>
                                    <option value="<?=$salon_type_result->id.'@@@'.$salon_type_result->rules_id?>" <?php if(!empty($single) && $single->salon_type == $salon_type_result->id){ echo 'selected'; }?>><?=$salon_type_result->type?></option>
                                    <?php }}?> 
                                </select>
                            </div>
                        </div>



                        <!-- Bannk Detail -->

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <h3 style="color: black; font-weight: bold;">Bank Details</h3>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Holder Name <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) {echo $single->account_holder_name; } ?>" placeholder="Enter account holder name">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Account Number <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter account number">


                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Account Type<b class="require">*</b></label>
                            <select class="form-control" name="account_type" id="account_type">
                                <option value="">Select account type</option>
                                <option value="1" <?php if (!empty($single) && $single->account_type == 1) echo 'selected="selected"'; ?>>Saving</option>
                                <option value="2" <?php if (!empty($single) && $single->account_type == 2) echo 'selected="selected"'; ?>>Current</option>
                                <option value="3" <?php if (!empty($single) && $single->account_type == 3) echo 'selected="selected"'; ?>>Salary</option>

                            </select>
                        </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="bank_branch_name" id="bank_branch_name" value="<?php if (!empty($single)) {echo $single->bank_branch_name; } ?>" placeholder="Enter account type">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IFSC Code <b class="require">*</b></label>
                                <input autocomplete="off" type="text" class="form-control" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {  echo $single->ifsc; } ?>" placeholder="SBIN0011513">


                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <button type="submit" value="submit" name="submit_form" class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                            </div>
                        </div>
                    </form> <!------------end of form---->
                </div> <!----------end of container-------->
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h3 style="color: black; font-weight: bold;">Branch List</h3>
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input autocomplete="off" type="checkbox" class="tableflat">
                                </th>
                                <th>Branch Name</th>
                                <th>Branch Number</th>
                                <th>Branch Email</th>
                                <th>Type</th>
                                <th>Address</th>
                                <th>Gallary</th>
                                <th class=" no-link last"><span class="nobr">Actions</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($branch_list)) {
                                $i = 1;
                                foreach ($branch_list as $gbranch_list_result) {
                                    $saloon_type = $this->Admin_model->get_salon_type($gbranch_list_result->salon_type);
                            ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i++ ?>
                                        </th>
                                        <td>
                                            <?= $gbranch_list_result->branch_name ?>
                                        </td>
                                        <td>
                                            <?= $gbranch_list_result->salon_number ?>
                                        </td>
                                        <td>
                                            <?= $gbranch_list_result->email ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($saloon_type)){ echo $saloon_type->type; }else{ echo '-'; }?>
                                        </td>
                                        <td>
                                            <?= $gbranch_list_result->salon_address ?>
                                        </td>
                                        <td><a style="color: blue;" href="<?= base_url(); ?>branch-gallary/<?= $gbranch_list_result->id?>">Add Gallary</a></td>
                                        <td>

                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?= $gbranch_list_result->id ?>/tbl_branch"><i class="fa-solid fa-trash"></i></a>

                                            <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-branch/<?= $this->uri->segment(2) ?>/<?= $gbranch_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>

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
        jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email.");  
        $('#branch_form').validate({
            rules: {
                branch_name: 'required',
                salon_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                shopact: 'required',
                salon_address: 'required',
                account_holder_name: 'required',
                account_number: 'required',
                account_type: 'required',
                bank_branch_name: 'required',
                ifsc: 'required',
                password: 'required',
                email: {
                       
                       required: true, 
                       validate_email:true,
                       noHTMLtags: true,
                   },
                salon_type: 'required',
                category: 'required',

            },
            messages: {
                email: {
                        required: "Please enter email!", 
                        validate_email: "Please enter valid email!",
                        noHTMLtags: "HTML tags not allowed!",
                    },
                branch_name: 'Please enter salon name',
                salon_number: {
                    required: "Please enter salon owner number",
                    number: "Please enter number",
                    minlength: "Enter valid contact number",
                    maxlength: "Length of contact number is too large!",
                },
                shopact: 'Please upload salon shopact file',
                salon_address: 'Please enter salon address',
                account_holder_name: 'Please enter account holder name',
                account_number: 'Please enter account number',
                account_type: 'Please enter account type',
                bank_branch_name: 'Please enter bank branch name',
                ifsc: 'Please enter ifsc code',
                password: 'Please enter password',
                salon_type: 'Please select salon type',
                category: 'Please select salon category',
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

    $("#state").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: {
                'state': $("#state").val()
            },
            success: function(data) {
                $("#city_name").empty();
                $('#city_name').append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $('#city_name').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $('#city_name').trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
</script>
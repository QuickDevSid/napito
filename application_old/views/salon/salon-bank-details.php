<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Bank Details
                </h3>
            </div>

            
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Account Holder Name <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control"  value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->account_holder_name; } ?>" name="account_holder_name" id="account_holder_name"  placeholder="Enter account holder name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->id; } ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Bank Name<b class="require">*</b></label>
                                        <input autocomplete="off" class="form-control" type="text" name="bank_name" id="bank_name" value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->bank_name;} ?>" placeholder="Enter bank name">
                                    </div> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Account Number <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" oninput="this.value = this.value.replace(/\s/g, '');" value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->account_number; } ?>" class="form-control" name="account_number" id="account_number"  placeholder="Enter account number">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                        <label>Account type<b class="require">*</b></label>
                                        <select class="form-select form-control" name="account_type" id="account_type">
                                            <option value="">Select account type</option>
                                            <option value="1" <?php if (!empty($single_bank_profile) && $single_bank_profile->account_type === "1") { echo 'selected="selected"'; } ?>>Saving</option>
                                            <option value="2" <?php if (!empty($single_bank_profile) && $single_bank_profile->account_type === "2") { echo 'selected="selected"'; } ?>>Current</option>
                                            <option value="3" <?php if (!empty($single_bank_profile) && $single_bank_profile->account_type === "3") { echo 'selected="selected"'; } ?>>Salary</option>
                                        </select>
                                        </div>
                                    </div>
                                    
                               
                                
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Bank Name <b class="require">*</b></label>
                                            <input autocomplete="off"  value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->bank_branch_name; } ?>" type="text" class="form-control" name="bank_branch_name" id="bank_branch_name"  placeholder="Enter bank name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>IFSC Code <b class="require">*</b></label>
                                            <input autocomplete="off"  value="<?php if (!empty($single_bank_profile)) { echo $single_bank_profile->ifsc; } ?>" type="text" class="form-control" name="ifsc" id="ifsc" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '');" placeholder="SBIN0004287">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
    $("#coupan_expiry").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        
        minDate: "-80Y",
         
    });
    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email!");
        $.validator.addMethod("ifsc", function(value, element) {
        return this.optional(element) || /^[A-Z]{4}[0]{1}[0-9A-Z]{6}$/.test(value);
    });
        $('#customer_form').validate({
            rules: {
                bank_name: 'required',
                account_holder_name: 'required',
                account_number: {
                    required: true,
                    number: true,
                    min: 0, 
                },
                account_type: 'required',
                bank_branch_name: 'required',
                ifsc: {
                    required: true,
                    ifsc: true,
                },
            },
            messages: {
                bank_name: "Please enter bank name!",
                account_holder_name: 'Please enter account holder name!',
                account_number: {
                    required: "Please enter account number!",
                    number: "Only number allowed!",
                    min: "Please enter valid account number", 
                },
                account_type: 'Please enter account type!',
                bank_branch_name: 'Please enter bank name!',
                
                ifsc: {
						required: "Please enter ifsc code!",
						ifsc: "Please enter valid ifsc code !",
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
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.salon-bank-details').addClass('active_cc');
    });
</script>